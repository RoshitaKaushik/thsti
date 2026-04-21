<?php //echo "<pre>";print_r($data);die;
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
				<?php echo session()->getFlashdata('msg'); ?>
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
									<table class="second_table table table-striped table-bordered">
										<thead>
											<tr>							
												<th>Assign Category (Option-1)</th>						
												<th>Assign Category (Option-2)</th>
												<th></th>
											</tr>
										</thead>
										<tbody> 
											<?php 
											$i=1;
											if(!empty($contract_assign)){
											foreach($contract_assign as $row) { 
											//check user active or  not
											$status = check_user_active_or_not($row['empid']);
											?>
											<tr <?php if((isset($status[0]['account_status'])) !='1')
        										     { echo 'style="background-color:#f78282 ! important;"';}
        										     ?> >
												<td>
												    <?php
												    if(isset($status[0]['account_status']) =='1'){
                                                        ?>
                                                        <span class="assign_category glyphicon glyphicon-plus" style='color:green;cursor:pointer;' rel_id="<?=$row['empid']; ?>" ></span>
                                                        <span class="glyphicon glyphicon-trash text-danger remove_category" rel_id="<?=$row['empid']; ?>" style='cursor:pointer;'></span>
                                                        <?php
                                                    }
                                                    else{
                                                        echo "<span class='btn btn-danger btn-xs inactive_btn'>Inactive Account</span>";
                                                    }
        										     ?>
												</td>

												<td>
													<button class="btn-info cat_assign" rel_id="<?=$row['empid']; ?>" rel_name="<?= $row['FirstName']; ?> <?= $row['LastName']; ?>">Assign Category</button>
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





