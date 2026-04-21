<style>
   .outter_div {
        position: relative;
        top: -26px;
    }   
</style>
<div class="content-page">
<!-- Start content -->
<div class="content">
	<div class="container">

		<!-- Page-Title -->
		<!--div class="row">
			<div class="col-sm-12">
			<h4 class="pull-left page-title">Applications</h4>
			</div>
		</div-->
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
                        <div class="row">
                            <div class="col-md-2"></div>
                             <form action='<?= base_url('formbuilder/Application/bulk_delete_user_data') ?>' method='post' id="frmTest">
                            <div class="col-md-6 col-sm-8 col-xs-6" style="z-index: 99;">
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                <div class='text-center manage_view_index'>
                                    <input type='submit' class='btb btn-danger btn-sm' onclick='return delete_record()' value='Delete'>
                                    <a href='<?= base_url('formbuilder/Application/deleted_record') ?>' target="_blank"><span class='btn btn-success btn-sm'>Deleted Record</span></a>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 outter_div">
                                    <table class="table table-striped table-bordered datatable">
                                        <thead>
                                            <tr>
                                                <th style='width:20px !important;'><input type='checkbox' id='checkall'></th>
                                                <th>S.NO</th>
                                                <th>APPLICATION ID</th>
                                                <th>STUDENT NAME</th>
                                                <th>Forms</th>
                                                <th>Application Date</th>
                                                <th>Action</th>
                                                <th></th>
                                            </tr>
                                        </thead>							 
                                        <tbody> 						
                                        <?php 
                                        $count = 0;
                                        //echo '<pre>'; print_r($apps); die;
                                        if(!empty($apps)){
                                        foreach($apps as $app){
                                            $count++;
                                            //$controller = get_controller($app['scheme_id']);
                                            $application_code = $app['application_code'];
                                            
                                            $scheme_id=$app['scheme_id'];
                                            $component_id=$app['component_id'];
                                            
                                            $application_save_status = $app['save_status'];
                                            $component_details = get_componentsByID($app['component_id']);
                                            $datafield_details = getCustomFieldsActivename($component_id);
                                            //echo '<pre>'; print_r($datafield_details);
                                            
                                            $index =  array_search('name', array_map('strtolower', array_column($datafield_details, 'field_name')));
                                            if($index == ''){
                                                $index =  array_search('student full name', array_map('strtolower', array_column($datafield_details, 'field_name')));
                                                    if($index == ''){
                                                    $index =  array_search('first name', array_map('strtolower', array_column($datafield_details, 'field_name')));
                                                        if($index == ''){
                                                        	$index =  array_search('student name', array_map('strtolower', array_column($datafield_details, 'field_name')));
                                                            	if($index == ''){
                                                            		$index =  array_search('printed name', array_map('strtolower', array_column($datafield_details, 'field_name')));
                                                            		if($index == ''){
                                                            		$index =  array_search('1. last (family) name:', array_map('strtolower', array_column($datafield_details, 'field_name')));
                                                            	}
                                                            	}
                                                        }
                                                    }
                                            }
                                            
                                            
                                            //echo '<pre>'; print_r($index); die;
                                            
                                            $field_value=get_custom_fields_values_custom($app['application_code'], $datafield_details[$index]['field_id']);			
                                            
                                            
                                            ?>
                                            <tr>
                                                <td style='width:20px !important;'><input type='checkbox' name='delete_id[]' class='checkall1' value='<?php echo $app['application_code'] ?>'></td>
                                                <td><?=$count?></td>
                                                <td><?=$app['application_code']?></td>
                                                <td><?php echo ($field_value['field_value']);?></td>
                                                <td><?=$component_details[0]['scheme_component_name']?></td>
                                                <td><?=dd_mm_yyyy($app['created_date'])?></td>
                                                <?php /*
                                                <td> 
                                                if ($app['status_text']=='Approved'){echo '<label class="label label-success">'.$app['status_text'].' </label>'; 
                                                }elseif ($app['status_text']=='Pending'){echo '<label class="label label-warning">'.$app['status_text'].' </label>';
                                                }elseif ($app['status_text']=='Rejected'){echo '<label class="label label-danger">'.$app['status_text'].' </label>';
                                                }
                                                
                                                </td>
                                                */ ?>
                                                <td>
                                                
                                                <?php /*  
                                                <a href="<?=base_url('admin/FormBuilder/view_application/')?><?=encryptor('encrypt', $app['application_id'])?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5">
                                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                <span><strong>View</strong></span>            
                                                </a>
                                                
                                                <a href="<?=base_url('admin/FormBuilder/application/')?><?=encryptor('encrypt', $app['application_id'])?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                <span><strong>Edit</strong></span>            
                                                </a>  */?>
                                                <a href="<?=base_url('formbuilder/Forms/createPDF/')?><?=encryptor('encrypt', $app['application_id'])?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5" target="_blank">
                                                <i class="ion-document-text"></i>
                                                <span><strong>View PDF</strong></span>            
                                                </a>
                                                
                                                
                                                
                                                </td>
                                                <td>
                                                <i class='fa fa-trash confirm' rel_id="<?php echo $app['application_code'] ?>" style='color:red;cursor:pointer;'></i>
                                                </td>
                                            </tr>	
                                            <?php 
                                            
                                        }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                </form>
                            </div>
                        </div>
				    </div>
			    </div>			
		</div> <!-- End Row -->
	</div> <!-- container -->
			   
</div> <!-- content -->
<style>
.dataTables_length
{
    float:left ! important;
}
th, td {
     text-align: left;
}

</style>
          <script>
               $(document).on('click','.confirm',function(){
                    var rel_id = $(this).attr('rel_id');
                    $('#application_code').val(rel_id);
                    $('#delete_modal').modal('show');
                })
                
                $(document).on('click','#checkall',function(){
                    $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
                })
                
                function delete_record()
                {
                    var len = $('#frmTest input:checked').length
                    
                    if(len>0)
                    {
                        var data = confirm("Are you sure to delete record !");
                          if(data == true)
                          {
                           return true
                          }
                          else
                          {
                           return false;
                          }
                    }
                    else
                    {
                        alert('Select Atleast One Check Box');
                        return false;
                    }
                    
                }
                
                $(document).on('click','.stop_default_event',function(e){
                    e.preventDefault();
                })
                
          </script>
          
    <!-- Modal -->
  <div class="modal fade" id="delete_modal" role="dialog">
    <div class="modal-dialog modal-sm">
    
    <form method='post' action='<?= base_url('formbuilder/Application/delete_user_data') ?>'>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Alert Message</h4>
        </div>
        <div class="modal-body">
            <input type='hidden' name='application_code' class='form-control' id='application_code'/>
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
          <p>Really ! you want to delete this data.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
          <input type='submit' value='Yes'class='btn btn-success btn-sm'>
        </div>
      </div>
      </form>
    </div>
  </div>