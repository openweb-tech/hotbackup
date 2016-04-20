<?php 

function getroute()
{
$route='index';

if(isset($_GET['r']))$route = str_replace('.','##',$_GET['r']);

return $route;
}

function getcurpage()
{
$route = getroute();
  
if(file_exists(__corePath."controllers/".$route.'.php'))
  return $route;
    else
      return '404';
}

function getaction()
{
if(isset($_POST['action']))
  {
  $action=str_replace('.','##',$_POST['action']);
  if($action==''){return 0;}
  
  if(file_exists(__corePath."actions/".$action.'.php'))
    return $action;
      else
	return 0;
  }else{return 0;}
}

function addNotification($message, $type)
{
if(!isset($_SESSION['notifications']))
  $_SESSION['notifications'] = array();
$_SESSION['notifications'][] = array('message' => $message, 'type' => $type);
}
?>