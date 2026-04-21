<?php
$access = getAccess(3); //3 for donation/payments
$studentid = isset($studentid) ? $studentid : '';

$attr = array('class' => 'cmxform form-horizontal tasi-form research', 'id' => '');
echo form_open_multipart('admin/form/submitApplication', $attr);
$show_reports = false;
?>
<style>
    .pull-right {
        float: left;
    }

    .brown {
        color: #800000;
    }

    #edit_audit_rate,
    #edit_scholar_adjustment,
    #audit_rate,
    #scholar_adjustment {
        text-align: left ! important;
    }
</style>
<?php if (session()->get('role') == 1) { ?>
    <a href="<?= base_url('admin/PdfBuilder/donarReportNewPdf/') . encryptor('encrypt', $studentid) ?>" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-left" target="_blank">Donor Report</a>

<?php } ?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th width="5%">S.No </th>
            <th width="10%">Received Date <span class="requires">*</span></th>
            <th width="20%">Payment Type <span class="requires">*</span></th>
            <th width="20%">Check Number </th>
            <th width="20%">Amount <span class="requires">*</span></th>
            <th width="20%">Campaign <span class="requires">*</span></th>
            <th width="20%">Receipt date</th>
            <th width="20%">Added By</th>
            <th width="20%">Added Date</th>
            <th width="10%">Action</th>
        </tr>
    </thead>
    <div class="pull-right brown"><b>Total Amount : <span id="grandtotaltop"></span></b></div>
    <tbody class="tbl-body-donation">
        <?php
        $ref_count = 0;
        $ref = getDonationPayment(isset($studentid) ? $studentid : 0);
        $totalAmmount = 0;
        if (!empty($ref)) {
            $ref_count = 0;
            echo '<input type= "hidden" id="count7" value="' . (count($ref) + 1) . '" >';

            foreach ($ref as $user) {
                $totalAmmount += $user['Amount'];
                $ref_count++;
        ?>
                <tr id="TextBoxDivDP<?php echo $ref_count; ?>">
                    <td rowspan="2" style="vertical-align: middle;">
                        <?php echo $ref_count; ?>
                    </td>
                    <td>
                        <input type="hidden" name="ref_id[<?= $ref_count; ?>]" value="<?php if (isset($user['referee_id'])) {
                                                                                            echo $user['referee_id'];
                                                                                        } ?>">
                        <input type="hidden" name="DonorID[<?= $ref_count; ?>]" id="DonorID<?= $ref_count; ?>" value="<?php if (isset($user['DonorID'])) {
                                                                                                                            echo $user['DonorID'];
                                                                                                                        } ?>">

                        <input type="hidden" name="Donor_RowID[<?= $ref_count; ?>]" id="Donor_RowID<?= $ref_count; ?>" value="<?php if (isset($user['Donor_RowID'])) {
                                                                                                                                    echo $user['Donor_RowID'];
                                                                                                                                } ?>">

                        <span class="show">
                            <?php if (isset($user['ReceivedDate'])) {
                                echo convertDateString($user['ReceivedDate']);
                            } ?>
                        </span>
                        <input class="form-control datepickerbackward  num hide donation_date" id="ReceivedDate<?= $ref_count; ?>" name="ReceivedDate[<?= $ref_count; ?>]" type="text" value="<?php if (isset($post['ReceivedDate'])) {
                                                                                                                                                                                                    echo $post['ReceivedDate'];
                                                                                                                                                                                                } else if (isset($user['ReceivedDate'])) {
                                                                                                                                                                                                    echo convertDateString($user['ReceivedDate']);
                                                                                                                                                                                                } ?>" readonly>
                    </td>
                    <td>
                        <?php $display_sec = '';
                        if ($user['PaymentType'] != 'Student Credit') {
                            $display_sec = 'style="display:none;"';
                        }
                        echo "&nbsp;<i class='fa fa-pencil edit_course' " . $display_sec . " id='edit_button" . $ref_count . "' rel_id=" . $ref_count . " rel_course=" . $user['course_id'] . " rel_credit=" . $user['credit'] . " style='cursor:pointer;'></i>"; ?>

                        <span class="show">

                            <?php if (isset($user['PaymentType'])) {
                                echo $user['PaymentType'];
                            } ?>



                        </span>
                        <select name="PaymentType[<?php echo $ref_count; ?>]" id="PaymentType<?php echo $ref_count; ?>" class="form-control hide PaymentType" rel_id="<?php echo $ref_count; ?>">
                            <option value="">Select payment Type</option>
                            <?php foreach ($payment_type as $row) {
                                $flag = ($row['PayType'] == $user['PaymentType'] ? 'selected="selected"' : '');
                            ?>
                                <option value="<?php echo $row['PayType']; ?>" <?php echo $flag; ?>><?php echo $row['PayType']; ?>
                                <?php } ?>
                        </select>
                    </td>
                    <td>
                        <span class="show">
                            <?php if (isset($user['CheckNumber'])) {
                                echo $user['CheckNumber'];
                            } ?>
                        </span>
                        <input class=" form-control hide" id="CheckNumber<?= $ref_count; ?>" name="CheckNumber[<?= $ref_count ?>]" type="text" value="<?php if (isset($user['CheckNumber'])) {
                                                                                                                                                            echo $user['CheckNumber'];
                                                                                                                                                        } ?>">
                    </td>
                    <td>
                        <span class="show calculator-section">
                            <?php if (isset($user['Amount'])) {
                                echo number_format($user['Amount'], 2);
                            } ?>
                        </span>
                        <input class=" form-control decimal hide" id="Amount<?= $ref_count; ?>" name="Amount[<?= $ref_count; ?>]" type="text" value="<?php if (isset($user['Amount'])) {
                                                                                                                                                            echo number_format((float)$user['Amount'], 2, '.', '');
                                                                                                                                                        } ?>" onkeypress="return validateFloatKeyPress(this,event)">
                    </td>
                    <td>
                        <span class="show">
                            <?php if (isset($user['Campaign'])) {
                                $cmp_result = campaignsName($user['Campaign']);
                                echo $cmp_result['CampaignName'];
                            } ?>
                        </span>
                        <select name="Campaign[<?php echo $ref_count; ?>]" id="Campaign<?php echo $ref_count; ?>" class="form-control hide">
                            <option value="">Select Campaign</option>
                            <?php foreach ($campaigns as $rows) {
                                $cflag = ($rows['CampaignID'] == $user['Campaign'] ? 'selected="selected"' : '');
                            ?>
                                <option value="<?php echo $rows['CampaignID']; ?>" <?php echo $cflag; ?>><?php echo $rows['CampaignName']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <span class="show">
                            <?php if (isset($user['ReceiptDae'])) {
                                if ($user['ReceiptDae'] != '') {
                                    echo convertDateString($user['ReceiptDae']);
                                }
                            } ?>
                        </span>
                        <input class="form-control datepickerbackward num hide donation_date" id="ReceiptDae<?= $ref_count; ?>" name="ReceiptDae[<?= $ref_count; ?>]" type="text" value="<?php if (isset($post['ReceiptDae'])) {
                                                                                                                                                                                                echo $post['ReceiptDae'];
                                                                                                                                                                                            } else if (isset($user['ReceiptDae'])) {
                                                                                                                                                                                                echo convertDateString($user['ReceiptDae']);
                                                                                                                                                                                            } ?>" readonly>
                    </td>


                    <td>
                        <span class="show"><?php if (isset($user['added_by']) && $user['added_by'] != '') {
                                                $users = getLoggedInUserName($user['added_by']);
                                                echo $user_name = $users['admin_fullname'];
                                            } ?>
                        </span>
                        <input type="text" name="login_user<?php echo $ref_count; ?>" id="login_user[<?php echo $ref_count; ?>]" value="<?php if (isset($user['added_by']) && $user['added_by'] != '') {
                                                                                                                                            $users = getLoggedInUserName($user['added_by']);
                                                                                                                                            echo $user_name = $users['admin_fullname'];
                                                                                                                                        } ?>" class="form-control hide login_user" readonly>



                    </td>


                    <td>
                        <span class="show"><?php if (isset($user['added_date']) && $user['added_date'] != '') {
                                                if ($user['added_date'] != '0000-00-00') {
                                                    echo date('m/d/Y', strtotime($user['added_date']));
                                                }
                                            } ?>
                        </span>
                        <input type="text" name="added_date<?php echo $ref_count; ?>" id="added_date[<?php echo $ref_count; ?>]" value="<?php if (isset($user['added_date']) && $user['added_date'] != '') {
                                                                                                                                            if ($user['added_date'] != '0000-00-00') {
                                                                                                                                                echo date('m/d/Y', strtotime($user['added_date']));
                                                                                                                                            }
                                                                                                                                        } ?>" class="form-control hide added_date" readonly>

                    </td>

                    <td style="width:5%;text-align:center; vertical-align:middle;" rowspan="2">
                        <?php if ($access['edit_access']) { ?>
                            <a href="javascript:void(0)" id="edit-donation<?php echo $ref_count; ?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-donation show pull-left" data-id="<?= $user['DonorID'] ?>" data-row="<?= $ref_count ?>" style="text-align:center;">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                <span><strong>Edit</strong></span>
                            </a>
                        <?php } ?>
                        <a href="javascript:void(0)" id="save-donation<?php echo $ref_count; ?>" class="btn btn-success waves-effect waves-light btn-xs m-b-5 save-donation hide pull-left save<?= $ref_count; ?>" data-id="<?= $user['DonorID'] ?>" data-row="<?= $ref_count ?>">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            <span><strong>Save</strong></span>
                        </a>



                        <a href="javascript:void(0)" rel_donation_id="<?= $user['Donor_RowID'] ?>" id="delete-donation<?php echo $ref_count; ?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 delete-donation hide pull-left delete<?= $ref_count; ?>" data-id="<?= $user['DonorID'] ?>" data-row="<?= $ref_count ?>">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            <span><strong>Delete</strong></span>
                        </a>

                        <a href="javascript:void(0)" id="cancel-donation<?php echo $ref_count; ?>" class="btn btn-primary waves-effect waves-light btn-xs m-b-5 cancel-donation hide pull-left" data-id="<?= $user['DonorID'] ?>" data-row="<?= $ref_count ?>">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            <span><strong>Cancel</strong></span>

                        </a>

                    </td>

                </tr>
                <tr id="TextBoxDivDPN<?php echo $ref_count; ?>">
                    <td><strong>Donation Note :</strong>
                        <input type="hidden" name="course[<?php echo $ref_count; ?>]" id="denotion_course<?= $ref_count ?>" value="<?= $user['course_id'] ?>">
                        <input type="hidden" name="student_credit[<?php echo $ref_count; ?>]" id="student_credit<?= $ref_count ?>" value="<?= $user['credit'] ?>">


                        <input type="hidden" name="student_credit_note[<?php echo $ref_count; ?>]" id="student_credit_note<?= $ref_count ?>" value="<?= $user['credit_note'] ?>">
                        <input type="hidden" name="scholar_adjustment[<?php echo $ref_count; ?>]" id="scholar_adjustment<?php echo $ref_count; ?>" value="<?= $user['scholor_adjustment'] ?>">
                        <input type="hidden" name="scholar_adjustment_note[<?php echo $ref_count; ?>]" id="scholar_adjustment_note<?php echo $ref_count; ?>" value="<?= $user['scholor_adjustment_note'] ?>">


                    </td>
                    <td colspan="6" style="vertical-align: middle;">
                        <span class="show" style="text-align:left;">
                            <?php if (isset($user['DonationNote'])) {
                                echo $user['DonationNote'];
                            } ?>
                        </span><textarea name="DonationNote[<?php echo $ref_count; ?>]" id="DonationNote<?php echo $ref_count; ?>" class="form-control hide" style="align-content:left;"><?php if (isset($user['DonationNote'])) {
                                                                                                                                                                                                echo $user['DonationNote'];
                                                                                                                                                                                            } ?></textarea>
                    </td>
                </tr>
        <?php }
        } ?>


        <?php if ($access['add_access']) { ?>
            <tr id="TextBoxDivDP<?php echo $ref_count + 1; ?>">
                <td rowspan="2" style="vertical-align: middle;">
                    <?php echo $ref_count + 1; ?>
                </td>
                <td> <input type="hidden" id="count7" value="2">

                    <input type="hidden" name="DonorID[<?= $ref_count + 1; ?>]" id="DonorID<?= $ref_count + 1; ?>" value="<?php if (isset($studentid)) {
                                                                                                                                echo $studentid;
                                                                                                                            } ?>">
                    <input type="hidden" name="Donor_RowID[<?= $ref_count + 1; ?>]" id="Donor_RowID<?= $ref_count + 1; ?>" value="">
                    <span class="hide">
                    </span>
                    <input class="form-control datepickerbackward num donation_date" id="ReceivedDate<?php echo $ref_count + 1; ?>" name="ReceivedDate[<?php echo $ref_count + 1; ?>]" type="text" readonly>
                </td>
                <td>
                    <span class="hide">
                    </span>
                    <select name="PaymentType[<?php echo $ref_count + 1; ?>]" id="PaymentType<?php echo $ref_count + 1; ?>" class="form-control PaymentType" rel_id="<?php echo $ref_count + 1; ?>">
                        <option value="">Select payment Type</option>
                        <?php foreach ($payment_type as $row) { ?>
                            <option value="<?php echo $row['PayType']; ?>"><?php echo $row['PayType']; ?>

                            <?php } ?>
                    </select>
                    <p id="show_edit<?= $ref_count + 1 ?>"></p>
                </td>
                <td>
                    <span class="hide">
                    </span>
                    <input class="form-control" id="CheckNumber<?php echo $ref_count + 1; ?>" name="CheckNumber[<?php echo $ref_count + 1; ?>]" type="text">
                </td>
                <td>
                    <span class="hide calculator-section">
                    </span>
                    <input class="form-control decimal" id="Amount<?php echo $ref_count + 1; ?>" name="Amount[<?php echo $ref_count + 1; ?>]" type="text" onkeypress="return validateFloatKeyPress(this,event)">
                </td>
                <td>
                    <span class="hide">
                    </span>
                    <select name="Campaign[<?php echo $ref_count + 1; ?>]" id="Campaign<?php echo $ref_count + 1; ?>" class="form-control">
                        <option value="">Select Campaign</option>
                        <?php foreach ($campaigns as $rows) { ?>
                            <option value="<?php echo $rows['CampaignID']; ?>"><?php echo $rows['CampaignName']; ?></option>
                        <?php } ?>
                    </select>
                </td>

                <td>
                    <span class="hide"></span>
                    <input class="form-control datepickerbackward num donation_date" id="ReceiptDae<?php echo $ref_count + 1; ?>" name="ReceiptDae[<?php echo $ref_count + 1; ?>]" type="text" readonly>
                </td>

                <td>
                    <span class="hide"></span>
                    <input type="text" class="form-control login_user" name="login_user<?php echo $ref_count + 1; ?>" id="login_user<?php echo $ref_count + 1; ?>" value="<?php echo session()->get('admin_fullname'); ?>" readonly>
                </td>

                <td>
                    <span class="hide"></span>
                    <input type="text" class="form-control added_date" name="added_date<?php echo $ref_count + 1; ?>" id="added_date<?php echo $ref_count + 1; ?>" value="<?php echo date('m/d/Y'); ?>" readonly>
                </td>

                <td rowspan="2" style="vertical-align:middle">
                    <?php if ($access['edit_access']) { ?>
                        <!--<input type="submit" name="sub" value="save">-->
                        <a href="javascript:void(0)" id="edit-donation<?php echo $ref_count + 1; ?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-donation hide pull-left" data-id="<?= $studentid ?>" data-row="<?= $ref_count + 1 ?>" style="text-align:center;">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            <span><strong>Edit</strong></span>
                        </a>
                    <?php } ?>


                    <?php if ($access['add_access']) { ?>
                        <a href="javascript:void(0)" id="add-donation<?= $ref_count + 1 ?>" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-donation">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            <span><strong>ADD</strong></span>
                        </a>

                        <a href="javascript:void(0)" id="save-donation<?= $ref_count + 1 ?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-donation hide pull-left save<?= $ref_count + 1; ?>" data-id="<?= $studentid ?>" data-row="<?= $ref_count + 1 ?>">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            <span><strong>Save</strong></span>
                        </a>

                        <span id="delete_button<?= $ref_count + 1 ?>">

                        </span>

                    <?php } ?>

                    <a href="javascript:void(0)" id="cancel-donation<?php echo $ref_count + 1 ?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-donation hide pull-left" data-row="<?php echo $ref_count + 1 ?>">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        <span><strong>Cancel</strong></span>
                    </a>
                </td>
            </tr>
            <tr id="TextBoxDivDPN<?php echo $ref_count + 1; ?>">
                <td>
                    <strong>Donation Note :</strong>
                    <input type="hidden" name="course[<?php echo $ref_count + 1; ?>]" id="denotion_course<?= $ref_count + 1 ?>">
                    <input type="hidden" name="student_credit[<?php echo $ref_count + 1; ?>]" id="student_credit<?= $ref_count + 1 ?>">
                    <input type="hidden" name="student_credit_note[<?php echo $ref_count + 1; ?>]" id="student_credit_note<?= $ref_count + 1 ?>">

                    <input type="hidden" name="scholar_adjustment[<?php echo $ref_count + 1; ?>]" id="scholar_adjustment<?php echo $ref_count + 1; ?>">
                    <input type="hidden" name="scholar_adjustment_note[<?php echo $ref_count + 1; ?>]" id="scholar_adjustment_note<?php echo $ref_count + 1; ?>">

                </td>
                <td colspan="7"><span class="hide" style="text-align:left;"></span><textarea name="DonationNote[<?php echo $ref_count + 1; ?>]" id="DonationNote<?php echo $ref_count + 1; ?>" class="form-control" style="align-content:left;"></textarea></td>
            </tr>
        <?php     }
        $count7 = $ref_count == 0 ? 1 : $ref_count;
        ?>

        <tr id="TextBoxDivDPN1" class="grand-total1">
            <td colspan="4">
            </td>

            <!-- <td>
		<strong>Total Amount : <span id="grandtotal"><?php //echo number_format($totalAmmount); 
                                                        ?></span></strong>
		</td> -->
            <td colspan="5"></td>
        </tr>
    </tbody>
</table>
<!-- <button type="submit" class="btn btn-success center-block">Save</button> -->

<?php echo form_close(); ?>

<!-- add bootstrap modal -->
<!-- Trigger the modal with a button -->



<div class="modal fade" id="course_modal" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                <h4 class="modal-title">Couses</h4>
            </div>
            <div class="modal-body">


                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <input type="hidden" name="view_rel_id" id="modal_rel_id">
                            <label>Class</label>
                            <select class="form-control paymentclass">
                                <option value="">Select Class</option>
                                <?php foreach ($assign_class as $row) { ?>
                                    <option value="<?php echo $row['Class'] ?>"><?php echo $row['Class']; ?></option>

                                <?php } ?>

                            </select>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Semester</label>
                            <select class="form-control payment_semester">
                                <option>Please Select Semester</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label>Course </label>
                    <select class="form-control payment_course">
                        <option>Please Select Course</option>
                    </select>
                    <div class="col-md-12" style="text-align:right;">
                        <span id="show_course_tuition"></span>
                    </div>
                </div>



                <div class="form-group">
                    <label>Tuition Credit</label>
                    <input type="text" placeholder="Enter Tuition Credit" id="audit_rate" class="form-control">
                    <input type="hidden" id="course_tuition">
                    <input type="hidden" id="scholar_tuition">
                </div>

                <div class="form-group">
                    <!--label>Tuition Adjustment Note</label-->
                    <textarea class="form-control" placeholder="Tuition Credit Note" id="tuition_adjustment_note"></textarea>
                </div>





                <div class="form-group">
                    <label>Scholarship Adjustment</label>
                    <input type="text" placeholder="Enter Scholarship Adjustment" id="scholar_adjustment" class="form-control">

                    <div class="col-md-12" style="text-align:right;">
                        <span id="show_course_scholar"></span>
                    </div>

                </div>

                <div class="form-group">
                    <!--label>Scholarship Adjustment Note</label-->
                    <textarea class="form-control" placeholder="Scholarship Adjustment Note" id="scholarship_adjustment_note"></textarea>
                </div>







            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success update_data">Submit</button>
            </div>
        </div>

    </div>
</div>




<div class="modal fade" id="edit_course_modal" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                <h4 class="modal-title">Update Couses</h4>
            </div>
            <div class="modal-body">

                <input type="hidden" name="view_rel_id" id="edit_modal_rel_id">

                <span id="edit_details"></span>


            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success update_data1">Submit</button>
            </div>
        </div>

    </div>
</div>

<!--By Prabhat 28-12-2020-->
<?php
$get_amount = 0;
$pay_type = '';
if (isset($_GET['applicatant_id'])) {
    $get_amount = get_amount_by_application_id($_GET['applicatant_id'], 79);
    $pay_type = get_amount_by_application_id($_GET['applicatant_id'], 76);
    if (!$get_amount) {
?>
        <script>
            window.location.href = "<?= base_url(); ?>admin/Finance/payments";
        </script>
<?php
    }
}
?>
<!--By Prabhat 28-12-2020-->

<div class="modal fade" id="donar_confirm_box" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Student ID</label>
                    <input type="text" style="text-align:left;" readonly class="form-control" value="<?= service('uri')->getSegment(4) ?>
" id="emp_id">
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" style="text-align:left;" readonly class="form-control" id="first_name" value="<?= $studentinformation['FirstName'] ?>">
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" style="text-align:left;" readonly class="form-control" id="last_name" value="<?= $studentinformation['LastName'] ?>">
                </div>

                <div class="form-group">
                    <label>Amount</label>

                    <?php
                    $amountValue = is_array($get_amount) && isset($get_amount['field_value'])
                        ? $get_amount['field_value']
                        : $get_amount; // fallback if it’s just an int or null
                    ?>
                    <input type="text" style="text-align:left;" readonly class="form-control"
                        id="modal_amount" value="<?= esc($amountValue) ?>">
                </div>

                <div class="form-group">
                    <label>Payment</label>

                    <input type="text" style="text-align:left;" readonly class="form-control" id="pay_type" value="<?= is_array($pay_type) ? $pay_type['field_value'] : $pay_type ?>">
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success btn-xs update_donar_data">Ok</button>
            </div>
        </div>

    </div>
</div>


<!--By Prabhat 24-12-2020-->
<?php
if (isset($_GET['applicatant_id'])) {
?>
    <script>
        $(document).ready(function() {
            $("#donar_confirm_box").modal("show");

        })
    </script>
<?php
}
?>

<script>
    $(document).ready(function() {
        amount_sum();
    });
</script>