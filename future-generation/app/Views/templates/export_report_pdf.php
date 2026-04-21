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
            



<style>
    .col
    {
        border:1px solid #ccc;
    }
</style>

<table id="SemesterListing" class="table table-striped table-bordered col" style="width:100%">
         
        <thead>
            <tr>
                <th style="border:1px solid #ccc;width:20%;">Student Name</th>
                <th style="border:1px solid #ccc;width:21%;">Student Email</th>
                <th style="border:1px solid #ccc;width:29%;">Course Name</th> 
                <th style="width:12%;">Status</th>
                <th style="width:6%;">Earn Credit</th>
                <th style="width:4%;">Year</th>
                <th style="width:8%;">Semester</th>
                                                        
            </tr>
                                                    
            <?php
            
            
              if(!empty($recordss))
              {
                foreach($recordss as $rec)
                {
                    ?>
                    <tr>
                        <td style="border:1px solid #ccc;"><?= $rec['firstname']."  ".$rec['lastname'] ?></td>
                    <?php
                   
                     $email=getEmaill($rec['StudentID']); 
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
                        echo '<td style="border:1px solid #ccc;">'.$user_email."</td>";
                     }
                     else
                     {
                        if(isset($email[0]['Email'])){ echo '<td style="border:1px solid #ccc;">'.$email[0]['Email']."</td>"; }
                     }
                     
                     
                     // get enrolled class and semester by filter
                    $courses = get_enrolled_course_filter_wise($rec['StudentID'],$selectedclass,$selectedclassto,$selected_semester,$selected_course);
                     if(!empty($courses))
                     {
                         echo '<td style="border:1px solid #ccc;">';
                         echo $courses[0]['CourseTitle']." (".$courses[0]['Course'].")";
                          echo "</td>";
                          
                          $grade = '';
                         if($courses[0]['Grade'] == 'W')
                         {
                             $grade = $courses[0]['Grade'];
                         }
                         else if($courses[0]['Grade'] == 'AUDIT')
                         {
                             $grade = $courses[0]['Grade'];
                         }
                          else if($courses[0]['Grade'] =='SCH')
                         {
                             $grade = $courses[0]['Grade'];
                         }
                         
                         
                         else if($courses[0]['Grade'] == 'I')
                         {
                             $grade = 'Incomplete';
                         }
                        
                         else
                         {
                             $grade = 'Complete';
                         }
                            echo '<td style="border:1px solid #ccc;">';
                            echo $grade;
                            echo "</td>";
                            echo '<td style="border:1px solid #ccc;">';
                            echo $courses[0]['CreditEarned'];
                            echo "</td>";
                            echo '<td style="border:1px solid #ccc;">';
                            echo $courses[0]['Class'];
                            echo "</td>";
                            
                             echo '<td style="border:1px solid #ccc;">';
                            echo $courses[0]['Semester'];
                            echo "</td>";
                          
                            echo "</tr>";    
                            for($j=1;$j<sizeof($courses);$j++)
                            {
                                ?>
                                <tr>
                                    <td colspan="2">
                                    </td>
                                    <td style="border:1px solid #ccc;"><?php echo $courses[$j]['CourseTitle']." (".$courses[$j]['Course'].")" ; ?></td>
                                    
                                    
                                        <?php 
                                        $grade = '';
                                         if($courses[$j]['Grade'] == 'W')
                                         {
                                             $grade = $courses[$j]['Grade'];
                                         }
                                         else if($courses[0]['Grade'] == 'AUDIT')
                                         {
                                             $grade = $courses[$j]['Grade'];
                                         }
                                          else if($courses[$j]['Grade'] =='SCH')
                                         {
                                             $grade = $courses[$j]['Grade'];
                                         }
                                         
                                         
                                         else if($courses[$j]['Grade'] == 'I')
                                         {
                                             $grade = 'Incomplete';
                                         }
                                        
                                         else
                                         {
                                             $grade = 'Complete';
                                         }
                                        ?>
                                      <td style="border:1px solid #ccc;"><?php echo $grade; ?></td>
                                      
                                      <td style="border:1px solid #ccc;"><?php echo $courses[$j]['CreditEarned']; ?></td>
                                       <td style="border:1px solid #ccc;"><?php echo $courses[$j]['Class']; ?></td>
                                        <td style="border:1px solid #ccc;"><?php echo $courses[$j]['Semester']; ?></td>
                                    
                                </tr>
                                <?php
                            }
                     }
                     else
                     {
                          echo "<td>";
                          echo "</td>";
                            echo "</tr>";    
                     }
                  
                         
                       
                      
                       
                    
                            
                    
                }
                                              
  
              }
   
       
                                                    
                                       ?>             
                                                   
                                                    
                                                </tbody>
</table>