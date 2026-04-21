<div class="col-md-12 table-responsive">
    <table id="attendance_report" class="table table-striped dataTable table-bordered" style="font-size: 12px;">
        <thead>
            <tr class="hide">
                <th colspan="<?= $catcount + 3 ?>">

                </th>
            </tr>
            <tr class="hide">
                <th colspan="<?= $catcount + 3 ?>">
                    <b>Future Generations University Timesheet</b>
                </th>
            </tr>
            <tr class="hide">
                <th colspan="<?= $catcount + 3 ?>">
                    <b>Administrative Time Report</b>
                </th>
            </tr>
            <tr class="hide">
                <th colspan="<?= $catcount + 3 ?>">
                    <b><?php if (isset($BeginDate)) {
                            echo $BeginDate;
                        } ?> To <?php if (isset($EndDate)) {
                                    echo $EndDate;
                                } ?></b>
                </th>
            </tr>
            <tr class="hide">
                <th colspan="<?= $catcount + 3 ?>">

                </th>
            </tr>
            <tr>
                <th>Employees</th>
                <?php foreach ($records_category as $key => $value) { ?>
                    <th><?= $value['catagory_name'] ?></th>
                <?php  } ?>
                <th style="font-weight: bold;">Total Hrs</th>
                <th>Total Days</th>
                <th>Contracted Days</th>
                <th>Days to Work</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records_category as  $variable) {
                ${'sumofcatid_' . $variable['id']} = array();
                $sum_cont_days = array();
                $tot_wdayyy = array();
            };

            $grandsum = array();
            foreach ($uni_empid as $valueee) {
                $sum_array = array();
                //$tot_wdayyy=0;
            ?>
                <tr>
                    <td style="text-align: left; "><?= $valueee['FirstName'] . ' ' . $valueee['LastName'] ?>

                    </td>
                    <?php foreach ($records_category as $key => $value) { ?>

                        <td> <?php foreach ($records as $key => $valuee) {

                                    if ($valuee['empid'] == $valueee['empid']  && $valuee['category_id'] == $value['id']) {
                                        echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                        // echo str_replace(".",":",$hr_min);

                                        ${'sumofcatid_' . $value['id']}[] = $sum_array[] = $grandsum[] = $hr_min;
                                    }
                                } ?>
                        </td>
                    <?php } ?>

                    <td style=" font-weight: bold;">

                        <?php foreach ($records_sum_emp_hr as  $sumemphr) {
                            if ($sumemphr['empid'] == $valueee['empid']) {
                                echo $tot_hr = hourdecFormating($sumemphr['t_hours'], $sumemphr['t_minutes']);
                            }
                        } ?>
                    </td>
                    <td style=" font-weight: bold;">
                        <?php echo $sum_dwork = calc_hrtodays($tot_hr); ?>
                    </td>

                    <td><?php
                        $fun_data = (getcontract_total($BeginDate, $EndDate, $valueee['empid']));
                        echo  $sum_cont_days[] = $contr_sum = calc_hrtodays($fun_data['to_hour']);

                        ?>
                    </td>
                    <td><?php
                        $work_left = getcontract_hour_left($fun_data['min_date'], $fun_data['max_date'], $valueee['empid']);


                        $hr_left = hourdecFormating($work_left['t_hours'], $work_left['t_minutes']);
                        echo $tot_wdayyy[] = @$contr_sum - calc_hrtodays($hr_left);
                        /*echo @$tot_wdayyy; */ ?>

                    </td>
                </tr>
            <?php } ?>
            <tr style=" font-weight: bold;">
                <td>TOTAL : </td>
                <?php foreach ($records_category as  $tot_sum) { ?>
                    <td>
                        <?php foreach ($records_sum_cat_hr as  ${'cat_hr_' . $tot_sum['id']}) {
                            if (${'cat_hr_' . $tot_sum['id']}['category_id'] == $tot_sum['id']) {;
                                echo hourdecFormating(${'cat_hr_' . $tot_sum['id']}['t_hours'], ${'cat_hr_' . $tot_sum['id']}['t_minutes']);
                            }
                        } ?>

                    </td>
                <?php } ?>
                <td>
                    <?php
                    echo $grandsumhr = hourdecFormating($records_sum['t_hours'], $records_sum['t_minutes']);
                    //echo str_replace(".",":",$grandsumhr);  
                    ?>
                </td>
                <td>
                    <?= $tot_wdayy = calc_hrtodays($grandsumhr); ?>
                </td>
                <td><?php
                    $sum_cont_days = $sum_cont_days ?? 0;
                    echo (gettype($sum_cont_days) == 'array') ? @$totday_cont = array_sum($sum_cont_days) : @$totday_cont = $sum_cont_days; ?></td>
                <td><?php
                    $tot_wdayyy = $tot_wdayyy ?? 0;
                    echo (gettype($tot_wdayyy) == 'array') ? @array_sum($tot_wdayyy) : $tot_wdayyy; ?></td>
            </tr>
        </tbody>
    </table>
    <table id="attendance_reportt" class="table table-striped dataTable table-bordered  " style="font-size: 12px; display: none;">
        <thead>

            <tr>
                <th>Employees</th>
                <?php foreach ($records_categoryy as $key => $value) { ?>
                    <th><?= $value['catagory_name'] ?></th>
                <?php  } ?>
                <th style="font-weight: bold;">Total Hrs</th>
                <th>Total Days</th>
                <th>Contracted Days</th>
                <th>Days to Work</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records_categoryy as  $variable) {
                ${'sumofcatid_' . $variable['id']} = array();
                $sum_cont_dayss = array();
                $tot_wdayyy_sh = array();
            };

            $grandsum = array();
            foreach ($uni_empid as $valueee) {
                $sum_array = array();
            ?>


                <tr>
                    <td style="text-align: left; "><?= $valueee['FirstName'] . ' ' . $valueee['LastName'] ?>

                    </td>
                    <?php foreach ($records_categoryy as $key => $value) { ?>

                        <td> <?php foreach ($records as $key => $valuee) {

                                    if ($valuee['empid'] == $valueee['empid']  && $valuee['category_id'] == $value['id']) {
                                        echo $hr_min = hourdecFormating($valuee['t_hours'], $valuee['t_minutes']);
                                        // echo str_replace(".",":",$hr_min);

                                        ${'sumofcatid_' . $value['id']}[] = $sum_array[] = $grandsum[] = $hr_min;
                                    }
                                } ?>
                        </td>
                    <?php } ?>

                    <td style=" font-weight: bold;">
                        <!-- <?php echo number_format((float)array_sum($sum_array), 2, '.', ''); ?> -->
                        <?php // $tot_hr=number_format((float)array_sum($sum_array), 2, '.', ''); echo Hr_min_sum($tot_hr); 
                        ?>
                        <?php foreach ($records_sum_emp_hr as  $sumemphr) {
                            if ($sumemphr['empid'] == $valueee['empid']) {
                                echo $tot_hr = hourdecFormating($sumemphr['t_hours'], $sumemphr['t_minutes']);
                                //echo str_replace(".",":",$tot_hr);
                            }
                        } ?>
                    </td>
                    <td style=" font-weight: bold;">
                        <?php echo $sum_dwork = calc_hrtodays($tot_hr); ?>
                    </td>
                    <td>
                        <?php
                        $fun_data = (getcontract_total($BeginDate, $EndDate, $valueee['empid']));
                        echo  $sum_cont_dayss[] = $contr_sum = calc_hrtodays($fun_data['to_hour']);

                        ?>
                    </td>
                    <td>
                        <?php
                        $work_left = getcontract_hour_left($fun_data['min_date'], $fun_data['max_date'], $valueee['empid']);


                        $hr_left = hourdecFormating($work_left['t_hours'], $work_left['t_minutes']);
                        echo $tot_wdayyy_sh[] = (@$contr_sum - calc_hrtodays($hr_left));
                        ?>
                    </td>
                </tr>
            <?php } ?>
            <tr style=" font-weight: bold;">
                <td>TOTAL : </td>
                <?php foreach ($records_categoryy as  $tot_sum) { ?>
                    <td>

                        <!-- <?php $tot_cat = number_format((float)array_sum(${'sumofcatid_' . $tot_sum['id']}), 2, '.', '');
                                echo Hr_min_sum($tot_cat); ?> -->
                        <?php foreach ($records_sum_cat_hr as  ${'cat_hr_' . $tot_sum['id']}) {
                            if (${'cat_hr_' . $tot_sum['id']}['category_id'] == $tot_sum['id']) {;
                                echo hourdecFormating(${'cat_hr_' . $tot_sum['id']}['t_hours'], ${'cat_hr_' . $tot_sum['id']}['t_minutes']);
                            }
                        } ?>

                    </td>
                <?php } ?>
                <td>
                    <?php
                    echo $grandsumhrr = hourdecFormating($records_sum['t_hours'], $records_sum['t_minutes']);
                    //echo str_replace(".",":",$grandsumhr);  
                    ?>

                </td>

                <td>
                    <?= $tot_wdayyy = calc_hrtodays($grandsumhrr); ?>
                </td>
                <td><?php echo @$totday_contt = array_sum($sum_cont_dayss); ?></td>
                <td><?php echo @array_sum($tot_wdayyy_sh); ?></td>
            </tr>
        </tbody>
    </table>
</div>