<?php //echo "<pre>";print_r($data);die; 
//echo "<pre>"; print_r($this->session->userdata());
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    #classListing_filter {
        display: none;
    }

    .buttons-excel {
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

    #SemesterListing_filter {
        position: relative;
        margin-bottom: 11px;
    }

    .export_button {
        display: none;
    }

    .filter_ul {
        width: 680px !important;
    }
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title"></h4>
    			</div>
    		</div-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <h3 class="panel-title">Specific Grade Reports
                                <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="filter-sub-menu-outer-box">
                                            <?php
                                            $attr = array("name" => "filter", "id" => "filter");
                                            echo form_open_multipart('admin/Reports/gradereport', $attr);
                                            ?>
                                            <div class="stop-noti-box">
                                                <li class="dropdown hidden-xs filter-li">
                                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-filter"></i>Filter <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-lg filter_ul">
                                                        <li class="text-center notifi-title">Filter</li>
                                                        <li class="list-group">

                                                            <div class="col-sm-12 filter_category">
                                                                <div class="form-group">
                                                                    <div class="row top_maargin">
                                                                        <div class="col-sm-2">
                                                                            <label for="First Name" class="control-label">Course Yr <span class="requires">*</span></label>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <select class="form-control filter_ajax" id="class" name="class" required>
                                                                                <option value="">Select</option>
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

                                                                        <div class="col-sm-2">
                                                                            <label for="First Name" class="control-label">Course Yr (To)<span class="requires">*</span></label>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <select class="form-control filter_ajax" id="class_to" name="class_to" required>
                                                                                <option value="">Select</option>
                                                                                <?php if (!empty($class)) {
                                                                                    foreach ($class_to as $cl) {
                                                                                ?>
                                                                                        <option value="<?= $cl['Class'] ?>" <?php if ($selectedclassto == $cl['Class']) {
                                                                                                                                echo "selected='selected'";
                                                                                                                            } ?>><?= $cl['Class'] ?></option>
                                                                                <?php }
                                                                                } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row top_maargin">
                                                                        <div class="col-sm-2">
                                                                            <label for="First Name" class="control-label">Semester</label>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <select class="form-control filter_ajax" id="semester" name="semester">
                                                                                <option value="">Semester</option>
                                                                                <?php
                                                                                foreach ($semesterlist as $rows) {
                                                                                ?>
                                                                                    <option value="<?php echo $rows['Semester']; ?>" <?php if ($selectedSemester == $rows['Semester']) {
                                                                                                                                        echo "Selected='selected'";
                                                                                                                                    } ?>><?php echo $rows['Semester']; ?></option>

                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>

                                                                        <div class='col-md-2'>
                                                                            <label class="control-label">Course :</label>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <select class='form-control filter_ajax' name='course' id='course_list'>
                                                                                <option value=''>Please select course</option>
                                                                                <?php
                                                                                if ($course) {
                                                                                    foreach ($course as $cr) {
                                                                                        $status = '';
                                                                                        if ($selectedcourse == $cr['Course'] && $selected_course_title == $cr['CourseTitle']) {
                                                                                            $status = "selected";
                                                                                        }
                                                                                        echo "<option " . $status . " value='" . $cr['Course'] . "'>" . $cr['CourseTitle'] . "(" . $cr['Course'] . ")</option>";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <input type='hidden' value='<?= $selected_course_title ?>' name='course_title' class='form-control' id='course_title'>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row top_maargin">
                                                                        <div class="col-sm-2">
                                                                            <label class="control-label">Specific Grade </label> <span class="requires">*</span>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <select class='form-control filter_ajax grade_type' name='type'>
                                                                                <option <?php if (isset($selected_grade) == 'W') {
                                                                                            echo 'selected';
                                                                                        } ?> value='W'>Course Withdrawal Report</option>
                                                                                <option <?php if (isset($selected_grade) == 'F') {
                                                                                            echo 'selected';
                                                                                        } ?> value='F'>Course Fail Report</option>
                                                                                <option <?php if (isset($selected_grade) == 'I') {
                                                                                            echo 'selected';
                                                                                        } ?> value='I'>Course Incomplete Report</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 top_maargin text-right">
                                                                <hr class="custom_hr" style="margin:0px;">
                                                                <span class="btn btn-success btn-xs filter_button" style="margin-top:10px;margin-bottom:10px;">Filter</span>
                                                            </div>

                                                        </li>
                                                    </ul>
                                                </li>
                                            </div>
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

                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="z-index:999">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <form action='<?= base_url('admin/Reports/export_pdf_grade_report') ?>' method='post' target="_blank">
                                                  <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                    <input type='hidden' class="selected_class" name='class' value='<?php echo $selectedclass ?>'>
                                                    <input type='hidden' class="selected_semester" name='semester' value='<?php echo $selectedSemester ?>'>
                                                    <input type='hidden' class="selected_course" name='course' required value='<?php echo $selectedcourse ?>'>
                                                    <input type='hidden' class="selected_title" name='title' value='Semester Grade Report' />
                                                    <input type='hidden' class="selected_class_to" name='class_to' value='<?= $selectedclassto ?>'>
                                                    <input type='hidden' class="selected_course_title" value='<?= $selected_course_title ?>' name='course_title' class='form-control'>
                                                    <input type='hidden' class="selected_type" name='type' value='<?php if (isset($selected_grade) != '') {
                                                                                                                        echo $selected_grade;
                                                                                                                    } else {
                                                                                                                        echo 'W';
                                                                                                                    } ?>'><br />
                                                    <button type="submit" onclick='return check_data()' class='btn btn-primary btn-xs custum_buttom export_button'>
                                                        <span class="fa fa-file-pdf-o"></span>&nbsp;Export Pdf
                                                    </button>
                                                    <!--	<input type='submit' value='Export Pdf' onclick='return check_data()' class='btn btn-primary btn-sm' style='float:right;'>
									-->
                                                </form>
                                            </div>
                                            <div class="col-md-6">
                                                <form action='<?= base_url('admin/Reports/export_grade_report_excell') ?>' method='post' target="_blank">
                                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                    <input type='hidden' class="selected_class" name='class' value='<?php echo $selectedclass ?>'>
                                                    <input type='hidden' class="selected_semester" name='semester' value='<?php echo $selectedSemester ?>'>
                                                    <input type='hidden' class="selected_course" name='course' required value='<?php echo $selectedcourse ?>'>
                                                    <input type='hidden' class="selected_title" name='title' value='Semester Grade Report' />
                                                    <input type='hidden' class="selected_class_to" name='class_to' value='<?= $selectedclassto ?>'>
                                                    <input type='hidden' class="selected_course_title" value='<?= $selected_course_title ?>' name='course_title' class='form-control'>
                                                    <input type='hidden' class="selected_type" name='type' value='<?php if (isset($selected_grade) != '') {
                                                                                                                        echo $selected_grade;
                                                                                                                    } else {
                                                                                                                        echo 'W';
                                                                                                                    } ?>'><br />

                                                    <button type="submit" onclick='return check_data1()' class='btn btn-primary btn-xs custum_buttom export_button' style='float:right;'>
                                                        <span class="fa fa-file-excel-o"></span>&nbsp;Export Excel
                                                    </button>

                                                    <!--<input type='submit' value='Export Excel' onclick='return check_data1()' class='btn btn-primary btn-sm' style='float:right;'>
    										-->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-sm-12 outter_div" id="result">

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
    $(document).on('change', '#course_list', function() {
        var selectedText = $("#course_list option:selected").html();
        selectedText = selectedText.substring(0, selectedText.indexOf('('));
        $('#course_title').val(selectedText);
        $('.selected_course_title').val(selectedText);
        $('.selected_course').val($(this).val())
    })

    $(document).on('change', '#class_to', function() {
        var year = $('#class option:selected').val();
        var year_to = $(this).val();
        $('.selected_class_to').val(year_to);
        var semester_id = $('#semester option:selected').val();
        $.ajax({
            url: '<?= base_url() ?>admin/Reports/get_course_in_range',
            data: ({
                semester_id: semester_id,
                year: year,
                year_to: year_to,
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
            }),
            // dataType: 'json', 
            type: 'post',
            success: function(data) {
                $('#course_list').html(data);
            }
        });
    })

    $(document).on('change', '#semester', function() {
        var semester_id = $(this).val();
        $('.selected_semester').val(semester_id);
        var year = $('#class option:selected').val();

        var year_to = $('#class_to option:selected').val();
        $.ajax({
            url: '<?= base_url() ?>admin/Reports/get_course_in_range',
            data: ({
                semester_id: semester_id,
                year: year,
                year_to: year_to,
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
            }),
            // dataType: 'json', 
            type: 'post',
            success: function(data) {
                $('#course_list').html(data);
            }
        });
    })
    $(document).on('change', '#class', function() {
        $('#class_to').html('');
        var year = $(this).val();
        $('.selected_class').val(year);
        var semester_id = $('#semester option:selected').val();

        $.ajax({
            url: '<?= base_url() ?>admin/Reports/get_higher_class',
            data: ({
                year: year,
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
            }),
            // dataType: 'json', 
            type: 'post',
            success: function(data) {
                $('#class_to').html(data);
            }
        });



        $.ajax({
            url: '<?= base_url() ?>admin/Reports/getcourse',
            data: ({
                semester_id: semester_id,
                year: year,
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
            }),
            // dataType: 'json', 
            type: 'post',
            success: function(data) {
                $('#course_list').html(data);
            }
        });

    })

    $(document).on('change', '.grade_type', function() {
        var grade = $(this).val();
        $('.selected_type').val(grade);
    })

    function check_data1() {
        var data = '<?php echo $selectedclass ?>';
        if (data == '') {
            alert('Please Filter Data');
            return false
        } else {
            return true;
        }

    }

    function check_data() {
        var data = '<?php echo $selectedclass ?>';
        if (data == '') {
            alert('Please Filter Data');
            return false
        } else {
            return true;
        }
    }

    /*$(document).on('change','.filter_ajax',function(e){
        var class_from = $('#class').val();
        var class_to   = $('#class_to').val();
        if((class_from != null && class_to != null) && (class_from != '' && class_to != ''))
        {
            filter_progress_loader(); 
        }
    })*/
    function form_submit_data() {
        $('.export_button').show();
        var formname = '';
        formname = $("#filter");
        var formData = new FormData($('#filter')[0]);
        formData.append("submit", "filter");
        formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: '<?= base_url() ?>admin/Reports/filter_grade_report',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('.filter-li').removeClass('open');
                $('.outter_div').html(response);

                $('#SemesterListing').DataTable({
                    "dom": '<"dt-buttons excel_position"Bf><"clear">lirtp',
                    "paging": false,
                    "autoWidth": true,
                    "buttons": [{
                        text: '<span class=""><i class="fa fa-file-excel-o"></i> Excel</span>',
                        extend: 'excelHtml5',
                        filename: '<?= date('Y-m-d') ?>_Semester_listing_reports',
                        footer: true,
                        /*responsive: true*/
                        title: '',
                        id: 'classlistexl'
                    }]
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

    $(document).on('click', '.filter_button', function(e) {
        var class_from = $('#class').val();
        var class_to = $('#class_to').val();
        let classFrom = $('#class').val();
        let classTo = $('#class_to').val();
        if (classFrom == '') {
            $('#class').addClass('invalid');
            $('#class').focus();
            $('#class_to').removeClass('invalid');
        } else if (classTo == '') {
            $('#class').removeClass('invalid');
            $('#class_to').addClass('invalid');
            $('#class_to').focus();
        } else {
            $('#class').removeClass('invalid');
            $('#class_to').removeClass('invalid');
            filter_progress_loader();
        }
    })
</script>