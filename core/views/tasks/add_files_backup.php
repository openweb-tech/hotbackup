<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><?php echo $_LANG['tasks']['New Files backup'] ?></h1>
<!-- actions menu -->
<form method="post">
<input type="hidden" name="action" value="tasks/add_files_backup">
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6 align-right">
    <a href="<?php echo __siteurl ?>/?r=tasks/list" class="btn"><?php echo $_LANG['actions']['Back'] ?></a>
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
    
    <!-- FILES backup -->
    <div class="taskTypes" id="MYSQL-backup" >
      <fieldset class="form-group">
        <label><?php echo $_LANG['tasks']['Folder/file name'] ?></label>
        <input type="text" name="file-filename" class="form-control">
      </fieldset>
      <fieldset class="form-group">
        <label><?php echo $_LANG['tasks']['Exclude files/folders'] ?></label>
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