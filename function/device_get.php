<?php

require_once __DIR__ . '/../database/connect.php';

$sql = "SELECT * FROM device";
$stmt = $db -> prepare($sql);
$stmt -> execute();

$device_array = $stmt;