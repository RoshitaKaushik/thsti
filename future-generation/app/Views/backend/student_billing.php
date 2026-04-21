<?php //echo "<pre>";print_r($data);die; 

//echo "<pre>"; print_r($this->session->userdata());
?>
<style>
    .modalpopupsss {
        display: none;
    }



    table.table.table-striped.table-bordered th,
    table.table.table-striped.table-bordered td,
    table.table.table-striped.table-bordered td .form-control {
        font-size: 12px;
    }

    input#program_start11,
    input#program_end11,
    #special_start11,
    input#special_end11 {

        display: inline-block;
    }

    .special_start-end-box span {
        display: inline-block !important;
        width: 48%;
        box-sizing: border-box;
        border-right: 1px solid #ddd;
        padding: 7px 4px;
    }

    .waves-effect {
        min-width: 75px;
    }

    .special_start-end-box span:nth-child(2) {
        border-right: none;
    }

    .special_start-end-box {
        padding: 0 !important;
    }

    .special_start-end-box1 {
        padding: 7px 4px !important;
    }

    .table-striped>tbody>tr:nth-of-type(3n+1) {
        background-color: #eae9e9 !important;
    }

    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: transparent;
    }

    .table td.fit,
    .table th.fit {
        white-space: nowrap;
        width: 1%;
    }

    .required:after {
        content: ' *';
        color: red;
        font-weight: bold;
        font-size: 16px;
    }

    td {
        vertical-align: middle !important;
    }

    input.form-control {
        width: 100%;
        text-align: center;
    }

    .table td.fit,
    .table th.fit {
        white-space: nowrap;
        width: 1%;
    }

    .custom-panel {
        margin: 0 auto;
        background-color: transparent;
        border: none;
        border-radius: 2px;
        -webkit-box-shadow: none;
        box-shadow: none;
        transition: 0.3s;
        width: 100%;
        max-width: 250px;
    }

    .custom-panel:hover {
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .custom-panel-heading button {
        border: none;
    }

    .custom-panel-heading {
        border-bottom: none;
        width: 100%;
        color: #333;
        border-color: transparent;
        background-color: transparent;
    }

    .custom-panel-body {
        color: #333;
        background-color: transparent;
        padding: 1rem 0 1rem 0.5rem;
        height: 100%;
        width: 100%;
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;

    }

    .custom-panel-textarea {
        border: 1px solid #eee;
        border-radius: 3px;
        padding: 0.4rem 0.2rem 0 0.2rem;
        height: 100%;
        width: 100%;
        max-width: 250px;
        resize: none;
    }

    .heading_td {
        text-align: right ! important;
    }

    .text_td {
        text-align: left ! important;
    }

    hr {
        border-top: 1px solid #100f0f ! important;
        margin-bottom: 5px ! important;
        margin-top: 5px ! important;
    }
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Semester Year Student Billing Summary Report </h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <h3 class="panel-title">Semester Year Student Billing Summary Report
                                <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <form action="<?= base_url() ?>admin/Finance/student_billing" method="post">
                                <div class="row card" style="margin: 2rem 0 ; display: flex; justify-content:center;">

                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                    <div class="col-md-1">
                                        <label>Class</label>

                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control student_year" name="filter_year">
                                            <!--option value="">All</option-->
                                            <?php
                                            foreach ($editclass as $cl) {
                                                $sec = '';
                                                if (isset($selected_filter_year)) {
                                                    if ($selected_filter_year == $cl['Class']) {
                                                        $sec = "selected";
                                                    }
                                                }
                                            ?>
                                                <option <?= $sec ?> value="<?= $cl['Class'] ?>"><?= $cl['Class'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-1">
                                        <label>Semester</label>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control filter_semester" name="filter_semester">
                                            <option value="">Select Semester </option>
                                            <?php
                                            foreach ($semester_acc_class as $sm) {
                                                $sec = '';
                                                if ($selected_filter_semester == $sm['Semester']) {
                                                    $sec = "selected";
                                                }
                                            ?>

                                                <option <?= $sec ?> value='<?= $sm['Semester'] ?>'><?= $sm['Semester'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">

                                        <input type="submit" class="btn btn-success btn-xs filter_data" value="filter">
                                    </div>



                                </div>
                            </form>
                            <div class="col-sm-12" style='margin-top:20px;'>

                                <div class="table-responsive">


                                    <table id="student_finance" class="table table-striped table-bordered alldataTable">
                                        <thead>
                                            <tr>
                                                <th>Student Name </th>
                                                <th>Total Credits</th>
                                                <th>Tuition</th>
                                                <th>Scholarship</th>
                                                <th>Amount Due</th>

                                            </tr>
                                        </thead>

                                        <tbody id="result">
                                            <?php

                                            $total_tuition  = 0;
                                            $total_scholar  = 0;
                                            $total_student_cost = 0;
                                             $sno=1; 
                                            foreach ($student_finance_course as $sf) {


                                            ?>
                                                <tr>
                                                    <td style="text-align:left;"><?= $sf['FirstName'] . " " . $sf['LastName'] ?></td>
                                                    <td class="fit">
                                                        <?php


                                                        $credit = get_total_credit($sf['id'], $selected_filter_year, $selected_filter_semester);
                                                        echo $credit[0]['total_credit'];
                                                        ?>
                                                    </td>
                                                    <td class="fit">
                                                        <?php
                                                        $tution = get_total_tuition($sf['id'], $selected_filter_year, $selected_filter_semester);
                                                        $get_tuition = array_column($tution, 'total_tuition');
                                                        $get_tuition = array_sum($get_tuition);

                                                        //get tuition adjustment
                                                        $tuition_adjustment = get_total_tuition_adustment($sf['id'], $selected_filter_year, $selected_filter_semester);
                                                        $user_tuition_adj = $tuition_adjustment[0]['total'];
                                                        echo "<div class='row'><div class='col-md-6 heading_td'><b>Course Tuition : </b></div><div class='col-md-6 text_td'>" . number_format($get_tuition, 2) . "</div></div>";

                                                        echo "<div class='row'><div class='col-md-6 heading_td'><b>Tuition Adjustment : </b></div><div class='col-md-6 text_td'>" . number_format($user_tuition_adj, 2) . "</div></div>";



                                                        $curren = $get_tuition - $user_tuition_adj;

                                                        echo "<div class='row'><div class='col-md-12'><hr></div><div class='col-md-6 heading_td'><b>Tuition : </b></div><div class='col-md-6 text_td'>" . number_format($curren, 2) . "</div></div>";


                                                        $total_tuition = $total_tuition + ($get_tuition - $user_tuition_adj);


                                                        ?>

                                                    </td>


                                                    <td class="fit">

                                                        <?php
                                                        $datas =  get_total_scholar_ship_student_by_sem_class($sf['id'], $selected_filter_year, $selected_filter_semester);


                                                        echo "<div class='row'><div class='col-md-6 heading_td'><b>Course Scholarship : </b></div><div class='col-md-6 text_td'>" . number_format(($datas['scholar_amount']) ? $datas['scholar_amount'] : '0.00', 2) . "</div></div>";
                                                        $user_sch_adj = $tuition_adjustment[0]['total_sch'];
                                                        echo "<div class='row'><div class='col-md-6 heading_td'><b>Scholarhip Adjustment : </b></div><div class='col-md-6 text_td'>" . number_format($user_sch_adj, 2) . "</div></div>";



                                                        $curren_sch = $datas['scholar_amount'] - $user_sch_adj;
                                                        echo "<div class='row'><div class='col-md-12'><hr></div><div class='col-md-6 heading_td'><b>Scholarship : </b></div><div class='col-md-6 text_td'>" . number_format($curren_sch, 2) . "</div></div>";


                                                        $total_scholar = $total_scholar + $curren_sch;


                                                        ?>
                                                    </td>
                                                    <td class="fit">

                                                        <?php
                                                        $number = ($get_tuition - $user_tuition_adj) - ($datas['scholar_amount'] - $user_sch_adj);

                                                        echo number_format($number, 2); ?>
                                                    </td>

                                                </tr>
                                            <?php
                                                $sno++;
                                            }

                                            echo "<tr> <th colspan='5' style='text-align:center;'>Certificates</th> </tr>";
                                            
                                            $sno=1; 
                                            foreach ($student_finance_certificate_billing as $sf) {


                                            ?>
                                                <tr>
                                                    <td style="text-align:left;"> <?= $sf['FirstName'] . " " . $sf['LastName'] ?></td>
                                                    <td class="fit">
                                                        <?php
                                                        $credit = get_certificate_total_credit($sf['id'], $selected_filter_year, $selected_filter_semester);
                                                        echo $credit[0]['total_credit'];

                                                        ?>
                                                    </td>
                                                    <td class="fit">
                                                        <?php
                                                        $tution = get_certificate_total_tuition($sf['id'], $selected_filter_year, $selected_filter_semester);

                                                        echo number_format($tution[0]['total_tuition'], 2);
                                                        $total_tuition = $total_tuition + $tution[0]['total_tuition'];
                                                        ?>
                                                    </td>


                                                    <td class="fit">

                                                        <?php
                                                        $datas =  get_total_crtificate_scholar_ship_student_by_sem_class($sf['id'], $selected_filter_year, $selected_filter_semester);
                                                        echo number_format((isset($datas['scholar_amount'])) ? $datas['scholar_amount'] : '0.00', 2);
                                                        $total_scholar = $total_scholar + $datas['scholar_amount'];
                                                        ?>
                                                    </td>
                                                    <td class="fit">

                                                        <?php
                                                        $number = $tution[0]['total_tuition'] - $datas['scholar_amount'];
                                                        echo number_format($number, 2); ?>
                                                    </td>

                                                </tr>
                                            <?php
                                                $sno++;
                                            }

                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <th>Grand Total</th>
                                            <th></th>
                                            <th><?= number_format($total_tuition, 2) ?></th>
                                            <th><?= number_format($total_scholar, 2) ?></th>
                                            <th><?= number_format($total_tuition - $total_scholar, 2) ?></th>

                                        </tfoot>

                                    </table>



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
        $('#alldataTable1').DataTable({

            // "order": [[ 0, "ASC" ]],
            "pageLength": 30
        });
    });

    $(document).on('change', '.student_year', function() {
        var current = $(this).val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo base_url('admin/Form/getSemester'); ?>",
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                'classname': current
            },
            success: function(result) {

                $('.filter_semester').html(result);



            },
        });
    })
</script>