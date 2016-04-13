<?php echo $header ?>
<?php echo $topMenu ?>
<?php 

function getServerStatus($code)
{
global $_LANG;
$statuses = $_LANG['servers']['statuses'];
return $statuses[$code];
}

function genServerTitle($server)
{
if($server['name'] != '') return '<a href="'.__siteurl.'/?r=servers/server_tasks_list&id='.$server['id'].'">'.$server['name'].'</a>';
return '<img src="'.__siteurl.'/img/jx-loader-line.gif" />';
}

?>
<div class="container">
<h1><?php echo $_LANG['servers']['Servers list'] ?></h1>
<!-- actions menu -->
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6">
  
    <div class="dropdown pull-right">
      <a class="btn btn-primary" href="<?php echo __siteurl ?>/?r=servers/server_add"><?php echo $_LANG['servers']['New Server'] ?></a>
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
         <th><?php echo $_LANG['servers']['Title'] ?></th>
         <th><?php echo $_LANG['servers']['Address'] ?></th>
         <th><?php echo $_LANG['servers']['Status'] ?></th>
         <th><?php echo $_LANG['servers']['Free space'] ?></th>
         <th><?php echo $_LANG['servers']['Tasks count'] ?></th>
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
          <td><?php echo getServerStatus($server['status']) ?></td>
          <td><?php echo memoryFormat($server['freeSpace']) ?></td>
          <td><?php echo $server['tasksCount'] ?></td>
          <td class="align-right"><a href="<?php echo __siteurl ?>/?r=servers/server_edit&id=<?php echo $server['id'] ?>" class="btn btn-xs btn-info"><?php echo $_LANG['servers']['connection'] ?></a></td>
          <td class="align-right">
            <form method="post">
              <input type="hidden" name="action" value="servers/delete_server">
              <input type="hidden" name="id" value="<?php echo $server['id']  ?>">
              <input type="submit" class="btn btn-xs btn-danger" value="<?php echo $_LANG['actions']['Delete'] ?>" onclick="return confirm('<?php echo $_LANG['servers']['delete confirmation'] ?>') ? true : false;">
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