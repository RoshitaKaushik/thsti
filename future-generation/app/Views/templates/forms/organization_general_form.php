<style>
    .custom-btn{
        width:100%;
    }
    button.multiselect.dropdown-toggle.form-control.btn {
        padding: 0px !important;
    }
    ul.multiselect-container.dropdown-menu.custom-multi {
        left:0px !important;
    }
    .checkbox input[type="checkbox"]{
        opacity: 1;
    }
</style>
<div class="row" style="background: #f5f5f5;padding: 3px;"></div>
<?php 
$access['edit_access'] = true;
$access['add_access'] = true;

        $attr = array('class' => 'cmxform form-horizontal tasi-form research','id'=>'organization_general_form');
        echo form_open_multipart('admin/form/submitOrganization', $attr); 
        //echo "<pre>"; print_r($infos);die;
        ?>
        <input type="hidden" name="id" value="<?php if(isset($infos['id'])){ echo $infos['id'];} ?>">
        
        <div class="col-md-12" style="padding:20px;">
        	<div class="row">
        	    
        	    
        	    
        		<div class="col-md-6">	
        		    <?php if(isset($infos)){ ?>
                    <div class="col-md-12 row formDiv">								
                        <div class="form-group">
                            <label for="First Name" class="control-label col-sm-4" style="color:#666;">Organization ID </label>
                            <div class="col-sm-1"> : </div>
                            <div class="col-sm-7">
                                <input type="hidden" id="select_organization_id" value="<?= encryptor('encrypt', $infos['id']); ?>">
                                <span><?php
                                    if(isset($infos['id'])){echo "O".$infos['id'];}?>
                                </span>
                            </div>
                        </div>
                    </div>
        		    <?php } ?>
                <div class="col-md-12 row formDiv">
                    <div class="form-group">
                        <label for="title " class="control-label col-sm-4" style="color:#666;">Organization Name <span class="requires">*</span> </label>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-7">
                            <span class="show"><?php
                            if(isset($post['org_name'])){ echo $post['org_name'];}
                            else if(isset($infos['name'])){echo $infos['name'];}?></span>
                            
                            <input class="form-control hide validate" id="org_name" name="org_name" type="text" required value="<?php 
                            if(isset($post['org_name'])){ echo $post['org_name'];}
                            else if(isset($infos['name'])){echo $infos['name'];}?>">
                            <input type="hidden" class="form-control" id="admin_id" name="admin_id">
                            <input type="hidden" name="save_status" value="<?php if(isset($infos['save_status'])){echo $infos['save_status'];}?>" class="form-control">
                        </div>
                    </div>
                </div>
        			<div class="col-md-12 row formDiv">								
        			<div class="form-group">
        				<label for="First Name" class="control-label col-sm-4" style="color:#666;">Website </label>
        				<div class="col-sm-1"> :
        				</div>
        				<div class="col-sm-7">
        				<span class="show"><?php 
        					if(isset($post['website'])){ echo $post['website'];}	
        					else if(isset($infos['website'])){echo $infos['website'];}?></span>
        					
        					<input class=" form-control hide" id="website" name="website" type="text" value="<?php 
        					if(isset($post['website'])){ echo $post['website'];}	
        					else if(isset($infos['website'])){echo $infos['website'];}?>"  >
        					
        				</div>
        			</div>
        			</div>
        			
        			
                    <div class="col-md-12 row formDiv">								
                        <div class="form-group">
                        	<label for="First Name" class="control-label col-sm-4" style="color:#666;">Summary Note </label>
                        	<div class="col-sm-1"> : </div>
                        	<div class="col-sm-7">
                                <span class="show"><?php 
                                    if(isset($post['org_position'])){ echo $post['org_position'];}	
                                    else if(isset($infos['org_position'])){echo $infos['org_position'];}?>
                                </span>
                                
                                <textarea class="form-control hide" maxlength="30" name="org_position"><?php if(isset($post['org_position'])){ echo $post['org_position'];}	else if(isset($infos['org_position'])){echo $infos['org_position'];}?></textarea>
                        		
                        		
                        	</div>
                        </div>
                    </div>
        			
        			
        		</div>
        		
        		<div class="col-md-6" style="display:<?php if(isset($form_id)){ echo($form_id!='' ? 'block':'none');}?>">
        		    
                    	<div class="panel-heading" style="text-align:right;">
                           
                           <?php 
                                    $profiles = session()->get('profiles') ?? [];
                                    if (session()->get('role') == '1' || in_array(3, $profiles)) {
                                ?>
                            <h3 class="panel-title"> 
                                <span id="general_edit" class="brn btn-purple">
                                    <i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> <span><strong>Edit</strong></span>
                               </span>
                            </h3>
                            <?php } ?>
                            
                            <h3 class="panel-title"> 
                                <span id="general_view" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right hide">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    <span>
                                        <strong>View</strong>
                                    </span>
                                </span>
                            </h3>
        		</div>
        		
        	</div>
            	<hr>
            </div>
        
        
        
        <div class="col-sm-12"  >
        	<div class="form-group no_border">
        		<!--<label for="firstname" class="control-label col-sm-4">Address Details </label>
        	</div> -->
        	<div class="table-responsive">
        		<table class="table table-striped table-bordered" id="table_address">
        			<tbody id="TextBoxesGroupRD">
        				<tr>
        					<th style="width:20%">Street Address<span class="requires">*</span></th>
        					<th style="width:20%">Address2</th>
        					<th>City<span class="requires">*</span></th>
        					<th>State</th>
        					<th>Postal Code</th>
        					<th>Country<span class="requires">*</span></th>
        					<!--th>Type<span class="requires">*</span></th-->
        					<th>Physical</th>
        					<th>Mailing</th>
        					<th>Active</th>
        				
        				</tr>
        
        					<?php  
        					
        					$ref_count = 0; 
        					//if(isset($address['application_code'])  || isset($address['infos_unique_id'])){								
        					$ref= $addressDetails;
        					//}else{
        					//$ref= '';
        					//}
        					echo '<input type= "hidden" id="rem_addcount7" value="0" >';
        					
        					if(!empty($ref)){
        					$ref_count = 0;
        				echo '<input type= "hidden" id="addcount7" value="'.(count($ref)+1).'" >';
        					
        					foreach($ref as $address){
        					$ref_count++;
        					?>
        					<tr id="TextBoxDivGEN<?php echo $ref_count; ?>">
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
        							<textarea rows='1' class="form-control validate street_validate hide" name="Street_Address[<?=$ref_count;?>]" id="Street_Address<?=$ref_count;?>" onChange="validateAddressXCheckbox(<?php echo $ref_count;?>)"><?php if(isset($address['Street_Address'])){ echo $address['Street_Address'];}elseif(isset($post['Street_Address'][$ref_count]) ){
        								echo $post['Street_Address'][$ref_count];
        							}?></textarea>
        						 </td>
        						 <td>
        							<span class="show"><?php if(isset($address['Address2'])){ echo $address['Address2'];}elseif(isset($post['Address2'][$ref_count]) ){
        								echo $post['Address2'][$ref_count];
        							} ?></span>
        							<textarea rows='1' class="form-control hide" name="Address2[<?=$ref_count;?>]" id="Address2<?=$ref_count;?>" onChange="validateAddressXCheckbox(<?php echo $ref_count;?>)" ><?php if(isset($address['Address2'])){ echo $address['Address2'];}elseif(isset($post['Address2'][$ref_count]) ){
        								echo $post['Address2'][$ref_count];
        							}?></textarea>
        						 </td>
        						<td>
        							<span class="show"><?php if(isset($address['City'])){ echo $address['City'];}?></span>
        							<input class="form-control validate street_validate hide" id="City<?=$ref_count;?>" name="City[<?=$ref_count?>]" type="text" value="<?php if(isset($address['City'])){ echo $address['City'];}?>">
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
        							<span class="show"><?php if(isset($address['Postal_Code'])){echo $address['Postal_Code'];}?></span>
        							<input class=" form-control  hide" id="Postal_Code<?=$ref_count;?>" name="Postal_Code[<?=$ref_count;?>]" type="text" value="<?php if(isset($address['Postal_Code'])){echo $address['Postal_Code'];}?>" maxlength="7">
        						</td>
        						<td>
        							<span class="show"><?php
        								if(!empty($country)){
        								foreach($country as $con){
        								?><?php echo ($con['CountryID']==$address['Country'] ? $con['CountryName']:'');?><?php } }?></span>
        							<select class="form-control validate street_validate hide" name="Country[<?=$ref_count?>]" onChange="getstatedetails(this.value)">
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
        							
        							
        							<input type="checkbox" value="1" class="physical_part" disabled name="physical[<?=$ref_count?>]" id="physical<?=$ref_count?>" <?php if(isset($address['physical_status'])){if($address['physical_status'] == 1){ echo "checked";}} ?>>
        							<!--select class="form-control validate street_validate hide" id="addressType<?=$ref_count?>" name="addressType[<?=$ref_count?>]">
        								<option value="">Select</option>
        								<?php
        								if(!empty(isset($address_type))){
        								foreach($address_type as $type){
        								?>
        								  <option value="<?=$type['name']?>" <?php if(isset($address)){ if($type['name'] ==isset($address['addressType'])){ echo 'selected'; } } ?> ><?=$type['name']?></option>
        								<?php }} ?>
        							</select-->
        							
        						</td>
        						<td>
        						    <input type="checkbox" value="1" class="mailing_part" disabled name="mailing[<?=$ref_count?>]" id="mailing<?=$ref_count?>" <?php if(isset($address['mailing_status'])){if($address['mailing_status'] == 1){ echo "checked";}} ?>>
        						</td>
        						
        						<td>
        							<input class="address_active" value="1" id="addresscheckbox<?php echo $ref_count;?>"type="checkbox" name="Active[<?=$ref_count;?>]" <?php if(isset($address['Active'])){if($address['Active'] == 1){ echo "checked";}} ?> disabled>
        						</td>
        						
        				
        					</tr>
        
        					<?php }} else {?>
        					<?php if($access['add_access']) { 
        					echo '<input type= "hidden" id="addcount7" value="2" >';
        					?>	
        					<tr>
        						
        						<td style="width:20%"> 
        							<input type="hidden" name="Address_RowID[1]" value="" >
        							<input type="hidden" name="AddressID[1]" value="" >						
        							<textarea rows='1' class="form-control street_validate hide" name="Street_Address[1]" id="Street_Address1" onChange="validateAddressXCheckbox(<?php echo $ref_count;?>)"></textarea>
        						</td>
        						<td>
        							<textarea rows='1' class="form-control hide" name="Address2[1]" id="" onChange="validateAddressXCheckbox(<?php echo $ref_count;?>)"></textarea>
        						</td>
        						<td>
        							<input class="form-control street_validate char hide" id="City1" name="City[1]" type="text">
        						</td>
        						<td>
        							<select class="form-control hide" id="State1" name="State[1]" >
        								<option value="" selected="selected" >Select</option>
        								<?php
        								if(!empty($states)){
        								foreach($states as $row){
        								?>
        								<option value="<?php echo $row['StateID'];  ?>"> <?php echo $row['StateID']." - " ;echo $row['StateName'];  ?></option> 
        								<?php }} ?>
        							</select>
        						</td>
        						<td>
        							<input class="form-control  hide" id="Postal_Code1" name="Postal_Code[1]" type="text" maxlength="7">
        						</td>
        						<td>
        							<select class="form-control street_validate hide" id="Country1" name="Country[1]" onChange="getstatedetails(this.value)">
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
        						    <input type="checkbox" value="1" class="physical_part" disabled name="physical[1]" id="physical1">
        						    <!--select class="form-control street_validate hide" id="addressType1" name="addressType[1]">
        								<option value="">Select</option>
        								<?php
        								if(!empty($address_type)){
        								foreach($address_type as $type){
        								?>
        								  <option value="<?=$type['name']?>" ><?=$type['name']?></option>
        								<?php }} ?>
        							</select-->
        						    
        						</td>
        						
                                <td>
                                    <input type="checkbox" value="1" class="mailing_part" disabled name="mailing[1]" id="mailing1">
                                </td>
        						
        						<td>
        						<input class="" value="1" id="addresscheckbox<?php echo $ref_count+1;?>"type="checkbox" name="Active[1]">
        						</td>
        						
        					</tr>
        					<?php } }
        					$count7 = $ref_count == 0 ? 1 : $ref_count;
        					?>
        
        			</tbody>
        		</table>		
        	</div>
        	<?php if(session()->get('role') == '1' || in_array(3, session()->get('profiles'))){?>
        	<div class="clearfix" style="float:right">
        		<div class="col-sm-12">
        		    <?php if($form_id != ''){  
        		    ?>
        		    <?php //if(isset($form_id)){ echo($form_id!='' ? 'onclick="return validate_general()"':'');} ?>
        			<span  id="address_save" style="float: left;margin-left: 5px; display:none;" name="submit" value="address" class="btn btn-success waves-effect waves-light btn-xs m-b-5"  >Save</span>
        			<?php } ?>
        			<a id="addButtonRD" style="float: left;margin-left: 5px;" class="btn btn-info waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        					<span><strong>Add</strong></span>
        			</a>
        				
        			<a id="removeButtonRD" style="float: left;margin-left: 5px;" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        				<span><strong></strong></span>
        			</a>
        			
        		</div>	
        	</div>
        	<?php } ?>
        	</div>
        	<hr>
        </div>
    	<!-- international address shipping -->
    	<div class="col-sm-12"><h4>International Address</h4></div>
    	<div class="col-sm-12"  >
    		
    		<div class="form-group no_border">
    		<div class="table-responsive">
    			<table class="table table-striped table-bordered" id="inter_table_address">
    				<tbody id="inter_TextBoxesGroupRD">
    					<tr>
    						<th style="width:20%">Address1</th>
    						<th style="width:20%">Address2</th>
    						<th style="width:20%">Address3</th>
    						<th>Locale</th>
    						<th>Country</th>
    						<th>Physical</th>
    						<th>Mailing</th>
    						<th>Active</th>
    					</tr>
    
    						<?php  
    						$inter_ref_count = 0; 
    						$ref= $internationAddressDetails;
    						echo '<input type= "hidden" id="rem_count8" value="0" >';
    						if(!empty($ref)){
    						$inter_ref_count = 0;
    						echo '<input type= "hidden" id="count8" value="'.(count($ref)+1).'" >';					
    						foreach($ref as $address){
    						$inter_ref_count++; ?>
    							<tr id="TextBoxDivGEN<?php echo $inter_ref_count; ?>">
                                    <td>
                                        <span class="show"><?php if(isset($address['address1'])){ echo $address['address1'];}elseif(isset($post['address1'][$inter_ref_count]) ){
                                            echo $post['address1'][$inter_ref_count];
                                        } ?></span>
                                        <textarea rows='1' class="form-control hide" 
                                        name="address1[<?=$inter_ref_count;?>]" id="company_name<?=$inter_ref_count;?>" 
                                        onChange="validateAddressXCheckbox(<?php echo $inter_ref_count;?>)" ><?php if(isset($address['address1'])){ echo $address['address1'];}elseif(isset($post['address1'][$inter_ref_count]) ){	echo $post['address1'][$inter_ref_count];}?></textarea>	
                                    </td>
                                    <td style="width:20%">
                                        <input type="hidden" name="inter_Address_RowID[<?=$inter_ref_count;?>]" value="<?php
                                        if(isset($address['Address_RowID_int'])){ echo $address['Address_RowID_int'];}
                                        elseif(isset($post['inter_Address_RowID'][$inter_ref_count]) ){
                                            echo $post['inter_Address_RowID'][$inter_ref_count];
                                        }else{
                                            echo "0";
                                        } ?>">
                                        <input type="hidden" name="inter_AddressID[<?=$inter_ref_count;?>]" value="<?php if(isset($address['AddressID_int'])){ echo $address['AddressID_int'];}
                                        elseif(isset($post['inter_AddressID'][$inter_ref_count]) ){
                                            echo $post['inter_AddressID'][$inter_ref_count];
                                        }else{echo ($infos['ID']) ? $infos['ID'] : 0;} ?>">
                                        <span class="show"><?php if(isset($address['address2'])){ echo $address['address2'];}elseif(isset($post['address2'][$inter_ref_count]) ){
                                            echo $post['address2'][$inter_ref_count];
                                        } ?></span>
                                        <textarea rows='1' class="form-control hide" name="address2[<?=$inter_ref_count;?>]" id="inter_Street_Address<?=$inter_ref_count;?>" onChange="validateAddressXCheckbox(<?php echo $inter_ref_count;?>)" ><?php if(isset($address['address2'])){ echo $address['address2'];}elseif(isset($post['address2'][$inter_ref_count]) ){ echo $post['address2'][$inter_ref_count];
                                        }?></textarea>
                                    </td>
                                    <td>
                                        <span class="show"><?php if(isset($address['address3'])){ echo $address['address3'];}elseif(isset($post['address3'][$inter_ref_count]) ){
                                            echo $post['address3'][$inter_ref_count];
                                        } ?></span>
                                        <textarea rows='1' class="form-control hide" name="address3[<?=$inter_ref_count;?>]" id="inter_Address2<?=$inter_ref_count;?>" onChange="validateAddressXCheckbox(<?php echo $inter_ref_count;?>)" ><?php if(isset($address['address3'])){ echo $address['address3'];}elseif(isset($post['address3'][$inter_ref_count]) ){
                                            echo $post['address3'][$inter_ref_count];
                                        }?></textarea>
                                    </td>
                                    <td>
                                        <span class="show"><?php if(isset($address['City_int'])){ echo $address['City_int'];}?></span>
                                        <textarea rows='1' class="form-control hide" name="inter_City[<?=$inter_ref_count?>]"
                                        id="inter_City<?=$inter_ref_count;?>" ><?php if(isset($address['City_int'])){ echo $address['City_int'];}?></textarea>
                                    </td>
                                    <td>
                                        <span class="show"><?php
                                            if(!empty($country)){
                                            foreach($country as $row){
                                            ?><?php  echo $row['CountryID']==$address['Country_int'] ? strtoupper($row['CountryName']):'';?><?php } }?>
                                        </span>
                                        <select class="form-control hide" name="inter_Country[<?=$inter_ref_count?>]" onChange="getstatedetails(this.value)" >
                                            <option value="">Select</option>
                                            <?php
                                            if(!empty($country)){
                                            foreach($country as $con){
                                            ?>
                                            <option value="<?=$con['CountryID']?>" <?php if(isset($address)){ if($con['CountryID'] ==@$address['Country_int']){ echo 'selected'; } } ?>><?=strtoupper($con['CountryName'])?></option>
                                            <?php }} ?>
                                        </select>
                                    </td>
                                    
                                    <td>
                                        <!--span class="show"> <?php echo ($address['AddressType']);?></span>
                                        <select class="form-control validate interaddressType hide" id="interaddressType<?=$inter_ref_count?>" name="interaddressType[<?=$inter_ref_count?>]">
                                            <option value="">Select</option>
                                            <?php
                                            if(!empty($address_type)){
                                            foreach($address_type as $type){?>
                                                <option value="<?=$type['name']?>" <?php if(isset($address)){ if($type['name'] ==isset($address['AddressType'])){ echo 'selected'; } } ?> ><?=$type['name']?></option>
                                            <?php }} ?>
                                        </select-->
                                        <input type="checkbox" value="1" class="physical_part" disabled name="inter_physical[<?=$inter_ref_count?>]" id="inter_physical<?=$inter_ref_count?>" <?php if(isset($address['physical_status'])){if($address['physical_status'] == 1){ echo "checked";}} ?>>

                                    </td>
                                    <td>
                                        <input type="checkbox" value="1" class="mailing_part" disabled name="inter_mailing[<?=$inter_ref_count?>]" id="inter_mailing<?=$inter_ref_count?>" <?php if(isset($address['mailing_status'])){if($address['mailing_status'] == 1){ echo "checked";}} ?>>
                                    </td>
                                    <td>
                                        <input class="address_active" value="1" id="inter_addresscheckbox<?php echo $inter_ref_count;?>"type="checkbox" name="inter_Active[<?=$inter_ref_count;?>]" <?php if(isset($address['Active_int'])){if($address['Active_int'] == 1){ echo "checked";}} ?> disabled>
                                    </td>
                                </tr>
    						<?php }} else {?>
    						<?php if($access['add_access']) { echo '<input type= "hidden" id="count8" value="2" >'; ?>	
    						<tr>							
                                <td style="width:20%"> 
                                    <input type="hidden" name="inter_Address_RowID[1]" value="0" >
                                    <input type="hidden" name="inter_AddressID[1]" value="<?php echo ($infos['ID']) ? $infos['ID'] : 0; ?>" >					
                                    <textarea rows='1' class="form-control hide" name="address1[1]" id="inter_Street_Address1" onChange="validateAddressXCheckbox(<?php echo $inter_ref_count;?>)"></textarea>
                                </td>
                                <td>
                                    <textarea rows='1' class="form-control hide" name="address2[1]" id="" onChange="validateAddressXCheckbox(<?php echo $inter_ref_count;?>)"></textarea>
                                </td>
                                <td>
                                    <input class="form-control hide" id="inter_City1" name="address3[1]" type="text">
                                </td>
                                <td>
                                    <div>
                                        <input type="text" class="form-control hide" id="inter_State1" name="inter_City[1]">
                                    </div>
                                    </td>
                                <td>
                                    <select class="form-control hide" id="inter_Country1" name="inter_Country[1]" onChange="getstatedetails(this.value)">
                                        <option value="">Select</option>
                                        <?php
                                        if(!empty($country)){
                                        foreach($country as $con){
                                        ?>
                                        <option value="<?=$con['CountryID']?>" ><?=strtoupper($con['CountryName'])?></option>
                                        <?php }} ?>
                                    </select>
                                </td>
                                
                                <td>
                                    <!--select class="form-control interaddressType hide" id="interaddressType1" name="interaddressType[1]">
                                        <option value="">Select</option>
                                        <?php
                                        if(!empty(isset($address_type))){
                                        foreach($address_type as $type){
                                        ?>
                                            <option value="<?=$type['name']?>" ><?=$type['name']?></option>
                                        <?php }} ?>
                                    </select-->
                                    <input type="checkbox" value="1" class="physical_part" disabled name="inter_physical[1]" id="inter_physical1">
                                </td>
                                <td>
                                    <input type="checkbox" value="1" class="mailing_part" disabled name="inter_mailing[1]" id="inter_mailing1">
                                </td>
                                <td>
                                <input class="" value="1" id="addresscheckbox<?php echo $inter_ref_count+1;?>"type="checkbox" name="inter_Active[1]">
                                </td>
                            </tr>
    						<?php } }
    						$count8 = $inter_ref_count == 0 ? 1 : $inter_ref_count;
    						?>
    
    				</tbody>
    			</table>		
    		</div>
    		<?php if(session()->get('role') == '1' || in_array(3, session()->get('profiles'))){?>
    		<div class="clearfix" style="float:right">
    			<div class="col-sm-12">
    			    <?php if($form_id != ''){  ?>
    			    <?php // if(isset($form_id)){ echo($form_id!='' ? 'onclick="return inter_validate_general()"':'');}?> 
    				<span  id="inter_address_save" style="float: left;margin-left: 5px; display:none;" name="submit" value="inter_address" class="btn btn-success waves-effect waves-light btn-xs m-b-5" >Save</span>			
    				
    				<?php } ?>
    				<a id="inter_addButtonRD" style="float: left;margin-left: 5px;" class="btn btn-info waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    						<span><strong>Add</strong></span>
    				</a>				
    				<a id="inter_removeButtonRD" style="float: left;margin-left: 5px;" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    					<span><strong></strong></span>
    				</a>			
    			</div>	
    		</div>
    		<?php } ?>
    		</div>
    		<hr>
    	</div>
    	<!-- end international address shipping -->
        <hr>
        
        <div class="col-sm-12">
        	
        	    <!-- By Prabhat 10-01-2021  -->
        	    <div class="col-md-12"><h4>Phone History</h4></div>
        	 	<div class="col-md-12">			
        	 	
        			<div class="form-group no_border">
        				
        					<div class="table-responsive">
        						<table class="table table-striped table-bordered" id="us_email">
        							<tbody id="TextBoxesGroupUSFD">
        							    
        								<tr>
        									<th>Type <span style="color:red;">*</span></th>
        									<th>Number <span style="color:red;">*</span></th>
        									<th>Extension </th>
        									<th>Active</th>
        								</tr>
        								<?php  
        								$ref_count = 0; 
        														
        								
        								echo '<input type="hidden" id="rem_count11" value="0">';
        								if(!empty($allnumbers)){
        								$ref_count = 0;
        								echo '<input type="hidden" id="count11" value="'.(count($allnumbers)+1).'" >';
        								
        								foreach($allnumbers as $num){
        								$ref_count++;
        								?>					
        								<tr id="TextBoxDivUSPhone<?php echo $ref_count; ?>">
        									
        									<td>
        										<input value="<?php if(isset($num['AutoId'])){ echo $num['AutoId'];}?>" type="hidden" name="US_RowID[<?=$ref_count;?>]" >
        										<span class="show"><?php if(isset($num['Type'])){ echo $num['PhoneType'];}?></span>
        										
        										<select  class="form-control validate phonevalidate hide" name="phonetype[<?= $ref_count ?>]" id="phonetype<?= $ref_count ?>" <?php  if(isset($num['Number'])){ echo "required='required'";}?>>
        										    <option value="">Select Phone</option>
        										    <?php
        										      foreach($phonetypes as $pt)
        										      {
        										       $sec = ''; 
        										       if($num['Type'] == $pt['Id'])
        										       {
        										           $sec = 'selected';
        										       }
        										          ?>
        										          <option <?= $sec ?> value="<?= $pt['Id'] ?>"><?= $pt['PhoneType'] ?></option>
        										          <?php
        										      }
        										    ?>
        										</select>	
        									</td>
        									
        									
        									<td>
        									    <span class="show"><?php helper('function');  if(isset($num['Number'])){ echo dateConverter($num['Number']);}?></span>
        								        <input  class="USPhoneNumber validate phonevalidate phonetype form-control hide"  type="text" name="USPhoneNumber[<?=$ref_count;?>]"  id="USPhoneNumber<?php echo $ref_count;?>" rel_id="<?php echo $ref_count;?>" value="<?php if(isset($num['Number'])){ echo $num['Number'];  } ?>">
        									</td>
        									
        									<td>
        									     <span class="show"><?php if(isset($num['Extension'])){ echo $num['Extension'];}?></span>
        									    	<input  class="no_decimal form-control hide"  type="text" name="Extension[<?=$ref_count;?>]"  id="Extension<?php echo $ref_count;?>" value="<?php if(isset($num['Extension'])){ echo $num['Extension'];  } ?>">
        									</td>
        									
        									
        									<td>
        										 <input value="1" class="USActive" type="checkbox" name="USActive[<?=$ref_count;?>]" id="USstatus<?php echo $ref_count;?>" <?php if(isset($num['Active'])) if($num['Active'] == 1) { echo 'checked'; } ?> disabled >
        									</td>
        									
        									
        									
        									
        								</tr>
        								<?php }
        								$count7 = $ref_count == 0 ? 1 : $ref_count;
        								}else { 
        								if($access['edit_access']) {
        								?>
        								<tr id="TextBoxDivUSPhone<?php echo $ref_count+1;?>">
        									<td>
        										<input value="" type="hidden" name="US_RowID[1]" >
        										<!--<input type="hidden" id="count6" value="2" > -->
        										<select  class="form-control phonevalidate hide" name="phonetype[1]" id="phonetype<?= $ref_count ?>">
        										    <option value="">Select Phone</option>
        										    <?php
        										      foreach($phonetypes as $pt)
        										      {
        										          ?>
        										          <option value="<?= $pt['Id'] ?>"><?= $pt['PhoneType'] ?></option>
        										          <?php
        										      }
        										    ?>
        										</select>
        															
        									</td>
        									
        									<td>	    
        										<input  class="USPhoneNumber phonevalidate phonetype form-control hide"  type="text" name="USPhoneNumber[1]"  id="USPhoneNumber<?php echo $ref_count+1;?>" rel_id="<?php echo $ref_count;?>">
        									</td>
        									
        									<td>
        									    	<input class="no_decimal form-control hide"  type="text" name="Extension[1]"  id="Extension<?php echo $ref_count+1;?>">
        									</td>
        									
        									<td> 
        										<input value="1" class="USActive" type="checkbox" name="USActive[1]" id="USstatus<?php echo $ref_count+1;?>" checked="true" disabled>
        									</td>
        									
        									
        								</tr>
        								<?php }	} ?>
        							</tbody>
        						</table>
        					</div>
        					
        					<div class="clearfix" style="float:right">
        						<div class="col-sm-12">
        						   <?php if($form_id != ''){  ?>
        							<span id="usphone_save" style="float: left;margin-left: 5px;" name= "submit" value="USPhone" class="btn btn-success hide1 waves-effect waves-light btn-xs m-b-5" >Save</span>
        						   <?php } ?>	
        							<!-- <a id="saveButtonEM" style="float: left;margin-left: 5px;" class="btn btn-success waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        									<span><strong>Save</strong></span>
        							</a> -->
        							<a id="addButtonUS" style="float: left;margin-left: 5px;" class="btn btn-info waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        								<span><strong>Add</strong></span>
        							</a>
        						
        							<a id="removeButtonUS" style="float: left;margin-left: 5px;" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        								<span><strong></strong></span>
        							</a>
        						</div>	
        					</div>
        					
        			</div>
        		</div>
        	 	<!-- End Prabhat 10-01-2021 -->
        	 	<div class="col-sm-12"><h4>Notes</h4></div>
                    <div class="col-md-12">
                        <div class="form-group no_border">
                            
                                <span class="show"><?php if(isset($infos['org_note'])){echo $infos['org_note'];}?></span>
                                <textarea class="form-control " name="organization_note" style="display:none !important"><?php if(isset($infos['org_note'])){echo $infos['org_note'];}?></textarea>
                            
                        </div>
                    </div>
        	 	
        
        	<div class="clearfix"></div>
        </div>
        <hr>
        
        <?php
         if($form_id != ''){
             ?>
              <div class="col-sm-12">
                  <h4>Organization Linked</h4>
                <div class="row">
                					
                    <div class="form-group no_border">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Organization Id</th>
                                            <th>Contact Id</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Active</th>
                                            <th>Primary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                            foreach($organizationUser as $org){
                                                ?>
                                                <tr>
                                                    <td><?= "O".$infos['id'] ?></td>
                                                    <td><?= $org['ID'] ?></td>
                                                    <td><?= $org['FirstName'] ?></td>
                                                    <td><?= $org['LastName'] ?></td>
                                                    <td><?= ($org['Valid'] == '1')?'Yes':'No' ?></td>
                                                    <td><?= ($org['primary_status'] == '1')?'Yes':'No' ?></td>
                                                </tr>
                                                <?php
                                            }
                                         ?>
                                     </tbody>
                                 </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
                
             
             <div class="col-sm-12">
                <h4>Individual Linked</h4>
                <div class="row">
                    <div class="form-group no_border">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                
                                 <table class="table table-striped table-bordered">
                                     <thead>
                                        <tr>
                                            <th>Contact Id</th>
                                            <th>First Name</th>
                                            <th>label</th>
                                            <th>Active</th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            foreach($individual_user as $org){
                                                ?>
                                                <tr>
                                                    <td><?= $org['name_id'] ?></td>
                                                    <td><?= $org['FirstName']." ".$org['LastName'] ?></td>
                                                    <td><?= $org['labeled_identify'] ?></td>
                                                    <td><?= ($org['valid'] == '1')?'Yes':'No' ?></td>
                                                </tr>
                                                <?php
                                            }
                                         ?>
                                     </tbody>
                                 </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
                
             <?php
         }
        ?>
       
        <?php if(session()->get('role') == '1' || in_array(3, session()->get('profiles'))){?>
                <div class="col-md-12 text-center">
                    <?php if($form_id == ''){ ?>
                    <button type="submit" name= "submit" class="btn btn-success" value="name">Save</button>
                    <?php }else{ ?>
        	            <span name= "submit" class="btn btn-success saveAllDataButton hide1" value="name">Save</span>
        	        <?php } ?>
        	    </div>
        	<?php } ?>
        
        <?php echo form_close();?>
	
	
		
	</div>
	
	<script>
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
                    
                    if (options.length > 3) {
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

CKEDITOR.replace( 'organization_note' ); 
	</script>