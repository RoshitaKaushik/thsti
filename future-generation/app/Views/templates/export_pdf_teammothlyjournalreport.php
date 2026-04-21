<style>
     th{
        font-weight:bold;
        /*text-align:center;*/
        font-family: "Times New Roman", Times, serif;
        border:1px solid #ccc;
        font-size:12px;
    }
    td
    {
        font-family: "Times New Roman", Times, serif;
        border:1px solid #ccc;
        font-size:12px;
    }
    table
    {
        border:1px solid #ccc;
    }
    .col1
    {
        width:12%;
    }
    .col2
    {
        width:40%;
    }
</style>
 
  <table id="alldataTable2" class="table table-striped table-bordered  " style="font-size: 12px;">
                                             <tr>
                                                 <th colspan="5" style="text-align:center;">Admin Monthly Journal Report</th>
                                             </tr>
                                             <tr>
                                                 <th>Begin Date</th>
                                                 <th><?= $begin_date ?></th>
                                                 <th>End Date</th>
                                                 <th colspan="2"><?= $end_date ?></th>
                                             </tr>
                                             
                                             <tr>
                                                 
                                                 <th class="col1">Employee Name</th>
                                                 <th class="col1">Date</th>
                                                 <th class="col1">Category</th>
                                                 <th class="col1">Hours Worked</th>
                                                 <th class="col1">Hourly Rate</th>
                                                 <th class="col2">Journal Entry</th>
                                                
                                           </tr>
                                          
                                           <tbody>
                                               
                                          <?php
                                            $sn=1;
                                            $cat = '';
                                            $total_hour = 0;
                                            $t_h_rate = 0;
                                            $grand_sum =0;
                                             $grand_total = 0;
                                            $em_id = '';
                                            $curr_hour = 0;
                                            
                                            $curr_tot_hr = 0;
                                            $grand_tot_hr=0;
                                            
                                            $check_zero = false;
                                             foreach($records as $rec)
                                             {
                                                 if(in_array($rec['ID'],$team_member))
                                                 {   
                                                 if($cat == '')
                                                { 
                                                    $curr_hour = 0;
                                                    $cat = $rec['cat_id'];
                                                    $t_h_rate = number_format((float)$rec['daily_rate'], 2, '.', ''); 
                                                     $check_zero = false;
                                                     $curr_tot_hr = 0;
                                                }
                                                if($em_id == '')
                                                {
                                                    $curr_hour = 0;
                                                    $curr_tot_hr = 0;
                                                    $em_id = $rec['ID']; 
                                                     $check_zero = false;
                                                }
                                                if($cat != $rec['cat_id'] || $em_id != $rec['ID'])
                                                {
                                                    $totol_hours1 = get_category_total_emp($em_id,$cat,$begin_date,$end_date);
                                                    $em_id = $rec['ID'];
                                                    
                                                    ?>
                                                      <tr>
                                                        <th colspan="3" style="text-align:right;">Total</th>  
                                                        <th><?php
                                                              $grand_tot_hr = $grand_tot_hr+number_format((float)($curr_tot_hr), 2, '.', '');
                                                              echo $current_total =  number_format((float)($curr_tot_hr), 2, '.', '') ;
                                                              //echo $current_total =  hourdecFormating($totol_hours1[0]['t_hours'],$totol_hours1[0]['t_minutes']) ;
                                                            ?>
                                                        </th>  
                                                        <th colspan="2"><?php
                                                                $grand_sum = $grand_sum+number_format((float)($t_h_rate*$current_total), 2, '.', '');
                                                                //echo number_format((float)($curr_hour), 2, '.', '');
                                                                if($check_zero)
                                                               {
                                                                   echo '<span style="color:red;">Partial Cost : '.number_format((float)($curr_hour), 2, '.', '').'&nbsp;(Daily hour rates missing for selected dates)</span>';
                                                               }
                                                               else
                                                               {
                                                                   echo 'Total Cost : '.number_format((float)($curr_hour), 2, '.', '');
                                                               }
                                                               $grand_total = $grand_total+number_format((float)($curr_hour), 2, '.', '');
                                                            ?>
                                                        </th>
                                                      </tr>
                                                    <?php
                                                    $cat = $rec['cat_id'];
                                                    $t_h_rate = number_format((float)$rec['daily_rate'], 2, '.', '');
                                                     $curr_hour = 0;
                                                      $curr_tot_hr = 0;
                                                     $check_zero = false;
                                                 }
                                                ?>
                                                <tr>   
                                                 <?php
                                                     echo '<td class="col1">'.$rec['FirstName']." ".$rec['LastName']."</td>";
                                                     $ttt = str_replace("00:00:00","",$rec['transaction_date']);
                                                     echo '<td class="col1">'.date('d/m/Y',strtotime($ttt))."</td>";    
                                                 ?>   
                                                  <td class="col1"><?= $rec['catagory_name'] ?></td>
                                                  <td class="col1"><?php echo hourmintodecFormating($rec['hours']); ?></td>
                                                  <td class="col1"><?php $curr_tot_hr = $curr_tot_hr+hourmintodecFormating($rec['hours']); $curr_hour = $curr_hour+(number_format((float)$rec['daily_rate'], 2, '.', '') * hourmintodecFormating($rec['hours']) );echo number_format((float)$rec['daily_rate'], 2, '.', '');
                                                 
                                                       if(!$check_zero)
                                                       {
                                                         if(number_format((float)$rec['daily_rate'], 2, '.', '') == '0.00')
                                                         {
                                                            $check_zero = true; 
                                                         }
                                                       }
                                                      
                                                  
                                                  ?> 
                                                  </td>
                                                  <td class="col2"><?= $rec['journal'] ?></td>
                                                 </tr>
                                                <?php
                                                $last_emp = $rec['ID'];
                                                $tt = number_format((float)($rec['daily_rate'] * hourmintodecFormating($rec['hours'])), 2, '.', '');
                                                
                                                 
                                                 // $grand_total = $grand_total+($rec['daily_rate'] * $rec['hours'] );
                                                 }
                                             }
                                             if($last_emp != '')
                                             {
                                              $totol_hours1 = get_category_total_emp($last_emp,$cat,$begin_date,$end_date);        
                                             ?>
                                               <tr>
                                                  <th colspan="3" style="text-align:right;">Total</th>
                                                  <th>
                                                    <?php
                                                        echo $current_total =  number_format((float)($curr_tot_hr), 2, '.', '');
                                                    ?>
                                                  </th>
                                                  <th colspan="2"><?php
                                                  $grand_tot_hr = $grand_tot_hr+number_format((float)($curr_tot_hr), 2, '.', '');
                                                     
                                                      $grand_sum = $grand_sum+number_format((float)($t_h_rate*$current_total), 2, '.', '');
                                                       //echo number_format((float)($curr_hour), 2, '.', '');
                                                        if($check_zero)
                                                               {
                                                                   echo '<span style="color:red;">Partial Cost : '.number_format((float)($curr_hour), 2, '.', '').'&nbsp;(Daily hour rates missing for selected dates)</span>';
                                                               }
                                                               else
                                                               {
                                                                   echo 'Total Cost : '.number_format((float)($curr_hour), 2, '.', '');
                                                               }
                                                               $grand_total = $grand_total+number_format((float)($curr_hour), 2, '.', '');
                                                      
                                                      ?>
                                                  </th>
                                                  
                                              </tr>
                                           
                                           <?php
                                             }
                                             
                                           ?>
                                             <tr>
                                                 <th colspan="3" style="text-align:right;"> Grand Total</th>
                                               <th ><?php echo number_format((float)($grand_tot_hr), 2, '.', '') ; ?></th>
                                               <th colspan="2">Grand Total Cost : <?= number_format((float)($grand_total), 2, '.', '')  ?></th>
                                             </tr>  
                                           </tbody>
                                           
                                           
                                               
                                           
                                           
                                        </table>