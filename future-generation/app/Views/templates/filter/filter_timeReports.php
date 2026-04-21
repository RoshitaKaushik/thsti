 <?php $vari_array = array();
    $content = "";
    $content .= "<tfoot><tr><td class='emp_column'>Total</td>" ?>
 <div class="part_one" <?= $tab_part_one ?>>
     <table id="employee_time_report" class="table table-striped table-bordered datatable_th dataTable" style="width:100% ! important">
         <thead>
             <th class="emp_column">Employees</th>
             <?php
                foreach ($category as $cat) {
                    $content .= "<td></td>";
                ?>
                 <th>
                     <div class="text-rotate"> <?= $cat['catagory_name'] ?></div>
                 </th>
             <?php
                }
                ?>
             <th>Total Hours</th>
             <th>Total Days</th>
             <th>Hourly Rate</th>
             <th>Total Grant Hours</th>
         </thead>
         <tbody>
             <?php
                $content .= "<td></td>";
                $content .= "<td></td>";
                $content .= "<td></td>";
                $content .= "<td></td>";
                $content .= "</tr></tfoot>";
                $user_unique_category_sum = array();
                $user_unique_category_grantsum = array();
                $tota_hours_id = array();
                $first_category_wise_total_sum = array();
                foreach ($users as $user) {
                ?>
                 <tr>
                     <td class="emp_column text-left"><?= $user['FirstName'] . " " . $user['LastName'] ?></td>
                     <?php
                        $user_total_hours = 0.00;
                        $current_hourly_rate = 0;
                        $current_total_grant_hour = 0;
                        foreach ($category as $cat) {
                            // get total hours with category and  duration wise
                            $records = get_time_report_hr_min_user_category_wise($user['ID'], $cat['cat_id'], $selected_start_date, $selected_end_date);
                            echo "<td>";
                            if (!empty($records)) {
                                $current_total_hours = $records[0]['hours1'] + minuteToHours($records[0]['minute1']);
                                $current_total_hours = preg_replace('/\.(\d{2}).*/', '.$1', $current_total_hours);
                                echo $current_total_hours = number_format((float)($current_total_hours), 2, '.', '');
                                $user_total_hours = $user_total_hours + $current_total_hours;
                                /*echo "<br>Hours". $records[0]['hours1'];
                              echo "<br>Minutes". $records[0]['minute1'];
                              echo "<br>Total". $records[0]['hours'];*/
                                $current_hourly_rate = $records[0]['daily_rate'];
                                if ($cat['grant_type'] == 'Yes') {
                                    $current_total_grant_hour = $current_total_grant_hour + $current_total_hours;
                                    $user_unique_category_grantsum[$user['ID']] = $current_total_grant_hour;
                                }
                                $user_unique_category_sum[$user['ID'] . "_" . $cat['cat_id']] = $current_total_hours;

                                $first_category_wise_total_sum[$cat['cat_id']] = isset($first_category_wise_total_sum[$cat['cat_id']]) ?? '' + $current_total_hours;
                            }
                            echo "</td>";
                        }
                        $tota_hours_id[$user['ID']] = number_format((float)($user_total_hours), 2, '.', '');

                        ?>
                     <td><?php $first_category_wise_total_sum['total_hours'] = isset($first_category_wise_total_sum['total_hours']) ?? '' + number_format((float)($user_total_hours), 2, '.', '');
                            echo number_format((float)($user_total_hours), 2, '.', ''); ?>
                     </td>
                     <td><?= number_format((float)($user_total_hours) / 8, 2, '.', ''); ?></td>
                     <td><?= number_format((float)($current_hourly_rate), 3, '.', ''); ?></td>
                     <td><?= number_format((float)($current_total_grant_hour), 2, '.', ''); ?></td>
                 </tr>
             <?php
                }


                ?>

             <tr>
                 <td><b>Total</b></td><?php
                                        foreach ($category as $cat) {
                                            echo "<td><b>" . number_format((float)($first_category_wise_total_sum[$cat['cat_id']]), 2, '.', '') . "</b></td>";
                                        } ?>
                 <td>
                     <b>
                         <?php
                            echo number_format((float)($first_category_wise_total_sum['total_hours'] ?? ''), 2, '.', '')
                            ?>
                     </b>
                 </td>
                 <td></td>
                 <th></th>
                 <th></th>
             </tr>

         </tbody>
         <!--tfoot-->

         <!--/tfoot-->

     </table>
 </div>

 <div class="part_percentage" <?= $tab_part_percentage ?>>
     <div class="percentage_table_div">
         <table id="employee_time_report_percentage" class="table table-striped table-bordered datatable_th dataTable" style="width:100% ! important">
             <thead>
                 <th class="emp_column">Employees</th>
                 <?php
                    foreach ($category as $cat) {
                        $content .= "<td></td>";
                    ?>
                     <th>
                         <div class="text-rotate"><?= $cat['catagory_name'] ?></div>
                     </th>
                 <?php
                    }
                    ?>
                 <th>Total Hours</th>
                 <th>Total Days</th>
                 <th>Hourly Rate</th>
                 <th>Total Grant Hours</th>
             </thead>
             <tbody>
                 <?php
                    $category_wise_total_sum = array();
                    foreach ($users as $user) {

                        $current_row_percentage = 0;
                    ?>
                     <tr>
                         <td class="text-left"><?= $user['FirstName'] . " " . $user['LastName'] ?></td>
                         <?php
                            foreach ($category as $cat) {
                                echo "<td>";
                                if ($cat['grant_type'] == 'Yes') {
                                    echo "NA";
                                } else if (isset($user_unique_category_sum[$user['ID'] . "_" . $cat['cat_id']])) {
                                    $userId = $user['ID'];
                                    $catId  = $cat['cat_id'];

                                    $userCatKey = $userId . "_" . $catId;

                                    $userCatSum       = isset($user_unique_category_sum[$userCatKey]) ? $user_unique_category_sum[$userCatKey] : 0;
                                    $totalHours       = isset($tota_hours_id[$userId]) ? $tota_hours_id[$userId] : 0;
                                    $userGrantSum     = isset($user_unique_category_grantsum[$userId]) ? $user_unique_category_grantsum[$userId] : 0;

                                    $denominator = $totalHours - $userGrantSum;

                                    $current_category_percentage = $denominator != 0
                                        ? ($userCatSum / $denominator) * 100
                                        : 0;

                                    //$current_category_percentage = preg_replace('/\.(\d{2}).*/', '.$1', $current_category_percentage);
                                    $current_category_percentage =  number_format((float)($current_category_percentage), 2, '.', '');
                                    $current_row_percentage = $current_row_percentage + $current_category_percentage;
                                    echo $current_category_percentage . "%";
                                    $category_wise_total_sum[$cat['cat_id']] = isset($category_wise_total_sum[$cat['cat_id']])??'' + $current_category_percentage;
                                } else {
                                    echo "0.00";
                                }
                                echo "</td>";
                            }
                            ?>
                         <td>
                             <?php
                                $cur_row_sum = number_format((float)($current_row_percentage), 2, '.', '');
                                if ($cur_row_sum > 100 && $cur_row_sum < 101) {
                                    echo "100.00%";
                                } else {
                                    echo $cur_row_sum . "%";
                                }
                                ?></td>
                         <td></td>
                         <td></td>
                         <td></td>
                     </tr>
                 <?php
                    }
                    ?>
             </tbody>
             <tfoot>
                 <tr>
                     <td><b>Total</b></td>
                     <?php
                        foreach ($category as $cat) {
                            echo "<td><b>";
                            if ($cat['grant_type'] == 'Yes') {
                                echo "0.00";
                            } else {
                                echo $cur_row_sum = number_format((float)(($category_wise_total_sum[$cat['cat_id']] / 100)), 2, '.', '');
                            }
                            echo "</b></td>";
                        }
                        echo "<th></th>";
                        echo "<th></th>";
                        echo "<th></th>";
                        echo "<th></th>";
                        ?>
                 </tr>
             </tfoot>
         </table>
     </div>
 </div>