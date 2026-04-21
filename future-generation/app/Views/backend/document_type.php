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
				<?php session()->remove('msg'); } ?>
				<!-- Page-Title -->
			<?php echo form_open_multipart("admin/Master/submitDocumentType"); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"> Add Document Type
							<?php 
 							if($add_permission){
							?>
							<button  type = "button" class="btn btn-success addDocumentType waves-effect waves-light m-b-5 m-l-5  pull-right" data-toggle="modal" data-target="#panel-modal" ><span class="icon ion-plus-circled" aria-hidden="true">   ADD </span></button>
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
														<div class="panel-heading"><h3 class="panel-title">Add Document Type</h3>
														</div>
														<div class="panel-body">
															<div class="col-md-12">	
																<div class="form-group">
																	<input type="hidden" id="documentID" name="documentID" value="<?php if(isset($edit_document[0]) ) { echo $edit_document[0]['id']; } ?>" >
																	<label>Document Type<span class="requires">*</span></label>
																	<input type="text" class="form-control " onkeypress="javascript:return  " maxlength="25" id="document_type" name="document_type" placeholder="Enter Document Type" value ="<?php if(isset($edit_document[0]) ) { echo $edit_document[0]['type']; } ?>"   required>
																</div>
										
															</div>
															<div class="col-md-12">	
																<div class="form-group">
																	<label for="status">Program Status <span class="requires">*</span></label>
																	<select class="form-control" name="status" required>
																		<option value="">Select</option>	
																		<option value="1"  <?php if(isset($edit_document[0])){if(1==$edit_document[0]['status']){ echo "Selected";}}else{
																			echo "Selected";
																		} ?>>Active</option>									
																		<option value="0"  <?php if(isset($edit_document[0])){if(0==$edit_document[0]['status']){ echo "Selected";}} ?>>Inactive</option>										
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
												<th>Type  </th>												
												<th>Status</th>									
												<th>Action</th>									
												<!--<th>Action</th>-->
											</tr>
										</thead>
										<?php //echo "<pre>"; print_r('Program_Name'); die; ?>
										 <tbody> 
											<?php 
											$i=1;
											foreach($documenttypes as $row) { ?>
											<tr>
												<td><?=$i++;?>
												</td>
												<td><?=$row['type']?>
												</td>
												<td>
													<?php
														if ($row['status'] == "1") {
															echo "Active";
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
													<a href="<?=base_url('')?>admin/Master/addDocumentType/<?=encryptor('encrypt', $row['id'])?> " 	class="btn btn-info waves-effect waves-light btn-xs m-b-5">
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
<?php if(isset($edit_document[0]) ) {?>  
 <script type="text/javascript"> 
  $(document).ready(function(){ 
	$('#panel-modal').modal('show'); 
	});
</script>
<?php } ?>

<script>
    $(document).on('click','.addDocumentType',function(){
        $('#document_type').val('');
        $('#documentID').val('');
    })
</script>