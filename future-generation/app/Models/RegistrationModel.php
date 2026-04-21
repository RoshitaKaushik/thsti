<?php

namespace App\Models;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;
use Config\Database;

class RegistrationModel extends Model
{
    protected $db;
    protected $formbuilder;
    protected $request;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
        $this->formbuilder = Database::connect('formbuilder');
        $this->request = \Config\Services::request();
    }

    function add_city() 
    {
        $data['CityID'] = test_input($this->request->getPost('city_id')); 
        $data['CityName'] = test_input($this->request->getPost('city_name')); 
        $data['Active'] = test_input($this->request->getPost('status'));
        $data['state_code'] = test_input($this->request->getPost('state'));
        $query = $this->db->table('tbl_city')->select('*')
                          ->where('CityID',$data['CityID'])   
                          ->get();
        $num = $query->getNumRows();
        if($num>0){
            return false;
        } 
        else{
            $this->db->table('tbl_city')->insert($data);
            return true;
        }
    }
    
    function get_all_city()
    {
        return $this->db->table('tbl_city')->select('*')
                        ->get()
                        ->getResultArray();
    }

    function get_all_state()
    {
        return $this->db->table('state')->select('*')
                        ->get()
                        ->getResultArray();
    }


    
    function add_enthnicity()
    {
       $data['EthnicID'] = test_input($this->request->getPost('ethnicity_id'));
       $data['EthnicName'] = test_input($this->request->getPost('ethnicity_name'));
       $data['Active'] = test_input($this->request->getPost('status'));
       
       $query = $this->db->table('tbl_ethnicity')->select('*')
                            ->where('EthnicID',$data['EthnicID'])
                            ->get();
        $num = $query->getNumRows();
        if($num>0)
        {
            return false;
        }
        else
        {
            $this->db->table('tbl_ethnicity')->insert($data);
            return true;
        }

    }
    function get_all_enthnicity()
    {
        return $this->db->table('tbl_ethnicity')->select('*')
                        ->get()
                        ->getResultArray();
    }
    
    function add_school()
    {
       $data['SchoolID'] = test_input($this->request->getPost('school_id'));
       $data['SchoolName'] = test_input($this->request->getPost('school_name'));
       $data['Active'] = test_input($this->request->getPost('status'));
       
       $query = $this->db->table('tbl_school')->select('*')
                            ->where('SchoolID',$data['SchoolID'])
                            ->get();
        $num = $query->getNumRows();
        if($num>0)
        {
            return false;
        }
        else
        {
            $this->db->table('tbl_school')->insert($data);
            return true;
        }

    }


      function add_gender()
    {
      // $data['id'] = test_input($this->request->getPost('id'));
       $data['GenderName'] = test_input($this->request->getPost('gender_name'));
       $data['Active'] = test_input($this->request->getPost('status'));
       
       $query = $this->db->table('tbl_gender')->select('*')
                            ->where('GenderName',$data['GenderName'])
                            ->get();
        $num = $query->getNumRows();
        if($num>0)
        {
            return false;
        }
        else
        {
            $this->db->table('tbl_gender')->insert($data);
            return true;
        }

    } 

     function add_phone_type()
    {
      // $data['id'] = test_input($this->request->getPost('id'));
       $data['PhoneType'] = test_input($this->request->getPost('phone_type'));
       $data['Active'] = test_input($this->request->getPost('status'));
       
       $query = $this->db->table('tbl_phone_type')->select('*')
                            ->where('PhoneType',$data['PhoneType'])
                            ->get();
        $num = $query->getNumRows();
        if($num>0)
        {
            return false;
        }
        else
        {
            $this->db->table('tbl_phone_type')->insert($data);
            return true;
        }

    } 


     function add_enrollment_period()
    {
      // $data['id'] = test_input($this->request->getPost('id'));
       $data['Period'] = test_input($this->request->getPost('enrollment_period'));
       $data['Active'] = test_input($this->request->getPost('status'));
       
       $query = $this->db->table('tbl_enrollment_periods')->select('*')
                            ->where('Period',$data['Period'])
                            ->get();
        $num = $query->getNumRows();
        if($num>0)
        {
            return false;
        }
        else
        {
            $this->db->table('tbl_enrollment_periods')->insert($data);
            return true;
        }

    } 



     function add_travel_frequency()
    {
      // $data['id'] = test_input($this->request->getPost('id'));
       $data['travel_frequency'] = test_input($this->request->getPost('travel_frequency'));
       $data['Active'] = test_input($this->request->getPost('status'));

      // echo "<pre>";print_r($data);die();
       
       $query = $this->db->table('tbl_travel_frequency')->select('*')
                            ->where('travel_frequency',$data['travel_frequency'])
                            ->get();
        $num = $query->getNumRows();
        if($num>0)
        {
            return false;
        }
        else
        {
            $this->db->table('tbl_travel_frequency')->insert($data);
            return true;
        }

    } 


    function get_all_school()
    {
        return $this->db->table('tbl_school')->select('*')
                        ->get()
                        ->getResultArray();
    }

     function get_all_gender()
    {
        return $this->db->table('tbl_gender')->select('*')
                        ->get()
                        ->getResultArray();
    }


      function get_all_phone_type()
    {
        return $this->db->table('tbl_phone_type')->select('*')
                        ->get()
                        ->getResultArray();
    }
    
      function get_all_enrollment_periods()
    {
        return $this->db->table('tbl_enrollment_periods')->select('*')
                        ->get()
                        ->getResultArray();
    }

     function get_all_travel_frequency()
    {
        return $this->db->table('tbl_travel_frequency')->select('*')
                        ->get()
                        ->getResultArray();
    }

      function get_master_list()
    {
        return $this->db->table('tbl_master_table_list')->select('*')
                        ->where('Active',1)
                        ->get()
                        ->getResultArray();
    }

     function get_master_data($table)
    {
        return $this->db->table($table)->select('*')
                        ->where('Active',1)
                        ->get()
                        ->getResultArray();
    }
    
    
     function add_degree()
    {
       $data['DegreeID'] = test_input($this->request->getPost('degree_id'));
       $data['DegreeName'] = test_input($this->request->getPost('degree_name'));
       $data['Active'] = test_input($this->request->getPost('status'));
       
       $query = $this->db->table('tbl_degree')->select('*')
                            ->where('DegreeID',$data['DegreeID'])
                            ->get();
        $num = $query->getNumRows();
        if($num>0)
        {
            return false;
        }
        else
        {
            $this->db->table('tbl_degree')->insert($data);
            return true;
        }

    }
    function get_all_degree()
    {
        return $this->db->table('tbl_degree')->select('*')
                        ->get()
                        ->getResultArray();
    }
    
    function get_detail_of_city($id = '')
    {
        return $this->db->table('tbl_city')->select('*')
                        ->where('id',$id)
                        ->get()
                        ->getRowArray();
    }

    function get_detail_of_degree($id = '')
    {
        return $this->db->table('tbl_degree')->select('*')
                        ->where('id',$id)
                        ->get()
                        ->getRowArray();
    }

     function get_detail_of_school($id = '')
    {
        return $this->db->table('tbl_school')->select('*')
                        ->where('id',$id)
                        ->get()
                        ->getRowArray();
    }



     function get_detail_of_gender($id = '')
    {
        return $this->db->table('tbl_gender')->select('*')
                        ->where('id',$id)
                        ->get()
                        ->getRowArray();
    }

     function get_detail_of_phone_type($id = '')
    {
        return $this->db->table('tbl_phone_type')->select('*')
                        ->where('id',$id)
                        ->get()
                        ->getRowArray();
    }

     function get_detail_of_enrollment_period($id = '')
    {
        return $this->db->table('tbl_enrollment_periods')->select('*')
                        ->where('id',$id)
                        ->get()
                        ->getRowArray();
    }


      function get_detail_of_travel_frequency($id = '')
    {
        return $this->db->table('tbl_travel_frequency')->select('*')
                        ->where('id',$id)
                        ->get()
                        ->getRowArray();
    }

      function get_detail_of_data($id = '',$table='')
    {
        return $this->db->table($table)->select('*')
                        ->where('id',$id)
                        ->get()
                        ->getResultArray();
    }


       function get_field_of_table_data($table='')
    {
       $result = $this->db->getFieldNames($table);
            foreach($result as $field)
            {
            $data[] = $field;
            
            }
            return $data;
                        
    }

    
    function get_detail_of_ethnicity($id = '')
    {
        return $this->db->table('tbl_ethnicity')->select('*')
                        ->where('id',$id)
                        ->get()
                        ->getRowArray();
    }
    
    function update_city()
    {
        $current_id = $this->request->getPost('current_city_id');
        $data['CityID'] = $this->request->getPost('city_id');
        $data['CityName'] = $this->request->getPost('city_name');
        $data['Active'] = $this->request->getPost('status');
        $builder = $this->db->table('tbl_city');
        $builder->where('id',$current_id);
        $builder->update($data);
        return true;
    }

      function update_degree()
    {
        $current_id = $this->request->getPost('current_city_id');
        $data['DegreeID'] = $this->request->getPost('degree_id');
        $data['DegreeName'] = $this->request->getPost('degree_name');
        $data['Active'] = $this->request->getPost('status');
        $builder = $this->db->table('tbl_degree');
        $builder->where('id',$current_id);
        $builder->update($data);
        return true;
    }


     function update_school()
    {
        $current_id = $this->request->getPost('current_school_id');
        $data['SchoolID'] = $this->request->getPost('edit_school_id');
        $data['SchoolName'] = $this->request->getPost('edit_school_name');
        $data['Active'] = $this->request->getPost('status');
        $builder = $this->db->table('tbl_school');
        $builder->where('id',$current_id);
        $builder->update($data);
        return true;
    }


     function update_gender()
    {
        $current_id = $this->request->getPost('current_gender_id');
        
        $data['GenderName'] = $this->request->getPost('GenderName');

        $data['Active'] = $this->request->getPost('status');
        
        $builder = $this->db->table('tbl_gender');
        $builder->where('id',$current_id);
        $builder->update($data);
        return true;
    }

     function update_enrollment_period() 
    {
        $current_id = $this->request->getPost('current_enrollment_period_id');
        $data['Period'] = $this->request->getPost('enrollment_period');
        $data['Active'] = $this->request->getPost('status');
        $builder = $this->db->table('tbl_enrollment_periods');
        $builder->where('id',$current_id);
        $builder->update($data);
        return true;
    }

     function update_travel_frequency() 
    {
        $current_id = $this->request->getPost('current_travel_frequency_id');
        $data['travel_frequency'] = $this->request->getPost('travel_frequency');
        $data['Active'] = $this->request->getPost('status');
        
        $builder = $this->db->table('tbl_travel_frequency');
        $builder->where('id',$current_id);
        $builder->update($data);
        return true;
    }


     function update_master_data() 
    {
       // echo "<pre>";print_r($_POST);die();
        $table = $this->request->getPost('table_name');
        $id = $this->request->getPost('id');
        unset($_POST['type_name']);
        unset($_POST['table_name']);
        unset($_POST['id']);
        unset($_POST['csrf_test_name']);
         foreach ($_POST as $key=> $value) {
              $data[$key] = $value;
               

        }

        $builder = $this->db->table($table);
        $builder->where('id',$id);
        $builder->update($data);
       // echo $this->db->last_query();die();
        return true;
    }



     function add_master_data() 
    {
       // echo "<pre>";print_r($_POST);die();
        $table = $this->request->getPost('table_name');
       
       unset($_POST['type_name'], $_POST['table_name'], $_POST['csrf_test_name']);
      
         foreach ($_POST as $key=> $value) {
              $data[$key] = $value;
               

        }

       
        $this->db->table($table)->insert($data);
       // echo $this->db->last_query();die();
        return true;
    }



      function update_phone_type()
    {
        $current_id = $this->request->getPost('current_phone_type_id');
        $data['PhoneType'] = $this->request->getPost('phone_type');
        $data['Active'] = $this->request->getPost('status');
        
        $builder = $this->db->table('tbl_phone_type');
        $builder->where('id',$current_id);
        $builder->update($data);
        return true;
    }

    
    function update_ethnicity()
    {
        $current_id = $this->request->getPost('current_ethnicity_id');
        $data['EthnicID'] = $this->request->getPost('ethnicity_id');
        $data['EthnicName'] = $this->request->getPost('ethnicity_name');
        $data['Active'] = $this->request->getPost('status');
        
        $builder = $this->db->table('tbl_ethnicity');
        $builder->where('id',$current_id);
        $builder->update($data);
        return true;
    }
    
    function get_all_users()
    {
        $builder = $this->formbuilder->table('tbl_studentAplicationData as s');
        $builder->select('(CASE WHEN (s.contact_given_name = "" or s.contact_given_name is NULL) THEN r.first_name ELSE s.contact_given_name END) as alter_contact_given_name,
                                        (CASE WHEN (s.contact_given_sur_name = "" or s.contact_given_sur_name is NULL) THEN r.last_name ELSE s.contact_given_sur_name END) as alter_contact_given_sur_name,
                                         s.*')
                              ->join('tbl_student_register as r','r.id = s.user_id');
                              
        if($this->request->getPost('first_name') != '')
        { 
            $builder->like('s.contact_given_name', $this->request->getPost('first_name'));
        }
        if($this->request->getPost('created_on'))
        {
            $created_at = date('Y-m-d',strtotime($this->request->getPost('created_on')));
            $builder->where('s.created_date >=',$created_at); 
        }
        if($this->request->getPost('created_to') != '')
        {
            $created_to = date('Y-m-d',strtotime($this->request->getPost('created_to')));
            $builder->where('s.created_date <=',$created_to);
        }
        if($this->request->getPost('submited_on') != '')
        {
            $submited_on = date('Y-m-d',strtotime($this->request->getPost('submited_on')));
            $builder->where('s.final_save_date >=',$submited_on);
        }
        if($this->request->getPost('submited_to') != '')
        {
            $submited_to = date('Y-m-d',strtotime($this->request->getPost('submited_to')));
            $builder->where('s.final_save_date <=',$submited_to); 
        }
        if($this->request->getPost('last_name') != '')
        {
            $builder->like('s.contact_given_sur_name', $this->request->getPost('last_name'));
        }
        if($this->request->getPost('app_phase') !='')
        {
            $builder->where('s.final_status',$this->request->getPost('app_phase')); 
        }
        if($this->request->getPost('americorps') !='')
        {
            $builder->where('s.personal_info_americorps',$this->request->getPost('americorps')); 
        }
        if($this->request->getPost('country') !='')
        {
            $builder->where('s.permanent_country',$this->request->getPost('country'));
        }
        if($this->request->getPost('gender') != '')
        {
            $builder->where('s.personal_info_gender',$this->request->getPost('gender')); 
        }
        if($this->request->getPost('region') != '')
        {
            $builder->where('s.region',$this->request->getPost('region'));
            $builder->where('region',$this->request->getPost('region'));
        }
        if($this->request->getPost('enrollment') !='')
        {
            $builder->where('s.personal_info_enrollment_period',$this->request->getPost('enrollment')); 
        }
        if($this->request->getPost('scouts') != '')
        {
            $builder->where('s.personal_info_scounting',$this->request->getPost('scouts')); 
        }
        if($this->request->getPost('admin_status') != '')
        {
            if($this->request->getPost('admin_status') != '2')
            {
                $builder->where('s.final_status',$this->request->getPost('admin_status')); 
            }
            else if($this->request->getPost('admin_status') == '2')
            {
                $builder->where('s.approved_status','1'); 
            }
        }
        $builder->orderBy('s.id','desc');
        $query = $builder->get();
        return $query->getResultArray();
    }

	

    function get_student_cv_detail($id = '')
    {
        if($id == '')
        {
            return false;
        }
        else
        {
            $builder = $this->formbuilder->table('tbl_studentCV');
            return $builder->select('*')
                                     ->where('user_id',$id)
                                     ->where('professional_cv !=','0')
                                     ->get()
                                     ->getResultArray();
        }
    }



    function registed_user()
    {
        $sql="SELECT t1.id,t1.first_name,t1.last_name,t1.email FROM tbl_student_register t1 
        LEFT JOIN tbl_studentAplicationData t2 ON t2.user_id = t1.id WHERE t2.user_id IS NULL ORDER BY t1.id DESC";    
        $query = $this->formbuilder->query($sql);
        return $query->getResultArray();
    }

    

    function get_student_statements_detail($id = '')
    {
        if($id == '')
        {
            return false;
        }
        else
        {
            $builder = $this->formbuilder->table('tbl_studentStatement');
            return $builder->select('*')
                                     ->where('statement != ','0')
                                     ->where('user_id',$id)
                                     ->get()
                                     ->getResultArray();
        }
    }

     function get_student_transcripts_detail($id = '')
    {
        if($id == '')
        {
            return false;
        }
        else
        {
            $builder = $this->formbuilder->table('tbl_studentTranscript');
            return $builder->select('*')
                                     ->where('user_id',$id)
                                    ->where('transcript !=','0')
                                     ->get()
                                     ->getResultArray();
        }
    }




    function get_user_detail($id = '')
    {
        if($id == '')
        {
            return false;
        }
        else
        {
             $builder = $this->formbuilder->table('tbl_studentAplicationData');
            return $builder->select('*')								
                                     ->where('user_id',$id)
                                     ->get()
                                     ->getResultArray();
        }
    }


    
    function get_country_list(){ 
        
        $builder = $this->db->table('country');
        $builder->select('*');
        $builder->where('Active', '1');
        $builder->where('(DeleteStatus IS NULL OR DeleteStatus = 0)');
         
        $query = $builder->get();
    /*  print_r($this->db->last_query()); exit;*/
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }
    
    function update_applicatant_status()
    {
        
        $status = $this->request->getPost('status');
        $status = "'".$status;

        $data = array('final_status'=>$this->request->getPost('status'));
        $builder = $this->formbuilder->table('tbl_studentAplicationData');
        $builder->where('user_id',$this->request->getPost('student_id'));
        return $builder->update($data);
    }
    

    function update_applicatant__approved_status($data,$user_id)
    {
       $builder = $this->formbuilder->table('tbl_studentAplicationData');
       $builder->where('user_id',$user_id);
        return $builder->update($data);
    } 



    function email_templete($id="")
    {
        $builder = $this->formbuilder->table('template');
         $builder->select('*');
         //$this->formbuilder->where('status','1');
         if($id != '')
         {
             $builder->where('id',$id);
         }
         $query = $builder->get();
         return $query->getResultArray();    
    }

	function get_static_student_data($id="")
    {
        $builder = $this->formbuilder->table('studenStaticData');
         $builder->select('*');
         $builder->where('status','1');
         if($id != '')
         {
             $builder->where('id',$id);
         }
         $query = $builder->get();
         return $query->getResultArray();    
    }


    
    function update_templete_detail()
    {
        $data = array(
            'subject' => $this->request->getPost('subject'),
            'body' => $this->request->getPost('description'),
            'from' => $this->request->getPost('from')
            );
            $builder = $this->formbuilder->table('template');
            $builder->where('id',$this->request->getPost('type'));
            return $builder->update($data);
    }
	
    function update_static_data_detail()
    {
        $data = array(
            
            'description' => $this->request->getPost('description'),
           
            );
            $builder = $this->formbuilder->table('studenStaticData');
            $builder->where('id',$this->request->getPost('type'));
            return $builder->update($data);
    } 
    
    
    function get_student_data($user_id){ 
        
        $builder = $this->formbuilder->table('tbl_studentAplicationData');
        $builder->select('*');
        $builder->where('user_id',$user_id);  
        $query = $builder->get();
    /*  print_r($this->db->last_query()); exit;*/
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }


	
	function get_student_education_data($user_id){ 
        
        $builder = $this->formbuilder->table('tbl_studentAplicationEducationData');
        $builder->select('*');
        $builder->where('user_id',$user_id);  
        $query = $builder->get();
    /*  print_r($this->db->last_query()); exit;*/
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }
	
	
	function get_student_cv($user_id){ 
        
        $builder = $this->formbuilder->table('tbl_studentStatement');
        $builder->select('*');
        $builder->from('tbl_studentCV');
        $builder->where('user_id',$user_id);  
        $query = $builder->get();
    /*  print_r($this->db->last_query()); exit;*/
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }
	
	
	 function get_student_statement($user_id){ 
        
        $builder = $this->formbuilder->table('tbl_studentStatement');
        $builder->select('*');
        $builder->where('user_id',$user_id);  
        $query = $builder->get();
    /*  print_r($this->db->last_query()); exit;*/
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }
	
	function get_student_transscripts($user_id){ 

        $builder = $this->formbuilder->table('tbl_studentTranscript');
        $builder->select('*');
        $builder->where('user_id',$user_id);  
        $query = $builder->get();
    /*  print_r($this->db->last_query()); exit;*/
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }
    
    function get_state_name_by_code($state_code = ''){ 
        
         $sql ="SELECT StateName FROM state where Active=1 AND StateID = '$state_code'";
        $query = $this->db->query($sql);
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }
    
    function get_country_name_by_code($country_code){ 
        
        $builder = $this->db->table('country');
        $builder->select('CountryName');
        $builder->where('Active', 1);
         $builder->where('CountryID',$country_code);
        
        $query = $builder->get();
    
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }
    
    function get_school_name_by_code($school_code){ 
        
        $builder = $this->db->table('tbl_school');
        $builder->select('SchoolName');
         $builder->where('Active', 1);
         $builder->where('SchoolID',$school_code);
       // $this->formbuilder->where('DeleteStatus!=', 1);
         
        $query = $builder->get();
    /*  print_r($this->db->last_query()); exit;*/
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }
    
    function get_degree_name_by_code($degree_code){ 

        $builder = $this->db->table('tbl_degree');
        $builder->select('*');
        $builder->where('Active', 1);
        $builder->where('DegreeID', $degree_code);
      // $this->formbuilder->where('DeleteStatus!=', 1);
         
        $query = $builder->get();
    /*  print_r($this->db->last_query()); exit;*/
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }


//code by ajay kumar
    function insert_student_data($param) { 
        $response = array();
        foreach ($param as $key => $val) {
            $data[$key] = test_input($val);
        }
       
     $query = $this->db->table('name')->insert($data);
 //echo $this->db->last_query();die();

        
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'INSERTED';
            $response['last_inserted_id'] = $this->db->insertId();
        } else {
            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }


     //code by ajay kumar
    function insert_student_address_data($param) { 
        $response = array();
        foreach ($param as $key => $val) {
            $data[$key] = test_input($val);
        }
       
     $query = $this->db->table('address')->insert($data);
 //echo $this->db->last_query();die();

        
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'INSERTED';
            $response['last_inserted_id'] = $this->db->insertId();
        } else {
            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }



    // code by ajay kumar
       function get_email_data($type_name){ 
        $builder = $this->formbuilder->table('template');
        $builder->select('*');
        $builder->where('type_name',$type_name);  
        $query = $builder->get();
    /*  print_r($this->db->last_query()); exit;*/
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }
	
	function update_region($student_id,$region='')
    {
        $data = array(
            'region' => $region
            );
            $builder = $this->formbuilder->table('tbl_studentAplicationData');
            $builder->where('user_id',$student_id);
            return $builder->update($data);
    }
    
    function enrolment_period_list(){ 

        $builder = $this->db->table('tbl_enrollment_periods');
        $builder->select('*');
        $builder->where('Active', 1);
         
        $query = $builder->get();
       //print_r($this->formbuilder->last_query()); exit;
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }
    
    function get_gender(){ 
        
        $builder = $this->db->table('tbl_gender');
        $builder->select('*');
        $builder->where('Active', 1);
        $query = $builder->get();
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }


    function admit_status_list(){ 
        
        $builder = $this->db->table('tbl_admit_status');
        $builder->select('*');
        $builder->where('Active', 1);
        $query = $builder->get();
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }



    //code by ajay kumar
    function application_check_list($param) { 
        $response = array();
        foreach ($param as $key => $val) {
            $data[$key] = test_input($val);
        }
       
     $query = $this->db->table('tbl_applicant_check_list')->insert($data);
  
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'INSERTED';
            $response['last_inserted_id'] = $this->db->insertId();
        } else {
            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }
    
    function get_applicatant_detail_by_id($student_id)
    {
        return $this->formbuilder->table('tbl_studentAplicationData')->select('*')
                        ->where('user_id',$student_id)
                        ->get()
                        ->getResultArray();
    }
    
    function update_approve_status($user_id){
        $data['approved_status'] = '1';
        $builder = $this->formbuilder->table('tbl_studentAplicationData');
        $builder->where('user_id',$user_id);
        return $builder->update($data);
    }
    
    function user_detail_by_id($id = '')
    {
        if($id == ''){
            return false;
        }
        else{
            return $this->formbuilder->table('tbl_studentAplicationData')->select('*')
                                         ->where('user_id',$id)
                                         ->get()
                                         ->getResultArray();
        }
    }
    
    function update_refrence_status($user_id,$data)
    {
        $builder = $this->formbuilder->table('tbl_studentAplicationData');
        $builder->where('user_id',$user_id);
        return $builder->update($data);
    }
    function finance_balance()
    {
        return $this->formbuilder->table('finanace_amount')->select('*')
                                         ->where('status','1')
                                         ->get()
                                         ->getRowArray();
    }
    
    function update_finance_amount()
    {
        $builder = $this->formbuilder->table('finanace_amount');
       $id= $this->request->getPost('id');
       $data= array('amount'=>$this->request->getPost('amount'));
       $builder->where('id',$id);
       $builder->update($data);
    }
    
    
     function student_data_cv_upload($param) { 
        $response = array();
        foreach ($param as $key => $val) {
            $data[$key] = test_input($val);
        }
       
            $query = $this->formbuilder->table('tbl_studentCV')->insert($data);

        
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'INSERTED';
            $response['last_inserted_id'] = $this->db->insertId();
        } else {
            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }
    
    
    function check_transcript_file($user_id = '')
    {
        return $this->formbuilder->table('tbl_studentTranscript')->select('*')
                        ->where('user_id',$user_id)
                        ->get()
                        ->getResultArray();
    }
    
    function check_upload_cv($user_id = '')
    {
        return $this->formbuilder->table('tbl_studentCV')->select('*')
                                 ->where('user_id',$user_id)
                                 ->get()
                                 ->getResultArray();
    }
    
    function delete_register_user()
    {
        $builder = $this->formbuilder->table('tbl_student_register');
        $builder->whereIn('id',$this->request->getPost('reg_ids'));
        return $builder->delete();
    }
    
    function generateTrackApprovalLog($ID){
        $data = array(
            'application_id' => $this->request->getPost('application_id'),
            'name_id' => $ID,
            'created_date' => date('Y-m-d h:i:sa'),
            'created_by' => $this->session->userdata('USER_ID'),
            'createdip' => $_SERVER['REMOTE_ADDR']
            );
        return $this->db->table('approve_track_admission_log')->insert($data);
    }
    
    // 12-march-2024
    
    function getStaticDataById($id){     

        $builder = $this->formbuilder->table('studenStaticData');
        $builder->select('*');
        $builder->where('id',$id);  
        $query = $builder->get();
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }
    
    function get_gender_by_id($id){

        $builder = $this->db->table('tbl_gender');
        $builder->select('*');
        $builder->where('Active', 1);
        $builder->where('id', $id); 
        $query = $builder->get();
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
    }
    
    function get_enrollment_by_id($id){
        $builder = $this->db->table('tbl_enrollment_periods');
        $builder->select('*');
        $builder->where('Active', 1);
        $builder->where('id', $id); 
        $query = $builder->get();
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
        
    }
    
    function get_travell_frquency_by_id($id){    

        $builder = $this->db->table('tbl_travel_frequency');
        $builder->select('*');
        $builder->where('Active', 1);
        $builder->where('id', $id);
      // $this->formbuilder->where('DeleteStatus!=', 1);
         
        $query = $builder->get();
    /*  print_r($this->db->last_query()); exit;*/
        if($query->getNumRows()>=1){
            return $query->getResultArray();
        }else{
            return array(); 
        }
    }
    
    function get_enthicity_by_id($code='')
    {
        return $this->db->table('tbl_ethnicity')->select('*')
                        ->where('EthnicID',$code)
                        ->get()
                        ->getResultArray();
    }
}
