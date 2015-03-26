<?php
//chmod og+w iplist.php  dosyasını açıp gerekli izinleri verin
//".htaccess" dosyasına aşağıdaki kodları ekleyin 
//mod_rewrite
//AddType application/x-httpd-php .jpg
//Böylece resim linkiyle karşı tarafın gerçek ip ve diğer verilere ulaşabilirsiniz.
date_default_timezone_set('Europe/Istanbul');
	function GetIP(){if(getenv("HTTP_CLIENT_IP")) {$ip = getenv("HTTP_CLIENT_IP");} elseif(getenv("HTTP_X_FORWARDED_FOR")) {$ip = getenv("HTTP_X_FORWARDED_FOR");
		if (strstr($ip, ',')) {$tmp = explode (',', $ip);$ip = trim($tmp[0]);}} else {$ip = getenv("REMOTE_ADDR");}return $ip;}
$ip_adresi = GetIP();
$hostadresi = gethostbyaddr($ip_adresi);
$ua = $_SERVER['HTTP_USER_AGENT'];
$hr = $_SERVER['HTTP_REFERER'];
$lnguge = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

$logFile = "iplist.php";
$fh = fopen($logFile, 'a') or die("Dosya acilmiyor");
fwrite($fh, "<br>IP: ".$ip_adresi."<br><b>Araci: ".$ua."</b><br>Referans: ".$hr."<br><b>Zaman: ".date("d/m/Y - l")."  -  Saat:".date('H:m:s')."</b><br>Dil:".$lnguge."<br><b>Host Adresi:".$hostadresi."</b><br>_______________________________________<br>");
fclose($fh);

$image = "http://sp5.fotolog.com/photo/37/44/116/vgs_osvaldo/1203535102_f.jpg";
header("Content-type: image/jpeg");
imagejpeg(imagecreatefromjpeg($image));
?>