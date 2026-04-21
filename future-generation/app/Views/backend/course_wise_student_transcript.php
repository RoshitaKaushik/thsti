<?php 
    //echo "<pre>";print_r($data);die; 
    //echo "<pre>"; print_r($this->session->userdata());
?>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">
<style>
 
input.form-control.credit {
    width: 100px;
}
input.form-control.creditearned {
    width: 100px;
}
input.form-control.credit {
    width: 100px;
}
input.form-control.gradevalue{
    width: 100px;
}
input.form-control.qualitypoint{
    width: 100px;
}
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
#SemesterListing_length{
    display:none;
}
#SemesterListing_filter{
    float:right;
    margin-top: -13px;
}

.btn-purple{
    background-color: #7e57c2 !important;
    border: 1px solid #7e57c2 !important;
    color: #FFFFFF !important;
    width: 24px;
    padding: 0px !important;
    border-radius: 0px !important;
}
.save-transcript{
    width: 24px !important;
}

.course_detal_table tr th {
    font-size: 12px !important;
}


#snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  /*-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;*/
  /*animation: fadein 0.5s, fadeout 0.5s 2.5s;*/
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
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
                            <h3 class="panel-title">Grade Editor
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
                                    echo form_open_multipart('admin/Form/gradsheetreport', $attr); 
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
                                                    
                                                    <div class="row">
                                                        <div class="col-sm-2 top_maargin">        
                                                            <label for="First Name" class="control-label">
                                                                Course Yr <span class="requires">*</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4 top_maargin">  
                                                            <select class="form-control validate" id="class" name="class" required>
                                                                <option value="">Select</option>
                                                                <?php if(!empty($class)) {
                                                                foreach ($class as $cl){    
                                                                ?>
                                                                <option value="<?=$cl['Class']?>" <?php if(isset($selectedclass) && $selectedclass == $cl['Class']) { echo "selected='selected'";} ?>><?=$cl['Class']?></option>
                                                                <?php } } ?>
                                                            </select>    
                                                        </div>
                                                        
                                                        <div class="col-sm-2 top_maargin">        
                                                            <label for="Semester" class="control-label">
                                                                Semester <span class="requires">*</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4 top_maargin">  
                                                            <select class="form-control validate" id="semester" name="semester" required>
                                                                <option value="">Semester</option>
                                                                <?php
                                                               foreach($semesterlist as $rows){
                                                                ?>
                                                                <option value="<?php echo $rows['Semester'];?>" <?php if(isset($selectedSemester)){if($selectedSemester ==$rows['Semester']){ echo "Selected='selected'";}}?>><?php echo $rows['Semester'];?></option>
                                                                <?php }?>
                                                            </select>                       				
                                                        </div>
                                                    </div>
                                                        <div class="row">
                                                            <div class="col-sm-2 top_maargin">        
                                                                <label for="First Name" class="control-label">
                                                                    Course : <span class="requires">*</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-4 top_maargin">  
                                                                <select class='form-control validate' name='course' id='course_list' required>
                                                                    <option value=''>Please select course</option>
                                                                    <?php
                                                                    if(isset($course)){
                                                                        foreach($course as $cr){
                                                                            $status='';
                                                                            if(isset($selectedcourse)){if($selectedcourse == $cr['CourseID'])
                                                                            {
                                                                                $status = "selected";
                                                                            }}
                                                                            echo "<option ".$status." value='".$cr['CourseID']."'>".$cr['CourseTitle']."(".$cr['Course'].")</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>			
                                                            </div>
                                                            
                                                            <div class="col-sm-2 top_maargin">        
                                                                <label class="control-label"> Grade : </label>
                                                            </div>
                                                            <div class="col-md-4 top_maargin">
                                                                <select class="form-control" name="grade">
                                                                    <option value="">--Select Grade--</option>
                                                                    <?php foreach($grades as $gd){ ?>
                                                                        <option value="<?= $gd['Grade'] ?>"><?= $gd['Grade'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                           
                                                        </div>
                                                        
                                                    </div> 
                                                    
                                                    <div class="col-sm-12 top_maargin text-right filter-sub-btn-box">  
                                                                <hr>
                                                                <span class="btn btn-success btn-xs filter_button">Filter</span>
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
                                        
                                        <div id="snackbar">Some text some message..</div>
                                        
                                        
                                        
								    </div>
                                    
                                    <?php echo form_close();?>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="col-md-6 hidden_div">
                                        <form action='<?= base_url('admin/Reports/export_pdf_report') ?>' method='post'  target="_blank">
                                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                            <input type='hidden' class="selected_class" name='class' value='<?php echo $selectedclass??'' ?>'>
                                            <input type='hidden' class="selected_semester" name='semester' value='<?php echo $selectedSemester??'' ?>'>
                                            <input type='hidden' class="selected_course" name='course' required value='<?php echo $selectedcourse??'' ?>'>
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
                                            <input type='hidden' class="selected_class" name='class' value='<?php echo $selectedclass??'' ?>'>
                                            <input type='hidden' class="selected_semester" name='semester' value='<?php echo $selectedSemester??'' ?>'>
                                            <input type='hidden' class="selected_course" name='course' required value='<?php echo $selectedcourse??'' ?>'>
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
                                                echo view('templates/filter/filter_course_wise_student_transcript',$data);
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
            data: ({ semester_id: semester_id , year: year, '<?= csrf_token() ?>':'<?= csrf_hash() ?>'}),
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
            data: ({ semester_id: semester_id , year: year,'<?= csrf_token() ?>':'<?= csrf_hash() ?>'}),
           // dataType: 'json', 
            type: 'post',
            success: function(data) {
                $('#course_list').html(data);
            }             
        });
        
    })
    
    
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
    function form_submit_data(){
        var formname='';
        formname=$("#filter");
        var formData = new FormData($('#filter')[0]);
        formData.append("submit","filter");
        formData.append('<?= csrf_token() ?>','<?= csrf_hash() ?>');
        $.ajax({
            type:"POST",
            dataType:'html',
            url:'<?= base_url() ?>admin/Form/filter_student_transcripts',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                $('#result').html(response);
                 $('#SemesterListing').DataTable( {
                   // "order": [[ 0, "ASC" ]],
            		"pageLength": -1,
            		"Paginate":false,
            	//	dom: 'Bfrtip',
                    responsive: true,
                   "ordering": false,
                    scrollX:        true,
                    scrollCollapse: true,
                    // fixedColumns:   {
                    //     leftColumns: 1
                    // },
                });
            }
        });
    }
    
    $(document).on('click','.filter_button',function(){
        let select_class = $('#class').val();
        let select_semester = $('#semester').val();
        let selected_course = $('#course_list').val();
        $('.validate').removeClass('invalid');
        if (!validateForm()) return false;
        filter_progress_loader();
         $('.filter-li').removeClass('open');
    })
    
    
    function update_progress_loader(){
        var content = '';
        content+='<main><div style="text-align:center"><h1 class="loader">Updating<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
        content+='</main>';
        $('#result').html(content);
        
    }
    
    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      y = document.getElementsByClassName("validate");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
           var val_data = $(y[i]).attr('name');
           var var_id = $(y[i]).attr('id');
           $('#'+var_id).focus();
           y[i].className += " invalid";
           // and set the current valid status to false
           valid = false;
        }
      }
      return valid; // return the valid status 
    }
    
    function validateTranscriptForm(id) {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      y = document.getElementsByClassName("validate"+id);
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
           var val_data = $(y[i]).attr('name');
           var var_id = $(y[i]).attr('id');
           $('#'+var_id).focus();
           y[i].className += " invalid";
           // and set the current valid status to false
           valid = false;
        }
      }
      return valid; // return the valid status 
    }
    
    $(document).on('change','.grade',function(){
        var data = $(this).val();
        var row_count = $(this).attr('data-rowid');
        if(data == 'W'){
            $("#completion_date"+row_count).css("pointer-events", "none");
            $('#with_date'+row_count).show();
            $('#modal_rel_id').val(row_count);
            $("#withdrawn_date_model").modal('show');
        }
        else{
            $("#completion_date"+row_count).css("pointer-events", "");
            $('#with_date'+row_count).hide();
            $('#withdrawn_date'+row_count).val('');
        }
        //start  fetch grade & update attempt & earn credit
        let ev = $(this);
        let current = $(this).val();
        if(current == 'SCH' || current == 'ENR' || current == 'ENR P/F' || current == 'AUDIT' || current == 'W' || current == 'F' || current == 'FAIL' ||
            current == 'N/A' || current == 'D' || current == 'D+' || current == 'I'){
            $(ev).closest('tr').find('.creditearned').val(0);
        }
        else{
            let old_credit = $(ev).closest('tr').find('.credit').val();
            $(ev).closest('tr').find('.creditearned').val(old_credit);
        }
        let counter = $(this).attr('data-rowid');
        let transcriptclassid = "#transcriptclass"+counter;
        let transcriptclas = $(transcriptclassid).val();
        if(current != ''){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Form/getGradeValue');?>",
                data:{'<?= csrf_token() ?>':'<?= csrf_hash() ?>', 'gradename':current,'transcriptclas':transcriptclas},
                success:function(result){
                    $(ev).closest('tr').find('.gradevalue').val(result);
                    let grade_value=result;
                    let credits_earned = $(ev).closest('tr').find('.creditearned').val();
                    let res = parseFloat(grade_value) * parseFloat(credits_earned);
                    qualitypoints = res.toFixed(2);
                    $(ev).closest('tr').find('.qualitypoint').val(qualitypoints);
                },
            });
        
        }
        // end fetch grade & update attempt & earn credit
    })
    
    $(document).on('keyup','.creditearned',function(){	
        var ev = $(this);
        var creditearned = $(this).val();
        var gradevalue = $(ev).closest('tr').find('.gradevalue').val();
        var res = parseFloat(creditearned) * parseFloat(gradevalue);
        var qualitypoints = res.toFixed(2);
        $(ev).closest('tr').find('.qualitypoint').val(qualitypoints);
    });
    
    $(document).on('click','.view_withdrawn_date',function(){
        var rel_date = $(this).attr('rel_date');
        var rel_id = $(this).attr('rel_id');
        var curr_date = $('#withdrawn_date'+rel_id).val();
        console.log(curr_date);
        $('#edit_modal_rel_id').val(rel_id);
        $('#view_selected_date').val(curr_date);
        $('#view_withdrawn_date_model').modal('show');
    })
    
    
    $(document).on('click','.update_withdrawn',function(){
        var date = $('#selected_date').val();
        var rel_id = $('#modal_rel_id').val();
        $('#withdrawn_date'+rel_id).val(date);
        date = new Date(date);
        let selectMonth = date.getMonth()+1;
        selectMonth = (selectMonth < 10)?'0'+selectMonth:selectMonth;
        let selectDate = date.getDate();
        selectDate = (selectDate < 10)?'0'+selectDate:selectDate;
        let selectYear = date.getFullYear();
        console.log(selectYear);
        $('#completion_date'+rel_id).val(selectMonth+"/"+selectDate+"/"+selectYear);
    })
  
    $(document).on('click','.update_withdrawn1',function(){
        var date = $('#view_selected_date').val();
        var rel_id = $('#edit_modal_rel_id').val();
        $('#withdrawn_date'+rel_id).val(date);
        //$('#completion_date'+rel_id).val(date);
        date = new Date(date);
        let selectMonth = date.getMonth()+1;
        selectMonth = (selectMonth < 10)?'0'+selectMonth:selectMonth;
        let selectDate = date.getDate();
        selectDate = (selectDate < 10)?'0'+selectDate:selectDate;
        let selectYear = date.getFullYear();
        console.log(selectYear);
        $('#completion_date'+rel_id).val(selectMonth+"/"+selectDate+"/"+selectYear);
    }) 
    
    
    
    function transcript(id){
        $('#snackbar').html('')
       
        
        transcript_rowid = $('#transcript_rowid'+id).val();
        student_id=$('#studentid'+id).val();
        if(student_id == '' || student_id == null || student_id == 0 || student_id == 'undefined'){
            alert('Student Id is missing . .');
        }
        classname = $('#transcriptclass'+id).val();
        semester  = $('#semester'+id).val();
        term      = $('#term'+id).val();
        term_text = $('#term'+id+' option:selected').text();
        withdrawn_date = $('#withdrawn_date'+id).val();
        withdrawn_html = '<input type="hidden" value="'+withdrawn_date+'" class="form-control" name="withdrawn_date['+id+']" id="withdrawn_date'+id+'">';
        if(term_text=="Select Session"){
            term_text='';
        }
        course    = $('#course_id'+id).val();
        grade     = $('#grade'+id).val();
        credits   = $('#credits'+id).val();
        creditearned = $('#creditearned'+id).val();
        grade_value = $('#grade_value'+id).val();
        qualitypoint = $('#qualitypoint'+id).val();
        coursedates = $('#coursedates'+id).val();
        completion_date = $('#completion_date'+id).val();
        if(grade == 'W'){
            $('#with_date'+id).attr('rel_date',withdrawn_date);
            $('#with_date'+id).show();
        }
        else{
            $('#with_date'+id).hide();
        }
       
       //update_progress_loader();
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Form/submitTranscript');?>',
            data: {'<?= csrf_token() ?>':'<?= csrf_hash() ?>', 
                    'transcript_rowid':transcript_rowid,
                    'student_id':student_id,
                    'courseid':course,
                    'grade':grade,
                    'coursedates':coursedates,
                    'creditattempt':credits,
                    'creditearned':creditearned,
                    'qualitypoints':qualitypoint,
                    'withdrawn_date':withdrawn_date,
                    'completion_date':completion_date
                },
            dataType: "json",
            success: function(data){
                
                
                $('#transcriptclass'+id).prev().html(classname).addClass('show').removeClass('hide');
                
                
                $('#grade'+id).prev().html(withdrawn_html+grade).addClass('show').removeClass('hide');
                $('#grade'+id).prev().addClass('show').removeClass('hide');
                $('#credits'+id).prev().html(credits).addClass('show').removeClass('hide');
                $('#creditearned'+id).prev().html(creditearned).addClass('show').removeClass('hide');
                $('#grade_value'+id).prev().html(grade_value).addClass('show').removeClass('hide');
                $('#qualitypoint'+id).prev().html(qualitypoint).addClass('show').removeClass('hide');
                
                
                $('#completion_date'+id).prev().html(completion_date).addClass('show').removeClass('hide');
				$('#transcriptclass'+id).addClass('hide').removeClass('show');
				
				
				$('#grade'+id).addClass('hide').removeClass('show');
				$('#credits'+id).addClass('hide').removeClass('show');
				$('#creditearned'+id).addClass('hide').removeClass('show');
				$('#grade_value'+id).addClass('hide').removeClass('show');
				$('#qualitypoint'+id).addClass('hide').removeClass('show');
				
				$('#completion_date'+id).addClass('hide').removeClass('show');
				
				
				$('#save-transcript'+id).addClass('hide').removeClass('show');
				$('#add-transcript'+id).addClass('hide').removeClass('show');
				$('#delete_button'+id).addClass('hide').removeClass('show');
				$('#edit-transcript'+id).addClass('show').removeClass('hide');
				$('#cancel-transcript'+id).addClass('hide').removeClass('show');
                
               // $('.alert_msg').html("<div class='alert alert-success'>"+data.msg+"</div>");
                
               
                /*$('html, body').animate({
                    scrollTop: $(".content-page").offset().top
                }, 1000);*/
                $('#snackbar').html(data.msg);
                $('#snackbar').addClass('show');
                setTimeout(function() {
                    $("#snackbar").removeClass('show');
                }, 
                3000);
            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                $('#snackbar').html(msg);
                $('#snackbar').addClass('show');
                setInterval(function() {
                    $("#snackbar").removeClass('show');
                }, 
                4000);
            }
        });
    
    }
    
    
    $(document).on('click', '.add-transcript,.save-transcript', function(){
        var id = this.id.replace( /^\D+/g, '');
        var classname=$('#transcriptclass'+id).val();
        var term =$('#term'+id).val();
        var course = $('#course'+id).val();
        var grade = $('#grade'+id).val();
        
        $('.validate'+id).removeClass('invalid');
        if (!validateTranscriptForm(id)) return false;
        
        if(classname==""){
            alert('Class Not Empty!');
            return false;
        }
        if(course==""){
            alert('Course Not Empty !');
            return false;
        }
        if(grade=="" || grade == null){
            alert('Grade Not Empty !');
            return false;
        }
        else{
            transcript(id);
        }
    });
    
    $(document).on('click', '.edit-transcript', function(){
        let row = $(this).attr('data-row');
        let selector = '#TextBoxDivTS'+row;
        $(selector+' span.show, '+selector+' a.edit-transcript').removeClass('show').addClass('hide');
        $(selector+' input, '+selector+' select, '+selector+' textarea, '+selector+' a.save-transcript, '+selector+' a.del_transcript, '+selector+' a.cancel-transcript').removeClass('hide').addClass('show');
    }); 
    
    $(document).on('click', '.cancel-transcript', function(){
        let row = $(this).attr('data-row');
        let selector = '#TextBoxDivTS'+row;
        $(selector+' input, '+selector+' select, '+selector+' textarea, '+selector+' a.save-transcript, '+selector+' a.cancel-transcript,'+selector+' a.del_transcript').removeClass('show').addClass('hide');
        $(selector+' span.hide, '+selector+' a.edit-transcript').removeClass('hide').addClass('show');
    }); 
    
    
    $(document).on('focus', '.datepicker', function(event){
			event.preventDefault();
			$(this).datepicker({
				format: 'mm/dd/yyyy',
				todayHighlight:'TRUE',
			    endDate: '-0d',
				autoclose: true,

			});
		});

    
</script>


<div class="modal fade" id="view_withdrawn_date_model" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                <h4 class="modal-title">Withdrawn Date</h4>
            </div>
            <div class="modal-body">
                <input  type="hidden" name="view_rel_id" id="edit_modal_rel_id">
                <label>Withdrawn Date :</label>
                <input type="date" id="view_selected_date"  class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success update_withdrawn1"  data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="withdrawn_date_model" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                <h4 class="modal-title">Withdrawn Date</h4>
            </div>
            <div class="modal-body">
                <input  type="hidden" name="rel_id" id="modal_rel_id">
                <label>Withdrawn Date :</label>
                <input type="date" id="selected_date" value="<?= date('Y-m-d') ?>" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success update_withdrawn" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

