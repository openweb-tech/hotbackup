<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><a href="<?php echo __siteurl ?>/?r=store/files"><?php echo $_LANG['store']['Store'] ?></a> / <a href="<?php echo __siteurl ?>/?r=store/local"><?php echo $_LANG['store']['Local'] ?></a> / <?php echo $taskTitle ?></h1>
<div class="row">
  <div class="col-md-12">
  
    <table class="table">
      <thead>
       <tr>
         <th><?php echo $_LANG['store']['№'] ?></th>
         <th><?php echo $_LANG['store']['Name'] ?></th>
         <th><?php echo $_LANG['store']['Size'] ?></th>
         <th><?php echo $_LANG['store']['Created'] ?></th>
         <th></th>
       </tr>
      </thead>
      <tbody>
      <?php 
      foreach($files as $id => $file)
        { ?>
        <tr>
          <td><?php echo ($id + 1) ?></td>
          <td><a href="<?php echo __siteurl ?>/?r=store/download&fileName=<?php echo $file['name'] ?>&folder=local&taskId=<?php echo $taskId ?>" target="_blank"><?php echo $file['name'] ?></a></td>
          <td><?php echo memoryFormat($file['size']) ?></td>
          <td><?php echo date('d.m.Y h:i', $file['time']) ?></td>
          <td class="align-right">
            <form method="post">
              <input type="hidden" name="action" value="store/deleteFile">
              <input type="hidden" name="taskId" value="<?php echo $taskId ?>">
              <input type="hidden" name="fileName" value="<?php echo $file['name']  ?>">
              <input type="hidden" name="folder" value="local">
              <input type="hidden" name="server" value="">
              <input type="submit" class="btn btn-xs btn-danger" value="<?php echo $_LANG['actions']['Delete'] ?>" onclick="return confirm('<?php echo $_LANG['store']['delete confirmation'] ?>') ? true : false;">
            </form>
          </td>  
        </tr>
        <?php 
        } ?>
      </tbody>
    </table>
    
  </div>
</div>
<script>
</script>
<?php echo $footer ?>