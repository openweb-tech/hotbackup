<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1>MYSQL backup: <?php echo $task['title'] ?></h1>
<!-- actions menu -->
<form method="post">
<input type="hidden" name="action" value="tasks/update_mysql_backup">
<input type="hidden" name="id" value="<?php echo $task['id'] ?>">
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6 align-right">
    <a href="<?php echo __siteurl ?>/?r=tasks/list" class="btn">Back</a>
    <input type="submit" class="btn btn-primary" value="Save">
  </div>
</div>
<?php if( isset($_GET['error']) ) { ?>
<div class="row">
  <div class="col-md-12">
    <br>
    <div class="alert alert-danger"><?php echo $_GET['error'] ?></div>  
  </div>
</div>
<?php  } ?>
<div class="row">
  <div class="col-md-4">
    <fieldset class="form-group">
      <label>Title</label>
      <input type="text" class="form-control" name="title" value="<?php echo $task['title']  ?>" >
    </fieldset>
    <fieldset class="form-group">
      <label>Status</label>
      <select class="form-control" name="status">
        <option value="1">Enabled</option>
        <option value="0">Disabled</option>
      </select>
    </fieldset>
    <fieldset class="form-group">
      <label>Archive depth</label>
      <input  type="number" class="form-control" name="deep" value="<?php echo $task['deep']  ?>">
    </fieldset>
    <?php echo $widgets->show('DateTimePicker', array('frequency' => $task['frequency'] )); ?>
  </div>
  
  <div class="col-md-4">
    
    <!-- MYSQL backup -->
    <div class="taskTypes" id="MYSQL-backup" >
      <fieldset class="form-group">
        <label>DB address</label>
        <input type="text" name="mysql-backup-address" class="form-control" value="<?php echo $task['mysql-backup-address'] ?>">
      </fieldset>
      <fieldset class="form-group">
        <label>DB name</label>
        <input type="text" name="mysql-backup-name" class="form-control" value="<?php echo $task['mysql-backup-name'] ?>">
      </fieldset>
      <fieldset class="form-group">
        <label>DB user</label>
        <input type="text" name="mysql-backup-user" class="form-control" value="<?php echo $task['mysql-backup-user'] ?>">
      </fieldset>
      <fieldset class="form-group">
        <label>DB password</label>
        <input type="text" name="mysql-backup-password" class="form-control" value="<?php echo $task['mysql-backup-password'] ?>">
      </fieldset>
    </div>
    <!-- MYSQL backup -->
  </div>
  
</div>

</form>
<!-- actions menu -->
</div>
<script>
$(document).ready(function(){

$('select[name="n-start"]').val('<?php echo $task['frequency']['type'] ?>');
$('select[name="status"]').val('<?php echo $task['status'] ?>');

});
</script>
<?php echo $footer ?>