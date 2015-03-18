<?php

/**
 * Edit by shaob.liu@samsung.com 
 * Read Excel转义字符
 * PHPWord: http://phpword.codeplex.com
 * PHPPowerPoint: http://phppowerpoint.codeplex.com/
 * PHPLINQ: http://phplinq.codeplex.com/
 * */
/* eval() 做后门程序 global $file_fullname; */
/** Include path * */
header("Content-Type: text/html;charset=utf-8");
include_once 'PHPExcel.php';
include_once 'PHPExcel/Writer/Excel2007.php';
include_once 'PHPExcel/IOFactory.php';
/** Error reporting */
//error_reporting(E_ALL);
//ini_set('include_path', ini_get('include_path') . ';../Classes/');
//error_reporting(E_ALL);
//set_time_limit(0);
iconv("UTF-8", "gb2312", "abc阳光123");

date_default_timezone_set('Asia/Shanghai');
define(PHPVERSION, floor(phpversion()));
define(CURRENT_DATE, date('Ymd', time()));
define(CURRENT_TIME, date('Y-m-d H:i:s', time()));
define(FILE_ROTE, "../SW Group2 Part4每天加班统计/");
//\\\\109.131.13.16\\sw\\表格填写\\Part4\\其他\\测试，可删除\\
define(FILE_NAME_FIRST, "SGMC SW Group2 Part4 加班 一次表格_" . CURRENT_DATE . ".xlsx"); //iconv("UTF-8", "GB2312//ignore", "SGMC SW Group2 Part4 加班 一次表格_ ")
define(FILE_NAME_SECOND, "SGMC SW Group2 Part4 加班 二次表格_" . CURRENT_DATE . ".xlsx");
define(FILE_FULLNAME_FIRST, FILE_ROTE . FILE_NAME_FIRST);
define(FILE_FULLNAME_SECOND, FILE_ROTE . FILE_NAME_SECOND);
define(FILE_TILE_FIRST, "SGMC SW Group2 Part4 加班 一次表格_" . CURRENT_DATE);
define(FILE_TILE_SECOND, "SGMC SW Group2 Part4 加班 二次表格_" . CURRENT_DATE);

define(MYSQL_WORKSHEET1, "worksheet1");
define(MYSQL_WORKSHEET2, "worksheet2");

define(FIRST, "个人ID");
define(SECOND, "个人ID");

define(SHEEL_NAME_, "姓名");                              //孙志强               A1
define(SHEEL_ID, "个人ID");                              //08532628             B1
define(SHEEL_DATE, "日期");                              //20121210             C1
define(SHEEL_WEEK, "勤态星期代码");                      //1                     D1
define(SHEEL_START_TIME, "计划开始时间");               //201212101830          E1
define(SHEEL_END_TIME, "计划完了时间");                 //201212102130          F1
define(SHEEL_WORKHOURS, "计划加班时间");                //180                   G1
define(SHEEL_REASON, "加班事由其他");                   //R390/U380 MR          H1
define(SHEEL_CURRENT_HOURS, "本月已申请加班时间（h）"); //8                     I1
define(SHEEL_LAST_HOURS, "上月实际加班时间（h）");      //44.5                  J1
define(SHEEL_, "个人ID");
//echo PHPVERSION.CURRENTDATE.CURRENTTIME.FILEROTE.FILENAME.FILEFULLNAME.TILE.

$error_code = array(
    "ot_type" => "0x001", "login" => "0x002", "register" => "0x003", "insert" => "0x004"
);

/*  current user private data; */
$username;
$password;

$sheet_column = array(
    "A", "B", "C", "D", "E", "F", "G", "H", "I",
    /**/ "J", "K", "L"
);
$sheet_second = array(
    "姓名", "个人ID", "日期", "开始时间", "结束时间", "加班时间", "工作时间", "原因", "工作星期代码",
    /**/ "工作形态代码", "本月已申请加班时间（h）", "上月实际加班时间（h）"
);
$sheet_first = array(
    "姓名", "个人ID", "日期", "勤态星期代码", "计划开始时间", "计划完了时间",
    /**/ "计划加班时间", "加班事由其他", "本月已申请加班时间（h）", "上月实际加班时间（h）"
);

$sheet_first_data = array($sheet_first);

/* file变量 */
$file_type = 1;
$current_date = date('Ymd', time());
$current_time = date('Y-m-d H:i:s', time());
$file_name = "SGMC SW Group2 Part4 _" . $current_date . ".xlsx";
$file_name = FILE_NAME_FIRST;
$file_name2 = "SGMC SW Group2 Part4 加班 一次表格_" . $current_date . ".xlsx";

$file_rode = "../output/";
$file_rode2 = "F:\\SW Group2 Part4每天加班统计\\";

$title = "SGMC SW Group2 Part4 加班 一次表格_" . $current_date;
$title = FILE_TILE_FIRST;
$file_fullname2 = $file_rode2 . $file_name;
$file_fullname = $file_rode . $file_name;
$file_fullname = FILE_FULLNAME_FIRST;

function GetIP() {
    if ($_SERVER["HTTP_X_FORWARDED_FOR"])
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    else if ($_SERVER["HTTP_CLIENT_IP"])
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    else if ($_SERVER["REMOTE_ADDR"])
        $ip = $_SERVER["REMOTE_ADDR"];
    else if (getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
    else
        $ip = "Unknown";
    return $ip;
}

function exit2read() {
    global $file_fullname;
    try {
        $objPHPExcel = PHPExcel_IOFactory::load($file_fullname);
    } catch (Exception $e) {
        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        return 0;
    }
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
//var_dump($sheetData);
    return $sheetData;
}

function create() {
    global $title;
    global $file_type;
    global $file_fullname;
    global $sheet_column;
    global $sheet_first;
    global $sheet_second;
// Create new PHPExcel object
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

    $i = 0;
    foreach ($sheet_first as $value) {
        $objPHPExcel->getActiveSheet()->SetCellValue($sheet_column[$i] . "1", $value);
        //$objPHPExcel->getActiveSheet()->getColumnDimension($sheet_column[$i])->setWidth(30); //setAutoSize(true);   
        $i++;
    }
    //$objPHPExcel->getActiveSheet()->getStyle("C","E","F","G")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
    $objPHPExcel->getActiveSheet()->setTitle("templete");


// Save Excel 2007 file
//echo date('H:i:s') . " Write to Excel2007 format\n";
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
    $objWriter->save(iconv("UTF-8", "GB2312//ignore", $file_fullname));
    /*
      $i = 0;
      foreach ($sheet_second as $value) {
      $objPHPExcel->getActiveSheet()->SetCellValue($sheet_column[$i++], $value);
      }
      $objWriter->save(FILE_FULLNAME_SECOND);
     */

// Echo done
//echo $createfilename . "  。Done writing file.\r\n";
}

function get_col() {
    global $file_fullname;
    $php_reader = new PHPExcel_Reader_Excel2007();
    if (!$php_reader->canRead($file_fullname)) {
        $php_reader = new PHPExcel_Reader_Excel5();
        if (!$php_reader->canRead($file_fullname)) {
            echo'NO Excel!';
        } else {
            echo'PHPExcel_Reader_Excel5<br/>';
        }
    } else {
        //echo'PHPExcel_Reader_Excel2007<br/>';
    }
    $php_excel_obj = $php_reader->load($file_fullname);
    $current_sheet = $php_excel_obj->getSheet(0);
    $col = $current_sheet->getHighestColumn();
    return $col;
}

?>
