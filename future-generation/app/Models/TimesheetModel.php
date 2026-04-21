<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;
use Google\Service\Docs\Tab;

class TimesheetModel extends Model
{
    protected $db;
    protected $request;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
        $this->request = \Config\Services::request();
    }

    function get_time_report_hr_min_user_category_wise($user_id = '', $category_id = '', $selected_start_date = "", $selected_end_date = "")
    {
        $builder = $this->db->table('tbl_contract_transaction tb');
        $builder->select('n.ID,sum(floor(hours)) as hours1,
                          sum(hours-floor(hours)) as minute1,sum(hours) as hours,
                          catagory_name,t.id as cat_id,(C.daily_rate/8) as daily_rate')
            ->join('tblcategory as t', 't.id = tb.category_id')
            ->join('name as n', 'n.ID = tb.empid');
        $builder->join('tblcontract C', 'C.id=tb.contract_id', 'INNER');
        $builder->where('C.deletestatus', 0);
        $builder->where('hours <>', '0.00');
        if ($selected_start_date != '') {
            $builder->where('transaction_date >=', date('Y-m-d', strtotime($selected_start_date)));
        }
        if ($selected_end_date != '') {
            $builder->where('transaction_date <=', date('Y-m-d', strtotime($selected_end_date)));
        }
        if ($user_id != '') {
            $builder->where('tb.empid', $user_id);
        }
        if ($category_id != '') {
            $builder->Where('category_id', $category_id);
        }
        $builder->groupBy('n.ID,catagory_name,t.id,daily_rate');
        $builder->orderBy('catagory_name', 'ASC');
        return $builder->get()->getResultArray();
    }

    function get_time_report_users()
    {
        $begin_date = '';
        $end_date   = '';
        if ($this->request->getPost() != '') {
            $begin_date = date('Y-m-01');
            $end_date = date('Y-m-t');
        }
        if ($this->request->getPost('start_date') != '') {
            $begin_date = date('Y-m-d', strtotime($this->request->getPost('start_date')));
        }
        if ($this->request->getPost('end_date') != '') {
            $end_date = date('Y-m-d', strtotime($this->request->getPost('end_date')));
        }

        $builder = $this->db->table('tbl_contract_transaction tb');
        $builder->distinct();
        $builder->select('n.ID,n.FirstName,n.LastName')
            ->join('tblcategory as t', 't.id = tb.category_id')
            ->join('name as n', 'n.ID = tb.empid');
        $builder->join('tblcontract C', 'C.id=tb.contract_id', 'INNER');
        $builder->where('C.deletestatus', 0);
        $builder->where('hours <>', '0.00');
        if ($begin_date != '') {
            $builder->where('transaction_date >=', $begin_date);
        }
        if ($end_date != '') {
            $builder->where('transaction_date <=', $end_date);
        }
        $builder->orderBy('n.FirstName', 'ASC');
        $builder->orderBy('n.LastName', 'ASC');
        return $builder->get()->getResultArray();
    }

    function get_time_report_category()
    {
        $begin_date = '';
        $end_date   = '';
        if ($this->request->getPost() != '') {
            $begin_date = date('Y-m-01');
            $end_date = date('Y-m-t');
        }
        if ($this->request->getPost('start_date') != '') {
            $begin_date = date('Y-m-d', strtotime($this->request->getPost('start_date')));
        }
        if ($this->request->getPost('end_date') != '') {
            $end_date = date('Y-m-d', strtotime($this->request->getPost('end_date')));
        }

        $builder = $this->db->table('tbl_contract_transaction tb');
        $builder->distinct();
        $builder->select('catagory_name,t.id as cat_id,grant_type')
            ->join('tblcategory as t', 't.id = tb.category_id')
            ->join('name as n', 'n.ID = tb.empid');
        $builder->join('tblcontract C', 'C.id=tb.contract_id', 'INNER');
        $builder->where('C.deletestatus', 0);
        $builder->where('hours <>', '0.00');
        if ($begin_date != '') {
            $builder->where('transaction_date >=', $begin_date);
        }
        if ($end_date != '') {
            $builder->where('transaction_date <=', $end_date);
        }
        $builder->orderBy('catagory_name', 'ASC');
        return $builder->get()->getResultArray();
    }

    function getEmployeeNameById($empid)
    {

        $builder = $this->db->table('name');
        $builder->select('*');
        $builder->where('ID', $empid);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getSingleContractTransaction($empid)
    {

        $builder = $this->db->table('tbl_contract_transaction A');
        $builder->select('A.*, B.*, C.contract_begin_date, C.contract_end_date');
        $builder->join('tblcategory B', 'A.category_id=B.id', 'INNER');
        $builder->join('tblcontract C', 'C.id=A.contract_id', 'INNER');
        $builder->where('C.empid', $empid);
        $builder->where('C.deletestatus', 0);
        $builder->where('hours <>', '0.00');
        $builder->where('islock', 1);
        $builder->orderBy('transaction_date', 'DESC');
        $query = $builder->get();
        /*  echo $this->db->last_query(); die();*/
        if ($query->getNumRows() >= 1) {

            $arr = $query->getRowArray();

            if (!empty($arr)) {

                if ($arr['transaction_date'] != '' && $arr['transaction_date'] != '0000-00-00 00:00:00') {
                    $arr['transaction_date'] = date('D, d M Y', strtotime($arr['transaction_date']));
                } else {
                    $arr['transaction_date'] = "";
                }

                if ($arr['datesubmitted'] != '' && $arr['datesubmitted'] != '0000-00-00 00:00:00') {
                    $arr['datesubmitted'] = date('D, d M Y', strtotime($arr['datesubmitted']));
                } else {
                    $arr['datesubmitted'] = "";
                }

                if ($arr['finalsubmit_date'] != '' && $arr['finalsubmit_date'] != '0000-00-00 00:00:00') {
                    $arr['finalsubmit_date'] = date('D, d M Y', strtotime($arr['finalsubmit_date']));
                } else {
                    $arr['finalsubmit_date'] = "";
                }

                if ($arr['sync_date_time'] != '' && $arr['sync_date_time'] != '0000-00-00 00:00:00') {
                    $arr['sync_date_time'] = date('D, d M Y', strtotime($arr['sync_date_time']));
                } else {
                    $arr['sync_date_time'] = "";
                }
            }

            return $arr;
        } else {
            return array();
        }
    }

    function getAllContractTransaction($empid)
    {

        $builder = $this->db->table('tbl_contract_transaction A');
        $builder->select('A.*, B.*, C.contract_begin_date, C.contract_end_date');
        $builder->join('tblcategory B', 'A.category_id=B.id', 'INNER');
        $builder->join('tblcontract C', 'C.id=A.contract_id', 'INNER');
        $builder->where('C.empid', $empid);
        $builder->where('C.deletestatus', 0);
        $builder->where('hours <>', '0.00');
        if ($this->request->getPost('BeginDate') != '') {
            $builder->where('A.transaction_date >= ', date('Y-m-d', strtotime($this->request->getPost('BeginDate'))));
        }
        if ($this->request->getPost('EndDate') != '') {
            $builder->where('A.transaction_date <= ', date('Y-m-d', strtotime($this->request->getPost('EndDate'))));
        }
        $builder->orderBy('transaction_date');
        $query = $builder->get();
        /*	echo $this->db->last_query(); die();*/
        if ($query->getNumRows() >= 1) {

            $array = $query->getResultArray();

            if (!empty($array)) {
                foreach ($array as &$arr) {
                    if ($arr['transaction_date'] != '' && $arr['transaction_date'] != '0000-00-00 00:00:00') {
                        $arr['transaction_date'] = date('D, d M Y', strtotime($arr['transaction_date']));
                    } else {
                        $arr['transaction_date'] = "";
                    }

                    if ($arr['datesubmitted'] != '' && $arr['datesubmitted'] != '0000-00-00 00:00:00') {
                        $arr['datesubmitted'] = date('D, d M Y', strtotime($arr['datesubmitted']));
                    } else {
                        $arr['datesubmitted'] = "";
                    }

                    if ($arr['finalsubmit_date'] != '' && $arr['finalsubmit_date'] != '0000-00-00 00:00:00') {
                        $arr['finalsubmit_date'] = date('D, d M Y', strtotime($arr['finalsubmit_date']));
                    } else {
                        $arr['finalsubmit_date'] = "";
                    }

                    if ($arr['sync_date_time'] != '' && $arr['sync_date_time'] != '0000-00-00 00:00:00') {
                        $arr['sync_date_time'] = date('D, d M Y', strtotime($arr['sync_date_time']));
                    } else {
                        $arr['sync_date_time'] = "";
                    }
                }
            }

            return $array;
        } else {
            return array();
        }
    }

    function getCategory($empid)
    {

        $builder = $this->db->table('tblcategory');
        $builder->select('*');
        $builder->where('`id` NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE);
        $builder->orderBy('catagory_name', 'ASC');

        //$builder->where('Active', 1);
        $query = $builder->get();
        // echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getActiveContractorDetailsFisical($selected_year)
    {

        $finanyr = explode("-", $selected_year);
        $first_date = $finanyr[0] . "-07-01";
        $last_date = $finanyr[1] . "-06-30";
        $application_id = session()->get('NAME_ID');

        $current_date = date('Y-m-d');

        $builder = $this->db->table('tblcontract as c');
        $builder->select('*');
        $condition1 = "(((c.contract_end_date between '$first_date' AND '$last_date' ) 
                         AND c.deletestatus=0))";
        $condition2 = "((c.contract_begin_date <= '.$last_date.' AND c.contract_end_date >= '.$first_date.') AND c.deletestatus=0))";
        $builder->where($condition1);
        /* $builder->or_where($condition2);*/
        $builder->where(["empid" => $application_id]);
        $builder->orderBy('c.contract_begin_date', 'DESC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {

            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getNewActiveContractors()
    {
        /*$this->db->select('c.*,(select concat( n.FirstName, " ", n.LastName) from name as n where n.id = c.empid) as empname');
        $this->db->from('tblcontract as c');
        $this->db->where('(deletestatus IS NULL OR deletestatus= 0)');
        return $this->db->get()->getResultArray();*/
        $current_date = date('Y-m-d');
        $builder = $this->db->table('tblcontract as c');
        $builder->select('c.*,  
        (select al.profile_image from admin_login as al where admin_email = ( select distinct email from email as e where e.email like "%@future.edu%" AND e.Active=1 AND e.EmailID = c.empid limit 1 )) as profile_image,
        (select concat( n.FirstName, " ", n.LastName) from name as n where n.id = c.empid) as empname, 
        IFNULL((select sum(FLOOR(ct.hours)) as hours_worked from tbl_contract_transaction as ct where  ct.empid = c.empid and ct.transaction_date between c.contract_begin_date 
        and c.contract_end_date), 0) as hours_worked, IFNULL((select SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) AS TimeInHoursMinutes from tbl_contract_transaction as ct where  ct.empid = c.empid and ct.transaction_date between c.contract_begin_date 
        and c.contract_end_date), 0) as minutes_worked, (select max(transaction_date) from tbl_contract_transaction as ct3 where  ct3.empid = c.empid and ct3.transaction_date between c.contract_begin_date 
        and c.contract_end_date) as last_sync_date');

        $builder->join(
            '(SELECT MAX(contract_end_date) as contract_end_date,empid FROM tblcontract 
                          where deletestatus IS NULL OR deletestatus =0 GROUP BY empid) t2',
            'c.empid=t2.empid and c.contract_end_date=t2.contract_end_date'
        );


        /*  $this->db->join('admin_login  as al','al.admin_email = 
        ( select distinct email from email as e where e.email like "%@future.edu%" AND e.Active=1 AND e.EmailID = c.empid limit 1)','left');
      */
        if ($this->request->getPost('tab_type') == 'Inactive') {
            //$this->db->where('account_status','0');
            $current_date = date("Y-m-d");
            $builder->where('c.empid NOT IN (select empid from tblcontract where contract_end_date >="' . $current_date . '")');
        }
        if ($this->request->getPost('tab_type') == 'Active') {
            //$this->db->where('account_status','1');
            $current_date = date("Y-m-d");
            $builder->where('c.empid IN (select empid from tblcontract where contract_end_date >="' . $current_date . '")');
        }
        $builder->orderBy('empname', 'ASC');
        $builder->orderBy('c.contract_end_date', 'DESC');
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getSubCategoryactiveonly()
    {


        $SQL = "SELECT * FROM `tblcategory` WHERE id not in (select parent_id from tblcategory) AND `Active` = 1 
                ORDER BY `catagory_name` ASC
                ";
        $query = $this->db->query($SQL);
        /*  echo $this->db->last_query(); die();*/
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getCategoryNew($empid)
    {

        $builder = $this->db->table('tblcategory as e1');
        $builder->select('e1.*');
        $builder->join('tbl_user_task_category as uc', 'uc.taskcategoryid = e1.id AND uc.status =1');
        $builder->where('e1.id NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE);
        $builder->where('uc.empid', $empid);
        $builder->orderBy('e1.catagory_name', 'ASC');

        $builder->where('e1.Active', 1);
        $query = $builder->get();
        // echo $builder->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getpCategory($empid)
    {

        $builder = $this->db->table('tblcategory');
        $builder->select('*');
        $builder->where('`id`  IN (select distinct parent_id from tblcategory)', NULL, FALSE);
        $builder->orderBy('catagory_name', 'ASC');

        //$builder->where('Active', 1);
        $query = $builder->get();
        //echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getpSCategory()
    {

        $builder = $this->db->table('tblcategory');
        $builder->select('*');
        $builder->where('parent_id', '0');
        $builder->where('`id` NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE);
        $builder->orderBy('catagory_name', 'ASC');

        //$builder->where('Active', 1);
        $query = $builder->get();
        /*  echo $this->db->last_query(); die();*/

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function get_teamid_bycontract($emp, $date)
    {
        $SQL = "SELECT teamid from tblcontract where empid=$emp and (" . "'$date'" . " between contract_begin_date and contract_end_date );";
        $query = $this->db->query($SQL);
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getActiveContractorsByID_New($empid, $date)
    {
        $SQL = "select tmp.id,
         min(rootid) as min_contact_id,max(rootid) as max_contact_id,
        min(contract_begin_date) contract_begin_date,max(contract_end_date) contract_end_date,
                sum(hours_worked) as hours_worked,
                SUM(minutes_worked) AS minutes_worked,
                SUM(hours_to_work) hours_to_work,
                SUM(CarriedOverHours) CarriedOverHours,
                max(last_sync_date) as last_sync_date
                from( SELECT id rootid, id,empid,contract_begin_date,contract_end_date,parent_contract_id,hours_to_work,CarriedOverHours FROM tblcontract where parent_contract_id=0 and empid='" . $empid . "' AND deletestatus = '0'
                union all
                SELECT id rootid,parent_contract_id,empid,contract_begin_date,contract_end_date,parent_contract_id,hours_to_work,CarriedOverHours FROM tblcontract where parent_contract_id<>0  and empid='" . $empid . "' AND deletestatus = '0'
                    )tmp
                 left join (SELECT tbl_contract_transaction.empid,tbl_contract_transaction.contract_id,
                sum(FLOOR(hours)) as hours_worked,
                SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) AS minutes_worked,
                max(transaction_date) as last_sync_date
                            from tbl_contract_transaction
                            group by tbl_contract_transaction.empid,tbl_contract_transaction.contract_id) tbl_contract_transaction
                 on tmp.empid=tbl_contract_transaction.empid
                 and (tmp.rootid=tbl_contract_transaction.contract_id)
                 group by tmp.id having min(contract_begin_date) <= '" . $date . "' AND max(contract_end_date) >= '" . $date . "'";
        $query = $this->db->query($SQL);
        // echo $this->db->getLastQuery(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getActiveContractorsByContractID($empid, $contract_id)
    {

        $builder = $this->db->table('tblcontract as c');
        $builder->select('c.*,  ( select al.profile_image from admin_login as al where admin_email = ( select distinct email from email as e where e.email like "%@future.edu%" AND e.EmailID = c.empid limit 1 )) as profile_image, (select concat( n.FirstName, " ", n.LastName) from name as n where n.id = c.empid) as empname, IFNULL((select sum(FLOOR(ct.hours)) as hours_worked from tbl_contract_transaction as ct where ct.empid = c.empid and ct.transaction_date between c.contract_begin_date 
        and c.contract_end_date), 0) as hours_worked, 
        IFNULL((select SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) AS TimeInHoursMinutes from tbl_contract_transaction as ct
        where ct.empid = c.empid and ct.transaction_date between c.contract_begin_date 
        and c.contract_end_date), 0) as minutes_worked, (select max(transaction_date) from tbl_contract_transaction as ct3 where ct3.empid = c.empid and ct3.transaction_date between c.contract_begin_date 
        and c.contract_end_date) as last_sync_date');

        $builder->where('c.deletestatus', 0);
        $builder->where('c.empid', $empid);
        $builder->where('c.id', $contract_id);
        $builder->orderBy('c.contract_begin_date', 'DESC');
        $query = $builder->get();

        /* echo $this->db->last_query();die;*/
        //echo "<pre>";print_r($query->getResultArray());die;

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getActiveContractorsByID($empid, $date)
    {

        $builder = $this->db->table('tblcontract as c');
        $builder->select('c.*,  ( select al.profile_image from admin_login as al where admin_email = ( select distinct email from email as e where e.email like "%@future.edu%" AND e.EmailID = c.empid limit 1 )) as profile_image, (select concat( n.FirstName, " ", n.LastName) from name as n where n.id = c.empid) as empname, IFNULL((select sum(FLOOR(ct.hours)) as hours_worked from tbl_contract_transaction as ct where ct.empid = c.empid and ct.transaction_date between c.contract_begin_date 
        and c.contract_end_date), 0) as hours_worked, IFNULL((select SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) AS TimeInHoursMinutes from tbl_contract_transaction as ct where ct.empid = c.empid and ct.transaction_date between c.contract_begin_date 
        and c.contract_end_date), 0) as minutes_worked, (select max(transaction_date) from tbl_contract_transaction as ct3 where ct3.empid = c.empid and ct3.transaction_date between c.contract_begin_date 
        and c.contract_end_date) as last_sync_date');
        $builder->where('c.contract_begin_date <= "' . $date . '"');
        $builder->where('c.contract_end_date >= "' . $date . '"');
        $builder->where('c.deletestatus', 0);
        $builder->where('c.empid', $empid);
        $builder->orderBy('c.contract_begin_date', 'DESC');
        $query = $builder->get();

        /* echo $this->db->last_query();die;*/
        //echo "<pre>";print_r($query->getResultArray());die;

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getTransactionByDate($empid, $date, $category_id = '')
    {

        $builder = $this->db->table('tbl_contract_transaction');
        $builder->select('*');
        $builder->where('empid', $empid);
        $builder->where('DATE(transaction_date)', $date);
        if ($category_id != '') {
            $builder->where('category_id', $category_id);
        }
        $query = $builder->get();
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {
            $array = $query->getResultArray();
            return $array;
        } else {
            return array();
        }
    }

    function getCat($emp)
    {

        $builder = $this->db->table('tblcategory as e1');
        $builder->select('e1.*');
        $builder->join('tbl_user_task_category as uc', 'uc.taskcategoryid = e1.id');
        $builder->where('uc.empid', $emp);
        $builder->where('uc.status', '1');
        $builder->where('e1.id NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE);
        $builder->orderBy('e1.catagory_name', 'ASC');

        //$builder->where('Active', 1);
        $query = $builder->get();
        // echo $builder->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }

        $this->db->select('e1.*,uc.id as rid')
            ->from('tblcategory e1')
            ->join('tbl_user_task_category as uc', 'uc.taskcategoryid = e1.id')
            ->where('uc.empid', $empid)
            ->where('uc.status', '1')
            ->where('e1.Active', 1)
            ->where('e1.id NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE)
            ->orderBy('e1.catagory_name')
            ->get()
            ->result();
    }

    function getTeam_supervisor($teamid)
    {

        $teamid = (int)$teamid;
        $builder = $this->db->table('Teams');
        $builder->select('empid');
        $builder->where('id', $teamid);

        //$this->db->where('Active', 1);
        $query = $builder->get();
        // echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }

    function getActiveAdminContractorDetailsFisical($selected_year)
    {

        $builder = $this->db->table('tblcontract as c');
        //echo "<pre>";print_r($selected_year);echo "</pre>";die();
        $finanyr = explode("-", $selected_year);
        $first_date = $finanyr[0] . "-07-01";
        $last_date = $finanyr[1] . "-06-30";
        $current_date = date('Y-m-d');
        $builder->select('*');
        $condition1 = "(((c.contract_end_date between '$first_date' AND '$last_date' ) 
                         AND c.deletestatus=0))";
        $condition2 = "((c.contract_begin_date <= '.$last_date.' AND c.contract_end_date >= '.$first_date.') AND c.deletestatus=0))";
        $builder->where($condition1);
        /* $this->db->or_where($condition2);*/
        if ($this->request->getPost('User_option') != '' && $this->request->getPost('User_option') != 0) {
            $application_id = $this->request->getPost('User_option');
            $builder->where(["empid" => $application_id]);
        }

        $builder->orderBy('c.contract_begin_date', 'DESC');
        $query = $builder->get();
        /*echo $this->db->last_query();
        echo "<pre>";print_r($query->getResultArray());
        die();*/
        if ($query->getNumRows() >= 1) {

            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function carriedDetails($finyear)
    {
        $fin = explode("-", $finyear);
        if (!empty($fin)) {
            return $this->db->table('carried_over_change')->select('*')
                ->where("fromyear between $fin[0] and $fin[1] and toyear between $fin[0] and $fin[1]")
                ->get()
                ->getResultArray();
        } else {
            return array();
        }
    }

    function get_category_total_emp($emp_id, $cat, $begin_date, $end_date)
    {


        if ($begin_date != '') {
            $begin_date = date('Y-m-d', strtotime($begin_date));
        }
        if ($end_date != '') {
            $end_date = date('Y-m-d', strtotime($end_date));
        }
        $builder = $this->db->table('tbl_contract_transaction tb');
        $builder->select('SUM(FLOOR(tb.hours)) as t_hours,SUM(SUBSTRING(tb.hours - FLOOR(tb.hours), 3, 5)) as t_minutes')
            ->join('tblcategory as t', 't.id = tb.category_id')
            ->join('name as n', 'n.ID = tb.empid');
        $builder->join('tblcontract C', 'C.id=tb.contract_id', 'INNER');
        $builder->where('C.deletestatus', 0);
        $builder->where('hours <>', '0.00');
        if ($emp_id != '') {
            $builder->where('tb.empid', $emp_id);
        }

        if ($begin_date != '') {
            $builder->where('transaction_date >=', $begin_date);
        }
        if ($end_date != '') {
            $builder->where('transaction_date <=', $end_date);
        }
        if ($cat != '') {
            $builder->where('category_id', $cat);
        }

        $builder->orderBy('n.FirstName', 'ASC');
        $builder->orderBy('transaction_date', 'ASC');
        $builder->orderBy('catagory_name', 'ASC');
        return $builder->get()->getResultArray();
    }

    function get_user_category($empid = '', $team = '')
    {
        $builder = $this->db->table('tblcategory as tb');
        $builder->distinct();
        $builder->select('tb.*');
        $builder->join('tbl_user_task_category as tc', 'tc.taskcategoryid = tb.id AND tc.status = 1');

        $builder->where('tb.id NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE);
        $builder->orderBy('catagory_name', 'ASC');

        $builder->where('Active', 1);
        if ($empid != '') {
            $builder->where('(tc.empid =' . $empid . ')');
        }
        if ($team != '') {

            $builder->where('tc.empid IN (select c1.empid from tblcontract c1,Teams tm where c1.teamid = `tm`.`id` and `tm`.`id` =' . $team . ")");
        }
        $query = $builder->get();
        // echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function get_journal_in_montly_report2()
    {
        $begin_date = $end_date = '';
        if ($this->request->getPost('BeginDate') != '') {
            $begin_date = date('Y-m-d', strtotime($this->request->getPost('BeginDate')));
        }
        if ($this->request->getPost('EndDate') != '') {
            $end_date = date('Y-m-d', strtotime($this->request->getPost('EndDate')));
        }
        $builder = $this->db->table('tbl_contract_transaction tb');
        $builder->select('journal,transaction_date,hours,catagory_name,tb.journal,tb.office_status')
            ->join('tblcategory as t', 't.id = tb.category_id');
        $builder->join('tblcontract C', 'C.id=tb.contract_id', 'INNER');
        $builder->where('C.deletestatus', 0);
        $builder->where('hours <>', '0.00');
        $builder->where('tb.empid', session()->get('NAME_ID'));
        if ($begin_date != '') {
            $builder->where('transaction_date >=', $begin_date);
        }
        if ($end_date != '') {
            $builder->where('transaction_date <=', $end_date);
        }
        if ($this->request->getPost('category_id') != '') {
            $builder->where('category_id', $this->request->getPost('category_id'));
        }
        $builder->orderBy('transaction_date', 'ASC');
        $builder->orderBy('catagory_name', 'ASC');
        return $builder->get()->getResultArray();
    }

    function get_journal_in_admin_montly_report()
    {
        $begin_date = $end_date = '';
        if ($this->request->getPost('BeginDate') != '') {
            $begin_date = date('Y-m-d', strtotime($this->request->getPost('BeginDate')));
        }
        if ($this->request->getPost('EndDate') != '') {
            $end_date = date('Y-m-d', strtotime($this->request->getPost('EndDate')));
        }
        $builder = $this->db->table('tbl_contract_transaction tb');
        $builder->select('n.ID,journal,transaction_date,hours,catagory_name,t.id as cat_id,tb.journal,C.contract_1099,n.FirstName,n.LastName,(C.daily_rate/8) as daily_rate,C.daily_rate as kk,office_status')
            ->join('tblcategory as t', 't.id = tb.category_id')
            ->join('name as n', 'n.ID = tb.empid');
        $builder->join('tblcontract C', 'C.id=tb.contract_id', 'INNER');
        $builder->where('C.deletestatus', 0);
        $builder->where('hours <>', '0.00');
        if ($this->request->getPost('User_option') != '') {
            $builder->where('tb.empid', $this->request->getPost('User_option'));
        }

        if ($begin_date != '') {
            $builder->where('transaction_date >=', $begin_date);
        }
        if ($end_date != '') {
            $builder->where('transaction_date <=', $end_date);
        }
        if ($this->request->getPost('category_id') != '') {
            $builder->where('category_id', $this->request->getPost('category_id'));
        }
        if ($this->request->getPost('Team_option') != '') {
            $builder->where('tb.empid IN (select c1.empid from tblcontract c1,Teams tm where c1.teamid = `tm`.`id` and `tm`.`id` =' . $this->request->getPost('Team_option') . ")");
        }
        if ($this->request->getPost('contract_1099') != '') {
            $builder->where('contract_1099', $this->request->getPost('contract_1099'));
        }
        $builder->orderBy('n.FirstName', 'ASC');
        $builder->orderBy('n.LastName', 'ASC');
        $builder->orderBy('catagory_name', 'ASC');
        $builder->orderBy('transaction_date', 'ASC');

        return $builder->get()->getResultArray();
    }


    function total_hours_in_monthly_journal_report()
    {
        $BeginDate = '';
        $EndDate = '';


        $begin_date = $end_date = '';
        if ($this->request->getPost('BeginDate') != '') {
            $BeginDate = date('Y-m-d', strtotime($this->request->getPost('BeginDate')));
        }
        if ($this->request->getPost('EndDate') != '') {
            $EndDate = date('Y-m-d', strtotime($this->request->getPost('EndDate')));
        }
        $builder = $this->db->table('tbl_contract_transaction tb');
        $builder->select('SUM(FLOOR(tb.hours)) as t_hours,SUM(SUBSTRING(tb.hours - FLOOR(tb.hours), 3, 5)) as t_minutes')
            ->join('tblcategory as t', 't.id = tb.category_id');
        $builder->join('tblcontract C', 'C.id=tb.contract_id', 'INNER');
        $builder->where('C.deletestatus', 0);
        $builder->where('hours <>', '0.00');
        $builder->where('tb.empid', session()->get('NAME_ID'));
        if ($BeginDate != '') {
            $builder->where('transaction_date >=', $BeginDate);
        }
        if ($EndDate != '') {
            $builder->where('transaction_date <=', $EndDate);
        }
        if ($this->request->getPost('category_id') != '') {
            $builder->where('category_id', $this->request->getPost('category_id'));
        }
        $builder->orderBy('transaction_date', 'ASC');
        $builder->orderBy('catagory_name', 'ASC');

        return $builder->get()->getResultArray();
    }

    function admin_total_hours_in_monthly_journal_report()
    {
        $begin_date = $end_date = '';
        if ($this->request->getPost('BeginDate') != '') {
            $begin_date = date('Y-m-d', strtotime($this->request->getPost('BeginDate')));
        }
        if ($this->request->getPost('EndDate') != '') {
            $end_date = date('Y-m-d', strtotime($this->request->getPost('EndDate')));
        }
        $builder = $this->db->table('tbl_contract_transaction tb');
        $builder->select('SUM(FLOOR(tb.hours)) as t_hours,SUM(SUBSTRING(tb.hours - FLOOR(tb.hours), 3, 5)) as t_minutes')
            ->join('tblcategory as t', 't.id = tb.category_id')
            ->join('name as n', 'n.ID = tb.empid');
        $builder->join('tblcontract C', 'C.id=tb.contract_id', 'INNER');
        $builder->where('C.deletestatus', 0);
        $builder->where('hours <>', '0.00');
        if ($this->request->getPost('User_option') != '') {
            $builder->where('tb.empid', $this->request->getPost('User_option'));
        }

        if ($begin_date != '') {
            $builder->where('transaction_date >=', $begin_date);
        }
        if ($end_date != '') {
            $builder->where('transaction_date <=', $end_date);
        }
        if ($this->request->getPost('category_id') != '') {
            $builder->where('category_id', $this->request->getPost('category_id'));
        }
        if ($this->request->getPost('Team_option') != '') {
            $builder->where('tb.empid IN (select c1.empid from tblcontract c1,Teams tm where c1.teamid = `tm`.`id` and `tm`.`id` =' . $this->request->getPost('Team_option') . ")");
        }
        if ($this->request->getPost('contract_1099') != '') {
            $builder->where('contract_1099', $this->request->getPost('contract_1099'));
        }

        $builder->orderBy('n.FirstName', 'ASC');
        $builder->orderBy('transaction_date', 'ASC');
        $builder->orderBy('catagory_name', 'ASC');
        return $builder->get()->getResultArray();
    }

    function getActiveContractorsByIDFisical_New($empid, $date)
    {

        $finanyr = explode("-", $date);
        $first_date = $finanyr[0] . "-07-01";
        $last_date = $finanyr[1] . "-07-01";

        $current_date = date('Y-m-d');

        $SQL = "select tmp.id,
        min(rootid) as min_contact_id,max(rootid) as max_contact_id,
        min(contract_begin_date) contract_begin_date,max(contract_end_date) contract_end_date,
                sum(hours_worked) as hours_worked,
                SUM(minutes_worked) AS minutes_worked,
                SUM(hours_to_work) hours_to_work,
                SUM(CarriedOverHours) CarriedOverHours,
                max(last_sync_date) as last_sync_date
                from( SELECT id rootid, id,empid,contract_begin_date,contract_end_date,parent_contract_id,hours_to_work,CarriedOverHours FROM tblcontract where parent_contract_id=0 and empid='" . $empid . "'
                union all
                SELECT id rootid,parent_contract_id,empid,contract_begin_date,contract_end_date,parent_contract_id,hours_to_work,CarriedOverHours FROM tblcontract where parent_contract_id<>0  and empid='" . $empid . "'
                    )tmp
                 left join (SELECT tbl_contract_transaction.empid,tbl_contract_transaction.contract_id,
                			sum(FLOOR(hours)) as hours_worked,
                			SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) AS minutes_worked,
                			max(transaction_date) as last_sync_date
                            from tbl_contract_transaction 
                            group by tbl_contract_transaction.empid,tbl_contract_transaction.contract_id) tbl_contract_transaction
                 on tmp.empid=tbl_contract_transaction.empid
                 and (tmp.rootid=tbl_contract_transaction.contract_id)
                 group by tmp.id HAVING MAX(contract_end_date) BETWEEN '" . $first_date . "' AND '" . $last_date . "'";
        $query = $this->db->query($SQL);
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function check_any_sub_category($emp, $cat_id)
    {
        $builder = $this->db->table('tblcategory as e1');
        $builder->select('e1.*');
        $builder->join('tbl_user_task_category as uc', 'uc.taskcategoryid = e1.id AND uc.status =1');
        $builder->where('uc.empid', $emp);
        $builder->where('uc.status', '1');
        $builder->where('e1.id NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE);
        $builder->where('e1.parent_id', $cat_id);
        $builder->orderBy('e1.catagory_name', 'ASC');

        //$builder->where('Active', 1);
        $query = $builder->get();
        // echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getpSCat()
    {
        $builder = $this->db->table('tblcategory as e1');
        $builder->select('e1.*');
        $builder->join('tbl_user_task_category as uc', 'uc.taskcategoryid = e1.id AND uc.status =1');
        $builder->where('uc.empid', session()->get('NAME_ID'));
        $builder->where('uc.status', '1');
        $builder->where('e1.parent_id', '0');
        $builder->where('e1.id NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE);
        $builder->orderBy('e1.catagory_name', 'ASC');

        //$builder->where('Active', 1);
        $query = $builder->get();
        /*  echo $this->db->last_query(); die();*/

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function updateTimesheet_new($param, $previous)
    {
        //echo "<pre>";print_r($param); die;
        $result = array();
        $data = array();
        $send_array = array();
        foreach ($param as $key => $val) {
            $data[$key] = $key == 'sync_status' ? 0 : test_input($val);

            if ($key != 'deviceid' && $key != 'sync_date_time') {
                $send_array[$key] = $key == 'sync_status' ? 0 : test_input($val);
            }

            if ($key == 'transaction_date' || $key == 'sync_date_time' || $key == 'datesubmitted' || $key == 'finalsubmit_date') {
                if ($val != '') {
                    $data[$key] = date('Y-m-d H:i:s', strtotime($val));
                }
            }
        }

        $t_date = $data['transaction_date'];
        $date =  $t_date;
        $d = date_parse_from_format("Y-m-d", $date);
        /* echo $d["month"];
        echo $d["year"];*/
        if ($d["month"] < 9) {
            $month = "0" . $d["month"];
        } else {
            $month = $d["month"];
        }

        $first_date = $d["year"] . "-" . $month . "-01";
        $last_date = date("Y-m-d", strtotime($t_date));
        $data1 = array(
            'islock' => $data['islock'],
            'deviceid' => $data['deviceid'],
            'finalsubmit_date' => $data['finalsubmit_date'],
            'sync_date_time' => $data['sync_date_time'],
            'datesubmitted' => $data['datesubmitted'],
            'submitted_by' => $data['submitted_by'],
        );
        /* print_r($first_date);
        print_r($last_date);
        exit();*/

        $builder = $this->db->table('tbl_contract_transaction');
        $builder->select('islock', 'transaction_date', 'category_id', 'empid');
        $builder->where('empid', $data['empid']);
        $builder->where('category_id', $data['category_id']);
        $builder->where('transaction_date', $data['transaction_date']);
        // $builder->where('contract_id', $data['contract_id']);   //Comment Dated 23-May-2019 due to process change by client
        $query = $builder->get();
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {

            $array = $query->getResultArray();

            if ($array[0]['islock'] != 1) {

                if ($previous == "unlock") {

                    $builder->where('empid', $data['empid']);
                    $builder->where('category_id', $data['category_id']);
                    $builder->where('transaction_date', $data['transaction_date']);
                    $res = $builder->update($data);
                } else {
                    $builder->where('empid', $data['empid']);
                    $builder->where('category_id', $data['category_id']);
                    $builder->where('transaction_date', $data['transaction_date']);
                    $res = $builder->update($data);

                    //"$accommodation BETWEEN $minvalue AND $maxvalue"
                    $builder->where('empid', $data['empid']);
                    $builder->where('transaction_date <=', $last_date);
                    $builder->where('transaction_date >=', $first_date);


                    $res = $builder->update($data1);
                    //$builder->where('transaction_date BETWEEN $first_date AND $last_date');
                }
                // $builder->where('contract_id', $data['contract_id']); //Comment Dated 23-May-2019 due to process change by client
                //echo "<pre>";print_r($data);


            } else {
                $res = true;
            }
        } else {
            $res = $builder->insert($data);
        }

        if ($res) {
            $result['status'] = true;
            $result['msg'] = "Updated";
            $result['record'] = $send_array;
        } else {
            $result['status'] = false;
            $result['msg'] = "Not Updated";
            $result['record'] = '';
        }
        //die;
        return $result;
    }

    function gettestCategory($empid)
    {

        $builder = $this->db->table('tblcategory as tb');
        $builder->select('tb.*');
        $builder->join('tbl_user_task_category as tc', 'tc.taskcategoryid = tb.id AND tc.empid =' . $empid);
        $builder->where('tb.id NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE);
        $builder->orderBy('catagory_name', 'ASC');

        $query = $builder->get();
        // echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function get_Category_id($empid)
    {

        $builder = $this->db->table('tblcategory as tb');
        $builder->select('tb.*');
        $builder->join('tbl_user_task_category as tc', 'tc.taskcategoryid = tb.id AND tc.status = 1 AND tc.empid =' . $empid);
        $builder->where('tb.id NOT IN (select distinct parent_id from tblcategory)', NULL, FALSE);
        if ($this->request->getPost('category_id') != '') {
            $builder->where('tb.id', $this->request->getPost('category_id'));
        }
        $builder->orderBy('catagory_name', 'ASC');

        //$builder->where('Active', 1);
        $query = $builder->get();
        // echo $this->db->last_query(); die();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getActiveContractors()
    {

        $current_date = date('Y-m-d');
        $builder = $this->db->table('tblcontract as c');
        $builder->select('c.*,  ( select al.profile_image from admin_login as al where admin_email = ( select distinct email from email as e where e.email like "%@future.edu%" AND e.Active=1 AND e.EmailID = c.empid limit 1 )) as profile_image, (select concat( n.FirstName, " ", n.LastName) from name as n where n.id = c.empid) as empname, IFNULL((select sum(FLOOR(ct.hours)) as hours_worked from tbl_contract_transaction as ct where  ct.empid = c.empid and ct.transaction_date between c.contract_begin_date 
        and c.contract_end_date), 0) as hours_worked, IFNULL((select SUM(SUBSTRING(hours - FLOOR(hours), 3, 5)) AS TimeInHoursMinutes from tbl_contract_transaction as ct where  ct.empid = c.empid and ct.transaction_date between c.contract_begin_date 
        and c.contract_end_date), 0) as minutes_worked, (select max(transaction_date) from tbl_contract_transaction as ct3 where  ct3.empid = c.empid and ct3.transaction_date between c.contract_begin_date 
        and c.contract_end_date) as last_sync_date');
        $condition1 = "(c.contract_begin_date <= '" . $current_date . "' AND c.contract_end_date <= '" . $current_date . "' AND c.deletestatus=0)";
        $condition2 = "(c.contract_begin_date <= '" . $current_date . "' AND c.contract_end_date >= '" . $current_date . "' AND c.deletestatus=0)";
        //  $condition3 = "(c.deletestatus=0)";
        $builder->where($condition1);
        $builder->orWhere($condition2);
        // $builder->or_where($condition3);  
        $builder->orderBy('empname', 'DESC');
        $query = $builder->get();
        /*  echo $builder->last_query();die;*/
        /*echo "<pre>";print_r($query->result_array());die;*/
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getCategoryactive() {
        $builder = $this->db->table('tblcategory');
        $builder->select('*');
        $builder->where('Active', 1);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function updateTimesheet_new_modal($param,$previous) {
        //echo "<pre>";print_r($param); die;
        $result = array();
        $data = array();
        $send_array = array(); 
        foreach ($param as $key => $val) {
            $data[$key] = $key == 'sync_status' ? 0 : test_input($val);
            
            if($key != 'deviceid' && $key != 'sync_date_time'){
                $send_array[$key] = $key == 'sync_status' ? 0 : test_input($val);
            }          
            
            if($key == 'transaction_date' || $key == 'sync_date_time' || $key == 'datesubmitted' || $key == 'finalsubmit_date'){
                if($val != ''){
                    $data[$key] = date('Y-m-d H:i:s', strtotime($val));
                }                
            }       
        }

        $t_date = $data['transaction_date'];
        $date =  $t_date;
        $d = date_parse_from_format("Y-m-d", $date);
       /* echo $d["month"];
        echo $d["year"];*/
        if($d["month"]< 9){
            $month="0".$d["month"];
        }else {
            $month=$d["month"];
        }

        $first_date=$d["year"]."-".$month."-01";
        $last_date=date("Y-m-d",strtotime($t_date)); 
         $data1=array(
                        'islock' => $data['islock'],
                        'deviceid' => $data['deviceid'],
                        'finalsubmit_date' => $data['finalsubmit_date'],
                        'sync_date_time' => $data['sync_date_time'],
                        'datesubmitted' => $data['datesubmitted'],
                        'submitted_by' => $data['submitted_by'], 
                        );
       /* print_r($first_date);
        print_r($last_date);
        exit();*/
        $builder = $this->db->table('tbl_contract_transaction');
        $builder->select('islock', 'transaction_date', 'category_id', 'empid');
        $builder->where('empid', $data['empid']);
        $builder->where('category_id', $data['category_id']);
        $builder->where('transaction_date', $data['transaction_date']);
       // $builder->where('contract_id', $data['contract_id']);   //Comment Dated 23-May-2019 due to process change by client
        $query = $builder->get();
        //echo $builder->last_query(); die();
        if ($query->getNumRows() >= 1) { 
            
            $array = $query->getResultArray();   
            
            if($array[0]['islock'] != 1){   
                
                if($previous=="unlock"){
                
                $builder->where('empid', $data['empid']);
                $builder->where('category_id', $data['category_id']);
                $builder->where('transaction_date', $data['transaction_date']);
                 $res = $builder->update($data);
            }else {
                 
                 if($data['islock']==2)
                 {
                     $data['islock'] = 1;
                 }
                 $builder->where('empid', $data['empid']);
                 $builder->where('category_id', $data['category_id']);
                 $builder->where('transaction_date', $data['transaction_date']);
                 $res = $builder->update($data);
                 
                 if($data1['islock']==2)
                 {
                     $data1['islock'] = 1;
                      $builder->where('empid', $data['empid']);
                      $builder->where('transaction_date',$last_date); 
                      $res = $builder->update($data1);
                      //$builder->where('transaction_date >=',$first_date);
                 }
                 else
                 {
                   //"$accommodation BETWEEN $minvalue AND $maxvalue"
                    $builder->where('empid', $data['empid']);
                    $builder->where('transaction_date <=',$last_date); 
                    $builder->where('transaction_date >=',$first_date);   
                    $res = $builder->update($data1);
                 }
                
              
               
                
                //$builder->where('transaction_date BETWEEN $first_date AND $last_date');
            }
               // $builder->where('contract_id', $data['contract_id']); //Comment Dated 23-May-2019 due to process change by client
                //echo "<pre>";print_r($data);
               
				
            }else{ 
                $res = true;
            }                  
            
        }else{
            
             if($data['islock'] == 1)
             {
                 
                 $builder->where('empid', $data['empid']);
                 $builder->where('transaction_date <=',$last_date); 
                 $builder->where('transaction_date >=',$first_date);   
                 $res = $builder->update('tbl_contract_transaction', $data1);
                 
                 
                 $res = $builder->insert($data); 
                 
             }
             else
             {
                 if($data['islock'] ==2)
                 {
                     $data['islock'] = 1;
                    
                 }
                  $res = $builder->insert($data); 
                 
                 
             }
               
				
        }
        
        if ($res) {
            $result['status'] = true;
            $result['msg'] = "Updated";
            $result['record'] = $send_array;
        } else {
            $result['status'] = false;
            $result['msg'] = "Not Updated";
            $result['record'] = '';
        }
        //die;
        return $result;
    }
}
