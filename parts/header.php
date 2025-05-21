
<header class="header">
    <div class="header__inner">
        <div class="header__logo logo">
            <img src="../assets/img/logo.png" alt="ロゴ" class="header__logo-img logo_img">
        </div>
        <nav class="header__nav">
            <ul class="header__nav-list">
                <li class="header__nav-item">
                    <p class="header__nav-usr">こんにちは、<?php echo $_SESSION['usr_name'] ;?>さん</p>
                </li>
                <li class="header__nav-item">
                    <a href="../function/logout.php">
                        <span class="header__nav-logout"></span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>