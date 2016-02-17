<?php

include_once __corePath.'controllers/header.php';
include_once __corePath.'controllers/footer.php';
include_once __corePath.'controllers/topMenu.php';
include_once __corePath.'libs/widget.php';

class Page extends Controller
{ 

  public function getColor()
  {
  $r = rand(0, 210);
  $g = rand(0, 200);
  $b = rand(0, 200);
  
  $rh = $r +40;
  $gh = $g +40;
  $bh = $b +40;
  
  $c = dechex($r).dechex($g).dechex($b);
  $h = dechex($rh).dechex($gh).dechex($bh);
  
  $color = array ('color' => "#$c", 'highlight' => "#$h");
  
  return $color;
  }

  public function prepare()
  {
  
  $user = new User(1);
  if( !$user->isAuthorized() ) $this->redirect('?r=auth');
  
  $header = new PageHeader($this->curpage, $this->db, $this->config);
  $footer = new PageFooter($this->curpage, $this->db, $this->config);
  $topMenu = new TopMenu($this->curpage, $this->db, $this->config);
  
  $header->data['title'] = 'Simple web page';

  $tasksList = new JsonDB(__taskdb);
  
  $backUpsUsage = array();
  $backUpsUsage['title'] = 'Memory usage for BackUps';
  $backUpsUsage['data'] = array();
  
  $usedByAllBackups = 0;
  foreach($tasksList->data as $task)
    {
    $size = round(dirSize(__archiveDIR.$task['id'])/(1024*1024));
    $usedByAllBackups += $size;
    
    $color = $this->getColor();
    
    $backUpsUsage['data'][] = array('value' => $size, 
    'color' =>$color['color'], 
    'highlight' => $color['highlight'],
    'label' => $task['title'].' (Mb)');
    }
  
  
  $usedByBackupsTmp = dirSize(__archiveDIR);
  $usedByBackups = round($usedByBackupsTmp/(1024*1024));
  $hddTotalSize = round(disk_total_space(__workfolder)/(1024*1024));
  $hddFreeSpace = round(disk_free_space (__workfolder)/(1024*1024));
  $hddUsedSpace = $hddTotalSize - $hddFreeSpace - $usedByBackups;
  
  $hddUsage = array();
  $hddUsage['title'] = 'HDD usage';
  $hddUsage['data'] = array();
  $hddUsage['data'][] = array('value' => $usedByBackups, 
  'color' =>'#008d32', 
  'highlight' => '#2ac360',
  'label' => 'Used by BackUps (Mb)');
  $hddUsage['data'][] = array('value' => $hddUsedSpace, 
  'color' =>'#008aa3', 
  'highlight' => '#20abc4',
  'label' => 'Hdd used by other (Mb)');
  $hddUsage['data'][] = array('value' => $hddFreeSpace, 
  'color' =>'#a65200', 
  'highlight' => '#cd741c',
  'label' => 'Hdd free space (Mb)');
  
  
  $widgets = new Widgets($this->db, __corePath.'widgets/', $this->config);
  
  $this->data['hddUsage'] = $widgets->show('PieGraph', $hddUsage);
  $this->data['backUpsUsage'] = $widgets->show('PieGraph', $backUpsUsage);
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