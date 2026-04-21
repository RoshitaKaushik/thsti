<?php 
$access = getAccess(12); //12 for employment data
if(!empty($country)){								
	$country_js = json_encode($country);
}
if(!empty($states)){								
	$state_js = json_encode($states);
}
 if(session()->getFlashdata('post')){ 
	$post = session()->getFlashdata('post');
 }else{ 
	$post = array();
 }
 	//echo $this->session->userdata('role')
	//echo"<pre>";print_r($post);die();
	//echo"<pre>";print_r($employee);
?>
<style>
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
<div class="col-sm-12" style="display:<?php if(isset($form_id)){ echo($form_id!='' ? 'block':'none');}?>">
	<div class="panel-heading">
		<?php if($access['edit_access']) { ?>
		<h3 class="panel-title"> <button id="emp_edit" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			<span><strong>Edit</strong></span></button>
		</h3>
		<?php }?>
		

		<h3 class="panel-title"> <button id="emp_view" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right hide"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
			<span><strong>View</strong></span></button>
		</h3>
		
</div>
</div>
<?php 
$attr = array('class' => 'cmxform form-horizontal tasi-form research','id'=>'');
echo form_open_multipart('admin/form/addEmployeeData', $attr); 
//echo "<pre>"; print_r($employee);die;
?>

<input type="hidden" name="ID" value="<?php if(isset($employee['ID'])){ echo $employee['ID'];}else{echo 0;} ?>">
<input type="hidden" name="name_id" value="<?php if(isset($infos['ID'])){ echo $infos['ID'];} ?>">
<div class="col-sm-6">
	<div class="col-sm-12">									
		<div class="form-group">
			<label for="Driver's License" class="control-label col-sm-4">Driver's License</label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show"><?php if(isset($employee['drivers_licence'])){ echo $employee['drivers_licence'];}?></span>
				<input class="form-control hide" id="diver_license" name="diver_license" type="text" value="<?php 
				if(isset($employee['drivers_licence'])){ echo $employee['drivers_licence'];}?>" >
			</div>
		</div>
	</div>
	<!--<div class="col-sm-12">									
		<div class="form-group">
			<label for="Date Of Birth" class="control-label col-sm-4">Date Of Birth  <span class="requires">*</span></label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show"><?php if(isset($employee['dob'])){ echo $employee['dob'];}?></span>
				<input class="form-control datepickerbackward hide" readonly id="DOB" name="DOB" type="text" value="<?php 
				if(isset($employee['dob'])){ echo $employee['dob'];}?>">
			</div>
		</div>
	</div> -->
	<div class="col-sm-12">
		<div class="form-group">
			<label for="Gender" class="control-label col-sm-4">Gender</label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show">
					<?php 
						if(isset($employee['gender'])){
							if($employee['gender'] == '0'){
								echo 'Male';
							}elseif ($employee['gender'] == '1') {
								echo 'Female';
							}elseif ($employee['gender'] == '2') {
								echo 'Transgender';
							}else{
								echo "Other";
							}
						}
					?>
				</span>
				<select class="form-control hide" id="gender" name="gender">
				  <option value="0" <?php if(isset($employee['gender']) && $employee['gender'] == '0'){ echo 'Selected'; }?> >Male</option>
				  <option value="1" <?php if(isset($employee['gender']) && $employee['gender'] == '1'){ echo 'Selected'; }?>>Female</option>
				  <option value="2" <?php if(isset($employee['gender']) && $employee['gender'] == '2'){ echo 'Selected'; }?>>Transgender</option>
				  <option value="3" <?php if(isset($employee['gender']) && $employee['gender'] == '3'){ echo 'Selected'; }?>>Other</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-sm-12">									
		<div class="form-group">
			<label for="Marital Status" class="control-label col-sm-4">Marital Status</label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show">
					<?php 
						if(isset($employee['marital_status'])){
							if($employee['marital_status'] == '0'){
								echo 'Married';
							}elseif ($employee['marital_status'] == '1') {
								echo 'Divorced';
							}elseif ($employee['marital_status'] == '2') {
								echo 'Widowed';
							}elseif ($employee['marital_status'] == '4') {
								echo 'Domestic Partner';	
							}else{
								echo "Single";
							}
						}
					?>
				</span>
				<select class="form-control hide" id="marital_status" name="marital_status">
				  <option value="0" <?php if(isset($employee['marital_status']) && $employee['marital_status'] == '0'){ echo 'Selected'; }?>>Married</option>
				  <option value="1" <?php if(isset($employee['marital_status']) && $employee['marital_status'] == '1'){ echo 'Selected'; }?>>Divorced</option>
				  <option value="2" <?php if(isset($employee['marital_status']) && $employee['marital_status'] == '2'){ echo 'Selected'; }?>>Widowed</option>
				  <option value="4" <?php if(isset($employee['marital_status']) && $employee['marital_status'] == '4'){ echo 'Selected'; }?>>Domestic Partner</option>
				  <option value="3" <?php if(isset($employee['marital_status']) && $employee['marital_status'] == '3'){ echo 'Selected'; }?>>Single</option>
				  
				</select>
			</div>
		</div>
	</div>
</div>
<div class="col-sm-6">
	<div class="col-sm-12">									
		<div class="form-group">
			<label for="Veteran Status" class="control-label col-sm-4">Veteran Status</label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show">
					<?php 
						if(isset($employee['veteran_status'])){
							if($employee['veteran_status'] == '0'){
								echo 'Not a US Veteran';
							}elseif ($employee['veteran_status'] == '1') {
								echo 'US Veteran';
							}elseif ($employee['veteran_status'] == '2') {
								echo 'Active Reserve';
							}else{
								echo "Inactive Reserve";
							}
						}
					?>
				</span>
				<select class="form-control hide" id="veteran_status" name="veteran_status">
				  <option value="0" <?php if(isset($employee['veteran_status']) && $employee['veteran_status'] == '0'){ echo 'Selected'; }?>>Not a US Veteran</option>
				  <option value="1" <?php if(isset($employee['veteran_status']) && $employee['veteran_status'] == '1'){ echo 'Selected'; }?>>US Veteran</option>
				  <option value="2" <?php if(isset($employee['veteran_status']) && $employee['veteran_status'] == '2'){ echo 'Selected'; }?>>Active Reserve</option>
				  <option value="3" <?php if(isset($employee['veteran_status']) && $employee['veteran_status'] == '3'){ echo 'Selected'; }?>>Inactive Reserve</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-sm-12">									
		<div class="form-group">
			<label for="Ethnicity" class="control-label col-sm-4">Ethnicity</label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show">
					<?php 
						if(isset($employee['ethnicity'])){
							if($employee['ethnicity'] == '0'){
								echo 'Non-Resident';
							}elseif ($employee['ethnicity'] == '1') {
								echo 'White/Caucasian';
							}elseif ($employee['ethnicity'] == '2') {
								echo 'Black/African-American';
							}elseif ($employee['ethnicity'] == '3') {
								echo 'Native American Indian';
							}elseif ($employee['ethnicity'] == '4') {
								echo 'Hispanic/Latin';
							}elseif ($employee['ethnicity'] == '5') {
								echo 'Native Hawaiian/Pacific Islander';
							}else{
								echo "Other";
							}
						}
					?>
				</span>
				<select class="form-control hide" id="ethnicity" name="ethnicity">
				  <option value="0" <?php if(isset($employee['ethnicity']) && $employee['ethnicity'] == '0'){ echo 'Selected'; }?>>Non-Resident</option>
				  <option value="1" <?php if(isset($employee['ethnicity']) && $employee['ethnicity'] == '1'){ echo 'Selected'; }?>>White/Caucasian</option>
				  <option value="2" <?php if(isset($employee['ethnicity']) && $employee['ethnicity'] == '2'){ echo 'Selected'; }?>>Black/African-American</option>
				  <option value="3" <?php if(isset($employee['ethnicity']) && $employee['ethnicity'] == '3'){ echo 'Selected'; }?>>Native American Indian</option>
				  <option value="4" <?php if(isset($employee['ethnicity']) && $employee['ethnicity'] == '4'){ echo 'Selected'; }?>>Hispanic/Latin</option>
				  <option value="5" <?php if(isset($employee['ethnicity']) && $employee['ethnicity'] == '5'){ echo 'Selected'; }?>>Asian</option>
				  <option value="6" <?php if(isset($employee['ethnicity']) && $employee['ethnicity'] == '6'){ echo 'Selected'; }?>>Native Hawaiian/Pacific Islander</option>
				  <option value="7" <?php if(isset($employee['ethnicity']) && $employee['ethnicity'] == '7'){ echo 'Selected'; }?>>Other</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-sm-12">									
		<div class="form-group">
			<label for="Medical Conditions" class="control-label col-sm-4">Medical Conditions</label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show"><?php if(isset($employee['medical_conditions'])){ echo $employee['medical_conditions'];}?></span>
				<textarea rows='1' class="form-control hide" name="medical_conditions" id="medical_conditions"><?php if(isset($employee['medical_conditions'])){ echo $employee['medical_conditions'];}?></textarea>
			</div>
		</div>
	</div>
	<div class="col-sm-12">									
		<div class="form-group">
			<label for="Dietary Restrictions" class="control-label col-sm-4">Dietary Restrictions</label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show"><?php if(isset($employee['dietary_restrictions'])){ echo $employee['dietary_restrictions'];}?></span>
				<textarea rows='1' class="form-control hide" name="dietary_restrictions" id="dietary_restrictions"><?php if(isset($employee['dietary_restrictions'])){ echo $employee['dietary_restrictions'];}?></textarea>
			</div>
		</div>
	</div>
</div>
    <!--email start-->
<div class="col-sm-12" >
	<div class="form-group no_border">
		<!--<label for="firstname" class="control-label col-sm-4">Address Details </label>
	</div> -->
	<div class="table-responsive">
		<h4>Emergency Details</h4>
		<table class="table table-striped table-bordered" id="table_emp_address">
			<tbody id="EmployeeBoxesGroupRD">
				<tr>
					<th style="width:15%">Contact Name<span class="requires">*</span></th>
					<th style="width:15%">Contact Number<span class="requires">*</span></th>
					<th style="width:15%">Relationship<span class="requires">*</span></th>
					<th>Address<span class="requires">*</span></th>
					<th>City<span class="requires">*</span></th>
					<th>State<span class="requires">*</span></th>
					<th>Country<span class="requires">*</span></th>
					<th>Zip<span class="requires">*</span></th>
					<th>Active<span class="requires">*</span></th>
				</tr>

					<?php  
					$ref_count = 0; 
					//if(isset($address['application_code'])  || isset($address['infos_unique_id'])){								
					$ref=getEmergencyAddress(isset($infos['ID']) ? $infos['ID'] : 0);//($address['application_code'], $address['infos_unique_id']);
					//}else{
					//$ref= '';
					//}
					echo '<input type= "hidden" id="rem_count7" value="0" >';
					if(!empty($ref)){
					$ref_count = 0;
					echo '<input type= "hidden" id="count10" value="'.(count($ref)+1).'" >';
					
					foreach($ref as $address){
					$ref_count++;
					?>
					<tr id="TextBoxDivGEN<?php echo $ref_count; ?>">
						<td>
							<span class="show"><?php if(isset($address['contact_name'])){ echo $address['contact_name'];}elseif(isset($post['contact_name'][$ref_count]) ){
								echo $post['contact_name'][$ref_count];
							} ?></span>
							<textarea rows='1' class="form-control hide name_validation" name="Contact_name[<?=$ref_count;?>]" id="contact_name<?=$ref_count;?>" onChange="validateAddressXCheckbox(<?php echo $ref_count;?>)" ><?php if(isset($address['contact_name'])){ echo $address['contact_name'];}elseif(isset($post['contact_name'][$ref_count]) ){
								echo $post['contact_name'][$ref_count];
							}?></textarea>
						 </td>
						 <td>
							<span class="show"><?php if(isset($address['contact_number'])){ echo $address['contact_number'];}elseif(isset($post['contact_number'][$ref_count]) ){
								echo $post['contact_number'][$ref_count];
							} ?></span>
							<textarea rows='1' class="form-control num hide" placeholder="(000) 000-0000" maxlength="12" name="Contact_number[<?=$ref_count;?>]" id="contact_number<?=$ref_count;?>" onChange="validateAddressXCheckbox(<?php echo $ref_count;?>)" ><?php if(isset($address['contact_number'])){ echo $address['contact_number'];}elseif(isset($post['contact_number'][$ref_count]) ){
								echo $post['contact_number'][$ref_count];
							}?></textarea>
						 </td>
						<td>
							<span class="show">
								<?php 
									if(isset($address['relationship'])){
										if($address['relationship'] == '0'){
											echo 'Spouse';
										}elseif ($address['relationship'] == '1') {
											echo 'Child';
										}elseif ($address['relationship'] == '2') {
											echo 'Parent';
										}elseif ($address['relationship'] == '3') {
											echo 'Partner';
										}else{
											echo 'Other';
										} 
									}
								?>
							</span>
							<select class="form-control hide" id="relationship" name="relationship[<?=$ref_count?>]">
							  <option value="all">Select Relationship</option>
							  <option value="0" <?php if(isset($address['relationship']) && $address['relationship'] == '0'){ echo 'Selected'; }?>>Spouse</option>
							  <option value="1" <?php if(isset($address['relationship']) && $address['relationship'] == '1'){ echo 'Selected'; }?>>Child</option>
							  <option value="2" <?php if(isset($address['relationship']) && $address['relationship'] == '2'){ echo 'Selected'; }?>>Parent</option>
							  <option value="3" <?php if(isset($address['relationship']) && $address['relationship'] == '3'){ echo 'Selected'; }?>>Partner</option>
							  <option value="4" <?php if(isset($address['relationship']) && $address['relationship'] == '4'){ echo 'Selected'; }?>>Other</option>
							</select>
						</td>
						<td style="width:20%">
							<input type="hidden" name="Address_RowID[<?=$ref_count;?>]" value="<?php
							if(isset($address['Address_RowID'])){ echo $address['Address_RowID'];}elseif(isset($post['Address_RowID'][$ref_count]) ){
								echo $post['Address_RowID'][$ref_count];
							} ?>">
							<input type="hidden" name="AddressID[<?=$ref_count;?>]" value="<?php if(isset($address['AddressID'])){ echo $address['AddressID'];}elseif(isset($post['AddressID'][$ref_count]) ){
								echo $post['AddressID'][$ref_count];
							} ?>">
							<span class="show"><?php if(isset($address['Street_Address'])){ echo $address['Street_Address'];}elseif(isset($post['Street_Address'][$ref_count]) ){
								echo $post['Street_Address'][$ref_count];
							} ?></span>
							<textarea rows='1' class="form-control hide" name="Street_Address[<?=$ref_count;?>]" id="Street_Address<?=$ref_count;?>" onChange="validateAddressXCheckbox(<?php echo $ref_count;?>)" required><?php if(isset($address['Street_Address'])){ echo $address['Street_Address'];}elseif(isset($post['Street_Address'][$ref_count]) ){
								echo $post['Street_Address'][$ref_count];
							}?></textarea>
						 </td>
						 <td>
							<span class="show"><?php if(isset($address['City'])){ echo $address['City'];}elseif(isset($post['City'][$ref_count]) ){
								echo $post['City'][$ref_count];
							} ?></span>
							<textarea rows='1' class="form-control hide" name="City[<?=$ref_count;?>]" id="City<?=$ref_count;?>" onChange="validateAddressXCheckbox(<?php echo $ref_count;?>)" ><?php if(isset($address['City'])){ echo $address['City'];}elseif(isset($post['City'][$ref_count]) ){
								echo $post['City'][$ref_count];
							}?></textarea>
						 </td>
					
						<td>
							<span class="show"><?php
								if(!empty($states)){
								foreach($states as $row){
								?><?php echo $row['StateID']==$address['State'] ? $row['StateID']:'';?><?php } }?>
							</span>
							
							<select class="form-control hide" id="state" name="State[<?=$ref_count?>]">
								<option value="" selected="selected" >Select</option>
								<?php
								if(!empty($states)){
								foreach($states as $row){
								?>
								<option value="<?php echo $row['StateID'];  ?>" <?php if(isset($address)){ if($row['StateID'] ==$address['State']){ echo 'selected'; } } ?> >  <?php echo $row['StateID']." - " ;echo $row['StateName'];  ?></option> 
								<?php }} ?>
							</select>
						</td>
						
						<td>
							<span class="show"><?php
								if(!empty($country)){
								foreach($country as $con){
								?><?php echo ($con['CountryID']==$address['Country'] ? $con['CountryName']:'');?><?php } }?></span>
							<select class="form-control hide" name="Country[<?=$ref_count?>]" onChange="getstatedetails(this.value)" required>
								<option value="">Select</option>
								<?php
								if(!empty($country)){
								foreach($country as $con){
								?>
								<option value="<?=$con['CountryID']?>" <?php if(isset($address)){ if($con['CountryID'] ==$address['Country']){ echo 'selected'; } } ?>><?=$con['CountryName']?></option>
								<?php }} ?>
							</select>
						</td>
						<td>
							<span class="show"><?php if(isset($address['Postal_Code'])){echo $address['Postal_Code'];}?></span>
							<input class=" form-control  hide" id="Postal_Code<?=$ref_count;?>" name="Postal_Code[<?=$ref_count;?>]" type="text" value="<?php if(isset($address['Postal_Code'])){echo $address['Postal_Code'];}?>" maxlength="7">
						</td>
						<td>
							<input class="address_active" value="1" id="addresscheckbox<?php echo $ref_count;?>"type="checkbox" name="Active[<?=$ref_count;?>]" <?php if(isset($address['Active'])){if($address['Active'] == 1){ echo "checked";}} ?> disabled>
						</td>
						
				
					</tr>

					<?php }} else {?>
					<?php if($access['add_access']) { ?>	
					<tr>
						
						<td style="width:20%"> 
							<input type="hidden" name="Address_RowID[1]" value="" >
							<input type="hidden" name="AddressID[1]" value="" >						
							<textarea rows='1' class="form-control hide" name="Contact_name[1]" id="Contact_name1" onChange="validateAddressXCheckbox(<?php echo $ref_count;?>)"></textarea>
						</td>
						<td>
							<textarea rows='1' class="form-control num hide" placeholder="(000) 000-0000" maxlength="12" name="Contact_number[1]" id="Contact_number1" onChange="validateAddressXCheckbox(<?php echo $ref_count;?>)"></textarea>
						</td>
						<td>
							<span class="show">
								<?php 
									if(isset($address['relationship'])){
										if($address['relationship'] == '0'){
											echo 'Spouse';
										}elseif ($address['relationship'] == '1') {
											echo 'Child';
										}elseif ($address['relationship'] == '2') {
											echo 'Parent';
										}elseif ($address['relationship'] == '3') {
											echo 'Partner';
										}else{
											echo 'Other';
										}
									}
								?>
							</span>
							<select class="form-control hide" id="relationship" name="relationship[1]">
							  <option value="all">Select Relationship</option>
							  <option value="0" <?php if(isset($address['relationship']) && $address['relationship'] == '0'){ echo 'Selected'; }?>>Spouse</option>
							  <option value="1" <?php if(isset($address['relationship']) && $address['relationship'] == '1'){ echo 'Selected'; }?>>Child</option>
							  <option value="2" <?php if(isset($address['relationship']) && $address['relationship'] == '2'){ echo 'Selected'; }?>>Parent</option>
							  <option value="3" <?php if(isset($address['relationship']) && $address['relationship'] == '3'){ echo 'Selected'; }?>>Partner</option>
							  <option value="4" <?php if(isset($address['relationship']) && $address['relationship'] == '4'){ echo 'Selected'; }?>>Other</option>
							</select>
						</td>
						<td>
							<span class="show"><?php if(isset($address['Street_Address'])){ echo $address['Street_Address'];}elseif(isset($post['Street_Address'][1]) ){
								echo $post['Street_Address'][1];
							} ?></span>
							<textarea rows='1' class="form-control  hide"  name="Street_Address[1]" id="Street_Address1" onChange="validateAddressXCheckbox(<?php echo 1;?>)" ><?php if(isset($address['Street_Address'])){ echo $address['Street_Address'];}elseif(isset($post['Street_Address'][1]) ){
								echo $post['Street_Address'][1];
							}?></textarea>
						 </td>						
						<td>
							<input class="form-control  hide" id="City1" name="City[1]" type="text" maxlength="7">
						</td>
						<td>
							<select class="form-control hide" id="State1" name="State[1]" onChange="getstatedetails(this.value)">
								<option value="">Select</option>
								<?php
								//echo"<'pre'>";print_r($country);die();
								if(!empty($states)){
								foreach($states as $con){
								?>
								<option value="<?=$con['StateID']?>" ><?=$con['StateName']?></option>
								<?php }} ?>
							</select>
						</td>
						<td>
							<select class="form-control hide" id="Country1" name="Country[1]" onChange="getstatedetails(this.value)">
								<option value="">Select</option>
								<?php
								//echo"<'pre'>";print_r($country);die();
								if(!empty($country)){
								foreach($country as $con){
								?>
								<option value="<?=$con['CountryID']?>" ><?=$con['CountryName']?></option>
								<?php }} ?>
							</select>
						</td>
						
						<td>
						<span class="show"><?php if(isset($address['Postal_Code'])){ echo $address['Postal_Code'];}elseif(isset($post['Postal_Code'][1]) ){
								echo $post['Postal_Code'][1];
							} ?></span>
							<textarea rows='1' class="form-control hide" name="Postal_Code[1]" id="Postal_Code1" onChange="validateAddressXCheckbox(<?php echo 1;?>)" ><?php if(isset($address['Postal_Code'])){ echo $address['Postal_Code'];}elseif(isset($post['Postal_Code'][1]) ){
								echo $post['Postal_Code'][1];
							}?></textarea>
						</td>
						<td>
							<input class="address_active" value="1" id="addresscheckbox<?php echo $ref_count;?>"type="checkbox" name="Active[<?=$ref_count;?>]" <?php if(isset($address['Active'])){if($address['Active'] == 1){ echo "checked";}} ?> disabled>
						</td>
						
					</tr>
					<?php } }
					$count7 = $ref_count == 0 ? 1 : $ref_count;
					?>

			</tbody>
		</table>		
	</div>
	<?php if($access['add_access']) { ?>
	<div class="clearfix" style="float:right">
		<div class="col-sm-12">
			<button type="submit" id="emp_address_save" style="float: left;margin-left: 5px; display:none;" name="submit" value="address" class="btn btn-success waves-effect waves-light btn-xs m-b-5" <?php if(isset($form_id)){ echo($form_id!='' ? 'onclick="return validate_general()"':'');}?> >Save</button>
			
			<a id="addEmpButtonRD" style="float: left;margin-left: 5px;" class="btn btn-info waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					<span><strong>Add</strong></span>
			</a>
				
			<a id="removeEmpButtonRD" style="float: left;margin-left: 5px;" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				<spanedit_border><strong></strong></span>
			</a>
			
		</div>	
	</div>
	<?php } ?>
	</div>
	
</div>

<div class="col-sm-12">
	
<?php 
//echo "<pre>";print_r($group);die;   isset($group[0]['StudentAlumni']==1) ? $infos['ID'] : 0
 ?>
	<div class="clearfix"></div>
	<?php if($access['edit_access'] || $access['add_access']) { ?>
	<button type="submit" name= "submit" class="btn btn-success center-block hide Addresval" value="name">Save</button>
	<?php } ?>
</div>
<?php echo form_close();?>
<style>
.inline{
	
display: inline-block !important;
	
}

</style> 

<script>
/*  $("#PartnerOrganization").on('click',function(){
	alert(this.value); 
 });//change="PartnerOrganization(this.value)" required */
function PartnerOrganizationc(ev){
	//if($('#PartnerOrganization').is(':checked')){
	if($('input[name=PartnerOrganization]').prop('checked')){
		 $('#PartnerOrgName').removeAttr('disabled');   
	}else{ $('#PartnerOrgName').attr('disabled','disabled');  }
}

function vendor(ev){
	//if($('#Vendor').is(':checked')){
	if($('input[name=Vendor]').prop('checked')){
		 $('#Vendordetail').removeAttr('disabled');   
	}else{ $('#Vendordetail').attr('disabled','disabled');  }
}


function validate_general(){
	var Street_Address1 = $('#Street_Address1').val();
	var City1 = $('#City1').val();		
	var Country1 = $('#Country1').val();

	if(Street_Address1 == '' || City1 == '' || Country1 == ''){
		
		if(Street_Address1 == ''){
			alert('Street Address is required');
			$('#Street_Address1').focus();
			return false;
		}
		if(City1 == ''){
			alert('City is required');
			$('#City1').focus();
			return false;
		}
		/*if(Country1 == ''){
			alert('Country is required');
			var Country1 = $('#Country1').focus();
			return false;
		}*/


	}
	return true;
}




</script>
<script>
$("#addEmpButtonRD").click(function () {
	var country_list = JSON.parse('<?=isset($country_js)?>');
	var state_list = JSON.parse('<?=isset($state_js)?>');
	
	var counter = $("#count10").val();
	var rem_count7 = parseInt($("#rem_count7").val());
	
	//country_select
	country_html = '<select class="form-control" name="Country['+counter+']" onchange="getstatedetails(this.value)" required><option value="">Select</option>';
	$.each(country_list, function (key, val) {
		country_html += '<option value="'+val.CountryID+'">'+val.CountryName+'</option>';
    });
	
	//state_select
	state_html = '<select class="form-control" id="state" name="State['+counter+']"><option value="">Select</option>';
	$.each(state_list, function (key, val) {
		state_html += '<option value="'+val.StateID+'">'+val.StateID+' - '+val.StateName+'</option>';
    });

    //Relationship_Html
    relationship_html = '<select class="form-control" name="relationship['+counter+']"><option value="all">Select Relationship</option><option value="0">Spouse</option><option value="1">Child</option><option value="2">Parent</option><option value="3">Partner</option><option value="4">Other</option></select>';
	
	
	if(counter>10){
        alert("Only 5 Emergency Contact allow");
        return false;
	}

	var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'TextBoxDivGEN' + counter);
	newTextBoxDiv.after().html('<td><input type="hidden" name="Address_RowID['+counter+']" value=""><input type="hidden" name="AddressID['+counter+']" value=""><textarea required rows="1" class="form-control"  name="Contact_name['+counter+']" id="Contact_name'+counter+'" required onChange="validateAddressXCheckbox('+counter+')"></textarea></td><td><textarea required rows="1" class="form-control num" name="Contact_number['+counter+']" placeholder="(000) 000-0000" maxlength="12" id="Contact_number'+counter+'" onChange="validateAddressXCheckbox('+counter+')"></textarea></td><td>'+relationship_html+'</td><td><input required class=" form-control char" id="Street_Address'+counter+'" name="Street_Address['+counter+']" type="text" required></td><td><input required class=" form-control char" id="City'+counter+'" name="City['+counter+']" type="text" required></td><td>'+state_html+'</td><td>'+country_html+' </td><td><input required class="form-control " id="Postal_Code'+counter+'" name="Postal_Code['+counter+']" type="text" maxlength="7"></td><td><input class="" value="1" type="checkbox" name="Active['+counter+']" id="addresscheckbox'+counter+'"></td>');
		  
	newTextBoxDiv.appendTo("#EmployeeBoxesGroupRD");
	counter++;
	$("#count10").val(counter++);
	$("#rem_count7").val(parseInt(rem_count7+1));
	$('#emp_address_save').css('display', 'block');
});

$("#removeEmpButtonRD").click(function (){
	var rem_count7 = $("#rem_count7").val();
	if(rem_count7==0){
		//$('#address_save').css('display', 'none');
		alert("Address removal not allowed, either update or uncheck the active checkbox.");
		return false;
	}
	//counter--;
	//$("#TextBoxDivGEN" + counter).remove();
	$('#table_emp_address tr:last').remove();	
	$("#rem_count7").val(parseInt(rem_count7-1));
	var current_count = $("#count10").val();
	$("#count10").val(parseInt(current_count-1));
});
</script>
<?php if(isset($form_id) == ''){ ?>
<script>
$('#tab12 .hide').removeClass('hide').addClass('show');
$('#tab12 span.show').removeClass('show').addClass('hide');
$("#tab12 #emp_view").show();
$("#tab12 #emp_edit").hide();
$("#tab12 #checkbox input:checkbox, .address_active, .email_active").attr("disabled",false);	
</script>
<?php }?>
<script type="text/javascript">
$(document).on('click','#emp_edit',function(){
	
	$('#tab12 .hide').removeClass('hide').addClass('show');
	$('#tab12 span.show').removeClass('show').addClass('hide');
	$("#tab12 #emp_view").show();
	$("#tab12 #emp_edit").hide();
	$("#tab12 #checkbox input:checkbox, .address_active, .email_active").attr("disabled",false);	
	$('.no_border').removeClass('no_border').addClass('edit_border');
	$('#emp_address_save').show();

});

$(document).on('click','#emp_view',function(){	
	$('#tab12 .show').removeClass('show').addClass('hide');
	$('#tab12 span.hide').removeClass('hide').addClass('show');	
	$(this).hide();
	$("#tab12 #emp_edit").show();
	$("#tab12 #checkbox input:checkbox, .address_active, .email_active").attr("disabled",true);	
	$('#emp_address_save').hide();
	$('.edit_border').removeClass('edit_border').addClass('no_border');			
});



</script>
<script>
  $(document).ready(function(){
        $('input[name="phone"], input[name="fed_phone"]').mask('(000) 000 0000');
        $('input[name="fax_no"]').mask('+99-9999999999');
        $('input[name="employer_fax"]').mask('+99-9999999999');
        $('input[name="aadhar"]').mask('999999999999');
        $('input[name="aadhar_enroll_no"]').mask('9999/99999/99999');
        $('.year').mask('9999');
        $('.passedyear').mask('9999');
		$('.mask').mask('9.99');
    });

   
	
    function validateEmployerEmail(email) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	
        if (reg.test(email) == false) 
        {
            alert('Enter Valid E-mail Below Given Format \r\n email@subdomain.example.com or \r\n (testuser@gmail.com)');
            document.getElementById("employer_email").value="";
        }
	
    }


</script>

<script type="text/javascript">
 function validateCheckbox(id){
	var email = $('#Email'+id).val();
	if(email!=" "){
		$("#emailstatus"+id).prop('checked',true);
	}
	else{
		$("#emailstatus"+id).prop('checked',false);
	}
	validateEmail(email);
	
 }
 
 function validateAddressXCheckbox(id){
	 
	 var current_value = $('#Street_Address'+id).val();
	 if(current_value!=""){
		$("#addresscheckbox"+id).prop('checked',true);
	 }
	 else {
		  $("#addresscheckbox"+id).prop('checked',false);
	 }
	 
 }
$( document ).ready(function() {
	var EmpID = "<?php if(isset($employee['ID'])){echo 1; }else{echo 0;} ?>";
	if(EmpID == 0){
		$('#tab12 .hide').removeClass('hide').addClass('show');
		$('#tab12 span.show').removeClass('show').addClass('hide');
		$("#tab12 #emp_view").show();
		$("#tab12 #emp_edit").hide();
	}
});

</script>


