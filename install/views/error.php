<?php echo $header ?>
<div class="container">
<h1 class="align-center"><?php echo $title ?></h1>
<br />
<div class="row">
  <div class="col-md-3">
  
  </div>
  
  <div class="col-md-6">
    <div class="alert alert-danger">
      <span class="">Error!</span> <?php echo $error ?>
    </div>
    <br />
    <br />
    <p class="align-center"><a href="<?php echo $installPath ?>" class="btn btn-primary">Go to install</a></p>    
  </div>
  
  <div class="col-md-3">
  
  </div>
  
</div>

</div>
<?php echo $footer ?>