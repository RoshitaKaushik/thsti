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
    float: left;
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
.buttons-excel
{
    display:none;
}
</style> 
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
    		<!-- Page-Title -->
    		<!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Market Report </h4>
    			</div>
    		</div-->
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
    					<div class="panel-heading">
    						<h3 class="panel-title">Market Report
        						 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
            						<i class="ion-arrow-left-a"></i>
            						<span><strong>Go Back</strong></span>            
            					</a>
    						</h3>
    					</div>
    					<div class="panel-body">
    					    
    					    <div class="col-md-12">
    					        <div class="row">
    					            <div class="col-md-2"></div>
    					            <div class="col-md-10">
    					                <form method='post' action='<?= base_url(); ?>admin/Reports/special_program_report' id="filter">
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
                                                            				<label for="First Name" class="control-label">Class Yr (From)<span class="requires">*</span></label>
                                                    					</div>
                                                    					 <div class="col-sm-4 top_maargin">  
                                                    						<select class="form-control filter_ajax" id="class" name="class" required>
                            													<option value="">Select</option>
                                                    							<?php if(!empty($class)) {
                                                    							    foreach ($class as $cl){    
                                                    							?>
                                                    							<option value="<?=$cl['Class']?>" <?php if($selectedclass == $cl['Class']) { echo "selected='selected'";} ?>><?=$cl['Class']?></option>
                                                    							<?php } } ?>
                                                    						</select>                        				
                                                            			</div>
                                                            			
                                                            			
                                                            			<div class="col-sm-2 top_maargin">
                                                            			    <label for="First Name" class="control-label">Class Yr (To)<span class="requires">*</span></label>
                            						
                                                            			</div>
                                                            			<div class="col-sm-4 top_maargin">
                                                            			    <select class="form-control filter_ajax" id="class_to" name="class_to" required>
                            													<option value="">Select</option>
                                                    							<?php if(!empty($class)) {
                                                    							    foreach ($class_to as $cl){    
                                                    							?>
                                                    							<option value="<?=$cl['Class']?>" <?php if($selectedclassto == $cl['Class']) { echo "selected='selected'";} ?>><?=$cl['Class']?></option>
                                                    							<?php } } ?>
                                                    						</select>
                                                            			</div>
                                                            		
                                                            		</div>
                                                            		<div class="row">
                                                            			<div class="col-sm-2 top_maargin">
                                                            			    	<label for="Driver's License" class="control-label">Market</label>
                                                            			</div>
                                                            			<div class="col-sm-4 top_maargin">
                                                            			     <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                							 <select class='form-control filter_ajax' name='special_program_id'>
                                                							     <option value="All">All</option>
                                                							     <?php
                                                							       foreach($student_special_program as $program)
                                                							       {
                                                							           ?>
                                                							           <option <?php if($selected == $program['Special_ProgramID']){ echo "selected";  } ?> value='<?= encryptor('encrypt', $program['Special_ProgramID']) ?>'><?= $program['Special_Program_Name'] ?></option>
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
                                                                <i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-bars" aria-hidden="true"></i> Single
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
									    </form>
							        </div>
							        
							        
    					        </div>
    					    </div>
    					    
						    <div class="col-sm-12" style="top:-50px;">
						        <span id="result">
						            <?php echo view('templates/filter/filter_special_program_report',isset($data) ? $data : []); ?>
                                </span>
                            </div>
                          
    						
    					</div>
    				</div>
    			</div>
    			
    		</div> <!-- End Row -->           
        </div> <!-- container -->
     
	</div> <!-- content -->
</div> <!-- content-page -->

  
    


<script type="text/javascript">
$(document).ready(function() {
    $('#alldataTable1').DataTable( {
        //"order": [[ 0, "ASC" ]],
		"pageLength": 30
    });
});

 $(document).on('change','#class',function(){
    $('#class_to').html('<option value=""> Select</option>');
    var year = $(this).val();       
    $.ajax({
        url: '<?= base_url() ?>admin/Reports/get_higher_class',
        data: ({ year: year,"<?= csrf_token() ?>": "<?= csrf_hash() ?>"}),
        // dataType: 'json', 
        type: 'post',
        success: function(data) {
            $('#class_to').html(data);
        }             
    });
 });
 
 $(document).on('change','.filter_ajax',function(){
     var selected_year      = $('#class').val(); 
     var selected_class_to  = $('#class_to').val();
     if(selected_year != '' && selected_class_to != ''){
        filter_progress_loader();
     }
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
            url:'<?= base_url() ?>admin/Reports/filter_special_program_report',
            data: formData,
        	processData: false,
        	contentType: false,
            success: function(response){
                $('#result').html(response);
                 $('#alldataTable1').DataTable( {
                  
            		"pageLength": 25
                } );
                
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