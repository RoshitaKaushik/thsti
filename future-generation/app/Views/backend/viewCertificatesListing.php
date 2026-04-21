<?php //echo "<pre>";print_r($data);die; 

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

    .dataTables_info {
        display: none;
    }

    .top_maargin {
        margin-top: 10px;
    }

    #classListing_filter {
        display: none;
    }

    .buttons-excel {
        top: -51px ! important;
        right: 100px ! important;
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

    /*.buttons-excel
{
    margin-top: 85px;
}*/


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





    .panel-info>.panel-heading {
        background-color: #ffffff;
        border-bottom: 1px solid #d6d6d6 !important;
    }

    .panel-color .panel-title {
        color: #000000;
    }

    h3.panel-title .btn-success {
        font-size: 12px;
        background: #fff;
        color: #000 !important;
        border: 1px solid #d5d5d5;
        padding: 4px 12px;
        margin: 0;
    }



    .custom_hr {
        margin-top: 0px !important;
        margin-bottom: 10px !important;
    }

    .hide_li {
        margin-left: 9px;
    }

    @media (max-width: 767px) {

        .panel-title {
            font-size: 12px;
        }

        h3.panel-title .btn-success {
            font-size: 10px;
        }

        .filter-sub-menu-outer-box {

            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-sub-menu-outer-box li {
            margin: 2px;
        }

        .cell_spacing_li,
        .sort_li,
        .hide_li {
            font-size: 14px;
            cursor: pointer;
            display: block;
            border-radius: 5px;
            border: none;
            display: inherit;
            top: -14px;
            position: inherit;
        }


    }
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Class Listing Reports By Certificates</h4>
    			</div>
    		</div-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <h3 class="panel-title">Class Listing Certificates
                                <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <?php
                                    $attr = array("name" => "filter", "id" => "filter");
                                    echo form_open_multipart('admin/Reports/classListingcertificates', $attr);
                                    ?>
                                    <div class="filter-sub-menu-outer-box">
                                        <li class="dropdown filter-li">
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
                                                                <div class="col-sm-2 top_maargin">
                                                                    <label for="First Name" class="control-label">Certificates</label>
                                                                </div>

                                                                <div class="col-sm-4 top_maargin">
                                                                    <select class="form-control" id="Certificates" name="Certificates">
                                                                        <option value="">Select</option>
                                                                        <?php if (!empty($Certificates)) {
                                                                            foreach ($Certificates as $sl) {
                                                                        ?>
                                                                                <option value="<?= $sl['certID'] ?>" <?php if ($selectedCertificates == $sl['certID']) {
                                                                                                                        echo "selected='selected'";
                                                                                                                    } ?>><?= $sl['CertName'] . "-(" . $sl['cert_no'] . ")" ?></option>
                                                                        <?php }
                                                                        } ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-sm-2 top_maargin">
                                                                    <label for="First Name" class="control-label">Year</label>
                                                                </div>
                                                                <div class="col-sm-4 top_maargin">
                                                                    <!--onchange="submitform();"-->
                                                                    <select class="form-control" id="year" name="class">
                                                                        <option value="">Select</option>
                                                                        <option value="" <?php if ($selectedclass == '') {
                                                                                                echo 'selected';
                                                                                            } ?>>All Years</option>
                                                                        <?php if (!empty($class)) {
                                                                            foreach ($class as $cl) {

                                                                        ?>
                                                                                <option value="<?= $cl['Class'] ?>" <?php if ($selectedclass == $cl['Class']) {
                                                                                                                        echo "selected='selected'";
                                                                                                                    } ?>><?= $cl['Class'] ?></option>
                                                                        <?php }
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-2 top_maargin">
                                                                    <label for="First Name" class="control-label">Semester</label>
                                                                </div>

                                                                <div class="col-sm-4 top_maargin">
                                                                    <select class="form-control" id="semester" name="semester">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        foreach ($semesters as $rec) {
                                                                            $sec1 = "";
                                                                            if ($selectedsemester == $rec['Semester']) {
                                                                                $sec1 = "selected";
                                                                            }
                                                                            echo "<option " . $sec1 . " value='" . $rec['Semester'] . "'>" . $rec['Semester'] . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-sm-2 top_maargin">
                                                                    <label for="First Name" class="control-label">Diploma</label>
                                                                </div>
                                                                <div class="col-sm-4 top_maargin">
                                                                    <select class="form-control" id="diploma" name="diploma">
                                                                        <option value="">All</option>
                                                                        <?php
                                                                        foreach ($diplomas as $dp) {
                                                                            $sec = '';
                                                                            if ($selecteddiploma == encryptor('encrypt', $dp['dipID'])) {
                                                                                $sec = "selected";
                                                                            }
                                                                        ?>
                                                                            <option <?= $sec ?> value="<?= encryptor('encrypt', $dp['dipID']) ?>"><?= $dp['dipName'] ?></option>
                                                                        <?php

                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2 top_maargin">
                                                                    <label for="level" class="control-label">Level</label>
                                                                </div>
                                                                <div class="col-md-4 top_maargin">
                                                                    <select id="level" name="level" class="form-control">
                                                                        <option value="">Select Graduate/Undergradraduate</option>
                                                                        <option <?php if ($selectedlevel == 'G') {
                                                                                    echo 'selected';
                                                                                } ?> value="G">Graduate</option>
                                                                        <option <?php if ($selectedlevel == 'U') {
                                                                                    echo 'selected';
                                                                                } ?> value="U">Undergraduate</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 top_maargin text-right">
                                                        <hr class="custom_hr">
                                                        <input class="btn btn-success btn-xs filter_button" name="submit" type="submit" value="Filter">
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
                                    <?php echo form_close(); ?>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <div class="col-md-12">
                                        <form method="post" action="<?= base_url() ?>admin/Reports/export_pdf_certficate_class_semesrer_list" target="_blank">
                                            <input type="hidden" name="Certificates" id="selectedCertificates" value="<?= $selectedCertificates ?>">
                                            <input type="hidden" name="class" id="selectedclass" value="<?= $selectedclass ?>">
                                            <input type="hidden" name="semester" id="selectedsemester" value="<?= $selectedsemester ?>">
                                            <input type="hidden" name="diploma" id="selecteddiploma" value="<?= $selecteddiploma ?>">
                                            <input type="hidden" name="level" id="selectedlevel" value="<?= $selectedlevel ?>">
                                            <input type="hidden"
                                                name="<?= csrf_token() ?>"
                                                value="<?= csrf_hash() ?>">

                                            <button type="submit" class="btn btn-purple pull-right">
                                                <i class="fa fa-file-pdf-o"></i>
                                                <span><strong>PDF</strong></span>
                                            </button>
                                        </form>
                                        <!--<button type="button" id="generatepdf" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right"><i class="fa fa-file-pdf-o"></i>
											<span><strong>PDF</strong></span></button>-->
                                    </div>
                                </div>


                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">

                                        <span id="result">
                                            <?php echo view('templates/filter/filter_viewCertificatesListing', isset($data) ? $data : []) ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->
        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content-page -->
<script>
    /*
$(document).on('change','#year',function(){
    var data = $(this).val();
    
    $.ajax({
     url:'<?= base_url() ?>admin/Form/getSemester',
     method: 'post',
     data: {classname: data},
     dataType: 'html',
     success: function(response){
            $('#semester').html(response);
       }
 
     })
   });*/



    /*function submitform(){
    	$('#filter').submit();
    }*/
    $(document).on("click", "#generatepdf", function() {
        //window.location.href = '<?php //echo  base_url("admin/PdfBuilder/classReportPdf/");
                                    ?><?php //echo encryptor('encrypt',$selectedclass);
                                                                                                ?>';
        window.open('<?php echo base_url("admin/PdfBuilder/CertificatesReportPdf/"); ?><?php echo encryptor('encrypt', $selectedclass); ?>/<?php echo encryptor('encrypt', $selectedCertificates); ?>', '_blank');
    });


    $(document).on('click', '.filter_button', function(e) {
        e.preventDefault();
        let Certificates = $('#Certificates').val();
        let year = $('#year').val();
        let semester = $('#semester').val();
        let diploma = $('#diploma').val();
        let level = $('#level').val();
        $('#selectedCertificates').val(Certificates);
        $('#selectedclass').val(year);
        $('#selectedsemester').val(semester);
        $('#selecteddiploma').val(diploma);
        $('#selectedlevel').val(level);
        filter_data();

    })


    $(document).on('change', '.filter_ajax', function() {
        filter_data();
    })

    function filter_data() {
        var content = '';
        content += '<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
        content += '</main>';
        $('#result').html(content);

        var formname = '';
        formname = $("#filter");
        var formData = new FormData($('#filter')[0]);
        formData.append("submit", "filter");
        formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: '<?= base_url() ?>admin/Reports/filter_classListingcertificates',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('.filter-li').removeClass('open');
                $('#result').html(response);
                $('#classListing').DataTable({
                    "dom": '<"dt-buttons"Bf><"clear">lirtp',
                    "paging": false,
                    "autoWidth": true,
                    "buttons": [{
                        text: '<i class="fa fa-file-excel-o"></i> Excel',
                        messageTop: 'CLASS LISTING REPORTS BY CERTIFICATES',
                        extend: 'excelHtml5',
                        filename: '2022-07-07_class_listing_reports',
                        footer: true,
                        title: '',
                        id: 'classlistexl'
                    }],
                    "order": [],
                });

                listing_table_field();

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
</script>