<?php echo $header ?>
<?php echo $topMenu ?>
<?php 

$taskStatuses = array(
0 => 'Disabled',
1 => 'Enabled');

?>
<div class="container">
<h1>Tasks list</h1>
<!-- actions menu -->
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6">
  
    <div class="dropdown pull-right">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">New Task
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="<?php echo __siteurl ?>/?r=tasks/add_mysql_backup">MYSQL backup</a></li>
      <li><a href="<?php echo __siteurl ?>/?r=tasks/add_files_backup">Files backup</a></li>
      <li><a href="<?php echo __siteurl ?>/?r=tasks/add_donwnload_url">Donwload url</a></li>
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
         <th>ID</th>
         <th>Title</th>
         <th>Last exec</th>
         <th>Next exec</th>
         <th>Type</th>
         <th>Status</th>
         <th></th>
       </tr>
      </thead>
      <tbody>
      <?php 
      foreach($tasksList as $key=>$task)
        {
        ?>
        <tr>
          <td><?php echo $task['id'] ?></td>
          <td><a href="<?php echo __siteurl ?>/?r=tasks/edit_<?php echo $task['type'] ?>&id=<?php echo $task['id'] ?>"><?php echo $task['title'] ?></a></td>
          <td><?php echo date('d.m.Y h:i', $task['lastExec']) ?></td>
          <td><?php echo date('d.m.Y h:i', nextExecDateTime($task)) ?></td>
          <td><?php echo $task['type'] ?></td>
          <td><span class="tag_<?php echo strtolower($taskStatuses[$task['status']]) ?>"><?php echo $taskStatuses[$task['status']] ?><span></td>
          <td class="align-right">
            <form method="post">
              <input type="hidden" name="action" value="tasks/delete">
              <input type="hidden" name="id" value="<?php echo $task['id']  ?>">
              <input type="submit" class="btn btn-xs btn-danger" value="Delete" onclick="return confirm('Are u shure?') ? true : false;">
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