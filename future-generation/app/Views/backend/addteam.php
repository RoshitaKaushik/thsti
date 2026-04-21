<?php //echo "<pre>";print_r($budget);die;

$add_permission = false;
if (session()->get('profiles')) {
	if (in_array(1, session()->get('profiles'))) {
		$add_permission = true;
	}
} elseif (session()->get('role') == 1) {
	$add_permission = true;
}
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
	}

	.btn-success {
		font-size: 12px;
		background: #fff;
		color: #000 !important;
		border: 1px solid #d5d5d5;
		padding: 4px 12px;
		margin: 0
	}

	.view_type_button {
		background-color: #fafafa;
		color: rgba(0, 0, 0, 0.6) ! important;
		font-size: 14px;
		-webkit-border-radius: 2px;
		-moz-border-radius: 2px;
		border-radius: 2px;
		-webkit-box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
		-moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
		box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
		border: 1px solid rgb(171, 167, 167);
		box-shadow: none;
	}

	button.btn.view_type_button.active {
		background: #d1f1fa !important;
	}
</style>
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">
			<?php if (session()->getFlashdata('msg') != '') { ?>
				<div class="alert alert-success">
					<?php if ($msg = session()->getFlashdata('msg')): ?>
						<?php if (is_array($msg)): ?>
							<ul>
								<?php foreach ($msg as $m): ?>
									<li><?= esc($m) ?></li>
								<?php endforeach ?>
							</ul>
						<?php else: ?>
							<p><?= esc($msg) ?></p>
						<?php endif ?>
					<?php endif ?>

				</div>
			<?php } ?>
			<!-- Page-Title -->

			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title" style="display:inline"> Team Manage </h3>

							<div class="btn-group tab_btn_gourp" role="group" aria-label="Basic example" style="margin-left: 20px;">
								<button type="button" data-index="All" class="btn view_type_button active">All</button>
								<button type="button" data-index="Active" class="btn view_type_button">Active</button>
								<button type="button" data-index="Inactive" class="btn view_type_button">Expired</button>
							</div>

							<?php
							if ($add_permission) {
							?>
								<button type="button" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" data-toggle="modal" data-target="#panel-modal"><span class="icon ion-plus-circled" aria-hidden="true"> ADD </span></button>
							<?php } ?>

						</div>
						<div class="panel-body">
							<div class="row">
								<?php echo form_open_multipart("admin/Users/submitteam"); ?>
								<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
									<div class="modal-dialog">
										<div class="modal-content p-0 b-0">
											<div class="row">
												<!-- Basic example -->
												<div class="col-md-12">
													<div class="panel panel-color panel-info">
														<div class="panel-heading">
															<h3 class="panel-title">Add Team </h3>
														</div>
														<div class="panel-body">
															<div class="col-md-12">
																<div class="form-group">
																	<input type="hidden" name="id" value="<?php if (isset($edit_team[0])) {
																												echo $edit_team[0]['id'];
																											} ?>">
																	<label>Team <span class="requires">*</span></label>
																	<input type="text" class="form-control " id="catagory_name" name="team_name" placeholder="Enter Team Name" value="<?php if (isset($edit_team[0])) {
																																															echo $edit_team[0]['team_Name'];
																																														} ?>" required>
																</div>

															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<label for="Active">Supervisor <span class="requires">*</span></label>
																	<select class="form-control" name="team_member" required>
																		<option value="">Select</option>
																		<?php foreach ($facultystaff as  $staff) { ?>

																			<option value="<?php echo $staff['ID'] ?>" <?php if (isset($edit_team[0]) && $edit_team[0]['empid'] == $staff['ID']) {
																															echo "selected";
																														} ?>>
																				<?php echo $staff['FirstName'] . " " . $staff['LastName'] . "(" . $staff['ID'] . ")"; ?>
																			</option>
																		<?php } ?>
																	</select>
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<label for="Active">Team Status <span class="requires">*</span></label>
																	<select class="form-control" name="Active" required>
																		<option value="">Select</option>
																		<option value="1" <?php if (isset($edit_category[0])) {
																								if (1 == $edit_category[0]['Active']) {
																									echo "Selected";
																								}
																							} else {
																								echo "Selected";
																							} ?>>Active</option>
																		<option value="2" <?php if (isset($edit_category[0])) {
																								if (2 == $edit_category[0]['Active']) {
																									echo "Selected";
																								}
																							} ?>>Inactive</option>
																	</select>
																</div>
															</div>
														</div> <!-- panel-body -->
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

								<div class="col-md-12 col-sm-12 col-xs-12" id="result">
									<?php echo view('/templates/filter/filter_addteam', $data); ?>
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
	<?php if (isset($edit_team[0])) { ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#panel-modal').modal('show');
			});
		</script>
	<?php } ?>
	<?php if (isset($edit_subcategory[0])) { ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#panel-modall').modal('show');
			});
		</script>
	<?php } ?>

	<script>
		$(document).on('click', '.view_type_button', function() {
			$('.view_type_button').removeClass('active');
			$(this).addClass('active');
			filter_progress_loader();
		})

		function form_submit_data() {
			var tab_type = $('button.btn.view_type_button.active').attr('data-index');
			$.ajax({
				type: "POST",
				dataType: 'html',
				url: '<?= base_url() ?>admin/Users/filter_team',
				data: {
					tab_type: tab_type,
					submit: 'submit'
				},
				success: function(response) {
					$('#result').html(response);
					$('#alldataTable').DataTable({
						"order": [],
						"pageLength": 25,
						'columnDefs': [{
							'targets': [0, 3, 4], // column index (start from 0)
							'orderable': false, // set orderable false for selected columns
						}],
					});
				}
			});
		}
	</script>