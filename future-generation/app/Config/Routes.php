<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('login', 'admin\Home::index');
$routes->get('captcha', 'Captcha::index');
$routes->get('login/google_login', 'admin\Home::googleLogin');
$routes->post('admin/Home/login', 'admin\Home::login');
$routes->get('admin/Home', 'admin\Home::home');
$routes->get('admin/Form/ViewAppList', 'admin\Form::ViewAppList');
$routes->post('admin/Form/getNameList', 'admin\Form::getNameList');
$routes->get('admin/Form/relationships', 'admin\Form::relationships');
$routes->get('admin/Form/addOrganization', 'admin\Form::addOrganization');
$routes->get('admin/Form/OrganizationList', 'admin\Form::OrganizationList');
$routes->post('admin/Form/get_organization_html_by_id', 'admin\Form::get_organization_html_by_id');

$routes->post('admin/form/addGenralInfo', 'admin\Form::addGenralInfo');

$routes->post('admin/form/submitOrganization', 'admin\Form::submitOrganization');
$routes->post('admin/Form/submitOrganizationLabelRole', 'admin\Form::submitOrganizationLabelRole');
$routes->post('admin/Form/submitOrganizationPaymentDetails', 'admin\Form::submitOrganizationPaymentDetails');
$routes->post('admin/Form/delete_organization_donation', 'admin\Form::delete_organization_donation');


$routes->post('admin/Form/editOrganization/', 'admin\Form::editOrganization');

$routes->get('admin/Users/viewUsers', 'admin\Users::viewUsers');
$routes->post('admin/Users/insertUser', 'admin\Users::insertUser');

$routes->post('admin/Users/get_ajax_viewUsers', 'admin\Users::get_ajax_viewUsers');
$routes->post('admin/Users/addUpdate_profile', 'admin\Users::addUpdate_profile');
$routes->match(['get', 'post'], 'admin/Users/addUpdate_profile/(:any)', 'Admin\Users::addUpdate_profile/$1');

$routes->get('admin/Users/addUsers', 'admin\Users::addUsers');
$routes->get('admin/Users/addUsers/(:any)', 'Admin\Users::addUsers/$1');


$routes->get('admin/Assign_form/', 'admin\Assign_form::index');

$routes->post('admin/Assign_form/get_user', 'admin\Assign_form::get_user');

$routes->post('admin/Assign_form/get_user_already_assign', 'admin\Assign_form::get_user_already_assign');

$routes->post('admin/Assign_form/store_assign_user_form', 'admin\Assign_form::store_assign_user_form');

$routes->get('admin/Form/ViewApp/(:any)', 'admin\Form::ViewApp/$1');

$routes->get('admin/users/profile_management', 'admin\Users::profile_management');
$routes->get('admin/Users/profile_management', 'admin\Users::profile_management');
$routes->get('admin/Form', 'admin\Form::index');
$routes->get('admin/Dashboard/viewDashboard', 'admin\Dashboard::viewDashboard');
$routes->get('admin/timesheet/attendance', 'admin\Timesheet::attendance');

$routes->post('admin/Form/set_add_more_USPhone_html', 'admin\Form::set_add_more_USPhone_html');
$routes->post('admin/Form/set_add_more_board_html', 'admin\Form::set_add_more_board_html');

$routes->post('formbuilder/Application/get_unread_application_forms', 'formBuilder\Application::get_unread_application_forms');

$routes->post('formbuilder/Application/get_unread_formbuilder_forms', 'formBuilder\Application::get_unread_formbuilder_forms');

$routes->get('formbuilder/Application/reportfilterpendingScheme', 'formBuilder\Application::reportfilterpendingScheme');

$routes->post('formbuilder/Application/get_component_wise_data', 'formBuilder\Application::get_component_wise_data');

$routes->post('formbuilder/Application/update_exception_date', 'formBuilder\Application::update_exception_date');

$routes->get('formbuilder/Application/reportpendingScheme', 'formBuilder\Application::reportpendingScheme');

$routes->post('formbuilder/Application/delete_user_data', 'formBuilder\Application::delete_user_data');
$routes->get('formbuilder/Application/deleted_record', 'formBuilder\Application::deleted_record');
$routes->post('formbuilder/Application/filter_formbuilder_form', 'formBuilder\Application::filter_formbuilder_form');

$routes->get('formbuilder/Application/viewTrasaction', 'formBuilder\Application::viewTrasaction');

$routes->post('formbuilder/Application/check_dropddown', 'formBuilder\Application::check_dropddown');

$routes->post('formbuilder/Application/filter_data', 'formBuilder\Application::filter_data');

$routes->post('formbuilder/Application/signApplicationForm', 'formBuilder\Application::signApplicationForm');

$routes->post('formbuilder/Application/bulk_delete_user_data', 'formBuilder\Application::bulk_delete_user_data');

$routes->post('formbuilder/Application/deleted_record', 'formBuilder\Application::deleted_record');
$routes->post('formbuilder/Application/bulk_restore_user_data', 'formBuilder\Application::bulk_restore_user_data');
$routes->get('formbuilder/Application/pendingScheme', 'formBuilder\Application::pendingScheme');

$routes->get('formbuilder/Forms/createPDF/(:any)', 'formBuilder\Forms::createPDF/$1');

$routes->post('Forms/customForm/', 'Forms::customForm');

$routes->post('admin/Myinbox/get_unread_message', 'admin\Myinbox::get_unread_message');
$routes->get('admin/Myinbox/', 'admin\Myinbox::index');
$routes->get('admin/Myinbox/grade_list/(:any)', 'admin\Myinbox::grade_list/$1');
$routes->post('admin/Myinbox/approve_course', 'admin\Myinbox::approve_course');
$routes->post('admin/Myinbox/reject_course', 'admin\Myinbox::reject_course');

$routes->post('admin/GradeForm/store_grade', 'admin\GradeForm::store_grade');

$routes->get('admin/Registration/email_templete', 'admin\Registration::email_templete');
$routes->post('admin/Registration/update_city', 'admin\Registration::update_city');
$routes->post('admin/Registration/get_templete_detail', 'admin\Registration::get_templete_detail');
$routes->post('admin/Registration/update_templete_detail', 'admin\Registration::update_templete_detail');
$routes->post('admin/Registration/store_city', 'admin\Registration::store_city');
$routes->post('admin/Registration/get_detail_of_city', 'admin\Registration::get_detail_of_city');

$routes->get('admin/Registration/staticpage_student', 'admin\Registration::staticpage_student');
$routes->post('admin/Registration/update_static_data_detail', 'admin\Registration::update_static_data_detail');
$routes->post('admin/Registration/get_static_page_detail', 'admin\Registration::get_static_page_detail');

$routes->get('admin/Registration/get_master_list', 'admin\Registration::get_master_list');
$routes->post('admin/Registration/add_master_data', 'admin\Registration::add_master_data');
$routes->post('admin/Registration/getmasterdata', 'admin\Registration::getmasterdata');
$routes->post('admin/Registration/get_detail_of_data', 'admin\Registration::get_detail_of_data');
$routes->post('admin/Registration/update_master_data', 'admin\Registration::update_master_data');
$routes->post('admin/Registration/get_detail_of_add_data', 'admin\Registration::get_detail_of_add_data');

$routes->get('admin/Registration/city', 'admin\Registration::city');

$routes->get('admin/Registration/enthnicity', 'admin\Registration::enthnicity');

$routes->post('admin/Registration/update_ethnicity', 'admin\Registration::update_ethnicity');
$routes->post('admin/Registration/get_detail_of_ethnicity', 'admin\Registration::get_detail_of_ethnicity');
$routes->post('admin/Registration/store_ethnicity', 'admin\Registration::store_ethnicity');

$routes->post('admin/Registration/store_degree', 'admin\Registration::store_degree');

$routes->post('admin/Registration/store_school', 'admin\Registration::store_school');
$routes->get('admin/Registration/school', 'admin\Registration::school');
$routes->post('admin/Registration/update_school', 'admin\Registration::update_school');
$routes->post('admin/Registration/get_detail_of_school', 'admin\Registration::get_detail_of_school');

$routes->get('admin/Registration/degree', 'admin\Registration::degree');

$routes->get('admin/Master/addCountry', 'admin\Master::addCountry');
$routes->get('admin/Master/addCountry/(:any)', 'admin\Master::addCountry/$1');
$routes->post('admin/Master/submitCountry', 'admin\Master::submitCountry');
$routes->post('admin/Master/delCountry', 'admin\Master::delCountry');

$routes->get('admin/Master/addState', 'admin\Master::addState');
$routes->get('admin/Master/addState/(:any)', 'admin\Master::addState/$1');
$routes->post('admin/Master/submitState', 'admin\Master::submitState');
$routes->post('admin/Master/delState', 'admin\Master::delState');

$routes->get('admin/Master/addCampaigns', 'admin\Master::addCampaigns');
$routes->get('admin/Master/addCampaigns/(:any)', 'admin\Master::addCampaigns/$1');
$routes->post('admin/Master/delCampaign', 'admin\Master::delCampaign');
$routes->post('admin/Master/submitaddCampaigns', 'admin\Master::submitaddCampaigns');

$routes->get('admin/Master/addPaymentType', 'admin\Master::addPaymentType');
$routes->get('admin/Master/addPaymentType/(:any)', 'admin\Master::addPaymentType/$1');
$routes->post('admin/Master/delPaymentType', 'admin\Master::delPaymentType');
$routes->post('admin/Master/submitPaymentType', 'admin\Master::submitPaymentType');

$routes->get('admin/Master/uploadSignature', 'admin\Master::uploadSignature');
$routes->post('admin/Master/updateSignatureDetail', 'admin\Master::updateSignatureDetail');

$routes->get('admin/GradeForm/', 'admin\GradeForm::index');
$routes->get('admin/GradeForm/assign_grade/(:any)', 'admin\GradeForm::assign_grade/$1');

$routes->get('admin/Master/addRegionProgram', 'admin\Master::addRegionProgram');
$routes->post('admin/Master/submitRegionProgram', 'admin\Master::submitRegionProgram');

//reports
$routes->get('admin/Reports/classListing', 'admin\Reports::classListing');
$routes->get('admin/PdfBuilder/classReportPdf/(:any)','admin\PdfBuilder::classReportPdf/$1');
$routes->get('admin/Reports/classListingcertificates', 'admin\Reports::classListingcertificates');
$routes->post('aadmin/Reports/filter_classListing', 'admin\Reports::filter_classListing');
$routes->post('admin/Reports/data_encrypte', 'admin\Reports::data_encrypte');
$routes->post('admin/Reports/filter_classListingcertificates', 'admin\Reports::filter_classListingcertificates');
$routes->post('admin/PdfBuilder/CertificatesReportPdf/', 'admin\PdfBuilder::CertificatesReportPdf');
$routes->post('admin/Reports/export_pdf_certficate_class_semesrer_list', 'admin\Reports::export_pdf_certficate_class_semesrer_list');

$routes->get('admin/Reports/addGeneralMailingList', 'admin\Reports::addGeneralMailingList');

$routes->get('admin/Reports/SemesterList', 'admin\Reports::SemesterList');
$routes->post('admin/Reports/filter_SemesterList', 'admin\Reports::filter_SemesterList');
$routes->post('admin/Reports/getcourse', 'admin\Reports::getcourse');
$routes->post('admin/Reports/export_pdf_SemesterList', 'admin\Reports::export_pdf_SemesterList');

$routes->get('admin/Reports/dynamicreport', 'admin\Reports::dynamicreport');
$routes->post('admin/Reports/get_course_in_range', 'admin\Reports::get_course_in_range');
$routes->post('admin/Reports/export_excell_dynamicreport', 'admin\Reports::export_excell_dynamicreport');
$routes->post('admin/Reports/filter_dynamicreport', 'admin\Reports::filter_dynamicreport');
$routes->post('admin/Reports/get_higher_class', 'admin\Reports::get_higher_class');
$routes->post('admin/Reports/export_pdf_dynamicreport', 'admin\Reports::export_pdf_dynamicreport');

$routes->get('admin/Reports/gradereport', 'admin\Reports::gradereport');
$routes->post('admin/Reports/filter_grade_report', 'admin\Reports::filter_grade_report');
$routes->post('admin/Reports/export_pdf_grade_report', 'admin\Reports::export_pdf_grade_report');
$routes->post('admin/Reports/export_grade_report_excell', 'admin\Reports::export_grade_report_excell');

$routes->get('admin/Reports/gradsheetreport', 'admin\Reports::gradsheetreport');
$routes->post('admin/Reports/export_pdf_report', 'admin\Reports::export_pdf_report');
$routes->post('admin/Reports/export_grade_sheet_excell', 'admin\Reports::export_grade_sheet_excell');
$routes->post('admin/Reports/filter_gradsheetreport', 'admin\Reports::filter_gradsheetreport');

$routes->get('admin/Reports/student_demographic_report', 'admin\Reports::student_demographic_report');
$routes->post('admin/Reports/filter_student_demographic_report', 'admin\Reports::filter_student_demographic_report');

$routes->get('admin/Reports/special_program_report', 'admin\Reports::special_program_report');
$routes->post('admin/Reports/filter_special_program_report', 'admin\Reports::filter_special_program_report');

$routes->get('admin/Reports/completionsreport', 'admin\Reports::completionsreport');
$routes->post('admin/Reports/filter_completionsreport', 'admin\Reports::filter_completionsreport');
$routes->post('admin/Reports/export_pdf_completionsreport', 'admin\Reports::export_pdf_completionsreport');
$routes->post('admin/Reports/export_excel_completionsreport', 'admin\Reports::export_excel_completionsreport');

$routes->get('admin/Reports/fallenrollmentreport', 'admin\Reports::fallenrollmentreport');
$routes->post('admin/Reports/filter_fallenrollmentreport', 'admin\Reports::filter_fallenrollmentreport');
$routes->post('admin/Reports/export_pdf_fallenrollmentreport', 'admin\Reports::export_pdf_fallenrollmentreport');
$routes->post('admin/Reports/export_excel_fallenrollmentreport', 'admin\Reports::export_excel_fallenrollmentreport');

$routes->get('admin/Reports/enrollmentreport', 'admin\Reports::enrollmentreport');
$routes->post('admin/Reports/filter_enrollmentreport', 'admin\Reports::filter_enrollmentreport');
$routes->post('admin/Reports/export_pdf_enrollmentreport', 'admin\Reports::export_pdf_enrollmentreport');
$routes->post('admin/Reports/export_excel_enrollmentreport', 'admin\Reports::export_excel_enrollmentreport');

$routes->get('admin/Reports/course_report', 'admin\Reports::course_report');
$routes->post('admin/Reports/filter_course_reports', 'admin\Reports::filter_course_reports');


//HR -> Employement
$routes->get('admin/Reports/employmentListing', 'admin\Reports::employmentListing');
$routes->post('admin/Reports/get_contract_details_by_id', 'admin\Reports::get_contract_details_by_id');
$routes->post('admin/Reports/submitemploymentdata', 'admin\Reports::submitemploymentdata');
$routes->post('admin/Reports/employmentListingSubmit/', 'admin\Reports::employmentListingSubmit');
$routes->post('admin/Reports/employmentListingUpdate/', 'admin\Reports::employmentListingUpdate');
$routes->post('admin/Reports/employmentListingDelete/', 'admin\Reports::employmentListingDelete');
$routes->post('admin/Reports/submitcontractdata', 'admin\Reports::submitcontractdata');
$routes->post('admin/Reports/get_tab_page', 'admin\Reports::get_tab_page');
$routes->post('admin/Reports/assign_remove_category', 'admin\Reports::assign_remove_category');
$routes->post('admin/Reports/filter_another_timesheet', 'admin\Reports::filter_another_timesheet');
$routes->post('admin/Users/get_user_details', 'admin\Users::get_user_details');
$routes->post('admin/Users/delContract', 'admin\Users::delContract');
$routes->post('admin/Users/getEmpTitleName', 'admin\Users::getEmpTitleName');
$routes->post('admin/Users/getEmpName', 'admin\Users::getEmpName');
$routes->post('admin/Users/getEmpLastName', 'admin\Users::getEmpLastName');
$routes->post('admin/assignCategory/all_get_task_category','admin\AssignCategory::all_get_task_category');
$routes->post('admin/AssignCategory/store_assign_category','admin\AssignCategory::store_assign_category');
$routes->post('admin/AssignCategory/', 'admin\AssignCategory::index');
$routes->post('admin/assignCategory/get_task_category', 'admin\AssignCategory::get_task_category');
$routes->post('admin/AssignCategory/remove_assign_category','admin\AssignCategory::remove_assign_category');
$routes->post('admin/assignCategory/add_remove_assign_cat','admin\AssignCategory::add_remove_assign_cat');
$routes->post('admin/Form/set_add_more_board_html', 'admin\Form::set_add_more_board_html');
$routes->post('admin/Form/validate_end_date_from_start_date','admin\Form::validate_end_date_from_start_date');
$routes->post('admin/Reports/getemploymentListingDetails', 'admin\Reports::getemploymentListingDetails');
$routes->post('admin/Form/submitemploymentrecord', 'admin\Form::submitemploymentrecord');
$routes->post('admin/Form/delemploymentrecord', 'admin\Form::delemploymentrecord');
$routes->post('admin/Users/getContractAttendence', 'admin\Users::getContractAttendence');

//Timesheet
$routes->get('admin/Reports/timeReports', 'admin\Reports::timeReports');
$routes->post('admin/Reports/filter_timeReports', 'admin\Reports::filter_timeReports');
$routes->post('admin/Reports/export_excel_time_reports', 'admin\Reports::export_excel_time_reports');


//Finance 
$routes->get('admin/Reports/exportContactDetails', 'admin\Reports::exportContactDetails');
$routes->get('admin/Reports/addDonorMailingList', 'admin\Reports::addDonorMailingList');
$routes->post('admin/PdfBuilder/getDonationReport', 'admin\PdfBuilder::getDonationReport');
$routes->post('admin/Reports/getDonationReportExcel', 'admin\Reports::getDonationReportExcel');
$routes->get('admin/Finance/payments', 'admin\Finance::payments');
$routes->post('admin/Finance/payments', 'admin\Finance::payments'); 
$routes->post('admin/Finance/get_tuition_detail', 'admin\Finance::get_tuition_detail');
$routes->post('admin/Finance/update_donation_value', 'admin\Finance::update_donation_value');
$routes->post('admin/Finance/get_donation_detail', 'admin\Finance::get_donation_detail');
$routes->post('admin/Finance/update_donation_student', 'admin\Finance::update_donation_student');
$routes->post('admin/Users/filter_contract', 'admin\Users::filter_contract');
$routes->post('admin/Finance/add_user_detail/(:any)', 'admin\Finance::add_user_detail/$1');
$routes->post('admin/Finance/update_donation_tuition', 'admin\Finance::update_donation_tuition');
$routes->post('admin/Finance/get_filter_user', 'admin\Finance::get_filter_user');
$routes->post('admin/Finance/store_tution_detail', 'admin\Finance::store_tution_detail');
$routes->post('admin/Finance/store_donation_detail', 'admin\Finance::store_donation_detail');

$routes->get('admin/Finance/student_billing', 'admin\Finance::student_billing');
$routes->post('admin/Form/getSemester', 'admin\Form::getSemester');
$routes->post('admin/Finance/student_billing', 'admin\Finance::student_billing');

$routes->get('admin/Reports/addVIPMailingList', 'admin\Reports::addVIPMailingList');


//Registrar
$routes->get('admin/Master/addClass', 'admin\Master::addClass');
$routes->get('admin/Master/addClass/(:any)', 'admin\Master::addClass/$1');
$routes->post('admin/Master/delClass', 'admin\Master::delClass');
$routes->post('admin/Master/submitaddClass', 'admin\Master::submitaddClass');

$routes->get('admin/Registrar/addCourselist', 'admin\Registrar::addCourselist');
$routes->get('admin/Master/addCourselist/(:any)', 'admin\Master::addCourselist/$1');
$routes->get('admin/Registrar/deleteCourselist/(:any)', 'admin\Registrar::deleteCourselist/$1');
$routes->post('admin/Registrar/submitCourselist', 'admin\Registrar::submitCourselist');
$routes->get('admin/Master/addCourselist', 'admin\Master::addCourselist');
$routes->post('admin/Master/submitCourselist', 'admin\Master::submitCourselist');

$routes->get('admin/Master/addRegionProgram', 'admin\Master::addRegionProgram');
$routes->get('admin/Master/addRegionProgram/(:any)', 'admin\Master::addRegionProgram/$1');
$routes->post('admin/Master/submitRegionProgram', 'admin\Master::submitRegionProgram');

$routes->get('admin/Master/addDiploma', 'admin\Master::addDiploma');
$routes->get('admin/Master/addDiploma/(:any)', 'admin\Master::addDiploma/$1');
$routes->post('admin/Master/submitDiploma', 'admin\Master::submitDiploma');
$routes->post('admin/Master/delDiploma', 'admin\Master::delDiploma');

$routes->get('admin/Master/addCertificate', 'admin\Master::addCertificate');
$routes->get('admin/Master/addCertificate/(:any)', 'admin\Master::addCertificate/$1');
$routes->get('admin/Master/getCourseByTerm', 'admin\Master::getCourseByTerm');
$routes->post('admin/Master/delCertificate', 'admin\Master::delCertificate');
$routes->post('admin/Master/delDiploma', 'admin\Master::delDiploma');
$routes->post('admin/Master/submitCertificate', 'admin\Master::submitCertificate');

$routes->get('admin/Master/addProgram', 'admin\Master::addProgram');
$routes->get('admin/Master/addProgram/(:any)', 'admin\Master::addProgram/$1');
$routes->post('admin/Master/submitProgram', 'admin\Master::submitProgram');
$routes->post('admin/Master/get_user_by_progrm', 'admin\Master::get_user_by_progrm');
$routes->post('admin/master/delete_addProgram', 'admin\Master::delete_addProgram');

$routes->get('admin/Master/addSpecialProgram', 'admin\Master::addSpecialProgram');
$routes->get('admin/Master/addSpecialProgram/(:any)', 'admin\Master::addSpecialProgram/$1');
$routes->post('admin/Master/submitSpecialProgram', 'admin\Master::submitSpecialProgram');

$routes->get('admin/Master/addDocumentType', 'admin\Master::addDocumentType');
$routes->get('admin/Master/addDocumentType/(:any)', 'admin\Master::addDocumentType/$1');
$routes->post('admin/Master/submitDocumentType', 'admin\Master::submitDocumentType');

$routes->get('admin/Users/classGradeMaster', 'admin\Users::classGradeMaster');
$routes->get('admin/users/classGradeMaster', 'admin\Users::classGradeMaster');
$routes->post('admin/Users/saveClassMaster', 'admin\Users::saveClassMaster');

$routes->get('admin/Form/type_scholaorship', 'admin\Form::type_scholaorship');
$routes->get('admin/form/type_scholaorship', 'admin\Form::type_scholaorship');
$routes->post('admin/Form/store_scholarship', 'admin\Form::store_scholarship');
$routes->post('admin/Form/update_scholarship', 'admin\Form::update_scholarship');
$routes->post('admin/Form/get_scholar_detail_by_id', 'admin\Form::get_scholar_detail_by_id');

$routes->get('admin/Master/addTrack', 'admin\Master::addTrack');
$routes->post('admin/master/submit_track_details', 'admin\Master::submit_track_details');
$routes->post('admin/Master/filter_addTrack', 'admin\Master::filter_addTrack');

$routes->get('admin/Form/student_transcripts', 'admin\Form::student_transcripts');
$routes->post('admin/Form/filter_student_transcripts', 'admin\Form::filter_student_transcripts');
$routes->post('admin/Form/getGradeValue', 'admin\Form::getGradeValue');
$routes->post('admin/Form/submitTranscript', 'admin\Form::submitTranscript');

$routes->get('admin/Reports/StudentPassportListings', 'admin\Reports::StudentPassportListings');
$routes->post('admin/Reports/StudentPassportListings','admin\Reports::StudentPassportListings');
$routes->post('admin/PdfBuilder/getStudentPassportReport/', 'admin\PdfBuilder::getStudentPassportReport');
$routes->get('admin/PdfBuilder/getStudentPassportReport/(:any)','admin\PdfBuilder::getStudentPassportReport/$1');

//Timesheet
$routes->get('admin/Users/contract', 'admin\Users::contract');
$routes->post('admin/Users/submitContract', 'admin\Users::submitContract');
$routes->post('admin/Users/unlink_previous_contract', 'admin\Users::unlink_previous_contract');
$routes->post('admin/Users/link_previous_contract', 'admin\Users::link_previous_contract');
$routes->post('admin/Users/get_parentcontract_by_id', 'admin\Users::get_parentcontract_by_id');

$routes->get('admin/Users/category', 'admin\Users::category');
$routes->get('admin/Users/category/(:any)', 'admin\Users::category/$1');
$routes->get('admin/Users/addSubcategory/(:any)', 'admin\Users::addSubcategory/$1');
$routes->post('admin/Users/submitcategory', 'admin\Users::submitcategory');

$routes->get('admin/Timesheet/activeNewContractors', 'admin\Timesheet::activeNewContractors');
$routes->post('admin/Timesheet/filter_activeNewContractors','admin\Timesheet::filter_activeNewContractors');
$routes->get('admin/Timesheet/getTransaction/(:any)', 'admin\Timesheet::getTransaction/$1');

$routes->get('admin/Reports/adminTimeReport', 'admin\Reports::adminTimeReport');
$routes->post('admin/Reports/filterAdminTimeReport','admin\Reports::filterAdminTimeReport');

$routes->get('admin/Reports/adminLockedReport', 'admin\Reports::adminLockedReport');
$routes->post('admin/Reports/adminLockedReport', 'admin\Reports::adminLockedReport');
$routes->post('admin/Reports/AdminLockedReport', 'admin\Reports::adminLockedReport');
$routes->get('admin/Reports/AdminLockedReport', 'admin\Reports::adminLockedReport');
$routes->post('admin/Reports/Update_lock','admin\Reports::Update_lock');

$routes->get('admin/Users/Team', 'admin\Users::Team');
$routes->get('admin/Users/team', 'admin\Users::Team');
$routes->get('admin/Users/team/(:any)', 'admin\Users::Team/$1');
$routes->post('admin/Users/filter_team','admin\Users::filter_team');
$routes->post('admin/Users/submitteam','admin\Users::submitteam');

$routes->get('admin/Timesheet/admin_attendance', 'admin\Timesheet::admin_attendance');
$routes->get('admin/Timesheet/admin_attendance/(:segment)/(:segment)', 'Admin\Timesheet::admin_attendance/$1/$2');
$routes->get('admin/Timesheet/attendance', 'admin\Timesheet::attendance');
$routes->get('admin/Timesheet/attendance/(:any)', 'admin\Timesheet::attendance/$1');
$routes->post('admin/Timesheet/addAttendance', 'admin\Timesheet::addAttendance');
$routes->post('admin/Timesheet/admin_addAttendance', 'admin\Timesheet::admin_addAttendance');

$routes->get('admin/Reports/adminMonthlyReport', 'admin\Reports::adminMonthlyReport');
$routes->post('admin/Reports/adminMonthlyReport', 'admin\Reports::adminMonthlyReport');
$routes->post('admin/Reports/export_monthly_report_pdf', 'admin\Reports::export_monthly_report_pdf');

$routes->get('admin/AssignCategory', 'admin\AssignCategory::index');

$routes->get('admin/Reports/adminMonthlyJournalReport', 'admin\Reports::adminMonthlyJournalReport');
$routes->post('admin/Reports/filter_adminMonthlyJournalReport', 'admin\Reports::filter_adminMonthlyJournalReport');
$routes->post('admin/Reports/export_excel_adminmonthlyJournalReport', 'admin\Reports::export_excel_adminmonthlyJournalReport');
$routes->post('admin/Reports/export_pdf_adminmothlyjournalreport', 'admin\Reports::export_pdf_adminmothlyjournalreport');

$routes->get('admin/timesheet/admin_indivisual_report', 'admin\Timesheet::admin_indivisual_report');
$routes->post('admin/timesheet/admin_indivisual_report', 'admin\Timesheet::admin_indivisual_report');

//Time Entry
$routes->get('admin/Testing/attendance', 'admin\Testing::attendance');
$routes->get('admin/Testing/attendance/(:any)', 'admin\Testing::attendance/$1');
$routes->post('admin/Testing/addAttendance', 'admin\Testing::addAttendance');

$routes->get('admin/Reports/monthlyReport', 'admin\Reports::monthlyReport');
$routes->post('admin/Reports/filter_monthlyReport2', 'admin\Reports::filter_monthlyReport2');

$routes->get('admin/Reports/monthlyReport2', 'admin\Reports::monthlyReport2');
$routes->post('admin/Reports/filter_monthlyReport', 'admin\Reports::filter_monthlyReport');

$routes->get('admin/Reports/monthlyJournalReport', 'admin\Reports::monthlyJournalReport');
$routes->post('admin/Reports/filter_monthlyJournalReport', 'admin\Reports::filter_monthlyJournalReport');
$routes->post('admin/Reports/get_journal_in_montly_report', 'admin\Reports::get_journal_in_montly_report');
$routes->post('admin/Reports/export_excel_monthlyJournalReport', 'admin\Reports::export_excel_monthlyJournalReport');
$routes->post('admin/Reports/export_pdf_mothlyjournalreport', 'admin\Reports::export_pdf_mothlyjournalreport');

$routes->get('admin/Reports/indivisualReport', 'admin\Reports::indivisualReport');
$routes->get('admin/Reports/indivisualReport2', 'admin\Reports::indivisualReport2');
$routes->get('admin/Reports/TeamReport', 'admin\Reports::TeamReport');
$routes->post('admin/Reports/TeamReport', 'admin\Reports::TeamReport');
$routes->get('admin/Reports/teamMonthlyJournlReport', 'admin\Reports::teamMonthlyJournlReport');
$routes->post('admin/Reports/teamMonthlyJournlReport', 'admin\Reports::teamMonthlyJournlReport');
$routes->post('admin/Reports/export_excel_teammonthlyJournalReport', 'admin\Reports::export_excel_teammonthlyJournalReport');
$routes->post('admin/Reports/export_pdf_teammothlyjournalreport', 'admin\Reports::export_pdf_teammothlyjournalreport');

$routes->post('admin/Reports/Update_lock_ajax', 'admin\Reports::Update_lock_ajax');

//27/10/25

$routes->post('admin/Form/get_student_tab_data', 'admin\Form::get_student_tab_data');

//17/11/25

// $routes->post('admin/form/submitApplication', 'admin\Form::get_student_tab_data');