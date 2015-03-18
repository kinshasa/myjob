<?php

/*
 * Overtime beta1.0 
 * Used by SRC-G S/W 2Gourp 4Part
 * Overtime Tables
 * Edit by shaob.liu@samsung.com
 * Donation:https://me.alipay.com/liushaobo
 */

/*
 * 用户登录时
 * FALSE为登录失败
 * 否则返回个人信息数据
 * 
 */

$genid = $_POST["genid"];
$password = $_POST["password"];
if (!$genidlg && $passwordlg) {
    echo FALSE;
    exit(1);
}
$con = mysql_connect("localhost:3306", "root", "cercis");
if (!$con) {
    //die('Could not connect: ' . mysql_error());
    mysql_close($con);
    echo FALSE;
    exit(1);
}

mysql_select_db("applicationdb", $con);
$mysql_login = "
SELECT *
FROM `applicationdb`.`overtime_user`
WHERE ( `genid`= '" . $genid . "' and `password` ='" . $password . "' );
";

if (!$result = mysql_query($mysql_login)) {
    //die('Could not connect: ' . mysql_error());
    mysql_close($con);
    echo FALSE;
    exit(1);
}
if ($row = mysql_fetch_array($result)) {
    echo $row['genid'] . "~" . $row['name'] . "~" . $row['single'] . "~" . $row['pcip'];
} else {
    echo FALSE;
}

mysql_close($con);
?>
