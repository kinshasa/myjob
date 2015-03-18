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
    echo FALSE;
    exit(1);
}
mysql_select_db("applicationdb", $con);
$date = $_GET["date"];
$ot_type = $_GET["ot_type"];
/*
 * 判断登录成功
 */
$password = $_GET["password"];
$genid = $_GET["genid"];
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

$date_tablename = "ot_" . MYSQL_WORKSHEET1 . "_" . $date . "_data";

$mysql_get_datetable = "
SELECT *
FROM `applicationdb`.`" . $date_tablename . "`
";
if (!$result = mysql_query($mysql_get_datetable)) {
    die('Could not connect: ' . mysql_error());
    mysql_close($con);
    echo FALSE;
    exit(1);
}

$th = array(
    "姓名", "个人ID", "日期", "勤态星期代码", "计划开始时间", "计划完了时间",
    "计划加班时间", "加班事由其他", "本月已申请加班时间（h）", "上月实际加班时间（h）"
);
/* echo "<table border='1'>
  <tr>
  ";
  echo " <th>" . "<input type=\"checkbox\"id=\"get_datatable_boxs\" > " . "</th>";
  foreach ($th as $value) {
  echo " <th>" . $value . "</th>";
  }
  echo "   </tr>";
 */
$tablei = 1;
$datetable[0] = $th;
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    /* echo "<table border='1'>";
      $keys = array_keys($key);
      foreach ($keys as $value) {
      echo " <th>" . $value . "</th>";
      }
      while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
      //print_r($row);
      echo "<tr>";
      foreach ($row as $value) {
      echo "<td>" . $value . "</td>";
      }
      echo "</tr>";
      }
      echo "</table>"; */

    /* echo "<tr>";
      echo "<td>" . "<input type=\"checkbox\"id=\"get_datatable_box_" . $tablei . "\" > " . "</td>";
      echo "<td>" . $row["name"] . "</td>";
      echo "<td>" . $row["genid"] . "</td>";
      echo "<td>" . $row["work_date"] . "</td>";
      echo "<td>" . $row["daytype"] . "</td>";
      echo "<td>" . $row["time_from"] . "</td>";
      echo "<td>" . $row["time_end"] . "</td>";
      echo "<td>" . $row["work_minutes"] . "</td>";
      echo "<td>" . $row["work_reason"] . "</td>";
      echo "<td>" . $row["monthc_hours"] . "</td>";
      echo "<td>" . $row["monthl_hours"] . "</td>";
      echo "</tr>"; */
    $row2 = array();
    array_push($row2, $row["name"], $row["genid"], $row["work_date"], $row["daytype"], $row["time_from"], $row["time_end"], $row["work_minutes"], $row["work_reason"], $row["monthc_hours"], $row["monthl_hours"]);
    try {
        $datetable[$tablei] = $row2;
    } catch (Exception $exc) {
        //echo $exc->getTraceAsString();
    }
    $tablei++;
}

//echo "</table>";
echo json_encode($datetable);
mysql_close($con);
?>
