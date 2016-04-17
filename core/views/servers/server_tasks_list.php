<?php echo $header ?>
<?php echo $topMenu ?>
<?php 

$taskStatuses = $_LANG['tasks']['statuses']

?>
<div class="container">
<h1><?php echo $server['name'] ?></h1>
<!-- actions menu -->
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6">
  
    <div class="dropdown pull-right">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_LANG['tasks']['New Task'] ?>
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="<?php echo __siteurl ?>/?r=servers/tasks/add_mysql_backup&sid=<?php echo (int)$_GET['id'] ?>"><?php echo $_LANG['tasks']['MYSQL backup'] ?></a></li>
      <li><a href="<?php echo __siteurl ?>/?r=servers/tasks/add_files_backup&sid=<?php echo (int)$_GET['id'] ?>"><?php echo $_LANG['tasks']['Files backup'] ?></a></li>
      <li class="divider"></li>
      <li class="disabled"><a href="<?php echo __siteurl ?>/?r=tasks/-"><?php echo $_LANG['tasks']['Postgre Backup'] ?></a></li>
      <li class="disabled"><a href="<?php echo __siteurl ?>/?r=tasks/-"><?php echo $_LANG['tasks']['Firebird Backup'] ?></a></li>
      <li class="disabled"><a href="<?php echo __siteurl ?>/?r=tasks/-"><?php echo $_LANG['tasks']['Donwload url'] ?></a></li>
      <li class="disabled"><a href="<?php echo __siteurl ?>/?r=tasks/-"><?php echo $_LANG['tasks']['Execute script'] ?></a></li>
    </ul>
  </div>
  
  </div>
</div>
<!-- actions menu -->
<!-- users list -->
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <thead>
       <tr>
         <th><?php echo $_LANG['tasks']['ID'] ?></th>
         <th><?php echo $_LANG['tasks']['Title'] ?></th>
         <th><?php echo $_LANG['tasks']['Last exec'] ?></th>
         <th><?php echo $_LANG['tasks']['Next exec'] ?></th>
         <th><?php echo $_LANG['tasks']['Memory usage'] ?></th>
         <th><?php echo $_LANG['tasks']['Type'] ?></th>
         <th><?php echo $_LANG['tasks']['Status'] ?></th>
         <th></th>
       </tr>
      </thead>
      <tbody>
      <?php 
      //print_r($tasksList);
      foreach($tasksList as $key => $task)
        {
        ?>
        <tr>
          <td><?php echo $task['id'] ?></td>
          <td><a href="<?php echo __siteurl ?>/?r=servers/tasks/edit_<?php echo $task['type'] ?>&id=<?php echo $task['id'] ?>&sid=<?php echo (int)$_GET['id'] ?>"><?php echo $task['title'] ?></a></td>
          <td><?php echo date('d.m.Y h:i', $task['lastExec']) ?></td>
          <td><?php echo date('d.m.Y h:i', nextExecDateTime($task)) ?></td>
          <td><?php echo memoryFormat($task['memoryUsage']) ?></td>
          <td><?php echo $task['type'] ?></td>
          <td><span class="tag_<?php echo strtolower($taskStatuses[$task['status']]) ?>"><?php echo $taskStatuses[$task['status']] ?><span></td>
          <td class="align-right">
            <form method="post">
              <input type="hidden" name="action" value="servers/tasks/delete">
              <input type="hidden" name="id" value="<?php echo $task['id']  ?>">
              <input type="hidden" name="sid" value="<?php echo (int)$_GET['id']  ?>">
              <input type="submit" class="btn btn-xs btn-danger" value="<?php echo $_LANG['actions']['Delete'] ?>" onclick="return confirm('<?php echo $_LANG['tasks']['delete confirmation'] ?>') ? true : false;">
            </form>
          </td>
        </tr>
        <?php
        }      
      ?>
      </tbody>
    </table>
  </div>
</div>
<!-- users list -->
</div>
<?php echo $footer ?>