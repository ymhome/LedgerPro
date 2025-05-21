<?php

session_start();
require_once __DIR__ . '/../database/connect.php';
$email = $_POST['usr_mail'];

$sql = "SELECT * FROM usr WHERE usr_mail = :email";
$stmt = $db -> prepare($sql);
$stmt -> bindValue(':email' , $email);
$stmt -> execute();

$re_member = $stmt -> fetch();

if($re_member && password_verify($_POST['usr_pass'] , $re_member['usr_pass'])){
    $_SESSION['re_email'] = $re_member['usr_mail'];
    header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/device.php');
    exit();
}else{
    $_SESSION["error_msg"] = "メールアドレスまたはパスワードが正しくありません";
    header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/reauth.php');
    exit();
}

