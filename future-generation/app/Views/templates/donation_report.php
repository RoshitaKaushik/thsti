
<style>
.tbl_heading_row{
	
	font-weight:bold;
	font-family:arial;
	font-size:10px;
	background-color:#fff;
	}
.tbl_main{
	font-weight:normal;
	font-family:arial;
}
.tbl_data_row{
 font-weight:normal;
 font-family:arial;
 font-size:8px; 
}
.tbl_th_row{
	font-weight:bold;
	font-family:arial;
	font-size:8px;
	
}
.signature{
	page-break-after:always;
	
}
.pagebreakavoid{
	page-break-after:avoid;
}
th{
	border-bottom:1px thin #000;
}

.innertable{
	border:none !important;
}
.table{
	
	margin-bottom:10px !important;
}
thead { display: table-header-group }
tfoot { display: table-row-group }
tr { page-break-inside: avoid }

</style>

<section class="application-form-page" style="position:relative;">

<table width="100%">
 <tr class="tbl_heading_row"><th align="center" style="border-bottom:none; color:#156caf;">Donations Report from <?php if(isset($report_date)){ echo $report_date['begin_date'];}?> to <?php if(isset($report_date)){ echo $report_date['end_date'];}?></th></tr>
 <tr class="tbl_data_row"><td>&nbsp;&nbsp;</td></tr>
</table>

<?php if(!empty($monthrecords)){
	   $total_year_amount=0;
	   $complete_year_amount=0;
	   $year_record=0;
	   foreach($monthrecords as $key=>$row){
		 $month = $row['month'];
	     $year  = $row['year'];
		 if($year_record!=$year){
			 $year_record=$year;
			 $total_year_amount=0;
			 
		 }
		$results = getmonthlydonationsreports_without_tuition_credit_refund($month,$year);
		//echo "<pre>"; print_r($results);
		
		?>
<table width="100%">
<tr class="tbl_th_row">
<th><?php 
   
	if($month==1){
		$disp_month="January";
	}
	if($month==2){
		$disp_month="February";
	}
	if($month==3){
		$disp_month="March";
	}
	if($month==4){
		$disp_month="April";
	}
	if($month==5){
		$disp_month="May";
	}
	if($month==6){
		$disp_month="June";
	}
	if($month==7){
		$disp_month="July";
	}
	if($month==8){
		$disp_month="August";
	}if($month==9){
		$disp_month="September";
	}if($month==10){
		$disp_month="October";
	}if($month==11){
		$disp_month="November";
	}
	if($month==12){
		$disp_month="December";
	}
	echo $final_year = $disp_month." ".$year;
 ?></th>
</tr>
<tr class="tbl_data_row"><td style="border-bottom:none;">&nbsp;</td></tr>
</table>
<table width="100%" cellpadding="5">
<thead>
<tr class="tbl_th_row">
    <th width="16%">Name</th>
    <th width="12%">Received</th>
    <th width="12%">Type</th>
    <th width="10%" style="text-align:right;">Amount</th>
    <th width="24%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Campaign</th>
    <th width="26%">Donation Note</th>
</tr>
</thead>
<tbody>
<?php if(!empty($results)){
	$total_payment_amount=0;
	$record_not_found=0;
	foreach($results as $rec){
      $record_not_found=1;
	  $total_payment_amount+=$rec['Amount'];
	  $total_year_amount+=$rec['Amount'];
	  $complete_year_amount+=$rec['Amount'];
	  
	  $full_name = $rec['FirstName']." ".$rec['LastName'];
?>

<tr class="tbl_data_row">
	<td width="16%"><?php echo $full_name;?></td>
	<td width="12%"><?php echo date('m/d/Y',strtotime($rec['ReceivedDate']));?></td>
	<td width="12%"><?php echo $rec['PaymentType'];?></td>
	<td style="text-align:right;" width="10%"><?php echo number_format($rec['Amount'],2);?></td>
	<td width="24%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rec['CampaignName'];?></td>
	<td width="26%"><?php echo $rec['DonationNote'];?></td>
</tr>
<?php } }?>

<tr class="tbl_th_row">
	
	<th colspan="1" style="border-top:1px solid black; border-bottom:none;">&nbsp;</th>
	<th colspan="2" style="border-top:1px solid black; border-bottom:none; text-align:right;"><?php echo $disp_month." ".$year." "."Total"." "." "; ?></th>
	<th style="border-top:1px solid black; border-bottom:none; text-align:right;" colspan="1"><?php if(isset($total_payment_amount)){ echo number_format($total_payment_amount,2);}?></th><th style="border-top:1px solid black; border-bottom:none;" colspan="2">&nbsp;&nbsp;</th>
	
</tr>
<tr class="tbl_data_row"><td colspan="6">&nbsp;&nbsp;</td></tr>
</tbody>
</table>
<?php 
if(isset($monthrecords[$key+1]['year'])){
	   if($monthrecords[$key+1]['year']!=$year){?>
	   <table width="100%">
			<tr class="tbl_th_row"><th colspan="6">Year : <?php echo $year;?></th></tr>
			
			<tr class="tbl_th_row">
			
			<th  width="16%" style="border-bottom:none;">&nbsp;</th>
			<th  width="14%" style="border-bottom:none;">&nbsp;</th>
			<th width="12%" style="border-bottom:none;">&nbsp;</th>
			<th width="12%" style="border-bottom:none;">&nbsp;</th>
			<th width="12%" style="border-bottom:none; text-align:right;">Grand Total</th>
			<th  width="10%" style="border-bottom:none; text-align:right;"><?php echo number_format($total_year_amount,2);?></th>
			<th width="24%" style="border-bottom:none;">&nbsp;</th>
						
			</tr>
			
	   </table>
<?php   }
	}else{
?>
   <table width="100%">
		 <tr class="tbl_th_row"><th colspan="6">Year : <?php echo $year;?></th></tr>
		<tr class="tbl_th_row">
			<th width="16%" style="border-bottom:none;">&nbsp;</th>
			<th width="14%" style="border-bottom:none;">&nbsp;</th>
			<th width="12%" style="border-bottom:none;">&nbsp;</th>
			<th width="12%" style="border-bottom:none;">&nbsp;</th>
			<th width="12%" style="border-bottom:none; text-align:right;">Grand Total</th>
			<th width="10%" style="border-bottom:none; text-align:right;"><?php echo number_format($total_year_amount,2);?></th>
			<th width="24%" style="border-bottom:none;">&nbsp;</th>
		</tr>
   </table>
	<?php
	}
	?>
<?php } }?>
<table width="100%">
	<tr class="tbl_th_row"><th colspan="6">Report Total</th></tr>
			<tr class="tbl_th_row">
			<th width="16%" style="border-bottom:none;">&nbsp;</th>
			<th width="14%" style="border-bottom:none;">&nbsp;</th>
			<th width="12%" style="border-bottom:none;">&nbsp;</th>
			<th width="12%" style="border-bottom:none;">&nbsp;</th>
			<th width="12%" style="border-bottom:none; text-align:right;">Grand Total</th>
			<th width="10%" style="border-bottom:none; text-align:right;"><?php echo number_format(isset($complete_year_amount),2);?></th>
			<th width="24%" style="border-bottom:none;">&nbsp;</th>
		</tr>
</table>
</section>
