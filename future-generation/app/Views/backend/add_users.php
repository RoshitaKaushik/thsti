<?php //echo "<pre>";print_r($data);die;
	if(isset($details)){
		//echo "<pre>";print_r($details);die;
		$user_details = $details[0];
	}
 ?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->     
<style>
.panel-default>.panel-heading {
    color: #fffefe;
    background-color: #00BCD4;
    border-bottom: none;
}

.row.vr [class*='col-']:not(:last-child):after {
  background: #e0e0e0;
  width: 1px;
  content: "";
  display:block;
  position: absolute;
  top:0;
  bottom: 0;
  right: 0;
  min-height: 70px;
}
</style>                 
<div class="content-page">
<!-- Start content -->
<div class="content">
	<div class="container">
		<?php if(session()->getFlashdata('msg') !=''){ ?>
		<div class="alert alert-danger">
			<?php echo session()->getFlashdata('msg'); ?>
		</div>
		<?php } ?>
		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-6">
				<h4 class="pull-left page-title">Add New Users </h4>
			</div>
			<div class="col-sm-6">
				<h4 class="pull-right">
					<a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5">
						<i class="ion-arrow-left-a"></i>
						<span><strong>Go Back</strong></span>            
					</a>
				</h4>			
			</div>
		</div>
		

		<?php
           echo form_open_multipart("admin/Users/insertUser"); ?>
			<div class="row">
			<div class="alert alert-danger text-center" id="msg" style="display:none;"></div>
			<input  type="hidden"  name="form_type" value="<?php if(isset($user_details)){ echo 'UPDATE'; }else{ echo 'INSERT'; } ?>" required>
			<input  type="hidden"  name="update" value="<?php if(isset($user_details)){ echo encryptor('encrypt', $user_details['admin_id']); } ?>" >
				<!-- Basic  -->
				<div class="col-md-12">
					<div class="panel panel-info panel-color">
						<div class="panel-heading"><h3 class="panel-title">General Details</h3></div>
						<div class="panel-body">
							<div class="col-md-6">								
								<div class="form-group">
									<label for="USERS_FULL_NAME">User Full Name <span class="requires">*</span></label>
									<input class="form-control required" <?php if(session()->get('role') !=1){ echo "readonly"; } ?> type="text"  id="USERS_FULL_NAME" name="USERS_FULL_NAME" placeholder="Enter User Full Name" value="<?=set_value('USERS_FULL_NAME')?><?php if(isset($user_details)){ echo $user_details['admin_fullname']; } ?>" required>
								</div>	
								
								<div class="form-group">
									<label for="Email">Email <span class="requires">*</span><span style="color:red">(This Email-ID will be used as USER-ID)</span></label>
									<input  class="form-control required" type="email" <?php if(session()->get('role') !=1){ echo "readonly"; } ?>  id="EMAIL" name="EMAIL" placeholder="Enter Email" value="<?=set_value('EMAIL')?><?php if(isset($user_details)){ echo $user_details['admin_email']; } ?>"  required>
								</div>
											 					
								<?php if(session()->get('role') ==1){ ?>
								<div class="form-group">
									<label for="password">Password </label>
									<input class="form-control numeric" type="password"  id="password" name="password" placeholder="Enter Password" value="" readonly onfocus="this.removeAttribute('readonly');" >
								</div>
								<?php } ?>
								 <div class="form-group">
									<label for="Profileimage">Profile Image</label>
									<?php if(isset($user_details['profile_image']) && $user_details['profile_image']!='') {?>
									<a href="<?=base_url($user_details['profile_image'])?>" target="_blank">
									<span class="btn btn-info waves-effect waves-light btn-xs m-b-5">
									<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><span><strong>View</strong></span>
									</a>
									<?php } ?>
									<input type="hidden" name="profile_image_hid" value="<?php if(isset($user_details['profile_image']) && $user_details['profile_image']!=''){echo $user_details['profile_image'];}?>">											
									<input class="uploadfiles " id="profile_image" style = "padding:2px 12px" name="doc[profile_image]" type="file">
									<input type="hidden" name="docreq[profile_image][1]" value="2">
									<input type="hidden" name="docreq[profile_image][2]" value="img">
								</div>
								<div>
									<?php if(isset($user['profile_image'])){?>
									<img src="<?php echo base_url($user['profile_image']);?>" alt="user" style="width: 150px; position: absolute;display: block;top: 64px;border: 1px solid;right: 28px;"/>
									<?php }?>		
								</div>
								<!--User active Inactive Drop down added on Stephanie request on 16th May -->
								<?php if(session()->get('role') ==1){ ?>
								<div class="form-group">
									<label for="password">Account Status</label>
									<select name="account_status" class="form-control">
										<option value="">Select Account Status</option>
										<option value="1" <?php echo (isset($user_details['account_status'])==1 ? 'selected="selected"':'');?>>Active</option>
										<option value="0" <?php echo (isset($user_details['account_status'])==0 ? 'selected="selected"':'');?>>Inactive</option>
									</select>
								</div>
								
								<?php } ?>
								<div class="form-group">
									<input type="hidden" name="display_id" value="<?php echo (isset($user_details['admin_id'])); ?>">
									<label for="">Default Screen</label>
									<select name="display_screen" class="form-control">
										<option value="0">Select default display</option>
										<?php foreach ($display_option as  $display) {
										?>
										<option <?php  if($display['display_url']==$display_selected['display_url']){ echo "selected"; } ?> value="<?=$display['id']?>"><?=$display['display_name']?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="col-md-6">								
															
								
								
									
								
							</div>
						</div>	<!--                        panel-body                 -->
					
					</div> <!-- panel -->
				</div> <!-- col-->
				
			</div> <!-- row-->
			<?php if(session()->get('role') ==1){ ?>
			
			<div class="row">
				<!-- Basic example -->
				<div class="col-md-12">
					<div class="panel panel-info panel-color">
						<div class="panel-heading"><h3 class="panel-title">Role & Profiles Details</h3></div>
						<div class="panel-body">
							<div class="col-md-12">								
								
								<div class="form-group">
									<label for="Role">Select Role <span class="requires">*</span></label>
									
									<?php $kk=1; foreach($roles as $row) {?>
									 <input type='radio' id='custom_select<?= $kk++ ?>' name="roleid" class="roleid" value="<?=$row['roleid']?>" <?php if(set_value('roleid') == $row['roleid']){ echo 'checked';} ?> <?php if( isset($user_details) && $row['roleid'] == $user_details['role'] ){ echo "checked"; } ?> required/> <?=$row['role']?> &nbsp;&nbsp;&nbsp;
									<?php } ?>
									<!--<select class="form-control"  name="roleid" id="roleid"   required> <?=$row['role']?> &nbsp;&nbsp;&nbsp;
										
										<?php  foreach($roles as $row) {?>
										<option value="<?=$row['roleid']?>" <?php if(set_value('roleid') == $row['roleid']){ echo 'selected';} ?> <?php if( isset($user_details) && $row['roleid'] == $user_details['role']){ echo "selected"; } ?> ><?=$row['role']?></option>									
										<?php } ?>
									</select>-->
								</div>
							</div>	
								
							<div class="profile_select" style="display:none">
							<div class="col-md-12">
								<div class="form-group">
									<label for="Role">Choose Profiles <span class="requires">*</span></label>
								</div>
							</div>
							<?php
							$profiles = array();
							if( isset($user_details) && $user_details['role'] == 2){
								$profiles =  json_decode($user_details['profiles'], true);
							}
							//echo "<pre>"; print_r($_SESSION);echo "</pre>";
							$mm=1;
							$first_form = "false";
							$second_form = "false";
						   
							foreach($all_profile as $value){ 
							 
							 if( isset($user_details))
							 {
							     if( isset($profiles['profiles']))
							     { 
							         if (in_array(11, $profiles['profiles']))
							         {
							             $first_form = "true";
							             
							         }
							         if (in_array(12, $profiles['profiles']))
							         {
							             $second_form = "true";
							             
							         }
							         
							     } 
							 }
							?>
							<?php 
							
							    if($value['profile_id'] == '9' || $value['profile_id'] == '10') {
							        $swap = 'swapTime';
							    } else if($value['profile_id'] == '11' || $value['profile_id'] == '12') {
							        $swap = 'swapForm';
							    }
							?>
							<div class="col-md-6 <?= (isset($swap) && $swap) ? $swap : ''?>">
								<div class="form-group">
									<span class="button-checkbox" rel_id = "<?=$value['profile_id']?>">
										<button style="text-align: left;" type="button" class="btn btn-block" data-id = "<?=$value['profile_id']?>" data-color="success"> <?=$value['profile_name']?></button>
										<input type="checkbox" id='c_check<?= $mm++ ?>' name="profiles[]" data-id = "<?=$value['profile_id']?>" value="<?=$value['profile_id']?>"   class="hidden" <?php if( isset($user_details)){ if( isset($profiles['profiles'])){ if (in_array($value['profile_id'], $profiles['profiles'])){ echo "checked"; } } } ?>>
									</span>
								</div>
							</div>
							
							<?php } ?>	
							
							<!-- List Online Form For View-->
							<div <?php if($first_form == 'false'){ echo "style='display:none;'"; } ?>  class='form_list'>
							<div class='col-md-12'>
							    <hr style="height:2px;color:#ccc;background-color:#cccc;">
    							<div class="form-group">
    								<label for="online_form">Choose Online Form <span class="requires">*</span></label>
    							</div>
    						</div>
							<?php
					
							 foreach($form_list as $fl)
							 {
							     ?>
							        <div class="col-md-6">
        								<div class="form-group">
        									<span class="button-checkbox">
        									    <?php
        									     $colored='';
            									    if(isset($user_details))
            									      {
            									          if(getForms_by_user_hepler(isset($user_details['admin_id']),$fl['id'])=='exits')
            									          {
            									             $colored='checked'; 
            									          }
            									          else
            									          {
            									              $colored='';
            									          }
            									      }
            									   
            									    ?>
        										<button style="text-align: left;" type="button" class="btn btn-block" data-id = "<?=$fl['id']?>" data-color="success"> <?=$fl['scheme_component_name']?></button>
        										<input type="checkbox"  name="form[<?= $fl['id'] ?>]" data-id = "<?=$fl['id']?>" value="<?=$fl['id']?>"   class="hidden" <?php echo $colored; ?>>
        									</span>
        								</div>
        							</div>
							     <?php
							 }
							?>
							
							</div>


                            <!-- List Online Form For View-->
							<div <?php if($second_form == "false"){ echo "style='display:none;'"; } ?> class='form_list2'>
							<div class='col-md-12'>
							     <hr style="height:2px;color:#ccc;background-color:#cccc;">
    							<div class="form-group">
    								<label for="online_form">Choose Online Form For Edit Access <span class="requires">*</span></label>
    							</div>
    						</div>
							<?php
						
							 foreach($form_list as $fl)
							 {
							     ?>
							        <div class="col-md-6">
        								<div class="form-group">
        									<span class="button-checkbox">
        									    <?php
        									     $colored='';
            									    if(isset($user_details))
            									      {
            									          if(getFormsapproval_by_user_hepler(isset($user_details['admin_id']),$fl['id'])=='exits')
            									          {
            									             $colored='checked'; 
            									          }
            									          else
            									          {
            									              $colored='';
            									          }
            									      }
            									   
            									    ?>
        										<button style="text-align: left;" type="button" class="btn btn-block" data-id = "<?=$fl['id']?>" data-color="success"> <?=$fl['scheme_component_name']?></button>
        										<input type="checkbox"  name="approve_form[<?= $fl['id'] ?>]" data-id = "<?=$fl['id']?>" value="<?=$fl['id']?>"   class="hidden" <?php echo $colored; ?>>
        									</span>
        								</div>
        							</div>
							     <?php
							 }
							?>
							
							
							
							
							
							
							</div>		
							
								<div class="container mt-5">
                                <h2 class="mb-4">Permission Settings</h2>
                                
                                <div class="row g-4">
                                    <!-- Application Edit Form -->
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="edit_form" id="editForm" name="applicatant[]" />
                                            <label class="form-check-label" for="editForm">
                                              Application Edit Form
                                            </label>
                                        </div>
                                    </div>
                            
                                    <!-- View -->
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="view_permission" id="viewPermission" name="applicatant[]" />
                                            <label class="form-check-label" for="viewPermission">
                                              View Application
                                            </label>
                                        </div>
                                    </div>
                            
                                    <!-- Approve Applicant -->
                                    <div class="col-md-6">
                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="approve_applicant" id="approveApplicant" name="applicatant[]" />
                                        <label class="form-check-label" for="approveApplicant">
                                          Approve Applicant
                                        </label>
                                      </div>
                                    </div>
                            
                                    <!-- Status Change -->
                                    <div class="col-md-6">
                                      <div class="form-check">
                                        <input class="form-check-input" value="status_change" type="checkbox" id="statusChange" name="applicatant[]" />
                                        <label class="form-check-label" for="statusChange">
                                          Change Status
                                        </label>
                                      </div>
                                    </div>
                            
                                    <!-- Master Add -->
                                    <div class="col-md-6">
                                      <div class="form-check">
                                        <input class="form-check-input" value="master_add" type="checkbox" id="masterAdd" name="applicatant[]" />
                                        <label class="form-check-label" for="masterAdd">
                                          Master Add
                                        </label>
                                      </div>
                                    </div>
                                  </div>
							
							
							</div>	
							
						 
						</div>	<!-- panel-body -->
					
					</div> <!-- panel -->
				</div> <!-- col-->
				
			</div> <!-- row-->
			
			<?php } ?>
			
			<div class="row">
				<div class="col-md-12">	
				<hr>
					<div class="form-group text-center">
						<button class="btn btn-purple waves-effect waves-light m-b-5" onClick="return test_submit();" type="submit" style="padding-left: 40px;padding-right: 40px;margin-top: 10px;"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;  Save Details</button>
					</div>
				</div>
			</div>
			
			
		<?php echo form_close(); ?>
	</div> <!-- container -->                              
</div> <!-- content -->
<script>
function test_submit(){
	
	$('.required').each(function(){
		var value = $(this).val();
		if(value == '' || value.trim().length == 0){
			$(this).closest( ".form-group" ).addClass( "has-error" ); 
			$(this).focus();
			alert('Field '+$(this).attr('name')+' is required.');
			  //css( "background-color", "red" );
			  return false;
		}
	});
	
//	var roleid = $('.roleid').val();
  var roleid =  $("input[name='roleid']:checked").val();

	if(roleid == 2 || roleid == '2'){
		if($('[name="profiles[]"]:checked').length <= 0)
		{ 
			alert('Please select atleast one Profile');
			return false; 
		}
	}
	//return false; 
	
	
	
}
</script>
<script>


$(function(){
    if('<?= isset($user_details['role']) ?>' == 3)
    {
        $('#custom_select2').attr('checked','checked');
        $('.profile_select').show();
        $('#c_check9').attr('checked','checked');
        
    }
    $('.button-checkbox').each(function(){
		var $widget = $(this),
			$button = $widget.find('button'),
			$checkbox = $widget.find('input:checkbox'),
			color = $button.data('color'),
			settings = {
					on: {
						icon: 'glyphicon glyphicon-check'
					},
					off: {
						icon: 'glyphicon glyphicon-unchecked'
					}
			};

		$button.on('click', function () {
			$checkbox.prop('checked', !$checkbox.is(':checked'));
			$checkbox.triggerHandler('change');
			updateDisplay();
		});

		$checkbox.on('change', function () {
			updateDisplay();
		});

		function updateDisplay() {
			var isChecked = $checkbox.is(':checked');
			// Set the button's state
			$button.data('state', (isChecked) ? "on" : "off");

			// Set the button's icon
			$button.find('.state-icon')
				.removeClass()
				.addClass('state-icon ' + settings[$button.data('state')].icon);

			// Update the button's color
			if (isChecked) {
				$button
					.removeClass('btn-default')
					.addClass('btn-' + color + ' active');
			}
			else
			{
				$button
					.removeClass('btn-' + color + ' active')
					.addClass('btn-default');
			}
		}
		function init() {
			updateDisplay();
			// Inject the icon if applicable
			if ($button.find('.state-icon').length == 0) {
				$button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
			}
		}
		init();
	});
});
</script>


<script>
$(".roleid").click(function() {
	if($(this).val() == 2) {			
		$('.profile_select').show();
	}else{
		$('.profile_select').hide();
	}
});
</script>
<?php
	if( isset($user_details) && $user_details['role'] == 2){
?>
<script>
$(document).ready(function(){
	$('.profile_select').show();
});			
	

</script>
<?php
	}
?>



<script type="text/javascript">
$('form').on('submit',function(){
	var password=$('#password').val();
	if(password!=''){
	re_num = /[0-9]/;
	re_small_char = /[a-z]/;
	re_cap_char = /[A-Z]/;
	re_special =/[!#$%&'()*+,-.:;<=>?@[\]^_`{|}~]/;
	if(password.length < 8 || !re_num.test(password) || !re_small_char.test(password) || !re_cap_char.test(password) || !re_special.test(password)) {
		$('#msg').html('Password must contain at least 8 character and atleast 1 small character and atleast 1 capital character and atleast 1 special character');
		$('#password').val('');
		$('#msg').show();
	return false;
	}else {
		    $('#msg').hide();
			return true;
		}
	} else{
		return true;
	}
})
</script>


<script>
   // Function to swap nodes
   function swapNodes(node1, node2) {
       // create marker element and insert it where obj1 is
        var temp = document.createElement("div");
        node1.parentNode.insertBefore(temp, node1);
    
        // move obj1 to right before obj2
        node2.parentNode.insertBefore(node1, node2);
    
        // move obj2 to right before where obj1 used to be
        temp.parentNode.insertBefore(node2, temp);
    
        // remove temporary marker node
        temp.parentNode.removeChild(temp);
   }
   
   $(document).ready(function() {
      let swapTime = document.querySelectorAll('.swapTime'); 
      let swapForm = document.querySelectorAll('.swapForm');
      swapNodes(swapTime[0], swapTime[1]);
      swapNodes(swapForm[0], swapForm[1]);
   });
   
    $(document).on('click','.button-checkbox',function(){
        var rel_id = $(this).attr('rel_id');
        
        if(rel_id == '1' || rel_id == '3' || rel_id == '5' || rel_id == '7' || rel_id == '10') {
           let editDiv = this.closest('.col-md-6');
           let viewDiv = editDiv.nextElementSibling;
           let viewBtnCheck = viewDiv.querySelector('.button-checkbox');
           if(this.children[0].children[0].classList.contains('glyphicon-check')) {
               viewBtnCheck.children[0].children[0].className = 'state-icon glyphicon glyphicon-check';
               viewBtnCheck.children[0].className = 'btn btn-block btn-default';
               viewBtnCheck.children[0].style.background = '#d8d8d8';
               viewBtnCheck.children[0].disabled = true;
               viewBtnCheck.children[1].checked = true;
               if(rel_id == '12') {
                   viewBtnCheck.click();
               }
           } else if(this.children[0].children[0].classList.contains('glyphicon-unchecked')) {
               viewBtnCheck.children[0].children[0].className = 'state-icon glyphicon glyphicon-unchecked';
               viewBtnCheck.children[0].className = 'btn btn-block btn-default';
               viewBtnCheck.children[0].style.background = '';
               viewBtnCheck.children[0].disabled = false;
               viewBtnCheck.children[1].checked = false;
                if(rel_id == '12') {
                   viewBtnCheck.click();
               }
           }
        }
                
                    if(rel_id == 11){
                        $(".form_list").toggle(function(){
                            if($(".form_list").is(":visible")){
                               $('.form_list').show();
                            }
                            else{
                                 $('.form_list').hide();
                            }
                        });
                    }
                    
                    if(rel_id == 12){
                         $(".form_list2").toggle(function(){
                                if($(".form_list2").is(":visible")){
                                   $('.form_list2').show();
                                }
                                else
                                {
                                     $('.form_list2').hide();
                                }
                         });
                    }
                    
                  
                    
                   
                    
        
    })
</script>


<script>
    $(document).on('click','.button-checkbox',function(){
      var profile_id = $(this).attr('rel_id');
      var email = $('#EMAIL').val();
      var submit = "submit";
      if(profile_id == '9')
      {
          if ($('#c_check9').is(':checked')) 
          {
              
              	$.ajax({ 
				type: "POST", 
				dataType: "html",
				url: "<?=base_url()?>" + "admin/Users/profile_details",  
				data: {email: email,submit:submit}, 
				success: function(res){ 
				$('#status_detail').html(res);
				} 
			}); 
              
              
                $('#profile_detail').modal('show');
          }
          
      }
    })
</script>



<!-- Modal -->
  <div class="modal fade" id="profile_detail" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
           <span id="status_detail"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
