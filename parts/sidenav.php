
<?php

function navItem($url , $label , $current_url = null , $base_path = '/tanmatsu-kanri/page'){
    if($current_url === null){$current_url = $_SERVER['REQUEST_URI'];};
    $is_current = str_contains($current_url , $url) ? 'current' : '' ;
    echo "<li class='side__item {$is_current}'>
            <a href='{$base_path}/{$url}' class='side__link'>{$label}</a>
        </li>";
}

?>

<aside class="side">
    <ul class="side__list">
        <?php
        navItem('main.php' , 'トップ');
        navItem('device.php' , '端末管理');
        ?>
    </ul>
    <ul class="side__list">
    <?php
        if($_SESSION['usr_authority'] === "管理者"){
            navItem('usr.php' , 'ユーザー管理');
        }
        // navItem('setting.php' , 'システム設定');
        // navItem('news.php' , 'お知らせ');
        // navItem('faq.php' , 'ヘルプ');
        ?>
    </ul>
</aside>