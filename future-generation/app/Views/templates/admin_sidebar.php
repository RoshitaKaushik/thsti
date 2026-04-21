<style>
    #wrapper.enlarged .left.side-menu {
    
    position: relative ! important;
}
#wrapper {

    display: flex;
}

#wrapper.enlarged .content-page {
    margin-left: 0;
    width: 100%;
}
#wrapper.enlarged .left.side-menu #sidebar-menu ul li:nth-of-type(13):hover ul, #wrapper.enlarged .left.side-menu #sidebar-menu ul li:nth-of-type(14):hover ul, #wrapper.enlarged .left.side-menu #sidebar-menu ul li:nth-of-type(15):hover ul, #wrapper.enlarged .left.side-menu #sidebar-menu ul li:nth-of-type(15):hover ul {
    margin-top: 1px;
    bottom: 100%;
}
.content-page {

    width: 100%;
}

</style>


<?php
$folder1 = trim(service('uri')->getSegment(1));
$controller1 = trim(service('uri')->getSegment(2));
$method1 = trim(service('uri')->getSegment(3));

$action = trim($folder1.'/'.$controller1);
$subaction = trim($folder1.'/'.$controller1.($method1 == '' ? '' : "/".$method1));

//echo "<pre>"; print_r(session()->get());
//check menu access

$show_hr = $show_finance = $show_registrar = $show_class_reports=$show_vip_reports = false;
if(session()->get('profiles')){					
	if(in_array(5, session()->get('profiles')) || in_array(6, session()->get('profiles'))){
		$show_hr = true;
	}

	if(in_array(3, session()->get('profiles')) || in_array(4, session()->get('profiles'))){
		$show_finance = true;
	}

	if(in_array(1, session()->get('profiles')) || in_array(2, session()->get('profiles'))){
		$show_registrar = true;
	}
	
	if(in_array(7, session()->get('profiles')) || in_array(8, session()->get('profiles'))){
		$show_vip_reports = true;
	}
	if(in_array(7, session()->get('profiles')) || in_array(8, session()->get('profiles')) || in_array(1, session()->get('profiles')) || in_array(2, session()->get('profiles'))){
		$show_class_reports = true;
	}
	
		// Apoorv 4-aug-2020
	if(in_array(14, session()->get('profiles')) || in_array(7, session()->get('profiles')) || in_array(8, session()->get('profiles')) || in_array(1, session()->get('profiles')) || in_array(2, session()->get('profiles'))){
		$show_class_reports = true;
		
		
		
		$all_user_report_menu = array_filter(session()->get('assigned_menu'), function($el) {
		    return $el['parent_id'] == '7';
		});
		if(count($all_user_report_menu) > 0) {
		    $show_class_reports = true;
		} else {
		    $show_class_reports = false;
		}
	}
	// End of array
	
	//By Add TimeEdit Group For Timesheet Menu
	$show_class_timesheet = false;
	if(in_array(13, session()->get('profiles'))){
		$show_class_timesheet = true;
	}
}

?>
<style>
.menu--main {
  display: block;
  position: absolute;
  bottom: 0;
}

.menu--main li {
  display: inline-block;
  position: relative;
  cursor: pointer;
  padding: 15px 20px;
  background-color: #f8f9fa; /* $menu-bg */
  margin-right: -4px;  /* remove spacing between list items */
  transition: all 0.2s;
}

.menu--main li:hover {
  background-color: #e6e6e6; /* darken $menu-bg ~9% */
}

.menu--main li:hover .sub-menu {
  max-height: 300px;
  visibility: visible;
  bottom: 100%;  /* align to top of parent element */
  transition: all 0.4s linear;
}

.sub-menu {
  display: block;
  visibility: hidden;
  position: absolute;
  left: 0;
  box-shadow: none;
  max-height: 0;
  width: 150px;
  overflow: hidden;
  transition: all 0.4s linear;
}

.sub-menu li {
  display: block;
  background-color: #f8f9fa; /* same as menu background */
}

</style>
<div class="left side-menu">
	<div class="sidebar-inner slimscrollleft">
    <div class="user-details">
        <div class="pull-left">
            <?php
            if(session()->get('profile_image') != ''){
              $img_path = session()->get('profile_image');
            }else{
              $img_path = 'assets/images/user.png';
            }

            ?>
            <img src="<?php echo base_url($img_path)?>" alt="alt" class="thumb-md img-circle">
        </div>
        <div class="user-info">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo session()->get('admin_fullname'); ?> </a>
                
            </div>           
        </div>
    </div>

		<!--- Divider  admin/Users/viewDashboard  -->
		<div id="sidebar-menu">
			<ul>
			    <?php if($_SESSION['role'] == 1 || $show_registrar){ ?>

				<li <?php if(trim($subaction) == 'admin/Dashboard_new/viewDashboard'){ echo 'class="active"';} ?>>
					<a <?php if(trim($subaction) == 'admin/Dashboard_new/viewDashboard'){ echo 'class="active"';} ?> href="<?=base_url('admin/Dashboard_new/viewDashboard')?>"><i class="fa fa-home"></i><span> Dashboard</span></a>
				</li>
				<?php } ?>
				<?php if($_SESSION['role'] == 1){ ?>

				<!--li <?php if(trim($subaction) == 'admin/Dashboard/viewDashboard'){ echo 'class="active"';} ?>>
					<a <?php if(trim($subaction) == 'admin/Dashboard/viewDashboard'){ echo 'class="active"';} ?> href="<?=base_url('admin/Dashboard/viewDashboard')?>"><i class="fa fa-home"></i><span> Dashboard</span></a>
				</li-->
				<?php } ?>
				<?php
				if($_SESSION['role'] != 3){ 
				 if($_SESSION['role'] == 1 || $show_vip_reports)
				 {
				?>
				<li <?php if(trim($subaction) == 'admin/Form/ViewAppList'){ echo 'class="active"';} ?>>
					<a <?php if(trim($subaction) == 'admin/Form/ViewAppList'){ echo 'class="active"';} ?> href="<?=base_url('admin/Form/ViewAppList')?>"><i class="ion-ios7-telephone"></i><span> Contact </span></a>
				</li>
				<?php } } ?>
				
				<?php if(session()->get('role') == 1 || $show_finance){?>
                    <li <?php if(trim($subaction) == 'admin/Form/relationships'){ echo 'class="active"';} ?>>
                        <a <?php if(trim($subaction) == 'admin/Form/relationships'){ echo 'class="active"';} ?> href="<?=base_url('admin/Form/relationships')?>"><i class="ion-ios7-home"></i><span> Organization </span></a>
                    </li>
				<?php } ?>
				
				<?php if($_SESSION['role'] == 1){ ?>
				<li class="has_sub">
					<a href="#" class="waves-effect <?php if(trim($subaction) == 'admin/Users/viewUsers' ||  trim($subaction) == 'admin/Users/profile_management'){ echo "subdrop"; }?>">
						<i class="ion-android-social-user"></i>
						<span>User Management </span> <span class="pull-right"><i class="md <?php if(trim($subaction) == 'admin/Users/viewUsers' ||  trim($subaction) == 'admin/Users/profile_management'){ echo "md-remove"; } else { echo "md-add"; } ?>"></i>
						</span>
					</a>
					<ul class="list-unstyled" <?php if(trim($action) == 'admin/Users'){ echo " "; } ?>>
						<li <?php if(trim($subaction) == 'admin/Users/viewUsers'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Users/viewUsers')?>"><span> Manage Users</span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Users/profile_management'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Users/profile_management')?>"><span>Manage Profile</span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Assign_form/'){ echo " ";} ?>>
    					    <a <?php if(trim($subaction) == 'admin/Assign_form/'){ echo "";} ?> href="<?=base_url('admin/Assign_form/')?>">
    					        <span>Manage Forms</span></a>
    				    </li>
						
					</ul>
				</li>
		
				
				<?php }?>
				
				<?php if($_SESSION['role'] == 1 || in_array(1, session()->get('profiles'))){ ?>
				<li class="has_sub">
					<a href="#" class="waves-effect <?php if(trim($subaction) == 'admin/Master/addCountry'  ||trim($subaction) == 'admin/Master/addState'   ||trim($subaction) == 'admin/Master/addClass'  ||trim($subaction) == 'admin/Master/addCourselist'  ||trim($subaction) == 'admin/Master/addGrades'  || trim($subaction) == 'admin/Master/addPaymentType'  ||trim($subaction) == 'admin/Master/addRegionProgram'){ echo "subdrop"; }?>">
						<i class="ion-briefcase"></i>
						<span> Administration </span> <span class="pull-right"><i class="md <?php if(trim($action) == 'admin/Master' ){ echo "md-remove"; } else { echo "md-add"; } ?>"></i></span>
					</a>
					<ul class="list-unstyled" <?php if(trim($action) == 'admin/Master'){ echo " "; } ?>>
					     <?php if($_SESSION['role'] == 1 || in_array(1, session()->get('profiles'))){ ?>
						<li <?php if(trim($subaction) == 'admin/Master/addCountry'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Master/addCountry')?>"><span>Country </span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Master/addState'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Master/addState')?>"><span>State </span> </a>
						</li>
						<?php  } ?>
						 <?php if($_SESSION['role'] == 1){ ?>
						<li <?php if(trim($subaction) == 'admin/Master/addCampaigns'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Master/addCampaigns')?>"><span>Campaigns </span> </a>

						</li>
						<!--<li <?php // if(trim($subaction) == 'admin/Master/addClass'){ echo 'class="active"';} ?>>
							<a href="<? //= base_url('admin/Master/addClass')?>"><span>Class </span> </a>
						</li> -->
						
						<li <?php if(trim($subaction) == 'admin/Master/addPaymentType'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Master/addPaymentType')?>"><span>Payment Type </span> </a>
						</li>
						<?php } ?>
						
						
						
						<!--<li <?php /*if(trim($subaction) == 'admin/Master/addCertTranscript'){ echo 'class="active"';} */?>>
							<a href="<?php /* echo base_url('admin/Master/addCertTranscript')*/?>"><span>CertTranscript </span> </a>
						</li>-->
					
					</ul>
				</li>
				<?php } ?>
				
				
				<!-- by prabhat 28-07-2021 -->
				
				<?php
				if($_SESSION['role'] == 1 || $show_class_reports){	?>
				<li class="has_sub <?=$subaction ?>">
					<a href="#" class="waves-effect <?php if(trim($subaction) == 'admin/Master/addClassListing' || trim($subaction) == 'admin/Master/addVIPMailingList' || trim($subaction) == 'admin/Master/addStudentPassportList​'  || trim($subaction) == 'admin/Master/addGeneralMailingList'  || trim($subaction) == 'admin/Master/addDonorReport'|| trim($subaction) == 'admin/Master/addDonorMailingList'  || trim($subaction) == 'admin/Master/addDonationsReport'){ echo "subdrop"; }?>">
						<i class="fa fa-book"></i>
						<span> Reports </span> <span class="pull-right"><i class="md <?php if(trim($action) == 'admin/Master'){ echo "md-remove"; } else { echo "md-add"; } ?>"></i></span>
					</a>
					<ul class="sub-menu" <?php if(trim($action) == 'admin/Reports'){ echo " "; } ?>>
					   <?php if(session()->get('role') == 1) : ?>
					   <?php
					   	$all_admin_report_menu = array_filter(session()->get('all_menu'), function($el) {
                        		   return $el['parent_id'] == '7';
                		});
                	
                		
                		?>
    				        <?php foreach($all_admin_report_menu as $ra) :?>
					            <li <?php if(trim($subaction) == $ra['menu_link']){ echo 'class="active"';} ?>>
				                	<a  href="<?=base_url()?><?=$ra['menu_link']?>"><span><?=$ra['child_name']?></span> </a>
					            </li>
					        <?php endforeach; ?>
					   <?php else : ?>
					        <?php foreach($all_user_report_menu as $ra) :?>
					            <li <?php if(trim($subaction) == $ra['menu_link']){ echo 'class="active"';} ?>>
				                	<a  href="<?=base_url()?><?=$ra['menu_link']?>"><span><?=$ra['child_name']?></span> </a>
					            </li>
					        <?php endforeach; ?>
					        
					      
					   <?php endif; ?>
					   
					  
					  
						
						
					   
					</ul>
				</li>
			
			<?php } ?>
			
				
				
				<!-- End Prabhat 28-07-2021 -->
				
				
				<?php
				if($_SESSION['role'] == 1 || $_SESSION['role']==2){	?>
				<!--li class="has_sub <?=$subaction ?>">
					<a href="#" class="waves-effect <?php if(trim($subaction) == 'admin/Master/addClassListing' || trim($subaction) == 'admin/Master/addVIPMailingList' || trim($subaction) == 'admin/Master/addStudentPassportList​'  || trim($subaction) == 'admin/Master/addGeneralMailingList'  || trim($subaction) == 'admin/Master/addDonorReport'|| trim($subaction) == 'admin/Master/addDonorMailingList'  || trim($subaction) == 'admin/Master/addDonationsReport'){ echo "subdrop"; }?>">
						<i class="ion-clipboard"></i>
						<span> Reports </span> <span class="pull-right"><i class="md <?php if(trim($action) == 'admin/Master'){ echo "md-remove"; } else { echo "md-add"; } ?>"></i></span>
					</a>


					<ul class="sub-menu" <?php if(trim($action) == 'admin/Reports'){ echo " "; } ?>>
					  
					  
					   <?php if(session()->get('role') == 1 ||  $show_class_reports){?>
						<li <?php if(trim($subaction) == 'admin/Reports/classListing'){ echo 'class="active"';} ?>>
							<a  href="<?=base_url('admin/Reports/classListing')?>"><span>Class Listing </span> </a>
						</li>
					   <?php }?>
					   <?php if(session()->get('role') == 1 ||  $show_class_reports){?>
						<li <?php if(trim($subaction) == 'admin/Reports/classListingcertificates'){ echo 'class="active"';} ?>>
							<a  href="<?=base_url('admin/Reports/classListingcertificates')?>"><span>Class Listing Certificates </span> </a>
						</li>
						
						
					   <?php }?>
						
						
						
						<?php if(session()->get('role') == 1 || $show_vip_reports){?>
						<li <?php if(trim($subaction) == 'admin/Reports/addGeneralMailingList'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Reports/addGeneralMailingList')?>"><span>General Mailing List </span> </a>
						</li>
						
						<?php }?>
						<?php if(session()->get('role') == 1  ||in_array(2, session()->get('profiles'))){?>
						<li <?php if(trim($subaction) == 'admin/Reports/classListingcertificates'){ echo 'class="active"';} ?>>
							<a  href="<?=base_url('admin/Reports/SemesterList')?>"><span> Semester List</span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Reports/dynamicreport'){ echo 'class="active"';} ?>>
							<a  href="<?=base_url('admin/Reports/dynamicreport')?>"><span> Semester Course</span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Reports/gradereport'){ echo 'class="active"';} ?>>
							<a  href="<?=base_url('admin/Reports/gradereport')?>"><span> Specific Grade</span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Reports/gradsheetreport'){ echo 'class="active"';} ?>>
							<a  href="<?=base_url('admin/Reports/gradsheetreport')?>"><span> Grade Sheet</span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Reports/student_demographic_report'){ echo 'class="active"';} ?>>
							<a  href="<?=base_url('admin/Reports/student_demographic_report')?>"><span>Student Demographic</span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Reports/special_program_report'){ echo 'class="active"';} ?>>
							<a  href="<?=base_url('admin/Reports/special_program_report')?>"><span>Special Program</span> </a>
						</li-->
						
					
					 <!-- <li <?php if(trim($subaction) == '#'){ echo 'class="active"';} ?>>
							<a href="">Specific grade reports</a>
						</li>
						
						<li>
							<a href="">Grade sheet</a>
						</li> 
						<li>
							<a href="">Student demographic report</a>
						</li> -->
						<?php }?>
						
						
						
					<!--/ul>
				</li-->
			
			<?php } ?>
						 						 
				<?php if(session()->get('role') == 1 || $show_hr){ ?>
				<li class="has_sub">
					<a href="#" class="waves-effect <?php if(trim($subaction) == 'admin/Reports/employmentListing'){ echo "subdrop"; }?>">
						<i class="ion-android-social-user"></i>
						<span>HR </span> <span class="pull-right"><i class="md <?php if(trim($subaction) == 'admin/Reports/employmentListing'){ echo "md-remove"; } else { echo "md-add"; } ?>"></i>
						</span>
					</a>
					
					
					<ul class="sub-menu" <?php if(trim($action) == 'admin/Reports'){ echo " "; } ?>>
					   <?php if(session()->get('role') == 1 ||  $show_class_reports){?>
						<li <?php if(trim($subaction) == 'admin/Reports/classListing'){ echo 'class="active"';} ?>>
							<a  href="<?=base_url('admin/Reports/employmentListing')?>"><span>Employment</span> </a>
						</li>
					   <?php }?>
					</ul>
					
				</li>
				
				<!--<li <?php if(trim($subaction) == 'admin/Form/ViewAppList'){ /* echo 'class="active"'; */} ?> <?php if(trim($subaction) == 'admin/Form/ViewAppList'){ /* echo 'class="active"'; */} ?>>
					<a href="<?=base_url('admin/Form/ViewAppList')?>"><i class="ion-android-contacts"></i> <span>HR </span></a>
				</li>-->
				<?php } ?>
				<?php if(session()->get('role') == 1 || $show_finance || in_array(2, session()->get('profiles'))){ ?>
				
				<li class="has_sub">
					<a href="#" class="waves-effect <?php if(trim($subaction) == 'admin/Reports/addVIPMailingList' || trim($subaction) == 'admin/Reports/addDonationsReport'|| trim($subaction) == 'admin/Reports/addDonorReport' || trim($subaction) == 'admin/Reports/addDonorMailingList' || trim($subaction) == 'admin/Reports/addCampaignReport' ||trim($subaction) == 'admin/Master/addCampaigns' ){ echo "subdrop"; }?>"  ><i class="ion-social-usd"></i><span>Finance </span><span class="pull-right"><i class="md <?php if( trim($subaction) == 'admin/Reports/addVIPMailingList' || trim($subaction) == 'admin/Reports/addDonationsReport' || trim($subaction) == 'admin/Reports/addDonorReport'|| trim($subaction) == 'admin/Reports/addDonorMailingList'|| trim($subaction) == 'admin/Reports/addCampaignReport' ){ echo "md-remove"; } else { echo "md-add"; } ?>"></i></span> </a>
					<ul class="list-unstyled" <?php if(trim($action) == 'admin/ViewAppList'){ echo " "; } ?>>
					    
					    <?php if(session()->get('role') == 1 || in_array(3, session()->get('profiles'))){?>
					    <li <?php if(trim($subaction) == 'admin/Master/addCampaigns'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Master/addCampaigns')?>"><span>Campaigns </span> </a>

						</li>
					    <?php }?>
					    <?php if(session()->get('role') == 1 || $show_vip_reports){?>
					<li <?php if(trim($subaction) == 'admin/Reports/exportContactDetails'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Reports/exportContactDetails')?>" class="exportContactDetails"><span>Contact Export</span> </a>
						</li>
						<?php }?>
						
						
						
						
						
						<?php if(session()->get('role') == 1 || $show_vip_reports){ ?>
						<li <?php if(trim($subaction) == 'admin/Reports/addDonorMailingList'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Reports/addDonorMailingList')?>"><span>Donor Mailing List</span> </a>
						</li>
						<?php }?>
						
						<?php if(session()->get('role') == 1 || $show_finance){?>
						<li <?php if(trim($subaction) == 'admin/Reports/addDonationsReport'){ echo 'class="active"';} ?>>
							<a href="#" data-toggle="modal" data-target="#myModal1"><span> Donations Report </span> </a>
						</li>
						<?php }?>
						
						<?php if(session()->get('role') == 1 || $show_finance){?>
						<li <?php if(trim($subaction) == 'admin/Reports/addDonationsReportExcel'){ echo 'class="active"';} ?>>
							<a href="#" data-toggle="modal" data-target="#myModalDonationsExcel1"><span> Donations Report Excel </span> </a>
						</li>
						<?php }?>
						
						<?php if(session()->get('role') == 1 || $show_vip_reports){ ?>
						<li <?php if(trim($subaction) == 'admin/Finance/payments'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Finance/payments')?>"><span>Payments</span> </a>
						</li>
						<?php }?>
						
						<?php if(session()->get('role') == 1 || in_array(2, session()->get('profiles'))){ ?>
						<li <?php if(trim($subaction) == 'admin/Finance/student_billing'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Finance/student_billing')?>"><span>Student Billing Summary</span> </a>
						</li>
						
						<?php }?>
						
						<?php if(session()->get('role') == 1 || $show_vip_reports){?>
						<li <?php if(trim($subaction) == 'admin/Reports/addVIPMailingList'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Reports/addVIPMailingList')?>" class="addvipmailinglistreport-asdsadd" id="vip_mail"><span>VIP Mailing List </span> </a>
						</li>
						<?php }?>
					   
						
							
						
						
						
						<?php if(session()->get('role') == 1){?>
					<!--	<li <?php if(trim($subaction) == 'admin/Reports/addDonorReport'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Reports/addDonorReport')?>"><span>Donor Report </span> </a>
						</li>-->
						<?php }?>
						<?php if(session()->get('role') == 1){?>
					<!--	<li <?php if(trim($subaction) == 'admin/Reports/addCampaignReport'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Reports/addCampaignReport')?>"><span>Campaign Report </span> </a>
						</li>-->
						<?php }?>
						
						
					
						
						<!-- By Prabhat -->
						
						<!-- End PRabhat -->
						<!-- By Prabhat -->
					
						<!-- End PRabhat -->
					</ul>
				</li>
				<?php } ?>
				<?php if(session()->get('role') == 1 || $show_registrar){ ?>
				<li class="has_sub">
					<a href="#" class="waves-effect <?php if(trim($subaction) == 'admin/Registrar/addCountry'  ||trim($subaction) == 'admin/Registrar/addState'  ||trim($subaction) == 'admin/Registrar/addCampaigns'  ||trim($subaction) == 'admin/Registrar/addClass'  ||trim($subaction) == 'admin/Registrar/addCourselist'  ||trim($subaction) == 'admin/Registrar/addGrades'  || trim($subaction) == 'admin/Registrar/addPaymentType'  ||trim($subaction) == 'admin/Registrar/addRegionProgram'){ echo "subdrop"; }?>">
						<i class="fa fa-graduation-cap"></i>
						<span> Registrar </span> <span class="pull-right"><i class="md <?php if(trim($action) == 'admin/Registrar' ){ echo "md-remove"; } else { echo "md-add"; } ?>"></i></span>
					</a>
					<ul class="list-unstyled" <?php if(trim($action) == 'admin/Registrar'){ echo " "; } ?>>
					     <li <?php if(trim($subaction) == 'admin/Master/addClass'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Master/addClass')?>"><span>Class </span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Registrar/addCourselist'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registrar/addCourselist')?>"><span>Courselist </span> </a>
						</li>
						<!--<li <?php if(trim($subaction) == 'admin/Registrar/addGrades'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registrar/addGrades')?>"><span>Grades </span> </a>
						</li>-->
						<li <?php if(trim($subaction) == 'admin/Master/addRegionProgram'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Master/addRegionProgram')?>"><span>Region  </span> </a>
						</li>
						
						<li <?php if(trim($subaction) == 'admin/Master/addDiploma'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Master/addDiploma')?>"><span>Diploma </span> </a>
						</li>
						
						<li <?php if(trim($subaction) == 'admin/Master/addCertificate'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Master/addCertificate')?>"><span>Certificates </span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Master/addProgram'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Master/addProgram')?>"><span>Concentration/Specialization</span> </a>
						</li>

						<li <?php if(trim($subaction) == 'admin/Master/addSpecialProgram'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Master/addSpecialProgram')?>"><span>Market </span> </a>
						</li>
						
						<li <?php if(trim($subaction) == 'admin/Master/addDocumentType'){ echo 'class="active"';} ?>>
                            <a href="<?=base_url('admin/Master/addDocumentType')?>"><span>Document Type </span> </a>
                        </li>

						<li <?php if(trim($subaction) == 'admin/Users/classGradeMaster'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Users/classGradeMaster')?>"><span>Class Grade Master </span> </a>
						</li>
						
						<li <?php if(trim($subaction) == 'admin/Form/type_scholaorship'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Form/type_scholaorship')?>"><span>Scholarship Type </span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Master/addTrack '){ echo 'class="active"';} ?>>
                            <a href="<?=base_url('admin/Master/addTrack')?>"><span>Track  </span> </a>
                        </li>
                        <li <?php if(trim($subaction) == 'admin/Form/grade_editor '){ echo 'class="active"';} ?>>
                            <a href="<?=base_url('admin/Form/grade_editor')?>"><span>Grade Editor</span> </a>
                        </li>
						<?php if(session()->get('role') == 1){?>
						<li <?php if(trim($subaction) == 'admin/Reports/StudentPassportListings'){ echo 'class="active"';} ?>>
							<a href="<?php echo base_url('admin/Reports/StudentPassportListings');?>" class="passportlist" id="studentpassportlist"><span>Student Passport List </span> </a>
						</li>
						
						<?php }?>
					</ul>
				</li>
				
			
				<li class="has_sub">
					<a href="#"  class="waves-effect <?php if(trim($subaction) == 'admin/GradeForm/professor_list' || trim($subaction) == 'admin/GradeForm/'){ echo "subdrop"; }?>" >
					<i class="ion-ios7-bookmarks"></i><span>Faculty </span>
					<span class="pull-right"><i class="md <?php if(trim($subaction) == 'admin/GradeForm/professor_list' || trim($subaction) == 'admin/GradeForm/' ){ echo "md-remove"; } else { echo "md-add"; } ?>"></i></span>  
				</a>
					<ul class="list-unstyled" <?php if(trim($action) == 'admin/GradeForm/'){ echo " active"; } ?>>
						<li <?php if(trim($subaction) == 'admin/GradeForm/'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/GradeForm/')?>"><span>Grade Form</span> </a>
						</li>
						<!--<li <?php if(trim($subaction) == 'admin/GradeForm/professor_list'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/GradeForm/professor_list')?>"><span>Professor Courses</span> </a>
						</li> -->
						
					</ul>
				</li>
				

				<?php } ?>
				
			<?php if(session()->get('role') == 1 || $show_class_timesheet){ ?>
				
				<li class="has_sub">
					<a href="#"  class="waves-effect <?php if(trim($subaction) == 'admin/Users/contract' || trim($subaction) == 'admin/Users/category' || trim($subaction) == 'admin/Timesheet/activeNewContractors' || trim($subaction) == 'admin/Reports/adminTimeReport' || trim($subaction) == 'admin/Reports/adminLockedReport' || trim($subaction) == 'admin/Users/Team' || trim($subaction) == 'admin/Timesheet/admin_attendance' || trim($subaction) == 'admin/Testing/attendance'  ){ echo "subdrop"; }?>" >
					<i class="ion-ios7-time-outline"></i><span>Timesheet </span>
					<span class="pull-right"><i class="md <?php if(trim($subaction) == 'admin/Users/contract' || trim($subaction) == 'admin/Users/category' || trim($subaction) == 'admin/Timesheet/activeNewContractors' || trim($subaction) == 'admin/Reports/adminTimeReport' || trim($subaction) == 'admin/Reports/adminLockedReport' || trim($subaction) == 'admin/Users/Team' || trim($subaction) == 'admin/Timesheet/admin_attendance' || trim($subaction) == 'admin/Testing/attendance'){ echo "md-remove"; } else { echo "md-add"; } ?>"></i></span>  
				</a>
				<ul class="list-unstyled" <?php if(trim($action) == 'admin/Users'){ echo " "; } ?>>
				    <?php if(session()->get('role') == 1 ){
				        $all_admin_timesheet_menu = array_filter(session()->get('all_menu'), function($el) {
                        		   return $el['parent_id'] == '35';
                		});
                		
                		
                		foreach($all_admin_timesheet_menu as $menu){
				         ?>
				         <li <?php if(trim($subaction) == $menu['menu_link']){ echo 'class="active"';} ?>>
							<a href="<?=base_url($menu['menu_link'])?>"><span><?= $menu['child_name'] ?></span> </a>
						</li>
						<?php
				        }
                		
				        ?>
				        
						
						
						<!-- End Prabhat -->
						<!--End of apoorv 6/7/2020-->
						<!--<li <?php if(trim($subaction) == 'admin/Testing/attendance'){ echo 'class="active"';} ?>>
						<a href="<?=base_url('admin/Testing/attendance')?>"><span>Time Entry II</span> </a>
						</li>-->
				        
				        
				        <?php
				    }
				    else if($show_class_timesheet){
				       
				        foreach(session()->get('timesheet_menu') as $menu){
				         ?>
				         <li <?php if(trim($subaction) == $menu['menu_link']){ echo 'class="active"';} ?>>
							<a href="<?=base_url($menu['menu_link'])?>"><span><?= $menu['child_name'] ?></span> </a>
						</li>
						<?php
				        }
				    }
				    if(session()->get('admin_email') == 'ithelpdesk@future.edu'){
				        ?>
				         <li>
							<a href="<?=base_url('admin/timesheet/admin_indivisual_report')?>"><span>Admin Indivisual Report</span> </a>
						</li>
						<?php
				    }
				    ?>	
					</ul>
				</li>
				
				<?php }
			    
				?>	
				
				                     
				
				
				<!-- <?php if(session()->get('facultystaff') && session()->get('facultystaff') == 1){ ?>
				
				<li <?php if(trim($subaction) == 'admin/Timesheet/attendance'){ echo 'class="active"';} ?>>
					<a <?php if(trim($subaction) == 'admin/Timesheet/attendance'){ echo 'class="active"';} ?> href="<?=base_url('admin/Timesheet/attendance')?>"><i class="fa fa-edit"></i><span>Time Entry</span></a>
				</li>
                                
				<?php } ?>
				                  -->
				                 
            <?php if(session()->get('role') == 1 || (session()->get('facultystaff') && session()->get('facultystaff') == 1)){ ?>

				<li class="has_sub">
					<a href="#" class="waves-effect <?php if(trim($subaction) == 'admin/Timesheet/attendance' || trim($subaction) == 'admin/Reports/monthlyReport' || trim($subaction) == 'admin/Reports/indivisualReport' || trim($subaction) == 'admin/Reports/TeamReport'  ){ echo "subdrop"; }?>"><i class="fa fa-edit"></i><span>TimeEntry</span>
						<span class="pull-right"><i class="md <?php if(trim($subaction) == 'admin/Timesheet/attendance' || trim($subaction) == 'admin/Reports/monthlyReport' || trim($subaction) == 'admin/Reports/indivisualReport' || trim($subaction) == 'admin/Reports/TeamReport'   ){ echo "md-remove"; } else { echo "md-add"; } ?>"></i>
						</span>
					</a>
						<ul class="list-unstyled" <?php if(trim($action) == 'admin/Users'){ echo " "; } ?>>
						<!--li <?php if(trim($subaction) == 'admin/Testing/attendance2'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Testing/attendance2')?>"><span>Time Entry</span> </a>
						</li-->
						
						<li <?php if(trim($subaction) == 'admin/Timesheet/attendance'){ echo 'class="active"';} ?>>
							<a <?php if(trim($subaction) == 'admin/Timesheet/attendance'){ echo 'class="active"';} ?> href="<?=base_url('admin/Timesheet/attendance')?>"><span>Time Entry</span></a>
						</li> 
                                                <li <?php if(trim($subaction) == 'admin/Testing/attendance'){ echo 'class="active"';} ?>>
						<a href="<?=base_url('admin/Testing/attendance')?>"><span>Time Entry II</span> </a>
						</li>
						
						<li <?php if(trim($subaction) == 'admin/Reports/monthlyReport'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Reports/monthlyReport')?>"><span>Monthly Report</span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Reports/monthlyJournalReport'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Reports/monthlyJournalReport')?>"><span>Monthly Journal Report</span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Reports/indivisualReport'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Reports/indivisualReport')?>"><span>Individual Fiscal Yr Report</span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Reports/TeamReport'){ echo 'class="active"';} ?>>
						<a href="<?=base_url('admin/Reports/TeamReport')?>"><span>Team Report</span> </a>
						</li>
						<li <?php if(trim($subaction) == 'admin/Reports/teamMonthlyJournlReport'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Reports/teamMonthlyJournlReport')?>"><span>Team Monthly Journal Report</span> </a>
						</li>	

						
					</ul>
				</li>
				<?php } ?>
				
				 <?php if(session()->get('role') == 1 || (session()->get('facultystaff') && session()->get('facultystaff') == 1)){ ?>
				<li class="has_sub"> 
				<!--<li class="has_sub <?=$subaction ?>" style="width: max-content !important;" >-->
					<a href="#" class="waves-effect <?php if(trim($subaction) == 'admin/Master/addClassListing' || trim($subaction) == 'admin/Master/addVIPMailingList' || trim($subaction) == 'admin/Master/addStudentPassportList​'  || trim($subaction) == 'admin/Master/addGeneralMailingList'  || trim($subaction) == 'admin/Master/addDonorReport'|| trim($subaction) == 'admin/Master/addDonorMailingList'  || trim($subaction) == 'admin/Master/addDonationsReport'){ echo "subdrop"; }?>">
						<i class="fa fa-book"></i>
						<span> Online Forms </span> <span class="pull-right"><i class="md <?php if(trim($action) == 'admin/Master'){ echo "md-remove"; } else { echo "md-add"; } ?>"></i></span>
					</a>
					
					
					<ul class="sub-menu" <?php if(trim($action) == 'admin/Reports'){ echo " "; } ?>>
					  	<li <?php if(trim($subaction) == 'formbuilder/Application/reportfilterpendingScheme'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('formbuilder/Application/reportfilterpendingScheme')?>">Forms Reports</a>
						</li> 
						<li <?php if(trim($subaction) == 'formbuilder/Application/reportpendingScheme'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('formbuilder/Application/reportpendingScheme')?>">Forms Received</a>
					    </li>
					    
					    <?php
					      if(session()->get('admin_email') == 'ithelpdesk@future.edu')
					      {
					          ?>
					          <li <?php if(trim($subaction) == 'formbuilder/Application/pendingScheme'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('formbuilder/Application/pendingScheme')?>">Delete Applications</a>
						</li> 
						<?php
					      }
					     ?>

					</ul>
				</li> <?php } ?>
				<!-- form builder  -->
				<?php if(session()->get('role') == 1){ ?>
				
				<li class="has_sub <?=$subaction ?>" style="width: max-content !important;" >
					<a href="#" class="waves-effect <?php if(trim($subaction) == 'admin/Master/addClassListing' || trim($subaction) == 'admin/Master/addVIPMailingList' || trim($subaction) == 'admin/Master/addStudentPassportList​'  || trim($subaction) == 'admin/Master/addGeneralMailingList'  || trim($subaction) == 'admin/Master/addDonorReport'|| trim($subaction) == 'admin/Master/addDonorMailingList'  || trim($subaction) == 'admin/Master/addDonationsReport'){ echo "subdrop"; }?>">
						<i class="fa fa-book"></i>
						<span> Online Applications </span> <span class="pull-right"><i class="md <?php if(trim($action) == 'admin/Master'){ echo "md-remove"; } else { echo "md-add"; } ?>"></i></span>
					</a>
					
					
					<ul class="sub-menu" <?php if(trim($action) == 'admin/Reports'){ echo " "; } ?>>
					  <li <?php if(trim($subaction) == 'formbuilder/Application/reportfilterpendingScheme'){ echo 'class="active"';} ?>>
	                        <a href="<?=base_url('formbuilder/Application/reportfilterpendingScheme')?>">Report</a>
                     </li> 
  
					 <li <?php if(trim($subaction) == 'formbuilder/Application/reportpendingScheme'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('formbuilder/Application/reportpendingScheme')?>">Forms Report</a>
					</li>  
					  <li <?php if(trim($subaction) == 'formbuilder/Application/pendingScheme'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('formbuilder/Application/pendingScheme')?>">View Applications</a>
						</li> 
					  <li <?php if(trim($subaction) == 'formbuilder/Application/approvedScheme'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('formbuilder/Application/viewTrasaction')?>">View Transaction</a>
						</li> 
						    
					</ul>
				</li>
				
				<li <?php if(trim($subaction) == 'admin/Myindox/'){ echo 'class="active"';} ?>>
					<a <?php if(trim($subaction) == 'admin/Myindox/'){ echo 'class="active"';} ?> href="<?=base_url('admin/Myindox/')?>"><i class="fa fa-envelope"><sup id='msg_inbox_count'></sup></i><span> My Inbox</span></a>
				</li>
				<?php } 
				if($show_registrar)
				{
				    ?>
				    <li <?php if(trim($subaction) == 'admin/Myindox/'){ echo 'class="active"';} ?>>
					   <a <?php if(trim($subaction) == 'admin/Myindox/'){ echo 'class="active"';} ?> href="<?=base_url('admin/Myindox/')?>"><i class="fa fa-envelope"><sup id='msg_inbox_count'></sup></i><span> My Inbox</span></a>
				    </li>
				    <?php
				}
				?>
				
				<!-- By Prabhat -->
				    
				    <?php if(( session()->get('role') == 1)|| $show_finance || $_SESSION['admin_email'] == 'kelli.fleming@future.edu' || $_SESSION['admin_email'] == 'paula.smith@future.edu' || $_SESSION['admin_email'] == 'Lindsay.Kazarick@future.edu' || $_SESSION['admin_email'] == 'lindsay.Kazarick@future.edu' || $_SESSION['admin_email'] == 'kris.reiser@future.edu' || $_SESSION['admin_email'] == 'krisreiser@gmail.com' || $_SESSION['admin_email'] == 'Kris.Reiser@future.edu'){ ?>

				<li class="has_sub">
					<a href="#" class="waves-effect <?php if(trim($subaction) == 'admin/Registration/city' || trim($subaction) == 'admin/Registration/city' || trim($subaction) == 'admin/Reports/indivisualReport' || trim($subaction) == 'admin/Reports/TeamReport'  ){ echo "subdrop"; }?>"><i class="fa fa-plus"></i><span>Student Application</span>
						<span class="pull-right"><i class="md <?php if(trim($subaction) == 'admin/Registration/city' || trim($subaction) == 'admin/Reports/monthlyReport' || trim($subaction) == 'admin/Reports/indivisualReport' || trim($subaction) == 'admin/Reports/TeamReport'   ){ echo "md-remove"; } else { echo "md-add"; } ?>"></i>
						</span>
					</a>
						<ul class="list-unstyled" <?php if(trim($action) == 'admin/Registration/city'){ echo " "; } ?>>
						    
						<li <?php if(trim($subaction) == 'admin/Registration/FormDetail'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registration/FormDetail')?>"><span>Application</span> </a>
						</li>
						
						<li <?php if(trim($subaction) == 'admin/Registration/get_track_form'){ echo 'class="active"';} ?>>
                            <a href="<?=base_url('admin/Registration/get_track_form')?>"><span>Alternative Track Applications</span> </a>
                        </li>
                        
                        
                        <li <?php if(trim($subaction) == 'admin/Registration/add_drop_course'){ echo 'class="active"';} ?>>
                            <a href="<?=base_url('admin/Registration/add_drop_course')?>"><span>Course Add/Drop</span> </a>
                        </li>
						
						<li <?php if(trim($subaction) == 'admin/Registration/finance_balance'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registration/finance_balance')?>"><span>Finance Balance</span> </a>
						</li>
						
						<li <?php if(trim($subaction) == 'admin/Registration/email_templete'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registration/email_templete')?>"><span>Email Template</span> </a>  
						</li>

						<li <?php if(trim($subaction) == 'admin/Registration/staticpage_student'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registration/staticpage_student')?>"><span>Static Page</span> </a>
						</li>

						<li <?php if(trim($subaction) == 'admin/Registration/get_master_list'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registration/get_master_list')?>"><span>Master List</span> </a>
						</li>
						
						<li <?php if(trim($subaction) == 'admin/Registration/city'){ echo 'class="active"';} ?>>
							<a <?php if(trim($subaction) == 'admin/Registration/city'){ echo 'class="active"';} ?> href="<?=base_url('admin/Registration/city')?>"><span>Add City</span></a>
						</li>
                        <li <?php if(trim($subaction) == 'admin/Registration/enthnicity'){ echo 'class="active"';} ?>>
						  <a href="<?=base_url('admin/Registration/enthnicity')?>"><span>Add Ethnicity </span> </a>
						</li>


						<li <?php if(trim($subaction) == 'admin/Registration/school'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registration/school')?>"><span>School</span> </a>
						</li>

						<li <?php if(trim($subaction) == 'admin/Registration/degree'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registration/degree')?>"><span>Degree</span> </a>
						</li>

						<li <?php if(trim($subaction) == 'admin/Registration/gender'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registration/gender')?>"><span>Gender</span> </a>
						</li>

						<li <?php if(trim($subaction) == 'admin/Registration/phone_type'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registration/phone_type')?>"><span>Type of Phone</span> </a>
						</li>

						<li <?php if(trim($subaction) == 'admin/Registration/enrollment_periods'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registration/enrollment_periods')?>"><span>Enrollment Period</span> </a>
						</li>

						<li <?php if(trim($subaction) == 'admin/Registration/travel_frequency'){ echo 'class="active"';} ?>>
							<a href="<?=base_url('admin/Registration/travel_frequency')?>"><span>Travel Frequency</span> </a>
						</li>
						
						
						
					
						
					</ul>
				</li>
				<?php } ?>
				    
				    <!-- End Prabhat -->
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<?php 
		$new_array=array('id'=>'donation_report','target'=>'_blank');
		echo form_open_multipart("admin/PdfBuilder/getDonationReport",$new_array);
?>

<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Donation Reports</h4>
      </div>
      <div class="modal-body">
       <div class="form-group">
	   
	   <table width="100%">
	     <tr>
			<td style="text-align:left;" width="48%"><label>Begin Date</label></td>
			<td width="4%">&nbsp;</td>
			<td style="text-align:left;" width="48%"><label>End Date</label></td>
		 </tr>
	     <tr><td width="48%"><input type="text" name="begin_date" id="begin_date" class="form-control datepickerbackward" placeholder="Begin Date"></td>
		 <td width="4%">&nbsp;</td>
		 <td width="48%"><input type="text" name="end_date" id="end_date" class="form-control datepickerbackward" placeholder="End Date"></td></tr>
	   </table>
	  	
	   </div>
	  
      </div>
      <div class="modal-footer">
	   <input type="submit" class="btn btn-success" name="submit" value="Report">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php echo form_close();?>

<!--  student passport modal  -->

<!-- Donatio Report Excel -->
<?php 
		$new_array=array('id'=>'donation_report_excel');
		echo form_open_multipart("admin/Reports/getDonationReportExcel",$new_array);
?>

<!-- Modal -->
<div id="myModalDonationsExcel1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Donation Reports Excel</h4>
      </div>
      <div class="modal-body">
       <div class="form-group">
	   
	   <table width="100%">
	     <tr>
			<td style="text-align:left;" width="48%"><label>Begin Date</label></td>
			<td width="4%">&nbsp;</td>
			<td style="text-align:left;" width="48%"><label>End Date</label></td>
		 </tr>
	     <tr><td width="48%"><input type="text" name="excel_begin_date" id="excel_begin_date" class="form-control datepickerbackward" placeholder="Begin Date"></td>
		 <td width="4%">&nbsp;</td>
		 <td width="48%"><input type="text" name="excel_end_date" id="excel_end_date" class="form-control datepickerbackward" placeholder="End Date"></td></tr>
	   </table>
	  	
	   </div>
	  
      </div>
      <div class="modal-footer">
	   <input type="submit" class="btn btn-success" name="submit" value="Report">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php echo form_close();?>

<script>
$(document).on("submit","#donation_report",function(){
	var begin_date = $("#begin_date").val();
    var end_date   = $("#end_date").val();
	//alert(end_date);
	if(begin_date=="" && end_date==""){
		alert('Enter atleast one date, begin date or end date');
		return false;
	}
});

$(document).on("change","#begin_date",function(){
		var begin_date = $("#begin_date").val().split('/')[2];
		var begin_date_length = begin_date.length;
	if(begin_date_length!=4){
		alert('Year should be 4 digit');
		$("#begin_date").val('');
		return false;
}
});

$(document).on("change","#end_date",function(){
		var end_date = $("#end_date").val().split('/')[2];
		var end_date_length = end_date.length;
	if(end_date_length!=4){
		alert('Year should be 4 digit');
		$("#end_date").val('');
		return false;
}
});
</script>
<script type="text/javascript">
   $(document).on("click", "a.addvipmailinglistreport", function () {
    $.fileDownload($(this).prop('href'))
        .done(function () { alert('File download a success!'); })
        .fail(function () { alert('File download failed!'); });
 
    return false; //this is critical to stop the click event which will trigger a normal file download
});
</script>