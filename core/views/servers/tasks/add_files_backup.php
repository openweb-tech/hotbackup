<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><a href="<?php echo __siteurl ?>/?r=servers/server_tasks_list&id=<?php echo $sid ?>"><?php echo $serverName ?></a> / New Files backup</h1>
<!-- actions menu -->
<form method="post">
<input type="hidden" name="action" value="servers/tasks/add_files_backup">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
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
    
    <!-- FILES backup -->
    <div class="taskTypes" id="MYSQL-backup" >
      <fieldset class="form-group">
        <label>Folder/file name</label>
        <input type="text" name="file-filename" class="form-control">
      </fieldset>
      <fieldset class="form-group">
        <label>Exclude files/folders (every item on new line)</label>
        <textarea name="file-exclude" class="form-control" style="height:240px;"></textarea>
      </fieldset>
    </div>
    <!-- FILES backup -->
  </div>
  
</div>

</form>
<!-- actions menu -->
</div>
<script>

</script>
<?php echo $footer ?>