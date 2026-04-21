<?php //echo "<pre>";print_r($data);die; 

//echo "<pre>"; print_r($this->session->userdata());
 ?>
 <!--script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script-->
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
.text_design
{
    text-align:right;
}
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
    		<!-- Page-Title -->
    		<!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Static Pages </h4>
    			</div>
    		</div-->
    		
    		
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
    					<div class="panel-heading">
    						<h3 class="panel-title">Page
        						 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
            						<i class="ion-arrow-left-a"></i>
            						<span><strong>Go Back</strong></span>            
            					</a>
    						</h3>
    					</div>
    					<div class="panel-body">
    					    <div class="col-md-12">
    					        <form id="form1" method="post">
    					        <div class="form-group">
    					            <div class="row">
        					            <div class="col-md-1"></div>
        					            <div class="col-md-2 text_design">
        					                <label>Type  :</label>
        					             </div>
        					             
        					             <div class="col-md-7">
        					                 <select class="form-control" name="type" id="type">
        					                     <option value="">Please Select Type</option>
        					                     <?php
        					                      foreach($email_templete as $et)
        					                      {
        					                          ?>
        					                          <option value="<?= $et['id'] ?>"><?= $et['type_name'] ?></option>
        					                          <?php
        					                      }
        					                     ?>
        					                 </select>
        					             </div>
        					             <div class="col-md-2"></div>
        					        </div>
    					        </div>
    					        
    					       
    					        <div class="form-group">
    					            <div class="row">
        					            <div class="col-md-1"></div>
        					            <div class="col-md-2 text_design">
        					                <label>Description :</label>
        					             </div>
        					            
        					             <div class="col-md-7">
        					                 <textarea name="description" id="description"></textarea>
        					             </div>
        					             <div class="col-md-2"></div>
        					        </div>
    					        </div>
    					        <div class="form-group">
    					            <div class="row">
        					            <div class="col-md-3"></div>
        					            
        					             <div class="col-md-7 text_design">
        					                 <input type="button" class="btn btn-success save_data" value="Save">
        					             </div>
        					             <div class="col-md-2"></div>
        					        </div>
    					        </div>
    					        </form>
    					        
    					    </div>
    					</div>
    				</div>
    			</div>
    			
    		</div> <!-- End Row -->           
        </div> <!-- container -->
     
	</div> <!-- content -->
</div> <!-- content-page -->

  


<script>
        CKEDITOR.replace( 'description' );
        
$(document).on('change','#type',function(){
    var templete_id = $(this).val();
    
    $.ajax({
         url:'<?= base_url('admin/Registration/get_static_page_detail') ?>',
         method: 'post',
         data: {templete_id: templete_id},
         dataType: 'json',
         success: function(response){
           
           CKEDITOR.instances['description'].setData(response[0]['description']);
         }
       });
    
})

$(document).on('click','.save_data',function(){
     var formname = $("#form1");
     var description = CKEDITOR.instances['description'].getData();
     var type = $('#type :selected').val();
   
     var submit = "submit";
     if(type==''){
        alert('Please Select Type');

     }else{


    $.ajax({
         url:'<?= base_url('admin/Registration/update_static_data_detail') ?>',
         method: 'post',
         data: {description,type,submit},
         dataType: 'html',
         success: function(response){
            if(response)
            {
                alert("Data Updated Successfully");
            }
            else
            {
                alert("Something Wrong . . . ");
            }
         }
       });
}
})
</script>




<!-- Modal -->
  <div class="modal fade" id="edit_city" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update City</h4>
        </div>
          <form method="post" action="<?= base_url('admin/Registration/update_city') ?>">
              <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
            <div class="modal-body">
             
             <div id="result">
                 
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
