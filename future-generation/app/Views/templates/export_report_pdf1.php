<style>
    
    th{
        font-weight:bold;
        text-align:center;
        font-family: "Times New Roman", Times, serif;
    }
    td
    {
        font-family: "Times New Roman", Times, serif;
    }
   
</style>
<br/><br/>
        <table style='width:100%;'>
            <tbody>
                <tr>
                    <th><?php echo $title;
                    if($type != '')
                    {
                      ?>
                             (<?= $type ?>) 
                      <?php
                    }
                    ?>
                    </th>
                </tr>
                
               </tbody>
        </table>

<br/><br/>


        <?php
        if($selected_course_detail)
        {
            ?>
            <table style='width:100%;'border="1" >
              <tbody>
                  <tr>
                        <th>Course Title</th>
                        <td>&nbsp;&nbsp;<?= $selected_course_detail['CourseTitle']; ?></td>
                    </tr>
                    <tr>
                        <th>Professor</th>
                        <td>&nbsp;&nbsp;<?= $selected_course_detail['Professor']; ?></td> 
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <td>&nbsp;&nbsp;<?= $selected_course_detail['Semester']; ?></td>
                    </tr>
                    <tr><th colspan="2"></th></tr>
                   </tbody>
        </table>
        <br/>
<br>

            <?php
        }
        ?>
            





<table id="SemesterListing" class="table table-striped table-bordered" style="border:1px solid #ccc;">
         
        <thead>
                                                    <tr>
                                                        <th rowspan="2" style="border:1px solid #ccc;">Student  Name</th>
                                                        <th rowspan="2" style="border:1px solid #ccc;">Student  Email</th>
                                                    <?php 
                                                        if(!empty($unique_types)){
                                                            foreach($unique_types as $unique_type){
                                                                //echo "<pre>"; print_r($rec); die();
                                                    ?>    
                                                        <th colspan="4" style="text-align:center ! important;border:1px solid #ccc;"><?php $coursedet=getCorse_details_by_ID($unique_type);
                                                        echo $coursedet['CourseTitle']."<br>(".$coursedet['Course'].")" ?></th>
                                                    <?php } } ?> 
                                                       <!-- <th>Total Credits</th>-->
                                                        
                                                                                                
                                                    </tr>
                                                    
                                                    <tr>
                                                    <?php
                                                    
                                                     if(!empty($unique_types)){
                                                      foreach($unique_types as $unique_type){
                                                        ?>
                                                           
                                                            <th style="border:1px solid #ccc;">Credit</th>
                                                            <th style="border:1px solid #ccc;">Year</th>
                                                             <th style="border:1px solid #ccc;">Semester</th>
                                                             <th><?php
                                                            if($type == 'W')
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
                                                            foreach($recordss as $rec){
                                                                //echo "<pre>"; print_r($rec); die();
                                                    ?>
                                                    <tr>
                                                        <td  style="border:1px solid #ccc;text-align:left;"><?php echo $rec['firstname']; echo "  ".$rec['lastname']?></td>
                                                        <td  style="border:1px solid #ccc;text-align:left;"><?php 
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
                                                         ?>
                                                        
                                                         <?php  
                                                            foreach ($unique_types as $key => $value) {
                                                            $show_year = '';
                                                            $sem = '';
                                                            $grade = '';
                                                            $earn_credit= '';
                                                            
                                                            $completion_date = '';
                                                            
                                                            $comment = "";
                                                            
                                                            /*if($type == 'W')
                                                            {
                                                                $comment = "Withdrawn Date : ";
                                                            }*/
                                                           
                                                            /* foreach ($corse as  $valuee) {*/
                                                                /*if($valuee==$value){*/
                                                                if(!empty($records)){
                                                            foreach($records as $recc){ 
                                                                if($recc['firstname']==$rec['firstname'] && $recc['lastname']==$rec['lastname'] && $recc['course_row_id']==$value ){
                                                                   
                                                                   //$grade = $recc['credits'];
                                                                    /*if($recc['Grade'] == 'W')
                                                                     {
                                                                         
                                                                     }
                                                                     else if($recc['Grade'] == 'AUDIT')
                                                                     {
                                                                         $grade = $recc['Grade'];
                                                                     }
                                                                      else if($recc['Grade'] =='SCH')
                                                                     {
                                                                         $grade = $recc['Grade'];
                                                                     }
                                                                     
                                                                     
                                                                     else if($recc['Grade'] == 'I')
                                                                     {
                                                                         $grade = 'Incomplete';
                                                                     }
                                                                    
                                                                     else
                                                                     {
                                                                         $grade = 'Complete';
                                                                     }*/
                                                                    $show_year = $recc['Class'];
                                                                    $sem = $recc['Semester'];
                                                                    $earn_credit = $recc['credits'];
                                                                    $completion_date = $recc['completion_date'];
                                                                }
                                                                
                                                                    
                                                                  /*}*/} 
                                                                }

                                                             /* }*/
                                                             
                                                             if($completion_date != '')
                                                             {
                                                                $completion_date = date('m/d/Y',strtotime($completion_date)); 
                                                             }
                                                            
                                                            echo '<td style="border:1px solid #ccc;">'.$earn_credit."</td>";
                                                             echo '<td style="border:1px solid #ccc;">'.$show_year.'</td><td style="border:1px solid #ccc;">'.$sem."</td>";
                                                             
                                                              echo '<td style="border:1px solid #ccc;">';
                                                                 echo $comment.$completion_date;
                                                                echo "</td>";
                                                             
                                                             ?>
                                                              
                                                        
                                                         <?php  } ?>
                                                        
                                                        
                                                    </tr>
                                                    <?php }}?>
                                                </tbody>
</table>