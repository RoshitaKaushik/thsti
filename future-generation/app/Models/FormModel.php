<?php

namespace App\Models;

use CodeIgniter\Model;

class FormModel extends Model
{
    function insertApplication($param){
		
		
		$data = array();
		$response = array();
		foreach($param as $key => $val){			
			$data[$key] = test_input($val);						
		}
		$query = $this->db->table('tbl_arjun_award')->insert($data);	

        
		if($query){
			$response['status'] = true;
			$response['msg'] = 'INSERTED';
		}else{			
			$response['status'] = false;
			$response['msg'] = $this->db->error()['message'];
		}
		
		return $response;
	
	}  

	// get application record from database  
	
		function getApplicationRecord($application_id){
			
            $builder = $this->db->table('tbl_application as A');
			$builder->select('A.*,B.*,aa.*,usr.user_signature,mst.country_name');
			$builder->where('application_id', $application_id);
			$builder->join('tbl_beneficiary as B', 'B.application_code = A.application_code', 'INNER');
			$builder->join('tbl_arjun_award as aa', 'aa.application_code = A.application_code', 'LEFT');
			$builder->join('user_login as usr', 'usr.user_id = A.user_id', 'LEFT');
			$builder->join('mst_country mst','B.nationality_other_country=mst.id','LEFT');
			$query = $builder->get();
		 	if($query->getNumRows() >= 1){
				return $query->getResultArray();
			 }
			else{ 
				return false;
			}
		} 
	
		// update into beneficiary table
	    function updateApplication($params){
	 	$data = array();
        $response = array();
		foreach($params as $key => $val){			
			$data[$key] = test_input($val);						
		}

        $builder = $this->db->table('tbl_arjun_award');
		$builder->where(array('award_id' => $data['award_id'], 'user_unique_id' => $data['user_unique_id']));
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
}
