<?php 
	$is_data = isset($infos) ? true : false;
	if(session()->get('component_ids')){
		$component_ids = session()->get('component_ids');
	}else{

		$component_ids = array(1,2,3,4,5,6,7,8,9,10,11,12,14,15,16); // for admin
	}
	$show_hr = false;
	if(session()->get('profiles')){					
		if(in_array(5, session()->get('profiles')) || in_array(6, session()->get('profiles'))){
			$show_hr = true;
		}
	}

?>

<?php
$uri = service('uri');
$segment4 = $uri->getTotalSegments() >= 4 ? $uri->getSegment(4) : '';
?>


<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
}

.tabs li.tab{
	 width:9% !important; 
}
/*.tabs li.tab:nth-child(3){
	width:11% !important; 
}
.tabs li.tab:nth-child(6){
	width:10% !important; 
}*/

</style>

 <style>
.themeBtn,
.themeBtn_no_res {
    background: #1f65c8;
    color: #000000 !important; /* Corrected: #00000 was invalid */
    display: inline-block;
    font-size: 14px;
    font-weight: 500;
    height: 25px;
    line-height: 0.8;
    padding: 8px 18px;
    text-transform: capitalize;
    border-radius: 100px; /* Duplicate removed, keep the valid one */
    letter-spacing: 0.5px;
    border: 0 !important;
    cursor: pointer; /* Removed incorrect override */
}
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

/* start Fwd: FW: Mailchimp Audience Export Complete 10-04-2023 */
.ProspectiveStudent_button,.ProspectiveStudent_button_modal
{
    background-color:#80e14f;
    color:#fff;
    cursor:pointer ! important;
}
.ProspectiveDonor_button,.ProspectiveDonor_button_modal
{
    background-color:#2e7f8f;
    color:#fff;
    cursor:pointer ! important;
}

/* end Fwd: FW: Mailchimp Audience Export Complete 10-04-2023 */

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
.remove_button
{
    cursor:pointer;
    display:none;
    margin-left:7px;
}


/*modal for add group*/


.help {
    float: left;
}

.help a {
   padding: 4px 8px;
    color: #F0F0F0;
    background-color: #3377DD;
    margin: 0 0 0 5px;
    font-size: 12px;
}

.help a:hover {
    cursor: pointer;
}

.pop {
    display: none;
}

.popOut {
    float: left;
    /*width: 250px;*/
    
    margin-top: 50px ! important;
    padding: 5px;
    background-color: #F9F9F9;
    border: 1px solid #DDD;
    display: block;
    position: absolute;
    z-index:999;
    
     left: 0;
    right: 0;
    margin: 0 auto;
}

.popOut p {
    color: #242424;
}

.close a {
    float: right;
    padding: 3px 5px 2px 5px;
    font-size: 10px;
    color: #F0F0F0;
    background-color: #A10000;
    border-radius: 50%;
    border: 1px solid #BBB;
}

.popOut .close {
    margin-top: 10px;
    margin-right: 15px;
    /*position: absolute;*/
    right: 0;
 }
.popOut {
    width: 60%;
    background-color: #f7ecf4;
    border: 6px solid #f9f9f9;
    border-right: 3px solid #f9f9f9;
    border-left: 3px solid #f9f9f9;
    box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%) ;
    -webkit-box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%);
    margin-top:15px;
}
 
 .close.close_pop_out a {
    background-color: #fff!important;
    color: #f32323!important;
    border: 1px solid #fff;
    font-size: 14px!important;
}
 
 .header_part {
    display: flex;
    align-items: flex-start;
}                
.header_part strong {
    min-width: 165px;
}    
span.header_button button.themeBtn {
    margin-bottom: 5px;
}
.header_part strong h3 {
   font-size: 18px;
}


ul.list_field::-webkit-scrollbar {
  width: 6px;
}


ul.list_field::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 

ul.list_field::-webkit-scrollbar-thumb {
  background: #888; 
}


ul.list_field::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
ul.list_field {
    margin: 0;
    padding: 0;
    list-style: none;
    max-height: 289px;
    overflow-x: auto;
    min-width: 150px;
}
ul.list_field li {
    background: #fff;
    padding: 3px 7px;
    border-bottom: 1px solid #f1eeee;
    font-size: 12px;
    cursor: pointer;
}
ul.list_field li:hover, li.show-active {
    background: #fff7f7!important;
}
.top_maargin
{
    margin-top:10px;
}

.tag_li
{
    list-style: none;
    display: inline-block;
}
.filter-sub-menu-outer-box .tag_ul {
    width: 600px !important;
    left: 0  !important;
}
.filter-sub-menu-outer-box .tag_ul li.text-center.notifi-title {
    text-align: left!important;
    padding: 2px 0px 2px 20px;
    font-weight: 700;
}
.filter-sub-menu-outer-box .tag_ul li.list-group label.control-label {
    font-weight: 100;
    font-size: 12px;
    color: #888787;
}
.filter-sub-btn-box .btn-success {
    background-color: #ffffff;
    color: #565656!important;
    border: 1px solid #c7c7c7;
    margin-bottom: 5px;
}
.filter-sub-menu-outer-box {
    margin-bottom: 10px;
}
.waves-effect
{
    min-width:0px !important;
}
.filter-sub-menu-outer-box .btn-primary
{
    padding:0px 5px 0px 5px;
}


@media only screen and (max-width: 767px) {
  .mobile-view-outter-box .tabs li.tab {
        width: 50% !important;
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
	<div class="content">
		<div class="container">
			
		<div class="row">
		<?php 
	    if(session()->getFlashdata('msg')!=''){ 
			echo session()->getFlashdata('msg');
		}
		session()->remove('msg');
			if(isset($studentinformation)){
	
           echo "<div class='col-md-11 '>";
          
          echo '<div class="header_part">';
          echo "<strong><h3 style='display: inline ! important;'>".$student_name = $studentinformation['FirstName']." ".$studentinformation['LastName']." - $studentid </h3></strong>";
		       
		     
            $donor_status = true;
            $fac_status = true;
            echo '<span class="header_button">';
		       if(!empty($data['without_tuition_donation']))
		       {
		           $donor_status = false;
		           echo '<button  class="themeBtn Donor_button" data-name="Donor">Donor</button>';
		       }
		       if(!empty($data['check_graduation']))
		       {
		            echo '<button  class="themeBtn student_button">Alum</button>';
		       }
		       else if(!empty($data['student_info']))
		       {
		           echo '<button  class="themeBtn student_button">Student</button>';
		       }
		       if(!empty($data['check_current_employee']))
		       {
		           //$fac_status = false;
		           // FacultyStaff_button
		           echo '<button  class="themeBtn_no_res" data-name="FacultyStaff" style="color:#fff;">Current Employee </button>';
		           
		       }
		       else if(!empty($data['contract_employee']))
		       {
		           //$fac_status = false;
		           // FacultyStaff_button
		           echo '<button  class="themeBtn_no_res FacultyStaff_button" data-name="FacultyStaff" style="color:#fff;"> Former Employee </button>';
		       }
		        
                if($data['group'][0]['Foundation'] == '1')
                {
                    echo '<button class="themeBtn Foundation_button" data-name="Foundation">Grantmaker Affiliate <i class="fa fa-times remove_button" rel_name="Foundation_button" ></i></button>';
                    
                }
                if($data['group'][0]['Media'] == '1')
                {
                    echo '<button class="themeBtn Media_button" data-name="Media">Media <i class="fa fa-times remove_button" rel_name="Media_button"></i></button>';
                    
                }
                if($data['group'][0]['Appalachian'] == '1')
                {
                    echo '<button class="themeBtn Appalachian_button" data-name="Appalachian">Appalachian Program <i class="fa fa-times remove_button" rel_name="Appalachian_button"></i></button>';
                    
                }
                if($data['group'][0]['BoardMember'] == '1')
                {
                    echo '<button class="themeBtn BoardMember_button" data-name="BoardMember">Past & Present Board Members <i class="fa fa-times remove_button" rel_name="BoardMember_button"></i></button>';
                    
                }
                if($data['group'][0]['FacultyStaff'] == '1' && $fac_status)
                {
                    echo '<button class="themeBtn FacultyStaff_button" data-name="FacultyStaff">Past & Present Faculty & Staff <i class="fa fa-times remove_button" rel_name="FacultyStaff_button"></i></button>';
                    
                }
                if($data['group'][0]['StudentFamily'] == '1')
                {
                    echo '<button class="themeBtn StudentFamily_button" data-name="StudentFamily">Past & Present Student Family <i class="fa fa-times remove_button" rel_name="StudentFamily_button"></i></button>';
                    
                }
                if($data['group'][0]['AnnualReport'] == '1')
                {
                   // echo '<button class="themeBtn AnnualReport_button" data-name="AnnualReport">Receives Printed Annual Report <i class="fa fa-times remove_button" rel_name="AnnualReport_button"></i></button>';
                    
                }
                if($data['group'][0]['DanielVIP'] == '1')
                {
                    echo '<button class="themeBtn DanielVIP_button" data-name="DanielVIP">VIP <i class="fa fa-times remove_button" rel_name="DanielVIP_button"></i></button>';
                    
                }
                if($data['group'][0]['FriendofDaniel'] == '1')
                {
                    echo '<button class="themeBtn FriendofDaniel_button" data-name="FriendofDaniel">Friend of Daniel/ Not VIP <i class="fa fa-times remove_button" rel_name="FriendofDaniel_button"></i></button>';
                    
                }
                if($data['group'][0]['DanielPermissionNeeded'] == '1')
                {
                    // echo '<button class="themeBtn DanielPermissionNeeded_button" data-name="DanielPermissionNeeded">Need Daniel Permission to Contact <i class="fa fa-times remove_button" rel_name="DanielPermissionNeeded_button"></i></button>';
                    
                }
                if($data['group'][0]['GraduationInvite'] == '1')
                {
                    //echo '<button class="themeBtn GraduationInvite_button" data-name="GraduationInvite">Send Graduation Invitation <i class="fa fa-times remove_button" rel_name="GraduationInvite_button"></i></button>';
                    
                }
                if($data['group'][0]['QuarterCenturyReport'] == '1')
                {
                   // echo '<button class="themeBtn QuarterCenturyReport_button" data-name="QuarterCenturyReport">Received Quarter Century Report <i class="fa fa-times remove_button" rel_name="QuarterCenturyReport_button"></i></button>';
                    
                }
                if($data['group'][0]['Unsubscribed'] == '1')
                {
                    //echo '<button class="themeBtn Unsubscribed_button" data-name="Unsubscribed">Do Not Email <i class="fa fa-times remove_button" rel_name="Unsubscribed_button"></i></button>';
                    
                }
                if($studentinformation['Deceased'] == '1')
                {
                    echo '<button class="themeBtn Deceased_button" data-name="Deceased">Deceased <i class="fa fa-times remove_button" rel_name="Deceased_button"></i></button>';
                    
                }  
                if($data['group'][0]['Vista'] == '1')
                {
                    echo '<button class="themeBtn Vista_button" data-name="Vista">vista <i class="fa fa-times remove_button" rel_name="Vista_button"></i></button>';   
                }
                if($data['group'][0]['ProspectiveStudent'] == '1'){
                    echo '<button class="themeBtn ProspectiveStudent_button" data-name="ProspectiveStudent">Potential Student <i class="fa fa-times remove_button" rel_name="ProspectiveStudent_button"></i></button>';
                }
                if($data['group'][0]['prospective_donor'] == '1'){
                    echo '<button class="themeBtn ProspectiveDonor_button" data-name="prospective_donor">Potential Donor <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
                }
                /* start 08-02-2024 */
                if($data['group'][0]['tribal_college'] == '1'){
                    echo '<button class="themeBtn TribalCollege_button" data-name="tribal_college">Tribal College <i class="fa fa-times remove_button" rel_name="TribalCollege_button"></i></button>';
                }
                if($data['group'][0]['hbcu'] == '1'){
                    echo '<button class="themeBtn HBCU_button" data-name="hbcu">HBCU <i class="fa fa-times remove_button" rel_name="HBCU_button"></i></button>';
                }
                if($data['group'][0]['wv_college'] == '1'){
                    echo '<button class="themeBtn WVCollege_button" data-name="wv_college">WV College <i class="fa fa-times remove_button" rel_name="WVCollege_button"></i></button>';
                }
                if($data['group'][0]['appalachia_college'] == '1'){
                    echo '<button class="themeBtn AppalachiaCollege_button" data-name="appalachia_college">Appalachia College <i class="fa fa-times remove_button" rel_name="AppalachiaCollege_button"></i></button>';
                }
                if($data['group'][0]['us_college'] == '1'){
                    echo '<button class="themeBtn USCollege_button" data-name="us_college">US College <i class="fa fa-times remove_button" rel_name="USCollege_button"></i></button>';
                }
                if($data['group'][0]['americorps'] == '1'){
                    echo '<button class="themeBtn AmeriCorps_button" data-name="americorps">AmeriCorps <i class="fa fa-times remove_button" rel_name="AmeriCorps_button"></i></button>';
                }
                if($data['group'][0]['peacecorps'] == '1'){
                    echo '<button class="themeBtn PeaceCorps_button" data-name="peacecorps">PeaceCorps <i class="fa fa-times remove_button" rel_name="PeaceCorps_button"></i></button>';
                }
                /* end 08-02-2024 */
                
                if($data['group'][0]['accthold'] == '1'){
                    echo '<button class="themeBtn AcctHold_button" data-name="accthold">Acct Hold <i class="fa fa-times remove_button" rel_name="AcctHold_button"></i></button>';
                }
                	
		    echo '</span>';
		    $data['student_information'] = $studentinformation;
		       $data['donor_status'] = $donor_status;
		    $data['fac_status']  = $fac_status;
		    $data['studentinformation'] = $studentinformation;
		       echo view('templates/show_group_in_pop_up',$data);
		       
          echo "</div>";
          echo "</div>";
        }
		?>
		<div class="col-md-1" style="margin-top:10px;">
		        <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" style="margin-top:5px;">
					<i class="ion-arrow-left-a"></i>
						<span><strong>Go Back</strong></span>            
				</a>
			   </div>
		</div>
			<!-- Start Widget -->
			<div class="row">
			   
				<div class="col-sm-12">	
					<div>
						
					</div>				
					<div class="form-group mobile-view-outter-box">
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
							<?php  echo view('templates/forms/general_form'); ?>
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
							<?php } else if($comp['id'] == 16) { ?>
						    <div class="tab-pane <?=$count == 1 ? 'active' : ''?>" id="tab<?=$comp['id']?>">
							    <?php echo view('templates/forms/contactAttachment'); ?>
							</div>
							<?php }
							} } } ?>


						
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
		newTextBoxDiv.after().html('<td><input value="" type="hidden" name="Email_RowID['+counter+']"><input value="" type="hidden" name="EmailID['+counter+']" ><input class="form-control email_validateForm check_email email" id="Email'+counter+'"  name="Email['+counter+']" type="email"onchange="validateCheckbox('+counter+')" placeholder="username@subdomain.domain" required ></td><td><input class="email_unsubscribed" value="1" type="checkbox" name="EmailUnsubscribed['+counter+']" id="EmailUnsubscribed'+counter+'"></td><td><input value="1" type="checkbox" name="EmailActive['+counter+']" id="emailstatus'+counter+'" checked="true"></td>');
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
            data: {counter:counter,student_id:"<?= $infos['ID'] ?? ''?>",submit:submit,counter:counter},
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
        
$(document).on('keyup','.USPhoneNumber',function(){
            var data = $(this).val();
            var rel_id = $(this).attr('rel_id');
            if(data != '')
            {
                $('#phonetype'+rel_id).attr('required','required');
            }
            else
            {
                $('#phonetype'+rel_id).removeAttr('required');
            }
            
        })
        
        
        
        
$(document).on('click','.help',function(){
    $('.pop').toggleClass('popOut');
    if($('.pop'). hasClass('popOut')) {
        $('.remove_button').show();
    }
    else{
         $('.remove_button').hide();
         const role_val = [];
         var user_id = "<?= esc($segment4) ?>";
         var submit= 'submit';
         $('.themeBtn').each(function () {
            role_val.push($(this).attr('data-name'));
         });
         
          $.ajax({
            type: "POST",
            url: '<?= base_url() ?>admin/Form/submitUserRole',
            data: {role_val:role_val,user_id:user_id,submit:submit},
            dataType: "html",
            success: function(data){
                
            },
        });
    
    }
})

$(document).on('click','.checkbox',function(){
        $('.pop').toggleClass('popOut'); 
    })
    
$(document).on('click','#PartnerOrgName',function(){
      // $('.pop').toggleClass('popOut');   
    })


$(document).on('click','.themeBtn_new',function(){
    var data = $(this).attr('rel_name');
   //var status = $(this).prop('checked');
    var content = '';
        if(data == 'Donor')
        {
            content += '<button class="themeBtn Donor_button" data-name="Donor">Donor <i class="fa fa-times remove_button" rel_name="Donor_button"></i></button>';
            $('.Donor_div').hide();
        }
        if(data == 'Foundation')
        {
            content += '<button class="themeBtn Foundation_button" data-name="Foundation">Grantmaker Affiliate <i class="fa fa-times remove_button" rel_name="Foundation_button" ></i></button>';
            $('.Foundation_div').hide();
        }
        if(data == 'Media')
        {
            content += '<button class="themeBtn Media_button" data-name="Media">Media <i class="fa fa-times remove_button" rel_name="Media_button"></i></button>';
            $('.Media_div').hide();
        }
        if(data == 'PartnerOrganization')
        {
            content += '<button class="themeBtn PartnerOrganization_button" data-name="PartnerOrganization">Partner Organization <i class="fa fa-times remove_button" rel_name="PartnerOrganization_button"></i></button>';
            $('.PartnerOrganization_div').hide();
        }
        if(data == 'Appalachian')
        {
            content += '<button class="themeBtn Appalachian_button" data-name="Appalachian">Appalachian Program <i class="fa fa-times remove_button" rel_name="Appalachian_button"></i></button>';
            $('.Appalachian_div').hide();
        }
        if(data == 'BoardMember')
        {
            content += '<button class="themeBtn BoardMember_button" data-name="BoardMember">Past & Present Board Members <i class="fa fa-times remove_button" rel_name="BoardMember_button"></i></button>';
            $('.BoardMember_div').hide();
        }
        if(data == 'FacultyStaff')
        {
            content += '<button class="themeBtn FacultyStaff_button" data-name="FacultyStaff">Past & Present Faculty & Staff <i class="fa fa-times remove_button" rel_name="FacultyStaff_button"></i></button>';
            $('.FacultyStaff_div').hide();
        }
        if(data == 'StudentFamily')
        {
            content += '<button class="themeBtn StudentFamily_button" data-name="StudentFamily">Past & Present Student Family <i class="fa fa-times remove_button" rel_name="StudentFamily_button"></i></button>';
            $('.StudentFamily_div').hide();
        }
        if(data == 'AnnualReport')
        {
            content += '<button class="themeBtn AnnualReport_button" data-name="AnnualReport">Receives Printed Annual Report <i class="fa fa-times remove_button" rel_name="AnnualReport_button"></i></button>';
            $('.AnnualReport_div').hide();
        }
        if(data == 'DanielVIP')
        {
            content += '<button class="themeBtn DanielVIP_button" data-name="DanielVIP">VIP <i class="fa fa-times remove_button" rel_name="DanielVIP_button"></i></button>';
            $('.DanielVIP_div').hide();
        }
        if(data == 'FriendofDaniel')
        {
            content += '<button class="themeBtn FriendofDaniel_button" data-name="FriendofDaniel">Friend of Daniel/ Not VIP <i class="fa fa-times remove_button" rel_name="FriendofDaniel_button"></i></button>';
            $('.FriendofDaniel_div').hide();
        }
        if(data == 'DanielPermissionNeeded')
        {
            content += '<button class="themeBtn DanielPermissionNeeded_button" data-name="DanielPermissionNeeded">Need Daniel Permission to Contact <i class="fa fa-times remove_button" rel_name="DanielPermissionNeeded_button"></i></button>';
            $('.DanielPermissionNeeded_div').hide();
        }
        if(data == 'GraduationInvite')
        {
            content += '<button class="themeBtn GraduationInvite_button" data-name="GraduationInvite">Send Graduation Invitation <i class="fa fa-times remove_button" rel_name="GraduationInvite_button"></i></button>';
            $('.GraduationInvite_div').hide();
        }
        if(data == 'QuarterCenturyReport')
        {
            content += '<button class="themeBtn QuarterCenturyReport_button" data-name="QuarterCenturyReport">Received Quarter Century Report <i class="fa fa-times remove_button" rel_name="QuarterCenturyReport_button"></i></button>';
            $('.QuarterCenturyReport_div').hide();
        }
        if(data == 'Unsubscribed')
        {
            content += '<button class="themeBtn Unsubscribed_button" data-name="Unsubscribed">Do Not Email <i class="fa fa-times remove_button" rel_name="Unsubscribed_button"></i></button>';
            $('.Unsubscribed_div').hide();
        }
        if(data == 'Vista')
        {
            content += '<button class="themeBtn Vista_button" data-name="Vista">Vista <i class="fa fa-times remove_button" rel_name="Vista_button"></i></button>';
            $('.Vista_div').hide();
        }
        if(data == 'Deceased')
        {
            content += '<button class="themeBtn Deceased_button" data-name="Deceased">Deceased <i class="fa fa-times remove_button" rel_name="Deceased_button"></i></button>';
            $('.Deceased_div').hide();
        }
        // start FW: Mailchimp Audience Export Complete
        if(data == 'ProspectiveStudent')
        {
            content += '<button class="themeBtn ProspectiveStudent_button" data-name="ProspectiveStudent">Potential Student <i class="fa fa-times remove_button" rel_name="ProspectiveStudent_button"></i></button>';
            $('.ProspectiveStudent_div').hide();
        }
        if(data == 'prospective_donor')
        {
            content += '<button class="themeBtn ProspectiveDonor_button" data-name="prospective_donor">Potential Donor <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.ProspectiveDonor_div').hide();
        }
        
        // end FW: Mailchimp Audience Export Complete
        
        //start 08-Feb-2024
        if(data == 'tribal_college')
        {
            content += '<button class="themeBtn TribalCollege_button" data-name="tribal_college">Tribal College <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.TribalCollege_div').hide();
        }
        if(data == 'hbcu')
        {
            content += '<button class="themeBtn HBCU_button" data-name="hbcu">HBCU <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.HBCU_div').hide();
        }
        if(data == 'wv_college')
        {
            content += '<button class="themeBtn WVCollege_button" data-name="wv_college">WV College <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.WVCollege_div').hide();
        }
        if(data == 'appalachia_college')
        {
            content += '<button class="themeBtn AppalachiaCollege_button" data-name="appalachia_college">Appalachia College <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.AppalachiaCollege_div').hide();
        }
        if(data == 'us_college')
        {
            content += '<button class="themeBtn USCollege_button" data-name="us_college">US College <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.USCollege_div').hide();
        }
        if(data == 'americorps')
        {
            content += '<button class="themeBtn AmeriCorps_button" data-name="americorps">AmeriCorps <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.AmeriCorps_div').hide();
        }
        if(data == 'peacecorps')
        {
            content += '<button class="themeBtn PeaceCorps_button" data-name="peacecorps">PeaceCorps <i class="fa fa-times remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.PeaceCorps_div').hide();
        }
        
        //end 08-Feb-2024
        
        if(data == 'accthold')
        {
            content += '<button class="themeBtn AcctHold_button" data-name="accthold">Acct Hold <i class="fa fa-times remove_button" rel_name="AcctHold_button"></i></button>';
            $('.AcctHold_div').hide();
        }
    
   
    
    $('.header_button').append(content);
})

$(document).on('click','.remove_button',function(){
        var data = $(this).attr('rel_name');
        
        if(data == 'Donor_button')
        {
            $('.Donor_button').remove();
            $('.Donor_div').show();
            $('input:checkbox[name=Donor]').attr('checked',false);
        }
        if(data == 'Foundation_button')
        {
            $('.Foundation_button').remove();
            $('.Foundation_div').show();
            $('input:checkbox[name=Foundation]').attr('checked',false);
        }
        if(data == 'Media_button')
        {
            $('.Media_button').remove();
            $('.Media_div').show();
            $('input:checkbox[name=Media]').attr('checked',false);
        }
        if(data == 'PartnerOrganization_button')
        {
            $('.PartnerOrganization_button').remove();
            $('.PartnerOrganization_div').show();
            $('input:checkbox[name=PartnerOrganization]').attr('checked',false);
        }
        if(data == 'Appalachian_button')
        {
            $('.Appalachian_button').remove();
            $('.Appalachian_div').show();
            $('input:checkbox[name=Appalachian]').attr('checked',false);
        }
        if(data == 'BoardMember_button')
        {
            $('.BoardMember_button').remove();
            $('.BoardMember_div').show();
            $('input:checkbox[name=BoardMember]').attr('checked',false);
        }
        if(data == 'FacultyStaff_button')
        {
            $('.FacultyStaff_button').remove();
            $('.FacultyStaff_div').show();
            $('input:checkbox[name=FacultyStaff]').attr('checked',false);
        }
        if(data == 'StudentFamily_button')
        {
            $('.StudentFamily_button').remove();
            $('.StudentFamily_div').show();
            $('input:checkbox[name=StudentFamily]').attr('checked',false);
        }
        if(data == 'AnnualReport_button')
        {
            $('.AnnualReport_button').remove();
            $('.AnnualReport_div').show();
            $('input:checkbox[name=AnnualReport]').attr('checked',false);
        }
        if(data == 'DanielVIP_button')
        {
            $('.DanielVIP_button').remove();
            $('.DanielVIP_div').show();
            $('input:checkbox[name=DanielVIP]').attr('checked',false);
        }
        if(data == 'FriendofDaniel_button')
        {
            $('.FriendofDaniel_button').remove();
            $('.FriendofDaniel_div').show();
            $('input:checkbox[name=FriendofDaniel]').attr('checked',false);
        }
        if(data == 'DanielPermissionNeeded_button')
        {
            $('.DanielPermissionNeeded_button').remove();
            $('.DanielPermissionNeeded_div').show();
            $('input:checkbox[name=DanielPermissionNeeded]').attr('checked',false);
        }
        if(data == 'GraduationInvite_button')
        {
            $('.GraduationInvite_button').remove();
            $('.GraduationInvite_div').show();
            $('input:checkbox[name=GraduationInvite]').attr('checked',false);
        }
        if(data == 'QuarterCenturyReport_button')
        {
            $('.QuarterCenturyReport_button').remove();
            $('.QuarterCenturyReport_div').show();
            $('input:checkbox[name=QuarterCenturyReport]').attr('checked',false);
        }
        if(data == 'Unsubscribed_button')
        {
            $('.Unsubscribed_button').remove();
            $('.Unsubscribed_div').show();
            $('input:checkbox[name=Unsubscribed]').attr('checked',false);
        }
        if(data == 'Vista_button')
        {
            $('.Vista_button').remove();
            $('.Vista_div').show();
            
        }
        if(data == 'Deceased_button')
        {
            $('.Deceased_button').remove();
            $('.Deceased_div').show();
            $('input:checkbox[name=Deceased]').attr('checked',false);
        }
        // start FW: Mailchimp Audience Export Complete
        if(data == 'ProspectiveDonor_button'){
            $('.ProspectiveDonor_button').remove();
            $('.ProspectiveDonor_div').show();
        }
        if(data == 'ProspectiveStudent_button'){
            $('.ProspectiveStudent_button').remove();
            $('.ProspectiveStudent_div').show(); 
        }
        // End FW: Mailchimp Audience Export Complete
        
        /* start 08-02-2024 */
        if(data == 'TribalCollege_button'){
            $('.TribalCollege_button').remove();
            $('.TribalCollege_div').show(); 
        }
        if(data == 'HBCU_button'){
            $('.HBCU_button').remove();
            $('.HBCU_div').show(); 
        }
        if(data == 'WVCollege_button'){
            $('.WVCollege_button').remove();
            $('.WVCollege_div').show(); 
        }
        if(data == 'AppalachiaCollege_button'){
            $('.AppalachiaCollege_button').remove();
            $('.AppalachiaCollege_div').show(); 
        }
        if(data == 'USCollege_button'){
            $('.USCollege_button').remove();
            $('.USCollege_div').show(); 
        }
        if(data == 'AmeriCorps_button'){
            $('.AmeriCorps_button').remove();
            $('.AmeriCorps_div').show(); 
        }
        if(data == 'PeaceCorps_button'){
            $('.PeaceCorps_button').remove();
            $('.PeaceCorps_div').show(); 
        }
        /* end 08-02-2024 */
        
        if(data == 'AcctHold_button'){
            $('.AcctHold_button').remove();
            $('.AcctHold_div').show(); 
        }
    
})


$(document).on('click','.close_pop_out',function(){
    $('.remove_button').hide();
})




</script>	
	
<script>
$(".compensation").change(function() {
    var $this = $(this);
    $this.val(parseFloat($this.val()).toFixed(2));        
});

</script>


<!-- By Prabhat 14 Aug 2024 Due To update record after assign scholorship or else in student finance  -->
<script>

function sf_saveHandler(e) {
    if(e.target.classList.contains('sf_save') || e.target.className == "fa fa-check") {
        let tr, element, buttonParentDiv;
        if(e.target.classList.contains('sf_save')) {
            element = e.target;
            buttonParentDiv = e.target.parentElement;
            div = e.target.parentElement.nextElementSibling;
            tr = e.target.closest('tr');
        } else if(e.target.className == "fa fa-check") {
            element = e.target.parentElement;
            buttonParentDiv = e.target.parentElement.parentElement;
            div = e.target.parentElement.parentElement.nextElementSibling;
            tr = e.target.closest('tr');
        }
        
        let class_el, semester_el, tution_el, scholarship_el, student_cost_el, type_id_el, type_el, notes_el;
        class_el = tr.querySelector('.class');
        semester_el = tr.querySelector('.semester');
        type_id_el = tr.querySelector('.type_id');
        tution_el = tr.querySelector('.tution');
        scholarship_el = tr.querySelector('.scholarship');
        student_cost_el = tr.querySelector('.student_cost');
        type_el = tr.querySelector('.type');
        notes_el = tr.querySelector('.notes');
        // Prepare ajax request for edit.
        student_id = "<?=esc($segment4)?>";
        $.ajax({
       		type: "POST",
       		dataType:"html",
       		url: "<?php echo base_url('admin/Form/store_student_finance');?>",
       		data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', 
       		    year: class_el.value, semester: semester_el.value, type_id: type_id_el.value, tution: tution_el.value, 
       		    scholarship: scholarship_el.value, student_cost: student_cost_el.value, type: type_el.value, notes: notes_el.value, student_id },
       		success:function(result){
    		    if(result != -1) {
    		        alert("Notes updated successfully");
    		        div.classList.add('custom-panel-body');
    		        if(notes_el.value != "")
                        div.innerHTML = `${notes_el.value}`;
                    else 
                        div.innerHTML = ``;

                    buttonParentDiv.children[0].style.display = 'inline';
                    buttonParentDiv.children[1].style.display = 'none';
                    buttonParentDiv.children[2].style.display = 'none';
                    let editBtn = buttonParentDiv.children[0];
                    let cancelBtn = buttonParentDiv.children[2];
                    
                    if(notes_el.value != "") {
                        $(editBtn).data('notes', notes_el.value);
                        $(cancelBtn).data('notes', notes_el.value);
                    } else {
                        $(editBtn).data('notes', "");
                        $(cancelBtn).data('notes', "");
                    }
    		    }
        	},
        });
    }
}

function sf_cancelHandler(e) {
     if(e.target.classList.contains('sf_cancel') ||e.target.className == "fa fa-times") {
        let element, div;
        if(e.target.classList.contains('sf_cancel')) {
            element = e.target; 
            div = e.target.parentElement.nextElementSibling;
        } else if(e.target.className == "fa fa-times") {
            element = e.target.parentElement;
            div = e.target.parentElement.parentElement.nextElementSibling;
        }
        // element = <button> div = <div>
        let notes = $(element).data('notes');
        if(notes === "") {
            notes = "";

        }
        element.style.display = 'none';
        element.previousElementSibling.style.display = 'none';
        element.previousElementSibling.previousElementSibling.style.display = 'inline';
        div.classList.add('custom-panel-body');
        div.innerHTML = `${notes}`;
    }   
}

function sf_editHandler(e) {
    if(e.target.classList.contains('sf_edit') ||e.target.className == 'fa fa-pencil') {
        let element, div;
        if(e.target.classList.contains('sf_edit')) {
            element = e.target; 
            div = e.target.parentElement.nextElementSibling;
        } else if(e.target.classList.contains('fa')) {
            element = e.target.parentElement;
            div = e.target.parentElement.parentElement.nextElementSibling;
        }
        // element = <button> div = <div>
        let notes = $(element).data('notes');
        if(notes === "") {
            notes = "";
        }
        element.style.display = 'none';
        element.nextElementSibling.style.display = 'inline';
        element.nextElementSibling.nextElementSibling.style.display = 'inline';
        div.classList.remove('custom-panel-body');
        div.innerHTML = `
            <textarea class="notes custom-panel-textarea" rows="4" cols="4" placeholder="Enter Notes...">${notes}</textarea>;
        `;
    }
}

function sf_saveStudentFinance() {
    document.removeEventListener('click', sf_saveHandler); 
    document.addEventListener('click', sf_saveHandler); 
}

function sf_cancelStudentFinance() {
   document.removeEventListener('click', sf_cancelHandler);
   document.addEventListener('click', sf_cancelHandler);  
}

function sf_editStudentFinance() {
    document.removeEventListener('click', sf_editHandler);
    document.addEventListener('click', sf_editHandler);
}
$(document).ready(function(el) {
    sf_editStudentFinance();
    sf_cancelStudentFinance();
    sf_saveStudentFinance();
    let tution_total = 0, scholarship_total = 0, student_cost_total= 0;
    let tution = document.querySelectorAll('.tution');
    let scholarship = document.querySelectorAll('.scholarship');
    let student_cost = document.querySelectorAll('.student_cost');
    
    tution.forEach(function(el) {
        el = parseFloat(el.value);
        tution_total += el;
    });
    scholarship.forEach(function(el) {
        el = parseFloat(el.value);
        scholarship_total += el;
    });
    student_cost.forEach(function(el) {
        el = parseFloat(el.value);
        student_cost_total += el;
    });
    $('#total').html("Tuition : $"+tution_total.toFixed(2));
    $('#scholarship_total').html("Scholarship : $"+scholarship_total.toFixed(2));
    $('#student_cost_total').html("Student Cost : $"+student_cost_total.toFixed(2));
});

function grand_calculation()
{
    let tution_total = 0, scholarship_total = 0, student_cost_total= 0;
    let tution = document.querySelectorAll('.tution');
    let scholarship = document.querySelectorAll('.scholarship');
    let student_cost = document.querySelectorAll('.student_cost');
    
    tution.forEach(function(el) {
        el = parseFloat(el.value);
        tution_total += el;
    });
    scholarship.forEach(function(el) {
        el = parseFloat(el.value);
        scholarship_total += el;
    });
    student_cost.forEach(function(el) {
        el = parseFloat(el.value);
        student_cost_total += el;
    });
    $('#total').html("Tuition : $"+tution_total.toFixed(2));
    $('#scholarship_total').html("Scholarship : $"+scholarship_total.toFixed(2));
    $('#student_cost_total').html("Student Cost : $"+student_cost_total.toFixed(2));
}

$(document).on('change','.student_year',function()
{
    var current = $(this).val();
    $.ajax({
   		type: "POST",
   		dataType:"html",
   		url: "<?php echo base_url('admin/Form/getSemester');?>",
   		data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', 'classname':current},
   		success:function(result){
		
		 $('.filter_semester').html(result);
		 
        
		
    	},
        });
})

$(document).on('click','.filter_data',function(){
    var filter_year = $('.student_year :selected').val();
    var filter_semester = $('.filter_semester :selected').val();
    
    var payment_from = $('.payment_from').val();
    var payment_to = $('.payment_to').val();
    
    $('.export_payment_to').val(payment_to);
    $('.export_payment_from').val(payment_from);
    
    $('.export_semester').val(filter_semester);
    $('.export_class').val(filter_year);
    
    var student_id = "<?=esc($segment4)?>";
     $.ajax({
   		type: "POST",
   		dataType:"html",
   		url: "<?php echo base_url('admin/Form/get_ajax_student_finance');?>",
   		data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', filter_year,filter_semester,student_id,payment_from,payment_to},
   		success:function(result){
		    if(result == '')
		    {
		        $('#result').html('No Data');
		    }
		    else
		    {
		        $('#result').html(result);
		    }
		 	
    		 let tution_total = 0, scholarship_total = 0, student_cost_total= 0;
            let tution = document.querySelectorAll('.tution');
            let scholarship = document.querySelectorAll('.scholarship');
            let student_cost = document.querySelectorAll('.student_cost');
            
            tution.forEach(function(el) {
                el = parseFloat(el.value);
                tution_total += el;
            });
            scholarship.forEach(function(el) {
                el = parseFloat(el.value);
                scholarship_total += el;
            });
            student_cost.forEach(function(el) {
                el = parseFloat(el.value);
                student_cost_total += el;
            });
            $('#total').html("Tuition : $"+tution_total.toFixed(2));
            $('#scholarship_total').html("Scholarship : $"+scholarship_total.toFixed(2));
            $('#student_cost_total').html("Student Cost : $"+student_cost_total.toFixed(2));
        	
		
    	},
        });
        
        
        
        
        
     $.ajax({
   		type: "POST",
   		dataType:"html",
   		url: "<?php echo base_url('admin/Form/get_ajax_student_finance_payment');?>",
   		data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', filter_year,filter_semester,student_id,payment_from,payment_to},
   		success:function(result){
		    $('#payment_result').html(result);
		   
    	},
        });
        
        
     $.ajax({
   		type: "POST",
   		dataType:"html",
   		url: "<?php echo base_url('admin/Form/get_ajax_student_finance_certificate_payment');?>",
   		data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', filter_year,filter_semester,student_id,payment_from,payment_to},
   		success:function(result){
		    $('#certificate_payment_result').html(result);
		   
    	},
        });
        
        
        
        
        
        
    
})



$(document).on('click','.scholar_edit',function(){
    var rel_id = $(this).attr('rel_id');
    var course_code = $(this).attr('rel_course_code');
    var course_title = $(this).attr('rel_course_title');
    var semester = $(this).attr('rel_semester');
    var tuition = $(this).attr('rel_tuition');
    var type = $(this).attr('rel_type');
    
    var schol = <?= json_encode($all_scholarships) ?>;
    
    $('#semester').html(semester);
    
    $('#tuition').html(tuition);
    
    $('#m_course_id').val(rel_id);
    $('#type').val(type);
    
    $('#select_class').html($(this).attr('rel_class'));
    
    $('#course_title').html(course_title +" ( "+course_code + " ) ");
    
     
    
    var student_id = "<?= esc($segment4) ?>";
    var course_id = rel_id;
    
          $.ajax({
				type: "POST",
				url: '<?php echo base_url('admin/Form/get_student_finance2');?>',
				data: { student_id,course_id,type},
				dataType: "html",
				success: function(data){
				   // console.log(data);
				  $('.m_result').html('');
				 $('.m_result').append(data);
				 
				 var add_more_size = "<?= sizeof($all_scholarships); ?>";
                 var n = $( ".no_of_row" ).length;
				 
				     var content ='';
        				content+= '<tr id="row_no0" class="no_of_row">';
                        
                        content+= '<td>';
                        content+= '<span id="scholar_span0"></span>';
                        content+= "<select required class='form-control' id='scholar_type0' name='scholar_type[]'>";
                        content+= "<option value=''>Please Select Option</option>";
                        
                        for (i = 0; i < schol.length; i++) {
                          content +="<option value='"+schol[i]['id']+"'>"+schol[i]['name']+"</option>";
                        }
                         
                       
                        content+= "</select>";
                        content+= "</td>";
                        
                        content+= '<td>';
                        content+= '<span id="amount_span0"></span>';
                        content+= "<input required onkeypress='return validateFloatKeyPress(this,event);' type='text' class='form-control amount_modal' id='amount0' name='amount[]'>";
                        content+= '</td>';
                        
                        content+= "<td>";
                        content+= '<span id="message_span0"></span>';
                        content+= "<textarea required class='form-control' id='message0' name='message[]'></textarea>";
                        content+= "</td>";
                        content+= "<td id='edit_td0'>";
                        content+= "<button class='btn btn-success add_detail' rel_no='0'>Add</button>";
                        content+= "</td>";
                        content+= "</tr>";
        				
        				$('.m_result').append(content);
				     
				 
				
				
				},
		   });
		   
		   
    
    
    
    $('#xmyModal2').modal('show');
    
    
    
    
}) 

$(document).on('click','.edit_detail',function(){
    var rel_no = $(this).attr('rel_no');
    var rel=rel_no;
    if($('#amount'+rel_no).length)
    {
        rel=rel_no;
    }
    else
    {
        rel=0;
    }
    
    $('#amount'+rel).show();
    $('#amount_span'+rel).hide();
    $('#scholar_type'+rel).show();
    $('#scholar_span'+rel).hide();
    $('#message'+rel).show();
    $('#message_span'+rel).hide();
    
    $('#edit_td'+rel).html('<button class="btn btn-success update_detail btn-xs" rel_no="'+rel_no+'">Update</button>&nbsp;&nbsp;<button class="btn btn-danger cancel_detail btn-xs" rel_no="'+rel_no+'">Cancel</button>&nbsp;&nbsp;<i class="fa fa-trash delete_record" style="color:red;cursor:pointer;" rel_no="'+rel_no+'"></i>');
    
    
})


$(document).on('click','.delete_record',function(){
    var rel_no = $(this).attr('rel_no');
     var r = confirm("Really you want to delete this record!");
     if (r == true) {
        
        var schol = <?= json_encode($all_scholarships) ?>;
         $.ajax({
				type: "POST",
				url: '<?php echo base_url('admin/Form/delete_student_finance2');?>',
				data: { rel_no },
				dataType: "html",
				success: function(data){
				 if(data)
				 {
				     
				     alert("Record Deleted Successfully");
				     
				        var str1 = window.location.href;
                        var n1 = str1.lastIndexOf('#');
                        if(n1 == -1)
                        {
                            current_url = window.location.href+"#tab15"; 
                        }
                        else
                        {
                            current_url = window.location.href; 
                        }
                          
                        /* win = window.open('','_self');
                         win.close();
    	                window.open(current_url, "_blank"); */
    	                $.ajax({
                            type: "POST",
                            url: '<?php echo base_url('admin/Form/get_student_finance_view_tab_data');?>',
                            data: { 'student_id':student_id,'submit':'submit'},
                            dataType: "html",
                            success: function(data){
                                $('#xmyModal2').modal('hide');
                                $('div').removeClass('modal-backdrop fade in');
                                $('#span_result').html(data);
                            }
                        })
				     
				     var content='';
                            var next = rel_no;
                              content +="<td>";
                                content +=" <span id='scholar_span"+next+"'></span><select required class='form-control' id='scholar_type"+next+"' name='scholar_type[]'>";
                                content +="<option value=''>Please Select Option</option>";
                                for (i = 0; i < schol.length; i++) {
                                  content +="<option value='"+schol[i]['id']+"'>"+schol[i]['name']+"</option>";
                                }
                                
                                content +="</select>";
                              content +="</td>";
                               content+="<td><span id='amount_span"+next+"'></span><input required onkeypress='return validateFloatKeyPress(this,event);' type='text' class='form-control amount_modal' id='amount"+next+"' name='amount[]'></td>";
                             
                              content+="<td><span id='message_span"+next+"'></span><textarea required class='form-control' id='message"+next+"' name='message[]'></textarea></td>";
                              content+="<td id='edit_td"+next+"'><button class='btn btn-success add_detail' rel_no='"+next+"'>Add</button></td>";
                            
                            $('#row_no'+rel_no).html(content);
				     
				     
				     
				 }
				 else
				 {
				     alert("Something Wrong")
				 }
				},
		   }); 
        
        
      } 
})

$(document).on('click','.cancel_detail',function(){
    var rel_no = $(this).attr('rel_no');
    var rel_no1 = rel_no;
   if($('#amount'+rel_no).length)
   {
       rel_no1=rel_no;
   }
   else
   {
    rel_no1=0;   
   }
     $('#amount'+rel_no1).hide();
     $('#scholar_type'+rel_no1).hide();
     $('#message'+rel_no1).hide();
     
     $('#amount_span'+rel_no1).show();
     $('#scholar_span'+rel_no1).show();
     $('#message_span'+rel_no1).show(); 
     $('#edit_td'+rel_no1).html('<button class="btn btn-success edit_detail" rel_no="'+rel_no+'">Edit</button>');
    
    
})


$(document).on('click','.update_detail',function(){
    var rel_no = $(this).attr('rel_no');
    var rel = rel_no;
    if($('#amount'+rel_no).length)
    {
        rel=rel_no;
    }
    else
    {
        rel=0;
    }
    
       var student_id = "<?=esc($segment4)?>";
       var course_id = $('#m_course_id').val();
       var amount = $('#amount'+rel).val();
       var scholar_type= $('#scholar_type'+rel).val();
       
       var scholar_type_text = $( "#scholar_type"+rel+" option:selected" ).text();
       
       var message = $('#message'+rel).val();
       var type = $('#type').val();
       var next = parseInt(rel)+1;
      var edit = "edit";
      
      
      var m_class = $('#select_class').html();
      var m_semester = $('#semester').html();
      
      
      if(student_id == '')
      {
          alert('Invalid Student');
      }
      else if(amount == '')
      {
          alert('Please add Scholarship Amount');
      }
      else if(scholar_type == '')
      {
          alert('Please Select Scholarship Type');
      }
      else
      {
          var tuition = $('#tuition').html();
           $.ajax({
				type: "POST",
				url: '<?php echo base_url('admin/Form/update_student_finance2');?>',
				data: { student_id,course_id,amount,scholar_type,message,type,rel_no,edit,tuition},
				dataType: "json",
				success: function(data){
				if(data=='already_exits')
				{
				    alert("This scholarship is already specified in this course for the student");
				}
				 else if(data == 'over_limit')
				 {
				     alert('Total scholarship shall not exceed tuition fee');
				 }
				 else if(data)
				 {
				     
				     var sum = 0;
                    $(".amount_modal").each(function(){
                        sum += +$(this).val();
                    });
                    
                    if(type == 'course')
                    {
                        $('.td_amount'+course_id).html(sum.toFixed(2));
                        $('.td_student_cost'+course_id).html(tuition-sum);
				    
				        $('.td_amount'+course_id).val(sum);
                        $('.td_student_cost'+course_id).val(tuition-sum);
                        grand_calculation();
                        
                        
                        var sum1 = 0;
                        var total_tuition = $('.tu'+m_class+m_semester).html();
                        $(".td_amount"+m_class+m_semester).each(function(){
                            sum1 += +$(this).html();
                        });
                        
                        var stu_cost = parseFloat(total_tuition)-parseFloat(sum1);
                        $('.sch'+m_class+m_semester).html('Scholarship : '+sum1.toFixed(2));
                        $('.stu'+m_class+m_semester).html('Student Cost : '+stu_cost);
                    }
                    else if(type=='certificate')
                    {
                        //alert("tutuion :"+tuition+" sum :"+sum)
                        $('.td_cert_amount'+course_id).html(sum.toFixed(2));
                        $('.td_cert_student_cost'+course_id).html(parseFloat(tuition)-parseFloat(sum));
				    
				        $('.td_cert_amount'+course_id).val(sum);
                        $('.td_cert_student_cost'+course_id).val(parseFloat(tuition)-parseFloat(sum));
                        grand_calculation();
                        
                        
                        var sum1 = 0;
                        var total_tuition = $('.certtu'+m_class+m_semester).html();
                        $(".td_cert_amount"+m_class+m_semester).each(function(){
                            sum1 += +$(this).html();
                        });
                        
                        var stu_cost = parseFloat(total_tuition)-parseFloat(sum1);
                        $('.certsch'+m_class+m_semester).html('Scholarship : '+sum1.toFixed(2));
                        $('.certstu'+m_class+m_semester).html('Student Cost : '+stu_cost);
                    }
                    
                    
                    
                    
				    
				     
				     $('#amount'+rel).hide();
				     $('#scholar_type'+rel).hide();
				     $('#message'+rel).hide();
				     
				     $('#amount_span'+rel).show();
				     $('#scholar_span'+rel).show();
				     $('#message_span'+rel).show(); 
				     
				     $('#amount_span'+rel).html(amount);
				     $('#scholar_span'+rel).html(scholar_type_text);
				     $('#message_span'+rel).html(message); 
				     $('#edit_td'+rel).html('<button class="btn btn-success edit_detail" rel_no="'+rel_no+'">Edit</button>');
				     
				      var str1 = window.location.href;
                        var n1 = str1.lastIndexOf('#');
                        if(n1 == -1)
                        {
                            current_url = window.location.href+"#tab15"; 
                        }
                        else
                        {
                            current_url = window.location.href; 
                        }
                          
                         /*win = window.open('','_self');
                            win.close();
    	                    window.open(current_url, "_blank");*/
				     
				     alert("Record Update Successfully");
				     
				      $.ajax({
                            type: "POST",
                            url: '<?php echo base_url('admin/Form/get_student_finance_view_tab_data');?>',
                            data: { 'student_id':student_id,'submit':'submit'},
                            dataType: "html",
                            success: function(data){
                                $('#xmyModal2').modal('hide');
                                $('div').removeClass('modal-backdrop fade in');
                                $('#span_result').html(data);
                            }
                        })
				     
				 }
				 else
				 {
				     alert("Something Wrong")
				 }
				},
		   }); 
      }
    
})

</script>

<style>
    .m_th
    {
        text-align:left ! important;
    }
    .require
    {
        color: #ffe4e4;
    font-weight: bold;
    font-size: 18px;
    }
 .table-striped>tbody>tr:nth-of-type(even), .table-striped>tbody>tr:nth-of-type(odd) {
    background: #fff!important;
}
</style>
 <div class="modal fade" id="xmyModal2" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Scholarship</h4>
        </div>
        
        
            
            <input type="hidden" class="form-control" value="<?=esc($segment4)?>" id="m_student_id" name="student_id">
            <input type="hidden" class="form-control" name="course_id" id="m_course_id">
            <input type="hidden" class="form-control" name="type" id="type">
        <div class="modal-body Add_ScholarShip" style="height:400px;overflow-y:scroll;">
          <table class="table" border="1" style="border:2px solid grey;margin-bottom:20px">
              <tr>
                  <th class="m_th">Student Id</th>
                  <td >:</td>
                  <td class="m_th"><?=esc($segment4) ?></td>
              </tr>
              <tr>
                  <th class="m_th">Student Name</th>
                  <td >:</td>
                  <td class="m_th"><?= esc($infos['FirstName'] ?? '') ?></td>
              </tr>
              
              
              
              <tr>
                  <th class="m_th">Course</th>
                  <td>:</td>
                  <td id="course_title" class="m_th"></td>
              </tr>
              
              <tr>
                  <th class="m_th">Class</th>
                  <td>:</td>
                  <td id="select_class" class="m_th"></td>
               </tr>
              
               <tr>
                  <th class="m_th">Semester</th>
                  <td>:</td>
                  <td id="semester" class="m_th"></td>
               </tr>
               
               <tr>
                  <th class="m_th">Tuition</th>
                  <td>:</td>
                  <td id="tuition" class="m_th"></td>
               </tr>
              
              
          </table>
          
          <table class="table " border="1" style="border:2px solid grey;margin-bottom:20px">
              <thead>
                  <tr>
                      <th  class="m_th">Scholarship Type &nbsp;<span class="require">*</span></th>
                      <th class="m_th">Scholarship &nbsp; <span class="require">*</span></th>
                      <th class="m_th">Notes</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody class="m_result">
                  
              </tbody>
              
              
          </table>
          
          <!--div class="col-md-12 form-group" style="float:right;">
              <span class="btn btn-primary btn-xs add_more_schol" rel-count="1" style="float:right;">Add ScholarShip</span>
          </div-->
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          
        </div>
        
        
        
      </div>
      
    </div>
  </div>

<script>
   
   $(document).on('click','.add_detail',function(){
       var rel_no = $(this).attr('rel_no');
       var student_id = "<?=esc($segment4)?>";
       var course_id = $('#m_course_id').val();
       var amount = $('#amount'+rel_no).val();
       var scholar_type= $('#scholar_type'+rel_no).val();
       var message = $('#message'+rel_no).val();
       var type = $('#type').val();
       var next = parseInt(rel_no)+1;
       
       var schol = <?= json_encode($all_scholarships) ?>;
       
       var add_more_size = "<?= sizeof($all_scholarships); ?>";
       var n = $( ".no_of_row" ).length;
       
       var m_class = $('#select_class').html();
      var m_semester = $('#semester').html();
       
       
       var scholar_type_text = $( "#scholar_type"+rel_no+" option:selected" ).text();
      
      if(student_id == '')
      {
          alert('Invalid Student');
      }
      else if(amount == '')
      {
          alert('Please add Scholarship Amount');
      }
      else if(amount < 1)
      {
          alert('Please select valid amount');
      }
      else if(scholar_type == '')
      {
          alert('Please Select Scholarship Type');
      }
      else
      {
         var tuition = $('#tuition').html();
        
         $.ajax({
				type: "POST",
				url: '<?php echo base_url('admin/Form/store_student_finance2');?>',
				data: { student_id,course_id,amount,scholar_type,message,type,tuition},
				dataType: "json",
				success: function(data){
				    
				    next = parseInt(data)+1;
				if(data == 'over_limit')
				{
				    alert("Total scholarship shall not exceed tuition fee");
				}
				else if(data=='already_exits')
				{
				    alert("This scholarship is already specified in this course for the student");
				}
				 else if(data)
				 {
				    alert("Data inserted successfully");
				    
				    
				     var str1 = window.location.href;
                        var n1 = str1.lastIndexOf('#');
                        if(n1 == -1)
                        {
                            current_url = window.location.href+"#tab15"; 
                        }
                        else
                        {
                            current_url = window.location.href; 
                        }
                          
                         /*win = window.open('','_self');
                         win.close();
    	                window.open(current_url, "_blank"); */
    	                $.ajax({
                            type: "POST",
                            url: '<?php echo base_url('admin/Form/get_student_finance_view_tab_data');?>',
                            data: { 'student_id':student_id,'submit':'submit'},
                            dataType: "html",
                            success: function(data){
                                $('#xmyModal2').modal('hide');
                                $('div').removeClass('modal-backdrop fade in');
                                $('#span_result').html(data);
                            }
                        })
				    
				    
				    
				    
				    
				    
				    
				        var sum = 0;
                    $(".amount_modal").each(function(){
                        sum += +$(this).val();
                    });
                    
                    if(type == 'course')
                    {
                        $('.td_amount'+course_id).html(sum.toFixed(2));
                        $('.td_student_cost'+course_id).html(tuition-sum);
				    
				        $('.td_amount'+course_id).val(sum);
                        $('.td_student_cost'+course_id).val(tuition-sum);
                        grand_calculation();
                        
                        
                        var sum1 = 0;
                        var total_tuition = $('.tu'+m_class+m_semester).html();
                        $(".td_amount"+m_class+m_semester).each(function(){
                            sum1 += +$(this).html();
                        });
                        
                        var stu_cost = parseFloat(total_tuition)-parseFloat(sum1);
                        $('.sch'+m_class+m_semester).html('Scholarship : $'+sum1.toFixed(2));
                        $('.stu'+m_class+m_semester).html('Student Cost : $'+stu_cost);
                    }
                    else if(type=='certificate')
                    {
                        $('.td_cert_amount'+course_id).html(sum.toFixed(2));
                        $('.td_cert_student_cost'+course_id).html(tuition-sum);
				    
				        $('.td_cert_amount'+course_id).val(sum);
                        $('.td_cert_student_cost'+course_id).val(tuition-sum);
                        grand_calculation();
                        
                        
                        var sum1 = 0;
                        var total_tuition = $('.certtu'+m_class+m_semester).html();
                        $(".td_cert_amount"+m_class+m_semester).each(function(){
                            sum1 += +$(this).html();
                        });
                        
                        var stu_cost = parseFloat(total_tuition)-parseFloat(sum1);
                        $('.certsch'+m_class+m_semester).html('Scholarship $: '+sum1.toFixed(2));
                        $('.certstu'+m_class+m_semester).html('Student Cost $: '+stu_cost);
                    }
				    
				    
				    
				     $('#amount'+rel_no).hide();
				     $('#scholar_type'+rel_no).hide();
				     $('#message'+rel_no).hide();
				     
				      $('#amount_span'+rel_no).show();
				     $('#scholar_span'+rel_no).show();
				      $('#message_span'+rel_no).show();
				      
				     $('#amount_span'+rel_no).html(amount);
				     $('#scholar_span'+rel_no).html(scholar_type_text);
				      $('#message_span'+rel_no).html(message);
				      $('#edit_td'+rel_no).html('<button class="btn btn-success edit_detail" rel_no='+data+'>Edit</button></i>');
    
				     
				         var content='';
                            content+="<tr id='row_no"+next+"' class='no_of_row'>";
                              content +="<td>";
                                content +=" <span id='scholar_span"+next+"'></span><select required class='form-control' id='scholar_type"+next+"' name='scholar_type[]'>";
                                content +="<option value=''>Please Select Option</option>";
                                for (i = 0; i < schol.length; i++) {
                                  content +="<option value='"+schol[i]['id']+"'>"+schol[i]['name']+"</option>";
                                }
                                
                                content +="</select>";
                              content +="</td>";
                               content+="<td><span id='amount_span"+next+"'></span><input required onkeypress='return validateFloatKeyPress(this,event);' type='text' class='form-control amount_modal' id='amount"+next+"' name='amount[]'></td>";
                             
                              content+="<td><span id='message_span"+next+"'></span><textarea required class='form-control' id='message"+next+"' name='message[]'></textarea></td>";
                              content+="<td id='edit_td"+next+"'><button class='btn btn-success add_detail' rel_no='"+next+"'>Add</button></td>";
                            content+="</tr>";
                            $('.m_result').append(content);
				     
				      
				     
				 }
				 else
				 {
				     alert("Something Wrong")
				 }
				},
		   }); 
      }
      
    /*   $.ajax({
				type: "POST",
				url: '<?php echo base_url('admin/Master/getCourseByTerm');?>',
				data: { 'term':term},
				dataType: "html",
				success: function(data){
				$('#Course').html(data);
				},
		});*/
       
   })

    $(document).on('click','.add_more_schol',function(){
       var count = $(this).attr('rel-count');
       var next = parseInt(count)+1;
       
       $(this).attr('rel-count',next);
       
        var content='';
        content+="<tr>";
          content+="<td><input required onkeypress='return validateFloatKeyPress(this,event);' type='text' class='form-control amount_modal' id='amount"+next+"' name='amount[]'></td>";
          content +="<td>";
            content +="<select required class='form-control' id='scholar_type"+next+"' name='scholar_type[]'>";
            content +="<option value=''>Please Select Option</option>";
            content +="<option value='Americorps/Segal'>Americorps/Segal</option>";
            content +="<option value='Coverdell'>Coverdell</option>";
            content +="<option value='Institutional'>Institutional</option>";
            content +="</select>";
          content +="</td>";
          content+="<td><textarea required class='form-control' id='message"+next+"' name='message[]'></textarea></td>";
          content+="<td id='edit_td"+next+"'><button class='btn btn-success add_detail' rel_no='"+next+"'>Add</button></td>";
        content+="</tr>";
        $('.m_result').append(content);
        
    })
    
    function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
	if (o.createTextRange) {
		var r = document.selection.createRange().duplicate()
		r.moveEnd('character', o.value.length)
		if (r.text == '') return o.value.length
		return o.value.lastIndexOf(r.text)
	} else return o.selectionStart
}

$(document).on('click','#form_submit',function(){
    alert("Hii");
    
    
     $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>/admin/Form/store_student_finance2",
                    data:  $('#form_data').serialize(),
                   dataType: "json",
                    success: function(data) {
                        
                    },
                    error: function() {
                        alert('error handling here');
                    }
                });
})
    
    
    
    /*$(document).ready(function(){
        $("#idForm").submit(function(e) {
        
            e.preventDefault(); // avoid to execute the actual submit of the form.
        
            var form = $(this);
            var url = form.attr('action');
            
            $.ajax({
                   type: "POST",
                   url: url,
                   data: form.serialize(), // serializes the form's elements.
                   success: function(data)
                   {
                       alert(data); // show response from the php script.
                   }
                 });
        
            
        });
    })*/



$(document).on('click','.link_payment',function(){
 $('.link_class_semester').prop('disabled', false);    
    $('#define_class').val('');
		$('#define_semester').val('');
		$('#user_id_donor').val('');
         $('.user_class').val('');
         $('#user_semester').val('');
    
    
    var row_id = $(this).attr('rel_id');
    $('#user_id_donor').val(row_id);
     $('#user_semester').html('<option value="">Select Semester</option>');
    $('#link_payment_modal').modal('show');
})



$(document).on('click','.cert_link_payment',function(){
 $('.link_class_semester').prop('disabled', false);    
    $('#define_class').val('');
		$('#cert_define_semester').val('');
		$('#cert_user_id_donor').val('');
         $('.cert_user_class').val('');
         $('#cert_user_semester').val('');
    
    
    var row_id = $(this).attr('rel_id');
    $('#cert_user_id_donor').val(row_id);
     $('#cert_user_semester').html('<option value="">Select Semester</option>');
    $('#cert_link_payment_modal').modal('show');
})


$(document).on('click','.confirm_link_payment',function(){
    $('.link_class_semester').prop('disabled', false);
    	$('#define_class').val('');
		$('#define_semester').val('');
		$('#user_id_donor').val('');
         $('.user_class').val('');
         $('#user_semester').val('');
    
     var row_id = $(this).attr('rel_id');
     var rel_class=$(this).attr('rel_class');
     var rel_semester = $(this).attr('rel_semester');
     
     
     var c_class = rel_class;
    
    
     $.ajax({
   		type: "POST",
   		dataType:"html",
   		url: "<?php echo base_url('admin/Form/getSemester');?>",
   		data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', 'classname':c_class},
   		success:function(result){
		
		
		$('#define_class').val(rel_class);
		$('#define_semester').val(rel_semester);
		
		 $('#user_semester').html(result);
		 $('#user_id_donor').val(row_id);
         $('.user_class').val(rel_class);
         $('#user_semester').val(rel_semester);
         $('#link_payment_modal').modal('show');
        
		
    	},
        });
     
    
})



$(document).on('change','.user_class',function(){
    var c_class = $(this).val();
     $('#set_img').html('<img style="height: 31px;margin-top: 15px;" src="<?= base_url() ?>assets/loading_clock2.gif">');
    if(c_class != '')
    {
       
        
        $.ajax({
   		type: "POST",
   		dataType:"html",
   		url: "<?php echo base_url('admin/Form/getSemester');?>",
   		data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', 'classname':c_class},
   		success:function(result){
		
		 $('#user_semester').html(result);
		 
            $('#set_img').html('');
		
    	},
        });
    }
    else
    {
         $('#user_semester').html('<option value="">Select Semester</option>');
		 
            $('#set_img').html('');
    }

    
     
    
})

$(document).on('click','.link_class_semester',function(){
    
    var selected_class = $( ".user_class option:selected" ).val();
    var selected_semester = $( "#user_semester option:selected" ).val();
    var donor_row_id = $('#user_id_donor').val();
    var submit = "submit";
    
    var define_class = $('#define_class').val();
    var define_semester = $('#define_semester').val();
    
    var change_status = 'No';
    
    if(define_class != '' && define_semester != '')
    {
        if(define_class == selected_class && define_semester == selected_semester)
        {
            
        }
        else
        {
            change_status ='Yes';
        }
    }
    
    if(selected_class =='')
    {
        alert("Please Select Class");
    }
    else if(selected_semester == '')
    {
        alert("Please Select Semester");
    }
    else
    {
        $('.link_class_semester').prop('disabled', true);
        $('#link_payment_modal').modal('hide');
          $.ajax({
   		type: "POST",
   		dataType:"json",
   		url: "<?php echo base_url('admin/Form/update_class_semester_donation');?>",
   		data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', 'selected_class':selected_class,'selected_semester':selected_semester,'donor_row_id':donor_row_id,'submit':submit,"change_status":change_status},
   		success:function(result){
		alert('Payment Linked Successfully')
		/*current_url = window.location.href;
		win = window.open('','_self');
                         //win.close();
    	                window.open(current_url, "_self");*/
    	                location.reload();
    	},
        });     
    }
    
   
    
})
 
    
</script>

<style>
   .semester_outter {
        display: flex;
        
        justify-content: space-between;
    }
</style>

<div class="modal fade" id="link_payment_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Link Year & Semester</h4>
        </div>
        <div class="modal-body">
           <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <input type="hidden" class="form-control" id="user_id_donor">
                       
                       <input type="hidden" id="define_class" class="form-control">
                       
                       <input type="hidden" id="define_semester" class="form-control">
                       
                      
                         <label>Year</label>
                           <select class="form-control user_class">
                               <option value="">Select Year</option>
                               <?php
                                foreach($assign_class as $ac)
                                {
                                    ?>
                                    <option value="<?= $ac['Class'] ?>"><?= $ac['Class'] ?></option>
                                    <?php
                                }
                               ?>
                           </select>    
                       
                       
                   </div>
                   
                   
                   
                   
                   <div class="form-group">
                       
                       
                       <div class="row">
                                        <div class="col-md-12">
									    	<div class="form-group">
									    	    
									    	    <div class="semester_outter">
            										<div style="width:100%;">
            											<label>Semester</label>
                                                           <select class="form-control" id="user_semester">
                                                               <option value="">Select Semester</option>
                                                               
                                                           </select>
            										</div>
            										<small id="set_img">
            										<!--img style="height: 31px;margin-top: 15px;" src='<?= base_url() ?>assets/loading_clock2.gif'-->
            										</a>
            										</small>
            									</div>
										
											</div>
								    </div>
                       </div>
                       
                       <!--div class="row">
                           <div class="col-md-10">
                               <label>Semester</label>
                               <select class="form-control" id="user_semester">
                                   <option value="">Select Semester</option>
                                   
                               </select>
                           </div>
                            <div class="col-md-2" >
                               <img style="width:50%;" src='<?= base_url() ?>assets/loading_clock2.gif'> </option>
                           </div>
                       </div-->
                       
                   </div>
               </div>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success link_class_semester">Submit</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
  
  <div class="modal fade" id="cert_link_payment_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Link Year & Semester</h4>
        </div>
        <div class="modal-body">
           <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <input type="hidden" class="form-control" id="cert_user_id_donor">
                       
                       <input type="hidden" id="cert_define_class" class="form-control">
                       
                       <input type="hidden" id="cert_define_semester" class="form-control">
                       
                      
                         <label>Year</label>
                           <select class="form-control cert_user_class">
                               <option value="">Select Year</option>
                               <?php
                                foreach($cert_assign_class as $ac)
                                {
                                    ?>
                                    <option value="<?= $ac['Class'] ?>"><?= $ac['Class'] ?></option>
                                    <?php
                                }
                               ?>
                           </select>    
                       
                       
                   </div>
                   
                   
                   
                   
                   <div class="form-group">
                       
                       
                       <div class="row">
                                        <div class="col-md-12">
									    	<div class="form-group">
									    	    
									    	    <div class="semester_outter">
            										<div style="width:100%;">
            											<label>Semester</label>
                                                           <select class="form-control" id="cert_user_semester">
                                                               <option value="">Select Semester</option>
                                                               
                                                           </select>
            										</div>
            										<small id="cert_set_img">
            										<!--img style="height: 31px;margin-top: 15px;" src='<?= base_url() ?>assets/loading_clock2.gif'-->
            										</a>
            										</small>
            									</div>
										
											</div>
											<span style="float:right;">
											    <?php
											      if(empty($cert_assign_class))
											      {
											         ?>
											         <a target="_blank" href="<?= base_url() ?>admin/Master/addCertificate">* Update Class And Semester</a>
											         <?php
											      }
											    ?>
											</span>
								    </div>
                       </div>
                       
                       <!--div class="row">
                           <div class="col-md-10">
                               <label>Semester</label>
                               <select class="form-control" id="user_semester">
                                   <option value="">Select Semester</option>
                                   
                               </select>
                           </div>
                            <div class="col-md-2" >
                               <img style="width:50%;" src='<?= base_url() ?>assets/loading_clock2.gif'> </option>
                           </div>
                       </div-->
                       
                   </div>
               </div>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success cert_link_class_semester">Submit</button>
        </div>
      </div>
      
    </div>
  </div>
  
  <script>
      $(document).on('change','.cert_user_class',function(){
    var c_class = $(this).val();
     $('#cert_set_img').html('<img style="height: 31px;margin-top: 15px;" src="<?= base_url() ?>assets/loading_clock2.gif">');
    if(c_class != '')
    {
       
        
        $.ajax({
   		type: "POST",
   		dataType:"html",
   		url: "<?php echo base_url('admin/Form/get_cert_Semester');?>",
   		data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', 'classname':c_class},
   		success:function(result){
		
		 $('#cert_user_semester').html(result);
		 
            $('#cert_set_img').html('');
		
    	},
        });
    }
    else
    {
         $('#cert_user_semester').html('<option value="">Select Semester</option>');
		 
            $('#cert_set_img').html('');
    }

    
     
    
})





$(document).on('click','.cert_link_class_semester',function(){
    
    var selected_class = $( ".cert_user_class option:selected" ).val();
    var selected_semester = $( "#cert_user_semester option:selected" ).val();
    var donor_row_id = $('#cert_user_id_donor').val();
    var submit = "submit";
    
    var define_class = $('#define_class').val();
    var define_semester = $('#define_semester').val();
    
    var change_status = 'No';
    
    if(define_class != '' && define_semester != '')
    {
        if(define_class == selected_class && define_semester == selected_semester)
        {
            
        }
        else
        {
            change_status ='Yes';
        }
    }
    
    if(selected_class =='')
    {
        alert("Please Select Class");
    }
    else if(selected_semester == '')
    {
        alert("Please Select Semester");
    }
    else
    {
        $('.cert_link_class_semester').prop('disabled', true);
        $('#cert_link_payment_modal').modal('hide');
          $.ajax({
   		type: "POST",
   		dataType:"json",
   		url: "<?php echo base_url('admin/Form/update_class_semester_donation');?>",
   		data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', 'selected_class':selected_class,'selected_semester':selected_semester,'donor_row_id':donor_row_id,'submit':submit,"change_status":change_status},
   		success:function(result){
		alert('Payment Linked Successfully')
		/*current_url = window.location.href;
		win = window.open('','_self');
                         //win.close();
    	                window.open(current_url, "_self");*/
    	                location.reload();
    	},
        });     
    }
    
   
    
})


$(document).on('click','.generate_invoice',function(){
   $('#generate_invoice_modal').modal('show');
})

$(document).on('change','.invoice_class',function(){
    let class_id = $(this).val();
    let student_id = "<?=esc($segment4) ?>";
    if(class_id != ''){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/Form/get_user_Semester');?>",
            data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', 'classname':class_id,'student_id':student_id},
            success:function(result){
                $('#invoice_semester').html(result);
            },
        });
    }
    else{
        
    }
})
</script>

<div id="generate_invoice_modal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="margin-left: 40%;">

    <!-- Modal content-->
    <div class="modal-content modal-sm">
      <div class="modal-header" style="padding:0px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Course Filter</h4>
      </div>
      <form method="post" target="_blank" action="<?= base_url('admin/Form/create_student_finance_invoice') ?>">
      <div class="modal-body">
           <div class="row">
               <div class="col-md-12">
                   <label class="label-control">Class</label>
                   <input type="hidden" class="form-control" name="student_id" value="<?=esc($segment4) ?>">
                   <?= csrf_field() ?>
                   <select class="form-control invoice_class" name="invoice_class" required> 
                        <option value="">--Select Class--</option>
                        <?php foreach($assign_class as $row){?>
                        <option value="<?php echo $row['Class']?>"><?php echo $row['Class'];?></option>
                        <?php }?>
                    </select>
               </div>
               
               <div class="col-md-12">
                   <label class="label-control">Semester</label>
                   <select class="form-control" id="invoice_semester" name="invoice_semester" required> 
                        <option value="">--Select Semester--</option> 
                    </select>
               </div>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Invoice</button>
      </div>
      </form>
    </div>

  </div>
</div>

<!-- Start Certificate Invoice -->
<script>
    $(document).on('click','.certificate_invoice',function(){
       $('#generate_certificate_invoice_modal').modal('show');
    })
    
    $(document).on('change','.invoice_certificate_class',function(){
        let selected_class = $(this).val();
        if(selected_class != ''){
            $.ajax({
                type: "POST",
                dataType:"html",
                url: "<?php echo base_url('admin/Form/get_cert_Semester');?>",
                data:{'<?= csrf_token() ?> : <?= csrf_hash() ?>', 
                        'classname':selected_class},
                success:function(result){
                    $('#invoice_certificate_semester').html(result);
                    
                },
            });
        }
        else{
            $('#cert_user_semester').html('<option value="">Select Semester</option>');
        }
    })
    
    
    
     
    

</script>


<div id="generate_certificate_invoice_modal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="margin-left: 40%;">

    <!-- Modal content-->
    <div class="modal-content modal-sm">
      <div class="modal-header" style="padding:0px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Certificate Filter</h4>
      </div>
      <form method="post" target="_blank" action="<?= base_url('admin/Form/create_student_certificate_invoice') ?>">
      <div class="modal-body">
           <div class="row">
               <div class="col-md-12">
                   <label class="label-control">Class</label>
                   <input type="hidden" class="form-control" name="student_id" value="<?=esc($segment4)?>">
                   <?= csrf_field() ?>
                   <select class="form-control invoice_certificate_class" name="invoice_certificate_class" required> 
                        <option value="">--Select Class--</option>
                        <?php foreach($cert_assign_class as $row){?>
                        <option value="<?php echo $row['Class']?>"><?php echo $row['Class'];?></option>
                        <?php }?>
                    </select>
               </div>
               
               <div class="col-md-12">
                   <label class="label-control">Semester</label>
                   <select class="form-control" id="invoice_certificate_semester" name="invoice_certificate_semester" required> 
                        <option value="">--Select Semester--</option> 
                    </select>
               </div>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Invoice</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!-- End Certificate invoice -->