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
			 <!--style="display: none;"-->
			<div class="row" style="display: none;">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Add General Mailing LIst</h3>
						</div>
						<div class="panel-body">
							<div class="row">							
								<div class="col-md-12 col-sm-12 col-xs-12" style="overflow-x:scroll;">
								    
								    
								    <table id="generalreport" class="table table-striped table-bordered">
								        <thead>
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
								        </thead>
								        
								        <tbody>
								            	<?php 
											if(!empty($records)){
											    foreach($records as $row) { ?>
											        <tr>
    											        <td> <?php echo $row['ID']; ?></td>
                                                        <td> <?php echo $row['FirstName']; ?></td>
                                                        <td> <?php echo $row['LastName']; ?></td>
                                                        <td> <?php echo $row['Spouse']; ?></td>
                                                        <td> <?php echo $row['Company']; ?></td>
                                                        <td> <?php echo $row['Position']; ?></td>
                                                        <td> <?php echo $row['Street_Address']; ?></td>
                                                        <td> <?php echo $row['Address2']; ?></td>
                                                        <td> <?php echo $row['City']; ?></td>
                                                        <td> <?php echo $row['State']; ?></td>
                                                        <td> <?php echo $row['Postal_Code']; ?></td>
                                                        <td> <?php echo $row['CountryName']; ?></td>
                                                        <td> <?php echo $row['addressType']; ?></td>
                                                        <td> <?php echo $row['email']; ?></td>
                                                        <td> <?php echo trim($row['tags'],", "); ?></td>
                                                        <td> <?php echo $row['Addressee']; ?></td>
                                                        <td> <?php echo $row['Greeting']; ?></td>
                                                    </tr>
											    <?php }
											    }?>
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


