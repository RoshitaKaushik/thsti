<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ApplicationModel;
use App\Models\BuilderModel;
use App\Models\ScbvModel;
use Config\Database;

class Finance extends BaseController
{
    protected $Application_model;
    protected $Builder_model;
    protected $SCBV_model;
    protected $db;

    function __construct()
    {
        admin_check_session();
        $this->Application_model = new ApplicationModel();
        $this->Builder_model = new BuilderModel();
        $this->SCBV_model = new ScbvModel();
    }
    public function index()
    {
        //
    }

    function payments()
    {

        // $component_id = 36;
        $component_id = 34;
        $status = 3;
        $selected_field = array('722', '723', '733', '734', '735');
        $data['custums']  = $this->Builder_model->getLimitedCustomFieldsActive($component_id, $selected_field);


        $data['component_id'] = $component_id;
        $data['datas'] = $this->Builder_model->getAppAdminpayments($component_id, $status);

        //$data['payment'] = $this->Builder_model->getAllAppTransaction(12);

        $data['payment_custums'] = $this->Builder_model->getCustomFieldsActive(12);

        $data['payment_type'] = $this->Application_model->getpaymentType();
        $data['campaigns'] = $this->Application_model->getAllCampaigns();

        $data['selected_type'] = $this->request->getPost('type');
        $data['selected_mode'] = $this->request->getPost('mode');

        // By prabhat for certificate payment -- 01-12-2021
        $cert_component_id = 31;

        $selected_field = array('679', '763', '684', '692');
        $data['cert_custums'] = $this->Builder_model->getLimitedCustomFieldsActive($cert_component_id, $selected_field);

        $data['cert_component_id'] = $cert_component_id;
        $data['cert_datas'] = $this->Builder_model->getCertAppAdminpayments($cert_component_id, $status);
        // echo $this->db->last_query();die;
        //echo "<pre>";print_r($data['cer_datas']);echo "</pre>";die;
        // End prabhat for certificate payment --



        $data['content'] = 'backend/course_application';
        $data['page'] = '';
        return view('backend/index', $data);
    }

    function get_tuition_detail()
    {
        if ($this->request->getPost('submit') == 'submit') {
            //campaignsName($user['Campaign'])
            $emp_id = $this->request->getPost('emp_id');
            $data = $this->Application_model->get_tuition_detail($emp_id);
            // echo "<pre>";print_r($this->db->last_query());echo "</pre>";
            $sno = 1;
            echo "<table class='table-striped table-bordered dataTable' style='width:100%;'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th></th>";
            echo "<th>Received Date</th>";
            echo "<th>Payment Type</th>";
            echo "<th>Amount</th>";
            echo "<th>Campaign</th>";
            echo "<th>Receipt Date</th>";
            echo "<th>Added By</th>";
            echo "</tr>";
            echo "</thead>";
            $sn = 1;
            echo '<tbody>';
            foreach ($data as $dt) {
                echo '<tr>';
                echo '<td>';
                echo '<input type="radio" name="tuition_id" class="tuition_id" value="' . $dt['Donor_RowID'] . '">';
                echo '</td>';
                echo '<td>' . date('m/d/Y', strtotime($dt['ReceivedDate'])) . '</td>';
                echo '<td>' . $dt['PaymentType'] . '</td>';
                echo '<td>' . $dt['Amount'] . '</td>';
                echo '<td>' . $dt['CampaignName'] . '</td>';
                echo '<td>' . date('m/d/Y', strtotime($dt['ReceiptDae'])) . '</td>';
                echo '<td>' . $dt['admin_fullname'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }
    }

    function update_donation_value()
    {
        $data = $this->Application_model->update_donation_value();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    function get_donation_detail()
    {
        if ($this->request->getPost('submit') == 'submit') {
            //campaignsName($user['Campaign'])
            $emp_id = $this->request->getPost('emp_id');
            $data = $this->Application_model->get_donation_detail($emp_id);
            // echo "<pre>";print_r($this->db->last_query());echo "</pre>";
            $sno = 1;
            echo "<table class='table-striped table-bordered dataTable' style='width:100%;'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th></th>";
            echo "<th>Received Date</th>";
            echo "<th>Payment Type</th>";
            echo "<th>Amount</th>";
            echo "<th>Campaign</th>";
            echo "<th>Receipt Date</th>";
            echo "<th>Added By</th>";
            echo "</tr>";
            echo "</thead>";
            $sn = 1;
            echo '<tbody>';

            echo '<tbody>';

            if (empty($data)) {
                echo '<style>';
                echo '.already_added{ display:none; }';
                echo '</style>';
            } else {
                echo '<style>';
                echo '.already_added{ display:block; }';
                echo '</style>';
            }

            foreach ($data as $dt) {
                echo '<tr>';
                echo '<td>';
                echo '<input type="radio" name="donation_id" class="donation_id" value="' . $dt['Donor_RowID'] . '">';
                echo '</td>';
                echo '<td>' . date('m/d/Y', strtotime($dt['ReceivedDate'])) . '</td>';
                echo '<td>' . $dt['PaymentType'] . '</td>';
                echo '<td>' . $dt['Amount'] . '</td>';
                echo '<td>' . $dt['CampaignName'] . '</td>';
                echo '<td>' . date('m/d/Y', strtotime($dt['ReceiptDae'])) . '</td>';
                echo '<td>' . $dt['admin_fullname'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }
    }

    function update_donation_student()
    {
        $application_id =   encryptor('decrypt', $this->request->getPost('app_id'));
        $result = $this->Builder_model->updation_donation_student($application_id);
        //echo "<pre>";print_r($this->formbuilder->db->last_query());echo "</pre>";
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function update_donation_tuition()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $application_id =   encryptor('decrypt', $this->request->getPost('app_id'));
            $field_id = 734; //734
            $data = $this->Builder_model->update_donation_tuition($application_id, $field_id);
            $this->db = Database::connect('formbuilder');
            echo $this->db->getLastQuery();
        }
    }

    function add_user_detail()
    {
        if (service('uri')->getSegment(4) == '') {
            die("Something Wrong . .  ");
        }

        $data['country'] = $this->SCBV_model->get_country();
        $data['states'] = $this->SCBV_model->get_all_states();

        //$data1 = $this->Application_model->check_name_incomplete_form2();
        $donar_id = encryptor('decrypt', service('uri')->getSegment(4));
        //echo "<pre>";print_r($donar_id);echo "</pre>";die;
        $component_id = 34;
        $status = 3;
        $data['datas'] = $this->Builder_model->getAppAdminpayments_by_id($component_id, $status, $donar_id);
        $ID = $donar_id;

        // get all active organization 
        $data['all_organization'] = $this->Application_model->getAllActiveOrganization();
        $data['assign_organization'] = $this->Application_model->getAssignOrganization($ID);

        $data['patner_organizations'] = $this->Application_model->getAllActivePartner();
        $data['phonetypes'] = $this->Application_model->get_all_phone_type();
        $data['allnumbers'] = $this->Application_model->get_all_user_number($ID);

        // By prabhat 02-06-2022 for add address type
        $data['address_type'] = $this->Application_model->get_address_type();
        $data['form_id'] = '';
        $data['content'] = 'backend/addForm_part_two.php';
        $data['page'] = '';
        return view('backend/index', $data);
    }

     function get_filter_user()
    {
       // echo "<pre>";print_r($this->request->getPost());echo "</pre>";
        if($this->request->getPost('submit') == 'submit')
        {
            echo "<table class='table-striped table-bordered dataTable' style='width:100%;'>";
            echo "<thead>";
            echo "<tr>";
            
             echo "<th></th>";
             echo "<th style='text-align:left;'>Name</th>";
             echo "<th style='text-align:left;'>Email</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            $data = $this->Application_model->get_filter_user();
            
            
            foreach($data as $dt)
            {
                $get_email = $this->Application_model->getEmailByID($dt['ID']);
                
                $get_email = array_column($get_email, 'Email');
            //echo "<pre>";print_r($get_email);echo "</pre>";
                $get_email = implode(",<br>",$get_email);
                echo "<tr>";
               
                 echo "<td><input type='radio' name='student_name' rel_firstt='".$dt['FirstName']."' rel_lastt='".$dt['LastName']."' value='".$dt['ID']."'></td>";
                 echo "<td style='text-align:left;'>".$dt['FirstName']." ".$dt['LastName']."</td>";
                 echo "<td style='text-align:left;'>".$get_email."</td>";
                echo "</tr>";
                /*echo "<div class='row'>";
                echo "<div class='form-group'>";
                 echo "<div class='col-md-1'>";
                 echo "<input type='radio' name='student_name' value='".$dt['ID']."'>";
                 echo "</div>";
                 echo "<div class='col-md-4'>";
                 echo "<label>".$dt['FirstName']." ".$dt['LastName']."</label>";
                 echo "</div>";
                echo "</div>";
                echo '</div>';*/
            }
            echo "</tbody>";
            echo "</table>";
        }
    }

    function store_tution_detail()
   {
       //echo "<pre>";print_r($this->request->getPost());echo "</pre>";die;
       $data = $this->Builder_model->store_tution_detail();
       
       if($data)
      {
            session()->setFlashdata('msg','Record updated  successfully . ');
	         return redirect()->to('admin/Finance/payments');
       }
      
      
   }

   function store_donation_detail()
    {
        $data = $this->Application_model->store_donation_detail();
        if($data)
        {
            session()->setFlashdata('msg','Record updated  successfully . ');
	         return redirect()->to('admin/Finance/payments');
        }
    
    }

    public function student_billing()
    {
        if($this->request->getPost()) 
        {
            
            $data['student_finance_course'] = $this->Application_model->student_finance_billing2();
             $data['student_finance_certificate_billing'] = $this->Application_model->student_finance_certificate_billing2();
             
            // echo $this->db->last_query();die;
            
            
            $data['semester_acc_class'] = $this->Application_model->getSemester($this->request->getPost('filter_year'));
            $data['selected_filter_year'] = $this->request->getPost('filter_year');
            $data['selected_filter_semester'] = $this->request->getPost('filter_semester');
             
        }
        else
        {
             $data['student_finance_course'] = array();
             $data['semester_acc_class'] = array();
             $data['student_finance_certificate_billing'] = array();
        }
      
       $data['editclass']=$this->Application_model->getAllClass();
       $data['content'] = 'backend/student_billing';
	   $data['page'] = '';
       
	   return view('backend/index',$data);
    }
    
}
