<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';
include_once __corePath.'controllers/topMenu.php';
include_once __corePath.'libs/widget.php';

class Page extends Controller
{ 

  public function prepare()
  {
  
  $user = new User(1);
  if( !$user->isAuthorized() ) $this->redirect('?r=auth');
  
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $topMenu = new TopMenu($this->curpage, $this->db, $this->config);
  $topMenu->prepare();
  
  $header->data['title'] = $this->_LANG['misc']['home_title'];

  $tasksList = new JsonDB(__taskdb);
  $serversList = new JsonDB(__serversdb);
  
  $backUpsUsage = array();
  
  $usedByAllBackups = 0;
  // for local backups
  foreach($tasksList->data as $task)
    {
    $size = round(dirSize(__archiveDIR.'local/'.$task['id']));
    $usedByAllBackups += $size;
    
    $backUpsUsage[] = array('value' => $size, 
    'label' => $this->_LANG['store']['Local'] . ' / '.$task['title']);
    }
  //for remote backups
  foreach($serversList->data as $server)
    if(isset($server['tasks']))
      foreach($server['tasks'] as $task)
        {
        $size = round(dirSize(__archiveDIR.'servers/'.$server['id'].'/'.$task['id']));
        $usedByAllBackups += $size;
      
        $backUpsUsage[] = array('value' => $size, 
        'label' => $server['name'].' / '.$task['title']);
        }
  
  function iCmp($a, $b)
    {
    if($a['value'] > $b['value']) return 0;
      else
        return 1;
    }
  usort($backUpsUsage, "iCmp");
  
  $usedByBackupsTmp = dirSize(__archiveDIR.'local/');
  $usedByBackups = round($usedByBackupsTmp/(1024*1024));
  $hddTotalSize = round(disk_total_space(__workfolder)/(1024*1024));
  $hddFreeSpace = round(disk_free_space (__workfolder)/(1024*1024));
  $hddUsedSpace = $hddTotalSize - $hddFreeSpace - $usedByBackups;
  
  $hddUsage = array();
  $hddUsage['title'] = $this->_LANG['misc']['HDD usage'];
  $hddUsage['data'] = array();
  $hddUsage['data'][] = array('value' => $usedByBackups, 
  'color' =>'#008d32', 
  'highlight' => '#2ac360',
  'label' => $this->_LANG['misc']['Used by BackUps (Mb)']);
  $hddUsage['data'][] = array('value' => $hddUsedSpace, 
  'color' =>'#008aa3', 
  'highlight' => '#20abc4',
  'label' => $this->_LANG['misc']['Hdd used by other (Mb)']);
  $hddUsage['data'][] = array('value' => $hddFreeSpace, 
  'color' =>'#a65200', 
  'highlight' => '#cd741c',
  'label' => $this->_LANG['misc']['Hdd free space (Mb)']);
  
  
  $widgets = new Widgets($this->db, __corePath.'widgets/', $this->config);
  
  $maxUsage = 0;
  if(isset($backUpsUsage[0])) $maxUsage = $backUpsUsage[0]['value'];
  
  $this->data['hddUsage'] = $widgets->show('PieGraph', $hddUsage);
  $this->data['backUpsUsage'] = $backUpsUsage;
  $this->data['maxUsage'] = $maxUsage;
  $this->data['header'] = $header->show();
  $this->data['footer'] = $footer->show();
  $this->data['topMenu'] = $topMenu->show();
  }


  public function show()
  {
  return $this->view(__corePath.'views/index.php', $this->data);
  }
}
?>