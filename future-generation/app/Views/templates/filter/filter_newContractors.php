<div class="row">
    <?php if(!empty($contractors)) {  
    foreach($contractors as $contract){                
    ?>
    <div class="col-sm-6 col-lg-4">
        <div class="panel">
            <div class="panel-body">
                <div class="media-main">
                    <div class="pull-left">
                        <?php 
                        $img = 'assets/images/user.png';
                        
                        if($contract['profile_image'] != ''){
                            $img = $contract['profile_image'];
                        }
                        $empid = encryptor('encrypt',$contract['empid']);
                        ?>
                        <img class="thumb-lg" src="<?php echo base_url($img)?>" alt="">
                    </div>
                    <div class="info pull-right">
                        <h4><?=$contract['empname']?></h4>
                        <a href="<?=base_url('admin/Timesheet/getTransaction/'.$empid);?>" tootltip="View Transaction" class="btn btn-info waves-effect waves-light btn-xs m-b-5 view_details"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        <span><strong>View Attendance</strong></span> </a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="cn_details">
                                               
                    <span class="label <?php  if($contract['contract_begin_date'] == '' || $contract['contract_end_date'] < date('Y-m-d')){ echo 'label-danger'; }else{ echo 'label-success'; } ?>">Contract : <?=convertDateString($contract['contract_begin_date'])?> to <?=convertDateString($contract['contract_end_date'])?> </span>
                    <span class="label" style="line-height: normal;float: right;color:#333;">Last Sync :  <?php echo $contract['last_sync_date'] != '' ? convertDateString($contract['last_sync_date']) : 'Not Started'?></span>  
                </div>
                <div class="clearfix"></div>
                <hr style="margin-top:5px;margin-bottom:5px;border-top: 1px solid #ccc;">
                <div>
                    <div class="contractor_details" id="">
                        <span class="contractor_content">Total Hours : 
                        <?php								
                        	$param['hours_to_work'] = $contract['hours_to_work'];
                        	$param['hours_worked'] = $contract['hours_worked'];
                        	$param['minutes_worked'] = $contract['minutes_worked'];
                        	$calculated_attendance = calculated_attendance($param);
                            $total_worked =  hourdecFormating($contract['hours_worked'], $contract['minutes_worked']);
                            echo hourmintodecFormating($calculated_attendance['total_worked_hours']) ;  
                        ?>
                        </span>
                        <span class="contractor_content">Total Days : 
                               <?=@calc_days(@$calculated_attendance['total_worked_hours']) ?>
                        </span>
                    </div>
                    <div class="contractor_details">
                        <span class="contractor_content">Hours Left : 
                            <?php echo ($param['hours_to_work']- $total_worked); ?>
                        </span>
                        <span class="contractor_content">Days Left : 
                            <?=@calc_hrtodays(@$param['hours_to_work']- $total_worked) ?>
                        </span>                       	
                    </div>
                </div>
            
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- end col -->
    <?php 
    } } ?>
</div> 