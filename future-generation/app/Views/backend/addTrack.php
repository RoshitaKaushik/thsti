
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                 
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
}
.modal .modal-dialog .modal-content .modal-header
{
    padding:0px ! important;
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
    		?>
		
						<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Track List
							<div class="btn-group tab_btn_gourp" role="group" aria-label="Basic example" style="margin-left:20px">               
                                <button type="button" data-index="All" class="btn view_type_button active">All</button>
                                <button type="button" data-index="Active" class="btn view_type_button">Active</button>
                                <button type="button" data-index="Inactive" class="btn view_type_button">Inactive</button>
                            </div>
							
							<button  type = "button" id="add_track" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right"><span class="icon ion-plus-circled" aria-hidden="true">   ADD </span></button>
							
							</h3>
						</div>
						<div class="panel-body">
						
								
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						
						
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12" id="result">
									<?php echo view('templates/filter/filter_addTrack'); ?>
								</div>
							</div>
						
					</div>
				</div>
			</div>
			
			
	</div> <!-- container -->                              
</div> <!-- content -->
 <div>
     
<script>
    $(document).on('click','#add_track',function(){
        $('#track_id').val('');
        $('#track_name').val('');
        $('#track_status').val('1');
        $('#add_track_modal').modal('show');
    })
    
    $(document).on('click','.edit_track',function(){
        var track_id = $(this).attr('rel_id');
        var track_name = $(this).attr('rel_name');
        var status = $(this).attr('rel_status');
        $('#track_id').val(track_id);
        $('#track_name').val(track_name);
        $('#track_status').val(status);
        $('#add_track_modal').modal('show');
    })
    
    $(document).on('click','.submit_button',function(){
        var track_name = $('#track_name').val();
        if(track_name ==  '')
        {
            alert("Track Name Required");
            $('#trace_name').focus();
        }
        else
        {
            $('#track_form').submit();
        }
    })
    
    $(document).on('click','.view_type_button',function(){
        $('.view_type_button').removeClass('active');
        $(this).addClass('active');  
        filter_progress_loader();
    })
    
    function form_submit_data()
    {
        var tab_type = $('button.btn.view_type_button.active').attr('data-index');
        $.ajax({
            type:"POST",
            dataType:'html',
            url:'<?= base_url() ?>admin/Master/filter_addTrack',
            data: {tab_type:tab_type,submit:'submit'},
            success: function(response){   
                $('#result').html(response);
                $('#alldataTable2').DataTable( {
                    "order": [],
                    "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            		"pageLength": -1
                } );
            }
        });
        
    }
</script>


<div class="modal fade" id="add_track_modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form method="post" action="<?= base_url('admin/master/submit_track_details') ?>" id="track_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Track</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="hidden" class="form-control" name="track_id" id="track_id">
                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                    <label class="label-control">Track Name</label>
                                    <input type="text" required class="form-control" id="track_name" name="track_name" placeholder="Enter Track Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="label-control">Status</label>
                                    <select class="form-control" name="status" id="track_status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success btn-xs submit_button">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
 
 