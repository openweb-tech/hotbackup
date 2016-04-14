<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';
include_once __corePath.'controllers/topMenu.php';

class Page extends Controller
{ 
  private function getRemoteFolder()
  {
  $res = array();
  $serversList = new JsonDB(__serversdb);
  
  foreach(glob(__archiveDIR.'servers/*') as $path)
    if(is_dir($path))
      {
      $id = str_replace(__archiveDIR.'servers/', '', $path);
      $name = 'Undefined';
      if(isset($serversList->data[$id]))
        $name = $serversList->data[$id]['name'];
      
      $res[$id] = array('id' => $id,
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
  
  $header->data['title'] = $this->_LANG['store']['Store'] . ' / ' . $this->_LANG['store']['Remote'];
  
  $this->data['servers'] = $this->getRemoteFolder();
  
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  }

  public function show()
  {
  return $this->view(__corePath.'views/store/remote.php', $this->data);
  }
}
?>