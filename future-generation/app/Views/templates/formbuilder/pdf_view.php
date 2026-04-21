<?php

if (isset($component_id) == '19' || isset($component_id) == '46') {
?>
	<style>
		.ETHNICITY {
			display: none;
		}

		.VETERANSTATUS {
			display: none;
		}

		.AREYOUANAMERICORPSMEMBER {
			display: none;
		}

		.AREYOUAPEACECORPSVOLUNTEER {
			display: none;
		}
	</style>
<?php
}
?>


<?php

$application_code = isset($user['application_code']) ? encryptor('encrypt', $user['application_code']) : '';
$component_id = isset($user['component_id']) ? $user['component_id'] : '';
if (!isset($component_details)) {
	$component_details = getComponentWithFormModule($component_id);
}

//echo "<pre>";print_r($user);die;
?>

<?php
if (!empty($component_details)) {
	$component_details = $component_details[0];
?>
	<style>
		.text-danger strong {
			color: #9f181c;
		}






		table.table.table-bordered tr:last-child th,
		table.table.table-bordered tr:last-child td {
			border-bottom: 1px solid #6e6e6e;
		}

		#container {
			background-color: #dcdcdc;
		}


		.date-title-box {
			text-align: left;
			text-transform: capitalize;

			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			color: #000;

		}

		table .row_line td {
			font-size: 10px !important;
		}
	</style>
	<section class="application-form-page" style="position:relative">

		<table class="table table-bordered-box" cellpadding="5">
			<tbody>
				<tr>
					<th colspan="3"><br></th>
				</tr>
				<tr>
					<td style="width:78%"><br>
						<span style="font-size:17px;text-align: left;font-family: Arial;margin: 0;padding: 0 0 0 20px;text-transform: capitalize;font-weight: 400;"><?= $component_details['scheme_component_name'] ?></span><br>
						<span style="font-size:10px;font-family:Arial;">Report Generated <?= date('m/d/Y h:i:s', strtotime($user['created_date'])); ?> </span>
					</td>
					<td style="width:2%"></td>
					<td style="width:20%" class="logo-title-box"><img <img src="assets/images/pdflogo.png" alt="Logo">
						style="height:45px;"></td>

				</tr>
				<tr>
					<th colspan="3"><br></th>
				</tr>
			</tbody>
		</table>

		<?php

		$field_grouped_arr = array();
		foreach ($field_details as $item) {
			$field_grouped_arr[$item['parent']][] = $item;
		}
		?>

		<table cellpadding="5">
			<?php
			//	echo "<pre>"; print_r($field_grouped_arr); die;
			$get_us_status = '';
			if (!empty($field_grouped_arr)) {
				foreach ($field_grouped_arr as $key => $values) {
					$new_parent = 1;
					foreach ($values as $row) {
			?>
						<!-- Heading -->
						<?php if ($key != 0 && $key != '' && $new_parent == 1) { ?>
							<!--style="line-height:3px;"-->
							<tr>
								<td colspan="2" style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family:'Arial';border:1px solid grey;margin:0;font-size:12px;font-family: Arial;"><?= $row['parent_name'] ?></label></td>
							</tr>
						<?php }  ?>

						<?php if ($row['field_type'] == 1) { ?>
							<!-- Text Field -->
							<!--style="line-height:2px"-->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?> </label></td>
								<td style="border-bottom:1px solid #000;"><?php
																			if ($application_code != '') {
																				$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
																			} else {
																				$field_value = array();
																			}
																			?>
									<?php if (!empty($field_value)) { ?>
										<label style="font-family: 'Arial';"> <?= $field_value['field_value']; ?></label>
									<?php } ?>

									<?php if ($row['field_id'] == 311): ?>
										<br>
										<span style="font-weight:lighter; font-size:8px;">(Make sure your name appears exactly as you want it printed on the certificate.)</span>
									<?php endif; ?>
								</td>
							</tr>


						<?php } elseif ($row['field_type'] == 2) { ?>
							<!-- Integer Field -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?> </label></label></td>
								<td style="border-bottom:1px solid #000;"><?php
																			if ($application_code != '') {
																				$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
																			} else {
																				$field_value = array();
																			}

																			?>
									<?php if (!empty($field_value)) { ?>
										<label style="font-family:'Arial';"> <?= $field_value['field_value'] ?></label>
									<?php } ?>
								</td>
							</tr>
						<?php } elseif ($row['field_type'] == 3) { ?>
							<!-- List Field -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?> </label></label></td>
								<td style="border-bottom:1px solid #000;"><?php
																			if ($application_code != '') {
																				$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
																			} else {
																				$field_value = array();
																			}
																			?>
									<?php if (!empty($field_value)) {  ?>
										<label style="font-family:'Arial';"> <?= $field_value['field_value'] ?></label>
									<?php } ?>
								</td>
							</tr>
						<?php } elseif ($row['field_type'] == 4) {  ?>
							<!-- Long Text Field -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?> </label></label></td>
								<td style="border-bottom:1px solid #000;"><?php
																			if ($application_code != '') {
																				$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
																			} else {
																				$field_value = '';
																			}
																			?>
									<?php if (!empty($field_value)) { ?>
										<label style="font-family:'Arial';"> <?= $field_value['field_value'] ?></label>
									<?php } ?>
								</td>
							</tr>

						<?php } elseif ($row['field_type'] == 6) { ?>
							<!-- Date Field -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?></label></td>
								<td style="border-bottom:1px solid #000;">
									<?php
									if ($application_code != '') {
										$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
									} else {
										$field_value = array();
									}

									?>
									<?php
									if (isset($field_value['field_value'])) {
										if ($field_value['field_value'] != '') {

									?>
											<label style="font-family:'Arial';"> <?= date('m/d/Y', strtotime($field_value['field_value'])) ?></label>
									<?php }
									} ?>
								</td>
							</tr>
						<?php } elseif ($row['field_type'] == 7) { ?>
							<!-- Image Field -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family: 'Arial';"><?= trim(str_replace("Upload", "", $row['field_name'])) ?></label></td>
								<td style="border-bottom:1px solid #000;"><?php
																			if ($application_code != '') {
																				$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
																			} else {
																				$field_value = array();
																			}
																			?>
									<?php if (isset($field_value['field_value']) && $field_value['field_value'] != '') { ?>
										<img width="30px" height="20px" src="<?= base_url($field_value['field_value']) ?>">
									<?php } ?>
								</td>
							</tr>

						<?php } elseif ($row['field_type'] == 8) { ?>
							<!-- Pdf Field -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?></label></td>
								<td style="border-bottom:1px solid #000;">
									<?php
									if ($application_code != '') {
										$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
									} else {
										$field_value = array();
									}
									?>
									<?php if (isset($field_value['field_value']) && $field_value['field_value'] != '') { ?>
										<!--<a href="<?= base_url($field_value['field_value']) ?>" target="_blank"> <span class="btn btn-info waves-effect waves-light btn-xs m-b-5"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><span><strong>View</strong></span></a> -->
									<?php } ?>
								</td>
							</tr>
						<?php } elseif ($row['field_type'] == 9) {
							// Radio Field -->
							$f_val = str_replace(" ", "", $row['field_name']);
							$f_val  = str_replace("&nbsp;", "", $f_val);
							$f_val = str_replace("?", "", $f_val);
						?>
							<tr class="row_line" <?php if ($component_id == '19' || $component_id == '46') {
														if ($get_us_status == 'No') {
															if ($f_val == 'ETHNICITY' || $f_val == 'VETERANSTATUS' || $f_val == 'AREYOUANAMERICORPSMEMBER' || $f_val == 'AREYOUAPEACECORPSVOLUNTEER') {
																echo 'style="display:none;"';
															}
														}
													} ?>>
								<td style="border-bottom:1px solid #000;font-size:9px;"><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?></label></td>
								<td style="border-bottom:1px solid #000;font-size:9px;"><?php
																						if ($application_code != '') {
																							$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
																						} else {
																							$field_value = array();
																						}

																						if ($row['field_values'] != '') {
																							$field_values = explode(',', $row['field_values']);

																							if ($f_val == 'U.S.CITIZEN/USRESIDENT') {
																								$get_us_status = $field_values;
																								if ($field_value['field_value'] == 'No') {
																									$get_us_status = $field_value['field_value'];
																								}
																							}
																						?>
										<?php if (is_array($field_value) && isset($field_value['field_value'])): ?>
											<label style="font-family:'Arial';"> <?= esc($field_value['field_value']) ?></label>
										<?php endif; ?>
									<?php }  ?>
								</td>
							</tr>
						<?php } elseif ($row['field_type'] == 10) { ?>
							<!-- Checkbox Field -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?></label></td>
								<td style="border-bottom:1px solid #000;"><?php
																			if ($application_code != '') {
																				$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);

																				if (isset($field_value['field_value'])) {
																					//$field_value = !empty($field_value['field_value']) ? explode(',', $field_value['field_value']) : '';
																					$field_value = $field_value['field_value'];
																				} else {
																					$field_value = '';
																				}
																			} else {
																				$field_value = '';
																			}
																			?>
									<label style="font-family: 'Arial';"> <?= $field_value ?></label>
								</td>
							</tr>
						<?php } elseif ($row['field_type'] == 11) { ?>
							<!-- Paragraph -->
							<!-- <tr class="row_line">
								<td colspan="2" style="border-bottom:1px solid #000;"><label>
									<?php // echo htmlspecialchars_decode($row['field_name']); 
									?>
								</label></td>
						</tr> -->

						<?php } elseif ($row['field_type'] == 12) { ?>
							<!-- Integer Field -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?></label></td>
								<td style="border-bottom:1px solid #000;"><?php
																			if ($application_code != '') {
																				$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
																			} else {
																				$field_value = array();
																			}
																			$full_name = '';
																			if (!empty($field_value['field_value'])) {
																				$full_name = $field_value['field_value'];
																			}

																			?>
									<?php if (!empty($full_name)) { ?>
										<label style="font-family:'Arial';"> <?= $full_name ?></label>
									<?php } ?>
								</td>
							</tr>

						<?php } elseif ($row['field_type'] == 13) { ?>
							<!-- Mail to -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?></label></td>
								<td style="border-bottom:1px solid #000;">
									<?php
									if ($application_code != '') {
										$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
									} else {
										$field_value = array();
									}
									?>
									<?php if (!empty($field_value)) { ?>
										<label style="font-family:'Arial';"> <?= $field_value['field_value'] ?></label>
									<?php } ?>
								</td>
							</tr>
						<?php } elseif ($row['field_type'] == 14) { ?>
							<!-- DOB Field -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?></label></td>
								<td style="border-bottom:1px solid #000;">
									<?php if ($application_code != '') {
										$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
									} else {
										$field_value = array();
									}
									?>
									<?php if (!empty($field_value)) { ?>
										<label style="font-family:'Arial';"> <?= date('m/d/Y', strtotime($field_value['field_value'])) ?></label>
									<?php } ?>
								</td>
							</tr>

						<?php } elseif ($row['field_type'] == 15) { ?>
							<!-- Age Field -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?> </label></td>
								<td style="border-bottom:1px solid #000;"><?php
																			if ($application_code != '') {
																				$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
																			} else {
																				$field_value = array();
																			}

																			?>
									<?php if (!empty($field_value)) { ?>
										<label style="font-family:'Arial';"> <?= $field_value['field_value'] ?></label>
									<?php } ?>
								</td>
							</tr>

						<?php } elseif ($row['field_type'] == 16) {
							$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
							if ($field_value != '') {	?>
								<!-- Checkbox Field -->
								<tr class="row_line">
									<td style="border-bottom:1px solid #000;"><?php
																				if (trim($row['field_name']) != '&nbsp;') { ?><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?></label><?php
																																																					} ?>
									</td>
									<td style="border-bottom:1px solid #000;">
										<?php
										$field_value = '';
										if ($application_code != '') {
											$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
										?>
											<img src="<?= base_url('assets/check.png') ?>" width="15" height="10">
											<label style="font-family: 'Arial';"> <?= $field_value['field_value'] ?>
											</label>
										<?php
										} else {
											$field_value = array(); ?>
											<label style="font-family: 'Arial';"><?php echo 'I agree that all information is accurate to the best of my knowledge.' ?></label>
										<?php
										}
										?>
									</td>
								</tr>
							<?php }
						} elseif ($row['field_type'] == 22) {
							$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
							?>
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><?php if (trim($row['field_name']) != '&nbsp;') { ?>
										<label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?> </label>
									<?php
																			} ?>
								</td>
								<td style="border-bottom:1px solid #000;"><?php
																			$field_value = '';
																			if ($application_code != '') {
																				$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
																			?>
										<label style="font-family: 'Arial';"> <?= $field_value['field_value'] ?>
										</label>
									<?php
																			}
									?>
								</td>
							</tr>
						<?php } elseif ($row['field_type'] == 23) { ?>
							<!-- List Field -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?></label></td>
								<td style="border-bottom:1px solid #000;"><?php
																			if ($application_code != '') {
																				$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
																			} else {
																				$field_value = array();
																			}
																			?>
									<?php if (!empty($field_value)) {  ?>
										<label style="font-family:'Arial';"> <?= $field_value['field_value'] ?></label>
									<?php } ?>
								</td>
							</tr>
						<?php } elseif ($row['field_type'] == 18) { ?>
							<!-- Release -->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><?php if ($field_value['field_value'] == 'Yes') { ?><img src="<?= base_url('assets/check.png') ?>" width="15" height="10">
									<?php
																			} else { ?>
										<img src="<?= base_url('assets/check.png') ?>" width="15" height="10">
									<?php
																			}
									?>
								</td>
								<td style="border-bottom:1px solid #000;">
									<label style="font-family: 'Arial';">Release Given </label>
								</td>
							</tr>

						<?php } elseif ($row['field_type'] == 19) { ?>
							<!-- Gender -->
							<?php
							$f_val  = str_replace(" ", "", $row['field_name']);
							$f_val  = str_replace("&nbsp;", "", $f_val);
							$f_val  = str_replace("?", "", $f_val);
							?>
							<!--style="line-height:2px;"-->
							<tr class="row_line">
								<td style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family: 'Arial';"><?= $row['field_name'] ?></label></td>
								<td style="border-bottom:1px solid #000;">
									<?php
									if ($application_code != '') {
										$field_value = get_custom_fields_values(encryptor('decrypt', $application_code), $row['field_id']);
									} else {
										$field_value = array();
									}
									if ($row['field_values'] != '') {
										$field_values = explode(',', $row['field_values']);
										if ($f_val == 'U.S.CITIZEN/USRESIDENT') {
											$get_us_status = $field_values;
											if ($field_value['field_value'] == 'No') {
												$get_us_status = $field_value['field_value'];
											}
										}
									?>
										<label style="font-family:'Arial';"> <?= $field_value['field_value'] ?></label>
									<?php }  ?>
								</td>
							</tr>
							<!-- If gender other -->
							<?php if ($field_value['field_value'] == 'Other') {
								$data = get_other_gender_of_user($row['field_id'], encryptor('decrypt', $application_code));
							?>
								<!--style="line-height:2px;"-->
								<tr class="row_line">
									<td style="border-bottom:1px solid #000;"><label style="font-weight:bold;font-family: 'Arial';"><?= $data[0]['field_name'] ?></label></td>
									<td style="border-bottom:1px solid #000;">
										<?php if (!empty($field_value)) { ?>
											<label style="font-family:'Arial';"> <?= $data[0]['field_value']; ?></label>
										<?php } ?>
									</td>
								</tr>

							<?php
							}
							?>
						<?php }
						?>

						<?php $new_parent++; ?>
				<?php	}
				} ?>
			<?php } ?>
			<div></div>

		</table>
	<?php	} ?>

	</section>