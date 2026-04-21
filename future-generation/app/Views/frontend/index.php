<?php
	// Header
	if($data['page'] == 'front'){
		echo view('templates/front_header', $data);
	}else{
		echo view('templates/dashboard_header');
	}
	
	// Sidebar
	//echo "<pre>";print_r($this->session->userdata());die;
	if($data['page'] == 'front'){
		
	}else{
		if(session()->get('registration_type') == 1 && $this->session->userdata('update_status') != 1){
			
		}else{
			//$this->load->view('templates/dashboard_sidebar');
		}
		
	}
		
?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      

	<?= isset($data['content']) ? view($data['content'], $data) : '' ?>
<!-- ============================================================== -->
<!-- End right Content here -->
<!-- ============================================================== -->             



<?php 
	// Footer
	if($data['page'] == 'front'){
		echo view('templates/front_footer');
	}else{
		echo view('templates/dashboard_footer');
	}
?>