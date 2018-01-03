<?php
error_reporting(0);
if(isset($_GET["btc"])){
	$add = $_GET["btc"];
} else {
echo "17uE9thFWV4bDYKof9zNHhZ9q2Eef2cQn3";
exit();
}
$cookie = tempnam('tmp','avo'.rand(1000000,9999999).'tmp.txt');
$betece = $_GET["btc"];
$i = curl("https://www.thebestbitcoinfaucet.com/","address={$betece}&sponsor=",0,1,'','',0,'','',$cookie,0);
$true = get_between($i,'<p style="color:#CE224D"><b>',' : '.$betece.'</p>');
if($true == "Wallet"){
$i = curl("https://www.thebestbitcoinfaucet.com/","",0,1,'','',0,'','',$cookie,0);
$i = curl("https://www.thebestbitcoinfaucet.com/","faucetclaim={$betece}",0,1,'','',0,'','',$cookie,0);
echo "Minning Success. (WARNING! RELOAD 60s for work's)";
} else {
echo"LOGIN #".rand(1,3);
}
function get_between($string, $start, $end) {
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}
function curl($url, $fields="", $ssl = 0, $followLocation = 0, $referer = '', $optUrl = '',  $deleteOldCookies=1, $sock = false, $userpwd = false, $usecookie=false, $geturl=false,$csrf=false) {
    $ch = curl_init($url);
    $header = array();
    $header[0]  = "Accept: text/javascript";
    $header[0]   = "Accept-Language: en-us,en;q=0.5";
    $header[0]   = "Accept-Encoding: gzip, deflate, br";
	$header[0]   = "DNT: 1";
    $header[]   = "Connection: keep-alive";
	$header[]   = "Keep-Alive: 300";
	$header[]   = "DNT: 1";
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:44.0) Gecko/20100101 Firefox/44.0");
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	if ($usecookie) { 
	curl_setopt($ch, CURLOPT_COOKIEJAR, $usecookie); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, $usecookie);    
	} 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    if($followLocation){
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    if($fields){
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    }else{
        curl_setopt($ch, CURLOPT_POST, false);
    }
    if($referer){
        curl_setopt($ch, CURLOPT_REFERER, $referer);
    }else{
        curl_setopt($ch, CURLOPT_REFERER, $url);
    }
    if($ssl){
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    }else{
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    }
    if($optUrl){
        curl_setopt ($ch, CURLOPT_URL, $optUrl);
    }
	if($sock){
		curl_setopt($ch, CURLOPT_PROXY, $sock);
		curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
	}
	if($userpwd){
    curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
	}
	if($geturl == true){
		$xd1 = curl_exec($ch);
		$xd2 = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		echo $xd1."|".$xd2;
	} else {
		return curl_exec($ch);
	}
}
?>