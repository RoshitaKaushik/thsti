<?php

namespace App\Controllers\FormBuilder;

use App\Controllers\BaseController;
use App\Models\BuilderModel;

class Application extends BaseController
{
    protected $Builder_model;

    public function __construct()
    {
        helper('function'); // Load custom helper
        $this->Builder_model = new BuilderModel();
    }

    public function index()
    {
        //
    }

    function get_unread_application_forms()
    {
        $user_id = session()->get('USER_ID');
        $data = $this->Builder_model->get_unread_application_forms($user_id);
        echo $data;
    }

    function get_unread_formbuilder_forms()
    {
        $user_id = session()->get('USER_ID');
        $data = $this->Builder_model->get_unread_formbuilder_forms($user_id);
        echo $data;
    }

    public function reportfilterpendingScheme()
    {
        $access_components = session()->get('component_ids');
        //echo $access_components; die;		 
        if (!is_array($access_components)) {
            $access_components = [];
        }
        $status = 3;
        $data['apps'] = $this->Builder_model->getAppAdmin($access_components, $status);
        $user_id = session()->get('USER_ID');
        if (session()->get('role') == '1') {
            $data['form_list'] =  $this->Builder_model->getallComponent($user_id);
        } else {
            $data['form_list'] =  $this->Builder_model->user_wise_getallComponent($user_id);
        }
        $data['page'] = 'Form Report';
        $data['content'] = 'formbuilder/viewreportfilterAllApplication';
        return view('formbuilder/index', $data);
    }

    public function get_component_wise_data()
    {
        $action = $this->request->getPost('submit');

        if ($action == 'filter') {
            $component_id = $this->request->getPost('id');
            $status = 3;
            $not_show_field_type = array('5', '11', '16', '18', '20', '21');
            $custums = $this->Builder_model->drop_field_type_getCustomFieldsActive($component_id, $not_show_field_type);
            $field_ids = array_column($custums, 'field_id');
            //$field_ids_string = implode(",",$field_ids);

            $result = $this->Builder_model->get_form_details_with_component_field($field_ids, $component_id);

            if ($custums) {
                echo "<table class=' table-striped table-bordered dataTable no-footer' id='tableID' style='width:100%;'>";
                echo '<thead>';
                echo '<tr>';
                echo '<th>S.NO</th>';
                echo '<th>Date & Time</th>';
                echo '<th>Application Code</th>';
                foreach ($custums as $c) {
                    echo '<th>' . $string = substr($c['field_name'], 0, 80) . '</th>';
                }
                echo '</tr>';
                echo '</thead>';
            }
            $sn = 1;
            foreach ($result as $res) {
                $form_field_val = json_decode($res['form_fields']);
                // $fieldIdValues = array_column($form_field_val, 'field');
                echo "<tr>";
                echo "<td>" . $sn++ . "</td>";
                echo "<td>" . date('m/d/Y', strtotime($res['created_date'])) . "</td>";
                echo "<td>" . $res['application_code'] . "</td>";
                if (is_array($form_field_val)) {
                    $fieldIdValues = array_column($form_field_val, 'field');
                    foreach ($field_ids as $ids) {
                        if (in_array($ids, $fieldIdValues)) {
                            $position = array_search($ids, $fieldIdValues);
                            echo "<td>" . $form_field_val[$position]->field_value . "</td>";
                        } else {
                            echo "<td></td>";
                        }
                    }
                }
                echo "</tr>";
            }
        }
    }

    function update_exception_date()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $data = $this->Builder_model->update_exception_date();
            return true;
        } else {
            return false;
        }
    }

    function reportpendingScheme()
    {
        $access_components = session()->get('component_ids');
        $status = 3;
        if ($this->request->getPost()) {
            $data['apps'] = $this->Builder_model->getAppAdmin($access_components, $status);
        }
        // $data['form_list'] = $this->Builder_model->getallComponent();
        $user_id = session()->get('USER_ID');
        if (session()->get('role') != '1') {
            $data['form_list'] =  $this->Builder_model->user_wise_getallComponent($user_id);
        } else {
            $data['form_list'] = $this->Builder_model->getallComponent();
        }

        if (count($data['form_list']) == 1) {
            $data['single_component_selected'] = true;
        } else {
            $data['single_component_selected'] = false;
        }

        $data['page'] = 'Form Report';
        $data['content'] = 'formbuilder/viewreportAllApplication';
        $data = $data;
        return view('formbuilder/index', $data);
    }

    public function filter_data()
    {
        $component_id = $this->request->getPost('component_id');
        $application_id = $this->request->getPost('application_id');
        $credit  = $this->request->getPost('credit');
        $data['apps'] = '';
        $assign_user_approval_status = $this->Builder_model->checkAssignUserForm($component_id);
        $status = 3;
        $field_id = '';
        if ($component_id == 6) {
            $field_id = 62;
        } else if ($component_id == 7) {
            $field_id = 100;
        }
        if ($this->request->getPost()) {
            $data['apps'] = $this->Builder_model->getAppAdmin_byapplication_credit($status, $application_id, $credit, $component_id);
        } else {
            $data['apps'] = array();
        }

        $access_components = session()->get('component_ids');
        $data['assign_user_approval_status'] =  $assign_user_approval_status;
        $data['select_component'] = $component_id;
        $data['select_application'] = $application_id;
        $data['select_credit'] = $credit;
        $user_id = session()->get('USER_ID');
        $data['form_list'] =  $this->Builder_model->user_wise_getallComponent($user_id);
        $data['page'] = 'Form Report';
        $data['content'] = 'formbuilder/viewfilter_reportAllApplication';
        return view('formbuilder/index', $data);
    }

    function check_dropddown()
    {

        $form_id = $this->request->getPost('form_id');
        // $form_id =7;
        $data = $this->Builder_model->check_drop_getCustomFieldsActive($form_id);
        //echo "<pre>";print_r($data);
        echo json_encode($data);
    }

    public function filter_formbuilder_form()
    {

        $component_id = $this->request->getPost('component_id');
        $application_id = $this->request->getPost('application_id');
        $credit = '';
        if (is_array($this->request->getPost('credit'))) {
            $credit  = array_filter($this->request->getPost('credit'));
        }

        $assign_user_approval_status = $this->Builder_model->checkAssignUserForm($component_id);
        $status = 3;
        $field_id = '';
        if ($component_id == 6) {
            $field_id = 62;
        } else if ($component_id == 7) {
            $field_id = 100;
        }
        $data['apps'] = $this->Builder_model->getAppAdmin_byapplication_credit($status, $application_id, $credit, $component_id);
        $access_components = session()->get('component_ids');
        $data['assign_user_approval_status'] =  $assign_user_approval_status;
        $data['select_component'] = $component_id;
        $data['select_application'] = $application_id;
        $data['select_credit'] = $credit;
        $user_id = session()->get('USER_ID');
        $data['form_list'] =  $this->Builder_model->user_wise_getallComponent($user_id);
        return view('templates/filter/filter_viewfilter_reportAllApplication', $data);
    }

    public function delete_user_data()
    {

        $data = $this->Builder_model->delete_user_data();
        session()->setFlashdata('msg', 'Record Deleted Successfully. . . ');
        return redirect()->to('formbuilder/Application/pendingScheme');
    }

    public function signApplicationForm()
    {

        $status = $this->request->getPost('status');
        if ($status == 'reject') {
            $rules = [
                'reason' => [
                    'label' => 'Reason',
                    'rules' => 'required'
                ]
            ];
            // $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            // $this->form_validation->set_rules('reason', 'Reason', 'required');
            if (!$this->validate($rules)) {
                $form_type = $this->request->getPost('formType');
                if ($form_type) {
                    if ($form_type == 'filter_data') {
                        // failure
                        session()->setFlashdata('msg', '<p class="alert alert-danger">Please fill a reason for rejection.</p>');
                        return redirect()->to('formbuilder/Application/filter_data');
                    }
                }
                session()->setFlashdata('msg', '<p class="alert alert-danger">Please fill a reason for rejection.</p>');
                return redirect()->to('formbuilder/Application/reportpendingScheme');
            }
        }
        $result = $this->Builder_model->signApplicationForm();
        if ($result) {
            // success
            $form_type = $this->request->getPost('formType');
            if ($form_type) {
                if ($form_type == 'filter_data') {
                    //success
                    session()->setFlashdata('msg', '<p class="alert alert-success">Status updated successfully</p>');
                    return redirect()->to('formbuilder/Application/filter_data');
                }
            }
            session()->setFlashdata('msg', '<p class="alert alert-success">Status updated successfully</p>');
            return redirect()->to('formbuilder/Application/reportpendingScheme');
        } else {
            $form_type = $this->request->getPost('formType');
            if ($form_type) {
                if ($form_type == 'filter_data') {
                    // failure
                    session()->setFlashdata('msg', '<p class="alert alert-danger">Something went wrong, Try again later.</p>');
                    return redirect()->to('formbuilder/Application/filter_data');
                }
            }
            // failure
            session()->setFlashdata('msg', '<p class="alert alert-danger">Something went wrong, Try again later.</p>');
            return redirect()->to('formbuilder/Application/reportpendingScheme');
        }
    }

    function pendingScheme(){	
        ini_set('max_execution_time', 1300);
        $access_components = session()->get('component_ids');
        //echo $access_components; die;		
        $status = 3;
        $data['apps'] = $this->Builder_model->getAppAdmin($access_components, $status);
        //echo '<pre>'; print_r($data['apps']); die;
        $data['page']='Application';
        $data['content'] = 'formbuilder/viewAllApplication';
        return view('formbuilder/index', $data);
	}

    public function bulk_delete_user_data()
	{
	     $data = $this->Builder_model->bulk_delete_user_data();
	     session()->setFlashdata('msg', 'Record Deleted Successfully. . . ');
	     return redirect()->to('formbuilder/Application/pendingScheme');
	    
	}

    public function deleted_record()
	{
	    $access_components = session()->get('component_ids');
        //echo $access_components; die;		
		$status = 3;
	    $data['apps'] = $this->Builder_model->getDeleteAppAdmin($access_components, $status);

		//echo '<pre>'; print_r($data['apps']); die;
		$data['page']='pending';
        $data['content'] = 'formbuilder/viewADeletedApplication';
		return view('formbuilder/index', $data);
	    
	}

    public function bulk_restore_user_data()
	{
	    $data = $this->Builder_model->bulk_restore_user_data();
	     session()->setFlashdata('msg', 'Record Restore Successfully. . . ');
	     redirect('formbuilder/Application/pendingScheme');
	}

    function viewTrasaction(){
		$access_components = session()->get('component_ids');		
		$status = 1;
        $data['apps'] = $this->Builder_model->getAppTransaction($access_components, $status);	
	    //echo $this->formbuilder->db->last_query();die;
		$data['page']='approved';
        $data['content'] = 'formbuilder/viewapplicationTrasaction';
		return view('formbuilder/index', $data);
		
	}
}
