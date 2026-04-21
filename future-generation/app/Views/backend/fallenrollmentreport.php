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

#SemesterListing_filter {
    float: right;
}
.buttons-excel
{
    display:none;
}

.excel_position button.dt-button.buttons-excel.buttons-html5 {
    position: absolute;
    top: -3px;
}
.sub_but {
	position:absolute;
	border: 2rem;
	color: white;
	padding: 6.7px 6px;
	font-weight: 700;
	border-radius: 2px;
	margin-left:-18.5rem;
	margin-top:1.8rem;
	width: 6.9rem;
}
th {
    font-size: 10px !important;
    }
    body {
    font-size: 11px !important;
}
th
{
    text-align:left ! Important;
}
td
{
    text-align:left ! Important;
}
.custum_buttom
{
    margin-top: 0px;
}
#SemesterListing,#SemesterListing1
{
    top: -28px;
    position: relative;
}
#SemesterListing_filter,#SemesterListing1_filter
{
    position: relative;
    top: -38px;
}
#table_Row_div
{
    position: relative;
    top: -15px;
}
</style> 
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
    		<!-- Page-Title -->
    		<!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Fall Enrollment Report</h4>
    			</div>
    		</div-->
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
    					<div class="panel-heading">
    						<h3 class="panel-title">Fall Enrollment Report
        						 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
            						<i class="ion-arrow-left-a"></i>
            						<span><strong>Go Back</strong></span>            
            					</a>
    						</h3>
    					</div>
    					<div class="panel-body">
    							<div class="col-md-12 col-sm-12 col-xs-12">
    							    
    							    
    							    <div class="row">    
    							        
    							        <div class="col-md-9">
    							            <div class="filter-sub-menu-outer-box">
        					                 <?php 
                                            $attr = array("name" => "filter", "id" => "filter");
                                            echo form_open_multipart('admin/Reports/fallenrollmentreport', $attr); 
                                            ?>
                                            <div class="stop-noti-box">
    							            <li class="dropdown hidden-xs filter-li">
                                                <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-filter"></i>Filter <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                </a>
                                           
                                                <ul class="dropdown-menu dropdown-menu-lg filter_ul">
                                                    <li class="text-center notifi-title">Filter</li>
                                                    <li class="list-group">
                                                      
                                                          <div class="col-sm-12 filter_category">             
                                                        	<div class="form-group">
                                                        	  <div class="row top_maargin">  
                                                                <div class="col-sm-2">  
                        						                   <label for="From" class="control-label">Enrollment ON</label> 
                        						                </div>
                        						                <div class="col-sm-4">
                                            						 <select class="form-control program_start filter_ajax" name="program_start">
                                                    			        <option value="">Select Year</option>
                                                    			        <?php
                                                    			         foreach($class as $cs)
                                                    			         {
                                                    			             ?>
                                                    			             <option <?php if($selected_program_start == $cs['Class']){ echo 'selected'; } ?> value="<?= $cs['Class'] ?>"><?= "15 Oct ".$cs['Class'] ?></option>
                                                    			             <?php
                                                    			         }
                                                    			        ?>
                                                    			    </select>                       				
                                                    			</div>
                                			                  
                                		                        <div class="col-sm-2"> 
                                		                            <label for="From" class="control-label">Semester</label>
                        						                </div>
                        						                <div class="col-md-4">
                        						                    <select class="form-control filter_ajax" name="semester">
                                        						      <option value="Fall">Fall</option>
                                        						  </select>
                                            						                        				
                                                    			</div>
											                  </div>
											                  
                                       	                      
                                                            	   
                                                        	</div>	
                                                          </div> 
                                                          
                                                    </li>
                                                </ul>
                                            </li>
                                            </div>
                                            <li class="cell_spacing_li">
                                                <a href="#" data-target="#" title="Line Spacing" class="dropdown-toggle waves-effect waves-light spacing-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                    <!--i class="fa fa-ellipsis-h" aria-hidden="true"></i-->
                                                <i class="fa fa-arrows-v"></i><i class="fa fa-bars"></i> <!--<i class="fa fa-angle-down" aria-hidden="true">--></i>
                                                </a>
                                                
                                                <ul class="dropdown-menu dropdown-menu-md spacing_ul">
                                                    <li class="list-group" style="margin-bottom:0px !important;">
                                                       <!-- list item-->
                                                        <span > 
                                                            <div class="single_spacing">
                                                                <i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-bars" aria-hidden="true"></i>
                                                                 Single
                                                            </div>
                                                            
                                                            <div class="double_spacing">
                                                                <i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-bars" aria-hidden="true"></i>
                                                                Double
                                                            </div>
                                                            
                                                        </span> 
                                                    </li>
                                                </ul>
                                                
                                            </li>
                                            
                                            <?php echo form_close();?>              
            							</div>
            							</div>
            							<div class="col-md-3" style="z-index:999">
            							    <div class="row">
            							        <div  class="col-md-6">
            							            
            							             <form action="<?= base_url()?>admin/Reports/export_pdf_fallenrollmentreport" method="post" target="_blank">
        												<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
        												<input type="hidden" class="form-control selected_program_start" name="program_start" value="<?= $selected_program_start ?>">
        												<input type="hidden" name="start_program_date" value="15-07-">
        												<input type="hidden" class="form-control selected_program_end" name="program_end" value="<?= $selected_program_end ?>">
        												<input type="hidden" class="form-control" name="end_program_date" value="01-03-">
        												<input type="hidden" name="semester" value="Fall">
        												<input class = "btn btn-primary btn-xs custum_buttom pull-right"  type="submit" value="Export Pdf">
        											 </form>
            							            
										        </div>
										        <div  class="col-md-6">
										            <form action="<?= base_url()?>admin/Reports/export_excel_fallenrollmentreport" method="post" target="_blank">
        												<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
        												<input type="hidden" class="form-control selected_program_start" name="program_start" value="<?= $selected_program_start ?>">
        												<input type="hidden" name="start_program_date" value="15-07-">
                                                        <input type="hidden" class="form-control selected_program_end" name="end_program_date" value="01-03-">
        												<input type="hidden" name="program_end" value="<?= $selected_program_end ?>">
        												<input type="hidden" name="semester" value="Fall">		
        												<input class = "btn btn-primary btn-xs custum_buttom"  type="submit" value="Export Excel">
        											 </form>
    										    </div>
            							    </div>
            							</div>
    							    </div>
    							    
        							
                                    <div class="row" id="table_Row_div">
                                        <span id="result">
                                            <?php
                                             echo view('templates/filter/filter_fallenrollmentreport');
                                            ?>
                                        </span>
                                    </div>
    					</div>
    				</div>
    			</div>
    			
    		</div> <!-- End Row -->           
        </div> <!-- container -->
     
	</div> <!-- content -->
</div> <!-- content-page -->

<script>



$(document).on('change','.program_start',function(){
    var year = $(this).val();
    $('.selected_program_start').val(year);
    year = parseInt(year)+1;
    $('.program_end').val(year);
    $('.selected_program_end').val(year);
    
    
})

    
$(document).on('change','.filter_ajax',function(){
    filter_progress_loader()
})   

function form_submit_data()
{
        var formname='';
        formname=$("#filter");
        var formData = new FormData($('#filter')[0]);
        formData.append("submit","filter");
        formData.append("<?= csrf_token() ?>","<?= csrf_hash() ?>");
        $.ajax({
            type:"POST",
            dataType:'html',
            url:'<?= base_url() ?>admin/Reports/filter_fallenrollmentreport',
            data: formData,
        	processData: false,
        	contentType: false,
            success: function(response){
                $('#result').html(response);
                
                
                	$('#SemesterListing').DataTable({
            			"dom": '<"dt-buttons excel_position"Bf><"clear">lirtp',
            			"paging": false,
            			"autoWidth": true,
            			"buttons": [{
            				text: '<span class=""><i class="fa fa-file-excel-o"></i> Excel</span>',
            				extend: 'excelHtml5',
            				filename: '<?=date('Y-m-d')?>_Semester_listing_reports',
            				footer: true,
            				/*responsive: true*/
            				title:'',
            				id:'classlistexl'
            
            			}
            			]
            		});
            		
            		
            		$('#SemesterListing1').DataTable({
            			"dom": '<"dt-buttons excel_position"Bf><"clear">lirtp',
            			"paging": false,
            			"autoWidth": true,
            			"buttons": [{
            				text: '<span class=""><i class="fa fa-file-excel-o"></i> Excel</span>',
            				extend: 'excelHtml5',
            				filename: '<?=date('Y-m-d')?>_Semester_listing_reports',
            				footer: true,
            				/*responsive: true*/
            				title:'',
            				id:'classlistexl'
            
            			}
            			]
            		});
                
                $('input[name="selected_field[]"]:not(:checked)').each(function () {
                    var column_no = $(this).attr('rel_column_no');
                    var table = $('.datatable_th').DataTable();
                    var column = table.column(column_no);
                    // Toggle the visibility
                    column.visible(!column.visible());    
                });
                
            }
        });
 }    
    
</script>