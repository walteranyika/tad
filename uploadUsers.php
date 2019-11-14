<?php
require 'conn.php';
$stm = $pdo->prepare("select * from staff where id>?");
$stm->execute([0]);
$results = $stm->fetchAll();
$json = json_encode($results);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://66.228.55.80:8000/digisch/tad/receiveUsers.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('data'=>$json)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close($ch);
if ($server_output=="OK"){
    echo "Completed";
}
