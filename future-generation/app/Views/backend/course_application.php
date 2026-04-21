 

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
    		<!-- Page-Title -->
    		<div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Payments  </h4>
    			</div>
    		</div>
    		
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
    					<div class="panel-heading">
    						<h3 class="panel-title">Payments
        						 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
            						<i class="ion-arrow-left-a"></i>
            						<span><strong>Go Back</strong></span>            
            					</a>
    						</h3>
    					</div>
    					<div class="panel-body">
    					    
    					    
    					    	<?php if(session()->getFlashdata('msg') !=''){ 
                            		  if(session()->getFlashdata('msg')=='CourseID already exist duplicate CourseID not allowed' || session()->getFlashdata('msg')=='Record Already Exist'){
                            		?>
                            		<div class="alert alert-danger">
                            			<?php echo session()->getFlashdata('msg'); ?>
                            		</div>
                            		<?php } else { ?>
                            		<div class="alert alert-success">
                            			<?php echo session()->getFlashdata('msg'); ?>
                            		</div>
                            		<?php } }?>
                            		
                            		
                            		<div class="col-md-12">
                            		    <form method="post" action="<?= base_url() ?>admin/Finance/payments">
                            		        <div class="col-md-1">
                            		            <label>Type :</label>


                            		        </div>
                            		        
                            		        <div class="col-md-3">
                            		            <?= csrf_field() ?>
                            		            <select class="form-control" name="type">
                            		                <option <?php if($selected_type == 2){ echo "selected"; } ?> value="2">All</option>
                            		                <option <?php if($selected_type == 0){ echo "selected"; } ?> value="0">Not Linked</option>
                            		                <option <?php if($selected_type == 1){ echo "selected"; } ?> value="1">Linked</option>
                            		            </select>
                            		        </div>
                            		        
                            		         <div class="col-md-2">
                            		            <label>Mode/Campaign :</label>
                            		        </div>
                            		        
                            		        <div class="col-md-3">
                            		            <select class="form-control" name="mode">
                            		                <option value="">All</option>
                            		                <option <?php if($selected_mode == 'Donation'){ echo "selected"; } ?> value="Donation">Donation</option>
                            		                <option <?php if($selected_mode == 'Tuition'){ echo "selected"; } ?> value="Tuition">Tuition</option>
                            		                <option <?php if($selected_mode == 'Other'){ echo "selected"; } ?> value="Other">Other</option>
                            		            </select>
                            		        </div>
                            		        
                            		        <div class="col-md-2">

                            		            <input type="submit" class="btn btn-success btn-xs" value="Filter">
                            		        </div>
                            		        
                            		      </form> 
                            		        
                            		        
                            		    
                            		</div>
                            		
    						 
    							    <div class="col-sm-12" >
    							        
                                    <div class="table-responsive"  >
                                        <table class=' table-striped table-bordered dataTable' id="country-list" style="width:100%;">
                                            <thead>								
                                    		 <tr>						
                                    		  <th>S.NO</th>	
                                    		  <th>Date & Time</th>
                                    		  
                                    		 <?php 
                                    		  foreach($custums as $c)
                                    		  {  
                                                    if($c['field_type'] !=5)
                                                    {
                                                     echo '<th>'.$string = substr($c['field_name'],0,80).'...'.'</th>';      
                                                    }
                                    		      
                                    		  }
                                    		  ?>
                                    		  <th></th>
                                    		  </tr>							
                                    	      </thead>
                                    	  <?php    
                                            
                                	      if($datas)
	                                      {
	                                          $i=1;
                                    	      foreach($datas as $dt)
                                    	      {
	          
	                                                  $component_details = get_componentsByID($component_id);
	                                                $datafield_details = getCustomFieldsActivename($component_id);
	          $index =  array_search('name', array_map('strtolower', array_column($datafield_details, 'field_name')));
             if($index == ''){
				$index =  array_search('student full name', array_map('strtolower', array_column($datafield_details, 'field_name')));
				if($index == ''){
					$index =  array_search('first name', array_map('strtolower', array_column($datafield_details, 'field_name')));
					if($index == ''){
						$index =  array_search('student name', array_map('strtolower', array_column($datafield_details, 'field_name')));
						if($index == ''){
							$index =  array_search('printed name', array_map('strtolower', array_column($datafield_details, 'field_name')));
							if($index == ''){
							$index =  array_search('1. last (family) name:', array_map('strtolower', array_column($datafield_details, 'field_name')));
						}
						}
					}
				}
			}								
        	$field_value=get_custom_fields_values_custom($dt['application_code'], $datafield_details[$index]['field_id']);
        	 echo '<tr>';
        	  echo '<td>'.$i++.'</td>';
        	  echo "<td data-sort='".$dt['created_date']."'>".date('m/d/Y, H:i A', strtotime($dt['created_date']))."</td>";
        	  
        	  
    		      
    		      
    		     
		                
		                
		          $name1 = $field_value['field_value'];    
		          
		         
		          
		          
		          
		          
		         
    		      
    		      
    		      
    		  
    		   $ff_value=0;
    		   $pay_type = '';
    		   $user_email = '';
    		   $get_name = '';
            	foreach($custums as $c)
		        {
		            if($c['field_type'] != 5)
		            {
		                
		                $field_value=get_custom_fields_values_custom($dt['application_code'], $c['field_id']);
		                echo '<td>'.$field_value['field_value'].'</td>';
		                if($c['field_id'] == 722)//623
		                {
		                    $get_name = $field_value['field_value'];;
		                }
		                if($c['field_id'] == 723)//624
		                {
		                    $user_email = $field_value['field_value'];;
		                }
		                if($c['field_id']==733)//632
		                {
		                    $ff_value = $field_value['field_value'];
		                }
		                if($c['field_id']==734)//633
		                { 

		                    $pay_type = $field_value['field_value'];
		                }
		            }
		            
		            
		            
		        }
		        
		         $check_email = array();
		         
		         if($user_email != '')
		         {
		             $check_email = check_email_of_user($user_email);
		         }
		         $check_name = array();
		         if($get_name !='')
		         {
		             $check_name = check_name_incomplete_form2($get_name);
		         }
		         
		          if(sizeof($check_email) >0)
		          {
		              
		              $check_name = get_user_detail_by_id($check_email['EmailID']);
		              //echo '<td  style="text-align:center;"><a href="'.base_url().'admin/Form/ViewApp/'.$check_name['ID'].'?applicatant_id='.$dt['application_id'].'#tab3" target="_blank"><span class="btn btn-warning btn-xs">Get Details</span></a></td>';
		              //echo "<pre>";print_r($check_name);echo "</pre>";
		              $check_data_state1 = check_data_state($dt['application_id']);
		              if($check_data_state1)
		              {
		                  echo '<td  style="text-align:center;"><a href="'.base_url().'admin/Form/ViewApp/'.$check_email['EmailID'].'#tab3" target="_blank"><span class="btn btn-success btn-xs">Linked</span></a>';
		                 // echo "<pre>";print_r($check_email);echo "</pre>";
		                  echo '</td>';
		              }
		              else
		              {
		                  if($pay_type == 'Tuition Fee')
		                  {
		                    echo '<td data-sort="'.$dt['created_date'].'" style="text-align:center;"><span rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'" rel_id="'.$check_email['EmailID'].'" rel_app_id = "'.$dt['application_id'].'"  rel_first="'.$check_name['FirstName'].'" rel_last="'.$check_name['LastName'].'" rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-warning get_detail_tuition btn-xs">Link</span>';
		              
		                    echo '</td>';    
		                  }
		                  else
		                  {
		                     echo '<td   data-sort="'.$dt['created_date'].'" style="text-align:center;"><span rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'" rel_id="'.$check_email['EmailID'].'" rel_app_id = "'.$dt['application_id'].'"  rel_first="'.$check_name['FirstName'].'" rel_last="'.$check_name['LastName'].'" rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-warning get_detail btn-xs">Link</span>';
		              
		                    echo '</td>'; 
		                  }
		                  


		              }
		             
		          }
		          else if(sizeof($check_name)>0)
		          {
		              
		              $check_data_state1 = check_data_state($dt['application_id']);
		              if($check_data_state1)
		              {
		                  echo '<td  style="text-align:center;"><a href="'.base_url().'admin/Form/ViewApp/'.$check_name['ID'].'#tab3" target="_blank"><span class="btn btn-success btn-xs">Linked</span></a>';
		                 // echo "<pre>";print_r($check_email);echo "</pre>";
		                  echo '</td>';
		              }
						else if($pay_type =='Other')
		              {
		                   echo '<td  style="text-align:center;"><span class="btn btn-success btn-xs">Linked</span>';
		                   echo '</td>';  
		              }
		              else
		              {
		                   if($pay_type == 'Tuition Fee')
		                  {
		                    echo '<td  data-sort="'.$dt['created_date'].'" style="text-align:center;"><span rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'" rel_id="'.$check_name['ID'].'" rel_app_id = "'.$dt['application_id'].'"  rel_first="'.$check_name['FirstName'].'" rel_last="'.$check_name['LastName'].'" rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-warning get_detail btn-xs">Link</span>';
		              
		                    echo '</td>';    
		                  }
		                  else
		                  {
		                      echo '<td  data-sort="'.$dt['created_date'].'" style="text-align:center;"><span rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'" rel_id="'.$check_name['ID'].'" rel_app_id = "'.$dt['application_id'].'"  rel_first="'.$check_name['FirstName'].'" rel_last="'.$check_name['LastName'].'" rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-warning get_detail btn-xs">Link</span>';
		                  echo '</td>';
		                  }
		                 

		              }
		              
		              
		              
		          }
		          else
		          {
		               if($pay_type == 'Other')
	                  {
	                      echo "<td><span class='btn btn-success btn-xs'>Linked</span></td>";
	                  }

	                  else if($pay_type == 'Donation')
	                  {


					echo '<td  style="text-align:center;">';
	                       $check_data_state1 = check_data_state($dt['application_id']);
	                       if($check_data_state1)
    		              {
    		                 // echo "<pre>";print_r($check_data_state1);echo "</pre>";
    		                  echo '<a href="'.base_url().'admin/Form/ViewApp/'.$check_data_state1['DonorID'].'#tab3" target="_blank"><span class="btn btn-success btn-xs">Linked</span></a>';
    		                 // echo "<pre>";print_r($check_email);echo "</pre>";
    		                 
    		              }
	                      else if($dt['user_id'] != 0)
	                      {
	                          $check_name = get_user_detail_by_id($dt['user_id']);
	                         echo '<span rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'" rel_id="'.$dt['user_id'].'" rel_app_id = "'.$dt['application_id'].'"  rel_first="'.$check_name['FirstName'].'" rel_last="'.$check_name['LastName'].'" rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-warning get_detail_tuition btn-xs">link</span>';
		              
		                     
	                      }
	                      else
	                      {
	                        echo '<span app_id="'.$dt['application_id'].'" rel_id="'.encryptor('encrypt', $dt['application_id']).'" rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'"   rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-primary btn-xs update_tuition">match & Link</span>';   
	                      }
	                      echo '</td>';
	                      
		                  // echo '<td style="text-align:center;"><span class="btn btn-danger btn-xs"><a style="color:#ffffff;" onclick="return myFunction()" href="'.base_url().'admin/Finance/add_user_detail/'.encryptor('encrypt', $dt['application_id']).'">Match & Link</a></span></td>';   
	                  }


	                  else
	                  {
	                      echo '<td style="text-align:center;">';
	                       $check_data_state1 = check_data_state($dt['application_id']);
	                       if($check_data_state1)
    		              {
    		                 // echo "<pre>";print_r($check_data_state1);echo "</pre>";
    		                  echo '<a href="'.base_url().'admin/Form/ViewApp/'.$check_data_state1['DonorID'].'#tab3" target="_blank"><span class="btn btn-success btn-xs">Linked</span></a>';
    		                 // echo "<pre>";print_r($check_email);echo "</pre>";
    		                 
    		              }
	                       
	                      else if($dt['user_id'] != 0)
	                      {
	                          $check_name = get_user_detail_by_id($dt['user_id']);
	                        echo '<span rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'" rel_id="'.$dt['user_id'].'" rel_app_id = "'.$dt['application_id'].'"  rel_first="'.$check_name['FirstName'].'" rel_last="'.$check_name['LastName'].'" rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-warning get_detail_tuition btn-xs">link</span>';
		              
		                     
	                      }
	                      else
	                      {
	                        echo '<span app_id="'.$dt['application_id'].'" rel_id="'.encryptor('encrypt', $dt['application_id']).'" rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'"   rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-primary btn-xs update_tuition">match & Link</span>';   
	                      }
	                      echo '</td>';
						 // echo '<td style="text-align:center;"><span class="btn btn-danger btn-xs"><a style="color:#ffffff;" onclick="return myFunction1()" href="'.base_url().'admin/Finance/add_user_detail/'.encryptor('encrypt', $dt['application_id']).'?user_type=student">New User</a></span></td>';  
	                     
	                  }

	             }


	       
	       
	       /* echo '<td>'.$field_value['field_value'].'</td>';
	        echo '<td>'.$component_details[0]['scheme_component_name'].'</td>';
	        echo '<td>'.dd_mm_yyyy($dt['created_date']).'</td>';*/
	        echo '</tr>';
	      }
	                                      }
	      ?>
                                        </table>
                                        
                                      
                                        
                                        
                                        
                                   </div>
                                </div>
								
								
								
								
								
								
								 <!-- Certificate Payment -->
                                  <div class="col-sm-12" >
                                      <hr/>
    							        <h3>Certificate Payments</h3>
                                    <div class="table-responsive"  >
                                        <table class=' table-striped table-bordered dataTable' id="SemesterListing" style="width:100%;">
                                            <thead>								
                                    		 <tr>						
                                    		  <th>S.NO</th>	
                                    		  <th>Date & Time</th>
                                    		  <?php 
                                    		   foreach($cert_custums as $c)
                                    		   {  
                                                    if($c['field_type'] !=5)
                                                    {
                                                     echo '<th>'.$string = substr($c['field_name'],0,80).'...'.'</th>';      
                                                    } 
                                    		   }
                                    		  ?>
                                    		  <th></th>
                                    		  </tr>							
                                    	      </thead>
                                    	  <?php    
                                            
                                	      if($cert_datas)
	                                      {
	                                         
	                                          $i=1;
                                    	      foreach($cert_datas as $dt)
                                    	      {
	          
	                                                  $cert_component_details = get_componentsByID($cert_component_id);
	                                                $cert_datafield_details = getCustomFieldsActivename($cert_component_id);
													  $index =  array_search('name', array_map('strtolower', array_column($cert_datafield_details, 'field_name')));
													 if($index == ''){
														$index =  array_search('student full name', array_map('strtolower', array_column($cert_datafield_details, 'field_name')));
														if($index == ''){
															$index =  array_search('first name', array_map('strtolower', array_column($cert_datafield_details, 'field_name')));
															if($index == ''){
																$index =  array_search('student name', array_map('strtolower', array_column($cert_datafield_details, 'field_name')));
																if($index == ''){
																	$index =  array_search('printed name', array_map('strtolower', array_column($cert_datafield_details, 'field_name')));
																	if($index == ''){
																	$index =  array_search('1. last (family) name:', array_map('strtolower', array_column($cert_datafield_details, 'field_name')));
																}
																}
															}
														}
													}								
													$field_value=get_custom_fields_values_custom($dt['application_code'], $cert_datafield_details[$index]['field_id']);
													 echo '<tr>';
													  echo '<td>'.$i++.'</td>';
													  echo "<td>".date('d-m-Y, H:i A', strtotime($dt['created_date']))."</td>";
													  
													  
																
														  $name1 = $field_value['field_value'];    
														  
														 
														  
														  
														  
														  
														 
														  
														  
														  
													  
													   $ff_value=0;
													   $pay_type = '';
													   
														$pay_type = '26';
													   $user_email = '';
													   $get_name = '';
													    $last_name = '';
														foreach($cert_custums as $c)
														{
															if($c['field_type'] != 5)
															{
																
																$field_value=get_custom_fields_values_custom($dt['application_code'], $c['field_id']);
																echo '<td>'.$field_value['field_value'].'</td>';
																if($c['field_id'] == 679)//722
																{
																	$get_name = $field_value['field_value'];;
																}
																if($c['field_id'] == 763)//722
																{
																	$last_name = $field_value['field_value'];;
																}
																if($c['field_id'] == 684)//723
																{
																	$user_email = $field_value['field_value'];;
																}
																if($c['field_id']==692)//733
																{
																	$ff_value = $field_value['field_value'];
																}
																
															}
															
															
															
														}
														
														 $check_email = array();
														 
														 if($user_email != '')
														 {
															 $check_email = check_email_of_user($user_email);
														 }
														 $check_name = array();
														 if($get_name !='')
														 {
															 $check_name = check_first_last_name_incomplete_form($get_name,$last_name);
														 }
														 
														  if(sizeof($check_email) >0)
														  {
															  
															  $check_name = get_user_detail_by_id($check_email['EmailID']);
															  //echo '<td  style="text-align:center;"><a href="'.base_url().'admin/Form/ViewApp/'.$check_name['ID'].'?applicatant_id='.$dt['application_id'].'#tab3" target="_blank"><span class="btn btn-warning btn-xs">Get Details</span></a></td>';
															  //echo "<pre>";print_r($check_name);echo "</pre>";
															  $check_data_state1 = check_data_state($dt['application_id']);
															  if($check_data_state1)
															  {
																  echo '<td  style="text-align:center;"><a href="'.base_url().'admin/Form/ViewApp/'.$check_email['EmailID'].'#tab3" target="_blank"><span class="btn btn-success btn-xs">Linked</span></a>';
																 // echo "<pre>";print_r($check_email);echo "</pre>";
																  echo '</td>';
															  }
															  else
															  {
																  if($pay_type == 'Tuition')
																  {
																	echo '<td  style="text-align:center;"><span rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'" rel_id="'.$check_email['EmailID'].'" rel_app_id = "'.$dt['application_id'].'"  rel_first="'.$check_name['FirstName'].'" rel_last="'.$check_name['LastName'].'" rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-warning get_detail_tuition btn-xs">link</span>';
															  
																	echo '</td>';    
																  }
																  else
																  {
																	 echo '<td  style="text-align:center;"><span rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'" rel_id="'.$check_email['EmailID'].'" rel_app_id = "'.$dt['application_id'].'"  rel_first="'.$check_name['FirstName'].'" rel_last="'.$check_name['LastName'].'" rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-warning get_detail btn-xs">link</span>';
															  
																	echo '</td>'; 
																  }
																  


															  }
															 
														  }
														  else if(sizeof($check_name)>0)
														  {
															  
															  $check_data_state1 = check_data_state($dt['application_id']);
															  if($check_data_state1)
															  {
																  echo '<td  style="text-align:center;"><a href="'.base_url().'admin/Form/ViewApp/'.$check_name['ID'].'#tab3" target="_blank"><span class="btn btn-success btn-xs">Linked</span></a>';
																 // echo "<pre>";print_r($check_email);echo "</pre>";
																  echo '</td>';
															  }
															  else if($pay_type =='Other')
															  {
																   echo '<td  style="text-align:center;"><span class="btn btn-success btn-xs">Linked</span>';
																   echo '</td>';  
															  }
																
															  else
															  {
																   if($pay_type == 'Tuition Fee')
																  {
																	echo '<td  style="text-align:center;"><span rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'" rel_id="'.$check_name['ID'].'" rel_app_id = "'.$dt['application_id'].'"  rel_first="'.$check_name['FirstName'].'" rel_last="'.$check_name['LastName'].'" rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-warning get_detail btn-xs">link</span>';
															  
																	echo '</td>';    
																  }
																  else
																  {
																	  echo '<td  style="text-align:center;"><span rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'" rel_id="'.$check_name['ID'].'" rel_app_id = "'.$dt['application_id'].'"  rel_first="'.$check_name['FirstName'].'" rel_last="'.$check_name['LastName'].'" rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-warning get_detail btn-xs">link</span>';
																   //echo "<pre>";print_r($check_data_state1);echo "</pre>";
																  echo '</td>';
																  }
																 

															  }
															  
															  
															  
														  }
														  else
														  {
															   if($pay_type == 'Other')
															  {
																  echo "<td><span class='btn btn-success btn-xs'>Linked</span></td>";
															  }

															  else  if($pay_type == 'Donation')
															  {
																  
																  echo '<td style="text-align:center;">';
																   $check_data_state1 = check_data_state($dt['application_id']);
																   if($check_data_state1)
																  {
																	 // echo "<pre>";print_r($check_data_state1);echo "</pre>";
																	  echo '<a href="'.base_url().'admin/Form/ViewApp/'.$check_data_state1['DonorID'].'#tab3" target="_blank"><span class="btn btn-success btn-xs">Linked</span></a>';
																	 // echo "<pre>";print_r($check_email);echo "</pre>";
																	 
																  }
																  else if($dt['user_id'] != 0)
																  {
																	  $check_name = get_user_detail_by_id($dt['user_id']);
																	 echo '<span rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'" rel_id="'.$dt['user_id'].'" rel_app_id = "'.$dt['application_id'].'"  rel_first="'.$check_name['FirstName'].'" rel_last="'.$check_name['LastName'].'" rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-warning get_detail_tuition btn-xs">link</span>';
															  
																	 
																  }
																  else
																  {
																	echo '<span app_id="'.$dt['application_id'].'" rel_id="'.encryptor('encrypt', $dt['application_id']).'" rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'"   rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-primary btn-xs update_tuition">match & Link</span>';   
																  }
																  echo '</td>';
																  
																  // echo '<td style="text-align:center;"><span class="btn btn-danger btn-xs"><a style="color:#ffffff;" onclick="return myFunction()" href="'.base_url().'admin/Finance/add_user_detail/'.encryptor('encrypt', $dt['application_id']).'">Match & Link</a></span></td>';   
															  }
															  else
															  {
																  echo '<td style="text-align:center;">';
																   $check_data_state1 = check_data_state($dt['application_id']);
																   if($check_data_state1)
																  {
																	 // echo "<pre>";print_r($check_data_state1);echo "</pre>";
																	  echo '<a href="'.base_url().'admin/Form/ViewApp/'.$check_data_state1['DonorID'].'#tab3" target="_blank"><span class="btn btn-success btn-xs">Linked</span></a>';
																	 // echo "<pre>";print_r($check_email);echo "</pre>";
																	 
																  }
																   
																  else if($dt['user_id'] != 0)
																  {
																	  $check_name = get_user_detail_by_id($dt['user_id']);
																	echo '<span rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'" rel_id="'.$dt['user_id'].'" rel_app_id = "'.$dt['application_id'].'"  rel_first="'.$check_name['FirstName'].'" rel_last="'.$check_name['LastName'].'" rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-warning get_detail_tuition btn-xs">link</span>';
															  
																	 
																  }
																  else
																  {
		//check other or not 2022
	                          $check_linked = check_linked_or_not($dt['application_id']);
	                          if($check_linked)
	                          {
	                              echo '<span class="btn btn-success btn-xs">Linked</span>';
	                          }
	                          else
	                          {														echo '<span app_id="'.$dt['application_id'].'" rel_id="'.encryptor('encrypt', $dt['application_id']).'" rel_created="'.date('Y-m-d', strtotime($dt['created_date'])).'" rel_email="'.$user_email.'"   rel_amount="'.$ff_value.'" rel_pay="'.$pay_type.'" class="btn btn-primary btn-xs update_tuition">match & Link</span>'; 
							  }						  
																  }
																  echo '</td>';
																 // echo '<td style="text-align:center;"><span class="btn btn-danger btn-xs"><a style="color:#ffffff;" onclick="return myFunction1()" href="'.base_url().'admin/Finance/add_user_detail/'.encryptor('encrypt', $dt['application_id']).'?user_type=student">New User</a></span></td>';  
																 
															  }

														 }


												   
												   
												   /* echo '<td>'.$field_value['field_value'].'</td>';
													echo '<td>'.$component_details[0]['scheme_component_name'].'</td>';
													echo '<td>'.dd_mm_yyyy($dt['created_date']).'</td>';*/
													echo '</tr>';
												  }
	                                      }
	                                    ?>
                                        </table>
                                        
                                      
                                        
                                        
                                        
                                   </div>
                               </div>
                                  <!-- End Certificate   -->
                               
                               
                               <style>
                                   td
                                   {
                                       padding:10px;
                                   }
                                   th
                                   {
                                       padding:10px;
                                   }
                                   .buttons-excel 
                                   {
                                       display:none;
                                   }
                               </style>
								
								
								
								
								
								
								
								
								
                          
    						
    					</div>
    				</div>
    			</div>
    			
    		</div> <!-- End Row -->           
        </div> <!-- container -->
     
	</div> <!-- content -->
</div> <!-- content-page -->

  
  
<!-- Modal -->
  <div class="modal fade" id="confirm_box" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Details</h4>
        </div>
          <form action="<?= base_url() ?>admin/Finance/store_donation_detail" method="post">
            <div class="modal-body">
            
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Contact ID</label>

                            <input type="text" readonly class="form-control" name="emp_id" id="emp_id">
                            <input type="hidden" class="form-control" name="app_id" id="app_id"> 
                            <?= csrf_field() ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" readonly class="form-control" id="first_name">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" readonly class="form-control" id="email">
                        </div>
                    </div>
                </div>
                
                <!-- Second row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" readonly class="form-control" name="amount" id="amount">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Payment Type</label>
                            <select class="form-control" name="pay_type" id="pay_type" required>
                                <option value="">Select Payment Type</option>
                                <?php foreach($payment_type as $row){?>
                    				<option <?php if($row['PayType'] == 'Online'){ echo "selected"; } ?> value="<?php echo $row['PayType'];?>"><?php echo $row['PayType'];?>
                    			
                    			<?php } ?>
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Campaign</label>
                            <select name="Campaign" id="Campaign" class="form-control" required>
                			<option value="">Select Campaign</option>
                			<?php foreach($campaigns as $rows){?>
                			<option value="<?php echo $rows['CampaignID'];?>"><?php echo $rows['CampaignName'];?></option>
                			<?php }?>
                			</select>
                            
                        </div>
                    </div>
                </div>
                <!-- End Second row -->
                
                <!-- Third Row --> 
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Received Date</label>
                            <!--input type="date" name="receive_date" id="receive_date" class="form-control" required-->
							<div class="input-group date" data-provide="datepicker">
                        		<input  class="form-control datepickerbackward"  name="receive_date" id="receive_date"  type="text" required>
                            	<div class="input-group-addon">
                            	   <span class="glyphicon glyphicon-th"></span>
                            	</div>
                        	</div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Receipt Date</label>
                            <!--input type="date" name="receipt_date" id="receipt_date" class="form-control" required-->
							<div class="input-group date" data-provide="datepicker">
                        		<input  class="form-control datepickerbackward"  name="receipt_date" id="receipt_date"  type="text" required>
                            	<div class="input-group-addon">
                            	   <span class="glyphicon glyphicon-th"></span>
                            	</div>
                        	</div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Added Date</label>
                            <!--input type="date" readonly name="addedd_date" value="<?= date('Y-m-d') ?>" class="form-control" required-->
							<div class="input-group date" data-provide="datepicker">
                        		<input  class="form-control datepickerbackward" value="<?= date('m/d/Y') ?>"  readonly name="addedd_date" id="addedd_date"  type="text" required>
                            	<div class="input-group-addon">
                            	   <span class="glyphicon glyphicon-th"></span>
                            	</div>
                        	</div>

                        </div>
                    </div>
                    
                    
                </div>
                <!-- End Third Row -->
                <!-- Start Fourth row -->
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Note</label>
                              <textarea class="form-control" name="note"></textarea>
                          </div>
                      </div>
                  </div>
                <!-- End Fourth row -->
                
                <div class="row">
                      <div class="col-md-12" style="overflow-y:scroll;height:150px;">
                          <div id="result">
                              
                          </div>
                      </div>
                  </div>
                
                
                
                
            </div>
            
            
          
        </div>
            <div class="modal-footer">
            <div class="col-md-12" style="margin-top:40px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary already_added">Already Added</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" onclick="return confirm_button();">Save</button>
                        </div>
                    </div>
                    
                </div>
            </div>
          
        </div>
          </form>
      </div>
      
    </div>
  </div>



<!-- Modal -->
  <div class="modal fade" id="update_tuition_modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Details</h4>
        </div>
          <form action="<?= base_url() ?>admin/Finance/store_tution_detail" method="post">
            <div class="modal-body">
            
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Contact ID</label>
                            <input type="text" readonly class="form-control" name="emp_id" id="part_emp_id">
                            <input type="hidden" class="form-control" name="app_id" id="part_app_id"> 
                            <?= csrf_field() ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" readonly class="form-control" id="part_first_name">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" readonly class="form-control" id="part_email">
                        </div>
                    </div>
                </div>
                
                <!-- Second row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" readonly class="form-control" name="amount" id="part_amount">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Payment Type</label>
                            <select class="form-control" name="pay_type" id="part_pay_type" required>
                                <option value="">Select Payment Type</option>
                                <?php foreach($payment_type as $row){?>
                    				<option <?php if($row['PayType'] == 'Online'){ echo "selected"; } ?> value="<?php echo $row['PayType'];?>"><?php echo $row['PayType'];?>
                    			
                    			<?php } ?>
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Campaign</label>
                            <select name="Campaign" id="part_Campaign" class="form-control" required>
                			<option value="">Select Campaign</option>
                			<?php foreach($campaigns as $rows){?>
                			<option <?php if($rows['CampaignID'] == 18){echo "selected";} ?> value="<?php echo $rows['CampaignID'];?>"><?php echo $rows['CampaignName'];?></option>
                			<?php }?>
                			</select>
                            
                        </div>
                    </div>
                </div>
                <!-- End Second row -->
                
                <!-- Third Row --> 
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Received Date</label>
                            <input type="date" name="receive_date" id="part_receive_date" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Receipt Date</label>
                            <input type="date" name="receipt_date" id="part_receipt_date" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Added Date</label>
                            <input type="date" readonly name="addedd_date" value="<?= date('Y-m-d') ?>" class="form-control" required>
                        </div>
                    </div>
                    
                    
                </div>
                <!-- End Third Row -->
                <!-- Start Fourth row -->
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Note</label>
                              <textarea class="form-control" name="note"></textarea>
                          </div>
                      </div>
                  </div>
                <!-- End Fourth row -->
                
                <div class="row">
                      <div class="col-md-12" style="overflow-y:scroll;height:200px;overflow-x:scroll;">
                          
                        <span id="result_part"></span>     

                      </div>
                  </div>
                
                
                
                
            </div>
            
            
          
        </div>
            <div class="modal-footer">
            <div class="col-md-12" style="margin-top:40px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary already_added_tuition">Already Added</button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" onclick="return confirm_tuition_button();">Save</button>
                        </div>
                    </div>
                    
                </div>
            </div>
          
        </div>
          </form>
      </div>
      
    </div>
  </div>


    
  


 <div class="modal fade" id="confirm_myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Alert</h4>
        </div>
        <div class="modal-body">
           <div class="form-group">
               <div class="row">
					<div class="col-md-12">
                       <input type="hidden" class="form-control confirm_donor_id">
                       
                       
                       <input type="hidden" class="form-control filter_amount">
                       <input type="hidden" class="form-control filter_email">
                       <input type="hidden" class="form-control filter_added">
                       <input type="hidden" class="form-control filter_app_id">
                       
                       <input type="radio" name="tuition_type" value="other">&nbsp;Other&nbsp;&nbsp;
                       <input type="radio" name="tuition_type" value="tuition">&nbsp;Filter User&nbsp;&nbsp;
                       <!--input type="radio" name="tuition_type" value="donation">&nbsp;Donation-->
                   </div>
                   
               </div>
           </div>
           
           <div class="form-group">
               <div class="row filter_part" style="display:none;">
                   <div class="col-md-4">
                       <label>Name</label>
                       <input type="text" class="form-control" id="filter_name">
                   </div>
                   
                   <div class="col-md-4">
                       <label>Email</label>
                       <input type="text" class="form-control" id="filter_email">
                   </div>
                   <div class="col-md-4">
                       <label>&nbsp;</label><br>
                       <span class="btn btn-success btn-xs filter_button">Filter</span>
                   </div>
                   
               </div>
                 
                 
                <div id="filter_result" class="filter_part" style="height:300px;overflow-y:scroll;display:none;">
                       
                   </div>
               
           </div>
           
        </div>
        <div class="modal-footer">
          
          
          <a id="href_value" onclick="return confirmFunction()" target="_blank" > 
              <button type="button" class="btn btn-primary btn-xs">Create new student</button>
           </a>
          
          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success btn-xs tuition_submit">Submit</button>
        </div>
      </div>
      
    </div>
  </div>

  <style>
      .modal-content
      {
          border-color: #000000 ! important;
      }
      
  </style>


<script type="text/javascript">

$(document).ready(function(){
    $("input[name='tuition_type']").change(function(){
        var data = $(this).val();
         if(data == 'other')
         {
             $('#filter_result').html('');
             $('.filter_part').hide();
         }
         else
         {
             $('.filter_part').show();
         }
    });
})

$(document).on('click','.filter_button',function(){
    var name = $('#filter_name').val();
    var email = $('#filter_email').val();
     $.ajax({
         url:'<?=base_url()?>admin/Finance/get_filter_user',
         method: 'post',
         data: {name:name,email:email,submit:'submit',"<?= csrf_token(); ?>":"<?= csrf_hash(); ?>"},
         dataType: 'html',
         success: function(response){
           $('#filter_result').html(response);
         }
       });
})

$(document).on('click','.tuition_submit',function(){
   var value =  $("input[name='tuition_type']:checked").val();
   var donor_id = $('.confirm_donor_id').val();
   if(!$("input:radio[name='tuition_type']").is(":checked")) {
      alert('Please select type');
  }
  else if(value =='other')
  { 
        if(confirm("Really you want to change payment type from tuition to other!"))
        {
            $.ajax({
             url:'<?=base_url()?>admin/Finance/update_donation_tuition',
             method: 'post',
             data: {app_id:donor_id,submit:'submit',"<?= csrf_token() ?> : <?= csrf_hash() ?>"},
             dataType: 'html',
             success: function(response){
                window.location.href="";
             }
           });
        }
  }
  else if(value =='tuition')
  {
		 var student_id=  $("input[name='student_name']:checked").val();
      var emp_id = student_id;
      
    var rel_amount = $('.filter_amount').val();
    var app_id     = $('.filter_app_id').val();
    var pay_type   = 'tuition';
    var user_email = $('.filter_email').val();
      
      
      if($("input:radio[name='student_name']").is(":checked")) {
          
          var first_name = $("input[name='student_name']:checked").attr('rel_firstt');
          var last_name = $("input[name='student_name']:checked").attr('rel_lastt');
          
               $.ajax({
                 url:'<?=base_url()?>admin/Finance/update_donation_student',
                 method: 'post',
                 data: {app_id:donor_id,submit:'submit',student_id:student_id,type:value,"<?= csrf_token() ?> : <?= csrf_hash() ?>"},
                 dataType: 'html',
                 success: function(response){
                    //window.location.href="";
                    
                    
                    var created = $('.filter_added').val();
                    $('#emp_id').val(emp_id);
                    $('#first_name').val(first_name+" "+last_name);
                    $('#email').val(user_email);
                    $('#amount').val(rel_amount);
                    $('#app_id').val(app_id);  
                    $('#receive_date').val(format(created));
                    
                    $.ajax({
                         url:'<?=base_url()?>admin/Finance/get_donation_detail',
                         method: 'post',
                         data: {emp_id: emp_id,"submit":"submit","<?= csrf_token() ?> : <?= csrf_hash() ?>"},
                         dataType: 'html',
                         success: function(response){
                          $('#result').html(response);
                          $('#confirm_myModal').modal('hide');
                         }
                       });
                
                    $('#confirm_box').modal('show');
                    
                    
                 } 
               });
          }
          else
          {
              alert("Please select Student");
          }
      
      //var url = "<?= base_url() ?>admin/Finance/add_user_detail/"+donor_id+"?user_type=student";
      //window.open(url);
  }
  
   
   
})
 function myFunction() {
 if(confirm("Really you want to create new user as a Donar"))
 {
     return true;
 }
 else
 {
     return false;
 }
}

function myFunction1() {
 if(confirm("Really you want to create new user as a Student"))
 {
     return true;
 }
 else
 {
     return false;
 }
}

function confirm_tuition_button()
{
    var val = [];
    var total_amount = 0;
    var pay_amount = $('#part_amount').val();
    var student_id = $('#part_emp_id').val();
    $('.check_course_id:checked').each(function(i){
      val[i] = $(this).val();
    });
    
    
        /*for (k = 0; k < val.length; k++) {
            //alert(val[k]);
          current_val = $('#type_id'+val[k]).val();
         
          total_amount =total_amount+parseInt(current_val);
        }
        //alert("pay_amount :"+pay_amount+"total_amount :"+total_amount);
        if(val.length == 0)
        {
            alert("Please select course");
          return false;  
        }
        else if(pay_amount >= total_amount)
        {
            return true;
        }
        else
        {
            alert("Course Tuition is high to tuition fees");
            return false;
        }*/
		return true;

   
}

$(document).ready(function() {
    $('#alldataTable1').DataTable( {
      
       // "order": [[ 0, "ASC" ]],
		"pageLength": 30
    } );
} );

function confirmFunction()
{
    if(confirm("Really you want to create a new student !"))
    {
        return true;
    }
    else
    {
        return false;
    }
}

$(document).on('click','.update_tuition',function(){
    var rel_id = $(this).attr('rel_id');
	$('.confirm_donor_id').val(rel_id);
	var rel_amount = $(this).attr('rel_amount');
     var pay_type   = $(this).attr('rel_pay');
     var rel_create = $(this).attr('rel_created');
     var rel_email  = $(this).attr('rel_email');
      //var rel_added  = $(this).attr('rel_added');
      var rel_app_id= $(this).attr('app_id');
     
     $('.filter_amount').val(rel_amount);
      $('.filter_email').val(rel_email);
      $('.filter_added').val(rel_create);
      $('.filter_app_id').val(rel_app_id);
       
      
     
    $('#href_value').attr("href","<?= base_url() ?>admin/Finance/add_user_detail/"+rel_id+"?user_type=student");
    $('#confirm_myModal').modal('show');									
 
    
    
})

$(document).on('click','.already_added',function(){
   var data = $("input[name='donation_id']:checked");
   if (data.length > 0)
   {
      data = data.val();
      emp_id = $('#emp_id').val();
      app_id = $('#app_id').val();
      $.ajax({
         url:'<?=base_url()?>admin/Finance/update_donation_value',
         method: 'post',
         data: {emp_id: emp_id,app_id:app_id,donar_id:data,"<?= csrf_token() ?> : <?= csrf_hash() ?>"},
         dataType: 'html',
         success: function(response){
          window.location.href="";
         }
       });
      
   }
   else
   {
       alert("Please Select any donation value")
   }
})


$(document).on('click','.already_added_tuition',function(){
   var data = $("input[name='tuition_id']:checked");
   if (data.length > 0)
   {
      data = data.val();
      emp_id = $('#part_emp_id').val();
      app_id = $('#part_app_id').val();
      $.ajax({
         url:'<?=base_url()?>admin/Finance/update_donation_value',
         method: 'post',
         data: {emp_id: emp_id,app_id:app_id,donar_id:data,"<?= csrf_token() ?> : <?= csrf_hash() ?>"},
         dataType: 'html',
         success: function(response){
          window.location.href="";
         }
       });
      
   }
   else
   {
       alert("Please Select any tuition value")
   }
})
$(document).on('click','.get_detail_tuition',function(){
    
    var emp_id = $(this).attr('rel_id');
    var first_name = $(this).attr('rel_first');
    var last_last  = $(this).attr('rel_last');
    var rel_amount = $(this).attr('rel_amount');
    var app_id     = $(this).attr('rel_app_id');
    var pay_type   = $(this).attr('rel_pay');
    var user_email = $(this).attr('rel_email');
    
    var created = $(this).attr('rel_created');
    
     $('#part_emp_id').val(emp_id);
    $('#part_first_name').val(first_name+" "+last_last);
    $('#part_email').val(user_email);
    $('#part_amount').val(rel_amount);
    //$('#pay_type').val(pay_type);
    $('#part_app_id').val(app_id);  
    $('#part_receive_date').val(created);
    
    $.ajax({
         url:'<?=base_url()?>admin/Finance/get_tuition_detail',
         method: 'post',
         data: {emp_id: emp_id,"submit":"submit","<?= csrf_token() ?> : <?= csrf_hash() ?>"},
         dataType: 'html',
         success: function(response){
          $('#result_part').html(response);
         }
       });
    
    
    
    $('#update_tuition_modal').modal('show');
    
})

$(document).on('click','.get_detail',function(){
    var emp_id = $(this).attr('rel_id');
    var first_name = $(this).attr('rel_first');
    var last_last  = $(this).attr('rel_last');
    var rel_amount = $(this).attr('rel_amount');
    var app_id     = $(this).attr('rel_app_id');
    var pay_type   = $(this).attr('rel_pay');
    var user_email = $(this).attr('rel_email');
    
    var created = $(this).attr('rel_created');
     
    $('#emp_id').val(emp_id);
    $('#first_name').val(first_name+" "+last_last);
    $('#email').val(user_email);
    $('#amount').val(rel_amount);
	
	
	if(pay_type == 26)
	{
		$('#Campaign').val(26);
	}

    //$('#pay_type').val(pay_type);
    $('#app_id').val(app_id);  

     $('#receive_date').val(format(created));
    
    $.ajax({
         url:'<?=base_url()?>admin/Finance/get_donation_detail',
         method: 'post',
         data: {emp_id: emp_id,"submit":"submit","<?= csrf_token() ?> : <?= csrf_hash() ?>"},
         dataType: 'html',
         success: function(response){
          $('#result').html(response);
         }
       });

    $('#confirm_box').modal('show');
})

function confirm_button()
{
    var emp_id = $('#emp_id').val();
    var amount = $('#amount').val();
    var pay_type = $('#pay_type').val();
    var Campaign = $('#Campaign').val();
    var receive_date = $('#receive_date').val();
    var receipt_date = $('#receipt_date').val();
    
    if(pay_type == null)
    {
        alert("Please select Payment Type");
        return false;
    }
    else if(amount == '')
    {
        alert("Please Check amount field");
        $('#amount').focus();
        return false;
    }
    else if(pay_type == '')
    {
        alert("Please select payment type");
        $('#pay_type').focus();
         return false;
    }
    else if(Campaign == '')
    {
        alert("Please select Campaign");
        $('#Campaign').focus();
         return false;
    }
    else if(receive_date == '')
    {
        alert("Please enter receive_date");
        $('#receive_date').focus();
         return false;
    }
    else if(receipt_date == '')
    {
        alert("Please enter receipt_date");
        $('#receipt_date').focus();
         return false;
    }
    else
    {
          if(confirm("Are you sure to submit data . . ."))
          {
            return true;
          }
          else
          {
            return false;
          }
        return false;
    }
    
}



// 22-03-2022
function format(inputDate) {
    var date = new Date(inputDate);
    if (!isNaN(date.getTime())) {
        // Months use 0 index.
        return date.getMonth() + 1 + '/' + date.getDate() + '/' + date.getFullYear();
    }
}
</script>
