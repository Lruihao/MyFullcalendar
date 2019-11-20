<?php
include_once('connect.php');//连接数据库

$action = $_GET['action'];
if ($action == 'add') {
    $starttime = 0;
    $endtime = 0;
    $events = stripslashes(trim($_POST['event']));//事件内容
    $events = mysqli_real_escape_string($link, strip_tags($events)); //过滤HTML标签，并转义特殊字符

    $isallday = empty($_POST['isallday']) ? 0 : $_POST['isallday'];//是否是全天事件
    $isend = empty($_POST['isend']) ? 0 : $_POST['isend'];//是否有结束时间

    $startdate = empty($_POST['startdate']) ? 0 : trim($_POST['startdate']);//开始日期
    $enddate = empty($_POST['enddate']) ? 0 : trim($_POST['enddate']);//结束日期

    $s_time = $_POST['s_hour'] . ':' . $_POST['s_minute'] . ':00';//开始时间
    $e_time = $_POST['e_hour'] . ':' . $_POST['e_minute'] . ':00';//结束时间

    if ($isallday == 1 && $isend == 1) {
        $starttime = strtotime($startdate);
        $endtime = strtotime($enddate);
    } elseif ($isallday == 1 && $isend == "") {
        $starttime = strtotime($startdate);
    } elseif ($isallday == "" && $isend == 1) {
        $starttime = strtotime($startdate . ' ' . $s_time);
        $endtime = strtotime($enddate . ' ' . $e_time);
    } else {
        $starttime = strtotime($startdate . ' ' . $s_time);
    }

    $colors = array("#360", "#f30", "#06c");
    $key = array_rand($colors);
    $color = $colors[$key];

    $isallday = $isallday ? 1 : 0;
    $query = mysqli_query($link, "insert into `calendar` (`title`,`starttime`,`endtime`,`allday`,`color`) values ('$events','$starttime','$endtime','$isallday','$color')");
    if (mysqli_insert_id($link) > 0) {
        echo '1';
    } else {
        echo '写入失败！';
    }
} elseif ($action == "edit") {
    $id = intval($_POST['id']);
    if ($id == 0) {
        echo '事件不存在！';
        exit;
    }
    $starttime = 0;
    $endtime = 0;
    $events = stripslashes(trim($_POST['event']));//事件内容
    $events = mysqli_real_escape_string($link, strip_tags($events)); //过滤HTML标签，并转义特殊字符

    $isallday = empty($_POST['isallday']) ? 0 : $_POST['isallday'];//是否是全天事件
    $isend = empty($_POST['isend']) ? 0 : $_POST['isend'];//是否有结束时间

    $startdate = empty($_POST['startdate']) ? 0 : trim($_POST['startdate']);//开始日期
    $enddate = empty($_POST['enddate']) ? 0 : trim($_POST['enddate']);//结束日期

    $s_time = $_POST['s_hour'] . ':' . $_POST['s_minute'] . ':00';//开始时间
    $e_time = $_POST['e_hour'] . ':' . $_POST['e_minute'] . ':00';//结束时间

    if ($isallday == 1 && $isend == 1) {
        $starttime = strtotime($startdate);
        $endtime = strtotime($enddate);
    } elseif ($isallday == 1 && $isend == "") {
        $starttime = strtotime($startdate);
        $endtime = 0;
    } elseif ($isallday == "" && $isend == 1) {
        $starttime = strtotime($startdate . ' ' . $s_time);
        $endtime = strtotime($enddate . ' ' . $e_time);
    } else {
        $starttime = strtotime($startdate . ' ' . $s_time);
        $endtime = 0;
    }

    $isallday = $isallday ? 1 : 0;
    mysqli_query($link, "update `calendar` set `title`='$events',`starttime`='$starttime',`endtime`='$endtime',`allday`='$isallday' where `id`='$id'");
    if (mysqli_affected_rows($link) == 1) {
        echo '1';
    } else {
        echo '出错了！';
    }
} elseif ($action == "del") {
    $id = intval($_POST['id']);
    if ($id > 0) {
        mysqli_query($link,"delete from `calendar` where `id`='$id'");
        if (mysqli_affected_rows($link) == 1) {
            echo '1';
        } else {
            echo '出错了！';
        }
    } else {
        echo '事件不存在！';
    }
} else {

}
?>