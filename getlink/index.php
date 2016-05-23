<?php define('KKEY', true);


include "includes/curl.php";
include "includes/xml.class.php";

/**
 * Hàm lấy link download nhạc tại nhaccuatui.com phiên bản mới
**/
function _getSongNCT($ID_NCT){
	global $xml,$curl;
	$LinkNCT = 'http://www.nhaccuatui.com/bai-hat/Killer.'.$ID_NCT.'.html';
	$sourceNCT = $curl->viewSource($LinkNCT);
	$keyNCT = $curl->getStr($sourceNCT,'NCTNowPlaying.initNowPlaying("flashPlayer", "song", "','"');
	$xmlVals = $xml->readXML('http://www.nhaccuatui.com/flash/xml?key1='.$keyNCT);
	$dlNCT = $xmlVals['tracklist']['track']['location'];
	return $dlNCT;
}

function _getSongHQNCT($ID_NCT){
	global $curl;
	$LinkHQNCT = 'http://www.nhaccuatui.com/download/song/'.$ID_NCT;
	$sourceJsonNCT = $curl->viewSource($LinkHQNCT);
	$deJsonNCT = json_decode($sourceJsonNCT);
	$dlHQNCT = $deJsonNCT->{'data'}->{'stream_url'};
	return $dlHQNCT;
}
?>
<html lang="en" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Get Link NCT Phiên Bản Mới</title>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
</head>
<?php
/**
 * Chạy thử
**/
$songNCT = isset($_GET['songNCT']) ? $_GET['songNCT'] : 'http://www.nhaccuatui.com/bai-hat/khong-con-anh-nua-truong-quynh-anh.mb5VYQybJuiT.html';

//Lấy link download nhạc thường và HQ tại nhaccuatui.com
if($songNCT){
	$curl = new NC_CURL;
	$xml = new NC_XML;
?>
	<center>
	<h3>Nhạc thường</h3>
	<embed align="middle" width="640" height="23" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowscriptaccess="sameDomain" name="fullscreen" bgcolor="#ffffff" salign="tl" quality="high" flashvars="file=<?php echo _getSongNCT($songNCT);?>&autostart=true" src="swf/jwhplayer.swf"/><br />
	<strong>Download:</strong> <?php echo _getSongNCT($songNCT);?>
	<hr />
	<h3>Nhạc HQ</h3>
	<embed align="middle" width="640" height="23" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowscriptaccess="sameDomain" name="fullscreen" bgcolor="#ffffff" salign="tl" quality="high" flashvars="file=<?php echo _getSongHQNCT($songNCT);?>&autostart=false" src="swf/jwhplayer.swf"/><br />
	<strong>Download HQ:</strong> <?php echo _getSongHQNCT($songNCT);?>
	</center>
<?php } ?>

<script src="http://vuinhon.vn/taitro/textlinks.js" language="javascript" type="text/javascript"></script><br />
<a href="http://vuinhon.vn/forum/showthread.php?t=678" target="_blank"><img src="http://vuinhon.vn/taitro/2.gif" title="[TSmodz] Auto Khu Vườn TY, NVTT, xCombo..." border="0" width="600" height="120"></a>
<script src="http://vuinhon.vn/taitro/popup.js" language="javascript" type="text/javascript"></script>

</body>
</html>