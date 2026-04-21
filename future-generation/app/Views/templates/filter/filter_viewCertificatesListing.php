<table id="classListing" class="table table-striped table-bordered datatable_th">
    <thead>
    	<tr>
    		<th data-name="<?= encryptor('encrypt','FirstName') ?>" style="text-align:left;">First Name</th>
    		<th data-name="<?= encryptor('encrypt','LastName') ?>"  style="text-align:left;">Last Name</th>
    		<th data-name="<?= encryptor('encrypt','Countries') ?>">Country</th>
    		<th data-name="<?= encryptor('encrypt','cert_no') ?>">Certificate Number</th>
    		<th data-name="<?= encryptor('encrypt','CertName') ?>">Certificate</th>									
    		<th data-name="<?= encryptor('encrypt','Year') ?>">Year</th>					
    		<th data-name="<?= encryptor('encrypt','semester') ?>">Semester</th>
    		<th data-name="<?= encryptor('encrypt','grad_undergrad') ?>">Level</th>
    		<th data-name="<?= encryptor('encrypt','dipName') ?>">Diploma</th>
    		<th data-name="<?= encryptor('encrypt','tution') ?>">Tuition</th>
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
    	    $allprograms = array_unique(array_column($records, 'CertName'));
    	   // echo "<pre>";print_r($records);die;
    	    foreach($allprograms as $index=>$value) {
    	        /*if( strpos(',', $value) !== false ) {
    	            echo "Found";
    	        }*/
    	        if($value === null) unset($allprograms[$index]);
    	    }
    		$allprograms_count = count($allprograms);
    		
    		
    	
    	    $Country_Count = count($allCountries);
    	    $Total_Count = 0;
    	   
    	    foreach($records as $record){
    			$Total_Count++;
    			
    	?>
    	<tr>    										    
    	    <td  style="text-align:left;"><a href="<?= base_url('admin/Form/ViewApp/'.$record['ID']) ?>" target="_blank"><?php echo $record['Firstname'];?></a></td>
    	    <td  style="text-align:left;"><a href="<?= base_url('admin/Form/ViewApp/'.$record['ID']) ?>" target="_blank"><?=$record['LastName']?></a></td>
    	    <td><?=$record['Countries'] ?></td>
    	    <td><?=$record['cert_no'] ?></td>
    	    <td style='text-align: left;'><?=isset($record['CertName']) ?></td>
    	    <td style='text-align: left;' ><?=isset($record['Year']) ?></td>    											
    	    <td style='text-align: left;' ><?=$record['semester'] ?></td>    											
    	    <td style='text-align: left;' >
    	     <?php if($record['grad_undergrad']=='G'){ echo "Graduate"; } if($record['grad_undergrad']=='U'){ echo "UnderGraduate"; };?>
    	    </td> 
    	    <td style='text-align: left;' ><?= $record['dipName'] ?></td>    											
            <td style='text-align: left;' > <?= $record['tution'] ?></td>    											
    	     
    	</tr>
    	<?php } ?>
    	</tbody>
     	<tfoot>
    		<tr>
    		    
    		    <td colspan="2">Total Sudents: <?=$Total_Count?></td>
    		   
    		    <td colspan="2">Country Total: <?=$Country_Count?></td>
    		     											
    		    <td>Total Program: <?=$allprograms_count?></td>
    		   
    		    
    		   
    		   	<td></td>
    		   	<td></td>
    		   	<td></td>
    		   	<td></td>
    		   	<td></td>
    		</tr>
    	</tfoot>
    	<?php } ?>
    
    </table>