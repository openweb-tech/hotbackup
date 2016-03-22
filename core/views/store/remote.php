<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><a href="<?php echo __siteurl ?>/?r=store/files">Store</a> / remote</h1>
<div class="row">
  <div class="col-md-12">
  
    <table class="table">
      <thead>
       <tr>
         <th>ID</th>
         <th>Title</th>
         <th>Size</th>
         <th>Folders count</th>
         <th>Created</th>
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
<script>
</script>
<?php echo $footer ?>