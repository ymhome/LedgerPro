<?php

require_once __DIR__ . '/../database/connect.php';
                    
$sql = 'SELECT * FROM usr WHERE usr_id = :id';
$stmt = $db -> prepare($sql);
$stmt -> bindValue(':id' , $_POST["usr_id"]);
$stmt -> execute();
$editUsrs = $stmt;

