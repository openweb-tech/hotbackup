<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';
include_once __corePath.'controllers/topMenu.php';
include_once __corePath.'libs/ApiQuery.php';

class Page extends Controller
{ 
  
  public function prepare()
  {
  
  $user = new User(1);
  if( !$user->isAuthorized() ) $this->redirect('?r=auth');
  
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $topMenu = new TopMenu($this->curpage, $this->db, $this->config);
    
  $serversDB = new JsonDB(__serversdb);
  
  $serverId = (int)$_GET['id'];
  
  $server = $serversDB->data[$serverId];
  $query = new ApiQuery($server['address'], $server['apiKey']);
  
  $tasksList = $query->getTasksList(true);
  
  //print_r($tasksList);
  
  $header->data['title'] = $server['name'].': tasks list ';
  $this->data['server'] = $server;
  $this->data['tasksList'] = $tasksList;  
  
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  
  }


  public function show()
  {
  return $this->view(__corePath.'views/servers/server_tasks_list.php', $this->data);
  }
}
?>