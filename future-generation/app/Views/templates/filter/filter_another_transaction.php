<?php 
$orphan= $related =$dateRange =$flag = $elseFlag = array();
$group_by_contract = array();
if(!empty($contractor_details)){
	foreach ($contractor_details as $row_data) {
		$contract_id = $row_data['contract_id'];
		if (isset($group_by_contract[$contract_id])) {
			$group_by_contract[$contract_id][] = $row_data;
		} else {
			$group_by_contract[$contract_id] = array($row_data);
		} 
	} 
}

?>

<div class="row">
    <?php 
	if(isset($group_by_contract) && !empty($group_by_contract)){
		sort($group_by_contract);
	?>
	<?php 
	$count = 0; $orpid=0; $curdate=1; $cuurent=date('Y-m-d');
	foreach($group_by_contract  as $contract){ 
		$contractDateBegin = date('Y-m-d',strtotime($contract[0]['contract_begin_date']));
		$contractDateEnd = date('Y-m-d',strtotime($contract[0]['contract_end_date']));
		if(($cuurent >=  $contractDateBegin && $cuurent <=  $contract[0]['contract_end_date'] ) ){ $curdate=0; }else{ $curdate=1;}			
		$dateRange['begin'][] = $contract[0]['contract_begin_date'];
		$dateRange['end'][] = $contract[0]['contract_end_date'];
		$count++;
		$show_class = $count == 1 ? 'show' : 'hide';
	?>
	<?php if(isset($count) == 10000) { ?>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<button type="button" id="all_attendance" class="btn btn-success btn-xs show" style="float: right;margin-left: 5px;"><i class="fa fa-eye"></i> Show Complete Attendance</button>
		<button type="button" id="all_attendance_hide" class="btn btn-warning btn-xs hide" style="float: right;"><i class="fa fa-eye-slash" aria-hidden="true"></i> Hide Attendance</button>
	</div>
	<?php } ?>

	<div id='newHideOrphan' class="col-md-12 col-sm-12 col-xs-12 <?=isset($show_class)?> <?=$count != 1 ?'contract_details' : ''?>">
		<div class="col-sm-12 " >
			<span class="<?php if($curdate!='0'){ echo "curr_div"; } ?> pull-left label label-success topic_heading  <?php if($curdate=='0' ){ echo "show"; } else { echo "hide"; }  ?>">
			<b>Contract : <?=convertDateString($contract[0]['contract_begin_date'])?> to <?=convertDateString($contract[0]['contract_end_date'])?>
			</b></span>	
			<?php if(isset($count) == 1) { ?>
			<button type="button" id="all_attendance" class="btn btn-success btn-xs show" style="float: right;margin-left: 5px;margin-bottom: 4px;"><i class="fa fa-eye"></i> Show All Contract</button>
			<button type="button" id="all_attendance_hide" class="btn btn-warning btn-xs hide" style="float: right;"><i class="fa fa-eye-slash" aria-hidden="true"></i> Show Active Contract</button>		
			<?php } ?>
		</div>
	</div>
	<div class="clearfix"></div>
		<div class="<?php if($curdate!='0'){ echo "curr_div"; } ?> col-md-12 col-sm-12 col-xs-12 <?php if($curdate=='0'){ echo "show"; } else { echo "hide"; } ?>  <?=isset($count) != 1 ?'contract_details' : ''?>">
		<table id="" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>S.No.</th>
					<th>Date</th>
					<th>Category</th>
					<th>Hours</th>
					<th>Logged Date</th>
					<th>Lock Date</th>
					<th>Status</th>
					<th>Device</th>
					<th>Journal</th>
				</tr>
			</thead>
	        <tbody> 
				<?php 
				$sl=0;
				foreach($contractor_details as $row) { $sl++; 
				$status = $row['islock'];
				if($status=='1'){ $msg="Lock";} else if($status=='0'){ $msg="Unlock";}

				 /*$start_ts = strtotime($row['contract_begin_date']);
				  $end_ts = strtotime($row['contract_end_date']);
				  $user_ts = strtotime($row['transaction_date']);*/

				if(check_in_range($contract[0]['contract_begin_date'],$contract[0]['contract_end_date'],$row['transaction_date'])){
					$related[] = $row;
				?>
				<tr>
				    <td><?=$sl;?></td>
					<td><?=convertDateString($row['transaction_date'])?></td>
					<td><?=$row['catagory_name']?></td>										
					<td><?=hourmintodecFormating($row['hours'])?></td>
					<td>
						<?php if(isset($row['datesubmitted'])){
					        echo($row['datesubmitted']!="" && $row['datesubmitted']!='0000-00-00 00:00:00' ? convertDateString($row['datesubmitted']):'');
						}
						?>
					</td>
					<td>
						<?php if(isset($row['finalsubmit_date'])){
					        echo($row['finalsubmit_date']!="" && $row['finalsubmit_date']!='0000-00-00 00:00:00' ? convertDateString($row['finalsubmit_date']):'');
						}
						?>
					</td>
					<td><?=$msg;?></td>
					<td><?=$row['deviceid'];?></td>
					<td><?=stripslashes($row['journal'])?></td>
				</tr>
				<?php } else{

					$orphan[]=$row;

				} 
				 } ?>
			</tbody>

		</table>
  	</div>
	<div class="clearfix"></div>
	<?php //$orphann[$orpid]=unique_multidim_array($orphan,'id'); 
	//$result[] = array_diff_assoc($orphan[], $orphann[$orpid]);
					/*echo "<pre>";
					print_r($orphan);
					echo "</pre>"; */} /*$orpid+=1;*/    } ?>

	 <!-- <pre>
	<?php // $input = array_map("unserialize", array_unique(array_map("serialize", $orphan)));

			//print_r(unique_multidim_array($orphan,'id')); ?>						
</pre> -->
<!-- start orphan table -->
<div id="orphanSpan" class="col-md-12 col-sm-12 col-xs-12 <?=isset($show_class)?> <?=isset($count) != 1 ?'contract_details' : ''?>">
	<div class="col-sm-12">
		<span class="pull-left label label-success topic_heading" style="background-color: #ffd740; color: black;">
			<b>Orphan</b>
		</span>	
		
	</div>
</div>
<div id="OrphanSection" class="col-md-12 col-sm-12 col-xs-12 <?=isset($show_class)?> <?=isset($count) != 1 ?'contract_details' : ''?>">
		<table id="" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>S.No.</th>
					<th>Date</th>
					<th>Category</th>
					<th>Hours</th>
					<th>Logged Date</th>
					<th>Lock Date</th>
					<th>Status</th>
					<th>Device</th>
					<th>Journal</th>
				
				</tr>
			</thead>
	        <tbody> 
				<?php 
				$sll=0;
				$orphan_array=unique_multidim_array($orphan,'id');
				foreach($orphan as $roww) { $sll++; 
					foreach ($dateRange['begin'] as $key => $dater) {	
							$startDate = strtotime($dater);
							$userDate = strtotime($roww['transaction_date']);
							$endDate = strtotime($dateRange['end'][$key]);
						if(($startDate<$userDate && $userDate<$endDate)){  $flag[] = 1;  }
					}
					if(empty($flag)){ ?>
							<tr>
							    <td><?=$sll;?></td>
								<td><?=convertDateString($roww['transaction_date'])?></td>
								<td><?=$roww['catagory_name']?></td>	
								<td><?=$roww['hours']?></td>											
								<td>
									<?php if(isset($roww['datesubmitted'])){
								    echo($roww['datesubmitted']!="" && $roww['datesubmitted']!='0000-00-00 00:00:00' ? convertDateString($roww['datesubmitted']):'');
									}
									?>
								</td>
								<td>
									<?php if(isset($roww['finalsubmit_date'])){
								    echo($roww['finalsubmit_date']!="" && $roww['finalsubmit_date']!='0000-00-00 00:00:00' ? convertDateString($roww['finalsubmit_date']):'');
									}
									?>
								</td>
								<td><?=$msg;?></td>
								<td><?=$row['deviceid'];?></td>
								<td><?=stripslashes($roww['journal'])?></td>
							</tr>
				<?php	}else{ $elseFlag[] = '2';   }
				$status = $roww['islock'];
				if($status=='1'){ $msg="Lock";} else if($status=='0'){ $msg="Unlock";}			
				?>
				
				<?php  } 
				if(!empty($elseFlag)){ ?>
				<tr  ><td colspan="9"><span class="text-danger" ></span></td></tr>
				<?php } ?>

			</tbody>
			
		</table>
  	</div>
  	<!-- end orphan table -->
</div>

<script>
	$( document ).ready(function() {
		var hideValue = false;
		<?php
			if(!empty($elseFlag)){ ?>
				hideValue = true;
		<?php	} ?>
		//alert(hideValue);
		if(1==1){
			$("#orphanSpan").remove();
			$("#OrphanSection").remove();
		}
	});
</script>