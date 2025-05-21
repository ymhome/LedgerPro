
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
    <meta name="viewport" content="width=usr-width, initial-scale=1.0">
    <title>ユーザー管理｜台帳管理システム</title>
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

        <?php

            include __DIR__ . "/../function/usr_get.php";
            include __DIR__ . "/../function/function.php";
            include __DIR__ . "/../function/usr_search.php";

        ?>

        <h1 class="main__title">ユーザー管理</h1>

        <form method="get" class="search-form">
            <section class="tool">
                <div class="create-btn">
                    <a href="./create_usr.php" class="create-btn-link">新規追加</a>
                </div>
                <div class="search-box">
                    <label>
                        <input type="text" placeholder="キーワードを入力" name="usr_search">
                    </label>
                    <button type="submit" aria-label="検索" name="usrSearchButton" class="search-btn"></button>
                </div>
            </section>
        </form>

        <section class="main__section main__table-box">
            
            <table class="main__list-table">
                <thead class="main__list-thead">
                    <tr>
                        <th class="main__list-th">
                            <input id="usr-select-all" type="checkbox">
                        </th>
                        <th class="main__list-th">名前</th>
                        <th class="main__list-th">メールアドレス</th>
                        <th class="main__list-th">権限</th>
                        <th class="main__list-th">操作</th>
                    </tr>
                </thead>
                <tbody class="main__list-tbody">
                      <?php if(!empty($usr_search_array) || isset($keyword)):
                                foreach($usr_search_array as $usr_result): ?>
                                                               <tr class="main__list-tr">
                                    <?php 
                                        if($_SESSION["usr_authority"] === "管理者"):
                                    ?>
                                    <td class="main__list-td">
                                        <input value="<?php echo e($usr_result["usr_id"]); ?>" type="checkbox" class="usr-checkbox">
                                    </td>
                                    <?php 
                                        endif;
                                    ?>
                                    <td class="main__list-td"><?php echo e($usr_result["usr_name"]); ?></td>
                                    <td class="main__list-td"><?php echo e($usr_result["usr_mail"]); ?></td>
                                    <td class="main__list-td"><?php echo e($usr_result["usr_authority"]); ?></td>
                                    <?php 
                                        if($_SESSION["usr_authority"] === "管理者"):
                                    ?>
                                    <td class="main__list-td main__list-operation">
                                        <form action='./edit_usr.php' method='post'>
                                            <input value="<?php echo e($usr_result["usr_id"]); ?>" type="hidden" name="usr_id">
                                            <button class='pass-view-btn' type='submit'>編集</button>
                                        </form>
                                    </td>
                                    <?php
                                        endif;
                                    ?>
                                </tr>
                                <?php endforeach; 
                            else: 
                        
                            if(isset($usr_array)):
                            foreach ($usr_array as $usr) :
                        ?>
                            <tr class="main__list-tr">
                                <td class="main__list-td">
                                    <input id="usr-select-row" type="checkbox">
                                </td>
                                <td class="main__list-td"><?php echo e($usr['usr_name'])?></td>
                                <td class="main__list-td"><?php echo e($usr['usr_mail'])?></td>
                                <td class="main__list-td"><?php echo e($usr['usr_authority'])?></td>
                                <td class="main__list-td">
                                    <form action="./edit_usr.php" method="post">
                                        <input value="<?php echo e($usr['usr_id']); ?>" type="hidden" name="usr_id">
                                        <button class="pass-view-btn" type="submit">編集</button>
                                    </form>
                                </td>
                            </tr>
                        <?php 
                            endforeach; 
                            endif;
                            endif;
                        ?>
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
                <form method="post" id="usr-action-form" class="usr-action-form">
                    <input type="hidden" name="selected_usr_ids" id="selected_usr_ids" value="">
                    <ul class="action-box">
                        <li class="action-item">
                            <button formaction="../function/usr_delete.php" class="action-btn" type="submit" name="usrDeleteButton">削除</button>
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