<?php defined('KKEY') or die('No direct script access.');
/**
 * @author  : Killer
 * @version : 1.0.0
 */
class NC_XML{
    private $tagstack;
    private $xmlvals;
    private $xmlvarArrPos;
    private $xmlfile;
    function setFile($filename){
        $this->tagstack     = array();
        $this->xmlvals      = array();
        $this->xmlvarArrPos = $this->xmlvals;
        $this->xmlfile      = $filename;
    }
    function readDatabase(){
        $data   = implode("", file($this->xmlfile));
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, $data, $values, $tags);
        xml_parser_free($parser);
        foreach($values as $key => $val){
            if($val['type'] == "open"){
                array_push($this->tagstack, $val['tag']);
                $this->getArrayPath();
                if(count($this->xmlvarArrPos) > 0 && (!array_key_exists(0,$this->xmlvarArrPos))){
                    $temp1 = $this->xmlvarArrPos;
                    $this->xmlvarArrPos =  array();
                    $this->xmlvarArrPos[0] = $temp1;
                    array_push($this->tagstack, 1);
                }elseif(@array_key_exists(0,$this->xmlvarArrPos)){
                    $opncount = count($this->xmlvarArrPos);
                    array_push($this->tagstack, $opncount);
                }
                $tagStackPointer += 1;
            }elseif($val['type'] == "close"){
                while( $val['tag'] != ($lastOpened = array_pop($this->tagstack))){}
            }else if($val['type'] ==  "complete"){
                $this->getArrayPath();
                if(@array_key_exists($val['tag'],$this->xmlvarArrPos)){
                    if(array_key_exists(0,$this->xmlvarArrPos[$val['tag']])){
                        $elementCount = count($this->xmlvarArrPos[$val['tag']]);
                        $this->xmlvarArrPos[$val['tag']][$elementCount] = $val['value'];
                    }else{
                        $temp1 = $this->xmlvarArrPos[$val['tag']];
                        $this->xmlvarArrPos[$val['tag']] =  array();
                        $this->xmlvarArrPos[$val['tag']][0] = $temp1;
                        $this->xmlvarArrPos[$val['tag']][1] = $val['value'];
                    }
                }else{
                    $this->xmlvarArrPos[$val['tag']] = $val['value'];
                }
            }
        }
        reset($this->xmlvals);
        return $this->xmlvals;
    }
    function getArrayPath(){
        reset($this->xmlvals);
        $this->xmlvarArrPos = &$this->xmlvals;
        foreach($this->tagstack as $key){
            $this->xmlvarArrPos = &$this->xmlvarArrPos[$key];
        }
    }
    function readXML($xml){
        $this->setFile($xml);// Set file xml
        return $this->readDatabase();// Đọc xml
    }

}
?>