<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1>New MYSQL backup</h1>
<!-- actions menu -->
<form method="post">
<input type="hidden" name="action" value="tasks/add_mysql_backup">
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
    <p><label>Title</label><br><input type="text" class="form-control" name="title" value="<?php  ?>" ></p>
    <p><label>Status</label><br>
      <select class="form-control" name="status">
        <option value="1">Active</option>
        <option value="0">Frozen</option>
      </select>
    </p>
    <p>
      <label>Archiving depth</label><br>
      <input  type="number" class="form-control" name="deep" value="1">
    </p>
    
    <?php echo $widgets->show('DateTimePicker', array()); ?>
    
  </div>
  
  <div class="col-md-4">
    
    <!-- MYSQL backup -->
    <div class="taskTypes" id="MYSQL-backup" >
      <p><label>File name</label><br>
        <input type="text" name="mysql-backup-filename" class="form-control">
      </p>
      <p><label>DB address</label><br>
        <input type="text" name="mysql-backup-address" class="form-control">
      </p>
      <p><label>DB name</label><br>
        <input type="text" name="mysql-backup-name" class="form-control">
      </p>
      <p><label>DB user</label><br>
        <input type="text" name="mysql-backup-user" class="form-control">
      </p>
      <p><label>DB password</label><br>
        <input type="text" name="mysql-backup-password" class="form-control">
      </p>
    </div>
    <!-- MYSQL backup -->
  </div>
  
</div>

</form>
<!-- actions menu -->
</div>
<script>

</script>
<?php echo $footer ?>