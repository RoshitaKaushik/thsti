<?php
$access = getAccess(4); //2 for transcript 
//print_r($access);
//echo "<pre>"; print_r(session()->get());
//print_r($access);
$studentid = isset($studentid) ? $studentid : '';


//echo "<pre>"; print_r(session()->get());
//print_r($trans)		;								
$attr = array('class' => 'cmxform form-horizontal tasi-form research', 'id' => '');
echo form_open_multipart('admin/form/submitApplication', $attr);
$show_reports = false;
if (session()->get('profiles')) {
    if (in_array(1, session()->get('profiles'))) {
        $show_reports = true;
    }
}
?>
</form>
<?php if (session()->get('role') == 1 || $show_reports) { ?>

    <form action="<?= base_url('admin/PdfBuilder/transcriptPdf_modal/') . encryptor('encrypt', $studentid) ?>" target="_blank" method="post">
        <input type="hidden" name="url" value="<?= base_url('admin/PdfBuilder/transcriptPdf/') . encryptor('encrypt', $studentid) ?>">
        <input type="hidden"
            name="<?= csrf_token() ?>"
            value="<?= csrf_hash() ?>">
        <input type="submit" class="btn btn-success bxn-xs  pull-right" value="Generate Report P" style="margin-left: 5px;">
    </form>

<?php } ?>
<a href="<?php echo base_url(); ?>admin/form/generate_excell/<?php echo encryptor('encrypt', $studentid); ?>" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" target="_blank">Export Excel</a>
<a href="<?php echo base_url(); ?>admin/form/generate_pdf_plan/<?php echo encryptor('encrypt', $studentid); ?>" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" target="_blank">Plan Study</a>

<div class="col-md-12" style="overflow-x:scroll;">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th width="10%">Year<span class="requires">*</span></th>
                <th width="10%">Semester<span class="requires">*</span></th>
                <th width="10%">Session</th>
                <th width="20%">Course <span class="requires">*</span></th>
                <th width="20%">Course Date <span class="requires">*</span></th>
                <th width="25%">Course title</th>
                <th width="20%">Professor</th>
                <th width="10%">Grade <span class="requires">*</span></th>
                <th width="10%">CreditAttempt</th>
                <th width="10%">CreditEarned</th>
                <th width="10%">Grade Value</th>
                <th width="10%">Quality Points</th>
                <th style="width:100px !important;">Expected <br>Completion Date</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody class="tbl-body-transcript">

            <!-- last row add in first -->
            <?php if ($access['add_access']) {
                $arr_count = getTranscript(isset($studentid) ? $studentid : 0);
                /* echo "<pre>";
			 print_r($arr_count);
			 echo "</pre>";	*/
                $ref_count = count($arr_count);
            ?>
                <tr id="TextBoxDivTS<?php echo $ref_count + 1; ?>">
                    <td>
                        <input type="hidden" name="studentid<?= $ref_count + 1 ?>" id="studentid<?= $ref_count + 1 ?>" value="<?php if (isset($studentid)) {
                                                                                                                            echo $studentid;
                                                                                                                        } ?>">
                        <input type="hidden" name="transcript_rowid<?php echo $ref_count + 1; ?>" id="transcript_rowid<?php echo $ref_count + 1; ?>" value="">
                        <span class="hide"></span>
                        <select name="transcriptclass[<?php echo $ref_count + 1; ?>]" data-rowid="<?= $ref_count + 1 ?>" id="transcriptclass<?php echo $ref_count + 1; ?>" class="form-control show studentClass">
                            <option value="">Select Class</option>
                            <?php foreach ($transcriptclass as $row) { ?>
                                <option value="<?php echo $row['Class'] ?>"><?php echo $row['Class']; ?></option>

                            <?php } ?>

                        </select>
                    </td>
                    <td>
                        <span class="hide"></span>
                        <select name="semester[<?php echo $ref_count + 1; ?>]" id="semester<?php echo $ref_count + 1; ?>" class="form-control semester" required>
                            <option value="">Select Semester</option>
                        </select>
                    </td>

                    <td> <input type="hidden" id="count7" value="2">
                        <span class="hide"></span>
                        <select name="term[<?php echo $ref_count + 1; ?>]" class="form-control term" id="term<?php echo $ref_count + 1 ?>" disabled>
                            <option value="">Select Session</option>
                        </select>
                    </td>


                    <td>
                        <span class="hide"></span>
                        <select name="course[<?php echo $ref_count + 1; ?>]" class="form-control course" id="course<?php echo $ref_count + 1; ?>">
                            <option value="">Select Course</option>
                        </select>
                    </td>
                    <td>
                        <span class="hide">
                        </span>
                        <textarea name="CourseDates[<?= $ref_count + 1 ?>]" id="coursedates<?= $ref_count + 1 ?>" class="form-control coursedates textarea" readonly></textarea>

                    </td>
                    <td>
                        <span class="hide"></span>

                        <textarea name="coursetitle[<?php echo $ref_count + 1; ?>]" id="coursetitle<?php echo $ref_count + 1; ?>" class="form-control coursetitle textarea" readonly></textarea>
                    </td>
                    <td>
                        <span class="hide"></span>
                        <textarea name="professor[<?php echo $ref_count + 1; ?>]" id="professor<?php echo $ref_count + 1; ?>" class="form-control professor textarea" readonly></textarea>
                    </td>
                    <td>

                        <span class="hide"></span>

                        <select name="grade[<?= $ref_count + 1 ?>]" id="grade<?= $ref_count + 1 ?>" data-rowid="<?= $ref_count + 1 ?>" class="form-control grade">
                            <option value="SCH">SCH</option>
                            <?php

                            //echo '<pre>'; print_r($transcriptgrades); echo '</pre>';


                            foreach ($transcriptgrades as $row) {
                                if ($row['Grade'] != 'SCH') {
                            ?>

                                    <option value="<?php echo $row['Grade']; ?>"><?php echo $row['Grade']; ?></option>
                            <?php }
                            } ?>
                        </select>
                        <span class="view_withdrawn_date" style="display:none;" id="with_date<?= $ref_count + 1 ?>" rel_id="<?= $ref_count + 1 ?>" rel_date=""><i class="fa fa-eye"></i></span>

                        <input type="hidden" class="form-control" name="withdrawn_date[<?= $ref_count + 1 ?>]" id="withdrawn_date<?= $ref_count + 1 ?>">
                    </td>
                    <td>
                        <span class="hide"></span>
                        <input class="form-control credit num" id="credits<?php echo $ref_count + 1; ?>" name="credits[<?php echo $ref_count + 1; ?>]" type="text" readonly>
                    </td>

                    <td>
                        <span class="hide"></span>
                        <input class="form-control creditearned num" id="creditearned<?php echo $ref_count + 1; ?>" name="creditearned[<?php echo $ref_count + 1; ?>]" type="text" value="3" required>
                    </td>
                    <td>
                        <span class="hide"></span>
                        <input class="form-control gradevalue num" id="grade_value<?php echo $ref_count + 1; ?>" name="grade_value[<?php echo $ref_count + 1 ?>]" type="text" readonly>
                    </td>
                    <td>
                        <span class="hide"></span>
                        <input class="form-control qualitypoint num" id="qualitypoint<?php echo $ref_count + 1; ?>" name="qualitypoint[<?php echo $ref_count + 1 ?>]" type="text" readonly>
                    </td>

                    <!-- By Prabhat 05-12-2020 -->

                    <td style="width:100px !important;">
                        <span class="hide"></span>
                        <input class="form-control completion_date date" id="completion_date<?php echo $ref_count + 1; ?>" name="completion_date[<?php echo $ref_count + 1 ?>]" type="date">
                    </td>

                    <td>
                        <?php if ($access['edit_access']) { ?>

                            <a href="javascript:void(0)" id="edit-transcript<?= $ref_count + 1 ?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-transcript hide pull-left" data-id="<?= $studentid ?>" data-row="<?= $ref_count + 1 ?>" style="text-align:center;">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                <span><strong></strong></span>
                            </a>
                        <?php } ?>
                        <?php if ($access['add_access']) { ?>
                            <a href="javascript:void(0)" id="add-transcript<?= $ref_count + 1 ?>" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-transcript">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                <span><strong></strong></span>
                            </a>
                            <a href="javascript:void(0)" id="save-transcript<?= $ref_count + 1 ?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-transcript hide pull-left" data-id="<?= $studentid ?>" data-row="<?= $ref_count + 1 ?>">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                <span><strong></strong></span>
                            </a>
                        <?php } ?>

                        <a href="javascript:void(0)" id="cancel-transcript<?php echo $ref_count + 1; ?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-transcript hide pull-left" data-id="<?php echo $studentid; ?>" data-row="<?= $ref_count + 1 ?>">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            <span><strong></strong></span>
                        </a>
                    </td>
                </tr>
            <?php
            }
            $count7 = @$ref_count == 0 ? 1 : @$ref_count;
            ?>
            <!-- last row close -->
            <?php
            $ref_count = 0;
            $ref = getTranscript(isset($studentid) ? $studentid : 0);

            //	echo "<pre>pks";print_r($ref);echo "</pre>";

            if (!empty($ref)) {
                $ref_count = 0;
                echo '<input type= "hidden" id="count7" value="' . (count($ref) + 1) . '" >';
                foreach ($ref as $trans) {
                    $ref_count++;
            ?>
                    <tr id="TextBoxDivTS<?php echo $ref_count; ?>">
                        <td>
                            <input type="hidden" class="form-control" name="withdrawn_date[<?= $ref_count ?>]" id="withdrawn_date<?= $ref_count ?>" value="<?= $trans['withdrawn_date'] ?>">
                            <span class="show"><?php if (isset($trans['Class'])) {
                                                    echo $trans['Class'];
                                                } ?></span>
                            <select name="transcriptclass[<?php echo $ref_count; ?>]" data-rowid="<?= $ref_count ?>" id="transcriptclass<?php echo $ref_count; ?>" class="form-control studentClass hide">
                                <option value="">Select Class</option>
                                <?php foreach ($editclass as $row) {

                                    if ($row['Active'] == 1) {
                                        $dispmsg = "display:block";
                                    } else if ($row['Active'] == 2 && $row['Class'] == $trans['Class']) {
                                        $dispmsg = "display:block";
                                    } else {
                                        $dispmsg = "display:none";
                                    }
                                    $flag = ($row['Class'] == $trans['Class'] ? 'selected="selected"' : '');
                                ?>
                                    <option value="<?php echo $row['Class'] ?>" <?php echo $flag; ?> style="<?php echo $dispmsg; ?>"><?php echo $row['Class']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <span class="show"><?php if (isset($trans['Semester'])) {
                                                    echo $trans['Semester'];
                                                } ?></span>
                            <select name="semester[<?php echo $ref_count; ?>]" id="semester<?php echo $ref_count; ?>" class="form-control semester hide" required>
                                <option value="">Select Semester</option>
                                <option value="<?php if (isset($trans['Semester'])) {
                                                    echo $trans['Semester'];
                                                } ?>" <?php if (isset($trans['Semester'])) {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>><?php if (isset($trans['Semester'])) {
                                                                                                                                                                                echo $trans['Semester'];
                                                                                                                                                                            } ?></option>
                            </select>

                        </td>
                        <td>
                            <input type="hidden" name="ref_id[<?= $ref_count; ?>]" value="<?php if (isset($trans['referee_id'])) {
                                                                                            echo $trans['referee_id'];
                                                                                        } ?>">
                            <input type="hidden" name="studentid<?= $ref_count ?>" id="studentid<?= $ref_count ?>" value="<?php if (isset($trans['StudentID'])) {
                                                                                                                            echo $trans['StudentID'];
                                                                                                                        } ?>">
                            <input type="hidden" name="transcript_rowid<?php echo $ref_count; ?>" id="transcript_rowid<?php echo $ref_count; ?>" value="<?php if (isset($trans['Transcript_RowID'])) {
                                                                                                                                                            echo $trans['Transcript_RowID'];
                                                                                                                                                        } ?>">
                            <span class="show">
                                <?php if (isset($trans['Term'])) {
                                    echo $trans['Term'];
                                } ?>
                            </span>

                            <select name="term[<?php echo $ref_count; ?>]" class="form-control term hide" id="term<?php echo $ref_count ?>">
                                <option value="">Select Session</option>
                                <option value="<?php if (isset($trans['Term'])) {
                                                    echo $trans['Term'];
                                                } ?>" <?php if (isset($trans['Term'])) {
                                                                                                                echo ($trans['Term'] != '' ? 'selected="selected"' : '');
                                                                                                            } ?>><?php if (isset($trans['Term'])) {
                                                                                                                                                                                                        echo $trans['Term'];
                                                                                                                                                                                                    } ?></option>
                            </select>
                        </td>
                        <td>
                            <span class="show">
                                <?php if (isset($trans['Course'])) {
                                    echo $trans['Course'];
                                } ?>
                            </span>
                            <select name="course[<?php echo $ref_count; ?>]" class="form-control course hide" id="course<?php echo $ref_count; ?>">
                                <option value="<?php if (isset($trans['CourseID'])) {
                                                    echo $trans['CourseID'];
                                                } ?>"><?php if (isset($trans['Course'])) {
                                                                                                                        echo $trans['Course'];
                                                                                                                    } ?></option>
                            </select>
                        </td>

                        <td>
                            <span class="show">
                                <?php if (isset($trans['CourseDates'])) {
                                    echo $trans['CourseDates'];
                                } ?>
                            </span>
                            <textarea class="form-control coursedates hide textarea" id="coursedates<?= $ref_count ?>" name="CourseDates[<?= $ref_count ?>]" readonly><?php if (isset($trans['CourseDates'])) {
                                                                                                                                                                        echo $trans['CourseDates'];
                                                                                                                                                                    } ?></textarea>
                        </td>
                        <td>
                            <span class="show">
                                <?php if (isset($trans['CourseTitle'])) {
                                    echo $trans['CourseTitle'];
                                } ?>
                            </span>

                            <textarea name="coursetitle[<?php echo $ref_count; ?>]" id="coursetitle<?php echo $ref_count; ?>" class="form-control coursetitle textarea hide" readonly><?php if (isset($trans['CourseTitle'])) {
                                                                                                                                                                                        echo $trans['CourseTitle'];
                                                                                                                                                                                    } ?></textarea>
                        </td>
                        <td>
                            <span class="show">
                                <?php if (isset($trans['Professor'])) {
                                    echo $trans['Professor'];
                                } ?>
                            </span>
                            <textarea name="professor[<?php echo $ref_count; ?>]" id="professor<?php echo $ref_count; ?>" class="form-control professor textarea hide" readonly><?php if (isset($trans['Professor'])) {
                                                                                                                                                                                    echo $trans['Professor'];
                                                                                                                                                                                } ?></textarea>
                        </td>
                        <td>
                            <?php
                            if (isset($trans['Grade'])) {
                                if ($trans['Grade'] == 'W') {
                            ?>
                                    <span class="view_withdrawn_date" id="with_date<?= $ref_count ?>" rel_id="<?= $ref_count ?>" rel_date="<?= $trans['withdrawn_date'] ?>"><i class="fa fa-eye"></i></span>
                                <?php
                                } else {
                                ?>
                                    <span class="view_withdrawn_date" style="display:none;" id="with_date<?= $ref_count ?>" rel_id="<?= $ref_count ?>" rel_date="<?= $trans['withdrawn_date'] ?>"><i class="fa fa-eye"></i></span>
                            <?php
                                }
                            }
                            ?>
                            <span class="show">
                                <?php if (isset($trans['Grade'])) {
                                    echo $trans['Grade'];
                                } ?>

                            </span>
                            <select name="grade[<?= $ref_count ?>]" id="grade<?= $ref_count ?>" data-rowid="<?= $ref_count ?>" class="form-control grade hide">
                                <option value="">Select grade</option>
                                <?php foreach ($transcriptgrades as $row) {
                                    $gflag = ($row['Grade'] == $trans['Grade'] ? 'selected="selected"' : '');

                                ?>
                                    <option value="<?php echo $row['Grade']; ?>" <?php echo $gflag; ?>><?php echo $row['Grade']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <span class="show">
                                <?php if (isset($trans['CreditAttempt'])) {
                                    echo $trans['CreditAttempt'];
                                } ?>
                            </span>
                            <input class="form-control hide credits num" id="credits<?php echo $ref_count; ?>" name="credits[<?php echo $ref_count; ?>]" type="text" value="<?php if (isset($trans['CreditAttempt'])) {
                                                                                                                                                                                echo $trans['CreditAttempt'];
                                                                                                                                                                            } ?>" readonly>

                        </td>

                        <td>
                            <span class="show">
                                <?php if (isset($trans['CreditEarned'])) {
                                    echo $trans['CreditEarned'];
                                } ?>
                            </span>
                            <input class="form-control hide creditearned num" id="creditearned<?php echo $ref_count; ?>" name="creditearned[<?php echo $ref_count; ?>]" type="text" value="<?php if (isset($trans['CreditEarned'])) {
                                                                                                                                                                                                echo $trans['CreditEarned'];
                                                                                                                                                                                            } ?>" required>


                        </td>
                        <td>
                            <span class="show">
                                <?php if (isset($trans['GradeValue'])) {
                                    echo number_format((float)$trans['GradeValue'], 1, '.', '');
                                } ?>
                            </span>
                            <input class="form-control gradevalue num hide mask" id="grade_value<?php echo $ref_count; ?>" name="grade_value[<?php echo $ref_count ?>]" type="text" value="<?php if (isset($trans['GradeValue'])) {
                                                                                                                                                                                                echo number_format((float)$trans['GradeValue'], 1, '.', '');
                                                                                                                                                                                            } ?>" readonly>
                        </td>

                        <td>
                            <span class="show">
                                <?php if (isset($trans['QualityPoints'])) {
                                    //echo $trans['QualityPoints'];   // enable dated 17 April 2019

                                    $quality_pointssss = $trans['CreditEarned'] * $trans['GradeValue'];   // Replcae credits to creditEarned value dated 17 April 2019
                                    echo $quality_pointssss;
                                }
                                ?>
                            </span>
                            <input class="form-control qualitypoint num hide mask" id="qualitypoint<?php echo $ref_count; ?>" name="qualitypoint[<?php echo $ref_count ?>]" type="text" value="<?php if (isset($trans['QualityPoints'])) {
                                                                                                                                                                                                    $quality_points = $trans['CreditEarned'] * $trans['GradeValue'];    // Replcae credits to creditEarned value dated 17 April 2019
                                                                                                                                                                                                    echo  number_format((float)$quality_points, 1, '.', '');
                                                                                                                                                                                                } ?>" readonly>
                        </td>

                        <td style="width:100px !important;">
                            <span class="show">
                                <?php if (isset($trans['completion_date'])) {

                                    echo $trans['completion_date'];
                                }
                                ?>
                            </span>
                            <input class="form-control hide completion_date" id="completion_date<?php echo $ref_count; ?>" name="completion_date[<?php echo $ref_count ?>]" type="date" value="<?php if (isset($trans['completion_date'])) {
                                                                                                                                                                                                    $quality_points = $trans['CreditEarned'] * $trans['GradeValue'];    // Replcae credits to creditEarned value dated 17 April 2019
                                                                                                                                                                                                    echo $trans['completion_date'];
                                                                                                                                                                                                } ?>">
                        </td>


                        <!-- End Prabhat 05-12-2020 -->

                        <td>
                            <?php if ($access['edit_access']) { ?>
                                <a href="javascript:void(0)" id="edit-transcript<?php echo $ref_count; ?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-transcript show pull-left" data-id="<?= $trans['StudentID'] ?>" data-row="<?= $ref_count ?>" style="text-align:center;">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    <span><strong></strong></span>
                                </a>
                            <?php } ?>
                            <?php if ($access['delete_access']) { ?>
                                <a href="javascript:void(0);" title="Click To Delete" rel_id="<?php echo $ref_count; ?>" id="delete_button<?php echo $ref_count; ?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 rmv hide del_transcript" data-row="<?php echo $ref_count ?>" data-urlm="<?= encryptor('encrypt', $trans['Transcript_RowID']) ?>" data-urln="<?= encryptor('encrypt', $trans['StudentID']) ?>">
                                    <span class="fa fa-trash-o" aria-hidden="true"></span>
                                    <span><strong></strong></span>
                                </a>
                            <?php }  ?>

                            <a href="javascript:void(0)" id="save-transcript<?php echo $ref_count; ?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-transcript hide pull-left" data-id="<?= $trans['StudentID'] ?>" data-row="<?= $ref_count ?>">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                <span><strong></strong></span>
                            </a>

                            <a href="javascript:void(0)" id="cancel-transcript<?php echo $ref_count; ?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-transcript hide pull-left" data-id="<?= $trans['StudentID'] ?>" data-row="<?= $ref_count ?>">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                <span><strong></strong></span>
                            </a>
                        </td>
                    </tr>
            <?php }
            } ?>

        </tbody>
    </table>
</div>

<!-- <button type="submit" class="btn btn-success center-block">Save</button>	-->
<?php echo form_close(); ?>



<div class="modal fade" id="view_withdrawn_date_model" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                <h4 class="modal-title">Withdrawn Date</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="view_rel_id" id="edit_modal_rel_id">
                <label>Withdrawn Date :</label>
                <input type="date" id="view_selected_date" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success update_withdrawn1" data-dismiss="modal">Ok</button>
            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="withdrawn_date_model" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                <h4 class="modal-title">Withdrawn Date</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="rel_id" id="modal_rel_id">
                <label>Withdrawn Date :</label>
                <input type="date" id="selected_date" value="<?= date('Y-m-d') ?>" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success update_withdrawn" data-dismiss="modal">Ok</button>
            </div>
        </div>

    </div>
</div>


<style type="text/css">
    /*.textarea{
	margin: 0px 11.25px 0px 0px;
    width: 173px;
    height: 44px;
} */
    .professor {
        margin: 0px 12.0117px 0px 0px;
        height: 44px;
        width: 145px;
    }

    .grade {
        padding-left: 0px;
        width: 68px;
    }

    .course {
        padding-left: 0px;
    }

    .term {
        padding-left: 0px;
    }

    .studentClass {
        padding-left: 0px;
    }

    #overlay {
        position: fixed;
        z-index: 5000;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        background: #000;
        opacity: 0.8;
        filter: alpha(opacity=80);
    }

    #loading {
        width: 50px;
        height: 57px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -28px 0 0 -25px;
    }

    #overlay>p {
        color: #FF9800;
        position: absolute;
        top: 60%;
        left: 49%;
        margin: -28px 0 0 -25px;
    }
</style>