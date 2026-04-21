<table id="alldataTable2" class="table table-striped table-bordered alldataTable">
	<thead>
		<tr>
		    <th>Sno</th>
			<th>Track Name</th>												
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody> 
	    <?php
	    $sn=1;
	     foreach($records as $rec)
	     {
	         ?>
	         <tr>
	             <td><?= $sn++; ?></td>
	             <td><?= $rec['track_name']; ?></td>
	             <td>
	                 <?php
	                  if($rec['status'] == '1')
	                  {
	                      echo '<button class="btn btn-success btn-xs">Active</button>';
	                  }
	                  else
	                  {
	                      echo '<button class="btn btn-danger btn-xs">Inactive</button>';
	                  }
	                 ?>
	             </td>
	             <td>
	                 <span class="btn btn-primary btn-xs edit_track" rel_id="<?= encryptor('encrypt', $rec['id']) ?>" rel_name="<?= $rec['track_name'] ?>" rel_status="<?= $rec['status'] ?>">Edit</span>
	             </td>
	         </tr>
	         <?php
	     }
	    ?>
	</tbody>
</table>
