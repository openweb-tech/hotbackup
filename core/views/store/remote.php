<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><a href="<?php echo __siteurl ?>/?r=store/files"><?php echo $_LANG['store']['Store'] ?></a> / <?php echo $_LANG['store']['Remote'] ?></h1>
<div class="row">
  <div class="col-md-12">
  
    <table class="table">
      <thead>
       <tr>
         <th><?php echo $_LANG['store']['ID'] ?></th>
         <th><?php echo $_LANG['store']['Title'] ?></th>
         <th><?php echo $_LANG['store']['Size'] ?></th>
         <th><?php echo $_LANG['store']['Folders count'] ?></th>
         <th><?php echo $_LANG['store']['Created'] ?></th>
         <th></th>
       </tr>
      </thead>
      <tbody>
      <?php 
      foreach($servers as $id => $server)
        { ?>
        <tr>
          <td><a href="<?php echo __siteurl ?>/?r=store/remote/server&id=<?php echo $id ?>"><?php echo $id ?></a></td>
          <td><a href="<?php echo __siteurl ?>/?r=store/remote/server&id=<?php echo $id ?>"><?php echo $server['name'] ?></a></td>
          <td><?php echo memoryFormat($server['size']) ?></td>
          <td><?php echo $server['filesCount'] ?></td>
          <td><?php echo date('d.m.Y h:i', $server['time']) ?></td>
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