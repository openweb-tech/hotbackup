<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1>New user</h1>
<!-- actions menu -->
<form method="post">
<input type="hidden" name="action" value="users/add">
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6 align-right">
    <a href="<?php echo __siteurl ?>/?r=users/list" class="btn">Back</a>
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
      <label>Login</label>
      <input type="text" class="form-control" name="login" value="<?php echo $formSent['login'] ?>" >
    </fieldset>
    <fieldset class="form-group">
      <label>E-mail</label>
      <input type="text" class="form-control" name="email" value="<?php echo $formSent['email'] ?>" >
    </fieldset>
  </div>
  
  <div class="col-md-4">
    <fieldset class="form-group">
      <label>Password</label>
      <input type="text" class="form-control" name="password1" value="<?php echo $formSent['password1'] ?>" >
    </fieldset>
    <fieldset class="form-group">
      <label>Password</label>
      <input type="text" class="form-control" name="password2" name="password1" value="<?php echo $formSent['password2'] ?>">
    </fieldset>
  </div>
  
  <div class="col-md-4">
    <fieldset class="form-group">
      <label>Access group</label>
      <select class="form-control" name="accessGroup">
        <option value="administrator">Administrator</option>
        <option value="manager">Manager</option>
        <option value="guest">Guest</option>
      </select>
    </fieldset>
    <fieldset class="form-group">
      <label>Alerts</label>
      <select class="form-control" name="alerts">
        <option value="none">None</option>
        <option value="all">All</option>
      </select>
    </fieldset>
  </div>
</div>

</form>
<!-- actions menu -->
</div>
<script>

$(document).ready(function(){

  $('select[name="accessGroup"]').val('<?php echo $formSent['accessGroup'] ?>');
  $('select[name="alerts"]').val('<?php echo $formSent['alerts'] ?>');

});

</script>
<?php echo $footer ?>