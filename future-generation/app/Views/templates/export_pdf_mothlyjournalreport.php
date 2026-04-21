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
    
</style>
<table id="alldataTable2" class="table table-striped table-bordered  " style="width:100%;">
                                             <thead>
                                                 <tr>
                                                    <td colspan="5" style="text-align:center;font-weight:bold;">Monthly Journal Report</td> 
                                                 </tr>
                                                 
                                                 <tr>
                                                    <th>Begin Date : </th>
                                                    
                                                    <td><?php echo date('m/d/Y',strtotime($begin_date)); ?></td>
                                                    <th>End Date :  </th>
                                                    
                                                    <td colspan="2"><?php echo date('m/d/Y',strtotime($end_date)); ?></td>
                                                 </tr>
                                                 
                                                 
                                             
                                             <tr>
                                                
                                                 <th class="col1">Date</th>
                                                 <th class="col1">Office Status</th>
                                                 <th class="col1">Category</th>
                                                 <th class="col1">Hours Worked</th>
                                                 <th class="col2">Journal Entry</th>
                                                
                                           </tr>
                                           </thead>
                                           <tbody>
                                               
                                          <?php
                                            
                                             foreach($records as $rec)
                                             {
                                                ?>
                                                <tr><?php
                                                        
                                                         $ttt = str_replace("00:00:00","",$rec['transaction_date']);
                                                         echo '<td class="col1">'.date('m/d/Y',strtotime($ttt))."</td>";
                                                        ?>
                                                <td class="col1"><?php echo ($rec['office_status'] == '1')?'<img src="assets/check.png" style="width:12px;">':""; ?></td>
                                                  <td class="col1"><?= $rec['catagory_name'] ?></td>
                                                  
                                                  <td class="col1"><?php echo $rec['hours']; ?>
                                                  </td>
                                                  <td class="col2"><?= $rec['journal'] ?></td>
                                                 </tr>
                                                <?php
                                             }
                                           ?>
                                           <tr>
                                               <th colspan="3" style="text-align:center;" >Total Hours</th>
                                               <th colspan="2" style="text-align:left;"><?php echo hourdecFormating($total_hours_data[0]['t_hours'],$total_hours_data[0]['t_minutes']) ; ?></th>
                                           </tr>
                                               
                                           </tbody>
                                           
                                        </table>