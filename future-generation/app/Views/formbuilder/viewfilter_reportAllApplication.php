<style>
    .col-md-4
    {
        margin-top:12px;
    }
</style>
<div class="content-page">
<!-- Start content -->
<div class="content">
	<div class="container">

		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
			<!--<h4 class="pull-left page-title">Applications</h4>-->
			</div>
		</div>
		  <?php if(session()->getFlashdata('msg') !=''){ ?>
			<?php echo session()->getFlashdata('msg'); ?>
	     <?php } ?>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-color panel-info">
					<div class="panel-heading">
						<h3 class="panel-title"><?=$page?></h3>
					</div>
					<div class="panel-body">
					    
                        <div class="col-md-12">
                            <div class="row">
                                <form id="filter" action="<?= base_url('formbuilder/Application/filter_data') ?>" method='post'>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-7">
                                        <div class="filter-sub-menu-outer-box">
                                            <div class="stop-noti-box">
                                                <li class="dropdown hidden-xs filter-li">
                                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-filter"></i>Filter <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                    </a>
                                                    
                                                    <ul class="dropdown-menu dropdown-menu-lg filter_ul">
                                                        <li class="text-center notifi-title">Filter</li>
                                                        <li class="list-group">
                                                            <div class="col-sm-12 filter_category">             
                                                                <div class="form-group">	    
                                                                    <div class="col-md-4">
                                                                        <label>Forms :</label>
                                                                        <select class="form-control filter_ajax component" name="component_id">
                                                                            <option value="">Please Select Form</option>
                                                                            <?php
                                                                                foreach($form_list as $ft)
                                                                                {
                                                                                    ?>
                                                                                    <option <?php if($select_component == $ft['id']){ echo "Selected"; } ?> value="<?php echo $ft['id'] ?>"><?php echo $ft['scheme_component_name'] ?></option>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                         <label>Application ID :</label>
                                                                         <input type='text' class='form-control filter_ajax' name='application_id' value="<?php echo $select_application ; ?>"/>
                                                                         <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                                                                     </div>
                                                                    <span id="credit"></span> 
                                                                </div>	
                                                            </div> 
                                                        </li>
                                                    </ul>
                                                    
                                                </li>
                                            </div>
                                            <li class="cell_spacing_li">
                                                <a href="#" data-target="#" title="Line Spacing" class="dropdown-toggle waves-effect waves-light spacing-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-arrows-v"></i><i class="fa fa-bars"></i> <!--<i class="fa fa-angle-down" aria-hidden="true">--></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-md spacing_ul">
                                                    <li class="list-group" style="margin-bottom:0px !important;">
                                                        <!-- list item-->
                                                        <span > 
                                                            <div class="single_spacing">
                                                                <i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-bars" aria-hidden="true"></i>
                                                                Single
                                                            </div>
                                                            
                                                            <div class="double_spacing">
                                                                <i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-bars" aria-hidden="true"></i>
                                                                Double
                                                            </div>
                                                        
                                                        </span> 
                                                    </li>
                                                </ul>
                                            </li>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
					    
					    
						<div class="row outter_div">
						    
							<div class="col-md-12 col-sm-12 col-xs-12" id='result'>
							    <?php
							     $this->load->view('templates/filter/filter_viewfilter_reportAllApplication', $data);
							    ?>
								 
							</div>
						
						</div>
					</div>
				</div>
			</div>			
		</div> <!-- End Row -->
	</div> <!-- container -->
		<!--Modal -->
        <!--Modal Approve-->
       <div class="modal fade" id="Modal_Approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <form method="post" action="<?= base_url('formbuilder/Application/signApplicationForm') ?>">
                             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                             <input type="hidden" name="status" value="approve">
                             <input type="hidden" name="formType" value="filter_data">

                             <input type="hidden" id="approve_application_id" name="approve_application_id">
                             <input type="hidden" id="approve_component_id" name="approve_component_id">
                             <input type="hidden" id="approve_application_code" name="approve_application_code">
                  </div>
                  <div class="modal-footer">
                    <button type="submit" id="btn_approve" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                  </div>
                  </form>
                </div>
              </div>
        </div>
         <div class="modal fade" id="Modal_Reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <form method="post" action="<?= base_url('formbuilder/Application/signApplicationForm') ?>">
                             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                             <input type="hidden" name="status" value="reject">
                             <input type="hidden" name="formType" value="filter_data">
                             <input type="hidden" id="reject_application_id" name="reject_application_id">
                             <input type="hidden" id="reject_component_id" name="reject_component_id">
                             <input type="hidden" id="reject_application_code" name="reject_application_code">
                        <div class="form-group">
                            <label>Enter a Reason</label>
                            <textarea required name="reason" rows="4" class="form-control" placeholder="Enter a reason"></textarea>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" id="btn_reject" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                  </div>
                  </form>
                </div>
              </div>
        </div>	   
</div> <!-- content -->


<style>
th, td {
     text-align: left;
}

</style>
<script>
    $(document).on('change','.component',function(){
        var form_id = $(this).val();
        if(form_id != 1)
        {
            $.ajax({
                url: '<?= base_url('formbuilder/Application/check_dropddown') ?>',
                data: ({ form_id: form_id }),
                dataType: 'json', 
                type: 'post',
                success: function(data) {
                    if(data != '')
                    {
                        var content = '';
                        $.each(data, function(k, v) {
                            content +="<div class='col-md-4'><label>"+v.field_name+"</label>";
                            var strArray = v.field_values.split(",");
                            content+="<select class='form-control filter_ajax' name='credit[]'>";
                            content+="<option value=''>Please Select</option>";
                            for(var i = 0; i < strArray.length; i++){
                                content+="<option value='"+strArray[i]+"'>"+strArray[i]+"</option>";                        
                            }
                            content+="</select></div>";
                            $('#credit').html(content); 
                        });   
                    }
                    else
                    {
                        $('#credit').html(' ');
                    }
                }             
            });
        }
            
    })

    $('.approve_btn').on('click', function() {
        var application_code = $(this).data('applicationcode');
        var application_id = $(this).data('applicationid');
        var component_id = $(this).data('componentid');
         $('#Modal_Approve').modal('show');
         $('[name="approve_application_code"').val(application_code);
         $('[name="approve_application_id"]').val(application_id);
         $('[name="approve_component_id"]').val(component_id);
    });
        //reject modal
    $('.reject_btn').on('click', function() {
        var application_code = $(this).data('applicationcode');
        var application_id = $(this).data('applicationid');
        var component_id = $(this).data('componentid');
        $('#Modal_Reject').modal('show');
        $('[name="reject_application_code"').val(application_code);
        $('[name="reject_application_id"]').val(application_id);
        $('[name="reject_component_id"]').val(component_id);
    });
    
    
    $(document).on('change','.filter_ajax',function(){
        if($('.component').val() != '')
        {
            filter_progress_loader();
        }
        else
        {
            $('#result').html('');
        }
    })
    
    $(document).on('keyup','.filter_ajax',function(){
        if($('.component').val() != '')
        {
            filter_progress_loader();
        }
        else
        {
            $('#result').html('');
        }
    })
    
    
    function form_submit_data()
    {
        var formname='';
        formname=$("#filter");
        var formData = new FormData($('#filter')[0]);
        formData.append("submit","filter");
        formData.append("<?php echo $this->security->get_csrf_token_name();?>","<?php echo $this->security->get_csrf_hash();?>");
        $.ajax({
            type:"POST",
            dataType:'html',
            url:'<?= base_url('formbuilder/Application/filter_formbuilder_form') ?>',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                $('#result').html(response);
                $('#viewfilter_reportDataTable').DataTable( {
                    aoColumnDefs : [ {
                    //orderable : false, aTargets : [4]        
                    }],
                    
                    "order": [],
                    "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
                    "pageLength": 50
                });
                
                $('input[name="selected_field[]"]:not(:checked)').each(function () {
                    var column_no = $(this).attr('rel_column_no');
                    var table = $('.datatable_th').DataTable();
                    var column = table.column(column_no);
                    // Toggle the visibility
                    column.visible(!column.visible());    
                });
            
            }
        });
    }
</script>