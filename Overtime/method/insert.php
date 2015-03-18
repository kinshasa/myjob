<?php

/**
 * Edit by shaob.liu@samsung.com 
 * Insert Excel
 * */
header("Content-Type: text/html;charset=utf-8");

//$php_excel_obj = new PHPExcel(); 
/** Error reporting */
//error_reporting(E_ALL);

/** Include path * */
ini_set('include_path', ini_get('include_path') . ';../Classes/');

/** PHPExcel */
include 'head.php';

/** PHPExcel_Writer_Excel2007 */
//read excel file;
$php_reader = new PHPExcel_Reader_Excel2007();
if (!$php_reader->canRead($file_fullname)) {
    $php_reader = new PHPExcel_Reader_Excel5();
    if (!$php_reader->canRead($file_fullname)) {
        echo'NO Excel!';
    } else {
        echo'PHPExcel_Reader_Excel5<br/>';
    }
} else {
    echo'PHPExcel_Reader_Excel2007<br/>';
}
$php_excel_obj = $php_reader->load($file_fullname);
$current_sheet = $php_excel_obj->getSheet(0);

//Get Post data
$user1 = $_REQUEST['user1'];
$user2 = $_REQUEST['user2'];
$user3 = $_REQUEST['user3'];
$user4 = $_REQUEST['user4'];
$user5 = $_REQUEST['user5'];
$user6 = $_REQUEST['user6'];
$user7 = $_REQUEST['user7'];
$user8 = $_REQUEST['user8'];
$user9 = $_REQUEST['user9'];
$user10 = $_REQUEST['user10'];

// Add some data
$objWriter = new PHPExcel_Writer_Excel2007($php_excel_obj);
$php_excel_obj->setActiveSheetIndex(0);

// Get properties
$all_column = $current_sheet->getHighestColumn();
$all_row = $current_sheet->getHighestRow();
$all_row+=1;

//$php_excel_obj->getActiveSheet()->SetCellValue('A' . $all_row, $user1); //'.$all_row
$php_excel_obj->getActiveSheet()->SetCellValue('A' . $all_row, $user1); //'.$all_row
$php_excel_obj->getActiveSheet()->SetCellValue('B' . $all_row, $user2);
$php_excel_obj->getActiveSheet()->setCellValueExplicit('C' . $all_row, $user3, PHPExcel_Cell_DataType::TYPE_STRING);
$php_excel_obj->getActiveSheet()->SetCellValue('D' . $all_row, $user4);
$php_excel_obj->getActiveSheet()->setCellValueExplicit('E' . $all_row, $user5, PHPExcel_Cell_DataType::TYPE_STRING);
$php_excel_obj->getActiveSheet()->setCellValueExplicit('F' . $all_row, $user6, PHPExcel_Cell_DataType::TYPE_STRING);
$php_excel_obj->getActiveSheet()->setCellValueExplicit('G' . $all_row, $user7, PHPExcel_Cell_DataType::TYPE_STRING);
$php_excel_obj->getActiveSheet()->SetCellValue('H' . $all_row, $user8);
$php_excel_obj->getActiveSheet()->SetCellValue('I' . $all_row, $user9);
$php_excel_obj->getActiveSheet()->SetCellValue('J' . $all_row, $user10);
$objWriter->save($file_fullname); //save( 'php://output');
//echo $all_column . '    .    ' . $all_row . '<br/>';
//read data to c_arr[]
$c_arr = array();
//字符对照表   {
echo '<table border="1">';
for ($r_i = 1; $r_i <= $all_row; $r_i++) {
    echo '<tr>';
    for ($c_i = 'A'; $c_i <= $all_column; $c_i++) {
        $adr = $c_i . $r_i;
        $value = $current_sheet->getCell($adr)->getValue();
        //if ($c_i == 'A' && empty($value))
        if (is_object($value))
            $value = $value->__toString();
        echo '<td>' . $value . '</td>';
        $c_arr[$c_i] = $value;
    }
    echo '</tr>';
}
echo '<br/>';
exit(1);

// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle($title);

// echo date('D, d M Y H:i:s', time()) . ': F:\SGMC SW 2 Group 4 Part Overtime 1th xls_' . '201206' . '.xlsx  ' . " Done writing file.\r\n";
?>