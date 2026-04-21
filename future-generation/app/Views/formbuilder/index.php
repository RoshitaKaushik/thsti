<?php
    	
	echo view('templates/admin_header');
	if(isset($data['sidebar'])){		
		if(isset($data['sidebar']) != 0){			
			//$this->load->view('templates/dashboard_sidebar');			
		}
			
	}else{	
		echo view('templates/admin_sidebar');
	}
	
	
		
?>


<!-- ============================================================== -->
<!-- Start Content here -->
<!-- ============================================================== --> 

                     
<?= view($content, isset($data) ? $data : []) ?>

<!-- ============================================================== -->
<!-- End Content here -->
<!-- ============================================================== -->    


         
<?= view('templates/admin_footer') ?>


