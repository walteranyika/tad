<?php
require 'conn.php';
$leo=date("Y-m-d");
if (isset($_POST["date"]))
{
   $leo= $_POST["date"];
}
//$leo="2019-11-04";
//$stm = $pdo->prepare("select staff.fname, staff.lname, staff.cnum, staff.deptname, staff_attendance.* from staff join staff_attendance on staff.pid=staff_attendance.pid where staff_attendance.attendance_date like ?");
$stm = $pdo->prepare("select staff.pid,staff.fname, staff.lname, staff.cnum, staff.deptname,staff_attendance.id from staff join staff_attendance on staff.pid=staff_attendance.pid where staff_attendance.attendance_date like ?");
$stm->execute([$leo.'%']);
$results = $stm->fetchAll();


foreach ($results as $result){
    $pid = $result->pid;
    $stm2 = $pdo->prepare('select attendance_date from staff_attendance where pid=? and attendance_date like ? order by attendance_date asc');
    $stm2->execute([$pid, $leo.'%']);
    $att_results = $stm2->fetchAll();
    $count =1;
    foreach ($att_results as $item){
        if ($count%2 !=0){
            $timeIn="IN ".date("H:i A", strtotime($item->attendance_date));
            $item->time= $timeIn;
        }else{
            $timeIn="OUT ".date("H:i A", strtotime($item->attendance_date));
            $item->time= $timeIn;
        }
        $count++;
    }
    $result->attendance=$att_results;
}
$json = json_encode($results);
echo $json;