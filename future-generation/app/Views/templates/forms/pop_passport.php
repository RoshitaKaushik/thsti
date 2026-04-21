<?php 
$access = getAccess(5); //5 for passport

$studentid = isset($studentid) ? $studentid :'';
$countrylist = isset($country[0]) ? $country[0]:array();

$country_js = json_encode($country);

$attr = array('class' => 'cmxform form-horizontal tasi-form research','id'=>'infos_info');
echo form_open_multipart('admin/form/submitApplication', $attr); 
//echo"<pre>";print_r ($infos);die;
	
	
?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th style="width:5%">S.No</th>
			<th style="width:15%">Name On Passport <span class="requires">*</span></th>
			<th style="width:10%">Birth date <span class="requires">*</span></th>
			<th style="width:10%">Passport No<span class="requires">*</span></th>
			<th style="width:10%">Country <span class="requires">*</span></th>
			<th style="width:15%">Issue Date <span class="requires">*</span></th>
			<th style="width:15%">Expires Date <span class="requires">*</span></th>
			<th style="width:12%">Action</th>												
		</tr>
	</thead>
	<tbody class="tbl-body-passport"> 
		<?php  
			$ref_count = 0; 							
			$ref=getPassportInfo($studentid);
		    //echo "<pre>";
			//print_r($ref);
			$num_rows = checkPassportStatus($studentid);
			
			//echo "<pre>";
			//print_r($ref);
			
			if(!empty($ref)){
			$ref_count = 0;
			echo '<input type= "hidden" id="count7" value="'.(count($ref)+1).'" >';
			foreach($ref as $row){
			$ref_count++;
		?>
		
		<tr id="TextBoxDivPT<?php echo $ref_count; ?>">
		<td><?php echo $ref_count;?></td>
		<td>
				<?php if($ref_count == 1){ ?>
				<input type="hidden" name="table<?=$ref_count?>" id="table<?=$ref_count?>" value="name">
				<?php }else { ?>
				<input type="hidden" name="table<?=$ref_count?>" id="table<?=$ref_count?>" value="passport">
				<?php }?>
				<input type="hidden" name="studentid<?=$ref_count?>" id="studentid<?=$ref_count?>" value="<?php if(isset($studentid)){ echo $studentid;}?>">
				<input type="hidden" name="last_id<?=$ref_count?>" id="last_id<?=$ref_count?>" value="<?php if(isset($row['PassportID'])){ echo $row['PassportID'];}?>">
				<span class="show">
					<?php if(isset($row['NameOnPassport'])){ echo $row['NameOnPassport'];}?>
				</span>
				<input class="form-control hide" id="NameOnPassport<?=$ref_count;?>" name="NameOnPassport[<?=$ref_count;?>]" onkeypress="javascript:return ValidateAlphaNew(event)" type="text" value="<?php if(isset($row['NameOnPassport'])){ echo $row['NameOnPassport'];}?>" required>
			</td>
			<td>
			<span class="show"><?php if(isset($row['Birthdate']) && $row['Birthdate']!=""){ echo convertDateString($row['Birthdate']);}?></span>
			<input class="form-control datepickerbackward date-checks passport_date num hide" id="Birthdate<?=$ref_count?>" name="Birthdate[<?=$ref_count?>]" type="text" value="<?php if(isset($row['Birthdate']) && $row['Birthdate']!=""){ echo convertDateString($row['Birthdate']);}?>" readonly required>
			</td>
			<td>
				<span class="show">
					<?php if(isset($row['PassportNumber'])){ echo $row['PassportNumber'];}?>
				</span>
				<input class="form-control hide" id="PassportNumber<?=$ref_count;?>" name="PassportNumber[<?=$ref_count;?>]" type="text" value="<?php if(isset($row['PassportNumber'])){ echo $row['PassportNumber'];}?>" required>
			</td>
			<td>
				<span class="show">
					<?php if(isset($row['PassportCountry'])){ echo getCountryName($row['PassportCountry']); }?>
				</span>
					<select name="PassportCountry[<?php echo $ref_count;?>]" id="PassportCountry<?php echo $ref_count;?>" class="form-control hide" required>
					<option value=''>Select Country</option>
					<?php foreach($country as $rec){ 
					$Countryflag = ($rec['CountryID']==$row['PassportCountry'] ? 'selected="selected"':'');
					?>
					<option value="<?php echo $rec['CountryID']?>" <?php echo $Countryflag;?>><?php echo $rec['CountryName'];?></option>
					<?php }?>
					</select>
			</td>
			<td>
				<span class="show">
					<?php if(isset($row['PassportIssued']) && $row['PassportIssued']!=""){ echo convertDateString($row['PassportIssued']); }?>
				</span>
				<input class="form-control num datepickerbackward passport_date num hide" id="PassportIssued<?=$ref_count;?>" name="PassportIssued[<?=$ref_count;?>]" type="text" value="<?php if(isset($post['PassportIssued'])){ echo $post['PassportIssued'];}
					else if(isset($row['PassportIssued']) && $row['PassportIssued']!=''){ echo convertDateString($row['PassportIssued']);}?>" readonly required>
			</td>
			<td>
				<span class="show">
					<?php if(isset($row['PassportExpires']) && $row['PassportExpires']!=''){ echo convertDateString($row['PassportExpires']); }?>
				</span>
				<input class="form-control num datepickerforward passport_date hide" id="PassportExpires<?=$ref_count;?>" name="PassportExpires[<?=$ref_count;?>]" type="text" value="<?php if(isset($post['PassportExpires'])){ echo $post['PassportExpires'];}
					else if(isset($row['PassportExpires'])){ echo ($row['PassportExpires']!='' ? convertDateString($row['PassportExpires']):'') ;}?>" readonly required>
			</td>
			<td style="width:12%;text-align:center;">
				<?php if($access['edit_access']) { ?>
				<!--<input type="submit" name="sub" value="save">-->
				<a href="javascript:void(0)" id="edit-passport<?php echo $ref_count?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-passport show pull-left" data-id="<?=$studentid?>" data-row="<?=$ref_count?>" style="text-align:center;">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				<span><strong>Edit</strong></span>            
				</a>
				<?php } ?>
				<a href="javascript:void(0)" id="save-passport<?php echo $ref_count;?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-passport hide pull-left" data-id="<?=$studentid?>" data-row="<?=$ref_count?>">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<span><strong>Save</strong></span>            
				</a>
				<a href="javascript:void(0)" id="cancel-passport<?php echo $ref_count;?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-passport hide pull-left" data-id="<?=$studentid?>" data-row="<?=$ref_count?>">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				<span><strong>Cancel</strong></span>            
				</a>
			</td>
			
		</tr>
		<?php }} ?>
		<?php if($access['add_access']) { ?>
		<tr id="TextBoxDivPT<?=$ref_count+1?>">
		<td><?php echo $ref_count+1;?></td>
			<?php if($ref_count == 0){ ?>
			<input type="hidden" name="table<?=$ref_count?>" id="table<?=$ref_count+1?>" value="name">
			<?php }else { ?>
			<input type="hidden" name="table<?=$ref_count?>" id="table<?=$ref_count+1?>" value="passport">
			<?php }?>
			
			<td> <input type="hidden" id="count7" value="2">
			<input type="hidden" name="studentid<?=$ref_count+1?>" id="studentid<?=$ref_count+1?>" value="<?php if(isset($studentid)){ echo $studentid;}?>">
			<input type="hidden" name="last_id<?=$ref_count+1?>" id="last_id<?=$ref_count+1?>" value="">
			<span class="hide"></span>
			<input class="form-control" id="NameOnPassport<?=$ref_count+1?>" name="NameOnPassport[<?=$ref_count+1?>]" onkeypress="javascript:return ValidateAlphaNew(event)"  type="text" <?php echo($num_rows==0 ? 'required':'');?>>
			</td>
			
			<td>
			<span class="hide"></span>
			<input class="form-control datepickerbackward passport_date num date-checks" id="Birthdate<?=$ref_count+1?>" name="Birthdate[<?=$ref_count+1?>]" type="text" maxlength="10" <?php echo($num_rows==0 ? 'required':'');?> readonly>
			</td>
			
			<td>
			<span class="hide"></span>
			<input class="form-control" id="PassportNumber<?=$ref_count+1?>" name="PassportNumber[<?=$ref_count+1?>]" type="text" <?php echo($num_rows==0 ? 'required':'');?>>
			</td>
			
			<td>
			<span class="hide"></span>
			<select class="form-control" id="PassportCountry<?=$ref_count+1?>" name="PassportCountry[<?=$ref_count+1?>]" <?php echo($num_rows==0 ? 'required':'');?>>
				<option value="">Select Country</option>
				<?php foreach($country as $rows){?>
				<option value="<?php echo $rows['CountryID'];?>"><?php echo $rows['CountryName'];?></option>
				<?php }?>
			
			</select>
			</td>
			
			<td>
			<span class="hide"></span>
				<input class="form-control datepickerbackward passport_date num" id="PassportIssued<?php echo $ref_count+1;?>" name="PassportIssued[<?php echo $ref_count+1;?>]" type="text" <?php echo($num_rows==0 ? 'required':'');?> readonly>
			</td>
			
			<td>
			<span class="hide"></span>
				<input class="form-control datepickerforward  passport_date num" id="PassportExpires<?php echo $ref_count+1;?>" name="PassportExpires[<?php echo $ref_count+1;?>]" type="text" <?php echo($num_rows==0 ? 'required':'');?> readonly>
			</td>
			<td>
				<?php if($access['edit_access']) { ?>
				<!--<input type="submit" name="sub" value="save">-->
				<a href="javascript:void(0)" id="edit-passport<?php echo $ref_count+1;?>"class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-passport hide pull-left" data-id="<?=$studentid?>" data-row="<?=$ref_count+1?>" style="text-align:center;">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				<span><strong>Edit</strong></span>            
				</a>
				<?php } ?>
			
				<?php if($access['add_access']) { ?>
				<a href="javascript:void(0)" id="add-passport<?=$ref_count+1?>" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-passport">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					<span><strong>ADD</strong></span>            
				</a>
				<a href="javascript:void(0)" id="save-passport<?=$ref_count+1?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-passport hide pull-left save<?=$ref_count+1;?>" data-id="<?=$studentid?>" data-row="<?=$ref_count+1?>">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<span><strong>Save</strong></span>            
				</a>
				<?php } ?>
				
				<a href="javascript:void(0)"  id="cancel-passport<?php echo $ref_count+1?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-passport hide pull-left"  data-row="<?php echo $ref_count+1?>">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				<span><strong>Cancel</strong></span>            
				</a>
			</td>
			
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