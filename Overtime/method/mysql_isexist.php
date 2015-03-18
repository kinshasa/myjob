<?php

/*
 * Overtime beta1.0 
 * Used by SRC-G S/W 2Gourp 4Part
 * Overtime Tables
 * Edit by shaob.liu@samsung.com
 * Donation:https://me.alipay.com/liushaobo
 */


/*
 * 用户检查或者提交加班数据的时候都会调用mysql_check.php
 * 如果已经有$date_tablename则查看该用户$genid是否已经提交当天加班数据
 * 否则创建当天加班统计表$date_tablename
 * TRUE 表示为没有提交数据
 * 否则，已提交数据，给用户发出警告
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
$work_date = $_POST["work_date"];
$ot_type = $_POST["ot_type"];
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

$date_tablename = "ot_" . MYSQL_WORKSHEET1 . "_" . CURRENT_DATE . "_data";
$mysql_create_datetable = "
    CREATE  TABLE `applicationdb`.`" . $date_tablename . "` (
        
        `gid` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'gid：自动加1' ,
        `genid` INT UNSIGNED NOT NULL COMMENT '个人ID' ,
        `name` VARCHAR(45) NOT NULL COMMENT '姓名' ,
        `work_date` INT NOT NULL COMMENT '日期(eg：20121218)' ,
        `daytype` INT UNSIGNED NOT NULL COMMENT '勤态星期代码' ,
        `time_from` INT UNSIGNED NOT NULL COMMENT '计划开始时间' ,
        `time_end` INT UNSIGNED NOT NULL COMMENT '计划完了时间' ,
        `work_minutes` INT UNSIGNED NOT NULL COMMENT '计划加班时间' ,
        `work_reason` TEXT NOT NULL COMMENT '加班事由其他' ,
        `monthc_hours` INT UNSIGNED NOT NULL COMMENT '本月已申请加班时间（h）' ,
        `monthl_hours` INT UNSIGNED NOT NULL COMMENT '上月实际加班时间（h）' ,
        `l_actual_hours` INT UNSIGNED ZEROFILL NULL COMMENT '上次实际加班时间（h）' ,
        `c_actual_hours` INT UNSIGNED ZEROFILL NULL COMMENT '当天实际加班时间（h）' ,
        /*`insert_date` DATETIME NOT NULL DEFAULT NOW() COMMENT 'insert date' ,*/
        `insert_date` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `ot_type` INT NULL COMMENT '加班类型：一次，二次' ,
        `infor` TEXT NULL COMMENT '备注' ,
        UNIQUE INDEX `genid_UNIQUE` (`genid` ASC) ,
        UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
        PRIMARY KEY (`genid`) ,
        UNIQUE INDEX `gid_UNIQUE` (`gid` ASC) 
        
    );
";
/*
 * 判断datetable是否存在
 *
 */
try {
    mysql_query($mysql_create_datetable);
} catch (Exception $e) {
    echo $e . "<br/>";
    die('$mysql_create_datetable Could not connect: ' . mysql_error());
}
$genid_tablename = "ot_" . $genid . "_data";
$mysql_isexist = "
SELECT *
FROM `applicationdb`.`" . $genid_tablename . "`
WHERE ( `work_date`= '" . $work_date . "' and `ot_type` ='" . $ot_type . "' );
";
/*
 * 查看是否已经提交数据
 * TRUE 表示为没有提交数据
 * 否则，已提交数据，给用户发出警告
 */
if (!$result = mysql_query($mysql_isexist)) {
    echo TRUE;
}
mysql_close($con);
?>
