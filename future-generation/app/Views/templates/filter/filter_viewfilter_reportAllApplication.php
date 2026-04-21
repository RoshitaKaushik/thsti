<table id="viewfilter_reportDataTable" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>S.NO</th>
			<?php
			if(isset($select_component)==22)
			{
			    echo "<th>Category</th>";
			}
			else
			{
			    echo "<th>APPLICATION ID</th>";
			}
			?>
			<th>STUDENT NAME</th>
			<th>Forms</th>
			<th>Application Date</th>
			<th>Action</th>
		</tr>
	</thead>							 
	<tbody> 		
        <?php 
        $count = 0;
        if(!empty($apps)){
            foreach($apps as $app)
            {
                $count++;
                $application_code = $app['application_code'];
                $scheme_id=$app['scheme_id'];
                $component_id=$app['component_id'];
                $admin_approved_status = $app['admin_approved_status']; // apoorv 4/06/2020
                $application_save_status = $app['save_status'];
                $component_details = get_componentsByID($app['component_id']);
                $datafield_details = getCustomFieldsActivename($component_id);
                $index =  array_search('student full name', array_map('strtolower', array_column($datafield_details, 'field_name')));
                $last_name_field = '';
                if($index == ''){
                      $index =  array_search('first name', array_map('strtolower', array_column($datafield_details, 'field_name')));
                      $last_name_field =  array_search('last name', array_map('strtolower', array_column($datafield_details, 'field_name')));
                	if($index == ''){
                		$index =  array_search('student name', array_map('strtolower', array_column($datafield_details, 'field_name')));
                		if($index == ''){
                			$index =  array_search('printed name', array_map('strtolower', array_column($datafield_details, 'field_name')));
                			if($index == ''){
                				$index =  array_search('name', array_map('strtolower', array_column($datafield_details, 'field_name')));
                				if($index == ''){
                				$index =  array_search('1. last (family) name:', array_map('strtolower', array_column($datafield_details, 'field_name')));
                			}
                			}
                		}
                	}
                }						
                $field_value=get_custom_fields_values_custom($app['application_code'], $datafield_details[$index]['field_id']);
                $last_field_value = '';
				if($last_name_field !='')
				{
				    $last_field_value =get_custom_fields_values_custom($app['application_code'], $datafield_details[$last_name_field]['field_id']);
				}
		        ?>
                    <tr>
                        <td><?=$count?></td>
                        <td>
                            <?php
                            if(isset($select_component)==22)
                            {
                                $cat =  get_category_application($app['application_code'],559);
                                echo $cat['field_value'];
                            }
                            else
                            {
                                echo $app['application_code'];
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $field_value['field_value'];
                            if($last_field_value !='')
                            {
                            echo "&nbsp;".$last_field_value['field_value'];
                            }
                            ?>
                        </td>
                        <td><?=$component_details[0]['scheme_component_name']?></td>
                        <td><?=date('d-m-Y, H:i A', strtotime($app['created_date']))?></td>
                        <td>
                            <a href="<?=base_url('formbuilder/Forms/createPDF/')?><?=encryptor('encrypt', $app['application_id'])?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5" target="_blank">
                            <i class="ion-document-text"></i>
                            <span><strong>View PDF</strong></span>            
                            </a>
                        </td>
                    </tr>
			<?php 
		    }
		}
		?>
	</tbody>
</table> 