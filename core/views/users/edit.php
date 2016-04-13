<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><?php echo $_LANG['users']['User'] ?> #<?php echo $id ?></h1>
<!-- actions menu -->
<form method="post">
<input type="hidden" name="action" value="users/update">
<input type="hidden" name="id" value="<?php echo $id ?>">
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6 align-right">
    <a href="<?php echo __siteurl ?>/?r=users/list" class="btn"><?php echo $_LANG['actions']['Back'] ?></a>
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
      <label><?php echo $_LANG['users']['Login'] ?></label>
      <input type="text" class="form-control" name="login" value="<?php echo $user['login'] ?>" >
    </fieldset>
    <fieldset class="form-group">
      <label><?php echo $_LANG['users']['Email'] ?></label>
      <input type="text" class="form-control" name="email" value="<?php echo $user['email'] ?>" >
    </fieldset>
  </div>
  
  <div class="col-md-4">
    <fieldset class="form-group">
      <label><?php echo $_LANG['users']['Password'] ?></label>
      <input type="text" class="form-control" name="password1" value="<?php echo $user['password1'] ?>" >
    </fieldset>
    <fieldset class="form-group">
      <label><?php echo $_LANG['users']['Password'] ?></label>
      <input type="text" class="form-control" name="password2" name="password1" value="<?php echo $user['password2'] ?>">
    </fieldset>
  </div>
  
  <div class="col-md-4">
    <fieldset class="form-group">
      <label><?php echo $_LANG['users']['Access group'] ?></label>
      <select class="form-control" name="accessGroup">
        <option value="administrator"><?php echo $_LANG['users']['Administrator'] ?></option>
        <option value="manager"><?php echo $_LANG['users']['Manager'] ?></option>
        <option value="guest"><?php echo $_LANG['users']['Guest'] ?></option>
      </select>
    </fieldset>
    <fieldset class="form-group">
      <label><?php echo $_LANG['users']['Alerts'] ?></label>
      <select class="form-control" name="alerts">
        <option value="none"><?php echo $_LANG['actions']['None'] ?></option>
        <option value="all"><?php echo $_LANG['actions']['All'] ?></option>
      </select>
    </fieldset>
  </div>
</div>

</form>
<!-- actions menu -->
</div>
<script>

$(document).ready(function(){

  $('select[name="accessGroup"]').val('<?php echo $user['accessGroup'] ?>');
  $('select[name="alerts"]').val('<?php echo $user['alerts'] ?>');

});

</script>
<?php echo $footer ?>