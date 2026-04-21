<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\SchemeModel;
use App\Models\HomeModel;
use App\Models\BuilderModel;
use App\Libraries\Document;
use App\Models\MasterModel;
use App\Models\ReportModel;

class Users extends BaseController
{
    protected $usersModel;
    protected $schemeModel;
    protected $homeModel;
    protected $builderModel;
    protected $validation;
    protected $document;
    protected $Master_model;
    protected $Report_model;

    public function __construct()
    {
        helper('function_helper');
        $this->usersModel = new UsersModel();
        $this->schemeModel = new SchemeModel();
        $this->homeModel = new HomeModel();
        $this->builderModel = new BuilderModel();
        $this->document = new Document();
        $this->validation = \Config\Services::validation();
        $this->Master_model = new MasterModel;
        $this->Report_model = new ReportModel;
    }

    public function index()
    {
        //
    }

    public function viewUsers()
    {
        $data['results'] = $this->usersModel->getUsers();
        $data['content'] = 'backend/view_users';
        return view('backend/index', $data);
    }

    function profile_management()
    {
        $data['all_profile'] = $this->usersModel->get_all_profile();
        $data['buttons'] = $this->schemeModel->get_all_button();
        $data['content'] = 'backend/profile_management';
        return view('backend/index', $data);
    }

    function get_ajax_viewUsers()
    {

        $data['results'] = $this->usersModel->ajaxGetUsers();

        return view('templates/filter/view_users_filter', $data);
    }

    public function addUsers($update_id = 'I')
    {

        //echo "string"; exit;
        if (service('uri')->getSegment(4)) {
            $admin_id = service('uri')->getSegment(4);
            $details = $this->usersModel->getUserDetails(encryptor('decrypt', $admin_id));

            if (empty($details)) {
                session()->setFlashdata('msg', 'Invalid user');
                return redirect()->to('admin/Users/viewUsers');
            } else {
                $data['details'] = $details;
            }
        }
        $data['roles'] = $this->usersModel->getRoles();
        $data['all_profile'] = $this->usersModel->get_all_profile();
        $data['display_option'] = $this->homeModel->get_all_display_url();
        $data['display_selected'] = $this->homeModel->get_display_url(session()->get('admin_email'));

        $data['form_list'] = $this->builderModel->getallComponent();

        $data['content'] = 'backend/add_users';
        return view('backend/index', $data);
    }

    public function insertUser()
    {
        //
        if (strtolower($this->request->getMethod()) == 'post') {

            $response = [];

            $validation = \Config\Services::validation();

            $validation->setRules([
                'USERS_FULL_NAME'  => ['label' => 'User Full Name', 'rules' => 'trim|required'],
                'EMAIL'            => ['label' => 'Email', 'rules' => 'trim|required|valid_email'],
                'profile_image'    => ['label' => 'Profile Image', 'rules' => 'permit_empty'],
                'display_screen'   => ['label' => 'Display Screen', 'rules' => 'permit_empty'],
            ]);

            if (!$this->validation->withRequest($this->request)->run()) {
                $data['errors'] = $this->validation->listErrors();
                session()->setFlashdata('msg', $data['errors']);
                $data['roles'] = $this->usersModel->getRoles();
                $data['all_profile'] = $this->usersModel->get_all_profile();
                $data['content'] = 'backend/add_users';

                echo view('backend/index', $data);
            } else {
                $doc_array = $_FILES['doc'];
                $doc_array['docreq'] = $_POST['docreq'];
                $result = $this->document->validate_form_doc($doc_array, 'Profile', 1234);
                if ($result['status']) {

                    $doc_new_array = $result['doc_new_array'];

                    $post = $this->request->getPost();



                    if (isset($post['profiles']) && $post['roleid'] == 2) {
                        if (!in_array(11, $post['profiles'])) {
                            $post['form'] = array();
                        }
                        if (!in_array(12, $post['profiles'])) {
                            $post['approve_form'] = array();
                        }
                    }


                    //$PASSWORD2 = rand(10000,1000000);

                    $param['admin_fullname'] = test_input($post['USERS_FULL_NAME']);
                    $param['admin_mobile'] = '';
                    $param['admin_email'] = test_input($post['EMAIL']);
                    $param['DESIGNATION'] = '';
                    $param['ADDRESS'] = '';
                    $param['ADDRESS_2'] = '';
                    $param['TOWN_CITY'] = '';
                    $param['COUNTRY'] = '';
                    $param['STATE'] = '';
                    $param['profile_image'] = $doc_new_array['profile_image'][0] != '' ? $doc_new_array['profile_image'][0] : $post['profile_image_hid'];
                    $param['PINCODE'] = '';

                    if (isset($post['roleid'])) {
                        $param['role'] = test_input($post['roleid']);

                        if ($post['roleid'] == 2) {
                            $prof = array();
                            foreach ($post['profiles'] as $key => $value) {
                                $post['profiles'][$key] = test_input($value);
                            }
                            $prof['profiles'] = $post['profiles'];

                            $profiles = json_encode($prof, JSON_UNESCAPED_SLASHES);
                            $param['profiles'] = $profiles;
                        } else {
                            $param['profiles'] = '';
                        }
                    }
                    if (isset($post['account_status'])) {
                        $param['account_status'] = $post['account_status'];
                    }


                    if ($post['form_type'] == 'INSERT') {

                        if ($post['password'] == '') {
                            $PASSWORD2 = 1234567891;
                            $PASSWORD = MD5($PASSWORD2);
                        } else {
                            $PASSWORD = MD5($post['password']);
                        }

                        $param['password'] = $PASSWORD;
                        $param['failed_attempts'] = '';
                        $param['last_login_time'] = '';
                        $param['session_id'] = '';
                        $param['session_expiration_time'] = '';
                        $param['logout_time'] = '';
                        $param['f_ip'] = '';
                        $param['f_lastlogin'] = '';
                        $param['f_macaddress'] = '';

                        $param['created_by'] = session()->get('USER_ID');
                        $param['created_ip'] = actual_ip();
                        $param['created_date'] = date("d-m-Y H:i:s");
                    }

                    if ($post['form_type'] == 'UPDATE') {

                        if ($post['password'] != '') {
                            $PASSWORD = MD5($post['password']);
                            $param['password'] = $PASSWORD;
                        }

                        $param['modified_by'] = session()->get('USER_ID');
                        $param['modified_ip'] = actual_ip();
                        $param['modified_date'] = date("d-m-Y H:i:s");
                    }
                    //echo "<pre>";//print_r(session()->get());
                    //print_r($param); //print_r($post);
                    //die;

                    $USER_ID = encryptor('decrypt', $post['update']);
                    if ($post['form_type'] == 'INSERT') {

                        if ($this->usersModel->insert_user_details($param)) {
                            if ($post['roleid'] == 2) {
                                $db = \Config\Database::connect();
                                if (isset($post['approve_form']) || isset($post['form'])) {
                                    $this->usersModel->insertAssignForm_by_role($db->insertId(), $post['form']);
                                    $this->usersModel->insertApprovalAssignForm_by_role($db->insertId(), $post['approve_form']);
                                }
                            }


                            $response['status'] = true;
                            $response['message'] = 'User has been saved.';

                            $USERS_FULL_NAME = test_input($post['USERS_FULL_NAME']);
                            $ADMIN_USER_ID = test_input($post['EMAIL']);
                            $subject = 'Admin Registration';
                            $body = '<html><body>';
                            $body .= "<h2 style='color:#080;'>Dear $USERS_FULL_NAME</h2>";
                            $body .= '<p style="color:#080;font-size:18px;">Find the credential to access Future Generation portal:</p>';
                            $body .= "<b>UID: $ADMIN_USER_ID and PWD : $PASSWORD2</b>";
                            $body .= '</body></html>';
                        } else {
                            $response['status'] = false;
                            $response['message'] = 'Record already exist or something went wrong when saving the Profile.';
                        }
                    } elseif ($post['form_type'] == 'UPDATE' && !empty($post['update'])) {

                        if (!empty($_POST['display_screen'])) {
                            $display_screen = test_input($post['display_screen']);
                            $this->homeModel->update_display_screen($display_screen, $_POST['display_id']);
                        }
                        if ($this->usersModel->update_user_details($param, encryptor('decrypt', test_input($post['update'])))) {

                            $user_id = encryptor('decrypt', test_input($post['update']));

                            if (isset($_POST['approve_form']) || isset($_POST['form'])) {
                                //echo "<pre>";print_r($post); die; 
                                $this->usersModel->insertAssignForm_by_role($user_id, $post['form'] ?? []);
                                $this->usersModel->insertApprovalAssignForm_by_role($user_id, $post['approve_form'] ?? []);
                            }
                            $response['status'] = true;
                            $response['message'] = 'User has been updated.';

                            if ($USER_ID == session()->get('USER_ID')) {
                                session()->get('profile_image', $param['profile_image']);
                            }
                        } else {
                            $response['status'] = false;
                            $response['message'] = 'Something went wrong when updating the User details.';
                        }
                    }

                    session()->setFlashdata('msg', $response);

                    if (session()->get('role') == 1) {

                        return redirect()->to('admin/Users/viewUsers');
                    } else {
                        return redirect()->to('admin/Form/ViewAppList');
                    }
                } else {
                    $response['status'] = false;
                    $response['message'] = $result['mesg'];
                    session()->setFlashdata('msg', $response);

                    if (session()->get('role') == 1) {

                        return redirect()->to('admin/Users/viewUsers');
                    } else {
                        return redirect()->to('admin/Form/ViewAppList');
                    }
                }
            }
        }
    }

    function addUpdate_profile($update_id = 'A')
    {
        if (service('uri')->getSegment(4)) {
            $update_id = service('uri')->getSegment(4);
        }

        if ($this->request->getMethod() === 'POST' || $this->request->getMethod() === 'post') {
            $post = $this->request->getPost();
            $update_id = '';
            if (isset($post['update'])) {
                $update_id =  encryptor('decrypt', $post['update']);
            }
            $validation_result['status'] = true;
            if ($update_id != '13') {
                $validation_result = $this->validate_profile($post);
            }
            if ($validation_result['status']) { //id, profile_name, profile_details
                $ins_data['profile_name'] = test_input($post['profile_name']);
                $profile_details = array();
                foreach ($post['scheme'] as $key => $value) {
                    $profile['scheme_id'] = test_input($value);
                    $accesslevel = array();
                    foreach ($post['component'][$value] as $bkey => $bval) {
                        $post['component'][$value][$bkey] = test_input($bval);
                        $accesslevel[$bval] = $post['accesslevel'][$value][$bkey];
                    }

                    $profile['component_id'] = $post['component'][$value];
                    $profile['accesslevel'] = $accesslevel;
                    $profile_details[] = $profile;
                }
                $profile_details_json = json_encode($profile_details, JSON_UNESCAPED_SLASHES);
                //echo "<pre>"; print_r(json_decode($json, true));echo "</pre>"; die;
                $ins_data['profile_data'] = $profile_details_json;

                //echo "<pre>"; print_r($ins_data);echo "</pre>"; die;
                if (isset($post['update'])) {
                    $ins_data['pd_modified_date'] = date("d-m-Y H:i:s");
                    $ins_data['pd_modified_by'] = session()->get('USER_ID');;
                    $ins_data['pd_modified_ip'] = actual_ip();
                    //echo "<pre>";print_r($ins_data);die;
                    if ($this->usersModel->update_profile_details($ins_data, test_input(encryptor('decrypt', $post['update'])))) {

                        $profile_id = encryptor('decrypt', $post['update']);
                        $report_menu = $post['report_menu'] ?? [];
                        $this->usersModel->insertReportForProfile($profile_id, $report_menu);
                        $menu_array = $post['time_edit'] ?? [];
                        $this->usersModel->insertMenuForProfile($profile_id, $menu_array, '35');

                        $response['status'] = true;
                        $response['message'] = 'Profile has been updated.';
                    } else {
                        $response['status'] = false;
                        $response['message'] = 'Something went wrong when saving the Profile.';
                    }
                } else {
                    $ins_data['pd_created_date'] = date("d-m-Y H:i:s");
                    $ins_data['pd_created_by'] = session()->get('USER_ID');
                    $ins_data['pd_created_ip'] = actual_ip();
                    //echo "<pre>";print_r($ins_data);die;
                    if ($this->usersModel->insert_profile_details($ins_data)) {
                        $response['status'] = true;
                        $response['message'] = 'Profile has been saved.';
                    } else {
                        $response['status'] = false;
                        $response['message'] = 'Record already exist or something went wrong when saving the Profile.';
                    }
                }
                //echo "<pre>"; print_r($ins_data);echo "</pre>"; die;
            } else {
                $response['status'] = false;
                $response['message'] = 'Following error occured when saving the Profile: <br>' . implode("<br>", $validation_result['message']);
            }


            if (isset($post['update'])) {

                session()->setFlashdata('msg', $response);
                return redirect()->to('admin/Users/addUpdate_profile/' . $post['update']);
            } else {

                if ($response['status']) {
                    session()->setFlashdata('msg', $response);
                    return redirect()->to('admin/Users/profile_management');
                } else {
                    session()->setFlashdata('msg', $response);
                    return redirect()->to('admin/Users/addUpdate_profile');
                }
            }
        }

        if ($update_id != 'A') {

            $details = $this->usersModel->get_all_profile(encryptor('decrypt', $update_id));
            if (empty($details)) {
                return redirect()->to('admin/Users/profile_management');
            }
            if (encryptor('decrypt', service('uri')->getSegment(4)) == "13") {
                $data['timesheet_menu'] = $this->usersModel->getAllSubmenu('35');
            } else {
                $data['timesheet_menu'] = array();
            }

            $data['id_details'] = $details;
            $data['content'] = 'backend/update_profile';
        } else {

            $data['content'] = 'backend/profile_management';
            $data['all_profile'] = $this->usersModel->get_all_profile(); //additional key added 
        }
        $data['buttons'] = $this->schemeModel->get_all_button();
        $data['schemes'] = getScheme();

        //echo $data['content'];die;

        return view('backend/index', $data);
    }

    function validate_profile($post)
    {
        $response = array();
        $response['status'] = true;
        if (trim($post['profile_name']) == '') {
            $response['status'] = false;
            $response['message'][] = 'Please enter the profile name';
        } elseif (!isset($post['scheme']) || empty($post['scheme'])) {
            $response['status'] = false;
            $response['message'][] = 'Please select atleast one scheme';
        } elseif ((!isset($post['component']) || empty($post['component']))) {
            $response['status'] = false;
            $response['message'][] = 'Please select atleast one component';
        } else {
            for ($i = 0; $i <= count($post['scheme']) - 1; $i++) {
                if (!isset($post['component'][$post['scheme'][$i]]) || empty($post['component'][$post['scheme'][$i]])) {
                    $response['status'] = false;
                    $response['message'][] = 'Please select atleast one component of the selected  scheme.';
                } else {
                    //echo "<pre>";print_r($post['component'][$post['scheme'][$i]]);

                    foreach ($post['component'][$post['scheme'][$i]] as $key => $value) {

                        //echo "<pre>";print_r($post['accesslevel'][$post['scheme'][$i]][$key]);

                        if (empty($post['accesslevel'][$post['scheme'][$i]][$key])) {
                            $response['status'] = false;
                            $response['message'][] = "Please select Privilege of the selected scheme's component.";
                        }
                    }
                }
            }
        }
        //echo "<pre>";print_r($response);die;
        return $response;
    }

    function get_user_details()
    {
        if ($this->request->getPost('submit') == 'get_details') {
            $emp_id = $this->request->getPost('empid');
            $result = $this->usersModel->getStudentName($emp_id);
            echo json_encode($result);
        }
    }


    function getEmpTitleName()
    {
        $emp_id = $this->request->getPost('empid');
        $result = $this->usersModel->getStudentName($emp_id);
        $title = !empty($result) ? $result['title'] : '';
        echo $title;
    }

    function getEmpName()
    {

        $emp_id = $this->request->getPost('empid');
        $result = $this->usersModel->getStudentName($emp_id);
        $firstname = !empty($result) ? $result['FirstName'] : '';
        echo $firstname;
    }

    function getEmpLastName()
    {
        $emp_id = $this->request->getPost('empid');
        $result = $this->usersModel->getStudentName($emp_id);
        $lastname = !empty($result) ? $result['LastName'] : '';
        echo $lastname;
    }

    function filter_contract()
    {
        if ($this->request->getPost('submit') == 'submit') {

            $data['contract'] = $this->usersModel->getcontract();

            return view('templates/filter/filter_addContract', $data);
        }
    }

    function filter_category()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $data['catagory_name'] = $this->usersModel->getcategory();
            $add_permission = false;
            if (session()->get('profiles')) {
                if (in_array(1, session()->get('profiles'))) {
                    $add_permission = true;
                }
            } elseif (session()->get('role') == 1) {
                $add_permission = true;
            }
            $data['add_permission'] = $add_permission;
            return view('/templates/filter/filter_category', $data);
        }
    }

    public function getContractAttendence()
    {
        $post = $this->request->getPost();
        if ($post['submit'] == 'submit') {
            $data = $this->usersModel->getContractAttendence($post['id']);
            if ($data == true) {
                echo json_encode('true');
            } else {
                echo json_encode('false');
            }
        }
    }

    public function classGradeMaster()
    {
        //$this->Master_model->updateMasterGrade();
        $data['dataArr'] = $this->Master_model->getAllData();
        $data['classList'] = $this->Master_model->getAllClass();
        $data['gradeList'] = $this->Master_model->getAllGrade();
        //echo '<pre>'; print_r($data['data']['gradeList']); die;
        $data['content'] = 'backend/classGradeMasterPage';
        return view('backend/index', $data);
    }

    public function saveClassMaster()
    {
        //$Grade = $this->Master_model->getGrade($gradeID);
        $grade = $_GET['gradeID'];
        $class = $_GET['classID'];
        $GradeValue = $_GET['GradeValue'];
        $ClassExist = $this->Master_model->GradeValueExist($GradeValue, $class, $grade); // if true then return class string
        if ($ClassExist == false) {
            $resp = $this->Master_model->InsertTable($grade, $class, $GradeValue);
            if ($resp) {
                echo 'inserted';
            }
        } else {
            $responce = $this->Master_model->UpdateTable($grade, $class, $GradeValue);
            if ($responce) {
                echo 'updated:' . $GradeValue;
            }
        }
    }

    public function insertGradeInMasterdata()
    {
        $data = $this->Master_model->InsertDataGrade();
        return redirect()->to('admin/users/classGradeMaster', 'refresh');
    }

    function contract($id = '')
    {
        $data['data']['permission'] = array();
        if (session()->get('role') != '1' && in_array('13', session()->get('profiles'))) {
            $timesheet_menu = session()->get('timesheet_menu');
            $menu_status = check_menu_permission($timesheet_menu, '36');
            if (!$menu_status) {
                redirect('My401/');
            }
        }

        $student_id = session()->get('USER_ID');
        if ($id != '') {
            $id =  encryptor('decrypt', $id);
            $data['data']['edit_contract'] = $this->usersModel->getcontract($id);

            if ($data['data']['edit_contract'][0]['contract_end_date'] < date('Y-m-d')) {

                die("Contract has been expired.");
            }
        }
        $data['team_name'] = $this->usersModel->getactiveteam();
        $data['contract'] = $this->usersModel->getcontract();
        $data['content'] = 'backend/addContract';
        return view('backend/index', $data);
    }

    // remove Contract 	
    function delContract()
    {
        $id = $this->request->getPost('toBeChange');
        if ($id != '') {
            $id =  encryptor('decrypt', $id);
            $isdeleted = $this->usersModel->updateContract(array("deletestatus" => 1, "id" => $id));

            if ($isdeleted['msg'] == 'UPDATED') {
                echo 'OK';
            } else {
                echo 'Unable to delete the record';
            }
        }
    }

    function submitContract()
    {
        $post = $this->request->getPost();
        $id = $this->request->getPost('id');
        $empid = $this->request->getPost('empid');
        $teamid = $this->request->getPost('team_name');
        $contract_begin_date = date('Y-m-d', strtotime($this->request->getPost('contract_begin_date')));
        $contract_end_date = date('Y-m-d', strtotime($this->request->getPost('contract_end_date')));
        $hours_to_work = $this->request->getPost('hours_to_work');
        $CarriedOverHours = $this->request->getPost('CarriedOverHours');/*
		$title = $this->request->getPost('title');*/
        $education = $this->request->getPost('education');
        $daily_rate = $this->request->getPost('daily_rate');
        $contract_1099 = $this->request->getPost('contract_1099');
        $adjunct_fee = $this->request->getPost('adjunct_fee');
        $contract = array();
        $contract['id'] = $id;
        $contract['empid'] = $empid;
        $contract['teamid'] = $teamid;
        $contract['contract_begin_date'] = $contract_begin_date;
        $contract['contract_end_date'] = $contract_end_date;
        $contract['hours_to_work'] = $hours_to_work;
        $contract['education'] = $education;
        $contract['CarriedOverHours'] = $CarriedOverHours;
        $contract['daily_rate'] = $daily_rate;
        $contract['contract_1099'] = $contract_1099;
        $contract['adjunct_fee']    = $adjunct_fee;
        $contract['early_termination_date'] = '';
        if ($this->request->getPost('early_termination') != '') {
            $contract['early_termination_date']    = date('Y-m-d', strtotime($this->request->getPost('early_termination')));
        }

        $contract['termination_initiate_by']    = $this->request->getPost('termination_initiate');
        $contract['employee_title']    = $this->request->getPost('title');

        if ($id != '') {
            //$update_field['id'] = $contract['id'];
            //$update_field['hours_to_work'] = $contract['hours_to_work'];

            // By prabhat 09-05-2022
            $contract['modifiedby'] = $_SESSION['USER_ID'];
            $contract['modifieddate'] = date('Y-m-d h:i:s');

            //create log table by prabhat 09-05-2022
            $this->usersModel->updateContractLog($id);
            //End prabhat 09-05-2022
            // By Prabhat 10-05-2022 for stop daily changes
            $data = $this->usersModel->getContractAttendence($id);
            if ($data) {
                session()->setFlashdata('status', '2');
                session()->setFlashdata('post', $this->request->getPost()); //for post the data auto filled 
                session()->setFlashdata('msg', 'Cannot change rates, as this contract has active attendance records. Please contact administrator.');
                redirect('admin/Users/contract');
                die;
            }
            //$update_field['id'] = $contract['id'];
            //$update_field['hours_to_work'] = $contract['hours_to_work'];


            $result = $this->usersModel->updateContract($contract);
            // By PRabhat 02-01-2022
            $this->usersModel->update_group_emp($id);
            // End PRabhat 02-01-2022
        } else {
            // By prabhat 09-05-2022
            $contract['createdby'] = $_SESSION['USER_ID'];
            $contract['createddate'] = date('Y-m-d h:i:s');
            $result = $this->usersModel->insertContract($contract);
            // By PRabhat 02-01-2022
            if (isset($result['last_id'])) {
                $this->usersModel->update_group_emp($result['last_id']);
            }
            // End PRabhat 02-01-2022		   
        }

        if ($result['msg'] == 'INSERTED') {
            session()->setFlashdata('status', '1');
            session()->setFlashdata('msg', 'Record Inserted Successfully');
            return redirect()->to('admin/Users/contract');
        } elseif ($result['msg'] == 'UPDATED') {
            session()->setFlashdata('status', '1');
            session()->setFlashdata('msg', 'Record Updated Successfully');
            return redirect()->to('admin/Users/contract');
        } elseif ($result['msg'] == 'CONTRACT OVERLAP') {
            session()->setFlashdata('post', $post); //for post the data auto filled 
            session()->setFlashdata('status', '2');
            session()->setFlashdata('msg', 'This user have already one contact running between these dates.');
            return redirect()->to('admin/Users/contract');
        } else {
            session()->setFlashdata('status', '2');
            session()->setFlashdata('post', $post); //for post the data auto filled 
            session()->setFlashdata('msg', 'There is some Error Occurred in Submission. Please try later.');
            return redirect()->to('admin/Users/contract');
        }
    }

    function link_previous_contract()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $status = $this->usersModel->link_previous_contract();
            if ($status) {
                echo json_encode(array('status' => true, 'msg' => 'contract linked successfully'));
            } else {
                echo json_encode(array('status' => false, 'msg' => 'Oops something wrong'));
            }
        }
    }

    function unlink_previous_contract()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $status = $this->usersModel->unlink_previous_contract();
            if ($status) {
                echo json_encode(array('status' => true, 'msg' => 'contract unlinked successfully'));
            } else {
                echo json_encode(array('status' => false, 'msg' => 'Oops something wrong'));
            }
        }
    }

    function get_parentcontract_by_id()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $id =  encryptor('decrypt', $this->request->getPost('linked_id'));
            $edit_contract = $this->usersModel->getcontract($id);
            //echo "<pre>";print_r($edit_contract);echo "</pre>";
            if (!empty($edit_contract)) {
                echo "<table class='table table-striped table-bordered alldataTable datatable_th dataTable no-footer'>";
                echo "<tr>";
                echo "<th class='text-left'>Team Name</th>";
                echo "<th>:</th>";
                echo "<td class='text-left'>" . $edit_contract[0]['team_Name'] . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th class='text-left'>Contract Begin Date</th>";
                echo "<th>:</th>";
                echo "<td class='text-left'>" . $edit_contract[0]['contract_begin_date'] . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th class='text-left'>Contract End Date</th>";
                echo "<th>:</th>";
                echo "<td class='text-left'>" . $edit_contract[0]['contract_end_date'] . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th class='text-left'>Carried Over Hours</th>";
                echo "<th>:</th>";
                echo "<td class='text-left'>" . $edit_contract[0]['CarriedOverHours'] . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th class='text-left'>Hours To Work</th>";
                echo "<th>:</th>";
                echo "<td class='text-left'>" . $edit_contract[0]['hours_to_work'] . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th class='text-left'>Daily Rate</th>";
                echo "<th>:</th>";
                echo "<td class='text-left'>" . $edit_contract[0]['daily_rate'] . "</td>";
                echo "</tr>";

                echo "</table>";
            }
        }
    }

    public function category($id = '')
    {
        if ($id != '') {
            $id =  encryptor('decrypt', $id);
            $data['edit_category'] = $this->usersModel->getcategory($id);
        }
        $data['catagory_name'] = $this->usersModel->getcategory();
        $data['content'] = 'backend/addCategory';
        return view('backend/index', $data);
    }

    public function addSubcategory($id = '')
    {
        if ($id != '') {
            $id =  encryptor('decrypt', $id);
            $data['edit_subcategory'] = $this->usersModel->getcategory($id);
        }
        $data['catagory_name'] = $this->usersModel->getcategory();
        $data['content'] = 'backend/addCategory';
        return view('backend/index', $data);
    }

    function submitcategory()
    {

        $id = $this->request->getPost('id');
        $parent_id = $this->request->getPost('parent_id');
        $catagory_name = $this->request->getPost('catagory_name');
        $Active = $this->request->getPost('Active');
        $category = array();
        $category['id'] = $id;
        $category['catagory_name'] = $catagory_name;
        $post = $this->request->getPost();
        if (isset($post['grant_type'])) {
            $category['grant_type'] = $this->request->getPost('grant_type');
        }
        $category['Active'] = $Active;

        //echo"<pre>"; print_r($category);print_r($this->request->getPost());die();
        if ($id != '') {
            $result = $this->usersModel->updateCategory($category);
        } elseif ($parent_id != '') {
            $category['parent_id'] = $parent_id;
            $result = $this->usersModel->insertCategory($category);
        } else {
            $result = $this->usersModel->insertCategory($category);
        }

        if ($result['msg'] == 'INSERTED') {
            session()->setFlashdata('msg', 'Record Inserted Successfully');
            return redirect()->to('admin/Users/category');
        } elseif ($result['msg'] == 'UPDATED') {
            session()->setFlashdata('msg', 'Record UPDATED Successfully');
            return redirect()->to('admin/Users/category');
        } else {
            session()->setFlashdata('post', $post); //for post the data auto filled 
            session()->setFlashdata('msg', 'There is some Error Occurred in Submission. Please try later.');
            return redirect()->to('admin/Users/category');
        }
    }

    public function team($id = '')
    {
        if ($id != '') {
            $id =  encryptor('decrypt', $id);
            $data['facultystaff'] = $this->Report_model->Get_faculty_staff();
            $data['edit_team'] = $this->usersModel->getteam($id);
        }
        $data['facultystaff'] = $this->Report_model->Get_faculty_staff();
        $data['team_name'] = $this->usersModel->getteam();
        $data['content'] = 'backend/addteam';
        $data['data'] = $data;
        return view('backend/index', $data);
    }

    function submitteam()
    {

        $id = $this->request->getPost('id');
        $team_member = $this->request->getPost('team_member');
        $team_name = $this->request->getPost('team_name');
        $Active = $this->request->getPost('Active');
        $category = array();
        $category['id'] = $id;
        $category['Team_Name'] = $team_name;
        $category['empid'] = $team_member;
        $category['Active'] = $Active;

        $rules = [
            'team_name' => [
                'label'  => 'Team Name',
                'rules'  => 'required|trim|is_unique[Teams.Team_Name]',
                'errors' => [
                    'required'  => 'The {field} field is required.',
                    'is_unique' => 'The {field} must be unique.'
                ]
            ]
        ];

        $this->validation->setRules($rules);

        if ($id == '' && $this->validation->withRequest($this->request)->run()==FALSE) {

            $data['errors'] = $this->validation->getErrors();
            session()->setFlashdata('msg', $data['errors']);
            // print_r( session()->getFlashdata('msg'));
            return redirect()->to('admin/Users/team');

        } else {

            //echo"<pre>"; print_r($category);print_r($this->request->getPost());die();
            if ($id != '') {
                $result = $this->usersModel->updateTeam($category);
                echo "<pre>";
                print_r($result);
            } else {
                $result = $this->usersModel->insertTeam($category);
            }

            if ($result['msg'] == 'INSERTED') {
                session()->setFlashdata('msg', 'Record Inserted Successfully');
                return redirect()->to('admin/Users/team');
            } elseif ($result['msg'] == 'UPDATED') {
                session()->setFlashdata('msg', 'Record UPDATED Successfully');
                // die(session()->getFlashdata('msg'));
                return redirect()->to('admin/Users/team');
            } else {
                session()->setFlashdata('post', $this->request->getPost()); //for post the data auto filled 
                session()->setFlashdata('msg', 'There is some Error Occurred in Submission. Please try later.');
                return redirect()->to('admin/Users/team');
            }
        }
    }

    function filter_team()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $data['team_name'] = $this->usersModel->getteam();
            $data['add_permission'] = false;
            if (session()->get('profiles')) {
                if (in_array(1, session()->get('profiles'))) {
                    $data['add_permission'] = true;
                }
            } elseif (session()->get('role') == 1) {
                $data['add_permission'] = true;
            }
            return view('/templates/filter/filter_addteam', $data);
        }
    }
}
