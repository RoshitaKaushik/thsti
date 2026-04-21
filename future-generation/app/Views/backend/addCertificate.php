<?php //echo "<pre>";print_r(session()->get());die;

$add_permission = false;
if(session()->get('profiles')){
	if(in_array(1, session()->get('profiles'))){
		$add_permission = true;
	}							
}elseif(session()->get('role') == 1){
	$add_permission = true;
}
    $post = session()->getFlashdata('post') ? session()->getFlashdata('post') : array();
	if(session()->getFlashdata('msg')!=''){
		echo session()->getFlashdata('msg');
		session()->remove('msg');
	}
	if(session()->getFlashdata('post')!=''){
        $post = session()->getFlashdata('post');
	}
?>


<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                 
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
}
#overlay { 
position: fixed; 
z-index: 5000; 
left: 0; 
top: 0; 
bottom: 0; 
right: 0; 
background: #000; 
opacity: 0.8; 
filter: alpha(opacity=80); 
} 
#loading { 
width: 50px; 
height: 57px; 
position: absolute; 
top: 50%; 
left: 50%; 
margin: -28px 0 0 -25px; 
} 
#overlay > p{ 
color:#FF9800; 
position: absolute; 
top: 60%; 
left: 49%; 
margin: -28px 0 0 -25px;} 


</style>     
<div class="content-page">
<!-- Start content -->
<div class="content">
	<div class="container">
		<?php if(session()->getFlashdata('msg') !=''){ ?>
		<div class="alert alert-success">
			<?php echo session()->getFlashdata('msg'); ?>
		</div>
		<?php } ?>
		<!-- Page-Title -->
		<?php echo form_open_multipart("admin/Master/submitCertificate"); ?>
						<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"> Add Certificate List
							<?php
							if($add_permission)
							{
							    ?>
							    <button  type = "button" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" data-toggle="modal" data-target="#panel-modal" ><span class="icon ion-plus-circled" aria-hidden="true">   ADD </span></button>
							    <?php
							}
							?>
							
							</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
									<div class="modal-dialog">
										<div class="modal-content p-0 b-0">
											<div class="row">
													<!-- Basic example -->
												<div class="col-md-12">
													<div class="panel panel-color panel-info">
														<div class="panel-heading"><h3 class="panel-title"> Certificate List </h3>
														</div>
															<div class="panel-body">
																<div class="col-md-12">								
																	<div class="form-group">
																	<input type="hidden" name="certID" value="<?php if(isset($edit_certificate[0]) ) { echo $edit_certificate[0]['certID']; } ?>" >
																		<label>Certicate No <span class="requires">*</span></label>
	                                                                    <input type="text" name="cert_no" id="cert_no" value="<?php if(isset($edit_certificate[0]['cert_no']) ) { echo $edit_certificate[0]['cert_no']; }else if(isset($post['cert_no'])){ echo $post['cert_no'];} ?>" class="form-control" placeholder="Enter Certificate No" maxlength="10" required>
																	</div>
																</div>
																<div class="col-md-12">	
																	<div class="form-group">
																		<label for="Active">Course Dates<span class="requires">*</span></label>																	
																		<input type="text" name="course_dates" id="course_dates" value="<?php if(isset($edit_certificate[0]['course_dates']) ) { echo $edit_certificate[0]['course_dates']; } else if(isset($post['course_dates'])){ echo $post['course_dates'];} ?>" class="form-control" placeholder="Enter Course Dates" maxlength="255" required>								
																	</div>
																</div>
																<div class="col-md-12">	
																	<div class="form-group">
																		<label for="Active">Professor<span class="requires">*</span></label>
																		<input type="text" name="Professor" id="Professor" value="<?php if(isset($edit_certificate[0]['Professor']) ) { echo $edit_certificate[0]['Professor'];} else if(isset($post['Professor'])){ echo $post['Professor'];} ?>" class="form-control" placeholder="Enter Professor" maxlength="255" required>								
																	</div>
																</div>
																
																<div class="col-md-12">	
																	<div class="form-group">
																		<label for="Active">Level<span class="requires">*</span></label>
																		<select name="grad_undergrad" id="grad_undergrad" class="form-control" required>
																		<option value="">Select Graduate/Undergradraduate</option>
																		
																		<option value="E" <?php if(isset($edit_certificate[0]['grad_undergrad'])){
																			echo($edit_certificate[0]['grad_undergrad']=='E' ? 'selected="selected"':'');
																		} else if(isset($post['grad_undergrad'])){ echo($post['grad_undergrad']=='E' ? 'selected="selected"':'');}?>>Continuing Education</option>
																		
																		<option value="G" <?php if(isset($edit_certificate[0]['grad_undergrad'])){
																			echo($edit_certificate[0]['grad_undergrad']=='G' ? 'selected="selected"':'');
																		} else if(isset($post['grad_undergrad'])){ echo($post['grad_undergrad']=='G' ? 'selected="selected"':'');}?>>Graduate</option>
																		<option value="U" <?php if(isset($edit_certificate[0]['grad_undergrad'])){
																			echo($edit_certificate[0]['grad_undergrad']=='U' ? 'selected="selected"':'');
																		} else if(isset($post['grad_undergrad'])){ echo($post['grad_undergrad']=='U' ? 'selected="selected"':'');}?>>Undergraduate</option>
																		
																		
																		</select>								
																	</div>
																</div>
																<div class="col-md-12">	
																	<div class="form-group">
																		<label for="Certificate_Name">Certificate Name <span class="requires">*</span></label>
																		<input type="text" class="form-control" id="CertName" name="CertName" placeholder="Enter Certificate Name" value ="<?php if(isset($edit_certificate[0]['CertName']) ) { echo $edit_certificate[0]['CertName'];} else if(isset($post['CertName'])){ echo $post['CertName'];} ?>" maxlength="255" required>
																	</div>
																</div>
																<div class="col-md-12">								
																	<div class="form-group">
																	<label>Diploma <span class="requires">*</span></label>
																    <select name="dipID" id="dipID" class="form-control">
																	<option value="">Select Diploma </option>
																	<?php if(!empty($diploma)){
																		foreach($diploma as $rows){
																			if(isset($post['dipID'])){
																			    $flag = ($post['dipID']==$rows['dipID'] ? 'selected="seleted"':'');
																			}else{
																			    if(isset($edit_certificate)){$flag = ($rows['dipID']==$edit_certificate[0]['DipID'] ? 'selected="selected"':'');}
																			}
																	 ?>
																	<option value="<?php echo $rows['dipID'];?>" <?php echo $flag??'';?>><?php echo $rows['dipName'];?></option>
																	<?php } }?>
																	</select>
																	</div>
																</div>
																<!-- By Prabhat 27-06-2020 -->
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Class <span class="requires">*</span></label>
                                                                        <select class="form-control" id="class" name="class" required>
                                                                            <option value="">Please Select Class</option>
                                                                            <?php
                                                                                foreach($class as $cl)
                                                                                {
                                                                                    $sec = "";
                                                                                    if(isset($edit_certificate[0]))
                                                                                    {
                                                                                        if($cl['Class'] == $edit_certificate[0]['class'])
                                                                                        {
                                                                                            $sec = "selected";
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                    <option <?= $sec ?> value="<?= $cl['Class'] ?>"><?= $cl['Class'] ?></option>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
																<div class="col-md-12">
																    <div class="form-group">
																        <label>Semester <span class="requires">*</span></label>
																        <select class="form-control" id="semester" name="semester" required >
																            <option value="">Please Select Semester</option>
																        </select>
																    </div>
																</div>
																<!-- Byy prabhat 27-06-2020 -->
																
																<div class="col-md-12">								
																	<div class="form-group">
																		<label>Active <span class="requires">*</span></label>
																		<select name="active" id="active" class="form-control" required>
																		<option value="1" <?php if(isset($edit_certificate[0]['active'])){
																			echo($edit_certificate[0]['active']=='1' ? 'selected="selected"':'');
																		}else if(isset($post['active'])){ echo($post['active']=='1' ? 'selected="selected"':'');}?>>Yes</option>
																		<option value="0" <?php if(isset($edit_certificate[0]['active'])){
																			echo($edit_certificate[0]['active']=='0' ? 'selected="selected"':'');
																		} else if(isset($post['active'])){ echo($post['active']=='0' ? 'selected="selected"':'');}?>>No</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-12">								
																	<div class="form-group">
																		<label>Tution <span class="requires">*</span></label>
																		<input type="text" class="form-control" id="tution" name="tution" placeholder="Enter Tution (0.00)" value ="<?php if(isset($edit_certificate[0]['tution']) ) { echo $edit_certificate[0]['tution']; }  ?>" required>
																	</div>
																</div>
																
																<div class="col-md-12">								
																	<div class="form-group">
																		<label>Credits</label>
																		<select class="form-control" name="Credits" id="Credits">
																		  <option>Select Credit</option>
																		  <option <?php if(isset($edit_certificate[0])) { if($edit_certificate[0]['Credits'] == 'N/A'){ echo "selected"; } } ?> value="N/A">N/A</option>
																		  <option <?php if(isset($edit_certificate[0])) { if($edit_certificate[0]['Credits'] == '0'){ echo "selected"; } } ?> value="0">0</option>
																		  <option <?php if(isset($edit_certificate[0])) { if($edit_certificate[0]['Credits'] == '1'){ echo "selected"; } } ?> value="1">1</option>
																		  <option <?php if(isset($edit_certificate[0])) { if($edit_certificate[0]['Credits'] == '2'){ echo "selected"; } } ?> value="2">2</option>
																		  <option <?php if(isset($edit_certificate[0])) { if($edit_certificate[0]['Credits'] == '3'){ echo "selected"; } } ?> value="3">3</option>
																		</select>
																		<!--input type="text" class="form-control num" id="Credits" name="Credits" placeholder="Enter Credits  " value ="<?php if(isset($edit_certificate[0]) ) { echo $edit_certificate[0]['Credits']; }  ?>" maxlength="2"  required-->
																	</div>
																</div>
																
															</div>	<!-- panel-body -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                <input type="submit" class="btn btn-success" name="submit" value="Save">
                                                            </div>
										</div> <!-- panel -->
											<?php echo form_close(); ?>
										</div> <!-- row-->
									</div>
											
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12" style="overflow-x:scroll;">
									<table id="alldataTable" class="table table-striped table-bordered alldataTable">
										<thead>
											<tr>
												<th>Certificate No</th>
												<th>Class</th>
												<th>Semester</th>
												<th>Course Dates</th>												
												<th>Professor</th>												
												<th>Level</th>
												<th>Certificate Name</th>	
                                                <th>Diploma</th>	
                                                <th>Active</th>
                                                <th>Credit</th>
                                                <th>Tution</th>
											    <th>Action</th>												 
											</tr>
										</thead>
										<tbody> 
											<?php 
										
											if(!empty($certificatelist)){
											foreach($certificatelist as $row) {
                                               $status = $row['active'];
											   if($status=='1'){
												   $msg='Yes';
											   }else{
												   $msg='No';
											   }
											   $dipname=getDiplomaName($row['DipID']);
											   $diploma = $dipname['dipName'];
											   
											   $grades = $row['grad_undergrad'];
											   if($grades=='G'){
												   $disp_msg='Graduate';
											   }else if($grades=='U'){
												   $disp_msg='Undergraduate';
											   }else if($grades=='E'){
												   $disp_msg='Continuing Education';
											   }else{
												   $disp_msg='';
											   }
											?>
											<tr>
											<td><?=$row['cert_no']?></td>	
											<td><?=$row['class']?></td>
											<td><?=$row['semester']?></td>
											<td><?=$row['course_dates']?></td>												
											<td><?=$row['Professor']?></td>	
                                            <td><?=$disp_msg?></td>
											<td><?=$row['CertName']?></td>
                                            <td><?=$diploma?></td>	
                                            <td><?=$msg?></td>
                                            <td><?=$row['Credits']?></td>
                                            <td><?=$row['tution']?></td>
											<td>
											    <?php
                        							if($add_permission)
                        							{
                        							    ?>
												
													<a href="<?=base_url('')?>admin/Master/addCertificate/<?=encryptor('encrypt', $row['certID'])?> " 	class="btn btn-info waves-effect waves-light btn-xs m-b-5">
														<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
														<span><strong>
														</strong></span>            
													</a>
													<a href="javascript:void(0);" title="Click To Delete"  	class="btn btn-danger waves-effect waves-light btn-xs m-b-5 rmv" data-urlm="<?=encryptor('encrypt', $row['certID'])?>">
															<span class="fa fa-trash-o" aria-hidden="true"></span>
															<span><strong></strong></span>            
													</a>
												  <?php
                        							}
                        							?>
												</td>
												
											</tr>
											<?php } }?>
										
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
<?php if(isset($edit_certificate[0]) ) {?>  
 <script type="text/javascript"> 
  $(document).ready(function(){ 
	    $('#panel-modal').modal('show'); 
	
	    var classname = "<?php echo $edit_certificate[0]['class']; ?>";
	    if(classname)  {
             $.ajax({
                 url:'<?=base_url()?>admin/Form/getSemester',
                 method: 'post',
                 data: {classname: classname, "<?= csrf_token() ?>": "<?= csrf_hash() ?>"},
                 //dataType: 'json',
                 success: function(response){
                   $('#semester').html(response);
                   let semester = document.querySelector('#semester');
                   for(let i = 0; i < semester.length; i++) {
                       if(semester.options[i].value == "<?php echo $edit_certificate[0]['semester']; ?>") {
                           semester.options[i].selected = true;
                       }
                   }
                 }
            });
	    }
    });
</script>

<?php } ?>   

<script>
// apoorv 20/6/2020
  function countDecimals(value) {
    if(Math.floor(value) === value) return 0;
    return value.toString().split(".")[1].length || 0; 
    }

 $('#tution').on('keyup', function(e) {
    
    
    let tution  = document.getElementById('tution');
    if(isNaN(tution.value)) {
        alert("Only numbers are allowed");
        <?php if(isset($edit_certificate[0]['tution'])): ?>
            tution.value = <?php echo $edit_certificate[0]['tution']; ?>
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
$('#Term').on('change',function(){
	var term=$(this).val();
	if(term!=''){
		

 $.ajax({
				type: "POST",
				url: '<?php echo base_url('admin/Master/getCourseByTerm');?>',
				data: { 'term':term},
				dataType: "html",
				success: function(data){
				$('#Course').html(data);
				
					/* data = JSON.parse(data);
					alert(data.msg);
					$('#Class'+id).prev().html(studentclass).addClass('show').removeClass('hide');
					$('#Sex'+id).prev().html(sex_text).addClass('show').removeClass('hide');
					$('#Region'+id).prev().html(region_text).addClass('show').removeClass('hide');
					$('#Note'+id).addClass('hide').removeClass('show');
					$(ev).addClass('hide').removeClass('show');
					$('#edit-student'+id).addClass('show').removeClass('hide');
					$('#cancel-student'+id).addClass('hide').removeClass('show');
					if(data.last_id != '') {
						$('#student_rowid'+id).val(data.last_id);
						$('.tbl-body-student-info').append(new_row);
					} */
					

					
				},
		});
	}
});

</script>
<script>
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
 
 $(document).on("click", ".rmv", function() { 

		var anim = this.getAttribute("data-urlm"); 
		
		var current = this; 

		if(confirm('Are you sure, Want to Delete this record?')){ 
			loading(); 
			$.ajax({ 
				type: "POST", 
				url: "<?=base_url()?>" + "admin/Master/delCertificate",  
				data: {toBeChange: anim}, 
				success: function(res){ 
					//alert(res); 
					console.log(res); 
					$('#overlay').remove(); 
					if(res != 'OK' || res.length <= 0 || res == null){ 
					alert('Something went wrong'); 
					}else{
						
					alert('Deleted Successfully');
					location.reload(); 
					} 
				} 
			}); 

		} 
	}); 
	
	 function loading() { 
	// add the overlay with loading image to the page 
	var over = '<div id="overlay">' +
	'<p>Please Wait...</p></div>'; 
	$(over).appendTo('body'); 
	} 
	
	$(document).on('change','#class',function(){
	    var classname = $(this).val();
	     $.ajax({
             url:'<?=base_url()?>admin/Form/getSemester',
             method: 'post',
             data: {classname: classname},
             //dataType: 'json',
             success: function(response){
               $('#semester').html(response);
             }
           });
	})
 
</script>