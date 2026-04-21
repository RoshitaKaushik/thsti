<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<?php
 $finane=getfinancialyear_june(date("d-m-Y"));
		 $finanyre=explode("-",$finane);
		 $first_datee = $finanyre[0];
		 $last_datee =$finanyre[1];
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
   /* top: 3px; left: 3px;*/
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
            <div class="row">
                <div class="col-sm-12" style="left: 38%;">
                    <h4 class="pull-left page-title">Future Generations University Timesheet</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
						<?php
							//GetDate = strtotime($_SESSION['admin_login_date_time']);
							//$getDate = date(M Y,$GetDate );
						?>
                            <h3   class="panel-title">Monthly Journal Report  <span id="sub_part" style="position: absolute;left: 22%;"> </span> 
                                <!--<button style="margin-top: -29px; right: 144px;padding: 3.7px 16px !important;" onclick="fnExcelReport('attendance_report')" class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="classListing"><span><i class="fa fa-file-excel-o"></i> Excel</span>
                                </button>-->
                                 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>            
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body" style="padding-left: 0px; padding-right: 0px;">
                            
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;">
                                    
                                    	<?php 
											$attr = array("class" => "form-horizontal");
											echo form_open("admin/Reports/teamMonthlyJournlReport", $attr); 
											?>
											
											<div class="col-md-12">
    											<div class="col-sm-3">									
    											<div class="form-group">
    											<label for="" class="control-label col-sm-3">From <span class="requiresval">*</span></label>
    											<div class="col-sm-1"> :
    											</div>
    											<div class="col-sm-8">
    											<div class="input-group date" data-provide="datepicker">
    											<input class="form-control datepickerbackward required  requiredfile2 requiredfield" id="BeginDateforms" placeholder="Begin Date" name="BeginDate" type="text"  value="<?= $begin_date ?>">
    											<div class="input-group-addon">
    											<span class="glyphicon glyphicon-th"></span>
    											</div>
    											</div>
    											</div>
    											</div>
    											</div>
    											<div class="col-sm-3">									
    											<div class="form-group">
    											<label for="" class="control-label col-sm-3">To <span class="requiresval">*</span></label>
    											<div class="col-sm-1"> :
    											</div>
    											<div class="col-sm-8">
    											<div class="input-group date" data-provide="datepicker">
    											<input class="form-control datepickerbackward required requiredfile2 requiredfield" id="EndDateforms" placeholder="End Date" name="EndDate" type="text" value="<?= $end_date ?>">
    											<div class="input-group-addon">
    											<span class="glyphicon glyphicon-th"></span>
    											</div>
    											</div>
    											</div>
    											</div>
    											</div>	
    											
    											<div class="col-sm-3">                      
                                                <div class="form-group">
                                                <label for="" class="control-label col-sm-4">Select User </label>
                                                <div class="col-sm-1"> :
                                                </div>
                                                <div class="col-sm-7">
                                               <select id="User_option" name="User_option" class=" form-control">
                                                     <option value="" <?php if($User_option==""){ echo "selected"; }?> >ALL</option>
                                                        <?php foreach ($facultystaff as  $staff) { ?>
                                                         <option value="<?php echo $staff['ID'] ?>" <?php if($User_option==$staff['ID']){ echo "selected"; }?> >
                                                            <?php echo $staff['FirstName']." ".$staff['LastName']."(".$staff['ID'].")"; ?></option>   
                                                        <?php } ?>  
                                                </select>
                                                </div>
                                                </div>
                                                </div> 
    											
                                                <div class="col-sm-3">                                  
                                                <div class="form-group">
                                                <label for="" class="control-label col-sm-4">Select Team <span class="requiresval"></span></label>
                                                <div class="col-sm-1"> :
                                                </div>
                                                <div class="col-sm-7">
                                               <select id="team_option" name="Team_option" class=" form-control">
    
                                                         <option value="" <?php if($Team_option==""){ echo "selected"; }?> >ALL</option>
                                                        <?php foreach ($team_name as  $team_name) { ?>
                                                         <option value="<?php echo $team_name['id'] ?>" <?php if($Team_option==$team_name['id']){ echo "selected"; }?> >
                                                            <?php echo $team_name['team_Name']." (".$team_name['id'].")"; ?></option>   
                                                        <?php } ?>  
                                                          
                                                        
                                                </select>
                                                </div>
                                                </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="col-sm-3">									
    											<div class="form-group">
    											<label for="" class="control-label col-sm-3">Category</label>
    											<div class="col-sm-1"> :
    											</div>
    											<div class="col-sm-8">
    											
    											<select class="form-control myselect" name="category_id">
        											     <option value="" id="category_result">--Please Select --</option>
        											     <?php
        											       foreach($categorys as $cat)
        											       {
        											           $sec = "";
        											           if($cat['id'] == $selected_cat)
        											           {
        											               $sec = "selected";
        											           }
        											           ?>
        											           <option <?= $sec ?> value="<?= $cat['id'] ?>"><?= $cat['catagory_name'] ?></option>
        											           <?php
        											       }
        											     ?>
        											 </select>
    											</div>
    											</div>
    											</div>
                                                
                                                
    
                                                
                                                <div class="col-md-1">
                                                    <button class="btn btn-success btn-xs waves-effect waves-light m-b-5 m-l-5" onclick="return Date_Valid();">Filter</button>
                                                     <?php echo form_close(); ?>
                                                </div>
                                                
                                                <div class="col-md-6"></div>                                        
                                                        
                                                 <div class="col-md-1">
                                                    <form action="<?= base_url() ?>admin/Reports/export_excel_teammonthlyJournalReport" method="post">
                                                        <input type="hidden" name="BeginDate" value="<?= $begin_date ?>">
                                                        <input type="hidden" name="EndDate" value="<?= $end_date ?>">
                                                        <input type="hidden" name="category_id" value="<?= $selected_cat ?>">
                                                        <input type="hidden" name="Team_option" value="<?= $Team_option ?>">
                                                        <input type="hidden" name="User_option" value="<?= $User_option ?>">
                                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                        <input type="submit" value="Export Excel" class="btn btn-primary btn-xs">
                                                    </form>
                                                </div>
                                                
                                                 <div class="col-md-1">
                                                    <form target="_blank" action="<?= base_url() ?>admin/Reports/export_pdf_teammothlyjournalreport" method="post">
                                                        <input type="hidden" name="BeginDate" value="<?= $begin_date ?>">
                                                        <input type="hidden" name="EndDate" value="<?= $end_date ?>">
                                                        <input type="hidden" name="category_id" value="<?= $selected_cat ?>">
                                                        <input type="hidden" name="Team_option" value="<?= $Team_option ?>">
                                                        <input type="hidden" name="User_option" value="<?= $User_option ?>">
                                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                                        
                                                        <input type="submit" value="Export PDF" class="btn btn-primary btn-xs">
                                                    </form>
                                                </div>
                                                
                                                
                                            </div>
											
											
											
											
                                        
                                        
                                       
                                       
                                        
                                    </div>
                                    <div style="margin-top:20px;">
                                        <div class="container">
                                            
                                           
                                            
                                        <div class="col-md-12 table-responsive" style="overflow-x:scroll;">
                                        
                                         <table id="alldataTable2" class="table table-striped table-bordered  " style="font-size: 12px;">
                                             <thead>
                                             <tr>
                                                 
                                                 <th>Employee Name</th>
                                                 <th>Date</th>
                                                 <th>Category</th>
                                                 <th>Hours Worked</th>
                                                 <th>Hourly Rate</th>
                                                 <th>Journal Entry</th>
                                                
                                           </tr>
                                           </thead>
                                           <tbody>
                                               
                                          <?php
                                            $sn=1;
                                            $cat = '';
                                            $total_hour = 0;
                                            $grand_total = 0;
                                            $t_h_rate = 0;
                                            $grand_sum =0;
                                            $em_id = '';
                                            $check_zero = false;
                                            $curr_tot_hr = 0;
                                            $grand_tot_hr = 0;
                                            foreach($records as $rec)
                                            {     
                                              if(in_array($rec['ID'],$team_member)){   
                                                if($cat == '')
                                                {
                                                    $curr_hour = 0;
                                                    
                                                    $curr_tot_hr = 0;
                                                    
                                                    $cat = $rec['cat_id'];
                                                    $t_h_rate = number_format((float)hourmintodecFormating($rec['hours']), 2, '.', ''); 
                                                    
                                                    $check_zero = false;
                                                }
                                                if($em_id == '')
                                                {
                                                    $curr_hour = 0;
                                                    $curr_tot_hr = 0;
                                                    $em_id = $rec['ID']; 
                                                    
                                                    $check_zero = false;
                                                }
                                                if($cat != $rec['cat_id'] || $em_id != $rec['ID'])
                                                {
                                                    
                                                    $totol_hours1 = get_category_total_emp($em_id,$cat,$begin_date,$end_date);
                                                    $em_id = $rec['ID'];
                                                    ?>
                                                      <tr>
                                                        <td colspan="3" style="font-weight:bold;text-align:right;">Total</td>  
                                                        <td style="font-weight:bold"><?php
                                                        $grand_tot_hr = $grand_tot_hr+number_format((float)($curr_tot_hr), 2, '.', '');
                                                              echo $current_total =  number_format((float)($curr_tot_hr), 2, '.', '') ;
                                                            ?>
                                                        </td>  
                                                        <td  style="font-weight:bold;text-align:left;" colspan="4">
                                                            <?php
                                                                $grand_sum = $grand_sum+number_format((float)($t_h_rate*$current_total), 2, '.', '');
                                                                //echo number_format((float)($t_h_rate*$current_total), 2, '.', '');
                                                             //echo number_format((float)($curr_hour), 2, '.', '');
                                                              if($check_zero)
                                                               {
                                                                   echo "<span style='color:red;'>Partial Cost : ".number_format((float)($curr_hour), 2, '.', '')."&nbsp;(Daily hour rates missing for selected dates)</span>";
                                                               }
                                                               else
                                                               {
                                                                   echo "Total Cost : ".number_format((float)($curr_hour), 2, '.', '');
                                                               }
                                                               $grand_total = $grand_total+number_format((float)($curr_hour), 2, '.', '');
                                                            ?>
                                                        </td>
                                                        
                                                      </tr>
                                                    <?php
                                                    $cat = $rec['cat_id'];
                                                    $t_h_rate = number_format((float)$rec['daily_rate'], 2, '.', '');
                                                    
                                                    $curr_hour = 0;
                                                    $curr_tot_hr = 0;
                                                    $check_zero = false;
                                                 }
                                                ?>
                                                <tr><?php
                                                         echo "<td>".$rec['FirstName']." ".$rec['LastName']."</td>";      
                                                         $ttt = str_replace("00:00:00","",$rec['transaction_date']);
                                                         echo "<td>".date('m/d/Y',strtotime($ttt))."</td>";
                                                        ?>
                                                  <td><?= $rec['catagory_name'] ?></td>
                                                  
                                                  <td><?php 
                                                    $curr_tot_hr = $curr_tot_hr+hourmintodecFormating($rec['hours']);
                                                    
                                                    echo hourmintodecFormating($rec['hours']);
                                                    ?></td>
                                                  <td><?php $curr_hour = $curr_hour+(number_format((float)$rec['daily_rate'], 2, '.', '') * hourmintodecFormating($rec['hours']) );  ?>
                                                      <?=  number_format((float)$rec['daily_rate'], 2, '.', '') ?>
                                                       <?php // number_format(floor($rec['daily_rate']*100)/100, 2) ?>
                                                      <?php
                                                       if(!$check_zero)
                                                       {
                                                         if(number_format((float)$rec['daily_rate'], 2, '.', '') == '0.00')
                                                         {
                                                            $check_zero = true; 
                                                         }
                                                       }
                                                      ?>
                                                  </td>
                                                  <td style="text-align:left;"><?= $rec['journal'] ?></td>
                                                 </tr>
                                                <?php
                                                $last_emp = $rec['ID'];
                                                $tt = number_format((float)($rec['daily_rate'] * hourmintodecFormating($rec['hours'])), 2, '.', '');
                                                 //$grand_total = $grand_total+$tt;
                                               }
                                             }
                                             if(isset($last_emp) != '')
                                             {
                                              $totol_hours1 = get_category_total_emp($last_emp,$cat,$begin_date,$end_date);        
                                             ?>
                                               <tr>
                                                  <td colspan="3" style="font-weight:bold;text-align:right;">Total</td>
                                                  <td style="font-weight:bold;">
                                                    <?php
                                                    $grand_tot_hr = $grand_tot_hr+number_format((float)($curr_tot_hr), 2, '.', '');
                                                       echo $current_total =  number_format((float)($curr_tot_hr), 2, '.', '');
                                                       //hourdecFormating($totol_hours1[0]['t_hours'],$totol_hours1[0]['t_minutes']) ;
                                                    ?>
                                                  </td>
                                                  <td style="font-weight:bold;text-align:left;" colspan="2">
                                                      
                                                      <?php
                                                      
                                                      
                                                      $grand_sum = $grand_sum+number_format((float)($t_h_rate*$current_total), 2, '.', '');
                                                       
                                                       
                                                       $grand_total = $grand_total+number_format((float)($curr_hour), 2, '.', '');
                                                       if($check_zero)
                                                       {
                                                           echo "<span style='color:red;'>Partial Cost : ".number_format((float)($curr_hour), 2, '.', '')."&nbsp;(Daily hour rates missing for selected dates)</span>";
                                                       }
                                                       else
                                                       {
                                                           echo "Total Cost : ".number_format((float)($curr_hour), 2, '.', '');
                                                           
                                                       }
                                                       
                                                      ?>
                                                  </td>
                                                  
                                              </tr>
                                           </tbody>
                                           <?php
                                           
                                             }
                                             ?>
                                           <tfoot>
                                               <th colspan="3" style="text-align:right;"> Grand Total</th>
                                               <th ><?php echo number_format((float)($grand_tot_hr), 2, '.', ''); ?></th>
                                               <th colspan="2" style="text-align:left;">Grand Total Cost : <?= number_format((float)($grand_total), 2, '.', '')   ?></th>
                                           </tfoot>
                                        </table>
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



</script>
