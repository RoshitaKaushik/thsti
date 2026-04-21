<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class ApplicationModel extends Model
{
    protected $db;
    protected $request;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
        $this->request = \Config\Services::request();
    }

    function getNameList($postData = null)
    {
        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = isset($postData['order'][0]['column']) ? $postData['order'][0]['column'] : 0;
        $columnName = isset($postData['columns'][$columnIndex]['data']) ? $postData['columns'][$columnIndex]['data'] : 'FirstName';
        $columnSortOrder = isset($postData['order'][0]['dir']) ? $postData['order'][0]['dir'] : 'asc';


        $tags = isset($postData['role_val']) ? $postData['role_val'] : [];

        //$searchValue = $postData['search']['value']; // Search value

        // Custom search filter 

        $searchFirstName = $postData['searchFirstName'] ?? '';
        $searchLastName = $postData['searchLastName'] ?? '';
        $searchSpouse = $postData['searchSpouse'] ?? '';
        $searchCompany = $postData['searchCompany'] ?? '';
        $searchContact = $postData['searchContactId'] ?? '';
        $firstNameFocus = $postData['firstNameFocus'] ?? '';
        $lastNameFocus = $postData['lastNameFocus'] ?? '';
        $spouseFocus = $postData['spouseFocus'] ?? '';
        $companyFocus = $postData['companyFocus'] ?? '';

        ## Search 
        //  $searchQuery = "";
        //  if($searchValue != ''){
        //     $searchQuery = " (FirstName like '%".$searchValue."%' or LastName like '%".$searchValue."%' or Company like'%".$searchValue."%' ) ";
        //  }


        ## Search 
        $search_arr = array();
        $searchQuery = "";

        if ($searchFirstName != '') {
            $search_arr[] = " FirstName like '%" . $searchFirstName . "%' ";
        }
        if ($searchLastName != '') {
            $search_arr[] = " LastName like '%" . $searchLastName . "%' ";
        }
        if ($searchSpouse != '') {
            $search_arr[] = " Spouse like '%" . $searchSpouse . "%' ";
        }
        if ($searchCompany != '') {
            $search_arr[] = " Company like '%" . $searchCompany . "%' ";
        }
        if ($searchContact != '') {
            $search_arr[] = " ID = '" . $searchContact . "'";
        }

        if ($tags != '') {
            foreach ($tags as $tg) {
                if ($tg != 'Donor' && $tg != 'Alum' &&  $tg != 'Student' &&  $tg != 'Current Employee' &&  $tg != 'Formal Employee') {
                    $search_arr[] = "  " . $tg . " = '1'";
                }
            }
        } else {
            $tags  = array();
        }


        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering

        $builder = $this->db->table('name');
        $builder->select('count(DISTINCT name.ID) as allcount')
            ->join('groups', 'groups.NameLink = name.ID', 'left');

        $records = $builder->get();
        $results = $records->getResult();
        $totalRecords = $results[0]->allcount;

        ## Total number of record with filtering

        $builder->select('count(DISTINCT name.ID) as allcount')
            ->join('groups', 'groups.NameLink = name.ID', 'left');


        if (in_array("Donor", $tags)) {
            $builder->join("(SELECT DonorID,COUNT(*) as donorCount from donations 
                                WHERE Campaign NOT IN ('18','22','23','24','26') AND 
                                (Deletestatus IS NULL OR Deletestatus!='1') group by DonorID ) as t4", "name.ID = t4.DonorID", "left");
        }

        if (in_array("Current Employee", $tags)) {
            $builder->join("(select empid,COUNT(*) as totalContract FROM tblcontract as tc 
                                WHERE (tc.Deletestatus IS NULL OR tc.Deletestatus!='1') AND 
                                empid IN (SELECT tc1.empid FROM tblcontract as tc1 
                                WHERE tc1.contract_end_date >= CURDATE()) group by empid) as t5", "t5.empid = name.ID", "left");
        }
        if (in_array("Formal Employee", $tags)) {
            $builder->join(
                "(select empid,COUNT(*) as totalPastContract FROM tblcontract as xtc 
                            WHERE (xtc.Deletestatus IS NULL OR xtc.Deletestatus!='1') 
                            AND empid NOT IN (SELECT xtc1.empid FROM tblcontract as xtc1 WHERE xtc1.contract_end_date >= CURDATE()) group by empid) as t6",
                "t6.empid = name.ID",
                "left"
            );
        }
        if (in_array("Alum", $tags) || in_array("Student", $tags)) {
            $builder->join(
                "(select StudentInfoID,COUNT(*) as alumStudent FROM student_info as si WHERE (si.Deletestatus IS NULL OR si.Deletestatus!='1') AND Graduation IS NOT NULL AND Graduation != ''  GROUP BY StudentInfoID) as t7",
                "t7.StudentInfoID = name.ID",
                "left"
            );
        }

        if (in_array("Student", $tags)) {
            $builder->join('transcript as t', 't.StudentID = name.ID AND (t.Deletestatus IS NULL OR t.Deletestatus!="1")');
            $builder->join(
                "(SELECT StudentInfoID as nGra_student_id FROM student_info
                            WHERE (Deletestatus is NULL OR Deletestatus!=1) AND (Graduation IS NULL OR Graduation = '')) as t2",
                "t2.nGra_student_id = name.ID",
                "left"
            );
        }


        if ($searchQuery != '')
            $builder->where($searchQuery);

        if (in_array("Donor", $tags)) {
            $builder->where('donorCount >', '0');
        }
        if (in_array("Current Employee", $tags)) {
            $builder->where('totalContract >', '0');
        }
        if (in_array("Formal Employee", $tags)) {
            $builder->where('totalPastContract >', '0');
        }
        if (in_array("Alum", $tags)) {
            $builder->where('alumStudent >', '0');
        }
        if (in_array("Student", $tags)) {
            $sqq = '(alumStudent IS NULL OR alumStudent = "0")';
            $builder->where($sqq);
            $builder->where('nGra_student_id IS NOT NULL');
        }

        $records = $builder->get()->getResult();
        $totalRecordwithFilter = $records[0]->allcount;


        ## Fetch records
        $builder->distinct();
        $builder->select('name.*')
            ->join('groups', 'groups.NameLink = name.ID', 'left');
        if (in_array("Donor", $tags)) {
            $builder->join("(SELECT DonorID,COUNT(*) as donorCount from donations 
                                WHERE Campaign NOT IN ('18','22','23') AND 
                                (Deletestatus IS NULL OR Deletestatus!='1') group by DonorID ) as t4", "name.ID = t4.DonorID", "left");
        }
        if (in_array("Current Employee", $tags)) {
            $builder->join("(select empid,COUNT(*) as totalContract FROM tblcontract as tc 
                                WHERE (tc.Deletestatus IS NULL OR tc.Deletestatus!='1') AND 
                                empid IN (SELECT tc1.empid FROM tblcontract as tc1 
                                WHERE tc1.contract_end_date >= CURDATE()) group by empid) as t5", "t5.empid = name.ID", "left");
        }
        if (in_array("Formal Employee", $tags)) {
            $builder->join(
                "(select empid,COUNT(*) as totalPastContract FROM tblcontract as xtc 
                            WHERE (xtc.Deletestatus IS NULL OR xtc.Deletestatus!='1') 
                            AND empid NOT IN (SELECT xtc1.empid FROM tblcontract as xtc1 WHERE xtc1.contract_end_date >= CURDATE()) group by empid) as t6",
                "t6.empid = name.ID",
                "left"
            );
        }
        if (in_array("Alum", $tags) || in_array("Student", $tags)) {
            $builder->join(
                "(select StudentInfoID,COUNT(*) as alumStudent FROM student_info as si WHERE (si.Deletestatus IS NULL OR si.Deletestatus!='1') AND Graduation IS NOT NULL AND Graduation != ''  GROUP BY StudentInfoID) as t7",
                "t7.StudentInfoID = name.ID",
                "left"
            );
        }
        if (in_array("Student", $tags)) {
            $builder->join('transcript as t', 't.StudentID = name.ID AND (t.Deletestatus IS NULL OR t.Deletestatus!="1")');
            $builder->join(
                "(SELECT StudentInfoID as nGra_student_id FROM student_info
                            WHERE (Deletestatus is NULL OR Deletestatus!=1) AND (Graduation IS NULL OR Graduation = '')) as t2",
                "t2.nGra_student_id = name.ID",
                "left"
            );
        }
        if ($searchQuery != '')
            $builder->where($searchQuery);

        if (in_array("Donor", $tags)) {
            $builder->where('donorCount >', '0');
        }
        if (in_array("Current Employee", $tags)) {
            $builder->where('totalContract >', '0');
        }
        if (in_array("Formal Employee", $tags)) {
            $builder->where('totalPastContract >', '0');
        }
        if (in_array("Alum", $tags)) {
            $builder->where('alumStudent >', '0');
        }
        if (in_array("Student", $tags)) {
            $sqq = '(alumStudent IS NULL OR alumStudent = "0")';
            $builder->where($sqq);
            $builder->where('nGra_student_id IS NOT NULL');
        }


        // Avoid ordering by non-existent columns like 'action'
        if (!in_array($columnName, ['action'])) {
            $builder->orderBy($columnName, $columnSortOrder);
        }

        $builder->limit($rowperpage, $start);
        $records = $builder->get()->getResult();

        $data = array();

        foreach ($records as $record) {
            $data[] = array(
                "action" => '<span class="view_outter_box">
                <a href="' . base_url('admin/Form/ViewApp/' . $record->ID) . '" class="btn btn-success waves-effect waves-light btn-xs m-b-1">
                    <span><strong>Open</strong></span> 
                </a> <br> <span class="waves-effect waves-light btn-xs m-b-5 edit_row_btn" rel_id="' . $record->ID . '" aria-hidden="true"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="view"></span></span></span>',
                "ContactId" => $record->ID,
                "FirstName" => $record->FirstName,
                "LastName" => $record->LastName,
                "Spouse" => $record->Spouse,
                "Company" => $record->Company
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "searchFirstName" => $searchFirstName,
            "searchLastName" => $searchLastName,
            "searchSpouse" => $searchSpouse,
            "searchCompany" => $searchCompany,
            "SearchContactId" => $searchContact,
            "firstNameFocus" => $firstNameFocus,
            "lastNameFocus" => $lastNameFocus,
            "spouseFocus" => $spouseFocus,
            "companyFocus" => $companyFocus,
            "ContactIdFocus" => $postData['ContactIdFocus'] ?? ''
        );
        //$response['csrfHash'] = csrf_hash();
        return $response;
    }

    function get_address_type()
    {
        $builder = $this->db->table('address_type');
        return $builder->select('*')
            ->where('status', '1')
            ->get()
            ->getResultArray();
    }

    function get_active_track()
    {
        $builder = $this->db->table('track');
        return $builder->select('*')
            ->where('status', '1')
            ->get()
            ->getResultArray();
    }

    function get_all_scholarship()
    {
        $builder = $this->db->table('mst_scholarship');
        return $builder->select('*')
            ->where('status', 0)
            ->get()
            ->getResultArray();
    }

    function getAllActiveClass()
    {

        $builder = $this->db->table('class');
        $builder->select('*');
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('Active', 1);
        $builder->orderBy('Class', 'desc');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getAllRegion()
    {

        $builder = $this->db->table('regionprogram');
        $builder->select('*');
        $builder->where('Active', 1);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getAllActiveProgram()
    {

        $builder = $this->db->table('mst_program');
        $builder->select('*');
        $builder->where('status', 1);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getpaymentType()
    {

        $builder = $this->db->table('paymenttype');
        $builder->select('*');
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('PayType', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getAllCampaigns()
    {

        $builder = $this->db->table('campaigns');
        $builder->select('*');
        $builder->where('Active', 1);
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('CampaignName', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getAllGradesTranscript()
    {

        $builder = $this->db->table('grades');
        $builder->select('*');
        $builder->where('Active', 1);
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        //$this->db->group_by('Grade');
        $builder->distinct('Grade');
        $builder->orderBy('Grade', 'ASC');
        //echo $this->db->last_query(); die();
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getAllActiveCertificate()
    {

        $builder = $this->db->table('Certificates');
        $builder->select('certID,cert_no');
        $builder->where('active', 1);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {

            return $query->getResultArray();
        } else {

            return array();
        }
    }

    function getActiveContactType()
    {

        $builder = $this->db->table('ContactType');
        $builder->select('*');
        $builder->where('Active', 1);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getspecialprogram($ProgramID = '')
    {
        $builder = $this->db->table('mst_special_program');
        return $builder->select('*')
            ->where('status', '1')
            ->get()
            ->getResultArray();
    }

    function get_all_phone_type()
    {
        $builder = $this->db->table('PhoneType');
        return $builder->select('*')
            ->where('Active', 1)
            ->orderBy('PhoneType', 'ASC')
            ->get()
            ->getResultArray();
    }

    function getAllOrganization()
    {

        $builder = $this->db->table('organization');
        return $builder->select('*')
            ->where('Active', '1')
            ->where('type', 'organization')
            ->get()
            ->getResultArray();
    }

    function allOrgRelationship()
    {

        $builder = $this->db->table('organization');
        return $builder->select('*')
            ->from('relationship_type')
            ->where('status', '1')
            ->get()
            ->getResultArray();
    }

    function getStudentInfoByID($StudentInfoID)
    {

        $builder = $this->db->table('student_info as si');
        $builder->select(
            'si.*, 
                          rp.RegionProgram,
                          GROUP_CONCAT(t.track_name) as track_name,
                          GROUP_CONCAT(t.id) as track_id,
                          (SELECT GROUP_CONCAT(sm.market_id) FROM student_info_market sm  WHERE sm.student_info_id = si.Student_RowID AND status = "1") AS Special_ProgramID,
                          (select GROUP_CONCAT(sp.Special_Program_Name) FROM mst_special_program sp JOIN student_info_market as jsm 
                          ON sp.Special_ProgramID = jsm.market_id AND jsm.contact_id = "' . $StudentInfoID . '" 
                          WHERE jsm.student_info_id = si.Student_RowID AND jsm.status = "1") as Special_Program_Name'
        );
        $builder->join('regionprogram as rp', 'rp.RPID = si.Region', 'LEFT');

        $builder->join('student_info_track as st', 'st.student_info_id = si.Student_RowID', 'left');
        $builder->join('track as t', 't.id = st.track_id AND st.status = "1"', 'left');

        $builder->where('si.StudentInfoID', $StudentInfoID);
        $deletestatus = "(si.Deletestatus IS NULL OR si.Deletestatus!=1)";
        $builder->where($deletestatus);

        $builder->groupBy(
            'si.Student_RowID',
            'si.StudentInfoID',
            'si.Graduation',
            'si.Class',
            'si.Sex',
            'si.Region',
            'si.Note',
            'si.GPA',
            'si.WDT1',
            'si.WDT2',
            'si.WDT3',
            'si.WDT4',
            'si.Withdrawn',
            'si.Deffered',
            'si.Credit_Hrs_Earned',
            'si.Credit_Hrs_Attempted',
            'si.CreditsEarned',
            'si.ProgramID',
            'si.Deletestatus',
            'si.modified_by',
            'si.modified_date',
            'si.modified_ip',
            'Special_ProgramID',
            'si.enroll_certificate',
            'si.master_program',
            'si.start_date',
            'rp.RegionProgram',
            'Special_Program_Name'
        );
        //echo $this->db->last_query(); 
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getStudentRecInfo($NameID)
    {

        $builder = $this->db->table('tbl_student_record_attachment');
        $builder->select('*');
        $builder->where('student_id', $NameID);
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('id', 'desc');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getAddressByID($AddressID)
    {

        $builder = $this->db->table('address');
        $builder->select('*');
        $builder->where('AddressID', $AddressID);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getInterAddressByID($AddressID)
    {

        $builder = $this->db->table('address_international');
        $builder->select('*');
        $builder->where('AddressID_int', $AddressID);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getEmergencyAddressByID($AddressID)
    {

        $builder = $this->db->table('address_employee');
        $builder->select('*');
        $builder->where('AddressID', $AddressID);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function insertEmailInfo($email_param)
    {
        $result = array();
        foreach ($email_param as $key => $val) {
            $email_param[$key] = test_input($val);
        }
        $builder = $this->db->table('email');
        if (!recordExist($email_param, 'email')) {
            $res = $builder->insert($email_param);
            if ($res) {
                $result['msg'] = "INSERTED";
                $result['last_id'] = $this->db->insertID(); // Use insertID() in CI4
            } else {
                $result['msg'] = "NOT INSERTED";
            }
        } else {
            $result['msg'] = "Record Already Exists";
        }

        return $result;
    }

    function updateEmailInfo($param)
    {
        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
        }
        $builder = $this->db->table('email');
        $builder->where('Email_RowID', $param['Email_RowID']);
        $query = $builder->update('email', $param);
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $error = $this->db->error();
            $result['msg'] = $error['message'];
        }
        return $result;
    }
    function insertUpdateGroupInfo($param)
    {
        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
        }
        $builder = $this->db->table('groups');
        $builder->select('*');
        $builder->from('groups');
        $builder->where('NameLink', $param['NameLink']);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            $builder->where('NameLink', $param['NameLink']);
            $query = $builder->update('groups', $param);
            if ($query) {
                $result['status'] = true;
                $result['msg'] = 'UPDATED';
            } else {
                $result['status'] = false;
                $error = $this->db->error();
                $result['msg'] = $error['message'];
            }
        } else {
            $res = $builder->insert('groups', $param);
            if ($res) {
                $result['msg'] = "INSERTED";
            } else {
                $result['msg'] = "NOT INSERTED";
            }
        }
        return $result;
    }
    // submit Student record

    function submitStudentRecord($student)
    {

        //echo '<pre>'; print_r($student); die;
        $data = array();
        $response = array();
        foreach ($student as $key => $val) {
            $data[$key] = test_input($val);
        }
        $builder = $this->db->table('tbl_student_record_attachment');
        $query = $builder->insert($data);
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'INSERTED';
            $response['last_insert_id'] = $this->db->insertID();
        } else {
            $response['status'] = false;
            $error = $this->db->error();
            $result['msg'] = $error['message'];
        }
        return $response;
    }

    // update Student record

    function updateStudentRecord($student, $where)
    {
        $data = array();
        $response = array();
        foreach ($student as $key => $val) {
            $data[$key] = test_input($val);
        }

        $builder = $this->db->table('tbl_student_record_attachment');
        $builder->where($where);
        $query = $builder->update('tbl_student_record_attachment', $data);
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'UPDATED';
        } else {
            $response['status'] = false;
            $error = $this->db->error();
            $result['msg'] = $error['message'];
        }
        return $response;
    }

    function getAllFacultyStaffDetails()
    {

        $builder = $this->db->table('name N');
        $builder->select('N.*');
        $builder->join('groups G', 'N.ID=G.NameLink', 'LEFT');
        //$this->db->join('email E','N.ID=E.EmailID','LEFT');
        //$this->db->join('admin_login AL','E.Email=AL.admin_email','LEFT');
        $builder->where('G.FacultyStaff', 1);
        //$this->db->distinct('E.Email'); 
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }
    function getFacultyStaffDetails($facultyID)
    {

        $builder = $this->db->table('name N');
        $builder->select('*');
        $builder->where('ID', $facultyID);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getEmployeementProfileImage($facultyID)
    {

        $builder = $this->db->table('email E');
        $builder->select('AL.*');
        $builder->join('admin_login AL', 'E.Email=AL.admin_email', 'LEFT');
        $builder->where('E.EmailID', $facultyID);
        $builder->distinct('E.EmailID');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function submitEmployeementRecord($employement)
    {
        $data = array();
        $response = array();
        foreach ($employement as $key => $val) {
            $data[$key] = test_input($val);
        }
        $query = $this->db->table('EmploymentData')->insert($data);
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'INSERTED';
            $response['last_insert_id'] = $this->db->insertId();
        } else {
            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }

    function getEmployeementRecord($data)
    {

        $builder = $this->db->table('EmploymentData');
        $builder->select('*');
        $builder->where('Name_id', $data);
        $builder->where('Deletestatus', 0);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function updateEmployeementRecord($employement, $employementIDDDD)
    {

        $data = array();
        $response = array();
        foreach ($employement as $key => $val) {
            $data[$key] = test_input($val);
        }
        $builder = $this->db->table('EmploymentData');
        $query = $builder->where('id', $employementIDDDD);
        $query = $builder->update($data);
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'UPDATED';
            $response['last_insert_id'] = $this->db->insertId();
        } else {
            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }

    function getCourselistBySemester($semester, $class)
    {
        $builder = $this->db->table('courselist');
        $builder->select('CourseID,Course,CourseTitle'); // modify by prabhat 27-10-2020
        $builder->where('Class', $class);
        $builder->where('Semester', $semester);
        $builder->where('Term', '');
        $builder->orderBy('Course', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }


    function getEmailByID($EmailID)
    {

        $builder = $this->db->table('email');
        $builder->select('*');
        $builder->where('EmailID', $EmailID);
        $builder->where('EmailID != 0');
        /*$this->db->order_by("Email_RowID", "DESC");
        $this->db->limit(1);*/
        $query = $builder->get();
        //echo $this->db->last_query();die;		
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getEmailByIDD($EmailID)
    {

        $builder = $this->db->table('email');
        $builder->select('*');
        $builder->where('EmailID', $EmailID);
        $builder->where('EmailID != 0');
        $builder->where('Active', 1);
        $builder->orderBy("Email_RowID", "DESC");
        //$this->db->limit(1);
        $query = $builder->get();
        //echo $this->db->last_query();die;		
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getGroupByID($NameLink)
    {

        $builder = $this->db->table('groups');
        $builder->select('*');
        $builder->where('NameLink', $NameLink);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function enrolled_class_semester_in_certificate($ID, $class = '', $semester = '')
    {
        $builder = $this->db->table('CertTranscript t');
        $builder->distinct();
        $builder->select('c.Class,c.Semester,sd.order_no');
        $builder->join('Certificates c', ' t.certID = c.certID AND t.StudentID =' . $ID, 'INNER');
        $builder->join('semester_details sd', 'sd.semester = c.Semester');
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        if ($class != '') {
            $builder->where('c.Class', $class);
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }
        if ($this->request->getPost('payment_from') != '') {
            $builder->where('c.start_date >=', date('Y-m-d', strtotime($this->request->getPost('payment_from'))));
        }
        if ($this->request->getPost('payment_to') != '') {
            $builder->where('c.end_date <=', date('Y-m-d', strtotime($this->request->getPost('payment_to'))));
        }
        $builder->orderBy('c.Class', 'ASC');
        $builder->orderBy('sd.order_no', 'ASC');
        return $builder->get()->getResultArray();
    }

    function enrolled_class_semester($ID, $class = '', $semester = '')
    {
        $builder = $this->db->table('transcript t');
        $builder->distinct();
        $builder->select('c.Class,c.Semester,sd.order_no');
        $builder->join('courselist c', ' t.CourseID = c.CourseID AND t.StudentID =' . $ID, 'INNER');
        $builder->join('semester_details sd', 'sd.semester = c.Semester');
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        if ($class != '') {
            $builder->where('c.Class', $class);
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }
        if ($this->request->getPost('payment_from') != '') {
            $builder->where('c.start_date >=', date('Y-m-d', strtotime($this->request->getPost('payment_from'))));
        }
        if ($this->request->getPost('payment_to') != '') {
            $builder->where('c.end_date <=', date('Y-m-d', strtotime($this->request->getPost('payment_to'))));
        }
        $builder->orderBy('c.Class', 'ASC');
        $builder->orderBy('sd.order_no', 'ASC');
        return $builder->get()->getResultArray();
    }

    function get_all_transaction_by_student_id($student_id)
    {
        $builder = $this->db->table('student_finance_order');
        $builder->distinct();
        return $builder->select('created,way,paid_amount')
            ->Where('student_id', $student_id)
            ->where('payment_status', 'succeeded')
            ->get()
            ->getResultArray();
    }

    function getDonationDetails($ID)
    {

        $builder = $this->db->table('donations');
        $builder->select('*');
        $builder->where('DonorID', $ID);
        $builder->where('(DeleteStatus IS NULL OR DeleteStatus = "")');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getWithoutTuitionDonationDetails($ID)
    {

        $builder = $this->db->table('donations');
        $builder->select('*');
        $builder->where('DonorID', $ID);
        $builder->where('(DeleteStatus IS NULL OR DeleteStatus = "")');
        $builder->where('Campaign !=', '18');
        $builder->where('Campaign !=', '26');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function contract_employee($ID)
    {
        $builder = $this->db->table('tblcontract');
        return $builder->select('*')
            ->where('empid', $ID)
            ->where('(DeleteStatus IS NULL OR DeleteStatus = "")')
            ->get()
            ->getResultArray();
    }

    function getCompleteRegion()
    {

        $builder = $this->db->table('regionprogram');
        $builder->select('*');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getStudentName($ID)
    {

        $builder = $this->db->table('name');
        $builder->select('*');
        $builder->where('ID', $ID);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return false;
        }
    }

    function getAllClass()
    {

        $builder = $this->db->table('class');
        $builder->select('*');
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('Class', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getAllClassCertificates()
    {

        $builder = $this->db->table('class');
        $builder->select('*');
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('Class', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getAllActiveOrganization()
    {
        $builder = $this->db->table('tbl_organization');
        return $builder->select('*')
            ->where('status', '1')
            ->get()
            ->getResultArray();
    }

    function getAssignOrganization($ID)
    {
        $builder = $this->db->table('BoardInfo as ab');
        return $builder->select('ab.id as assign_id,ab.org_id,o.name,ab.start_date,ab.end_date')
            ->join('tbl_organization as o', 'o.id = ab.org_id')
            ->where('ab.name_id', $ID)
            ->where('ab.Deletestatus', '0')
            ->where('status', '1')
            ->get()
            ->getResultArray();
    }

    function getAllActivePartner()
    {
        $builder = $this->db->table('partner_organization');
        return $builder->select('*')
            ->where('Active', '1')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();
    }

    function getActiveProgramName($program_id)
    {

        $builder = $this->db->table('mst_program');
        $builder->select('*');
        $builder->where('status', 1);
        $builder->where('ProgramID', $program_id);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function assign_class($student_id)
    {
        $builder = $this->db->table('transcript as t');
        $builder->distinct();
        return $builder->select('c.Class')
            ->join('courselist as c', 'c.CourseID = t.CourseID')
            ->where('t.StudentID', $student_id)
            ->where('(t.Deletestatus IS NULL OR t.Deletestatus =0)')
            ->orderBy('c.Class', 'Desc')
            ->get()
            ->getResultArray();
    }

    function cert_assign_class($student_id)
    {
        $builder = $this->db->table('CertTranscript as t');
        $builder->distinct();
        return $builder->select('c.Class')
            ->join('Certificates as c', 'c.certID = t.certID')
            ->where('t.StudentID', $student_id)
            ->where('c.Class !=', '')
            ->where('(t.Deletestatus IS NULL OR t.Deletestatus =0)')
            ->orderBy('c.Class', 'Desc')
            ->get()
            ->getResultArray();
    }

    function checkStudentRecord($studentid)
    {

        $builder = $this->db->table('name');
        $builder->select('*');
        $builder->where('ID', $studentid);
        $query = $builder->get();
        $getNumRows = $query->getNumRows();
        return $getNumRows;
    }


    function getStudentInfoDetails($ID)
    {

        $builder = $this->db->table('student_info');
        $builder->select('*');
        $builder->where('StudentInfoID', $ID);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getSemesterTerm($class)
    {

        $builder = $this->db->table('courselist');
        $builder->distinct();
        $builder->select('concat(semester," ",Term) as semester');
        $builder->where('Class', $class);
        $builder->orderBy('Term');
    }

    // get last insert id of student details.
    function getStudentMaxId($studentinfoid)
    {

        $builder = $this->db->table('student_info');
        $response = array();
        $builder->select('max(Student_RowID) as last_id');
        $builder->where('StudentInfoID', $studentinfoid);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            $student_lastid = $query->getRowArray();
            $last_id = $student_lastid['last_id'];
            $response['last_id'] = $last_id;
            $response['msg'] = 'EXIST';
        } else {
            $response['msg'] = 'NOT EXIST';
        }
        return $response;
    }


    function get_student_finance_certificate($student_id)
    {

        $builder = $this->db->table('CertTranscript t');
        $builder->distinct();
        $builder->select('c.certID, c.CertName,c.class, c.semester, c.cert_no, sd.order_no,
	                       CASE WHEN c.Credits = "N/A" THEN (c.tution)
	                       ELSE (c.tution*c.Credits)
	                       END as total');
        $builder->join('Certificates c', ' t.certID = c.certID', 'INNER');
        $builder->join('semester_details sd', 'sd.semester = c.Semester', 'left');
        // $builder->join('applicationscholarship as sc', 'sc.year = c.class and sc.semester = c.semester and sc.deleteStatus = 0 and sc.student_id ='.$student_id, 'left');
        $builder->where('t.studentID', $student_id);
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        if ($this->request->getPost('filter_year') != '') {
            $builder->where('c.Class', $this->request->getPost('filter_year'));
        }
        if ($this->request->getPost('filter_semester') != '') {
            $builder->where('c.Semester', $this->request->getPost('filter_semester'));
        }


        $builder->orderBy('c.class', 'ASC');
        $builder->orderBy('sd.order_no', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    function get_student_finance_detail2($student_id)
    {
        $StudentCredit = "Student Credit";

        $builder = $this->db->table('transcript t');
        $builder->distinct();
        $builder->select('sd.order_no,c.CourseID,c.CourseTitle, c.Class, c.Semester, c.Course,c.CourseTitle,t.Grade,refund_amount,
	    CASE
            WHEN t.Grade = "w" THEN (c.tution*c.Credits)-(((c.tution*c.Credits)*refund_amount)/100)
            WHEN t.Grade = "AUDIT" THEN (c.audit_rate*c.Credits)
            ELSE (c.tution*c.Credits)
            END as total');
        $builder->join('courselist c', ' t.CourseID = c.CourseID', 'INNER');
        $builder->join('semester_details sd', 'sd.semester = c.Semester');
        // $builder->join('donations as d','d.course_id = c.CourseID AND PaymentType = "('.$StudentCredit.')" AND d.DonorID = '.$student_id,'LEFT');
        $builder->where('t.StudentID', $student_id);
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        if ($this->request->getPost('filter_year') != '') {
            $builder->where('c.Class', $this->request->getPost('filter_year'));
        }
        if ($this->request->getPost('filter_semester') != '') {
            $builder->where('c.Semester', $this->request->getPost('filter_semester'));
        }
        if ($this->request->getPost('payment_from') != '') {
            $builder->where('c.start_date >=', date('Y-m-d', strtotime($this->request->getPost('payment_from'))));
        }
        if ($this->request->getPost('payment_to') != '') {
            $builder->where('c.end_date <=', date('Y-m-d', strtotime($this->request->getPost('payment_to'))));
        }
        $builder->orderBy('c.Class', 'ASC');
        $builder->orderBy('sd.order_no', 'ASC');

        $query = $builder->get();
        return $query->getResultArray();
    }

    function get_student_enroll_class_semester($student_id)
    {
        $builder = $this->db->table('transcript as t');
        $builder->distinct();
        $builder->select('c.Class,c.Semester,sc.id,sc.amtpercredit,sc.amtpernoncredit, sc.notes,sc.americorps_segal,sc.coverdell,sc.institutional')
            ->join('courselist as c', 'c.CourseID = t.CourseID AND t.StudentID =' . $student_id)
            ->join('applicationscholarship as sc', 'sc.year = c.Class AND sc.semester = c.Semester AND sc.deleteStatus = 0 AND sc.student_id =' . $student_id, 'left');
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        return $builder->where($deletestatus)
            ->orderBy('c.Class', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getScholarshipApplications($studentId)
    {
        return $this->db->table('applicationscholarship')
            ->where('student_id', $studentId)
            ->where('deleteStatus', 0)
            ->get()
            ->getResultArray();
    }

    function get_user_conatct_tag_details($ID)
    {

        $builder = $this->db->table('tbl_contact_tag');
        return $builder->select('*')
            ->where('name_id', $ID)
            ->orderBy('id', 'desc')
            ->get()
            ->getResultArray();
    }

    public function get_component($scheme_id)
    {
        $data = [];
        $scheme_id = test_input($scheme_id);

        $builder = $this->db->table('mst_scheme_component');
        $builder->select();
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

    function get_all_user_number($ID)
    {
        $builder = $this->db->table('USPhone as up');
        return $builder->select('up.*,pt.PhoneType')
            ->join('PhoneType as pt', 'pt.Id = up.Type')
            ->where('up.Id', $ID)
            ->get()
            ->getResultArray();
    }

    function check_current_employee($ID)
    {
        $builder = $this->db->table('tblcontract');
        return $builder->select('*')
            ->where('empid', $ID)
            ->where('contract_end_date >=', date('Y-m-d'))
            ->where('(DeleteStatus IS NULL OR DeleteStatus = "")')
            ->get()
            ->getResultArray();
    }

    function check_graduation($ID)
    {
        $builder = $this->db->table('student_info');
        $builder->select('*');
        $builder->where('StudentInfoID', $ID);
        $builder->where('Graduation IS NOT NULL');
        $builder->where('Graduation !=', '');
        $deletestatus = "(Deletestatus is NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    public function getEmployeeRecord($id)
    {

        $builder = $this->db->table('employee_data');
        $builder->select('*');
        $builder->where('Name_id', $id);
        $query = $builder->get();
        if ($query->getNumRows()) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getEmploymentRecord()
    {

        $builder = $this->db->table('tbl_employment_record_attachment');
        $builder->select('*');
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getEmploymentRecordID($studentid)
    {

        $builder = $this->db->table('tbl_employment_record_attachment as emp');
        $builder->select('emp.*,d.type');
        $builder->join('DocumentType as d', 'd.id = emp.document_type', 'left');
        $builder->where('emp.student_id', $studentid);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getStudentRecord()
    {

        $builder = $this->db->table('tbl_student_record_attachment');
        $builder->select('*');
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $query = $builder->get();
        //echo $this->db->last_query(); die;
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getAllactiveGrade()
    {

        $builder = $this->db->table('grades');
        $builder->select('ROWID,Grade');
        $builder->where('Active', 1);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {

            return $query->getResultArray();
        } else {

            return array();
        }
    }

    function getTranscriptByID($ID)
    {
        //echo $ID;

        $builder = $this->db->table('transcript t');
        $builder->select('*,t.Grade');
        $builder->join('courselist c', ' t.CourseID = c.CourseID', 'INNER');
        //$builder->join('grades g', 't.Grade = g.Grade','INNER');
        $builder->join('mst_grades_class mgc', 'c.Class = mgc.class and t.Grade = mgc.Grade', 'LEFT');
        $builder->where('t.StudentID', $ID);
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('c.Class', 'desc');
        $builder->orderBy('c.Term', 'desc');
        $query = $builder->get();
        //echo $builder->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getDonationPaymentByID($DonorID)
    {

        $builder = $this->db->table('donations');
        $builder->select('*');
        $builder->where('DonorID', $DonorID);
        $builder->where('(DeleteStatus IS NULL OR DeleteStatus = "")');
        // Start Fwd: Sort on donation /payment tab 16-10-2023 
        //$builder->order_by("ReceivedDate", "desc");
        $order_sql = 'STR_TO_DATE(ReceivedDate,"%d-%m-%Y") desc';
        $builder->orderBy($order_sql);
        // End Fwd: Sort on donation /payment tab 16-10-2023 
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function update_group_history()
    {
        $deceased = 0;

        $builder = $this->db->table('name');
        $builder->select('Deceased');
        $builder->where('ID', $this->request->getPost('user_id'));

        $n_query = $builder->get();
        if ($n_query->getNumRows() >= 1) {
            $descrease_result = $n_query->getRowArray();
            $deceased   = $descrease_result['Deceased'];
        }

        // update group history if data exits
        $builder2 = $this->db->table('groups');
        $builder2->select('*');
        $builder2->where('NameLink', $this->request->getPost('user_id'));
        $query = $builder2->get();
        if ($query->getNumRows() >= 1) {
            $result = $query->getRowArray();
            $data = array(
                'Group_RowID' => $result['Group_RowID'],
                'NameLink'  => $result['NameLink'],
                'Donor' => $result['Donor'],
                'Foundation' => $result['Foundation'],
                'Media' => $result['Media'],
                'Appalachian' => $result['Appalachian'],
                'BoardMember' => $result['BoardMember'],
                'FacultyStaff' => $result['FacultyStaff'],
                'StudentFamily' => $result['StudentFamily'],
                'AnnualReport' => $result['AnnualReport'],
                'DanielVIP' => $result['DanielVIP'],
                // start Fwd: FW: Mailchimp Audience Export Complete
                'ProspectiveStudent' => $result['ProspectiveStudent'],
                // End Fwd: FW: Mailchimp Audience Export Complete
                'FriendofDaniel' => $result['FriendofDaniel'],
                'DanielPermissionNeeded' => $result['DanielPermissionNeeded'],
                'GraduationInvite' => $result['GraduationInvite'],
                'QuarterCenturyReport' => $result['QuarterCenturyReport'],
                //'Unsubscribed' => $result['Unsubscribed'],
                'Vista' => $result['Vista'],
                'Deceased'    => $deceased,
                'created_by'   => $this->session->userdata('USER_ID'),
                'created_ip'           => $_SERVER['REMOTE_ADDR'],
                'created_date'  => date('Y-m-d h:i:s'),
                'accthold' =>  $result['accthold'],
                'ProspectiveStudent' => $result['ProspectiveStudent'],
                'prospective_donor' => $result['prospective_donor']
            );

            $builder3 = $this->db->table('groups_history');
            $query = $builder3->insert($data);
            if ($query) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    function submitUserRole()
    {

        $user_role = array_values(array_filter($this->request->getPost('role_val')));
        $param = array();
        $builder = $this->db->table('name');
        foreach ($user_role as $key => $val) {

            if ($val != 'Deceased') {
                $param[$val] = '1';
            }
        }

        if (in_array("Deceased", $user_role)) {
            $decease_data['Deceased'] = '1';
            $builder->where('ID', $this->request->getPost('user_id'));
            $builder->update('name', $decease_data);
        } else {
            $decease_data['Deceased'] = '0';
            $builder->where('ID', $this->request->getPost('user_id'));
            $builder->update('name', $decease_data);
        }

        $builder2 = $this->db->table('groups');
        $builder2->select('*');
        $builder2->where('NameLink', $this->request->getPost('user_id'));
        $query = $builder2->get();
        if ($query->getNumRows() >= 1) {
            // zero for every column
            $old_data = array(
                'Donor' => '0',
                'Foundation' => '0',
                'Media' => '0',
                'Appalachian' => '0',
                'BoardMember' => '0',
                'FacultyStaff' => '0',
                'StudentFamily' => '0',
                'AnnualReport' => '0',
                'DanielVIP' => '0',
                'FriendofDaniel' => '0',
                'DanielPermissionNeeded' => '0',
                'GraduationInvite' => '0',
                'QuarterCenturyReport' => '0',
                // 'Unsubscribed' => '0',
                'Vista' => '0',
                /*start 08-Feb-2024*/
                'tribal_college' => '0',
                'hbcu' => '0',
                'wv_college' => '0',
                'appalachia_college' => '0',
                'us_college' => '0',
                'americorps' => '0',
                'peacecorps' => '0',
                'accthold' => '0',
                'ProspectiveStudent' => '0',
                'prospective_donor' => '0'
                /*end 08-Feb-2024*/
            );

            $builder2->where('NameLink', $this->request->getPost('user_id'));
            $builder2->update('groups', $old_data);

            $builder2->where('NameLink', $this->request->getPost('user_id'));
            $query = $builder2->update('groups', $param);
            if ($query) {
                return true;
            } else {
                return false;
            }
        } else {
            if (!empty($param)) {
                $param['NameLink'] = $this->request->getPost('user_id');
                $query = $builder2->insert($param);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }
    }

    function total_contact_user()
    {
        $builder = $this->db->table('name');
        $builder->select('*');
        $query = $builder->get();
        return $query->getNumRows();
    }


    function total_faculity_count()
    {
        $builder = $this->db->table('name as n');
        $builder->select('n.id');
        $builder->join('tblcontract as c', 'c.empid = n.id');
        $builder->where("(c.deletestatus IS NULL OR c.deletestatus != '1')");
        $query = $builder->get();
        return $query->getNumRows();
    }

    function total_active_faculity()
    {
        $builder = $this->db->table('name as n');
        $builder->distinct();
        $builder->select('n.ID');
        $builder->join('tblcontract as c', 'c.empid = n.ID');
        $builder->where('contract_end_date >=', date('Y-m-d'));
        $builder->where("(c.deletestatus IS NULL OR c.deletestatus != '1')");
        $query = $builder->get();
        return $query->getNumRows();
    }

    function total_inactive_faculity()
    {
        $builder = $this->db->table('name as n');
        $builder->distinct();
        $builder->select('n.ID');
        $builder->join('tblcontract as c', 'c.empid = n.ID');
        $builder->where('contract_end_date <=', date('Y-m-d'));
        $builder->where("(c.deletestatus IS NULL OR c.deletestatus != '1')");
        $builder->where('c.empid NOT IN (select empid from tblcontract where contract_end_date >= "' . date('Y-m-d') . '")');
        $query = $builder->get();
        return $query->getNumRows();
    }

    function total_current_student()
    {
        $builder = $this->db->table('name as n');
        $builder->distinct();
        $builder->select('n.ID');
        $builder->join('transcript as t', "t.StudentID = n.ID AND (t.Deletestatus IS NULL OR t.Deletestatus != '1')");
        $builder->join('student_info as si', "si.StudentInfoID = n.ID", "left");
        $builder->where("t.StudentID NOT IN (select StudentInfoID FROM student_info as s2 where (s2.Graduation IS NOT NULL AND s2.Graduation != ''))");
        $query = $builder->get();
        return $query->getNumRows();
    }

    function total_formal_student()
    {
        $builder = $this->db->table('name as n');
        $builder->distinct();
        $builder->select('n.ID');
        $builder->join('transcript as t', "t.StudentID = n.ID AND (t.Deletestatus IS NULL OR t.Deletestatus != '1')");
        $builder->join('student_info as si', "si.StudentInfoID = n.ID", "left");
        $builder->where("t.StudentID IN (select StudentInfoID FROM student_info as s2 where (s2.Graduation IS NOT NULL AND s2.Graduation != ''))");
        $query = $builder->get();
        return $query->getNumRows();
    }

    function total_finance_amount()
    {
        $builder = $this->db->table('donations');
        $builder->select("sum(Amount) as total_amount");
        $builder->where("(Deletestatus IS NULL OR Deletestatus != '1')");
        //$this->db->where('Campaign NOT IN ("18","22","23","24","26")');
        $query = $builder->get();
        return $query->getRowArray();
    }

    function total_donation_amount()
    {
        $builder = $this->db->table('donations');
        $builder->select("sum(Amount) as total_amount");
        $builder->where("(Deletestatus IS NULL OR Deletestatus != '1')");
        $builder->where('Campaign NOT IN ("18","22","23","24","26")');
        $query = $builder->get();
        return $query->getRowArray();
    }

    function total_tuition_amount()
    {
        $builder = $this->db->table('donations');
        $builder->select("sum(Amount) as total_amount");
        $builder->where("(Deletestatus IS NULL OR Deletestatus != '1')");
        $builder->where('Campaign', "18");
        $query = $builder->get();
        return $query->getRowArray();
    }

    function total_studentRefund_amount()
    {
        $builder = $this->db->table('donations');
        $builder->select("sum(Amount) as total_amount");
        $builder->where("(Deletestatus IS NULL OR Deletestatus != '1')");
        $builder->where('Campaign', "22");
        $query = $builder->get();
        return $query->getRowArray();
    }

    function total_studentCredit_amount()
    {
        $builder = $this->db->table('donations');
        $builder->select("sum(Amount) as total_amount");
        $builder->where("(Deletestatus IS NULL OR Deletestatus != '1')");
        $builder->where('Campaign', "23");
        $query = $builder->get();
        return $query->getRowArray();
    }

    function total_Americop_amount()
    {
        $builder = $this->db->table('donations');
        $builder->select("sum(Amount) as total_amount");
        $builder->where("(Deletestatus IS NULL OR Deletestatus != '1')");
        $builder->where('Campaign', "24");
        $query = $builder->get();
        return $query->getRowArray();
    }

    function total_certificateTuition_amount()
    {
        $builder = $this->db->table('donations');
        $builder->select("sum(Amount) as total_amount");
        $builder->where("(Deletestatus IS NULL OR Deletestatus != '1')");
        $builder->where('Campaign', "26");
        $query = $builder->get();
        return $query->getRowArray();
    }

    function total_groups_wise_count()
    {
        $sql = 'SELECT 
                  COUNT(case WHEN Vista = 1 then 1 else null end)  Vista,
                  COUNT(case WHEN AnnualReport = 1 then 1 else null end)  AnnualReport,
                  COUNT(case WHEN Media = 1 then 1 else null end)  Media,
                  COUNT(case WHEN Appalachian = 1 then 1 else null end)  Appalachian,
                  COUNT(case WHEN BoardMember = 1 then 1 else null end)  BoardMember,
                  COUNT(case WHEN StudentFamily = 1 then 1 else null end)  StudentFamily,
                  COUNT(case WHEN DanielVIP = 1 then 1 else null end)  DanielVIP,
                  COUNT(case WHEN FriendofDaniel = 1 then 1 else null end)  FriendofDaniel,
                  COUNT(case WHEN DanielPermissionNeeded = 1 then 1 else null end)  DanielPermissionNeeded,
                  COUNT(case WHEN GraduationInvite = 1 then 1 else null end)  GraduationInvite,
                  COUNT(case WHEN QuarterCenturyReport = 1 then 1 else null end)  QuarterCenturyReport,
                  COUNT(case WHEN Unsubscribed = 1 then 1 else null end)  Unsubscribed,
                  COUNT(case WHEN Foundation = 1 then 1 else null end)  Foundation,
                  COUNT(case WHEN Deceased = 1 then 1 else null end)  Deceased
               FROM `groups` as g
               JOIN name as n ON n.ID = g.NameLink';
        $query = $this->db->query($sql);
        return $query->getRowArray();
    }

    function getAllCampaignsWithAmount()
    {
        $sql = 'SELECT  cm.CampaignID,cm.CampaignName, SUM(d.Amount) as Amount FROM campaigns as cm LEFT JOIN donations as d ON (d.Campaign = cm.CampaignID) AND (d.Deletestatus IS NULL OR d.Deletestatus = 0)
        WHERE cm.Active = "1" AND (cm.Deletestatus IS NULL OR cm.Deletestatus = 0)
        GROUP BY CampaignName,cm.CampaignID';

        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function getOnlineApplicationCount()
    {
        $db = \Config\Database::connect('formbuilder');
        $currentYear = date('Y');
        $lastYear = $currentYear - 4;

        $builder = $db->table('tbl_studentAplicationData');

        $builder->select("
        YEAR(created_date) as Year,
        SUM(CASE WHEN final_status = '0' THEN final_status ELSE 0 END) AS NotSubmitted,
        SUM(CASE WHEN (final_status = '1' AND (approved_status = 0 OR approved_status IS NULL)) THEN 1 ELSE 0 END) AS submitted,
        SUM(CASE WHEN approved_status = 1 THEN 1 ELSE 0 END) AS approved
    ");

        $builder->where("YEAR(created_date) <=", $currentYear);
        $builder->where("YEAR(created_date) >=", $lastYear);
        $builder->groupBy("YEAR(created_date)");

        $query = $builder->get();
        return $query->getResultArray();
    }

    function get_organization_labels()
    {
        return $this->db->table('tbl_master_organization_label')->select('*')
            ->where('status', '1')
            ->get()
            ->getResultArray();
    }

    function getAllIndividual()
    {
        return $this->db->table('orgnization_user as ou')->select('concat(link_to.FirstName," ",link_to.LastName) as linked_name,link_to.ID as linked_id,concat(linker.FirstName," ",linker.LastName) as linker_name,linker.ID as linker_id,ou.labeled_identify,ou.valid')
            ->join('name as link_to', 'link_to.ID = ou.linked_contact_id', 'left')
            ->join('name as linker', 'linker.ID = ou.name_id')
            ->where(['ou.master_type' => 'Individual', 'ou.deletestatus' => '0'])
            ->get()
            ->getResultArray();
    }

    function profileNameList($profile_id)
    {

        $builder = $this->db->table('tbl_profile_details');
        $builder->select('GROUP_CONCAT(profile_name SEPARATOR " | ") as profiles');
        $builder->whereIn('profile_id', $profile_id);
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {

            $results = $query->getRowArray();
            $response = $results['profiles'];
        } else {

            $response = 'empty';
        }
        return $response;
    }

    function getOrganizationAddressByID($org_id)
    {

        $builder = $this->db->table('organization_address');
        $builder->select('*');
        $builder->where('AddressID', $org_id);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getOrganizationInterAddressByID($org_id)
    {

        $builder = $this->db->table('organization_address_international');
        $builder->select('*');
        $builder->where('AddressID_int', $org_id);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function get_organization_by_id($ID)
    {
        return $this->db->table('organization')->select('*')
            ->where('id', $ID)
            ->get()
            ->getRowArray();
    }

    function get_all_organization_user_number($ID)
    {
        return $this->db->table('USOrgnizationPhone as up')->select('up.*,pt.PhoneType')
            ->join('PhoneType as pt', 'pt.Id = up.Type')
            ->where('up.Id', $ID)
            ->get()
            ->getResultArray();
    }

    function updateOrganizationInfo($param)
    {
        $result = array();
        foreach ($param as $key => $val) {
            if ($key == 'org_note') {
                $param[$key] = $val;
            } else {
                $param[$key] = test_input($val);
            }
        }
        $builder = $this->db->table('organization')->where('ID', $param['ID']);
        $query = $builder->update($param);
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function updateOrgnanizationAddressInfo($param)
    {
        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
        }
        $builder = $this->db->table('organization_address');
        $query = $builder->where('Address_RowID', $param['Address_RowID'])->update($param);
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function updateOrganizationInterAddInfo($param)
    {
        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
        }
        $query = $this->db->table('organization_address_international')->where('Address_RowID_int', $param['Address_RowID_int'])->update($param);
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function updateOrganizationPhoneInfo($param)
    {
        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
        }
        $query = $this->db->table('USOrgnizationPhone')->where('AutoId', $param['AutoId'])->update($param);
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function submitOrganizationPayement($payment)
    {
        $data = array();
        $response = array();
        foreach ($payment as $key => $val) {
            $data[$key] = test_input($val);
        }
        $query = $this->db->table('organization_donations')->insert($data);
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'INSERTED';
            $response['last_insert_id'] = $this->db->insertId();
        } else {
            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }

    function updateOrganizationPayement($payment)
    {
        $data = array();
        $response = array();
        foreach ($payment as $key => $val) {
            $data[$key] = test_input($val);
        }
        $builder = $this->db->table('organization_donations');
        $builder->where(array('Donor_RowID' => $data['Donor_RowID'], 'org_id' => $data['org_id']));
        $query = $builder->update($data);
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'UPDATED';
        } else {
            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }

    function getOrganizationDonationPaymentByID($orgID)
    {

        $builder = $this->db->table('organization_donations');
        $builder->select('*');
        $builder->where('org_id', $orgID);
        $builder->where('(DeleteStatus IS NULL OR DeleteStatus = "")');
        $builder->orderBy('ReceivedDate', 'DESC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function insertAddressInfo($param)
    {
        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
        }
        if (!recordExist($param, 'address')) {
            //echo "<pre>"; print_r($param); die;
            $res = $this->db->table('address')->insert($param);
            if ($res) {
                $result['msg'] = "INSERTED";
                $result['last_id'] = $this->db->insertId();
            } else {
                $result['msg'] = "NOT INSERTED";
            }
        } else {
            $result['msg'] = "Record Already Exists";
        }
        return $result;
    }
    function updateAddressInfo($param)
    {
        //print_r($param);die();
        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
        }
        $this->db->table('address')->where('Address_RowID', $param['Address_RowID']);
        $query = $this->db->table('address')->update($param);
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

    function insert_or_update_organization_user2($name_id, $post)
    {
        $master_organization = $post['master_relationship_type'];

        date_default_timezone_set('Asia/Kolkata');
        if (sizeof($master_organization) > 0) {
            foreach ($master_organization as $key => $org) {
                if ($org != '' && $org != null) {
                    if ($post['org_row_id'][$key] == '0') {
                        if ($org == 'Individual') {
                            $data = array(
                                'name_id' => $name_id,
                                'master_type' => $org,
                                'org_id' => '0',
                                'rel_id' =>  '0',
                                'valid' => isset($post['org_valid'][$key]) ? '1' : '0',
                                'primary_status' => isset($post['org_primary'][$key]) ? '1' : '0',
                                'createdby' => session()->get('USER_ID'),
                                'createdip' => actual_ip(),
                                'created_date' => date('Y-m-d h:i:s'),
                                'linked_contact_id' =>  $post['linkerId'][$key],
                                'labeled_identify' => $post['labled_indetifier'][$key]
                            );
                            $this->db->table('orgnization_user')->insert($data);
                        } else if ($org == 'Organization') {
                            $data = array(
                                'name_id' => $name_id,
                                'master_type' => $org,
                                'org_id' => $post['organization'][$key],
                                'rel_id' =>  $post['relationship'][$key],
                                'valid' => isset($post['org_valid'][$key]) ? '1' : '0',
                                'primary_status' => isset($post['org_primary'][$key]) ? '1' : '0',
                                'createdby' => session()->get('USER_ID'),
                                'createdip' => actual_ip(),
                                'created_date' => date('Y-m-d h:i:s'),
                                'linked_contact_id' =>  '0',
                                'labeled_identify' => ''
                            );
                            $this->db->table('orgnization_user')->insert($data);
                        }
                    } else {
                        if ($org == 'Individual') {
                            $data = array(
                                'name_id' => $name_id,
                                'master_type' => $org,
                                'org_id' => '0',
                                'rel_id' =>  '0',
                                'valid' => isset($post['org_valid'][$key]) ? '1' : '0',
                                'primary_status' => isset($post['org_primary'][$key]) ? '1' : '0',
                                'modified_by' => session()->get('USER_ID'),
                                'modified_ip' => actual_ip(),
                                'modified_date' => date('Y-m-d h:i:s'),
                                'linked_contact_id' =>  $post['linkerId'][$key],
                                'labeled_identify' => $post['labled_indetifier'][$key]
                            );
                            $this->db->table('orgnization_user')->where('id', $post['org_row_id'][$key]);
                            $this->db->table('orgnization_user')->update($data);
                        } else if ($org == 'Organization') {
                            $data = array(
                                'name_id' => $name_id,
                                'master_type' => $org,
                                'org_id' => $post['organization'][$key],
                                'rel_id' =>  $post['relationship'][$key],
                                'valid' => isset($post['org_valid'][$key]) ? '1' : '0',
                                'primary_status' => isset($post['org_primary'][$key]) ? '1' : '0',
                                'modified_by' => session()->get('USER_ID'),
                                'modified_ip' => actual_ip(),
                                'modified_date' => date('Y-m-d h:i:s'),
                                'linked_contact_id' =>  '0',
                                'labeled_identify' => ''
                            );
                            $this->db->table('orgnization_user')->where('id', $post['org_row_id'][$key]);
                            $this->db->table('orgnization_user')->update($data);
                        }
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

    function insertInterAddInfo($param)
    {
        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
            if (!recordExist($param, 'address_international')) {
                $res = $this->db->table('address_international')->insert($param);
                if ($res) {
                    $result['msg'] = "INSERTED";
                    $result['last_id'] = $this->db->insertId();
                } else {
                    $result['msg'] = "NOT INSERTED";
                }
            } else {
                $result['msg'] = "Record Already Exists";
            }
            return $result;
        }
    }
    function updateInterAddInfo($param)
    {

        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
        }
        $this->db->table('address_international')->where('Address_RowID_int', $param['Address_RowID_int']);
        $query = $this->db->table('address_international')->update($param);
        if ($query) {
            $result['status'] = true;
            $result['msg'] = 'UPDATED';
        } else {
            $result['status'] = false;
            $result['msg'] = $this->db->error()['message'];
        }
        return $result;
    }

    function insertGeneralInfo($param)
    {
        $result = array();
        $res = $this->db->table('name')->insert($param);
        if ($res) {
            $result['msg'] = "INSERTED";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT INSERTED";
        }
        return $result;
    }

    function updateGeneralInfo($param)
    {
        //print_r($param);die();
        $result = array();

        foreach ($param as $key => $val) {
            if ($key != 'Note' && $key != 'boardHistory')
                $param[$key] = test_input($val);
        }
        $this->db->table('name')->where('ID', $param['ID']);
        $query = $this->db->table('name')->update($param);
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

    function check_duplicate_email($ID = '')
    {
        $post = $this->request->getPost();
        $fil_email = array();
        array_push($fil_email, "");
        foreach ($post['EmailActive'] as $key => $em) {
            array_push($fil_email, $post = $this->request->getPost('Email')[$key]);
        }

        if (!empty(array_filter($fil_email))) {
            $builder = $this->db->table('email as e');
            $builder->select('e.*');
            $builder->join('name as n', 'n.ID = e.EmailID');
            $builder->whereIn('e.Email', array_filter($fil_email));
            if ($ID != '') {
                $builder->where('EmailID !=', $ID);
            }
            $builder->where('Active', 1);
            $builder->where('EmailID !=', 0);
            $query = $builder->get();
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function get_crm_organization_by_userid($name_id)
    {
        return $this->db->table('orgnization_user as ou')->select('ou.id,ou.rel_id,ou.org_id,o.name as org_name,ou.master_type,ou.master_type,ou.labeled_identify,ou.linked_contact_id,rt.name as rel_name,valid,primary_status,n.FirstName,n.LastName')
            ->join('organization as o', 'o.id = ou.org_id', 'left')
            ->join('relationship_type as rt', 'rt.id = ou.rel_id', 'left')
            ->join('name as n', 'n.ID = ou.linked_contact_id', 'left')
            ->where('name_id', $name_id)
            ->where('deletestatus', '0')
            ->get()
            ->getResultArray();
    }

    function getContactAttachment($ID)
    {
        return $this->db->table('tbl_contact_attachment as ca')->select('ca.*,al.admin_fullname')
            ->join('admin_login as al', 'al.admin_id = ca.created_by')
            ->where(['ca.status' => '1', 'ca.name_id' => $ID])
            ->get()
            ->getResultArray();
    }

    function getAllContact()
    {
        return $this->db->table('name')->select('ID,FirstName,LastName')
            ->get()
            ->getResultArray();
    }

    function insertOrganizationInfo($param)
    {
        $result = array();
        $res = $this->db->table('organization')->insert($param);
        if ($res) {
            $result['msg'] = "INSERTED";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT INSERTED";
        }
        return $result;
    }

    function insertOrrganizationInterAddInfo($param)
    {
        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
            if (!recordExist($param, 'organization_address_international')) {
                $res = $this->db->table('organization_address_international')->insert($param);
                if ($res) {
                    $result['msg'] = "INSERTED";
                    $result['last_id'] = $this->db->insertId();
                } else {
                    $result['msg'] = "NOT INSERTED";
                }
            } else {
                $result['msg'] = "Record Already Exists";
            }
            return $result;
        }
    }

    function insertOrganizationPhoneInfo($phone_param)
    {
        $result = array();
        foreach ($phone_param as $key => $val) {
            $phone_param[$key] = test_input($val);
        }
        $res = $this->db->table('USOrgnizationPhone')->insert($phone_param);
        if ($res) {
            $result['msg'] = "INSERTED";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT INSERTED";
        }
        return $result;
    }


    function getTotalOrganizationDonationPaymentByID($orgID)
    {
        $builder = $this->db->table('organization_donations');
        $builder->select('sum(Amount) as totalOrgDonation');
        $builder->where('org_id', $orgID);
        $builder->where('(DeleteStatus IS NULL OR DeleteStatus = "")');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }


    public function delete_organization_donation($id)
    {
        return $this->db->table('organization_donations')
            ->where('Donor_RowID', $id)
            ->delete();
    }

    function get_organization_user($ID)
    {
        return $this->db->table('orgnization_user as ou')->select('n.ID,n.FirstName,n.LastName,n.Spouse,n.Company,n.Position,rt.name as rel_name,ou.Valid,ou.primary_status')
            ->join('name as n', 'n.ID = ou.name_id')
            ->join('relationship_type as rt', 'rt.id = ou.rel_id')
            ->where('ou.org_id', $ID)
            ->where('deletestatus', '0')
            ->get()
            ->getResultArray();
    }

    function insert_or_update_organization_label($ID)
    {
        $builder = $this->db->table('tbl_organization_label');
        $update_label_param = array('status' => '0');
        $builder->where('organization_id', $ID)->update($update_label_param);

        $labelInput = $this->request->getPost('role_val');
        foreach ($labelInput as $label) {
            $result = $builder
                ->select('*')
                ->where('organization_id', $ID)
                ->where('label_id', $label)
                ->get()
                ->getResultArray();

            if (empty($result)) {
                $insert_param = array();
                $insert_param['organization_id'] = $ID;
                $insert_param['label_id'] = $label;
                $insert_param['status'] = '1';
                $insert_param['ip'] = actual_ip();
                $this->db->table('tbl_organization_label')->insert($insert_param);
            } else {
                $update_param = array();
                $update_param['organization_id'] = $ID;
                $update_param['label_id'] = $label;
                $update_param['label_id'] = $label;
                $update_param['status'] = '1';
                $update_param['ip'] = actual_ip();
                $builder->where(['organization_id' => $ID, 'label_id' => $label])->update($update_param);
            }
        }
    }

    function get_organization_selected_labels($ID)
    {
        return $this->db->table('tbl_organization_label as ol')->select('mst_label.*')
            ->join('tbl_master_organization_label as mst_label', 'mst_label.id = ol.label_id')
            ->where(['ol.status' => '1', 'ol.organization_id' => $ID])
            ->get()
            ->getResultArray();
    }

    function insert_or_update_organization_user($name_id, $post)
    {
        $organization = $post['organization'];
        date_default_timezone_set('Asia/Kolkata');
        if (sizeof($organization) > 0) {
            foreach ($organization as $key => $org) {
                if ($org != '' && $org != null) {

                    if ($post['org_row_id'][$key] == '0') {
                        $data = array(
                            'name_id' => $name_id,
                            'org_id' => $org,
                            'rel_id' =>  $post['relationship'][$key],
                            'valid' => isset($post['org_valid'][$key]) ? '1' : '0',
                            'primary_status' => isset($post['org_primary'][$key]) ? '1' : '0',
                            'createdby' => session()->get('USER_ID'),
                            'createdip' => actual_ip(),
                            'created_date' => date('Y-m-d h:i:s')
                        );
                        $this->db->table('orgnization_user')->insert($data);
                    } else {
                        $data = array(
                            'name_id' => $name_id,
                            'org_id' => $org,
                            'rel_id' =>  $post['relationship'][$key],
                            'valid' => isset($post['org_valid'][$key]) ? '1' : '0',
                            'primary_status' => isset($post['org_primary'][$key]) ? '1' : '0',
                            'modified_by' => session()->get('USER_ID'),
                            'modified_ip' => actual_ip(),
                            'modified_date' => date('Y-m-d h:i:s')
                        );

                        $this->db->table('orgnization_user')->where('id', $post['org_row_id'][$key]);
                        $this->db->table('orgnization_user')->update($data);
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

    function insertOrgnanizationAddressInfo($param)
    {
        $result = array();
        foreach ($param as $key => $val) {
            $param[$key] = test_input($val);
        }

        $res = $this->db->table('organization_address')->insert($param);
        if ($res) {
            $result['msg'] = "INSERTED";
            $result['last_id'] = $this->db->insertId();
        } else {
            $result['msg'] = "NOT INSERTED";
        }

        return $result;
    }

    function getAllOrganizationCampaigns()
    {

        $builder = $this->db->table('organization_campaigns');
        $builder->select('*');
        $builder->where('Active', 1);
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('CampaignName', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getIndividualbyOrganizationId($org_id)
    {
        $builder = $this->db->table('orgnization_user as ou1 ');
        $builder->distinct();
        $builder->select('n.FirstName,n.LastName,ou2.*');
        $builder->join('orgnization_user as ou2', 'ou2.name_id = ou1.name_id');
        $builder->join('name as n', 'n.ID = ou2.linked_contact_id');
        $builder->where(['ou1.org_id' => $org_id, 'ou2.master_type' => 'Individual']);
        return $builder->get()->getResultArray();
    }

    function getCampaingnsOrganizationNameByID($campaignsid)
    {

        $builder = $this->db->table('organization_campaigns');
        $builder->select('*');
        $builder->where('CampaignID', $campaignsid);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return false;
        }
    }

    function getLoggedInUserNameById($userid)
    {

        $builder = $this->db->table('admin_login');
        $builder->select('*');
        $builder->where('admin_id', $userid);

        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getAllCertificates()
    {

        $builder = $this->db->table('Certificates');
        $builder->select('*');
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('certID', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function get_diploma()
    {
        return $this->db->table('Diploma')->select('*')
            ->where('Active', 1)
            ->get()
            ->getResultArray();
    }

    function getallSemester()
    {

        $query = $this->db->query("select distinct Semester from courselist ORDER By Semester");
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getAllCertificates2()
    {

        $builder = $this->db->table('Certificates');
        $builder->select('*');
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('CertName', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getEmploymentRecInfo($NameID)
    {
        $builder = $this->db->table('tbl_employment_record_attachment as emp');
        $builder->select('emp.*,d.type');
        $builder->join('DocumentType as d', 'd.id = emp.document_type', 'left');
        $builder->where('emp.student_id', $NameID);
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);

        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function DeleteEmployeementRecord($employementIDDDD)
    {

        $builder = $this->db->table('EmploymentData');
        $query = $builder->where('id', $employementIDDDD);
        $query = $builder->update(array('Deletestatus' => 1));
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'DELETED';
            $response['last_insert_id'] = $this->db->insertId();
        } else {
            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }

    function getUniqueAddress($id)
    {

        $builder = $this->db->table('address A');
        $builder->select('A.Street_Address, A.City, A.Postal_Code, s.StateName,c.CountryName,A.Address2');
        $builder->join('state s', 'A.State=s.StateID', 'INNER');
        $builder->join('country c', 'A.Country=c.CountryID', 'INNER');
        $builder->where('A.AddressID', $id);
        $builder->where('A.Active', 1);
        $builder->orderBy('A.AddressID', 'desc');
        //$builder->limit(1);
        $query = $builder->get();
        // echo $builder->last_query(); die('xchcdgfgdgfgdfgjd');
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function get_user_detail_by_id($student_id)
    {
        $sql = "SELECT * FROM name where ID=$student_id";


        $query = $this->db->query($sql);
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function check_data_state($app_id)
    {
        /* return $this->db->select('*')
                      ->from('donations')
                      ->where('application_id',$app_id)
                      ->get()
                      ->getResultArray();*/

        $sql = "SELECT * FROM donations where application_id=$app_id";


        $query = $this->db->query($sql);
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function check_email_of_user($email)
    {
        $sql = "SELECT * FROM email where Email='$email' AND Active = 1";


        $query = $this->db->query($sql);
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }


    function get_tuition_detail($ID)
    {

        $builder = $this->db->table('donations as d');
        $builder->select('d.*,c.CampaignName,ad.admin_fullname');
        $builder->join('campaigns as c', 'c.CampaignID = d.Campaign');
        $builder->join('admin_login as ad', 'ad.admin_id = d.	added_by');
        $builder->where('d.DonorID', $ID);
        $builder->where('d.DonorID', $ID);
        $builder->where('d.Campaign', '18');
        $builder->where('(d.DeleteStatus IS NULL OR d.DeleteStatus = "")');
        $app_condition = "(d.application_id IS NULL OR d.application_id = 0)";
        $builder->where($app_condition);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function update_donation_value()
    {
        $data = array(
            'application_id' => $this->request->getPost('app_id')
        );
        $this->db->table('donations')->where(['Donor_RowID' => $this->request->getPost('donar_id'), 'DonorID' => $this->request->getPost('emp_id')]);
        $query = $this->db->table('donations')->update($data);
        if ($query) {
            return true;
        } else {
            return false;
        }
        return true;
    }

    function get_donation_detail($ID)
    {

        $builder = $this->db->table('donations as d');
        $builder->select('d.*,c.CampaignName,ad.admin_fullname');
        $builder->join('campaigns as c', 'c.CampaignID = d.Campaign');
        $builder->join('admin_login as ad', 'ad.admin_id = d.	added_by');
        $builder->where('d.DonorID', $ID);
        $builder->where('(d.DeleteStatus IS NULL OR d.DeleteStatus = "")');
        $app_condition = "(d.application_id IS NULL OR d.application_id = 0)";
        $builder->where($app_condition);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }


    function get_faculty_profile($faculty_id)
    {

        $builder = $this->db->table('admin_login as al');
        $builder->select('profile_image');
        $builder->join('email as e', 'al.admin_email = e.Email');
        $builder->join('name as n', 'n.ID = e.EmailID');
        if ($faculty_id != '') {
            $builder->where('e.EmailID', $faculty_id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }

    function get_document_type($type = '')
    {
        $builder = $this->db->table('DocumentType');
        $builder->select('*');
        if ($type != '') {
            $builder->where('status', $type);
        }
        return $builder->get()->getResultArray();
    }

    function get_document_type_by_id($id = '')
    {
        $builder = $this->db->table('DocumentType');
        $builder->select('*');
        if ($id != '') {
            $builder->where('id', $id);
        }
        return $builder->get()->getResultArray();
    }

    function submitEmploymentRecord($student)
    {

        $data = array();
        $response = array();
        foreach ($student as $key => $val) {
            $data[$key] = test_input($val);
        }
        $query = $this->db->table('tbl_employment_record_attachment')->insert($data);
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'INSERTED';
            $response['last_insert_id'] = $this->db->insertId();
        } else {
            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }

    function updateEmploymentRecord($student, $where)
    {

        $data = array();
        $response = array();
        foreach ($student as $key => $val) {
            $data[$key] = test_input($val);
        }
        $query = $this->db->table('tbl_employment_record_attachment')->where($where)->update($data);
        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'UPDATED';
        } else {
            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }

    function getApplicantByID($ID)
    {

        $builder = $this->db->table('name as n');
        $builder->select("ID, FirstName,Sex,gender_another,Ethnicity,citizenship, LastName, Greeting, Spouse, Company, Note,boardHistory, Addressee, HomePhone, HomePhone, MobilePhone, MobilePhone, MainPhone, MainPhone, OtherPhone, OtherPhone,WorkPhone, WorkPhone, Deceased, PassportNumber, PassportExpires, PassportIssued, PassportCountry, Birthdate, NameOnPassport,title,Position,citizenship_country,c.CountryName,web_link,ssn");
        $builder->join('country as c', 'c.CountryID = n.citizenship_country', 'left');
        $builder->where('ID', $ID);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function get_total_crtificate_scholar_ship_student_by_sem_class($student_id, $class, $semester)
    {
        $builder = $this->db->table('student_finance_detail as sf');
        $builder->select('sum(sf.scholar_amount) as scholar_amount');
        $builder->join('Certificates c', ' sf.course_id = c.certID', 'INNER');
        $builder->where('sf.student_id', $student_id);
        if ($class != '') {
            $builder->where('c.Class', $class);
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }


        $builder->where('sf.deletestatus', 0);
        $builder->groupBy('c.Class');
        $builder->groupBy('c.Semester');

        $query = $builder->get();
        return $query->getRowArray();
    }

    function getSemester($class)
    {

        $query = $this->db->query("select distinct Semester from courselist where Class=$class ORDER By Semester");
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function get_certificate_total_credit($student_id, $selected_filter_year = '', $selected_filter_semester = '')
    {
        $builder = $this->db->table('CertTranscript as t');
        $builder->select('sum(c.Credits) as total_credit')
            ->join('Certificates as c', 'c.certID = t.certID');
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('t.StudentID', $student_id);
        if ($selected_filter_year != '') {
            $builder->where('c.class', $selected_filter_year);
        }
        if ($selected_filter_semester != '') {
            $builder->where('c.semester', $selected_filter_semester);
        }
        return $builder->get()->getResultArray();
    }

    function get_certificate_total_tuition($student_id, $selected_filter_year = '', $selected_filter_semester = '')
    {
        $builder = $this->db->table('CertTranscript as t');
        $builder->select('sum(c.tution*c.Credits) as total_tuition')
            ->join('Certificates as c', 'c.certID = t.certID');
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('t.StudentID', $student_id);
        if ($selected_filter_year != '') {
            $builder->where('c.class', $selected_filter_year);
        }
        if ($selected_filter_semester != '') {
            $builder->where('c.semester', $selected_filter_semester);
        }
        return $builder->get()->getResultArray();
    }

    function get_total_scholar_ship_student_by_sem_class($student_id, $class, $semester)
    {
        $builder = $this->db->table('student_finance_detail as sf');
        $builder->select('sum(sf.scholar_amount) as scholar_amount');
        $builder->join('courselist c', ' sf.course_id = c.CourseID', 'INNER');

        $builder->join('transcript as t', 't.CourseID = c.CourseID AND t.StudentID = ' . $student_id);
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);

        $builder->where('sf.student_id', $student_id);
        if ($class != '') {
            $builder->where('c.Class', $class);
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }


        $builder->where('sf.deletestatus', 0);
        //$builder->group_by('c.Class');
        //$builder->group_by('c.Semester');

        $query = $builder->get();
        return $query->getRowArray();
    }

    function get_total_tuition_adustment($student_id, $year, $semester)
    {
        $StudentCredit = "Student Credit";
        $builder = $this->db->table('transcript t');
        $builder->select('sum(d.credit) as total,sum(d.scholor_adjustment) as total_sch');
        $builder->join('courselist c', ' t.CourseID = c.CourseID', 'INNER');
        $builder->join('donations as d', 'd.course_id = c.CourseID AND PaymentType = ' . "'$StudentCredit'" . ' AND d.DonorID = ' . $student_id);

        $builder->where('t.StudentID', $student_id);
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        if ($year != '') {
            $builder->where('c.Class', $year);
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }
        $builder->orderBy('c.Class', 'desc');
        $builder->orderBy('c.Semester', 'desc');
        $query = $builder->get();
        return $query->getResultArray();
    }

    function get_total_credit($student_id, $selected_filter_year = '', $selected_filter_semester = '')
    {
        $builder = $this->db->table('transcript as t');
        $builder->select('sum(c.Credits) as total_credit')
            ->join('courselist as c', 'c.CourseID = t.CourseID');
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('t.StudentID', $student_id);
        if ($selected_filter_year != '') {
            $builder->where('c.Class', $selected_filter_year);
        }
        if ($selected_filter_semester != '') {
            $builder->where('c.Semester', $selected_filter_semester);
        }
        return $builder->get()->getResultArray();
    }

    function get_total_tuition($student_id, $selected_filter_year = '', $selected_filter_semester = '')
    {
        $builder = $this->db->table('transcript as t');
        $builder->distinct('t.Grade');
        $builder->select(
            't.Grade,
         CASE
		WHEN t.Grade = "w" THEN sum((c.tution*c.Credits)-(((c.tution*c.Credits)*refund_amount)/100))
		WHEN t.Grade = "AUDIT" THEN sum(c.audit_rate*c.Credits)
		ELSE sum(c.tution*c.Credits)
		END as total_tuition'
        )
            ->join('courselist as c', 'c.CourseID = t.CourseID');
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('t.StudentID', $student_id);
        if ($selected_filter_year != '') {
            $builder->where('c.Class', $selected_filter_year);
        }
        if ($selected_filter_semester != '') {
            $builder->where('c.Semester', $selected_filter_semester);
        }
        $builder->groupBy('t.Grade');

        return $builder->get()->getResultArray();
    }

    function student_finance_billing2()
    {
        $builder = $this->db->table('name as n');
        $builder->select('n.id,n.FirstName,n.LastName')
            ->join('transcript as t', 't.StudentID = n.id')
            ->join('courselist as c', 'c.CourseID = t.CourseID');
        // ->join('student_finance_detail as sf','sf.course_id = c.CourseID AND sf.student_id = n.id and sf.deletestatus = 0','left');
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);

        if ($this->request->getPost('filter_year') != '') {
            $builder->where('c.Class', $this->request->getPost('filter_year'));
        }
        if ($this->request->getPost('filter_semester') != '') {
            $builder->where('c.Semester', $this->request->getPost('filter_semester'));
        }
        $builder->where('t.Deletestatus');
        $builder->groupBy('t.StudentID');
        $builder->groupBy('n.FirstName');
        $builder->groupBy('n.LastName');
        //$builder->groupBy('c.Class');
        //$builder->groupBy('c.Semester');
        $builder->orderBy('c.Class', 'desc');
        $builder->orderBy('n.FirstName', 'ASC');
        //$builder->orderBy('c.Semester','desc');                                                              
        $query = $builder->get();
        return $query->getResultArray();
    }

    function student_finance_certificate_billing2()
    {
        $builder = $this->db->table('name as n');
        $builder->select('n.id,n.FirstName,n.LastName,sum(c.Credits) as total_credit, sum(c.tution*c.Credits) as total_tuition')
            ->join('CertTranscript as t', 't.StudentID = n.id')
            ->join('Certificates as c', 'c.certID = t.certID');
        // ->join('student_finance_detail as sf','sf.course_id = c.CourseID AND sf.student_id = n.id and sf.deletestatus = 0','left');
        $deletestatus = "(t.Deletestatus IS NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);

        if ($this->request->getPost('filter_year') != '') {
            $builder->where('c.Class', $this->request->getPost('filter_year'));
        }
        if ($this->request->getPost('filter_semester') != '') {
            $builder->where('c.Semester', $this->request->getPost('filter_semester'));
        }
        $builder->where('t.Deletestatus');
        $builder->groupBy('t.StudentID');
        $builder->groupBy('n.FirstName');
        $builder->groupBy('n.LastName');
        $builder->groupBy('c.Class');
        $builder->groupBy('c.Semester');
        $builder->orderBy('c.Class', 'desc');
        $builder->orderBy('c.Semester', 'desc');
        $query = $builder->get();
        return $query->getResultArray();
    }

    function getEmploymentByID($id)
    {
        $builder = $this->db->table('employment');
        $builder->select('*');
        $builder->where('student_id', $id);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function store_scholarship()
    {
        $data = array('name' => $this->request->getPost('sch_name'), 'multiple_allow' => $this->request->getPost('multiple_allow'), 'status' => $this->request->getPost('status'));
        return $this->db->table('mst_scholarship')->insert($data);
    }

    function get_scholar_detail_by_id($id)
    {
        return $this->db->table('mst_scholarship')->select('name,status,multiple_allow')->where('id', $id)->get()->getRowArray();;
    }

    function update_scholarship()
    {
        $data = array(
            'name' => $this->request->getPost('sch_name'),
            'multiple_allow' => $this->request->getPost('multiple_allow'),
            'status' => $this->request->getPost('status')
        );
        $id = encryptor('decrypt', $this->request->getPost('sch_id'));
        $this->db->table('mst_scholarship')->where('id', $id)->update($data);
        return true;
    }

    function get_scholar_ship()
    {
        return $this->db->table('mst_scholarship')->select('*')
            ->get()
            ->getResultArray();
    }

    function check_transcript_course()
    {

        $builder = $this->db->table('transcript');
        $builder->select('*');
        $builder->where('(Deletestatus IS NULL OR Deletestatus != "1")');
        if ($this->request->getPost('student_id') != '') {
            $builder->where('StudentID', $this->request->getPost('student_id'));
        }
        if ($this->request->getPost('transcript_rowid') != '') {
            $builder->where('Transcript_RowID !=', $this->request->getPost('transcript_rowid'));
        }
        if ($this->request->getPost('courseid') != '') {
            $builder->where('CourseID', $this->request->getPost('courseid'));
        }

        $query = $builder->get();
        return $query->getNumRows();
    }

    function get_couse_detail_by_id($course_id = '')
    {
        return $this->db->table('courselist')->select('CourseID,Class,Semester,CourseTitle,Course,start_date,end_date,(Credits*tution) as tuition,audit_rate')
            ->where('CourseID', $course_id)
            ->get()
            ->getRowArray();
    }

    function check_old_grade($transcript_rowid)
    {
        return $this->db->table('transcript')->select('*')
            ->where('Transcript_RowID', $transcript_rowid)
            ->get()
            ->getRowArray();
    }

    function updtateTranscriptDetails($transcript_param)
    {
        $data = array();
        $response = array();
        foreach ($transcript_param as $key => $val) {
            $data[$key] = test_input($val);
        }

        $query = $this->db->table('transcript')->where(array('Transcript_RowID' => $data['Transcript_RowID'], 'StudentID' => $data['StudentID']))->update($data);
        //echo $this->db->last_query(); die();

        if ($query) {
            $response['status'] = true;
            $response['msg'] = 'UPDATED';
        } else {
            $response['status'] = false;
            $response['msg'] = $this->db->error()['message'];
        }
        return $response;
    }

    function update_group_student($last_id)
    {
        $builder = $this->db->table('groups');
        $data = $builder->select('*')
            ->where('NameLink', $this->request->getPost('student_id'))
            ->get()
            ->getResultArray();

        if (!empty($data)) {
            if ($data[0]['student'] != 1) {
                $group['student'] = 1;
                $builder->where('NameLink', $this->request->getPost('student_id'))->update($group);

                $data1['table_name'] = 'transcript';
                $data1['table_field_id'] = $last_id;
                $data1['updated_group_field'] = $data[0]['Group_RowID'];
                $data1['updated_field_name'] = 'student';
                $data1['ip'] = $_SERVER['REMOTE_ADDR'];
                $data1['created_by'] = $this->session->userdata('USER_ID');
                $data1['name_id'] = $this->request->getPost('student_id');
                $this->db->table('group_thread')->insert($data1);
            }
        } else {
            $group['student'] = 1;
            $group['NameLink'] = $this->request->getPost('student_id');

            $builder->insert($group);

            $insert_id = $this->db->insertId();


            $data1['table_name'] = 'transcript';
            $data1['table_field_id'] = $last_id;
            $data1['updated_group_field'] = $insert_id;
            $data1['updated_field_name'] = 'student';
            $data1['ip'] = $_SERVER['REMOTE_ADDR'];
            $data1['created_by'] = $this->session->userdata('USER_ID');
            $data1['name_id'] = $this->request->getPost('student_id');
            $this->db->table('group_thread')->insert($data1);
        }
    }

    function updateStudentRecordsInfo($studentid)
    {

        $builder = $this->db->table('transcript');
        $builder->select("sum(QualityPoints) as QualityPoints,sum(CreditAttempt) as CreditAttempt");
        $builder->where('StudentID', $studentid);
        $gradesss = "(Grade!='I' and Grade!='PASS' and Grade!='W')";
        $builder->where($gradesss);
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getCountryNameByCode($countrycode)
    {

        $builder = $this->db->table('country');
        $builder->select('*');
        $builder->where('CountryID', $countrycode);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            $country = $query->getRowArray();
            $country_name = $country['CountryName'];
            echo $country_name;
        } else {
            return false;
        }
    }

    function getCampaingnsNameByID($campaignsid)
    {
        $builder = $this->db->table('campaigns');
        $builder->select('*');
        $builder->where('CampaignID', $campaignsid);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return false;
        }
    }

    function getStudentPassportInfoByID($StudentInfoID)
    {
        $query = $this->db->query('SELECT n.ID as PassportID, n.ID as StudentID, n.NameOnPassport, n.Birthdate, n.PassportCountry, n.PassportIssued, n.PassportExpires, n.PassportNumber FROM name as n WHERE n.ID = "' . $StudentInfoID . '" AND n.PassportNumber IS NOT NULL AND n.PassportNumber!="" UNION SELECT p.PassportID, p.StudentID, p.NameOnPassport, p.Birthdate, p.PassportCountry, p.PassportIssued, p.PassportExpires, p.PassportNumber FROM passport_log as p WHERE p.StudentID = "' . $StudentInfoID . '" ');
        //$query = $this->db->get();
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    // check passport Exist or not
    function checkPassport($studentid)
    {
        $query = $this->db->query("select * from name where ID='" . $studentid . "' AND PassportNumber!=''");
        $getNumRows = $query->getNumRows();
        return $getNumRows;
    }

    function getCertificateListings($ID)
    {

        $builder = $this->db->table('CertTranscript A');
        $builder->select('A.*,B.cert_no as certificate_no,B.course_dates as course_date,B.Professor as professor,B.grad_undergrad,B.CertName as certificate_name,C.dipName as diploma');
        $builder->join('Certificates B', 'A.certID=B.certID', 'INNER');
        $builder->join('Diploma C', 'B.DipID=C.dipID', 'INNER');
        $builder->where('A.studentID', $ID);
        $deletestatus = "(A.Deletestatus IS NULL OR A.Deletestatus!=1)";
        $builder->where($deletestatus);
        $query = $builder->get();
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {

            return $query->getResultArray();
        } else {
            return array();
        }
    }

    // get all contectlog details by id

    function getContactLogByID($NameID)
    {

        $builder = $this->db->table('ContactLog');
        $builder->select('*');
        $builder->where('NameID', $NameID);
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('ContactDate', 'desc');
        $builder->orderBy('ContactType', 'asc');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getContactTypeByID($cid)
    {

        $builder = $this->db->table('ContactType');
        $builder->select('*');
        $builder->where('cid', $cid);
        $builder->where('Active', 1);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function update_student_finance_detail()
    {
        $data = array(
            'student_id' => $this->input->post('student_id'),
            'course_id'  => $this->input->post('course_id'),
            'type'       => $this->input->post('type'),
            'scholar_amount' => $this->input->post('amount'),
            'scholar_type'  => $this->input->post('scholar_type'),
            'note'  => $this->input->post('message')
        );
        $this->db->where('id', $this->input->post('rel_no'));
        return $query = $this->db->update('student_finance_detail', $data);
    }

    function delete_student_finance_detail()
    {
        $data = array('deletestatus' => 1);
        $this->db->where('id', $this->input->post('rel_no'));
        $query = $this->db->update('student_finance_detail', $data);
        return $query;
    }

    function get_total_scholar_by_course()
    {
        $this->db->select('sum(scholar_amount) as total')
            ->from('student_finance_detail')
            ->where([
                'course_id' => $this->input->post('course_id'),
                'student_id' => $this->input->post('student_id'),
                'type'      => $this->input->post('type'),
                'deletestatus' => 0
            ]);
        if ($this->input->post('edit') != '') {
            $this->db->where('id <>', $this->input->post('rel_no'));
        }
        $query = $this->db->group_by('course_id')
            ->group_by('student_id')
            ->get()
            ->row_array();
        return $query;
    }

    function get_student_scholarship($id, $type, $student_id)
    {
        $this->db->select('sum(scholar_amount) as total')
            ->from('student_finance_detail')
            ->where([
                'course_id' => $id,
                'student_id' => $student_id,
                'type'      => $type,
                'deletestatus' => 0
            ]);

        $query = $this->db->group_by('course_id')
            ->group_by('student_id')
            ->get()
            ->row_array();
        return $query;
    }
}
