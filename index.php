<?php
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include 'core/libs/db.php';
include 'core/libs/user.php';
include 'core/libs/core.php';
include 'core/libs/controller.php';
include 'core/libs/action.php';
include 'conf.php';
include 'core/app.php';
include __lang.'en.php';

$app = new App($dbconf);

$app->doAction();

$app->showPage();

?>