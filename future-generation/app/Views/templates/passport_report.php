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
.signature{
	
	page-break-after:always
	
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
	/*line-height:1px;*/
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
  <?php

   foreach($AllClassList as $key => $record){
	$activeClass = $record['Class'];
	$passportReports = getAllPassport($activeClass);
  if(!empty($passportReports)){
	$passport_record_count = count($passportReports);
if($passport_record_count>=1){
	  ?>
<table width="100%">
		<tr>
		 <th style="border-bottom:none; text-align:center;"><h2>Class of  <?=$record['Class'];?></h2></th>
		</tr>
</table>
<table width="100%">
<thead>
<tr class="tbl_th_row">
<th width="15%">Country</th>
<th width="15%">Passport Country</th>
<th width="23%">Name on Passport</th>
<th width="12%">Birthdate</th>
<th width="15%">Passport Number</th>
<th width="10%">Issue Date</th>
<th width="10%">Expire Date</th>
</tr>
</thead>
<tbody>

<?php
foreach($passportReports as $rec){
?>
<tr class="tbl_data_row">
  <td width="15%"><?php echo getCountryName($rec['address_country']);?></td>
	<td width="15%"><?php echo getCountryName($rec['PassportCountry']);?></td>
	<td width="23%"><?php echo $rec['NameOnPassport'];?></td>
	<td width="12%"><?php echo ($rec['Birthdate']!='' && $rec['Birthdate']!='00-00-00' ? date('m/d/Y',strtotime($rec['Birthdate'])):'');?></td>
	<td width="15%"><?php echo $rec['PassportNumber'];?></td>
	<td width="10%"><?php echo ($rec['PassportIssued']!='' ? date('m/d/Y',strtotime($rec['PassportIssued'])):'');?></td>
	<td width="10%"><?php echo ($rec['PassportExpires']!='' ? date('m/d/Y',strtotime($rec['PassportExpires'])):'');?></td>
</tr>

<?php } ?>

</tbody>
</table>
		<?php } } }?>

</section>
