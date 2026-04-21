<?php
 $finane=getfinancialyear_june(date("d-m-Y"));
		 $finanyre=explode("-",$finane);
		 
		 $first_datee = $finanyre[0];
		 $last_datee =$finanyre[1];

 //echo "<pre>";print_r($data);die; 

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
                            <h3 class="panel-title">Team Allocation Report <span style="position: absolute;left: 46%;"> <?php echo $_SESSION['admin_fullname'];?></span> 
                                <button style="margin-top: -29px; right: 144px;padding: 3.7px 16px !important;" onclick="fnExcelReport('attendance_report')" class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="classListing"><span><i class="fa fa-file-excel-o"></i> Excel</span>
                                </button>
                                 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>            
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body" style="padding-left: 0px; padding-right: 0px;">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-12" >
                                    	<?php 
											$attr = array("class" => "form-horizontal");
											echo form_open("admin/Reports/TeamReport", $attr); 
											?>
                                        <div class="col-md-12">
											<div class="col-sm-3">									
											<div class="form-group">
											<label for="" class="control-label col-sm-3">From <span class="requiresval">*</span></label>
											<div class="col-sm-1"> :
											</div>
											<div class="col-sm-8">
											<div class="input-group date" data-provide="datepicker">
											<input class="form-control datepickerbackward required  requiredfile2 requiredfield" id="BeginDateforms" placeholder="Begin Date" name="BeginDate" type="text" value="<?php if(isset($BeginDate)){ echo $BeginDate; }?>">
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
											<input class="form-control datepickerbackward required requiredfile2 requiredfield" id="EndDateforms" placeholder="End Date" name="EndDate" type="text" value="<?php if(isset($EndDate)){ echo $EndDate; }?>">
											<div class="input-group-addon">
											<span class="glyphicon glyphicon-th"></span>
											</div>
											</div>
											</div>
											</div>
											</div>	
                                            <div class="col-md-1"><button class="btn btn-success waves-effect waves-light m-b-5 m-l-5" onclick="return Date_Valid();">Filter</button>
                                            </div>
                                        </div>
                                        
                                       
                                        <?php echo form_close(); ?>
                                    </div>
                                <div class="col-md-12 table-responsive">
                                    <table id="attendance_report" class="table dataTable table-striped table-bordered " style="font-size: 12px;">
                                        <thead>
                                            <tr class="hide">
                                                <th colspan="<?=$catcount+3?>">
                                                    
                                                </th>
                                            </tr>
                                            <tr class="hide">
                                                <th colspan="<?=$catcount+3?>">
                                                    <b>Future Generations University Timesheet</b>
                                                </th>
                                            </tr>
                                            <tr class="hide">
                                                <th colspan="<?=$catcount+3?>">
                                                    <b>Team Report</b>
                                                </th>
                                            </tr>
                                            <tr class="hide">
                                                <th colspan="<?=$catcount+3?>">
                                                    <b><?php if(isset($BeginDate)){ echo $BeginDate; }?> To <?php if(isset($EndDate)){ echo $EndDate; }?></b>
                                                </th>
                                            </tr>
                                            <tr class="hide">
                                                <th colspan="<?=$catcount+3?>">
                                                    
                                                </th>
                                            </tr>
                                            <tr>
                                                <th></th>
    											<?php foreach ($records_category as $key => $value) { ?>
    											<th><?=$value['catagory_name']?></th>
    										<?php  } ?>
                                                <th style="font-weight: bold;">Total Hrs</th>
                                                <th>Total Days</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	 <?php  foreach ($records_category as  $variable) {    
                                                         ${'sumofcatid_'.$variable['id']}=array();   
                                                    };
                                            
                                              $grandsum=array();$sum_array=array();
                                               foreach ($uni_empid as $valueee) { 
                                                 ?>
                                            <tr>
                                                <td style="text-align: left; "><?=$valueee['FirstName'].' '.$valueee['LastName'] ?>
                                                	
                                                </td>
    											<?php foreach ($records_category as $key => $value) { ?>

                                                <td> <?php  foreach ($records as $key => $valuee) { 

    														if($valuee['empid'] == $valueee['empid']  && $valuee['category_id']== $value['id'] ){  
                                                              echo $hr_min=hourdecFormating($valuee['t_hours'],$valuee['t_minutes']) ;
                                                              } } ?>
                                                </td>
    											<?php } ?>

                                                <td style=" font-weight: bold;">
                                                  
                                                    <?php foreach ($records_sum_emp_hr as  $sumemphr) {
                                                        if($sumemphr['empid']==$valueee['empid'])
                                                        {
                                                             echo $tot_hr=hourdecFormating($sumemphr['t_hours'],$sumemphr['t_minutes']) ;
                                                             $sum_array[]=$tot_hr;
                                                             
                                                        }
                                                    } ?>
                                                </td>
                                                <td style=" font-weight: bold;">
                                                	<?php echo calc_hrtodays($tot_hr); ?><!-- <?=number_format((float)$tot_hr/8, 2, '.', '');?> -->
                                                </td>
                                            </tr>
                                            <?php } ?>
                                           <tr style=" font-weight: bold;">
                                               <td>TOTAL : </td>
                                               <?php foreach ($records_category as  $tot_sum) { ?>
                                               <td>

                                               	<!-- <?php $tot_cat=number_format((float)array_sum(${'sumofcatid_'.$tot_sum['id']}), 2, '.', ''); echo Hr_min_sum($tot_cat); ?> -->
                                                <?php foreach ($records_sum_cat_hr as  ${'cat_hr_'.$tot_sum['id']}) {
                                                   if(${'cat_hr_'.$tot_sum['id']}['category_id'] == $tot_sum['id']){
                                                     ;
                                                    echo hourdecFormating(${'cat_hr_'.$tot_sum['id']}['t_hours'],${'cat_hr_'.$tot_sum['id']}['t_minutes']);
                                                }
                                                   
                                                } ?>

                                               </td>
                                           		<?php } ?>										
                                               <td><?php print_r(number_format((float)array_sum($sum_array), 2, '.', '')); ?>
                                               <!--  <?php 
                                                                                              echo $grandsumhr=hourdecFormating(@$records_sum['t_hours'],@$records_sum['t_minutes']);  ?> -->
                                               
                                           	</td>
                                           <td>
                                           	<?=calc_hrtodays(array_sum($sum_array));?><!-- <?=number_format((float)$grandsumhr/8, 2, '.', '');?> -->
                                           </td>
                                           </tr>
                                        </tbody>
                                    </table>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
               <!--  Team report starts from here -->  
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <h3 class="panel-title">Employee Report </h3>
                        </div>
                        <div class="panel-body" style="padding-left: 0px; padding-right: 0px;">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-12 table-responsive">
                                    <table id="attendance_report" class="table dataTable table-striped table-bordered " style="font-size: 12px;">
                                        <thead>
                                            <tr>
                                                <th>Emplyee</th>
                                               
                                                <th>Contract</th>
                                                <th>Total Hour Worked</th>
                                                <th>Total Days Worked</th>
                                                <th>Total Hour</th>
                                                <th>Total Days</th>
                                                <th>Hour Left</th>
                                                <th>Days Left</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php   foreach($contractors as $contract){
                                             if(in_array($contract['empid'],$team_member)){
                                         ?> 
                                        <?php                               
                                $param['hours_to_work'] = $contract['hours_to_work'];
                                $param['hours_worked'] = $contract['hours_worked'];
                                $param['minutes_worked'] = $contract['minutes_worked'];
                                $calculated_attendance = calculated_attendance($param);
                            $total_worked =  hourdecFormating($contract['hours_worked'], $contract['minutes_worked']);
                                ?>   
                                            <tr>
                                               <td><?=$contract['empname']?></td> 
                                               <td><?=convertDateString($contract['contract_begin_date'])?> to <?=convertDateString($contract['contract_end_date'])?>
                                                   
                                               </td> 
                                               <td><?php echo hourmintodecFormating($calculated_attendance['total_worked_hours']) ; ?>
                                               </td>  
                                               <td>     
                                                <?=@calc_days(@$calculated_attendance['total_worked_hours']) ?>
                                               </td> 
                                               <td><?=$param['hours_to_work']?></td>
                                               <td><?=number_format((float)$param['hours_to_work']/8, 2, '.', '');?></td> 
                                               <td>
                                                <?php  echo ($param['hours_to_work']- $total_worked); ?>
                                                </td>  
                                                <td>
                                               <?=@calc_hrtodays(@$param['hours_to_work']- $total_worked) ?>
                                                </td> 
                                            </tr>
                                        <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  Team report Ends  here --> 
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
    var tab_text = '<table border="1px" style="font-size:16px" ">';
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
        a.download = 'admin_time_report_' + today  + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
        /**********************************************/
    return (sa);
} 
</script>