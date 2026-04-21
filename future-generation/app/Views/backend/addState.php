<?php //echo "<pre>";print_r($budget);die;

/* if(isset($result[0])){
$arr = $result[0];
$discipline_id = $arr['discipline_id'];
$discipline_name = $arr['discipline_name'];
$discipline_status = $arr['discipline_status'];

} */
?> 
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                 
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
	
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

}
</style>     
<div class="content-page">
<!-- Start content -->
	<div class="content">
		<div class="container"> 
			<?php if(session()->getFlashdata('msg') !=''){ ?>
			<div class="alert alert-success">
				<?php echo session()->getFlashdata('msg'); ?>
			</div>
				<?php session()->remove('msg'); } ?>
			<?php if(session()->getFlashdata('msg_error') !=''){ ?>
			
				<?php echo session()->getFlashdata('msg_error'); ?>
			
				<?php } session()->remove('msg_error'); ?>
				<!-- Page-Title -->
				<?php echo form_open_multipart("admin/Master/submitState"); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"> State List
							<button  type = "button" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" data-toggle="modal" data-target="#panel-modal" ><span class="icon ion-plus-circled" aria-hidden="true">   ADD </span></button></h3>
							</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" 	style="display: none;">
									<div class="modal-dialog">
										<div class="modal-content p-0 b-0">
											<div class="row">
													<!-- Basic example -->
												<div class="col-md-12">
													<div class="panel panel-color panel-info">
														<div class="panel-heading"><h3 class="panel-title">Add State List  </h3>
														</div>
														<div class="panel-body">
															<div class="col-md-12">
																<div class="form-group">
																	<input type="hidden" name="ROWID" value="<?php if(isset($edit_state[0]) ) { echo $edit_state[0]['ROWID']; } ?>" >
																	<label>State Code  <span class="requires">*</span></label>
																	<input type="text" class="form-control" id="StateID" name="StateID" placeholder="Enter State Code " value ="<?php if(isset($edit_state[0]) ) { echo $edit_state[0]['StateID']; } ?>"   required>
																</div>
															</div>
															<div class="col-md-12">								
																<div class="form-group">
																	<label>State Name  <span class="requires">*</span></label>
																	<input type="text" class="form-control" id="StateName" name="StateName" placeholder="Enter State Name " value ="<?php if(isset($edit_state[0]) ) { echo $edit_state[0]['StateName']; } ?>" onkeypress="javascript:return ValidateAlpha(event)"  required>
																</div>
															</div>
															<div class="col-md-12">	
																<div class="form-group">
																	<label for="Active">State Status <span class="requires">*</span></label>
																	<select class="form-control" name="Active" required>
																		<option value="">Select</option>	
																		<option value="1"  <?php if(isset($edit_state[0])){if(1==$edit_state[0]['Active']){ echo "Selected";}} ?>>Active</option>									
																		<option value="2"  <?php if(isset($edit_state[0])){if(0==$edit_state[0]['Active']){ echo "Selected";}} ?>>Inactive</option>										
																	</select>
																</div>
															</div>
														</div>	<!-- panel-body -->
														<div class="modal-footer">
															<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
															<input type="submit" class="btn btn-success" name="submit" value="Save">
														</div>
													</div> <!-- panel -->
														<?php echo form_close(); ?>
												</div> <!-- row-->
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<table id="alldataTable" class="table table-striped table-bordered alldataTable">
										<thead>
											<tr>
												<th>S.No.</th>
												<th>State Code</th>												
												<th>State Name</th>												
												<th>Status</th>									
												<th>Action</th>									
												<!--<th>Action</th>-->
											</tr>
										</thead>

								 
										<tbody> 
											<?php 
											$i=1;
											foreach($states as $row) { ?>
											<tr>
											<td><?=$i++;?></td>
												
												<td><?=$row['StateID']?></td>												
												<td><?=$row['StateName']?></td>												
												<td>
												
													<?php
														if ($row['Active'] == "1") {
															echo "ACTIVE";
														}
														else {
															echo "INACTIVE";			
														}
																									
														?>
													
												</td>
												<td>
													<a href="<?=base_url('')?>admin/Master/addState/<?=encryptor('encrypt', $row['ROWID'])?> " 	class="btn btn-info waves-effect waves-light btn-xs m-b-5">
														<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
														<span><strong></strong></span>            
													</a>
													<a href="javascript:void(0);" title="Click To Delete"  	class="btn btn-danger waves-effect waves-light btn-xs m-b-5 rmv" data-urlm="<?=encryptor('encrypt', $row['ROWID'])?>">
														<span class="fa fa-trash-o" aria-hidden="true"></span>
														<span><strong></strong></span>            
													</a>
													
													
												</td>
											</tr>
											<?php } ?>
										   
											
										</tbody>
									</table>

								</div>
							</div>
						</div>
					</div>
				</div>
					
			
		</div> <!-- container -->                              
	
<div>
<?php if(isset($edit_state[0]) ) {?>  
 <script type="text/javascript"> 
  $(document).ready(function(){ 
	$('#panel-modal').modal('show'); 
	});
</script>
<?php } ?>  
 <script type="text/javascript"> 
	$(document).on("click", ".rmv", function() { 

		var anim = this.getAttribute("data-urlm"); 
		var current = this; 

		if(confirm('Are you sure, Want to Delete this record?')){ 
			loading(); 
			$.ajax({ 
				type: "POST", 
				url: "<?=base_url()?>" + "admin/Master/delState",  
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