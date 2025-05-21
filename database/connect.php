<?php

$dsn = 'mysql:dbname=ledger_pro; host=localhost; charset=utf8';
$usr = 'root';
$password = 'root'; 


try{
    $db = new PDO($dsn, $usr, $password);
    // echo '接続に成功しました';
}catch(PDOException $e){
    die("接続エラー:{$e->getMessage()}");
}