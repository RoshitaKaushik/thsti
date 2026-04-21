<link href="<?= base_url() ?>/assets/select2.min.css" rel="stylesheet" />
<script src="<?= base_url() ?>/assets/select2.min.js"></script>
<?php
$finane = getfinancialyear_june(date("d-m-Y"));
$finanyre = explode("-", $finane);
$first_datee = $finanyre[0];
$last_datee = $finanyre[1];
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
</style>
<!-- coded by bajrang -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <?php $total_days_month = date('t'); ?>
                            <h3 class="panel-title">Individual Fiscal Yr Report <span style="position: absolute;left: 46%;"> <?php echo $_SESSION['admin_fullname']; ?></span>
                                <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-12">
                                    <?php
                                    $attr = array("class" => "form-horizontal");
                                    echo form_open("admin/timesheet/admin_indivisual_report", $attr);
                                    ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="">Users:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="User_option" name="User_option" class=" form-control select2">
                                                    <?php foreach ($facultystaff as  $staff) { ?>
                                                        <option value="<?php echo $staff['ID'] ?>" <?php if ($empid == $staff['ID']) {
                                                                                                        echo "selected";
                                                                                                    } ?>>
                                                            <?php echo $staff['FirstName'] . " " . $staff['LastName'] . "(" . $staff['ID'] . ")"; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" style="">
                                            <div class="col-md-5">
                                                <label for="">Select Fiscal Year:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <select id="Financial_Y" name="Financial_Y" class=" form-control">
                                                    <option value="<?= $selected_year ?>"><?= $selected_year ?></option>
                                                    <?php foreach ($fisical_year as $fyy_year) {  ?>
                                                        <option value="<?php echo $fyy_year; ?>" <?php if ($selected_year == $fyy_year) {
                                                                                                        echo "selected";
                                                                                                    } elseif (isset($post['Financial_Y']) && $post['Financial_Y'] == $fyy_year) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $fyy_year; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="submit" class="btn-xs btn btn-success" value="Search">
                                    </div>
                                    <?php echo form_close(); ?>

                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <span style="position: absolute;left: 3%; font-weight: bold;"> <!-- <?php echo "Total July " . $first_datee . " - June " . $last_datee; ?> -->
                                            <?php echo "Total  " . $selected_year; ?>
                                        </span>
                                        <button style="margin-top: -31px" onclick="fnExcelReport('attendance_report')" class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="classListing"><span><i class="fa fa-file-excel-o"></i> Excel</span></button>
                                        <!--button type="button" id="generatepdf" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right"><i class="fa fa-file-pdf-o"></i>
                                            <span><strong>PDF</strong></span></button-->
                                    </div>
                                </div>
                                <div class="col-md-12 table-responsive">
                                    <table id="attendance_report" class="table table-striped table-bordered " style="font-size: 12px;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Jul </th>
                                                <th>Aug</th>
                                                <th>Sep</th>
                                                <th>Oct</th>
                                                <th>Nov</th>
                                                <th>Dec</th>
                                                <th>Jan</th>
                                                <th>Feb</th>
                                                <th>Mar</th>
                                                <th>Apr</th>
                                                <th>May</th>
                                                <th>Jun</th>
                                                <th style="font-weight: bold;">Total Hrs</th>
                                                <th>Total Days</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $atendanceof_july = array();
                                            $atendanceof_aug = array();
                                            $atendanceof_sept = array();
                                            $atendanceof_oct = array();
                                            $atendanceof_nov = array();
                                            $atendanceof_dec = array();
                                            $atendanceof_jan = array();
                                            $atendanceof_feb = array();
                                            $atendanceof_march = array();
                                            $atendanceof_april = array();
                                            $atendanceof_may = array();
                                            $atendanceof_june = array();
                                            $grandsum = array();
                                            foreach ($records_category as $value) {
                                                $sum_array = array(); ?>
                                                <tr>
                                                    <td style="text-align: left; "><?= $value['catagory_name'] ?></td>
                                                    <td>
                                                        <?php foreach ($records as $key => $valuee) {
                                                            if ($valuee['month'] == '7'  && $value['id'] == $valuee['category_id']) {
                                                                echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                $atendanceof_july[] = $sum_array[] = $grandsum[] = $hr_min;
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php foreach ($records as $key => $valuee) {
                                                            if ($valuee['month'] == '8'  && $value['id'] == $valuee['category_id']) {
                                                                echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                $atendanceof_aug[] = $sum_array[] = $grandsum[] = $hr_min;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php foreach ($records as $key => $valuee) {
                                                            if ($valuee['month'] == '9'  && $value['id'] == $valuee['category_id']) {
                                                                echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                $atendanceof_sept[] = $sum_array[] = $grandsum[] = $hr_min;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php foreach ($records as $key => $valuee) {
                                                            if ($valuee['month'] == '10'  &&  $value['id'] == $valuee['category_id']) {
                                                                echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                $atendanceof_oct[] = $sum_array[] = $grandsum[] = $hr_min;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php foreach ($records as $key => $valuee) {
                                                            if ($valuee['month'] == '11'  && $value['id'] == $valuee['category_id']) {
                                                                echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                $atendanceof_nov[] = $sum_array[] = $grandsum[] = $hr_min;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php foreach ($records as $key => $valuee) {
                                                            if ($valuee['month'] == '12'  && $value['id'] == $valuee['category_id']) {
                                                                echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                $atendanceof_dec[] = $sum_array[] = $grandsum[] = $hr_min;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php foreach ($records as $key => $valuee) {
                                                            if ($valuee['month'] == '1'  && $value['id'] == $valuee['category_id']) {
                                                                echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                $atendanceof_jan[] = $sum_array[] = $grandsum[] = $hr_min;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php foreach ($records as $key => $valuee) {
                                                            if ($valuee['month'] == '2'  && $value['id'] == $valuee['category_id']) {
                                                                echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                $atendanceof_feb[] = $sum_array[] = $grandsum[] = $hr_min;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php foreach ($records as $key => $valuee) {
                                                            if ($valuee['month'] == '3'  && $value['id'] == $valuee['category_id']) {
                                                                echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                $atendanceof_march[] = $sum_array[] = $grandsum[] = $hr_min;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php foreach ($records as $key => $valuee) {
                                                            if ($valuee['month'] == '4'  && $value['id'] == $valuee['category_id']) {
                                                                echo $hr_min = hourMinuteFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                $atendanceof_april[] = $sum_array[] = $grandsum[] = $hr_min;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php foreach ($records as $key => $valuee) {
                                                            if ($valuee['month'] == '5'  && $value['id'] == $valuee['category_id']) {
                                                                echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                $atendanceof_may[] = $sum_array[] = $grandsum[] = $hr_min;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php foreach ($records as $key => $valuee) {
                                                            if ($valuee['month'] == '6'  && $value['id'] == $valuee['category_id']) {
                                                                echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                $atendanceof_june[] = $sum_array[] = $grandsum[] = $hr_min;
                                                            }
                                                        } ?>
                                                    </td>

                                                    <td style=" font-weight: bold;">
                                                        <?php foreach ($sum_hr_cat as ${'sumcat_' . $value['id']}) {
                                                            if (${'sumcat_' . $value['id']}['category_id'] == $value['id']) {
                                                                echo @$tot_hr = hourdecFormating(${'sumcat_' . $value['id']}['t_hours'], ${'sumcat_' . $value['id']}['t_minutes']);
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td style=" font-weight: bold;">
                                                        <?php foreach ($sum_hr_cat as ${'sumcat_' . $value['id']}) {
                                                            if (${'sumcat_' . $value['id']}['category_id'] == $value['id']) {
                                                                @$tot_hr = hourdecFormating(${'sumcat_' . $value['id']}['t_hours'], ${'sumcat_' . $value['id']}['t_minutes']);
                                                                echo calc_hrtodays($tot_hr);
                                                            }
                                                        } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr style=" font-weight: bold;">
                                                <td>TOTAL : </td>
                                                <td>
                                                    <?php
                                                    foreach ($sum_hr_mnth as  $djuly) {
                                                        if ($djuly['month'] == '7') {
                                                            echo $julytht = hourdecFormating($djuly['t_hours'], $djuly['t_minutes']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($sum_hr_mnth as  $daug) {
                                                        if ($daug['month'] == '8') {
                                                            echo $augthr = hourdecFormating($daug['t_hours'], $daug['t_minutes']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($sum_hr_mnth as  $dsept) {
                                                        if ($dsept['month'] == '9') {
                                                            echo $septhr = hourdecFormating($dsept['t_hours'], $dsept['t_minutes']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($sum_hr_mnth as  $doct) {
                                                        if ($doct['month'] == '10') {
                                                            echo $octhr = hourdecFormating($doct['t_hours'], $doct['t_minutes']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($sum_hr_mnth as  $dnov) {
                                                        if ($dnov['month'] == '11') {
                                                            echo $novthr = hourdecFormating($dnov['t_hours'], $dnov['t_minutes']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($sum_hr_mnth as  $ddec) {
                                                        if ($ddec['month'] == '12') {
                                                            echo $decthr = hourdecFormating($ddec['t_hours'], $ddec['t_minutes']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($sum_hr_mnth as  $djan) {
                                                        if ($djan['month'] == '1') {
                                                            echo $janthr = hourdecFormating($djan['t_hours'], $djan['t_minutes']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($sum_hr_mnth as  $dfeb) {
                                                        if ($dfeb['month'] == '2') {
                                                            echo $febthr = hourdecFormating($dfeb['t_hours'], $dfeb['t_minutes']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($sum_hr_mnth as  $dmar) {
                                                        if ($dmar['month'] == '3') {
                                                            echo $marthr = hourdecFormating($dmar['t_hours'], $dmar['t_minutes']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($sum_hr_mnth as  $dapr) {
                                                        if ($dapr['month'] == '4') {
                                                            echo $aprthr = hourdecFormating($dapr['t_hours'], $dapr['t_minutes']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($sum_hr_mnth as  $dmay) {
                                                        if ($dmay['month'] == '5') {
                                                            echo $maythr = hourdecFormating($dmay['t_hours'], $dmay['t_minutes']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($sum_hr_mnth as  $djune) {
                                                        if ($djune['month'] == '6') {
                                                            echo $junthr = hourdecFormating($djune['t_hours'], $djune['t_minutes']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $gsumhr = hourdecFormating($sum_hr['t_hours'], $sum_hr['t_minutes']); ?>
                                                </td>
                                                <td>
                                                    <?= calc_hrtodays($gsumhr); ?>
                                                </td>
                                            </tr>
                                            <?php

                                            if (isset($param['hours_to_work'])) {
                                                $param['hours_to_work'] = $Sum_hour_contract = (float)($Sum_hour_contract);
                                                $param['cary_hours_to_work'] = ($cary_Sum_hour_contract);
                                                if (isset($main_sum_hr)) {
                                                    $param['hours_worked'] =  $main_sum_hr['t_hours'];
                                                    $param['minutes_worked'] = $main_sum_hr['t_minutes'];
                                                }
                                                $total_worked = (float)hourdecFormating($param['hours_worked'], $param['minutes_worked']);
                                                $dif = (float)"80.00";
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php if (!empty($contractor_details)) { ?>
                                        <div class="col-md-12" style="padding: top;padding-top:20px;padding-left:17px;">
                                            <?php if ($contractor_details[0]['min_contact_id'] != $contractor_details[0]['max_contact_id']) {
                                                echo "<span class='btn btn-success btn-xs'>Linked Contract Details (" . date('m/d/Y', strtotime($contractor_details[0]['contract_begin_date'])) . "  -  " . date('m/d/Y', strtotime($contractor_details[0]['contract_end_date'])) . ")</span>";
                                            } ?>
                                        </div>
                                    <?php }  ?>

                                    <div class="col-md-12" style="padding: top;padding-top:30px;">
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Number of Days Contracted:
                                        </div>
                                        <div class="col-md-2">
                                            <?php if (isset($param)) {
                                                echo (number_format((float)$param['hours_to_work'] / 8, 2, '.', ''));
                                            } ?>
                                        </div>
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Number of Hours Contracted:
                                        </div>
                                        <div class="col-md-2">
                                            <?php if (isset($param)) {
                                                echo (number_format((float)$param['hours_to_work'], 2, '.', ''));
                                            } ?>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Number of Days Carried Over :
                                        </div>
                                        <div class="col-md-2">
                                            <?php if (isset($param)) {
                                                echo (number_format((float)$param['cary_hours_to_work'] / 8, 2, '.', ''));
                                            }  ?>
                                        </div>
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Number of Hours Carried Over :
                                        </div>
                                        <div class="col-md-2">
                                            <?php if (isset($param)) {
                                                echo (number_format((float)$param['cary_hours_to_work'], 2, '.', ''));
                                            } ?>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Days Worked:
                                        </div>
                                        <div class="col-md-2">
                                            <?php if (isset($main_sum_hr)) {
                                                $grandsumhr = hourdecFormating($main_sum_hr['t_hours'], $main_sum_hr['t_minutes']);
                                            } ?>
                                            <?= @calc_hrtodays($grandsumhr) ?>
                                        </div>
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Hours Worked:
                                        </div>
                                        <div class="col-md-2">
                                            <?php if (isset($main_sum_hr)) {
                                                echo    $grandsumhr = hourdecFormating($main_sum_hr['t_hours'], $main_sum_hr['t_minutes']);
                                            }  ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Days Left to Work:
                                        </div>
                                        <div class="col-md-2">
                                            <?php if (isset($total_worked)) {
                                                if ($total_worked > $Sum_hour_contract) {
                                                    echo "0.00";
                                                } else {
                                                    echo @calc_hrtodays($Sum_hour_contract - $total_worked);
                                                }
                                            } ?>
                                        </div>
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Hours Left to Work:
                                        </div>
                                        <div class="col-md-2">
                                            <?php if (isset($total_worked)) {
                                                if ($total_worked > $Sum_hour_contract) {
                                                    echo "0.00";
                                                } else {
                                                    echo ($Sum_hour_contract - $total_worked);
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="col-md-4" style="font-weight: bold;">
                                            Carry Forward Days:

                                        </div>
                                        <div class="col-md-2">
                                            <?php
                                            if (isset($total_worked)) {
                                                if ($total_worked > $Sum_hour_contract) {
                                                    if (($total_worked - $Sum_hour_contract) > $dif) {

                                                        echo "10.00";
                                                    } else {
                                                        echo @calc_hrtodays($total_worked - $Sum_hour_contract);
                                                    }
                                                } else {
                                                    echo "0.00";
                                                };
                                            } ?>
                                        </div>
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Carry Forward Hours :
                                        </div>
                                        <div class="col-md-2">
                                            <?php
                                            if(isset($total_worked)){if ($total_worked > $Sum_hour_contract) {
                                                if (($total_worked - $Sum_hour_contract) > $dif) {

                                                    echo "80.00";
                                                } else {

                                                    echo number_format((float)($total_worked - $Sum_hour_contract), 2, '.', '');
                                                }
                                            } else {
                                                echo "0.00";
                                            };} ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Donated Days:
                                        </div>
                                        <div class="col-md-2">
                                            <?php
                                            if(isset($total_worked)){if (($total_worked - $Sum_hour_contract) > $dif) {
                                                echo number_format((float)(($total_worked - $Sum_hour_contract) - $dif) / 8, 2, '.', '');
                                            } else {
                                                echo "0.00";
                                            }}
                                            ?>
                                        </div>
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Donated Hours :
                                        </div>
                                        <div class="col-md-2">
                                            <?php
                                            if(isset($total_worked)){if (($total_worked - $Sum_hour_contract) > $dif) {
                                                echo number_format((float)(($total_worked - $Sum_hour_contract) - $dif), 2, '.', '');
                                            } else {
                                                echo "0.00";
                                            }}
                                            ?>
                                        </div>
                                    </div>



                                    <?php if (!empty($contractor_details)) {
                                        if ($contractor_details[0]['min_contact_id'] != $contractor_details[0]['max_contact_id']) {
                                    ?>
                                            <div class="col-md-12" style="padding: top;padding-top:20px;padding-left:17px;">
                                                <?php
                                                echo "<span class='btn btn-success btn-xs'>Contract-1 Details (" . date('m/d/Y', strtotime($link_contract1[0]['contract_begin_date'])) . "  -  " . date('m/d/Y', strtotime($link_contract1[0]['contract_end_date'])) . ")</span>";
                                                ?>
                                            </div>

                                            <?php
                                            $param['hours_to_work_1'] = $Sum_hour_contract1 = (float)($Sum_hour_contract_1);
                                            $param['cary_hours_to_work_1'] = ($cary_Sum_hour_contract_1);
                                            $param['hours_worked_1'] = $sum_fisical_1['t_hours'];
                                            $param['minutes_worked_1'] = $sum_fisical_1['t_minutes'];
                                            //  $calculated_attendance = calculated_attendance($param);
                                            $total_worked1 = (float)hourdecFormating($param['hours_worked_1'], $param['minutes_worked_1']);
                                            $dif = (float)"80.00";
                                            ?>

                                            <div class="col-md-12" style="padding-top:10px;">
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Number of Days Contracted :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo (number_format((float)$param['hours_to_work_1'] / 8, 2, '.', '')) ?>
                                                </div>
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Number of Hours Contracted :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo (number_format((float)$param['hours_to_work_1'], 2, '.', '')); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Number of Days Carried Over :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo (number_format((float)$param['cary_hours_to_work_1'] / 8, 2, '.', '')); ?>
                                                </div>
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Number of Hours Carried Over:
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo (number_format((float)$param['cary_hours_to_work_1'], 2, '.', '')); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Days Worked :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php $grandsumhr = hourdecFormating($sum_fisical_1['t_hours'], $sum_fisical_1['t_minutes']); ?>
                                                    <?= @calc_hrtodays($grandsumhr) ?><!-- <?= number_format((float)$grandsumhr / 8, 2, '.', ''); ?> -->
                                                </div>
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Hours Worked :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $grandsumhr = hourdecFormating($sum_fisical_1['t_hours'], $sum_fisical_1['t_minutes']); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Days Left to Work:
                                                </div>
                                                <div class="col-md-2">
                                                    <?php if ($total_worked1 > $Sum_hour_contract1) {
                                                        echo "0.00";
                                                    } else {
                                                        echo @calc_hrtodays($Sum_hour_contract1 - $total_worked1);
                                                    } ?>
                                                    <? //=@$calculated_attendance['total_left_days']
                                                    ?>
                                                </div>

                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Hours Left to Work:
                                                </div>
                                                <div class="col-md-2">
                                                    <?php if ($total_worked1 > $Sum_hour_contract1) {
                                                        echo "0.00";
                                                    } else {
                                                        echo ($Sum_hour_contract1 - $total_worked1);
                                                    } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Carry Forward Days:
                                                </div>
                                                <div class="col-md-2">
                                                    <?php
                                                    if ($total_worked1 > $Sum_hour_contract1) {
                                                        if (($total_worked1 - $Sum_hour_contract1) > $dif) {
                                                            echo "10.00";
                                                        } else {
                                                            echo @calc_hrtodays($total_worked1 - $Sum_hour_contract1);
                                                        }
                                                    } else {
                                                        echo "0.00";
                                                    } ?>
                                                </div>
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Carry Forward Hours :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php
                                                    if ($total_worked1 > $Sum_hour_contract1) {
                                                        if (($total_worked1 - $Sum_hour_contract1) > $dif) {
                                                            echo "80.00";
                                                        } else {
                                                            echo number_format((float)($total_worked1 - $Sum_hour_contract1), 2, '.', '');
                                                        }
                                                    } else {
                                                        echo "0.00";
                                                    } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Donated Days:
                                                </div>
                                                <div class="col-md-2">
                                                    <?php
                                                    if (($total_worked1 - $Sum_hour_contract1) > $dif) {
                                                        echo number_format((float)(($total_worked1 - $Sum_hour_contract1) - $dif) / 8, 2, '.', '');
                                                    } else {
                                                        echo "0.00";
                                                    } ?>
                                                </div>
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Donated Hours :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php
                                                    if (($total_worked1 - $Sum_hour_contract1) > $dif) {
                                                        echo number_format((float)(($total_worked1 - $Sum_hour_contract1) - $dif), 2, '.', '');
                                                    } else {
                                                        echo "0.00";
                                                    }
                                                    ?>
                                                </div>
                                            </div>



                                            <div class="col-md-12" style="padding: top;padding-top:20px;padding-left:17px;">
                                                <?php if ($contractor_details[0]['min_contact_id'] != $contractor_details[0]['max_contact_id']) {
                                                    echo "<span class='btn btn-success btn-xs'>Contract-2 Details (" . date('m/d/Y', strtotime($link_contract2[0]['contract_begin_date'])) . "  -  " . date('m/d/Y', strtotime($link_contract2[0]['contract_end_date'])) . ")</span>";
                                                } ?>
                                            </div>





                                            <?php
                                            $param['hours_to_work_2'] = $Sum_hour_contract2 = (float)($Sum_hour_contract_2);
                                            $param['cary_hours_to_work_2'] = ($cary_Sum_hour_contract_2);
                                            $param['hours_worked_2'] = $sum_fisical_2['t_hours'];
                                            $param['minutes_worked_2'] = $sum_fisical_2['t_minutes'];
                                            //  $calculated_attendance = calculated_attendance($param);
                                            $total_worked2 = (float)hourdecFormating($param['hours_worked_2'], $param['minutes_worked_2']);
                                            $dif = (float)"80.00";
                                            ?>

                                            <div class="col-md-12" style="padding-top:10px;">
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Number of Days Contracted :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo (number_format((float)$param['hours_to_work_2'] / 8, 2, '.', '')) ?>
                                                </div>
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Number of Hours Contracted :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo (number_format((float)$param['hours_to_work_2'], 2, '.', '')); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Number of Days Carried Over :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo (number_format((float)$param['cary_hours_to_work_2'] / 8, 2, '.', '')); ?>
                                                </div>
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Number of Hours Carried Over:
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo (number_format((float)$param['cary_hours_to_work_2'], 2, '.', '')); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Days Worked :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php $grandsumhr = hourdecFormating($sum_fisical_2['t_hours'], $sum_fisical_2['t_minutes']); ?>
                                                    <?= @calc_hrtodays($grandsumhr) ?><!-- <?= number_format((float)$grandsumhr / 8, 2, '.', ''); ?> -->
                                                </div>
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Hours Worked :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $grandsumhr = hourdecFormating($sum_fisical_2['t_hours'], $sum_fisical_2['t_minutes']); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Days Left to Work:
                                                </div>
                                                <div class="col-md-2">
                                                    <?php if ($total_worked2 > $Sum_hour_contract2) {
                                                        echo "0.00";
                                                    } else {
                                                        echo @calc_hrtodays($Sum_hour_contract2 - $total_worked2);
                                                    } ?>
                                                    <? //=@$calculated_attendance['total_left_days']
                                                    ?>
                                                </div>

                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Hours Left to Work:
                                                </div>
                                                <div class="col-md-2">
                                                    <?php if ($total_worked2 > $Sum_hour_contract2) {
                                                        echo "0.00";
                                                    } else {
                                                        echo ($Sum_hour_contract2 - $total_worked2);
                                                    } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Carry Forward Days:
                                                </div>
                                                <div class="col-md-2">
                                                    <?php
                                                    if ($total_worked2 > $Sum_hour_contract2) {
                                                        if (($total_worked2 - $Sum_hour_contract2) > $dif) {
                                                            echo "10.00";
                                                        } else {
                                                            echo @calc_hrtodays($total_worked2 - $Sum_hour_contract2);
                                                        }
                                                    } else {
                                                        echo "0.00";
                                                    } ?>
                                                </div>
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Carry Forward Hours :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php
                                                    if ($total_worked2 > $Sum_hour_contract2) {
                                                        if (($total_worked2 - $Sum_hour_contract2) > $dif) {
                                                            echo "80.00";
                                                        } else {
                                                            echo number_format((float)($total_worked2 - $Sum_hour_contract2), 2, '.', '');
                                                        }
                                                    } else {
                                                        echo "0.00";
                                                    } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Donated Days:
                                                </div>
                                                <div class="col-md-2">
                                                    <?php
                                                    if (($total_worked2 - $Sum_hour_contract2) > $dif) {
                                                        echo number_format((float)(($total_worked2 - $Sum_hour_contract2) - $dif) / 8, 2, '.', '');
                                                    } else {
                                                        echo "0.00";
                                                    } ?>
                                                </div>
                                                <div class="col-md-4" style="font-weight: bold;">
                                                    Donated Hours :
                                                </div>
                                                <div class="col-md-2">
                                                    <?php
                                                    if (($total_worked2 - $Sum_hour_contract2) > $dif) {
                                                        echo number_format((float)(($total_worked2 - $Sum_hour_contract2) - $dif), 2, '.', '');
                                                    } else {
                                                        echo "0.00";
                                                    }
                                                    ?>
                                                </div>
                                            </div>






                                    <?php }
                                    } ?>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->
        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content-page -->
<!-- end coded by bajrang -->
<script>
    function submitform() {
        $('#filter').submit();
    }

    $(document).on("click", "#generatepdf", function() {

        //window.location.href = '<?php //echo  base_url("admin/PdfBuilder/classReportPdf/");
                                    ?><?php //echo encryptor('encrypt',$selectedclass);
                                        ?>';
        /*window.open('<?php echo  base_url("admin/PdfBuilder/classReportPdf/"); ?><?php echo encryptor('encrypt', $selectedclass ?? ''); ?>', '_blank');*/

    });
</script>
<script>
    function fnExcelReport(table_id) {
        // alert(table_id);
        var tab_text = '<table border="1px" style="font-size:16px" ">';
        var textRange;
        var j = 0;
        var tab = document.getElementById(table_id); // id of table
        var lines = tab.rows.length;
        //console.log(tab.rows);
        // the first headline of the table#0d4660 DFDFDF
        if (lines > 0) {
            tab_text = tab_text + '<tr>' + tab.rows[0].innerHTML + '</tr>' + '<tr>' + tab.rows[1].innerHTML + '</tr>';
        }

        // table data lines, loop starting from 1
        for (j = 2; j < lines; j++) {
            tab_text = tab_text + "<tr>" + tab.rows[j].innerHTML + "</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<a[^>]*>|<\/a>/g, ""); //remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
        // console.log(tab_text); // aktivate so see the result (press F12 in browser)

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        // if Internet Explorer
        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
            txtArea1.document.open("txt/html", "replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa = txtArea1.document.execCommand("SaveAs", true, "DataTableExport.xls");
            return (sa);
        } else
            var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_html = encodeURIComponent(tab_text); //table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        var theDate = new Date();
        var curr_year = '<?= $selected_year ?>';

        //setting the file name
        a.download = 'indivisual_financialyr_report_' + curr_year + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        //e.preventDefault();
        /**********************************************/

    }
</script>
<script>
    /*$(document).on('change', "#Financial_Y", function(){
	var date_val = $(this).val();
	alert(date_val);

})*/
    jQuery(function() {
        jQuery('#Financial_Y').change(function() {
            // this.form.submit();
        });
    });
    $(document).ready(function() {
        $(".select2").select2();
    });
</script>