<?php echo $header ?>
<div class="container">
<h1 class="align-center"><?php echo $title ?></h1>
<div class="row">
  <div class="col-md-4">
  
  </div>
  
  <div class="col-md-4">
  <?php
  foreach($notifications as $notification) {
    ?>
    <div class="alert alert-<?php echo $notification['type'] ?>">
      <?php echo $notification['message'] ?>
    </div>
    <?php 
    }
    ?>
    <p class="align-right">
      <a href="<?php echo $workUrl ?>install" class="btn btn-primary">Continue</a>
    </p>
  </div>
  
  <div class="col-md-4">
  
  </div>
  
</div>

</div>
<?php echo $footer ?>