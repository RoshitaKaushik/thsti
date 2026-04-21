<?php 
    //echo "<pre>";print_r($data);die; 
    //echo "<pre>"; print_r($this->session->userdata());
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

#SemesterListing_filter
{
    position: relative;
    margin-top: -50px;
}
.hidden_div
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
    				<h4 class="pull-left page-title">Grade Sheet Reports</h4>
    			</div>
    		</div-->
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <h3 class="panel-title">Grade Sheet Reports
                                <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>            
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <!-- Button Filter -->
                                
                                <div class="col-md-9">
                                    <?php
                                    $attr = array("name" => "filter", "id" => "filter");
                                    echo form_open_multipart('admin/Reports/gradsheetreport', $attr); 
                                    ?>
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
                                                            
                                                            <div class="col-sm-2 top_maargin">        
                                                                <label for="First Name" class="control-label">
                                                                    Course Yr <span class="requires">*</span>
                                                                </label>
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
                                                                <label for="Semester" class="control-label">
                                                                    Semester <span class="requires">*</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-4 top_maargin">  
                                                                <select class="form-control filter_ajax" id="semester" name="semester" required>
                                                                    <option value="">Semester</option>
                                                                    <?php
                                                                    foreach($semesterlist as $rows){
                                                                    ?>
                                                                    <option value="<?php echo $rows['Semester'];?>" <?php if($selectedSemester ==$rows['Semester']){ echo "Selected='selected'";}?>><?php echo $rows['Semester'];?></option>
                                                                    <?php }?>
                                                                </select>                       				
                                                            </div>
                                                            
                                                            <div class="col-md-12 row top_maargin">
                                                            <div class="col-sm-2 top_maargin">        
                                                                <label for="First Name" class="control-label">
                                                                    Course : <span class="requires">*</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-4 top_maargin">  
                                                                <select class='form-control filter_ajax' name='course' id='course_list' required>
                                                                    <option value=''>Please select course</option>
                                                                    <?php
                                                                    if($course)
                                                                    {
                                                                        foreach($course as $cr)
                                                                        {
                                                                            $status='';
                                                                            if($selectedcourse == $cr['CourseID'])
                                                                            {
                                                                                $status = "selected";
                                                                            }
                                                                            echo "<option ".$status." value='".$cr['CourseID']."'>".$cr['CourseTitle']."(".$cr['Course'].")</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>			
                                                            </div>
                                                            </div>
                                                            
                                                            <!--div class="col-sm-12 top_maargin text-right filter-sub-btn-box">                          				
                                                            <input class="btn btn-success btn-xs filter_button" name="submit" type="submit" value="Filter">	
                                                            </div--> 
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
                                        
                                        
								    </div>
                                    
                                    <?php echo form_close();?>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="col-md-6 hidden_div">
                                        <form action='<?= base_url('admin/Reports/export_pdf_report') ?>' method='post'  target="_blank">
                                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                            <input type='hidden' class="selected_class" name='class' value='<?php echo $selectedclass ?>'>
                                            <input type='hidden' class="selected_semester" name='semester' value='<?php echo $selectedSemester ?>'>
                                            <input type='hidden' class="selected_course" name='course' required value='<?php echo $selectedcourse ?>'>
                                            <input type='hidden' name='title' value='Grade Report'/>
                                            <input type='hidden' class="selected_type" name='type' value=''><br/>
                                            <button type="submit" onclick='return check_data()' class='btn btn-primary btn-xs custum_buttom' style='float:right;'>
                                                <span class="fa fa-file-pdf-o"></span>&nbsp;Export Pdf
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-md-6 hidden_div">
                                        <form action='<?= base_url('admin/Reports/export_grade_sheet_excell') ?>' method='post'  target="_blank">
                                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                            <input type='hidden' class="selected_class" name='class' value='<?php echo $selectedclass ?>'>
                                            <input type='hidden' class="selected_semester" name='semester' value='<?php echo $selectedSemester ?>'>
                                            <input type='hidden' class="selected_course" name='course' required value='<?php echo $selectedcourse ?>'>
                                            <input type='hidden' name='title' value='Grade Report'/>
                                            <input type='hidden' class="selected_type" name='type' value=''><br/>
                                            <button type="submit" onclick='return check_data1()' class='btn btn-primary btn-xs custum_buttom'>
                                            <span class="fa fa-file-excel-o"></span>&nbsp;Export Excel
                                            </button>	
                                        </form>
                                    </div>
                                </div>
                            </div>


    							<div class="col-md-12 col-sm-12 col-xs-12">    
                                    <span id="result">
                                        <?php
                                           echo view('templates/filter/filter_gradsheetreport',$data);
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
    $(document).on('change','#semester',function(){
        var semester_id = $(this).val();
        var year = $('#class option:selected').val();
        
         $.ajax({
            url: '<?= base_url() ?>admin/Reports/getcourse',
            data: ({ semester_id: semester_id , year: year,"<?= csrf_token() ?>": "<?= csrf_hash() ?>"}),
           // dataType: 'json', 
            type: 'post',
            success: function(data) {
                $('#course_list').html(data);
            }             
        });
    })
    $(document).on('change','#class',function(){
        var year = $(this).val();
        var semester_id =  $('#semester option:selected').val();
        $.ajax({
            url: '<?= base_url() ?>admin/Reports/getcourse',
            data: ({ semester_id: semester_id , year: year,"<?= csrf_token() ?>": "<?= csrf_hash() ?>"}),
           // dataType: 'json', 
            type: 'post',
            success: function(data) {
                $('#course_list').html(data);
            }             
        });
        
    })
    
    function check_data1()
    {
        return true;
         /*var data = '<?php echo $selectedSemester ?>';
         if(data == '')
         {
             alert('Please Filter Data');
             return false
         }
         else
         {
             return true;
         }*/
      
    }
     function check_data()
    {
        return true;
        /*var data = '<?php echo $selectedSemester ?>';
         if(data == '')
         {
             alert('Please Filter Data');
             return false
         }
         else
         {
             return true;
         }*/
    }
    
    $(document).on('change','.filter_ajax',function(){
        
        var selected_key = $(this).attr('name');
        var val = $(this).val();
        
        $('.selected_'+selected_key).val(val);
        
        var value = $('.filter_ajax').filter(function () {
                        return this.value == '';
                    });  
     
        if (value.length == 0) {
            
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
            url:'<?= base_url() ?>admin/Reports/filter_gradsheetreport',
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
                        filename: '2022-09-12_Semester_listing_reports',
                        footer: true,
                        /*responsive: true*/
                        title:'',
                        id:'classlistexl'
                    }]
                });
                
                $('.hidden_div').show();
                
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

