<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $db;
    protected $request;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
        $this->request = \Config\Services::request();
    }

    function getCorse_details_by_ID($ID)
    {
        $builder = $this->db->table('courselist');
        //$this->db->select("CourseTitle,Course");
        $builder->select("CourseID,CourseTitle,Course,Professor,Semester,Class,start_date,end_date");
        $builder->where('CourseID', $ID);
        $query = $builder->get();
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getSemesterCourseByStudent_ID($ID, $class, $semester)
    {

        $builder = $this->db->table('transcript t');
        $builder->distinct();
        $builder->select("c.Course as courseid,t.StudentID, (case when t.grade='AUDIT' then '0' else c.credits END) as credits,c.CourseID as course_row_id,case when t.grade='w' then 'w'  when t.grade='i' then 'i' else '' end as withdrawn");
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        if ($class != 'All') {
            $builder->where('c.Class', $class);
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }
        $string = "( t.grade<>'')";
        $builder->where($string);
        $builder->where('t.StudentID', $ID);
        $builder->where('t.Deletestatus IS NULL');
        $query = $builder->get();
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
        // get Semester list
    }

    function getSemesterCourseByStudent_ID_with_grade($ID, $class, $semester, $grade)
    {
        $builder = $this->db->table('transcript t');
        $builder->distinct();
        $builder->select("c.Course as courseid,t.StudentID,c.credits,c.CourseID as course_row_id,case when t.grade='w' then 'w'  when t.grade='i' then 'i' else '' end as withdrawn");
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        /*if($class != 'All'){
            $this->db->where('c.Class',$class);
	 }
	 if($semester != ''){
		 $this->db->where('c.Semester',$semester);
	 }*/
        $builder->where('t.grade', $grade);
        //$string = "( t.grade<>'')";
        // $this->db->where($string);	
        $builder->where('t.StudentID', $ID);
        $builder->where('t.Deletestatus IS NULL');

        $query = $builder->get();


        //echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function get_hr_by_contract($begin_date, $end_date, $Team_option)
    {


        $begin_date = date('Y-m-d', strtotime($begin_date));
        $end_date   = date('Y-m-d', strtotime($end_date));

        $SQL = "SELECT distinct date(transaction_date) as transaction_datee  FROM tbl_contract_transaction where transaction_date between '$begin_date' and '$end_date' and empid='$Team_option'";

        $query = $this->db->query($SQL);
        //$query->getRowArray();
        if ($query->getNumRows() >= 1) {
            $co_id = $query->getResultArray();
            //return $co_id; exit;
            $transaction_date = array();
            $array_contract = array();
            foreach ($co_id as  $value) {
                $transaction_date[] = $value['transaction_datee'];
            }
            $array_transaction_date = array_unique($transaction_date);

            foreach ($array_transaction_date as $valuee) {

                $SQLl = "Select * from tblcontract where '$valuee' between contract_begin_date and contract_end_date 
						and  empid='$Team_option' and deletestatus=0";

                $queryy = $this->db->query($SQLl);
                if ($queryy->getNumRows() >= 1) {
                    $array_contract[] = $queryy->getRowArray();
                }
            }

            $return = array();
            $return_contract_begin_date = array();
            $return_contract_end_date = array();
            $return['to_hour'] = 0;
            $unique = array_map("unserialize", array_unique(array_map("serialize", $array_contract)));
            foreach ($unique as $key => $value) {
                $return['to_hour'] = $return['to_hour'] + $value['hours_to_work'];
                $return_contract_begin_date[] = $value['contract_begin_date'];
                $return_contract_end_date[] = $value['contract_end_date'];
            }

            //print_r($unique);
            $mostRecent = 0;
            foreach ($return_contract_end_date as  $end_date) {
                $curDate = strtotime($end_date);
                if ($curDate > $mostRecent) {
                    $mostRecent = date("Y-m-d", $curDate);
                }
            }
            $mostearlier = 0;
            foreach ($return_contract_begin_date as  $start_date) {
                $curDatee = strtotime($start_date);
                if ($curDatee < $mostRecent) {
                    $mostearlier = date("Y-m-d", $curDatee);
                }
            }
            $return['min_date'] = min($return_contract_begin_date);
            $return['max_date'] = max($return_contract_end_date);
            return $return;
            /*exit;*/
        } else {
            return array();
            //return $this->db->last_query();
        }
    }

    function get_hr_left_by_contract($begin_date, $end_date, $Team_option)
    {


        $begin_date = date('Y-m-d', strtotime($begin_date));
        $end_date   = date('Y-m-d', strtotime($end_date));

        $builder = $this->db->table('tbl_contract_transaction');
        $builder->select('SUM(FLOOR(hours)) as t_hours, SUM(SUBSTRING(hours - FLOOR(hours), 3, 5))
       				as t_minutes ');
        //$this->db->whereIn('contract_id', $array );
        $builder->where('transaction_date >=', $begin_date);
        $builder->where('transaction_date <=', $end_date);
        $builder->where('empid', $Team_option);

        $queryy = $builder->get();

        if ($queryy->getNumRows() >= 1) {
            return $queryy->getRowArray();
        } else {
            return array();
            // return $this->db->last_query();
        }
    }

    function gettotalCreditattempt1($application_id)
    {

        $builder = $this->db->table('transcript t');
        $builder->select('sum(t.CreditAttempt) as total_credit_attempt, sum(CreditEarned) as total_credit_earned,sum(t.QualityPoints) as total_quality_points');
        $builder->join('courselist c', 't.courseid = c.courseid', 'INNER');
        $gradesss = "(t.Grade!='I' and t.Grade!='PASS' and t.Grade!='W' and  t.Grade!='AUDIT' and t.Grade!='FAIL' and t.Grade!='TA' and t.Grade!='TB' and t.Grade!='TC' and t.Grade!='T' and t.Grade!='SCH')";    // Changes date 16 May 2019 Student ID 1724 Issue By Mail
        //$gradesss="(  t.Grade!='W' and t.Grade!='PASS')";   //Changes Date 18 June 2019 mail by client for student ID 3617 and says above 16 may condition is not correct
        $builder->where($gradesss);
        $deletestatus = "(Deletestatus is NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('t.StudentID', $application_id);

        $query = $builder->get();
        //echo $builder->last_query(); die;
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function gettotalCreditattempt2($application_id)
    {

        $builder = $this->db->table('transcript t');
        $builder->select('sum(t.CreditAttempt) as total_credit_attempt, sum(CreditEarned) as total_credit_earned,sum(t.QualityPoints) as total_quality_points');
        $builder->join('courselist c', 't.courseid = c.courseid', 'INNER');
        $gradesss = "(t.Grade!='I' and t.Grade!='PASS' and t.Grade!='W' and  t.Grade!='AUDIT' and t.Grade!='FAIL' and t.Grade!='TA' and t.Grade!='TB' and t.Grade!='TC' and t.Grade!='SCH' and t.Grade!='T' and t.Grade!='ENR')";
        $builder->where($gradesss);
        $deletestatus = "(Deletestatus is NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('t.StudentID', $application_id);

        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function gettotalCreditattempt($application_id)
    {

        $builder = $this->db->table('transcript t');
        $builder->select('sum(t.CreditAttempt) as total_credit_attempt, sum(CreditEarned) as total_credit_earned,sum(t.QualityPoints) as total_quality_points');
        $builder->join('courselist c', 't.courseid = c.courseid', 'INNER');
        $gradesss = "(t.Grade!='I' and t.Grade!='PASS' and t.Grade!='W' and t.Grade!='SCH' and t.Grade!='AUDIT' and t.Grade!='FAIL' and t.Grade!='TA' and t.Grade!='TB' and t.Grade!='TC' and t.Grade!='T' and t.Grade!='ENR')";
        $builder->where($gradesss);
        $deletestatus = "(Deletestatus is NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('t.StudentID', $application_id);

        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getTransciptDetailByStudent($student_id)
    {
        $builder = $this->db->table('transcript as t');
        $builder->select('SUM(g.GradeValue*t.CreditEarned) as quality_point')
            ->join('courselist as cl', 'cl.CourseID = t.CourseID')
            ->join('mst_grades_class as g', 'g.Grade = t.Grade AND cl.Class = g.class');
        $gradesss = "(t.Grade!='I' and t.Grade!='PASS' and t.Grade!='W' and t.Grade!='SCH' and t.Grade!='AUDIT' and t.Grade!='FAIL' and t.Grade!='TA' and t.Grade!='TB' and t.Grade!='TC' and t.Grade!='T' and t.Grade!='ENR')";
        $builder->where($gradesss);
        $deletestatus = "(t.Deletestatus is NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        return $builder->where('t.StudentID', $student_id)->get()->getResultArray();
    }


    function getCompleteGPAnew($application_id)
    {

        $builder = $this->db->table('transcript t');
        $builder->select('t.CreditAttempt,studentid,c.class,t.Grade,t.CreditEarned');
        $builder->join('courselist c', 't.courseid = c.courseid', 'INNER');
        $gradesss = "( t.Grade!='PASS' and t.Grade!='W' and t.Grade!='SCH' and t.Grade!='AUDIT' and t.Grade!='TA' and t.Grade!='TB' and t.Grade!='TC' and t.Grade!='ENR' )";
        $builder->where($gradesss);
        $deletestatus = "(Deletestatus is NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('t.StudentID', $application_id);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getlockAttendance_emp($selected_year, $selected_month, $empid)
    {


        $SQL = "SELECT date(transaction_date) as transaction,transaction_date FROM tbl_contract_transaction where month(transaction_date)=$selected_month and year(transaction_date)=$selected_year and empid=$empid and islock=1 group by transaction_date order by transaction_date
				";
        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getlockEmpAttendance($selected_year, $selected_month)
    {


        $SQL = "SELECT empid,count(islock) as countlock	FROM
				(SELECT distinct empid,islock,transaction_date
				FROM tbl_contract_transaction)
				temp_transaction
				where month(transaction_date)='$selected_month' and
				year(transaction_date)='$selected_year'  and islock =0 group by empid,islock order by  empid asc
				";
        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function gelasttlockEmpAttendance($selected_year, $selected_month)
    {


        $SQL = "SELECT empid,date(max(transaction_date)) as last_date	FROM (SELECT distinct empid,islock,transaction_date FROM 
				tbl_contract_transaction) temp_transaction where islock !=0 group by empid order by empid asc;
				";
        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getTotalforFisicalReportByMonth($application_id, $selected_year)
    {

        $finanyr = explode("-", $selected_year);
        $first_date = $finanyr[0] . "-07-01";
        $last_date = $finanyr[1] . "-06-30";


        $SQL = "SELECT Month(t.transaction_date) as month, SUM(FLOOR(hours)) as t_hours, SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` INNER JOIN `tblcategory` `c` ON `t`.`category_id`=`c`.`id` WHERE `t`.`empid` = '$application_id' AND `t`.`transaction_date` >= '$first_date' AND `t`.`transaction_date` <= '$last_date' GROUP BY Month(t.transaction_date)";
        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getTotalforMonthlyReportByCategry($application_id, $selected_year, $selected_month)
    {

        $SQL = "select tc.id,catagory_name,empid,t_hours,t_minutes from tblcategory tc left outer join (
				SELECT  `category_id`, `empid`, SUM(FLOOR(hours)) as t_hours,
				SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` inner JOIN `tblcategory` `c`
				ON `t`.`category_id`=`c`.`id` WHERE `t`.`empid` = '$application_id' and month(transaction_date)='$selected_month' and year(transaction_date)='$selected_year'
				GROUP BY  `category_id`) temp  on tc.id=temp.category_id";
        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getTotalforFisicalYear($application_id, $selected_month, $selected_year)
    {

        $fisical_year = getfinancialyear_june('01-' . $selected_month . '-' . $selected_year);

        $finanyr = explode("-", $fisical_year);
        $first_date = $finanyr[0] . "-07-01";
        if ($selected_month <= 12 and $selected_month >= 7) {
            $selyr = $finanyr[0];
        } else {
            $selyr = $finanyr[1];
        }

        $last_date = $selyr . "-" . $selected_month . "-25";


        $SQL = "SELECT `empid`,  SUM(FLOOR(hours)) as t_hours,
				SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` INNER JOIN `tblcategory` `c`
				ON `t`.`category_id`=`c`.`id`  WHERE `t`.`transaction_date` >= DATE_ADD(DATE_ADD(LAST_DAY('$first_date'), INTERVAL 1 DAY), INTERVAL - 1 MONTH)
				AND `t`.`transaction_date` <= LAST_DAY('$last_date')  and `t`.`empid`='$application_id'";

        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }


    function getTotalforMonthlyReportByDay($application_id, $selected_year, $selected_month)
    {

        $SQL = "SELECT date(`transaction_date`) transaction_date,SUM(FLOOR(hours)) as t_hours,
				SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` INNER JOIN `tblcategory` `c`
				ON `t`.`category_id`=`c`.`id` WHERE `t`.`empid` = '$application_id' and month(transaction_date)='$selected_month' and year(transaction_date)='$selected_year'
				GROUP BY date(`transaction_date`),month(transaction_date)";

        $query = $this->db->query($SQL);
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getTotalforMonthlyReport($application_id, $selected_year, $selected_month)
    {

        $SQL = "SELECT  SUM(FLOOR(hours)) as t_hours,
				SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` INNER JOIN `tblcategory` `c`
				ON `t`.`category_id`=`c`.`id` WHERE `t`.`empid` = '$application_id' and month(transaction_date)='$selected_month' and year(transaction_date)='$selected_year'";
        $query = $this->db->query($SQL);
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }


    function Get_faculty_staff($empid = '')
    {
        $builder = $this->db->table('name n');
        $builder->select('FirstName,LastName,ID');
        $builder->join('groups g', 'g.NameLink = n.ID');
        $builder->where('g.FacultyStaff = 1');
        if ($empid != '') {
            $builder->where('n.ID', $empid);
        }
        $builder->orderBy('FirstName', 'ASC');

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function Get_not_faculty_staff($empid = '')
    {

        $builder = $this->db->table('name n');
        $builder->select('FirstName,LastName,ID');
        $builder->join('groups g', 'g.NameLink = n.ID');

        if ($empid != '') {
            $builder->where('n.ID', $empid);
        }
        $builder->orderBy('FirstName', 'ASC');

        $query = $builder->get();


        if ($query->getNumRows() >= 1) {

            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function Get_staff_of_contract($selected_year, $selected_month)

    {
        $date = $selected_year . "-" . $selected_month . "-01";

        $SQL = "SELECT empid FROM tblcontract  GROUP BY empid";

        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getTotalforAdminReport($BeginDate, $EndDate, $User_option, $Team_option)
    {

        $BeginDate = date('Y-m-d', strtotime($BeginDate));
        $EndDate = date('Y-m-d', strtotime($EndDate));

        $SQL = "SELECT  SUM(FLOOR(hours)) as t_hours,
            SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` 
            INNER JOIN `tblcategory` `c` ON `t`.`category_id`=`c`.`id` 
            INNER JOIN `name` `n` ON `t`.`empid`=`n`.`ID`
            JOIN tblcontract as con ON con.id = t.contract_id
            WHERE `t`.`transaction_date` >= '$BeginDate'
            AND `t`.`transaction_date` <= '$EndDate'";
        if ($User_option != '0') {
            $SQL .= "AND `t`.`empid`='$User_option'";
        }
        if ($Team_option != '0') {
            $SQL .= " AND `t`.`empid` in (select c.empid from tblcontract c,Teams tm where c.teamid = `tm`.`id` and `tm`.`id` ='$Team_option') ";
        }
        if ($this->request->getPost('contact_1099') != '') {
            $contact_1099 = $this->request->getPost('contact_1099');
            $SQL .= " AND con.contract_1099 = '$contact_1099' ";
        }

        $query = $this->db->query($SQL);
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }
    function team_getTotalforAdminReport($application_id, $BeginDate, $EndDate)
    {

        $BeginDate = date('Y-m-d', strtotime($BeginDate));
        $EndDate = date('Y-m-d', strtotime($EndDate));


        $SQL = "SELECT `empid`, SUM(FLOOR(hours)) as t_hours, SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` INNER JOIN `tblcategory` `c` ON `t`.`category_id`=`c`.`id`  INNER JOIN `name` `n` ON `t`.`empid`=`n`.`ID` WHERE `t`.`transaction_date` >= '$BeginDate' AND `t`.`transaction_date` <= '$EndDate'  AND `t`.`empid` in ( select `c`.`empid` from tblcontract c,Teams tm where `c`.`teamid`=`tm`.`id` and `tm`.`empid`='$application_id')  GROUP BY`empid` ";


        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getTotalforAdmin_TimeReport_empwise($BeginDate, $EndDate)
    {

        $BeginDate = date('Y-m-d', strtotime($BeginDate));
        $EndDate = date('Y-m-d', strtotime($EndDate));

        $SQL = "SELECT t.empid,  SUM(FLOOR(hours)) as t_hours,
            SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` 
            INNER JOIN `tblcategory` `c` ON `t`.`category_id`=`c`.`id`
            JOIN tblcontract as con ON con.id = t.contract_id
            INNER JOIN `name` `n` ON `t`.`empid`=`n`.`ID` 
            WHERE `t`.`transaction_date` >= '$BeginDate'
            AND `t`.`transaction_date` <= '$EndDate'";

        if ($this->request->getPost('contact_1099') != '') {
            $contact_1099 = $this->request->getPost('contact_1099');
            $SQL .= " AND con.contract_1099 = '$contact_1099' ";
        }

        $SQL .= " GROUP BY t.empid";
        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }
    function team_getTotalforAdmin_TimeReport_empwise($BeginDate, $EndDate)
    {

        $BeginDate = date('Y-m-d', strtotime($BeginDate));
        $EndDate = date('Y-m-d', strtotime($EndDate));

        $SQL = "SELECT `empid`,  SUM(FLOOR(hours)) as t_hours,
				SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` INNER JOIN `tblcategory` `c`
				ON `t`.`category_id`=`c`.`id` INNER JOIN `name` `n` ON `t`.`empid`=`n`.`ID` WHERE `t`.`transaction_date` >= '$BeginDate'
				AND `t`.`transaction_date` <= '$EndDate' GROUP BY `empid`";
        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getTotalforAdmin_TimeReport_catwise($BeginDate, $EndDate, $User_option, $Team_option)
    {

        $BeginDate = date('Y-m-d', strtotime($BeginDate));
        $EndDate = date('Y-m-d', strtotime($EndDate));


        $SQL = "SELECT  `category_id`, SUM(FLOOR(hours)) as t_hours,
				SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` 
				INNER JOIN `tblcategory` `c` ON `t`.`category_id`=`c`.`id` 
				INNER JOIN `name` `n` ON `t`.`empid`=`n`.`ID` 
				JOIN tblcontract as con ON con.id = t.contract_id
				WHERE `t`.`transaction_date` >= '$BeginDate'
				AND `t`.`transaction_date` <= '$EndDate' ";

        if ($User_option != '0') {
            $SQL .= "AND `t`.`empid`='$User_option' ";
        }
        if ($Team_option != '0') {
            $SQL .= " AND `t`.`empid` in (select c.empid from tblcontract c,Teams tm where c.teamid = `tm`.`id` and `tm`.`id` ='$Team_option') ";
        }
        if ($this->request->getPost('contact_1099') != '') {
            $contact_1099 = $this->request->getPost('contact_1099');
            $SQL .= " AND con.contract_1099 = '$contact_1099' ";
        }
        $SQL .= "GROUP BY  `category_id`";


        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getAllFisicalyear()
    {

        $builder = $this->db->table('tbl_contract_transaction t');
        $builder->select('Max(transaction_date) as max_month,Min(transaction_date) as min_month,');

        $query = $builder->get();
        if ($query->getNumRows() >= 1) {

            $result = $query->getRowArray();
            $max_yr = $result['max_month'];
            $min_yr = $result['min_month'];

            return calcFY($min_yr, $max_yr);
        } else {
            return array();
        }
    }

    function getEmpDailyAttendance_Bymonth($application_id, $selected_year)
    {

        $finanyr = explode("-", $selected_year);
        $first_date = $finanyr[0] . "-07-01";
        $last_date = $finanyr[1] . "-06-30";

        $builder = $this->db->table('tbl_contract_transaction t');
        $builder->select('Month(t.transaction_date) as month,category_id,SUM(FLOOR(hours)) as t_hours,SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes');
        $builder->join('tblcategory c', 't.category_id=c.id', 'INNER');
        $builder->where('t.empid', $application_id);
        $builder->where('t.transaction_date >=', $first_date);
        $builder->where('t.transaction_date <=', $last_date);
        $builder->groupBy(array("Month(t.transaction_date)", "category_id"));

        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getTotalforFisicalReportByCat($application_id, $selected_year)
    {

        $finanyr = explode("-", $selected_year);
        $first_date = $finanyr[0] . "-07-01";
        $last_date = $finanyr[1] . "-06-30";


        $SQL = "SELECT  `category_id`, SUM(FLOOR(hours)) as t_hours,
			 SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` INNER JOIN
			  `tblcategory` `c` ON `t`.`category_id`=`c`.`id` WHERE `t`.`empid` = '$application_id' AND `t`.`transaction_date` >= '$first_date'
			   AND `t`.`transaction_date` <= '$last_date' GROUP BY `category_id`";

        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function team_getEmpDailyAttendance_Byemp($application_id, $BeginDate, $EndDate)
    {

        $BeginDate = date('Y-m-d', strtotime($BeginDate));
        $EndDate = date('Y-m-d', strtotime($EndDate));

        $SQL = "SELECT `empid`, `category_id`, `FirstName`, `LastName`, SUM(FLOOR(hours)) as t_hours, 
			SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` INNER JOIN 
			`tblcategory` `c` ON `t`.`category_id`=`c`.`id` INNER JOIN `name` `n` ON `t`.`empid`=`n`.`ID` WHERE 
			`t`.`transaction_date` >= '$BeginDate' AND `t`.`transaction_date` <= '$EndDate' AND  
			`t`.`empid` in (
			select `c`.`empid` from tblcontract c,Teams tm  where `c`.`teamid`=`tm`.`id` and `tm`.`empid`='$application_id')
			 GROUP BY `empid`, `category_id` ORDER BY `FirstName` ASC";

        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }
    function getEmpDailyAttendance_Byemp($application_id, $BeginDate, $EndDate, $User_option, $Team_option)
    {

        $BeginDate = date('Y-m-d', strtotime($BeginDate));
        $EndDate = date('Y-m-d', strtotime($EndDate));

        $sql1 = "select c.empid from tblcontract c,Teams tm where c.teamid = `tm`.`id` and `tm`.`id` ='$Team_option'";
        $query1 = $this->db->query($sql1);

        $res = $query1->getResultArray();
        foreach ($res as $key => $value) {
            $rest[] = $value['empid'];
        }

        $builder = $this->db->table('tbl_contract_transaction t');
        $builder->select('t.empid,category_id,FirstName,LastName,SUM(FLOOR(hours)) as t_hours,SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes');
        $builder->join('tblcontract as con', 'con.id = t.contract_id');
        $builder->join('tblcategory c', 't.category_id=c.id', 'INNER');
        $builder->join('name n', 't.empid=n.ID', 'INNER');
        $builder->where('t.transaction_date >=', $BeginDate);
        $builder->where('t.transaction_date <=', $EndDate);
        if ($User_option != '0') {
            $builder->where('t.empid=', $User_option);
        }
        if ($Team_option != '0') {
            $builder->whereIn('t.empid ', $rest);
        }
        if ($this->request->getPost('contact_1099') != '') {

            $contact_1099 = $this->request->getPost('contact_1099');
            $builder->where('con.contract_1099', $contact_1099);
        }

        $builder->groupBy(array("empid", "category_id"));
        $builder->orderBy('FirstName', 'ASC');
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }
    function team_getTotalforAdmin_TimeReport_catwise($application_id, $BeginDate, $EndDate)
    {

        $BeginDate = date('Y-m-d', strtotime($BeginDate));
        $EndDate = date('Y-m-d', strtotime($EndDate));


        $SQL = "SELECT `category_id`, SUM(FLOOR(hours)) as t_hours, SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as
			 t_minutes FROM `tbl_contract_transaction` `t` INNER JOIN `tblcategory` `c` ON `t`.`category_id`=`c`.`id` 
			 INNER JOIN `name` `n` ON `t`.`empid`=`n`.`ID` WHERE `t`.`transaction_date` >= '$BeginDate' AND
			 `t`.`transaction_date` <= '$EndDate'  AND `t`.`empid` in ( select `c`.`empid` from tblcontract c,Teams tm where `c`.`teamid`=`tm`.`id` and
			 `tm`.`empid`='$application_id')
			 GROUP BY `category_id` ";


        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }
    function get_team_member($application_id)
    {

        $SQL = "select `c`.`empid` from tblcontract c,Teams tm where `c`.`teamid`=`tm`.`id` and `tm`.`empid`='$application_id' order by empid asc ";


        $query = $this->db->query($SQL);

        if ($query->getNumRows() >= 0) {
            $array = $query->getResultArray();
            $arr = array_column($array, "empid");
            return $arr;
        } else {
            return array();
        }
    }

    function getcategory()
    {

        $builder = $this->db->table('tbl_contract_transaction t');
        $builder->distinct();
        $builder->select('c.id, c.catagory_name');
        $builder->join('tblcategory c', 't.category_id=c.id', 'left outer');
        $builder->orderBy('id', 'ASC');
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }



    function total_attempts_sum($application_id)
    {

        $builder = $this->db->table('transcript t');
        $builder->select('sum(t.CreditAttempt) as total_credit_attempt, sum(CreditEarned) as total_credit_earned,sum(t.QualityPoints) as total_quality_points');
        $builder->join('courselist c', 't.courseid = c.courseid', 'INNER');

        $deletestatus = "(Deletestatus is NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('t.StudentID', $application_id);
        $builder->where('t.Grade <>', 'SCH');

        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }


    function total_attempts_sum_plan($application_id)
    {

        $builder = $this->db->table('transcript t');
        $builder->select('sum(t.CreditAttempt) as total_credit_attempt, sum(CreditEarned) as total_credit_earned,sum(t.QualityPoints) as total_quality_points');
        $builder->join('courselist c', 't.courseid = c.courseid', 'INNER');

        $deletestatus = "(Deletestatus is NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('t.StudentID', $application_id);

        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }


    function getStudentCurriumById($application_id)
    {

        $builder = $this->db->table('student_info S');
        $builder->select('S.StudentInfoID,S.Graduation,GPA,M.Program_Name');
        $builder->join('mst_program M', 'S.ProgramID = M.ProgramID', 'LEFT');
        $builder->where('StudentInfoID', $application_id);
        $deletestatus = "(S.Deletestatus is NULL OR S.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->groupBy('StudentInfoID,Graduation,GPA,Program_Name');
        $builder->orderBy('StudentInfoID', 'Desc');
        $builder->limit(1, 0);
        $query = $builder->get();
        $check = $builder->getCompiledSelect();
        //print_r($check);
        // die;
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getStudentCurrentClass($application_id)
    {

        $builder = $this->db->table('student_info');
        $builder->select('*');
        $builder->where('StudentInfoID', $application_id);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }


    function getSemesterWiseReport($application_id)
    {

        $builder = $this->db->table('transcript A');
        $builder->select('A.StudentID,B.Class,B.Semester,B.Term,B.CourseDates');
        $builder->join('courselist B', 'A.CourseID=B.CourseID', 'INNER');
        $builder->where('A.StudentID', $application_id);
        $deletestatus = "(A.Deletestatus is NULL OR A.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->groupBy('B.Class');
        $builder->groupBy('B.Semester');
        $builder->groupBy('B.Term');
        $builder->groupBy('B.CourseDates');
        $builder->orderBy('B.Class', 'ASC');
        $builder->orderBy('B.Semester', 'DESC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getSemesterCourseList($class, $semester, $term, $student_id, $CourseDates)
    {

        $builder = $this->db->table('transcript A');
        $builder->select('*');
        $builder->join('courselist B', 'A.CourseID=B.CourseID', 'INNER');

        $builder->join('mst_grades_class mgc', 'B.Class = mgc.class and A.Grade = mgc.Grade', 'INNER');
        $builder->where('A.StudentID', $student_id);
        $builder->where('B.Class', $class);
        $builder->where('B.Semester', $semester);
        $builder->where('B.Term', $term);
        $builder->where('B.CourseDates', $CourseDates);
        $deletestatus = "(A.Deletestatus is NULL OR A.Deletestatus!=1)";
        $builder->where($deletestatus);
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getGradevalueList($TranscriptClass, $GradeName)
    {

        $builder = $this->db->table('mst_grades_class');
        $builder->select('GradeValue');
        $builder->where('class', $TranscriptClass);
        $builder->where('Grade', $GradeName);
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getStudentCurrentSemester($application_id)
    {

        $builder = $this->db->table('transcript A');
        $builder->select('B.Class,B.Semester');
        $builder->join('courselist B', 'A.CourseID=B.CourseID', 'INNER');
        $builder->where('A.StudentID', $application_id);
        $deletestatus = "(A.Deletestatus is NULL OR A.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->groupBy('B.Class');
        $builder->groupBy('B.Semester');
        $builder->orderBy('B.Class', 'desc');
        $builder->limit(1, 0);
        $query = $builder->get();
        //echo $builder->last_query(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    // get donation month wise report

    function getDonationMonthWiseReport($begin_date, $end_date)
    {
        $begin_date = date('d-m-Y', strtotime($begin_date));
        $end_date   = date('d-m-Y', strtotime($end_date));

        $query = $this->db->query("select month(STR_TO_DATE(ReceivedDate,'%d-%m-%Y')) as month,year(STR_TO_DATE(ReceivedDate,'%d-%m-%Y')) as year from donations where STR_TO_DATE(ReceivedDate,'%d-%m-%Y')>=STR_TO_DATE('$begin_date','%d-%m-%Y') AND STR_TO_DATE(ReceivedDate,'%d-%m-%Y')<=STR_TO_DATE('$end_date','%d-%m-%Y') group by year,month order by year,month");
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getmonthlydonationsreport($month = '', $year = '', $campaign_id = '')
    {
        if ($campaign_id != '' && !empty($campaign_id)) {
            $qry = "select *,STR_TO_DATE(B.ReceivedDate,'%d-%m-%Y') as ReceivedDate from name A inner join donations B ON A.ID=B.DonorID left join campaigns C ON B.Campaign=C.CampaignID where month(STR_TO_DATE(B.ReceivedDate,'%d-%m-%Y'))=$month AND year(STR_TO_DATE(B.ReceivedDate,'%d-%m-%Y'))=$year AND C.CampaignID = $campaign_id ORDER BY B.ReceivedDate ASC,A.LastName ASC,A.FirstName ASC";
        } else {
            $qry = "select *,STR_TO_DATE(B.ReceivedDate,'%d-%m-%Y') as ReceivedDate from name A inner join donations B ON A.ID=B.DonorID left join campaigns C ON B.Campaign=C.CampaignID where month(STR_TO_DATE(B.ReceivedDate,'%d-%m-%Y'))=$month AND year(STR_TO_DATE(B.ReceivedDate,'%d-%m-%Y')) = $year ORDER BY B.ReceivedDate ASC,A.LastName ASC,A.FirstName ASC";
        }
        $query = $this->db->query($qry);
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }
    function getApplicantListMailReport()
    {
        $query = $this->db->query("
		SELECT  DISTINCT `name`.*, `groups`.`DanielVIP`, `groups`.`DanielPermissionNeeded`, `groups`.`Unsubscribed`,Deceased,`address`.*, 
		`StateName`, address.`CountryName`,useremail,
		concat(
            CASE WHEN Foundation = '1' THEN 'Grantmaker Affiliate, ' ELSE '' END,
            CASE WHEN Media = '1' THEN 'Media, ' ELSE '' END,
            CASE WHEN Appalachian = '1' THEN 'Appalachian Program, ' ELSE '' END,
            CASE WHEN BoardMember = '1' THEN 'Past & Present Board Members, ' ELSE '' END,
            CASE WHEN StudentFamily = '1' THEN 'Past & Present Student Family, ' ELSE '' END,
            CASE WHEN AnnualReport = '1' THEN 'Receives Printed Annual Report, ' ELSE '' END,
            CASE WHEN DanielVIP = '1' THEN 'VIP, ' ELSE '' END,
            CASE WHEN FriendofDaniel = '1' THEN 'Friend of Daniel/ Not VIP, ' ELSE '' END,
            CASE WHEN DanielPermissionNeeded = '1' THEN 'Need Daniel Permission to Contact, ' ELSE '' END,
            CASE WHEN GraduationInvite = '1' THEN 'Send Graduation Invitation, ' ELSE '' END,
            CASE WHEN QuarterCenturyReport = '1' THEN 'Received Quarter Century Report, ' ELSE '' END,
            CASE WHEN prospective_donor = '1' THEN 'Potential Donor, ' ELSE '' END,
            CASE WHEN ProspectiveStudent = '1' THEN 'Potential Student, ' ELSE '' END,
            
            CASE WHEN tribal_college = '1' THEN 'Tribal College,' ELSE '' END,
            CASE WHEN hbcu = '1' THEN 'HBCU,' ELSE '' END,
            CASE WHEN wv_college = '1' THEN 'WV College,' ELSE '' END,
            CASE WHEN appalachia_college = '1' THEN 'Appalachia College,' ELSE '' END,
            CASE WHEN us_college = '1' THEN 'US College,' ELSE '' END,
            CASE WHEN americorps = '1' THEN 'AmeriCorps,' ELSE '' END,
            CASE WHEN peacecorps = '1' THEN 'Peace Corps,' ELSE '' END,
            
            CASE WHEN Deceased = '1' THEN 'Deceased, ' ELSE '' END,
            CASE WHEN Vista = '1' THEN 'Vista, ' ELSE '' END,
            CASE WHEN accthold = '1' THEN 'Acct Hold, ' ELSE '' END,
            CASE WHEN t1.StudentInfoID IS NOT NULL THEN 'Alum, ' 
            	   ELSE CASE WHEN t2.nGra_student_id IS NOT NULL THEN 'Student,' ELSE '' END 
            END,
            CASE WHEN t3.empid IS NOT NULL THEN 'Current Employee, ' 
            	 ELSE CASE WHEN t4.empid IS NOT NULL THEN 'Formal Employee, ' ELSE '' END  
            END,
            CASE WHEN do_not_contactCount > 0 THEN 'Do not Contact, ' 
            	 ELSE '' 
            END,
            CASE WHEN t5.DonorID IS NOT NULL THEN 'Donor, ' 
            	 ELSE ''  
            END
        ) as tags
		
        FROM ((name 
        LEFT JOIN (country RIGHT JOIN (SELECT `ad`.*, `s`.`StateName`, `c`.`CountryName` FROM `address` as `ad` 
        INNER JOIN `country` `c` ON `c`.`CountryID`=`ad`.`Country` 
        LEFT JOIN `state` `s` ON `s`.`StateID`=`ad`.`State` WHERE `ad`.`Active` = '1') address ON country.CountryID = address.Country) ON name.ID = address.AddressID)
        LEFT JOIN `groups` ON name.ID = `groups`.NameLink) 
        LEFT JOIN (regionprogram RIGHT JOIN student_info ON regionprogram.RPID = student_info.Region) ON name.ID = student_info.StudentInfoID
        
        
        LEFT JOIN (SELECT StudentInfoID FROM student_info as si
        WHERE (Deletestatus is NULL OR Deletestatus!=1) AND (Graduation IS NOT NULL AND Graduation != '')) as t1 
        ON t1.StudentInfoID = name.ID
        
        LEFT JOIN (SELECT StudentInfoID as nGra_student_id FROM student_info
        WHERE (Deletestatus is NULL OR Deletestatus!=1) AND (Graduation IS NULL OR Graduation = '')) as t2 ON t2.nGra_student_id = name.ID
        
        LEFT JOIN (SELECT empid FROM tblcontract
        WHERE (Deletestatus is NULL OR Deletestatus!=1) AND (contract_end_date >= '" . date('Y-m-d') . "')) as t3 ON t3.empid = name.ID
        
        LEFT JOIN (SELECT empid FROM tblcontract
        WHERE (Deletestatus is NULL OR Deletestatus!=1) AND (contract_end_date < '" . date('Y-m-d') . "')) as t4 ON t4.empid = name.ID
        
        LEFT JOIN (SELECT DonorID FROM donations
        WHERE (DeleteStatus IS NULL OR DeleteStatus = '') AND (Campaign != '18' AND Campaign != '26') ) as t5 ON t5.DonorID = name.ID
        
        LEFT JOIN (SELECT EmailID,GROUP_CONCAT(' ',Email) useremail from email where Active = '1' group by EmailID) as t6 ON `name`.`ID` = `t6`.`EmailID` 
        
        LEFT JOIN (select name_id,COUNT(*) as do_not_contactCount FROM tbl_contact_tag WHERE do_not_contact = '1' GROUP BY name_id) as t7 ON t7.name_id = name.ID
        
        
        
        where  `groups`.`DanielVIP` = '1' and `name`.`Deceased` <> 1 and address.`Active` = '1' AND (do_not_contactCount IS NULL OR do_not_contactCount = 0)
        ORDER BY `groups`.`DanielPermissionNeeded` ASC , address.country,`name`.`FirstName` ASC, `name`.`LastName` ASC");

        if ($query->getNumRows() >= 1) {

            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getApplicantGeneralMailReport()
    {
        $query = $this->db->query("SELECT DISTINCT
		
		concat(
            CASE WHEN Foundation = '1' THEN 'Grantmaker Affiliate,' ELSE '' END,
            CASE WHEN Media = '1' THEN 'Media,' ELSE '' END,
            CASE WHEN Appalachian = '1' THEN 'Appalachian Program,' ELSE '' END,
            CASE WHEN BoardMember = '1' THEN 'Past & Present Board Members,' ELSE '' END,
            CASE WHEN StudentFamily = '1' THEN 'Past & Present Student Family,' ELSE '' END,
            CASE WHEN AnnualReport = '1' THEN 'Receives Printed Annual Report,' ELSE '' END,
            CASE WHEN DanielVIP = '1' THEN 'VIP,' ELSE '' END,
            CASE WHEN FriendofDaniel = '1' THEN 'Friend of Daniel/ Not VIP,' ELSE '' END,
            CASE WHEN DanielPermissionNeeded = '1' THEN 'Need Daniel Permission to Contact,' ELSE '' END,
            CASE WHEN GraduationInvite = '1' THEN 'Send Graduation Invitation,' ELSE '' END,
            CASE WHEN QuarterCenturyReport = '1' THEN 'Received Quarter Century Report,' ELSE '' END,
            CASE WHEN prospective_donor = '1' THEN 'Potential Donor,' ELSE '' END,
            CASE WHEN ProspectiveStudent = '1' THEN 'Potential Student,' ELSE '' END,
            
            
            CASE WHEN tribal_college = '1' THEN 'Tribal College,' ELSE '' END,
            CASE WHEN hbcu = '1' THEN 'HBCU,' ELSE '' END,
            CASE WHEN wv_college = '1' THEN 'WV College,' ELSE '' END,
            CASE WHEN appalachia_college = '1' THEN 'Appalachia College,' ELSE '' END,
            CASE WHEN us_college = '1' THEN 'US College,' ELSE '' END,
            CASE WHEN americorps = '1' THEN 'AmeriCorps,' ELSE '' END,
            CASE WHEN peacecorps = '1' THEN 'Peace Corps,' ELSE '' END,
            
            
            
            CASE WHEN Deceased = '1' THEN 'Deceased,' ELSE '' END,
            CASE WHEN Vista = '1' THEN 'Vista,' ELSE '' END,
            CASE WHEN accthold = '1' THEN 'Acct Hold, ' ELSE '' END,
            CASE WHEN t1.StudentInfoID IS NOT NULL THEN 'Alum,' 
            	   ELSE CASE WHEN t2.nGra_student_id IS NOT NULL THEN 'Student,' ELSE '' END 
            END,
            CASE WHEN t3.empid IS NOT NULL THEN 'Current Employee,' 
            	 ELSE CASE WHEN t4.empid IS NOT NULL THEN 'Formal Employee,' ELSE '' END  
            END,
            CASE WHEN do_not_contactCount > 0 THEN 'Do not Contact,' 
            	 ELSE CASE WHEN t4.empid IS NOT NULL THEN 'Formal Employee,' ELSE '' END  
            END,
            
            CASE WHEN t5.DonorID IS NOT NULL THEN 'Donor,' 
            	 ELSE ''  
            END
        ) as tags,t5.DonorID,useremail as email,
        
        
		
		`name`.*, `groups`.`DanielVIP`, `groups`.`DanielPermissionNeeded`, `groups`.`Unsubscribed`,Deceased,
        `address`.*, `StateName`, address.`CountryName`
        FROM (
          (name 
          LEFT JOIN (country RIGHT JOIN (SELECT `ad`.*, `s`.`StateName`, `c`.`CountryName` FROM `address` as `ad` INNER JOIN `country` `c` ON
        `c`.`CountryID`=`ad`.`Country` 
        LEFT JOIN `state` `s` ON `s`.`StateID`=`ad`.`State` WHERE `ad`.`Active` = '1' and `s`.`Active`='1') address ON country.CountryID = address.Country) ON name.ID = address.AddressID)
        LEFT JOIN `groups` ON name.ID = `groups`.`NameLink`) LEFT JOIN (regionprogram RIGHT JOIN student_info ON
        regionprogram.RPID = student_info.Region) ON name.ID = student_info.StudentInfoID
        
        LEFT JOIN (SELECT StudentInfoID FROM student_info as si
        WHERE (Deletestatus is NULL OR Deletestatus!=1) AND (Graduation IS NOT NULL AND Graduation != '')) as t1 
        ON t1.StudentInfoID = name.ID
        
        LEFT JOIN (SELECT StudentInfoID as nGra_student_id FROM student_info
        WHERE (Deletestatus is NULL OR Deletestatus!=1) AND (Graduation IS NULL OR Graduation = '')) as t2 ON t2.nGra_student_id = name.ID
        
        LEFT JOIN (SELECT empid FROM tblcontract
        WHERE (Deletestatus is NULL OR Deletestatus!=1) AND (contract_end_date >= '" . date('Y-m-d') . "')) as t3 ON t3.empid = name.ID
        
        LEFT JOIN (SELECT empid FROM tblcontract
        WHERE (Deletestatus is NULL OR Deletestatus!=1) AND (contract_end_date < '" . date('Y-m-d') . "')) as t4 ON t4.empid = name.ID
        
        LEFT JOIN (SELECT DonorID FROM donations
        WHERE (DeleteStatus IS NULL OR DeleteStatus = '') AND (Campaign != '18' AND Campaign != '26') ) as t5 ON t5.DonorID = name.ID
        
        LEFT JOIN (SELECT EmailID,GROUP_CONCAT(Email) useremail from email where Active = '1' group by EmailID) as t6 ON `name`.`ID` = `t6`.`EmailID` 
        
        LEFT JOIN (select name_id,COUNT(*) as do_not_contactCount FROM tbl_contact_tag WHERE do_not_contact = '1' GROUP BY name_id) as t7 ON t7.name_id = name.ID
        
        
        where  `groups`.`DanielVIP` = '0' and `name`.`Deceased` <> 1 and address.`Active` = '1' AND (do_not_contactCount IS NULL OR do_not_contactCount = 0)
        ORDER BY `groups`.`DanielPermissionNeeded` ASC , address.country,
        `name`.`FirstName` ASC, `name`.`LastName` ASC ");

        if ($query->getNumRows() >= 1) {

            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getApplicantDonorMailReport()
    {

        $builder = $this->db->table('name n');
        $builder->select('n.ID,n.FirstName,n.LastName,n.Greeting,n.spouse,n.Company,n.Addressee,Deceased,g.DanielVIP,g.Unsubscribed,g.DanielPermissionNeeded,
 (select ReceivedDate from donations where DonorID=n.ID AND Campaign NOT IN ("18","22","23","24","26") order by ReceivedDate desc limit 1) as ReceivedDate,
 (select sum(Amount) from donations where DonorID=n.ID AND Campaign NOT IN ("18","22","23","24","26")) as total_amount');
        $builder->join('groups g', 'n.ID=g.NameLink', 'INNER');
        $builder->where('g.Donor', 1);
        $builder->where('n.Deceased', 0);
        $builder->groupBy('n.ID,n.FirstName,n.LastName,n.Greeting,n.spouse,n.Company,n.Addressee,Deceased,g.DanielVIP,g.Unsubscribed,g.DanielPermissionNeeded');
        $builder->having('total_amount IS NOT NULL');
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {

            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getDonationApplicationWiseReport($application_id)
    {

        $builder = $this->db->table('name A');
        $builder->select('B.ReceivedDate,B.PaymentType,B.CheckNumber,B.Amount,A.FirstName,A.LastName');
        $builder->join('donations B', 'A.ID=B.DonorID', 'INNER');
        $builder->where('A.ID', $application_id);
        $builder->orderBy('B.ReceivedDate', 'desc');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getDonationApplicationName($application_id)
    {

        $builder = $this->db->table('name');
        $builder->select('FirstName,LastName');
        $builder->where('ID', $application_id);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getCompleteGPAnew1($application_id)
    {

        $builder = $this->db->table('transcript t');
        $builder->select('t.CreditAttempt,studentid,c.class,t.Grade,t.CreditEarned');
        $builder->join('courselist c', 't.courseid = c.courseid', 'INNER');
        $gradesss = "( t.Grade!='PASS' and t.Grade!='W' and t.Grade!='AUDIT' and t.Grade!='TA' and t.Grade!='TB' and t.Grade!='TC' and t.Grade!='T' and t.Grade!='ENR' )";
        $builder->where($gradesss);
        $deletestatus = "(Deletestatus is NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('t.StudentID', $application_id);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getusertaskbycategoryid($category_id, $application_id, $selected_month, $selected_year)
    {

        $builder = $this->db->table('tbl_contract_transaction t');
        $builder->select('transaction_date,category_id,empid,SUM(FLOOR(hours)) as t_hours,SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes');
        $builder->join('tblcategory c', 't.category_id=c.id', 'INNER');
        $builder->where('t.empid', $application_id);
        $builder->where('month(transaction_date)', $selected_month);
        $builder->where('year(transaction_date)', $selected_year);
        $builder->where('t.category_id', $category_id);
        $builder->groupBy(array("transaction_date", "category_id"));

        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    public function get_course($semester = '', $year = '')
    {
        $builder = $this->db->table('courselist');
        $builder->select('*');
        if ($semester != '') {
            $builder->where('Semester', $semester);
        }
        if ($year != '') {
            $builder->where('Class', $year);
        }
        return   $builder->get()->getResultArray();
    }

    function classSemesterReportByType($type = '', $class = '', $semester = '')
    {

        $builder = $this->db->table('name n');
        $builder->select("n.FirstName as firstname,n.LastName as lastname,n.ID,t.StudentID,t.Grade,t.withdrawn_date,t.completion_date");
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        if ($type != '') {
            $builder->where('t.grade', $type);
        }

        if ($class != '') {
            $builder->where('c.Class', $class);
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }
        if ($this->request->getPost('course') != '') {
            $builder->where('c.CourseID', $this->request->getPost('course'));
        }
        $builder->where('t.Deletestatus IS NULL');


        $builder->groupBy('n.FirstName ,n.LastName,n.ID,t.StudentID,t.Grade,t.withdrawn_date,t.completion_date');

        $query = $builder->get();


        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }



    function classSemesterReportByTypes($type, $class = '', $semester = '')
    {

        $builder = $this->db->table('name n');
        $builder->distinct();
        $builder->select("n.FirstName as firstname,n.LastName as lastname,c.Course as courseid,c.CourseID as course_row_id,c.credits,case when t.grade='w' then 'w' else '' end as withdrawn");
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        $builder->where('t.grade', $type);
        if ($class != '') {
            $builder->where('c.Class', $class);
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }
        if ($this->request->getPost('course') != '') {
            $builder->where('c.CourseID', $this->request->getPost('course'));
        }

        $query = $builder->get();


        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getAllClass()
    {

        $builder = $this->db->table('class');
        $builder->select('*');
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);

        $builder->orderBy('Class', 'DESC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function classSemesterReportByType_range($type, $class = '', $semester = '')
    {

        $builder = $this->db->table('name n');
        $builder->select("n.FirstName as firstname,n.LastName as lastname,n.ID,t.StudentID,t.completion_date");
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        $builder->where('t.grade', $type);

        if ($class != '') {
            $builder->where('c.Class >=', $class);
        }
        if ($this->request->getPost('class_to') != '') {
            $builder->where('c.Class <=', $this->request->getPost('class_to'));
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }
        if ($this->request->getPost('course') != '') {
            $builder->where('c.Course', $this->request->getPost('course'));
        }
        if ($this->request->getPost('course_title') != '') {
            $builder->where('c.CourseTitle', trim($this->request->getPost('course_title'), "&nbsp;"));
        }
        $builder->where('t.Deletestatus IS NULL');


        $builder->groupBy('n.FirstName ,n.LastName,n.ID,t.StudentID,t.completion_date');

        $query = $builder->get();


        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }



    function classSemesterReportByTypes_range($type, $class = '', $semester = '')
    {

        $builder = $this->db->table('name n');
        $builder->distinct();
        $builder->select("n.FirstName as firstname,n.LastName as lastname,c.Semester,c.Course as courseid,c.CourseID as course_row_id,c.Class,c.credits,case when t.grade='w' then 'w' else '' end as withdrawn,case when t.grade='w' then t.withdrawn_date else t.completion_date end as completion_date");
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        $builder->where('t.grade', $type);
        $builder->where('t.Deletestatus is NULL');

        if ($class != '') {
            $builder->where('c.Class >=', $class);
        }
        if ($this->request->getPost('class_to') != '') {
            $builder->where('c.Class <=', $this->request->getPost('class_to'));
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }
        if ($this->request->getPost('course') != '') {
            $builder->where('c.Course', $this->request->getPost('course'));
        }
        if ($this->request->getPost('course_title') != '') {
            $builder->where('c.CourseTitle', trim($this->request->getPost('course_title'), "&nbsp;"));
        }

        $query = $builder->get();


        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function classSemesterReportByClass_range($class, $semester)
    {
        $builder = $this->db->table('name n');
        $builder->distinct();
        $builder->select("n.FirstName as firstname,n.LastName as lastname,c.Semester,c.Course as courseid,c.CourseID as course_row_id,c.Class,c.credits,t.Grade,case when t.grade='w' then 'w' else '' end as withdrawn,t.CreditEarned");
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        if ($class != 'All') {
            $builder->where('c.Class >=', $class);
        }

        if ($this->request->getPost('class_to') != '') {

            $builder->where('c.Class <=', $this->request->getPost('class_to'));
        }

        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }

        if ($this->request->getPost('course') != '') {

            $builder->where('c.Course', $this->request->getPost('course'));
        }

        if ($this->request->getPost('course_title') != '') {

            $builder->where('c.CourseTitle', $this->request->getPost('course_title'));
        }


        $string = "( t.grade<>'')";
        $builder->where($string);

        $query = $builder->get();


        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function classSemesterReportByClasss_range($class, $semester)
    {

        $builder = $this->db->table('name n');
        $builder->distinct();
        $builder->select("n.FirstName as firstname,n.LastName as lastname,n.ID,t.StudentID");
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        $builder->where('t.Deletestatus is Null');
        if ($class != 'All') {
            $builder->where('c.Class >=', $class);
        }
        if ($this->request->getPost('class_to') != '') {
            $builder->where('c.Class <=', $this->request->getPost('class_to'));
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }
        if ($this->request->getPost('course') != '') {
            $builder->where('c.Course', $this->request->getPost('course'));
        }
        if ($this->request->getPost('course_title') != '') {
            $builder->where('c.CourseTitle', $this->request->getPost('course_title'));
        }
        $builder->where('t.Deletestatus IS NULL');

        $string = "( t.grade<>'')";

        $builder->where($string);
        $builder->groupBy('n.FirstName ,n.LastName,n.ID,t.StudentID,t.Grade,t.CreditEarned');

        $query = $builder->get();



        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function Get_staff_of_contract1($selected_year = '', $selected_month = '')

    {
        $date = $selected_year . "-" . $selected_month . "-01";
        $SQL = "SELECT empid FROM tblcontract where contract_begin_date <='" . $date . "' and contract_end_date>='" . $date . "' and deletestatus=0  GROUP BY empid";

        $query = $this->db->query($SQL);
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    public function get_course_in_range($semester = '', $year = '', $year_to = '')
    {
        $builder = $this->db->table('courselist');

        $builder->select('CourseTitle,Course');
        if ($semester != '') {
            $builder->where('Semester', $semester);
        }
        if ($year != '') {
            $builder->where('Class>=', $year);
        }
        if ($year_to != '') {
            $builder->where('Class>=', $year);
        }

        $builder->distinct();
        return   $builder->get()->getResultArray();
    }

    function get_special_program_report($id)
    {
        $builder = $this->db->table('name as n');
        $class = $this->request->getPost('class');
        $class_to = $this->request->getPost('class_to');
        $builder->select("n.ID, FirstName,LastName,c.CountryName as Countries,Ethnicity,citizenship,Birthdate,st.Class,rp.RegionProgram,
        GROUP_CONCAT(sp.Special_Program_Name) as Special_Program_Name
        ");
        $builder->join('student_info as st', 'st.StudentInfoID = n.ID AND st.Deletestatus IS NULL');
        $builder->join('address as ad', 'ad.AddressID = n.ID AND ad.Active = 1', 'left');
        $builder->join('country as c', 'c.CountryID=ad.Country', 'left');
        $builder->join('student_info_market as sm', 'sm.student_info_id = st.Student_RowID AND n.ID = sm.contact_id AND sm.status = "1"');
        $builder->join('mst_special_program as sp', 'sp.Special_ProgramID=sm.market_id');
        $builder->join('regionprogram as rp', 'rp.RPID = st.Region', 'left');
        if ($id != '' && $id != 'All') {
            $builder->where('sp.Special_ProgramID', $id);
        }
        if ($class != '') {
            $builder->where('st.Class>=', $class);
        }
        if ($class_to != '') {
            $builder->where('st.Class<=', $class_to);
        }
        $builder->groupBy(array('Student_RowID', 'CountryName'));
        $query = $builder->get();
        return $query->getResultArray();
    }


    function Get_contrcat_attendance_user($empid = '')
    {
        $builder = $this->db->table('name n');
        $builder->distinct();
        $builder->select('FirstName,LastName,n.ID');
        $builder->join('tblcontract t', 't.empid = n.ID');
        $deletestatus = "t.Deletestatus is NULL OR t.Deletestatus!=1";
        $builder->where($deletestatus);

        if ($empid != '') {
            $builder->where('n.ID', $empid);
        }
        $builder->orderBy('FirstName', 'ASC');

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }



    function check_master_enroll($student_id)
    {
        $builder = $this->db->table('student_info');
        $builder->select('*');
        $deletestatus = "(Deletestatus is NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        return $builder->where(['StudentInfoID' => $student_id, 'master_program' => 'Yes'])
            ->get()
            ->getResultArray();
    }


    function update_transcript_issue_log($application_id = '')
    {
        $builder = $this->db->table('transcript_issue_log');
        if ($application_id == '') {
            return false;
        } else {
            $data = array(
                'user_id' =>  $application_id,
                'created_by' => $_SESSION['NAME_ID'],
                'ip' => $_SERVER['REMOTE_ADDR'],
                'doc_date' => date('Y-m-d', strtotime($this->request->getPost('select_date')))
            );
            $builder->insert($data);
            return true;
        }
    }

    function getSemesterCourseList_without_sch($class, $semester, $term, $student_id, $CourseDates)
    {

        $builder = $this->db->table('transcript A');
        $builder->select('*');
        $builder->join('courselist B', 'A.CourseID=B.CourseID', 'INNER');
        //$builder->join('grades C','A.Grade=C.Grade','INNER'); 
        $builder->join('mst_grades_class mgc', 'B.Class = mgc.class and A.Grade = mgc.Grade', 'INNER');
        $builder->where('A.StudentID', $student_id);
        $builder->where('A.Grade !=', 'SCH');
        $builder->where('B.Class', $class);
        $builder->where('B.Semester', $semester);
        $builder->where('B.Term', $term);
        $builder->where('B.CourseDates', $CourseDates);
        $deletestatus = "(A.Deletestatus is NULL OR A.Deletestatus!=1)";
        $builder->where($deletestatus);
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function  completionsreport($type)
    {
        $post = $this->request->getPost();

        // echo "<pre>";print_r($post);die;

        $age = '';
        if (!empty($post['age'])) {
            $age = (int) date('Y') - (int) $post['age'];  // cast both to integers
        }

        $builder = $this->db->table('name as n');
        $builder->distinct();
        $builder->select("n.ID,FirstName,LastName,
              (case when n.Sex='1' then 'M' when n.Sex='2' then 'F' else n.Sex END) as Sex,Ethnicity,citizenship,STR_TO_DATE(Birthdate,'%m/%d/%Y') as Birthdate,c.CountryName,STR_TO_DATE(Graduation,'%d-%m-%Y') as Graduation");
        //$builder->join('CertTranscript as ct','n.ID = ct.studentID','left');

        //$builder->join('address as ad','ad.AddressID = n.ID AND ad.Active = 1','left');
        $builder->join('country as c', 'c.CountryID=n.citizenship_country', 'left');
        $builder->join('student_info as si', 'si.StudentInfoID = n.ID AND (si.Deletestatus is NULL OR si.Deletestatus!=1)', 'left');
        $builder->join('mst_special_program as sp', 'sp.Special_ProgramID = si.Special_ProgramID', 'left');
        $builder->join('mst_program as p', 'p.ProgramID = si.ProgramID', 'left');

        $builder->join('transcript as t', 't.StudentID = n.ID AND (t.Deletestatus IS NULL OR t.Deletestatus !=1)', 'left');
        $builder->join('courselist as cr', 'cr.CourseID = t.CourseID', 'left');
        //$builder->DISTINCT('ad.AddressID');
        $builder->DISTINCT('si.Student_RowID');
        /*$deletestatus="si.Deletestatus is NULL OR si.Deletestatus!=1";
		$builder->where($deletestatus);*/

        /*if($post['age'] != '')
        {
            if($post['age'] == 'Under 18')
            {
                $start = date('d-m-Y',strtotime('18 years ago'));
                $builder->where("STR_TO_DATE(Birthdate, '%d-%m-%Y') >",$start);
                //year(Birthdate)',);
            }
            //$builder->where('year(Birthdate)',$age);
        }*/
        if ($post['Ethnicity'] != '') {
            if ($post['Ethnicity'] == 'Unknown') {
                $que1 =  "(Ethnicity = '" . $post['Ethnicity'] . "' OR Ethnicity = '')";
                $builder->where($que1);
                //$que =  "(si.Graduation IS NULL OR si.Graduation = '')";

            } else {
                $builder->where('Ethnicity', $post['Ethnicity']);
            }
        }
        if ($post['citizenship'] != '') {
            if ($post['citizenship']  == 'other') {
                $builder->where('citizenship', '');
            } else {
                $builder->where('citizenship', $post['citizenship']);
            }
        }
        if ($post['Country'] != '') {
            if ($post['Country']  == 'other') {
                if ($post['other_country'] != '') {
                    $builder->where('n.citizenship_country', $post['other_country']);
                } else {
                    $builder->where('n.citizenship_country IS NULL');
                }
            } else {
                $builder->where('n.citizenship_country', $post['Country']);
            }
        }
        $builder->where('n.Sex', $type);
        if ($post['Sex'] != '') {
            if ($post['Sex'] == 'Other') {
                $builder->where('n.Sex <>', 'M');
                $builder->where('n.Sex <>', 'F');
                $builder->where('n.Sex <>', '1');
                $builder->where('n.Sex <>', '2');
            } else {
                if ($post['Sex'] == 'F') {
                    $post['Sex'] = explode(",", "F,2");
                }
                if ($post['Sex'] == 'M') {
                    $post['Sex'] = explode(",", "M,1");
                }
                $builder->where('n.Sex', $post['Sex']);
            }
        }
        if ($post['Certificates'] != '') {
            $builder->where('si.ProgramID', $post['Certificates']);
        }
        if ($_POST['special_start'] != '') {
            $builder->where('si.special_start', $_POST['special_start']);
        }
        if ($_POST['special_end'] != '') {
            $builder->where('si.special_end', $_POST['special_end']);
        }
        if ($_POST['program_start'] != '') {
            $builder->where('si.program_start', $_POST['program_start']);
        }
        if ($_POST['program_end'] != '') {
            $builder->where('si.program_end', $_POST['program_end']);
        }
        if ($_POST['enroll_certificate'] != '') {
            if ($_POST['enroll_certificate'] == 'Yes') {
                $builder->where('si.enroll_certificate', $_POST['enroll_certificate']);
            } else {
                $que3 =  "(si.enroll_certificate = '' OR si.enroll_certificate IS NULL OR si.enroll_certificate = 'No')";
                $builder->where($que3);
            }
        }
        if ($_POST['master_program'] != '') {
            if ($_POST['master_program'] == 'Yes') {
                $builder->where('si.master_program', $_POST['master_program']);
            } else {
                $que4 =  "(si.master_program = '' OR si.master_program IS NULL OR si.master_program = 'No')";
                $builder->where($que4);
            }
        }
        if ($_POST['graduation_from'] != '') {
            $date_from = $_POST['graduation_from'] . "-07-01";
            //  $date_from = $_POST['graduation_from'];
            //$builder->where("STR_TO_DATE(si.Graduation,'%d-%m-%Y') >=",date('Y',strtotime($_POST['graduation_from'])));
            $builder->where("STR_TO_DATE(si.Graduation,'%d-%m-%Y') >=", date('Y-m-d', strtotime($date_from)));
        }
        if ($_POST['graduation_to'] != '') {
            $date_to = $_POST['graduation_to'] . "-06-30";
            //$date_to = $_POST['graduation_to'];
            $builder->where("STR_TO_DATE(si.Graduation,'%d-%m-%Y') <=", date('Y-m-d', strtotime($date_to)));
        }
        if ($_POST['graduate_state'] != '') {
            if ($_POST['graduate_state'] == 'Yes') {
                $builder->where('si.Graduation IS NOT NULL');
                $builder->where('si.Graduation !=', '');
            } else if ($_POST['graduate_state'] == 'No') {
                $builder->where('t.Grade !=', 'SCH');
                $que =  "(si.Graduation IS NULL OR si.Graduation = '')";
                $builder->where($que);
                //$builder->or_where('si.Graduation','');
                // $builder->where('t.Grade !=','W');
            }
            /*else
            {
                $que =  "(si.Graduation IS NULL OR si.Graduation = '')";
                $builder->where($que);
               //$builder->or_where('si.Graduation','');
            }*/
        }
        if ($_POST['withdrawn'] != '') {
            if ($_POST['withdrawn'] == 'Yes') {
                $builder->where('si.withdrawn is NOT NULL');
                $builder->where('si.withdrawn <>', '');
            }
            if ($_POST['withdrawn'] == 'No') {
                $que5 =  "(si.withdrawn IS NULL OR si.withdrawn = '')";
                $builder->where($que5);
            }
        }
        if ($_POST['not_graduation_from'] != '') {
            // $builder->where('cr.Class >=',$_POST['not_graduation_from']);
            $builder->where('cr.start_date >=', date('Y-m-d', strtotime($_POST['not_graduation_from'])));
        }
        if ($_POST['not_graduation_to'] != '') {
            //$builder->where('cr.Class <=',$_POST['not_graduation_to']);   
            $builder->where('cr.end_date <=', date('Y-m-d', strtotime($_POST['not_graduation_to'])));
        }
        if ($_POST['graduation_any_from'] != '') {
            // $builder->where('cr.Class >=',$_POST['not_graduation_from']);
            $builder->where('cr.start_date >=', date('Y-m-d', strtotime($_POST['graduation_any_from'])));

            $c_data = "(STR_TO_DATE(si.Graduation,'%d-%m-%Y') >= '" . date('Y-m-d', strtotime($_POST['graduation_any_from'])) . "')";

            $builder->orWhere($c_data);
        }
        if ($_POST['graduation_any_to'] != '') {
            //$builder->where('cr.Class <=',$_POST['not_graduation_to']);   
            $builder->where('cr.end_date <=', date('Y-m-d', strtotime($_POST['graduation_any_to'])));

            $c_data = "(STR_TO_DATE(si.Graduation,'%d-%m-%Y') <= '" . date('Y-m-d', strtotime($_POST['graduation_any_to'])) . "')";

            $builder->orWhere($c_data);
        }


        if (!empty($this->request->getPost('column'))) {
            $post = $this->request->getPost();
            foreach ($post['column'] as $key => $val) {
                if ($val != '') {
                    $graduate = encryptor('decrypt', $val);
                    if ($graduate == 'Graduation') {
                        $sql = "STR_TO_DATE(Graduation,'%d-%m-%Y') " . $post['order_type'][$key];
                        $builder->orderBy($sql);
                    } else {
                        $builder->orderBy(encryptor('decrypt', $val), $post['order_type'][$key]);
                    }
                }
            }
        }


        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }



    function  fallenrollmentreport($gender = '')
    {
        $post = $this->request->getPost();

        $builder = $this->db->table('transcript as t');
        $builder->distinct();
        $builder->distinct();
        $builder->select("n.ID,FirstName,LastName,
              n.Sex,Ethnicity,citizenship");
        $builder->join('name as n', 'n.ID = t.StudentID');
        $builder->join('courselist as c', 'c.CourseID = t.CourseID AND t.StudentID = n.ID');
        $builder->where('n.Sex', $gender);
        $deletestatus = "(t.Deletestatus is NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        if ($this->request->getPost('program_start') != '') {
            $builder->where('cast(c.start_date as char)!=', '');

            $begin = $this->request->getPost('start_program_date') . $this->request->getPost('program_start');
            $begin_date = date('Y-m-d', strtotime($begin));
            $builder->where('start_date >=', $begin_date);
        }
        if ($this->request->getPost('program_end') != '') {
            $end = $this->request->getPost('end_program_date') . $this->request->getPost('program_end');
            $end_date = date('Y-m-d', strtotime($end));
            $builder->where('start_date <=', $end_date);
        }
        if ($this->request->getPost('semester') != '') {
            $builder->where('c.Semester', $this->request->getPost('semester'));
        }
        $builder->orderBy('FirstName', 'ASC');
        return $builder->get()->getResultArray();
    }


    function classFallSemesterReportByClass($gender = '')
    {

        $builder = $this->db->table('name n');
        $builder->distinct();
        $builder->select("n.FirstName as firstname,c.Class,sd.order_no,n.LastName as lastname,c.Course as courseid,c.CourseID as course_row_id,(case when t.grade='AUDIT' then '0' else c.credits END) as credits,case when t.grade='w' then 'w' else '' end as withdrawn");
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        $builder->join('semester_details sd', 'sd.semester = c.Semester');
        if ($gender != '') {
            $builder->where('n.Sex', $gender);
        }
        if ($this->request->getPost('semester') != '') {
            $builder->where('c.Semester', $this->request->getPost('semester'));
        }

        if ($this->request->getPost('program_start') != '') {
            $begin = $this->request->getPost('start_program_date') . $this->request->getPost('program_start');
            $begin_date = date('Y-m-d', strtotime($begin));

            $builder->where('start_date >=', $begin_date);
        }
        if ($this->request->getPost('program_end') != '') {
            $end_date = $this->request->getPost('end_program_date') . $this->request->getPost('program_end');
            $end_date = date('Y-m-d', strtotime($end_date));

            $builder->where('start_date <=', $end_date);
        }


        $string = "( t.grade<>'')";
        $builder->where($string);
        $builder->where('t.Deletestatus IS NULL');
        $builder->orderBy('c.Class', 'ASC');
        $builder->orderBy('sd.order_no', 'ASC');
        $builder->orderBy('c.CourseID', 'ASC');
        $query = $builder->get();


        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }
    function classFallSemesterReportByClasss($gender = '')
    {

        $builder = $this->db->table('name n');
        $builder->select("n.FirstName as firstname,n.LastName as lastname,n.ID,n.Sex,n.Ethnicity,t.StudentID,t.Deletestatus");
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        $builder->where('n.Sex', $gender);
        if ($this->request->getPost('semester') != '') {
            $builder->where('c.Semester', $this->request->getPost('semester'));
        }

        if ($this->request->getPost('program_start') != '') {
            $begin = $this->request->getPost('start_program_date') . $this->request->getPost('program_start');
            $begin_date = date('Y-m-d', strtotime($begin));

            $builder->where('start_date >=', $begin_date);
        }
        if ($this->request->getPost('program_end') != '') {
            $end_date = $this->request->getPost('end_program_date') . $this->request->getPost('program_end');
            $end_date = date('Y-m-d', strtotime($end_date));

            $builder->where('start_date <=', $end_date);
        }

        $string = "( t.grade<>'' and (t.Deletestatus is NULL OR t.Deletestatus!=1))";

        $builder->where($string);
        $builder->groupBy('n.FirstName ,n.LastName,n.ID,t.StudentID,t.Deletestatus');

        $query = $builder->get();


        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    public function get_filter_course($semester = '')
    {
        $builder = $this->db->table('courselist');
        $builder->select('*');
        if ($semester != '') {
            $builder->where('Semester', $semester);
        }
        if ($this->request->getPost('program_start') != '') {
            $begin_date = date('Y-m-d', strtotime($this->request->getPost('program_start')));
            $builder->where('start_date >=', $begin_date);
        }
        if ($this->request->getPost('program_end') != '') {
            $end_date = date('Y-m-d', strtotime($this->request->getPost('program_end')));
            $builder->where('start_date <=', $end_date);
        }
        return   $builder->get()->getResultArray();
    }


    function enrolled_semester($unique_types = '')
    {
        $builder = $this->db->table('courselist as c');
        $builder->distinct();
        $builder->select('c.Class,c.Semester,sd.order_no');
        $builder->join('semester_details sd', 'sd.semester = c.Semester');
        $builder->whereIn('c.CourseID', $unique_types);
        if ($this->request->getPost('program_start') != '') {
            $begin = $this->request->getPost('start_program_date') . $this->request->getPost('program_start');
            $begin_date = date('Y-m-d', strtotime($begin));
            $builder->where('start_date >=', $begin_date);
        }
        if ($this->request->getPost('program_end') != '') {
            $end = $this->request->getPost('end_program_date') . $this->request->getPost('program_end');
            $end_date = date('Y-m-d', strtotime($end));

            $builder->where('start_date <=', $end_date);
        }
        $builder->orderBy('c.Class', 'ASC');

        $builder->orderBy('sd.order_no', 'ASC');
        return $builder->get()->getResultArray();
    }


    function classFall2SemesterReportByClass($gender = '')
    {

        $builder = $this->db->table('name n');
        $builder->distinct();
        $builder->select("n.FirstName as firstname,c.Class,sd.order_no,n.LastName as lastname,c.Course as courseid,c.CourseID as course_row_id,(case when t.grade='AUDIT' then '0' else c.credits END) as credits,case when t.grade='w' then 'w' else '' end as withdrawn");
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        $builder->join('semester_details sd', 'sd.semester = c.Semester');

        $withdrawn_condition = "(";
        $withdrawn_condition .= "t.withdrawn_date IS NULL OR  CAST(t.withdrawn_date AS CHAR) = '0000-00-00'";
        if ($this->request->getPost('program_start') != '') {
            $wdate = $this->request->getPost('program_start') . '-10-15';
            $withdrawn_condition .= " OR t.withdrawn_date >= '" . $wdate . "'";
        }
        $withdrawn_condition .= ")";
        $builder->where($withdrawn_condition);

        if ($gender != '') {
            if ($gender == 'F') {
                $gender = explode(",", "F,2");
            }
            if ($gender == 'M') {
                $gender = explode(",", "M,1");
            }
            $builder->whereIn('n.Sex', $gender);
        }
        if ($this->request->getPost('semester') != '') {
            $builder->where('c.Semester', $this->request->getPost('semester'));
        }
        if ($this->request->getPost('program_start') != '') {
            $builder->where('c.Class', $this->request->getPost('program_start'));
        }
        $string = "( t.grade<>'')";
        $builder->where($string);
        $builder->where('t.Deletestatus IS NULL');
        $builder->orderBy('c.Class', 'ASC');
        $builder->orderBy('sd.order_no', 'ASC');
        $builder->orderBy('c.CourseID', 'ASC');
        $query = $builder->get();


        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function classFall2SemesterReportByClasss($gender = '')
    {

        $builder = $this->db->table('name n');
        $builder->select(
            "n.FirstName as firstname,n.LastName as lastname,n.ID,
      (case when n.Sex='1' then 'M' when n.Sex='2' then 'F' else n.Sex END) as Sex,
      n.Ethnicity,n.Birthdate,t.StudentID,t.Deletestatus"
        );
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');

        $withdrawn_condition = "(";
        $withdrawn_condition .= "t.withdrawn_date IS NULL OR  CAST(t.withdrawn_date AS CHAR) = '0000-00-00'";
        if ($this->request->getPost('program_start') != '') {
            $wdate = $this->request->getPost('program_start') . '-10-15';
            $withdrawn_condition .= " OR t.withdrawn_date >= '" . $wdate . "'";
        }
        $withdrawn_condition .= ")";
        $builder->where($withdrawn_condition);
        if ($gender == 'F') {
            $gender = explode(",", "F,2");
        }
        if ($gender == 'M') {
            $gender = explode(",", "M,1");
        }
        $builder->whereIn('n.Sex', $gender);
        if ($this->request->getPost('semester') != '') {
            $builder->where('c.Semester', $this->request->getPost('semester'));
        }

        if ($this->request->getPost('program_start') != '') {
            $builder->where('c.Class', $this->request->getPost('program_start'));
        }

        $string = "( t.grade<>'' and (t.Deletestatus is NULL OR t.Deletestatus!=1))";

        $builder->where($string);
        $builder->groupBy('n.FirstName ,n.LastName,n.ID,t.StudentID,t.Deletestatus');

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function  fallenrollmentreport2($gender = '')
    {
        $post = $this->request->getPost();

        $builder = $this->db->table('transcript as t');
        $builder->distinct();
        $builder->distinct();
        $builder->select("n.ID,FirstName,LastName,
                        n.Sex,Ethnicity,citizenship,Birthdate");
        $builder->join('name as n', 'n.ID = t.StudentID');
        $builder->join('courselist as c', 'c.CourseID = t.CourseID AND t.StudentID = n.ID');
        $builder->where('n.Sex', $gender);
        $deletestatus = "(t.Deletestatus is NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        $withdrawn_condition = "(";
        $withdrawn_condition .= "t.withdrawn_date IS NULL OR CAST(t.withdrawn_date AS CHAR) = '0000-00-00'";
        if ($this->request->getPost('program_start') != '') {
            $wdate = $this->request->getPost('program_start') . '-10-15';
            $withdrawn_condition .= " OR t.withdrawn_date >= '" . $wdate . "'";
        }
        $withdrawn_condition .= ")";
        $builder->where($withdrawn_condition);

        if ($this->request->getPost('program_start') != '') {
            $builder->where('c.Class', $this->request->getPost('program_start'));
        }

        if ($this->request->getPost('semester') != '') {
            $builder->where('c.Semester', $this->request->getPost('semester'));
        }
        $builder->orderBy('FirstName', 'ASC');
        return $builder->get()->getResultArray();
    }


    function get_user_course_with_filter2($student_id, $selected_program_start = '', $selected_semester = '')
    {
        $builder = $this->db->table('transcript as t');
        $builder->distinct();
        $builder->select("c.CourseID,c.Semester,c.Class,c.Course,c.CourseTitle,c.start_date,c.end_date,t.StudentID,(case when t.grade='AUDIT' then '0' else c.credits END) as credits");
        $builder->join('courselist as c', 'c.CourseID = t.CourseID AND t.StudentID = ' . $student_id);

        $deletestatus = "(t.Deletestatus is NULL OR t.Deletestatus != 1)";
        $builder->where($deletestatus);
        if ($selected_program_start != '') {
            $builder->where('c.Class', $selected_program_start);
        }
        if ($selected_semester != '') {
            $builder->where('c.Semester', $this->request->getPost('semester'));
        }
        return $builder->get()->getResultArray();
    }

    function get_special_program_name()
    {
        $builder = $this->db->table('mst_special_program');
        $data =  $builder->select('')
            ->whereIn('Special_ProgramID', explode(",", $this->request->getPost('special_program_excel')))
            ->get()
            ->getResultArray();
        $data = array_column($data, 'Special_Program_Name');
        return implode(",", $data);
    }

    function get_program_name()
    {
        $builder = $this->db->table('mst_program');
        $data =  $builder->select('')
            ->where('ProgramID', $this->request->getPost('program'))
            ->get()
            ->getRowArray();
        return $data['Program_Name'];
    }

    function getDonationMonthWiseReport_without_tuition_credit_refund($begin_date, $end_date)
    {
        $begin_date = date('d-m-Y', strtotime($begin_date));
        $end_date   = date('d-m-Y', strtotime($end_date));

        $query = $this->db->query("select month(STR_TO_DATE(ReceivedDate,'%d-%m-%Y')) as month,year(STR_TO_DATE(ReceivedDate,'%d-%m-%Y')) as year from donations where STR_TO_DATE(ReceivedDate,'%d-%m-%Y')>=STR_TO_DATE('$begin_date','%d-%m-%Y') AND STR_TO_DATE(ReceivedDate,'%d-%m-%Y')<=STR_TO_DATE('$end_date','%d-%m-%Y') AND Campaign NOT IN ('18','22','23','26') group by year,month order by year,month");
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getmonthlydonationsExcelreport_without_tuition_credit_refund()
    {

        $builder = $this->db->table('donations as d');
        $builder->select('d.*,n.FirstName,n.LastName,n.Company,C.CampaignName');
        $builder->join('name as n', 'n.ID = d.DonorID');
        $builder->join('campaigns C', 'd.Campaign=C.CampaignID ');
        $builder->whereNotIn('d.Campaign', array('18', '22', '23', '26'));
        if ($this->request->getPost('excel_begin_date') != '') {
            $begin = date('Y-m-d', strtotime($this->request->getPost('excel_begin_date')));
            $sql = "STR_TO_DATE(d.ReceivedDate,'%d-%m-%Y') >= '$begin'";
            $builder->where($sql);
        }
        if ($this->request->getPost('excel_end_date') != '') {
            $end = date('Y-m-d', strtotime($this->request->getPost('excel_end_date')));
            $sql = "STR_TO_DATE(d.ReceivedDate,'%d-%m-%Y') <= '$end'";
            $builder->where($sql);
        }

        $deletestatus = "(d.Deletestatus is NULL OR d.Deletestatus!=1)";
        $builder->where($deletestatus);
        $sql = "STR_TO_DATE(d.ReceivedDate,'%d-%m-%Y') ASC,n.FirstName ASC";
        $builder->orderBy($sql);
        $query = $builder->get();
        //	$query = $builder->query($qry);
        // echo $query->num_rows(); die;
        // echo $builder->last_query(); die;
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function donationCampaignReport()
    {
        $begin_date = '';
        $end_date  = '';

        if ($this->request->getPost('begin_date') != '') {
            $begin_date = date('d-m-Y', strtotime($this->request->getPost('begin_date')));
        }
        if ($this->request->getPost('end_date') != '') {
            $end_date   = date('d-m-Y', strtotime($this->request->getPost('end_date')));
        }

        $builder = $this->db->table('donations as d');
        $builder->select('d.*,STR_TO_DATE(d.ReceivedDate,"%d-%m-%Y") as ReceivedDate,STR_TO_DATE(d.ReceiptDae,"%d-%m-%Y") as ReceiptDae,n.FirstName,n.LastName,c.CampaignName')
            ->join('name as n', 'n.ID = d.DonorID')
            ->join('campaigns as c', 'c.CampaignID = d.Campaign');
        if ($begin_date != '') {
            $sql  = "(STR_TO_DATE(ReceivedDate,'%d-%m-%Y')>=STR_TO_DATE('$begin_date','%d-%m-%Y')) ";
            $builder->where($sql);
        }
        if ($end_date != '') {
            $sql  = "(STR_TO_DATE(ReceivedDate,'%d-%m-%Y')<=STR_TO_DATE('$end_date','%d-%m-%Y')) ";
            $builder->where($sql);
        }
        if ($this->request->getPost('campaign_id') != '') {
            $builder->where('Campaign', $this->request->getPost('campaign_id'));
        }

        $deletestatus = "(d.Deletestatus is NULL OR d.Deletestatus!=1)";
        $builder->where($deletestatus);
        if (!empty($this->request->getPost('column'))) {
            $post = $this->request->getPost();
            foreach ($post['column'] as $key => $val) {
                if ($val != '') {
                    if (encryptor('decrypt', $val) == 'ReceiptDae') {
                        $sql = "STR_TO_DATE(d.ReceiptDae,'%d-%m-%Y') " . $post['order_type'][$key];
                        $builder->orderBy($sql);
                    } else if (encryptor('decrypt', $val) == 'ReceivedDate') {
                        $sql = "STR_TO_DATE(d.ReceivedDate,'%d-%m-%Y') " . $post['order_type'][$key];
                        $builder->orderBy($sql);
                    } else {
                        $builder->orderBy(encryptor('decrypt', $val), $post['order_type'][$key]);
                    }
                }
            }
        } else {
            $sql = "STR_TO_DATE(d.ReceivedDate,'%d-%m-%Y') ASC";
            $builder->orderBy($sql);
        }
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getContactUser()
    {
        $builder = $this->db->table('name as n');
        return $builder->select('n.ID,n.FirstName,n.LastName,n.position,n.Company,n.Deceased,n.Sex,n.Note,
	                              n.boardHistory,n.Birthdate,n.Ethnicity,
	                              (CASE WHEN citizenship = "Not US Citizen" THEN c.CountryName ELSE "United States" END) as CountryName')
            ->join('country as c', 'c.CountryID = n.citizenship_country', 'left')
            ->orderBy('n.FirstName', 'ASC')
            ->get()
            ->getResultArray();
    }

    function get_email_by_status($user_id = '', $status = '')
    {
        $builder = $this->db->table('email');
        $builder->select('Email');
        if ($user_id != '') {
            $builder->where('EmailID', $user_id);
        }
        if ($status != '') {
            $builder->where('Active', $status);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }

    function get_address_by_status($user_id = '', $status = '')
    {
        $builder = $this->db->table('address as ad');
        $builder->select('ad.*,s.StateName,c.CountryName');
        $builder->join('state as s', 's.StateID = ad.State AND s.Active = "1"', 'left');
        $builder->join('country as c', 'c.CountryID = ad.Country', 'left');

        if ($user_id != '') {
            $builder->where('ad.AddressID', $user_id);
        }
        if ($status != '') {
            $builder->where('ad.Active', $status);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }


    function get_international_address_by_status($user_id = '', $status = '')
    {
        $builder = $this->db->table('address_international as ad');
        $builder->select('ad.*,c.CountryName');
        $builder->join('country as c', 'c.CountryID = ad.Country_int', 'left');

        if ($user_id != '') {
            $builder->where('ad.AddressID_int', $user_id);
        }
        if ($status != '') {
            $builder->where('ad.Active_int', $status);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }

    function get_phone_by_status($user_id = '', $status = '')
    {
        $builder = $this->db->table('USPhone as u');
        $builder->select('u.Number,u.Extension,p.PhoneType');
        $builder->join('PhoneType as p', 'u.Type = p.Id');
        if ($user_id != '') {
            $builder->where('u.Id', $user_id);
        }
        if ($status != '') {
            $builder->where('u.Active', $status);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }


    function get_track_name()
    {
        $builder = $this->db->table('track');
        $data =  $builder->select('track_name')
            ->whereIn('id', explode(",", $this->request->getPost('track_excel')))
            ->get()
            ->getResultArray();
        $data = array_column($data, 'track_name');
        return implode(",", $data);
    }

    function getApplicantDonorMailReport_New()
    {
        $SQL = "SELECT UserCampaignName,useremail,useraddress,`n`.`ID`, `n`.`FirstName`, `n`.`LastName`, `n`.`Greeting`, `n`.`spouse`, `n`.`Company`, `n`.`Addressee`, `Deceased`, `g`.`DanielVIP`, `g`.`Unsubscribed`, `g`.`DanielPermissionNeeded`, 
            (select ReceivedDate from donations where DonorID=n.ID AND Campaign NOT IN ('18', '22', '23', '24', '26') AND (Deletestatus is NULL OR Deletestatus!=1) order by STR_TO_DATE(ReceivedDate,'%d-%m-%Y') desc limit 1) as ReceivedDate,
            (select ReceivedDate from donations where DonorID=n.ID AND Campaign NOT IN ('18', '22', '23', '24', '26')  AND (Deletestatus is NULL OR Deletestatus!=1) order by STR_TO_DATE(ReceivedDate,'%d-%m-%Y') ASC limit 1) as FirstReceivedDate,
            (select sum(Amount) from donations where DonorID=n.ID AND Campaign NOT IN ('18', '22', '23', '24', '26') AND (Deletestatus is NULL OR Deletestatus!=1))  as total_amount,
            (SELECT COUNT('*') FROM donations WHERE DonorID=n.ID AND Campaign NOT IN ('18', '22', '23', '24', '26') AND (Deletestatus is NULL OR Deletestatus!=1)) as count_dononation
            FROM `name` `n`
            LEFT JOIN `groups` `g` ON `n`.`ID`=`g`.`NameLink`
            left join (SELECT EmailID,GROUP_CONCAT(Email) useremail from email where Active = '1' group by EmailID)  as t1  on n.ID = t1.EmailID
            
            left join (SELECT AddressID,GROUP_CONCAT(CONCAT(city,' ',s.StateName,' ',c.CountryName)) useraddress from address
            left JOIN country as c ON c.CountryID = Country
            LEFT JOIN state as s ON s.StateID = State
            where address.Active = '1' group by AddressID)  as t2  on n.ID = t2.AddressID
            
            left join (SELECT DonorID,GROUP_CONCAT( DISTINCT CampaignName) UserCampaignName from donations
            left JOIN campaigns as c1 ON c1.CampaignID = Campaign
             where (donations.Deletestatus is NULL OR donations.Deletestatus!=1)
                       group by DonorID)  as t3  on n.ID = t3.DonorID
            
            WHERE  `n`.`Deceased` =0 
            GROUP BY `n`.`ID`, `n`.`FirstName`, `n`.`LastName`, `n`.`Greeting`, `n`.`spouse`, `n`.`Company`, `n`.`Addressee`, `Deceased`, `g`.`DanielVIP`, `g`.`Unsubscribed`, `g`.`DanielPermissionNeeded` HAVING `total_amount` IS NOT NULL  AND  count_dononation > 0
            ORDER BY n.FirstName ASC,n.LastName ASC";
        $query = $this->db->query($SQL);
        return $query->getResultArray();
    }


    function get_export_contact_result()
    {
        $sql = 'SELECT DISTINCT board_history,n.ID,n.FirstName as FirstName ,n.LastName as LastName,Company,Spouse,Position,Note,boardHistory,Addressee,Greeting,
        useremail as ActiveEmail,userInActiveEmail,userPhone as ActivePhone,ad.*,userInActivePhone,cn.CountryName,inActiveAddress,ActiveInternationalAddress,inActiveInternationalAddress,
        
        concat(
            CASE WHEN donorCount > 0 THEN "Donor, " ELSE "" END,
            CASE WHEN totalContract > 0  THEN "CurrentEmployee, "  ELSE "" END,
            CASE WHEN totalPastContract > 0  THEN "FormalEmployee, "  ELSE "" END,
            CASE WHEN Foundation = "1" THEN "Grantmaker Affiliate, " ELSE "" END,
            CASE WHEN Media = "1" THEN "Media, " ELSE "" END,
            CASE WHEN Appalachian = "1" THEN "Appalachian Program, " ELSE "" END,
            CASE WHEN BoardMember = "1" THEN "Past & Present Board Members, " ELSE "" END,
            CASE WHEN StudentFamily = "1" THEN "Past & Present Student Family, " ELSE "" END,
            CASE WHEN AnnualReport = "1" THEN "Receives Printed Annual Report, " ELSE "" END,
            CASE WHEN DanielVIP = "1" THEN "VIP, " ELSE "" END,
            CASE WHEN FriendofDaniel = "1" THEN "Friend of Daniel/ Not VIP, " ELSE "" END,
            CASE WHEN DanielPermissionNeeded = "1" THEN "Need Daniel Permission to Contact, " ELSE "" END,
            CASE WHEN GraduationInvite = "1" THEN "Send Graduation Invitation, " ELSE "" END,
            CASE WHEN QuarterCenturyReport = "1" THEN "Received Quarter Century Report, " ELSE "" END,
            CASE WHEN prospective_donor = "1" THEN "Potential Donor, " ELSE "" END,
            CASE WHEN ProspectiveStudent = "1" THEN "Potential Student, " ELSE "" END,
            
            
            CASE WHEN tribal_college = "1" THEN "Tribal College," ELSE "" END,
            CASE WHEN hbcu = "1" THEN "HBCU," ELSE "" END,
            CASE WHEN wv_college = "1" THEN "WV College," ELSE "" END,
            CASE WHEN appalachia_college = "1" THEN "Appalachia College," ELSE "" END,
            CASE WHEN us_college = "1" THEN "US College," ELSE "" END,
            CASE WHEN americorps = "1" THEN "AmeriCorps," ELSE "" END,
            CASE WHEN peacecorps = "1" THEN "Peace Corps," ELSE "" END,
            
            
            CASE WHEN Deceased = "1" THEN "Deceased, " ELSE "" END,
            CASE WHEN Vista = "1" THEN "Vista, " ELSE "" END,
            CASE WHEN accthold = "1" THEN "Acct Hold, " ELSE "" END,
            CASE WHEN do_not_contactCount > 0 THEN "Do Not Contact," ELSE "" END ,
            CASE WHEN alumStudent > 0  THEN "Alum"  ELSE "" END,
            CASE WHEN t21.transcriptCount > 0 THEN
              CASE WHEN (SELECT COUNT(*) as sCount from student_info WHERE (StudentInfoID = n.ID AND Graduation IS NOT NULL AND Graduation != "") AND (Deletestatus IS NULL OR Deletestatus!="1") ) > 0 
            		THEN "" 
            		ELSE "Student," 
              END
            ELSE "" END
        ) as tags
        
        FROM name as n 
        left join address as ad ON ad.AddressID = n.ID and ad.Active = "1"
        left join (SELECT EmailID,GROUP_CONCAT(concat(Email," ")) useremail from email where Active = "1" group by EmailID)  as t1  on n.ID = t1.EmailID
        left join (SELECT EmailID,GROUP_CONCAT(concat(Email," ")) userInActiveEmail from email where (Active = "0" OR Active IS NULL) group by EmailID)  as t2  on n.ID = t2.EmailID
        LEFT JOIN (SELECT USPhone.Id,GROUP_CONCAT(CONCAT(pt.PhoneType," - ",Number),"\n") userPhone FROM USPhone
                   LEFT JOIN PhoneType as pt ON pt.Id = Type
                   WHERE USPhone.Active = "1" group by Id) as t3 ON t3.Id = n.ID
        LEFT JOIN country as cn ON cn.CountryID = ad.Country AND ad.Active = "1"
        LEFT JOIN `groups` as g ON g.NameLink = n.ID
        LEFT JOIN (SELECT DonorID,COUNT(*) as donorCount from donations WHERE Campaign NOT IN ("18","22","23") AND (Deletestatus IS NULL OR Deletestatus!="1") group by DonorID ) as t4 ON n.ID = t4.DonorID
        LEFT JOIN (select empid,COUNT(*) as totalContract FROM tblcontract as tc WHERE (tc.Deletestatus IS NULL OR tc.Deletestatus!="1") AND empid IN (SELECT tc1.empid FROM tblcontract as tc1 WHERE tc1.contract_end_date >= CURDATE()) group by empid) as t5 ON t5.empid = n.ID
        LEFT JOIN (select empid,COUNT(*) as totalPastContract FROM tblcontract as xtc WHERE (xtc.Deletestatus IS NULL OR xtc.Deletestatus!="1") AND empid NOT IN (SELECT xtc1.empid FROM tblcontract as xtc1 WHERE xtc1.contract_end_date >= CURDATE()) group by empid) as t6 ON t6.empid = n.ID
        LEFT JOIN (select StudentInfoID,COUNT(*) as alumStudent FROM student_info as si WHERE (si.Deletestatus IS NULL OR si.Deletestatus!="1") AND Graduation IS NOT NULL AND Graduation != ""  GROUP BY StudentInfoID) as t7 ON t7.StudentInfoID = n.ID
        
        LEFT JOIN (select name_id,COUNT(*) as do_not_contactCount FROM tbl_contact_tag WHERE do_not_contact = "1" GROUP BY name_id) as t20 ON t20.name_id = n.ID
        
        LEFT JOIN  (SELECT StudentID,COUNT(*) as transcriptCount FROM transcript as t 
                            JOIN courselist as cl ON cl.CourseID = t.CourseID WHERE  (t.Deletestatus IS NULL OR t.Deletestatus!="1") AND t.Grade != "SCH" GROUP BY StudentID ) as t21 ON t21.StudentID = n.ID
        
        LEFT JOIN (SELECT bi.name_id,GROUP_CONCAT(CONCAT("Organization - ",name," Start Date - ",start_date," End Date - ",end_date,"\n")) board_history from BoardInfo as bi
                    JOIN tbl_organization as org ON org.id = bi.org_id
                    where (bi.Deletestatus = "0" or bi.Deletestatus IS NULL) group by name_id)  as tb1  on n.ID = tb1.name_id
                    
        
        
        LEFT JOIN (SELECT USPhone.Id,GROUP_CONCAT(CONCAT(pt.PhoneType," - ",Number),"\n") userInActivePhone FROM USPhone
                   LEFT JOIN PhoneType as pt ON pt.Id = Type
                   WHERE (USPhone.Active = "0" OR USPhone.Active IS NULL ) group by Id) as t10 ON t10.Id = n.ID
        LEFT JOIN (SELECT AddressID, GROUP_CONCAT(CONCAT( "{ Street Address - ",sb_ad.Street_Address," Address2 - ",sb_ad.Address2," City- ",sb_ad.City," State- ",sb_ad.State," Postal Code- ",sb_ad.Postal_Code," Country- ",sb_ad.Country ,"}"),"\n")  inActiveAddress from address as sb_ad where sb_ad.Active = "0" group by AddressID) as t11 ON t11.AddressID = n.ID
        
        LEFT JOIN (SELECT AddressID_int, GROUP_CONCAT(CONCAT( "{ Address1 - ",company_name," Address2 - ",
                    Street_Address_int," Address3- ",Address2_int, " Locale- ",City_int," Country- ",Country_int,"}"),"\n")  ActiveInternationalAddress from address_international where Active_int = "1" group by AddressID_int) as t12 ON t12.AddressID_int = n.ID
                    
                    LEFT JOIN (SELECT AddressID_int, GROUP_CONCAT(CONCAT( "{ Address1 - ",company_name," Address2 - ",
                    Street_Address_int," Address3- ",Address2_int, " Locale- ",City_int," Country- ",Country_int,"}"),"\n")  inActiveInternationalAddress from address_international where Active_int = "0" group by AddressID_int) as t13 ON t13.AddressID_int = n.ID
        
        ';
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    function get_course_wise_student($type = '', $class = '', $semester = '')
    {

        $builder = $this->db->table('name n');
        $builder->select("n.ID,n.FirstName as firstname,n.LastName as lastname,n.ID,t.*,mgc.GradeValue,c.Class");
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        $builder->join('mst_grades_class mgc', 'mgc.class = c.Class AND t.Grade = mgc.Grade');
        if ($type != '') {
            $builder->where('t.grade', $type);
        }
        if ($class != '') {
            $builder->where('c.Class', $class);
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }
        if ($this->request->getPost('course') != '') {
            $builder->where('c.CourseID', $this->request->getPost('course'));
        }
        if ($this->request->getPost('grade') != '') {
            $builder->where('t.Grade', $this->request->getPost('grade'));
        }
        $builder->where('t.Deletestatus IS NULL');
        //$builder->groupBy('n.FirstName ,n.LastName,n.ID,t.*');
        $builder->orderBy('n.FirstName', 'ASC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getTotalforFisicalYear_2($application_id, $start_date, $end_date)
    {
        $SQL = "SELECT `empid`,  SUM(FLOOR(hours)) as t_hours,
        SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` INNER JOIN `tblcategory` `c`
        ON `t`.`category_id`=`c`.`id`  WHERE `t`.`transaction_date` >= '" . $start_date . "'
        AND `t`.`transaction_date` <= '" . $end_date . "'  and `t`.`empid`='$application_id'";
        $query = $this->db->query($SQL);
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getTotalforFisicalYearByContractId($application_id, $contract_id)
    {
        $SQL = "SELECT `empid`,  SUM(FLOOR(hours)) as t_hours,
        SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes FROM `tbl_contract_transaction` `t` INNER JOIN `tblcategory` `c`
        ON `t`.`category_id`=`c`.`id`  WHERE `t`.`contract_id` = '" . $contract_id . "'
        and `t`.`empid`='$application_id'";
        $query = $this->db->query($SQL);
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    //from 28/07/25
    function getAllSemsterList()
    {

        $builder = $this->db->table('courselist');

        $builder->select('Semester');
        $builder->groupBy('semester');

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function classSemesterReportByClass($class, $semester)
    {

        $builder = $this->db->table("name n");
        $builder->distinct();
        $builder->select("n.FirstName as firstname,n.LastName as lastname,c.Course as courseid,c.CourseID as course_row_id,(case when t.grade='AUDIT' then '0' else c.credits END) as credits,case when t.grade='w' then 'w' else '' end as withdrawn");
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        if ($class != 'All') {
            $builder->where('c.Class', $class);
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }

        if (!empty($course)) {
            $builder->where('c.CourseID', $course);
        }

        $string = "( t.grade<>'')";
        $builder->where($string);
        $builder->where('t.Deletestatus IS NULL');
        // $this->db->where(t.Deletestatus is NULL OR t.Deletestatus!=1)";
        $query = $builder->get();


        //echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }

        // get Semester list

    }

    function classSemesterReportByClasss($class, $semester)
    {

        $builder = $this->db->table("name n");
        $builder->select("n.FirstName as firstname,n.LastName as lastname,n.ID,t.StudentID,t.Deletestatus");
        $builder->join('transcript t', 'n.id=t.studentid', 'INNER');
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');
        if ($class != 'All') {
            $builder->where('c.Class', $class);
        }
        if ($semester != '') {
            $builder->where('c.Semester', $semester);
        }
        if (!empty($course)) {
            $builder->where('c.CourseID', $course);
        }
        //$this->db->where('t.Deletestatus IS NULL');

        $string = "( t.grade<>'' and (t.Deletestatus is NULL OR t.Deletestatus!=1))";

        $builder->where($string);
        $builder->groupBy('n.FirstName ,n.LastName,n.ID,t.StudentID,t.Deletestatus');

        $query = $builder->get();


        //echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }

        // get Semester list

    }

    function get_semester_report_class_course($student_id = '', $selectedclass = '', $selected_semester = '', $selected_course = '')
    {
        $builder = $this->db->table('transcript as t');
        $builder->select("c.CourseID,c.Course,c.CourseTitle,t.Grade,(case when t.grade='AUDIT' then '0' else c.credits END) as credits,c.Class,c.Semester");
        $builder->join('courselist as c', 'c.CourseID = t.CourseID');
        $builder->where('t.StudentID', $student_id);
        $string = "( t.grade<>'')";
        $builder->where($string);
        if ($selectedclass != '') {
            $builder->where('c.Class', $selectedclass);
        }
        if ($selected_semester != '') {
            $builder->where('c.Semester', $selected_semester);
        }
        if ($selected_course != '') {
            $builder->where('c.CourseID', $selected_course);
        }
        $deletestatus = "(t.Deletestatus is NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        $query = $builder->get();

        //echo $this->db->last_query(); 
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function classListReportBycertificates($class, $Certificates)
    {
        //echo $class; echo '<br/>'; echo $Certificates; die;
        //$class='2011';
        /*if($class==''){
        $class = 'All';
        }*/
        // add international Address  Fwd: Database issues: Certificates

        $builder = $this->db->table('CertTranscript as ct');
        $builder->select('na.ID,na.Firstname,d.dipName,c.cert_no,c.tution,c.CertName,c.certID,c.Class,c.semester,c.grad_undergrad, na.LastName,
           IFNULL((SELECT GROUP_CONCAT(DISTINCT(select c.CountryName from country c where c.CountryID=ad.Country limit 1) ) from address as ad where ad.AddressID = na.ID AND ad.Active="1" limit 1),
       (SELECT GROUP_CONCAT(DISTINCT(select c.CountryName from country c where c.CountryID=ad1.Country_int limit 1) ) from address_international as ad1 where ad1.AddressID_int = na.ID AND ad1.Active_int="1" limit 1)) as Countries');
        $builder->join('name as na', 'ct.studentID = na.ID', 'INNER');
        //$this->db->join('student_info as si', 'na.ID = si.StudentInfoID', 'LEFT');
        // $this->db->join('mst_program as mstp', 'si.ProgramID = mstp.ProgramID', 'LEFT');
        $builder->join('Certificates as c', 'ct.certID = c.certID AND (c.Deletestatus is NULL OR c.Deletestatus!=1)', 'LEFT');
        $builder->Join('Diploma as d', 'd.dipID = c.DipID', 'left');
        // start Fwd: Database issues: Certificates 07-nov-2023
        $deletestatus = "(ct.Deletestatus is NULL OR ct.Deletestatus!=1)";
        $builder->where($deletestatus);
        // end Fwd: Database issues: Certificates 07-nov-2023
        if ($class != '') {
            $builder->where('c.Class', $class);
        }

        if ($Certificates != '') {
            $builder->where('ct.certID', $Certificates);
        }

        // By prabhat
        if ($this->request->getPost('semester') != '') {
            $builder->where('c.semester', $this->request->getPost('semester'));
        }
        if ($this->request->getPost('diploma') != '') {
            $did = encryptor('decrypt', $this->request->getPost('diploma'));
            $builder->where('c.DipID', $did);
        }
        if ($this->request->getPost('level') != '') {
            $builder->where('c.grad_undergrad', $this->request->getPost('level'));
        }

        if (!empty($this->request->getPost('column'))) {
            $post = $this->request->getPost();
            foreach ($post['column'] as $key => $val) {
                if ($val != '') {
                    $builder->orderBy(encryptor('decrypt', $val), $post['order_type'][$key]);
                }
            }
        } else {
            $builder->orderBy('c.Class', 'desc');
        }
        $builder->distinct('na.Firstname');
        //$this->db->orderBy('na.Firstname');
        $query = $builder->get();
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function get_higher_class($year)
    {
        $builder = $this->db->table('class');
        $builder->select('*');
        $deletestatus = "(Deletestatus IS NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where('Class >=', $year);
        $builder->orderBy('Class', 'DESC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function get_enrolled_course_filter_wise($student_id = '', $selectedclass = '', $selectedclassto = '', $selected_semester = '', $selected_course = '')
    {
        $builder = $this->db->table('transcript as t');
        $builder->select('c.CourseID,c.Course,c.CourseTitle,t.Grade,t.CreditEarned,c.Class,c.Semester');
        $builder->join('courselist as c', 'c.CourseID = t.CourseID');
        $builder->where('t.StudentID', $student_id);
        if ($selectedclass != '') {
            $builder->where('c.Class>=', $selectedclass);
        }
        if ($selectedclassto != '') {
            $builder->where('c.Class<=', $selectedclassto);
        }
        if ($selected_semester != '') {
            $builder->where('c.Semester', $selected_semester);
        }
        if ($selected_course != '') {
            $builder->where('c.Course', $selected_course);
        }
        $deletestatus = "(t.Deletestatus is NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        $query = $builder->get();

        //echo $this->db->last_query(); 
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function get_user_address($student_id, $country = '')
    {

        $this->db->table('address as ad')->select('ad.Country,c.CountryName')->DISTINCT('ad.AddressID')
            ->join('country as c', 'c.CountryID=ad.Country', 'left')
            ->where('AddressID', $student_id)
            ->where('ad.Active', 1);
        if ($country != '') {
            $this->db->table('address as ad')->where('c.CountryID', $country);
        }
        return $this->db->table('address as ad')->get()
            ->getResultArray();
    }

    function report_getEmailByIDD($EmailID)
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

    function  student_demographic_report()
    {
        $post = $this->request->getPost();
        $age = '';
        if (isset($post['age']) != '') {
            $age = date('Y') - $post['age'];
        }

        $builder = $this->db->table('name as n');
        $builder->select("n.ID, si.Student_RowID,si.Graduation as Gradution,Withdrawn,si.StudentInfoID,STR_TO_DATE(si.Graduation,'%d-%m-%Y') as graduation_date,
                          si.master_program,si.enroll_certificate,FirstName,LastName,n.Sex,Ethnicity,citizenship,
                          n.Birthdate as Birthdate,p.Program_Name,c.CountryName,si.start_date,
                          GROUP_CONCAT(DISTINCT sp.Special_Program_Name) as Special_Program_Name,
                          GROUP_CONCAT(DISTINCT tr.track_name) as track_name");

        $builder->join('country as c', 'c.CountryID=n.citizenship_country', 'left');
        $builder->join('student_info as si', 'si.StudentInfoID = n.ID AND (si.Deletestatus is NULL OR si.Deletestatus!=1)', 'left');

        $builder->join('student_info_market as sm', 'sm.student_info_id = si.Student_RowID AND n.ID = sm.contact_id AND sm.status = "1"', 'left');
        $builder->join('mst_special_program as sp', 'sp.Special_ProgramID=sm.market_id', 'left');
        $builder->join('mst_program as p', 'p.ProgramID = si.ProgramID', 'left');
        $builder->join('transcript as t', 't.StudentID = n.ID AND (t.Deletestatus IS NULL OR t.Deletestatus !=1)', 'left');
        $builder->join('courselist as cr', 'cr.CourseID = t.CourseID', 'left');
        $builder->join('student_info_track as st', 'st.student_info_id = si.Student_RowID', 'left');
        $builder->join('track as tr', 'tr.id = st.track_id AND st.status = "1"', 'left');
        $builder->DISTINCT('si.Student_RowID');
        if (isset($post['age']) != '') {
            $builder->where('year(Birthdate)', $age);
        }
        if (isset($post['Ethnicity']) != '') {
            if ($post['Ethnicity'] == 'Unknown') {
                $que1 =  "(Ethnicity = '" . $post['Ethnicity'] . "' OR Ethnicity = '')";
                $builder->where($que1);
            } else {
                $builder->where('Ethnicity', $post['Ethnicity']);
            }
        }
        if (isset($post['citizenship']) != '') {
            if ($post['citizenship']  == 'other') {
                $builder->where('citizenship', '');
            } else {
                $builder->where('citizenship', $post['citizenship']);
            }
        }
        if (isset($post['Country']) != '') {
            if ($post['Country']  == 'other') {
                if ($post['other_country'] != '') {
                    $builder->where('n.citizenship_country', $post['other_country']);
                } else {
                    $builder->where('n.citizenship_country IS NULL');
                }
            } else {
                $builder->where('n.citizenship_country', $post['Country']);
            }
        }
        if (isset($post['Sex']) != '') {
            if ($post['Sex'] == 'Other') {
                $builder->where('n.Sex <>', 'M');
                $builder->where('n.Sex <>', 'F');
            } else {
                $builder->where('n.Sex', $post['Sex']);
            }
        }
        if (isset($post['Certificates']) != '') {
            $builder->where('si.ProgramID', $post['Certificates']);
        }
        if (isset($_POST['special_start']) != '') {
            $builder->where('si.special_start', $_POST['special_start']);
        }
        if (isset($_POST['special_end']) != '') {
            $builder->where('si.special_end', $_POST['special_end']);
        }
        if (isset($_POST['program_start']) != '') {
            $builder->where('si.program_start', $_POST['program_start']);
        }
        if (isset($_POST['program_end']) != '') {
            $builder->where('si.program_end', $_POST['program_end']);
        }
        if (isset($_POST['enroll_certificate']) != '') {
            if ($_POST['enroll_certificate'] == 'Yes') {
                $builder->where('si.enroll_certificate', $_POST['enroll_certificate']);
            } else {
                $que3 =  "(si.enroll_certificate = '' OR si.enroll_certificate IS NULL OR si.enroll_certificate = 'No')";
                $builder->where($que3);
            }
        }
        if (isset($_POST['master_program']) != '') {
            if ($_POST['master_program'] == 'Yes') {
                $builder->where('si.master_program', $_POST['master_program']);
            } else {
                $que4 =  "(si.master_program = '' OR si.master_program IS NULL OR si.master_program = 'No')";
                $builder->where($que4);
            }
        }
        if (isset($_POST['graduation_from']) != '') {
            $date_from = $_POST['graduation_from'] . "-01-01";
            $builder->where("STR_TO_DATE(si.Graduation,'%d-%m-%Y') >=", date('Y-m-d', strtotime($date_from)));
        }
        if (isset($_POST['graduation_to']) != '') {
            $date_to = $_POST['graduation_to'] . "-12-31";
            $builder->where("STR_TO_DATE(si.Graduation,'%d-%m-%Y') <=", date('Y-m-d', strtotime($date_to)));
        }
        if (isset($_POST['graduate_state']) != '') {
            if ($_POST['graduate_state'] == 'Yes') {
                $builder->where('si.Graduation IS NOT NULL');
                $builder->where('si.Graduation !=', '');
            } else if ($_POST['graduate_state'] == 'No') {
                $builder->where('t.Grade !=', 'SCH');
                $que =  "(si.Graduation IS NULL OR si.Graduation = '')";
                $builder->where($que);
            }
        }
        if (isset($_POST['withdrawn']) != '') {
            if ($_POST['withdrawn'] == 'Yes') {
                $builder->where('si.withdrawn is NOT NULL');
                $builder->where('si.withdrawn <>', '');
            }
            if ($_POST['withdrawn'] == 'No') {
                $que5 =  "(si.withdrawn IS NULL OR si.withdrawn = '')";
                $builder->where($que5);
            }
        }
        if (isset($_POST['not_graduation_from']) != '') {
            $start = $_POST['not_graduation_from'] . '-01-01';
            $builder->where('cr.start_date >=', date('Y-m-d', strtotime($start)));
        }
        if (isset($_POST['not_graduation_to']) != '') {
            $end = $_POST['not_graduation_to'] . '-12-31';
            $builder->where('cr.start_date <=', date('Y-m-d', strtotime($end)));
        }
        if (isset($_POST['graduation_any_from']) != '') {
            $builder->where('cr.start_date >=', date('Y-m-d', strtotime($_POST['graduation_any_from'])));
        }
        if (isset($_POST['graduation_any_to']) != '') {
            $builder->where('cr.end_date <=', date('Y-m-d', strtotime($_POST['graduation_any_to'])));
        }

        if (isset($_POST['start_date_from']) != '') {
            $builder->where('si.start_date >=', date('Y-m-d', strtotime($_POST['start_date_from'])));
        }
        if (isset($_POST['start_date_to']) != '') {
            $builder->where('si.start_date <=', date('Y-m-d', strtotime($_POST['start_date_to'])));
        }
        if (isset($_POST['special_program']) != '') {
            $builder->whereIn('sm.market_id', $_POST['special_program']);
        }
        if (isset($_POST['program']) != '') {
            $builder->where('si.ProgramID', $_POST['program']);
        }

        if ($this->request->getPost('column') != '') {
            $post = $this->request->getPost();
            foreach ($post['column'] as $key => $val) {
                if ($val != '') {
                    $builder->orderBy(encryptor('decrypt', $val), $post['order_type'][$key]);
                }
            }
        }
        if (isset($_POST['track']) != '') {
            $builder->whereIn('st.track_id', $_POST['track']);
        }
        if (isset($_POST['special_program_excel']) != '') {
            $builder->whereIn('sm.market_id', explode(",", $_POST['special_program_excel']));
        }
        if (isset($_POST['track_excel']) != '') {
            $builder->whereIn('st.track_id', explode(",", $_POST['track_excel']));
        }

        $builder->groupBy(array('si.Student_RowID', 'c.CountryName', 'n.ID'));
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function get_us_state_by_state_id($student_id, $country_id)
    {
        return $this->db->table('state as s')->select('s.StateID,StateName')
            ->join('address as ad', 'ad.State = s.StateID AND ad.Active = 1 AND ad.AddressID = ' . $student_id)
            ->where('ad.Country', $country_id)
            ->get()
            ->getResultArray();
    }

    function getFall2SemesterCourseByStudent_ID($ID, $start_data = '', $semester = '')
    {
        $builder = $this->db->table("transcript t");
        $builder->distinct();
        $builder->select("c.class,c.semester,c.Course as courseid,t.StudentID, (case when t.grade='AUDIT' then '0' else c.credits END) as credits ,c.CourseID as course_row_id,case when t.grade='w' then 'w'  when t.grade='i' then 'i' else '' end as withdrawn");
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');

        if ($semester != '') {
            $builder->where('Semester', $semester);
        }
        if ($start_data != '') {
            $builder->where('c.Class', $start_data);
        }

        $string = "( t.grade<>'')";
        $builder->where($string);
        $builder->where('t.StudentID', $ID);
        $builder->where('t.Deletestatus IS NULL');

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }

        // get Semester list

    }

    function getFallSemesterCourseByStudent_ID($ID, $start_data = '', $start_program_date = "", $end_data = "", $end_program_date = "", $semester = "")
    {
        $builder = $this->db->table("transcript t");
        $builder->distinct();
        //THEN "Male" ELSE "Female" END)
        $builder->select("c.class,c.semester,c.Course as courseid,t.StudentID, (case when t.grade='AUDIT' then '0' else c.credits END) as credits ,c.CourseID as course_row_id,case when t.grade='w' then 'w'  when t.grade='i' then 'i' else '' end as withdrawn");
        $builder->join('courselist c', 'c.CourseID=t.CourseID', 'INNER');

        if ($semester != '') {
            $builder->where('Semester', $semester);
        }
        if ($start_data != '') {
            // $begin_date = date('Y-m-d',strtotime($start_data ));
            $begin = $start_program_date . $start_data;
            $begin_date = date('Y-m-d', strtotime($begin));

            $builder->where('start_date >=', $begin_date);
        }
        if ($end_data != '') {
            // $end_date = date('Y-m-d',strtotime($end_data ));
            $end_date1 = $end_program_date . $end_data;
            $end_date1 = date('Y-m-d', strtotime($end_date1));
            $builder->where('start_date <=', $end_date1);
        }


        $string = "( t.grade<>'')";
        $builder->where($string);
        $builder->where('t.StudentID', $ID);
        $builder->where('t.Deletestatus IS NULL');

        $query = $builder->get();


        //echo $builder->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }

        // get Semester list

    }

    function get_user_course_with_filter($student_id, $selected_program_start = '', $start_program_date, $selected_program_end = '', $end_program_date, $selected_semester = '')
    {
        $builder = $this->db->table('transcript as t');
        $builder->distinct();
        $builder->select("c.CourseID,c.Semester,c.Class,c.Course,c.CourseTitle,c.start_date,c.end_date,t.StudentID,(case when t.grade='AUDIT' then '0' else c.credits END) as credits");
        //$builder->join('name as n','n.ID = t.StudentID');
        $builder->join('courselist as c', 'c.CourseID = t.CourseID AND t.StudentID = ' . $student_id);

        $deletestatus = "(t.Deletestatus is NULL OR t.Deletestatus!=1)";
        $builder->where($deletestatus);
        if ($selected_program_start != '') {
            $builder->where('cast(c.start_date as char)!=', '');
            $begin = $start_program_date . $selected_program_start;
            $begin_date = date('Y-m-d', strtotime($begin));
            $builder->where('start_date >=', $begin_date);
            //$builder->where('c.start_date >=',date('Y-m-d',strtotime($selected_program_start)));
        }
        if ($selected_program_end != '') {
            $builder->where('cast(c.start_date as char)!=', '');
            $end = $end_program_date . $selected_program_end;
            $end_date = date('Y-m-d', strtotime($end));
            $builder->where('start_date <=', $end_date);
            //$builder->where('c.start_date <=',date('Y-m-d',strtotime($selected_program_end)));
        }
        if ($selected_semester != '') {
            $builder->where('c.Semester', $this->request->getPost('semester'));
        }
        return $builder->get()->getResultArray();
    }

    function get_size_of_semester($class, $semester, $unique_types)
    {

        $builder = $this->db->table('courselist as c');
        $builder->distinct();
        $builder->select('c.CourseID')
            ->join('transcript as t', 't.CourseID = c.CourseID')
            ->where('c.Class', $class)
            ->where('c.Semester', $semester)
            ->whereIn('t.CourseID', $unique_types);

        $string = "( t.grade<>'')";
        $builder->where($string);
        $builder->where('t.Deletestatus IS NULL');
        return $builder->get()->getResultArray();
    }

    function course_report()
    {
        $builder = $this->db->table('courselist as c');
        $builder->select('COUNT(t.StudentID) as student_count,c.Class,c.Semester,c.start_date,c.end_date,c.Course,c.CourseTitle,c.CourseID,c.Professor');
        $builder->join('transcript` as t', 't.CourseID = c.CourseID ', 'left');
        if ($this->request->getPost('class') != '') {
            $builder->where('c.Class', $this->request->getPost('class'));
        }
        if ($this->request->getPost('semester') != '') {
            $builder->where('c.Semester', $this->request->getPost('semester'));
        }
        if ($this->request->getPost('start_date') != '') {
            $builder->where('c.start_date >=', date('Y-m-d', strtotime($this->request->getPost('start_date'))));
        }
        if ($this->request->getPost('end_date') != '') {
            $builder->where('c.end_date <=', date('Y-m-d', strtotime($this->request->getPost('end_date'))));
        }
        $builder->where('t.Deletestatus IS NULL');
        if ($this->request->getPost('column') != '') {
            $post = $this->request->getPost();
            foreach ($post['column'] as $key => $val) {
                if ($val != '') {
                    $builder->orderBy(encryptor('decrypt', $val), $post['order_type'][$key]);
                }
            }
        }
        $builder->groupBy(array("c.Class", "c.start_date", "c.end_date", "c.Course", "c.CourseTitle", "c.CourseID", "c.Semester"));
        //$builder->order_by("c.Class DESC,c.CourseID DESC");
        $query = $builder->get();

        if ($query->getNumRows() >= 0) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getApplicantDonorMailReport_Neww()
    {


        $sql = 'SELECT `n`.`ID`, `useremail`, `n`.`FirstName`, `n`.`LastName`,n.Spouse, n.	Position,`n`.`Greeting`, `n`.`spouse`, `n`.`Company`, `n`.`Addressee`, 
                        `Deceased`, `g`.`DanielVIP`, `g`.`Unsubscribed`, `g`.`DanielPermissionNeeded`, `ad`.`Street_Address`, 
                        `ad`.`City`, `ad`.`State`, `ad`.`Postal_Code`, `ad`.`addressType`, `ad`.`Address2`, `c`.`CountryName`, `s`.`StateName`,
                        concat(
                            CASE WHEN donorCount > 0 THEN "Donor, " ELSE "" END,
                            CASE WHEN totalContract > 0  THEN "CurrentEmployee, "  ELSE "" END,
                            CASE WHEN totalPastContract > 0  THEN "FormalEmployee, "  ELSE "" END,
                            CASE WHEN foundationCount > 0 THEN "Grantmaker Affiliate, " ELSE "" END,
                            CASE WHEN mediaCount > 0 THEN "Media, " ELSE "" END,
                            CASE WHEN appalachianCount > 0 THEN "Appalachian Program, " ELSE "" END,
                            CASE WHEN BoardMemberCount > 0 THEN "Past And Present Board Members, " ELSE "" END,
                            CASE WHEN FacultyStaffCount > 0 THEN "Past And Present Faculty & Staff, " ELSE "" END,
                            CASE WHEN studentFamilyCount > 0 THEN "Past And Present Student Family, " ELSE "" END,
                            CASE WHEN DanielVIPCount > 0 THEN "Vip, " ELSE "" END,
                            CASE WHEN FriendofDanielCount > 0 THEN "Friend of Daniel/ Not VIP, " ELSE "" END,
                            CASE WHEN VistaCount > 0 THEN "Vista, " ELSE "" END,
                            CASE WHEN AcctHoldCount > 0 THEN "Acct Hold,"  ELSE "" END,
                            CASE WHEN prospective_donorCount > 0 THEN "Potential Donor, " ELSE "" END,
                            CASE WHEN ProspectiveStudentCount > 0 THEN "Potential Student, " ELSE "" END,
                            CASE WHEN PartnerOrganizationCount > 0 THEN "Partner Organization, " ELSE "" END,
                            CASE WHEN do_not_contactCount > 0 THEN "Do Not Contact, " ELSE "" END ,
                            CASE WHEN alumStudent > 0 THEN "Alum," ELSE "" END ,
							
							CASE WHEN tribal_college = "1" THEN "Tribal College," ELSE "" END,
							CASE WHEN hbcu = "1" THEN "HBCU," ELSE "" END,
							CASE WHEN wv_college = "1" THEN "WV College," ELSE "" END,
							CASE WHEN appalachia_college = "1" THEN "Appalachia College," ELSE "" END,
							CASE WHEN us_college = "1" THEN "US College," ELSE "" END,
							CASE WHEN americorps = "1" THEN "AmeriCorps," ELSE "" END,
							CASE WHEN peacecorps = "1" THEN "Peace Corps," ELSE "" END,

							
                            CASE WHEN t21.transcriptCount > 0 THEN 
                              CASE WHEN (SELECT COUNT(*) as sCount from student_info WHERE (StudentInfoID = n.ID AND Graduation IS NOT NULL AND Graduation != "") AND (Deletestatus IS NULL OR Deletestatus!="1") ) > 0 
                            		THEN "" 
                            		ELSE "Student," 
                             END
                            ELSE "" END
                        ) as tags,
                        
                        
                        (select STR_TO_DATE(ReceivedDate, "%d-%m-%Y") from donations where DonorID=n.ID AND Campaign NOT IN ("18", "22", "23", "24", "26") order by STR_TO_DATE(ReceivedDate, "%d-%m-%Y") desc limit 1) as ReceivedDate, 
                        (select Amount from donations where DonorID=n.ID AND Campaign NOT IN ("18", "22", "23", "24", "26") order by STR_TO_DATE(ReceivedDate, "%d-%m-%Y") desc limit 1) as LastAmount,
                        (select sum(Amount) from donations where DonorID=n.ID AND Campaign NOT IN ("18", "22", "23", "24", "26")) as total_amount FROM `name` `n` 
                        LEFT JOIN `groups` `g` ON `n`.`ID`=`g`.`NameLink` JOIN `donations` as `d` ON `d`.`DonorID` = `n`.`ID` 
                        LEFT JOIN `address` as `ad` ON `ad`.`AddressID` = `n`.`ID` AND `ad`.`Active` = "1" 
                        LEFT JOIN `state` as `s` ON `s`.`StateID` = `ad`.`State` 
                        LEFT JOIN `country` as `c` ON `c`.`CountryID` = `ad`.`Country` 
                        LEFT JOIN (SELECT EmailID,GROUP_CONCAT(" ",Email) useremail from email where Active = "1" group by EmailID) as t1 ON `n`.`ID` = `t1`.`EmailID` 
                        LEFT JOIN (SELECT DonorID,COUNT(*) as donorCount from donations WHERE Campaign NOT IN ("18","22","23") AND (Deletestatus IS NULL OR Deletestatus!="1") group by DonorID ) as t4 ON n.ID = t4.DonorID
                        LEFT JOIN (select empid,COUNT(*) as totalContract FROM tblcontract as tc WHERE (tc.Deletestatus IS NULL OR tc.Deletestatus!="1") AND empid IN (SELECT tc1.empid FROM tblcontract as tc1 WHERE tc1.contract_end_date >= CURDATE()) group by empid) as t5 ON t5.empid = n.ID
                        LEFT JOIN (select empid,COUNT(*) as totalPastContract FROM tblcontract as xtc WHERE (xtc.Deletestatus IS NULL OR xtc.Deletestatus!="1") AND empid NOT IN (SELECT xtc1.empid FROM tblcontract as xtc1 WHERE xtc1.contract_end_date >= CURDATE()) group by empid) as t6 ON t6.empid = n.ID
                        LEFT JOIN (select StudentInfoID,COUNT(*) as alumStudent FROM student_info as si WHERE (si.Deletestatus IS NULL OR si.Deletestatus!="1") AND Graduation IS NOT NULL AND Graduation != ""  GROUP BY StudentInfoID) as t7 ON t7.StudentInfoID = n.ID
                        
                        LEFT JOIN (select NameLink,COUNT(*) as foundationCount FROM `groups` WHERE Foundation = "1" GROUP BY NameLink) as t8 ON t8.NameLink = n.ID
                        LEFT JOIN (select NameLink,COUNT(*) as mediaCount FROM `groups` WHERE Media = "1" GROUP BY NameLink) as t9 ON t9.NameLink = n.ID
                        LEFT JOIN (select NameLink,COUNT(*) as appalachianCount FROM `groups` WHERE Appalachian = "1" GROUP BY NameLink) as t10 ON t10.NameLink = n.ID
                        LEFT JOIN (select NameLink,COUNT(*) as BoardMemberCount FROM `groups` WHERE BoardMember = "1" GROUP BY NameLink) as t11 ON t11.NameLink = n.ID
                        LEFT JOIN (select NameLink,COUNT(*) as FacultyStaffCount FROM `groups` WHERE FacultyStaff = "1" GROUP BY NameLink) as t12 ON t12.NameLink = n.ID
                        LEFT JOIN (select NameLink,COUNT(*) as studentFamilyCount FROM `groups` WHERE StudentFamily = "1" GROUP BY NameLink) as t13 ON t13.NameLink = n.ID
                        LEFT JOIN (select NameLink,COUNT(*) as DanielVIPCount FROM `groups` WHERE DanielVIP = "1" GROUP BY NameLink) as t14 ON t14.NameLink = n.ID
                        LEFT JOIN (select NameLink,COUNT(*) as FriendofDanielCount FROM `groups` WHERE FriendofDaniel = "1" GROUP BY NameLink) as t15 ON t15.NameLink = n.ID
                        LEFT JOIN (select NameLink,COUNT(*) as VistaCount FROM `groups` WHERE Vista = "1" GROUP BY NameLink) as t16 ON t16.NameLink = n.ID
                        
                        LEFT JOIN (select NameLink,COUNT(*) as AcctHoldCount FROM `groups` WHERE accthold = "1" GROUP BY NameLink) as tn1 ON tn1.NameLink = n.ID
                        
                        LEFT JOIN (select NameLink,COUNT(*) as ProspectiveStudentCount FROM `groups` WHERE ProspectiveStudent = "1" GROUP BY NameLink) as t17 ON t17.NameLink = n.ID
                        LEFT JOIN (select NameLink,COUNT(*) as prospective_donorCount FROM `groups` WHERE prospective_donor = "1" GROUP BY NameLink) as t18 ON t18.NameLink = n.ID
                        LEFT JOIN (select NameLink,COUNT(*) as PartnerOrganizationCount FROM `groups` WHERE PartnerOrganization = "1" GROUP BY NameLink) as t19 ON t19.NameLink = n.ID
                        LEFT JOIN (select name_id,COUNT(*) as do_not_contactCount FROM tbl_contact_tag WHERE do_not_contact = "1" GROUP BY name_id) as t20 ON t20.name_id = n.ID
                        
                        LEFT JOIN  (SELECT StudentID,COUNT(*) as transcriptCount FROM transcript as t 
                                   JOIN courselist as cl ON cl.CourseID = t.CourseID WHERE  (t.Deletestatus IS NULL OR t.Deletestatus!="1") AND t.Grade != "SCH" GROUP BY StudentID ) as t21 ON t21.StudentID = n.ID
                        
                        WHERE (`d`.`Deletestatus` is NULL OR `d`.`Deletestatus` != 1) AND `n`.`Deceased` =0 AND  (t20.do_not_contactCount IS NULL OR t20.do_not_contactCount = 0)
                        GROUP BY  
                        `n`.`ID`, `n`.`FirstName`, `n`.`LastName`, `n`.`Greeting`, `n`.`spouse`, `n`.`Company`, `n`.`Addressee`, `Deceased`, `g`.`DanielVIP`,
                                 `g`.`Unsubscribed`, `g`.`DanielPermissionNeeded`,
								 tribal_college,hbcu,wv_college,appalachia_college,us_college,americorps,peacecorps,accthold,
								 `ad`.`Street_Address`, `ad`.`City`, `ad`.`State`, `ad`.`Postal_Code`, `ad`.`addressType`, 
                                 `ad`.`Address2`, `c`.`CountryName`, `s`.`StateName`,t21.transcriptCount 
                                 HAVING `total_amount` IS NOT NULL';

        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    function getmonthlydonationsreport_without_tuition_credit_refund($month = '', $year = '', $campaign_id = '')
    {
        if ($campaign_id != '' && !empty($campaign_id)) {
            $qry = "select * from name A inner join donations B ON A.ID=B.DonorID left join campaigns C ON B.Campaign=C.CampaignID where month(STR_TO_DATE(B.ReceivedDate,'%d-%m-%Y'))=$month AND year(STR_TO_DATE(B.ReceivedDate,'%d-%m-%Y'))=$year AND C.CampaignID = $campaign_id AND Campaign NOT IN ('18','22','23') ORDER BY B.ReceivedDate ASC,A.LastName ASC,A.FirstName ASC";
        } else {
            $qry = "select * from name A inner join donations B ON A.ID=B.DonorID left join campaigns C ON B.Campaign=C.CampaignID where month(STR_TO_DATE(B.ReceivedDate,'%d-%m-%Y'))=$month AND year(STR_TO_DATE(B.ReceivedDate,'%d-%m-%Y')) = $year AND Campaign NOT IN ('18','22','23') ORDER BY B.ReceivedDate ASC,A.LastName ASC,A.FirstName ASC";
        }
        // echo $qry; die;
        $query = $this->db->query($qry);
        // echo $query->num_rows(); die;
        // echo $this->db->last_query(); die;
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getEmpDailyAttendance($application_id, $selected_month, $selected_year)
    {

        $builder = $this->db->table('tbl_contract_transaction t');
        $builder->select('transaction_date,category_id,empid,SUM(FLOOR(hours)) as t_hours,SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) as t_minutes');
        $builder->join('tblcategory c', 't.category_id=c.id', 'INNER');
        $builder->where('t.empid', $application_id);
        $builder->where('month(transaction_date)', $selected_month);
        $builder->where('year(transaction_date)', $selected_year);
        /*$builder->group_by('transaction_date','category_id');*/
        $builder->groupBy(array("transaction_date", "category_id"));

        $query = $builder->get();
        /* echo $this->db->last_query(); die;*/
        /* print_r($this->db->last_query());
		 exit;*/
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getPassportYearwiseReport($class_year)
    {
        $Deffered = "(B.Deffered IS NULL OR B.Deffered='')";
        $Withdrawn = "(B.Withdrawn IS NULL OR B.Withdrawn='')";
        $builder = $this->db->table('name A');
        $builder->select('A.*,B.*,(select Country from address where AddressID=A.ID ORDER BY Address_RowID Desc limit 1) as address_country');
        $builder->join('student_info B', 'A.ID = B.StudentInfoID', 'INNER');
        $builder->join('passport_log L', 'A.ID = L.StudentID', 'LEFT');
        if ($class_year != 'All') {
            $builder->where('B.Class', $class_year);
        }
        $builder->where('A.PassportNumber is NOT NULL');
        $builder->where('B.Graduation IS NOT NULL');
        $builder->where($Deffered);
        $builder->where($Withdrawn);
        $builder->orderBy('address_country', 'DESC');
        $builder->orderBy('LastName', 'ASC');
        $builder->orderBy('FirstName', 'ASC');
        $query = $builder->get();
        // echo $this->db->getLastQuery(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getAllActiveClasses($class = '')
    {

        $builder = $this->db->table('student_info');
        $builder->select('Class');
        if ($class != '' && $class != null && $class != 'All Clases') {
            $builder->where('class', $class);
        }
        $builder->groupBy('Class');
        $builder->orderBy('Class', 'desc');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function Update_Lock_timesheet($date, $empid)
    {
        $builder = $this->db->table('tbl_contract_transaction');
        $builder->where('date(transaction_date)', $date);
        $builder->where('empid', $empid);
        $res = $builder->update(array('islock' => "0"));
        //echo "<pre>"; print_r($this->db->last_query()); exit;

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    function get_user_option_name($user_id)
    {
        $builder = $this->db->table('name');
        $builder->select('FirstName, LastName');
        $builder->where('ID', $user_id);
        $query = $builder->get()->getRowArray();
        return $query;
    }

    function getTotalforFisicalReport($application_id, $selected_year)
    {

        $finanyr = explode("-", $selected_year);
        $first_date = $finanyr[0] . "-07-01";
        $last_date = $finanyr[1] . "-06-30";

        $SQL = "SELECT  SUM(FLOOR(hours)) as t_hours, SUM(SUBSTRING(hours - FLOOR(hours), 3, 5))
				 as t_minutes FROM `tbl_contract_transaction` `t` INNER JOIN `tblcategory` `c` ON `t`.`category_id`=`c`.`id` WHERE
				  `t`.`empid` = '$application_id' AND `t`.`transaction_date` >= '$first_date' AND `t`.`transaction_date` <= '$last_date'
				";
        $query = $this->db->query($SQL);
        /* echo $this->db->last_query(); die;*/
        /*echo "<pre>";
		 print_r($query->result_array());
		 exit;*/
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function StudentRecordListGraduateByClass($class)
    {

        $builder = $this->db->table('name as na');
        $builder->select('na.Firstname,na.LastName,si.Class,si.Region,mstp.Program_Name,(CASE
        WHEN si.Sex="M" THEN "Male" ELSE "Female" END) as Sex,si.Graduation, si.Withdrawn, si.Deffered, rp.RegionProgram, (SELECT GROUP_CONCAT(DISTINCT(select c.CountryName from country c where c.CountryID=ad.Country limit 1)) from address as ad where ad.AddressID = na.ID limit 1) as Countries');
        $builder->join('student_info as si', 'si.StudentInfoID = na.ID', 'LEFT');
        $builder->join('regionprogram as rp', 'rp.RPID = si.Region', 'LEFT');
        $builder->join('mst_program as mstp', 'si.ProgramID = mstp.ProgramID', 'LEFT');
        $builder->where('si.Graduation IS NOT NULL');
        $builder->where('si.Graduation !=', '');

        if ($class != 'All') {
            $builder->where('si.class', $class);
        }
        $deletestatus = "(si.Deletestatus is NULL OR si.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('si.Class', 'desc');
        $builder->orderBy('na.Firstname');
        $query = $builder->get();

        // echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function StudentRecordListContinueByClass($class)
    {

        $builder = $this->db->table('name as na');
        $builder->select('na.Firstname,na.LastName,si.Class,si.Region,mstp.Program_Name,(CASE
        WHEN si.Sex="M" THEN "Male" ELSE "Female" END) as Sex,si.Graduation, si.Withdrawn, si.Deffered, rp.RegionProgram, (SELECT GROUP_CONCAT(DISTINCT(select c.CountryName from country c where c.CountryID=ad.Country)) from address as ad where ad.AddressID = na.ID) as Countries ');
        $builder->join('student_info as si', 'si.StudentInfoID = na.ID', 'LEFT');
        $builder->join('regionprogram as rp', 'rp.RPID = si.Region', 'LEFT');
        $builder->join('mst_program as mstp', 'mstp.ProgramID = si.ProgramID', 'LEFT');

        $string = '(si.Graduation IS NULL OR si.Graduation="") AND (si.Withdrawn IS NULL OR si.Withdrawn="") AND (si.Deffered IS NULL OR si.Deffered="")';

        if ($class != 'All') {
            $builder->where('si.class', $class);
        }
        $deletestatus = "(si.Deletestatus is NULL OR si.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->where($string);

        $builder->orderBy('si.Class', 'desc');
        $builder->orderBy('na.Firstname');
        $query = $builder->get();

        //	echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function StudentRecordListDefferedByClass($class)
    {

        $builder = $this->db->table('name as na');
        $builder->select('na.Firstname,na.LastName,si.Class,si.Region,mstp.Program_Name,(CASE
        WHEN si.Sex="M" THEN "Male" ELSE "Female" END) as Sex,si.Graduation, si.Withdrawn, si.Deffered, rp.RegionProgram, (SELECT GROUP_CONCAT(DISTINCT(select c.CountryName from country c where c.CountryID=ad.Country)) from address as ad where ad.AddressID = na.ID) as Countries');
        $builder->join('student_info as si', 'si.StudentInfoID = na.ID', 'LEFT');
        $builder->join('regionprogram as rp', 'rp.RPID = si.Region', 'LEFT');
        $builder->join('mst_program as mstp', 'si.ProgramID = mstp.ProgramID', 'LEFT');
        $builder->where('si.Deffered IS NOT NULL');
        $builder->where('si.Deffered !=', '');
        if ($class != 'All') {
            $builder->where('si.class', $class);
        }
        $deletestatus = "(si.Deletestatus is NULL OR si.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('si.Class', 'desc');
        $builder->orderBy('na.Firstname');
        $query = $builder->get();

        // echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function StudentCount($class)
    {

        $builder = $this->db->table('student_info');
        $builder->select("count(Student_RowID) as total_student");
        if ($class != 'All') {
            $builder->where('Class', $class);
        }
        $deletestatus = "(Deletestatus is NULL OR Deletestatus!=1)";
        $builder->where($deletestatus);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function classListingCountryWiseRecords($class)
    {

        $builder = $this->db->table('student_info A');
        $builder->select("A.StudentInfoID,A.Region,SUM(CASE WHEN A.Sex='M' THEN 1 ELSE 0 END) as Total_Male,
        SUM(CASE WHEN A.Sex='F' THEN 1 ELSE 0 END) as Total_Female,SUM(CASE WHEN A.Withdrawn IS NOT NULL AND A.withdrawn!='' THEN 1 ELSE 0 END) as Total_Withdrawn,
        SUM(CASE WHEN (A.Graduation IS NOT NULL AND A.Graduation!='') THEN 1 ELSE 0 END) as
        Total_Graduated,SUM(CASE WHEN (A.Deffered IS NOT NULL and A.Deffered) THEN 1 ELSE 0 END) as Total_Deffered,
        SUM(CASE WHEN ((A.Graduation IS NULL OR A.Graduation='') AND (A.Deffered IS NULL OR A.Deffered='') AND (A.Withdrawn IS NULL OR A.Withdrawn='')) THEN 1 ELSE 0 END) as Total_Continue,
        (SELECT GROUP_CONCAT(DISTINCT(select c.CountryName from country c
        where c.CountryID=ad.Country limit 1)) from address as ad where ad.AddressID = A.StudentInfoID limit 1) as Countries");
        if ($class != 'All') {
            $builder->where('A.Class', $class);
        }
        $deletestatus = "(A.Deletestatus is NULL OR A.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->groupBy('A.StudentInfoID');
        $builder->groupBy('A.Region');

        //echo $builder->last_query(); die;
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {

            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function classListingRegionWiseRecords($class)
    {

        $builder = $this->db->table('student_info A');
        $builder->select("A.Class,A.Region,B.RPID,B.RegionProgram, SUM(CASE WHEN (A.Graduation IS NOT NULL AND A.Graduation!='')
        THEN 1 ELSE 0 END) as Total_Graduated,SUM(CASE WHEN (A.Deffered IS NOT NULL AND A.Deffered!='') THEN 1 ELSE 0 END) as Total_Deffered,SUM(CASE WHEN (A.Withdrawn IS NOT NULL AND A.Withdrawn!='') THEN 1 ELSE 0 END) as Total_Withdrawn,
        SUM(CASE WHEN ((A.Graduation IS NULL OR A.Graduation='') AND (A.Deffered IS NULL OR A.Deffered='') AND (A.Withdrawn IS NULL OR A.Withdrawn='')) THEN 1 ELSE 0 END) as Total_Continue,SUM(CASE WHEN A.Sex='M' THEN 1 ELSE 0 END) as Total_Male,
        SUM(CASE WHEN A.Sex='F' THEN 1 ELSE 0 END) as Total_Female");
        $builder->join('regionprogram B', 'A.Region=B.RPID', 'LEFT');
        if ($class != 'All') {
            $builder->where('A.Class', $class);
        }
        $deletestatus = "(A.Deletestatus is NULL OR A.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->groupBy('A.Region');
        $builder->groupBy('A.Class');
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function StudentRecordListWithdrawnByClass($class)
    {

        $builder = $this->db->table('name as na');
        $builder->select('na.Firstname,na.LastName,si.Class,si.Region,mstp.Program_Name,(CASE
    WHEN si.Sex="M" THEN "Male" ELSE "Female" END) as Sex,si.Graduation, si.Withdrawn, si.Deffered, rp.RegionProgram, (SELECT GROUP_CONCAT(DISTINCT(select c.CountryName from country c where c.CountryID=ad.Country)) from address as ad where ad.AddressID = na.ID) as Countries');
        $builder->join('student_info as si', 'si.StudentInfoID = na.ID', 'LEFT');
        $builder->join('regionprogram as rp', 'rp.RPID = si.Region', 'LEFT');
        $builder->join('mst_program as mstp', 'si.ProgramID = mstp.ProgramID', 'LEFT');
        $builder->where('si.Withdrawn IS NOT NULL');
        $builder->where('si.Withdrawn !=', '');
        if ($class != 'All') {
            $builder->where('si.class', $class);
        }
        $deletestatus = "(si.Deletestatus is NULL OR si.Deletestatus!=1)";
        $builder->where($deletestatus);
        $builder->orderBy('si.Class', 'desc');
        $builder->orderBy('na.Firstname');
        $query = $builder->get();

        // echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }
}
