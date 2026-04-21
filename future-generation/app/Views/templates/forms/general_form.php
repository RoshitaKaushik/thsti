<!--<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>-->

<?php
$_SESSION['profiles']  = session()->get('profiles') ?? [];
?>

<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<style>
	.dropdown_link {
		display: none;
	}

	.select2 {
		width: 100% !Important;
	}

	#cke_Note {
		margin-top: -40px;
	}

	#cke_boardHistory {
		margin-top: -40px;
	}

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
</style>

<?php
$access = getAccess(1); //1 for general
$allContact_js = '';
if (!empty($allContact)) {
	$allContact_js = json_encode($allContact);
}

if (!empty($country)) {
	$country_js = json_encode($country);
}
if (!empty($country)) {
	$country_js = json_encode($country);
}
if (!empty($states)) {
	$state_js = json_encode($states);
}

if (!empty($address_type)) {
	$address_type_js = json_encode($address_type);
}

if (!empty($allOrganization)) {
	$allOrganization_js = json_encode($allOrganization);
}
if (!empty($allOrgRelationship)) {
	$allOrgRelationship_js = json_encode($allOrgRelationship);
}
if (session()->getFlashdata('post')) {
	$post = session()->getFlashdata('post');
} else {
	$post = array();
}
//echo"<pre>";print_r($post);die();
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

	/*.patner_org .checkbox input[type=checkbox] {
 margin-left: 0;
 border: none!important;
 width: 17px;
 height: 16px;
 margin-top: 1px;
}
.patner_org .checkbox label:before {
 margin-left: 0;
}
.patner_org .checkbox label {
 padding-left: 25px;
}*/

	.invalid {
		background-color: #ff9494 ! important;
	}
</style>
<div class="col-sm-12" style="display:<?php if (isset($form_id)) {
											echo ($form_id != '' ? 'block' : 'none');
										} ?>">
	<div class="panel-heading">
		<?php if ($access['edit_access']) { ?>
			<h3 class="panel-title"> <button id="general_edit" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					<span><strong>Edit</strong></span></button>
			</h3>
		<?php } ?>

		<h3 class="panel-title"> <button id="general_view" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right hide"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
				<span><strong>View</strong></span></button>
		</h3>

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
<div class="col-sm-4">
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
			<label for="Spouse" class="control-label col-sm-4">Spouse </label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show"><?php
									if (isset($post['Spouse'])) {
										echo $post['Spouse'];
									} else if (isset($infos['Spouse'])) {
										echo $infos['Spouse'];
									} ?></span>

				<input class=" form-control hide" id="Spouse" name="Spouse" type="text" value="<?php
																								if (isset($post['Spouse'])) {
																									echo $post['Spouse'];
																								} else if (isset($infos['Spouse'])) {
																									echo $infos['Spouse'];
																								} ?>" onkeypress="javascript:return ValidateAlpha(event)">
				<input type="hidden" class="form-control" id="admin_id" name="admin_id">
				<input type="hidden" name="save_status" value="<?php if (isset($infos['save_status'])) {
																	echo $infos['save_status'];
																} ?>" class="form-control">
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








</div>
<div class="col-sm-4">

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


	<!--div class="col-sm-12">									
		<div class="form-group">
			<label for="Main Phone" class="control-label col-sm-4">Main Phone </label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show"><?php //echo "<pre>";print_r($infos);
									if (isset($post['MainPhone'])) {
										echo $post['MainPhone'];
									} elseif (isset($infos['MainPhone'])) {
										echo dateConverter($infos['MainPhone']);
									} ?></span>
				<input class=" form-control hide phone_validation" id="MainPhone" name="MainPhone" placeholder=" " type="text" value="<?php
																																		if (isset($post['MainPhone'])) {
																																			echo $post['MainPhone'];
																																		} else if (isset($infos['MainPhone'])) {
																																			echo $infos['MainPhone'];
																																		} ?>"  maxlength="25">
				
			</div>
		</div>
	</div>
	<div class="col-sm-12">									
		<div class="form-group">
			<label for="Home phone" class="control-label col-sm-4">Home Phone  </label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show"><?php
									if (isset($post['HomePhone'])) {
										echo $post['HomePhone'];
									} else if (isset($infos['HomePhone'])) {
										echo dateConverter($infos['HomePhone']);
									} ?></span>
				
				<input class=" form-control hide phone_validation" id="HomePhone" name="HomePhone" placeholder=" " type="text" value="<?php
																																		if (isset($post['HomePhone'])) {
																																			echo $post['HomePhone'];
																																		} else if (isset($infos['HomePhone'])) {
																																			echo $infos['HomePhone'];
																																		} ?>"  maxlength="25" >
				
			</div>
		</div>
	</div>
	<div class="col-sm-12">									
		<div class="form-group">
			<label for="Mobile phone" class="control-label col-sm-4">Mobile Phone  </label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show">
				<?php
				if (isset($post['MobilePhone'])) {
					echo $post['MobilePhone'];
				} else if (isset($infos['MobilePhone'])) {
					echo dateConverter($infos['MobilePhone']);
				} ?>
				</span>
				<input class=" form-control hide phone_validation" id="phone" name="MobilePhone" placeholder=" " type="text" value="<?php
																																	if (isset($post['MobilePhone'])) {
																																		echo $post['MobilePhone'];
																																	} else if (isset($infos['MobilePhone'])) {
																																		echo $infos['MobilePhone'];
																																	} ?>" onkeypress="javascript:return  " maxlength="25" >
				<input type="hidden" class="form-control" id="admin_id" name="admin_id">
				<input type="hidden" name="save_status" value="<?php if (isset($infos['save_status'])) {
																	echo $infos['save_status'];
																} ?>" class="form-control">
			</div>
		</div>
	</div-->
	<!--<div class="col-sm-12">									
		<div class="form-group">
			<label for="Other Phone" class="control-label col-sm-4">Other Phone  </label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show"><?php /* 
				if(isset($post['OtherPhone'])){ echo $post['OtherPhone'];}	
				else if(isset($infos['OtherPhone'])){echo dateConverter($infos['OtherPhone']);} */ ?></span>
				
				
				<input class=" form-control hide num" id="OtherPhone" name="OtherPhone" placeholder="" type="text" value="<?php /* 
				if(isset($post['OtherPhone'])){ echo $post['OtherPhone'];}	
				else if(isset($infos['OtherPhone'])){echo dateConverter($infos['OtherPhone']);}?>" onkeypress="javascript:return " maxlength="12" >
				<input type="hidden" class="form-control" id="admin_id" name="admin_id">
				<input type="hidden" name="save_status" value="<?php if(isset($infos['save_status'])){echo $infos['save_status'];} */ ?>" class="form-control">
			</div>
		</div>
	</div> -->
	<!--div class="col-sm-12">									
		<div class="form-group">
			<label for="Work Phone " class="control-label col-sm-4">Work Phone  </label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show"><?php
									if (isset($post['WorkPhone'])) {
										echo $post['WorkPhone'];
									} else if (isset($infos['WorkPhone'])) {
										echo dateConverter($infos['WorkPhone']);
									} ?></span>
				
				<input class=" form-control hide phone_validation" id="WorkPhone" name="WorkPhone" placeholder=" " type="text" value="<?php
																																		if (isset($post['WorkPhone'])) {
																																			echo $post['WorkPhone'];
																																		} else if (isset($infos['WorkPhone'])) {
																																			echo $infos['WorkPhone'];
																																		} ?>" onkeypress="javascript:return  " maxlength="25" >
				<input type="hidden" class="form-control" id="admin_id" name="admin_id">
				<input type="hidden" name="save_status" value="<?php if (isset($infos['save_status'])) {
																	echo $infos['save_status'];
																} ?>" class="form-control">
			</div>
		</div>
	</div-->
	<div class="col-sm-12">
		<div class="form-group">
			<label for="Work Phone " class="control-label col-sm-4">Position </label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show"><?php
									if (isset($post['Position'])) {
										echo $post['Position'];
									} else if (isset($infos['Position'])) {
										echo ($infos['Position']);
									} ?></span>

				<input class=" form-control hide" id="Position" name="Position" placeholder=" " type="text" value="<?php
																													if (isset($post['Position'])) {
																														echo $post['Position'];
																													} else if (isset($infos['Position'])) {
																														echo $infos['Position'];
																													} ?>" onkeypress="javascript:return  " maxlength="100">
				<input type="hidden" class="form-control" id="admin_id" name="admin_id">
				<input type="hidden" name="save_status" value="<?php if (isset($infos['save_status'])) {
																	echo $infos['save_status'];
																} ?>" class="form-control">
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<label for="Comapny" class="control-label col-sm-4">Company </label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show"><?php
									if (isset($post['Company'])) {
										echo $post['Company'];
									} else if (isset($infos['Company'])) {
										echo $infos['Company'];
									} ?></span>

				<input class=" form-control hide" id="Company" name="Company" type="text" value="<?php
																									if (isset($post['Company'])) {
																										echo $post['Company'];
																									} else if (isset($infos['Company'])) {
																										echo $infos['Company'];
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


	<!-- By Prabhat for website link 11-07-2022 -->
	<div class="col-sm-12">
		<div class="form-group">
			<label for="Comapny" class="control-label col-sm-4">Website</label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">
				<span class="show"><?php
									if (isset($post['web_link'])) {
										echo $post['web_link'];
									} else if (isset($infos['web_link'])) {
										echo $infos['web_link'];
									} ?></span>

				<input class=" form-control hide" id="web_link" name="web_link" type="text" value="<?php
																									if (isset($post['web_link'])) {
																										echo $post['web_link'];
																									} else if (isset($infos['web_link'])) {
																										echo $infos['web_link'];
																									} ?>">
			</div>
		</div>
	</div>
	<!-- End Website link 11-07-2022 -->




</div>

<div class="col-sm-4">

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
					} else {
						echo (isset($infos['Sex']));
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
					<option value="Prefer Not to Say" <?php if (isset($infos['Sex'])) {
															if ($infos['Sex'] == '3' || $infos['Sex'] == 'Prefer Not to Say') {
																echo "selected='selected'";
															}
														} ?>>Prefer Not to Say</option>
					<option value="O" <?php if (isset($infos['Sex'])) {
											if ($infos['Sex'] == 'O') {
												echo "selected='selected'";
											} else if ($infos['Sex'] == '4') {
												echo "selected='selected'";
											}
										} ?>>Other</option>
				</select>
				<input type="hidden" class="form-control" id="admin_id" name="admin_id">
				<input type="hidden" name="save_status" value="<?php if (isset($infos['save_status'])) {
																	echo $infos['save_status'];
																} ?>" class="form-control">
			</div>
		</div>
	</div>



	<!-- By Prabhat  4-09-2021 -->

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

	<!-- End Prabhat 4-09-2021 -->

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
										echo ($infos['Ethnicity']);
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
					<option value="Other" <?php if (isset($infos['Ethnicity']) == 'Other') {
												echo 'selected';
											} ?>>Other</option>
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


	<!-- By Prabhat 13-10-2020-->
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
					foreach ($country as $con) {
					?>
						<option <?php if (isset($infos['citizenship_country']) == $con['CountryID']) {
									echo "selected";
								} ?> value="<?= $con['CountryID'] ?>"><?= $con['CountryName'] ?></option>
					<?php
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<!-- End prabhat 13-10-2020-->




	<!--Start Fwd: New Field Database 15-Nov-2023-->
	<div class="col-sm-12 ssnClass" <?php if (isset($infos['citizenship_country']) != 'USA') { ?> style="display:none" ; <?php } ?>>
		<div class="form-group">
			<label for="SSN" class="control-label col-sm-4">SSN</label>
			<div class="col-sm-1"> :
			</div>
			<div class="col-sm-7">

				<?php if (
					in_array(1, session()->get('profiles')) ||
					in_array(5, session()->get('profiles')) ||
					in_array(2, session()->get('profiles')) ||
					in_array(6, session()->get('profiles')) ||
					session()->get('role') == '1'
				) { ?>
					<span class="show"><?php if (isset($post['ssn'])) {
											echo $post['ssn'];
										} else if (isset($infos['ssn'])) {
											echo $infos['ssn'];
										}	?></span>
				<?php } else {
				?>
					<span><?php if (isset($post['ssn'])) {
								echo $post['ssn'];
							} else if (isset($infos['ssn']) && isset($infos['ssn']) != '') {
								echo 'XXX-XX-XXXX';
							} else {
								echo "-";
							}	?></span>
				<?php
				} ?>

				<?php if (
					in_array(1, session()->get('profiles')) ||
					in_array(5, session()->get('profiles')) ||
					session()->get('role') == '1'
				) { ?>
					<input class=" form-control hide" name="ssn" type="text" id="ssn" pattern="\d{3}-\d{2}-\d{4}" maxlength="11" value="<?php
																																		if (isset($post['ssn'])) {
																																			echo $post['ssn'];
																																		} else if (isset($infos['ssn'])) {
																																			echo ($infos['ssn']);
																																		} ?>">
				<?php } ?>
			</div>
		</div>
	</div>


	<!--End Fwd: New Field Database 15-Nov-2023-->




</div>

<div class="col-sm-12">
	<div class="form-group no_border">
		<!--<label for="firstname" class="control-label col-sm-4">Address Details </label>
	</div> -->
		<div class="table-responsive">
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
					<button type="submit" id="address_save" style="float: left;margin-left: 5px; display:none;" name="submit" value="address" class="btn btn-success waves-effect waves-light btn-xs m-b-5" <?php if (isset($form_id)) {
																																																				echo ($form_id != '' ? 'onclick="return validate_general()"' : '');
																																																			} ?>>Save</button>

					<a id="addButtonRD" style="float: left;margin-left: 5px;" class="btn btn-info waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						<span><strong>Add</strong></span>
					</a>

					<a id="removeButtonRD" style="float: left;margin-left: 5px;" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						<spanedit_border><strong></strong></span>
					</a>

				</div>
			</div>
		<?php } ?>
	</div>

</div>


<!-- international address shipping -->
<div class="col-sm-12">
	<h4 class="form-group">International Address</h4>
	<div class="form-group no_border">
		<div class="table-responsive">
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
					<button type="submit" id="inter_address_save" style="float: left;margin-left: 5px; display:none;" name="submit" value="inter_address" class="btn btn-success waves-effect waves-light btn-xs m-b-5" <?php if (isset($form_id)) {
																																																							echo ($form_id != '' ? 'onclick="return inter_validate_general()"' : '');
																																																						} ?>>Save</button>
					<a id="inter_addButtonRD" style="float: left;margin-left: 5px;" class="btn btn-info waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						<span><strong>Add</strong></span>
					</a>
					<a id="inter_removeButtonRD" style="float: left;margin-left: 5px;" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						<spanedit_border><strong></strong></span>
					</a>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<!-- end international address shipping -->










<!--div class="col-sm-12"-->
<div class="col-sm-12" style="margin-bottom:10px;">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="firstname" class="control-label col-lg-5">
					<h4 style="display:inline;">Notes :</h4>
				</label>
				<!--div class="col-lg-10"-->

				<!--<span class="show"><?php if (isset($post['Note'])) {
											echo $post['Note'];
										} else if (isset($infos['Note'])) {
											echo $infos['Note'];
										} ?></span>-->


				<span class="show">
					<span class="fa fa-eye view_note_detail text-primary" rel-title="Notes" style="padding: 5px;margin-left: -70px;margin-top: -10px;cursor:pointer" rel-data='<?php if (isset($post['Note'])) {
																																													echo $post['Note'];
																																												} else if (isset($infos['Note'])) {
																																													echo $infos['Note'];
																																												} ?>'>
					</span>
				</span>


				<div class="hide">
					<textarea class=" form-control hide" name="Note" id="Note"><?php if (isset($post['Note'])) {
																					echo $post['Note'];
																				} else if (isset($infos['Note'])) {
																					echo $infos['Note'];
																				} ?></textarea>
				</div>
				<!--/div-->
			</div>
		</div>

		<!-- By PRabhat 07-01-2021 -->
		<div class="col-sm-6">
			<div class="form-group" style="margin-left: 0px;">
				<label for="Board History Notes" class="control-label col-lg-6">
					<h4 style="display:inline;">Board History Notes :</h4>
					<!--div class="col-lg-10"-->

				</label>
				<span class="show"><span rel-title="Board History Notes" class="fa fa-eye view_note_detail text-primary" style="padding: 5px;margin-left: -70px;margin-top: -10px;cursor:pointer" rel-data='<?php if (isset($post['boardHistory'])) {
																																																				echo $post['boardHistory'];
																																																			} else if (isset($infos['boardHistory'])) {
																																																				echo $infos['boardHistory'];
																																																			} ?>'>

					</span></span>
				<div class="hide">
					<textarea class=" form-control hide" name="boardHistory" id="boardHistory"><?php if (isset($post['boardHistory'])) {
																									echo $post['boardHistory'];
																								} else if (isset($infos['boardHistory'])) {
																									echo $infos['boardHistory'];
																								} ?></textarea>
				</div>
				<!--/div-->
			</div>
		</div>
		<!-- End PRabhat 07-01-2021 -->

	</div>

</div>




<!--/div-->






<div class="col-sm-12">
	<div class="row">
		<div class="form-group" style="margin-left: -10px;">
			<div class="col-sm-4">
				<div class="col-md-12">
					<div class="form-group no_border">
						<div class="col-sm-12">
							<div class="table-responsive">
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

									<button type="submit" id="email_save" style="float: left;margin-left: 5px; display:none;" name="submit" value="email" class="btn btn-success waves-effect waves-light btn-xs m-b-5">Save</button>

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

			<div class="col-md-4">
				<div class="col-md-12">

					<div class="form-group no_border">
						<div class="col-sm-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered" id="table_board_info">
									<tbody id="add_more_board">
										<tr>
											<th colspan="3" style="text-align:center;">Board History</th>
										</tr>
										<tr>
											<th>Organization</th>
											<th>StartDate</th>
											<th>EndDate</th>
										</tr>
										<?php $ref_count = 0;

										if (!empty($assign_organization)) {
											foreach ($assign_organization as $ass_org) {
												$ref_count++;
										?>
												<tr id="Textboardmemeber<?php echo $ref_count; ?>">
													<td>
														<input value="<?= $ass_org['assign_id'] ?>" type="hidden" name="Board_RowID[<?= $ref_count ?>]">
														<span class="show"><?php if (isset($ass_org['name'])) {
																				echo $ass_org['name'];
																			} ?></span>
														<select class="form-control hide" name="boardtype[<?= $ref_count ?>]">
															<option value="<?= $ass_org['org_id'] ?>"><?= $ass_org['name'] ?></option>
															<?php
															foreach ($all_organization as $org) {
																echo '<option value="' . $org['id'] . '">' . $org['name'] . '</option>';
															}
															?>
														</select>
													</td>
													<td>
														<span class="show"><?php if (isset($ass_org['start_date']) && $ass_org['start_date'] != '0000-00-00') {
																				echo date('m/d/Y', strtotime($ass_org['start_date']));
																			} ?></span>
														<div class="input-group date hide" data-provide="datepicker">
															<input class="form-control datepickerbackward board_start_date" id="start_date_board<?= $ref_count ?>" value="<?php if ($ass_org['start_date'] != '0000-00-00') {
																																												echo date('m/d/Y', strtotime($ass_org['start_date']));
																																											} ?>" name="start_date[<?= $ref_count ?>]" type="text">
															<div class="input-group-addon" style="display:none;">
																<span class="glyphicon glyphicon-th"></span>
															</div>
														</div>
													</td>
													<td>
														<span class="show"><?php if (isset($ass_org['end_date']) && $ass_org['end_date'] != '0000-00-00') {
																				echo date('m/d/Y', strtotime($ass_org['end_date']));
																			} ?></span>
														<div class="input-group date hide" data-provide="datepicker">
															<input class="form-control datepickerbackward board_end_date" rel_id="<?= $ref_count ?>" id="end_date_board<?= $ref_count ?>" value="<?php if ($ass_org['end_date'] != '0000-00-00') {
																																																		echo date('m/d/Y', strtotime($ass_org['end_date']));
																																																	} ?>" name="end_date[<?= $ref_count ?>]" type="text">
															<div class="input-group-addon" style="display:none;">
																<span class="glyphicon glyphicon-th"></span>
															</div>
														</div>
													</td>
												</tr>
											<?php
											}
										} else {
											// get All inserted board member data
											?>
											<tr id="Textboardmemeber<?php echo $ref_count + 1; ?>">
												<td>
													<input value="" type="hidden" name="Board_RowID[<?= $ref_count ?>]">
													<select class="form-control hide" name="boardtype[<?= $ref_count   ?>]">
														<option value="">Select Organization</option>
														<?php
														foreach ($all_organization as $org) {
															echo '<option value="' . $org['id'] . '">' . $org['name'] . '</option>';
														}
														?>
													</select>
												</td>
												<td>
													<div class="input-group date hide" data-provide="datepicker">
														<input class="form-control datepickerbackward board_start_date" rel_id="<?= $ref_count ?>" id="start_date_board<?= $ref_count ?>" name="start_date[<?= $ref_count ?>]" type="text">
														<div class="input-group-addon" style="display:none;">
															<span class="glyphicon glyphicon-th"></span>
														</div>
													</div>
												</td>
												<td>

													<div class="input-group date hide" data-provide="datepicker">
														<input class="form-control datepickerbackward board_end_date" rel_id="<?= $ref_count ?>" id="end_date_board<?= $ref_count ?>" name="end_date[<?= $ref_count ?>]" type="text">
														<div class="input-group-addon" style="display:none;">
															<span class="glyphicon glyphicon-th"></span>
														</div>
													</div>

												</td>

											</tr>
										<?php
										}
										?>
										<input type="hidden" id="count_board" value="<?= sizeof($assign_organization) + 1 ?>">
										<input type="hidden" id="fixed_count_board" value="<?= sizeof($assign_organization) + 1 ?>">

									</tbody>
								</table>
							</div>


							<div class="clearfix" style="float:right">
								<div class="col-sm-12">

									<button type="submit" id="board_info_save" style="float: left;margin-left: 5px;" name="submit" value="board_info" class="btn btn-success waves-effect waves-light btn-xs m-b-5 hide">Save</button>

									<a id="addBoardInfo" style="float: left;margin-left: 5px;" class="btn btn-info waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										<span><strong>Add</strong></span>
									</a>

									<a id="removeBoardInfo" style="float: left;margin-left: 5px;" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 hide"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										<span><strong></strong></span>
									</a>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="col-md-4">
				<!-- By Prabhat 10-01-2021  -->
				<div class="col-md-12">
					<div class="form-group no_border">
						<div class="col-sm-12">
							<div class="table-responsive">
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
															foreach ($phonetypes as $pt) {
															?>
																<option value="<?= $pt['Id'] ?>"><?= $pt['PhoneType'] ?></option>
															<?php
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
	</div>
</div>

<div class="col-md-12">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-6 patner_org">
				<!--form-group-->
				<div class="no_border" id="checkbox">
					<div class="partner_organization_inner" style="background: #fff;border: 1px solid #ccc;padding: 11px;">
						<!--Change Start by Prabhat 28-09-2023 Fwd: Database - New Check box-->
						<div class="checkbox checkbox-success checknox-list">
							<input class="" value="1" type="checkbox" name="doNotContact" <?php if (isset($getContactTag[0]['do_not_contact']) && $getContactTag[0]['do_not_contact'] == 1) echo 'checked' ?> disabled>
							<label> Do Not Contact</label>
						</div> <br>

						<div class="form-group">
							<div class="col-sm-12">
								<span class="show"><?php if (isset($getContactTag[0]['do_not_contact_note'])) {
														echo $getContactTag[0]['do_not_contact_note'];
													} ?></span>
								<textarea class="form-control hide" maxlength="100" name="doNotContactNote" placeholder="Do Not Contact Note"><?php if (isset($getContactTag[0]['do_not_contact_note'])) {
																																					echo $getContactTag[0]['do_not_contact_note'];
																																				} ?></textarea>
							</div>
						</div>

						<!--Change End by Prabhat 28-09-2023 Fwd: Database - New Check box-->
						<div class="checkbox checkbox-success checknox-list">
							<input class="" onclick="PartnerOrganizationc(this)" value="1" type="checkbox" id="PartnerOrganization " name="PartnerOrganization" <?php if (isset($group[0]['PartnerOrganization']) && $group[0]['PartnerOrganization'] == 1) echo 'checked' ?> disabled>
							<label> Partner Organization </label>
						</div>
						<br>
						<div class="form-group">
							<div class="col-sm-12">
								<span class="show"><?php if (isset($group[0]['PartnerOrgName'])) {
														if ($group[0]['PartnerOrganization'] != 0) {
															echo $group[0]['PartnerOrgName'];
														}
													} ?></span>
								<select class="form-control hide" name="PartnerOrgName" id="PartnerOrgName" <?php if (!isset($group[0]['PartnerOrganization']) || $group[0]['PartnerOrganization'] != 1) echo 'disabled' ?>>
									<option value="">Select</option>

									<?php
									foreach ($patner_organizations as $org) {
										$sec = '';
										$partnerName = $group[0]['PartnerOrgName'] ?? '';
										if ($partnerName == $org['name']) {
											$sec = 'selected';
										} else if ($org['name'] == 'Future Generations Haiti' && $partnerName == 'Haiti') {
											$sec = 'selected';
										} else if ($org['name'] == 'Future Generations Afghanistan' && $partnerName == 'Afghanistan') {
											$sec = 'selected';
										} else if ($org['name'] == 'Future Generations Peru' && $partnerName == 'Peru') {
											$sec = 'selected';
										} else if ($org['name'] == 'Future Generations China/Fuqun' && $partnerName == 'China') {
											$sec = 'selected';
										} else if ($org['name'] == 'International Institute of Rural Reconstruction (IIRR)' && $partnerName == 'IIRR') {
											$sec = 'selected';
										}
									?>
										<option <?= $sec ?> value="<?= esc($org['name']) ?>"><?= esc($org['name']) ?></option>
									<?php
									}
									?>

								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group no_border" style="margin-right:-6px;">
					<table class="table table-striped table-bordered" id="organization_crm">
						<tbody id="organization_crm_more">
							<tr>
								<th colspan="4" style="text-align:center;">Relationship</th>
							</tr>
							<tr>
								<th>Type</th>
								<th>Organization</th>
								<th>Relationship Type / labeled</th>
								<th>Active</th>
								<th>Primary</th>
							</tr>
							<?php
							echo '<input type="hidden" id="rem_org_rel_count" value="' . count($assign_crm_list) . '">';
							$ref_org_count = 1;

							foreach ($assign_crm_list as $list) {
							?>
								<tr>
									<td>
										<span class="show"><?= $list['master_type'] ?></span>
										<select class="form-control relationship_type hide" name="master_relationship_type[<?= $ref_org_count ?>]" rel_id="<?= $ref_org_count ?>">
											<option value="Organization" <?php if ($list['master_type'] == 'Organization') {
																				echo 'selected';
																			} ?>>Organization</option>
											<option value="Individual" <?php if ($list['master_type'] == 'Individual') {
																			echo 'selected';
																		} ?>>Individual</option>
										</select>
									</td>
									<td>
										<input type="hidden" name="org_row_id[<?= $ref_org_count ?>]" value="<?= $list['id'] ?>">
										<span class="show"><?php if ($list['master_type'] == 'Organization') {
																echo $list['org_name'];
															} else {
																echo $list['FirstName'] . " " . $list['LastName'];
															} ?></span>
										<span id="org_name<?= $ref_org_count ?>">
											<?php if ($list['master_type'] == 'Organization') { ?>

												<select class="form-control hide" name="organization[<?= $ref_org_count ?>]">
													<option value="">Please Select Organization</option>
													<?php
													foreach ($allOrganization as $orgg) {
													?>
														<option <?php if ($list['org_id'] == $orgg['id']) {
																	echo 'selected';
																} ?> value="<?= $orgg['id'] ?>"><?= $orgg['name'] ?></option>
													<?php
													}
													?>
												</select>

											<?php } ?>
											<?php if ($list['master_type'] == 'Individual') { ?>

												<div class="center dropdown_link"><select class=" form-control select2" name="linkerId[<?= $ref_org_count ?>]">
														<?php foreach ($allContact as $con) { ?>
															<option value="<?= $con['ID'] ?>" <?php if ($con['ID'] == $list['linked_contact_id']) {
																									echo 'selected';
																								} ?>><?= $con['FirstName'] . " " . $con['LastName'] ?></option>
														<?php } ?>
													</select>
												</div>


											<?php } ?>
										</span>
									</td>
									<td>
										<?php if ($list['master_type'] == 'Organization') { ?>
											<span class="show"><?= $list['rel_name'] ?></span>
											<span id="relationship<?= $ref_org_count ?>">
												<select class="form-control hide" name="relationship[<?= $ref_org_count ?>]">
													<option value="">Please Select Relationship Type</option>
													<?php foreach ($allOrgRelationship as $orgRel) { ?>
														<option <?php if ($list['rel_id'] == $orgRel['id']) {
																	echo 'selected';
																} ?> value="<?= $orgRel['id'] ?>"><?= $orgRel['name'] ?></option>
													<?php } ?>
												</select>
											</span>
										<?php } ?>
										<?php if ($list['master_type'] == 'Individual') { ?>
											<span class="show"><?= $list['labeled_identify'] ?></span>
											<span id="relationship<?= $ref_org_count ?>">
												<input type="text" class="form-control hide" name="labled_indetifier[<?= $ref_org_count ?>]" maxlength="30" value="<?= $list['labeled_identify'] ?>">
											</span>
										<?php } ?>
									</td>
									<td>
										<input class="org_valid" type="checkbox" <?php if ($list['valid'] == '1') {
																						echo 'checked';
																					} ?> value="1" disabled name="org_valid[<?= $ref_org_count ?>]">
									</td>

									<td>
										<span id="primary_<?= $ref_org_count ?>" style="<?php if ($list['master_type'] == 'Individual') {
																							echo 'display:none;';
																						} ?>">
											<input class="org_valid" type="checkbox" <?php if ($list['primary_status'] == '1') {
																							echo 'checked';
																						} ?> value="1" disabled name="org_primary[<?= $ref_org_count ?>]">
										</span>
									</td>
								</tr>
							<?php
								$ref_org_count++;
							}

							if ($access['edit_access'] && sizeof($assign_crm_list)  < 1) {
							?>
								<tr>
									<td>
										<select class="form-control relationship_type hide" name="master_relationship_type[<?= $ref_org_count ?>]" rel_id="<?= $ref_org_count ?>">
											<option value="Organization" selected>Organization</option>
											<option value="Individual">Individual</option>
										</select>
									</td>
									<td>
										<input type="hidden" name="org_row_id[<?= $ref_org_count ?>]" value="0">
										<span id="org_name<?= $ref_org_count ?>">
											<select class="form-control hide" name="organization[<?= $ref_org_count ?>]">
												<option value="">Please Select Organization</option>
												<?php
												foreach ($allOrganization as $orgg) {
												?>
													<option value="<?= $orgg['id'] ?>"><?= $orgg['name'] ?></option>
												<?php
												}
												?>
											</select>
										</span>
									</td>
									<td>
										<span id="relationship<?= $ref_org_count ?>">
											<select class="form-control hide" name="relationship[<?= $ref_org_count ?>]">
												<option value="">Please Select Relationship Type</option>
												<?php
												foreach ($allOrgRelationship as $orgRel) {
												?>
													<option value="<?= $orgRel['id'] ?>"><?= $orgRel['name'] ?></option>
												<?php
												}
												?>
											</select>
										</span>
									</td>
									<td>
										<input class="org_valid" type="checkbox" value="1" checked name="org_valid[<?= $ref_org_count ?>]">
									</td>

									<td>
										<span id="primary_<?= $ref_org_count ?>">
											<input class="org_valid" type="checkbox" value="1" name="org_primary[<?= $ref_org_count ?>]">
										</span>
									</td>

								</tr>

							<?php
								$ref_org_count++;
							}
							echo '<input type="hidden" id="org_rel_count" value="' . $ref_org_count . '" >';
							?>
						</tbody>

					</table>
					<div class="col-md-12">
						<span class="organization_footer hide" style="text-align:right;">
							<button type="submit" class="btn btn-success btn-xs" name="submitOrg" value="submitOrg">Save</button>
							<span class="btn btn-info btn-xs  add_more_org_rel"><i class="glyphicon glyphicon-plus" style='font-weight:bold;'></i> Add</span>
							<span class="btn btn-danger btn-xs  remove_more_org_rel"><i class="glyphicon glyphicon-remove" style='font-weight:bold;'></i></span>
						</span>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>







<div class="clearfix"></div>





<?php if ($access['edit_access'] || $access['add_access']) { ?>
	<button type="submit" name="submit" class="btn btn-success center-block hide Addresval" value="name">Save</button>
<?php } ?>




<?php echo form_close(); ?>
<style>
	.inline {

		display: inline-block !important;

	}
</style>

<script>
	$(document).on('change', '#Sex', function() {
		var sex = $(this).val();

		if (sex == '4') {
			$('.gender_another').show();
		} else {
			$('.gender_another').hide();
		}
	})


	/*  $("#PartnerOrganization").on('click',function(){
		alert(this.value); 
	 });//change="PartnerOrganization(this.value)" required */
	function PartnerOrganizationc(ev) {
		//if($('#PartnerOrganization').is(':checked')){
		if ($('input[name=PartnerOrganization]').prop('checked')) {
			$('#PartnerOrgName').removeAttr('disabled');
		} else {
			$('#PartnerOrgName').attr('disabled', 'disabled');
		}
	}

	function vendor(ev) {
		//if($('#Vendor').is(':checked')){
		if ($('input[name=Vendor]').prop('checked')) {
			$('#Vendordetail').removeAttr('disabled');
		} else {
			$('#Vendordetail').attr('disabled', 'disabled');
		}
	}


	/*function validate_general(){
		
		var Street_Address1 = $('#Street_Address1').val();
		var City1 = $('#City1').val();		
		var Country1 = $('#Country1').val();

		if(Street_Address1 == '' || City1 == '' || Country1 == ''){
			
			if(Street_Address1 == ''){
				alert('Street Address is required');
				$('#Street_Address1').focus();
				return false;
			}
			if(City1 == ''){
				alert('City is required');
				$('#City1').focus();
				return false;
			}
			if(Country1 == ''){
				alert('Country is required');
				var Country1 = $('#Country1').focus();
				return false;
			}


		}
		return true;
	}*/
</script>

<script>
	$("#addButtonRD").click(function() {
		var country_list = JSON.parse('<?= $country_js ?>');
		var state_list = JSON.parse('<?= $state_js ?>');
		var add_type_list = JSON.parse('<?= $address_type_js ?>');

		var counter = $("#addcount7").val();
		var rem_count7 = parseInt($("#rem_addcount7").val());

		//country_select
		country_html = '<select class="form-control street_validate" name="Country[' + counter + ']" onchange="getstatedetails(this.value)"><option value="">Select</option>';
		$.each(country_list, function(key, val) {
			country_html += '<option value="' + val.CountryID + '">' + val.CountryName + '</option>';
		});

		//state_select
		state_html = '<select class="form-control" id="state" name="State[' + counter + ']"><option value="">Select</option>';
		$.each(state_list, function(key, val) {
			state_html += '<option value="' + val.StateID + '">' + val.StateID + ' - ' + val.StateName + '</option>';
		});

		type_html = '<select class="form-control street_validate" id="addressType' + counter + '" name="addressType[' + counter + ']"><option value="">Select</option>';
		$.each(add_type_list, function(key, val) {
			type_html += '<option value="' + val.name + '">' + val.name + '</option>';
		});

		if (counter > 10) {
			alert("Only 10 Reference allow");
			return false;
		}
		var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'TextBoxDivGEN' + counter);
		newTextBoxDiv.after().html('<td><input type="hidden" name="Address_RowID[' + counter + ']" value=""><input type="hidden" name="AddressID[' + counter + ']" value=""><textarea rows = "1" class="form-control street_validate" name="Street_Address[' + counter + ']" id="Street_Address' + counter + '" onChange="validateAddressXCheckbox(' + counter + ')"></textarea></td><td><textarea rows = "1"  class="form-control" name="Address2[' + counter + ']" id="Address2' + counter + '"  onChange="validateAddressXCheckbox(' + counter + ')"></textarea></td><td><input class=" form-control street_validate char" id="City' + counter + '" name="City[' + counter + ']" type="text"></td><td>' + state_html + '</td><td><input class="form-control " id="Postal_Code' + counter + '" name="Postal_Code[' + counter + ']" type="text" maxlength="7"></td><td>' + country_html + '  </td><td>' + type_html + '</td><td><input class="" value="1" type="checkbox" name="Active[' + counter + ']" id="addresscheckbox' + counter + '"></td>');

		newTextBoxDiv.appendTo("#TextBoxesGroupRD");
		counter++;
		$("#addcount7").val(counter++);
		$("#rem_addcount7").val(parseInt(rem_count7 + 1));
		$('#address_save').css('display', 'block');
	});

	$("#removeButtonRD").click(function() {
		var rem_count7 = $("#rem_addcount7").val();
		if (rem_count7 == 0) {
			//$('#address_save').css('display', 'none');
			alert("Address removal not allowed, either update or uncheck the active checkbox.");
			return false;
		}
		//counter--;
		//$("#TextBoxDivGEN" + counter).remove();
		$('#table_address tr:last').remove();
		$("#rem_addcount7").val(parseInt(rem_count7 - 1));
		var current_count = $("#addcount7").val();
		$("#addcount7").val(parseInt(current_count - 1));
	});
</script>
<?php if ($form_id == '') { ?>
	<script>
		$('#tab1 .hide').removeClass('hide').addClass('show');
		$('#tab1 span.show').removeClass('show').addClass('hide');
		$("#tab1 #general_view").show();
		$("#tab1 #general_edit").hide();

		$("#tab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive").attr("disabled", false);
	</script>
<?php } ?>
<script type="text/javascript">
	$(document).on('click', '#general_edit', function() {
		$('.dropdown_link').css('display', 'initial');
		$('#tab1 .hide').removeClass('hide').addClass('show');
		$('#tab1 span.show').removeClass('show').addClass('hide');
		$('.organization_footer').removeClass('hide').addClass('show');
		$("#tab1 #general_view").show();
		$("#tab1 #general_edit").hide();
		$("#tab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive,.org_valid").attr("disabled", false);
		$('.no_border').removeClass('no_border').addClass('edit_border');
		$('#email_save').show();
		$('#address_save').show();
		$('#inter_address_save').show();


	});

	$(document).on('click', '#general_view', function() {
		$('#tab1 .show').removeClass('show').addClass('hide');
		$('#tab1 span.hide').removeClass('hide').addClass('show');
		$('.dropdown_link').css('display', 'none');

		$(this).hide();
		$("#tab1 #general_edit").show();
		$("#tab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive,.org_valid").attr("disabled", true);
		$('#email_save').hide();
		$('#address_save').hide();
		$('.edit_border').removeClass('edit_border').addClass('no_border');
		$('.organization_footer').removeClass('show').addClass('hide');
		$('#inter_address_save').hide();

	});
</script>
<script>
	$(document).ready(function() {
		$('input[name="phone"], input[name="fed_phone"]').mask('(000) 000 0000');
		$('input[name="fax_no"]').mask('+99-9999999999');
		$('input[name="employer_fax"]').mask('+99-9999999999');
		$('input[name="aadhar"]').mask('999999999999');
		$('input[name="aadhar_enroll_no"]').mask('9999/99999/99999');
		$('.year').mask('9999');
		$('.passedyear').mask('9999');
		$('.mask').mask('9.99');
	});



	function validateEmployerEmail(email) {
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

		if (reg.test(email) == false) {
			alert('Enter Valid E-mail Below Given Format \r\n email@subdomain.example.com or \r\n (testuser@gmail.com)');
			document.getElementById("employer_email").value = "";
		}

	}
</script>

<script type="text/javascript">
	function validateCheckbox(id) {
		var email = $('#Email' + id).val();
		if (email != " ") {
			$("#emailstatus" + id).prop('checked', true);
		} else {
			$("#emailstatus" + id).prop('checked', false);
		}
		validateEmail(email);

	}






	function validateAddressXCheckbox(id) {
		var current_value = $('#Street_Address' + id).val();
		if (current_value != "") {
			$("#addresscheckbox" + id).prop('checked', true);
		} else {
			$("#addresscheckbox" + id).prop('checked', false);
		}
	}
	id = "addresscheckbox<?php echo $ref_count; ?>"
	$('.phone_validation').bind('keyup blur', function() {
		$(this).val($(this).val().replace(/[^0-9()+-Xx ]/g, ''));
		//$(this).val( $(this).val().replace(/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]/g,'') );
	});




	$("#inter_addButtonRD").click(function() {
		var country_list = JSON.parse('<?= $country_js ?>');
		var state_list = JSON.parse('<?= $state_js ?>');

		var counter = $("#count8").val();
		var rem_count8 = parseInt($("#rem_count8").val());


		//country_select
		country_html = '<select class="form-control" name="inter_Country[' + counter + ']" onchange="getstatedetails(this.value)"><option value="">Select</option>';
		$.each(country_list, function(key, val) {
			country_html += '<option value="' + val.CountryID + '">' + val.CountryName + '</option>';
		});
		country_html += '</select>';

		//state_select
		/*state_html = '<select class="form-control" id="inter_state" name="inter_State['+counter+']"><option value="">Select</option>';
		$.each(state_list, function (key, val) {
			state_html += '<option value="'+val.StateID+'">'+val.StateID+' - '+val.StateName+'</option>';
	    });*/

		var add_type_list = JSON.parse('<?= $address_type_js ?>');

		type_html = '<select class="form-control interaddressType" id="interaddressType' + counter + '" name="interaddressType[' + counter + ']"><option value="">Select</option>';
		$.each(add_type_list, function(key, val) {
			type_html += '<option value="' + val.name + '">' + val.name + '</option>';
		});

		if (counter > 10) {
			alert("Only 10 Reference allow");
			return false;
		}
		var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'TextBoxDivGEN' + counter);
		newTextBoxDiv.after().html('<td><input type="hidden" name="inter_Address_RowID[' + counter + ']" value="0"><input type="hidden" name="inter_AddressID[' + counter + ']" value="' + '<?= isset($infos['ID']) ? $infos['ID'] : 0; ?>' + '"><textarea rows = "1" class="form-control" name="inter_Company_Name[' + counter + ']" id="inter_Street_Address' + counter + '" onChange="validateAddressXCheckbox(' + counter + ')"></textarea></td><td><textarea rows = "1"  class="form-control" name="inter_Address1[' + counter + ']" id="inter_Address2' + counter + '"  onChange="validateAddressXCheckbox(' + counter + ')"></textarea></td><td><input class=" form-control" id="inter_City' + counter + '" name="inter_Address2[' + counter + ']" type="text"></td><td><input type="text" class="form-control" id="inter_City' + counter + '" name="inter_City[' + counter + ']"></td><td>' + country_html + '  </td><td>' + type_html + '</td><td><input class="" value="1" type="checkbox" name="inter_Active[' + counter + ']" id="addresscheckbox' + counter + '"></td>');

		newTextBoxDiv.appendTo("#inter_TextBoxesGroupRD");
		counter++;
		$("#count8").val(counter++);
		$("#rem_count8").val(parseInt(rem_count8 + 1));
		$('#inter_address_save').css('display', 'block');
	});
	$("#inter_removeButtonRD").click(function() {
		var rem_count8 = $("#rem_count8").val();
		if (rem_count8 == 0) {
			//$('#address_save').css('display', 'none');
			alert("Address removal not allowed, either update or uncheck the active checkbox.");
			return false;
		}
		//counter--;
		//$("#TextBoxDivGEN" + counter).remove();
		$('#inter_table_address tr:last').remove();
		$("#rem_count8").val(parseInt(rem_count8 - 1));
		var current_count = $("#count8").val();
		$("#count8").val(parseInt(current_count - 1));
	});


	//By prabhat 13-10-2020
	$(document).on('change', '#citizenship', function() {
		var data = $(this).val();
		if (data == 'Not US Citizen') {
			$("#citizenship_country").css("background-color", "");
			$("#citizenship_country").css("pointer-events", "");
			$("#citizenship_country").attr("required", "required");
			$('.citizenship_country').show();
		} else if (data == '') {
			$("#citizenship_country").removeAttr("required");

			$('.citizenship_country').hide();
			$('#citizenship_country').val('');
		} else {
			$("#citizenship_country").css("background-color", "#ccc");
			$("#citizenship_country").css("pointer-events", "none");
			$('.citizenship_country').show();
			$('#citizenship_country').val('USA');
			$('.ssnClass').show();

		}
	})


	$(document).on('click', '#addBoardInfo', function() {
		var counter = $('#count_board').val();
		var submit = 'submit';
		$.ajax({
			type: "POST",
			url: '<?= base_url() ?>admin/Form/set_add_more_board_html',
			data: {
				counter: counter,
				student_id: "<?= isset($infos['ID']) ?>",
				submit: submit
			},
			dataType: "html",
			success: function(data) {
				$('#add_more_board').append(data);
			},
		});

		$('#count_board').val(parseInt(counter) + 1);
	})

	$(document).on('click', '#removeBoardInfo', function() {
		if ($('#add_more_board > tr').length > 1) {
			var fixed_count = $('#fixed_count_board').val();
			var counter = $('#count_board').val();
			if (fixed_count == counter) {
				alert('Board Organization removal not allowed');
			} else {
				$('#add_more_board > tr').last().remove();
				$('#count_board').val(parseInt(counter) - 1);
			}

		}
	})


	$(document).on('change', '.board_end_date', function() {
		var rel_id = $(this).attr('rel_id');
		var start_date = $('#start_date_board' + rel_id).val();
		var end_date = $('#end_date_board' + rel_id).val();
		var submit = 'submit';
		$.ajax({
			type: "POST",
			url: '<?= base_url() ?>admin/Form/validate_end_date_from_start_date',
			data: {
				start_date: start_date,
				end_date: end_date,
				submit: submit
			},
			dataType: "html",
			success: function(data) {
				if (data == 'Please Select First Start Date') {
					alert(data);
				}

				if (data == 'End date should not be smaller than start date') {
					$('#end_date_board' + rel_id).val('');
					alert(data);
				}

			},
		});
	})

	function inter_validate_general() {
		var couter = $('#count8').val();
		for (var i = 1; i <= couter; i++) {
			$('#interaddressType' + i).removeClass('invalid');
			if ($('#interaddressType' + i).val() == '') {
				$('#interaddressType' + i).addClass('invalid');
				$('#interaddressType' + i).focus();
				// alert("International Address Type is Empty");
				return false;
			}
		}


	}

	$(document).on('click', '#inter_address_save', function(e) {
		e.preventDefault();
		$('.interaddressType').removeClass('invalid');

		if (!inter_address_validateForm()) return false;
		formname = $("#general_form");
		var formData = new FormData($('#general_form')[0]);
		formData.append("submit", "inter_address");
		formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
		$.ajax({
			type: "POST",
			dataType: 'html',
			url: formname.attr("action"),
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				alert("International Address Updated");
				window.location.href = "";
			}
		});
	})


	$(document).on('click', '#address_save', function(e) {
		e.preventDefault();
		$('.street_validate').removeClass('invalid');

		if (!address_validateForm()) return false;
		formname = $("#general_form");
		var formData = new FormData($('#general_form')[0]);
		formData.append("submit", "address");
		formData.append("form_submit_type", "ajax");
		formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
		$.ajax({
			type: "POST",
			dataType: 'html',
			url: formname.attr("action"),
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				alert(response);
				window.location.href = "";
			}
		});
	})

	$(document).on('click', '#usphone_save', function(e) {
		e.preventDefault();

		$('.phonevalidate').removeClass('invalid');
		if (!phone_validateForm()) return false;

		formname = $("#general_form");
		var formData = new FormData($('#general_form')[0]);
		formData.append("submit", "USPhone");
		formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
		$.ajax({
			type: "POST",
			dataType: 'html',
			url: formname.attr("action"),
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				alert("Phone Number Updated");
				window.location.href = "";
			}
		});

	})


	$(document).on('click', '#board_info_save', function(e) {
		e.preventDefault();
		$('.board_validation').removeClass('invalid');
		if (!board_validateForm()) return false;
		formname = $("#general_form");
		var formData = new FormData($('#general_form')[0]);
		formData.append("submit", "board_info");
		formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
		$.ajax({
			type: "POST",
			dataType: 'html',
			url: formname.attr("action"),
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				alert("Board History Updated");
				window.location.href = "";
			}
		});
	})

	$(document).on('click', '#email_save', function(e) {
		e.preventDefault();
		$('.email_validateForm').removeClass('invalid');

		if (!email_validateForm()) return false;
		formname = $("#general_form");
		var formData = new FormData($('#general_form')[0]);
		formData.append("submit", "email");
		formData.append("form_submit_type", "ajax");

		formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
		$.ajax({
			type: "POST",
			dataType: 'html',
			url: formname.attr("action"),
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				alert(response);
				window.location.href = "";
			}
		});
	})



	function address_validateForm() {
		// This function deals with validation of the form fields
		var x, y, i, valid = true;
		y = document.getElementsByClassName("street_validate");
		// A loop that checks every input field in the current tab:
		for (i = 0; i < y.length; i++) {
			// If a field is empty...
			if (y[i].value == "") {
				var val_data = $(y[i]).attr('name');
				var per_data = $('#personal_info_country_birth :selected').val();
				var var_id = $(y[i]).attr('id');
				$('#' + var_id).focus();
				y[i].className += " invalid";
				// and set the current valid status to false
				valid = false;
			}
		}
		return valid; // return the valid status 
	}


	function inter_address_validateForm() {
		// This function deals with validation of the form fields
		var x, y, i, valid = true;
		y = document.getElementsByClassName("interaddressType");
		// A loop that checks every input field in the current tab:
		for (i = 0; i < y.length; i++) {
			// If a field is empty...
			if (y[i].value == "") {
				var val_data = $(y[i]).attr('name');
				var per_data = $('#personal_info_country_birth :selected').val();
				var var_id = $(y[i]).attr('id');
				$('#' + var_id).focus();
				y[i].className += " invalid";
				// and set the current valid status to false
				valid = false;
			}
		}
		return valid; // return the valid status 
	}

	function email_validateForm() {
		// This function deals with validation of the form fields
		var x, y, i, valid = true;
		y = document.getElementsByClassName("email_validateForm");
		// A loop that checks every input field in the current tab:
		for (i = 0; i < y.length; i++) {
			// If a field is empty...
			if (y[i].value == "") {
				var val_data = $(y[i]).attr('name');
				var per_data = $('#personal_info_country_birth :selected').val();
				var var_id = $(y[i]).attr('id');
				$('#' + var_id).focus();
				y[i].className += " invalid";
				// and set the current valid status to false
				valid = false;
			}
		}
		return valid; // return the valid status 
	}


	function board_validateForm() {
		// This function deals with validation of the form fields
		var x, y, i, valid = true;
		y = document.getElementsByClassName("board_validation");
		// A loop that checks every input field in the current tab:
		for (i = 0; i < y.length; i++) {
			// If a field is empty...
			if (y[i].value == "") {
				var val_data = $(y[i]).attr('name');
				var per_data = $('#personal_info_country_birth :selected').val();
				var var_id = $(y[i]).attr('id');
				$('#' + var_id).focus();
				y[i].className += " invalid";
				// and set the current valid status to false
				valid = false;
			}
		}
		return valid; // return the valid status 
	}

	function phone_validateForm() {
		// This function deals with validation of the form fields
		var x, y, i, valid = true;
		y = document.getElementsByClassName("phonevalidate");
		// A loop that checks every input field in the current tab:
		for (i = 0; i < y.length; i++) {
			// If a field is empty...
			if (y[i].value == "") {
				var val_data = $(y[i]).attr('name');
				var per_data = $('#personal_info_country_birth :selected').val();
				var var_id = $(y[i]).attr('id');
				$('#' + var_id).focus();
				y[i].className += " invalid";
				// and set the current valid status to false
				valid = false;
			}
		}
		return valid; // return the valid status 
	}
</script>

<script>
	CKEDITOR.replace('Note');
	CKEDITOR.replace('boardHistory');




	$(document).on('click', '.view_note_detail', function() {
		let selected_data = $(this).attr("rel-data");
		let selected_title = $(this).attr('rel-title');
		$('.view_title_modal').html('');
		$('.view_detail_modal').html('');

		$('.view_title_modal').html(selected_title);
		$('.view_detail_modal').html(selected_data);

		$('#view_note_detail_modal').modal('show');
	})


	/*  CKEDITOR.instances.Note.on('contentDom', function() {
	          CKEDITOR.instances.Note.document.on('click', function(event) {
	              // This function will be called when a click occurs inside the editor
	              var htmlContent = CKEDITOR.instances.Note.getData();
	              alert(htmlContent);
	          });
	      });*/

	// Start Fwd: New Field Database 15-Nov-2023
	$(document).on('keyup blur', '#ssn', function(event) {

		var input = event.target;
		var value = input.value.replace(/\D/g, '');
		//var formattedValue = value.replace(/^(\d{3})(\d{2})(\d{4})$/, '$1-$2-$3');
		var formattedValue = value.replace(/^(\d{3})(\d{0,2})(\d{0,4})$/, function(_, p1, p2, p3) {
			var parts = [p1];
			if (p2) parts.push('-' + p2);
			if (p3) parts.push('-' + p3);
			return parts.join('');
		});

		$(this).val(formattedValue);

	})

	$(document).on('change', '#citizenship_country', function() {
		let countryVal = $(this).val();
		if (countryVal != 'USA') {
			$('.ssnClass').hide();
		} else {
			$('.ssnClass').show();
		}
	})

	// End Fwd: New Field Database 15-Nov-2023


	$(document).on('click', '.add_more_org_rel', function() {
		let allOrganization_json = <?= $allOrganization_js ?>;
		let allOrgRelationship_json = <?= $allOrgRelationship_js ?>;
		let next_org_count = parseInt($('#org_rel_count').val());
		//style="display:none;"
		let content = '';
		content += `<tr>
                        <td>
                        <select class="form-control relationship_type" name="master_relationship_type[` + next_org_count + `]" rel_id="` + next_org_count + `"> 
                            <option value="Organization" selected>Organization</option>
                            <option value="Individual">Individual</option>
                        </select>
                        </td>
                    <td>
                    <input type="hidden" name="org_row_id[` + next_org_count + `]" value="0">
                    <span id="org_name` + next_org_count + `">
                    <select class="form-control" name="organization[` + next_org_count + `]">
                    <option value="">Please Select Organization</option>`;
		$.each(allOrganization_json, function(key, orgg) {
			content += `<option value="` + orgg['id'] + `">` + orgg['name'] + `</option>`;
		});

		content += `</select></span>
                    </td>
                    <td>
                    <span id="relationship` + next_org_count + `">
                    <select class="form-control" name="relationship[` + next_org_count + `]">
                    <option value="">Please Select Relationship Type</option>`;
		$.each(allOrgRelationship_json, function(key, orgRel) {
			content += `<option value="` + orgRel['id'] + `">` + orgRel['name'] + `</option>`;
		})

		content += `</select></span>
                    </td>
                    <td>
                    <input type="checkbox" value="1" checked name="org_valid[` + next_org_count + `]">
                    </td>
                     <td>
                     <span id="primary_` + next_org_count + `">
                    <input type="checkbox" value="1" name="org_primary[` + next_org_count + `]">
                    </span>
                    </td>
                    </tr>`;
		$('#organization_crm_more').append(content);
		$('#org_rel_count').val(parseInt(next_org_count) + 1)
	})

	$(document).on('click', '.remove_more_org_rel', function() {
		var fixed_count = parseInt($('#rem_org_rel_count').val()) + 1;
		var counter = $('#org_rel_count').val();
		if (fixed_count == counter) {
			alert('Organization removal not allowed');
		} else {
			let current_value = parseInt($('#org_rel_count').val()) - 1;
			$('#org_rel_count').val(current_value);
			$('#organization_crm_more > tr').last().remove();
			//$('#count_board').val(parseInt(counter)-1);
		}
	})

	$(document).on('change', '.relationship_type', function() {
		let rel_id = $(this).attr('rel_id');
		let select_val = $(this).val();
		if (select_val == 'Individual') {
			individualList(rel_id);
		} else {
			organizationListing(rel_id);
		}
	})

	function individualList(rel_id) {
		let contractList = <?= json_encode($allContact_js) ?>;
		let submit = 'submit';
		let content = '<div class="center"><select class="select2 form-control" name="linkerId[' + rel_id + ']">';
		let promises = [];
		// Loop through contractList and create a Promise for each asynchronous operation
		$.each(contractList, function(key, val) {
			let promise = new Promise(function(resolve, reject) {
				setTimeout(function() {
					content += '<option value="' + val.ID + '">' + val.FirstName + " " + val.LastName + '</option>';
					resolve();
				}, 0);
			});
			promises.push(promise); // Push the Promise to the array
		});
		Promise.all(promises).then(function() {
			content += '</select></div>';
			$('#org_name' + rel_id).html(content);
			$('#primary_' + rel_id).hide();
			$('#relationship' + rel_id).html('<input type="text" class="form-control" name="labled_indetifier[' + rel_id + ']" maxlength="30">');
			$(':checkbox[name="org_primary[' + rel_id + ']"]').prop('checked', false);
			$(".select2").select2();

		});

		/* $('#org_name'+rel_id).html(content);
		 $('#primary_'+rel_id).hide();
		 $('#relationship'+rel_id).html('<input type="text" class="form-control" name="" maxlength="30">');
		     
		 
		 $.ajax({
		     type: "POST",
		     url: '<?= base_url() ?>admin/Form/getAllContact',
		     data: {submit:submit},
		     dataType: "html",
		     success: function(data){
		       $('#org_name'+rel_id).html(data);
		       $('#primary_'+rel_id).hide();
		       $('#relationship'+rel_id).html('<input type="text" class="form-control" name="" maxlength="30">');
		       $(".select2").select2();
		     },
		 });  */
	}

	function organizationListing(rel_id) {
		let content = '';
		let allOrganization_json = <?= $allOrganization_js ?>;
		let allOrgRelationship_json = <?= $allOrgRelationship_js ?>;

		content += `<select class="form-control" name="organization[` + rel_id + `]">`;
		content += `<option value="">Please Select Organization</option>`;
		$.each(allOrganization_json, function(key, val) {
			content += '<option value="' + val.id + '">' + val.name + '</option>';
		});
		content += `</select>`;
		$('#org_name' + rel_id).html(content);
		let content1 = '';

		content1 += `<select class="form-control" name="relationship[` + rel_id + `]">
            <option value="">Please Select Relationship Type</option>`;
		$.each(allOrgRelationship_json, function(key, orgRel) {
			content1 += `<option value="` + orgRel['id'] + `">` + orgRel['name'] + `</option>`;
		})
		content1 += `</select>`;

		$('#primary_' + rel_id).show();
		$('#relationship' + rel_id).html(content1);

	}


	$(document).ready(function() {
		$(".select2").select2();
	});
</script>

<!-- Modal -->
<div class="modal fade" id="view_note_detail_modal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title view_title_modal"></h4>
			</div>
			<div class="modal-body view_detail_modal" style="max-height:300px;overflow-y:scroll;">
				<p></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>