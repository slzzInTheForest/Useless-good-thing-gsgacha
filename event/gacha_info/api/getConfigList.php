<?php
$res = array(
        'retcode'=>0,
        'message'=>"OK",
        'data'=>
            array(
                'gacha_type_list' =>
                    array(
                        array(
                            'id'=>"4",
                            'key'=>"200",
                            'name'=>'常驻祈愿'
                        ),
                        array(
                            'id'=>"14",
                            'key'=>"100",
                            'name'=>'新手祈愿'
                        ),
                        array(
                            'id'=>"15",
                            'key'=>"301",
                            'name'=>'角色活动祈愿'
                        ),
                        array(
                            'id'=>"16",
                            'key'=>"302",
                            'name'=>'武器活动祈愿'
                        ),
                    ),
                'region'=>"cn_gf01"
            )
    );

echo json_encode($res,JSON_UNESCAPED_UNICODE);
?>