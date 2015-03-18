<?php

/*
 * Overtime beta1.0 
 * Used by SRC-G S/W 2Gourp 4Part
 * Overtime Tables
 * Edit by shaob.liu@samsung.com
 * Donation:https://me.alipay.com/liushaobo
 */
header("Content-Type: text/html;charset=utf-8");

/** Error reporting */
//error_reporting(E_ALL);

/** Include path * */

/** PHPExcel */
//include 'PHPExcel.php';
include 'head.php';
/** PHPExcel_Writer_Excel2007 */
//include 'PHPExcel/Writer/Excel2007.php';


//read excel file;
$php_reader = new PHPExcel_Reader_Excel2007();
if (!$php_reader->canRead(FILE_FULLNAME_FIRST)) {
    $php_reader = new PHPExcel_Reader_Excel5();
    if (!$php_reader->canRead(FILE_FULLNAME_FIRST)) {
        echo'NO Excel!';
    }
}
$php_excel_obj = $php_reader->load(FILE_FULLNAME_FIRST);
$current_sheet = $php_excel_obj->getSheet(0);


// Get properties
$all_column = $current_sheet->getHighestColumn();
$all_row = $current_sheet->getHighestRow();
//echo $all_column . '    .    ' . $all_row . '<br/>';
//read data to c_arr[]
$c_arr = array();
//字符对照表
echo '<table border="1" style=" font-size: 12px">';
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
        //$list = array($c_i => $c_arr[$c_i]);
    }
    echo '</tr>';
}
//$list = array("name" => 1, "sex" => 2, "tel" =>3, "email" => 4);
//echo 'json_encode($list):<br/>'.json_encode($list);
//echo '<br/>';
exit(1);
?>
