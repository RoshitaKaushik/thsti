<?php //echo "<pre>";print_r($this->session->userdata());
$access = getAccess(1);
//echo "<pre>";print_r($access);die; 
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== --> 
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
}
.table>thead>tr>th {
width: 4% !important;
}
</style>                     
<div class="content-page">
<!-- Start content -->
<div class="content">
	<div class="container">
		<?php if (session()->getFlashdata('msg')) { $msg = session()->getFlashdata('msg'); ?>
		<div class="uploadvesslelog alert <?php if($msg['status']){ echo 'alert-success';}else{ echo 'alert-danger';} ?>">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<?php print $msg['message']; ?>
		</div>
		<?php session()->remove('msg');  } ?>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info panel-color">
					<div class="panel-heading">
						<h3 class="panel-title">Future Generations University 	

							<?php if($access['add_access']) { ?>
							<!--<a href=<?=base_url('admin/Form')?> class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
								<i class="icon ion-plus-circled"></i>	
								<span><strong>Add New</strong></span>            
							</a> -->
							<?php } ?>
						</h3>
					</div>
					<div class="panel-body">
						<?php
							/*echo "<pre>";
							print_r($dataArr);*/ 
						?>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<?php 
								$attr = array('id' => 'filterform');
								echo form_open_multipart("admin/Form/ViewAppList", $attr); 
								?>
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th></th>
											<?php foreach ($classList as $key => $row):?>
												<th><?=$row['Class']?></th>
											<?php endforeach; ?>	
										</tr>
									</thead>
									<tbody id="table-body"> 
										<?php foreach ($gradeList as $key => $row):?>
										<tr>
											<th><?=$row['Grade']?></th>
											<?php $classCount = 0; foreach ($classList as $classkey => $val):?>
												<th><input type="text" name="grade_<?=$row['ROWID']?>_<?=$val['ROWID']?>" class="form-control" onblur='InsertGrade("<?=$row['Grade']?>_<?=$val['Class']?>_<?=$row['ROWID']?>_<?=$val['ROWID']?>")' 
													value="<?=getDataGrade($row['Grade'],$val['Class']);?>" >
													<input type="hidden" name="old_<?=$row['ROWID']?>_<?=$val['ROWID']?>" 
													value="<?=getDataGrade($row['Grade'],$val['Class']);?>" >

												</th>
											<?php endforeach; ?>	
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
								<?php echo form_close(); ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div> <!-- End Row -->
	</div> <!-- container -->                              
</div> <!-- content -->

<!-- confirmation modal -->
<div id="ConfirmModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Confirmation</h4>
      </div>
      <div class="modal-body">
      	<input type="hidden" id="gradeID">
      	<input type="hidden" id="classID">
      	<input type="hidden" id="GradeValue">
      	<input type="hidden" id="feildName">
        <p>Are you sure to insert/update the value?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="ConfirmNProceed()">Yes</button>
      </div>
    </div>

  </div>
</div>
<!-- confirmation modal -->

<script>
function checkfilter(){
	var FirstName = $('input[name="FirstName"]').val();
	var LastName = $('input[name="LastName"]').val();
	var Spouse = $('input[name="Spouse"]').val();
	var Company = $('input[name="Company"]').val();
	
	if(FirstName == '' && LastName == '' && Spouse == '' && Company == '') {
		alert('Please enter any one filter');
		return false;
	}	
	return true;	
}
</script>
<script>
$(document).on('keyup', '.filter', function(){
	//alert('fffff');
	var FirstName = $('input[name="FirstName"]').val();
	var LastName = $('input[name="LastName"]').val();
	var Spouse = $('input[name="Spouse"]').val();
	var Company = $('input[name="Company"]').val();
	
	//if(FirstName != '' || LastName != '' || Spouse != '' || Company != '') {
		baseurl = '<?php echo base_url(); ?>';
		$.ajax({
			async: false,
			type: "POST",
			url: baseurl + "admin/Form/studentFilter",
			dataType: 'json',
			data: new FormData($("#filterform")[0]),
			processData: false, 
			contentType: false, 
			success: function(res){
				
				if(res.status == 'true'){
					$("#table-body").find("tr:gt(0)").remove();
					html = '';
					//$('#table-body').html('');
					var total_records = 0;

					$.each(res.data, function (key, item) {
						total_records++;
						if(item.Spouse== null){
							item.Spouse= '';
						}
						if(item.Company== null){
							item.Company= '';
						}
						html += '<tr><td ><a href="'+baseurl+'admin/Form/ViewApp/'+item.ID+'" class="btn btn-success waves-effect waves-light btn-xs m-b-5"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><span><strong>Open</strong></span> </a></td><td >'+item.FirstName+'</td><td >'+item.LastName+'</td><td >'+item.Spouse+'</td><td >'+item.Company+'</td></tr>';
					});
					
					$('#total_records').html('Total Records : '+total_records);
					$('.pagination').css('display', 'none');
					$('#table-body').append(html);
					
				}else{
					$('#total_records').html('Total Records : 0');
					$('.pagination').css('display', 'none');
					//$('#table-body').html('');
					 $("#table-body").find("tr:gt(0)").remove();
				}				
			},
			error:function(res){
				//location.reload();
			}
		});
	/* }else{
		alert('hhhh');
	} */
});

function InsertGrade(data){
	var arr = data.split('_'); 
	var gradeID = arr[0];
	var classID = arr[1];
	var cid = arr[2];
	var gid = arr[3];
	var GradeValue = $("input[name=grade_"+cid+"_"+gid+"]").val();
	var OldGradeValue = $("input[name=old_"+cid+"_"+gid+"]").val();
	var feildName = "input[name=grade_"+cid+"_"+gid+"]";
	if(GradeValue.trim()!=OldGradeValue.trim()){
		$('#ConfirmModal').modal('show');
		$("#gradeID").val(gradeID);
		$("#classID").val(classID);
		$("#GradeValue").val(GradeValue);
		$("#feildName").val(feildName);
	}
}
function ConfirmNProceed(){
	var gradeID = $("#gradeID").val();
	var classID = $("#classID").val();
	var GradeValue = $("#GradeValue").val();
	var feildName = $("#feildName").val();
	var oldfeild = feildName.replace(/grade/g, "old");
	$.ajax({
		url:"<?=base_url('admin/Users/saveClassMaster')?>",
		method:'GET',
		data:{gradeID:gradeID, classID:classID, GradeValue:GradeValue},
		success:function(resp){
			$(feildName).css('background','rgb(124,252,0, 0.4)');
			$(oldfeild).val(GradeValue);
		}
	});
}
</script>
