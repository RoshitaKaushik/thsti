<table id="SemesterListing" class="table datatable_th table-striped table-bordered" >
    <thead>
        <tr>
            <th data-name="<?= encryptor('encrypt', 'firstname') ?>" style="text-align:left;">Student  Name</th>
            <th data-name="<?= encryptor('encrypt', 'Email') ?>" style="text-align:left;">Student  Email</th>
        <?php 
            if(!empty($unique_types)){
                foreach($unique_types as $unique_type){
                    //echo "<pre>"; print_r($rec); die();
        ?>    
            <th><?php $coursedet=getCorse_details_by_ID($unique_type);
            echo $coursedet['CourseTitle']."(".$coursedet['Course'].")" ?></th>
        <?php } } ?> 
            <th data-name="<?= encryptor('encrypt', 'total_credit') ?>">Total Credits</th>
            
                                                    
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
            <td style="text-align:left;"><a href="<?= base_url('admin/Form/ViewApp/'.$rec['ID']) ?>" target="_blank"><?php echo $rec['firstname']; echo "  ".$rec['lastname']?></a></td>
            <td style="text-align:left;">
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
           // echo "<pre>";print_r($CR);echo "</pre>";
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
            
                echo "<td>";
                /* foreach ($corse as  $valuee) {*/
                    /*if($valuee==$value){*/
                    if(!empty($records)){
                foreach($records as $recc){ 
                    if($recc['firstname']==$rec['firstname'] && $recc['lastname']==$rec['lastname'] && $recc['course_row_id']==$value ){
                        echo $recc['credits'];
                    }
                    //echo $recc['course_row_id'];
                        
                      /*}*/} 
                    }

                 /* }*/
                echo "</td>";
                  ?>
            
             <?php  } ?>
             <td><?php echo $credit;?></td>
            
        </tr>
        <?php }}?>
    </tbody>
</table>