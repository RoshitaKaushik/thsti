<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MasterModel;

class Registrar extends BaseController
{
    protected $Master_model;
    protected $request;

    function __construct()
    {
        $this->request = \Config\Services::request();
        $this->Master_model = new MasterModel;
    }

    public function index()
    {
        //
    }

    public function deleteCourselist($CourseID = '') {
	   // Check if record exists in CertTranscipt table
	   if($CourseID != '') { 
	        $CourseID =  encryptor('decrypt', $CourseID);
	        $result = $this->Master_model->getTranscript($CourseID);
	        
	        
	        
	        //echo $this->db->last_query();die;
	        if($result) {
	            $assign_user = $this->Master_model->get_assign_user_in_transcript($CourseID);
	            $assign_user = array_column($assign_user, 'ID');
	            $assign_user = implode(",",$assign_user);
	           
	            session()->setFlashdata('msg','<div class="alert alert-danger">This course is already associated with the student.('.$assign_user.')</div>');
	            return redirect()->to('admin/Registrar/addCourselist');
   
	        } else {
	            // make copy in delete table 
	            $result = $this->Master_model->copy_in_delCourseList($CourseID);
	            
	            if($result) {
	                // then delete from the courselist table 
	                $result = $this->Master_model->del_in_courselist($CourseID);
	                if($result) {
	                    session()->setFlashdata('msg','<div class="alert alert-success">Record deleted successfully</div>');
	                    return redirect()->to('admin/Registrar/addCourselist');
	                } else {
	                    session()->setFlashdata('msg','<div class="alert alert-danger">Record cannot be deleted . Please try later.</div>');
	                    return redirect()->to('admin/Registrar/addCourselist');
	                }
	            } else {
	                session()->setFlashdata('msg','<div class="alert alert-danger">Record cannot be deleted . Please try later.</div>');
	                return redirect()->to('admin/Registrar/addCourselist');
	            }
	            
	        }
	   } else {
	        session()->setFlashdata('msg','<div class="alert alert-danger">Record cannot be deleted . Please try later.</div>');
	        return redirect()->to('admin/Registrar/addCourselist');
	   }
	  
	}
	
	public function addCourselist($CourseID = ''){
	  
		if($CourseID !=''){
			$CourseID =  encryptor('decrypt', $CourseID);
			$data['edit_course'] = $this->Master_model->getCourseList($CourseID);
	    	$data['edit_professor'] =	$this->Master_model->get_professor_by_course_id($CourseID);
		    $data['edit_professor']  = array_column($data['edit_professor'], 'professor_id');
		}

		$data['professor'] = $this->Master_model->getprofessor($CourseID);
		
		$data['class'] = $this->Master_model->getClass();
		$data['uniquecourselist']=$this->Master_model->getUniqueCourseList();
		$data['courselist'] = $this->Master_model->getCourseList();
		
		$data['content'] = 'backend/addCourselist';
		return view('backend/index', $data);
	}
	
	function submitCourselist(){
	    
	    $professor_id = $this->request->getPost('Professor_id');
	    $teaching_assistant = $this->request->getPost('Teaching_Assistant');
	    $professors = $this->Master_model->get_professor_by_id($professor_id);
	   // echo "<pre>";print_r($professors);
	    $professor = "";
	    foreach($professors as $pro)
	    {
	        if($professor == '')
	        {
	            $professor = $pro['FirstName']." ".$pro['LastName'];
	        }
	        else
	        {
	            $professor = $professor.",".$pro['FirstName']." ".$pro['LastName'];
	        }
	    }
		
		$CourseID=$this->request->getPost('CourseID');                     
		$Class = $this->request->getPost('Class');                   
		$Semester = $this->request->getPost('Semester');                   
		$Term = $this->request->getPost('Term'); 		
		$Course = $this->request->getPost('Course');                   
		$Professor = $professor;   
		
		$Professor_id = $this->request->getPost('Professor_id');
		
		$Credits = $this->request->getPost('Credits');                   
		$CourseTitle = $this->request->getPost('CourseTitle');                   
		$CourseDates = $this->request->getPost('CourseDates');  
		
		$start_date = $this->request->getPost('start_date');
		$end_date  = $this->request->getPost('end_date');
		$audit_rate = $this->request->getPost('audit_rate');
		
		$teaching_assistant = $this->request->getPost('Teaching_Assistant');
		
		//$Active = $this->request->getPost('Active');                 
		$courselist=array();
		$testing_record=array();
		
		// By Prabhat 23-10-2020
		if($start_date !='')
		{
		    $start_date = date('Y-m-d',strtotime($start_date));
		}
		if($end_date !='')
		{
		    $end_date = date('Y-m-d',strtotime($end_date));
		}
		
		  if($start_date !='' && $end_date != '')
		  {
		      $CourseDates = date('F d',strtotime($start_date))."-".date('F d,Y',strtotime($end_date));
		  }
		
		
		$courselist['CourseID']=$CourseID;
		$courselist['Class']=$Class;
		$courselist['Semester']=$Semester;
		$courselist['Term']=$Term;
		$courselist['Course']= $Course;
		$courselist['Professor']=$Professor;
		//$courselist['Professor_id'] = $Professor_id; 
		$courselist['Credits']=$Credits;
		$courselist['CourseTitle']=$CourseTitle;
		$courselist['CourseDates']=$CourseDates;
		$courselist['tution'] = $this->request->getPost('tution');
		$courselist['ip'] = $this->request->getIPAddress(); 
		
		$courselist['Teaching_Assistant'] = $teaching_assistant;
		
		 $courselist['start_date']=$start_date;
		 $courselist['end_date']=$end_date;
		 $courselist['audit_rate']=$audit_rate;
	
		$testing_record['Class']=$Class;
		$testing_record['Semester']=$Semester;
		$testing_record['Term']=$Term;
		$testing_record['Course']=$Course;
		$tablename='courselist';
		$testrecords = recordExist($testing_record,$tablename);
		$editrecords = recordExist($courselist,$tablename);
	  
		if($CourseID!=''){
		$result = $this->Master_model->updateCourseList($courselist);
		$this->Master_model->update_course_professor($Professor_id,$CourseID);
		$this->Master_model->update_course_assistant($teaching_assistant,$CourseID);
		} else{
			$result = $this->Master_model->insertCourseList($courselist);
			$this->Master_model->update_course_professor($Professor_id,$result['last_id']);
			$this->Master_model->update_course_assistant($teaching_assistant,$result['last_id']);
		}
			//echo "<pre>";print_r($courselist);die();
		if($result['msg']=='INSERTED'){		
			session()->setFlashdata('msg','<div class="alert alert-success">Record Inserted Successfully</div>');
			return redirect()->to('admin/Registrar/addCourselist');
		}elseif($result['msg']=='UPDATED'){		
			session()->setFlashdata('msg','<div class="alert alert-success">Record UPDATED Successfully</div>');
			return redirect()->to('admin/Registrar/addCourselist');
		}else {
            $post = $this->request->getPost();
			session()->setFlashdata('post', $post);; //for post the data auto filled 
			session()->setFlashdata('msg','<div class="alert alert-danger">There is some Error Occurred in Submission. Please try later.</div>');
			return redirect()->to('admin/Registrar/addCourselist');
		}
	
	}
}
