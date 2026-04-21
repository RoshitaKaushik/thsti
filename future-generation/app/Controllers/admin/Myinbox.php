<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\MyinboxModel;
use CodeIgniter\HTTP\ResponseInterface;

class Myinbox extends BaseController
{
    protected $MyinboxModel;
    function __construct(){
		$this->MyinboxModel = new MyinboxModel();
		
    }

    public function index()
    {
        $data['grade_course_detail'] = $this->MyinboxModel->grade_course_detail();
       // echo "<pre>";print_r($data['grade_course_detail']);die;
        $data['content'] = 'backend/myinbox';
       	return view('backend/index', $data);
    }

    public function get_unread_message()
    {
        $data = $this->MyinboxModel->get_unread_message();
        echo $data;
    }

      public function grade_list()
    {
       $course_id = encryptor('decrypt', service('uri')->getSegment(4));
       
       $this->MyinboxModel->update_read_status($course_id);
       
       $data['grade_course_detail'] = $this->MyinboxModel->get_grade_wise_course($course_id);
       //echo "<pre>";print_r($data['grade_course_detail'] );
       $data['content'] = 'backend/grade_list';
       return view('backend/index', $data);
        
    }

    public function approve_course()
    {
         $this->MyinboxModel->update_read_status($this->request->getPost('course_id'));
        $this->MyinboxModel->update_grade_course_detail();
        	session()->setFlashdata('msg', 'approve Successfully . . .');
			return	redirect()->to('admin/Myinbox');
    }

    public function reject_course()
    {
        $this->MyinboxModel->update_read_status($this->request->getPost('course_id'));
        $this->MyinboxModel->reject_grade_course_detail();
        	session()->setFlashdata('msg', 'Rejected Successfully . . .');
			return	redirect()->to('admin/Myinbox');
    }
}
