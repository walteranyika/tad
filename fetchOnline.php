<?php
require 'conn.php';
$leo=date("Y-m-d");
if (isset($_POST["date"]))
{
   $leo= $_POST["date"];
}
$stm = $pdo->prepare("select staff.fname, staff.lname, staff.cnum, staff.deptname, staff_attendance.* from staff join staff_attendance on staff.pid=staff_attendance.pid where staff_attendance.attendance_date like ?");
$stm->execute([$leo.'%']);
$results = $stm->fetchAll();
$json = json_encode($results);
echo $json;