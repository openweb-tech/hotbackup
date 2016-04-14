<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';
include_once __corePath.'controllers/topMenu.php';

class Page extends Controller
{ 
  private function getServerFiles($serversList, $id)
  {
  $res = array();
  
  $tasksData = $serversList->data[$id]['tasks'];
  
  foreach(glob(__archiveDIR."servers/$id/*") as $path)
    {
    $name = 'Undefined';
    $subId = str_replace(__archiveDIR."servers/$id/", '', $path);
    if(isset($tasksData[$subId])) $name = $tasksData[$subId]['title'];
    
    $res[] = array('id' => $subId,
        'name' => $name,
        'size' => dirSize($path),
        'time' => filectime($path),
        'filesCount' => count(glob($path."/*"))
      );
    }

  return $res;
  }
  
  public function prepare()
  {
  
  $user = new User(1);
  if( !$user->isAuthorized() ) $this->redirect('?r=auth');
  
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $topMenu = new TopMenu($this->curpage, $this->db, $this->config);
  $topMenu->prepare();
  
  $serversList = new JsonDB(__serversdb);
  
  $id = (int)$_GET['id'];
  
  if(isset($serversList->data[$id]))
    {
    $this->data['serverTitle'] = $serversList->data[$id]['name'];
    $header->data['title'] = $this->_LANG['store']['Store'] .' / ' . $this->_LANG['store']['Remote'] . ' / '.$serversList->data[$id]['name'];
    }
    else
    {
    $this->data['serverTitle'] = $this->_LANG['store']['undefined'];
    $header->data['title'] = $this->_LANG['store']['Store'] .' / ' . $this->_LANG['store']['Remote'] . ' / ' . $this->_LANG['store']['undefined'];
    }
  
  $this->data['tasksFolders'] = $this->getServerFiles($serversList, $id);
  
  $this->data['taskId'] = $id;
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  }

  public function show()
  {
  return $this->view(__corePath.'views/store/remote/server.php', $this->data);
  }
}
?>