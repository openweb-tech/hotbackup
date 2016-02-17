<?php 
$id = 'pie'.mt_rand(1000, 99999);
?>
<div class="pieWidget">
  <h3><?php echo $title ?></h3>
  <canvas id="<?php echo $id ?>" width="300" height="300"/>
</div>
<script>
$(document).ready(function() {
var pieData = [<?php 
$zpt = '';
foreach($data  as $item)
{
echo $zpt.'{value: "'.$item['value'].'", color: "'.$item['color'].'", highlight: "'.$item['highlight'].'", label: "'.$item['label'].'"}';
$zpt = ', ';
}
?>];  
  var ctx = document.getElementById("<?php echo $id ?>").getContext("2d");
  window.<?php echo $id ?> = new Chart(ctx).Pie( pieData, {animationSteps : 50});
});
</script>