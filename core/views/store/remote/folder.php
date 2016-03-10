<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><a href="<?php echo __siteurl ?>/?r=store/files">Store</a> / <a href="<?php echo __siteurl ?>/?r=store/remote">Remote</a> / <a href="<?php echo __siteurl ?>/?r=store/remote/server&id=<?php echo $serverId ?>"><?php echo $serverTitle ?></a> / <?php echo $taskTitle ?></h1>
<div class="row">
  <div class="col-md-12">
  
    <table class="table">
      <thead>
       <tr>
         <th>№</th>
         <th>Name</th>
         <th>Size</th>
         <th>Created</th>
         <th></th>
       </tr>
      </thead>
      <tbody>
      <?php 
      foreach($files as $id => $file)
        { ?>
        <tr>
          <td><?php echo ($id + 1) ?></td>
          <td><a href="<?php echo __siteurl ?>/?r=store/download&fileName=<?php echo $file['name'] ?>&folder=remote&taskId=<?php echo $taskId ?>&serverId=<?php echo $serverId ?>" target="_blank"><?php echo $file['name'] ?></a></td>
          <td><?php echo memryFormat($file['size']) ?></td>
          <td><?php echo date('d.m.Y h:i', $file['time']) ?></td>
          <td class="align-right">
            <form method="post">
              <input type="hidden" name="action" value="store/deleteFile">
              <input type="hidden" name="taskId" value="<?php echo $taskId ?>">
              <input type="hidden" name="fileName" value="<?php echo $file['name']  ?>">
              <input type="hidden" name="folder" value="remote">
              <input type="hidden" name="server" value="<?php echo $serverId ?>">
              <input type="submit" class="btn btn-xs btn-danger" value="Delete" onclick="return confirm('Are u shure?') ? true : false;">
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