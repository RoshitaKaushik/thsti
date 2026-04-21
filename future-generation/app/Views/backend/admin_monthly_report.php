<?php

//echo "<pre>"; print_r(session()->get());
$total_days_month = cal_days_in_month(CAL_GREGORIAN, $selected_month, $selected_year);
$newDateTime = '05' . '-' . $selected_month . '-' . $selected_year;

// echo date('M Y',strtotime($newDateTime));

?>
<!--$total_days_month =date('t'); -->

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

    /* #buttons-excel{
    margin-top: -31px;
} */
</style>

<?php
$add_permission = $edit_permission = $excel_permission = $print_permission =  false;
if (in_array(13, session()->get('profiles') ?? [])) {
    $permissions = getPermissionDetails('13', '44', '35');
    if (!empty($permissions)) {
        if ($permissions[0]['add_button'] == '1') {
            $add_permission = true;
        }
        if ($permissions[0]['edit_button'] == '1') {
            $edit_permission = true;
        }
        if ($permissions[0]['excel_button'] == '1') {
            $excel_permission = true;
        }
        if ($permissions[0]['print_button'] == '1') {
            $print_permission = true;
        }
    }
}
if (session()->get('role') == 1) {
    $add_permission = $edit_permission = $excel_permission = $print_permission = true;
}
?>

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12" style="left: 38%;">
                    <h4 class="pull-left page-title">Future Generations University Timesheet</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <?php
                            //GetDate = strtotime($_SESSION['admin_login_date_time']);
                            //$getDate = date(M Y,$GetDate );
                            ?>
                            <h3 class="panel-title">Admin Monthly Report <span style="position: absolute;left: 46%;"> <?php echo ($User_option == 0) ? ($_SESSION['admin_fullname'] ?? '')
                                                                                                                            : (($User_option_name['FirstName'] ?? '') . " " . ($User_option_name['LastName'] ?? '')); ?></span>
                                <a href="javascript:history.go(-1)" style="margin-top: -2px;" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-12">
                                    <div class="col-md-8">
                                        <?php
                                        $attr = array("class" => "form-horizontal");
                                        echo form_open("admin/Reports/adminMonthlyReport", $attr);
                                        ?>
                                        <div class="col-md-2">
                                            <select name="month" id="month" class="" required
                                                style="height: 34px;">
                                                <option value="">Select Month</option>
                                                <option value='01' <?php if ($selected_month == '01') {
                                                                        echo "selected";
                                                                    } ?>>Janaury</option>
                                                <option value='02' <?php if ($selected_month == '02') {
                                                                        echo "selected";
                                                                    } ?>>February</option>
                                                <option value='03' <?php if ($selected_month == '03') {
                                                                        echo "selected";
                                                                    } ?>>March</option>
                                                <option value='04' <?php if ($selected_month == '04') {
                                                                        echo "selected";
                                                                    } ?>>April</option>
                                                <option value='05' <?php if ($selected_month == '05') {
                                                                        echo "selected";
                                                                    } ?>>May</option>
                                                <option value='06' <?php if ($selected_month == '06') {
                                                                        echo "selected";
                                                                    } ?>>June</option>
                                                <option value='07' <?php if ($selected_month == '07') {
                                                                        echo "selected";
                                                                    } ?>>July</option>
                                                <option value='08' <?php if ($selected_month == '08') {
                                                                        echo "selected";
                                                                    } ?>>August</option>
                                                <option value='09' <?php if ($selected_month == '09') {
                                                                        echo "selected";
                                                                    } ?>>September</option>
                                                <option value='10' <?php if ($selected_month == '10') {
                                                                        echo "selected";
                                                                    } ?>>October</option>
                                                <option value='11' <?php if ($selected_month == '11') {
                                                                        echo "selected";
                                                                    } ?>>November</option>
                                                <option value='12' <?php if ($selected_month == '12') {
                                                                        echo "selected";
                                                                    } ?>>December</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="year" class="" id="year" required data-placeholder="Choose a Country..." style="height: 34px;">
                                                <option value="">Select Year...</option>

                                                <?php
                                                for ($k = 2018; $k <= date('Y'); $k++) {
                                                    echo '<option value="' . $k . '"';
                                                    if ($selected_year == $k) {
                                                        echo "selected";
                                                    }
                                                    echo '>' . $k . '</option>';
                                                }
                                                ?>



                                            </select>
                                        </div>
                                        <div class="col-sm-3">

                                            <select id="User_option" name="User_option" class=" form-control">

                                                <option value="0" <?php if ($User_option == "0") {
                                                                        echo "selected";
                                                                    } ?>>Select User</option>
                                                <?php foreach ($facultystaff as  $staff) { ?>
                                                    <option value="<?php echo $staff['ID'] ?>" <?php if ($User_option == $staff['ID']) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                                        <?php echo $staff['FirstName'] . " " . $staff['LastName'] . "(" . $staff['ID'] . ")"; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <div class="col-md-1"><button class="btn btn-success waves-effect waves-light m-b-5 m-l-5" onclick="return Date_Valid();">Filter</button>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                    <div class="col-md-4">
                                        <span style="position: absolute;left: -61%;margin-top: 8px; font-weight: bold;"> <?php echo  date('M Y', strtotime($newDateTime)); ?></span>
                                        <?php if ($excel_permission) { ?>
                                            <button style="margin-top: -31px" onclick="fnExcelReport('attendance_report')" class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="classListing"><span><i class="fa fa-file-excel-o"></i> Excel</span></button>
                                        <?php }
                                        if ($print_permission) { ?>
                                            <form target="_blank" action="<?= base_url() ?>admin/Reports/export_monthly_report_pdf" method="post">
                                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                <input type="hidden" name="User_option" value="<?= $User_option ?>">
                                                <input type="hidden" name="year" value="<?= $selected_year ?>">
                                                <input type="hidden" name="month" value="<?= $selected_month ?>">
                                                <button type="submit" id="generatepdf" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right"><i class="fa fa-file-pdf-o"></i>
                                                    <span><strong>PDF</strong></span></button>
                                            </form>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 table-responsive">
                                    <table id="attendance_report" class="table table-striped table-bordered " style="font-size: 12px;">
                                        <thead>
                                            <tr class="hide">
                                                <th colspan="<?= $total_days_month + 3 ?>">
                                                    <b>Future Generations University Timesheet</b>
                                                </th>
                                            </tr>
                                            <tr class="hide">
                                                <th colspan="<?= $total_days_month + 3 ?>">
                                                    <b>
                                                        <?php
                                                        
                                                        echo ($User_option == 0 || $User_option == '')
                                                            ? ($_SESSION['admin_fullname'] ?? '')
                                                            : (($User_option_name['FirstName'] ?? '') . ' ' . ($User_option_name['LastName'] ?? ''));
                                                        ?>
                                                    </b>

                                                </th>
                                            </tr>
                                            <tr class="hide">
                                                <th colspan="<?= $total_days_month + 3 ?>">
                                                    <b><?php echo date('M Y', strtotime($newDateTime)); ?></b>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Program</th>
                                                <?php
                                                for ($i = 1; $i <= $total_days_month; $i++) {
                                                ?>
                                                    <th><?php echo $i; ?></th>
                                                <?php } ?>
                                                <th style="font-weight: bold;">Hrs</th>
                                                <th>Days</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 1; $i <= $total_days_month; $i++) {
                                                ${'atendanceof_' . $i} = array();
                                            } ?>
                                            <?php
                                            $grandsum = array();


                                            foreach ($records_category as $key => $value) {

                                                $sum_hr = $sum_min = array();
                                                $sum_array = array();
                                            ?>
                                                <tr>
                                                    <td style="text-align: left; "><?= $value['catagory_name'] ?></td>
                                                    <?php
                                                    for ($i = 1; $i <= $total_days_month; $i++) {

                                                        $current_date = $selected_year . '-' . $selected_month . "-" . $i;
                                                    ?>
                                                        <td style="text-align: left;" id="attendance_<?= $i ?>_<?= $value['id'] ?>">
                                                            <?php foreach ($records as  $valuee) {

                                                                $s = $valuee['transaction_date'];
                                                                $dt = new DateTime($s);
                                                                $trans_date = $dt->format('Y-m-d');
                                                                if (strtotime($current_date) == strtotime($trans_date) && $value['id'] == $valuee['category_id']) { ?><?php
                                                                                                                                                                        if ($valuee['t_minutes'] == '0') {
                                                                                                                                                                            echo $hr_min = $valuee['t_hours'];
                                                                                                                                                                        } else {
                                                                                                                                                                            echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                                                                                                                                                        }
                                                                                                                                                                        //echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']);  
                                                                                                                                                                        //echo str_replace(".",":",$hr_min);
                                                                                                                                                                        ${'atendanceof_' . $i}[] = $sum_array[] = $grandsum[] = $hr_min;
                                                                                                                                                                        $sum_hr[] = $valuee['t_hours'];
                                                                                                                                                                        $sum_min[] = $valuee['t_minutes'];
                                                                                                                                                                    }
                                                                                                                                                                } ?>
                                                        </td>
                                                    <?php  } ?>
                                                    <td style="text-align: center;  font-weight: bold;">
                                                        <?php foreach ($records_sum_cat as $rvalue) { ?>
                                                        <?php if ($value['id'] == $rvalue['id']) {
                                                                echo $tot_hr = hourdecFormating($rvalue['t_hours'], $rvalue['t_minutes']);
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td style="text-align: center;"><?= @calc_hrtodays($tot_hr) ?></td>
                                                </tr>

                                            <?php } ?>
                                            <tr style="  font-weight: bold;">

                                                <td>TOTAL : </td>
                                                <?php
                                                for ($i = 1; $i <= $total_days_month; $i++) {

                                                    if ($i < 10) {
                                                        $current_date = $selected_year . '-' . $selected_month . "-0" . $i;
                                                    } else {
                                                        $current_date = $selected_year . '-' . $selected_month . "-" . $i;
                                                    }

                                                ?>
                                                    <td>

                                                        <?php foreach ($records_sum_day as ${'records_sum_day' . '_' . $i}) {

                                                            if (${'records_sum_day' . '_' . $i}['transaction_date'] == $current_date) {
                                                                echo hourdecFormating(${'records_sum_day' . '_' . $i}['t_hours'], ${'records_sum_day' . '_' . $i}['t_minutes']);
                                                            }
                                                        }

                                                        ?>

                                                    </td>
                                                <?php } ?>
                                                <td><?php echo $grandsumhr = hourdecFormating($records_sum['t_hours'], $records_sum['t_minutes']);
                                                    ?>

                                                </td>
                                                <td><?= @calc_hrtodays($grandsumhr) ?></td>
                                            </tr>
                                            <?php

                                            $param['hours_to_work'] = $Sum_hour_contract = (float)($Sum_hour_contract);
                                            $param['cary_hours_to_work'] = ($cary_Sum_hour_contract);
                                            $param['hours_worked'] = $sum_fisical['t_hours'];
                                            $param['minutes_worked'] = $sum_fisical['t_minutes'];
                                            //  $calculated_attendance = calculated_attendance($param);

                                            $total_worked = (float)hourdecFormating($param['hours_worked'], $param['minutes_worked']);

                                            $dif = (float)"80.00";
                                            if (!empty($carriedDetails)) {
                                                $dif =  $carriedDetails[0]['hours'];
                                            }
                                            ?>
                                            <tr class="hide">
                                                <td colspan="<?= $total_days_month + 3 ?>"></td>
                                            </tr>
                                            <tr class="hide">
                                                <td colspan="<?= $total_days_month + 3 ?>"></td>
                                            </tr>
                                            <tr class="hide">
                                                <td colspan="<?php if ($total_days_month == '31') {
                                                                    echo "17";
                                                                } elseif ($total_days_month == '30') {
                                                                    echo "16";
                                                                } elseif ($total_days_month == '29') {
                                                                    echo "15";
                                                                } else {
                                                                    echo "14";
                                                                } ?>"><b>Days Worked This Fiscal Year : <!-- <?php $grandsumday = number_format((float) array_sum($grandsum) / 8, 2, '.', '');
                                                                                                                print(Hr_min_sum($grandsumday));  ?> -->
                                                        <?php $grandsumhr = hourdecFormating($sum_fisical['t_hours'], $sum_fisical['t_minutes']); ?>
                                                        <?= @calc_hrtodays($grandsumhr) ?><!-- <?= number_format((float)$grandsumhr / 8, 2, '.', ''); ?> -->
                                                    </b>
                                                </td>
                                                <td colspan="17"><b>Hours Worked This Fiscal Year : <?php echo $grandsumhr = hourdecFormating($sum_fisical['t_hours'], $sum_fisical['t_minutes']);
                                                                                                    /* $exp=explode('.', $grandsumhr);
                                        echo $exp[0].":".($exp[1])*/

                                                                                                    ?></b></td>


                                            </tr>
                                            <tr class="hide">

                                                <td colspan="<?php if ($total_days_month == '31') {
                                                                    echo "17";
                                                                } elseif ($total_days_month == '30') {
                                                                    echo "16";
                                                                } elseif ($total_days_month == '29') {
                                                                    echo "15";
                                                                } else {
                                                                    echo "14";
                                                                } ?>"><b>Days Left on Contract :
                                                        <? //=@$calculated_attendance['total_left_days']
                                                        ?>
                                                        <?= @calc_hrtodays($Sum_hour_contract - $total_worked) ?>
                                                    </b>
                                                </td>
                                                <td colspan="17">
                                                    <b>Hours Left on Contract :
                                                        <?php  /*@$calculated_attendance['total_left_hours'];
                                          echo hourmintodecFormating($calculated_attendance['total_left_hours']);*/

                                                        echo ($Sum_hour_contract - $total_worked)
                                                        ?>


                                                    </b>
                                                </td>

                                            </tr>
                                            <tr class="hide">
                                                <td colspan="17"><b>Number of Days Contracted : <?php echo (number_format((float)$param['hours_to_work'] / 8, 2, '.', ''))
                                                                                                ?>
                                                    </b>
                                                </td>
                                                <td colspan="<?php if ($total_days_month == '31') {
                                                                    echo "17";
                                                                } elseif ($total_days_month == '30') {
                                                                    echo "16";
                                                                } elseif ($total_days_month == '29') {
                                                                    echo "15";
                                                                } else {
                                                                    echo "14";
                                                                } ?>"><b>Number of Hours Contracted :
                                                        <?php echo (number_format((float)$param['hours_to_work'], 2, '.', ''));
                                                        ?>
                                                    </b>
                                                </td>

                                            </tr>
                                            <tr class="hide">
                                                <td colspan="17"><b>Number of Days Carried Over From Previous Yr : <?php echo (number_format((float)$param['cary_hours_to_work'] / 8, 2, '.', ''))
                                                                                                                    ?>
                                                    </b>
                                                </td>
                                                <td colspan="<?php if ($total_days_month == '31') {
                                                                    echo "17";
                                                                } elseif ($total_days_month == '30') {
                                                                    echo "16";
                                                                } elseif ($total_days_month == '29') {
                                                                    echo "15";
                                                                } else {
                                                                    echo "14";
                                                                } ?>"><b>Number of Hours Carried Over From Previous Yr :
                                                        <?php echo (number_format((float)$param['cary_hours_to_work'], 2, '.', ''))
                                                        ?>
                                                    </b>
                                                </td>

                                            </tr>

                                        </tbody>
                                    </table>



                                    <div class="col-md-12" style="padding: top;padding-top:30px;">


                                        <div class="col-md-4" style="font-weight: bold;">
                                            Number of Days Contracted :

                                        </div>
                                        <div class="col-md-2">
                                            <?php echo (number_format((float)$param['hours_to_work'] / 8, 2, '.', '')) ?>
                                        </div>
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Number of Hours Contracted :
                                        </div>
                                        <div class="col-md-2">

                                            <?php echo (number_format((float)$param['hours_to_work'], 2, '.', ''));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">


                                        <div class="col-md-4" style="font-weight: bold;">
                                            Number of Days Carried Over :

                                        </div>
                                        <div class="col-md-2">
                                            <?php echo (number_format((float)$param['cary_hours_to_work'] / 8, 2, '.', ''))
                                            ?>
                                        </div>
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Number of Hours Carried Over:
                                        </div>
                                        <div class="col-md-2">
                                            <?php echo (number_format((float)$param['cary_hours_to_work'], 2, '.', ''))
                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Days Worked :
                                        </div>
                                        <div class="col-md-2">
                                            <?php $grandsumhr = hourdecFormating($sum_fisical['t_hours'], $sum_fisical['t_minutes']); ?>
                                            <?= @calc_hrtodays($grandsumhr) ?><!-- <?= number_format((float)$grandsumhr / 8, 2, '.', ''); ?> -->
                                        </div>
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Hours Worked :
                                        </div>
                                        <div class="col-md-2">
                                            <?php echo $grandsumhr = hourdecFormating($sum_fisical['t_hours'], $sum_fisical['t_minutes']); ?>

                                        </div>

                                    </div>
                                    <div class="col-md-12">


                                        <div class="col-md-4" style="font-weight: bold;">
                                            Days Left to Work:

                                        </div>
                                        <div class="col-md-2">
                                            <?php if ($total_worked > $Sum_hour_contract) {
                                                echo "0.00";
                                            } else {
                                                echo @calc_hrtodays($Sum_hour_contract - $total_worked);
                                            } ?>
                                            <? //=@$calculated_attendance['total_left_days']
                                            ?>
                                        </div>
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Hours Left to Work:
                                        </div>
                                        <div class="col-md-2">
                                            <?php if ($total_worked > $Sum_hour_contract) {
                                                echo "0.00";
                                            } else {
                                                echo ($Sum_hour_contract - $total_worked);
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="col-md-4" style="font-weight: bold;">
                                            Carry Forward Days:

                                        </div>
                                        <div class="col-md-2">

                                            <?php
                                            if ($total_worked > $Sum_hour_contract) {
                                                if (($total_worked - $Sum_hour_contract) > $dif) {
                                                    if (!empty($carriedDetails)) {
                                                        echo $carriedDetails[0]['days'];
                                                    } else {
                                                        echo "10.00";
                                                    }
                                                } else {
                                                    echo @calc_hrtodays($total_worked - $Sum_hour_contract);
                                                }
                                            } else {
                                                echo "0.00";
                                            }; ?>
                                        </div>
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Carry Forward Hours :
                                        </div>
                                        <div class="col-md-2">
                                            <?php
                                            if ($total_worked > $Sum_hour_contract) {
                                                if (($total_worked - $Sum_hour_contract) > $dif) {
                                                    if (!empty($carriedDetails)) {
                                                        echo $carriedDetails[0]['hours'];
                                                    } else {
                                                        echo "80.00";
                                                    }
                                                } else {

                                                    echo number_format((float)($total_worked - $Sum_hour_contract), 2, '.', '');
                                                }
                                            } else {
                                                echo "0.00";
                                            }; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="col-md-4" style="font-weight: bold;">
                                            Donated Days:

                                        </div>
                                        <div class="col-md-2">
                                            <?php
                                            if (($total_worked - $Sum_hour_contract) > $dif) {
                                                echo number_format((float)(($total_worked - $Sum_hour_contract) - $dif) / 8, 2, '.', '');
                                            } else {
                                                echo "0.00";
                                            };  ?>
                                        </div>
                                        <div class="col-md-4" style="font-weight: bold;">
                                            Donated Hours :
                                        </div>
                                        <div class="col-md-2">
                                            <?php

                                            if (($total_worked - $Sum_hour_contract) > $dif) {

                                                echo number_format((float)(($total_worked - $Sum_hour_contract) - $dif), 2, '.', '');
                                            } else {

                                                echo "0.00";
                                            };
                                            ?>
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
</div> <!-- content-page -->
<script>
    $(document).ready(function() {
        if ($('.attendance').is(':empty')) {
            $('.attendance').innerHTML('0.00');
        };

    });
</script>
<script>
    function submitform() {
        $('#filter').submit();
    }

    $(document).on("click", "#generatepdf", function() {

        //window.location.href = '<?php //echo  base_url("admin/PdfBuilder/classReportPdf/");
                                    ?><?php //echo encryptor('encrypt',$selectedclass);
                                        ?>';
        //window.open('<?php //  echo  base_url("admin/PdfBuilder/classReportPdf/");
                        ?><?php // echo encryptor('encrypt',$selectedclass);
                            ?>', '_blank');

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
        var d = new Date();
        n = '<?php echo $selected_year . '_' . $selected_month ?>';
        //setting the file name
        a.download = 'Monthly Report_' + n + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        /*e.preventDefault();*/
        /**********************************************/

    }
</script>
<script>
    function Date_Valid() {

        var year = $('#year').val().length;
        var month = $('#month').val().length;
        //console.log(BeginN +'  END:'+EndN);
        if (year == 0 && month == 0) {

            alert("Select month and year ");
            return false;
        } else {

            return true;
        }

    }
</script>