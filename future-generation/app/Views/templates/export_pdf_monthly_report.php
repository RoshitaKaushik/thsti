<?php

//echo "<pre>"; print_r($this->session->userdata());
$total_days_month=cal_days_in_month(CAL_GREGORIAN,$selected_month,$selected_year);
$newDateTime = '05'.'-'.$selected_month.'-'.$selected_year ;
        
       // echo date('M Y',strtotime($newDateTime));

 ?>
 <?php /*$total_days_month =date('t');*/ ?>
 
<style>
   
   th{
        font-weight:bold;
        text-align:center;
        font-family: "Times New Roman", Times, serif;
        font-size: 9px;
       
       
    }
    td
    {
        font-family: "Times New Roman", Times, serif;
        font-size: 8px;
        text-align: center;
        
    }
   
</style>

<table style="margin-bottom: 10px;">
    <thead>
         <tr class="hide">
                <th colspan="<?= $total_days_month+3 ?>">
                    <b>Future Generations University Timesheet</b>
                </th>
            </tr>
            <tr class="hide">
                <th colspan="<?= $total_days_month+3 ?>">
                    <b><?php echo ($User_option == 0 ) ? $_SESSION['admin_fullname']: $User_option_name['FirstName'] . " ". $User_option_name['LastName'];?></b>
                </th>
            </tr>
            <tr class="hide">
                <th colspan="<?= $total_days_month+3 ?>">
                    <b><?php  echo date('M Y',strtotime($newDateTime)); ?></b>
                </th>
            </tr>
    </thead>
</table>
<table id="monthlyReport" border="1" cellpadding="3" cellspacing="0">
       <thead>
           
            <tr>
                <th height="30" width="50">Program</th>
                <?php
                 for($i=1; $i<=$total_days_month; $i++){
                ?>
                <th><?php echo $i; ?></th>
                 <?php }?>
                <th>Hrs</th>
                <th>Days</th>
            </tr>
        </thead>
        <tbody>
               <?php  for($i=1; $i<=$total_days_month; $i++){   
                         ${'atendanceof_'.$i}=array();   
                    } ?>  
              <?php 
              $grandsum=array();
                                   
             
              foreach ($records_category as $key => $value) {
                 
                $sum_hr=$sum_min=array();
                $sum_array=array();
                  ?>
            <tr>
                <td width="50" style="text-align:left;"><?=$value['catagory_name'] ?></td>
                <?php
                 for($i=1; $i<=$total_days_month; $i++){

                     $current_date = $selected_year.'-'.$selected_month."-".$i;                                   
                    ?>
                <td>
                    <?php  foreach ($records as  $valuee) { 

                    $s = $valuee['transaction_date'];
                    $dt = new DateTime($s);
                    $trans_date = $dt->format('Y-m-d'); 
                     if(strtotime($current_date) == strtotime($trans_date) && $value['id']== $valuee['category_id'] ){ ?><?php
                      if($valuee['t_minutes']=='0'){echo $hr_min=$valuee['t_hours'];}
                      else{ 
                        echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']); 
                    }
                      //echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']);  
                     //echo str_replace(".",":",$hr_min);
                     ${'atendanceof_'.$i}[]=$sum_array[]=$grandsum[]=$hr_min; $sum_hr[]=$valuee['t_hours']; $sum_min[]=$valuee['t_minutes']; } } ?>
                </td>
                 <?php  }?>
                <td>
                  <?php foreach ($records_sum_cat as $rvalue) { ?>
                    <?php if($value['id']==$rvalue['id']){ echo $tot_hr=hourdecFormating($rvalue['t_hours'],$rvalue['t_minutes']);
                   } } ?>
                  </td>
                <td>
                    <?php echo @calc_hrtodays($tot_hr)?></td>
            </tr>
        
            <?php } ?>
            <tr>
               
<td>TOTAL : </td>
<?php
 for($i=1; $i<=$total_days_month; $i++){

    if($i<10){
      $current_date = $selected_year.'-'.$selected_month."-0".$i;
    }else
    {
      $current_date = $selected_year.'-'.$selected_month."-".$i;
    }
                                        
    ?>
    <td>
     
       <?php foreach($records_sum_day as ${'records_sum_day'.'_'.$i} ){ 
       
         if(${'records_sum_day'.'_'.$i}['transaction_date']==$current_date){
           echo hourdecFormating(${'records_sum_day'.'_'.$i}['t_hours'],${'records_sum_day'.'_'.$i}['t_minutes']);
           } 
          }

           ?>
       
    </td>
      <?php } ?>
      <td><?php echo $grandsumhr=hourdecFormating($records_sum['t_hours'],$records_sum['t_minutes']) ;
        ?>
          
      </td>
      <td><?=@calc_hrtodays($grandsumhr) ?></td>
  </tr>
  </tbody>
</table>
  <?php

$param['hours_to_work'] =$Sum_hour_contract=(float)($Sum_hour_contract);
$param['cary_hours_to_work'] = ($cary_Sum_hour_contract);
$param['hours_worked'] = $sum_fisical['t_hours'];
$param['minutes_worked'] = $sum_fisical['t_minutes'];
//  $calculated_attendance = calculated_attendance($param);

$total_worked = (float)hourdecFormating($param['hours_worked'], $param['minutes_worked']);

$dif=(float)"80.00";
?>
<table>  
 <tr class="hide">
   <td colspan="<?= $total_days_month+3 ?>"></td>  
 </tr>
 <tr class="hide">
    <td colspan="<?= $total_days_month+3 ?>"></td> 
 </tr>
  <tr class="hide">
     <td colspan="<?php if($total_days_month=='31'){ echo "17"; }elseif($total_days_month=='30'){ echo "16"; }elseif($total_days_month=='29'){ echo "15"; }else{ echo "14"; } ?>"><b>Days Worked This Fiscal Year : <!-- <?php $grandsumday=number_format((float) array_sum($grandsum)/8, 2, '.', ''); print(Hr_min_sum($grandsumday));  ?> -->
      <?php $grandsumhr=hourdecFormating($sum_fisical['t_hours'],$sum_fisical['t_minutes']) ; ?>
         <?=@calc_hrtodays($grandsumhr)?><!-- <?=number_format((float)$grandsumhr/8, 2, '.', '');?> -->
      </b>
      </td>
      <td colspan="17"><b>Hours Worked This Fiscal Year : <?php echo $grandsumhr=hourdecFormating($sum_fisical['t_hours'],$sum_fisical['t_minutes']) ; 
      /* $exp=explode('.', $grandsumhr);
        echo $exp[0].":".($exp[1])*/

       ?></b></td>
      
      
  </tr>
  <tr class="hide">
     
      <td colspan="<?php if($total_days_month=='31'){ echo "17"; }elseif($total_days_month=='30'){ echo "16"; }elseif($total_days_month=='29'){ echo "15"; }else{ echo "14"; } ?>"><b>Days Left on Contract : 
        <?//=@$calculated_attendance['total_left_days']?> 
        <?=@calc_hrtodays($Sum_hour_contract-$total_worked)?>
              </b>
      </td>
      <td colspan="17">
        <b>Hours Left on Contract : 
          <?php  /*@$calculated_attendance['total_left_hours'];
          echo hourmintodecFormating($calculated_attendance['total_left_hours']);*/

          echo ($Sum_hour_contract-$total_worked)
        ?>
          

        </b></td>

  </tr>
  <tr class="hide">
      <td colspan="17"><b>Number of Days Contracted   : <?php echo (number_format((float)$param['hours_to_work']/8, 2, '.', '')) 
?>
      </b>
      </td>
      <td colspan="<?php if($total_days_month=='31'){ echo "17"; }elseif($total_days_month=='30'){ echo "16"; }elseif($total_days_month=='29'){ echo "15"; }else{ echo "14"; } ?>"><b>Number of Hours Contracted : 
       <?php echo (number_format((float)$param['hours_to_work'], 2, '.', '')) ;
?>
              </b>
      </td>

  </tr>   
  <tr class="hide">
      <td colspan="17"><b>Number of Days Carried Over From Previous Yr   : <?php echo (number_format((float)$param['cary_hours_to_work'] /8, 2, '.', '')) 
?>
      </b>
      </td>
      <td colspan="<?php if($total_days_month=='31'){ echo "17"; }elseif($total_days_month=='30'){ echo "16"; }elseif($total_days_month=='29'){ echo "15"; }else{ echo "14"; } ?>"><b>Number of Hours Carried Over From Previous Yr : 
        <?php echo (number_format((float)$param['cary_hours_to_work'], 2, '.', '')) 
?>
              </b>
      </td>

  </tr>                                            
        
        </tbody>   
      
</table>

