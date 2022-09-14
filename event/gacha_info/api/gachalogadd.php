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
                mysqli_commit($mysql);
                echo "插入成功！请求时间:$gettime,共插入一条数据 <br> 名字:$name,authkey:$authkey,物品类型:$item_type,时间:$time,gacha_type:$gacha_type,uid:$uid";
            }elseif($quantity < 0){
                echo "正在插入数据中...请稍后！<br>";
                for ($fc = 0;$fc <= -$quantity; $fc++ ){
                    $sql = "INSERT INTO gacha (authkey, item_type,rank_type,name,time,gacha_type,uid)VALUES ('$authkey', '$item_type', '$rank_type' ,'$name','$time','$gacha_type','$uid')";
                    mysqli_query($mysql, $sql);
                }
                mysqli_commit($mysql);
                echo "插入成功！请求时间:$gettime,五星为 <br> 名字:$name,authkey:$authkey,物品类型:$item_type,时间:$time,gacha_type:$gacha_type,uid:$uid ,共插入". -$quantity ."次";
            } else{
                echo "正在插入数据中...请稍后！<br>";
                for ($fc = 0;$fc <= $quantity - 1; $fc++ ){
                    $sql = "INSERT INTO gacha (authkey, item_type,rank_type,name,time,gacha_type,uid)VALUES ('$authkey', '武器', '3' ,'黑缨枪','$time','$gacha_type','$uid')";
                    mysqli_query($mysql, $sql);
                }
                $sql = "INSERT INTO gacha (authkey, item_type,rank_type,name,time,gacha_type,uid)VALUES ('$authkey', '$item_type', '$rank_type' ,'$name','$time','$gacha_type','$uid')";
                mysqli_query($mysql, $sql);
                //提交数据
                mysqli_commit($mysql);
                echo "插入成功！请求时间:$gettime,共插入$quantity 条数据，其中五星为 <br> 名字:$name,authkey:$authkey,物品类型:$item_type,时间:$time,gacha_type:$gacha_type,uid:$uid";
            }

        }
        mysqli_close($mysql);
    }

}