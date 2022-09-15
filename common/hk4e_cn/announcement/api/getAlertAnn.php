<?php

$cu = curl_init();
$url = 'https://' . $_SERVER['SERVER_NAME'] . '/common/hk4e_cn/announcement/api/getAlertAnn?' . $_SERVER["QUERY_STRING"];
curl_setopt($cu, CURLOPT_URL, $url);
curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($cu, CURLOPT_SSL_VERIFYHOST, false);
$data = curl_exec($cu);
curl_close($cu);
echo $data;

/*
$res = array(
    'retcode' => 0,
    'message' => "OK",
    'data' => array(
        'alert' => false,
        'alert_id' => 0,
        'remind'=>false,
        'extra_remind'=>false
    )
);
echo json_encode($res, JSON_UNESCAPED_UNICODE);
*/