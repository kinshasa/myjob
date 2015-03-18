<?php

/*
 * Overtime beta1.0 
 * Used by SRC-G S/W 2Gourp 4Part
 * Overtime Tables
 * Edit by shaob.liu@samsung.com
 * Donation:https://me.alipay.com/liushaobo
 */
/*
 * 下载某个日期的数据
 * 传入date，获取date对应的表
 * 下载表的数据
 * 
 */
include_once 'head.php';
$con = mysql_connect("localhost:3306", "root", "cercis");
if (!$con) {
    die('Could not connect: ' . mysql_error());
    mysql_close($con);
    exit(1);
}
mysql_select_db("applicationdb", $con);
$date = $_POST["date"];
$ot_type = $_GET["ot_type"];
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
$genid = $_POST["genid"];
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


$mysql_get_datetable = "
SELECT *
FROM `applicationdb`.`" . $date_tablename . "`
";
if (!$result = mysql_query($mysql_get_datetable)) {
    die('Could not connect: ' . mysql_error());
    mysql_close($con);
    exit(1);
}

/*
 * 直接写入exlx文件
 * 首先创建文件，有则覆盖
 * 然后写入数据库返回的信息
 */
global $title;
global $file_type;
global $file_fullname;
global $sheet_column;
global $sheet_first;
global $sheet_second;
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("shaob.liu");
$objPHPExcel->getProperties()->setLastModifiedBy("setLastModifiedBy");
$objPHPExcel->getProperties()->setTitle($title);
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Overtime Document");
$objPHPExcel->getProperties()->setDescription("Overtime document for Office 2007 XLSX, generated using PHP classes.");
$objPHPExcel->setActiveSheetIndex(0);
//设置行宽

$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);


/*
  //E 列为文本
  $objPHPExcel->getActiveSheet()->getStyle('E')->getNumberFormat()
  ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
  //第三行为文本
  $objPHPExcel->getActiveSheet()->getStyle('3')->getNumberFormat()
  ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

 * 
 */
$objPHPExcel->getActiveSheet()->getStyle("C")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
$objPHPExcel->getActiveSheet()->getStyle("E")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
$objPHPExcel->getActiveSheet()->getStyle("F")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
$objPHPExcel->getActiveSheet()->getStyle("G")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

$i = 0; /* 列数 */
$k = 1; /* 行数-1 */
//print_r($sheet_first);
foreach ($sheet_first as $value) {
    $objPHPExcel->getActiveSheet()->SetCellValue($sheet_column[$i] . $k, $value);
    $i++;
}
$k++;
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $j = 0;
    /* foreach ($row as $value) {
      print_r($row);
      $objPHPExcel->getActiveSheet()->SetCellValue($sheet_column[$j] . $k, $value);
      $j++;
      } */
    // print_r($row);
    $objPHPExcel->getActiveSheet()->SetCellValue("A" . $k, $row["name"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("B" . $k, $row["genid"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("C" . $k, $row["work_date"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("D" . $k, $row["daytype"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("E" . $k, $row["time_from"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("F" . $k, $row["time_end"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("G" . $k, $row["work_minutes"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("H" . $k, $row["work_reason"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("I" . $k, $row["monthc_hours"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("J" . $k, $row["monthl_hours"]);
    $k++;
}
mysql_close($con);
$objPHPExcel->getActiveSheet()->setTitle("templete");
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save(iconv("UTF-8", "GB2312//ignore", FILE_FULLNAME_FIRST));
print_r($row);
echo FILE_FULLNAME_FIRST;
?>
