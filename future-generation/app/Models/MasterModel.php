<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class MasterModel extends Model
{
    protected $db;
    protected $request;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
        $this->request = \Config\Services::request();
    }

    function getCountry($ROWID = '')
    {
        $builder = $this->db->table('country');
        $builder->select('*');
        if ($ROWID != '') {
            $builder->where('ROWID', $ROWID);
        }
        $builder->where('Deletestatus is null');
        $builder->OrderBy('trim(CountryName)', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function checkCountry($CountryID, $CountryName, $Active = '')
    {
        $response = array();
        $builder = $this->db->table('country');
        $builder->select('CountryID,CountryName');
        $builder->where('CountryID', $CountryID);
        $builder->where('CountryName', $CountryName);
        if ($Active != '') {
            $builder->where('Active', $Active);
        }
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            $response['msg'] = 'Exist';
        } else {
            $response['msg'] = 'NotExist';
        }
        return $response;
    }

    function insertCountry($Country)
    {
        $result = array();
        $res = $this->db->table('country')->insert($Country);
        if ($res) {
            $result['msg'] = "INSERTED";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT INSERTED";
        }

        return $result;
    }
    function updateCountry($Country)
    {

        //print_r($Country);die();
        $result = array();
        foreach ($Country as $key => $val) {
            $Country[$key] = test_input($val);
        }
        $builder = $this->db->table('country');
        $builder->where('ROWID', $Country['ROWID']);
        $query = $builder->update($Country);
        //echo $this->db->last_query(); die();
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function insertGrades($addgrades)
    {
        $result = array();
        $res = $this->db->table('grades')->insert($addgrades);
        if ($res) {
            $result['msg'] = "INSERTED";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT INSERTED";
        }

        return $result;
    }
    function updateGrades($addgrades)
    {

        //print_r($State);die();
        $result = array();
        foreach ($addgrades as $key => $val) {
            $addgrades[$key] = test_input($val);
        }
        $builder = $this->db->table('grades');
        $builder->where('ROWID', $addgrades['ROWID']);
        $query = $builder->update($addgrades);
        //echo $this->db->last_query(); die();
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function getPaymentType($ROWID = '')
    {

        $builder = $this->db->table('paymenttype');
        $builder->select('*');
        if ($ROWID != '') {
            $builder->where('ROWID', $ROWID);
        }
        $builder->where('Deletestatus is null');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function insertPaymentType($PaymentType)
    {
        $result = array();
        $res = $this->db->table('paymenttype')->insert($PaymentType);
        if ($res) {
            $result['msg'] = "INSERTED";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT INSERTED";
        }

        return $result;
    }

    function updatePaymentType($PaymentType)
    {

        $result = array();
        foreach ($PaymentType as $key => $val) {
            $PaymentType[$key] = test_input($val);
        }
        $builder = $this->db->table('paymenttype');
        $builder->where('ROWID', $PaymentType['ROWID']);
        $query = $builder->update($PaymentType);
        //echo $this->db->last_query(); die();
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function getState($ROWID = '')
    {

        $builder = $this->db->table('state');
        $builder->select('*');
        if ($ROWID != '') {
            $builder->where('ROWID', $ROWID);
        }
        $builder->where('Deletestatus is null');
        $builder->OrderBy('StateName', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function insertState($State)
    {
        $result = array();

        $builder = $this->db->table('state');
        $builder->select('*');
        $builder->where('StateID', $State['StateID']);
        $query = $builder->get();
        //echo "<pre>"; echo $this->db->last_query(); exit;
        if ($query->getNumRows() >= 1) {
            $result['msg'] = "Exists";
        } else {
            $res = $builder->insert($State);
            if ($res) {
                $result['msg'] = "INSERTED";
                $result['last_id'] = $this->db->insertId();
            } else {
                $result['msg'] = "NOT INSERTED";
            }
        }
        return $result;
    }

    function updateState($State)
    {

        $result = array();
        foreach ($State as $key => $val) {
            $State[$key] = test_input($val);
        }
        $builder = $this->db->table('state');
        $builder->select('*');
        $builder->where('StateID', $State['StateID']);
        $builder->where('ROWID !=', $State['ROWID']);
        $query = $builder->get();
        //echo "<pre>"; echo $this->db->last_query(); exit;
        if ($query->getNumRows() >= 1) {
            $result['status'] = false;
            $result['msg'] = "Exists";
        } else {
            $builder->where('ROWID', $State['ROWID']);
            $query = $builder->update($State);
            //echo  $this->db->getLastQuery(); die();
            if ($query) {
                $result['status'] = true;
                $result['msg'] = 'UPDATED';
            } else {
                $result['status'] = false;
                $result['msg'] = $this->db->error()['message'];
            }
        }


        return $result;
    }

    function deleteState($State)
    {

        $result = array();
        foreach ($State as $key => $val) {
            $State[$key] = test_input($val);
        }
        $builder = $this->db->table('state');
        $builder->where('ROWID', $State['ROWID']);
        $query = $builder->update($State);

        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'DELETED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }



        return $result;
    }

    function getCampaigns($CampaignID = '')
    {

        $builder = $this->db->table('campaigns');
        $builder->select('*');
        if ($CampaignID != '') {
            $builder->where('CampaignID', $CampaignID);
        }
        $builder->where('Deletestatus is null');
        $builder->OrderBy('CampaignName', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function insertCampaigns($campaigns)
    {
        $result = array();
        $res = $this->db->table('campaigns')->insert($campaigns);
        if ($res) {
            $result['msg'] = "INSERTED";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT INSERTED";
        }

        return $result;
    }

    function updateCampaigns($campaigns)
    {

        //print_r($param);die();
        $result = array();
        foreach ($campaigns as $key => $val) {
            $campaigns[$key] = test_input($val);
        }
        $builder = $this->db->table('campaigns');
        $builder->where('CampaignID', $campaigns['CampaignID']);
        $query = $builder->update($campaigns);
        //echo $this->db->last_query(); die();
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    public function get_upload_signature($location)
    {
        $query = $this->db->query("CALL GetMasterSignature(?)", [$location]);

        // Only call next_result to clear result buffer — do not assign its return value to $query
        $this->db->connID->next_result(); // Optional, only if needed

        // Now safely get the result
        $result = $query->getResultArray();
        return $result;
    }

    function update_master_signature($param)
    {
        $result = array();
        $data = array(
            'sign_name' => $param['sign_name'],
            'sign_image_path' => $param['sign_image_path'],
            'modified_by' => $param['modified_by'],
            'modified_ip' => $param['modified_ip'],
        );
        $builder = $this->db->table('tbl_master_signature');
        $builder->where('id', $param['id']);
        $res = $builder->update($data);
        if ($res) {
            $result['msg'] = "Update Successfully";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT Updated";
        }
        return $result;
    }

    function getClass($ROWID = '')
    {

        $builder = $this->db->table('class');
        $builder->select('*');
        if ($ROWID != '') {
            $builder->where('ROWID', $ROWID);
        }
        $builder->where('Deletestatus is null');
        $builder->OrderBy('Class', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function updateClassInfo($classinfo)
    {

        //print_r($State);die();
        $result = array();
        foreach ($classinfo as $key => $val) {
            $classinfo[$key] = test_input($val);
        }

        $query = $this->db->table('class')->where('ROWID', $classinfo['ROWID'])->update($classinfo);
        //echo $this->db->last_query(); die();
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function getprofessor($CourseID = '')
    {

        $sql = 'SELECT DISTINCT name.ID, name.FirstName, name.LastName FROM name 
                                   LEFT JOIN tblcontract as c ON c.empid = name.ID
                                   LEFT JOIN course_wise_professor as cw ON cw.professor_id = name.ID AND status = "1"
                                   where  (c.contract_end_date >= "' . date('Y-m-d') . '" 
                                   AND c.contract_begin_date <= "' . date('Y-m-d') . '") ';

        if ($CourseID != '') {
            $sql .= 'OR course_id = "' . $CourseID . '"';
        }
        $sql .= ' ORDER BY name.FirstName ASC';
        $query = $this->db->query($sql);
        if ($query->getNumRows() >= 1) {
            $response = $query->getResultArray();
            return $response;
        } else {
            return array();
        }
    }

    function getUniqueCourseList()
    {

        $builder = $this->db->table('courselist');
        $builder->distinct();
        $builder->select('Course');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getCourseList($CourseID = '')
    {

        $builder = $this->db->table('courselist as c');
        $builder->select('GROUP_CONCAT( CONCAT(n.FirstName, " ", n.LastName)) as assistant_name,
		        GROUP_CONCAT(t.assistant_id) as assistant_id,
		c.*');
        if ($CourseID != '') {
            $builder->where('c.CourseID', $CourseID);
        }
        $builder->join('teaching_assistant as t', 't.course_id = c.CourseID AND t.status = "1"', 'left');
        $builder->join('name as n', 'n.ID = t.assistant_id', 'left');
        $builder->groupBy('c.CourseID');
        $builder->orderBy('Class desc,Semester desc,Term asc, Course asc');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function get_professor_by_course_id($id = '')
    {
        return $this->db->table('course_wise_professor')->select('professor_id')->where('course_id', $id)->where('status', '1')->get()->getResultArray();
    }

    function get_professor_by_id($id = '')
    {
        return $this->db->table('name')->select('FirstName,LastName')->whereIn('ID', $id)->get()->getResultArray();
    }

    function insertCourseList($courselist)
    {
        /* $this->db->select('*');
		$this->db->from('class');
		$query = $this->db->get(); */
        $result = array();
        $builder = $this->db->table('courselist');
        $res = $builder->insert($courselist);
        if ($res) {
            $result['msg'] = "INSERTED";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT INSERTED";
        }

        return $result;
    }

    function update_course_professor($professor_id = '', $CourseID = '')
    {
        $builder = $this->db->table('course_wise_professor');
        $data = array('status' => '0');
        $builder->where('course_id', $CourseID);
        $builder->update($data);
        if (!is_array($professor_id)) {
            $professor_id = explode(',', $professor_id); // or wrap in array: [$professor_id]
        }
        for ($i = 0; $i < sizeof($professor_id); $i++) {

            $data1 = array('professor_id' => $professor_id[$i], 'course_id' => $CourseID, 'status' => '1');
            $check_data = $builder->select('*')->where(['course_id' => $CourseID, 'professor_id' => $professor_id[$i]])->get()->getRowArray();
            if ($check_data) {
                $builder->where('id', $check_data['id']);
                $builder->update($data1);
            } else {
                $this->db->table('course_wise_professor')->insert($data1);
            }
        }
    }

    function updateCourseList($param)
    {

        //print_r($param);die();
        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
        }
        $builder = $this->db->table('courselist');
        $builder->where('CourseID', $param['CourseID']);
        $query = $builder->update($param);
        //
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function update_course_assistant($teaching_assistant = '', $CourseID = '')
    {
        $data = array('status' => '0');
        $builder = $this->db->table('teaching_assistant');
        $builder->where('course_id', $CourseID);
        $builder->update($data);
        if (!is_array($teaching_assistant)) {
            $teaching_assistant = explode(',', $teaching_assistant);
        }
        for ($i = 0; $i < sizeof($teaching_assistant); $i++) {
            $data1 = array('assistant_id' => $teaching_assistant[$i], 'course_id' => $CourseID, 'status' => '1');
            $check_data = $builder->select('*')->where(['course_id' => $CourseID, 'assistant_id' => $teaching_assistant[$i]])->get()->getRowArray();
            if ($check_data) {
                $builder->where('id', $check_data['id']);
                $builder->update($data1);
            } else {
                $builder->insert($data1);
            }
        }
    }

    function getTranscript($CourseID)
    {

        $builder = $this->db->table('transcript');
        $builder->where('CourseID', $CourseID);
        $builder->where('Deletestatus IS NULL');
        $query =  $builder->get();
        $array = $query->getResultArray();

        if ($query) {
            if ($query->getNumRows() >= 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function copy_in_delCourseList($CourseID)
    {
        // Get the course details from courselist
        $builder = $this->db->table('courselist');
        $course = $builder->where('CourseID', $CourseID)->get()->getRowArray();

        if (!$course) {
            return false; // No such course
        }

        // Add IP and user info
        $course['deleteIp'] = $this->request->getIPAddress();
        $course['deleteBy'] = session()->get('USER_ID');

        // Prepare insert data
        $data = [
            'CourseID'     => $course['CourseID'],
            'Class'        => $course['Class'],
            'Semester'     => $course['Semester'],
            'Term'         => $course['Term'],
            'Course'       => $course['Course'],
            'Professor'    => $course['Professor'],
            'Professor_id' => $course['Professor_id'],
            'Credits'      => $course['Credits'],
            'CourseTitle'  => $course['CourseTitle'],
            'CourseDates'  => $course['CourseDates'],
            'deleteIp'     => $course['deleteIp'],
            'deleteBy'     => $course['deleteBy'],
            'tution'       => $course['tution'] ?? null // added null fallback
        ];

        // Check if it already exists in del_courselist
        $exists = $this->db->table('del_courselist')
            ->where('CourseID', $CourseID)
            ->get()
            ->getRow();

        if ($exists) {
            return false; // Already exists
        }

        // Insert into del_courselist
        return $this->db->table('del_courselist')->insert($data);
    }


    function del_in_courselist($CourseID)
    {
        $this->db->table('courselist')->where('CourseID', $CourseID);
        if ($this->db->table('courselist')->where('CourseID', $CourseID)->delete()) {
            return true;
        } else {
            return false;
        }
    }

    function get_assign_user_in_transcript($CourseID)
    {
        $builder = $this->db->table('transcript as t');
        $builder->where('t.CourseID', $CourseID);
        $builder->where('t.Deletestatus IS NULL');
        $builder->select('n.ID,n.FirstName,n.LastName');
        $builder->join('name as n', 'n.ID = t.StudentID');
        $query =  $builder->get();
        return $array = $query->getResultArray();
    }

    function getRegionProgram($RPID = '')
    {

        $builder = $this->db->table('regionprogram');
        $builder->select('*');
        if ($RPID != '') {
            $builder->where('RPID', $RPID);
        }
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function insertRegionProgram($RegionProgram)
    {
        $result = array();
        $builder = $this->db->table('regionprogram');
        $res = $builder->insert($RegionProgram);
        if ($res) {
            $result['msg'] = "INSERTED";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT INSERTED";
        }

        return $result;
    }

    function updateRegionProgram($RegionProgram)
    {

        //print_r($RegionProgram);die();
        $result = array();
        foreach ($RegionProgram as $key => $val) {
            $RegionProgram[$key] = test_input($val);
        }
        $builder = $this->db->table('regionprogram');
        $builder->where('RPID', $RegionProgram['RPID']);
        $query = $builder->update($RegionProgram);
        //echo $this->db->last_query(); die();
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function getDiploma($dipID = '')
    {

        $builder = $this->db->table('Diploma');
        $builder->select('*');
        if ($dipID != '') {
            $builder->where('dipID', $dipID);
        }
        $builder->where('Deletestatus is null');
        $builder->OrderBy('dipName', 'ASC');
        $query = $builder->get();

        //echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function insertDiploma($diplomainfo)
    {
        $data = array();
        $response = array();
        foreach ($diplomainfo as $key => $val) {

            $data[$key] = test_input($val);
        }
        $query = $this->db->table('Diploma')->insert($data);

        if ($query) {

            $response['status'] = true;
            $response['msg'] = 'INSERTED';
        } else {

            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }

    function updateDiploma($diplomainfo)
    {
        $result = array();
        foreach ($diplomainfo as $key => $val) {
            $diplomainfo[$key] = test_input($val);
        };
        $query = $this->db->table('Diploma')->where('dipID', $diplomainfo['dipID'])->update($diplomainfo);
        //echo $this->db->last_query(); die();
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function getDiplomaNameById($dipID)
    {

        $builder = $this->db->table('Diploma');
        $builder->select('*');
        $builder->where('dipID', $dipID);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getCertificateList($certID = '')
    {

        $builder = $this->db->table('Certificates');
        $builder->select('*');
        if ($certID != '') {
            $builder->where('certID', $certID);
        }
        $builder->where('Deletestatus IS NULL');
        $builder->orderBy('certID', 'DESC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getDiplomaList()
    {

        $builder = $this->db->table('Diploma');
        $builder->select('*');
        $builder->where('active', 1);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {

            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function insertCertificateList($courselist)
    {
        $result = array();
        $res = $this->db->table('Certificates')->insert($courselist);
        if ($res) {
            $result['msg'] = "INSERTED";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT INSERTED";
        }

        return $result;
    }

    function updateCertificateList($param)
    {

        //print_r($param);die();
        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
        }

        $query = $this->db->table('Certificates')->where('certID', $param['certID'])->update($param);
        //
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function getprogram($ProgramID = '')
    {

        $builder = $this->db->table('mst_program');
        $builder->select('*');
        if ($ProgramID != '') {
            $builder->where('ProgramID', $ProgramID);
        }
        $builder->where('status <>', 3);
        $query = $builder->get();
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }


    function insertProgram($program)
    {
        $result = array();
        $res = $this->db->table('mst_program')->insert($program);
        if ($res) {
            $result['msg'] = "INSERTED";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT INSERTED";
        }

        return $result;
    }


    function updateProgram($program)
    {
        $result = array();
        $data = array();
        foreach ($program as $key => $val) {
            $data[$key] = test_input($val);
        }

        $query = $this->db->table('mst_program')->where('ProgramID', $data['ProgramID'])->update($data);
        //echo $this->db->last_query(); die();
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    public function get_user_by_progrm()
    {
        $program_id = $this->request->getPost('id');
        $program_id = encryptor('decrypt', $program_id);
        $builder = $this->db->table('student_info as si');

        return  $builder->distinct('si.StudentInfoID')
            ->select('si.StudentInfoID,si.ProgramID,n.FirstName,n.LastName')
            ->join('name as n', 'n.ID = si.StudentInfoID')
            ->where('ProgramID', $program_id)
            ->get()
            ->getResultArray();
    }

     public function delete_program()
    {
    	$program_id = $this->request->getPost('program_id');
		$program_id = encryptor('decrypt', $program_id); 
		$data= array('status'=>'3');
        $builder = $this->db->table('mst_program');
		$builder->where('ProgramID',$program_id);
		$builder->update($data);

		$data2 = array('ProgramID'=>'0');

        $builder1 = $this->db->table('student_info');
		$builder1->where('ProgramID',$program_id);
		$builder1->update($data2);
    }

    function getspecialprogram($ProgramID='')
	{
        $builder = $this->db->table('mst_special_program');
		 $builder->select('*');
		if($ProgramID !=''){
		 $builder->where('Special_ProgramID',$ProgramID);	
		}
		return $builder->get()
				        ->getResultArray();
						
	}

	function insertSpecialProgram($data)
	{
		$result = array();
		$res=$this->db->table('mst_special_program')->insert($data);
		if($res){
			$result['msg'] = "INSERTED";
			$result['last_id'] = $this->db->insertId();
		}else{
			$result['msg'] = "NOT INSERTED";
		}
		
		return $result;
	}

	function updateSpecialProgram($program,$program_id) {
        $result = array();
		
        $query = $this->db->table('mst_special_program')->where('Special_ProgramID', $program_id)->update($program);
		//echo $this->db->last_query(); die();
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function insert_document_type($param){
	    $res = $this->db->table('DocumentType')->insert($param);
	    if ($res) {
			$result['msg'] = "INSERTED";
			$result['last_id'] = $this->db->insertId();
		} else {
			$result['msg'] = "NOT INSERTED";
		}
		return $result;
	}
	
	function update_document_type($param,$id){
        $res = $this->db->table('DocumentType')->where('id',$id)->update($param);
        if ($res) {
        	$result['msg'] = "UPDATED";
        	$result['last_id'] = $this->db->insertId();
        } else {
        	$result['msg'] = "NOT UPDATED";
        }
        return $result;
	}

    public function getAllData(){

        $builder = $this->db->table('mst_grades_class');
    	$builder->select('*');
    	$query = $builder->get()->getResultArray();
    	return $query;
    }

     public function getAllClass(){

        $builder = $this->db->table('class');
    	$builder->select('*');
    	$builder->where('Active', 1);
    	$builder->orderBy('Class');
    	$query = $builder->get();
    	if($query->getNumRows()>0){
    		return $query->getResultArray();
    	}else{
    		return false;
    	}
    }


    public function getAllGrade(){

        $builder = $this->db->table('grades');
    	$builder->select('*');
    	$builder->where('Active', 1);
    	//$this->db->group_by('Grade');
		$builder->distinct('Grade');
    	$builder->orderBy('Grade');
    	$query = $builder->get();
    	if($query->getNumRows()>0){
    		return $query->getResultArray(); 
    		//$this->db->last_query(); 
    	}else{
    		return false;
    	}
    }

    
	function get_track()
	{
       $builder = $this->db->table('track');
	   $builder->select('*');
	   if($this->request->getPost('tab_type') == 'Active')
	   {
	       $builder->where('status','1');
	   }
	   if($this->request->getPost('tab_type') == 'Inactive')
	   {
	       $builder->where('status','0');
	   }
	   $query = $builder->get();
	   return $query->getResultArray();
	}


	function insert_track($param)
	{
	    $query = $this->db->table('track')->insert($param);
	    return $query;
	}


	function update_track($param)
	{
	    $data = array();
	    foreach($param as $key => $val){			
			$data[$key] = test_input($val);						
		}
		
		$query = $this->db->table('track')->where('id', $data['id'])->update($data); 
		return $query;
	}
}
