<?php
$widgets = new Widgets($this->db, __corePath.'widgets/', $this->config);
?>
<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><?php echo $_LANG['misc']['home_title'] ?></h1>
<div class="row">
  <!-- 1 -->
  <div class="col-md-8">
    <!-- backups table -->
    <div class="backupsGraph">
      <?php
      function calcPercent($maxVal, $val)
        {
        return round( ($val/$maxVal)*100 );
        }
      $count = 0;
      foreach($backUpsUsage as $key => $val)
        {
        $count++;
        if($count > 30) break;
      ?>
      <div class="graphRow">
        <div class="graphIndicator" style="width: <?php echo calcPercent($maxUsage, $val['value']) ?>%;"></div>
        <div class="graphIndicatorValue"><?php echo memoryFormat($val['value']) ?></div>
        <div class="graphLabel"><?php echo $val['label'] ?></div>
        <div class="graphLabel"><?php echo $val['label'] ?></div>
        <div class="graphLabel"><?php echo $val['label'] ?></div>
      </div>
      <?php 
        }
      ?>
    </div>
    <!-- backups table -->
  </div>
  <!-- 2 -->
  <div class="col-md-4 align-center">
    <?php echo $hddUsage ?>
  </div>

</div>

</div>
<?php echo $footer ?>