<?php
if($visible) {
?>
<div class="container">
<?php
foreach($notifications as $notification) {
  ?>
  <div class="alert alert-<?php echo $notification['type'] ?>">
    <?php echo $notification['message'] ?>
  </div>
  <?php 
  }
  ?>
</div>
<?php
}
?>