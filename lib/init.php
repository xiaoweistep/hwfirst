<?php
/*
--------
配置文件
--------
*/
//改编码
header("Content-type:text/html;charset=utf-8");
//session启动
session_start();
//设定时区为中国
date_default_timezone_set('PRC');

//常量定义
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','root');
define('DBBASE','hwfirst');

//加载函数库
include('common.fun.php');
include('db.fun.php');
include('img.fun.php');