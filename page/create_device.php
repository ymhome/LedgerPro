
<?php

session_start();


if (!isset($_SESSION['usr_mail']) || !$_SESSION['usr_authority'] === '管理者' || !$_SESSION['usr_authority'] === '編集者') {
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

            <form method="POST" class="main__form" action="../function/device_add.php">
                <div class="main__create-item">
                    <label class="main__create-label">ID</label>
                    <input required class="main__create-input" type="text" name="dev_name">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">シリアル番号</label>
                    <input required class="main__create-input" type="text" name="dev_serial">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">製品名</label>
                    <select class="main__create-select" name="dev_type" id="products-select">
                        <option value="MacBook">MacBook</option>
                        <option value="Imac">Imac</option>
                        <option value="iPad">iPad</option>
                        <option value="iPhone">iPhone</option>
                        <option value="Windows">Windows</option>
                    </select>
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">部署</label>
                    <select class="main__create-select" name="dev_dept" id="department-select">
                        <option value="人事">人事</option>
                        <option value="営業">営業</option>
                        <option value="事務">事務</option>
                    </select>
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">使用者</label>
                    <input class="main__create-input" type="text" name="dev_usr">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">スペック</label>
                    <textarea name="dev_spec" class="main__create-area"></textarea>
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">購入日</label>
                    <input class="main__create-input" type="date" name="dev_buy">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">備考</label>
                    <textarea name="dev_other" class="main__create-area"></textarea>
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">ステータス</label>
                    <select class="main__create-select" name="dev_status" id="status-select">
                        <option value="使用中">使用中</option>
                        <option value="未使用">未使用</option>
                        <option value="故障中">故障中</option>
                    </select>
                </div>

                <button class="main__create-btn" type="submit" name="deviceCreateButton">新規追加</button>
            </form>

        </div>
    </div>


</main>

<?php

    include __DIR__ . "/../parts/footer.php";

?>

</body>
</html>