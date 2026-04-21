<div class="table-responsive"  >
    <table id="SemesterListing" class="table table-striped table-bordered stripe row-border order-column" >
            <thead>
                <tr>
                    <th rowspan="2">Student  Name</th>
                    <th rowspan="2">Student  Email</th>
                <?php 
                    if(!empty($unique_types)){
                       
                        foreach($unique_types as $unique_type){
                            //echo "<pre>"; print_r($rec); die();
                ?>    
                    <th colspan="4" style='text-align:center ! important;;'><?php $coursedet=getCorse_details_by_ID($unique_type);
                    echo $coursedet['CourseTitle']."(".$coursedet['Course'].")" ?></th>
                <?php } } ?> 
                   <!-- <th>Total Credits</th>-->
                    
                                                            
                </tr>
                
                <tr>
                <?php
                
                 if(!empty($unique_types)){
                  foreach($unique_types as $unique_type){
                    ?>
                     
                        <th>Status</th>
                        <th>Earn Credit</th>
                        <th>Year</th>
                        <th>Semester</th>
                    <?php } } ?> 
               </tr>
            </thead>
            <tbody> 
                <?php
                //echo "<pre>"; print_r($records); die();
                    if(!empty($recordss)){
                        foreach($recordss as $rec){
                            //echo "<pre>"; print_r($rec); die();
                ?>
                <tr>
                    <td><a href="<?= base_url('admin/Form/ViewApp/'.$rec['ID']) ?>" target="_blank"><?php echo $rec['firstname']; echo "  ".$rec['lastname']?></a></td>
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
                       
                        ?>
                            
                    </td>

                     <?php 
                     $credit=0; 
                     $CR=getSemesterCourseByStudent_ID($rec['StudentID'],$selectedclass,$selectedSemester);
                    //print_r($CR);
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
                        $show_year = '';
                        $sem = '';
                        $grade = '';
                        $earn_credit = '';
                      
                            if(!empty($records)){
                        foreach($records as $recc)
                        { 
                            if($recc['firstname']==$rec['firstname'] && $recc['lastname']==$rec['lastname'] && $recc['course_row_id']==$value )
                            {
                                //echo $recc['credits'];
                                if($recc['Grade'] == 'W'){
                                    $grade = $recc['Grade'];
                                }
                                else if($recc['Grade'] == 'AUDIT'){
                                    $grade = $recc['Grade'];
                                }
                                else if($recc['Grade'] =='SCH'){
                                    $grade = $recc['Grade'];
                                }
                                else if($recc['Grade'] == 'I'){
                                    $grade = $recc['Grade'];
                                    //$grade = 'Incomplete';
                                }
                                else if($recc['Grade'] =='ENR'){
                                    $grade = $recc['Grade'];
                                }
                                else if($recc['Grade'] =='ENR P/F'){
                                    $grade = $recc['Grade'];
                                }
                                else{
                                    $grade = 'Complete';
                                }
                                $show_year = $recc['Class'];
                                $sem = $recc['Semester'];
                                $earn_credit = $recc['CreditEarned'];
                            }
                            //echo $recc['course_row_id'];
                                
                              /*}*/} 
                            }

                         

                        echo "<td>";
                         echo $grade;
                        echo "</td>";
                        echo "<td>".$earn_credit."</td>";
                         echo "<td>".$show_year."</td><td>".$sem."</td>";
                          ?>
                          
                    
                 <?php  } ?>
                    
                    
                </tr>
                <?php }}?>
            </tbody>
            <tfoot>
                
            </tfoot>
    </table> 
</div>