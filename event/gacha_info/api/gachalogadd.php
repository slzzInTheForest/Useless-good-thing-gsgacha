<?php
include ('../../../config.php');
$gettime = date("Y/m/d H:i:s");
if ( $_GET['key'] == $key || $key == ""){
    //连接数据库
    $mysql=mysqli_connect($servername, $username, $password, $dbname);
    //关闭自动提交
    mysqli_autocommit($mysql,FALSE);
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    } else{
        $authkey = $_GET['authkey'];
        $item_type = $_GET['item_type'];
        $rank_type = $_GET['rank_type'];
        $name = $_GET['name'];
        $time = $_GET['time'];
        $gacha_type = $_GET['gacha_type'];
        $uid = $_GET['uid'];
        $quantity = $_GET['quantity'];
        //为什么写这么多if？不知道写什么写多点有逼格！
        if ($authkey == "") {
            echo "authkey不得为空";
        }elseif ($item_type == ""){
            echo "item_type不得为空";
        }elseif ($rank_type == ""){
            echo "rank_type不得为空";
        }elseif ($name == ""){
            echo "name不得为空";
        }elseif ($gacha_type == ""){
            echo "gacha_type不得为空";
        }elseif ($uid == ""){
            echo "uid不得为空";
        }else {
            if ($time == ""){
                $time = date("Y-m-d H:i:s");
            }if ($quantity == 0 || $quantity == "" || is_numeric($quantity) != 1){
                $sql = "INSERT INTO gacha (authkey, item_type,rank_type,name,time,gacha_type,uid)VALUES ('$authkey', '$item_type', '$rank_type' ,'$name','$time','$gacha_type','$uid')";
                mysqli_query($mysql, $sql);
                //提交数据
                mysqli_commit($mysql);
            }elseif($quantity < 0){
                for ($fc = 1;$fc <= -$quantity; $fc++ ){
                    $sql = "INSERT INTO gacha (authkey, item_type,rank_type,name,time,gacha_type,uid)VALUES ('$authkey', '$item_type', '$rank_type' ,'$name','$time','$gacha_type','$uid')";
                    mysqli_query($mysql, $sql);
                }
                //提交数据
                mysqli_commit($mysql);
            } else{
                for ($fc = 0;$fc <= $quantity - 1; $fc++ ){
                    $sql = "INSERT INTO gacha (authkey, item_type,rank_type,name,time,gacha_type,uid)VALUES ('$authkey', '武器', '3' ,'黑缨枪','$time','$gacha_type','$uid')";
                    mysqli_query($mysql, $sql);
                }
                $sql = "INSERT INTO gacha (authkey, item_type,rank_type,name,time,gacha_type,uid)VALUES ('$authkey', '$item_type', '$rank_type' ,'$name','$time','$gacha_type','$uid')";
                mysqli_query($mysql, $sql);
                //提交数据
                mysqli_commit($mysql);
            }
            $res = array(
                'message'=>"OK",
                'time'=>"$gettime",
                'frequency'=>"$quantity",
                'name'=>"$name",
                'authkey'=>"$authkey",
                'item_type'=>"$item_type",
                'gacha_type'=>"$gacha_type",
                'uid'=>"$uid",
            );
            echo json_encode($res,JSON_UNESCAPED_UNICODE);
        }
        mysqli_close($mysql);
    }

}