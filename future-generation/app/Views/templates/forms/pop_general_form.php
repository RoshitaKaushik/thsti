<?php
$access = getAccess(1); //1 for general
if (!empty($country)) {
    $country_js = json_encode($country);
}
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
$attr = array('class' => 'cmxform form-horizontal tasi-form research', 'id' => 'general_form', 'name' => 'general_form_name');
echo form_open_multipart('admin/form/addajaxGenralInfo', $attr);
//echo "<pre>"; print_r($infos);die;
?>
<input type="hidden" name="id" value="<?php if (isset($infos['ID'])) {
                                            echo $infos['ID'];
                                        } ?>">

<div class="outer_class">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-4">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="title " class="control-label col-sm-4">Title </label>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-7">
                            <span class="show"><?php
                                                if (isset($post['title'])) {
                                                    echo $post['title'];
                                                } else if (isset($infos['title'])) {
                                                    echo $infos['title'];
                                                } ?>
                            </span>
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
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-7">
                            <span class="show"><?php
                                                if (isset($post['FirstName'])) {
                                                    echo $post['FirstName'];
                                                } else if (isset($infos['FirstName'])) {
                                                    echo $infos['FirstName'];
                                                } ?>
                            </span>
                            <input class=" form-control name_validation hide validate" id="FirstName" name="FirstName" type="text" value="<?php
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
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-7">
                            <span class="show"><?php
                                                if (isset($post['LastName'])) {
                                                    echo $post['LastName'];
                                                } else if (isset($infos['LastName'])) {
                                                    echo $infos['LastName'];
                                                } ?></span>
                            <input class=" form-control hide name_validation validate" id="LastName" name="LastName" type="text" value="<?php
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
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-7">
                            <span class="show"><?php
                                                if (isset($post['Spouse'])) {
                                                    echo $post['Spouse'];
                                                } else if (isset($infos['Spouse'])) {
                                                    echo $infos['Spouse'];
                                                } ?>
                            </span>
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
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-7">
                            <span class="show"><?php
                                                if (isset($post['Greeting'])) {
                                                    echo $post['Greeting'];
                                                } else if (isset($infos['Greeting'])) {
                                                    echo $infos['Greeting'];
                                                } ?>
                            </span>
                            <input class=" form-control hide validate" id="Greeting" name="Greeting" type="text" value="<?php
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

                            <input class=" form-control hide validate" id="Addressee" name="Addressee" type="text" value="<?php
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
                                if ($infos['Sex'] == 'M' || $infos['Sex'] == '1') {
                                    echo "Male";
                                } elseif ($infos['Sex'] == 'F' || $infos['Sex'] == '2') {
                                    echo "Female";
                                } elseif ($infos['Sex'] == '4' || $infos['Sex'] == 'O') {
                                    echo "Other";
                                } elseif ($infos['Sex'] == '3') {
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

                <div class="col-sm-12 gender_another" <?php if ($infos['Sex'] != '4' && $infos['Sex'] != '0') {
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
                                                    echo $infos['Ethnicity'];
                                                } ?></span>
                            <select name="Ethnicity" id="Ethnicity" class="form-control hide">
                                <option value="">----- Please Select -----</option>
                                <option value="American Indian" <?php if ($infos['Ethnicity'] == 'American Indian') {
                                                                    echo 'selected';
                                                                } ?>>American Indian</option>
                                <option value="Asian" <?php if ($infos['Ethnicity'] == 'Asian') {
                                                            echo 'selected';
                                                        } ?>>Asian</option>
                                <option value="Black/African American" <?php if ($infos['Ethnicity'] == 'Black/African American') {
                                                                            echo 'selected';
                                                                        } ?>>Black/African American</option>
                                <option value="Hispanic/Latino" <?php if ($infos['Ethnicity'] == 'Hispanic/Latino') {
                                                                    echo 'selected';
                                                                } ?>>Hispanic/Latino</option>
                                <option value="Native Hawaiian/Pacific Islander" <?php if ($infos['Ethnicity'] == 'Native Hawaiian/Pacific Islander') {
                                                                                        echo 'selected';
                                                                                    } ?>>Native Hawaiian/Pacific Islander</option>
                                <option value="White" <?php if ($infos['Ethnicity'] == 'White') {
                                                            echo 'selected';
                                                        } ?>>White</option>
                                <option value="Non-Resident Alien" <?php if ($infos['Ethnicity'] == 'Non-Resident Alien') {
                                                                        echo 'selected';
                                                                    } ?>>Non-Resident Alien</option>
                                <option value="Two or more races" <?php if ($infos['Ethnicity'] == 'Two or more races') {
                                                                        echo 'selected';
                                                                    } ?>>Two or more races</option>
                                <option value="Unknown" <?php if ($infos['Ethnicity'] == 'Unknown') {
                                                            echo 'selected';
                                                        } ?>>Unknown</option>
                                <option value="Other" <?php if ($infos['Ethnicity'] == 'Other') {
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
                                                    echo $infos['citizenship'];
                                                } ?></span>
                            <select name="citizenship" id="citizenship" class="form-control hide">
                                <option value="">----- Please Select -----</option>
                                <option value="US Citizen" <?php if ($infos['citizenship'] == 'US Citizen') {
                                                                echo 'selected';
                                                            } ?>>US Citizen</option>
                                <option value="Naturalized" <?php if ($infos['citizenship'] == 'Naturalized') {
                                                                echo 'selected';
                                                            } ?>>Naturalized</option>
                                <option value="Perm Resident Alien" <?php if ($infos['citizenship'] == 'Perm Resident Alien') {
                                                                        echo 'selected';
                                                                    } ?>>Perm Resident Alien</option>
                                <option value="Not US Citizen" <?php if ($infos['citizenship'] == 'Not US Citizen') {
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
                    if ($infos['citizenship'] == '') {
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
                                    <option <?php if ($infos['citizenship_country'] == $con['CountryID']) {
                                                echo "selected";
                                            } ?> value="<?= $con['CountryID'] ?>"><?= $con['CountryName'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php
                $profiles = (array) session()->get('profiles'); // safely ensures it's always an array
                if (
                    in_array(1, $profiles) ||
                    in_array(5, $profiles) ||
                    in_array(2, $profiles) ||
                    in_array(6, $profiles) ||
                    session()->get('role') == '1'
                ) {
                ?>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="SSN" class="control-label col-sm-4">SSN</label>
                            <div class="col-sm-1"> :
                            </div>
                            <div class="col-sm-7">
                                <span class="show"><?php if (isset($post['ssn'])) {
                                                        echo $post['ssn'];
                                                    } else if (isset($infos['ssn'])) {
                                                        echo $infos['ssn'];
                                                    }    ?></span>
                                <?php
                                $profiles = (array) session()->get('profiles');
                                if (
                                    in_array(1, $profiles) ||
                                    in_array(5, $profiles) ||
                                    session()->get('role') == '1'
                                ) { ?>
                                    <input class=" form-control hide" name="ssn" type="text" id="ssn" pattern="\d{3}-\d{2}-\d{4}" maxlength="11" value="<?php
                                                                                                                                                        if (isset($post['ssn'])) {
                                                                                                                                                            echo $post['ssn'];
                                                                                                                                                        } else if (isset($infos['ssn'])) {
                                                                                                                                                            echo $infos['ssn'];
                                                                                                                                                        } ?>">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
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
                                    <textarea rows='1' class="form-control hide street_validate" name="Street_Address[<?= $ref_count; ?>]" id="Street_Address<?= $ref_count; ?>" onChange="validateAddressXCheckbox(<?php echo $ref_count; ?>)" required><?php if (isset($address['Street_Address'])) {
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
                                    <input class="form-control hide street_validate" id="City<?= $ref_count; ?>" name="City[<?= $ref_count ?>]" type="text" value="<?php if (isset($address['City'])) {
                                                                                                                                                                        echo $address['City'];
                                                                                                                                                                    } ?>" required>
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
                                    <select class="form-control hide street_validate" name="Country[<?= $ref_count ?>]" onChange="getstatedetails(this.value)" required>
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


                                    <select class="form-control hide street_validate" id="addressType<?= $ref_count ?>" required name="addressType[<?= $ref_count ?>]">
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
                                    <textarea rows='1' class="form-control hide street_validate" name="Street_Address[1]" id="Street_Address1" onChange="validateAddressXCheckbox(<?php echo $ref_count; ?>)"></textarea>
                                </td>
                                <td>
                                    <textarea rows='1' class="form-control hide" name="Address2[1]" id="" onChange="validateAddressXCheckbox(<?php echo $ref_count; ?>)"></textarea>
                                </td>
                                <td>
                                    <input class="form-control char hide street_validate" id="City1" name="City[1]" type="text">
                                </td>
                                <td>
                                    <select class="form-control hide " id="State1" name="State[1]">
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
                                    <select class="form-control hide street_validate" id="Country1" name="Country[1]" onChange="getstatedetails(this.value)">
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

                                    <select class="form-control hide street_validate" id="addressType1" name="addressType[1]">
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



<!-- International Address -->


<?php if (isset($infos['ID'])): ?>
    <!-- international address shipping -->
    <div class="col-sm-12">
        <h4>International Address</h4>
        <div class="form-group no_border">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="inter_table_address">
                    <tbody id="inter_TextBoxesGroupRD">
                        <tr>
                            <th style="width:20%">Address1</th>
                            <th style="width:20%">Address2</th>
                            <th style="width:20%">Address3</th>
                            <th>Locale</th>
                            <th>Country</th>
                            <th>Type</th>
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
                                                                                                                            echo isset($infos['ID']) ? $infos['ID'] : 0;
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
                                        <select class="form-control interaddressType hide" id="interaddressType<?= $inter_ref_count ?>" required name="interaddressType[<?= $inter_ref_count ?>]">
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
                                        <input type="hidden" name="inter_AddressID[1]" value="<?php echo isset($infos['ID']) ? $infos['ID'] : 0; ?>">
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
<?php endif; ?>

<!-- End International Address -->


<!--div class="col-sm-12"-->
<div class="col-sm-12">
    <div class="form-group">
        <label for="firstname" class="control-label col-lg-2">Notes :</label>
        <!--div class="col-lg-10"-->

        <!--<span class="show"><?php if (isset($post['Note'])) {
                                    echo $post['Note'];
                                } else if (isset($infos['Note'])) {
                                    echo $infos['Note'];
                                } ?></span>-->


        <span class="show">
            <span class="fa fa-eye view_note_detail text-primary" rel-title="Notes" style="padding: 5px;margin-left: -50px;margin-top: -10px;cursor:pointer" rel-data='<?php if (isset($post['Note'])) {
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
<div class="col-sm-12">
    <div class="form-group">
        <label for="Board History Notes" class="control-label col-lg-2">Board History Notes :
            <!--div class="col-lg-10"-->

        </label>
        <span class="show"><span rel-title="Board History Notes" class="fa fa-eye view_note_detail text-primary" style="padding: 5px;margin-left: -50px;margin-top: -10px;cursor:pointer" rel-data='<?php if (isset($post['boardHistory'])) {
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

<!--/div-->


<div class="col-sm-12">

    <div class="row">
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


                                                    <input class="form-control hide email email_validateForm validate" id="Email<?= $ref_count; ?>" name="Email[<?= $ref_count ?>]" type="email" value="<?php if (isset($email['Email'])) {
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
                                                    <input class="form-control hide email_validateForm validate" id="Email1" name="Email[1]" type="email" onchange="validateCheckbox(<?php echo $ref_count + 1; ?>" placeholder="username@subdomain.domain">
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
                                    <?php $ref_count = 1;

                                    if (!empty($assign_organization)) {
                                        $ref_count = 0;
                                        foreach ($assign_organization as $ass_org) {
                                            $ref_count++;
                                    ?>
                                            <tr id="Textboardmemeber<?php echo $ref_count; ?>">
                                                <td>
                                                    <input value="<?= $ass_org['assign_id'] ?>" type="hidden" name="Board_RowID[<?= $ref_count ?>]">
                                                    <span class="show"><?php if (isset($ass_org['name'])) {
                                                                            echo $ass_org['name'];
                                                                        } ?></span>
                                                    <select class="form-control hide board_validation" name="boardtype[<?= $ref_count ?>]">
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
                                                <select class="form-control hide board_validation" name="boardtype[<?= $ref_count   ?>]">
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
                                    <input type="hidden" id="count_board" value="<?= $ref_count ?>">
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
                                    $ref_count = 1;


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

                                                    <select class="form-control hide phonevalidate" name="phonetype[<?= $ref_count ?>]" id="phonetype<?= $ref_count ?>" <?php if (isset($num['Number'])) {
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
                                                    <select class="form-control hide phonevalidate" name="phonetype[1]" id="phonetype<?= $ref_count ?>">
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
                                                    <input class="USPhoneNumber phonevalidate phonetype form-control hide" type="text" name="USPhoneNumber[1]" id="USPhoneNumber<?php echo $ref_count; ?>" rel_id="<?php echo $ref_count; ?>">
                                                </td>

                                                <td>
                                                    <input class="no_decimal form-control hide" type="text" name="Extension[1]" id="Extension<?php echo $ref_count; ?>">
                                                </td>

                                                <td>
                                                    <input value="1" class="USActive" type="checkbox" name="USActive[1]" id="USstatus<?php echo $ref_count; ?>" checked="true" disabled>
                                                </td>


                                                <input type="hidden" id="count11" value="2">
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


    <div class="col-sm-12 patner_org">
        <div class="form-group" id="checkbox">

            <!--Change Start by Prabhat 28-09-2023 Fwd: Database - New Check box-->
            <div class="checkbox checkbox-success checknox-list">
                <input class="" value="1" type="checkbox" name="doNotContact" <?php if (isset($getContactTag[0]['do_not_contact']) && $getContactTag[0]['do_not_contact'] == 1) echo 'checked' ?> disabled>
                <label> Do Not Contact</label>
            </div> <br>

            <div class="form-group">
                <div class="col-sm-4">
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
                <div class="col-sm-4">
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
                            if ($group[0]['PartnerOrgName'] == $org['name']) {
                                $sec = 'selected';
                            } else if ($org['name'] == 'Future Generations Haiti' && $group[0]['PartnerOrgName'] == 'Haiti') {
                                $sec = 'selected';
                            } else if ($org['name'] == 'Future Generations Afghanistan' && $group[0]['PartnerOrgName'] == 'Afghanistan') {
                                $sec = 'selected';
                            } else if ($org['name'] == 'Future Generations Peru' && $group[0]['PartnerOrgName'] == 'Peru') {
                                $sec = 'selected';
                            } else if ($org['name'] == 'Future Generations China/Fuqun' && $group[0]['PartnerOrgName'] == 'China') {
                                $sec = 'selected';
                            } else if ($org['name'] == 'International Institute of Rural Reconstruction (IIRR)' && $group[0]['PartnerOrgName'] == 'IIRR') {
                                $sec = 'selected';
                            }
                        ?>
                            <option <?= $sec ?> value="<?= $org['name'] ?>"><?= $org['name'] ?></option>
                        <?php
                        }
                        ?>


                    </select>

                </div>
            </div>

        </div>

    </div>



    <div class="clearfix"></div>





    <?php if ($access['edit_access'] || $access['add_access']) { ?>
        <!--button type="submit" name= "submit" class="btn btn-success center-block hide Addresval" value="name">Save</button-->
        <!--button class="btn btn-success center-block hide" name= "submit">Save</button-->
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align:center">
            <span class="btn btn-success center-block add_general">Save</span>
        </div>
        <div class="col-md-4"></div>
    <?php } ?>


</div>

<?php echo form_close(); ?>
<style>
    .inline {

        display: inline-block !important;

    }

    .add_general {
        width: 25%;
    }
</style>

<script>
    CKEDITOR.replace('Note', {
        height: 150,
        toolbar: 'Basic',
        // Other configuration options
    });

    CKEDITOR.replace('boardHistory', {
        height: 150,
        toolbar: 'Basic',
        // Other configuration options
    });
</script>