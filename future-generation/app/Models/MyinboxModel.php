<?php

namespace App\Models;

use CodeIgniter\Model;

class MyinboxModel extends Model
{
     function grade_course_detail()
    { 
        $builder = $this->db->table('grade_form as gf');
        $builder->distinct();
       return $builder->select('gf.course_id,gf.status,gf.admin_status,gf.admin_read_status,gf.ip,cl.Class,cl.Semester,cl.Term,cl.Course,cl.Professor,cl.CourseTitle,al.admin_fullname')
                 ->join('courselist as cl','cl.CourseID = gf.course_id')
                  ->join('admin_login as al','al.admin_id = gf.created_by')
                 ->get()
                 ->getResultArray();
    }
    function get_grade_wise_course($course_id)
    {
        $builder = $this->db->table('grade_form as gf');
        return $builder->select('gf.*,name.FirstName,name.LastName,al.admin_fullname')
                        ->join('name','name.ID = gf.student_id')
                        ->join('admin_login as al','al.admin_id = gf.created_by')
                        ->where('course_id',$course_id)
                        ->get()
                        ->getResultArray();
    }
    
    function get_unread_message()
    {
        $builder = $this->db->table('grade_form');
        $builder->distinct();
       $query = $builder->select('course_id')->where('admin_read_status IS NULL')->orWhere('admin_read_status',0)->get();
        return $query->getNumRows();
    }
    
    function update_read_status($course_id)
    {
        $builder = $this->db->table('grade_form');
       $data = array('admin_read_status'=>1);
        $builder->where('course_id',$course_id);
        $builder->update($data);
    }
    
    
    function update_grade_course_detail()
    {
        $builder = $this->db->table('grade_form');
        $data = array('admin_status'=>'1');
        $builder->where('course_id',$this->input->post('course_id'));
        $builder->update($data);
        
        // apoorv 5/04/2020
        $data = [
            'course_id' =>  $this->input->post('course_id'),
            'ip' => $this->input->ip_address(),
            'action_by' => $this->session->userdata('USER_ID'),
            'admin_status' => '1'
        ];
        
        $this->db->table('grade_form_log')->insert($data);
        
        // end of apoorv
    }
    function reject_grade_course_detail()
    {
        $builder = $this->db->table('grade_form');
        $data = array('admin_status'=>'2','reject_reason'=>$this->input->post('reason'),'status'=>'0');
        $builder->where('course_id',$this->input->post('course_id'));
        $builder->update($data);
        
         // apoorv 5/04/2020
        $data = [
            'course_id' =>  $this->input->post('course_id'),
            'ip' => $this->input->ip_address(),
            'action_by' => $this->session->userdata('USER_ID'),
            'comment' => $this->input->post('reason'),
            'status' => '0',
            'admin_status' => '2',
        ];
        
        $this->db->table('grade_form_log')->insert($data);
        
        // end of apoorv
    }
    
    
    function course_grade_current_status($course_id)
    {
      return $this->db->table('grade_form')->select('*')
                     ->where('course_id',$course_id)
                     ->get()
                     ->getResultArray();    
    }
}
