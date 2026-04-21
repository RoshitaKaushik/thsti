<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;

class Registration extends BaseController
{
    protected $Registration_model;

    function __construct()
    {
        $this->Registration_model = new RegistrationModel();
    }

    public function index()
    {
        //
    }

    function email_templete()
    {
        $data['email_templete'] = $this->Registration_model->email_templete();
        //echo "<pre>";print_r($data['email_templete']);echo "</pre>";die;
        $data['content'] = 'backend/email_templete';
        return view('backend/index', $data);
    }

    function update_city()
    {
        $data = $this->Registration_model->update_city();
        if ($data) {
            session()->setFlashdata('msg', 'Record updated  successfully . ');
            return redirect()->to('admin/Registration/city');
        } else {
            session()->setFlashdata('msg', 'Something Wrong . . . Please try later.');
            return redirect()->to('admin/Registration/city');
        }
    }

    function city()
    {
        $data['city'] = $this->Registration_model->get_all_city();
        $data['state'] = $this->Registration_model->get_all_state();
        $data['content'] = 'backend/addCity';
        return view('backend/index', $data);
    }

    function get_templete_detail()
    {
        $templete_id = $this->request->getPost('templete_id');
        if ($templete_id != '') {
            $data = $this->Registration_model->email_templete($templete_id);
            echo json_encode($data);
        } else {
            echo json_encode("Something Wrong . . . . . . . .  .");
        }
    }

    function update_templete_detail()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $data = $this->Registration_model->update_templete_detail();
            if ($data) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    function store_city()
    {
        $data = $this->Registration_model->add_city();
        if ($data) {
            session()->setFlashdata('msg', 'Record inserted  successfully . ');
            return redirect()->to('admin/Registration/city');
        } else {
            session()->setFlashdata('msg', 'CityId is already exits . . . Please try later.');
            return redirect()->to('admin/Registration/city');
        }
    }


    function get_detail_of_city()
    {
        $id = $this->request->getPost('rel_id');
        if ($id != '') {
            $data = $this->Registration_model->get_detail_of_city($id);
            echo '<div class="form-group">';
            echo '<label>City ID :</label>';
            echo '<input type="hidden" id="current_city_id" value="' . $id . '" name="current_city_id">';
            echo '<input type="text" class="form-control" id="edit_city_id" value="' . $data['CityID'] . '" name="city_id" required placeholder="Enter City Id">';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>City Name :</label>';
            echo '<input type="text" class="form-control" id="edit_city_name" value="' . $data['CityName'] . '" name="city_name" required placeholder="Enter City Name">';
            echo '</div>';

            echo '<div class="form-group">';
            echo '<label>Status :</label>';
            echo '<select class="form-control" name="status" id="edit_status" required>';

            $sec =  '';
            $sec1 = '';

            if ($data['Active'] == 1) {
                $sec = 'selected';
            } else {
                $sec1 = 'selected';
            }

            echo '<option ' . $sec . ' value="1">Active</option>';
            echo '<option ' . $sec1 . ' value="0">In-Active</option>';
            echo '</select>';
            echo '</div>';
        }
    }

    function staticpage_student()
    {
        $data['email_templete'] = $this->Registration_model->get_static_student_data();
        //echo "<pre>";print_r($data['email_templete']);echo "</pre>";die;
        $data['content'] = 'backend/static_page_student';
        return view('backend/index', $data);
    }


    function get_static_page_detail()
    {
        $templete_id = $this->request->getPost('templete_id');
        if ($templete_id != '') {
            $data = $this->Registration_model->get_static_student_data($templete_id);
            echo json_encode($data);
        } else {
            echo json_encode("Something Wrong . . . . . . . .  .");
        }
    }



    function update_static_data_detail()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $data = $this->Registration_model->update_static_data_detail();
            if ($data) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    function get_master_list()
    {
        if (session()->get('data_array')) {
            $params = session()->get('data_array');
            //echo "<pre>";print_r($params); die();
            $table = $params['table'];
            $type_name = $params['type_name'];
            $data['table'] = $params['table'];
            $data['type_name'] = $params['type_name'];
            $data['master_selected_data'] = $table . ',' . $type_name;
            $data['selected_all_master_data'] = $data_list = $this->Registration_model->get_master_data($table);
            $data_fields = array_keys($data_list[0]);
            $type_array =  array('city', 'enthnicity', 'school', 'degree');
            if (in_array($type_name, $type_array)) {
                $data['id_field'] = $id = $data_fields[0];
                $data['name_field'] =  $name = $data_fields[2];
            } else {
                $data['id_field'] = $id = $data_fields[0];
                $data['name_field'] =  $name = $data_fields[1];
            }
        }

        //echo "<pre>";print_r($data);die();


        $data['get_master_list'] = $this->Registration_model->get_master_list();
        $data['content'] = 'backend/master_list';
        return view('backend/index', $data);
    }


    public function getmasterdata()
    {
        session()->remove('data_array');

        $function_name_array = explode(',', $this->request->getPost('function_name'));
        //echo "<pre>";print_r($function_name_array);
        $table = $function_name_array[0];
        $type = $function_name_array[1];

        $type_array =  array('city', 'enthnicity', 'school', 'degree');
        if (in_array($type, $type_array)) {
            //


            $data = $this->Registration_model->get_master_data($table);
            $data_fields = array_keys($data[0]);
            $id = $data_fields[0];
            $code_id = $data_fields[1];
            $name = $data_fields[2];
            $active = $data_fields[3];
            $state_code = $data_fields[5] ?? null;

            echo '<button class="btn btn-success btn-md add_city pull-right" table="' . $table . '" type="' . $type . '" > Add ' . $type . '</button> <br><br>';
            echo '<table  class="table  table-striped table-bordered alldataTable " id="alldataTable">
                          <thead>
                              <tr>
                                 <th>Description</th>
                                 <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>';
            foreach ($data as $datavalue) {
                echo "<tr><td>" . $datavalue[$name] . "</td>";
                echo '<td><button class="btn btn-primary btn-xs edit_city" rel_id="' . $datavalue[$id] . '" table="' . $table . '" type="' . $type . '" >Edit</button></td></tr>';
            }

            echo '</tbody>
                      </table>';
        } else {
            $data = $this->Registration_model->get_master_data($table);
            $data_fields = array_keys($data[0]);
            $id = $data_fields[0];

            $name = $data_fields[1];
            $active = $data_fields[2];


            echo '<button class="btn btn-success btn-md add_city pull-right" table="' . $table . '" type="' . $type . '" > Add ' . $type . '</button> <br><br>';
            echo '<table  class="table  table-striped table-bordered  alldataTable " id="alldataTable">
                          <thead>
                              <tr>
                                 <th>Description</th>
                                 <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>';
            foreach ($data as $datavalue) {
                echo "<tr><td>" . $datavalue[$name] . "</td>";
                echo '<td><button class="btn btn-primary btn-xs edit_city" rel_id="' . $datavalue[$id] . '" table="' . $table . '" type="' . $type . '" >Edit</button></td></tr>';
            }

            echo '</tbody>
                      </table>';
        }
        //die();
    }

    function add_master_data()
    {
        $table = $this->request->getPost('table_name');
        $type_name = $this->request->getPost('type_name');
        $data_array = array('table' => $table, 'type_name' => $type_name);
        $data = $this->Registration_model->add_master_data();
        if ($data) {
            session()->get('data_array', $data_array);
            session()->setFlashdata('msg', 'Record inserted  successfully . ');
            return redirect()->to('admin/Registration/get_master_list');
        } else {
            session()->setFlashdata('msg', 'Something Wrong . . . Please try later.');
            return redirect()->to('admin/Registration/get_master_list');
        }
    }


    function get_detail_of_data()
    {
        $id = $this->request->getPost('rel_id');
        $table = $this->request->getPost('table');
        $type = $this->request->getPost('type');
        $type_array =  array('city', 'enthnicity', 'school', 'degree');
        if (in_array($type, $type_array)) {

            $data = $this->Registration_model->get_detail_of_data($id, $table);
            // echo "<pre>";print_r($data);
            $data_fields = array_keys($data[0]);
            // echo "<pre>";print_r($data_fields);
            $id = $data_fields[0];
            $code_id = $data_fields[1];
            $name = $data_fields[2];
            $active = $data_fields[3];
            $state_code = $data_fields[5] ?? null;
            //$data['city'] = $this->Registration_model->get_all_city();
            $state = $this->Registration_model->get_all_state();

            if ($type == 'city') {
                echo  '<div class="form-group">';
                echo  '<label>State :</label>';
                echo  '<select class="form-control" name="state_code" required >';
                echo   '<option value="">Select State</option>';
                foreach ($state as $state_data) {
                    if ($state_data["StateID"] == $data[0][$state_code]) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }


                    echo '<option value="' . $state_data["StateID"] . '" ' . $selected . '>' . $state_data["StateName"] . '</option>';
                }

                echo  '</select></div>';
            }


            echo '<div class="form-group">';
            echo '<label>' . $type . ' ID :</label>';
            echo '<input type="hidden" value="' . $type . '"  name="type_name">';
            echo '<input type="hidden" value="' . $table . '"  name="table_name">';

            echo '<input type="hidden" id="current_city_id" value="' . $data[0][$id] . '" name="' . $id . '">';
            echo '<input type="text" class="form-control" id="edit_city_id" value="' . $data[0][$code_id] . '" name="' . $code_id . '" required placeholder="Enter City Id">';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>' . $type . ' Name :</label>';
            echo '<input type="text" class="form-control" id="edit_city_name" value="' . $data[0][$name] . '" name="' . $name . '" required placeholder="Enter City Name">';
            echo '</div>';

            echo '<div class="form-group">';
            echo '<label>Status :</label>';
            echo '<select class="form-control" name="' . $active . '" id="edit_status" required>';

            $sec =  '';
            $sec1 = '';

            if ($data[0][$active] == 1) {
                $sec = 'selected';
            } else {
                $sec1 = 'selected';
            }

            echo '<option ' . $sec . ' value="1">Active</option>';
            echo '<option ' . $sec1 . ' value="0">In-Active</option>';
            echo '</select>';
            echo '</div>';
        } else {

            $data = $this->Registration_model->get_detail_of_data($id, $table);
            // echo "<pre>";print_r($data);
            $data_fields = array_keys($data[0]);
            // echo "<pre>";print_r($data_fields);
            $id = $data_fields[0];

            $name = $data_fields[1];
            $active = $data_fields[2];
            echo '<div class="form-group">';
            echo '<input type="hidden" value="' . $type . '"  name="type_name">';
            echo '<input type="hidden" value="' . $table . '"  name="table_name">';

            echo '<input type="hidden" id="current_city_id" value="' . $data[0][$id] . '" name="' . $id . '">';

            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>' . $type . ' Name :</label>';
            echo '<input type="text" class="form-control" id="edit_city_name" value="' . $data[0][$name] . '" name="' . $name . '" required placeholder="Enter City Name">';
            echo '</div>';

            echo '<div class="form-group">';
            echo '<label>Status :</label>';
            echo '<select class="form-control" name="' . $active . '" id="edit_status" required>';

            $sec =  '';
            $sec1 = '';

            if ($data[0][$active] == 1) {
                $sec = 'selected';
            } else {
                $sec1 = 'selected';
            }

            echo '<option ' . $sec . ' value="1">Active</option>';
            echo '<option ' . $sec1 . ' value="0">In-Active</option>';
            echo '</select>';
            echo '</div>';
        }
    }



    function get_detail_of_add_data()
    {

        $table = $this->request->getPost('table');
        $type = $this->request->getPost('type');
        $type_array =  array('city', 'enthnicity', 'school', 'degree');
        if (in_array($type, $type_array)) {

            $data_fields = $this->Registration_model->get_field_of_table_data($table);
            // echo "<pre>";print_r($data);die();
            // $data_fields = array_keys($data[0]);
            // echo "<pre>";print_r($data_fields);
            $id = $data_fields[0];
            $code_id = $data_fields[1];
            $name = $data_fields[2];
            $active = $data_fields[3];
            $state_code = $data_fields[5] ?? null;
            //$data['city'] = $this->Registration_model->get_all_city();
            $state = $this->Registration_model->get_all_state();

            if ($type == 'city') {
                echo  '<div class="form-group">';
                echo  '<label>State :</label>';
                echo  '<select class="form-control" name="state_code" required >';
                echo   '<option value="">Select State</option>';
                foreach ($state as $state_data) {
                    if ($state_data["StateID"] == isset($data[0][$state_code])) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }


                    echo '<option value="' . $state_data["StateID"] . '" ' . $selected . '>' . $state_data["StateName"] . '</option>';
                }

                echo  '</select></div>';
            }


            echo '<div class="form-group">';
            echo '<label>' . $type . ' ID :</label>';
            echo '<input type="hidden" value="' . $type . '"  name="type_name">';
            echo '<input type="hidden" value="' . $table . '"  name="table_name">';


            echo '<input type="text" class="form-control" id="edit_city_id"  name="' . $code_id . '" required placeholder="Enter City Id">';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>' . $type . ' Name :</label>';
            echo '<input type="text" class="form-control" id="edit_city_name"  name="' . $name . '" required placeholder="Enter City Name">';
            echo '</div>';

            echo '<div class="form-group">';
            echo '<label>Status :</label>';
            echo '<select class="form-control" name="' . $active . '" id="edit_status" required>';

            $sec =  '';
            $sec1 = '';

            if (isset($data[0][$active]) == 1) {
                $sec = 'selected';
            } else {
                $sec1 = 'selected';
            }

            echo '<option ' . $sec . ' value="1">Active</option>';
            echo '<option ' . $sec1 . ' value="0">In-Active</option>';
            echo '</select>';
            echo '</div>';
        } else {

            $data_fields = $this->Registration_model->get_field_of_table_data($table);
            // echo "<pre>";print_r($data);
            // $data_fields = array_keys($data[0]);
            // echo "<pre>";print_r($data_fields);
            $id = $data_fields[0];

            $name = $data_fields[1];
            $active = $data_fields[2];
            echo '<div class="form-group">';
            echo '<input type="hidden" value="' . $type . '"  name="type_name">';
            echo '<input type="hidden" value="' . $table . '"  name="table_name">';



            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>' . $type . ' Name :</label>';
            echo '<input type="text" class="form-control" id="edit_city_name"  name="' . $name . '" required placeholder="Enter City Name">';
            echo '</div>';

            echo '<div class="form-group">';
            echo '<label>Status :</label>';
            echo '<select class="form-control" name="' . $active . '" id="edit_status" required>';

            $sec =  '';
            $sec1 = '';

            if (isset($data[0][$active]) == 1) {
                $sec = 'selected';
            } else {
                $sec1 = 'selected';
            }

            echo '<option ' . $sec . ' value="1">Active</option>';
            echo '<option ' . $sec1 . ' value="0">In-Active</option>';
            echo '</select>';
            echo '</div>';
        }
    }



    function update_master_data()
    {
        $table = $this->request->getPost('table_name');
        $type_name = $this->request->getPost('type_name');
        $data_array = array('table' => $table, 'type_name' => $type_name);
        $data = $this->Registration_model->update_master_data();
        if ($data) {
            session()->set('data_array', $data_array);
            session()->setFlashdata('msg', 'Record updated  successfully . ');
            return redirect()->to('admin/Registration/get_master_list');
        } else {
            session()->setFlashdata('msg', 'Something Wrong . . . Please try later.');
            return redirect()->to('admin/Registration/get_master_list');
        }
    }

     function enthnicity()
    {
        $data['enthnicity'] = $this->Registration_model->get_all_enthnicity();
		$data['content'] = 'backend/enthnicity';
		return view('backend/index', $data);
    }

     function get_detail_of_ethnicity()
    {
        
        
        $id = $this->request->getPost('rel_id');
        if($id != '')
        {
           $data = $this->Registration_model->get_detail_of_ethnicity($id);
           echo '<div class="form-group">';
           echo '<label>Ethnicity ID :</label>';
           echo '<input type="hidden" id="current_ethnicity_id" value="'.$id.'" name="current_ethnicity_id">';
           echo '<input type="text" class="form-control" value="'.$data['EthnicID'].'" name="ethnicity_id" required placeholder="Enter Ethnicity Id">';
           echo '</div>';
           echo '<div class="form-group">';
           echo '<label>Ethnicity Name :</label>';
           echo '<input type="text" class="form-control" value="'.$data['EthnicName'].'" name="ethnicity_name" required placeholder="Enter Ethnicity Name">';
           echo '</div>';
          
           echo '<div class="form-group">';
           echo '<label>Status :</label>';
           echo '<select class="form-control" name="status" required>';
           
           $sec=  '';
           $sec1= '';
           
           if($data['Active'] == 1)
           {
               $sec= 'selected';
           }
           else
           {
               $sec1= 'selected';
           }
           
           echo '<option '.$sec.' value="1">Active</option>';
           echo '<option '.$sec1.' value="0">In-Active</option>';
           echo '</select>';
           echo '</div>';
        }
        
        
    }

      function store_ethnicity()
    {
        $data = $this->Registration_model->add_enthnicity();
        if($data)
        {
             session()->setFlashdata('msg','Record inserted  successfully . ');
	         return redirect()->to('admin/Registration/enthnicity');
        }
        else
        {
             session()->setFlashdata('msg','EthnicityId is already exits . . . Please try later.');
	        return redirect()->to('admin/Registration/enthnicity');
        }
    }
    
    function update_ethnicity()
    {
        $data = $this->Registration_model->update_ethnicity();
        if($data)
        {
             session()->setFlashdata('msg','Record updated  successfully . ');
	         return redirect()->to('admin/Registration/enthnicity');
        }
        else
        {
             session()->setFlashdata('msg','Something Wrong . . . Please try later.');
	       return redirect()->to('admin/Registration/enthnicity');
        }
    } 
    
    function school()
    {
        $data['school'] = $this->Registration_model->get_all_school();
		$data['content'] = 'backend/school';
		return view('backend/index', $data);
    }

    function store_school()
    {
        $data = $this->Registration_model->add_school();
        if($data)
        {
             session()->setFlashdata('msg','Record inserted  successfully . ');
	         return redirect()->to('admin/Registration/school');
        }
        else
        {
             session()->setFlashdata('msg','SchoolId is already exits . . . Please try later.');
	       return redirect()->to('admin/Registration/school');
        }
    }

    function get_detail_of_school()
    {
        $id = $this->request->getPost('rel_id');
        if($id != '')
        {
           $data = $this->Registration_model->get_detail_of_school($id);
           echo '<div class="form-group">';
           echo '<label>School ID :</label>';
           echo '<input type="hidden" id="current_school_id" value="'.$id.'" name="current_school_id">';
           echo '<input type="text" class="form-control" id="edit_school_id" value="'.$data['SchoolID'].'" name="edit_school_id" required placeholder="Enter School Id">';
           echo '</div>';
           echo '<div class="form-group">';
           echo '<label>School Name :</label>';
           echo '<input type="text" class="form-control" id="edit_school_name" value="'.$data['SchoolName'].'" name="edit_school_name" required placeholder="Enter School Name">';
           echo '</div>';
          
           echo '<div class="form-group">';
           echo '<label>Status :</label>';
           echo '<select class="form-control" name="status" id="edit_status" required>';
           
           $sec=  '';
           $sec1= '';
           
           if($data['Active'] == 1)
           {
               $sec= 'selected';
           }
           else
           {
               $sec1= 'selected';
           }
           
           echo '<option '.$sec.' value="1">Active</option>';
           echo '<option '.$sec1.' value="0">In-Active</option>';
           echo '</select>';
           echo '</div>';
        }
    }
    
    function update_school()
    {
        $data = $this->Registration_model->update_school();
        if($data)
        {
             session()->setFlashdata('msg','Record updated  successfully . ');
           return redirect()->to('admin/Registration/school');
        }
        else
        {
             session()->setFlashdata('msg','Something Wrong . . . Please try later.');
         return redirect()->to('admin/Registration/school');
        }
        
    }

    function degree()
    {
        $data['degree'] = $this->Registration_model->get_all_degree();
		$data['content'] = 'backend/degree';
		return view('backend/index', $data);
    }

    function store_degree()
    {
        $data = $this->Registration_model->add_degree();
        if($data)
        {
             session()->setFlashdata('msg','Record inserted  successfully . ');
	         return redirect()->to('admin/Registration/degree');
        }
        else
        {
             session()->setFlashdata('msg','degreeId is already exits . . . Please try later.');
	       return redirect()->to('admin/Registration/degree');
        }
    }

    function get_detail_of_degree()
    {
        $id = $this->request->getPost('rel_id');
        if($id != '')
        {
           $data = $this->Registration_model->get_detail_of_degree($id);
           echo '<div class="form-group">';
           echo '<label>Degree ID  :</label>';
           echo '<input type="hidden" id="current_city_id" value="'.$id.'" name="current_city_id">';
           echo '<input type="text" class="form-control" id="degree_id" value="'.$data['DegreeID'].'" name="degree_id" required placeholder="Enter Degree Id">';
           echo '</div>';
           echo '<div class="form-group">';
           echo '<label>City Name :</label>';
           echo '<input type="text" class="form-control" id="degree_name" value="'.$data['DegreeName'].'" name="degree_name" required placeholder="Enter Degree Name">';
           echo '</div>';
          
           echo '<div class="form-group">';
           echo '<label>Status :</label>';
           echo '<select class="form-control" name="status" id="edit_status" required>';
           
           $sec=  '';
           $sec1= '';
           
           if($data['Active'] == 1)
           {
               $sec= 'selected';
           }
           else
           {
               $sec1= 'selected';
           }
           
           echo '<option '.$sec.' value="1">Active</option>';
           echo '<option '.$sec1.' value="0">In-Active</option>';
           echo '</select>';
           echo '</div>';
        }
    }
    
    function update_degree()
    {
        $data = $this->Registration_model->update_degree();
        if($data)
        {
            session()->setFlashdata('msg','Record updated  successfully . ');
            return redirect()->to('admin/Registration/degree');
        }
        else
        {
            session()->setFlashdata('msg','Something Wrong . . . Please try later.');
            return redirect()->to('admin/Registration/degree');
        }
        
    }

}
