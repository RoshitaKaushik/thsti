<?php
$add_permission = $edit_permission = $excel_permission = $print_permisson =  false;

if(in_array(13, session()->get('profiles')?? [])){
	$permissions = getPermissionDetails('13','44','35');
	if(!empty($permissions)){
	    if($permissions[0]['add_button'] == '1'){
	        $add_permission = true;
	    }
	    if($permissions[0]['edit_button'] == '1'){
	        $edit_permission = true;
	    }
	    if($permissions[0]['excel_button'] == '1'){
	        $excel_permission = true;
	    }
	    if($permissions[0]['print_button'] == '1'){
	        $print_permisson = true;
	    }
	}
}

if(session()->get('role') == 1){
	$add_permission = $edit_permission = $excel_permission = $print_permisson = true;
}



$finane=getfinancialyear_june(date("d-m-Y"));
$finanyre=explode("-",$finane);

$first_datee = $finanyre[0];
$last_datee =$finanyre[1];
 //echo "<pre>";print_r($data);die; 

//echo "<pre>"; print_r(session()->get());
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
.filter-sub-menu-outer-box .filter_ul
{
    width:700px ! important;
}
.requiresval
{
    color: #dc3535;
}
</style> 
<!-- coded by bajrang -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <!--div class="row">
                <div class="col-sm-12" style="left: 38%;">
                    <h4 class="pull-left page-title">Future Generations University Timesheet</h4>
                </div>
            </div-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
						<?php
							//GetDate = strtotime($_SESSION['admin_login_date_time']);
							//$getDate = date(M Y,$GetDate );
						?>
                            <h3 class="panel-title">Admin Time Report <span style="position: absolute;left: 46%;"> <?php echo $_SESSION['admin_fullname'];?></span> 
                            <?php if($excel_permission){ ?>
                                <button style="margin-top: -27px;right: 144px;padding: 0px 12px !important;" onclick="fnExcelReport('attendance_report')" class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="classListing"><span><i class="fa fa-file-excel-o"></i> Excel</span>
                                </button>
                            <?php } ?>
                                 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>            
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body" style="padding-left: 0px; padding-right: 0px;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="filter-sub-menu-outer-box col-md-10">
                                     <?php 
                                    $attr = array("name" => "filter", "id" => "filter");
                                    echo form_open_multipart('admin/Reports/adminTimeReport', $attr); 
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
                                                      <div class="row">
                                                            <div class="col-sm-6 top_marginn">									
                                                                <div class="form-group">
                                                                    <label for="" class="control-label col-sm-4">From <span class="requiresval">*</span></label>
                                                                    <div class="col-sm-1"> : </div>
                                                                    <div class="col-sm-7">
                                                                        <input class="form-control datepickerbackward required  requiredfile2 requiredfield filter_ajax" id="BeginDateforms" placeholder="Begin Date" name="BeginDate" type="text" value="<?php if(isset($BeginDate)){ echo $BeginDate; }?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-sm-6 top_marginn">									
                                                                <div class="form-group">
                                                                    <label for="" class="control-label col-sm-4">To <span class="requiresval">*</span></label>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">
                                                                        <input class="form-control datepickerbackward required requiredfile2 requiredfield filter_ajax" id="EndDateforms" placeholder="End Date" name="EndDate" type="text" value="<?php if(isset($EndDate)){ echo $EndDate; }?>">  
                                                                        <span id="valid_date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>	
                                                            
                                                            
                                                            <div class="col-sm-6 top_marginn">                                  
                                                                <div class="form-group">
                                                                    <label for="" class="control-label col-sm-4">Select Team <span class="requiresval"></span></label>
                                                                    <div class="col-sm-1"> :
                                                                    </div>
                                                                    <div class="col-sm-7">
                                                                        <select id="User_option" name="Team_option" class=" form-control filter_ajax">
                                                                            <option value="0" <?php if($Team_option=="0"){ echo "selected"; }?> >ALL</option>
                                                                            <?php foreach ($team_name as  $team_name) { ?>
                                                                            <option value="<?php echo $team_name['id'] ?>" <?php if($Team_option==$team_name['id']){ echo "selected"; }?> >
                                                                            <?php echo $team_name['team_Name']." (".$team_name['id'].")"; ?></option>   
                                                                            <?php } ?> 
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                
                                        
                                                            <div class="col-sm-6 top_marginn">                      
                                                                <div class="form-group">
                                                                    <label for="" class="control-label col-sm-4">Select User </label>
                                                                    <div class="col-sm-1"> :
                                                                    </div>
                                                                    <div class="col-sm-7">
                                                                        <select id="User_option" name="User_option" class=" form-control filter_ajax">
                                                                            <option value="0" <?php if($User_option=="0"){ echo "selected"; }?> >ALL</option>
                                                                            <?php foreach ($facultystaff as  $staff) { ?>
                                                                            <option value="<?php echo $staff['ID'] ?>" <?php if($User_option==$staff['ID']){ echo "selected"; }?> >
                                                                            <?php echo $staff['FirstName']." ".$staff['LastName']."(".$staff['ID'].")"; ?></option>   
                                                                            <?php } ?>  
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <div class="col-sm-6 top_marginn">                      
                                                                <div class="form-group">
                                                                    <label for="" class="control-label col-sm-4">1099</label>
                                                                    <div class="col-sm-1"> :
                                                                    </div>
                                                                    <div class="col-sm-7">
                                                                        <?php $selected_contact_1099_option = $selected_contact_1099_option ?? ''; ?>
                                                                        <select id="contact_1099" name="contact_1099" class=" form-control filter_ajax">
                                                                            <option value="" <?php if($selected_contact_1099_option==""){ echo "selected"; }?> >ALL</option>
                                                                            <option value="Yes" <?php if($selected_contact_1099_option=="Yes"){ echo "selected"; }?> >Yes</option>
                                                                            <option value="No" <?php if($selected_contact_1099_option=="No"){ echo "selected"; }?> >No</option>
                                                                        </select>
                                                                    </div>
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
                                
                                <div class="col-md-2">
                                    <button type="button" id="all_attendance" class="btn btn-success btn-xs show" style="float: right;margin-left: 5px;margin-bottom: 4px;margin-top: 10px;"><i class="fa fa-eye"></i> Show All Category</button>
                                    <button type="button" id="all_attendance_hide" class="btn btn-warning btn-xs hide" style="float: right;margin-left: 5px;margin-bottom: 4px;margin-top: 10px;"><i class="fa fa-eye-slash" aria-hidden="true"></i> Hide Empty Category</button>
                                </div>
                                <span id="result">
                                    <?php
                                      echo view('templates/filter/filter_admin_time_report', $data);
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
<!-- end coded by bajrang -->
<script>


</script>
<script >
	
	function Date_Valid(){
		
		var BeginN= $('#BeginDateforms').val().length;
		var EndN= $('#EndDateforms').val().length;
		//console.log(BeginN +'  END:'+EndN);
		 if(BeginN == 0 && EndN == 0  ){

		 	alert("From and To dates are required field");
	         return false;
		 	} else { 
		 	var BeginDate = new Date($('#BeginDateforms').val());
			var EndDate = new Date($('#EndDateforms').val()); 
				if(Date.parse(EndDate) < Date.parse(BeginDate)){
		   //start is less than End
		   alert("To Date can not be smaller than From Date");
		   return false;
		}else{
		   //end is less than start
		   return true;
		}
			}

	    }
</script>
<script>
function fnExcelReport(table_id)
{
   // alert(table_id);
    var tab_text = '<table border="1px" style="font-size:13px; font-family:Arial" ">';
    var textRange; 
    var j = 0;
    var tab = document.getElementById(table_id); // id of table
    var lines = tab.rows.length;
    //console.log(tab.rows);
    // the first headline of the table#0d4660 DFDFDF
    if (lines > 0) {
        tab_text = tab_text + '<tr>' + tab.rows[0].innerHTML + '</tr>'+'<tr>' + tab.rows[1].innerHTML + '</tr>';
    }

    // table data lines, loop starting from 1
    for (j = 2 ; j < lines; j++) {     
        tab_text = tab_text + "<tr>" + tab.rows[j].innerHTML + "</tr>";
    }

    tab_text = tab_text + "</table>";
    tab_text = tab_text.replace(/<a[^>]*>|<\/a>/g, "");             //remove if u want links in your table
    tab_text = tab_text.replace(/<img[^>]*>/gi,"");                 // remove if u want images in your table
    tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, "");    // reomves input params
    // console.log(tab_text); // aktivate so see the result (press F12 in browser)

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

     // if Internet Explorer
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa = txtArea1.document.execCommand("SaveAs", true, "DataTableExport.xls");
    }  
    else 
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_html = encodeURIComponent(tab_text);//table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        var today = new Date();
		var dd = String(today.getDate()).padStart(2, '0');
		var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
		var yyyy = today.getFullYear();
		/*today = mm + '/' + dd + '/' + yyyy;*/
		today = yyyy + '/' + mm + '/' + dd;
		/*var next_year = <?=$last_datee?>*/

        //setting the file name
        a.download = 'Administrative_Time_Report_' + today  + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
        /**********************************************/
    return (sa);
} 
</script>
<script>
$(document).on('click', "#all_attendance", function(){
   /* $('#attendance_reportt').removeClass('hide').addClass('show');
    $('#attendance_report').removeClass('show').addClass('hide');*/
    $('#attendance_reportt').css('display', '');
    $('#attendance_report').css('display', 'none');

    $('#all_attendance_hide').removeClass('hide').addClass('show');
    $('#all_attendance').removeClass('show').addClass('hide');
});

$(document).on('click', "#all_attendance_hide", function(){

   /* $('#attendance_reportt').removeClass('show').addClass('hide');
    $('#attendance_report').removeClass('hide').addClass('show'); */
    $('#attendance_reportt').css('display', 'none');
    $('#attendance_report').css('display', '');

    $('#all_attendance').removeClass('hide').addClass('show');
    $('#all_attendance_hide').removeClass('show').addClass('hide');
    
});

$(document).on('change','.filter_ajax',function(){
    var start_date = $("input[name=BeginDate]").val();
    var end_date = $("input[name=EndDate]").val();
    if(start_date != '' && end_date != '')
    {
        start_date = formatDate(start_date);
        end_date = formatDate(end_date);
        if(end_date < start_date)
        {
            console.log(start_date+" "+end_date);
            $('#valid_date').html('<label class="control-label" style="color:red;">To date should be greater than or equal to From date </label>');
        }
        else
        {
            $('#valid_date').html('');
            filter_progress_loader();
        }
    }
    else
    {
        $('#result').html('');    
    }
})  

function formatDate(date) {
     var d = new Date(date),
         month = '' + (d.getMonth() + 1),
         day = '' + d.getDate(),
         year = d.getFullYear();

     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [year, month, day].join('-');
 }
function form_submit_data()
{
    var formname='';
    formname=$("#filter");
    var formData = new FormData($('#filter')[0]);
    formData.append("submit","filter");
    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
    $.ajax({
        type:"POST",
        dataType:'html',
        url:'<?= base_url() ?>admin/Reports/filterAdminTimeReport',
        data: formData,
    	processData: false,
    	contentType: false,
        success: function(response){
            $('#result').html(response);    
        }
    });
 }
 
$(document).on('click','.day',function(e){
    e.stopPropagation();  
})
</script>