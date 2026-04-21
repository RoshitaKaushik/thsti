<?php

use App\Models\ApplicationModel;
use App\Models\BuilderModel;
use App\Models\MasterModel;
use App\Models\ReportModel;
use App\Models\TimesheetModel;
use App\Models\UsersModel;

if (!function_exists('getAccess')) {
    function getAccess($tab)
    {
        $response = [
            'add_access' => false,
            'edit_access' => false,
            'delete_access' => false,
            'view_access' => false,
        ];

        // Load the session service
        $session = \Config\Services::session();

        // Get access level array
        $accesslevel_arr = $session->get('accesslevel');
        $role = $session->get('role');

        // If access level exists and has this tab
        if (!empty($accesslevel_arr) && isset($accesslevel_arr[$tab])) {
            // Add
            $response['add_access'] = in_array(1, $accesslevel_arr[$tab]);
            // Edit
            $response['edit_access'] = in_array(2, $accesslevel_arr[$tab]);
            // Delete
            $response['delete_access'] = in_array(3, $accesslevel_arr[$tab]);
            // View
            $response['view_access'] = in_array(4, $accesslevel_arr[$tab]);
        } elseif ($role == 1) {
            // Full access for role = 1 (admin)
            $response = [
                'add_access' => true,
                'edit_access' => true,
                'delete_access' => true,
                'view_access' => true,
            ];
        }

        return $response;
    }
}


function getStudentInfo($StudentInfoID)
{
    $model = new ApplicationModel;
    $result = $model->getStudentInfoByID($StudentInfoID);

    return $result;
}


function getStudentInfos($Name)
{

    $model = new ApplicationModel;

    $result = $model->getStudentRecInfo($Name);

    return $result;
}


function getCorse_details_by_ID($ID)
{



    $model = new ReportModel;

    $result = $model->getCorse_details_by_ID($ID);

    return $result;
}

function get_student_finance($course_cert_id, $type)
{
    $model = new ApplicationModel;

    $result = $model->get_student_finance($course_cert_id, $type);

    return $result;
}

function getSemesterCourseByStudent_ID($ID, $class, $semester)
{

    $model = new ReportModel;
    $result = $model->getSemesterCourseByStudent_ID($ID, $class, $semester);

    return $result;
}


function getSemesterCourseByStudent_ID_with_grade($ID, $class, $semester, $grade)
{

    $model = new ReportModel;
    $result = $model->getSemesterCourseByStudent_ID_with_grade($ID, $class, $semester, $grade);

    return $result;
}


function check_in_range($start_date, $end_date, $date_from_user)
{
    // Convert to timestamp
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($date_from_user);

    // Check that user date is between start & end
    if (($user_ts >= $start_ts) && ($user_ts <= $end_ts)) {
        return true;
    } else {
        return false;
    }
}

function unique_multidim_array($array, $key)
{
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach ($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}



function getcontract_total($begin_date, $end_date, $Team_option)
{

    $model = new ReportModel;
    $result = $model->get_hr_by_contract($begin_date, $end_date, $Team_option);

    return $result;
}

function getcontract_hour_left($begin_date, $end_date, $Team_option)
{

    $model = new ReportModel;

    $result = $model->get_hr_left_by_contract($begin_date, $end_date, $Team_option);

    return $result;
}



function getAddress($ID)
{
    $model = new ApplicationModel;
    $result = $model->getAddressByID($ID);
    return $result;
}

function getInterAddress($ID)
{
    $model = new ApplicationModel;
    $result = $model->getInterAddressByID($ID);
    return $result;
}

function getEmergencyAddress($ID)
{
    $model = new ApplicationModel;
    $result = $model->getEmergencyAddressByID($ID);
    return $result;
}


function getEmail($ID)
{

    $model = new ApplicationModel;

    $result = $model->getEmailByID($ID);

    return $result;
}

function getEmaill($ID)
{

    $model = new ApplicationModel;

    $result = $model->getEmailByIDD($ID);

    return $result;
}


function getGroups($ID)
{

    $model = new ApplicationModel;
    $result = $model->getGroupByID($ID);

    return $result;
}

function getActiveProgram($program_id)
{

    $model = new ApplicationModel;

    $result = $model->getActiveProgramName($program_id);

    return $result;
}

function convertDateString($string)
{

    $datestring = '';

    if ($string != '' && $string != '0000-00-00' && $string != '0000-00-00 00:00:00') {

        $datestring = date('m/d/Y', strtotime($string));
    }

    return $datestring;
}

function getDonationPayment($DonorID)
{

    $model = new ApplicationModel;

    $result = $model->getDonationPaymentByID($DonorID);

    return $result;
}

function recordExist($data, $table)
{
    $db = \Config\Database::connect();
    $builder = $db->table($table);

    $builder->select('*');
    $builder->where($data);

    if ($table === 'tbl_student_record_attachment' || $table === 'transcript') {
        $builder->where('(Deletestatus IS NULL OR Deletestatus != 1)', null, false);
    }

    $query = $builder->get();

    if ($query->getNumRows() >= 1) {
        return true;
    } else {
        return false;
    }
}

function dateConverter($string)
{

    $length = strlen($string);

    if ($string && $length == 10) {

        $string1 = substr($string, 0, 3);

        $string2 = substr($string, 3, 3);

        $string3 = substr($string, 6);

        $result = '(' . $string1 . ') ' . $string2 . '-' . $string3;

        return $result;
    } elseif ($string == '') {

        $result = '(000) 000-0000';

        return $result;
    } else {

        return $string;
    }
}

function getProfileName($profile_id)
{
    $model = new ApplicationModel();

    $result = $model->profileNameList($profile_id);

    return $result;
}

function campaignsOrganizationName($campaignsid)
{

    $model = new ApplicationModel;

    $result = $model->getCampaingnsOrganizationNameByID($campaignsid);

    return $result;
}

function getLoggedInUserName($userid)
{

    $model = new ApplicationModel;

    $result = $model->getLoggedInUserNameById($userid);

    return $result;
}

function get_amount_by_application_id($application_id = '', $field_id = '')
{
    if ($application_id == '') {
        return "something wrong";
    } else {
        $model = new BuilderModel;
        return $model->get_donar_amount_by_application_id($application_id, $field_id);
    }
}

function get_category_application($application_code = '', $param = '')
{

    $model = new BuilderModel;

    $result = $model->get_category_application($application_code, $param);

    return $result;
}

function calcFY($startDate, $endDate)
{

    $prefix = '20';

    $ts1 = strtotime($startDate);
    $ts2 = strtotime($endDate);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    //get months
    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

    /**
     * if end month is greater than april, consider the next FY
     * else dont consider the next FY
     */
    $total_years = ($month2 > 6) ? ceil($diff / 12) : floor($diff / 12);

    $fy = array();

    while ($total_years >= 0) {

        $prevyear = $year1 - 1;

        //We dont need 20 of 20** (like 2014)
        $fy[] = $prefix . substr($prevyear, -2) . '-' . $prefix . substr($year1, -2);

        $year1 += 1;

        $total_years--;
    }
    /**
     * If start month is greater than or equal to april, 
     * remove the first element
     */
    if ($month1 >= 6) {
        unset($fy[0]);
    }
    /* Concatenate the array with ',' */
    return implode(',', $fy);
}

if (!function_exists('get_semester_report_class_course')) {
    function get_semester_report_class_course($student_id = '', $selectedclass = '', $selected_semester = '', $selected_course = '')
    {
        $model = new ReportModel();
        $result = $model->get_semester_report_class_course($student_id, $selectedclass, $selected_semester, $selected_course);
        return $result;
    }
}

if (!function_exists('get_enrolled_course_filter_wise')) {
    function get_enrolled_course_filter_wise($student_id = '', $selectedclass = '', $selectedclassto = '', $selected_semester = '', $selected_course = '')
    {
        $model = new ReportModel;
        $result = $model->get_enrolled_course_filter_wise($student_id, $selectedclass, $selectedclassto, $selected_semester, $selected_course);
        return $result;
    }
}

function get_user_address($student_id, $country = '')
{
    $model = new ReportModel();

    $result = $model->get_user_address($student_id, $country);

    return $result;
}

function report_getEmailByIDD($ID)
{

    $model = new ReportModel;

    $result = $model->report_getEmailByIDD($ID);

    return $result;
}


if (!function_exists('get_us_state_by_state_id')) {
    function get_us_state_by_state_id($student_id = '', $countryid)
    {
        $model = new ReportModel;
        $result = $model->get_us_state_by_state_id($student_id, $countryid);
        return $result;
    }
}

function getFall2SemesterCourseByStudent_ID($student_id, $selected_program_start = '', $selectedSemester = '')
{
    $model = new ReportModel;
    return $model->getFall2SemesterCourseByStudent_ID($student_id, $selected_program_start, $selectedSemester);
}

function get_user_course_with_filter2($student_id, $selected_program_start = '', $selected_semester = '')
{
    $model = new ReportModel;
    $result = $model->get_user_course_with_filter2($student_id, $selected_program_start, $selected_semester);
    return $result;
}

function getFallSemesterCourseByStudent_ID($student_id, $selected_program_start = '', $start_program_date = '', $selected_program_end = '', $end_program_date = '', $selectedSemester = '')
{
    $model = new ReportModel;
    return $model->getFallSemesterCourseByStudent_ID($student_id, $selected_program_start, $start_program_date, $selected_program_end, $end_program_date, $selectedSemester);
}


function get_user_course_with_filter($student_id, $selected_program_start = '', $start_program_date = '', $selected_program_end = '', $end_program_date = '', $selected_semester = '')
{
    $model = new ReportModel;
    $result = $model->get_user_course_with_filter($student_id, $selected_program_start, $start_program_date, $selected_program_end, $end_program_date, $selected_semester);
    return $result;
}

function get_size_of_semester($class, $semester, $unique_types)
{
    $model = new ReportModel;
    return $model->get_size_of_semester($class, $semester, $unique_types);
}

function getEmploymentInfos($Name)
{

    $model = new ApplicationModel;

    $result = $model->getEmploymentRecInfo($Name);

    return $result;
}


function check_user_active_or_not($emp_id)
{
    $model = new UsersModel;

    $result = $model->check_user_active_or_not($emp_id);

    return $result;
}

function get_assign_category($emp_id)
{

    $model = new UsersModel;

    $result = $model->get_assign_category($emp_id);

    return $result;
}


function get_time_report_hr_min_user_category_wise($user_id, $category_id, $selected_start_date = "", $selected_end_date = "")
{
    $model = new TimesheetModel();
    $result = $model->get_time_report_hr_min_user_category_wise($user_id, $category_id, $selected_start_date, $selected_end_date);
    return $result;
}

function minuteToHours($value)
{
    return ($value / 60) * 100;
}

function hourdecFormating($hr, $min)
{

    if ($min > 0) {
        $min = $min / 60;
    }
    $hr_min = $hr + $min;
    return number_format((float)$hr_min, 2, '.', '');
}

function hourmintodecFormating($hr)
{
    $exp = explode('.', $hr);
    $hr = $exp[0];
    $min = $exp[1];
    return hourdecFormating($hr, $min);
}

function getUniqueAddressByID($id)
{

    $model = new ApplicationModel;
    $result = $model->getUniqueAddress($id);

    return $result;
}

function getmonthlydonationsreports_without_tuition_credit_refund($month, $year)
{
    $model = new ReportModel;
    $result = $model->getmonthlydonationsreport_without_tuition_credit_refund($month, $year);
    return $result;
}

function check_linked_or_not($app_id)
{
    $model = new BuilderModel;
    $result = $model->check_linked_or_not($app_id);
    return $result;
}

function get_user_detail_by_id($student_id)
{
    $model = new ApplicationModel;
    return $model->get_user_detail_by_id($student_id);
}

function check_data_state($app_id)
{
    $model = new ApplicationModel;
    return $model->check_data_state($app_id);
}

function check_first_last_name_incomplete_form($name1 = '', $lastname = '')
{
    $model = new BuilderModel;
    return $model->check_first_last_name_incomplete_form($name1, $lastname);
}

function check_email_of_user($email)
{
    $model = new ApplicationModel;
    return $model->check_email_of_user($email);
}

function check_name_incomplete_form2($name1)
{
    $model = new BuilderModel;
    return $model->check_name_incomplete_form2($name1);
}

function calculated_attendance($param)
{

    $total_worked_hours = '';

    $total_left_hours = '';

    $total_worked =  hourMinuteFormating($param['hours_worked'], $param['minutes_worked']);

    if ($total_worked > $param['hours_to_work']) {

        $total_worked_hours = $param['hours_to_work'];
    } else {

        $total_worked_hours =  $total_worked;
    }



    $total_worked_days = $total_worked > $param['hours_to_work'] ? round($param['hours_to_work'] / 8) : round($total_worked / 8, 2);



    $total_left =   subtract_decimal_hours($param['hours_to_work'], $total_worked);

    $donated = $carry_over = "00.00";

    if ($total_left < 0) {

        $carry_over = abs($total_left);

        if ($carry_over > 80) {

            $donated = $carry_over - 80;

            $carry_over = $carry_over - $donated;
        }

        $total_left_hours = "00.00";
    } else {

        $total_left_hours =  $total_left;

        $carry_over = '-' . $total_left;
    }

    $total_left_days = $total_left < 0 ? "00.00" : round($total_left / 8, 2);

    $result['total_worked_hours'] = $total_worked_hours;

    $result['total_worked_days'] = $total_worked_days;

    $result['total_left_hours'] = $total_left_hours;

    $result['total_left_days'] = $total_left_days;

    $result['carry_over'] = $carry_over;

    $result['donated'] = $donated;

    return $result;
}

function subtract_decimal_hours($hours_first, $hours_second)
{
    $negative_sign = '';
    $hours_first_arr = explode('.', $hours_first);
    $hours_second_arr = explode('.', $hours_second);
    $first_in_minutes = (($hours_first_arr[0] * 60) + $hours_first_arr[1]);
    $second_in_minutes = (($hours_second_arr[0] * 60) + $hours_second_arr[1]);
    $rest_mintues = $first_in_minutes - $second_in_minutes;
    if ($rest_mintues < 0) {
        $negative_sign = '-';
        $rest_mintues = abs($rest_mintues);
    }
    $minutes = ($rest_mintues % 60);
    if ($minutes < 10) {
        $minutes = '0' . $minutes;
    }
    $hours_left_hr_min = (floor($rest_mintues / 60)) . '.' . $minutes;
    if ($negative_sign != '') {
        $hours_left_hr_min = $negative_sign . $hours_left_hr_min;
    }
    return $hours_left_hr_min;
}

function hourMinuteFormating($hr, $min)
{
    $minutes = ($min % 60);
    if ($minutes < 10) {
        $minutes = '0' . $minutes;
    }
    $hr_min = ($hr + floor($min / 60)) . '.' . $minutes;
    return $hr_min;
}

function get_total_crtificate_scholar_ship_student_by_sem_class($student_id, $class = '', $semester = '')
{
    $model = new ApplicationModel;

    $result = $model->get_total_crtificate_scholar_ship_student_by_sem_class($student_id, $class, $semester);

    return $result;
}

function get_certificate_total_tuition($student_id, $selected_filter_year = '', $selected_filter_semester = '')
{
    $model = new ApplicationModel;

    $result = $model->get_certificate_total_tuition($student_id, $selected_filter_year, $selected_filter_semester);

    return $result;
}

function get_certificate_total_credit($student_id, $selected_filter_year = '', $selected_filter_semester = '')
{
    $model = new ApplicationModel;

    $result = $model->get_certificate_total_credit($student_id, $selected_filter_year, $selected_filter_semester);

    return $result;
}

function get_total_scholar_ship_student_by_sem_class($student_id, $class = '', $semester = '')
{
    $model = new ApplicationModel;

    $result = $model->get_total_scholar_ship_student_by_sem_class($student_id, $class, $semester);

    return $result;
}

function get_total_tuition_adustment($student_id, $year, $semester)
{
    $model = new ApplicationModel;

    return $model->get_total_tuition_adustment($student_id, $year, $semester);
}

function get_total_credit($student_id, $selected_filter_year = '', $selected_filter_semester = '')
{
    $model = new ApplicationModel;

    $result = $model->get_total_credit($student_id, $selected_filter_year, $selected_filter_semester);

    return $result;
}

function get_total_tuition($student_id, $selected_filter_year = '', $selected_filter_semester = '')
{
    $model = new ApplicationModel;
    $result = $model->get_total_tuition($student_id, $selected_filter_year, $selected_filter_semester);

    return $result;
}

function getEmployment($id)
{

    $model = new ApplicationModel;

    $result = $model->getEmploymentByID($id);

    return $result;
}

function getDiplomaName($dipID)
{

    $model = new MasterModel;

    $result = $model->getDiplomaNameById($dipID);

    return $result;
}

function getCountryName($countrycode)
{

    $model = new ApplicationModel;

    $result = $model->getCountryNameByCode($countrycode);

    return $result;
}

function getAllPassport($class)
{

    $model = new ReportModel;

    $result = $model->getPassportYearwiseReport($class);

    return $result;
}

function calc_days($hrmin)
{
    $total_hour = floor($hrmin) + substr($hrmin, strpos($hrmin, ".") + 1) / 60;
    $total_days = $total_hour / 8;

    return number_format((float)$total_days, 2, '.', '');
}
function calc_hrtodays($hrmin)
{

    $total_days = $hrmin / 8;

    return number_format((float)$total_days, 2, '.', '');
}

function Hr_min_sum($hr_min)
{

    $total = hourMinuteFormating(floor($hr_min), substr($hr_min, strpos($hr_min, ".") + 1));
    return $total;
}

function get_category_total_emp($emp_id, $cat, $begin_date = '', $end_date = '')
{

    $model = new TimesheetModel;

    $result = $model->get_category_total_emp($emp_id, $cat, $begin_date, $end_date);

    return $result;
}

function check_any_sub_category($emp_id, $cat_id)
{
    $model = new TimesheetModel;

    $result = $model->check_any_sub_category($emp_id, $cat_id);

    return $result;
}

function getAllGraduates($class)
{

    $model = new ReportModel;

    $result = $model->StudentRecordListGraduateByClass($class);

    return $result;
}

function getAllContinue($class)
{

    $model = new ReportModel;

    $result = $model->StudentRecordListContinueByClass($class);

    return $result;
}

function getAllDeffered($class)
{

    $model = new ReportModel;

    $result = $model->StudentRecordListDefferedByClass($class);

    return $result;
}

function getAllWithdrawn($class)
{

    $model = new ReportModel;

    $result = $model->StudentRecordListWithdrawnByClass($class);

    return $result;
}

function getAllRegions($class)
{

    $model = new ReportModel;

    $result = $model->classListingRegionWiseRecords($class);

    return $result;
}

function getAllClassCountries($class)
{

    $model = new ReportModel;

    $result = $model->classListingCountryWiseRecords($class);

    return $result;
}


function getAllClassStudent($class)

{

    $model = new ReportModel;

    $result = $model->StudentCount($class);

    return $result;
}

function campaignsName($campaignsid)
{

    $model = new ApplicationModel;

    $result = $model->getCampaingnsNameByID($campaignsid);

    return $result;
}

function getTranscript($ID)
{

    $model = new ApplicationModel;

    $result = $model->getTranscriptByID($ID);

    return $result;
}

function getPassportInfo($StudentInfoID)
{

    $model = new ApplicationModel;

    $result = $model->getStudentPassportInfoByID($StudentInfoID);

    return $result;
}

function checkPassportStatus($studentid)
{

    $model = new ApplicationModel;

    $result = $model->checkPassport($studentid);

    return $result;
}

function getCertificateListing($ID)
{

    $model = new ApplicationModel;

    $result = $model->getCertificateListings($ID);

    return $result;
}

function getContactLogInfo($NameID)
{

    $model = new ApplicationModel;

    $result = $model->getContactLogByID($NameID);

    return $result;
}

function getContactType($cid)
{

    $model = new ApplicationModel;

    $result = $model->getContactTypeByID($cid);

    return $result;
}


// Student finance tab

function get_student_scholarship($id, $type, $student_id)
{
    $model = new ApplicationModel;

    $result = $model->get_student_scholarship($id, $type, $student_id);

    return $result;
}

function get_student_credit_amount($course_id, $student_id)
{
    $model = new ApplicationModel;

    return $model->get_student_credit_amount($course_id, $student_id);
}


function get_student_credit_scholar($course_id, $student_id)
{
    $model = new ApplicationModel;

    return $model->get_student_credit_scholar($course_id, $student_id);
}


function get_student_payment_detail_by_course($course_id, $student_id)
{
    $model = new ApplicationModel;

    return $model->get_student_payment_detail_by_course($course_id, $student_id);
}


function get_student_adjustment_detail($course_id, $student_id)
{
    $model = new ApplicationModel;

    return $model->get_student_adjustment_detail($course_id, $student_id);
}

function export_get_student_finance2($course_id, $type, $student_id)
{
    $model = new ApplicationModel;

    $result = $model->export_get_student_finance2($course_id, $type, $student_id);

    return $result;
}
