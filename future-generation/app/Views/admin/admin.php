
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>">

        <title>Future Generations</title>
        <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/web/images/sgalmala.png') ?>"/>
        <!-- Base Css Files -->
        <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/ionicon/css/ionicons.min.css') ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/css/material-design-iconic-font.min.css') ?>" rel="stylesheet">

        <!-- animate css -->
        <link href="<?= base_url('assets/css/animate.css') ?>" rel="stylesheet" />
		
		 <!--bootstrap-wysihtml5-->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css') ?>" />
        <link href="<?= base_url('assets/summernote/summernote.css') ?>" rel="stylesheet" />
		
		<!--Form Wizard-->
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/jquery.steps.css') ?>" />

        <!-- Waves-effect -->
        <link href="<?= base_url('assets/css/waves-effect.css') ?>" rel="stylesheet">
		
		<!-- Plugins css-->
		<link href="<?= base_url('assets/timepicker/bootstrap-timepicker.min.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('assets/timepicker/bootstrap-datepicker.min.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('assets/modal-effect/css/component.css') ?>" rel="stylesheet">

        <!-- Custom Files -->
        <link href="<?= base_url('assets/css/helper.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/css/style_main.css') ?>" rel="stylesheet" type="text/css" /> <!-- dashboard style css -->
		
		<!-- DATA TABLES Files -->
		<link href="<?= base_url('assets/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/modernizr.min.js') ?>"></script>    
        <script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
    </head>
	<div id="myModal" style="padding-top:200px;" class="modalpopupsss fade" role="dialog">
 <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"></button>
       
      </div>
      <div class="modal-body">
        <p style="font-size:22px;text-align:center;">Report is downloaded</p>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
<style>
.modalpopupsss{display:none;}
</style>
    <body class="fixed-left-void">
        <div id="loader-block" style="position: absolute;z-index: 999;background-color: #000;width: 100%;height: 100%;opacity: 0.5;">
			 <img  style="vertical-align: middle;margin: 0 auto;left: 50%;top: 40%;position: absolute;" src="<?= base_url('assets/images/loader-gif-color.gif') ?>" alt="Loading" />
			 Loading...
		</div>
        <!-- Begin page -->
        <div id="wrapper" class="forced enlarged">
        
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->			
                <div class="topbar-left">				
                    <div class="text-center">
						
						<a href="<?= base_url('admin/Form/ViewAppList') ?>" class="logo">
							<div><img src="<?= base_url('assets/web/images/favicon.png') ?>" width="30" ></div>
							<span style="width:70%;text-align:left;margin-top:5px;margin-left:0;"><img src="<?= base_url('assets/web/images/futureinner.png') ?>" ></span>
							<!-- <span>Future<br>Generations </span> -->
							<div style="clear:both;"></div>
						</a>
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

							
                             <ul class="nav navbar-nav navbar-right pull-right">
								<!-- <li>
									<div class="nav navbar-nav navbar-right pull-right" style="margin-top:16px;">
									
										<span style="color:#FFF;">
											<strong>Welcome : IT Helpdesk</strong> 
										</span>
																														<div></div>
									</div>
								</li> -->
								
								
								<li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="md md-notifications"></i> <span class="badge badge-xs badge-danger">3</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="text-center notifi-title">Notification</li>
                                        <li class="list-group">
                                           <!-- list item-->
                                           <a href="<?= base_url('formbuilder/Application/notifications/') ?>" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left">
                                                    <em class="fa fa-file-text  fa-2x text-info"></em>
                                                 </div>
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Assign Forms</div>
                                                    <p class="m-0">
                                                       <small id="mainNav-assignForms-notification"></small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>
                                           <!-- list item-->
                                            <a href="<?= base_url('formbuilder/Application/formbuilder_notify/') ?>"class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left">
                                                    <em class="fa fa-file-text-o fa-2x text-primary"></em>
                                                 </div>
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Formbuilder</div>
                                                    <p class="m-0">
                                                       <small id="mainNav-formbuilder-notification"></small>
                                                    </p>
                                                 </div>
                                              </div>
                                            </a>
                                            <!-- list item-->
                                            <a href="<?= base_url('admin/Myinbox/') ?>" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left">
                                                    <em class="fa fa-envelope fa-2x text-danger"></em>
                                                 </div>
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Inbox</div>
                                                    <p class="m-0">
                                                       <small id="mainNav-inbox-notification">
                                                          </small>
                                                    </p>
                                                 </div>
                                              </div>
                                            </a>
                                           <!-- last list item -->
                                            <a href="javascript:void(0);" class="list-group-item">
                                              <small>See all notifications</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
								<li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
                                </li>
								
                                <li class="dropdown">
                                 	<!--   <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="<?= base_url('admin/Form/submitstudentinfo') ?>/images/user.png" alt="user-img" class="img-circle"> </a> -->
																<a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="<?= base_url('docs/profile/profile_image1_20-06-19-12-26-09_ithelpdesk.png') ?>" alt="user-img" class="img-circle"> </a> 
                                    <ul class="dropdown-menu">                                       
                                       <!-- <li><a href="https://staging.apps.future.edu/admin/Users/changepassword"><i class="md md-settings-power"></i> Change Password</a></li> -->
										<li><a href="<?= base_url('admin/Users/addUsers/QWVMc0F2Zk1DQVNmdFNwMUc0NmZIZz09') ?>"><i class="md md-folder-shared"></i> Update Profile</a></li>
										<li><a href="<?= base_url('admin/Users/profile_changepassword/') ?>"><i class="md md md-create"></i> Change Password</a></li>
										<li><a href="<?= base_url('admin/Home/logout') ?>"><i class="md md-settings-power"></i> Logout</a></li>
                                    </ul>
                                </li>
								
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
			
            <!-- Top Bar End --><style>
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
  background-color: #f8f9fa; /* $light-gray */
  margin-right: -4px;
}

.menu--main li:hover {
  background-color: #dee2e6; /* darkened version of #f8f9fa */
}

.menu--main li:hover .sub-menu {
  max-height: 300px;
  visibility: visible;
  bottom: 100%;
  transition: all 0.4s linear;
}

.menu--main .sub-menu {
  display: block;
  visibility: hidden;
  position: absolute;
  left: 0;
  box-shadow: none;
  max-height: 0;
  width: 150px;
  overflow: hidden;
}

.menu--main .sub-menu li {
  display: block;
}
</style>

<div class="left side-menu">
	<div class="sidebar-inner slimscrollleft">
    <div class="user-details">
        <div class="pull-left">
                        <img src="<?= base_url('docs/profile/profile_image1_20-06-19-12-26-09_ithelpdesk.png') ?>" alt="alt" class="thumb-md img-circle">
        </div>
        <div class="user-info">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">IT Helpdesk </a>
                
            </div>           
        </div>
    </div>

		<!--- Divider  admin/Users/viewDashboard  -->
		<div id="sidebar-menu">
			<ul>
								<li >
					<a  href="<?= base_url('admin/Dashboard/viewDashboard') ?>"><i class="fa fa-home"></i><span> Dashboard</span></a>
				</li>
								                    <li class="active">
                        <a class="active" href="<?= base_url('admin/Form/ViewAppList') ?>"><i class="ion-ios7-telephone"></i><span> Contact </span></a>
                    </li>
				
								                    <li >
                        <a  href="<?= base_url('admin/Form/relationships') ?>"><i class="ion-ios7-home"></i><span>Relationship</span></a>
                    </li>
								
				<!--li >
					<a  href="https://staging.apps.future.edu/admin/Form/OrganizationList"><i class="ion-ios7-home"></i><span> Organization </span></a>
				</li-->
				
				
								<li class="has_sub">
					<a href="#" class="waves-effect ">
						<i class="ion-android-social-user"></i>
						<span>User Management </span> <span class="pull-right"><i class="md md-add"></i>
						</span>
					</a>
					<ul class="list-unstyled" >
						<li >
							<a href="<?= base_url('admin/Users/viewUsers') ?>"><span> Manage Users</span> </a>
						</li>
						<li >
							<a href="<?= base_url('admin/Users/profile_management') ?>"><span>Manage Profile</span> </a>
						</li>
						<li >
    					    <a  href="<?= base_url('admin/Assign_form/') ?>">
    					        <span>Manage Forms</span></a>
    				    </li>
						
					</ul>
				</li>
		
				
								
								<li class="has_sub">
					<a href="#" class="waves-effect ">
						<i class="ion-briefcase"></i>
						<span> Administration </span> <span class="pull-right"><i class="md md-add"></i></span>
					</a>
					<ul class="list-unstyled" >
                    						<li >
							<a href="<?= base_url('admin/Master/addCountry') ?>"><span>Country </span> </a>
						</li>
						<li >
							<a href="<?= base_url('admin/Master/addState') ?>"><span>State </span> </a>
						</li>
												 						<li >
							<a href="<?= base_url('admin/Master/addCampaigns') ?>"><span>Campaigns </span> </a>
						</li>
						<li >
							<a href="<?= base_url('admin/Master/addPaymentType') ?>"><span>Payment Type </span> </a>
						</li>
						<li >
							<a href="<?= base_url('admin/Master/uploadSignature') ?>"><span>Upload Signature </span> </a>
						</li>
											</ul>
				</li>
								
				<!-- by prabhat 28-07-2021 -->
				
								<li class="has_sub admin/Form/ViewAppList">
					<a href="#" class="waves-effect ">
						<i class="fa fa-book"></i>
						<span> Reports </span> <span class="pull-right"><i class="md md-add"></i></span>
					</a>
					<ul class="sub-menu" >
					   					       				        					            <li >
				                	<a  href="<?= base_url('admin/Reports/classListing') ?>"><span>Class Listing</span> </a>
					            </li>
					        					            <li >
				                	<a  href="<?= base_url('admin/Reports/classListingcertificates') ?>"><span>Class Listing Certificates</span> </a>
					            </li>
					        					            <li >
				                	<a  href="<?= base_url('admin/Reports/addGeneralMailingList') ?>"><span>General Mailing List</span> </a>
					            </li>
					        					            <li >
				                	<a  href="<?= base_url('admin/Reports/SemesterList') ?>"><span>Semester List</span> </a>
					            </li>
					        					            <li >
				                	<a  href="<?= base_url('admin/Reports/dynamicreport') ?>"><span>Semester Course</span> </a>
					            </li>
					        					            <li >
				                	<a  href="<?= base_url('admin/Reports/gradereport') ?>"><span>Specific Grade</span> </a>
					            </li>
					        					            <li >
				                	<a  href="<?= base_url('admin/Reports/gradsheetreport') ?>"><span>Grade Sheet</span> </a>
					            </li>
					        					            <li >
				                	<a  href="<?= base_url('Reports/student_demographic_report') ?>"><span>Student Demographic</span> </a>
					            </li>
					        					            <li >
				                	<a  href="<?= base_url('admin/Reports/special_program_report') ?>"><span>Market</span> </a>
					            </li>
					        					            <li >
				                	<a  href="<?= base_url('admin/Reports/completionsreport') ?>"><span>Completions Reports</span> </a>
					            </li>
					        					            <li >
				                	<a  href="<?= base_url('admin/Reports/fallenrollmentreport') ?>"><span>Fall Enrolment Report</span> </a>
					            </li>
					        					            <li >
				                	<a  href="<?= base_url('admin/Reports/enrollmentreport') ?>
"><span>12-Month enrolment report</span> </a>
					            </li>
					        					            <li >
				                	<a  href="<?= base_url('admin/Reports/course_report') ?>"><span>Course Report</span> </a>
					            </li>
					        					   					   
					  
					  
						
						
					   
					</ul>
				</li>
			
						
				
				
				<!-- End Prabhat 28-07-2021 -->
				
				
								<!--li class="has_sub admin/Form/ViewAppList">
					<a href="#" class="waves-effect ">
						<i class="ion-clipboard"></i>
						<span> Reports </span> <span class="pull-right"><i class="md md-add"></i></span>
					</a>


					<ul class="sub-menu" >
					  
					  
					   						<li >
							<a  href="https://staging.apps.future.edu/admin/Reports/classListing"><span>Class Listing </span> </a>
						</li>
					   					   						<li >
							<a  href="https://staging.apps.future.edu/admin/Reports/classListingcertificates"><span>Class Listing Certificates </span> </a>
						</li>
						
						
					   						
						
						
												<li >
							<a href="https://staging.apps.future.edu/admin/Reports/addGeneralMailingList"><span>General Mailing List </span> </a>
						</li>
						
																		<li >
							<a  href="https://staging.apps.future.edu/admin/Reports/SemesterList"><span> Semester List</span> </a>
						</li>
						<li >
							<a  href="https://staging.apps.future.edu/admin/Reports/dynamicreport"><span> Semester Course</span> </a>
						</li>
						<li >
							<a  href="https://staging.apps.future.edu/admin/Reports/gradereport"><span> Specific Grade</span> </a>
						</li>
						<li >
							<a  href="https://staging.apps.future.edu/admin/Reports/gradsheetreport"><span> Grade Sheet</span> </a>
						</li>
						<li >
							<a  href="https://staging.apps.future.edu/admin/Reports/student_demographic_report"><span>Student Demographic</span> </a>
						</li>
						<li >
							<a  href="https://staging.apps.future.edu/admin/Reports/special_program_report"><span>Special Program</span> </a>
						</li-->
						
					
					 <!-- <li >
							<a href="">Specific grade reports</a>
						</li>
						
						<li>
							<a href="">Grade sheet</a>
						</li> 
						<li>
							<a href="">Student demographic report</a>
						</li> -->
												
						
						
					<!--/ul>
				</li-->
			
									 						 
								<li class="has_sub">
					<a href="#" class="waves-effect ">
						<i class="ion-android-social-user"></i>
						<span>HR </span> <span class="pull-right"><i class="md md-add"></i>
						</span>
					</a>
					
					
					<ul class="sub-menu" >
					   						<li >
							<a  href="<?= base_url('admin/Reports/employmentListing') ?>"><span>Employment</span> </a>
						</li>
					   					</ul>
					
				</li>
				
				<!--<li  >
					<a href="https://staging.apps.future.edu/admin/Form/ViewAppList"><i class="ion-android-contacts"></i> <span>HR </span></a>
				</li>-->
												
				<li class="has_sub">
					<a href="#" class="waves-effect "  ><i class="ion-social-usd"></i><span>Finance </span><span class="pull-right"><i class="md md-add"></i></span> </a>
					<ul class="list-unstyled" >
					    
					    					    <li >
							<a href="<?= base_url('admin/Master/addCampaigns') ?>"><span>Campaigns </span> </a>

						</li>
					    					    					<li >
							<a href="<?= base_url('admin/Reports/exportContactDetails') ?>" class="exportContactDetails"><span>Contact Export</span> </a>
						</li>
												
						
						
						
						
												<li >
							<a href="<?= base_url('admin/Reports/addDonorMailingList') ?>"><span>Donor Mailing List</span> </a>
						</li>
												
												<li >
							<a href="#" data-toggle="modal" data-target="#myModal1"><span> Donations Report </span> </a>
						</li>
												
												<li >
							<a href="#" data-toggle="modal" data-target="#myModalDonationsExcel1"><span> Donations Report Excel </span> </a>
						</li>
												
												<li >
							<a href="<?= base_url('admin/Finance/payments') ?>"><span>Payments</span> </a>
						</li>
												
												<li >
							<a href="<?= base_url('admin/Finance/student_billing') ?>"><span>Student Billing Summary</span> </a>
						</li>
						
												
												<li >
							<a href="<?= base_url('admin/Reports/addVIPMailingList') ?>" class="addvipmailinglistreport-asdsadd" id="vip_mail"><span>VIP Mailing List </span> </a>
						</li>
											   
						
							
						
						
						
											<!--	<li >
							<a href="https://staging.apps.future.edu/admin/Reports/addDonorReport"><span>Donor Report </span> </a>
						</li>-->
																	<!--	<li >
							<a href="https://staging.apps.future.edu/admin/Reports/addCampaignReport"><span>Campaign Report </span> </a>
						</li>-->
												
						
					
						
						<!-- By Prabhat -->
						
						<!-- End PRabhat -->
						<!-- By Prabhat -->
					
						<!-- End PRabhat -->
					</ul>
				</li>
												<li class="has_sub">
					<a href="#" class="waves-effect ">
						<i class="fa fa-graduation-cap"></i>
						<span> Registrar </span> <span class="pull-right"><i class="md md-add"></i></span>
					</a>
					<ul class="list-unstyled" >
					     <li >
							<a href="<?= base_url('admin/Master/addClass') ?>"><span>Class </span> </a>
						</li>
						<li >
							<a href="<?= base_url('admin/Registrar/addCourselist') ?>"><span>Courselist </span> </a>
						</li>
						<!--<li >
							<a href="https://staging.apps.future.edu/admin/Registrar/addGrades"><span>Grades </span> </a>
						</li>-->
						<li >
							<a href="<?= base_url('admin/Master/addRegionProgram') ?>"><span>Region  </span> </a>
						</li>
						
						<li >
							<a href="<?= base_url('admin/Master/addDiploma') ?>"><span>Diploma </span> </a>
						</li>
						
						<li >
							<a href="<?= base_url('admin/Master/addCertificate') ?>"><span>Certificates </span> </a>
						</li>
						<li >
							<a href="<?= base_url('admin/Master/addProgram') ?>"><span>Concentration/Specialization</span> </a>
						</li>

						<li >
							<a href="<?= base_url('admin/Master/addSpecialProgram') ?>"><span>Market </span> </a>
						</li>
						
						<li >
                            <a href="<?= base_url('admin/Master/addDocumentType') ?>"><span>Document Type </span> </a>
                        </li>

						<li >
							<a href="<?= base_url('admin/Users/classGradeMaster') ?>"><span>Class Grade Master </span> </a>
						</li>
						
						<li >
							<a href="<?= base_url('admin/Form/type_scholaorship') ?>"><span>Scholarship Type </span> </a>
						</li>
						<li >
                            <a href="<?= base_url('admin/Master/addTrack') ?>"><span>Track  </span> </a>
                        </li>
                        
                        
                        <li >
                            <a href="<?= base_url('admin/Form/student_transcripts') ?>"><span>Grade Editor</span> </a>
                        </li>
                        
                        
												<li >
							<a href="<?= base_url('admin/Reports/StudentPassportListings') ?>" class="passportlist" id="studentpassportlist"><span>Student Passport List </span> </a>
						</li>
											</ul>
				</li>
				
			
				<li class="has_sub">
					<a href="#"  class="waves-effect " >
					<i class="ion-ios7-bookmarks"></i><span>Faculty </span>
					<span class="pull-right"><i class="md md-add"></i></span>  
				</a>
					<ul class="list-unstyled" >
						<li >
							<a href="<?= base_url('admin/GradeForm/') ?>"><span>Grade Form</span> </a>
						</li>
						<!--<li >
							<a href="https://staging.apps.future.edu/admin/GradeForm/professor_list"><span>Professor Courses</span> </a>
						</li> -->
						
					</ul>
				</li>
				

								
							
				<li class="has_sub">
					<a href="#"  class="waves-effect " >
					<i class="ion-ios7-time-outline"></i><span>Timesheet </span>
					<span class="pull-right"><i class="md md-add"></i></span>  
				</a>
				<ul class="list-unstyled" >
				    				         <li >
							<a href="<?= base_url('admin/Users/contract') ?>"><span>Contract</span> </a>
						</li>
										         <li >
							<a href="<?= base_url('admin/Users/category') ?>"><span>Cetegory</span> </a>
						</li>
										         <li >
							<a href="<?= base_url('admin/Timesheet/activeNewContractors') ?>"><span>Attendance</span> </a>
						</li>
										         <li >
							<a href="<?= base_url('admin/Reports/adminTimeReport') ?>"><span>Admin Time Report</span> </a>
						</li>
										         <li >
							<a href="<?= base_url('admin/Reports/adminLockedReport') ?>"><span>Admin Locked Report</span> </a>
						</li>
										         <li >
							<a href="<?= base_url('admin/Users/Team') ?>"><span>Team Manage</span> </a>
						</li>
										         <li >
							<a href="<?= base_url('admin/Timesheet/admin_attendance') ?>"><span>Admin Time Entry</span> </a>
						</li>
										         <li >
							<a href="<?= base_url('admin/AssignCategory') ?>"><span>Assign Category</span> </a>
						</li>
										         <li >
							<a href="<?= base_url('admin/Reports/adminMonthlyReport') ?>"><span>Admin Monthly Report</span> </a>
						</li>
										         <li >
							<a href="<?= base_url('admin/Reports/adminMonthlyJournalReport') ?>"><span>Admin Monthly Journal Report</span> </a>
						</li>
										         <li >
							<a href="<?= base_url('admin/Reports/timeReports') ?>"><span>Time Report</span> </a>
						</li>
										        
						
						
						<!-- End Prabhat -->
						<!--End of apoorv 6/7/2020-->
						<!--<li >
						<a href="https://staging.apps.future.edu/admin/Testing/attendance"><span>Time Entry II</span> </a>
						</li>-->
				        
				        
				        				         <li>
							<a href="<?= base_url('admin/timesheet/admin_indivisual_report') ?>"><span>Admin Indivisual Report</span> </a>
						</li>
							
					</ul>
				</li>
				
					
				
				                     
				
				
				<!-- 				                  -->
				                 
            
				<li class="has_sub">
					<a href="#" class="waves-effect "><i class="fa fa-edit"></i><span>TimeEntry</span>
						<span class="pull-right"><i class="md md-add"></i>
						</span>
					</a>
						<ul class="list-unstyled" >
						<!--li >
							<a href="https://staging.apps.future.edu/admin/Testing/attendance2"><span>Time Entry</span> </a>
						</li-->
						
						<li >
							<a  href="<?= base_url('admin/Timesheet/attendance') ?>"><span>Time Entry</span></a>
						</li> 
                                                <li >
						<a href="<?= base_url('admin/Testing/attendance') ?>"><span>Time Entry II</span> </a>
						</li>
						
						<li >
							<a href="<?= base_url('admin/Reports/monthlyReport') ?>"><span>Monthly Report</span> </a>
						</li>
						
						
						<li >
							<a href="<?= base_url('admin/Reports/monthlyReport2') ?>"><span>Monthly Report-2</span> </a>
						</li>
						
						
						<li >
							<a href="<?= base_url('admin/Reports/monthlyJournalReport') ?>"><span>Monthly Journal Report</span> </a>
						</li>
						<li >
							<a href="<?= base_url('admin/Reports/indivisualReport') ?>"><span>Individual Fiscal Yr Report</span> </a>
						</li>
						
						<li >
							<a href="<?= base_url('admin/Reports/indivisualReport2') ?>"><span>Individual Fiscal Yr Report - 2</span> </a>
						</li>
						
						<li >
						<a href="<?= base_url('admin/Reports/TeamReport') ?>"><span>Team Report</span> </a>
						</li>
						<li >
							<a href="<?= base_url('admin/Reports/teamMonthlyJournlReport') ?>"><span>Team Monthly Journal Report</span> </a>
						</li>	

						
					</ul>
				</li>
								
				 				<li class="has_sub"> 
				<!--<li class="has_sub admin/Form/ViewAppList" style="width: max-content !important;" >-->
					<a href="#" class="waves-effect ">
						<i class="fa fa-book"></i>
						<span> Online Forms </span> <span class="pull-right"><i class="md md-add"></i></span>
					</a>
					
					
					<ul class="sub-menu" >
					  	<li >
							<a href="<?= base_url('formbuilder/Application/reportfilterpendingScheme') ?>">Forms Reports</a>
						</li> 
						<li >
							<a href="<?= base_url('formbuilder/Application/reportpendingScheme') ?>">Forms Received</a>
					    </li>
					    
					    					          <li >
							<a href="<?= base_url('formbuilder/Application/pendingScheme') ?>">Delete Applications</a>
						</li> 
						
					</ul>
				</li> 				<!-- form builder  -->
								
				<li class="has_sub admin/Form/ViewAppList" style="width: max-content !important;" >
					<a href="#" class="waves-effect ">
						<i class="fa fa-book"></i>
						<span> Online Applications </span> <span class="pull-right"><i class="md md-add"></i></span>
					</a>
					
					
					<ul class="sub-menu" >
					  <li >
	                        <a href="<?= base_url('formbuilder/Application/reportfilterpendingScheme') ?>">Report</a>
                     </li> 
  
					 <li >
							<a href="<?= base_url('formbuilder/Application/reportpendingScheme') ?>">Forms Report</a>
					</li>  
					  <li >
							<a href="<?= base_url('formbuilder/Application/pendingScheme') ?>">View Applications</a>
						</li> 
					  <li >
							<a href="<?= base_url('formbuilder/Application/viewTrasaction') ?>">View Transaction</a>
						</li> 
						    
					</ul>
				</li>
				
				<li >
					<a  href="<?= base_url('admin/Myinbox/') ?>"><i class="fa fa-envelope"><sup id='msg_inbox_count'></sup></i><span> My Inbox</span></a>
				</li>
								
				<!-- By Prabhat -->
				    
				    
				<li class="has_sub">
					<a href="#" class="waves-effect "><i class="fa fa-plus"></i><span>Student Application</span>
						<span class="pull-right"><i class="md md-add"></i>
						</span>
					</a>
						<ul class="list-unstyled" >
						    
						<li >
							<a href="<?= base_url('admin/Registration/FormDetail') ?>"><span>Application</span> </a>
						</li>
						
						<li >
                            <a href="<?= base_url('admin/Registration/get_track_form') ?>"><span>Alternative Track Applications</span> </a>
                        </li>
                        
                        <li >
                            <a href="<?= base_url('admin/Registration/add_drop_course') ?>"><span>Course Add/Drop</span> </a>
                        </li>
						
						<li >
							<a href="<?= base_url('admin/Registration/finance_balance') ?>"><span>Finance Balance</span> </a>
						</li>
						
						<li >
							<a href="<?= base_url('admin/Registration/email_templete') ?>"><span>Email Template</span> </a>  
						</li>

						<li >
							<a href="<?= base_url('admin/Registration/staticpage_student') ?>"><span>Static Page</span> </a>
						</li>

						<li >
							<a href="<?= base_url('admin/Registration/get_master_list') ?>"><span>Master List</span> </a>
						</li>
						
						<li >
							<a  href="<?= base_url('admin/Registration/city') ?>"><span>Add City</span></a>
						</li>
                        <li >
						  <a href="<?= base_url('admin/Registration/enthnicity') ?>"><span>Add Ethnicity </span> </a>
						</li>


						<li >
							<a href="<?= base_url('admin/Registration/school') ?>"><span>School</span> </a>
						</li>

						<li >
							<a href="<?= base_url('admin/Registration/degree') ?>"><span>Degree</span> </a>
						</li>

						<li >
							<a href="<?= base_url('admin/Registration/gender') ?>"><span>Gender</span> </a>
						</li>

						<li >
							<a href="<?= base_url('admin/Registration/phone_type') ?>"><span>Type of Phone</span> </a>
						</li>

						<li >
							<a href="<?= base_url('admin/Registration/enrollment_periods') ?>"><span>Enrollment Period</span> </a>
						</li>

						<li >
							<a href="<?= base_url('admin/Registration/travel_frequency') ?>"><span>Travel Frequency</span> </a>
						</li>
						
						
						
					
						
					</ul>
				</li>
								    
				    <!-- End Prabhat -->
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<form action="<?= base_url('admin/PdfBuilder/getDonationReport') ?>" id="donation_report" target="_blank" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="hidden" name="csrf_token" value="271dcfee4f1f3de8044f1f667bc664d4" />

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

</form>
<!--  student passport modal  -->

<!-- Donatio Report Excel -->
<form action="<?= base_url('admin/Reports/getDonationReportExcel') ?>" id="donation_report_excel" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="hidden" name="csrf_token" value="271dcfee4f1f3de8044f1f667bc664d4" />

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

</form>
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

<!-- ============================================================== -->
<!-- Start Content here -->
<!-- ============================================================== --> 

                     
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>


<link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">

 <style>
 #snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  /*-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;*/
  /*animation: fadein 0.5s, fadeout 0.5s 2.5s;*/
}
 
.themeBtn,.themeBtn_no_res,.filter_themeBtn {
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

.filter_themeBtn_new {
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


.help,.filter_help {
    float: left;
    cursor: pointer;
}

.help a,.filter_help a {
   padding: 4px 8px;
    color: #F0F0F0;
    background-color: #3377DD;
    margin: 0 0 0 5px;
    font-size: 12px;
}

.help a:hover,.filter_help a:hover {
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
 
 .close.filter_close_pop_out a,.close.close_pop_out a {
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
    display: "";
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
</style>
<style>
 #cke_Note{
    margin-top:-40px;
}
#cke_boardHistory{
    margin-top:-30px;
}
    .btn-purple,.btn-purple:hover,.btn-purple:focus,.btn-purple:active{
        background-color: #7e57c2!important;
        border: 1px solid #7e57c2!important;
        color: #FFFFFF!important;
        border-radius: 2px !important;
        padding-top: 1px!important;
        padding-right: 3px!important;
        padding-bottom: 1px!important;
        padding-left: 3px!important;
    }  
    
    .table>tbody>tr>td{
        padding:0px !important;
        vertical-align: middle;
    }
    
    
    /*start 04-11-2023*/
    #viewAppListDataTable_wrapper .top .dt-buttons {
        display: none;
    }
    #viewAppListDataTable_wrapper .top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        overflow: hidden;
    }
    #viewAppListDataTable_wrapper .top .clear {
        display: none;
    }
    #viewAppListDataTable_wrapper .top div.dataTables_info {
        padding: 0;
        margin-right: auto;
        margin-top: -7px;
    }
    #viewAppListDataTable_wrapper .top #viewAppListDataTable_length {
        width: 105px;
        overflow: hidden;
        margin-left: -31px;
    }
    /*end 04-11-2023*/
    
</style>


<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>-->
 
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== --> 
<style>
.invalid
{
    background-color:#ff9494 ! important;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
}
/*
.table>thead>tr>th {
  width: 20% !important;
}*/

span.view_outter_box {
    display: flex;
    justify-content: center;
    align-items: center;
}


.form-group .tabs {display: flex;justify-content: space-between;}

</style> 


 <style type="text/css">
    .border_dot{
        border:1px dashed #ccc;
    }
    #dragable_modal .modal-dialog {
        position: fixed;
        max-width: 100%;
        /* box-shadow: 0 0 5px rgba(0,0,0,.5);*/
        background: var(--white);
        /* width:500px; */
        margin: 0;
        /* padding: 20px; */
        /* overflow: hidden; */
        /* resize: both; */
    }
    #dragable_modal .modal-content {
        /* padding: 20px; */
        height: 400px;
        overflow: hidden;
        resize: both;
        /*width:500px;*/
        width: 1190px ! important;
    }
    /*modal for add group*/
    .help {
        float: left;
    }
    .help a {
        padding: 6px 8px;
        color: #F0F0F0;
        background-color: #3377DD;
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
        width: 100%;
        background-color: #f7ecf4;
        border: 6px solid #f9f9f9;
        border-right: 3px solid #f9f9f9;
        border-left: 3px solid #f9f9f9;
        box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%) ;
        -webkit-box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%);
        margin-top:15px;
    }
    .close.filter_close_pop_out, .close.close_pop_out a {
        background-color: #fff!important;
        color: #f32323!important;
        border: 1px solid #fff;
        font-size: 14px!important;
    }
    .checknox-list {
        display: inline-block;
        padding-top: 0;
        padding-bottom: 0;
        font-size: 15px;
        color: #323232;
        margin-top: 8px;
        margin-bottom: 8px;
    }
    span.header_button button.themeBtn {
        margin-bottom: 5px;
    }
    #dragable_modal .modal-title span {
        display: inline-block;
        float: inherit;
    }
    #dragable_modal .modal-title .help a {
        padding: 4px 8px;
        color: #F0F0F0;
        background-color: #3377DD;
        margin: 0 0 0 5px;
        font-size: 12px;
    }
    .remove_button{
        cursor:pointer;
        display:none;
        margin-left:7px;
    }
    h4#header_part { 
        display: flex; 
        align-items: flex-start;
    }
    h4#header_part span.user_name { 
        min-width: 165px; 
    }
    
    .outer_class {
        background: #fff;
        float: left;
        padding: 10px 0;
        margin-bottom: 15px;
        width:100%;
    }
    .outer_class label.control-label, .outer_class span.show {
        font-size: 13px;
    }
    
    .market_td .multiselect.dropdown-toggle.form-control.btn
    {
        display:none;
    }
    
</style>



<div class="content-page">
<!-- Start content -->
<div class="content">
	<div class="container">
		        		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info panel-color">
					<div class="panel-heading">
					    <div class="row">
                            <div class="col-md-2">
                            	<h3 class="panel-title">
                                    Contact Database 
                               </h3>
                            </div>
                            <div class="col-md-8">
                                <style>
    .filter_themeBtn_new{
        margin-top:10px;
        cursor:pointer;
    }
    .filter_themeBtn{
        cursor:pointer !important;
    }
    .filter_search_box {
    border: 1px solid #c3dcff;
    display: inline-block;
    width: 100%;
    padding: 0px;
    cursor:pointer;
    background: #f6faff;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.filter_search_box .filter_help p {
    margin: 0;
}
 .filter_search_box .filter_help p a {
    font-size: 12px;
    background: #f6faff;
    color: #b3b3b3!important;
    padding: 4px 12px;
    margin: 0;
}
.filter_search_box .filter_help p i {
    color: #317eeb;
}
.filter-form-outline {
    margin-left: 10px;
}
button.btn.btn-primary.filter-btn-box {
    margin: 0 -2px 0 0;
    text-transform: uppercase;
    background-color: #60a9cb;
    border: 1px solid #60a9cb;
    cursor: pointer;
}
.filter_search_box span.filter_help {
    line-height: 29px;
}
.filter_search_box .popOut {
    width: 98%;
    background-color: #f6faff;
    box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%);
    -webkit-box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%);
    margin-top: 15px;
    border: 1px solid #f6faff;
    margin-top: 6px ! important;
}
.filter_search_box .checkbox {
    padding-left: 10px;
}
.filter_search_box .filter_themeBtn_new{margin-left: 0px;}
.filter_search_box .popOut .close {  position: absolute; }
.filter_search_box .filter_header_part .filter_themeBtn {
    /*margin: 2px;*/
}
.filter_search_box .popOut .close a {
    margin: 0;
}
.filterTagButton{
    padding: 6px 13px !important;
}
 .filter_themeBtn{
     padding: 6px 13px !important;
     margin-top: 1px !important;
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
<div class="filter_search_box">
    
    <div class="filter-form-outline">
    <span class="filter_header_part">
        
    </span>
    
    <span class='filter_help' data-keyboard="false" data-backdrop="static">
    	<p> <i class="fa fa-search"></i><a class="filter_text">Filter By Tags</a></p>
    	   <div class='pop'>
    		   <div class='close filter_close_pop_out'><a>X</a></div>
    		      <p style="margin:0px;">      
       <div class="col-sm-12">  
    		
    
    	
    		<div class="checkbox checkbox-success checknox-list Donor_div">
            	<button class="filter_themeBtn_new Donor_button_modal" rel_name="Donor">Donor</button>
            </div>
            
            <div class="checkbox checkbox-success checknox-list Alum_div">
            	<button class="filter_themeBtn_new student_button Alum_button_modal" rel_name="Alum" style="color:#fff;background:#6f99d5;">Alum</button>
            </div>
            
            <div class="checkbox checkbox-success checknox-list Student_div">
            	<button class="filter_themeBtn_new student_button Student_button_modal" rel_name="Student">Student</button>
            </div>
            
            <div class="checkbox checkbox-success checknox-list CurrentEmployee_div">
            	<button class="filter_themeBtn_new CurrentEmployee_button_modal" rel_name="Current Employee" style="color:#fff;cursor:pointer ! important;">Current Employee</button>
            </div>
            
            <div class="checkbox checkbox-success checknox-list FormalEmployee_div">
            	<button class="filter_themeBtn_new FormalEmployee_button_modal" rel_name="Formal Employee" style="color:#fff;cursor:pointer ! important;">Formal Employee</button>
            </div>
    		
            <div class="checkbox checkbox-success checknox-list Foundation_div">
            	<button class="filter_themeBtn_new Foundation_button_modal" rel_name="Foundation">Grantmaker Affiliate</button>
            </div> 
            
            <div class="checkbox checkbox-success checknox-list Media_div">
            	<button class="filter_themeBtn_new Media_button_modal" rel_name="Media">Media</button>
            </div> 	
            	
            <div class="checkbox checkbox-success checknox-list Appalachian_div">
            	<button class="filter_themeBtn_new Appalachian_button_modal" rel_name="Appalachian">Appalachian Program </button>
            </div> 
            
            <div class="checkbox checkbox-success checknox-list DanielVIP_div">
            	<button class="filter_themeBtn_new DanielVIP_button_modal" rel_name="DanielVIP">VIP</button>
            	
            </div>
            
            <div class="checkbox checkbox-success checknox-list Vista_div">
            	<button class="filter_themeBtn_new Vista_button_modal" rel_name="Vista">Vista</button>
            </div> 
            
            <div class="checkbox checkbox-success checknox-list BoardMember_div">
            	<button class="filter_themeBtn_new BoardMember_button_modal" rel_name="BoardMember">Past & Present Board Members</button>
            </div> 
            
            <div class="checkbox checkbox-success checknox-list FacultyStaff_div">
            	<button class="filter_themeBtn_new FacultyStaff_button_modal" rel_name="FacultyStaff">Past & Present Faculty & Staff</button>
            </div> 
            
            <div class="checkbox checkbox-success checknox-list Deceased_div">
            	<button class="filter_themeBtn_new Deceased_button_modal" rel_name="Deceased">Deceased</button>
            </div> 
            
            <div class="checkbox checkbox-success checknox-list StudentFamily_div">
            	<button class="filter_themeBtn_new StudentFamily_button_modal" rel_name="StudentFamily">Past & Present Student Family</button>
            	
            </div> 
            
            
            
            <div class="checkbox checkbox-success checknox-list FriendofDaniel_div">
            		<button class="filter_themeBtn_new FriendofDaniel_button_modal" rel_name="FriendofDaniel">Friend of Daniel/ Not VIP</button>
            </div> 
            
            
            <!--start FW: Mailchimp Audience Export Complete-->
            <div class="checkbox checkbox-success checknox-list ProspectiveStudent_div">
            	<button class="filter_themeBtn_new ProspectiveStudent_button_modal" rel_name="ProspectiveStudent">Potential Student</button>
            </div> 
            
            <div class="checkbox checkbox-success checknox-list ProspectiveDonor_div">
            	<button class="filter_themeBtn_new ProspectiveDonor_button_modal" rel_name="prospective_donor">Potential Donor</button>
            </div>
    		<!--End FW: Mailchimp Audience Export Complete-->
    		<div class="checkbox checkbox-success checknox-list TribalCollege_div">
            	<button class="filter_themeBtn_new TribalCollege_button_modal" rel_name="tribal_college">Tribal College</button>
            </div> 
            <div class="checkbox checkbox-success checknox-list HBCU_div">
            	<button class="filter_themeBtn_new HBCU_button_modal" rel_name="hbcu">HBCU</button>
            </div> 
            <div class="checkbox checkbox-success checknox-list WVCollege_div">
            	<button class="filter_themeBtn_new WVCollege_button_modal" rel_name="wv_college">WV College</button>
            </div> 
            <div class="checkbox checkbox-success checknox-list AppalachiaCollege_div">
            	<button class="filter_themeBtn_new AppalachiaCollege_button_modal" rel_name="appalachia_college">Appalachia College</button>
            </div> 
            <div class="checkbox checkbox-success checknox-list USCollege_div">
            	<button class="filter_themeBtn_new USCollege_button_modal" rel_name="us_college">US College</button>
            </div> 
            <div class="checkbox checkbox-success checknox-list AmeriCorps_div">
            	<button class="filter_themeBtn_new AmeriCorps_button_modal" rel_name="americorps">AmeriCorps</button>
            </div>
            <div class="checkbox checkbox-success checknox-list PeaceCorps_div">
            	<button class="filter_themeBtn_new PeaceCorps_button_modal" rel_name="peacecorps">PeaceCorps</button>
            </div> 
            <div class="checkbox checkbox-success checknox-list AcctHold_div">
            	<button class="filter_themeBtn_new AcctHold_button_modal" rel_name="accthold">Acct Hold</button>
            </div> 
    	    <div class="clearfix"></div>
    </div>     
     </p>
    </div>     
    </span>
    </div>
    
    <button type="button" class="btn btn-primary filter-btn-box filterTagButton" >
            Filter
          </button>
    
</div>
<script>
    $(document).on('click','.filter_themeBtn_new',function(){
    var data = $(this).attr('rel_name');
    $('.filter_text').hide();
   //var status = $(this).prop('checked');
    var content = '';
    
        if(data == 'Donor')
        {
            content += '<button class="filter_themeBtn Donor_button" data-name="Donor">Donor <i class="fa fa-times filter_remove_button" rel_name="Donor_button"></i></button>';
            $('.Donor_div').hide();
        }
        if(data == 'Alum'){
            content += '<button  class="filter_themeBtn Alum_button" data-name="Alum" style="color:#fff;background:#6f99d5">Alum <i class="fa fa-times filter_remove_button" rel_name="Alum_button"></i></button>';
            $('.Alum_div').hide();
        }
       if(data == 'Student')
       {
            content += '<button  class="filter_themeBtn Student_button" data-name="Student" style="color:#fff;">Student <i class="fa fa-times filter_remove_button" rel_name="Student_button"></i></button>';
           $('.Student_div').hide();
       }
       if(data == 'Current Employee')
       {
            content += '<button  class="filter_themeBtn CurrentEmployee_button" data-name="Current Employee" style="color:#fff;">Current Employee <i class="fa fa-times filter_remove_button" rel_name="CurrentEmployee_button"></i></button>';
           $('.CurrentEmployee_div').hide();
       }
       if(data == 'Formal Employee')
       {
            content += '<button  class="filter_themeBtn FormalEmployee_button" data-name="Formal Employee" style="color:#fff;">Formal Employee <i class="fa fa-times filter_remove_button" rel_name="FormalEmployee_button"></i></button>';
           $('.FormalEmployee_div').hide();
       }
       
        if(data == 'Foundation')
        {
            content += '<button class="filter_themeBtn Foundation_button" data-name="Foundation">Grantmaker Affiliate <i class="fa fa-times filter_remove_button" rel_name="Foundation_button" ></i></button>';
            $('.Foundation_div').hide();
        }
        if(data == 'Media')
        {
            content += '<button class="filter_themeBtn Media_button" data-name="Media">Media <i class="fa fa-times filter_remove_button" rel_name="Media_button"></i></button>';
            $('.Media_div').hide();
        }
        if(data == 'PartnerOrganization')
        {
            content += '<button class="filter_themeBtn PartnerOrganization_button" data-name="PartnerOrganization">Partner Organization <i class="fa fa-times filter_remove_button" rel_name="PartnerOrganization_button"></i></button>';
            $('.PartnerOrganization_div').hide();
        }
        if(data == 'Appalachian')
        {
            content += '<button class="filter_themeBtn Appalachian_button" data-name="Appalachian">Appalachian Program <i class="fa fa-times filter_remove_button" rel_name="Appalachian_button"></i></button>';
            $('.Appalachian_div').hide();
        }
        if(data == 'BoardMember')
        {
            content += '<button class="filter_themeBtn BoardMember_button" data-name="BoardMember">Past & Present Board Members <i class="fa fa-times filter_remove_button" rel_name="BoardMember_button"></i></button>';
            $('.BoardMember_div').hide();
        }
        if(data == 'FacultyStaff')
        {
            content += '<button class="filter_themeBtn FacultyStaff_button" data-name="FacultyStaff">Past & Present Faculty & Staff <i class="fa fa-times filter_remove_button" rel_name="FacultyStaff_button"></i></button>';
            $('.FacultyStaff_div').hide();
        }
        if(data == 'StudentFamily')
        {
            content += '<button class="filter_themeBtn StudentFamily_button" data-name="StudentFamily">Past & Present Student Family <i class="fa fa-times filter_remove_button" rel_name="StudentFamily_button"></i></button>';
            $('.StudentFamily_div').hide();
        }
        if(data == 'AnnualReport')
        {
            content += '<button class="filter_themeBtn AnnualReport_button" data-name="AnnualReport">Receives Printed Annual Report <i class="fa fa-times filter_remove_button" rel_name="AnnualReport_button"></i></button>';
            $('.AnnualReport_div').hide();
        }
        if(data == 'DanielVIP')
        {
            content += '<button class="filter_themeBtn DanielVIP_button" data-name="DanielVIP">VIP <i class="fa fa-times filter_remove_button" rel_name="DanielVIP_button"></i></button>';
            $('.DanielVIP_div').hide();
        }
        if(data == 'FriendofDaniel')
        {
            content += '<button class="filter_themeBtn FriendofDaniel_button" data-name="FriendofDaniel">Friend of Daniel/ Not VIP <i class="fa fa-times filter_remove_button" rel_name="FriendofDaniel_button"></i></button>';
            $('.FriendofDaniel_div').hide();
        }
        if(data == 'DanielPermissionNeeded')
        {
            content += '<button class="filter_themeBtn DanielPermissionNeeded_button" data-name="DanielPermissionNeeded">Need Daniel Permission to Contact <i class="fa fa-times filter_remove_button" rel_name="DanielPermissionNeeded_button"></i></button>';
            $('.DanielPermissionNeeded_div').hide();
        }
        if(data == 'GraduationInvite')
        {
            content += '<button class="filter_themeBtn GraduationInvite_button" data-name="GraduationInvite">Send Graduation Invitation <i class="fa fa-times filter_remove_button" rel_name="GraduationInvite_button"></i></button>';
            $('.GraduationInvite_div').hide();
        }
        if(data == 'QuarterCenturyReport')
        {
            content += '<button class="filter_themeBtn QuarterCenturyReport_button" data-name="QuarterCenturyReport">Received Quarter Century Report <i class="fa fa-times filter_remove_button" rel_name="QuarterCenturyReport_button"></i></button>';
            $('.QuarterCenturyReport_div').hide();
        }
        if(data == 'Unsubscribed')
        {
            content += '<button class="filter_themeBtn Unsubscribed_button" data-name="Unsubscribed">Do Not Email <i class="fa fa-times filter_remove_button" rel_name="Unsubscribed_button"></i></button>';
            $('.Unsubscribed_div').hide();
        }
        if(data == 'Vista')
        {
            content += '<button class="filter_themeBtn Vista_button" data-name="Vista">Vista <i class="fa fa-times filter_remove_button" rel_name="Vista_button"></i></button>';
            $('.Vista_div').hide();
        }
        if(data == 'Deceased')
        {
            content += '<button class="filter_themeBtn Deceased_button" data-name="Deceased">Deceased <i class="fa fa-times filter_remove_button" rel_name="Deceased_button"></i></button>';
            $('.Deceased_div').hide();
        }
        if(data == 'ProspectiveStudent')
        {
            content += '<button class="filter_themeBtn ProspectiveStudent_button" data-name="ProspectiveStudent">Potential Student <i class="fa fa-times filter_remove_button" rel_name="ProspectiveStudent_button"></i></button>';
            $('.ProspectiveStudent_div').hide();
        }
        if(data == 'prospective_donor')
        {
            content += '<button class="filter_themeBtn ProspectiveDonor_button" data-name="prospective_donor">Potential Donor <i class="fa fa-times filter_remove_button" rel_name="ProspectiveDonor_button"></i></button>';
            $('.ProspectiveDonor_div').hide();
        }
        
        if(data == 'tribal_college')
        {
            content += '<button class="filter_themeBtn TribalCollege_button" data-name="tribal_college">Tribal College <i class="fa fa-times filter_remove_button" rel_name="TribalCollege_button"></i></button>';
            $('.TribalCollege_div').hide();
        }
        if(data == 'hbcu')
        {
            content += '<button class="filter_themeBtn HBCU_button" data-name="hbcu">HBCU <i class="fa fa-times filter_remove_button" rel_name="HBCU_button"></i></button>';
            $('.HBCU_div').hide();
        }
        if(data == 'wv_college')
        {
            content += '<button class="filter_themeBtn WVCollege_button" data-name="wv_college">WV College<i class="fa fa-times filter_remove_button" rel_name="WVCollege_button"></i></button>';
            $('.WVCollege_div').hide();
        }
        if(data == 'appalachia_college')
        {
            content += '<button class="filter_themeBtn AppalachiaCollege_button" data-name="appalachia_college">Appalachia College <i class="fa fa-times filter_remove_button" rel_name="AppalachiaCollege_button"></i></button>';
            $('.AppalachiaCollege_div').hide();
        }
        if(data == 'us_college')
        {
            content += '<button class="filter_themeBtn USCollege_button" data-name="us_college">US College <i class="fa fa-times filter_remove_button" rel_name="USCollege_button"></i></button>';
            $('.USCollege_div').hide();
        }
        if(data == 'americorps')
        {
            content += '<button class="filter_themeBtn AmeriCorps_button" data-name="americorps">AmeriCorps <i class="fa fa-times filter_remove_button" rel_name="AmeriCorps_button"></i></button>';
            $('.AmeriCorps_div').hide();
        }
        if(data == 'peacecorps')
        {
            content += '<button class="filter_themeBtn PeaceCorps_button" data-name="peacecorps">PeaceCorps <i class="fa fa-times filter_remove_button" rel_name="PeaceCorps_button"></i></button>';
            $('.PeaceCorps_div').hide();
        }
        
        if(data == 'accthold')
        {
            content += '<button class="filter_themeBtn AcctHold_button" data-name="accthold">Acct Hold <i class="fa fa-times filter_remove_button" rel_name="AcctHold_button"></i></button>';
            $('.PeaceCorps_div').hide();
        }
        
    
   
    
    $('.filter_header_part').append(content);
})


$(document).on('click','.filter_remove_button',function(){
        var data = $(this).attr('rel_name');
        if(data == 'Donor_button')
        {
            $('.Donor_button').remove();
            $('.Donor_div').show();
            $('input:checkbox[name=Donor]').attr('checked',false);
        }
        if(data == 'Student_button')
        {
            $('.Student_button').remove();
            $('.Student_div').show();
        }
        if(data == 'Alum_button')
        {
            $('.Alum_button').remove();
            $('.Alum_div').show();
        }
        if(data == 'FormalEmployee_button')
        {
            $('.FormalEmployee_button').remove();
            $('.FormalEmployee_div').show();
        }
        if(data == 'CurrentEmployee_button')
        {
            $('.CurrentEmployee_button').remove();
            $('.CurrentEmployee_div').show();
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
        
        if(data == 'AcctHold_button'){
            $('.AcctHold_button').remove();
            $('.AcctHold_div').show(); 
        }
        
    
})

$(document).on('click','.filter_close_pop_out',function(){
    $('.filter_remove_button').hide();
})

</script>                            </div>
          
					        
                            <div class="col-md-2"> 
                            	                            	<a href=<?= base_url('admin/Form') ?> class="btn-sm btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" style="font-size: 12px;background: #fff;color: #000!important;border: 1px solid #d5d5d5;padding: 4px 12px;margin: 0;">
                            		<i class="icon ion-plus-circled"></i>	
                            		<span><strong>Add New</strong></span>            
                            	</a> 
                            	                            </div>
					    </div>
					</div>
					
						
						
						
						
						
						
						
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div id="snackbar" style="z-index:99999999">Some text some message..</div>													 
							   
								<table id="viewAppListDataTable" class="table table-striped table-bordered">
									<thead>
										<tr>
										    <th style="width:10%!important">Action</th>
										    <th>Contact Id</th>
											<th>First Name</th>
											<th>Last Name</th>                                  
											<th>Spouse</th>
											<th>Company</th>
										</tr>
									</thead>
								    
								</table>
								
								
								
								
								
								
								
								
								<!-- dragable and editable bootsttrap modal modal -->
    <!--div class="modal fade" id="dragable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header w-100">
            <div class="row m-0 w-100">
              <div class="col-md-12 px-4 p-2 dragable_touch d-block">
                <h3 class="m-0 d-inline">Edit row settings</h3>
                <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close" data-backdrop="static" data-keyboard="false"><i class="fa fa-times"></i></button>
              </div>


              <div class="col-md-12 p-0">
                <ul class="nav nav-tabs custom_tab_on_editor" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#row_seetings_general_tab" role="tab" aria-controls="home" aria-selected="true">General</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#row_seetings_design_tab" role="tab" aria-controls="profile" aria-selected="false">Design</a>
                  </li>
                </ul>
              </div>
            </div>
            
          </div>

          <div class="modal-body p-3">
            
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="row_seetings_general_tab" role="tabpanel" aria-labelledby="home-tab">
                <div class="form-group">
                  <label for="edit_project_name">Add row id</label>
                  <input type="text" class="form-control" id="row_id" >
                </div>
                <div class="form-group">
                  <label for="edit_project_name">Add extra class</label>
                  <input type="text" class="form-control" id="edit_project_name" />
                </div>
              </div>
              <div class="tab-pane fade" id="row_seetings_design_tab" role="tabpanel" aria-labelledby="profile-tab">...</div>
            </div>
          </div>

          <div class="modal-footer bg-light">
            <div class="row w-100">
              <div class="col-6">
                <button type="reset" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
              <div class="col-6 text-right">
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div-->

			
			
			
<div id="dragable_modal" class="modal fade xmodal" role="dialog" tabindex="-1" aria-labelledby="myModalLabel2" data-backdrop="static" data-keyboard="false" style="top:25 !important;
    left:50 !important;margin-left:50px;">
  <div class="modal-dialog modal-lg" style="width:95%;">
 <button type="button" class="close close_modal_button" data-dismiss="modal">&times;</button>
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-content-in">
              <div class="modal-header modal-header_data">
                <h4 class="modal-title" id="header_part"></h4>
              </div>
              <div class="modal-body" style="height:600px;overflow-y:scroll;">
                <span id="r_result"></span>
              </div>
              <div class="modal-footer modal-footer_data">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
      </div>
    </div>

  </div>
</div>					
								
								
								
								
								
								
								
								
								
								
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		
		
		
		
		
	



		
		</div> <!-- End Row -->
	</div> <!-- container -->                              
</div> <!-- content -->




<script type="text/javascript">

// modal draggable

	$(document).on("click",".edit_row_btn",function(){
	    $('#header_part').html('');
	    $('.modal-header_data').hide();
	    $('.modal-footer_data').hide();
	    $('#r_result').html('');
	    var content = '';
	    content+='<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
       
        content+='</main>';
        
         $('#r_result').html(content);
         
         
	    var submit = 'submit';
	    var student_id = $(this).attr('rel_id');
	    $.ajax({
            type: "POST",
            url: '<?= base_url('admin/Form/get_student_tab_data') ?>',
            data: {submit:submit,student_id:student_id},
            dataType: "html",
            success: function(data){
              $('#r_result').html(data);
               $.ajax({
                    type: "POST",
                    url: '<?= base_url('admin/Form/header_part') ?>',
                    data: {submit:submit,student_id:student_id},
                    dataType: "html",
                    success: function(data){
                      $('#header_part').html(data);
                      $('.modal-header_data').show();
                      $('.modal-footer_data').show();
                    },
                });
              
              
            },
        });
        
       
	    
	    
	    $('#dragable_modal').modal({
        backdrop: false,
        show: true
      });
      // reset modal if it isn't visible
      if (!($('.modal.in').length)) {
        $('.modal-content').css({
          top: 20,
          left: 100
        });
      }
    
      $('.modal-content').draggable({
        cursor:"move",
        handle: ".dragable_touch"
      });
	})


    $(document).on('click','.tab',function(){
        $('.tab').removeClass('active');
        $('.tab-pane').removeClass('show');
    })

 /*open group pop */
 $(document).on('click','.help',function(){
        $('.pop').toggleClass('popOut');
        if($('.pop'). hasClass('popOut'))
        {
            $('.remove_button').show();
        }
        else{
		 
             $('.remove_button').hide();
			 
             const role_val = [];
             var user_id = $('#employee_id').val();
             var submit= 'submit';

             $('.themeBtn').each(function () {
                role_val.push($(this).attr('data-name'));
             });
             
		   
			 
		   
			 
              $.ajax({
                    type: "POST",
                    url: '<?= base_url('admin/Form/submitUserRole') ?>',
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
       $('.pop').toggleClass('popOut');   
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
            content += '<button class="themeBtn DanielVIP_button" data-name="DanielVIP">Daniel / VIP <i class="fa fa-times remove_button" rel_name="DanielVIP_button"></i></button>';
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


<!-- Progress bar code -->
<style>

.r_result {
  height: 100vh;
  width: 100%;
}

.r_result {
  background: linear-gradient(to bottom right, #14151c, black, #080b1f);
  display: flex;
  align-items: center;
  justify-content: center;
  justify-items: center;
  height: 100%;
  color: #ededed;
}

#container1 {
  display: flex;
  width: 500px;
  height: 25px;
  background: black;
  border-radius: 6px;
  border: 2px solid dimgray;
  align-items: center;
  margin:0px auto;
}

@keyframes load {
  from {transform: translate(0, 0)}
  to {transform: translate(390px, 0)}
}

#bar {
  width: 100px;
  height: 10px;
  background: linear-gradient(to bottom right, cyan, lightblue);
  border-radius: 6px;
  box-shadow: 0 0 10px lightblue;
  
  animation: load .25s infinite alternate ease-in-out;
}

@keyframes dots {
  from {color: cyan; transform: translate(0, -10%);}
  to {color: white; transform: translate(0, 0);}
}

.dot {
  display: inline-block;
  font-size: 250%;
}

.dot:nth-child(1) {
  animation: dots .5s infinite alternate linear;
}

.dot:nth-child(2) {
  animation: dots 1s infinite alternate linear;
}

.dot:nth-child(3) {
  animation: dots 1.5s infinite alternate linear;
}

.loader sub {
  margin-left: 5%;
  font-size: 15%;
  font-weight: normal;
}
.loader
{
  font-size:20px ! important;
}



/*.patner_org .checkbox input[type=checkbox] {
 margin-left: 0;
 border: none!important;
 width: 17px;
 height: 16px;
 margin-top: 1px;
}
.patner_org .checkbox label:before {
 margin-left: 0;
}
.patner_org .checkbox label {
 padding-left: 25px;
}*/
</style>

<script>
    $(document).on('click','.add_general',function(){
        $('.validate').removeClass('invalid');
         if (!validateForm()) return false;
         
         var formname='';
         formname=$("#general_form");
         var email_count = $('#count6').val();
         var address_counter = $("#count7").val();
         var board_counter = $('#count_board').val();
         var submit = 'submit';
         var phone_counter = $("#count11").val();
         var inter_address_counter = $("#count8").val();
		 
         $.ajax({
            type:"POST",
            dataType:'JSON',
            url:formname.attr("action"),
            data:{ data:formname.serialize(),submit:submit,address_counter:address_counter,email_count:email_count,board_counter:board_counter,phone_counter:phone_counter,inter_address_counter:inter_address_counter},
            success: function(response){
                alert(response.msg);
                $('#dragable_modal').modal('toggle');
            }
        });
    })
    
    
    $(document).on('click','#usphone_save',function(e){
        e.preventDefault();
        $('.phonevalidate').removeClass('invalid');
         if (!phone_validateForm()) return false;
         var formname='';
         formname=$("#general_form");
         var email_count = $('#count6').val();
         var address_counter = $("#count7").val();
         var board_counter = $('#count_board').val();
         var submit = 'usPhone';
         var phone_counter = $("#count11").val();
        
         $.ajax({
            type:"POST",
            dataType:'JSON',
            url:formname.attr("action"),
            data:{ data:formname.serialize(),submit:submit,address_counter:address_counter,email_count:email_count,board_counter:board_counter,phone_counter:phone_counter},
            success: function(response){
                alert(response.msg);
                 $('#dragable_modal').modal('toggle');
            }
        });
    })
    
    $(document).on('click','#board_info_save',function(e){
        e.preventDefault();
        $('.board_validation').removeClass('invalid');
        
         if (!board_validateForm()) return false;
         var formname='';
         formname=$("#general_form");
         var email_count = $('#count6').val();
         var address_counter = $("#count7").val();
         var board_counter = $('#count_board').val();
         var submit = 'board_info';
         var phone_counter = $("#count11").val();
        
         $.ajax({
            type:"POST",
            dataType:'JSON',
            url:formname.attr("action"),
            data:{ data:formname.serialize(),submit:submit,address_counter:address_counter,email_count:email_count,board_counter:board_counter,phone_counter:phone_counter},
            success: function(response){
                alert(response.msg);
                 $('#dragable_modal').modal('toggle');
            }
        });
    })
    
    $(document).on('click','#email_save',function(e){
        
         e.preventDefault();
         
         $('.email_validateForm').removeClass('invalid');
        
         if (!email_validateForm()) return false;
         var formname='';
         formname=$("#general_form");
         var email_count = $('#count6').val();
         var address_counter = $("#count7").val();
         var board_counter = $('#count_board').val();
         var submit = 'email';
         var phone_counter = $("#count11").val();
        
         $.ajax({
            type:"POST",
            dataType:'JSON',
            url:formname.attr("action"),
            data:{ data:formname.serialize(),submit:submit,address_counter:address_counter,email_count:email_count,board_counter:board_counter,phone_counter:phone_counter},
            success: function(response){
                alert(response.msg);
                 $('#dragable_modal').modal('toggle');
            }
        });
        
    })
    
    $(document).on('click','#address_save',function(e){
        e.preventDefault();
        $('.street_validate').removeClass('invalid');
        
         if (!address_validateForm()) return false;
         var formname='';
         formname=$("#general_form");
         var email_count = $('#count6').val();
         var address_counter = $("#count7").val();
         var board_counter = $('#count_board').val();
         var submit = 'address';
         var phone_counter = $("#count11").val();
         $.ajax({
            type:"POST",
            dataType:'JSON',
            url:formname.attr("action"),
            data:{ data:formname.serialize(),submit:submit,address_counter:address_counter,email_count:email_count,board_counter:board_counter,phone_counter:phone_counter},
            success: function(response){
                alert(response.msg);
                 $('#dragable_modal').modal('toggle');
            }
        });
    })
    
    
    $(document).on('click','#inter_address_save',function(e){
        e.preventDefault();
        $('.interaddressType').removeClass('invalid');
        
         if (!inter_address_validateForm()) return false;
         var formname='';
         formname=$("#general_form"); 
         var inter_address_counter = $("#count8").val();
         var submit = 'international_address';
         $.ajax({
            type:"POST",
            dataType:'JSON',
            url:formname.attr("action"),
            data:{ data:formname.serialize(),submit:submit,inter_address_counter:inter_address_counter,},
            success: function(response){
                alert(response.msg);
                 $('#dragable_modal').modal('toggle');
            }
        });
    })
    

    
    
    
    
    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      y = document.getElementsByClassName("validate");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
           var val_data = $(y[i]).attr('name');
           var per_data = $('#personal_info_country_birth :selected').val();
           var var_id = $(y[i]).attr('id');
           $('#'+var_id).focus();
           y[i].className += " invalid";
           // and set the current valid status to false
           valid = false;
        }
      }
      return valid; // return the valid status 
    }
    
    
    function address_validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      y = document.getElementsByClassName("street_validate");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
           var val_data = $(y[i]).attr('name');
           var per_data = $('#personal_info_country_birth :selected').val();
           var var_id = $(y[i]).attr('id');
           $('#'+var_id).focus();
           y[i].className += " invalid";
           // and set the current valid status to false
           valid = false;
        }
      }
      return valid; // return the valid status 
    }
    
    
    function inter_address_validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      y = document.getElementsByClassName("interaddressType");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
           var val_data = $(y[i]).attr('name');
           var per_data = $('#personal_info_country_birth :selected').val();
           var var_id = $(y[i]).attr('id');
           $('#'+var_id).focus();
           y[i].className += " invalid";
           // and set the current valid status to false
           valid = false;
        }
      }
      return valid; // return the valid status 
    }
    
    function email_validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      y = document.getElementsByClassName("email_validateForm");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
           var val_data = $(y[i]).attr('name');
           var per_data = $('#personal_info_country_birth :selected').val();
           var var_id = $(y[i]).attr('id');
           $('#'+var_id).focus();
           y[i].className += " invalid";
           // and set the current valid status to false
           valid = false;
        }
      }
      return valid; // return the valid status 
    }
    
    
    function board_validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      y = document.getElementsByClassName("board_validation");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
           var val_data = $(y[i]).attr('name');
           var per_data = $('#personal_info_country_birth :selected').val();
           var var_id = $(y[i]).attr('id');
           $('#'+var_id).focus();
           y[i].className += " invalid";
           // and set the current valid status to false
           valid = false;
        }
      }
      return valid; // return the valid status 
    }
    
    function phone_validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      y = document.getElementsByClassName("phonevalidate");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
           var val_data = $(y[i]).attr('name');
           var per_data = $('#personal_info_country_birth :selected').val();
           var var_id = $(y[i]).attr('id');
           $('#'+var_id).focus();
           y[i].className += " invalid";
           // and set the current valid status to false
           valid = false;
        }
      }
      return valid; // return the valid status 
    }
    
   function emergencyValidateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      y = document.getElementsByClassName("emergency_validate");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
           var val_data = $(y[i]).attr('name');
           var per_data = $('#personal_info_country_birth :selected').val();
           var var_id = $(y[i]).attr('id');
           $('#'+var_id).focus();
           y[i].className += " invalid";
           // and set the current valid status to false
           valid = false;
        }
      }
      return valid; // return the valid status 
    }
    
</script>


<script>

$(document).on('change','#Sex',function(){
    var sex = $(this).val();
    
    if(sex=='4')
    {
        $('.gender_another').show();
    }
    else
    {
        $('.gender_another').hide();
    }
})


/*  $("#PartnerOrganization").on('click',function(){
	alert(this.value); 
 });//change="PartnerOrganization(this.value)" required */
/*function PartnerOrganizationc(ev){
	//if($('#PartnerOrganization').is(':checked')){
	if($('input[name=PartnerOrganization]').prop('checked')){
		 $('#PartnerOrgName').removeAttr('disabled');   
	}else{ $('#PartnerOrgName').attr('disabled','disabled');  }
}

function vendor(ev){
	//if($('#Vendor').is(':checked')){
	if($('input[name=Vendor]').prop('checked')){
		 $('#Vendordetail').removeAttr('disabled');   
	}else{ $('#Vendordetail').attr('disabled','disabled');  }
}


function validate_general(){
	
	var Street_Address1 = $('#Street_Address1').val();
	var City1 = $('#City1').val();		
	var Country1 = $('#Country1').val();

	if(Street_Address1 == '' || City1 == '' || Country1 == ''){
		
		if(Street_Address1 == ''){
			alert('Street Address is required');
			$('#Street_Address1').focus();
			return false;
		}
		if(City1 == ''){
			alert('City is required');
			$('#City1').focus();
			return false;
		}
		if(Country1 == ''){
			alert('Country is required');
			var Country1 = $('#Country1').focus();
			return false;
		}


	}
	return true;
}*/




</script>

<script>
$(document).on('click','#addButtonRD',function(){
    
	var country_list = JSON.parse('[{"ROWID":"72","CountryID":"Ame","CountryName":"AM","Active":"1","Deletestatus":null},{"ROWID":"2","CountryID":"AST","CountryName":"Austraila","Active":"1","Deletestatus":null},{"ROWID":"3","CountryID":"AUS","CountryName":"Austria","Active":"1","Deletestatus":null},{"ROWID":"4","CountryID":"BAH","CountryName":"Bahrain","Active":"1","Deletestatus":null},{"ROWID":"5","CountryID":"BAN","CountryName":"Bangladesh","Active":"1","Deletestatus":null},{"ROWID":"6","CountryID":"BHU","CountryName":"Bhutan","Active":"1","Deletestatus":null},{"ROWID":"7","CountryID":"BOL","CountryName":"Bolivia","Active":"1","Deletestatus":null},{"ROWID":"8","CountryID":"BUR","CountryName":"Burundi","Active":"1","Deletestatus":null},{"ROWID":"9","CountryID":"CAM","CountryName":"Cambodia","Active":"1","Deletestatus":null},{"ROWID":"10","CountryID":"CAN","CountryName":"Canada","Active":"1","Deletestatus":null},{"ROWID":"11","CountryID":"CHI","CountryName":"China","Active":"1","Deletestatus":null},{"ROWID":"66","CountryID":"CI","CountryName":"Cote d Ivoire","Active":"1","Deletestatus":null},{"ROWID":"56","CountryID":"CMR","CountryName":"Cameroon","Active":"1","Deletestatus":null},{"ROWID":"12","CountryID":"CZE","CountryName":"Czech Republic","Active":"1","Deletestatus":null},{"ROWID":"13","CountryID":"DEN","CountryName":"Denmark","Active":"1","Deletestatus":null},{"ROWID":"14","CountryID":"EGY","CountryName":"Egypt","Active":"1","Deletestatus":null},{"ROWID":"15","CountryID":"ENG","CountryName":"England","Active":"1","Deletestatus":null},{"ROWID":"70","CountryID":"ES","CountryName":"El Salvador","Active":"1","Deletestatus":null},{"ROWID":"16","CountryID":"ETH","CountryName":"Ethiopia","Active":"1","Deletestatus":null},{"ROWID":"17","CountryID":"FRA","CountryName":"France","Active":"1","Deletestatus":null},{"ROWID":"18","CountryID":"GER","CountryName":"Germany","Active":"1","Deletestatus":null},{"ROWID":"19","CountryID":"GHA","CountryName":"Ghana","Active":"1","Deletestatus":null},{"ROWID":"20","CountryID":"GUY","CountryName":"Guyana","Active":"1","Deletestatus":null},{"ROWID":"21","CountryID":"HAI","CountryName":" Haiti","Active":"1","Deletestatus":null},{"ROWID":"22","CountryID":"HON","CountryName":"Hong Kong","Active":"1","Deletestatus":null},{"ROWID":"23","CountryID":"INA","CountryName":"India\/Arunachal Pradesh","Active":"1","Deletestatus":null},{"ROWID":"24","CountryID":"IND","CountryName":"India","Active":"1","Deletestatus":null},{"ROWID":"25","CountryID":"IRA","CountryName":"Iran","Active":"1","Deletestatus":null},{"ROWID":"67","CountryID":"IRE","CountryName":"Ireland","Active":"1","Deletestatus":null},{"ROWID":"69","CountryID":"JAM","CountryName":"Jamaica","Active":"1","Deletestatus":null},{"ROWID":"63","CountryID":"JAP","CountryName":"Japan","Active":"1","Deletestatus":null},{"ROWID":"26","CountryID":"KEN","CountryName":"Kenya","Active":"1","Deletestatus":null},{"ROWID":"55","CountryID":"LBR","CountryName":"Liberia","Active":"1","Deletestatus":null},{"ROWID":"27","CountryID":"LIB","CountryName":"Libya","Active":"1","Deletestatus":null},{"ROWID":"62","CountryID":"MA","CountryName":"Mali","Active":"1","Deletestatus":null},{"ROWID":"28","CountryID":"MAL","CountryName":"Malawi","Active":"1","Deletestatus":null},{"ROWID":"29","CountryID":"MON","CountryName":"Monaco","Active":"1","Deletestatus":null},{"ROWID":"64","CountryID":"MOR","CountryName":"Morocco","Active":"1","Deletestatus":null},{"ROWID":"30","CountryID":"MOZ","CountryName":"Mozambique","Active":"1","Deletestatus":null},{"ROWID":"31","CountryID":"NAM","CountryName":"NAMIBIA","Active":"1","Deletestatus":null},{"ROWID":"32","CountryID":"NEP","CountryName":"Nepal","Active":"1","Deletestatus":null},{"ROWID":"33","CountryID":"NET","CountryName":"Netherlands","Active":"1","Deletestatus":null},{"ROWID":"34","CountryID":"NIG","CountryName":"Nigeria","Active":"1","Deletestatus":null},{"ROWID":"35","CountryID":"NOR","CountryName":"Norway","Active":"1","Deletestatus":null},{"ROWID":"36","CountryID":"NZ","CountryName":"New Zealand","Active":"1","Deletestatus":null},{"ROWID":"57","CountryID":"PAK","CountryName":"Pakistan","Active":"1","Deletestatus":null},{"ROWID":"37","CountryID":"PER","CountryName":"Peru","Active":"1","Deletestatus":null},{"ROWID":"65","CountryID":"PNG","CountryName":"Papua New Guinea","Active":"1","Deletestatus":null},{"ROWID":"60","CountryID":"POL","CountryName":"Poland","Active":"1","Deletestatus":null},{"ROWID":"38","CountryID":"RWA","CountryName":"Rwanda","Active":"1","Deletestatus":null},{"ROWID":"68","CountryID":"SKO","CountryName":"South Korea","Active":"1","Deletestatus":null},{"ROWID":"39","CountryID":"SOM","CountryName":"Somalia","Active":"1","Deletestatus":null},{"ROWID":"71","CountryID":"SP","CountryName":"Spain","Active":"1","Deletestatus":null},{"ROWID":"58","CountryID":"SSU","CountryName":"South Sudan","Active":"1","Deletestatus":null},{"ROWID":"40","CountryID":"SUD","CountryName":"Sudan","Active":"1","Deletestatus":null},{"ROWID":"41","CountryID":"SWE","CountryName":"Sweden","Active":"1","Deletestatus":null},{"ROWID":"42","CountryID":"SWI","CountryName":"Switzerland","Active":"1","Deletestatus":null},{"ROWID":"43","CountryID":"TAN","CountryName":"Tanzania","Active":"1","Deletestatus":null},{"ROWID":"61","CountryID":"TH","CountryName":"Thailand","Active":"1","Deletestatus":null},{"ROWID":"44","CountryID":"TIB","CountryName":"Tibet","Active":"1","Deletestatus":null},{"ROWID":"59","CountryID":"TUN","CountryName":"Tunisia","Active":"1","Deletestatus":null},{"ROWID":"45","CountryID":"UAE","CountryName":"United Arab Emirates","Active":"1","Deletestatus":null},{"ROWID":"46","CountryID":"UGA","CountryName":"Uganda","Active":"1","Deletestatus":null},{"ROWID":"47","CountryID":"UK","CountryName":"United Kingdom","Active":"1","Deletestatus":null},{"ROWID":"48","CountryID":"UNK","CountryName":"Unknown","Active":"1","Deletestatus":null},{"ROWID":"49","CountryID":"URU","CountryName":"Uruguay","Active":"1","Deletestatus":null},{"ROWID":"50","CountryID":"USA","CountryName":"United States","Active":"1","Deletestatus":null},{"ROWID":"51","CountryID":"VIE","CountryName":"Vietnam","Active":"1","Deletestatus":null},{"ROWID":"52","CountryID":"ZAM","CountryName":"Zambia","Active":"1","Deletestatus":null}]');
	var state_list = JSON.parse('[{"ROWID":"1","StateID":"AK","StateName":"Alaska","Active":"1","Deletestatus":null},{"ROWID":"2","StateID":"AL","StateName":"Alabama","Active":"1","Deletestatus":null},{"ROWID":"3","StateID":"AR","StateName":"Arkansas","Active":"1","Deletestatus":null},{"ROWID":"4","StateID":"AZ","StateName":"Arizona","Active":"1","Deletestatus":null},{"ROWID":"5","StateID":"BC","StateName":"British Columbia","Active":"1","Deletestatus":null},{"ROWID":"6","StateID":"CA","StateName":"California","Active":"1","Deletestatus":null},{"ROWID":"7","StateID":"CO","StateName":"Colorado","Active":"1","Deletestatus":null},{"ROWID":"8","StateID":"CT","StateName":"Connecticut","Active":"1","Deletestatus":null},{"ROWID":"9","StateID":"DC","StateName":"District of Columbia","Active":"1","Deletestatus":null},{"ROWID":"10","StateID":"DE","StateName":"Delaware","Active":"1","Deletestatus":null},{"ROWID":"11","StateID":"FL","StateName":"Florida","Active":"1","Deletestatus":null},{"ROWID":"12","StateID":"GA","StateName":"Georgia","Active":"1","Deletestatus":null},{"ROWID":"13","StateID":"HI","StateName":"Hawaii","Active":"1","Deletestatus":null},{"ROWID":"14","StateID":"IA","StateName":"Iowa","Active":"1","Deletestatus":null},{"ROWID":"15","StateID":"ID","StateName":"Idaho","Active":"1","Deletestatus":null},{"ROWID":"16","StateID":"IL","StateName":"Illinois","Active":"1","Deletestatus":null},{"ROWID":"17","StateID":"IN","StateName":"Indiana","Active":"1","Deletestatus":null},{"ROWID":"18","StateID":"KS","StateName":"Kansas","Active":"1","Deletestatus":null},{"ROWID":"19","StateID":"KY","StateName":"Kentucky","Active":"1","Deletestatus":null},{"ROWID":"20","StateID":"LA","StateName":"Louisiana","Active":"1","Deletestatus":null},{"ROWID":"21","StateID":"MA","StateName":"Massachusetts","Active":"1","Deletestatus":null},{"ROWID":"22","StateID":"MD","StateName":"Maryland","Active":"1","Deletestatus":null},{"ROWID":"23","StateID":"ME","StateName":"Maine","Active":"1","Deletestatus":null},{"ROWID":"24","StateID":"MI","StateName":"Michigan","Active":"1","Deletestatus":null},{"ROWID":"25","StateID":"MN","StateName":"Minnesota","Active":"1","Deletestatus":null},{"ROWID":"26","StateID":"MO","StateName":"Missouri","Active":"1","Deletestatus":null},{"ROWID":"27","StateID":"MS","StateName":"Mississippi","Active":"1","Deletestatus":null},{"ROWID":"28","StateID":"MT","StateName":"Montana","Active":"1","Deletestatus":null},{"ROWID":"30","StateID":"NC","StateName":"North Carolina","Active":"1","Deletestatus":null},{"ROWID":"31","StateID":"ND","StateName":"North Dakota","Active":"1","Deletestatus":null},{"ROWID":"32","StateID":"NE","StateName":"Nebraska","Active":"1","Deletestatus":null},{"ROWID":"33","StateID":"NH","StateName":"New Hampshire","Active":"1","Deletestatus":null},{"ROWID":"34","StateID":"NJ","StateName":"New Jersey","Active":"1","Deletestatus":null},{"ROWID":"35","StateID":"NM","StateName":"New Mexico","Active":"1","Deletestatus":null},{"ROWID":"36","StateID":"NV","StateName":"Nevada","Active":"1","Deletestatus":null},{"ROWID":"38","StateID":"OH","StateName":"Ohio","Active":"1","Deletestatus":null},{"ROWID":"39","StateID":"OK","StateName":"Oklahoma","Active":"1","Deletestatus":null},{"ROWID":"40","StateID":"OR","StateName":"Oregon","Active":"1","Deletestatus":null},{"ROWID":"41","StateID":"PA","StateName":"Pennsylvania","Active":"1","Deletestatus":null},{"ROWID":"42","StateID":"RI","StateName":"Rhode Island","Active":"1","Deletestatus":null},{"ROWID":"43","StateID":"SC","StateName":"South Carolina","Active":"1","Deletestatus":null},{"ROWID":"44","StateID":"SD","StateName":"South Dakota","Active":"1","Deletestatus":null},{"ROWID":"45","StateID":"TN","StateName":"Tennessee","Active":"1","Deletestatus":null},{"ROWID":"46","StateID":"TX","StateName":"Texas","Active":"1","Deletestatus":null},{"ROWID":"47","StateID":"UT","StateName":"Utah","Active":"1","Deletestatus":null},{"ROWID":"48","StateID":"VA","StateName":"Virginia","Active":"1","Deletestatus":null},{"ROWID":"49","StateID":"VT","StateName":"Vermont","Active":"1","Deletestatus":null},{"ROWID":"50","StateID":"WA","StateName":"Washington","Active":"1","Deletestatus":null},{"ROWID":"51","StateID":"WI","StateName":"Wisconsin","Active":"1","Deletestatus":null},{"ROWID":"52","StateID":"WV","StateName":"West Virginia","Active":"1","Deletestatus":null},{"ROWID":"53","StateID":"WY","StateName":"Wyoming","Active":"1","Deletestatus":null}]');
	
	var add_type_list = JSON.parse('[{"id":"1","name":"Mailing","status":"1","created_at":"2022-06-02 01:22:56"},{"id":"2","name":"Package","status":"1","created_at":"2022-06-02 01:22:56"},{"id":"3","name":"Physical","status":"1","created_at":"2022-06-02 01:23:29"},{"id":"4","name":"Unknown","status":"1","created_at":"2022-06-02 01:23:29"}]');
	
	var counter = $("#addcount7").val();
	
	var rem_count7 = parseInt($("#rem_addcount7").val());
	
	//country_select
	country_html = '<select class="form-control street_validate" name="Country['+counter+']" onchange="getstatedetails(this.value)" required><option value="">Select</option>';
	$.each(country_list, function (key, val) {
		country_html += '<option value="'+val.CountryID+'">'+val.CountryName+'</option>';
    });
	
	//state_select
	state_html = '<select class="form-control" id="state" name="State['+counter+']"><option value="">Select</option>';
	$.each(state_list, function (key, val) {
		state_html += '<option value="'+val.StateID+'">'+val.StateID+' - '+val.StateName+'</option>';
    });
	
	type_html = '<select class="form-control street_validate" id="addressType'+counter+'" required name="addressType['+counter+']"><option value="">Select</option>';
	$.each(add_type_list, function (key, val) {
		type_html += '<option value="'+val.name+'">'+val.name+'</option>';
    });
	
	if(counter>10){
        alert("Only 10 Reference allow");
        return false;
	}
	var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'TextBoxDivGEN' + counter);
	newTextBoxDiv.after().html('<td><input type="hidden" name="Address_RowID['+counter+']" value=""><input type="hidden" name="AddressID['+counter+']" value=""><textarea rows = "1" class="form-control street_validate" name="Street_Address['+counter+']" id="Street_Address'+counter+'" required onChange="validateAddressXCheckbox('+counter+')"></textarea></td><td><textarea rows = "1"  class="form-control" name="Address2['+counter+']" id="Address2'+counter+'"  onChange="validateAddressXCheckbox('+counter+')"></textarea></td><td><input class=" form-control char street_validate" id="City'+counter+'" name="City['+counter+']" type="text" required></td><td>'+state_html+'</td><td><input class="form-control " id="Postal_Code'+counter+'" name="Postal_Code['+counter+']" type="text" maxlength="7"></td><td>'+country_html+'</td><td>'+type_html+'</td><td><input class="" value="1" type="checkbox" name="Active['+counter+']" id="addresscheckbox'+counter+'"></td>');
		  
	newTextBoxDiv.appendTo("#TextBoxesGroupRD");
	counter++;
	$("#addcount7").val(counter++);
	$("#rem_addcount7").val(parseInt(rem_count7+1));
	$('#address_save').css('display', 'block');
});

$(document).on('click','#removeButtonRD',function(){
	var rem_count7 = $("#rem_addcount7").val();
	if(rem_count7==0){
		//$('#address_save').css('display', 'none');
		alert("Address removal not allowed, either update or uncheck the active checkbox.");
		return false;
	}
	//counter--;
	//$("#TextBoxDivGEN" + counter).remove();
	$('#table_address tr:last').remove();	
	$("#rem_addcount7").val(parseInt(rem_count7-1));
	var current_count = $("#addcount7").val();
	$("#addcount7").val(parseInt(current_count-1));
});
</script>
<script>
$('#tab1 .hide').removeClass('hide').addClass('show');
$('#tab1 span.show').removeClass('show').addClass('hide');
$("#tab1 #general_view").show();
$("#tab1 #general_edit").hide();
$("#tab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive").attr("disabled",false);	
</script>
<script type="text/javascript">
$(document).on('click','#general_edit',function(){ 
	
	$('#tab1 .hide').removeClass('hide').addClass('show');
	$('#tab1 span.show').removeClass('show').addClass('hide');
	$("#tab1 #general_view").show();
	$("#tab1 #general_edit").hide();
	$("#tab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive").attr("disabled",false);	
	$('.no_border').removeClass('no_border').addClass('edit_border');
    $('#email_save').show();
	$('#address_save').show();
		$('#inter_address_save').show();

});

$(document).on('click','#general_view',function(){	
	
	$('#tab1 .show').removeClass('show').addClass('hide');
	$('#tab1 span.hide').removeClass('hide').addClass('show');	
	$(this).hide();
	$("#tab1 #general_edit").show();
	$("#tab1 #checkbox input:checkbox, .address_active, .email_active,.email_unsubscribed,.USActive").attr("disabled",true);	
	$('#email_save').hide();
	$('#address_save').hide();
	$('.edit_border').removeClass('edit_border').addClass('no_border');
	
	$('#inter_address_save').hide();
			
});



</script>
<script>
  $(document).ready(function(){
        $('input[name="phone"], input[name="fed_phone"]').mask('(000) 000 0000');
        $('input[name="fax_no"]').mask('+99-9999999999');
        $('input[name="employer_fax"]').mask('+99-9999999999');
        $('input[name="aadhar"]').mask('999999999999');
        $('input[name="aadhar_enroll_no"]').mask('9999/99999/99999');
        $('.year').mask('9999');
        $('.passedyear').mask('9999');
		$('.mask').mask('9.99');
    });

   
	
    function validateEmployerEmail(email) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	
        if (reg.test(email) == false) 
        {
            alert('Enter Valid E-mail Below Given Format \r\n email@subdomain.example.com or \r\n (testuser@gmail.com)');
            document.getElementById("employer_email").value="";
        }
	
    }


</script>

<script type="text/javascript">
 function validateCheckbox(id){
	var email = $('#Email'+id).val();
	if(email!=" "){
		$("#emailstatus"+id).prop('checked',true);
	}
	else{
		$("#emailstatus"+id).prop('checked',false);
	}
	validateEmail(email);
	
 }
 
function validateAddressXCheckbox(id){
	var current_value = $('#Street_Address'+id).val();
	if(current_value!=""){
		$("#addresscheckbox"+id).prop('checked',true);
	}
	else {
		$("#addresscheckbox"+id).prop('checked',false);
	}
}
id="addresscheckbox"
$('.phone_validation').bind('keyup blur', function(){    
	$(this).val( $(this).val().replace(/[^0-9()+-Xx ]/g,'') );   
	//$(this).val( $(this).val().replace(/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]/g,'') );
});



	$(document).on('click','#inter_addButtonRD',function(){
		
		var country_list = JSON.parse('[{"ROWID":"72","CountryID":"Ame","CountryName":"AM","Active":"1","Deletestatus":null},{"ROWID":"2","CountryID":"AST","CountryName":"Austraila","Active":"1","Deletestatus":null},{"ROWID":"3","CountryID":"AUS","CountryName":"Austria","Active":"1","Deletestatus":null},{"ROWID":"4","CountryID":"BAH","CountryName":"Bahrain","Active":"1","Deletestatus":null},{"ROWID":"5","CountryID":"BAN","CountryName":"Bangladesh","Active":"1","Deletestatus":null},{"ROWID":"6","CountryID":"BHU","CountryName":"Bhutan","Active":"1","Deletestatus":null},{"ROWID":"7","CountryID":"BOL","CountryName":"Bolivia","Active":"1","Deletestatus":null},{"ROWID":"8","CountryID":"BUR","CountryName":"Burundi","Active":"1","Deletestatus":null},{"ROWID":"9","CountryID":"CAM","CountryName":"Cambodia","Active":"1","Deletestatus":null},{"ROWID":"10","CountryID":"CAN","CountryName":"Canada","Active":"1","Deletestatus":null},{"ROWID":"11","CountryID":"CHI","CountryName":"China","Active":"1","Deletestatus":null},{"ROWID":"66","CountryID":"CI","CountryName":"Cote d Ivoire","Active":"1","Deletestatus":null},{"ROWID":"56","CountryID":"CMR","CountryName":"Cameroon","Active":"1","Deletestatus":null},{"ROWID":"12","CountryID":"CZE","CountryName":"Czech Republic","Active":"1","Deletestatus":null},{"ROWID":"13","CountryID":"DEN","CountryName":"Denmark","Active":"1","Deletestatus":null},{"ROWID":"14","CountryID":"EGY","CountryName":"Egypt","Active":"1","Deletestatus":null},{"ROWID":"15","CountryID":"ENG","CountryName":"England","Active":"1","Deletestatus":null},{"ROWID":"70","CountryID":"ES","CountryName":"El Salvador","Active":"1","Deletestatus":null},{"ROWID":"16","CountryID":"ETH","CountryName":"Ethiopia","Active":"1","Deletestatus":null},{"ROWID":"17","CountryID":"FRA","CountryName":"France","Active":"1","Deletestatus":null},{"ROWID":"18","CountryID":"GER","CountryName":"Germany","Active":"1","Deletestatus":null},{"ROWID":"19","CountryID":"GHA","CountryName":"Ghana","Active":"1","Deletestatus":null},{"ROWID":"20","CountryID":"GUY","CountryName":"Guyana","Active":"1","Deletestatus":null},{"ROWID":"21","CountryID":"HAI","CountryName":" Haiti","Active":"1","Deletestatus":null},{"ROWID":"22","CountryID":"HON","CountryName":"Hong Kong","Active":"1","Deletestatus":null},{"ROWID":"23","CountryID":"INA","CountryName":"India\/Arunachal Pradesh","Active":"1","Deletestatus":null},{"ROWID":"24","CountryID":"IND","CountryName":"India","Active":"1","Deletestatus":null},{"ROWID":"25","CountryID":"IRA","CountryName":"Iran","Active":"1","Deletestatus":null},{"ROWID":"67","CountryID":"IRE","CountryName":"Ireland","Active":"1","Deletestatus":null},{"ROWID":"69","CountryID":"JAM","CountryName":"Jamaica","Active":"1","Deletestatus":null},{"ROWID":"63","CountryID":"JAP","CountryName":"Japan","Active":"1","Deletestatus":null},{"ROWID":"26","CountryID":"KEN","CountryName":"Kenya","Active":"1","Deletestatus":null},{"ROWID":"55","CountryID":"LBR","CountryName":"Liberia","Active":"1","Deletestatus":null},{"ROWID":"27","CountryID":"LIB","CountryName":"Libya","Active":"1","Deletestatus":null},{"ROWID":"62","CountryID":"MA","CountryName":"Mali","Active":"1","Deletestatus":null},{"ROWID":"28","CountryID":"MAL","CountryName":"Malawi","Active":"1","Deletestatus":null},{"ROWID":"29","CountryID":"MON","CountryName":"Monaco","Active":"1","Deletestatus":null},{"ROWID":"64","CountryID":"MOR","CountryName":"Morocco","Active":"1","Deletestatus":null},{"ROWID":"30","CountryID":"MOZ","CountryName":"Mozambique","Active":"1","Deletestatus":null},{"ROWID":"31","CountryID":"NAM","CountryName":"NAMIBIA","Active":"1","Deletestatus":null},{"ROWID":"32","CountryID":"NEP","CountryName":"Nepal","Active":"1","Deletestatus":null},{"ROWID":"33","CountryID":"NET","CountryName":"Netherlands","Active":"1","Deletestatus":null},{"ROWID":"34","CountryID":"NIG","CountryName":"Nigeria","Active":"1","Deletestatus":null},{"ROWID":"35","CountryID":"NOR","CountryName":"Norway","Active":"1","Deletestatus":null},{"ROWID":"36","CountryID":"NZ","CountryName":"New Zealand","Active":"1","Deletestatus":null},{"ROWID":"57","CountryID":"PAK","CountryName":"Pakistan","Active":"1","Deletestatus":null},{"ROWID":"37","CountryID":"PER","CountryName":"Peru","Active":"1","Deletestatus":null},{"ROWID":"65","CountryID":"PNG","CountryName":"Papua New Guinea","Active":"1","Deletestatus":null},{"ROWID":"60","CountryID":"POL","CountryName":"Poland","Active":"1","Deletestatus":null},{"ROWID":"38","CountryID":"RWA","CountryName":"Rwanda","Active":"1","Deletestatus":null},{"ROWID":"68","CountryID":"SKO","CountryName":"South Korea","Active":"1","Deletestatus":null},{"ROWID":"39","CountryID":"SOM","CountryName":"Somalia","Active":"1","Deletestatus":null},{"ROWID":"71","CountryID":"SP","CountryName":"Spain","Active":"1","Deletestatus":null},{"ROWID":"58","CountryID":"SSU","CountryName":"South Sudan","Active":"1","Deletestatus":null},{"ROWID":"40","CountryID":"SUD","CountryName":"Sudan","Active":"1","Deletestatus":null},{"ROWID":"41","CountryID":"SWE","CountryName":"Sweden","Active":"1","Deletestatus":null},{"ROWID":"42","CountryID":"SWI","CountryName":"Switzerland","Active":"1","Deletestatus":null},{"ROWID":"43","CountryID":"TAN","CountryName":"Tanzania","Active":"1","Deletestatus":null},{"ROWID":"61","CountryID":"TH","CountryName":"Thailand","Active":"1","Deletestatus":null},{"ROWID":"44","CountryID":"TIB","CountryName":"Tibet","Active":"1","Deletestatus":null},{"ROWID":"59","CountryID":"TUN","CountryName":"Tunisia","Active":"1","Deletestatus":null},{"ROWID":"45","CountryID":"UAE","CountryName":"United Arab Emirates","Active":"1","Deletestatus":null},{"ROWID":"46","CountryID":"UGA","CountryName":"Uganda","Active":"1","Deletestatus":null},{"ROWID":"47","CountryID":"UK","CountryName":"United Kingdom","Active":"1","Deletestatus":null},{"ROWID":"48","CountryID":"UNK","CountryName":"Unknown","Active":"1","Deletestatus":null},{"ROWID":"49","CountryID":"URU","CountryName":"Uruguay","Active":"1","Deletestatus":null},{"ROWID":"50","CountryID":"USA","CountryName":"United States","Active":"1","Deletestatus":null},{"ROWID":"51","CountryID":"VIE","CountryName":"Vietnam","Active":"1","Deletestatus":null},{"ROWID":"52","CountryID":"ZAM","CountryName":"Zambia","Active":"1","Deletestatus":null}]');
		var state_list = JSON.parse('[{"ROWID":"1","StateID":"AK","StateName":"Alaska","Active":"1","Deletestatus":null},{"ROWID":"2","StateID":"AL","StateName":"Alabama","Active":"1","Deletestatus":null},{"ROWID":"3","StateID":"AR","StateName":"Arkansas","Active":"1","Deletestatus":null},{"ROWID":"4","StateID":"AZ","StateName":"Arizona","Active":"1","Deletestatus":null},{"ROWID":"5","StateID":"BC","StateName":"British Columbia","Active":"1","Deletestatus":null},{"ROWID":"6","StateID":"CA","StateName":"California","Active":"1","Deletestatus":null},{"ROWID":"7","StateID":"CO","StateName":"Colorado","Active":"1","Deletestatus":null},{"ROWID":"8","StateID":"CT","StateName":"Connecticut","Active":"1","Deletestatus":null},{"ROWID":"9","StateID":"DC","StateName":"District of Columbia","Active":"1","Deletestatus":null},{"ROWID":"10","StateID":"DE","StateName":"Delaware","Active":"1","Deletestatus":null},{"ROWID":"11","StateID":"FL","StateName":"Florida","Active":"1","Deletestatus":null},{"ROWID":"12","StateID":"GA","StateName":"Georgia","Active":"1","Deletestatus":null},{"ROWID":"13","StateID":"HI","StateName":"Hawaii","Active":"1","Deletestatus":null},{"ROWID":"14","StateID":"IA","StateName":"Iowa","Active":"1","Deletestatus":null},{"ROWID":"15","StateID":"ID","StateName":"Idaho","Active":"1","Deletestatus":null},{"ROWID":"16","StateID":"IL","StateName":"Illinois","Active":"1","Deletestatus":null},{"ROWID":"17","StateID":"IN","StateName":"Indiana","Active":"1","Deletestatus":null},{"ROWID":"18","StateID":"KS","StateName":"Kansas","Active":"1","Deletestatus":null},{"ROWID":"19","StateID":"KY","StateName":"Kentucky","Active":"1","Deletestatus":null},{"ROWID":"20","StateID":"LA","StateName":"Louisiana","Active":"1","Deletestatus":null},{"ROWID":"21","StateID":"MA","StateName":"Massachusetts","Active":"1","Deletestatus":null},{"ROWID":"22","StateID":"MD","StateName":"Maryland","Active":"1","Deletestatus":null},{"ROWID":"23","StateID":"ME","StateName":"Maine","Active":"1","Deletestatus":null},{"ROWID":"24","StateID":"MI","StateName":"Michigan","Active":"1","Deletestatus":null},{"ROWID":"25","StateID":"MN","StateName":"Minnesota","Active":"1","Deletestatus":null},{"ROWID":"26","StateID":"MO","StateName":"Missouri","Active":"1","Deletestatus":null},{"ROWID":"27","StateID":"MS","StateName":"Mississippi","Active":"1","Deletestatus":null},{"ROWID":"28","StateID":"MT","StateName":"Montana","Active":"1","Deletestatus":null},{"ROWID":"30","StateID":"NC","StateName":"North Carolina","Active":"1","Deletestatus":null},{"ROWID":"31","StateID":"ND","StateName":"North Dakota","Active":"1","Deletestatus":null},{"ROWID":"32","StateID":"NE","StateName":"Nebraska","Active":"1","Deletestatus":null},{"ROWID":"33","StateID":"NH","StateName":"New Hampshire","Active":"1","Deletestatus":null},{"ROWID":"34","StateID":"NJ","StateName":"New Jersey","Active":"1","Deletestatus":null},{"ROWID":"35","StateID":"NM","StateName":"New Mexico","Active":"1","Deletestatus":null},{"ROWID":"36","StateID":"NV","StateName":"Nevada","Active":"1","Deletestatus":null},{"ROWID":"38","StateID":"OH","StateName":"Ohio","Active":"1","Deletestatus":null},{"ROWID":"39","StateID":"OK","StateName":"Oklahoma","Active":"1","Deletestatus":null},{"ROWID":"40","StateID":"OR","StateName":"Oregon","Active":"1","Deletestatus":null},{"ROWID":"41","StateID":"PA","StateName":"Pennsylvania","Active":"1","Deletestatus":null},{"ROWID":"42","StateID":"RI","StateName":"Rhode Island","Active":"1","Deletestatus":null},{"ROWID":"43","StateID":"SC","StateName":"South Carolina","Active":"1","Deletestatus":null},{"ROWID":"44","StateID":"SD","StateName":"South Dakota","Active":"1","Deletestatus":null},{"ROWID":"45","StateID":"TN","StateName":"Tennessee","Active":"1","Deletestatus":null},{"ROWID":"46","StateID":"TX","StateName":"Texas","Active":"1","Deletestatus":null},{"ROWID":"47","StateID":"UT","StateName":"Utah","Active":"1","Deletestatus":null},{"ROWID":"48","StateID":"VA","StateName":"Virginia","Active":"1","Deletestatus":null},{"ROWID":"49","StateID":"VT","StateName":"Vermont","Active":"1","Deletestatus":null},{"ROWID":"50","StateID":"WA","StateName":"Washington","Active":"1","Deletestatus":null},{"ROWID":"51","StateID":"WI","StateName":"Wisconsin","Active":"1","Deletestatus":null},{"ROWID":"52","StateID":"WV","StateName":"West Virginia","Active":"1","Deletestatus":null},{"ROWID":"53","StateID":"WY","StateName":"Wyoming","Active":"1","Deletestatus":null}]');
		
		var counter = $("#count8").val();
		var rem_count8 = parseInt($("#rem_count8").val());
		console.log(counter);
		
		//country_select
		country_html = '<select class="form-control" name="inter_Country['+counter+']" onchange="getstatedetails(this.value)"><option value="">Select</option>';
		$.each(country_list, function (key, val) {
			country_html += '<option value="'+val.CountryID+'">'+val.CountryName+'</option>';
	    });
		country_html += '</select>';
		
		var add_type_list = JSON.parse('[{"id":"1","name":"Mailing","status":"1","created_at":"2022-06-02 01:22:56"},{"id":"2","name":"Package","status":"1","created_at":"2022-06-02 01:22:56"},{"id":"3","name":"Physical","status":"1","created_at":"2022-06-02 01:23:29"},{"id":"4","name":"Unknown","status":"1","created_at":"2022-06-02 01:23:29"}]');
		var type_html = '<select class="form-control interaddressType" id="interaddressType'+counter+'" required name="interaddressType['+counter+']"><option value="">Select</option>';
        	$.each(add_type_list, function (key, val) {
        		type_html += '<option value="'+val.name+'">'+val.name+'</option>';
            });
		
		//state_select
		/*state_html = '<select class="form-control" id="inter_state" name="inter_State['+counter+']"><option value="">Select</option>';
		$.each(state_list, function (key, val) {
			state_html += '<option value="'+val.StateID+'">'+val.StateID+' - '+val.StateName+'</option>';
	    });*/
		
		if(counter>10){
	        alert("Only 10 Reference allow");
	        return false;
		}
			var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'TextBoxDivGEN' + counter);
		newTextBoxDiv.after().html('<td><input type="hidden" name="inter_Address_RowID['+counter+']" value="0"><input type="hidden" name="inter_AddressID['+counter+']" value="'+'0'+'"><textarea rows = "1" class="form-control" name="inter_Company_Name['+counter+']" id="inter_Street_Address'+counter+'" onChange="validateAddressXCheckbox('+counter+')"></textarea></td><td><textarea rows = "1"  class="form-control" name="inter_Address1['+counter+']" id="inter_Address2'+counter+'"  onChange="validateAddressXCheckbox('+counter+')"></textarea></td><td><input class=" form-control" id="inter_City'+counter+'" name="inter_Address2['+counter+']" type="text"></td><td><input type="text" class="form-control" id="inter_City'+counter+'" name="inter_City['+counter+']"></td><td>'+country_html+'  </td><td>'+type_html+'</td><td><input class="" value="1" type="checkbox" name="inter_Active['+counter+']" id="addresscheckbox'+counter+'"></td>');
			  
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


//By prabhat 13-10-2020
	$(document).on('change','#citizenship',function(){
	    var data = $(this).val();
	    if(data == 'Not US Citizen')
	    {
	        $("#citizenship_country").css("background-color", "");
	        $("#citizenship_country").css("pointer-events", "");
	        $("#citizenship_country").attr("required","required");
	        $('.citizenship_country').show();
	    }
	    else if(data == '')
	    {
	        $("#citizenship_country").removeAttr("required");
	        
	        $('.citizenship_country').hide();
	        $('#citizenship_country').val('');
	    }
	    else
	    {
	        $("#citizenship_country").css("background-color", "#ccc");
	        $("#citizenship_country").css("pointer-events", "none");
	        $('.citizenship_country').show();
	        $('#citizenship_country').val('USA');
	    }
	})
	//End Prabhat 13-10-2020
    
    
    $(document).on('click','#addBoardInfo',function(){
        var counter = parseInt($('#count_board').val())+1;
        var submit = 'submit';
        $.ajax({
            type: "POST",
            url: '<?= base_url('admin/Form/set_add_more_board_html') ?>',
            data: {counter:counter,student_id:"",submit:submit},
            dataType: "html",
            success: function(data){
              $('#add_more_board').append(data); 
            },
        });
        
       $('#count_board').val(counter);
    })
    
    $(document).on('click','#removeBoardInfo',function(){
      if ($('#add_more_board > tr').length > 1) {
          var fixed_count = parseInt($('#fixed_count_board').val())-1;
          var counter = $('#count_board').val();
          
          if(fixed_count == counter)
          { 
            alert('Board Organization removal not allowed');   
          }
          else
          {   
              $('#add_more_board > tr').last().remove();
              $('#count_board').val(parseInt(counter)-1);
          }
       
      }  
    })
    
    
    $(document).on('change','.board_end_date',function(){
        var rel_id = $(this).attr('rel_id');
        var start_date = $('#start_date_board'+rel_id).val();
        var end_date = $('#end_date_board'+rel_id).val();
        var submit = 'submit';
        $.ajax({
            type: "POST",
            url: '<?= base_url('admin/Form/validate_end_date_from_start_date') ?>',
            data: {start_date:start_date,end_date:end_date,submit:submit},
            dataType: "html",
            success: function(data){
               if(data == 'Please Select First Start Date')
               {
                   alert(data);
               }
              
               if(data == 'End date should not be smaller than start date')
               {
                  $('#end_date_board'+rel_id).val('');
                  alert(data);
               }
             
            },
        });
    })

$(document).on('click','.tab',function(){
    $('.tab').removeClass('active');
    $(this).addClass('active');
})

$(document).on('click','#addButtonEM',function(){
	var counter = $("#count6").val();
	var rem_count6 = parseInt($("#rem_count6").val());
	if(rem_count6>10){
        alert("Only 10 textboxes allow");
        return false;
	}
	var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'TextBoxDivFD' + counter);
		newTextBoxDiv.after().html('<td><input value="" type="hidden" name="Email_RowID['+counter+']"><input value="" type="hidden" name="EmailID['+counter+']" ><input class="form-control check_email email email_validateForm validate" id="Email'+counter+'"  name="Email['+counter+']" type="email"onchange="validateCheckbox('+counter+')" placeholder="username@subdomain.domain" required ></td><td><input class="email_unsubscribed" value="1" type="checkbox" name="EmailUnsubscribed['+counter+']" id="EmailUnsubscribed'+counter+'"></td><td><input value="1" type="checkbox" name="EmailActive['+counter+']" id="emailstatus'+counter+'" checked="true"></td>');
	newTextBoxDiv.appendTo("#TextBoxesGroupFD");
	counter++;
	$("#count6").val(counter++);
	$("#rem_count6").val(parseInt(rem_count6+1));
	$('#email_save').css('display', 'block');
 });

$(document).on('click','#removeButtonEM',function(){
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
            url: '<?= base_url('admin/Form/set_add_more_USPhone_html') ?>',
            data: {counter:counter,student_id:"",submit:submit,counter:counter},
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



</script>	
	
<script>
$(".compensation").change(function() {
    var $this = $(this);
    $this.val(parseFloat($this.val()).toFixed(2));        
});




</script>


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
       student_id = $('#employee_id').val();
        $.ajax({
       		type: "POST",
       		dataType:"html",
       		url: "<?= base_url('admin/Form/store_student_finance') ?>",
       		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 
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
   		url: "<?= base_url('admin/Form/getSemester') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'classname':current},
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
    
    var student_id = $('#employee_id').val();
     $.ajax({
   		type: "POST",
   		dataType:"html",
   		url: "<?= base_url('admin/Form/get_ajax_student_finance') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', filter_year,filter_semester,student_id,payment_from,payment_to},
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
   		url: "<?= base_url('admin/Form/get_ajax_student_finance_payment') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', filter_year,filter_semester,student_id,payment_from,payment_to},
   		success:function(result){
		    $('#payment_result').html(result);
		   
    	},
        });
        
        
     $.ajax({
   		type: "POST",
   		dataType:"html",
   		url: "<?= base_url('admin/Form/get_ajax_student_finance_certificate_payment') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', filter_year,filter_semester,student_id,payment_from,payment_to},
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
    
    var schol = [{"id":"1","name":"Americorps\/Segal","multiple_allow":"0","status":"0","created_at":"2020-08-05 06:09:01"},{"id":"2","name":"Coverdell","multiple_allow":"0","status":"0","created_at":"2020-08-05 06:09:01"},{"id":"3","name":"Institutional","multiple_allow":"1","status":"0","created_at":"2020-08-05 06:09:10"},{"id":"4","name":"Tibetan","multiple_allow":"0","status":"0","created_at":"2021-05-14 04:15:03"},{"id":"5","name":"Himalayan","multiple_allow":"0","status":"0","created_at":"2021-05-14 04:15:31"},{"id":"6","name":"VTZ","multiple_allow":"0","status":"0","created_at":"2021-05-14 04:15:53"},{"id":"7","name":"Chun Wei","multiple_allow":"0","status":"0","created_at":"2021-05-14 04:16:17"},{"id":"8","name":"Community Engagement","multiple_allow":"1","status":"0","created_at":"2022-09-02 15:02:54"},{"id":"9","name":"Testing update","multiple_allow":"1","status":"0","created_at":"2024-12-02 08:34:46"}];
    
    $('#semester').html(semester);
    
    $('#tuition').html(tuition);
    
    $('#m_course_id').val(rel_id);
    $('#type').val(type);
    
    $('#select_class').html($(this).attr('rel_class'));
    
    $('#course_title').html(course_title +" ( "+course_code + " ) ");
    
     
    
    var student_id = $('#employee_id').val();
    var course_id = rel_id;
    
          $.ajax({
				type: "POST",
				url: '<?= base_url('admin/Form/get_student_finance2') ?>',
				data: { student_id,course_id,type},
				dataType: "html",
				success: function(data){
				   // console.log(data);
				  $('.m_result').html('');
				 $('.m_result').append(data);
				 
				 var add_more_size = "9";
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
        
        var schol = [{"id":"1","name":"Americorps\/Segal","multiple_allow":"0","status":"0","created_at":"2020-08-05 06:09:01"},{"id":"2","name":"Coverdell","multiple_allow":"0","status":"0","created_at":"2020-08-05 06:09:01"},{"id":"3","name":"Institutional","multiple_allow":"1","status":"0","created_at":"2020-08-05 06:09:10"},{"id":"4","name":"Tibetan","multiple_allow":"0","status":"0","created_at":"2021-05-14 04:15:03"},{"id":"5","name":"Himalayan","multiple_allow":"0","status":"0","created_at":"2021-05-14 04:15:31"},{"id":"6","name":"VTZ","multiple_allow":"0","status":"0","created_at":"2021-05-14 04:15:53"},{"id":"7","name":"Chun Wei","multiple_allow":"0","status":"0","created_at":"2021-05-14 04:16:17"},{"id":"8","name":"Community Engagement","multiple_allow":"1","status":"0","created_at":"2022-09-02 15:02:54"},{"id":"9","name":"Testing update","multiple_allow":"1","status":"0","created_at":"2024-12-02 08:34:46"}];
         $.ajax({
				type: "POST",
				url: '<?= base_url('admin/Form/delete_student_finance2') ?>',
				data: { rel_no },
				dataType: "html",
				success: function(data){
				 if(data)
				 {
				     
				     $('#snackbar').html("Record Deleted Successfully");
                    $('#snackbar').addClass('show');
                    setTimeout(function() {
                        $("#snackbar").removeClass('show');
                    }, 
                    3000);
				     
				     $('#xmyModal2').modal('hide');
                    $('div').removeClass('modal-backdrop fade in');
                    
                    var student_id = $('#employee_id').val();
                    $.ajax({
                            type: "POST",
                            url: "<?= base_url('admin/Form/get_student_finance_tab_data') ?>",
                            data: { 'student_id':student_id,'submit':'submit'},
                            dataType: "html",
                            success: function(data){
                                $('#xmyModal2').modal('hide');
                                $('div').removeClass('modal-backdrop fade in');
                                $('#tab15').html(data);
                            }
                        })
						
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
    
       var student_id = $('#employee_id').val();
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
				url: 'admin/Form/update_student_finance2',
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
                          
                        // win = window.open('','_self');
                        // win.close();
    	                //window.open(current_url, "_blank");
				     
				     $('#snackbar').html("Record Update Successfully");
                        $('#snackbar').addClass('show');
                        setTimeout(function() {
                            $("#snackbar").removeClass('show');
                        }, 
                        3000);
                        
                        
                        $.ajax({
                            type: "POST",
                            url: "admin/Form/get_student_finance_tab_data",
                            data: { 'student_id':student_id,'submit':'submit'},
                            dataType: "html",
                            success: function(data){
                                $('#xmyModal2').modal('hide');
                                $('div').removeClass('modal-backdrop fade in');
                                $('#tab15').html(data);
                            }
                        })
						
				 }
				 else
				 {
				     $('#snackbar').html("Something Wrong");
                    $('#snackbar').addClass('show');
                    setTimeout(function() {
                    $("#snackbar").removeClass('show');
                    }, 
                    3000);
				 }
				},
		   }); 
      }
    
})

$(document).on('click','.add_detail',function(){
	 $('#snackbar').html('')					   
       var rel_no = $(this).attr('rel_no');
       var student_id = $('#employee_id').val();
       var course_id = $('#m_course_id').val();
       var amount = $('#amount'+rel_no).val();
       var scholar_type= $('#scholar_type'+rel_no).val();
       var message = $('#message'+rel_no).val();
       var type = $('#type').val();
       var next = parseInt(rel_no)+1;
       
       var schol = [{"id":"1","name":"Americorps\/Segal","multiple_allow":"0","status":"0","created_at":"2020-08-05 06:09:01"},{"id":"2","name":"Coverdell","multiple_allow":"0","status":"0","created_at":"2020-08-05 06:09:01"},{"id":"3","name":"Institutional","multiple_allow":"1","status":"0","created_at":"2020-08-05 06:09:10"},{"id":"4","name":"Tibetan","multiple_allow":"0","status":"0","created_at":"2021-05-14 04:15:03"},{"id":"5","name":"Himalayan","multiple_allow":"0","status":"0","created_at":"2021-05-14 04:15:31"},{"id":"6","name":"VTZ","multiple_allow":"0","status":"0","created_at":"2021-05-14 04:15:53"},{"id":"7","name":"Chun Wei","multiple_allow":"0","status":"0","created_at":"2021-05-14 04:16:17"},{"id":"8","name":"Community Engagement","multiple_allow":"1","status":"0","created_at":"2022-09-02 15:02:54"},{"id":"9","name":"Testing update","multiple_allow":"1","status":"0","created_at":"2024-12-02 08:34:46"}];
       
       var add_more_size = "9";
       var n = $( ".no_of_row" ).length;
       
       var m_class = $('#select_class').html();
      var m_semester = $('#semester').html();
       
       
       var scholar_type_text = $( "#scholar_type"+rel_no+" option:selected" ).text();
      
      if(student_id == '')
      {
          $('#snackbar').html("Invalid Student");
        $('#snackbar').addClass('show');
        setTimeout(function() {
            $("#snackbar").removeClass('show');
        }, 
        3000); 
      }
      else if(amount == '')
      {
          $('#snackbar').html("Please add Scholarship Amount");
        $('#snackbar').addClass('show');
        setTimeout(function() {
            $("#snackbar").removeClass('show');
        }, 
        3000);  
      }
      else if(amount < 1)
      {
           $('#snackbar').html("Please select valid amount");
        $('#snackbar').addClass('show');
        setTimeout(function() {
            $("#snackbar").removeClass('show');
        }, 
        3000);   
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
				url: 'admin/Form/store_student_finance2',
				data: { student_id,course_id,amount,scholar_type,message,type,tuition},
				dataType: "json",
				success: function(data){
				    
				    next = parseInt(data)+1;
				if(data == 'over_limit')
				{
				    $('#snackbar').html("Total scholarship shall not exceed tuition fee");
                    $('#snackbar').addClass('show');
                    setTimeout(function() {
                        $("#snackbar").removeClass('show');
                    }, 
                    3000);	  
				}
				else if(data=='already_exits')
				{
				    $('#snackbar').html("This scholarship is already specified in this course for the student");
                    $('#snackbar').addClass('show');
                    setTimeout(function() {
                        $("#snackbar").removeClass('show');
                    }, 
                    3000);  
				}
				 else if(data)
				 {
				    // alert("Data inserted successfully");
                    $('#snackbar').html("Data inserted successfully");
                    $('#snackbar').addClass('show');
                    setTimeout(function() {
                        $("#snackbar").removeClass('show');
                    }, 
                    3000);  
				    
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
                          
                          //win = window.open('','_self');
                         //win.close();
    	                //window.open(current_url, "_blank"); 
				    
				    
				    
				    
				    
				    
				    
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
				            $.ajax({
                            type: "POST",
                            url: "admin/Form/get_student_finance_tab_data",
                            data: { 'student_id':student_id,'submit':'submit'},
                            dataType: "html",
                            success: function(data){
                                $('#xmyModal2').modal('hide');
                                $('div').removeClass('modal-backdrop fade in');
                                $('#tab15').html(data);
                            }
                        })
				     
				 }
				 else
				 {
				     $('#snackbar').html("Something Wrong");
                    $('#snackbar').addClass('show');
                    setTimeout(function() {
                        $("#snackbar").removeClass('show');
                    }, 
                    3000);  
				 }
				},
		   }); 
      }
      
    /*   $.ajax({
				type: "POST",
				url: 'https://staging.apps.future.edu/admin/Master/getCourseByTerm',
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

    
    
     $.ajax({
                    type: "POST",
                    url: "/admin/Form/store_student_finance2",
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
   		url: "admin/Form/getSemester",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'classname':c_class},
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
     $('#set_img').html('<img style="height: 31px;margin-top: 15px;" src="assets/loading_clock2.gif">');
    if(c_class != '')
    {
       
        
        $.ajax({
   		type: "POST",
   		dataType:"html",
   		url: "admin/Form/getSemester",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'classname':c_class},
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
   		url: "admin/Form/update_class_semester_donation",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'selected_class':selected_class,'selected_semester':selected_semester,'donor_row_id':donor_row_id,'submit':submit,"change_status":change_status},
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

    $(document).on('change','.cert_user_class',function(){
     var c_class = $(this).val();
     $('#cert_set_img').html('<img style="height: 31px;margin-top: 15px;" src="<?= base_url('assets/loading_clock2.gif') ?>">');
     if(c_class != '')
     {
       
        
        $.ajax({
   		type: "POST",
   		dataType:"html",
   		url: "<?= base_url('admin/Form/get_cert_Semester') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'classname':c_class},
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
   		url: "<?= base_url('admin/Form/update_class_semester_donation') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'selected_class':selected_class,'selected_semester':selected_semester,'donor_row_id':donor_row_id,'submit':submit,"change_status":change_status},
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


<script>

// By Prabhat 20-10-2020
$(document).on('click','.view_withdrawn_date',function(){
    var rel_date = $(this).attr('rel_date');
    var rel_id = $(this).attr('rel_id');
    
    var curr_date = $('#withdrawn_date'+rel_id).val();
    
    
    
    $('#edit_modal_rel_id').val(rel_id);
    $('#view_selected_date').val(curr_date);
    $('#view_withdrawn_date_model').modal('show');
    
    
})


$(document).on('click','.update_withdrawn',function(){
    var date = $('#selected_date').val();
    var rel_id = $('#modal_rel_id').val();
    $('#withdrawn_date'+rel_id).val(date);
    
    $('#completion_date'+rel_id).val(date);
    
})

$(document).on('click','.update_withdrawn1',function(){
    var date = $('#view_selected_date').val();
    var rel_id = $('#edit_modal_rel_id').val();
    $('#withdrawn_date'+rel_id).val(date);
    $('#completion_date'+rel_id).val(date);
})




 $(document).on('change','.grade',function(){
     var data = $(this).val();
     var row_count = $(this).attr('data-rowid');
     if(data == 'W')
     {
         $("#completion_date"+row_count).css("pointer-events", "none");
         $('#with_date'+row_count).show();
         $('#modal_rel_id').val(row_count);
         $("#withdrawn_date_model").modal('show');
     }
     else
     {
         $("#completion_date"+row_count).css("pointer-events", "");
         $('#with_date'+row_count).hide();
         $('#withdrawn_date'+row_count).val('');
     }
 })
// End Prabhat 20-10-2020

$(document).on('change', '.date-checks', function(){
	var current = $(this).val();
	if(current != ''){
		$(this).closest('tr').find('.date-checks').not(this).attr('disabled', true);
	}else{
		$(this).closest('tr').find('.date-checks').attr('disabled', false);
	}
});

$(document).on('click', '.edit-transcript', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivTS'+row;
	$(selector+' span.show, '+selector+' a.edit-transcript').removeClass('show').addClass('hide');
	$(selector+' input, '+selector+' select, '+selector+' textarea, '+selector+' a.save-transcript, '+selector+' a.del_transcript, '+selector+' a.cancel-transcript').removeClass('hide').addClass('show');
}); 

$(document).on('click', '.cancel-transcript', function(){
	
	var row = $(this).attr('data-row');

	var selector = '#TextBoxDivTS'+row;
	$(selector+' input, '+selector+' select, '+selector+' textarea, '+selector+' a.save-transcript, '+selector+' a.cancel-transcript,'+selector+' a.del_transcript').removeClass('show').addClass('hide');
	$(selector+' span.hide, '+selector+' a.edit-transcript').removeClass('hide').addClass('show');

}); 
</script>
<!-- get term value based on class selection -->
<script type="text/javascript"> 
	$(document).on("click", ".rmv", function() { 
     
		var anim = this.getAttribute("data-urlm"); 
		var anin = this.getAttribute("data-urln"); 
		var row = this.getAttribute("data-row");
		var current = this; 

		if(confirm('Are you sure, Want to Delet this record?')){ 
		    $('#delete_button'+row).hide();
			loading(); 
			$.ajax({ 
				type: "POST", 
				url: "http://localhost:8080/" + "admin/Form/delTranscript",  
				data: {toBeChange: anim,studentid: anin}, 
				success: function(res){ 
					//alert(res); 
					console.log(res); 
					$('#overlay').remove(); 
					if(res != 'OK' || res.length <= 0 || res == null){ 
					alert('Something went wrong'); 
					}else{
						
					alert('Deleted Successfully');
					$('#TextBoxDivTS'+row).remove();
					
					//location.reload(); 
					} 
				} 
			}); 

		} 
	});   
		 function loading() { 
	// add the overlay with loading image to the page 
	var over = '<div id="overlay">' +
	'<p>Please Wait...</p></div>'; 
	$(over).appendTo('body'); 
	} 
	

// get semester dropdown

$(document).on('change', '.studentClass', function(){
	var ev = $(this);
	var current = $(this).val();
	//var counter = 1;
	
	var counter = $(this).attr('data-rowid');
	//alert(counter);
	
	var gradeID = "#grade"+counter;
	var grade_value_ID = "#grade_value"+counter;
	var qualitypointID = "#qualitypoint"+counter;
	//alert(current);

	if(current != ''){
		$('.term').removeAttr("disabled");
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getSemester') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'classname':current},
   		success:function(result){
		$(ev).closest('tr').find('.semester').html(result);	
	
		$(gradeID).val('');
		$(grade_value_ID).val('');
		$(qualitypointID).val('');
		
    	},
        });
	}
});


// get term by Semester

$(document).on('change', '.semester', function(){
	var ev = $(this);
	var current = $(this).val();
	
	var classname =$(ev).closest('tr').find('.studentClass').val();
	
	if(current != ''){
		
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getSemesterTerm') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'semester':current,'classname':classname},
   		success:function(result){
		$(ev).closest('tr').find('.term').html(result);	
		
    	},
        });
	}
});



// get course by semester


$(document).on('change', '.semester', function(){
	var ev = $(this);
	var current = $(this).val();
	var classname =$(ev).closest('tr').find('.studentClass').val();
	if(current != ''){
	
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getCourseBySemester') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'semester':current,'classname':classname},
   		success:function(result){
			
			
		$(ev).closest('tr').find('.course').html(result);	
	 	},
        });
	}
	
});

// get course dropdown value

$(document).on('change', '.term', function(){
	var ev = $(this);
	var current = $(this).val();
	var classname =$(ev).closest('tr').find('.studentClass').val();
	if(current != ''){
		$('.course').removeAttr("disabled");
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getCourseName') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'termname':current,'classname':classname},
   		success:function(result){
		$(ev).closest('tr').find('.course').html(result);	
	 	},
        });
	}
	
});

// get course date

$(document).on('change', '.course', function(){
	var ev = $(this);
	var current = $(this).val();
	if(current != ''){
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getCourseDates') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'coursename':current},
   		success:function(result){
			
		$(ev).closest('tr').find('.coursedates').val(result);	
		
    	},
        });
		
	}
	
});

// get course title

$(document).on('change', '.course', function(){
	var ev = $(this);
	var current = $(this).val();
	if(current != ''){
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getCourseTitle') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'coursename':current},
   		success:function(result){
			
		$(ev).closest('tr').find('.coursetitle').val(result);	
		
    	},
        });
		
	}
	
});

// get professor name

$(document).on('change', '.course', function(){
	var ev = $(this);
	var current = $(this).val();
	if(current != ''){
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getProfessor') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4','coursename':current},
   		success:function(result){
			
		$(ev).closest('tr').find('.professor').val(result);	
		
    	},
        });
		
	}
	
});

// get course credit 

$(document).on('change', '.course', function(){
	var ev = $(this);
	var current = $(this).val();
	if(current != ''){
		 $.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getCourseCredit') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'coursename':current},
   		success:function(result){
			//$("#xyz").html(result)
		$(ev).closest('tr').find('.credit').val(result);
		$(ev).closest('tr').find('.credit').attr("readonly", false);	
		},
        });
		
	}
	
});

// get grade value

$(document).on('change', '.grade', function(){
	var ev = $(this);
	var current = $(this).val();
	var counter = $(this).attr('data-rowid');
	//var counter = 1;
	var transcriptclassid = "#transcriptclass"+counter;
	var transcriptclas = $(transcriptclassid).val();
	//alert(counter);
	if(current != ''){
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getGradeValue') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'gradename':current,'transcriptclas':transcriptclas},
   		success:function(result){
		$(ev).closest('tr').find('.gradevalue').val(result);
        
		var grade_value=result;
		var credits_earned = $(ev).closest('tr').find('.creditearned').val();
		//alert(credits_earned);
		//alert(grade_value);
		

		var res = parseFloat(grade_value) * parseFloat(credits_earned);
		//alert(res);
		qualitypoints = res.toFixed(2);
		
		$(ev).closest('tr').find('.qualitypoint').val(qualitypoints);
		
		},
        });
		
	}
	
});


$(document).on('keyup','.creditearned',function(){
	
	var ev = $(this);
	var creditearned = $(this).val();
	var gradevalue = $(ev).closest('tr').find('.gradevalue').val();
	var res = parseFloat(creditearned) * parseFloat(gradevalue);
	var qualitypoints = res.toFixed(2);
	$(ev).closest('tr').find('.qualitypoint').val(qualitypoints);

});

 function transcript(id){
    transcriptclass_list = JSON.parse('[{"ROWID":"17","Class":"2025","Active":"1","Deletestatus":null},{"ROWID":"16","Class":"2024","Active":"1","Deletestatus":null},{"ROWID":"15","Class":"2023","Active":"1","Deletestatus":null},{"ROWID":"13","Class":"2022","Active":"1","Deletestatus":null},{"ROWID":"12","Class":"2021","Active":"1","Deletestatus":null},{"ROWID":"21","Class":"2020","Active":"1","Deletestatus":null},{"ROWID":"10","Class":"2020","Active":"1","Deletestatus":null},{"ROWID":"9","Class":"2019","Active":"1","Deletestatus":null},{"ROWID":"11","Class":"2018","Active":"1","Deletestatus":null},{"ROWID":"8","Class":"2017","Active":"1","Deletestatus":null},{"ROWID":"7","Class":"2015","Active":"1","Deletestatus":null},{"ROWID":"6","Class":"2014","Active":"1","Deletestatus":null},{"ROWID":"5","Class":"2013","Active":"1","Deletestatus":null},{"ROWID":"4","Class":"2011","Active":"1","Deletestatus":null},{"ROWID":"20","Class":"2010","Active":"1","Deletestatus":null},{"ROWID":"3","Class":"2009","Active":"1","Deletestatus":null},{"ROWID":"19","Class":"2008","Active":"1","Deletestatus":null},{"ROWID":"2","Class":"2007","Active":"1","Deletestatus":null},{"ROWID":"1","Class":"2005","Active":"1","Deletestatus":null},{"ROWID":"14","Class":"0000","Active":"1","Deletestatus":null}]');
	 grade_list = JSON.parse('[{"ROWID":"1","Grade":"A","GradeValue":"4","Active":"1","Deletestatus":null},{"ROWID":"16","Grade":"A+","GradeValue":"4","Active":"1","Deletestatus":null},{"ROWID":"2","Grade":"A-","GradeValue":"3.8","Active":"1","Deletestatus":null},{"ROWID":"18","Grade":"AUDIT","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"3","Grade":"B","GradeValue":"3","Active":"1","Deletestatus":null},{"ROWID":"5","Grade":"B+","GradeValue":"3.3","Active":"1","Deletestatus":null},{"ROWID":"4","Grade":"B-","GradeValue":"2.8","Active":"1","Deletestatus":null},{"ROWID":"6","Grade":"C","GradeValue":"2","Active":"1","Deletestatus":null},{"ROWID":"8","Grade":"C+","GradeValue":"2.3","Active":"1","Deletestatus":null},{"ROWID":"7","Grade":"C-","GradeValue":"1.8","Active":"1","Deletestatus":null},{"ROWID":"9","Grade":"D","GradeValue":"1","Active":"1","Deletestatus":null},{"ROWID":"15","Grade":"D+","GradeValue":"1.3","Active":"1","Deletestatus":null},{"ROWID":"23","Grade":"ENR","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"25","Grade":"ENR P\/F","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"10","Grade":"F","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"11","Grade":"FAIL","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"12","Grade":"I","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"24","Grade":"N\/A","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"13","Grade":"PASS","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"17","Grade":"SCH","GradeValue":"0","Active":"1","Deletestatus":"NULL"},{"ROWID":"22","Grade":"T","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"19","Grade":"TA","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"20","Grade":"TB","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"21","Grade":"TC","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"14","Grade":"W","GradeValue":"0","Active":"1","Deletestatus":null}]');
	 transcript_rowid = $('#transcript_rowid'+id).val();
	 student_id=$('#studentid'+id).val();
	 classname = $('#transcriptclass'+id).val();
	 semester  = $('#semester'+id).val();
	 term      = $('#term'+id).val();
	 term_text = $('#term'+id+' option:selected').text();
	 // By Prabhat
	 withdrawn_date = $('#withdrawn_date'+id).val();
	 
	 withdrawn_html = '<input type="hidden" value="'+withdrawn_date+'" class="form-control" name="withdrawn_date['+id+']" id="withdrawn_date'+id+'">';
	 // End Prabhat
	 
	 
	 
	 
	 if(term_text=="Select Session"){
		 term_text='';
	 }
	 course    = $('#course'+id).val();
	 course_text= $('#course'+id+' option:selected').text();
	 coursetitle = $('#coursetitle'+id).val();
	 professor = $('#professor'+id).val();
	 grade     = $('#grade'+id).val();
	 credits   = $('#credits'+id).val();
	 creditearned = $('#creditearned'+id).val();
	 grade_value = $('#grade_value'+id).val();
	 qualitypoint = $('#qualitypoint'+id).val();
	 
	 coursedates = $('#coursedates'+id).val();
	 trans_next_id = parseInt(id)+1;
	 
	 
	 //By Prabhat 05-11-2020
	  completion_date = $('#completion_date'+id).val();
	 //End Prabhat 05-11-2020
	 
	 if(grade == 'W')
	 {
	     
	     $('#with_date'+id).attr('rel_date',withdrawn_date);
	     $('#with_date'+id).show();
	 }
	 else
	 {
	     $('#with_date'+id).hide();
	 }
	 
	 
	
	// class_html
	class_html = '<select class="form-control studentClass" id="transcriptclass'+trans_next_id+'" name="transcriptclass['+trans_next_id+']"><option value="">Select</option>';
	$.each(transcriptclass_list, function (key, val) {
		class_html += '<option value="'+val.Class+'">'+val.Class+'</option>';
    });
	
	//grade_html
	grade_html = '<select class="form-control grade" id="grade'+trans_next_id+'" data-rowid="'+trans_next_id+'" name="grade['+trans_next_id+']"><option value="">Select</option>';
	$.each(grade_list, function (key, val) {
		grade_html += '<option value="'+val.Grade+'">'+val.Grade+'</option>';
    });
	 new_row = '<tr id="TextBoxDivTS'+trans_next_id+'"><td><input type="hidden" name="studentid'+trans_next_id+'" id="studentid'+trans_next_id+'" value="'+student_id+'"><input type="hidden" name="transcript_rowid'+trans_next_id+'" id="transcript_rowid'+trans_next_id+'" value=""><span class="hide"></span>'+class_html+'</td><td><span class="hide"></span><select name="semester['+trans_next_id+']" id="semester'+trans_next_id+'" class="form-control semester" required><option value="">select Semester</option></select></td><td> <input type="hidden" id="count7" value="2"><span class="hide"></span><select name="term['+trans_next_id+']" class="form-control term" id="term'+trans_next_id+'" disabled><option value="">Select Term</option></select></td><td><span class="hide"></span><select name="course['+trans_next_id+']" class="form-control course" id="course'+trans_next_id+'" disabled><option value="">Select Course</option></select></td><td><span class="hide"></span><textarea name="CourseDates['+trans_next_id+']" id="coursedates'+trans_next_id+'" class="form-control coursedates textarea"></textarea></td><td><span class="hide"></span><textarea name="coursetitle['+trans_next_id+']" id="coursetitle'+trans_next_id+'" class="form-control coursetitle textarea" readonly></textarea></td><td><span class="hide"></span><textarea name="professor['+trans_next_id+']" id="professor'+trans_next_id+'" class="form-control professor" readonly></textarea></td><td><span class="hide"></span>'+grade_html+'<input type="hidden" class="form-control" name="withdrawn_date['+trans_next_id+']" id="withdrawn_date'+trans_next_id+'"></td><td><span class="hide"></span><input class="form-control credit num" id="credits'+trans_next_id+'" name="credits['+trans_next_id+']" type="text" readonly></td><td><span class="hide"></span><input type="text" name="creditearned['+trans_next_id+']" id="creditearned'+trans_next_id+'" class="form-control creditearned" required value="3"></td><td><span class="hide"></span><input class="form-control gradevalue num" id="grade_value'+trans_next_id+'" name="grade_value['+trans_next_id+']" type="text" readonly></td><td><span class="hide"></span><input type="text" name="qualitypoint['+trans_next_id+']" id="qualitypoint'+trans_next_id+'" class="form-control qualitypoint" readonly></td><td style="width:100px !important;"><span class="hide"></span><input class="form-control completion_date date" id="completion_date'+trans_next_id+'" name="completion_date['+trans_next_id+']" type="date"></td><td><a href="javascript:void(0)" id="edit-transcript'+trans_next_id+'" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-transcript hide pull-left" data-id="'+student_id+'" data-row="'+trans_next_id+'" style="text-align:center;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><span><strong></strong></span></a><a href="javascript:void(0)" id="add-transcript'+trans_next_id+'"  class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-transcript"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span><strong></strong></span></a><a href="javascript:void(0)" id="save-transcript'+trans_next_id+'" onclick="validateTranscriptForm('+trans_next_id+', this)" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-transcript hide pull-left" data-id="'+student_id+'" data-row="'+trans_next_id+'"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span><strong></strong></span></a><a href="javascript:void(0)" id="cancel-transcript'+trans_next_id+'"  class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-transcript hide pull-left" data-id="'+student_id+'" data-row="'+trans_next_id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span><strong></strong></span></a></td></tr>';
	 $.ajax({
			type: "POST",
			url: '<?= base_url('admin/Form/submitTranscript') ?>',
			data: {'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'transcript_rowid':transcript_rowid,'student_id':student_id,'courseid':course,'grade':grade,'coursedates':coursedates,'creditattempt':credits,'creditearned':creditearned,'qualitypoints':qualitypoint,'withdrawn_date':withdrawn_date,'completion_date':completion_date},
			dataType: "html",
			success: function(data){
			data = JSON.parse(data);
			alert(data.msg);
			if(data.msg !='Record Already Exist or saved' && data.msg != 'This Course is already added'){
				$('#transcriptclass'+id).prev().html(classname).addClass('show').removeClass('hide');
				$('#semester'+id).prev().html(semester).addClass('show').removeClass('hide');
				$('#term'+id).prev().html(term_text).addClass('show').removeClass('hide');
				$('#course'+id).prev().html(course_text).addClass('show').removeClass('hide');
				$('#coursedates'+id).prev().html(coursedates).addClass('show').removeClass('hide');
				$('#coursetitle'+id).prev().html(coursetitle).addClass('show').removeClass('hide');
				$('#professor'+id).prev().html(professor).addClass('show').removeClass('hide');
				$('#grade'+id).prev().html(withdrawn_html+grade).addClass('show').removeClass('hide');
				$('#grade'+id).prev().addClass('show').removeClass('hide');
				$('#credits'+id).prev().html(credits).addClass('show').removeClass('hide');
				$('#creditearned'+id).prev().html(creditearned).addClass('show').removeClass('hide');
				$('#grade_value'+id).prev().html(grade_value).addClass('show').removeClass('hide');
				$('#qualitypoint'+id).prev().html(qualitypoint).addClass('show').removeClass('hide');
				
				$('#completion_date'+id).prev().html(completion_date).addClass('show').removeClass('hide');
				
				$('#transcriptclass'+id).addClass('hide').removeClass('show');
				
				
				$('#term'+id).addClass('hide').removeClass('show');
				$('#semester'+id).addClass('hide').removeClass('show');
				$('#course'+id).addClass('hide').removeClass('show');
				$('#coursedates'+id).addClass('hide').removeClass('show');
				$('#coursetitle'+id).addClass('hide').removeClass('show');
				$('#professor'+id).addClass('hide').removeClass('show');
			
				$('#grade'+id).addClass('hide').removeClass('show');
				$('#credits'+id).addClass('hide').removeClass('show');
				$('#creditearned'+id).addClass('hide').removeClass('show');
				$('#grade_value'+id).addClass('hide').removeClass('show');
				$('#qualitypoint'+id).addClass('hide').removeClass('show');
				
				$('#completion_date'+id).addClass('hide').removeClass('show');
				
				
				$('#save-transcript'+id).addClass('hide').removeClass('show');
				$('#add-transcript'+id).addClass('hide').removeClass('show');
				$('#delete_button'+id).addClass('hide').removeClass('show');
				$('#edit-transcript'+id).addClass('show').removeClass('hide');
				$('#cancel-transcript'+id).addClass('hide').removeClass('show');
				if(data.last_id != '') {
					 $('#transcript_rowid'+id).val(data.last_id);
					 $('.tbl-body-transcript').prepend(new_row);
					 $('.course').removeAttr("disabled");		
				}
			}
			}, 
		});
	
 }

$(document).on('click', '.add-transcript,.save-transcript', function(){
	var id = this.id.replace( /^\D+/g, '');
	var classname=$('#transcriptclass'+id).val();
	var term =$('#term'+id).val();
	var course = $('#course'+id).val();
	var grade = $('#grade'+id).val();
	
	
	
	if(classname==""){
		alert('Class Not Empty!');
		return false;
	}
	
	if(course==""){
		alert('Course Not Empty !');
		return false;
	}
	if(grade=="" || grade == null){
		alert('Grade Not Empty !');
		return false;
	}
	else{
		transcript(id);
	}
	
});


$(document).on('click','.add-transcript, .save-transcript',function(){
	var ev=$(this);
	if($(ev).closest('tr').find('.creditearned').val()==""){
		$(ev).closest('tr').find('.creditearned').addAttr('required',true);
	}
});



/*  $("#PartnerOrganization").on('click',function(){
	alert(this.value); 
 });//change="PartnerOrganization(this.value)" required */
function PartnerOrganizationc(ev){
	//if($('#PartnerOrganization').is(':checked')){
	if($('input[name=PartnerOrganization]').prop('checked')){
		 $('#PartnerOrgName').removeAttr('disabled');   
	}else{ $('#PartnerOrgName').attr('disabled','disabled');  }
}

function vendor(ev){
	//if($('#Vendor').is(':checked')){
	if($('input[name=Vendor]').prop('checked')){
		 $('#Vendordetail').removeAttr('disabled');   
	}else{ $('#Vendordetail').attr('disabled','disabled');  }
}


function validate_general(){
	var Street_Address1 = $('#Street_Address1').val();
	var City1 = $('#City1').val();		
	var Country1 = $('#Country1').val();

	if(Street_Address1 == '' || City1 == '' || Country1 == ''){
		
		if(Street_Address1 == ''){
			alert('Street Address is required');
			$('#Street_Address1').focus();
			return false;
		}
		if(City1 == ''){
			alert('City is required');
			$('#City1').focus();
			return false;
		}
		/*if(Country1 == ''){
			alert('Country is required');
			var Country1 = $('#Country1').focus();
			return false;
		}*/


	}
	return true;
}




</script>
<script>
$(document).on('click','#addEmpButtonRD',function(){

	var country_list = JSON.parse('[{"ROWID":"72","CountryID":"Ame","CountryName":"AM","Active":"1","Deletestatus":null},{"ROWID":"2","CountryID":"AST","CountryName":"Austraila","Active":"1","Deletestatus":null},{"ROWID":"3","CountryID":"AUS","CountryName":"Austria","Active":"1","Deletestatus":null},{"ROWID":"4","CountryID":"BAH","CountryName":"Bahrain","Active":"1","Deletestatus":null},{"ROWID":"5","CountryID":"BAN","CountryName":"Bangladesh","Active":"1","Deletestatus":null},{"ROWID":"6","CountryID":"BHU","CountryName":"Bhutan","Active":"1","Deletestatus":null},{"ROWID":"7","CountryID":"BOL","CountryName":"Bolivia","Active":"1","Deletestatus":null},{"ROWID":"8","CountryID":"BUR","CountryName":"Burundi","Active":"1","Deletestatus":null},{"ROWID":"9","CountryID":"CAM","CountryName":"Cambodia","Active":"1","Deletestatus":null},{"ROWID":"10","CountryID":"CAN","CountryName":"Canada","Active":"1","Deletestatus":null},{"ROWID":"11","CountryID":"CHI","CountryName":"China","Active":"1","Deletestatus":null},{"ROWID":"66","CountryID":"CI","CountryName":"Cote d Ivoire","Active":"1","Deletestatus":null},{"ROWID":"56","CountryID":"CMR","CountryName":"Cameroon","Active":"1","Deletestatus":null},{"ROWID":"12","CountryID":"CZE","CountryName":"Czech Republic","Active":"1","Deletestatus":null},{"ROWID":"13","CountryID":"DEN","CountryName":"Denmark","Active":"1","Deletestatus":null},{"ROWID":"14","CountryID":"EGY","CountryName":"Egypt","Active":"1","Deletestatus":null},{"ROWID":"15","CountryID":"ENG","CountryName":"England","Active":"1","Deletestatus":null},{"ROWID":"70","CountryID":"ES","CountryName":"El Salvador","Active":"1","Deletestatus":null},{"ROWID":"16","CountryID":"ETH","CountryName":"Ethiopia","Active":"1","Deletestatus":null},{"ROWID":"17","CountryID":"FRA","CountryName":"France","Active":"1","Deletestatus":null},{"ROWID":"18","CountryID":"GER","CountryName":"Germany","Active":"1","Deletestatus":null},{"ROWID":"19","CountryID":"GHA","CountryName":"Ghana","Active":"1","Deletestatus":null},{"ROWID":"20","CountryID":"GUY","CountryName":"Guyana","Active":"1","Deletestatus":null},{"ROWID":"21","CountryID":"HAI","CountryName":" Haiti","Active":"1","Deletestatus":null},{"ROWID":"22","CountryID":"HON","CountryName":"Hong Kong","Active":"1","Deletestatus":null},{"ROWID":"23","CountryID":"INA","CountryName":"India\/Arunachal Pradesh","Active":"1","Deletestatus":null},{"ROWID":"24","CountryID":"IND","CountryName":"India","Active":"1","Deletestatus":null},{"ROWID":"25","CountryID":"IRA","CountryName":"Iran","Active":"1","Deletestatus":null},{"ROWID":"67","CountryID":"IRE","CountryName":"Ireland","Active":"1","Deletestatus":null},{"ROWID":"69","CountryID":"JAM","CountryName":"Jamaica","Active":"1","Deletestatus":null},{"ROWID":"63","CountryID":"JAP","CountryName":"Japan","Active":"1","Deletestatus":null},{"ROWID":"26","CountryID":"KEN","CountryName":"Kenya","Active":"1","Deletestatus":null},{"ROWID":"55","CountryID":"LBR","CountryName":"Liberia","Active":"1","Deletestatus":null},{"ROWID":"27","CountryID":"LIB","CountryName":"Libya","Active":"1","Deletestatus":null},{"ROWID":"62","CountryID":"MA","CountryName":"Mali","Active":"1","Deletestatus":null},{"ROWID":"28","CountryID":"MAL","CountryName":"Malawi","Active":"1","Deletestatus":null},{"ROWID":"29","CountryID":"MON","CountryName":"Monaco","Active":"1","Deletestatus":null},{"ROWID":"64","CountryID":"MOR","CountryName":"Morocco","Active":"1","Deletestatus":null},{"ROWID":"30","CountryID":"MOZ","CountryName":"Mozambique","Active":"1","Deletestatus":null},{"ROWID":"31","CountryID":"NAM","CountryName":"NAMIBIA","Active":"1","Deletestatus":null},{"ROWID":"32","CountryID":"NEP","CountryName":"Nepal","Active":"1","Deletestatus":null},{"ROWID":"33","CountryID":"NET","CountryName":"Netherlands","Active":"1","Deletestatus":null},{"ROWID":"34","CountryID":"NIG","CountryName":"Nigeria","Active":"1","Deletestatus":null},{"ROWID":"35","CountryID":"NOR","CountryName":"Norway","Active":"1","Deletestatus":null},{"ROWID":"36","CountryID":"NZ","CountryName":"New Zealand","Active":"1","Deletestatus":null},{"ROWID":"57","CountryID":"PAK","CountryName":"Pakistan","Active":"1","Deletestatus":null},{"ROWID":"37","CountryID":"PER","CountryName":"Peru","Active":"1","Deletestatus":null},{"ROWID":"65","CountryID":"PNG","CountryName":"Papua New Guinea","Active":"1","Deletestatus":null},{"ROWID":"60","CountryID":"POL","CountryName":"Poland","Active":"1","Deletestatus":null},{"ROWID":"38","CountryID":"RWA","CountryName":"Rwanda","Active":"1","Deletestatus":null},{"ROWID":"68","CountryID":"SKO","CountryName":"South Korea","Active":"1","Deletestatus":null},{"ROWID":"39","CountryID":"SOM","CountryName":"Somalia","Active":"1","Deletestatus":null},{"ROWID":"71","CountryID":"SP","CountryName":"Spain","Active":"1","Deletestatus":null},{"ROWID":"58","CountryID":"SSU","CountryName":"South Sudan","Active":"1","Deletestatus":null},{"ROWID":"40","CountryID":"SUD","CountryName":"Sudan","Active":"1","Deletestatus":null},{"ROWID":"41","CountryID":"SWE","CountryName":"Sweden","Active":"1","Deletestatus":null},{"ROWID":"42","CountryID":"SWI","CountryName":"Switzerland","Active":"1","Deletestatus":null},{"ROWID":"43","CountryID":"TAN","CountryName":"Tanzania","Active":"1","Deletestatus":null},{"ROWID":"61","CountryID":"TH","CountryName":"Thailand","Active":"1","Deletestatus":null},{"ROWID":"44","CountryID":"TIB","CountryName":"Tibet","Active":"1","Deletestatus":null},{"ROWID":"59","CountryID":"TUN","CountryName":"Tunisia","Active":"1","Deletestatus":null},{"ROWID":"45","CountryID":"UAE","CountryName":"United Arab Emirates","Active":"1","Deletestatus":null},{"ROWID":"46","CountryID":"UGA","CountryName":"Uganda","Active":"1","Deletestatus":null},{"ROWID":"47","CountryID":"UK","CountryName":"United Kingdom","Active":"1","Deletestatus":null},{"ROWID":"48","CountryID":"UNK","CountryName":"Unknown","Active":"1","Deletestatus":null},{"ROWID":"49","CountryID":"URU","CountryName":"Uruguay","Active":"1","Deletestatus":null},{"ROWID":"50","CountryID":"USA","CountryName":"United States","Active":"1","Deletestatus":null},{"ROWID":"51","CountryID":"VIE","CountryName":"Vietnam","Active":"1","Deletestatus":null},{"ROWID":"52","CountryID":"ZAM","CountryName":"Zambia","Active":"1","Deletestatus":null}]');
	var state_list = JSON.parse('[{"ROWID":"1","StateID":"AK","StateName":"Alaska","Active":"1","Deletestatus":null},{"ROWID":"2","StateID":"AL","StateName":"Alabama","Active":"1","Deletestatus":null},{"ROWID":"3","StateID":"AR","StateName":"Arkansas","Active":"1","Deletestatus":null},{"ROWID":"4","StateID":"AZ","StateName":"Arizona","Active":"1","Deletestatus":null},{"ROWID":"5","StateID":"BC","StateName":"British Columbia","Active":"1","Deletestatus":null},{"ROWID":"6","StateID":"CA","StateName":"California","Active":"1","Deletestatus":null},{"ROWID":"7","StateID":"CO","StateName":"Colorado","Active":"1","Deletestatus":null},{"ROWID":"8","StateID":"CT","StateName":"Connecticut","Active":"1","Deletestatus":null},{"ROWID":"9","StateID":"DC","StateName":"District of Columbia","Active":"1","Deletestatus":null},{"ROWID":"10","StateID":"DE","StateName":"Delaware","Active":"1","Deletestatus":null},{"ROWID":"11","StateID":"FL","StateName":"Florida","Active":"1","Deletestatus":null},{"ROWID":"12","StateID":"GA","StateName":"Georgia","Active":"1","Deletestatus":null},{"ROWID":"13","StateID":"HI","StateName":"Hawaii","Active":"1","Deletestatus":null},{"ROWID":"14","StateID":"IA","StateName":"Iowa","Active":"1","Deletestatus":null},{"ROWID":"15","StateID":"ID","StateName":"Idaho","Active":"1","Deletestatus":null},{"ROWID":"16","StateID":"IL","StateName":"Illinois","Active":"1","Deletestatus":null},{"ROWID":"17","StateID":"IN","StateName":"Indiana","Active":"1","Deletestatus":null},{"ROWID":"18","StateID":"KS","StateName":"Kansas","Active":"1","Deletestatus":null},{"ROWID":"19","StateID":"KY","StateName":"Kentucky","Active":"1","Deletestatus":null},{"ROWID":"20","StateID":"LA","StateName":"Louisiana","Active":"1","Deletestatus":null},{"ROWID":"21","StateID":"MA","StateName":"Massachusetts","Active":"1","Deletestatus":null},{"ROWID":"22","StateID":"MD","StateName":"Maryland","Active":"1","Deletestatus":null},{"ROWID":"23","StateID":"ME","StateName":"Maine","Active":"1","Deletestatus":null},{"ROWID":"24","StateID":"MI","StateName":"Michigan","Active":"1","Deletestatus":null},{"ROWID":"25","StateID":"MN","StateName":"Minnesota","Active":"1","Deletestatus":null},{"ROWID":"26","StateID":"MO","StateName":"Missouri","Active":"1","Deletestatus":null},{"ROWID":"27","StateID":"MS","StateName":"Mississippi","Active":"1","Deletestatus":null},{"ROWID":"28","StateID":"MT","StateName":"Montana","Active":"1","Deletestatus":null},{"ROWID":"30","StateID":"NC","StateName":"North Carolina","Active":"1","Deletestatus":null},{"ROWID":"31","StateID":"ND","StateName":"North Dakota","Active":"1","Deletestatus":null},{"ROWID":"32","StateID":"NE","StateName":"Nebraska","Active":"1","Deletestatus":null},{"ROWID":"33","StateID":"NH","StateName":"New Hampshire","Active":"1","Deletestatus":null},{"ROWID":"34","StateID":"NJ","StateName":"New Jersey","Active":"1","Deletestatus":null},{"ROWID":"35","StateID":"NM","StateName":"New Mexico","Active":"1","Deletestatus":null},{"ROWID":"36","StateID":"NV","StateName":"Nevada","Active":"1","Deletestatus":null},{"ROWID":"38","StateID":"OH","StateName":"Ohio","Active":"1","Deletestatus":null},{"ROWID":"39","StateID":"OK","StateName":"Oklahoma","Active":"1","Deletestatus":null},{"ROWID":"40","StateID":"OR","StateName":"Oregon","Active":"1","Deletestatus":null},{"ROWID":"41","StateID":"PA","StateName":"Pennsylvania","Active":"1","Deletestatus":null},{"ROWID":"42","StateID":"RI","StateName":"Rhode Island","Active":"1","Deletestatus":null},{"ROWID":"43","StateID":"SC","StateName":"South Carolina","Active":"1","Deletestatus":null},{"ROWID":"44","StateID":"SD","StateName":"South Dakota","Active":"1","Deletestatus":null},{"ROWID":"45","StateID":"TN","StateName":"Tennessee","Active":"1","Deletestatus":null},{"ROWID":"46","StateID":"TX","StateName":"Texas","Active":"1","Deletestatus":null},{"ROWID":"47","StateID":"UT","StateName":"Utah","Active":"1","Deletestatus":null},{"ROWID":"48","StateID":"VA","StateName":"Virginia","Active":"1","Deletestatus":null},{"ROWID":"49","StateID":"VT","StateName":"Vermont","Active":"1","Deletestatus":null},{"ROWID":"50","StateID":"WA","StateName":"Washington","Active":"1","Deletestatus":null},{"ROWID":"51","StateID":"WI","StateName":"Wisconsin","Active":"1","Deletestatus":null},{"ROWID":"52","StateID":"WV","StateName":"West Virginia","Active":"1","Deletestatus":null},{"ROWID":"53","StateID":"WY","StateName":"Wyoming","Active":"1","Deletestatus":null}]');
	
	var counter = $("#count10").val();

	var rem_count7 = parseInt($("#rem_count7").val());
	
	//country_select
	country_html = '<select class="form-control emergency_validate" name="Country['+counter+']" onchange="getstatedetails(this.value)" required><option value="">Select</option>';
	$.each(country_list, function (key, val) {
		country_html += '<option value="'+val.CountryID+'">'+val.CountryName+'</option>';
    });
	
	//state_select
	state_html = '<select class="form-control emergency_validate" id="state" name="State['+counter+']"><option value="">Select</option>';
	$.each(state_list, function (key, val) {
		state_html += '<option value="'+val.StateID+'">'+val.StateID+' - '+val.StateName+'</option>';
    });

    //Relationship_Html
    relationship_html = '<select class="form-control emergency_validate" name="relationship['+counter+']"><option value="all">Select Relationship</option><option value="0">Spouse</option><option value="1">Child</option><option value="2">Parent</option><option value="3">Partner</option><option value="4">Other</option></select>';
	
	
	if(counter>10){
        alert("Only 5 Emergency Contact allow");
        return false;
	}

	var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'TextBoxDivGEN' + counter);
	newTextBoxDiv.after().html('<td><input type="hidden" name="Address_RowID['+counter+']" value=""><input type="hidden" name="AddressID['+counter+']" value=""><textarea required rows="1" class="form-control emergency_validate"  name="Contact_name['+counter+']" id="Contact_name'+counter+'" required onChange="validateAddressXCheckbox('+counter+')"></textarea></td><td><textarea required rows="1" class="form-control num emergency_validate" name="Contact_number['+counter+']" placeholder="(000) 000-0000" maxlength="12" id="Contact_number'+counter+'" onChange="validateAddressXCheckbox('+counter+')"></textarea></td><td>'+relationship_html+'</td><td><input required class=" form-control char emergency_validate" id="Street_Address'+counter+'" name="Street_Address['+counter+']" type="text" required></td><td><input required class=" form-control char emergency_validate" id="City'+counter+'" name="City['+counter+']" type="text" required></td><td>'+state_html+'</td><td>'+country_html+' </td><td><input required class="form-control emergency_validate" id="Postal_Code'+counter+'" name="Postal_Code['+counter+']" type="text" maxlength="7"></td><td><input class="" value="1" type="checkbox" name="Active['+counter+']" id="addresscheckbox'+counter+'"></td>');
		  
	newTextBoxDiv.appendTo("#EmployeeBoxesGroupRD");
	counter++;
	$("#count10").val(counter++);
	$("#rem_count7").val(parseInt(rem_count7+1));
	$('#emp_address_save').css('display', 'block');
});

$(document).on('click','#removeEmpButtonRD',function(){
	var rem_count7 = $("#rem_count7").val();
	if(rem_count7==0){
		//$('#address_save').css('display', 'none');
		alert("Address removal not allowed, either update or uncheck the active checkbox.");
		return false;
	}
	//counter--;
	//$("#TextBoxDivGEN" + counter).remove();
	$('#table_emp_address tr:last').remove();	
	$("#rem_count7").val(parseInt(rem_count7-1));
	var current_count = $("#count7").val();
	$("#count10").val(parseInt(current_count-1));
});
</script>
<script>
$('#tab12 .hide').removeClass('hide').addClass('show');
$('#tab12 span.show').removeClass('show').addClass('hide');
$("#tab12 #emp_view").show();
$("#tab12 #emp_edit").hide();
$("#tab12 #checkbox input:checkbox, .address_active, .email_active").attr("disabled",false);	
</script>
<script type="text/javascript">
$(document).on('click','#emp_edit',function(){
	
	$('#tab12 .hide').removeClass('hide').addClass('show');
	$('#tab12 span.show').removeClass('show').addClass('hide');
	$("#tab12 #emp_view").show();
	$("#tab12 #emp_edit").hide();
	$("#tab12 #checkbox input:checkbox, .address_active, .email_active").attr("disabled",false);	
	$('.no_border').removeClass('no_border').addClass('edit_border');
	$('#emp_address_save').show();

});

$(document).on('click','#emp_view',function(){	
	$('#tab12 .show').removeClass('show').addClass('hide');
	$('#tab12 span.hide').removeClass('hide').addClass('show');	
	$(this).hide();
	$("#tab12 #emp_edit").show();
	$("#tab12 #checkbox input:checkbox, .address_active, .email_active").attr("disabled",true);	
	$('#emp_address_save').hide();
	$('.edit_border').removeClass('edit_border').addClass('no_border');			
});



</script>
<script>
  $(document).ready(function(){
        $('input[name="phone"], input[name="fed_phone"]').mask('(000) 000 0000');
        $('input[name="fax_no"]').mask('+99-9999999999');
        $('input[name="employer_fax"]').mask('+99-9999999999');
        $('input[name="aadhar"]').mask('999999999999');
        $('input[name="aadhar_enroll_no"]').mask('9999/99999/99999');
        $('.year').mask('9999');
        $('.passedyear').mask('9999');
		$('.mask').mask('9.99');
    });

   
	
    function validateEmployerEmail(email) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	
        if (reg.test(email) == false) 
        {
            alert('Enter Valid E-mail Below Given Format \r\n email@subdomain.example.com or \r\n (testuser@gmail.com)');
            document.getElementById("employer_email").value="";
        }
	
    }


</script>

<script type="text/javascript">
 function validateCheckbox(id){
	var email = $('#Email'+id).val();
	if(email!=" "){
		$("#emailstatus"+id).prop('checked',true);
	}
	else{
		$("#emailstatus"+id).prop('checked',false);
	}
	validateEmail(email);
	
 }
 
 function validateAddressXCheckbox(id){
	 
	 var current_value = $('#Street_Address'+id).val();
	 if(current_value!=""){
		$("#addresscheckbox"+id).prop('checked',true);
	 }
	 else {
		  $("#addresscheckbox"+id).prop('checked',false);
	 }
	 
 }
$( document ).ready(function() {
	var EmpID = "0";
	if(EmpID == 0){
		$('#tab12 .hide').removeClass('hide').addClass('show');
		$('#tab12 span.show').removeClass('show').addClass('hide');
		$("#tab12 #emp_view").show();
		$("#tab12 #emp_edit").hide();
	}
});

</script>


<script>
$(document).on('change', '.date-checks', function(){
	var current = $(this).val();
	if(current != ''){
		$(this).closest('tr').find('.date-checks').not(this).attr('disabled', true);
	}else{
		$(this).closest('tr').find('.date-checks').attr('disabled', false);
	}
	
});

$(document).on('click', '.edit-employmentrecord', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivEM'+row;

	$(selector+' textarea, '+selector+' span.show, '+selector+' span.show, '+selector+' a.edit-employmentrecord').removeClass('show').addClass('hide');
	$('#contact_note'+row+', '+selector+' input, '+selector+' select, '+selector+' a.save-employmentrecord, '+selector+' a.cancel-employmentrecord').removeClass('hide').addClass('show');
	$('#contact_note'+row).removeAttr('readonly', true);
	
}); 

$(document).on('click', '.cancel-employmentrecord', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivEM'+row;
	
	$(selector+' input, '+selector+' select, '+selector+' a.save-employmentrecord, '+selector+' a.cancel-employmentrecord').removeClass('show').addClass('hide');
	$(selector+' span.hide, '+selector+' span.hide, '+selector+' a.edit-employmentrecord').removeClass('hide').addClass('show');
	$('#contact_note'+row).attr('readonly', true);

}); 
</script>

<script type="text/javascript">
 $(document).on("click", ".add-employment", function() 
 {
     
 	var edit_user = 'IT Helpdesk';
	var NameID_em=$('#NameID_em').val();
	var id_em=$('#id_em'+id).val();
 	var attachment_name= $('#attachment_name_em').val();
	var upload_attachment = $('#upload_attachment_em').val();
	if(attachment_name != '' && upload_attachment != ''){
	loading();
	var added_by = $('#added_by_em').val();
	var added_date = $('#added_date_em').val();
	var formData = new FormData($('#empattachmentupload')[0]);
	formData.append('csrf_token', '271dcfee4f1f3de8044f1f667bc664d4');
	formData.append('NameID_em',NameID_em);
	formData.append('attachment_name_em',attachment_name);
	formData.append('upload_attachment_em', $('#upload_attachment_em')[0].files[0]); 
	$.ajax({ 
			type: "POST",
			url: '<?= base_url('admin/Form/submitemploymentrecord') ?>',
			data: formData,
			dataType: "html",
			processData: false,
			contentType: false,
			success: function(data){
				$('#overlay').remove(); 
				data = JSON.parse(data);
				//alert(data);
				//console.log('msg'+data.msg);
				if(data.msg =='INSERTED'){
					var tr = '';
					if(data.path != '') {
						alert('Record saved.');						
						//$('#empattachmentupload')[0].reset();
						//$(':text:not("[readonly],[disabled]")').val('');
						$(':text:not("[readonly]")').val('');
						console.log(formData);
						tr += '<tr><td style="text-align:left;">'+attachment_name+'</td>';
						tr += '<td><a href="http://localhost:8080/'+data.path+'" target="_blank" class="btn btn-info btn-xs">View Document</a></td>';
						tr += '<td>'+added_by+'</td>';
						tr += '<td>'+added_date+'</td>';
						var a = '<a href="javascript:void(0);" title="Click To Delete" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 rmvetd" data-row="1" data-urlm="'+data.last_id+'" data-urln="'+data.NameID+'"><span class="fa fa-trash-o" aria-hidden="true"></span>  </a>';
						tr += '<td>'+a+'</td></tr>';
						$('#table_em tbody tr:first').after(tr);
						}
					}else{
					  $('#error-message').html(data.msg);
				  }
			 },
		});
	}else{
		alert('Please fill all the mandatory fields.');
	}
 });
 
 
 $(document).on('click','#emp_address_save',function(e){
     e.preventDefault();
     
     $('.emergency_validate').removeClass('invalid');
     if (!emergencyValidateForm()) return false;
     
     var formname='';
     formname=$("#addemployeedata");
     var formData = new FormData($('#addemployeedata')[0]);
     formData.append("submit","address");
     $.ajax({
            type:"POST",
            dataType:'JSON',
            url:formname.attr("action"),
            data: formData,
			processData: false,
			contentType: false,
            success: function(response){
                alert(response.msg);
                $('#dragable_modal').modal('toggle');
            }
        });
       
 })
 
  $(document).on('click','.save_emp_data',function(e){
        e.preventDefault();
        
         $('.emergency_validate').removeClass('invalid');
         if (!emergencyValidateForm()) return false;
         
         var formname='';
         formname=$("#addemployeedata");
         var formData = new FormData($('#addemployeedata')[0]);
         formData.append("submit","name");
         $.ajax({
                type:"POST",
                dataType:'JSON',
                url:formname.attr("action"),
                data: formData,
    			processData: false,
    			contentType: false,
                success: function(response){
                    alert(response.msg);
                    $('#dragable_modal').modal('toggle');
                }
            });
        
   })
   
  
  $(document).on('click','.scholor_close',function(){
      $('#xmyModal2').modal('hide');
  })
  
  $(document).on('click','.close_modal_button',function(){
      $('#xmyModal2').modal('hide');
  })

</script>
<script type="text/javascript">

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

function getSelectionStart(o) {
	if (o.createTextRange) {
		var r = document.selection.createRange().duplicate()
		r.moveEnd('character', o.value.length)
		if (r.text == '') return o.value.length
		return o.value.lastIndexOf(r.text)
	} else return o.selectionStart
}
</script>
<script type="text/javascript">
 $(document).on("click", ".rmvetd", function() { 
    	var anim = this.getAttribute("data-urlm"); 
		var anin = this.getAttribute("data-urln"); 
		var row = this.getAttribute("data-row");
		var current = $(this); 
		if(confirm('Are you sure, Want to Delet this record?')){ 
			loading(); 
			$.ajax({ 
				type: "POST", 
				url: "http://localhost:8080/" + "admin/Form/delemploymentrecord",  
				data: {clogid: anim,NameID: anin}, 
				success: function(res){ 
					//alert(res); 
					//console.log(res); 
					$('#overlay').remove(); 
					if(res != 'OK' || res.length <= 0 || res == null){ 
						alert('Something went wrong'); 
					}else{						
						alert('Deleted Successfully');
						//$('#TextBoxDivCL'+row).remove();
						current.closest("tr").remove();
					} 
				} 
			}); 

		} 
	});  
</script>


<script>
$(document).on('change', '.date-checks', function(){
	var current = $(this).val();
	if(current != ''){
		$(this).closest('tr').find('.date-checks').not(this).attr('disabled', true);
	}else{
		$(this).closest('tr').find('.date-checks').attr('disabled', false);
	}
	
});

$(document).on('click', '.edit-studentrecord', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivCL'+row;

	$(selector+' textarea, '+selector+' span.show, '+selector+' span.show, '+selector+' a.edit-studentrecord').removeClass('show').addClass('hide');
	$('#contact_note'+row+', '+selector+' input, '+selector+' select, '+selector+' a.save-studentrecord, '+selector+' a.cancel-studentrecord').removeClass('hide').addClass('show');
	$('#contact_note'+row).removeAttr('readonly', true);
	
}); 

$(document).on('click', '.cancel-studentrecord', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivCL'+row;
	
	$(selector+' input, '+selector+' select, '+selector+' a.save-studentrecord, '+selector+' a.cancel-studentrecord').removeClass('show').addClass('hide');
	$(selector+' span.hide, '+selector+' span.hide, '+selector+' a.edit-studentrecord').removeClass('hide').addClass('show');
	$('#contact_note'+row).attr('readonly', true);

}); 
</script>

<script type="text/javascript">
 $(document).on("click", ".add-rec", function() 
 {
	//var contacttype_list = JSON.parse('');
	var edit_user = 'IT Helpdesk';
	var NameID_st=$('#NameID_st').val();
	
	var id_st=$('#id_st'+id).val();
 
	var attachment_name= $('#attachment_name_st').val();
	var upload_attachment = $('#upload_attachment').val();
	if(attachment_name != '' && upload_attachment != ''){
		loading();
	var added_by = $('#added_by_st').val();
	var added_date = $('#added_date_st').val();
    var formData = new FormData($('#attachmentuploads')[0]);
	formData.append('csrf_token', '271dcfee4f1f3de8044f1f667bc664d4');
	 formData.append('NameID_st', NameID_st);
	 formData.append('attachment_name_st', attachment_name);
	 formData.append('added_by', added_by);
	 formData.append('added_date', added_date);
	 formData.append('upload_attachment', $('input[type=file]')[0].files[0]); 
	 
     //formData.append("csrf_token", "271dcfee4f1f3de8044f1f667bc664d4");
	$.ajax({
			type: "POST",
			url: '<?= base_url('admin/Form/submitstudentrecord') ?>',
			data: formData,
			dataType: "html",
			processData: false,
			contentType: false,
			
			success: function(data){
				$('#overlay').remove(); 
				data = JSON.parse(data);
				//console.log('msg'+data.msg);
				if(data.msg =='INSERTED'){
					var tr = '';
					if(data.path != '') {
						alert('Record saved.');						
						$('#attachmentuploads')[0].reset();
						//$(':text:not("[readonly],[disabled]")').val('');
						$(':text:not("[readonly]")').val('');
						console.log(formData);
						tr += '<tr><td style="text-align:left;">'+attachment_name+'</td>';
						tr += '<td><a href="http://localhost:8080/'+data.path+'" target="_blank" class="btn btn-info btn-xs">View Document</a></td>';
						tr += '<td>'+added_by+'</td>';
						tr += '<td>'+added_date+'</td>';
						var a = '<a href="javascript:void(0);" title="Click To Delete" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 rmvstd" data-row="1" data-urlm="'+data.last_id+'" data-urln="'+data.NameID+'"><span class="fa fa-trash-o" aria-hidden="true"></span>  </a>';
						tr += '<td>'+a+'</td></tr>';
						$('#table_st tbody tr:first').after(tr);
						
						//$('#clogid'+id).val(data.last_id);
						//$('.tbl-body-studentrecord').append(new_row);	
					}
					//console.log(tr);
				  }else{
					  //alert(data.msg);
					  $('#error-message').html(data.msg);
				  }
			 },
		});
	}else{
		alert('Please fill all the mandatory fields.');
	}
 });

</script>
<script type="text/javascript">

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

function getSelectionStart(o) {
	if (o.createTextRange) {
		var r = document.selection.createRange().duplicate()
		r.moveEnd('character', o.value.length)
		if (r.text == '') return o.value.length
		return o.value.lastIndexOf(r.text)
	} else return o.selectionStart
}

</script>
<script type="text/javascript">
//function validatePaymentForm(id){
/*$(document).on('click', '.add-studentrecord,.save-studentrecord', function(){
	var id = this.id.replace( /^\D+/g, '');
	
	var received_name= $('#attachment_name'+id).val();
	
	if(received_name==""){
		alert("Enter Attachment Name");
		$('#attachment_name'+id).focus();
		return false;
	}
	var upload_attachment=$('#upload_attachment'+id).val();
	if(upload_attachment==""){
		alert("upload Attachment");
		$('#upload_attachment'+id).focus();
		return false;
	}
	 else{
		studentrecord(id);
	 }
});*/

 $(document).on("click", ".rmvstd", function() { 
    	var anim = this.getAttribute("data-urlm"); 
		var anin = this.getAttribute("data-urln"); 
		var row = this.getAttribute("data-row");
		var current = $(this); 

		if(confirm('Are you sure, Want to Delet this record?')){ 
			loading(); 
			$.ajax({ 
				type: "POST", 
				url: "http://localhost:8080/" + "admin/Form/delstudentrecord",  
				data: {clogid: anim,NameID: anin}, 
				success: function(res){ 
					//alert(res); 
					//console.log(res); 
					$('#overlay').remove(); 
					if(res != 'OK' || res.length <= 0 || res == null){ 
						alert('Something went wrong'); 
					}else{						
						alert('Deleted Successfully');
						//$('#TextBoxDivCL'+row).remove();
						current.closest("tr").remove();
					} 
				} 
			}); 

		} 
	});  
	
	
	
	
	
	
	
	
	
	
	
	
	// By PRabhat 16-07-2021
/*	$( document ).ready(function() {
    
		var user_email = "ithelpdesk@future.edu";
		var user_name= " ";
		
			$.ajax({ 
				type: "POST", 
				dataType:'html',
				url: "https://staging.apps.future.edu/" + "goole_api/shared_google-drive.php",  
				data: {NameID: "",email:user_email,user_name:user_name}, 
				success: function(res){ 
					$('.google-drive').html(res);
				
				} 
			}); 
			
   
  });*/
	// End Prabhat 16-07-2021
	
	
	
	
	  $(document).on('click','.submit_form',function(){
        var current_folder = $('#current_folder_id').val();
        
        var fd = new FormData();
        var files = $('.professional_document')[0].files;
        var filename = files[0].name;
         fd.append('file',files[0]);
         fd.append('current_folder',current_folder);
         
          $.ajax({
              url:'<?= base_url('goole_api/submit.php') ?>',
              type: 'post',
              data: fd,
              contentType: false,
			  dataType: 'json',
              processData: false,
              success: function(response){
                  
				  alert(response.msg);
				  
				 
				  document.getElementById("professional_document").value = "";
				  
				   var rel_id = current_folder;
                   var rel_name = '';
                   var user_email = "ithelpdesk@future.edu";

        


                     $.ajax(
                            {
                                type:"post",
                                url: "<?= base_url('goole_api/sub_folder.php') ?>",
                                dataType: "html",
                                data:{ rel_id:rel_id,user_email:user_email},
                                success:function(response)
                                {
                                    $('.result').html(response);
                                }
                               
                            }
                        );
				  
				  
              },
           });
    })

	
    
 $(document).on('keyup','#search_drive_data',function(){
	    var folder_name = $(this).val();
	    var rel_id = $('#current_folder_id').val();
        var user_email = ""; 
        
        if(folder_name != '')
        {
             $.ajax( 
                {
                    type:"post", 
                    url: "<?= base_url('goole_api/search_google_data.php') ?>",
                    dataType: "html",
                    data:{ rel_id:rel_id,user_email:user_email,folder_name:folder_name},
                    success:function(response)
                    {
                        $('.result').html(response);
                         var crum_text = $('#crum').html();
                            var new_crum =  crum_text+" /<span class='current_path' rel_id='"+rel_id+"' rel_name='"+rel_name+"'>"+rel_name+"</span>";

                            $('#crum').html(new_crum);

                    }
                   
                }
            );
        }
        else
        {
            
            
            var user_email = "ithelpdesk@future.edu";
		    var user_name= " ";
		
			$.ajax({ 
				type: "POST", 
				dataType:'html',
				url: "http://localhost:8080/" + "goole_api/shared_google-drive.php",  
				data: {NameID: "",email:user_email,user_name:user_name}, 
				success: function(res){ 
					$('.google-drive').html(res);
				
				} 
			}); 
            
        }
        
	    
	})


	
	
	
	
</script>


<script>
$(document).on('change', '.date-checks', function(){
	var current = $(this).val();
	if(current != ''){
		$(this).closest('tr').find('.date-checks').not(this).attr('disabled', true);
	}else{
		$(this).closest('tr').find('.date-checks').attr('disabled', false);
	}
	
});

$(document).on('click', '.edit-contactlog', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivCL'+row;

	$(selector+' textarea, '+selector+' span.show, '+selector+' span.show, '+selector+' a.edit-contactlog').removeClass('show').addClass('hide');
	$('#contact_note'+row+', '+selector+' input, '+selector+' select, '+selector+' a.save-contactlog, '+selector+' a.cancel-contactlog').removeClass('hide').addClass('show');
	$('#contact_note'+row).removeAttr('readonly', true);
	
}); 

$(document).on('click', '.cancel-contactlog', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivCL'+row;
	
	$(selector+' input, '+selector+' select, '+selector+' a.save-contactlog, '+selector+' a.cancel-contactlog').removeClass('show').addClass('hide');
	$(selector+' span.hide, '+selector+' span.hide, '+selector+' a.edit-contactlog').removeClass('hide').addClass('show');
	$('#contact_note'+row).attr('readonly', true);

}); 
</script>

<script type="text/javascript">
function contactlog(id)
 {
	  contacttype_list = JSON.parse('[{"cid":"1","ContactType":"Phone Call","Active":"1"},{"cid":"2","ContactType":"Letter","Active":"1"},{"cid":"3","ContactType":"Emailed","Active":"1"},{"cid":"4","ContactType":"Development","Active":"1"},{"cid":"5","ContactType":"Package","Active":"1"},{"cid":"6","ContactType":"Publication","Active":"1"},{"cid":"7","ContactType":"Meeting ","Active":"1"}]');
	  var edit_user = 'IT Helpdesk';
	  clogid=$('#clogid'+id).val();
	  NameID=$('#NameID'+id).val();
	  contact_date= $('#contact_date'+id).val();
	  login_user=$('#login_user').val();
	  contact_type = $('#contact_type'+id).val();
	  if(contact_type=='Select'){
		contact_type_text='';  
	  }else{
		contact_type_text = $('#contact_type'+id+' option:selected').text();
	  }
	 contact_note=$('#contact_note'+id).val();
	  next_cl_id=parseInt(id)+1;
	  contacttype_html = '<select class="form-control contact_type" id="contact_type'+next_cl_id+'" name="contact_type['+next_cl_id+']"><option value="">Select</option>';
	 $.each(contacttype_list, function (key, val) {
		contacttype_html += '<option value="'+val.cid+'">'+val.ContactType+'</option>';
    }); 
	var new_row = '<tr id="TextBoxDivCL'+next_cl_id+'"><td><input type="hidden" id="count7" value="'+next_cl_id+'"><input type="hidden" name="NameID'+next_cl_id+'" id="NameID'+next_cl_id+'" value="'+NameID+'"><input type="hidden" id="clogid'+next_cl_id+'" name="clogid['+next_cl_id+']"><span class="hide" style="text-align:left;"></span><input class="form-control datepicker contact_date" id="contact_date'+next_cl_id+'" name="contact_date['+next_cl_id+']" type="text"></td><td><span class="hide"></span>'+contacttype_html+'</td><td><textarea rows="1" class="form-control hide" readonly></textarea><textarea name="contact_note['+next_cl_id+']" id="contact_note'+next_cl_id+'" class="form-control contact_note" rows="1"></textarea></td><td><span class="hide"></span><input type="text" name="login_user['+next_cl_id+']" id="login_user'+next_cl_id+'" class="form-control login_user" value="'+edit_user+'"></td></td><td><a href="javascript:void(0)" id="add-contactlog'+next_cl_id+'" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-contactlog"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a><a href="javascript:void(0)" id="save-contactlog'+next_cl_id+'" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-contactlog hide pull-left save'+next_cl_id+'" data-id="'+NameID+'" data-row="'+NameID+'"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a><a href="javascript:void(0)"  id="cancel-contactlog'+next_cl_id+'" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-contactlog hide pull-left"  data-row="'+next_cl_id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span><strong>Cancel</strong></span> </a><a href="javascript:void(0)" id="edit-contactlog'+next_cl_id+'"class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-contactlog hide pull-left" data-id="'+next_cl_id+'" data-row="'+next_cl_id+'" style="text-align:center;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td></tr>';
	$.ajax({
		type: "POST",
		url: '<?= base_url('admin/Form/submitContactLog') ?>',
		data: {'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'clogid':clogid,'NameID':NameID,'contact_date':contact_date,'contact_type':contact_type,'contact_note':contact_note},
		dataType: "html",
		success: function(data){
		data = JSON.parse(data);
		alert(data.msg);
		if(data.msg !='Record Already Exist or saved'){
			$('#contact_date'+id).prev().html(contact_date).addClass('show').removeClass('hide');
			$('#contact_type'+id).prev().html(contact_type_text).addClass('show').removeClass('hide');
			$('#contact_note'+id).prev().html(contact_note).addClass('show').removeClass('hide');
			$('#login_user'+id).prev().html(edit_user).addClass('show').removeClass('hide');
			$('#contact_date'+id).addClass('hide').removeClass('show');
			$('#contact_type'+id).addClass('hide').removeClass('show');
			$('#contact_note'+id).addClass('hide').removeClass('show');
			$('#login_user'+id).addClass('hide').removeClass('show');
			$('#save-contactlog'+id).addClass('hide').removeClass('show');
			$('#add-contactlog'+id).addClass('hide').removeClass('show');
			$('#edit-contactlog'+id).addClass('show').removeClass('hide');
			$('#cancel-contactlog'+id).addClass('hide').removeClass('show');
			if(data.last_id != '') {
				$('#clogid'+id).val(data.last_id);
				$('.tbl-body-contactlog').append(new_row);	
		    }
		  }
		 },
		});
 }

</script>
<script type="text/javascript">

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

function getSelectionStart(o) {
	if (o.createTextRange) {
		var r = document.selection.createRange().duplicate()
		r.moveEnd('character', o.value.length)
		if (r.text == '') return o.value.length
		return o.value.lastIndexOf(r.text)
	} else return o.selectionStart
}

</script>
<script type="text/javascript">
//function validatePaymentForm(id){
$(document).on('click', '.add-contactlog,.save-contactlog', function(){
	var id = this.id.replace( /^\D+/g, '');
	received_date= $('#contact_date'+id).val();
	if(received_date==""){
		alert("Enter Contact Date");
		$('#contact_date'+id).focus();
		return false;
	}
	payment_type=$('#contact_note'+id).val();
	if(payment_type==""){
		alert("Contact Note Not Empty");
		$('#contact_note'+id).focus();
		return false;
	}
	 else{
		contactlog(id);
	 }
});

 $(document).on("click", ".rmvc", function() { 
    	var anim = this.getAttribute("data-urlm"); 
		var anin = this.getAttribute("data-urln"); 
		var row = this.getAttribute("data-row");
		var current = this; 

		if(confirm('Are you sure, Want to Delet this record?')){ 
			loading(); 
			$.ajax({ 
				type: "POST", 
				url: "http://localhost:8080/" + "admin/Form/delContactLog",  
				data: {clogid: anim,NameID: anin}, 
				success: function(res){ 
					//alert(res); 
					console.log(res); 
					$('#overlay').remove(); 
					if(res != 'OK' || res.length <= 0 || res == null){ 
					alert('Something went wrong'); 
					}else{
						
					alert('Deleted Successfully');
					$('#TextBoxDivCL'+row).remove();
					
					} 
				} 
			}); 
		} 
	});  
</script>


<script>
$(document).on('change', '.date-checks', function(){
	var current = $(this).val();
	if(current != ''){
		$(this).closest('tr').find('.date-checks').not(this).attr('disabled', true);
	}else{
		$(this).closest('tr').find('.date-checks').attr('disabled', false);
	}
});

$(document).on('click', '.edit-certificate', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivCS'+row;
	$(selector+' span.show, '+selector+' a.edit-certificate').removeClass('show').addClass('hide');
	$(selector+' input, '+selector+' select, '+selector+' textarea, '+selector+' a.save-certificate, '+selector+' a.cancel-certificate').removeClass('hide').addClass('show');
}); 

$(document).on('click', '.cancel-certificate', function(){
	
	var row = $(this).attr('data-row');

	var selector = '#TextBoxDivCS'+row;
	$(selector+' input, '+selector+' select, '+selector+' textarea, '+selector+' a.save-certificate, '+selector+' a.cancel-certificate').removeClass('show').addClass('hide');
	$(selector+' span.hide, '+selector+' a.edit-certificate').removeClass('hide').addClass('show');

}); 
</script>
<!-- get term value based on class selection -->
<script type="text/javascript"> 
	$(document).on("click", ".certificate_rmv", function() { 
     
		var ctID = this.getAttribute("data-urlc"); 
		
		var studentID = this.getAttribute("data-urls"); 
		
		var row = this.getAttribute("data-row_no");
		
		var current = this; 
		
		if(confirm('Are you sure, Want to Delet this record?')){ 
			loading(); 
			$.ajax({ 
				type: "POST", 
				url: "http://localhost:8080/" + "admin/Form/delCertificate",  
				data: {ctid: ctID,studentid: studentID}, 
				success: function(res){ 
					
					$('#overlay').remove(); 
					if(res != 'OK' || res.length <= 0 || res == null){ 
					alert('Something went wrong'); 
					}else{
					alert('Deleted Successfully');
					$('#TextBoxDivCS'+row).remove();
					//location.reload(); 
					} 
				} 
			}); 

		} 
	});   
		 function loading() { 
	// add the overlay with loading image to the page 
	var over = '<div id="overlay">' +
	'<p>Please Wait...</p></div>'; 
	$(over).appendTo('body'); 
	} 

	</script>

<!-- insert transcript data -->
<script type="text/javascript">
 function certificate(id){
	 
     certificate_list = JSON.parse('[{"certID":"1","cert_no":"CT-PSK 607"},{"certID":"2","cert_no":"CT-PSK 608"},{"certID":"3","cert_no":"CT 301"},{"certID":"4","cert_no":"CT 302A"},{"certID":"5","cert_no":"CT 303A"},{"certID":"6","cert_no":"CT 302B"},{"certID":"7","cert_no":"CT 304"},{"certID":"8","cert_no":"CT 305"},{"certID":"9","cert_no":"CT 301A"},{"certID":"10","cert_no":"CT 303B"},{"certID":"11","cert_no":"CT 305"},{"certID":"12","cert_no":"CT 302C"},{"certID":"13","cert_no":"CT 306"},{"certID":"14","cert_no":"CT ACC606"},{"certID":"15","cert_no":"CT ACC607"},{"certID":"16","cert_no":"CT SSC691A"},{"certID":"17","cert_no":"CT SSC691B"},{"certID":"18","cert_no":"CT 302D"},{"certID":"19","cert_no":"VVOLMGMT"},{"certID":"20","cert_no":"MapleWeb1"},{"certID":"21","cert_no":"MapleWeb2"},{"certID":"22","cert_no":"MapleWeb3"},{"certID":"23","cert_no":"MapleWeb4"},{"certID":"24","cert_no":"CT 302E"},{"certID":"25","cert_no":"CT 302F"},{"certID":"26","cert_no":"100"},{"certID":"27","cert_no":"100"}]');
	 grade_list = JSON.parse('[{"ROWID":"1","Grade":"A","GradeValue":"4","Active":"1","Deletestatus":null},{"ROWID":"16","Grade":"A+","GradeValue":"4","Active":"1","Deletestatus":null},{"ROWID":"2","Grade":"A-","GradeValue":"3.8","Active":"1","Deletestatus":null},{"ROWID":"18","Grade":"AUDIT","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"3","Grade":"B","GradeValue":"3","Active":"1","Deletestatus":null},{"ROWID":"5","Grade":"B+","GradeValue":"3.3","Active":"1","Deletestatus":null},{"ROWID":"4","Grade":"B-","GradeValue":"2.8","Active":"1","Deletestatus":null},{"ROWID":"6","Grade":"C","GradeValue":"2","Active":"1","Deletestatus":null},{"ROWID":"8","Grade":"C+","GradeValue":"2.3","Active":"1","Deletestatus":null},{"ROWID":"7","Grade":"C-","GradeValue":"1.8","Active":"1","Deletestatus":null},{"ROWID":"9","Grade":"D","GradeValue":"1","Active":"1","Deletestatus":null},{"ROWID":"15","Grade":"D+","GradeValue":"1.3","Active":"1","Deletestatus":null},{"ROWID":"23","Grade":"ENR","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"25","Grade":"ENR P\/F","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"10","Grade":"F","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"11","Grade":"FAIL","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"12","Grade":"I","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"24","Grade":"N\/A","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"13","Grade":"PASS","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"17","Grade":"SCH","GradeValue":"0","Active":"1","Deletestatus":"NULL"},{"ROWID":"22","Grade":"T","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"19","Grade":"TA","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"20","Grade":"TB","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"21","Grade":"TC","GradeValue":"0","Active":"1","Deletestatus":null},{"ROWID":"14","Grade":"W","GradeValue":"0","Active":"1","Deletestatus":null}]');
	 ctID = $('#ctID'+id).val();
	 certID =$('#certID'+id).val();
	 certificate_no_text =$('#certID'+id+' option:selected').text();
	 student_id=$('#studentid'+id).val();
	 Certtificate_Name = $('#Certtificate_Name'+id).val();
	 Certtificate_text = $('#Certtificate_Name'+id).text();
	 course_date_val = $('#course_date_val'+id).text();
	 certificate_professor   = $('#certificate_professor'+id).text();
	 grad_undergrad_text = $('#grad_undergrad'+id).text();
	 diploma_text = $('#certificate_diploma'+id).text();
	 certificate_grade = $('#certificate_grade'+id).val();
	 completed = $('#completed'+id).val();
	 if(certificate_grade==""){
		certificate_grade_text="";
	 }else{
		certificate_grade_text = $('#certificate_grade'+id+' option:selected').text(); 
	 }
	 certificate_next_id = parseInt(id)+1;
	// class_html
	certificate_html = '<select class="form-control certID" id="certID'+certificate_next_id+'" name="certID['+certificate_next_id+']"><option value="">Select</option>';
	$.each(certificate_list, function (key, val) {
		certificate_html += '<option value="'+val.certID+'">'+val.cert_no+'</option>';
    });
	//grade_html
	grade_html = '<select class="form-control certificate_grade" id="certificate_grade'+certificate_next_id+'" name="certificate_grade['+certificate_next_id+']"><option value="">Select</option>';
	$.each(grade_list, function (key, val) {
		grade_html += '<option value="'+val.Grade+'">'+val.Grade+'</option>';
    });
    var complete_html = '<select class="form-control completed" id="completed'+certificate_next_id+'" name="completed['+certificate_next_id+']"><option value="">Select</option>';
    complete_html += '<option value="Yes">Yes</option>';
    complete_html += '<option value="No">No</option>';
     complete_html += '</select>';
	 new_row = '<tr id="TextBoxDivCS'+certificate_next_id+'"><td><input type="hidden" name="studentid'+certificate_next_id+'" id="studentid'+certificate_next_id+'" value="'+student_id+'"><input type="hidden" name="ctID'+certificate_next_id+'" id="ctID'+certificate_next_id+'" value=""><span class="hide"></span>'+certificate_html+'</td><td> <input type="hidden" id="count7" value="2"><span class="hide"></span><textarea name="Certtificate_Name['+certificate_next_id+']" id="Certtificate_Name'+certificate_next_id+'" class="form-control certificate_name textarea" readonly></textarea></td><td><span class="hide"></span><textarea name="course_date_val['+certificate_next_id+']" id="course_date_val'+certificate_next_id+'" class="form-control course_date_val textarea" readonly></textarea></td><td><span class="hide"></span><textarea name="certificate_professor['+certificate_next_id+']" id="certificate_professor'+certificate_next_id+'" class="form-control certificate_professor textarea" readonly></textarea></td><td><span class="hide"></span><textarea name="grad_undergrad['+certificate_next_id+']" id="grad_undergrad'+certificate_next_id+'" class="form-control grad_undergrad" readonly></textarea></td><td><span class="hide"></span><textarea name="certificate_diploma['+certificate_next_id+']" id="certificate_diploma'+certificate_next_id+'" class="form-control textarea certificate_diploma" readonly></textarea></td><td><span class="hide"></span>'+grade_html+'</td><td><span class="hide"></span>'+complete_html+'</td><td><a href="javascript:void(0)" id="edit-certificate'+certificate_next_id+'" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-certificate hide pull-left" data-id="'+student_id+'" data-row="'+certificate_next_id+'" style="text-align:center;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><span><strong></strong></span></a><a href="javascript:void(0)" id="add-certificate'+certificate_next_id+'"  class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-certificate"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span><strong></strong></span></a><a href="javascript:void(0)" id="save-certificate'+certificate_next_id+'" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-certificate hide pull-left" data-id="'+student_id+'" data-row="'+certificate_next_id+'"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span><strong></strong></span></a><a href="javascript:void(0)" id="cancel-certificate'+certificate_next_id+'"  class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-certificate hide pull-left" data-id="'+student_id+'" data-row="'+certificate_next_id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span><strong></strong></span></a></td></tr>';
	 $.ajax({
			type: "POST",
			url: '<?= base_url('admin/Form/submitCertificate') ?>',
			data: {'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'ctID':ctID,'student_id':student_id,'certID':certID,'grade':certificate_grade,'completed':completed},
			dataType: "html",
			success: function(data){
			data = JSON.parse(data);
			alert(data.msg);
			if(data.msg !='Record Already Exist or saved'){
			    $('#certID'+id).prev().html(certificate_no_text).addClass('show').removeClass('hide');
				$('#Certtificate_Name'+id).prev().html(Certtificate_text).addClass('show').removeClass('hide');
				$('#course_date_val'+id).prev().html(course_date_val).addClass('show').removeClass('hide');
				$('#certificate_professor'+id).prev().html(certificate_professor).addClass('show').removeClass('hide');
				$('#grad_undergrad'+id).prev().html(grad_undergrad_text).addClass('show').removeClass('hide');				
				$('#certificate_diploma'+id).prev().html(diploma_text).addClass('show').removeClass('hide');
				$('#certificate_grade'+id).prev().html(certificate_grade_text).addClass('show').removeClass('hide');
				
				$('#completed'+id).prev().html(completed).addClass('show').removeClass('hide');
				
				$('#certID'+id).addClass('hide').removeClass('show');
				$('#Certtificate_Name'+id).addClass('hide').removeClass('show');
				$('#course_date_val'+id).addClass('hide').removeClass('show');
				$('#certificate_professor'+id).addClass('hide').removeClass('show');
				$('#grad_undergrad'+id).addClass('hide').removeClass('show');
				$('#certificate_diploma'+id).addClass('hide').removeClass('show');
				$('#certificate_grade'+id).addClass('hide').removeClass('show');
				$('#completed'+id).addClass('hide').removeClass('show');
				$('#save-certificate'+id).addClass('hide').removeClass('show');
				$('#add-certificate'+id).addClass('hide').removeClass('show');
				$('#edit-certificate'+id).addClass('show').removeClass('hide');
				$('#cancel-certificate'+id).addClass('hide').removeClass('show');
				if(data.last_id != '') {
					 $('#ctID'+id).val(data.last_id);
					
					 $('.tbl-body-certificate').append(new_row);	
				}
			}
			},
		});
	
 }
</script>

<script type="text/javascript">
$(document).on('click', '.add-certificate,.save-certificate', function(){
	var id = this.id.replace( /^\D+/g, '');
	var certificate_no=$('#certID'+id).val();
	var Certtificate_Name =$('#Certtificate_Name'+id).val();
	var course_dates = $('#course_dates'+id).val();
	var certificate_professor = $('#certificate_professor'+id).val();
	var grad_undergrad = $('#grad_undergrad'+id).val();
	var diploma = $('#certificate_diploma'+id).val();
	var certificate_grade = $('#certificate_grade'+id).val();
	var completed = $('#completed'+id).val();
	if(certificate_no==""){
		alert('Certificate No Not Empty!');
		return false;
	}
	if(Certtificate_Name==""){
		alert('Certtificate Name Not Empty !');
		return false;
	}
	if(course_dates==""){
		alert('Course Date Not Empty !');
		return false;
	}
	if(certificate_professor==""){
		alert('Professor Not Empty !');
		return false;
	}
	if(grad_undergrad==""){
		alert('Grad/Undergrad Not Empty !');
		return false;
	}
	if(diploma==""){
		alert('Diploma Not Empty !');
		return false;
	}
	if(completed =="")
	{
	    alert("Completed Not Empty!");
	    return false;
	}
	else{
		certificate(id);
	}
	
});

</script>

<script type="">
$(document).on('change', '.certID', function(){
	var ev = $(this);
	var current = $(this).val();
	if(current != ''){
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getCertificate') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'ctID':current},
   		success:function(result){
		data = JSON.parse(result);
		console.log(result);
		$(ev).closest('tr').find('.certificate_name').html(data.CertName);
		$(ev).closest('tr').find('.course_date_val').html(data.course_dates);
		
		$(ev).closest('tr').find('.certificate_professor').html(data.Professor);
	    (ev).closest('tr').find('.grad_undergrad').html(data.grad_undergrad);
		$(ev).closest('tr').find('.certificate_diploma').html(data.diploma);
		},
        });
	}
});

</script>


<script>
$(document).on('change', '.date-checks', function(){
	var current = $(this).val();
	if(current != ''){
		$(this).closest('tr').find('.date-checks').not(this).attr('disabled', true);
	}else{
		$(this).closest('tr').find('.date-checks').attr('disabled', false);
	}
});

$(document).on('click', '.edit-adtranscript', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivAD'+row;
	$(selector+' span.show, '+selector+' a.edit-adtranscript').removeClass('show').addClass('hide');
	$(selector+' input, '+selector+' select, '+selector+' textarea, '+selector+' a.save-adtranscript, '+selector+' a.cancel-adtranscript').removeClass('hide').addClass('show');
}); 

$(document).on('click', '.cancel-adtranscript', function(){
	
	var row = $(this).attr('data-row');

	var selector = '#TextBoxDivAD'+row;
	$(selector+' input, '+selector+' select, '+selector+' textarea, '+selector+' a.save-adtranscript, '+selector+' a.cancel-adtranscript').removeClass('show').addClass('hide');
	$(selector+' span.hide, '+selector+' a.edit-adtranscript').removeClass('hide').addClass('show');

}); 
</script>
<!-- get term value based on class selection -->
<script type="text/javascript"> 
	$(document).on("click", ".rmv1", function() { 
     
		var anim = this.getAttribute("data-urlm"); 
		var anin = this.getAttribute("data-urln"); 
		var row = this.getAttribute("data-row");
		var current = this; 

		if(confirm('Are you sure, Want to Delet this record?')){ 
			loading(); 
			$.ajax({ 
				type: "POST", 
				url: "http://localhost:8080/" + "admin/Form/delAdjunctCourse",  
				data: {toBeChange: anim,studentid: anin}, 
				success: function(res){ 
					//alert(res); 
					console.log(res); 
					$('#overlay').remove(); 
					if(res != 'OK' || res.length <= 0 || res == null){ 
					alert('Something went wrong'); 
					}else{
						
					alert('Deleted Successfully');
					$('#TextBoxDivAD'+row).remove();
					
					//location.reload(); 
					} 
				} 
			}); 

		} 
	});   
		 function loading() { 
	// add the overlay with loading image to the page 
	var over = '<div id="overlay">' +
	'<p>Please Wait...</p></div>'; 
	$(over).appendTo('body'); 
	} 

	</script>

<script type="text/javascript">
/*
$(document).on('change', '.studentClass', function(){
	var ev = $(this);
	var current = $(this).val();
	
	if(current != ''){
		$('.term').removeAttr("disabled");
		$.ajax({
   		type: "POST",
   		url: "https://staging.apps.future.edu/admin/Form/getTerm",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'classname':current},
   		success:function(result){
		$(ev).closest('tr').find('.term').html(result);	
		
    	},
        });
	}
});

*/

// get semester dropdown

$(document).on('change', '.adjunctClass', function(){
	var ev = $(this);
	var current = $(this).val();
	
	
	
	if(current != ''){
		$('.adterm').removeAttr("disabled");
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getSemester') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'classname':current},
   		success:function(result){
		$(ev).closest('tr').find('.adsemester').html(result);	
		
    	},
        });
	}
});


// get term by Semester

$(document).on('change', '.adsemester', function(){
	var ev = $(this);
	var current = $(this).val();
	
	var classname =$(ev).closest('tr').find('.adjunctClass').val();
	
	if(current != ''){
		
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getSemesterTerm') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'semester':current,'classname':classname},
   		success:function(result){
		$(ev).closest('tr').find('.adterm').html(result);	
		
    	},
        });
	}
});


// get course dropdown value

$(document).on('change', '.adterm', function(){
	var ev = $(this);
	var current = $(this).val();
	var classname =$(ev).closest('tr').find('.adjunctClass').val();
	if(current != ''){
		$('.adcourse').removeAttr("disabled");
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getCourseName') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'termname':current,'classname':classname},
   		success:function(result){
		$(ev).closest('tr').find('.adcourse').html(result);	
	 	},
        });
	}
});

// get course title by course name

$(document).on('change', '.adcourse', function(){
	var ev = $(this);
	var current = $(this).val();
	var classname =$(ev).closest('tr').find('.adjunctClass').val();
	if(current != ''){
		//$('.adcourse').removeAttr("disabled");
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getCourseTitleName') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'coursename':current,'classname':classname},
   		success:function(result){
		$(ev).closest('tr').find('.title').html(result);	
	 	},
        });
	}
});

</script>
<!-- insert transcript data -->
<script type="text/javascript">
 function adjunctCourse(id){
     adtranscriptclass_list = JSON.parse('[{"ROWID":"17","Class":"2025","Active":"1","Deletestatus":null},{"ROWID":"16","Class":"2024","Active":"1","Deletestatus":null},{"ROWID":"15","Class":"2023","Active":"1","Deletestatus":null},{"ROWID":"13","Class":"2022","Active":"1","Deletestatus":null},{"ROWID":"12","Class":"2021","Active":"1","Deletestatus":null},{"ROWID":"21","Class":"2020","Active":"1","Deletestatus":null},{"ROWID":"10","Class":"2020","Active":"1","Deletestatus":null},{"ROWID":"9","Class":"2019","Active":"1","Deletestatus":null},{"ROWID":"11","Class":"2018","Active":"1","Deletestatus":null},{"ROWID":"8","Class":"2017","Active":"1","Deletestatus":null},{"ROWID":"7","Class":"2015","Active":"1","Deletestatus":null},{"ROWID":"6","Class":"2014","Active":"1","Deletestatus":null},{"ROWID":"5","Class":"2013","Active":"1","Deletestatus":null},{"ROWID":"4","Class":"2011","Active":"1","Deletestatus":null},{"ROWID":"20","Class":"2010","Active":"1","Deletestatus":null},{"ROWID":"3","Class":"2009","Active":"1","Deletestatus":null},{"ROWID":"19","Class":"2008","Active":"1","Deletestatus":null},{"ROWID":"2","Class":"2007","Active":"1","Deletestatus":null},{"ROWID":"1","Class":"2005","Active":"1","Deletestatus":null},{"ROWID":"14","Class":"0000","Active":"1","Deletestatus":null}]');
	 
	 adjunct_id = $('#adjunct_id'+id).val();
	 student_id=$('#studentid'+id).val();
	 classname = $('#adtranscriptclass'+id).val();
	 semester  = $('#adsemester'+id).val();
	 term      = $('#adterm'+id).val();
	 term_text = $('#adterm'+id+' option:selected').text();
	 course    = $('#adcourse'+id).val();
	 course_text= $('#adcourse'+id+' option:selected').text();
	 compensation = $('#compensation'+id).val();
	 notes = $('#notes'+id).val();
	 title = $('#title'+id).val();
	 ad_next_id = parseInt(id)+1;
	
	// class_html
	class_html = '<select class="form-control adjunctClass" id="adtranscriptclass'+ad_next_id+'" name="adtranscriptclass['+ad_next_id+']"><option value="">Select</option>';
	$.each(adtranscriptclass_list, function (key, val) {
		class_html += '<option value="'+val.Class+'">'+val.Class+'</option>';
    });
	 new_row = '<tr id="TextBoxDivAD'+ad_next_id+'"><td><input type="hidden" name="studentid'+ad_next_id+'" id="studentid'+ad_next_id+'" value="'+student_id+'"><input type="hidden" name="adjunct_id'+ad_next_id+'" id="adjunct_id'+ad_next_id+'" value=""><span class="hide"></span>'+class_html+'</td><td><span class="hide"></span><select name="adsemester['+ad_next_id+']" id="adsemester'+ad_next_id+'" class="form-control adsemester" required><option value="">select Semester</option></select></td><td> <input type="hidden" id="count7" value="2"><span class="hide"></span><select name="adterm['+ad_next_id+']" class="form-control adterm" id="adterm'+ad_next_id+'" disabled><option value="">Select Term</option></select></td><td><span class="hide"></span><select name="adcourse['+ad_next_id+']" class="form-control adcourse" id="adcourse'+ad_next_id+'" disabled><option value="">Select Course</option></select></td><td><span class="hide"></span><input type="text" name="compensation['+ad_next_id+']" id="compensation'+ad_next_id+'" class="form-control compensation num"></td><td><span class="hide"></span><select name="title['+ad_next_id+']" id="title'+ad_next_id+'" class="form-control title"> <option value="">Select Title</option></select></td><td><span class="hide"></span><textarea name="notes['+ad_next_id+']" id="notes'+ad_next_id+'" class="form-control notes textarea" style="width:400px;" rows="1"></textarea></td><td><a href="javascript:void(0)" id="edit-adtranscript'+ad_next_id+'" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-adtranscript hide pull-left" data-id="'+student_id+'" data-row="'+ad_next_id+'" style="text-align:center;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><span><strong></strong></span></a><a href="javascript:void(0)" id="add-adtranscript'+ad_next_id+'"  class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-adtranscript"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span><strong></strong></span></a><a href="javascript:void(0)" id="save-adtranscript'+ad_next_id+'" onclick="validateAdTranscriptForm('+ad_next_id+', this)" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-adtranscript hide pull-left" data-id="'+student_id+'" data-row="'+ad_next_id+'"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span><strong></strong></span></a><a href="javascript:void(0)" id="cancel-adtranscript'+ad_next_id+'"  class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-adtranscript hide pull-left" data-id="'+student_id+'" data-row="'+ad_next_id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span><strong></strong></span></a></td></tr>';
	 $.ajax({
			type: "POST",
			url: '<?= base_url('admin/Form/submitAdjunctCourse') ?>',
			data: {'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'adjunct_id':adjunct_id,'student_id':student_id,'courseid':course,'compensation':compensation,'notes':notes,'title':title},
			dataType: "html",
			success: function(data){
			data = JSON.parse(data);
			alert(data.msg);
			if(data.msg !='Record Already Exist or saved'){
				$('#adtranscriptclass'+id).prev().html(classname).addClass('show').removeClass('hide');
				$('#adsemester'+id).prev().html(semester).addClass('show').removeClass('hide');
				$('#adterm'+id).prev().html(term_text).addClass('show').removeClass('hide');
				$('#adcourse'+id).prev().html(course_text).addClass('show').removeClass('hide');
				$('#compensation'+id).prev().html(compensation).addClass('show').removeClass('hide');
				$('#notes'+id).prev().html(notes).addClass('show').removeClass('hide');
				$('#title'+id).prev().html(title).addClass('show').removeClass('hide');
				
				
				$('#adtranscriptclass'+id).addClass('hide').removeClass('show');
				$('#adterm'+id).addClass('hide').removeClass('show');
				$('#adsemester'+id).addClass('hide').removeClass('show');
				$('#adcourse'+id).addClass('hide').removeClass('show');
				$('#compensation'+id).addClass('hide').removeClass('show');
				$('#notes'+id).addClass('hide').removeClass('show');
				$('#title'+id).addClass('hide').removeClass('show');
				$('#save-adtranscript'+id).addClass('hide').removeClass('show');
				$('#add-adtranscript'+id).addClass('hide').removeClass('show');
				$('#edit-adtranscript'+id).addClass('show').removeClass('hide');
				$('#cancel-adtranscript'+id).addClass('hide').removeClass('show');
				if(data.last_id != '') {
					 $('#adjunct_id'+id).val(data.last_id);
					 $('.tbl-body-adjunctcourse').append(new_row);	
				}
			}
			},
		});
	
 }
</script>

<script type="text/javascript">
$(document).on('click', '.add-adtranscript,.save-adtranscript', function(){
	var id = this.id.replace( /^\D+/g, '');
	var classname=$('#adtranscriptclass'+id).val();
	var term =$('#adterm'+id).val();
	var course = $('#adcourse'+id).val();
	var semester = $('#adsemester'+id).val();
	var grade = $('#compensation'+id).val();
	if(classname==""){
		alert('Class Not Empty!');
		return false;
	}
	if(term==""){
		alert('session Not Empty !');
		return false;
	}
	if(course==""){
		alert('Course Not Empty !');
		return false;
	}
	if(semester==""){
		alert('Semester Not Empty !');
		return false;
	}
	else{
		adjunctCourse(id);
	}
	
});



</script>


<script>
$(document).on('change', '.date-checks', function(){
	var current = $(this).val();
	if(current != ''){
		$(this).closest('tr').find('.date-checks').not(this).attr('disabled', true);
	}else{
		$(this).closest('tr').find('.date-checks').attr('disabled', false);
	}
	
});

$(document).on('click', '.edit-passport', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivPT'+row;
	$(selector+' span.show, '+selector+' a.edit-passport').removeClass('show').addClass('hide');
	$(selector+' input, '+selector+' select, '+selector+' a.save-passport, '+selector+' a.cancel-passport').removeClass('hide').addClass('show');
}); 

$(document).on('click', '.cancel-passport', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivPT'+row;
	$(selector+' input, '+selector+' select, '+selector+' a.save-passport, '+selector+' a.cancel-passport').removeClass('show').addClass('hide');
	$(selector+' span.hide, '+selector+' a.edit-passport').removeClass('hide').addClass('show');
}); 
</script>

<script type="text/javascript">
 function passport(id){
	 
	var country_list = JSON.parse('[{"ROWID":"72","CountryID":"Ame","CountryName":"AM","Active":"1","Deletestatus":null},{"ROWID":"2","CountryID":"AST","CountryName":"Austraila","Active":"1","Deletestatus":null},{"ROWID":"3","CountryID":"AUS","CountryName":"Austria","Active":"1","Deletestatus":null},{"ROWID":"4","CountryID":"BAH","CountryName":"Bahrain","Active":"1","Deletestatus":null},{"ROWID":"5","CountryID":"BAN","CountryName":"Bangladesh","Active":"1","Deletestatus":null},{"ROWID":"6","CountryID":"BHU","CountryName":"Bhutan","Active":"1","Deletestatus":null},{"ROWID":"7","CountryID":"BOL","CountryName":"Bolivia","Active":"1","Deletestatus":null},{"ROWID":"8","CountryID":"BUR","CountryName":"Burundi","Active":"1","Deletestatus":null},{"ROWID":"9","CountryID":"CAM","CountryName":"Cambodia","Active":"1","Deletestatus":null},{"ROWID":"10","CountryID":"CAN","CountryName":"Canada","Active":"1","Deletestatus":null},{"ROWID":"11","CountryID":"CHI","CountryName":"China","Active":"1","Deletestatus":null},{"ROWID":"66","CountryID":"CI","CountryName":"Cote d Ivoire","Active":"1","Deletestatus":null},{"ROWID":"56","CountryID":"CMR","CountryName":"Cameroon","Active":"1","Deletestatus":null},{"ROWID":"12","CountryID":"CZE","CountryName":"Czech Republic","Active":"1","Deletestatus":null},{"ROWID":"13","CountryID":"DEN","CountryName":"Denmark","Active":"1","Deletestatus":null},{"ROWID":"14","CountryID":"EGY","CountryName":"Egypt","Active":"1","Deletestatus":null},{"ROWID":"15","CountryID":"ENG","CountryName":"England","Active":"1","Deletestatus":null},{"ROWID":"70","CountryID":"ES","CountryName":"El Salvador","Active":"1","Deletestatus":null},{"ROWID":"16","CountryID":"ETH","CountryName":"Ethiopia","Active":"1","Deletestatus":null},{"ROWID":"17","CountryID":"FRA","CountryName":"France","Active":"1","Deletestatus":null},{"ROWID":"18","CountryID":"GER","CountryName":"Germany","Active":"1","Deletestatus":null},{"ROWID":"19","CountryID":"GHA","CountryName":"Ghana","Active":"1","Deletestatus":null},{"ROWID":"20","CountryID":"GUY","CountryName":"Guyana","Active":"1","Deletestatus":null},{"ROWID":"21","CountryID":"HAI","CountryName":" Haiti","Active":"1","Deletestatus":null},{"ROWID":"22","CountryID":"HON","CountryName":"Hong Kong","Active":"1","Deletestatus":null},{"ROWID":"23","CountryID":"INA","CountryName":"India\/Arunachal Pradesh","Active":"1","Deletestatus":null},{"ROWID":"24","CountryID":"IND","CountryName":"India","Active":"1","Deletestatus":null},{"ROWID":"25","CountryID":"IRA","CountryName":"Iran","Active":"1","Deletestatus":null},{"ROWID":"67","CountryID":"IRE","CountryName":"Ireland","Active":"1","Deletestatus":null},{"ROWID":"69","CountryID":"JAM","CountryName":"Jamaica","Active":"1","Deletestatus":null},{"ROWID":"63","CountryID":"JAP","CountryName":"Japan","Active":"1","Deletestatus":null},{"ROWID":"26","CountryID":"KEN","CountryName":"Kenya","Active":"1","Deletestatus":null},{"ROWID":"55","CountryID":"LBR","CountryName":"Liberia","Active":"1","Deletestatus":null},{"ROWID":"27","CountryID":"LIB","CountryName":"Libya","Active":"1","Deletestatus":null},{"ROWID":"62","CountryID":"MA","CountryName":"Mali","Active":"1","Deletestatus":null},{"ROWID":"28","CountryID":"MAL","CountryName":"Malawi","Active":"1","Deletestatus":null},{"ROWID":"29","CountryID":"MON","CountryName":"Monaco","Active":"1","Deletestatus":null},{"ROWID":"64","CountryID":"MOR","CountryName":"Morocco","Active":"1","Deletestatus":null},{"ROWID":"30","CountryID":"MOZ","CountryName":"Mozambique","Active":"1","Deletestatus":null},{"ROWID":"31","CountryID":"NAM","CountryName":"NAMIBIA","Active":"1","Deletestatus":null},{"ROWID":"32","CountryID":"NEP","CountryName":"Nepal","Active":"1","Deletestatus":null},{"ROWID":"33","CountryID":"NET","CountryName":"Netherlands","Active":"1","Deletestatus":null},{"ROWID":"34","CountryID":"NIG","CountryName":"Nigeria","Active":"1","Deletestatus":null},{"ROWID":"35","CountryID":"NOR","CountryName":"Norway","Active":"1","Deletestatus":null},{"ROWID":"36","CountryID":"NZ","CountryName":"New Zealand","Active":"1","Deletestatus":null},{"ROWID":"57","CountryID":"PAK","CountryName":"Pakistan","Active":"1","Deletestatus":null},{"ROWID":"37","CountryID":"PER","CountryName":"Peru","Active":"1","Deletestatus":null},{"ROWID":"65","CountryID":"PNG","CountryName":"Papua New Guinea","Active":"1","Deletestatus":null},{"ROWID":"60","CountryID":"POL","CountryName":"Poland","Active":"1","Deletestatus":null},{"ROWID":"38","CountryID":"RWA","CountryName":"Rwanda","Active":"1","Deletestatus":null},{"ROWID":"68","CountryID":"SKO","CountryName":"South Korea","Active":"1","Deletestatus":null},{"ROWID":"39","CountryID":"SOM","CountryName":"Somalia","Active":"1","Deletestatus":null},{"ROWID":"71","CountryID":"SP","CountryName":"Spain","Active":"1","Deletestatus":null},{"ROWID":"58","CountryID":"SSU","CountryName":"South Sudan","Active":"1","Deletestatus":null},{"ROWID":"40","CountryID":"SUD","CountryName":"Sudan","Active":"1","Deletestatus":null},{"ROWID":"41","CountryID":"SWE","CountryName":"Sweden","Active":"1","Deletestatus":null},{"ROWID":"42","CountryID":"SWI","CountryName":"Switzerland","Active":"1","Deletestatus":null},{"ROWID":"43","CountryID":"TAN","CountryName":"Tanzania","Active":"1","Deletestatus":null},{"ROWID":"61","CountryID":"TH","CountryName":"Thailand","Active":"1","Deletestatus":null},{"ROWID":"44","CountryID":"TIB","CountryName":"Tibet","Active":"1","Deletestatus":null},{"ROWID":"59","CountryID":"TUN","CountryName":"Tunisia","Active":"1","Deletestatus":null},{"ROWID":"45","CountryID":"UAE","CountryName":"United Arab Emirates","Active":"1","Deletestatus":null},{"ROWID":"46","CountryID":"UGA","CountryName":"Uganda","Active":"1","Deletestatus":null},{"ROWID":"47","CountryID":"UK","CountryName":"United Kingdom","Active":"1","Deletestatus":null},{"ROWID":"48","CountryID":"UNK","CountryName":"Unknown","Active":"1","Deletestatus":null},{"ROWID":"49","CountryID":"URU","CountryName":"Uruguay","Active":"1","Deletestatus":null},{"ROWID":"50","CountryID":"USA","CountryName":"United States","Active":"1","Deletestatus":null},{"ROWID":"51","CountryID":"VIE","CountryName":"Vietnam","Active":"1","Deletestatus":null},{"ROWID":"52","CountryID":"ZAM","CountryName":"Zambia","Active":"1","Deletestatus":null}]');
	student_id=$('#studentid'+id).val();
	table=$('#table'+id).val();
	nameonpassport = $('#NameOnPassport'+id).val();
	birthdate  = $('#Birthdate'+id).val();
	passportnumber = $('#PassportNumber'+id).val();
	passportcountry = $('#PassportCountry'+id).val();
	passportcountry_text =$('#PassportCountry'+id+' option:selected').text();
	passportissued= $('#PassportIssued'+id).val();
	passportexpires = $('#PassportExpires'+id).val();
	passport_id =$('#last_id'+id).val();
	passport_next_id=parseInt(id)+1;
	passport_country_html = '<select class="form-control" id="PassportCountry'+passport_next_id+'" name="PassportCountry['+passport_next_id+']"><option value="">Select Country</option>';
	$.each(country_list, function (key, val) {
		passport_country_html += '<option value="'+val.CountryID+'">'+val.CountryName+'</option>';
    });
	add_new_row='<tr id="TextBoxDivPT'+passport_next_id+'"><td>'+passport_next_id+'</td><td><input type="hidden" name="last_id'+passport_next_id+'" id="last_id'+passport_next_id+'" value=""><input type="hidden" name="table'+passport_next_id+'" id="table'+passport_next_id+'" value="passport"> <input type="hidden" id="count7" value="2"><input type="hidden" name="studentid'+passport_next_id+'" id="studentid'+passport_next_id+'" value="'+student_id+'"><span class="hide"></span><input class="form-control" onkeypress="javascript:return ValidateAlphaNew(event)" id="NameOnPassport'+passport_next_id+'" name="NameOnPassport['+passport_next_id+']" type="text"></td><td><span class="hide"></span><input class="form-control datepickerbackward num passport_date date-checks" id="Birthdate'+passport_next_id+'" name="Birthdate['+passport_next_id+']" type="text" maxlength="10" readonly></td><td><span class="hide"></span><input class="form-control" id="PassportNumber'+passport_next_id+'" name="PassportNumber['+passport_next_id+']" type="text"></td><td><span class="hide"></span>'+passport_country_html+'</td><td><span class="hide"></span><input class="form-control datepickerbackward passport_date num" id="PassportIssued'+passport_next_id+'" name="PassportIssued['+passport_next_id+']" type="text" readonly></td><td><span class="hide"></span><input class="form-control datepickerforward passport_date num" id="PassportExpires'+passport_next_id+'" name="PassportExpires['+passport_next_id+']" type="text" readonly></td><td><a href="javascript:void(0)" id="edit-passport'+passport_next_id+'"class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-passport hide pull-left" data-id="'+student_id+'" data-row="'+passport_next_id+'" style="text-align:center;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><span><strong>Edit</strong></span></a><a href="javascript:void(0)" id="add-passport'+passport_next_id+'" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-passport"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span><strong>ADD</strong></span>   </a><a href="javascript:void(0)" id="save-passport'+passport_next_id+'" onclick="validatePassportForm('+passport_next_id+', this)" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-passport hide pull-left save'+passport_next_id+'" data-id="'+passport_next_id+'" data-row="'+passport_next_id+'"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span><strong>Save</strong></span></a><a href="javascript:void(0)"  id="cancel-passport'+passport_next_id+'" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-passport hide pull-left"  data-row="'+passport_next_id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span><strong>Cancel</strong></span></a></td></tr>';;
	$.ajax({
		type: "POST",
		url: '<?= base_url('admin/Form/submitpassport') ?>',
		data: {'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'student_id':student_id,'nameonpassport':nameonpassport,'birthdate':birthdate,'passportnumber':passportnumber,'passportcountry':passportcountry,'passportissued':passportissued,'passportexpires':passportexpires, 'table' : table,'passport_id':passport_id},
		dataType: "html",
		success: function(data){
			data = JSON.parse(data);
		    alert(data.msg);
			if(data.msg!='Record Already Exist or saved'){
				$('#NameOnPassport'+id).prev().html(nameonpassport).addClass('show').removeClass('hide');
				$('#Birthdate'+id).prev().html(birthdate).addClass('show').removeClass('hide');
				$('#PassportNumber'+id).prev().html(passportnumber).addClass('show').removeClass('hide');
				$('#PassportCountry'+id).prev().html(passportcountry_text).addClass('show').removeClass('hide');
				$('#PassportIssued'+id).prev().html(passportissued).addClass('show').removeClass('hide');
				$('#PassportExpires'+id).prev().html(passportexpires).addClass('show').removeClass('hide');
				$('#NameOnPassport'+id).addClass('hide').removeClass('show');
				$('#Birthdate'+id).addClass('hide').removeClass('show');
				$('#PassportNumber'+id).addClass('hide').removeClass('show');
				$('#PassportCountry'+id).addClass('hide').removeClass('show');
				$('#PassportIssued'+id).addClass('hide').removeClass('show');
				$('#PassportExpires'+id).addClass('hide').removeClass('show');
				$('#save-passport'+id).addClass('hide').removeClass('show');
				$('#add-passport'+id).addClass('hide').removeClass('show');
				$('#edit-passport'+id).addClass('show').removeClass('hide');
				$('#cancel-passport'+id).addClass('hide').removeClass('show');
			
				if(data.last_id != '') {
					$('#last_id'+id).val(data.last_id);
					$('.tbl-body-passport').append(add_new_row);	
				 }
			}
			  
			
			},
		});
 }
</script>

<script type="text/javascript">

$(document).on('click','.add-passport,.save-passport',function(){
	
	var id = this.id.replace( /^\D+/g, '');
	
	var NameOnPassport = $('#NameOnPassport'+id).val();
	var Birthdate      = $('#Birthdate'+id).val();
	var PassportNumber = $('#PassportNumber'+id).val();
	var PassportCountry = $('#PassportCountry'+id).val();
	var PassportIssued  = $('#PassportIssued'+id).val();
	var PassportExpires = $('#PassportExpires'+id).val();
	if(NameOnPassport==""){
		alert('Name on passport not empty !');
		return false;
	}
	if(Birthdate==""){
		alert('Birth date not empty !');
		return false;
	}
	if(PassportNumber==""){
		alert('Passport Number not empty !');
		return false;
	}
	if(PassportCountry==""){
		alert('Passport Country not empty !');
		return false;
	}
	if(PassportIssued==""){
		alert('Passport Issued not empty !');
		return false;
	}
	if(PassportExpires==""){
		alert('Passport Expires not empty !');
		return false;
	}
	else {
		passport(id);
	}
})
</script>
<script>
$(document).on("change",".passport_dates",function(){
	var current_record_date = $(this).val();
	if(current_record_date!=""){
		var final_date = current_record_date.split('/')[2];
		var year_count_digit = final_date.length;
	if(year_count_digit !=4){
			alert('Year should be 4 digit');
			$(this).val('');
	}
		
}
	
});
</script>

<script>
     $(document).on('click','.update_donar_data',function(){
        var refcount = ""; 
        refcount = parseInt(refcount)+1;
        var amount = $('#modal_amount').val();
        var pay_type = $('#pay_type').val();
       // $("#PaymentType")
       $('#Amount'+refcount).val(amount);
       $('#pay_type'+refcount).val(pay_type);
       $("#donar_confirm_box").modal("hide");
        
    })
</script>

<!-- End Prabhat 24-12-2020-->


	 
<script>



//By Prabhat 18-11-2020

$(document).on('keyup','#audit_rate',function(){
    var tuition = $('#course_tuition').val();
    
    tuition = parseInt(tuition);
    
    var sch = $('#scholar_tuition').val()
    var credit = $(this).val();
    

    
    var current_pecentage = (credit*100)/tuition;
    
    if(tuition < credit)
    {
        str = credit.slice(0, -1);
        $(this).val(str);
        alert("Credit Amount can not greater than Tuition Fees");
    }
    else
    {
        var current_scholor = (current_pecentage*sch)/100;
        $('#scholar_adjustment').val(current_scholor);
    }
    
})

$(document).on('keyup','#edit_audit_rate',function(){
    var tuition = $('#edit_course_tuition').val();
    
    tuition = parseInt(tuition);
    var sch = $('#edit_scholar_tuition').val()
    var credit = $(this).val();
    var current_pecentage = (credit*100)/tuition;
    
    if(tuition < credit)
    {
        str = credit.slice(0, -1);
        $(this).val(str);
        alert("Credit Amount can not greater than Tuition Fees");
    }
    else
    {
        var current_scholor = (current_pecentage*sch)/100;
        $('#edit_scholar_adjustment').val(current_scholor);
    }
    
})


$(document).on('change','.payment_course',function(){
    var course_id = $(this).val();
   var student_id = $('#employee_id').val();
    
    
    $.ajax
    ({
       		type: "POST",
       		dataType : "json",
       		url: "<?= base_url('admin/Form/get_course_tuition_by_student_id') ?>",
       		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', course_id,student_id},
       		success:function(result){
       		    $('#show_course_tuition').html("Course Tuition : "+result[0].total);
       		    
       		    $('#course_tuition').val(result[0].total);
       		    
       		    
       		    $.ajax({
        		type: "POST",
        		url: '<?= base_url('admin/Form/get_max_scholal') ?>',
        		data: {'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4','course_id':course_id,'student_id':student_id},
        		dataType: "html",
        		success: function(data){
        		    $('#show_course_scholar').html("Assign Scholarship : "+data); 
        		    $('#scholar_tuition').val(data);
        		}
        	})
       		    
       		    
       		    
       		    
    	     
        	},
     });
})



$(document).on('change','.edit_payment_course',function(){
    var course_id = $(this).val();
    var student_id = $('#employee_id').val();
    
    
    $.ajax
    ({
       		type: "POST",
       		dataType : "json",
       		url: "<?= base_url('admin/Form/get_course_tuition_by_student_id') ?>",
       		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', course_id,student_id},
       		success:function(result){
       		    $('#edit_show_course_tuition').html("Course Tuition : "+result[0].total);
       		    
       		    $('#edit_course_tuition').val(result[0].total);
       		    
       		    
       		    $.ajax({
        		type: "POST",
        		url: '<?= base_url('admin/Form/get_max_scholal') ?>',
        		data: {'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4','course_id':course_id,'student_id':student_id},
        		dataType: "html",
        		success: function(data){
        		    $('#edit_show_course_scholar').html("Assign Scholarship : "+data); 
        		    $('#edit_scholar_tuition').val(data);
        		}
        	})
       		    
       		    
       		    
       		    
    	     
        	},
     });
})


//End Prabhat 18-11-2020




// By Prabhat 05-11-2020
 $(document).on('click','.delete-donation',function(){
     var id= $(this).attr('rel_donation_id');
     var rel_id = $(this).attr('data-row');
     if(confirm('Are you sure, Want to Delet this record?')){ 
         
          $.ajax({
       		type: "POST",
       		url: "<?= base_url('admin/Form/delete_donation') ?>",
       		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'id':id},
       		success:function(result){
    	
    			if(result)
    			{
    			    $('#TextBoxDivDP'+rel_id).hide();
    			    alert("Record Delete Successfully");
    			    var str1 = window.location.href;
                    var n1 = str1.lastIndexOf('#');
                    if(n1 == -1)
                    {
                        current_url = window.location.href+"#tab3"; 
                    }
                    else
                    {
                        current_url = window.location.href; 
                    }
                      
                     win = window.open('','_self');
                     win.close();
	                window.open(current_url, "_blank"); 
    			}
    			else
    			{
    			    alert("Something Wrong");
    			}
    		
        	},
        });
         
     }
       
 })
// End Pranhat 05-11-2020
// By Prabhat 03-11-2020
$('#scholar_adjustment').on('keyup', function(e) {
    
    
    let tution  = document.getElementById('scholar_adjustment');
    if(isNaN(tution.value)) {
        alert("Only numbers are allowed");
        tution.value = "";
    } else {
        let decimalTution = parseFloat(tution.value);
        if(countDecimals(decimalTution) > 2) {
            var truncated = Math.floor(decimalTution * 100) / 100; // = 5.46
            tution.value = truncated;
        }
    }
    
 });
// By  Prabhat 26-10-2020

$('#audit_rate').on('keyup', function(e) {
    
    
    let tution  = document.getElementById('audit_rate');
    if(isNaN(tution.value)) {
        alert("Only numbers are allowed");
        tution.value = "";
    } else {
        let decimalTution = parseFloat(tution.value);
        if(countDecimals(decimalTution) > 2) {
            var truncated = Math.floor(decimalTution * 100) / 100; // = 5.46
            tution.value = truncated;
        }
    }
    
 });
 
 function countDecimals(value) {
    if(Math.floor(value) === value) return 0;
    return value.toString().split(".")[1].length || 0; 
    }


  $(document).on('change','.PaymentType',function(){
      
      var data = $(this).val();
      var rel_id = $(this).attr('rel_id');
      
      $('.payment_course').val('');
      $('#audit_rate').val('');
      if(data == 'Student Credit')
      {
          $('#edit_button'+rel_id).show();
          $('#Campaign'+rel_id).val(22);
          $('#modal_rel_id').val(rel_id);
          $('#show_edit'+rel_id).show();
          $('#course_modal').modal('show');
      }
      else
      {
          $('#edit_button'+rel_id).hide();
          $('#show_edit'+rel_id).hide();
      }
  })
  
  $(document).on('change','.paymentclass',function(){
      var class_id = $(this).val();
      var student_id = $('#employee_id').val();
      if(class_id != '')
      {
          $.ajax({
           		type: "POST",
           		url: "<?= base_url('admin/Form/get_user_Semester') ?>",
           		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'classname':class_id,'student_id':student_id},
           		success:function(result){
        	
        		 $('.payment_semester').html(result);	
        		
            	},
            });
      }
  })
  
  $(document).on('change', '.payment_semester', function(){
	var semester = $(this).val();
	var classname =$('.paymentclass :selected').val();
	var student_id = $('#employee_id').val();
	if(semester != '' && classname !=''){
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getCourseBySemester_in_payment_donation') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'semester':semester,'classname':classname,'student_id':student_id},
   		success:function(result){
		 $('.payment_course').html(result);
		 
		
		 
    	},
        });
	}
	else
	{
	    alert("Please Select Class");
	}
});










$(document).on('change','.edit_paymentclass',function(){
      var class_id = $(this).val();
      
      var class_id = $(this).val();
      var student_id = $('#employee_id').val();
      if(class_id != '')
      {
          $.ajax({
           		type: "POST",
           		url: "<?= base_url('admin/Form/get_user_Semester') ?>",
           		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'classname':class_id,'student_id':student_id},
           		success:function(result){
        	
        		 $('.edit_payment_semester').html(result);	
        		
            	},
            });
      }
      
  })
  
  $(document).on('change', '.edit_payment_semester', function(){
	var semester = $(this).val();
	var classname =$('.edit_paymentclass :selected').val();
	var student_id = $('#employee_id').val();
	if(semester != '' && classname !=''){
		$.ajax({
   		type: "POST",
   		url: "<?= base_url('admin/Form/getCourseBySemester_in_payment_donation') ?>",
   		data:{'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'semester':semester,'classname':classname,'student_id':student_id},
   		success:function(result)
   		{
		 $('.edit_payment_course').html(result);
		 
    	},
        });
	}
	else
	{
	    alert("Please Select Class");
	}
});









$(document).on('click','.update_data1',function(){
    
    var rel_id = $('#edit_modal_rel_id').val();
    var course_id = $('.edit_payment_course').val();
    var credit = $('#edit_audit_rate').val();
    
    var student_id = $('#employee_id').val();
    
    var credit_note = $('#edit_tuition_adjustment_note').val();
    var scholar_adjustment  = $('#edit_scholar_adjustment').val();
    
    
    var total = 0;
    /*if(credit != '' &&  scholar_adjustment !='')
    {
        total = parseInt(credit)+parseInt(scholar_adjustment);
    }
    else if(credit != '' && scholar_adjustment =='')
    {
        total = parseInt(credit);
    }*/
    total = parseInt(credit);
    $('#Amount'+rel_id).val(total);
    var scholarship_adjustment_note = $('#edit_scholarship_adjustment_note').val();
    
    if(credit == '')
    {
        alert("Please Fill Credit Amount");
        return false;
    }
    else
    {
      
        $.ajax({
        		type: "POST",
        		url: '<?= base_url('admin/Form/get_max_scholal') ?>',
        		data: {'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4','course_id':course_id,'student_id':student_id},
        		dataType: "html",
        		success: function(data){
        		    
        		     if(parseFloat(data) < scholar_adjustment)
        		     {
        		         alert("Scholarship is always greater than Scholar Ship adjustment,Scholarship Amount is :"+data);
        		     }
        		     else
        		     {
        		            $('#denotion_course'+rel_id).val(course_id);
                            $('#student_credit'+rel_id).val(credit);
                            
                            $('#student_credit_note'+rel_id).val(credit_note);
                            $('#scholar_adjustment'+rel_id).val(scholar_adjustment);
                            $('#scholar_adjustment_note'+rel_id).val(scholarship_adjustment_note);
                            
                            var row = rel_id;
                        	var selector = '#TextBoxDivDP'+row;
                        	var note_selector = '#TextBoxDivDPN'+row;
                        	$(note_selector+' span.show, '+selector+' span.show, '+selector+' a.edit-donation').removeClass('show').addClass('hide');
                        	$(note_selector+' textarea, '+selector+' input, '+selector+' select, '+selector+' a.save-donation, '+selector+' a.cancel-donation, '+selector+' a.delete-donation').removeClass('hide').addClass('show');

                            
                            $("#edit_course_modal").modal('hide');
        		     }
        		}
        	})
       
    }
       
        
    
})

$(document).on('click','.update_data',function(){
    var rel_id = $('#modal_rel_id').val();
    var course_id = $('.payment_course').val();
    var credit = $('#audit_rate').val();
    
    var credit_note = $('#tuition_adjustment_note').val();
    var scholar_adjustment = $('#scholar_adjustment').val();
    
    var total = 0;
   /* if(credit != '' &&  scholar_adjustment !='')
    {
        total = parseInt(credit)+parseInt(scholar_adjustment);
    }
    else if(credit != '' && scholar_adjustment =='')
    {
        total = parseInt(credit);
    }*/
    total = parseInt(credit);
    $('#Amount'+rel_id).val(total);
    var scholarship_adjustment_note = $('#scholarship_adjustment_note').val();
    
    var student_id = $('#employee_id').val();
    
    if(credit == '')
    {
        alert("Please Fill Credit Amount");
        return false;
    }
    else
    {
        
        $.ajax({
        		type: "POST",
        		url: '<?= base_url('admin/Form/get_max_scholal') ?>',
        		data: {'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4','course_id':course_id,'student_id':student_id},
        		dataType: "html",
        		success: function(data){
        		     if(parseFloat(data) < scholar_adjustment)
        		     {
        		         
        		         alert("Scholarship is always greater than Scholar Ship adjustment,Scholarship Amount is :"+data)
        		     }
        		     else
        		     {
        		            $('#denotion_course'+rel_id).val(course_id);
                            $('#student_credit'+rel_id).val(credit);
                            $('#student_credit_note'+rel_id).val(credit_note);
                            $('#scholar_adjustment'+rel_id).val(scholar_adjustment);
                            $('#scholar_adjustment_note'+rel_id).val(scholarship_adjustment_note);
                            
                            var content ="<i class='fa fa-pencil edit_course' id='edit_button"+rel_id+"' rel_id="+rel_id+" rel_course="+course_id+" rel_credit="+credit+" style='cursor:pointer;'></i>";
                            
                            $('#show_edit'+rel_id).html(content);
                            
                            $("#course_modal").modal('hide');
        		     }
        		}
        	})
        
        
    }
})
 // $(this).attr('rel_course');
 //$(this).attr('rel_credit');
$(document).on('click','.edit_course',function(){
    var rel_id = $(this).attr('rel_id');
    
    var student_id = $('#employee_id').val();
   
   $('#edit_modal_rel_id').val(rel_id);
    var rel_course = $('#denotion_course'+rel_id).val();
    var credit = $('#student_credit'+rel_id).val();
    
    credit_note = $('#student_credit_note'+rel_id).val();
	scholor_adjustment = $('#scholar_adjustment'+rel_id).val();
	scholor_adjustment_note = $('#scholar_adjustment_note'+rel_id).val();
    
   // $('#edit_modal_rel_id').val(rel_id);
    $.ajax({
		type: "POST",
		url: '<?= base_url('admin/Form/get_couse_detail') ?>',
		data: {'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4','course_id':rel_course,'credit':credit,'student_id':student_id,'credit_note':credit_note,'scholor_adjustment':scholor_adjustment,'scholor_adjustment_note':scholor_adjustment_note},
		dataType: "html",
		success: function(data){
		      $('#edit_details').html(data);
		      $('#edit_course_modal').modal('show');
		}
	})
    
})

// End Prabhat 27-10-2020
$(document).on('change', '.date-checks', function(){
	var current = $(this).val();
	if(current != ''){
		$(this).closest('tr').find('.date-checks').not(this).attr('disabled', true);
	}else{
		$(this).closest('tr').find('.date-checks').attr('disabled', false);
	}
});

$(document).on('click', '.edit-donation', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivDP'+row;
	var note_selector = '#TextBoxDivDPN'+row;
	$(note_selector+' span.show, '+selector+' span.show, '+selector+' a.edit-donation').removeClass('show').addClass('hide');
	$(note_selector+' textarea, '+selector+' input, '+selector+' select, '+selector+' a.save-donation, '+selector+' a.cancel-donation, '+selector+' a.delete-donation').removeClass('hide').addClass('show');
}); 
$(document).on('click', '.cancel-donation', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivDP'+row;
	var note_selector = '#TextBoxDivDPN'+row;
	$(note_selector+' textarea, '+selector+' input, '+selector+' select, '+selector+' a.save-donation, '+selector+' a.cancel-donation, '+selector+' a.delete-donation').removeClass('show').addClass('hide');
	$(note_selector+' span.hide, '+selector+' span.hide, '+selector+' a.edit-donation').removeClass('hide').addClass('show');

}); 
</script>

<script type="text/javascript">
function payments(id)
{
     
	 var paymenttype_list = JSON.parse('[{"ROWID":"1","PayType":"ACH\/Debit","Deletestatus":null},{"ROWID":"2","PayType":"Cash","Deletestatus":null},{"ROWID":"3","PayType":"Check","Deletestatus":null},{"ROWID":"11","PayType":"COD One","Deletestatus":null},{"ROWID":"4","PayType":"Credit Card","Deletestatus":null},{"ROWID":"5","PayType":"EFT","Deletestatus":null},{"ROWID":"6","PayType":"Online","Deletestatus":null},{"ROWID":"7","PayType":"Stock","Deletestatus":null},{"ROWID":"10","PayType":"Student Credit","Deletestatus":null},{"ROWID":"9","PayType":"Unkown","Deletestatus":null}]');
	 var edit_user = 'IT Helpdesk';
	 var current_date = '06/27/2025';
	 var campaigns_list = JSON.parse('[{"CampaignID":"6","CampaignName":"Afghanistan","Active":"1","Deletestatus":null},{"CampaignID":"24","CampaignName":"AmeriCorp ","Active":"1","Deletestatus":null},{"CampaignID":"1","CampaignName":"Annual Fundraiser","Active":"1","Deletestatus":null},{"CampaignID":"27","CampaignName":"Appalachian","Active":"1","Deletestatus":null},{"CampaignID":"21","CampaignName":"Bending Bamboo","Active":"1","Deletestatus":null},{"CampaignID":"26","CampaignName":"Certificate Tuition","Active":"1","Deletestatus":null},{"CampaignID":"7","CampaignName":"China","Active":"1","Deletestatus":null},{"CampaignID":"8","CampaignName":"General Support","Active":"1","Deletestatus":null},{"CampaignID":"3","CampaignName":"Grant","Active":"1","Deletestatus":null},{"CampaignID":"4","CampaignName":"Grant Restricted","Active":"1","Deletestatus":null},{"CampaignID":"2","CampaignName":"Haiti","Active":"1","Deletestatus":null},{"CampaignID":"10","CampaignName":"India","Active":"1","Deletestatus":null},{"CampaignID":"11","CampaignName":"KWD Circle of Friend","Active":"1","Deletestatus":null},{"CampaignID":"28","CampaignName":"Nepal","Active":"1","Deletestatus":null},{"CampaignID":"25","CampaignName":"Other","Active":"1","Deletestatus":null},{"CampaignID":"13","CampaignName":"Peru","Active":"1","Deletestatus":null},{"CampaignID":"12","CampaignName":"Scholarships","Active":"1","Deletestatus":null},{"CampaignID":"20","CampaignName":"Sheila McKean Schola","Active":"1","Deletestatus":null},{"CampaignID":"19","CampaignName":"Songs of Adaptation","Active":"1","Deletestatus":null},{"CampaignID":"23","CampaignName":"Student Credit","Active":"1","Deletestatus":null},{"CampaignID":"22","CampaignName":"Student Refund","Active":"1","Deletestatus":null},{"CampaignID":"14","CampaignName":"Tibet","Active":"1","Deletestatus":null},{"CampaignID":"18","CampaignName":"Tuition","Active":"1","Deletestatus":null}]');
	 var student_id = $('#employee_id').val();
	 
	 donor_rowid=$('#Donor_RowID'+id).val();
	 donorid=$('#DonorID'+id).val();
	
	 login_user=$('#login_user').val();
	 added_date = $('#added_date'+id).val();
	 received_date= $('#ReceivedDate'+id).val();
	 payment_type=$('#PaymentType'+id).val();
	 checknumber= $('#CheckNumber'+id).val();
	 amountval= $('#Amount'+id).val();
	 amountval_1= $('#Amount'+id).val();
	 amount=parseFloat(amountval).toFixed(2);
	 amount1=addCommas(amount);
	 campaign=$('#Campaign'+id).val();
	 campaign_text=$('#Campaign'+id+' option:selected').text();
	 
	 //start Fwd: Staging and Production Database 11-12-2023
	 let GrantID = $('#GrantID'+id).val();
	 isChecked = $('#SoftCredit'+id).is(":checked");;
	 let SoftCredit= isChecked?'Yes':'No'
	 //end Fwd: Staging and Production Database 11-12-2023
	 
	 var course_id ='';
	 var credit = '';
	 var credit_note = '';
	 var scholor_adjustment = '';
	 var scholor_adjustment_note = '';
	 if(payment_type == 'Student Credit')
	 {
	     course_id = $('#denotion_course'+id).val();
	     credit = $('#student_credit'+id).val();
	     credit_note = $('#student_credit_note'+id).val();
	     scholor_adjustment = $('#scholar_adjustment'+id).val();
	     scholor_adjustment_note = $('#scholar_adjustment_note'+id).val();
	     $('#edit_button'+id).show();
	 }
	 else
	 {
	      $('#edit_button'+id).hide();
	 }
	 
	 donationNote=$('#DonationNote'+id).val();
	
	 ReceiptDate=$('#ReceiptDae'+id).val();
	 next_id=parseInt(id)+1;
	 
	 //alert(campaign_text);
	  //paymenttype_html
	 paymenttype_html = '<select class="form-control PaymentType" rel_id="'+next_id+'" id="PaymentType'+next_id+'" name="PaymentType['+next_id+']"><option value="">Select payment type</option>';
	$.each(paymenttype_list, function (key, val) {
		paymenttype_html += '<option value="'+val.PayType+'">'+val.PayType+'</option>';
    });
	
	//region_html
	campaigns_html = '<select class="form-control" id="Campaign'+next_id+'" name="Campaign['+next_id+']"><option value="">Select</option>';
	$.each(campaigns_list, function (key, val) {
		campaigns_html += '<option value="'+val.CampaignID+'">'+val.CampaignName+'</option>';
    });
	
	
	var new_row = '<tr id="TextBoxDivDP'+next_id+'"><td rowspan="2" style="vertical-align: middle;">'+next_id+'</td><td><input type="hidden" id="count7" value="'+next_id+'"><input type="hidden" name="DonorID'+next_id+'" id="DonorID'+next_id+'" value="'+donorid+'"><input type="hidden" name="Donor_RowID['+next_id+']" id="Donor_RowID'+next_id+'" value=""><span class="hide"></span><input class="form-control datepickerbackward donation_date num" id="ReceivedDate'+next_id+'" name="ReceivedDate['+next_id+']" type="text" readonly></td><td><span class="hide"></span>'+paymenttype_html+'</select><p id="show_edit'+next_id+'"></p></td><td><span class="hide"></span><input class="form-control" id="CheckNumber'+next_id+'" name="CheckNumber['+next_id+']" type="text"></td><td><span class="hide calculator-section" ></span><input class="form-control decimal" id="Amount'+next_id+'" name="Amount['+next_id+']" type="text" onkeypress="return validateFloatKeyPress(this,event)"></td><td><span class="hide"></span>'+campaigns_html+'</td><td><span class="hide"></span><input class="form-control datepickerbackward donation_date num" id="ReceiptDae'+next_id+'" name="ReceiptDae['+next_id+']" type="text" readonly><td><span class="hide"></span><input type="text" class="form-control login_user" name="login_user['+next_id+']" id="login_user'+next_id+'" value="'+edit_user+'" readonly></td><td><span class="hide"></span><input type="text" class="form-control added_date" name="added_date['+next_id+']" id="added_date'+next_id+'" value="'+current_date+'" readonly></td><td rowspan="2"><a href="javascript:void(0)" id="add-donation'+next_id+'" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-donation"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span><strong>ADD</strong></span></a><a href="javascript:void(0)" id="save-donation'+next_id+'" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-donation hide pull-left save'+next_id+'" data-id="'+donorid+'" data-row="'+donorid+'"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span><strong>Save</strong></span></a>';
		new_row +='<span id="delete_button'+next_id+'"></span>';
	    new_row +='<a href="javascript:void(0)"  id="cancel-donation'+next_id+'" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-donation hide pull-left"  data-row="'+next_id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span><strong>Cancel</strong></span> </a><a href="javascript:void(0)" id="edit-donation'+next_id+'"class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-donation hide pull-left" data-id="'+next_id+'" data-row="'+next_id+'" style="text-align:center;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><span><strong>Edit</strong></span></a></td></tr><tr id="TextBoxDivDPN'+next_id+'"><td><strong>Donation Note :</strong><input type="hidden" name="course['+next_id+']" id="denotion_course'+next_id+'"><input type="hidden" name="student_credit['+next_id+']" id="student_credit'+next_id+'"><input type="hidden" name="student_credit_note['+next_id+']" id="student_credit_note'+next_id+'"><input type="hidden" name="scholar_adjustment['+next_id+']" id="scholar_adjustment'+next_id+'"><input type="hidden" name="scholar_adjustment_note['+next_id+']" id="scholar_adjustment_note'+next_id+'"></td><td colspan="7"><span class="hide" style="text-align:left;"></span><textarea name="DonationNote['+next_id+']" id="DonationNote'+next_id+'" class="form-control" style="align-content:left;"></textarea></td></tr>';

	$.ajax({
		type: "POST",
		url: '<?= base_url('admin/Form/submitPaymentDetails') ?>',
		data: {'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'donor_rowid':donor_rowid,'donorid':donorid,'received_date':received_date,'payment_type':payment_type,'checknumber':checknumber,'amount':amount,'campaign':campaign,'donationNote':donationNote,'ReceiptDate':ReceiptDate,'campaign_text':campaign_text,'course_id':course_id,'credit':credit,'credit_note':credit_note,'scholor_adjustment':scholor_adjustment,'scholor_adjustment_note':scholor_adjustment_note,'GrantID':GrantID,'SoftCredit':SoftCredit},
		dataType: "html",
		success: function(data){
		data = JSON.parse(data);
		alert(data.msg);
		if(data.msg !='Record Already Exist or saved'){
		    var display_sec = '';
			$('#ReceivedDate'+id).prev().html(received_date).addClass('show').removeClass('hide');
			if(payment_type != 'Student Credit')
			{
			    display_sec ="style='display:none;'";
			}
			$('#PaymentType'+id).prev().html(payment_type).addClass('show').removeClass('hide');
			$('#CheckNumber'+id).prev().html(checknumber).addClass('show').removeClass('hide');
			$('#Amount'+id).prev().html(amount1).addClass('show').removeClass('hide');
			$('#Campaign'+id).prev().html(campaign_text).addClass('show').removeClass('hide');
			
			$('#GrantID'+id).prev().html(GrantID).addClass('show').removeClass('hide');
			$('#SoftCredit'+id).prev().html(SoftCredit).addClass('show').removeClass('hide');
			
			$('#DonationNote'+id).prev().html(donationNote).addClass('show').removeClass('hide');
			$('#ReceiptDae'+id).prev().html(ReceiptDate).addClass('show').removeClass('hide');
			$('#login_user'+id).prev().html(edit_user).addClass('show').removeClass('hide');
			$('#added_date'+id).prev().html(current_date).addClass('show').removeClass('hide');
			$('#ReceivedDate'+id).addClass('hide').removeClass('show');
			$('#PaymentType'+id).addClass('hide').removeClass('show');
			$('#CheckNumber'+id).addClass('hide').removeClass('show');
			$('#Amount'+id).addClass('hide').removeClass('show');
			$('#Campaign'+id).addClass('hide').removeClass('show');
			$('#DonationNote'+id).addClass('hide').removeClass('show');
			
			$('#GrantID'+id).addClass('hide').removeClass('show');
			$('#SoftCredit'+id).addClass('hide').removeClass('show');
			
			$('#ReceiptDae'+id).addClass('hide').removeClass('show');
			$('#login_user'+id).addClass('hide').removeClass('show');
			$('#added_date'+id).addClass('hide').removeClass('show');
			$('#save-donation'+id).addClass('hide').removeClass('show');
			$('#add-donation'+id).addClass('hide').removeClass('show');
			$('#edit-donation'+id).addClass('show').removeClass('hide');
			$('#cancel-donation'+id).addClass('hide').removeClass('show');
			if(data.last_id != '') {
				$('#Donor_RowID'+id).val(data.last_id);
				$('#delete_button'+id).html('<a href="javascript:void(0)" rel_donation_id="'+data.last_id+'" id="delete-donation'+id+'" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 delete-donation pull-left delete'+id+' hide" data-id="'+student_id+'" data-row="'+id+'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span><span><strong>Delete</strong></span></a>');
				$('.tbl-body-donation').append(new_row);
				//$('.tbl-body-donation tbody tr:last').after(new_row);
				//$('.tbl-body-donation').find('tr:last').prev().after(new_row);
				//$('.tbl-body-donation tr:last').before(new_row);
				//$('.tbl-body-donation tr.grand-total1').before(new_row);
				amount_sum();
		    }
		    
		    
		    if(payment_type == 'Student Credit')
	        {
	            var str1 = window.location.href;
                var n1 = str1.lastIndexOf('#');
                if(n1 == -1)
                {
                    current_url = window.location.href+"#tab3"; 
                }
                else
                {
                    current_url = window.location.href; 
                }
	            
	            
	             win = window.open('','_self');
                 win.close();
	             window.open(current_url, "_blank");
	            
	            //document.location.href = current_url,true;
	            
	            //window.location.href+"#tab3";
	        }
		    
		}
		},
		});
	
 }

</script>
<script type="text/javascript">

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

function getSelectionStart(o) {
	if (o.createTextRange) {
		var r = document.selection.createRange().duplicate()
		r.moveEnd('character', o.value.length)
		if (r.text == '') return o.value.length
		return o.value.lastIndexOf(r.text)
	} else return o.selectionStart
}


</script>

<script>
$(document).on("change",".donation_dates",function(){
	var current_record_date = $(this).val();
	if(current_record_date!=""){
		var final_date = current_record_date.split('/')[2];
		var year_count_digit = final_date.length;
		if(year_count_digit !=4){
			alert('Year should be 4 digit');
			$(this).val('');
	}
		
}
	
});


</script>



<script type="text/javascript">

//function validatePaymentForm(id){
$(document).on('click', '.add-donation,.save-donation', function(){
	var id = this.id.replace( /^\D+/g, '');
	
	received_date= $('#ReceivedDate'+id).val();
	if(received_date==""){
		
		alert("Enter Received Date");
		return false;
	}
	payment_type=$('#PaymentType'+id).val();
	if(payment_type==""){
		
		alert("Payment Type Not Empty");
		return false;
	}
	amount= $('#Amount'+id).val();
	if(amount==""){
		alert('Enter Amount');
		return false;
	}
	campaign=$('#Campaign'+id).val();
	if(campaign==""){
		alert("Campaign Not Empty");
		return false;
	 }
	 else{
		//element.fireEvent("onchange");
		$('#add-donation'+id).hide();
		payments(id);
		
	 }
	 
	
});

function addCommas(num) {
    var str = num.toString().split('.');
    if (str[0].length >= 4) {
        //add comma every 3 digits befor decimal
        str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
    }
    /* Optional formating for decimal places
    if (str[1] && str[1].length >= 4) {
        //add space every 3 digits after decimal
        str[1] = str[1].replace(/(\d{3})/g, '$1 ');
    }*/
    return str.join('.');
}


function amount_sum(){
	var grandtotal = 0;
	
	$( ".calculator-section" ).each(function() {
		
		var total = parseFloat(($( this ).text()).replace(',',''));
		//console.log(total);
		if( !isNaN(total)){
			grandtotal = parseFloat(grandtotal) + parseFloat(total);
		}
	});
	//console.log(grandtotal);
	//$('#grandtotal').text(addCommas(parseFloat(grandtotal).toFixed(2)));
	$('#grandtotaltop').text(addCommas(parseFloat(grandtotal).toFixed(2)));

	
}
</script>


<!---- Student Info -->
<script>
$(document).on('change', '.date-checks', function(){
	var current = $(this).val();
	if(current != ''){
		$(this).closest('tr').find('.date-checks').not(this).attr('disabled', true);
	}else{
		$(this).closest('tr').find('.date-checks').attr('disabled', false);
	}
	
});

$(document).on('click', '.edit-student', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivRD'+row;
	student_note_selector ='#TextBoxDivNR'+row;
	var special_program = '#eTextBoxDivNR_specail'+row;
	var ceertificate = '#eTextBoxDivNR_certificate'+row;
	   // By prabhat 20-05-2020
		$(special_program+' span.show, '+special_program+' input.show, '+special_program+' a.edit-student').removeClass('show').addClass('hide');
		$(special_program+' input, '+selector+' input, '+selector+' select, '+selector+' a.save-student, '+selector+' a.cancel-student').removeClass('hide').addClass('show');
		
		
		$(ceertificate+' span.show, '+ceertificate+' input.show, '+ceertificate+' a.edit-student').removeClass('show').addClass('hide');
		$(ceertificate+' input, '+selector+' input, '+selector+' input, '+selector+' a.save-student, '+selector+' a.cancel-student').removeClass('hide').addClass('show');
		
	    // End 20-05-2020
	$(student_note_selector+' span.show, '+selector+' span.show, '+selector+' a.edit-student').removeClass('show').addClass('hide');
	
	$(student_note_selector+' textarea, '+selector+' input, '+selector+' select, '+selector+' a.save-student, '+selector+' a.cancel-student').removeClass('hide').addClass('show');

    $('#track_ts'+row+' .multiselect.dropdown-toggle.form-control.btn').show();
     $('#market_ts'+row+' .multiselect.dropdown-toggle.form-control.btn').show();

    $('.hidden_field').removeClass('show');
}); 

$(document).on('click', '.cancel-student', function(){
	var row = $(this).attr('data-row');
	var selector = '#TextBoxDivRD'+row;
	var student_note_selector ='#TextBoxDivNR'+row;
	
	var special_program = '#eTextBoxDivNR_specail'+row;
	var ceertificate = '#eTextBoxDivNR_certificate'+row;
	
	$(special_program+' textarea, '+special_program+' input, '+special_program+' select, '+special_program+' a.save-student, '+special_program+' a.cancel-student').removeClass('show').addClass('hide');
	$(special_program+' span.hide, '+selector+' span.hide, '+selector+' a.edit-student').removeClass('hide').addClass('show');
	
		$(ceertificate+' textarea, '+ceertificate+' input, '+ceertificate+' select, '+ceertificate+' a.save-student, '+ceertificate+' a.cancel-student').removeClass('show').addClass('hide');
	$(ceertificate+' span.hide, '+selector+' span.hide, '+selector+' a.edit-student').removeClass('hide').addClass('show');

	
	
	$(student_note_selector+' textarea, '+selector+' input, '+selector+' select, '+selector+' a.save-student, '+selector+' a.cancel-student').removeClass('show').addClass('hide');
	$(student_note_selector+' span.hide, '+selector+' span.hide, '+selector+' a.edit-student').removeClass('hide').addClass('show');
    $('#track_ts'+row+' .multiselect.dropdown-toggle.form-control.btn').hide();
    $('#market_ts'+row+' .multiselect.dropdown-toggle.form-control.btn').hide();
}); 
</script>

<script type="text/javascript">
/*
 $('.submit').click(function(){
        var id = (this.id);
        var form_data = {            //repair
            id: id,
            name: $('#name_' + id).val(),
            rate: $('#rate_' + id).val(),
            qty: $('#qty_' + id).val()
        };

    $.ajax({
        url: "https://staging.apps.future.edu/shop/add",
        type: 'POST',
        data: form_data, // $(this).serialize(); you can use this too
        success: function(msg) {
              alert("success..!! or any stupid msg");
        }

   });
   return false;

});

<td><span class="hide"></span><select class="form-control" name="Sex['+next_id+']" id="Sex'+next_id+'" required><option value="">Select</option><option value="M">Male</option><option value="F">Female</option><option value="T">Transgender</option></select></td>
<td><span class="hide"></span><input class="form-control num mask" id="GPA'+next_id+'" name="GPA['+next_id+']" type="text" required></td>
*/


    function studentinfo(id, ev)
    {  
        var transcriptclass_list = JSON.parse('[{"ROWID":"17","Class":"2025","Active":"1","Deletestatus":null},{"ROWID":"16","Class":"2024","Active":"1","Deletestatus":null},{"ROWID":"15","Class":"2023","Active":"1","Deletestatus":null},{"ROWID":"13","Class":"2022","Active":"1","Deletestatus":null},{"ROWID":"12","Class":"2021","Active":"1","Deletestatus":null},{"ROWID":"21","Class":"2020","Active":"1","Deletestatus":null},{"ROWID":"10","Class":"2020","Active":"1","Deletestatus":null},{"ROWID":"9","Class":"2019","Active":"1","Deletestatus":null},{"ROWID":"11","Class":"2018","Active":"1","Deletestatus":null},{"ROWID":"8","Class":"2017","Active":"1","Deletestatus":null},{"ROWID":"7","Class":"2015","Active":"1","Deletestatus":null},{"ROWID":"6","Class":"2014","Active":"1","Deletestatus":null},{"ROWID":"5","Class":"2013","Active":"1","Deletestatus":null},{"ROWID":"4","Class":"2011","Active":"1","Deletestatus":null},{"ROWID":"20","Class":"2010","Active":"1","Deletestatus":null},{"ROWID":"3","Class":"2009","Active":"1","Deletestatus":null},{"ROWID":"19","Class":"2008","Active":"1","Deletestatus":null},{"ROWID":"2","Class":"2007","Active":"1","Deletestatus":null},{"ROWID":"1","Class":"2005","Active":"1","Deletestatus":null},{"ROWID":"14","Class":"0000","Active":"1","Deletestatus":null}]');
        var region_list = JSON.parse('[{"RPID":"1","RegionProgram":"East Africa","Active":"1"},{"RPID":"2","RegionProgram":"Appalachian","Active":"1"},{"RPID":"3","RegionProgram":"Himalayan","Active":"1"},{"RPID":"5","RegionProgram":"Vietnam","Active":"1"},{"RPID":"7","RegionProgram":"United States","Active":"1"},{"RPID":"10","RegionProgram":"East Asi","Active":"1"},{"RPID":"11","RegionProgram":"West Asia","Active":"1"}]');
        var program_list = JSON.parse('[{"ProgramID":"1","Program_Name":"Linguistic Development Education","status":"1"},{"ProgramID":"4","Program_Name":"Leadership &amp; Development","status":"1"},{"ProgramID":"8","Program_Name":"Peacebuilding","status":"1"},{"ProgramID":"9","Program_Name":"Conservation","status":"1"},{"ProgramID":"12","Program_Name":"General Programme","status":"1"}]');
        var special_program_list = JSON.parse('[{"Special_ProgramID":"2","Special_Program_Name":"AmeriCorps member","status":"1","formbuilder_status":"1"},{"Special_ProgramID":"3","Special_Program_Name":"Peace Corps volunteer (returned or current)","status":"1","formbuilder_status":"1"},{"Special_ProgramID":"4","Special_Program_Name":"Bending Bamboo","status":"1","formbuilder_status":"0"},{"Special_ProgramID":"5","Special_Program_Name":"Scout","status":"1","formbuilder_status":"0"},{"Special_ProgramID":"7","Special_Program_Name":"Maple Certificate","status":"1","formbuilder_status":"0"},{"Special_ProgramID":"9","Special_Program_Name":"Honorary Master Degree","status":"1","formbuilder_status":"0"},{"Special_ProgramID":"11","Special_Program_Name":"FaithHealth","status":"1","formbuilder_status":"0"},{"Special_ProgramID":"12","Special_Program_Name":"SDLC\/Community Outreach","status":"1","formbuilder_status":"0"},{"Special_ProgramID":"13","Special_Program_Name":"Peer Support","status":"1","formbuilder_status":"0"},{"Special_ProgramID":"14","Special_Program_Name":"Funded by WV DRS","status":"1","formbuilder_status":"1"},{"Special_ProgramID":"15","Special_Program_Name":"General New Programme","status":"1","formbuilder_status":"0"}]');
        var tracks_list = '';
        if('[{"id":"1","track_name":"AmeriCorps","status":"1","created_by":"12","created_ip":"122.170.190.197","created_date":"2022-09-23 02:24:30","modified_by":"34","modified_date":"2022-09-29","modified_ip":"76.27.186.209"},{"id":"2","track_name":"Coverdell","status":"1","created_by":"12","created_ip":"122.170.190.197","created_date":"2022-09-23 02:24:43","modified_by":"34","modified_date":"2022-09-29","modified_ip":"76.27.186.209"},{"id":"3","track_name":"Alternate Track Admissions","status":"1","created_by":"34","created_ip":"76.27.186.209","created_date":"2022-09-29 19:53:48","modified_by":null,"modified_date":null,"modified_ip":null},{"id":"4","track_name":"Professional Development","status":"1","created_by":"34","created_ip":"76.27.186.209","created_date":"2022-09-29 19:54:01","modified_by":null,"modified_date":null,"modified_ip":null},{"id":"5","track_name":"Professional Certificate","status":"1","created_by":"34","created_ip":"76.27.186.209","created_date":"2022-09-29 19:54:13","modified_by":null,"modified_date":null,"modified_ip":null},{"id":"6","track_name":"Scout Track - Community Development Certificate","status":"1","created_by":"34","created_ip":"76.27.186.209","created_date":"2022-09-29 19:55:13","modified_by":null,"modified_date":null,"modified_ip":null}]' != '')
        {
            tracks_list = JSON.parse('[{"id":"1","track_name":"AmeriCorps","status":"1","created_by":"12","created_ip":"122.170.190.197","created_date":"2022-09-23 02:24:30","modified_by":"34","modified_date":"2022-09-29","modified_ip":"76.27.186.209"},{"id":"2","track_name":"Coverdell","status":"1","created_by":"12","created_ip":"122.170.190.197","created_date":"2022-09-23 02:24:43","modified_by":"34","modified_date":"2022-09-29","modified_ip":"76.27.186.209"},{"id":"3","track_name":"Alternate Track Admissions","status":"1","created_by":"34","created_ip":"76.27.186.209","created_date":"2022-09-29 19:53:48","modified_by":null,"modified_date":null,"modified_ip":null},{"id":"4","track_name":"Professional Development","status":"1","created_by":"34","created_ip":"76.27.186.209","created_date":"2022-09-29 19:54:01","modified_by":null,"modified_date":null,"modified_ip":null},{"id":"5","track_name":"Professional Certificate","status":"1","created_by":"34","created_ip":"76.27.186.209","created_date":"2022-09-29 19:54:13","modified_by":null,"modified_date":null,"modified_ip":null},{"id":"6","track_name":"Scout Track - Community Development Certificate","status":"1","created_by":"34","created_ip":"76.27.186.209","created_date":"2022-09-29 19:55:13","modified_by":null,"modified_date":null,"modified_ip":null}]');
        }
       
        student_rowid=$('#student_rowid'+id).val();
        student_infoid=$('#studentinfoid'+id).val();
        
        studentclass= $('#Class'+id).val();
        sex= $('#Sex'+id).val();
        sex_text= $('#Sex'+id+' option:selected').text();
        region= $('#Region'+id).val();
        specialprogram = $('#specialprogram'+id).val();
        if(region!=''){
            region_text= $('#Region'+id+' option:selected').text(); 
        }else{
            region_text=''; 
        }
        var program = $('#ProgramID'+id).val();
        
        if(program!=''){
            program_text = $('#ProgramID'+id+' option:selected').text();
        }else{
            program_text='';
        }
        if(specialprogram !='')
        {
            special_program_text = $('#specialprogram'+id+' option:selected').text();
        }
        
        
         track = $('#track'+id).val();
	 tract_name_val = $('#track'+id+" option:selected").text();
	 market_selected_val = $('#track'+id+" option:selected").text();
        
        graduation=$('#Graduation'+id).val();
        gpa=$('#GPA'+id).val();
        deferred=$('#Deferred'+id).val();
        withdrawn=$('#Withdrawn'+id).val();
        student_note = $('#Note'+id).val();
        var next_id = parseInt(id+1);
        
        // By prabhat 15-05-2020
        
        var special_start = $('#special_start'+id).val();
        var special_end = $('#special_end'+id).val();
        
        if(special_start>special_end)
        {
            alert("Market Start Date is always smaller than Market End Date");
            $('#special_end'+id).focus();
            exit();
        }
        
        var program_start = $('#program_start'+id).val();
        var program_end = $('#program_end'+id).val();
        
        if(program_start>program_end)
        {
            alert("Program Start Date is always smaller than program End Date");
            exit();
        }
        
        var start_date = $('#start_date'+id).val();
        var enroll_certificate = '';
        var master_program = '';
        
        if($('#master_program'+id).prop("checked") == true){
            master_program = 'Yes';
        }
        else if($('#master_program'+id).prop("checked") == false){
            master_program = 'No';
        }
        
        if($('#enroll_certificate'+id).prop("checked") == true){
            enroll_certificate = 'Yes';
        }
        else if($('#enroll_certificate'+id).prop("checked") == false){
            enroll_certificate = 'No';
        }
        //transcriptclass_html
        transcriptclass_html = '<select class="form-control" id="Class'+next_id+'" name="Class['+next_id+']"><option value="">Select</option>';
        $.each(transcriptclass_list, function (key, val) {
            transcriptclass_html += '<option value="'+val.Class+'">'+val.Class+'</option>';
        });
        
        //region_html
        region_html = '<select class="form-control" id="Region'+next_id+'" name="Region['+next_id+']"><option value="0">None Selected</option>';
        $.each(region_list, function (key, val) {
            region_html += '<option value="'+val.RPID+'">'+val.RegionProgram+'</option>';
        });
        
        
         // tracks
        track_html = '<select type="text" class="multiselect hidden_field" multiple="multiple" role="multiselect" name="track['+next_id+']" id="track'+next_id+'">';
    	$.each(tracks_list, function (key, val) {
    		track_html += '<option value="'+val.id+'">'+val.track_name+'</option>';
        });	
        
        
        //Program_html
        program_html = '<select class="form-control programid"  id="ProgramID'+next_id+'" name="ProgramID['+next_id+']"><option value="">Select Program</option>';
        $.each(program_list, function (key, val) {
            program_html += '<option value="'+val.ProgramID+'">'+val.Program_Name+'</option>';
        });
        
        // Market list
        //special_program_list
        special_program_html ='<select class="form-control multiselect specialprogram" multiple="multiple" role="multiselect" id="specialprogram'+next_id+'" name="specialprogram['+next_id+']"><option value="">Select Market</option>';
        
        $.each(special_program_list, function (key, val) {
            special_program_html += '<option value="'+val.Special_ProgramID+'">'+val.Special_Program_Name+'</option>';
        });
        special_program_html += '</select>';
        // End Market list
        
        var new_row = '<tr id="TextBoxDivRD'+next_id+'"><td rowspan="3">'+next_id+'</td>';
        // new_row +='<td rowspan="4"><span>'+student_infoid+'</span></td>';
        new_row +='<td> <input type="hidden" id="count7" value="'+next_id+'"><input type="hidden" name="studentinfoid'+next_id+'" id="studentinfoid'+next_id+'" value="'+student_infoid+'"><input type="hidden" name="student_rowid['+next_id+']" id="student_rowid'+next_id+'" value=""><span class="hide"></span>'+transcriptclass_html+'</td>';
        new_row +='<td><span class="hide"></span>'+region_html+'</td>';
         // Track list
   new_row +='<td id="track_ts'+next_id+'"><span class="hide"></span>'+track_html+'</td>';
        new_row +='<td id="market_ts'+next_id+'"><span class="hide"></span>'+special_program_html+'</td>';
        new_row +='<td ><span class="hide"></span>'+program_html+'</td>';
        
        //	new_row += '<td><span class="hide"></span><input type="checkbox" value="Yes" id="master_program'+next_id+'" name="master_program'+next_id+'"></td>';
        
        new_row += '<td>';
        new_row += '<span class="hide">';
        new_row += '</span>';
        new_row += '<input class="form-control datepicker  start_date show" id="start_date'+next_id+'" name="start_date['+next_id+']" type="text">';
        new_row += '</td>';    
        new_row +='<td><span class="hide"></span><input class="form-control datepickerbackward  rec_date graduation" id="Graduation'+next_id+'" name="Graduation['+next_id+']" type="text"></td>';
        new_row +='<td><span class="hide"></span><input class="form-control datepickerbackward rec_date withdrawn" id="Withdrawn'+next_id+'" name="Withdrawn['+next_id+']" type="text"></td>';
        new_row +='<td rowspan="3"><a href="javascript:void(0)" id="edit-student'+next_id+'" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-student hide pull-left" data-id="'+student_infoid+'" data-row="'+next_id+'" style="text-align:center;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><span><strong> Edit</strong></span></a><a href="javascript:void(0)" id="save-student'+next_id+'" onclick="validateStudent('+next_id+', this)" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-student hide pull-left save'+next_id+'" data-id="'+student_infoid+'" data-row="'+next_id+'"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span><strong>Save</strong></span></a><a href="#" id="add-student'+next_id+'" onclick="studentinfo('+next_id+', this)" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-student"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span><strong>ADD</strong></span></a><a href="javascript:void(0)" id="cancel-student'+next_id+'" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-student hide pull-left" data-row="'+next_id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span><strong>Cancel</strong></span></a></td></tr>';
        new_row +='<tr id="TextBoxDivNR'+next_id+'">';
        new_row +='<td rowspan="2">Note: </td><td rowspan="2" colspan="3">';
        new_row +='<span class="hide" style="text-align:left;"></span>';
        new_row +='<textarea name="Note'+next_id+'" id="Note'+next_id+'" class="form-control" style="align-content:left;"></textarea>';
        new_row +='</td>';
        new_row +='<th>';
        new_row +='Enrolled into a Master program';
        new_row +='</th>';
        //new_row +='<th>Start Date  : </th>';
        //new_row +='<th>End Date  :</th>';
        //new_row +='<th>Start Date:</th>';
        //new_row +='<th>End Date  :</th>';
        new_row +='<th>Non-degree student/certificate :</th>';
        new_row +='<th colspan="2">Deferred :</th>';
        // new_row +='<th></th>';
        new_row +='</tr>';//textarea tr note 3 close
        new_row +='<tr id="eTextBoxDivNR_specail'+next_id+'">';
        new_row +='<td>';
        new_row +='<span class="hide">';
        new_row +='</span>';
        new_row +='<input type="checkbox" name="master_program['+next_id+']" value="Yes" class="show master_program" id="master_program'+next_id+'">';
        new_row +='</td>';
        
        //new_row +='<td><span class="hide"></span><input class="form-control datepickerbackward special_start" id="special_start'+next_id+'"  name="special_start'+next_id+'"></td>';
        //new_row +='<span class="hide"></span><td><input class="form-control datepickerbackward special_end" id="special_end'+next_id+'" name="special_end'+next_id+'"></td>';
        //new_row +='<span class="hide"></span><td><input class="form-control datepickerbackward program_start" id="program_start'+next_id+'" name="program_start'+next_id+'"></td>';
        //new_row +='<span class="hide"></span><td><input class="form-control datepickerbackward program_end" id="program_end'+next_id+'" name="program_end'+next_id+'"></td>';
        new_row +='<td><span class="hide"></span><input type="checkbox" id="enroll_certificate'+next_id+'" name="enroll_certificate'+next_id+'"></td>';
        new_row +='<td colspan="2"><span class="hide"></span><input class="form-control datepickerbackward rec_date deffered" id="Deferred'+next_id+'" name="Deferred['+next_id+']" type="text"></td>';
        
        //	new_row +='<td></td>';
        new_row +='</tr>';	 
        
        $.ajax({
            type: "POST",
            url: '<?= base_url('admin/Form/submitstudentinfo') ?>',
            data: {'csrf_token':'271dcfee4f1f3de8044f1f667bc664d4', 'studentrowid':student_rowid,'student_infoid':student_infoid,'class':studentclass,'sex':sex,'region':region,'ProgramID':program,'graduation':graduation,'gpa':gpa,'Deferred':deferred,'withdrawn':withdrawn,'student_note':student_note,'specialprogram':specialprogram,'special_start':special_start,'special_end':special_end,'program_start':program_start,'program_end':program_end,'enroll_certificate':enroll_certificate,'master_program':master_program,start_date:start_date,track:track},
            dataType: "html",
            success: function(data){
                data = JSON.parse(data);
                alert(data.msg);
                if(data.msg != 'Record Already Exist or saved'){
                    $('#Class'+id).prev().html(studentclass).addClass('show').removeClass('hide');
                    $('#Sex'+id).prev().html(sex_text).addClass('show').removeClass('hide');
                    $('#Region'+id).prev().html(region_text).addClass('show').removeClass('hide');
                    $('#ProgramID'+id).prev().html(program_text).addClass('show').removeClass('hide');
                    $('#specialprogram'+id).prev().html(special_program_text).addClass('show').removeClass('hide');
                    $('#Graduation'+id).prev().html(graduation).addClass('show').removeClass('hide');
                    $('#GPA'+id).prev().html(gpa).addClass('show').removeClass('hide');
                    $('#Deferred'+id).prev().html(deferred).addClass('show').removeClass('hide');
                    $('#Withdrawn'+id).prev().html(withdrawn).addClass('show').removeClass('hide');
                    $('#Note'+id).prev().html(student_note).addClass('show').removeClass('hide');
                    
                    $('#special_start'+id).prev().html(special_start).addClass('show').removeClass('hide');
                    $('#special_end'+id).prev().html(special_end).addClass('show').removeClass('hide');
                    $('#program_start'+id).prev().html(program_start).addClass('show').removeClass('hide');
                    $('#program_end'+id).prev().html(program_end).addClass('show').removeClass('hide');
                    $('#enroll_certificate'+id).prev().html(enroll_certificate).addClass('show').removeClass('hide');
                    $('#master_program'+id).prev().html(master_program).addClass('show').removeClass('hide');
                    $('#start_date'+id).prev().html(start_date).addClass('show').removeClass('hide');
                    $('#start_date'+id).addClass('hide').removeClass('show');
                    $('#special_start'+id).addClass('hide').removeClass('show');
                    $('#special_end'+id).addClass('hide').removeClass('show');
                    $('#program_start'+id).addClass('hide').removeClass('show');
                    $('#program_end'+id).addClass('hide').removeClass('show');
                    $('#enroll_certificate'+id).addClass('hide').removeClass('show');
                    $('#master_program'+id).addClass('hide').removeClass('show');
                    
                    	$('#track_ts'+id+' .multiselect.dropdown-toggle.form-control.btn').hide();
						$('#track'+id).prev().html(tract_name_val).addClass('show').removeClass('hide');
						
						$('#market_ts'+id+' .multiselect.dropdown-toggle.form-control.btn').hide();
					$('#market'+id).prev().html(market_selected_val).addClass('show').removeClass('hide');
                    
                    $('#Class'+id).addClass('hide').removeClass('show');
                    $('#Sex'+id).addClass('hide').removeClass('show');
                    $('#Region'+id).addClass('hide').removeClass('show');
                    $('#ProgramID'+id).addClass('hide').removeClass('show');
                    $('#specialprogram'+id).addClass('hide').removeClass('show');
                    $('#Graduation'+id).addClass('hide').removeClass('show');
                    $('#GPA'+id).addClass('hide').removeClass('show');
                    $('#Deferred'+id).addClass('hide').removeClass('show');
                    $('#Withdrawn'+id).addClass('hide').removeClass('show');
                    $('#Note'+id).addClass('hide').removeClass('show');
                    $(ev).addClass('hide').removeClass('show');
                    $('#edit-student'+id).addClass('show').removeClass('hide');
                    $('#cancel-student'+id).addClass('hide').removeClass('show');
                    
                    
                    
                    
                    if(data.last_id != '') {
                    	$('#student_rowid'+id).val(data.last_id);
                    	$('.tbl-body-student-info').append(new_row);
                    }
                }
            },
        });
    
    }
</script>
<script>
 $(document).ready(function(){
        $('input[name="phone"], input[name="fed_phone"]').mask('(000) 000 0000');
        $('.mask').mask('9.990');
        $('input[name="employer_fax"]').mask('+99-9999999999');
        $('input[name="aadhar"]').mask('999999999999');
        $('input[name="aadhar_enroll_no"]').mask('9999/99999/99999');
        $('.year').mask('9999');
        $('.passedyear').mask('9999');
    });
	</script>
	
	<script type="text/javascript">
	  function validateStudent(id,ev){
		  studentclass= $('#Class'+id).val();

		  sex= $('#Sex'+id).val();
		  /*if(studentclass==""){
			  
			  alert('Class Not Empty');
			  return false;
		  }*/
		  if(studentclass==""){
			  
			  alert('Class Not Empty');
			  return false;
		  }
		  else{
			  studentinfo(id, ev);
			  
		  }
		  
	  }
	
	function isValidDate(dateString)
      {
    // First check for the pattern
    if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
        return false;

    // Parse the date parts to integers
    var parts = dateString.split("/");
    var day = parseInt(parts[1], 10);
    var month = parseInt(parts[0], 10);
    var year = parseInt(parts[2], 10);

    // Check the ranges of month and year
    if(year < 1000 || year > 3000 || month == 0 || month > 12)
        return false;

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];
};
	</script>
	
 <script>
$(document).on("change",".rec_date",function(){
	var current_record_date = $(this).val();
	if(current_record_date!=""){
		var final_date = current_record_date.split('/')[2];
		var year_count_digit = final_date.length;
	if(year_count_digit !=4){
			alert('Year should be 4 digit');
			$(this).val('');
	}
}
	
});

</script>
<script>
// check graduation date validation

$(document).on("change",".graduation",function(){
	
var graduation_date = $(this).val();
var deffered_date = $(this).closest('tr').find('.deffered').val();
var withdrawn_date = $(this).closest('tr').find('.withdrawn').val();

if(deffered_date!="" && withdrawn_date!=""){
	alert('Remove Withdrawn date first');
	$(this).val('');
	return false;
}else{
	return true;
}

});


// check deffered date validation
$(document).on("change",".deffered",function(){
var deffered_date = $(this).val();
var withdrawn_date     =   $(this).closest('tr').find('.withdrawn').val();


if(withdrawn_date!=""){
if(deffered_date > withdrawn_date){
	alert('Deferred date less than withdrawn date');
	$(this).val('');
	return false;
}else{
	return true;
}
}
});
// check withdrawn date validation 
$(document).on("change",".withdrawn",function(){
var withdrawn_date  = $(this).val();
var graduation_date = $(this).closest('tr').find('.graduation').val();
var deffered_date   = $(this).closest('tr').find('.deffered').val();


if(deffered_date!=""){
	if(withdrawn_date < deffered_date){
		alert('Withdrawn date should be greater than deffered date');
		$(this).val('');
		return false;
	}else{
		return true;
	}
}

});

$(document).on("change",".withdrawn",function(){
var withdrawn_date  = $(this).val();
var graduation_date = $(this).closest('tr').find('.graduation').val();
var deffered_date   = $(this).closest('tr').find('.deffered').val();

if(graduation_date!="" && deffered_date!=""){
	alert('Remove graduation date first');
	$(this).val('');
	return false;
}else{
	return true;
}
});



function process(date){
   var parts = date.split("/");
   return new Date(parts[2], parts[1] - 1, parts[0]);
}

</script>

<script type="text/javascript"> 
	$(document).on("click", ".rmvstudent", function() { 
     
		var anim = this.getAttribute("data-urlms"); 
		var anin = this.getAttribute("data-urlns"); 
		var row = this.getAttribute("data-rows");
		var current = this; 

		if(confirm('Are you sure, Want to Delete this record?')){ 
			loading(); 
			$.ajax({ 
				type: "POST", 
				url: "http://localhost:8080/" + "admin/Form/delStudentInfo",  
				data: {toBeChange: anim,studentid: anin}, 
				success: function(res){ 
					//alert(res); 
					console.log(res); 
					$('#overlay').remove(); 
					if(res != 'OK' || res.length <= 0 || res == null){ 
					alert('Something went wrong'); 
					}else{
						
					alert('Deleted Successfully');
					$('#TextBoxDivRD'+row).remove();
					$('#TextBoxDivNR'+row).remove();
					$('#eTextBoxDivNR_specail'+row).remove();
					
					//location.reload(); 
					} 
				} 
			}); 

		} 
	});   
	
	
	
	
   function loading() { 
	// add the overlay with loading image to the page 
	 var over = '<div id="overlay">' +
	 '<p>Please Wait...</p></div>'; 
	 $(over).appendTo('body'); 
	} 
	
	
	$(document).on('focus', '.datepickerforward, .datepickerbackward', function(event){
		    
			event.preventDefault();
			$(this).datepicker({
				format: 'mm/dd/yyyy',
				todayHighlight:'TRUE',
			    endDate: '-0d',
				autoclose: true,

			});
		});
		
		$(document).on('focus', '.datepicker', function(event){
			
			
			$(this).datepicker({
				format: 'mm/dd/yyyy',
				autoclose: true,

			});
		});
		
		
		
		
		!function($) {
    
    "use strict";// jshint ;_;

    if (typeof ko != 'undefined' && ko.bindingHandlers && !ko.bindingHandlers.multiselect) {
        ko.bindingHandlers.multiselect = {
            init : function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {},
            update : function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
                var ms = $(element).data('multiselect');
                if (!ms) {
                    $(element).multiselect(ko.utils.unwrapObservable(valueAccessor()));
                }
                else if (allBindingsAccessor().options && allBindingsAccessor().options().length !== ms.originalOptions.length) {
                    ms.updateOriginalOptions();
                    $(element).multiselect('rebuild');
                }
            }
        };
    }

    function Multiselect(select, options) {

        this.options = this.mergeOptions(options);
        this.$select = $(select);
        
        // Initialization.
        // We have to clone to create a new reference.
        this.originalOptions = this.$select.clone()[0].options;
        this.query = '';
        this.searchTimeout = null;
        
        this.options.multiple = this.$select.attr('multiple') == "multiple";
        this.options.onChange = $.proxy(this.options.onChange, this);
        
        // Build select all if enabled.
        this.buildContainer();
        this.buildButton();
        this.buildSelectAll();
        this.buildDropdown();
        this.buildDropdownOptions();
        this.buildFilter();
        this.updateButtonText();

        this.$select.hide().after(this.$container);
    };

    Multiselect.prototype = {
        
        // Default options.
        defaults: {
            // Default text function will either print 'None selected' in case no
            // option is selected, or a list of the selected options up to a length of 3 selected options.
            // If more than 3 options are selected, the number of selected options is printed.
            buttonText: function(options, select) {
                if (options.length == 0) {
                    return this.nonSelectedText + ' <b class="caret"></b>';
                }
                else {
                    
                    if (options.length > 5) {
                        return options.length + ' ' + this.nSelectedText + ' <b class="caret"></b>';
                    }
                    else {
                        var selected = '';
                        options.each(function() {
                            var label = ($(this).attr('label') !== undefined) ? $(this).attr('label') : $(this).html();
                            
                            //Hack by Victor Valencia R.
                            if($(select).hasClass('multiselect-icon')){
                                var icon = $(this).data('icon');
                                label = '<span class="glyphicon ' + icon + '"></span> ' + label;
                            }
                            
                            selected += label + ', ';
                        });
                        return selected.substr(0, selected.length - 2) + ' <b class="caret"></b>';
                    }
                }
            },
            // Like the buttonText option to update the title of the button.
            buttonTitle: function(options, select) {
                
                if (options.length == 0) {
                    return this.nonSelectedText;
                }
                else {
                    var selected = '';
                    options.each(function () {
                        //selected += $(this).text() + ', ';
                        selected += $(this).val() + ', ';
                    });
                   
                    var field_text = selected.split(",");
                   
                    //ajax code
                    return selected.substr(0, selected.length - 2);
                }
            },
            // Is triggered on change of the selected options.
            onChange : function(option, checked) {
                    
            },
            buttonClass: 'btn',
            dropRight: false,
            selectedClass: 'active',
            buttonWidth: '100%',
            buttonContainer: '<div class="btn-group custom-btn" />',
            // Maximum height of the dropdown menu.
            // If maximum height is exceeded a scrollbar will be displayed.
            maxHeight: false,
            includeSelectAllOption: false,
            selectAllText: ' Select all',
            selectAllValue: 'multiselect-all',
            enableFiltering: false,
            enableCaseInsensitiveFiltering: false,
            filterPlaceholder: 'Search',
            // possible options: 'text', 'value', 'both'
            filterBehavior: 'text',
            preventInputChangeEvent: false,        
            nonSelectedText: 'None selected',            
            nSelectedText: 'selected'
        },
        
        // Templates.
        templates: {
            button: '<button type="button" class="multiselect dropdown-toggle form-control" data-toggle="dropdown"></button>',
            ul: '<ul class="multiselect-container dropdown-menu custom-multi"></ul>',
            filter: '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text"></div>',
            li: '<li><a href="javascript:void(0);"><label></label></a></li>',
            liGroup: '<li><label class="multiselect-group"></label></li>'
        },
        
        constructor: Multiselect,
        
        buildContainer: function() {
            this.$container = $(this.options.buttonContainer);
        },
        
        buildButton: function() {
            // Build button.
            this.$button = $(this.templates.button).addClass(this.options.buttonClass);
            
            // Adopt active state.
            if (this.$select.prop('disabled')) {
                this.disable();
            }
            else {
                this.enable();
            }
           
            // Manually add button width if set.
            if (this.options.buttonWidth) {
                this.$button.css({
                    'width' : this.options.buttonWidth
                });
            }

            // Keep the tab index from the select.
            var tabindex = this.$select.attr('tabindex');
            if (tabindex) {
                this.$button.attr('tabindex', tabindex);
            }
           
            this.$container.prepend(this.$button)
        },
        
        // Build dropdown container ul.
        buildDropdown: function() {
            
            // Build ul.
            this.$ul = $(this.templates.ul);
            
            if (this.options.dropRight) {
                this.$ul.addClass('pull-right');
            }
            
            // Set max height of dropdown menu to activate auto scrollbar.
            if (this.options.maxHeight) {
                // TODO: Add a class for this option to move the css declarations.
                this.$ul.css({
                    'max-height': this.options.maxHeight + 'px',
                    'overflow-y': 'auto',
                    'overflow-x': 'hidden'
                });
            }
            
            this.$container.append(this.$ul)
        },
        
        // Build the dropdown and bind event handling.
        buildDropdownOptions: function() {
            
            this.$select.children().each($.proxy(function(index, element) {
                // Support optgroups and options without a group simultaneously.
                var tag = $(element).prop('tagName').toLowerCase();
                if (tag == 'optgroup') {
                    this.createOptgroup(element);
                }
                else if (tag == 'option') {
                    this.createOptionValue(element);
                }
                // Other illegal tags will be ignored.
            }, this));

            // Bind the change event on the dropdown elements.
            $('li input', this.$ul).on('change', $.proxy(function(event) {
                var checked = $(event.target).prop('checked') || false;
                var isSelectAllOption = $(event.target).val() == this.options.selectAllValue;

                // Apply or unapply the configured selected class.
                if (this.options.selectedClass) {
                    if (checked) {
                        $(event.target).parents('li').addClass(this.options.selectedClass);
                    }
                    else {
                        $(event.target).parents('li').removeClass(this.options.selectedClass);
                    }
                }
                
                // Get the corresponding option.
                var value = $(event.target).val();
                var $option = this.getOptionByValue(value);

                var $optionsNotThis = $('option', this.$select).not($option);
                var $checkboxesNotThis = $('input', this.$container).not($(event.target));

                // Toggle all options if the select all option was changed.
                if (isSelectAllOption) {
                    $checkboxesNotThis.filter(function() {
                        return $(this).is(':checked') != checked;
                    }).trigger('click');
                }

                if (checked) {
                    $option.prop('selected', true);

                    if (this.options.multiple) {
                        // Simply select additional option.
                        $option.prop('selected', true);
                    }
                    else {
                        // Unselect all other options and corresponding checkboxes.
                        if (this.options.selectedClass) {
                            $($checkboxesNotThis).parents('li').removeClass(this.options.selectedClass);
                        }

                        $($checkboxesNotThis).prop('checked', false);
                        $optionsNotThis.prop('selected', false);

                        // It's a single selection, so close.
                        this.$button.click();
                    }

                    if (this.options.selectedClass == "active") {
                        $optionsNotThis.parents("a").css("outline", "");
                    }
                }
                else {
                    // Unselect option.
                    $option.prop('selected', false);
                }

                this.updateButtonText();
                this.$select.change();
                this.options.onChange($option, checked);
                
                if(this.options.preventInputChangeEvent) {
                    return false;
                }
            }, this));

            $('li a', this.$ul).on('touchstart click', function(event) {
                event.stopPropagation();
                $(event.target).blur();
            });

            // Keyboard support.
            this.$container.on('keydown', $.proxy(function(event) {
                if ($('input[type="text"]', this.$container).is(':focus')) {
                    return;
                }
                if ((event.keyCode == 9 || event.keyCode == 27) && this.$container.hasClass('open')) {
                    // Close on tab or escape.
                    this.$button.click();
                }
                else {
                    var $items = $(this.$container).find("li:not(.divider):visible a");

                    if (!$items.length) {
                        return;
                    }

                    var index = $items.index($items.filter(':focus'));

                    // Navigation up.
                    if (event.keyCode == 38 && index > 0) {
                        index--;
                    }
                    // Navigate down.
                    else if (event.keyCode == 40 && index < $items.length - 1) {
                        index++;
                    }
                    else if (!~index) {
                        index = 0;
                    }

                    var $current = $items.eq(index);
                    $current.focus();

                    if (event.keyCode == 32 || event.keyCode == 13) {
                        var $checkbox = $current.find('input');

                        $checkbox.prop("checked", !$checkbox.prop("checked"));
                        $checkbox.change();
                    }

                    event.stopPropagation();
                    event.preventDefault();
                }
            }, this));
        },
        
        // Will build an dropdown element for the given option.
        createOptionValue: function(element) {
            if ($(element).is(':selected')) {
                $(element).prop('selected', true);
            }

            // Support the label attribute on options.
            var label = $(element).attr('label') || $(element).html();            
            var value = $(element).val();
                        
            //Hack by Victor Valencia R.            
            if($(element).parent().hasClass('multiselect-icon') || $(element).parent().parent().hasClass('multiselect-icon')){                                
                var icon = $(element).data('icon');
                label = '<span class="glyphicon ' + icon + '"></span> ' + label;
            } 
            
            var inputType = this.options.multiple ? "checkbox" : "radio";

            var $li = $(this.templates.li);
            $('label', $li).addClass(inputType);
            $('label', $li).append('<input type="' + inputType + '" />');
            
            //Hack by Victor Valencia R.
            if(($(element).parent().hasClass('multiselect-icon') || $(element).parent().parent().hasClass('multiselect-icon')) && inputType == 'radio'){                
                $('label', $li).css('padding-left', '0px');
                $('label', $li).find('input').css('display', 'none');
            }

            var selected = $(element).prop('selected') || false;
            var $checkbox = $('input', $li);
            $checkbox.val(value);

            if (value == this.options.selectAllValue) {
                $checkbox.parent().parent().addClass('multiselect-all');
            }

            $('label', $li).append(" " + label);

            this.$ul.append($li);

            if ($(element).is(':disabled')) {
                $checkbox.attr('disabled', 'disabled').prop('disabled', true).parents('li').addClass('disabled');
            }

            $checkbox.prop('checked', selected);

            if (selected && this.options.selectedClass) {
                $checkbox.parents('li').addClass(this.options.selectedClass);
            }
        },

        // Create optgroup.
        createOptgroup: function(group) {
            var groupName = $(group).prop('label');

            // Add a header for the group.
            var $li = $(this.templates.liGroup);
            $('label', $li).text(groupName);
            
            //Hack by Victor Valencia R.
            $li.addClass('text-primary');
            
            this.$ul.append($li);
            
            // Add the options of the group.
            $('option', group).each($.proxy(function(index, element) {                
                this.createOptionValue(element);
            }, this));
        },
        
        // Add the select all option to the select.
        buildSelectAll: function() {
            var alreadyHasSelectAll = this.$select[0][0] ? this.$select[0][0].value == this.options.selectAllValue : false;
            // If options.includeSelectAllOption === true, add the include all checkbox.
            if (this.options.includeSelectAllOption && this.options.multiple && !alreadyHasSelectAll) {
                this.$select.prepend('<option value="' + this.options.selectAllValue + '">' + this.options.selectAllText + '</option>');
            }
        },
        
        // Build and bind filter.
        buildFilter: function() {
            
            // Build filter if filtering OR case insensitive filtering is enabled and the number of options exceeds (or equals) enableFilterLength.
            if (this.options.enableFiltering || this.options.enableCaseInsensitiveFiltering) {
                var enableFilterLength = Math.max(this.options.enableFiltering, this.options.enableCaseInsensitiveFiltering);
                if (this.$select.find('option').length >= enableFilterLength) {
                    
                    this.$filter = $(this.templates.filter);
                    $('input', this.$filter).attr('placeholder', this.options.filterPlaceholder);
                    this.$ul.prepend(this.$filter);

                    this.$filter.val(this.query).on('click', function(event) {
                        event.stopPropagation();
                    }).on('keydown', $.proxy(function(event) {
                        // This is useful to catch "keydown" events after the browser has updated the control.
                        clearTimeout(this.searchTimeout);

                        this.searchTimeout = this.asyncFunction($.proxy(function() {

                            if (this.query != event.target.value) {
                                this.query = event.target.value;

                                $.each($('li', this.$ul), $.proxy(function(index, element) {
                                    var value = $('input', element).val();
                                    if (value != this.options.selectAllValue) {
                                        var text = $('label', element).text();
                                        var value = $('input', element).val();
                                        if (value && text && value != this.options.selectAllValue) {
                                            // by default lets assume that element is not
                                            // interesting for this search
                                            var showElement = false;

                                            var filterCandidate = '';
                                            if ((this.options.filterBehavior == 'text' || this.options.filterBehavior == 'both')) {
                                                filterCandidate = text;
                                            }
                                            if ((this.options.filterBehavior == 'value' || this.options.filterBehavior == 'both')) {
                                                filterCandidate = value;
                                            }

                                            if (this.options.enableCaseInsensitiveFiltering && filterCandidate.toLowerCase().indexOf(this.query.toLowerCase()) > -1) {
                                                showElement = true;
                                            }
                                            else if (filterCandidate.indexOf(this.query) > -1) {
                                                showElement = true;
                                            }

                                            if (showElement) {
                                                $(element).show();
                                            }
                                            else {
                                                $(element).hide();
                                            }
                                        }
                                    }
                                }, this));
                            }
                        }, this), 300, this);
                    }, this));
                }
            }
        },

        // Destroy - unbind - the plugin.
        destroy: function() {
            this.$container.remove();
            this.$select.show();
        },

        // Refreshs the checked options based on the current state of the select.
        refresh: function() {
            $('option', this.$select).each($.proxy(function(index, element) {
                var $input = $('li input', this.$ul).filter(function() {
                    return $(this).val() == $(element).val();
                });

                if ($(element).is(':selected')) {
                    $input.prop('checked', true);

                    if (this.options.selectedClass) {
                        $input.parents('li').addClass(this.options.selectedClass);
                    }
                }
                else {
                    $input.prop('checked', false);

                    if (this.options.selectedClass) {
                        $input.parents('li').removeClass(this.options.selectedClass);
                    }
                }

                if ($(element).is(":disabled")) {
                    $input.attr('disabled', 'disabled').prop('disabled', true).parents('li').addClass('disabled');
                }
                else {
                    $input.prop('disabled', false).parents('li').removeClass('disabled');
                }
            }, this));

            this.updateButtonText();
        },

        // Select an option by its value or multiple options using an array of values.
        select: function(selectValues) {
            if(selectValues && !$.isArray(selectValues)) {
                selectValues = [selectValues];
            }
            
            for (var i = 0; i < selectValues.length; i++) {
                
                var value = selectValues[i];
                
                var $option = this.getOptionByValue(value);
                var $checkbox = this.getInputByValue(value);

                if (this.options.selectedClass) {
                    $checkbox.parents('li').addClass(this.options.selectedClass);
                }

                $checkbox.prop('checked', true);
                $option.prop('selected', true);                
                this.options.onChange($option, true);
            }

            this.updateButtonText();
        },

        // Deselect an option by its value or using an array of values.
        deselect: function(deselectValues) {
            if(deselectValues && !$.isArray(deselectValues)) {
                deselectValues = [deselectValues];
            }

            for (var i = 0; i < deselectValues.length; i++) {
                
                var value = deselectValues[i];
                
                var $option = this.getOptionByValue(value);
                var $checkbox = this.getInputByValue(value);

                if (this.options.selectedClass) {
                    $checkbox.parents('li').removeClass(this.options.selectedClass);
                }

                $checkbox.prop('checked', false);
                $option.prop('selected', false);               
                this.options.onChange($option, false);
            }

            this.updateButtonText();
        },

        // Rebuild the whole dropdown menu.
        rebuild: function() {
            this.$ul.html('');
            
            // Remove select all option in select.
            $('option[value="' + this.options.selectAllValue + '"]', this.$select).remove();
            
            // Important to distinguish between radios and checkboxes.
            this.options.multiple = this.$select.attr('multiple') == "multiple";
            
            this.buildSelectAll();
            this.buildDropdownOptions();
            this.updateButtonText();
            this.buildFilter();
        },
        
        // Build select using the given data as options.
        dataprovider: function(dataprovider) {
            var optionDOM = "";
            dataprovider.forEach(function (option) {
                optionDOM += '<option value="' + option.value + '">' + option.label + '</option>';
            });

            this.$select.html(optionDOM);
            this.rebuild();
        },

        // Enable button.
        enable: function() {
            this.$select.prop('disabled', false);
            this.$button.prop('disabled', false)
                .removeClass('disabled');
        },

        // Disable button.
        disable: function() {
            this.$select.prop('disabled', true);
            this.$button.prop('disabled', true)
                .addClass('disabled');
        },

        // Set options.
        setOptions: function(options) {
            this.options = this.mergeOptions(options);
        },

        // Get options by merging defaults and given options.
        mergeOptions: function(options) {
            return $.extend({}, this.defaults, options);
        },
        
        // Update button text and button title.
        updateButtonText: function() {
            var options = this.getSelected();
           
            // First update the displayed button text.
            $('button', this.$container).html(this.options.buttonText(options, this.$select));            
            
            // Now update the title attribute of the button.
            $('button', this.$container).attr('title', this.options.buttonTitle(options, this.$select));
            
        },

        // Get all selected options.
        getSelected: function() {
           
            return $('option[value!="' + this.options.selectAllValue + '"]:selected', this.$select).filter(function() {
                return $(this).prop('selected');
            });
        },
        
        // Get the corresponding option by ts value.
        getOptionByValue: function(value) {
            return $('option', this.$select).filter(function() {
                return $(this).val() == value;
            });
        },
        
        // Get an input in the dropdown by its value.
        getInputByValue: function(value) {
            return $('li input', this.$ul).filter(function() {
                return $(this).val() == value;
            });
        },
        
        updateOriginalOptions: function() {
            this.originalOptions = this.$select.clone()[0].options;
        },

        asyncFunction: function(callback, timeout, self) {
            var args = Array.prototype.slice.call(arguments, 3);
            return setTimeout(function() {
                callback.apply(self || window, args);
            }, timeout);
        }
    };

    $.fn.multiselect = function(option, parameter) {
        return this.each(function() {
            var data = $(this).data('multiselect'), options = typeof option == 'object' && option;

            // Initialize the multiselect.
            if (!data) {
                $(this).data('multiselect', ( data = new Multiselect(this, options)));
            }

            // Call multiselect method.
            if ( typeof option == 'string') {
                data[option](parameter);
            }
        });
    };

    $.fn.multiselect.Constructor = Multiselect;
    
    // Automatically init selects by their data-role.
    $(function() {
        $("select[role='multiselect']").multiselect();
    });

}(window.jQuery);


	
	
	
	</script>

<!-- End Student Info -->


<style>
    #xmyModal2 .modal-dialog.modal-lg {
    width: 800px ! important;
    padding:10px ! important;
}
#xmyModal2 .modal-dialog.modal-lg .modal-content {
    width: 100% ! important;
    min-width: 100% ! important;
    height: 380px;
}
#xmyModal2 .modal-body.Add_ScholarShip {
    padding: 20px 0 0 0!important;
}
</style>



 
    
    



    
</script>

<script>
    	// Start Fwd: New Field Database 15-Nov-2023
        $(document).on('keyup blur','#ssn',function(event){
            
            var input = event.target;
            var value = input.value.replace(/\D/g, '');
            //var formattedValue = value.replace(/^(\d{3})(\d{2})(\d{4})$/, '$1-$2-$3');
            var formattedValue = value.replace(/^(\d{3})(\d{0,2})(\d{0,4})$/, function(_, p1, p2, p3) {
              var parts = [p1];
              if (p2) parts.push('-' + p2);
              if (p3) parts.push('-' + p3);
              return parts.join('');
            });
            
            $(this).val(formattedValue);
            
        })
        
        // End Fwd: New Field Database 15-Nov-2023  
</script>
		  

<!-- Modal -->
  <div class="modal fade" id="view_note_detail_modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title view_title_modal"></h4>
        </div>
        <div class="modal-body view_detail_modal" style="max-height:300px;overflow-y:scroll;">
          <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- ============================================================== -->
<!-- End Content here -->
<!-- ============================================================== -->    


         
<footer class="footer text-right" style="display:none;">
    2022 Â© All right reserved. confidential information subject to USA law

        <!--
    <div>
            <strong>Last Login:</strong>
    June 27, 2025, 12:04:59 am<br>
                    <strong>User IP:</strong>
    115.241.72.202    </div>
        <div>
            <strong>Last Login:</strong>
    January 1, 1970, 12:00:00 am<br>
            <strong>User IP:</strong>
        </div>
    -->
    </footer>
</div>

</div>
<!-- END wrapper -->
<div id="download-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" 	style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content p-0 b-0">
			<div class="row">
				<!-- Basic example -->
				<div class="col-md-12">																						
					<h2>Report is downloaded<h2>   																				
				</div> 
			</div><!-- row-->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<script>




// By Prabhat 17-11-2020
    $(document).ready(function(){
        var str = window.location.href;
        var n = str.lastIndexOf('#');
        var result = str.substring(n + 1);
        if(result == 'tab15' || result == 'tab3'){
            $('#'+result).show();
        }
    })

$("document").ready(function() {
        $('.filter_category').on('click', function(e) {
        e.stopPropagation();  
      });
    });

    var resizefunc = [];
    $('.name_validation').bind('keyup blur', function(){    
		$(this).val( $(this).val().replace(/[^a-zA-Z-'._ ]/g,'') );  
		//$(this).val( $(this).val().replace(/[^0-9()+-Xx ]/g,'') );  
		//$(this).val( $(this).val().replace(/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]/g,'') );
	});
</script>

<style type="text/css">
    #user_name,#mother_name,#father_name,#pan,#account_holder_name,#ifsc
    {
        text-transform:uppercase;
    }
    input[name="address1"],input[name="address2"],input[name="branch_name"]
    {
        text-transform:capitalize;	
    }

</style>

<!-- jQuery  -->

<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/waves.js') ?>"></script>
<script src="<?= base_url('assets/js/wow.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.nicescroll.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/jquery.scrollTo.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery-detectmobile/detect.js') ?>"></script>
<script src="<?= base_url('assets/js/fastclick/fastclick.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery-slimscroll/jquery.slimscroll.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery-blockui/jquery.blockUI.js') ?>"></script>


<!--Form Validation-->
<script src="<?= base_url('assets/js/bootstrap-validator.min.js') ?>"></script>

<!-- CUSTOM JS -->
<script src="<?= base_url('assets/js/jquery.app.js') ?>"></script>

<!-- DATE PICKER -->
<script src="<?= base_url('assets/timepicker/bootstrap-timepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/timepicker/bootstrap-datepicker.js') ?>"></script>

<!-- DATA TABLES JS -->
<!--<script src="<?= base_url('admin/Form/submitstudentinfo') ?>/datatables/jquery.dataTables.min.js"></script> -->

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/datatables/dataTables.bootstrap.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>


<!-- Modal-Effect -->
<script src="<?= base_url('assets/modal-effect/js/classie.js') ?>"></script>
<script src="<?= base_url('assets/modal-effect/js/modalEffects.js') ?>"></script>

<!--bootstrap-wysihtml5-->
<script type="text/javascript" src="<?= base_url('assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js') ?>"></script>

<!--form validation init-->
<script src="<?= base_url('assets/summernote/summernote.min.js') ?>"></script>

<!-- wizard  -->

<script src="<?= base_url('assets/js/jquery.steps.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/js/wizard-init.js') ?>"></script>

<!--script for nestable tab only-->
<script src="<?= base_url('assets/js/jquery.nestable.js') ?>"></script>
<script src="<?= base_url('assets/js/nestable.js') ?>"></script>


<script src="<?= base_url('assets/js/bootstrap-filestyle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.mask.min.js') ?>"></script>



<script type="text/javascript">
$(window).load(function(){
   // PAGE IS FULLY LOADED  
   // FADE OUT YOUR OVERLAYING DIV
   $('#loader-block').fadeOut();
});
    // nultiple initialize
    $('.uploadfiles').filestyle({
        buttonName : 'btn-primary'
    });
</script>
<script>
	$('#country-list').DataTable( {
	    
	    
	    "lengthMenu": [[10, 25, 100, 600,  -1], [10, 25,100, 600,  "All"]],
        
		"pageLength": 100,
	    
        
    } );
	
	/*$('#alldataTable').DataTable( {
        "lengthMenu": [[ -1], ["All"]]
    } );
	*/
</script>
<script type="text/javascript">
$(document).ready(function() {
    // apoorv 12/06/2020
    let viewAppListDataTable = $('#viewAppListDataTable').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'searching' : false,
          "pageLength": 50,
           "dom": '<"top"lBfrtip<"clear">>rt<"bottom"ip<"clear">>',
           'ajax': {
             'url':'<?= base_url('admin/Form/getNameList') ?>',
             'data': function(data) {
                 // send the custom fields to the backend. like firstname lastname etc.
                 let role_val = [];
                 
                 $('.filter_themeBtn').each(function () {
                    role_val.push($(this).attr('data-name'));
                 });
                 
                 data.csrf_token = "271dcfee4f1f3de8044f1f667bc664d4";
                 data.searchFirstName = $('#searchFirstName').val();
                 data.searchLastName = $('#searchLastName').val();
                 data.searchSpouse = $('#searchSpouse').val();
                 data.searchCompany = $('#searchCompany').val();
				 data.searchContactId = $('#contactId').val();
                 data.firstNameFocus = $('#searchFirstName').is(':focus');
                 data.lastNameFocus = $('#searchLastName').is(':focus');
                 data.spouseFocus = $('#searchSpouse').is(':focus');
                 data.companyFocus = $('#searchCompany').is(':focus');
				 data.ContactIdFocus = $('#contactId').is(':focus');
				 data.role_val  = role_val;
				 
             }
          },
          'order': [],
          'columns': [
             {data: 'action',  orderable: false, searchable: false},
             { data: 'ContactId', name: 'ContactId', orderable: false, searchable: true },
             { data: 'FirstName', name: 'FirstName', orderable: false, searchable: true },
             { data: 'LastName', name: 'LastName', orderable: false, searchable: true },
             { data: 'Spouse', name: 'Spouse', orderable: false, searchable: true },
             { data: 'Company', name: 'Company', orderable: false, searchable: true} 
          ],
          
          "drawCallback" : function( data ) {
              /*$('#viewAppListDataTable_length').html(function(_, text) {
              return text.replace('entries', '');
            });*/
            
             /*$('#viewAppListDataTable').DataTable({
                "lengthMenu": [10, 25, 50, 100], // Customize the page length options
                "pageLength": 50, // Set the initial page length
              });*/
              
              
              // render data  and set the corrcet focus and value for the field after table is drwn.
              let searchFirstName = data.json.searchFirstName;
              let searchLastName = data.json.searchLastName;
              let searchSpouse = data.json.searchSpouse;
              let searchCompany = data.json.searchCompany;
			  let searchContact = data.json.SearchContactId;
              let firstNameFocus = data.json.firstNameFocus;
              let lastNameFocus = data.json.lastNameFocus;
              let spouseFocus = data.json.spouseFocus;
              let companyFocus = data.json.companyFocus;
			  let contactFocus = data.json.ContactIdFocus;										  
              let table = document.querySelector('#viewAppListDataTable');
              let row = table.insertRow(1);
              let cell0 = row.insertCell(0);
              let cell1 = row.insertCell(1);
              let cell2 = row.insertCell(2);
              let cell3 = row.insertCell(3);
              let cell4 = row.insertCell(4);
              let cell5 = row.insertCell(5);
              cell0.innerHTML = `Filter`;
              cell1.innerHTML = `<input style="width: 100%;" type="text" autocomplete="off" id="contactId" placeholder="Contact ID" class="form-control num" autocomplete="off">`;
              cell2.innerHTML = `<input style="width: 100%;" type="text" id="searchFirstName" placeholder="First Name"  class="form-control" autocomplete="off">`;
              cell3.innerHTML = ` <input style="width: 100%;" type="text" id="searchLastName" placeholder="Last Name" class="form-control" autocomplete="off">`;
              cell4.innerHTML = `<input style="width: 100%;" type="text" id="searchSpouse" placeholder="Spouse" class="form-control" autocomplete="off">`;
              cell5.innerHTML = `<input style="width: 100%;" type="text" id="searchCompany" placeholder="Company" class="form-control" autocomplete="off">`;
              
			if(searchContact != null){
                  document.querySelector('#contactId').value = searchContact;
                if(contactFocus == "true")
                    document.querySelector('#contactId').focus();
              }
              if(searchFirstName != null) {
                document.querySelector('#searchFirstName').value = searchFirstName;
                if(firstNameFocus == "true")
                    document.querySelector('#searchFirstName').focus();
              }
              if(searchLastName != null) {
                document.querySelector('#searchLastName').value = searchLastName;
                if(lastNameFocus == "true")
                    document.querySelector('#searchLastName').focus();
              }
              if(searchSpouse != null) {
                document.querySelector('#searchSpouse').value = searchSpouse;
                if(spouseFocus == "true")
                    document.querySelector('#searchSpouse').focus();
              }
              if(searchCompany != null) {
                document.querySelector('#searchCompany').value = searchCompany;
                if(companyFocus == "true")
                    document.querySelector('#searchCompany').focus();
              }
              
              // add event listeners
              /*$('#searchFirstName').keyup(function(){
                    viewAppListDataTable.draw();
               });
                
                 $('#searchLastName').keyup(function(){
                    viewAppListDataTable.draw();
              });
       
                $('#searchSpouse').keyup(function(){
                  viewAppListDataTable.draw();
               });
               
                $('#searchCompany').keyup(function(){
                   viewAppListDataTable.draw();
               });*/
			   
			   var typingTimer;                
                var doneTypingInterval = 1300;
                var $FirstName = $('#searchFirstName');
                var $LastName  = $('#searchLastName');
                var $searchSpouse  = $('#searchSpouse');
                var $searchCompany  = $('#searchCompany');
				var $contactId = $('#contactId');
                
                
                //on keyup, start the countdown
                $FirstName.on('keyup', function () {
                  clearTimeout(typingTimer);
                  typingTimer = setTimeout(doneTyping, doneTypingInterval);
                });
                
				$contactId.on('keyup', function () {
                  clearTimeout(typingTimer);
                  typingTimer = setTimeout(doneTyping, doneTypingInterval);
                });
                //on keydown, clear the countdown 
                $LastName.on('keydown', function () {
                  clearTimeout(typingTimer);
                  typingTimer = setTimeout(doneTyping, doneTypingInterval);
                });
                
                $searchSpouse.on('keydown', function () {
                  clearTimeout(typingTimer);
                  typingTimer = setTimeout(doneTyping, doneTypingInterval);
                });
                
                $searchCompany.on('keydown', function () {
                  clearTimeout(typingTimer);
                  typingTimer = setTimeout(doneTyping, doneTypingInterval);
                });
                
                
                //user is "finished typing," do something
                function doneTyping () {
                    
                  viewAppListDataTable.draw();
                }
			   
               
            },
           "columnDefs": [
            { "width": "10%", "targets": 1 }
          ]
        });
        
       
    
     
     
     
    /* $(document).on('click','.filter_help',function(){
            $('.pop').toggleClass('popOut');
             
            if($('.pop'). hasClass('popOut')){
                $('.filter_remove_button').show();
            }
            else{
                 $('.filter_remove_button').show();
              //  viewAppListDataTable.draw();
            }
     })*/
     
     $(document).on('click','.filterTagButton',function(e){
         e.stopPropagation();  
            $('.pop').removeClass('popOut');
            $('.filter_remove_button').show();
            viewAppListDataTable.draw();
     })
     
      $(document).on('click','.filter_themeBtn',function(e){
         e.stopPropagation();  
      })
     
     $(document).on('click','.filter_search_box',function(){
         $('.pop').toggleClass('popOut');
     })
     
     $(document).on('click','.filter_remove_button',function(){
        
         if($('.filter_themeBtn').length == 0){
             $('.filter_text').show();
         }
         viewAppListDataTable.draw();
     })
     
      
    // end of apoorv
    // apoorv 6/06/2020
    $('#courseListDataTable').DataTable( {
        //"lengthMenu": [[ -1], ["All"]],
        "lengthMenu": [[10, 25, 100, 600,  -1], [10, 25,100, 600,  "All"]],
        "order": [[ 0, "desc" ]],
		"pageLength": 100,
		fixedColumns: true,
		'columnDefs': [{
            'targets': [1,2,3,4,7,8,9,10,11,12], /* column index */
            'orderable': false, /* true or false */
         },
        
         
          ]
         
    } );
    // end of apoorv 
    $('#alldataTable').DataTable( {
        "order": [[ 0, "desc" ]],
		"pageLength": 25
    } );
	
	$('#contract_dataTable').DataTable( {
       "order": [],
		"pageLength": 25,
        'columnDefs': [ {
            'targets': [4,5,6,7,8,9,10,11,12,13], // column index (start from 0)
            'orderable': false, // set orderable false for selected columns
        }],
    } );
	
	
	
} );
</script>
    <script>
      $(document).ready(function () {
      $('#user_image').change(function () {
      var val = $(this).val().toLowerCase();
      var regex = new RegExp("(.*?)\.(jpg|png|jpeg)$");
       if(!(regex.test(val))) {
	   alert('Please select only jpg,jpeg,png file');
	   $("#user_image").val("");
	   } }); });
    </script>
  <script> 
	$(document).on('change','.start_date',function(){
		var start_date = $(this).val();
		var end_date   = $(this).closest('tr').find(".end_date").val();
		
		if(start_date != '' && end_date != ''){
			var d1 = new Date(format(start_date));
			var d2 = new Date(format(end_date));
			
			if(d1 >= d2 && end_date!=''){
				$(this).val('');
				alert('End date should be greater than start date');
			}else{
				var months = cal_month(d1, d2);
				$(this).closest('tr').find(".month_experience").val(months);
			}
		}
	});  
 </script> 

<script type="text/javascript">

    $(document).ready(function() {
		$('li.tab').css('width', '10%');
		$('.tab_style').css('width', '');
		$('.indicator').css('right', '1155px');
		
		$('form').on('focus', '.datepicker', function(event){
        	event.preventDefault();
        	$(this).datepicker({
        		format: 'mm/dd/yyyy',
        		autoclose: true,
        	});
        });
		
        $('.datepickerforward').datepicker({
            format: 'mm/dd/yyyy',
            todayHighlight:'TRUE',
            startDate: '-0d',
            autoclose: true,
        });
		   
        
		
		$('form').on('focus', '.datepickerforward, .datepickerbackward', function(event){
			event.preventDefault();
			$(this).datepicker({
				format: 'mm/dd/yyyy',
				todayHighlight:'TRUE',
			    endDate: '-0d',
				autoclose: true,

			});
		});
		
		
		
		
        $('.datatable').dataTable();
        //apoorv 12/06/2020
        $('#viewfilter_reportDataTable').DataTable({
           "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            } 
        });
        // end of apoorv 
    	// DataTable initialisation
    	$('#classListing').DataTable({
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": false,
			"autoWidth": true,
			"buttons": [{
				text: '<i class="fa fa-file-excel-o"></i> Excel',
				extend: 'excelHtml5',
				filename: '2025-06-27_class_listing_reports',
				footer: true,
				title:'',
				id:'classlistexl'

			}
			],
			"order": [],
		});
		
		$('#classPassportListings').DataTable({
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": false,
			"autoWidth": true,
			"buttons": [{
				text: '<i class="fa fa-file-excel-o"></i> Excel',
				extend: 'excelHtml5',
				filename: '2025-06-27_passport_listing_reports',
				footer: true,
				title:'',
				id:'classlistexl'

			}
			]
		});
		
		
		$('#SemesterListing').DataTable({
			"dom": '<"dt-buttons excel_position"Bf><"clear">lirtp',
			"paging": false,
			"autoWidth": true,
			"buttons": [{
				text: '<span class=""><i class="fa fa-file-excel-o"></i> Excel</span>',
				extend: 'excelHtml5',
				filename: '2025-06-27_Semester_listing_reports',
				footer: true,
				/*responsive: true*/
				title:'',
				id:'classlistexl'

			}
			]
		});
		
  $('#SemesterListing1').DataTable({
			"dom": '<"dt-buttons excel_position"Bf><"clear">lirtp',
			"paging": false,
			"autoWidth": true,
			"buttons": [{
				text: '<span class=""><i class="fa fa-file-excel-o"></i> Excel</span>',
				extend: 'excelHtml5',
				filename: '2025-06-27_Semester_listing_reports',
				footer: true,
				/*responsive: true*/
				title:'',
				id:'classlistexl'

			}
			]
		});
		
		$('#vpireport').DataTable({
			dom: 'Bfrtip',
			buttons: [
				{
	                extend: 'excelHtml5',
	                filename: '2025-06-27 VIP Mailing List',
	                title: '',
	                fnComplete: function ( nButton, oConfig, oFlash, sFlash ) {
	                    alert( 'Excel-export complete' );
	                }
	            }
			]
		});

		var href = location.href;
		if(href.match(/([^\/]*)\/*$/)[1] == 'addVIPMailingList'){

			function firsttask(subject, callback) {
				$('.buttons-excel').click();
				
			  	callback();
			}

			function secondtask(){
				
                 Arrow.show();
				$(".modalpopupsss").modal("show");
				 setTimeout(function()
				 {
				     window.location.href='<?= base_url('admin/Form/ViewAppList') ?>';
					 },
					 3000
					 );
				
			}
			firsttask('abc', secondtask);
			
		}
		
	    // update 26-oct-2023
	    $('#contactReport').DataTable({
			dom: 'Bfrtip',
			buttons: [
				{
	                extend: 'excelHtml5',
	                filename: '2025-06-27_ContactExport',
	                title: '',
	                fnComplete: function ( nButton, oConfig, oFlash, sFlash ) {
	                    alert( 'Excel-export complete' );
	                }
	            }
			]
		});
		
	    if(href.match(/([^\/]*)\/*$/)[1] == 'exportContactDetails'){
			function firsttask(subject, callback) {
				$('.buttons-excel').click();
			  	callback();
			}
			function secondtask(){
                Arrow.show();
				$(".modalpopupsss").modal("show");
				    setTimeout(function(){
				        window.location.href='<?= base_url('admin/Form/ViewAppList') ?>';
				    },3000
				);
			}
			firsttask('abc', secondtask);
			
		}
	    // end 26-oct-2023

		//alert(document.referrer);
		//console.log(document.referrer);
		//console.log(window.history(-1));
		//var last_url = document.referrer;
		//if(last_url == 'addVIPMailingList'){
			//setTimeout(function(){
				//$('#download-modal').modal('show');
			//}, 5000);
		//}
		
		
		// general mailing list
		
		$('#generalreport').DataTable({
			dom: 'Bfrtip',
			buttons: [
				{
	                extend: 'excelHtml5',
	                filename: '2025-06-27 GENERAL Mailing List',
	                title: '',
	                fnComplete: function ( nButton, oConfig, oFlash, sFlash ) {
	                    alert( 'Excel-export complete' );
	                }
	            }
			]
		});
		
		var href = location.href;
		if(href.match(/([^\/]*)\/*$/)[1] == 'addGeneralMailingList'){

			function firsttask(subject, callback) {
				$('.buttons-excel').click();
			  	callback();
			}

			function secondtask(){
			 Arrow.show();
				$(".modalpopupsss").modal("show");
				 setTimeout(function()
				 {
					window.location.href='<?= base_url('admin/Form/ViewAppList') ?>';
					 },
					 3000
					 );
			}

			firsttask('abc', secondtask);
			
		}
		
		// donor mailing report
		
		
		
		 // By Prabhat Donation Report Excel
	    $('#donationreportexcel').DataTable({
			dom: 'Bfrtip',
			"order": [],
			buttons: [
				{
	                extend: 'excelHtml5',
	                filename: '2025-06-27 DonationReportExcel',
	                title: '',
	                fnComplete: function ( nButton, oConfig, oFlash, sFlash ) {
	                    alert( 'Excel-export complete' );
	                }
	            }
			]
		});
		
		var href = location.href;
		if(href.match(/([^\/]*)\/*$/)[1] == 'getDonationReportExcel'){

			function firsttask(subject, callback) {
				$('.buttons-excel').click();
			  	callback();
			}

			function secondtask(){
                 Arrow.show();
				$(".modalpopupsss").modal("show");
				 setTimeout(function()
				 {
				     window.location.href='<?= base_url('admin/Form/ViewAppList') ?>';
					 },
					 3000
					 );
				
			}
			firsttask('abc', secondtask);
		}
		
		
		
		
		var href = location.href;
		if(href.match(/([^\/]*)\/*$/)[1] == 'view_download_image'){

			function firsttask(subject, callback) {
				//$('.buttons-excel').click();
			  	callback();
			}

			function secondtask(){
                 Arrow.show();
				$(".modalpopupsss").modal("show");
				 setTimeout(function()
				 {
				     window.location.href='<?= base_url('admin/Reports/exportContactDetails') ?>';
				      
					 },
					 3000
					 );
					
				
			}
			firsttask('abc', secondtask);
   
		}
		
		
		
		// general mailing list
		
		$('#donormailreport').DataTable({
			dom: 'Bfrtip',
			
			buttons: [
				{
	                extend: 'excelHtml5',
	                 exportOptions: {
                        format: {
                            body: function ( data, row, column, node ) {
                                switch(column) {
                                    case 10: return '\u200C' + data;
                                    case 14: return '\u200C' + data;
                                    case 15: return '\u200C' + data;
                                    case 17: return '\u200C' + data;
                                    case 19: return '\u200C' + data;
                                    default: return data;
                                }
                            }
                        }
                    },
	                filename: '2025-06-27 Donor Mailing List',
	                title: '',
	                fnComplete: function ( nButton, oConfig, oFlash, sFlash ) {
	                    alert( 'Excel-export complete' );
	                }
	            }
			]
		});
		var href = location.href;
		if(href.match(/([^\/]*)\/*$/)[1] == 'addDonorMailingList'){
			function firsttask(subject, callback) {
				$('.buttons-excel').click();
			  	callback();
			}
			function secondtask(){
				 Arrow.show();
				$(".modalpopupsss").modal("show");
				 setTimeout(function()
				 {
				window.location.href='<?= base_url('admin/Form/ViewAppList') ?>';
					 },
					 3000
					 );
			}

			firsttask('abc', secondtask);
		}
		
		// downloaded excel report page
		
		
	$(document).on("click",".dt-button",function(){
		var href = location.href;
		if(href.match(/([^\/]*)\/*$/)[1] == 'classListing'){

			function firsttask(subject, callback) {
				//$('.buttons-excel').click();
			  	callback();
			}
			function secondtask(){
				 Arrow.show();
				$(".modalpopupsss").modal("show");
				 setTimeout(function()
				 {
				window.location.href='<?= base_url('admin/Reports/classListing') ?>';
					 },
					 3000
					 );
			}
			firsttask('abc', secondtask);
		}
		
	});
		
	
		
    });
</script> 


<script>
	function getstatedetails(id){
        //$('#block').html('<option value="" selected="selected" >Select Block</option>');
        //$('#village').html('<option value="" selected="selected" >Select Village</option>');
		var url = 'http://localhost:8080/'
        $.ajax({
            type: "POST",
            url: url+ 'project_fg/FG_UMS/SCBV/ajax_state_list',
            data: {'id':id},
            dataType: "html",
            success: function(data){
                $('#state').html(data);
            },
        });
    }

	
</script>

<script>
    // jQuery ".Class" SELECTOR.
    $(document).ready(function() {
        $(document).on('keypress', '.num', function (event) {
            return isNumber(event, this)
        });
    });


    $(document).ready(function() {
        $(document).on('keypress', '.char', function (event) {
            return ValidateAlpha(event, this)
        });
	
    });

    // apply mask for phone number
    $(document).ready(function(){
        $('input[name="phone"], input[name="fed_phone"]').mask('(000) 000 0000');
        $('input[name="fax_no"]').mask('+99-9999999999');
        $('input[name="employer_fax"]').mask('+99-9999999999');
        $('input[name="aadhar"]').mask('999999999999');
        $('input[name="aadhar_enroll_no"]').mask('9999/99999/99999');
        $('.year').mask('9999');
        $('.passedyear').mask('9999');
    });

    // validate email address

    function validateEmail(email) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	
        if (reg.test(email) == false) 
        {
            alert('Enter Valid E-mail Below Given Format \r\n email@subdomain.example.com or \r\n (testuser@gmail.com)');
            document.getElementById("email").value="";
            //return false;
        }
	
    }
	
	// validate alternative email
	
	function validateAlternateEmail(email) {
      var alt_reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	
	  if (alt_reg.test(email) == false) 
	  {
	  alert('Enter Valid E-mail Below Given Format \r\n email@subdomain.example.com or \r\n (testuser@gmail.com)');
      document.getElementById("alt_email").value="";
      }
	
    }
	
	
    // validate employer email 
	
    function validateEmployerEmail(email) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	
        if (reg.test(email) == false) 
        {
            alert('Enter Valid E-mail Below Given Format \r\n email@subdomain.example.com or \r\n (testuser@gmail.com)');
            document.getElementById("employer_email").value="";
        }
	
    }
	
		
    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {
        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
        //(charCode != 45 || $(element).val().indexOf('-') != -1) &&      // â€œ-â€� CHECK MINUS, AND ONLY ONE.
        (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // â€œ.â€� CHECK DOT, AND ONLY ONE.
        (charCode < 48 || charCode > 57) && (charCode != 8)){
            alert('Charcter not allowed');
            return false;
        }else{
            return true;
        }
    } 

</script>
<script>	
    function ValidateAlpha(key)
    {
	if ((key.charCode < 97 || key.charCode > 122) 
		&& (key.charCode < 65 || key.charCode > 90) 
		&& (key.charCode != 32) 
		&& (key.charCode != 46) 
		&& (key.charCode != 0)){
			
            alert('Only charcters are allowed');
            return false;
        }
        else
        {
            
			return true;
        }
    }
	
	 function ValidateAlphaNew(key)
    {
		//alert(key.charCode);
	if ((key.charCode < 97 || key.charCode > 122) 
		&& (key.charCode < 47|| key.charCode > 90) 
		&& (key.charCode != 32) 
		&& (key.charCode != 16) 
		&& (key.charCode != 34) 
		&& (key.charCode != 39) 
		&& (key.charCode != 44) 
		&& (key.charCode != 95) 
		&& (key.charCode != 45) 
		&& (key.charCode != 46) 
		&& (key.charCode != 0)){
			
            alert('Special charcters are Not Allowed');
            return false;
        }
        else
        {
            
			return true;
        }
    }
</script>
<script>
    $(function($) {

        // this script needs to be loaded on every page where an ajax POST may happen
        $.ajaxSetup({
            data: {
                'csrf_token' : '271dcfee4f1f3de8044f1f667bc664d4'
            }
        });

    });

    $('form').attr('autocomplete', 'off');
</script>
<script type="text/javascript">
    function clickPrint()
    {
        $('a').hide();
	
    }
</script>

<script type="text/javascript">
    $(function () {
        $("#btnPrint").click(function () {
            $('.btn').css("display", "none");
            $('.top-block').css("display", "block");
            var contents = $("#dvContainer").html();
            //contents = contents.replace(/<\/?a[^>]*>/g, ""); //remove if u want links in your table
            //tab_text = tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
            //tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
            var heading = 'PERFORMA OF HRDS(Publication of Outstanding Works on Sports Related Subject)';
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({ "position": "absolute", "top": "-1000000px" });
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html><head><title>'+heading+'</title>');
            frameDoc.document.write('</head><body>');
            //Append the external CSS file.
            var baseurl ="http://localhost:8080/";
            var style = baseurl+"assets/css/style_main.css";
            frameDoc.document.write('<link href="'+style+'" rel="stylesheet" type="text/css" />');
            //Append the DIV contents.
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
            $('.btn').css("display", "inline-block");
            $('.top-block').css("display", "none");
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('input[name="phone"], input[name="fed_phone"]').mask('(000) 000 0000');
        $('input[name="fax_no"]').mask('+99-9999999999');
        $('input[name="employer_fax"]').mask('+99-9999999999');
        $('input[name="aadhar"]').mask('999999999999');
        $('input[name="aadhar_enroll_no"]').mask('9999/99999/99999');
        $('.year').mask('9999');
        $('.passedyear').mask('9999');
    });
</script>

<script src="<?= base_url('assets/js/custom-script.js') ?>"></script>
<script>

    /*
     * -------------------------------------------------------
     * Project: arrow
     * Version: 0.1.9
     *
     * Author:  Petar Bojinov
     * Contact: petarbojinov@gmail.com
     *
     *
     * Copyright (c) 2015 Petar Bojinov
     * -------------------------------------------------------
     */

    window.Arrow = function(window, document) {
    "use strict";

    function _increaseOpacity(milliseconds) {
        var arrow = document.getElementById("arrow-" + browser);
        arrow.style.display = "block";
        var i = 0,
            ieI = 0,
            x = setInterval(function() {
                i += .1, ieI += 10, "msie" === browser && 8 >= browserVersion ? arrow.filters && (arrow.filters.item("DXImageTransform.Microsoft.Alpha").opacity = ieI) : arrow.style.opacity = i
            }, 50);
        setTimeout(function() {
            clearInterval(x)
        }, 1600), setTimeout(function() {
            _hide()
        }, milliseconds || 6e3)
		 
    }

    function _decreaseOpacity() {
        var arrow = document.getElementById("arrow-" + browser),
            i = 1,
            ieI = 100,
            x = setInterval(function() {
                i -= .1, ieI -= 10, "msie" === browser && 8 >= browserVersion ? arrow.filters && (arrow.filters.item("DXImageTransform.Microsoft.Alpha").opacity = ieI) : arrow.style.opacity = i
            }, 50);
        setTimeout(function() {
            clearInterval(x), arrow.style.display = "none"
        }, 1600)
    }

    function _applyStyleModern(node) {
        node.style.position = "fixed", node.style.zIndex = 999, node.style.display = "none", node.style.height = "309px", node.style.width = "186px", node.style.opacity = 0, node.style.backgroundImage = "url(https://i.imgur.com/aMwoyfN.png)", node.style.backgroundRepeat = "no-repeat", node.style.backgroundPositionX = "0", node.style.backgroundPositionY = "0"
		
    }

    function _applyStyleIE8(node) {
        node.style.top = "10px", node.style.left = "20px";
        var opacity = "progid:DXImageTransform.Microsoft.Alpha(opacity=0) ",
            imgSrc = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="https://i.imgur.com/aMwoyfN.png", sizingMethod="scale") ',
            rotation = 'progid:DXImageTransform.Microsoft.Matrix(M11=1, M12=1.2246063538223773e-16, M21=-1.2246063538223773e-16, M22=-1, SizingMethod="auto expand") ';
			
        node.style.filter = opacity + imgSrc + rotation
    }

    function _applyStyleMs(node) {
        node.style.bottom = "50px", node.style.left = "67%"
    }

    function _applyStyleMoz(node) {
        node.style.top = "0px", node.style.right = "37px", node.style.transform = "rotateX(180deg) rotateY(180deg)", node.style.MozTransform = "rotateX(180deg) rotateY(180deg)"
    }

    function _applyStyleWebkit(node) {
        node.style.bottom = "50px", node.style.left = "20px"
    }

    function _applyStyleSafari(node) {
        node.style.top = "0px", node.style.right = "80px", node.style.transform = "rotateX(180deg) rotateY(180deg)", node.style.webkitTransform = "rotateX(180deg) rotateY(180deg)"
    }

    function _setStyleType(node) {
        _applyStyleModern(node), "msie" === browser ? 8 === browserVersion ? _applyStyleIE8(node) : (9 === browserVersion || 10 === browserVersion) && _applyStyleMs(node) : "chrome" === browser || "opera" === browser ? _applyStyleWebkit(node) : "safari" === browser ? _applyStyleSafari(node) : "IE11" === browser || "edge" === browser ? _applyStyleMs(node) : "firefox" === browser && browserVersion >= 20 && _applyStyleMoz(node)
    }

    function _buildArrow() {
        var div = document.createElement("div");
        return div.setAttribute("id", "arrow-" + browser), arrowNode = div, div
    }

    function _injectNode(node) {
        document.body.appendChild(node)
    }

    function _isExist() {
        return !!document.getElementById("arrow-" + browser)
    }

    function _initArrow() {
        var arrow = _buildArrow();
        _setStyleType(arrow), _calculateArrowPosition(), _injectNode(arrow), _addWindowEvent("resize", _calculateArrowPosition), _addWindowEvent("scroll", _calculateArrowPosition)
    }

    function _addWindowEvent(event, functionReference) {
        window.addEventListener ? window.addEventListener(event, functionReference, !1) : window.attachEvent && window.attachEvent(event, functionReference)
    }

    function _calculateArrowPosition() {
        "number" == typeof window.innerWidth ? (visibleWidth = window.innerWidth, visibleHeight = window.innerHeight) : document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight) && (visibleWidth = document.documentElement.clientWidth, visibleHeight = document.documentElement.clientHeight), "msie" === browser && 9 === browserVersion && (1005 > visibleWidth ? arrowNode.style.bottom = "85px" : visibleWidth > 1006 && (arrowNode.style.bottom = "50px"))
		
    }

    function _hide() {
        if (!_isExist()) throw "Invalid usage: There are no arrows on the page.";
        _decreaseOpacity()
    }

    function show(seconds) {
        if (!_isExist()) throw "Invalid usage: arrow does not exist";
        _increaseOpacity(seconds);
		
    }
    var arrowNode, version = "0.1.9",
        Arrow = {},
        browser = "",
        browserVersion = 0,
        visibleHeight = 0,
        visibleWidth = 0;
    return function() {
		
		
        var tem, N = navigator.appName,
            ua = navigator.userAgent,
            M = ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
        M && null != (tem = ua.match(/version\/([\.\d]+)/i)) && (M[2] = tem[1]), M = M ? [M[1], M[2]] : [N, navigator.appVersion, "-?"], browser = "netscape" == M[0].toLowerCase() ? "IE11" : -1 != ua.toLowerCase().indexOf("edge") ? "edge" : M[0].toLowerCase(), browserVersion = parseInt(M[1], 10)
    }(), _initArrow(), Arrow._version = version, Arrow._browser = browser, Arrow._browserVersion = browserVersion, Arrow.show = show, Arrow
}(window, window.document);

$(document).ready(function(){
    var url = "http://localhost:8080/";
     $.ajax({
            type: "POST",
            url: url+ 'admin/Myinbox/get_unread_message',
            //data: {'id':id},
            dataType: "html",
            success: function(data){
                $('#msg_inbox_count').html(data);
                if(data == 0) 
                    var str = 'You have no unread messages';
                else
                    var str = `You have <span class='text text-primary'>${data}</span> unread messages`;
                $('#mainNav-inbox-notification').html(str);
                //console.log(`unread messageds: ${data}`);
            },
        });
        // apoorv 8/06/2020
     $.ajax({
            type: "POST",
            url: url+ 'formbuilder/Application/get_unread_application_forms',
            //data: {'id':id},
            dataType: "html",
            success: function(data){
               
                if(data == 0) 
                    var str = 'You have no assigned forms';
                else
                    var str = `You have <span class='text text-primary'>${data}</span> new assigned forms`;
                $('#mainNav-assignForms-notification').html(str);
                //console.log(`unread messageds: ${data}`);
            },
        });
        // end of apoorv 8/06/2020
        //apoorv 10/09/2020
         $.ajax({
            type: "POST",
            url: url+ 'formbuilder/Application/get_unread_formbuilder_forms',
            //data: {'id':id},
            dataType: "html",
            success: function(data){
               
                if(data == 0) 
                    var str = 'No forms filled';
                else
                    var str = `<span class='text text-primary'>${data}</span> form were filled`;
                $('#mainNav-formbuilder-notification').html(str);
                //console.log(`unread messageds: ${data}`);
            },
        });
        // end of apoorv
})

    $('#student_finance').DataTable( {
        //"lengthMenu": [[ -1], ["All"]],
        "lengthMenu": [[10, 25, 100, 600,  -1], [10, 25,100, 600,  "All"]],
        "order": [],
		"pageLength": 600
    } );
    
    
   $('#alldataTable2').DataTable( {
        "order": [],
        "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
		"pageLength": -1
    } );
    
    $('#dataTable2').DataTable( {
        "order": [],
        "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
		"pageLength": -1
    } );
    
    
    
    $('#alldataTable3').DataTable( {

       

        aoColumnDefs : [ {
           orderable : false, aTargets : [4]        
        }],

         "order": [],

        "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],

        "pageLength": -1

    } );
    
    
    
     
	
$('#course_report').DataTable( {
        aoColumnDefs : [ {
          // orderable : false, aTargets : [4]        
        }],
        
        "dom": '<"dt-buttons"Bf><"clear">lirtp',
            			"autoWidth": true,
		"buttons": [{
			text: '<i class="fa fa-file-excel-o"></i> Excel',
			extend: 'excelHtml5',
			messageTop: 'Course Report',
            filename: '2025-06-27_course_reports',
			title:'',
			id:'classlistexl',
			exportOptions: {
                    columns: ':visible'
                }
		 }],

         "order": [],
         //"ordering": false,
        "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],

		"pageLength": -1
    } );
    
	
									

	   

						  
													
		   

					 

																	  

						

		
    
    
    $(document).on('click','.double_spacing',function(){
        $('td').addClass('cell_two_design'); 
        $('th').addClass('cell_two_design'); 
        $(this).addClass('active_color');
        $('.single_spacing').removeClass('active_color');
        $('.spacing-btn-box').addClass('active_color');
    })
 
    $(document).on('click','.single_spacing',function(){
        $('td').removeClass('cell_two_design'); 
        $('th').removeClass('cell_two_design'); 
        $(this).addClass('active_color');
        $('.double_spacing').removeClass('active_color');
        $('.spacing-btn-box').addClass('active_color')
    })
    
     
    
    /*Start Manage Sort By Pop hide/show */
    function sort_field()
    {
        var count = (parseInt($('#sort_count').val()))+1;
        var content = '';
        content +='<div class="form-group custum_padding" id="new_sort_row'+count+'">';
        content +='<div class="col-md-6 top_marginn stop_hide_after_selection_class">';
        content +='<select class="form-control form-control1 filter_ajax" name="column['+count+']">';
        content +='<option value="">&#xf034; Name</option>';
        $('.datatable_th th').each(function() {
			if(!$(this).hasClass('not-sorted')) 
			{
				content +='<option value="'+$(this).attr("data-name")+'">'+$(this).html()+'</option>'; 
			}
        })
		
        content +='</select>';
        content +='</div>';
        content +='<div class="col-md-5 top_marginn stop_hide_after_selection_class">';
        content +='<select class="form-control form-control1 filter_ajax" name="order_type['+count+']">';
        content +='<option value="ASC">&#xf160; Ascending</option>';
        content +='<option value="DESC">&#xf161; Descending</option>';
        content +='</select>';
        content +='</div>';
        content +='<div class="col-md-1 top_marginn">';
        content +='<span class="close_button filter_ajax" rel_id="'+count+'"><i class="fa fa-times"></i><span>';
        content +='</div>';
        content +='</div>';
        $('#sort_count').val(count)
        $('.sort_list_group').append(content);
    }
    
    //sort_field();
    
    $(document).on('click','.add_new_sort',function(){
        sort_field();
        
        $('.stop_hide_after_selection_class').on('click', function(e) {
            e.stopPropagation();  
        });
    }) 
    
    $(document).on('click','.close_button',function(){   
        var rel_id = $(this).attr('rel_id');
        $('#new_sort_row'+rel_id).remove();
        form_submit_data();
    }) 
    
    $(document).on('click','.sort-data',function(){
        var position = $(this).attr('postion');
        var order = $(this).attr('order');
        alert(position+" "+order);
        var table = $('.datatable_th').DataTable();
        table.order([[position, order]]).draw();
    }) 
    
    $(document).on('click', '.dropdown-menu', function (e) {
        e.stopPropagation();
    });

    $("document").ready(function() {
        $('.stop_hide_after_selection_class').on('click', function(e) {
            e.stopPropagation();  
        });
    });
    
    /*End Manage Sort By Pop hide/show */
    
    /* Start Hide Field */
    function listing_table_field()
    {
        var content = '';
        content += '<ul class="list_field" >';
        /*content += '<li class="field_li" rel_data="All" rel_column="-1">';
        content += '<span class="show-content">All</span>';
        content += '<span class="show-check pull-right">';
        content += '<input type="checkbox" class="All filter_check_box" value="All" name="selected_field[]">';
        content += '</span>';
        content += '</li>';*/
        var no_column = 0
        $('.datatable_th th').each(function() {
            content += '<li class="field_li show-active" rel_column="'+(no_column)+'" rel_data="'+$(this).attr("data-name")+'">';
            content += '<span class="show-content">'+$(this).html()+'</span>';
            content += '<span class="show-check pull-right">';
            content += '<input type="checkbox" checked rel_column_no="'+(no_column)+'" class=" filter_check_box '+$(this).attr("data-name")+'" value="'+$(this).attr("data-name")+'" name="selected_field[]">';
            content += '</span>';
            content += '</li>';
            no_column++;
        })
        content += '</ul>';
        $('.list_field_div').html(content);
        
       
    }
    listing_table_field();
    
    $(document).on('click','.field_li',function(){
        var rel_data = $(this).attr('rel_data');
        var column = $(this).attr('rel_column');
        if(rel_data != 'All')
        {
            if(!$(this).hasClass('show-active'))
            {
                $(this).addClass('show-active');
                $('.'+rel_data).prop('checked', true);
            }
            else
            {
                $('.'+rel_data).prop('checked', false);
                $(this).removeClass('show-active');
            }
            var table = $('.datatable_th').DataTable();
            var column = table.column(column);
            // Toggle the visibility
            column.visible(!column.visible());
        }
        else
        {
            if(!$(this).hasClass('show-active'))
            {
                $('.field_li').addClass('show-active');
                $('.filter_check_box').prop('checked', true);
            }
            else
            {
                $('.field_li').removeClass('show-active');
                $('.filter_check_box').prop('checked', false);
            }
        } 
    })
    /* End Hide Field */
    
    
    function filter_progress_loader(){
        var content = '';
        content+='<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
        content+='</main>';
        $('#result').html(content);
        form_submit_data();
    }	
	 
	$(function() {
        $('.datepicker_with_month').datepicker( {
            viewMode: "months", 
            minViewMode: "months",
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'mm/yyyy',
            autoclose: false,
        });
    }); 


    $(document).ready(function(){
        $.ajax({
            type: "POST",
            url:  '<?= base_url('goole_api/send_notify.php') ?>',
            dataType: "html",
            success: function(data){
                
            },
        });
    })

    </script>

</body>
</html>
