<style>
    th {
        font-weight: bold;
        text-align: center;
        vertical-align: bottom;
        font-family: "Times New Roman", Times, serif;
        border: 1px solid #ccc;
        font-size: 9px;
        height: 25px;
    }

    td {
        font-family: "Times New Roman", Times, serif;
        border: 1px solid #ccc;
        font-size: 9px;
        height: 25px;
    }

    table {
        border: 1px solid #ccc;
    }
</style>

<h3>Women</h3>

<table id="alldataTable1" class="table table-striped table-bordered " style="width:100%;">

    <thead>

        <tr>
            <th style="width:70px;text-align:center">First Name</th>
            <th>Last Name</th>
            <th style="width:100px;">Email</th>
            <th style="width:35px;">Gender</th>
            <th>Country</th>
            <th>State</th>
            <th style="width:120px;">Course</th>
            <th style="width:27px;">Class</th>
            <th style="width:42px;">Semester</th>
            <th>Credit</th>
            <th>Ethincity</th>
            <?php $abc = array();
            $m_abc = array();

            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $non_resient_alien = 0;
        $hispanic = 0;
        $native_american = 0;
        $asian = 0;
        $black = 0;
        $hawaiian = 0;
        $white = 0;
        $two = 0;
        $race = 0;
        $unknown = 0;

        $plus_non_resient_alien = 0;
        $plus_hispanic = 0;
        $plus_native_american = 0;
        $plus_asian = 0;
        $plus_black = 0;
        $plus_hawaiian = 0;
        $plus_white = 0;
        $plus_two = 0;
        $plus_race = 0;
        $plus_unknown = 0;

        $minus_non_resient_alien = 0;
        $minus_hispanic = 0;
        $minus_native_american = 0;
        $minus_asian = 0;
        $minus_black = 0;
        $minus_hawaiian = 0;
        $minus_white = 0;
        $minus_two = 0;
        $minus_race = 0;
        $minus_unknown = 0;

        foreach ($records as $rec) {
            $current_to_credit = 0;
            $coursedata = get_user_course_with_filter($rec['ID'], $selected_program_start, $start_program_date, $selected_program_end, $end_program_date, $selected_semester);
            //echo $this->db->last_query();die;

        ?>
            <tr>
                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>" style="width:70px;"><?php echo $rec['FirstName']; ?></td>
                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>"><?php echo $rec['LastName']; ?></td>
                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>" style="width:100px;"><?php
                                                                                        $email = report_getEmailByIDD($rec['ID']);

                                                                                        $user_email = '';
                                                                                        foreach ($email as $e) {
                                                                                            $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);
                                                                                            if ($whatIWant == 'future.edu') {
                                                                                                $user_email = $e['Email'];
                                                                                            }
                                                                                        }
                                                                                        if ($user_email != '') {
                                                                                            echo $user_email;
                                                                                        } else {
                                                                                            if (isset($email[0]['Email'])) {
                                                                                                $all_email = array_column($email, 'Email');
                                                                                                echo implode(",", $all_email);
                                                                                            }
                                                                                        }

                                                                                        ?>
                </td>

                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>" style="text-align:center ! important;width:35px;"><?php echo $rec['Sex'] ?></td>

                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>"><?php
                                                                    $user_address = get_user_address($rec['ID']);

                                                                    $user_country = array_column($user_address, 'CountryName');
                                                                    echo implode(",", $user_country);
                                                                    ?>
                </td>
                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>"><?php
                                                                    $user_country_id = array_column($user_address, 'Country');



                                                                    if (in_array("USA", $user_country_id)) {
                                                                        $state_list = get_us_state_by_state_id($rec['ID'], 'USA');
                                                                        $user_country = array_column($state_list, 'StateName');
                                                                        echo implode(",<br>", $user_country);
                                                                    }

                                                                    ?>
                </td>

                <td style="width:120px;"><?= $coursedata[0]['CourseTitle'] . "-" . $coursedata[0]['Course']; ?>
                </td>

                <td style="width:27px;"><?php echo $coursedata[0]['Class']; ?></td>
                <td style="width:42px;"><?php echo $coursedata[0]['Semester']; ?></td>

                <td><?php echo $coursedata[0]['credits'];
                    $current_to_credit = $current_to_credit + $coursedata[0]['credits'];
                    $abc[$coursedata[0]['CourseID']] =  $abc[$coursedata[0]['CourseID']] + $coursedata[0]['credits'];


                    ?></td>
                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>"><?php echo $rec['Ethnicity']; ?></td>

            </tr>
            <?php

            for ($k = 1; $k < sizeof($coursedata); $k++) {

            ?>
                <tr>
                    <td style="width:120px;"><?= $coursedata[$k]['CourseTitle'] . "-" . $coursedata[$k]['Course']; ?>
                    </td>

                    <td style="width:27px;"><?php echo $coursedata[$k]['Class']; ?></td>
                    <td style="width:42px;"><?php echo $coursedata[$k]['Semester']; ?></td>
                    <td><?php echo $coursedata[$k]['credits'];
                        $current_to_credit = $current_to_credit + $coursedata[$k]['credits'];
                        $abc[$coursedata[$k]['CourseID']] =  $abc[$coursedata[$k]['CourseID']] + $coursedata[$k]['credits'];


                        ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <th colspan="3">Total Credit</th>
                <td><?= $current_to_credit; ?></td>

            </tr>
        <?php
            $credit = $current_to_credit;





            if ($rec['Ethnicity'] == 'Unknown') {
                $unknown = $unknown + 1;
                if ($credit < 6) {
                    $minus_unknown = $minus_unknown + 1;
                } else {
                    $plus_unknown = $plus_unknown + 1;
                }
            }
            if ($rec['Ethnicity'] == '') {
                $unknown = $unknown + 1;
                if ($credit < 6) {
                    $minus_unknown = $minus_unknown + 1;
                } else {
                    $plus_unknown = $plus_unknown + 1;
                }
            }
            if ($rec['Ethnicity'] == 'White') {
                $white = $white + 1;
                if ($credit < 6) {
                    $minus_white = $minus_white + 1;
                } else {
                    $plus_white = $plus_white + 1;
                }
            }
            if ($rec['Ethnicity'] == 'Asian') {
                $asian = $asian + 1;
                if ($credit < 6) {
                    $minus_asian = $minus_asian + 1;
                } else {
                    $plus_asian = $plus_asian + 1;
                }
            }
            if ($rec['Ethnicity'] == 'Black/African American') {
                $black = $black + 1;

                if ($credit < 6) {
                    $minus_black = $minus_black + 1;
                } else {
                    $plus_black = $plus_black + 1;
                }
            }
            if ($rec['Ethnicity'] == 'Hispanic/Latino') {
                $hispanic = $hispanic + 1;
                if ($credit < 6) {
                    $minus_hispanic = $minus_hispanic + 1;
                } else {
                    $plus_hispanic = $plus_hispanic + 1;
                }
            }
            if ($rec['Ethnicity'] == 'American Indian') {
                $native_american = $native_american + 1;
                if ($credit < 6) {
                    $minus_native_american = $minus_native_american + 1;
                } else {
                    $plus_native_american = $plus_native_american + 1;
                }
            }
            if ($rec['Ethnicity'] == 'Non-Resident Alien') {
                $non_resient_alien = $non_resient_alien + 1;
                if ($credit < 6) {
                    $minus_non_resient_alien = $minus_non_resient_alien + 1;
                } else {
                    $plus_non_resient_alien = $plus_non_resient_alien + 1;
                }
            }
            if ($rec['Ethnicity'] == 'Native Hawaiian/Pacific Islander') {
                $hawaiian = $hawaiian + 1;
                if ($credit < 6) {
                    $minus_hawaiian = $minus_hawaiian + 1;
                } else {
                    $plus_hawaiian = $plus_hawaiian + 1;
                }
            }
            if ($rec['Ethnicity'] == 'Two or more races') {
                $two = $two + 1;
                if ($credit < 6) {
                    $minus_two = $minus_two + 1;
                } else {
                    $plus_two = $plus_two + 1;
                }
            }


            $current_to_credit = 0;
        }
        ?>
    </tbody>

</table>

<h5>Subtotal Women</h5>
<table class="table table-striped table-bordered" style="margin-top:20px;width:50%;">
    <thead>

        <tr>
            <th>Course</th>
            <th>Class</th>
            <th>Semester</th>
            <th>Total Credit</th>
        </tr>
    </thead>
    <?php
    $sub_total_credit = 0;
    //echo $CourseID;
    //echo "<pre>";print_r($abc);die;
    foreach ($abc as $key => $val) {
        $coursedet = getCorse_details_by_ID($key);
        //echo "<pre>";print_r($coursedet);echo "</pre>";
    ?>
        <tbody>
            <tr>
                <td><?= $coursedet['CourseTitle'] . "-" . $coursedet['Course']; ?></td>
                <!--td><?= $coursedet['CourseID']; ?></td-->
                <td><?= $coursedet['Class']; ?></td>
                <td><?= $coursedet['Semester']; ?></td>
                <td><?php echo $val;
                    $sub_total_credit = $sub_total_credit + $val;
                    ?></td>
            </tr>

        <?php } ?>
        <tr>
            <th colspan="3">Total Credit</th>
            <td><?php echo $sub_total_credit; ?> </td>
        </tr>
        </tbody>
</table>
<br /><br />
<table class="table table-striped table-bordered" style="margin-top:20px;width:50%;">
    <thead>

        <tr>
            <th></th>
            <th>Total</th>
            <!--th>Full Time (6 +ch)</th>
                                                    <th>Part Time (< 6 ch)</th-->
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Unknown</th>
            <td><?= $unknown ?></td>
            <!--th><?= $plus_unknown ?></td>
                                                    <td><?= $minus_unknown ?></td-->
        </tr>
        <tr>
            <th>White</th>
            <td><?= $white ?></td>
            <!--th><?= $plus_white ?></td>
                                                    <td><?= $minus_white ?></td-->
        </tr>
        <tr>
            <th>Asian</th>
            <td><?= $asian ?></td>
            <!--th><?= $plus_asian ?></td>
                                                    <td><?= $minus_asian ?></td-->
        </tr>
        <tr>
            <th>Black/African American</th>
            <td><?= $black ?></td>
            <!--th><?= $plus_black ?></td>
                                                    <td><?= $minus_black ?></td-->
        </tr>
        <tr>
            <th>Hispanic/Latino</th>
            <td><?= $hispanic ?></td>
            <!--th><?= $plus_hispanic ?></td>
                                                    <td><?= $minus_hispanic ?></td-->
        </tr>
        <tr>
            <th>American Indian</th>
            <td><?= $native_american ?></td>
            <!--th><?= $plus_native_american ?></td>
                                                    <td><?= $minus_native_american ?></td-->
        </tr>
        <tr>
            <th>Non-Resident Alien</th>
            <td><?= $non_resient_alien ?></td>
            <!--th><?= $plus_non_resient_alien ?></td>
                                                    <td><?= $minus_non_resient_alien ?></td-->
        </tr>
        <tr>
            <th>Native Hawaiian/Pacific Islander</th>
            <td><?= $hawaiian ?></td>
            <!--th><?= $plus_hawaiian ?></td>
                                                    <td><?= $minus_hawaiian ?></td-->
        </tr>
        <tr>
            <th>Two or more races</th>
            <td><?= $two ?></td>
            <!--th><?= $plus_two ?></td>
                                                    <td><?= $minus_two ?></td-->
        </tr>

        <tr>
            <th>Total</th>
            <td><?= $unknown + $white + $asian + $black + $hispanic + $native_american + $non_resient_alien + $hawaiian + $two ?></td>
            <!--th><?= $plus_unknown + $plus_white + $plus_asian + $plus_black + $plus_hispanic + $plus_native_american + $plus_non_resient_alien + $plus_hawaiian + $plus_two ?></td>
                                                    <td><?= $minus_unknown + $minus_white + $minus_asian + $minus_black + $minus_hispanic + $minus_native_american + $minus_non_resient_alien + $minus_hawaiian + $minus_two ?></td-->
        </tr>


    </tbody>
</table>



<h3>Men</h3>

<table id="alldataTable1" class="table table-striped table-bordered " style="width:100%;">

    <thead>

        <tr>
            <th style="width:70px;text-align:center">First Name</th>
            <th>Last Name</th>
            <th style="width:100px;">Email</th>
            <th style="width:35px;">Gender</th>
            <th>Country</th>
            <th>State</th>
            <th style="width:120px;">Course</th>
            <th style="width:27px;">Class</th>
            <th style="width:42px;">Semester</th>
            <th>Credit</th>
            <th>Ethincity</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $m_non_resient_alien = 0;
        $m_hispanic = 0;
        $m_native_american = 0;
        $m_asian = 0;
        $m_black = 0;
        $m_hawaiian = 0;
        $m_white = 0;
        $m_two = 0;
        $m_race = 0;
        $m_unknown = 0;

        $plus_m_non_resient_alien = 0;
        $plus_m_hispanic = 0;
        $plus_m_native_american = 0;
        $plus_m_asian = 0;
        $plus_m_black = 0;
        $plus_m_hawaiian = 0;
        $plus_m_white = 0;
        $plus_m_two = 0;
        $plus_m_race = 0;
        $plus_m_unknown = 0;

        $minus_m_non_resient_alien = 0;
        $minus_m_hispanic = 0;
        $minus_m_native_american = 0;
        $minus_m_asian = 0;
        $minus_m_black = 0;
        $minus_m_hawaiian = 0;
        $minus_m_white = 0;
        $minus_m_two = 0;
        $minus_m_race = 0;
        $minus_m_unknown = 0;

        foreach ($m_records as $rec) {
            $current_to_credit = 0;
            $coursedata = get_user_course_with_filter($rec['ID'], $selected_program_start, $start_program_date, $selected_program_end, $end_program_date, $selected_semester);
        ?>
            <tr>
                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>" style="width:70px;"><?php echo $rec['FirstName']; ?></td>
                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>"><?php echo $rec['LastName']; ?></td>
                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>" style="width:100px;"><?php
                                                                                        $email = report_getEmailByIDD($rec['ID']);
                                                                                        $user_email = '';
                                                                                        foreach ($email as $e) {
                                                                                            $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);
                                                                                            if ($whatIWant == 'future.edu') {
                                                                                                $user_email = $e['Email'];
                                                                                            }
                                                                                        }
                                                                                        if ($user_email != '') {
                                                                                            echo $user_email;
                                                                                        } else {
                                                                                            if (isset($email[0]['Email'])) {
                                                                                                $all_email = array_column($email, 'Email');
                                                                                                echo implode(",", $all_email);
                                                                                            }
                                                                                        }

                                                                                        ?>
                </td>

                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>" style="text-align:center ! important;width:35px;"><?php echo $rec['Sex'] ?></td>
                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>"><?php
                                                                    $user_address = get_user_address($rec['ID']);
                                                                    $user_country = array_column($user_address, 'CountryName');
                                                                    echo implode(",", $user_country);

                                                                    ?>
                </td>
                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>"><?php
                                                                    $user_country_id = array_column($user_address, 'Country');

                                                                    if (in_array("USA", $user_country_id)) {
                                                                        $state_list = get_us_state_by_state_id($rec['ID'], 'USA');
                                                                        $user_country = array_column($state_list, 'StateName');
                                                                        echo implode(",<br>", $user_country);
                                                                    }
                                                                    ?>
                </td>

                <td style="width:120px;"><?= $coursedata[0]['CourseTitle'] . "-" . $coursedata[0]['Course']; ?>
                </td>

                <td style="width:27px;"><?php echo $coursedata[0]['Class']; ?></td>
                <td style="width:42px;"><?php echo $coursedata[0]['Semester']; ?></td>
                <td><?php echo $coursedata[0]['credits'];
                    $current_to_credit = $current_to_credit + $coursedata[0]['credits'];
                    $m_abc[$coursedata[0]['CourseID']] =  $m_abc[$coursedata[0]['CourseID']] + $coursedata[0]['credits'];
                    ?></td>
                <td rowspan="<?php echo sizeof($coursedata) + 1 ?>"><?php echo $rec['Ethnicity']; ?></td>
            </tr>
            <?php

            for ($k = 1; $k < sizeof($coursedata); $k++) {

            ?>
                <tr>
                    <td style="width:120px;"><?= $coursedata[$k]['CourseTitle'] . "-" . $coursedata[$k]['Course']; ?>
                    </td>

                    <td style="width:27px;"><?php echo $coursedata[$k]['Class']; ?></td>
                    <td style="width:42px;"><?php echo $coursedata[$k]['Semester']; ?></td>
                    <td><?php echo $coursedata[$k]['credits'];
                        $current_to_credit = $current_to_credit + $coursedata[$k]['credits'];
                        $m_abc[$coursedata[$k]['CourseID']] =  $m_abc[$coursedata[$k]['CourseID']] + $coursedata[$k]['credits'];
                        ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <th colspan="3">Total Credit</th>
                <td><?= $current_to_credit ?></td>
            </tr>
        <?php
            $credit = $current_to_credit;
            if ($rec['Ethnicity'] == 'Unknown') {
                $m_unknown = $m_unknown + 1;
                if ($credit < 6) {
                    $minus_m_unknown = $minus_m_unknown + 1;
                } else {
                    $plus_m_unknown = $plus_m_unknown + 1;
                }
            }
            if ($rec['Ethnicity'] == '') {
                $m_unknown = $m_unknown + 1;
                if ($credit < 6) {
                    $minus_m_unknown = $minus_m_unknown + 1;
                } else {
                    $plus_m_unknown = $plus_m_unknown + 1;
                }
            }
            if ($rec['Ethnicity'] == 'White') {
                $m_white = $m_white + 1;
                if ($credit < 6) {
                    $minus_m_white = $minus_m_white + 1;
                } else {
                    $plus_m_white = $plus_m_white + 1;
                }
            }
            if ($rec['Ethnicity'] == 'Asian') {
                $m_asian = $m_asian + 1;
                if ($credit < 6) {
                    $minus_m_asian = $minus_m_asian + 1;
                } else {
                    $plus_m_asian = $plus_m_asian + 1;
                }
            }
            if ($rec['Ethnicity'] == 'Black/African American') {
                $m_black = $m_black + 1;

                if ($credit < 6) {
                    $minus_m_black = $minus_m_black + 1;
                } else {
                    $plus_m_black = $plus_m_black + 1;
                }
            }
            if ($rec['Ethnicity'] == 'm_hispanic/Latino') {
                $m_hispanic = $m_hispanic + 1;
                if ($credit < 6) {
                    $minus_m_hispanic = $minus_m_hispanic + 1;
                } else {
                    $plus_m_hispanic = $plus_m_hispanic + 1;
                }
            }
            if ($rec['Ethnicity'] == 'American Indian') {
                $m_native_american = $m_native_american + 1;
                if ($credit < 6) {
                    $minus_m_native_american = $minus_m_native_american + 1;
                } else {
                    $plus_m_native_american = $plus_m_native_american + 1;
                }
            }
            if ($rec['Ethnicity'] == 'Non-Resident Alien') {
                $m_non_resient_alien = $m_non_resient_alien + 1;
                if ($credit < 6) {
                    $minus_m_non_resient_alien = $minus_m_non_resient_alien + 1;
                } else {
                    $plus_m_non_resient_alien = $plus_m_non_resient_alien + 1;
                }
            }
            if ($rec['Ethnicity'] == 'Native Hawaiian/Pacific Islander') {
                $m_hawaiian = $m_hawaiian + 1;
                if ($credit < 6) {
                    $minus_m_hawaiian = $minus_m_hawaiian + 1;
                } else {
                    $plus_m_hawaiian = $plus_m_hawaiian + 1;
                }
            }
            if ($rec['Ethnicity'] == 'Two or more races') {
                $m_two = $m_two + 1;
                if ($credit < 6) {
                    $minus_m_two = $minus_m_two + 1;
                } else {
                    $plus_m_two = $plus_m_two + 1;
                }
            }


            $current_to_credit = 0;
        }
        ?>
    </tbody>

</table>

<h5>Subtotal Men</h5>
<table class="table table-striped table-bordered" style="margin-top:20px;width:50%;">
    <thead>

        <tr>
            <th>Course</th>
            <th>Class</th>
            <th>Semester</th>
            <th>Total Credit</th>
        </tr>
    </thead>
    <?php
    $m_sub_total_credit = 0;
    //echo $CourseID;
    //echo "<pre>";print_r($abc);die;
    foreach ($m_abc as $key => $val) {
        $coursedet = getCorse_details_by_ID($key);
        //echo "<pre>";print_r($coursedet);echo "</pre>";
    ?>
        <tbody>
            <tr>
                <td><?= $coursedet['CourseTitle'] . "-" . $coursedet['Course']; ?></td>
                <!--td><?= $coursedet['CourseID']; ?></td-->
                <td><?= $coursedet['Class']; ?></td>
                <td><?= $coursedet['Semester']; ?></td>
                <td><?php echo $val;
                    $m_sub_total_credit = $m_sub_total_credit + $val;
                    ?></td>
            </tr>

        <?php } ?>
        <tr>
            <th colspan="3">Total Credit</th>
            <td><?php echo $m_sub_total_credit; ?> </td>
        </tr>
        </tbody>
</table>
<br /><br />

<table class="table table-striped table-bordered" style="margin-top:20px;width:50%;">
    <thead>
        <tr>
            <th></th>
            <th>Total</th>
            <!--th>Full Time (6 +ch)</th>
                                                    <th>Part Time (< 6 ch)</th-->
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Unknown</th>
            <td><?= $m_unknown ?></td>
            <!--th><?= $plus_m_unknown ?></td>
                                                    <td><?= $minus_m_unknown ?></td-->
        </tr>
        <tr>
            <th>White</th>
            <td><?= $m_white ?></td>
            <!--th><?= $plus_m_white ?></td>
                                                    <td><?= $minus_m_white ?></td-->
        </tr>
        <tr>
            <th>Asian</th>
            <td><?= $m_asian ?></td>
            <!--th><?= $plus_m_asian ?></td>
                                                    <td><?= $minus_m_asian ?></td-->
        </tr>
        <tr>
            <th>Black/African American</th>
            <td><?= $m_black ?></td>
            <!--th><?= $plus_m_black ?></td>
                                                    <td><?= $minus_m_black ?></td-->
        </tr>
        <tr>
            <th>Hispanic/Latino</th>
            <td><?= $m_hispanic ?></td>
            <!--th><?= $plus_m_hispanic ?></td>
                                                    <td><?= $minus_m_hispanic ?></td-->
        </tr>
        <tr>
            <th>American Indian</th>
            <td><?= $m_native_american ?></td>
            <!--th><?= $plus_m_native_american ?></td>
                                                    <td><?= $minus_m_native_american ?></td-->
        </tr>
        <tr>
            <th>Non-Resident Alien</th>
            <td><?= $m_non_resient_alien ?></td>
            <!--td><?= $plus_m_non_resient_alien ?></td>
                                                    <td><?= $minus_m_non_resient_alien ?></td-->
        </tr>
        <tr>
            <th>Native Hawaiian/Pacific Islander</th>
            <td><?= $m_hawaiian ?></td>
            <!--td><?= $plus_m_hawaiian ?></td>
                                                    <td><?= $minus_m_hawaiian ?></td-->
        </tr>
        <tr>
            <th>Two or more races</th>
            <td><?= $m_two ?></td>
            <!--td><?= $plus_m_two ?></td>
                                                    <td><?= $minus_m_two ?></td-->
        </tr>

        <tr>
            <th>Total</th>
            <td><?= $m_unknown + $m_white + $m_asian + $m_black + $m_hispanic + $m_native_american + $m_non_resient_alien + $m_hawaiian + $m_two ?></td>
            <!--td><?= $plus_m_unknown + $plus_m_white + $plus_m_asian + $plus_m_black + $plus_m_hispanic + $plus_m_native_american + $plus_m_non_resient_alien + $plus_m_hawaiian + $plus_m_two ?></td>
                                                    <td><?= $minus_m_unknown + $minus_m_white + $minus_m_asian + $minus_m_black + $minus_m_hispanic + $minus_m_native_american + $minus_m_non_resient_alien + $minus_m_hawaiian + $minus_m_two ?></td-->
        </tr>


    </tbody>
</table>

<?php
$get_total_course = array();
foreach ($m_unique_types as $ele => $val) {
    //$coursedet=getCorse_details_by_ID($ele);
    $get_total_course[$val] = $abc[$val] + $m_abc[$val];
}
//	echo '<pre>tesssssssssss';print_r($get_total_course);echo "</pre>";
//	echo '<pre>';print_r($m_unique_types);echo '</pre>';
?>
<br /><br />

<table class="table table-striped table-bordered" style="margin-top:20px;width:50%;">
    <thead>
        <tr>
            <th>Course</th>
            <th>Class</th>
            <th>Semester</th>
            <th>Total Credits</th>
        </tr>
    </thead>
    <?php
    //$get_total_course = array();
    $grand_credit = 0;
    foreach ($get_total_course as $ele => $val) {
        //$coursedet=getCorse_details_by_ID($ele);
        $get_total_course[$val] = $abc[$val] + $m_abc[$val];

    ?>

        <tbody>
            <tr>
                <td><?php echo $coursedet['CourseTitle'] . "-" . $coursedet['Course']; ?></td>
                <td><?php echo $coursedet['Class']; ?></td>
                <td><?php echo $coursedet['Semester']; ?></td>
                <td><?php echo $val;
                    $grand_credit = $grand_credit + $val;
                    ?></td>
            </tr>
        <?php
    } ?>
        <tr>
            <th colspan="3">Total Credits</th>
            <td><?php echo $grand_credit; ?></td>
        </tr>


        </tbody>
</table>


<br /><br />

<table class="table table-striped table-bordered" style="margin-top:20px;width:50%;">
    <thead>
        <tr>
            <th></th>
            <th>Total</th>
            <!--th>Full Time (6 +ch)</th>
                                                    <th>Part Time (< 6 ch)</th-->
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Unknown</th>
            <td><?= $m_unknown + $unknown ?></td>
            <!--th><?= $plus_m_unknown + $plus_unknown ?></td>
                                                    <td><?= $minus_m_unknown + $minus_unknown ?></td-->
        </tr>
        <tr>
            <th>White</th>
            <td><?= $m_white + $white ?></td>
            <!--th><?= $plus_m_white + $plus_white ?></td>
                                                    <td><?= $minus_m_white + $minus_white ?></td-->
        </tr>
        <tr>
            <th>Asian</th>
            <td><?= $m_asian + $asian ?></td>
            <!--th><?= $plus_m_asian + $plus_asian ?></td>
                                                    <td><?= $minus_m_asian + $minus_asian ?></td-->
        </tr>
        <tr>
            <th>Black/African American</th>
            <td><?= $m_black + $black ?></td>
            <!--th><?= $plus_m_black + $plus_black ?></td>
                                                    <td><?= $minus_m_black + $minus_black ?></td-->
        </tr>
        <tr>
            <th>Hispanic/Latino</th>
            <td><?= $m_hispanic + $hispanic ?></td>
            <!--th><?= $plus_m_hispanic + $plus_hispanic ?></td>
                                                    <td><?= $minus_m_hispanic + $minus_hispanic ?></td-->
        </tr>
        <tr>
            <th>American Indian</th>
            <td><?= $m_native_american + $native_american ?></td>
            <!--th><?= $plus_m_native_american + $plus_native_american ?></td>
                                                    <td><?= $minus_m_native_american + $minus_native_american ?></td-->
        </tr>
        <tr>
            <th>Non-Resident Alien</th>
            <td><?= $m_non_resient_alien + $non_resient_alien ?></td>
            <!--td><?= $plus_m_non_resient_alien + $plus_non_resient_alien ?></td>
                                                    <td><?= $minus_m_non_resient_alien + $minus_non_resient_alien ?></td-->
        </tr>
        <tr>
            <th>Native Hawaiian/Pacific Islander</th>
            <td><?= $m_hawaiian + $hawaiian ?></td>
            <!--td><?= $plus_m_hawaiian + $plus_hawaiian ?></td>
                                                    <td><?= $minus_m_hawaiian + $minus_hawaiian ?></td-->
        </tr>
        <tr>
            <th>Two or more races</th>
            <td><?= $m_two + $_two ?></td>
            <!--td><?= $plus_m_two + $plus_two ?></td>
                                                    <td><?= $minus_m_two + $minus_two ?></td-->
        </tr>

        <tr>
            <th>Total Students</th>
            <td><?= $m_unknown + $m_white + $m_asian + $m_black + $m_hispanic + $m_native_american + $m_non_resient_alien + $m_hawaiian + $m_two + $unknown + $white + $asian + $black + $hispanic + $native_american + $non_resient_alien + $hawaiian + $two ?></td>
            <!--td><?= $plus_m_unknown + $plus_m_white + $plus_m_asian + $plus_m_black + $plus_m_hispanic + $plus_m_native_american + $plus_m_non_resient_alien + $plus_m_hawaiian + $plus_m_two + $plus_unknown + $plus_white + $plus_asian + $plus_black + $plus_hispanic + $plus_native_american + $plus_non_resient_alien + $plus_hawaiian + $plus_two ?></td>
                                                    <td><?= $minus_m_unknown + $minus_m_white + $minus_m_asian + $minus_m_black + $minus_m_hispanic + $minus_m_native_american + $minus_m_non_resient_alien + $minus_m_hawaiian + $minus_m_two + $minus_unknown + $minus_white + $minus_asian + $minus_black + $minus_hispanic + $minus_native_american + $minus_non_resient_alien + $minus_hawaiian + $minus_two ?></td-->
        </tr>

        <tr>
            <th>Total Credits</th>
            <td><?= $grand_credit ?></td>
        </tr>
        <tr>
            <th>FTE</th>
            <td><?= ($grand_credit) / 24 ?></td>
        </tr>
    </tbody>
</table>