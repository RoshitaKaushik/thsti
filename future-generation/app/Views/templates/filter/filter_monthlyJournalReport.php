<table id="alldataTable2"  class="table table-striped table-bordered datatable_th " style="font-size: 12px;">
    <thead>
        <tr>
            <th class="col1">Date</th>
            <th>Office</th>
            <th class="col1">Category</th>
            <th class="col1">Hours Worked</th>
            <th class="col2">Journal Entry</th>
        </tr>
    </thead>
    <tbody>   
        <?php
        foreach($records as $rec){ ?>
            <tr>
                <?php $ttt = str_replace("00:00:00","",$rec['transaction_date']);
                echo "<td class='col1'>".date('m/d/Y',strtotime($ttt))."</td>"; ?>
                <td><?php echo ($rec['office_status'] == '1')?'<i class="fa fa-check" style="font-style: italic;font-size: 17px;"></i>':'' ?></td>
                <td class='col1'><?= $rec['catagory_name'] ?></td>
                <td class='col1'>
                  <?php echo $rec['hours']; ?>
                </td>
                <td class='col2'>
                  <?= $rec['journal'] ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    <tfoot>
       <td colspan="3" ><b>Total Hours</b></td>
       <td ><b><?php echo hourdecFormating(isset($total_hours_data[0]['t_hours'])??'',isset($total_hours_data[0]['t_minutes'])??'') ; ?></b></td>
        <td></td>
    </tfoot>
    </table>