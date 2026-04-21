<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
<style>
    .waiting_response {
        pointer-events: none ! important;
    }

    .waiting_curser {
        cursor: not-allowed ! important;
    }

    .chosen-container {
        width: 100% ! important;
    }

    form#filter_demographic label.control-label {
        height: 20px;
        line-height: 11px;
    }

    #alldataTable1_wrapper .row:nth-of-type(2) {
        min-height: .01%;
        overflow-x: auto;
    }

    .table-responsive {
        overflow-x: inherit !important;
        min-height: auto !important;
    }

    .custum_buttom {
        margin-top: 1px;
    }

    .buttons-colvis {
        margin-top: -2px ! important;
    }

    .dt-button-collection {
        /*    width: 300px;*/
        background: #d1f1fa !important;
        z-index: 9999999999;
        position: absolute;
        margin-top: 0 !important;
        box-shadow: none;
        padding: 4px 0;
        border: 0;
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 26%);
    }

    button.dt-button.buttons-collection.buttons-colvis {
        position: relative;
        left: 255px;
    }

    .dt-button-collection button.active {
        display: block;
        background: #d1f1fa !important;
        width: 100%;
        padding: 3px 7px;
        border-bottom: 1px solid #f1eeee !important;
        font-size: 12px;
        cursor: pointer;
        text-align: left;
        border: none;
    }

    .dt-button-collection button {
        display: block;
        background: #fff !important;
        width: 100%;
        padding: 3px 7px;
        border-bottom: 1px solid #f1eeee !important;
        font-size: 12px;
        cursor: pointer;
        text-align: left;
        border: none;
    }
</style>

<?php
//echo "<pre>";print_r($data);die; 
//echo "<pre>"; print_r($this->session->userdata());
?>

<style>
    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        width: auto;
    }

    /*.dataTables_info{ 
    display:none;
}*/

    #classListing_filter {
        display: none;
    }

    #SemesterListing_filter {
        float: left;
    }

    .excel_position button.dt-button.buttons-excel.buttons-html5 {
        position: absolute;
        top: -3px;
    }

    th {
        font-size: 10px !important;
    }

    body {
        font-size: 11px !important;
    }

    .buttons-excel {
        display: none;
    }

    td {
        text-align: left ! important;
    }

    .content_div {
        top: -50px;
        position: relative;
    }


    th,
    td {
        white-space: nowrap;
    }

    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }

    #alldataTable1_filter {
        display: inline;
        float: right;

        position: relative;
    }

    .dt-buttons {
        display: inline;
    }

    #alldataTable1_length {
        left: 64px;
        position: relative;
    }

    .buttons-collection {
        padding: 0px;
        border: 0px;
        background: #fff;
    }


    .filter-sub-menu-outer-box .filter_ul {
        width: 1000px ! important;
    }

    .dt-button.buttons-collection.buttons-page-length {
        position: relative;
        left: 259px;
        top: -13px;
    }

    .buttons-page-length span {
        padding: 8px 10px;
        color: #5c5c5c ! important;
        background-color: #ffffff;
        font-size: 14px;
        cursor: pointer ! important;
        display: block;
        border-radius: 5px;
        border: 1px solid #e9e6e6;
        margin-top: -12px;
        box-shadow: none;
    }
</style>

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Student demographic report </h4>
    				<a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
            						<i class="ion-arrow-left-a"></i>
            						<span><strong>Go Back</strong></span> 
            		</a>
    			</div>
    		</div-->

            <div class="col-md-12">
                <div class="row">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <h3 class="panel-title">Student demographic report
                                <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>
                                </a>
                            </h3>
                        </div>

                        <div class="panel-body">

                            <!-- Start filter row -->
                            <div class="col-md-12">
                                <!-- Button Filter -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <form method='post' action='<?= base_url(); ?>admin/Reports/student_demographic_report' id="filter">
                                            <div class="filter-sub-menu-outer-box">
                                                <li class="dropdown hidden-xs filter-li">
                                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-filter"></i>Filter <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-lg filter_ul">
                                                        <li class="text-center notifi-title">Filter</li>
                                                        <li class="list-group">
                                                            <!-- list item-->
                                                            <div class="col-sm-12 filter_category">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-2 top_maargin">
                                                                            <label for="Driver's License" class="control-label">Ethnicity</label>
                                                                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <select name="Ethnicity" id="Ethnicity" class="form-control filter_ajax">
                                                                                <option value=""> Please Select </option>
                                                                                <option <?php if ($selected_Ethnicity == 'American Indian') {
                                                                                            echo 'selected';
                                                                                        } ?> value="American Indian">American Indian</option>
                                                                                <option <?php if ($selected_Ethnicity == 'Asian') {
                                                                                            echo 'selected';
                                                                                        } ?> value="Asian">Asian</option>
                                                                                <option <?php if ($selected_Ethnicity == 'Black/African American') {
                                                                                            echo 'selected';
                                                                                        } ?> value="Black/African American">Black/African American</option>
                                                                                <option <?php if ($selected_Ethnicity == 'Hispanic/Latino') {
                                                                                            echo 'selected';
                                                                                        } ?> value="Hispanic/Latino">Hispanic/Latino</option>
                                                                                <option <?php if ($selected_Ethnicity == 'Native Hawaiian/Pacific Islander') {
                                                                                            echo 'selected';
                                                                                        } ?> value="Native Hawaiian/Pacific Islander">Native Hawaiian/Pacific Islander</option>
                                                                                <option <?php if ($selected_Ethnicity == 'White') {
                                                                                            echo 'selected';
                                                                                        } ?> value="White">White</option>
                                                                                <option <?php if ($selected_Ethnicity == 'Non-Resident Alien') {
                                                                                            echo 'selected';
                                                                                        } ?> value="Non-Resident Alien">Non-Resident Alien</option>
                                                                                <option <?php if ($selected_Ethnicity == 'Unknown') {
                                                                                            echo 'selected';
                                                                                        } ?> value="Unknown">Unknown</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-2 top_maargin">
                                                                            <label for="citizenship" class="control-label">Citizenship Status</label>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <select name="citizenship" id="citizenship" class="form-control filter_ajax">
                                                                                <option value=""> Please Select</option>
                                                                                <option <?php if ($selected_citizenship == 'Naturalized') {
                                                                                            echo 'selected';
                                                                                        } ?> value="Naturalized">Naturalized</option>
                                                                                <option <?php if ($selected_citizenship == 'Not US Citizen') {
                                                                                            echo 'selected';
                                                                                        } ?> value="Not US Citizen">Not US Citizen</option>
                                                                                <option <?php if ($selected_citizenship == 'Perm Resident Alien') {
                                                                                            echo 'selected';
                                                                                        } ?> value="Perm Resident Alien">Perm Resident Alien</option>
                                                                                <option <?php if ($selected_citizenship == 'US Citizen') {
                                                                                            echo 'selected';
                                                                                        } ?> value="US Citizen">US Citizen</option>
                                                                                <option <?php if ($selected_citizenship == 'other') {
                                                                                            echo 'selected';
                                                                                        } ?> value="other">Other</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-2 top_maargin">
                                                                            <label for="country" class="control-label">Country</label>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <select class="form-control filter_ajax" name="Country">
                                                                                <option value="">Select</option>
                                                                                <?php
                                                                                if (!empty($country)) {
                                                                                    foreach ($country as $con) {
                                                                                ?>
                                                                                        <option <?php if ($selected_Country == $con['CountryID']) {
                                                                                                    echo 'selected';
                                                                                                } ?> value="<?= $con['CountryID'] ?>"><?= strtoupper($con['CountryName']) ?></option>
                                                                                    <?php } ?>
                                                                                    <option <?php if ($selected_Country == 'other') {
                                                                                                echo 'selected';
                                                                                            } ?> value="other">Others</option>
                                                                                <?php
                                                                                } ?>
                                                                            </select>
                                                                        </div>

                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-2 top_maargin">
                                                                            <label for="sex" class="control-label">Sex</label>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <select class="form-control filter_ajax" id="Sex" name="Sex">
                                                                                <option value="">Select</option>
                                                                                <option <?php if ($selected_Sex == 'F') {
                                                                                            echo 'selected';
                                                                                        } ?> value="F">Female</option>
                                                                                <option <?php if ($selected_Sex == 'M') {
                                                                                            echo 'selected';
                                                                                        } ?> value="M">Male</option>
                                                                                <option <?php if ($selected_Sex == 'Other') {
                                                                                            echo 'selected';
                                                                                        } ?> value="Other">Other</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-2 top_maargin">
                                                                            <label for="Certificates" class="control-label">Enrolled into a certificate <!--<span class="requires">*</span>--></label>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <select class='form-control filter_ajax' name='enroll_certificate'>
                                                                                <option value=''>--Please Select--</option>
                                                                                <option <?php if ($selected_enroll_certificate == 'No') {
                                                                                            echo "Selected";
                                                                                        } ?> value='No'>No</option>
                                                                                <option <?php if ($selected_enroll_certificate == 'Yes') {
                                                                                            echo "Selected";
                                                                                        } ?> value='Yes'>Yes</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-2 top_maargin">
                                                                            <label for="Certificates" class="control-label">Enrolled into a Master's program <!--<span class="requires">*</span>--></label>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <select class='form-control filter_ajax' name='master_program'>
                                                                                <option value=''>--Please Select--</option>
                                                                                <option <?php if ($selected_master_program == 'No') {
                                                                                            echo "Selected";
                                                                                        } ?> value='No'>No</option>
                                                                                <option <?php if ($selected_master_program == 'Yes') {
                                                                                            echo "Selected";
                                                                                        } ?> value='Yes'>Yes</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-2 top_maargin">
                                                                            <label class="control-label">Graduate</label>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <select class="form-control filter_ajax graduate_state" name="graduate_state">
                                                                                <option value="">Please Select</option>
                                                                                <option <?php if ($selected_graduate_state == 'No') {
                                                                                            echo "selected";
                                                                                        } ?> value="No">No</option>
                                                                                <option <?php if ($selected_graduate_state == 'Yes') {
                                                                                            echo "selected";
                                                                                        } ?> value="Yes">Yes</option>
                                                                            </select>
                                                                        </div>

                                                                        <?php
                                                                        $first_css = "";
                                                                        $second_css = "";
                                                                        if ($selected_graduate_state == 'No') {
                                                                            $first_css = "style='display:none'";
                                                                        } else {
                                                                            $second_css = "style='display:none'";
                                                                        }
                                                                        ?>
                                                                        <span class='graduated_from_div' <?= $first_css ?>>
                                                                            <div class="col-md-2 top_maargin">
                                                                                <label for="graduation dates" class="control-label">Graduation Dates Between</label>
                                                                            </div>
                                                                            <div class="col-md-2 top_maargin" id="div_graduation_from">
                                                                                <select class="form-control filter_ajax" name="graduation_from" id="graduation_from">
                                                                                    <option value="">Please Select</option>
                                                                                    <?php
                                                                                    for ($k = date('Y'); $k >= 1985; $k--) { ?>
                                                                                        <option <?php if ($selected_graduation_from == $k) {
                                                                                                    echo "selected";
                                                                                                } ?> value="<?= $k ?>"><?= $k ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </span>
                                                                        <!--- Or Show --->
                                                                        <span class='not_graduated_from_div' <?= $second_css ?>>
                                                                            <div class="col-md-2 top_maargin">
                                                                                <label for="graduation dates" class="control-label">Not Graduation Dates Between</label>
                                                                            </div>
                                                                            <div class="col-md-2 top_maargin" id="not_div_graduation_from">
                                                                                <select class="form-control filter_ajax" name="not_graduation_from" id="not_graduation_from">
                                                                                    <option value="">Please Select</option>
                                                                                    <?php
                                                                                    for ($k = date('Y'); $k >= 1985; $k--) { ?>
                                                                                        <option <?php if ($selected_not_graduation_from == $k) {
                                                                                                    echo "selected";
                                                                                                } ?> value="<?= $k ?>"><?= $k ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </span>


                                                                        <span class='graduated_to_div' <?= $first_css ?>>
                                                                            <div class="col-md-2 top_maargin">
                                                                                <label for="graduation dates" class="control-label">To </label>
                                                                            </div>
                                                                            <div class="col-md-2 top_maargin" id="div_graduation_to">
                                                                                <select class="form-control filter_ajax" id="graduation_to" name="graduation_to">
                                                                                    <option value="">Please Select</option>
                                                                                    <?php
                                                                                    $s_k = 1985;
                                                                                    if ($selected_graduation_from != '') {
                                                                                        $s_k = $selected_graduation_from;
                                                                                    }
                                                                                    for ($k = date('Y'); $k >= $s_k; $k--) { ?>
                                                                                        <option <?php if ($selected_graduation_to == $k) {
                                                                                                    echo "selected";
                                                                                                } ?> value="<?= $k ?>"><?= $k ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </span>
                                                                        <!--- Or Show --->
                                                                        <span class='not_graduated_to_div' <?= $second_css ?>>
                                                                            <div class="col-md-2 top_maargin">
                                                                                <label for="graduation dates" class="control-label">To</label>
                                                                            </div>
                                                                            <div class="col-md-2 top_maargin" id="not_div_graduation_to">
                                                                                <select class="form-control filter_ajax" id="not_graduation_to" name="not_graduation_to" id="not_to_result">
                                                                                    <option value="">Please Select</option>
                                                                                    <?php
                                                                                    $s_k1 = 1985;
                                                                                    if ($selected_not_graduation_from != '') {
                                                                                        $s_k1 = $selected_not_graduation_from;
                                                                                    }
                                                                                    for ($k1 = date('Y'); $k1 >= $s_k1; $k1--) { ?>
                                                                                        <option <?php if ($selected_not_graduation_to == $k1) {
                                                                                                    echo "selected";
                                                                                                } ?> value="<?= $k1 ?>"><?= $k1 ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </span>


                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-2 top_maargin">
                                                                            <label class="control-label">Withdrawn</label>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <select class="form-control filter_ajax" name="withdrawn">
                                                                                <option value="">Please Select</option>
                                                                                <option <?php if ($selected_withdrawn == 'Yes') {
                                                                                            echo "selected";
                                                                                        } ?> value="Yes">Yes</option>
                                                                                <option <?php if ($selected_withdrawn == 'No') {
                                                                                            echo "selected";
                                                                                        } ?> value="No">No</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <label class="control-label">Start Date (From)</label>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <input class="form-control filter_ajax datepicker" value="<?= $start_date_from ?>" name="start_date_from" type="text">
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <label class="control-label">Start Date (To)</label>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <input class="form-control num filter_ajax datepicker" value="<?= $start_date_to ?>" name="start_date_to" type="text">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-2 top_maargin">
                                                                            <label class="control-label">Market Name</label>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <select data-placeholder="Begin typing a name to filter..." multiple class="chosen-select filter_ajax" name="special_program[]">
                                                                                <?php
                                                                                foreach ($student_special_program as $sp) { ?>
                                                                                    <option value="<?= $sp['Special_ProgramID'] ?>"><?= $sp['Special_Program_Name'] ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-2 top_maargin">
                                                                            <label class="control-label">Concentration/Specialization</label>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin">
                                                                            <select class="form-control filter_ajax" name="program">
                                                                                <option value="">Select Concentration/Specialization</option>
                                                                                <?php foreach ($student_program as $sp) { ?>
                                                                                    <option <?php if ($selected_program == $sp['ProgramID']) {
                                                                                                echo "selected";
                                                                                            } ?> value="<?= $sp['ProgramID'] ?>"><?= $sp['Program_Name'] ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>


                                                                        <div class="col-md-2 top_maargin">
                                                                            <label class="control-label">Track</label>
                                                                        </div>
                                                                        <div class="col-md-2 top_maargin track_div">
                                                                            <select data-placeholder="Begin typing a name to filter..." multiple class="chosen-select filter_ajax" name="track[]">
                                                                                <?php
                                                                                foreach ($tracks as $track) { ?>
                                                                                    <option value="<?= $track['id'] ?>"><?= $track['track_name'] ?> </option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <hr>
                                                                    <div class="col-md-12 text-right">
                                                                        <span class="btn btn-success btn-xs filter_data" style="margin-bottom:10px;">Filter</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>

                                                <li class="cell_spacing_li">
                                                    <a href="#" data-target="#" title="Line Spacing" class="dropdown-toggle waves-effect waves-light spacing-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                        <!--i class="fa fa-ellipsis-h" aria-hidden="true"></i-->
                                                        <i class="fa fa-arrows-v"></i><i class="fa fa-bars"></i> <!--<i class="fa fa-angle-down" aria-hidden="true">--></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-md spacing_ul">
                                                        <li class="list-group" style="margin-bottom:0px !important;">
                                                            <!-- list item-->
                                                            <span>
                                                                <div class="single_spacing">
                                                                    <i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-bars" aria-hidden="true"></i>
                                                                    Single
                                                                </div>

                                                                <div class="double_spacing">
                                                                    <i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-bars" aria-hidden="true"></i>
                                                                    Double
                                                                </div>
                                                            </span>
                                                        </li>
                                                    </ul>

                                                </li>

                                                <!--div class="stop-noti-box">
                                                    <li class="sort_li">
                                                        <a href="#" data-target="#" title="Sort" class="dropdown-toggle waves-effect waves-light sort-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                          <i class="fa fa-long-arrow-down"></i><i class="fa fa-long-arrow-up"></i> Sort <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-lg sort_ul">
                                                            <li class="text-center notifi-title">Sort by
                                                                <input type="hidden" class="form-control" id="sort_count" value="0">
                                                            </li>
                                                            <li class="list-group">
                                                                <div class="row  sort_list_group">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-11">
                                                                        <span class="add_new_sort pull-right"><i class="fa fa-plus"></i>&nbsp;Add new sort</span>
                                                                    </div>
                                                                    <div class="col-md-1"></div>
                                                                </div>
                                                                 
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </div-->

                                                <div class="stop-noti-box" style="display:none">
                                                    <li class="hide_li">
                                                        <a href="#" data-target="#" title="Sort" class="dropdown-toggle waves-effect waves-light sort-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-eye-slash"></i> Hide <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-lg hide_ul">
                                                            <li class="text-center notifi-title">Hide</li>
                                                            <li class="list-group">
                                                                <div class="col-md-12">
                                                                    <div class="row list_field_div hide_list_group"></div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-3" style="z-index:99">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form action="export_excel_student_demographic" method="post">
                                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                    <input type="hidden" class="form-control selected_Ethnicity" name="Ethnicity" value="<?= $selected_Ethnicity ?>">
                                                    <input type="hidden" class="form-control selected_citizenship" name="citizenship" value="<?= $selected_citizenship ?>">
                                                    <input type="hidden" class="form-control selected_Country" name="Country" value="<?= $selected_Country ?>">
                                                    <input type="hidden" class="form-control selected_Sex" name="Sex" value="<?= $selected_Sex ?>">
                                                    <input type="hidden" class="form-control selected_enroll_certificate" name="enroll_certificate" value="<?= $selected_enroll_certificate ?>">
                                                    <input type="hidden" class="form-control selected_master_program" name="master_program" value="<?= $selected_master_program ?>">
                                                    <input type="hidden" class="form-control selected_graduation_from" value="<?= $selected_graduation_from ?>" name="graduation_from">
                                                    <input type="hidden" class="form-control selected_graduation_to" value="<?= $selected_graduation_to ?>" name="graduation_to">
                                                    <input type="hidden" class="form-control selected_not_graduation_from" value="<?= $selected_not_graduation_from ?>" name="not_graduation_from">
                                                    <input type="hidden" class="form-control selected_not_graduation_to" value="<?= $selected_not_graduation_to ?>" name="not_graduation_to">
                                                    <input type="hidden" class="form-control selected_graduate_state" value="<?= $selected_graduate_state ?>" name="graduate_state">
                                                    <input type="hidden" class="form-control selected_withdrawn" value="<?= $selected_withdrawn ?>" name="withdrawn">
                                                    <input type="hidden" class="form-control selected_start_date_from" value="<?= $start_date_from ?>" name="start_date_from">
                                                    <input type="hidden" class="form-control selected_start_date_to" value="<?= $start_date_to ?>" name="start_date_to">
                                                    <input type="hidden" class="form-control selected_special_program" value="<?= $selected_special_program ?>" name="special_program_excel">
                                                    <input type="hidden" class="form-control selected_program" value="<?= $selected_program ?>" name="program">
                                                    <input type="hidden" class="form-control selected_track" name="track_excel">

                                                    <input type="submit" class="btn btn-primary custum_buttom btn-xs pull-right" value="Export Excel">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                            <!-- End Filter row -->
                            <div class="col-md-12">
                                <div class="row content_div" id="result">
                                    <?php echo view('templates/filter/filter_student_demographic_report', isset($data) ? $data : []);
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> <!-- End Row -->
        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content-page -->











<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        })


        $('#alldataTable1').DataTable({
            // "order": [[ 0, "ASC" ]],
            "pageLength": 25,
            dom: 'Bfrtip',
            responsive: true,
            buttons: [{
                extend: 'colvis',
                columns: ':not(".select-disabled")'
            }],
            "ordering": false,
            scrollX: true,
            scrollCollapse: true,
            fixedColumns: {
                leftColumns: 3
            },
        });
        $('.buttons-colvis').html('<a href="#" class="waves-effect waves-light sort-btn-box filter-btn-box"><i class="fa fa-eye-slash"></i> Hide  <i class="fa fa-angle-down" aria-hidden="true"></i></a>');


    });

    $(document).on('change', '.graduate_state', function() {
        var data = $(this).val();
        if (data == 'No') {
            $('#graduation_from').css('pointer-events', 'none');
            $('#graduation_to').css('pointer-events', 'none');
            $('.not_graduated_to_div').show();
            $('.not_graduated_from_div').show();
            $('.graduated_to_div').hide();
            $('.graduated_from_div').hide();
            $('#div_graduation_to').css('cursor', 'not-allowed');
            $('#div_graduation_from').css('cursor', 'not-allowed');
            $('#graduation_from').val('');
            $('#graduation_to').val('');

            $('.selected_graduation_from').val('');
            $('.selected_graduation_to').val('');
        } else {
            $('#div_graduation_to').css('cursor', 'allowed');
            $('#div_graduation_from').css('cursor', 'allowed');
            $('.not_graduated_to_div').hide();
            $('.not_graduated_from_div').hide();
            $('.graduated_to_div').show();
            $('.graduated_from_div').show();
            $('#graduation_from').css('pointer-events', '');
            $('#graduation_to').css('pointer-events', '');
            $('#not_graduation_from').val('');
            $('#not_graduation_to').val('');

            $('.selected_not_graduation_from').val('');
            $('.selected_not_graduation_to').val('');
        }

    })

    $(document).on('change', '#graduation_from', function() {
        var data = $(this).val();
        var current_year = "<?= date('Y') ?>";
        var content = '<option value="">Please Select</option>';
        for (var i = current_year; i >= data; i--) {
            content += '<option value="' + i + '">' + i + '</option>';
        }
        $('#graduation_to').html(content);
    })

    $(document).on('change', '#not_graduation_from', function() {
        var data = $(this).val();
        var current_year = "<?= date('Y') ?>";
        var content = '<option value="">Please Select</option>';
        for (var i = current_year; i >= data; i--) {
            content += '<option value="' + i + '">' + i + '</option>';
        }
        $('#not_graduation_to').html(content);
    })

    $(document).on('click', '.filter_data', function() {
        $('.filter_ajax').addClass('waiting_response');
        $('.top_maargin').addClass('waiting_curser');
        $('.top_maargin').attr('title', 'waiting response');
        //$('.chosen-choices').css('pointer-events','none');
        $('.chosen-choices').addClass('waiting_response');
        $('.chosen-container-multi').addClass('waiting_curser');
        $('.chosen-container-multi').attr('title', 'waiting response');
        filter_progress_loader();
    })

    $(document).on('change', '.filter_ajax', function() {
        var name = $(this).attr('name');
        name = name.replace('[', '');
        name = name.replace(']', '');
        var value = $(this).val();
        name = '.selected_' + name;
        $(name).val(value);
    })



    function form_submit_data() {
        var formname = '';
        formname = $("#filter");
        var formData = new FormData($('#filter')[0]);
        formData.append("submit", "filter");
        formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: '<?= base_url() ?>admin/Reports/filter_student_demographic_report',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('.filter_ajax').removeClass('waiting_response');
                $('.top_maargin').removeClass('waiting_curser');
                $('.top_maargin').removeAttr('title');

                $('.chosen-choices').removeClass('waiting_response');
                $('.chosen-container-multi').removeClass('waiting_curser');
                $('.chosen-container-multi').removeAttr('title', 'waiting response');


                $('#result').html(response);
                $('.datatable_th').DataTable({
                    // "order": [[ 0, "ASC" ]],\
                    dom: 'Bfrtip',

                    "lengthMenu": [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"]
                    ],
                    "pageLength": 50,
                    responsive: true,
                    buttons: [{
                            extend: 'colvis',
                            columns: ':not(".select-disabled")'
                        },
                        /*{
                            extend:'pageLength'
                        }*/
                    ],

                    "ordering": false,
                    scrollX: true,
                    scrollCollapse: true,
                    fixedColumns: {
                        leftColumns: 3
                    },

                });
                $('.buttons-colvis').html('<a href="#" class="waves-effect waves-light sort-btn-box filter-btn-box"><i class="fa fa-eye-slash"></i> Hide  <i class="fa fa-angle-down" aria-hidden="true"></i></a>');
                $('input[name="selected_field[]"]:not(:checked)').each(function() {
                    var column_no = $(this).attr('rel_column_no');
                    var table = $('.datatable_th').DataTable();
                    var column = table.column(column_no);
                    // Toggle the visibility
                    column.visible(!column.visible());
                });


            }
        });
    }

    $(document).on('click', '.day', function(e) {
        e.stopPropagation();
    })

    $(document).on('click', '.custom-btn', function() {
            alert("Hello");
        })

        ! function($) {

            "use strict"; // jshint ;_;

            if (typeof ko != 'undefined' && ko.bindingHandlers && !ko.bindingHandlers.multiselect) {
                ko.bindingHandlers.multiselect = {
                    init: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {},
                    update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
                        var ms = $(element).data('multiselect');
                        if (!ms) {
                            $(element).multiselect(ko.utils.unwrapObservable(valueAccessor()));
                        } else if (allBindingsAccessor().options && allBindingsAccessor().options().length !== ms.originalOptions.length) {
                            ms.updateOriginalOptions();
                            $(element).multiselect('rebuild');
                        }
                    }
                };
            }

            function Multiselect(select, options) {

                this.options = this.mergeOptions(options);
                this.$select = $(select);

                // Initialization.
                // We have to clone to create a new reference.
                this.originalOptions = this.$select.clone()[0].options;
                this.query = '';
                this.searchTimeout = null;

                this.options.multiple = this.$select.attr('multiple') == "multiple";
                this.options.onChange = $.proxy(this.options.onChange, this);

                // Build select all if enabled.
                this.buildContainer();
                this.buildButton();
                this.buildSelectAll();
                this.buildDropdown();
                this.buildDropdownOptions();
                this.buildFilter();
                this.updateButtonText();

                this.$select.hide().after(this.$container);
            };

            Multiselect.prototype = {

                // Default options.
                defaults: {
                    // Default text function will either print 'None selected' in case no
                    // option is selected, or a list of the selected options up to a length of 3 selected options.
                    // If more than 3 options are selected, the number of selected options is printed.
                    buttonText: function(options, select) {
                        if (options.length == 0) {
                            return this.nonSelectedText + ' <b class="caret"></b>';
                        } else {

                            if (options.length > 5) {
                                return options.length + ' ' + this.nSelectedText + ' <b class="caret"></b>';
                            } else {
                                var selected = '';
                                options.each(function() {
                                    var label = ($(this).attr('label') !== undefined) ? $(this).attr('label') : $(this).html();

                                    //Hack by Victor Valencia R.
                                    if ($(select).hasClass('multiselect-icon')) {
                                        var icon = $(this).data('icon');
                                        label = '<span class="glyphicon ' + icon + '"></span> ' + label;
                                    }

                                    selected += label + ', ';
                                });
                                return selected.substr(0, selected.length - 2) + ' <b class="caret"></b>';
                            }
                        }
                    },
                    // Like the buttonText option to update the title of the button.
                    buttonTitle: function(options, select) {

                        if (options.length == 0) {
                            return this.nonSelectedText;
                        } else {
                            var selected = '';
                            options.each(function() {
                                //selected += $(this).text() + ', ';
                                selected += $(this).val() + ', ';
                            });

                            var field_text = selected.split(",");

                            //ajax code
                            return selected.substr(0, selected.length - 2);
                        }
                    },
                    // Is triggered on change of the selected options.
                    onChange: function(option, checked) {

                    },
                    buttonClass: 'btn',
                    dropRight: false,
                    selectedClass: 'active',
                    buttonWidth: '100%',
                    buttonContainer: '<div class="btn-group custom-btn" />',
                    // Maximum height of the dropdown menu.
                    // If maximum height is exceeded a scrollbar will be displayed.
                    maxHeight: false,
                    includeSelectAllOption: false,
                    selectAllText: ' Select all',
                    selectAllValue: 'multiselect-all',
                    enableFiltering: false,
                    enableCaseInsensitiveFiltering: false,
                    filterPlaceholder: 'Search',
                    // possible options: 'text', 'value', 'both'
                    filterBehavior: 'text',
                    preventInputChangeEvent: false,
                    nonSelectedText: 'None selected',
                    nSelectedText: 'selected'
                },

                // Templates.
                templates: {
                    button: '<button type="button" class="multiselect dropdown-toggle form-control" data-toggle="dropdown"></button>',
                    ul: '<ul class="multiselect-container dropdown-menu custom-multi"></ul>',
                    filter: '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text"></div>',
                    li: '<li><a href="javascript:void(0);"><label></label></a></li>',
                    liGroup: '<li><label class="multiselect-group"></label></li>'
                },

                constructor: Multiselect,

                buildContainer: function() {
                    this.$container = $(this.options.buttonContainer);
                },

                buildButton: function() {
                    // Build button.
                    this.$button = $(this.templates.button).addClass(this.options.buttonClass);

                    // Adopt active state.
                    if (this.$select.prop('disabled')) {
                        this.disable();
                    } else {
                        this.enable();
                    }

                    // Manually add button width if set.
                    if (this.options.buttonWidth) {
                        this.$button.css({
                            'width': this.options.buttonWidth
                        });
                    }

                    // Keep the tab index from the select.
                    var tabindex = this.$select.attr('tabindex');
                    if (tabindex) {
                        this.$button.attr('tabindex', tabindex);
                    }

                    this.$container.prepend(this.$button)
                },

                // Build dropdown container ul.
                buildDropdown: function() {

                    // Build ul.
                    this.$ul = $(this.templates.ul);

                    if (this.options.dropRight) {
                        this.$ul.addClass('pull-right');
                    }

                    // Set max height of dropdown menu to activate auto scrollbar.
                    if (this.options.maxHeight) {
                        // TODO: Add a class for this option to move the css declarations.
                        this.$ul.css({
                            'max-height': this.options.maxHeight + 'px',
                            'overflow-y': 'auto',
                            'overflow-x': 'hidden'
                        });
                    }

                    this.$container.append(this.$ul)
                },

                // Build the dropdown and bind event handling.
                buildDropdownOptions: function() {

                    this.$select.children().each($.proxy(function(index, element) {
                        // Support optgroups and options without a group simultaneously.
                        var tag = $(element).prop('tagName').toLowerCase();
                        if (tag == 'optgroup') {
                            this.createOptgroup(element);
                        } else if (tag == 'option') {
                            this.createOptionValue(element);
                        }
                        // Other illegal tags will be ignored.
                    }, this));

                    // Bind the change event on the dropdown elements.
                    $('li input', this.$ul).on('change', $.proxy(function(event) {
                        var checked = $(event.target).prop('checked') || false;
                        var isSelectAllOption = $(event.target).val() == this.options.selectAllValue;

                        // Apply or unapply the configured selected class.
                        if (this.options.selectedClass) {
                            if (checked) {
                                $(event.target).parents('li').addClass(this.options.selectedClass);
                            } else {
                                $(event.target).parents('li').removeClass(this.options.selectedClass);
                            }
                        }

                        // Get the corresponding option.
                        var value = $(event.target).val();
                        var $option = this.getOptionByValue(value);

                        var $optionsNotThis = $('option', this.$select).not($option);
                        var $checkboxesNotThis = $('input', this.$container).not($(event.target));

                        // Toggle all options if the select all option was changed.
                        if (isSelectAllOption) {
                            $checkboxesNotThis.filter(function() {
                                return $(this).is(':checked') != checked;
                            }).trigger('click');
                        }

                        if (checked) {
                            $option.prop('selected', true);

                            if (this.options.multiple) {
                                // Simply select additional option.
                                $option.prop('selected', true);
                            } else {
                                // Unselect all other options and corresponding checkboxes.
                                if (this.options.selectedClass) {
                                    $($checkboxesNotThis).parents('li').removeClass(this.options.selectedClass);
                                }

                                $($checkboxesNotThis).prop('checked', false);
                                $optionsNotThis.prop('selected', false);

                                // It's a single selection, so close.
                                this.$button.click();
                            }

                            if (this.options.selectedClass == "active") {
                                $optionsNotThis.parents("a").css("outline", "");
                            }
                        } else {
                            // Unselect option.
                            $option.prop('selected', false);
                        }

                        this.updateButtonText();
                        this.$select.change();
                        this.options.onChange($option, checked);

                        if (this.options.preventInputChangeEvent) {
                            return false;
                        }
                    }, this));

                    $('li a', this.$ul).on('touchstart click', function(event) {
                        event.stopPropagation();
                        $(event.target).blur();
                    });

                    // Keyboard support.
                    this.$container.on('keydown', $.proxy(function(event) {
                        if ($('input[type="text"]', this.$container).is(':focus')) {
                            return;
                        }
                        if ((event.keyCode == 9 || event.keyCode == 27) && this.$container.hasClass('open')) {
                            // Close on tab or escape.
                            this.$button.click();
                        } else {
                            var $items = $(this.$container).find("li:not(.divider):visible a");

                            if (!$items.length) {
                                return;
                            }

                            var index = $items.index($items.filter(':focus'));

                            // Navigation up.
                            if (event.keyCode == 38 && index > 0) {
                                index--;
                            }
                            // Navigate down.
                            else if (event.keyCode == 40 && index < $items.length - 1) {
                                index++;
                            } else if (!~index) {
                                index = 0;
                            }

                            var $current = $items.eq(index);
                            $current.focus();

                            if (event.keyCode == 32 || event.keyCode == 13) {
                                var $checkbox = $current.find('input');

                                $checkbox.prop("checked", !$checkbox.prop("checked"));
                                $checkbox.change();
                            }

                            event.stopPropagation();
                            event.preventDefault();
                        }
                    }, this));
                },

                // Will build an dropdown element for the given option.
                createOptionValue: function(element) {
                    if ($(element).is(':selected')) {
                        $(element).prop('selected', true);
                    }

                    // Support the label attribute on options.
                    var label = $(element).attr('label') || $(element).html();
                    var value = $(element).val();

                    //Hack by Victor Valencia R.            
                    if ($(element).parent().hasClass('multiselect-icon') || $(element).parent().parent().hasClass('multiselect-icon')) {
                        var icon = $(element).data('icon');
                        label = '<span class="glyphicon ' + icon + '"></span> ' + label;
                    }

                    var inputType = this.options.multiple ? "checkbox" : "radio";

                    var $li = $(this.templates.li);
                    $('label', $li).addClass(inputType);
                    $('label', $li).append('<input type="' + inputType + '" />');

                    //Hack by Victor Valencia R.
                    if (($(element).parent().hasClass('multiselect-icon') || $(element).parent().parent().hasClass('multiselect-icon')) && inputType == 'radio') {
                        $('label', $li).css('padding-left', '0px');
                        $('label', $li).find('input').css('display', 'none');
                    }

                    var selected = $(element).prop('selected') || false;
                    var $checkbox = $('input', $li);
                    $checkbox.val(value);

                    if (value == this.options.selectAllValue) {
                        $checkbox.parent().parent().addClass('multiselect-all');
                    }

                    $('label', $li).append(" " + label);

                    this.$ul.append($li);

                    if ($(element).is(':disabled')) {
                        $checkbox.attr('disabled', 'disabled').prop('disabled', true).parents('li').addClass('disabled');
                    }

                    $checkbox.prop('checked', selected);

                    if (selected && this.options.selectedClass) {
                        $checkbox.parents('li').addClass(this.options.selectedClass);
                    }
                },

                // Create optgroup.
                createOptgroup: function(group) {
                    var groupName = $(group).prop('label');

                    // Add a header for the group.
                    var $li = $(this.templates.liGroup);
                    $('label', $li).text(groupName);

                    //Hack by Victor Valencia R.
                    $li.addClass('text-primary');

                    this.$ul.append($li);

                    // Add the options of the group.
                    $('option', group).each($.proxy(function(index, element) {
                        this.createOptionValue(element);
                    }, this));
                },

                // Add the select all option to the select.
                buildSelectAll: function() {
                    var alreadyHasSelectAll = this.$select[0][0] ? this.$select[0][0].value == this.options.selectAllValue : false;
                    // If options.includeSelectAllOption === true, add the include all checkbox.
                    if (this.options.includeSelectAllOption && this.options.multiple && !alreadyHasSelectAll) {
                        this.$select.prepend('<option value="' + this.options.selectAllValue + '">' + this.options.selectAllText + '</option>');
                    }
                },

                // Build and bind filter.
                buildFilter: function() {

                    // Build filter if filtering OR case insensitive filtering is enabled and the number of options exceeds (or equals) enableFilterLength.
                    if (this.options.enableFiltering || this.options.enableCaseInsensitiveFiltering) {
                        var enableFilterLength = Math.max(this.options.enableFiltering, this.options.enableCaseInsensitiveFiltering);
                        if (this.$select.find('option').length >= enableFilterLength) {

                            this.$filter = $(this.templates.filter);
                            $('input', this.$filter).attr('placeholder', this.options.filterPlaceholder);
                            this.$ul.prepend(this.$filter);

                            this.$filter.val(this.query).on('click', function(event) {
                                event.stopPropagation();
                            }).on('keydown', $.proxy(function(event) {
                                // This is useful to catch "keydown" events after the browser has updated the control.
                                clearTimeout(this.searchTimeout);

                                this.searchTimeout = this.asyncFunction($.proxy(function() {

                                    if (this.query != event.target.value) {
                                        this.query = event.target.value;

                                        $.each($('li', this.$ul), $.proxy(function(index, element) {
                                            var value = $('input', element).val();
                                            if (value != this.options.selectAllValue) {
                                                var text = $('label', element).text();
                                                var value = $('input', element).val();
                                                if (value && text && value != this.options.selectAllValue) {
                                                    // by default lets assume that element is not
                                                    // interesting for this search
                                                    var showElement = false;

                                                    var filterCandidate = '';
                                                    if ((this.options.filterBehavior == 'text' || this.options.filterBehavior == 'both')) {
                                                        filterCandidate = text;
                                                    }
                                                    if ((this.options.filterBehavior == 'value' || this.options.filterBehavior == 'both')) {
                                                        filterCandidate = value;
                                                    }

                                                    if (this.options.enableCaseInsensitiveFiltering && filterCandidate.toLowerCase().indexOf(this.query.toLowerCase()) > -1) {
                                                        showElement = true;
                                                    } else if (filterCandidate.indexOf(this.query) > -1) {
                                                        showElement = true;
                                                    }

                                                    if (showElement) {
                                                        $(element).show();
                                                    } else {
                                                        $(element).hide();
                                                    }
                                                }
                                            }
                                        }, this));
                                    }
                                }, this), 300, this);
                            }, this));
                        }
                    }
                },

                // Destroy - unbind - the plugin.
                destroy: function() {
                    this.$container.remove();
                    this.$select.show();
                },

                // Refreshs the checked options based on the current state of the select.
                refresh: function() {
                    $('option', this.$select).each($.proxy(function(index, element) {
                        var $input = $('li input', this.$ul).filter(function() {
                            return $(this).val() == $(element).val();
                        });

                        if ($(element).is(':selected')) {
                            $input.prop('checked', true);

                            if (this.options.selectedClass) {
                                $input.parents('li').addClass(this.options.selectedClass);
                            }
                        } else {
                            $input.prop('checked', false);

                            if (this.options.selectedClass) {
                                $input.parents('li').removeClass(this.options.selectedClass);
                            }
                        }

                        if ($(element).is(":disabled")) {
                            $input.attr('disabled', 'disabled').prop('disabled', true).parents('li').addClass('disabled');
                        } else {
                            $input.prop('disabled', false).parents('li').removeClass('disabled');
                        }
                    }, this));

                    this.updateButtonText();
                },

                // Select an option by its value or multiple options using an array of values.
                select: function(selectValues) {
                    if (selectValues && !$.isArray(selectValues)) {
                        selectValues = [selectValues];
                    }

                    for (var i = 0; i < selectValues.length; i++) {

                        var value = selectValues[i];

                        var $option = this.getOptionByValue(value);
                        var $checkbox = this.getInputByValue(value);

                        if (this.options.selectedClass) {
                            $checkbox.parents('li').addClass(this.options.selectedClass);
                        }

                        $checkbox.prop('checked', true);
                        $option.prop('selected', true);
                        this.options.onChange($option, true);
                    }

                    this.updateButtonText();
                },

                // Deselect an option by its value or using an array of values.
                deselect: function(deselectValues) {
                    if (deselectValues && !$.isArray(deselectValues)) {
                        deselectValues = [deselectValues];
                    }

                    for (var i = 0; i < deselectValues.length; i++) {

                        var value = deselectValues[i];

                        var $option = this.getOptionByValue(value);
                        var $checkbox = this.getInputByValue(value);

                        if (this.options.selectedClass) {
                            $checkbox.parents('li').removeClass(this.options.selectedClass);
                        }

                        $checkbox.prop('checked', false);
                        $option.prop('selected', false);
                        this.options.onChange($option, false);
                    }

                    this.updateButtonText();
                },

                // Rebuild the whole dropdown menu.
                rebuild: function() {
                    this.$ul.html('');

                    // Remove select all option in select.
                    $('option[value="' + this.options.selectAllValue + '"]', this.$select).remove();

                    // Important to distinguish between radios and checkboxes.
                    this.options.multiple = this.$select.attr('multiple') == "multiple";

                    this.buildSelectAll();
                    this.buildDropdownOptions();
                    this.updateButtonText();
                    this.buildFilter();
                },

                // Build select using the given data as options.
                dataprovider: function(dataprovider) {
                    var optionDOM = "";
                    dataprovider.forEach(function(option) {
                        optionDOM += '<option value="' + option.value + '">' + option.label + '</option>';
                    });

                    this.$select.html(optionDOM);
                    this.rebuild();
                },

                // Enable button.
                enable: function() {
                    this.$select.prop('disabled', false);
                    this.$button.prop('disabled', false)
                        .removeClass('disabled');
                },

                // Disable button.
                disable: function() {
                    this.$select.prop('disabled', true);
                    this.$button.prop('disabled', true)
                        .addClass('disabled');
                },

                // Set options.
                setOptions: function(options) {
                    this.options = this.mergeOptions(options);
                },

                // Get options by merging defaults and given options.
                mergeOptions: function(options) {
                    return $.extend({}, this.defaults, options);
                },

                // Update button text and button title.
                updateButtonText: function() {
                    var options = this.getSelected();

                    // First update the displayed button text.
                    $('button', this.$container).html(this.options.buttonText(options, this.$select));

                    // Now update the title attribute of the button.
                    $('button', this.$container).attr('title', this.options.buttonTitle(options, this.$select));

                },

                // Get all selected options.
                getSelected: function() {

                    return $('option[value!="' + this.options.selectAllValue + '"]:selected', this.$select).filter(function() {
                        return $(this).prop('selected');
                    });
                },

                // Get the corresponding option by ts value.
                getOptionByValue: function(value) {
                    return $('option', this.$select).filter(function() {
                        return $(this).val() == value;
                    });
                },

                // Get an input in the dropdown by its value.
                getInputByValue: function(value) {
                    return $('li input', this.$ul).filter(function() {
                        return $(this).val() == value;
                    });
                },

                updateOriginalOptions: function() {
                    this.originalOptions = this.$select.clone()[0].options;
                },

                asyncFunction: function(callback, timeout, self) {
                    var args = Array.prototype.slice.call(arguments, 3);
                    return setTimeout(function() {
                        callback.apply(self || window, args);
                    }, timeout);
                }
            };

            $.fn.multiselect = function(option, parameter) {
                return this.each(function() {
                    var data = $(this).data('multiselect'),
                        options = typeof option == 'object' && option;

                    // Initialize the multiselect.
                    if (!data) {
                        $(this).data('multiselect', (data = new Multiselect(this, options)));
                    }

                    // Call multiselect method.
                    if (typeof option == 'string') {
                        data[option](parameter);
                    }
                });
            };

            $.fn.multiselect.Constructor = Multiselect;

            // Automatically init selects by their data-role.
            $(function() {
                $("select[role='multiselect']").multiselect();
            });

        }(window.jQuery);
</script>