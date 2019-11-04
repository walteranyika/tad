<?php
$user="root";
$password="";
$dns="mysql:host=localhost;dbname=system";
$options=[
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ,
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
];
$pdo= new PDO($dns, $user, $password, $options);