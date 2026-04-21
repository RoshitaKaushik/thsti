<?php

use App\Models\BuilderModel;
use App\Models\FormBuilderModel;
use App\Models\MyinboxModel;
use App\Models\SchemeModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

if (!function_exists('test_input')) {
    function test_input($theValue)
    {
        if (gettype($theValue) != 'array') {
            $theValue = trim($theValue);
            $theValue = strip_tags($theValue);
            //$theValue = str_replace(array('\'', '"'), ' quote ', $theValue);
            //$theValue = addslashes($theValue); // comment by prabhat 14-12-2021
            //$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
            $theValue = htmlspecialchars($theValue, ENT_QUOTES);
            //$ci=& get_instance();
            //$theValue = $ci->db->escape($theValue);
        }
        return $theValue;
    }
}

if (!function_exists('get_salt_token_admin')) {

    function get_salt_token_admin()
    {
        $session = \Config\Services::session();
        return $session->get('salt_token_admin');
    }
}

if (!function_exists('get_salt_token')) {

    function get_salt_token()
    {
        $session = \Config\Services::session();
        return $session->get('salt_token');
    }
}



if (!function_exists('allocate_profiles_schmes_components')) {

    function allocate_profiles_schmes_components($profiles)
    {
        $db = \Config\Database::connect();
        $session = \Config\Services::session();

        $scheme_ids = [];
        $component_ids = [];
        $accesslevel = [];

        foreach ($profiles as $value) {
            $builder = $db->table('tbl_profile_details');
            $query = $builder->getWhere(['profile_id' => $value]);

            if ($query->getNumRows() > 0) {
                $data = $query->getResultArray();

                foreach ($data as $data_value) {
                    $profile_data = json_decode($data_value['profile_data'], true);

                    foreach ($profile_data as $val) {
                        // Add unique scheme IDs
                        if (!in_array($val['scheme_id'], $scheme_ids)) {
                            $scheme_ids[] = $val['scheme_id'];
                        }

                        // Merge access levels
                        foreach ($val['accesslevel'] as $al_key => $al_val) {
                            if (isset($accesslevel[$al_key])) {
                                foreach ($al_val as $button) {
                                    if (!in_array($button, $accesslevel[$al_key])) {
                                        $accesslevel[$al_key][] = $button;
                                    }
                                }
                            } else {
                                $accesslevel[$al_key] = $al_val;
                            }
                        }

                        // Add unique component IDs
                        foreach ($val['component_id'] as $comp_id) {
                            if (!in_array($comp_id, $component_ids)) {
                                $component_ids[] = $comp_id;
                            }
                        }
                    }
                }

                // Set session variables
                $session->set('scheme_ids', $scheme_ids);
                $session->set('component_ids', $component_ids);
                $session->set('accesslevel', $accesslevel);
            }
        }
    }


    if (!function_exists('encryptor')) {

        function encryptor($action, $string)
        {

            $output = false;

            $encrypt_method = "AES-256-CBC";

            //pls set your unique hashing key



            $secret_key = 'ajay';

            $secret_iv = 'ajay123';



            // hash

            $key = hash('sha256', $secret_key);

            // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning

            $iv = substr(hash('sha256', $secret_iv), 0, 16);

            //do the encyption given text/string/number

            if ($action == 'encrypt') {

                $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);

                $output = base64_encode($output);
            } else if ($action == 'decrypt') {

                //decrypt the given text/string/number

                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }

            return $output;
        }

        if (!function_exists('get_components')) {

            function get_components($scheme_id)
            {

                $model = new \App\Models\SchemeModel();

                $data = $model->get_component($scheme_id);

                if ($data) {

                    return $data;
                } else {
                    return array();
                }
            }
        }
    }

    //To check session on admin controllers afte login

    if (!function_exists('admin_check_session')) {

        function admin_check_session()
        {
            $session = \Config\Services::session();

            $allSessionData = $session->get();

            if (
                isset($allSessionData['USER_ID']) &&
                isset($allSessionData['user_type']) &&
                isset($allSessionData['admin_fullname']) &&
                isset($allSessionData['admin_email']) &&
                isset($allSessionData['role'])
            ) {
                if (
                    $allSessionData['USER_ID'] == '' ||
                    $allSessionData['user_type'] != 'A' ||
                    $allSessionData['admin_fullname'] == '' ||
                    $allSessionData['admin_email'] == '' ||
                    $allSessionData['role'] == ''
                ) {
                    return redirect()->to('admin');
                }
            } else {
                return redirect()->to('admin');
            }
        }
    }

    // To check session on login page

    if (!function_exists('admin_session_loginpage')) {

        function admin_session_loginpage(): ?RedirectResponse
        {
            $session = Services::session();

            $allSessionData = $session->get();

            if (
                isset($allSessionData['USER_ID']) &&
                isset($allSessionData['user_type'])
            ) {
                if (
                    $allSessionData['USER_ID'] != '' &&
                    $allSessionData['user_type'] == 'A'
                ) {
                    redirect()->to('admin/Home/Main')->send();
                    exit;
                }
            }

            return null;
        }
    }

    // To check session on login page

    if (!function_exists('empty_search')) {

        function empty_search($validate_array)
        {

            $result = 1;

            $save_result = 1;

            $first_row_value = 1;

            $first_row_empty = 1;



            //echo "<pre>";print_r($validate_array);

            $validate_array_len = sizeof($validate_array);



            for ($i = 0; $i < $validate_array_len; $i++) {

                if ($i == 0) {

                    foreach ($validate_array as $va) {



                        if (array_search("", $va)) {

                            $first_row_empty = 2;
                        } else {

                            $first_row_value = 2;
                        }
                    }



                    if ($first_row_empty == 2 && $first_row_value == 2) {

                        $result = 2;
                    } elseif ($first_row_empty == 1 && $first_row_value == 2) {

                        $save_result = 1;
                    } else {

                        $save_result = 2;
                    }
                } elseif ($i > 0) {

                    $count1 = 1;

                    foreach ($validate_array as $key => $va) {

                        if ($count1 != 1) {

                            if (array_search("", $va)) {

                                $result = 2;
                            }
                        }
                    }
                }
            }


            $response['save'] = $save_result;  // insert/update status

            $response['status'] = $result;     // validation status

            //echo "<pre>";print_r($response);

            return $response;
        }
    }

    if (!function_exists('get_processLevelOfScheme')) {

        function get_processLevelOfScheme($scheme_id, $component_id)
        {

            $model =  new SchemeModel;

            $data = $model->get_processLevelOfSchemeBySchemeComponent($scheme_id, $component_id);

            return $data;
        }
    }

    if (!function_exists('getScheme')) {

        function getScheme()
        {
            $schemeModel = model('App\Models\SchemeModel');

            $param['type'] = 'Get';
            $param['scheme_id'] = '';
            $param['scheme_type'] = '';
            $param['scheme_name'] = '';
            $param['scheme_codification'] = '';
            $param['scheme_code'] = '';
            $param['scheme_status'] = '';
            $param['created'] = '';
            $param['updated'] = '';
            $param['createdby'] = '';
            $param['timeline'] = '';
            $param['byIDS'] = '';

            $result = $schemeModel->get_scheme($param);
            return $result;
        }
    }

    function unmask($string)
    {

        // $string = str_replace('-', '', str_replace(' ', '', $string)); // Replaces all spaces 

        //return preg_replace('/[^A-Za-z0-9\-\+]/', '', $string); // Removes special chars.
        return preg_replace('/[^A-Za-z0-9\-\+ ]/', '', $string); // Removes special chars.

    }

    if (!function_exists('actual_ip')) {

        function actual_ip()
        {

            $ipaddress = '';

            if (array_key_exists('HTTP_CLIENT_IP', $_SERVER))

                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];

            elseif (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))

                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];

            elseif (array_key_exists('HTTP_X_FORWARDED', $_SERVER))

                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];

            elseif (array_key_exists('HTTP_FORWARDED_FOR', $_SERVER))

                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];

            elseif (array_key_exists('HTTP_FORWARDED', $_SERVER))

                $ipaddress = $_SERVER['HTTP_FORWARDED'];

            elseif (array_key_exists('REMOTE_ADDR', $_SERVER))

                $ipaddress = $_SERVER['REMOTE_ADDR'];

            else

                $ipaddress = 'UNKNOWN';

            return $ipaddress;
        }
    }


    function get_user_acc_form($form)
    {

        $model = new UsersModel;
        $result = $model->alreadyAssignuserinForm($form);
        return $result;
    }
}


if (!function_exists('getFormsapproval_by_user_hepler')) {
    function getFormsapproval_by_user_hepler($user_id, $form_id)
    {
        $model = new UsersModel();

        $result = $model->getFormsapproval_by_user($user_id, $form_id);

        if ($result) {
            return 'exits';
        } else {
            return 'not_exits';
        }
    }
}

if (!function_exists('getForms_by_user_hepler')) {
    function getForms_by_user_hepler($user_id, $form_id)
    {
        $usersModel = new UsersModel();

        $result = $usersModel->getForms_by_user($user_id, $form_id);

        if ($result) {
            return "exits";
        } else {
            return 'not_exits';
        }
    }
}

function getReports($parent_id)
{

    $model = new UsersModel;
    $result = $model->getAllSubmenu($parent_id);
    if ($result) {
        return $result;
    } else {
        return 0;
    }
}

function checkIfReportForRegistrar($profile_id, $parent_id)
{

    $model = new UsersModel;

    $result = $model->checkIfReportForRegistrar($profile_id, $parent_id);

    if ($result) {

        return true;
    } else {

        return false;
    }
}

function getReportMenu_by_profile_helper($profile_id, $display_id, $parent_id)
{

    $model = new UsersModel;

    $result = $model->getReportMenu_by_profile($profile_id, $display_id, $parent_id);

    if ($result) {

        return true;
    } else {

        return false;
    }
}

if (!function_exists('docdate')) {

    function docdate()
    {

        $currentdatetime =  date('m-d-y H:i:s');

        $currentdatetime_arr =  explode(' ', $currentdatetime);

        $stringdate =  $currentdatetime_arr[0] . '-' . implode('-', explode(':', $currentdatetime_arr[1]));

        return $stringdate;
    }
}

if (!function_exists('getCustomFieldsActive')) {

    function getCustomFieldsActive($component)
    {

        $model = new FormBuilderModel();

        $data = $model->getCustomFieldsActive($component);

        if ($data) {

            return $data;
        } else {
            return array();
        }
    }
}

if (!function_exists('get_componentsByID')) {
    function get_componentsByID($component_id)
    {

        $model = new BuilderModel;
        $data = $model->get_componentbyID($component_id);
        if ($data) {
            return $data;
        } else {
            return array();
        }
    }
}

if (!function_exists('getCustomFieldsActivename')) {
    function getCustomFieldsActivename($component)
    {
        $model = new BuilderModel;
        $data = $model->getNameFieldsActive($component);
        if ($data) {
            return $data;
        } else {
            return array();
        }
    }
}

if (!function_exists('get_custom_fields_values_custom')) {

    function get_custom_fields_values_custom($application_code, $field)
    {


        $response = '';

        $model = new FormBuilderModel();

        $response = $model->getCustomFieldValuescustom($application_code, $field);

        //echo "<pre>";print_r($response);die;

        return $response;
    }
}

if (!function_exists('dateformat_dd_mm_yyyy')) {

    function dateformat_dd_mm_yyyy($date)
    {

        if ($date != '' && $date != '0000-00-00' && $date != '0000-00-00 00:00:00') {

            $date = date('d-m-Y', strtotime($date));
        } else {

            $date = '';
        }
        return $date;
    }
}

if (!function_exists('dd_mm_yyyy')) {

    function dd_mm_yyyy($date)
    {

        if ($date != '' && $date != '0000-00-00' && $date != '0000-00-00 00:00:00') {

            $date = date('d-m-Y', strtotime($date));
        } else {

            $date = '';
        }

        return $date;
    }
}



if (!function_exists('getCustomFields')) {

    function getCustomFields($component)
    {

        $model = new FormBuilderModel;

        $data = $model->getCustomFields($component);

        if ($data) {

            return $data;
        } else {
            return array();
        }
    }
}



if (!function_exists('getCustomFieldsActive')) {

    function getCustomFieldsActive($component)
    {


        $model = new FormBuilderModel;

        $data = $model->getCustomFieldsActive($component);

        if ($data) {

            return $data;
        } else {
            return array();
        }
    }
}

if (!function_exists('get_custom_deleted_fields_values_custom')) {

    function get_custom_deleted_fields_values_custom($application_code, $field)
    {


        $response = '';

        //	$ci->load->model('FormBuilder_model');	
        $model = new BuilderModel;

        $response = $model->getDeletedCustomFieldValuescustom($application_code, $field);

        //echo "<pre>";print_r($response);die;

        return $response;
    }
}

if (!function_exists('getComponentWithFormModule')) {

    function getComponentWithFormModule($component_id)
    {

        $model = new SchemeModel;

        $data = $model->getComponentWithFormModule($component_id);

        if ($data) {

            return $data;
        } else {
            return array();
        }
    }
}

if (!function_exists('get_custom_fields_values')) {

    function get_custom_fields_values($application_code, $field)
    {



        $response = '';

        $model = new FormBuilderModel;



        $response = $model->getCustomFieldValues($application_code, $field);

        //echo "<pre>";print_r($response);die;

        return $response;
    }
}

if (!function_exists('get_controller')) {

    function get_controller($scheme_id)
    {

        switch ($scheme_id) {

            case ($scheme_id == NSDF_SCHEME_ID):

                $response = 'Nsdf';

                break;

            case ($scheme_id == HRDS_SCHEME_ID):

                $response = 'Hrds';

                break;

            case ($scheme_id == PENSION_SCHEME_ID):

                $response = 'SchemePension';

                break;

            case ($scheme_id == ARJUN_AWARD_SCHEME_ID):

                $response = 'ArjunAward';

                break;

            case ($scheme_id == DHYAN_CHAND_AWARD_SCHEME_ID):

                $response = 'DhyanChand';

                break;

            case ($scheme_id == DRONACHARYA_AWARD_SCHEME_ID):

                $response = 'Dronacharya';

                break;

            case ($scheme_id == RAJIV_GANDHI_KHEL_RATNA_AWARD_SCHEME_ID):

                $response = 'Rgkra';

                break;

            case ($scheme_id == NWF_SCHEME_ID):

                $response = 'NWF';

                break;

            case ($scheme_id == LNIPE_SCHEME_ID):

                $response = 'Lnipe';

                break;



            case ($scheme_id == SPECIAL_AWARD_SCHEME_ID):

                $response = 'SpecialAward';

                break;

            default:

                $response = '';
        }

        return $response;
    }
}


function course_grade_current_status($course_id)
{
    $model = new MyinboxModel();

    $result = $model->course_grade_current_status($course_id);

    return $result;
}

function getfinancialyear_june($contractdate)

{

    $contrat = explode('-', $contractdate);

    $date = $contrat[0];

    $month = $contrat[1];

    $year = $contrat[2];

    //$newstring = substr($year, -2);



    if ($month < 7) {

        return $fniay = ($year - 1) . '-' . ($year);
    } else {

        return $fniay = ($year) . '-' . ($year + 1);
    }
}

if (!function_exists('getCertificateName')) {
    function getCertificateName($cerid)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Certificates');

        $builder->select('*');
        $builder->where('certID', $cerid);
        $builder->where('(Deletestatus IS NULL OR Deletestatus != 1)', null, false);

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            $result = $query->getRowArray();
            return $result['CertName'];
        } else {
            return false;
        }
    }
}

 function check_menu_permission($timesheet_menu,$menu_id){
        $menu_list = array_column($timesheet_menu, 'id');
        if (in_array($menu_id, $menu_list)){ // first => value, second=> allData
            return true;
        }
        else{
            return false;
        }
    }

    function getPermissionDetails($profile_id,$menu_id,$parent_id){
        $model = new UsersModel;
        $result = $model->get_access_by_profile_id($profile_id,$menu_id, $parent_id);
        return $result;
    }

    function getDataGrade($grade, $class){
	$db = \Config\Database::connect();
    $builder = $db->table('mst_grades_class');
	$builder->select('GradeValue');
	$builder->where('Grade', $grade);
	$builder->where('class', $class);
	$query = $builder->get();
	if($query->getNumRows()>0){
		$result = $query->getRowArray();
		return $result['GradeValue'];
	}else{
		return false;
	}
}