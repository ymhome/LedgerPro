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
    <title>端末の編集｜台帳管理システム</title>
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

            <h1 class="main__title">端末の編集</h1>

            <form method="POST" action="../function/device_update.php">
                <?php

                include __DIR__ . "/../function/function.php";
                include __DIR__ . "/../function/device_edit_get.php";


                foreach($editDevices as $editDevice):

                ?>
                <div class="main__create-item">
                    <label class="main__create-label">ID</label>
                    <input class="main__create-input" type="text" name="dev_name" value="<?php echo e($editDevice["dev_name"]) ?>">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">シリアル番号</label>
                    <input class="main__create-input" type="text" name="dev_serial" value="<?php echo e($editDevice["dev_serial"]) ?>">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">製品名</label>
                    <select class="main__create-select" name="dev_type" id="dev_type-select">
                        <option value="MacBook" <?= $editDevice['dev_type'] === 'MacBook' ? 'selected' : '' ?>>MacBook</option>
                        <option value="Imac" <?= $editDevice['dev_type'] === 'Imac' ? 'selected' : '' ?>>Imac</option>
                        <option value="iPad" <?= $editDevice['dev_type'] === 'iPad' ? 'selected' : '' ?>>iPad</option>
                        <option value="iPhone" <?= $editDevice['dev_type'] === 'iPhone' ? 'selected' : '' ?>>iPhone</option>
                        <option value="Windows" <?= $editDevice['dev_type'] === 'Windows' ? 'selected' : '' ?>>Windows</option>
                    </select>
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">部署</label>
                    <select class="main__create-select" name="dev_dept" id="department-select">
                        <option value="人事" <?= $editDevice['dev_dept'] === '人事' ? 'selected' : '' ?>>人事</option>
                        <option value="営業" <?= $editDevice['dev_dept'] === '営業' ? 'selected' : '' ?>>営業</option>
                        <option value="事務" <?= $editDevice['dev_dept'] === '事務' ? 'selected' : '' ?>>事務</option>
                    </select>
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">使用者</label>
                    <input class="main__create-input" type="text" name="dev_usr" value="<?php echo e($editDevice["dev_usr"]) ?>">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">スペック</label>
                    <textarea name="dev_spec" class="main__create-area"><?php echo e($editDevice["dev_spec"]) ?></textarea>
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">購入日</label>
                    <input class="main__create-input" type="date" name="dev_buy" value="<?php echo e($editDevice["dev_buy"]) ?>">
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">備考</label>
                    <textarea name="dev_other" class="main__create-area"><?php echo e($editDevice["dev_other"]) ?></textarea>
                </div>
                <div class="main__create-item">
                    <label class="main__create-label">ステータス</label>
                    <select class="main__create-select" name="dev_status" id="status-select">
                        <option value="使用中" <?= $editDevice['dev_status'] === '使用中' ? 'selected' : '' ?>>使用中</option>
                        <option value="未使用" <?= $editDevice['dev_status'] === '未使用' ? 'selected' : '' ?>>未使用</option>
                        <option value="故障中" <?= $editDevice['dev_status'] === '故障中' ? 'selected' : '' ?>>故障中</option>
                    </select>
                </div>
                <input value="<?php echo e($editDevice["dev_id"]); ?>" type="hidden" class="device-checkbox" name="dev_id">
                <?php endforeach; ?>
                <button class="main__create-btn" type="submit" name="deviceUpdateButton">変更</button>
            </form>

        </div>
    </div>


</main>

<?php

    include __DIR__ . "/../parts/footer.php";

?>

</body>
</html>