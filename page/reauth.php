<?php

session_start();

if (!isset($_SESSION['usr_mail'])) {
    // ログインしてないならログインページへ
    header('Location: ../index.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['target_device_id'])){
        $_SESSION['target_device_id'] = $_POST['target_device_id'];
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン｜台帳管理システム</title>
    <link href="../assets/css/sanitize.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/png">
</head>
<body>

    <div class="login__inner">
        <div class="login__logo">
            <img src="../assets/img/logo.png" alt="ロゴ" class="login__logo-img">
        </div>

        <div class="login__content">
            <?php if(isset($_SESSION["error_msg"])) : ?>
                <p class="error-msg"><?php echo $_SESSION["error_msg"]; ?></p> 
            <?php 
                unset($_SESSION['error_msg']);
                endif ;
            ?>
            <form action="../function/reauth_check.php" method="post">
                <div class="login__item">
                    <label class="login__label">メールアドレス</label>
                    <input type="text" name="usr_mail" required class="login__input" value="<?php echo $_SESSION['usr_mail']; ?>" placeholder="<?php echo $_SESSION['email']; ?>">
                </div>
                <div class="login__item">
                    <label class="login__label">パスワード</label>
                    <input type="password" name="usr_pass" required class="login__input">
                </div>
                <div class="login__btn-box">
                    <input type="submit" value="ログイン" class="login__btn">
                </div>
            </form>
        </div>
    </div>


</body>
</html>