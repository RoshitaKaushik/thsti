<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<?php
    $finane=getfinancialyear_june(date("d-m-Y"));
    $finanyre=explode("-",$finane);
    $first_datee = $finanyre[0];
    $last_datee =$finanyre[1];
    
    
    $add_permission = $edit_permission = $excel_permission = $print_permission =  false;
    if(in_array(13, session()->get('profiles')??[])){
        $permissions = getPermissionDetails('13','45','35');
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
                $print_permission = true;
            }
        } 
        
    }

    if(session()->get('role') == 1){
    	$add_permission = $edit_permission = $excel_permission = $print_permission = true;
    }
    
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

#start_date {
    position: relative;
    color: white;
}
#start_date:before {
    position: absolute;
    content: attr(data-date);
    display: inline-block;
    color: rgba(0,0,0,0.6);
}

#start_date::-webkit-datetime-edit, #start_date::-webkit-inner-spin-button, #start_date::-webkit-clear-button {
    display: none;
}

#start_date::-webkit-calendar-picker-indicator {
    position: absolute;
    top: 3px;
    right: 0;
    color: rgba(0,0,0,0.6);
    opacity: 1;
}

#end_date1 {
    position: relative;
    color: white;
}
#end_date1:before {
    position: absolute;
    /* top: 3px; left: 3px;*/
    content: attr(data-date);
    display: inline-block;
    color: rgba(0,0,0,0.6);
}
#end_date1::-webkit-datetime-edit, #start_date::-webkit-inner-spin-button, #start_date::-webkit-clear-button {
    display: none;
}
#end_date1::-webkit-calendar-picker-indicator {
    position: absolute;
    top: 3px;
    right: 0;
    color: rgba(0,0,0,0.6);
    opacity: 1;
}
.custum_buttom{
    margin-top:0px;
}
@media screen and (max-width: 850px) {
    #sub_part{ 
        display:none;
    }
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
                            <h3 class="panel-title">Admin Monthly Journal Report  <span id="sub_part" style="position: absolute;left: 22%;"> </span>  
                                <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>            
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body" style="padding-left: 0px; padding-right: 0px;">
                            
                            
                            
                            
                            
                            
                            
                             <div class="col-md-12">
    					        <div class="row">
                                    <div class="col-md-2">
                                        
                                        <div class="filter-sub-menu-outer-box" style="display:inline">
                                             <?php 
                                            $attr = array("name" => "filter", "id" => "filter");
                                            echo form_open_multipart('admin/Reports/dynamicreport', $attr); 
                                            ?>
                                            <div class="stop-noti-box" >
                                                <li class="dropdown hidden-xs filter-li">
                                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-filter"></i>Filter <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-lg filter_ul">
                                                        <li class="text-center notifi-title">Filter</li>
                                                        <li class="list-group">
                                                            <div class="col-sm-12 filter_category">   
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="" class="control-label">From <span class="requiresval">*</span></label>
                                                                        <input class="form-control datepickerbackward required  requiredfile2 requiredfield filter_ajax" id="BeginDateforms" placeholder="Begin Date" name="BeginDate" type="text"  value="<?= $begin_date ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="" class="control-label">To <span class="requiresval">*</span></label>
                                                                        <input class="form-control datepickerbackward required requiredfile2 requiredfield filter_ajax" id="EndDateforms" placeholder="End Date" name="EndDate" type="text" value="<?= $end_date ?>">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="" class="control-label">Select User </label>
                                                                        <select id="User_option" name="User_option" class=" form-control filter_ajax">
                                                                            <option value="" <?php if($User_option==""){ echo "selected"; }?> >ALL</option>
                                                                            <?php foreach ($facultystaff as  $staff) { ?>
                                                                            <option value="<?php echo $staff['ID'] ?>" <?php if($User_option==$staff['ID']){ echo "selected"; }?> >
                                                                            <?php echo $staff['FirstName']." ".$staff['LastName']."(".$staff['ID'].")"; ?></option>   
                                                                            <?php } ?>  
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="" class="control-label">Select Team <span class="requiresval"></span></label>
                                                                        <select id="team_option" name="Team_option" class=" form-control filter_ajax">
                                                                             <option value="" <?php if($Team_option==""){ echo "selected"; }?> >ALL</option>
                                                                            <?php foreach ($team_name as  $team_name) { ?>
                                                                             <option value="<?php echo $team_name['id'] ?>" <?php if($Team_option==$team_name['id']){ echo "selected"; }?> >
                                                                                <?php echo $team_name['team_Name']." (".$team_name['id'].")"; ?></option>   
                                                                            <?php } ?>  
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="" class="control-label">Category</label>
                                                                        <select class="form-control myselect filter_ajax" name="category_id">
                                                                            <option value="" id="category_result">--Please Select --</option>
                                                                            <?php
                                                                            foreach($categorys as $cat){
                                                                                $sec = "";
                                                                                if($cat['id'] == $selected_cat){
                                                                                    $sec = "selected";
                                                                                }
                                                                                ?>
                                                                                <option <?= $sec ?> value="<?= $cat['id'] ?>"><?= $cat['catagory_name'] ?></option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="" class="control-label">1099</label>
                                                                        <select class="form-control filter_ajax" name="contract_1099">
                                    									     <option value="" >--Please Select --</option>
                                    									     <option value="Yes" <?php if($selected_1099 == 'Yes'){ echo 'selected'; } ?>>Yes</option>
                                    									     <option value="No" <?php if($selected_1099 == 'No'){ echo 'selected'; } ?>>No</option>
                                    									 </select>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div> 
                                                            
                                                            <div class="col-md-12 text-right">  
                                                                <hr>
                                                                <span class="btn btn-success btn-xs filter_button" style="margin-bottom:10px;">Filter</span>
                                                            </div>
                                                            
                                                        </li>
                                                    </ul>
                                                </li>
                                            </div>
                                            <li class="cell_spacing_li">
                                                <a href="#" data-target="#" title="Line Spacing" class="dropdown-toggle waves-effect waves-light spacing-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
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
    					            
    					            <div class="col-md-3" style="display:inline">
    					                <div class="row">
    					                    <div class="col-md-5">
    					                        <?php if($excel_permission){?>
    					                        <form action="<?= base_url() ?>admin/Reports/export_excel_adminmonthlyJournalReport" method="post">
                                                    <input type="hidden" class="selected_BeginDate" name="BeginDate" value="<?= $begin_date ?>">
                                                    <input type="hidden" class="selected_EndDate" name="EndDate" value="<?= $end_date ?>">
                                                    <input type="hidden" class="selected_category_id" name="category_id" value="<?= $selected_cat ?>">
                                                    <input type="hidden" class="selected_Team_option" name="Team_option" value="<?= $Team_option ?>">
                                                    <input type="hidden" class="selected_User_option" name="User_option" value="<?= $User_option ?>">
                                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                    <input type="hidden" class="selected_contract_1099" name="contract_1099" value="<?= $selected_1099 ?>">
                                                    <input type="submit" value="Export Excel" class="btn btn-primary btn-xs custum_buttom">
                                                </form>
                                                <?php } ?>
    					                    </div>
    					                    <div class="col-md-5">
    					                        <?php if($print_permission){?>
    					                        <form target="_blank" action="<?= base_url() ?>admin/Reports/export_pdf_adminmothlyjournalreport" method="post">
                                                    <input type="hidden" class="selected_BeginDate" name="BeginDate" value="<?= $begin_date ?>">
                                                    <input type="hidden" class="selected_EndDate" name="EndDate" value="<?= $end_date ?>">
                                                    <input type="hidden" class="selected_category_id" name="category_id" value="<?= $selected_cat ?>">
                                                    <input type="hidden" class="selected_Team_option" name="Team_option" value="<?= $Team_option ?>">
                                                    <input type="hidden" class="selected_User_option" name="User_option" value="<?= $User_option ?>">
                                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                    <input type="hidden" class="selected_contract_1099" name="contract_1099" value="<?= $selected_1099 ?>">
                                                    <input type="submit" value="Export PDF" class="btn btn-primary btn-xs custum_buttom">
                                                </form>    
                                                <?php } ?>
    					                    </div>
    					                </div>
                                        
                                    </div>
                                    
    					        </div>
    					    </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                           
                            
                            
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;margin-bottom:15px;">
                                    	<?php 
											$attr = array("class" => "form-horizontal");
											echo form_open("admin/Reports/adminmonthlyJournalReport", $attr); 
											?>	
                                    </div>
                                    
                                    <div style="margin-top:20px;">
                                        <div class="container"style="margin-top:20px;" >
                                            <div class="col-md-12 table-responsive" id="result" style="overflow-x:scroll;">
                                            </div>
                                        </div>
                                    </div>
                            
                        </div>
                    </div>
                </div>
                
            </div> <!-- End Row -->           
        </div> <!-- container -->
     
    </div> <!-- content -->
</div> <!-- content-page -->
<!-- end coded by bajrang -->


<!-- Modal -->
<div id="xsmyModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Journal Entry</h4>
      </div>
      <div class="modal-body" style="height:300px;overflow-x:scroll;">
        <span id="result">
            
        </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>


</div>
</div>
<script >

$(document).on('click','.filter_button',function(e){
    filter_progress_loader();   
})
$(document).on('click','.day',function(e){
    e.stopPropagation(); 
})
	
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

$(document).on('change','#User_option',function(){
    var data  = $(this).val();
    var team = $("#team_option option:selected").val();
    $.ajax({
         url:'<?=base_url()?>admin/Reports/get_user_category',
         method: 'post',
         data: {emp_id: data,team2: team},
         dataType: 'html',
         success: function(response){
           $('.myselect').html(response);
         }
       });
})


$(document).on('change','#team_option',function(){
    var data  = $('#User_option option:selected').val();
    var team = $(this).val();
    $.ajax({
         url:'<?=base_url()?>admin/Reports/get_user_category',
         method: 'post',
         data: {emp_id: data,team2: team},
         dataType: 'html',
         success: function(response){
           $('.myselect').html(response);
         }
       });
})

function myFunction()
{
    var start_date = $('#start_date').val();
    var end_date  = $('#end_date1').val();
    if(start_date =='')
    {
        alert("Please Select From Date");
        return false;
    }
    else if(end_date =='')
    {
        alert("Please Select To Date");
        return false;
    }
    else
    {   
        	var BeginDate = new Date(start_date);
			var EndDate = new Date(end_date); 
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

function form_submit_data()
{
    $('.filter-li').removeClass('open');
    var formname='';
    formname=$("#filter");
    var formData = new FormData($('#filter')[0]);
    formData.append("submit","filter");
    formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
    $.ajax({
        type:"POST",
        dataType:'html',
        url:'<?= base_url() ?>admin/Reports/filter_adminMonthlyJournalReport',
        data: formData,
    	processData: false,
    	contentType: false,
        success: function(response){
            
            $('#result').html(response);
        }
    });
}


$(document).on('change','.filter_ajax',function(){
    var name = $(this).attr('name');
    name =  name.replace('[', '');
    name =  name.replace(']', '');
    var value = $(this).val();
    name = '.selected_'+name;
    $(name).val(value);
})

</script>
