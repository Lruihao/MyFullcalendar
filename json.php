<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2017/6/15
 * Time: 10:27
 */

include_once('connect.php');//连接数据库

$sql = "select * from calendar";
$query = mysqli_query($link, $sql);
while ($row = mysqli_fetch_array($query)) {
    $allday = $row['allday'];
    $is_allday = $allday == 1 ? true : false;

    $data[] = array(
        'id' => $row['id'],//事件id
        'title' => $row['title'],//事件标题
        'start' => date('Y-m-d H:i', $row['starttime']),//事件开始时间
        'end' => date('Y-m-d H:i', $row['endtime']),//结束时间
        'allDay' => $is_allday, //是否为全天事件
        'color' => $row['color'] //事件的背景色
    );
}
echo json_encode($data);
