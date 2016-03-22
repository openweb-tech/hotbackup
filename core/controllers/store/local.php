<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';
include_once __corePath.'controllers/topMenu.php';

class Page extends Controller
{ 
  private function getLocalFolder()
  {
  $res = array();
  $tasksList = new JsonDB(__taskdb);
  
  foreach(glob(__archiveDIR.'local/*') as $path)
    if(is_dir($path))
      {
      $id = str_replace(__archiveDIR.'local/', '', $path);
      $name = 'Undefined';
      if(isset($tasksList->data[$id]))
        $name = $tasksList->data[$id]['title'];
      
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
  $header->data['title'] = 'Store / local';
  
  $this->data['folders'] = $this->getLocalFolder();
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  }

  public function show()
  {
  return $this->view(__corePath.'views/store/local.php', $this->data);
  }
}
?>