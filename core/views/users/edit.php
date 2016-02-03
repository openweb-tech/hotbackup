<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1>User #<?php echo $id ?></h1>
<!-- actions menu -->
<form method="post">
<input type="hidden" name="action" value="users/update">
<input type="hidden" name="id" value="<?php echo $id ?>">
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
    <p><label>Login</label><br><input type="text" class="form-control" name="login" value="<?php echo $user['login'] ?>" ></p>
    <p><label>E-mail</label><br><input type="text" class="form-control" name="email" value="<?php echo $user['email'] ?>" ></p>
  </div>
  
  <div class="col-md-4">
    <p><label>Password</label><br><input type="text" class="form-control" name="password1" value="<?php echo $user['password1'] ?>" ></p>
    <p><label>Password</label><br><input type="text" class="form-control" name="password2" name="password1" value="<?php echo $user['password2'] ?>"></p>
  </div>
  
  <div class="col-md-4">
    <p><label>Access group</label><br>
      <select class="form-control" name="accessGroup">
        <option value="administrator">Administrator</option>
        <option value="manager">Manager</option>
        <option value="guest">Guest</option>
      </select>
    </p>
    <p><label>Alerts</label><br>
      <select class="form-control" name="alerts">
        <option value="none">None</option>
        <option value="all">All</option>
      </select>
    </p>
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