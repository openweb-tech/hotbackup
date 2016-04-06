<?php echo $header ?>
<div class="container">
<h1 class="align-center"><?php echo $title ?></h1>
<br />
<?php
if($error != '') {
?>
<div class="row">
  <div class="col-md-3">
  
  </div>
  
  <div class="col-md-6">
    <div class="alert alert-danger">
     <strong>Error!</strong> <?php echo $error ?>
    </div>
  </div>
  
  <div class="col-md-3">
  
  </div>
  
</div>
<?php 
}
?>
<div class="row">
  <div class="col-md-4">
  
  </div>
  
  <div class="col-md-4">
    <form method="post">
      <input type="hidden" name="action" value="install">
      <fieldset class="form-group">
        <label for="formGroupExampleInput">Admin login</label>
        <input type="text" class="form-control" id="login" name="login" value="<?php echo $formSent['login'] ?>">
      </fieldset>
      <fieldset class="form-group">
        <label for="formGroupExampleInput">Admin password</label>
        <input type="password" class="form-control" id="password" name="password" value="<?php echo $formSent['password'] ?>">
      </fieldset>
      <fieldset class="form-group">
        <label for="formGroupExampleInput">Password confirmation</label>
        <input type="password" class="form-control" id="password" name="confirmation" value="<?php echo $formSent['confirmation'] ?>">
      </fieldset>
      <fieldset class="form-group">
        <label for="formGroupExampleInput">Admin e-mail</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="john@anymail.com" value="<?php echo $formSent['email'] ?>">
      </fieldset>
      <fieldset class="form-group">
        <label for="formGroupExampleInput">Work folder</label>
        <input type="text" class="form-control" id="folder" name="folder" value="<?php echo $formSent['folder'] ?>">
      </fieldset>
      <fieldset class="form-group">
        <label for="formGroupExampleInput">Work url</label>
        <input type="text" class="form-control" id="workUrl" name="workUrl" value="<?php echo $formSent['workUrl'] ?>">
      </fieldset>
      <fieldset class="form-group align-right">
        <button type="submit" class="btn btn-primary">install</button>
      </fieldset>
    </form>
  </div>
  
  <div class="col-md-4">
  
  </div>
  
</div>

</div>
<?php echo $footer ?>