<?php

Authentication::init()->checkProtectedPage();

$page = new PageMain();
$page->loadView();
