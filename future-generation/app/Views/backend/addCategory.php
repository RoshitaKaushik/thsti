<?php //echo "<pre>";print_r($budget);die;

$add_permission = false;
if(session()->get('profiles')){
	if(in_array(1, session()->get('profiles'))){
		$add_permission = true;
	}							
}elseif(session()->get('role') == 1){
	$add_permission = true;
}
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                 
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
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
				<?php } ?>
				<!-- Page-Title -->
				
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"> Category
							<?php 
 							if($add_permission){
							?>
							<button  type = "button" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" data-toggle="modal" data-target="#panel-modal" ><span class="icon ion-plus-circled" aria-hidden="true">   ADD </span></button>
							<?php } ?>
							</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<?php echo form_open_multipart("admin/Users/submitcategory"); ?>
								<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" 	style="display: none;">
									<div class="modal-dialog">
										<div class="modal-content p-0 b-0">
											<div class="row">
													<!-- Basic example -->
												<div class="col-md-12">
													<div class="panel panel-color panel-info">
														<div class="panel-heading"><h3 class="panel-title">Add Category  </h3>
														</div>
														<div class="panel-body">
															<div class="col-md-12">	
																<div class="form-group">
																	<input type="hidden" name="id" value="<?php if(isset($edit_category[0]) ) { echo $edit_category[0]['id']; } ?>" >
																	<label>Category  <span class="requires">*</span></label>
																	<input type="text" class="form-control " id="catagory_name" name="catagory_name" placeholder="Enter Category" value ="<?php if(isset($edit_category[0]) ) { echo $edit_category[0]['catagory_name']; } ?>"   required>
																</div>	
															</div>
															
															<div class="col-md-12">	
																<div class="form-group">	
																	<label>Grant Type <span class="requires">*</span></label>
																	<select class="form-control" name="grant_type" required>
																	    <option <?php if(isset($edit_category[0])){if('No'==$edit_category[0]['grant_type']){ echo "Selected";}} ?> value="No">No</option>
																	    <option <?php if(isset($edit_category[0])){if('Yes'==$edit_category[0]['grant_type']){ echo "Selected";}} ?> value="Yes">Yes</option>
																	</select>
																</div>
															</div>
															
															<div class="col-md-12">	
																<div class="form-group">
																	<label for="Active">Category Status <span class="requires">*</span></label>
																	<select class="form-control" name="Active" required>
																		<option value="">Select</option>	
																		<option value="1"  <?php if(isset($edit_category[0])){if(1==$edit_category[0]['Active']){ echo "Selected";}}else{
																			echo "Selected";
																		} ?>>Active</option>									
																		<option value="2"  <?php if(isset($edit_category[0])){if(2==$edit_category[0]['Active']){ echo "Selected";}} ?>>Inactive</option>										
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
								<?php echo form_close(); ?>
								<?php echo form_open_multipart("admin/Users/submitcategory"); ?>	
								<div id="panel-modall" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
									<div class="modal-dialog">
										<div class="modal-content p-0 b-0">
											<div class="row">
													<!-- Basic example -->
												<div class="col-md-12">
													<div class="panel panel-color panel-info">
														<div class="panel-heading"><h3 class="panel-title">Add Sub Category  </h3>
														</div>
														<div class="panel-body">
															<div class="col-md-12">	
																<div class="form-group">
																	
																	<label>Category  <span class="requires">*</span></label>
																	<input type="hidden" name="parent_id" value="<?php if(isset($edit_subcategory[0]) ) { echo $edit_subcategory[0]['id']; } ?>">
																	<input type="text" class="form-control " id="catagory_name" name="parent_name" placeholder="Enter Category" value ="<?php if(isset($edit_subcategory[0]) ) { echo $edit_subcategory[0]['catagory_name']; } ?>"   required disabled>
																</div>
																
															</div>
															<div class="col-md-12">	
																<div class="form-group">
																	
																	<label>Sub Category  <span class="requires">*</span></label>
																	<input type="text" class="form-control " id="catagory_name" name="catagory_name" placeholder="Enter Category" value =""   required>
																</div>
																
															</div>
															<div class="col-md-12">	
																<div class="form-group">
																	<label for="Active">Category Status <span class="requires">*</span></label>
																	<select class="form-control" name="Active" required>
																		<option value="">Select</option>	
																		<option value="1"  <?php if(isset($edit_subcategory[0])){if(1==$edit_subcategory[0]['Active']){ echo "Selected";}}else{
																			echo "Selected";
																		} ?>>Active</option>									
																		<option value="2"  <?php if(isset($edit_subcategory[0])){if(2==$edit_subcategory[0]['Active']){ echo "Selected";}} ?>>Inactive</option>										
																	</select>
																</div>
															</div>
														</div>	<!-- panel-body -->
															<div class="modal-footer">
																<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
																<input type="submit" class="btn btn-success" name="submit" value="Save">
															</div>
														</div> <!-- panel -->
															
													</div> <!-- row-->
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div>
								<?php echo form_close(); ?>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<table id="alldataTable" class="table table-striped table-bordered alldataTable">
										<thead>
											<tr>
												<th>S.No.</th>
												<th>Category  </th>
												<th>Parent Category  </th>	
												<th>Grant Type</th>
												<th>Status</th>									
												<th>Action</th>									
												<!--<th>Action</th>-->
											</tr>
										</thead>
										<tbody> 
											<?php 
											$i=1;
											foreach($catagory_name as $row) { ?>
											<tr <?php if ($row['Active'] != "1") {
															 echo "style='background-color:#f78282 ! important'";
														} ?>>
												<td><?=$i++;?>
												</td>
												<td><?=$row['catagory_name']?>
												</td>
												<td><?php if(isset($row['parent'])){ echo $row['parent']; }?>
												<td><?=$row['grant_type']?>
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
													<?php 
													if($add_permission){
													?>
													<a href="<?=base_url('')?>admin/Users/category/<?=encryptor('encrypt', $row['id'])?> " 	class="btn btn-info waves-effect waves-light btn-xs m-b-5">
														<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
														<span><strong></strong></span>            
													</a>
													<?php if(! isset($row['parent'])){ ?>
													<a href="<?=base_url('')?>admin/Users/addSubcategory/<?=encryptor('encrypt', $row['id'])?> " 	class="btn btn-info waves-effect waves-light btn-xs m-b-5">
														
														<span><strong>Add Subcategory</strong></span>            
													</a>
													<?php } } ?>
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
			</div>
			
		</div> <!-- container -->                              
	</div> <!-- content -->
</div> <!-- content -->

<div>
<?php if(isset($edit_category[0]) ) {?>  
 <script type="text/javascript"> 
  $(document).ready(function(){ 
	$('#panel-modal').modal('show'); 
	});
</script>
<?php } ?>
<?php if(isset($edit_subcategory[0]) ) {?>  
 <script type="text/javascript"> 
  $(document).ready(function(){ 
	$('#panel-modall').modal('show'); 
	});
</script>
<?php } ?>