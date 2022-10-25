<?php
$url = 'https://'. $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"] ;
$postdata = file_get_contents("php://input") ;
//if (!$postdata){
if ($postdata != ""){
    $cu = curl_init();
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
    curl_setopt($cu, CURLOPT_URL, $url);
    curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cu, CURLOPT_SSL_VERIFYHOST, false);
    $data = curl_exec($cu);
    curl_close($cu);
    echo $data;
}