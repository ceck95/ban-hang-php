<?php defined('KKEY') or die('No direct script access.');
/**
 * @author  : Killer
 * @version : 1.0.0
 */
class NC_CURL{
    var $ch;
    var $debug = false;
    var $error_msg;
    function NC_CURL($debug = false){
        $this->debug = $debug;
        $this->init();
    }
    function init(){
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_FAILONERROR, true);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_ENCODING , 'gzip, deflate');
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
    }
    function set_credentials($username,$password){
        curl_setopt($this->ch, CURLOPT_USERPWD, "$username:$password");
    }
    function set_referrer($referrer_url){
        curl_setopt($this->ch, CURLOPT_REFERER, $referrer_url);
    }
    function set_user_agent($useragent){
        curl_setopt($this->ch, CURLOPT_USERAGENT, $useragent);
    }
    function include_response_headers($value){
        curl_setopt($this->ch, CURLOPT_HEADER, $value);
    }
    function setProxy($proxy){
        curl_setopt($this->ch, CURLOPT_PROXY, $proxy);
    }
    function sendPost($url, $postdata, $ip=null, $timeout=15){
        curl_setopt($this->ch, CURLOPT_URL,$url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER,true);
        if($ip){
            if($this->debug){
                echo "Binding to ip $ip\n";
            }
            curl_setopt($this->ch,CURLOPT_INTERFACE,$ip);
        }
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($this->ch, CURLOPT_POST, true);
        $post_array = array();
        if(is_array($postdata)){		
            foreach($postdata as $key=>$value){
                $post_array[] = urlencode($key) . "=" . urlencode($value);
            }
            $post_string = implode("&",$post_array);
            if($this->debug){
                echo "Url: $url\nPost String: $post_string\n";
            }
        }else{
            $post_string = $postdata;
        }
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post_string);
        $result = curl_exec($this->ch);
        if(curl_errno($this->ch)){
            if($this->debug){
                echo "Error Occured in Curl\n";
                echo "Error number: " .curl_errno($this->ch) ."\n";
                echo "Error message: " .curl_error($this->ch)."\n";
            }
            return false;
        }else{
            return $result;
        }
    }
    function viewSource($url, $ip=null, $timeout=5){
        curl_setopt($this->ch, CURLOPT_URL,$url);
        curl_setopt($this->ch, CURLOPT_HTTPGET,true);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER,true);
        if($ip){
            if($this->debug){
                echo "Binding to ip $ip\n";
            }
            curl_setopt($this->ch,CURLOPT_INTERFACE,$ip);
        }
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeout);
        $result = curl_exec($this->ch);
        if(curl_errno($this->ch)){
            if($this->debug)
            {
                echo "Error Occured in Curl\n";
                echo "Error number: " .curl_errno($this->ch) ."\n";
                echo "Error message: " .curl_error($this->ch)."\n";
            }
            return false;
        }else{
            return $result;
        }
		$httpcode = $this->get_http_response_code();
		if($httpcode>=200 && $httpcode<300){
			return true;
		}else{
			return false;
		}
		$this->close_curl();
    }
	function sendGet($url, $ip=null, $timeout=5){
		curl_setopt($this->ch, CURLOPT_URL,$url);
		curl_setopt($this->ch, CURLOPT_HTTPGET,true);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER,true);
		if($ip){
			if($this->debug){
				echo "Binding to ip $ip\n";
			}
			curl_setopt($this->ch,CURLOPT_INTERFACE,$ip);
		}
		curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeout);
		$result = curl_exec($this->ch);
		if(curl_errno($this->ch)){
			if($this->debug){
				echo "Error Occured in Curl\n";
				echo "Error number: " .curl_errno($this->ch) ."\n";
				echo "Error message: " .curl_error($this->ch)."\n";
			}
			return false;
		}else{
			return $result;
		}
	}
	function getLocation($url, $ip=null, $timeout=15){
		curl_setopt($this->ch, CURLOPT_URL , $url); 
		curl_setopt($this->ch, CURLOPT_HEADER , true); 
		curl_setopt($this->ch, CURLOPT_NOBODY , true); 
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER , true); 
        if($ip){
            if($this->debug){
                echo "Binding to ip $ip\n";
            }
            curl_setopt($this->ch,CURLOPT_INTERFACE,$ip);
        }
		curl_setopt($this->ch, CURLOPT_TIMEOUT , $timeout); 
		$result = curl_exec($this->ch);
		$str 	= explode('Location: ',$result);
		$str 	= explode('Cache',$str[1]);
		$str 	= explode('Content',$str[0]);
		return trim($str[0]);
	}
    function store_cookies($cookie_file){
        curl_setopt ($this->ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt ($this->ch, CURLOPT_COOKIEFILE, $cookie_file);
    }
    function set_cookie($cookie){		
        curl_setopt ($this->ch, CURLOPT_COOKIE, $cookie);
    }
    function get_effective_url(){
        return curl_getinfo($this->ch, CURLINFO_EFFECTIVE_URL);
    }
    function get_http_response_code(){
        return curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
    }
	function validate($url){
		curl_setopt ($this->ch, CURLOPT_URL, $url);
		curl_setopt ($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($this->ch, CURLOPT_VERBOSE, false);
		curl_setopt ($this->ch, CURLOPT_TIMEOUT, 5);
		$page = curl_exec($this->ch);
		$httpcode = $this->get_http_response_code();
		if($httpcode>=200 && $httpcode<300){
			return true;
		}else{
			return false;
		}
	}
	function getStr($source, $start, $end=''){
		if(!$start){
			$str = explode($end, $source);
			return $str[0];
		}else{
			$str = explode($start, $source);
			if($end){		
				$str = explode($end, $str[1]);
				return $str[0];
			}else
				return $str[1];
		}
	}
	function getmicrotime($e = 0){
		list($u, $s) = explode(' ',time()/ 1000 * 1000);
		return bcadd($u, $s, $e);
	}
    function get_error_msg(){
        $err = "Error number: " .curl_errno($this->ch) ."\n";
        $err .="Error message: " .curl_error($this->ch)."\n";
        return $err;
    }
    function closeCurl(){
        curl_close($this->ch);
    }
}
?>
