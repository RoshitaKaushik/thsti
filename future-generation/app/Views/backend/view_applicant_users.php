<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>


<link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">

<style>
    #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
    }

    #snackbar.show {
        visibility: visible;
        /*-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;*/
        /*animation: fadein 0.5s, fadeout 0.5s 2.5s;*/
    }

    .themeBtn,
    .themeBtn_no_res,
    .filter_themeBtn {
        background: #1f65c8;
        display: inline-block;
        font-size: 14px;
        font-weight: 500;
        height: auto;
        line-height: 0.8;
        padding: 8px 18px;

        border-radius: 1px;
        letter-spacing: 0.5px;
        border: 0px !important;
        cursor: pointer;
        border-radius: 100px;
        cursor: default ! important;
        margin-left: 10px;

    }

    .themeBtn_new {
        background: #1f65c8;
        display: inline-block;
        font-size: 14px;
        font-weight: 500;
        height: auto;
        line-height: 0.8;
        padding: 8px 18px;

        border-radius: 1px;
        letter-spacing: 0.5px;
        border: 0px !important;
        cursor: pointer;
        border-radius: 100px;
        cursor: default ! important;
        margin-left: 10px;

    }

    .filter_themeBtn_new {
        background: #1f65c8;
        display: inline-block;
        font-size: 14px;
        font-weight: 500;
        height: auto;
        line-height: 0.8;
        padding: 8px 18px;

        border-radius: 1px;
        letter-spacing: 0.5px;
        border: 0px !important;
        cursor: pointer;
        border-radius: 100px;
        cursor: default ! important;
        margin-left: 10px;

    }

    .Donor_button_modal,
    .Donor_button {
        background-color: rgb(210, 56, 158);
        color: #fff;
        cursor: pointer ! important;
    }

    .Foundation_button,
    .Foundation_button_modal {
        background-color: rgb(245, 223, 77);
        color: #fff;
        cursor: pointer ! important;
    }

    .FacultyStaff_button,
    .FacultyStaff_button_modal {
        background-color: rgb(0, 114, 181);
        color: #fff;
        cursor: pointer ! important;
    }

    .Media_button,
    .Media_button_modal {
        background-color: rgb(233, 137, 126);
        color: #fff;
        cursor: pointer ! important;
    }

    .PartnerOrganization_button,
    .PartnerOrganization_button_modal {
        background-color: #9b5959;
        color: #fff;
        cursor: pointer ! important;
    }

    .Appalachian_button,
    .Appalachian_button_modal {
        background-color: rgb(0, 161, 112);
        color: #fff;
        cursor: pointer ! important;
    }

    .BoardMember_button,
    .BoardMember_button_modal {
        background-color: #67baeb;
        color: #fff;
        cursor: pointer ! important;
    }

    .StudentFamily_button,
    .StudentFamily_button_modal {
        background-color: rgb(255, 183, 212);
        color: #444;
        cursor: pointer ! important;
    }

    .AnnualReport_button,
    .AnnualReport_button_modal {

        color: #fff;
        cursor: pointer ! important;
    }

    .DanielVIP_button,
    .DanielVIP_button_modal {
        background-color: rgb(224, 181, 137);
        color: #fff;
        cursor: pointer ! important;
    }

    .FriendofDaniel_button,
    .FriendofDaniel_button_modal {
        background-color: rgb(239, 225, 206);
        color: #686868;
        cursor: pointer ! important;
    }

    .DanielPermissionNeeded_button,
    .DanielPermissionNeeded_button_modal {
        background-color: rgb(154, 139, 79);
        color: #fff;
        cursor: pointer ! important;
    }

    .GraduationInvite_button,
    .GraduationInvite_button_modal {
        background-color: rgb(146, 106, 166);
        color: #fff;
        cursor: pointer ! important;
    }

    .QuarterCenturyReport_button,
    .QuarterCenturyReport_button_modal {
        background-color: rgb(160, 218, 169);
        color: #fff;
        cursor: pointer ! important;
    }

    .GraduationInvite_button,
    .GraduationInvite_button_modal {

        color: #fff;
        cursor: pointer ! important;
    }

    .Unsubscribed_button,
    .Unsubscribed_button_modal {
        background-color: rgb(54, 57, 69);
        color: #fff;
        cursor: pointer ! important;
    }

    .Deceased_button,
    .Deceased_button_modal {
        background-color: rgb(147, 149, 151);
        color: #fff;
        cursor: pointer ! important;
    }

    .student_button,
    .student_button_modal {
        background-color: rgb(146, 106, 166);
        color: #fff;
        cursor: pointer ! important;
    }

    .Vista_button,
    .Vista_button_modal {
        background-color: rgb(180, 90, 48);
        color: #fff;
        cursor: pointer ! important;
    }

    /* start Fwd: FW: Mailchimp Audience Export Complete 10-04-2023 */
    .ProspectiveStudent_button,
    .ProspectiveStudent_button_modal {
        background-color: #80e14f;
        color: #fff;
        cursor: pointer ! important;
    }

    .ProspectiveDonor_button,
    .ProspectiveDonor_button_modal {
        background-color: #2e7f8f;
        color: #fff;
        cursor: pointer ! important;
    }

    /* end Fwd: FW: Mailchimp Audience Export Complete 10-04-2023 */

    /*.checknox-list {
    margin:10px 0px ! important;
    padding:0px ! important;
}*/
    .select-outer-box {
        width: 52%;
        margin-left: 30px;
    }

    .form-group.PartnerOrgName_div {
        display: block;
        width: 100%;
    }

    .remove_button {
        cursor: pointer;
        display: none;
        margin-left: 7px;
    }


    /*modal for add group*/


    .help,
    .filter_help {
        float: left;
        cursor: pointer;
    }

    .help a,
    .filter_help a {
        padding: 4px 8px;
        color: #F0F0F0;
        background-color: #3377DD;
        margin: 0 0 0 5px;
        font-size: 12px;
    }

    .help a:hover,
    .filter_help a:hover {
        cursor: pointer;
    }

    .pop {
        display: none;
    }

    .popOut {
        float: left;
        /*width: 250px;*/

        margin-top: 50px ! important;
        padding: 5px;
        background-color: #F9F9F9;
        border: 1px solid #DDD;
        display: block;
        position: absolute;
        z-index: 999;

        left: 0;
        right: 0;
        margin: 0 auto;
    }

    .popOut p {
        color: #242424;
    }

    .close a {
        float: right;
        padding: 3px 5px 2px 5px;
        font-size: 10px;
        color: #F0F0F0;
        background-color: #A10000;
        border-radius: 50%;
        border: 1px solid #BBB;
    }

    .popOut .close {
        margin-top: 10px;
        margin-right: 15px;
        /*position: absolute;*/
        right: 0;
    }

    .popOut {
        width: 60%;
        background-color: #f7ecf4;
        border: 6px solid #f9f9f9;
        border-right: 3px solid #f9f9f9;
        border-left: 3px solid #f9f9f9;
        box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%);
        -webkit-box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%);
        margin-top: 15px;
    }

    .close.filter_close_pop_out a,
    .close.close_pop_out a {
        background-color: #fff !important;
        color: #f32323 !important;
        border: 1px solid #fff;
        font-size: 14px !important;
    }

    .header_part {
        display: flex;
        align-items: flex-start;
    }

    .header_part strong {
        min-width: 165px;
    }

    span.header_button button.themeBtn {
        margin-bottom: 5px;
    }

    .header_part strong h3 {
        font-size: 18px;
    }


    ul.list_field::-webkit-scrollbar {
        width: 6px;
    }


    ul.list_field::-webkit-scrollbar-track {
        background: #f1f1f1;
    }


    ul.list_field::-webkit-scrollbar-thumb {
        background: #888;
    }


    ul.list_field::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    ul.list_field {
        margin: 0;
        padding: 0;
        list-style: none;
        max-height: 289px;
        overflow-x: auto;
        min-width: 150px;
    }

    ul.list_field li {
        background: #fff;
        padding: 3px 7px;
        border-bottom: 1px solid #f1eeee;
        font-size: 12px;
        cursor: pointer;
    }

    ul.list_field li:hover,
    li.show-active {
        background: #fff7f7 !important;
    }

    .top_maargin {
        margin-top: 10px;
    }

    .tag_li {
        list-style: none;
        display: "";
    }

    .filter-sub-menu-outer-box .tag_ul {
        width: 600px !important;
        left: 0 !important;
    }

    .filter-sub-menu-outer-box .tag_ul li.text-center.notifi-title {
        text-align: left !important;
        padding: 2px 0px 2px 20px;
        font-weight: 700;
    }

    .filter-sub-menu-outer-box .tag_ul li.list-group label.control-label {
        font-weight: 100;
        font-size: 12px;
        color: #888787;
    }

    .filter-sub-btn-box .btn-success {
        background-color: #ffffff;
        color: #565656 !important;
        border: 1px solid #c7c7c7;
        margin-bottom: 5px;
    }

    .filter-sub-menu-outer-box {
        margin-bottom: 10px;
    }

    .waves-effect {
        min-width: 0px !important;
    }

    .filter-sub-menu-outer-box .btn-primary {
        padding: 0px 5px 0px 5px;
    }


    @media only screen and (max-width: 767px) {
        .mobile-view-outter-box .tabs li.tab {
            width: 50% !important;
        }

        .mobile-view-outter-box ul.nav.nav-tabs.tabs span.hidden-xs {
            display: block !important;
            border-bottom: 1px solid #ebebeb;
            font-size: 12px;
        }

        .mobile-view-outter-box ul.nav.nav-tabs.tabs span.visible-xs {
            display: none !important;
        }

        .mobile-view-outter-box ul.nav.nav-tabs.tabs span.hidden-xs p {
            display: none;
        }
    }
</style>
<style>
    #cke_Note {
        margin-top: -40px;
    }

    #cke_boardHistory {
        margin-top: -30px;
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

    .table>tbody>tr>td {
        padding: 0px !important;
        vertical-align: middle;
    }


    /*start 04-11-2023*/
    #viewAppListDataTable_wrapper .top .dt-buttons {
        display: none;
    }

    #viewAppListDataTable_wrapper .top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        overflow: hidden;
    }

    #viewAppListDataTable_wrapper .top .clear {
        display: none;
    }

    #viewAppListDataTable_wrapper .top div.dataTables_info {
        padding: 0;
        margin-right: auto;
        margin-top: -7px;
    }

    #viewAppListDataTable_wrapper .top #viewAppListDataTable_length {
        width: 105px;
        overflow: hidden;
        margin-left: -31px;
    }

    /*end 04-11-2023*/
</style>


<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>-->
<?php
//echo "<pre>";print_r($this->session->userdata());
$access = getAccess(1);
if (!empty($country)) {
    $country_js = json_encode($country);
}
if (!empty($states)) {
    $state_js = json_encode($states);
}

if (!empty($address_type)) {
    $address_type_js = json_encode($address_type);
}

$transcriptclass_js = json_encode($transcriptclass);
$region_js = json_encode($region);
$program_js = json_encode($student_program);
$special_program_js = json_encode($student_special_program);
$paymenttype_js = json_encode($payment_type);
$campaigns_js = json_encode($campaigns);
$transcriptclass_js = json_encode($transcriptclass);
$grade_js = json_encode($transcriptgrades);
$adtranscriptclass_js = json_encode($transcriptclass);
$certificate_js = json_encode($certificate);
$contacttype_js = json_encode($contacttype);

$tracks_js = json_encode($tracks);

//echo "<pre>";print_r($access);die; 
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
    .invalid {
        background-color: #ff9494 ! important;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        width: auto;
    }

    /*
.table>thead>tr>th {
  width: 20% !important;
}*/

    span.view_outter_box {
        display: flex;
        justify-content: center;
        align-items: center;
    }


    .form-group .tabs {
        display: flex;
        justify-content: space-between;
    }
</style>


<style type="text/css">
    .border_dot {
        border: 1px dashed #ccc;
    }

    #dragable_modal .modal-dialog {
        position: fixed;
        max-width: 100%;
        /* box-shadow: 0 0 5px rgba(0,0,0,.5);*/
        background: var(--white);
        /* width:500px; */
        margin: 0;
        /* padding: 20px; */
        /* overflow: hidden; */
        /* resize: both; */
    }

    #dragable_modal .modal-content {
        /* padding: 20px; */
        height: 400px;
        overflow: hidden;
        resize: both;
        /*width:500px;*/
        width: 1190px ! important;
    }

    /*modal for add group*/
    .help {
        float: left;
    }

    .help a {
        padding: 6px 8px;
        color: #F0F0F0;
        background-color: #3377DD;
    }

    .help a:hover {
        cursor: pointer;
    }

    .pop {
        display: none;
    }

    .popOut {
        float: left;
        /*width: 250px;*/
        margin-top: 50px ! important;
        padding: 5px;
        background-color: #F9F9F9;
        border: 1px solid #DDD;
        display: block;
        position: absolute;
        z-index: 999;
        left: 0;
        right: 0;
        margin: 0 auto;
    }

    .popOut p {
        color: #242424;
    }

    .close a {
        float: right;
        padding: 3px 5px 2px 5px;
        font-size: 10px;
        color: #F0F0F0;
        background-color: #A10000;
        border-radius: 50%;
        border: 1px solid #BBB;
    }

    .popOut .close {
        margin-top: 10px;
        margin-right: 15px;
        /*position: absolute;*/
        right: 0;
    }

    .popOut {
        width: 100%;
        background-color: #f7ecf4;
        border: 6px solid #f9f9f9;
        border-right: 3px solid #f9f9f9;
        border-left: 3px solid #f9f9f9;
        box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%);
        -webkit-box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%);
        margin-top: 15px;
    }

    .close.filter_close_pop_out,
    .close.close_pop_out a {
        background-color: #fff !important;
        color: #f32323 !important;
        border: 1px solid #fff;
        font-size: 14px !important;
    }

    .checknox-list {
        display: inline-block;
        padding-top: 0;
        padding-bottom: 0;
        font-size: 15px;
        color: #323232;
        margin-top: 8px;
        margin-bottom: 8px;
    }

    span.header_button button.themeBtn {
        margin-bottom: 5px;
    }

    #dragable_modal .modal-title span {
        display: inline-block;
        float: inherit;
    }

    #dragable_modal .modal-title .help a {
        padding: 4px 8px;
        color: #F0F0F0;
        background-color: #3377DD;
        margin: 0 0 0 5px;
        font-size: 12px;
    }

    .remove_button {
        cursor: pointer;
        display: none;
        margin-left: 7px;
    }

    h4#header_part {
        display: flex;
        align-items: flex-start;
    }

    h4#header_part span.user_name {
        min-width: 165px;
    }

    .outer_class {
        background: #fff;
        float: left;
        padding: 10px 0;
        margin-bottom: 15px;
        width: 100%;
    }

    .outer_class label.control-label,
    .outer_class span.show {
        font-size: 13px;
    }

    .market_td .multiselect.dropdown-toggle.form-control.btn {
        display: none;
    }
</style>


<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <?php $msg = session()->getFlashdata('msg');
            if ($msg && gettype($msg) === 'array') {
                $msg = $session->getFlashdata('msg'); ?>
                <div class="uploadvesslelog alert <?php if ($msg['status']) {
                                                        echo 'alert-success';
                                                    } else {
                                                        echo 'alert-danger';
                                                    } ?>">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print $msg['message']; ?>
                </div>
            <?php } ?>
            <?php session()->remove($msg) ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-2">
                                    <h3 class="panel-title">
                                        Contact Database
                                    </h3>
                                </div>
                                <div class="col-md-8">
                                    <?= view('templates/forms/show_filter_group_in_pop_up') ?>
                                </div>


                                <div class="col-md-2">
                                    <?php if ($access['add_access']) { ?>
                                        <a href=<?= base_url('admin/Form') ?> class="btn-sm btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" style="font-size: 12px;background: #fff;color: #000!important;border: 1px solid #d5d5d5;padding: 4px 12px;margin: 0;">
                                            <i class="icon ion-plus-circled"></i>
                                            <span><strong>Add New</strong></span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>








                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="snackbar" style="z-index:99999999">Some text some message..</div>

                                <table id="viewAppListDataTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:10%!important">Action</th>
                                            <th>Contact Id</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Spouse</th>
                                            <th>Company</th>
                                        </tr>
                                    </thead>

                                </table>








                                <!-- dragable and editable bootsttrap modal modal -->
                                <!--div class="modal fade" id="dragable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header w-100">
            <div class="row m-0 w-100">
              <div class="col-md-12 px-4 p-2 dragable_touch d-block">
                <h3 class="m-0 d-inline">Edit row settings</h3>
                <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close" data-backdrop="static" data-keyboard="false"><i class="fa fa-times"></i></button>
              </div>


              <div class="col-md-12 p-0">
                <ul class="nav nav-tabs custom_tab_on_editor" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#row_seetings_general_tab" role="tab" aria-controls="home" aria-selected="true">General</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#row_seetings_design_tab" role="tab" aria-controls="profile" aria-selected="false">Design</a>
                  </li>
                </ul>
              </div>
            </div>
            
          </div>

          <div class="modal-body p-3">
            
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="row_seetings_general_tab" role="tabpanel" aria-labelledby="home-tab">
                <div class="form-group">
                  <label for="edit_project_name">Add row id</label>
                  <input type="text" class="form-control" id="row_id" >
                </div>
                <div class="form-group">
                  <label for="edit_project_name">Add extra class</label>
                  <input type="text" class="form-control" id="edit_project_name" />
                </div>
              </div>
              <div class="tab-pane fade" id="row_seetings_design_tab" role="tabpanel" aria-labelledby="profile-tab">...</div>
            </div>
          </div>

          <div class="modal-footer bg-light">
            <div class="row w-100">
              <div class="col-6">
                <button type="reset" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
              <div class="col-6 text-right">
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div-->




                                <div id="dragable_modal" class="modal fade xmodal" role="dialog" tabindex="-1" aria-labelledby="myModalLabel2" data-backdrop="static" data-keyboard="false" style="top:25 !important;
    left:50 !important;margin-left:50px;">
                                    <div class="modal-dialog modal-lg" style="width:95%;">
                                        <button type="button" class="close close_modal_button" data-dismiss="modal">&times;</button>
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-content-in">
                                                <div class="modal-header modal-header_data">
                                                    <h4 class="modal-title" id="header_part"></h4>
                                                </div>
                                                <div class="modal-body" style="height:600px;overflow-y:scroll;">
                                                    <span id="r_result"></span>
                                                </div>
                                                <div class="modal-footer modal-footer_data">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>











                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>











    </div> <!-- End Row -->
</div> <!-- container -->
</div> <!-- content -->




<script type="text/javascript">
    // modal draggable

    $(document).on("click", ".edit_row_btn", function() {
        $('#header_part').html('');
        $('.modal-header_data').hide();
        $('.modal-footer_data').hide();
        $('#r_result').html('');
        var content = '';
        content += '<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';

        content += '</main>';

        $('#r_result').html(content);


        var submit = 'submit';
        var student_id = $(this).attr('rel_id');
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>admin/Form/get_student_tab_data',
            data: {
                submit: submit,
                student_id: student_id
            },
            dataType: "html",
            success: function(data) {
                $('#r_result').html(data);
                $.ajax({
                    type: "POST",
                    url: '<?= base_url() ?>admin/Form/header_part',
                    data: {
                        submit: submit,
                        student_id: student_id
                    },
                    dataType: "html",
                    success: function(data) {
                        $('#header_part').html(data);
                        $('.modal-header_data').show();
                        $('.modal-footer_data').show();
                    },
                });


            },
        });




        $('#dragable_modal').modal({
            backdrop: false,
            show: true
        });
        // reset modal if it isn't visible
        if (!($('.modal.in').length)) {
            $('.modal-content').css({
                top: 20,
                left: 100
            });
        }

        $('.modal-content').draggable({
            cursor: "move",
            handle: ".dragable_touch"
        });
    })


    $(document).on('click', '.tab', function() {
        $('.tab').removeClass('active');
        $('.tab-pane').removeClass('show');
    })

    /*open group pop */
    $(document).on('click', '.help', function() {
        $('.pop').toggleClass('popOut');
        if ($('.pop').hasClass('popOut')) {
            $('.remove_button').show();
        } else {

            $('.remove_button').hide();

            const role_val = [];
            var user_id = $('#employee_id').val();
            var submit = 'submit';

            $('.themeBtn').each(function() {
                role_val.push($(this).attr('data-name'));
            });





            $.ajax({
                type: "POST",
                url: '<?= base_url() ?>admin/Form/submitUserRole',
                data: {
                    role_val: role_val,
                    user_id: user_id,
                    submit: submit
                },
                dataType: "html",
                success: function(data) {

                },
            });

        }
    })

    $(document).on('click', '.checkbox', function() {
        $('.pop').toggleClass('popOut');
    })

    $(document).on('click', '#PartnerOrgName', function() {
        $('.pop').toggleClass('popOut');
    })


    $(document).on('click', '.themeBtn_new', function() {
        var data = $(this).attr('rel_name');
        //var status = $(this).prop('checked');
        var content = '';

        if (data == 'Donor') {
            content += '<button class="themeBtn Donor_button" data-name="Donor">Donor <i class="fa fa-times remove_button" rel_name="Donor_button"></i></button>';
            $('.Donor_div').hide();
        }
        if (data == 'Foundation') {
            content += '<button class="themeBtn Foundation_button" data-name="Foundation">Grantmaker Affiliate <i class="fa fa-times remove_button" rel_name="Foundation_button" ></i></button>';
            $('.Foundation_div').hide();
        }
        if (data == 'Media') {
            content += '<button class="themeBtn Media_button" data-name="Media">Media <i class="fa fa-times remove_button" rel_name="Media_button"></i></button>';
            $('.Media_div').hide();
        }
        if (data == 'PartnerOrganization') {
            content += '<button class="themeBtn PartnerOrganization_button" data-name="PartnerOrganization">Partner Organization <i class="fa fa-times remove_button" rel_name="PartnerOrganization_button"></i></button>';
            $('.PartnerOrganization_div').hide();
        }
        if (data == 'Appalachian') {
            content += '<button class="themeBtn Appalachian_button" data-name="Appalachian">Appalachian Program <i class="fa fa-times remove_button" rel_name="Appalachian_button"></i></button>';
            $('.Appalachian_div').hide();
        }
        if (data == 'BoardMember') {
            content += '<button class="themeBtn BoardMember_button" data-name="BoardMember">Past & Present Board Members <i class="fa fa-times remove_button" rel_name="BoardMember_button"></i></button>';
            $('.BoardMember_div').hide();
        }
        if (data == 'FacultyStaff') {
            content += '<button class="themeBtn FacultyStaff_button" data-name="FacultyStaff">Past & Present Faculty & Staff <i class="fa fa-times remove_button" rel_name="FacultyStaff_button"></i></button>';
            $('.FacultyStaff_div').hide();
        }
        if (data == 'StudentFamily') {
            content += '<button class="themeBtn StudentFamily_button" data-name="StudentFamily">Past & Present Student Family <i class="fa fa-times remove_button" rel_name="StudentFamily_button"></i></button>';
            $('.StudentFamily_div').hide();
        }
        if (data == 'AnnualReport') {
            content += '<button class="themeBtn AnnualReport_button" data-name="AnnualReport">Receives Printed Annual Report <i class="fa fa-times remove_button" rel_name="AnnualReport_button"></i></button>';
            $('.AnnualReport_div').hide();
        }
        if (data == 'DanielVIP') {
            content += '<button class="themeBtn DanielVIP_button" data-name="DanielVIP">Daniel / VIP <i class="fa fa-times remove_button" rel_name="DanielVIP_button"></i></button>';
            $('.DanielVIP_div').hide();
        }
        if (data == 'FriendofDaniel') {
            content += '<button class="themeBtn FriendofDaniel_button" data-name="FriendofDaniel">Friend of Daniel/ Not VIP <i class="fa fa-times remove_button" rel_name="FriendofDaniel_button"></i></button>';
            $('.FriendofDaniel_div').hide();
        }
        if (data == 'DanielPermissionNeeded') {
            content += '<button class="themeBtn DanielPermissionNeeded_button" data-name="DanielPermissionNeeded">Need Daniel Permission to Contact <i class="fa fa-times remove_button" rel_name="DanielPermissionNeeded_button"></i></button>';
            $('.DanielPermissionNeeded_div').hide();
        }
        if (data == 'GraduationInvite') {
            content += '<button class="themeBtn GraduationInvite_button" data-name="GraduationInvite">Send Graduation Invitation <i class="fa fa-times remove_button" rel_name="GraduationInvite_button"></i></button>';
            $('.GraduationInvite_div').hide();
        }
        if (data == 'QuarterCenturyReport') {
            content += '<button class="themeBtn QuarterCenturyReport_button" data-name="QuarterCenturyReport">Received Quarter Century Report <i class="fa fa-times remove_button" rel_name="QuarterCenturyReport_button"></i></button>';
            $('.QuarterCenturyReport_div').hide();
        }
        if (data == 'Unsubscribed') {
            content += '<button class="themeBtn Unsubscribed_button" data-name="Unsubscribed">Do Not Email <i class="fa fa-times remove_button" rel_name="Unsubscribed_button"></i></button>';
            $('.Unsubscribed_div').hide();
        }
        if (data == 'Vista') {
            content += '<button class="themeBtn Vista_button" data-name="Vista">Vista <i class="fa fa-times remove_button" rel_name="Vista_button"></i></button>';
            $('.Vista_div').hide();
        }
        if (data == 'Deceased') {
            content += '<button class="themeBtn Deceased_button" data-name="Deceased">Deceased <i class="fa fa-times remove_button" rel_name="Deceased_button"></i></button>';
            $('.Deceased_div').hide();
        }

        // start FW: Mailchimp Audience Export Complete
        if (data == 'ProspectiveStudent') {
            content += '<button class="themeBtn ProspectiveStudent_button" data-name="ProspectiveStudent">Potential Student <i class="fa fa-times remove_button" rel_name="ProspectiveStudent_button"></i></button>';
            $('.ProspectiveStudent_div').hide();
        }
        if (data == 'prospective_donor') {
            content += '<button class="themeBtn ProspectiveDonor_button" data-name="prospective_donor">Potential Donor <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.ProspectiveDonor_div').hide();
        }

        // end FW: Mailchimp Audience Export Complete

        //start 08-Feb-2024
        if (data == 'tribal_college') {
            content += '<button class="themeBtn TribalCollege_button" data-name="tribal_college">Tribal College <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.TribalCollege_div').hide();
        }
        if (data == 'hbcu') {
            content += '<button class="themeBtn HBCU_button" data-name="hbcu">HBCU <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.HBCU_div').hide();
        }
        if (data == 'wv_college') {
            content += '<button class="themeBtn WVCollege_button" data-name="wv_college">WV College <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.WVCollege_div').hide();
        }
        if (data == 'appalachia_college') {
            content += '<button class="themeBtn AppalachiaCollege_button" data-name="appalachia_college">Appalachia College <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.AppalachiaCollege_div').hide();
        }
        if (data == 'us_college') {
            content += '<button class="themeBtn USCollege_button" data-name="us_college">US College <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.USCollege_div').hide();
        }
        if (data == 'americorps') {
            content += '<button class="themeBtn AmeriCorps_button" data-name="americorps">AmeriCorps <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.AmeriCorps_div').hide();
        }
        if (data == 'peacecorps') {
            content += '<button class="themeBtn PeaceCorps_button" data-name="peacecorps">PeaceCorps <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.PeaceCorps_div').hide();
        }

        //end 08-Feb-2024	
        if (data == 'accthold') {
            content += '<button class="themeBtn AcctHold_button" data-name="accthold">Acct Hold <i class="fa fa-times remove_button" rel_name="AcctHold_button"></i></button>';
            $('.AcctHold_div').hide();
        }



        $('.header_button').append(content);
    })

    $(document).on('click', '.remove_button', function() {

        var data = $(this).attr('rel_name');
        if (data == 'Donor_button') {
            $('.Donor_button').remove();
            $('.Donor_div').show();
            $('input:checkbox[name=Donor]').attr('checked', false);
        }
        if (data == 'Foundation_button') {
            $('.Foundation_button').remove();
            $('.Foundation_div').show();
            $('input:checkbox[name=Foundation]').attr('checked', false);
        }
        if (data == 'Media_button') {
            $('.Media_button').remove();
            $('.Media_div').show();
            $('input:checkbox[name=Media]').attr('checked', false);
        }
        if (data == 'PartnerOrganization_button') {
            $('.PartnerOrganization_button').remove();
            $('.PartnerOrganization_div').show();
            $('input:checkbox[name=PartnerOrganization]').attr('checked', false);
        }
        if (data == 'Appalachian_button') {
            $('.Appalachian_button').remove();
            $('.Appalachian_div').show();
            $('input:checkbox[name=Appalachian]').attr('checked', false);
        }
        if (data == 'BoardMember_button') {
            $('.BoardMember_button').remove();
            $('.BoardMember_div').show();
            $('input:checkbox[name=BoardMember]').attr('checked', false);
        }
        if (data == 'FacultyStaff_button') {
            $('.FacultyStaff_button').remove();
            $('.FacultyStaff_div').show();
            $('input:checkbox[name=FacultyStaff]').attr('checked', false);
        }
        if (data == 'StudentFamily_button') {
            $('.StudentFamily_button').remove();
            $('.StudentFamily_div').show();
            $('input:checkbox[name=StudentFamily]').attr('checked', false);
        }
        if (data == 'AnnualReport_button') {
            $('.AnnualReport_button').remove();
            $('.AnnualReport_div').show();
            $('input:checkbox[name=AnnualReport]').attr('checked', false);
        }
        if (data == 'DanielVIP_button') {
            $('.DanielVIP_button').remove();
            $('.DanielVIP_div').show();
            $('input:checkbox[name=DanielVIP]').attr('checked', false);
        }
        if (data == 'FriendofDaniel_button') {
            $('.FriendofDaniel_button').remove();
            $('.FriendofDaniel_div').show();
            $('input:checkbox[name=FriendofDaniel]').attr('checked', false);
        }
        if (data == 'DanielPermissionNeeded_button') {
            $('.DanielPermissionNeeded_button').remove();
            $('.DanielPermissionNeeded_div').show();
            $('input:checkbox[name=DanielPermissionNeeded]').attr('checked', false);
        }
        if (data == 'GraduationInvite_button') {
            $('.GraduationInvite_button').remove();
            $('.GraduationInvite_div').show();
            $('input:checkbox[name=GraduationInvite]').attr('checked', false);
        }
        if (data == 'QuarterCenturyReport_button') {
            $('.QuarterCenturyReport_button').remove();
            $('.QuarterCenturyReport_div').show();
            $('input:checkbox[name=QuarterCenturyReport]').attr('checked', false);
        }
        if (data == 'Unsubscribed_button') {
            $('.Unsubscribed_button').remove();
            $('.Unsubscribed_div').show();
            $('input:checkbox[name=Unsubscribed]').attr('checked', false);
        }
        if (data == 'Vista_button') {
            $('.Vista_button').remove();
            $('.Vista_div').show();

        }
        if (data == 'Deceased_button') {
            $('.Deceased_button').remove();
            $('.Deceased_div').show();
            $('input:checkbox[name=Deceased]').attr('checked', false);
        }
        // start FW: Mailchimp Audience Export Complete
        if (data == 'ProspectiveDonor_button') {
            $('.ProspectiveDonor_button').remove();
            $('.ProspectiveDonor_div').show();
        }
        if (data == 'ProspectiveStudent_button') {
            $('.ProspectiveStudent_button').remove();
            $('.ProspectiveStudent_div').show();
        }
        // End FW: Mailchimp Audience Export Complete

        /* start 08-02-2024 */
        if (data == 'TribalCollege_button') {
            $('.TribalCollege_button').remove();
            $('.TribalCollege_div').show();
        }
        if (data == 'HBCU_button') {
            $('.HBCU_button').remove();
            $('.HBCU_div').show();
        }
        if (data == 'WVCollege_button') {
            $('.WVCollege_button').remove();
            $('.WVCollege_div').show();
        }
        if (data == 'AppalachiaCollege_button') {
            $('.AppalachiaCollege_button').remove();
            $('.AppalachiaCollege_div').show();
        }
        if (data == 'USCollege_button') {
            $('.USCollege_button').remove();
            $('.USCollege_div').show();
        }
        if (data == 'AmeriCorps_button') {
            $('.AmeriCorps_button').remove();
            $('.AmeriCorps_div').show();
        }
        if (data == 'PeaceCorps_button') {
            $('.PeaceCorps_button').remove();
            $('.PeaceCorps_div').show();
        }
        /* end 08-02-2024 */
        if (data == 'AcctHold_button') {
            $('.AcctHold_button').remove();
            $('.AcctHold_div').show();
        }

    })


    $(document).on('click', '.close_pop_out', function() {
        $('.remove_button').hide();
    })
</script>


<!-- Progress bar code -->
<style>
    .r_result {
        height: 100vh;
        width: 100%;
    }

    .r_result {
        background: linear-gradient(to bottom right, #14151c, black, #080b1f);
        display: flex;
        align-items: center;
        justify-content: center;
        justify-items: center;
        height: 100%;
        color: #ededed;
    }

    #container1 {
        display: flex;
        width: 500px;
        height: 25px;
        background: black;
        border-radius: 6px;
        border: 2px solid dimgray;
        align-items: center;
        margin: 0px auto;
    }

    @keyframes load {
        from {
            transform: translate(0, 0)
        }

        to {
            transform: translate(390px, 0)
        }
    }

    #bar {
        width: 100px;
        height: 10px;
        background: linear-gradient(to bottom right, cyan, lightblue);
        border-radius: 6px;
        box-shadow: 0 0 10px lightblue;

        animation: load .25s infinite alternate ease-in-out;
    }

    @keyframes dots {
        from {
            color: cyan;
            transform: translate(0, -10%);
        }

        to {
            color: white;
            transform: translate(0, 0);
        }
    }

    .dot {
        display: inline-block;
        font-size: 250%;
    }

    .dot:nth-child(1) {
        animation: dots .5s infinite alternate linear;
    }

    .dot:nth-child(2) {
        animation: dots 1s infinite alternate linear;
    }

    .dot:nth-child(3) {
        animation: dots 1.5s infinite alternate linear;
    }

    .loader sub {
        margin-left: 5%;
        font-size: 15%;
        font-weight: normal;
    }

    .loader {
        font-size: 20px ! important;
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
</style>

