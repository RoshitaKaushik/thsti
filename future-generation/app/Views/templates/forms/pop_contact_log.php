<?php 
$access = getAccess(9); //3 for donation/payments
$NameID = isset($studentid) ? $studentid :'';


	$attr = array('class' => 'cmxform form-horizontal tasi-form research','id'=>'');
	echo form_open_multipart('admin/form/submitApplication', $attr); 
	?>
<style>
	.tbl-body-contactlog tr td:first-child {
    width: 8%;
}
.tbl-body-contactlog tr td:nth-child(2){
	width:12%
}
.tbl-body-contactlog tr td:nth-child(3){
	width:66%
}
.tbl-body-contactlog tr td:nth-child(4){
	width:8%;
}
.tbl-body-contactlog tr td:nth-child(5){
	width:6%;
}
</style>
<table class="table table-striped table-bordered" width="100%">
	<thead>
		<tr>
			
			<th>Contact Date</th>
			<th>Contact Type</th>
			<th>Contact Note</th>
			<th>Added By</th>
			<th>Action </th>												
		</tr>
	</thead>
	<tbody class="tbl-body-contactlog"> 
	<?php  
		$ref_count = 0; 							
		$ref=getContactLogInfo(isset($NameID) ? $NameID : 0);
		if(!empty($ref)){
		$ref_count = 0;
		echo '<input type= "hidden" id="count7" value="'.(count($ref)+1).'" >';
		foreach($ref as $user){
		$ref_count++;
		?>
		<tr id="TextBoxDivCL<?php echo $ref_count; ?>">
			<td>
				<input type="hidden" name="NameID[<?=$ref_count;?>]" id="NameID<?=$ref_count;?>" value="<?php if(isset($user['NameID'])){ echo $user['NameID'];}?>">
				<input type="hidden" name="clogid[<?=$ref_count;?>]" id="clogid<?=$ref_count;?>" value="<?php if(isset($user['clogid'])){ echo $user['clogid'];}?>">
				<span class="show">
				  <?php if(isset($user['ContactDate'])){ echo convertDateString($user['ContactDate']); }?>
				</span>
				<input class="form-control datepicker hide" id="contact_date<?=$ref_count;?>" name="contact_date[<?=$ref_count;?>]" type="text" value="<?php if(isset($post['contact_date'])){ echo $post['contact_date'];}
					else if(isset($user['ContactDate'])){ echo convertDateString($user['ContactDate']);}?>" required>
			</td>
			<td>
			<span class="show">
					<?php
					if(isset($user['ContactType'])){
					    $user['ContactType'];
						$results = getContactType($user['ContactType']);
						if(!empty($results)){
							$contact_type = $results['ContactType'];
						    echo $contact_type;
						}
					}
					?>
				</span>
			<select name="contact_type[<?php echo $ref_count;?>]" id="contact_type<?php echo $ref_count;?>" class="form-control contact_type hide">
				<option value="">Select</option>
				<?php 
				foreach($contacttype as $row){
				  $flag=($row['cid']==$user['ContactType'] ? 'selected="selected"':'');
					
					?>
				<option value="<?php echo $row['cid'];?>" <?php echo $flag;?>><?php echo $row['ContactType'];?></option>
				<?php }?>
				</select>
			</td>
			<td>
			<textarea rows="1" class="form-control show" readonly><?php if(isset($user['ContactNote'])){ echo $user['ContactNote']; }?></textarea>
				
				<textarea name="contact_note[<?php echo $ref_count;?>]" id="contact_note<?php echo $ref_count;?>" class="form-control contact_note hide" rows="1" required><?php if(isset($user['ContactNote'])){ echo $user['ContactNote'];}?></textarea>
			</td>
			<td>
			 <span class="show"><?php if(isset($user['created_by'])){  
					$users = getLoggedInUserName($user['created_by']);
					echo $user_name=$users['admin_fullname'];
					}?>
			 </span>
			 <input type="text" name="login_user<?php echo $ref_count;?>" name="login_user[<?php echo $ref_count;?>]" value="<?php if(isset($user['created_by'])){  
					$users = getLoggedInUserName($user['created_by']);
					echo $user_name=$users['admin_fullname'];
			  }?>" class="form-control hide login_user" readonly>
			 
			 
			 
			</td>
			<td style="width:12%;text-align:center; vertical-align:middle;">
				<?php if($access['edit_access']) { ?>
				<a href="javascript:void(0)" id="edit-contactlog<?php echo $ref_count;?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-contactlog show pull-left" data-id="<?=$user['NameID']?>" data-row="<?=$ref_count?>" style="text-align:center;">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				        
				</a>
				<?php } if(session()->get('role') == 1) {?>
				<a href="javascript:void(0);" title="Click To Delete" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 rmvc" data-row="<?php echo $ref_count?>" data-urlm="<?=encryptor('encrypt', $user['clogid'])?>" data-urln="<?=encryptor('encrypt', $user['NameID'])?>">
					<span class="fa fa-trash-o" aria-hidden="true"></span>
					<span><strong></strong></span>            
				</a>
				
				<?php }?>
				
				<a href="javascript:void(0)"  id="save-contactlog<?php echo $ref_count;?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-contactlog hide pull-left save<?=$ref_count;?>" data-id="<?=$user['NameID']?>"  data-row="<?=$ref_count?>">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				            
				</a>
				<a href="javascript:void(0)" id="cancel-contactlog<?php echo $ref_count;?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-contactlog hide pull-left" data-id="<?=$user['NameID']?>" data-row="<?=$ref_count?>">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				          
				</a>
			</td>
		</tr>
		
		<?php }} ?>
		<?php if($access['add_access']) { ?>
		<tr id="TextBoxDivCL<?php echo $ref_count+1; ?>">
			<td>
			<input type="hidden" id="count7" value="2" >
			<input type="hidden" name="NameID[<?=$ref_count+1;?>]" id="NameID<?=$ref_count+1;?>" value="<?php if(isset($NameID)){ echo $NameID;}?>">
			<input type="hidden" name="clogid[<?=$ref_count+1;?>]" id="clogid<?=$ref_count+1;?>" value="">
			<span class="hide">
			</span>
			<input class="form-control datepicker" id="contact_date<?php echo $ref_count+1;?>" name="contact_date[<?php echo $ref_count+1;?>]" type="text" required>
			</td>
			<td>
			<span class="hide"></span>
			
			<select name="contact_type[<?php echo $ref_count+1;?>]" id="contact_type<?php echo $ref_count+1;?>" class="form-control contact_type">
				<option value="">Select</option>
				<?php foreach($contacttype as $rec){?>
					<option value="<?php echo $rec['cid'];?>"><?php echo $rec['ContactType'];?></option>
				<?php }?>
				</select>
			</td>
			<td>
				<textarea class="form-control hide" rows="1" readonly></textarea>
				<textarea name="contact_note[<?php echo $ref_count+1;?>]" id="contact_note<?php echo $ref_count+1;?>" class="form-control contact_note" rows="1" required></textarea>
			</td>
			<td>
				<span class="hide"></span>
				<input type="text" class="form-control login_user" name="login_user<?php echo $ref_count+1;?>" id="login_user<?php echo $ref_count+1;?>" value="<?php echo session()->get('admin_fullname');?>" readonly>
			</td>
			<td  style="vertical-align:middle">
			    <?php if($access['edit_access']) { ?>
				<!--<input type="submit" name="sub" value="save">-->
				<a href="javascript:void(0)" id="edit-contactlog<?php echo $ref_count+1;?>"class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-contactlog hide pull-left" data-id="<?=$studentid?>" data-row="<?=$ref_count+1?>" style="text-align:center;">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				         
				</a>
				<?php } ?>
				
				
				<?php if($access['add_access']) { ?>
				<a href="javascript:void(0)" id="add-contactlog<?=$ref_count+1?>" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-contactlog">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					          
				</a>
				
				<a href="javascript:void(0)" id="save-contactlog<?=$ref_count+1?>"  class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-contactlog hide pull-left save<?=$ref_count+1;?>" data-id="<?=$studentid?>" data-row="<?=$ref_count+1?>">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				           
				</a>
				<?php } ?>
			
			   <a href="javascript:void(0)"  id="cancel-contactlog<?php echo $ref_count+1?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-contactlog hide pull-left"  data-row="<?php echo $ref_count+1?>">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				          
				</a>
			</td>
		</tr>
		<?php 	}
		$count7 = $ref_count == 0 ? 1 : $ref_count;
		?>
	</tbody>
</table>
	<!-- <button type="submit" class="btn btn-success center-block">Save</button> -->
	
	<?php echo form_close();?> 