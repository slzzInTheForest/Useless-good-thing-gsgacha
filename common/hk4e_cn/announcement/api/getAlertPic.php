<?php
$res = array(
    'retcode' => 0,
    'message' => "OK",
    'data' => array(
        'total' => 0,
        'list' => []
    )
);
echo json_encode($res, JSON_UNESCAPED_UNICODE);