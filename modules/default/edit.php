<?php

Authentication::init()->checkProtectedPage();

$page = new PageEdit();
switch ($_SESSION['user']->role) {
    case User::MANAGER:
        $page->loadView();
        break;
    case User::EXECUTOR:
    default:
        $page->loadView('editExtra');
        break;
}
