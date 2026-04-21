<?php //echo "<pre>";print_r($data);die;

$add_permission = $edit_permission = $excel_permission = $print_permisson =  false;
if(session()->get('profiles')){
	if(in_array(1, session()->get('profiles'))){
		$add_permission = true;
	}
	
	if(in_array(13, session()->get('profiles'))){
		$permissions = getPermissionDetails('13','36','35');
		if(!empty($permissions)){
		    if($permissions[0]['add_button'] == '1'){
		        $add_permission = true;
		    }
		    if($permissions[0]['edit_button'] == '1'){
		        $edit_permission = true;
		    }
		    if($permissions[0]['excel_button'] == '1'){
		        $excel_permission = true;
		    }
		    if($permissions[0]['print_button'] == '1'){
		        $print_permisson = true;
		    }
		}
	//	echo "<pre>";print_r($permissions);echo "</pre>";die();
	}
	
}elseif(session()->get('role') == 1){
	$add_permission = $edit_permission = $excel_permission = $print_permisson = true;
}

?>
<div class="table-responsive">
    <table id="contract_dataTable" class="table table-striped table-bordered alldataTable datatable_th">
        <thead>
            <tr>
                <th style="width:8px !important;" data-name="<?= encryptor('encrypt', 'Course') ?>">Employee ID</th>
                <th data-name="<?= encryptor('encrypt', 'FirstName') ?>">Employee First Name </th>
                <th data-name="<?= encryptor('encrypt', 'LastName') ?>">Employe Last Name</th>
                <th data-name="<?= encryptor('encrypt', 'title') ?>">Title</th>
                <th data-name="<?= encryptor('encrypt', 'teamid') ?>">Team Name</th>
                <th data-name="<?= encryptor('encrypt', 'beginDate') ?>">Contract Begin date</th>	
                <th data-name="<?= encryptor('encrypt', 'endDate') ?>">Contract End date</th>
                <th data-name="<?= encryptor('encrypt', 'early_termination_date') ?>">Early Termination</th>
                <th data-name="<?= encryptor('encrypt', 'termination_initiate_by') ?>">Termination Initiated By</th>
                <th data-name="<?= encryptor('encrypt', 'hrWork') ?>">Hours To Work</th>
                <th data-name="<?= encryptor('encrypt', 'carryHour') ?>">Carry Over</th>
                <th data-name="<?= encryptor('encrypt', 'eduation') ?>">Education ($)</th>
                <th data-name="<?= encryptor('encrypt', 'dailyrate') ?>">Daily Rate ($)</th>
                <th data-name="<?= encryptor('encrypt', '1099') ?>">1099</th>
                <th data-name="<?= encryptor('encrypt', 'Adjustment') ?>">Adjunct Fee</th>
                <th>Action</th>
                <!--<th>Action</th>-->
            </tr>
        </thead>
    	<tbody> 
    		<?php 
    		$i=1;
    		if(!empty($contract)){
    		foreach($contract as $row) { ?>
    		<tr>
    			<td><?=$row['empid']?></td>
    			<td><?=$row['FirstName']?></td>
    			<td><?=$row['LastName']?></td>
    			<td><?=$row['employee_title']?></td>
    			<td><?=$row['team_Name']?></td>
    			<td>
    			    <?php echo ($row['contract_begin_date']!="" && $row['contract_begin_date']!='0000-00-00 00:00:00' ? convertDateString($row['contract_begin_date']):'');?>
    			</td>
    			<td>
    			    <?php echo($row['contract_end_date']!="" && $row['contract_end_date']!='0000-00-00 00:00:00' ? convertDateString($row['contract_end_date']):'');?>
    			</td>
    			<td>
    			    <?php echo ($row['early_termination_date']!="" && $row['early_termination_date']!='0000-00-00 00:00:00' ? convertDateString($row['early_termination_date']):'');?>
    			</td>
    			<td><?=$row['termination_initiate_by']?></td>
    			<td><?=$row['hours_to_work']?></td>
    			<td><?=$row['CarriedOverHours']?></td>
    			<td><?=$row['education']?></td>
    			<td><?=$row['daily_rate']?></td>
    			<td><?=$row['contract_1099']?></td>
    			<td><?=$row['adjunct_fee']?></td>
    			<td style="text-align:left;">
    				<?php 
    				
                        // if($row['transaction_started'] == ''){
                        if($row['contract_end_date'] >= date('Y-m-d')){
                            if($edit_permission){
                            ?> 
                                <a href="<?=base_url('')?>admin/Users/contract/<?=encryptor('encrypt', $row['id'])?> " data-id="<?=encryptor('encrypt', $row['id'])?>" 	class="btn btn-info waves-effect waves-light btn-xs m-b-5 edit_contract_detail">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    <span><strong></strong></span>            
                                </a>
                            <?php
                            }
                            
                            if($row['parent_contract_id'] == 0 || $row['parent_contract_id'] == ''){
                            ?>
                                <span class="btn btn-primary btn-xs link_previous_btn" rel_emp_id = "<?= encryptor('encrypt', $row['empid']) ?>" rel_contract_id = "<?= encryptor('encrypt', $row['id']) ?>" >Link to previous contract</span>
                            <?php
                            }
                            else{
                                ?>
                                <span class="btn btn-danger btn-xs unlink_previous_btn" rel_emp_id = "<?= encryptor('encrypt', $row['empid']) ?>" rel_contract_id = "<?= encryptor('encrypt', $row['id']) ?>" style="margin-bottom:7px;">Unlink to previous contract</span>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <a href="javascript:void(0);" title="Contract has been expired" class="btn btn-danger waves-effect waves-light btn-xs m-b-5" data-urlm="<?=encryptor('encrypt', $row['id'])?>">
                                <span class="fa fa-lock" aria-hidden="true"></span>
                                <span>Locked</span>            
                            </a>
                            <?php
                        }
                        //}
                        if($row['transaction_started'] == '' && $edit_permission){	
                        ?>
                            <a href="javascript:void(0);" title="Click To Delete" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 rmv" data-urlm="<?=encryptor('encrypt', $row['id'])?>">
                            	<span class="fa fa-trash-o" aria-hidden="true"></span>
                            	<span><strong></strong></span>            
                            </a>	
                            <?php 
                        }  
                        $param['hours_to_work'] = $row['hours_to_work'];
                        $param['hours_worked'] = $row['hours_worked'];
                        $param['minutes_worked'] = $row['minutes_worked'];
                        $calculated_attendance = calculated_attendance($param);
                        
                        if(strtotime($row['contract_end_date']) < strtotime(date('Y-m-d'))){
                            ?>
                            <a href="javascript:void(0);" class="btn btn-purple waves-effect waves-light btn-xs m-b-5" data-json='<?=json_encode($calculated_attendance, JSON_UNESCAPED_SLASHES)?>' id="calculate">
                                <span >Details</span>
                                <span><strong></strong></span>            
                            </a>
                        <?php }
                        
                        if($row['parent_contract_id'] != 0 && $row['parent_contract_id'] != ''){
                            ?>
                             <br><a href="javascript:void(0);" class="btn btn-success btn-xs linked_button" linked_id = "<?php echo encryptor('encrypt',$row['parent_contract_id'] ) ?>">Linked</a>
                            <?php
                        }
                        
                        
                     ?>
    			</td>
    		</tr>
    		<?php } } ?>
    	</tbody>
    </table>
</div>