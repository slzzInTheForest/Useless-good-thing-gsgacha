<?php
include ('../../../config.php');

function getcdkey($cdkdata){
    $cu = curl_init();
    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/common/apicdkey/api/exchangeCdkey?'.$cdkdata;
    curl_setopt($cu, CURLOPT_URL, $url);
    curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cu, CURLOPT_SSL_VERIFYHOST, false);
    $data = curl_exec($cu);
    curl_close($cu);
    return $data;
}

$cdkey = $_GET['cdkey'] ;
if (($cdkey12 == "true" && strlen($cdkey) == 12)  && $cdkey_dp != "true"){
    $cu = curl_init();
    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/common/apicdkey/api/exchangeCdkey?' . $_SERVER["QUERY_STRING"];
    curl_setopt($cu, CURLOPT_URL, $url);
    curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cu, CURLOPT_SSL_VERIFYHOST, false);
    $data = curl_exec($cu);
    curl_close($cu);
    echo $data;
}elseif(($cdkey12 == "false" || strlen($cdkey) != 12 || $cdkey == "") && $cdkey_dp != "true"){
    if($Case_sensitive == "false" || $Case_sensitive == "") {
        $scdkey = strtolower($cdkey);
    }
    if (!$servername || !$username || !$password || !$dbname){
        $res = array(
            'retcode'=>0,
            'message'=>"OK",
            'data'=>array(
                'msg'=>"兑换成功",
                'special_shipping'=>0
            )
        );
    }else{
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
    }
    echo json_encode($res,JSON_UNESCAPED_UNICODE);
}elseif ($cdkey_dp == "true"){
    $data = "sign_type=" . $_GET['sign_type'] . "&auth_appid=" . $_GET['auth_appid'] . "&authkey_ver=" .$_GET['authkey_ver']. "&lang=" .$_GET['lang']. "&device_type=" .$_GET['device_type']. "&game_version=" .$_GET['game_version']. "&plat_type=" .$_GET['plat_type']. "&authkey=" .urlencode($_GET['authkey']). "&game_biz=" .$_GET['game_biz'] ;
    $cdkdata = $data . "&cdkey=" ;
    getcdkey($cdkdata);
    sleep(6);
    $cdkdata = $data . "&cdkey=" ;
    getcdkey($cdkdata);
    sleep(6);
    $cdkdata = $data . "&cdkey=" ;
    echo getcdkey($cdkdata);
}
