<?php 
//echo "<pre>";print_r($data);die;
$application_id = isset($user['application_id']) ? encryptor('encrypt', $user['application_id']) : '';
$application_code = isset($user['application_code']) ? encryptor('encrypt', $user['application_code']) : '';

if(!isset($component_id)){
	$component_id = isset($user['component_id']) ? $user['component_id'] : '';
}else{
	$component_id_en = $component_id;
	$component_id = encryptor('decrypt', $component_id);
}

$user_unique_id = isset($user['user_unique_id']) ? encryptor('encrypt', $user['user_unique_id']) : '';
$userid = isset($user['user_id']) ? encryptor('encrypt', $user['user_id']) : '';
$save_status = isset($user['save_status']) ? $user['save_status'] : '';


if(!isset($component_details)){
	$component_details = getComponentWithFormModule($component_id);
}
if(!isset($field_details)){
	$field_details = getCustomFields($component_id);
}
		


$inner_view_arr['userid'] = $userid;	
$inner_view_arr['user_unique_id'] = $user_unique_id;	
$inner_view_arr['application_id'] = $application_id;	
$inner_view_arr['application_code'] = $application_code;	
$inner_view_arr['component_details'] = $component_details;	
$inner_view_arr['field_details'] = $field_details;
$inner_view_arr['component_id'] = $component_id;	
$inner_view_arr['part'] = 1;	
//echo "dd"."<pre>";print_r($component_details);


?>

<div class="content-page" style="width: 900px;margin: auto;background-color: #f7f7f7;
    border: 1px solid #e6e6e6;">
	<!-- Start content -->
	<div class="content">
		<div class="">		  
			<?php 
				if(!empty($component_details)){ //echo "rrrr";
				$component_details = $component_details[0];
			?>			
			<section class="application-form-page">
				<div class="">					
				<h1 class="logo text-center">
					<span style="">Future</span>
					<span >Generations</span>
					<span>University</span></h1>
															
					<div class="panel panel-default text-center"><?=$component_details['scheme_component_name']?></div>
					<?php 
					if(session()->getFlashdata('msg') !=''){ 
						echo session()->getFlashdata('msg'); 
					} 
					if(session()->getFlashdata('post')){ 
						$post =  session()->getFlashdata('post');
						$inner_view_arr['post'] = $post;						
						//echo "<pre>"; print_r($post);echo "</pre>";
					} 
					
					
				   ?>
				<?php
				
				if(!empty($field_details)){
					echo $this->load->view('templates/custom_fields_front', $inner_view_arr, TRUE);
				
				?>
				
				
				</div>
		
					
</section>
				
				<!--<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-color panel-info">							
							<div class="panel-body">
								<?php 
									$attr = array('class' => 'form-horizontal');
									echo form_open_multipart('admin/FormBuilder/submitFinal', $attr); 
									
									 
								?>
								<input name="application_id" type="hidden" value="<?=$application_id?>">
								<input name="application_code" type="hidden" value="<?=$application_code?>">
								<input name="user_unique_id" type="hidden" value="<?=$user_unique_id?>">
								<input name="userid" type="hidden" value="<?=$userid?>">
																
								<?php 
								if(isset($user['save_status'])){
								if($user['save_status'] != 1 && $application_id != '') { 
								?>
								<div class="form-group">
									<div class="col-sm-12 text-center margin-top-40">
										<input type="submit" name="submit" value="SaveAsDraft" class="btn btn-success">
										<?php if($user['save_status'] == 2){ ?>
										<input type="submit" name="submit" value="FinalSubmit" class="btn btn-success">
										<?php } ?>
									</div>
								</div> 
								<?php }elseif($user['save_status'] == 1){ ?>
								<p style="color:red; ">Application Finally Submitted !</p>
								<?php }} ?>
								
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div> -->
				
			<?php }else{/*echo "Fields Not Added";*/}} ?>
		</div> <!-- container -->
	</div>			   
</div> <!-- content -->

<script>
$(document).ready(function(){

	$("#dob").datepicker();	

});
	

</script>
<script>

</script>

<?php
if(isset($user['aadhar_link_status']))
{
$link_status=$user['aadhar_link_status'];
if($link_status==1)
{	
?>
<script>
$(document).ready(function(){
$("#enroll_option").hide();	
});
</script>
<?php } }?>



