
<?php

session_start();


if (!isset($_SESSION['usr_mail']) || !$_SESSION['usr_authority'] === '管理者') {
        header('Location: ../index.php');
        exit();
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>端末新規追加｜台帳管理システム</title>
    <link href="../assets/css/sanitize.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/png">
</head>
<body>

<?php

include __DIR__ . "/../parts/header.php";

?>

<main class="main">

    <?php

    include __DIR__ . "/../parts/sidenav.php";

    ?>

    <div class="main__inner">
        <div class="main__content">

            <h1 class="main__title">端末新規追加</h1>

            <?php if(isset($_SESSION["error_msg"])) : ?>
                <p class="error-msg"><?php echo $_SESSION["error_msg"]; ?></p> 
            <?php 
                unset($_SESSION["error_msg"]);
                endif ;
            ?>

            <form method="POST" class="main__form" action="../function/usr_add.php">
                <div class="main__create-item">
                    <label class="main__create-label">名前</label>
                    <input required class="main__create-input" type="text" name="usr_name">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">メールアドレス</label>
                    <input required class="main__create-input" type="text" name="usr_mail">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">パスワード</label>
                    <input required class="main__create-input" type="password" name="usr_pass">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">権限</label>
                    <select class="main__create-select" name="usr_authority" id="authority-select">
                        <option value="管理者">管理者</option>
                        <option value="編集者">編集者</option>
                        <option value="閲覧者">閲覧者</option>
                    </select>
                </div>

                <button class="main__create-btn" type="submit" name="usrCreateButton">新規追加</button>
            </form>

        </div>
    </div>


</main>

<?php

    include __DIR__ . "/../parts/footer.php";

?>

</body>
</html>