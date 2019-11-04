<?php
require 'conn.php';
if (isset($_POST['data'])){
    $data= $_GET['post'];
    $dataJson = json_decode($data);
    foreach ($dataJson as $item){
        $id = $item->id;
        $pid = $item->pid;
        $attendance_date = $item->attendance_date;
        $device_id = $item->device_id;
        try{
            $stm = $pdo->prepare('INSERT INTO `staff_attendance`(`id`, `pid`, `attendance_date`, `device_id`) VALUES (?,?,?,?)');
            $stm->execute([$id,$pid, $attendance_date, $device_id]);
        }catch (Exception $e){
        }
    }
}