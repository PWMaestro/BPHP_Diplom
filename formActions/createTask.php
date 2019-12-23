<?php

///////////////////////////// configure general ///////////////////////////////
///
error_reporting(-1);
///
////////////////////////////// main configure /////////////////////////////////
///
const FILE_ACCESS_ADJUSTMENT = '../';
///
require_once FILE_ACCESS_ADJUSTMENT . 'config/Config.php';
require_once FILE_ACCESS_ADJUSTMENT . 'autoload.php';
///
Config::get(FILE_ACCESS_ADJUSTMENT);
///
///////////////////////////////////////////////////////////////////////////////

Authentication::init()->checkProtectedPage();
Authorization::init()->restrictAccessRights();

$newTask = new Task();
$newTask->addTaskFromForm();
$newTask->status = Task::STATUS_NEW;
$newTask->commit();

header('HTTP/1.1 200 OK');
header('Location: http://' . $_SERVER['HTTP_HOST']);
