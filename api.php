<?php
$listkey = explode("\r\n", file_get_contents('key.txt'));
define(URL_API, 'https://sv1.smproxy.net/apit/');
$tinhnang = $_GET['tinhnang'];
$ip = $_GET['ip'];
if($tinhnang == 'set_ip_allow'){
    echo set_ip_allow($ip);
}elseif ($tinhnang == 'info_proxy'){
    $data = json_decode(info_proxy(),true);
    for ($i=0; $i < count($data['data']); $i++) { 
       echo $data['data'][$i]['data']['host_static'].":".$data['data'][$i]['data']['http_port']."<br>";
    }
}elseif ($tinhnang == 'renew_ip'){
    echo renew_ip();
}
function set_ip_allow($listip){
global $listkey;
$data = [];
for ($i=0; $i < count($listkey); $i++) { 
    $data[$i]['key'] = $listkey[$i];
    $data[$i]['ip'] = $listip;
}
$p['data'] = $data;
return post(URL_API.'set_ip_allow',json_encode($p));
}
function info_proxy(){
    global $listkey;
    $p['key'] = $listkey;
  return post(URL_API.'info_proxy',json_encode($p));  
}
function renew_ip(){// ở đây sẽ xử lý thay đổi ip tất cả key ở trong file txt 
    global $listkey;
    $p['key'] = $listkey;
  return post(URL_API.'renew_ip',json_encode($p));  
}
function post($url, $data){
$ch = @curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
$head[] = "Connection: keep-alive";
$head[] = "Keep-Alive: 300";
$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
$head[] = "Accept-Language: en-us,en;q=0.5";
$head[] = "Content-Type: application/json";
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36");
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$page = curl_exec($ch);
curl_close($ch);
return $page;
}
function get_html($url) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}
?>