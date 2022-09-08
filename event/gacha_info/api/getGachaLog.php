<?php
include ('../../../config.php');

$page = $_GET["page"] ? intval($_GET["page"]) : 1;
$size = $_GET["size"];
$end_id = $_GET["end_id"];
$gacha_type = $_GET["gacha_type"];
$begin_id = $_GET["begin_id"];
if ($eauthkey == "" || $eauthkey == "false")
{
    $authkey = $_GET["authkey"];//使用请求附加的authkey
}
else
{
    $authkey = $eauthkey ;//使用配置文件中的authkey
}

//size为空
if ($size == "" || is_numeric($size) != 1) {
    $size = 5;
}//size大于20
elseif ($size > 20) {
    $size = 20;
}
elseif ($size < 0) {
    $size = 5;
}
//end_id为空
if (is_numeric($end_id) != 1 || $end_id == "" && isset($end_id)) {
    $end_id = 0;
}


if (isset($gacha_type))
{
    $con=mysqli_connect($servername, $username, $password, $dbname);
    if (mysqli_connect_errno())
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    else
    {
        if (isset($begin_id)) {
            if ($begin_id =="" || is_numeric($begin_id) != 1) {
                $begin = 0 + $size;
            } else {
                $begin = $begin_id + $size + 1;
            }if($begin < 0 ){//防止有人作死卡bug
                $begin = 20 ;
            }
            if($gacha_type == 301 || $gacha_type == 400 ){
                $result = mysqli_query($con, "SELECT * FROM gacha WHERE (gacha_type = 301 or gacha_type = 400) and authkey='$authkey' and id < '$begin' Order By id DESC");
            }else{
                $result = mysqli_query($con, "SELECT * FROM gacha WHERE gacha_type='$gacha_type' and authkey='$authkey' and id < '$begin' Order By id DESC");
            }
        }else{
            $end_id = $end_id + $size + 1;
            if ($end_id < 0 ){//防止有人作死卡bug
                $end_id = 20 ;
            }
            if($gacha_type == 301 || $gacha_type == 400 ){
                $result = mysqli_query($con, "SELECT * FROM gacha WHERE (gacha_type = 301 or gacha_type = 400) and authkey='$authkey' and id < '$end_id' Order By id DESC");
            }else{
                $result = mysqli_query($con, "SELECT * FROM gacha WHERE gacha_type='$gacha_type' and authkey='$authkey' and id < '$end_id' Order By id DESC");
            }
        }
        $list = [];
        $fc = 0;
        while ($row = mysqli_fetch_array($result))
        {
            //list json
            array_push($list,[
                'uid'=>$row["uid"],
                'gacha_type'=>$row["gacha_type"],
                'item_id'=>"",
                'count'=>"1",
                'time'=>$row["time"],
                'name'=>$row["name"],
                'lang'=>"zh-cn",
                'item_type'=>$row["item_type"],
                'rank_type'=>$row["rank_type"],
                'id'=>$row["id"]
            ]);
            $fc++;
            if ($fc >= $size) {
                break;
            }
        }
        //输出数据
        $res = array(
            'retcode'=>0,
            'message'=>"OK",
            'data'=>array(
                'page'=>"$page",
                'size'=>"$fc",
                'total'=>"0",
                'list'=>$list
            ),
            'region'=>"cn_gf01"
        );
    }

}

else
{
    $res = array(
        'retcode'=>0,
        'message'=>"OK",
        'data'=> array(
            'page'=>"1",
            'size'=>"0",
            'total'=>"0",
            'list'=>array(),
            'region'=>"cn_gf01"
        )
    );
}
echo json_encode($res,JSON_UNESCAPED_UNICODE);
//gacha_type:301=角色1 302=武器 100=新手 200=常驻 400=角色2
?>