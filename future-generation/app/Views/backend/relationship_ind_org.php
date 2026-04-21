
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                 
<style>
.side_pop{
    z-index:99;
}
.tabs li.tab{
	width:10% !important; 
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
	
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

}
.formDiv{
    margin-bottom:10px;
}
.form-group{
    margin-right: -15px;
    margin-left: -15px;
}
.remove_button{
    display:none;
}
</style>    
<?php 
$access = getAccess(1); //1 for general

if(!empty($country)){								
	$country_js = json_encode($country);
}
if(!empty($states)){								
	$state_js = json_encode($states);
}

if(!empty($address_type)){								
	$address_type_js = json_encode($address_type);
}

if(session()->getFlashdata('post')
){ 
    $post = session()->getFlashdata('post');
;
}else{ 
    $post = array();
}
?>
<div class="content-page">
<!-- Start content -->
	<div class="content">
		<div class="container">
            
			<?php if(session()->getFlashdata('msg') !=''){ ?>
				<?php echo session()->getFlashdata('msg'); ?>
			<?php } ?>
				<!-- Page-Title -->
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading" style="min-height:42px ! important;display:none;">
							<div class="row">
    							<div class='col-md-11 '>
                                    <div class="header_part">
                                        <h3 class="panel-title" style="display:inline;">Relationship &nbsp;&nbsp;&nbsp;</h3>
                                    </div>
                                </div>
                            </div>
							
						</div>
						<div class="col-md-12">
							
							<div class="form-group mobile-view-outter-box" style="margin-left: -10px;margin-right: -10px;">
                                <ul class="nav nav-tabs tabs" style="width: 100%;">
                                    <li class="tab active" style="width: 8%;"> 
                                        <a href="#tab1" data-toggle="tab" aria-expanded="false" > 
                                            <span class="visible-xs"><i class="fa fa-home"></i></span> 
                                            <span class="hidden-xs">Organization</span> 
                                        </a>
                                    </li>
                                    
                                    <li class="tab" style="width: 10%;"> 
                                        <a href="#tab2" data-toggle="tab" aria-expanded="false"> 
                                            <span class="visible-xs"><i class="fa fa-home"></i></span> 
                                            <span class="hidden-xs">Individual</span> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            
                            	
                            <div class="row pop-tab-pane active" id="tab1">
                                <?= view('templates/organization/organizationlist') ?>
                            </div> 
                            
                            <div class="pop-tab-pane" id="tab2" style="display:none;">
                                <?= view('templates/individual/individual_list') ?>
                            </div> 
                                 
							
							
    						
						</div>
					
				</div>
			</div>
			
		</div> <!-- container -->                              
	</div> <!-- content -->
</div> <!-- content -->

<div>
    
<?php if(isset($form_id) == 'xxx'){ ?>
<script>
$('#poptab1 .hide').removeClass('hide').addClass('show');
$('#poptab1 span.show').removeClass('show').addClass('hide');
$("#poptab1 #general_view").show();
$("#poptab1 #general_edit").hide();
$("#poptab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive").attr("disabled",false);
$('#cke_organization_note').show();
</script>
<?php } else{
?>
<style>
    #poptab1 button.multiselect.dropdown-toggle.form-control.btn{
        display:none;
    }
    #cke_organization_note{
     display:none;   
    }
</style>
<?php } ?>

<script>
$(document).on('click','#addButtonRD',function(){
	var country_list = JSON.parse('<?=$country_js?>');
	var state_list = JSON.parse('<?=$state_js?>');
	var add_type_list = JSON.parse('<?=$address_type_js?>');
	
	var counter = $("#addcount7").val();
	var rem_count7 = parseInt($("#rem_addcount7").val());
	
	//country_select
	country_html = '<select class="form-control street_validate" name="Country['+counter+']" onchange="getstatedetails(this.value)"><option value="">Select</option>';
	$.each(country_list, function (key, val) {
		country_html += '<option value="'+val.CountryID+'">'+val.CountryName+'</option>';
    });
	
	//state_select
	state_html = '<select class="form-control" id="state" name="State['+counter+']"><option value="">Select</option>';
	$.each(state_list, function (key, val) {
		state_html += '<option value="'+val.StateID+'">'+val.StateID+' - '+val.StateName+'</option>';
    });
    
    /*type_html = '<select class="form-control street_validate" id="addressType'+counter+'" name="addressType['+counter+']"><option value="">Select</option>';
	$.each(add_type_list, function (key, val) {
		type_html += '<option value="'+val.name+'">'+val.name+'</option>';
    });*/
    
	if(counter>10){
        alert("Only 10 Reference allow");
        return false;
	}
	var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'TextBoxDivGEN' + counter);
	newTextBoxDiv.after().html('<td><input type="hidden" name="Address_RowID['+counter+']" value=""><input type="hidden" name="AddressID['+counter+']" value=""><textarea rows = "1" class="form-control street_validate" name="Street_Address['+counter+']" id="Street_Address'+counter+'" onChange="validateAddressXCheckbox('+counter+')"></textarea></td><td><textarea rows = "1"  class="form-control" name="Address2['+counter+']" id="Address2'+counter+'"  onChange="validateAddressXCheckbox('+counter+')"></textarea></td><td><input class=" form-control street_validate char" id="City'+counter+'" name="City['+counter+']" type="text"></td><td>'+state_html+'</td><td><input class="form-control " id="Postal_Code'+counter+'" name="Postal_Code['+counter+']" type="text" maxlength="7"></td><td>'+country_html+'  </td><td><input class="" value="1" type="checkbox" name="physical['+counter+']" id="physical'+counter+'"></td><td><input class="" value="1" type="checkbox" name="mailing['+counter+']" id="mailing'+counter+'"></td><td><input class="" value="1" type="checkbox" name="Active['+counter+']" id="addresscheckbox'+counter+'"></td>');
		  
	newTextBoxDiv.appendTo("#TextBoxesGroupRD");
	counter++;
	$("#addcount7").val(counter++);
	$("#rem_addcount7").val(parseInt(rem_count7+1));
	$('#address_save').css('display', 'block');
});

$(document).on('click','#removeButtonRD',function(){
	var rem_count7 = $("#rem_addcount7").val();
	if(rem_count7==0){
		alert("Address removal not allowed, either update or uncheck the active checkbox.");
		return false;
	}
	$('#table_address tr:last').remove();	
	$("#rem_addcount7").val(parseInt(rem_count7-1));
	var current_count = $("#addcount7").val();
	$("#addcount7").val(parseInt(current_count-1));
});



$(document).on('click','#inter_addButtonRD',function(){
		var country_list = JSON.parse('<?=$country_js?>');
		var state_list = JSON.parse('<?=$state_js?>');
		
		var counter = $("#count8").val();
		var rem_count8 = parseInt($("#rem_count8").val());
		
		
		//country_select
		country_html = '<select class="form-control" name="inter_Country['+counter+']" onchange="getstatedetails(this.value)"><option value="">Select</option>';
		$.each(country_list, function (key, val) {
			country_html += '<option value="'+val.CountryID+'">'+val.CountryName+'</option>';
	    });
		country_html += '</select>';
		
		//state_select
		/*state_html = '<select class="form-control" id="inter_state" name="inter_State['+counter+']"><option value="">Select</option>';
		$.each(state_list, function (key, val) {
			state_html += '<option value="'+val.StateID+'">'+val.StateID+' - '+val.StateName+'</option>';
	    });*/
		
		var add_type_list = JSON.parse('<?=$address_type_js?>');
        
        type_html = '<select class="form-control interaddressType" id="interaddressType'+counter+'" name="interaddressType['+counter+']"><option value="">Select</option>';
        	$.each(add_type_list, function (key, val) {
        		type_html += '<option value="'+val.name+'">'+val.name+'</option>';
            });
		
		if(counter>10){
	        alert("Only 10 Reference allow");
	        return false;
		}
		var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'TextBoxDivGEN' + counter);
		newTextBoxDiv.after().html('<td><input type="hidden" name="inter_Address_RowID['+counter+']" value="0"><input type="hidden" name="inter_AddressID['+counter+']" value="'+'<?=isset($infos['ID']) ? $infos['ID'] : 0;?>'+'"><textarea rows = "1" class="form-control" name="address1['+counter+']" id="inter_Street_Address'+counter+'" onChange="validateAddressXCheckbox('+counter+')"></textarea></td><td><textarea rows = "1"  class="form-control" name="address2['+counter+']" id="inter_Address2'+counter+'"  onChange="validateAddressXCheckbox('+counter+')"></textarea></td><td><input class=" form-control" id="inter_City'+counter+'" name="address3['+counter+']" type="text"></td><td><input type="text" class="form-control" id="inter_City'+counter+'" name="inter_City['+counter+']"></td><td>'+country_html+'  </td><td><input type="checkbox" value="1" class="physical_part" name="inter_physical['+counter+']" id="inter_physical'+counter+'"></td><td><input type="checkbox" value="1" class="mailing_part" name="inter_mailing['+counter+']" id="inter_mailing'+counter+'"></td><td><input class="" value="1" type="checkbox" name="inter_Active['+counter+']" id="addresscheckbox'+counter+'"></td>');
			  
		newTextBoxDiv.appendTo("#inter_TextBoxesGroupRD");
		counter++;
		$("#count8").val(counter++);
		$("#rem_count8").val(parseInt(rem_count8+1));
		$('#inter_address_save').css('display', 'block');
	});

$(document).on('click','#inter_removeButtonRD',function(){
		var rem_count8 = $("#rem_count8").val();
		if(rem_count8==0){
			//$('#address_save').css('display', 'none');
			alert("Address removal not allowed, either update or uncheck the active checkbox.");
			return false;
		}
		//counter--;
		//$("#TextBoxDivGEN" + counter).remove();
		$('#inter_table_address tr:last').remove();	
		$("#rem_count8").val(parseInt(rem_count8-1));
		var current_count = $("#count8").val();
		$("#count8").val(parseInt(current_count-1));
	});
	

$(document).on('click','#addButtonUS',function(){
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
            data: {counter:counter,student_id:"3594",submit:submit,counter:counter},
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
 


$(document).on('click','#removeButtonUS',function(){
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


$(document).on('click','#general_edit',function(){
   /*	$('#tab1 .hide').removeClass('hide').addClass('show');
	$('#tab1 span.show').removeClass('show').addClass('hide');
	$('#tab1 #general_view').removeClass('hide');
	$("#tab1 #general_view").show();
	$("#tab1 #general_edit").hide();
	$("#tab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive").attr("disabled",false);	
	$('#tab1 .no_border').removeClass('no_border').addClass('edit_border');
    $('#tab1 #email_save').show();
	$('#tab1 #address_save').show();
	$('#tab1 #inter_address_save').show();
	$('#tab1 button.multiselect.dropdown-toggle.form-control.btn').show();*/
	
	$('#poptab1 .hide').removeClass('hide').addClass('show');
	$('#poptab1 span.show').removeClass('show').addClass('hide');
	$('#poptab1 #general_view').removeClass('hide');
	$("#poptab1 #general_view").show();
	$("#poptab1 #general_edit").hide();
	$("#poptab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive,.physical_part,.mailing_part").attr("disabled",false);	
	$('#poptab1 .no_border').removeClass('no_border').addClass('edit_border');
    $('#poptab1 #email_save').show();
	$('#poptab1 #address_save').show();
	$('#poptab1 #inter_address_save').show();
	$('#poptab1 button.multiselect.dropdown-toggle.form-control.btn').show();
	$('#cke_organization_note').show();
	
})

$(document).on('click','#general_view',function(){
    $('#poptab1 .show').removeClass('show').addClass('hide');
	$('#poptab1 span.hide').removeClass('hide').addClass('show');	
	$(this).hide();
	$("#poptab1 #general_edit").show();
	$("#poptab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive,.physical_part,.mailing_part").attr("disabled",true);	
	$('#poptab1 #email_save').hide();
	$('#poptab1 #address_save').hide();
	$('#poptab1 .edit_border').removeClass('edit_border').addClass('no_border');
	$('#poptab1 button.multiselect.dropdown-toggle.form-control.btn').hide();
	$('#poptab1 #inter_address_save').hide();  	
	$('#cke_organization_note').hide();
})

$(document).on('focus', '.datepickerforward, .datepickerbackward', function(event){
	event.preventDefault();
	$(this).datepicker({
		format: 'mm/dd/yyyy',
		todayHighlight:'TRUE',
	    endDate: '-0d',
		autoclose: true,

	});
});
</script>

<aside class="side_pop">
  <span id="pop_result"></span>
</aside>							
