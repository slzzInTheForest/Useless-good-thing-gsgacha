<?php
$cu = curl_init();
$url = 'https://'.$_SERVER['HTTP_HOST'].'/event/eventhub/list_activity?'.$_SERVER["QUERY_STRING"];
curl_setopt($cu, CURLOPT_URL, $url);
curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($cu, CURLOPT_SSL_VERIFYHOST, false);
$data = curl_exec($cu);
curl_close($cu);
echo $data;
?>