<?php
//数据库使用,可选:0为mysql,1为mongodb
//若使用mongodb，则不支持gachalogadd和cdkey定义！
$use_db = 1 ;

//数据库配置(mysql)
$servername = "127.0.0.1";//数据库地址，为本机可填:localhost
$username = "";//数据库用户名
$password = "";//数据库密码
$dbname = "";//数据库名字
//mongodb(可搭配gc)mongodb需要php7.x并且安装mongodb拓展才行！
$mongo_servername = "localhost";//数据库地址，为本机可填:localhost
$mongo_port = 27017 ;//数据库端口
$mongo_dbname = "grasscutter";//数据库名字
$itemid_filename = 'item_book.json' ;
//格式为json,角色需填入星级"id":"名字:星级",四星可忽略，武器根据id自动判断！
$mongo_username = "";//数据库用户名,没有密码无需用户名,请留空
$mongo_password = "";//数据库密码,没有密码请留空

//祈愿记录配置
$eauthkey = "1";//"留空"、"false"将采用请求中的authkey，否则将采用这里填入的文本！
$m_uid = 1 ;//若使用MongoDB,这里需要填入uid!

//关于cdkey配置
$cdkey_dp = "false";//true则自动提交指定兑换码,将覆盖下方配置!(例如前瞻,没啥用无聊写的有,批量使用有更好的工具,需要请自行去/common/apicdkey/api/exchangeCdkey设置)
$Case_sensitive = "false" ; // true为区分、false为不区分、留空为不区分
$cdkey12 = "true" ; //true:开启cdkey为12位时提交到官方服务器（官方兑换码大多为12位)
//false:关闭提交功能

//部分操作密码（防止被恶意操作，留空为不设置)
$key = "";