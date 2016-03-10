<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1>Connect to the server</h1>
<!-- actions menu -->
<form method="post">
<input type="hidden" name="action" value="servers/add_server">
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6 align-right">
    <a href="<?php echo __siteurl ?>/?r=servers/servers" class="btn">Back</a>
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
  <div class="col-md-6">
    <p><label>Address</label><br><input type="text" class="form-control" name="address" value="<?php echo $formSent['address'] ?>" placeholder="http://www.your-server.com/backup"></p>
    <p><label>Api key</label><br><input type="text" class="form-control" name="apiKey" value="<?php echo $formSent['apiKey'] ?>" ></p>
    <p><label>Download archives</label><br>
      <select class="form-control" name="archSync">
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>
    </p>
    <p><label>Archive depth</label><br>
      <input  type="number" class="form-control" name="depth" value="2">
    </p>
  </div>
  
  <div class="col-md-6">

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