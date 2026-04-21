<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;
use Google\Service\SQLAdmin\Resource\Connect;

class FormBuilderModel extends Model
{
	protected $db;

	public function __construct()
	{
		parent::__construct();
		$this->db = Database::connect('formbuilder');
	}

	function insertFormField($param)
	{
		$response = array();
		foreach ($param as $key => $val) {
			if ($key != 'field_name') {
				$data[$key] = test_input($val);
			} else {
				$data[$key] = $val;
			}
		}

		$query = $this->db->table('tbl_form_fields')->insert($data);
		if ($query) {
			$response['status'] = true;
			$response['msg'] = 'INSERTED';
		} else {
			$response['status'] = false;
			$response['msg'] = $this->db->error()['message'];
		}

		return $response;
	}

	// update 
	function updateFormField($param)
	{
		$response = array();
		foreach ($param as $key => $val) {
			if ($key != 'field_name') {
				$data[$key] = test_input($val);
			} else {
				$data[$key] = $val;
			}
		}

		$builder = $this->db->table('tbl_form_fields');
		$builder->where('field_id', $data['field_id']);
		$query = $builder->update($data);

		if ($query) {
			$response['status'] = true;
			$response['msg'] = 'UPDATED';
		} else {
			$response['status'] = false;
			$response['msg'] = $this->db->error()[''];
		}

		return $response;
	}

	function get_form_builder_module()
	{

		$builder = $this->db->table('tbl_form_builder_module');
		$builder->select('*');
		$builder->where('builder_module_status', 1);
		$query = $builder->get();
		if ($query->getNumRows() >= 1) {
			return $query->getResultArray();
		} else {
			return false;
		}
	}

	function getCustomFields($component)
	{

		$builder = $this->db->table('tbl_form_fields as tff');
		$builder->select('tff.*,ms.scheme_name,msc.scheme_component_name, IFNULL((SELECT p.field_name FROM tbl_form_fields as p WHERE p.field_id = tff.parent), "No Parent") AS parent_name, mfft.field_type as field_type_name');
		$builder->join('mst_scheme as ms', 'ms.scheme_id = tff.scheme', 'INNER');
		$builder->join('mst_scheme_component as msc', 'msc.id = tff.component', 'INNER');
		$builder->join('mst_form_field_type as mfft', 'mfft.field_type_id = tff.field_type', 'INNER');
		$builder->where('tff.component', $component);
		$query = $builder->get();
		if ($query->getNumRows() >= 1) {
			return $query->getResultArray();
		} else {
			return array();
		}
	}

	function getCustomFieldsActive($component)
	{

		$builder = $this->db->table('tbl_form_fields as tff');
		$builder->select('tff.*,ms.scheme_name,msc.scheme_component_name, IFNULL((SELECT p.field_name FROM tbl_form_fields as p WHERE p.field_id = tff.parent), "No Parent") AS parent_name, mfft.field_type as field_type_name');
		$builder->join('mst_scheme as ms', 'ms.scheme_id = tff.scheme', 'INNER');
		$builder->join('mst_scheme_component as msc', 'msc.id = tff.component', 'INNER');
		$builder->join('mst_form_field_type as mfft', 'mfft.field_type_id = tff.field_type', 'INNER');
		$builder->where('tff.component', $component);
		$builder->where('tff.field_status', 1);
		$builder->orderBy('tff.display_order', 'ASC');
		$query = $builder->get();
		if ($query->getNumRows() >= 1) {
			return $query->getResultArray();
		} else {
			return array();
		}
	}


	function getApplicationRecord($application_id){
		
		$builder = $this->db->table('tbl_application as A');
		$builder->select('A.*,usr.user_image,usr.user_signature');
		$builder->join('user_login as usr', 'usr.user_id = A.user_id', 'LEFT');
		$builder->where('A.application_id', $application_id);
		$query = $builder->get();
		
		//echo $this->db->last_query();die;
		if($query->getNumRows() >= 1){
			return $query->getResultArray();
		}
		else{ 
			return false;
		}
		
	}


	function getAppRecord($application_code)
	{

		$builder = $this->db->table('tbl_application as A');
		$builder->select('A.*,usr.user_image,usr.user_signature');
		$builder->join('user_login as usr', 'usr.user_id = A.user_id', 'LEFT');
		$builder->where('A.application_code', $application_code);
		$query = $builder->get();

		//echo $builder->last_query();die;
		if ($query->getNumRows() >= 1) {
			return $query->getResultArray();
		} else {
			return array();
		}
	}

	function saveCustomFieldValue($param)
	{

		$response = array();
		foreach ($param as $key => $val) {
			$data[$key] = test_input($val);
		}
		$builder = $this->db->table('tbl_form_fields_value');
		$builder->select('*');
		$builder->where('application_code', $data['application_code']);
		$builder->where('field', $data['field']);
		$query = $builder->get();

		if ($query->getNumRows() == 0) {

			$query1 = $builder->insert('tbl_form_fields_value', $data);
			if ($query1) {
				$response['status'] = true;
				$response['msg'] = 'INSERTED';
			} else {
				$response['status'] = false;
				$response['msg'] = $this->db->error()['message'];
			}
		} else {

			$builder->where('application_code', $data['application_code']);
			$builder->where('field', $data['field']);
			$query2 = $builder->update('tbl_form_fields_value', $data);

			if ($query2) {
				$response['status'] = true;
				$response['msg'] = 'UPDATED';
			} else {
				$response['status'] = false;
				$response['msg'] = $this->db->error()['message'];
			}
		}

		return $response;
	}


	function getCustomFieldValues($application_code, $field)
	{

		$builder = $this->db->table('tbl_form_fields_value');
		$builder->select('*');
		$builder->where(array('application_code' => $application_code, 'field' => $field));
		$query = $builder->get();
		//echo $builder->last_query();die;
		//echo "<pre>";print_r($builder->last_query());die;
		if ($query->getNumRows() >= 1) {
			$result =  $query->getResultArray();
			return $result[0];
		} else {
			return false;
		}
	}

	function getCustomFieldValuescustom($application_code, $field)
	{

		// $builder = $this->db->table('tbl_form_fields_value');
		$builder = $this->db->table('tbl_form_fields_value');
		$builder->select('*');
		$builder->where('application_code', $application_code);
		$builder->where('field', $field);
		$query = $builder->get();
		if ($query->getNumRows() >= 1) {
			$result =  $query->getResultArray();
			return $result[0];
		} else {
			return false;
		}
	}


	function getAllCustomFields($component)
	{

		$builder = $this->db->table('tbl_form_fields as tff');
		$builder->select('tff.*,ms.scheme_name,msc.scheme_component_name, IFNULL((SELECT p.field_name FROM tbl_form_fields as p WHERE p.field_id = tff.parent), "No Parent") AS parent_name, mfft.field_type as field_type_name');
		$builder->join('mst_scheme as ms', 'ms.scheme_id = tff.scheme', 'INNER');
		$builder->join('mst_scheme_component as msc', 'msc.id = tff.component', 'INNER');
		$builder->join('mst_form_field_type as mfft', 'mfft.field_type_id = tff.field_type', 'INNER');
		$builder->where('tff.component', $component);
		$builder->where('tff.field_status', 1);
		$builder->orderBy('tff.display_order', 'ASC');
		$query = $builder->get();
		if ($query->getNumRows() >= 1) {
			return $query->getResultArray();
		} else {
			return array();
		}
	}
}
