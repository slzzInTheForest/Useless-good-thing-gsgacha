<?php
include ('./config.php');

if ($_GET['key'] == $key || $key == ""){
    // 创建连接
    $mysql = new mysqli($servername, $username, $password, $dbname);
    // 检测连接
    if ($mysql->connect_error) {
        die("连接失败: " . $mysql->connect_error);
    }
    // 使用 sql 创建数据表
    $sql = "CREATE TABLE gacha (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        authkey varchar(255),
        item_type varchar(255),
        rank_type varchar(255),
        name varchar(255),
        time varchar(255),
        gacha_type varchar(255),
        uid varchar(255),
        lang varchar(255),
        count varchar(255),
        item_id varchar(255)
        )";
    if ($mysql->query($sql) === TRUE) {
        echo "创建成功！";
    } elseif($mysql->error == "Table 'gacha' already exists"){
        echo "数据表已存在！";
    } else {
        echo "创建数据表错误: " . $mysql->error;
    }
    //直接复制一份得了
    $sql = "CREATE TABLE cdkey (
        cdkey varchar(255),
        msg varchar(255),
        retcode varchar(255)
        )";
    $mysql->query($sql);
    $mysql->close();
}

