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

if (isset($gacha_type))
{
    if ($use_db == 0){
        $mysql=mysqli_connect($servername, $username, $password, $dbname);
        if (mysqli_connect_errno())
        {
            die("Connection failed: " . mysqli_connect_error());
        }
        else
        {
            //end_id为空
            if (is_numeric($end_id) != 1 || $end_id == "" && isset($end_id)) {
                $end_id = 9999999999;
            }if ($end_id == 0){
            $end_id = 9999999999;
        }
            if (isset($begin_id)) {
                if ($begin_id =="" || is_numeric($begin_id) != 1) {
                    $begin = 0 + $size;
                }else {
                    $begin = $begin_id + $size + 1;
                }if($begin < 0 ){//防止有人作死卡bug
                    $begin = 20 ;
                }
                if($gacha_type == 301 || $gacha_type == 400 ){
                    if($begin_id == 0){
                        $result = mysqli_query($mysql, "SELECT * FROM gacha WHERE (gacha_type = 301 or gacha_type = 400) and authkey='$authkey' Order By id DESC");
                    }else{
                        $result = mysqli_query($mysql, "SELECT * FROM gacha WHERE (gacha_type = 301 or gacha_type = 400) and authkey='$authkey' and id < '$begin' Order By id DESC");
                    }
                }else{
                    if($begin_id == 0){
                        $result = mysqli_query($mysql, "SELECT * FROM gacha WHERE gacha_type='$gacha_type' and authkey='$authkey' Order By id DESC");
                    }else{
                        $result = mysqli_query($mysql, "SELECT * FROM gacha WHERE gacha_type='$gacha_type' and authkey='$authkey' and id < '$begin' Order By id DESC");
                    }
                }
            }else{
                if ($end_id < 0 ){//防止有人作死卡bug
                    $end_id = 20 ;
                }
                if($gacha_type == 301 || $gacha_type == 400 ){
                    if ($end_id == 0){
                        $result = mysqli_query($mysql, "SELECT * FROM gacha WHERE (gacha_type = 301 or gacha_type = 400) and authkey='$authkey' Order By id DESC");
                    }else{
                        $result = mysqli_query($mysql, "SELECT * FROM gacha WHERE (gacha_type = 301 or gacha_type = 400) and authkey='$authkey' and id < '$end_id' Order By id DESC");
                    }
                }else{
                    if ($end_id == 0){
                        $result = mysqli_query($mysql, "SELECT * FROM gacha WHERE gacha_type='$gacha_type' and authkey='$authkey' Order By id DESC");
                    }else{
                        $result = mysqli_query($mysql, "SELECT * FROM gacha WHERE gacha_type='$gacha_type' and authkey='$authkey' and id < '$end_id' Order By id DESC");
                    }

                }
            }
            //数据输出
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
        //说实话我忘了我之前怎么写的了
    }elseif ($use_db == 1){
        if (!file_exists("../../../$itemid_filename")){
            die ("$itemid_filename 不存在该文件");
        }
        if ($mongo_username || $mongo_password){
            $manager = new MongoDB\Driver\Manager("mongodb://$mongo_username:$mongo_password@$mongo_servername:$mongo_port");
        }else{
            $manager = new MongoDB\Driver\Manager("mongodb://$mongo_servername:$mongo_port");
        }
        if (isset($begin_id)){
            if($gacha_type == 301 || $gacha_type == 400 ){
                if ($begin_id == 0){
                    $query = new \MongoDB\Driver\Query(['ownerId'=>$m_uid,'gachaType'=>['$in'=>[301,400]]],['sort'=>['_id'=>-1]]);
                    //'views' => ['$gte' => $size ,],
                }else{
                    $query = new \MongoDB\Driver\Query(['ownerId'=>$m_uid,'gachaType'=>['$in'=>[301,400]],'_id'=>['$lt'=>new MongoDB\BSON\ObjectId($begin_id)]],['sort'=>['_id'=>-1]]);
                }
            }else{
                if ($begin_id == 0){
                    $query = new \MongoDB\Driver\Query(['ownerId'=>$m_uid,'gachaType'=>(int)$gacha_type],['sort'=>['_id'=>-1]]);
                    //'views' => ['$gte' => $size ,],
                }else{
                    $query = new \MongoDB\Driver\Query(['ownerId'=>$m_uid,'gachaType'=>(int)$gacha_type,'_id'=>['$lt'=>new MongoDB\BSON\ObjectId($begin_id)]],['sort'=>['_id'=>-1]]);
                }
            }
        }else{
            if ($gacha_type == 301 || $gacha_type == 400){
                if (!$end_id || $end_id == 0){
                    $query = new \MongoDB\Driver\Query(['ownerId'=>$m_uid,'gachaType'=>['$in'=>[301,400]]]);
                    //'views' => ['$gte' => $size ,],
                }else{
                    $query = new \MongoDB\Driver\Query(['ownerId'=>$m_uid,'gachaType'=>['$in'=>[301,400]],'_id'=>['$gt'=>new MongoDB\BSON\ObjectId($end_id)]]);
                }
            }else{
                if (!$end_id || $end_id == 0){
                    $query = new \MongoDB\Driver\Query(['ownerId'=>$m_uid,'gachaType'=>(int)$gacha_type]);
                    //'views' => ['$gte' => $size ,],
                }else{
                    $query = new \MongoDB\Driver\Query(['ownerId'=>$m_uid,'gachaType'=>(int)$gacha_type,'_id'=>['$gt'=>new MongoDB\BSON\ObjectId($end_id)]]);
                }
            }
        }
        $cursor = $manager->executeQuery("$mongo_dbname.gachas",$query);
        //数据输出
        $list = [];
        $fc = 0;
        $item_data=json_decode(file_get_contents("../../../$itemid_filename"),true);
        foreach ($cursor as $document) {
            //判断类型
            $mdb_itemID = $document->itemID ;
            $item_name = $item_data["$mdb_itemID"];
            if ($mdb_itemID < 9999){
                $mdb_item_type = '角色';
                $nbcbibv29fb = explode(':',$item_name) ;
                $mdb_name = $nbcbibv29fb[0] ;
                $mdb_rank_type = $nbcbibv29fb[1] ;
            }else{
                $mdb_item_type = '武器';
                $mdb_rank_type = mb_substr($mdb_itemID,2,1) ;
                $mdb_name = $item_name ;
            }
            array_push($list,[
                'uid'=>"$document->ownerId",
                'gacha_type'=>"$document->gachaType",
                'item_id'=>"",
                'count'=>"1",
                'time'=>date('Y-m-d H:i:s',intval(date($document->transactionDate) / 1000)),
                'name'=>$mdb_name,
                'lang'=>"zh-cn",
                'item_type'=>$mdb_item_type,
                'rank_type'=>$mdb_rank_type,
                'id'=>"$document->_id"
            ]);
            $fc++;
            if ($fc >= $size) {
                break;
            }
        }
        if (isset($begin_id)){
            $list = array_reverse($list) ;
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

    }else{
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

}
else
{
    if ($_GET['tool'] == "list")
    {
        $res = array(
            'dx'=>"OK",
        );
    }else{
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

}
echo json_encode($res,JSON_UNESCAPED_UNICODE);
//gacha_type:301=角色1 302=武器 100=新手 200=常驻 400=角色2
?>