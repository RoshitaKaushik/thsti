<?php 
	$is_data = isset($infos) ? true : false;
	if(session()->get('component_ids')){
		$component_ids = session()->get('component_ids');
	}else{ 
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
	 width:8.2% !important; 
}
/*.tabs li.tab:nth-child(3){
	width:11% !important; 
}
.tabs li.tab:nth-child(6){
	width:10% !important; 
}*/

</style>

 <style>



.themeBtn,.themeBtn_no_res {
    background: #1f65c8;
    display: inline-block;
    font-size: 14px;
    font-weight: 500;
    height: auto;
    line-height: 0.8;
    padding: 8px 18px;
    
    border-radius: 1px;
    letter-spacing: 0.5px;
    border: 0px !important;
    cursor: pointer;
    border-radius: 100px;
    cursor: default ! important;
    margin-left:10px;
    
}

.themeBtn_new {
    background: #1f65c8;
    display: inline-block;
    font-size: 14px;
    font-weight: 500;
    height: auto;
    line-height: 0.8;
    padding: 8px 18px;
   
    border-radius: 1px;
    letter-spacing: 0.5px;
    border: 0px !important;
    cursor: pointer;
    border-radius: 100px;
    cursor: default ! important;
    margin-left:10px;
   
}

.Donor_button_modal,.Donor_button
{
    background-color:rgb(210, 56, 158);
    color:#fff;
    cursor:pointer ! important;
}
.Foundation_button,.Foundation_button_modal
{
    background-color:rgb(245, 223, 77);
    color:#fff;
    cursor:pointer ! important;
}
.FacultyStaff_button,.FacultyStaff_button_modal
{
    background-color:rgb(0, 114, 181);
    color:#fff;
    cursor:pointer ! important;
}
.Media_button,.Media_button_modal
{
    background-color:rgb(233, 137, 126);
    color:#fff;
    cursor:pointer ! important;
}
.PartnerOrganization_button,.PartnerOrganization_button_modal
{
    background-color:#9b5959;
    color:#fff; 
    cursor:pointer ! important;
}
.Appalachian_button,.Appalachian_button_modal
{
    background-color:rgb(0, 161, 112);
    color:#fff;
    cursor:pointer ! important;
}
.BoardMember_button,.BoardMember_button_modal
{
    background-color:#67baeb;
    color:#fff;
    cursor:pointer ! important;
}

.StudentFamily_button,.StudentFamily_button_modal
{
    background-color:rgb(255, 183, 212);
    color:#444;
    cursor:pointer ! important;
}
.AnnualReport_button,.AnnualReport_button_modal
{
    
    color:#fff;
    cursor:pointer ! important;
}
.DanielVIP_button,.DanielVIP_button_modal
{
    background-color:rgb(224, 181, 137);
    color:#fff;
    cursor:pointer ! important;
}
.FriendofDaniel_button,.FriendofDaniel_button_modal
{
     background-color: rgb(239, 225, 206);
    color: #686868;
    cursor:pointer ! important;
}
.DanielPermissionNeeded_button,.DanielPermissionNeeded_button_modal
{
    background-color:rgb(154, 139, 79);
    color:#fff;
    cursor:pointer ! important;
}
.GraduationInvite_button,.GraduationInvite_button_modal
{
    background-color:rgb(146, 106, 166);
    color:#fff;
    cursor:pointer ! important;
}
.QuarterCenturyReport_button,.QuarterCenturyReport_button_modal
{
    background-color:rgb(160, 218, 169);
    color:#fff;
    cursor:pointer ! important;
}
.GraduationInvite_button,.GraduationInvite_button_modal
{
   
    color:#fff;
    cursor:pointer ! important;
}

.Unsubscribed_button,.Unsubscribed_button_modal
{
    background-color:rgb(54, 57, 69);
    color:#fff;
    cursor:pointer ! important;
}
.Deceased_button,.Deceased_button_modal
{
    background-color:rgb(147, 149, 151);
    color:#fff;
    cursor:pointer ! important;
}
.student_button,.student_button_modal
{
    background-color:rgb(146, 106, 166);
    color:#fff;
    cursor:pointer ! important;
}
.Vista_button,.Vista_button_modal
{
    background-color:rgb(180, 90, 48);
    color:#fff;
    cursor:pointer ! important;
}
/*.checknox-list {
    margin:10px 0px ! important;
    padding:0px ! important;
}*/
.select-outer-box {
    width: 52%;
    margin-left: 30px;
}
.form-group.PartnerOrgName_div {
    display: block;
    width: 100%;
}


 .mobile-view-outter-box ul.nav.nav-tabs.tabs span.hidden-xs {
        display: block!important;
        border-bottom: 1px solid #ebebeb;
        font-size: 12px;
    }
    .mobile-view-outter-box ul.nav.nav-tabs.tabs span.visible-xs {
        display: none!important;
    }
    .mobile-view-outter-box ul.nav.nav-tabs.tabs span.hidden-xs p {
        display: none;
    }

.TribalCollege_button,.TribalCollege_button_modal{
    background-color:#8CB9BD;
    color:#fff;
    cursor:pointer ! important;
}

.WVCollege_button,.WVCollege_button_modal{
    background-color:#9DBC98;
    color:#fff;
    cursor:pointer ! important;
}

.PeaceCorps_button,.PeaceCorps_button_modal{
    background-color:#7091F5;
    color:#fff;
    cursor:pointer ! important;
}

.HBCU_button,.HBCU_button_modal{
    background-color:#7091F5;
    color:#fff;
    cursor:pointer ! important;
}

.AppalachiaCollege_button,.AppalachiaCollege_button_modal{
    background-color:#64CCC5;
    color:#fff;
    cursor:pointer ! important;
}

.USCollege_button,.USCollege_button_modal{
    background-color:#FFCF96;
    color:#fff;
    cursor:pointer ! important;
}

.AmeriCorps_button,.AmeriCorps_button_modal{
    background-color:#279EFF;
    color:#fff;
    cursor:pointer ! important;
}

.AcctHold_button,.AcctHold_button_modal{
    background-color:#ef2020;
    color:#fff;
    cursor:pointer ! important;
}


</style>
<div class="content-page">
	<!-- Start content -->
	<div class="">
		<div class="container1">
			
		<div class="row">
		<?php 
	    if(session()->getFlashdata('msg')!=''){ 
			echo session()->getFlashdata('msg');
		}
		
		?>
		</div>
			<!-- Start Widget -->
			<div class="row">
			   
				<div class="col-sm-12">	
					<div>
						
					</div>				
					<div class="form-group">
						<ul class="nav nav-tabs tabs"> 
												
							<?php 
							$scheme_id = 2; // 2 for Forms
							//$components = get_components($scheme_id);
                            

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
							<li class="tab <?=$count == 1 ? 'active' : ''?>" style="width:7.6% ! important;"> 
								<a href="#tab<?=$comp['id']?>" data-toggle="tab" aria-expanded="false" class="<?=$is_data ? '' : 'not-active'?>"> 
									<span class="visible-xs"><i class="fa fa-home"></i></span> 
									<span class="hidden-xs"><?=str_replace(array(' '),'<p style="position: relative;margin: -18px 0  0 0;"></p>',$comp['scheme_component_name'])?></span> 
								</a> 
							</li> 
							
							<?php }elseif($form_id != ''){ ?>
							<li class="tab <?=$count == 1 ? 'active' : ''?>" style="width:7.6% ! important;"> 
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
							<?php  echo view('templates/forms/pop_general_form'); ?>
							</div> 										
							<?php }elseif($comp['id'] == 2){ ?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/pop_student_info'); ?>	
							</div> 										
							<?php }elseif($comp['id'] == 3){ ?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/pop_donation_payments'); ?>
							</div>										
							<?php }elseif($comp['id'] == 4){ ?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/pop_transcript'); ?>											
							</div>										
							<?php }elseif($comp['id'] == 5){ ?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/pop_passport'); ?>
							</div>										
							<?php }elseif($comp['id'] == 6){ ?>
							
							<?php if(session()->get('role')==1 || $show_hr){?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/pop_adjunct_course'); ?>
							</div>	
                            <?php }?>							
							<?php }elseif($comp['id'] == 7){ ?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/employment_form'); ?>
							</div>										
							<?php } elseif($comp['id'] == 8){?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/pop_certificate_form'); ?>
							</div>
							<?php } else if($comp['id'] == 9){?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/pop_contact_log'); ?>
							</div>
							<?php } else if($comp['id'] == 10){?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/pop_student_record'); ?>
							</div>
							<?php } else if($comp['id'] == 11){?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/pop_employment_record'); ?>
							</div>
							<?php }else if($comp['id'] == 12){?>
							<div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>"> 
								<?php echo view('templates/forms/pop_employee_data'); ?>
							</div>
							<?php } else if($comp['id'] == 14) { ?>
						    <div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>">
							    <?php echo view('templates/forms/scholarship_form'); ?>
							</div>
							<?php }else if($comp['id'] == 15) {?>
						    <div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>">
							    <?php echo view('templates/forms/pop_student_finance'); ?>
							</div>
							<?php } } } } ?>


						
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
								
