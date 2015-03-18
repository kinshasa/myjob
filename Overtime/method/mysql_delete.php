<?php

/*
 * Overtime beta1.0 
 * Used by SRC-G S/W 2Gourp 4Part
 * Overtime Tables
 * Edit by shaob.liu@samsung.com
 * Donation:https://me.alipay.com/liushaobo
 */
include_once 'head.php';
$con = mysql_connect("localhost:3306", "root", "cercis");
if (!$con) {
    //die('Could not connect: ' . mysql_error());
    mysql_close($con);
    echo FALSE;
    exit(1);
}
mysql_select_db("applicationdb", $con);

$genid = $_POST["genid"];
$date = $_POST["date"];
$ot_type = $_POST["ot_type"];


if ($ot_type == "1") {
    $date_tablename = "ot_" . MYSQL_WORKSHEET1 . "_" . $date . "_data";
} else
if ($ot_type == "2") {
    $date_tablename = "ot_" . MYSQL_WORKSHEET2 . "_" . $date . "_data";
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
    die('Login failed .Could not connect: ' . mysql_error());
    mysql_close($con);
    echo FALSE;
    exit(1);
}
/*
 * $date_tablename删除
 */
$mysql_delete_datetable = "
DELETE FROM 
`applicationdb`.`" . $date_tablename . "`
 WHERE 
`genid`='" . $genid . "'AND `work_date`='" . $date . "'
;
";
if (!mysql_query($mysql_delete_datetable)) {
    echo "$mysql_delete_datetable";
    die('Could not connect: ' . mysql_error());
    mysql_close($con);
    echo FALSE;
}
/*
 * $genid_tablename删除
 */
$genid_tablename = "ot_" . $genid . "_data";
$mysql_delete_gentable = "
DELETE FROM 
`applicationdb`.`" . $genid_tablename . "`
 WHERE 
`genid`='" . $genid . "'AND `work_date`='" . $date . "'
;
";

if (!mysql_query($mysql_delete_gentable)) {
    echo "$mysql_delete_gentable";
    die('Could not connect: ' . mysql_error());
    mysql_close($con);
    echo FALSE;
}
echo '删除干净';
?>
