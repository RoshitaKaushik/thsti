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
   /* position: relative;
    top: -45px;*/
}
#SemesterListing_wrapper
{
    margin-top: -40px;
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
.custum_buttom{
    margin:0px!important;
}

</style> 
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
    		<!-- Page-Title -->
    		<!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Enrollment Report</h4>
    			</div>
    		</div-->
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
    					<div class="panel-heading">
    						<h3 class="panel-title">Enrollment Report
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
                                            echo form_open_multipart('admin/Reports/enrollmentreport', $attr); 
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
                                                                
                                                                <div class="col-md-2">
                                                                    <label for="From" class="control-label">From</label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="hidden" name="start_program_date" value="01-07-">
                                                    			    <select class="form-control filter_ajax program_start" name="program_start">
                                                    			        <option value="">Select Year</option>
                                                    			        <?php
                                                    			         foreach($class as $cs)
                                                    			         {
                                                    			             ?>
                                                    			             <option <?php if($selected_program_start == $cs['Class']){ echo 'selected'; } ?> value="<?= $cs['Class'] ?>"><?= "01 July ".$cs['Class'] ?></option>
                                                    			             <?php
                                                    			         }
                                                    			        ?>
                                                    			    </select>
                                                                </div>
                                                                
                                                                <div class="col-md-2">
                                                                  <label for="From" class="control-label">To</label>
                        						  
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="hidden" name="end_program_date" value="30-06-">
                                                    			    <select class="form-control filter_ajax program_end" name="program_end">
                                                    			        <option value="">Select Year</option>
                                                    			        <?php
                                                    			         foreach($class as $cs)
                                                    			         {
                                                    			             ?>
                                                    			             <option <?php if($selected_program_end == $cs['Class']){ echo 'selected'; } ?> value="<?= $cs['Class'] ?>"><?= "30 June ".$cs['Class'] ?></option>
                                                    			             <?php
                                                    			         }
                                                    			        ?>
                                                    			    </select>
                                                                </div>
                                                                
											                  </div>
											                  
											                  
											                  <div class="row top_maargin">
											                      <div class="col-md-2">
											                          <label for="From" class="control-label">Semester</label>
											                      </div>
											                      <div class="col-md-4">
											                          <select class="form-control filter_ajax semester" name="semester">
                                            						      <option value="">Select Semester</option>
                                            						      <?php
                                            						        foreach($semesters as $sm)
                                            						        {
                                            						            ?>
                                            						            <option <?php if($selected_semester == $sm['Semester']){ echo "selected"; } ?> value="<?= $sm['Semester'] ?>"><?= $sm['Semester'] ?></option>
                                            						            <?php
                                            						        }
                                            						      ?>
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
            							
            							 <div class="col-md-3">
            							     <div class="row">
            							         <div class="col-md-6">
                                                    <form action="<?= base_url()?>admin/Reports/export_pdf_enrollmentreport" method="post" target="_blank">
                                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                        <input type="hidden" class="form-control selected_program_start" name="program_start" value="<?= $selected_program_start ?>">
                                                        <input type="hidden" class="form-control selected_program_end" name="program_end" value="<?= $selected_program_end ?>">
                                                        <input type="hidden" name="start_program_date" value="01-07-">
                                                        <input type="hidden" name="end_program_date" value="30-06-">
                                                        <input type="hidden" class="form-control selected_semester" name="semester" value="<?= $selected_semester?>">										
                                                        <input class = "btn btn-primary btn-xs custum_buttom pull-right"  type="submit" value="Export Pdf">
                                                    
                                                    </form>
            							         </div>
            							         
            							         <div class="col-md-6">
                                                    <form action="<?= base_url()?>admin/Reports/export_excel_enrollmentreport" method="post" target="_blank">
                                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                        <input type="hidden" class="form-control selected_program_start" name="program_start" value="<?= $selected_program_start ?>">
                                                        <input type="hidden" class="form-control selected_program_end" name="program_end" value="<?= $selected_program_end ?>">
                                                        <input type="hidden" name="start_program_date" value="01-07-">
                                                        <input type="hidden" name="end_program_date" value="30-06-">
                                                        <input type="hidden" class="form-control selected_semester" name="semester" value="<?= $selected_semester?>">										
                                                        <input class = "btn btn-primary btn-xs custum_buttom"  type="submit" value="Export Excel">
                                                    </form>
            							         </div>
            							         
            							     </div>
            							 </div>
    								    
    					            </div>			    
    								    	
                                	
                                <div class="row" id="result">
                                    
                                   
                               </div>
                          
    						
    					</div>
    				</div>
    			</div>
    			
    		</div> <!-- End Row -->           
        </div> <!-- container -->
     
	</div> <!-- content -->
</div> <!-- content-page -->

<script>
$(document).on('change','.filter_ajax',function(){
    var program_start = $('.program_start').val(); 
    
    var program_end   = $('.program_end').val();
    var semester      = $('.semester').val();
    $('.selected_program_start').val(program_start);
    $('.selected_program_end').val(program_end);
    $('.selected_semester').val(semester);
    filter_progress_loader()
})

function form_submit_data()
{
    var formname='';
    formname=$("#filter");
    var formData = new FormData($('#filter')[0]);
    formData.append("submit","filter");
    formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
    $.ajax({
        type:"POST",
        dataType:'html',
        url:'<?= base_url() ?>admin/Reports/filter_enrollmentreport',
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