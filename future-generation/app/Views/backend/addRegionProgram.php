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
				<?php echo session()->getFlashdata('msg'); 
				session()->remove('msg');
				?>
			</div>
				<?php } ?>
				<!-- Page-Title -->
				<?php echo form_open_multipart("admin/Master/submitRegionProgram"); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"> Add Region Program
							<?php 
 							if($add_permission){
							?>
							<button  type = "button" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" data-toggle="modal" data-target="#panel-modal" ><span class="icon ion-plus-circled" aria-hidden="true">   ADD </span></button>
							<?php } ?>
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
														<div class="panel-heading"><h3 class="panel-title">Add Region Program  </h3>
														</div>
														<div class="panel-body">
															<div class="col-md-12">	
																<div class="form-group">
																	<input type="hidden" name="RPID" value="<?php if(isset($edit_RegionProgram[0]) ) { echo $edit_RegionProgram[0]['RPID']; } ?>" >
																	<label>Region Program <span class="requires">*</span></label>
																	<input type="text" class="form-control " id="RegionProgram" name="RegionProgram" placeholder="Enter Region Program  " value ="<?php if(isset($edit_RegionProgram[0]) ) { echo $edit_RegionProgram[0]['RegionProgram']; } ?>"   required>
																</div>
																
															</div>
															<div class="col-md-12">	
																<div class="form-group">
																	<label for="Active">Region Program Status <span class="requires">*</span></label>
																	<select class="form-control" name="Active" required>
																		<option value="">Select</option>	
																		<option value="1"  <?php if(isset($edit_RegionProgram[0])){if(1==$edit_RegionProgram[0]['Active']){ echo "Selected";}}else{
																			echo "Selected";
																		} ?>>Active</option>									
																		<option value="2"  <?php if(isset($edit_RegionProgram[0])){if(2==$edit_RegionProgram[0]['Active']){ echo "Selected";}} ?>>Inactive</option>										
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
												<th>Region Program </th>												
												<th>Status</th>									
												<th>Action</th>									
												<!--<th>Action</th>-->
											</tr>
										</thead>
										<tbody> 
											<?php 
											$i=1;
											foreach($RegionProgram as $row) { ?>
											<tr>
												<td><?=$i++;?>
												</td>
												<td><?=$row['RegionProgram']?>
												</td>
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
													<a href="<?=base_url('')?>admin/Master/addRegionProgram/<?=encryptor('encrypt', $row['RPID'])?> " 	class="btn btn-info waves-effect waves-light btn-xs m-b-5">
														<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
														<span><strong></strong></span>            
													</a>
													<?php } ?>
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
<?php if(isset($edit_RegionProgram[0]) ) {?>  
 <script type="text/javascript"> 
  $(document).ready(function(){ 
	$('#panel-modal').modal('show'); 
	});
</script>
<?php } ?>