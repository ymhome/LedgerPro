<?php

require_once __DIR__ . '/../database/connect.php';

$sql = "SELECT * FROM usr WHERE usr_id = :id";
$stmt = $db -> prepare($sql);
$stmt -> bindValue(':id' , $_POST['usr_id']);
$stmt -> execute();

$original_usrice = $stmt->fetch(PDO::FETCH_ASSOC);
$updateFields = [];


    if($original_usrice['usr_name'] !== $_POST['usr_name']){
        $updateFields['usr_name'] = $_POST['usr_name'];
    }
    if($original_usrice['usr_mail'] !== $_POST['usr_mail']){
        $updateFields['usr_mail'] = $_POST['usr_mail'];
    }
    if($original_usrice['usr_authority'] !== $_POST['usr_authority']){
        $updateFields['usr_authority'] = $_POST['usr_authority'];
    }
    

    if(!empty($updateFields)){
        $sql = "UPDATE usr SET ";
        $setClauses = [];
        foreach($updateFields as $field => $value){
            $setClauses[] = "$field = :$field";
        }
        $sql .= implode(", " , $setClauses);
        $sql .= " WHERE usr_id = :id";
        $stmt = $db -> prepare($sql);
        foreach($updateFields as $field => $value){
            $stmt -> bindValue(":$field" , $value);
        }
        $stmt -> bindValue(":id" , $_POST['usr_id'], PDO::PARAM_INT);
        try{
            $result = $stmt -> execute();
    
            if($result){
                header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/usr.php');
                exit();
            }else{
                header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/edit_usr.php');
                exit();
            }

        }catch(PDOException $e){
            echo "Error: " . $e->getMessage() . "<br>";
            exit;
        }
    }


