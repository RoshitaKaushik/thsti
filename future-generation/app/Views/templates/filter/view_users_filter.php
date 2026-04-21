<table id="datatable" class="table table-striped table-bordered datatable">
									<thead>
										<tr>
											<th style="width: 26px;"></th>
											<th>Full Name</th>
											<th>Email</th>
											<th>Profiles</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>

							 
									<tbody> 
										<!-- <?php echo "<pre>";print_r($results);echo "</pre>"; ?> -->
										<?php $sn = 1; foreach($results as $row) { ?>
										<tr>
												<td>
											    <?php
    											     if($row['profile_image'] != '')
    											     {
    											        ?>
    											        <img id="profile_pic_id<?= encryptor('encrypt', $row['admin_id']) ?>" rel_id="<?= encryptor('encrypt', $row['admin_id']) ?>" rel_name="<?= $row['admin_fullname'] ?>"  class="profile_dp" src="<?= base_url($row['profile_image']) ?>" > 
    											        <?php 
    											     }
    											     else
    											     {
    											        ?>
    											        <img rel_id="<?= encryptor('encrypt', $row['admin_id']) ?>" rel_name="<?= $row['admin_fullname'] ?>" class="profile_dp" src="<?= base_url('docs/profile/no_dp.jpg') ?>" > 
    											        <?php
    											     }
    											    ?>
    											    
    											</td>
											<td><?=$row['admin_fullname']?></td>										
											<td><?=$row['admin_email']?></td>
											<!--<td><a href="<?=base_url('admin/Users/addUsers')."/".encryptor('encrypt', $row['admin_id'])?>" title="Click to manage the Role"><?=$row['role']?></a></td>-->
											
											<td>
											<?php 
											helper('function_helper');
											if($row['role']==1){											
												echo $row['role_name'];
											} else if($row['role']==2){
												
												$profile = $row['profiles'];
												$profiles = json_decode($profile,true);
												$result = $profiles['profiles']; 
												if($profile!=""){											
													$results = implode(',',$result);
													// echo "<pre>";print_r($results);echo "</pre>";
													echo $response = getProfileName($result);
												}else{
													echo "Attendance";
												}
											}
											else{
													echo "Attendance";
												}
											?>
										    </td>
											<td><?=$row['account_status']== 1?'<span class="label label-success">Active</span>':'<span class="label label-danger">Inactive</span>'?></td>
											<td>
																				
												<a href="<?=base_url('admin/Users/addUsers')."/".encryptor('encrypt', $row['admin_id'])?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
													<span><strong>Edit</strong></span>            
												</a>
												
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								