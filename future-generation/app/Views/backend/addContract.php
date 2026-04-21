<?php //echo "<pre>";print_r($data);die;


$add_permission = $edit_permission = $excel_permission = $print_permisson =  false;

if(session()->get('profiles')){
	if(in_array(1, session()->get('profiles'))){
		$add_permission = $edit_permission = $excel_permission = $print_permisson = true;
	}
	if(in_array(13, session()->get('profiles'))){
		$permissions = getPermissionDetails('13','36','35');
		if(!empty($permissions)){
		    if($permissions[0]['add_button'] == '1'){
		        $add_permission = true;
		    }
		    if($permissions[0]['edit_button'] == '1'){
		        $edit_permission = true;
		    }
		    if($permissions[0]['excel_button'] == '1'){
		        $excel_permission = true;
		    }
		    if($permissions[0]['print_button'] == '1'){
		        $print_permisson = true;
		    }
		}
	}
}
if(session()->get('role') == 1){
	$add_permission = $edit_permission = $excel_permission = $print_permisson = true;
}
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                 
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
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
    margin: -28px 0 0 -25px;
} 

.tab_btn_gourp{
    left: 30px;
    z-index: 99;
}
.view_type_button{
    background-color: #fafafa;
    color: rgba(0,0,0,0.6) ! important;
    font-size: 14px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    -webkit-box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
    -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
    box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
    border: 1px solid rgb(171, 167, 167);
    box-shadow: none;
}
button.btn.view_type_button.active{
    background:#d1f1fa !important;
}
.hide_li{
    top:0px ! important;
    margin-left: 43px;
   
}
.hide_li a{
    padding:9px !important;
    border: 1px solid #c3c1c1;
    border-radius: 3px;
}
ul.list_field li{
    font-weight:normal;
}
.hide_ul li.text-center.notifi-title
{
    font-size:14px;
}
</style>     
<div class="content-page">
<!-- Start content -->
	<div class="content">
		<div class="container">
			<?php if(session()->getFlashdata('msg') !=''){
				$btn = 'success';
				if(session()->getFlashdata('status') == 1){
					$btn = 'success';
				}else{
					$btn = 'danger';
				}
			?>
			<div class="alert alert-<?=@$btn?>">
				<?php echo session()->getFlashdata('msg'); ?>
			</div>
			<?php 
			session()->remove('msg');
			}
			
			?>
			<!-- Page-Title -->
			<?php 
			$attr = array("name" => "contract_form", "id"=>"contract_form");
			echo form_open_multipart("admin/Users/submitContract", $attr); 
			
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Contract
							
							
							<div class="btn-group tab_btn_gourp" role="group" aria-label="Basic example">               
                                <button type="button" data-index="All" class="btn view_type_button active">All</button>
                                <button type="button" data-index="Active" class="btn view_type_button">Active</button>
                                <button type="button" data-index="Inactive" class="btn view_type_button">Expired</button>
                            </div>
                            
                            <div class="stop-noti-box">
                                <li class="hide_li">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light sort-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-eye-slash"></i> Hide  <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg hide_ul">
                                        <li class="text-center notifi-title">Hide</li>
                                        <li class="list-group">
                                            <div class="col-md-12">
                                                <div class="row list_field_div hide_list_group"></div>
                                            </div> 
                                        </li>
                                    </ul>
                                </li>
                            </div>
							
							
							<?php 
 							if($add_permission){
							?>
							<button  type = "button" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right add-popup" ><span class="icon ion-plus-circled" aria-hidden="true">   ADD </span></button>
							<?php } ?>
							</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" 	style="display: none;">
									<div class="modal-dialog modal-lg">
										<div class="modal-content p-0 b-0">
											<div class="row">
													<!-- Basic example -->
												<div class="col-md-12">
													<div class="panel panel-color panel-info">
														<div class="panel-heading"><h3 class="panel-title">Add Contract </h3>
														</div>
														<div class="panel-body">
															<div class="col-md-12">
																<div id="note"></div>
															</div>
															<div class="col-md-6">	
																<div class="form-group">
																	<input type="hidden" id="id" name="id" value="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['id']; } ?>" >
																	<label>Employee ID  <span class="requires">*</span></label>
																	<input type="text" class="form-control empid " id="empid" name="empid" placeholder="Enter ID " value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['empid']; } ?>"   required>
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
																	<input type="text" class="form-control " id="FirstName" name="FirstName" placeholder="Employee First Name" value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['FirstName']; }?>"   required>
																</div>
															</div>
															<div class="col-md-6">	
																<div class="form-group">																	
																	<label>Employee Last Name <span class="requires">*</span></label>
																	<input type="text" class="form-control " id="LastName" name="LastName" placeholder="Employee Last Name " value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['LastName']; } ?>"  required>
																</div>
															</div>
															<div class="col-md-12">	
																<div class="form-group">																	
																	<label>Title <span class="requires">*</span></label>
																	<input type="text" class="form-control " id="title" name="title" placeholder="Employee title " value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['employee_title']; } ?>" >
																</div>
															</div>
															<div class="col-md-6">	
																<div class="form-group">																	
																	<label>Contract Begin Date <span class="requires">*</span></label>
																	<input type="text" class="form-control campare_date datepicker" id="contract_begin_date" name="contract_begin_date" placeholder="Contract Begin Date" value ="<?php if(isset($edit_contract[0]) ) { echo convertDateString($edit_contract[0]['contract_begin_date']); } ?>"  required>
																</div>
															</div>
															<div class="col-md-6">	
																<div class="form-group">																	
																	<label>Contract End Date <span class="requires">*</span></label>
																	<input type="text" class="form-control campare_date datepicker end_date" id="contract_end_date" name="contract_end_date" placeholder="Contract End Date" value ="<?php if(isset($edit_contract[0]) ) { echo convertDateString($edit_contract[0]['contract_end_date']); } ?>"   required>
																</div>
															</div>
															
															<div class="col-md-6">	
																<div class="form-group">																	
																	<label>Early Termination</label>
																	<input type="text" class="form-control datepicker" id="early_termination" name="early_termination" placeholder="Early Terminatione" value ="<?php if(isset($edit_contract[0]) ) { if($edit_contract[0]['early_termination_date'] != ''){ echo convertDateString($edit_contract[0]['early_termination_date']);} } ?>">
																</div>
															</div>
															
															<div class="col-md-6">	
																<div class="form-group">																	
																	<label>Termination Initiated By</label>
																	<select class="form-control" name="termination_initiate" id="termination_initiate">
																	    <option value="">Select Termination Initiated</option>
																	    <option <?php if(isset($edit_contract[0]) ) { if($edit_contract[0]['termination_initiate_by'] == 'Employee'){ echo 'selected';  }} ?> value="Employee">Employee</option>
																	    <option <?php if(isset($edit_contract[0]) ) { if($edit_contract[0]['termination_initiate_by'] == 'Future Generations'){ echo 'selected';  }} ?> value="Future Generations">Future Generations</option>
																	</select>
																</div>
															</div>
															
															
															<div class="col-md-6">	
																
																<div class="form-group">																	
																	<label>Hours To Work<span class="requires">*</span></label>																	
																	<input type="text" class="form-control" id="hours_to_work" name="hours_to_work" placeholder="Working Hours" value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['hours_to_work']; } ?>"   required>
																</div>
															
															</div>
															
															<div class="col-md-6">	
																
																<div class="form-group">																	
																	<label>Carried Over Hours <span class="requires">*</span></label>																	
																	<input type="text" class="form-control" id="CarriedOverHours" name="CarriedOverHours" placeholder="Carried Over Hours" value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['CarriedOverHours']; } ?>"   required>
																</div>
															
															</div>
															<div class="col-md-6">	
																
																<div class="form-group">																	
																	<label>Education ($) <span class="requires">*</span></label>																	
																	<input type="text" class="form-control" id="Education" name="education" placeholder="Education" value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['education']; } ?>"   required>
																</div>
															
															</div>
															<div class="col-md-6">	
																<div class="form-group">																	
																	<label>Daily Rate ($) <span class="requires">*</span></label>																	
																	<input type="text" class="form-control" id="daily_rate" name="daily_rate" placeholder="Daily rate" value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['daily_rate']; } ?>"   required>
																</div>
															</div>
															
															
															<div class="col-md-6">
																<div class="form-group">
																	<label>Adjunct Fee <span class="requires">*</span></label>																	
																	<input type="text" maskedFormat="10,2" class="form-control maskedExt" id="adjunct_fee" name="adjunct_fee" placeholder="Adjunct Fee" value ="<?php if(isset($edit_contract[0]) ) { echo $edit_contract[0]['adjunct_fee']; } ?>"   required>
																</div>
															</div>
                                                            
                                                            <div class="col-md-6">
                                                                <div class="form-group">  
                                                                    <label >1099 <span class="requires">*</span></label>
                                                                    <select  class="form-control" id="contract_1099" name="contract_1099" required>
                                                                        <option value="" >-Select-</option>
                                                                        <option value="Yes" <?php if(isset($edit_contract[0])){if($edit_contract[0]['contract_1099']=='Yes'){ echo 'selected'; }}?> >Yes</option>
                                                                        <option value="No" <?php if(isset ($edit_contract[0])){if($edit_contract[0]['contract_1099']=='No'){echo'selected';}} ?> >No</option>
                                                                    </select>
                                                                </div>
                                                            </div>
															
														</div>	<!-- panel-body -->
															<div class="modal-footer">
															    
																<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
																<?php if(isset($edit_contract[0])){ ?>
																  <input type="submit" class="btn btn-success submit_button" name="submit" value="Save"  id="contact_form_btn"  >
																<?php }else{
																    ?>
																    <input type="submit" class="btn btn-success submit_button" name="submit" value="Save"  >
																    <?php
																}?>
																   
																<!--<input type="submit" class="btn btn-success" <?php if(isset($edit_contract[0])){ if(!empty($check_attendence)) { ?> onClick='return ValidateForm();' <?php }} ?> name="submit" value="Save" id="contact_form_btn">-->
																   
																
															</div>
														</div><!-- panel -->
														
														
															<?php echo form_close(); ?>
													</div> <!-- row-->
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div>
								<div class="col-md-12 col-sm-12 col-xs-12" id="result">
									  <?php echo view('templates/filter/filter_addContract',$data); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div> <!-- container -->                              
	</div> <!-- content -->
</div> <!-- content -->

<div id="calculation-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" 	style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content p-0 b-0">
			<div class="row">
					<!-- Basic example -->
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading"><h3 class="panel-title">Contract Working Details</h3>
						</div>
						<div class="panel-body">
							
							<div class="col-md-12">	
								<div class="form-group">							
									<div class="col-md-6">Total Month Hours	</div>
    								<div class="col-md-1">:</div>	
    								<div class="col-md-4" id="total_worked_hours"></div>
    							
        							<div class="col-md-6">Total Month Days</div>
        							<div class="col-md-1">:</div>
        							<div class="col-md-4" id="total_worked_days"></div>
        							
        							<div class="col-md-6">Hours Left On Contract</div>
        							<div class="col-md-1">:</div>
        							<div class="col-md-4" id="total_left_hours"></div>
        							
        							<div class="col-md-6">Days Left On Contract</div>
        							<div class="col-md-1">:</div>
        							<div class="col-md-4" id="total_left_days"></div>    							
        							
        							<div class="col-md-6">Carry Over Hours</div>
        							<div class="col-md-1">:</div>
        							<div class="col-md-4" id="carry_over"></div>
        							
        							<div class="col-md-6">Donated Hours</div>
        							<div class="col-md-1">:</div>
        							<div class="col-md-4" id="donated"></div>									
								</div>
							</div>						
							
						</div>	<!-- panel-body -->
						<div class="modal-footer">
							<button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="margin-right:20px;">Close</button>	
												
						</div>
						</div> <!-- panel -->
							
					</div> <!-- row-->
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
<?php if(isset($edit_contract[0]) ) { ?>  
 	<script type="text/javascript"> 

	$(document).ready(function(){ 
		$('#panel-modal').modal('show');
		$('#FirstName, #LastName').attr('readonly', true); 
		//$('#empid, #FirstName, #LastName, #contract_begin_date, #contract_end_date').attr('readonly', true);
		//$('#note').html('You can only edit Hours To Work').css('color', 'red');
	});
	
	</script>
<?php } ?>
 <script type="text/javascript"> 

 	$(document).on("click", ".add-popup", function() { 
		$('#panel-modal').modal('show');
		$('#FirstName, #LastName').attr('readonly', true); 
		$('#note').html('');
		//$('#contact_form_btn').RemoveAttr('id','');
		$('.submit_button').removeAttr('id','');
		$('#id, #empid, #FirstName,#title, #LastName, #contract_begin_date, #contract_end_date, #hours_to_work,.team_name,#CarriedOverHours,#Education,#daily_rate,#contract_1099,#early_termination,#termination_initiate,#adjunct_fee').val('');
	});

	$(document).on("click", "#calculate", function() { 
		var jsondata = $(this).attr('data-json');
		var obj = JSON.parse(jsondata);
		$('#calculation-modal').modal('show');
		$('#total_worked_hours').html(obj.total_worked_hours);
		$('#total_worked_days').html(obj.total_worked_days);
		$('#total_left_hours').html(obj.total_left_hours);
		$('#total_left_days').html(obj.total_left_days);
		$('#carry_over').html(obj.carry_over);
		$('#donated').html(obj.donated);
	});	

	
	$(document).on("click", ".rmv", function() { 

		var anim = this.getAttribute("data-urlm"); 
		var current = this; 

		if(confirm('Are you sure, Want to Delet this record?')){ 
			loading(); 
			$.ajax({ 
				type: "POST", 
				url: "<?=base_url()?>" + "admin/Users/delContract",  
				data: {toBeChange: anim}, 
				success: function(res){ 
					//alert(res); 
					console.log(res); 
					$('#overlay').remove(); 
					if(res != 'OK' || res.length <= 0 || res == null){ 
					alert('Something went wrong'); 
					}else{
						
					alert('Deleted Successfully');
					location.reload(); 
					} 
				} 
			}); 

		} 
	}); 

	function loading() { 
	// add the overlay with loading image to the page 
	var over = '<div id="overlay">' +
	'<p>Please Wait...</p></div>'; 
	$(over).appendTo('body'); 
	} 
	

	</script>
	
	<script type="text/javascript">
	
	$(document).on('change', '.empid', function(){
		var ev = $(this);
		var current = $(this).val();
		
		
		if(current != ''){
			
			$.ajax({
			type: "POST",
			url: "<?php echo base_url('admin/Users/getEmpTitleName');?>",
			data:{'<?= csrf_token() ?>':'<?= csrf_hash() ?>', 'empid':current},
			success:function(result){
				
				if(result != ''){
					$('#title').val(result);
				}else{
					alert('Employee ID not exist/authorized');
					$('#title').val('');
				}
				
			},
			});
		}
		
	});
	
	$(document).on('change', '.empid', function(){
		var ev = $(this);
		var current = $(this).val();	
        if(current != ''){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Users/getEmpName');?>",
                data:{'<?= csrf_token() ?>':'<?= csrf_hash() ?>', 'empid':current},
                success:function(result){
                    if(result != ''){
                        $('#FirstName').val(result);
                    }else{
                        alert('Employee ID not exist/authorized');
                        $('#FirstName').val('');
                    }
                },
            });
        }	
	});
	
    $(document).on('change', '.empid', function(){
        var ev = $(this);
        var currentval = $(this).val();
        if(currentval != ''){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Users/getEmpLastName');?>",
                data:{'<?= csrf_token() ?>':'<?= csrf_hash() ?>', 'empid':currentval},
                success:function(result){
                    //$('#LastName').val(result);
                    if(result != ''){
                    	$('#LastName').val(result);
                    }else{
                    	alert('Employee ID or Name not exist/authorized');
                    	$('#LastName').val('');
                    }
                },
            });
        }
    
    });

	$(document).on('change','.campare_date',function(){
		var contact_begin_date = $('#contract_begin_date').val();
		var contact_end_date   =$('#contract_end_date').val();

		var d1 = new Date(contact_begin_date);
		var d2 = new Date(contact_end_date);
		//console.log(d1.getTime());
		//console.log(d2.getTime());		

		if(d2.getTime()<d1.getTime()){			
			alert('Contract end date should be greater than contract start date');
			$(this).val('');			
		}else{

			//var now = new Date(date3);
			//var past = new Date(date4);

			var timeDiff1 = Math.abs(d1.getTime() - d2.getTime());
			var diffDays1 = Math.ceil(timeDiff1 / (1000 * 3600 * 24)); 
			var hours = (diffDays1 + 1)*8;
			//console.log(isNaN(hours));
			if(!isNaN(hours)){
				$('#hours_to_work').val(hours);
			}else{
				$('#hours_to_work').val('');
			}
			
		}	
		
	});
	</script>
	<script >
		$('#CarriedOverHours').on('change', function() {
		  //alert( this.value );
		  if((this.value)>80){
		  	alert('CarriedOverHours shoud not greate than '+this.value)
		  }
		});
		
		$(document).on('keyup','#daily_rate',function(){
		     var id = $('#id').val();
		     var submit = 'submit';
		     var daily_rate = $(this).val();
		    $.ajax({ 
				    type: "POST", 
				    dataType : 'json',
				    url: "<?=base_url()?>" + "admin/Users/getContractAttendence",  
				    data: {id:id, submit:submit,daily_rate:daily_rate}, 
			   	    success: function(res){
				    if(res == 'true'){
				       alert('Cannot change rates, as this contract has active attendance records. Please contact administrator.');
				       //var lastChar = daily_rate.substr(0,(daily_rate.length -1));
				       //$('#daily_rate').val(lastChar);
				       $('.submit_button').prop('disabled', true);
				    }else{
		             $('.submit_button').prop('disabled', false);   
				    }
				 } 
			  });
		})
		
		/*$(document).on('click','#contact_form_btn',function(e){
		     var id = $('#id').val();
		        var submit = 'submit';
		    
		        $.ajax({ 
				    type: "POST", 
				    dataType : 'json',
				    url: "<?=base_url()?>" + "admin/Users/getContractAttendence",  
				    data: {id:id, submit:submit}, 
			   	    success: function(res){
				    if(res == 'true'){
				        $("#contract_form").submit();
				        return true;
				    }else{
		                e.preventDefault();
				        alert('Error...');
				        return false;
				    }
				 } 
			  }); 
		   
		});*/
		
		
	$(document).on('click','.view_type_button',function(){
        $('.view_type_button').removeClass('active');
        $(this).addClass('active');  
        filter_progress_loader();
    })
    
    
    function form_submit_data()
    {
        var tab_type = $('button.btn.view_type_button.active').attr('data-index');
        $.ajax({
            type:"POST",
            dataType:'html',
            url:'<?= base_url() ?>admin/Users/filter_contract',
            data: {tab_type:tab_type,submit:'submit'},
            success: function(response){   
                $('#result').html(response);
                $('#contract_dataTable').DataTable({
                    "order": [],
                    "pageLength": 25,
                    'columnDefs': [{
                        'targets': [4,5,6,7,8,9,10,11,12,13], // column index (start from 0)
                        'orderable': false, // set orderable false for selected columns
                    }],
                });
            }
        });
        
    }
	
	$(document).on('keydown keyup','#adjunct_fee',function(){
	    
	        var num = $(this).attr("maskedFormat").toString().split(',');
            var regex = new RegExp("^\\d{0," + num[0] + "}(\\.\\d{0," + num[1] + "})?$");
            if (!regex.test(this.value)) {
                this.value = this.value.substring(0, this.value.length - 1);
            }
	})
	
	$(document).on('click','.linked_button',function(){
	    let linked_id = $(this).attr('linked_id');
	    let submit = "submit";
	    $.ajax({ 
			type: "POST", 
			url: "<?=base_url()?>" + "admin/Users/get_parentcontract_by_id",  
			data: {linked_id: linked_id,submit:submit}, 
			dataType:'html',
			success: function(res){ 
			    console.log(res)
			    $('.linkedResult').html(res)
				 $('#linkedDetailModal').modal('show');
			} 
		}); 
	})
	</script>
	
<div class="modal fade" id="linkedDetailModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Link Contract Detail</h4>
        </div>
        <div class="modal-body">
           <div class="row">
               <div class="col-md-12 linkedResult">
                   
               </div>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>

<script>
    $(document).on('click','.link_previous_btn',function(){
        $('.link_emp_id').val('');
        $('.link_contract_id').val('');
        let empId = $(this).attr('rel_emp_id');
        let contractId = $(this).attr('rel_contract_id');
        $('.link_emp_id').val(empId);
        $('.link_contract_id').val(contractId);
        $('#confirmationModalLinkPreviousContract').modal('show');
    })
    $(document).on('click','.link_confirm_yes_button',function(){
        let link_emp_id = $('.link_emp_id').val();
        let link_contract_id = $('.link_contract_id').val();
        let submit = "submit";
        $.ajax({ 
            type: "POST",
            dataType : 'json',
            url: "<?=base_url()?>" + "admin/Users/link_previous_contract",
            data: {submit:submit,link_emp_id:link_emp_id,link_contract_id:link_contract_id},
            success: function(res){
                if(res.status){
                    alert(res.msg)
                    filter_progress_loader();
                }
                else{
                    alert(res.msg)
                }
                $('#confirmationModalLinkPreviousContract').modal('hide');
            } 
        });  
    })
    
    
    
    $(document).on('click','.unlink_previous_btn',function(){
        $('.unlink_emp_id').val('');
        $('.unlink_contract_id').val('');
        let empId = $(this).attr('rel_emp_id');
        let contractId = $(this).attr('rel_contract_id');
        $('.unlink_emp_id').val(empId);
        $('.unlink_contract_id').val(contractId);
        $('#confirmationModalUnLinkPreviousContract').modal('show');
    })
    
    
    $(document).on('click','.unlink_confirm_yes_button',function(){
        let link_emp_id = $('.unlink_emp_id').val();
        let link_contract_id = $('.unlink_contract_id').val();
        let submit = "submit";
        $.ajax({ 
            type: "POST",
            dataType : 'json',
            url: "<?=base_url()?>" + "admin/Users/unlink_previous_contract",
            data: {submit:submit,link_emp_id:link_emp_id,link_contract_id:link_contract_id},
            success: function(res){
                if(res.status){
                    alert(res.msg)
                    filter_progress_loader();
                }
                else{
                    alert(res.msg)
                }
                $('#confirmationModalUnLinkPreviousContract').modal('hide');
            } 
        });  
    })
    
</script>


<!-- Modal -->
<div class="modal fade" id="confirmationModalLinkPreviousContract" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:0px;">
                <button type="button" class="close" data-dismiss="modal" style="margin-top: -16px;">&times;</button>
                <!--h4 class="modal-title">Modal Header</h4-->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" class="form-control link_emp_id">
                        <input type="hidden" class="form-control link_contract_id">
                        <p>Are you sure to link contract with previous contract.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-success btn-xs link_confirm_yes_button">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmationModalUnLinkPreviousContract" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:0px;">
                <button type="button" class="close" data-dismiss="modal" style="margin-top: -16px;">&times;</button>
                <!--h4 class="modal-title">Modal Header</h4-->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" class="form-control unlink_emp_id">
                        <input type="hidden" class="form-control unlink_contract_id">
                        <p>Are you sure to unlink contract with previous contract.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-success btn-xs unlink_confirm_yes_button">Yes</button>
            </div>
        </div>
    </div>
</div>
  