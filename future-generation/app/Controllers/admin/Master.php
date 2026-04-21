<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ApplicationModel;
use App\Models\MasterModel;
use App\Models\ReportModel;
use CodeIgniter\HTTP\ResponseInterface;

class Master extends BaseController
{
	protected $Master_model;
	protected $validation;
	protected $Report_model;
	protected $Application_model;

	function __construct()
	{
		$this->Master_model = new MasterModel;
		$this->validation = \Config\Services::validation();
		$this->Report_model = new ReportModel;
		$this->Application_model = new ApplicationModel;
	}

	public function index()
	{
		//
	}

	public function addCountry($ROWID = '')
	{
		if ($ROWID != '') {
			$ROWID =  encryptor('decrypt', $ROWID);
			$data['edit_country'] = $this->Master_model->getCountry($ROWID);
		}
		$data['countries'] = $this->Master_model->getCountry();
		$data['content'] = 'backend/addCountry';
		return view('backend/index', $data);
	}

	function submitCountry()
	{

		$ROWID = $this->request->getPost('ROWID');
		$CountryID = $this->request->getPost('CountryID');
		$CountryName = $this->request->getPost('CountryName');

		$Active = $this->request->getPost('Active');

		$Country = array();
		$Country['ROWID'] = $ROWID;
		$Country['CountryID'] = $CountryID;
		$Country['CountryName'] = $CountryName;
		$Country['Active'] = $Active;
		//print_r($this->request->getPost());
		$response = $this->Master_model->checkCountry($CountryID, $CountryName, $Active);

		$response_status = $response['msg'];
		if ($response_status == 'Exist') {
			session()->setFlashdata('msg', 'Record Already Exist');
			return redirect()->to('admin/Master/addCountry');
		} else {


			if ($ROWID != '') {
				$result = $this->Master_model->updateCountry($Country);
			} else {
				$result = $this->Master_model->insertCountry($Country);
			}

			if ($result['msg'] == 'INSERTED') {
				session()->setFlashdata('msg', 'Record Inserted Successfully');
				return redirect()->to('admin/Master/addCountry');
			} elseif ($result['msg'] == 'UPDATED') {
				session()->setFlashdata('msg', 'Record UPDATED Successfully');
				return redirect()->to('admin/Master/addCountry');
			} else {
				dd(session()->get('post')); //for post the data auto filled 
				session()->setFlashdata('msg', 'There is some Error Occurred in Submission. Please try later.');
				return redirect()->to('admin/Master/addCountry');
			}
		}
	}

	public function addState($ROWID = '')
	{
		if ($ROWID != '') {
			$ROWID =  encryptor('decrypt', $ROWID);
			$data['edit_state'] = $this->Master_model->getState($ROWID);
		}
		$data['states'] = $this->Master_model->getState();
		$data['content'] = 'backend/addState';
		return view('backend/index', $data);
	}

	function submitState()
	{

		$ROWID = $this->request->getPost('ROWID');
		$StateID = $this->request->getPost('StateID');
		$StateName = $this->request->getPost('StateName');
		$Active = $this->request->getPost('Active');

		$State = array();
		$State['ROWID'] = $ROWID;
		$State['StateID'] = $StateID;
		$State['StateName'] = $StateName;
		$State['Active'] = $Active;
		//print_r($this->request->getPost()); exit;
		if ($ROWID != '') {
			$result = $this->Master_model->updateState($State);
		} else {
			$result = $this->Master_model->insertState($State);
		}

		if ($result['msg'] == 'INSERTED') {
			session()->setFlashdata('msg', 'Record Inserted Successfully');
			return redirect()->to('admin/Master/addState');
		} elseif ($result['msg'] == 'UPDATED') {
			session()->setFlashdata('msg', 'Record UPDATED Successfully');
			return redirect()->to('admin/Master/addState');
		} elseif ($result['msg'] == 'Exists') {
			session()->setFlashdata('msg_error', '<div class="alert alert-danger">State Code already Exists</div>');
			return redirect()->to('admin/Master/addState');
		} else {
			$post = session()->get('post'); //for post the data auto filled 
			session()->setFlashdata('msg_error', 'There is some Error Occurred in Submission. Please try later.');
			return redirect()->to('admin/Master/addState');
		}
	}

	public function addClass($ROWID = '')
	{
		//echo "<pre>";print_r($_SESSION);echo "</pre>";die(); 
		//echo"<pre>";print_r($ROWID);die;
		if ($ROWID != '') {
			$ROWID =  encryptor('decrypt', $ROWID);
			$data['edit_class'] = $this->Master_model->getClass($ROWID);
		}
		$data['class'] = $this->Master_model->getClass();
		$data['content'] = 'backend/addClass';
		return view('backend/index', $data);
	}

	function submitaddClass()
	{
		$ROWID = $this->request->getPost('ROWID');
		$Class = $this->request->getPost('Class');
		$Active = $this->request->getPost('Active');

		$classinfo = array();
		$classinfo['ROWID'] = $ROWID;
		$classinfo['Class'] = $Class;
		$classinfo['Active'] = $Active;
		//print_r($this->request->getPost());
		if ($ROWID != '') {
			$result = $this->Master_model->updateClassInfo($classinfo);
		} else {
			$result = $this->Master_model->insertClassInfo($classinfo);
		}

		if ($result['msg'] == 'INSERTED') {
			session()->setFlashdata('msg', 'Record Inserted Successfully');
			return redirect()->to('admin/Master/addClass');
		} elseif ($result['msg'] == 'UPDATED') {
			session()->setFlashdata('msg', 'Record UPDATED Successfully');
			return redirect()->to('admin/Master/addClass');
		} else {
			dd(session()->get('post')); //for post the data auto filled 
			session()->setFlashdata('msg', 'There is some Error Occurred in Submission. Please try later.');
			return redirect()->to('admin/Master/addClass');
		}
	}

	public function delDiploma()
	{
		$dipID = $this->request->getPost('toBeChange');
		if ($dipID != '') {
			$dipID =  encryptor('decrypt', $dipID);
			$isdeleted = $this->Master_model->updateDiploma(array("Deletestatus" => 1, "dipID" => $dipID));

			if ($isdeleted['msg'] == 'UPDATED') {
				echo 'OK';
			} else {
				echo 'Unable to delete the record';
			}
		}
	}



	public function delCountry()
	{
		$ROWID = $this->request->getPost('toBeChange');
		if ($ROWID != '') {
			$ROWID =  encryptor('decrypt', $ROWID);
			$isdeleted = $this->Master_model->updateCountry(array("Deletestatus" => 1, "ROWID" => $ROWID));

			if ($isdeleted['msg'] == 'UPDATED') {
				echo 'OK';
			} else {
				echo 'Unable to delete the record';
			}
		}
	}


	function submitGrades()
	{

		$ROWID = $this->request->getPost('ROWID');
		$Grade = $this->request->getPost('Grade');
		$GradeValue = $this->request->getPost('GradeValue');
		$Active = $this->request->getPost('Active');

		$addgrades = array();
		$addgrades['ROWID'] = $ROWID;
		$addgrades['Grade'] = $Grade;
		$addgrades['GradeValue'] = $GradeValue;
		$addgrades['Active'] = $Active;

		//echo"<pre>"; print_r($addgrades);print_r($this->request->getPost());die();
		if ($ROWID != '') {
			$result = $this->Master_model->updateGrades($addgrades);
		} else {
			$result = $this->Master_model->insertGrades($addgrades);
		}

		if ($result['msg'] == 'INSERTED') {
			session()->setFlashdata('msg', 'Record Inserted Successfully');
			return redirect()->to('admin/Master/addgrades');
		} elseif ($result['msg'] == 'UPDATED') {
			session()->setFlashdata('msg', 'Record UPDATED Successfully');
			return redirect()->to('admin/Master/addgrades');
		} else {
			dd(session()->get('post')); //for post the data auto filled 
			session()->setFlashdata('msg', 'There is some Error Occurred in Submission. Please try later.');
			return redirect()->to('admin/Master/addgrades');
		}
	}

	public function delGrades()
	{
		$ROWID = $this->request->getPost('toBeChange');
		if ($ROWID != '') {
			$ROWID =  encryptor('decrypt', $ROWID);
			$isdeleted = $this->Master_model->updateGrades(array("Deletestatus" => 1, "ROWID" => $ROWID));

			if ($isdeleted['msg'] == 'UPDATED') {
				echo 'OK';
			} else {
				echo 'Unable to delete the record';
			}
		}
	}
	public function delPaymentType()
	{
		$ROWID = $this->request->getPost('toBeChange');
		if ($ROWID != '') {
			$ROWID =  encryptor('decrypt', $ROWID);
			$isdeleted = $this->Master_model->updatePaymentType(array("Deletestatus" => 1, "ROWID" => $ROWID));

			if ($isdeleted['msg'] == 'UPDATED') {
				echo 'OK';
			} else {
				echo 'Unable to delete the record';
			}
		}
	}
	public function delCampaign()
	{
		$CampaignID = $this->request->getPost('toBeChange');
		if ($CampaignID != '') {
			$CampaignID =  encryptor('decrypt', $CampaignID);
			$isdeleted = $this->Master_model->updateCampaigns(array("Deletestatus" => 1, "CampaignID" => $CampaignID));

			if ($isdeleted['msg'] == 'UPDATED') {
				echo 'OK';
			} else {
				echo 'Unable to delete the record';
			}
		}
	}
	public function delState()
	{
		$ROWID = $this->request->getPost('toBeChange');
		if ($ROWID != '') {
			$ROWID =  encryptor('decrypt', $ROWID);
			$isdeleted = $this->Master_model->deleteState(array("Deletestatus" => 1, "ROWID" => $ROWID));

			if ($isdeleted['msg'] == 'DELETED') {
				echo 'OK';
			} else {
				echo 'Unable to delete the record';
			}
		}
	}
	public function delClass()
	{
		$ROWID = $this->request->getPost('toBeChange');
		if ($ROWID != '') {
			$ROWID =  encryptor('decrypt', $ROWID);
			$isdeleted = $this->Master_model->updateClassInfo(array("Deletestatus" => 1, "ROWID" => $ROWID));

			if ($isdeleted['msg'] == 'UPDATED') {
				echo 'OK';
			} else {
				echo 'Unable to delete the record';
			}
		}
	}

	function submitaddCampaigns()
	{

		$CampaignID = $this->request->getPost('CampaignID');
		$CampaignName = $this->request->getPost('CampaignName');
		$Active = $this->request->getPost('Active');

		$campaigns = array();
		$campaigns['CampaignID'] = $CampaignID;
		$campaigns['CampaignName'] = $CampaignName;
		$campaigns['Active'] = $Active;
		//print_r($this->request->getPost());
		if ($CampaignID != '') {
			$result = $this->Master_model->updateCampaigns($campaigns);
		} else {
			$result = $this->Master_model->insertCampaigns($campaigns);
		}

		if ($result['msg'] == 'INSERTED') {
			session()->setFlashdata('msg', 'Record Inserted Successfully');
			return redirect()->to('admin/Master/addCampaigns');
		} elseif ($result['msg'] == 'UPDATED') {
			session()->setFlashdata('msg', 'Record UPDATED Successfully');
			return redirect()->to('admin/Master/addCampaigns');
		} else {
			$$post = $this->request->getPost();
			session()->setFlashdata('post', $post); //for post the data auto filled 
			session()->setFlashdata('msg', 'There is some Error Occurred in Submission. Please try later.');
			return redirect()->to('admin/Master/addCampaigns');
		}
	}

	public function addPaymentType($ROWID = '')
	{
		if ($ROWID != '') {
			$ROWID =  encryptor('decrypt', $ROWID);
			$data['edit_pay'] = $this->Master_model->getPaymentType($ROWID);
		} //print_r($data['edit_pay']);die();
		$data['PayType'] = $this->Master_model->getPaymentType();
		$data['content'] = 'backend/addPaymentType';
		return view('backend/index', $data);
	}
	function submitPaymentType()
	{
		//echo"<pre>";print_r($_POST);die();
		$ROWID = $this->request->getPost('ROWID');
		$PayType = $this->request->getPost('PayType');
		//$Active = $this->request->getPost('Active');

		$PaymentType = array();
		$PaymentType['ROWID'] = $ROWID;
		$PaymentType['PayType'] = $PayType;
		//$PaymentType['Active']=$Active;
		//print_r($this->request->getPost());
		if ($ROWID != '') {
			$result = $this->Master_model->updatePaymentType($PaymentType);
		} else {
			$result = $this->Master_model->insertPaymentType($PaymentType);
		}

		if ($result['msg'] == 'INSERTED') {
			session()->setFlashdata('msg', 'Record Inserted Successfully');
			return redirect()->to('admin/Master/addPaymentType');
		} elseif ($result['msg'] == 'UPDATED') {
			session()->setFlashdata('msg', 'Record UPDATED Successfully');
			return redirect()->to('admin/Master/addPaymentType');
		} else {
			dd(session()->get('post')); //for post the data auto filled 
			session()->setFlashdata('msg', 'There is some Error Occurred in Submission. Please try later.');
			return redirect()->to('admin/Master/addPaymentType');
		}
	}

	function uploadSignature()
	{
		$location = 'Transcript';
		$data['records'] = $this->Master_model->get_upload_signature($location);
		$data['content'] = 'backend/upload_signature';
		return view('backend/index', $data);
	}

	function updateSignatureDetail()
	{
		$id = $this->request->getPost('sign_id');
		$id = ($id != '') ? encryptor('decrypt', $id) : '';
		$sign_name = $this->request->getPost('sign_name');
		$old_sign = $this->request->getPost('old_sign_file');
		$signature_file = ($old_sign != '') ? encryptor('decrypt', $old_sign) : '';

		$response_array = [];

		if (!empty($_FILES['sign_file']) && $_FILES['sign_file']['error'] === 0) {
			$uploaded_file = $_FILES['sign_file'];
			$filename = basename($uploaded_file['name']);
			$temporary = explode(".", $filename);
			$file_extension = end($temporary);
			$allowed = ['png', 'jpg', 'jpeg'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$filesize = $uploaded_file['size'];

			if ($filesize <= 2097152 && $filesize > 0) {
				if (in_array(strtolower($ext), $allowed)) {
					$DOCUMENT_Name_New = $sign_name . trim(' ') . '_' . docdate() . '.' . $file_extension;
					$new_path = 'docs/sign/';
					$UPLOAD_PATH1 = FCPATH . $new_path . $DOCUMENT_Name_New;

					// ✅ Create folder if not exists
					if (!is_dir(FCPATH . $new_path)) {
						mkdir(FCPATH . $new_path, 0777, true);
					}

					// ✅ Now move the file
					if (move_uploaded_file($uploaded_file['tmp_name'], $UPLOAD_PATH1)) {
						$signature_file = $new_path . $DOCUMENT_Name_New;
					} else {
						$response_array['msg'] = 'File upload failed. Please try again.';
					}
				} else {
					$response_array['msg'] = 'Uploaded file is not valid. Only JPG, PNG files are allowed.';
				}
			} else {
				$response_array['msg'] = 'File Size Limit Exceeded (should be less than 2 MB)';
			}
		}

		$param = [
			'id' => $id,
			'sign_name' => $sign_name,
			'sign_image_path' => $signature_file,
			'modified_by' => session()->get('USER_ID'),
			'modified_ip' => actual_ip(),
		];

		$response_array = $this->Master_model->update_master_signature($param);
		echo json_encode($response_array, JSON_UNESCAPED_SLASHES);
	}

	public function addRegionProgram($RPID = '')
	{
		if ($RPID != '') {

			$RPID =  encryptor('decrypt', $RPID);
			$data['edit_RegionProgram'] = $this->Master_model->getRegionProgram($RPID);
		}
		$data['RegionProgram'] = $this->Master_model->getRegionProgram();
		$data['content'] = 'backend/addRegionProgram';
		return view('backend/index', $data);
	}

	function submitRegionProgram()
	{

		$RPID = $this->request->getPost('RPID');
		$RegionProgram = $this->request->getPost('RegionProgram');
		$Active = $this->request->getPost('Active');
		//$Active = $this->request->getPost('Active');

		$RegionProg = array();
		$RegionProg['RPID'] = $RPID;
		$RegionProg['RegionProgram'] = $RegionProgram;
		$RegionProg['Active'] = $Active;
		//print_r($this->request->getPost());
		if ($RPID != '') {
			$result = $this->Master_model->updateRegionProgram($RegionProg);
		} else {
			$result = $this->Master_model->insertRegionProgram($RegionProg);
		}
		if ($result['msg'] == 'INSERTED') {
			session()->setFlashdata('msg', 'Record Inserted Successfully');
			return redirect()->to('admin/Master/addRegionProgram');
		} elseif ($result['msg'] == 'UPDATED') {
			session()->setFlashdata('msg', 'Record UPDATED Successfully');
			return redirect()->to('admin/Master/addRegionProgram');
		} else {
			dd(session()->get('post')); //for post the data auto filled 
			session()->setFlashdata('msg', 'There is some Error Occurred in Submission. Please try later.');
			return redirect()->to('admin/Master/addRegionProgram');
		}
	}


	public function addCampaigns($CampaignID = '')
	{
		if ($CampaignID != '') {
			$CampaignID =  encryptor('decrypt', $CampaignID);
			$data['edit_campaign'] = $this->Master_model->getCampaigns($CampaignID);
		}
		$data['campaign'] = $this->Master_model->getCampaigns();
		$data['content'] = 'backend/addCampaigns';
		return view('backend/index', $data);
	}

	public function addCourselist($CourseID = '')
	{
		if ($CourseID != '') {
			$CourseID =  encryptor('decrypt', $CourseID);
			$data['edit_course'] = $this->Master_model->getCourseList($CourseID);

			$data['edit_professor'] =	$this->Master_model->get_professor_by_course_id($CourseID);
			$data['edit_professor']  = array_column($data['edit_professor'], 'professor_id');
		}

		//	$data['edit_course'] = $this->Master_model->getCourseList($CourseID);
		$data['professor'] = $this->Master_model->getprofessor($CourseID);
		//echo "<pre>";print_r($data['professor']);echo "</pre>";die;
		$data['class'] = $this->Master_model->getClass();
		//echo "<pre>";print_r($data['class']);die;
		$data['courselist'] = $this->Master_model->getCourseList();
		$data['content'] = 'backend/addCourselist';
		return view('backend/index', $data);
	}

	function submitCourselist()
	{
		$professor_id = $this->request->getPost('Professor_id');
		$teaching_assistant = $this->request->getPost('Teaching_Assistant');
		if ($professor_id)
			$professors = $this->Master_model->get_professor_by_id($professor_id);
		$professor = [""];
		if (isset($professors)) {
			foreach ($professors as $pro) {
				if ($professor == '') {
					$professor = $pro['FirstName'] . " " . $pro['LastName'];
				} else {
					$professor = $professor . "," . $pro['FirstName'] . " " . $pro['LastName'];
				}
			}
		}

		$CourseID = $this->request->getPost('CourseID');
		$Class = $this->request->getPost('Class');
		$Semester = $this->request->getPost('Semester');
		$Term = $this->request->getPost('Term');
		$Course = $this->request->getPost('Course');
		$Professor = $professor;

		$Professor_id = $this->request->getPost('Professor_id');

		$Credits = $this->request->getPost('Credits');
		$CourseTitle = $this->request->getPost('CourseTitle');
		$CourseDates = $this->request->getPost('CourseDates');

		$start_date = $this->request->getPost('start_date');
		$end_date  = $this->request->getPost('end_date');
		$audit_rate = $this->request->getPost('audit_rate');

		$teaching_assistant = $this->request->getPost('Teaching_Assistant');

		//$Active = $this->request->getPost('Active');                 
		$courselist = array();
		$testing_record = array();

		if ($start_date != '') {
			$start_date = date('Y-m-d', strtotime($start_date));
		}
		if ($end_date != '') {
			$end_date = date('Y-m-d', strtotime($end_date));
		}

		if ($start_date != '' && $end_date != '') {
			$CourseDates = date('F d', strtotime($start_date)) . "-" . date('F d,Y', strtotime($end_date));
		}

		$courselist['CourseID'] = $CourseID;
		$courselist['Class'] = $Class;
		$courselist['Semester'] = $Semester;
		$courselist['Term'] = $Term;
		$courselist['Course'] = $Course;
		$courselist['Professor'] = $Professor;
		//$courselist['Professor_id'] = $Professor_id; 
		$courselist['Credits'] = $Credits;
		$courselist['CourseTitle'] = $CourseTitle;
		$courselist['CourseDates'] = $CourseDates;
		$courselist['tution'] = $this->request->getPost('tution');
		$courselist['ip'] =  $this->request->getIPAddress();
		$courselist['External_Professor'] = $this->request->getPost('External_Professor');
		//$courselist['Teaching_Assistant'] = $teaching_assistant;
		$courselist['start_date'] = $start_date != '' ? $start_date : null;
		$courselist['end_date'] = $end_date != '' ? $end_date : null;
		$courselist['audit_rate'] = $audit_rate;

		$testing_record['Class'] = $Class;
		$testing_record['Semester'] = $Semester;
		$testing_record['Term'] = $Term;
		$testing_record['Course'] = $Course;
		$tablename = 'courselist';
		$testrecords = recordExist($testing_record, $tablename);
		$editrecords = recordExist($courselist, $tablename);
		$editrecords = false;
		if ($CourseID != '') {
			if (!$editrecords) {
				$courselist['modified_date'] = date("Y-m-d H:i:s");
				$result = $this->Master_model->updateCourseList($courselist);

				$this->Master_model->update_course_professor($Professor_id, $CourseID);
				$this->Master_model->update_course_assistant($teaching_assistant, $CourseID);
			} else {
				session()->setFlashdata('msg', '<div class="alert alert-success">Record Already Exist</div>');
				return redirect()->to('admin/Master/addCourselist');
			}
		} else {
			if (! $testrecords) {
				$result = $this->Master_model->insertCourseList($courselist);

				$this->Master_model->update_course_professor($Professor_id, $result['last_id']);
				$this->Master_model->update_course_assistant($teaching_assistant, $result['last_id']);
			} else {
				session()->setFlashdata('msg', '<div class="alert alert-danger">CourseID already exist duplicate CourseID not allowed</div>');
				return redirect()->to('admin/Master/addCourselist');
			}
		}
		if ($result['msg'] == 'INSERTED') {
			session()->setFlashdata('msg', '<div class="alert alert-success">Record Inserted Successfully</div>');
			return redirect()->to('admin/Master/addCourselist');
		} elseif ($result['msg'] == 'UPDATED') {
			session()->setFlashdata('msg', '<div class="alert alert-success">Record UPDATED Successfully</div>');
			return redirect()->to('admin/Master/addCourselist');
		} else {
			$post = $this->request->getPost();
			session()->setFlashdata('post', $post);
			session()->setFlashdata('msg', '<div class="alert alert-danger">There is some Error Occurred in Submission. Please try later.</div>');
			return redirect()->to('admin/Master/addCourselist');
		}
	}

	public function addDiploma($dipID = '')
	{

		if ($dipID != '') {

			$dipID = encryptor('decrypt', $dipID);
			$data['edit_diploma'] = $this->Master_model->getDiploma($dipID);
		}
		$data['diploma'] = $this->Master_model->getDiploma();


		$data['content'] = 'backend/addDiploma';
		return view('backend/index', $data);
	}



	// submit add Diploma
	function submitDiploma()
	{
		$this->validation->setRules([
			'dipName'        => 'trim|required',
			'grad_undergrad' => 'trim|required',
			'Active'         => 'trim|required'
		]);

		if (!$this->validation->withRequest($this->request)->run()) {
			$data['errors'] = validation_errors();
			session()->setFlashdata('msg', '<div class="alert alert-danger text-center">Please check the Errors !!!<br> ' . $data['errors'] . '</div>');
			$post = $this->request->getPost();
			session()->setFlashdata('post', $post);
			return redirect()->to('admin/Master/addDiploma');
		}

		$dipID = $this->request->getPost('dipID');
		$dipName = $this->request->getPost('dipName');
		$grad_undergrad = $this->request->getPost('grad_undergrad');
		$Active = $this->request->getPost('Active');
		$diplomainfo = array();
		$diplomainfo['dipID'] = $dipID;
		$diplomainfo['dipName'] = $dipName;
		$diplomainfo['grad_undergrad'] = $grad_undergrad;
		$diplomainfo['Active'] = $Active;


		if ($dipID != '') {
			$diplomainfo['modified_date'] = date('Y-m-d h:i:s');
			$result = $this->Master_model->updateDiploma($diplomainfo);
		} else {
			$diplomainfo['createddate'] = date('Y-m-d h:i:s');
			$result = $this->Master_model->insertDiploma($diplomainfo);
		}

		if ($result['msg'] == 'INSERTED') {
			session()->setFlashdata('msg', 'Record Inserted Successfully');
			return redirect()->to('admin/Master/addDiploma');
		} elseif ($result['msg'] == 'UPDATED') {
			session()->setFlashdata('msg', 'Record UPDATED Successfully');
			return redirect()->to('admin/Master/addDiploma');
		} else {
			session()->setFlashdata('post', $this->request->getPost()); //for post the data auto filled 
			session()->setFlashdata('msg', 'There is some Error Occurred in Submission. Please try later.');
			return redirect()->to('admin/Master/addDiploma');
		}
	}

	public function addCertificate($certID = '')
	{
		if ($certID != '') {
			$certID =  encryptor('decrypt', $certID);
			$data['edit_certificate'] = $this->Master_model->getCertificateList($certID);
			//	echo "<pre>";print_r($data['edit_certificate']);die();
		}


		$data['certificatelist'] = $this->Master_model->getCertificateList();
		$data['diploma'] = $this->Master_model->getDiplomaList();
		$data['content'] = 'backend/addCertificate';
		$data['class'] = $this->Master_model->getClass();
		$data['semesterlist'] = $this->Report_model->getAllSemsterList();


		return view('backend/index', $data);
	}

	function getCourseByTerm()
	{
		$Term = $_POST['term'];
		$res = '<option value="">Select Course</option>';
		if ($Term != "") {
			$data = $this->Master_model->getCourseListByTerm($Term);
			if ($data) {
				foreach ($data as $key => $value) {
					$res .= '<option value="' . $value['Course'] . '">' . $value['Course'] . '-' . $value['CourseTitle'] . ' </option>';
				}
			}
		}
		echo $res .= '<option value="2">Other</option>';
	}

	public function delCertificate()
	{
		$certID = $this->request->getPost('toBeChange');
		if ($certID != '') {
			$certID =  encryptor('decrypt', $certID);
			$isdeleted = $this->Master_model->updateCertificateList(array("Deletestatus" => 1, "certID" => $certID));

			if ($isdeleted['msg'] == 'UPDATED') {
				echo 'OK';
			} else {
				echo 'Unable to delete the record';
			}
		}
	}

	function submitCertificate()
	{
		$post = $this->request->getPost();
		$validationRules = [
			'cert_no'        => 'required|trim',
			'course_dates'   => 'required|trim',
			'Professor'      => 'required|trim',
			'grad_undergrad' => 'required|trim',
			'CertName'       => 'required|trim',
			'class'          => 'required|trim',
			'semester'       => 'required|trim',
			'dipID'          => 'required|trim',
			'active'         => 'required|trim',
			'tution'         => 'required'
		];
		if (!$this->validate($validationRules)) {
			$data['errors'] = validation_errors();
			session()->setFlashdata('msg', '<div class="alert alert-danger text-center">Please check the Errors !!!<br> ' . $data['errors'] . '</div>');
			session()->setFlashdata('post', $post);
			redirect('admin/Master/addCertificate');
		} else {
			$certID = $post['certID'];
			$cert_no = $post['cert_no'];
			$course_dates = $post['course_dates'];
			$professor = $post['Professor'];
			$grad_undergrad = $post['grad_undergrad'];
			$CertName = $post['CertName'];
			$DipID = $post['dipID'];
			$active = $post['active'];
			$tution = $post['tution'];
			$credits = $post['Credits'];
			$class = $post['class'];
			$semester = $post['semester'];

			$certificatelist = array();
			$certificatelist['certID'] = $certID;
			$certificatelist['cert_no'] = $cert_no;
			$certificatelist['course_dates'] = $course_dates;
			$certificatelist['Professor'] = $professor;
			$certificatelist['grad_undergrad'] = $grad_undergrad;
			$certificatelist['Professor'] = $professor;
			$certificatelist['CertName'] = $CertName;
			$certificatelist['DipID'] = $DipID;
			$certificatelist['active'] = $active;
			$certificatelist['tution'] = $tution;
			$certificatelist['Credits'] = $credits;
			$certificatelist['ip'] = $this->request->getIPAddress();
			$certificatelist['class'] = $class;
			$certificatelist['semester'] = $semester;
			if ($certID != '') {
				$certificatelist['modified_date'] = date("Y-m-d H:i:s");
				$result = $this->Master_model->updateCertificateList($certificatelist);
			} else {
				$result = $this->Master_model->insertCertificateList($certificatelist);
			}

			if ($result['msg'] == 'INSERTED') {
				session()->setFlashdata('msg', 'Record Inserted Successfully');
				return redirect()->to('admin/Master/addCertificate');
			} elseif ($result['msg'] == 'UPDATED') {
				session()->setFlashdata('msg', 'Record UPDATED Successfully');
				return redirect()->to('admin/Master/addCertificate');
			} else {
				session()->setFlashdata('post', $post);
				session()->setFlashdata('msg', 'There is some Error Occurred in Submission. Please try later.');
				return redirect()->to('admin/Master/addCertificate');
			}
		}
	}

	public function addProgram($ProgramID = ''){
		if($ProgramID !=''){
		$ProgramID =  encryptor('decrypt', $ProgramID);
		$data['edit_program'] = $this->Master_model->getprogram($ProgramID);
		}
		$data['Program_Name'] = $this->Master_model->getprogram();
		$data['content'] = 'backend/addProgram'; 
		return view('backend/index', $data);
	}	
	
	function submitProgram(){
		
		$ProgramID=$this->request->getPost('ProgramID');
		
		//echo"<pre>"; print_r($ProgramID);die;
		
		$Program_Name = $this->request->getPost('Program_Name');
		$status = $this->request->getPost('status');
		
		$program=array();
		$program['ProgramID']=$ProgramID;
		$program['Program_Name']=$Program_Name;
		$program['status']=$status;
		
		//echo"<pre>"; print_r($program);print_r($this->request->getPost());die();
		if($ProgramID!=''){
		$result = $this->Master_model->updateProgram($program);
		} else{
			$result = $this->Master_model->insertProgram($program);
		}
		
		if($result['msg']=='INSERTED'){		
			session()->setFlashdata('msg','Record Inserted Successfully');
			return redirect()->to('admin/Master/addProgram');
		}elseif($result['msg']=='UPDATED'){		
			session()->setFlashdata('msg','Record UPDATED Successfully');
			return redirect()->to('admin/Master/addProgram');
		}else {
			session()->setFlashdata('post',$this->request->getPost()); //for post the data auto filled 
			session()->setFlashdata('msg','There is some Error Occurred in Submission. Please try later.');
			return redirect()->to('admin/Master/addProgram');
		}

	}

	public function delete_addProgram()
	{
		$query = $this->Master_model->delete_program();
		session()->setFlashdata('msg','Data Deleted Successfully . . .');
		return redirect()->to('admin/Master/addProgram');

	}

	public function get_user_by_progrm()
	{
	  echo json_encode($this->Master_model->get_user_by_progrm());
	}

	public function addSpecialProgram($ProgramID = '')
	{
		if($ProgramID !=''){
				$ProgramID =  encryptor('decrypt', $ProgramID);
				$data['edit_program'] = $this->Master_model->getSpecialprogram($ProgramID);
		}
		$data['special_program'] = $this->Master_model->getspecialprogram();
		$data['content'] = 'backend/addSpecialProgram';
		return view('backend/index', $data);
	}

	public function submitSpecialProgram()
	{
		$ProgramID=$this->request->getPost('ProgramID');

		$Program_Name = $this->request->getPost('SPEProgram_Name');
		$status = $this->request->getPost('status');
		$program = array(
			'Special_Program_Name' => $Program_Name,
			'Status'               => $status
		 );


		if($ProgramID!=''){
		 $result = $this->Master_model->updateSpecialProgram($program,$ProgramID);
		} 
		else{
			$result = $this->Master_model->insertSpecialProgram($program);
		}
		if($result['msg']=='INSERTED'){		
		session()->setFlashdata('msg','Record Inserted Successfully');
			return redirect()->to('admin/Master/addSpecialProgram');
		}
		if($result['msg']=='UPDATED'){		
		session()->setFlashdata('msg','Record Updated Successfully');
			return redirect()->to('admin/Master/addSpecialProgram');
		}
	}

	function addDocumentType($DocumentID = ''){
	    if($DocumentID !=''){
			$DocumentID =  encryptor('decrypt', $DocumentID);
			$data['edit_document'] = $this->Application_model->get_document_type_by_id($DocumentID);
		}
	    $data['documenttypes'] = $this->Application_model->get_document_type();
	    $data['content'] = 'backend/document_type';
		return view('backend/index', $data);
	}
	
	function submitDocumentType(){
        $document_id = $this->request->getPost('documentID');
        $document_type = $this->request->getPost('document_type');
        $status = $this->request->getPost('status');
        $created_ip = $this->request->getIPAddress();
        $created_by = session()->get('USER_ID');
        $document = array(
            'type' => $document_type,
            'Status'=> $status,
            'created_by' => $created_by,
            'created_ip' => $created_ip,
            'created_date' => date('Y-m-d h:m:i')
        );
        if($document_id != ''){
            $result = $this->Master_model->update_document_type($document,$document_id);
        } 
        else{
            $result = $this->Master_model->insert_document_type($document);
        }
        if($result['msg']=='INSERTED'){		
            session()->setFlashdata('msg','Record Inserted Successfully');
            return redirect()->to('admin/Master/addDocumentType');
        }
        if($result['msg']=='UPDATED'){		
            session()->setFlashdata('msg','Record Updated Successfully');
            return redirect()->to('admin/Master/addDocumentType');
        }
	}

		function addTrack()
	{
	    $data['records'] = $this->Master_model->get_track();
		$data['content'] = 'backend/addTrack';
		return view('backend/index', $data);
	}
	
	function submit_track_details()
	{
	    $post = $this->request->getPost();
	    $param['track_name'] = $post['track_name'];
	    $param['status'] = $post['status'];
	   	
	    if($post['track_id'] == '')
	    {
	        $param['created_by'] = session()->get('USER_ID');
		    $param['created_date'] = date('Y-m-d H:i:s');
		    $param['created_ip'] = actual_ip();	
	        $query = $this->Master_model->insert_track($param);
	        if($query)
	        {
	            session()->setFlashdata('msg','<div class="alert alert-success">Data Added Successfully . . .</div>');
		        return redirect()->to('admin/Master/addTrack');    
	        }
	        else
	        {
	            session()->setFlashdata('msg','<div class="alert alert-danger">There is some Error Occurred in Submission. Please try later.</div>');
			    return redirect()->to('admin/Master/addTrack');    
	        }  
	    }
	    else
	    {
	        $track_id = $id = encryptor('decrypt', $post['track_id']); 
	        $param['id'] = $track_id;
	        $param['modified_by'] = session()->get('USER_ID');
		    $param['modified_date'] = date('Y-m-d H:i:s');
		    $param['modified_ip'] = actual_ip();	
	        $query = $this->Master_model->update_track($param);
	        if($query)
	        {
	            session()->setFlashdata('msg','<div class="alert alert-success">Data Updated Successfully . . .</div>');
	            return redirect('admin/Master/addTrack');    
	        }
	        else
	        {
	            session()->setFlashdata('msg','<div class="alert alert-danger">There is some Error Occurred in Submission. Please try later.</div>');
			    return redirect('admin/Master/addTrack');    
	        }
	    }
	}
	
	function filter_addTrack()
	{
	    if($this->request->getPost('submit') == 'submit')
	    {
	        $data['records'] = $this->Master_model->get_track();
		    return view('templates/filter/filter_addTrack', $data);
	    }
	}

}
