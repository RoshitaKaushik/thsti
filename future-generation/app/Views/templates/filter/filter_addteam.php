
<table id="alldataTable" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>S.No.</th>
			<th>Supervisor </th>
			<th>Team name </th>					
			<th>Status</th>									
			<th>Action</th>									
			<!--<th>Action</th>-->
		</tr>
	</thead>
	<tbody> 
		<?php 
		$i=1;
		foreach($team_name as $row) { ?>
		<tr <?php if ($row['Active'] != "1") {
						echo "style='background-color:#f78282 ! important'";
					} ?>>
			<td><?=$i++;?>
			</td>
			<td><?=$row['FirstName']." ".$row['LastName']?>
			</td>
			<td><?php if(isset($row['team_Name'])){ echo $row['team_Name']; }?>
			<td>
				<?php
					if ($row['Active'] == "1") {
						echo "ACTIVE";
					}
					else {
						echo "INACTIVE";			
					}
															
				?>
					
			</td>
			<td>
				<?php 
				if(isset($add_permission)){
				?>
				<a href="<?=base_url('')?>admin/Users/team/<?=encryptor('encrypt', $row['id'])?> " 	class="btn btn-info waves-effect waves-light btn-xs m-b-5">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					<span><strong></strong></span>            
				</a>
				<?php  } ?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>