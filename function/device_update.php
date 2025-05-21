<?php

require_once __DIR__ . '/../database/connect.php';

$sql = "SELECT * FROM device WHERE dev_id = :id";
$stmt = $db -> prepare($sql);
$stmt -> bindValue(':id' , $_POST['dev_id']);
$stmt -> execute();

$original_device = $stmt->fetch(PDO::FETCH_ASSOC);
$updateFields = [];


    if($original_device['dev_name'] !== $_POST['dev_name']){
        $updateFields['dev_name'] = $_POST['dev_name'];
    }
    if($original_device['dev_serial'] !== $_POST['dev_serial']){
        $updateFields['dev_serial'] = $_POST['dev_serial'];
    }
    if($original_device['dev_type'] !== $_POST['dev_type']){
        $updateFields['dev_type'] = $_POST['dev_type'];
    }
    if($original_device['dev_dept'] !== $_POST['dev_dept']){
        $updateFields['dev_dept'] = $_POST['dev_dept'];
    }
    if($original_device['dev_usr'] !== $_POST['dev_usr']){
        $updateFields['dev_usr'] = $_POST['dev_usr'];
    }
    if($original_device['dev_spec'] !== $_POST['dev_spec']){
        $updateFields['dev_spec'] = $_POST['dev_spec'];
    }
    if($original_device['dev_buy'] !== $_POST['dev_buy']){
        $updateFields['dev_buy'] = $_POST['dev_buy'];
    }
    if($original_device['dev_other'] !== $_POST['dev_other']){
        $updateFields['dev_other'] = $_POST['dev_other'];
    }
    if($original_device['dev_status'] !== $_POST['dev_status']){
        $updateFields['dev_status'] = $_POST['dev_status'];
    }

    if(!empty($updateFields)){
        $sql = "UPDATE device SET ";
        $setClauses = [];
        foreach($updateFields as $field => $value){
            $setClauses[] = "$field = :$field";
        }
        $sql .= implode(", " , $setClauses);
        $sql .= " WHERE dev_id = :id";
        $stmt = $db -> prepare($sql);
        foreach($updateFields as $field => $value){
            $stmt -> bindValue(":$field" , $value);
        }
        $stmt -> bindValue(":id" , $_POST['dev_id'], PDO::PARAM_INT);
        try{
            $result = $stmt -> execute();
    
            if($result){
                header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/device.php');
                exit();
            }else{
                header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/edit_device.php');
                exit();
            }

        }catch(PDOException $e){
            echo "Error: " . $e->getMessage() . "<br";
            exit;
        }
    }


