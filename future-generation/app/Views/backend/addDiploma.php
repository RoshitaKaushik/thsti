<?php 
   $post = session()->getFlashdata('post') ? session()->getFlashdata('post') : array();
	if(session()->getFlashdata('msg')!=''){ 
		echo session()->getFlashdata('msg'); 
		session()->remove('msg');
	}
	if(session()->getFlashdata('post')!='')
	{
	  $post = session()->getFlashdata('post');
	}
	
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
				<?php } ?>
				<!-- Page-Title -->
				<?php echo form_open_multipart("admin/Master/submitDiploma"); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Add Diploma
							    <?php
							     if($add_permission)
							     {
							         ?>
							         <button  type = "button" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" data-toggle="modal" data-target="#panel-modal" ><span class="icon ion-plus-circled" aria-hidden="true">   ADD </span></button>
							         <?php
							     }
							     ?>
							     
							</h3>
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
														<div class="panel-heading"><h3 class="panel-title">Add Diploma  </h3>
														</div>
														<div class="panel-body">
															<div class="col-md-12">	
																<div class="form-group">
																	<input type="hidden" name="dipID" value="<?php if(isset($edit_diploma[0]) ) { echo $edit_diploma[0]['dipID']; } ?>" >
																	<label>Diploma <span class="requires">*</span></label>
																	<input type="text" class="form-control" id="dipName" name="dipName" placeholder="Enter Diploma" value="<?php if(isset($edit_diploma[0]['dipName']) ) { echo $edit_diploma[0]['dipName'];} else if(isset($post['dipName'])){ echo $post['dipName'];} ?>" maxlength="255" required>
																</div>
															</div>
															
															<div class="col-md-12">	
																<div class="form-group">
																	<label for="Active">Grad/Undergrad<span class="requires">*</span></label>
																	<select class="form-control" name="grad_undergrad" required>
																		<option value="">Select Grad/Undergrad</option>	
																		<option value="G"  <?php if(isset($edit_diploma[0])){if('G'==$edit_diploma[0]['grad_undergrad']){ echo "Selected";}} else if(isset($post['grad_undergrad'])){ echo($post['grad_undergrad']=='G' ? 'selected="selected"':'');} ?>>Grad</option>									
																		<option value="U"  <?php if(isset($edit_diploma[0])){if('U'==$edit_diploma[0]['active']){ echo "Selected";}} else if(isset($post['grad_undergrad'])){ echo ($post['grad_undergrad']=='U' ? 'selected="selected"':'');} ?>>Undergrad</option>										
																	</select>
																</div>
															</div>
															
															<div class="col-md-12">	
																<div class="form-group">
																	<label for="Active"> Active<span class="requires">*</span></label>
																	<select class="form-control" name="Active" required>
																		<option value="">Select</option>	
																		<option value="1"  <?php if(isset($edit_diploma[0])){if(1==$edit_diploma[0]['active']){ echo "Selected";}} else if(isset($post['Active'])){ echo($post['Active']=='1' ? 'selected="selected"':'');} ?>>Yes</option>									
																		<option value="2"  <?php if(isset($edit_diploma[0])){if(2==$edit_diploma[0]['active']){ echo "Selected";}}else if(isset($post['Active'])){ echo($post['Active']=='2' ? 'selected="selected"':'');} ?>>No</option>										
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
												<th>Diploma </th>	
                                                <th>Grad/Undergrad</th>												
												<th>Active</th>									
												<th>Action</th>									
												<!--<th>Action</th>-->
											</tr>
										</thead>
										<tbody> 
											<?php 
											$i=1;
											if(!empty($diploma)){
											foreach($diploma as $row) {
												
												$grad_undergrad = $row['grad_undergrad'];
												if($grad_undergrad=='G'){
													$msg='Grad';
												}elseif($grad_undergrad=='U'){
													$msg='Undergrad';
												}else{
													$msg='';
												}
												

											?>
											<tr>
												<td><?=$i++;?></td>
												<td><?=$row['dipName']?>
												<td><?=$msg?></td>
												</td>												
												<td>
													<?php
														if ($row['active'] == "1") {
															echo "Yes";
														}
														else {
															echo "No";			
														}
																								
													?>
														
												</td>
												<td>
												    <?php
                    							     if($add_permission)
                    							     {
                    							         ?>
													<a href="<?=base_url('')?>admin/Master/addDiploma/<?=encryptor('encrypt', $row['dipID'])?> " 	class="btn btn-info waves-effect waves-light btn-xs m-b-5">
														<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
														<span><strong></strong></span>            
													</a>
													
													<a href="javascript:void(0);" title="Click To Delete"  	class="btn btn-danger waves-effect waves-light btn-xs m-b-5 rmv" data-urlm="<?=encryptor('encrypt', $row['dipID'])?>">
														<span class="fa fa-trash-o" aria-hidden="true"></span>
														<span><strong></strong></span>            
													</a>
													<?php
                    							     }
                    							     ?>
													
												</td>
											</tr>
											<?php } } ?>
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
<?php if(isset($edit_diploma[0]) ) {?>  
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

		if(confirm('Are you sure, Want to Delet this record?')){ 
			loading(); 
			$.ajax({ 
				type: "POST", 
				url: "<?=base_url()?>" + "admin/Master/delDiploma",  
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