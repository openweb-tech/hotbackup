<?php

include_once 'header.php';
include_once 'footer.php';

class Page extends Controller
{ 

  public function prepare()
  {
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $header->data['title'] = 'HotBackup prepare for install';

  $this->data['title'] = 'HotBackup prepare for install';
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  
  if(isset($_SESSION['notifications']))
    {
    $this->data['visible'] = true;
    $this->data['notifications'] = $_SESSION['notifications'];
    } else {
    $this->data['visible'] = false;
    }
    
  unset($_SESSION['notifications']);
  
  $workUrl = 'http://' . $_SERVER['SERVER_NAME'] . str_replace('install/index.php', '', $_SERVER['SCRIPT_NAME']);
  $this->data['workUrl'] = $workUrl;
  }


  public function show()
  {
  return $this->view('views/beforeInstall.php', $this->data);
  }
}
?>