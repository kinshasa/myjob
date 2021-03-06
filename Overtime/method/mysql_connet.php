<?php

# <#assign licenseFirst = "/* ">
# <#assign licenseLast = " */">
# <#include "../Licenses/license-${project.license}.txt">
#<#assign licensePrefix = " * ">
#
/*
 * Overtime beta1.0 
 * Used by SRC-G S/W 2Gourp 4Part
 * Overtime Tables
 * Edit by shaob.liu@samsung.com
 * Donation:https://me.alipay.com/liushaobo
 */

$con = mysql_connect("localhost:3306", "root", "cercis");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
if (!mysql_query("CREATE DATABASE applicationdb", $con)) {
    echo "Error creating database: " . mysql_error();
}
/*
try {
    mysql_query("CREATE DATABASE applicationdb", $con);
    echo "create db success;";
} catch (Exception $e) {
    echo $e . "<br/>";
    die('Error creating database: ' . mysql_error());
}*/
$sql = "
    CREATE  TABLE `applicationdb`.`overtime_user` (
        `gid` INT NOT NULL AUTO_INCREMENT COMMENT '自动编号' ,
        `genid` INT UNSIGNED NOT NULL COMMENT '员工号' ,
        `name` VARCHAR(45) NOT NULL COMMENT '员工姓名' ,
        `password` VARCHAR(45) NOT NULL COMMENT '密码' ,
        `single` VARCHAR(45) NOT NULL COMMENT 'singleID' ,
        `pcip` VARCHAR(45) NOT NULL DEFAULT '0.0.0' COMMENT 'pcip' ,
        `email` VARCHAR(45) NOT NULL COMMENT 'hr.sgmc@samsung.com' ,
        /*`register_date` DATETIME NOT NULL DEFAULT NOW() COMMENT 'create date' ,*/
        `register_date` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `role` INT DEFAULT '1' COMMENT '备注' ,	
        `infor` TEXT NULL COMMENT '备注' ,
        PRIMARY KEY (`gid`) ,
        UNIQUE INDEX `genid_UNIQUE` (`genid` ASC) ,
        UNIQUE INDEX `single_UNIQUE` (`single` ASC) ,
        UNIQUE INDEX `email_UNIQUE` (`email` ASC) 
      );

";

/*try {
    mysql_query($sql);
    echo "create table success;";
} catch (Exception $e) {
    echo $e . "<br/>";
    die('Error creating table: ' . mysql_error());
}*/
if (!mysql_query($sql)) {
    echo "Error creating database: " . mysql_error();
}

mysql_close($con);
?>
