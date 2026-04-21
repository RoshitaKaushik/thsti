<div class="table-responsive">
    <table id="SemesterListing" class="table datatable_th table-striped table-bordered" >
             <thead>
                <tr>
                    <th rowspan="2" style='text-align:left ! important;'>Student  Name</th>
                    <th rowspan="2" style='text-align:left ! important;'>Student  Email</th>
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
                     
                        <th>Credit</th>
                        <th>Year</th>
                        <th>Semester</th>
                        <th>
                            <?php
                            if($selected_grade == 'W')
                            {
                                echo "Withdrawn Date";
                            }
                            else
                            {
                                echo "Expected Completion Date";
                            }
                            ?>
                            </th>
                    <?php } } ?> 
               </tr>
            </thead>
            <tbody> 
                <?php
                //echo "<pre>"; print_r($records); die();
                    if(!empty($recordss)){
                        //echo "<pre>";print_r($recordss);echo "</pre>";
                        foreach($recordss as $rec){
                            //echo "<pre>"; print_r($rec); die();
                ?>
                <tr>
                    <td style='text-align:left ! important;'><a href="<?= base_url('admin/Form/ViewApp/'.$rec['ID']) ?>" target="_blank"><?php echo $rec['firstname']; echo "  ".$rec['lastname']?></a></td>
                    <td style='text-align:left ! important;'>
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
                    //echo "<pre>";print_r($records);echo "</pre>";
                     ?>
                    
                     <?php  
                        foreach ($unique_types as $key => $value) {
                        $show_year = '';
                        $sem = '';
                        $completion_date1 = "";
                        $comment = '';
                        /*$comment = "Expected Completion Date : ";
                        
                        if($selected_grade == 'W')
                        {
                            $comment = "Withdrawn Date : ";
                        }*/
                        
                        
                        
                        echo "<td>";
                        /* foreach ($corse as  $valuee) {*/
                            /*if($valuee==$value){*/
                            if(!empty($records)){
                        foreach($records as $recc){ 
                            if($recc['firstname']==$rec['firstname'] && $recc['lastname']==$rec['lastname'] && $recc['course_row_id']==$value ){
                                echo $recc['credits'];
                                $show_year = $recc['Class'];
                                $sem = $recc['Semester'];
                                $completion_date1 = $recc['completion_date'];
                                
                               
                                
                            }
                           } 
                        }
                        echo "</td>";
                        
                        echo "<td>".$show_year."</td><td>".$sem."</td>";
                        if($completion_date1 != '')
                        {
                            $completion_date1 = date('m/d/Y',strtotime($completion_date1));
                        }
                        echo "<td>".$comment.$completion_date1."</td>";                                                            
                          ?>
                          
                    
                     <?php  } ?>
                    
                    
                </tr>
                <?php }}?>
            </tbody>
    </table> 
</div>