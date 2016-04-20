<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><a href="<?php echo __siteurl ?>/?r=store/files"><?php echo $_LANG['store']['Store'] ?></a> / <a href="<?php echo __siteurl ?>/?r=store/remote"><?php echo $_LANG['store']['Remote'] ?></a> / <?php echo $serverTitle ?></h1>
<div class="row">
  <div class="col-md-12">
  
    <table class="table">
      <thead>
       <tr>
         <th><?php echo $_LANG['store']['ID'] ?></th>
         <th><?php echo $_LANG['store']['Title'] ?></th>
         <th><?php echo $_LANG['store']['Size'] ?></th>
         <th><?php echo $_LANG['store']['Files count'] ?></th>
         <th><?php echo $_LANG['store']['Created'] ?></th>
         <th></th>
       </tr>
      </thead>
      <tbody>
      <?php 
      foreach($tasksFolders as $id => $folder)
        { ?>
        <tr>
          <td><?php echo ($id+1) ?></td>
          <td><a href="<?php echo __siteurl ?>/?r=store/remote/folder&fid=<?php echo $folder['id'] ?>&sid=<?php echo (int)$_GET['id'] ?>"><?php echo $folder['name'] ?></a></td>
          <td><?php echo memoryFormat($folder['size']) ?></td>
          <td><?php echo $folder['filesCount'] ?></td>
          <td><?php echo date('d.m.Y h:i', $folder['time']) ?></td>
          <td></td>        
        </tr>
        <?php 
        } ?>
      </tbody>
    </table>
    
  </div>
</div>
</div>
<script>
</script>
<?php echo $footer ?>