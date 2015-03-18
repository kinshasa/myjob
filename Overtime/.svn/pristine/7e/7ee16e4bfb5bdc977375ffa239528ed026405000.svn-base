<?php

/**
 * Edit by shaob.liu@samsung.com 
 * Creat Excel
 * */
header("Content-Type: text/html;charset=utf-8");

/** Error reporting */
error_reporting(E_ALL);

/** Include path * */
ini_set('include_path', ini_get('include_path') . ';../Classes/');

/** PHPExcel */
include 'PHPExcel.php';
include 'head.php';
/** PHPExcel_Writer_Excel2007 */
include 'PHPExcel/Writer/Excel2007.php';

// Create new PHPExcel object
//echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

// Set properties
//echo date('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator("shaob.liu");
$objPHPExcel->getProperties()->setLastModifiedBy("setLastModifiedBy");
$objPHPExcel->getProperties()->setTitle($title);
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Overtime Document");
$objPHPExcel->getProperties()->setDescription("Overtime document for Office 2007 XLSX, generated using PHP classes.");



// Add some data
//echo date('H:i:s') . " Add some data\n";
$objPHPExcel->setActiveSheetIndex(0);
//设置行宽
$objPHPExcel->getActiveSheet()->getColumnDimension( 'C')->setWidth(10);   
$objPHPExcel->getActiveSheet()->getColumnDimension( 'D')->setWidth(15);   
$objPHPExcel->getActiveSheet()->getColumnDimension( 'E')->setWidth(15);   
$objPHPExcel->getActiveSheet()->getColumnDimension( 'F')->setWidth(15);   
$objPHPExcel->getActiveSheet()->getColumnDimension( 'G')->setWidth(15);   
$objPHPExcel->getActiveSheet()->getColumnDimension( 'H')->setWidth(40);  
$objPHPExcel->getActiveSheet()->getColumnDimension( 'I')->setWidth(25);  
$objPHPExcel->getActiveSheet()->getColumnDimension( 'J')->setWidth(25);  
$objPHPExcel->getActiveSheet()->SetCellValue('A1', '姓名');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', '个人ID');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', '日期');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', '勤态星期代码');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', '计划开始时间');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', '计划完了时间');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', '计划加班时间');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', '加班事由其他');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', '本月已申请加班时间（h）');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', '上月实际加班时间（h）');

// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle("templete");


// Save Excel 2007 file
//echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$objWriter->save($file_fullname);

// Echo done
echo $file_fullname . "  。Done writing file.\r\n";
?>
