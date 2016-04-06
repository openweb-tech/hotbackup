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
    <fieldset class="form-group">
      <label>Title</label>
      <input type="text" class="form-control" name="title" value="<?php  ?>" >
    </fieldset>
    <fieldset class="form-group">
      <label>Status</label>
      <select class="form-control" name="status">
        <option value="1" class="tag_enabled">Enabled</option>
        <option value="0" class="tag_disabled">Disabled</option>
      </select>
    </fieldset>
    <fieldset class="form-group">
      <label>Archiving depth</label>
      <input  type="number" class="form-control" name="deep" value="1">
    </fieldset>
    
    <?php echo $widgets->show('DateTimePicker', array()); ?>
    
  </div>
  
  <div class="col-md-4">
    
    <!-- MYSQL backup -->
    <div class="taskTypes" id="MYSQL-backup" >
      <fieldset class="form-group">
        <label>DB address</label>
        <input type="text" name="mysql-backup-address" class="form-control">
      </fieldset>
      <fieldset class="form-group">
        <label>DB name</label>
        <input type="text" name="mysql-backup-name" class="form-control">
      </fieldset>
      <fieldset class="form-group">
        <label>DB user</label>
        <input type="text" name="mysql-backup-user" class="form-control">
      </fieldset>
      <fieldset class="form-group">
        <label>DB password</label>
        <input type="text" name="mysql-backup-password" class="form-control">
      </fieldset>
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