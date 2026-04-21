<?php //echo "<pre>";print_r($selectboxdisplay);die; 
//echo "<pre>"; print_r(session()->get());
?>
<style>
    .mobile-view-outter-box .nav.nav-tabs.tabs li a {
        font-weight: 600;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        width: auto;
    }

    .dataTables_info {
        display: none;
    }

    #classListing_filter {
        display: none;
    }

    .employeeleftsidebar {
        height: 330px;
        background-color: whitesmoke;
        padding-left: 10px;
        padding-top: 5px;
    }

    .travel-lable-custom {
        float: left;
        display: inline-block;
        width: 26%;
        padding-left: 25px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #333;
    }

    .travel-semicolon {
        float: left;
        display: inline-block;
        width: 4%;
    }

    .travel-content-box-text {
        float: left;
        display: inline-block;
        width: 47%;
    }

    .alert {
        padding: 5px;
        margin-bottom: 0px;
        border: 1px solid transparent;
        border-radius: 0px;
    }

    .requires {
        display: none;
    }

    .requiresval {
        color: red;
    }

    .col-sm-12 {
        padding: 5px;
    }

    #sidebar-menu>ul>li>a {
        cursor: pointer;
    }

    .tab #sidebar-menu>ul>li>a:hover {
        background: #f5f5f5;
        color: #337ab7;
    }

    .tab .col-sm-12 {
        padding: 5px;
    }

    .tab #sidebar-menu>ul>li>a.active,
    #sidebar-menu>ul>li>a.active.subdrop {
        width: 205px;
        margin-left: -20px;
    }

    .tab #sidebar-menu>ul>li>a {
        margin-left: -20px;
    }

    .input-group-addon {
        padding: 1px 9px;
        font-size: 14px;
        font-weight: 400;
        line-height: 1;
        color: #555;
        text-align: center;
        background-color: #eee;
        border: 1px solid #ccc;
        border-radius: 0px;
    }

    #sidebar-menu>ul>li>a.active,
    #sidebar-menu>ul>li>a.active.subdrop {
        background: #d2d1d1 !important;
    }

    /*.tab {
	float: left;
	background-color: #f5f5f5;
	width: 100%;
	height: 300px;
	margin-top: 10px;
}*/

    /* Style the buttons inside the tab */
    .tab button {
        display: block;
        background-color: inherit;
        color: black;
        padding: 5px 8px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.3s;
        font-size: 17px;
        border-bottom: 1px solid #ccc;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current "tab button" class */
    .tab a.active {
        background-color: #d2d1d1;
    }

    /* Style the tab content */
    .tabcontent {
        float: left;
        padding: 0px 12px;
        border: 0px solid #ccc;
        width: 100%;
        border-left: none;
        height: auto;
    }

    .container {
        margin-top: 0px;
    }

    .page {
        display: none;
    }

    .page-active {
        display: block;
    }

    .container .jumbotron,
    .container-fluid .jumbotron {
        padding-right: 0px;
        padding-left: 0px;
        background-color: white;
    }

    .jumbotron {
        padding-top: 0px;
        padding-bottom: 0px;
        margin-bottom: 0px;
    }

    .padding_bottom {
        position: relative;
        top: 10px;
    }

    .jumbotron .col-sm-12 {
        padding: 5px !important;
    }

    .pagination .first {
        display: none;
    }

    .pagination .last {
        display: none;
    }

    .pagination-lg>li>a,
    .pagination-lg>li>span {
        padding: 5px 5px;
        font-size: 12px;
        line-height: 1.3333333;
    }

    .custom-tab-information {
        float: left;
        margin-left: 10px;
        width: 85%;
    }

    /*.table{
    margin-left:10px;
}*/

    #Contracts_Data .content-page>.content {
        margin-top: 0px !important;
    }

    #Contracts_Data .btn {
        padding: 7px 14px;
    }

    #TimeSheet .content-page>.content {
        margin-top: 0px !important;
    }

    #TimeSheet .container,
    #Contracts_Data .container,
    #Time_Categories .container {
        padding: 0px !important;
    }

    #Time_Categories .content-page>.content {
        margin-top: 0px !important;
    }


    @media only screen and (max-width: 600px) {
        .travel-lable-custom {
            float: left;
            display: inline-block;
            width: 100%;
            padding-left: 25px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #333;
        }

        .travel-semicolon {
            float: left;
            display: inline-block;
            width: 100%;
        }

        .travel-content-box-text {
            float: left;
            display: inline-block;
            width: 100%;
        }
    }

    .invalid {
        background-color: #ff9494 ! important;
    }

    #addnewsemployment {
        display: none;
    }
</style>

<?php if (!empty($facultystaffid)) { ?>
    <style>
        #employeementdatadetailsform {
            display: block;
        }
    </style>

<?php } else { ?>
    <style>
        #employeementdatadetailsform {
            display: none;
        }
    </style>
<?php } ?>

<!--<script type="text/javascript" src="https://www.solodev.com/assets/pagination/jquery.twbsPagination.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container12">
            <div class="row">


                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info panel-color">

                            <div class="panel-heading">
                                <h3 class="panel-title">&nbsp;
                                    <div class="col-sm-2"> Faculty/Staff</div>
                                    <div class="col-sm-4">

                                        <?php
                                        $attr = array("name" => "employment", "id" => "employment");
                                        echo form_open_multipart('admin/Reports/getemploymentListingDetails', $attr);
                                        ?>
                                        <select class="form-control requiredfile2" id="facultyEmployeeID" required name="facultyEmployeeID" onchange="submitform(this.value);">
                                            <option value="">Select</option>
                                            <?php
                                            if (!empty($facultystaffid)) {
                                                $facultyid = $facultystaffid;
                                            } else {
                                                $facultyid = '';
                                            }
                                            if (!empty($facultystaf)) {
                                                foreach ($facultystaf as $cl) {

                                            ?>
                                                    <option value="<?= $cl['ID'] ?>" <?php if ($facultyid == $cl['ID']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $cl['FirstName'];
                                                                                                echo '&nbsp;';
                                                                                                echo $cl['LastName'];
                                                                                                echo '-';
                                                                                                echo $cl['ID']; ?></option>
                                            <?php }
                                            } ?>

                                        </select>
                                    </div>
                                    <?php echo form_close(); ?>
                                    <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                        <i class="ion-arrow-left-a"></i>
                                        <span><strong>Go Back</strong></span>
                                    </a>
                                    <?php
                                    if (!empty($result)) { ?>
                                        <a href="javascript:void(0);" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right hide" id="addnewsemployment">
                                            <i class="icon ion-plus-circled"></i>
                                            <span><strong>Add New</strong></span>
                                            <a href="javascript:void(0);" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right hide" id="viewemploymentdetailsemployment">
                                                <i class="icon ion-plus-circled"></i>
                                                <span><strong>View Details</strong></span>
                                            </a>
                                        </a>
                                    <?php } ?>

                                </h3>
                            </div>
                            <div class="panel-body">
                            </div>
                        </div>

                    </div> <!-- End Row -->
                </div> <!-- container -->
                <div class="employeementdatadetailsform" id="employeementdatadetailsform">

                    <div class="row">

                        <div class="col-md-2" style="display:none;">
                            <div class="employeeleftsidebar">
                                <div class="facultyimg">
                                    <?php
                                    //echo '<pre>'; print_r($facultystafdetails); die;
                                    if (!empty($facultyprofileimage)) {
                                        if ($facultyprofileimage[0]['profile_image'] != '') {
                                            $img_path = $facultyprofileimage[0]['profile_image'];
                                        } else {
                                            $img_path = 'docs/profile/user-profile-default.png';
                                        }
                                    } else {
                                        $img_path = 'docs/profile/user-profile-default.png';
                                    }
                                    ?>

                                    <img src="<?php echo base_url($img_path); ?>" style="width:135px;">
                                    <p style="padding:5px; color:#8d92ab;"><?php echo (isset($facultystafdetails[0]['FirstName']) ? $facultystafdetails[0]['FirstName'] : '');
                                                                            echo '&nbsp;';
                                                                            echo (isset($facultystafdetails[0]['FirstName']) ? $facultystafdetails[0]['LastName'] : ''); ?></p>


                                </div>
                                <div class="facultytabs">
                                    <div class="tab">

                                        <div id="sidebar-menu" style="background-color:#f5f5f5 !important;">
                                            <ul>
                                                <li><a class="tablinks" onclick="openCity(event, 'Overview')" id="defaultOpen"><span> Overview</span></a></li>
                                                <li><?php if (!empty($facultystafdetails[0]['ID'])): ?>
                                                        <a href="<?= base_url('admin/Form/ViewApp/' . $facultystafdetails[0]['ID']) ?>" target="_blank">Contact</a>
                                                    <?php else: ?>
                                                        <span>No Contact Info</span>
                                                    <?php endif; ?>
                                                </li>
                                                <!--li><a class="tablinks active" onclick="openCity(event, 'Employment')"><span> Employment</span></a></li-->

                                                <!-- <li><a class="tablinks" onclick="openCity(event, 'Document')"><span>Document</span></a></li>	 -->
                                                <li><a class="tablinks" onclick="openCity(event, 'TimeSheet')"><span>TimeSheet</span></a></li>

                                                <!-- By Prabhat -->
                                                <li><a class="tablinks" onclick="openCity(event, 'Employee_File')"><span>Documents</span></a></li>
                                                <li><a class="tablinks" onclick="openCity(event, 'Employee_Data')"><span>Employee Data</span></a></li>
                                                <li><a class="tablinks" onclick="openCity(event, 'Contracts_Data')" id="contract_tab"><span>Contracts</span></a></li>
                                                <li><a class="tablinks" onclick="openCity(event, 'Time_Categories')"><span>Time Categories</span></a></li>

                                                <!-- End Prabhat -->
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>

                                    </div>


                                </div>


                            </div>


                        </div>

                        <style>
                            .tabs li.tab {
                                width: 14.28% !important;
                            }
                        </style>



                        <div class="col-md-12">
                            <div class="panel panel-info panel-color">

                                <div class="panel-body">
                                    <div class="row" style="margin-right: -14px;margin-left: -14px;margin-top: -5px;">
                                        <div class="form-group mobile-view-outter-box">
                                            <ul class="nav nav-tabs tabs">

                                                <li class="tab <?= isset($count) == 1 ? 'active' : '' ?>" style="width:7.6% ! important;" onclick="openCurrentTab(event, 'Overview')">
                                                    <a href="#tab1" data-toggle="tab" aria-expanded="false" class="">
                                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                        <span class="hidden-xs"><?= str_replace(array(' '), ' ', 'Overview') ?></span>
                                                    </a>
                                                </li>
                                                <?php if (!empty($facultystafdetails)) : ?>
                                                    <?php $contact_url = base_url('admin/Form/ViewApp/' . $facultystafdetails[0]['ID']); ?>
                                                    <a href="<?= $contact_url ?>">View</a>

                                                <li class="tab <?= isset($count) == 1 ? 'active' : '' ?>" style="width:7.6% ! important;" onclick="openNewTab('<?= $contact_url ?>')">
                                                    <a href="#tab2" data-toggle="tab" aria-expanded="false" class="">
                                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                        <span class="hidden-xs"><?= str_replace(array(' '), ' ', 'Contact') ?></span>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <li class="tab <?= isset($count) == 1 ? 'active' : '' ?>" style="width:7.6% ! important;" onclick="openCurrentTab(event, 'TimeSheet')">
                                                    <a href="#tab3" data-toggle="tab" aria-expanded="false" class="">
                                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                        <span class="hidden-xs"><?= str_replace(array(' '), ' ', 'Timesheet') ?></span>
                                                    </a>
                                                </li>

                                                <li class="tab <?= isset($count) == 1 ? 'active' : '' ?>" style="width:7.6% ! important;" onclick="openCurrentTab(event, 'Employee_File')">
                                                    <a href="#tab4" data-toggle="tab" aria-expanded="false" class="">
                                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                        <span class="hidden-xs"><?= str_replace(array(' '), ' ', 'Documents') ?></span>
                                                    </a>
                                                </li>

                                                <li class="tab <?= isset($count) == 1 ? 'active' : '' ?>" style="width:7.6% ! important;" onclick="openCurrentTab(event, 'Employee_Data')">
                                                    <a href="#tab5" data-toggle="tab" aria-expanded="false" class="">
                                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                        <span class="hidden-xs"><?= str_replace(array(' '), ' ', 'Employee Data') ?></span>
                                                    </a>
                                                </li>

                                                <li class="tab <?= isset($count) == 1 ? 'active' : '' ?>" style="width:7.6% ! important;" onclick="openCurrentTab(event, 'Contracts_Data')">
                                                    <a href="#tab6" data-toggle="tab" aria-expanded="false" class="">
                                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                        <span class="hidden-xs"><?= str_replace(array(' '), ' ', 'Contracts') ?></span>
                                                    </a>
                                                </li>


                                                <li class="tab <?= isset($count) == 1 ? 'active' : '' ?>" style="width:7.6% ! important;" onclick="openCurrentTab(event, 'Time_Categories')">
                                                    <a href="#tab8" data-toggle="tab" aria-expanded="false" class="">
                                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                        <span class="hidden-xs"><?= str_replace(array(' '), ' ', 'Time Categories') ?></span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                    <div id="Overview" class="tabcontent">

                                        <?php echo view('backend/overviewEmployeedata', $data); ?>
                                        <!--img src="<?php echo base_url('docs/misc/general.png'); ?>" style="width:100%;"-->
                                    </div>
                                    <div id="Document" class="tabcontent">
                                        <h3>Document Sample</h3>
                                        <img src="<?php echo base_url('docs/misc/documents.png'); ?>" style="width:100%;">
                                    </div>
                                    <!-- By PRabhat -->
                                    <div id="Employee_File" class="tabcontent">
                                        <h3 class="panel-title" style="padding-left:10px">Employee File</h3>
                                        <?php echo view('templates/forms/another_employee_record',  isset($employmentrecord) ? $employmentrecord : []); ?>
                                    </div>
                                    <!-- End Prabhat -->
                                    <div id="TimeSheet" class="tabcontent">
                                        <?php echo view('backend/another_view_contract_transaction'); ?>
                                    </div>
                                    <div id="Employment" class="tabcontent">
                                        <?php if (!empty($result)) { ?>
                                            <div class="container" id="employementrecord">
                                                <?php
                                                $counter = 0;
                                                //echo '<pre>'; print_r($result);
                                                foreach ($result as $resultval) {
                                                    $counter++;
                                                ?>

                                                    <div class="jumbotron page" id="page<?php echo $counter; ?>">
                                                        <p id="successmsgupdate-<?php echo $counter; ?>" style="color:green; display:none;">Employment Data Updated Successfully</p>
                                                        <p id="successmsgdelete-<?php echo $counter; ?>" style="color:green; display:none;">Employment Data Deleted Successfully</p>

                                                        <div style="float:right;margin-top: 5px;">
                                                            <h3 class="panel-title"> <button id="general_edit" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                                    <span><strong>Edit</strong></span></button>
                                                            </h3>

                                                            <h3 class="panel-title"> <button id="general_view" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right hide"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                                    <span><strong>View</strong></span></button>
                                                            </h3>
                                                        </div>
                                                        <div class="clearfix" style="float:right">
                                                            <div class="col-sm-12">
                                                                <button type="submit" id="address_save" style="float: left;margin-left: 5px; display:none;" name="submit" onclick="employmentListingDataUpdate(<?php echo $counter; ?>)" value="address" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right hide address_save">Save</button>

                                                                <button type="submit" id="removeButtonRD" style="float: left;margin-left: 5px; display:none;" name="submit" onclick="employmentListingDataDelete(<?php echo $counter; ?>)" value="address" class="btn btn-danger waves-effect waves-light m-b-5 m-l-5  pull-right hide address_save"><i class="fa fa-trash"></i> Delete</button>
                                                            </div>
                                                        </div>

                                                        <?php
                                                        $attr = array("name" => "employmentformsupdate", "id" => "employmentformsupdate-$counter");
                                                        echo form_open_multipart('admin/Reports/employmentListingUpdate', $attr);
                                                        ?>
                                                        <div class="container">
                                                            <input type="hidden" name="facultyEmployeeID" id="facultyEmployeeID" value="<?php if (isset($resultval['name_id'])) {
                                                                                                                                            echo $resultval['name_id'];
                                                                                                                                        } ?>">
                                                            <input type="hidden" name="EmploymentDataID" id="EmploymentDataID" value="<?php if (isset($resultval['name_id'])) {
                                                                                                                                            echo $resultval['id'];
                                                                                                                                        } ?>">

                                                            <div class="col-sm-12 col-sm-12 col-xs-12">
                                                                <div class="alert alert-info">
                                                                    Contract information
                                                                </div>

                                                            </div>
                                                            <div class="col-sm-12 col-sm-12 col-xs-12">
                                                                <div class="col-sm-6 col-sm-6 col-xs-6">
                                                                    <div class="col-sm-12 padding_bottom">

                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Title<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show">
                                                                                    <?php
                                                                                    if (isset($resultval['Title'])) {
                                                                                        echo $resultval['Title'];
                                                                                    }
                                                                                    ?>
                                                                                </span>
                                                                                <input class="form-control hide requiredfile2 name_validation" id="Title" placeholder="Title" name="Title" type="text" value="<?php
                                                                                                                                                                                                                if (isset($resultval['Title'])) {
                                                                                                                                                                                                                    echo $resultval['Title'];
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>">
                                                                            </div>
                                                                        </div>

                                                                    </div>


                                                                </div>
                                                                <div class="col-sm-6 col-sm-6 col-xs-6">

                                                                    <div class="col-sm-12 padding_bottom">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Organization<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['Organization'])) {
                                                                                                        echo $resultval['Organization'];
                                                                                                    } ?></span>


                                                                                <select name="Organization" id="Organization-<?php echo $counter; ?>" class="form-control hide requiredfile2">
                                                                                    <option value="">----- Please Select -----</option>
                                                                                    <option value="EDU" <?php if ($resultval['Organization'] == 'EDU') {
                                                                                                            echo 'selected';
                                                                                                        } ?>>EDU</option>
                                                                                    <option value="ORG" <?php if ($resultval['Organization'] == 'ORG') {
                                                                                                            echo 'selected';
                                                                                                        } ?>>ORG</option>
                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="col-sm-12 col-sm-12 col-xs-12">
                                                                <div class="col-sm-6 col-sm-6 col-xs-6">

                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Begin Date<span class="requiresval">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show">
                                                                                    <?php
                                                                                    if ($resultval['BeginDate'] != '0000-00-00 00:00:00') {
                                                                                        echo date('m-d-Y', strtotime($resultval['BeginDate']));
                                                                                    }
                                                                                    ?>
                                                                                </span>
                                                                                <div class="hide">
                                                                                    <div class="input-group date" data-provide="datepicker">
                                                                                        <input class="form-control datepickerbackward requiredfile2 requiredfield" id="BeginDate-<?php echo $counter; ?>" placeholder="Begin Date" name="BeginDate" type="text" value="<?php
                                                                                                                                                                                                                                                                        if ($resultval['BeginDate'] != '0000-00-00 00:00:00') {
                                                                                                                                                                                                                                                                            echo date('m-d-Y', strtotime($resultval['BeginDate']));
                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                        ?>">
                                                                                        <div class="input-group-addon">
                                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>



                                                                            </div>
                                                                        </div>
                                                                    </div>




                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Days<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['Days'])) {
                                                                                                        echo $resultval['Days'];
                                                                                                    } ?></span>
                                                                                <input class="form-control hide requiredfile2" id="Daysdetails-<?php echo $counter; ?>" placeholder="Days" onkeypress="return onlyNumbers();" onchange="employmenthoursdetails(this.value,<?php echo $counter; ?>);" name="Days" type="text" value="<?php if (isset($resultval['Days'])) {
                                                                                                                                                                                                                                                                                                                                        echo $resultval['Days'];
                                                                                                                                                                                                                                                                                                                                    } ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>




                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Full/Part <span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['Full_Part'])) {
                                                                                                        echo $resultval['Full_Part'];
                                                                                                    } ?></span>
                                                                                <select name="FullPart" id="FullPart" class="form-control hide requiredfile2">
                                                                                    <option value="">----- Please Select -----</option>
                                                                                    <option value="Full" <?php if ($resultval['Full_Part'] == 'Full') {
                                                                                                                echo 'selected';
                                                                                                            } ?>>Full Time</option>
                                                                                    <option value="Part" <?php if ($resultval['Full_Part'] == 'Part') {
                                                                                                                echo 'selected';
                                                                                                            } ?>>Part Time</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Hours<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['Hours'])) {
                                                                                                        echo $resultval['Hours'];
                                                                                                    } ?></span>
                                                                                <input class="form-control hide requiredfile2" id="Hoursdetails-<?php echo $counter; ?>" placeholder="Hours" readonly name="Hours" type="text" value="<?php if (isset($resultval['Hours'])) {
                                                                                                                                                                                                                                            echo $resultval['Hours'];
                                                                                                                                                                                                                                        } ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>






                                                                </div>

                                                                <div class="col-sm-6 col-sm-6 col-xs-6">


                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">End Date<span class="requiresval">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if ($resultval['EndDate'] != '0000-00-00 00:00:00') {
                                                                                                        echo date('m-d-Y', strtotime($resultval['EndDate']));
                                                                                                    } ?></span>
                                                                                <div class="hide">
                                                                                    <div class="input-group date" data-provide="datepicker">
                                                                                        <input class="form-control datepickerbackward hide requiredfile2 requiredfield" id="EndDate-<?php echo $counter; ?>" onchange="enddatedetails(this.value,<?php echo $counter; ?>);" placeholder="End Date" name="EndDate" type="text" value="<?php if ($resultval['EndDate'] != '0000-00-00 00:00:00') {
                                                                                                                                                                                                                                                                                                                                            echo date('m-d-Y', strtotime($resultval['EndDate']));
                                                                                                                                                                                                                                                                                                                                        } ?>">
                                                                                        <div class="input-group-addon">
                                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>






                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Daily Rate($)<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['DailyRate'])) {
                                                                                                        echo $resultval['DailyRate'];
                                                                                                    } ?></span>
                                                                                <input class="form-control hide requiredfile2" id="DailyRatedetails-<?php echo $counter; ?>" placeholder="Daily Rate" onchange="employmentdailyratedetails('',this.value,<?php echo $counter; ?>);" name="DailyRate" type="text" value="<?php if (isset($resultval['DailyRate'])) {
                                                                                                                                                                                                                                                                                                                            echo $resultval['DailyRate'];
                                                                                                                                                                                                                                                                                                                        } ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Salary / Hourly<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['Salary_Hourly'])) {
                                                                                                        echo $resultval['Salary_Hourly'];
                                                                                                    } ?></span>

                                                                                <select name="SalaryHourly" id="SalaryHourly" class="form-control hide requiredfile2">
                                                                                    <option value="">----- Please Select -----</option>
                                                                                    <option value="Salary" <?php if ($resultval['Salary_Hourly'] == 'Salary') {
                                                                                                                echo 'selected';
                                                                                                            } ?>>Salary</option>
                                                                                    <option value="Hourly" <?php if ($resultval['Salary_Hourly'] == 'Hourly') {
                                                                                                                echo 'selected';
                                                                                                            } ?>>Hourly</option>
                                                                                </select>


                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Compensation<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['Compensation'])) {
                                                                                                        echo $resultval['Compensation'];
                                                                                                    } ?></span>
                                                                                <input class="form-control hide requiredfile2" id="Compensationdetails-<?php echo $counter; ?>" placeholder="Compensation" readonly name="Compensation" type="text" value="<?php if (isset($resultval['Compensation'])) {
                                                                                                                                                                                                                                                                echo $resultval['Compensation'];
                                                                                                                                                                                                                                                            } ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>

                                                            </div>
                                                            <div class="col-sm-12 col-sm-12 col-xs-12">
                                                                <div class="alert alert-info">
                                                                    Mediacal information
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-sm-12 col-xs-12">
                                                                <div class="col-sm-6 col-sm-6 col-xs-6">

                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Health Insurance<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['Health_Insurance'])) {
                                                                                                        echo $resultval['Health_Insurance'];
                                                                                                    } ?></span>

                                                                                <select name="HealthInsurance" id="HealthInsurance" class="form-control hide requiredfile2">
                                                                                    <option value="">----- Please Select -----</option>
                                                                                    <option value="Yes" selected>Yes</option>
                                                                                    <option value="No">No</option>
                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">MedFlex<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['MedFlex'])) {
                                                                                                        echo $resultval['MedFlex'];
                                                                                                    } ?></span>


                                                                                <select name="MedFlex" id="MedFlex" class="form-control hide requiredfile2">
                                                                                    <option value="">----- Please Select -----</option>
                                                                                    <option value="Yes" selected>Yes</option>
                                                                                    <option value="No">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Dependent<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['Dependent'])) {
                                                                                                        echo $resultval['Dependent'];
                                                                                                    } ?></span>

                                                                                <select name="Dependent" id="Dependent" class="form-control hide requiredfile2">
                                                                                    <option value="">----- Please Select -----</option>
                                                                                    <option value="Yes" selected>Yes</option>
                                                                                    <option value="No">No</option>
                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">TIAA<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['TIAA'])) {
                                                                                                        echo $resultval['TIAA'];
                                                                                                    } ?></span>

                                                                                <select name="TIAA" id="TIAA" class="form-control hide requiredfile2">
                                                                                    <option value="">----- Please Select -----</option>
                                                                                    <option value="Yes">Yes</option>
                                                                                    <option value="No" selected>No</option>
                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6 col-sm-6 col-xs-6">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Dental<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['Dental'])) {
                                                                                                        echo $resultval['Dental'];
                                                                                                    } ?></span>


                                                                                <select name="Dental" id="Dental" class="form-control hide requiredfile2">
                                                                                    <option value="">----- Please Select -----</option>
                                                                                    <option value="Yes" selected>Yes</option>
                                                                                    <option value="No">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Med Flex Deduction ($)<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['MedFlexDeduction'])) {
                                                                                                        echo $resultval['MedFlexDeduction'];
                                                                                                    } ?></span>
                                                                                <input class="form-control hide requiredfile2" id="MedFlexDeduction-<?php echo $counter; ?>" placeholder="Med Flex Deduction" onchange="flexdeductiondetails(this.value,<?php echo $counter; ?>);" name="MedFlexDeduction" type="text" value="<?php if (isset($resultval['MedFlexDeduction'])) {
                                                                                                                                                                                                                                                                                                                                    echo $resultval['MedFlexDeduction'];
                                                                                                                                                                                                                                                                                                                                } ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Dependent Deduction ($)<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['DependentDeduction'])) {
                                                                                                        echo $resultval['DependentDeduction'];
                                                                                                    } ?></span>
                                                                                <input class="form-control hide requiredfile2" id="DependentDeduction-<?php echo $counter; ?>" placeholder="Dependent Deduction" onchange="dependentdeductiondetails(this.value,<?php echo $counter; ?>);" name="DependentDeduction" type="text" value="<?php if (isset($resultval['DependentDeduction'])) {
                                                                                                                                                                                                                                                                                                                                            echo $resultval['DependentDeduction'];
                                                                                                                                                                                                                                                                                                                                        } ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">TIAA Deduction ($)<span class="requires">*</span></label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if (isset($resultval['TIAA_Deduction'])) {
                                                                                                        echo $resultval['TIAA_Deduction'];
                                                                                                    } ?></span>
                                                                                <input class="form-control hide requiredfile2" id="TIAADeduction-<?php echo $counter; ?>" placeholder="TIAA Deduction" onchange="tiaadeductiondetails(this.value,<?php echo $counter; ?>);" name="TIAADeduction" type="text" value="<?php if (isset($resultval['TIAA_Deduction'])) {
                                                                                                                                                                                                                                                                                                                        echo $resultval['TIAA_Deduction'];
                                                                                                                                                                                                                                                                                                                    } ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-sm-12 col-sm-12 col-xs-12">
                                                                <div class="alert alert-info">
                                                                    Travel information
                                                                </div>


                                                            </div>
                                                            <div class="main-row col-sm-12 col-sm-12 col-xs-12">

                                                                <div class="travel-lable-custom"><label>Days Required HQ</label></div>
                                                                <div class="travel-semicolon">:</div>
                                                                <div class="travel-content-box-text">

                                                                    <span class="show"><?php if (isset($resultval['Days_Required_HQ'])) {
                                                                                            echo $resultval['Days_Required_HQ'];
                                                                                        } ?></span>
                                                                    <input class="form-control hide" id="DaysRequiredHQ-<?php echo $counter; ?>" onkeypress="return onlyNumbers();" placeholder="Days Required HQ" name="DaysRequiredHQ" type="text" value="<?php if (isset($resultval['Days_Required_HQ'])) {
                                                                                                                                                                                                                                                                echo $resultval['Days_Required_HQ'];
                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                echo '0';
                                                                                                                                                                                                                                                            } ?>">

                                                                </div>

                                                            </div>


                                                            <div class="main-row col-sm-12 col-sm-12 col-xs-12">

                                                                <div class="travel-lable-custom"><label>Travel Note</label></div>
                                                                <div class="travel-semicolon">:</div>
                                                                <div class="travel-content-box-text">

                                                                    <span class="show"><?php if (isset($resultval['Travel_Note'])) {
                                                                                            echo $resultval['Travel_Note'];
                                                                                        } ?></span>

                                                                    <textarea class="form-control hide requiredfile2" id="TravelNote-<?php echo $counter; ?>" placeholder="Travel Note" rows="4" cols="50" name="TravelNote" type="text" value="<?php if (isset($resultval['Travel_Note'])) {
                                                                                                                                                                                                                                                    echo $resultval['Travel_Note'];
                                                                                                                                                                                                                                                } ?>"><?php if (isset($resultval['Travel_Note'])) {
                                                                                                                                                                                                                                                            echo $resultval['Travel_Note'];
                                                                                                                                                                                                                                                        } ?></textarea>

                                                                </div>

                                                            </div>

                                                            <div class="main-row col-sm-12 col-sm-12 col-xs-12">

                                                                <div class="travel-lable-custom"><label>Comments</label></div>
                                                                <div class="travel-semicolon">:</div>
                                                                <div class="travel-content-box-text">

                                                                    <span class="show"><?php if (isset($resultval['Comments'])) {
                                                                                            echo $resultval['Comments'];
                                                                                        } ?></span>


                                                                    <textarea class="form-control hide requiredfile2" id="Comments-<?php echo $counter; ?>" placeholder="Comments" rows="4" cols="50" name="Comments" type="text" value="<?php if (isset($resultval['Comments'])) {
                                                                                                                                                                                                                                                echo $resultval['Comments'];
                                                                                                                                                                                                                                            } ?>"><?php if (isset($resultval['Comments'])) {
                                                                                                                                                                                                                                                        echo $resultval['Comments'];
                                                                                                                                                                                                                                                    } ?></textarea>

                                                                </div>

                                                            </div>

                                                            <div class="col-sm-12 col-sm-12 col-xs-12">
                                                                <div class="col-sm-6 col-sm-6 col-xs-6">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Termination Date</label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show"><?php if ($resultval['Termination'] != '0000-00-00 00:00:00') echo date('m-d-Y', strtotime($resultval['Termination'])) ?></span>
                                                                                <div class="hide">
                                                                                    <div class="input-group date" data-provide="datepicker">
                                                                                        <input class="form-control hide" id="TerminationDate-<?php echo $counter; ?>" placeholder="Termination Date" name="TerminationDate" type="text" value="<?php if ($resultval['Termination'] != '0000-00-00 00:00:00') echo date('m-d-Y', strtotime($resultval['Termination'])) ?>">
                                                                                        <div class="input-group-addon">
                                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>



                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6 col-sm-6 col-xs-6">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="Driver's License" class="control-label col-sm-6">Type of Termination</label>
                                                                            <div class="col-sm-1"> :
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="show">
                                                                                    <?php
                                                                                    if (isset($resultval['Type_of_Termination'])) {
                                                                                        if ($resultval['Type_of_Termination'] == 'atl') {
                                                                                            echo 'Asked to Leave';
                                                                                        } else {
                                                                                            echo $resultval['Type_of_Termination'];
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </span>


                                                                                <select name="TypeofTermination" id="TypeofTermination-<?php echo $counter; ?>" class="form-control hide">
                                                                                    <option value="">----- Please Select -----</option>
                                                                                    <option value="Quit" <?php if ($resultval['Type_of_Termination'] == 'Quit') {
                                                                                                                echo 'selected';
                                                                                                            } ?>>Quit</option>
                                                                                    <option value="atl" <?php if ($resultval['Type_of_Termination'] == 'atl') {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Asked to Leave</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                            </div>


                                                        </div>
                                                        <?php echo form_close(); ?>
                                                    </div>


                                                <?php } ?>



                                                <ul id="pagination-demo" class="pagination-lg pull-right"></ul>
                                            </div>


                                        <?php } ?>

                                        <?php if (!empty($totalrecord)) {
                                            $totalrecord = $totalrecord;
                                        } else {
                                            $totalrecord = 0;
                                        } ?>
                                        <div class="uploaddocumentform" id="uploaddocumentform" style="display:<?php if ($totalrecord > 0) {
                                                                                                                    echo 'none';
                                                                                                                } else {
                                                                                                                    echo 'block';
                                                                                                                } ?>">
                                            <?php
                                            $attr = array("name" => "employmentforms", "id" => "employmentforms");
                                            echo form_open_multipart('admin/Reports/employmentListingSubmit', $attr);
                                            ?>
                                            <p id="uploadfileerror" style="display:none;"><span style="color:red;">Please Fill the Required Option.</span></p>
                                            <p id="successmsg" style="display:none;"><span style="color:green;">Employment Data Save Successfully!</span></p>


                                            <div class="employeementdatafield" id="employeementdatafield">
                                                <input type="hidden" name="facultyEmployeeIDforms" id="facultyEmployeeIDforms" value="<?php echo $facultyid; ?>">
                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="alert alert-info">
                                                        Contract information
                                                    </div>


                                                </div>
                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12 padding_bottom">

                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Title<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">

                                                                    <input class="form-control requiredfile2" id="Title" placeholder="Title" name="Title" type="text" value="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-sm-6 col-xs-6">


                                                        <div class="col-sm-12  padding_bottom">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Organization<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">

                                                                    <select name="Organization" id="Organization" class="form-control  requiredfile2">
                                                                        <option value="">----- Please Select -----</option>
                                                                        <option value="EDU" selected>EDU</option>
                                                                        <option value="ORG">ORG</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Begin Date<span class="requiresval">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">



                                                                    <div class="input-group date" data-provide="datepicker">
                                                                        <input class="form-control datepickerbackward  requiredfile2 requiredfield" id="BeginDateforms" placeholder="Begin Date" name="BeginDate" type="text" value="">
                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">End Date<span class="requiresval">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">



                                                                    <div class="input-group date" data-provide="datepicker">
                                                                        <input class="form-control datepickerbackward  requiredfile2 requiredfield" id="EndDateforms" placeholder="End Date" onchange="enddateforms(this.value);" name="EndDate" type="text" value="">
                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>



                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Days<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">

                                                                    <input class="form-control  requiredfile2" id="Daysforms" placeholder="Days" onkeypress="return onlyNumbers();" onchange="employmenthours(this.value);" name="Days" type="text" value="">
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Daily Rate($)<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">

                                                                    <input class="form-control  requiredfile2" id="DailyRate" placeholder="Daily Rate" onchange="employmentdailyrate(this.value);" name="DailyRate" type="text" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Full/Part <span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">

                                                                    <select name="FullPart" id="FullPart" class="form-control  requiredfile2">
                                                                        <option value="">----- Please Select -----</option>
                                                                        <option value="Full" selected>Full Time</option>
                                                                        <option value="Part">Part Time</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Salary / Hourly<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">


                                                                    <select name="SalaryHourly" id="SalaryHourly" class="form-control  requiredfile2">
                                                                        <option value="">----- Please Select -----</option>
                                                                        <option value="Salary" selected>Salary</option>
                                                                        <option value="Hourly">Hourly</option>
                                                                    </select>


                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Hours<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">

                                                                    <input class="form-control  requiredfile2" id="Hoursforms" placeholder="Hours" readonly name="Hours" type="text" value="">
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Compensation<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">

                                                                    <input class="form-control  requiredfile2" id="Compensationforms" placeholder="Compensation" readonly name="Compensation" type="text" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="alert alert-info">
                                                        Mediacal information
                                                    </div>


                                                </div>
                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Health Insurance<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">


                                                                    <select name="HealthInsurance" id="HealthInsurance" class="form-control  requiredfile2">
                                                                        <option value="">----- Please Select -----</option>
                                                                        <option value="Yes" selected>Yes</option>
                                                                        <option value="No">No</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Dental<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">


                                                                    <select name="Dental" id="Dental" class="form-control  requiredfile2">
                                                                        <option value="">----- Please Select -----</option>
                                                                        <option value="Yes" selected>Yes</option>
                                                                        <option value="No">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">MedFlex<span class="requires">*</span>
                                                                </label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <select name="MedFlex" id="MedFlex" class="form-control  requiredfile2">
                                                                        <option value="">----- Please Select -----</option>
                                                                        <option value="Yes" selected>Yes</option>
                                                                        <option value="No">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Med Flex Deduction ($)<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">

                                                                    <input class="form-control  requiredfile2" id="MedFlexDeduction" placeholder="Med Flex Deduction" name="MedFlexDeduction" onchange="flexdeduction(this.value);" type="text" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Dependent<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">


                                                                    <select name="Dependent" id="Dependent" class="form-control  requiredfile2">
                                                                        <option value="">----- Please Select -----</option>
                                                                        <option value="Yes">Yes</option>
                                                                        <option value="No" selected>No</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Dependent Deduction ($)<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">

                                                                    <input class="form-control  requiredfile2" id="DependentDeduction" placeholder="Dependent Deduction" name="DependentDeduction" onchange="dependentdeduction(this.value);" type="text" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">TIAA<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">


                                                                    <select name="TIAA" id="TIAA" class="form-control  requiredfile2">
                                                                        <option value="">----- Please Select -----</option>
                                                                        <option value="Yes">Yes</option>
                                                                        <option value="No" selected>No</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">TIAA Deduction ($)<span class="requires">*</span></label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">

                                                                    <input class="form-control  requiredfile2" id="TIAADeduction" placeholder="TIAA Deduction" name="TIAADeduction" onchange="tiaadeduction(this.value);" type="text" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="alert alert-info">
                                                        Travel information
                                                    </div>
                                                </div>

                                                <div class="main-row col-sm-12 col-sm-12 col-xs-12">

                                                    <div class="travel-lable-custom"><label>Days Required HQ</label></div>
                                                    <div class="travel-semicolon">:</div>
                                                    <div class="travel-content-box-text">

                                                        <input class="form-control" id="DaysRequiredHQ " onkeypress="return onlyNumbers();" placeholder="Days Required HQ" name="DaysRequiredHQ" type="text" value="">

                                                    </div>

                                                </div>

                                                <div class="main-row col-sm-12 col-sm-12 col-xs-12">

                                                    <div class="travel-lable-custom"><label>Travel Note</label></div>
                                                    <div class="travel-semicolon">:</div>
                                                    <div class="travel-content-box-text">

                                                        <textarea class="form-control  requiredfile2" rows="4" cols="50" id="TravelNote " placeholder="Travel Note" name="TravelNote" type="text" value=""></textarea>

                                                    </div>

                                                </div>

                                                <div class="main-row col-sm-12 col-sm-12 col-xs-12">

                                                    <div class="travel-lable-custom"><label>Comments</label></div>
                                                    <div class="travel-semicolon">:</div>
                                                    <div class="travel-content-box-text">

                                                        <textarea class="form-control  requiredfile2" rows="4" cols="50" id="Comments " placeholder="Comments" name="Comments" type="text" value=""></textarea>

                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-sm-12 col-xs-12">
                                                    <div class="col-sm-6 col-sm-6 col-xs-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Termination Date</label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">



                                                                    <div class="input-group date" data-provide="datepicker">
                                                                        <input class="form-control " id="TerminationDate " placeholder="Termination Date" name="TerminationDate" type="text" value="">
                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-sm-6 col-xs-6">



                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="Driver's License" class="control-label col-sm-6">Type of Termination</label>
                                                                <div class="col-sm-1"> :
                                                                </div>
                                                                <div class="col-sm-5">


                                                                    <select name="TypeofTermination" id="TypeofTermination" class="form-control ">
                                                                        <option value="">----- Please Select -----</option>
                                                                        <option value="Quit">Quit</option>
                                                                        <option value="atl">Asked to Leave</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-sm-12 col-xs-12">
                                                <div class="col-sm-2 col-sm-2 col-xs-2">
                                                    <a class="btn btn-success center-block Addresval show employeementdatasave show" value="name">Save</a>
                                                </div>
                                            </div>

                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                    <div id="Employee_Data" class="tabcontent">
                                        <?php
                                        echo view('templates/forms/employee_data', $data);
                                        ?>
                                    </div>
                                    <div id="Contracts_Data" class="tabcontent">
                                        <?php
                                        echo view('backend/addEmployeementContract');
                                        ?>
                                    </div>
                                    <div id="Time_Categories" class="tabcontent">
                                        <?php echo view('backend/another_assign_time_category'); ?>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div> <!-- End Row -->
                </div> <!-- container -->

            </div> <!-- content -->
        </div>

    </div> <!-- content -->
</div> <!-- content-page -->

<script>
    $(document).on('click', '.edit_contract_detail', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        if (id != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Reports/get_contract_details_by_id'); ?>",
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    'id': id,
                    'submit': 'get_details'
                },
                dataType: 'html',
                success: function(result) {
                    $('#edit_contract_part').html(result);
                    $('#panel-edit-modal').modal('show');
                },
            });
        } else {
            alert("Somethings Wrong . . .");
        }

    })

    function submitform() {
        $('#employment').submit();
        var formid = $("#facultyEmployeeID option:selected").val();
        $("#facultyEmployeeIDforms").val(formid);


    }

    $(document).on('click', '.add-popup', function() {
        var current = $('#facultyEmployeeID option:selected').val();
        if (current != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Users/get_user_details'); ?>",
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    'empid': current,
                    'submit': 'get_details'
                },
                dataType: 'json',
                success: function(result) {
                    $('#empid').val(current);
                    if (result != '') {
                        $('#title').val(result.title);
                        $('#FirstName').val(result.FirstName);
                        $('#LastName').val(result.LastName);
                    } else {
                        alert('Employee ID not exist/authorized');
                        $('#title').val('');
                    }
                },
            });
        }

    })
</script>

<script>
    $(document).ready(function() {
        var for_id = $('#facultyEmployeeID').val();
        $('#NameID_em').val(for_id);
    });




    $(document).on('click', '.Addresval', function(e) {
        e.preventDefault();
        loading();
        var formData = new FormData($('#employeedata')[0]);
        formData.append('submit', 'name');
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Reports/submitemploymentdata'); ?>',
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(data) {
                $('#overlay').remove();
                var content = '';
                if (data.status) {
                    content += '<div class="uploadvesslelog alert alert-success" style="width: 81%;padding: 7px;">';
                    content += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                    content += data.msg;
                    content += '</div>';
                } else {
                    content += '<div class="uploadvesslelog alert alert-danger" style="width: 81%;padding: 7px;">';
                    content += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                    content += data.msg;
                    content += '</div>';
                }
                $('#result_msg').html(content)
                setTimeout(function() {
                    $('#final_msg').fadeOut();
                    $('#result_msg').html('');
                }, 5000);

            },
        });
    })

    $(document).on('click', '#emp_address_save', function(e) {
        e.preventDefault();
        loading();
        var formData = new FormData($('#employeedata')[0]);
        formData.append('submit', 'address');
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Reports/submitemploymentdata'); ?>',
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(data) {
                $('#overlay').remove();
                var content = '';
                if (data.status) {
                    content += '<div class="uploadvesslelog alert alert-success" style="width: 81%;padding: 7px;">';
                    content += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                    content += data.msg;
                    content += '</div>';
                } else {
                    content += '<div class="uploadvesslelog alert alert-danger" style="width: 81%;padding: 7px;">';
                    content += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                    content += data.msg;
                    content += '</div>';
                }

                $('#result_msg').html(content)
                setTimeout(function() {
                    $('#final_msg').fadeOut();
                    $('#result_msg').html('');
                }, 5000);

            },
        });

    })


    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";

    }


    function openCurrentTab(evt, CurrentTab) {
        var i, tabcontent, tablinks;
        //tabcontent = document.getElementsByClassName("tabcontent");
        /*for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }*/
        $('.tabcontent').hide();
        $('.tab').removeClass("active");
        /* tablinks = document.getElementsByClassName("tablinks");
         for (i = 0; i < tablinks.length; i++) {
             tablinks[i].className = tablinks[i].className.replace(" active", "");
         }*/
        document.getElementById(CurrentTab).style.display = "block";
        evt.currentTarget.className += " active";

    }


    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#pagination-demo').twbsPagination({
            totalPages: <?php if ($totalrecord > 0) {
                            echo $totalrecord;
                        } else {
                            echo '1';
                        }; ?>,
            // the current page that show on start
            startPage: 1,

            // maximum visible pages
            visiblePages: 0,

            initiateStartPageClick: true,

            // template for pagination links
            href: false,

            // variable name in href template for page number
            hrefVariable: '{{number}}',

            // Text labels
            first: 'First',
            prev: 'Previous',
            next: 'Next',
            last: 'Last',

            // carousel-style pagination
            loop: false,

            // callback function
            onPageClick: function(event, page) {
                $('.page-active').removeClass('page-active');
                $('#page' + page).addClass('page-active');
            },

            // pagination Classes
            paginationClass: 'pagination',
            nextClass: 'next',
            prevClass: 'prev',
            lastClass: 'last',
            firstClass: 'first',
            pageClass: 'page',
            activeClass: 'active',
            disabledClass: 'disabled'

        });

        $("#addnewsemployment").click(function() {
            $("#uploaddocumentform").css("display", "block");
            $("#employementrecord").css("display", "none");
            $('#viewemploymentdetailsemployment').removeClass('hide').addClass('show');
            $('#addnewsemployment').removeClass('show').addClass('hide');
        });

        $("#viewemploymentdetailsemployment").click(function() {
            $("#uploaddocumentform").css("display", "none");
            $("#employementrecord").css("display", "block");

            $('#addnewsemployment').removeClass('hide').addClass('show');
            $('#viewemploymentdetailsemployment').removeClass('show').addClass('hide');
        });

    });



    $(document).on("click", ".employeementdatasave", function() {
        //var flag = 0;
        jQuery('#uploaddocumentform .requiredfield').each(function() {
            if (jQuery(this).val() == '' || jQuery(this).val() == 0) {
                jQuery('html, body').animate({
                    scrollTop: jQuery("#uploaddocumentform").offset().top
                }, 400);
                jQuery(this).css("border-color", "red");
                jQuery('#uploadfileerror').show();
                flag = 0;
                return false;
                flag = 0;
            } else {
                jQuery(this).css("border-color", "");
                jQuery('#uploadfileerror').hide();
                flag = 1;
            }
        });
        if (flag == 0) {

            jQuery('html, body').animate({
                scrollTop: jQuery("#uploaddocumentform").offset().top
            }, 400);
            jQuery('#uploadfileerror').show();
            return false;
        } else {

            jQuery('#uploadfileerror').hide();
        }

        var edit_user = '<?= session()->get('admin_fullname') ?>';
        var formData = new FormData($('#employmentforms')[0]);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Reports/employmentListingSubmit/'); ?>',
            data: formData,
            dataType: "html",
            processData: false,
            contentType: false,

            success: function(data) {
                data = JSON.parse(data);
                if (data.msg == 'INSERTED') {
                    alert('Record saved.');
                    jQuery('#successmsg').show();
                    location.reload();
                }
            },
        });

    });


    function employmenthours(value) {
        var days = value * 8;
        document.getElementById("Hoursforms").value = days;

    }

    function employmenthoursdetails(value, counter) {
        var daysdetails = value * 8;
        var counterval = counter;
        var HoursdetailsID = 'Hoursdetails-' + counterval;
        document.getElementById(HoursdetailsID).value = daysdetails;
        employmentdailyratedetails(value, '', counterval);
    }


    function employmentdailyratedetails(daysvalue = '', valuess = '', counterval) {

        var DaysdetailsID = '#Daysdetails-' + counterval;
        var daysvalues = daysvalue;
        var days = $(DaysdetailsID).val();
        var dailyratedolar = "DailyRatedetails-" + counterval;
        if (valuess == '') {
            var dailyrateIDD = '#DailyRatedetails-' + counterval;
            var newString = $(dailyrateIDD).val();
            var dailyrate = newString.replace('$', '');
        } else {
            var dailyrate = valuess;
        }
        var compensation = dailyrate * days;
        var compensationdetailsdollar = numeral(compensation).format('$0,0.00');
        var CompensationdetailsID = 'Compensationdetails-' + counterval;
        document.getElementById(CompensationdetailsID).value = compensationdetailsdollar;

        var stringsssss = numeral(dailyrate).format('$0,0.00');
        document.getElementById(dailyratedolar).value = stringsssss;

    }


    function employmentdailyrate(value) {

        var days = $("#Daysforms").val();
        var dailyrate = value;
        var compensation = dailyrate * days;
        var compensationdollar = numeral(compensation).format('$0,0.00');
        document.getElementById("Compensationforms").value = compensationdollar;
        var string = numeral(value).format('$0,0.00');
        document.getElementById("DailyRate").value = string;

    }

    function flexdeduction(valuessss) {
        var stringss = numeral(valuessss).format('$0,0.00');
        document.getElementById("MedFlexDeduction").value = stringss;

    }

    function flexdeductiondetails(val, counter) {
        var flexdeductionID = 'MedFlexDeduction-' + counter;
        var stringss = numeral(val).format('$0,0.00');
        document.getElementById(flexdeductionID).value = stringss;

    }

    function dependentdeduction(valuessss) {
        var stringss = numeral(valuessss).format('$0,0.00');
        document.getElementById("DependentDeduction").value = stringss;

    }

    function dependentdeductiondetails(values, counter) {
        var dependentdeductionID = 'DependentDeduction-' + counter;
        var stringss = numeral(values).format('$0,0.00');
        document.getElementById(dependentdeductionID).value = stringss;

    }

    function tiaadeduction(valuessss) {
        var stringss = numeral(valuessss).format('$0,0.00');
        document.getElementById("TIAADeduction").value = stringss;

    }

    function tiaadeductiondetails(values, counter) {
        var tiaadeductionID = 'TIAADeduction-' + counter;
        var stringss = numeral(values).format('$0,0.00');
        document.getElementById(tiaadeductionID).value = stringss;

    }

    function onlyNumbers(evt) {
        var e = event || evt; // for trans-browser compatibility
        var charCode = e.which || e.keyCode;

        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;



    }

    $('#uploaddocument .requiredfield').keyup(function() {
        $('#uploaddocument .requiredfield').each(function() {
            if (jQuery(this).val() == '' || jQuery(this).val() == 0) {

                jQuery('html, body').animate({
                    scrollTop: jQuery("#uploaddocument").offset().top
                }, 400);
                jQuery(this).css("border-color", "red");
                jQuery('#uploadfileerror').show();
                flag = 0;
                return false;
            } else {
                jQuery(this).css("border-color", "");
                jQuery('#uploadfileerror').hide();
                flag = 1;
            }
        });
    });

    $(document).on('click', '#general_edit', function() {

        $('#employementrecord .hide').removeClass('hide').addClass('show');
        $('#employementrecord span.show').removeClass('show').addClass('hide');
        $("#employementrecord #general_view").show();
        $("#employementrecord #general_edit").hide();
        $('.no_border').removeClass('no_border').addClass('edit_border');
        $('#email_save').show();
        $('#address_save').show();

    });

    $(document).on('click', '#general_view', function() {

        $('#employementrecord .show').removeClass('show').addClass('hide');
        $('#employementrecord span.hide').removeClass('hide').addClass('show');
        $(this).hide();
        $("#employementrecord #general_edit").show();
        $("#employementrecord #checkbox input:checkbox, .address_active, .email_active").attr("disabled", true);
        $('#email_save').hide();
        $('#address_save').hide();
        $('.edit_border').removeClass('edit_border').addClass('no_border');

    });

    function employmentListingDataUpdate(counter) {
        var counterasss = counter;
        var formids = '#employmentformsupdate' + '-' + counterasss;
        var updatesuccesmsg = '#successmsgupdate' + '-' + counterasss;
        var edit_user = '<?= session()->get('admin_fullname') ?>';
        var formData = new FormData($(formids)[0]);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Reports/employmentListingUpdate/'); ?>',
            data: formData,
            dataType: "html",
            processData: false,
            contentType: false,

            success: function(data) {
                data = JSON.parse(data);
                if (data.msg == 'UPDATED') {
                    alert('Record Updated.');
                    jQuery(updatesuccesmsg).show();
                    location.reload();
                }
            },
        });

    }

    function employmentListingDataDelete(counter) {
        var counterasss = counter;
        var formids = '#employmentformsupdate' + '-' + counterasss;
        var deletesuccesmsg = '#successmsgdelete' + '-' + counterasss;
        var edit_user = '<?= session()->get('admin_fullname') ?>';
        var formData = new FormData($(formids)[0]);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Reports/employmentListingDelete/'); ?>',
            data: formData,
            dataType: "html",
            processData: false,
            contentType: false,

            success: function(data) {
                data = JSON.parse(data);
                if (data.msg == 'DELETED') {
                    alert('Record Deleted.');
                    jQuery(deletesuccesmsg).show();
                    location.reload();
                }
            },
        });

    }

    function enddateforms(value) {


        var startDate = $('#BeginDateforms').val();
        var endDate = $('#EndDateforms').val();
        if (Date.parse(startDate) > Date.parse(endDate)) {
            alert("End Date Should Be Gretter than Begin Date");
            jQuery('#EndDateforms').css("border-color", "red");
            return false;
        } else {
            jQuery('#EndDateforms').css("border-color", "transparent");
            return true;
        }
    }

    function enddatedetails(value, counter) {

        var startDateID = '#BeginDate-' + counter;
        var EndDateID = '#EndDate-' + counter;
        var startDate = $(startDateID).val();
        var endDate = $(EndDateID).val();
        if (Date.parse(startDate) > Date.parse(endDate)) {
            alert("End Date Should Be Gretter than Begin Date");
            jQuery(EndDateID).css("border-color", "red");
            return false;
        } else {
            jQuery(EndDateID).css("border-color", "transparent");
            return true;
        }
    }
</script>

<script type="text/javascript">
    $(document).on('click', '.edit_submit_button', function(e) {
        e.preventDefault();
        $('.edit_validate').removeClass('invalid');
        if (!validateEditForm()) return false;
        loading();
        var formData = new FormData($('#edit_contract_data')[0]);
        formData.append('submit', 'name');
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Reports/submitcontractdata'); ?>',
            data: formData,
            dataType: "html",
            processData: false,
            contentType: false,
            success: function(data) {
                $('#overlay').remove();
                alert(data)
                filter_progress_loader();
                $('#panel-edit-modal').modal('hide');
            },
        });
    })


    $(document).on('click', '.submit_button', function(e) {
        e.preventDefault();
        $('.validate').removeClass('invalid');
        if (!validateForm()) return false;

        loading();
        var formData = new FormData($('#contract_form')[0]);
        formData.append('submit', 'name');
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Reports/submitcontractdata'); ?>',
            data: formData,
            dataType: "html",
            processData: false,
            contentType: false,
            success: function(data) {
                $('#overlay').remove();
                alert(data)
                filter_progress_loader();
                $('#panel-edit-modal').modal('hide');
            },
        });
    })


    $(document).ready(function() {
        $('.input-group.date').datepicker({
            todayBtn: "linked",
            language: "it",
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy'
        });
    })





    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        //x = document.getElementsByClassName("tab");
        //console.log(x[currentTab]);
        // y = x[currentTab].getElementsByTagName("input");
        y = document.getElementsByClassName("validate");


        console.log(y.length);
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...

            if (y[i].value == "") {
                var val_data = $(y[i]).attr('name');
                var per_data = $('#personal_info_country_birth :selected').val();

                var var_id = $(y[i]).attr('id');
                $('#' + var_id).focus();

                if (val_data == 'personal_info_americorps' || val_data == 'personal_info_peace_crops' || val_data == 'personal_info_ethnicity') {
                    if (per_data == 'USA') {
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    }
                } else {
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }

                // add an "invalid" class to the field:

            }
            //console.log(y[i].className);

            //alert(y[i].className);
        }

        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            // document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status 
    }

    function validateEditForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        //x = document.getElementsByClassName("tab");
        //console.log(x[currentTab]);
        // y = x[currentTab].getElementsByTagName("input");
        y = document.getElementsByClassName("edit_validate");


        console.log(y.length);
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...

            if (y[i].value == "") {
                var val_data = $(y[i]).attr('name');
                var per_data = $('#personal_info_country_birth :selected').val();

                var var_id = $(y[i]).attr('id');
                $('#' + var_id).focus();

                if (val_data == 'personal_info_americorps' || val_data == 'personal_info_peace_crops' || val_data == 'personal_info_ethnicity') {
                    if (per_data == 'USA') {
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    }
                } else {
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }

                // add an "invalid" class to the field:

            }
            //console.log(y[i].className);

            //alert(y[i].className);
        }

        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            // document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status 
    }
</script>

<script>
    $(document).on('click', '.add-general', function(e) {
        e.preventDefault();
        $('.name_validation').removeClass('invalid');
        if (!validateGeneralForm()) return false;
        $('.add-general').removeClass('show');
        $('.add-general').addClass('hide');
        var formData = new FormData($('#general_form')[0]);
        formData.append("submit", "addGeneralSave");
        formData.append("<?= csrf_token() ?>','<?= csrf_hash() ?>");
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: '<?= base_url() ?>admin/Reports/submitGeneralForm',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data.status)
                var content = '';
                $('.add-general').addClass('show');
                if (data.status) {
                    content += '<div class="uploadvesslelog alert alert-info" style="width: 81%;padding: 7px;">';
                    content += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                    content += data.msg;
                    content += '</div>';
                } else {
                    content += '<div class="uploadvesslelog alert alert-info" style="width: 81%;padding: 7px;">';
                    content += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                    content += data.msg;
                    content += '</div>';
                }
                $('html, body').animate({
                    scrollTop: $("#tab1").offset().top
                }, 2000);
                $('#result_msg_general').html(content)
                setTimeout(function() {
                    $('.final_msg').fadeOut();
                    $('#result_msg_general').html('');
                    refreshPage('overview');
                }, 5000);
            }
        });

    })

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
</script>

<script>
    $("#addButtonRD").click(function() {
        var country_list = <?= json_encode($country_js ?? []); ?>;
        var state_list = <?= json_encode($state_js ?? []); ?>;

        var add_type_list = <?= !empty($address_type_js) ? json_encode($address_type_js) : '[]'; ?>;
        console.log(add_type_list);
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
<?php if (isset($form_id)) {
    if ($form_id == '') { ?>
        <script>
            $('#tab1 .hide').removeClass('hide').addClass('show');
            $('#tab1 span.show').removeClass('show').addClass('hide');
            $("#tab1 #general_view").show();
            $("#tab1 #general_edit").hide();
            $("#tab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive").attr("disabled", false);
        </script>
<?php }
} ?>
<script type="text/javascript">
    $(document).on('click', '#general_edit', function() {

        $('#tab1 .hide').removeClass('hide').addClass('show');
        $('#tab1 span.show').removeClass('show').addClass('hide');
        $("#tab1 #general_view").show();
        $("#tab1 #general_edit").hide();
        $("#tab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive").attr("disabled", false);
        $('.no_border').removeClass('no_border').addClass('edit_border');
        $('#email_save').show();
        $('#address_save').show();
        $('#inter_address_save').show();

    });

    $(document).on('click', '#general_view', function() {
        $('#tab1 .show').removeClass('show').addClass('hide');
        $('#tab1 span.hide').removeClass('hide').addClass('show');
        $(this).hide();
        $("#tab1 #general_edit").show();
        $("#tab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive").attr("disabled", true);
        $('#email_save').hide();
        $('#address_save').hide();
        $('.edit_border').removeClass('edit_border').addClass('no_border');

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
    id = "addresscheckbox<?php echo (isset($ref_count) ? $ref_count : 0); ?>"
    $('.phone_validation').bind('keyup blur', function() {
        $(this).val($(this).val().replace(/[^0-9()+-Xx ]/g, ''));
    });

    $("#inter_addButtonRD").click(function() {
        var country_list = <?= json_encode($country_js ?? []); ?>;
        var state_list = <?= json_encode($state_js ?? []); ?>;
        var counter = $("#count8").val();
        var rem_count8 = parseInt($("#rem_count8").val());
        //country_select
        country_html = '<select class="form-control" name="inter_Country[' + counter + ']" onchange="getstatedetails(this.value)"><option value="">Select</option>';
        $.each(country_list, function(key, val) {
            country_html += '<option value="' + val.CountryID + '">' + val.CountryName + '</option>';
        });
        country_html += '</select>';

        var add_type_list = JSON.parse('<?= isset($address_type_js) ?>');
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
            alert("Address removal not allowed, either update or uncheck the active checkbox.");
            return false;
        }
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
        }
    })
    //End Prabhat 13-10-2020

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

        $('#inter_address_save').removeClass('show');
        $('#inter_address_save').addClass('hide');

        formname = $("#general_form");
        var formData = new FormData($('#general_form')[0]);
        formData.append("submit", "inter_address");
        formData.append("form_submit_type", "ajax");
        formData.append("<?= csrf_token() ?>','<?= csrf_hash() ?>");
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: formname.attr("action"),
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#inter_address_save').addClass('show');
                $('#inter_address_save').removeClass('hide');
                $('html, body').animate({
                    scrollTop: $("#tab1").offset().top
                }, 2000);
                var content = ''
                content += '<div class="uploadvesslelog alert alert-info" style="width: 81%;padding: 7px;">';
                content += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                content += data;
                content += '</div>';
                $('#result_msg_general').html(content)
                setTimeout(function() {
                    $('.final_msg').fadeOut();
                    $('#result_msg_general').html('');
                }, 5000);
            }
        });
    })
    $(document).on('click', '#address_save', function(e) {
        e.preventDefault();
        $('.street_validate').removeClass('invalid');
        if (!address_validateForm()) return false;
        $('#address_save').addClass('hide');
        $('#address_save').removeClass('show');
        formname = $("#general_form");
        var formData = new FormData($('#general_form')[0]);
        formData.append("submit", "address");
        formData.append("form_submit_type", "ajax");
        formData.append("<?= csrf_token() ?>','<?= csrf_hash() ?>");
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: formname.attr("action"),
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#address_save').addClass('show');
                $('#address_save').removeClass('hide');
                $('html, body').animate({
                    scrollTop: $("#tab1").offset().top
                }, 2000);
                var content = ''
                content += '<div class="uploadvesslelog alert alert-info" style="width: 81%;padding: 7px;">';
                content += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                content += data;
                content += '</div>';
                $('#result_msg_general').html(content)
                setTimeout(function() {

                    $('.final_msg').fadeOut();
                    $('#result_msg_general').html('');
                    refreshPage('overview');
                }, 5000);


            }
        });
    })
    $(document).on('click', '#usphone_save', function(e) {
        e.preventDefault();
        $('.phonevalidate').removeClass('invalid');
        if (!phone_validateForm()) return false;
        $('#usphone_save').addClass('hide');
        $('#usphone_save').removeClass('show');
        formname = $("#general_form");
        var formData = new FormData($('#general_form')[0]);
        formData.append("submit", "USPhone");
        formData.append("form_submit_type", "ajax");
        formData.append("<?= csrf_token() ?>','<?= csrf_hash() ?>");
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: formname.attr("action"),
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#usphone_save').addClass('hide');
                $('#usphone_save').removeClass('show');
                $('html, body').animate({
                    scrollTop: $("#tab1").offset().top
                }, 2000);
                var content = ''
                content += '<div class="uploadvesslelog alert alert-info" style="width: 81%;padding: 7px;">';
                content += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                content += data;
                content += '</div>';
                $('#result_msg_general').html(content)
                setTimeout(function() {
                    $('.final_msg').fadeOut();
                    $('#result_msg_general').html('');
                    refreshPage('overview');
                }, 5000);
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
        formData.append("<?= csrf_token() ?>','<?= csrf_hash() ?>");
        $.ajax({
            type: "POST",
            dataType: 'json',
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
        $('#email_save').addClass('hide');
        $('#email_save').removeClass('show');
        formname = $("#general_form");
        var formData = new FormData($('#general_form')[0]);
        formData.append("submit", "email");
        formData.append("form_submit_type", "ajax");
        formData.append("<?= csrf_token() ?>','<?= csrf_hash() ?>");
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: formname.attr("action"),
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#email_save').addClass('hide');
                $('#email_save').removeClass('show');
                $('html, body').animate({
                    scrollTop: $("#tab1").offset().top
                }, 2000);
                var content = ''
                content += '<div class="uploadvesslelog alert alert-info" style="width: 81%;padding: 7px;">';
                content += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                content += data;
                content += '</div>';
                $('#result_msg_general').html(content)
                setTimeout(function() {
                    refreshPage('overview');
                    $('.final_msg').fadeOut();
                    $('#result_msg_general').html('');
                }, 5000);
            }
        });
    })


    function validateGeneralForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        y = document.getElementsByClassName("name_validation");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            console.log(y[i].value);
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

    function refreshPage(tabname) {

        var faculity_id = $("#facultyEmployeeID option:selected").val();
        var submit = 'refresh_page';
        var content = '';
        content += '<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
        content += '</main>';
        $('#tab1').html(content);
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>admin/Reports/get_tab_page',
            data: {
                facultyEmployeeID: faculity_id,
                submit: submit,
                tabname: tabname
            },
            dataType: "html",
            success: function(data) {
                if (tabname == 'overview') {
                    $('#tab1').html(data);
                }
            },
        });
    }
</script>

<!-- Time Category -->
<!-- Assign Catogory Modal -->
<div class="modal fade" id="assign_category_modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <?php
            $attr = array("name" => "myForm", "id" => "myForm");
            echo form_open_multipart("admin/AssignCategory/store_assign_category", $attr);
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assign Category</h4>
            </div>
            <div class="modal-body" style="height: 300px;overflow-y: scroll;">
                <input type="hidden" class="form-control" name="emp_id" id="emp_id" />
                <input type="checkbox" id='check_all'>&nbsp;&nbsp;Check All
                <hr />
                <span id="assign_body"></span>
                <?php
                /* foreach ($catagory_name as $cat) {
	               	?>
	               	 <input type="checkbox" value="<?= $cat['id'] ?>" name="cat_id[]" class="category_check">
	               	 &nbsp;&nbsp;&nbsp;<?= $cat['catagory_name']; ?><br/>
	               	<?php
	               } */
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success assign_cat_button">Assign</button>
            </div>
            </form>

        </div>


    </div>
</div>
<!-- End assign Cateogy Modal -->



<!-- Remove Catogory Modal -->
<div class="modal fade" id="remove_category_modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->

        <div class="modal-content">

            <?php
            $attr = array("name" => "myFormRemove", "id" => "myFormRemove");
            echo form_open_multipart("admin/AssignCategory/remove_assign_category", $attr);
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Remove Category</h4>
            </div>
            <div class="modal-body" style="height: 300px;overflow-y: scroll;">
                <input type="hidden" class="form-control" name="remove_emp_id" id="edit_emp_id" />
                <input type="checkbox" id='check_all1'>&nbsp;&nbsp;Check All
                <hr />
                <span id="remove_body"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success remove_cat_button">Remove</button>
            </div>
            </form>
        </div>


    </div>
</div>
<!-- End remove Cateogy Modal -->






<?php if (isset($edit_contract[0])) { ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#panel-modal').modal('show');
            $('#FirstName,#title, #LastName').attr('readonly', true);
            //$('#empid, #FirstName, #LastName, #contract_begin_date, #contract_end_date').attr('readonly', true);
            //$('#note').html('You can only edit Hours To Work').css('color', 'red');
        });
    </script>
<?php } ?>
<script type="text/javascript">
    $(document).on("click", ".add-popup", function() {
        $('#panel-modal').modal('show');
        $('#FirstName,#title, #LastName').attr('readonly', true);
        $('#note').html('');
        $('#id, #empid, #FirstName,#title, #LastName, #contract_begin_date, #contract_end_date, #hours_to_work').val('');
    });

    $(document).on("click", "#calculate", function() {
        var jsondata = $(this).attr('data-json');
        var obj = JSON.parse(jsondata);
        $('#calculation-modal').modal('show');
        $('#total_worked_hours').html(obj.total_worked_hours);
        $('#total_worked_days').html(obj.total_worked_days);
        $('#total_left_hours').html(obj.total_left_hours);
        $('#total_left_days').html(obj.total_left_days);
        $('#carry_over').html(obj.carry_over);
        $('#donated').html(obj.donated);
    });


    $(document).on("click", ".rmv", function() {

        var anim = this.getAttribute("data-urlm");
        var current = this;

        if (confirm('Are you sure, Want to Delet this record?')) {
            loading();
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>" + "admin/Users/delContract",
                data: {
                    toBeChange: anim
                },
                success: function(res) {
                    //alert(res); 
                    console.log(res);
                    $('#overlay').remove();
                    if (res != 'OK' || res.length <= 0 || res == null) {
                        alert('Something went wrong');
                    } else {

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

<script type="text/javascript">
    $(document).on('change', '.empid', function() {
        var ev = $(this);
        var current = $(this).val();


        if (current != '') {

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Users/getEmpTitleName'); ?>",
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    'empid': current
                },
                success: function(result) {

                    if (result != '') {
                        $('#title').val(result);
                    } else {
                        alert('Employee ID not exist/authorized');
                        $('#title').val('');
                    }

                },
            });
        }

    });

    $(document).on('change', '.empid', function() {
        var ev = $(this);
        var current = $(this).val();


        if (current != '') {

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Users/getEmpName'); ?>",
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    'empid': current
                },
                success: function(result) {

                    if (result != '') {
                        $('#FirstName').val(result);
                    } else {
                        alert('Employee ID not exist/authorized');
                        $('#FirstName').val('');
                    }

                },
            });
        }

    });

    $(document).on('change', '.empid', function() {
        var ev = $(this);
        var currentval = $(this).val();

        if (currentval != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Users/getEmpLastName'); ?>",
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    'empid': currentval
                },
                success: function(result) {
                    //$('#LastName').val(result);
                    if (result != '') {
                        $('#LastName').val(result);
                    } else {
                        alert('Employee ID or Name not exist/authorized');
                        $('#LastName').val('');
                    }
                },
            });
        }

    });

    $(document).on('change', '.campare_date', function() {
        var contact_begin_date = $('#contract_begin_date').val();
        var contact_end_date = $('#contract_end_date').val();

        var d1 = new Date(contact_begin_date);
        var d2 = new Date(contact_end_date);
        //console.log(d1.getTime());
        //console.log(d2.getTime());		

        if (d2.getTime() < d1.getTime()) {
            alert('Contract end date should be greater than contract start date');
            $(this).val('');
        } else {

            //var now = new Date(date3);
            //var past = new Date(date4);

            var timeDiff1 = Math.abs(d1.getTime() - d2.getTime());
            var diffDays1 = Math.ceil(timeDiff1 / (1000 * 3600 * 24));
            var hours = (diffDays1 + 1) * 8;
            //console.log(isNaN(hours));
            if (!isNaN(hours)) {
                $('#hours_to_work').val(hours);
            } else {
                $('#hours_to_work').val('');
            }

        }

    });

    $(document).on('click', '.assign_category', function() {
        var emp_id = $(this).attr('rel_id');
        $('#emp_id').val(emp_id);

        $.ajax({
            url: '<?= base_url(); ?>admin/assignCategory/all_get_task_category',
            data: ({
                emp_id: emp_id
            }),
            dataType: 'json',
            type: 'post',
            success: function(response) {
                console.log(response);

                var html1 = '';
                $.each(response, function(key, value) {

                    if (value.rid == null) {
                        html1 += "<span><input type='checkbox' class='add_cat_check' name='cat_id[]' value=" + value.id + ">&nbsp;&nbsp;" + value.catagory_name + "</span><br/>";
                    } else {
                        html1 += "<span><input type='checkbox' name='cat_id[]' checked disabled value=" + value.id + ">&nbsp;&nbsp;" + value.catagory_name + "</span><br/>";
                    }

                })
                $('#assign_body').html(html1);

                $('#assign_category_modal').modal('show');
            }
        });



    });

    $(document).on('click', '.assign_cat_button', function(e) {
        e.preventDefault();
        var count_checked = $("[name='cat_id[]']:checked").length; // count the checked rows
        if (count_checked == 0) {
            alert("Please select any category.");
            return false;
        } else {
            //$("#myForm").submit();    
            loading();
            var formData = new FormData($('#myForm')[0]);
            formData.append('submit', 'name');
            formData.append('type', 'ajax')
            formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
            $.ajax({
                type: "POST",
                url: '<?php echo base_url('admin/AssignCategory/store_assign_category'); ?>',
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data) {
                    alert(data.msg);
                    $('#assign_category_modal').modal('hide');
                    $('#overlay').remove();
                },
            });
        }
    });

    $(document).on('click', '.remove_category', function() {
        var emp_id = $(this).attr('rel_id');
        $('#edit_emp_id').val(emp_id);
        $.ajax({
            url: '<?= base_url(); ?>admin/assignCategory/get_task_category',
            data: ({
                emp_id: emp_id
            }),
            dataType: 'json',
            type: 'post',
            success: function(response) {
                var html1 = '';
                $.each(response, function(key, value) {
                    html1 += "<span><input type='checkbox' class='rem_cat_check' name='remove_id[]'' value=" + value.rid + ">&nbsp;&nbsp;" + value.catagory_name + "</span><br/>";
                })
                $('#remove_body').html(html1);
                $('#remove_category_modal').modal('show');
            }
        });
    });

    $(document).on('click', '.remove_cat_button', function() {
        var count_checked = $("[name='remove_id[]']:checked").length; // count the checked rows
        if (count_checked == 0) {
            alert("Please select any category.");
            return false;
        } else {
            //$("#myFormRemove").submit();
            var formData = new FormData($('#myFormRemove')[0]);
            formData.append('submit', 'name');
            formData.append('type', 'ajax');
            formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
            $.ajax({
                type: "POST",
                url: '<?php echo base_url('admin/AssignCategory/remove_assign_category'); ?>',
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data) {
                    alert(data.msg);
                    $('#remove_category_modal').modal('hide');
                    $('#overlay').remove();
                },
            });
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#alldataTable1').DataTable({
            "pageLength": 50
        });
    });

    $('#CarriedOverHours').on('change', function() {
        //alert( this.value );
        if ((this.value) > 80) {
            alert('CarriedOverHours shoud not greate than ' + this.value)
        }
    });

    $("#check_all").click(function() {
        $(".add_cat_check").prop('checked', $(this).prop('checked'));
    });
    $("#check_all1").click(function() {
        $(".rem_cat_check").prop('checked', $(this).prop('checked'));
    });
</script>
<!-- By Prabhat 15/2/2020 -->
<script>
    $(document).on('click', '.cat_assign', function() {
        var id = $(this).attr('rel_id');
        var name = $(this).attr('rel_name');
        $('.part2').html('');
        $('#add_remove_emp_id').val(id);
        $.ajax({
            url: '<?= base_url(); ?>admin/assignCategory/add_remove_assign_cat',
            data: ({
                emp_id: id
            }),
            dataType: 'json',
            type: 'post',
            success: function(response) {
                console.log(response);
                var html1 = '';
                var html2 = '';
                $.each(response.category_list, function(key, value) {

                    if (value.rid == null) {
                        html1 += "<span class='modal_cat' rel_name='" + value.catagory_name + "' id='cat" + value.id + "' rel_id=" + value.id + ">" + value.catagory_name + "<br/></span>";
                    }
                })
                $.each(response.already_assign, function(key, value) {
                    html2 += "<span class='removeaddcat' rel_name='" + value.catagory_name + "' rel_id=" + value.id + " id='addcat" + value.id + "'><input type='hidden' class='form-control' value=" + value.id + " name='cat_id[]'/>" + value.catagory_name + "<br/></span>";

                })
                $('.part1').html(html1);
                $('.part2').html(html2);
                //alert(name);
                $('#user_name').html(name);
                $('#assign_remove_category_modal').modal('show');
            }
        });
    });

    $(document).on('click', '.modal_cat', function() {
        var emp_id = $('#add_remove_emp_id').val();
        var cat_id = $(this).attr('rel_id');
        var cat_name = $(this).attr('rel_name');
        $('.part2').append("<span class='removeaddcat' rel_name='" + cat_name + "' rel_id=" + cat_id + " id='addcat" + cat_id + "'><input type='hidden' class='form-control' value=" + cat_id + " name='cat_id[]'/>" + cat_name + "<br/></span>");
        $('#cat' + cat_id).remove();

    });

    $(document).on('click', '.removeaddcat', function() {
        var cat_id = $(this).attr('rel_id');
        var cat_name = $(this).attr('rel_name');
        $('.part1').append("<span class='modal_cat' rel_name='" + cat_name + "' id='cat" + cat_id + "' rel_id=" + cat_id + ">" + cat_name + "<br/></span>");
        $('#addcat' + cat_id).remove();

    });
</script>
<!-- End   Prabhat 15/2/2020 -->
<style>
    .modal_cat {
        cursor: pointer;
    }

    .removeaddcat {
        cursor: pointer;
    }
</style>

<!-- Assign Category and remove Catogory Modal -->
<div class="modal fade" id="assign_remove_category_modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <?php
            $attr = array("name" => "myFormRemove", "id" => "myFormAddRemove");
            echo form_open_multipart("admin/AssignCategory/add_remove_categoy", $attr);
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add or Remove Category for <span id="user_name"></span></h4>
            </div>

            <div class="modal-body" style="height: 300px;overflow-y: scroll;">
                <input type="hidden" class="form-control" name="remove_emp_id" id="add_remove_emp_id" />
                <div class="container cp1">
                    <div class="row">
                        <div class="col-md-6">
                            <h4><u>Category List</u></h4>
                        </div>
                        <div class="col-md-6">
                            <h4><u>Assigned Category List</u></h4>
                        </div>
                        <div class="col-md-6 part1">
                        </div>
                        <div class="col-md-6 part2">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success add_or_category_button">Assign</button>
            </div>
            </form>

        </div>


    </div>
</div>
<!-- End remove Cateogy Modal -->
<!-- By pRabhat 01-07-2021 -->
<script>
    $(document).on('click', '.inactive_btn', function() {
        $('#inactive_modal').modal('show');
    })

    $(document).on('click', '.add_or_category_button', function(e) {
        e.preventDefault();
        loading();
        var formData = new FormData($('#myFormAddRemove')[0]);
        formData.append('submit', 'name');
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Reports/assign_remove_category'); ?>',
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(data) {
                alert(data.msg);
                $('#assign_remove_category_modal').modal('hide');
                $('#overlay').remove();
            },
        });
    })
</script>


<!-- Modal -->
<div class="modal fade" id="inactive_modal" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>This user account is inactive.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- End Prabhat 01-07-2021 -->


<!-- Timesheetcategory -->

<script>
    $(document).on('click', '.day', function(e) {
        e.stopPropagation();
    })
    $(document).on('click', '.filter_data', function(e) {
        e.preventDefault();
        // loading();
        var formData = new FormData($('#filter_timesheet_form')[0]);
        formData.append('submit', 'name');
        formData.append('employee_id', '<?= isset($facultystaffid) ?>');
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Reports/filter_another_timesheet'); ?>',
            data: formData,
            dataType: "html",
            processData: false,
            contentType: false,
            success: function(data) {
                $('#transaction_result').html(data);
            },
        });
    })

    function openNewTab(url) {
        window.open(url, '_blank');
    }
</script>