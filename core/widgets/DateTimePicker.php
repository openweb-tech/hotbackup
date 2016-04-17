    <fieldset class="form-group">
      <label><?php echo $_LANG['ts_widget']['Start'] ?></label>
      <select class="form-control" name="n-start">
        <option value="n-minutes"><?php echo $_LANG['ts_widget']['Every n minutes'] ?></option>
        <option value="n-every-hour">Every hour</option>
        <option value="n-day"><?php echo $_LANG['ts_widget']['Every hour'] ?></option>
        <option value="n-month"><?php echo $_LANG['ts_widget']['Every Month'] ?></option>
        <option value="n-once"><?php echo $_LANG['ts_widget']['Once'] ?></option>
      </select>
    </fieldset>
    
    <!-- Once -->
    <div class="execTime" id="n-once" style="display:none;">
      <div class="row pseudo-p">
      
        <div class="col-md-4">
          <fieldset class="form-group">
            <label><?php echo $_LANG['ts_widget']['Month'] ?></label>
            <select class="form-control" name="n-once-month">
             <?php 
             for($i=0;$i<12;$i++)
               echo "<option value='$i'>".date("M",mktime(0,0,0,$i,1,2000))."</option>\n";
             ?>
            </select>
          </fieldset>
        </div>
        
        <div class="col-md-4">
          <fieldset class="form-group">
            <label><?php echo $_LANG['ts_widget']['Day'] ?></label>
            <select class="form-control" name="n-once-day">
            <?php 
            for($i=1;$i<31;$i++)
              echo "<option value='$i'>$i</option>\n";
            ?>
            </select>
          </fieldset>
        </div>
        
        <div class="col-md-4">
          <fieldset class="form-group">
            <label><?php echo $_LANG['ts_widget']['Year'] ?></label>
            <select class="form-control" name="n-once-year">
             <?php
             $curYear = date('Y', time());
               for($i=$curYear;$i<($curYear+5);$i++)
                 echo "<option value='$i'>$i</option>\n";
             ?>
            </select>
          </fieldset>
        </div>
      </div>
      
      <div class="row pseudo-p">
        <div class="col-md-6">
          <fieldset class="form-group">
            <label><?php echo $_LANG['ts_widget']['Hour'] ?></label>
            <select class="form-control" name="n-once-hour">
             <?php 
             for($i=0;$i<23;$i++)
               echo "<option value='$i'>$i</option>\n";
             ?>
            </select>
          </fieldset>
        </div>
        
        <div class="col-md-6">
          <fieldset class="form-group">
            <label><?php echo $_LANG['ts_widget']['Minutes'] ?></label>
            <select class="form-control" name="n-once-minutes">
            <?php 
            for($i=0;$i<60;$i+=5)
              echo "<option value='$i'>$i</option>\n";
            ?>
            </select>
          </fieldset>
        </div>
        
      </div>
    </div>
    <!-- Once -->
    
    <!-- Every n Month -->
    <div class="execTime" id="n-month" style="display:none;">
      <div class="row pseudo-p">
      
        <div class="col-md-4">
          <fieldset class="form-group">
            <label><?php echo $_LANG['ts_widget']['Day'] ?></label>
            <select class="form-control" name="n-month-day">
            <?php 
            for($i=1;$i<30;$i++)
              echo "<option value='$i'>$i</option>\n";
            ?>
            </select>
          </fieldset>
        </div>
      
        <div class="col-md-4">
          <fieldset class="form-group">
            <label><?php echo $_LANG['ts_widget']['Hour'] ?></label>
            <select class="form-control" name="n-month-hour">
            <?php 
            for($i=0;$i<23;$i++)
              echo "<option value='$i'>$i</option>\n";
            ?>
            </select>
          </fieldset>
        </div>
        
        <div class="col-md-4">
          <fieldset class="form-group">
            <label><?php echo $_LANG['ts_widget']['Minutes'] ?></label>
            <select class="form-control" name="n-month-minutes">
            <?php 
            for($i=0;$i<60;$i+=5)
              echo "<option value='$i'>$i</option>\n";
            ?>
            </select>
          </fieldset>
        </div>
        
      </div>
    </div>
    <!-- Every n Month -->
    
    <!-- Every n Day -->
    <div class="execTime" id="n-day" style="display:none;">
      <div class="row pseudo-p">
      
        <div class="col-md-6">
          <fieldset class="form-group">
            <label><?php echo $_LANG['ts_widget']['Hour'] ?></label>
            <select class="form-control" name="n-day-hour">
            <?php 
            for($i=0;$i<23;$i++)
              echo "<option value='$i'>$i</option>\n";
            ?>
            </select>
          </fieldset>
        </div>
        
        <div class="col-md-6">
          <fieldset class="form-group">
            <label><?php echo $_LANG['ts_widget']['Minutes'] ?></label>
            <select class="form-control" name="n-day-minute">
            <?php 
            for($i=0;$i<60;$i+=5)
              echo "<option value='$i'>$i</option>\n";
            ?>
            </select>
          </fieldset>
        </div>
        
      </div>
    </div>
    <!-- Every n Day -->
    
    <!-- Every every hour -->
    <div class="execTime" id="n-every-hour" style="display:none;">
      <fieldset class="form-group">
        <label><?php echo $_LANG['ts_widget']['Minutes'] ?></label>
        <select class="form-control" name="n-every-hour-minute">
        <?php 
        for($i=0;$i<60;$i+=5)
          echo "<option value='$i'>$i</option>\n";
        ?>
        </select>
      </fieldset>
    </div>
    <!-- Every every hour -->
    
    <!-- Every n minutes -->
    <div class="execTime" id="n-minutes">
      <fieldset class="form-group">
        <label><?php echo $_LANG['ts_widget']['Minutes'] ?></label>
        <select class="form-control" name="n-minutes-minute">
        <?php 
        for($i=0;$i<60;$i+=5)
          echo "<option value='$i'>$i</option>\n";
        ?>
        </select>
      </fieldset>
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