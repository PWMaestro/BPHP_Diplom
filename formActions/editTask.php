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

$newTask = new Task($_POST['guid']);
if (Authorization::init()->restrictAccessRights(true)) {
    $newTask->addTaskFromForm();
    if (isset($_POST['done'])) {
        $newTask->status = Task::STATUS_DONE;
    } elseif (isset($_POST['refactor'])) {
        $newTask->status = Task::STATUS_REJECTED;
    } elseif (isset($_POST['save'])) {
        $newTask->status = Task::STATUS_NEW;
    }
} else {
    $newTask->addTaskFromDb();
    if ($newTask->status !== Task::STATUS_DONE) {
        foreach ($newTask->langTarget as $lang) {
            $newTask->content->{$lang} = $_POST[$lang];
        }
        if (isset($_POST['done'])) {
            $newTask->status = Task::STATUE_RESOLVED;
        }
    }
}
$newTask->commit();

header('HTTP/1.1 200 OK');
header('Location: http://' . $_SERVER['HTTP_HOST']);
