<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('PHPExcel.php');
//read excel file;
$PHPExcel = new PHPExcel();
$PHPReader = new PHPExcel_Reader_Excel5();
$PHPExcel = $PHPReader->load('SGMC SW Group2 Part4 加班 一次表格_20121211.xls');
$currentSheet = $PHPExcel->getSheet(0);
$allColumn = $currentSheet->getHighestColumn();
$allRow = $currentSheet->getHighestRow();
for ($currentRow = 1; $currentRow <= $allRow; $currentRow++) {
    for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++) {
        $address = $currentColumn . $currentRow;
        echo $currentSheet->getCell($address)->getValue() . "t";
    }
    echo "n";
}

//write excel file 
$objExcel = new PHPExcel();
$objWriter = new PHPExcel_Writer_Excel5($objExcel);
$objProps = $objExcel->getProperties();
$objProps->setCreator("yuan");
$objProps->setLastModifiedBy("yuan");
$objProps->setTitle("excel test");
$objProps->setSubject("my excel test");
$objProps->setDescription("hello world.");
$objProps->setKeywords("PHPExcel");
$objProps->setCategory("EXCEL");
$objExcel->setActiveSheetIndex(0);
$objActSheet = $objExcel->getActiveSheet();
$objActSheet->setTitle('TEST1');
$objActSheet->setCellValue('A1', '字符串内容');
$objActSheet->setCellValue('A2', 26);
$objActSheet->setCellValue('A3', true);
$objActSheet->setCellValue('A4', '=A2+A2');
$objWriter->save('/home/yuanjianjun/helloworld.xls');

//copy excel format
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load('/home/yuanjianjun/20100301.xls');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->_phpExcel->setActiveSheetIndex(0);
$objWriter->_phpExcel->getActiveSheet()->setCellValue('A1', 'FESDF');
$objWriter->_phpExcel->getActiveSheet()->setCellValue('B1', 'S');
$objWriter->_phpExcel->getActiveSheet()->setCellValue('C1', 'FEFSD');
$objWriter->_phpExcel->getActiveSheet()->setCellValue('D1', 'SDFD');
$objWriter->_phpExcel->getActiveSheet()->setCellValue('E1', '淘宝CPS');
$objWriter->save('/home/yuanjianjun/copy.xls');
?>
