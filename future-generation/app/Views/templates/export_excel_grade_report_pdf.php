<style>
    
    th{
        font-weight:bold;
        text-align:center;
        font-family: "Times New Roman", Times, serif;
       
    }
    td
    {
        text-align:center;
        font-family: "Times New Roman", Times, serif;
        
    }
   
    .tbl_heading_row{
	
	font-weight:bold;
	font-family:arial;
	font-size:12px;
	background-color:#fff;
	
}
.tbl_main{
	font-weight:normal;
	font-family:arial;
}
.tbl_data_row{
 font-weight:normal;
 font-family:arial;
 font-size:12px; 
 
 
}

.tbl_th_row{
	font-weight:bold;
	font-family: "Times New Roman", Times, serif;
	font-size:12px;
	
}
.signature{
	
	page-break-after:always
	
}
.pagebreakavoid{
	page-break-after:avoid;
	
}
th{
	border-bottom:1px thin #000;
	
}

.innertable{
	
	border:none !important;
}


.table{
	
	margin-bottom:10px !important;
}

thead { display: table-header-group }
tfoot { display: table-row-group }
tr { page-break-inside: avoid }

   
</style>









<section class="application-form-page" style="position:relative;">
    <?php $size = sizeof($unique_types) ?>
    <table>
            <tr>
                <th colspan="10" style='font-size:50px;text-align:center;'><span style="color:#0b79a9">FUTURE</span> &nbsp;<span style="color:#007439">GENERATIONS</span>&nbsp;<span style="color:#22211d">UNIVERSITY</span></th>
            </tr>
    </table>
    <table>
            <tr>
                <th colspan="10" style='font-size:30px;text-align:center;'><br/></th>
            </tr>
    </table>
    
    <table>
            <tr>
                <th colspan="10" style='font-size:24px;text-align:center;'><?php echo $title; ?> 
                <?php
                  if($type != '')
                  {
                      ?>
                    (<?= $type; ?>) 
                    <?php
                  }
                ?>
                </th>
            </tr>
    </table>
    
    
     <table>
            <tr>
                <th colspan="10" style='font-size:30px;text-align:center;'><br/></th>
            </tr>
    </table>
    
    <table style='width:100%;'>
         <?php
                if($selected_course_detail)
                {
                    ?>
            <tr>
                <th>Course Title</th>
                <td colspan="3">&nbsp;&nbsp;<?= $selected_course_detail['CourseTitle']; ?></td>
            </tr>
            <tr>
                <th>Professor</th>
                <td colspan="3">&nbsp;&nbsp;<?= $selected_course_detail['Professor']; ?></td> 
            </tr>
            <tr>
                <th>Semester</th>
                <td colspan="3">&nbsp;&nbsp;<?= $selected_course_detail['Semester']; ?></td>
            </tr>
            <tr><th colspan="3"></th></tr>
           <?php
                }
                ?>
           <tr>
    </table>
    

<table id="SemesterListing" class="table table-striped table-bordered" border=1''  style="width:100%;">
         
        <thead>
            
            
           
                                                        <th rowspan="2" style='text-align:left;'>Student  Name</th>
                                                        <th rowspan="2" style='text-align:left;'>Student  Email</th>
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
                                                        <td style='text-align:left;'><?php echo $rec['firstname']; echo "  ".$rec['lastname']?></td>
                                                        <td style='text-align:left;'>
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
                                                         ?>
                                                        
                                                         <?php  
                                                            foreach ($unique_types as $key => $value) {
                                                            $show_year = '';
                                                            $sem = '';
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
                                                                    
                                                                    $show_year = $recc['Class'];
                                                                    $sem = $recc['Semester'];
                                                                     $earn_credit = $recc['credits'];
                                                                    $completion_date = $recc['completion_date'];
                                                                }
                                                                //echo $recc['course_row_id'];
                                                                    
                                                                  /*}*/} 
                                                                }

                                                             /* }*/
                                                             
                                                             if($completion_date != '')
                                                             {
                                                                $completion_date = date('m/d/Y',strtotime($completion_date)); 
                                                             }
                                                            
                                                            
                                                            echo "<td>".$earn_credit."</td>";
                                                             echo "<td>".$show_year."</td><td>".$sem."</td>";
                                                             
                                                              echo "<td>".$comment.$completion_date."</td>";
                                                             
                                                              ?>
                                                              
                                                        
                                                         <?php  } ?>
                                                        
                                                        
                                                    </tr>
                                                    <?php }}?>
                                                </tbody>
</table>

</section>