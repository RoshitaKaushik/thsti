<style>
    
    th{
        font-weight:bold;
        text-align:center;
         font-family: "Times New Roman", Times, serif ! important;
    }
    td{
         font-family: "Times New Roman", Times, serif ! important;
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
	font-family:arial;
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

<table id="SemesterListing" class="table table-striped table-bordered"  style="width:100%;margin-left:10px;">
         
        <thead>
            <tr>
                <th colspan="3" style='font-size:50px;text-align:center;'><span style="color:#0b79a9">FUTURE</span> &nbsp;<span style="color:#007439">GENERATIONS</span>&nbsp;<span style="color:#22211d">UNIVERSITY</span></th>
            </tr>
             <tr><th colspan="2"><br></th></tr>
            <tr>
                <th colspan="3" style='font-size:30px;'><?php echo $title; ?></th>
            </tr>
             <tr><th colspan="3"><br></th></tr>
            <?php
                if($selected_course_detail)
                {
                    ?>
            <tr>
                <th  style="border:1px solid #000;">Course Title</th>
                <td  style="border:1px solid #000;" colspan="2">&nbsp;&nbsp;<?= $selected_course_detail['CourseTitle']; ?></td>
            </tr>
            <tr>
                <th  style="border:1px solid #000;">Professor</th>
                <td   style="border:1px solid #000;" colspan="2">&nbsp;&nbsp;<?= $selected_course_detail['Professor']; ?></td> 
            </tr>
            <tr>
                <th style="border:1px solid #000;">Semester</th>
                <td style="border:1px solid #000;" colspan="2">&nbsp;&nbsp;<?= $selected_course_detail['Semester']; ?></td>
            </tr>
            <tr><th colspan="3"><br></th></tr>
           <?php
                }
                ?>
            <tr>
                <th style="text-align:left;border:1px solid #000;">Student  Name</th>
                <th style="border:1px solid #000;">Grade</th>
                <th style="border:1px solid #000;">Incomplete/Deadline/Comment</th>
                
                                                        
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
                <td style="border:1px solid #000;">&nbsp;&nbsp;<?php echo $rec['firstname']; echo "  ".$rec['lastname']?></td>
                 <td style="border:1px solid #000;">
                     <?php
                     if($rec['Grade'] != 'SCH')
                                                             {
                                                                 echo $rec['Grade'];
                                                             }
                     ?>
                 </td>
                  <td style="border:1px solid #000;">
                      <?php
                                                                 if($rec['Grade'] == 'W')
                                                                 {
                                                                     
                                                                     if($rec['withdrawn_date'] != '' && $rec['withdrawn_date'] != '0000-00-00')
                                                                     {
                                                                         echo "Withdrawn Date : ".date('m/d/Y',strtotime($rec['withdrawn_date']));
                                                                     }
                                                                 }
                                                                 else
                                                                 {
                                                                     
                                                                     if($rec['completion_date'] != ''  && $rec['completion_date'] != '0000-00-00')
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

</section>