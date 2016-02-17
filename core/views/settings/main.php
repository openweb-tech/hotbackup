<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1>Main settings</h1>
<!-- actions menu -->
<form method="post">
<input type="hidden" name="action" value="settings/update_main">
<input type="hidden" name="id" value="<?php echo $id ?>">
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6 align-right">
    <a href="<?php echo __siteurl ?>/?r=settings/main" class="btn">Cancel</a>
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
    <p><label>Server name</label><br><input type="text" class="form-control" name="serverName" value="<?php echo $settings['serverName'] ?>" ></p>
    <p><label>Short name</label><br><input type="text" class="form-control" name="shortName" value="<?php echo $settings['shortName'] ?>" ></p>
    <p><label>Api key</label><br><input type="text" class="form-control" name="apiKey" value="<?php echo $settings['apiKey'] ?>" ></p>
  </div>
  
  <div class="col-md-4">

  </div>
  
  <div class="col-md-4">

  </div>
</div>

</form>
<!-- actions menu -->
</div>
<script>

$(document).ready(function(){



});

</script>
<?php echo $footer ?>