<?php
require 'conn.php';
$leo=date("Y-m-d");
if (isset($_POST["date"]))
{
   $leo= $_POST["date"];
}
$stm = $pdo->prepare("select * from staff_attendance where attendance_date like ?");
$stm->execute([$leo.'%']);
$results = $stm->fetchAll();
$json = json_encode($results);
echo $json;