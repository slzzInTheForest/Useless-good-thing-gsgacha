<?php
$res = array(
    'retcode'=>0,
    'message'=>"OK",
    'data'=>array(
        'msg'=>"兑换成功",
        'special_shipping'=>0
    )
);
echo json_encode($res,JSON_UNESCAPED_UNICODE);