<?php
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include 'conf.php';
include __corePath.'libs/db.php';
include __corePath.'libs/core.php';
include __corePath.'libs/controller.php';
include __corePath.'libs/action.php';
include __corePath.'app.php';
include __corePath.'lang/en.php';

/* load plugins */

foreach (glob(__corePath."plugins/*.php") as $filename)
  include $filename;

/* load plugins */

$app = new App($dbconf);

$app->doAction();

$app->showPage();

?>