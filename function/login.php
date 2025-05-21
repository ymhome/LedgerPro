<?php

session_start();
require_once __DIR__ . '/../database/connect.php';
$email = $_POST['usr_mail'];

$sql = "SELECT * FROM usr WHERE usr_mail = :email";
$stmt = $db -> prepare($sql);
$stmt -> bindValue(':email' , $email);
$stmt -> execute();
$member = $stmt -> fetch();

if($member && password_verify($_POST['usr_pass'] , $member['usr_pass'])){
    $_SESSION['usr_name'] = $member['usr_name'];
    $_SESSION['usr_mail'] = $member['usr_mail'];
    $_SESSION['usr_authority'] = $member['usr_authority'];
    header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/main.php');
    exit();
}else{
    $_SESSION["login_error_msg"] = "メールアドレスまたはパスワードが正しくありません";
    header('Location: ../index.php');

    exit();
}



