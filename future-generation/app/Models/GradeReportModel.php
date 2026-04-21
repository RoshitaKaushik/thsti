<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class GradeReportModel extends Model
{

	 protected $db;
    protected $request;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
        $this->request = \Config\Services::request();
    }
    function get_course_according_professor($id ='')
	{
         $builder = $this->db->table('courselist');
	     $user_id = session()->get('NAME_ID');
	     $professor = $this->request->getPost('professor');
                  $builder->select('courselist.*');
                  $builder->join('course_wise_professor as csw','csw.course_id = courselist.CourseID','left');
                  //$this->db->where('courselist.Class >=',date('Y'));
                
                
                if($user_id !='')
                {
                    $builder->where('csw.professor_id',$user_id);
                    $builder->where('csw.status','1');
                }
                
            return   $builder->get()->getResultArray();
	    
	    
	    //return  $this->db->select('*')->from('courselist')->where('Professor_id',$user_id)->get()->getResultArray();
	}
	
	function get_active_grade()
	{
	    return $this->db->table('grades')->select('*')->where('Active','1')->get()->getResultArray();
	}
	
	function get_sch_student_according_course($course_id='')
	{
	    return $this->db->table('transcript')->select('name.ID,name.FirstName,name.LastName,g.grade,g.comment,g.admin_status,g.status,g.reject_reason')
        	            ->join('name','name.ID = transcript.StudentID')
        	            ->join('grade_form g','g.student_id =  transcript.StudentID AND g.course_id = '.$course_id,'left')
        	            ->where(['transcript.Grade'=>'SCH','transcript.CourseID'=>$course_id])->get()->getResultArray();
	}
	
	function store_student_store_grade()
	{
	    $course_id = encryptor('decrypt', $this->request->getPost('course_id'));
	    $grade = $this->request->getPost('grade');
	    foreach($grade as $key => $val)
	    {
            $builder = $this->db->table('grade_form');
	        $check = $builder->select('*')->where(['student_id'=>$key,'course_id' => $course_id])->get()->getResult();
	        if($check)
	        {
	         
	             $data = array(
	             'student_id' => $key,
	              'grade'  => $val,
	              'course_id' => $course_id,
	              'comment' => $this->request->getPost('comment')[$key],
	              'modify_date' =>date('Y-m-d h:m:i'),
	              'created_by' => session()->get('USER_ID'),
	              'admin_read_status'=>0,
	              'ip' =>$_SERVER['REMOTE_ADDR']
	             );
	             $builder->where(['student_id'=>$key,'course_id' => $course_id]);
	            $query = $builder->update($data); 
	          
	        }
	        else
	        {
	            $data = array(
	             'student_id' => $key,
	              'grade'  => $val,
	              'course_id' => $course_id,
	              'comment' => $this->request->getPost('comment')[$key],
	              'created_by' => $_SESSION['USER_ID'],
	              'admin_read_status'=>0,
	               'ip' =>$_SERVER['REMOTE_ADDR']
	             );
	            $query = $this->db->table('grade_form')->insert($data); 
	        }
	        
	        
	      
	    }
	    if($query)
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	    }
	   
	}
	
	public function professor_list()
    {
        $builder = $this->db->table('name');
		$builder->select('name.ID,name.FirstName,name.LastName');
		$builder->join('groups','groups.NameLink = name.ID');
		$builder->where('groups.FacultyStaff','1');
		if(session()->get('role') != 1)
		{
		    $builder->where('ID',session()->get('NAME_ID'));
		}
		
		$query = $builder->get();
		//echo $this->db->last_query(); die();
		if($query->getNumRows() >= 1){
			return $query->getResultArray();
		}
		else{ 
			return array();
		}

    }
    
    public function get_course($semester='',$year='')
    {
        $professor = $this->request->getPost('courselist');
        $builder = $this->db->table('courselist');
                  $builder->select('courselist.*');
                  $builder->join('course_wise_professor as csw','csw.course_id = courselist.CourseID','left');
                           
                if($semester !='')
                {
                    $builder->where('Semester',$semester);
                }
                if($year != '')
                {
                    $builder->where('Class',$year);
                }
                
                if($professor !='')
                {
                    $builder->where('csw.professor_id',$professor);
                    $builder->where('csw.status','1');
                }
                
            return   $builder->get()->getResultArray();
    }
    
    
    // 27-05-2020
    function lock_course_grade()
    {
        $data = array('status'=>'1','admin_read_status'=>0);
        $this->db->table('grade_form')->where('course_id',$this->request->getPost('course_id'));
        $query = $this->db->table('grade_form')->update($data);
        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function check_grade_assign_or_not()
    {
        $course = $this->request->getPost('course_id');
        $query1 = $this->db->table('grade_form')->select('*')->where('course_id',$course)->get()->getResultArray();
        if($query1)
        {
            
            $query = $this->db->table('grade_form')->select('*')->where('course_id',$course)->where('grade','')->get()->getResultArray();
            if($query)
            {
                
                return true;
            }
            else
            {
                return false;
            }    
        }
        else
        {
           
             return true;
        }
        
        
    }
}
