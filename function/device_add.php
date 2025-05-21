<?php

session_start();
require_once __DIR__ . '/../database/connect.php';


if(isset($_POST["deviceCreateButton"])){
    
    if(empty($error_msg)){

        $buy = $_POST["dev_buy"];

        $sql = "INSERT INTO device (`dev_name`, `dev_serial`, `dev_type`, `dev_dept`, `dev_usr`, `dev_spec`, `dev_buy`, `dev_other`, `dev_status`) VALUES (:dev_name, :serial_number, :products, :dapertment, :user, :spec, :buy, :other, :condition)"; 
        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':dev_name' , $_POST["dev_name"]);
        $stmt -> bindValue(':serial_number' , $_POST["dev_serial"]);
        $stmt -> bindValue(':products' , $_POST["dev_type"]);
        $stmt -> bindValue(':dapertment' , $_POST["dev_dept"]);
        $stmt -> bindValue(':user' , $_POST["dev_usr"]);
        $stmt -> bindValue(':spec' , $_POST["dev_spec"]);
        $stmt->bindValue(':buy', ($buy !== null && $buy !== '') ? $buy : null, ($buy !== null && $buy !== '') ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt -> bindValue(':other' , $_POST["dev_other"]);
        $stmt -> bindValue(':condition' , $_POST["dev_status"]);
        $stmt -> execute();

        header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/device.php');
        exit;
    }else{
        header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/create_device.php');
        exit;
    }
}