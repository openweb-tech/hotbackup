<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><?php echo $_LANG['servers']['Connectin information'] ?></h1>
<!-- actions menu -->
<form method="post">
<input type="hidden" name="action" value="servers/update_server">
<input type="hidden" name="id" value="<?php echo $formSent['id'] ?>">
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6 align-right">
    <a href="<?php echo __siteurl ?>/?r=servers/servers" class="btn"><?php echo $_LANG['actions']['Back'] ?></a>
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
  <div class="col-md-6">
    <fieldset class="form-group">
      <label><?php echo $_LANG['servers']['Address'] ?></label>
      <input type="text" class="form-control" name="address" value="<?php echo $formSent['address'] ?>" placeholder="http://www.your-server.com/backup">
    </fieldset>
    <fieldset class="form-group">
      <label><?php echo $_LANG['servers']['Api key'] ?></label>
      <input type="text" class="form-control" name="apiKey" value="<?php echo $formSent['apiKey'] ?>" >
    </fieldset>
    <fieldset class="form-group">
      <label><?php echo $_LANG['servers']['Download archives'] ?></label>
      <select class="form-control" name="archSync">
        <option value="1"><?php echo $_LANG['actions']['Yes'] ?></option>
        <option value="0"><?php echo $_LANG['actions']['No'] ?></option>
      </select>
    </fieldset>
    <fieldset class="form-group">
      <label><?php echo $_LANG['servers']['Archive depth'] ?></label>
      <input  type="number" class="form-control" name="depth" value="<?php echo $formSent['archDepth']  ?>">
    </fieldset>
    <fieldset class="form-group">
      <label><?php echo $_LANG['servers']['Delete archives after synchronization'] ?></label>
      <select class="form-control" name="deleteSync">
        <option value="1"><?php echo $_LANG['actions']['Yes'] ?></option>
        <option value="0"><?php echo $_LANG['actions']['No'] ?></option>
      </select>
    </fieldset>
  </div>
  
  <div class="col-md-6">

  </div>
  
</div>

</form>
<!-- actions menu -->
</div>
<script>

$(document).ready(function(){
  $('select[name="archSync"]').val('<?php echo $formSent['archSync'] ?>');
  $('select[name="deleteSync"]').val('<?php echo $formSent['deleteSync'] ?>');
});

</script>
<?php echo $footer ?>