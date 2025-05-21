<?php

session_start();
require_once __DIR__ . '/../database/connect.php';


if(isset($_POST["usrCreateButton"])){

    $email = $_POST["usr_mail"];

    $sql = "SELECT COUNT(*) FROM usr WHERE usr_mail = :email";
    $stmt = $db -> prepare($sql);
    $stmt -> bindValue(':email' , $email);
    $stmt -> execute();
    $count = $stmt->fetchColumn();

    if($count > 0){
        $error_msg = "このメールアドレスは既に使われています";
        $_SESSION["error_msg"] = $error_msg;
    }
    
    if(empty($error_msg)){

        $sql = "INSERT INTO usr (`usr_name`, `usr_mail`, `usr_pass`, `usr_authority`) VALUES (:usr_name, :email, :pass, :authority)"; 
        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':usr_name' , $_POST["usr_name"]);
        $stmt -> bindValue(':email' , $email);
        $stmt -> bindValue(':pass' , password_hash($_POST["usr_pass"],PASSWORD_DEFAULT));
        $stmt -> bindValue(':authority' , $_POST["usr_authority"]);
        $stmt -> execute();

        header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/usr.php');
        exit;
    }else{
        header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/create_usr.php');
        exit;
    }
}