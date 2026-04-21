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

<table style='width:100%;'>
    <tbody>
            <tr>
                <th style='font-size:24p;'><?php echo $title; ?></th>
            </tr>
            
           </tbody>
</table>
<br/><br/>


        <?php
        if($selected_course_detail)
        {
            ?>
            <table style='width:100%;' style="border:1px solid #ccc;">
              <tbody>
                  <tr>
                        <th  style="border:1px solid #ccc;">Course Title</th>
                        <td style="border:1px solid #ccc;">&nbsp;&nbsp;<?= $selected_course_detail['CourseTitle']; ?></td>
                    </tr>
                    <tr>
                        <th style="border:1px solid #ccc;">Professor</th>
                        <td style="border:1px solid #ccc;">&nbsp;&nbsp;<?= $selected_course_detail['Professor']; ?></td> 
                    </tr>
                    <tr>
                        <th style="border:1px solid #ccc;">Semester</th>
                        <td style="border:1px solid #ccc;">&nbsp;&nbsp;<?= $selected_course_detail['Semester']; ?></td>
                    </tr>
                   
                   </tbody>
        </table>
        <br><br>
            <?php
        }
        ?>
            
<br/>





<table id="SemesterListing" class="table table-striped table-bordered"  style="border:1px solid #ccc;">
         
        <thead>
           
            <tr>
                <th style="border:1px solid #ccc;">Student  Name</th>
                <th style="border:1px solid #ccc;">Grade</th>
                <th style="border:1px solid #ccc;">Incomplete/Deadline/Comment</th>
                
                                                        
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
                <td style="border:1px solid #ccc;">&nbsp;&nbsp;<?php echo $rec['firstname']; echo "  ".$rec['lastname']?></td>
               
                     <td style="border:1px solid #ccc;">
                        
                                                            <?php
                                                             if($rec['Grade'] != 'SCH')
                                                             {
                                                                 echo $rec['Grade'];
                                                             }
                                                            ?>
                                                           
                     </td>
                     <td style="border:1px solid #ccc;">
                          <?php
                                                                 if($rec['Grade'] == 'W')
                                                                 {
                                                                
                                                                     if($rec['withdrawn_date'] !=  '' && $rec['withdrawn_date'] != '0000-00-00')
                                                                     {
                                                                         echo "Withdrawn Date : ".date('m/d/Y',strtotime($rec['withdrawn_date']));
                                                                     }
                                                                 }
                                                                 else
                                                                 {
                                                                     
                                                                     if($rec['completion_date'] != '' && $rec['completion_date'] != '0000-00-00')
                                                                     {
                                                                         echo "Expected Completion Date : ".date('m/d/Y',strtotime($rec['completion_date']));
                                                                     }
                                                                 }
                                                                ?>
                     </td>
                
            </tr>
            <?php }}?>
        </tbody>
</table>