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
			 <!---->
			<div class="row" >
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Contact Details</h3>
						</div>
						<div class="panel-body">
							<div class="row" style="display:none;">							
								<div class="col-md-12 col-sm-12 col-xs-12" style="overflow-x:scroll;">        
                                    <table id="contactReport" class="table table-striped table-bordered">
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
                                                <th>Address Type</th>
                                                <th>Active Emails</th>
                                                <th>Tags</th>
                                                <th>Addressee</th>
                                                <th>Greeting</th>
                                                <th>Active Phone</th>
                                                <th>Active Int'l Address</th>
                                                <th>Inactive Email</th>
                                                <th>Inactive Address</th>
                                                <th>Inactive Int'l Address</th>
                                                <th>Inactive Phone</th>
                                                <th>Summary Note</th>
                                                <th>Board History</th>
                                                <th>Board Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  foreach($all_user as $user){ ?>
                                                <tr>
                                                    <td> <?php echo $user['ID']; ?></td>
                                                    <td> <?php echo $user['FirstName']; ?></td>
                                                    <td> <?php echo $user['LastName']; ?></td>
                                                    <td> <?php echo $user['Spouse']; ?></td>
                                                    <td> <?php echo $user['Company']; ?></td>
                                                    <td> <?php echo $user['Position']; ?></td>
                                                    <td> <?php echo $user['Street_Address']; ?></td>
                                                    <td> <?php echo $user['Address2']; ?></td>
                                                    <td> <?php echo $user['City']; ?></td>
                                                    <td> <?php echo $user['State']; ?></td>
                                                    <td> <?php echo $user['Postal_Code']; ?></td>
                                                    <td> <?php echo $user['CountryName']; ?></td>
                                                    <td> <?php echo $user['addressType']; ?></td>
                                                    <td> <?php echo $user['ActiveEmail']; ?></td>
                                                    <td> <?php echo $user['tags']; ?></td>
                                                    <td> <?php echo $user['Addressee']; ?></td>
                                                    <td> <?php echo $user['Greeting']; ?></td>
                                                    <td> <?php echo $user['ActivePhone']; ?></td>
                                                    <td> <?php echo $user['ActiveInternationalAddress']; ?></td>
                                                    <td> <?php echo $user['userInActiveEmail']; ?></td>
                                                    <td> <?php echo $user['inActiveAddress']; ?></td>
                                                    <td> <?php echo $user['inActiveInternationalAddress']; ?></td>
                                                    <td> <?php echo $user['userInActivePhone']; ?></td>
                                                    <td> <?php echo $user['Note']; ?></td>
                                                    <td> <?php echo $user['board_history']; ?></td>
                                                    <td> <?php echo $user['boardHistory']; ?></td>
                                                </tr>
                                            <?php } ?>
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