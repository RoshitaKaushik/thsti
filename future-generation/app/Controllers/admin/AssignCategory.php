<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;

class AssignCategory extends BaseController
{
    protected $Users_model;

    function __construct()
    {
        admin_check_session();
        $this->Users_model = new UsersModel();
    }

    public function index()
    {
        if (session()->get('role') != '1' && in_array('13', session()->get('profiles'))) {
            $timesheet_menu = session()->get('timesheet_menu');
            $menu_status = check_menu_permission($timesheet_menu, '43');
            if (!$menu_status) {
                redirect('My401/');
            }
        }
        $data['team_name'] = $this->Users_model->getteam();

        // echo "<pre>";print_r($data['team_name']);echo "</pre>";die;
        $data['contract'] = $this->Users_model->getcontract2();
        // echo "<pre>";print_r($data['contract']);die;
        $data['catagory_name'] = $this->Users_model->getcategory();

        $data['content'] = 'backend/contractList';
        return view('backend/index', $data);
    }

    public function all_get_task_category()
    {
        $emp_id = $this->request->getPost('emp_id');
        $get_user_category = $this->Users_model->allgetcategorybyuser($emp_id);
        echo json_encode($get_user_category);
    }

    public function store_assign_category()
    {
        $result = $this->Users_model->insertAssignCategory();
        session()->setFlashdata('msg', 'Record Inserted Successfully');
        if ($this->request->getPost('type') == 'ajax') {
            $response['msg'] = 'Record Inserted Successfully';
            echo json_encode($response);
        } else {
            return redirect()->to('admin/AssignCategory/');
        }
    }

    public function get_task_category()
    {
        $emp_id = $this->request->getPost('emp_id');
        $get_user_category = $this->Users_model->getcategorybyuser($emp_id);
        echo json_encode($get_user_category);
    }

    public function remove_assign_category()
    {
        $result = $this->Users_model->removeAssignCategory();
        if ($this->request->getPost('type') == 'ajax') {
            $response['msg'] = 'Record Remove Successfully';
            echo json_encode($response);
        } else {
            session()->setFlashdata('msg', 'Record Remove Successfully');
            return redirect()->to('admin/AssignCategory/');
        }
    }
    public function add_remove_categoy()
    {
        $this->Users_model->add_remove_categoy();
        session()->setFlashdata('msg', 'Record Inserted Successfully');
        return redirect()->to('admin/AssignCategory/');
    }

    public function add_remove_assign_cat()
    {
         $emp_id = $this->request->getPost('emp_id');
         $get_user_category2 = $this->Users_model->getcategorybyuser($emp_id);
         $get_user_category1 = $this->Users_model->allgetcategorybyuser($emp_id);
         echo json_encode(array('category_list'=>$get_user_category1,'already_assign'=>$get_user_category2));
    }
}
