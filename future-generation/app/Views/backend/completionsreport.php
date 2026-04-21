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
th {
    font-size: 10px !important;
}
body {
    font-size: 11px !important;
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
    margin-top:0px ! Important;
}

.table-responsive
{
    top: -42px;
    position: relative;
}
</style> 
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
    		<!-- Page-Title -->
    		<!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title"></h4>
    			</div>
    		</div-->
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
    					<div class="panel-heading">
    						<h3 class="panel-title">12 M Completions Reports
        						 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
            						<i class="ion-arrow-left-a"></i>
            						<span><strong>Go Back</strong></span>            
            					</a>
    						</h3>
    					</div>
    					<div class="panel-body">
    							<div class="col-md-12 col-sm-12 col-xs-12">
    							  
    							    
    							    
    							    					    
        							    <div class="row">
        							        <!-- Button Filter -->
        							        <?php 
                                            $attr = array("name" => "filter", "id" => "filter");
                                            echo form_open_multipart('admin/Reports/completionsreport', $attr); 
                                            ?>	
        							        <div class="col-md-7">
            							        <div class="filter-sub-menu-outer-box">
        								            <li class="dropdown hidden-xs filter-li">
                                                        <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-filter"></i>Filter <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                        </a>
                                                        
                                                        <ul class="dropdown-menu dropdown-menu-lg filter_ul">
                                                            <li class="text-center notifi-title">Filter</li>
                                                            <li class="list-group">
                                                               <!-- list item-->
                                                                 <div class="col-sm-12 filter_category">                
                                        								<div class="form-group">
                                        								  <div class="row">  
                                    										  <div class="col-sm-2 top_maargin">
                                    										      	<label for="From" class="control-label">From</label>
                                    										  </div>
                                    										  <div class="col-sm-4 top_maargin">
                                    										      <select class="form-control filter_ajax graduation_from" name="graduation_from">
                                                        						      <option value="">Select Year</option>
                                                            						  <?php
                                                            						   foreach($class as $cl)
                                                            						   {
                                                            						       ?>
                                                            						       <option <?php if($selected_graduation_from == $cl['Class']){ echo 'selected'; } ?> value="<?= $cl['Class'] ?>"><?= "1 July ".$cl['Class'] ?></option>
                                                            						       <?php
                                                            						   }
                                                            						  ?>
                                                        						  </select>
                                    										  </div>
                                    										  
                                    										  <div class="col-sm-2 top_maargin">
                                    										        <label for="From" class="control-label">To</label>
                                    										  </div>
                                    										  <div class="col-sm-4 top_maargin">
                                    										        <select class="form-control filter_ajax graduation_to" name="graduation_to">
                                                        						      <option value="">Select Year</option>
                                                            						  <?php
                                                            						   foreach($class as $cl)
                                                            						   {
                                                            						       ?>
                                                            						       <option <?php if($selected_graduation_to == $cl['Class']){ echo 'selected'; } ?> value="<?= $cl['Class'] ?>"><?= "30 June ".$cl['Class'] ?></option>
                                                            						       <?php
                                                            						   }
                                                            						  ?>
                                                            						  </select> 
                                    										  </div>
                                    									  </div>
                                    									  <div class="row">
                                    										  <div class="col-sm-2 top_maargin">
                                    				                                <label for="From" class="control-label">Gender</label>						      
                                    										  </div>
                                    										  <div class="col-sm-4 top_maargin">
                                    				                                <select name="Sex" class="form-control Sex filter_ajax">
                                                            						    <option value="">Select Gender</option> 
                                                            						    <option value="M" <?php if($selected_gender == 'M'){ echo 'Selected'; } ?>>Male</option>
                                                            						    <option value="F" <?php if($selected_gender == 'F'){ echo 'Selected'; } ?>>Female</option>
                                                            						    <option value="Other" <?php if($selected_gender == 'Other'){ echo 'Selected'; } ?>>Other</option>
                                                            						    
                                                            						</select>
                                                            						<input type="hidden" value="Yes" name="graduate_state">						      
                                    										  </div>
                                    										  
                                    										  <div class="col-sm-2 top_maargin">
                                    										        <label for="From" class="control-label">Ethnicity</label> 
                                    										  </div>
                                    										  <div class="col-sm-4 top_maargin">
                                    										        <select name="Ethnicity" id="Ethnicity" class="form-control filter_ajax">
                                                    								    <option value="">----- Please Select -----</option>
                                                    								    <option value="American Indian" <?php if($selected_ethnicity=='American Indian'){echo 'selected';} ?>>American Indian</option>
                                                    								    <option value="Asian" <?php if($selected_ethnicity=='Asian'){echo 'selected';} ?>>Asian</option>
                                                    								    <option value="Black/African American" <?php if($selected_ethnicity=='Black/African American'){echo 'selected';} ?>>Black/African American</option>
                                                    								    <option value="Hispanic/Latino" <?php if($selected_ethnicity=='Hispanic/Latino'){echo 'selected';} ?>>Hispanic/Latino</option>
                                                    								    <option value="Native Hawaiian/Pacific Islander" <?php if($selected_ethnicity=='Native Hawaiian/Pacific Islander'){echo 'selected';} ?>>Native Hawaiian/Pacific Islander</option>
                                                    								    <option value="White" <?php if($selected_ethnicity=='White'){echo 'selected';} ?>>White</option>
                                                    								    <option value="Non-Resident Alien" <?php if($selected_ethnicity=='Non-Resident Alien'){echo 'selected';} ?>>Non-Resident Alien</option>
                                                    								    <option value="Unknown" <?php if($selected_ethnicity=='Unknown'){echo 'selected';} ?>>Unknown</option>
                                                    								</select>
                                    										  </div>
                                										  </div>
                                                                		</div>
                                                                  </div> 
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    
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
                                                    <div class="stop-noti-box">
                                              
                                                    <li class="sort_li">
                                                        <a href="#" data-target="#" title="Sort" class="dropdown-toggle waves-effect waves-light sort-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                          <i class="fa fa-long-arrow-down"></i><i class="fa fa-long-arrow-up"></i> Sort <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                            
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-lg sort_ul">
                                                            <li class="text-center notifi-title">Sort by
                                                                <input type="hidden" class="form-control" id="sort_count" value="0">
                                                            </li>
                                                            <li class="list-group">
                                                                 <div class="row  sort_list_group">
                                                                    
                                                                 </div>
                                                                 <div class="row">
                                                                     <div class="col-md-11">
                                                                         <span class="add_new_sort pull-right"><i class="fa fa-plus"></i>&nbsp;Add new sort</span>
                                                                     </div>
                                                                     <div class="col-md-1"></div>
                                                                 </div>
                                                                 
                                                            </li>
                                                        </ul>
                                                    </li>
                                                
                                                    </div>
                                                
                                                    
                                                    <div class="stop-noti-box">
                                                        <li class="hide_li">
                                                        <a href="#" data-target="#" title="Sort" class="dropdown-toggle waves-effect waves-light sort-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                          <i class="fa fa-eye-slash"></i> Hide  <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                            
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-lg hide_ul">
                                                            <li class="text-center notifi-title">Hide
                                                            </li>
                                                            <li class="list-group">
                                                                 <div class="col-md-12">
                                                                    <div class="row list_field_div hide_list_group"></div>
                                                                 </div> 
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    </div>
                                                    
                                                        
        									    </div>
    								        </div>
    								        <?php echo form_close();?>
    								         <div class="col-md-2">
    								             
    								         </div>
    									     <div class="col-md-3">
    									         <div class="row">
    									             <div class="col-md-6">
    									                 <form action="<?= base_url()?>admin/Reports/export_pdf_completionsreport" method="post" target="_blank">
                    								        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                            <input type="hidden" class="form-control selected_graduation_from" name="graduation_from" value="<?= $selected_graduation_from ?>">
                                                            <input type="hidden" class="form-control selected_graduation_to" name="graduation_to" value="<?= $selected_graduation_to ?>">	
                                                            <input type="hidden" class="form-control selected_age" name="age" value="<?= $selected_age ?>">
                                                            <input type="hidden" class="form-control selected_Sex" name="Sex" value="<?= $selected_gender ?>">
                                                            <input type="hidden" class="form-control selected_Ethnicity" name="Ethnicity" value="<?= $selected_ethnicity ?>">
                                                            <input type="hidden" value="Yes" name="graduate_state">
                                						    <input class = "btn btn-primary btn-xs pull-right custum_buttom"  type="submit" value="Export Pdf">
                    								     </form>
    									             </div>
    									             <div class="col-md-6">
    									                    <form action="<?= base_url()?>admin/Reports/export_excel_completionsreport" method="post" target="_blank">

                        								        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                                <input type="hidden" class="form-control selected_graduation_from" name="graduation_from" value="<?= $selected_graduation_from ?>">
                                                                <input type="hidden" class="form-control selected_graduation_to" name="graduation_to" value="<?= $selected_graduation_to ?>">
                                                                <input type="hidden" class="form-control selected_age" name="age" value="<?= $selected_age ?>">
                                                                <input type="hidden" class="form-control selected_Sex" name="Sex" value="<?= $selected_gender ?>">
                                                                <input type="hidden" class="form-control selected_Ethnicity" name="Ethnicity" value="<?= $selected_ethnicity ?>">
                                                                <input type="hidden" value="Yes" name="graduate_state">
                                                                <input class = "btn btn-primary btn-xs custum_buttom"  type="submit" value="Export Excel">
                        								    </form>        
    									             </div>
    									         </div>
    									         
    									     </div>
        							    </div>
        							
									<span id="result">
                                        <?php
                                          echo view('templates/filter/filter_completionsreport');
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
$(document).on('change','.filter_ajax',function(){
    var graduation_from = $('.graduation_from').val();
    var graduation_to   = $('.graduation_to').val();
    var Sex             = $('.Sex').val();
    var Ethnicity       = $('#Ethnicity').val();
    
    $('.selected_graduation_from').val(graduation_from);
    $('.selected_graduation_to').val(graduation_to);
    $('.selected_Sex').val(Sex);
    $('.selected_Ethnicity').val(Ethnicity);
    
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
            url:'<?= base_url() ?>admin/Reports/filter_completionsreport',
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