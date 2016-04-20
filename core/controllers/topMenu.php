<?php

class TopMenu extends Controller
{ 
  public function prepare()
  {
  $mainToggle = '';
  $tasksToggle = '';
  $usersToggle = '';
  $serversToggle = '';
  $storeToggle = '';
  $settingsToggle = '';
  
  $route = getroute();
  
  if($route == '')
    $mainToggle = 'active';
  if(($route == 'tasks') || (strpos('##'.$route, 'tasks/')))
    $tasksToggle = 'active';
  if(($route == 'users') || (strpos('##'.$route, 'users/')))
    $usersToggle = 'active';
  if(($route == 'servers') || (strpos('##'.$route, 'servers/')))
    $serversToggle = 'active';
  if(($route == 'store') || (strpos('##'.$route, 'store/')))
    $storeToggle = 'active';
  if(($route == 'settings') || (strpos('##'.$route, 'settings/')))
    $settingsToggle = 'active';
  
  $this->data['mainToggle'] = $mainToggle;
  $this->data['tasksToggle'] = $tasksToggle;
  $this->data['usersToggle'] = $usersToggle;
  $this->data['serversToggle'] = $serversToggle;
  $this->data['storeToggle'] = $storeToggle;
  $this->data['settingsToggle'] = $settingsToggle;
  }
  
  public function show()
  {
  return $this->view(__corePath.'views/topMenu.php', $this->data);
  }
}
?>