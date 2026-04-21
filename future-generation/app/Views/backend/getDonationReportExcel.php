<?php //echo "<pre>";print_r($data);die;
//echo "<pre>"; print_r($this->session->userdata()); die;


?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                 
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
}

 #overlay { 
position: fixed; 
z-index: 5000; 
left: 0; 
top: 0; 
bottom: 0; 
right: 0; 
background: #000; 
opacity: 0.8; 
filter: alpha(opacity=80); 
} 
#loading { 
width: 50px; 
height: 57px; 
position: absolute; 
top: 50%; 
left: 50%; 
margin: -28px 0 0 -25px; 
} 
#overlay > p{ 
color:#FF9800; 
position: absolute; 
top: 60%; 
left: 49%; 
margin: -28px 0 0 -25px;} 

</style>     
<div class="content-page">
<!-- Start content -->
	<div class="content">
		<div class="container">
			<!-- <h3 class="panel-title">Export VIP Mailing List Report</h3>
			<button type="button" id="exportexcelvip" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5">
				<i class="fa fa-file-pdf-o"></i>
				<span><strong>Click to Export</strong></span>
			</button>
			 -->
			<div class="row" style="display:none">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Donations - Campaign Report </h3>
						</div>
						<div class="panel-body">
							<div class="row">							
								<div class="col-md-12 col-sm-12 col-xs-12">
									<table id="donationreportexcel" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Name</th>
												<th>Date Received</th>
												<th>Type</th>
												<th>Amount</th>
												<th>Campaign</th>
												<th>Donation Note</th>
											</tr>
										</thead>
										<tbody> 
											<?php 
											if(!empty($records)){
											    foreach($records as $row) { 
											    ?>
											    <tr>
												<td><?= $row['FirstName']." ".$row['LastName'] ?></td>
												<td>
												    <?php
												     if($row['ReceivedDate'] != '')
												     {
												        echo date('m/d/Y',strtotime($row['ReceivedDate']));
												     }
												    ?>
												</td>
												<td><?= $row['PaymentType'] ?></td>
												<td><?= $row['Amount'] ?></td>
												<td><?= $row['CampaignName'] ?></td>
												
												<td><?= $row['DonationNote'] ?></td>
												
												</tr>
											<?php  } } //} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div> <!-- container -->                              
	</div> <!-- content -->
</div> <!-- content -->

<div>