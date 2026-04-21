<?php 
$add_permission = false;
if(session()->get('profiles')){
	if(in_array(1, session()->get('profiles'))){
		$add_permission = true;
	}							
}elseif(session()->get('role') == 1){
	$add_permission = true;
}


?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                 
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
}
.view_type_button
{
    background-color: #fafafa;
    color: rgba(0,0,0,0.6) ! important;
    font-size: 14px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    -webkit-box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
    -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
    box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
    border: 1px solid rgb(171, 167, 167);
    box-shadow: none;
    
}
button.btn.view_type_button.active
{
    background:#d1f1fa !important;
}
.top_marginn
{
    margin-top:10px !important;
}
.modal-lg
{
    width:1050px !important;
}


table.table-bordered tbody td {
  font-size: 11px;
}

table.dataTable thead > tr > th {
  font-size: 11px !important;
    
}


</style>     
<div class="content-page">
<!-- Start content -->
<div class="content">
	<div class="container">
		<?php if(session()->getFlashdata('msg') !='')
		{
		    echo session()->getFlashdata('msg'); 
		     session()->remove('msg');
		 }
	
		 if( session()->getFlashdata('assign_user') !='')
		 {
		     echo '<h3>Enrolled User</h3>';
		     foreach(session()->getFlashdata('assign_user') as $a_user)
		     {
		     ?>
		       <div class="col-md-2">
		         <?php
		          echo $a_user['FirstName']." ".$a_user['LastName']."-".$a_user['ID']."<br>";
		         ?>
		      </div>
		     <?php
		     }
		 }
		 ?>
		
		<!-- Page-Title -->
		<?php 
		$new_array=array('id'=>'courselistform');
		echo form_open_multipart("admin/Master/submitCourselist",$new_array); ?>
						<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Course List
							<?php 
 							if($add_permission){
							?>
							    <button  type = "button" id="add_btn" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" data-toggle="modal" data-target="#panel-modal"><span class="icon ion-plus-circled" aria-hidden="true">   ADD </span></button>
							<?php } ?>
							</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
									<div class="modal-dialog modal-lg">
										<div class="modal-content p-0 b-0">
											<div class="row">
													<!-- Basic example -->
												<div class="col-md-12">
													<div class="panel panel-color panel-info">
														<div class="panel-heading"><h3 class="panel-title"> Course List</h3>
														</div>
															<div class="panel-body">
															    <div class="row">
															        <div class="col-lg-4 col-md-4 col-sm-12">
															            <div class="row">
															                <div class="col-md-5">
															                    <input type="hidden" class='edit_course_id' name="CourseID" value="<?php if(isset($edit_course[0]) ) { echo $edit_course[0]['CourseID']; } ?>" >
																		        <label> Course Yr<span class="requires">*</span></label>
															                </div>
															                <div class="col-md-7">
															                    <div class="form-group">
            																	    <select class="form-control courselist" name="Class" id="Class" required>
            																		<option value="">Select Course Yr</option>
            																		<?php if (isset($edit_course)){foreach($class as $row){
            																			$flag=($row['Class']==$edit_course[0]['Class'] ? 'selected="selecyted"':'');
            																			?>
            																		<option value="<?php echo $row['Class'];?>" <?php echo $flag;?>><?php echo $row['Class'];?></option>
            																		<?php }}?>
            																		</select>
            																	</div>
															                </div>
															            </div>
																    </div>
    																<div class="col-lg-4 col-md-4 col-sm-12">
    																    <div class="row">
    																        <div class="col-md-5">
        																        <label for="Active">Semester<span class="requires">*</span></label>
        																    </div>
        																    <div class="col-md-7">
        																        <div class="form-group">
            																		<select class="form-control courselist" name="Semester" id="Semester" required>
            																			<option value="">Select</option>
            																			<option value="Fall" <?php if(isset($edit_course[0])){if('Fall'==$edit_course[0]['Semester']){ echo "Selected";}} ?>>Fall</option>										
            																			<option value="Spring" <?php if(isset($edit_course[0])){if('Spring'==$edit_course[0]['Semester']){ echo "Selected";}} ?>>Spring</option>										
            																			<option value="Term" <?php if(isset($edit_course[0])){if('Term'==$edit_course[0]['Semester']){ echo "Selected";}} ?>>Term</option>	
            																			<option value="Summer" <?php if(isset($edit_course[0])){if('Summer'==$edit_course[0]['Semester']){ echo "Selected";}} ?>>Summer</option>	
            																			<option value="Winter" <?php if(isset($edit_course[0])){if('Winter'==$edit_course[0]['Semester']){ echo "Selected";}} ?>>Winter</option>				
            																		</select>								
            																	</div>
        																    </div>
    																    </div>
    																</div>
    																<div class="col-lg-4 col-md-4 col-sm-12">
    																    <div class="row">
    																        <div class="col-md-5">
    																            <label for="Active">Session</label>
    																        </div>
    																        <div class="col-md-7">
    																            <div class="form-group">
            																		<select class="form-control courselist" name="Term" id="Term">
            																			<option value="">Select</option>
            																			<option value="1"  <?php if(isset($edit_course[0])){if('1'==$edit_course[0]['Term']){ echo "Selected";}} ?>>1</option>										
            																			<option value="2"  <?php if(isset($edit_course[0])){if('2'==$edit_course[0]['Term']){ echo "Selected";}} ?>>2</option>										
            																			<option value="3"  <?php if(isset($edit_course[0])){if('3'==$edit_course[0]['Term']){ echo "Selected";}} ?>>3</option>										
            																			<option value="4"  <?php if(isset($edit_course[0])){if('4'==$edit_course[0]['Term']){ echo "Selected";}} ?>>4</option>										
            																		</select>								
            																	</div>
    																        </div>
    																    </div>
    																</div>
															    </div>
															    <!-- End First Row -->
																<div class="row top_marginn">
    																<?php if(!isset($edit_course[0])){ ?>
    																<div class="col-lg-4 col-md-4 col-sm-12">
    																    <div class="row">
    																        <div class="col-md-5">
    																            <input type="hidden" name="CourseID" value="<?php if(isset($edit_course[0]) ) { echo $edit_course[0]['CourseID']; } ?>" maxlength="10" >
    																		    <label> CourseID<span class="requires">*</span></label>
    																        </div>
    																        <div class="col-md-7">
    																            <div class="form-group">
            																		<input id="CourseID" type="text" class="form-control courselist" name="Course" maxlength="10" placeholder="Enter CourseID " required  >
            																	</div>
    																        </div>
    																    </div>
    																</div>
    																
    																<?php }else{ ?>
    																<div class="col-lg-4 col-md-4 col-sm-12">
    																    <div class="row">
    																        <div class="col-md-5">
    																            <label>CourseID<span class="requires">*</span></label>
    																        </div>
    																        <div class="col-md-7">
    																            <div class="form-group">
            																		<input type="text" class="form-control courselist"  name="Course" placeholder="Enter CourseID " value ="<?php if(isset($edit_course[0]) ) { echo $edit_course[0]['Course']; } ?>" maxlength="10"  required>
            																	</div>
    																        </div>
    																    </div>
    																</div>
    																<?php } ?>
    																<div class="col-lg-4 col-md-4 col-sm-12">
    																    <div class="row">
    																        <div class="col-md-5">
    																            <label for="discipline_status">Course Title <span class="requires">*</span></label>
    																        </div>
    																        <div class="col-md-7">
    																            <div class="form-group">
            																		<input type="text" class="form-control courselist" id="CourseTitle" name="CourseTitle" placeholder="Enter Course Title  " value ="<?php if(isset($edit_course[0]) ) { echo $edit_course[0]['CourseTitle']; } ?>" required >
            																	</div>
    																        </div>
    																    </div>	
    																	
    																</div>
																</div>
																
																
																<div class="row top_marginn">
    																<div class="col-lg-4 col-md-4 col-sm-12">
    																    								
    																	<div class="row">
    																	    <div class="col-md-5">
    																	        <label>Audit Rate <span class="requires">*</span></label>    
    																	    </div>
    																	    <div class="col-md-7">
    																	        <input type="number" class="form-control num courselist" id="audit_rate" name="audit_rate" placeholder="Enter Audit rate (0.00) " value ="<?php if(isset($edit_course[0]) ) { echo $edit_course[0]['audit_rate']; }  ?>"   required>
    																	    </div>
    																	</div>
    																	
    																</div>
    																<div class="col-lg-4 col-md-4 col-sm-12">								
    																	<div class="row">
    																	    <div class="col-md-5">
    																	        <label>Tution Per Credit <span class="requires">*</span></label>
    																	    </div>
    																	    <div class="col-md-7">
    																	        <input type="text" class="form-control courselist" id="tution" name="tution" placeholder="Enter Tution (0.00)" value ="<?php if(isset($edit_course[0]) ) { echo $edit_course[0]['tution']; }  ?>" required>
    																	    </div>		
    																	</div>
    																</div>
    																
    																<div class="col-lg-4 col-md-4 col-sm-12">								
    																	<div class="row">
    																	    <div class="col-md-5">
    																	        <label>Credits <span class="requires">*</span></label>    
    																	    </div>
    																	    <div class="col-md-7">
    																	        <input type="text" class="form-control num courselist" id="Credits" name="Credits" placeholder="Enter Credits  " value ="<?php if(isset($edit_course[0]) ) { echo $edit_course[0]['Credits']; }  ?>" maxlength="2"  required>
    																	    </div>
    																	</div>
    																</div>
																</div>
																
																<div class="row top_marginn" style="margin-top: 20px !important;">
    																<div class="col-lg-4 col-md-4 col-sm-12">
    																    <div class="form-group">
    																        <input type="radio" name="date_type" <?php if(isset($edit_course)){if($edit_course[0]['start_date'] == '' || $edit_course[0]['start_date'] == '0000:00:00'){ echo "checked"; }} ?>  value="tbd" class="date_type">
    																        <label>TBD</label>
    																        <input type="radio" name="date_type" <?php if(isset($edit_course)) {if($edit_course[0]['start_date'] != '' || $edit_course[0]['start_date'] != '0000:00:00'){ echo "checked"; }} ?> value="course_date" class="date_type">
    																        <label>Course Date</label>
    																        
    																    </div>
    																</div>
    																
    																<div class="col-lg-8 col-md-8">
    																    <div class="row">
    																        <div class="col-md-5 col-sm-12 tbd_type" <?php if(isset($edit_course)){if($edit_course[0]['start_date'] != '' || $edit_course[0]['start_date'] != '0000:00:00'){ echo "style='display:none'"; }} ?>>
    																            <div class="col-md-5">
    																                <label for="discipline_status">Course Date <span class="requires">*</span></label>
    																            </div>
    																            <div class="col-md-7">
    																                <input type="text" class="form-control courselist" id="CourseDates" name="CourseDates" placeholder="Enter Course Date" value ="<?php if(isset($edit_course[0]) ) { echo $edit_course[0]['CourseDates']; } ?>" >
    																            </div>
    																        </div>
    																        <div class="col-md-6 start_type" <?php if(!isset($edit_course[0]['start_date'])){  } else if($edit_course[0]['start_date'] == '' || $edit_course[0]['start_date'] == '0000:00:00'){ echo "style='display:none'"; } ?>>
    																            <div class="row">
    																                <div class="col-md-5">
    																                    <label>Course Start Date</label>  
    																                </div>
    																                <div class="col-md-7">
    																                    <div class="input-group date" data-provide="datepicker">
                                                                						    <input  class="form-control datepickerbackward courselist" id="start_date" placeholder="Enter Course Date" name="start_date" type="text" value ="<?php if(isset($edit_course[0]) ) { if($edit_course[0]['start_date'] != ''){ echo date('m/d/Y',strtotime($edit_course[0]['start_date'])); }}  ?>">
                                                                						  <div class="input-group-addon">
                                                                						    <span class="glyphicon glyphicon-th"></span>
                                                                						   </div>
                                                                						</div>
    																                </div>
    																            </div>
    																        </div>
    																        <div class="col-md-6 start_type" <?php if(!isset($edit_course[0]['start_date'])){  }else if($edit_course[0]['start_date'] == '' || $edit_course[0]['start_date'] == '0000:00:00'){ echo "style='display:none'"; } ?>>
    																            <div class="row">
    																                <div class="col-md-5">
    																                    <label>Course End Date</label>
    																                </div>
    																                <div class="col-md-7">
    																                    <div class="input-group date" data-provide="datepicker">
                                                                						    <input  class="form-control datepickerbackward courselist" id="end_date" placeholder="Enter Course Date" name="end_date" type="text" value ="<?php if(isset($edit_course[0]) ) { if($edit_course[0]['end_date'] != ''){ echo date('m/d/Y',strtotime($edit_course[0]['end_date'])); }}  ?>">
                                                                						  <div class="input-group-addon">
                                                                						    <span class="glyphicon glyphicon-th"></span>
                                                                						   </div>
                                                                						</div>
    																                </div>
    																            </div>
    																        </div>
    																    </div>
    																</div>
    																
																</div>
																
																
																
																<div class="row top_marginn">
																    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 10px;">
																        <div class="btn-group tab_btn_gourp" role="group" aria-label="Basic example" style="width:100%">               
                                                                            
                                                                            <button type="button" data-index="Professor" class="btn view_type_button active" style="width:50% !important;">Professor</button>
                                                                            <button type="button" data-index="Assistant" class="btn view_type_button" style="width:50% !important;">Teaching Assistant (if any)</button>
                                                                        </div>
																    </div>
																</div>
																
																<div class="row">
																 <div class="col-md-12 professor_part" style='max-height:200px;overflow-y:auto;margin-top:5px;'>
																   <div class="form-group">
																	<label>Professor <span class="requires">*</span></label><span id='p_name'><?php if(isset($edit_course[0]) ) { echo $edit_course[0]['Professor']; } ?></span><br>
																	 <div class='col-md-3'>
																	     <?php
																	     $sec = '';
																	      if(isset($edit_professor))
																	      {
																	          if( in_array(0 ,$edit_professor) )
                                                                              {
                                                                                  $sec='checked';
                                                                              }
																	      }
																	     ?>
																           <input type='checkbox'  class="Professor myCheck" name="Professor_id[]" value="0">TBD
																       
																       </div>
																		<?php
    																	  foreach($professor as $pro)
    																	  {
    																	      $sec = '';
    																	      if(isset($edit_professor))
    																	      {
    																	          if( in_array($pro['ID'] ,$edit_professor) )
                                                                                  {
                                                                                      $sec='checked';
                                                                                  }
    																	      }
    																	      
    																	       ?>
    																	       <div class='col-md-3'>
    																	           <input type='checkbox' <?= $sec ?> class="Professor myCheck" name="Professor_id[]" value="<?= $pro['ID'] ?>">&nbsp;<?= $pro['FirstName']." ".$pro['LastName'] ?>
    																	       </div>
    																	      <?php
    																	  }
    																	?>
																	    <input type="hidden" class='form-control' name='Professor' id='Professor_name' value ="<?php if(isset($edit_course[0]) ) { echo $edit_course[0]['Professor']; } ?>">
																		<!--<input type="text" class="form-control courselist" id="Professor" name="Professor" placeholder="Enter Professor Name " value ="<?php if(isset($edit_course[0]) ) { echo $edit_course[0]['Professor']; } ?>"   required> -->
																	</div>
																</div>
																
																 <div class="col-md-12 assistant_part" style='max-height:200px;overflow-y:auto;margin-top:5px;display:none;'>								
																	<div class="form-group">
																		<label>Teaching Assistant (if any)</label> <span id="assistant_span"><?php if(isset($edit_course[0]) ) { if($edit_course[0]['assistant_name'] == '' ){echo $edit_course[0]['Teaching_Assistant'];}else{ $edit_course[0]['assistant_name']; } } ?></span><br/>
                                                                        <?php
                                                                        foreach($professor as $pro){
                                                                            $sec = '';
                                                                            if(isset($edit_course[0])){
                                                                                $edit_assitant = explode(",",$edit_course[0]['assistant_id']);
                                                                                if( in_array($pro['ID'] ,$edit_assitant)){
                                                                                  $sec='checked';
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <div class='col-md-3'>
                                                                                <input type='checkbox' <?= $sec ?> class="Teaching_Assistant teaching_checkbox" name="Teaching_Assistant[]" value="<?= $pro['ID'] ?>"><?= $pro['FirstName']." ".$pro['LastName'] ?>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                        ?>
																		
																		<!--input type="text" class="form-control" id="Teaching_Assistant" name="Teaching_Assistant" placeholder="Enter Name" value ="<?php if(isset($edit_course[0]) ) { echo $edit_course[0]['Teaching_Assistant']; }  ?>"-->
																	</div>
																</div>
																</div>
																<!--div class="row">
																    <div class="col-md-12">								
    																	<div class="form-group">
    																		<label>External Professor(If Any)</label>
    																		<input type="text" class="form-control courselist" id="External_Professor" name="External_Professor" placeholder="Enter Name" value ="<?php if(isset($edit_course[0]) ) { echo $edit_course[0]['External_Professor']; }  ?>">
    																	</div>
    																</div>
																</div-->
																
																
															 </div>	<!-- panel-body -->
                                							<div class="modal-footer">
                                							    <div class="row">
                                							        <div class="col-md-12">
                                							            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                        <input type="submit" class="btn btn-success" onclick="return check_data()" name="submit" value="Save">  
                                							        </div>
                                							    </div>
                                							</div>
										</div> <!-- panel -->
											<?php echo form_close(); ?>
										</div> <!-- row-->
									</div>
											
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div>
								<!--Delete Model -Apoorv 2/06/2020-->
								 <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <h5>Are you sure to delete this record?</h5>
                  </div>
                  <div class="modal-footer">
                        <input type="hidden" name="courselist_delete" id="courselist_delete" class="form-control">
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <a  id="btn_delete" class="btn btn-success">Yes</a>
                  </div>
                </div>
              </div>
            </div>
				
								<!--End of delete modal - apoorv-->
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						
						<div class="panel-body1">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12" style="overflow-x:scroll;">
									<table id="courseListDataTable" class="table table-striped table-bordered alldataTable">
										<thead>
											<tr>
												<th>CourseYr</th>												
												<th>Semester</th>												
												<th>Session</th>												
												<th>CourseID</th>
												<th id="course_title">Course Title</th>
												<th>Course Start Date</th>
												<th>Course End Date</th>
												<th>Audit Rate</th>
                                                <th>Professor</th>	
                                                <th>Teaching Assistant</th>
                                                <th>Credits</th>
												<th>Tution</th>										 
                                                <th>Action</th>												 
											</tr>
										</thead>
										<tbody> 
											<?php 
											$i=1;
											foreach($courselist as $row) { ?>
											<tr>
											<td><?=$row['Class']?></td>												
											<td class="text-left"><?=$row['Semester']?></td>												
											<td class="text-left"><?=$row['Term']?></td>	
                                            <td class="text-left"><?=$row['Course']?></td>
											<td class="text-left" style="text-align:left;"><?=$row['CourseTitle']?></td>
										
											<td class="text-left" data-order="<?php echo  date('Y-m-d',strtotime($row['start_date'])) ?>">
											    <?php if($row['start_date'] != ''){ echo date('F d,Y',strtotime($row['start_date'])); }else{ echo $row['CourseDates']; }  ?>
											</td>
											<td class="text-left" data-order="<?php echo  date('Y-m-d',strtotime($row['end_date'])) ?>"><?php if($row['end_date'] != ''){ echo date('F d,Y',strtotime($row['end_date'])); }  ?></td>
											<td class="text-right"><?= $row['audit_rate'] ?></td>
                                            <td class="text-left">
                                                <?php
                                                 if($row['Professor'] == '')
                                                 {
                                                     echo "TBD";
                                                 }
                                                 else
                                                 {
                                                     echo $row['Professor'];
                                                 }
                                                ?>
                                            </td>	
                                            <td class="text-left"><?php if($row['assistant_name'] != ''){ echo $row['assistant_name']; }else{ echo $row['Teaching_Assistant']; } ?></td>
                                            <td><?=$row['Credits']?></td>
                                            <td class="text-right"><?=$row['tution']?></td> 												 
											<td>
												<?php 
												if($add_permission){
												?>
												<a href="<?=base_url('')?>admin/Master/addCourselist/<?=encryptor('encrypt', $row['CourseID'])?> " 	class="btn btn-info waves-effect waves-light btn-xs m-b-5">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
													<span><strong>
													</strong></span>            
												</a>
												<a href="javascript:void(0);" data-courseid="<?php echo encryptor('encrypt', $row['CourseID']); ?>" class="item_delete btn btn-danger waves-effect waves-light btn-xs m-l-2 m-b-5" style="margin-left: 5px;"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span><span><strong></strong></span></a>
												<?php } ?>
											</td>
										
											</tr>
											<?php } ?>
										
										</tbody>
									</table>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
		<?php echo form_close(); ?>
	</div> <!-- container -->                              
</div> <!-- content -->
 <div>
     
     <script>
        $(document).on('click','.view_type_button',function(){
            $('.view_type_button').removeClass('active');
            $(this).addClass('active');  
            var type = $(this).attr('data-index');
            if(type == 'Professor'){
                $('.professor_part').show();
                $('.assistant_part').hide();
            }
            else if(type == 'Assistant'){
                $('.professor_part').hide();
                $('.assistant_part').show();
            }
            
        })
     
         $(document).on('change','#start_date',function(){
                var data = $(this).val();
               
                $('#end_date').attr("min",data);
            })
     </script>
<?php if(isset($edit_course[0]) ) {?>  .
 <script type="text/javascript"> 
  $(document).ready(function(){ 
	$('#panel-modal').modal('show'); 
	});
	
</script>
<?php } ?>           
<script>


// apoorv 23/06/2020 
// $("#Class").on('change', function(e) {
//     // Get the class, semester and CourseID
//     let Class = document.querySelector('#Class');
//         Class = Class.options[Class.selectedIndex].value;
    
//     let Semester = document.querySelector('#Semester');
//         Semester = Semester.options[Semester.selectedIndex].value;
        
//     let CourseID = document.querySelector('#CourseID');
//         CourseID = CourseID.substr(0, 3);
//         CourseID = CourseID.toUpperCase();
        
//     $.ajax({
//     		type: "POST",
//     		url: '<?php echo base_url('admin/Master/checkCourseInMaster');?>',
//     		data: {Class, Semester, CourseID},
    	
//     		success: function(data){
    		   

//     		}
// 		});
    
    
// });
// end of apoorv


// By Prabhat 04-11-2020
 $(document).on('click','.date_type',function(){
     var data = $(this).val();
     if(data == 'tbd')
     {
         $('.tbd_type').show();
         $('.start_type').hide();
     }
     else
     {
         $('.tbd_type').hide();
         $('.start_type').show();
     }
 })
// End Prabhat 04-11-2020

// javascript apoorv 2/06/2020
 //get data for delete record
         $('.item_delete').on('click',function(){
            var CourseID = $(this).data('courseid');
            
            $('#Modal_Delete').modal('show');
            $('#btn_delete').attr('href', "<?=base_url('')?>admin/Registrar/deleteCourselist/" + CourseID);
            $('[name="courselist_delete"]').val(CourseID);

        });
// end of apoorv
$('#Terms').on('change',function(){
	var term=$(this).val();
	if(term!=''){
	$.ajax({
				type: "POST",
				url: '<?php echo base_url('admin/Master/getCourseByTerm');?>',
				data: { 'term':term},
				dataType: "html",
				success: function(data){
				$('#Course').html(data);
				},
		});
	}
});
$("#Semesters").on("change",function(){
	
	var classname =$("#Class").val();
	var semester = $(this).val();
		if(classname!='' && semester!=''){
		$.ajax({
				type: "POST",
				url: '<?php echo base_url('admin/Master/getCourseByClassSemester');?>',
				data: { 'classname':classname,'semester':semester},
				dataType: "html",
				success: function(data){
				    console.log(data);
				$('#Course').html(data);
				},
		});
	}
});
$(document).on("click","#add_btn",function(){
	$('.courselist').val('');
	$('.edit_course_id').val('');
	$('#p_name').html('');
	$(".myCheck"). prop("checked", false);
	$(".teaching_checkbox"). prop("checked", false);
	$('#assistant_span').html('');
	

});

</script>
<script>


$('#audit_rate').on('keyup', function(e) {
    
    
    let tution  = document.getElementById('audit_rate');
    if(isNaN(tution.value)) {
        alert("Only numbers are allowed");
        <?php if(isset($edit_course[0]['audit_rate'])): ?>
            tution.value = <?php echo $edit_course[0]['audit_rate']; ?>
        <?php else: ?>
            tution.value = "";
        <?php endif; ?>
    } else {
        let decimalTution = parseFloat(tution.value);
        if(countDecimals(decimalTution) > 2) {
            var truncated = Math.floor(decimalTution * 100) / 100; // = 5.46
            tution.value = truncated;
        }
    }
    
 });


 // apoorv 20/6/2020
  function countDecimals(value) {
    if(Math.floor(value) === value) return 0;
    return value.toString().split(".")[1].length || 0; 
    }



 $('#tution').on('keyup', function(e) {
    
    
    let tution  = document.getElementById('tution');
    if(isNaN(tution.value)) {
        alert("Only numbers are allowed");
        <?php if(isset($edit_course[0]['tution'])): ?>
            tution.value = <?php echo $edit_course[0]['tution']; ?>
        <?php else: ?>
            tution.value = "";
        <?php endif; ?>
    } else {
        let decimalTution = parseFloat(tution.value);
        if(countDecimals(decimalTution) > 2) {
            var truncated = Math.floor(decimalTution * 100) / 100; // = 5.46
            tution.value = truncated;
        }
    }
    
 });
 // end of apoorv
 function displayother(value){
	 var couse_text = $("#Course option:selected").text();
	if(value=='2'){
		$('#other').show();
		$('input[name=other]').removeAttr('disabled');
		$('#CourseTitle').val();
	}else{
		$('#other').hide();
		
		$('input[name=other]').prop('disabled','disabled');
		res = couse_text.split("-");
		$('#CourseTitle').val(res[1]);
	}
 }
 
 function check_data()
 {      
     //alert($("#courselistform input:checkbox:checked").length);
        if ($('input[name="Professor_id[]"]:checked').length > 0 || $('#External_Professor').val() != '')
        {
            return true;
        }
        else
        {
            alert("Please Select Atleast One Professor");
          return false;
        }
     
 }
 
 $(document).on('change','#Professor',function(){
      var selectedText = $("#Professor option:selected").html();
      $('#Professor_name').val(selectedText);
 })
 
</script>