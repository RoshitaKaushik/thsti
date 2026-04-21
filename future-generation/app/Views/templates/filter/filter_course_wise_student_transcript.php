<?php if(!empty($selected_course_detail)){ ?>
<style>
    #SemesterListing_filter{
        position: relative;
        top: -80px;
    }
    #SemesterListing_wrapper{
        top: -27px;
        position: relative;
    }
	 .course_detal_table th{
        font-size:12px;
    }
    .course_detal_table td{
        font-size:12px;
    }
</style>
<div class="col-md-12" style="z-index: 1;">
    <table class='table table-striped table-bordered course_detal_table' style='margin-bottom:20px;'>
        <tbody>
            <tr>
                <th style="text-align:left;"><b>Course Title :</b></th>
                <td style="text-align:left;" class="selectedd_course">&nbsp;&nbsp;<?= $selected_course_detail['CourseTitle']; ?></td>
                <th style="text-align:left;"><b>Professor:</b></th>
                <td style="text-align:left;" class="selectedd_course">&nbsp;&nbsp;<?= $selected_course_detail['Professor']; ?></td> 
            </tr>
            <tr>
                <th style="text-align:left;"><b>Semester - Class :</b></th>
                
                <td style="text-align:left;">&nbsp;&nbsp;<?= $selected_course_detail['Semester']." - ".$selected_course_detail['Class']; ?></td>
            
                <th style="text-align:left;"><b>Course Date :</b></th>
              
                <td style="text-align:left;">&nbsp;&nbsp;
                <?= ($selected_course_detail['start_date'] != '' && $selected_course_detail['start_date'] != '0000-00-00')?date('m/d/Y',strtotime($selected_course_detail['start_date'])):''; ?>
                <?= ($selected_course_detail['end_date'] != '' && $selected_course_detail['end_date'] != '0000-00-00')?"-".date('m/d/Y',strtotime($selected_course_detail['end_date'])):''; ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php } ?>

<style>
    #SemesterListing tbody tr{
        background:#fff;
    }
</style>

<!--class="table-responsive"-->
<div>
    <table id="SemesterListing" class="table table-striped table-bordered" style="width:100% !important;">
        <thead>
            <tr>
                <th style='text-align:left;background: #edeef5 !important;width:190px;'>Student Name</th>
                <!--th style="background: #edeef5 !important;">Incomplete/Deadline/Comments</th-->
                <th style="background: #edeef5 !important;">Grade</th>
                <th style="background: #edeef5 !important;">CreditAttempt</th>
                <th style="background: #edeef5 !important;">CreditEarned</th>
                <th style="background: #edeef5 !important;">Grade Value</th>
                <th style="background: #edeef5 !important;">Quality Points</th>
                <th style="background: #edeef5 !important;">Expected Completion Date</th>
                <th style="background: #edeef5 !important;">Action</th>
            </tr>
        </thead>
        <tbody> 
            <?php
            if(!empty($recordss)){
                $ref_count = 1;
                foreach($recordss as $rec){
                ?>
                    <tr id="TextBoxDivTS<?php echo $ref_count; ?>"> 
                        <td style='text-align:left;'>
                             <a href="<?= base_url() ?>admin/Form/ViewApp/<?= $rec['ID'] ?>" target="_blank"><?php echo $rec['firstname']; echo "  ".$rec['lastname']." - ".$rec['ID']?></a>
                            <input type="hidden" name="studentid<?=$ref_count?>" id="studentid<?=$ref_count?>" value="<?= $rec['ID'] ?>">
                            <input type="hidden" name="transcript_rowid<?php echo $ref_count;?>" id="transcript_rowid<?php echo $ref_count; ?>" value="<?= $rec['Transcript_RowID']; ?>">
                            <input type="hidden" class="form-control" name="withdrawn_date[<?=$ref_count ?>]" id="withdrawn_date<?=$ref_count?>" value="<?= $rec['withdrawn_date'] ?>">
                            <input type="hidden" class="form-control" id="transcriptclass<?= $ref_count ?>" value="<?= $rec['Class'] ?>">
                            <input type="hidden" value="<?= $rec['CourseID'] ?>" id="course_id<?= $ref_count ?>">
                        </td>
                        
                        
                        <td><?php
                                if(isset($rec['Grade'])){
                                    if($rec['Grade'] == 'W'){ ?>
                                       <span class="view_withdrawn_date" id="with_date<?= $ref_count ?>" rel_id="<?= $ref_count ?>" rel_date="<?= $rec['withdrawn_date'] ?>" style="cursor:pointer;"><i class="fa fa-eye"></i></span>
                                      <?php } else{ ?>
                                       <span class="view_withdrawn_date" style="display:none;" id="with_date<?= $ref_count ?>" rel_id="<?= $ref_count ?>" rel_date="<?= $rec['withdrawn_date'] ?>"  style="cursor:pointer;"><i class="fa fa-eye"></i></span>
                                      <?php 
                                    }
                                }
                            ?>
                            <span class="show"><?php echo $rec['Grade'];?></span>
                            <select name="grade[<?=$ref_count?>]" id="grade<?=$ref_count?>" data-rowid="<?=$ref_count?>" class="form-control grade hide validate<?= $ref_count ?>">
                                <option value="">Select grade</option>
                                <?php foreach($transcriptgrades as $row){
                                	$gflag=($row['Grade']==$rec['Grade'] ? 'selected="selected"':'');
                                	?>
                                <option value="<?php echo $row['Grade'];?>" <?php echo $gflag;?>><?php echo $row['Grade'];?></option>
                                <?php }?>
                            </select>
                        </td>
                        
                        <td>
                            <span class="show"><?= $rec['CreditAttempt'] ?></span>
                            <input type="text" readonly class="form-control credit num hide validate<?= $ref_count ?>" value="<?= $rec['CreditAttempt'] ?>" id="credits<?php echo $ref_count;?>">
                        </td>
                        <td>
                            <span class="show"><?= $rec['CreditEarned'] ?></span>
                            <input class="form-control old_creditearned num" id="old_creditearned<?php echo $ref_count;?>" name="old_creditearned[<?php echo $ref_count;?>]" type="hidden" value="<?php echo $rec['CreditEarned']; ?>">
                            <input type="text"  class="form-control creditearned num hide validate<?= $ref_count ?>" value="<?= $rec['CreditEarned'] ?>" id="creditearned<?php echo $ref_count;?>">
                        </td>
                        <td>
                            <span class="show"><?= $rec['GradeValue'] ?></span>
                            <input type="text" readonly class="form-control gradevalue hide validate<?= $ref_count ?>" value="<?= $rec['GradeValue'] ?>" id="grade_value<?php echo $ref_count;?>">
                        </td>
                        <td>
                            <span class="show">
                                <?php $quality_points = $rec['CreditEarned'] * $rec['GradeValue'];
                                    echo  number_format((float)$quality_points, 1, '.', '');
                                ?>
    					  </span>
                            <input type="text" readonly class="form-control qualitypoint hide validate<?= $ref_count ?>" value="<?php
                            $quality_points = $rec['CreditEarned'] * $rec['GradeValue'];
    						 echo  number_format((float)$quality_points, 1, '.', '');
    					  ?>" id="qualitypoint<?php echo $ref_count;?>">
                        </td>
                        <td>
                            <span class="show">
                                <?= ($rec['completion_date'] != '' && $rec['completion_date'] != '0000-00-00')?date('m/d/Y',strtotime($rec['completion_date'])):'' ?>
                            </span>
                            <input type="text" class="form-control completion_date datepicker date hide" id="completion_date<?php echo $ref_count;?>" value="<?= ($rec['completion_date'] != '' && $rec['completion_date'] != '0000-00-00')?date('m/d/Y',strtotime($rec['completion_date'])):'' ?>">
                        </td>
                        <td style="text-align:center;">
                            <div class="col-md-4">
                            <a href="javascript:void(0)" id="save-transcript<?php echo $ref_count;?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5 hide save-transcript hide" data-id="<?= $rec['ID'] ?>" data-row="<?= $ref_count ?>">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                <span><strong></strong></span>            
                            </a>
                            </div>
                           <div class="col-md-4">
                            <a href="javascript:void(0)" id="cancel-transcript<?php echo $ref_count;?>"  class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-transcript hide pull-left" data-id="<?=$rec['StudentID']?>" data-row="<?=$ref_count?>">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                <span><strong></strong></span>            
                            </a>
                            </div>
                            <div class="col-md-12">
                            <a href="javascript:void(0)" id="edit-transcript<?php echo $ref_count;?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-transcript show pull-left" data-id="<?=$rec['StudentID']?>" data-row="<?=$ref_count?>" style="text-align:center;">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                <span><strong></strong></span>
                            </a>
                            </div>
                            
                        </td>
                    </tr>
                <?php $ref_count++; }}?>
        </tbody>
    </table> 
</div>
