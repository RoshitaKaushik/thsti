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

    #SemesterListing_filter {
        float: left;
    }

    .buttons-excel {
        display: none;
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

    th {
        text-align: left ! Important;
    }

    td {
        text-align: left ! Important;
    }

    #SemesterListing_filter {
        position: relative;
        margin-bottom: 15px;
    }

    .top_level {
        z-index: 999;

    }

    .dataTables_length {
        display: none;
    }
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Semester Course Reports</h4>
    			</div>
    		</div-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <h3 class="panel-title">Semester Course Reports
                                <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="filter-sub-menu-outer-box">
                                            <?php
                                            $attr = array("name" => "filter", "id" => "filter");
                                            echo form_open_multipart('admin/Reports/dynamicreport', $attr);
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

                                                                    <div class="row">
                                                                        <div class="col-sm-2 top_maargin">
                                                                            <label for="class" class="control-label">Course Yr (From)<span class="requires">*</span></label>
                                                                        </div>
                                                                        <div class="col-sm-4 top_maargin stop_hide_after_selection_class">
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


                                                                        <div class="col-sm-2 top_maargin ">
                                                                            <label for="class_to" class="control-label">Course Yr (To)<span class="requires">*</span></label>
                                                                        </div>
                                                                        <div class="col-sm-4 top_maargin stop_hide_after_selection_class">
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

                                                                    <div class="row">
                                                                        <div class="col-sm-2 top_maargin">
                                                                            <label for="First Name" class="control-label">Semester</label>
                                                                        </div>
                                                                        <div class="col-sm-4 top_maargin stop_hide_after_selection_class">
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

                                                                        <div class="col-sm-2 top_maargin">
                                                                            <label class="control-label">Course :</label>
                                                                        </div>
                                                                        <div class="col-sm-4 top_maargin stop_hide_after_selection_class">
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


                                                                        <!--input class="btn btn-success btn-xs" name="submit" type="submit" value="Filter" style='margin-top:6px;'-->
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
                                    <div class="col-md-3 top_level">
                                        <div class="col-md-6">
                                            <form action='<?= base_url('admin/Reports/export_pdf_dynamicreport') ?>' method='post' target="_blank">
                                                <?= csrf_field() ?>

                                                <input type='hidden' class="selected_class" name='class' value='<?php echo $selectedclass ?>'>
                                                <input type='hidden' class="selected_semester" name='semester' value='<?php echo $selectedSemester ?>'>
                                                <input type='hidden' class="selected_course" name='course' required value='<?php echo $selectedcourse ?>'>
                                                <input type='hidden' class="selected_title" name='title' value='Semester Course Report' />
                                                <input type='hidden' class="selected_class_to" name='class_to' value='<?= $selectedclassto ?>'>
                                                <input type='hidden' class="selected_course_title" value='<?= $selected_course_title ?>' name='course_title' class='form-control'>
                                                <input type='hidden' class="selected_grade" name='type' value='<?= isset($selected_grade) ?>'><br />
                                                <input type='submit' value='Export Pdf' onclick='return check_data()' class='btn btn-primary btn-sm custum_buttom' style='float:right;'>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <form action='<?= base_url('admin/Reports/export_excell_dynamicreport') ?>' method='post' target="_blank">
                                                <?= csrf_field() ?>
                                                <input type='hidden' class="selected_class" name='class' value='<?php echo $selectedclass ?>'>
                                                <input type='hidden' class="selected_semester" name='semester' value='<?php echo $selectedSemester ?>'>
                                                <input type='hidden' class="selected_course" name='course' required value='<?php echo $selectedcourse ?>'>
                                                <input type='hidden' class="selected_title" name='title' value='Semester Course Report' />
                                                <input type='hidden' class="selected_class_to" name='class_to' value='<?= $selectedclassto ?>'>
                                                <input type='hidden' class="selected_course_title" value='<?= $selected_course_title ?>' name='course_title' class='form-control'>
                                                <input type='hidden' class="selected_grade" name='type' value='<?= isset($selected_grade) ?>'><br />
                                                <input type='submit' value='Export Excel' onclick='return check_data1()' class='btn btn-primary btn-sm custum_buttom'>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-md-12 col-sm-12 col-xs-12 outter_div">

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
        selectedText = selectedText.replace('&nbsp;', '').trim();
        $('#course_title').val(selectedText);
        $('.selected_course').val($(this).val());


    })


    // Check yr to select or not if select then large value selected in to date
    $(document).on('change', '#class_to', function() {

        var year = $('#class option:selected').val();
        var year_to = $(this).val();
        var semester_id = $('#semester option:selected').val();

        $('.selected_class_to').val(year_to);

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

    function form_submit_data() {
        var formname = '';
        formname = $("#filter");
        var formData = new FormData($('#filter')[0]);
        formData.append("submit", "filter");
        formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: '<?= base_url() ?>admin/Reports/filter_dynamicreport',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('.filter-li').removeClass('open');
                $('.outter_div').html(response);
                $('#SemesterListing').DataTable({
                    aoColumnDefs: [{
                        //orderable : false, aTargets : [4]
                    }],

                    "dom": '<"dt-buttons"Bf><"clear">lirtp',
                    "autoWidth": true,
                    "buttons": [{
                        text: '<i class="fa fa-file-excel-o"></i> Excel',
                        extend: 'excelHtml5',
                        filename: 'course_reports',
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


            }
        });
    }

    /*$(document).on('change','.filter_ajax',function(){
        var content = '';
            content+='<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
            content+='</main>';
            $('.outter_div').html(content);
        form_submit_data();
    }) */


    $(document).on('click', '.filter_button', function(e) {
        e.preventDefault();
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
            var content = '';
            content += '<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
            content += '</main>';
            $('.outter_div').html(content);
            form_submit_data();
        }

    })
</script>