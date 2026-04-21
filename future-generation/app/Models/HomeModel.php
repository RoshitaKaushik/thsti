<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class HomeModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
    }

    public function login($param)
    {
        $data = array_map('test_input', $param);

        $sql = "CALL SP_AdminLogin(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @RES)";
        $query = $this->db->query($sql, [
            $data['pquery_type'],
            $data['padmin_id'],
            $data['admin_fullname'],
            $data['ppassword'],
            $data['padmin_mobile'],
            $data['padmin_email'],
            $data['pfailed_attempts'],
            $data['paccount_status'],
            $data['plast_login_time'],
            $data['psession_id'],
            $data['psession_expiration_time'],
            $data['plogout_time'],
            $data['pf_ip'],
            $data['pf_lastlogin'],
            $data['pf_macaddress'],
            $data['pcreated_by'],
            $data['pcreated_ip'],
            $data['pcreated_date']
        ]);

        // echo "<pre>";print_r("CALL SP_AdminLogin(1, '', '', '5828ecc3b9108093503430cfd20d4cc8', '', 'ithelpdesk@future.edu', '', '', '', '8c15fc676aac8dafd76e8f108aad04a6', '', '', '::1', '', '', '', '::1', '2025-06-27 06:20:02', @RES)");die;

        echo "<pre>";print_r($data);die;

        return $query->getResultArray();
    }

    public function gmailLogin($data)
    {
        $sql = "SELECT email.EmailID AS admin_id, admin_login.admin_id as user_id, admin_login.admin_fullname,
                admin_login.password, admin_login.admin_email, admin_login.profile_image, 'Faculty' as DESIGNATION,
                admin_login.profiles, admin_login.role, `groups`.facultystaff
                FROM name
                LEFT JOIN (SELECT NameLink, facultystaff FROM `groups` WHERE `groups`.facultystaff = 1) `groups`
                ON name.ID = `groups`.NameLink
                RIGHT OUTER JOIN (SELECT Email, EmailID FROM email WHERE Email LIKE '%future.edu%') email
                ON name.ID = email.EmailID
                RIGHT OUTER JOIN admin_login ON email.email = admin_login.admin_email
                WHERE EmailID != 0 AND admin_email = ? AND admin_login.account_status = '1'";

        $query = $this->db->query($sql, [$data['email']]);

        return $query->getResultArray();
    }

    public function emailValid($email)
    {
        return $this->db->table('admin_login')->where('admin_email', $email)->countAllResults() == 0;
    }

    public function getRegPwdByRegID($email, $pwd_post)
    {
        $email = test_input($email);
        $query = $this->db->query("CALL SP_AdminLogin('3','','','','', ?, '','','','','','','','','','','','', @RES)", [$email]);
        $result = $query->getResultArray();

        if (isset($result[0]['RES'])) {
            return [
                'status' => false,
                'message' => $result[0]['RES'] == 'false' ?
                    'The Email ID or Password is incorrect.' : 'Something went wrong.'
            ];
        }

        $salt = get_salt_token_admin();

        $pwdMD5 = $result[0]['password'];
        $salted_pwdMD5 = $pwdMD5 . $salt;

        // echo 'pwdMD5 => '; print_r($pwdMD5);
        // echo '<br>';
        // echo 'pwd_post => '; print_r($pwd_post);
        // echo '<br>';
        // echo 'salted_pwdMD5 =>'; print_r($salted_pwdMD5);

        // die();

        return $pwd_post == $salted_pwdMD5
            ? ['status' => true, 'org_pwd' => $pwdMD5]
            : ['status' => false, 'message' => 'The Email ID or Password is incorrect.'];
    }

    public function webLogin($data)
    {
        $sql = "SELECT email.EmailID AS admin_id, admin_login.admin_id as user_id, admin_login.display_screen as screen_id,
                admin_login.admin_fullname, admin_login.password, admin_login.admin_email, admin_login.profile_image,
                'Faculty' as DESIGNATION, admin_login.profiles, admin_login.role, `groups`.facultystaff
                FROM name
                LEFT JOIN (SELECT NameLink, facultystaff FROM `groups` WHERE `groups`.facultystaff = 1) `groups`
                ON name.ID = `groups`.NameLink
                RIGHT OUTER JOIN (SELECT Email, EmailID FROM email WHERE Email LIKE '%future.edu%') email
                ON name.ID = email.EmailID
                RIGHT OUTER JOIN admin_login ON email.email = admin_login.admin_email
                WHERE EmailID != 0 AND admin_email = ? AND admin_login.password = ? AND admin_login.account_status = '1'";

        $query = $this->db->query($sql, [$data['email'], $data['password']]);

        return $query->getResultArray();
    }

    public function insertLoginAdminLog($param)
    {
        $value = array_map('test_input', $param);

        $loginTable = $this->db->table('admin_login_log');
        $latest = $loginTable->select('LOGIN_DATE_TIME, USER_IP')
            ->where('USERID', $value['PUSERID'])
            ->where('LOGIN_STATUS', 'Success')
            ->orderBy('LOGIN_DATE_TIME', 'DESC')
            ->limit(1)
            ->get()->getResultArray();

        session()->set('admin_last_login', $latest);

        $sql = "CALL SP_Admin_log_insert_update(?, '', ?, ?, ?, '', ?, '', @res)";
        $result = $this->db->query($sql, [
            $value['PQUERY_TYPE'],
            $value['PUSERID'],
            $value['PUSER_IP'],
            $value['PUSER_BROWSER'],
            $value['PLOGIN_STATUS']
        ])->getResultArray();

        session()->set('admin_login_date_time', $result[0]['RES'] ?? '');

        return true;
    }

    public function updateLogoutAdminLog($param)
    {
        $value = array_map('test_input', $param);
        $sql = "CALL SP_Admin_log_insert_update(?, '', ?, '', '', ?, '', '', @res)";
        $this->db->query($sql, [
            $value['PQUERY_TYPE'],
            $value['PUSERID'],
            $value['PLOGIN_DATE_TIME']
        ]);

        return true;
    }

    public function requestForgetPassword($param)
    {
        $data = array_map('test_input', $param);
        $res = $this->db->table('request_forget_password')->insert($data);

        return [
            'msg' => $res ? 'INSERTED' : 'NOT INSERTED',
            'last_insert_id' => $this->db->insertID()
        ];
    }

    public function changePassword($param)
    {
        $data = array_map('test_input', $param);
        $sql = "CALL SP_ChangePassword(?, ?, ?, ?, ?, ?, @abc)";
        $res = $this->db->query($sql, [
            $data['TYPE'],
            $data['USERID'],
            $data['PASSWORD'],
            $data['NEW_PASSWORD'],
            $data['PASSWORD_CHANGED_IP'],
            $data['PASSWORD_CHANGED']
        ]);

        return $res->getResultArray();
    }

    public function get_display_url($email)
    {
        $builder = $this->db->table('admin_login');
        $builder->select('display_url');
        $builder->join('mst_display_url', 'mst_display_url.id = admin_login.display_screen');
        $builder->where('admin_email', $email);
        $query = $builder->get();

        return $query->getNumRows() == 0 ? false : $query->getRowArray();
    }

    public function getAllDisplayUrl()
    {
        $query = $this->db->table('mst_display_url')->get();
        return $query->getNumRows() == 0 ? false : $query->getResultArray();
    }

    public function updateDisplayScreen($display, $admin_id)
    {
        return $this->db->table('admin_login')
            ->where('admin_id', $admin_id)
            ->update(['display_screen' => $display]);
    }

    public function studentLogin($email)
    {
        return $this->db->table('email')
            ->where(['Email' => $email, 'Active' => '1'])
            ->get()->getResultArray();
    }

    public function getStudentCourse($id = '')
    {
        if ($id === '') return "invalid user";

        $sql = "SELECT c.Class, c.Semester, Term, Course, t.Grade, Professor, CourseTitle,
                CourseDates, External_Professor, CreditAttempt, CreditEarned, QualityPoints,
                QualityPoints_old
                FROM transcript t
                INNER JOIN courselist c ON t.CourseID = c.CourseID
                INNER JOIN mst_grades_class mgc ON c.Class = mgc.class AND t.Grade = mgc.Grade
                WHERE t.StudentID = ? AND (t.Deletestatus IS NULL OR t.Deletestatus != 1)
                ORDER BY c.Class DESC, c.Term DESC";

        return $this->db->query($sql, [$id])->getResultArray();
    }

    public function email_valid($param)
    {
        $builder = $this->db->table('admin_login');
        $builder->select('admin_email');
        $builder->where('admin_email', $param);
        $query = $builder->get();

        if ($query->getNumRows() == 0) {
            return true;  // Email does NOT exist
        } else {
            return false; // Email exists
        }
    }

    function update_display_screen($display,$admin_id){
		
		$data = array(
        'display_screen' => $display
        
		);
		$this->db->table('admin_login')->where('admin_id', $admin_id);
		$this->db->table('admin_login')->update($data);
	
		
	}

    function get_all_display_url(){
		
        $builder = $this->db->table('mst_display_url');
		// Check email exists
		$builder->select();
		
		$query = $builder->get();
		//echo $query->num_rows();die;
		if($query->getNumRows() == 0){

			return false;
			
		}else{ 

			return $response = $query->getResultArray();
		}
	
		
	} 
}
