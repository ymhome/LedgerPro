
<?php

session_start();

if (!isset($_SESSION['usr_mail'])) {
    // ログインしてないならログインページへ
    header('Location: ../index.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>台帳管理システム</title>
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

            <ul class="top__list">
                <li class="top__box">
                    <a href="./device.php" class="top__link">端末管理</a>
                </li>
                <?php
                    if($_SESSION['usr_authority'] === "管理者"){
                     
                     echo  '<li class="top__box">
                                <a href="./usr.php" class="top__link">ユーザー管理</a>
                            </li>' ;
                    }
                ?>
                <!-- <li class="top__box">
                    <a href="./setting.php" class="top__link">システム設定</a>
                </li>
                <li class="top__box">
                    <a href="./news.php" class="top__link">お知らせ</a>
                </li>
                <li class="top__box">
                    <a href="./faq.php" class="top__link">ヘルプ</a>
                </li> -->
            </ul>
        </div>
    </div>
</main>
    
<?php

include __DIR__ . "/../parts/footer.php";

?>

</body>
</html>