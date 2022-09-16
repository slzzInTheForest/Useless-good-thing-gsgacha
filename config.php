<?php
//数据库配置(只支持mysql)
$servername = "";//数据库地址，为本机可填:localhost
$username = "";//数据库用户名
$password = "";//数据库密码
$dbname = "";//数据库名字

//祈愿记录配置
$eauthkey = "";//"留空"、"false"将采用请求中的authkey，否则将采用这里填入的文本！

//关于cdkey配置
$Case_sensitive = "false" ; // true为区分、false为不区分、留空为不区分
$cdkey12 = "true" ; //cdkey为12位时提交到官方服务器（官方兑换码大多为12位),true开启，其他内容均为关闭

//部分操作密码（防止被恶意操作，留空为不设置)
$key = "";