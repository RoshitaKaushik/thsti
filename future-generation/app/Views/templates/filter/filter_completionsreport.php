<div class="col-sm-12">
    <h3>Women</h3>
    <div class="table-responsive">
        <table id="SemesterListing" class="table datatable_th table-striped table-bordered">
            <thead>
                <tr>
                    <th data-name="<?= encryptor('encrypt', 'Sno') ?>" data-status="No">Sno</th>
                    <th data-name="<?= encryptor('encrypt', 'FirstName') ?>">First Name</th>
                    <th data-name="<?= encryptor('encrypt', 'LastName') ?>">Last Name</th>
                    <th data-name="<?= encryptor('encrypt', 'Email') ?>">Email</th>
                    <th data-name="<?= encryptor('encrypt', 'Sex') ?>">Gender</th>
                    <th data-name="<?= encryptor('encrypt', 'Age') ?>" data-status="No">Age</th>
                    <th data-name="<?= encryptor('encrypt', 'Countries') ?>">Country</th>
                    <th data-name="<?= encryptor('encrypt', 'Graduation') ?>">Graduation Date</th>
                    <th data-name="<?= encryptor('encrypt', 'Ethnicity') ?>">Ethnicity</th>
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

                $age_under_18 = 0;
                $age_18_24 = 0;
                $age_25_39 = 0;
                $age_above_40 = 0;
                $age_unknown = 0;




                foreach ($records as $rec) {
                    if ($selected_age == '') {
                        $years = '';
                        if ($rec['Birthdate'] != '') {
                            $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                            $date2 = date('Y-m-d');
                            if ($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00') {
                                $date2 = date('Y-m-d', strtotime($rec['Graduation']));
                            }
                            $diff = abs(strtotime($date2) - strtotime($date1));
                            $years = floor($diff / (365 * 60 * 60 * 24));

                            if ($years < 18 && $years > 0) {
                                $age_under_18 = $age_under_18 + 1;
                            }
                            if ($years > 17 && $years < 25) {
                                $age_18_24 = $age_18_24 + 1;
                            }
                            if ($years > 24 && $years < 40) {
                                $age_25_39 = $age_25_39 + 1;
                            }
                            if ($years > 39) {
                                $age_above_40 = $age_above_40 + 1;
                            }
                        } else {
                            $age_unknown = $age_unknown + 1;
                        }
                ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $rec['FirstName']; ?></td>
                            <td><?= $rec['LastName']; ?></td>
                            <td><?php
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

                            <td style="text-align:center ! important;"><?= $rec['Sex'] ?></td>

                            <td>
                                <?php
                                if ($rec['Birthdate'] != '') {
                                    $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                                    $date2 = date('Y-m-d');
                                    if ($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00') {
                                        $date2 = date('Y-m-d', strtotime($rec['Graduation']));
                                    }
                                    $diff = abs(strtotime($date2) - strtotime($date1));
                                    echo $years = floor($diff / (365 * 60 * 60 * 24));
                                }

                                ?>
                            </td>

                            <td>
                                <?php
                                echo $rec['CountryName'];
                                /*$user_country = array_column($user_address, 'CountryName');
                                   echo implode(",<br>",$user_country);*/
                                ?>
                            </td>
                            <td data-sort="<?= $rec['Graduation'] ?>"><?php if ($rec['Graduation'] != '') {
                                                                            echo date('m/d/Y', strtotime($rec['Graduation']));
                                                                        } ?></td>
                            <td>
                                <?php
                                echo $rec['Ethnicity'];



                                if ($rec['Ethnicity'] == 'Unknown') {
                                    $unknown = $unknown + 1;
                                }
                                if ($rec['Ethnicity'] == 'White') {
                                    $white = $white + 1;
                                }
                                if ($rec['Ethnicity'] == 'Asian') {
                                    $asian = $asian + 1;
                                }
                                if ($rec['Ethnicity'] == 'Black/African American') {
                                    $black = $black + 1;
                                }
                                if ($rec['Ethnicity'] == 'Hispanic/Latino') {
                                    $hispanic = $hispanic + 1;
                                }
                                if ($rec['Ethnicity'] == 'American Indian') {
                                    $native_american = $native_american + 1;
                                }
                                if ($rec['Ethnicity'] == 'Non-Resident Alien') {
                                    $non_resient_alien = $non_resient_alien + 1;
                                }
                                if ($rec['Ethnicity'] == 'Native Hawaiian/Pacific Islander') {
                                    $hawaiian = $hawaiian + 1;
                                }
                                if ($rec['Ethnicity'] == 'Two or more races') {
                                    $two = $two + 1;
                                }




                                ?>


                            </td>
                        </tr>
                        <?php
                    } else if ($selected_age != '') {
                        $years = '';
                        if ($rec['Birthdate'] != '') {
                            $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                            $date2 = date('Y-m-d');
                            $diff = abs(strtotime($date2) - strtotime($date1));
                            $years = floor($diff / (365 * 60 * 60 * 24));
                        }
                        if ($selected_age == 'Under 18') {

                            if ($years < 18 && $years > 0) {

                        ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $rec['FirstName']; ?></td>
                                    <td><?= $rec['LastName']; ?></td>
                                    <td><?php
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

                                    <td style="text-align:center ! important;"><?= $rec['Sex'] ?></td>

                                    <td>
                                        <?php
                                        if ($rec['Birthdate'] != '') {
                                            $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                                            $date2 = date('Y-m-d');
                                            $diff = abs(strtotime($date2) - strtotime($date1));
                                            echo $years = floor($diff / (365 * 60 * 60 * 24));
                                        }

                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $rec['CountryName'];
                                        /*$user_country = array_column($user_address, 'CountryName');
                                   echo implode(",<br>",$user_country);*/
                                        ?>
                                    </td>
                                    <td data-sort="<?= $rec['Graduation'] ?>"><?php if ($rec['Graduation'] != '') {
                                                                                    echo date('m/d/Y', strtotime($rec['Graduation']));
                                                                                } ?></td>
                                    <td></td>
                                </tr>

                            <?php
                            }
                        } else if ($selected_age == '18-24') {

                            if ($years > 17 && $years < 25) {

                            ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $rec['FirstName']; ?></td>
                                    <td><?= $rec['LastName']; ?></td>
                                    <td><?php
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

                                    <td style="text-align:center ! important;"><?= $rec['Sex'] ?></td>

                                    <td>
                                        <?php
                                        if ($rec['Birthdate'] != '') {
                                            $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                                            $date2 = date('Y-m-d');
                                            $diff = abs(strtotime($date2) - strtotime($date1));
                                            echo $years = floor($diff / (365 * 60 * 60 * 24));
                                        }

                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $rec['CountryName'];
                                        /*$user_country = array_column($user_address, 'CountryName');
                                   echo implode(",<br>",$user_country);*/
                                        ?>
                                    </td>
                                    <td><?php if ($rec['Graduation'] != '') {
                                            echo date('m/d/Y', strtotime($rec['Graduation']));
                                        } ?></td>
                                    <td></td>
                                </tr>


                            <?php
                            }
                        } else if ($selected_age == '25-39') {

                            if ($years > 24 && $years < 40) {

                            ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $rec['FirstName']; ?></td>
                                    <td><?= $rec['LastName']; ?></td>
                                    <td><?php
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

                                    <td style="text-align:center ! important;"><?= $rec['Sex'] ?></td>

                                    <td>
                                        <?php
                                        if ($rec['Birthdate'] != '') {
                                            $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                                            $date2 = date('Y-m-d');
                                            $diff = abs(strtotime($date2) - strtotime($date1));
                                            echo $years = floor($diff / (365 * 60 * 60 * 24));
                                        }

                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $rec['CountryName'];
                                        /*$user_country = array_column($user_address, 'CountryName');
                                   echo implode(",<br>",$user_country);*/
                                        ?>
                                    </td>
                                    <td data-sort="<?= $rec['Graduation'] ?>"><?php if ($rec['Graduation'] != '') {
                                                                                    echo date('m/d/Y', strtotime($rec['Graduation']));
                                                                                } ?></td>
                                    <td></td>
                                </tr>


                            <?php
                            }
                        } else if ($selected_age == '40 and Above') {

                            if ($years > 39) {

                            ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $rec['FirstName']; ?></td>
                                    <td><?= $rec['LastName']; ?></td>
                                    <td><?php
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

                                    <td style="text-align:center ! important;"><?= $rec['Sex'] ?></td>

                                    <td>
                                        <?php
                                        if ($rec['Birthdate'] != '') {
                                            $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                                            $date2 = date('Y-m-d');
                                            $diff = abs(strtotime($date2) - strtotime($date1));
                                            echo $years = floor($diff / (365 * 60 * 60 * 24));
                                        }

                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $rec['CountryName'];
                                        /*$user_country = array_column($user_address, 'CountryName');
                                   echo implode(",<br>",$user_country);*/
                                        ?>
                                    </td>
                                    <td data-sort="<?= $rec['Graduation'] ?>"><?php if ($rec['Graduation'] != '') {
                                                                                    echo date('m/d/Y', strtotime($rec['Graduation']));
                                                                                } ?></td>
                                    <td></td>
                                </tr>




                            <?php
                            }
                        } else if ($rec['Birthdate'] == '') {


                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $rec['FirstName']; ?></td>
                                <td><?= $rec['LastName']; ?></td>
                                <td><?php
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

                                <td style="text-align:center ! important;"><?= $rec['Sex'] ?></td>

                                <td>
                                    <?php
                                    if ($rec['Birthdate'] != '') {
                                        $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                                        $date2 = date('Y-m-d');
                                        $diff = abs(strtotime($date2) - strtotime($date1));
                                        echo $years = floor($diff / (365 * 60 * 60 * 24));
                                    }

                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo $rec['CountryName'];
                                    /*$user_country = array_column($user_address, 'CountryName');
                                   echo implode(",<br>",$user_country);*/
                                    ?>
                                </td>
                                <td data-sort="<?= $rec['Graduation'] ?>"><?php if ($rec['Graduation'] != '') {
                                                                                echo date('m/d/Y', strtotime($rec['Graduation']));
                                                                            } ?></td>
                                <td></td>
                            </tr>




                <?php

                        }
                    }
                }
                ?>
            </tbody>

            <tfoot>
                <th colspan="3" style="text-align:right;"> Grand Total</th>
                <th colspan="6"><?php echo $i - 1; ?></th>

            </tfoot>
        </table>
    </div>




    <div class="row">
        <div class="col-md-4">
            <table class="table table-striped table-bordered">
                <tr>
                    <th colspan="2" style="text-align:center ! important;">Ethnicity</th>

                </tr>
                <tr>
                    <th>Unknown</th>
                    <td><?= $unknown ?></td>
                </tr>
                <tr>
                    <th>White</th>
                    <td><?= $white ?></td>
                </tr>
                <tr>
                    <th>Asian</th>
                    <td><?= $asian ?></td>
                </tr>
                <tr>
                    <th>Black/African American</th>
                    <td><?= $black ?></td>
                </tr>
                <tr>
                    <th>Hispanic/Latino</th>
                    <td><?= $hispanic ?></td>
                </tr>
                <tr>
                    <th>American Indian</th>
                    <td><?= $native_american ?></td>
                </tr>
                <tr>
                    <th>Non-Resident Alien</th>
                    <td><?= $non_resient_alien ?></td>
                </tr>


                <tr>
                    <th>Native Hawaiian/Pacific Islander</th>
                    <td><?= $hawaiian ?></td>
                </tr>
                <tr>
                    <th>Two or more races</th>
                    <td><?= $two ?></td>
                </tr>

                <tr>
                    <th>Total Women</th>
                    <td><?= $unknown + $white + $asian + $black + $hispanic + $native_american + $non_resient_alien + $hawaiian + $two ?></td>
                </tr>


            </table>

        </div>


        <div class="col-md-4">

        </div>

        <!--div class="col-md-4">
               
               
               <table class="table table-striped table-bordered">
                   <tr>
                       <th colspan="2" style="text-align:center ! important;">Age Group</th>
                       
                   </tr>
                   
                   <tr>
                       <th>Under 18</th>
                       <td><?= $age_under_18 ?></td>
                   </tr>
                   <tr>
                       <th>18-24</th>
                       <td><?= $age_18_24 ?></td>
                   </tr>
                   <tr>
                       <th>25-39</th>
                       <td><?= $age_25_39 ?></td>
                   </tr>
                   <tr>
                       <th>40 and above</th>
                       <td><?= $age_above_40 ?></td>
                   </tr>
                   <tr>
                       <th>Age Unknown</th>
                       <td><?= $age_unknown ?></td>
                   </tr>
                   
                    <tr>
                       <th>Total Women</th>
                       <td><?= $age_under_18 + $age_18_24 + $age_25_39 + $age_above_40 + $age_unknown ?></td>
                   </tr>
                  
                   
                </table>
               
               
           </div-->




    </div>
























</div>

<div class="col-md-12">
    <hr>
</div>

<div class="col-sm-12">
    <h3>Men</h3>
    <div class="table-responsive">
        <table id="SemesterListing1" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Country</th>
                    <th>Graduation Date</th>
                    <th>Ethnicity</th>
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

                /*$age_under_18 = 0;
                   $age_18_24=0;
                   $age_25_39 = 0;
                   $age_above_40 = 0;
                   $age_unknown = 0;
                   */
                if(isset($men_records)){
                    foreach ($men_records as $rec) {
                    if ($selected_age == '') {
                        $years = '';
                        if ($rec['Birthdate'] != '') {
                            $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                            $date2 = date('Y-m-d');
                            if ($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00') {
                                $date2 = date('Y-m-d', strtotime($rec['Graduation']));
                            }
                            $diff = abs(strtotime($date2) - strtotime($date1));
                            $years = floor($diff / (365 * 60 * 60 * 24));

                            if ($years < 18 && $years > 0) {
                                $age_under_18 = $age_under_18 + 1;
                            }
                            if ($years > 17 && $years < 25) {
                                $age_18_24 = $age_18_24 + 1;
                            }
                            if ($years > 24 && $years < 40) {
                                $age_25_39 = $age_25_39 + 1;
                            }
                            if ($years > 39) {
                                $age_above_40 = $age_above_40 + 1;
                            }
                        } else {
                            $age_unknown = $age_unknown + 1;
                        }
                ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $rec['FirstName']; ?></td>
                            <td><?= $rec['LastName']; ?></td>

                            <td><?php
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

                            <td style="text-align:center ! important;"><?= $rec['Sex'] ?></td>

                            <td>
                                <?php
                                if ($rec['Birthdate'] != '') {
                                    $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                                    $date2 = date('Y-m-d');
                                    if ($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00') {
                                        $date2 = date('Y-m-d', strtotime($rec['Graduation']));
                                    }
                                    $diff = abs(strtotime($date2) - strtotime($date1));
                                    echo $years = floor($diff / (365 * 60 * 60 * 24));
                                }

                                ?>
                            </td>

                            <td>
                                <?php
                                echo $rec['CountryName'];
                                /*$user_country = array_column($user_address, 'CountryName');
                                   echo implode(",<br>",$user_country);*/
                                ?>
                            </td>
                            <td><?php if ($rec['Graduation'] != '') {
                                    echo date('m/d/Y', strtotime($rec['Graduation']));
                                } ?></td>
                            <td>
                                <?php
                                echo $rec['Ethnicity'];



                                if ($rec['Ethnicity'] == 'Unknown') {
                                    $unknown = $unknown + 1;
                                }
                                if ($rec['Ethnicity'] == 'White') {
                                    $white = $white + 1;
                                }
                                if ($rec['Ethnicity'] == 'Asian') {
                                    $asian = $asian + 1;
                                }
                                if ($rec['Ethnicity'] == 'Black/African American') {
                                    $black = $black + 1;
                                }
                                if ($rec['Ethnicity'] == 'Hispanic/Latino') {
                                    $hispanic = $hispanic + 1;
                                }
                                if ($rec['Ethnicity'] == 'American Indian') {
                                    $native_american = $native_american + 1;
                                }
                                if ($rec['Ethnicity'] == 'Non-Resident Alien') {
                                    $non_resient_alien = $non_resient_alien + 1;
                                }
                                if ($rec['Ethnicity'] == 'Native Hawaiian/Pacific Islander') {
                                    $hawaiian = $hawaiian + 1;
                                }
                                if ($rec['Ethnicity'] == 'Two or more races') {
                                    $two = $two + 1;
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    } else if ($selected_age != '') {
                        $years = '';
                        if ($rec['Birthdate'] != '') {
                            $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                            $date2 = date('Y-m-d');
                            if ($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00') {
                                $date2 = date('Y-m-d', strtotime($rec['Graduation']));
                            }
                            $diff = abs(strtotime($date2) - strtotime($date1));
                            $years = floor($diff / (365 * 60 * 60 * 24));
                        }
                        if ($selected_age == 'Under 18') {

                            if ($years < 18 && $years > 0) {

                        ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $rec['FirstName']; ?></td>
                                    <td><?= $rec['LastName']; ?></td>
                                    <td><?php
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

                                    <td style="text-align:center ! important;"><?= $rec['Sex'] ?></td>

                                    <td>
                                        <?php
                                        if ($rec['Birthdate'] != '') {
                                            $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                                            $date2 = date('Y-m-d');
                                            if ($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00') {
                                                $date2 = date('Y-m-d', strtotime($rec['Graduation']));
                                            }
                                            $diff = abs(strtotime($date2) - strtotime($date1));
                                            echo $years = floor($diff / (365 * 60 * 60 * 24));
                                        }

                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $rec['CountryName'];
                                        /*$user_country = array_column($user_address, 'CountryName');
                                   echo implode(",<br>",$user_country);*/
                                        ?>
                                    </td>
                                    <td><?php if ($rec['Graduation'] != '') {
                                            echo date('m/d/Y', strtotime($rec['Graduation']));
                                        } ?></td>
                                    <td></td>
                                </tr>

                            <?php
                            }
                        } else if ($selected_age == '18-24') {

                            if ($years > 17 && $years < 25) {

                            ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $rec['FirstName']; ?></td>
                                    <td><?= $rec['LastName']; ?></td>
                                    <td><?php
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

                                    <td style="text-align:center ! important;"><?= $rec['Sex'] ?></td>

                                    <td>
                                        <?php
                                        if ($rec['Birthdate'] != '') {
                                            $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                                            $date2 = date('Y-m-d');
                                            if ($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00') {
                                                $date2 = date('Y-m-d', strtotime($rec['Graduation']));
                                            }
                                            $diff = abs(strtotime($date2) - strtotime($date1));
                                            echo $years = floor($diff / (365 * 60 * 60 * 24));
                                        }

                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $rec['CountryName'];
                                        /*$user_country = array_column($user_address, 'CountryName');
                                   echo implode(",<br>",$user_country);*/
                                        ?>
                                    </td>
                                    <td><?php if ($rec['Graduation'] != '') {
                                            echo date('m/d/Y', strtotime($rec['Graduation']));
                                        } ?></td>
                                    <td></td>
                                </tr>


                            <?php
                            }
                        } else if ($selected_age == '25-39') {

                            if ($years > 24 && $years < 40) {

                            ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $rec['FirstName']; ?></td>
                                    <td><?= $rec['LastName']; ?></td>
                                    <td><?php
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

                                    <td style="text-align:center ! important;"><?= $rec['Sex'] ?></td>

                                    <td>
                                        <?php
                                        if ($rec['Birthdate'] != '') {
                                            $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                                            $date2 = date('Y-m-d');
                                            if ($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00') {
                                                $date2 = date('Y-m-d', strtotime($rec['Graduation']));
                                            }
                                            $diff = abs(strtotime($date2) - strtotime($date1));
                                            echo $years = floor($diff / (365 * 60 * 60 * 24));
                                        }

                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $rec['CountryName'];
                                        /*$user_country = array_column($user_address, 'CountryName');
                                   echo implode(",<br>",$user_country);*/
                                        ?>
                                    </td>
                                    <td><?php if ($rec['Graduation'] != '') {
                                            echo date('m/d/Y', strtotime($rec['Graduation']));
                                        } ?></td>
                                    <td></td>
                                </tr>


                            <?php
                            }
                        } else if ($selected_age == '40 and Above') {

                            if ($years > 39) {

                            ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $rec['FirstName']; ?></td>
                                    <td><?= $rec['LastName']; ?></td>
                                    <td><?php
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

                                    <td style="text-align:center ! important;"><?= $rec['Sex'] ?></td>

                                    <td>
                                        <?php
                                        if ($rec['Birthdate'] != '') {
                                            $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                                            $date2 = date('Y-m-d');
                                            if ($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00') {
                                                $date2 = date('Y-m-d', strtotime($rec['Graduation']));
                                            }
                                            $diff = abs(strtotime($date2) - strtotime($date1));
                                            echo $years = floor($diff / (365 * 60 * 60 * 24));
                                        }

                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $rec['CountryName'];
                                        /*$user_country = array_column($user_address, 'CountryName');
                                   echo implode(",<br>",$user_country);*/
                                        ?>
                                    </td>
                                    <td><?php if ($rec['Graduation'] != '') {
                                            echo date('m/d/Y', strtotime($rec['Graduation']));
                                        } ?></td>
                                    <td></td>
                                </tr>




                            <?php
                            }
                        } else if ($rec['Birthdate'] == '') {


                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $rec['FirstName']; ?></td>
                                <td><?= $rec['LastName']; ?></td>
                                <td><?php
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

                                <td style="text-align:center ! important;"><?= $rec['Sex'] ?></td>

                                <td>
                                    <?php
                                    if ($rec['Birthdate'] != '') {
                                        $date1 = date('Y-m-d', strtotime($rec['Birthdate']));
                                        $date2 = date('Y-m-d');
                                        if ($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00') {
                                            $date2 = date('Y-m-d', strtotime($rec['Graduation']));
                                        }
                                        $diff = abs(strtotime($date2) - strtotime($date1));
                                        echo $years = floor($diff / (365 * 60 * 60 * 24));
                                    }

                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo $rec['CountryName'];
                                    /*$user_country = array_column($user_address, 'CountryName');
                                   echo implode(",<br>",$user_country);*/
                                    ?>
                                </td>
                                <td><?php if ($rec['Graduation'] != '') {
                                        echo date('m/d/Y', strtotime($rec['Graduation']));
                                    } ?></td>
                                <td></td>
                            </tr>




                <?php

                        }
                    }
                }
                }
                
                ?>
            </tbody>

            <tfoot>
                <th colspan="3" style="text-align:right;"> Grand Total</th>
                <th colspan="6"><?php echo $i - 1; ?></th>

            </tfoot>
        </table>
    </div>



    <div class="row">
        <div class="col-md-4">
            <table class="table table-striped table-bordered">
                <tr>
                    <th colspan="2" style="text-align:center ! important;">Ethnicity</th>

                </tr>
                <tr>
                    <th>Unknown</th>
                    <td><?= $unknown ?></td>
                </tr>
                <tr>
                    <th>White</th>
                    <td><?= $white ?></td>
                </tr>
                <tr>
                    <th>Asian</th>
                    <td><?= $asian ?></td>
                </tr>
                <tr>
                    <th>Black/African American</th>
                    <td><?= $black ?></td>
                </tr>
                <tr>
                    <th>Hispanic/Latino</th>
                    <td><?= $hispanic ?></td>
                </tr>
                <tr>
                    <th>American Indian</th>
                    <td><?= $native_american ?></td>
                </tr>
                <tr>
                    <th>Non-Resident Alien</th>
                    <td><?= $non_resient_alien ?></td>
                </tr>


                <tr>
                    <th>Native Hawaiian/Pacific Islander</th>
                    <td><?= $hawaiian ?></td>
                </tr>
                <tr>
                    <th>Two or more races</th>
                    <td><?= $two ?></td>
                </tr>

                <tr>
                    <th>Total Men</th>
                    <td><?= $unknown + $white + $asian + $black + $hispanic + $native_american + $non_resient_alien + $hawaiian + $two ?></td>
                </tr>


            </table>

        </div>


        <div class="col-md-4">

        </div>

        <div class="col-md-4">


            <table class="table table-striped table-bordered">
                <tr>
                    <th colspan="2" style="text-align:center ! important;">Age Group</th>

                </tr>

                <tr>
                    <th>Under 18</th>
                    <td><?= $age_under_18 ?></td>
                </tr>
                <tr>
                    <th>18-24</th>
                    <td><?= $age_18_24 ?></td>
                </tr>
                <tr>
                    <th>25-39</th>
                    <td><?= $age_25_39 ?></td>
                </tr>
                <tr>
                    <th>40 and above</th>
                    <td><?= $age_above_40 ?></td>
                </tr>
                <tr>
                    <th>Age Unknown</th>
                    <td><?= $age_unknown ?></td>
                </tr>
                <tr>
                    <th>Total </th>
                    <td><?= $age_under_18 + $age_18_24 + $age_25_39 + $age_above_40 + $age_unknown ?></td>
                </tr>


            </table>


        </div>




    </div>


</div>