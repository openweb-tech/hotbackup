<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';
include_once __corePath.'controllers/topMenu.php';

class Page extends Controller
{ 

  public function checkSettings($data)
  {
  $emptyData = array(
  'serverName' => 'My new Backup server',
  'shortName' => 'New_BCKP',
  'apiKey' => '89498hgjdfgdjgb4lkjgo4uy'
  );
  
  if(!empty($data))
    foreach($data as $key=>$val)
      $emptyData[$key] = $val;
  
  return $emptyData;
  }
  
  public function prepare()
  {
  
  $user = new User(1);
  if( !$user->isAuthorized() ) $this->redirect('?r=auth');
  
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $topMenu = new TopMenu($this->curpage, $this->db, $this->config);
  $topMenu->prepare();
  $settings = new JsonDB(__settingsdb);
  $settings->data = $this->checkSettings($settings->data);
  $header->data['title'] = $this->_LANG['settings']['Main settings'];
  
  $langs = glob(__corePath."lang/*.php");
  
  foreach($langs as $key => $val)
    $langs[$key] = str_replace('.php', '', str_replace(__corePath.'lang/', '', $val));
  
  $this->data['langs'] = $langs;
  $this->data['settings'] = $settings->data;
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  
  }


  public function show()
  {
  return $this->view(__corePath.'views/settings/main.php', $this->data);
  }
}
?>