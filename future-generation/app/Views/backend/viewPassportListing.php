<?php //echo "<pre>";print_r($data);die; 

//echo "<pre>"; print_r($this->session->userdata());
 ?>
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
}
.dataTables_info{
    display:none;
}
#classListing_filter{
    display:none;
}
</style> 
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
    		<!-- Page-Title -->
    		<div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Student Passport Listing Reports</h4>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
    					<div class="panel-heading">
    						<h3 class="panel-title">Report
        						 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
            						<i class="ion-arrow-left-a"></i>
            						<span><strong>Go Back</strong></span>            
            					</a>
    						</h3>
    					</div>
    					<div class="panel-body">
    							<div class="col-md-12 col-sm-12 col-xs-12">
    								<div class="col-md-12" >
    									<?php 
                                        $attr = array("name" => "filter", "id" => "studentfilter");
                                        echo form_open_multipart('admin/Reports/StudentPassportListings', $attr); 
                                        ?>
        								<div class="form-group">
        									<div class="col-sm-1">        
                                				<label for="First Name" class="control-label">Class <span class="requires">*</span></label>
                        					</div>
                        					<div class="col-sm-4">  
                        						<select class="form-control" id="class" name="class" onchange="submitform();">
													<option value="">Select</option>
                        							<option value="All">All Classes</option>
                        							<?php if(!empty($class)) {
                        							    foreach ($class as $cl){    
                        							?>
                        							<option value="<?=$cl['Class']?>" <?php if($selectedclass == $cl['Class']) { echo "selected='selected'";} ?>><?=$cl['Class']?></option>
                        							<?php } } ?>
                        						</select>                        				
                                			</div>
                                			
                                		</div>
										<?php echo form_close();?>
										<div class="col-md-12">
											
											
											<button type="button" id="generatepassportpdf" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right"><i class="fa fa-file-pdf-o"></i>
												<span><strong>PDF</strong></span></button>
										</div>
                                	</div>
									<div class="col-md-12"></div>
    								<table id="classPassportListings" class="table table-striped table-bordered">
    									<thead>
    										<tr>
												<th>Class Year</th>
    											<th>Country</th>
    											<th>Passport Country</th>
    											<th>Name on Passport</th>
    											<th>Birthdate</th>
    											<th>Passport Number</th>
    											<th>Issue Date</th>
    											<th>Expiration Date</th>   										
    										</tr>
    									</thead>
    							        <tbody> 
    							        	<?php
											if(!empty($records)){
												$record_not_found=0;
												$count_passport=0;
												foreach($records as $rec){
												$count_passport++;
												$record_not_found=1;
											?>
    							        	<tr>  
												<td><?php echo $rec['Class'];?></td>
    										    <td><?php echo getCountryName($rec['address_country']);?></td>
    										    <td><?php echo getCountryName($rec['PassportCountry']);?></td>
    										    <td><?php echo $rec['NameOnPassport'];?></td>
    										    <td><?php echo ($rec['Birthdate']!='' && $rec['Birthdate']!='00-00-00' ? date('m/d/Y',strtotime($rec['Birthdate'])):'');?></td>
    										    <td><?php echo $rec['PassportNumber'];?></td>
    										    <td><?php echo ($rec['PassportIssued']!='' ? date('m/d/Y',strtotime($rec['PassportIssued'])):'');?></td>
    										    <td><?php echo ($rec['PassportExpires']!='' ? date('m/d/Y',strtotime($rec['PassportExpires'])):'');?></td>
											</tr>
    										<?php } } ?>
    										</tbody>
 											
    									
    								</table>
                          	</div>
    						
    					</div>
    				</div>
    			</div>
    			
    		</div> <!-- End Row -->           
        </div> <!-- container -->
     
	</div> <!-- content -->
</div> <!-- content-page -->
<script>
function submitform(){
	$('#studentfilter').submit();
}

$(document).on("click","#generatepassportpdf",function(){
	window.open('<?php echo  base_url("admin/PdfBuilder/getStudentPassportReport/");?><?php echo encryptor('encrypt',$selectedclass);?>', '_blank');
	
});

</script>