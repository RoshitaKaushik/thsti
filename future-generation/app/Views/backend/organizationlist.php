<?php //echo "<pre>";print_r($budget);die;

/* if(isset($result[0])){
$arr = $result[0];
$CampaignID = $arr['CampaignID'];
$CampaignName = $arr['CampaignName'];
$Active = $arr['Active'];
}  */

?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
	.table>tbody>tr>td,
	.table>tbody>tr>th,
	.table>tfoot>tr>td,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>thead>tr>th {
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

		#overlay>p {
			color: #FF9800;
			position: absolute;
			top: 60%;
			left: 49%;
			margin: -28px 0 0 -25px;
		}

	}

	.buttons-excel {
		display: none;
	}
</style>
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">
			<?php if (session()->getFlashdata('msg') != '') { ?>
				<div class="alert alert-success">
					<?php echo session()->getFlashdata('msg'); ?>
				</div>
			<?php } ?>
			<!-- Page-Title -->

			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"> Organization List
								<a href="https://staging.apps.future.edu/admin/Form/addOrganization" class="btn-sm btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" style="font-size: 12px;background: #fff;color: #000!important;border: 1px solid #d5d5d5;padding: 4px 12px;margin: 0;">
									<i class="icon ion-plus-circled"></i>
									<span><strong>Add New</strong></span>
								</a>
							</h3>
						</div>
						<div class="panel-body">
							<div class="row">

								<div class="col-md-12 col-sm-12 col-xs-12">
									<table id="SemesterListing" class="table table-striped table-bordered alldatatable">
										<thead>
											<tr>
												<th>Organization Id </th>
												<th>Organization Name</th>
												<th>Website</th>
												<th>Action</th>

											</tr>
										</thead>
										<tbody>
											<?php
											$sn = 1;
											foreach ($organizationList as $org) {
											?>
												<tr>
													<td><?php echo $org['id']; ?></td>
													<td><?php echo $org['name']; ?></td>
													<td><?php echo $org['website']; ?></td>
													<td>
														<a href="<?= site_url('admin/Form/editOrganization/' . encryptor('encrypt', $org['id'])) ?>">
															<span class="btn btn-success btn-xs">View</span>
														</a>
													</td>
												</tr>
											<?php
											}
											?>

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