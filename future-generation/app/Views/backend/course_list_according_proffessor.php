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
    		<div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Course List</h4>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
    					<div class="panel-heading">
    						<h3 class="panel-title">Report
        						 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
            						<i class="ion-arrow-left-a"></i>
            						<span><strong>Go Back</strong></span>            
            					</a>
    						</h3>
    					</div>
    					<div class="panel-body">
    							<div class="col-md-12 col-sm-12 col-xs-12">
    								
    								 <?php if($error = session()->getFlashdata('msg')){ ?>
                                            <div class="alert alert-success" id="msg">
                                               <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                <strong>Success!</strong> <?php echo  $error; ?>
                                            </div>
                                        <?php }else{?>
                                              <p class="text-danfer"><?php echo  $error; ?></p>
                                        <?php } ?>
								
    							    <div class="col-sm-12" >
    							        
                                    <div class="table-responsive"  >
                                        <table id="SemesterListing" class="table table-striped table-bordered" >
                                                <thead>
                                                    <tr>
                                                        <th>Sno</th>
                                                        <th>Course Name</th>
                                                        <th>Class year</th>
                                                        <th>Semester</th>
                                                        <th>Current  Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                   <?php
                                                    $i=1;
                                                    foreach($courses as $cr)
                                                    {    
                                                        ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $cr['CourseTitle']." &nbsp;(".$cr['Course'].")" ?></td>
                                                            <td><?= $cr['Class'] ?></td>
                                                            <td><?= $cr['Semester'] ?></td>
                                                            <td>
                                                                <?php
                                                                $data1 = course_grade_current_status($cr['CourseID']);
                                                                if($data1)
                                                                {
                                                                    if($data1[0]['admin_status'] == 1)
                                                                    {
                                                                        echo "<span class='text-success'>Approved</span>";
                                                                    }
                                                                    else if($data1[0]['admin_status'] == 2)
                                                                    {
                                                                        echo "<span class='text-danger'>Rejected</span>";
                                                                    }
                                                                    else
                                                                    {
                                                                         echo "<span class='text-danger'>-</span>";
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    echo "<span class='text-danger'>-</span>";
                                                                }
                                                                
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $validate_data = get_student_avalibility_in_course(encryptor('encrypt', $cr['CourseID']));
                                                                if($validate_data)
                                                                {
                                                                    ?>
                                                                <a href="<?= base_url('admin/GradeForm/assign_grade/').encryptor('encrypt', $cr['CourseID']) ?>">Assign Grade</a>
                                                               <?php
                                                                }?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                       
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


    
</script>

