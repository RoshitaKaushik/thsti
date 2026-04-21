
<table class='table table-striped table-bordered hidden_div' style='margin-bottom:20px;'>
    <tbody>
        <tr>
            <th><b>Course Title</b></th>
            <th>:</th>
            <td style="text-align:left;" class="selectedd_course">&nbsp;&nbsp;$selected_course_detail['CourseTitle'] ?></td>
        </tr>
        <tr>
            <th><b>Professor</b></th>
            <th>:</th>
            <td style="text-align:left;" class="selectedd_course">&nbsp;&nbsp;<?= isset($selected_course_detail['Professor']); ?></td> 
        </tr>
        <tr>
            <th><b>Semester</b></th>
            <th>:</th>
            <td style="text-align:left;">&nbsp;&nbsp;<?= isset($selected_course_detail['Semester']); ?></td>
        </tr>
    </tbody>
</table>



<div class="table-responsive"  >
    <table id="SemesterListing" class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th style='text-align:left;'>Student  Name</th>
                <th>Grade</th>
                <th style='text-align:left;'>Incomplete/Deadline/Comments</th>                                
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
                    <td style='text-align:left;'><?php echo $rec['firstname']; echo "  ".$rec['lastname']?></td>
                    <td>
                        <?php
                        if($rec['Grade'] != 'SCH')
                        {
                            echo $rec['Grade'];
                        }
                        ?>
                    </td>  
                    <td style='text-align:left;'>
                        <?php
                        if($rec['Grade'] == 'W')
                        {
                            if($rec['withdrawn_date'] != '')
                            {
                                echo "Withdrawn Date : ".date('m/d/Y',strtotime($rec['withdrawn_date']));
                            }
                        }
                        else
                        {
                            if($rec['completion_date'] != '')
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
</div>