<?php
include ('../../../config.php');

$cdkey = $_GET['cdkey'] ;
if ($cdkey12 == "true" && strlen($cdkey) == 12){
    $cu = curl_init();
    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/common/apicdkey/api/exchangeCdkey?' . $_SERVER["QUERY_STRING"];
    curl_setopt($cu, CURLOPT_URL, $url);
    curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cu, CURLOPT_SSL_VERIFYHOST, false);
    $data = curl_exec($cu);
    curl_close($cu);
    echo $data;
}else{
    if($Case_sensitive == "false" || $Case_sensitive == "") {
        $scdkey = strtolower($cdkey);
    }
//数据库
    $mysql=mysqli_connect($servername, $username, $password, $dbname);
    $result = mysqli_query($mysql, "SELECT * FROM cdkey WHERE cdkey='$cdkey'");
    $row = mysqli_fetch_array($result) ;
    if (mysqli_num_rows($result) > 0){
        $msg = $row["msg"] ;
        /*
        if ($row["retcode"] == ""){
            $retcode = -2016 ;
        }else{
            $retcode = $row["retcode"] ;
        }
        */
        $res = array(
            'data'=>null,
            'message'=>"$msg",
            'retcode'=>-2016
        );
    }else{
        $res = array(
            'retcode'=>0,
            'message'=>"OK",
            'data'=>array(
                'msg'=>"兑换成功",
                'special_shipping'=>0
            )
        );
    }

    echo json_encode($res,JSON_UNESCAPED_UNICODE);
}
