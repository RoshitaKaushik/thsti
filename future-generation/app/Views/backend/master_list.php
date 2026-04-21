<?php //echo "<pre>";print_r($data);die; 

//echo "<pre>"; print_r(session()->get());
 ?>
<style>

.modalpopupsss{display:none;}



table.table.table-striped.table-bordered th, table.table.table-striped.table-bordered td,   table.table.table-striped.table-bordered td .form-control {
    font-size: 12px;
}
input#program_start11, input#program_end11, #special_start11, input#special_end11 {
   
    display: inline-block;
} 

.special_start-end-box span { 
    display: inline-block!important;
    width: 48%;
    box-sizing: border-box;
    border-right: 1px solid #ddd;
	padding: 7px 4px;
}
.waves-effect { min-width: 75px;}
.special_start-end-box span:nth-child(2) {
    border-right: none;
}
.special_start-end-box {
    padding: 0!important;
}
.special_start-end-box1 {
    padding: 7px 4px!important;
}
.table-striped>tbody>tr:nth-of-type(3n+1) {
    background-color: #eae9e9!important;
}
.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: transparent;
}

.table td.fit, 
.table th.fit {
    white-space: nowrap;
    width: 1%;
}

.required:after {
    content: ' *';
    color: red;
    font-weight: bold;
    font-size: 16px;
}
td {
    vertical-align: middle !important;
}
/*input.form-control {
    width: 100%;
    text-align: center;
}*/
.table td.fit, 
.table th.fit {
    white-space: nowrap;
    width: 1%;
}
.custom-panel {
    margin: 0 auto;
    background-color: transparent;
    border: none;
    border-radius: 2px;
    -webkit-box-shadow: none;
    box-shadow: none;
    transition: 0.3s;
    width: 100%;
    max-width: 250px;
}

.custom-panel:hover {
   -webkit-box-shadow: none;
    box-shadow: none;
}

.custom-panel-heading button {
    border: none;
}

.custom-panel-heading {
    border-bottom: none;
    width: 100%;
    color: #333;
    border-color: transparent;
    background-color: transparent;
}
.custom-panel-body {
    color: #333;
    background-color: transparent;
    padding: 1rem 0 1rem 0.5rem;
    height: 100%;
    width: 100%;
   max-width: 250px;
   overflow: hidden;
   text-overflow: ellipsis;
   
}

.custom-panel-textarea {
    border: 1px solid #eee;
    border-radius: 3px;
    padding: 0.4rem 0.2rem 0 0.2rem;
    height: 100%;
    width: 100%;
    max-width: 250px;
    resize: none;
}
.heading_td
{
    text-align:right ! important;
}
.text_td
{
    text-align:left ! important;
}
hr
{
    border-top: 1px solid #100f0f ! important;
    margin-bottom:5px ! important;
    margin-top:5px ! important;
}
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
    		<!-- Page-Title -->
    		<!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Master List</h4>
    			</div>
    		</div-->
    		
    		<?php if(session()->getFlashdata('msg') !=''){ 
		  if(session()->getFlashdata('msg')=='CourseID already exist duplicate CourseID not allowed' || session()->getFlashdata('msg')=='Record Already Exist'){
		?>
		<div class="alert alert-danger">
			<?php echo session()->getFlashdata('msg'); ?>
		</div>
		<?php } else { ?>
		<div class="alert alert-success">
			<?php echo session()->getFlashdata('msg'); ?>
		</div>
		<?php } }?>
		

    		
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
    					<div class="panel-heading">
    						<h3 class="panel-title">Master List
        						 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
            						<i class="ion-arrow-left-a"></i>
            						<span><strong>Go Back</strong></span>            
            					</a>
    						</h3>
    					</div>
              <br><br><br>
    					<div class="panel-body" style="height: 500px;">
    					    
    					   
    					    
    					    <div class="row">
                    <div class="col-md-3">
                       <label class="pull-right">Master List :</label>
                      
                    </div>
                     <div class="col-md-4">
                       <select class="form-control master_list" name="master_list" id="master_list"  required>
                        <option value="">Select Master </option>
                        <?php foreach ($get_master_list as $get_master_list_value) {

                          $master_data_value = $get_master_list_value['table_name'].','.$get_master_list_value['type'];
                          if($master_data_value== isset($master_selected_data)){
                            $selectd='selected';
                          }else{
                             $selectd='';
                          }

                         ?>
                          
                                  <option value="<?=$master_data_value?>" <?=$selectd?> ><?=$get_master_list_value['field_name']?></option>
                                 
                                <?php }?>
                              </select>
                      
                    </div>
                     <div class="col-md-5">
                      
                    </div>
    					            
    					    </div>

                  <br><br>

                  <div id="filter">

                  <?php  if(session()->get('data_array')){ 
                    echo '<button class="btn btn-success btn-md add_city pull-right" table="'.$table.'" type="'.$type_name.'" > Add '.$type_name.'</button> <br><br>';

                    ?>
                     <table  class="table  table-bordered   table-striped" id="alldataTable">
                          <thead>
                              <tr>
                                 <th>Description</th>
                                 <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                         <?php foreach ($selected_all_master_data as $datavalue) {
                            //echo $name_field;

                          // echo "<pre>";print_r($datavalue);
                          ?>
                            <tr><td><?=$datavalue[$name_field] ?></td>
                            <td><button class="btn btn-primary btn-xs edit_city" rel_id="<?= $datavalue[$id_field]?>" table="<?= $table?>" type="<?=$type_name?>" >Edit</button></td></tr>
                            
                         <?php } ?>

                    </tbody>
                      </table>


                  <?php } ?>
                </div>

                   <div class="row result" id="result">
                    
                  </div>

                 
    					    
    					</div>
    				</div>
    			</div>
    			
    		</div> <!-- End Row -->           
        </div> <!-- container -->
     
	</div> <!-- content -->
</div> <!-- content-page -->

 




  <script>
    $(document).on('change','.master_list',function(){
        var function_name = $(this).val();
         var url = "<?= base_url() ?>admin/Registration/getmasterdata";
        //alert(url);
         if(function_name==''){
          alert('Please Select Master ');
         }else{
          $.ajax({
                method: 'post',
                url: url,
                data: {"function_name":function_name,'<?= csrf_token() ?>' : '<?= csrf_hash() ?>'},
                dataType: 'html',
                success: function (response) {
                    //$('#edit_city').modal('show'); 
                    $('#result').html(response);
                    $('#filter').html('');
                     $('#alldataTable').DataTable({ 
                            "destroy": true, //use for reinitialize datatable
                            "pageLength": 25
                       });
            }
        
        })  
          // window.location = url;
         }
    })
</script>



<script>
    $(document).on('click','.edit_city',function(){
        var rel_id = $(this).attr('rel_id');
        var table = $(this).attr('table');
        var type = $(this).attr('type');
       /* alert(rel_id);
        alert(table);
        alert(type);*/
       var url = "<?= base_url() ?>/admin/Registration/get_detail_of_data";
        $.ajax({
                method: 'post',
                url: url,
                data: {'rel_id':rel_id,'table':table,'type':type,'<?= csrf_token() ?>' : '<?= csrf_hash() ?>'},
                dataType: 'html',
                success: function (response) {
                    $('#edit_city').modal('show');
                    $('#result_edit').html(response);

                   
            }
        
        })  
    })
</script>



<!-- Modal -->
  <div class="modal fade" id="edit_city" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update </h4>
        </div>
          <form method="post" action="<?= base_url('admin/Registration/update_master_data') ?>">
              <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
            <div class="modal-body">
             
             <div id="result_edit">
                 
             </div> 
          
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <input type="Submit" value="Save" class="btn btn-success">
        </div>
          </form>
      </div>
      
    </div>
  </div>



  <script>
    $(document).on('click','.add_city',function(){
        var rel_id = $(this).attr('rel_id');
        var table = $(this).attr('table');
        var type = $(this).attr('type');
       /* alert(rel_id);
        alert(table);
        alert(type);*/
       var url = "<?= base_url() ?>/admin/Registration/get_detail_of_add_data";
        $.ajax({
                method: 'post',
                url: url,
                data: {'rel_id':rel_id,'table':table,'type':type,'<?= csrf_token() ?>' : '<?= csrf_hash() ?>'},
                dataType: 'html',
                success: function (response) {
                    $('#add_city').modal('show');
                    $('#result_add').html(response);

                   
            }
        
        })  
    })
</script>


<!-- Modal -->
  <div class="modal fade" id="add_city" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add </h4>
        </div>
          <form method="post" action="<?= base_url('admin/Registration/add_master_data') ?>">
              <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
            <div class="modal-body">
             
             <div id="result_add">
                 
             </div> 
          
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <input type="Submit" value="Save" class="btn btn-success">
        </div>
          </form>
      </div>
      
    </div>
  </div>





