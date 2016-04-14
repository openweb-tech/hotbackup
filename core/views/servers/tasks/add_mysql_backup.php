<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><a href="<?php echo __siteurl ?>/?r=servers/server_tasks_list&id=<?php echo $sid ?>"><?php echo $serverName ?></a> / <?php echo $_LANG['tasks']['New MYSQL backup'] ?></h1>
<!-- actions menu -->
<form method="post">
<input type="hidden" name="action" value="servers/tasks/add_mysql_backup">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6 align-right">
    <a href="<?php echo __siteurl ?>/?r=servers/server_tasks_list&id=<?php echo $sid ?>" class="btn"><?php echo $_LANG['actions']['Back'] ?></a>
    <input type="submit" class="btn btn-primary" value="<?php echo $_LANG['actions']['Save'] ?>">
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
      <label><?php echo $_LANG['tasks']['Title'] ?></label>
      <input type="text" class="form-control" name="title" value="" >
    </fieldset>
    <fieldset class="form-group">
      <label><?php echo $_LANG['tasks']['Status'] ?></label>
      <select class="form-control" name="status">
        <option value="1" class="tag_enabled"><?php echo $_LANG['actions']['tag_enabled'] ?></option>
        <option value="0" class="tag_disabled"><?php echo $_LANG['actions']['tag_disabled'] ?></option>
      </select>
    </fieldset>
    <fieldset class="form-group">
      <label><?php echo $_LANG['tasks']['Archiving depth'] ?></label>
      <input  type="number" class="form-control" name="deep" value="1">
    </fieldset>
    
    <?php echo $widgets->show('DateTimePicker', array()); ?>
    
  </div>
  
  <div class="col-md-4">
    
    <!-- MYSQL backup -->
    <div class="taskTypes" id="MYSQL-backup" >
      <fieldset class="form-group">
        <label><?php echo $_LANG['tasks']['DB address'] ?></label>
        <input type="text" name="mysql-backup-address" class="form-control">
      </fieldset>
      <fieldset class="form-group">
        <label><?php echo $_LANG['tasks']['DB name'] ?></label>
        <input type="text" name="mysql-backup-name" class="form-control">
      </fieldset>
      <fieldset class="form-group">
        <label><?php echo $_LANG['tasks']['DB user'] ?></label>
        <input type="text" name="mysql-backup-user" class="form-control">
      </fieldset>
      <fieldset class="form-group">
        <label><?php echo $_LANG['tasks']['DB password'] ?></label>
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