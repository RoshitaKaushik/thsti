<style>
	.btn-purple,
	.btn-purple:hover,
	.btn-purple:focus,
	.btn-purple:active {
		background-color: #7e57c2 !important;
		border: 1px solid #7e57c2 !important;
		color: #FFFFFF !important;
		border-radius: 2px !important;
		padding-top: 1px !important;
		padding-right: 3px !important;
		padding-bottom: 1px !important;
		padding-left: 3px !important;
	}

	.table-responsive {
		overflow: auto ! important;
	}

	.profile-pic-box {
		box-shadow: 0 10px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
		width: 130px;
		border-radius: 5px;
		border: 4px solid #fff;
	}

	.control-label {
		font-weight: 500;
		color: #002f71;
	}

	#my-button {
		margin: 10px 0px 0px 15px;
		border: 0px;
		padding: 5px;
	}
</style>
<?php
$access = getAccess(1); //1 for general
$country_js = [];
if (!empty($country)) {
	$country_js = json_encode($country);
}
$state_js = [];
if (!empty($states)) {
	$state_js = json_encode($states);
}

if (!empty($address_type)) {
	$address_type_js = json_encode($address_type);
}

if (session()->getFlashdata('post')) {
	$post = session()->getFlashdata('post');
} else {
	$post = array();
}
//echo"<pre>";print_r($post);die();

//echo"<pre>";print_r($infos);die();

?>
<style>
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

	.invalid {
		background-color: #ff9494 ! important;
	}
</style>
<div id="tab1">


	<div class="col-sm-12" style="display:<?php if (isset($form_id)) {
												echo ($form_id != '' ? 'block' : 'none');
											} ?>">
		<div class="panel-heading" style="padding-left:0px !important">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title">Overview</h3>
				</div>
				<div class="col-md-2">
					<?php if ($access['edit_access']) { ?>
						<h3 class="panel-title"> <button id="general_edit" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								<span><strong>Edit</strong></span></button>
						</h3>
					<?php } ?>
					<h3 class="panel-title"> <button id="general_view" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right hide"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
							<span><strong>View</strong></span></button>
					</h3>
				</div>
				<div class="col-md-12 final_msg">
					<span id="result_msg_general"></span>
				</div>
			</div>


		</div>
	</div>
	<?php
	$attr = array('class' => 'cmxform form-horizontal tasi-form research', 'id' => 'general_form');
	echo form_open_multipart('admin/form/addGenralInfo', $attr);
	//echo "<pre>"; print_r($infos);die;
	?>
	<input type="hidden" name="id" value="<?php if (isset($infos['ID'])) {
												echo $infos['ID'];
											} ?>">
	<div class="col-md-12">
		<div class="row">
			<div class="col-sm-5">
				<div class="col-sm-12">
					<div class="form-group">
						<label for="title " class="control-label col-sm-4">Title </label>
						<div class="col-sm-1"> :
						</div>
						<div class="col-sm-7">
							<span class="show"><?php
												if (isset($post['title'])) {
													echo $post['title'];
												} else if (isset($infos['title'])) {
													echo $infos['title'];
												} ?></span>

							<input class=" form-control hide name_validation" id="title" name="title" type="text" value="<?php
																															if (isset($post['title'])) {
																																echo $post['title'];
																															} else if (isset($infos['title'])) {
																																echo $infos['title'];
																															} ?>">
							<input type="hidden" class="form-control" id="admin_id" name="admin_id">
							<input type="hidden" name="save_status" value="<?php if (isset($infos['save_status'])) {
																				echo $infos['save_status'];
																			} ?>" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label for="First Name" class="control-label col-sm-4">First Name <span class="requires">*</span></label>
						<div class="col-sm-1"> :
						</div>
						<div class="col-sm-7">
							<span class="show"><?php
												if (isset($post['FirstName'])) {
													echo $post['FirstName'];
												} else if (isset($infos['FirstName'])) {
													echo $infos['FirstName'];
												} ?></span>

							<input class=" form-control name_validation hide" id="FirstName" name="FirstName" type="text" value="<?php
																																	if (isset($post['FirstName'])) {
																																		echo $post['FirstName'];
																																	} else if (isset($infos['FirstName'])) {
																																		echo $infos['FirstName'];
																																	} ?>" required>

						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label for="Last NAme" class="control-label col-sm-4">Last Name <span class="requires">*</span></label>
						<div class="col-sm-1"> :
						</div>
						<div class="col-sm-7">

							<span class="show"><?php
												if (isset($post['LastName'])) {
													echo $post['LastName'];
												} else if (isset($infos['LastName'])) {
													echo $infos['LastName'];
												} ?></span>
							<input class=" form-control hide name_validation" id="LastName" name="LastName" type="text" value="<?php
																																if (isset($post['LastName'])) {
																																	echo $post['LastName'];
																																} else if (isset($infos['LastName'])) {
																																	echo $infos['LastName'];
																																} ?>" required>

						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label for="Greetings" class="control-label col-sm-4">Greeting <span class="requires">*</span> </label>
						<div class="col-sm-1"> :
						</div>
						<div class="col-sm-7">
							<span class="show"><?php
												if (isset($post['Greeting'])) {
													echo $post['Greeting'];
												} else if (isset($infos['Greeting'])) {
													echo $infos['Greeting'];
												} ?>
							</span>

							<input class=" form-control hide " id="Greeting" name="Greeting" type="text" value="<?php
																												if (isset($post['Greeting'])) {
																													echo $post['Greeting'];
																												} else if (isset($infos['Greeting'])) {
																													echo $infos['Greeting'];
																												} ?>" required>
							<input type="hidden" class="form-control" id="admin_id" name="admin_id">
							<input type="hidden" name="save_status" value="<?php if (isset($infos['save_status'])) {
																				echo $infos['save_status'];
																			} ?>" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label for="Greetings" class="control-label col-sm-4">Addressee<span class="requires">*</span> </label>
						<div class="col-sm-1"> :
						</div>
						<div class="col-sm-7">
							<span class="show"><?php
												if (isset($post['Addressee'])) {
													echo $post['Addressee'];
												} else if (isset($infos['Addressee'])) {
													echo $infos['Addressee'];
												} ?>
							</span>

							<input class=" form-control hide " id="Addressee" name="Addressee" type="text" value="<?php
																													if (isset($post['Addressee'])) {
																														echo $post['Addressee'];
																													} else if (isset($infos['Addressee'])) {
																														echo $infos['Addressee'];
																													} ?>" onkeypress="javascript:return ValidateAlphaNew(event)" required>
							<input type="hidden" class="form-control" id="admin_id" name="admin_id">
							<input type="hidden" name="save_status" value="<?php if (isset($infos['save_status'])) {
																				echo $infos['save_status'];
																			} ?>" required class="form-control">
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-5">

				<div class="col-sm-12">
					<div class="form-group">
						<label for="Comapny" class="control-label col-sm-4">Birthdate</label>
						<div class="col-sm-1"> :
						</div>
						<div class="col-sm-7">
							<span class="show"><?php
												if (isset($post['Birthdate'])) {
													echo $post['Birthdate'];
												} else if (isset($infos['Birthdate'])) {
													echo $infos['Birthdate'];
												} ?></span>

							<input class=" form-control hide datepickerbackward" id="Birthdate" name="Birthdate" type="text" value="<?php
																																	if (isset($post['Birthdate'])) {
																																		echo $post['Birthdate'];
																																	} else if (isset($infos['Birthdate'])) {
																																		echo $infos['Birthdate'];
																																	} ?>">
							<input type="hidden" class="form-control" id="admin_id" name="admin_id">
							<input type="hidden" name="save_status" value="<?php if (isset($infos['save_status'])) {
																				echo $infos['save_status'];
																			} ?>" class="form-control">
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="form-group">
						<label for="Comapny" class="control-label col-sm-4">Gender</label>
						<div class="col-sm-1"> :
						</div>
						<div class="col-sm-7">
							<span class="show">
								<?php
								if (isset($infos['Sex']) == 'M' || isset($infos['Sex']) == '1') {
									echo "Male";
								} elseif (isset($infos['Sex']) == 'F' || isset($infos['Sex']) == '2') {
									echo "Female";
								} elseif (isset($infos['Sex']) == '4' || isset($infos['Sex']) == 'O') {
									echo "Other";
								} elseif (isset($infos['Sex']) == '3') {
									echo "Prefer Not to Say";
								}
								?>
							</span>
							<select class="form-control hide" id="Sex" name="Sex">
								<option value="">Select</option>
								<option value="M" <?php if (isset($infos['Sex'])) {
														if ($infos['Sex'] == 'M') {
															echo "selected='selected'";
														} else if ($infos['Sex'] == '1') {
															echo "selected='selected'";
														}
													} ?>>Male</option>
								<option value="F" <?php if (isset($infos['Sex'])) {
														if ($infos['Sex'] == 'F') {
															echo "selected='selected'";
														} else if ($infos['Sex'] == '2') {
															echo "selected='selected'";
														}
													} ?>>Female</option>
								<option value="3" <?php if (isset($infos['Sex'])) {
														if ($infos['Sex'] == '3') {
															echo "selected='selected'";
														}
													} ?>>Prefer Not to Say</option>

								<option value="4" <?php if (isset($infos['Sex'])) {
														if (isset($infos['Sex']) == 'O') {
															echo "selected='selected'";
														} else if (isset($infos['Sex']) == '4') {
															echo "selected='selected'";
														}
													} ?>>Other</option>
							</select>
							<input type="hidden" class="form-control" id="admin_id" name="admin_id">
							<input type="hidden" name="save_status" value="<?php if (isset($infos['save_status'])) {
																				echo ($infos['Sex']);
																			} ?>" class="form-control">
						</div>
					</div>
				</div>

				<div class="col-sm-12 gender_another" <?php if (isset($infos['Sex']) != '4' && isset($infos['Sex']) != '0') {
															echo 'style="display:none;"';
														} ?>>
					<div class="form-group">
						<label for="Comapny" class="control-label col-sm-4">Gender (if other) </label>
						<div class="col-sm-1"> :
						</div>
						<div class="col-sm-7">
							<span class="show"><?php
												if (isset($post['gender_another'])) {
													echo $post['gender_another'];
												} else if (isset($infos['gender_another'])) {
													echo $infos['gender_another'];
												} ?></span>

							<input class=" form-control hide" id="gender_another" name="gender_another" type="text" value="<?php
																															if (isset($post['gender_another'])) {
																																echo $post['gender_another'];
																															} else if (isset($infos['gender_another'])) {
																																echo $infos['gender_another'];
																															} ?>">

						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="form-group">
						<label for="Driver's License" class="control-label col-sm-4">Ethnicity</label>
						<div class="col-sm-1"> :
						</div>
						<div class="col-sm-7">
							<span class="show"><?php
												if (isset($post['Ethnicity'])) {
													echo $post['Ethnicity'];
												} else if (isset($infos['Ethnicity'])) {
													echo $infos['Ethnicity'];
												} ?></span>
							<select name="Ethnicity" id="Ethnicity" class="form-control hide">
								<option value="">----- Please Select -----</option>
								<option value="American Indian" <?php if (isset($infos['Ethnicity']) == 'American Indian') {
																	echo 'selected';
																} ?>>American Indian</option>
								<option value="Asian" <?php if (isset($infos['Ethnicity']) == 'Asian') {
															echo 'selected';
														} ?>>Asian</option>
								<option value="Black/African American" <?php if (isset($infos['Ethnicity']) == 'Black/African American') {
																			echo 'selected';
																		} ?>>Black/African American</option>
								<option value="Hispanic/Latino" <?php if (isset($infos['Ethnicity']) == 'Hispanic/Latino') {
																	echo 'selected';
																} ?>>Hispanic/Latino</option>
								<option value="Native Hawaiian/Pacific Islander" <?php if (isset($infos['Ethnicity']) == 'Native Hawaiian/Pacific Islander') {
																						echo 'selected';
																					} ?>>Native Hawaiian/Pacific Islander</option>
								<option value="White" <?php if (isset($infos['Ethnicity']) == 'White') {
															echo 'selected';
														} ?>>White</option>
								<option value="Non-Resident Alien" <?php if (isset($infos['Ethnicity']) == 'Non-Resident Alien') {
																		echo 'selected';
																	} ?>>Non-Resident Alien</option>
								<option value="Unknown" <?php if (isset($infos['Ethnicity']) == 'Unknown') {
															echo 'selected';
														} ?>>Unknown</option>
							</select>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="form-group">
						<label for="Driver's License" class="control-label col-sm-4">US Citizenship Status</label>
						<div class="col-sm-1"> :
						</div>
						<div class="col-sm-7">
							<span class="show"><?php
												if (isset($post['citizenship'])) {
													echo $post['citizenship'];
												} else if (isset($infos['citizenship'])) {
													echo ($infos['citizenship']);
												} ?></span>
							<select name="citizenship" id="citizenship" class="form-control hide">
								<option value="">----- Please Select -----</option>
								<option value="US Citizen" <?php if (isset($infos['citizenship']) == 'US Citizen') {
																echo 'selected';
															} ?>>US Citizen</option>
								<option value="Naturalized" <?php if (isset($infos['citizenship']) == 'Naturalized') {
																echo 'selected';
															} ?>>Naturalized</option>
								<option value="Perm Resident Alien" <?php if (isset($infos['citizenship']) == 'Perm Resident Alien') {
																		echo 'selected';
																	} ?>>Perm Resident Alien</option>
								<option value="Not US Citizen" <?php if (isset($infos['citizenship']) == 'Not US Citizen') {
																	echo 'selected';
																} ?>>Not US Citizen</option>

							</select>
						</div>
					</div>
				</div>

				<?php

				$display_condition = "";
				if (isset($infos['citizenship'])) {
					if (isset($infos['citizenship']) == '') {
						$display_condition = "style='display:none;'";
					}
				} else {
					$display_condition = "style='display:none;'";
				}

				?>
				<div class="col-sm-12 citizenship_country" <?= $display_condition ?>>
					<div class="form-group">
						<label for="Driver's License" class="control-label col-sm-4">Country</label>
						<div class="col-sm-1"> :
						</div>
						<div class="col-sm-7">
							<span class="show"><?php
												if (isset($post['citizenship_country'])) {
													echo $post['citizenship_country'];
												} else if (isset($infos['citizenship_country'])) {
													echo $infos['CountryName'];
												} ?></span>
							<select name="citizenship_country" id="citizenship_country" class="form-control hide">
								<option value="">----- Please Select -----</option>
								<?php
								if (isset($country)) {
									foreach ($country as $con) {
								?>
										<option <?php if (isset($infos['citizenship_country']) == $con['CountryID']) {
													echo "selected";
												} ?> value="<?= $con['CountryID'] ?>"><?= $con['CountryName'] ?></option>
								<?php
									}
								}

								?>
							</select>
						</div>
					</div>
				</div>

			</div>

			<div class="col-md-2">
				<?php
				if (!empty($user_profile)) {
				?>
					<img class="profile-pic-box" src="<?= base_url() . $user_profile[0]['profile_image']; ?>">
				<?php
				}
				?>
				<!--input type="button" id="my-button" value="Change Profile" class="hide">
            <input type="file" name="my_file" id="my-file" style="visibility: hidden;"-->
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group no_border">
			<!--<label for="firstname" class="control-label col-sm-4">Address Details </label>
	</div> -->
			<div style="overflow-x:auto;">
				<table class="table table-striped table-bordered" id="table_address">
					<tbody id="TextBoxesGroupRD">
						<tr>
							<th style="width:20%">Street Address<span class="requires">*</span></th>
							<th style="width:20%">Address2</th>
							<th>City<span class="requires">*</span></th>
							<th>State</th>
							<th>Postal Code</th>
							<th>Country<span class="requires">*</span></th>
							<th>Type<span class="requires">*</span></th>
							<th>Active</th>

						</tr>
						<?php
						$ref_count = 0;
						//if(isset($address['application_code'])  || isset($address['infos_unique_id'])){								
						$ref = getAddress(isset($infos['ID']) ? $infos['ID'] : 0); //($address['application_code'], $address['infos_unique_id']);
						//}else{
						//$ref= '';
						//}
						echo '<input type= "hidden" id="rem_addcount7" value="0" >';
						if (!empty($ref)) {
							$ref_count = 0;
							echo '<input type= "hidden" id="addcount7" value="' . (count($ref) + 1) . '" >';
							foreach ($ref as $address) {
								$ref_count++;
						?>
								<tr id="TextBoxDivGEN<?php echo $ref_count; ?>">
									<td style="width:20%">
										<input type="hidden" name="Address_RowID[<?= $ref_count; ?>]" value="<?php
																												if (isset($address['Address_RowID'])) {
																													echo $address['Address_RowID'];
																												} elseif (isset($post['Address_RowID'][$ref_count])) {
																													echo $post['Address_RowID'][$ref_count];
																												} ?>">
										<input type="hidden" name="AddressID[<?= $ref_count; ?>]" value="<?php if (isset($address['AddressID'])) {
																												echo $address['AddressID'];
																											} elseif (isset($post['AddressID'][$ref_count])) {
																												echo $post['AddressID'][$ref_count];
																											} ?>">
										<span class="show"><?php if (isset($address['Street_Address'])) {
																echo $address['Street_Address'];
															} elseif (isset($post['Street_Address'][$ref_count])) {
																echo $post['Street_Address'][$ref_count];
															} ?></span>
										<textarea rows='1' class="form-control street_validate hide" name="Street_Address[<?= $ref_count; ?>]" id="Street_Address<?= $ref_count; ?>" onChange="validateAddressXCheckbox(<?php echo $ref_count; ?>)"><?php if (isset($address['Street_Address'])) {
																																																														echo $address['Street_Address'];
																																																													} elseif (isset($post['Street_Address'][$ref_count])) {
																																																														echo $post['Street_Address'][$ref_count];
																																																													} ?></textarea>
									</td>
									<td>
										<span class="show"><?php if (isset($address['Address2'])) {
																echo $address['Address2'];
															} elseif (isset($post['Address2'][$ref_count])) {
																echo $post['Address2'][$ref_count];
															} ?></span>
										<textarea rows='1' class="form-control hide" name="Address2[<?= $ref_count; ?>]" id="Address2<?= $ref_count; ?>" onChange="validateAddressXCheckbox(<?php echo $ref_count; ?>)"><?php if (isset($address['Address2'])) {
																																																							echo $address['Address2'];
																																																						} elseif (isset($post['Address2'][$ref_count])) {
																																																							echo $post['Address2'][$ref_count];
																																																						} ?></textarea>
									</td>
									<td>
										<span class="show"><?php if (isset($address['City'])) {
																echo $address['City'];
															} ?></span>
										<input class="form-control street_validate hide" id="City<?= $ref_count; ?>" name="City[<?= $ref_count ?>]" type="text" value="<?php if (isset($address['City'])) {
																																											echo $address['City'];
																																										} ?>">
									</td>

									<td>
										<span class="show"><?php
															if (!empty($states)) {
																foreach ($states as $row) {
															?><?php echo $row['StateID'] == $address['State'] ? $row['StateID'] : ''; ?><?php }
																																} ?>
										</span>

										<select class="form-control hide" id="state" name="State[<?= $ref_count ?>]">
											<option value="" selected="selected">Select</option>
											<?php
											if (!empty($states)) {
												foreach ($states as $row) {
											?>
													<option value="<?php echo $row['StateID'];  ?>" <?php if (isset($address)) {
																										if ($row['StateID'] == $address['State']) {
																											echo 'selected';
																										}
																									} ?>> <?php echo $row['StateID'] . " - ";
																											echo $row['StateName'];  ?></option>
											<?php }
											} ?>
										</select>
									</td>
									<td>
										<span class="show"><?php if (isset($address['Postal_Code'])) {
																echo $address['Postal_Code'];
															} ?></span>
										<input class=" form-control  hide" id="Postal_Code<?= $ref_count; ?>" name="Postal_Code[<?= $ref_count; ?>]" type="text" value="<?php if (isset($address['Postal_Code'])) {
																																											echo $address['Postal_Code'];
																																										} ?>" maxlength="7">
									</td>
									<td>
										<span class="show"><?php
															if (!empty($country)) {
																foreach ($country as $con) {
															?><?php echo ($con['CountryID'] == $address['Country'] ? $con['CountryName'] : ''); ?><?php }
																																			} ?></span>
										<select class="form-control street_validate hide" name="Country[<?= $ref_count ?>]" onChange="getstatedetails(this.value)">
											<option value="">Select</option>
											<?php
											if (!empty($country)) {
												foreach ($country as $con) {
											?>
													<option value="<?= $con['CountryID'] ?>" <?php if (isset($address)) {
																									if ($con['CountryID'] == $address['Country']) {
																										echo 'selected';
																									}
																								} ?>><?= $con['CountryName'] ?></option>
											<?php }
											} ?>
										</select>
									</td>


									<td>
										<span class="show">
											<?php
											echo $address['addressType'];
											?>
										</span>


										<select class="form-control street_validate hide" id="addressType<?= $ref_count ?>" name="addressType[<?= $ref_count ?>]">
											<option value="">Select</option>
											<?php
											if (!empty($address_type)) {
												foreach ($address_type as $type) {
											?>
													<option value="<?= $type['name'] ?>" <?php if (isset($address)) {
																								if ($type['name'] == $address['addressType']) {
																									echo 'selected';
																								}
																							} ?>><?= $type['name'] ?></option>
											<?php }
											} ?>
										</select>

									</td>

									<td>
										<input class="address_active" value="1" id="addresscheckbox<?php echo $ref_count; ?>" type="checkbox" name="Active[<?= $ref_count; ?>]" <?php if (isset($address['Active'])) {
																																													if ($address['Active'] == 1) {
																																														echo "checked";
																																													}
																																												} ?> disabled>
									</td>


								</tr>

							<?php }
						} else { ?>
							<?php if ($access['add_access']) {
								echo '<input type= "hidden" id="addcount7" value="2" >';
							?>
								<tr>

									<td style="width:20%">
										<input type="hidden" name="Address_RowID[1]" value="">
										<input type="hidden" name="AddressID[1]" value="">
										<textarea rows='1' class="form-control street_validate hide" name="Street_Address[1]" id="Street_Address1" onChange="validateAddressXCheckbox(<?php echo $ref_count; ?>)"></textarea>
									</td>
									<td>
										<textarea rows='1' class="form-control hide" name="Address2[1]" id="" onChange="validateAddressXCheckbox(<?php echo $ref_count; ?>)"></textarea>
									</td>
									<td>
										<input class="form-control street_validate char hide" id="City1" name="City[1]" type="text">
									</td>
									<td>
										<select class="form-control hide" id="State1" name="State[1]">
											<option value="" selected="selected">Select</option>
											<?php
											if (!empty($states)) {
												foreach ($states as $row) {
											?>
													<option value="<?php echo $row['StateID'];  ?>"> <?php echo $row['StateID'] . " - ";
																										echo $row['StateName'];  ?></option>
											<?php }
											} ?>
										</select>
									</td>
									<td>
										<input class="form-control  hide" id="Postal_Code1" name="Postal_Code[1]" type="text" maxlength="7">
									</td>
									<td>
										<select class="form-control street_validate hide" id="Country1" name="Country[1]" onChange="getstatedetails(this.value)">
											<option value="">Select</option>
											<?php
											//echo"<'pre'>";print_r($country);die();
											if (!empty($country)) {
												foreach ($country as $con) {
											?>
													<option value="<?= $con['CountryID'] ?>"><?= $con['CountryName'] ?></option>
											<?php }
											} ?>
										</select>
									</td>

									<td>

										<select class="form-control street_validate hide" id="addressType1" name="addressType[1]">
											<option value="">Select</option>
											<?php
											if (!empty($address_type)) {
												foreach ($address_type as $type) {
											?>
													<option value="<?= $type['name'] ?>"><?= $type['name'] ?></option>
											<?php }
											} ?>
										</select>

									</td>

									<td>
										<input class="" value="1" id="addresscheckbox<?php echo $ref_count + 1; ?>" type="checkbox" name="Active[1]">
									</td>

								</tr>
						<?php }
						}
						$count7 = $ref_count == 0 ? 1 : $ref_count;
						?>

					</tbody>
				</table>
			</div>
			<?php if ($access['add_access']) { ?>
				<div class="clearfix" style="float:right">
					<div class="col-sm-12">
						<button type="submit" id="address_save" style="float: left;margin-left: 5px; display:none;" name="submit" value="address" class="btn btn-success waves-effect hide waves-light btn-xs m-b-5" <?php if (isset($form_id)) {
																																																							echo ($form_id != '' ? 'onclick="return validate_general()"' : '');
																																																						} ?>>Save</button>

						<a id="addButtonRD" style="float: left;margin-left: 5px;" class="btn btn-info waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							<span><strong>Add</strong></span>
						</a>

						<a id="removeButtonRD" style="float: left;margin-left: 5px;" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							<span edit_border><strong></strong></span>
						</a>

					</div>
				</div>
			<?php } ?>
		</div>

	</div>


	<!-- international address shipping -->
	<div class="col-sm-12">
		<h4>International Address</h4>
		<div class="form-group no_border">
			<div style="overflow-x:auto;">
				<table class="table table-striped table-bordered" id="inter_table_address">
					<tbody id="inter_TextBoxesGroupRD">
						<tr>
							<th style="width:20%">Address1</th>
							<th style="width:20%">Address2</th>
							<th style="width:20%">Address3</th>
							<th>Locale (without the town, etc)</th>
							<th>Country</th>
							<th>Type<span class="requires">*</span></th>
							<th>Active</th>
						</tr>

						<?php
						$inter_ref_count = 0;
						$ref = getInterAddress(isset($infos['ID']) ? $infos['ID'] : 0); //($address['application_code'], $address['infos_unique_id']);

						echo '<input type= "hidden" id="rem_count8" value="0" >';
						if (!empty($ref)) {
							$inter_ref_count = 0;
							echo '<input type= "hidden" id="count8" value="' . (count($ref) + 1) . '" >';
							foreach ($ref as $address) {
								$inter_ref_count++; ?>
								<tr id="TextBoxDivGEN<?php echo $inter_ref_count; ?>">
									<td>
										<span class="show"><?php if (isset($address['company_name'])) {
																echo $address['company_name'];
															} elseif (isset($post['company_name'][$inter_ref_count])) {
																echo $post['inter_Address2'][$inter_ref_count];
															} ?></span>
										<textarea rows='1' class="form-control hide"
											name="inter_Company_Name[<?= $inter_ref_count; ?>]" id="company_name<?= $inter_ref_count; ?>"
											onChange="validateAddressXCheckbox(<?php echo $inter_ref_count; ?>)"><?php if (isset($address['company_name'])) {
																														echo $address['company_name'];
																													} elseif (isset($post['company_name'][$inter_ref_count])) {
																														echo $post['company_name'][$inter_ref_count];
																													} ?></textarea>
									</td>
									<td style="width:20%">
										<input type="hidden" name="inter_Address_RowID[<?= $inter_ref_count; ?>]" value="<?php
																															if (isset($address['Address_RowID_int'])) {
																																echo $address['Address_RowID_int'];
																															} elseif (isset($post['inter_Address_RowID'][$inter_ref_count])) {
																																echo $post['inter_Address_RowID'][$inter_ref_count];
																															} else {
																																echo "0";
																															} ?>">
										<input type="hidden" name="inter_AddressID[<?= $inter_ref_count; ?>]" value="<?php if (isset($address['AddressID_int'])) {
																															echo $address['AddressID_int'];
																														} elseif (isset($post['inter_AddressID'][$inter_ref_count])) {
																															echo $post['inter_AddressID'][$inter_ref_count];
																														} else {
																															echo ($infos['ID']) ? $infos['ID'] : 0;
																														} ?>">
										<span class="show"><?php if (isset($address['Street_Address_int'])) {
																echo $address['Street_Address_int'];
															} elseif (isset($post['inter_Street_Address'][$inter_ref_count])) {
																echo $post['inter_Street_Address'][$inter_ref_count];
															} ?></span>
										<textarea rows='1' class="form-control hide" name="inter_Address1[<?= $inter_ref_count; ?>]" id="inter_Street_Address<?= $inter_ref_count; ?>" onChange="validateAddressXCheckbox(<?php echo $inter_ref_count; ?>)"><?php if (isset($address['Street_Address_int'])) {
																																																																echo $address['Street_Address_int'];
																																																															} elseif (isset($post['inter_Street_Address'][$inter_ref_count])) {
																																																																echo $post['inter_Street_Address'][$inter_ref_count];
																																																															} ?></textarea>
									</td>
									<td>
										<span class="show"><?php if (isset($address['Address2_int'])) {
																echo $address['Address2_int'];
															} elseif (isset($post['inter_Address2'][$inter_ref_count])) {
																echo $post['inter_Address2'][$inter_ref_count];
															} ?></span>
										<textarea rows='1' class="form-control hide" name="inter_Address2[<?= $inter_ref_count; ?>]" id="inter_Address2<?= $inter_ref_count; ?>" onChange="validateAddressXCheckbox(<?php echo $inter_ref_count; ?>)"><?php if (isset($address['Address2_int'])) {
																																																															echo $address['Address2_int'];
																																																														} elseif (isset($post['inter_Address2'][$inter_ref_count])) {
																																																															echo $post['inter_Address2'][$inter_ref_count];
																																																														} ?></textarea>
									</td>
									<td>
										<span class="show"><?php if (isset($address['City_int'])) {
																echo $address['City_int'];
															} ?></span>

										<textarea rows='1' class="form-control hide" name="inter_City[<?= $inter_ref_count ?>]"
											id="inter_City<?= $inter_ref_count; ?>"><?php if (isset($address['City_int'])) {
																						echo $address['City_int'];
																					} ?></textarea>

									</td>
									<td>
										<span class="show"><?php

															if (!empty($country)) {
																foreach ($country as $row) {
															?><?php echo $row['CountryID'] == $address['Country_int'] ? strtoupper($row['CountryName']) : ''; ?><?php }
																																						} ?>
										</span>

										<select class="form-control hide" name="inter_Country[<?= $inter_ref_count ?>]" onChange="getstatedetails(this.value)">
											<option value="">Select</option>
											<?php
											if (!empty($country)) {
												foreach ($country as $con) {
											?>
													<option value="<?= $con['CountryID'] ?>" <?php if (isset($address)) {
																									if ($con['CountryID'] == @$address['Country_int']) {
																										echo 'selected';
																									}
																								} ?>><?= strtoupper($con['CountryName']) ?></option>
											<?php }
											} ?>
										</select>
									</td>

									<td>
										<span class="show">
											<?php
											echo $address['AddressType'];
											?>
										</span>
										<select class="form-control interaddressType hide" id="interaddressType<?= $inter_ref_count ?>" name="interaddressType[<?= $inter_ref_count ?>]">
											<option value="">Select</option>
											<?php
											if (!empty($address_type)) {
												foreach ($address_type as $type) {
											?>
													<option value="<?= $type['name'] ?>" <?php if (isset($address)) {
																								if ($type['name'] == $address['AddressType']) {
																									echo 'selected';
																								}
																							} ?>><?= $type['name'] ?></option>
											<?php }
											} ?>
										</select>
									</td>
									<td>
										<input class="address_active" value="1" id="inter_addresscheckbox<?php echo $inter_ref_count; ?>" type="checkbox" name="inter_Active[<?= $inter_ref_count; ?>]" <?php if (isset($address['Active_int'])) {
																																																			if ($address['Active_int'] == 1) {
																																																				echo "checked";
																																																			}
																																																		} ?> disabled>
									</td>
								</tr>
							<?php }
						} else { ?>
							<?php if ($access['add_access']) {
								echo '<input type= "hidden" id="count8" value="2" >'; ?>
								<tr>

									<td style="width:20%">
										<input type="hidden" name="inter_Address_RowID[1]" value="0">
										<input type="hidden" name="inter_AddressID[1]" value="<?php echo (isset($infos['ID'])) ? $infos['ID'] : 0; ?>">
										<textarea rows='1' class="form-control hide" name="inter_Company_Name[1]" id="inter_Street_Address1" onChange="validateAddressXCheckbox(<?php echo $inter_ref_count; ?>)"></textarea>
									</td>
									<td>
										<textarea rows='1' class="form-control hide" name="inter_Address1[1]" id="" onChange="validateAddressXCheckbox(<?php echo $inter_ref_count; ?>)"></textarea>
									</td>
									<td>
										<input class="form-control hide" id="inter_City1" name="inter_Address2[1]" type="text">
									</td>
									<td>
										<div>
											<input type="text" class="form-control hide" id="inter_State1" name="inter_City[1]">
										</div>
									</td>
									<td>
										<select class="form-control hide" id="inter_Country1" name="inter_Country[1]" onChange="getstatedetails(this.value)">
											<option value="">Select</option>
											<?php
											if (!empty($country)) {
												foreach ($country as $con) {
											?>
													<option value="<?= $con['CountryID'] ?>"><?= strtoupper($con['CountryName']) ?></option>
											<?php }
											} ?>
										</select>
									</td>

									<td>
										<select class="form-control interaddressType hide" id="interaddressType1" name="interaddressType[1]">
											<option value="">Select</option>
											<?php
											if (!empty($address_type)) {
												foreach ($address_type as $type) {
											?>
													<option value="<?= $type['name'] ?>"><?= $type['name'] ?></option>
											<?php }
											} ?>
										</select>
									</td>
									<td>
										<input class="" value="1" id="addresscheckbox<?php echo $inter_ref_count + 1; ?>" type="checkbox" name="inter_Active[1]">
									</td>

								</tr>
						<?php }
						}
						$count8 = $inter_ref_count == 0 ? 1 : $inter_ref_count;
						?>

					</tbody>
				</table>
			</div>
			<?php if ($access['add_access']) { ?>
				<div class="clearfix" style="float:right">
					<div class="col-sm-12">
						<button type="submit" id="inter_address_save" style="float: left;margin-left: 5px; display:none;" name="submit" value="inter_address" class="btn btn-success hide waves-effect waves-light btn-xs m-b-5" <?php if (isset($form_id)) {
																																																										echo ($form_id != '' ? 'onclick="return inter_validate_general()"' : '');
																																																									} ?>>Save</button>
						<a id="inter_addButtonRD" style="float: left;margin-left: 5px;" class="btn btn-info waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							<span><strong>Add</strong></span>
						</a>
						<a id="inter_removeButtonRD" style="float: left;margin-left: 5px;" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							<span edit_border><strong></strong></span>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<!-- end international address shipping -->


	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-6">
				<div class="col-md-12">
					<div class="form-group no_border">
						<div class="col-sm-12">
							<div class="">
								<table class="table table-striped table-bordered" id="table_email">
									<tbody id="TextBoxesGroupFD">
										<tr>
											<th colspan="3" style="text-align:center;">Email History</th>
										</tr>
										<tr>
											<th>Email</th>
											<th>Unsubscribed</th>
											<th>Active</th>
										</tr>

										<?php
										$ref_count = 0;

										$ref = getEmail(isset($infos['ID']) ? $infos['ID'] : 'xx');

										echo '<input type="hidden" id="rem_count6" value="0">';
										if (!empty($ref)) {
											$ref_count = 0;
											echo '<input type="hidden" id="count6" value="' . (count($ref) + 1) . '" >';

											foreach ($ref as $email) {
												$ref_count++;
										?>
												<tr id="TextBoxDivGEN<?php echo $ref_count; ?>">

													<td>
														<input value="<?php if (isset($email['Email_RowID'])) {
																			echo $email['Email_RowID'];
																		} ?>" type="hidden" name="Email_RowID[<?= $ref_count; ?>]">
														<input value="<?php if (isset($email['EmailID'])) {
																			echo $email['EmailID'];
																		} ?>" type="hidden" name="EmailID[<?= $ref_count; ?>]" onchange="validateEmail(this.value)" placeholder="username@subdomain.domain">
														<span class="show"><?php if (isset($email['Email'])) {
																				echo $email['Email'];
																			} ?></span>


														<input class="form-control hide email_validateForm email" id="Email<?= $ref_count; ?>" name="Email[<?= $ref_count ?>]" type="email" value="<?php if (isset($email['Email'])) {
																																																		echo $email['Email'];
																																																	} ?>" onchange="validateCheckbox(<?php echo $ref_count; ?>)" placeholder="username@subdomain.domain">

													</td>


													<td>
														<input class="email_unsubscribed" value="1" type="checkbox" name="EmailUnsubscribed[<?= $ref_count; ?>]" <?php if (isset($email['Unsubscribed'])) if ($email['Unsubscribed'] == 1) {
																																										echo 'checked';
																																									} ?> disabled id="EmailUnsubscribed<?php echo $ref_count; ?>">
													</td>


													<td>
														<input class="email_active" value="1" type="checkbox" name="EmailActive[<?= $ref_count; ?>]" <?php if (isset($email['Active'])) if ($email['Active'] == 1) {
																																							echo 'checked';
																																						} ?> disabled id="emailstatus<?php echo $ref_count; ?>">
													</td>


												</tr>
											<?php }
											$count7 = $ref_count == 0 ? 1 : $ref_count;
										} else {
											if ($access['edit_access']) {
											?>
												<tr id="TextBoxDivGEN<?php echo $ref_count + 1; ?>">
													<td>
														<input value="" type="hidden" name="Email_RowID[1]">
														<!--<input type="hidden" id="count6" value="2" > -->
														<input value="" type="hidden" name="EmailID[1]" onchange="validateEmail(this.value)" placeholder="username@subdomain.domain">
														<input class="form-control hide email_validateForm" id="Email1" name="Email[1]" type="email" onchange="validateCheckbox(<?php echo $ref_count + 1; ?>" placeholder="username@subdomain.domain">
													</td>

													<td>
														<input class="email_unsubscribed" value="1" type="checkbox" name="EmailUnsubscribed[1]" id="EmailUnsubscribed<?php echo $ref_count + 1; ?>">
													</td>

													<td>
														<input value="1" type="checkbox" name="EmailActive[1]" id="emailstatus<?php echo $ref_count + 1; ?>" checked="true">
													</td>

												</tr>
												<input type="hidden" id="count6" value="2">
										<?php }
										} ?>
									</tbody>
								</table>
							</div>

							<div class="clearfix" style="float:right">
								<div class="col-sm-12">

									<button type="submit" id="email_save" style="float: left;margin-left: 5px;" name="submit" value="email" class="btn btn-success waves-effect hide waves-light btn-xs m-b-5">Save</button>

									<!-- <a id="saveButtonEM" style="float: left;margin-left: 5px;" class="btn btn-success waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									<span><strong>Save</strong></span>
							</a> -->
									<a id="addButtonEM" style="float: left;margin-left: 5px;" class="btn btn-info waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										<span><strong>Add</strong></span>
									</a>

									<a id="removeButtonEM" style="float: left;margin-left: 5px;" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										<span><strong></strong></span>
									</a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>



			<div class="col-md-6">
				<!-- By Prabhat 10-01-2021  -->
				<div class="col-md-12">
					<div class="form-group no_border">
						<div class="col-sm-12">
							<div class="">
								<table class="table table-striped table-bordered" id="us_email">
									<tbody id="TextBoxesGroupUSFD">
										<tr>
											<th colspan="4" style="text-align:center;">Phone History</th>
										</tr>
										<tr>
											<th>Type</th>
											<th>Number</th>
											<th>Extension </th>
											<th>Active</th>
										</tr>
										<?php
										$ref_count = 0;


										echo '<input type="hidden" id="rem_count11" value="0">';
										if (!empty($allnumbers)) {
											$ref_count = 0;
											echo '<input type="hidden" id="count11" value="' . (count($allnumbers) + 1) . '" >';

											foreach ($allnumbers as $num) {
												$ref_count++;
										?>
												<tr id="TextBoxDivUSPhone<?php echo $ref_count; ?>">

													<td>
														<input value="<?php if (isset($num['AutoId'])) {
																			echo $num['AutoId'];
																		} ?>" type="hidden" name="US_RowID[<?= $ref_count; ?>]">
														<span class="show"><?php if (isset($num['Type'])) {
																				echo $num['PhoneType'];
																			} ?></span>

														<select class="form-control phonevalidate hide" name="phonetype[<?= $ref_count ?>]" id="phonetype<?= $ref_count ?>" <?php if (isset($num['Number'])) {
																																												echo "required='required'";
																																											} ?>>
															<option value="">Select Phone</option>
															<?php
															foreach ($phonetypes as $pt) {
																$sec = '';
																if ($num['Type'] == $pt['Id']) {
																	$sec = 'selected';
																}
															?>
																<option <?= $sec ?> value="<?= $pt['Id'] ?>"><?= $pt['PhoneType'] ?></option>
															<?php
															}
															?>
														</select>
													</td>


													<td>
														<span class="show"><?php if (isset($num['Number'])) {
																				echo dateConverter($num['Number']);
																			} ?></span>
														<input class="USPhoneNumber phonevalidate phonetype form-control hide" type="text" name="USPhoneNumber[<?= $ref_count; ?>]" id="USPhoneNumber<?php echo $ref_count; ?>" rel_id="<?php echo $ref_count; ?>" value="<?php if (isset($num['Number'])) {
																																																																				echo $num['Number'];
																																																																			} ?>">
													</td>

													<td>
														<span class="show"><?php if (isset($num['Extension'])) {
																				echo $num['Extension'];
																			} ?></span>
														<input class="no_decimal form-control hide" type="text" name="Extension[<?= $ref_count; ?>]" id="Extension<?php echo $ref_count; ?>" value="<?php if (isset($num['Extension'])) {
																																																		echo $num['Extension'];
																																																	} ?>">
													</td>


													<td>
														<input value="1" class="USActive" type="checkbox" name="USActive[<?= $ref_count; ?>]" id="USstatus<?php echo $ref_count; ?>" <?php if (isset($num['Active'])) if ($num['Active'] == 1) {
																																															echo 'checked';
																																														} ?> disabled>
													</td>




												</tr>
											<?php }
											$count7 = $ref_count == 0 ? 1 : $ref_count;
										} else {
											if ($access['edit_access']) {
											?>
												<tr id="TextBoxDivUSPhone<?php echo $ref_count + 1; ?>">
													<td>
														<input value="" type="hidden" name="US_RowID[1]">
														<!--<input type="hidden" id="count6" value="2" > -->
														<select class="form-control phonevalidate hide" name="phonetype[1]" id="phonetype<?= $ref_count ?>">
															<option value="">Select Phone</option>
															<?php
															if (isset($phonetypes)) {

																foreach ($phonetypes as $pt) {
															?>
																	<option value="<?= $pt['Id'] ?>"><?= $pt['PhoneType'] ?></option>
															<?php
																}
															}

															?>
														</select>

													</td>

													<td>
														<input class="USPhoneNumber phonevalidate phonetype form-control hide" type="text" name="USPhoneNumber[1]" id="USPhoneNumber<?php echo $ref_count + 1; ?>" rel_id="<?php echo $ref_count; ?>">
													</td>

													<td>
														<input class="no_decimal form-control hide" type="text" name="Extension[1]" id="Extension<?php echo $ref_count + 1; ?>">
													</td>

													<td>
														<input value="1" class="USActive" type="checkbox" name="USActive[1]" id="USstatus<?php echo $ref_count + 1; ?>" checked="true" disabled>
													</td>


												</tr>
										<?php }
										} ?>
									</tbody>
								</table>
							</div>

							<div class="clearfix" style="float:right">
								<div class="col-sm-12">

									<button type="submit" id="usphone_save" style="float: left;margin-left: 5px;" name="submit" value="USPhone" class="btn btn-success hide waves-effect waves-light btn-xs m-b-5">Save</button>

									<!-- <a id="saveButtonEM" style="float: left;margin-left: 5px;" class="btn btn-success waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									<span><strong>Save</strong></span>
							</a> -->
									<a id="addButtonUS" style="float: left;margin-left: 5px;" class="btn btn-info waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										<span><strong>Add</strong></span>
									</a>

									<a id="removeButtonUS" style="float: left;margin-left: 5px;" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										<span><strong></strong></span>
									</a>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- End Prabhat 10-01-2021 -->

			</div>
		</div>






		<div class="clearfix"></div>





		<?php if ($access['edit_access'] || $access['add_access']) { ?>
			<button type="submit" name="submit" class="btn btn-success center-block hide add-general" value="name">Save</button>
		<?php } ?>


	</div>

	<?php echo form_close(); ?>
</div>
<style>
	.inline {

		display: inline-block !important;

	}
</style>
<script>
	$('#my-button').click(function() {
		$('#my-file').click();
	});
</script>