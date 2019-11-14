<?php
require 'conn.php';
if (isset($_POST['data'])){
    $data= $_POST['data'];
    $dataJson = json_decode($data);
    foreach ($dataJson as $item){
        $pid = $item->pid;
        $fname = $item->fname;
        $lname = $item->lname;
        $cnum = $item->cnum;
        $deptnum = $item->deptnum;
        $deptname = $item->deptname;
        $gender = $item->gender;
        try{
            $stm = $pdo->prepare('INSERT INTO `staff`(`pid`, `fname`, `lname`, `cnum`, `deptnum`, `deptname`, `gender`) VALUES (?,?,?,?,?,?,?)');
            $stm->execute([$pid, $fname, $lname, $cnum, $deptnum, $deptname, $gender]);
        }catch (Exception $e){

        }
    }
}