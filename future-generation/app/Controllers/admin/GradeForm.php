<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\GradeReportModel;
use App\Models\ApplicationModel;
use App\Models\ReportModel;

class GradeForm extends BaseController
{
    protected $Gradereport_model;
    protected $Application_model;
    protected $Report_model;

    function __construct()
    {
        $this->Gradereport_model = new GradeReportModel();
        $this->Application_model = new ApplicationModel();
        $this->Report_model = new ReportModel();
    }


     public function index()
    {
        //echo "<pre>";print_r($_SESSION['role']);die;
       $data['courses'] = $this->Gradereport_model->get_course_according_professor();
       //echo "<pre>";print_r($data['courses']);die;
       $data['content'] = 'backend/course_list_according_proffessor';
	   return view('backend/index', $data);
    }

    public function store_grade()
    {
        $query = $this->Gradereport_model->store_student_store_grade();
        session()->setFlashdata('msg', "Grade has been added successfully");
        session()->setFlashdata('msg_class', 'alert-success');
        return redirect()->to('admin/GradeForm/');
    }

     public function professor_list()
    {
        $data['professor_list']= $this->Gradereport_model->professor_list();
        //echo "<pre>";print_r($data['professor_list']);die;
        $data['content'] = 'backend/professor_list';
        if($this->request->getPost()){
            $type = 'SCH';
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';	
            $data['student'] = $this->Gradereport_model->get_sch_student_according_course($this->request->getPost('course'));
            $data['selected_grade']=$type;
            $data['course'] = $this->Gradereport_model->get_course($semester,$class);
        }else{
            $data['records']= array();
            $data['unique_types']= array();
            $data['course'] = array();
            $data['selected_grade'] = '';
        }
        $data['selected_professor'] = $this->request->getPost('professor');
        $data['grades'] = $this->Gradereport_model->get_active_grade();
        //echo "<pre>"; print_r($data['records']); die();
        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedclass'] = $class;
        $data['selectedSemester']= $semester; 
        $data['class']=$this->Application_model->getAllClass();
        $data['semesterlist'] = $this->Report_model->getAllSemsterList();
        // 02-05-2020
        $course_id = $this->request->getPost('course');
        $data['selectedcourse'] =$course_id;
        $data['eny_course'] = encryptor('encrypt', $course_id);
        $data['selected_course_detail'] = $this->Report_model->getCorse_details_by_ID($course_id); 
        return view('backend/index', $data);
    }
    
    public function get_course_by_professor()
    {
        $id = $this->request->getPost('id');
        $data['courses'] = $this->Gradereport_model->get_course_according_professor($id); 
        echo "<pre>";print_r($data['courses']);
    }
    
    public function assign_grade()
    {
        $course_id = encryptor('decrypt', $this->request->getUri()->getSegment(4));
        $data['student'] = $this->Gradereport_model->get_sch_student_according_course($course_id);
        $data['selected_course_detail'] = $this->Report_model->getCorse_details_by_ID($course_id);
        // echo "<pre>";print_r( $data['selected_course_detail']);die;
        $data['course_id'] = $this->request->getUri()->getSegment(4);
        $data['selectedcourse'] = $course_id;
        $data['grades'] = $this->Gradereport_model->get_active_grade();
        $data['content'] = 'backend/grade_form_student_list';
        return view('backend/index', $data);
    }
    
    
    public function getcourse()
    {
        $semester = $this->request->getPost('semester_id');
        $year =  $this->request->getPost('year');
        $course = $this->Gradereport_model->get_course($semester,$year);
        if($course){
            echo "<option value=''>Please Select Course</option>";
            foreach($course as $cr){
                echo "<option value='".$cr['CourseID']."'>".$cr['CourseTitle']."  (".$cr['Course'].")</option>";
            }
        }
        else{
            echo "<option value=''>No Course</option>";
        }
    }
    	
    public function lock_course_grade()
    {
        // check every data fill or not
        $check_data = $this->Gradereport_model->check_grade_assign_or_not();
        if($check_data){
            $data['errors'] = 'Please Fill All Grade';
            session()->setFlashdata('msg', $data['errors']);
            session()->setFlashdata('status', false);
            return redirect()->to('admin/GradeForm/');
            die;
        }
        $data = $this->Gradereport_model->lock_course_grade();
        if($data){
            session()->setFlashdata('msg',"Grade has been locked successfully");
            session()->setFlashdata('msg_class','alert-success');
            return redirect()->to('admin/GradeForm/');
        }
        else{
            session()->setFlashdata('msg',"Something wrong");
            session()->setFlashdata('msg_class','alert-danger');
            return redirect()->to('admin/GradeForm/');
        }
    }
}
