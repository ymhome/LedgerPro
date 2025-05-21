<?php

require_once __DIR__ . '/../database/connect.php';

$sql = "SELECT * FROM usr";
$stmt = $db->prepare($sql);
$stmt -> execute();

$usr_array = $stmt;