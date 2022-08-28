<?php
//数据库配置(只支持mysql)
$servername = "";//数据库地址，为本机可填:localhost
$username = "";//数据库用户名
$password = "";//数据库密码
$dbname = "";//数据库名字

$page = $_GET["page"];
$size = $_GET["size"];
$end_id = $_GET["end_id"];
$gacha_type = $_GET["gacha_type"];
$begin_id = $_GET["begin_id"];
//$authkey = $_GET["authkey"];//使用请求附加的authkey
$authkey = "cao"; //自定义authkey，和上面的那个二选一

//page为空
if ($page == "")
{
    $page = 1;
}//size为空
if ($size == "")
{
    $size = 5;
}//size大于20
elseif ($size > 20)
{
    $size = 20;
}//end_id为空
if ($end_id == "" && isset($end_id))
{
    $end_id = 0;
}//begin_id处理
if (isset($begin_id))
{
    if ($begin_id =="")
    {
        $begin_id = 0 + $size;
    }
    else
    {
        $end_id = $begin_id - $size - 1;
    }
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
        //角色卡池和卡池2
        if($gacha_type == 301 || $gacha_type == 400 )
        {
            $result = mysqli_query($con, "SELECT * FROM gacha WHERE (gacha_type = 301 or gacha_type = 400) and authkey='$authkey' and id > $end_id ");
        }
        else
        {
            $result = mysqli_query($con, "SELECT * FROM gacha WHERE (authkey='$authkey' and gacha_type_id='$gacha_type' and id > $end_id)");
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
                if ($fc >= $size)
                {
                    break;
                }
            }
            //输出数据
        $res = array(
            'retcode'=>0,
            'message'=>"OK",
            'data'=>array(
                'page'=>"$page",
                'size'=>"$size",
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