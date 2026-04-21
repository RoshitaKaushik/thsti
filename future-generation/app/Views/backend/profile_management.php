<?php //echo "<pre>";print_r($data);die; ?>
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

</style>                    
<div class="content-page">
<!-- Start content -->
<div class="content">
	<div class="container">
		<?php if (session()->getFlashdata('msg') && is_array(session()->getFlashdata('msg'))) { $msg = session()->getFlashdata('msg'); ?>
		<div class="uploadvesslelog alert <?php if($msg['status']){ echo 'alert-success';}else{ echo 'alert-danger';} ?>">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<?php print $msg['message']; ?>
		</div>
		<?php } ?>
		<?php session()->remove('msg'); ?>
		<div class="row">
			<div class="col-sm-12">
				<h4 class="pull-right">
					<a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
						<i class="ion-arrow-left-a"></i>
						<span><strong>Go Back</strong></span>            
					</a>
				</h4>
				<h4 class="pull-right" id="add-button">
					<a href="#" class="btn btn-success waves-effect waves-light m-b-5">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						<span><strong>Add New Profile</strong></span>            
					</a>
				</h4>
				<h4 class="pull-right" id="cancel-button" style="display:none">
					<a href="#" class="btn btn-danger waves-effect waves-light m-b-5">
						<i class="fa fa-times" aria-hidden="true"></i>
						<span><strong>Cancel</strong></span>            
					</a>
				</h4>
			</div>
		</div>
		
	<div id="form-div" style="display:none;">	
		
		<?php 
		$attr = array("id"=> "Profilelist");
		echo form_open('admin/Users/addUpdate_profile', $attr) ?>
		<div class="row" id="edit-screen">
			<div class="col-md-offset-1 col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">CREATING NEW PROFILE</h3>
					</div>
					<div class="panel-body">
						
						<input id="form_type" name="form_type" value="0" type="hidden">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group required">
									<label for="Role" class="control-label">Profile Name :</label>
									<input autocomplete="off" type="text" id="profile_name" name="profile_name" 
									class="form-control " placeholder="Enter Profile Name" required readonly onfocus="this.removeAttribute('readonly');"  />
								</div>
								
								<div class="form-group required">
									<label  class="control-label">Select Schemes :</label>
								</div>

							</div>
						</div>
						
					
	<?php $schemes = getScheme();
		//echo "<pre>"; print_r($schemes); echo "</pre>"; die;
		$i=1;
		foreach($schemes as $value){
			/*if(($i%2) != 0){*/ echo '<div class="row" id="">'; //}
	?>	
			
			<div class="col-md-offset-0 col-md-12" style="margin-bottom: 30px;">
				<div class="panel panel-default">
					<div class="panel-heading specialpanel-heading" style="padding:0" data-id = "<?=$value['scheme_id']?>" >
						<span class="button-checkbox">
							<button style="text-align: left;" type="button" class="btn btn-block" data-id = "<?=$value['scheme_id']?>" data-color="success"> <?=$value['scheme_name']?></button>
							<input type="checkbox" name="scheme[]" id="scheme-<?=$value['scheme_id']?>" data-id = "<?=$value['scheme_id']?>" value="<?=$value['scheme_id']?>" data-childclass="<?=$value['scheme_id']?>"  class="parent hidden">
						</span>
					</div>
					<div class="panel-body specialpanel-body" style="padding: 20px 5px 20px 5px;     border: 1px solid #33b86c; display:none" id="panel_body<?=$value['scheme_id']?>">
						<div class="form-group required">
							<label  class="control-label">Select Scheme's Components :</label>
						</div>
						
						<div id="scheme_comp_details<?=$value['scheme_id']?>"></div>
							<?php 
								$components = get_components($value['scheme_id']);
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
												<input type="checkbox" name="component[<?=$value['scheme_id']?>][<?=$value2['id']?>]" id="component-<?=$value2['id']?>" data-id = "<?=$value2['id']?>" value="<?=$value2['id']?>"   class="child-<?=$value['scheme_id']?> hidden">
											</span>
										</div>
										<div class="panel-body" style="padding: 10px 2px 10px 2px; display:none;" id="childpanel_body<?=$value2['id']?>">
											<div class="form-group required">
												<label class="control-label">Privilege : </label>
												
												
												<?php foreach($buttons as $btkey=>$btvalue){
												
												?>
													<div class="checkbox checkbox-success" style="display:inline-block;padding-top: 10px; padding-bottom: 10px;">
														<input class="access-<?=$value2['id']?>" value="<?=$btvalue['button_id']?>" <?php //if (in_array($btvalue['button_id'], $values['buttons'])){ echo "checked"; } ?>  type="checkbox" name="accesslevel[<?=$value['scheme_id']?>][<?=$value2['id']?>][]">
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
														<option value="<?=$ii?>">Level-<?=$ii?></option>	
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
	


	<div class="row" id="table-div">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">All Profiles</h3>
				</div>
				<div class="panel-body">
					<table class="" border="1" cellpadding="2" style="width:100%">
						<thead>
						  <tr style="height: 30px; background-color: #eae9e9;">
							<th>Sr.</th>
							<th>Profile Name</th>
							<th>Action</th>
						  </tr>
						</thead>
						<tbody>				
						<?php //$schemes = getScheme();
							//echo "<pre>"; print_r($schemes); echo "</pre>"; die;
							$i=1;
							foreach($all_profile as $value){
																		
						?>							
							<tr>
								<td ><?=$i?>.</td>
								<td><?=$value['profile_name']?></td>	
								<td> <a href="<?php echo base_url('admin/Users/addUpdate_profile/'.encryptor('encrypt', $value['profile_id'])); ?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5">
										<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
										<span><strong>Edit</strong></span>            
									</a>
								</td>
							</tr>	
						<?php
							$i++;
							}
						?>	

						</tbody>
					</table>
				</div>
			</div>
		</div>
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
$(document).on('click','#add-button',function(){
	$('#form-div').show();
	$('#table-div').hide();
	$(this).hide();
	$('#cancel-button').show();
});
$(document).on('click','#cancel-button',function(){
	$('#form-div').hide();
	$('#table-div').show();
	$(this).hide();
	$('#add-button').show();
});
</script>

<script>

function test_submit() {

	var profile_name = $('#profile_name').val();

	if(profile_name == '' || profile_name.trim().length == 0) {
		alert('Please enter the profile name.');		
		$('#profile_name').focus();
		return false;
	}
	if($('[name="scheme[]"]:checked').length <= 0)
	{ 
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
			var access_name = '.accesslevel-'+scheme_data_id;
			//alert(class_name2);
			if($('input:checkbox.'+class_name+':checked').length <= 0)
			{ 				
				validate++;
				return false; 
			}
			
			
			
			$(class_name2).each(function(){
				if(this.checked) {
					var comp_data_id = $(this).attr('data-id');
										
					if($('.access-'+comp_data_id+':checkbox:checked').length <= 0)
					{ 
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
		alert("Please select Privilege of the selected scheme's component.");
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
				$button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
			}
		}
		init();
	});
});
</script>

<script>
	/* $(document).on('change', 'input:checkbox', function() {
		 if(this:checked) {
				alert('change detected');
			}
		
	}); */
	
   // $("input[type='checkbox']").change(function() { .attr()
$(function() { 
	$(".component").change(function() {
		if(this.checked) {
			var scheme_id = $(this).attr('data-id');
			//alert(data_id);
			$.ajax({
			    type: "POST",
                url: '<?php echo base_url('admin/Scheme/get_components');?>',
                data: {'scheme_id':scheme_id},
				dataType: "json",
				success: function(data){
					//console.log(data.length);
					var item = data; //.items
					$.each(item.items, function(index,item) {        
						console.log(item.scheme_component_name+" "+item.id);
					});
					/*console.log(data.status);
					if(data.status == true){
						$('#otp_block').show();
						$("#reg_otp").attr("readonly", false);
						$('#reg_otp').focus();
						$('#genrate_otp_btn').hide();
						$('#final_submit_btn').show();
						alert(data.message);
						
					}else{
						 if(data.errcode == 100){
							$("#mobilenumber").attr("readonly", false);
							$("#mobilenumber").focus();
							alert(data.message);
						}else if(data.errcode == 101){
							$("#reload_captcha")[0].click();
							$("#captcha").attr("readonly", false);
							$("#captcha").focus();
							alert(data.message);
						}else if(data.errcode == 103){
							$("#mobilenumber").attr("readonly", false);
							$("#mobilenumber").focus();
							alert(data.message);
						} 
					} */
                },
			}); 
		}else{
				
		}
    })
})
	
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