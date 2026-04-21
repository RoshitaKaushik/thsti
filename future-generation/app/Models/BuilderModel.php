<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class BuilderModel extends Model
{
    protected $db;
    protected $formbuilder;
    protected $request;
    protected $session;
    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect('formbuilder');
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
    }


    public function get_unread_formbuilder_forms($user_id)
    {

        // Build query on 'log_formbuilder_notify' table
        $builder = $this->db->table('log_formbuilder_notify');
        $builder->where('user_id', $user_id);
        $builder->where('read_status', 0);

        return $builder->countAllResults();
    }


    function get_unread_application_forms($user_id)
    {
        $db = Database::connect();
        $data = $db->table('assign_user_form')->select('component_id')
            ->where('user_id', $user_id)
            ->where('read_status', 0)
            ->groupStart()
            ->where('status', 1)
            ->orWhere('approval_status', 1)
            ->groupEnd()
            ->get();

        return $data->getNumRows();
    }

    function getallComponent()
    {

        $builder = $this->db->table('mst_scheme_component as MSC');

        $builder->select('MSC.id,MSC.scheme_component_name,MCP.payment_option,MSC.scheme_component_code');
        $builder->join('mst_component_payment as MCP', 'MSC.id = MCP.component_id', 'LEFT');
        $builder->where('MSC.form_build_status', 1);


        $builder->where('MSC.scheme_component_status', 1);

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getsingleComponent()
    {
        $builder = $this->db->table('mst_scheme_component as MSC');
        $builder->select('MSC.id,MSC.scheme_component_name,MCP.payment_option,MSC.scheme_component_code');
        $builder->join('mst_component_payment as MCP', 'MSC.id = MCP.component_id', 'LEFT');
        $builder->where('MSC.form_build_status', 1);
        $builder->where('MSC.id', 23);

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function get_donar_amount_by_application_id($application_id, $field_id)
    {
        $builder = $this->db->table('tbl_application');
        $builder->select('application_code');
        $builder->where('application_id', $application_id);
        $query = $builder->get();
        $data = $query->getRowArray();
        if ($data) {
            // get custume field value
            $builder->select('tbl_form_fields_value');
            $builder->where('application_code', $data['application_code']);
            $builder->where('field', $field_id);
            $query = $builder->get();
            $data = $query->getRowArray();
            return $data;
        } else {
            return false;
        }
    }

    function getAppAdmin($access_components, $status)
    {

        $builder = $this->db->table('tbl_application AS A')->distinct();
        $builder->select('A.*, B.scheme_name, C.status_text');
        $builder->join('mst_scheme as B', 'B.scheme_id = A.scheme_id', 'INNER');
        $builder->join('mst_status as C', 'C.status_id = A.approved_status', 'LEFT');
        $builder->where('A.approved_status', $status);
        $builder->where('A.save_status', 1);
        if (!empty($access_components)) {
            $builder->whereIn('A.component_id', $access_components);
        }

        $builder->orderBy('A.created_date', 'DESC');
        $query = $builder->get();

        //echo $builder->last_query();die;
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function user_wise_getallComponent($user_id)
    {

        $db = Database::connect();
        $builder = $db->table('assign_user_form')->distinct();
        $data = $builder->select('component_id')
            ->where('user_id', $user_id)
            ->where('status', 1)
            ->orWhere('approval_status', 1)
            ->get()
            ->getResultArray();

        $components = '';
        if ($data) {
            foreach ($data as $dt) {
                $components = $components . "," . $dt['component_id'];
            }
            $components = explode(",", $components);

            $builder2 = $this->db->table('mst_scheme_component as MSC');
            $builder2->select('MSC.id,MSC.scheme_component_name,MCP.payment_option,MSC.scheme_component_code');
            $builder2->join('mst_component_payment as MCP', 'MSC.id = MCP.component_id', 'LEFT');
            $builder2->where('MSC.form_build_status', 1);

            $builder2->where('MSC.scheme_component_status', 1);

            $builder2->whereIn('MSC.id', $components);
            $builder2->orderBy('MSC.scheme_component_name', 'ASC');
            $query = $builder2->get();

            if ($query->getNumRows() >= 1) {
                return $query->getResultArray();
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    function get_form_details_with_component_field($field_ids, $component_id)
    {
        $field_ids_string = implode(",", $field_ids);
        $sql = "
    SELECT 
        A.application_code,
        A.scheme_id,
        A.approved_status,
        A.save_status,
        A.component_id,
        A.created_date,
        B.scheme_name,
        C.status_text,
        CONCAT(
            '[', 
                GROUP_CONCAT(
                    CONCAT(
                        '{\"application_code\":\"', t1.application_code,
                        '\",\"field\":\"', t1.field,
                        '\",\"field_value\":\"', REPLACE(t1.field_value, '\"', '\\\"'), '\"}'
                    )
                ),
            ']'
        ) AS form_fields
        FROM 
            tbl_application AS A 
        INNER JOIN 
            mst_scheme AS B ON B.scheme_id = A.scheme_id
        LEFT JOIN 
            (SELECT 
                application_code, field,  CONVERT(field_value USING utf8) as field_value 
             FROM 
                tbl_form_fields_value 
             WHERE 
                field IN ($field_ids_string)
            ) AS t1 ON A.application_code = t1.application_code
        LEFT JOIN 
            mst_status AS C ON C.status_id = A.approved_status
        WHERE 
            A.approved_status = 3 
            AND A.save_status = 1 
            AND A.component_id IN ('$component_id')
        GROUP BY 
            A.application_code, 
            A.scheme_id,
            A.approved_status,
            A.save_status,
            A.component_id, 
            A.created_date, 
            B.scheme_name, 
            C.status_text
        ORDER BY 
            A.created_date DESC";
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    function drop_field_type_getCustomFieldsActive($component, $field_type = '')
    {
        $db1 = $this->db->table('tbl_form_fields as tff');
        $db1->select('tff.*,ms.scheme_name,msc.scheme_component_name, IFNULL((SELECT p.field_name FROM tbl_form_fields as p WHERE p.field_id = tff.parent), "No Parent") AS parent_name, mfft.field_type as field_type_name');
        $db1->join('mst_scheme as ms', 'ms.scheme_id = tff.scheme', 'INNER');
        $db1->join('mst_scheme_component as msc', 'msc.id = tff.component', 'INNER');
        $db1->join('mst_form_field_type as mfft', 'mfft.field_type_id = tff.field_type', 'INNER');
        $db1->where('tff.component', $component);
        $db1->where('tff.field_status', 1);
        $db1->whereNotIn('tff.field_type', $field_type);
        $query = $db1->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function update_exception_date()
    {
        $exception_date = $this->request->getPost('exception_date');
        if ($exception_date != '') {
            $exception_date = date('Y-m-d', strtotime($exception_date));
        }
        $data = array(
            'transcript_id' => $this->request->getPost('transcript_id'),
            'student_id'    => $this->request->getPost('student_id'),
            'application_code' => $this->request->getPost('app_code'),
            'application_id' => $this->request->getPost('app_id'),
            'exception_date' => $exception_date,
            'user_ip' => $_SERVER['REMOTE_ADDR'],
            'update_by' => $_SESSION['NAME_ID']
        );
        $query =  $this->db->table('log_completion_date_in_transcript')->insert($data);
        if ($query) {
            $data1['completion_date'] = $exception_date;
            $this->db->table('transcript')->where('Transcript_RowID', $this->request->getPost('transcript_id'))->update($data1);
        }
    }

    function checkAssignUserForm($component_id)
    {

        $db = Database::connect();

        $builder = $db->table('assign_user_form');
        $user_id = session()->get('USER_ID');
        $builder->where('user_id', $user_id);
        $builder->where('component_id', $component_id);
        $query = $builder->get();
        if ($query) {
            $array = $query->getRowArray();

            if ($array['approval_status'] == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getAppAdmin_byapplication_credit($status = '', $app_no = '', $credit = [], $access_components = '')
    {

        $builder = $this->db->table('tbl_application AS A')->distinct();
        $builder->select('A.*');
        $builder->where('A.approved_status', $status);
        $builder->where('A.save_status', 1);
        if (!empty($credit) && $credit != '') {
            $builder->join('tbl_form_fields_value as tff', 'tff.application_code = A.application_code', 'LEFT');
            $builder->whereIn('tff.field_value', array_filter($credit));
        }
        if ($app_no != '') {
            $builder->where('A.application_code', $app_no);
        }

        if ($access_components != '') {
            $builder->whereIn('A.component_id', $access_components);
        }


        $builder->orderBy('A.application_id', 'DESC');
        $query = $builder->get();


        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function check_drop_getCustomFieldsActive($component)
    {
        $data = '10,3,9';
        $data = explode(",", $data);
        $db1 = $this->db->table('tbl_form_fields as tff');
        $db1->select('tff.*,ms.scheme_name,msc.scheme_component_name, IFNULL((SELECT p.field_name FROM tbl_form_fields as p WHERE p.field_id = tff.parent), "No Parent") AS parent_name, mfft.field_type as field_type_name');
        $db1->join('mst_scheme as ms', 'ms.scheme_id = tff.scheme', 'INNER');
        $db1->join('mst_scheme_component as msc', 'msc.id = tff.component', 'INNER');
        $db1->join('mst_form_field_type as mfft', 'mfft.field_type_id = tff.field_type', 'INNER');
        $db1->where('tff.component', $component);
        $db1->where('tff.field_status', 1);
        $db1->whereIn('tff.field_type', $data);

        $query = $db1->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    public function delete_user_data()
    {
        $application = $this->request->getPost('application_code');
        $data = $this->db->table('tbl_application')->select('*')
            ->where('application_code', $application)
            ->get()
            ->getResultArray();


        foreach ($data as $dt) {
            $array_data = array(
                'application_code' => $dt['application_code'],
                'scheme_id'  => $dt['scheme_id'],
                'scheme_code' => $dt['scheme_code'],
                'component_id' => $dt['component_id'],
                'user_id'    => $dt['user_id'],
                'application_year' => $dt['application_year'],
                'created_by' => $dt['created_by'],
                'created_ip' => $dt['created_ip'],
                'created_date' => $dt['created_date'],
                'modified_by' => $dt['modified_by'],
                'modified_ip' => $dt['modified_ip'],
                'modified_date' => $dt['modified_date'],
                'created_admin' => $dt['created_admin'],
                'admin_id' => $dt['admin_id'],
                'status' => $dt['status'],
                'level' => $dt['level'],
                'save_status' => $dt['save_status'],
                'parent_app_id' => $dt['parent_app_id'],
                'installment' => $dt['installment'],
                'approved_status' => $dt['approved_status'],
                'sanction_status' => $dt['sanction_status'],
                'app_sanction' => $dt['app_sanction'],
                'deleted_by' => session()->get('NAME_ID'),
                'deleted_ip' => $this->request->getIPAddress()
            );
            $this->db->table('tbl_del_application')->insert($array_data);
        }
        $this->db->table('tbl_application')->where('application_code', $application)->delete();


        $data1 = $this->db->table('tbl_form_fields_value')->select('*')
            ->where('application_code', $application)
            ->get()
            ->getResultArray();
        foreach ($data1 as $dt1) {
            $array_data1 = array(
                'application_code' => $dt1['application_code'],
                'field' => $dt1['field'],
                'field_value' => $dt1['field_value'],
                'ffv_created_by' => $dt1['ffv_created_by'],
                'ffv_created_date' => $dt1['ffv_created_date'],
                'ffv_modified_by' => $dt1['ffv_modified_by'],
                'ffv_modified_date' => $dt1['ffv_modified_date'],
                'ffv_modified_ip' => $dt1['ffv_modified_ip'],
                'ffv_created_ip' => $dt1['ffv_created_ip'],
                'deleted_by' => session()->get('NAME_ID'),
                'deleted_ip' => $_SERVER['REMOTE_ADDR']
            );
            $this->db->table('tbl_del_form_fields_value')->insert($array_data1);
        }

        $this->db->table('tbl_form_fields_value')->where('application_code', $application)->delete();
    }

    function signApplicationForm()
    {

        $builder = $this->db->table('tbl_application_log');
        $builder1 = $this->db->table('tbl_application');

        $status = $this->request->getPost('status');
        if ($status == 'approve') {
            $status = 1;
            $application_id = encryptor('decrypt', $this->request->getPost('approve_application_id'));
            $application_code = encryptor('decrypt', $this->request->getPost('approve_application_code'));
            $component_id = encryptor('decrypt', $this->request->getPost('approve_component_id'));
            $data = [
                'application_id' => $application_id,
                'application_code' => $application_code,
                'ip' => $this->input->ip_address(),
                'action_by' => $this->session()->get('USER_ID'),
                'status' => $status,
                'component_id' => $component_id

            ];

            if ($builder->insert($data)) {
                $builder->where('application_id', $application_id);
                $builder->where('application_code', $application_code);
                if ($builder1->update(['admin_approved_status' => $status])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else if ($status == 'reject') {
            $status = 2;
            $application_id = encryptor('decrypt', $this->request->getPost('reject_application_id'));
            $application_code = encryptor('decrypt', $this->request->getPost('reject_application_code'));
            $component_id = encryptor('decrypt', $this->request->getPost('reject_component_id'));
            $reason = $this->request->getPost('reason');
            $data = [
                'application_id' => $application_id,
                'application_code' => $application_code,
                'ip' => $this->input->ip_address(),
                'action_by' => $this->session()->get('USER_ID'),
                'status' => $status,
                'component_id' => $component_id,
                'reason' => $reason,

            ];
            if ($builder->insert($data)) {
                $builder->where('application_id', $application_id);
                $builder->where('application_code', $application_code);
                if ($builder1->update(['admin_approved_status' => $status])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function get_category_application($application_code = '', $param = '')
    {
        return $this->db->table('tbl_form_fields_value')->select('field_value')
            ->WHERE(['application_code' => $application_code, 'field' => $param])
            ->get()
            ->getRowArray();
    }

    public function bulk_delete_user_data()
    {
        $application = $this->request->getPost('delete_id');
        // echo "<pre>";print_r($application);echo $sizeof($application);die;
        $data = $this->db->table('tbl_application')->select('*')
            ->whereIn('application_code', $this->request->getPost('delete_id'))
            ->get()
            ->getResultArray();


        foreach ($data as $dt) {
            $array_data = array(
                'application_code' => $dt['application_code'],
                'scheme_id'  => $dt['scheme_id'],
                'scheme_code' => $dt['scheme_code'],
                'component_id' => $dt['component_id'],
                'user_id'    => $dt['user_id'],
                'application_year' => $dt['application_year'],
                'created_by' => $dt['created_by'],
                'created_ip' => $dt['created_ip'],
                'created_date' => $dt['created_date'],
                'modified_by' => $dt['modified_by'],
                'modified_ip' => $dt['modified_ip'],
                'modified_date' => $dt['modified_date'],
                'created_admin' => $dt['created_admin'],
                'admin_id' => $dt['admin_id'],
                'status' => $dt['status'],
                'level' => $dt['level'],
                'save_status' => $dt['save_status'],
                'parent_app_id' => $dt['parent_app_id'],
                'installment' => $dt['installment'],
                'approved_status' => $dt['approved_status'],
                'sanction_status' => $dt['sanction_status'],
                'app_sanction' => $dt['app_sanction'],
                'deleted_by' => $this->session->get('NAME_ID'),
                'deleted_ip' => $_SERVER['REMOTE_ADDR']
            );
            $this->db->table('tbl_del_application')->insert($array_data);
        }

        /* for($i=0;$i<sizeof($application);$i++)
	           {*/
        $this->db->table('tbl_application')->whereIn('application_code', $application)->delete();
        /*}*/


        $data1 = $this->db->table('tbl_form_fields_value')->select('*')
            ->whereIn('application_code', $application)
            ->get()
            ->getResultArray();
        foreach ($data1 as $dt1) {
            $array_data1 = array(
                'application_code' => $dt1['application_code'],
                'field' => $dt1['field'],
                'field_value' => $dt1['field_value'],
                'ffv_created_by' => $dt1['ffv_created_by'],
                'ffv_created_date' => $dt1['ffv_created_date'],
                'ffv_modified_by' => $dt1['ffv_modified_by'],
                'ffv_modified_date' => $dt1['ffv_modified_date'],
                'ffv_modified_ip' => $dt1['ffv_modified_ip'],
                'ffv_created_ip' => $dt1['ffv_created_ip'],
                'deleted_by' => $this->session->get('NAME_ID'),
                'deleted_ip' => $_SERVER['REMOTE_ADDR']
            );
            $this->db->table('tbl_del_form_fields_value')->insert($array_data1);
        }
        $this->db->table('tbl_form_fields_value')->whereIn('application_code', $application)->delete();
    }


    public function bulk_restore_user_data()
    {
        $application = $this->request->getPost('delete_id');
        $data = $this->db->table('tbl_del_application')->select('*')
            ->whereIn('application_code', $application)
            ->get()
            ->getResultArray();


        foreach ($data as $dt) {
            $array_data = array(
                'application_code' => $dt['application_code'],
                'scheme_id'  => $dt['scheme_id'],
                'scheme_code' => $dt['scheme_code'],
                'component_id' => $dt['component_id'],
                'user_id'    => $dt['user_id'],
                'application_year' => $dt['application_year'],
                'created_by' => $dt['created_by'],
                'created_ip' => $dt['created_ip'],
                'created_date' => $dt['created_date'],
                'modified_by' => $dt['modified_by'],
                'modified_ip' => $dt['modified_ip'],
                'modified_date' => $dt['modified_date'],
                'created_admin' => $dt['created_admin'],
                'admin_id' => $dt['admin_id'],
                'status' => $dt['status'],
                'level' => $dt['level'],
                'save_status' => $dt['save_status'],
                'parent_app_id' => $dt['parent_app_id'],
                'installment' => $dt['installment'],
                'approved_status' => $dt['approved_status'],
                'sanction_status' => $dt['sanction_status'],
                'app_sanction' => $dt['app_sanction']
            );
            $this->db->table('tbl_application')->insert($array_data);
        }
        $this->db->table('tbl_del_application')->whereIn('application_code', $application)->delete();

        $data1 = $this->db->table('tbl_del_form_fields_value')->select('*')
            ->whereIn('application_code', $application)
            ->get()
            ->getResultArray();
        foreach ($data1 as $dt1) {
            $array_data1 = array(
                'application_code' => $dt1['application_code'],
                'field' => $dt1['field'],
                'field_value' => $dt1['field_value'],
                'ffv_created_by' => $dt1['ffv_created_by'],
                'ffv_created_date' => $dt1['ffv_created_date'],
                'ffv_modified_by' => $dt1['ffv_modified_by'],
                'ffv_modified_date' => $dt1['ffv_modified_date'],
                'ffv_modified_ip' => $dt1['ffv_modified_ip'],
                'ffv_created_ip' => $dt1['ffv_created_ip'],

            );
            $this->db->table('tbl_form_fields_value')->insert($array_data1);
        }

        $this->db->table('tbl_del_form_fields_value')->whereIn('application_code', $application)->delete();
    }

    function getDeleteAppAdmin($access_components, $status)
    {

        $builder = $this->db->table('tbl_del_application AS A');
        $builder->select('A.*, B.scheme_name, C.status_text');
        $builder->join('mst_scheme as B', 'B.scheme_id = A.scheme_id', 'INNER');
        $builder->join('mst_status as C', 'C.status_id = A.approved_status', 'LEFT');
        $builder->where('A.approved_status', $status);
        $builder->where('A.save_status', 1);
        if (is_array($access_components) && !empty($access_components)) {
            $builder->whereIn('A.component_id', $access_components);
        }
        $builder->orderBy('A.application_id', 'DESC');
        $query = $builder->get();

        //echo $builder->last_query();die;
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getDeletedCustomFieldValuescustom($application_code, $field)
    {

        $builder = $this->db->table('tbl_del_form_fields_value');
        $builder->select('*');
        $builder->where('application_code', $application_code);
        $builder->where('field', $field);
        $query = $builder->get();
        //echo $builder->last_query();die;
        //echo "<pre>";print_r($this->db->last_query());die;
        if ($query->getNumRows() >= 1) {
            $result =  $query->getResultArray();
            return $result[0];
        } else {
            return false;
        }
    }

    function get_componentbyID($component_id)
    {
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
        } else {
            return false;
        }
    }

    function getNameFieldsActive($component)
    {

        $builder = $this->db->table('tbl_form_fields as tff');

        $builder->select('tff.*,ms.scheme_name,msc.scheme_component_name, IFNULL((SELECT p.field_name FROM tbl_form_fields as p WHERE p.field_id = tff.parent), "No Parent") AS parent_name, mfft.field_type as field_type_name');
        $builder->join('mst_scheme as ms', 'ms.scheme_id = tff.scheme', 'INNER');
        $builder->join('mst_scheme_component as msc', 'msc.id = tff.component', 'INNER');
        $builder->join('mst_form_field_type as mfft', 'mfft.field_type_id = tff.field_type', 'INNER');
        $builder->where('tff.component', $component);
        $builder->where('tff.field_status', 1);
        $query = $builder->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }


    function getnameFieldValues($application_code, $field)
    {

        $builder = $this->db->table('tbl_form_fields_value');
        $builder->select('*');
        $builder->where(array('application_code' => $application_code, 'field' => $field));
        $query = $builder->get();
        //echo $this->db->last_query();die;
        //echo "<pre>";print_r($this->db->last_query());die;
        if ($query->getNumRows() >= 1) {
            $result =  $query->getResultArray();
            return $result[0];
        } else {
            return false;
        }
    }

    function getAppTransaction($access_components, $status)
    {

        $builder = $this->db->table('tbl_payment_transaction t1');
        $builder->select('t3.scheme_component_name,t1.component_id, t1.application_code, t1.transaction_id, t1.transaction_date, t1.user_ip,t3.scheme_id, transaction_amount,field_value_id,field_value');
        $builder->join('tbl_form_fields_value t2', 't2.application_code = t1.application_code');
        $builder->join('mst_scheme_component t3', 't3.id = t1.component_id');
        if (is_array($access_components) && !empty($access_components)) {
            $builder->whereIn('t1.component_id', $access_components);
        }
        $builder->where('field', '311');
        $query = $builder->get();

        //echo $builder->last_query();die;
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function check_linked_or_not($app_id)
    {
        return $this->db->table('tbl_application as A')->select('*')
            ->join('tbl_form_fields_value as fv', 'fv.application_code = A.application_code AND application_id = ' . $app_id)
            ->where('fv.field', '834')
            ->get()
            ->getResultArray();
    }

    function check_first_last_name_incomplete_form($name = '', $last_name = '')
    {
        $sql = "SELECT ID,FirstName,LastName FROM name where FirstName LIKE '%$name'  and LastName LIKE '%$last_name'";
        $db = Database::connect();
        $query = $db->query($sql);
        //echo $this->db->last_query(); die();
        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
        //return "Hello";

    }

    function check_name_incomplete_form2($name = '')
    {
        $name = explode(" ", trim($name));

        $sql = '';

        if (sizeof($name) < 3) {
            $firstName = $name[0] ?? '';   // ✅ Avoid undefined index
            $lastName  = $name[1] ?? '';   // ✅ Avoid undefined index

            $sql = "SELECT ID,FirstName,LastName FROM name 
                WHERE FirstName LIKE '%$firstName'  
                AND LastName LIKE '%$lastName'";
        } else {
            $firstName = $name[0] ?? '';
            $last_name = ($name[1] ?? '') . " " . ($name[2] ?? '');  // ✅ Avoid undefined index

            $sql = "SELECT ID,FirstName,LastName FROM name 
                WHERE FirstName LIKE '%$firstName' 
                AND LastName LIKE '$last_name%'";
        }

        $db = Database::connect();
        $query = $db->query($sql);

        if ($query->getNumRows() >= 1) {
            return $query->getRowArray();
        } else {
            return array();
        }
    }


    function updation_donation_student($app_id = '')
    {
        if ($app_id == '') {
            return false;
        } else {
            $data['user_id'] = $this->request->getPost('student_id');
            $this->db->table('tbl_application')->where('application_id', $app_id)->update($data);
            return true;
        }
    }

    function getLimitedCustomFieldsActive($component, $selected_field)
    {
        //$data = '10,3,9';
        //$data = explode(",",$data);
        $db1 = $this->db->table('tbl_form_fields as tff');
        $db1->select('tff.*,ms.scheme_name,msc.scheme_component_name, IFNULL((SELECT p.field_name FROM tbl_form_fields as p WHERE p.field_id = tff.parent), "No Parent") AS parent_name, mfft.field_type as field_type_name');
        $db1->join('mst_scheme as ms', 'ms.scheme_id = tff.scheme', 'INNER');
        $db1->join('mst_scheme_component as msc', 'msc.id = tff.component', 'INNER');
        $db1->join('mst_form_field_type as mfft', 'mfft.field_type_id = tff.field_type', 'INNER');
        $db1->where('tff.component', $component);
        $db1->where('tff.field_status', 1);
        $db1->whereIn('field_id', $selected_field);

        //$db1->where_in('tff.field_type', $data);

        $query = $db1->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getAppAdminpayments($access_components, $status)
    {

        $builder = $this->db->table('tbl_application AS A');
        $builder->distinct();
        $builder->select('A.*, B.scheme_name, C.status_text');
        $builder->join('mst_scheme as B', 'B.scheme_id = A.scheme_id', 'INNER');
        $builder->join('mst_status as C', 'C.status_id = A.approved_status', 'LEFT');
        $builder->join('`stag_apssfutu_umsdb_apr23`.`donations` AS d', 'd.application_id = A.application_id', 'LEFT');

        $builder->join('tbl_form_fields_value as fv', 'fv.application_code = A.application_code AND fv.field = 734');
        if ($this->request->getPost('mode') != '') {
            $search = "fv.field_value like '%" . $this->request->getPost('mode') . "%'";
            $builder->where($search);
        }
        if ($this->request->getPost('type') != '') {

            if ($this->request->getPost('type') == 1) {

                $sce = '((d.application_id IS NOT NULL OR d.application_id  != 0)OR (fv.field_value = "Other" AND field = 734))';
                $builder->where($sce);
                //$sec2 ='(fv.field_value = "Book Sale" AND field = 734)';
                //$this->db->or_where($sec2);
            } else if ($this->request->getPost('type') == 2) {
            } else {

                $sce = '(d.application_id IS NULL OR d.application_id = 0)';
                $builder->where($sce);
                $sec2 = '(fv.field_value != "Other" AND field = 734)';
                $builder->where($sec2);
            }
        } else {
            $sce = '(d.application_id IS NULL OR d.application_id = 0)';
            $builder->where($sce);
            $sec2 = '(fv.field_value != "Other" AND field = 734)';
            $builder->where($sec2);
        }
        $builder->where('A.approved_status', $status);
        $builder->where('A.save_status', 1);

        if (!is_array($access_components)) {
            $access_components = [$access_components];
        }

        $builder->whereIn('A.component_id', $access_components);
        $builder->orderBy('A.created_date', 'DESC');
        $query = $builder->get();

        //echo $this->formbuilder->db->last_query();die;
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }

    function getCustomFieldsActive($component)
    {
        //$data = '10,3,9';
        //$data = explode(",",$data);
        $db1 = $this->db->table('tbl_form_fields as tff');
        $db1->select('tff.*,ms.scheme_name,msc.scheme_component_name, IFNULL((SELECT p.field_name FROM tbl_form_fields as p WHERE p.field_id = tff.parent), "No Parent") AS parent_name, mfft.field_type as field_type_name');
        $db1->join('mst_scheme as ms', 'ms.scheme_id = tff.scheme', 'INNER');
        $db1->join('mst_scheme_component as msc', 'msc.id = tff.component', 'INNER');
        $db1->join('mst_form_field_type as mfft', 'mfft.field_type_id = tff.field_type', 'INNER');
        $db1->where('tff.component', $component);
        $db1->where('tff.field_status', 1);
        //$db1->where_in('tff.field_type', $data);

        $query = $db1->get();
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return array();
        }
    }

    function getCertAppAdminpayments($access_components, $status)
    {
        $builder = $this->db->table('tbl_application AS A');
        $builder->distinct();
        $builder->select('A.*, B.scheme_name, C.status_text');
        $builder->join('mst_scheme as B', 'B.scheme_id = A.scheme_id', 'INNER');
        $builder->join('mst_status as C', 'C.status_id = A.approved_status', 'LEFT');
        $builder->join('stag_apssfutu_umsdb_apr23.donations as d', 'd.application_id = A.application_id', 'LEFT');
        $builder->join('tbl_form_fields_value as fv', 'fv.application_code = A.application_code AND fv.field = 692');
        $sce = '(fv.field_value IS NOT NULL AND fv.field_value != 0)';
        $builder->where($sce);
        if ($this->request->getPost('mode') != '') {
            $search = "fv.field_value like '%" . $this->request->getPost('mode') . "%'";
            $builder->where($search);
        }
        if ($this->request->getPost('type') != '') {

            if ($this->request->getPost('type') == 1) {

                $sce = '((d.application_id IS NOT NULL OR d.application_id  != 0) OR (fv.field_value = "Other" AND field = 834))';
                $builder1 = $this->db->table('tbl_form_fields_value as fv1');
                $builder->where($sce);
                $get_other_data = $builder1->select('application_code')
                    ->where('fv1.field', 834)
                    ->get()
                    ->getResultArray();

                $get_other_data = array_column($get_other_data, 'application_code');

                if ($get_other_data) {
                    $builder->orWhereIn('A.application_code', $get_other_data);
                }
            } else if ($this->request->getPost('type') == 2) {
            } else {
                $sce = '(d.application_id IS NULL OR d.application_id = 0)';
                $builder->where($sce);
            }
        } else {
            $sce = '(d.application_id IS NULL OR d.application_id = 0)';
            $builder->where($sce);
            $get_other_data = $this->db->table('tbl_form_fields_value as fv1')->select('application_code')
                ->where('fv1.field', 834)
                ->get()
                ->getResultArray();

            $get_other_data = array_column($get_other_data, 'application_code');

            if ($get_other_data) {
                $builder->whereNotIn('A.application_code', $get_other_data);
            }
        }
        $builder->where('A.approved_status', $status);
        $builder->where('A.save_status', 1);

        if (!is_array($access_components)) {
            $access_components = [$access_components];
        }

        $builder->whereIn('A.component_id', $access_components);
        $builder->orderBy('A.created_date', 'DESC');
        $query = $builder->get();

        //echo $this->formbuilder->db->last_query();die;
        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }
}
