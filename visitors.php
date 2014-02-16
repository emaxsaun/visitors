<?php
$dataFile = "visitors.txt";
$sessionTime = 30;
error_reporting(E_ERROR | E_PARSE);
if(!file_exists($dataFile)) {
	$fp = fopen($dataFile, "w+");
	fclose($fp);
}
$ip = $_SERVER['REMOTE_ADDR'];
$users = array();
$onusers = array();
$fp = fopen($dataFile, "r");
flock($fp, LOCK_SH);
while(!feof($fp)) {
	$users[] = rtrim(fgets($fp, 32));
}
flock($fp, LOCK_UN);
fclose($fp);
$x = 0;
$alreadyIn = FALSE;
foreach($users as $key => $data) {
	list( , $lastvisit) = explode("|", $data);
	if(time() - $lastvisit >= $sessionTime * 60) {
		$users[$x] = "";
	} else {
		if(strpos($data, $ip) !== FALSE) {
			$alreadyIn = TRUE;
			$users[$x] = "$ip|" . time();
		}
	}
	$x++;
}
if($alreadyIn == FALSE) {
	$users[] = "$ip|" . time();
}
$fp = fopen($dataFile, "w+");
flock($fp, LOCK_EX);
$i = 0;
foreach($users as $single) {
	if($single != "") {
		fwrite($fp, $single . "\r\n");
		$i++;
	}
}
flock($fp, LOCK_UN);
fclose($fp);
if($uo_keepquiet != TRUE) {
	echo "<div id='visitors' style='-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;-o-user-select: none;user-select:none;'>" . $i . ' user(s) connected</div>';
	echo "<script type='text/javascript'>
		var theDiv = document.getElementById('visitors');
		theDiv.style.display = 'none';
		theDiv.style.color = '#ffffff';
		theDiv.style.zIndex = '999';
		theDiv.style.fontSize = '16px';
		theDiv.style.fontFamily = 'arial,sans';
		theDiv.style.cursor = 'pointer';
		theDiv.style.position = 'absolute';
		jwplayer().onReady(function(){
			theDiv.style.display = 'inline';
			theDiv.style.top = jwplayer().getHeight() - 13 + 'px';
			theDiv.style.left = jwplayer().getWidth() - 131 + 'px';
		});
	</script>";
}
?>