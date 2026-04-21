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

    .hide_li {
        margin-left: 5px;
    }

    button.dt-button.buttons-excel.buttons-html5 {
        top: -3px !important;
    }

    .outer_div {
        position: relative;
        top: -50px
    }

    #SemesterListing_wrapper {
        margin-top: 6px
    }

    #SemesterListing_filter {
        top: -6px;
        position: relative;
        float: right;
        right: 350px;
    }

    .custum_buttom {
        padding: 7px 10px ! important;
        z-index: 99999;
        position: relative;
        margin-top: 0px !important;
        font-weight: 700;
        color: #5c5c5c ! important;
        background-color: #ffffff ! important;
        font-size: 14px ! important;
        cursor: pointer ! important;
        border-radius: 5px ! important;
        border: 1px solid #e9e6e6 ! important;
        margin-left: -8px;
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
                            <h3 class="panel-title"><?= $title ?>
                                <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">

                                    <div class="col-md-9">
                                        <?php
                                        $attr = array("name" => "filter", "id" => "filter");
                                        echo form_open_multipart('admin/Reports/SemesterList', $attr);
                                        ?>
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
                                                                        <label for="First Name" class="control-label">Course Yr <span class="requires">*</span></label>
                                                                    </div>
                                                                    <div class="col-sm-4 top_maargin">
                                                                        <select class="form-control" id="class" name="class" required>
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

                                                                    <div class="col-md-2 top_maargin">
                                                                        <label for="First Name" class="control-label">Semester <span class="requires">*</span></label>
                                                                    </div>
                                                                    <div class="col-sm-4 top_maargin">
                                                                        <select class="form-control" id="semester" name="semester" required>
                                                                            <option value="">Semester</option>
                                                                            <?php
                                                                            foreach ($semesterlist as $rows) {
                                                                            ?>
                                                                                <option value="<?php echo $rows['Semester']; ?>" <?php if ($selectedSemester == $rows['Semester']) {
                                                                                                                                    echo "Selected='selected'";
                                                                                                                                } ?>><?php echo $rows['Semester']; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-2 top_maargin">
                                                                        <label class="control-label">Course :</label>
                                                                    </div>

                                                                    <div class='col-md-4 top_maargin'>
                                                                        <select class='form-control' name='course' id='course_list'>
                                                                            <option value=''>Please select course</option>
                                                                            <?php
                                                                            if ($course) {
                                                                                foreach ($course as $cr) {
                                                                                    $status = '';
                                                                                    if ($selectedcourse == $cr['CourseID']) {
                                                                                        $status = "selected";
                                                                                    }
                                                                                    echo "<option " . $status . " value='" . $cr['CourseID'] . "'>" . $cr['CourseTitle'] . "</option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>



                                                            </div>
                                                        </div>


                                                        <div class="col-md-12" style="text-align:right;">
                                                            <hr style="margin-bottom: 8px;" />
                                                            <span class="btn btn-success btn-xs filter_ajax">Filter</span>
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
                                    <div class="col-md-3">
                                        <form action="<?= base_url() ?>admin/Reports/export_pdf_SemesterList" method="post" target="_blank">
                                            <input type="hidden" class="form-control" name="class" id="selected_class">
                                            <input type="hidden" class="form-control" name="semester" id="selected_semester">
                                            <input type="hidden" class="form-control" name="course" id="selected_course_list">
                                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                            <button class="custum_buttom" type="submit" style="margin-left:-35px;"><i class="fa fa-file-pdf-o"></i> Export Pdf</button>
                                        </form>
                                    </div>

                                </div>
                                <!-- <table id="SemesterListing" class="table table-striped table-bordered">
    									<thead>
    										<tr>
    											<th>Student First Name</th>
    											<th>Student Last Name</th>
    											<th>CourseID</th>
    											<th>Credit</th>
    											<th>Withdraw</th>
    											  										
    										</tr>
    									</thead>
    							        <tbody> 
											<?php
                                            //echo "<pre>"; print_r($records); die();
                                            if (!empty($records)) {
                                                foreach ($records as $rec) {
                                                    //echo "<pre>"; print_r($rec); die();
                                            ?>
											<tr>
												<td><?php echo $rec['firstname']; ?></td>
												<td><?php echo $rec['lastname']; ?></td>
												<td><?php echo $rec['courseid']; ?></td>
												<td><?php echo $rec['credits']; ?></td>
												<td><?php echo $rec['withdrawn']; ?></td>
											</tr>
											
													<?php }
                                            } ?>
											
											
									</tbody>
    									
    								</table> -->
                                <div class="row outer_div">
                                    <div class="table-responsive">
                                        <span id="result">
                                            <?php
                                            echo view('templates/filter/filter_viewSemesterList', isset($data) ? $data : []);
                                            ?>
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
    $(document).on('change', '#semester', function() {
        var semester_id = $(this).val();
        var year = $('#class option:selected').val();

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
    $(document).on('change', '#class', function() {
        var year = $(this).val();
        var semester_id = $('#semester option:selected').val();
        $.ajax({
            url: '<?= base_url() ?>admin/Reports/getcourse',
            data: {
                semester_id: semester_id,
                year: year,
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
            },
            // dataType: 'json', 
            type: 'post',
            success: function(data) {
                $('#course_list').html(data);
            }
        });

    })

    $(document).on('click', '.filter_ajax', function() {
        var year = $('#class').val()
        var semester = $("#semester").val();
        var course_list = $("#course_list").val();
        if (year == '') {
            $('#class').addClass('invalid');
            $('#class').focus();
            $('#semester').removeClass('invalid');
        } else if (semester == '') {
            $('#class').removeClass('invalid');
            $('#semester').addClass('invalid');
            $('#semester').focus();
        } else {
            $('#class').removeClass('invalid');
            $('#semester').removeClass('invalid');

            $('#selected_class').val(year)
            $("#selected_semester").val(semester);
            $("#selected_course_list").val(course_list);


            filter_progress_loader();

        }
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
            url: '<?= base_url() ?>admin/Reports/filter_SemesterList',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#result').html(response);
                $('#SemesterListing').DataTable({
                    aoColumnDefs: [{
                        //orderable : false, aTargets : [4]        
                    }],
                    "paging": false,

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