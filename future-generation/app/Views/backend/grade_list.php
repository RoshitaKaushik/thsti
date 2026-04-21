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
td
{
    text-align:left ! important;
}
</style> 
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
    		<!-- Page-Title -->
    		<div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Assign Grade</h4>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
    					<div class="panel-heading">
    						<h3 class="panel-title">Assign Grade
        						 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
            						<i class="ion-arrow-left-a"></i>
            						<span><strong>Go Back</strong></span>            
            					</a>
    						</h3>
    					</div>
    					<div class="panel-body">
    							<div class="col-md-12 col-sm-12 col-xs-12">
    								
								
    							    <div class="col-sm-12" >
    							         <?php
                                        if(isset($selected_course_detail))
                                        {
                                            ?>
                                            <table class='table table-striped table-bordered' style='margin-top:20px;margin-bottom:20px;'>
                                              <tbody>
                                                  <tr>
                                                        <th><b>Course Title</b></th>
                                                        <th>:</th>
                                                        <td style="float:left;">&nbsp;&nbsp;<?= isset($selected_course_detail['CourseTitle']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Professor</b></th>
                                                        <th>:</th>
                                                        <td  style="float:left;">&nbsp;&nbsp;<?= isset($selected_course_detail['Professor']); ?></td> 
                                                    </tr>
                                                    <tr>
                                                        <th><b>Semester</b></th>
                                                        <th>:</th>
                                                        <td  style="float:left;">&nbsp;&nbsp;<?= isset($selected_course_detail['Semester']); ?></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th><b>Course Year</b></th>
                                                        <th>:</th>
                                                        <td  style="float:left;">&nbsp;&nbsp;<?= isset($selected_course_detail['Class']); ?></td>
                                                    </tr>
                                                   
                                                   </tbody>
                                        </table>
                                            <?php
                                        }
                                        ?>
    							        
    							        
                                    <div class="table-responsive"  >

                                        <table id="SemesterListing" class="table table-striped table-bordered" >
                                                <thead>
                                                    <tr>
                                                        <th>Sno</th>
                                                        <th>Student Name</th>
                                                        <th>Grade</th>
                                                        <th>Incomplete/Deadline/Comments</th>
                                                        <th>Assign By</th>                                                      
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                   <?php
                                                     if($grade_course_detail)
                                                     {
                                                         $sn=1;
                                                         foreach($grade_course_detail as $gd)
                                                         {
                                                             ?>
                                                             <tr>
                                                                 <td><?= $sn++; ?></td>
                                                                 <td><?= $gd['FirstName']." ".$gd['LastName'] ?></td>
                                                                 <td><?= $gd['grade'] ?></td>
                                                                 <td><?= $gd['comment'] ?></td>
                                                                 <td><?= $gd['admin_fullname'] ?></td>
                                                             </tr>
                                                             <?php
                                                         }
                                                     }
                                                   ?>
                                                </tbody>
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


