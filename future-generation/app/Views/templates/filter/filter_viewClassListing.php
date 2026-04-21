<table id="classListing" class="table datatable_th table-striped table-bordered">
	<thead>
		<tr>
			<th data-name="<?= encryptor('encrypt', 'Firstname') ?>" style="text-align:left;">First Name</th>
			<th data-name="<?= encryptor('encrypt', 'LastName') ?>" style="text-align:left;">Last Name</th>
			<th data-name="<?= encryptor('encrypt', 'special_Program_name') ?>">Special Program</th>
			<th data-name="<?= encryptor('encrypt', 'Countries') ?>">Country</th>
			<th data-name="<?= encryptor('encrypt', 'Graduation') ?>">Graduation Date</th>
			<th data-name="<?= encryptor('encrypt', 'Deffered') ?>">Deferred to Class</th>
			<th data-name="<?= encryptor('encrypt', 'Withdrawn') ?>">Withdrawn</th>   										
			<th data-name="<?= encryptor('encrypt', 'Program_Name') ?>"> Concentration / Specialization</th>   										
		</tr>
	</thead>
    <tbody> 
    	<?php 
    	$Graduation_Count = $Deffered_Count = $Withdrawn_Count = $Region_Count = $Country_Count = 0;
		
		//echo '<pre>'; print_r($records); 
    	if(!empty($records)){     							        	   
    	    
    	    //region count
    	    $allRegionProgram = array_unique(array_column($records, 'RegionProgram')); 
    	    if(!empty($allRegionProgram)){
    	        foreach($allRegionProgram as $index=>$value) {
    	            if($value === null) unset($allRegionProgram[$index]);
    	        }
    	        $Region_Count = count($allRegionProgram);
    	    }
    	    //country count
    	    $allCountries = array_unique(array_column($records, 'Countries'));
    	    //echo "<pre>";print_r($allCountries);die;
    	    foreach($allCountries as $index=>$value) {
    	        /*if( strpos(',', $value) !== false ) {
    	            echo "Found";
    	        }*/
    	        if($value === null) unset($allCountries[$index]);
    	    }
			
			
			// program count
			
			//country count
    	    $allprograms = array_unique(array_column($records, 'Program_Name'));
    	    //echo "<pre>";print_r($allCountries);die;
    	    foreach($allprograms as $index=>$value) {
    	        /*if( strpos(',', $value) !== false ) {
    	            echo "Found";
    	        }*/
    	        if($value === null) unset($allprograms[$index]);
    	    }
			$allprograms_count = count($allprograms);
			
			// count special program
			$all_special_programs = array_unique(array_column($records, 'special_Program_name'));
    	    //echo "<pre>";print_r($allCountries);die;
    	    foreach($all_special_programs as $index=>$value) {
    	        /*if( strpos(',', $value) !== false ) {
    	            echo "Found";
    	        }*/
    	        if($value === null) unset($all_special_programs[$index]);
    	    }
			$all_special_programs_count = count($all_special_programs);
			
			
    	    $Country_Count = count($allCountries);
    	    $Total_Count = 0;
    	    foreach($records as $record){      							        	        						       	        
    	        $Graduation_Count = $record['Graduation'] != '' ? $Graduation_Count+1 : $Graduation_Count;
    	        $Deffered_Count = $record['Deffered'] != '' ? $Deffered_Count+1 : $Deffered_Count;
				$Withdrawn_Count = $record['Withdrawn'] != '' ? $Withdrawn_Count+1 : $Withdrawn_Count;
				$Total_Count++;
				if($record['Region']==0 || $record['Region']==NULL || $record['Region']==""){
					$region_name="None Selected";
				}else{
					$region_name=$record['RegionProgram'];
				}
                $count_special =0;
                if($record['special_Program_name']!='')
                {
                    $count_special++;
                }
    	?>
    	<tr>    										    
		    <td style="text-align:left;"><?=$record['Firstname']?></td>
		    <td style="text-align:left;"><?=$record['LastName']?></td>
		    <td><?=$record['special_Program_name']; ?></td>
		    <td><?=$record['Countries']?></td>
		    <td data-sort="<?= $record['Graduation'] ?>"><?=convertDateString($record['Graduation'])?></td>
		    <td data-sort="<?= $record['Deffered'] ?>"><?=convertDateString($record['Deffered'])?></td>
		    <td data-sort="<?= $record['Withdrawn'] ?>"><?=convertDateString($record['Withdrawn'])?></td>    											
		    <td><?=$record['Program_Name'];?></td>    											
		</tr>
		<?php } ?>
		</tbody>
 		<tfoot>
			<tr>
			    <td></td>
			    <td>Total Sudents: <?=$Total_Count?></td>
			    <td>Special Program Total: <?=$all_special_programs_count?></td>
			    <td>Country Total: <?=$Country_Count?></td>
			    <td>Total Graduation: <?=$Graduation_Count?></td>
			    <td>Total Deferred: <?=$Deffered_Count?></td>
			    <td>Total Withdrawn: <?=$Withdrawn_Count?></td>  											
			    <td>Total Program: <?=$allprograms_count?></td>  											
			     											
			   										
			</tr>
		</tfoot>
		<?php } ?>
	
</table>