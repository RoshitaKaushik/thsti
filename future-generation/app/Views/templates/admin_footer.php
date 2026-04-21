<footer class="footer text-right" style="display:none;">
    2022 Â© All right reserved. confidential information subject to USA law

    <?php
    //if(@$_SESSION['admin_last_login']!=NULL){
    ?>
    <!--
    <div>
            <strong>Last Login:</strong>
    <?php echo date("F j, Y, g:i:s a", strtotime(@$_SESSION['admin_last_login'][0]['LOGIN_DATE_TIME'])); ?><br>
                    <strong>User IP:</strong>
    <?php echo @$_SESSION['admin_last_login'][0]['USER_IP']; ?>
    </div>
    <?php // }else if(@$_SESSION['last_login']!=NULL){ 
    ?>
    <div>
            <strong>Last Login:</strong>
    <?php echo date("F j, Y, g:i:s a", strtotime(@$_SESSION['last_login'][0]['LOGIN_DATE_TIME'])); ?><br>
            <strong>User IP:</strong>
    <?php echo @$_SESSION['last_login'][0]['USER_IP']; ?>
    </div>
    -->
    <?php //} 
    ?>
</footer>
</div>

</div>
<!-- END wrapper -->
<div id="download-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content p-0 b-0">
            <div class="row">
                <!-- Basic example -->
                <div class="col-md-12">
                    <h2>Report is downloaded<h2>
                </div>
            </div><!-- row-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>
    // By Prabhat 17-11-2020
    $(document).ready(function() {
        var str = window.location.href;
        var n = str.lastIndexOf('#');
        var result = str.substring(n + 1);
        if (result == 'tab15' || result == 'tab3') {
            $('#' + result).show();
        }
    })

    $("document").ready(function() {
        $('.filter_category').on('click', function(e) {
            e.stopPropagation();
        });
    });

    var resizefunc = [];
    $('.name_validation').bind('keyup blur', function() {
        $(this).val($(this).val().replace(/[^a-zA-Z-'._ ]/g, ''));
        //$(this).val( $(this).val().replace(/[^0-9()+-Xx ]/g,'') );  
        //$(this).val( $(this).val().replace(/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]/g,'') );
    });
</script>

<style type="text/css">
    #user_name,
    #mother_name,
    #father_name,
    #pan,
    #account_holder_name,
    #ifsc {
        text-transform: uppercase;
    }

    input[name="address1"],
    input[name="address2"],
    input[name="branch_name"] {
        text-transform: capitalize;
    }
</style>

<!-- jQuery  -->

<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/waves.js') ?>"></script>
<script src="<?= base_url('assets/js/wow.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.nicescroll.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/jquery.scrollTo.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery-detectmobile/detect.js') ?>"></script>
<script src="<?= base_url('assets/js/fastclick/fastclick.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery-slimscroll/jquery.slimscroll.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery-blockui/jquery.blockUI.js') ?>"></script>


<!--Form Validation-->
<script src="<?= base_url('assets/js/bootstrap-validator.min.js') ?>"></script>

<!-- CUSTOM JS -->
<script src="<?= base_url('assets/js/jquery.app.js') ?>"></script>

<!-- DATE PICKER -->
<script src="<?= base_url('assets/timepicker/bootstrap-timepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/timepicker/bootstrap-datepicker.js') ?>"></script>

<!-- DATA TABLES JS -->
<!--<script src="<?= base_url('assets/datatables/jquery.dataTables.min.js') ?>"></script> -->

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>


<!-- Modal-Effect -->
<script src="<?= base_url('assets/modal-effect/js/classie.js') ?>"></script>
<script src="<?= base_url('assets/modal-effect/js/modalEffects.js') ?>"></script>

<!--bootstrap-wysihtml5-->
<script type="text/javascript" src="<?= base_url('assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js') ?>"></script>

<!--form validation init-->
<script src="<?= base_url('assets/summernote/summernote.min.js') ?>"></script>

<!-- wizard  -->

<script src="<?= base_url('assets/js/jquery.steps.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/js/wizard-init.js') ?>"></script>

<!--script for nestable tab only-->
<script src="<?= base_url('assets/js/jquery.nestable.js') ?>"></script>
<script src="<?= base_url('assets/js/nestable.js') ?>"></script>


<script src="<?= base_url('assets/js/bootstrap-filestyle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.mask.min.js') ?>"></script>



<script type="text/javascript">
    $(window).load(function() {
        // PAGE IS FULLY LOADED  
        // FADE OUT YOUR OVERLAYING DIV
        $('#loader-block').fadeOut();
    });
    // nultiple initialize
    $('.uploadfiles').filestyle({
        buttonName: 'btn-primary'
    });
</script>
<script>
    $('#country-list').DataTable({


        "lengthMenu": [
            [10, 25, 100, 600, -1],
            [10, 25, 100, 600, "All"]
        ],

        "pageLength": 100,


    });

    /*$('#alldataTable').DataTable( {
        "lengthMenu": [[ -1], ["All"]]
    } );
	*/
</script>
<script type="text/javascript">
    $(document).ready(function() {
       
        let viewAppListDataTable = $('#viewAppListDataTable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'searching': false,
            "pageLength": 50,
            "dom": '<"top"lBfrtip<"clear">>rt<"bottom"ip<"clear">>',
            'ajax': {
                'url': '<?= base_url() ?>admin/Form/getNameList',
                'data': function(data) {
                    // send the custom fields to the backend. like firstname lastname etc.
                    let role_val = [];

                    $('.filter_themeBtn').each(function() {
                        role_val.push($(this).attr('data-name'));
                    });

                    var csrfName = '<?= csrf_token() ?>';
                    var csrfHash = '<?= csrf_hash() ?>';

                    data['<?= csrf_token() ?>'] = '<?= csrf_hash() ?>';
                    data.searchFirstName = $('#searchFirstName').val();
                    data.searchLastName = $('#searchLastName').val();
                    data.searchSpouse = $('#searchSpouse').val();
                    data.searchCompany = $('#searchCompany').val();
                    data.searchContactId = $('#contactId').val();
                    data.firstNameFocus = $('#searchFirstName').is(':focus');
                    data.lastNameFocus = $('#searchLastName').is(':focus');
                    data.spouseFocus = $('#searchSpouse').is(':focus');
                    data.companyFocus = $('#searchCompany').is(':focus');
                    data.ContactIdFocus = $('#contactId').is(':focus');
                    data.role_val = role_val;
                }
            },
            'order': [],
            'columns': [{
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'ContactId',
                    name: 'ContactId',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'FirstName',
                    name: 'FirstName',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'LastName',
                    name: 'LastName',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'Spouse',
                    name: 'Spouse',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'Company',
                    name: 'Company',
                    orderable: false,
                    searchable: true
                }
            ],

            "drawCallback": function(data) {
                console.log("drawcall",data);
                /*$('#viewAppListDataTable_length').html(function(_, text) {
              return text.replace('entries', '');
            });*/

                /*$('#viewAppListDataTable').DataTable({
                   "lengthMenu": [10, 25, 50, 100], // Customize the page length options
                   "pageLength": 50, // Set the initial page length
                 });*/


                // render data  and set the corrcet focus and value for the field after table is drwn.
                let searchFirstName = data.json.searchFirstName;
                let searchLastName = data.json.searchLastName;
                let searchSpouse = data.json.searchSpouse;
                let searchCompany = data.json.searchCompany;
                let searchContact = data.json.SearchContactId;
                let firstNameFocus = data.json.firstNameFocus;
                let lastNameFocus = data.json.lastNameFocus;
                let spouseFocus = data.json.spouseFocus;
                let companyFocus = data.json.companyFocus;
                let contactFocus = data.json.ContactIdFocus;
                let table = document.querySelector('#viewAppListDataTable');
                let row = table.insertRow(1);
                let cell0 = row.insertCell(0);
                let cell1 = row.insertCell(1);
                let cell2 = row.insertCell(2);
                let cell3 = row.insertCell(3);
                let cell4 = row.insertCell(4);
                let cell5 = row.insertCell(5);
                cell0.innerHTML = `Filter`;
                cell1.innerHTML = `<input style="width: 100%;" type="text" autocomplete="off" id="contactId" placeholder="Contact ID" class="form-control num" autocomplete="off">`;
                cell2.innerHTML = `<input style="width: 100%;" type="text" id="searchFirstName" placeholder="First Name"  class="form-control" autocomplete="off">`;
                cell3.innerHTML = ` <input style="width: 100%;" type="text" id="searchLastName" placeholder="Last Name" class="form-control" autocomplete="off">`;
                cell4.innerHTML = `<input style="width: 100%;" type="text" id="searchSpouse" placeholder="Spouse" class="form-control" autocomplete="off">`;
                cell5.innerHTML = `<input style="width: 100%;" type="text" id="searchCompany" placeholder="Company" class="form-control" autocomplete="off">`;

                if (searchContact != null) {
                    document.querySelector('#contactId').value = searchContact;
                    if (contactFocus == "true")
                        document.querySelector('#contactId').focus();
                }
                if (searchFirstName != null) {
                    document.querySelector('#searchFirstName').value = searchFirstName;
                    if (firstNameFocus == "true")
                        document.querySelector('#searchFirstName').focus();
                }
                if (searchLastName != null) {
                    document.querySelector('#searchLastName').value = searchLastName;
                    if (lastNameFocus == "true")
                        document.querySelector('#searchLastName').focus();
                }
                if (searchSpouse != null) {
                    document.querySelector('#searchSpouse').value = searchSpouse;
                    if (spouseFocus == "true")
                        document.querySelector('#searchSpouse').focus();
                }
                if (searchCompany != null) {
                    document.querySelector('#searchCompany').value = searchCompany;
                    if (companyFocus == "true")
                        document.querySelector('#searchCompany').focus();
                }

                // add event listeners
                /*$('#searchFirstName').keyup(function(){
                    viewAppListDataTable.draw();
               });
                
                 $('#searchLastName').keyup(function(){
                    viewAppListDataTable.draw();
              });
       
                $('#searchSpouse').keyup(function(){
                  viewAppListDataTable.draw();
               });
               
                $('#searchCompany').keyup(function(){
                   viewAppListDataTable.draw();
               });*/

                var typingTimer;
                var doneTypingInterval = 1300;
                var $FirstName = $('#searchFirstName');
                var $LastName = $('#searchLastName');
                var $searchSpouse = $('#searchSpouse');
                var $searchCompany = $('#searchCompany');
                var $contactId = $('#contactId');


                //on keyup, start the countdown
                $FirstName.on('keyup', function() {
                    clearTimeout(typingTimer);
                    
                    typingTimer = setTimeout(doneTyping, doneTypingInterval);
                });

                $contactId.on('keyup', function() {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(doneTyping, doneTypingInterval);
                });
                //on keydown, clear the countdown 
                $LastName.on('keydown', function() {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(doneTyping, doneTypingInterval);
                });

                $searchSpouse.on('keydown', function() {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(doneTyping, doneTypingInterval);
                });

                $searchCompany.on('keydown', function() {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(doneTyping, doneTypingInterval);
                });


                //user is "finished typing," do something
                function doneTyping() {

                    viewAppListDataTable.draw();
                }


            },
            "columnDefs": [{
                "width": "10%",
                "targets": 1
            }]
        });






        /* $(document).on('click','.filter_help',function(){
                $('.pop').toggleClass('popOut');
                 
                if($('.pop'). hasClass('popOut')){
                    $('.filter_remove_button').show();
                }
                else{
                     $('.filter_remove_button').show();
                  //  viewAppListDataTable.draw();
                }
         })*/

        $(document).on('click', '.filterTagButton', function(e) {
            e.stopPropagation();
            $('.pop').removeClass('popOut');
            $('.filter_remove_button').show();
            viewAppListDataTable.draw();
        })

        $(document).on('click', '.filter_themeBtn', function(e) {
            e.stopPropagation();
        })

        $(document).on('click', '.filter_search_box', function() {
            $('.pop').toggleClass('popOut');
        })

        $(document).on('click', '.filter_remove_button', function() {

            if ($('.filter_themeBtn').length == 0) {
                $('.filter_text').show();
            }
            viewAppListDataTable.draw();
        })


        $('#courseListDataTable').DataTable({
            //"lengthMenu": [[ -1], ["All"]],
            "lengthMenu": [
                [10, 25, 100, 600, -1],
                [10, 25, 100, 600, "All"]
            ],
            "order": [
                [0, "desc"]
            ],
            "pageLength": 100,
            fixedColumns: true,
            'columnDefs': [{
                    'targets': [1, 2, 3, 4, 7, 8, 9, 10, 11, 12],
                    /* column index */
                    'orderable': false,
                    /* true or false */
                },


            ]

        });
       
        $('#alldataTable').DataTable({
            "order": [
                [0, "desc"]
            ],
            "pageLength": 25
        });

        $('#contract_dataTable').DataTable({
            "order": [],
            "pageLength": 25,
            'columnDefs': [{
                'targets': [4, 5, 6, 7, 8, 9, 10, 11, 12, 13], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }],
        });



    });
</script>
<script>
    $(document).ready(function() {
        $('#user_image').change(function() {
            var val = $(this).val().toLowerCase();
            var regex = new RegExp("(.*?)\.(jpg|png|jpeg)$");
            if (!(regex.test(val))) {
                alert('Please select only jpg,jpeg,png file');
                $("#user_image").val("");
            }
        });
    });
</script>
<script>
    $(document).on('change', '.start_date', function() {
        var start_date = $(this).val();
        var end_date = $(this).closest('tr').find(".end_date").val();

        if (start_date != '' && end_date != '') {
            var d1 = new Date(format(start_date));
            var d2 = new Date(format(end_date));

            if (d1 >= d2 && end_date != '') {
                $(this).val('');
                alert('End date should be greater than start date');
            } else {
                var months = cal_month(d1, d2);
                $(this).closest('tr').find(".month_experience").val(months);
            }
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('li.tab').css('width', '10%');
        $('.tab_style').css('width', '');
        $('.indicator').css('right', '1155px');

        $('form').on('focus', '.datepicker', function(event) {
            event.preventDefault();
            $(this).datepicker({
                format: 'mm/dd/yyyy',
                autoclose: true,
            });
        });

        $('.datepickerforward').datepicker({
            format: 'mm/dd/yyyy',
            todayHighlight: 'TRUE',
            startDate: '-0d',
            autoclose: true,
        });



        $('form').on('focus', '.datepickerforward, .datepickerbackward', function(event) {
            event.preventDefault();
            $(this).datepicker({
                format: 'mm/dd/yyyy',
                todayHighlight: 'TRUE',
                endDate: '-0d',
                autoclose: true,

            });
        });




        $('.datatable').dataTable();
       
        $('#viewfilter_reportDataTable').DataTable({
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                $("td:first", nRow).html(iDisplayIndex + 1);
                return nRow;
            }
        });
         
        // DataTable initialisation
        $('#classListing').DataTable({
            "dom": '<"dt-buttons"Bf><"clear">lirtp',
            "paging": false,
            "autoWidth": true,
            "buttons": [{
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                extend: 'excelHtml5',
                filename: '<?= date('Y-m-d') ?>_class_listing_reports',
                footer: true,
                title: '',
                id: 'classlistexl'

            }],
            "order": [],
        });

        $('#classPassportListings').DataTable({
            "dom": '<"dt-buttons"Bf><"clear">lirtp',
            "paging": false,
            "autoWidth": true,
            "buttons": [{
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                extend: 'excelHtml5',
                filename: '<?= date('Y-m-d') ?>_passport_listing_reports',
                footer: true,
                title: '',
                id: 'classlistexl'

            }]
        });


        $('#SemesterListing').DataTable({
            "dom": '<"dt-buttons excel_position"Bf><"clear">lirtp',
            "paging": false,
            "autoWidth": true,
            "buttons": [{
                text: '<span class=""><i class="fa fa-file-excel-o"></i> Excel</span>',
                extend: 'excelHtml5',
                filename: '<?= date('Y-m-d') ?>_Semester_listing_reports',
                footer: true,
                /*responsive: true*/
                title: '',
                id: 'classlistexl'

            }]
        });

        $('#SemesterListing1').DataTable({
            "dom": '<"dt-buttons excel_position"Bf><"clear">lirtp',
            "paging": false,
            "autoWidth": true,
            "buttons": [{
                text: '<span class=""><i class="fa fa-file-excel-o"></i> Excel</span>',
                extend: 'excelHtml5',
                filename: '<?= date('Y-m-d') ?>_Semester_listing_reports',
                footer: true,
                /*responsive: true*/
                title: '',
                id: 'classlistexl'

            }]
        });

        $('#vpireport').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                filename: '<?= date('Y-m-d') ?> VIP Mailing List',
                title: '',
                fnComplete: function(nButton, oConfig, oFlash, sFlash) {
                    alert('Excel-export complete');
                }
            }]
        });

        var href = location.href;
        if (href.match(/([^\/]*)\/*$/)[1] == 'addVIPMailingList') {

            function firsttask(subject, callback) {
                $('.buttons-excel').click();

                callback();
            }

            function secondtask() {

                Arrow.show();
                $(".modalpopupsss").modal("show");
                setTimeout(function() {
                        window.location.href = '<?php echo base_url("admin/Form/ViewAppList") ?>';
                    },
                    3000
                );

            }
            firsttask('abc', secondtask);

        }

        $('#contactReport').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                filename: '<?= date('Y-m-d') ?>_ContactExport',
                title: '',
                fnComplete: function(nButton, oConfig, oFlash, sFlash) {
                    alert('Excel-export complete');
                }
            }]
        });

        if (href.match(/([^\/]*)\/*$/)[1] == 'exportContactDetails') {
            function firsttask(subject, callback) {
                $('.buttons-excel').click();
                callback();
            }

            function secondtask() {
                Arrow.show();
                $(".modalpopupsss").modal("show");
                setTimeout(function() {
                    window.location.href = '<?php echo base_url("admin/Form/ViewAppList") ?>';
                }, 3000);
            }
            firsttask('abc', secondtask);

        }
        

        $('#generalreport').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                filename: '<?= date('Y-m-d') ?> GENERAL Mailing List',
                title: '',
                fnComplete: function(nButton, oConfig, oFlash, sFlash) {
                    alert('Excel-export complete');
                }
            }]
        });

        var href = location.href;
        if (href.match(/([^\/]*)\/*$/)[1] == 'addGeneralMailingList') {

            function firsttask(subject, callback) {
                $('.buttons-excel').click();
                callback();
            }

            function secondtask() {
                Arrow.show();
                $(".modalpopupsss").modal("show");
                setTimeout(function() {
                        window.location.href = '<?php echo base_url("admin/Form/ViewAppList") ?>';
                    },
                    3000
                );
            }

            firsttask('abc', secondtask);

        }

        $('#donationreportexcel').DataTable({
            dom: 'Bfrtip',
            "order": [],
            buttons: [{
                extend: 'excelHtml5',
                filename: '<?= date('Y-m-d') ?> DonationReportExcel',
                title: '',
                fnComplete: function(nButton, oConfig, oFlash, sFlash) {
                    alert('Excel-export complete');
                }
            }]
        });

        var href = location.href;
        if (href.match(/([^\/]*)\/*$/)[1] == 'getDonationReportExcel') {

            function firsttask(subject, callback) {
                $('.buttons-excel').click();
                callback();
            }

            function secondtask() {
                Arrow.show();
                $(".modalpopupsss").modal("show");
                setTimeout(function() {
                        window.location.href = '<?php echo base_url("admin/Form/ViewAppList") ?>';
                    },
                    3000
                );

            }
            firsttask('abc', secondtask);
        }




        var href = location.href;
        if (href.match(/([^\/]*)\/*$/)[1] == 'view_download_image') {

            function firsttask(subject, callback) {
                //$('.buttons-excel').click();
                callback();
            }

            function secondtask() {
                Arrow.show();
                $(".modalpopupsss").modal("show");
                setTimeout(function() {
                        window.location.href = '<?php echo base_url("admin/Reports/exportContactDetails") ?>';

                    },
                    3000
                );


            }
            firsttask('abc', secondtask);

        }



        $('#donormailreport').DataTable({
            dom: 'Bfrtip',

            buttons: [{
                extend: 'excelHtml5',
                exportOptions: {
                    format: {
                        body: function(data, row, column, node) {
                            switch (column) {
                                case 10:
                                    return '\u200C' + data;
                                case 14:
                                    return '\u200C' + data;
                                case 15:
                                    return '\u200C' + data;
                                case 17:
                                    return '\u200C' + data;
                                case 19:
                                    return '\u200C' + data;
                                default:
                                    return data;
                            }
                        }
                    }
                },
                filename: '<?= date('Y-m-d') ?> Donor Mailing List',
                title: '',
                fnComplete: function(nButton, oConfig, oFlash, sFlash) {
                    alert('Excel-export complete');
                }
            }]
        });
        var href = location.href;
        if (href.match(/([^\/]*)\/*$/)[1] == 'addDonorMailingList') {
            function firsttask(subject, callback) {
                $('.buttons-excel').click();
                callback();
            }

            function secondtask() {
                Arrow.show();
                $(".modalpopupsss").modal("show");
                setTimeout(function() {
                        window.location.href = '<?php echo base_url("admin/Form/ViewAppList") ?>';
                    },
                    3000
                );
            }

            firsttask('abc', secondtask);
        }

        // downloaded excel report page


        $(document).on("click", ".dt-button", function() {
            var href = location.href;
            if (href.match(/([^\/]*)\/*$/)[1] == 'classListing') {

                function firsttask(subject, callback) {
                    //$('.buttons-excel').click();
                    callback();
                }

                function secondtask() {
                    Arrow.show();
                    $(".modalpopupsss").modal("show");
                    setTimeout(function() {
                            window.location.href = '<?php echo base_url("admin/Reports/classListing") ?>';
                        },
                        3000
                    );
                }
                firsttask('abc', secondtask);
            }

        });



    });
</script>


<script>
    function getstatedetails(id) {
        //$('#block').html('<option value="" selected="selected" >Select Block</option>');
        //$('#village').html('<option value="" selected="selected" >Select Village</option>');
        var url = '<?= base_url() ?>'
        $.ajax({
            type: "POST",
            url: url + 'project_fg/FG_UMS/SCBV/ajax_state_list',
            data: {
                'id': id
            },
            dataType: "html",
            success: function(data) {
                $('#state').html(data);
            },
        });
    }
</script>

<script>
    // jQuery ".Class" SELECTOR.
    $(document).ready(function() {
        $(document).on('keypress', '.num', function(event) {
            return isNumber(event, this)
        });
    });


    $(document).ready(function() {
        $(document).on('keypress', '.char', function(event) {
            return ValidateAlpha(event, this)
        });

    });

    // apply mask for phone number
    $(document).ready(function() {
        $('input[name="phone"], input[name="fed_phone"]').mask('(000) 000 0000');
        $('input[name="fax_no"]').mask('+99-9999999999');
        $('input[name="employer_fax"]').mask('+99-9999999999');
        $('input[name="aadhar"]').mask('999999999999');
        $('input[name="aadhar_enroll_no"]').mask('9999/99999/99999');
        $('.year').mask('9999');
        $('.passedyear').mask('9999');
    });

    // validate email address

    function validateEmail(email) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(email) == false) {
            alert('Enter Valid E-mail Below Given Format \r\n email@subdomain.example.com or \r\n (testuser@gmail.com)');
            document.getElementById("email").value = "";
            //return false;
        }

    }

    // validate alternative email

    function validateAlternateEmail(email) {
        var alt_reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (alt_reg.test(email) == false) {
            alert('Enter Valid E-mail Below Given Format \r\n email@subdomain.example.com or \r\n (testuser@gmail.com)');
            document.getElementById("alt_email").value = "";
        }

    }


    // validate employer email 

    function validateEmployerEmail(email) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(email) == false) {
            alert('Enter Valid E-mail Below Given Format \r\n email@subdomain.example.com or \r\n (testuser@gmail.com)');
            document.getElementById("employer_email").value = "";
        }

    }


    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {
        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            //(charCode != 45 || $(element).val().indexOf('-') != -1) &&      // â€œ-â€� CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) && // â€œ.â€� CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57) && (charCode != 8)) {
            alert('Charcter not allowed');
            return false;
        } else {
            return true;
        }
    }
</script>
<script>
    function ValidateAlpha(key) {
        if ((key.charCode < 97 || key.charCode > 122) &&
            (key.charCode < 65 || key.charCode > 90) &&
            (key.charCode != 32) &&
            (key.charCode != 46) &&
            (key.charCode != 0)) {

            alert('Only charcters are allowed');
            return false;
        } else {

            return true;
        }
    }

    function ValidateAlphaNew(key) {
        //alert(key.charCode);
        if ((key.charCode < 97 || key.charCode > 122) &&
            (key.charCode < 47 || key.charCode > 90) &&
            (key.charCode != 32) &&
            (key.charCode != 16) &&
            (key.charCode != 34) &&
            (key.charCode != 39) &&
            (key.charCode != 44) &&
            (key.charCode != 95) &&
            (key.charCode != 45) &&
            (key.charCode != 46) &&
            (key.charCode != 0)) {

            alert('Special charcters are Not Allowed');
            return false;
        } else {

            return true;
        }
    }
</script>
<script>
    $(function($) {

        // this script needs to be loaded on every page where an ajax POST may happen
        $.ajaxSetup({
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            }
        });

    });

    $('form').attr('autocomplete', 'off');
</script>
<script type="text/javascript">
    function clickPrint() {
        $('a').hide();

    }
</script>

<script type="text/javascript">
    $(function() {
        $("#btnPrint").click(function() {
            $('.btn').css("display", "none");
            $('.top-block').css("display", "block");
            var contents = $("#dvContainer").html();
            //contents = contents.replace(/<\/?a[^>]*>/g, ""); //remove if u want links in your table
            //tab_text = tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
            //tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
            var heading = 'PERFORMA OF HRDS(Publication of Outstanding Works on Sports Related Subject)';
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({
                "position": "absolute",
                "top": "-1000000px"
            });
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html><head><title>' + heading + '</title>');
            frameDoc.document.write('</head><body>');
            //Append the external CSS file.
            var baseurl = "<?php echo base_url(); ?>";
            var style = baseurl + "assets/css/style_main.css";
            frameDoc.document.write('<link href="' + style + '" rel="stylesheet" type="text/css" />');
            //Append the DIV contents.
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function() {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
            $('.btn').css("display", "inline-block");
            $('.top-block').css("display", "none");
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('input[name="phone"], input[name="fed_phone"]').mask('(000) 000 0000');
        $('input[name="fax_no"]').mask('+99-9999999999');
        $('input[name="employer_fax"]').mask('+99-9999999999');
        $('input[name="aadhar"]').mask('999999999999');
        $('input[name="aadhar_enroll_no"]').mask('9999/99999/99999');
        $('.year').mask('9999');
        $('.passedyear').mask('9999');
    });
</script>

<script src="<?= base_url('assets/js/custom-script.js') ?>"></script>
<script>
    /*
     * -------------------------------------------------------
     * Project: arrow
     * Version: 0.1.9
     *
     * Author:  Petar Bojinov
     * Contact: petarbojinov@gmail.com
     *
     *
     * Copyright (c) 2015 Petar Bojinov
     * -------------------------------------------------------
     */

    window.Arrow = function(window, document) {
        "use strict";

        function _increaseOpacity(milliseconds) {
            var arrow = document.getElementById("arrow-" + browser);
            arrow.style.display = "block";
            var i = 0,
                ieI = 0,
                x = setInterval(function() {
                    i += .1, ieI += 10, "msie" === browser && 8 >= browserVersion ? arrow.filters && (arrow.filters.item("DXImageTransform.Microsoft.Alpha").opacity = ieI) : arrow.style.opacity = i
                }, 50);
            setTimeout(function() {
                clearInterval(x)
            }, 1600), setTimeout(function() {
                _hide()
            }, milliseconds || 6e3)

        }

        function _decreaseOpacity() {
            var arrow = document.getElementById("arrow-" + browser),
                i = 1,
                ieI = 100,
                x = setInterval(function() {
                    i -= .1, ieI -= 10, "msie" === browser && 8 >= browserVersion ? arrow.filters && (arrow.filters.item("DXImageTransform.Microsoft.Alpha").opacity = ieI) : arrow.style.opacity = i
                }, 50);
            setTimeout(function() {
                clearInterval(x), arrow.style.display = "none"
            }, 1600)
        }

        function _applyStyleModern(node) {
            node.style.position = "fixed", node.style.zIndex = 999, node.style.display = "none", node.style.height = "309px", node.style.width = "186px", node.style.opacity = 0, node.style.backgroundImage = "url(https://i.imgur.com/aMwoyfN.png)", node.style.backgroundRepeat = "no-repeat", node.style.backgroundPositionX = "0", node.style.backgroundPositionY = "0"

        }

        function _applyStyleIE8(node) {
            node.style.top = "10px", node.style.left = "20px";
            var opacity = "progid:DXImageTransform.Microsoft.Alpha(opacity=0) ",
                imgSrc = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="https://i.imgur.com/aMwoyfN.png", sizingMethod="scale") ',
                rotation = 'progid:DXImageTransform.Microsoft.Matrix(M11=1, M12=1.2246063538223773e-16, M21=-1.2246063538223773e-16, M22=-1, SizingMethod="auto expand") ';

            node.style.filter = opacity + imgSrc + rotation
        }

        function _applyStyleMs(node) {
            node.style.bottom = "50px", node.style.left = "67%"
        }

        function _applyStyleMoz(node) {
            node.style.top = "0px", node.style.right = "37px", node.style.transform = "rotateX(180deg) rotateY(180deg)", node.style.MozTransform = "rotateX(180deg) rotateY(180deg)"
        }

        function _applyStyleWebkit(node) {
            node.style.bottom = "50px", node.style.left = "20px"
        }

        function _applyStyleSafari(node) {
            node.style.top = "0px", node.style.right = "80px", node.style.transform = "rotateX(180deg) rotateY(180deg)", node.style.webkitTransform = "rotateX(180deg) rotateY(180deg)"
        }

        function _setStyleType(node) {
            _applyStyleModern(node), "msie" === browser ? 8 === browserVersion ? _applyStyleIE8(node) : (9 === browserVersion || 10 === browserVersion) && _applyStyleMs(node) : "chrome" === browser || "opera" === browser ? _applyStyleWebkit(node) : "safari" === browser ? _applyStyleSafari(node) : "IE11" === browser || "edge" === browser ? _applyStyleMs(node) : "firefox" === browser && browserVersion >= 20 && _applyStyleMoz(node)
        }

        function _buildArrow() {
            var div = document.createElement("div");
            return div.setAttribute("id", "arrow-" + browser), arrowNode = div, div
        }

        function _injectNode(node) {
            document.body.appendChild(node)
        }

        function _isExist() {
            return !!document.getElementById("arrow-" + browser)
        }

        function _initArrow() {
            var arrow = _buildArrow();
            _setStyleType(arrow), _calculateArrowPosition(), _injectNode(arrow), _addWindowEvent("resize", _calculateArrowPosition), _addWindowEvent("scroll", _calculateArrowPosition)
        }

        function _addWindowEvent(event, functionReference) {
            window.addEventListener ? window.addEventListener(event, functionReference, !1) : window.attachEvent && window.attachEvent(event, functionReference)
        }

        function _calculateArrowPosition() {
            "number" == typeof window.innerWidth ? (visibleWidth = window.innerWidth, visibleHeight = window.innerHeight) : document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight) && (visibleWidth = document.documentElement.clientWidth, visibleHeight = document.documentElement.clientHeight), "msie" === browser && 9 === browserVersion && (1005 > visibleWidth ? arrowNode.style.bottom = "85px" : visibleWidth > 1006 && (arrowNode.style.bottom = "50px"))

        }

        function _hide() {
            if (!_isExist()) throw "Invalid usage: There are no arrows on the page.";
            _decreaseOpacity()
        }

        function show(seconds) {
            if (!_isExist()) throw "Invalid usage: arrow does not exist";
            _increaseOpacity(seconds);

        }
        var arrowNode, version = "0.1.9",
            Arrow = {},
            browser = "",
            browserVersion = 0,
            visibleHeight = 0,
            visibleWidth = 0;
        return function() {


            var tem, N = navigator.appName,
                ua = navigator.userAgent,
                M = ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
            M && null != (tem = ua.match(/version\/([\.\d]+)/i)) && (M[2] = tem[1]), M = M ? [M[1], M[2]] : [N, navigator.appVersion, "-?"], browser = "netscape" == M[0].toLowerCase() ? "IE11" : -1 != ua.toLowerCase().indexOf("edge") ? "edge" : M[0].toLowerCase(), browserVersion = parseInt(M[1], 10)
        }(), _initArrow(), Arrow._version = version, Arrow._browser = browser, Arrow._browserVersion = browserVersion, Arrow.show = show, Arrow
    }(window, window.document);

    $(document).ready(function() {
        var url = "<?= base_url() ?>";
        $.ajax({
            type: "POST",
            url: url + 'admin/Myinbox/get_unread_message',
            //data: {'id':id},
            dataType: "html",
            success: function(data) {
                $('#msg_inbox_count').html(data);
                if (data == 0)
                    var str = 'You have no unread messages';
                else
                    var str = `You have <span class='text text-primary'>${data}</span> unread messages`;
                $('#mainNav-inbox-notification').html(str);
                //console.log(`unread messageds: ${data}`);
            },
        });
        // apoorv 8/06/2020
        $.ajax({
            type: "POST",
            url: url + 'formbuilder/Application/get_unread_application_forms',
            //data: {'id':id},
            dataType: "html",
            success: function(data) {

                if (data == 0)
                    var str = 'You have no assigned forms';
                else
                    var str = `You have <span class='text text-primary'>${data}</span> new assigned forms`;
                $('#mainNav-assignForms-notification').html(str);
                //console.log(`unread messageds: ${data}`);
            },
        });
        // end of apoorv 8/06/2020
        //apoorv 10/09/2020
        $.ajax({
            type: "POST",
            url: url + 'formbuilder/Application/get_unread_formbuilder_forms',
            //data: {'id':id},
            dataType: "html",
            success: function(data) {

                if (data == 0)
                    var str = 'No forms filled';
                else
                    var str = `<span class='text text-primary'>${data}</span> form were filled`;
                $('#mainNav-formbuilder-notification').html(str);
                //console.log(`unread messageds: ${data}`);
            },
        });
        // end of apoorv
    })

    $('#student_finance').DataTable({
        //"lengthMenu": [[ -1], ["All"]],
        "lengthMenu": [
            [10, 25, 100, 600, -1],
            [10, 25, 100, 600, "All"]
        ],
        "order": [],
        "pageLength": 600
    });


    $('#alldataTable2').DataTable({
        "order": [],
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        "pageLength": -1
    });

    $('#dataTable2').DataTable({
        "order": [],
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        "pageLength": -1
    });



    $('#alldataTable3').DataTable({



        aoColumnDefs: [{
            orderable: false,
            aTargets: [4]
        }],

        "order": [],

        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],

        "pageLength": -1

    });





    $('#course_report').DataTable({
        aoColumnDefs: [{
            // orderable : false, aTargets : [4]        
        }],

        "dom": '<"dt-buttons"Bf><"clear">lirtp',
        "autoWidth": true,
        "buttons": [{
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            extend: 'excelHtml5',
            messageTop: 'Course Report',
            filename: '<?= date('Y-m-d') ?>_course_reports',
            title: '',
            id: 'classlistexl',
            exportOptions: {
                columns: ':visible'
            }
        }],

        "order": [],
        //"ordering": false,
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],

        "pageLength": -1
    });



















    $(document).on('click', '.double_spacing', function() {
        $('td').addClass('cell_two_design');
        $('th').addClass('cell_two_design');
        $(this).addClass('active_color');
        $('.single_spacing').removeClass('active_color');
        $('.spacing-btn-box').addClass('active_color');
    })

    $(document).on('click', '.single_spacing', function() {
        $('td').removeClass('cell_two_design');
        $('th').removeClass('cell_two_design');
        $(this).addClass('active_color');
        $('.double_spacing').removeClass('active_color');
        $('.spacing-btn-box').addClass('active_color')
    })



    /*Start Manage Sort By Pop hide/show */
    function sort_field() {
        var count = (parseInt($('#sort_count').val())) + 1;
        var content = '';
        content += '<div class="form-group custum_padding" id="new_sort_row' + count + '">';
        content += '<div class="col-md-6 top_marginn stop_hide_after_selection_class">';
        content += '<select class="form-control form-control1 filter_ajax" name="column[' + count + ']">';
        content += '<option value="">&#xf034; Name</option>';
        $('.datatable_th th').each(function() {
            if (!$(this).hasClass('not-sorted')) {
                content += '<option value="' + $(this).attr("data-name") + '">' + $(this).html() + '</option>';
            }
        })

        content += '</select>';
        content += '</div>';
        content += '<div class="col-md-5 top_marginn stop_hide_after_selection_class">';
        content += '<select class="form-control form-control1 filter_ajax" name="order_type[' + count + ']">';
        content += '<option value="ASC">&#xf160; Ascending</option>';
        content += '<option value="DESC">&#xf161; Descending</option>';
        content += '</select>';
        content += '</div>';
        content += '<div class="col-md-1 top_marginn">';
        content += '<span class="close_button filter_ajax" rel_id="' + count + '"><i class="fa fa-times"></i><span>';
        content += '</div>';
        content += '</div>';
        $('#sort_count').val(count)
        $('.sort_list_group').append(content);
    }

    //sort_field();

    $(document).on('click', '.add_new_sort', function() {
        sort_field();

        $('.stop_hide_after_selection_class').on('click', function(e) {
            e.stopPropagation();
        });
    })

    $(document).on('click', '.close_button', function() {
        var rel_id = $(this).attr('rel_id');
        $('#new_sort_row' + rel_id).remove();
        form_submit_data();
    })

    $(document).on('click', '.sort-data', function() {
        var position = $(this).attr('postion');
        var order = $(this).attr('order');
        alert(position + " " + order);
        var table = $('.datatable_th').DataTable();
        table.order([
            [position, order]
        ]).draw();
    })

    $(document).on('click', '.dropdown-menu', function(e) {
        e.stopPropagation();
    });

    $("document").ready(function() {
        $('.stop_hide_after_selection_class').on('click', function(e) {
            e.stopPropagation();
        });
    });

    /*End Manage Sort By Pop hide/show */

    /* Start Hide Field */
    function listing_table_field() {
        var content = '';
        content += '<ul class="list_field" >';
        /*content += '<li class="field_li" rel_data="All" rel_column="-1">';
        content += '<span class="show-content">All</span>';
        content += '<span class="show-check pull-right">';
        content += '<input type="checkbox" class="All filter_check_box" value="All" name="selected_field[]">';
        content += '</span>';
        content += '</li>';*/
        var no_column = 0
        $('.datatable_th th').each(function() {
            content += '<li class="field_li show-active" rel_column="' + (no_column) + '" rel_data="' + $(this).attr("data-name") + '">';
            content += '<span class="show-content">' + $(this).html() + '</span>';
            content += '<span class="show-check pull-right">';
            content += '<input type="checkbox" checked rel_column_no="' + (no_column) + '" class=" filter_check_box ' + $(this).attr("data-name") + '" value="' + $(this).attr("data-name") + '" name="selected_field[]">';
            content += '</span>';
            content += '</li>';
            no_column++;
        })
        content += '</ul>';
        $('.list_field_div').html(content);


    }
    listing_table_field();

    $(document).on('click', '.field_li', function() {
        var rel_data = $(this).attr('rel_data');
        var column = $(this).attr('rel_column');
        if (rel_data != 'All') {
            if (!$(this).hasClass('show-active')) {
                $(this).addClass('show-active');
                $('.' + rel_data).prop('checked', true);
            } else {
                $('.' + rel_data).prop('checked', false);
                $(this).removeClass('show-active');
            }
            var table = $('.datatable_th').DataTable();
            var column = table.column(column);
            // Toggle the visibility
            column.visible(!column.visible());
        } else {
            if (!$(this).hasClass('show-active')) {
                $('.field_li').addClass('show-active');
                $('.filter_check_box').prop('checked', true);
            } else {
                $('.field_li').removeClass('show-active');
                $('.filter_check_box').prop('checked', false);
            }
        }
    })
    /* End Hide Field */


    function filter_progress_loader() {
        var content = '';
        content += '<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
        content += '</main>';
        $('#result').html(content);
        form_submit_data();
    }

    $(function() {
        $('.datepicker_with_month').datepicker({
            viewMode: "months",
            minViewMode: "months",
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'mm/yyyy',
            autoclose: false,
        });
    });


    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>goole_api/send_notify.php',
            dataType: "html",
            success: function(data) {

            },
        });
    })
</script>

</body>

</html>