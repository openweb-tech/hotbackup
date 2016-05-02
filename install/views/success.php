<?php echo $header ?>
<div class="container">
<h1 class="align-center"><?php echo $title ?></h1>
<br />
<div class="row">
  <div class="col-md-3">
  
  </div>
  
  <div class="col-md-6">
    <p>OpenBackup was successfully installed. Don't forget to delete "install" folder before OpenBackup usage.</p>
    <div class="alert alert-warning">
      <span class="">Warning!</span> Next, you need to add backend tasks to the cron service:
    </div>
    <ul>
      <li>* * * * * php <?php echo $serversServiceCron ?></li>
      <li>*/5 * * * * php <?php echo $tasksServiceCron ?></li>
    </ul>
    <br />
    <br />
    <p class="align-center"><a href="<?php echo $dashboardUrdl ?>" class="btn btn-primary">Go to dashboard</a></p>    
  </div>
  
  <div class="col-md-3">
  
  </div>
  
</div>

</div>
<?php echo $footer ?>