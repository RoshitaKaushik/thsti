<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        width: auto;
    }
    .dataTables_info{ 
        display:none;
    }
    .table>tbody>tr>td{
        vertical-align: middle !important;
    }
    .modal-header{
        padding:9px 2px !important;
    }
    input[type=file] {
        display: block;
        padding: 3px 4px;
        height: 30px;
    }
    .label_control{
        margin-top: 10px;
    }
    .modal .modal-dialog .modal-content .modal-body {
        padding: 2px 2px;
    }
    
    #snackbar {
      visibility: hidden;
      min-width: 250px;
      margin-left: -125px;
      background-color: #333;
      color: #fff;
      text-align: center;
      border-radius: 2px;
      padding: 16px;
      position: fixed;
      z-index: 10000;
      left: 50%;
      bottom: 30px;
      font-size: 17px;
    }
    
    #snackbar.show {
      visibility: visible;
      /*-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;*/
      /*animation: fadein 0.5s, fadeout 0.5s 2.5s;*/
    }
    
    @-webkit-keyframes fadein {
      from {bottom: 0; opacity: 0;} 
      to {bottom: 30px; opacity: 1;}
    }
    
    @keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
    }
    
    @-webkit-keyframes fadeout {
      from {bottom: 30px; opacity: 1;} 
      to {bottom: 0; opacity: 0;}
    }
    
    @keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
    }
    
</style>

<div class="content-page">
    <div class="content">
    	<div class="container">
    	    <div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info" style="background: transparent !important;">
						<div class="panel-heading">
							<h3 class="panel-title">Signature</h3>
						</div>
						<div class="panel-body">
						    
                            <div class="col-md-12">
                                <table id="alldataTable2" class="table datatable_th table-striped table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Name</th>
                                            <th>Signature</th>
                                            <th>location</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sno=1; foreach($records as $record){ ?>
                                        <td><?= $sno++; ?></td>
                                        <td><?= $record['sign_name'] ?></td>
                                        <td><a href="<?php echo base_url()."/".$record['sign_image_path'] ?>" target="_blank"><img src='<?php echo base_url()."/".$record['sign_image_path'] ?>' style="width:150px;height:50px;"></a></td>
                                        <td><?= $record['location'] ?></td>
                                        <td>
                                            <span class="btn btn-primary btn-xs upload_signature_button" relll="<?= $record['signature_id'] ?>" rel_name="<?=  $record['sign_name'] ; ?>" rel_file_name="<?= encryptor('encrypt', $record['sign_image_path']); ?>" rel_id="<?= encryptor('encrypt', $record['signature_id']); ?>" rel_location="<?= $record['location'] ; ?>">Edit</span>
                                        </td>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>	
                                
                             <div id="snackbar">Alert Message</div>    
						</div>
					</div>
				</div>	
			</div>
    	</div>
    </div>
</div>

<script>
    $(document).on('click','.upload_signature_button',function(){
        $('.sign_id').val('');
        $('.sign_name').val('');
        $('.old_file_path').val('');
        
        let id = $(this).attr('rel_id');
        let name = $(this).attr('rel_name');
        let oldFileName = $(this).attr('rel_file_name');
        let rel_location = $(this).attr('rel_location');
        
        $('#location_name').html("("+rel_location+")");
        $('.sign_id').val(id);
        $('.sign_name').val(name);
        $('.old_file_path').val(oldFileName);
        
        $('#uploadSignatureModal').modal('show');
    })
    
    $(document).on('click','.updateSignatureDetail',function(){
        $('#snackbar').html('')
        let sign_id = $('.sign_id').val();
        let name = $('.sign_name').val();
        let oldFileName = $('.old_file_path').val();
        var fileInput = $('#sign_file').val();
        if(fileInput == '' && oldFileName == ''){
            $('#snackbar').html("Please Upload Signature.");
            $('#snackbar').addClass('show');
            setTimeout(function() {
                $("#snackbar").removeClass('show');
            }, 
            3000);
            return false;
        }
        if(sign_id == ''){
            $('#snackbar').html("Signature Id is required.");
            $('#snackbar').addClass('show');
            setTimeout(function() {
                $("#snackbar").removeClass('show');
            }, 
            3000);
            return false;
        }
        if(name == ''){
            $('#snackbar').html("Signature Name is required.");
            $('#snackbar').addClass('show');
            setTimeout(function() {
                $("#snackbar").removeClass('show');
            }, 
            3000);
            return false;
        }
        var formData = new FormData(document.getElementById('upload_signature_form'));
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Master/updateSignatureDetail');?>',
            contentType: false,
            processData: false,
            data: formData,
            dataType: "json",
            success: function(data){
                $('#snackbar').html(data.msg);
                $('#snackbar').addClass('show');
                setTimeout(function() {
                    $("#snackbar").removeClass('show');
                }, 
                3000);
                $('#uploadSignatureModal').modal('hide');
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR.responseText)
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                $('#snackbar').html(msg);
                $('#snackbar').addClass('show');
                setInterval(function() {
                    $("#snackbar").removeClass('show');
                }, 
                4000);
                $('#uploadSignatureModal').modal('hide');
            }
        });
        
    })
</script>


<div id="uploadSignatureModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
      
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Upload Signature <span id="location_name"></span></h4>
        </div>
        <form id="upload_signature_form" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" readonly class="form-control sign_id" name="sign_id">
                        <label class="label_control">Name</label>
                        <input type="text" class="form-control sign_name" name="sign_name">
                    </div>
                    <div class="col-md-12">
                        <label class="label_control">File</label>
                        <input type="file" class="form-control" name="sign_file" id="sign_file">
                        <input type="hidden" readonly class="form-control old_file_path" name="old_sign_file">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success updateSignatureDetail">Update</button>
            </div>
        </form>
    </div>

  </div>
</div>

