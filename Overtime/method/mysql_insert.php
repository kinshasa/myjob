<?php

/*
 * Overtime beta1.0 
 * Used by SRC-G S/W 2Gourp 4Part
 * Overtime Tables
 * Edit by shaob.liu@samsung.com
 * Donation:https://me.alipay.com/liushaobo
 */
include_once 'head.php';

$name = $_POST["name"];
$genid = $_POST["genid"];
$date = $_POST["date"];
$type = $_POST["type"];
$from = $_POST["from"];
$end = $_POST["end"];
$mimutes = $_POST["mimutes"];
$reason = $_POST["reason"];
$time_c = $_POST["time_c"];
$time_l = $_POST["time_l"];
$ot_type = $_POST["ot_type"];

$con = mysql_connect("localhost:3306", "root", "cercis");
if (!$con) {
    //die('Could not connect: ' . mysql_error());
    mysql_close($con);
    exit(1);
}
mysql_select_db("applicationdb", $con);
/*
 * 创建当前日期的表$mysql_tablename，存储当前日期的提交表格 
 * 首先添加到 $genid_tablename
 * 其次计算该用户当月、上月申请加班时间和实际加班时间，上次和当天加班时间
 * 最后添加到 $date_tablename
 * 如果$date_tablename未创建，则创建$mysql_create_datetable
 */

if ($ot_type == "1") {
    $date_tablename = "ot_" . MYSQL_WORKSHEET1 . "_" . CURRENT_DATE . "_data";
} else
if ($ot_type == "2") {
    $date_tablename = "ot_" . MYSQL_WORKSHEET2 . "_" . CURRENT_DATE . "_data";
} else {
    die("数据错误，请联系管理员[error code:0x001]");
    exit(1);
}
/*
 * 判断登录成功
 */
$password = $_POST["password"];
$mysql_login = "
SELECT *
FROM `applicationdb`.`overtime_user`
WHERE ( `genid`= '" . $genid . "' and `password` ='" . $password . "' );
";
if (!mysql_query($mysql_login)) {
    die('Login failed . Could not connect: ' . mysql_error());
    mysql_close($con);
    echo FALSE;
    exit(1);
}


/*
 * $mysql_insert_usertable
 * 从个人加班统计表中计算本月已申请加班时间，上月申请加班时间，然后再insert
 */

$genid_tablename = "ot_" . $genid . "_data";


$l_actual_hours = "1";
$c_actual_hours = "1";


$mysql_insertgenidtable = "
    INSERT INTO  `applicationdb`.`" . $genid_tablename . "`
         (
             `genid`, `name`, `work_date`, `daytype`,`time_from`,
             `time_end`, `work_minutes`, `work_reason`, `monthc_hours`,`monthl_hours`,
             `l_actual_hours`, `c_actual_hours`, `ot_type`, `infor`
          )
    VALUES
        (
          '" . $genid . "', '" . $name . "', '" . $date . "', '" . $type . "', '" . $from . "',
          '" . $end . "', '" . $mimutes . "', '" . $reason . "', '" . $time_c . "', '" . $time_l . "',
          '" . $l_actual_hours . "', '" . $c_actual_hours . "', '" . $ot_type . "','" . $name . "'
        );    
";

//echo 'mysql_query($mysql_insertgenidtable) success';
$mysql_insert_datetable = "
    INSERT INTO `applicationdb`.`" . $date_tablename . "` 
        (
            `genid`, `name`, `work_date`, `daytype`, `time_from`,
            `time_end`, `work_minutes`, `work_reason`, `monthc_hours`, `monthl_hours`,
            `l_actual_hours`, `c_actual_hours`, `ot_type`,`infor`
        )
    VALUES
        (
          '" . $genid . "', '" . $name . "', '" . $date . "', '" . $type . "', '" . $from . "',
          '" . $end . "', '" . $mimutes . "', '" . $reason . "', '" . $time_c . "', '" . $time_l . "',
          '" . $l_actual_hours . "', '" . $c_actual_hours . "', '" . $ot_type . "','" . $name . "'
        );
";
/*
  exit(1);
  mysql_close($con);

  if (!mysql_query($mysql_create_datetable)) {
  die('$mysql_create_datetable Could not connect: ' . mysql_error());
  } else {
  echo '123';
  } */
if (!mysql_query($mysql_insert_datetable)) {
    die('$mysql_insert_datetable Could not connect: ' . mysql_error());
    mysql_close($con);
    exit(1);
}
if (!mysql_query($mysql_insertgenidtable)) {
    die('$mysql_insertgenidtable Could not connect: ' . mysql_error());
    exit(1);
}
echo FALSE;
mysql_close($con);
?>
