<?php

Authentication::init()->checkEnterPage();

$page = new PageLogin();
$page->loadView();
