
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->         
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
}
.filter_ul{
    left: 0px;
    width: 400px;
}
.notifi-title{
    padding: 5px 8px 10px;
}
</style> 
             
<div class="content-page">
<!-- Start content -->
<div class="content">
	<div class="container">
		<?php if (session()->getFlashdata('msg') && gettype(session()->getFlashdata('msg')) == 'array') { $msg = session()->getFlashdata('msg'); ?>
		<div class="uploadvesslelog alert <?php if($msg['status']){ echo 'alert-success';}else{ echo 'alert-danger';} ?>">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<?php print $msg['message']; ?>
		</div>
		<?php } ?>
		
		<div class="row">
			<div class="">
				<div class="panel panel-info panel-color">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-5">
                                <h3 style="display:inline;" class="panel-title">Attendance List <?php if(isset($empdetails)){
                                	echo $emp_fullname = "(".$empdetails['FirstName']." ".$empdetails['LastName'].")";
                                }?> </h3>    
                            </div>
                            <div class="col-md-7">
                                <li class="dropdown hidden-xs filter-li">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light filter-btn-box" data-toggle="dropdown" aria-expanded="false" style="padding: 6px;border-radius: 2px;">
                                        <i class="fa fa-filter"></i>Filter <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </a>
                                    
                                    <ul class="dropdown-menu dropdown-menu-lg filter_ul">
                                        <li class="text-left notifi-title"><b>Filter</b></li>
                                        <li class="list-group">
                                           <!-- list item-->
                                           <form action="<?= base_url('admin/Reports/filter_another_timesheet') ?>" id="filter_timesheet_form">
                                                <div class="col-sm-12 filter_category"> 
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="control-label">From : </label>
                                                                    <input class="form-control datepicker"  placeholder="begin Date" name="BeginDate" type="text" value="">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="control-label">To : </label>
                                                                    <input class="form-control datepicker"  placeholder="end Date" name="EndDate" type="text" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-md-12">
                                                    <div class="row"> <hr>
                                                        <div class="col-md-12 text-right">
                                                            <span class="btn btn-success btn-xs filter_data" style="margin-bottom:10px;">Filter</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </div>
                        </div>
                    </div>
					
					
					<div class="panel-body" id="transaction_result">
						<?php echo view('templates/filter/filter_another_transaction',$data);	?>
					</div>
				</div>
			</div>
			
		</div> <!-- End Row -->
	</div> <!-- container -->                              
</div> <!-- content -->
</div>
<script>
$(document).on('click', "#all_attendance", function(){
	$('.curr_div').removeClass('hide').addClass('show');
	$('.contract_details').removeClass('hide').addClass('show');
	$('#all_attendance_hide').removeClass('hide').addClass('show');
	$('#all_attendance').removeClass('show').addClass('hide');
});

$(document).on('click', "#all_attendance_hide", function(){
	$('.contract_details').removeClass('show').addClass('hide');
	$('#all_attendance').removeClass('hide').addClass('show');
	$('#all_attendance_hide').removeClass('show').addClass('hide');
	$('.curr_div').removeClass('show').addClass('hide');
});
</script>
<script>
	$( document ).ready(function() {
		var hideValue = false;
		<?php
			if(!empty($elseFlag)){ ?>
				hideValue = true;
		<?php	} ?>
		//alert(hideValue);
		if(1==1){
			$("#orphanSpan").remove();
			$("#OrphanSection").remove();
		}
	});
	

</script>
               