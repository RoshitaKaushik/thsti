<?php //echo "<pre>";print_r($data);die;
//echo "<pre>"; print_r($this->session->userdata()); die;


?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
	.table>tbody>tr>td,
	.table>tbody>tr>th,
	.table>tfoot>tr>td,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>thead>tr>th {
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

	#overlay>p {
		color: #FF9800;
		position: absolute;
		top: 60%;
		left: 49%;
		margin: -28px 0 0 -25px;
	}
</style>
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">
			<!-- <h3 class="panel-title">Export VIP Mailing List Report</h3>
			<button type="button" id="exportexcelvip" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5">
				<i class="fa fa-file-pdf-o"></i>
				<span><strong>Click to Export</strong></span>
			</button>style="display: none;"
			 -->
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Donor Mailing Report</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12" style="overflow-x:scroll;display:none">

									<table id="donormailreport" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>ContactID</th>
												<th>FirstName</th>
												<th>LastName</th>
												<th>Spouse</th>
												<th>Organization</th>
												<th>Position</th>
												<th>Street Address</th>
												<th>AddressLine2</th>
												<th>City</th>
												<th>State</th>
												<th>Postal Code</th>
												<th>Country</th>
												<th>Type</th>
												<th>Active Emails</th>
												<th>Tags</th>
												<th>Addressee</th>
												<th>Greeting</th>
												<th>Newest Donation Amount</th>
												<th>Newest Donation Date</th>
												<th>Total Donation</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if (!empty($records)) {
												foreach ($records as $row) {
													$records = getUniqueAddressByID($row['ID']);
													$useremail = explode(",", $row['useremail']);
											?>
													<tr>
														<td><?= $row['ID'] ?></td>
														<td><?= $row['FirstName'] ?></td>
														<td><?= $row['LastName'] ?></td>
														<td><?= $row['Spouse'] ?></td>
														<td><?= $row['Company'] ?></td>
														<td><?= $row['Position'] ?></td>
														<td><?= $row['Street_Address'] ?></td>
														<td><?= $row['Address2'] ?></td>
														<td><?= $row['City'] ?></td>
														<td><?= $row['State'] ?></td>
														<td><?= $row['Postal_Code'] ?></td>
														<td><?= $row['CountryName'] ?></td>
														<td><?= $row['addressType'] ?></td>
														<td><?= $row['useremail'] ?></td>
														<td><?= trim($row['tags'], ", ") ?></td>
														<td><?= $row['Addressee'] ?></td>
														<td><?= $row['Greeting'] ?></td>
														<td><?php echo "$" . $row['LastAmount'] ?></td>
														<td><?= date('m/d/Y', strtotime($row['ReceivedDate'])); ?></td>
														<td><?php echo "$" . $row['total_amount'] ?></td>
													</tr>
											<?php
												}
											}
											?>
										</tbody>
									</table>

									<!--table id="donormailreport" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Daniel's Permission To Contact</th>
												<th>First Name</th>												
												<th>Last Name</th>
												<th>Active Email 1</th>												
												<th>Active Email 2</th>
												<th>Active Email 3</th>
												<th>Spouse</th>												
												<th>Company</th>
												<th>Newest Donation</th>
												<th>Total Donation</th> 												
												<th>Addressee</th>									
												<th>Greeting</th>
												<th>Street</th>
												<th>Address2</th>
												<th>State</th>												
												<th>City</th>
												<th>Zip</th>
												<th>Country</th>			
												<th>Unsubscribed</th>
												<th>Deceased</th>
												
											</tr>
										</thead>
										<tbody> 
											<?php
											//$i=1;
											//echo "<pre>"; print_r($records); 
											if (!empty($records)) {
												foreach ($records as $row) {
													if (!is_array($row)) {
														continue; // Skip if $row is not an array
													}
													//foreach($record as $row) {
													$records = getUniqueAddressByID($row['ID']);
													$useremail = explode(",", $row['useremail']);
											?>
                                                <tr>
                                                    <td><?= $row['DanielPermissionNeeded'] == 1 ? 'Yes' : 'No' ?>	</td>
                                                    <td><?= $row['FirstName'] ?></td>
                                                    <td><?= $row['LastName'] ?></td>
                                                    <td><?php if (isset($useremail[0])) {
															echo $useremail[0];
														} else {
															echo 'N/A';
														} ?></td>
                                                    <td><?php if (isset($useremail[1])) {
															echo $useremail[1];
														} else {
															echo 'N/A';
														} ?></td>
                                                    <td><?php if (isset($useremail[2])) {
															echo $useremail[2];
														} else {
															echo 'N/A';
														} ?></td>
                                                    <td><?php if ($row['spouse'] != '') {
															echo $row['spouse'];
														} else {
															echo 'N/A';
														} ?></td>
                                                    <td><?php if ($row['Company'] != '') {
															echo $row['Company'];
														} else {
															echo 'N/A';
														} ?></td>
                                                    <td><?php if ($row['ReceivedDate'] != '') {
															echo date('m/d/Y', strtotime($row['ReceivedDate']));
														} else {
															echo 'N/A';
														} ?></td>	
                                                    <td><?php if ($row['total_amount'] != '') {
															echo $row['total_amount'];
														} else {
															echo 'N/A';
														} ?></td>
                                                    <td><?php if ($row['Addressee'] != '') {
															echo $row['Addressee'];
														} else {
															echo 'N/A';
														} ?></td>
                                                    <td><?php if ($row['Greeting'] != '') {
															echo $row['Greeting'];
														} else {
															echo 'N/A';
														} ?></td>
                                                    <td><?php if (!empty($records['Street_Address'])) {
															echo $records['Street_Address'];
														} else {
															echo "N/A";
														} ?></td>
                                                    <td><?php if (!empty($records['Address2'])) {
															echo $records['Address2'];
														} else {
															echo "N/A";
														} ?></td>
                                                    <td><?php if (!empty($records['StateName'])) {
															echo $records['StateName'];
														} else {
															echo "N/A";
														} ?></td>
                                                    <td><?php if (!empty($records['City'])) {
															echo $records['City'];
														} else {
															echo "N/A";
														} ?></td>
                                                    <td><?php if (!empty($records['Postal_Code'])) {
															echo $records['Postal_Code'];
														} else {
															echo "N/A";
														} ?></td>
                                                    <td><?php if (!empty($records['CountryName'])) {
															echo $records['CountryName'];
														} else {
															echo "N/A";
														} ?></td>
                                                    <td><?= $row['Unsubscribed'] == 1 ? 'Yes' : 'No' ?></td>
                                                    <td><?php echo ($row['Deceased'] == 0 ? 'No' : 'Yes'); ?></td>
                                                </tr>
											<?php  }
											} //} 
											?>
										</tbody>
									</table-->
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