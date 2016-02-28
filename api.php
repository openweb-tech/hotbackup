<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include 'conf.php';
include __corePath.'libs/ApiResponse.php';
include __corePath.'libs/jsonDB.php';

$api = new ApiResponse(__settingsdb, __serversdb, __taskdb, __userdb);

echo $api->response();
?>