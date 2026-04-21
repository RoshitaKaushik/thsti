<?php 
	$is_data = isset($infos) ? true : false;
	if(session()->get('component_ids')){
		$component_ids = session()->get('component_ids');
	}else{
		//$component_ids = array(1,2,3,4,5,6,7,8,9,10,11,12,20,21); // for admin
		$component_ids = array(1,2,3,4,5,6,7,8,9,10,11,12,14,15); // for admin
	}
	$show_hr = false;
	if(session()->get('profiles')){					
		if(in_array(5, session()->get('profiles')) || in_array(6, session()->get('profiles'))){
			$show_hr = true;
		}
	}

?>


<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
}

.tabs li.tab{
	 width:8.1% !important; 
}
/*.tabs li.tab:nth-child(3){
	width:11% !important; 
}
.tabs li.tab:nth-child(6){
	width:10% !important; 
}*/

</style>
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">
			
		<div class="row">
		<?php 
	    if(session()->getFlashdata('msg')!=''){ 
			echo session()->getFlashdata('msg');
		}
		if(isset($studentinformation)){
	
          echo "<div><strong><h3>".$student_name = $studentinformation['FirstName']." ".$studentinformation['LastName']." - $studentid </h3></strong></div> ";
		   
        }?>
		</div>
			<!-- Start Widget -->
			<div class="row">
			    <div>
			        <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" style="margin-top:5px;">
							<i class="ion-arrow-left-a"></i>
							<span><strong>Go Back</strong></span>            
						</a>
			    </div>
				<div class="col-sm-12">	
					<div>
						
					</div>				
					<div class="form-group">
						<ul class="nav nav-tabs tabs"> 
												
							<?php 
							$scheme_id = 2; // 2 for Forms
							$components = get_components($scheme_id);
                            
				// 			echo "<pre>";
				// 			print_r($components);
    //                         print_r($component_ids);
    //                         die;
							if(!empty($components)){
								$count=0;
								foreach($components as $comp){
									if(in_array($comp['id'], $component_ids)){ 
									$count++;
									
									if($form_id == '' && $count == 1){
							?>
							<li class="tab <?=$count == 1 ? 'active' : ''?>" > 
								<a href="#tab<?=$comp['id']?>" data-toggle="tab" aria-expanded="false" class="<?=$is_data ? '' : 'not-active'?>"> 
									<span class="visible-xs"><i class="fa fa-home"></i></span> 
									<span class="hidden-xs"><?=str_replace(array(' '),'<p style="position: relative;margin: -18px 0  0 0;"></p>',$comp['scheme_component_name'])?></span> 
								</a> 
							</li> 
							
							<?php }elseif($form_id != ''){ ?>
							<li class="tab <?=$count == 1 ? 'active' : ''?>" id="tab_id<?= $comp['id'] ?>"> 
								<a href="#tab<?=$comp['id']?>" data-toggle="tab" aria-expanded="false" class="<?=$is_data ? '' : 'not-active'?>"> 
									<span class="visible-xs"><i class="fa fa-home"></i></span> 
									<span class="hidden-xs"><?=str_replace(array(' '),'<p style="position: relative;margin: -18px 0  0 0;"></p>',$comp['scheme_component_name'])?></span> 
								</a> 
							</li>
							<?php } } } } ?>
						</ul> 
						
					</div>
				</div>
				<div class="col-sm-12">									
					<div class="form-group">
					
						<div class="tab-content">
							
							<?php 
								
							if(!empty($components)){
								
							$count=0;
							
							//echo "<pre>";
							//print_r($components);
							foreach($components as $comp){
								if(in_array($comp['id'], $component_ids)){ 
								$count++;											
							?>
							
							<?php if($comp['id'] == 1){ ?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>">
							<?php  echo view('templates/forms/general_form_part_two'); ?>
							</div> 										
							<?php }elseif($comp['id'] == 2){ ?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/student_info'); ?>	
							</div> 										
							<?php }elseif($comp['id'] == 3){ ?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/donation_payments'); ?>
							</div>										
							<?php }elseif($comp['id'] == 4){ ?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/transcript'); ?>											
							</div>										
							<?php }elseif($comp['id'] == 5){ ?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/passport'); ?>
							</div>										
							<?php }elseif($comp['id'] == 6){ ?>
							
							<?php if(session()->get('role')==1 || $show_hr){?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/adjunct_course'); ?>
							</div>	
                            <?php }?>							
							<?php }elseif($comp['id'] == 7){ ?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/employment_form'); ?>
							</div>										
							<?php } elseif($comp['id'] == 8){?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/certificate_form'); ?>
							</div>
							<?php } else if($comp['id'] == 9){?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/contact_log'); ?>
							</div>
							<?php } else if($comp['id'] == 10){?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/student_record'); ?>
							</div>
							<?php } else if($comp['id'] == 11){?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/employment_record'); ?>
							</div>
							<?php }else if($comp['id'] == 12){?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/employee_data'); ?>
							</div>
							<?php } else if($comp['id'] == 14) { ?>
						    <div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>">
							    <?php echo view('templates/forms/scholarship_form'); ?>
							</div>
							<?php }else if($comp['id'] == 15) { ?>
						    <div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>">
							    <?php echo view('templates/forms/student_finance'); ?>
							</div>
							<?php } } } } ?>
						
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
								
<script>
$("#addButtonEM").click(function () {
	
	var counter = $("#count6").val();
	var rem_count6 = parseInt($("#rem_count6").val());
	if(rem_count6>10){
        alert("Only 10 textboxes allow");
        return false;
	}
	var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'TextBoxDivFD' + counter);
	newTextBoxDiv.after().html('<td><input value="" type="hidden" name="Email_RowID['+counter+']"><input value="" type="hidden" name="EmailID['+counter+']" ><input class="form-control email" id="Email'+counter+'" name="Email['+counter+']" type="email"onchange="validateCheckbox('+counter+')" placeholder="username@subdomain.domain" required ></td><td><input value="1" type="checkbox" name="EmailActive['+counter+']" id="emailstatus'+counter+'" checked="true"></td>');
	newTextBoxDiv.appendTo("#TextBoxesGroupFD");
	counter++;
	$("#count6").val(counter++);
	$("#rem_count6").val(parseInt(rem_count6+1));
	$('#email_save').css('display', 'block');
 });

$("#removeButtonEM").click(function (){
	var rem_count6 = $("#rem_count6").val();
	if(rem_count6==0){
		//$('#email_save').css('display', 'none');
		alert("Email removal not allowed, either update or uncheck the active checkbox.");
		return false;
	}
	//counter--;
	//$("#TextBoxDivRD" + counter).remove();	
	$('#table_email tr:last').remove();	
	$("#rem_count6").val(parseInt(rem_count6-1));
	var current_count = $("#count6").val();
	$("#count6").val(parseInt(current_count-1));
});




$("#addButtonUS").click(function () {
	
	var counter = $("#count11").val();
	var rem_count6 = parseInt($("#rem_count11").val());
	var submit = 'submit';
	if(rem_count6>10){
        alert("Only 10 textboxes allow");
        return false;
	}
	
	
	$.ajax({
            type: "POST",
            url: '<?= base_url() ?>admin/Form/set_add_more_USPhone_html',
            data: {counter:counter,student_id:"<?= $infos['ID'] ?>",submit:submit,counter:counter},
            dataType: "html",
            success: function(data){
              	var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'TextBoxesGroupUSFD' + counter);
        		newTextBoxDiv.after().html(data);
        	newTextBoxDiv.appendTo("#TextBoxesGroupUSFD");
        	counter++;
        	$("#count11").val(counter++);
        	$("#rem_count11").val(parseInt(rem_count6+1));
        	$('#_save').css('display', 'block');
            },
        });
	
	

 });
 
 
 $("#removeButtonUS").click(function (){
	var rem_count6 = $("#rem_count11").val();
	if(rem_count6==0){
		//$('#email_save').css('display', 'none');
		alert("USPhone removal not allowed, either update or uncheck the active checkbox.");
		return false;
	}
	//counter--;
	//$("#TextBoxDivRD" + counter).remove();	
	$('#us_email tr:last').remove();	
	$("#rem_count11").val(parseInt(rem_count6-1));
	var current_count = $("#count11").val();
	$("#count11").val(parseInt(current_count-1));
});

$(document).ready(function () {    
    
            $('.no_decimal').keypress(function (e) {    
                var charCode = (e.which) ? e.which : event.keyCode 
                if (String.fromCharCode(charCode).match(/[^0-9]/g))   
                    return false;       
            });
            
            
            $('.phonetype').keypress(function (e) { 
                 var charCode = (e.which) ? e.which : event.keyCode 
                 if(event.key === 'Enter') {  }
                else if(event.key === '+') {  }
                else if(event.key === '-') {  }
                else if(event.key === '(') {  }
                else if(event.key === ')') {  } 
                else if (String.fromCharCode(charCode).match(/[^0-9]/g))   
                    return false;
            });
           
    
        });



</script>	
	
<script>
$(".compensation").change(function() {
    var $this = $(this);
    $this.val(parseFloat($this.val()).toFixed(2));        
});

</script>