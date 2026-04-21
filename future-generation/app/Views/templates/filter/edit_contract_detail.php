<div class="col-md-6">	
<div class="form-group">
	<input type="hidden" id="edit_id" name="id" value="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['id']; } ?>" >
	<label>Employee ID  <span class="requires">*</span></label>
	<input type="text" class="form-control empid "
	id="edit_empid" name="empid" placeholder="Enter ID "
	value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['empid']; } ?>" readonly  required>
</div>
</div>	

<div class="col-md-6">	
<div class="form-group">
	<label>Team Name  <span class="requires"></span></label>
	<select class="form-control team_name" name="team_name" >
		<option value="">Select</option>	
	<?php foreach ($team_name as  $staff) { ?>
	<option value="<?php echo $staff['id']?>" <?php if(isset($edit_contract[0]) && 
		$edit_contract[0]['teamid']==$staff['id']){ echo "selected"; } ?> >
			<?php echo $staff['team_Name']; ?>	
	</option>						
			<?php } ?>				
	</select>
</div>
</div>

<div class="col-md-6">	
<div class="form-group">																	
	<label>Employee First Name <span class="requires">*</span></label>
	<input type="text" class="form-control edit_validate" readonly id="edit_FirstName" name="FirstName" placeholder="Employee First Name" value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['FirstName']; }?>"   required>
</div>
</div>

<div class="col-md-6">	
<div class="form-group">																	
	<label>Employee Last Name <span class="requires">*</span></label>
	<input type="text" class="form-control edit_validate" readonly id="edit_LastName" name="LastName" placeholder="Employee Last Name " value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['LastName']; } ?>"  required>
</div>
</div>

<div class="col-md-12">	
<div class="form-group">																	
	<label>Title <span class="requires">*</span></label>
	<input type="text" class="form-control" id="edit_title" name="title" placeholder="Employee title " value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['employee_title']; } ?>" >
</div>
</div>
<div class="col-md-6">	
<div class="form-group">																	
	<label>Contract Begin Date <span class="requires">*</span></label>
	<input type="text" class="form-control campare_date datepicker edit_validate" id="edit_contract_begin_date" name="contract_begin_date" placeholder="Contract Begin Date" value ="<?php if(isset($edit_contract[0]) ) { echo convertDateString($edit_contract[0]['contract_begin_date']); } ?>"  required>
</div>
</div>
<div class="col-md-6">	
<div class="form-group">																	
	<label>Contract End Date <span class="requires">*</span></label>
	<input type="text" class="form-control campare_date datepicker end_date edit_validate" id="edit_contract_end_date" name="contract_end_date" placeholder="Contract End Date" value ="<?php if(isset($edit_contract[0]) ) { echo convertDateString($edit_contract[0]['contract_end_date']); } ?>"   required>
</div>
</div>

<div class="col-md-6">	
<div class="form-group">																	
	<label>Early Termination</label>
	<input type="text" class="form-control datepicker" id="edit_early_termination" name="early_termination" placeholder="Early Terminatione" value ="<?php if(isset($edit_contract[0]) ) { if($edit_contract[0]['early_termination_date'] != ''){ echo convertDateString($edit_contract[0]['early_termination_date']);} } ?>">
</div>
</div>

<div class="col-md-6">	
<div class="form-group">																	
	<label>Termination Initiated By</label>
	<select class="form-control" name="termination_initiate" id="edit_termination_initiate">
	    <option value="">Select Termination Initiated</option>
	    <option <?php if(isset($edit_contract[0]) ) { if($edit_contract[0]['termination_initiate_by'] == 'Employee'){ echo 'selected';  }} ?> value="Employee">Employee</option>
	    <option <?php if(isset($edit_contract[0]) ) { if($edit_contract[0]['termination_initiate_by'] == 'Future Generations'){ echo 'selected';  }} ?> value="Future Generations">Future Generations</option>
	</select>
</div>
</div>


<div class="col-md-6">	

<div class="form-group">																	
	<label>Hours To Work<span class="requires">*</span></label>																	
	<input type="text" class="form-control" id="edit_hours_to_work" name="hours_to_work" placeholder="Working Hours" value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['hours_to_work']; } ?>"   required>
</div>

</div>

<div class="col-md-6">	

<div class="form-group">																	
	<label>Carried Over Hours </label>																	
	<input type="text" class="form-control" id="edit_CarriedOverHours" name="CarriedOverHours" placeholder="Carried Over Hours" value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['CarriedOverHours']; } ?>"   required>
</div>

</div>
<div class="col-md-6">	

<div class="form-group">																	
	<label>Education ($) </label>																	
	<input type="text" class="form-control" id="edit_Education" name="education" placeholder="Education" value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['education']; } ?>"   required>
</div>

</div>
<div class="col-md-6">	
<div class="form-group">																	
	<label>Daily Rate ($) </label>																	
	<input type="text" class="form-control" id="edit_daily_rate" name="daily_rate" placeholder="Daily rate" value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['daily_rate']; } ?>"   required>
</div>
</div>


<div class="col-md-6">	
<div class="form-group">																	
	<label>Adjunct Fee </label>																	
	<input type="text" maskedFormat="10,2" class="form-control maskedExt" id="edit_adjunct_fee" name="adjunct_fee" placeholder="Adjunct Fee" value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['adjunct_fee']; } ?>"   required>
</div>
</div>

<div class="col-md-6">	
<div class="form-group">  
    <label >1099</label>
    <select  class="form-control" id="edit_contract_1099" name="contract_1099" required>
        <option value="" >-Select-</option>
        <option value="Yes" <?php if(isset($edit_contract[0])){if($edit_contract[0]['contract_1099']=='Yes'){ echo 'selected'; }}?> >Yes</option>
        <option value="No" <?php if(isset ($edit_contract[0])){if($edit_contract[0]['contract_1099']=='No'){echo'selected';}} ?> >No</option>
    </select>
</div>
</div>