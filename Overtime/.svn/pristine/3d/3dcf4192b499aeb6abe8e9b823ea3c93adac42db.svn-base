<?php

/**
 * Edit by shaob.liu@samsung.com 
 * Read Excel转义字符
 * PHPWord: http://phpword.codeplex.com
 * PHPPowerPoint: http://phppowerpoint.codeplex.com/
 * PHPLINQ: http://phplinq.codeplex.com/
 * */
include_once 'head.php';

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$colno = -1;


global $file_fullname;
try {
    $objPHPExcel = PHPExcel_IOFactory::load($file_fullname);
} catch (Exception $e) {
    die('Error loading file "' . pathinfo($file_fullname, PATHINFO_BASENAME) . '": ' . $e->getMessage());
}
$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
//var_dump($sheetData);

for ($i = "A"; $i <= get_col(); $i++) {
    if ($username == $sheetData[$i][A]) {
        $colno = $i;
        $objPHPExcel->getActiveSheet()->removeRow(1, 1);                  //从第6行往后删去10行
        echo "deleting";
        exit(1);
    }
}

echo 'None';

/*
  $objPHPExcel->getActiveSheet()->insertNewRowBefore(6, 10);   //在行6前添加10行
  $objPHPExcel->getActiveSheet()->removeRow(6, 10);                  //从第6行往后删去10行
  $objPHPExcel->getActiveSheet()->insertNewColumnBefore('E', 5);    //从第E列前添加5类
  $objPHPExcel->getActiveSheet()->removeColumn('E', 5);             //从E列开始往后删去5列
 */
?>
