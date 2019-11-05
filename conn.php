<?php
$user="root";
$password="walter";
$dns="mysql:host=localhost;dbname=tad";
$options=[
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ,
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
];
$pdo= new PDO($dns, $user, $password, $options);