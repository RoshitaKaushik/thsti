<div class="table-responsive div1">
    <table id="alldataTable1" class="table datatable_th table-striped table-bordered room-booking">
    <thead>
        <tr>
          <th class="not-sorted">Sno</th>
          <th class="select-disabled" data-name="<?= encryptor('encrypt', 'FirstName') ?>">First Name</th>
          <th class="select-disabled" data-name="<?= encryptor('encrypt', 'LastName') ?>">Last Name</th>
          <th class="not-sorted" data-name="<?= encryptor('encrypt', 'Email') ?>">Email</th>
          <th data-name="<?= encryptor('encrypt', 'Sex') ?>">Sex</th>
          <th data-name="<?= encryptor('encrypt', 'CountryName') ?>">Country</th>
          <th data-name="<?= encryptor('encrypt', 'Ethnicity') ?>">Ethnicity</th>
          <th data-name="<?= encryptor('encrypt', 'citizenship') ?>">Citizenship</th>
          <th data-name="<?= encryptor('encrypt', 'Birthdate') ?>">Birthday</th>
          <th class="not-sorted" data-name="<?= encryptor('encrypt', 'Age') ?>">Age</th>
          <th data-name="<?= encryptor('encrypt', 'Special_Program_Name') ?>">Market Name</th>
          <th data-name="<?= encryptor('encrypt', 'Track_Name') ?>">Track Name</th>
          <th data-name="<?= encryptor('encrypt', 'Program_Name') ?>">Concentration/Specialization</th>
          <th data-name="<?= encryptor('encrypt', 'start_date') ?>">Start Date</th>
          <th class="not-sorted" data-name="<?= encryptor('encrypt', 'Gradution') ?>">Gradution Date</th>
          <th class="not-sorted" data-name="<?= encryptor('encrypt', 'Withdrawn') ?>">Withdrawal Date</th>
          <th data-name="<?= encryptor('encrypt', 'enroll_certificate') ?>">Enrolled into a certificate</th>
          <th data-name="<?= encryptor('encrypt', 'master_program') ?>">Enrolled into a Master's program</th>
        </tr>

    </thead>

    <tbody> 
       <?php
       $s=1;
        if($student_demographic_report)
        { 
         foreach($student_demographic_report as $sdr)
         {
            $user_address = get_user_address($sdr['ID'],$selected_Country);
            ?>
             <tr>
                 <td><?= $s++; ?></td>
                 <td><a href="<?= base_url('admin/Form/ViewApp/'.$sdr['ID']) ?>" target="_blank"><?= $sdr['FirstName'] ?></a></td>
                 <td><a href="<?= base_url('admin/Form/ViewApp/'.$sdr['ID']) ?>" target="_blank"><?= $sdr['LastName'] ?></a></td>
                 <td  class="column1"><?php
                      $email=report_getEmailByIDD($sdr['StudentInfoID']);
                      $user_email = '';
                     foreach($email as $e)
                     {
                         $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                         if($whatIWant == 'future.edu')
                         {
                           $user_email = $e['Email']; 
                         }
                     }
                     if(isset($email[0]['Email']))
                     {
						$all_email = array_column($email, 'Email');
						echo implode(",",$all_email);
					 }
                     ?>
                 </td>
                 
                 <td  class="column2" style="text-align:center ! important;"><?= $sdr['Sex'] ?></td>
                 <td  class="column3">
                     <?php
                     echo $sdr['CountryName'];
                     /*$user_country = array_column($user_address, 'CountryName');
                       echo implode(",<br>",$user_country);*/
                     ?>
                 </td>
                 <td><?= $sdr['Ethnicity'] ?></td>
                 <td><?= $sdr['citizenship'] ?></td>                                                          
                 <td data-order="<?php echo date('Y-m-d',strtotime($sdr['Birthdate'])); ?>"><?php 
                       if($sdr['Birthdate'] != '')
                       {
                           echo date('m/d/Y',strtotime($sdr['Birthdate']));
                       }
                     ?>
                 </td>
                 <td style="text-align:center ! important;">
                   <?php
                   if($sdr['Birthdate'] != '')
                   {
                      $birth =  date('d-m-Y',strtotime($sdr['Birthdate']));
                      $current = date('d-m-Y');
                      if($sdr['graduation_date'] != '' && $sdr['graduation_date'] != '0000-00-00'){
                        $current = date('d-m-Y',strtotime($sdr['graduation_date']));
                      }
                      $diff = abs(strtotime($current) - strtotime($birth));
                      echo $years = floor($diff / (365*60*60*24));
                   }
                   ?>
                  </td>

                  <td><?= $sdr['Special_Program_Name']; ?></td>
                <td><?= $sdr['track_name']; ?></td>
                <td><?= $sdr['Program_Name']; ?></td>
                 <td data-order="<?php echo date('Y-m-d',strtotime($sdr['start_date'])); ?>"><?php if($sdr['start_date']!='0000-00-00' && $sdr['start_date']!='' )
                            echo date('m/d/Y',strtotime($sdr['start_date'])); ?>
                 </td>
                 <td data-order="<?php echo date('Y-m-d',strtotime($sdr['Gradution'])); ?>"><?php if($sdr['Gradution']!='0000-00-00' && $sdr['Gradution']!='')echo date('m/d/Y',strtotime($sdr['Gradution'])); ?></td>
                 <td  data-order="<?php echo date('Y-m-d',strtotime($sdr['Withdrawn'])); ?>"><?php if($sdr['Withdrawn']!='0000-00-00' && $sdr['Withdrawn']!='')echo date('m/d/Y',strtotime($sdr['Withdrawn'])); ?></td>
                 <td><?= $sdr['enroll_certificate'] ?></td>
                 <td><?= $sdr['master_program'] ?></td>
             </tr>
             <?php
         }
        }
       ?>
    </tbody>
</table>
</div>