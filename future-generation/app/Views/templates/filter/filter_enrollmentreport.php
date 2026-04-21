<div class="table-responsive">
    <h3>Women</h3>
    <table id="SemesterListing" class="table table-striped table-bordered" >
            <thead>
                <tr>
                   
                    <th rowspan="2"> Name</th>
                    <th rowspan="2">Email</th>
                    <th rowspan="2">Gender</th>
                     <th rowspan="2">Country</th>
                     <th rowspan="2">State</th>
                     <th rowspan="2">Ethnicity</th>
                     
                      <?php 
                      $abc = array();
                     
                      //echo "<pre>";print_r($enrolled_semester);echo "</pre>";
                     foreach($enrolled_semester as $es)
                     {
                         $get_size = get_size_of_semester($es['Class'],$es['Semester'],$unique_types);
                         /*if(sizeof($get_size)>0)
                         {*/
                            ?>
                            <th colspan="<?php echo sizeof($get_size) ?>"><?php echo $es['Class']." ".$es['Semester']; ?></th>
                            <?php
                         /*}*/
                     }
                     ?>
                       <th rowspan="2">Total Credits</th>
                     </tr>
                     <tr>
                     <?php
                     
                    if(!empty($unique_types)){
                        foreach($unique_types as $unique_type){
                            //echo "<pre>"; print_r($rec); die();
                            // echo "<pre>";print_r($unique_type);echo "</pre>";
                ?>    
                    <th><?php $coursedet=getCorse_details_by_ID($unique_type);
                    echo $coursedet['CourseTitle']."(".$coursedet['Course'].")"; 
                    $abc['course'.$coursedet['CourseID']] = 0;
                   
                    ?></th>
                <?php } } ?> 
                  
                     
                     <!--th>Course</th>
                     <th>Class</th>
                     <th>Semester</th>
                     <th>Start Date</th>
                     <th>End Date</th>
                     <th>Ethnicity</th-->
                </tr>
                
               
            </thead>
             <tbody> 
                <?php
                
                   $w_non_resient_alien = 0;
                   $w_hispanic = 0;
                   $w_native_american = 0;
                   $w_asian = 0;
                   $w_black = 0;
                   $w_hawaiian = 0;
                   $w_white=0;
                   $w_two=0 ;
                   $w_race = 0;
                   $w_unknown = 0;
                   
                   $plus_non_resient_alien = 0;
                   $plus_hispanic = 0;
                   $plus_native_american = 0;
                   $plus_asian = 0;
                   $plus_black = 0;
                   $plus_hawaiian = 0;
                   $plus_white=0;
                   $plus_two=0 ;
                   $plus_race = 0;
                   $plus_unknown = 0;
                   
                   $minus_non_resient_alien = 0;
                   $minus_hispanic = 0;
                   $minus_native_american = 0;
                   $minus_asian = 0;
                   $minus_black = 0;
                   $minus_hawaiian = 0;
                   $minus_white=0;
                   $minus_two=0 ;
                   $minus_race = 0;
                   $minus_unknown = 0;
                    $grand_credit = 0;
                    $m_grand_credit = 0;
                
                    if(!empty($recordss)){
                        foreach($recordss as $rec){
                            //echo "<pre>"; print_r($rec); die();
                ?>
                <tr>
                    <td><?php echo $rec['firstname']; echo "  ".$rec['lastname']?></td>
                    <td>
                       <?php 
                         $email=getEmaill($rec['StudentID']); 
                         // by prabhat
                         $user_email = '';
                         foreach($email as $e)
                         {
                             $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                             if($whatIWant == 'future.edu')
                             {
                               $user_email = $e['Email']; 
                             }
                         }
                         if($user_email != '')
                         {
                            echo $user_email;
                         }
                         else
                         {
                            if(isset($email[0]['Email'])){echo $email[0]['Email'];}
                         }
                        
                        
                        // End code prabhat
                         /*if(isset($email[0]['Email'])){echo $email[0]['Email'];} ;*/
                        ?>
                            
                    </td>
                    <td><?= $rec['Sex'] ?></td>
                   <td><?php
                           $user_address = get_user_address($rec['ID']);
                          
                             $user_country = array_column($user_address, 'CountryName');
                               echo implode(",",$user_country);
                             ?>
                         </td>
                         <td><?php
                             $user_country_id = array_column($user_address, 'Country');
                             
                            
                             
                              if (in_array("USA", $user_country_id))
                              {
                                 $state_list = get_us_state_by_state_id($rec['ID'],'USA');
                                 $user_country = array_column($state_list, 'StateName');
                               echo implode(",<br>",$user_country);
                              }
                           
                             ?>
                         </td>
                         
                         
                         <td>
                             <?php echo $rec['Ethnicity'];
                             
                              
                                   
                             
                             ?>
                         </td>
                         
                     <?php 
                     $credit=0; 
                     
                    
                     
                     $start_program_date = '01-07-';
                     $end_program_date = '30-06-';
                     $CR=getFallSemesterCourseByStudent_ID($rec['StudentID'],$selected_program_start,$start_program_date,$selected_program_end,$end_program_date,$selected_semester);
                 
                    foreach ($CR as $key => $valuee) {
                        $credit=$credit+$valuee['credits'];
                   
                        if($valuee['withdrawn']=='w'){
                            $withdrawn='w'; 
                        }elseif ($valuee['withdrawn']=='y') {
                           $withdrawn='y';
                        }else{
                            $withdrawn='';
                        }
                    }
                    
                    $corse = array_column($CR, 'course_row_id');
                    /*echo "<pre>"; 
                    print_r($corse) ;  
                    print_r($unique_types) ;  
                    print_r($records) ;  
                    echo "</pre>";*/
                     ?>
                    
                     <?php  
                    
                        foreach ($unique_types as $key => $value) {
                    //echo "<pre>Datassssssssssssssssss";print_r($records);echo "</pre>";
                        echo "<td>";
                        /* foreach ($corse as  $valuee) {*/
                            /*if($valuee==$value){*/
                            if(!empty($records)){
                        foreach($records as $recc){ 
                            if($recc['firstname']==$rec['firstname'] && $recc['lastname']==$rec['lastname'] && $recc['course_row_id']==$value ){
                                echo $recc['credits'];
                                $abc['course'.$recc['course_row_id']] = $abc['course'.$recc['course_row_id']]+$recc['credits'];
                            
                                
                            }
                            //echo $recc['course_row_id'];
                                
                              /*}*/} 
                            }

                         /* }*/
                        echo "</td>";
                          ?>
                    
                     <?php  } ?>
                     <td><?php echo $credit;
                      $grand_credit = $grand_credit+$credit;
                     
                       if($rec['Ethnicity'] == 'Unknown')
                       {
                          $w_unknown = $w_unknown+1; 
                          if($credit < 6)
                          {
                              $minus_unknown = $minus_unknown+1;
                          }
                          else
                          {
                              $plus_unknown = $plus_unknown+1;
                          }
                       }
                       if($rec['Ethnicity'] == '')
                       {
                          $w_unknown = $w_unknown+1; 
                          if($credit < 6)
                          {
                              $minus_unknown = $minus_unknown+1;
                          }
                          else
                          {
                              $plus_unknown = $plus_unknown+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'White')
                       {
                          $w_white = $w_white+1; 
                          if($credit < 6)
                          {
                              $minus_white = $minus_white+1;
                          }
                          else
                          {
                              $plus_white = $plus_white+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'Asian')
                       {
                          $w_asian = $w_asian+1; 
                          if($credit < 6)
                          {
                              $minus_asian = $minus_asian+1;
                          }
                          else
                          {
                              $plus_asian = $plus_asian+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'Black/African American')
                       {
                          $w_black = $w_black+1; 
                          
                          if($credit < 6)
                          {
                              $minus_black = $minus_black+1;
                          }
                          else
                          {
                              $plus_black = $plus_black+1;
                          }
                          
                       }
                       if($rec['Ethnicity'] == 'Hispanic/Latino')
                       {
                          $w_hispanic = $w_hispanic+1; 
                          if($credit < 6)
                          {
                              $minus_hispanic = $minus_hispanic+1;
                          }
                          else
                          {
                              $plus_hispanic = $plus_hispanic+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'American Indian')
                       {
                          $w_native_american = $w_native_american+1; 
                          if($credit < 6)
                          {
                              $minus_native_american = $minus_native_american+1;
                          }
                          else
                          {
                              $plus_native_american = $plus_native_american+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'Non-Resident Alien')
                       {
                          $w_non_resient_alien = $w_non_resient_alien+1; 
                          if($credit < 6)
                          {
                              $minus_non_resient_alien = $minus_non_resient_alien+1;
                          }
                          else
                          {
                              $plus_non_resient_alien = $plus_non_resient_alien+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'Native Hawaiian/Pacific Islander')
                       {
                          $w_hawaiian = $w_hawaiian+1;
                          if($credit < 6)
                          {
                              $minus_hawaiian = $minus_hawaiian+1;
                          }
                          else
                          {
                              $plus_hawaiian = $plus_hawaiian+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'Two or more races')
                       {
                          $w_two = $w_two+1;
                          if($credit < 6)
                          {
                              $minus_two = $minus_two+1;
                          }
                          else
                          {
                              $plus_two = $plus_two+1;
                          }
                       }
                     
                     ?></td>
                    
                </tr>
                <?php }}?>
            </tbody>
            <tfoot>
                <th colspan="6">Subtotal</th>
                <?php
                 foreach($abc as $key => $val)
                 {
                    ?>
                    <th><?= $val ?></th>
                    <?php
                 }
                ?>
                <th><?= $grand_credit; ?></th>
            </tfoot>
    </table> 

</div>

<div>
    <table class="table table-striped table-bordered" style="margin-top:20px;width:50%;">
        <thead>
            <tr>
                <th></th>
                <th>Total</th>
                <!--th>Full Time (6 +ch)</th>
                <th>Part Time (< 6 ch)</th-->
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Unknown</th>
                <td><?= $w_unknown ?></td>
                <!--td><?= $plus_unknown ?></td>
                <td><?= $minus_unknown ?></td-->
            </tr>
            <tr>
                <th>White</th>
                <td><?= $w_white ?></td>
                <!--td><?= $plus_white ?></td>
                <td><?= $minus_white ?></td-->
            </tr>
            <tr>
                <th>Asian</th>
                <td><?= $w_asian ?></td>
                <!--td><?= $plus_asian ?></td>
                <td><?= $minus_asian ?></td-->
            </tr>
            <tr>
                <th>Black/African American</th>
                <td><?= $w_black ?></td>
                <!--td><?= $plus_black ?></td>
                <td><?= $minus_black ?></td-->
            </tr>
            <tr>
                <th>Hispanic/Latino</th>
                <td><?= $w_hispanic ?></td>
                <!--td><?= $plus_hispanic ?></td>
                <td><?= $minus_hispanic ?></td-->
            </tr>
            <tr>
                <th>American Indian</th>
                <td><?= $w_native_american ?></td>
                <!--td><?= $plus_native_american ?></td>
                <td><?= $minus_native_american ?></td-->
            </tr>
            <tr>
                <th>Non-Resident Alien</th>
                <td><?= $w_non_resient_alien ?></td>
                <!--td><?= $plus_non_resient_alien ?></td>
                <td><?= $minus_non_resient_alien ?></td-->
            </tr>
            <tr>
                <th>Native Hawaiian/Pacific Islander</th>
                <td><?= $w_hawaiian ?></td>
                <!--td><?= $plus_hawaiian ?></td>
                <td><?= $minus_hawaiian ?></td-->
            </tr>
            <tr>
                <th>Two or more races</th>
                <td><?= $w_two ?></td>
                <!--td><?= $plus_two ?></td>
                <td><?= $minus_two ?></td-->
            </tr>
            
            <tr>
                <th>Total Women</th>
                <td><?= $w_unknown+$w_white+$w_asian+$w_black+$w_hispanic+$w_native_american+$w_non_resient_alien+$w_hawaiian+$w_two ?></td>
                <!--td><?= $plus_unknown+$plus_white+$plus_asian+$plus_black+$plus_hispanic+$plus_native_american+$plus_non_resient_alien+$plus_hawaiian+$plus_two ?></td>
                <td><?= $minus_unknown+$minus_white+$minus_asian+$minus_black+$minus_hispanic+$minus_native_american+$minus_non_resient_alien+$minus_hawaiian+$minus_two ?></td-->
            </tr>
            
            
        </tbody>
    </table> 
    
    <div class="table-responsive">
        <h3>Men</h3>
        <table id="alldataTable" class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th rowspan="2">Name</th>
                    <th rowspan="2">Email</th>
                    <th rowspan="2">Gender</th>
                    <th rowspan="2">Country</th>
                    <th rowspan="2">State</th>
                    <th rowspan="2">Ethnicity</th>
                      <?php 
                    
                    $m_abc = array();
                    $total_abc = array();
                     foreach($m_enrolled_semester as $es)
                     {
                         $get_size = get_size_of_semester($es['Class'],$es['Semester'],$m_unique_types);
                         /*if(sizeof($get_size)>0)
                         {*/
                            ?>
                            <th colspan="<?php echo sizeof($get_size) ?>"><?php  echo $es['Class']." ".$es['Semester'] ; ?></th>
                            <?php
                         /*}*/
                     }
                     ?>
                      <th rowspan="2">Total Credits</th>
                    </tr>
                    <tr>
                     <?php
                     
                    if(!empty($m_unique_types)){
                        foreach($m_unique_types as $unique_type){
                            //echo "<pre>"; print_r($rec); die();
                            // echo "<pre>";print_r($unique_type);echo "</pre>";
                ?>    
                    <th><?php $coursedet=getCorse_details_by_ID($unique_type);
                    echo $coursedet['CourseTitle']."(".$coursedet['Course']."-".$unique_type.")";
                    $m_abc['course'.$coursedet['CourseID']] = 0;?></th>
                <?php } } ?>
                     
                    
                </tr>
                
               
            </thead>
             <tbody> 
                <?php
                
                   $non_resient_alien = 0;
                   $hispanic = 0;
                   $native_american = 0;
                   $asian = 0;
                   $black = 0;
                   $hawaiian = 0;
                   $white=0;
                   $two=0 ;
                   $race = 0;
                   $unknown = 0;
                   
                   $plus_non_resient_alien = 0;
                   $plus_hispanic = 0;
                   $plus_native_american = 0;
                   $plus_asian = 0;
                   $plus_black = 0;
                   $plus_hawaiian = 0;
                   $plus_white=0;
                   $plus_two=0 ;
                   $plus_race = 0;
                   $plus_unknown = 0;
                   
                   $minus_non_resient_alien = 0;
                   $minus_hispanic = 0;
                   $minus_native_american = 0;
                   $minus_asian = 0;
                   $minus_black = 0;
                   $minus_hawaiian = 0;
                   $minus_white=0;
                   $minus_two=0 ;
                   $minus_race = 0;
                   $minus_unknown = 0;
                   
                
                    if(!empty($m_recordss)){
                        foreach($m_recordss as $rec){
                            //echo "<pre>"; print_r($rec); die();
                ?>
                <tr>
                    <td><?php echo $rec['firstname']; echo "  ".$rec['lastname']?></td>
                    <td>
                       <?php 
                         $email=getEmaill($rec['StudentID']); 
                         // by prabhat
                         $user_email = '';
                         foreach($email as $e)
                         {
                             $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                             if($whatIWant == 'future.edu')
                             {
                               $user_email = $e['Email']; 
                             }
                         }
                         if($user_email != '')
                         {
                            echo $user_email;
                         }
                         else
                         {
                            if(isset($email[0]['Email'])){echo $email[0]['Email'];}
                         }
                        
                        
                        // End code prabhat
                         /*if(isset($email[0]['Email'])){echo $email[0]['Email'];} ;*/
                        ?>
                            
                    </td>
                    <td><?= $rec['Sex'] ?></td>
                   <td><?php
                           $user_address = get_user_address($rec['ID']);
                          
                             $user_country = array_column($user_address, 'CountryName');
                               echo implode(",",$user_country);
                             ?>
                         </td>
                         <td><?php
                             $user_country_id = array_column($user_address, 'Country');
                             
                            
                             
                              if (in_array("USA", $user_country_id))
                              {
                                 $state_list = get_us_state_by_state_id($rec['ID'],'USA');
                                 $user_country = array_column($state_list, 'StateName');
                               echo implode(",<br>",$user_country);
                              }
                           
                             ?>
                         </td>
                         
                         
                         <td>
                             <?php echo $rec['Ethnicity'];
                             
                              
                                   
                             
                             ?>
                         </td>
                         
                     <?php 
                     $credit=0; 
                     $start_program_date = '01-07-';
                     $end_program_date = '30-06-';
                     $CR=getFallSemesterCourseByStudent_ID($rec['StudentID'],$selected_program_start,$start_program_date,$selected_program_end,$end_program_date,$selected_semester);
                  // echo "<pre>";print_r($this->db->last_query());echo "</pre>";
                    foreach ($CR as $key => $valuee) {
                        $credit=$credit+$valuee['credits'];
                        if($valuee['withdrawn']=='w'){
                            $withdrawn='w'; 
                        }elseif ($valuee['withdrawn']=='y') {
                           $withdrawn='y';
                        }else{
                            $withdrawn='';
                        }
                    }
                    $corse = array_column($CR, 'course_row_id');
                    /*echo "<pre>"; 
                    print_r($corse) ;  
                    print_r($unique_types) ;  
                    print_r($records) ;  
                    echo "</pre>";*/
                     ?>
                    
                     <?php  
                    
                        foreach ($m_unique_types as $key => $value) {
                    //echo "<pre>Datassssssssssssssssss";print_r($records);echo "</pre>";
                        echo "<td>";
                        /* foreach ($corse as  $valuee) {*/
                            /*if($valuee==$value){*/
                            if(!empty($records)){
                            
                        foreach($m_records as $recc){ 
                             
                            if($recc['firstname']==$rec['firstname'] && $recc['lastname']==$rec['lastname'] && $recc['course_row_id']==$value ){
                              
                                echo $recc['credits'];
                               
                                 $m_abc['course'.$recc['course_row_id']] = $m_abc['course'.$recc['course_row_id']]+$recc['credits'];
                               
                               
                               
                            }
                            //echo $recc['course_row_id'];
                                
                              /*}*/} 
                            }

                         /* }*/
                        echo "</td>";
                          ?>
                    
                     <?php  } ?>
                     <td><?php echo $credit;
                     $m_grand_credit = $m_grand_credit+$credit;
                     
                       if($rec['Ethnicity'] == 'Unknown')
                       {
                          $unknown = $unknown+1; 
                          if($credit < 6)
                          {
                              $minus_unknown = $minus_unknown+1;
                          }
                          else
                          {
                              $plus_unknown = $plus_unknown+1;
                          }
                       }
                       if($rec['Ethnicity'] == '')
                       {
                          $unknown = $unknown+1; 
                          if($credit < 6)
                          {
                              $minus_unknown = $minus_unknown+1;
                          }
                          else
                          {
                              $plus_unknown = $plus_unknown+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'White')
                       {
                          $white = $white+1; 
                          if($credit < 6)
                          {
                              $minus_white = $minus_white+1;
                          }
                          else
                          {
                              $plus_white = $plus_white+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'Asian')
                       {
                          $asian = $asian+1; 
                          if($credit < 6)
                          {
                              $minus_asian = $minus_asian+1;
                          }
                          else
                          {
                              $plus_asian = $plus_asian+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'Black/African American')
                       {
                          $black = $black+1; 
                          
                          if($credit < 6)
                          {
                              $minus_black = $minus_black+1;
                          }
                          else
                          {
                              $plus_black = $plus_black+1;
                          }
                          
                       }
                       if($rec['Ethnicity'] == 'Hispanic/Latino')
                       {
                          $hispanic = $hispanic+1; 
                          if($credit < 6)
                          {
                              $minus_hispanic = $minus_hispanic+1;
                          }
                          else
                          {
                              $plus_hispanic = $plus_hispanic+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'American Indian')
                       {
                          $native_american = $native_american+1; 
                          if($credit < 6)
                          {
                              $minus_native_american = $minus_native_american+1;
                          }
                          else
                          {
                              $plus_native_american = $plus_native_american+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'Non-Resident Alien')
                       {
                          $non_resient_alien = $non_resient_alien+1; 
                          if($credit < 6)
                          {
                              $minus_non_resient_alien = $minus_non_resient_alien+1;
                          }
                          else
                          {
                              $plus_non_resient_alien = $plus_non_resient_alien+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'Native Hawaiian/Pacific Islander')
                       {
                          $hawaiian = $hawaiian+1;
                          if($credit < 6)
                          {
                              $minus_hawaiian = $minus_hawaiian+1;
                          }
                          else
                          {
                              $plus_hawaiian = $plus_hawaiian+1;
                          }
                       }
                       if($rec['Ethnicity'] == 'Two or more races')
                       {
                          $two = $two+1;
                          if($credit < 6)
                          {
                              $minus_two = $minus_two+1;
                          }
                          else
                          {
                              $plus_two = $plus_two+1;
                          }
                       }
                     
                     ?></td>
                    
                </tr>
                <?php }}?>
            </tbody>
            
            
            
            <tfoot>
                <th colspan="6"><strong>Subtotal</strong></th>
                <?php
                 foreach($m_abc as $key => $val)
                 {
                     $total_abc[$key] = $abc[$key]+ $m_abc[$key];
                    ?>
                    <th><strong><?=$val ?></strong></th>
                    <?php
                 }
                ?>
                <th><?= $m_grand_credit; ?></th>
            </tfoot>
            
            
            
             
            
    
    </table> 
    </div>
    
    <table class="table table-striped table-bordered" style="margin-top:20px;width:50%;">
        <thead>
            <tr>
                <th></th>
                <th>Total</th>
                <!--th>Full Time (6 +ch)</th>
                <th>Part Time (< 6 ch)</th-->
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Unknown</th>
                <td><?= $unknown ?></td>
                <!--td><?= $plus_unknown ?></td>
                <td><?= $minus_unknown ?></td-->
            </tr>
            <tr>
                <th>White</th>
                <td><?= $white ?></td>
                <!--td><?= $plus_white ?></td>
                <td><?= $minus_white ?></td-->
            </tr>
            <tr>
                <th>Asian</th>
                <td><?= $asian ?></td>
                <!--td><?= $plus_asian ?></td>
                <td><?= $minus_asian ?></td-->
            </tr>
            <tr>
                <th>Black/African American</th>
                <td><?= $black ?></td>
                <!--td><?= $plus_black ?></td>
                <td><?= $minus_black ?></td-->
            </tr>
            <tr>
                <th>Hispanic/Latino</th>
                <td><?= $hispanic ?></td>
                <!--td><?= $plus_hispanic ?></td>
                <td><?= $minus_hispanic ?></td-->
            </tr>
            <tr>
                <th>American Indian</th>
                <td><?= $native_american ?></td>
                <!--td><?= $plus_native_american ?></td>
                <td><?= $minus_native_american ?></td-->
            </tr>
            <tr>
                <th>Non-Resident Alien</th>
                <td><?= $non_resient_alien ?></td>
                <!--td><?= $plus_non_resient_alien ?></td>
                <td><?= $minus_non_resient_alien ?></td-->
            </tr>
            <tr>
                <th>Native Hawaiian/Pacific Islander</th>
                <td><?= $hawaiian ?></td>
                <!--td><?= $plus_hawaiian ?></td>
                <td><?= $minus_hawaiian ?></td-->
            </tr>
            <tr>
                <th>Two or more races</th>
                <td><?= $two ?></td>
                <!--td><?= $plus_two ?></td>
                <td><?= $minus_two ?></td-->
            </tr>
            
            <tr>
                <th>Total Men</th>
                <td><?= $unknown+$white+$asian+$black+$hispanic+$native_american+$non_resient_alien+$hawaiian+$two ?></td>
                <!--td><?= $plus_unknown+$plus_white+$plus_asian+$plus_black+$plus_hispanic+$plus_native_american+$plus_non_resient_alien+$plus_hawaiian+$plus_two ?></td>
                <td><?= $minus_unknown+$minus_white+$minus_asian+$minus_black+$minus_hispanic+$minus_native_american+$minus_non_resient_alien+$minus_hawaiian+$minus_two ?></td-->
            </tr>
            
            
        </tbody>
    </table> 
    
    <div class="col-sm-12" style="margin-top:20px;">
         <div class="row table-responsive" >
          <table class="table table-striped table-bordered" style="margin-top:20px;width:50%;">
        
           
               <thead>
                <tr>
                   
                     <th rowspan="2">Name</th>
                    <th rowspan="2">Email</th>
                    <th rowspan="2">Gender</th>
                     <th rowspan="2">Country</th>
                     <th rowspan="2">State</th>
                     <th rowspan="2">Ethnicity</th>
                      <?php 
                    
                    $m_abc = array();
                     foreach($m_enrolled_semester as $es)
                     {
                         $get_size = get_size_of_semester($es['Class'],$es['Semester'],$m_unique_types);
                         /*if(sizeof($get_size)>0)
                         {*/
                            ?>
                            <th colspan="<?php echo sizeof($get_size) ?>"><?php  echo $es['Class']." ".$es['Semester'] ; ?></th>
                            <?php
                         /*}*/
                     }
                     ?>
                       <th rowspan="2">Total Credits</th>
                     </tr>
                     <tr>
                     <?php
                     
                    if(!empty($m_unique_types)){
                        foreach($m_unique_types as $unique_type){
                            //echo "<pre>"; print_r($rec); die();
                            // echo "<pre>";print_r($unique_type);echo "</pre>";
                ?>    
                    <th><?php $coursedet=getCorse_details_by_ID($unique_type);
                    echo $coursedet['CourseTitle']."(".$coursedet['Course'].")";
                   ?></th>
                <?php } } ?>
                     
                     <!--th>Course</th>
                     <th>Class</th>
                     <th>Semester</th>
                     <th>Start Date</th>
                     <th>End Date</th>
                     <th>Ethnicity</th-->
                </tr>
                
               
            </thead>
        
                <tfoot>
                    <th colspan="6">Total Credit</th>
                    <?php
                     foreach($total_abc as $key => $val)
                     {
                        ?>
                        <th><?php echo $val ?></th>
                        <?php
                     }
                    ?>
                    <th><strong><?= $m_grand_credit+$grand_credit; ?></strong></th>
                </tfoot>
           </table>    
        </div>
      </div>
        
    <table class="table table-striped table-bordered" style="margin-top:20px;width:50%;">
        <thead>
            <tr>
                <th></th>
                <th>Total</th>
               
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Unknown</th>
                <td><?= $unknown+$w_unknown ?></td>
               
            </tr>
            <tr>
                <th>White</th>
                <td><?= $white+$w_white ?></td>
            </tr>
            <tr>
                <th>Asian</th>
                <td><?= $asian+$w_asian ?></td>
            </tr>
            <tr>
                <th>Black/African American</th>
                <td><?= $black+$w_black ?></td>
            </tr>
            <tr>
                <th>Hispanic/Latino</th>
                <td><?= $hispanic+$w_hispanic ?></td>
            </tr>
            <tr>
                <th>American Indian</th>
                <td><?= $native_american+$w_native_american ?></td>
            </tr>
            <tr>
                <th>Non-Resident Alien</th>
                <td><?= $non_resient_alien+$w_non_resient_alien ?></td>
            </tr>
            <tr>
                <th>Native Hawaiian/Pacific Islander</th>
                <td><?= $hawaiian+$w_hawaiian ?></td>
            </tr>
            <tr>
                <th>Two or more races</th>
                <td><?= $two+$w_two ?></td>
            </tr>
            
            <tr>
                <th>Total Student</th>
                <td><?= $w_unknown+$w_white+$w_asian+$w_black+$w_hispanic+$w_native_american+$w_non_resient_alien+$w_hawaiian+$w_two+$unknown+$white+$asian+$black+$hispanic+$native_american+$non_resient_alien+$hawaiian+$two ?></td>
            </tr>
            
            <tr>
                <th>Total Credit</th>
                <td><?= $m_grand_credit+$grand_credit ?></td>
            </tr>
            
            
            <tr>
                <th>FTE</th>
                <td><?= ($m_grand_credit+$grand_credit)/24 ?></td>
            </tr>
            
        </tbody>
    </table> 
  
</div>