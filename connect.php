<?php

$host = "10.151.110.164";
$db_user = "F1684914";
$db_pass = "ilovefoxconn";
$db_name = "f1684914";
$timezone = "Asia/Shanghai";

$link = mysqli_connect($host, $db_user, $db_pass, $db_name);
mysqli_query($link, "SET NAMES 'UTF8'");

$GLOBALS['link'] = $link;
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set($timezone); //北京时间

