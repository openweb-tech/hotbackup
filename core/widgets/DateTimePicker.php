    <p><label>Start</label><br>
      <select class="form-control" name="n-start">
        <option value="n-minutes">Every n minutes</option>
        <option value="n-every-hour">Every hour</option>
        <option value="n-day">Every Day</option>
        <option value="n-month">Every Month</option>
        <option value="n-once">Once</option>
      </select>
    </p>
    
    <!-- Once -->
    <div class="execTime" id="n-once" style="display:none;">
      <div class="row pseudo-p">
      
        <div class="col-md-4">
        <label>Month</label><br>
        <select class="form-control" name="n-once-month">
         <?php 
         for($i=0;$i<12;$i++)
           echo "<option value='$i'>".date("M",mktime(0,0,0,$i,1,2000))."</option>\n";
         ?>
        </select>
        </div>
        
        <div class="col-md-4">
        <label>Day</label><br>
        <select class="form-control" name="n-once-day">
         <?php 
         for($i=1;$i<31;$i++)
           echo "<option value='$i'>$i</option>\n";
         ?>
        </select>
        </div>
        
        <div class="col-md-4">
        <label>Year</label><br>
        <select class="form-control" name="n-once-year">
         <?php
         $curYear = date('Y', time());
         for($i=$curYear;$i<($curYear+5);$i++)
           echo "<option value='$i'>$i</option>\n";
         ?>
        </select>
        </div>
      </div>
      <div class="row pseudo-p">
        <div class="col-md-6">
        <label>Hour</label><br>
        <select class="form-control" name="n-once-hour">
         <?php 
         for($i=0;$i<23;$i++)
           echo "<option value='$i'>$i</option>\n";
         ?>
        </select>
        </div>
        
        <div class="col-md-6">
        <label>Minutes</label><br>
        <select class="form-control" name="n-once-minutes">
         <?php 
         for($i=0;$i<59;$i++)
           echo "<option value='$i'>$i</option>\n";
         ?>
        </select>
        </div>
        
      </div>
    </div>
    <!-- Once -->
    
    <!-- Every n Month -->
    <div class="execTime" id="n-month" style="display:none;">
      <div class="row pseudo-p">
        <div class="col-md-4">
        <label>Day</label><br>
        <select class="form-control" name="n-month-day">
         <?php 
         for($i=1;$i<30;$i++)
           echo "<option value='$i'>$i</option>\n";
         ?>
        </select>
        </div>
      
        <div class="col-md-4">
        <label>Hour</label><br>
        <select class="form-control" name="n-month-hour">
         <?php 
         for($i=0;$i<23;$i++)
           echo "<option value='$i'>$i</option>\n";
         ?>
        </select>
        </div>
        
        <div class="col-md-4">
        <label>Menutes</label><br>
        <select class="form-control" name="n-month-minutes">
         <?php 
         for($i=0;$i<59;$i++)
           echo "<option value='$i'>$i</option>\n";
         ?>
        </select>
        </div>
        
      </div>
    </div>
    <!-- Every n Month -->
    
    <!-- Every n Day -->
    <div class="execTime" id="n-day" style="display:none;">
      <div class="row pseudo-p">
        <div class="col-md-6">
        <label>Hour</label><br>
        <select class="form-control" name="n-day-hour">
         <?php 
         for($i=0;$i<23;$i++)
           echo "<option value='$i'>$i</option>\n";
         ?>
        </select>
        </div>
        
        <div class="col-md-6">
        <label>Menutes</label><br>
        <select class="form-control" name="n-day-minute">
         <?php 
         for($i=0;$i<59;$i++)
           echo "<option value='$i'>$i</option>\n";
         ?>
        </select>
        </div>
        
      </div>
    </div>
    <!-- Every n Day -->
    
    <!-- Every every hour -->
    <div class="execTime" id="n-every-hour" style="display:none;">
      <label>Menutes</label><br>
      <select class="form-control" name="n-every-hour-minute">
       <?php 
       for($i=0;$i<60;$i++)
         echo "<option value='$i'>$i</option>\n";
       ?>
      </select>      
    </div>
    <!-- Every every hour -->
    
    <!-- Every n minutes -->
    <div class="execTime" id="n-minutes">
      <label>Menutes</label><br>
      <select class="form-control" name="n-minutes-minute">
       <?php 
       for($i=0;$i<60;$i++)
         echo "<option value='$i'>$i</option>\n";
       ?>
      </select>      
    </div>
    <!-- Every n minutes -->
    
<script>
$(document).ready(function(){

<?php

if(isset($frequency))
{

?>
$('.execTime').css({'display':'none'});
$('#<?php echo $frequency['type'] ?>').css({'display':'block'});
<?php 

switch($frequency['type']) 
{
  case 'n-minutes':
  ?>
  
  $('select[name="n-minutes-minute"]').val(<?php echo $frequency['n-minutes-minute'] ?>);
   
  <?php
  break;
  
  case 'n-every-hour':
  ?>
  
  $('select[name="n-every-hour-minute"]').val(<?php echo $frequency['n-every-hour-minute'] ?>);
  
  <?php
  break;
  
  case 'n-day':
  ?>
  
  $('select[name="n-day-hour"]').val(<?php echo $frequency['n-day-hour'] ?>);
  $('select[name="n-day-minute"]').val(<?php echo $frequency['n-day-minute'] ?>);
  
  <?php
  break;
  
  case 'n-month':
  ?>
  
  $('select[name="n-month-day"]').val(<?php echo $frequency['n-month-day'] ?>);
  $('select[name="n-month-hour"]').val(<?php echo $frequency['n-month-hour'] ?>);
  $('select[name="n-month-minutes"]').val(<?php echo $frequency['n-month-minutes'] ?>);
  
  <?php
  break;
  
  case 'n-once':
  ?>
  
  $('select[name="n-once-month"]').val(<?php echo $frequency['n-once-month'] ?>);
  $('select[name="n-once-day"]').val(<?php echo $frequency['n-once-day'] ?>);
  $('select[name="n-once-year"]').val(<?php echo $frequency['n-once-year'] ?>);
  $('select[name="n-once-hour"]').val(<?php echo $frequency['n-once-hour'] ?>);
  $('select[name="n-once-minutes"]').val(<?php echo $frequency['n-once-minutes'] ?>);
  
  <?php
  break;

}

}
?>

  $('select[name="n-start"]').change(function(){
    $(".execTime").css({"display":"none"});
    $("#"+$(this).val()).css({"display":"block"});
  });
 
});
</script>