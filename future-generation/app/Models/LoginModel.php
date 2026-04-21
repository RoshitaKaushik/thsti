<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    function currentlogindetails($param)
	{
		$data = array();
		foreach($param as $key => $val){			
			$data[$key] = test_input($val);						
		}
		
		 $sql = "CALL SP_Login('{$data['PType']}','{$data['email']}','{$data['PASSWORD']}','{$data['PASSWORD_TYPE']}','{$data['LOGIN_STATUS']}','{$data['FAILED_ATTEMPTS']}','{$data['ACCOUNT_STATUS']}','{$data['LAST_LOGIN_TIME']}','{$data['REQUEST_IP']}','{$data['SESSION_ID']}','{$data['SESSION_EXPIRATION_TIME']}','{$data['LOGOUT_TIME']}','{$data['F_IP']}','{$data['F_LASTLOGIN']}','{$data['F_MACADDRESS']}','{$data['PASSWORD_CHANGED_IP']}',@abc)";
		 $res = $this->db->query($sql, $data);
		  $this->db->connID->next_result();
		 return $array = $res->getResultArray();
		  $res->free_result();
		
		
		
		
	}

	function getRegisteredPwdByRegID($email,$pwd_post)
	{
		/*  echo '<pre>';print_r($data);die();  */
		$email = test_input($email);		
		 $sql = "CALL SP_Login('3','{$email}','','','','','','','','','','','','','','',@abc)";
		 $res = $this->db->query($sql);
		  $this->db->connID->next_result();
		  $array = $res->getResultArray();
		  $res->freeResult();
		  
		 //  echo '<pre>';print_r($array);die(); 
		$res = array();
		if(isset($array[0]['@abc'])){
			if($array[0]['@abc'] == 'pending')
			{
				$res['status'] = false;
				$res['message'] = 'Your account is not yet approved.';
			}else{
				$res['status'] = false;
				$res['message'] = 'Something went wrong.';
			}
		}else{
			$salt = get_salt_token();
			$pwdMD5 = $array[0]['password'];
			$salted_pwdMD5 = MD5($pwdMD5.$salt);
			//echo "db: $salted_pwdMD5  <br>posted: $pwd_post"; die();
			if($pwd_post == $salted_pwdMD5){
				$res['status'] = true;
				$res['org_pwd'] = $array[0]['password'];
			}else{
				$res['status'] = false;
				$res['message'] = 'The Email or Password is Incorrect.';
			}
			
		}
		//echo '<pre>';print_r($res);die();
		return $res;
		
		
	}	
	
	function get_states(){

        $builder = $this->db->table('country_states');
		$builder->select('state_name');
		$query = $builder->get();
		if($query -> getNumRows() >= 1){
			return $query->getResultArray();
		  
			//print_r($query->getResultArray());die;
		}
		else{ 
			return false;
		}

	}
	
	function logintimeset($param)
	{
		$data = array();
		foreach($param as $key => $val){			
			$data[$key] = test_input($val);						
		}
		$sql = "CALL SP_Login(?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?,@abc)";
		$res = $this->db->query($sql, $data);
		$this->db->connID->next_result();
		return $array = $res->getResultArray();
		$res->free_result();
	}
	
	function check_user_by_userid($param)
	{
		$data = array();
		foreach($param as $key => $val){			
			$data[$key] = test_input($val);						
		}
		$sql = "CALL stp_checkActiveUserUniqueEmailId(?)";
		$res = $this->db->query($sql, $data);
		$this->db->connID->next_result();
		return $array = $res->getResultArray();
		$res->free_result();
	}
	
	function insert_login_user_log($param){
		$value = array();
		foreach($param as $key => $val){			
			$value[$key] = test_input($val);						
		}
		
        $builder = $this->db->table('user_login_log');
		$userid = $value['PUSERID'];
		$builder->select('LOGIN_DATE_TIME, USER_IP');
		$builder->where('USERID', $userid);
		$builder->where('LOGIN_STATUS', "Success");
		$builder->orderBy('LOGIN_DATE_TIME','DESC');
		$builder->limit(1);
		$q = $builder->get('user_login_log');
		$res = $q->getResultArray();
		$_SESSION['last_login'] = $res;
		
		$sql = "CALL `SP_User_log_insert_update`('{$value['PQUERY_TYPE']}','','{$value['PUSERID']}','{$value['PUSER_IP']}','{$value['PUSER_BROWSER']}','','{$value['PLOGIN_STATUS']}','','',@res)";
		$res = $this->db->query($sql);
		$result = $res->getResultArray();
		$_SESSION['login_date_time']  = $result[0]['RES'];
		$this->db->connID->next_result();		
		return true;
		$res->free_result();
	}
	
	function update_logout_user_log($param){
		$value = array();
		foreach($param as $key => $val){			
			$value[$key] = test_input($val);						
		}
		
		$sql = "CALL `SP_User_log_insert_update`('{$value['PQUERY_TYPE']}','','{$value['PUSERID']}','','','{$value['PLOGIN_DATE_TIME']}','','','',@res)";
		$res = $this->db->query($sql);
		$result = $res->getResultArray();
		$this->db->connID->next_result();		
		return true;
		$res->free_result();
	}
	
	function request_forget_password($param){
		
		$data = array();
		foreach($param as $key => $val){			
			$data[$key] = test_input($val);						
		}
		$sql = "CALL `SP_Request_Forget_Password`('{$data['QUERY_TYPE']}','{$data['USER_ID']}','{$data['REQUEST_ID']}','{$data['TOKEN']}','{$data['EXPIRY_TIME']}','{$data['REQUEST_IP']},'{$data['REQUEST_DATE']},@RES)";
		$res = $this->db->query($sql);
		$result = $res->getResultArray();
		$this->db->connID->next_result();		
		return $result;
		$res->free_result();
		
	}
	
	function changepassword($param)
	{
		//echo '<pre>';print_r($data);die;
		$data = array();
		foreach($param as $key => $val){			
			$data[$key] = test_input($val);						
		}
		
		$sql = "CALL SP_ChangePassword('{$data['TYPE']}','{$data['USERID']}','{$data['PASSWORD']}','{$data['NEW_PASSWORD']}','{$data['PASSWORD_CHANGED_IP']}','{$data['PASSWORD_CHANGED']}',@abc)";
		 $res = $this->db->query($sql, $data);
		 return $array = $res->getResultArray();
	} 
}
