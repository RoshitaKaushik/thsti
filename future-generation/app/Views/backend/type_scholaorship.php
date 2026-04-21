<?php //echo "<pre>";print_r($data);die;
//echo "<pre>"; print_r($this->session->userdata()); die; 


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
			<!-- <h3 class="panel-title">Export VIP Mailing List Report</h3>
			<button type="button" id="exportexcelvip" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5">
				<i class="fa fa-file-pdf-o"></i>
				<span><strong>Click to Export</strong></span>
			</button>
			 -->
			<div class="row" >
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Scholarship</h3>
						</div>
						
						
						<div class="panel-body">
							<div class="row">	
							
							  
							  <?php if($error = session()->getFlashdata('msg')){ ?>
                                     <div class="alert alert-success" id="msg">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                             <strong>Success!</strong> <?php echo $error; ?>
                                     </div>
                                     <?php 
                                     session()->remove('msg');
                                     }else{?>
                                        <p class="text-succcess"><?php echo $error; ?></p>
                                     <?php } ?>
							
							
							
							       <div class="col-md-12" style="text-align:right;margin-bottom:10px">
							           <button class="btn btn-primary btn-xs sch_button">Add</button>
							       </div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<table id="type_scholar" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Sno</th>
												<th>Scholarship</th>
												<th>Multiple Allow</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody> 
										   <?php
										     $sno=1;
										     foreach($scholarships as $sch)
										     {
										         ?>
										         <tr>
										             <td><?= $sno++ ?></td>
										             <td><?= $sch['name'] ?></td>
										             <td>
										                 <?php
										                   if($sch['multiple_allow']==1)
										                   {
										                       echo "Yes";
										                   }
										                   else
										                   {
										                    echo "No";  
										                   }
										                 ?>
										                 
										                 
										             </td>
										             <td>
										                 <?php
										                   if($sch['status']==1)
										                   {
										                       echo "<button class='btn btn-danger btn-xs'>In-Active</button>";
										                   }
										                   else
										                   {
										                    echo "<button class='btn btn-success btn-xs'>Active</button>";   
										                   }
										                 ?>
										                 
										                 
										             </td>
										             <td>
										                 <button class="btn btn-primary btn-xs edit_sch" rel_id="<?= encryptor('encrypt', $sch['id']); ?>">Edit</button>
										             </td>
										         </tr>
										         <?php
										     }
										   ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div> <!-- container -->                              
	</div> <!-- content -->
</div> <!-- content -->

<div>
    
    
    
   <div class="modal fade" id="sch_Modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Scholarship</h4>
        </div>
        <form action="<?= base_url() ?>admin/Form/store_scholarship" method="post">
        <div class="modal-body">
           <div class="form-group">
               <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
               <label>Name</label>
               <input type="text" class="form-control" required id="sch_name" name="sch_name" >
               <span id="error_span" style="color:red;display:none;">* Field Rrequired</span>
           </div>
           
           <div class="form-group">
               <label>Multiple Allow</label><br/>
               <input type="radio" name="multiple_allow" required value="1"> Yes
               <input type="radio" name="multiple_allow" required checked value="0"> No
           </div>
           
           
           <div class="form-group">
               <label>status</label>
               <select class="form-control" name="status">
                   <option value="0">Active</option>
                   <option value="1">In-Active</option>
               </select>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" onclick="return myFunction()" value="Save">
        </div>
        </form>
      </div>
      
      
    </div>
  </div>
  
  
  <!-- Edit -->
  <div class="modal fade" id="edit_sch_Modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Scholarship</h4>
        </div>
        <form action="<?= base_url() ?>admin/Form/update_scholarship" method="post">
        <div class="modal-body">
           <div class="form-group">
               <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
               <label>Name</label>
               <input type="text" class="form-control" required id="edit_sch_name" name="sch_name" >
               <input type="hidden" class="form-control" id="edit_sch_id" name="sch_id" required>
               <span id="edit_error_span" style="color:red;display:none;">* Field Rrequired</span>
           </div>
           
           
           <div class="form-group">
               <label>Multiple Allow</label><br>
               <input type="radio" name="multiple_allow" required id="radio1" value="1"> Yes
               <input type="radio" name="multiple_allow" required id="radio2"  value="0"> No
           </div>
           
           
           <div class="form-group">
               <label>status</label>
               <select class="form-control" name="status" id="edit_status">
                   <option value="0">Active</option>
                   <option value="1">In-Active</option>
               </select>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" onclick="return myFunction2()" value="Save">
        </div>
        </form>
      </div>
      
      
    </div>
  </div>


<script>
function myFunction()
{
    var name = $('#sch_name').val();
    if(name == '')
    {
     $('#error_span').show();
     return false;
    }
    else
    {
        return true;
    }
    
}

function myFunction2()
{
    var name = $('#edit_sch_name').val();
    if(name == '')
    {
     $('#edit_error_span').show();
     return false;
    }
    else
    {
        return true;
    }
    
}




    $(document).on('click','.sch_button',function(){
        $('#sch_Modal').modal("show");
    })
    $(document).on('click','.edit_sch',function(){
        var rel_id = $(this).attr('rel_id');
        $('#edit_sch_id').val(rel_id);
        
        
        
        $.ajax({
   		type: "POST",
   		dataType:"json",
   		url: "<?php echo base_url('admin/Form/get_scholar_detail_by_id');?>",
   		data:{'<?= csrf_token() ?>':'<?= csrf_hash() ?>', 'id':rel_id},
   		success:function(result){
		
		 $('#edit_sch_name').val(result.name);
		 $('#edit_status').val(result.status);
		 
		 if(result.multiple_allow == 1)
		 {
		     $("#radio1").prop("checked", true);
		 }
		 if(result.multiple_allow == 0)
		 {
		     $("#radio2").prop("checked", true);
		 }
		 
        $('#edit_sch_Modal').modal('show');
		
    	},
        });
        
        
        
        
    })
</script>

