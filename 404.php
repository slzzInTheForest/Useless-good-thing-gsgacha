<?php
header("HTTP/1.1 200 OK");
$url = 'https://'. $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"] ;
if (count($_POST) == 1){
    $cu = curl_init();
    $url = 'https://'. $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"] ;
    $postdata = file_get_contents("php://input") ;
    curl_setopt($cu, CURLOPT_URL, $url);
    curl_setopt($cu, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cu, CURLOPT_SSL_VERIFYHOST, false);
    $data = curl_exec($cu);
    curl_close($cu);
    echo $data;
}else{
    $cu = curl_init();
    $url = 'https://'. $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"] ;
    curl_setopt($cu, CURLOPT_URL, $url);
    curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cu, CURLOPT_SSL_VERIFYHOST, false);
    $data = curl_exec($cu);
    curl_close($cu);
    echo $data;
}