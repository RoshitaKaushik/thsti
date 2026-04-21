<?php

namespace App\Models;

use Config\Database;

use CodeIgniter\Model;

class UsersModel extends Model
{

	protected $db;
	protected $request;

	public function __construct()
	{
		parent::__construct();
		$this->db = Database::connect();
		$this->request = \Config\Services::request();
	}

	public function getMenuAssignedToProfile(array $profiles)
	{
		$builder = $this->db->table('assign_profile_menu aum');

		$builder->distinct();
		$builder->select('mm.display_id, mm.parent_id, mm.child_name, mm.parent_name, mm.menu_link');
		$builder->join('mst_menu mm', 'aum.parent_id = mm.parent_id AND aum.display_id = mm.display_id');
		$builder->whereIn('aum.profile_id', $profiles);
		$builder->where('aum.status', '1');
		// $builder->orderBy('aum.display_id', 'ASC');

		$query = $builder->get();

		return $query->getResultArray();  // returns empty array if no result
	}


	public function getMenuListAssignedToProfile(array $profiles, string $parent_menu_id = '')
	{
		$builder = $this->db->table('assign_profile_menu aum');
		$builder->distinct();
		$builder->select('mm.*');
		$builder->join('mst_menu mm', 'aum.parent_id = mm.parent_id AND aum.menu_id = mm.id');
		$builder->whereIn('aum.profile_id', $profiles);
		$builder->where('aum.status', '1');

		if (!empty($parent_menu_id)) {
			$builder->where('aum.parent_id', $parent_menu_id);
		}

		$builder->orderBy('mm.display_id', 'ASC');

		$query = $builder->get();

		return $query->getResultArray(); // Will return an empty array if no rows found
	}

	public function getAllSidebarMenu(): array
	{
		$builder = $this->db->table('mst_menu');
		$builder->distinct();
		$builder->select('id, display_id, parent_name, child_name, menu_link, parent_id');
		$builder->where('parent_id !=', '0');
		$builder->where('status', '1');

		$query = $builder->get();

		return $query->getResultArray();
	}

	function getRoles()
	{
		$res = $this->db->query("CALL `SP_GetRoles`('All','')");
		$this->db->connID->next_result();
		return $res->getResultArray();
		$res->free_result();
	}


	function getcategory($id = '')
	{

		$builder = $this->db->table('tblcategory e1');
		$builder->select('e1.*,e2.catagory_name as parent');
		$builder->join('tblcategory e2', 'e2.id = e1.parent_id', 'LEFT OUTER');
		if ($this->request->getPost('tab_type') == 'Active') {
			$builder->where('e1.Active', '1');
		}
		if ($this->request->getPost('tab_type') == 'Inactive') {
			$builder->where('e1.Active', '2');
		}
		$builder->orderBy('e1.id');
		if ($id != '') {
			$builder->where('e1.id', $id);
		}
		$query = $builder->get();

		if ($query->getNumRows() >= 1) {
			return $query->getResultArray();
		} else {
			return false;
		}
	}


	function getteam($id = '')
	{

		$builder = $this->db->table('Teams e1');
		$builder->select('e1.*,e2.FirstName, e2.LastName');
		$builder->join('name e2', 'e2.ID = e1.empid', 'LEFT OUTER');
		$builder->orderBy('e1.id');
		if ($id != '') {
			$builder->where('e1.id', $id);
		}
		if ($this->request->getPost('tab_type') == 'Active') {
			$builder->where('Active', '1');
		}
		if ($this->request->getPost('tab_type') == 'Inactive') {
			$builder->where('Active', '2');
		}
		$query = $builder->get();

		if ($query->getNumRows() >= 1) {
			return $query->getResultArray();
		} else {
			return false;
		}
	}


	function getactiveteam($id = '')
	{

		$builder = $this->db->table('Teams e1');
		$builder->select('e1.*,e2.FirstName, e2.LastName');
		$builder->join('name e2', 'e2.ID = e1.empid', 'LEFT OUTER');
		$builder->where('e1.Active', '1');
		$builder->orderBy('e1.id');
		if ($id != '') {
			$builder->where('e1.id', $id);
		}
		$query = $builder->get();

		if ($query->getNumRows() >= 1) {
			return $query->getResultArray();
		} else {
			return false;
		}
	}


	function insertCategory($category)
	{
		$result = array();
		$builder = $this->db->table('tblcategory');
		$res = $builder->insert($category);
		if ($res) {
			$result['msg'] = "INSERTED";
			$result['last_id'] = $this->db->insertId();
		} else {
			$result['msg'] = "NOT INSERTED";
		}

		return $result;
	}


	function updateCategory($category)
	{

		$builder = $this->db->table('tblcategory');
		$result = array();
		$data = array();
		foreach ($category as $key => $val) {
			$data[$key] = test_input($val);
		}
		$builder->where('id', $data['id']);
		$query = $builder->update($data);

		if ($query) {
			$result['status'] = true;
			$result['msg'] = 'UPDATED';
		} else {
			$result['status'] = false;
			$result['msg'] = $this->db->error()['message'];
		}
		return $result;
	}

	function updateTeam($team)
	{

		$result = array();
		$data = array();
		foreach ($team as $key => $val) {
			$data[$key] = test_input($val);
		}

		$builder = $this->db->table('Teams');
		$builder->where('id', $data['id']);
		$query = $builder->update($data);

		if ($query) {
			$result['status'] = true;
			$result['msg'] = 'UPDATED';
		} else {
			$result['status'] = false;
			$result['msg'] = $this->db->error()['message'];
		}
		return $result;
	}

	function insertTeam($team)
	{
		$result = array();
		$builder = $this->db->table('Teams');
		$res = $builder->insert($team);
		if ($res) {
			$result['msg'] = "INSERTED";
			$result['last_id'] = $this->db->insertId();
		} else {
			$result['msg'] = "NOT INSERTED";
		}

		return $result;
	}


	function getStudentName($student_id){
		$builder = $this->db->table('name n');
		$builder->select('n.*');
		$builder->join('groups g','g.NameLink = n.ID', 'LEFT');
		$builder->where('n.ID',$student_id);
		//$this->db->or_where('n.Firstname',$student_id);
		//$this->db->or_where('n.Lastname',$student_id);
		$builder->where('g.FacultyStaff = 1');
		
		$query = $builder->get();
		//echo $this->db->last_query();die;
		if($query->getNumRows()>=1){
			return $query->getRowArray();
		}else{
			return array();
		}
		
	}

	function insertContract($contract){

		$result = array();
		$data = array();

		foreach ($contract as $key => $val) {
            $data[$key] = test_input($val);
		}	
		
		if($this->check_validate_contact_date($data)){
			
			$res=$this->db->table('tblcontract')->insert($data);
			if($res){
				$result['msg'] = "INSERTED";
				$result['last_id'] = $this->db->insertId();
			}else{
				$result['msg'] = "NOT INSERTED";
			}			
		
		}else{
			$result['status'] = false;
			$result['msg'] = "CONTRACT OVERLAP";
		}

		return $result;
	}


	function check_validate_contact_date($data)
	{

		$builder = $this->db->table('tblcontract');
		$builder->select('contract_begin_date, contract_end_date');
		$builder->where('empid', $data['empid']);
		if ($data['id'] != '') {
			$builder->where('id <> ' . $data['id']);
		}
		$builder->where('("' . $data['contract_begin_date'] . '" between contract_begin_date and contract_end_date OR "' . $data['contract_end_date'] . '" between contract_begin_date and contract_end_date)');
		$builder->where('deletestatus ', '0');
		$query = $builder->get();
		//secho $builder->last_query();die;
		if ($query->getNumRows() >= 1) {
			return false;
		} else {
			return true;
		}
	}


	// Get All Profiles for Admin
	function getProfiles()
	{
		$res = $this->db->query("CALL `SP_Profile`('All','','','','','','','','',@RES)");
		$this->db->connID->next_result();
		return $res->getResultArray();
		$res->free_result();
	}

	// Get All Modules for Admin
	function getModules()
	{
		$res = $this->db->query("CALL `SP_Modules`('All','','','','','','','','','','','','',@Pstatus)");
		$this->db->connID->next_result();
		return $res->getResultArray();
		$res->free_result();
	}

	// Get All Modules by parent ID
	function getModulelists($param)
	{
		$param['Module'] = test_input($param['Module']);
		//echo "CALL `SP_Modules`('ByParentId','','','','','','','','{$param['Module']}','','','','',@Pstatus)";
		$res = $this->db->query("CALL `SP_Modules`('ByParentId','','','','','','','','{$param['Module']}','','','','',@Pstatus)");
		$this->db->connID->next_result();
		//echo "<pre>";print_r($res->getResultArray());die;
		return $res->getResultArray();
		$res->free_result();
	}

	// Get All Modules by four parent ID
	function getModulebyfour($param)
	{
		$param['Module'] = test_input($param['Module']);
		//echo "CALL `SP_Modules`('ByParentId','','','','','','','','{$param['Module']}','','','','',@Pstatus)";
		$res = $this->db->query("CALL `SP_Modules`('ByFourParentId','','','','','','','','{$param['Module']}','','','','',@Pstatus)");
		$this->db->connID->next_result();
		//echo "<pre>";print_r($res->getResultArray());die;
		return $res->getResultArray();
		$res->free_result();
	}

	// Get All Accesses
	function getAccess()
	{
		$res = $this->db->query("CALL `SP_Access`()");
		$this->db->connID->next_result();
		return $res->getResultArray();
		$res->free_result();
	}

	// Insert User in Admin
	function insertUser($data)
	{
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
	function get_user_for_internal_query($data)
	{
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
	function getAdminRecord($USERID)
	{
		$USERID = test_input($USERID);
		$res = $this->db->query("CALL `SP_AdminUsers`('OneAdmin','{$USERID}','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',@status)");
		$this->db->connID->next_result();
		return $res->getResultArray();
		$res->free_result();
	}

	// Check Password Change
	function checkChangePassword($USERID)
	{
		$USERID = test_input($USERID);
		$res = $this->db->query("CALL `SP_AdminUsers`('OneAdmin','{$USERID}','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',@status)");
		$this->db->connID->next_result();
		return $res->getResultArray();
		$res->free_result();
	}

	// Update Password 
	function updatePassword($param)
	{
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
	function getUsers()
	{
		$res = $this->db->query("CALL `SP_AdminLogin`('All','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?', '?', @RES)");
		$this->db->connID->next_result();
		// echo "<pre>"; print_r($res->getResultArray());die();
		return $res->getResultArray();
		$res->freeResult();
	}


	function roleAccess()
	{
		$res = $this->db->query("select case when r1.rolename is null then r2.rolename else r1.rolename end as parentname, r1.rolename parentrolename, r1.roleid pid, r2.rolename mainrolename,r2.roleid from tblroles r1 right outer join tblroles r2 on r1.roleid=r2.parentroleid");
		$res = $res->getResultArray();
		//$this->db->connID->next_result();
		return $res;
		$res->free_result();
	}

	function getAdminLogs()
	{

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

	function getUsersLogs()
	{

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

	// check password details 

	function checkPasswordExist($admin_id, $old_password)
	{

		$builder = $this->db->table('admin_login');
		$builder->select('*');
		$builder->where('admin_id', $admin_id);
		$builder->where('password', $old_password);
		$query = $builder->get();
		$getNumRows = $query->getNumRows();
		return $getNumRows;
	}

	// update password

	public function change_profilepassword($admin_id, $password_array)
	{

		$response = array();
		$builder = $this->db->table('admin_login');
		$builder->where('admin_id', $admin_id);

		$query = $builder->update('admin_login', $password_array);

		if ($query) {
			$response['status'] = true;
			$response['msg'] = 'UPDATED';
		} else {
			$response['status'] = false;
			$response['msg'] = $this->db->error()['message'];
		}
		return $response;
	}


	function getUserDetails($admin_id)
	{
		$admin_id = test_input($admin_id);
		$res = $this->db->query("CALL `SP_AdminLogin`('OneById','{$admin_id}','','','','','','','','','','','','','','','','',@RES)");
		$this->db->connID->next_result();
		return $res->getResultArray();
		$res->free_result();
	}

	function get_city($city_id)
	{
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

	function updateUserdetails($data)
	{
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

	function updateResetPassword($data)
	{
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

	function insert_user_bank_details($param)
	{
		/*
			#Model for Insert and update user bank details. Calling from User controller.
		*/
		$data = array();
		foreach ($param as $key => $val) {
			$data[$key] = test_input($val);
		}

		$sql = "CALL SP_insert_update_user_bank('{$data['query_type']}','{$data['user_id']}','{$data['account_holder_name']}','{$data['bank_name']}','{$data['branch_name']}','{$data['branch_location']}','{$data['is_computerized']}','{$data['is_rtgs']}','{$data['ifsc']}','{$data['is_neft']}','{$data['account_type']}','{$data['account_number']}','{$data['micr_code']}','{$data['created_ip']}','{$data['created_date']}','{$data['modified_by']}','{$data['modified_date']}','{$data['save_status']}','{$data['ub_id']}',@RES)";

		$res = $this->db->query($sql);
		$this->db->connID->next_result();
		$array = $res->getResultArray();
		$res->freeResult();
		return $array;
	}

	function get_bank_by_uid($id)
	{

		$builder = $this->db->table('tbl_user_bank_detail as ub');
		$builder->select('*');
		$builder->join('mst_bank as b', 'b.bank_id = ub.bank_name', 'INNER');
		$builder->where('user_id', $id);
		$query = $builder->get();
		if ($query->getNumRows() >= 1) {
			return $query->getResultArray();
		} else {
			return false;
		}
		$res->free_result();
	}

	function inert_scheme_level($data)
	{
		// Please don not add test input to this function already implimented on controller		
		$query = $this->db->query("SELECT * FROM mst_scheme_process_level
                           WHERE scheme_id = " . $data['scheme_id'] . " AND component_id=" . $data['component_id'] . " limit 1");

		if ($query->getNumRows() == 0) {
			$builder = $this->db->table('mst_scheme_process_level');
			$res = $builder->insert($data);
			if ($res) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	function update_scheme_level($data, $id)
	{
		// Please don not add test input to this function already implimented on controller		
		$builder = $this->db->table('mst_scheme_process_level');
		$builder->where('id', $id);
		$res = $builder->update('mst_scheme_process_level', $data);
		if ($res) {
			return true;
		} else {
			return false;
		}
	}

	function insert_profile_details($data)
	{
		// Please don not add test input to this function already implimented on controller		
		$query = $this->db->query("SELECT * FROM tbl_profile_details
                           WHERE profile_name = '" . $data['profile_name'] . "' limit 1");

		if ($query->getNumRows() == 0) {
			$builder = $this->db->table('tbl_profile_details');
			$res = $builder->insert($data);
			if ($res) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	function update_profile_details($data, $id)
	{

		$builder = $this->db->table('tbl_profile_details');
		$builder->where('profile_id', $id);
		$res = $builder->update($data);
		if ($res) {
			return true;
		} else {
			return false;
		}
	}

	public function get_all_profile($profile_id = 'A')
	{
		$builder = $this->db->table('tbl_profile_details');
		$builder->select('*');

		if ($profile_id !== 'A') {
			$builder->where('profile_id', $profile_id);
		}

		$query = $builder->get();

		if ($query->getNumRows() > 0) {
			return $query->getResultArray();
		} else {
			return [];
		}
	}

	function insert_user_details($data)
	{
		// Please don not add test input to this function already implimented on controller		
		$query = $this->db->query("SELECT * FROM admin_login
                           WHERE admin_email = '" . $data['admin_email'] . "' limit 1");

		if ($query->getNumRows() == 0) {
			$builder = $this->db->table('admin_login');
			$res = $builder->insert($data);
			if ($res) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function update_user_details($data, $id)
	{
		// Please don not add test input to this function already implimented on controller
		$builder = $this->db->table('admin_login');
		$query = $this->db->query("SELECT * FROM admin_login
                           WHERE admin_email = '" . $data['admin_email'] . "' AND admin_id = " . $id);
		$query2 = $this->db->query("SELECT * FROM admin_login
                           WHERE admin_email = '" . $data['admin_email'] . "'");

		//echo $query->getNumRows();
		if ($query->getNumRows() == 1) {

			$builder->where('admin_id', $id);
			$res = $builder->update($data);
			//echo $builder->last_query();die;
			if ($res) {
				return true;
			} else {
				return false;
			}
		} elseif ($query2->getNumRows() == 0) {
			$builder->where('admin_id', $id);
			$res = $builder->update($data);
			if ($res) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}


	public function insertAssignCategory()
	{
		$emp_id = $this->request->getPost('emp_id');
		$cat_id = $this->request->getPost('cat_id');


		$res = '';
		for ($i = 0; $i < sizeof($cat_id); $i++) {
			$data = array(
				'empid'          => $emp_id,
				'taskcategoryid' => $cat_id[$i],
				'createddate'    => date('Y-m-d h:m:s'),
				'status'         => '1'
			);
			$builder = $this->db->table('tbl_user_task_category');
			$res = $builder->insert($data);
		}

		if ($res) {
			$result['msg'] = "INSERTED";
			$result['last_id'] = $this->db->insertId();
		} else {
			$result['msg'] = "NOT INSERTED";
		}
	}

	public function insertAssignForm()
	{
		$emp_id = $this->request->getPost('component_id');
		$cat_id = $this->request->getPost('cat_id');
		$ip = $_SERVER['SERVER_ADDR'] ?? gethostbyname(gethostname());

		$res = '';

		$dat1 = array('status' => 0);
		$builder = $this->db->table('assign_user_form');
		$builder->where('component_id', $emp_id);
		$builder->update($dat1);

		for ($i = 0; $i < sizeof($cat_id); $i++) {
			$check_data = $builder->select('*')->where(['component_id' => $emp_id, 'user_id' => $cat_id[$i]])->get()->getRowArray();
			if (!empty($check_data)) {
				if ($check_data['status'] == 0) {
					$data = array(
						'component_id'      => $emp_id,
						'user_id' => $cat_id[$i],
						'created_at'   => date('Y-m-d h:m:s'),
						'server_ip'    => $ip,
						'status'       => '1'
					);
					$builder->where(['component_id' => $emp_id, 'user_id' => $cat_id[$i]]);
					$builder->update($data);
				}
			} else {
				$data = array(
					'component_id'      => $emp_id,
					'user_id' => $cat_id[$i],
					'created_at'   => date('Y-m-d h:m:s'),
					'server_ip'    => $ip,
					'status'       => '1'
				);
				$res = $builder->insert($data);
			}
		}

		if ($res) {
			$result['msg'] = "INSERTED";
			$result['last_id'] = $this->db->insertId();
		} else {
			$result['msg'] = "NOT INSERTED";
		}
	}

	public function getForms_by_user($user_id, $form_id)
	{
		$builder = $this->db->table('assign_user_form');
		return $builder->select('*')
			->where(['user_id' => $user_id, 'component_id' => $form_id, 'status' => '1'])
			->get()
			->getResultArray();
	}


	public function getFormsapproval_by_user($user_id, $form_id)
	{
		$builder = $this->db->table('assign_user_form');
		return $builder->select('*')
			->where(['user_id' => $user_id, 'component_id' => $form_id, 'approval_status' => '1'])
			->get()
			->getResultArray();
	}

	public function insertAssignForm_by_role($user_id, $form_id)
	{

		$ip = $_SERVER['REMOTE_ADDR'];
		$res = '';
		$dat1 = array('status' => 0);
		$builder = $this->db->table('assign_user_form');
		$builder->where('user_id', $user_id);
		$builder->update($dat1);
		foreach ($form_id as $frm) {
			$query = $builder->select('*')
				->where(['component_id' => $frm, 'user_id' => $user_id])
				->get()
				->getResultArray();
			if ($query) {
				$data = array(
					'status' => 1,
					'server_ip' => $ip
				);
				$builder->where(['component_id' => $frm, 'user_id' => $user_id]);
				$builder->update($data);
			} else {
				$data = array(
					'component_id' => $frm,
					'user_id' => $user_id,
					'status' => 1,
					'server_ip' => $ip
				);

				$builder->insert($data);
			}
		}
		return true;
	}


	public function insertApprovalAssignForm_by_role($user_id, $form_id)
	{

		$ip = $_SERVER['REMOTE_ADDR'];
		$res = '';
		$dat1 = array('approval_status' => 0);
		$builder = $this->db->table('assign_user_form');
		$builder->where('user_id', $user_id);
		$builder->update($dat1);
		foreach ($form_id as $frm) {
			$query = $builder->select('*')
				->where(['component_id' => $frm, 'user_id' => $user_id])
				->get()
				->getResultArray();
			if ($query) {
				$data = array(
					'approval_status' => 1,
					'server_ip' => $ip
				);
				$builder->where(['component_id' => $frm, 'user_id' => $user_id]);
				$builder->update($data);
			} else {
				$data = array(
					'component_id' => $frm,
					'user_id' => $user_id,
					'approval_status' => 1,
					'server_ip' => $ip
				);

				$builder->insert($data);
			}
		}
		return true;
	}


	public function getUsers_for_form($id)
	{
		$builder = $this->db->table('assign_user_form e1');
		$builder->select('a.admin_id,admin_fullname,admin_email,e1.id as rid')
			->join('admin_login as a', 'a.admin_id = e1.user_id AND e1.status = 1 AND e1.component_id=' . $id, 'right')
			->where('(e1.id ="" OR e1.id IS NULL)');
		if ($this->request->getPost('search') != '') {
			$builder->like('admin_fullname', $this->request->getPost('search'));
			$builder->orLike('admin_email', $this->request->getPost('search'));
		}

		$query = $builder->orderBy('admin_fullname', 'ASC');
		return $query->get()->getResultArray();
	}

	public function alreadyAssignuserinForm($id)
	{
		$builder = $this->db->table('assign_user_form e1');
		$builder->select('a.admin_id,admin_fullname,admin_email,e1.id as rid')
			->join('admin_login as a', 'a.admin_id = e1.user_id')
			->where('e1.status', 1)
			->where('e1.component_id', $id);
		if ($this->request->getPost('search') != '') {
			$builder->like('admin_fullname', $this->request->getPost('search'));
		}
		$query = $builder->orderBy('admin_fullname', 'ASC');
		return $query->get()->getResultArray();
	}

	public function allgetcategorybyuser($empid)
	{
		return $this->db->table('tblcategory e1')->select('e1.*,uc.id as rid')
		                ->join('tbl_user_task_category as uc','uc.taskcategoryid = e1.id AND uc.status = 1 AND uc.empid ='.$empid,'left')
		                ->where('e1.Active',1)
		                ->where('e1.id NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE)
		                ->orderBy('e1.catagory_name')
		                ->get()
		                ->getResult();
	}


	public function add_remove_categoy()
	{
		$emp_id = $this->request->getPost('remove_emp_id');
        $cat_id = $this->request->getPost('cat_id');
        $data1= array('status'=>'0');
		$builder = $this->db->table('tbl_user_task_category');
        $builder->where('empid',$emp_id);
        $builder->update($data1);

         for($i=0;$i<sizeof($cat_id);$i++)
	     {
	     	

	     	$check = $builder->select('*')
	     					  ->from('tbl_user_task_category')
	     					  ->where(['empid'=>$emp_id,'taskcategoryid'=>$cat_id[$i]])
	     					  ->get()
	     					  ->getRow();

	     	
	     	if(!empty($check))
	     	{
	     		$data2= array('status'=>1);
	     		$builder->where('id',$check->id);
	     		$builder->update('tbl_user_task_category',$data2);

	     	}
	     	else
	     	{
	     		$data = array(
	     		'empid'          => $emp_id,
	     		'taskcategoryid' => $cat_id[$i],
	     		'createddate'    => date('Y-m-d h:m:s'),
	     		'status'         =>'1'
	     	);
	     		$res = $builder->insert($data);
	     	}

	     	
	     }

    }


	public function getcategorybyuser($empid)
	{
		return $this->db->table('tblcategory e1')->select('e1.*,uc.id as rid')
		                ->join('tbl_user_task_category as uc','uc.taskcategoryid = e1.id')
		                ->where('uc.empid',$empid)
		                ->where('uc.status','1')
		                ->where('e1.Active',1)
		                ->where('e1.id NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE)
		                ->orderBy('e1.catagory_name')
		                ->get()
		                ->getResult();
	}

	public function removeAssignCategory()
	{
		$cat_id = $this->request->getPost('remove_id');
         $res = '';
         for($i=0;$i<sizeof($cat_id);$i++)
         {
         	$data = array(
         		'status'         =>'0'
         	);
         	
         	$res = $this->db->table('tbl_user_task_category')->where('id',$cat_id[$i])->update($data);
         }
	}


	public function getAllSubmenu($parent_id)
	{

		$builder = $this->db->table('mst_menu');
		$builder->orderBy('display_id', 'ASC');
		$builder->where('parent_id', $parent_id);
		$builder->where('status', '1');
		$query = $builder->get();
		if ($query->getNumRows() > 1) {
			return $query->getResultArray();
		} else {
			return array();
		}
	}

	public function getReportMenu_by_profile($profile_id, $display_id, $parent_id)
	{

		$builder = $this->db->table('assign_profile_menu');
		$builder->where('display_id', $display_id);
		$builder->where('profile_id', $profile_id);
		$builder->where('parent_id', $parent_id);
		$builder->where('status', '1');
		$query = $builder->get();
		if ($query->getNumRows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function checkIfReportForRegistrar($profile_id, $parent_id)
	{
		$builder = $this->db->table('assign_profile_menu');
		$builder->where('profile_id', $profile_id);
		$builder->where('parent_id', $parent_id);
		$builder->where('status', '1');
		$query = $builder->get();
		if ($query->getNumRows() >= 1) {


			return true;
		} else {
			return false;
		}
	}
	public function insertReportForProfile($profile_id, $report_menu)
	{
		$builder = $this->db->table('assign_profile_menu');
		if (!empty($report_menu)) {
			$builder->where('profile_id', $profile_id);
			$builder->where('parent_id', '7');
			$builder->update(['status' => '0']);
			$data = [];
			foreach ($report_menu as $rm) {
				$builder->where('display_id', $rm);
				$builder->where('profile_id', $profile_id);
				$builder->where('parent_id', '7');
				$query = $builder->get('assign_profile_menu');
				if ($query->getNumRows() == 1) {

					$builder->where('display_id', $rm);
					$builder->where('profile_id', $profile_id);
					$builder->where('parent_id', '7');
					$builder->update(['status' => '1']);
				} else {

					$data = [
						'profile_id' => $profile_id,
						'display_id' => $rm,
						'parent_id' => '7',
						'status' => '1',
						'created_by' => $this->session->get('USER_ID'),
						'ip' => $_SERVER['REMOTE_ADDR'],
					];
					$builder->insert($data);
				}
			}
		} else {
			$builder->where('profile_id', $profile_id);
			$builder->where('parent_id', '7');
			$builder->update(['status' => '0']);
		}
	}


	function supervisior_wise_getteam($id = '')
	{

		$builder = $this->db->table('Teams e1');
		$builder->select('e1.*,e2.FirstName, e2.LastName');
		$builder->join('name e2', 'e2.ID = e1.empid', 'LEFT OUTER');
		$builder->where('e1.empid', $_SESSION['NAME_ID']);
		$builder->orderBy('e1.id');
		if ($id != '') {
			$builder->where('e1.id', $id);
		}
		$query = $builder->get();
		if ($query->getNumRows() >= 1) {
			return $query->getResultArray();
		} else {
			return false;
		}
	}

	function superwiser_wise_Get_faculty_staff($team_member = '')
	{
		if (!empty($team_member)) {
			$builder = $this->db->table('name');
			return $builder->select('*')
				->whereIn('ID', $team_member)
				->get()
				->getResultArray();
		} else {
			return array();
		}
	}

	public function user_wise_category($empid)
	{
		$builder = $this->db->table('tblcategory e1');
		return $builder->select('e1.*,uc.id as rid')
			->join('tbl_user_task_category as uc', 'uc.taskcategoryid = e1.id AND uc.status = 1 AND uc.empid =' . $empid, 'inner')
			->where('e1.Active', 1)
			->where('e1.id NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE)
			->orderBy('e1.catagory_name')
			->get()
			->getResult();
	}

	//---------------------------------------

	public function get_user_id($email)
	{
		$builder = $this->db->table('email');
		return $builder->select('*')
			->where('Email', $email)
			->get()
			->getRowArray();
	}

	public function check_any_email_by_id($emp_id)
	{
		$builder = $this->db->table('email');
		return $builder->select('*')
			->where('EmailID', $emp_id)
			->where('Active', '1')
			->get()
			->getResultArray();
	}

	public function check_future_email_by_id($emp_id)
	{
		$builder = $this->db->table('email');
		return $builder->select('*')
			->where('EmailID', $emp_id)
			->where("Email LIKE '%future.edu%'")
			->where('Active', '1')
			->get()
			->getResultArray();
	}


	function update_group_emp($last_id)
	{
		$builder = $this->db->table('groups');
		$data = $builder->select('*')
			->where('NameLink', $this->request->getPost('empid'))
			->get()
			->getResultArray();

		if (!empty($data)) {
			if ($data[0]['FacultyStaff'] != 1 || $data[0]['CurrentEmployee'] != 1) {
				$group['FacultyStaff'] = 1;
				$group['CurrentEmployee'] = 1;
				$builder->where('NameLink', $this->request->getPost('empid'));
				$builder->update($group);

				$data1['table_name'] = 'tblcontract';
				$data1['table_field_id'] = $last_id;
				$data1['updated_group_field'] = $data[0]['Group_RowID'];
				$data1['updated_field_name'] = 'FacultyStaff';
				$data1['ip'] = $_SERVER['REMOTE_ADDR'];
				$data1['created_by'] = session()->get('USER_ID');
				$data1['name_id'] = $this->request->getPost('empid');
				$this->db->table('group_thread')->insert($data1);
			}
		} else {
			$group['FacultyStaff'] = 1;
			$group['CurrentEmployee'] = 1;
			$group['NameLink'] = $this->request->getPost('empid');
			$this->db->table('groups')->insert($group);

			$insertId = $this->db->insertId();
			$data1['table_name'] = 'tblcontract';
			$data1['table_field_id'] = $last_id;
			$data1['updated_group_field'] = $insertId;
			$data1['updated_field_name'] = 'FacultyStaff';
			$data1['ip'] = $_SERVER['REMOTE_ADDR'];
			$data1['created_by'] = session()->get('USER_ID');
			$data1['name_id'] = $this->request->getPost('empid');
			$this->db->table('group_thread')->insert($data1);
		}
	}


	function getContractAttendence($id)
	{

		$builder = $this->db->table('tbl_contract_transaction');
		$data = $builder->select('*')
			->where('contract_id', $id)
			->get()
			->getResultArray();

		if (!empty($data)) {
			$con_data = $this->db->table('tblcontract')->select('daily_rate')
				->where('id', $id)
				->get()
				->getResultArray();

			if (!empty($con_data)) {
				$daily_rate = $this->request->getPost('daily_rate');
				if ($daily_rate == $con_data[0]['daily_rate']) {
					return false;
				} else {
					return true;
				}
			}
		} else {
			return false;
		}
	}

	function updateContractLog($id = '')
	{
		if ($id != '') {
			$builder = $this->db->table('tblcontract');
			$data = $builder->Select('*')
				->where('id', $id)
				->get()
				->getResultArray();

			if (!empty($data)) {
				$record = array(
					'contract_id' => $data[0]['id'],
					'empid'       => $data[0]['empid'],
					'contract_begin_date' => $data[0]['contract_begin_date'],
					'contract_end_date'   => $data[0]['contract_end_date'],
					'hours_to_work' => $data[0]['hours_to_work'],
					'CarriedOverHours' => $data[0]['CarriedOverHours'],
					'education'   => $data[0]['education'],
					'daily_rate'  => $data[0]['daily_rate'],
					'createdby'   => $data[0]['createdby'],
					'createddate' => $data[0]['createddate'],
					'modifiedby'  => $data[0]['modifiedby'],
					'modifieddate' => $data[0]['modifieddate'],
					'deletestatus' => $data[0]['deletestatus'],
					'teamid'       => $data[0]['teamid'],
					'contract_1099'  => $data[0]['contract_1099'],
					'log_created_date' => date('Y-m-d h:i:s'),
					'log_created_by'   => $_SESSION['USER_ID']
				);

				$this->db->table('tblcontract_log')->insert($record);
			}
		}
	}

	function ajaxGetUsers()
	{
		$sql = "SELECT  al.*,r.role as role_name FROM admin_login AS al INNER JOIN mst_roles AS r ON al.role = r.roleid";
		if ($this->request->getPost('status') != '') {
			$sql .= " WHERE account_status = '" . $this->request->getPost('status') . "'";
		}
		$res1 = $this->db->query($sql);
		return $res1->getResultArray();
	}


	public function insertMenuForProfile($profile_id, $menu_array, $parent_id)
	{
		$builder = $this->db->table('assign_profile_menu');
		if (!empty($menu_array)) {
			// First delete the previous assigned menu to user.
			$builder->where('profile_id', $profile_id);
			$builder->where('parent_id', $parent_id);
			$builder->update(['status' => '0', 'add_button' => '0', 'edit_button' => '0', 'print_button' => '0', 'excel_button' => '0']);
			$data = [];
			foreach ($menu_array as $rm) {

				$add = $edit = $print = $excel = '0';
				$subb = $this->request->getPost('sub_time_edit');
				if (isset($subb)) {
					$subb_menu = $this->request->getPost('sub_time_edit');
					if (isset($subb_menu[$rm])) {
						if (in_array("0", $subb_menu[$rm])) {
							$add = '1';
						}
						if (in_array("1", $subb_menu[$rm])) {
							$edit = '1';
						}
						if (in_array("2", $subb_menu[$rm])) {
							$excel = '1';
						}
						if (in_array("3", $subb_menu[$rm])) {
							$print = '1';
						}
					}
				}
				$builder->where('menu_id', $rm);
				$builder->where('profile_id', $profile_id);
				$builder->where('parent_id', $parent_id);
				$query = $builder->get('assign_profile_menu');
				if ($query->getNumRows() == 1) {
					// Means update
					$builder->where('menu_id', $rm);
					$builder->where('profile_id', $profile_id);
					$builder->where('parent_id', $parent_id);
					$builder->update(['status' => '1', 'add_button' => $add, 'edit_button' => $edit, 'print_button' => $print, 'excel_button' => $excel]);
				} else {
					// insert the new forms
					$data = [
						'profile_id' => $profile_id,
						'display_id' => '0',
						'parent_id' => $parent_id,
						'status' => '1',
						'add_button' => $add,
						'edit_button' => $edit,
						'print_button' => $print,
						'excel_button' => $excel,
						'menu_id' => $rm,
						'created_by' => session()->get('USER_ID'),
						'ip' => $_SERVER['REMOTE_ADDR'],
					];
					$builder->insert($data);
				}
			}
		} else {
			$builder->where('profile_id', $profile_id);
			$builder->where('parent_id', $parent_id);
			$builder->update(['status' => '0']);
		}
	}

	public function getMenu_by_profile($profile_id, $menu_id, $parent_id)
	{

		$builder = $this->db->table('assign_profile_menu');
		$builder->where('menu_id', $menu_id);
		$builder->where('profile_id', $profile_id);
		$builder->where('parent_id', $parent_id);
		$builder->where('status', '1');
		$query = $builder->get('assign_profile_menu');
		if ($query->getNumRows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function get_access_by_profile_id($profile_id, $menu_id, $parent_id) {

		$builder = $this->db->table('assign_profile_menu');
        $builder->where('menu_id', $menu_id);
        $builder->where('profile_id', $profile_id);
        $builder->where('parent_id', $parent_id);
        $builder->where('status', '1');
        $query = $builder->get();
        if($query->getNumRows() == 1) {
           return $query->getResultArray();
        } else {
            return array();
        }
	}

	public function check_user_active_or_not($emp_id)
	{
		// get all active email by emp id
		$data = $this->db->table('email')->select('*')
			->where('EmailID', $emp_id)
			->get()
			->getResultArray();

		$data = array_column($data, 'Email');

		if (!empty($data)) {
			return $this->db->table('admin_login')->select('*')
				->whereIn('admin_email', $data)
				->get()
				->getResultArray();
		} else {
			return array();
		}
	}

	public function get_assign_category($empid)
	{
		return $this->db->table('tblcategory e1')->select('e1.*,uc.id as rid')
			->join('tbl_user_task_category as uc', 'uc.taskcategoryid = e1.id AND uc.status = 1 AND uc.empid =' . $empid)
			->where('e1.Active', 1)
			->where('e1.id NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE)
			->orderBy('e1.catagory_name')
			->get()
			->getResult();
	}

	function updateContract($contract) {
		
        $result = array();
		$data=array();
        foreach ($contract as $key => $val) {
            $data[$key] = test_input($val);
		}		

		//$this->db->set('hours_to_work', $data['hours_to_work'], FALSE);
		if($this->check_validate_contact_date($data)){
			$builder = $this->db->table('tblcontract');
    		$builder->where('id', $data['id']);
    		$query = $builder->update($data);
    		if ($query) {
    			$result['status'] = true;
    			$result['msg'] = 'UPDATED';
    		} else {
    			$result['status'] = false;
    			$result['msg'] = $this->db->error()['message'];
    		}			
		}else{
		    $result['status'] = false;
		    $result['msg'] = 'CONTRACT OVERLAP';
		}
        return $result;
	}

	function getcontract($id=''){
		$student_id = session()->get('USER_ID');
		$builder = $this->db->table('tblcontract A');
		$builder->select('c.team_Name,B.FirstName,B.LastName,B.title,A.*, (select ct.contract_id from tbl_contract_transaction ct where ct.contract_id = A.id Limit 1) as transaction_started,IFNULL((select sum(FLOOR(ct.hours)) as hours_worked from tbl_contract_transaction as ct where ct.contract_id = A.id), 0) as hours_worked, IFNULL((select SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) AS TimeInHoursMinutes from tbl_contract_transaction as ct where ct.contract_id = A.id), 0) as minutes_worked');
		$builder->join('name B','B.ID=A.empid','INNER');
		$builder->join('Teams c','A.teamid =c.id','LEFT');
		//$this->db->join('tbl_contract_transaction C','C.contract_id=A.id','LEFT');
		
		$builder->where('deletestatus!=',1);
		if($id !=''){
			$builder->where('A.id',$id);			
		}
		
		if($this->request->getPost('tab_type') == 'Active')
		{
		    $builder->where('A.contract_end_date >=',date('Y-m-d'));
		}
		if($this->request->getPost('tab_type') == 'Inactive')
		{
		    $builder->where('A.contract_end_date <=',date('Y-m-d'));
		}
		if($this->request->getPost('facultyEmployeeID') != ''){
      $builder->where('A.empid',$this->request->getPost('facultyEmployeeID'));  
    }


		//$this->db->where('A.deletestatus is null');
		$builder->orderBy('A.empid');
		$query = $builder->get();
		if($query->getNumRows() >= 1){
			return $query->getResultArray();
		}
		else{ 
			return false;
		}
		
		
	}

	function link_previous_contract(){
        $contract_id = encryptor('decrypt', $this->request->getPost('link_contract_id'));
        $emp_id =  encryptor('decrypt',$this->request->getPost('link_emp_id'));
		$builder = $this->db->table('tblcontract');
        $query = $builder->select('*')
                          ->where(['empid'=>$emp_id,'id !='=>$contract_id,'deletestatus !=' => '1'])
                          ->orderBy('contract_end_date','DESC')
                          ->get();
       $num_of_row = $query->getNumRows();
       if($num_of_row > 0){
          $contract_record = $query->getRowArray();
          $data['parent_contract_id'] = $contract_record['id'];
          $builder->where('id',$contract_id);
          $builder->update($data);
         
          return true;
       }
       else{
           return false;
       }
    }
	
    function unlink_previous_contract(){
        $contract_id = encryptor('decrypt', $this->request->getPost('link_contract_id'));
        $emp_id =  encryptor('decrypt',$this->request->getPost('link_emp_id'));
        $data['parent_contract_id'] = '0';
        return $this->db->table('tblcontract')->where(['id'=>$contract_id,'empid'=>$emp_id])
                        ->update($data);
    }

	function getcontract2($id=''){
		$student_id = session()->get('USER_ID');

		$builder = $this->db->table('tblcontract A');
		$builder->distinct('A.empid');
		$builder->select('A.empid, B.FirstName,B.LastName,B.title');
		$builder->join('name B','B.ID=A.empid','INNER');
		$builder->orderBy('B.LastName','ASC');
		//$this->db->join('Teams c','A.teamid =c.id','LEFT');
		//$this->db->join('tbl_contract_transaction C','C.contract_id=A.id','LEFT');
		
		if($this->request->getPost('facultyEmployeeID') != ''){
		    $builder->where('A.empid',$this->request->getPost('facultyEmployeeID'));
		}
		$builder->where('deletestatus!=',1);
		if($id !=''){
			$builder->where('A.id',$id);			
		}
		//$this->db->where('A.deletestatus is null');
		$builder->orderBy('A.empid');
		$query = $builder->get();
		if($query->getNumRows() >= 1){
			return $query->getResultArray();
		}
		else{ 
			return false;
		}
		
		
	}

}
