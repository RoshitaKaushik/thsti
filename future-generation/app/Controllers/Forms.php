<?php

namespace App\Controllers;
use App\Models\SchemeModel;

class Forms extends BaseController
{
    protected $Scheme_model;

    public function __construct()
    {
        $this->Scheme_model = new SchemeModel();
    }

    public function index()
    {
        //
    }

    function customForm($component_id){
		
		$component_id_en = $component_id;
		$component_id = encryptor('decrypt', $component_id);
		$data['component_details'] = $this->Scheme_model->getComponentWithFormModule($component_id);	
		$data['field_details'] = getCustomFieldsActive($component_id);			
		$data['component_id'] = $component_id_en;			
		$data['page'] = 'formview';
		$data['content']='frontend/addForm';		
		return view('frontend/index',$data);
	}
}
