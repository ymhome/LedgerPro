<?php

session_start();
require_once __DIR__ . '/../database/connect.php';


if(isset($_POST["usrDeleteButton"])){
    
    if(empty($error_msg)){

        $selected_ids_string = $_POST['selected_usr_ids'];

        // カンマ区切りの文字列をIDの配列に変換
        // filterで空要素を除去し、mapで各要素を整数に変換（必要に応じて）
        $ids_to_delete = array_filter(explode(',', $selected_ids_string));
        $ids_to_delete = array_map('intval', $ids_to_delete); // IDが数値なら整数に変換推奨
        $placeholder = implode(',' , array_fill(0 , count($ids_to_delete) , '?'));

        $sql = "DELETE FROM usr WHERE usr_id IN ({$placeholder})"; 
        $stmt = $db -> prepare($sql);
        $stmt -> execute($ids_to_delete);

        header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/usr.php');
        exit;
    }else{
        $_SESSION["message"] = "削除中にエラーが発生しました。";
        header('Location: http://' .$_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']). '/../page/usr.php');
        exit;
    }
}