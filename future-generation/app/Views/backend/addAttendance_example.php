<?php //echo "<pre>";print_r($transactions);die; 
//$defalt_show = ["1", "2", "3"];
if(!empty($transactions)){
    $transaction_date = date('m/d/Y', strtotime($transactions[0]['transaction_date']));
    $islock = $transactions[0]['islock'];
}else{
    $islock = 0;
}

$time=strtotime($date);
$month=date("F",$time);
$choosen=date("d M y",$time);
//$year=date("Y",$time);
$group_by_category = array();
foreach ($transactions as $row_data) {
    $category_id = $row_data['category_id'];
    if (isset($group_by_category[$category_id])) {
        $group_by_category[$category_id] = $row_data;
    } else {
        $group_by_category[$category_id] = $row_data;
    }
}
?>
<style type="text/css">
	.datepicker {
    border: 2px solid #999 !important;
    padding: 4px !important;
    border-radius: 12px !important;
    padding: 3px !important;
}

</style>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      
<div class="content-page">
<!-- Start content -->
<div class="content">
	<div class="container">
		<?php if(session()->getFlashdata('msg') !=''){ ?>
		<div class="alert alert-success">
			<?php echo session()->getFlashdata('msg');
			session()->remove('msg');?>
		</div>
		<?php } ?>
		<div class="row">
				<!-- Basic example -->
				<div class="col-md-12">
					<div class="panel panel-info panel-color">
						<div class="panel-heading"><h3 class="panel-title">Time Entry</h3></div>
						<div class="panel-body" style="margin-top:10px">
							<div class="col-md-12">
							<a href="" id="redirect"></a>
							<!-- <form class="form-horizontal" role="form"> -->
							<?php 
							$attr = array("class" => "form-horizontal","id"=>'timesheet_form');
							echo form_open("admin/Timesheet/addAttendance", $attr); 							
							?>
							<div class="row">
							    
								<div class="form-group col-md-12">
								    
									<div class="form-group col-md-3">
										<div class="col-sm-8  padding-left-30" data-date-inline-picker="true" >
										  <input type="hidden" class="form-control datepicker " name="transaction_date" placeholder="mm/dd/yyyy " id="transaction_date" value="<?php if(isset($date)){ echo $date; }?>" required style=""> 
										  <div id="transaction_datee"></div>
										</div>
										<div class="form-group col-md-12 " style=" margin-left: -6.333333% !important; margin-top: 15px !important;">	
											<div class="form-group m-b-0">
												<div class="col-sm-offset-5 col-sm-9">
												  <button type="submit" name="lock_button" value="not_lock" class="btn btn-success waves-effect waves-light" <?php if(isset($islock)){ if($islock == 1){ echo "
												  disabled"; }; } ?>>Save</button>
												  
												</div>
											</div>
										</div>
											<?php if(isset($islock)){ if($islock != 1){  ?>
										<div class="col-md-12" style="margin-top: 23px; margin-left: 91px;">
										 <button name="lock_button" value="lock_previous" type="submit" class="btn btn-danger waves-effect waves-light m-b-8"  onclick="return setLock(); ConfirmLock(); ">Submit</button>
										</div>
										 <?php  } else {  ?>
										<div class="col-md-12" style="margin-top: 41px;">
												<h4 style="color: #e8330a;">This day's attendance is locked.</h4>
												
										</div>
										 <?php  } } ?>
										
									</div>
									<?php
									
									$contract_id  = "";
										if(isset($active_contract[0])){
										    if(isset($activeContractForSave[0])){
										        $contract_id = $activeContractForSave[0]['id'];
										    }
										    else{
										        $contract_id = $active_contract[0]['id'];
										    }
									?>
									<!-- <input type="hidden" name="hours" id="hours" value=""> -->
									<input type="hidden" name="deviceid" value="Website">
									<input type="hidden" name="empid" value="<?=$empid?>"/>
									<input type="hidden" name="team_id" value="<?php print($team_id['teamid'])?>">
									<input type="hidden" name="contract_id" value="<?=$contract_id?>">
									<input type="hidden" name="islock" id="islock" value="<?php if(isset($islock)){ echo $islock; }else{ echo "0"; } ?>">

								<div class=" col-md-9">

                                    <div class="col-md-3"></div>
                                    <div class="col-md-1" ><b>Office</b></div>
                                    <div class="col-md-2" style="text-align:center;"><b>Hour</b></div>
                                    <div class="col-md-2" style="text-align:center;"><b>Minute</b></div>
                                    <div class="col-md-4" style="text-align:center;"><b>Journal</b></div>
                                    <hr>


									<?php if(!empty($category_arr)){
                                        $count = 0;
                                	    foreach($category_arr as $category){
                                            if($category['Active']=='1'){}
                                            $ids[] = "'time".$category['id']."'";
                                            $show = true;
                                            $hours = $min = $journal = $office_status = '';
                                	        
                                            if(isset($group_by_category[$category['id']])){
                                                $show = true;
                                                $hours_with_min = $group_by_category[$category['id']]['hours'];
                                                $journal = $group_by_category[$category['id']]['journal'];
                                                $office_status = $group_by_category[$category['id']]['office_status'];
                                                if($hours_with_min != ''){
                                                    $temp = explode('.', $hours_with_min);
                                                    $hours = $temp[0];
                                                    $min = $temp[1];
                                                }
                                            }
                            			?>
                            			
										<div class="form-group padding-left-30 grouptime<?=$category['id']?> <?php echo ($show == true ? "show" : "hide"); ?>">
										<label for="Hour" class="col-sm-3 control-label"><?=$category['catagory_name']?></label>
										<input type="hidden" name="syncData[<?=$count?>][category_id]" value="<?=$category['id']?>" />
										<div class="col-sm-1">
										    <input type="checkbox" name="syncData[<?=$count?>][office_status]" value="1" <?php echo $office_status== '1'?'checked':''; ?> <?php if(isset($islock)){ if($islock == 1){ echo "disabled";  } } ?>></div>
										<div class="col-sm-2">                                     
											<select name="syncData[<?=$count?>][hours]" class="form-control hour" <?php if(isset($islock)){ if($islock == 1){ echo "disabled";  } } ?> >
												<option value="">Hours</option>   
											<?php for($i=0;$i<=10;$i++){ 
												$val = $i<10 ? '0'.$i : $i;
											?>
												<option value="<?=$val?>" <?php if($hours != '') { if($hours == $val) { echo "selected"; } }?>><?=$val?></option>        								
											<?php } ?>
											</select>
										</div>
										
										<div class="col-sm-2">                                     
											<select name="syncData[<?=$count?>][min]" class="form-control minute" <?php if(isset($islock)){ if($islock == 1){ echo "disabled";  } } ?>>
												<option value="">Minutes</option>   
											<?php for($i=0;$i<60;$i++){
												$val_min = $i<10 ? '0'.$i : $i;
												
											?>
												<option value="<?=$val_min?>" <?php if($min != '') { if($min == $val_min) { echo "selected"; } }?>><?=$val_min?></option>        								
											<?php } ?>
											</select>
										</div>
										<div class="col-sm-4">
										  <textarea class="form-control" name="syncData[<?=$count?>][journal]" placeholder="Journal" rows="1"  <?php if(isset($islock)){ if($islock == 1){ echo "disabled";  } } ?> ><?php if($journal != '') { echo $journal; }?></textarea>
										</div>
									</div>
									<?php $count++; }  $list = implode(",",$ids);  } ?>
								</div>
									
								<!--<div class="form-group col-md-12 " style=" margin-left: 1.666667% !important; margin-top: 15px !important;">	
									<div class="form-group m-b-0">
										<div class="col-sm-offset-5 col-sm-9">
										  <button type="submit" name="lock_button" value="not_lock" class="btn btn-success waves-effect waves-light" <?php if(isset($islock)){ if($islock == 1){ echo "
										  disabled"; }; } ?>>Save</button>
										  
										</div>
									</div>
								</div>-->
								<?php echo form_close(); }else { echo "No Active Contract"; ?>
                    		
		                    		<a href="<?php echo base_url('/admin/Timesheet/attendance');?>" class="btn btn-success waves-effect waves-light btn-xs m-b-5">
										
										<span><strong>Go Back</strong></span>            
									</a>
		                    		<?php } ?>
							    </div>
							</div>
						</div>	<!-- col -->
					
					</div> <!-- panel-body -->
				</div> <!-- panel-->
			</div> <!-- col-->	
		</div> <!-- row-->
		
		<?php if(isset($active_contract[0])){ 
		    $contract = $active_contract[0];
		    
		    ?>
		
		<div class="row">
			<!-- Basic example -->
			<div class="col-md-12">
				<div class="panel panel-info panel-color">
					<div class="panel-heading"><h3 class="panel-title">Attendance</h3></div>
						<div class="panel-body" style="margin-top:10px">
						    
						    <?php if(!empty($contract)){ ?>
                            <div class="col-md-12" style="padding: top;padding-top:20px;padding-left:17px;"> 
                                <?php if($contract['min_contact_id'] != $contract['max_contact_id']){
                                    echo "<span class='btn btn-success btn-xs'>Linked Contract Details (".date('m/d/Y',strtotime($contract['contract_begin_date']))."  -  ".date('m/d/Y',strtotime($contract['contract_end_date'])).")</span>";
                                } ?>
                            </div>
                            <?php }  ?>
						    
    						<div class="col-md-6">
    							<?php 
    							$param['hours_to_work'] = $contract['hours_to_work'];

								$param['hours_worked'] = $contract['hours_worked'];
								$param['minutes_worked'] = $contract['minutes_worked'];
								$calculated_attendance = calculated_attendance($param); 
							    $total_worked =  hourdecFormating($param['hours_worked'], $param['minutes_worked']);
								?>


    							<div class="col-md-7">
    								Total Month Days
    							</div>
    							<div class="col-md-1">:</div>
    							<div class="col-md-4">
								<?//=@$calculated_attendance['total_worked_days']?>
								<?php $grandsumhr=hourdecFormating($records_sum['t_hours'],$records_sum['t_minutes']) ; ?>
								<?=@calc_hrtodays($grandsumhr) ?>
								<?//=@calc_days(@$calculated_attendance['total_worked_hours']) ?>
    							</div>
    							<div class="col-md-7">
    								Number of Days Contracted
    							</div>
    							<div class="col-md-1">:</div>	
    							<div class="col-md-4">
								<?php echo (calc_hrtodays($contract['hours_to_work'])) 
                                ?>
    							</div>
    							<div class="col-md-7">
    								Number of Days Carried Over From Previous Yr
    							</div>
    							<div class="col-md-1">:</div>
    							<div class="col-md-4"><?php  echo (calc_hrtodays($contract['CarriedOverHours']));
    							?>
    								
    							</div>
    							
    							<div class="col-md-7">
    								Days Left On Contract
    							</div>
    							<div class="col-md-1">:</div>
    							<div class="col-md-4"><?//=@$calculated_attendance['total_left_days']?>
    								
    								<?=@calc_hrtodays($param['hours_to_work']-$total_worked)?>
                                              </b>
    							</div>
    							
    							
    							<!--<div class="col-md-6">
    								Carry Over Hours
    							</div>
    							<div class="col-md-1">:</div>
    							<div class="col-md-4"><?php //echo @$calculated_attendance['carry_over'];?></div>
    							
    							<div class="col-md-6">
    								Donated Hours
    							</div>
    							<div class="col-md-1">:</div>
    							<div class="col-md-4"><?php //echo$calculated_attendance['donated']?></div> -->
    							
    							<div class="clearfix"></div>
    							<div class="col-md-9">
                                    <div class="cn_details" style="magin-top:10px;">                           
                                        <span class="label label-success">Contract : <?=convertDateString($contract['contract_begin_date'])?> to <?=convertDateString($contract['contract_end_date'])?> </span>
            
            
            
                                        <span class="label label-success" style="line-height: normal;margin-left: 10px;">Last Sync :  <?php echo $contract['last_sync_date'] != '' ? convertDateString($contract['last_sync_date']) : 'Not Started'?></span>  
                                    </div>
                                </div>
                                <div class="clearfix"></div>
								
								
								
    						</div>	<!-- col -->
    						<div class="col-md-6">
    							
    							<div class="col-md-7">
    								Total Month Hours
    							</div>
    							<div class="col-md-1">:</div>	
    							<div class="col-md-4">
								<?php
                               /* echo "<pre>";
								print_r($param);
								echo "</pre>";*/
								$expph=hourdecFormating($records_sum['t_hours'],$records_sum['t_minutes']) ; 
                                     //echo $exp[0].":".($exp[1])
                                        echo $expph;
								//echo @$calculated_attendance['total_worked_hours'];
								
                                ?>
    							</div>
    							
    							<div class="col-md-7">
    								Number of Hours Contracted
    							</div>
    							<div class="col-md-1">:</div>	
    							<div class="col-md-4">
								<?php echo ($contract['hours_to_work']) 
                                ?>
    							</div>
    							<div class="col-md-7">
    								Number of Hours Carried Over From Previous Yr
    							</div>
    							<div class="col-md-1">:</div>
    							<div class="col-md-4"><?//=@$calculated_attendance['total_left_days']?>
    								<?php echo ($contract['CarriedOverHours'])?>
    							</div>
    							<div class="col-md-7">
    								Hours Left On Contract
    							</div>
    							<div class="col-md-1">:</div>
    							<div class="col-md-4"><?php echo number_format(($param['hours_to_work']-$total_worked),2)	?>
                                        	
                                </div>
    							
    						</div>	<!-- col -->
    						
    						
    						 <?php if(!empty($contract)){ ?>
    						 <?php if($contract['min_contact_id'] != $contract['max_contact_id']){ ?>
    						 <div class="col-md-12"><hr></div>
                            <div class="col-md-12" style="padding: top;padding-top:20px;padding-left:17px;"> 
                                <?php
                                    echo "<span class='btn btn-success btn-xs'>Contract - 1 (".date('m/d/Y',strtotime($link_contract1[0]['contract_begin_date']))."  -  ".date('m/d/Y',strtotime($link_contract1[0]['contract_end_date'])).")</span>";
                               ?>
                            </div>
                            
                            
                            <div class="col-md-6">
                                <?php 
                                $param1['hours_to_work'] = $link_contract1[0]['hours_to_work'];
                                $param1['hours_worked'] = $link_contract1[0]['hours_worked'];
                                $param1['minutes_worked'] = $link_contract1[0]['minutes_worked'];
                                $calculated_attendance1 = calculated_attendance($param1); 
                                $total_worked1 =  hourdecFormating($param1['hours_worked'], $param1['minutes_worked']);
                                ?>
                                <div class="col-md-7">
                                    Total Month Days
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-4">
                                     <!--need to change-->
                                    <?php $grandsumhr1=hourdecFormating($records_sum['t_hours'],$records_sum['t_minutes']) ; ?>
                                    <?=@calc_hrtodays($grandsumhr1) ?>
                                </div>
                                <div class="col-md-7">
                                    Number of Days Contracted
                                </div>
                                <div class="col-md-1">:</div>	
                                <div class="col-md-4">
                                    <?php echo (calc_hrtodays($link_contract1[0]['hours_to_work'])) 
                                ?>
                                </div>
                                <div class="col-md-7">
                                    Number of Days Carried Over From Previous Yr
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-4">
                                    <?php  echo (calc_hrtodays($link_contract1[0]['CarriedOverHours'])); ?>
                                </div>
                                
                                <div class="col-md-7">
                                    Days Left On Contract 
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-4">
                                    <?=@calc_hrtodays($param1['hours_to_work']-$total_worked1)?>
                                </div>
                                 
                                <div class="clearfix"></div>
                                <div class="col-md-9">
                                    <div class="cn_details" style="magin-top:10px;">                           
                                    <span class="label label-success">Contract : <?=convertDateString($link_contract1[0]['contract_begin_date'])?> to <?=convertDateString($link_contract1[0]['contract_end_date'])?> </span>
                                    <span class="label label-success" style="line-height: normal;margin-left: 10px;">Last Sync :  <?php echo $link_contract1[0]['last_sync_date'] != '' ? convertDateString($link_contract1[0]['last_sync_date']) : 'Not Started'?></span>  
                                </div>
                                </div>
                                <div class="clearfix"></div>
                                
                            </div>	<!-- col -->
                            <div class="col-md-6">
                            
                                <div class="col-md-7">
                                    Total Month Hours
                                </div>
                                <div class="col-md-1">:</div>	
                                <div class="col-md-4">
                                <?php
                                    // need to change
                                    $expph=hourdecFormating($records_sum['t_hours'],$records_sum['t_minutes']) ;
                                    echo $expph;
                                ?>
                                </div>
                                
                                <div class="col-md-7">
                                    Number of Hours Contracted
                                </div>
                                <div class="col-md-1">:</div>	
                                <div class="col-md-4">
                                    <?php echo ($link_contract1[0]['hours_to_work']); ?>
                                </div>
                                <div class="col-md-7">
                                    Number of Hours Carried Over From Previous Yr
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-4">
                                    <?php echo ($link_contract1[0]['CarriedOverHours'])?>
                                </div>
                                <div class="col-md-7">
                                    Hours Left On Contract
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-4">
                                    <?php echo number_format(($param1['hours_to_work']-$total_worked1),2);	?>
                                    
                                </div>
                            </div>	<!-- col -->
                            
                            
                            
                            
                            
                            <div class="col-md-12" style="padding: top;padding-top:20px;padding-left:17px;"> 
                                <?php 
                                    echo "<span class='btn btn-success btn-xs'>Contract - 2 (".date('m/d/Y',strtotime($link_contract2[0]['contract_begin_date']))."  -  ".date('m/d/Y',strtotime($link_contract2[0]['contract_end_date'])).")</span>";
                                 ?>
                            </div>
                            
                            
                            <div class="col-md-6">
                                <?php 
                                $param2['hours_to_work'] = $link_contract2[0]['hours_to_work'];
                                $param2['hours_worked'] = $link_contract2[0]['hours_worked'];
                                $param2['minutes_worked'] = $link_contract2[0]['minutes_worked'];
                                $calculated_attendance2 = calculated_attendance($param2); 
                                $total_worked2 =  hourdecFormating($param2['hours_worked'], $param2['minutes_worked']);
                                ?>
                                <div class="col-md-7">
                                    Total Month Days
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-4">
                                     <!--need to change-->
                                    <?php $grandsumhr2=hourdecFormating($records_sum['t_hours'],$records_sum['t_minutes']) ; ?>
                                    <?=@calc_hrtodays($grandsumhr2) ?>
                                </div>
                                <div class="col-md-7">
                                    Number of Days Contracted
                                </div>
                                <div class="col-md-1">:</div>	
                                <div class="col-md-4">
                                    <?php echo (calc_hrtodays($link_contract2[0]['hours_to_work'])) 
                                ?>
                                </div>
                                <div class="col-md-7">
                                    Number of Days Carried Over From Previous Yr
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-4">
                                    <?php  echo (calc_hrtodays($link_contract2[0]['CarriedOverHours'])); ?>
                                </div>
                                
                                <div class="col-md-7">
                                    Days Left On Contract 
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-4">
                                    <?=@calc_hrtodays($param2['hours_to_work']-$total_worked2)?>
                                </div>
                                 
                                <div class="clearfix"></div>
                                <div class="col-md-9">
                                    <div class="cn_details" style="magin-top:10px;">                           
                                    <span class="label label-success">Contract : <?=convertDateString($link_contract2[0]['contract_begin_date'])?> to <?=convertDateString($link_contract2[0]['contract_end_date'])?> </span>
                                    <span class="label label-success" style="line-height: normal;margin-left: 10px;">Last Sync :  <?php echo $link_contract2[0]['last_sync_date'] != '' ? convertDateString($link_contract2[0]['last_sync_date']) : 'Not Started'?></span>  
                                </div>
                                </div>
                                <div class="clearfix"></div>
                                
                            </div>	<!-- col -->
                            <div class="col-md-6">
                            
                                <div class="col-md-7">
                                    Total Month Hours
                                </div>
                                <div class="col-md-1">:</div>	
                                <div class="col-md-4">
                                <?php
                                    // need to change
                                    $expph=hourdecFormating($records_sum['t_hours'],$records_sum['t_minutes']) ;
                                    echo $expph;
                                ?>
                                </div>
                                
                                <div class="col-md-7">
                                    Number of Hours Contracted
                                </div>
                                <div class="col-md-1">:</div>	
                                <div class="col-md-4">
                                    <?php echo ($link_contract2[0]['hours_to_work']); ?>
                                </div>
                                <div class="col-md-7">
                                    Number of Hours Carried Over From Previous Yr
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-4">
                                    <?php echo ($link_contract2[0]['CarriedOverHours'])?>
                                </div>
                                <div class="col-md-7">
                                    Hours Left On Contract
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-4">
                                    <?php echo number_format(($param2['hours_to_work']-$total_worked2),2);	?>
                                    
                                </div>
                            </div>	<!-- col -->
                            
                            <?php  } }  ?>
    						
    						<div class="col-md-12">
								<br>
								<div class="col-md-12" style="text-align:left; margin-top:10px; font-weight:bold;" >Download the Future Generation Attendance Mobile App </div>
								<a href="https://itunes.apple.com/us/app/futuregen-attendance/id1399518544?ls=1&mt=8" target="_blank"><img src="<?php echo base_url('assets/images/ios.png')?>" style="height:60px;"/></a>
								
								<a href="https://play.google.com/store/apps/details?id=com.akalinfosys.attendance" target="_blank"><img src="<?php echo base_url('assets/images/android.png')?>" style="height:50px;"/></a>
								
								
								
								
								</div>
					
						</div> <!-- panel-body -->
				</div> <!-- panel-->
			</div> 
			<!-- col-->	
			
			
		</div> <!-- row-->
		
		<?php } ?>
		
		
		
	</div> <!-- container -->                              
</div> <!-- content -->

<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
    	<div class="modal-content p-0 b-0">
    		<div class="row">
				<!-- Basic example -->
    			<div class="col-md-12">
    				<div class="panel panel-color panel-info" style="margin:0;">
    					<div class="panel-heading"><h3 class="panel-title"> Category List </h3>
						 </div>
						 
						<div class="panel-body">
							<div class="form-group">
                                <div class="col-sm-9">
                                	<?php if(!empty($category_active_array)){
										 
										 //echo "<pre>"; print_r($category_arr);
										
                                	    foreach($category_active_array as $category){
                                	       
                                	?>
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" class="new_category" name="new_category[<?php echo $category['id'];?>]" value="<?php echo $category['id'];?>">
                                        <label for="<?php $category['catagory_name']; ?>">
                                            <?php echo $category['catagory_name'];?>
                                        </label>
                                    </div>
                                    <?php  } } ?>
                                    
                                    
                                </div>
                            </div>
							
    					</div>	
                        <div class="text-center" style="padding: 10px 0px;">
                        	<button type="button" id="ok" class="btn btn-success waves-effect" data-dismiss="modal">Ok</button>
                        	<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                        </div>
                    </div> <!-- panel -->
                </div> <!-- col-->
			</div> <!-- row-->											
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- panel-model -->							
<!--  					
<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
-->		



<!-- Modal -->
  <div class="modal fade" id="confirm_box" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Alert</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure to lock timesheet data if yes then please select type</p>
          <p><input type="radio" name="selected_type" value="2"> Selected Date : <span class="msg_date"></span></p>
          <p><input type="radio" name="selected_type" value="1"> <span class="msg_date1"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-success update_status">Yes</button>
        </div>
      </div>
      
    </div>
  </div>




<script>
$(document).on('click','.update_status',function(){
    var radioValue = $("input[name='selected_type']:checked").val();
        if(radioValue){
            $('#islock').val(radioValue);
            $('#confirm_box').modal('hide');
            $('#timesheet_form').submit();
        }
        else
        {
         alert("Please Select Type");
         return false;
        }
})
/*
var timepicker = new TimePicker([<?php echo $list; ?>], {
  lang: 'en',
  theme: 'dark'
}); */

/*
timepicker.on('change', function(evt) {
	
  if(evt.hour <= 9 || typeof evt.hour == 'undefined' || (evt.hour == 10 && (typeof evt.minute == 'undefined' || evt.minute == 00))){
	var value = (evt.hour || '00') + ':' + (evt.minute || '00');
	evt.element.value = value;
  }else{
  	alert('Maximum Work limit for One Day is 10 Hours');
  	evt.element.value = '';
  }

}); */

$(document).on('click', "#add_category", function(){
	$('.new_category').attr('checked', false);
});

$(document).on('click', "#ok", function(){
	$.each($(".new_category:checked"), function(){            
        $('.grouptime'+$(this).val()).removeClass('hide').addClass('show');
    });
});

$(document).on('click', ".new_category", function(){
	$.each($(".new_category:checked"), function(){            
        if($('.grouptime'+$(this).val()).hasClass("show" )){
        	alert('Category already selected');
        	$(this).attr('checked', false);
        }
    });
});

$(document).on('change', ".hour, .minute", function(){
	//alert('hi');
	var hr = 0;
	var min = 0;
	var value = '00:00';
	$.each($(".hour"), function(){    
		if(typeof $(this).val() != 'null'){			        
        	hr = Number(hr)+Number($(this).val());		
        }
    });

	$.each($(".minute"), function(){    
		if(typeof $(this).val() != 'null'){			        
        	min = Number(min)+Number($(this).val());		
        }
    });

    console.log(hr);console.log(min);

	if(hr <= 9 || typeof hr == 'undefined' || (hr == 10 && (typeof min == 'undefined' || min == 0))){
		hr = hr <=9 ? '0'+hr : hr;
		min = min <=9 ? '0'+min : min;
		value = (hr || '00') + ':' + (min || '00');
	}else{
	  	alert('Maximum Work limit for One Day is 10 Hours');
	  	value = $('#hours').val();
	  	$(this).val('');
  	}

  	//$('#hours').val(value);

	//alert(value);
	
});

$(document).on('change', "#transaction_date", function(){
	var date_val = $(this).val();
	date_val.split('-');
	var base_url = '<?php echo base_url('admin/Timesheet/attendance/');?>';
	var url = base_url+date_val.replace(/\//g , '-');
	$('#redirect').attr('href', url);
	$('#redirect')[0].click();
	
})

function setLock(){
    var month="<?php echo $month?>";
    var choosen="<?=$choosen?>";
    $('.msg_date').html(choosen);
    $('.msg_date1').html("Lock the Timesheet Data For "+month+" till "+choosen);
    $('#confirm_box').modal('show');
    
    return false;
	
/*	var month="<?php echo $month?>";
    var choosen="<?=$choosen?>";
	var x = confirm("This will Lock the Timesheet Data For "+month+" till "+choosen+" , are you sure?");
	if (x)
	{
	    
	    $('#islock').val('1');
	    return true;
	}
    else
    return false;*/
}

/*function setUnLock(){
	
	var month="// echo $month";
    var choosen="$choosen";
    var choosen=dateFormat(choosen, "m-dd-yyyy");
   
 
	var x = confirm("This will Unlock the Timesheet Data For "+choosen+"  , are you sure?");
	if (x){
      
		var base_url = '// echo base_url('admin/Timesheet/Update_lock/');';
		var url = base_url+"/"+choosen;
		window.location.href = url;
  }else{
    return false;}
}*/

/*function ConfirmLock()
{
	alert("This will Lock the Timesheet Data For current month till  CHOOSEN DATE , are you sure?");
  var x = confirm("This will Lock the Timesheet Data For current month till  CHOOSEN DATE , are you sure?");
  if (x)
      return true;
  else
    return false;
}*/

</script>
<script >
	$(document).ready(function() {
	  // 
	  $("#transaction_datee").datepicker( "setDate" , "<?php if(isset($date)){ echo $date; } ?>" );
	    var today = new Date();
        $('#transaction_datee').datepicker({
            //format: "yyyy/mm/dd",
                useCurrent: false,
               /* autoclose:true,
                endDate: "today",
                maxDate: today,
                setDate: "2023-04-20",
                defaultDate: '2023-04-20'*/
            //$( ".selector" ).datepicker({  });
        })
        //Listen for the change even on the input
        .change(dateChanged)
        .on('changeDate', dateChanged)
        
        
      
        
        
         
    	
});

	


	
	function dateChanged(ev) {
		//var date_val = $(this).val();
		var date_val = ev.date;
		var fdate=dateFormat(date_val, "m/dd/yyyy");
        //alert (fdate);
       
        var $nonempty = $('.hour').filter(function() {
            return this.value != ''
        });
        
        var $nonminempty = $('.minute').filter(function() {
            return this.value != ''
        });
        
        if (($nonempty.length != 0 || $nonminempty.length != 0) && <?= $islock ?> != "1") {
            if(confirm("Do you want to save changes?")){
               // $("#timesheet_form").ajaxForm({url: 'Timesheet/addAttendance', type: 'post'})
                var frm = $('#timesheet_form');
                
                $.ajax({
                    type: frm.attr('method'),
                    url: "<?= base_url() ?>admin/Timesheet/addAttendance",
                    //data: frm.serialize(),
                    data: $('#timesheet_form').serialize(),
                    //contentType: false,
                    //processData: false,
                    success: function (data) {
                        $('#transaction_date').val(fdate);
                        fdate.split('-');
                        var base_url = '<?php echo base_url('admin/Timesheet/attendance/');?>';
                        var url = base_url+fdate.replace(/\//g , '-');
                        $('#redirect').attr('href', url);
                        $('#redirect')[0].click();
                    },
                    error: function (data) {
                        
                    },
                });
                
                
            }
            else{
                 $('#transaction_date').val(fdate);
                /*var date_val = $(this).val();
                date_val.split('-');*/
                fdate.split('-');
                var base_url = '<?php echo base_url('admin/Timesheet/attendance/');?>';
                var url = base_url+fdate.replace(/\//g , '-');
                $('#redirect').attr('href', url);
                $('#redirect')[0].click();
                //console.log(ev);
            }
        }
        else{
             $('#transaction_date').val(fdate);
            /*var date_val = $(this).val();
            date_val.split('-');*/
            fdate.split('-');
            var base_url = '<?php echo base_url('admin/Timesheet/attendance/');?>';
            var url = base_url+fdate.replace(/\//g , '-');
            $('#redirect').attr('href', url);
            $('#redirect')[0].click();
            //console.log(ev);
        }
    }
	
</script>

<script >
var dateFormat = function () {
	var	token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
		timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
		timezoneClip = /[^-+\dA-Z]/g,
		pad = function (val, len) {
			val = String(val);
			len = len || 2;
			while (val.length < len) val = "0" + val;
			return val;
		};

	// Regexes and supporting functions are cached through closure
	return function (date, mask, utc) {
		var dF = dateFormat;

		// You can't provide utc if you skip other args (use the "UTC:" mask prefix)
		if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
			mask = date;
			date = undefined;
		}

		// Passing date through Date applies Date.parse, if necessary
		date = date ? new Date(date) : new Date;
		if (isNaN(date)) throw SyntaxError("invalid date");

		mask = String(dF.masks[mask] || mask || dF.masks["default"]);

		// Allow setting the utc argument via the mask
		if (mask.slice(0, 4) == "UTC:") {
			mask = mask.slice(4);
			utc = true;
		}

		var	_ = utc ? "getUTC" : "get",
			d = date[_ + "Date"](),
			D = date[_ + "Day"](),
			m = date[_ + "Month"](),
			y = date[_ + "FullYear"](),
			H = date[_ + "Hours"](),
			M = date[_ + "Minutes"](),
			s = date[_ + "Seconds"](),
			L = date[_ + "Milliseconds"](),
			o = utc ? 0 : date.getTimezoneOffset(),
			flags = {
				d:    d,
				dd:   pad(d),
				ddd:  dF.i18n.dayNames[D],
				dddd: dF.i18n.dayNames[D + 7],
				m:    m + 1,
				mm:   pad(m + 1),
				mmm:  dF.i18n.monthNames[m],
				mmmm: dF.i18n.monthNames[m + 12],
				yy:   String(y).slice(2),
				yyyy: y,
				h:    H % 12 || 12,
				hh:   pad(H % 12 || 12),
				H:    H,
				HH:   pad(H),
				M:    M,
				MM:   pad(M),
				s:    s,
				ss:   pad(s),
				l:    pad(L, 3),
				L:    pad(L > 99 ? Math.round(L / 10) : L),
				t:    H < 12 ? "a"  : "p",
				tt:   H < 12 ? "am" : "pm",
				T:    H < 12 ? "A"  : "P",
				TT:   H < 12 ? "AM" : "PM",
				Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
				o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
				S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
			};

		return mask.replace(token, function ($0) {
			return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
		});
	};
}();

// Some common format strings
dateFormat.masks = {
	"default":      "ddd mmm dd yyyy HH:MM:ss",
	shortDate:      "m/d/yy",
	mediumDate:     "mmm d, yyyy",
	longDate:       "mmmm d, yyyy",
	fullDate:       "dddd, mmmm d, yyyy",
	shortTime:      "h:MM TT",
	mediumTime:     "h:MM:ss TT",
	longTime:       "h:MM:ss TT Z",
	isoDate:        "yyyy-mm-dd",
	isoTime:        "HH:MM:ss",
	isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
	isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
	dayNames: [
		"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
		"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
	],
	monthNames: [
		"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
		"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
	]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
	return dateFormat(this, mask, utc);
};	
</script>
