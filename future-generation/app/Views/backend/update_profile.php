<?php  
//echo "<pre>";print_r($id_details); 
	foreach($id_details as $id_key => $id_value){
		$profile_id = encryptor('encrypt', $id_value['profile_id']);
		$profile_name = $id_value['profile_name'];
		$profile_data = json_decode($id_value['profile_data'], true);
	}
	foreach($profile_data as $profile_key => $profile_value){
		$scheme_id[] = $profile_value['scheme_id'];
		$component_id[$profile_value['scheme_id']] = $profile_value['component_id'];
		$accesslevel[$profile_value['scheme_id']] = $profile_value['accesslevel'];
	}
	//echo "<pre>";print_r($scheme_id);print_r($component_id);print_r($accesslevel);die;
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->  
<style>
.form-group.required .control-label:after {
    content:"*";
    color:red;
}
.checkbox, .radio {
    position: relative;
    display: block;
    margin-top: 0px;
    margin-bottom: 0px;
}
td {
    padding: 3px;
    vertical-align: middle;
}
.colorgraph {
    height: 5px;
    border-top: 0;
    background: #c4e17f;
    border-radius: 5px;
    background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
    background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
    background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
    background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
}
</style>                    
<div class="content-page">
<!-- Start content -->
<div class="content">
	<div class="container">
		<?php if (session()->getFlashdata('msg')) { $msg = session()->getFlashdata('msg'); ?>
		<div class="uploadvesslelog alert <?php if($msg['status']){ echo 'alert-success';}else{ echo 'alert-danger';} ?>">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<?php print $msg['message']; ?>
			<?php session()->remove('msg'); ?>
		</div>
		<?php } ?>
		<!-- Page-Title 
		<div class="row">
			<div class="col-sm-12">
				<h4 class="pull-left page-title"></h4>			
			</div>
		</div> -->
	<div class="row">
		<div class="col-sm-12">
			<h4 class="pull-right">
				<a href="<?php echo base_url('admin/users/profile_management'); ?>" class="btn btn-success waves-effect waves-light m-b-5">
					<i class="ion-arrow-left-a"></i>
					<span><strong>Go Back</strong></span>            
				</a>
			</h4>			
		</div>
	</div>
	<div id="form-div">	
		
		<?php 
		$attr = array("id"=> "Profilelist");
		echo form_open('admin/Users/addUpdate_profile', $attr) ?>
		<input type="hidden" name="update" value="<?php echo $profile_id; ?>" />
		<div class="row" id="edit-screen">
			<div class="col-md-offset-1 col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">UPDATING PROFILE</h3>
					</div>
					<div class="panel-body">
						
						<input id="form_type" name="form_type" value="0" type="hidden">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group required">
									<label for="Role" class="control-label">Profile Name :</label>
									<input autocomplete="off" type="text" id="profile_name" name="profile_name" value="<?=$profile_name?>"
									class="form-control " placeholder="Enter Profile Name" required readonly onfocus="this.removeAttribute('readonly');"  />
								</div>
								
								<div class="form-group required">
									<label  class="control-label">Select Modules :</label>
								</div>

							</div>
						</div>
						
					
	<?php $schemes = getScheme();
	    
	     
	
	//	echo "<pre>"; print_r($schemes); echo "</pre>"; die;
		$i=1;
		foreach($schemes as $value){
			/*if(($i%2) != 0){*/ echo '<div class="row" id="">'; //}
	?>	
			
			<div class="col-md-offset-0 col-md-12" style="margin-bottom: 30px;">
				<div class="panel panel-default">
					<div class="panel-heading specialpanel-heading" style="padding:0" data-id = "<?=$value['scheme_id']?>" >
						<span class="button-checkbox">
							<button style="text-align: left;" type="button" class="btn btn-block" data-id = "<?=$value['scheme_id']?>" data-color="success"> <?=$value['scheme_name']?></button>
							<input type="checkbox" name="scheme[]" id="scheme-<?=$value['scheme_id']?>" data-id = "<?=$value['scheme_id']?>" value="<?=$value['scheme_id']?>" <?php if (in_array($value['scheme_id'], $scheme_id)){ echo "checked"; } ?> data-childclass="<?=$value['scheme_id']?>"  class="parent hidden">
						</span>
					</div>
					<div class="panel-body specialpanel-body" style="padding: 20px 5px 20px 5px;     border: 1px solid #33b86c; display:none" id="panel_body<?=$value['scheme_id']?>">
						<div class="form-group required">
							<label  class="control-label">Select Modules's Components :</label>
						</div>
						
						<div id="scheme_comp_details<?=$value['scheme_id']?>"></div>
							<?php 
								$components = get_components($value['scheme_id']);
								
								if(encryptor('decrypt', service('uri')->getSegment(4)) == "13" ){
                        	         $components = array();
                        	     }
								
								//print_r($components); die;
								$j = 1;
								foreach($components as $value2){
									/*if(($j%2) != 0){*/ echo '<div class="row" id="">'; //}
							?>
								
								<div class="col-md-offset-0 col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading specialchildpanel-heading" data-id = "<?=$value2['id']?>" style="padding:0" >
											<span class="button-checkbox">
												<button style="text-align: left;" type="button" class="btn btn-block" data-id = "<?=$value2['id']?>" data-color="success"> <?=$value2['scheme_component_name']?></button>
												<input type="checkbox" name="component[<?=$value['scheme_id']?>][<?=$value2['id']?>]" id="component-<?=$value2['id']?>" data-id = "<?=$value2['id']?>" value="<?=$value2['id']?>" <?php if(isset($component_id[$value['scheme_id']])){ if (in_array($value2['id'], $component_id[$value['scheme_id']])){ echo "checked"; } } ?>   class="child-<?=$value['scheme_id']?> hidden">
											</span>
										</div>
										<div class="panel-body" style="padding: 10px 2px 10px 2px; display:none;" id="childpanel_body<?=$value2['id']?>">
											<div class="form-group required">
												<label class="control-label">Privilege : </label>
												
												
												<?php foreach($buttons as $btkey=>$btvalue){
													//echo "value2".$value2['id'];
												//echo "<pre>";print_r($accesslevel);die;
												?>
													<div class="checkbox checkbox-success" style="display:inline-block;padding-top: 10px; padding-bottom: 10px;">
														<input id="check_id<?=$value2['id']?><?=$btvalue['button_id']?>" rel_id="<?=$value2['id']?>" class="edit_checkbox access-<?=$value2['id']?>" value="<?=$btvalue['button_id']?>" <?php 
														//echo $accesslevel[$value['scheme_id']][$value2['id']];die;
														if(isset($accesslevel[$value['scheme_id']][$value2['id']])){
															
														if (in_array($btvalue['button_id'], $accesslevel[$value['scheme_id']][$value2['id']])){ echo "checked"; } } ?>  type="checkbox" name="accesslevel[<?=$value['scheme_id']?>][<?=$value2['id']?>][]">
														<label> <?=$btvalue['button_name']?>&nbsp;&nbsp; </label>
													</div>
													<?php
													 }
													?>
												
												<!--<select class="form-control" name="accesslevel[<?=$value['scheme_id']?>][<?=$value2['id']?>]" id="accesslevel-<?=$value['scheme_id']?>-<?=$value2['id']?>" >
													<option value="0">-- Select Level--</option>
												<?php 
													$maxlevel = get_processLevelOfScheme($value['scheme_id'],$value2['id']);
													if(!empty($maxlevel)){
														for($ii=1; $ii <= $maxlevel[0]['max_level'];$ii++){
												?>
														<option value="<?=$ii?>" <?php if(isset($accesslevel[$value['scheme_id']][$value2['id']])){ if ($accesslevel[$value['scheme_id']][$value2['id']] == $ii ){ echo "selected"; } } ?> >Level-<?=$ii?></option>	
												<?php 
														}
													}
												?>
												
												</select> -->
												<?php
													/* if(empty($maxlevel)){
														echo '<p>No access level added to this component. Click <a style="text-decoration: underline;"  href="'.base_url('admin/users/addupdate_scheme_level').'"><b>here</b></a> to add </p>';
													} */
												?>
											</div>
										
											
										</div>
									</div>
								</div>
								
							<?php
							/*if(($j%2) == 0){ */ echo '</div>';//}		
							$j++;	}
							?>
						    <?php if(encryptor('decrypt', service('uri')->getSegment(4)) == "1" || encryptor('decrypt', service('uri')->getSegment(4)) == "2" ||
						    encryptor('decrypt', service('uri')->getSegment(4)) == "7" || encryptor('decrypt', service('uri')->getSegment(4)) == "8") : ?>
						    
						    <div class="col-md-offset-0 col-md-12" style="padding: 0;">
						        <?php 
						            $report_list = getReports(7);
						            $check_if_report_list = checkIfReportForRegistrar(encryptor('decrypt', service('uri')->getSegment(4)), 7);
						            if($check_if_report_list) {
						                $checked = 'checked';
						            } else {
						                $checked;
						            }
						            
						        ?>
									<div class="panel panel-default">
										<div class="panel-heading specialchildpanel-heading" style="padding:0;" >
											<span class="button-checkbox" id="report_assignment">
												<button style="text-align: left;" type="button" class="btn btn-block" data-color="success">Reports</button>
												<input type="checkbox" class="hidden" <?=$checked?>>
											</span>
										</div>
										<div class="panel-body" style="padding: 10px 2px 10px 2px; display:none;" id="report_list">
											<div class="form-group required">
												<label class="control-label">Privilege : </label>
												
												<?php foreach($report_list as $rl):?>
												<?php 
											
												    if(getReportMenu_by_profile_helper(encryptor('decrypt', service('uri')->getSegment(4)), $rl['display_id'], '7')) {
												        
												        $checked = 'checked';
												    } else {
												        
												        $checked = '';
												    }
												?>
												<div class="checkbox checkbox-success"  style="display:inline-block;padding-top: 10px; padding-bottom: 10px;">
													<input <?=$checked?> type="checkbox" name="report_menu[<?=$rl['display_id']?>]" value="<?=$rl['display_id']?>">
													<label> <?=$rl['child_name']?>&nbsp;&nbsp; </label>
												</div>
        										
    										
												<?php endforeach; ?>
												
											
											
											</div>
										
											
										</div>
									</div>
								</div>
								<?php endif; ?>
						    
						    <?php if(encryptor('decrypt', service('uri')->getSegment(4)) == "13" ) : ?>
						    
						    <div class="col-md-offset-0 col-md-12" style="padding: 0;">
						        <?php 
						            $report_list = getReports(35);
						            $select_time_edit = false;
						            
						            $check_if_report_list = checkIfReportForRegistrar(encryptor('decrypt', service('uri')->getSegment(4)), 35);
						            if($check_if_report_list) {
						                $checked = 'checked';
						                $select_time_edit = true;
						            } else {
						                $checked = "";
						            }
						            
						        ?>
									<div class="panel panel-default">
										<div class="panel-heading specialchildpanel-heading" style="padding:0;" >
											<span class="button-checkbox" id="timeEdit_assignment">
												<button style="text-align: left;" type="button" class="btn btn-block" data-color="success" data-id="TimeEdit01">Timesheet</button>
												<input type="checkbox" class="hidden child-<?=$value['scheme_id']?>" <?=$checked?> name="timesheet_scheme[]" value="timesheet" data-childclass="TimeEdit01" data-id="TimeEdit01" >
											</span>
										</div>
										<div class="panel-body" style="padding: 10px 2px 10px 2px; <?php if(!$select_time_edit){ ?> display:none;" <?php } ?> id="time_list">
											<div class="form-group required">
												<label class="control-label">Privilege :</label>
												
												<?php foreach($report_list as $rl):?>
												<?php 
												$checked = "";
                                                if(getMenu_by_profile_helper(encryptor('decrypt', service('uri')->getSegment(4)), $rl['id'], '35')) {
                                                    $checked = 'checked';
                                                } else {
                                                    $checked = '';
                                                }
												$get_access_by_profile_id = get_access_by_profile_id(encryptor('decrypt', service('uri')->getSegment(4)),$rl['id'],'35');
												$add_selected = $edit_selected = $excel_selected = $print_selected = "";
												if(!empty($get_access_by_profile_id)){
												    $get_access_by_profile_id = $get_access_by_profile_id[0];
												    if($get_access_by_profile_id['add_button'] == '1'){
												        $add_selected = 'checked';
												    }
												    if($get_access_by_profile_id['edit_button'] == '1'){
												        $edit_selected = 'checked';
												    }
												    if($get_access_by_profile_id['excel_button'] == '1'){
												        $excel_selected = 'checked';
												    }
												    if($get_access_by_profile_id['print_button'] == '1'){
												        $print_selected = 'checked';
												    }
												}
												?>
												<br>
												<div class="checkbox checkbox-success" style="display:inline-block;padding-top: 10px; padding-bottom: 10px;">
													<input <?=$checked?> type="checkbox" name="time_edit[]" value="<?=$rl['id']?>" class="child-TimeEdit01 access-TimeEdit01" rel_id="<?=$rl['id']?>">
													<label> <?=$rl['child_name']?>&nbsp;&nbsp; </label>
												</div>
												<div class="col-md-12">
												    <div class="col-md-2" style="<?php if($rl['add_show_in_profile_mgmt'] != '1'){ echo 'display:none'; } ?>">
												         <div class="checkbox checkbox-success" style="display:inline-block;padding-top: 10px; padding-bottom: 10px;">
												            <input <?= $add_selected ?> <?php if($checked != 'checked'){ echo "disabled"; } ?> type="checkbox" class="time_edit_sub_part<?=$rl['id']?>"  name="sub_time_edit[<?=$rl['id']?>][]" value="0"> <label>Add</label>
												         </div>
												    </div>
												    <div class="col-md-2" style="<?php if($rl['edit_show_in_profile_mgmt'] != '1'){ echo 'display:none'; } ?>">
												        <div class="checkbox checkbox-success" style="display:inline-block;padding-top: 10px; padding-bottom: 10px;">
												            <input <?= $edit_selected ?> <?php if($checked != 'checked'){ echo "disabled"; } ?> type="checkbox" class="time_edit_sub_part<?=$rl['id']?>"  name="sub_time_edit[<?=$rl['id']?>][]" value="1"> <label>Edit</label>
												        </div>
												    </div>
												    <div class="col-md-2" style="<?php if($rl['excel_show_in_profile_mgmt'] != '1'){ echo 'display:none'; } ?>">
												        <div class="checkbox checkbox-success" style="display:inline-block;padding-top: 10px; padding-bottom: 10px;">
												            <input <?= $excel_selected ?> <?php if($checked != 'checked'){ echo "disabled"; } ?> type="checkbox" class="time_edit_sub_part<?=$rl['id']?>"  name="sub_time_edit[<?=$rl['id']?>][]" value="2"> <label>Export Excel</label>
												        </div>
												    </div>
												    <div class="col-md-2" style="<?php if($rl['print_show_in_profile_mgmt'] != '1'){ echo 'display:none'; } ?>">
												        <div class="checkbox checkbox-success" style="display:inline-block;padding-top: 10px; padding-bottom: 10px;">
												            <input <?= $print_selected ?> <?php if($checked != 'checked'){ echo "disabled"; } ?> type="checkbox" class="time_edit_sub_part<?=$rl['id']?>"  name="sub_time_edit[<?=$rl['id']?>][]" value="3"> <label>Print</label>
												        </div>
												    </div>
												    
												</div>
        										
    										
												<?php endforeach; ?>
												
											
											
											</div>
										
											
										</div>
									</div>
								</div>
								<?php endif; ?>
						    
						    
					<hr class="colorgraph">
					
					</div>
				</div>
			</div>
		
		
	<?php 
		/*if(($i%2) == 0){ */ echo '</div>';//}
	$i++;	}
	?>	
					<div class="form-group" style="text-align: center;">
						<button class="btn btn-purple waves-effect waves-light m-b-5" onClick="return test_submit();" type="submit"><i class="fa fa-save"></i> Save Profile</button>
					</div>
			
						<hr class="colorgraph">
					</div> <!-- panel body -->
				</div> <!-- panel -->
			</div> <!-- column -->
			
		</div> <!-- End Row -->	
		
		<?php echo form_close(); ?>
		</div>
	

	
	</div> <!-- container -->                              
</div> <!-- content -->
<div id="errorModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="border-radius: 0;">
<div class="modal-dialog">
	<div class="modal-header" style="text-align: center;background-color: rgb(245, 74, 62);color: #fff; padding: 5px;">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 style="color: #fff;" id="myModalLabel">Error Occured</h3>
	</div>
	<div class="modal-body" style=" color: #f54a3e; background: #fff;min-height: 100px;font-weight: 800;"></div>
	<div class="modal-footer" style="display: none;">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
	</div>
</div>

<script type="text/javascript">
(function() {
  var proxied = window.alert;
  window.alert = function() {
    $("#errorModal .modal-body").text(arguments[0]);
    $("#errorModal").modal('show');
  };
})();
</script>



<script>

$(document).on('click','.edit_checkbox',function(){
    var data = $(this).val();
    var rel_id = $(this).attr('rel_id');
    var custum_class = '.access-'+rel_id;
    var val = 4;
    if(data == 2)
    {
        if($(this).prop("checked") == true){
            $("#check_id"+rel_id+val). prop("checked", true);
            $("#check_id"+rel_id+val).css('pointer-events','none');
        }
        else if($(this).prop("checked") == false){
           $("#check_id"+rel_id+val). prop("checked", false);
           $("#check_id"+rel_id+val).css('pointer-events','');
        }
    }
    
        
})

function test_submit() {
    
	var profile_name = $('#profile_name').val();
	if(profile_name == '' || profile_name.trim().length == 0) {
		alert('Please enter the profile name.');		
		$('#profile_name').focus();
		return false;
	}
	if($('[name="scheme[]"]:checked').length <= 0 && $('[name="timesheet_scheme[]"]:checked').length <= 0){ 
		alert('Please select atleast one scheme');
		return false; 
	}
	var validate = 0;
	var count = 0;
	$('.parent').each(function(){
		if(this.checked) {
			var scheme_data_id = $(this).attr('data-id');
			var class_name = 'child-'+scheme_data_id;
			var class_name2 = '.child-'+scheme_data_id;
			//alert(class_name2);
			if($('input:checkbox.'+class_name+':checked').length <= 0){ 				
				validate++;
				return false; 
			}
			
			$(class_name2).each(function(){
				if(this.checked) {
				    console.log(class_name2)
					var comp_data_id = $(this).attr('data-id');
					console.log("Prabhattttttttttttttttttttttttttt",comp_data_id)
					
					console.log($('.access-'+comp_data_id+':checkbox:checked').length)
										
					if($('.access-'+comp_data_id+':checkbox:checked').length <= 0){ 
						count++;
						return false;
					}
				}
				
			});
			if(count > 0){				
				return false;
			}
		}
	});
	if(validate > 0){
		alert('Please select atleast one component of the selected  scheme.');
		return false;
	}
	if(count > 0){
		alert("Please select access level  of the selected scheme's component.");
		return false;
	}

	
}
</script> 
<script>

$(function(){
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
					.removeClass('btn-info')
					.addClass('btn-' + color + ' active');
			}
			else
			{
				$button
					.removeClass('btn-' + color + ' active')
					.addClass('btn-info');
			}
		}
		function init() {
			updateDisplay();
			// Inject the icon if applicable
			if ($button.find('.state-icon').length == 0) {
				$button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i>');
			}
		}
		init();
	});
});
</script>


<script>
function updateDisplay2(child_class) {
	$(child_class).each(function(){
		var $widget = $(this),
			$button = $widget.closest('.button-checkbox').find('button'),
			color = $button.data('color'),
			settings = {
					on: {
						icon: 'glyphicon glyphicon-check'
					},
					off: {
						icon: 'glyphicon glyphicon-unchecked'
					}
			};
			var isChecked = $(this).is(':checked');
			// Set the button's state
			console.log($button.data('state', (isChecked) ? "on" : "off"));

			// Set the button's icon
			$button.find('.state-icon')
				.removeClass()
				.addClass('state-icon ' + settings['off'].icon);

			// Update the button's color
			if (isChecked) {
				$button
					.removeClass('btn-info')
					.addClass('btn-' + color + ' active');
			}
			else
			{
				$button
					.removeClass('btn-' + color + ' active')
					.addClass('btn-info');
			}
		});
}
$(document).ready(function(){
    $(".specialpanel-heading").click(function(){
		if($(this).find('.parent').is(':checked'))
		{
			//alert('checked');
		}else{
			var child_class_val = $(this).attr('data-id');
			var child_class = '.child-'+child_class_val;
			//alert(child_class_val);
			$(child_class).prop("checked", false);
			updateDisplay2(child_class);
			//$(child_class).addClass("Clicked");
		}
		var body_id = $(this).attr('data-id'); 
		var panel_body_id = '#panel_body'+body_id;
        $(panel_body_id).toggle();
    });
});

</script>
<script>
$(".parent").change(function() {
	if($(this).is(':checked')) {			
		
	}else{
		var child_class_val = $(this).attr('data-childclass');
		var child_class = '.child-'+child_class_val;
		//alert(child_class_val);
		$(child_class).prop("checked", false);
		$(child_class).each(function(){
			var body_id2 = $(this).attr('data-id'); 
			var panel_body_id2 = '#childpanel_body'+body_id2;
			$(panel_body_id2).hide();
		});
		//alert('a'+$(child_class).attr("data-id"));
		
	}
});
</script>

<script>
$(document).ready(function(){
    $(".specialchildpanel-heading").click(function(){
		var body_id = $(this).attr('data-id'); 
		var panel_body_id = '#childpanel_body'+body_id;
        $(panel_body_id).toggle();
    });
});

</script>
<script>
$('.parent').each(function(){
	if(this.checked) {
		var body_id = $(this).attr('data-id'); 
		var panel_body_id = '#panel_body'+body_id;
        $(panel_body_id).show();
		
		var child_class_val = $(this).attr('data-childclass');
		var child_class = '.child-'+child_class_val;
		//alert(child_class_val);
		$(child_class).each(function(){
			if(this.checked) {
				var body_id2 = $(this).attr('data-id'); 
				var panel_body_id2 = '#childpanel_body'+body_id2;
				$(panel_body_id2).show();
			}
		});
	}
});
</script></script>
<script>

$(document).ready(function() {
    let report_assignment = document.querySelector('#report_assignment');
    if(report_assignment.children[1].checked) {
         document.querySelector('#report_list').style.display = "block";
    } else {
         document.querySelector('#report_list').style.display = "none";
    }
    
    let timeEdit_assignment = document.querySelector('#timeEdit_assignment');
    
    if(timeEdit_assignment.children[1].checked) {
         document.querySelector('#time_list').style.display = "block";
    } else {
         document.querySelector('#time_list').style.display = "none";
    }
    
});



$(document).on('click','.button-checkbox',function(){
    var icon = this.firstElementChild.firstElementChild;
    var id = "";
    if(this.id) {
        id = this.id;
    }
   
    // check paragraph once toggle effect is completed
    if(id == "report_assignment")
    {
         if(icon.classList.contains("glyphicon-unchecked")) {
             document.querySelector('#report_list').style.display = "none";
         } else if(icon.classList.contains('glyphicon-check')) {
             document.querySelector('#report_list').style.display = "block";
         }
    }
    
    if(id == "timeEdit_assignment")
    {
         if(icon.classList.contains("glyphicon-unchecked")) {
             document.querySelector('#time_list').style.display = "none";
         } else if(icon.classList.contains('glyphicon-check')) {
             document.querySelector('#time_list').style.display = "block";
         }
    }
    
    
});


$(document).on('click','.child-TimeEdit01',function(){
    let rel_id = $(this).attr('rel_id');
    if(!$(this).is(':checked')){
        $('.time_edit_sub_part'+rel_id).attr('disabled','disabled');
    }
    else{
        $('.time_edit_sub_part'+rel_id).removeAttr('disabled');
    }
   
    
})
</script>