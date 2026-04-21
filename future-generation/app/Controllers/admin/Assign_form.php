<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\BuilderModel;

class Assign_form extends BaseController
{
    protected $usersModel;
    protected $builderModel;

    function __construct()
    {
        admin_check_session();
        $this->usersModel = new UsersModel();
        $this->builderModel = new BuilderModel();
    }

    public function index()
    {
        $data['form_list'] = $this->builderModel->getallComponent();
        $data['content'] = 'formbuilder/form_list';
        return view('formbuilder/index', $data);
    }

    public function get_user_already_assign()
    {
        $id = $this->request->getPost('id');

        $result = $this->usersModel->alreadyAssignuserinForm($id);
        //echo "<pre>";print_r($result);die;


        echo "<h4><u>Assigned User</u></h4>";
        foreach ($result as $r) {

            echo "<span class='removeaddcat' rel_email='" . $r['admin_email'] . "' rel_name='" . $r['admin_fullname'] . "' rel_id=" . $r['admin_id'] . " id='addcat" . $r['admin_id'] . "'><input type='hidden' class='form-control' value=" . $r['admin_id'] . " name='cat_id[]'/><p>" . $r['admin_fullname'] . " (" . $r['admin_email'] . ")<br/></p></span>";
        }
    }

    public function get_user()
    {
        $id = $this->request->getPost('id');
        $result = $this->usersModel->getUsers_for_form($id);

        echo "<h4><u>Current User</u></h4>";
        foreach ($result as $res) {
            echo "<p class='modal_cat' rel_email='" . $res['admin_email'] . "' rel_name='" . $res['admin_fullname'] . "' id='cat" . $res['admin_id'] . "' rel_id=" . $res['admin_id'] . ">" . $res['admin_fullname'] . " (" . $res['admin_email'] . ")<br/></p>";
        }
    }

    public function store_assign_user_form()
    {
        $result = $this->usersModel->insertAssignForm();
        //echo "<pre>";print_r($_POST);die;
        session()->setFlashdata('msg', 'Record Inserted Successfully');
        return redirect()->to('admin/Assign_form');
    }
}
