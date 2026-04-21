<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReportModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TimesheetModel;

class Timesheet extends BaseController
{
    protected $Timesheet_model;
    protected $Report_model;

    function __construct()
    {
        $this->request = \Config\Services::request();
        $this->Timesheet_model = new TimesheetModel;
        $this->Report_model = new ReportModel;
    }

    public function activeNewContractors()
    {
        $data['contractors'] = $this->Timesheet_model->getNewActiveContractors();
        $data['content'] = 'backend/newContractors';
        $data = $data;
        return view('backend/index', $data);
    }

    function filter_activeNewContractors()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $data['contractors'] = $this->Timesheet_model->getNewActiveContractors();

            return view('templates/filter/filter_newContractors', $data);
        }
    }

    public function getTransaction($empid)
    {
        $emp_id = encryptor('decrypt', $empid);
        /*echo $emp_id;
		exit;*/
        $data['empdetails'] = $this->Timesheet_model->getEmployeeNameById($emp_id);
        $data['contractor_details'] = $this->Timesheet_model->getAllContractTransaction($emp_id);
        //echo "<pre>";print_r($data['contractor_details']);die;

        //$data['contractor_detailss'] = unique_multidim_array($data['contractor_details'], 'id');
        /*echo "<pre>";
		print_r($data['contractor_details']);
		echo "</pre>";
		exit;*/

        $data['content'] = 'backend/view_contract_transaction';
        return view('backend/index', $data);
    }

    function admin_attendance($date = '', $User_option = '')
    {

        if (session()->get('role') != '1' && in_array('13', session()->get('profiles'))) {
            $timesheet_menu = session()->get('timesheet_menu');
            $menu_status = check_menu_permission($timesheet_menu, '42');
            if (!$menu_status) {
                redirect('My401/');
            }
        }

        if ($User_option != '') {
            $empid = $User_option;
        } else {
            $empid = session()->get('NAME_ID');
        }
        $data['facultystaff'] = $this->Report_model->Get_not_faculty_staff();

        if ($date == '') {
            $date = date('Y-m-d');
            $date_arr = explode('-', $date);
            $selected_month = $date_arr['1'];
            $selected_year = $date_arr['0'];
        } else {
            $date_arr = explode('-', $date);
            $date = implode('/', $date_arr);
            $date = $date_arr[2] . '-' . $date_arr[0] . '-' . $date_arr[1];

            $selected_year = $date_arr['2'];
            if ($date_arr['0'] < 10) {
                $selected_month = '0' . $date_arr['0'];
            } else {
                $selected_month = $date_arr['0'];
            }
        }
        //echo "<pre>";print_r($date); print_r($User_option); exit;
        $data['records_sum'] = $this->Report_model->getTotalforMonthlyReport($empid, $selected_year, $selected_month);
        //$data['category_arr'] = $this->Timesheet_model->getCategory($empid);
        // $data['records_categoryy'] = $this->Timesheet_model->getCategory($empid);
        $data['records_categoryy'] = $this->Timesheet_model->getCategoryNew($empid);
        $data['records_pcategoryy'] = $this->Timesheet_model->getpCategory($empid);
        $data['records_pscategoryy'] = $this->Timesheet_model->getpSCategory();
        $data['team_id'] = $this->Timesheet_model->get_teamid_bycontract($empid, $date);
        //echo "<pre>"; print_r($data['team_id']['teamid']); die();
        $data['active_contract'] = $activeContract = $this->Timesheet_model->getActiveContractorsByID_New($empid, $date);
        $data['activeContractForSave'] = $this->Timesheet_model->getActiveContractorsByID($empid, $date);
        $link_contract1 = array();
        $link_contract2 = array();
        $sum_fisical1 = array();
        $sum_fisical2 = array();
        if (!empty($activeContract)) {
            if ($activeContract[0]['min_contact_id'] != $activeContract[0]['max_contact_id']) {
                $link_contract1 =  $this->Timesheet_model->getActiveContractorsByContractID($empid, $activeContract[0]['min_contact_id']);
                $link_contract2 =  $this->Timesheet_model->getActiveContractorsByContractID($empid, $activeContract[0]['max_contact_id']);
            }
        }
        $data['link_contract1'] = $link_contract1;
        $data['link_contract2'] = $link_contract2;
        $data['contractor_details'] = $activeContract;
        $data['transactions'] = $this->Timesheet_model->getTransactionByDate($empid, $date);
        //

        $uniqecat = array_unique(array_column($data['transactions'], 'category_id'));

        $category = array();
        $pcategory = array();
        $pscategory = array();
        // for  category
        foreach ($data['records_categoryy'] as $key => $value) {

            if ($data['records_categoryy'][$key]['Active'] == '1') {
                $category[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $category[] = $value;
                }
            }
        }
        // for parent category
        foreach ($data['records_pcategoryy'] as $key => $value) {

            if ($data['records_pcategoryy'][$key]['Active'] == '1') {
                $pcategory[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $pcategory[] = $value;
                }
            }
        }
        // for parent category which have no subcategory
        foreach ($data['records_pscategoryy'] as $key => $value) {

            if ($data['records_pscategoryy'][$key]['Active'] == '1') {
                $pscategory[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $pscategory[] = $value;
                }
            }
        }

        $data['category_arr'] = $category;
        $data['pcategory_arr'] = $pcategory;
        $data['pscategory_arr'] = $pscategory;
        /*  echo "<pre>"; print_r($data['category_arr']);
	    // echo "<pre>"; print_r($category);
	    die();*/
        $data['date'] = date('m/d/Y', strtotime($date));
        $data['empid'] = $empid;
        /* $data['content'] = 'backend/addAttendance';*/
        $data['content'] = 'backend/admin_addAttendance';
        return view('backend/index', $data);
    }

    function admin_addAttendance()
    {
        $response = array();
        $records = array();
        $contract_arr = array();

        $param = $this->request->getPost();
        $syncData = $param['syncData'];
        $sync_date_time = $param['transaction_date'];
        $team_superviser = $this->Timesheet_model->getTeam_supervisor($param['team_id']);

        //echo $sync_date_time;die;
        //echo "<pre>";print_r($team_superviser['empid']); die;
        /* echo "<pre>"; print_r($_POST); die;*/
        // try {

        foreach ($syncData as $key => $data) {
            if (($param['lock_button']) == "lock_previous") {
                $previous = "lock";
            } else {
                $previous = "unlock";
            }
            if ($data['hours'] != '' || $data['min'] != '') {

                $data['empid'] = $param['empid'];
                $data['team_id'] = @$param['team_id'];
                $data['team_superviser'] = @$team_superviser['empid'];
                $data['transaction_date'] = $sync_date_time;
                $data['hours'] = $data['hours'] . '.' . $data['min'];
                $data['datesubmitted'] = date('Y-m-d H:i:s');
                $data['submitted_by'] = $param['empid'];
                $data['islock'] = $param['islock'];
                $data['finalsubmit_date'] = $param['islock'] == 0 ? '' : date('Y-m-d H:i:s');
                $data['contract_id'] = $param['contract_id'];
                $data['sync_status'] = 1;
                $data['deviceid'] = $param['deviceid'];
                $data['sync_date_time'] = $param['islock'] == 0 ? '' : date('Y-m-d H:i:s');
                $data['office_status'] = isset($data['office_status']) ?
                    ($data['office_status'] == '1' ? '1' : '0') :
                    '0';

                unset($data['min']);
                // echo "<pre>";print_r($data);//die;
                $result = $this->Timesheet_model->updateTimesheet_new($data, $previous);

                if ($result['status']) {
                    $records[] = $result['record'];
                }
            } else {
                unset($syncData[$key]);
            }
        }

        // die('bb');

        if (empty($records) && $result['status']) {
            $response['status'] = NO_RECORD_CODE;
            $response['msg'] = "Not Updated";
        } else {
            $response['status'] = SUCCESS_CODE;
            $response['msg'] = "Updated";
        }

        $response['syncData'] = $records;
        // } catch (\Exception $e) {
        //     $response['status'] = EXCEPTION_CODE;
        //     $response['msg'] = $e->getMessage();
        //     $response['syncData'] = $records;
        // }

        if ($response['status'] == SUCCESS_CODE) {
            session()->setFlashdata('msg', 'Updated');
        } else {
            session()->setFlashdata('msg', 'Not Updated');
        }

        $date_submit = str_replace('/', '-', $sync_date_time);
        return redirect()->to('admin/Timesheet/admin_attendance/' . $date_submit . '/' . $param['empid']);
    }

    function attendance($date = '')
    {
        // echo "<pre>";print_r($_SESSION);die;
        $empid = session()->get('NAME_ID');

        if (!isset($empid)) {
            $data['content'] = 'backend/message_page';
            return view('backend/index', $data);

            die;
        }

        if ($date == '') {
            $date = date('Y-m-d');
            $date_arr = explode('-', $date);
            $selected_month = $date_arr['1'];
            $selected_year = $date_arr['0'];
        } else {
            $date_arr = explode('-', $date);
            $date = implode('/', $date_arr);
            $date = $date_arr[2] . '-' . $date_arr[0] . '-' . $date_arr[1];

            $selected_year = $date_arr['2'];
            if ($date_arr['0'] < 10) {
                $selected_month = '0' . $date_arr['0'];
            } else {
                $selected_month = $date_arr['0'];
            }
        }
        $data['records_sum'] = $this->Report_model->getTotalforMonthlyReport($empid, $selected_year, $selected_month);
        //$data['category_arr'] = $this->Timesheet_model->getCategory($empid);
        $data['records_categoryy'] = $this->Timesheet_model->getCat($empid);

        //echo "<pre>";print_r($data['records_categoryy']);exit();


        $data['records_pcategoryy'] = $this->Timesheet_model->getpCategory($empid);
        $data['records_pscategoryy'] = $this->Timesheet_model->getpSCategory();
        $data['team_id'] = $this->Timesheet_model->get_teamid_bycontract($empid, $date);
        //echo "<pre>"; print_r($data['team_id']['teamid']); die();
        //$data['active_contract'] = $this->Timesheet_model->getActiveContractorsByID($empid, $date);
        $data['active_contract'] =  $activeContract = $this->Timesheet_model->getActiveContractorsByID_New($empid, $date);


        $data['activeContractForSave']  = $this->Timesheet_model->getActiveContractorsByID($empid, $date);


        //echo $this->db->last_query();die();
        $data['transactions'] = $this->Timesheet_model->getTransactionByDate($empid, $date);
        $data['activeContractForSave'] = $this->Timesheet_model->getActiveContractorsByID($empid, $date);

        $link_contract1 = array();
        $link_contract2 = array();
        $sum_fisical1 = array();
        $sum_fisical2 = array();
        if (!empty($activeContract)) {
            if ($activeContract[0]['min_contact_id'] != $activeContract[0]['max_contact_id']) {
                $link_contract1 =  $this->Timesheet_model->getActiveContractorsByContractID($empid, $activeContract[0]['min_contact_id']);
                $link_contract2 =  $this->Timesheet_model->getActiveContractorsByContractID($empid, $activeContract[0]['max_contact_id']);
            }
        }

        $data['link_contract1'] = $link_contract1;
        $data['link_contract2'] = $link_contract2;
        $uniqecat = array_unique(array_column($data['transactions'], 'category_id'));

        $category = array();
        $pcategory = array();
        $pscategory = array();
        // for  category
        foreach ($data['records_categoryy'] as $key => $value) {

            if ($data['records_categoryy'][$key]['Active'] == '1') {
                $category[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $category[] = $value;
                }
            }
        }
        // for parent category
        foreach ($data['records_pcategoryy'] as $key => $value) {

            if ($data['records_pcategoryy'][$key]['Active'] == '1') {
                $pcategory[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $pcategory[] = $value;
                }
            }
        }
        // for parent category which have no subcategory
        foreach ($data['records_pscategoryy'] as $key => $value) {

            if ($data['records_pscategoryy'][$key]['Active'] == '1') {
                $pscategory[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $pscategory[] = $value;
                }
            }
        }

        $data['category_arr'] = $category;
        $data['pcategory_arr'] = $pcategory;
        $data['pscategory_arr'] = $pscategory;
        /*  echo "<pre>"; print_r($data['category_arr']);
	    // echo "<pre>"; print_r($category);
	    die();*/
        $data['date'] = date('m/d/Y', strtotime($date));
        $data['empid'] = $empid;
        /* $data['content'] = 'backend/addAttendance'; */
        $data['content'] = 'backend/addAttendance_example';
        return view('backend/index', $data);
    }

    function addAttendance()
    {
        $response = array();
        $records = array();
        $contract_arr = array();

        $param = $this->request->getPost();


        $syncData = $param['syncData'];
        $sync_date_time = $param['transaction_date'];
        $team_superviser = $this->Timesheet_model->getTeam_supervisor($param['team_id']);

        //echo $sync_date_time;die;
        //echo "<pre>";print_r($team_superviser['empid']); die;


        // try{	 
        $result = array();
        foreach ($syncData as $key => $data) {


            if (isset($param['lock_button']) ?? '' == "not_lock") {
                $previous = "unlock";
            } else {
                $previous = "lock";
            }

            /*if($param['lock_button']=="lock_previous"){
					$previous="lock";					
				}
				else {
					$previous="unlock";
				}*/

            if ($data['hours'] != '' || $data['min'] != '') {

                $data['empid'] = $param['empid'];
                $data['team_id'] = $param['team_id'];
                $data['team_superviser'] = $team_superviser['empid'];
                $data['transaction_date'] = $sync_date_time;
                $data['hours'] = $data['hours'] . '.' . $data['min'];
                $data['datesubmitted'] = date('Y-m-d H:i:s');
                $data['submitted_by'] = $param['empid'];
                $data['islock'] = $param['islock'];
                $data['finalsubmit_date'] = $param['islock'] == 0 ? '' : date('Y-m-d H:i:s');
                $data['contract_id'] = $param['contract_id'];
                $data['sync_status'] = 1;
                $data['deviceid'] = $param['deviceid'];
                $data['sync_date_time'] = $param['islock'] == 0 ? '' : date('Y-m-d H:i:s');
                $data['office_status'] = isset($data['office_status']) ? ($data['office_status'] == '1' ? '1' : '0') : '0';

                unset($data['min']);
                $result = $this->Timesheet_model->updateTimesheet_new_modal($data, $previous);


                if ($result['status']) {
                    $records[] = $result['record'];
                }
            } else {
                unset($syncData[$key]);
            }
        }


        if (empty($records) && $result['status']) {
            $response['status'] = NO_RECORD_CODE;
            $response['msg'] = "Not Updated";
        } else {
            $response['status'] = SUCCESS_CODE;
            $response['msg'] = "Updated";
        }

        $response['syncData'] = $records;

        // }catch(\Exception $e){
        //     print_r( $e->getMessage());die;
        //     $response['status'] = EXCEPTION_CODE;
        //     $response['msg'] = $e->getMessage();
        //     $response['syncData'] = $records;
        // }

        if ($response['status'] == SUCCESS_CODE) {
            session()->setFlashdata('msg', 'Updated');
        } else {
            session()->setFlashdata('msg', 'Not Updated');
        }

        $date_submit = str_replace('/', '-', $sync_date_time);
        return redirect()->to('admin/Timesheet/attendance/' . $date_submit);
    }

    public function admin_indivisual_report($class = '')
    {
        $data['facultystaff'] = $this->Report_model->Get_not_faculty_staff();
        $selected_year = $this->request->getPost('Financial_Y') ?? getfinancialyear_june(date("d-m-Y"));
        $data['selected_year'] = $selected_year;

        $application_id = $this->request->getPost('User_option') && $this->request->getPost('User_option') != 0
            ? $this->request->getPost('User_option')
            : session()->get('NAME_ID');

        $data['fisical_year'] = explode(",", $this->Report_model->getAllFisicalyear());
        $data['records'] = $this->Report_model->getEmpDailyAttendance_Bymonth($application_id, $selected_year);
        $data['sum_hr_mnth'] = $this->Report_model->getTotalforFisicalReportByMonth($application_id, $selected_year);
        $data['sum_hr_cat'] = $this->Report_model->getTotalforFisicalReportByCat($application_id, $selected_year);
        $data['records_categoryy'] = $this->Timesheet_model->getCategory($application_id);

        $uniqecat = array_unique(array_column($data['records'], 'category_id'));
        $category = [];
        foreach ($data['records_categoryy'] as $value) {
            if ($value['Active'] == '1' || in_array($value['id'], $uniqecat)) {
                $category[] = $value;
            }
        }
        $data['records_category'] = $category;

        $data['empid'] = $application_id;
        $ContractorDetails = $this->Timesheet_model->getActiveContractorsByIDFisical_New($application_id, $selected_year);
        $data['contractor_details'] = $ContractorDetails;
        $result = $ContractorDetails;

        // ✅ Initialize all possible variables before use
        $link_contract1 = $link_contract2 = [];
        $sum_fisical1 = $sum_fisical2 = [];

        if (!empty($ContractorDetails)) {
            if ($ContractorDetails[0]['min_contact_id'] != $ContractorDetails[0]['max_contact_id']) {
                $link_contract1 = $this->Timesheet_model->getActiveContractorsByContractID($application_id, $ContractorDetails[0]['min_contact_id']);
                $link_contract2 = $this->Timesheet_model->getActiveContractorsByContractID($application_id, $ContractorDetails[0]['max_contact_id']);
                $sum_fisical1 = $this->Report_model->getTotalforFisicalYearByContractId($application_id, $ContractorDetails[0]['min_contact_id']);
                $sum_fisical2 = $this->Report_model->getTotalforFisicalYearByContractId($application_id, $ContractorDetails[0]['max_contact_id']);
            }
        }

        $sum_hours = $cary_sum_hours = 0;
        foreach ($result as $value) {
            $sum_hours += $value['hours_to_work'];
            $cary_sum_hours += $value['CarriedOverHours'];
        }

        $data['sum_hr'] = $this->Report_model->getTotalforFisicalReport($application_id, $selected_year);

        if (!empty($result)) {
            $data['main_sum_hr'] = $this->Report_model->getTotalforFisicalYear_2(
                $application_id,
                $result[0]['contract_begin_date'],
                $result[0]['contract_end_date']
            );
        }

        // Start Contract => 1
        $sum_hours1 = $cary_sum_hours1 = $sum_mins1 = $cary_sum_mins1 = 0;
        foreach ($link_contract1 as $value) {
            $sum_hours1 += $value['hours_to_work'];
            $cary_sum_hours1 += $value['CarriedOverHours'];
        }
        $data['Sum_hour_contract_1'] = $sum_hours1;
        $data['Sum_mins_contract_1'] = $sum_mins1;
        $data['cary_Sum_hour_contract_1'] = $cary_sum_hours1;
        $data['cary_Sum_mins_contract_1'] = $cary_sum_mins1;
        $data['sum_fisical_1'] = $sum_fisical1;

        // Start Contract => 2
        $sum_hours2 = $cary_sum_hours2 = $sum_mins2 = $cary_sum_mins2 = 0;
        foreach ($link_contract2 as $value) {
            $sum_hours2 += $value['hours_to_work'];
            $cary_sum_hours2 += $value['CarriedOverHours'];
        }
        $data['Sum_hour_contract_2'] = $sum_hours2;
        $data['Sum_mins_contract_2'] = $sum_mins2;
        $data['cary_Sum_hour_contract_2'] = $cary_sum_hours2;
        $data['cary_Sum_mins_contract_2'] = $cary_sum_mins2;
        $data['sum_fisical_2'] = $sum_fisical2;

        // Assign to view
        $data['link_contract1'] = $link_contract1;
        $data['link_contract2'] = $link_contract2;
        $data['Sum_hour_contract'] = $sum_hours;
        $data['cary_Sum_hour_contract'] = $cary_sum_hours;

        $data['content'] = 'backend/admin_indivisual_financialyear_report.php';
        $data = $data;

        return view('backend/index', $data);
    }
}
