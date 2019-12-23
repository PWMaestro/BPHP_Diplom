<?php
    $thisPage = new PageMain();
?>

<div class="sidebar">
    <div class="bar_item" id="user">
        <a class="icon_wrap" id="log_out" href="index.php?page=main&logout=do" title="Выход">
            <img class="icon" src="style/icons/logout.png">
        </a>
        <div class="icon_wrap" title="<?=$_SESSION['user']->name . ' ' . $_SESSION['user']->surname?>">
            <img class="icon" src="style/icons/user.png" alt="Пользователь">
        </div>
    </div>

    <nav class="tasks">
        <ul class="tasks_nav">
            <li class="bar_item">
                <a class="value" href="index.php?page=main">Все</a>
                <div class="icon_wrap"><img class="icon" src="style/icons/all.png" alt="Все"></div>
            </li>
            <li class="bar_item">
                <a class="value" href="index.php?page=main&show=new">Новые</a>
                <div class="icon_wrap"><img class="icon" src="style/icons/new.png" alt="Новые"></div>
            </li>
            <li class="bar_item">
                <a class="value" href="index.php?page=main&show=resolved">На проверке</a>
                <div class="icon_wrap"><img class="icon" src="style/icons/wait.png" alt="На проверке"></div>
            </li>
            <li class="bar_item">
                <a class="value" href="index.php?page=main&show=rejected">На доработке</a>
                <div class="icon_wrap"><img class="icon" src="style/icons/warning.png" alt="На доработке"></div>
            </li>
            <li class="bar_item">
                <a class="value" href="index.php?page=main&show=done">Готовые</a>
                <div class="icon_wrap"><img class="icon" src="style/icons/ok.png" alt="Готовые"></div>
            </li>
            <?=$thisPage->loadButtonNew()?>
        </ul>
    </nav>
</div>

<main>
    <ul class="tasks_list">
        <?=$thisPage->displayTasksList()?>
    </ul>
</main>

<footer class="copyright">
    <p>© Ситько Артём, BPHP-3, 2019</p>
</footer>
