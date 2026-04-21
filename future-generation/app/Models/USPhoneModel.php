<?php

namespace App\Models;

use CodeIgniter\Model;

class USPhoneModel extends Model
{
    function usPhoneRecord($Type) {

    $builder = $this->db->table('name');
     $builder->select("ID, HomePhone, MainPhone, WorkPhone, MobilePhone, OtherPhone");
		if($Type == 1){
		$builder->where("HomePhone IS NOT NULL");
		$builder->where("HomePhone != '0000000000'");
		$builder->where("HomePhone !=  ' '");
		
		}
		elseif($Type == 2){
		$builder->where("MainPhone IS NOT NULL");
		$builder->where("MainPhone != 0000000000");
		$builder->where("MainPhone !=  ' '");
		
		}
		elseif($Type == 3){
		$builder->where("WorkPhone IS NOT NULL");
		$builder->where("WorkPhone != 0000000000");
		$builder->where("WorkPhone !=  ' '");
		
		}
		elseif($Type == 4){
		$builder->where("MobilePhone IS NOT NULL");
		$builder->where("MobilePhone != 0000000000");
		$builder->where("MobilePhone !=  ' '");
		
		}
		elseif($Type == 5){
		$builder->where("OtherPhone IS NOT NULL");
		$builder->where("OtherPhone != 0000000000");
		$builder->where("OtherPhone !=  ''");
	
		}
  	    $query = $builder->get();	
		$result= $query->getResultArray();
        return $result;
    }
	
	//update data function
	
	function updateRecord($PhoneType,$val,$cur_id)
	{
        $builder = $this->db->table('USPhone');
	    if($PhoneType==1)
		{
			$data = array(
    			'Id' => $val['ID'],
    			'Type' => 'Cell',
    			'Number' => $val['HomePhone'],
    			'Active' =>'1',
    			'createdon'=>date('Y-m-d h:m:i')
			);
			$builder->where('autoId',$cur_id);
			$builder->update($data); 
		}
		
		if($PhoneType==2)
		{
			$data = array(
    			'Id' => $val['ID'],
    			'Type' => 'Main',
    			'Number' => $val['HomePhone'],
    			'Active' =>'1',
    			'createdon'=>date('Y-m-d h:m:i')
			);
			$builder->where('autoId',$cur_id);
			$builder->update('USPhone', $data); 
		}
		if($PhoneType==3)
		{
			$data = array(
    			'Id' => $val['ID'],
    			'Type' => 'Work',
    			'Number' => $val['HomePhone'],
    			'Active' =>'1',
    			'createdon'=>date('Y-m-d h:m:i')
			);
			$builder->where('autoId',$cur_id);
			$builder->update('USPhone', $data); 
		}
		if($PhoneType==4)
		{
			$data = array(
    			'Id' => $val['ID'],
    			'Type' => 'Mobile',
    			'Number' => $val['HomePhone'],
    			'Active' =>'1',
    			'createdon'=>date('Y-m-d h:m:i')
			);
			$builder->where('autoId',$cur_id);
			$builder->update('USPhone', $data); 
		}
		if($PhoneType==5)
		{
			$data = array(
    			'Id' => $val['ID'],
    			'Type' => 'Other',
    			'Number' => $val['HomePhone'],
    			'Active' =>'1',
    			'createdon'=>date('Y-m-d h:m:i')
			);
			$builder->where('autoId',$cur_id);
			$builder->update('USPhone', $data); 
		}
		
	
	}
	
	
	//insert data function
	
	function insertRecord($PhoneType,$val) 
	{
        $builder = $this->db->table('USPhone');
		if($PhoneType==1)
		{
			$data = array(
    			'Id' => $val['ID'],
    			'Type' => 'Cell',
    			'Number' => $val['HomePhone'],
    			'Active' =>'1',
    			'createdon'=>date('Y-m-d h:m:i')
			);
			$builder->insert($data); 
		}
		if($PhoneType==2)
		{
			$data = array(
    			'Id' => $val['ID'],
    			'Type' => 'Main',
    			'Number' => $val['MainPhone'],
    			'Active' =>'1',
    			'createdon'=>date('Y-m-d h:m:i')
			);
			$builder->insert($data); 
		}
		if($PhoneType==3)
		{
			$data = array(
    			'Id' => $val['ID'],
    			'Type' => 'Work',
    			'Number' => $val['WorkPhone'],
    			'Active' =>'1',
    			'createdon'=>date('Y-m-d h:m:i')
			);
			$builder->insert($data); 
		}
		if($PhoneType==4)
		{
			$data = array(
    			'Id' => $val['ID'],
    			'Type' => 'Mobile',
    			'Number' => $val['MobilePhone'],
    			'Active' =>'1',
    			'createdon'=>date('Y-m-d h:m:i')
			);
			$builder->insert($data); 
		}
		if($PhoneType==5)
		{
			$data = array(
    			'Id' => $val['ID'],
    			'Type' => 'Other',
    			'Number' => $val['OtherPhone'],
    			'Active' =>'1',
    			'createdon'=>date('Y-m-d h:m:i')
			);
			$builder->insert($data); 
		}
	}
}
