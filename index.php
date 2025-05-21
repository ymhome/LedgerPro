
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン｜台帳管理システム</title>
    <link href="./assets/css/sanitize.css" rel="stylesheet"/>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/png">
</head>
<body>

    <div class="login__inner">
        <div class="login__logo logo">
            <img src="./assets/img/logo.png" alt="ロゴ" class="login__logo-img logo_img">
        </div>

        <div class="login__content">
            <?php if(isset($_SESSION["login_error_msg"])) : ?>
                <p class="error-msg"><?php echo $_SESSION["login_error_msg"]; ?></p> 
            <?php 
                unset($_SESSION['login_error_msg']);
                endif ;
            ?>
            <form action="./function/login.php" method="post">
                <div class="login__item">
                    <label class="login__label">メールアドレス</label>
                    <input type="text" name="usr_mail" required class="login__input">
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