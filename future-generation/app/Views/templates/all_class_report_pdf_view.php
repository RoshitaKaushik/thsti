
<style>
label{
	font-weight:bold;
}
p , th{
	font-weight:bold;
	padding-left:10px;
	border-bottom:0.1pt thin grey;
	font-size:9px;
}
td{
   
}

table tr td {
	height:15px;
	font-size: 8px;
    padding-left:10px;
	font-family:Arial;
	border-bottom:0.1pt thin grey;
	border-collapse: collapse;
 } 
 
th{
	font-weight:bold;
	cell-padding:10px;
	font-size:9px;
	font-family:Arial;
	border-bottom:1px solid grey !important;
	color: white;
}
div{
	font-family:Arial;
}
.tbl_th_row{
	font-weight:bold;
	margin-bottom:0px; 
	font-family: 'Arial'; 
	background-color:#fff;
	color:#000; 
	text-align:left;
	padding:20px; 
	/*line-height:2px;*/
	
	border-bottom:1px solid grey;
	margin:10px 0px; border-top:
	5px solid #FFF; 
	
}
.tbl_data_row{
 font-weight:normal;
 font-family:arial;
 font-size:8px; 
 padding:40px;
 color:#000;
}

.tbl_heading_row{
	font-weight:bold; margin-bottom:0px; 
	font-family: 'Arial'; 
	background-color:#fff;
	color:#000; text-align:left;
	padding:10px; 
	line-height:1px;
	margin:10px 0px; border-top:
	5px solid #FFF; 
	font-size:12px !important;
	border-bottom: 1px solid grey;
}

thead { display: table-header-group }
tfoot { display: table-row-group }
tr { page-break-inside: avoid }
</style>
<section class="application-form-page" style="position:relative;">

	
       <!-- get year wise record all year -->
	  <?php
	    foreach($AllClassList as $record){
			$activeClass = $record['Class'];
			
	  ?>
        <table width="100%">
		<tr>
		 <th style="border-bottom:none; text-align:center;"><h2>Class of  <?=$record['Class'];?></h2></th>
		</tr>
		</table>
	    <?php
		
		   $graduate = getAllGraduates($activeClass);
		  if(!empty($graduate)){
			  $graduate_record_count = count($graduate);
			  if($graduate_record_count>=1){
		?>
		 <table><tr><th>Graduated</th></tr></table>
	 	<table width="100%"  style="padding-left:10px;">
		    <thead>
		    <tr class="tbl_th_row">
			    <th style="width:15%">Class Year</th>
                <th style="width:17%">First Name </th>
                <th style="width:17%">Last Name</th>
                <th style="width:17%">Region</th>
                <th style="border-left:0.1pt thin white; width:17%">Country</th>
                <th style="width:17%">Graduated</th>
		    </tr>
			</thead>
			<tbody>
           <?php
		   $unique_country=array();
		   $unique_region=array();
		   $unique_male=array();
		 
		   $count_rows=0;
		 
		   foreach($graduate as $row){
			   $count_rows++;
			     
			
    		if(!isset($unique_country[$row['Countries']])){
				   $unique_country[$row['Countries']][]=$row['Countries'];
			   }else{
				   $unique_country[$row['Countries']][]=$row['Countries'];
			   }
			   if(!isset($unique_region[$row['RegionProgram']])){
				  $unique_region[$row['RegionProgram']][]= $row['RegionProgram']; 
			   }else{
				   $unique_region[$row['RegionProgram']][]= $row['RegionProgram'];
			   }
			   
			   if(!isset($unique_male[$row['Sex']])){
				   $unique_male[$row['Sex']][]=$row['Sex'];
			   }else{
				   $unique_male[$row['Sex']][]=$row['Sex'];
			   }
			   
			   if($row['Region']==0 || $row['Region']==NULL || $row['Region']==""){
				   $region_name='None Selected';
			   }else{
				   $region_name=$row['RegionProgram'];
			   }
		   ?>  
			<tr class="tbl_data_row" >
			    <td style="width:15%;"><?php echo $row['Class'];?></td>
                <td style="width:17%;"><?php echo $row['Firstname'];?></td>
                <td style="width:17%"><?php echo $row['LastName'];?></td>
                <td style="width:17%"><?php echo $region_name;?> </td>
                <td style="width:17%"><?php echo $row['Countries'];?></td>
                <td style="width:17%"><?php echo convertDateString($row['Graduation']);?></td>
		    </tr>
		   <?php }?>
		   <tr class="tbl_data_row"><td colspan="6" style="border-bottom:none;">&nbsp;</td></tr>
		   </tbody>
	    </table>
		
  <?php } }?>
     <?php 
	    $continue = getAllContinue($activeClass);
	   if(!empty($continue)){
		   $continue_record_count = count($continue);
		   if($continue_record_count>=1){
	   ?>
       <table><tr><th>Continuing</th></tr></table>
		<table width="100%"  style="padding-left:10px;">
		    <thead>
		    <tr class="tbl_th_row">	
			    <th style="width:20%">Class Year</th>
                <th style="width:20%">First Name</th>
                <th style="width:20%">Last Name</th>
                <th style="width:20%">Region</th>
                <th style="width:20%">Country</th>
            </tr>
			</thead>
			<tbody>
			<?php 
			 $cunique_country=array();
		     $cunique_region=array();
			 $cunique_male=array();
			  foreach($continue as $c){
				if(!isset($cunique_country[$c['Countries']])){
				   $cunique_country[$c['Countries']][]=$c['Countries'];
			   }else{
				   $cunique_country[$c['Countries']][]=$c['Countries'];
			   }
			   if(!isset($cunique_region[$c['RegionProgram']])){
				  $cunique_region[$c['RegionProgram']][]= $c['RegionProgram']; 
			   }else{
				   $cunique_region[$c['RegionProgram']][]= $c['RegionProgram'];
			   }
			   
			   if(!isset($cunique_male[$c['Sex']])){
				  $cunique_male[$c['Sex']][]= $c['Sex']; 
			   }else{
				   $cunique_male[$c['Sex']][]= $c['Sex'];
			   }
			   
			   if($c['Region']==0 || $c['Region']==NULL || $c['Region']==""){
				   $continue_region_name='None Selected';
			   }else{
				   $continue_region_name = $c['RegionProgram'];
			   }
			?>
            <tr class="tbl_data_row">   
              	<td style="text-align:left ; width:20%"><?php echo $c['Class'];?></td>		
                <td style="text-align:left ; width:20%"><?php echo $c['Firstname'];?></td>
                <td style="width:20%"><?php echo $c['LastName'];?></td>
                <td style="width:20%"><?php echo $continue_region_name;?> </td>
                <td style="width:20%"><?php echo $c['Countries'];?></td>
		    </tr>
			<?php }?>
			
			<tr class="tbl_data_row"><td colspan="5" style="border-bottom:none;"></td></tr>
			</tbody>
        </table>
  <?php } }?>
 		 <?php 
		    $deffered = getAllDeffered($activeClass);
		    if(!empty($deffered)){
				$deferred_record_count = count($deffered);
				if($deferred_record_count>=1){
		 ?>
		<table>
			<tr><th>Deferred</th></tr>
		</table>
	    <table width="100%" style="padding-left:10px;">
		   <thead>
		    <tr class="tbl_th_row">	
              	<th style="width:15%;">Class Year</th>
                <th style="width:17%;">First Name</th>
                <th style="width:17%;">Last Name</th>
                <th style="width:17%;">Region</th>
                <th style="border-left:0.1pt thin white; width:17%;">Country</th>
                <th style="width:17%;">Deferred</th>
            </tr>
			</thead>
			<tbody>
			<?php
			 $dunique_country=array();
		     $dunique_region=array();
			  $dunique_male=array();
				foreach($deffered as $d){
				if(!isset($dunique_country[$d['Countries']])){
				   $dunique_country[$d['Countries']][]=$d['Countries'];
			   }else{
				   $dunique_country[$d['Countries']][]=$d['Countries'];
			   }
			   if(!isset($dunique_region[$d['RegionProgram']])){
				  $dunique_region[$d['RegionProgram']][]= $d['RegionProgram']; 
			   }else{
				   $dunique_region[$d['RegionProgram']][]= $d['RegionProgram'];
			   }
			   if(!isset($dunique_male[$d['Sex']])){
				  $dunique_male[$d['Sex']][]= $d['Sex']; 
			   }else{
				   $dunique_male[$d['Sex']][]= $d['Sex'];
			   }
			   if($d['Region']==0 || $d['Region']==NULL || $d['Region']==""){
				   $deffered_region_name='None Selected';
			   }else{
				   $deffered_region_name=$d['RegionProgram'];
			   }
			?>
            <tr>   
              	<td style="width:15%"><?php echo $d['Class'];?></td>		
                <td style="width:17%"><?php echo $d['Firstname'];?></td>
                <td style="width:17%"><?php echo $d['LastName'];?></td>
                <td style="width:17%"><?php echo $deffered_region_name;?> </td>
                <td style="width:17%"><?php echo $d['Countries'];?></td>
                <td style="width:17%"><?php echo convertDateString($d['Deffered']);?></td>
            </tr>
			<?php }?>
			<tr><td colspan="6" style="border-bottom:none;">&nbsp;&nbsp;</td></tr>
			</tbody>
	    </table>	
	<?php } }?>
	   <?php
	        $withdrawn = getAllWithdrawn($activeClass);              
	   if(!empty($withdrawn)){
		   $withdrawn_record_count = count($withdrawn);
		   if($withdrawn_record_count>=1){
		 ?>
	  <table><tr><th>Withdrawn</th></tr></table>
		<table width="100%" style="padding-left:10px;">
		   <thead>
            <tr class="tbl_th_row">
                <th style="width:15%">Class Year</th>			
                <th style="width:17%">First Name</th>
                <th style="width:17%">Last Name</th>
                <th style="width:17%">Region</th>
                <th style="border-left:0.1pt thin white; width:17%">Country</th>
                <th style="width:17%">Withdrawn</th>   										
            </tr>
		   </thead>
			<tbody>
			<?php
			 $wunique_country=array();
		     $wunique_region=array();
			 $wunique_male=array();
			foreach($withdrawn as $w){
			if(!isset($wunique_country[$w['Countries']])){
			   $wunique_country[$w['Countries']][]=$w['Countries'];
			}else{
			   $wunique_country[$w['Countries']][]=$w['Countries'];
			}
			if(!isset($wunique_region[$w['RegionProgram']])){
			  $wunique_region[$w['RegionProgram']][]= $w['RegionProgram']; 
			}else{
			   $wunique_region[$w['RegionProgram']][]= $w['RegionProgram'];
			}
			if(!isset($wunique_male[$w['Sex']])){
			  $wunique_male[$w['Sex']][]= $w['Sex'];
			}else{
			   $wunique_male[$w['Sex']][]= $w['Sex'];
			}
			if($w['Region']==0 || $w['Region']==NULL || $w['Region']==""){
				$deffered_region_name='None Selected';
			}else{
				$deffered_region_name=$w['RegionProgram'];
			}
			?>
	        <tr>   
			    <td style="width:15%;"><?php echo $w['Class'];?></td>
                <td style="width:17%;"><?php echo $w['Firstname'];?></td>
                <td style="width:17%;"><?php echo $w['LastName'];?></td>
                <td style="width:17%"><?php echo $deffered_region_name;?></td>
                <td style="width:17%;"><?php echo $w['Countries'];?></td>
                <td style="width:17%;"><?php echo $w['Withdrawn'];?></td>    											
            </tr>
			<?php }?>
			<tr><td colspan="6" style="border-bottom:none;"></td></tr>
			</tbody>
		</table>
		
  <?php } }?>
  
      <table><tr><th>Total Section </th></tr>
	     <tr><th style="border-bottom:none;">&nbsp;</th></tr>
	  </table>
   <table width="100%">
     <thead>
	 <tr class="tbl_th_row">
		<th style="width:15%;">&nbsp;</th>
		<th style="width:15%;">Graduated</th>
		<th style="width:15%;">Deferred</th>
		<th style="width:15%;">Withdrawn</th>
		<th style="width:15%;">Continue</th>
		<th style="width:10%;">Male</th>
		<th style="width:15%;">Female</th>
	 </tr>
	 </thead>
	 <tbody>
	 <?php 
			$completestudentinfo = getAllRegions($activeClass);
		if(!empty($completestudentinfo)){
			
		 	 $region_total_graduated=$region_total_deffered=$region_total_withdrawn=$region_total_continue=$region_total_male=$region_total_female=0;
		 foreach($completestudentinfo as $records){
			 
			 if($records['Region']==NULL || $records['Region']=="" || $records['Region']==0){
				 $region_program='None Selected';
			 }else{
				 $region_program=$records['RegionProgram'];
			 }
			 $region_total_graduated+=$records['Total_Graduated'];
			 $region_total_deffered+=$records['Total_Deffered'];
			 $region_total_withdrawn+=$records['Total_Withdrawn'];
			 $region_total_continue+=$records['Total_Continue'];
			 $region_total_male+=$records['Total_Male'];
			 $region_total_female+=$records['Total_Female'];
	 ?>
	    <tr class="tbl_data_row">
			<td style="width:15%;"><?php echo $region_program;?></td>
			<td style="width:15%;"><?php echo $records['Total_Graduated'];?></td>
			<td style="width:15%;"><?php echo $records['Total_Deffered'];?></td>
			<td style="width:15%;"><?php echo $records['Total_Withdrawn'];?></td>
			<td style="width:15%;"><?php echo $records['Total_Continue'];?></td>
			<td style="width:10%;"><?php echo $records['Total_Male'];?></td>
			<td style="width:15%;"><?php echo $records['Total_Female'];?></td>
	   </tr>
	   <?php } }?>
	     <tr class="tbl_th_row">
			 <td style="width:15%;">Total All Regions</td>
			 <td style="width:15%;"><?php if(isset($region_total_graduated)){ echo $region_total_graduated;}?></td>
			 <td style="width:15%;"><?php if(isset($region_total_deffered)){ echo $region_total_deffered;}?></td>
			 <td style="width:15%;"><?php if(isset($region_total_withdrawn)){ echo $region_total_withdrawn;}?></td>
			 <td style="width:15%;"><?php if(isset($region_total_continue)){ echo $region_total_continue;}?></td>
			 <td style="width:10%;"><?php if(isset($region_total_male)){ echo $region_total_male;}?></td>
			 <td style="width:15%;"><?php if(isset($region_total_female)){ echo $region_total_female;}?></td>
	   </tr>
	   <tr class="tbl_data_row"><td colspan="7">&nbsp;</td></tr>
	   <?php 
	   $completestudentcountryinfo = getAllClassCountries($activeClass);
	   if(!empty($completestudentcountryinfo)){
		
            $completestudentcountryinfo =  $completestudentcountryinfo;
            $group_by_country = array();	
		foreach ($completestudentcountryinfo as $row_data) {
		   $Countries = $row_data['Countries'];
		  if (isset($group_by_country[$Countries])) {
		    $group_by_country[$Countries][] = $row_data;
		  } else {
		   $group_by_country[$Countries] = array($row_data);
		  }
	    }	
    $country_total_graduated1=$country_total_deffered1=$country_total_withdrawn1=$country_total_continue1=$country_total_male1=$country_total_female1=0;	
		   foreach($group_by_country as $key=>$rows){
			   $country_total_graduated=$country_total_deffered=$country_total_withdrawn=$country_total_continue=$country_total_male=$country_total_female=0;
			   foreach($rows as $rec){
			  $country_total_graduated+=$rec['Total_Graduated'];
			  $country_total_deffered+=$rec['Total_Deffered'];
			  $country_total_withdrawn+=$rec['Total_Withdrawn'];
			  $country_total_continue+=$rec['Total_Continue'];
			  $country_total_male+=$rec['Total_Male'];
			  $country_total_female+=$rec['Total_Female'];
			   }
			 $country_total_graduated1+=$country_total_graduated;
			 $country_total_deffered1+=$country_total_deffered;
			 $country_total_withdrawn1+=$country_total_withdrawn;
			 $country_total_continue1+=$country_total_continue;
			 $country_total_male1+=$country_total_male;
			 $country_total_female1+=$country_total_female;
		?>
	   <tr class="tbl_data_row">
		 <td style="width:15%;"><?php echo $key;?></td>
		 <td style="width:15%;"><?php echo $country_total_graduated;?></td>
		 <td style="width:15%;"><?php echo $country_total_deffered;?></td>
		 <td style="width:15%;"><?php echo $country_total_withdrawn;?></td>
		 <td style="width:15%;"><?php echo $country_total_continue;?></td>
		 <td style="width:10%;"><?php echo $country_total_male;?></td>
		 <td style="width:15%;"><?php echo $country_total_female;?></td>
	   </tr>
	   <?php } } ?>
	 <tr class="tbl_th_row">
	    <td style="width:15%;">Total All Countries</td>
		 <td style="width:15%;"><?php if(isset($country_total_graduated1)){ echo $country_total_graduated1;}?></td>
		 <td style="width:15%;"><?php if(isset($country_total_deffered1)){ echo $country_total_deffered1;}?></td>
		 <td style="width:15%;"><?php if(isset($country_total_withdrawn1)){ echo $country_total_withdrawn1;}?></td>
		 <td style="width:15%;"><?php if(isset($country_total_continue1)){ echo $country_total_continue1;}?></td>
		 <td style="width:10%;"><?php  if(isset($country_total_male1)){ echo $country_total_male1;}?></td>
		 <td style="width:15%;"><?php if(isset($country_total_female1)){ echo $country_total_female1;}?></td>
	 </tr>
	 <tr class="tbl_th_row">
	    <td style="border-bottom:none;">Total In Class</td>
		 <td colspan="2" style="border-bottom:none;">
		 <?php 
				$total_student = getAllClassStudent($activeClass);
				if(!empty($total_student)){
					echo $total_student = $total_student['total_student'];
					$total_gender=($total_student-(($country_total_female1)+($country_total_male1)));
					
				}
			?></td>
		 <td colspan="2" style="border-bottom:none;">&nbsp;</td>
		 <td colspan="3" style="border-bottom:none;"><span style="font-size:7px; font-weight:none;">(Gender Not specified for <strong><?php if(isset($total_gender)){ echo $total_gender;}?></strong> users)</span></td>
		
	 </tr>
	   </tbody>
	</table>
 <?php }?>
 
 
       <table><tr><th>Total Class Section </th></tr>
	     <tr><th style="border-bottom:none;">&nbsp;</th></tr>
	  </table>
   <table width="100%">
     <thead>
	 <tr class="tbl_th_row">
		<th style="width:15%;">&nbsp;</th>
		<th style="width:15%;">Graduated</th>
		<th style="width:15%;">Deferred</th>
		<th style="width:15%;">Withdrawn</th>
		<th style="width:15%;">Continue</th>
		<th style="width:10%;">Male</th>
		<th style="width:15%;">Female</th>
	 </tr>
	 </thead>
	 <tbody>
	 <?php 
	        $activeClass = 'All';
			$completestudentinfo = getAllRegions($activeClass);
		if(!empty($completestudentinfo)){
			
		 	 $region_total_graduated=$region_total_deffered=$region_total_withdrawn=$region_total_continue=$region_total_male=$region_total_female=0;
		 foreach($completestudentinfo as $records){
			 
			 if($records['Region']==NULL || $records['Region']=="" || $records['Region']==0){
				 $region_program='None Selected';
			 }else{
				 $region_program=$records['RegionProgram'];
			 }
			 
			 $region_total_graduated+=$records['Total_Graduated'];
			 $region_total_deffered+=$records['Total_Deffered'];
			 $region_total_withdrawn+=$records['Total_Withdrawn'];
			 $region_total_continue+=$records['Total_Continue'];
			 $region_total_male+=$records['Total_Male'];
			 $region_total_female+=$records['Total_Female'];
	 ?>
	    <tr class="tbl_data_row">
			<td style="width:15%;"><?php echo $region_program;?></td>
			<td style="width:15%;"><?php echo $records['Total_Graduated'];?></td>
			<td style="width:15%;"><?php echo $records['Total_Deffered'];?></td>
			<td style="width:15%;"><?php echo $records['Total_Withdrawn'];?></td>
			<td style="width:15%;"><?php echo $records['Total_Continue'];?></td>
			<td style="width:10%;"><?php echo $records['Total_Male'];?></td>
			<td style="width:15%;"><?php echo $records['Total_Female'];?></td>
	   </tr>
	   <?php } }?>
	   
	   <tr class="tbl_th_row">
			 <td style="width:15%;">Total All Regions</td>
			 <td style="width:15%;"><?php if(isset($region_total_graduated)){ echo $region_total_graduated;}?></td>
			 <td style="width:15%;"><?php if(isset($region_total_deffered)){ echo $region_total_deffered;}?></td>
			 <td style="width:15%;"><?php if(isset($region_total_withdrawn)){ echo $region_total_withdrawn;}?></td>
			 <td style="width:15%;"><?php if(isset($region_total_continue)){ echo $region_total_continue;}?></td>
			 <td style="width:10%;"><?php if(isset($region_total_male)){ echo $region_total_male;}?></td>
			 <td style="width:15%;"><?php if(isset($region_total_female)){ echo $region_total_female;}?></td>
	   </tr>
	   
	   <tr class="tbl_data_row"><td colspan="7">&nbsp;</td></tr>
	   
	   <?php 
	   $completestudentcountryinfo = getAllClassCountries($activeClass);
	   if(!empty($completestudentcountryinfo)){
		
            $completestudentcountryinfo =  $completestudentcountryinfo;
            $group_by_country = array();	
		foreach ($completestudentcountryinfo as $row_data) {
		   $Countries = $row_data['Countries'];
		  if (isset($group_by_country[$Countries])) {
		    $group_by_country[$Countries][] = $row_data;
		  } else {
		   $group_by_country[$Countries] = array($row_data);
		  }
	    }	
    $country_total_graduated1=$country_total_deffered1=$country_total_withdrawn1=$country_total_continue1=$country_total_male1=$country_total_female1=0;	
		   foreach($group_by_country as $key=>$rows){
			   $country_total_graduated=$country_total_deffered=$country_total_withdrawn=$country_total_continue=$country_total_male=$country_total_female=0;
			   foreach($rows as $rec){
			  $country_total_graduated+=$rec['Total_Graduated'];
			  $country_total_deffered+=$rec['Total_Deffered'];
			  $country_total_withdrawn+=$rec['Total_Withdrawn'];
			  $country_total_continue+=$rec['Total_Continue'];
			  $country_total_male+=$rec['Total_Male'];
			  $country_total_female+=$rec['Total_Female'];
			   }
			 $country_total_graduated1+=$country_total_graduated;
			 $country_total_deffered1+=$country_total_deffered;
			 $country_total_withdrawn1+=$country_total_withdrawn;
			 $country_total_continue1+=$country_total_continue;
			 $country_total_male1+=$country_total_male;
			 $country_total_female1+=$country_total_female;
		?>
	   <tr class="tbl_data_row">
		 <td style="width:15%;"><?php echo $key;?></td>
		 <td style="width:15%;"><?php echo $country_total_graduated;?></td>
		 <td style="width:15%;"><?php echo $country_total_deffered;?></td>
		 <td style="width:15%;"><?php echo $country_total_withdrawn;?></td>
		 <td style="width:15%;"><?php echo $country_total_continue;?></td>
		 <td style="width:10%;"><?php echo $country_total_male;?></td>
		 <td style="width:15%;"><?php echo $country_total_female;?></td>
	   </tr>
	   <?php } } ?>
	 <tr class="tbl_th_row">
	    <td style="width:15%;">Total All Countries</td>
		 <td style="width:15%;"><?php if(isset($country_total_graduated1)){ echo $country_total_graduated1;}?></td>
		 <td style="width:15%;"><?php if(isset($country_total_deffered1)){ echo $country_total_deffered1;}?></td>
		 <td style="width:15%;"><?php if(isset($country_total_withdrawn1)){ echo $country_total_withdrawn1;}?></td>
		 <td style="width:15%;"><?php if(isset($country_total_continue1)){ echo $country_total_continue1;}?></td>
		 <td style="width:10%;"><?php  if(isset($country_total_male1)){ echo $country_total_male1;}?></td>
		 <td style="width:15%;"><?php if(isset($country_total_female1)){ echo $country_total_female1;}?></td>
	 </tr>
	 <tr class="tbl_th_row">
	    <td style="border-bottom:none;">Total In Class</td>
		 <td colspan="2" style="border-bottom:none;">
		 <?php 
				$total_student = getAllClassStudent($activeClass);
				if(!empty($total_student)){
					echo $total_student = $total_student['total_student'];
					$total_gender=($total_student-(($country_total_female1)+($country_total_male1)));
					
				}
			?></td>
		 <td colspan="2" style="border-bottom:none;">&nbsp;</td>
		 <td colspan="3" style="border-bottom:none;"><span style="font-size:7px; font-weight:none;">(Gender Not specified for <strong><?php if(isset($total_gender)){ echo $total_gender;}?></strong> users)</span></td>
		
	 </tr>
	   </tbody>
	</table>
	
	
	</section>