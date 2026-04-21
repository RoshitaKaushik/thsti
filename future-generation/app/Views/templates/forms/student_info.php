<?php 
$access = getAccess(2); //2 for student info
$studentid = isset($studentid) ? $studentid :'';
$attr = array('class' => 'cmxform form-horizontal tasi-form research','id'=>'student_info');
echo form_open_multipart('admin/form/submitApplication', $attr); 
//echo"<pre>";print_r ($student);
$transcriptclass_js = json_encode($transcriptclass);
$region_js = json_encode($region);

$program_js = json_encode($student_program);

$special_program_js = json_encode($student_special_program);

$tracks_js = json_encode($tracks);


?>

<style>
.modalpopupsss{display:none;}

.checkbox input[type="checkbox"]
{
    /*opacity:1;*/
}
.track_td .multiselect.dropdown-toggle.form-control.btn
{
    display:none;
}
.market_td .multiselect.dropdown-toggle.form-control.btn
{
    display:none;
}
label
{
    font-weight:normal;
}

table.table.table-striped.table-bordered th, table.table.table-striped.table-bordered td,   table.table.table-striped.table-bordered td .form-control {
    font-size: 12px;
}
input#program_start11, input#program_end11, #special_start11, input#special_end11 {
   
    display: inline-block;
}

.special_start-end-box span {
    display: inline-block!important;
    width: 48%;
    box-sizing: border-box;
    border-right: 1px solid #ddd;
	padding: 7px 4px;
}
.waves-effect { min-width: 75px;}
.special_start-end-box span:nth-child(2) {
    border-right: none;
}
.special_start-end-box {
    padding: 0!important;
}
.special_start-end-box1 {
    padding: 7px 4px!important;
}
.table-striped>tbody>tr:nth-of-type(3n+1) {
    background-color: #eae9e9!important;
}
.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: transparent;
}
</style>


<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th style="width:2%">S.No</th>
			<th style="width:6%">Class </th>
			<!--<th style="width:8%">Sex <span class="requires">*</span></th> -->
			<th style="width:12%">Region </th>
			<th style="width:12%">Track</th>
			<th style="width:18%">Market </th>                                       
			<th style="width:17%" >Concentration/Specialization </th>                                     
			<th style="width:17%">Start Date</th>
			<!--<th style="width:8%">GPA </th> -->
			<th style="width:10%">Graduation</th>
			<th style="width:10%">Withdrawn </th>												
			<th style="width:10%">Action</th>												
		</tr>
	</thead>
	<div class="pull-right brown" ><b>TRANSCRIPT GPA   : <span id="grandtotaltop_1">
	   <?php
	   
				/* created by sarvesh 20th may 2019 for getting average semester GPA */
	
				 $total_crdt_attempt = $total_credit['total_credit_attempt'];
			
				 $total_quality_points = $total_credit['total_quality_points'];
					
				 if($total_crdt_attempt == 0 ||$total_crdt_attempt == '')
				 {
				   $total_crdt_attempt = 1; 	
				 }
				
				
					$total_semester_gpa = ($quality_point[0]['quality_point']/$total_crdt_attempt);
					echo number_format((float)$total_semester_gpa, 2, '.', '');
				
	               
	
			/*
			//echo '<pre>'; print_r($studentcurriculumgpa); die;
			$totalCreditAttempt = $totalQualityPoints = 0;
			foreach($studentcurriculumgpa as $gpavalues){
				$TranscriptClass =  $gpavalues['class'];
				
				$GradeName =  $gpavalues['Grade'];
				
				$resultGradeValue = getgradevaluebyclass($TranscriptClass,$GradeName);
				
				if(!empty($resultGradeValue)){
				$gradeValue = $resultGradeValue[0]['GradeValue'];
				}else{$gradeValue = 0;}

				$CreditAttempt = $gpavalues['CreditAttempt'];				$CreditEarned = $gpavalues['CreditEarned'];
				$totalQuality = $CreditEarned * $gradeValue; 
				$totalQualityPoints+= $totalQuality;
				
				 $totalCreditAttempt+= $CreditAttempt;
				
			}
				if($totalCreditAttempt!='' & $totalQualityPoints!=''){
				$average_gpa = ($totalQualityPoints/$totalCreditAttempt);
				echo number_format((float)$average_gpa, 2, '.', '');
				}
				else{
				echo '';
				}
				*/
			?></span></b></div>
	<tbody class="tbl-body-student-info"> 
		<?php  
			$ref_count = 0; 							
			$ref=getStudentInfo(isset($studentid) ? $studentid : 0);
			//echo "<pre>";print_r($ref);
			
			if(!empty($ref)){
			$ref_count = 0;
			echo '<input type= "hidden" id="count7" value="'.(count($ref)+1).'" >';
			foreach($ref as $student){
			
			$disabe_graduation = false;
			$disabe_withdrawn = false;
			if(isset($student['Withdrawn'])){
				if($student['Withdrawn']!=''){
					//$disabe_graduation = true;
					$disabe_graduation = false;
				}
			}
			if(isset($student['Graduation'])){
				if($student['Graduation'] != ''){
					//$disabe_withdrawn = true;
					$disabe_withdrawn = false;
				}
			}
			$ref_count++;
		?>
		<tr id="TextBoxDivRD<?php echo $ref_count; ?>">
		    <td rowspan="3"><?php echo $ref_count;?></td>
		    <!--<td rowspan="4"><span><?php if(isset($studentid)){ echo $studentid;}?><span></td>-->
			<td>
			    <input type="hidden" name="student_rowid[<?=$ref_count?>]" id="student_rowid<?=$ref_count?>" value="<?php if(isset($student['Student_RowID'])){ echo $student['Student_RowID'];}?>">
				<input type="hidden" name="studentinfoid<?=$ref_count?>" id="studentinfoid<?=$ref_count?>" value="<?php if(isset($student['StudentInfoID'])){ echo $student['StudentInfoID'];}?>">
				
				<span class="show num">
					<?php if(isset($student['Class'])){ echo $student['Class'];}?>
				</span>
				<select name="Class[<?=$ref_count;?>]" id="Class<?=$ref_count;?>" class="form-control hide" >
				<option value="">Select Class</option>
				<?php foreach($editclass as $row){
					 if($row['Active']==1){
						 $dispmsg="display:block";
					 }else if($row['Active']==2 && $row['Class']==$student['Class']){
						 $dispmsg="display:block";
					 }else{
						 $dispmsg="display:none";
					 }
				 $activeclass = ($row['Class']==$student['Class'] ? 'selected="selected"':'');	
				?>
				<option value="<?php echo $row['Class'];?>" <?php echo $activeclass;?> style="<?php echo $dispmsg;?>"><?php echo $row['Class'];?></option>
				<?php }?>
				</select>
			</td>
			<!--<td>
				<span class="show">
					<?php 
					if(isset($student['Sex'])){  
						if($student['Sex'] == 'M'){
							echo "Male";
						}elseif($student['Sex'] == 'F'){
							echo "Female";
						}elseif($student['Sex'] == 'T'){
							echo "Transgender";
						}
					}	
					?>
				</span>
				<select class="form-control hide" id="Sex<?=$ref_count?>" name="Sex[<?=$ref_count?>]" required >
					<option value="">Select</option>	
					<option value="M" <?php if(isset($student['Sex'])){ if($student['Sex'] == 'M'){ echo "selected='selected'";}} ?>>Male</option>	
					<option value="F" <?php if(isset($student['Sex'])){ if($student['Sex'] == 'F'){ echo "selected='selected'";}} ?>>Female</option>	
					<option value="T" <?php if(isset($student['Sex'])){ if($student['Sex'] == 'T'){ echo "selected='selected'";}} ?>>Transgender</option>
				</select>
			</td> -->
			<td>
				<span class="show">
					<?php if(isset($student['Region'])){
						
						if($student['Region']==0 || $student['Region']==NULL || $student['Region']==""){
							echo "None Selected";
						}else{
							if(isset($student['RegionProgram'])){ echo $student['RegionProgram'];}
						}
					
					}?>
				</span>
				<select class="form-control hide" name="Region[<?=$ref_count?>]" id="Region<?=$ref_count;?>" required>
					<option value="0">None Selected</option>
					<?php foreach($completeregion as $rec){
						 $region_status = $rec['Active'];
						if($region_status==1){
							$disp_msg='display:block';
						}else if($region_status==2 && $rec['RPID']==$student['Region']){
							$disp_msg='display:block';
						}else{
							$disp_msg='display:none';
						}
						$flag=($rec['RPID']==$student['Region'] ? 'selected="selected"':'');
						?>
					<option value="<?php echo $rec['RPID'];?>" <?php echo $flag;?> style="<?php echo $disp_msg;?>"><?php echo $rec['RegionProgram'];?></option>
				<?php }?>
				</select>
			</td>
			
			<!-- Start Track -->
			<td class="track_td" id="track_ts<?= $ref_count ?>">
				<span class="show">
				    <?php
					  echo $student['track_name'];
					?>
				</span>
			
				 <select type="text" class="multiselect hidden_field" multiple="multiple" role="multiselect" name="track[<?=$ref_count?>]" id="track<?=$ref_count;?>" >
					 <?php
					  foreach($tracks as $track)
					  {
					      $selected_track_id = explode(",",$student['track_id']);
					      ?>
					      <option <?php if(in_array($track['id'],$selected_track_id)){ echo 'selected'; } ?> value="<?= $track['id'] ?>"><?= $track['track_name'] ?> </option>
					      <?php
					  }
					 ?>
				</select>
			    
			</td>
			<!-- End Track -->
             <!----------------- Market Start  -------------------------->
             	<td class="market_td" id="market_ts<?= $ref_count ?>">
                    <span class="show">
             		<?php if(isset($student['Special_ProgramID'])){
						
						if($student['Special_ProgramID']==0 || $student['Special_ProgramID']==NULL || $student['Special_ProgramID']==""){
							echo "None Program Selected";
						}else{
							if(isset($student['Special_ProgramID'])){ echo $student['Special_Program_Name'];}
						}
					
					}?>
					</span>
             		<select class="form-control multiselect hidden_field" multiple="multiple" role="multiselect" name="specialprogram[<?=$ref_count?>]" id="specialprogram<?=$ref_count;?>" required>
             			<option value="0">None Selected</option>
             			<?php
             			$selected_market_id = explode(",",$student['Special_ProgramID']);
             			foreach($student_special_program as $spe_program)
             			{
             			    $flag=($spe_program['Special_ProgramID']==$student['Special_ProgramID'] ? 'selected="selected"':'');
             				?>
             			<option value="<?php echo $spe_program['Special_ProgramID'];?>" 
             			<?php if(in_array($spe_program['Special_ProgramID'],$selected_market_id))
             			{ echo 'selected'; } ?>
             			><?php echo $spe_program['Special_Program_Name'];?></option>
             		<?php }?>
             		</select>

             	</td>

              <!-- <select class="form-control" id="specialprogram<?=$ref_count+1?>" name="specialprogram[<?=$ref_count+1?>]">
             					<option value="0">Select Market</option>
             					<?php foreach($student_special_program as $spe_program){?>
             					<option value="<?php echo $spe_program['Special_ProgramID'];?>"><?php echo $spe_program['Special_Program_Name'];?></option>
             					<?php }?>
             				
             				</select> -->

             <!----------------- Market End  -------------------------->

						<!----------------- Program Start  -------------------------->

			
			<td>
				<span class="show">
					<?php if(isset($student['ProgramID'])){
					 
					 $results = getActiveProgram($student['ProgramID']);
					 if($student['ProgramID']!=0){
					 $prg_name = $results['Program_Name']; echo $prg_name;
					 }
					}?>
				</span>
				<select class="form-control hide programid" name="ProgramID[<?=$ref_count?>]" id="ProgramID<?=$ref_count;?>">
			    <option value="">Select Program</option>
				<?php if(!empty($student_program)){
				  foreach($student_program as $rows){
					  
					  $program_flag=($rows['ProgramID']==$student['ProgramID'] ? 'selected="selected"':'');
				?>
				<option value="<?php echo $rows['ProgramID']?>" <?php echo $program_flag;?>><?php echo $rows['Program_Name'];?></option>
				
			   <?php } }?>
					
				</select>
			</td>
			
			<!----------------- Program End  -------------------------->
			
				<td>
			    
			     	<span class="show">
					<?php if(isset($student['start_date'])){ if($student['start_date'] != ''){  echo convertDateString($student['start_date']); }} ?>
				</span>
					<input class="form-control datepicker  start_date hide" id="start_date<?=$ref_count?>" name="start_date[<?=$ref_count?>]" type="text" value="<?php 
					if(isset($post['start_date'])){ echo $student['start_date'];}
					else if(isset($student['start_date'])){ if($student['start_date'] != ''){ echo convertDateString($student['start_date']);}} ?>" required>
				
			    
			    
				
			  </td>
			
			<td>
				<span class="show">
					<?php if(isset($student['Graduation'])){ if($student['Graduation'] != ''){  echo convertDateString($student['Graduation']); }} ?>
				</span>
					<input class="form-control datepickerbackward  rec_date hide graduation" id="Graduation<?=$ref_count?>" name="Graduation<?=$ref_count?>" type="text" value="<?php 
					if(isset($post['Graduation'])){ echo $student['Graduation'];}
					else if(isset($student['Graduation'])){ if($student['Graduation'] != ''){ echo convertDateString($student['Graduation']);}} ?>" required>
			</td>
			<!--<td>
				<span class="show">    
					<?php if(isset($student['GPA'])){ if($student['GPA'] != '0.000'){ echo $student['GPA'];}} ?>
				</span>
				<input class="form-control num hide mask" id="GPA<?=$ref_count;?>" name="GPA[<?=$ref_count;?>]" type="text" value="<?php if(isset($student['GPA'])){ if($student['GPA'] != '0.000'){ echo $student['GPA'];}}?>">
			</td>-->
		
			<td>
				<span class="show">
					<?php if(isset($student['Withdrawn']) && $student['Withdrawn']!=""){ echo convertDateString($student['Withdrawn']);}?>
				</span>
				<input class="form-control datepickerbackward rec_date hide withdrawn" id="Withdrawn<?=$ref_count;?>" name="Withdrawn[<?=$ref_count;?>]" type="text" value="<?php 
					if(isset($post['Withdrawn'])){ echo $student['Withdrawn'];}
					else if(isset($student['Withdrawn']) && $student['Withdrawn']!="" && $student['Withdrawn']!='1970-01-01'){ echo convertDateString($student['Withdrawn']);}?>">
			</td>
			
			<td style="width:12%;text-align:center; vertical-align:middle" rowspan="3">
				<?php if($access['edit_access']) { ?>
				
				<!--<input type="submit" name="sub" value="save">-->
				<a href="javascript:void(0)" id="edit-student<?=$ref_count?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-student show pull-left" data-id="<?=$student['StudentInfoID']?>" data-row="<?=$ref_count?>" style="text-align:center;">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				<span><strong>Edit</strong></span>            
				</a>
				<?php } ?>
				
				<a href="javascript:void(0)" id="save-student<?=$ref_count?>" onclick="validateStudent(<?=$ref_count;?>, this)" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-student hide pull-left save<?=$ref_count;?>" data-id="<?=$student['StudentInfoID']?>" data-row="<?=$ref_count?>">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<span><strong>Save</strong></span>            
				</a>
				
				<a href="javascript:void(0)" id="cancel-student<?=$ref_count?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-student hide pull-left" data-id="<?=$student['StudentInfoID']?>" data-row="<?=$ref_count?>">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				<span><strong>Cancel</strong></span>            
				</a>
				<?php if($access['delete_access']) { ?>
				<a href="javascript:void(0);" title="Click To Delete" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 rmvstudent" data-rows="<?php echo $ref_count?>" data-urlms="<?=encryptor('encrypt', $student['Student_RowID'])?>" data-urlns="<?=encryptor('encrypt', $student['StudentInfoID'])?>">
					<span class="fa fa-trash-o" aria-hidden="true"></span>
					<span><strong></strong></span>            
					</a>
				<?php }?>
			</td>
		</tr>
		<!--tr id="TextBoxDivNR<?php echo $ref_count;?>">
		    <td>Note1: </td>
		    <td><span class="show" style="text-align:left;">
		        <?php if(isset($student['Note'])){ echo $student['Note'];}?>
		        </span><textarea name="Note<?php echo $ref_count;?>" id="Note<?php echo $ref_count;?>" class="form-control hide" style="align-content:left;">
		            <?php if(isset($student['Note'])){ echo $student['Note'];}?></textarea>
		     </td>
		     </tr-->
		     
		     
		     
		     
		     <tr id="TextBoxDivNR<?php echo $ref_count;?>">
		         		    <td rowspan='2' >Note: </td>
                		    <td rowspan='2' colspan="3"><span class="show" style="text-align:left;">
                		        <?php if(isset($student['Note'])){ echo $student['Note'];}?>
                		        </span><textarea name="Note<?php echo $ref_count;?>" id="Note<?php echo $ref_count;?>" class="form-control hide" style="align-content:left;">
                		            <?php if(isset($student['Note'])){ echo $student['Note'];}?></textarea>
                		     </td>
                		     
                		     <th>
                		         Enrolled into a Master program
                		     </th>
		        
		   
		   <!-- By Prabhat -->
		   <!--th>Start Date  : </th>
		   <th>End Date :</th>
		   <th>Start Date :</th>
		   <th>End Date  :</th-->
		  <th> Non-degree student/certificate</th>
		  <th colspan="2">Deferred :</th>
		  <!--th></th-->
		  
		</tr>
		 
		 <tr id ="eTextBoxDivNR_specail<?php echo $ref_count;?>">
		     
		     <td>
		         
		         <span class="show">
					<?php if(isset($student['master_program']) && $student['master_program']!=""){ echo $student['master_program'];}?>
				</span>
				
				 <?php
		            $sec = '';
		         	if(isset($post['master_program']))
		         	{
		         	    $sec =  $student['master_program'];
		         	}
					else if(isset($student['master_program']) && $student['master_program']!="")
					{
					 $sec =  $student['master_program'];
					}?>
					
					<input  <?php if($sec == 'Yes'){ echo "checked"; } ?> type='checkbox' name="master_program[<?=$ref_count;?>]" value='Yes' class='hide master_program' id="master_program<?=$ref_count;?>">
		        
				
			    
		         
		         
		     </td>
		     
		     <!--td>
				<span class="show">
				    
					<?php if(isset($student['special_start']) && $student['special_start']!=""){ echo $student['special_start'];}?>
				</span>
				<input class="form-control datepickerbackward  hide special_start" id="special_start<?=$ref_count;?>" name="special_start[<?=$ref_count;?>]" type="text" value="<?php 
				 	if(isset($post['special_start'])){ echo $student['special_start'];}
					else if(isset($student['special_start']) && $student['special_start']!="" && $student['special_start']!='1970-01-01'){ echo convertDateString($student['special_start']);}?>">
			</td>
			<td>
				<span class="show">
					<?php if(isset($student['special_end']) && $student['special_end']!=""){ echo $student['special_end'];}?>
				</span>
				<input class="form-control datepickerbackward  hide special_end" id="special_end<?=$ref_count;?>" name="special_end[<?=$ref_count;?>]" type="text" value="<?php 
				 	if(isset($post['special_end'])){ echo $student['special_end'];}
					else if(isset($student['special_end']) && $student['special_end']!="" && $student['special_end']!='1970-01-01'){ echo convertDateString($student['special_end']);}?>">
			</td>
			
			<td>
				<span class="show">
					<?php if(isset($student['program_start']) && $student['program_start']!=""){ echo $student['program_start'];}?>
				</span>
				<input class="form-control datepickerbackward  hide program_start" id="program_start<?=$ref_count;?>" name="program_start[<?=$ref_count;?>]" type="text" value="<?php 
				 	if(isset($post['program_start'])){ echo $student['program_start'];}
					else if(isset($student['program_start']) && $student['program_start']!="" && $student['program_start']!='1970-01-01'){ echo convertDateString($student['program_start']);}?>">
			</td>
			
			<td>
				<span class="show">
					<?php if(isset($student['program_end']) && $student['program_end']!=""){ echo $student['program_end'];}?>
				</span>
				<input class="form-control datepickerbackward  hide program_end" id="program_end<?=$ref_count;?>" name="program_end[<?=$ref_count;?>]" type="text" value="<?php 
				 	if(isset($post['program_end'])){ echo $student['program_end'];}
					else if(isset($student['program_end']) && $student['program_end']!="" && $student['program_end']!='1970-01-01'){ echo convertDateString($student['program_end']);}?>">
			</td-->
		     <td>
		         <span class="show">
					<?php if(isset($student['enroll_certificate']) && $student['enroll_certificate']!=""){ echo $student['enroll_certificate'];}?>
				</span>
                    <?php
		            $sec = '';
		         	if(isset($post['enroll_certificate']))
		         	{
		         	    $sec =  $student['enroll_certificate'];
		         	}
					else if(isset($student['enroll_certificate']) && $student['enroll_certificate']!="")
					{
					 $sec =  $student['enroll_certificate'];
					}?>
		         
		         <input  <?php if($sec == 'Yes'){ echo "checked"; } ?> type='checkbox' name="enroll_certificate[<?=$ref_count;?>]" value='Yes' class='hide enroll_certificate' id="enroll_certificate<?=$ref_count;?>">    
		     </td>
		     <td colspan="2">
		         
		         <span class="show">    
					<?php if(isset($student['Deffered']) && $student['Deffered']!=""){ echo convertDateString($student['Deffered']);}?>
				</span>
				<input class="form-control datepickerbackward rec_date hide deffered" id="Deferred<?=$ref_count;?>" name="Deferred[<?=$ref_count;?>]" type="text" value="<?php 
					if(isset($post['Deffered'])){ echo $student['Deffered'];}
					else if(isset($student['Deffered'])){ if($student['Deffered'] != ''){ echo convertDateString($student['Deffered']);}} ?>">
		         
		     </td>
		     
		     <!--td></td>
		     <td></td-->
		     
		 </tr>
		 
		
		     
		     
		     
		     
		
		<?php }} ?>
		<?php if($access['add_access']) { ?>
		<tr id="TextBoxDivRD<?=$ref_count+1?>">
		<td rowspan="3"><?php echo $ref_count+1;?></td>
		    <!--<td rowspan="3"><?php if(isset($studentid)){ echo $studentid; }?></td>-->
			<td> <input type="hidden" id="count7" value="2">
			<input type="hidden" name="student_rowid[<?=$ref_count+1?>]" id="student_rowid<?=$ref_count+1?>" value="">
			<input type="hidden" name="studentinfoid<?=$ref_count+1?>" id="studentinfoid<?=$ref_count+1?>" value="<?php if(isset($studentid)){ echo $studentid;}?>">
			<span class="hide">		
			</span>
			<select name="Class[<?=$ref_count+1;?>]" id="Class<?=$ref_count+1;?>" class="form-control" required>
				<option value="">Select Class</option>
				<?php foreach($transcriptclass as $row){
				 //$activeclass = ($row['Class']==$student['Class'] ? 'selected="selected"':'');	
				?>
				<option value="<?php echo $row['Class'];?>" <?php echo isset($activeclass)?$activeclass:'';?>><?php echo $row['Class'];?></option>
				<?php }?>
				</select>
			</td>
			<!--<td>
				<span class="hide"></span>
				<select class="form-control" name="Sex[<?=$ref_count+1?>]" id="Sex<?=$ref_count+1?>" required>
					<option value="">Select</option>	
					<option value="M">Male</option>	
					<option value="F">Female</option>	
					<option value="T">Transgender</option>
				</select>
			</td> -->
			
			<td>
			<span class="hide"></span>
			<select class="form-control" id="Region<?=$ref_count+1?>" name="Region[<?=$ref_count+1?>]">
				<option value="0">None Selected</option>
				<?php foreach($region as $rows){?>
				<option value="<?php echo $rows['RPID'];?>"><?php echo $rows['RegionProgram'];?></option>
				<?php }?>
			
			</select>
			</td>
			
			
			<td id="track_ts<?= $ref_count+1 ?>">
			    <span class="hide"></span>
			    <select type="text" class="multiselect hide" multiple="multiple" role="multiselect" id="track<?=$ref_count+1?>" name="track[<?=$ref_count+1?>]">
			    	<?php
					  foreach($tracks as $track){?>
					  <option value="<?= $track['id'] ?>"><?= $track['track_name'] ?> </option>
					  <?php } ?>
    			</select>
			    
			</td>
						
			<td id="market_ts<?= $ref_count+1 ?>">
			  <span class="hide"></span>
			   <select class="multiselect form-control" multiple="multiple" role="multiselect" id="specialprogram<?=$ref_count+1?>" name="specialprogram[<?=$ref_count+1?>]">
			   				<option value="0">Select Market</option>
			   				<?php foreach($student_special_program as $spe_program){?>
			   				<option value="<?php echo $spe_program['Special_ProgramID'];?>"><?php echo $spe_program['Special_Program_Name'];?></option>
			   				<?php }?>
			   			
			   			</select>
			</td>
			<td>
			<span class="hide"></span>
				<select class="form-control programid" id="ProgramID<?=$ref_count+1?>" name="ProgramID[<?=$ref_count+1?>]">
					<option value="">Select Program</option>
					<?php if(!empty($student_program)){
						foreach($student_program as $records){
					?>
			        <option value="<?php echo $records['ProgramID'];?>"><?php echo $records['Program_Name'];?></option>
				<?php } }?>
			  </select>
			</td>
			
		
			  
			  <td>
			    
			     	<span class="hide">
					
				</span>
					<input class="form-control datepicker  start_date" id="start_date<?=$ref_count+1?>" name="start_date[<?=$ref_count+1?>]" type="text"  required>
				
			  </td>
			
			
			
		
			<td>
			<span class="hide"></span>
			<input class="form-control datepickerbackward rec_date graduation " id="Graduation<?=$ref_count+1?>" name="Graduation[<?=$ref_count+1?>]" type="text">
			</td>
			
			<!-- <td>
			<span class="hide"></span>
			<input class="form-control num mask" id="GPA<?=$ref_count+1?>" name="GPA[<?=$ref_count+1?>]" type="text">
			</td> -->
			
			<td>
			<span class="hide"></span>
			<input class="form-control datepickerbackward  rec_date withdrawn" id="Withdrawn<?=$ref_count+1?>" name="Withdrawn[<?=$ref_count+1?>]" type="text" onkeypress="ValidateAlphabets(event)">
			</td>
			
			<td rowspan="3" style="vertical-align:middle">
				<?php if($access['edit_access']) { ?>				
				
				<a href="javascript:void(0)" id="edit-student<?=$ref_count+1?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-student hide pull-left" data-id="<?=$studentid?>" data-row="<?=$ref_count+1?>" style="text-align:center;">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				<span><strong>Edit</strong></span>            
				</a>
				<?php } ?>
				
				<?php if($access['add_access']) { ?>
				<a style="top: -22px;" href="javascript:void(0)" id="add-student<?=$ref_count+1?>" onclick="validateStudent(<?=$ref_count+1;?>, this)" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-student">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					<span><strong>ADD</strong></span>            
				</a>
				
				
				<a href="javascript:void(0)" id="save-student<?=$ref_count+1?>" onclick="studentinfo(<?=$ref_count+1;?>, this)" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-student hide pull-left save<?=$ref_count+1;?>" data-id="<?=$studentid?>" data-row="<?=$ref_count+1?>">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<span><strong>Save</strong></span>            
				</a>
				<?php } ?>
				
				<a href="javascript:void(0)" id="cancel-student<?=$ref_count+1?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-student hide pull-left" data-row="<?=$ref_count+1?>">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				<span><strong>Cancel</strong></span>            
				</a>
			</td>
		</tr>
		<tr id="TextBoxDivNR<?php echo $ref_count+1;?>"> <td rowspan='2'>Note: </td>
                		    <td rowspan='2' colspan="3">
		    <span class="hide"style="text-align:left;"></span>
		    <textarea name="Note<?php echo $ref_count+1;?>" id="Note<?php echo $ref_count+1;?>" class="form-control" style="align-content:left;"></textarea>
		   </td>
		   
		   <th>
		       Enrolled into a Master program
		   </th>
		   
		  
		   
		   
		   <!-- By Prabhat -->
		   <!--th>Start Date : </th>
		   <th>End Date :</th>
		   <th>Start Date:</th>
		   <th>End Date Program :</th-->
		   <th> Non-degree student/certificate</th>
		  <th colspan="2">Deferred :</th>
		  <!--th></th-->
		</tr>
		 
		 <tr>
		     
		      	<td>
    			<span class="hide"></span>
    			<input  type='checkbox' id="master_program<?php echo $ref_count+1;?>" value='Yes' class='master_program' name='enroll_master<?php echo $ref_count+1;?>'>
    			
    			</td>
		     <!--td><span class="hide"style="text-align:center;"></span><input class='form-control datepickerbackward special_start' id="special_start<?php echo $ref_count+1;?>"  name='special_start<?php echo $ref_count+1;?>'></td>
		     <td><span class="hide"style="text-align:center;"></span><input class='form-control datepickerbackward special_end' id="special_end<?php echo $ref_count+1;?>" name='special_end<?php echo $ref_count+1;?>'></td>
		     <td><span class="hide"style="text-align:center;"></span><input class='form-control datepickerbackward program_start' id="program_start<?php echo $ref_count+1;?>" name='program_start<?php echo $ref_count+1;?>'></td>
		     <td><span class="hide"style="text-align:center;"></span><input class='form-control datepickerbackward program_end' id="program_end<?php echo $ref_count+1;?>" name='program_end<?php echo $ref_count+1;?>'></td-->
		     <td><span class="hide"style="text-align:center;"></span><input  type='checkbox' name='enroll_certificate<?php echo $ref_count+1;?>' value='Yes'  id="enroll_certificate<?php echo $ref_count+1;?>"></td>
		     <td colspan="2"><span class="hide"style="text-align:center;"></span><input class="form-control datepickerbackward rec_date deffered" id="Deferred<?=$ref_count+1?>" name="Deferred[<?=$ref_count+1?>]" type="text"></td>
		     <!--td><span class="hide"style="text-align:center;"></span></td-->
		 </tr>
		 
		
		
		<?php
		}		
		$count7 = $ref_count == 0 ? 1 : $ref_count;
		

		?>
	</tbody>
</table>
<?php if($access['edit_access'] || $access['add_access']) { ?>
<!--<button type="submit" class="btn btn-success center-block">Save</button>	-->
								
<?php } echo form_close();?> 
<script>
$(document).on('change', '.date-checks', function(){
	var current = $(this).val();
	if(current != ''){
		$(this).closest('tr').find('.date-checks').not(this).attr('disabled', true);
	}else{
		$(this).closest('tr').find('.date-checks').attr('disabled', false);
	}
	
});

$(document).on('click', '.edit-student', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivRD'+row;
	student_note_selector ='#TextBoxDivNR'+row;
	var special_program = '#eTextBoxDivNR_specail'+row;
	var ceertificate = '#eTextBoxDivNR_certificate'+row;
	   // By prabhat 20-05-2020
		$(special_program+' span.show, '+special_program+' input.show, '+special_program+' a.edit-student').removeClass('show').addClass('hide');
		$(special_program+' input, '+selector+' input, '+selector+' select, '+selector+' a.save-student, '+selector+' a.cancel-student').removeClass('hide').addClass('show');
		
		
		$(ceertificate+' span.show, '+ceertificate+' input.show, '+ceertificate+' a.edit-student').removeClass('show').addClass('hide');
		$(ceertificate+' input, '+selector+' input, '+selector+' input, '+selector+' a.save-student, '+selector+' a.cancel-student').removeClass('hide').addClass('show');
		
	    // End 20-05-2020
	$(student_note_selector+' span.show, '+selector+' span.show, '+selector+' a.edit-student').removeClass('show').addClass('hide');
	
	$(student_note_selector+' textarea, '+selector+' input, '+selector+' select, '+selector+' a.save-student, '+selector+' a.cancel-student').removeClass('hide').addClass('show');
    
    $('#track_ts'+row+' .multiselect.dropdown-toggle.form-control.btn').show();
    $('#market_ts'+row+' .multiselect.dropdown-toggle.form-control.btn').show();

    $('.hidden_field').removeClass('show');
}); 

$(document).on('click', '.cancel-student', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivRD'+row;
	var student_note_selector ='#TextBoxDivNR'+row;
	
	var special_program = '#eTextBoxDivNR_specail'+row;
	var ceertificate = '#eTextBoxDivNR_certificate'+row;
	
	$(special_program+' textarea, '+special_program+' input, '+special_program+' select, '+special_program+' a.save-student, '+special_program+' a.cancel-student').removeClass('show').addClass('hide');
	$(special_program+' span.hide, '+selector+' span.hide, '+selector+' a.edit-student').removeClass('hide').addClass('show');
	
		$(ceertificate+' textarea, '+ceertificate+' input, '+ceertificate+' select, '+ceertificate+' a.save-student, '+ceertificate+' a.cancel-student').removeClass('show').addClass('hide');
	$(ceertificate+' span.hide, '+selector+' span.hide, '+selector+' a.edit-student').removeClass('hide').addClass('show');

	
	
	$(student_note_selector+' textarea, '+selector+' input, '+selector+' select, '+selector+' a.save-student, '+selector+' a.cancel-student').removeClass('show').addClass('hide');
	$(student_note_selector+' span.hide, '+selector+' span.hide, '+selector+' a.edit-student').removeClass('hide').addClass('show');
    
    $('#track_ts'+row+' .multiselect.dropdown-toggle.form-control.btn').hide();
    $('#market_ts'+row+' .multiselect.dropdown-toggle.form-control.btn').hide();
}); 
</script>

<script type="text/javascript">
/*
 $('.submit').click(function(){
        var id = (this.id);
        var form_data = {            //repair
            id: id,
            name: $('#name_' + id).val(),
            rate: $('#rate_' + id).val(),
            qty: $('#qty_' + id).val()
        };

    $.ajax({
        url: "<?php echo site_url('shop/add'); ?>",
        type: 'POST',
        data: form_data, // $(this).serialize(); you can use this too
        success: function(msg) {
              alert("success..!! or any stupid msg");
        }

   });
   return false;

});

<td><span class="hide"></span><select class="form-control" name="Sex['+next_id+']" id="Sex'+next_id+'" required><option value="">Select</option><option value="M">Male</option><option value="F">Female</option><option value="T">Transgender</option></select></td>
<td><span class="hide"></span><input class="form-control num mask" id="GPA'+next_id+'" name="GPA['+next_id+']" type="text" required></td>
*/


 function studentinfo(id, ev)
 {
    
	var transcriptclass_list = JSON.parse('<?=$transcriptclass_js?>');
	var region_list = JSON.parse('<?=$region_js?>');
	var tracks_list = JSON.parse('<?= $tracks_js ?>');
	var program_list = JSON.parse('<?=$program_js?>');
	var special_program_list = JSON.parse('<?=$special_program_js?>');
	 student_rowid=$('#student_rowid'+id).val();
	 student_infoid=$('#studentinfoid'+id).val();
	 studentclass= $('#Class'+id).val();
	 sex= $('#Sex'+id).val();
	 sex_text= $('#Sex'+id+' option:selected').text();
	 region= $('#Region'+id).val();
	 specialprogram = $('#specialprogram'+id).val();
	 if(region!=''){
		 region_text= $('#Region'+id+' option:selected').text(); 
	 }else{
		region_text=''; 
	 }
	 var program = $('#ProgramID'+id).val();
	 
	
 	 if(program!=''){
		 program_text = $('#ProgramID'+id+' option:selected').text();
	 }else{
		 program_text='';
	 }
	 if(specialprogram !='')
	 {
	 	special_program_text = $('#specialprogram'+id+' option:selected').text();
	 }
	
	 track = $('#track'+id).val();
	 tract_name_val = $('#track'+id+" option:selected").text();
	 market_selected_val = $('#track'+id+" option:selected").text();
	 graduation=$('#Graduation'+id).val();
	 gpa=$('#GPA'+id).val();
	 deferred=$('#Deferred'+id).val();
	 withdrawn=$('#Withdrawn'+id).val();
	 student_note = $('#Note'+id).val();
	 var next_id = parseInt(id+1);
	 
	 
	 
	 // By prabhat 15-05-2020
	 
	 
	 
	 
	 
	 
	 var special_start = $('#special_start'+id).val();
	 var special_end = $('#special_end'+id).val();
	 
	 if(special_start>special_end)
	 {
	     alert("Market Start Date is always smaller than Market End Date");
	     $('#special_end'+id).focus();
	     exit();
	 }
	 
	 
	 var program_start = $('#program_start'+id).val();
	 var program_end = $('#program_end'+id).val();
	 
	 if(program_start>program_end)
	 {
	     alert("Program Start Date is always smaller than program End Date");
	     exit();
	 }
	 
	 var start_date = $('#start_date'+id).val();
	 var enroll_certificate = '';
	 var master_program = '';
	 
	   if($('#master_program'+id).prop("checked") == true){
                master_program = 'Yes';
            }
            else if($('#master_program'+id).prop("checked") == false){
                master_program = 'No';
            }
            
            if($('#enroll_certificate'+id).prop("checked") == true){
                enroll_certificate = 'Yes';
            }
            else if($('#enroll_certificate'+id).prop("checked") == false){
                enroll_certificate = 'No';
            }
	 
	 //transcriptclass_html
	transcriptclass_html = '<select class="form-control" id="Class'+next_id+'" name="Class['+next_id+']"><option value="">Select</option>';
	$.each(transcriptclass_list, function (key, val) {
		transcriptclass_html += '<option value="'+val.Class+'">'+val.Class+'</option>';
    });

	//region_html
	region_html = '<select class="form-control" id="Region'+next_id+'" name="Region['+next_id+']"><option value="0">None Selected</option>';
	$.each(region_list, function (key, val) {
		region_html += '<option value="'+val.RPID+'">'+val.RegionProgram+'</option>';
    });
    
    // tracks
    track_html = '<select type="text" class="multiselect hidden_field" multiple="multiple" role="multiselect" name="track['+next_id+']" id="track'+next_id+'">';
	$.each(tracks_list, function (key, val) {
		track_html += '<option value="'+val.id+'">'+val.track_name+'</option>';
    });			
					  
	//Program_html
	program_html = '<select class="form-control programid" id="ProgramID'+next_id+'" name="ProgramID['+next_id+']"><option value="">Select Program</option>';
	$.each(program_list, function (key, val) {
		program_html += '<option value="'+val.ProgramID+'">'+val.Program_Name+'</option>';
    });
 
 	// Market list
	//special_program_list
    special_program_html ='<select class="form-control multiselect specialprogram" multiple="multiple" role="multiselect" id="specialprogram'+next_id+'" name="specialprogram['+next_id+']"><option value="">Select Market</option>';
     
     $.each(special_program_list, function (key, val) {
		special_program_html += '<option value="'+val.Special_ProgramID+'">'+val.Special_Program_Name+'</option>';
     });
     special_program_html += '</select>';
     // End Market list
   
  var new_row = '<tr id="TextBoxDivRD'+next_id+'"><td rowspan="3">'+next_id+'</td>';
  // new_row +='<td rowspan="4"><span>'+student_infoid+'</span></td>';
   new_row +='<td> <input type="hidden" id="count7" value="'+next_id+'"><input type="hidden" name="studentinfoid'+next_id+'" id="studentinfoid'+next_id+'" value="'+student_infoid+'"><input type="hidden" name="student_rowid['+next_id+']" id="student_rowid'+next_id+'" value=""><span class="hide"></span>'+transcriptclass_html+'</td>';
   new_row +='<td><span class="hide"></span>'+region_html+'</td>';
   // Track list
   new_row +='<td id="track_ts'+next_id+'"><span class="hide"></span>'+track_html+'</td>';
   new_row +='<td id="market_ts'+next_id+'"><span class="hide"></span>'+special_program_html+'</td>';
   new_row +='<td><span class="hide"></span>'+program_html+'</td>';
   
   //	new_row += '<td><span class="hide"></span><input type="checkbox" value="Yes" id="master_program'+next_id+'" name="master_program'+next_id+'"></td>';
   
   
   new_row += '<td>';
   new_row += '<span class="hide">';
   new_row += '</span>';
   new_row += '<input class="form-control datepicker  start_date show" id="start_date'+next_id+'" name="start_date['+next_id+']" type="text">';
   new_row += '</td>';
   
   new_row +='<td><span class="hide"></span><input class="form-control datepickerbackward  rec_date graduation" id="Graduation'+next_id+'" name="Graduation['+next_id+']" type="text"></td>';
  new_row +='<td><span class="hide"></span><input class="form-control datepickerbackward rec_date withdrawn" id="Withdrawn'+next_id+'" name="Withdrawn['+next_id+']" type="text"></td>';
   new_row +='<td rowspan="3"><a href="javascript:void(0)" id="edit-student'+next_id+'" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-student hide pull-left" data-id="'+student_infoid+'" data-row="'+next_id+'" style="text-align:center;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><span><strong> Edit</strong></span></a><a href="javascript:void(0)" id="save-student'+next_id+'" onclick="validateStudent('+next_id+', this)" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-student hide pull-left save'+next_id+'" data-id="'+student_infoid+'" data-row="'+next_id+'"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span><strong>Save</strong></span></a><a href="#" id="add-student'+next_id+'" onclick="studentinfo('+next_id+', this)" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-student"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span><strong>ADD</strong></span></a><a href="javascript:void(0)" id="cancel-student'+next_id+'" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-student hide pull-left" data-row="'+next_id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span><strong>Cancel</strong></span></a></td></tr>';
   new_row +='<tr id="TextBoxDivNR'+next_id+'">';
   new_row +='<td rowspan="2">Note: </td><td rowspan="2" colspan="3">';
   new_row +='<span class="hide" style="text-align:left;"></span>';
   new_row +='<textarea name="Note'+next_id+'" id="Note'+next_id+'" class="form-control" style="align-content:left;"></textarea>';
   new_row +='</td>';
   
    new_row +='<th>';
    new_row +='Enrolled into a Master program';
    new_row +='</th>';
   //new_row +='<th>Start Date  : </th>';
   //new_row +='<th>End Date  :</th>';
   //new_row +='<th>Start Date:</th>';
   //new_row +='<th>End Date  :</th>';
  
   new_row +='<th>Non-degree student/certificate :</th>';
   new_row +='<th colspan="2">Deferred :</th>';
  // new_row +='<th></th>';
   
   new_row +='</tr>';//textarea tr note 3 close
   new_row +='<tr>';
   new_row +='<td>';
   new_row +='<span class="hide">';
   new_row +='</span>';
   new_row +='<input type="checkbox" name="master_program['+next_id+']" value="Yes" class="show master_program" id="master_program'+next_id+'">';
   new_row +='</td>';
    
    
	//new_row +='<td><span class="hide"></span><input class="form-control datepickerbackward special_start" id="special_start'+next_id+'"  name="special_start'+next_id+'"></td>';
	//new_row +='<span class="hide"></span><td><input class="form-control datepickerbackward special_end" id="special_end'+next_id+'" name="special_end'+next_id+'"></td>';
	//new_row +='<span class="hide"></span><td><input class="form-control datepickerbackward program_start" id="program_start'+next_id+'" name="program_start'+next_id+'"></td>';
	//new_row +='<span class="hide"></span><td><input class="form-control datepickerbackward program_end" id="program_end'+next_id+'" name="program_end'+next_id+'"></td>';
	new_row +='<td><span class="hide"></span><input type="checkbox" id="enroll_certificate'+next_id+'" name="enroll_certificate'+next_id+'"></td>';
	 new_row +='<td colspan="2"><span class="hide"></span><input class="form-control datepickerbackward rec_date deffered" id="Deferred'+next_id+'" name="Deferred['+next_id+']" type="text"></td>';
   
//	new_row +='<td></td>';
	new_row +='</tr>';	 
   
	

	


   
   
	 $.ajax({
			type: "POST",
			url: '<?php echo base_url('admin/Form/submitstudentinfo');?>',
			data: {'<?php echo csrf_token(); ?>':'<?php echo csrf_hash(); ?>', 'studentrowid':student_rowid,'student_infoid':student_infoid,'class':studentclass,'sex':sex,'region':region,'ProgramID':program,'graduation':graduation,'gpa':gpa,'Deferred':deferred,'withdrawn':withdrawn,'student_note':student_note,'specialprogram':specialprogram,'special_start':special_start,'special_end':special_end,'program_start':program_start,'program_end':program_end,'enroll_certificate':enroll_certificate,'master_program':master_program,start_date:start_date,track:track},
			dataType: "html",
			success: function(data){
				//alert(data);
				data = JSON.parse(data);
				alert(data.msg);
				if(data.msg != 'Record Already Exist or saved'){
				   	$('#Class'+id).prev().html(studentclass).addClass('show').removeClass('hide');
					$('#Sex'+id).prev().html(sex_text).addClass('show').removeClass('hide');
					$('#Region'+id).prev().html(region_text).addClass('show').removeClass('hide');
					$('#ProgramID'+id).prev().html(program_text).addClass('show').removeClass('hide');
					$('#specialprogram'+id).prev().html(special_program_text).addClass('show').removeClass('hide');
					$('#Graduation'+id).prev().html(graduation).addClass('show').removeClass('hide');
					$('#GPA'+id).prev().html(gpa).addClass('show').removeClass('hide');
					$('#Deferred'+id).prev().html(deferred).addClass('show').removeClass('hide');
					$('#Withdrawn'+id).prev().html(withdrawn).addClass('show').removeClass('hide');
					$('#Note'+id).prev().html(student_note).addClass('show').removeClass('hide');
					
					$('#special_start'+id).prev().html(special_start).addClass('show').removeClass('hide');
					$('#special_end'+id).prev().html(special_end).addClass('show').removeClass('hide');
					$('#program_start'+id).prev().html(program_start).addClass('show').removeClass('hide');
					$('#program_end'+id).prev().html(program_end).addClass('show').removeClass('hide');
					$('#enroll_certificate'+id).prev().html(enroll_certificate).addClass('show').removeClass('hide');
					$('#master_program'+id).prev().html(master_program).addClass('show').removeClass('hide');
					
					$('#start_date'+id).prev().html(start_date).addClass('show').removeClass('hide');
					$('#start_date'+id).addClass('hide').removeClass('show');
					
					$('#special_start'+id).addClass('hide').removeClass('show');
					$('#special_end'+id).addClass('hide').removeClass('show');
					$('#program_start'+id).addClass('hide').removeClass('show');
					$('#program_end'+id).addClass('hide').removeClass('show');
					$('#enroll_certificate'+id).addClass('hide').removeClass('show');
					$('#master_program'+id).addClass('hide').removeClass('show');
					
					$('#track_ts'+id+' .multiselect.dropdown-toggle.form-control.btn').hide();
					$('#track'+id).prev().html(tract_name_val).addClass('show').removeClass('hide');
					
					$('#market_ts'+id+' .multiselect.dropdown-toggle.form-control.btn').hide();
					$('#market'+id).prev().html(market_selected_val).addClass('show').removeClass('hide');
				//	$('#specialprogram'+id).prev().html(tract_name_val).addClass('show').removeClass('hide');
					
					
					
					$('#Class'+id).addClass('hide').removeClass('show');
					$('#Sex'+id).addClass('hide').removeClass('show');
					$('#Region'+id).addClass('hide').removeClass('show');
					$('#ProgramID'+id).addClass('hide').removeClass('show');
					$('#specialprogram'+id).addClass('hide').removeClass('show');
					$('#Graduation'+id).addClass('hide').removeClass('show');
					$('#GPA'+id).addClass('hide').removeClass('show');
					$('#Deferred'+id).addClass('hide').removeClass('show');
					$('#Withdrawn'+id).addClass('hide').removeClass('show');
					$('#Note'+id).addClass('hide').removeClass('show');
					$(ev).addClass('hide').removeClass('show');
					$('#edit-student'+id).addClass('show').removeClass('hide');
					$('#cancel-student'+id).addClass('hide').removeClass('show');
					
					
					
					if(data.last_id != '') {
						$('#student_rowid'+id).val(data.last_id);
						$('.tbl-body-student-info').append(new_row);		
						$("select[role='multiselect']").multiselect();
					}
				}
			},
		});
	
 }
</script>
<script>
 $(document).ready(function(){
        $('input[name="phone"], input[name="fed_phone"]').mask('(000) 000 0000');
        $('.mask').mask('9.990');
        $('input[name="employer_fax"]').mask('+99-9999999999');
        $('input[name="aadhar"]').mask('999999999999');
        $('input[name="aadhar_enroll_no"]').mask('9999/99999/99999');
        $('.year').mask('9999');
        $('.passedyear').mask('9999');
    });
	</script>
	
	<script type="text/javascript">
	  function validateStudent(id,ev){
		  studentclass= $('#Class'+id).val();

		  sex= $('#Sex'+id).val();
		  /*if(studentclass==""){
			  
			  alert('Class Not Empty');
			  return false;
		  }*/
		  if(studentclass==""){
			  
			  alert('Class Not Empty');
			  return false;
		  }
		  else{
			  studentinfo(id, ev);
			  
		  }
		  
	  }
	
	function isValidDate(dateString)
      {
    // First check for the pattern
    if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
        return false;

    // Parse the date parts to integers
    var parts = dateString.split("/");
    var day = parseInt(parts[1], 10);
    var month = parseInt(parts[0], 10);
    var year = parseInt(parts[2], 10);

    // Check the ranges of month and year
    if(year < 1000 || year > 3000 || month == 0 || month > 12)
        return false;

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];
};
	</script>
	
 <script>
$(document).on("change",".rec_date",function(){
	var current_record_date = $(this).val();
	if(current_record_date!=""){
		var final_date = current_record_date.split('/')[2];
		var year_count_digit = final_date.length;
	if(year_count_digit !=4){
			alert('Year should be 4 digit');
			$(this).val('');
	}
}
	
});

</script>
<script>
// check graduation date validation

$(document).on("change",".graduation",function(){
	
var graduation_date = $(this).val();
var deffered_date = $(this).closest('tr').find('.deffered').val();
var withdrawn_date = $(this).closest('tr').find('.withdrawn').val();

if(deffered_date!="" && withdrawn_date!=""){
	alert('Remove Withdrawn date first');
	$(this).val('');
	return false;
}else{
	return true;
}

});


// check deffered date validation
$(document).on("change",".deffered",function(){
var deffered_date = $(this).val();
var withdrawn_date     =   $(this).closest('tr').find('.withdrawn').val();


if(withdrawn_date!=""){
if(deffered_date > withdrawn_date){
	alert('Deferred date less than withdrawn date');
	$(this).val('');
	return false;
}else{
	return true;
}
}
});
// check withdrawn date validation 
$(document).on("change",".withdrawn",function(){
var withdrawn_date  = $(this).val();
var graduation_date = $(this).closest('tr').find('.graduation').val();
var deffered_date   = $(this).closest('tr').find('.deffered').val();


if(deffered_date!=""){
	if(withdrawn_date < deffered_date){
		alert('Withdrawn date should be greater than deffered date');
		$(this).val('');
		return false;
	}else{
		return true;
	}
}

});

$(document).on("change",".withdrawn",function(){
var withdrawn_date  = $(this).val();
var graduation_date = $(this).closest('tr').find('.graduation').val();
var deffered_date   = $(this).closest('tr').find('.deffered').val();

if(graduation_date!="" && deffered_date!=""){
	alert('Remove graduation date first');
	$(this).val('');
	return false;
}else{
	return true;
}
});



function process(date){
   var parts = date.split("/");
   return new Date(parts[2], parts[1] - 1, parts[0]);
}

</script>

<script type="text/javascript"> 
	$(document).on("click", ".rmvstudent", function() { 
     
		var anim = this.getAttribute("data-urlms"); 
		var anin = this.getAttribute("data-urlns"); 
		var row = this.getAttribute("data-rows");
		var current = this; 

		if(confirm('Are you sure, Want to Delete this record?')){ 
			loading(); 
			$.ajax({ 
				type: "POST", 
				url: "<?=base_url()?>" + "admin/Form/delStudentInfo",  
				data: {toBeChange: anim,studentid: anin}, 
				success: function(res){ 
					//alert(res); 
					console.log(res); 
					$('#overlay').remove(); 
					if(res != 'OK' || res.length <= 0 || res == null){ 
					alert('Something went wrong'); 
					}else{
						
					alert('Deleted Successfully');
					$('#TextBoxDivRD'+row).remove();
					$('#TextBoxDivNR'+row).remove();
					$('#eTextBoxDivNR_specail'+row).remove();
					
					//location.reload(); 
					} 
				} 
			}); 

		} 
	});   
		 function loading() { 
	// add the overlay with loading image to the page 
	var over = '<div id="overlay">' +
	'<p>Please Wait...</p></div>'; 
	$(over).appendTo('body'); 
	} 
	
	
	
	
	
	
	
	
	
	!function($) {
    
    "use strict";// jshint ;_;

    if (typeof ko != 'undefined' && ko.bindingHandlers && !ko.bindingHandlers.multiselect) {
        ko.bindingHandlers.multiselect = {
            init : function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {},
            update : function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
                var ms = $(element).data('multiselect');
                if (!ms) {
                    $(element).multiselect(ko.utils.unwrapObservable(valueAccessor()));
                }
                else if (allBindingsAccessor().options && allBindingsAccessor().options().length !== ms.originalOptions.length) {
                    ms.updateOriginalOptions();
                    $(element).multiselect('rebuild');
                }
            }
        };
    }

    function Multiselect(select, options) {

        this.options = this.mergeOptions(options);
        this.$select = $(select);
        
        // Initialization.
        // We have to clone to create a new reference.
        this.originalOptions = this.$select.clone()[0].options;
        this.query = '';
        this.searchTimeout = null;
        
        this.options.multiple = this.$select.attr('multiple') == "multiple";
        this.options.onChange = $.proxy(this.options.onChange, this);
        
        // Build select all if enabled.
        this.buildContainer();
        this.buildButton();
        this.buildSelectAll();
        this.buildDropdown();
        this.buildDropdownOptions();
        this.buildFilter();
        this.updateButtonText();

        this.$select.hide().after(this.$container);
    };

    Multiselect.prototype = {
        
        // Default options.
        defaults: {
            // Default text function will either print 'None selected' in case no
            // option is selected, or a list of the selected options up to a length of 3 selected options.
            // If more than 3 options are selected, the number of selected options is printed.
            buttonText: function(options, select) {
                if (options.length == 0) {
                    return this.nonSelectedText + ' <b class="caret"></b>';
                }
                else {
                    
                    if (options.length > 5) {
                        return options.length + ' ' + this.nSelectedText + ' <b class="caret"></b>';
                    }
                    else {
                        var selected = '';
                        options.each(function() {
                            var label = ($(this).attr('label') !== undefined) ? $(this).attr('label') : $(this).html();
                            
                            //Hack by Victor Valencia R.
                            if($(select).hasClass('multiselect-icon')){
                                var icon = $(this).data('icon');
                                label = '<span class="glyphicon ' + icon + '"></span> ' + label;
                            }
                            
                            selected += label + ', ';
                        });
                        return selected.substr(0, selected.length - 2) + ' <b class="caret"></b>';
                    }
                }
            },
            // Like the buttonText option to update the title of the button.
            buttonTitle: function(options, select) {
                
                if (options.length == 0) {
                    return this.nonSelectedText;
                }
                else {
                    var selected = '';
                    options.each(function () {
                        //selected += $(this).text() + ', ';
                        selected += $(this).val() + ', ';
                    });
                   
                    var field_text = selected.split(",");
                   
                    //ajax code
                    return selected.substr(0, selected.length - 2);
                }
            },
            // Is triggered on change of the selected options.
            onChange : function(option, checked) {
                    
            },
            buttonClass: 'btn',
            dropRight: false,
            selectedClass: 'active',
            buttonWidth: '100%',
            buttonContainer: '<div class="btn-group custom-btn" />',
            // Maximum height of the dropdown menu.
            // If maximum height is exceeded a scrollbar will be displayed.
            maxHeight: false,
            includeSelectAllOption: false,
            selectAllText: ' Select all',
            selectAllValue: 'multiselect-all',
            enableFiltering: false,
            enableCaseInsensitiveFiltering: false,
            filterPlaceholder: 'Search',
            // possible options: 'text', 'value', 'both'
            filterBehavior: 'text',
            preventInputChangeEvent: false,        
            nonSelectedText: 'None selected',            
            nSelectedText: 'selected'
        },
        
        // Templates.
        templates: {
            button: '<button type="button" class="multiselect dropdown-toggle form-control" data-toggle="dropdown"></button>',
            ul: '<ul class="multiselect-container dropdown-menu custom-multi"></ul>',
            filter: '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text"></div>',
            li: '<li><a href="javascript:void(0);"><label></label></a></li>',
            liGroup: '<li><label class="multiselect-group"></label></li>'
        },
        
        constructor: Multiselect,
        
        buildContainer: function() {
            this.$container = $(this.options.buttonContainer);
        },
        
        buildButton: function() {
            // Build button.
            this.$button = $(this.templates.button).addClass(this.options.buttonClass);
            
            // Adopt active state.
            if (this.$select.prop('disabled')) {
                this.disable();
            }
            else {
                this.enable();
            }
           
            // Manually add button width if set.
            if (this.options.buttonWidth) {
                this.$button.css({
                    'width' : this.options.buttonWidth
                });
            }

            // Keep the tab index from the select.
            var tabindex = this.$select.attr('tabindex');
            if (tabindex) {
                this.$button.attr('tabindex', tabindex);
            }
           
            this.$container.prepend(this.$button)
        },
        
        // Build dropdown container ul.
        buildDropdown: function() {
            
            // Build ul.
            this.$ul = $(this.templates.ul);
            
            if (this.options.dropRight) {
                this.$ul.addClass('pull-right');
            }
            
            // Set max height of dropdown menu to activate auto scrollbar.
            if (this.options.maxHeight) {
                // TODO: Add a class for this option to move the css declarations.
                this.$ul.css({
                    'max-height': this.options.maxHeight + 'px',
                    'overflow-y': 'auto',
                    'overflow-x': 'hidden'
                });
            }
            
            this.$container.append(this.$ul)
        },
        
        // Build the dropdown and bind event handling.
        buildDropdownOptions: function() {
            
            this.$select.children().each($.proxy(function(index, element) {
                // Support optgroups and options without a group simultaneously.
                var tag = $(element).prop('tagName').toLowerCase();
                if (tag == 'optgroup') {
                    this.createOptgroup(element);
                }
                else if (tag == 'option') {
                    this.createOptionValue(element);
                }
                // Other illegal tags will be ignored.
            }, this));

            // Bind the change event on the dropdown elements.
            $('li input', this.$ul).on('change', $.proxy(function(event) {
                var checked = $(event.target).prop('checked') || false;
                var isSelectAllOption = $(event.target).val() == this.options.selectAllValue;

                // Apply or unapply the configured selected class.
                if (this.options.selectedClass) {
                    if (checked) {
                        $(event.target).parents('li').addClass(this.options.selectedClass);
                    }
                    else {
                        $(event.target).parents('li').removeClass(this.options.selectedClass);
                    }
                }
                
                // Get the corresponding option.
                var value = $(event.target).val();
                var $option = this.getOptionByValue(value);

                var $optionsNotThis = $('option', this.$select).not($option);
                var $checkboxesNotThis = $('input', this.$container).not($(event.target));

                // Toggle all options if the select all option was changed.
                if (isSelectAllOption) {
                    $checkboxesNotThis.filter(function() {
                        return $(this).is(':checked') != checked;
                    }).trigger('click');
                }

                if (checked) {
                    $option.prop('selected', true);

                    if (this.options.multiple) {
                        // Simply select additional option.
                        $option.prop('selected', true);
                    }
                    else {
                        // Unselect all other options and corresponding checkboxes.
                        if (this.options.selectedClass) {
                            $($checkboxesNotThis).parents('li').removeClass(this.options.selectedClass);
                        }

                        $($checkboxesNotThis).prop('checked', false);
                        $optionsNotThis.prop('selected', false);

                        // It's a single selection, so close.
                        this.$button.click();
                    }

                    if (this.options.selectedClass == "active") {
                        $optionsNotThis.parents("a").css("outline", "");
                    }
                }
                else {
                    // Unselect option.
                    $option.prop('selected', false);
                }

                this.updateButtonText();
                this.$select.change();
                this.options.onChange($option, checked);
                
                if(this.options.preventInputChangeEvent) {
                    return false;
                }
            }, this));

            $('li a', this.$ul).on('touchstart click', function(event) {
                event.stopPropagation();
                $(event.target).blur();
            });

            // Keyboard support.
            this.$container.on('keydown', $.proxy(function(event) {
                if ($('input[type="text"]', this.$container).is(':focus')) {
                    return;
                }
                if ((event.keyCode == 9 || event.keyCode == 27) && this.$container.hasClass('open')) {
                    // Close on tab or escape.
                    this.$button.click();
                }
                else {
                    var $items = $(this.$container).find("li:not(.divider):visible a");

                    if (!$items.length) {
                        return;
                    }

                    var index = $items.index($items.filter(':focus'));

                    // Navigation up.
                    if (event.keyCode == 38 && index > 0) {
                        index--;
                    }
                    // Navigate down.
                    else if (event.keyCode == 40 && index < $items.length - 1) {
                        index++;
                    }
                    else if (!~index) {
                        index = 0;
                    }

                    var $current = $items.eq(index);
                    $current.focus();

                    if (event.keyCode == 32 || event.keyCode == 13) {
                        var $checkbox = $current.find('input');

                        $checkbox.prop("checked", !$checkbox.prop("checked"));
                        $checkbox.change();
                    }

                    event.stopPropagation();
                    event.preventDefault();
                }
            }, this));
        },
        
        // Will build an dropdown element for the given option.
        createOptionValue: function(element) {
            if ($(element).is(':selected')) {
                $(element).prop('selected', true);
            }

            // Support the label attribute on options.
            var label = $(element).attr('label') || $(element).html();            
            var value = $(element).val();
                        
            //Hack by Victor Valencia R.            
            if($(element).parent().hasClass('multiselect-icon') || $(element).parent().parent().hasClass('multiselect-icon')){                                
                var icon = $(element).data('icon');
                label = '<span class="glyphicon ' + icon + '"></span> ' + label;
            } 
            
            var inputType = this.options.multiple ? "checkbox" : "radio";

            var $li = $(this.templates.li);
            $('label', $li).addClass(inputType);
            $('label', $li).append('<input type="' + inputType + '" />');
            
            //Hack by Victor Valencia R.
            if(($(element).parent().hasClass('multiselect-icon') || $(element).parent().parent().hasClass('multiselect-icon')) && inputType == 'radio'){                
                $('label', $li).css('padding-left', '0px');
                $('label', $li).find('input').css('display', 'none');
            }

            var selected = $(element).prop('selected') || false;
            var $checkbox = $('input', $li);
            $checkbox.val(value);

            if (value == this.options.selectAllValue) {
                $checkbox.parent().parent().addClass('multiselect-all');
            }

            $('label', $li).append(" " + label);

            this.$ul.append($li);

            if ($(element).is(':disabled')) {
                $checkbox.attr('disabled', 'disabled').prop('disabled', true).parents('li').addClass('disabled');
            }

            $checkbox.prop('checked', selected);

            if (selected && this.options.selectedClass) {
                $checkbox.parents('li').addClass(this.options.selectedClass);
            }
        },

        // Create optgroup.
        createOptgroup: function(group) {
            var groupName = $(group).prop('label');

            // Add a header for the group.
            var $li = $(this.templates.liGroup);
            $('label', $li).text(groupName);
            
            //Hack by Victor Valencia R.
            $li.addClass('text-primary');
            
            this.$ul.append($li);
            
            // Add the options of the group.
            $('option', group).each($.proxy(function(index, element) {                
                this.createOptionValue(element);
            }, this));
        },
        
        // Add the select all option to the select.
        buildSelectAll: function() {
            var alreadyHasSelectAll = this.$select[0][0] ? this.$select[0][0].value == this.options.selectAllValue : false;
            // If options.includeSelectAllOption === true, add the include all checkbox.
            if (this.options.includeSelectAllOption && this.options.multiple && !alreadyHasSelectAll) {
                this.$select.prepend('<option value="' + this.options.selectAllValue + '">' + this.options.selectAllText + '</option>');
            }
        },
        
        // Build and bind filter.
        buildFilter: function() {
            
            // Build filter if filtering OR case insensitive filtering is enabled and the number of options exceeds (or equals) enableFilterLength.
            if (this.options.enableFiltering || this.options.enableCaseInsensitiveFiltering) {
                var enableFilterLength = Math.max(this.options.enableFiltering, this.options.enableCaseInsensitiveFiltering);
                if (this.$select.find('option').length >= enableFilterLength) {
                    
                    this.$filter = $(this.templates.filter);
                    $('input', this.$filter).attr('placeholder', this.options.filterPlaceholder);
                    this.$ul.prepend(this.$filter);

                    this.$filter.val(this.query).on('click', function(event) {
                        event.stopPropagation();
                    }).on('keydown', $.proxy(function(event) {
                        // This is useful to catch "keydown" events after the browser has updated the control.
                        clearTimeout(this.searchTimeout);

                        this.searchTimeout = this.asyncFunction($.proxy(function() {

                            if (this.query != event.target.value) {
                                this.query = event.target.value;

                                $.each($('li', this.$ul), $.proxy(function(index, element) {
                                    var value = $('input', element).val();
                                    if (value != this.options.selectAllValue) {
                                        var text = $('label', element).text();
                                        var value = $('input', element).val();
                                        if (value && text && value != this.options.selectAllValue) {
                                            // by default lets assume that element is not
                                            // interesting for this search
                                            var showElement = false;

                                            var filterCandidate = '';
                                            if ((this.options.filterBehavior == 'text' || this.options.filterBehavior == 'both')) {
                                                filterCandidate = text;
                                            }
                                            if ((this.options.filterBehavior == 'value' || this.options.filterBehavior == 'both')) {
                                                filterCandidate = value;
                                            }

                                            if (this.options.enableCaseInsensitiveFiltering && filterCandidate.toLowerCase().indexOf(this.query.toLowerCase()) > -1) {
                                                showElement = true;
                                            }
                                            else if (filterCandidate.indexOf(this.query) > -1) {
                                                showElement = true;
                                            }

                                            if (showElement) {
                                                $(element).show();
                                            }
                                            else {
                                                $(element).hide();
                                            }
                                        }
                                    }
                                }, this));
                            }
                        }, this), 300, this);
                    }, this));
                }
            }
        },

        // Destroy - unbind - the plugin.
        destroy: function() {
            this.$container.remove();
            this.$select.show();
        },

        // Refreshs the checked options based on the current state of the select.
        refresh: function() {
            $('option', this.$select).each($.proxy(function(index, element) {
                var $input = $('li input', this.$ul).filter(function() {
                    return $(this).val() == $(element).val();
                });

                if ($(element).is(':selected')) {
                    $input.prop('checked', true);

                    if (this.options.selectedClass) {
                        $input.parents('li').addClass(this.options.selectedClass);
                    }
                }
                else {
                    $input.prop('checked', false);

                    if (this.options.selectedClass) {
                        $input.parents('li').removeClass(this.options.selectedClass);
                    }
                }

                if ($(element).is(":disabled")) {
                    $input.attr('disabled', 'disabled').prop('disabled', true).parents('li').addClass('disabled');
                }
                else {
                    $input.prop('disabled', false).parents('li').removeClass('disabled');
                }
            }, this));

            this.updateButtonText();
        },

        // Select an option by its value or multiple options using an array of values.
        select: function(selectValues) {
            if(selectValues && !$.isArray(selectValues)) {
                selectValues = [selectValues];
            }
            
            for (var i = 0; i < selectValues.length; i++) {
                
                var value = selectValues[i];
                
                var $option = this.getOptionByValue(value);
                var $checkbox = this.getInputByValue(value);

                if (this.options.selectedClass) {
                    $checkbox.parents('li').addClass(this.options.selectedClass);
                }

                $checkbox.prop('checked', true);
                $option.prop('selected', true);                
                this.options.onChange($option, true);
            }

            this.updateButtonText();
        },

        // Deselect an option by its value or using an array of values.
        deselect: function(deselectValues) {
            if(deselectValues && !$.isArray(deselectValues)) {
                deselectValues = [deselectValues];
            }

            for (var i = 0; i < deselectValues.length; i++) {
                
                var value = deselectValues[i];
                
                var $option = this.getOptionByValue(value);
                var $checkbox = this.getInputByValue(value);

                if (this.options.selectedClass) {
                    $checkbox.parents('li').removeClass(this.options.selectedClass);
                }

                $checkbox.prop('checked', false);
                $option.prop('selected', false);               
                this.options.onChange($option, false);
            }

            this.updateButtonText();
        },

        // Rebuild the whole dropdown menu.
        rebuild: function() {
            this.$ul.html('');
            
            // Remove select all option in select.
            $('option[value="' + this.options.selectAllValue + '"]', this.$select).remove();
            
            // Important to distinguish between radios and checkboxes.
            this.options.multiple = this.$select.attr('multiple') == "multiple";
            
            this.buildSelectAll();
            this.buildDropdownOptions();
            this.updateButtonText();
            this.buildFilter();
        },
        
        // Build select using the given data as options.
        dataprovider: function(dataprovider) {
            var optionDOM = "";
            dataprovider.forEach(function (option) {
                optionDOM += '<option value="' + option.value + '">' + option.label + '</option>';
            });

            this.$select.html(optionDOM);
            this.rebuild();
        },

        // Enable button.
        enable: function() {
            this.$select.prop('disabled', false);
            this.$button.prop('disabled', false)
                .removeClass('disabled');
        },

        // Disable button.
        disable: function() {
            this.$select.prop('disabled', true);
            this.$button.prop('disabled', true)
                .addClass('disabled');
        },

        // Set options.
        setOptions: function(options) {
            this.options = this.mergeOptions(options);
        },

        // Get options by merging defaults and given options.
        mergeOptions: function(options) {
            return $.extend({}, this.defaults, options);
        },
        
        // Update button text and button title.
        updateButtonText: function() {
            var options = this.getSelected();
           
            // First update the displayed button text.
            $('button', this.$container).html(this.options.buttonText(options, this.$select));            
            
            // Now update the title attribute of the button.
            $('button', this.$container).attr('title', this.options.buttonTitle(options, this.$select));
            
        },

        // Get all selected options.
        getSelected: function() {
           
            return $('option[value!="' + this.options.selectAllValue + '"]:selected', this.$select).filter(function() {
                return $(this).prop('selected');
            });
        },
        
        // Get the corresponding option by ts value.
        getOptionByValue: function(value) {
            return $('option', this.$select).filter(function() {
                return $(this).val() == value;
            });
        },
        
        // Get an input in the dropdown by its value.
        getInputByValue: function(value) {
            return $('li input', this.$ul).filter(function() {
                return $(this).val() == value;
            });
        },
        
        updateOriginalOptions: function() {
            this.originalOptions = this.$select.clone()[0].options;
        },

        asyncFunction: function(callback, timeout, self) {
            var args = Array.prototype.slice.call(arguments, 3);
            return setTimeout(function() {
                callback.apply(self || window, args);
            }, timeout);
        }
    };

    $.fn.multiselect = function(option, parameter) {
        return this.each(function() {
            var data = $(this).data('multiselect'), options = typeof option == 'object' && option;

            // Initialize the multiselect.
            if (!data) {
                $(this).data('multiselect', ( data = new Multiselect(this, options)));
            }

            // Call multiselect method.
            if ( typeof option == 'string') {
                data[option](parameter);
            }
        });
    };

    $.fn.multiselect.Constructor = Multiselect;
    
    // Automatically init selects by their data-role.
    $(function() {
        $("select[role='multiselect']").multiselect();
    });

}(window.jQuery);


	
	
	</script>

