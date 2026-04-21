<?php 
$access = getAccess(11); // 11 for employment record.
$NameID = isset($studentid) ? $studentid :'';
$studentrec_js = json_encode($employmentrecord);
?>
<style>
.tbl-body-employmentrecord tr td:first-child {
    width: 30%;
}
.tbl-body-employmentrecord tr td:nth-child(2){
	width:30%
}
.tbl-body-employmentrecord tr td:nth-child(3){
	width:15%
}
.tbl-body-employmentrecord tr td:nth-child(4){
	width:15%;
}
.tbl-body-employmentrecord tr td:last-child {
    width: 5%;
}
#error-message{color:red;text-align: right;font-size: 12px;}
.btn {
    padding: 1px 3px;
 }
</style>
<div id="error-message"></div>
<table class="table table-striped table-bordered" width="100%" id="table_em">
	<thead>
		<tr>
			<th>Attachment Name<span style="color:red">*</span></th>
			<th>Upload Attachment<span style="color:red">*</span></th>
			<th>Added By<span style="color:red">*</span></th>
			<th>Added Date<span style="color:red">*</span></th>
			<th>Action </th>												
		</tr>
	</thead>
		<tbody class="tbl-body-employmentrecord"> 
	<?php  
		$ref_count = 0; 							
		$ref=getEmploymentInfos(isset($NameID) ? $NameID : 0);
		
	?>
	<?php if($access['add_access']) {
			$ref_countssss = $ref_count+1;
			$attr = array('class' => 'cmxform form-horizontal tasi-form research','id'=>'empattachmentupload');
		?>
		<tr id="TextBoxDivEM<?php echo $ref_count+1; ?>">
			<?php echo form_open_multipart('admin/form/submitsuteApplication', $attr); ?>
			<td>			
				<input type="hidden" name="NameID_em" id="NameID_em" value="<?php if(isset($NameID)){ echo $NameID;}?>">
				<input type="hidden" name="id_em" id="id_em" value="">
				<input class="form-control " id="attachment_name_em" name="attachment_name_em" type="text" required>
			</td>
			<td>
				<span class="hide"></span>
				<input class="uploadfiles pdf" id="upload_attachment_em" name="upload_attachment_em" type="file" <?php //echo($required==1 ? 'required':'');?>>
				<input type="hidden" name="docreq" value="1">
			</td>
			<td>
				<input class="form-control " id="added_by_em" value="<?php echo session()->get('admin_fullname');?>" name="added_by_em" type="text" readonly required>
			</td>
			<td>
				<input class="form-control datepicker" id="added_date_em" value="<?php $estTime = (new DateTime('America/New_York'))->format('d/m/Y h:i:s'); echo $estTime; ?>" name="added_date_em" type="text" readonly required>
			</td>
			<td  style="vertical-align:middle">
				<?php if($access['add_access']) { ?>
					<a href="javascript:void(0)" id="add-employmentrecord<?=$ref_count+1?>" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-employment">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								  
					</a>
					
					<a href="javascript:void(0)" id="save-employmentrecord<?=$ref_count+1?>"  class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-employmentrecord hide pull-left save<?=$ref_count+1;?>" data-id="<?=$studentid?>" data-row="<?=$ref_count+1?>">
					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							   
					</a>
				<?php } ?>
			
			   <a href="javascript:void(0)"  id="cancel-employmentrecord<?php echo $ref_count+1?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-employmentrecord hide pull-left"  data-row="<?php echo $ref_count+1?>">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				          
				</a>
			</td>
			</form>
		</tr>
		<?php 	}
		$count7 = $ref_count == 0 ? 1 : $ref_count;
		?>
	<?php
		if(!empty($ref)){
		$ref_count = 0;
		echo '<input type= "hidden" id="count7" value="'.(count($ref)+1).'" >';
		foreach($ref as $user){
			
			//echo '<pre>'; print_r($user);
		$ref_count++;
		?>
		<tr id="TextBoxDivEM<?php echo $ref_count+1; ?>">
			<td style="text-align:left;">
				<span class="show">
				  <?php if(isset($user['attachment_name'])){ echo $user['attachment_name']; }?>
				</span>
				
			</td>
			
			<td>
			 <span class="show"><?php if(isset($user['attachment_path']) && !empty($user['attachment_path'])){ ?>
				<a href="<?=base_url($user['attachment_path'])?>" target="_blank" class="btn btn-info btn-xs">View Document</a>
			 <?php  }?>
			 </span>
			</td>
			
			<td>
			 <span class="show"><?php if(isset($user['created_by'])){  
					$users = getLoggedInUserName($user['created_by']);
					echo $user_name=$users['admin_fullname'];
					}?>
			 </span>			 			 			 
			</td>
			<td>
				<span class="show">
				  <?php if(isset($user['created_date'])){ echo date('m/d/Y H:i',strtotime($user['created_date'])); }?>
				</span>
			</td>
			<td style="width:12%;text-align:center; vertical-align:middle;">
				<?php //if($access['edit_access']) { ?>
				<!--<a href="javascript:void(0)" id="edit-studentrecord<?php //echo $ref_count+1;?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-studentrecord " data-id="<?php //echo $user['student_id']?>" data-row="<?php //echo $ref_count+1?>" style="text-align:center;">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				        
				</a>-->
				<?php /*}*/ if(session()->get('role') == 1) {?>
				<a href="javascript:void(0);" title="Click To Delete" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 rmvetd" data-row="<?php echo $ref_count+1 ?>" data-urlm="<?=encryptor('encrypt', $user['id'])?>" data-urln="<?=encryptor('encrypt', $user['student_id'])?>">
					<span class="fa fa-trash-o" aria-hidden="true"></span>
					<span><strong></strong></span>            
				</a>
				
				<?php }?>
				
				<!--<a href="javascript:void(0)"  id="save-studentrecord<?php //echo $ref_count+1;?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-studentrecord hide pull-left save<? //=$ref_count;?>" data-id="<? //=$user['NameID']?>"  data-row="<? //=$ref_count?>">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				            
				</a>
				<a href="javascript:void(0)" id="cancel-studentrecord<?php //echo $ref_count+1;?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-studentrecord hide pull-left" data-id="<?php //echo $user['student_id']?>" data-row="<?php //echo $ref_count+1?>">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				          
				</a>-->
			</td>
		</tr>
		
		<?php }} ?>
		
	</tbody>
</table>
</table>
	<!-- <button type="submit" class="btn btn-success center-block">Save</button> -->
	
	<?php echo form_close();?> 