<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><?php echo $_LANG['store']['Store'] ?></h1>
<div class="row">
  <div class="col-md-12">
  
    <a href="<?php echo __siteurl ?>/?r=store/local" class="folder">
      <div>
        <div><?php echo $_LANG['store']['Local'] ?></div>
      </div>
    </a>

    <a href="<?php echo __siteurl ?>/?r=store/remote" class="folder">
      <div>
        <div><?php echo $_LANG['store']['Remote'] ?></div>
      </div>
    </a>
    
  </div>
</div>
</div>
<script>
</script>
<?php echo $footer ?>