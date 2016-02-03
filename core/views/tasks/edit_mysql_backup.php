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
    <p><label>Title</label><br><input type="text" class="form-control" name="title" value="<?php echo $task['title']  ?>" ></p>
    <p><label>Status</label><br>
      <select class="form-control" name="status">
        <option value="1">Active</option>
        <option value="0">Frozen</option>
      </select>
    </p>
    <p>
      <label>Archiving depth</label><br>
      <input  type="number" class="form-control" name="deep" value="<?php echo $task['deep']  ?>">
    </p>
    <?php echo $widgets->show('DateTimePicker', array('frequency' => $task['frequency'] )); ?>
    
  </div>
  
  <div class="col-md-4">
    
    <!-- MYSQL backup -->
    <div class="taskTypes" id="MYSQL-backup" >
      <p><label>File name</label><br>
        <input type="text" name="mysql-backup-filename" class="form-control" value="<?php echo $task['mysql-backup-filename'] ?>">
      </p>
      <p><label>DB address</label><br>
        <input type="text" name="mysql-backup-address" class="form-control" value="<?php echo $task['mysql-backup-address'] ?>">
      </p>
      <p><label>DB name</label><br>
        <input type="text" name="mysql-backup-name" class="form-control" value="<?php echo $task['mysql-backup-name'] ?>">
      </p>
      <p><label>DB user</label><br>
        <input type="text" name="mysql-backup-user" class="form-control" value="<?php echo $task['mysql-backup-user'] ?>">
      </p>
      <p><label>DB password</label><br>
        <input type="text" name="mysql-backup-password" class="form-control" value="<?php echo $task['mysql-backup-password'] ?>">
      </p>
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

});
</script>
<?php echo $footer ?>