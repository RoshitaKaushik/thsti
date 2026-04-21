<?php
 $finane=getfinancialyear_june(date("d-m-Y"));
		 $finanyre=explode("-",$finane);
		 
		 $first_datee = $finanyre[0];
		 $last_datee =$finanyre[1];
 //echo "<pre>";print_r($data);die; 

//echo "<pre>"; print_r($this->session->userdata());
 ?>
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
}
.dataTables_info{
    display:none;
}
#classListing_filter{
    display:none;
}
</style> 
<!-- coded by bajrang -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12" style="left: 38%;">
                    <h4 class="pull-left page-title">Future Generations University Timesheet<?php $total_days_month =date('t'); ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
						<?php
							//GetDate = strtotime($_SESSION['admin_login_date_time']);
							//$getDate = date(M Y,$GetDate );
						?>
                            <h3 class="panel-title">Individual Fiscal Yr Report  <span style="position: absolute;left: 46%;"> <?php echo $_SESSION['admin_fullname'];?></span> 
                                 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>            
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-12" >
                                        <div class="col-md-2">
											<?php 
											$attr = array("class" => "form-horizontal");
											echo form_open("admin/Reports/indivisualReport2", $attr); 
											?>
											<div class="form-group" style="">
												<label for="">Select Fiscal Year:</label>
												<select id="Financial_Y" name="Financial_Y"class=" form-control">
                                                                                                         <option  value="">Select Fiscal Year...</option>
													<?php foreach($fisical_year as $fyy_year) {  ?> 
													<option value="<?php echo $fyy_year ;?>"  <?php if($selected_year == $fyy_year){echo "selected";}elseif(isset($post['Financial_Y']) && $post['Financial_Y'] == $fyy_year){ echo "selected";} ?> ><?php echo $fyy_year;?></option>
													<?php } ?>
												</select>
											</div>
											 <?php echo form_close(); ?>
										</div>

                                        <div class="col-md-10" >
                                            <span style="position: absolute;left: 33%; font-weight: bold;"> <!-- <?php  echo "Total July ".$first_datee." - June ".$last_datee; ?> -->
                                            <?php echo "Total  ".$selected_year; ?>	
                                            </span>
                                            <button style="margin-top: -31px" onclick="fnExcelReport('attendance_report')" class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="classListing"><span><i class="fa fa-file-excel-o"></i> Excel</span></button>
                                            <button type="button" id="generatepdf" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right"><i class="fa fa-file-pdf-o"></i>
                                                <span><strong>PDF</strong></span></button>
                                        </div>
                                    </div>
                                    <div class="col-md-12 table-responsive">
                                    <table id="attendance_report" class="table table-striped table-bordered " style="font-size: 12px;">
                                        <thead>
                                            <tr class="hide">
                                                <th colspan="15">
                                                    <b>Future Generations University Timesheet</b>
                                                </th>
                                            </tr>
                                            <tr class="hide">
                                                <th colspan="15">
                                                    <b><?php echo $_SESSION['admin_fullname']; ?></b>
                                                </th>
                                            </tr>
                                            <tr class="hide">
                                                <th colspan="15">
                                                    <b><?php echo "Total  ".$selected_year; ?></b>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th></th>
                        												<th>Jul </th>
                        												<th>Aug</th>
                        												<th>Sep</th>
                        												<th>Oct</th>
                        												<th>Nov</th>
                        												<th>Dec</th>
                        												<th>Jan</th>
                        												<th>Feb</th>
                        												<th>Mar</th>
                        												<th>Apr</th>
                        												<th>May</th>
                        												<th>Jun</th>
                                                <th style="font-weight: bold;">Total Hrs</th>
                                                <th>Total Days</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php 
                                              $atendanceof_july=array();    $atendanceof_aug=array();
                                              $atendanceof_sept=array();    $atendanceof_oct=array();
                                              $atendanceof_nov=array();    $atendanceof_dec=array();
                                              $atendanceof_jan=array();    $atendanceof_feb=array();
                                              $atendanceof_march=array();    $atendanceof_april=array();
                                              $atendanceof_may=array();    $atendanceof_june=array();
                                              $grandsum=array();
                                               foreach ($records_category as $value) { $sum_array=array(); ?>
                                            <tr>
                                                <td style="text-align: left; "><?=$value['catagory_name'] ?>
                                                	
                                                </td>

                                                <td> <?php  foreach ($records as $key => $valuee) { 

                        												     if($valuee['month'] == '7'  && $value['id']== $valuee['category_id'] ){  
                        															echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']);
                                                   $atendanceof_july[]=$sum_array[]=$grandsum[]=$hr_min; } } ?>
                                                </td>
                        												<td>
                        													<?php  foreach ($records as $key => $valuee) { 
                        															if($valuee['month'] == '8'  && $value['id']== $valuee['category_id'] ){  
                        															  echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']);   
                                                        $atendanceof_aug[]=$sum_array[]=$grandsum[]=$hr_min; } } ?>
                        												</td>
                        												<td>
                        													<?php  foreach ($records as $key => $valuee) { 
                        															if($valuee['month'] == '9'  && $value['id']== $valuee['category_id'] ){  
                        															  echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']) ;  
                                                        $atendanceof_sept[]=$sum_array[]=$grandsum[]=$hr_min; } } ?>
                        												</td>
                        												<td>
                        													<?php  foreach ($records as $key => $valuee) { 
                        															if($valuee['month'] == '10'  &&  $value['id']== $valuee['category_id'] ){  
                        															 echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']) ;    
                                                       $atendanceof_oct[]=$sum_array[]=$grandsum[]=$hr_min; } } ?>
                        												</td>
                        												<td>
                        													<?php  foreach ($records as $key => $valuee) { 
                        															if($valuee['month'] == '11'  && $value['id']== $valuee['category_id'] ){  
                        															 echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']) ;  
                                                       $atendanceof_nov[]=$sum_array[]=$grandsum[]=$hr_min; } } ?>
                        												</td>
                        												<td>
                        													<?php  foreach ($records as $key => $valuee) { 
                        															if($valuee['month'] == '12'  && $value['id']== $valuee['category_id'] ){  
                        															echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']) ;   
                                                      $atendanceof_dec[]=$sum_array[]=$grandsum[]=$hr_min; } } ?>
                        												</td>
                        												<td>
                        													<?php  foreach ($records as $key => $valuee) { 
                        															if($valuee['month'] == '1'  && $value['id']== $valuee['category_id'] ){  
                        															echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']) ;    
                                                      $atendanceof_jan[]=$sum_array[]=$grandsum[]=$hr_min; } } ?>
                        												</td>
                        												<td>
                        													<?php  foreach ($records as $key => $valuee) { 
                        															if($valuee['month'] == '2'  && $value['id']== $valuee['category_id'] ){  
                        															echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']) ;
                                                      $atendanceof_feb[]=$sum_array[]=$grandsum[]=$hr_min; } } ?>
                        												</td>
                        												<td>
                        													<?php  foreach ($records as $key => $valuee) { 
                                                    if($valuee['month'] == '3'  && $value['id']== $valuee['category_id'] ){  
                        															echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']) ;  
                                                      $atendanceof_march[]=$sum_array[]=$grandsum[]=$hr_min; } } ?>
                        												</td>
                        												<td>
                        													<?php  foreach ($records as $key => $valuee) { 
                                                      if($valuee['month'] == '4'  && $value['id']== $valuee['category_id'] ){  
                        															 echo $hr_min=hourMinuteFormating($valuee['t_hours'],$valuee['t_minutes']) ;  
                                                       $atendanceof_april[]=$sum_array[]=$grandsum[]=$hr_min; } } ?>
                        												</td>
                        												<td>
                        													<?php  foreach ($records as $key => $valuee) { 
                                                       if($valuee['month'] == '5'  && $value['id']== $valuee['category_id'] ){  
                        															echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']) ;  
                                                      $atendanceof_may[]=$sum_array[]=$grandsum[]=$hr_min; } } ?>
                        												</td>
                        												<td>
                        													<?php  foreach ($records as $key => $valuee) { 
                        															if($valuee['month'] == '6'  && $value['id']== $valuee['category_id'] ){  
                        															echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']) ;  
                                                      $atendanceof_june[]=$sum_array[]=$grandsum[]=$hr_min; } } ?>
                        												</td>

                                                <td style=" font-weight: bold;">
                                                	<?php foreach ($sum_hr_cat as ${'sumcat_'.$value['id']}) {
		                                                		if(${'sumcat_'.$value['id']}['category_id']==$value['id']){
		                                                echo @$tot_hr=hourdecFormating(${'sumcat_'.$value['id']}['t_hours'],${'sumcat_'.$value['id']}['t_minutes']);	}
                                                	} ?>
                                                </td>
                                                <td style=" font-weight: bold;">
                                                    <?php foreach ($sum_hr_cat as ${'sumcat_'.$value['id']}) {

                                                                if(${'sumcat_'.$value['id']}['category_id']==$value['id']){
                                                    @$tot_hr=hourdecFormating(${'sumcat_'.$value['id']}['t_hours'],${'sumcat_'.$value['id']}['t_minutes']);
                                                        echo calc_hrtodays($tot_hr);
                                                                }
                                                    } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <tr style=" font-weight: bold;">
                                                <td>TOTAL : </td>
                                                <td>
                                                	<?php 
                                                	foreach ($sum_hr_mnth as  $djuly) {
                                                		if($djuly['month']=='7'){
                                                			echo $julytht= hourdecFormating($djuly['t_hours'],$djuly['t_minutes']);
                                                           /* echo str_replace(".",":",$julytht);*/
                                                           /* $exp=explode('.', $julytht);
                                        echo $exp[0]." Hours ".($exp[1])." Minutes";*/
                                                		}
                                                	}
                                                	?> 
                                                </td>
												<td>
													<?php 
                                                	foreach ($sum_hr_mnth as  $daug) {
                                                		if($daug['month']=='8'){
                                               echo $augthr=hourdecFormating($daug['t_hours'],$daug['t_minutes']);
                                                 /*echo str_replace(".",":",$augthr);*/
                                       /* $exp=explode('.', $augthr);
                                        echo $exp[0]." Hours ".($exp[1])." Minutes";*/
                                                		}
                                                	}
                                                	?> 
													
												</td>
												<td>
													<?php 
                                                	foreach ($sum_hr_mnth as  $dsept) {
                                                		if($dsept['month']=='9'){
                                           echo $septhr=hourdecFormating($dsept['t_hours'],$dsept['t_minutes']);
                                           // echo str_replace(".",":",$septhr);
                                                /*$exp=explode('.', $septhr);
                                        echo $exp[0]." Hours ".($exp[1])." Minutes";*/
                                                		}
                                                	}
                                                	?>  
												</td>
												<td>
													<?php 
                                                	foreach ($sum_hr_mnth as  $doct) {
                                                		if($doct['month']=='10'){
                                           echo $octhr= hourdecFormating($doct['t_hours'],$doct['t_minutes']);
                                             //echo str_replace(".",":",$octhr);
                                      /*  $exp=explode('.', $octhr);
                                        echo $exp[0]." Hours ".($exp[1])." Minutes";  */
                                                		}
                                                	}
                                                	?> 
												</td>
												<td>
													<?php 
                                                	foreach ($sum_hr_mnth as  $dnov) {
                                                		if($dnov['month']=='11'){
                                                	echo $novthr= hourdecFormating($dnov['t_hours'],$dnov['t_minutes']);
                                                   // echo str_replace(".",":",$novthr);
                                                       /* $exp=explode('.', $novthr);
                                                    echo $exp[0]." Hours ".($exp[1])." Minutes";*/
                                                		}
                                                	}
                                                	?>  
												</td>
												<td>
													<?php 
                                                	foreach ($sum_hr_mnth as  $ddec) {
                                                		if($ddec['month']=='12'){
                                                			echo $decthr= hourdecFormating($ddec['t_hours'],$ddec['t_minutes']);
                                                            // echo str_replace(".",":",$decthr);
                                                       /*$exp=explode('.', $decthr);
                                                    echo $exp[0]." Hours ".($exp[1])." Minutes";*/     
                                                		}
                                                	}
                                                	?>  
												</td>
												<td>
													<?php 
                                                	foreach ($sum_hr_mnth as  $djan) {
                                                		if($djan['month']=='1'){
                                                	echo $janthr= hourdecFormating($djan['t_hours'],$djan['t_minutes']);
                                                    // echo str_replace(".",":",$janthr);
                                                     /* $exp=explode('.', $janthr);
                                                    echo $exp[0]." Hours ".($exp[1])." Minutes"; */     
                                                		}
                                                	}
                                                	?>  
												</td>
												<td><?php 
                                                	foreach ($sum_hr_mnth as  $dfeb) {
                                                		if($dfeb['month']=='2'){
                                                	echo $febthr= hourdecFormating($dfeb['t_hours'],$dfeb['t_minutes']);
                                                    //echo str_replace(".",":",$febthr);
                                                    /*$exp=explode('.', $febthr);
                                                    echo $exp[0]." Hours ".($exp[1])." Minutes";*/

                                                		}
                                                	}
                                                	?>   </td>
												<td>
													<?php 
                                                	foreach ($sum_hr_mnth as  $dmar) {
                                                		if($dmar['month']=='3'){
                                                			echo $marthr= hourdecFormating($dmar['t_hours'],$dmar['t_minutes']);
                                                        //  echo str_replace(".",":",$marthr);   
                                                           /* $exp=explode('.', $marthr);
                                                    echo $exp[0]." Hours ".($exp[1])." Minutes";*/

                                                		}
                                                	}
                                                	?>  
												</td>
												<td>
													<?php 
                                                	foreach ($sum_hr_mnth as  $dapr) {
                                                		if($dapr['month']=='4'){
                                                		echo $aprthr= hourdecFormating($dapr['t_hours'],$dapr['t_minutes']);
                                                       //echo str_replace(".",":",$aprthr);      
                                                       /* $exp=explode('.', $aprthr);
                                                    echo $exp[0]." Hours ".($exp[1])." Minutes"; */   
                                                		}
                                                	}
                                                	?>   
												</td>
												<td>
													<?php 
                                                	foreach ($sum_hr_mnth as  $dmay) {
                                                		if($dmay['month']=='5'){
                                                			echo $maythr= hourdecFormating($dmay['t_hours'],$dmay['t_minutes']);
                                                          //echo str_replace(".",":",$maythr);     
                                                           /* $exp=explode('.', $maythr);
                                                    echo $exp[0]." Hours ".($exp[1])." Minutes"; */
                                                		}
                                                	}
                                                	?> 
												</td>
												<td>
													<?php 
                                                	foreach ($sum_hr_mnth as  $djune) {
                                                		if($djune['month']=='6'){
                                                			echo $junthr= hourdecFormating($djune['t_hours'],$djune['t_minutes']);
                                                         //echo str_replace(".",":",$junthr); 
                                                        /* $exp=explode('.', $junthr);
                                                    echo $exp[0]." Hours ".($exp[1])." Minutes"; */  
                                                		}
                                                	}
                                                	?>  
												</td>
                                                <td>
                                                	<?php echo $gsumhr=hourdecFormating($sum_hr['t_hours'],$sum_hr['t_minutes']) ; 
                                                     //echo str_replace(".",":",$gsumhr);
                                                     /*$exp=explode('.', $gsumhr);
                                                    echo $exp[0]." Hours ".($exp[1])." Minutes";*/
                                                     ?>
                                            	</td>
                                                <td>
                                                	  <?=calc_hrtodays($gsumhr);?><!-- <?=number_format((float)$gsumhr/8, 2, '.', '');?> -->
                                                </td>
                                            </tr>
                                            <?php

                               /*$param['hours_to_work'] = hourMinuteFormating($Sum_hour_contract,$Sum_mins_contract);
                      $param['cary_hours_to_work'] = hourMinuteFormating($cary_Sum_hour_contract,$cary_Sum_mins_contract);*/
                        $param['hours_to_work'] =$Sum_hour_contract=(float)($Sum_hour_contract);
                            $param['cary_hours_to_work'] = ($cary_Sum_hour_contract);
                                $param['hours_worked'] = $sum_hr['t_hours'];
                                $param['minutes_worked'] = $sum_hr['t_minutes'];
                                //$calculated_attendance = calculated_attendance($param);
                        $total_worked = (float)hourdecFormating($param['hours_worked'], $param['minutes_worked']);
                        //$total_worked =(float)"1928.00";

                        $dif=(float)"80.00";
                        //$total_worked =(float)$total_worked;

                                 ?>			
                                 	
                                            <tr class="hide">
                                             <td colspan="15"></td>  
                                           </tr>
                                           <tr class="hide">
                                              <td colspan="15"></td> 
                                           </tr>
                                            <tr class="hide">
                                              <td colspan="7"><b>Days Contracted for this Fiscal Year: :
                                                <?php $grandsumhr=hourdecFormating($sum_hr['t_hours'],$sum_hr['t_minutes']) ; ?>
                                                    <?=@calc_hrtodays($grandsumhr)?>
                                                </b>
                                                </td>
                                                <td colspan="8"><b>Hours Contracted for Fiscal Year: <?php echo 
                                                $grandsumhr=hourdecFormating($sum_hr['t_hours'],$sum_hr['t_minutes']) ; 
                                                 //echo str_replace(".",":",$grandsumhr);
                                                /*$exp=explode('.', $grandsumhr);
                                                    echo $exp[0]." Hours ".($exp[1])." Minutes";*/
                                                ?></b></td>
                                                
                                                
                                            </tr>
                                            <tr class="hide">
                                                
                                                <td colspan="7"><b>Days Left on Contract : <?php if($total_worked > $Sum_hour_contract){ echo "0.00";
                                                }else{ echo@calc_hrtodays($Sum_hour_contract-$total_worked); } ?> 
                                                        </b>
                                                </td>
                                                <td colspan="8"><b>Hours Left on Contract : 
                                                    <?php
                                                    if($total_worked > $Sum_hour_contract){ echo "0.00";
                                                }else{ 
                                                    echo ($Sum_hour_contract-$total_worked);
                                                };
                                                    /*@$exp=explode('.', @$calculated_attendance['total_left_hours']);
                                                    echo @$exp[0].":".(@$exp[1]);*/
                                                    ?></b></td>

                                            </tr>
                                            <tr class="hide">
                                                
                                                <td colspan="7"><b>Carry Forward Days  : <!-- <?php if($total_worked > $Sum_hour_contract){ echo "0.00";
                                                }else{ echo@calc_hrtodays($Sum_hour_contract-$total_worked); } ?>  -->
                                                <?php
                                                    if($total_worked > $Sum_hour_contract){ 
                                                    	if(($total_worked-$Sum_hour_contract)>$dif){

                                                    		echo "10.00";
                                                    	}else{
                                                    		echo @calc_hrtodays($total_worked-$Sum_hour_contract);
                                                    	}
                                                }else{ 
                                                    echo "0.00";
                                                };?>
                                                        </b>
                                                </td>
                                                <td colspan="8"><b>Carry Forward Hours  : 
                                                    <?php
                                                    if($total_worked > $Sum_hour_contract){ 
                                                    	if(($total_worked-$Sum_hour_contract)>$dif){

                                                    		echo "80.00";
                                                    	}else{
                                                    		
                                                    		echo number_format((float)($total_worked-$Sum_hour_contract), 2, '.', '');
                                                    	}
                                                }else{ 
                                                    echo "0.00";
                                                };
                                                    /*@$exp=explode('.', @$calculated_attendance['total_left_hours']);
                                                    echo @$exp[0].":".(@$exp[1]);*/
                                                    ?></b></td>

                                            </tr>
                                            <tr class="hide">
                                                
                                                <td colspan="7"><b>Donated Days  : <?php 
                                                if(($total_worked-$Sum_hour_contract)>$dif){

                                                    		echo number_format((float)(($total_worked-$Sum_hour_contract)-$dif)/8, 2, '.', '');
                                                    	}else{
                                                    		
                                                    		echo "0.00";
                                                    	};
                                                    	 ?>
                                                </td>
                                                <td colspan="8"><b>Donated Hours  : 
                                                    <?php

                                                    	if(($total_worked-$Sum_hour_contract)>$dif){

                                                    		echo number_format((float)(($total_worked-$Sum_hour_contract)-$dif), 2, '.', '');
                                                    	}else{
                                                    		
                                                    		echo "0.00";
                                                    	};
                                                    ?></b></td>

                                            </tr>
                                            <tr class="hide">
                                                
                                                <td colspan="7"><b>Number of Days Contracted : <?php echo (number_format((float)$param['hours_to_work'] /8, 2, '.', '')) 
                                ?>
                                                        </b>
                                                </td>
                                                <td colspan="8"><b>Number of Hours Contracted : 
                                                    <?php echo (number_format((float)$param['hours_to_work'], 2, '.', '')) 
                                                ?></b>
                                              </td>

                                            </tr>
                                            <tr class="hide">
                                                
                                                <td colspan="7"><b>Number of Days Carried Over From Previous Yr : <?php echo (number_format((float)$param['cary_hours_to_work'] /8, 2, '.', '')) 
                                                    ?>
                                                        </b>
                                                </td>
                                                <td colspan="8"><b>Number of Hours Carried Over From Previous Yr : 
                                                    <?php echo (number_format((float)$param['cary_hours_to_work'], 2, '.', '')) 
                                                       ?>
                                                    
                                                  </b>
                                                </td>

                                            </tr>
                                             
                                        </tbody>
                                </table>
                                <div class="col-md-12" style="padding: top;padding-top:30px;"> 
                      
				                      <div class="col-md-4" style="font-weight: bold;">
				                        Number of Days Contracted:

				                      </div>
				                      <div class="col-md-2">
				                        <?php echo (number_format((float)$param['hours_to_work'] /8, 2, '.', '')) 
				                                ?>
				                      </div>
				                      <div class="col-md-4"style="font-weight: bold;">
				                            Number of Hours Contracted:
				                    </div>
				                    <div class="col-md-2">
				                     <?php echo (number_format((float)$param['hours_to_work'], 2, '.', '')) 
				                                ?>
				                    </div>
				                      
				                </div>
				                <div class="col-md-12"> 
                      
				                      <div class="col-md-4" style="font-weight: bold;">
				                        Number of Days Carried Over :

				                      </div>
				                      <div class="col-md-2">
				                        <?php echo (number_format((float)$param['cary_hours_to_work'] /8, 2, '.', '')) 
				                                                    ?>
				                      </div>
				                      <div class="col-md-4"style="font-weight: bold;">
				                            Number of Hours Carried Over :
				                    </div>
				                    <div class="col-md-2">
				                     <?php echo (number_format((float)$param['cary_hours_to_work'], 2, '.', '')) 
				                                                    ?>
				                    </div>
                      
        						</div>
								<div class="col-md-12" > 
				                   <div class="col-md-4" style="font-weight: bold;"> 
			                        Days Worked: 
			                      </div>
			                      <div class="col-md-2"> 
			                        <?php $grandsumhr=hourdecFormating($sum_hr['t_hours'],$sum_hr['t_minutes']) ; ?>
			                         <?=@calc_hrtodays($grandsumhr)?>
			                                                <!-- <?=number_format((float)$grandsumhr/8, 2, '.', '');?> -->
			                      </div>
									<div class="col-md-4" style="font-weight: bold;">  
										Hours Worked: 
									</div>
									<div class="col-md-2">  
										<?php  echo    $grandsumhr=hourdecFormating($sum_hr['t_hours'],$sum_hr['t_minutes']) ; 
                                            ?>
									</div>
								
								</div>
									<div class="col-md-12"> 
											
											<div class="col-md-4" style="font-weight: bold;">
												Days Left to Work:

											</div>
											<div class="col-md-2">
												<?php if($total_worked > $Sum_hour_contract){ echo "0.00";
                                                }else{ echo@calc_hrtodays($Sum_hour_contract-$total_worked); } ?> 
                                                        
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

                                                    		echo "10.00";
                                                    	}else{
                                                    		echo @calc_hrtodays($total_worked-$Sum_hour_contract);
                                                    	}
                                                }else{ 
                                                    echo "0.00";
                                                };?>
											</div>
					                    <div class="col-md-4"style="font-weight: bold;">
					                    	Carry Forward Hours :
					                    </div>
					                    <div class="col-md-2">
					                     <?php
                                                    if($total_worked > $Sum_hour_contract){ 
                                                    	if(($total_worked-$Sum_hour_contract)>$dif){

                                                    		echo "80.00";
                                                    	}else{
                                                    		
                                                    		echo number_format((float)($total_worked-$Sum_hour_contract), 2, '.', '');
                                                    	}
                                                }else{ 
                                                    echo "0.00";
                                                }; ?>       
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
                                                    	}else{
                                                    		
                                                    		echo "0.00";
                                                    	};
                                                    	 ?>
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
                                                    	};
                                                    ?>       
					                    </div>
									</div>

									</div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div> <!-- End Row -->           
        </div> <!-- container -->
     
    </div> <!-- content -->
</div> <!-- content-page -->
<!-- end coded by bajrang -->
<script>
function submitform(){
	$('#filter').submit();
}

$(document).on("click","#generatepdf",function(){

	//window.location.href = '<?php //echo  base_url("admin/PdfBuilder/classReportPdf/");?><?php //echo encryptor('encrypt',$selectedclass);?>';
	/*window.open('<?php echo  base_url("admin/PdfBuilder/classReportPdf/");?><?php echo encryptor('encrypt',isset($selectedclass)??'');?>', '_blank');*/
	
});

</script>
<script>
function fnExcelReport(table_id)
{
   // alert(table_id);
    var tab_text = '<table border="1px" style="font-size:16px" ">';
    var textRange; 
    var j = 0;
    var tab = document.getElementById(table_id); // id of table
    var lines = tab.rows.length;
    //console.log(tab.rows);
    // the first headline of the table#0d4660 DFDFDF
    if (lines > 0) {
        tab_text = tab_text + '<tr>' + tab.rows[0].innerHTML + '</tr>'+'<tr>' + tab.rows[1].innerHTML + '</tr>';
    }

    // table data lines, loop starting from 1
    for (j = 2 ; j < lines; j++) {     
        tab_text = tab_text + "<tr>" + tab.rows[j].innerHTML + "</tr>";
    }

    tab_text = tab_text + "</table>";
    tab_text = tab_text.replace(/<a[^>]*>|<\/a>/g, "");             //remove if u want links in your table
    tab_text = tab_text.replace(/<img[^>]*>/gi,"");                 // remove if u want images in your table
    tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, "");    // reomves input params
    // console.log(tab_text); // aktivate so see the result (press F12 in browser)

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

     // if Internet Explorer
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa = txtArea1.document.execCommand("SaveAs", true, "DataTableExport.xls");
        return (sa);
    }  
    else 
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_html = encodeURIComponent(tab_text);//table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        var theDate = new Date();
		var curr_year = '<?=$selected_year?>';	

        //setting the file name
        a.download = 'indivisual_financialyr_report_' + curr_year + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        //e.preventDefault();
        /**********************************************/
    
} 
</script>
<script>
	/*$(document).on('change', "#Financial_Y", function(){
	var date_val = $(this).val();
	alert(date_val);

})*/
	jQuery(function() {
    jQuery('#Financial_Y').change(function() {
        this.form.submit();
    });
});

</script>