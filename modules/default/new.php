<?php

Authentication::init()->checkProtectedPage();
Authorization::init()->restrictAccessRights();

$page = new PageNew();
$page->loadView();
