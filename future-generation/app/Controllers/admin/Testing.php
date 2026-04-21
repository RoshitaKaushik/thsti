<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TimesheetModel;
use App\Models\ReportModel;
use CodeIgniter\HTTP\ResponseInterface;

class Testing extends BaseController
{
    protected $Timesheet_model;
    protected $Report_model;
    protected $pager;
    protected $session;

    public function __construct()
    {

        $this->Report_model = new ReportModel;
        $this->Timesheet_model = new TimesheetModel;
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        //
    }

    function attendance($date = '')
    {

        $empid = session()->get('NAME_ID');
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
        //$data['records_categoryy'] = $this->Timesheet_model->getCategory($empid);
        $data['records_categoryy'] = $this->Timesheet_model->getCat($empid);
        $data['records_pcategoryy'] = $this->Timesheet_model->getpCategory($empid);
        //$data['records_pscategoryy'] = $this->Timesheet_model->getpSCategory();
        $data['records_pscategoryy'] = $this->Timesheet_model->getpSCat();
        /*echo "<pre>"; print_r($data['records_pscategoryy']); die();*/
        //$data['active_contract'] = $this->Timesheet_model->getActiveContractorsByID($empid, $date);
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
        $data['content'] = 'backend/addAttendance';
        /* $data['content'] = 'backend/addAttendance_example';*/
        return view('backend/index', $data);
    }

    function addAttendance()
    {
        $response = array();
        $records = array();
        $contract_arr = array();

        $param = $this->request->getPost();
        //echo "<pre>";print_r($param);echo "</pre>";die();
        $syncData = $param['syncData'];
        $sync_date_time = $param['transaction_date'];

        //echo $sync_date_time;die;
        /*echo "<pre>";print_r($syncData); die;*/
        /* echo "<pre>"; print_r($_POST); die;*/
        try {
            foreach ($syncData as $key => $data) {
                if ($param['lock_button'] == "lock_previous") {
                    $previous = "lock";
                } else {
                    $previous = "unlock";
                }

                if ($data['hours'] != '' || $data['min'] != '') {

                    $data['empid'] = $param['empid'];
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

                    $data['office_status'] = isset($data['office_status']) ? $data['office_status'] == ('1' ? '1' : '0') : '0';

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
        } catch (\Exception $e) {
            $response['status'] = EXCEPTION_CODE;
            $response['msg'] = $e->getMessage();
            $response['syncData'] = $records;
        }

        if ($response['status'] == SUCCESS_CODE) {
            session()->setFlashdata('msg', 'Updated');
        } else {
            session()->setFlashdata('msg', 'Not Updated');
        }

        $date_submit = str_replace('/', '-', $sync_date_time);
        return redirect()->to('admin/Testing/attendance/' . $date_submit);
    }
}
