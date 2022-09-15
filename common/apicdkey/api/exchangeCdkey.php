<?php
include ('../../../config.php');

$cdkey = $_GET['cdkey'] ;
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