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
    <title>端末管理｜台帳管理システム</title>
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
    include __DIR__ . "/../function/device_search.php";

    ?>

    <div class="main__inner">
        <div class="main__content">

            <h1 class="main__title">端末管理</h1>

            <form class="search-form" method="get">

                <section class="tool">
                    <?php 
                        if($_SESSION["usr_authority"] === "管理者" || $_SESSION["usr_authority"] === "編集者"):
                    ?>
                    <div class="create-btn">
                        <a href="./create_device.php" class="create-btn-link">新規追加</a>
                    </div>
                    <?php endif; ?>
                    <div class="search-box">
                        <label>
                            <input type="text" placeholder="キーワードを入力" name="dev_search">
                        </label>
                        <button type="submit" aria-label="検索" name="deviceSearchButton" class="search-btn"></button>
                    </div>
                </section>
                    
                <section class="action-tool">
                    <ul class="filter-box">
                        <li class="filter-item">
                            <label class="select-box">
                                <select name="dev_products" id="products-select" onchange="this.form.submit()">
                                    <option value="">製品名</option>
                                    <option value="MacBook" <?php if($productFilter === "MacBook") {echo 'selected';} ?>>MacBook</option>
                                    <option value="Imac" <?php if($productFilter === "Imac") {echo 'selected';} ?>>Imac</option>
                                    <option value="iPad" <?php if($productFilter === "iPad") {echo 'selected';} ?>>iPad</option>
                                    <option value="iPhone" <?php if($productFilter === "iPhone") {echo 'selected';} ?>>iPhone</option>
                                    <option value="Windows" <?php if($productFilter === "Windows") {echo 'selected';} ?>>Windows</option>
                                </select>
                            </label>
                        </li>
                        <li class="filter-item">
                            <label class="select-box">
                                <select name="dev_company" id="company-select" onchange="this.form.submit()">
                                    <option value="">部署</option>
                                    <option value="事務" <?php if($companyFilter === "事務") {echo 'selected';} ?>>事務</option>
                                    <option value="営業" <?php if($companyFilter === "営業") {echo 'selected';} ?>>営業</option>
                                    <option value="人事" <?php if($companyFilter === "人事") {echo 'selected';} ?>>人事</option>
                                </select>
                            </label>
                        </li>
                        <li class="filter-item">
                            <label class="select-box">
                                <select name="dev_status" id="status-select" onchange="this.form.submit()">
                                    <option value="">ステータス</option>
                                    <option value="使用中" <?php if($statusFilter === "使用中") {echo 'selected';} ?>>使用中</option>
                                    <option value="未使用" <?php if($statusFilter === "未使用") {echo 'selected';} ?>>未使用</option>
                                    <option value="故障中" <?php if($statusFilter === "故障中") {echo 'selected';} ?>>故障中</option>
                                </select>
                            </label>
                        </li>
                    </ul>
                </section>

            </form>

            <section class="main__section main__table-box">

                <?php

                include __DIR__ . "/../function/device_get.php";
                include __DIR__ . "/../function/function.php";

                ?>
                

                <table class="main__list-table">
                    <thead class="main__list-thead">
                        <tr>
                            <?php 
                                if($_SESSION["usr_authority"] === "管理者"):
                            ?>
                            <th class="main__list-th">
                                <input id="device-select-all" type="checkbox">
                            </th>
                            <?php
                                endif;
                            ?>
                            <th class="main__list-th">ID</th>
                            <th class="main__list-th">シリアル番号</th>
                            <th class="main__list-th">製品名</th>
                            <th class="main__list-th">部署</th>
                            <th class="main__list-th">使用者</th>
                            <th class="main__list-th">スペック</th>
                            <th class="main__list-th">購入日</th>
                            <th class="main__list-th">備考</th>
                            <th class="main__list-th">ステータス</th>
                            <th class="main__list-th"></th>
                        </tr>
                    </thead>
                    <tbody class="main__list-tbody">
                        <?php if(!empty($dev_search_array) || isset($keyword) || isset($productFiletr) || isset($companyFilter) || isset($statusFilter)):
                                foreach($dev_search_array as $device_result): ?>
                                <tr class="main__list-tr">
                                    <?php 
                                        if($_SESSION["usr_authority"] === "管理者"):
                                    ?>
                                    <td class="main__list-td">
                                        <input value="<?php echo e($device_result["dev_id"]); ?>" type="checkbox" class="device-checkbox">
                                    </td>
                                    <?php 
                                        endif;
                                    ?>
                                    <td class="main__list-td"><?php echo e($device_result["dev_name"]); ?></td>
                                    <td class="main__list-td"><?php echo e($device_result["dev_serial"]); ?></td>
                                    <td class="main__list-td"><?php echo e($device_result["dev_type"]); ?></td>
                                    <td class="main__list-td"><?php echo e($device_result["dev_dept"]); ?></td>
                                    <td class="main__list-td"><?php echo e($device_result["dev_usr"]); ?></td>                            
                                    <td class="main__list-td"><?php echo nl2br(e($device_result["dev_spec"])); ?></td>
                                    <td class="main__list-td"><?php echo e($device_result["dev_buy"]); ?></td>
                                    <td class="main__list-td"><?php echo nl2br(e($device_result["dev_other"])); ?></td>
                                    <td class="main__list-td"><?php echo e($device_result["dev_status"]); ?></td>
                                    <?php 
                                        if($_SESSION["usr_authority"] === "管理者" || $_SESSION["usr_authority"] === "編集者"):
                                    ?>
                                    <td class="main__list-td main__list-operation">
                                        <form action='./edit_device.php' method='post'>
                                            <input value="<?php echo e($device_result["dev_id"]); ?>" type="hidden" name="dev_id">
                                            <button class='pass-view-btn' type='submit'>編集</button>
                                        </form>
                                    </td>
                                    <?php
                                        endif;
                                    ?>
                                </tr>
                                <?php endforeach; 
                            else: 
                                foreach($device_array as $device): ?>
                                <tr class="main__list-tr">
                                    <?php 
                                        if($_SESSION["usr_authority"] === "管理者"):
                                    ?>
                                    <td class="main__list-td">
                                        <input value="<?php echo e($device["dev_id"]); ?>" type="checkbox" class="device-checkbox">
                                    </td>
                                    <?php 
                                        endif;
                                    ?>
                                    <td class="main__list-td"><?php echo e($device["dev_name"]); ?></td>
                                    <td class="main__list-td"><?php echo e($device["dev_serial"]); ?></td>
                                    <td class="main__list-td"><?php echo e($device["dev_type"]); ?></td>
                                    <td class="main__list-td"><?php echo e($device["dev_dept"]); ?></td>
                                    <td class="main__list-td"><?php echo e($device["dev_usr"]); ?></td>                            
                                    <td class="main__list-td"><?php echo nl2br(e($device["dev_spec"])); ?></td>
                                    <td class="main__list-td"><?php echo e($device["dev_buy"]); ?></td>
                                    <td class="main__list-td"><?php echo nl2br(e($device["dev_other"])); ?></td>
                                    <td class="main__list-td"><?php echo e($device["dev_status"]); ?></td>
                                    <?php 
                                        if($_SESSION["usr_authority"] === "管理者" || $_SESSION["usr_authority"] === "編集者"):
                                    ?>
                                    <td class="main__list-td main__list-operation">
                                        <form action='./edit_device.php' method='post'>
                                            <input value="<?php echo e($device["dev_id"]); ?>" type="hidden" name="dev_id">
                                            <button class='pass-view-btn' type='submit'>編集</button>
                                        </form>
                                    </td>
                                    <?php
                                        endif;
                                    ?>
                                </tr>
                                <?php endforeach;
                            endif; ?>
                    </tbody>
                </table>
                
            </section>

            <?php 
                if($_SESSION["usr_authority"] === "管理者"):
            ?>
            <section class="delete-button">
                <?php 
                    if(isset ($_SESSION["message"])){
                        echo $_SESSION["message"];
                    }
                ?>
                <form method="post" id="device-action-form" class="device-action-form">
                    <input type="hidden" name="selected_device_ids" id="selected_device_ids" value="">
                    <ul class="action-box">
                        <li class="action-item">
                            <button formaction="../function/device_delete.php" class="action-btn" type="submit" name="deviceDeleteButton">削除</button>
                        </li>
                    </ul>
                </form>
            </section>
            <?php
                endif;
            ?>

        </div>
    </div>


</main>

<?php

    include __DIR__ . "/../parts/footer.php";

?>

</body>
</html>