<?php 
$access = getAccess(8); //2 for transcript

$studentid = isset($studentid) ? $studentid:'';



//print_r($trans)		;								
$attr = array('class' => 'cmxform form-horizontal tasi-form research','id'=>'');
echo form_open_multipart('admin/form/submitApplication', $attr); 


?>
<table class="table table-striped table-bordered">
		<thead>
			<tr>
				
			    <th width="10%">Certificate No <span class="requires">*</span></th>
				<th width="10%">CertificateName<span class="requires">*</span></th>
				<th width="10%">Course Dates<span class="requires">*</span></th>
				<th width="20%">Professor<span class="requires">*</span></th>
				<th width="25%">Level</th>                                     
				<th width="20%">Diploma</th>
				<th width="10%">Grade</th>	
				<th>Completed</th>
				<th width="20%"> Action</th>												
			</tr>
		</thead>
		<tbody class="tbl-body-certificate">
		<?php  
		    
			$ref_count = 0; 	
            	
			$ref=getCertificateListing($studentid);
           // echo "<pre>";print_r($ref);

			if(!empty($ref)){
			$ref_count = 0;
			echo '<input type= "hidden" id="count7" value="'.(count($ref)+1).'" >';
			foreach($ref as $trans){
			$ref_count++;
			
			?>
			<tr id="TextBoxDivCS<?php echo $ref_count;?>">
				 <td>
					<span class="show"><?php if(isset($trans['certID'])){ echo $trans['certificate_no'];}?></span>
					<select name="certID[<?php echo $ref_count?>]" id="certID<?php echo $ref_count?>" class="form-control hide certID">
						<option value="">Select Certificate No <?php echo $studentid;?></option>
						<?php if(isset($certificate)){
							foreach($certificate as $rows){
							 $certificate_id = $rows['certID'];
							 $certificate_no = $rows['cert_no'];
							 $flag=($trans['certID']==$rows['certID'] ? 'selected="selected"':'');

						?>
						<option value="<?php echo $certificate_id;?>" <?php echo $flag;?>><?php echo $certificate_no;?></option>
						<?php } }?>
					</select>
				</td>
				<td>
					<input type="hidden" name="studentid<?=$ref_count?>" id="studentid<?=$ref_count?>" value="<?php if(isset($trans['studentID'])){ echo $trans['studentID'];}?>">
					<input type="hidden" name="ctID<?php echo $ref_count;?>" id="ctID<?php echo $ref_count; ?>" value="<?php if(isset($trans['ctID'])){ echo $trans['ctID'];}?>">
					<span class="show"><?php if(isset($trans['certificate_name'])){ echo $trans['certificate_name'];}?></span>
					<textarea name="Certtificate_Name[<?php echo $ref_count+1;?>]" id="Certtificate_Name<?php echo $ref_count;?>" class="form-control certificate_name hide" readonly><?php if(isset($trans['certificate_name'])){ echo $trans['certificate_name'];}?></textarea>
				
				</td>
				<td>
					<span class="show"><?php if(isset($trans['course_date'])){ echo $trans['course_date'];}?></span>
					<textarea name="course_date_val[<?php echo $ref_count?>]" id="course_date_val<?php echo $ref_count;?>" class="form-control hide course_date_val textarea" readonly><?php if(isset($trans['course_date'])){ echo $trans['course_date'];}?></textarea>
				</td>
				
				<td>
					<span class="show"><?php if(isset($trans['professor'])){ echo $trans['professor'];}?></span>
					<textarea name="certificate_professor[<?php echo $ref_count;?>]" id="certificate_professor<?php echo $ref_count;?>" class="form-control hide certificate_professor textarea" readonly><?php if(isset($trans['professor'])){ echo $trans['professor'];}?></textarea>
				</td>
				
				<td>
					<span class="show"><?php if(isset($trans['grad_undergrad'])){ $grade_value = $trans['grad_undergrad']; if($grade_value=='G') { echo 'Graduate';}else if($grade_value=='U') { echo 'Undergraduate';} else if($grade_value=='E') { echo 'Continuing Education';}}?></span>
					<textarea name="grad_undergrad[<?php echo $ref_count?>]" id="grad_undergrad<?php echo $ref_count;?>" class="form-control hide grad_undergrad" readonly><?php if(isset($trans['grad_undergrad'])){ $grade_value = $trans['grad_undergrad']; echo($grade_value=='G' ? 'Graduate':'Undergradute');}?></textarea>
				</td>
				<td>
					<span class="show"><?php if(isset($trans['diploma'])){ echo $trans['diploma'];}?></span>
					<textarea name="certificate_diploma[<?php echo $ref_count;?>]" id="certificate_diploma<?php echo $ref_count;?>" class="form-control hide textarea certificate_diploma" readonly><?php if(isset($trans['diploma'])){ echo $trans['diploma'];}?></textarea>
				</td>
				<td>
					<span class="show"><?php if(isset($trans['grade'])){ echo $trans['grade'];}?></span>
					 <select name="certificate_grade[<?php echo $ref_count;?>]" id="certificate_grade<?php echo $ref_count;?>" class="form-control hide certificate_grade">
						<option value="">Select Grade</option>
						<?php
						if(isset($grades)){
							foreach($grades as $rec){
							$grade_id = $rec['ROWID'];
							$grade_name = $rec['Grade'];
							$flags=($trans['grade']==$grade_name ? 'selected="selected"':'');
							?>
							<option value="<?php echo $grade_name;?>" <?php echo $flags;?>><?php echo $grade_name;?></option>
						<?php } }?>
						
					 </select>
				</td>
				
				
				<td>
					<span class="show"><?php if(isset($trans['completed'])){ echo $trans['completed'];}?></span>
					 <select name="completed[<?php echo $ref_count;?>]" id="completed<?php echo $ref_count;?>" class="form-control hide completed">
						<option value="">Select Grade</option>
						
						<option <?php if($trans['completed'] =='Yes'){ echo 'selected'; } ?> value="Yes">Yes</option>
						<option <?php if($trans['completed'] =='No'){ echo 'selected'; } ?> value="No">No</option>
						
					 </select>
				</td>
				
				<td style="width:6%;">
					<?php if($access['edit_access']) { ?>
					<a href="javascript:void(0)" id="edit-certificate<?php echo $ref_count;?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-certificate show pull-left" data-id="<?=$trans['studentID']?>" data-row="<?=$ref_count?>" style="text-align:center;">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					<span><strong></strong></span>            
					</a>
					<?php } 
					if(session()->get('role') == 1) { ?>
					<a href="javascript:void(0);" title="Click To Delete" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 certificate_rmv" data-row="<?php echo $ref_count;?>" data-row_no="<?php echo $ref_count;?>" data-urlc="<?php echo encryptor('encrypt',$trans['ctID']);?>" data-urls="<?=encryptor('encrypt', $trans['studentID'])?>">
					<span class="fa fa-trash-o" aria-hidden="true"></span>
					<span><strong></strong></span>            
					</a>
					<?php }  ?>
					<a href="javascript:void(0)" id="save-certificate<?php echo $ref_count;?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-certificate hide pull-left" data-id="<?=$trans['studentID']?>" data-row="<?=$ref_count?>">
					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					<span><strong></strong></span>            
					</a>
					
					<a href="javascript:void(0)" id="cancel-certificate<?php echo $ref_count;?>"  class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-certificate hide pull-left" data-id="<?=$trans['studentID']?>" data-row="<?=$ref_count?>">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					<span><strong></strong></span>            
					</a>
				</td>
			</tr>
			<?php }} ?>
			  <?php if($access['add_access']) { ?>
			  <tr id="TextBoxDivCS<?php echo $ref_count+1;?>">
					<td>
						<input type="hidden" name="studentid<?=$ref_count+1?>" id="studentid<?=$ref_count+1?>" value="<?php if(isset($studentid)){ echo $studentid;}?>">
						<input type="hidden" name="ctID<?php echo $ref_count+1;?>" id="ctID<?php echo $ref_count+1; ?>" value="">
						<span class="hide"></span>
						<select name="certID[<?php echo $ref_count+1?>]" id="certID<?php echo $ref_count+1?>" class="form-control certID">
						<option value="">Select Certificate No</option>
						<?php if(isset($certificate)){
							foreach($certificate as $rows){
							 $certificate_id = $rows['certID'];
							 $certificate_no = $rows['cert_no'];
						?>
						<option value="<?php echo $certificate_id;?>"><?php echo $certificate_no;?></option>
						<?php } }?>
						</select>
					</td>
				
				
					<td>
						<span class="hide"></span>
						<textarea name="Certtificate_Name[<?php echo $ref_count+1;?>]" id="Certtificate_Name<?php echo $ref_count+1;?>" class="form-control certificate_name" readonly></textarea>
						
						
					</td>
					<td> <input type="hidden" id="count7" value="2">
						<span class="hide"></span>
						<textarea name="course_date_val[<?php echo $ref_count+1;?>]" id="course_date_val<?php echo $ref_count+1;?>" class="form-control course_date_val textarea" readonly></textarea>
					</td>
					<td>
						<span class="hide"></span>
						<textarea name="certificate_professor[<?php echo $ref_count+1;?>]" id="certificate_professor<?php echo $ref_count+1;?>" class="form-control certificate_professor textarea" readonly></textarea>
					</td>
					
					<td>
						<span class="hide"></span>
						<textarea name="grad_undergrad[<?php echo $ref_count+1;?>]" id="grad_undergrad<?php echo $ref_count+1;?>" class="form-control grad_undergrad" readonly></textarea>
					</td>
					
					<td>
						<span class="hide"></span>
						<textarea name="certificate_diploma[<?php echo $ref_count+1;?>]" id="certificate_diploma<?php echo $ref_count+1;?>" class="form-control textarea certificate_diploma" readonly></textarea>
					</td>
					
					<td>
						<span class="hide"></span>
						<select name="certificate_grade[<?php echo $ref_count+1;?>]" id="certificate_grade<?php echo $ref_count+1;?>">
						<option value="">Select Grade</option>
						<?php
						if(isset($grades)){
							
							foreach($grades as $rec){
							$grade_id = $rec['ROWID'];
							$grade_name = $rec['Grade'];
							?>
							<option value="<?php echo $rec['Grade'];?>"><?php echo $rec['Grade'];?></option>
						<?php } }?>
						
						</select>
					</td>
					
					<td>
					    <span class="hide"></span>
					    <select name="completed[<?php echo $ref_count+1;?>]" id="completed<?php echo $ref_count+1;?>">
					        <option value=''>Please select</option>
					        <option value="Yes">Yes</option>
					        <option value="No">No</option>
					    </select>
					</td>
				
				<td>
				<?php if($access['edit_access']) { ?>	
				
				<a href="javascript:void(0)" id="edit-certificate<?=$ref_count+1?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-certificate hide pull-left" data-id="<?=$studentid?>" data-row="<?=$ref_count+1?>" style="text-align:center;">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				<span><strong></strong></span>            
				</a>
				
				<?php } ?>
				
				
				<?php if($access['add_access']) { ?>
				<a href="javascript:void(0)" id="add-certificate<?=$ref_count+1?>" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-certificate">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					<span><strong></strong></span>            
				</a>
				
				
				<a href="javascript:void(0)" id="save-certificate<?=$ref_count+1?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-certificate hide pull-left" data-id="<?=$studentid?>" data-row="<?=$ref_count+1?>">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<span><strong></strong></span>            
				</a>
				<?php } ?>
				
				<a href="javascript:void(0)" id="cancel-certificate<?php echo $ref_count+1;?>"  class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-certificate hide pull-left" data-id="<?php echo $studentid;?>" data-row="<?=$ref_count+1?>">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					<span><strong></strong></span>            
				</a>
				</td>
			</tr>
			<?php 
			}
			$count7 = $ref_count == 0 ? 1 : $ref_count;
			?>
		</tbody>
	</table>
			<!-- <button type="submit" class="btn btn-success center-block">Save</button>	-->								
<?php echo form_close();?> 

<style type="text/css">
.textarea{
	margin: 0px 11.25px 0px 0px;
    width: 173px;
    height: 44px;
}
.professor{
	margin: 0px 12.0117px 0px 0px;
    height: 44px;
    width: 145px;
}
.grade{
	padding-left: 0px;
    width: 68px;
}
.course{
	padding-left: 0px;
}
.term{
	padding-left:0px;
}
.studentClass{
	padding-left:0px;
}
 #overlay { 
position: fixed; 
z-index: 5000; 
left: 0; 
top: 0; 
bottom: 0; 
right: 0; 
background: #000; 
opacity: 0.8; 
filter: alpha(opacity=80); 
} 
#loading { 
width: 50px; 
height: 57px; 
position: absolute; 
top: 50%; 
left: 50%; 
margin: -28px 0 0 -25px; 
} 
#overlay > p{ 
color:#FF9800; 
position: absolute; 
top: 60%; 
left: 49%; 
margin: -28px 0 0 -25px;} 


</style>