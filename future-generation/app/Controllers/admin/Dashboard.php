<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\ApplicationModel;

class Dashboard extends BaseController
{
    protected $applicationModel;
	protected $pager;

 public function __construct()
    {
        $this->applicationModel = new ApplicationModel();
		$this->pager = \Config\Services::pager();

    }

public function viewDashboard()
{
    $applicationModel = new \App\Models\ApplicationModel();

    $data['data']['total_contact'] = $applicationModel->total_contact_user();
    $data['data']['total_active_faculity'] = $applicationModel->total_active_faculity();
    $data['data']['total_past_faculity'] = $applicationModel->total_inactive_faculity();
    $data['data']['total_current_faculity'] = $applicationModel->total_current_student();
    $data['data']['total_formal_faculity'] = $applicationModel->total_formal_student();

    $data['data']['total_groups_wise_count'] = $applicationModel->total_groups_wise_count();
    $data['data']['campaigns_total_Amount'] = $applicationModel->getAllCampaignsWithAmount();
    $data['data']['total_finance_amount'] = $applicationModel->total_finance_amount();

    $data['data']['total_donation_amount'] = $applicationModel->total_donation_amount(); 
    $data['data']['total_tuition_amount'] = $applicationModel->total_tuition_amount();
    $data['data']['total_studentRefund_amount'] = $applicationModel->total_studentRefund_amount();
    $data['data']['total_studentCredit_amount'] = $applicationModel->total_studentCredit_amount();
    $data['data']['total_Americop_amount'] = $applicationModel->total_Americop_amount();
    $data['data']['total_certificateTuition_amount'] = $applicationModel->total_certificateTuition_amount();

    $data['data']['getOnlineApplicationCount'] = $applicationModel->getOnlineApplicationCount();

    // Important: 'content' should be top-level key
    $data['content'] = 'backend/dashboards';

    return view('backend/index', $data);
}

}
