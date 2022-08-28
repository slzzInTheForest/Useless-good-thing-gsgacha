<?php
//数据库配置
$servername = "";//数据库地址，为本机可填:localhost
$username = "";//数据库用户名
$password = "";//数据库密码
$dbname = "";//数据库名字

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 使用 sql 创建数据表
$sql = "CREATE TABLE gacha (
id varchar(255), 
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

if ($conn->query($sql) === TRUE) {
    echo "创建成功！";
} else {
    echo "创建数据表错误: " . $conn->error;
}

$conn->close();
