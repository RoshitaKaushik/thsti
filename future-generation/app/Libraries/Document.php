<?php

namespace App\Libraries;

class Document{
	
	function create_folder($folder,$user_id){
		$response = false;
		$user_id_encypt = encryptor('encrypt', $user_id);
			
		//$basepath = 'documents/'.$folder.'/'.$user_id_encypt;
		$basepath = 'docs';
		$basepathwithdate = $basepath.'/'.docdate();

		$folderPath = FCPATH.$basepath;

				
		if(!file_exists($folderPath)){
			//if(mkdir($folderPath)){
			if(mkdir($folderPath,0777, true)){
				$response = true;
			}				                           
		}else{
			$response = true;
		}

		return $response;
	}
	
	function create_any_folder($folder){
		$response = false;			
		$folderPath = FCPATH.$folder;
				
		if(!file_exists($folderPath)){
			
			if(mkdir($folderPath, 0777, true)){
				$response = true;
			}else{
				$response = false;
			}				                           
		}else{
			$response = true;
		}

		return $response;
	} 
	
	
	function create_doc_path($components){
		$result = array();
		$user_id_encypt = encryptor('encrypt', $components['user_id']);
		//$basepath = 'docs/'.$components['folder'].'/'.$user_id_encypt;
		$basepath = 'docs/'.$components['folder'];
								   
		$doc_name = $basepath. '/' .$components['key'].$components['count'].'_'.docdate().'_'.$components['doc_name'];
		$doc_path = FCPATH . $doc_name;

		
		
		if(move_uploaded_file($components['tmp_file'], $doc_path)){			
			$result['status'] = 1;
			$result['doc_name'] = $doc_name;
		}else{
			$result['status'] = 2;
			$result['doc_name'] = '';
		}
		
		return $result;
								
	}
	
	
	function validate_form_doc($file,$scheme,$user_id){
		
		$responce['status'] = true;
		$responce['mesg'] = '';
		$msg = '';
		$flag = 1;       // 1 for true 2 for false
		
		$fun_name = 'getDocLabel'.$scheme;
		foreach($file['name'] as $key => $array_string){
			
			//Type of files 
			if($file['docreq'][$key][2] == 'pdf'){
				$validextensions = array("PDF", "pdf");
			}elseif($file['docreq'][$key][2] == 'img'){
				$validextensions = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG");
			}
			
			$doc_field_name = $key;
			
			if(!is_array($array_string)){
				
				
				if(method_exists('Document', $fun_name)){					
					$getDocLabel = $this->$fun_name($doc_field_name);					
				}else{ 
					$getDocLabel = 'Document ';
				}
				
				
				if($array_string == ''){			
					if($file['docreq'][$key][1] == 1){
						$msg .= $getDocLabel." file must be uploaded <br>";
						$flag = 2; 
					}
				}else{
					
					$temporary = explode(".", $file["name"][$key]);
					$file_extension = end($temporary);
					if(!in_array($file_extension, $validextensions)){
						$msg .= $getDocLabel. " File Type is not ".$file['docreq'][$key][2].". Please upload the ".$file['docreq'][$key][2]." file.<br>";
						$flag = 2;	
					}
					
					$filePart = explode('.',$file["name"][$key]);
					
					if( count($filePart) > 2 ){ 
						$msg = $getDocLabel. " has Invalid File Name.Remove extra dots from file name";
						$flag = 2;	
					}
					
					if(preg_match('/[^a-z0-9 _-]+/i',  $filePart[0])) {
						
						$msg = $getDocLabel. " has Invalid File Name.";
						$flag = 2;	
					}
					
					if($file['docreq'][$key][2] == 'pdf'){
						if($file["size"][$key] > 5242880){ //Approx. 5MB 
							$msg .= $getDocLabel. " File Size is greater than 5MB! Please upload file size less than 5MB <br>";
							$flag = 2;								
						}
						
					}elseif($file['docreq'][$key][2] == 'img'){
						if($file["size"][$key] > 250000){ //Approx. 250KB 
							$msg .= $getDocLabel. " File Size is greater than 250KB! Please upload file size less than 250KB <br>";
							$flag = 2;								
						}
					}							
				}	
			}else{
				
				$array_len = sizeof($array_string);
				     for($i=1;$i<=$array_len;$i++){
				    	$docname = $file["name"][$key][$i];
						
						if(function_exists($fun_name)){
							$getDocLabel = $this->$fun_name($doc_field_name);
						}else{
							$getDocLabel = 'Document ';
						}
											
					if($docname == ''){			
						if($file['docreq'][$key][1] == 1){
							$msg .= $getDocLabel." file must be uploaded <br>";
							$flag = 2; 
						}
					}else{
						
						$temporary = explode(".", $file["name"][$key][$i]);
						$file_extension = end($temporary);
						if(!in_array($file_extension, $validextensions)){
							$msg .= $getDocLabel." file Type is not ".$file['docreq'][$key][2].". Please upload the ".$file['docreq'][$key][2]." file.<br>";
							$flag = 2;	
						}
						
						$filePart = explode('.',$file["name"][$key][$i]);
						
						if( count($filePart) > 2 ){ 
							$msg = $getDocLabel. " has Invalid File Name.Remove extra dots from file name";
							$flag = 2;	
						}
						if(preg_match('/[^a-z0-9 _-]+/i',  $filePart[0])) {						
							
							$msg = $getDocLabel. " has Invalid File Name.";
							$flag = 2;	
						}
						
						if($file["size"][$key][$i] > 5242880){ //Approx. 5MB 
							$msg .= $getDocLabel." file Size is greater than 5MB! Please upload file size less than 5MB <br>";
							$flag = 2;								
						}
						
						if($file['docreq'][$key][2] == 'pdf'){
							if($file["size"][$key][$i] > 5242880){ //Approx. 5MB 
									$msg .= $getDocLabel. " File Size is greater than 5MB! Please upload file size less than 5MB <br>";
								$flag = 2;								
							}
							
						}elseif($file['docreq'][$key][2] == 'img'){
							if($file["size"][$key][$i] > 250000){ //Approx. 250KB 
								$msg .= $getDocLabel. " File Size is greater than 250KB! Please upload file size less than 250KB <br>";
								$flag = 2;								
							}
						}
									
					}
				}
			}		
		}
		
		$doc_new_array = array();
		$folder = strtolower($scheme);
		if($flag == 1){
			if($this->create_folder($folder, $user_id)){
				
				foreach($file['tmp_name'] as $key => $doctemp) {

					$count = 0;
					if(!is_array($doctemp)){
						$count++;
						$components['folder'] = $folder;
						$components['doc_name'] = $file['name'][$key];
						$components['user_id'] = $user_id;
						$components['count'] = $count;
						$components['key'] = $key;
						$components['tmp_file'] = $doctemp;
						
						$path_result = $this->create_doc_path($components);
						if($path_result['status'] = 1){
							$doc_new_array[$key][] = $path_result['doc_name'];							
						}else{
							$responce['status'] = 'false';
							$msg .= 'File not uploaded.<br>';	
							$responce['mesg'] = $msg;
						}
					}else{
						
						foreach($doctemp as $dkey => $dt) {
							$count++;	
							if(!empty($dt)) {
								
								$components['folder'] = $folder;
								$components['doc_name'] = $file['name'][$key][$count];
								$components['user_id'] = $user_id;
								$components['count'] = $count;
								$components['key'] = $key;
								$components['tmp_file'] = $dt;
								
								$path_result = $this->create_doc_path($components);
								if($path_result['status'] = 1){
									$doc_new_array[$key][$dkey] = $path_result['doc_name'];							
								}else{
									$responce['status'] = 'false';
									$msg .= 'File not uploaded.<br>';	
									$responce['mesg'] = $msg;	
								}
							}
															
						}
					}
					
				}
			}else{
				$responce['status'] = 'false';
				$msg .= 'Server not give permission to create a folder.<br>';	
				$responce['mesg'] = $msg;	
			}
		}else{
			$responce['status'] = 'false';
			$responce['mesg'] = $msg;
		}
		
		$responce['doc_new_array'] = $doc_new_array;

		//echo "<pre>";print_r($responce);die;
		return $responce;
	}
	
		
	function getDocLabelNsdf($string){

		switch($string){
			
			case($string == 'academic_doc'):
				$label = 'Educational/Professional qualifications';
				break;
			case($string == 'experiance_doc'):
				$label = 'Employment details';
				break;
			case($string == 'assistance_document'):
				$label = 'Income/financial assistance from different sources';
				break;
			case($string == 'p_assistance_document'):
				$label = 'Past assistance from NSDF and other sources for training';
				break;
			case($string == 'training_proposal_doc'):
				$label = 'Details of the proposed training';
				break;
			case($string == 'invoice_doc'):
				$label = 'Invoice from the Institute/Coach giving item wise expenses';
				break;
			case($string == 'agreement_doc'):
				$label = 'If there is an agreement with the Institute/Coach, a copy of the same';
				break;
			case($string == 'purchase_process_doc'):
				$label = 'Process of purchase/procurement';
				break;
			case($string == 'p_assistance_document'):
				$label = 'Achievements in last five years';
				break;
			case($string == 'legal_formalities_doc'):
				$label = 'Legal formalities';
				break; 
			case($string == 'deposit_agreement_doc'):
				$label = '2.7 (f)';
				break;
			case($string == 'money_utilized_doc'):
				$label = '2.9 Affidavit';
				break;
			case($string == 'injury_doc'):
				$label = '2.8';
				break;
			
			
			default:
			$label = 'some documents';
		}
		
		return $label;
	}
	
	
	
	
	function getDocLabelHrds($string){

		switch($string){
			
			case($string == 'salary_slip'):
				$label = 'Last Month Salary Slip';
				break;
			case($string == 'objection_certificate'):
				$label = 'No objection certificate from employer';
				break;
			case($string == 'pancard_doc'):
				$label = 'Pancard Attachment';
				break;
			case($string == 'aadhar_doc'):
				$label = 'Aadhar Attachment';
				break;
			case($string == 'academic_doc'):
				$label = 'Academic Details';
				break;
			case($string == 'experiance_doc'):
				$label = 'Work Experience';
				break;
			case($string == 'training_doc'):
				$label = 'Professional Training';
				break;
			case($string == 'p_assistance_doc'):
				$label = 'Fellowship/Scholarship/Sponsorship in the past';
				break;
			case($string == 'passport_doc'):
				$label = ' Passport Attachment';
				break;
			case($string == 'c_assistance_doc'):
				$label = 'Details of financial assistance received from other sources';
				break; 
			case($string == 'course_doc'):
				$label = 'Attachment';
				break;
			case($string == 'admission_letter'):
				$label = 'Admission letter';
				break;
			case($string == 'completion_doc'):
				$label = '16. (b) Document';
				break;
			case($string == 'relevant_doc'):
				$label = '17. Any Relevant document/ Information';
				break;
			
	  		default:
			$label = 'some documents';
		}
		
		return $label;
	}
	
	//get research details
	
	function getDocLabelHrds_Research($string)
	{
	        switch($string){
			
			case($string == 'salary_doc'):
				$label = 'Last Month Salary Slip';
				break;
			
			case($string == 'pancard_doc'):
				$label = 'Pancard Attachment';
				break;
			case($string == 'aadhar_doc'):
				$label = 'Aadhar Attachment';
				break;
			case($string == 'academic_doc'):
				$label = 'Academic Details';
				break;
			case($string == 'experiance_doc'):
				$label = 'Work Experience';
				break;
			case($string == 'training_doc'):
				$label = 'Professional Training';
				break;
			case($string == 'assistance_doc'):
				$label = 'Fellowship/Scholarship/Sponsorship in the past';
				break;
			case($string == 'passport_doc'):
				$label = ' Passport Attachment';
				break;
			
			case($string == 'course_doc'):
				$label = 'Attachment';
				break;
			case($string == 'admission_letter'):
				$label = 'Admission letter';
				break;
			case($string == 'completion_doc'):
				$label = 'Document';
				break;
			case($string == 'relevant_doc'):
				$label = 'Any Relevant document/ Information';
				break;
			
	  		default:
			$label = 'some documents';
		}
		
		return $label;	
		
	}
	//get research details
	function getDocLabelHrds_Fellowship($string){

		switch($string){
			
			case($string == 'salary_slip'):
				$label = 'Last Month Salary Slip';
				break;
			case($string == 'objection_certificate'):
				$label = 'No objection certificate from employer';
				break;
			case($string == 'pancard_doc'):
				$label = 'Pancard Attachment';
				break;
			case($string == 'aadhar_doc'):
				$label = 'Aadhar Attachment';
				break;
			case($string == 'user_image'):
				$label = 'Upload Image';
				break;
			case($string == 'user_signature'):
				$label = 'Upload User Signature';
				break;
			case($string == 'academic_doc'):
				$label = 'Academic Details';
				break;
			case($string == 'experiance_doc'):
				$label = 'Work Experience';
				break;
			case($string == 'training_doc'):
				$label = 'Professional Training';
				break;
			case($string == 'p_assistance_doc'):
				$label = 'Fellowship/Scholarship/Sponsorship in the past';
				break;
			case($string == 'passport_doc'):
				$label = ' Passport Attachment';
				break;
			case($string == 'c_assistance_doc'):
				$label = 'Details of financial assistance received from other sources';
				break; 
			case($string == 'course_doc'):
				$label = 'Attachment';
				break;
			case($string == 'admission_letter'):
				$label = 'Admission letter';
				break;
			case($string == 'completion_doc'):
				$label = '17. (b) Document';
				break;
				
			case($string == 'declaration_doc'):
			   $label = '19. Document';
				break;
			case($string == 'relevant_doc'):
				$label = '17. Any Relevant document/ Information';
				break;
			
	  		default:
			$label = 'some documents';
			
		}
		
		return $label;
	}
	
	//get SpecializedTraining details
	
	function getDocLabelHrds_SpecializedTraining($string){

		switch($string){
			
			case($string == 'salary_slip'):
				$label = 'Last Month Salary Slip';
				break;
			case($string == 'objection_certificate'):
				$label = 'No objection certificate from employer';
				break;
			case($string == 'pancard_doc'):
				$label = 'Pancard Attachment';
				break;
			case($string == 'prospectus_doc'):
				$label = 'prospectus Attachment';
				break;
			case($string == 'aadhar_doc'):
				$label = 'Aadhar Attachment';
				break;
			case($string == 'academic_doc'):
				$label = 'Academic Details';
				break;
			case($string == 'passport_doc'):
				$label = ' Passport Attachment';
				break;
			case($string == 'c_assistance_doc'):
				$label = 'Details of financial assistance received from other sources';
				break; 
			case($string == 'course_doc'):
				$label = 'Attachment';
				break;
			case($string == 'relevant_doc'):
				$label = '17. Any Relevant document/ Information';
				break;
			
	  		default:
			$label = 'some documents';
		}
		
		return $label;
	}
	
	// document label of Participation Oversease
	
	  function getDocLabelHrds_Participation($string){
		switch($string){
			
			case($string == 'pancard_doc'):
				$label = ' Pancard Attachment';
				break;
			case($string == 'aadhar_doc'):
				$label = 'Aadhar Attachment';
				break;
			case($string == 'salary_doc'):
				$label = 'Last Month Salary Slip';
				break;
			case($string == 'objection_certificate_doc'):
				$label = 'No objection certificate from employer';
				break;
			case($string == 'academic_doc'):
				$label = 'Academic Details';
				break;
			case($string == 'invitation_doc'):
				$label = '(Copy of invitation letter, synopsis of the key-note address/research paper, wherever applicable, may be attached)';
				break;
			case($string == 'participant_doc'):
				$label = 'Likely benefits from participation';
				break;
		 	case($string == 'relevant_doc'):
				$label = 'Any Relevant document/ Information';
				break;
			
	  		default:
			$label = 'some documents';
		}
		
		return $label;
	}
	
	// get document label of HRDS Participation Overseas In India
	
	function getDocLabelHrds_Participation_India($string){
		switch($string){
			
			case($string == 'pancard_doc'):
				$label = ' Pancard Attachment';
				break;
			case($string == 'aadhar_doc'):
				$label = 'Aadhar Attachment';
				break;
			case($string == 'salary_doc'):
				$label = 'Last Month Salary Slip';
				break;
			case($string == 'objection_certificate_doc'):
				$label = 'No objection certificate from employer';
				break;
			case($string == 'academic_doc'):
				$label = 'Academic Details';
				break;
			case($string == 'invitation_doc'):
				$label = '(Copy of invitation letter, synopsis of the key-note address/research paper, wherever applicable, may be attached)';
				break;
			case($string == 'participant_doc'):
				$label = 'Likely benefits from participation';
				break;
		 	case($string == 'relevant_doc'):
				$label = 'Any Relevant document/ Information';
				break;
			
	  		default:
			$label = 'some documents';
		}
		
		return $label;
	}
	
	
	// get document lable of HRDS Holding Country.
	
	function getDocLabelHrds_HoldingCountry($string){
		switch($string){
			
			case($string == 'pancard_doc'):
				$label = ' Pancard Attachment';
				break;
			case($string == 'aadhar_doc'):
				$label = 'Aadhar Attachment';
				break;
			case($string == 'salary_doc'):
				$label = 'Last Month Salary Slip';
				break;
			case($string == 'objection_certificate_doc'):
				$label = 'No objection certificate from employer';
				break;
			case($string == 'academic_doc'):
				$label = 'Academic Details';
				break;
			case($string == 'invitation_doc'):
				$label = '(Copy of invitation letter, synopsis of the key-note address/research paper, wherever applicable, may be attached)';
				break;
			case($string == 'participant_doc'):
				$label = 'Likely benefits from participation';
				break;
		 	case($string == 'relevant_doc'):
				$label = 'Any Relevant document/ Information';
				break;
			
	  		default:
			$label = 'some documents';
		}
		
		return $label;
	}
	
	
	
	
	// GET DOCUMENT LABEL OF HRDS PUBLICATIONS
	   function getDocLabelHrds_Publication($string){
		   switch($string){
			
			case($string == 'pancard_doc'):
				$label = ' Pancard Attachment';
				break;
			case($string == 'aadhar_doc'):
				$label = 'Aadhar Attachment';
				break;
			case($string == 'assistance_doc'):
				$label = 'Source(s) from which the balance of expenditure would be met';
				break;
			case($string == 'purpose_pub_doc'):
				$label = 'If any grant has been received or request thereof made other bodies, e.g. University, Central/State Government/local bodies quasi-Government Institutions/private institution for the purpose of publication, please provide the decision of those bodies';
				break;
			case($string == 'turnover_doc'):
				$label = 'Annual Turnover as per audited accounts in Rs. (Last 3 years) enclose copy';
				break;
			case($string == 'publication_doc'):
				$label = 'Publications nominated/won recognition/awards (if any)';
				break;
			case($string == 'relevent_doc'):
				$label = 'Any Relevant document/Information';
				break;
			default:
			$label = 'some documents';
		}
		
		return $label;
	}
	
	
	
	function getDocLabelProflie($string){

		switch($string){
				case($string == 'profile_image'):
				$label = 'Upload User Image';
				break;
			
			 default:
			$label = 'some documents';
		}
		
		return $label;
	}
	
	function getDocLabelnwf($string){

		switch($string){
			
			case($string == 'pancard_doc'):
				$label = 'Pancard Attachment';
				break;
			case($string == 'aadhar_doc'):
				$label = 'Aadhar Attachment';
				break;
			case($string == 'Upload Image'):
				$label = 'Aadhar Attachment';
				break;
			case($string == 'supp_doc'):
				$label = 'Supporting Document';
				break;
			case($string == 'circumstances_purpose_doc'):
				$label = 'Circumstances and purpose for which financial assistance is required';
				break;
			case($string == 'financial_assistance_doc '):
				$label = 'Quantum of financial assistance desired';
				break;
			case($string == 'immovable_assets_doc'):
				$label = 'Details of immovable assets including bank balance ets. of the applicant and income if any ,drived from these assets';
				break;
			case($string == 'annual_income_doc'):
				$label = 'Annual income of the applicant from all Sources';
				break;				
			case($string == 'assistance_other_resourse_doc'):
				$label = 'Whether assistance has also been obtained for this purpose from any other sources? if so, give details including the quantum of assistance recevied ';
				break;
			case($string == 'relevant_information_doc'):
				$label = 'Any other relevant information';
				break;
			case($string == 'declaration_doc'):
				$label = 'Declaration ';
				break;
			default:
			
			$label = 'some documents';
		}
		
		return $label;
	}
	
	// get doc label for rgkra
	
	function getDocLabelrgkra($string){

		switch($string){
			
			case($string == 'pancard_doc'):
				$label = '1.(t) Pancard Attachment';
				break;
			case($string == 'aadhar_doc'):
				$label = '1.(v) Aadhar Attachment ';
				break;
               
				case($string == 'user_image'):
				$label = 'Upload User Image';
				break;
				case($string == 'achievement_doc'):
				$label = 'Upload Achievement Pdf';
				break;
			   case($string == 'nominated_award_doc'):
				$label = '12.Undertaking by the sportsperson nominated for the award';
				break;
			 default:
			$label = 'some documents';
		}
		
		return $label;
	}
	// get doc label Dhyan Chand Award
	
	
	function getDocLabelDhyanChandAward($string){

		switch($string){
			
			case($string == 'pancard_doc'):
				$label = 'Pancard Attachment';
				break;
			case($string == 'aadhar_doc'):
				$label = 'Aaadhar Attachment ';
				break;
			case($string == 'user_image'):
				$label = 'User Image Attachment';
				break;
			case($string == 'bio_data_doc'):
				$label = 'Brief bio-data Attachment';
				break;
				
				case($string == 'achievement_doc'):
				$label = 'Sports Achievements during active sports career';
				break;
			case($string == 'nominated_award_doc'):
				$label = '12.Undertaking by the sportsperson nominated for the award';
				break;
			 default:
			$label = 'some documents';
		}
		
		return $label;
	}
	
	// get doc label for droncharya award
	
	function getDocLabeldronacharya($string){

		switch($string){
			
			case($string == 'pancard_doc'):
				$label = 'Pancard Attachment';
				break;
			case($string == 'aadhar_doc'):
				$label = 'Aadhar Attachment ';
				break;
		  	case($string =='user_image'):
				$label = 'Upload User Image';
				break;
				
				case($string == 'academic_doc'):
				$label = 'Upload academic details document';
				break;
				
				
				case($string == 'achievement_doc'):
				$label = 'Upload achievement document';
				break;
				
			    case($string == 'award_nomination_doc'):
				$label = 'Undertaking by the sportsperson nominated for the award';
				break;
			 default:
			$label = 'some documents pending for upload';
		}
		
		return $label;
	}
	
	
	
	
	
	
	
	function getDocLabelpension($string){
		/*
			#function for pension validation label.
		*/
		switch($string){
			case($string == 'olympic_games_doc'):
				$label = 'Olympic Games';
				break;
			case($string == 'world_cup_doc'):
				$label = 'World Cups/World Championships in Olympics and Asian Games disciplines';
				break;
			case($string == 'asian_games_doc'):
				$label = 'Asian Games';
				break;
			case($string == 'commonwealth_games_doc'):
				$label = 'Commonwealth Games';
				break;
			case($string == 'para_olympic_games_doc'):
				$label = 'Para-Olympic Games';
				break;	
			case($string == 'other_doc'):
				$label = 'Other Document';
				break;	
			default:
			$label = 'some documents';
		}
		return $label;
	}
	
	
}










