
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
						<h3 class="panel-title"><?= isset($page) ? $page : '' ?></h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<table class="table table-striped table-bordered datatable" id="extable">
									<thead>
										<tr>
											<th style="width:5% ! important;">S.NO</th>
											<th style='width:30% ! important;'>Form Name</th>
											<th style='width:52% ! important;'>Assigned User</th>
											<th style='width:8% ! important;'></th>
											
										</tr>
									</thead>							 
									<tbody> 									
										
									<?php 
									$count = 1;
									 foreach($form_list as $fl)
									 {
									     echo "<tr>";
									      echo "<td style='width:5% ! important;'>".$count++."</td>";
									      echo "<td style='width:30% ! important;'>".$fl['scheme_component_name']."</td>";
									      ?>
									      <td style='width:52% ! important;'>
									          <?php
									             $users = get_user_acc_form($fl['id']);
									             if($users)
									             {
									                 $s=1;
									                 foreach($users as $user)
									                 {
									                     echo $user['admin_fullname'].",";
									                 }
									             }
									             else
									             {
									                 echo "No Users assigned";
									             }
									          ?>
									      </td>
									      <?php
									      echo "<td style='width:8% ! important;'><button class='btn-success assign_form btn-xs' rel_id='".$fl['id']."' rel_name='".$fl['scheme_component_name']."'>Assign Form</button></td>";
									     echo "</tr>";
									 }
									?>
									</tbody>
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>			
		</div> <!-- End Row -->
	</div> <!-- container -->
			   
</div> <!-- content -->
           <style>
th, td {
     text-align: left;
}

</style>

<script>
   
    $(document).on('click','.assign_form',function(e){
       e.preventDefault();
       var id = $(this).attr('rel_id');
         $('.component_id').val(id);
        
        $('.form_name').html($(this).attr('rel_name')); 
        
        $.ajax({
             url: '<?= base_url(); ?>admin/Assign_form/get_user',
	        data: ({ id: id }),
	       // dataType: 'json', 
	        type: 'post',
           
            success: function(data) {
              $('.part1').html(data); 
            }             
        });
        
         $.ajax({
             url: '<?= base_url(); ?>admin/Assign_form/get_user_already_assign',
	        data: ({ id: id }),
	        //dataType: 'json', 
	        type: 'post',
           
            success: function(data) {
              $('.part2').html(data); 
            }             
        });
        
           
        
        
       
        $('#assign_form_modal').modal('show'); 
    });
    
    $(document).on('click','.modal_cat',function(){
		var emp_id = $('#add_remove_emp_id').val();
		var cat_id = $(this).attr('rel_id');
		var cat_name = $(this).attr('rel_name');
		var email = $(this).attr('rel_email');
		$('.part2').append("<p class='removeaddcat' rel_email='"+email+"' rel_name='"+cat_name+"' rel_id="+cat_id+" id='addcat"+cat_id+"'><input type='hidden' class='form-control' value="+cat_id+" name='cat_id[]'/>"+cat_name+" ( "+email+" ) <br/></p>");
		$('#cat'+cat_id).remove();
	});
	
	$(document).on('click','.removeaddcat',function(){
			var cat_id = $(this).attr('rel_id');
			var cat_name = $(this).attr('rel_name');
			var email = $(this).attr('rel_email');
			$('.part1').append("<span class='modal_cat' rel_email='"+email+"' rel_name='"+cat_name+"' id='cat"+cat_id+"' rel_id="+cat_id+"><p>"+cat_name+" ( "+email+" )<br/><p></span>");
			$('#addcat'+cat_id).remove();

		});
    
</script>

<div class="modal fade" id="assign_form_modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Assign form to user</h4>
        </div>
        <form action="<?php echo base_url() ?>admin/Assign_form/store_assign_user_form" method='post'>
            <div class="modal-body">
                <h4 class='text-center form_name'></h4>
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                <input type='hidden' class='form-control component_id' name='component_id'/>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="search_in_current" id="search_in_current" placeholder="Search Current User">
                    </div>
                    <div class="col-md-6">
                       
                    </div>
                </div>
                <div class='row'>
                    
                    <div class='col-md-6 part1' style='border-right:1px solid #000000;height:350px;overflow-y:scroll;'>
                    
                    </div>
                    <div class='col-md-6 part2' style='height:350px;overflow-y:scroll;'>
                    
                    </div>
                    
                </div>
                
            </div>
        
        <div class="modal-footer">
            <input class="btn btn-success btn-xs" type='submit' value='Assign Form'/>
          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
  
  <script>
      $(document).on('keyup','#search_in_current',function(){
          var data = $(this).val();
          var submit = "submit";
          var id =$('.component_id').val();
          
          $.ajax({
             url: '<?= base_url(); ?>admin/Assign_form/get_user',
	        data: ({ submit: submit,search:data,id:id }),
	        dataType: 'html', 
	        type: 'post', 
            success: function(data) {
              $('.part1').html(data); 
            }             
         });
          
      })
      
  </script>