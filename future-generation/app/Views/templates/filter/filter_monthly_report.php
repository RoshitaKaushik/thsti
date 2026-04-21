<div class="col-md-12 table-responsive">
    <table id="attendance_report" class="table table-striped table-bordered " style="font-size: 12px;">
        <thead>
            <tr class="hide">
                <th colspan="<?= $total_days_month+3 ?>">
                    <b>Future Generations University Timesheet</b>
                </th>
            </tr>
            <tr class="hide">
                <th colspan="<?= $total_days_month+3 ?>">
                    <b><?php echo $_SESSION['admin_fullname']?></b>
                </th>
            </tr>
            <tr class="hide">
                <th colspan="<?= $total_days_month+3 ?>">
                    <b><?php  echo date('M Y',strtotime($newDateTime)); ?></b>
                </th>
            </tr>
            <tr>
                <th>Program</th>
                <?php
                 for($i=1; $i<=$total_days_month; $i++){
                ?>
                <th><?php echo $i; ?></th>
                 <?php }?>
                <th style="font-weight: bold;">Hrs</th>
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
                <td style="text-align: left; "><?=$value['catagory_name'] ?></td>
                <?php
                 for($i=1; $i<=$total_days_month; $i++){
        
                     $current_date = $selected_year.'-'.$selected_month."-".$i;                                   
                    ?>
                <td style="text-align: left;" id="attendance_<?=$i ?>_<?=$value['id'] ?>" >
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
                <td style="text-align: center;  font-weight: bold;">
                  <?php foreach ($records_sum_cat as $rvalue) { ?>
                    <?php if($value['id']==$rvalue['id']){ echo $tot_hr=hourdecFormating($rvalue['t_hours'],$rvalue['t_minutes']);
                   } } ?>
                  </td>
                <td style="text-align: center;"><?=@calc_hrtodays($tot_hr)?></td>
            </tr>
        
            <?php } ?>
            <tr style="  font-weight: bold;">
               
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
        <?php
        
        $param['hours_to_work'] =$Sum_hour_contract=(float)($Sum_hour_contract);
        $param['cary_hours_to_work'] = ($cary_Sum_hour_contract);
        $param['hours_worked'] = isset($sum_fisical['t_hours'])??'';
        $param['minutes_worked'] = isset($sum_fisical['t_minutes'])??'';
        //  $calculated_attendance = calculated_attendance($param);
        
        $total_worked = (float)hourdecFormating($param['hours_worked'], $param['minutes_worked']);
        
        $dif=(float)"80.00";
        
        if(!empty($carriedDetails)){
          $dif =  $carriedDetails[0]['hours']; 
        }
        
        
        ?>
        <tr class="hide">
        <td colspan="<?= $total_days_month+3 ?>"></td>  
        </tr>
        <tr class="hide">
        <td colspan="<?= $total_days_month+3 ?>"></td> 
        </tr>
        <tr class="hide">
        <td colspan="<?php if($total_days_month=='31'){ echo "17"; }elseif($total_days_month=='30'){ echo "16"; }elseif($total_days_month=='29'){ echo "15"; }else{ echo "14"; } ?>"><b>Days Worked This Fiscal Year : <!-- <?php $grandsumday=number_format((float) array_sum($grandsum)/8, 2, '.', ''); print(Hr_min_sum($grandsumday));  ?> -->
        <?php $grandsumhr=hourdecFormating(isset($sum_fisical['t_hours'])??'', isset($sum_fisical['t_minutes'])??'') ; ?>
         <?=@calc_hrtodays($grandsumhr)?><!-- <?=number_format((float)$grandsumhr/8, 2, '.', '');?> -->
        </b>
        </td>
        <td colspan="17"><b>Hours Worked This Fiscal Year : <?php echo $grandsumhr=hourdecFormating(isset($sum_fisical['t_hours'])??'', isset($sum_fisical['t_minutes'])??'') ; 
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
    
    
    <?php if(!empty($contractor_details)){ ?>
    <div class="col-md-12" style="padding: top;padding-top:20px;padding-left:17px;"> 
        <?php if($contractor_details[0]['min_contact_id'] != $contractor_details[0]['max_contact_id']){
            echo "<span class='btn btn-success btn-xs'>Linked Contract Details (".date('m/d/Y',strtotime($contractor_details[0]['contract_begin_date']))."  -  ".date('m/d/Y',strtotime($contractor_details[0]['contract_end_date'])).")</span>";
        } ?>
    </div>
    <?php }  ?>

    <div class="col-md-12" style="padding-top:10px;"> 
        <div class="col-md-4" style="font-weight: bold;">
            Number of Days Contracted :
        </div>
        <div class="col-md-2">
            <?php echo (number_format((float)$param['hours_to_work']/8, 2, '.', '')) ?>
        </div>
        <div class="col-md-4"style="font-weight: bold;">
            Number of Hours Contracted :
        </div>
        <div class="col-md-2">
            <?php echo (number_format((float)$param['hours_to_work'], 2, '.', '')) ;?>
        </div>
    </div>
    
    <div class="col-md-12"> 
        <div class="col-md-4" style="font-weight: bold;">
            Number of Days Carried Over :
        </div>
        <div class="col-md-2">
            <?php echo (number_format((float)$param['cary_hours_to_work'] /8, 2, '.', '')); ?>
        </div>
        <div class="col-md-4"style="font-weight: bold;">
            Number of Hours Carried Over:
        </div>
        <div class="col-md-2">
            <?php echo (number_format((float)$param['cary_hours_to_work'], 2, '.', '')); ?>
        </div>
    </div>
    
    <div class="col-md-12" > 
        <div class="col-md-4" style="font-weight: bold;"> 
            Days Worked : 
        </div>
        <div class="col-md-2"> 
            <?php $grandsumhr=hourdecFormating(isset($sum_fisical['t_hours'])??'', isset($sum_fisical['t_minutes'])??'') ;?>
            <?=@calc_hrtodays($grandsumhr)?><!-- <?=number_format((float)$grandsumhr/8, 2, '.', '');?> -->
        </div> 
        <div class="col-md-4" style="font-weight: bold;">  
            Hours Worked : 
        </div>
        <div class="col-md-2">  
            <?php  echo $grandsumhr=hourdecFormating(isset($sum_fisical['t_hours'])??'', isset($sum_fisical['t_minutes'])??'') ; ?>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="col-md-4" style="font-weight: bold;">
            Days Left to Work:
        </div>
        <div class="col-md-2">
            <?php if($total_worked > $Sum_hour_contract){ echo "0.00";
            }else{ echo@calc_hrtodays($Sum_hour_contract-$total_worked); } ?>
            <?//=@$calculated_attendance['total_left_days']?>
        </div>
        
        <div class="col-md-4"style="font-weight: bold;">
            Hours Left to Work:
        </div>
        <div class="col-md-2">
            <?php if($total_worked > $Sum_hour_contract){ echo "0.00";
            }else{ echo($Sum_hour_contract-$total_worked); } ?> 
        </div>
    </div>
    
    <div class="col-md-12"> 
        <div class="col-md-4" style="font-weight: bold;">
            Carry Forward Days:
        </div>
        <div class="col-md-2">
        <?php
            if($total_worked > $Sum_hour_contract){
                if(($total_worked-$Sum_hour_contract)>$dif){
                    if(!empty($carriedDetails)){
                        echo $carriedDetails[0]['days']; 
                    }
                    else{
                        echo "10.00";
                    }
                }else{
                    echo @calc_hrtodays($total_worked-$Sum_hour_contract);
                }
            }else{ 
                echo "0.00";
            }?>
        </div>
        <div class="col-md-4"style="font-weight: bold;">
            Carry Forward Hours :
        </div>
        <div class="col-md-2">
            <?php
            if($total_worked > $Sum_hour_contract){ 
                if(($total_worked-$Sum_hour_contract)>$dif){
                    if(!empty($carriedDetails)){
                        echo $carriedDetails[0]['hours'];
                    }
                    else{
                        echo "80.00";
                    }
                }else{
                    echo number_format((float)($total_worked-$Sum_hour_contract), 2, '.', '');
                }
            }else{ 
                echo "0.00";
            } ?>       
        </div>
    </div>
    
    <div class="col-md-12"> 
        <div class="col-md-4" style="font-weight: bold;">
            Donated Days:
        </div>
        <div class="col-md-2">
            <?php 
            if(($total_worked-$Sum_hour_contract)>$dif){
                echo number_format((float)(($total_worked-$Sum_hour_contract)-$dif)/8, 2, '.', '');  
            }
            else{
                echo "0.00"; 
            } ?>
        </div>
        <div class="col-md-4"style="font-weight: bold;">
            Donated Hours :
        </div>
        <div class="col-md-2">
        <?php
            if(($total_worked-$Sum_hour_contract)>$dif){
                echo number_format((float)(($total_worked-$Sum_hour_contract)-$dif), 2, '.', '');
            }else{
                echo "0.00";
            }
            ?>       
        </div>
    </div>
    
    
     <?php if(!empty($contractor_details)){
     if($contractor_details[0]['min_contact_id'] != $contractor_details[0]['max_contact_id']){?>
    <div class="col-md-12" style="padding: top;padding-top:20px;padding-left:17px;"> 
        <?php 
            echo "<span class='btn btn-success btn-xs'>Contract-1 Details (".date('m/d/Y',strtotime($link_contract1[0]['contract_begin_date']))."  -  ".date('m/d/Y',strtotime($link_contract1[0]['contract_end_date'])).")</span>";
        ?>
    </div>
    
    <?php
        $param['hours_to_work_1'] =$Sum_hour_contract1=(float)($Sum_hour_contract_1);
        $param['cary_hours_to_work_1'] = ($cary_Sum_hour_contract_1);
        $param['hours_worked_1'] = $sum_fisical_1['t_hours'];
        $param['minutes_worked_1'] = $sum_fisical_1['t_minutes'];
        //  $calculated_attendance = calculated_attendance($param);
        $total_worked1 = (float)hourdecFormating($param['hours_worked_1'], $param['minutes_worked_1']);
        $dif=(float)"80.00";
    ?>
    
    <div class="col-md-12" style="padding-top:10px;"> 
        <div class="col-md-4" style="font-weight: bold;">
            Number of Days Contracted :
        </div>
        <div class="col-md-2">
            <?php echo (number_format((float)$param['hours_to_work_1']/8, 2, '.', '')) ?>
        </div>
        <div class="col-md-4"style="font-weight: bold;">
            Number of Hours Contracted :
        </div>
        <div class="col-md-2">
            <?php echo (number_format((float)$param['hours_to_work_1'], 2, '.', '')) ;?>
        </div>
    </div>
    
    <div class="col-md-12"> 
        <div class="col-md-4" style="font-weight: bold;">
            Number of Days Carried Over :
        </div>
        <div class="col-md-2">
            <?php echo (number_format((float)$param['cary_hours_to_work_1'] /8, 2, '.', '')); ?>
        </div>
        <div class="col-md-4"style="font-weight: bold;">
            Number of Hours Carried Over:
        </div>
        <div class="col-md-2">
            <?php echo (number_format((float)$param['cary_hours_to_work_1'], 2, '.', '')); ?>
        </div>
    </div>
    
    <div class="col-md-12" > 
        <div class="col-md-4" style="font-weight: bold;"> 
            Days Worked : 
        </div>
        <div class="col-md-2">
            <?php $grandsumhr=hourdecFormating($sum_fisical_1['t_hours'],$sum_fisical_1['t_minutes']) ;?>
            <?=@calc_hrtodays($grandsumhr)?><!-- <?=number_format((float)$grandsumhr/8, 2, '.', '');?> -->
        </div> 
        <div class="col-md-4" style="font-weight: bold;">  
            Hours Worked :
        </div>
        <div class="col-md-2">  
            <?php  echo $grandsumhr=hourdecFormating($sum_fisical_1['t_hours'],$sum_fisical_1['t_minutes']) ; ?>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="col-md-4" style="font-weight: bold;">
            Days Left to Work:
        </div>
        <div class="col-md-2">
            <?php if($total_worked1 > $Sum_hour_contract1){ echo "0.00";
            }else{ echo@calc_hrtodays($Sum_hour_contract1-$total_worked1); } ?>
            <?//=@$calculated_attendance['total_left_days']?>
        </div>
        
        <div class="col-md-4"style="font-weight: bold;">
            Hours Left to Work:
        </div>
        <div class="col-md-2">
            <?php if($total_worked1 > $Sum_hour_contract1){ echo "0.00";
            }else{ echo($Sum_hour_contract1-$total_worked1); } ?> 
        </div>
    </div>
    
    <div class="col-md-12"> 
        <div class="col-md-4" style="font-weight: bold;">
            Carry Forward Days: 
        </div>
        <div class="col-md-2">
        <?php
            if($total_worked1 > $Sum_hour_contract1){
                if(($total_worked1-$Sum_hour_contract1)>$dif){
                        echo "10.00";
                }else{
                    echo @calc_hrtodays($total_worked1-$Sum_hour_contract1);
                }
            }else{ 
                echo "0.00";
            }?>
        </div>
        <div class="col-md-4"style="font-weight: bold;">
            Carry Forward Hours :
        </div>
        <div class="col-md-2">
            <?php
            if($total_worked1 > $Sum_hour_contract1){ 
                if(($total_worked1-$Sum_hour_contract1)>$dif){
                        echo "80.00";
                }else{
                    echo number_format((float)($total_worked1-$Sum_hour_contract1), 2, '.', '');
                }
            }else{ 
                echo "0.00";
            } ?>       
        </div>
    </div>
    
    <div class="col-md-12"> 
        <div class="col-md-4" style="font-weight: bold;">
            Donated Days:
        </div>
        <div class="col-md-2">
            <?php 
            if(($total_worked1-$Sum_hour_contract1)>$dif){
                echo number_format((float)(($total_worked1-$Sum_hour_contract1)-$dif)/8, 2, '.', '');  
            }
            else{
                echo "0.00"; 
            } ?>
        </div>
        <div class="col-md-4"style="font-weight: bold;">
            Donated Hours :
        </div>
        <div class="col-md-2">
        <?php
            if(($total_worked1-$Sum_hour_contract1)>$dif){
                echo number_format((float)(($total_worked1-$Sum_hour_contract1)-$dif), 2, '.', '');
            }else{
                echo "0.00";
            }
            ?>       
        </div>
    </div>
    
    
    
    <?php if(!empty($contractor_details)){ ?>
    <div class="col-md-12" style="padding: top;padding-top:20px;padding-left:17px;"> 
        <?php if($contractor_details[0]['min_contact_id'] != $contractor_details[0]['max_contact_id']){
            echo "<span class='btn btn-success btn-xs'>Contract-2 Details (".date('m/d/Y',strtotime($link_contract2[0]['contract_begin_date']))."  -  ".date('m/d/Y',strtotime($link_contract2[0]['contract_end_date'])).")</span>";
        } ?>
    </div>
    
    
    
    
    
    <?php
        $param['hours_to_work_2'] =$Sum_hour_contract2=(float)($Sum_hour_contract_2);
        $param['cary_hours_to_work_2'] = ($cary_Sum_hour_contract_2);
        $param['hours_worked_2'] = $sum_fisical_2['t_hours'];
        $param['minutes_worked_2'] = $sum_fisical_2['t_minutes'];
        //  $calculated_attendance = calculated_attendance($param);
        $total_worked2 = (float)hourdecFormating($param['hours_worked_2'], $param['minutes_worked_2']);
        $dif=(float)"80.00";
    ?>
    
    <div class="col-md-12" style="padding-top:10px;"> 
        <div class="col-md-4" style="font-weight: bold;">
            Number of Days Contracted :
        </div>
        <div class="col-md-2">
            <?php echo (number_format((float)$param['hours_to_work_2']/8, 2, '.', '')) ?>
        </div>
        <div class="col-md-4"style="font-weight: bold;">
            Number of Hours Contracted :
        </div>
        <div class="col-md-2">
            <?php echo (number_format((float)$param['hours_to_work_2'], 2, '.', '')) ;?>
        </div>
    </div>
    
    <div class="col-md-12"> 
        <div class="col-md-4" style="font-weight: bold;">
            Number of Days Carried Over :
        </div>
        <div class="col-md-2">
            <?php echo (number_format((float)$param['cary_hours_to_work_2'] /8, 2, '.', '')); ?>
        </div>
        <div class="col-md-4"style="font-weight: bold;">
            Number of Hours Carried Over:
        </div>
        <div class="col-md-2">
            <?php echo (number_format((float)$param['cary_hours_to_work_2'], 2, '.', '')); ?>
        </div>
    </div>
    
    <div class="col-md-12" > 
        <div class="col-md-4" style="font-weight: bold;"> 
            Days Worked : 
        </div>
        <div class="col-md-2">
            <?php $grandsumhr=hourdecFormating($sum_fisical_2['t_hours'],$sum_fisical_2['t_minutes']) ;?>
            <?=@calc_hrtodays($grandsumhr)?><!-- <?=number_format((float)$grandsumhr/8, 2, '.', '');?> -->
        </div> 
        <div class="col-md-4" style="font-weight: bold;">  
            Hours Worked :
        </div>
        <div class="col-md-2">  
            <?php  echo $grandsumhr=hourdecFormating($sum_fisical_2['t_hours'],$sum_fisical_2['t_minutes']) ; ?>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="col-md-4" style="font-weight: bold;">
            Days Left to Work:
        </div>
        <div class="col-md-2">
            <?php if($total_worked2 > $Sum_hour_contract2){ echo "0.00";
            }else{ echo@calc_hrtodays($Sum_hour_contract2-$total_worked2); } ?>
            <?//=@$calculated_attendance['total_left_days']?>
        </div>
        
        <div class="col-md-4"style="font-weight: bold;">
            Hours Left to Work:
        </div>
        <div class="col-md-2">
            <?php if($total_worked2 > $Sum_hour_contract2){ echo "0.00";
            }else{ echo($Sum_hour_contract2-$total_worked2); } ?> 
        </div>
    </div>
    
    <div class="col-md-12"> 
        <div class="col-md-4" style="font-weight: bold;">
            Carry Forward Days: 
        </div>
        <div class="col-md-2">
        <?php
            if($total_worked2 > $Sum_hour_contract2){
                if(($total_worked2-$Sum_hour_contract2)>$dif){
                        echo "10.00";
                }else{
                    echo @calc_hrtodays($total_worked2-$Sum_hour_contract2);
                }
            }else{ 
                echo "0.00";
            }?>
        </div>
        <div class="col-md-4"style="font-weight: bold;">
            Carry Forward Hours :
        </div>
        <div class="col-md-2">
            <?php
            if($total_worked2 > $Sum_hour_contract2){ 
                if(($total_worked2-$Sum_hour_contract2)>$dif){
                        echo "80.00";
                }else{
                    echo number_format((float)($total_worked2-$Sum_hour_contract2), 2, '.', '');
                }
            }else{ 
                echo "0.00";
            } ?>       
        </div>
    </div>
    
    <div class="col-md-12"> 
        <div class="col-md-4" style="font-weight: bold;">
            Donated Days:
        </div>
        <div class="col-md-2">
            <?php 
            if(($total_worked2-$Sum_hour_contract2)>$dif){
                echo number_format((float)(($total_worked2-$Sum_hour_contract2)-$dif)/8, 2, '.', '');  
            }
            else{
                echo "0.00"; 
            } ?>
        </div>
        <div class="col-md-4"style="font-weight: bold;">
            Donated Hours :
        </div>
        <div class="col-md-2">
        <?php
            if(($total_worked2-$Sum_hour_contract2)>$dif){
                echo number_format((float)(($total_worked2-$Sum_hour_contract2)-$dif), 2, '.', '');
            }else{
                echo "0.00";
            }
            ?>       
        </div>
    </div>
    
    
    
    
    
    
    <?php } } }  ?>
    
</div>