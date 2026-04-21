<?php //echo "<pre>";print_r($data);die; 

//echo "<pre>"; print_r($this->session->userdata());
?>
<style>
    .add_new_sort {
        border: 1px solid #ccc;
        padding: 4px;
        margin-top: 23px;
        margin-bottom: 15px;
    }

    .top_marginn {
        margin-top: 10px !important;
    }

    .close_button {
        color: #e75353;
    }

    .close_button .fa-times {
        margin-top: 7px;
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

    td {
        text-align: left ! important;
    }

    .text-center {
        text-align: center ! important;
    }

    #course_report_filter {
        /*position: absolute;
    margin-left: 164px;*/
        float: right;
    }




    .help {
        float: left;
        /* margin:10px;*/
        margin: 2px;
    }

    .help a {
        /*padding: 10px 20px;*/
        padding: 4px 8px;
        color: #F0F0F0;
        background-color: #3377DD;
    }

    .help a:hover {
        cursor: pointer;
    }

    .pop {
        display: none;
    }

    /* Filter Pop */
    .help1 {
        float: left;
        margin: 2px 10px 2px 2px;
    }

    a.filter-btn-box {
        padding: 8px 10px;
        color: #5c5c5c;
        background-color: #ffffff;
        font-size: 14px;
        cursor: pointer;
        display: block;
        border-radius: 5px;
        border: 1px solid #e9e6e6;
    }

    a.filter-btn-box i {
        margin: 0 5px 0 0;
        font-size: 16px;
    }

    a.sort-btn-box i {
        margin: 0 0px 0 0 !important;
        font-size: 16px;
    }

    a.filter-btn-box i.fa.fa-angle-down {
        border-left: 1px solid #aeadad;
        margin: 0 0 0 2px;
        padding: 0 0 0 5px;
        font-size: 14px;
        color: #a6a4a4;
    }

    a.filter-btn-box:hover {
        background-color: #d1f1fa;
    }

    .pop1 {
        display: none;
    }


    /* Show/Hide Pop */
    .help2 {
        float: left;
        /* margin:10px;*/
        margin: 2px;
    }

    .pop2 {
        display: none;
        width: 16.5% !important;
    }

    .popOut {
        float: left;
        /*width: 250px;*/
        margin-top: 5px;
        padding: 5px;
        background-color: #F9F9F9;
        border: 1px solid #DDD;
        display: block;
        position: absolute;
        z-index: 999;
        /*left: 0;
    right: 0;
    margin: 0 auto;*/
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
        position: absolute;
        right: 0;
        margin-top: -17px;
        margin-right: -15px;
    }

    .popOut {
        width: 60%;
        border: 6px solid #f9f9f9;
        border-right: 3px solid #f9f9f9;
        border-left: 3px solid #f9f9f9;
        box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%);
        -webkit-box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%);
        margin-top: 15px;
    }

    .close.close_pop_out a {
        background-color: #5a5a5a !important;
        color: #ffffff !important;
        border: 1px solid #fff;
        font-size: 14px !important;
        padding: 5px;
        height: 30px;
        width: 30px;
        line-height: 18px;
        text-align: center;
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

    .top_maargin {
        margin-top: 10px;
    }

    .filter-li {
        list-style: none;
        display: inline-block;
    }

    .filter-sub-menu-outer-box .filter_ul {
        width: 570px;
        left: 0;
    }

    .filter-sub-menu-outer-box .filter_ul li.text-center.notifi-title {
        text-align: left !important;
        padding: 2px 0px 2px 20px;
        font-weight: 700;
    }

    .filter-sub-menu-outer-box .filter_ul li.list-group label.control-label {
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

    button.dt-button.buttons-excel.buttons-html5 {
        margin-bottom: 10px;
        position: absolute;
        top: -53px !important;
        right: 10px !important;
    }

    .open_active {
        display: inline;
    }

    #course_report_filter {
        position: relative;
        top: -51px;
        right: 100px;
    }

    #course_report_length {
        position: relative;
        top: -50px;
        width: 10%;
    }

    #course_report {
        position: relative;
        top: -49px;
    }

    .cell_spacing_dropdown {
        padding: 2px;
    }

    .cell_two_design {
        padding: 8px 0px 8px 0px !important;
        font-size: 14px !important;
    }

    .single_spacing,
    .double_spacing {
        padding: 10px 10px;
    }

    .filter-sub-menu-outer-box .spacing_ul li.text-center.notifi-title {
        text-align: left !important;
        padding: 2px 0px 2px 20px;
        font-weight: 700;
    }

    .filter-sub-menu-outer-box .spacing_ul {
        left: 0;
    }

    .active_color {
        background-color: #d1f1fa !important;
    }

    ul.dropdown-menu.dropdown-menu-md.spacing_ul {
        top: 26px;
    }

    .single_spacing i,
    .double_spacing i {
        color: #6b6969;
        margin-right: 2px;
    }


    .cell_spacing_li a i {
        margin: 0;
        padding: 0;
    }

    .filter_category {
        padding-bottom: 10px;
    }

    ul.dropdown-menu.dropdown-menu-lg.sort_ul {
        left: 0px;
        top: 26px;
    }

    .custum_padding {
        padding: 7px 2px 0px 6px;
    }

    .custum_hr {
        margin-top: 0px ! important;
        margin-bottom: 0px ! important;
    }

    table.dataTable thead .sorting:after {
        display: none;
    }

    table.dataTable thead .sorting_asc:after {
        display: none;
    }

    table.dataTable thead .sorting_desc:after {
        display: none;
    }

    .sort_ul li.text-center.notifi-title {
        text-align: left !important;
        padding: 2px 0px 2px 8px;
        font-weight: 700;
    }

    .sort_ul {
        width: 450px ! important;
    }

    .form-control1 {
        font-family: fontAwesome;
        height: 30px;
        padding: 3px 0px 3px 6px;
        border: 1px solid #ccc;
    }

    .stop-noti-box {
        display: inline;
    }

    .hide_li {
        font-size: 14px;
        cursor: pointer;
        border-radius: 5px;
        list-style: none;
        position: relative;
        top: -14px ! important;
    }

    .buttons-html5 {
        top: -65px !important;
    }
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Class Listing Reports</h4>
    			</div>
    		</div-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <h3 class="panel-title">Course Report
                                <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">

                            <?php
                            $attr = array("name" => "filter", "id" => "filter");
                            echo form_open_multipart('admin/Reports/', $attr);
                            ?>
                            <div class="col-md-12">
                                <!-- Button Filter -->
                                <div class="col-md-2"></div>
                                <div class="col-md-7">
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
                                                            <div class="col-md-12">
                                                                <div class="col-sm-2 top_maargin">
                                                                    <label for="First Name" class="control-label">Year</label>
                                                                </div>
                                                                <div class="col-sm-4 top_maargin">
                                                                    <select class="form-control filter_ajax" id="year" name="class">
                                                                        <option value="">Select</option>
                                                                        <option value="" <?php if (isset($selectedclass) == '') {
                                                                                                echo 'selected';
                                                                                            } ?>>All Years</option>
                                                                        <?php if (!empty($class)) {
                                                                            foreach ($class as $cl) {
                                                                        ?>
                                                                                <option value="<?= $cl['Class'] ?>" <?php if (isset($selectedclass) == $cl['Class']) {
                                                                                                                        echo "selected='selected'";
                                                                                                                    } ?>><?= $cl['Class'] ?></option>
                                                                        <?php }
                                                                        } ?>
                                                                    </select>
                                                                </div>


                                                                <div class="col-sm-2 top_maargin">
                                                                    <label for="First Name" class="control-label">Semester</label>
                                                                </div>
                                                                <div class="col-sm-4 top_maargin">
                                                                    <select class="form-control filter_ajax" id="semester" name="semester">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        foreach ($semesters as $rec) {
                                                                            $sec1 = "";
                                                                            if (isset($selectedsemester) == $rec['Semester']) {
                                                                                $sec1 = "selected";
                                                                            }
                                                                            echo "<option " . $sec1 . " value='" . $rec['Semester'] . "'>" . $rec['Semester'] . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="col-sm-2 top_maargin">
                                                                    <label for="First Name" class="control-label">Start Date</label>
                                                                </div>
                                                                <div class="col-sm-4 top_maargin">
                                                                    <input class="form-control datepicker num filter_ajax" name="start_date" type="text" value="">
                                                                </div>

                                                                <div class="col-sm-2 top_maargin">
                                                                    <label for="First Name" class="control-label">End Date</label>
                                                                </div>
                                                                <div class="col-sm-4 top_maargin">
                                                                    <input class="form-control datepicker num filter_ajax" name="end_date" type="text" value="">
                                                                </div>
                                                            </div>


                                                            <!--div class="col-sm-12 top_maargin text-right filter-sub-btn-box">                          				
                                                                    		<input class="btn btn-success btn-xs filter_button" name="submit" type="submit" value="Filter">	
                                                                    	</div-->
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
                                        <div class="stop-noti-box">

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

                                        </div>

                                        <div class="stop-noti-box">
                                            <li class="hide_li">
                                                <a href="#" data-target="#" title="Sort" class="dropdown-toggle waves-effect waves-light sort-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-eye-slash"></i> Hide <i class="fa fa-angle-down" aria-hidden="true"></i>

                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-lg hide_ul">
                                                    <li class="text-center notifi-title">Hide
                                                    </li>
                                                    <li class="list-group">
                                                        <div class="col-md-12">
                                                            <div class="row list_field_div hide_list_group"></div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <?php echo form_close(); ?>


                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-12"></div>
                                <span id="result">
                                    <?php
                                    echo view('templates/filter/filter_course_reports', $data);
                                    ?>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->
        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content-page -->
<script>
    $(document).on('click', '.help', function() {
        $('.pop').toggleClass('popOut');
    })

    $(document).on('click', '.field_details', function() {
        $('.pop').toggleClass('popOut');
    })

    $(document).on('click', '.filter_category', function() {
        $('.pop1').toggleClass('popOut');
    })

    $(document).on('click', '.list_field_div', function() {
        $('.pop2').toggleClass('popOut');
    })

    $(document).on('click', '.help1', function() {
        $('.pop1').toggleClass('popOut');
    })

    $(document).on('click', '.help2', function() {
        $('.pop2').toggleClass('popOut');
    })

    $(document).on('change', '.filter_ajax', function(e) {
        e.preventDefault();

        var content = '';
        content += '<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
        content += '</main>';
        $('#result').html(content);
        form_submit_data();

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
            url: '<?= base_url() ?>admin/Reports/filter_course_reports',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#result').html(response);
                /* $('.filter_ul').removeClass('open_active');
                $('.filter-li').removeClass('open')*/



                $('#course_report').DataTable({
                    aoColumnDefs: [{
                        //orderable : false, aTargets : [4]        
                    }],

                    "dom": '<"dt-buttons"Bf><"clear">lirtp',
                    "autoWidth": true,
                    "buttons": [{
                        text: '<i class="fa fa-file-excel-o"></i> Excel',
                        extend: 'excelHtml5',
                        filename: '<?= date('Y-m-d') ?>_course_reports',
                        messageTop: 'Course Report',
                        title: '',
                        id: 'classlistexl',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }],
                    "order": [],
                    "lengthMenu": [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"]
                    ],
                    "pageLength": -1
                });

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



    $(document).on('click', '.filter-btn-box', function() {
        if ($('.filter-li').hasClass('open')) {
            $('.filter_ul').removeClass('open_active');
        }
    })

    $(document).on('click', '.double_spacing', function() {
        $('td').addClass('cell_two_design');
        $('th').addClass('cell_two_design');
        $(this).addClass('active_color');
        $('.single_spacing').removeClass('active_color');
        $('.spacing-btn-box').addClass('active_color');
    })

    $(document).on('click', '.single_spacing', function() {
        $('td').removeClass('cell_two_design');
        $('th').removeClass('cell_two_design');
        $(this).addClass('active_color');
        $('.double_spacing').removeClass('active_color');
        $('.spacing-btn-box').addClass('active_color')
    })

    $(document).on('click', '.spacing-btn-box', function() {
        $('.filter_ul').removeClass('open_active');
        $('.filter-li').removeClass('open');
    })

    $(document).on('click', '.check_button', function() {
        var table = $('#course_report').DataTable();
        table.order([
            [1, 'asc']
        ]).draw();
    })

    /*$('.stop-noti-box').on('hide.bs.dropdown', function (e) {
        e.stopPropagation();
    });*/
</script>