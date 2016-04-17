<?php
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include 'conf.php';

if(!defined('__corePath'))
  die('Bad installation');
if(__corePath == '{basePath}core/')
  {
  header('location: ' . str_replace('index.php', '', $_SERVER['PHP_SELF']) . 'install/');
  die();
  }

include __corePath.'libs/db.php';
include __corePath.'libs/core.php';
include __corePath.'libs/controller.php';
include __corePath.'libs/action.php';
include __corePath.'libs/service.php';
include __corePath.'libs/jsonDB.php';
include __corePath.'app.php';

$settingsDB = new JsonDB(__settingsdb);
include __corePath.'lang/'.$settingsDB->data['lang'].'.php';

/* load plugins */

foreach (glob(__corePath."plugins/*.php") as $filename)
  include $filename;

/* load plugins */

$app = new App($dbconf);

$app->doAction();

$app->showPage();

?>