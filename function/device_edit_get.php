<?php

require_once __DIR__ . '/../database/connect.php';
                    
$sql = 'SELECT * FROM device WHERE dev_id = :id';
$stmt = $db -> prepare($sql);
$stmt -> bindValue(':id' , $_POST["dev_id"]);
$stmt -> execute();
$editDevices = $stmt;

