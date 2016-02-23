<?php echo $header ?>
<?php echo $topMenu ?>
<?php 
function genServerTitle($server)
{
if($server['name'] != '') return $server['name'];

return '<img src="'.__siteurl.'/img/jx-loader-line.gif" />';
}

?>
<div class="container">
<h1>Servers list</h1>
<!-- actions menu -->
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6">
  
    <div class="dropdown pull-right">
      <a class="btn btn-primary" href="<?php echo __siteurl ?>/?r=settings/server_add">New Server</a>

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
         <th>Title</th>
         <th>Address</th>
         <th>Status</th>
         <th>Free space</th>
         <th>Tasks count</th>
         <th></th>
         <th></th>
       </tr>
      </thead>
      <tbody>
      <?php 
      foreach($servers as $key=>$server)
        {
        ?>
        <tr>
          <td><?php echo genServerTitle($server) ?></td>
          <td><?php echo $server['address'] ?></td>
          <td><?php echo $server['status'] ?></td>
          <td><?php echo $server['freeSpace'] ?></td>
          <td><?php echo $server['tasksCount'] ?></td>
          <td class="align-right"><a href="<?php echo __siteurl ?>/?r=settings/server_edit&id=<?php echo $server['id'] ?>" class="btn btn-xs btn-info">connection</a></td>
          <td class="align-right">
            <form method="post">
              <input type="hidden" name="action" value="servers/delete_server">
              <input type="hidden" name="id" value="<?php echo $server['id']  ?>">
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
<script>
$(document).ready(function() {

  setInterval(function() {
    window.location = window.location;
  }, 60000);

});
</script>
<?php echo $footer ?>