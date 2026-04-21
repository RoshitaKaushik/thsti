<table id="alldataTable2" class="table table-striped table-bordered  " style="font-size: 12px;">
    <thead>
        <tr>
            <th>Employee Name</th>
            <th>Date</th>
            <th>Office</th>
            <th>Category</th>
            <th style="width:170px;">Hours Worked</th>
            <th>Hourly Rate</th>
            <th>Journal Entry</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sn=1;
        $cat = '';
        $total_hour = 0;
        $grand_total = 0;
        $t_h_rate = 0;
        $grand_sum =0;
        $em_id = '';
        $check_zero = false;
        $curr_tot_hr = 0;
        $grand_tot_hr = 0;
        $yes_sum = 0;
        $no_sum = 0;
        $yes_hour = 0;
        $no_hour = 0;
        $to_yes_hour = 0;
        $to_no_hour = 0;
        $grand_yes_sum = 0;
        $grand_no_sum = 0;
        $grand_yes_hour = 0;
        $grand_no_hour = 0;
       
        foreach($records as $rec){
            if($cat == ''){
                $curr_hour = 0;
                $curr_tot_hr = 0;
                $cat = $rec['cat_id'];
                $t_h_rate = number_format((float)hourmintodecFormating($rec['hours']), 2, '.', ''); 
                $check_zero = false;
            }
            if($em_id == ''){
                $curr_hour = 0;
                $curr_tot_hr = 0;
                $em_id = $rec['ID']; 
                $check_zero = false;
            }
            if($cat != $rec['cat_id'] || $em_id != $rec['ID']){
                $totol_hours1 = get_category_total_emp($em_id,$cat,$begin_date,$end_date);
                $em_id = $rec['ID'];
                ?>
                <tr>
                    <td colspan="4" style="font-weight:bold;text-align:right;">Total</td>  
                    <td style="font-weight:bold;text-align:left;"><?php
                        $grand_tot_hr = $grand_tot_hr+number_format((float)($curr_tot_hr), 2, '.', '');
                        echo $current_total =  number_format((float)($curr_tot_hr), 2, '.', '') ;
                        if($selected_1099 == '')
                        {
                            $to_yes_hour = $to_yes_hour+$yes_hour;
                            $to_no_hour = $to_no_hour+$no_hour; 
                            $grand_yes_sum = $grand_yes_sum+$yes_hour;
                            $grand_no_sum = $grand_no_sum+$no_hour;
                            echo "<br><b>  1099 Yes:</b> ".number_format((float)($yes_hour), 2, '.', '');
                            echo " <b>  1099 No:</b> ".number_format((float)($no_hour), 2, '.', '');
                        }
                        ?>
                    </td>  
                    <td  style="font-weight:bold;text-align:left;" colspan="4">
                        <?php
                        $grand_sum = $grand_sum+number_format((float)($t_h_rate*$current_total), 2, '.', '');
                        if($check_zero){
                            echo "<span style='color:red;'>Partial Cost : ".number_format((float)($curr_hour), 2, '.', '')."&nbsp;(Daily hour rates missing for selected dates)</span>";
                        }
                        else{
                            echo "Total Cost : ".number_format((float)($curr_hour), 2, '.', '');
                        }
                        if($selected_1099 == ''){
                            $grand_yes_hour = $grand_yes_hour+$yes_sum;
                            $grand_no_hour = $grand_no_hour+$no_sum;
                            echo "<br> <b>  1099 Yes:</b> ".number_format((float)($yes_sum), 2, '.', '');
                            echo " <b>  1099 No:</b> ".number_format((float)($no_sum), 2, '.', '');
                        }
                        $grand_total = $grand_total+number_format((float)($curr_hour), 2, '.', '');
                        ?>
                    </td>
                </tr>
                <?php
                $cat = $rec['cat_id'];
                $t_h_rate = number_format((float)$rec['daily_rate'], 2, '.', '');
                $curr_hour = 0;
                $curr_tot_hr = 0;
                $yes_sum = 0;
                $no_sum = 0;
                $yes_hour = 0;
                $no_hour = 0;
                $check_zero = false;
            }
            ?>
            <tr><?php
                echo "<td>".$rec['FirstName']." ".$rec['LastName']."</td>";      
                $ttt = str_replace("00:00:00","",$rec['transaction_date']);
                echo "<td>".date('m/d/Y',strtotime($ttt))."</td>";
                ?>
                <td><?php echo ($rec['office_status'] == '1')?'<i class="fa fa-check" style="font-style: italic;font-size: 17px;"></i>':'' ?></td>
                <td><?= $rec['catagory_name'] ?></td>
                <td><?php 
                    $curr_tot_hr = $curr_tot_hr+hourmintodecFormating($rec['hours']);
                    if($rec['contract_1099'] == 'Yes'){
                        $yes_hour = $yes_hour+hourmintodecFormating($rec['hours']);
                    }
                    else if($rec['contract_1099'] == 'No'){
                        $no_hour = $no_hour+hourmintodecFormating($rec['hours']);
                    }
                    echo hourmintodecFormating($rec['hours']);
                ?>
                </td>
                <td><?php $curr_hour = $curr_hour+(number_format((float)$rec['daily_rate'], 2, '.', '') * hourmintodecFormating($rec['hours']) ); 
                    if($rec['contract_1099'] == 'Yes'){
                        $yes_sum = $yes_sum+(number_format((float)$rec['daily_rate'], 2, '.', '') * hourmintodecFormating($rec['hours']) );
                    }
                    else if($rec['contract_1099'] == 'No'){
                        $no_sum = $no_sum+(number_format((float)$rec['daily_rate'], 2, '.', '') * hourmintodecFormating($rec['hours']) );
                    }
                    ?>
                    <?=  number_format((float)$rec['daily_rate'], 2, '.', '') ?>
                    <?php
                    if(!$check_zero){
                        if(number_format((float)$rec['daily_rate'], 2, '.', '') == '0.00'){
                            $check_zero = true; 
                        }
                    }
                    ?>
                </td>
                <td style="text-align:left;"><?= $rec['journal'] ?></td>
            </tr>
            <?php
            $last_emp = $rec['ID'];
            $tt = number_format((float)($rec['daily_rate'] * hourmintodecFormating($rec['hours'])), 2, '.', '');
        }
        if($last_emp != '')
        {
            $totol_hours1 = get_category_total_emp($last_emp,$cat,$begin_date,$end_date);        
            ?>
            <tr>
                <td colspan="4" style="font-weight:bold;text-align:right;">Total</td>
                <td style="font-weight:bold;text-align:left;">
                <?php
                $grand_tot_hr = $grand_tot_hr+number_format((float)($curr_tot_hr), 2, '.', '');
                echo $current_total =  number_format((float)($curr_tot_hr), 2, '.', '');
                if($selected_1099 == '')
                {
                    $to_yes_hour = $to_yes_hour+$yes_hour;
                    $to_no_hour = $to_no_hour+$no_hour;
                    $grand_yes_sum = $grand_yes_sum+$yes_hour;
                    $grand_no_sum = $grand_no_sum+$no_hour;
                    echo "<br><b>  1099 Yes :</b> ".number_format((float)($yes_hour), 2, '.', '');
                    echo "<b>  1099 No :</b> ".number_format((float)($no_hour), 2, '.', '');
                }
                ?>
                </td>
                <td style="font-weight:bold;text-align:left;" colspan="2">
                    <?php
                        $grand_sum = $grand_sum+number_format((float)($t_h_rate*$current_total), 2, '.', '');
                        $grand_total = $grand_total+number_format((float)($curr_hour), 2, '.', '');
                        if($check_zero){
                            echo "<span style='color:red;'>Partial Cost : ".number_format((float)($curr_hour), 2, '.', '')."&nbsp;(Daily hour rates missing for selected dates)</span>";
                        }
                        else{
                            echo "Total Cost : ".number_format((float)($curr_hour), 2, '.', '');
                        }
                        if($selected_1099 == ''){
                            $grand_yes_hour = $grand_yes_hour+$yes_sum;
                            $grand_no_hour = $grand_no_hour+$no_sum;  
                            echo "<br> <b>1099 Yes:</b> ".number_format((float)($yes_sum), 2, '.', '');
                            echo " <b>  1099 No:</b> ".number_format((float)($no_sum), 2, '.', '');
                        }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    <tfoot style="height:100px;">
    <tr>
    <th colspan="4" style="text-align:right;font-size:14px;"> Grand Total</th>
    <th style="text-align:left;font-size:14px;"><?php echo number_format((float)($grand_tot_hr), 2, '.', '');
    if($selected_1099 == '')
    {
    echo "<br> 1099 Yes : ".$to_yes_hour."<br> 1099 No : ".$to_no_hour;
    }
    
    
    ?>
    </th>
    <th colspan="2" style="text-align:left;font-size:14px;">
    Grand Total Cost : <?php echo number_format((float)($grand_total), 2, '.', '');
    if($selected_1099 == '')
    {
    
    echo "<br> 1099 Yes : ".$grand_yes_hour."<br> 1099 No : ".$grand_no_hour;
    
    }
    ?></th>
    </tr>
    </tfoot>
</table>