<?php //echo "<pre>";print_r($budget);die;
$paymenttype_js = json_encode($payment_type);
$campaigns_js = json_encode($campaigns);
/* if(isset($result[0])){
$arr = $result[0];
$CampaignID = $arr['CampaignID'];
$CampaignName = $arr['CampaignName'];
$Active = $arr['Active'];
}  */

?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        width: auto;

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

    }

    .buttons-excel {
        display: none;
    }

    #SemesterListing_info {
        display: inline;
        top: -30px;
        position: relative;
    }

    #SemesterListing {
        top: -20px;
        position: relative;
    }
</style>
<div class="">
    <!-- Start content -->
    <div class="">
        <div class="">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-color panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Organization List
                                <?php if (session()->get('role') == '1' || in_array(3, session()->get('profiles'))) { ?>
                                    <a href="<?= base_url('admin/Form/addOrganization') ?>"
                                        target="_blank" class="btn-sm btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" style="font-size: 12px;background: #fff;color: #000!important;border: 1px solid #d5d5d5;padding: 4px 12px;margin: 0;z-index:0">
                                        <i class="icon ion-plus-circled"></i>
                                        <span><strong>Add New</strong></span>
                                    </a>
                                <?php } ?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="dataTable2" class="table table-striped table-bordered alldatatable">
                                        <thead>
                                            <tr>
                                                <th>Organization Id</th>
                                                <th>Organization Name</th>
                                                <th>Website</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sn = 1;
                                            foreach ($organizationList as $org) {
                                            ?>
                                                <tr class="cd-popup-trigger" rel_id="<?= encryptor('encrypt', $org['id']) ?>" style="cursor:pointer;">
                                                    <td><?php echo "O" . $org['id']; ?></td>
                                                    <td style="text-align:left;"><?php echo $org['name']; ?></td>
                                                    <td style="text-align:left;"><?php echo $org['website']; ?></td>
                                                    <td>
                                                        <span id="pop1btn" class="btn btn-success btn-xs cd-popup-trigger" rel_id="<?= encryptor('encrypt', $org['id']) ?>">View</span>
                                                        <!--<a href="<?= base_url() ?>admin/Form/editOrganization/<?= encryptor('encrypt', $org['id']) ?>" target="_blank"><span class="btn btn-success btn-xs">View</span></a>-->
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content -->

</div>




<style>
    aside {
        position: fixed;
        top: 50px;
        right: -84vw;
        /* - width */
        width: 83vw;
        background-color: #fff;
        height: calc(100vh - 50px);
        overflow-y: auto;
        padding: 10px;
        transition: 1s;
        box-shadow: 0px 0px 7px 7px #dededf;
    }

    aside::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
    }

    aside::-webkit-scrollbar {
        width: 6px;
        background-color: #F5F5F5;
    }

    aside::-webkit-scrollbar-thumb {
        background-color: #000000;
    }

    .active {
        right: 0 !important;
    }

    aside ul li {
        list-style-type: none;
        padding: 10px;
        border-bottom: 1px solid #888;
    }

    aside ul li:hover {
        background-color: #86efff;
    }

    .pop_tabs {
        position: relative;
        background-color: #FFF;
        margin: 0 auto;
        width: 100%;
        white-space: nowrap;
        padding: 0px;
    }

    .pop_tabs li.pop_tab {
        display: block;
        float: left;
        text-align: center;
        background-color: #fff;
        margin: 0;
    }

    .pop_tabs li.pop_tab a.active {
        color: #317eeb !important;
    }

    .side_pop li.pop_tab {
        border: none;
    }

    li.pop_tab.active {
        border-bottom: 2px solid #317eeb !important;
    }

    .pop_tab {
        padding: 1px;
    }
</style>

<script>
    /* Start Pop show & html bind part  */
    let aside = document.querySelector("aside");
    $(document).on('click', '.cd-popup-trigger', function(event) {
        event.stopPropagation();
        $('.pop_tab').removeClass('active');
        $('.pop_tab').eq(0).addClass('active');
        let content = '';
        content += '<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
        content += '</main>';
        $('#pop_result').html(content);
        $('.side_pop').toggleClass("active");
        let organization_id = $(this).attr('rel_id');
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>admin/Form/get_organization_html_by_id',
            data: {
                submit: 'submit',
                organization_id: organization_id
            },
            dataType: "html",
            success: function(data) {
                $('#pop_result').html(data);
            },
        });
    })
    $(document).on('click', '.side_pop', function(event) {
        event.stopPropagation();
    })
    $(document).on('click', 'body', function() {
        $('.side_pop').removeClass('active');
    })
    $(document).on('click', '.close_pop', function() {
        aside.classList.toggle("active");
    })

    document.body.addEventListener('keydown', function(e) {
        if (e.key == "Escape") {
            $('.side_pop').removeClass("active");
        }
    });

    $(document).on('click', '.pop_tab', function() {
        $('.pop_tab').removeClass('active');
        $(this).addClass('active');
    })

    $(document).on('click', '.pop_tab a', function(event) {
        $('.pop-pane').hide();
        let valee = $(this).attr('href');
        $(valee).show();
    })
    /* End Pop show & html bind part  */

    /* start save organization data */
    $(document).on('click', '#general_edit', function() {
        $('.saveAllDataButton').removeClass('hide1');
        $('#usphone_save').removeClass('hide1');
    })
    $(document).on('click', '#general_view', function() {
        $('.saveAllDataButton').addClass('hide1');
        $('#usphone_save').addClass('hide1');
    })

    $(document).on('click', '.saveAllDataButton', function(e) {
        $('.validate').removeClass('invalid');
        if (!validateForm()) return false;
        var formname = '';
        var organization_note = CKEDITOR.instances['organization_note'].getData();

        formname = $("#organization_general_form");
        var formData = new FormData($('#organization_general_form')[0]);
        formData.append("organization_note", organization_note);
        formData.append("submit", "name");
        formData.append("callType", "ajax");
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: formname.attr("action"),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response);
                $('.side_pop').removeClass("active");
            }
        });
    })

    $(document).on('click', '#address_save', function(e) {
        $('.street_validate').removeClass('invalid');
        if (!address_validateForm()) return false;
        var formname = '';
        formname = $("#organization_general_form");
        var formData = new FormData($('#organization_general_form')[0]);
        formData.append("submit", "address");
        formData.append("callType", "ajax");
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: formname.attr("action"),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response);
                $('.side_pop').removeClass("active");
            }
        });
    })

    $(document).on('click', '#inter_address_save', function(e) {

        $('.interaddressType').removeClass('invalid');
        if (!inter_address_validateForm()) return false;

        var formname = '';
        formname = $("#organization_general_form");
        var formData = new FormData($('#organization_general_form')[0]);
        formData.append("submit", "inter_address");
        formData.append("callType", "ajax");
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: formname.attr("action"),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response);
                $('.side_pop').removeClass("active");
            }
        });
    })

    $(document).on('click', '#usphone_save', function(e) {

        $('.phonevalidate').removeClass('invalid');
        if (!phone_validateForm()) return false;
        var formname = '';
        formname = $("#organization_general_form");
        var formData = new FormData($('#organization_general_form')[0]);
        formData.append("submit", "USPhone");
        formData.append("callType", "ajax");
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: formname.attr("action"),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response);
                $('.side_pop').removeClass("active");
            }
        });
    })


    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        y = document.getElementsByClassName("validate");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                var val_data = $(y[i]).attr('name');
                var per_data = $('#personal_info_country_birth :selected').val();
                var var_id = $(y[i]).attr('id');
                $('#' + var_id).focus();
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        return valid;
    }

    function address_validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        y = document.getElementsByClassName("street_validate");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                var val_data = $(y[i]).attr('name');
                var per_data = $('#personal_info_country_birth :selected').val();
                var var_id = $(y[i]).attr('id');
                $('#' + var_id).focus();
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        return valid; // return the valid status 
    }

    function inter_address_validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        y = document.getElementsByClassName("interaddressType");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                var val_data = $(y[i]).attr('name');
                var per_data = $('#personal_info_country_birth :selected').val();
                var var_id = $(y[i]).attr('id');
                $('#' + var_id).focus();
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        return valid; // return the valid status 
    }

    function phone_validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        y = document.getElementsByClassName("phonevalidate");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                var val_data = $(y[i]).attr('name');
                var per_data = $('#personal_info_country_birth :selected').val();
                var var_id = $(y[i]).attr('id');
                $('#' + var_id).focus();
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        return valid; // return the valid status 
    }


    /* end save organization data */


    /* start donation */
    $(document).on('click', '.update_donar_data', function() {
        var refcount = "<?= isset($ref_count) ? $ref_count : 0 ?>";
        refcount = parseInt(refcount) + 1;
        var amount = $('#modal_amount').val();
        var pay_type = $('#pay_type').val();
        // $("#PaymentType")
        $('#Amount' + refcount).val(amount);
        $('#pay_type' + refcount).val(pay_type);
        $("#donar_confirm_box").modal("hide");
    })

    $(document).on('keyup', '#audit_rate', function() {
        var tuition = $('#course_tuition').val();
        tuition = parseInt(tuition);
        var sch = $('#scholar_tuition').val()
        var credit = $(this).val();
        var current_pecentage = (credit * 100) / tuition;
        if (tuition < credit) {
            str = credit.slice(0, -1);
            $(this).val(str);
            alert("Credit Amount can not greater than Tuition Fees");
        } else {
            var current_scholor = (current_pecentage * sch) / 100;
            $('#scholar_adjustment').val(current_scholor);
        }
    })

    $(document).on('keyup', '#edit_audit_rate', function() {
        var tuition = $('#edit_course_tuition').val();
        tuition = parseInt(tuition);
        var sch = $('#edit_scholar_tuition').val()
        var credit = $(this).val();
        var current_pecentage = (credit * 100) / tuition;
        if (tuition < credit) {
            str = credit.slice(0, -1);
            $(this).val(str);
            alert("Credit Amount can not greater than Tuition Fees");
        } else {
            var current_scholor = (current_pecentage * sch) / 100;
            $('#edit_scholar_adjustment').val(current_scholor);
        }
    })

    $(document).on('change', '.payment_course', function() {
        var course_id = $(this).val();
        var student_id = "<?= service('uri')->getSegment(4) ?>";
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url('admin/Form/get_course_tuition_by_student_id'); ?>",
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                course_id: course_id,
                student_id: student_id
            },
            success: function(result) {
                $('#show_course_tuition').html("Course Tuition : " + result[0].total);
                $('#course_tuition').val(result[0].total);
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url('admin/Form/get_max_scholal'); ?>',
                    data: {
                        '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                        'course_id': course_id,
                        'student_id': student_id
                    },
                    dataType: "html",
                    success: function(data) {
                        $('#show_course_scholar').html("Assign Scholarship : " + data);
                        $('#scholar_tuition').val(data);
                    }
                })
            },
        });
    })

    $(document).on('change', '.edit_payment_course', function() {
        var course_id = $(this).val();
        var student_id = "<?= service('uri')->getSegment(4) ?>";
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url('admin/Form/get_course_tuition_by_student_id'); ?>",
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                course_id,
                student_id
            },
            success: function(result) {
                $('#edit_show_course_tuition').html("Course Tuition : " + result[0].total);
                $('#edit_course_tuition').val(result[0].total);
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url('admin/Form/get_max_scholal'); ?>',
                    data: {
                        '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                        'course_id': course_id,
                        'student_id': student_id
                    },
                    dataType: "html",
                    success: function(data) {
                        $('#edit_show_course_scholar').html("Assign Scholarship : " + data);
                        $('#edit_scholar_tuition').val(data);
                    }
                })
            },
        });
    })

    $(document).on('click', '.delete-donation', function() {
        var id = $(this).attr('rel_donation_id');
        var rel_id = $(this).attr('data-row');
        if (confirm('Are you sure, Want to Delet this record?')) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Form/delete_organization_donation'); ?>",
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    'id': id
                },
                success: function(result) {
                    if (result) {
                        $('#TextBoxDivDP' + rel_id).hide();
                        alert("Record Delete Successfully");
                        var str1 = window.location.href;
                        var n1 = str1.lastIndexOf('#');
                        if (n1 == -1) {
                            current_url = window.location.href + "#tab3";
                        } else {
                            current_url = window.location.href;
                        }
                        win = window.open('', '_self');
                        win.close();
                        window.open(current_url, "_blank");
                    } else {
                        alert("Something Wrong");
                    }
                },
            });
        }
    })

    $('#scholar_adjustment').on('keyup', function(e) {
        let tution = document.getElementById('scholar_adjustment');
        if (isNaN(tution.value)) {
            alert("Only numbers are allowed");
            tution.value = "";
        } else {
            let decimalTution = parseFloat(tution.value);
            if (countDecimals(decimalTution) > 2) {
                var truncated = Math.floor(decimalTution * 100) / 100; // = 5.46
                tution.value = truncated;
            }
        }
    });

    $('#audit_rate').on('keyup', function(e) {
        let tution = document.getElementById('audit_rate');
        if (isNaN(tution.value)) {
            alert("Only numbers are allowed");
            tution.value = "";
        } else {
            let decimalTution = parseFloat(tution.value);
            if (countDecimals(decimalTution) > 2) {
                var truncated = Math.floor(decimalTution * 100) / 100; // = 5.46
                tution.value = truncated;
            }
        }

    });

    function countDecimals(value) {
        if (Math.floor(value) === value) return 0;
        return value.toString().split(".")[1].length || 0;
    }

    $(document).on('change', '.PaymentType', function() {
        var data = $(this).val();
        var rel_id = $(this).attr('rel_id');
        $('.payment_course').val('');
        $('#audit_rate').val('');
        if (data == 'Student Credit') {
            $('#edit_button' + rel_id).show();
            $('#Campaign' + rel_id).val(22);
            $('#modal_rel_id').val(rel_id);
            $('#show_edit' + rel_id).show();
            $('#course_modal').modal('show');
        } else {
            $('#edit_button' + rel_id).hide();
            $('#show_edit' + rel_id).hide();
        }
    })

    $(document).on('change', '.paymentclass', function() {
        var class_id = $(this).val();
        var student_id = "<?= service('uri')->getSegment(4) ?>";
        if (class_id != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Form/get_user_Semester'); ?>",
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    'classname': class_id,
                    'student_id': student_id
                },
                success: function(result) {
                    $('.payment_semester').html(result);
                },
            });
        }
    })

    $(document).on("change", ".payment_semester", function() {
        var semester = $(this).val();
        var classname = $(".paymentclass :selected").val();
        var student_id = "<?= service('uri')->getSegment(4) ?>";
        if (semester != "" && classname != "") {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Form/getCourseBySemester_in_payment_donation'); ?>",
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    semester: semester,
                    classname: classname,
                    student_id: student_id,
                },
                success: function(result) {
                    $(".payment_course").html(result);
                },
            });
        } else {
            alert("Please Select Class");
        }
    });

    $(document).on('change', '.edit_paymentclass', function() {
        var class_id = $(this).val();
        var class_id = $(this).val();
        var student_id = "<?= service('uri')->getSegment(4) ?>";
        if (class_id != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Form/get_user_Semester'); ?>",
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    'classname': class_id,
                    'student_id': student_id
                },
                success: function(result) {
                    $('.edit_payment_semester').html(result);
                },
            });
        }
    })

    $(document).on('change', '.edit_payment_semester', function() {
        var semester = $(this).val();
        var classname = $('.edit_paymentclass :selected').val();
        var student_id = "<?= service('uri')->getSegment(4) ?>";
        if (semester != '' && classname != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Form/getCourseBySemester_in_payment_donation'); ?>",
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    'semester': semester,
                    'classname': classname,
                    'student_id': student_id
                },
                success: function(result) {
                    $('.edit_payment_course').html(result);
                },
            });
        } else {
            alert("Please Select Class");
        }
    });

    $(document).on('click', '.update_data1', function() {
        var rel_id = $('#edit_modal_rel_id').val();
        var course_id = $('.edit_payment_course').val();
        var credit = $('#edit_audit_rate').val();
        var student_id = "<?= service('uri')->getSegment(4) ?>";
        var credit_note = $('#edit_tuition_adjustment_note').val();
        var scholar_adjustment = $('#edit_scholar_adjustment').val();
        var total = 0;
        total = parseInt(credit);
        $('#Amount' + rel_id).val(total);
        var scholarship_adjustment_note = $('#edit_scholarship_adjustment_note').val();
        if (credit == '') {
            alert("Please Fill Credit Amount");
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url('admin/Form/get_max_scholal'); ?>',
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    'course_id': course_id,
                    'student_id': student_id
                },
                dataType: "html",
                success: function(data) {
                    if (parseFloat(data) < scholar_adjustment) {
                        alert("Scholarship is always greater than Scholar Ship adjustment,Scholarship Amount is :" + data);
                    } else {
                        $('#denotion_course' + rel_id).val(course_id);
                        $('#student_credit' + rel_id).val(credit);
                        $('#student_credit_note' + rel_id).val(credit_note);
                        $('#scholar_adjustment' + rel_id).val(scholar_adjustment);
                        $('#scholar_adjustment_note' + rel_id).val(scholarship_adjustment_note);
                        var row = rel_id;
                        var selector = '#TextBoxDivDP' + row;
                        var note_selector = '#TextBoxDivDPN' + row;
                        $(note_selector + ' span.show, ' + selector + ' span.show, ' + selector + ' a.edit-donation').removeClass('show').addClass('hide');
                        $(note_selector + ' textarea, ' + selector + ' input, ' + selector + ' select, ' + selector + ' a.save-donation, ' + selector + ' a.cancel-donation, ' + selector + ' a.delete-donation').removeClass('hide').addClass('show');
                        $("#edit_course_modal").modal('hide');
                    }
                }
            })
        }
    })

    $(document).on('click', '.update_data', function() {
        var rel_id = $('#modal_rel_id').val();
        var course_id = $('.payment_course').val();
        var credit = $('#audit_rate').val();
        var credit_note = $('#tuition_adjustment_note').val();
        var scholar_adjustment = $('#scholar_adjustment').val();
        var total = 0;
        total = parseInt(credit);
        $('#Amount' + rel_id).val(total);
        var scholarship_adjustment_note = $('#scholarship_adjustment_note').val();
        var student_id = "<?= service('uri')->getSegment(4) ?>";
        if (credit == '') {
            alert("Please Fill Credit Amount");
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url('admin/Form/get_max_scholal'); ?>',
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    'course_id': course_id,
                    'student_id': student_id
                },
                dataType: "html",
                success: function(data) {
                    if (parseFloat(data) < scholar_adjustment) {
                        alert("Scholarship is always greater than Scholar Ship adjustment,Scholarship Amount is :" + data)
                    } else {
                        $('#denotion_course' + rel_id).val(course_id);
                        $('#student_credit' + rel_id).val(credit);
                        $('#student_credit_note' + rel_id).val(credit_note);
                        $('#scholar_adjustment' + rel_id).val(scholar_adjustment);
                        $('#scholar_adjustment_note' + rel_id).val(scholarship_adjustment_note);
                        var content = "<i class='fa fa-pencil edit_course' id='edit_button" + rel_id + "' rel_id=" + rel_id + " rel_course=" + course_id + " rel_credit=" + credit + " style='cursor:pointer;'></i>";
                        $('#show_edit' + rel_id).html(content);
                        $("#course_modal").modal('hide');
                    }
                }
            })
        }
    })

    $(document).on('click', '.edit_course', function() {
        var rel_id = $(this).attr('rel_id');
        var student_id = "<?= service('uri')->getSegment(4) ?>";
        $('#edit_modal_rel_id').val(rel_id);
        var rel_course = $('#denotion_course' + rel_id).val();
        var credit = $('#student_credit' + rel_id).val();
        credit_note = $('#student_credit_note' + rel_id).val();
        scholor_adjustment = $('#scholar_adjustment' + rel_id).val();
        scholor_adjustment_note = $('#scholar_adjustment_note' + rel_id).val();
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Form/get_couse_detail'); ?>',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                'course_id': rel_course,
                'credit': credit,
                'student_id': student_id,
                'credit_note': credit_note,
                'scholor_adjustment': scholor_adjustment,
                'scholor_adjustment_note': scholor_adjustment_note
            },
            dataType: "html",
            success: function(data) {
                $('#edit_details').html(data);
                $('#edit_course_modal').modal('show');
            }
        })
    })

    $(document).on('change', '.date-checks', function() {
        var current = $(this).val();
        if (current != '') {
            $(this).closest('tr').find('.date-checks').not(this).attr('disabled', true);
        } else {
            $(this).closest('tr').find('.date-checks').attr('disabled', false);
        }
    });

    $(document).on('click', '.edit-donation', function() {
        var row = $(this).attr('data-row');
        var selector = '#TextBoxDivDP' + row;
        var note_selector = '#TextBoxDivDPN' + row;
        $(note_selector + ' td').removeClass('alterhide').addClass('altershow');
        $(note_selector + ' span.show, ' + selector + ' span.show, ' + selector + ' a.edit-donation').removeClass('show').addClass('hide');
        $(note_selector + ' textarea, ' + selector + ' input, ' + selector + ' select, ' + selector + ' a.save-donation, ' + selector + ' a.cancel-donation, ' + selector + ' a.delete-donation').removeClass('hide').addClass('show');
    });

    $(document).on('click', '.cancel-donation', function() {
        var row = $(this).attr('data-row');
        var selector = '#TextBoxDivDP' + row;
        var note_selector = '#TextBoxDivDPN' + row;
        $(note_selector + ' td').removeClass('altershow').addClass('alterhide');
        $(note_selector + ' textarea, ' + selector + ' input, ' + selector + ' select, ' + selector + ' a.save-donation, ' + selector + ' a.cancel-donation, ' + selector + ' a.delete-donation').removeClass('show').addClass('hide');
        $(note_selector + ' span.hide, ' + selector + ' span.hide, ' + selector + ' a.edit-donation').removeClass('hide').addClass('show');
    });

    function payments(id) {
        var paymenttype_list = JSON.parse('<?= $paymenttype_js ?>');
        var edit_user = '<?= session()->get('admin_fullname') ?>';
        var current_date = '<?= date('m/d/Y') ?>';
        var campaigns_list = JSON.parse('<?= $campaigns_js ?>');
        donor_rowid = $('#Donor_RowID' + id).val();
        donorid = $('#DonorID' + id).val();
        login_user = $('#login_user').val();
        added_date = $('#added_date' + id).val();
        received_date = $('#ReceivedDate' + id).val();
        payment_type = $('#PaymentType' + id).val();
        checknumber = $('#CheckNumber' + id).val();
        amountval = $('#Amount' + id).val();
        amountval_1 = $('#Amount' + id).val();
        amount = parseFloat(amountval).toFixed(2);
        amount1 = addCommas(amount);
        campaign = $('#Campaign' + id).val();
        campaign_text = $('#Campaign' + id + ' option:selected').text();

        let start_date = $('#start_date' + id).val();
        let end_date = $('#end_date' + id).val();
        let short_note = $('#short_note' + id).val();


        let GrantID = $('#GrantID' + id).val();
        isChecked = $('#SoftCredit' + id).is(":checked");;
        let SoftCredit = isChecked ? 'Yes' : 'No'

        var course_id = '';
        var credit = '';
        var credit_note = '';
        var scholor_adjustment = '';
        var scholor_adjustment_note = '';
        if (payment_type == 'Student Credit') {
            course_id = $('#denotion_course' + id).val();
            credit = $('#student_credit' + id).val();
            credit_note = $('#student_credit_note' + id).val();
            scholor_adjustment = $('#scholar_adjustment' + id).val();
            scholor_adjustment_note = $('#scholar_adjustment_note' + id).val();
            $('#edit_button' + id).show();
        } else {
            $('#edit_button' + id).hide();
        }
        donationNote = $('#DonationNote' + id).val();
        ReceiptDate = $('#ReceiptDae' + id).val();
        next_id = parseInt(id) + 1;
        paymenttype_html = '<select class="form-control PaymentType" rel_id="' + next_id + '" id="PaymentType' + next_id + '" name="PaymentType[' + next_id + ']"><option value="">Select payment type</option>';
        $.each(paymenttype_list, function(key, val) {
            paymenttype_html += '<option value="' + val.PayType + '">' + val.PayType + '</option>';
        });
        //region_html
        campaigns_html = '<select class="form-control" id="Campaign' + next_id + '" name="Campaign[' + next_id + ']"><option value="">Select</option>';
        $.each(campaigns_list, function(key, val) {
            campaigns_html += '<option value="' + val.CampaignID + '">' + val.CampaignName + '</option>';
        });

        var new_row = '<tr id="TextBoxDivDP' + next_id + '"><td rowspan="2" style="vertical-align: middle;">' + next_id + '</td><td><input type="hidden" id="count7" value="' + next_id + '"><input type="hidden" name="DonorID' + next_id + '" id="DonorID' + next_id + '" value="' + donorid + '"><input type="hidden" name="Donor_RowID[' + next_id + ']" id="Donor_RowID' + next_id + '" value=""><span class="hide"></span><input class="form-control datepickerbackward donation_date num" id="ReceivedDate' + next_id + '" name="ReceivedDate[' + next_id + ']" type="text" readonly></td><td><span class="hide"></span>' + paymenttype_html + '</select><p id="show_edit' + next_id + '"></p></td><td><span class="hide"></span><input class="form-control" id="CheckNumber' + next_id + '" name="CheckNumber[' + next_id + ']" type="text"></td><td><span class="hide calculator-section" ></span><input class="form-control decimal" id="Amount' + next_id + '" name="Amount[' + next_id + ']" type="text" onkeypress="return validateFloatKeyPress(this,event)"></td><td><span class="hide"></span>' + campaigns_html + '</td><td><span class="hide"></span><input class="form-control datepicker" id="start_date' + next_id + '" name="start_date[' + next_id + ']" type="text"></td><td><span class="hide"></span> <input class="form-control datepicker" id="end_date' + next_id + '" name="end_date[' + next_id + ']" type="text"></td><td><span class="hide"></span><input type="text" class="form-control" name="GrantID[' + next_id + ']" id="GrantID' + next_id + '" maxlength="20"></td><td><span class="hide"></span><input type="checkbox"  name="SoftCredit[' + next_id + ']" value="Yes" id="SoftCredit' + next_id + '"></td><td><span class="hide"></span><input class="form-control datepickerbackward donation_date num" id="ReceiptDae' + next_id + '" name="ReceiptDae[' + next_id + ']" type="text" readonly><td><span class="hide"></span><input type="text" class="form-control login_user" name="login_user[' + next_id + ']" id="login_user' + next_id + '" value="' + edit_user + '" readonly></td><td><span class="hide"></span><input type="text" class="form-control added_date" name="added_date[' + next_id + ']" id="added_date' + next_id + '" value="' + current_date + '" readonly></td><td rowspan="2"><a href="javascript:void(0)" id="add-donation' + next_id + '" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-donation"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span><strong>ADD</strong></span></a><a href="javascript:void(0)" id="save-donation' + next_id + '" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-donation hide pull-left save' + next_id + '" data-id="' + donorid + '" data-row="' + donorid + '"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span><strong>Save</strong></span></a>';
        new_row += '<span id="delete_button' + next_id + '"></span>';
        new_row += '<a href="javascript:void(0)"  id="cancel-donation' + next_id + '" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-donation hide pull-left"  data-row="' + next_id + '"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span><strong>Cancel</strong></span> </a><a href="javascript:void(0)" id="edit-donation' + next_id + '"class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-donation hide pull-left" data-id="' + next_id + '" data-row="' + next_id + '" style="text-align:center;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><span><strong>Edit</strong></span></a></td></tr><tr id="TextBoxDivDPN' + next_id + '"><td>Note</td><td colspan="2"><span class="hide"></span><textarea class="form-control" name="short_note[' + next_id + ']" id="short_note' + next_id + '"></textarea></td><td colspan="2"><strong>Donation Note :</strong><input type="hidden" name="course[' + next_id + ']" id="denotion_course' + next_id + '"><input type="hidden" name="student_credit[' + next_id + ']" id="student_credit' + next_id + '"><input type="hidden" name="student_credit_note[' + next_id + ']" id="student_credit_note' + next_id + '"><input type="hidden" name="scholar_adjustment[' + next_id + ']" id="scholar_adjustment' + next_id + '"><input type="hidden" name="scholar_adjustment_note[' + next_id + ']" id="scholar_adjustment_note' + next_id + '"></td><td colspan="8"><span class="hide" style="text-align:left;"></span><textarea name="DonationNote[' + next_id + ']" id="DonationNote' + next_id + '" class="form-control" style="align-content:left;"></textarea></td></tr>';

        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/Form/submitOrganizationPaymentDetails'); ?>',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                'donor_rowid': donor_rowid,
                'donorid': donorid,
                'received_date': received_date,
                'payment_type': payment_type,
                'checknumber': checknumber,
                'amount': amount,
                'campaign': campaign,
                'donationNote': donationNote,
                'ReceiptDate': ReceiptDate,
                'campaign_text': campaign_text,
                'course_id': course_id,
                'credit': credit,
                'credit_note': credit_note,
                'scholor_adjustment': scholor_adjustment,
                'scholor_adjustment_note': scholor_adjustment_note,
                'GrantID': GrantID,
                'SoftCredit': SoftCredit,
                'short_note': short_note,
                'start_date': start_date,
                'end_date': end_date
            },
            dataType: "html",
            success: function(data) {
                data = JSON.parse(data);
                alert(data.msg);
                if (data.msg != 'Record Already Exist or saved') {
                    var display_sec = '';
                    $('#ReceivedDate' + id).prev().html(received_date).addClass('show').removeClass('hide');
                    if (payment_type != 'Student Credit') {
                        display_sec = "style='display:none;'";
                    }
                    $('#PaymentType' + id).prev().html(payment_type).addClass('show').removeClass('hide');
                    $('#CheckNumber' + id).prev().html(checknumber).addClass('show').removeClass('hide');
                    $('#Amount' + id).prev().html(amount1).addClass('show').removeClass('hide');
                    $('#Campaign' + id).prev().html(campaign_text).addClass('show').removeClass('hide');

                    $('#start_date' + id).prev().html(start_date).addClass('show').removeClass('hide');
                    $('#end_date' + id).prev().html(end_date).addClass('show').removeClass('hide');
                    $('#short_note' + id).prev().html(short_note).addClass('show').removeClass('hide');

                    $('#GrantID' + id).prev().html(GrantID).addClass('show').removeClass('hide');
                    $('#SoftCredit' + id).prev().html(SoftCredit).addClass('show').removeClass('hide');

                    $('#DonationNote' + id).prev().html(donationNote).addClass('show').removeClass('hide');
                    $('#ReceiptDae' + id).prev().html(ReceiptDate).addClass('show').removeClass('hide');
                    $('#login_user' + id).prev().html(edit_user).addClass('show').removeClass('hide');
                    $('#added_date' + id).prev().html(current_date).addClass('show').removeClass('hide');
                    $('#ReceivedDate' + id).addClass('hide').removeClass('show');
                    $('#PaymentType' + id).addClass('hide').removeClass('show');
                    $('#CheckNumber' + id).addClass('hide').removeClass('show');
                    $('#Amount' + id).addClass('hide').removeClass('show');
                    $('#Campaign' + id).addClass('hide').removeClass('show');

                    $('#short_note' + id).addClass('hide').removeClass('show');
                    $('#start_date' + id).addClass('hide').removeClass('show');
                    $('#end_date' + id).addClass('hide').removeClass('show');

                    $('#DonationNote' + id).addClass('hide').removeClass('show');
                    $('#GrantID' + id).addClass('hide').removeClass('show');
                    $('#SoftCredit' + id).addClass('hide').removeClass('show');
                    $('#ReceiptDae' + id).addClass('hide').removeClass('show');
                    $('#login_user' + id).addClass('hide').removeClass('show');
                    $('#added_date' + id).addClass('hide').removeClass('show');
                    $('#save-donation' + id).addClass('hide').removeClass('show');
                    $('#add-donation' + id).addClass('hide').removeClass('show');
                    $('#edit-donation' + id).addClass('show').removeClass('hide');
                    $('#cancel-donation' + id).addClass('hide').removeClass('show');
                    if (data.last_id != '') {
                        $('#Donor_RowID' + id).val(data.last_id);
                        $('#delete_button' + id).html('<a href="javascript:void(0)" rel_donation_id="' + data.last_id + '" id="delete-donation' + id + '" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 delete-donation pull-left delete' + id + ' hide" data-id="<?= service('uri')->getSegment(4) ?>" data-row="' + id + '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span><span><strong>Delete</strong></span></a>');
                        $('.tbl-body-donation').prepend(new_row);
                        amount_sum();
                    }




                }
            },
        });
    }


    function validateFloatKeyPress(el, evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        var number = el.value.split('.');
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        //just one dot
        if (number.length > 1 && charCode == 46) {
            return false;
        }
        //get the carat position
        var caratPos = getSelectionStart(el);
        var dotPos = el.value.indexOf(".");
        if (caratPos > dotPos && dotPos > -1 && (number[1].length > 1)) {
            return false;
        }
        return true;
    }

    function getSelectionStart(o) {
        if (o.createTextRange) {
            var r = document.selection.createRange().duplicate()
            r.moveEnd('character', o.value.length)
            if (r.text == '') return o.value.length
            return o.value.lastIndexOf(r.text)
        } else return o.selectionStart
    }

    $(document).on("change", ".donation_dates", function() {
        var current_record_date = $(this).val();
        if (current_record_date != "") {
            var final_date = current_record_date.split('/')[2];
            var year_count_digit = final_date.length;
            if (year_count_digit != 4) {
                alert('Year should be 4 digit');
                $(this).val('');
            }
        }
    });


    //function validatePaymentForm(id){
    $(document).on('click', '.add-donation,.save-donation', function() {
        var id = this.id.replace(/^\D+/g, '');
        received_date = $('#ReceivedDate' + id).val();
        if (received_date == "") {
            alert("Enter Received Date");
            return false;
        }
        payment_type = $('#PaymentType' + id).val();
        if (payment_type == "") {
            alert("Payment Type Not Empty");
            return false;
        }
        amount = $('#Amount' + id).val();
        if (amount == "") {
            alert('Enter Amount');
            return false;
        }
        campaign = $('#Campaign' + id).val();
        if (campaign == "") {
            alert("Campaign Not Empty");
            return false;
        } else {
            $('#add-donation' + id).hide();
            payments(id);
        }
    });

    function addCommas(num) {
        var str = num.toString().split('.');
        if (str[0].length >= 4) {
            //add comma every 3 digits befor decimal
            str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
        }
        return str.join('.');
    }



    /* end donation */
</script>

<!-- start Pop javascript-->
<script>
    $(document).on('click', '.help', function() {
        $('.pop').toggleClass('popOut');
        if ($('.pop').hasClass('popOut')) {
            $('.remove_button').show();
        } else {
            $('.remove_button').hide();
            const role_val = [];
            var org_id = $('#select_organization_id').val()
            var submit = 'submit';
            $('.themeBtn').each(function() {
                role_val.push($(this).attr('data-name'));
            });

            $.ajax({
                type: "POST",
                url: '<?= base_url() ?>admin/Form/submitOrganizationLabelRole',
                data: {
                    role_val: role_val,
                    org_id: org_id,
                    submit: submit
                },
                dataType: "html",
                success: function(data) {

                },
            });

        }
    })

    $(document).on('click', '.checkbox', function() {
        $('.pop').toggleClass('popOut');
    })


    $(document).on('click', '.themeBtn_new', function() {
        var data = $(this).attr('rel_id');
        var class_name = $(this).attr('rel_class_name');
        var tag_name = $(this).attr('rel_name');
        var content = '';
        content += '<button class="themeBtn ' + class_name + '_button" data-name="' + data + '">' + tag_name + ' <i class="fa fa-times remove_button" rel_id="' + data + '" rel_name="' + tag_name + '" data-class-name=' + class_name + '></i></button>';
        $("." + class_name + '_div').hide();
        $('.header_button').append(content);
    })


    $(document).on('click', '.remove_button', function() {
        var data = $(this).attr('rel_name');
        var class_name = $(this).attr('data-class-name');
        $('.' + class_name + '_button').remove();
        $('.' + class_name + '_div').show();
    })


    $(document).on('click', '.close_pop_out', function() {
        $('.remove_button').hide();
    })
</script>
<!-- end Pop javascript-->

<script>
    ! function($) {
        "use strict"; // jshint ;_;
        if (typeof ko != 'undefined' && ko.bindingHandlers && !ko.bindingHandlers.multiselect) {
            ko.bindingHandlers.multiselect = {
                init: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {},
                update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
                    var ms = $(element).data('multiselect');
                    if (!ms) {
                        $(element).multiselect(ko.utils.unwrapObservable(valueAccessor()));
                    } else if (allBindingsAccessor().options && allBindingsAccessor().options().length !== ms.originalOptions.length) {
                        ms.updateOriginalOptions();
                        $(element).multiselect('rebuild');
                    }
                }
            };
        }

        function Multiselect(select, options) {

            this.options = this.mergeOptions(options);
            this.$select = $(select);

            // Initialization.
            // We have to clone to create a new reference.
            this.originalOptions = this.$select.clone()[0].options;
            this.query = '';
            this.searchTimeout = null;

            this.options.multiple = this.$select.attr('multiple') == "multiple";
            this.options.onChange = $.proxy(this.options.onChange, this);

            // Build select all if enabled.
            this.buildContainer();
            this.buildButton();
            this.buildSelectAll();
            this.buildDropdown();
            this.buildDropdownOptions();
            this.buildFilter();
            this.updateButtonText();

            this.$select.hide().after(this.$container);
        };

        Multiselect.prototype = {
            // Default options.
            defaults: {
                // Default text function will either print 'None selected' in case no
                // option is selected, or a list of the selected options up to a length of 3 selected options.
                // If more than 3 options are selected, the number of selected options is printed.
                buttonText: function(options, select) {
                    if (options.length == 0) {
                        return this.nonSelectedText + ' <b class="caret"></b>';
                    } else {

                        if (options.length > 3) {
                            return options.length + ' ' + this.nSelectedText + ' <b class="caret"></b>';
                        } else {
                            var selected = '';
                            options.each(function() {
                                var label = ($(this).attr('label') !== undefined) ? $(this).attr('label') : $(this).html();

                                //Hack by Victor Valencia R.
                                if ($(select).hasClass('multiselect-icon')) {
                                    var icon = $(this).data('icon');
                                    label = '<span class="glyphicon ' + icon + '"></span> ' + label;
                                }

                                selected += label + ', ';
                            });
                            return selected.substr(0, selected.length - 2) + ' <b class="caret"></b>';
                        }
                    }
                },
                // Like the buttonText option to update the title of the button.
                buttonTitle: function(options, select) {

                    if (options.length == 0) {
                        return this.nonSelectedText;
                    } else {
                        var selected = '';
                        options.each(function() {
                            //selected += $(this).text() + ', ';
                            selected += $(this).val() + ', ';
                        });

                        var field_text = selected.split(",");

                        //ajax code
                        return selected.substr(0, selected.length - 2);
                    }
                },
                // Is triggered on change of the selected options.
                onChange: function(option, checked) {

                },
                buttonClass: 'btn',
                dropRight: false,
                selectedClass: 'active',
                buttonWidth: '100%',
                buttonContainer: '<div class="btn-group custom-btn" />',
                // Maximum height of the dropdown menu.
                // If maximum height is exceeded a scrollbar will be displayed.
                maxHeight: false,
                includeSelectAllOption: false,
                selectAllText: ' Select all',
                selectAllValue: 'multiselect-all',
                enableFiltering: false,
                enableCaseInsensitiveFiltering: false,
                filterPlaceholder: 'Search',
                // possible options: 'text', 'value', 'both'
                filterBehavior: 'text',
                preventInputChangeEvent: false,
                nonSelectedText: 'None selected',
                nSelectedText: 'selected'
            },

            // Templates.
            templates: {
                button: '<button type="button" class="multiselect dropdown-toggle form-control" data-toggle="dropdown"></button>',
                ul: '<ul class="multiselect-container dropdown-menu custom-multi"></ul>',
                filter: '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text"></div>',
                li: '<li><a href="javascript:void(0);"><label></label></a></li>',
                liGroup: '<li><label class="multiselect-group"></label></li>'
            },

            constructor: Multiselect,

            buildContainer: function() {
                this.$container = $(this.options.buttonContainer);
            },

            buildButton: function() {
                // Build button.
                this.$button = $(this.templates.button).addClass(this.options.buttonClass);

                // Adopt active state.
                if (this.$select.prop('disabled')) {
                    this.disable();
                } else {
                    this.enable();
                }

                // Manually add button width if set.
                if (this.options.buttonWidth) {
                    this.$button.css({
                        'width': this.options.buttonWidth
                    });
                }

                // Keep the tab index from the select.
                var tabindex = this.$select.attr('tabindex');
                if (tabindex) {
                    this.$button.attr('tabindex', tabindex);
                }

                this.$container.prepend(this.$button)
            },

            // Build dropdown container ul.
            buildDropdown: function() {

                // Build ul.
                this.$ul = $(this.templates.ul);

                if (this.options.dropRight) {
                    this.$ul.addClass('pull-right');
                }

                // Set max height of dropdown menu to activate auto scrollbar.
                if (this.options.maxHeight) {
                    // TODO: Add a class for this option to move the css declarations.
                    this.$ul.css({
                        'max-height': this.options.maxHeight + 'px',
                        'overflow-y': 'auto',
                        'overflow-x': 'hidden'
                    });
                }

                this.$container.append(this.$ul)
            },

            // Build the dropdown and bind event handling.
            buildDropdownOptions: function() {

                this.$select.children().each($.proxy(function(index, element) {
                    // Support optgroups and options without a group simultaneously.
                    var tag = $(element).prop('tagName').toLowerCase();
                    if (tag == 'optgroup') {
                        this.createOptgroup(element);
                    } else if (tag == 'option') {
                        this.createOptionValue(element);
                    }
                    // Other illegal tags will be ignored.
                }, this));

                // Bind the change event on the dropdown elements.
                $('li input', this.$ul).on('change', $.proxy(function(event) {
                    var checked = $(event.target).prop('checked') || false;
                    var isSelectAllOption = $(event.target).val() == this.options.selectAllValue;

                    // Apply or unapply the configured selected class.
                    if (this.options.selectedClass) {
                        if (checked) {
                            $(event.target).parents('li').addClass(this.options.selectedClass);
                        } else {
                            $(event.target).parents('li').removeClass(this.options.selectedClass);
                        }
                    }

                    // Get the corresponding option.
                    var value = $(event.target).val();
                    var $option = this.getOptionByValue(value);

                    var $optionsNotThis = $('option', this.$select).not($option);
                    var $checkboxesNotThis = $('input', this.$container).not($(event.target));

                    // Toggle all options if the select all option was changed.
                    if (isSelectAllOption) {
                        $checkboxesNotThis.filter(function() {
                            return $(this).is(':checked') != checked;
                        }).trigger('click');
                    }

                    if (checked) {
                        $option.prop('selected', true);

                        if (this.options.multiple) {
                            // Simply select additional option.
                            $option.prop('selected', true);
                        } else {
                            // Unselect all other options and corresponding checkboxes.
                            if (this.options.selectedClass) {
                                $($checkboxesNotThis).parents('li').removeClass(this.options.selectedClass);
                            }

                            $($checkboxesNotThis).prop('checked', false);
                            $optionsNotThis.prop('selected', false);

                            // It's a single selection, so close.
                            this.$button.click();
                        }

                        if (this.options.selectedClass == "active") {
                            $optionsNotThis.parents("a").css("outline", "");
                        }
                    } else {
                        // Unselect option.
                        $option.prop('selected', false);
                    }

                    this.updateButtonText();
                    this.$select.change();
                    this.options.onChange($option, checked);

                    if (this.options.preventInputChangeEvent) {
                        return false;
                    }
                }, this));

                $('li a', this.$ul).on('touchstart click', function(event) {
                    event.stopPropagation();
                    $(event.target).blur();
                });

                // Keyboard support.
                this.$container.on('keydown', $.proxy(function(event) {
                    if ($('input[type="text"]', this.$container).is(':focus')) {
                        return;
                    }
                    if ((event.keyCode == 9 || event.keyCode == 27) && this.$container.hasClass('open')) {
                        // Close on tab or escape.
                        this.$button.click();
                    } else {
                        var $items = $(this.$container).find("li:not(.divider):visible a");

                        if (!$items.length) {
                            return;
                        }

                        var index = $items.index($items.filter(':focus'));

                        // Navigation up.
                        if (event.keyCode == 38 && index > 0) {
                            index--;
                        }
                        // Navigate down.
                        else if (event.keyCode == 40 && index < $items.length - 1) {
                            index++;
                        } else if (!~index) {
                            index = 0;
                        }

                        var $current = $items.eq(index);
                        $current.focus();

                        if (event.keyCode == 32 || event.keyCode == 13) {
                            var $checkbox = $current.find('input');

                            $checkbox.prop("checked", !$checkbox.prop("checked"));
                            $checkbox.change();
                        }

                        event.stopPropagation();
                        event.preventDefault();
                    }
                }, this));
            },

            // Will build an dropdown element for the given option.
            createOptionValue: function(element) {
                if ($(element).is(':selected')) {
                    $(element).prop('selected', true);
                }

                // Support the label attribute on options.
                var label = $(element).attr('label') || $(element).html();
                var value = $(element).val();

                //Hack by Victor Valencia R.            
                if ($(element).parent().hasClass('multiselect-icon') || $(element).parent().parent().hasClass('multiselect-icon')) {
                    var icon = $(element).data('icon');
                    label = '<span class="glyphicon ' + icon + '"></span> ' + label;
                }

                var inputType = this.options.multiple ? "checkbox" : "radio";

                var $li = $(this.templates.li);
                $('label', $li).addClass(inputType);
                $('label', $li).append('<input type="' + inputType + '" />');

                //Hack by Victor Valencia R.
                if (($(element).parent().hasClass('multiselect-icon') || $(element).parent().parent().hasClass('multiselect-icon')) && inputType == 'radio') {
                    $('label', $li).css('padding-left', '0px');
                    $('label', $li).find('input').css('display', 'none');
                }

                var selected = $(element).prop('selected') || false;
                var $checkbox = $('input', $li);
                $checkbox.val(value);

                if (value == this.options.selectAllValue) {
                    $checkbox.parent().parent().addClass('multiselect-all');
                }

                $('label', $li).append(" " + label);

                this.$ul.append($li);

                if ($(element).is(':disabled')) {
                    $checkbox.attr('disabled', 'disabled').prop('disabled', true).parents('li').addClass('disabled');
                }

                $checkbox.prop('checked', selected);

                if (selected && this.options.selectedClass) {
                    $checkbox.parents('li').addClass(this.options.selectedClass);
                }
            },

            // Create optgroup.
            createOptgroup: function(group) {
                var groupName = $(group).prop('label');

                // Add a header for the group.
                var $li = $(this.templates.liGroup);
                $('label', $li).text(groupName);

                //Hack by Victor Valencia R.
                $li.addClass('text-primary');

                this.$ul.append($li);

                // Add the options of the group.
                $('option', group).each($.proxy(function(index, element) {
                    this.createOptionValue(element);
                }, this));
            },

            // Add the select all option to the select.
            buildSelectAll: function() {
                var alreadyHasSelectAll = this.$select[0][0] ? this.$select[0][0].value == this.options.selectAllValue : false;
                // If options.includeSelectAllOption === true, add the include all checkbox.
                if (this.options.includeSelectAllOption && this.options.multiple && !alreadyHasSelectAll) {
                    this.$select.prepend('<option value="' + this.options.selectAllValue + '">' + this.options.selectAllText + '</option>');
                }
            },

            // Build and bind filter.
            buildFilter: function() {

                // Build filter if filtering OR case insensitive filtering is enabled and the number of options exceeds (or equals) enableFilterLength.
                if (this.options.enableFiltering || this.options.enableCaseInsensitiveFiltering) {
                    var enableFilterLength = Math.max(this.options.enableFiltering, this.options.enableCaseInsensitiveFiltering);
                    if (this.$select.find('option').length >= enableFilterLength) {

                        this.$filter = $(this.templates.filter);
                        $('input', this.$filter).attr('placeholder', this.options.filterPlaceholder);
                        this.$ul.prepend(this.$filter);

                        this.$filter.val(this.query).on('click', function(event) {
                            event.stopPropagation();
                        }).on('keydown', $.proxy(function(event) {
                            // This is useful to catch "keydown" events after the browser has updated the control.
                            clearTimeout(this.searchTimeout);

                            this.searchTimeout = this.asyncFunction($.proxy(function() {

                                if (this.query != event.target.value) {
                                    this.query = event.target.value;

                                    $.each($('li', this.$ul), $.proxy(function(index, element) {
                                        var value = $('input', element).val();
                                        if (value != this.options.selectAllValue) {
                                            var text = $('label', element).text();
                                            var value = $('input', element).val();
                                            if (value && text && value != this.options.selectAllValue) {
                                                // by default lets assume that element is not
                                                // interesting for this search
                                                var showElement = false;

                                                var filterCandidate = '';
                                                if ((this.options.filterBehavior == 'text' || this.options.filterBehavior == 'both')) {
                                                    filterCandidate = text;
                                                }
                                                if ((this.options.filterBehavior == 'value' || this.options.filterBehavior == 'both')) {
                                                    filterCandidate = value;
                                                }

                                                if (this.options.enableCaseInsensitiveFiltering && filterCandidate.toLowerCase().indexOf(this.query.toLowerCase()) > -1) {
                                                    showElement = true;
                                                } else if (filterCandidate.indexOf(this.query) > -1) {
                                                    showElement = true;
                                                }

                                                if (showElement) {
                                                    $(element).show();
                                                } else {
                                                    $(element).hide();
                                                }
                                            }
                                        }
                                    }, this));
                                }
                            }, this), 300, this);
                        }, this));
                    }
                }
            },

            // Destroy - unbind - the plugin.
            destroy: function() {
                this.$container.remove();
                this.$select.show();
            },

            // Refreshs the checked options based on the current state of the select.
            refresh: function() {
                $('option', this.$select).each($.proxy(function(index, element) {
                    var $input = $('li input', this.$ul).filter(function() {
                        return $(this).val() == $(element).val();
                    });

                    if ($(element).is(':selected')) {
                        $input.prop('checked', true);

                        if (this.options.selectedClass) {
                            $input.parents('li').addClass(this.options.selectedClass);
                        }
                    } else {
                        $input.prop('checked', false);

                        if (this.options.selectedClass) {
                            $input.parents('li').removeClass(this.options.selectedClass);
                        }
                    }

                    if ($(element).is(":disabled")) {
                        $input.attr('disabled', 'disabled').prop('disabled', true).parents('li').addClass('disabled');
                    } else {
                        $input.prop('disabled', false).parents('li').removeClass('disabled');
                    }
                }, this));

                this.updateButtonText();
            },

            // Select an option by its value or multiple options using an array of values.
            select: function(selectValues) {
                if (selectValues && !$.isArray(selectValues)) {
                    selectValues = [selectValues];
                }

                for (var i = 0; i < selectValues.length; i++) {

                    var value = selectValues[i];

                    var $option = this.getOptionByValue(value);
                    var $checkbox = this.getInputByValue(value);

                    if (this.options.selectedClass) {
                        $checkbox.parents('li').addClass(this.options.selectedClass);
                    }

                    $checkbox.prop('checked', true);
                    $option.prop('selected', true);
                    this.options.onChange($option, true);
                }

                this.updateButtonText();
            },

            // Deselect an option by its value or using an array of values.
            deselect: function(deselectValues) {
                if (deselectValues && !$.isArray(deselectValues)) {
                    deselectValues = [deselectValues];
                }

                for (var i = 0; i < deselectValues.length; i++) {

                    var value = deselectValues[i];

                    var $option = this.getOptionByValue(value);
                    var $checkbox = this.getInputByValue(value);

                    if (this.options.selectedClass) {
                        $checkbox.parents('li').removeClass(this.options.selectedClass);
                    }

                    $checkbox.prop('checked', false);
                    $option.prop('selected', false);
                    this.options.onChange($option, false);
                }

                this.updateButtonText();
            },

            // Rebuild the whole dropdown menu.
            rebuild: function() {
                this.$ul.html('');

                // Remove select all option in select.
                $('option[value="' + this.options.selectAllValue + '"]', this.$select).remove();

                // Important to distinguish between radios and checkboxes.
                this.options.multiple = this.$select.attr('multiple') == "multiple";

                this.buildSelectAll();
                this.buildDropdownOptions();
                this.updateButtonText();
                this.buildFilter();
            },

            // Build select using the given data as options.
            dataprovider: function(dataprovider) {
                var optionDOM = "";
                dataprovider.forEach(function(option) {
                    optionDOM += '<option value="' + option.value + '">' + option.label + '</option>';
                });

                this.$select.html(optionDOM);
                this.rebuild();
            },

            // Enable button.
            enable: function() {
                this.$select.prop('disabled', false);
                this.$button.prop('disabled', false)
                    .removeClass('disabled');
            },

            // Disable button.
            disable: function() {
                this.$select.prop('disabled', true);
                this.$button.prop('disabled', true)
                    .addClass('disabled');
            },

            // Set options.
            setOptions: function(options) {
                this.options = this.mergeOptions(options);
            },

            // Get options by merging defaults and given options.
            mergeOptions: function(options) {
                return $.extend({}, this.defaults, options);
            },

            // Update button text and button title.
            updateButtonText: function() {
                var options = this.getSelected();

                // First update the displayed button text.
                $('button', this.$container).html(this.options.buttonText(options, this.$select));

                // Now update the title attribute of the button.
                $('button', this.$container).attr('title', this.options.buttonTitle(options, this.$select));

            },

            // Get all selected options.
            getSelected: function() {

                return $('option[value!="' + this.options.selectAllValue + '"]:selected', this.$select).filter(function() {
                    return $(this).prop('selected');
                });
            },

            // Get the corresponding option by ts value.
            getOptionByValue: function(value) {
                return $('option', this.$select).filter(function() {
                    return $(this).val() == value;
                });
            },

            // Get an input in the dropdown by its value.
            getInputByValue: function(value) {
                return $('li input', this.$ul).filter(function() {
                    return $(this).val() == value;
                });
            },

            updateOriginalOptions: function() {
                this.originalOptions = this.$select.clone()[0].options;
            },

            asyncFunction: function(callback, timeout, self) {
                var args = Array.prototype.slice.call(arguments, 3);
                return setTimeout(function() {
                    callback.apply(self || window, args);
                }, timeout);
            }
        };

        $.fn.multiselect = function(option, parameter) {
            return this.each(function() {
                var data = $(this).data('multiselect'),
                    options = typeof option == 'object' && option;

                // Initialize the multiselect.
                if (!data) {
                    $(this).data('multiselect', (data = new Multiselect(this, options)));
                }

                // Call multiselect method.
                if (typeof option == 'string') {
                    data[option](parameter);
                }
            });
        };

        $.fn.multiselect.Constructor = Multiselect;

        // Automatically init selects by their data-role.
        $(function() {
            $("select[role='multiselect']").multiselect();
        });

    }(window.jQuery);

    $(document).on('focus', '.datepicker', function(event) {
        event.preventDefault();
        $(this).datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true,

        });
    })
</script>