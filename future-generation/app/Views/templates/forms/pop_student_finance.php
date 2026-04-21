<?php 
error_reporting(0);
$access = getAccess(15); //20 for student finance form

$attr = array('class' => 'cmxform form-horizontal tasi-form research','id'=>'scholarship_form');
//echo"<pre>";print_r ($student);
$show_registrar = false;
if(in_array(1, $this->session->userdata('profiles')) || in_array(3, $this->session->userdata('profiles'))){
		$show_registrar = true;
	}
?>

<style>
 
#student_finance_filter
{
    display:none;
}
.modal-body.Add_ScholarShip table.table {
   border: 0!important;
}
.modal-body.Add_ScholarShip table.table tr th, .modal-body.Add_ScholarShip table.table tr td {
   padding: 5px;
   border: 1px solid #d8d8d8;
}
.modal-body.Add_ScholarShip table.table tr th {
   background: #0c2e5f;
   color: #f3f3f3;
   font-size: 14px;
   font-weight: 500;
}
.modal-body.Add_ScholarShip table.table tr:nth-child(even) {
   background-color: #f2f2f2;
}



#student_finance_length
{
    display:none;
}

table#student_finance tfoot.grand_total {
    background-color: #317eeb!important;
}
table#student_finance tfoot.grand_total tr th {
    color: #fff;
}
table#student_finance tr.cal_yearly {
    background-color: #dcdcdc!important;
}
table#student_finance tr.cal_yearly th {
    color: #383838;
}
/*table#student_finance tbody tr:nth-of-type(3n+1) {
    background-color: #f5f5f5!important;

}*/

.modalpopupsss{display:none;}



table.table.table-striped.table-bordered th, table.table.table-striped.table-bordered td,   table.table.table-striped.table-bordered td .form-control {
    font-size: 12px;
}
input#program_start11, input#program_end11, #special_start11, input#special_end11 {
   
    display: inline-block;
}

.special_start-end-box span {
    display: inline-block!important;
    width: 48%;
    box-sizing: border-box;
    border-right: 1px solid #ddd;
	padding: 7px 4px;
}
.waves-effect { min-width: 75px;}
.special_start-end-box span:nth-child(2) {
    border-right: none;
}
.special_start-end-box {
    padding: 0!important;
}
.special_start-end-box1 {
    padding: 7px 4px!important;
}
.table-striped>tbody>tr:nth-of-type(3n+1) {
    background-color: #eae9e9!important;
}
.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: transparent;
}

.table td.fit, 
.table th.fit {
    white-space: nowrap;
    width: 1%;
}

.required:after {
    content: ' *';
    color: red;
    font-weight: bold;
    font-size: 16px;
}
td {
    vertical-align: middle !important;
}
input.form-control {
    width: 100%;
    text-align: center;
}
.table td.fit, 
.table th.fit {
    white-space: nowrap;
    width: 1%;
}
.custom-panel {
    margin: 0 auto;
    background-color: transparent;
    border: none;
    border-radius: 2px;
    -webkit-box-shadow: none;
    box-shadow: none;
    transition: 0.3s;
    width: 100%;
    max-width: 250px;
}

.custom-panel:hover {
   -webkit-box-shadow: none;
    box-shadow: none;
}

.custom-panel-heading button {
    border: none;
}

.custom-panel-heading {
    border-bottom: none;
    width: 100%;
    color: #333;
    border-color: transparent;
    background-color: transparent;
}
.custom-panel-body {
    color: #333;
    background-color: transparent;
    padding: 1rem 0 1rem 0.5rem;
    height: 100%;
    width: 100%;
   max-width: 250px;
   overflow: hidden;
   text-overflow: ellipsis;
   
}

.custom-panel-textarea {
    border: 1px solid #eee;
    border-radius: 3px;
    padding: 0.4rem 0.2rem 0 0.2rem;
    height: 100%;
    width: 100%;
    max-width: 250px;
    resize: none;
}
.fit
{
    width:14.28% ! important;
}

#student_finance tbody tr td {
    width: 200px!important;
    white-space: normal;
}

</style>

<?php $editclass = array_reverse($editclass); ?>


<div class="row card" style="margin: 2rem 0 ; display: flex; justify-content:center;">

    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
    
    
  
    <div class="col-md-1">
        <label>Year</label>
    </div>
    <div class="col-md-2">
        <select class="form-control student_year" name="filter_year">
            <option value="">All</option>
            <?php
             foreach($editclass as $cl)
             {
                 $sec = '';
                 if($selected_filter_year == $cl['Class'])
                 {
                    $sec = "selected";    
                 }
                 ?>
                 <option <?= $sec ?> value="<?= $cl['Class'] ?>"><?= $cl['Class'] ?></option>
                 <?php
             }
            ?>
        </select>
    </div>
    
    <div class="col-md-1">
        <label>Semester</label>
    </div>
    <div class="col-md-2">
        <select class="form-control filter_semester" name="filter_semester">
            <?php
             foreach($semester_acc_class as $sm)
             {
                 $sec = '';
                 if($selected_filter_semester == $sm['Semester'])
                 {
                   $sec = "selected";    

                 }
                 ?>
                 
                  <option <?= $sec ?> value='<?= $sm['Semester'] ?>'><?= $sm['Semester'] ?></option>
                 <?php
             }
            ?>
        </select>
    </div>
    
    <div class="col-md-2">
        <label>From Date</label>
    </div>
    
    <div class="col-md-2">
        <input type="date" class="form-control payment_from" name="from_date">
    </div>
    
     <div class="col-md-2">
        <label>To Date</label>
    </div>
    
    <div class="col-md-2">
        <input type="date" class="form-control payment_to" name="to_date">
    </div>
    
    <div class="col-md-2">
        
        <input type="button" class="btn btn-success btn-xs filter_data" value="filter" >
    </div>
    
    
    
    <div class="col-md-1">
        <form method="post" action="<?= base_url() ?>admin/Form/export_excel_filter_student_finance" id="idForm" target="_blank">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <input type="hidden" class="form-control export_class" name="filter_year">
            <input type="hidden" class="form-control export_semester" name="filter_semester">
            
            <input type="hidden" class="form-control export_payment_from" name="payment_from">
            <input type="hidden" class="form-control export_payment_to" name="payment_to">
            
            <input type="hidden" class="form-control" name="student_id" value="<?= $student_id ?>">
           <input type="submit" class="btn btn-primary btn-xs" value="Export Excel" >
        </form>
    </div>
    <div class="col-md-1">
        <form method="post" action="<?= base_url() ?>admin/Form/export_pdf_filter_student_finance" target="_blank">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <input type="hidden" class="form-control export_class" name="filter_year">
            <input type="hidden" class="form-control export_semester" name="filter_semester">
            
            <input type="hidden" class="form-control export_payment_from" name="payment_from">
            <input type="hidden" class="form-control export_payment_to" name="payment_to">
            
            <input type="hidden" class="form-control" name="student_id" value="<?= $student_id ?>">
           <input type="submit" class="btn btn-primary btn-xs" value="Export Pdf" >
        </form>
    </div>
    
    
   
    
</div>




<!--table id="student_finance" class="table table-striped table-bordered alldataTable"-->
<table id="student_finance" class="table table-striped table-bordered alldataTable">
	<thead>
		<tr>
		    <!--<th></th>-->
			<th class="fit">Year</th>
			<th class="fit">Semester</th>
            <th class="fit">Course ID</th>
			<th class="fit">Course/Cert Title</th>
			<th class="fit">Status</th>
			<th class="fit fit_width">Tuition</th>              
			<th class="fit fit_width">Scholarship</th>              
			<th class="fit">Student Cost</th>              
			<!--th class="fit">Notes</th-->
			
			<th>Action</th>
			
		</tr>
	</thead>

    <tbody id="result">
        <?php
        
        $sno=1;
        $table_year="";
        $table_semester  = "";
        $group_tution = 0.00;
        $group_scholar = 0.00;
        $group_student_cost = 0.00; 
        $sn=1;
       
          foreach($student_finance_course as $sf)
          {
              $credit_amount = 0;
              $sf_data = get_student_scholarship($sf['CourseID'], 'Course',$student_id); 
              
              if($sf['Grade'] == 'W')
              {
                  
                 $sf_data['total'] = ($sf_data['total'])-((($sf_data['total'])*$sf['refund_amount'])/100);
              }
              
               // 28-10-2020
                $credit_amount = get_student_credit_amount($sf['CourseID'],$student_id);
                
                
                
                $credit_amount =$credit_amount[0]['total_credit'] ;
                // 28-10-2020
                
                
                // By Prabhat 03-11-2020
                $credit_scholar = get_student_credit_scholar($sf['CourseID'],$student_id);

                
                // End Prabhat 03-11-2020
                
              if($table_year =="" && $table_semester == "")
              {
                 $table_year =  $sf['Class'];
                 $table_semester = $sf['Semester'];
              }
             
              
              if($sf['Class'] != $table_year || $table_semester != $sf['Semester'])
              {
               
                  ?>
                  <tr class="cal_yearly">
                    <th colspan="5" style="text-align:center">Total</th>
                    <th> Tuition : $<span class="tu<?= $table_year.$table_semester ?>"> <?= number_format((float)$group_tution, 2, '.', '')  ?></span></th>
                    <th class="sch<?= $table_year.$table_semester ?>">Scholarship : $<?= number_format((float)$group_scholar, 2, '.', '') ?></th>
                    <th colspan="2" class="stu<?= $table_year.$table_semester ?>">Student Cost : $<?php $st_cost = $group_tution-$group_scholar; echo number_format((float)$st_cost, 2, '.', ''); ?></th>
                   
                    <!--th></th-->
                 </tr>
                  <?php
                   $table_year =  $sf['Class'];
                   $table_semester = $sf['Semester'];
                   $group_tution = $sf['total']-$credit_amount;
                   $group_scholar = $sf_data['total']-$credit_scholar[0]['total_sch'];
                   $group_student_cost = $sf['student_cost']; 
              }
              else
              {
                 /*echo $sf['Class']."Prabhat".$table_year." ".$table_semester." ".$group_tution = $group_tution+$sf['total'];
                 
                 echo "<br>";*/
                 
                    
                 
                 
                 $group_tution = ($group_tution+$sf['total'])-$credit_amount;
                  $schol = '';
                  
                  if($sf['scholarship'] == '')
                  {
                      $schol = 0;
                  }
                  else
                  {
                      $schol = $sf['scholarship'];
                  }
                  $group_scholar = $group_scholar+($sf_data['total']-$credit_scholar[0]['total_sch']);
                  $group_student_cost = $group_student_cost+($group_tution-$group_scholar);
                  
              }
              
              ?>
              <tr>
                   
                 
              <input type="hidden" value="<?=$sf['CourseID']?>" name="course_id[]" class="type_id">
                  <td class="fit">
                      <input type="hidden" value="<?= $sf['Class'] ?>" class="form-control class" name="course_class[]">
                      <?= $sf['Class'] ?>
                  </td>
                  <td class="fit">
                      <input type="hidden" value="<?= $sf['Semester'] ?>" class="form-control semester" name="course_semester[]">
                      <?= $sf['Semester'] ?></td>
                      <td><?= $sf['Course'] ?></td>
                  <td class="fit" style="text-align:left;">
                         <input type="hidden" name="course_type[]" value="Course" class="type">
                        
                        <?= $sf['CourseTitle']?>
                  </td>
                  <td class="fit" style="text-align:left;">
                         <?php 
                         if($sf['Grade'] == 'W')
                         {
                             echo "Withdrawn ,".$sf['refund_amount']."% refund";
                         }
                         else if($sf['Grade'] == 'AUDIT' || $sf['Grade'] =='SCH')
                         {
                             echo $sf['Grade'];
                         }
                         else if($sf['Grade'] == 'I')
                         {
                             echo 'Incomplete';
                         }
                        
                         else
                         {
                             echo 'Complete';
                         }
                         
                        ?>

                  </td>
                  <td class="fit td_tution<?= $sf['CourseID'] ?>" style="text-align:left;">
                     
                     <input type="hidden" readonly name="course_tution[]" value="<?php echo (($sf['total']-$credit_amount)) ? ($sf['total']-$credit_amount) : '0.00' ?>" class="tution form-control td_tution<?= $sf['CourseID'] ?> ?>">
                      <div class="row">
                          <div class="col-md-12">
                              
                              
                              <div class="col-md-6">
                                  <b>Course <br> Tuition: <?php if($sf['Grade'] == 'W'){ echo "<br>With W"; } ?> </b>
                               </div>
                               <div class="col-md-6" style="text-align:right;">
                                 $<?php echo number_format((float)$sf['total'], 2, '.', '');  ?><br>
                                </div>
                              
                              
                          </div>
                      </div>
                      
                      <?php
                       $adjustment_detail = get_student_adjustment_detail($sf['CourseID'],$student_id);
                      
                      ?>
                      <div class="col-md-6">
                        <b> Adjustment:</b>
                      </div>
                      <div class="col-md-6" style="text-align:right;">
                     <?php
                     $cc= 0.00;
                     if(sizeof($adjustment_detail)<1)
                     {
                         echo "$"."0.00";
                     }
                     $k=1;
                       foreach($adjustment_detail as $ad)
                       {
                           echo "$".$ad['credit'];
                           
                           $cc= $cc+$ad['credit'];
                           
                           if(sizeof($adjustment_detail) != $k)
                           {
                               echo "<br>";
                           }
                            $k++  ;                         
                       }
                     ?>
                    </div>
                    <div class="col-md-12">
                        <hr style="margin:0px ! important;border-top: 2px solid #eee;">
                    </div>
                        <div class="col-md-6">
                            <b>Tuition: </b>
                        </div>
                        <div class="col-md-6" style="text-align:right;">
                           $<?= number_format((float)$sf['total']-$cc, 2, '.', '') ?>
                        </div>
                    
                     
                  </td>
                  <td class="fit" style="text-align:left;">
                     <input type="hidden" readonly name="course_scholarship[]" value="<?php echo ($sf_data['total']) ? $sf_data['total']-$credit_scholar[0]['total_sch']: '0.00'?>" class="scholarship form-control td_amount<?= $sf['CourseID'] ?>">
                     
                     
                     <div class="row"> 
                        <div class="col-md-12">
                             <div class="col-md-6">
                                <b>Assign <br> Scholorship: </b>
                            </div>
                            <div class="col-md-6" style="text-align:right;">
                                &nbsp;$<span class="td_amount<?= $sf['CourseID'] ?> td_amount<?= $sf['Class'].$sf['Semester'] ?>">
                                 <?php echo ($sf_data['total']) ? $sf_data['total']: '0.00'?>
                               </span>
                            </div>
                        </div>
                    </div>

                    
                    
                    <div class="col-md-6">
                        <b> Adjustment:</b>
                      </div>
                      <div class="col-md-6" style="text-align:right;">
                     <?php
                     $cc= 0.00;
                     if(sizeof($adjustment_detail)<1)
                     {
                         echo "$"."0.00";
                     }
                     $k=1;
                       foreach($adjustment_detail as $ad)
                       {
                           echo "$".$ad['scholor_adjustment'];
                           
                           $cc= $cc+$ad['scholor_adjustment'];
                           
                           if(sizeof($adjustment_detail) != $k)
                           {
                               echo "<br>";
                           }
                            $k++  ;                         
                       }
                     ?>
                    </div>
                    
                    
                    <div class="col-md-12">
                        <hr style="margin:0px ! important;border-top: 2px solid #eee;">
                    </div>
                    <div class="col-md-6">
                        <b>ScholarShip: </b>
                    </div>
                    <div class="col-md-6" style="text-align:right;">
                       $<?= number_format((float)$sf_data['total']-$credit_scholar[0]['total_sch'], 2, '.', '') ?>
                    </div>
                     
                     
                  </td>
                  <td class="fit">
                      <input type="hidden" readonly name="course_student_cost[]" value="<?php echo number_format((float)(($sf['total']-$credit_amount)-($sf_data['total']-$credit_scholar[0]['total_sch'])), 2, '.', '')?>" class="form-control student_cost td_student_cost<?= $sf['CourseID'] ?>">
                     $<span class="td_student_cost<?= $sf['CourseID'] ?>">
                       <?php echo number_format((float)(($sf['total']-$credit_amount)-($sf_data['total']-$credit_scholar[0]['total_sch'])), 2, '.', '') ;?>
                      </span>
                  </td>
                  
                  <td>
                      <?php
                      if($this->session->userdata('role') == 1 || $show_registrar){ 
                          
                      ?>
                      <button class="btn btn-success btn-xs scholar_edit" rel_id = "<?= $sf['CourseID'] ?>" rel_course_code = "<?= $sf['Course'] ?>" rel_course_title = "<?= $sf['CourseTitle'] ?>" rel_semester="<?= $sf['Semester'] ?>" rel_tuition="<?= $sf['total'] ?>" rel_class="<?= $sf['Class'] ?>" rel_type="course" id="edit_button<?= $sf['CourseID'] ?>">Details</button>
                      <?php } ?>
                  </td>
              </tr>
              <?php
              $sno++;
          }
          if(sizeof($student_finance_course)>0)
          {
              ?>
              <tr class="cal_yearly">
                       <!--<th><?= $sn++ ?></th>-->
                    <th colspan="5" style="text-align:center">Total</th>
                    
                     <th> tuition: $<span class="tu<?= $table_year.$table_semester ?>"> <?= number_format((float)$group_tution, 2, '.', '') ?> </span></th>
                    <th class="sch<?= $table_year.$table_semester ?>">Scholarship : $<?= number_format((float)$group_scholar, 2, '.', '')  ?></th>
                    <th colspan="2" class="stu<?= $table_year.$table_semester ?>">Student Cost : $<?php $st_cost = $group_tution-$group_scholar; echo number_format((float)$st_cost, 2, '.', ''); ?></th>
                    
                    <!--th></th-->
                 </tr>
              <?php
          }
        ?>
        <?php 
        
        $sno=1;
        $table_year="";
        $table_semester  = "";
        $group_tution = 0;
        $group_scholar = 0;
        $group_student_cost = 0; 
        $sn=1;
        foreach($student_finance_certificate as $sf) : 
        
        $sf_data = get_student_scholarship($sf['certID'], 'certificate',$student_id); 
        
              if($table_year =="" && $table_semester == "")
              {
                 $table_year =  $sf['class'];
                 $table_semester = $sf['semester'];
              }
             
              
              if($sf['class'] != $table_year || $table_semester != $sf['semester'])
              {
                  ?>
                  <tr class="cal_yearly">
                    <th colspan="5" style="text-align:center">Total</th>
                    <th> tuition : $<span class="certtu<?= $table_year.$table_semester ?>"> <?= number_format((float)$group_tution, 2, '.', '') ?> </span></th>
                    <th class="certsch<?= $table_year.$table_semester ?>">Scholarship : $<?= number_format((float)$group_scholar, 2, '.', '')  ?></th>
                    <th colspan="2" class="certstu<?= $table_year.$table_semester ?>">Student Cost : $<?php $st_cost = $group_tution-$group_scholar; echo number_format((float)$st_cost, 2, '.', ''); ?></th>
                   
                    <!--th></th-->
                 </tr>
                  <?php
                   $table_year =  $sf['class'];
                   $table_semester = $sf['semester'];
                   $group_tution = $sf['total'];
                   $group_scholar = $sf_data['total'];
                   $group_student_cost = $sf['student_cost']; 
              }
              else
              {
                 /*echo $sf['Class']."Prabhat".$table_year." ".$table_semester." ".$group_tution = $group_tution+$sf['total'];
                 
                 echo "<br>";*/
                 $group_tution = $group_tution+$sf['total'];
                  $schol = '';
                  
                  if($sf['scholarship'] == '')
                  {
                      $schol = 0;
                  }
                  else
                  {
                      $schol = $sf['scholarship'];
                  }
                  $group_scholar = $group_scholar+$sf_data['total'];
                  $group_student_cost = $group_student_cost+($group_tution-$group_scholar);
                  
                  
              }
              
              ?>
        
        
        
        <tr>
        <input type="hidden" value="<?=$sf['certID']?>" name="certificate_id[]" class="type_id">
                  <td class="fit">
                      <input type="hidden" value="<?= $sf['class'] ?>" class="form-control class" name="certificate_class[]">
                      <?= $sf['class'] ?>
                  </td>
                  <td class="fit">
                      <input type="hidden" value="<?= $sf['semester'] ?>" class="form-control semester" name="certificate_semester[]">
                      <?= $sf['semester'] ?></td>
                      <td><?= $sf['ce rt_no'] ?></td>
                  <td style="text-align:left;">
                      <?php //$sf_data = get_student_finance($sf['certID'], 'Certificate'); ?>
                        
                     
                        <input type="hidden" name="certificate_type[]" value="Certificate" class="type">
                        <?= $sf['CertName'] ?>
                     
                  </td>
                  <td></td>
                  <td class="fit">
                     <input type="hidden" readonly name="certificate_tution[]" value="<?php echo ($sf['total']) ? $sf['total'] : '0.00' ?>" class="tution form-control">
                      $<?php echo number_format((float)$sf['total'], 2, '.', '');   ?>
                  </td>
                  <td class="fit">
                     <input type="hidden" readonly name="certificate_scholarship[]" value="<?php echo ($sf_data['total']) ? $sf_data['total']: '0.00'?>" class="scholarship form-control td_cert_amount<?= $sf['certID'] ?>">
                     
                     <span class="td_cert_amount<?= $sf['certID'] ?> td_cert_amount<?= $sf['class'].$sf['semester'] ?>">
                         $<?php echo number_format((float)$sf_data['total'], 2, '.', '');?>
                     </span>
                     
                     
                  </td>
                  <td class="fit">
                      <input type="hidden" readonly name="course_student_cost[]" value="<?php echo ($sf['total']-$sf_data['total']) ? $sf['total']-$sf_data['total'] : '0.00'?>" class="form-control student_cost td_cert_student_cost<?= $sf['certID'] ?>">
                     <span class="td_cert_student_cost<?= $sf['certID'] ?>">
                       <?php echo number_format((float)($sf['total']-$sf_data['total']), 2, '.', '') ;?>
                      </span>
                  </td>
                  <td>
                       <?php
                      if($this->session->userdata('role') == 1 || $show_registrar){ 
                          
                      ?>
                      <button class="btn btn-success btn-xs scholar_edit" rel_id = "<?= $sf['certID'] ?>" rel_course_code = "<?= $sf['cert_no'] ?>" rel_course_title = "<?= $sf['CertName'] ?>" rel_semester="<?= $sf['semester'] ?>" rel_tuition="<?= $sf['total'] ?>" rel_class="<?= $sf['class'] ?>" rel_type="certificate" id="edit_button<?= $sf['certID'] ?>">Details</button>
                      <?php
                      }
                      ?>
                  </td>
              </tr>
        <?php endforeach; 
        if(sizeof($student_finance_certificate)>0)
        {
            ?>
            <tr class="cal_yearly">
                    <th colspan="5" style="text-align:center">Total</th>
                    <th> tuition : $<span class="certtu<?= $table_year.$table_semester ?>"> <?= number_format((float)$group_tution, 2, '.', '') ?> </span></th>
                    <th class="certsch<?= $table_year.$table_semester ?>">Scholarship : $<?= number_format((float)$group_scholar, 2, '.', '')  ?></th>
                    <th colspan="2" class="certstu<?= $table_year.$table_semester ?>">Student Cost : $<?php $st_cost = $group_tution-$group_scholar; echo number_format((float)$st_cost, 2, '.', ''); ?></th>
                   
                    <!--th></th-->
                 </tr>
            <?php
        }
        
        ?>
    </tbody>
    <tfoot class="grand_total">

        <th colspan="5" style="text-align:center;">Grand Total</th>
        
        <th id="total"></th>
        <th id="scholarship_total"></th>
        <th id="student_cost_total"></th>
        <th></th>
        
    </tfoot>
</table>

<script>
    $(document).ready(function(el) {
    sf_editStudentFinance();
    sf_cancelStudentFinance();
    sf_saveStudentFinance();
    let tution_total = 0, scholarship_total = 0, student_cost_total= 0;
    let tution = document.querySelectorAll('.tution');
    let scholarship = document.querySelectorAll('.scholarship');
    let student_cost = document.querySelectorAll('.student_cost');
    
    tution.forEach(function(el) {
        el = parseFloat(el.value);
        tution_total += el;
    });
    scholarship.forEach(function(el) {
        el = parseFloat(el.value);
        scholarship_total += el;
    });
    student_cost.forEach(function(el) {
        el = parseFloat(el.value);
        student_cost_total += el;
    });
    $('#total').html("Tuition : $"+tution_total.toFixed(2));
    $('#scholarship_total').html("Scholarship : $"+scholarship_total.toFixed(2));
    $('#student_cost_total').html("Student Cost : $"+student_cost_total.toFixed(2));
});

</script>


<!-- Start Payments Details -->
<?php

function date_compare($element1, $element2) {
    $datetime1 = strtotime($element1['sort_date']);
    $datetime2 = strtotime($element2['sort_date']);
    return $datetime1 - $datetime2;
} 

 if(sizeof($student_finance_course)>0)
{
?>

<h4>Payments</h4>

<!-- get all scholarship -->


<table class="table table-striped table-bordered alldataTable">
    <thead>
        <tr>
            <th>Date Received</th>
            <th>Semester</th>
            <th>Type Of Payments</th>
            <th>Tuition</th>
            <th>Adjustments</th>
            <th>Balance</th>
            
        </tr>
    </thead>
    <tbody id="payment_result">
        
        <tr>
                      <td>
                          
                      </td>
                      <td style="text-align:left;"></td>
                      <td style="text-align:left;">Carried Balance</td>
                      <td style="text-align:right;">
                         
                      </td>
                      <td style="text-align:right;">-</td>
                        
                        <td style="text-align:right;"> 0 </td>
                         
                  </tr>
        
        <?php
             $last_bal = 0;
             $first_data = '';
             $last_enrol_course='';
             
             $list_of_transaction=array();
             array_push($list_of_transaction,'');
             
             
          foreach($enrolled_class_semester as $cs)
          {
              $already_assign = '';
              //get scholar ship
              $all_sch_by_class_sem = get_all_scholarship_by_student_id($studentid,$cs['Class'],$cs['Semester']);
              $all_tuition_fee = get_total_tuition($studentid,$cs['Class'],$cs['Semester']);
              $all_tuition_fee = array_column($all_tuition_fee, 'total_tuition');
              
              $adjustment_detail = get_total_tuition_adustment($studentid,$cs['Class'],$cs['Semester']);
              $transaction = get_all_transaction_greater_last_by_student_id($studentid,$cs['Class'],$cs['Semester']);
              
              $get_link_transaction = get_class_semester_link_payment($studentid,$cs['Class'],$cs['Semester']);
              
             
              // get all adjustment of scholorship in class & semester
              $scholar_Adj = get_all_scholar_adjustment_under_class_semester($studentid,$cs['Class'],$cs['Semester']);
              
              
              
              ?>
                  <tr style="background-color: #dcdcdc ! important;color:#000;">
                      <td>
                          
                      </td>
                      <td style="text-align:left;"><b><?= $cs['Class']." ".$cs['Semester'] ?></b></td>
                      <td style="text-align:left;"><b>Tuition Cost</b></td>
                      <td style="text-align:right;">
                          <b>
                          <?php 
                          $all_tuition_fee = array_sum($all_tuition_fee); 
                          $c_amo = $all_tuition_fee-$adjustment_detail[0]['total'];
                          echo "$".number_format((float)$c_amo, 2, '.', '');
                        ?>
                        </b>
                      </td>
                      <td style="text-align:right;"><b>-</b></td>
                        
                        <td style="text-align:right;">
                            <b>
                            <?php
                               $all_tuition_fee = ($all_tuition_fee-$adjustment_detail[0]['total'])+$last_bal;
                              echo "$".number_format((float)$all_tuition_fee, 2, '.', '');
                              $last_bal = $all_tuition_fee;
                            ?>
                            </b>
                       </td>
                       
                       
                      
                  </tr>
                <?php   
               $rest = array();
              if(sizeof($all_sch_by_class_sem)>0)
              {
                  
               foreach($all_sch_by_class_sem as $scs)
               {
                  //$scs['scholar_amount'] = $scs['scholar_amount']-$adjustment_detail[0]['total_sch'];
                  $adjustment_detail_sec = get_student_adjustment_detail($scs['course_id'],$studentid);
                  
                  $adjustment_detail_sec = array_column($adjustment_detail_sec, 'scholor_adjustment');
                  $adjustment_detail_sec = array_sum($adjustment_detail_sec);
                  
                  if($scs['Grade'] == 'W')
                  {
                     $scs['scholar_amount'] = ($scs['scholar_amount'])-((($scs['scholar_amount'])*$scs['refund_amount'])/100);
                  }           
                  //$scs['scholar_amount'] = $scs['scholar_amount']-$adjustment_detail_sec;
                  
                    $ads['key1'] = $scs['course_id'];
                	$ads['key2'] = $scs['student_id'];
                	$ads['amount'] = $scs['scholar_amount'];
                	$ads['class'] = $cs['Class'];
                	$ads['semester'] = $cs['Semester'];
                	$ads['name'] = $scs['name']." ( Scholarship ) ";
                	$ads['balance'] = $all_tuition_fee;
                	$ads['sort_date'] = $scs['created_at'];
                	$ads['type'] = 'sch';
                	$ads['link_status'] = '';
                	$rest[] = $ads; 
               }
              }
              
             
             //echo "<pre>";print_r($transaction);echo "</pre>";
              
              if(sizeof($transaction)>0)
              {
                  foreach($transaction as $trac)
                  {
                      array_push($list_of_transaction,$trac['Donor_RowID']);
                      
                        $ads['key1'] = $trac['Donor_RowID'];
                	    $ads['key2'] = $scs['student_id'];
                	    $ads['amount'] = $trac['Amount'];
                	    $ads['class'] = $cs['Class'];
                	    $ads['semester'] = $cs['Semester'];
                	    $ads['name'] = $trac['PaymentType'];
                	    $ads['balance'] = $last_bal;
                	    $ads['sort_date'] =  date('Y-m-d',strtotime($trac['ReceivedDate']));
                	    $ads['type'] = 'tran';
                	    $ads['link_status'] = $trac['link_class'];
                	    $rest[] = $ads; 
                      
                  }    
              }
              
              
                  foreach($get_link_transaction as $trac)
                  {
                      array_push($list_of_transaction,$trac['Donor_RowID']);
                      
                        $ads['key1'] = $trac['Donor_RowID'];
                	    $ads['key2'] = $scs['student_id'];
                	    $ads['amount'] = $trac['Amount'];
                	    $ads['class'] = $cs['Class'];
                	    $ads['semester'] = $cs['Semester'];
                	    $ads['name'] = $trac['PaymentType'];
                	    $ads['balance'] = $last_bal;
                	    $ads['sort_date'] =  date('Y-m-d',strtotime($trac['ReceivedDate']));
                	    $ads['type'] = 'tran';
                	    $ads['link_status'] = $trac['link_class'];
                	    $rest[] = $ads; 
                      
                  }   
              
              
              
              foreach($scholar_Adj as $adj)
              {
                    $ads['key1'] = $adj['course_id'];
                	$ads['key2'] = $adj['DonorID'];
                	$ads['amount'] = $adj['scholor_adjustment'];
                	$ads['class'] = $cs['Class'];
                	$ads['semester'] = $cs['Semester'];
                	$ads['name'] = $adj['name']."Scholarship-Adjustment";
                	$ads['balance'] = $last_bal;
                	$ads['sort_date'] = date('Y-m-d',strtotime($adj['ReceivedDate']));
                	$ads['type'] = 'adj';
                	$ads['link_status'] = '';
                	$rest[] = $ads; 
              }
              
              
             usort($rest, 'date_compare');
             
             
             
             $already_assign = '';
              foreach($rest as $scs)
              {
                  
                  if($scs['type'] == 'sch')
                  {
                      ?>
                      
                      
                      <tr>
                      <td style="text-align:left;"><?= date('m/d/Y',strtotime($scs['sort_date'])) ?></td>
                      <td style="text-align:left;"><?= $scs['class']." ".$scs['semester'] ?></td>
                      <td style="text-align:left;"><?= $scs['name'] ?></td>
                      <td style="text-align:right;">-</td>
                      <td style="text-align:right;"><?= "-"."$".number_format((float)$scs['amount'], 2, '.', ''); ?></td>
                      <td style="text-align:right;"><?php 
                         $last_bal = $last_bal-$scs['amount'];
                        echo number_format((float)$last_bal, 2, '.', '');
                        ?>
                       </td> 
                      </tr>
                      
                      
                      <?php
                  }
                  
                  if($scs['type'] == 'tran')
                  {
                      ?>
                        <tr>
                            <td style="text-align:left;"><?= date('m/d/Y',strtotime($scs['sort_date'])) ?></td>
                            <td style="text-align:left;">
                                
                               
                              <?php
                                if($scs['link_status'] != '')
                                {
                                    echo $scs['class']." ".$scs['semester'];
                                   // echo "<span style='color:green'>Linked</span>";
                                }
                                else
                                {
                                    ?>
                                    <button class="btn btn-primary btn-xs confirm_link_payment" rel_class="<?= $scs['class'] ?>" rel_semester="<?= $scs['semester'] ?>" rel_id="<?= $scs['key1'] ?>">Confirm Semester</button>
                                    <?php
                                }
                               ?>
                             
                                
                            </td>
                            <td style="text-align:left;"><?= $scs['name'] ?>
                             
                            </td>
                            <td></td>
                             <td style="text-align:right;"><?= "-"."$".$scs['amount'] ?></td>
                            <td style="text-align:right;">
                                <?php
                                 $last_bal = $last_bal-$scs['amount'];
                                echo number_format((float)$last_bal, 2, '.', '');
                                ?>
                            </td>
                           
                           
                           
                        </tr>
                        
                        
                        
                      <?php
                  }
                  
                  if($scs['type']=='adj')
                  {
                      ?>
                        <tr style="color: #fff;background-color: #f56c6c ! important;">
                            <td style="text-align:left;"><?= date('m/d/Y',strtotime($scs['sort_date'])) ?></td>
                            <td></td>
                            <td style="text-align:left;"><?= $scs['name'] ?>
                             
                            </td>
                            <td></td>
                             <td style="text-align:right;"><?= "-"."$".number_format((float)$scs['amount'], 2, '.', '') ?></td>
                            <td style="text-align:right;">
                                <?php
                                 $last_bal = $last_bal-$scs['amount'];
                               echo number_format((float)$last_bal, 2, '.', '');
                                ?>
                            </td>
                           
                           
                           
                        </tr>
                        
                        
                        
                      <?php
                  }
                  
                  
                  
              }
              
             
          }
          ?>
          </tbody>
    
</table>
<?php


          $not_exit_payemnt = get_not_exit_payment($list_of_transaction,$studentid);
          if(!empty($not_exit_payemnt))
          {
          ?>
          <h4>Unlinked Payments</h4>
          <table class="table table-striped table-bordered alldataTable">
              <thead>
                  <tr>
                      <th>Date Received</th>
                    <th>Semester</th>
                    <th>Type Of Payments</th>
                    <th>Tuition</th>
                    <th>Adjustments</th>
                    <th>Balance</th>
                  </tr>
              </thead>
          <?php
          
          
          if(sizeof($not_exit_payemnt)>0)
          {
              foreach($not_exit_payemnt as $trac)
              {
                 
                  ?>
                    <tr>
                        <td style="text-align:left;"><?= date('m/d/Y',strtotime($trac['ReceivedDate'])) ?></td>
                        <td style="text-align:left;">
                            
                            <button class="btn btn-primary btn-xs link_payment" rel_id="<?= $trac['Donor_RowID'] ?>">Link Semester</button>
                            
                        </td>
                        <td style="text-align:left;"><?= $trac['PaymentType'] ?></td>
                        <td></td>
                         <td style="text-align:right;"><?= "-"."$".$trac['Amount'] ?></td>
                        <td style="text-align:right;">
                            <?php // number_format((float)($last_bal-$trac['Amount']), 2, '.', ''); ?>
                            
                        </td>
                       <?php
                      // $last_bal = $last_bal-$trac['Amount'];
                       ?>
                    </tr>
                    <?php
              }    
          }
          
          ?>
    
    </table>
<!-- End Payments Details -->
<?php
          }
}
if(sizeof($student_finance_certificate)>0)
{
    ?>

<h4>Certificate Payments</h4>

<!-- get all scholarship -->


<table class="table table-striped table-bordered alldataTable">
    <thead>
        <tr>
            <th>Date Received</th>
            <th>Semester</th>
            <th>Type Of Payments</th>
            <th>Tuition</th>
            
            <th>Balance</th>
            
        </tr>
    </thead>
    <tbody id="certificate_payment_result">
        
        <tr>
                      <td>
                          
                      </td>
                      <td style="text-align:left;"></td>
                      <td style="text-align:left;">Carried Balance</td>
                      <td style="text-align:right;">
                         
                      </td>
                     
                        
                        <td style="text-align:right;"> 0 </td>
                         
                  </tr>
        
        <?php
             $last_bal = 0;
             $first_data = '';
             $last_enrol_course='';
             
             $list_of_transaction=array();
             array_push($list_of_transaction,'');
             
             
          foreach($enrolled_cert__class_semester as $cs)
          {
              $already_assign = '';
              //get scholar ship
              $all_sch_by_class_sem = get_all_cert_scholarship_by_student_id($studentid,$cs['Class'],$cs['Semester']);
              
              $all_tuition_fee = get_total_certificate_tuition($studentid,$cs['Class'],$cs['Semester']);
              
              $all_tuition_fee = array_column($all_tuition_fee, 'total_tuition');
              
              $adjustment_detail = 0;
            
              
              $get_link_transaction = get_cert_class_semester_link_payment($studentid,$cs['Class'],$cs['Semester']);
              
              ?>
                  <tr style="background-color: #dcdcdc ! important;color:#000;">
                      <td>
                          
                      </td>
                      <td style="text-align:left;"><b><?= $cs['Class']." ".$cs['Semester'] ?></b></td>
                      <td style="text-align:left;"><b>Tuition Cost</b></td>
                      <td style="text-align:right;">
                          <b>
                          <?php 
                          $all_tuition_fee = array_sum($all_tuition_fee); 
                          
                          echo "$".number_format((float)$all_tuition_fee, 2, '.', '');
                        ?>
                        </b>
                      </td>
                     
                        
                        <td style="text-align:right;">
                            <b>
                            <?php
                               $all_tuition_fee = ($all_tuition_fee-$adjustment_detail[0]['total'])+$last_bal;
                              echo "$".number_format((float)$all_tuition_fee, 2, '.', '');
                              $last_bal = $all_tuition_fee;
                            ?>
                            </b>
                       </td>
                       
                       
                      
                  </tr>
                <?php   
               $rest = array();
              if(sizeof($all_sch_by_class_sem)>0)
              {
                  
               foreach($all_sch_by_class_sem as $scs)
               {
                            
                  
                    $ads['key1'] = $scs['course_id'];
                	$ads['key2'] = $scs['student_id'];
                	$ads['amount'] = $scs['scholar_amount'];
                	$ads['class'] = $cs['Class'];
                	$ads['semester'] = $cs['Semester'];
                	$ads['name'] = $scs['name']." ( Scholarship ) ";
                	$ads['balance'] = $all_tuition_fee;
                	$ads['sort_date'] = $scs['created_at'];
                	$ads['type'] = 'sch';
                	$ads['link_status'] = '';
                	$rest[] = $ads; 
               }
              }
              
             
             //echo "<pre>";print_r($transaction);echo "</pre>";
              
              if(sizeof($transaction)>0)
              {
                  foreach($transaction as $trac)
                  {
                      array_push($list_of_transaction,$trac['Donor_RowID']);
                      
                        $ads['key1'] = $trac['Donor_RowID'];
                	    $ads['key2'] = $scs['student_id'];
                	    $ads['amount'] = $trac['Amount'];
                	    $ads['class'] = $cs['Class'];
                	    $ads['semester'] = $cs['Semester'];
                	    $ads['name'] = $trac['PaymentType'];
                	    $ads['balance'] = $last_bal;
                	    $ads['sort_date'] =  date('Y-m-d',strtotime($trac['ReceivedDate']));
                	    $ads['type'] = 'tran';
                	    $ads['link_status'] = $trac['link_class'];
                	    $rest[] = $ads; 
                      
                  }    
              }
              
              
                  foreach($get_link_transaction as $trac)
                  {
                      array_push($list_of_transaction,$trac['Donor_RowID']);
                      
                        $ads['key1'] = $trac['Donor_RowID'];
                	    $ads['key2'] = $scs['student_id'];
                	    $ads['amount'] = $trac['Amount'];
                	    $ads['class'] = $cs['Class'];
                	    $ads['semester'] = $cs['Semester'];
                	    $ads['name'] = $trac['PaymentType'];
                	    $ads['balance'] = $last_bal;
                	    $ads['sort_date'] =  date('Y-m-d',strtotime($trac['ReceivedDate']));
                	    $ads['type'] = 'tran';
                	    $ads['link_status'] = $trac['link_class'];
                	    $rest[] = $ads; 
                      
                  }   
              
              
              
              foreach($scholar_Adj as $adj)
              {
                    $ads['key1'] = $adj['course_id'];
                	$ads['key2'] = $adj['DonorID'];
                	$ads['amount'] = $adj['scholor_adjustment'];
                	$ads['class'] = $cs['Class'];
                	$ads['semester'] = $cs['Semester'];
                	$ads['name'] = $adj['name']."Scholarship-Adjustment";
                	$ads['balance'] = $last_bal;
                	$ads['sort_date'] = date('Y-m-d',strtotime($adj['ReceivedDate']));
                	$ads['type'] = 'adj';
                	$ads['link_status'] = '';
                	$rest[] = $ads; 
              }
              
              
             usort($rest, 'date_compare');
             
             
             
             $already_assign = '';
              foreach($rest as $scs)
              {
                  
                  if($scs['type'] == 'sch')
                  {
                      ?>
                      
                      
                      <tr>
                      <td style="text-align:left;"><?= date('m/d/Y',strtotime($scs['sort_date'])) ?></td>
                      <td style="text-align:left;"><?= $scs['class']." ".$scs['semester'] ?></td>
                      <td style="text-align:left;"><?= $scs['name'] ?></td>
                      
                      <td style="text-align:right;"><?= "-"."$".number_format((float)$scs['amount'], 2, '.', ''); ?></td>
                      <td style="text-align:right;"><?php 
                         $last_bal = $last_bal-$scs['amount'];
                        echo number_format((float)$last_bal, 2, '.', '');
                        ?>
                       </td> 
                      </tr>
                      
                      
                      <?php
                  }
                  
                  if($scs['type'] == 'tran')
                  {
                      ?>
                        <tr>
                            <td style="text-align:left;"><?= date('m/d/Y',strtotime($scs['sort_date'])) ?></td>
                            <td style="text-align:left;">
                                
                               
                              <?php
                                if($scs['link_status'] != '')
                                {
                                    echo $scs['class']." ".$scs['semester'];
                                   // echo "<span style='color:green'>Linked</span>";
                                }
                                else
                                {
                                    ?>
                                    <button class="btn btn-primary btn-xs confirm_link_payment" rel_class="<?= $scs['class'] ?>" rel_semester="<?= $scs['semester'] ?>" rel_id="<?= $scs['key1'] ?>">Confirm Semester</button>
                                    <?php
                                }
                               ?>
                             
                                
                            </td>
                            <td style="text-align:left;"><?= $scs['name'] ?>
                             
                            </td>
                           
                             <td style="text-align:right;"><?= "-"."$".$scs['amount'] ?></td>
                            <td style="text-align:right;">
                                <?php
                                 $last_bal = $last_bal-$scs['amount'];
                                echo number_format((float)$last_bal, 2, '.', '');
                                ?>
                            </td>
                           
                           
                           
                        </tr>
                        
                        
                        
                      <?php
                  }
                  
                  if($scs['type']=='adj')
                  {
                      ?>
                        <tr style="color: #fff;background-color: #f56c6c ! important;">
                            <td style="text-align:left;"><?= date('m/d/Y',strtotime($scs['sort_date'])) ?></td>
                            <td></td>
                            <td style="text-align:left;"><?= $scs['name'] ?>
                             
                            </td>
                            <td></td>
                             <td style="text-align:right;"><?= "-"."$".number_format((float)$scs['amount'], 2, '.', '') ?></td>
                            <td style="text-align:right;">
                                <?php
                                 $last_bal = $last_bal-$scs['amount'];
                               echo number_format((float)$last_bal, 2, '.', '');
                                ?>
                            </td>
                           
                           
                           
                        </tr>
                        
                        
                        
                      <?php
                  }
                  
                  
                  
              }
              
             
          }
          ?>
          </tbody>
    
</table>

<?php
$not_exit_payemnt = get_cert_not_exit_payment($list_of_transaction,$studentid);
          if(!empty($not_exit_payemnt))
          {
          ?>
          <h4>Unlinked Payments</h4>
          <table class="table table-striped table-bordered alldataTable">
              <thead>
                  <tr>
                      <th>Date Received</th>
                    <th>Semester</th>
                    <th>Type Of Payments</th>
                    <th>Tuition</th>
                  
                    <th>Balance</th>
                  </tr>
              </thead>
          <?php
          
          
          if(sizeof($not_exit_payemnt)>0)
          {
              foreach($not_exit_payemnt as $trac)
              {
                 
                  ?>
                    <tr>
                        <td style="text-align:left;"><?= date('m/d/Y',strtotime($trac['ReceivedDate'])) ?></td>
                        <td style="text-align:left;">
                            
                            <button class="btn btn-primary btn-xs cert_link_payment" rel_id="<?= $trac['Donor_RowID'] ?>">Link Semester</button>
                            
                        </td>
                        <td style="text-align:left;"><?= $trac['PaymentType'] ?></td>
                        
                         <td style="text-align:right;"><?= "-"."$".$trac['Amount'] ?></td>
                        <td style="text-align:right;">
                            <?php // number_format((float)($last_bal-$trac['Amount']), 2, '.', ''); ?>
                            
                        </td>
                       <?php
                      // $last_bal = $last_bal-$trac['Amount'];
                       ?>
                    </tr>
                    <?php
              }    
          }
          
          ?>
    
    </table>
<!-- End Payments Details -->


<?php 
          }
}
?>



<style>
    .m_th
    {
        text-align:left ! important;
    }
    .require
    {
        color: #ffe4e4;
    font-weight: bold;
    font-size: 18px;
    }
 .table-striped>tbody>tr:nth-of-type(even), .table-striped>tbody>tr:nth-of-type(odd) {
    background: #fff!important;
}
</style>
 <div class="modal fade" id="xmyModal2" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <!-- data-dismiss="modal" -->
          <button type="button" class="close scholor_close" >&times;</button>
          <h4 class="modal-title">Add Scholarship</h4>
        </div>
        
        
            
            <input type="hidden" class="form-control" value="<?=$student_id?>" id="m_student_id" name="student_id">
            <input type="hidden" class="form-control" name="course_id" id="m_course_id">
            <input type="hidden" class="form-control" name="type" id="type">
        <div class="modal-body Add_ScholarShip" style="height:400px;overflow-y:scroll;">
          <table class="table" border="1" style="border:2px solid grey;margin-bottom:20px">
              <tr>
                  <th class="m_th">Student Id</th>
                  <td >:</td>
                  <td class="m_th"><?= $student_id ?></td>
              </tr>
              <tr>
                  <th class="m_th">Student Name</th>
                  <td >:</td>
                  <td class="m_th"><?= $infos['FirstName'] ?></td>
              </tr>
              
              
              
              <tr>
                  <th class="m_th">Course</th>
                  <td>:</td>
                  <td id="course_title" class="m_th"></td>
              </tr>
              
              <tr>
                  <th class="m_th">Class</th>
                  <td>:</td>
                  <td id="select_class" class="m_th"></td>
               </tr>
              
               <tr>
                  <th class="m_th">Semester</th>
                  <td>:</td>
                  <td id="semester" class="m_th"></td>
               </tr>
               
               <tr>
                  <th class="m_th">Tuition</th>
                  <td>:</td>
                  <td id="tuition" class="m_th"></td>
               </tr>
              
              
          </table>
          
          <table class="table " border="1" style="border:2px solid grey;margin-bottom:20px">
              <thead>
                  <tr>
                      <th  class="m_th">Scholarship Type &nbsp;<span class="require">*</span></th>
                      <th class="m_th">Scholarship &nbsp; <span class="require">*</span></th>
                      <th class="m_th">Notes</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody class="m_result">
                  
              </tbody>
              
              
          </table>
          
          <!--div class="col-md-12 form-group" style="float:right;">
              <span class="btn btn-primary btn-xs add_more_schol" rel-count="1" style="float:right;">Add ScholarShip</span>
          </div-->
          
        </div>
        <div class="modal-footer">
          <!--button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button-->
          
        </div>
        
        
        
      </div>
      
    </div>
  </div>



<style>
   .semester_outter {
        display: flex;
        
        justify-content: space-between;
    }
</style>

<div class="modal fade" id="link_payment_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Link Year & Semester</h4>
        </div>
        <div class="modal-body">
           <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <input type="hidden" class="form-control" id="user_id_donor">
                       
                       <input type="hidden" id="define_class" class="form-control">
                       
                       <input type="hidden" id="define_semester" class="form-control">
                       
                      
                         <label>Year</label>
                           <select class="form-control user_class">
                               <option value="">Select Year</option>
                               <?php
                                foreach($assign_class as $ac)
                                {
                                    ?>
                                    <option value="<?= $ac['Class'] ?>"><?= $ac['Class'] ?></option>
                                    <?php
                                }
                               ?>
                           </select>    
                       
                       
                   </div>
                   
                   
                   
                   
                   <div class="form-group">
                       
                       
                       <div class="row">
                                        <div class="col-md-12">
									    	<div class="form-group">
									    	    
									    	    <div class="semester_outter">
            										<div style="width:100%;">
            											<label>Semester</label>
                                                           <select class="form-control" id="user_semester">
                                                               <option value="">Select Semester</option>
                                                               
                                                           </select>
            										</div>
            										<small id="set_img">
            										<!--img style="height: 31px;margin-top: 15px;" src='<?= base_url() ?>assets/loading_clock2.gif'-->
            										</a>
            										</small>
            									</div>
										
											</div>
								    </div>
                       </div>
                       
                       <!--div class="row">
                           <div class="col-md-10">
                               <label>Semester</label>
                               <select class="form-control" id="user_semester">
                                   <option value="">Select Semester</option>
                                   
                               </select>
                           </div>
                            <div class="col-md-2" >
                               <img style="width:50%;" src='<?= base_url() ?>assets/loading_clock2.gif'> </option>
                           </div>
                       </div-->
                       
                   </div>
               </div>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success link_class_semester">Submit</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
  
  <div class="modal fade" id="cert_link_payment_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Link Year & Semester</h4>
        </div>
        <div class="modal-body">
           <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <input type="hidden" class="form-control" id="cert_user_id_donor">
                       
                       <input type="hidden" id="cert_define_class" class="form-control">
                       
                       <input type="hidden" id="cert_define_semester" class="form-control">
                       
                      
                         <label>Year</label>
                           <select class="form-control cert_user_class">
                               <option value="">Select Year</option>
                               <?php
                                foreach($cert_assign_class as $ac)
                                {
                                    ?>
                                    <option value="<?= $ac['Class'] ?>"><?= $ac['Class'] ?></option>
                                    <?php
                                }
                               ?>
                           </select>    
                       
                       
                   </div>
                   
                   
                   
                   
                   <div class="form-group">
                       
                       
                       <div class="row">
                                        <div class="col-md-12">
									    	<div class="form-group">
									    	    
									    	    <div class="semester_outter">
            										<div style="width:100%;">
            											<label>Semester</label>
                                                           <select class="form-control" id="cert_user_semester">
                                                               <option value="">Select Semester</option>
                                                               
                                                           </select>
            										</div>
            										<small id="cert_set_img">
            										<!--img style="height: 31px;margin-top: 15px;" src='<?= base_url() ?>assets/loading_clock2.gif'-->
            										</a>
            										</small>
            									</div>
										
											</div>
											<span style="float:right;">
											    <?php
											      if(empty($cert_assign_class))
											      {
											         ?>
											         <a target="_blank" href="<?= base_url() ?>admin/Master/addCertificate">* Update Class And Semester</a>
											         <?php
											      }
											    ?>
											</span>
								    </div>
                       </div>
                       
                       <!--div class="row">
                           <div class="col-md-10">
                               <label>Semester</label>
                               <select class="form-control" id="user_semester">
                                   <option value="">Select Semester</option>
                                   
                               </select>
                           </div>
                            <div class="col-md-2" >
                               <img style="width:50%;" src='<?= base_url() ?>assets/loading_clock2.gif'> </option>
                           </div>
                       </div-->
                       
                   </div>
               </div>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success cert_link_class_semester">Submit</button>
        </div>
      </div>
      
    </div>
  </div>