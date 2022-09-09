<?php
$res = array(
    'retcode' => 0,
    'message' => "OK",
    'data' => array(
        'alert' => false,
        'alert_id' => 0,
        'remind'=>true,
        'extra_remind'=>true
    )
);
echo json_encode($res, JSON_UNESCAPED_UNICODE);