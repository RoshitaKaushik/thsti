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
				<?php echo form_open_multipart("admin/Master/submitProgram"); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"> Concentration / Specialization
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
														<div class="panel-heading"><h3 class="panel-title">Concentration / Specialization  </h3>
														</div>
														<div class="panel-body">
															<div class="col-md-12">	
																<div class="form-group">
																	<input type="hidden" name="ProgramID" value="<?php if(isset($edit_program[0]) ) { echo $edit_program[0]['ProgramID']; } ?>" >
																	<label> Concentration / Specialization <span class="requires">*</span></label>
																	<input type="text" class="form-control " id="Program_Name" name="Program_Name" placeholder="Enter Program" value ="<?php if(isset($edit_program[0]) ) { echo $edit_program[0]['Program_Name']; } ?>"   required>
																</div>
										
															</div>
															<div class="col-md-12">	
																<div class="form-group">
																	<label for="status">Program Status <span class="requires">*</span></label>
																	<select class="form-control" name="status" required>
																		<option value="">Select</option>	
																		<option value="1"  <?php if(isset($edit_program[0])){if(1==$edit_program[0]['status']){ echo "Selected";}}else{
																			echo "Selected";
																		} ?>>Active</option>									
																		<option value="2"  <?php if(isset($edit_program[0])){if(2==$edit_program[0]['status']){ echo "Selected";}} ?>>Inactive</option>										
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
												<th>Concentration / Specialization</th>												
												<th>Status</th>									
												<th>Action</th>									
												<!--<th>Action</th>-->
											</tr>
										</thead>
										<?php //echo "<pre>"; print_r('Program_Name'); die; ?>
										<tbody> 
											<?php 
											$i=1;
											foreach($Program_Name as $row) { ?>
											<tr>
												<td><?=$i++;?>
												</td>
												<td><?=$row['Program_Name']?>
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
													<a href="<?=base_url('')?>admin/Master/addProgram/<?=encryptor('encrypt', $row['ProgramID'])?> " 	class="btn btn-info waves-effect waves-light btn-xs m-b-5">
														<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
														<span><strong></strong></span>            
													</a>
													<span class="glyphicon glyphicon-trash delete_program" rel_id="<?= encryptor('encrypt', $row['ProgramID']); ?>"  style="color: #fff;background: #ef5050;padding: 5px;cursor: pointer;"></span>
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





<div class="modal fade" id="progrom_delete_modal" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Message</h4>
			</div>
			<form action="<?= base_url(); ?>admin/master/delete_addProgram" method="post">
				<div class="modal-body">
					<input type="hidden" class="form-control" id="del_program_id" name="program_id">
					<?= csrf_field() ?>
					<div class="col-md-12">
						<b>This program is assigned to following student -</b> 
					</div>
					<div class="col-md-12" id="student_list" style="height: 100px;overflow-y: scroll; "></div>
					<div class="col-md-12">
						<h4>This action will remove this program from student info</h4>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					<input type="submit" class="btn btn-success" value="Yes">
				</div>
			<form>
		</div>

	</div>
</div>








<div>
<?php if(isset($edit_program[0]) ) {?>  
 <script type="text/javascript"> 
  $(document).ready(function(){ 
	$('#panel-modal').modal('show'); 
	});
</script>
<?php } ?>
<script>
	$(document).on('click','.delete_program',function(){
		var id= $(this).attr('rel_id');
		$('#del_program_id').val(id);
		  $.ajax({
		        url: '<?= base_url(); ?>admin/Master/get_user_by_progrm',
		        data: {'id': id}, // change this to send js object
		        type: "post",
		         dataType: 'json', 
		        success: function(data){
		           var hml ='';
		           hml +="<table class='table'> ";
		           $.each(data, function(key, value) {
					    hml+="<tr><td style='text-align:left;'>"+value.FirstName+" "+value.LastName+"</td></tr>";
					})
		           hml +="</table>";
		           $('#student_list').html(hml);
		           $('#progrom_delete_modal').modal('show');
		        }
		      });



		
	});
</script>