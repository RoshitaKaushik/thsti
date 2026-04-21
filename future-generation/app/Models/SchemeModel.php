<?php

namespace App\Models;
use Config\Database;
use CodeIgniter\Model;

class SchemeModel extends Model
{

    protected $primaryKey = 'ID';
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
    }

    public function get_component($scheme_id)
{
    $data = [];
    $db = \Config\Database::connect();
    $builder = $db->table('mst_scheme_component');

    $builder->select('*');
    $builder->where([
        'scheme_id' => $scheme_id,
        'scheme_component_status' => '1'
    ]);
    
    $query = $builder->get();

    if ($query->getNumRows() > 0) {
        foreach ($query->getResultArray() as $row) {
            $data[] = $row;
        }
        return $data;
    } else {
        return false;
    }
}

function insertScheme($param){
		$data = array();
		$response = array();
		foreach($param as $key => $val){			
			$data[$key] = test_input($val);						
		}
		
		// Check Discipline exists
        $builder = $this->db->table('mst_scheme');
		$builder->select('scheme_id');
		$builder->where('scheme_name', $data['scheme_name']);
		$query = $builder->get();
		if($query->getNumRows() == 0){
			
			$query1 = $this->db->table('mst_scheme')->insert($data);		
			if($query1){
				$response['status'] = true;
				$response['msg'] = 'INSERTED';
				$response['last_insert_id'] = $this->db->insertId();
			}else{			
				$response['status'] = false;
				$response['msg'] = $this->db->error()['message'];
			}
		}else{ 
			$response['status'] = false;
			$response['msg'] = 'EXISTS';
		}
				
		return $response;
	} 
	
	
	function updateScheme($param){
		$data = array();
		$response = array();
		foreach($param as $key => $val){			
			$data[$key] = test_input($val);						
		}
		
		$this->db->table('scheme_id')->where($data['scheme_id']);
		$query = $this->db->table('mst_scheme')->update($data); 
	
		if($query){
			$response['status'] = true;
			$response['msg'] = 'UPDATED';
		}else{			
			$response['status'] = false;
			$response['msg'] = $this->db->error()['message'];
		}
		
		return $response;
	
	} 
	
	function allScheme(){
		$this->db->table('mst_scheme')->select('*');
		$query = $this->db->table('mst_scheme')->get();
		if($query->getNumRows() >= 1){
			return $query->getResultArray();
		}
		else{ 
			return false;
		}
	} 
	
	function allMultipleCompScheme(){
		$this->db->table('mst_scheme')->select('*');
		$this->db->table('mst_scheme')->where('scheme_status', 1);
		$this->db->table('mst_scheme')->where('multiple_component', 1);
		$query = $this->db->table('mst_scheme')->get();
		if($query->getNumRows() >= 1){
			return $query->getResultArray();
		}
		else{ 
			return false;
		}
	}
	
	

    // Get Scheme
    function get_scheme($data) {
		$this->db->table('mst_scheme')->select('*');
		$query = $this->db->table('mst_scheme')->get();
		if($query->getNumRows() >= 1){
			return $query->getResultArray();
		}
		else{ 
			return false;
		}
    }
	
	function allSchemeById($scheme_id){
		$this->db->table('mst_scheme')->select('*');
		$this->db->table('mst_scheme')->where('scheme_id', $scheme_id);
		$query = $this->db->table('mst_scheme')->get();
		if($query->getNumRows() >= 1){
			return $query->getResultArray();
		}
		else{ 
			return false;
		}
	}
	
	// Get Scheme
    function getMultipleScheme($scheme_ids) {

        $this->db->table('mst_scheme AS A')->select('*');
		$this->db->table('mst_scheme AS A')->whereIn('scheme_id', $scheme_ids);
		$this->db->table('mst_scheme AS A')->orderBy('scheme_name', 'ASC');
		$query = $this->db->table('mst_scheme AS A')->get();
	
		if($query->getNumRows() >= 1){
			return $query->getResultArray();
		}
		else{ 
			return false;
		}
    }
	
	
	/******************
	******************
	Component Functions
	****************
	*/
	function insertComponent($param){
		$data = array();
		$response = array();
		foreach($param as $key => $val){			
			$data[$key] = test_input($val);						
		}
		
		// Check Component exists

        $builder = $this->db->table('mst_scheme_component');
		$builder->select('id');
		$builder->where('scheme_component_name', $data['scheme_component_name']);

		$query = $builder->get();
		if($query->getNumRows() == 0){
			
			$query1 = $this->db->table('mst_scheme_component')->insert($data);		
			if($query1){
				$response['status'] = true;
				$response['msg'] = 'INSERTED';
				$response['last_insert_id'] = $this->db->insertId();
			}else{			
				$response['status'] = false;
				$response['msg'] = $this->db->error()['message'];
			}
		}else{ 
			$response['status'] = false;
			$response['msg'] = 'EXISTS';
		}
				
		return $response;
	} 
	
	
	function updateComponent($param){
		
		$data = array();
		$response = array();
		foreach($param as $key => $val){			
			$data[$key] = test_input($val);						
		}
		$builder = $this->db->table('mst_scheme_component');
		$builder->select('id');
		$builder->where('id !=', $data['id']);
		$builder->where('scheme_component_name', $data['scheme_component_name']);

		$query = $builder->get();
		if($query->getNumRows() == 0){
		
			$builder->where('id', $data['id']);
			$query = $builder->update('mst_scheme_component', $data); 
		
			if($query){
				$response['status'] = true;
				$response['msg'] = 'UPDATED';
			}else{			
				$response['status'] = false;
				$response['msg'] = $this->db->error()['message'];
			}
			
		}else{ 
			$response['status'] = false;
			$response['msg'] = 'EXISTS';
		}
		
		return $response;
	
	} 
	
	function updateComponentByScheme($param){
		$data = array();
		$response = array();
		foreach($param as $key => $val){			
			$data[$key] = test_input($val);						
		}
		
        $builder = $this->db->table('mst_scheme_component');
		$builder->where('scheme_id', $data['scheme_id']);
		$query = $builder->update($data); 
	
		if($query){
			$response['status'] = true;
			$response['msg'] = 'UPDATED';
		}else{			
			$response['status'] = false;
			$response['msg'] = $this->db->error()['message'];
		}
		
		return $response;
	
	} 
	
			
	// Get Scheme
    function getMultipleComponent($component_ids) {

        $builder = $this->db->table('mst_scheme_component AS A');
        $builder->select('*');
		$builder->whereIn('id', $component_ids);
		$query = $builder->get();
	
		if($query->getNumRows() >= 1){
			return $query->getResultArray();
		}
		else{ 
			return false;
		}
    }
	
	
	// Get component
    function get_componentbyID($component_id) {
		$data = array();
		$component_id = test_input($component_id);
        $builder = $this->db->table('mst_scheme_component');
        $builder->select('*');
		$query = $builder->getWhere(array('id' => $component_id));
		//echo $this->db->last_query();die;
		if ($query->getNumRows() > 0) {
			foreach ($query->getResultArray() as $row) {
				$data[] = $row;
			}

			return $data;
		
		}else{ return false;}
    }
	
	// Get component
    function getComponentWithFormModule($id) {
		$data = array();
		$component_id = test_input($id);

        $db = Database::connect('formbuilder');
        $builder = $db->table('mst_scheme_component AS a');
        $builder->select('a.*,c.scheme_name,GROUP_CONCAT(b.builder_module ORDER BY b.builder_module_id) module_names');	
		$builder->join('tbl_form_builder_module as b', 'FIND_IN_SET(b.builder_module_id, a.form_build_modules) > 0', 'LEFT');
		$builder->join('mst_scheme as c', 'c.scheme_id = a.scheme_id', 'INNER');
		$builder->where('id', $id);
		$query = $builder->get();
		if($query->getNumRows() > 0){

			$data = $query->getResultArray();
			return $data;
		
		}else{ return false;}
    }
	
	function getAllComponentWithFormModule(){

        $builder = $this->db->table('mst_scheme_component AS msc');
		$builder->select('msc.*,ms.scheme_name');
		$builder->join('mst_scheme as ms', 'ms.scheme_id = msc.scheme_id', 'INNER');
		$builder->where('msc.form_build', 1);
		$builder->where('msc.scheme_component_status', 1);
		$query = $builder->get();

		if ($query->getNumRows() > 0) { 
			foreach ($query->getResultArray() as $row) {
				$data[] = $row;
			}

			return $data;
		
		}else{ return false;}
    }
	
	// Get component by scheme
    function getAllComponentWithOutFormModule($scheme_id){
		
        $builder = $this->db->table('mst_scheme_component AS msc');
		$builder->select('msc.*,ms.scheme_name');
		$builder->join('mst_scheme as ms', 'ms.scheme_id = msc.scheme_id', 'INNER');
		//$this->db->where('msc.form_build is null');
		$builder->where('msc.scheme_id', $scheme_id);
		
		$query = $builder->get();
		//echo $this->db->last_query();die;
		if ($query->getNumRows() > 0) { 
			foreach ($query->getResultArray() as $row) {
				$data[] = $row;
			}

			return $data;
		
		}else{ return false;}
		
    }
	
	function get_all_access_level(){
		
        $builder = $this->db->table('mst_process_level');
		$builder->select();
		$query = $builder->get('mst_process_level');
		if ($query->getNumRows() > 0) {
			foreach ($query->getResultArray() as $row) {
				$data[] = $row;
			}

			return $data;
		
		}else{ return false;}

	}
	
	
	function getComponentLevel($component_id){
		
        $builder = $this->db->table('mst_scheme_process_level');
		$builder->select();
		$builder->where('component_id', $component_id);
		$query = $builder->get();
		if ($query->getNumRows() > 0) {
			$result = $query->getResultArray();	
			return $result[0];
		}else{ 
			return array();
		}

	}
	
	function get_all_button(){
		
        $builder = $this->db->table('mst_buttons');
		$builder->select();
		$query = $builder->get();
		if ($query->getNumRows() > 0) {
			foreach ($query->getResultArray() as $row) {
				$data[] = $row;
			}

			return $data;
		
		}else{ return false;}

	}
	
	function get_field_types(){
		
        $builder = $this->db->table('mst_form_field_type');
		$builder->select();
		$builder->where('field_type_status', 1);
		$query = $builder->get();
		if ($query->getNumRows() > 0) {
			foreach ($query->getResultArray() as $row) {
				$data[] = $row;
			}

			return $data;
		
		}else{ return false;}

	}
	
	function get_process_level_of_one_scheme($id){
		$id = test_input($id);

        $builder = $this->db->table('mst_scheme_process_level');
		$builder->select();
		$query = $builder->getWhere(array("id"=>$id));
		if ($query->getNumRows() > 0) {
			foreach ($query->getResultArray() as $row) {
				$data[] = $row;
			}

			return $data;
		
		}else{ return array();}

	}
	
	function get_processLevelOfSchemeBySchemeComponent($scheme_id,$component_id){
		$scheme_id = test_input($scheme_id);
		$component_id = test_input($component_id);
        $builder = $this->db->table('mst_scheme_process_level');
		$builder->select();
		$query = $builder->getWhere(array("scheme_id"=>$scheme_id,"component_id"=>$component_id));
		if ($query->getNumRows() > 0) {
			foreach ($query->getResultArray() as $row) {
				$data[] = $row;
			}

			return $data;
		
		}else{ return array();}

	}

    // Get All Profiles for Admin
    function getProfiles() {
        $res = $this->db->query("CALL `SP_Profile`('All','','','','','','','',@Pstatus)");
        $this->db->connID->next_result();
        return $res->getResultArray();
        $res->free_result();
    }

    // Get All Modules for Admin
    function getModules() {
        $res = $this->db->query("CALL `SP_Modules`('All','','','','','','','','','','','','',@Pstatus)");
        $this->db->connID->next_result();
        return $res->getResultArray();
        $res->free_result();
    }

    // Get All Modules by parent ID
    function getModulelists($param) {
        $param['Module'] = test_input($param['Module']);
        //echo "CALL `SP_Modules`('ByParentId','','','','','','','','{$param['Module']}','','','','',@Pstatus)";
        $res = $this->db->query("CALL `SP_Modules`('ByParentId','','','','','','','','{$param['Module']}','','','','',@Pstatus)");
        $this->db->connID->next_result();
        //echo "<pre>";print_r($res->getResultArray());die;
        return $res->getResultArray();
        $res->free_result();
    }

    // Get All Modules by four parent ID
    function getModulebyfour($param) {
        $param['Module'] = test_input($param['Module']);
        //echo "CALL `SP_Modules`('ByParentId','','','','','','','','{$param['Module']}','','','','',@Pstatus)";
        $res = $this->db->query("CALL `SP_Modules`('ByFourParentId','','','','','','','','{$param['Module']}','','','','',@Pstatus)");
        $this->db->connID->next_result();
        //echo "<pre>";print_r($res->getResultArray());die;
        return $res->getResultArray();
        $res->free_result();
    }

    // Get All Accesses
    function getAccess() {
        $res = $this->db->query("CALL `SP_Access`()");
        $this->db->connID->next_result();
        return $res->getResultArray();
        $res->free_result();
    }

    // Insert Privilege 
    // function insertPrivilege($param) {
    //     //echo "<pre>";print_r($param);die;
    //     $param['Profile'] = test_input($param['Profile']);
    //     $ci = & get_instance();
    //     $sql = "CALL `SP_Privilege`('Insert', 0, '{$param['Profile']}',";
    //     $del_query = "CALL `SP_Modules`('Delete','{$param['Profile']}','','','',0,'','',0,'','','','',@Pstatus)";
    //     $res1 = $ci->db->query($del_query);
    //     $res1->free_result();

    //     $length = sizeof($param['ModuleList']);
    //     if ($length > 0) {
    //         foreach ($param['ModuleList'] as $val) {
    //             $ci2 = & get_instance();
    //             $sql1 = '';
    //             $sql1 = "{$val},";

    //             $query = '';
    //             $query = $sql . $sql1;
    //             $query2 = $query . "0, '{$param['PCreatedBy']}','0', @PSTATUS)";
    //             $query = $query2;
    //             $res = $ci2->db->query($query2);
    //             $this->db->connID->next_result();
    //             $result = $res->getResultArray();
    //             $res->free_result();
    //         }
    //     }

    //     return $res->getResultArray();
    // }

    // Insert Privilege 
    // function insertPrivilege_old($param) {
    //     //echo "<pre>";print_r($param);die;
    //     $param['Profile'] = test_input($param['Profile']);
    //     $sql = "CALL `SP_Privilege`('Insert', 0, '{$param['Profile']}',";
    //     $length = sizeof($param['access']);
    //     if ($length > 0) {
    //         foreach ($param['access'] as $key => $val) {
    //             $sql1 = '';
    //             $sql1 = "{$key},";

    //             $ci = & getInstance();

    //             $del_query = "CALL `SP_Modules`('Delete',{$key},'','','',0,'','',0,'','','','',@Pstatus)";
    //             $res1 = $ci->db->query($del_query);
    //             $res1->free_result();

    //             //$sql = $sql1;
    //             foreach ($val as $v) {
    //                 $query2 = '';
    //                 $query = '';
    //                 $query2 = $sql1 . "{$v}, '{$param['PCreatedBy']}','0', @PSTATUS)";
    //                 $query = $sql . $query2;
    //                 $res = $this->db->query($query);
    //                 $this->db->connID->next_result();
    //                 $result = $res->getResultArray();
    //                 $res->freeResult();
    //             }
    //         }
    //     }
    //     //die;
    //     return $res->getResultArray();
    // }

    // Insert User in Admin
    function insertUser($data) {
        $param = array();
        foreach ($data as $key => $val) {
            $param[$key] = test_input($val);
        }

        $sql = "CALL `SP_AdminUsers`('Insert','{$param['ADMIN_USER_ID']}','{$param['USERS_FULL_NAME']}','{$param['PASSWORD']}','{$param['USER_TYPE']}','{$param['MOBILE_NO']}','{$param['EMAIL']}','{$param['DESIGNATION']}','{$param['PASSWORD_TYPE']}','{$param['LOGIN_STATUS']}','{$param['FAILED_ATTEMPTS']}','{$param['ACCOUNT_STATUS']}','{$param['LAST_LOGIN_TIME']}','{$param['REQUEST_IP']}','{$param['SESSION_ID']}','{$param['SESSION_EXPIRATION_TIME']}','{$param['LOGOUT_TIME']}','{$param['F_IP']}','{$param['F_LASTLOGIN']}','{$param['F_MACADDRESS']}','{$param['PASSWORD_CHANGED_IP']}','{$param['ADDRESS']}','{$param['CREATED_BY']}','{$param['CREATED_IP']}','{$param['CREATED_DATE']}','{$param['ROLE']}','{$param['ADDRESS_2']}','{$param['TOWN_CITY']}','{$param['DISTRICT']}','{$param['PINCODE']}','{$param['STATE']}','{$param['COUNTRY']}', @status)";
        $res = $this->db->query($sql, $param);
        //echo "<pre>";print_r($res->getResultArray());die;
        $this->db->connID->next_result();
        return $res->getResultArray();
        $res->free_result();
    }

    // Insert User in Admin
    function get_user_for_internal_query($data) {
        $param = array();
        foreach ($data as $key => $val) {
            $param[$key] = test_input($val);
        }

        $sql = "CALL `SP_AdminUsers`('ForInternalQuery','{$param['ADMIN_USER_ID']}','{$param['USERS_FULL_NAME']}','{$param['PASSWORD']}','{$param['USER_TYPE']}','{$param['MOBILE_NO']}','{$param['EMAIL']}','{$param['DESIGNATION']}','{$param['PASSWORD_TYPE']}','{$param['LOGIN_STATUS']}','{$param['FAILED_ATTEMPTS']}','{$param['ACCOUNT_STATUS']}','{$param['LAST_LOGIN_TIME']}','{$param['REQUEST_IP']}','{$param['SESSION_ID']}','{$param['SESSION_EXPIRATION_TIME']}','{$param['LOGOUT_TIME']}','{$param['F_IP']}','{$param['F_LASTLOGIN']}','{$param['F_MACADDRESS']}','{$param['PASSWORD_CHANGED_IP']}','{$param['ADDRESS']}','{$param['CREATED_BY']}','{$param['CREATED_IP']}','{$param['CREATED_DATE']}','{$param['ROLE']}','{$param['ADDRESS_2']}','{$param['TOWN_CITY']}','{$param['DISTRICT']}','{$param['PINCODE']}','{$param['STATE']}','{$param['COUNTRY']}', @status)";
        $res = $this->db->query($sql, $param);
        //echo "<pre>";print_r($res->getResultArray());die;
        $this->db->connID->next_result();
        return $res->getResultArray();
        $res->free_result();
    }

    // Insert User in Admin
    function getAdminRecord($USERID) {
        $USERID = test_input($USERID);
        $res = $this->db->query("CALL `SP_AdminUsers`('OneAdmin','{$USERID}','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',@status)");
        $this->db->connID->next_result();
        return $res->getResultArray();
        $res->free_result();
    }

    // Check Password Change
    function checkChangePassword($USERID) {
        $USERID = test_input($USERID);
        $res = $this->db->query("CALL `SP_AdminUsers`('OneAdmin','{$USERID}','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',@status)");
        $this->db->connID->next_result();
        return $res->getResultArray();
        $res->free_result();
    }

    // Update Password 
    function updatePassword($param) {
        $data = array();
        foreach ($param as $key => $val) {
            $data[$key] = test_input($val);
        }
        $res = $this->db->query('CALL `SP_ChangePassword`(?,?,?,?,?,@abc)', $data);
        $this->db->connID->next_result();
        return $res->getResultArray();
        $res->free_result();
    }

    // Get All Users for Admin
    function getUsers() {
        $res = $this->db->query("CALL `SP_AdminUsers`('All','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?', @PSTATUS)");
        $this->db->connID->next_result();
        return $res->getResultArray();
        $res->free_result();
    }

    // ASSIGN Role TO Profile
    // function insertRoleProfile($param) {

    //     $param['RoleID'] = test_input($param['RoleID']);
    //     $ci = & get_instance();
    //     $sql = "CALL `SP_RoleProfile`('{$param['QUERY_TYPE']}', '{$param['RoleProfileID']}', '{$param['RoleID']}',";
    //     $del_query = "CALL `SP_RoleProfile`('DROWS','',{$param['RoleID']}, '', '', '', @PSTATUS)";
    //     $res1 = $ci->db->query($del_query);
    //     $res1->next_result();
    //     $res1->getResultArray();
    //     $res1->free_result();

    //     $length = sizeof($param['ProfileID']);
    //     if ($length > 0) {
    //         foreach ($param['ProfileID'] as $val) {
    //             $ci2 = & get_instance();
    //             $sql1 = '';
    //             $sql1 = "'{$val}',";

    //             $query = '';
    //             $query = $sql . $sql1;
    //             $query2 = $query . "'{$param['CreatedBy']}', '{$param['ModifiedBy']}', @PSTATUS)";
    //             $query = $query2;
    //             $res = $ci2->db->query($query2);
    //             $this->db->connID->next_result();
    //             $result = $res->getResultArray();
    //             $res->free_result();
    //         }
    //     }

    //     return $res->getResultArray();
    // }

    function roleAccess() {
        $res = $this->db->query("select case when r1.rolename is null then r2.rolename else r1.rolename end as parentname, r1.rolename parentrolename, r1.roleid pid, r2.rolename mainrolename,r2.roleid from tblroles r1 right outer join tblroles r2 on r1.roleid=r2.parentroleid");
        $res = $res->getResultArray();
        //$this->db->connID->next_result();
        return $res;
        $res->free_result();
    }

    function getAdminLogs() {

        $builder = $this->db->table('admin_login_log');
        $builder->select('*');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
        $res->free_result();
    }

    function getUsersLogs() {

        $builder = $this->db->table('user_login_log');
        $builder->select('*');
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
        $res->free_result();
    }
	
	function getDisciplines() {
		
        $builder = $this->db->table('mst_discipline');
        $builder->select('*');
		$builder->orderBy('discipline_name', 'ASC');
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }
	// used for scheme type selection master table 
	function getSchemetype() {
		
        $builder = $this->db->table('mst_scheme_type');
        $builder->select('*');
		$builder->where('scheme_type_status', 1);
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getUserDetails($USER_ID) {
        $USER_ID = test_input($USER_ID);
        $res = $this->db->query("CALL `SP_AdminUsers`('One','{$USER_ID}','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',@status)");
        $this->db->connID->next_result();
        //echo "<pre>";print_r($res->getResultArray());die;
        return $res->getResultArray();
        $res->free_result();
        /*  $this -> db -> select();
          $this -> db -> from('admin_login');
          $this -> db -> where('ID', $ID);
          $query = $this -> db -> get();
          if($query -> getNumRows() >= 1){
          return $query->getResultArray();
          }
          else{
          return false;
          } */
    }

    function get_city($city_id) {

        $builder = $this->db->table('state_city');
        $city_id = test_input($city_id);
        $builder->select('id, DISTRICT_NAME');
        $builder->where('ID', $city_id);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function updateUserdetails($data) {
        //echo "<pre>";print_r($param);die;
        $param = array();
        foreach ($data as $key => $val) {
            $param[$key] = test_input($val);
        }
        $sql = "CALL `SP_AdminUsers`('UPDATE','{$param['ADMIN_USER_ID']}','{$param['USERS_FULL_NAME']}','','{$param['USER_TYPE']}','{$param['MOBILE_NO']}','{$param['EMAIL']}','{$param['DESIGNATION']}','{$param['PASSWORD_TYPE']}','{$param['LOGIN_STATUS']}','{$param['FAILED_ATTEMPTS']}','{$param['ACCOUNT_STATUS']}','{$param['LAST_LOGIN_TIME']}','{$param['REQUEST_IP']}','{$param['SESSION_ID']}','{$param['SESSION_EXPIRATION_TIME']}','{$param['LOGOUT_TIME']}','{$param['F_IP']}','{$param['F_LASTLOGIN']}','{$param['F_MACADDRESS']}','{$param['PASSWORD_CHANGED_IP']}','{$param['ADDRESS']}','{$param['CREATED_BY']}','{$param['CREATED_IP']}','{$param['CREATED_DATE']}','{$param['ROLE']}','{$param['ADDRESS_2']}','{$param['TOWN_CITY']}','{$param['DISTRICT']}','{$param['PINCODE']}','{$param['STATE']}','{$param['COUNTRY']}', @status)";
        $res = $this->db->query($sql, $param);
        //echo "<pre>";print_r($res->getResultArray());die;
        $this->db->connID->next_result();
        return $res->getResultArray();
        $res->free_result();
    }

    function updateResetPassword($data) {
        $param = array();
        foreach ($data as $key => $val) {
            $param[$key] = test_input($val);
        }
        //echo "<pre>";print_r($param);die;
        $sql = "CALL `SP_AdminUsers`('Reset_Password','{$param['ADMIN_USER_ID']}','','{$param['PASSWORD']}','','','','','','','','','','','','','','','','','','','','','','','','','','','','', @status)";
        $res = $this->db->query($sql, $param);
        //echo "<pre>";print_r($res->getResultArray());die;
        $this->db->connID->next_result();
        return $res->getResultArray();
        $res->free_result();
    }
	
	// get scheme_name and code
	
	function getSchemeDetails($scheme_id,$component_id){
		

		if($component_id==0){
			$query=$this->db->query("select scheme_code  from mst_scheme where scheme_id='".$scheme_id."'");
		}else{
			$query=$this->db->query("select sch.scheme_code,comp.scheme_component_code  from mst_scheme sch inner join mst_scheme_component comp ON sch.scheme_id=comp.scheme_id where comp.id='".$component_id."'");	
		}
		
		//echo "<pre>";print_r($query->getResultArray());die;
		if($query->getNumRows() >=1){ 
			return $query->getResultArray();
        }else{
			return false;
		}
		
	}

}
