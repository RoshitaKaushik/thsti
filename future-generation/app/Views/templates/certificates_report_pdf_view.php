<?php

/*if(isset($student_details)){
	$row = $student_details;
	$full_name = $row['FirstName']." ".$row['LastName'];
	$id = $row['ID'];
	
}*/
?>
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
	font-size:8px;
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
	color:#000; 
	text-align:left;
	padding:10px;
	line-height:1px;
	margin:10px 0px; 
	border-top:5px solid #FFF; 
	font-size:12px !important;
	border-bottom: 1px solid grey;
}

thead { display: table-header-group }
tfoot { display: table-row-group }
tr { page-break-inside: avoid }
</style>
<section class="application-form-page" style="position:relative;">	
        <table width="100%" >
            <tr>
                <th style="border-bottom:none; text-align:center;">CLASS LISTING REPORTS BY CERTIFICATES</th>
            </tr>
        </table>
       <?php  $certiname = getCertificateName($certificate); 
        if($certiname)
        {
            ?>
            <table width="100%" >
		<tr>
		 <th style="border-bottom:none; text-align:center;">Class of  <?=$certiname?></th>
		</tr>
		</table>
            <?php
        }
       ?>
        
		
		<?php
		
		  if(!empty($records)){
			  $graduate_record_count = count($records);
			  if($graduate_record_count>=1){
		?>
		<table width="100%">
		
		</table>
	 	<table width="100%"  style="padding-left:10px; padding-top: 10px;">
		    <thead>
		    <tr class="tbl_th_row">
                <th >First Name </th>
                <th>Last Name</th>
                <th>Country</th>
				<th>Certificate</th> 
                <th>Certificate No</th>
                <th>Year</th>
				<th>Semester</th>
				<th>Level</th>
				<th>Diploma</th>
				<th>Tuition</th>
		    </tr>
			</thead>
			<tbody>
           <?php
		   $unique_country=array();
		   $unique_region=array();
		   $unique_male=array();
		 
		   $count_rows=0;
		 
		   foreach($records as $row){ ?>  
			<tr class="tbl_data_row" >
                <td ><?php echo $row['Firstname'];?></td>
                <td><?php echo $row['LastName'];?></td>
                <td><?php echo $row['Countries'];?></td>
				<td><?php echo $row['CertName'];?></td> 
			     <td><?php echo $row['cert_no'];?></td>
                <td><?php echo $row['Class'];?></td> 
			    <td><?php echo $row['semester'];?></td>
			    <td><?php if($row['grad_undergrad']=='G'){ echo "Graduate"; } if($row['grad_undergrad']=='U'){ echo "UnderGraduate"; };?></td>
			    <td><?php echo $row['dipName'];?></td> 
			    <td><?php echo $row['tution'];?></td> 
		    </tr>
		   <?php }?>
		   <tr class="tbl_data_row"><td colspan="5" style="border-bottom:none;">&nbsp;</td></tr>
		   </tbody>
	    </table>
		
  <?php } }?>
     <?php 
	      if(!empty($continue)){
			
		   $continue_record_count = count($continue);
		   if($continue_record_count>=1){
	   ?>
       <table><tr><th>Continuing</th></tr></table>
		<table width="100%"  style="padding-left:10px;">
		    <thead>
		    <tr class="tbl_th_row">	
              			
                <th style="width:20%">First Name</th>
                <th style="width:20%">Last Name</th>
                <th style="width:20%">Region</th>
                <th style="width:20%">Country</th>
                <th style="width:20%">Program</th>
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
                <td style="text-align:left ; width:20%"><?php echo $c['Firstname'];?></td>
                <td style="width:20%"><?php echo $c['LastName'];?></td>
                <td style="width:20%"><?php echo $continue_region_name;?> </td>
                <td style="width:20%"><?php echo $c['Countries'];?></td>
                <td style="width:20%"><?php echo $c['Program_Name'];?></td>
		    </tr>
			<?php }?>
			<tr class="tbl_data_row"><td colspan="4" style="border-bottom:none;"></td></tr>
			</tbody>
        </table>
  <?php } }?>
 		 <?php 
		    if(!empty($deffered)){
				$deferred_record_count = count($deffered);
				if($deferred_record_count>=1){
		 ?>
	<?php } }?>
	   <?php
	   if(!empty($withdrawn)){
		   $withdrawn_record_count = count($withdrawn);
		   if($withdrawn_record_count>=1){
	    ?>
	 
  <?php } }?>
  
  
 
  
  
  
</section>
