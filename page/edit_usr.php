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
    <meta name="viewport" content="width=Usr-width, initial-scale=1.0">
    <title>ユーザーの編集｜台帳管理システム</title>
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

            <h1 class="main__title">ユーザーの編集</h1>

            <form method="POST" action="../function/Usr_update.php">
                <?php

                include __DIR__ . "/../function/function.php";
                include __DIR__ . "/../function/usr_edit_get.php";


                foreach($editUsrs as $editUsr):

                ?>
                <div class="main__create-item">
                    <label class="main__create-label">名前</label>
                    <input class="main__create-input" type="text" name="usr_name" value="<?php echo e($editUsr["usr_name"]) ?>">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">メールアドレス</label>
                    <input class="main__create-input" type="text" name="usr_mail" value="<?php echo e($editUsr["usr_mail"]) ?>">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">権限</label>
                    <select class="main__create-select" name="usr_authority" id="department-select">
                        <option value="管理者" <?= $editUsr['usr_authority'] === '管理者' ? 'selected' : '' ?>>管理者</option>
                        <option value="編集者" <?= $editUsr['usr_authority'] === '編集者' ? 'selected' : '' ?>>編集者</option>
                        <option value="閲覧者" <?= $editUsr['usr_authority'] === '閲覧者' ? 'selected' : '' ?>>閲覧者</option>
                    </select>
                </div>
                <input value="<?php echo e($editUsr["usr_id"]); ?>" type="hidden" class="Usr-checkbox" name="usr_id">
                <?php endforeach; ?>
                <button class="main__create-btn" type="submit" name="UsrUpdateButton">変更</button>
            </form>

        </div>
    </div>


</main>

<?php

    include __DIR__ . "/../parts/footer.php";

?>

</body>
</html>