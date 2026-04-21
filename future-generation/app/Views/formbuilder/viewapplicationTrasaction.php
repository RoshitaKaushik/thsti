<?php  ?> 
<div class="content-page">
<!-- Start content -->
<div class="content">
	<div class="container">

		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
			<h4 class="pull-left page-title">Applications</h4>
			</div>
		</div>
		  <?php if(session()->getFlashdata('msg') !=''){ ?>
			<?php echo session()->getFlashdata('msg'); ?>
	     <?php } ?>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-color panel-info">
					<div class="panel-heading">
						<h3 class="panel-title"><?=$page?></h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<table class="table table-striped table-bordered datatable">
									<thead>
										<tr>
											<th>S.NO</th>
											<!--<th>Transaction ID</th>-->
											<th>APPLICATION ID</th>
											<th>STUDENT NAME</th>
											<th>Transaction Date</th>
											<th>Forms</th>
											<th>Transaction Amount</th>
											
										</tr>
									</thead>							 
									<tbody> 									
										
									<?php 
									$count = 0;
									
									//echo '<pre>'; print_r($apps); die;
										
									if(!empty($apps)){
										
										
										foreach($apps as $app){
											$count++;
											$controller = get_controller($app['scheme_id']);
											$application_code = $app['application_code'];
											
										    $scheme_id=$app['scheme_id'];
										    $component_id=$app['component_id'];
											
											//$application_save_status = $app['save_status'];
											$component_details = get_componentsByID($app['component_id']);
										    $datafield_details = getCustomFieldsActivename($component_id);
											
											//echo '<pre>'; print_r($datafield_details);
												
											$index =  array_search('311', array_column($datafield_details, 'field_id'));
											
											//echo '<pre>'; print_r($index);
											//echo '<pre>'; print_r($datafield_details[$index]['field_id']);
                                         
											//echo '<br/>';
																		
											
											
					$field_value=get_custom_fields_values_custom($application_code, $datafield_details[$index]['field_id']);
											
											//echo '<pre>'; print_r($field_value);die;
											//echo $field_value; die;
											//die;
			
											
											
									?>
									<tr>
										<td><?=$count?></td>
										<!-- <td><?=$app['transaction_id']?></td>-->
										<td><?=$app['application_code']?></td>
										<td><?=$field_value['field_value']?></td>
										<td><?=dd_mm_yyyy($app['transaction_date'])?></td>
										<td><?=$component_details[0]['scheme_component_name']?></td>
										<td><?=$app['transaction_amount']?></td>
										<!-- <td><?=$app['user_ip']?></td>-->
										
										
										
									</tr>	
										<?php 
											
											}
										}
										?>
									</tbody>
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>			
		</div> <!-- End Row -->
	</div> <!-- container -->
			   
</div> <!-- content -->
           <style>
th, td {
     text-align: left;
}

</style>