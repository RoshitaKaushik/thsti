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
    				<h4 class="pull-left page-title">My Inbox</h4>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
    					<div class="panel-heading">
    						<h3 class="panel-title">My Inbox
        						 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
            						<i class="ion-arrow-left-a"></i>
            						<span><strong>Go Back</strong></span>            
            					</a>
    						</h3>
    					</div>
    					<div class="panel-body">
    							<div class="col-md-12 col-sm-12 col-xs-12">
    							
                                    <div class="table-responsive"  >
                                        
                                        <form action="<?= base_url('admin/GradeForm/store_grade') ?>" method="post">
                                            <input type='hidden' name='course_id' value="<?= isset($eny_course)?>">
                                            <input type="hidden" <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                        <table id="SemesterListing" class="table table-striped table-bordered" >
                                                <thead>
                                                    <tr>
                                                        <th>From</th>
                                                        <th>Received From</th>
                                                        <th>Received Date/Time</th>
                                                        <th></th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                        <th>Unread/Read</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                   <?php
                                                    if($grade_course_detail)
                                                    {
                                                        //echo "<pre>";print_r($grade_course_detail);echo "</pre>";
                                                        $sn=1;
                                                        foreach($grade_course_detail as $gd)
                                                        {
                                                            $read1 = "";
                                                            if($gd['admin_read_status'] == 0 || $gd['admin_read_status'] == '')
                                                            {
                                                                $read1 = "style='font-weight:bold'";
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $gd['admin_fullname'];  ?></td>
                                                                <td>Grade List</td>
                                                                <td>
                                                                    <?php $data = course_grade_current_status($gd['course_id'])[0]; ?>
                                                                    <?php if($data['modify_date']) : ?>
                                                                    <?php   echo date('m-d-Y, H:i A', strtotime($data['modify_date'])); ?>
                                                                    <?php else : ?>
                                                                    <?php   echo date('m-d-Y, H:i A', strtotime($data['created_at'])); ; ?>
                                                                    <?php endif; ?>
        
                                                                </td>
                                                                <td><a href="<?= base_url('admin/Myinbox/grade_list/'.encryptor('encrypt', $gd['course_id'])) ?>">View</a></td>
                                                                <td>
                                                                     <?php if($gd['admin_status'] == 1) :?>
                                                                     
                                                                           <span class='text-success'>Approved</span>
                                                                      
                                                                      <?php elseif($gd['admin_status'] == 2 && $gd['status'] == 0) : ?>
                                                                      
                                                                           <span class='text-danger'>Rejected</span>
                                                                      
                                                                      <?php else : ?>
                                                                    
                                                                          <span class='text-warning'>In-Process</span>
                                                                      <?php endif; ?>
                                                                    
                                                                </td>
                                                                <td>
                                                                  <?php if($gd['status']==1 && ($gd['admin_status'] == '' || $gd['admin_status'] == 0)) : ?>
                                                                     
                                                                          <span class='btn-success btn-sm approve' rel_id="<?= $gd['course_id'] ?>" style='padding:2px;cursor:pointer;'>Approve</span>
                                                                          <span class='btn-danger btn-sm rejected' rel_id="<?= $gd['course_id'] ?>" style='padding:2px;cursor:pointer;'>Reject</span>
                                                                      
                                                                    <?php elseif($gd['status']==1 && $gd['admin_status'] == 2) :?>
                                                                     
                                                                          <span class='btn-success btn-sm approve' rel_id="<?= $gd['course_id'] ?>" style='padding:2px;cursor:pointer;'>Approve</span>
                                                                          <span class='btn-danger btn-sm rejected' rel_id="<?= $gd['course_id'] ?>" style='padding:2px;cursor:pointer;'>Reject</span>
                                                                    <?php else : ?>
                                                                          <span></span>
                                                                    <?php endif; ?> 
                                                                </td>
                                                                <td><?php echo ($gd['admin_read_status'] == 0 || $gd['admin_read_status'] == '') ? '<span style="font-weight: bold; font-size: 12px;">Unread</span>' : 'Read' ?></td>
                                                               
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                   ?>
                                                  
                                                </tbody>
                                        </table>
                                        </form>
                                        
                                   </div>
                               
                          	</div>
    						
    					</div>
    				</div>
    			</div>
    			
    		</div> <!-- End Row -->           
        </div> <!-- container -->
     
	</div> <!-- content -->
</div> <!-- content-page -->

<div class="modal fade" id="myapproval_model" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Alert</h4>
        </div>
        <form method='post' action="<?= base_url('admin/Myinbox/approve_course') ?>">
        <div class="modal-body">
          <h5>Really you want to approve this grade.</h5>
          <input type="hidden" <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
          <input type='hidden' name='course_id' class='form-control' id='course_id'>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-success">Yes</button>
        </div>
        </form>
        
      </div>
      
    </div>
  </div>
  
 <div class="modal fade" id="myreject_model" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Alert</h4>
        </div>
        <form method='post' action="<?= base_url('admin/Myinbox/reject_course') ?>">
        <div class="modal-body">
          <h5 class='text-center'>Really you want to reject this grade.</h5>
          <input type="hidden" <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
          <input type='hidden' name='course_id' class='form-control' id='reject_course_id'>
          <label>Reason :</label>
          <textarea required name='reason' rows='5' class='form-control'></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-success">Yes</button>
        </div>
        </form>
        
      </div>
      
    </div>
  </div>


 <script>
     $(document).on('click','.approve',function(){
         var course_id = $(this).attr('rel_id');
         $('#course_id').val(course_id);
         $('#myapproval_model').modal('show');
     })
     $(document).on('click','.rejected',function(){
         var course_id = $(this).attr('rel_id');
         $('#reject_course_id').val(course_id);
         $('#myreject_model').modal('show');
     })
 </script>