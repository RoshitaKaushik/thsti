<?php //echo "<pre>";print_r($data);die;
$add_permission = false;
if(session()->get('profiles')){
	if(in_array(1, session()->get('profiles'))){
		$add_permission = true;
	}							
}elseif(session()->get('role') == 1){
	$add_permission = true;
}


$add_permission = $edit_permission = $excel_permission = $print_permission =  false;
if(in_array(13, session()->get('profiles')??[])){
    $permissions = getPermissionDetails('13','43','35');
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
            $print_permission = true;
        }
    } 
    
}

if(session()->get('role') == 1){
	$add_permission = $edit_permission = $excel_permission = $print_permission = true;
}


?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                 
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
    text-align: left ! important;
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
margin: -28px 0 0 -25px;} 

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
				<?php echo session()->getFlashdata('msg');
				session()->remove('msg')
				?>
			</div>
			<?php } ?>
			<!-- Page-Title -->
			<?php 
			/*$attr = array("name" => "contract_form", "id"=>"contract_form");
			echo form_open_multipart("admin/Users/submitContract", $attr); */
			
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"> Assign Category
							</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								
								<div class="col-md-12 col-sm-12 col-xs-12">
									<table id="alldataTable1" class="second_table table table-striped table-bordered alldataTable">
										<thead>
											<tr>
												<th>S.No.</th>
												<th>Employee ID </th>				
												<th> Name </th>									
												<th>Assign Category (Option-1)</th>						
												<th>Assign Category (Option-2)</th>
												<th></th>
											</tr>
										</thead>
										<tbody> 
											<?php 
											$i=1;
											if(!empty($contract)){
											foreach($contract as $row) { 
											//check user active or  not
											$status = check_user_active_or_not($row['empid']);
										     
											?>
											<tr <?= (!isset($status[0]['account_status']) || $status[0]['account_status'] != '1') ? 'style="background-color:#f78282 !important;"' : '' ?>
        										     >
												<td><?=$i++;?>
												</td>
												<td><?=$row['empid']?>
												</td>


												<td><?= $row['FirstName']." ".$row['LastName']; ?>
												</td>
											

												<td>
												    <?php
												    if($status[0]['account_status']??[] =='1'  ){
												        if($add_permission || $edit_permission){
        										         ?>
													<span class="assign_category glyphicon glyphicon-plus" style='color:green;cursor:pointer;' rel_id="<?=$row['empid']; ?>" ></span>
													<span class="glyphicon glyphicon-trash text-danger remove_category" rel_id="<?=$row['empid']; ?>" style='cursor:pointer;'></span>
													<?php }
        										        }
        										        else
        										        {
        										            echo "<span class='btn btn-danger btn-xs inactive_btn'>Inactive Account</span>";
        										        }
        										     ?>
												</td>

												<td>
												    <?php
												    if($add_permission || $edit_permission){ ?>
													    <button class="btn-info cat_assign" rel_id="<?=$row['empid']; ?>" rel_name="<?= $row['FirstName']; ?> <?= $row['LastName']; ?>">Assign Category</button>
												    <?php } ?>
												</td>
												
												<td>
												    <?php
												       $category = get_assign_category($row['empid']);
												       $category =array_column($category, 'catagory_name');
												       echo implode(" , ",$category);
												    ?>
												</td>				
												
												
											</tr>
											<?php
										     
											} } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div> <!-- container -->                              
	</div> <!-- content -->
</div> <!-- content -->





<!-- Assign Catogory Modal -->
 <div class="modal fade" id="assign_category_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
   
	      <div class="modal-content">

	      	<?php
	      	$attr = array("name" => "myForm", "id"=>"myForm");
			echo form_open_multipart("admin/AssignCategory/store_assign_category", $attr); 
			?>
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Assign Category</h4>
	        </div>
	        <div class="modal-body" style="height: 300px;overflow-y: scroll;">
	        	<input type="hidden" class="form-control" name="emp_id" id="emp_id" />
	        	<input type="checkbox" id='check_all'>&nbsp;&nbsp;Check All<hr/>
	        	<span id="assign_body"></span>
	             <?php
	             /* foreach ($catagory_name as $cat) {
	               	?>
	               	 <input type="checkbox" value="<?= $cat['id'] ?>" name="cat_id[]" class="category_check">
	               	 &nbsp;&nbsp;&nbsp;<?= $cat['catagory_name']; ?><br/>
	               	<?php
	               } */
	             ?>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	          <button type="button" class="btn btn-success assign_cat_button">Assign</button>
	        </div>
	       </form>

	      </div>
	 
      
    </div>
  </div>
<!-- End assign Cateogy Modal -->



<!-- Remove Catogory Modal -->
 <div class="modal fade" id="remove_category_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
   
	      <div class="modal-content">

	      	<?php
	      	$attr = array("name" => "myFormRemove", "id"=>"myFormRemove");
			echo form_open_multipart("admin/AssignCategory/remove_assign_category", $attr); 
			?>
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Remove Category</h4>
	        </div>
	        <div class="modal-body" style="height: 300px;overflow-y: scroll;">
	        	<input type="hidden" class="form-control" name="remove_emp_id" id="edit_emp_id" />
	        	<input type="checkbox" id='check_all1'>&nbsp;&nbsp;Check All<hr/>
	             <span id="remove_body"></span>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	          <button type="button" class="btn btn-success remove_cat_button">Remove</button>
	        </div>
	    </form>
	      </div>
	 
      
    </div>
  </div>
<!-- End remove Cateogy Modal -->






<?php if(isset($edit_contract[0]) ) { ?>  
 	<script type="text/javascript"> 

	$(document).ready(function(){ 
		$('#panel-modal').modal('show');
		$('#FirstName,#title, #LastName').attr('readonly', true); 
		//$('#empid, #FirstName, #LastName, #contract_begin_date, #contract_end_date').attr('readonly', true);
		//$('#note').html('You can only edit Hours To Work').css('color', 'red');
	});
	
	</script>
<?php } ?>
 <script type="text/javascript"> 

 	$(document).on("click", ".add-popup", function() { 
		$('#panel-modal').modal('show');
		$('#FirstName,#title, #LastName').attr('readonly', true); 
		$('#note').html('');
		$('#id, #empid, #FirstName,#title, #LastName, #contract_begin_date, #contract_end_date, #hours_to_work').val('');
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
			data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', 'empid':current},
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
			data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', 'empid':current},
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
			data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', 'empid':currentval},
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

	$(document).on('click','.assign_category',function(){
		var emp_id = $(this).attr('rel_id');
		$('#emp_id').val(emp_id);

		 $.ajax({
	        url: '<?= base_url(); ?>admin/assignCategory/all_get_task_category',
	        data: ({ emp_id: emp_id }),
	        dataType: 'json', 
	        type: 'post',
	        success: function(response) {
	        	console.log(response);
	        	
	        	var html1='';
	            $.each(response, function(key, value) {
	            	
	            	 if(value.rid==null )
	            	 {
	            	 	html1 += "<span><input type='checkbox' class='add_cat_check' name='cat_id[]' value="+value.id+">&nbsp;&nbsp;"+value.catagory_name+"</span><br/>";
	            	 }
	            	 else
	            	 {
	            	  html1 += "<span><input type='checkbox' name='cat_id[]' checked disabled value="+value.id+">&nbsp;&nbsp;"+value.catagory_name+"</span><br/>";	
	            	 }
					  	
					})
	            $('#assign_body').html(html1);
	           
	            $('#assign_category_modal').modal('show');
	        }             
	    });


		
	});
    
    $(document).on('click','.assign_cat_button',function(){
    	 var count_checked = $("[name='cat_id[]']:checked").length; // count the checked rows
	        if(count_checked == 0) 
	        {
	            alert("Please select any category.");
	            return false;
	        }
	        else
	        {
	           $("#myForm").submit();
	        }

    });

    $(document).on('click','.remove_category',function(){
    	var emp_id = $(this).attr('rel_id');
		$('#edit_emp_id').val(emp_id);
		 $.ajax({
	        url: '<?= base_url(); ?>admin/assignCategory/get_task_category',
	        data: ({ emp_id: emp_id }),
	        dataType: 'json', 
	        type: 'post',
	        success: function(response) {

	        	 var html1='';
	            $.each(response, function(key, value) {
	            	
					  	html1 += "<span><input type='checkbox' class='rem_cat_check' name='remove_id[]'' value="+value.rid+">&nbsp;&nbsp;"+value.catagory_name+"</span><br/>";
					})
	            $('#remove_body').html(html1);
	           
	            $('#remove_category_modal').modal('show');
	        }             
	    });
    });

    $(document).on('click','.remove_cat_button',function(){

    	var count_checked = $("[name='remove_id[]']:checked").length; // count the checked rows
	        if(count_checked == 0) 
	        {
	            alert("Please select any category.");
	            return false;
	        }
	        else
	        {
	           $("#myFormRemove").submit();
	        }


    });
	

	</script>
	<script >
		$(document).ready(function() {
		    $('#alldataTable1').DataTable( {
		       
				"pageLength": 50
		    } );
		});

		$('#CarriedOverHours').on('change', function() {
		  //alert( this.value );
		  if((this.value)>80){
		  	alert('CarriedOverHours shoud not greate than '+this.value)
		  }
		});


       $("#check_all").click(function () {
	       $(".add_cat_check").prop('checked', $(this).prop('checked'));
	   });
	   $("#check_all1").click(function () {
	       $(".rem_cat_check").prop('checked', $(this).prop('checked'));
	   });
	</script>


	<script>
		$(document).on('click','.cat_assign',function(){
			var id = $(this).attr('rel_id');
			var name = $(this).attr('rel_name');
			$('.part2').html('');
			$('#add_remove_emp_id').val(id);

			 $.ajax({
			        url: '<?= base_url(); ?>admin/assignCategory/add_remove_assign_cat',
			        data: ({ emp_id: id }),
			        dataType: 'json', 
			        type: 'post',
			        success: function(response) {
			        	console.log(response);
			        	
			        	var html1='';
			        	var html2='';
			            $.each(response.category_list, function(key, value) {
			            	
			            	 if(value.rid==null )
			            	 {
			            	 	html1 += "<span class='modal_cat' rel_name='"+value.catagory_name+"' id='cat"+value.id+"' rel_id="+value.id+">"+value.catagory_name+"<br/></span>";
			            	 }
						})
						$.each(response.already_assign, function(key, value) {
			                html2 += "<span class='removeaddcat' rel_name='"+value.catagory_name+"' rel_id="+value.id+" id='addcat"+value.id+"'><input type='hidden' class='form-control' value="+value.id+" name='cat_id[]'/>"+value.catagory_name+"<br/></span>";
			            	 
						})
			            $('.part1').html(html1);
			            $('.part2').html(html2);
			            //alert(name);
			            $('#user_name').html(name);
			            $('#assign_remove_category_modal').modal('show');
			        }             
			    });
		});

		$(document).on('click','.modal_cat',function(){
			var emp_id = $('#add_remove_emp_id').val();
			var cat_id = $(this).attr('rel_id');
			var cat_name = $(this).attr('rel_name');
			$('.part2').append("<span class='removeaddcat' rel_name='"+cat_name+"' rel_id="+cat_id+" id='addcat"+cat_id+"'><input type='hidden' class='form-control' value="+cat_id+" name='cat_id[]'/>"+cat_name+"<br/></span>");
			$('#cat'+cat_id).remove();

		});
		$(document).on('click','.removeaddcat',function(){
			var cat_id = $(this).attr('rel_id');
			var cat_name = $(this).attr('rel_name');
			$('.part1').append("<span class='modal_cat' rel_name='"+cat_name+"' id='cat"+cat_id+"' rel_id="+cat_id+">"+cat_name+"<br/></span>");
			$('#addcat'+cat_id).remove();

		});

	</script>

<style>
	/*.part1{
	  border-right:1px solid;
	}
	.cp1{
		border:1px solid;
		padding: 15px;
	}*/
	.modal_cat
	{
		cursor: pointer;
	}
	.removeaddcat
	{
		cursor: pointer;
	}
</style>	

<!-- Assign Category and remove Catogory Modal -->
 <div class="modal fade" id="assign_remove_category_modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
   
	      <div class="modal-content">

	      	<?php
	      	$attr = array("name" => "myFormRemove", "id"=>"myFormRemove");
			echo form_open_multipart("admin/AssignCategory/add_remove_categoy", $attr); 
			?>
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Add or Remove Category for <span id="user_name"></span></h4>
	        </div>
	        
		        <div class="modal-body" style="height: 300px;overflow-y: scroll;">
		        	<input type="hidden" class="form-control" name="remove_emp_id" id="add_remove_emp_id" />

		        	<div class="container cp1">
		        		<div class="row">
		        			<div class="col-md-6"><h4><u>Category List</u></h4></div>
		        			<div class="col-md-6"><h4><u>Assigned Category List</u></h4></div>
		        			<div class="col-md-6 part1">
		        				
		        			</div>
		        			<div class="col-md-6 part2">

		        			</div>
		        		</div>
		        	</div>
		        	
		             
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		          <button type="submit" class="btn btn-success ">Assign</button>
		        </div>
		    </form>

	      </div>
	 
      
    </div>
  </div>
<!-- End remove Cateogy Modal -->
<script>
    $(document).on('click','.inactive_btn',function(){
        $('#inactive_modal').modal('show');
    })
</script>


<!-- Modal -->
  <div class="modal fade" id="inactive_modal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Alert</h4>
        </div>
        <div class="modal-body">
          <p>This user account is inactive.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


