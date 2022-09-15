<?php
$cdkey = $_GET['cdkey'] ;
$scdkey = strtolower($cdkey);
if ($scdkey == "kfcfkxqsvme50" || $scdkey == "kfcfkxqsv50" || $scdkey == "kfccrazythursdayvme50" || $scdkey == "kfccrazythursdayv50"){
    $res = array(
        'data'=>null,
        'message'=>"?你貌似在想桃子吃！",
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