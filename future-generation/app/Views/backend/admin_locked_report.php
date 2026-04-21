<?php
$finane = getfinancialyear_june(date("d-m-Y"));
$finanyre = explode("-", $finane);

$first_datee = $finanyre[0];
$last_datee = $finanyre[1];

//echo "<pre>";print_r($data);die; 

//echo "<pre>"; print_r(session()->get());
?>
<style>
    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        width: auto;
    }

    .dataTables_info {
        display: none;
    }

    #classListing_filter {
        display: none;
    }

    /* start style for checkbox*/
    input[type="checkbox"] {
        width: 26px;
        /*Desired width*/
        height: 26px;
        /*Desired height*/
        /*margin-left: 116px;*/

    }

    /* end style for checkbox*/
</style>
<!-- coded by bajrang -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <!--div class="row">
                <div class="col-sm-12" style="left: 38%;">
                    <h4 class="pull-left page-title">Future Generations University Timesheet</h4>
                </div>
            </div-->
            <div class="row">
                <div class="col-md-12">
                    <!--  start  Model for edit  -->
                    <?php echo form_open_multipart("admin/Reports/Update_lock"); ?>
                    <div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content p-0 b-0">
                                <div class="row">
                                    <!-- Basic example -->
                                    <div class="col-md-12">
                                        <div class="panel panel-color panel-info">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Unlock Timesheet (
                                                    <?= isset($facultystaff_unlock) && !empty($facultystaff_unlock)
                                                        ? $facultystaff_unlock[0]['FirstName'] . " " . $facultystaff_unlock[0]['LastName']
                                                        : '' ?>
                                                    ) </h3>
                                            </div>
                                            <div class="panel-body">
                                                <table id="lock_report" class="table table-striped table-bordered " style="font-size: 12px;">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <input type="hidden" name="employ_id" value=<?= isset($employ_id) ? $employ_id : '' ?>>
                                                                <input type="hidden" name="year" value=<?= $selected_year ?>>
                                                                <input type="hidden" name="month" value=<?= $selected_month ?>>
                                                                <input type="checkbox" id="select_all" /> Select all
                                                            </th>
                                                            <th style="font-weight: bold;">Transaction Date
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($emp_record)) {
                                                            foreach ($emp_record as $emp_record) {
                                                        ?>
                                                                <tr>
                                                                    <td><input type="checkbox" name="date[]" class="checkbox" style="margin-left: 141px;" value="<?= $emp_record['transaction'] ?>" /></td>
                                                                    <td><?= $emp_record['transaction'] ?></td>
                                                                </tr>
                                                        <?php }
                                                        } ?>

                                                    </tbody>
                                                </table>

                                            </div> <!-- panel-body -->
                                            <div class="modal-footer" style="text-align:center !important;">
                                                <a href="<?php echo base_url('admin/Reports/AdminLockedReport') ?>" type="button" class="btn btn-default waves-effect">Close</a>
                                                <input type="submit" class="btn btn-success" name="submit" value="Unlock">
                                            </div>
                                        </div> <!-- panel -->

                                    </div> <!-- row-->
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                    <?php echo form_close(); ?>
                    <!--  end  Model for edit  -->
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <?php
                            //GetDate = strtotime($_SESSION['admin_login_date_time']);
                            //$getDate = date(M Y,$GetDate );
                            ?>
                            <h3 class="panel-title">Admin Locked Report <span style="position: absolute;left: 46%;"> <?php echo $_SESSION['admin_fullname']; ?></span>
                                <a href="javascript:history.go(-1)" style="margin-top: -2px;" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body" style="padding-left: 0px; padding-right: 0px;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-12">
                                    <?php
                                    $attr = array("class" => "form-horizontal");
                                    echo form_open("admin/Reports/adminLockedReport", $attr);
                                    ?>
                                    <div class="col-md-1">

                                        <select name="month" id="month" class="" style="height: 34px;" required data-placeholder="Choose a Country...">
                                            <option value="">Select Month</option>
                                            <option value='01' <?php if ($selected_month == '01') {
                                                                    echo "selected";
                                                                } ?>>Janaury</option>
                                            <option value='02' <?php if ($selected_month == '02') {
                                                                    echo "selected";
                                                                } ?>>February</option>
                                            <option value='03' <?php if ($selected_month == '03') {
                                                                    echo "selected";
                                                                } ?>>March</option>
                                            <option value='04' <?php if ($selected_month == '04') {
                                                                    echo "selected";
                                                                } ?>>April</option>
                                            <option value='05' <?php if ($selected_month == '05') {
                                                                    echo "selected";
                                                                } ?>>May</option>
                                            <option value='06' <?php if ($selected_month == '06') {
                                                                    echo "selected";
                                                                } ?>>June</option>
                                            <option value='07' <?php if ($selected_month == '07') {
                                                                    echo "selected";
                                                                } ?>>July</option>
                                            <option value='08' <?php if ($selected_month == '08') {
                                                                    echo "selected";
                                                                } ?>>August</option>
                                            <option value='09' <?php if ($selected_month == '09') {
                                                                    echo "selected";
                                                                } ?>>September</option>
                                            <option value='10' <?php if ($selected_month == '10') {
                                                                    echo "selected";
                                                                } ?>>October</option>
                                            <option value='11' <?php if ($selected_month == '11') {
                                                                    echo "selected";
                                                                } ?>>November</option>
                                            <option value='12' <?php if ($selected_month == '12') {
                                                                    echo "selected";
                                                                } ?>>December</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <select name="year" style="height: 34px; margin-left: 12px;" class="" id="year" required data-placeholder="Choose a Country...">
                                            <option value="">Select Year...</option>
                                            <?php
                                            for ($k = 2018; $k <= date('Y'); $k++) {
                                            ?>
                                                <option value="<?php echo $k ?>" <?php if ($selected_year == $k) {
                                                                                        echo "selected";
                                                                                    } ?>><?= $k ?> </option>
                                            <?php
                                            }
                                            ?>



                                        </select>
                                    </div>
                                    <div class="col-md-1"><button class="btn btn-success waves-effect waves-light m-b-5 m-l-5" style=" margin-left: 21px;" onclick="return Date_Valid();">Filter</button>
                                    </div>
                                    <div class="col-md-5"></div>

                                    <?php echo form_close(); ?>

                                </div>
                                <div class="col-md-12 table-responsive">
                                    <table id="alldataTable1" class="table table-striped table-bordered alldataTable " style="font-size: 12px;">
                                        <thead>

                                            <tr>

                                                <th>Employees</th>
                                                <th style="font-weight: bold;">Not Lock Count</th>
                                                <th style="font-weight: bold;">Last Locked Date</th>
                                                <th style="font-weight: bold;">Action (Unlock)</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($recc_staff) {


                                                foreach ($recc_staff as  $staff) { ?>
                                                    <tr>
                                                        <td><?php echo $staff['FirstName'] . " " . $staff['LastName'] . "(" . $staff['ID'] . ")"; ?></td>

                                                        <td>
                                                            <?php $cnt = 0;
                                                            foreach ($records as $valuee) {

                                                                if ($valuee['empid'] == $staff['ID']) {
                                                                    echo $cnt = $valuee['countlock'];
                                                                }
                                                            }
                                                            if (@$cnt == 0 or @$cnt == null) {
                                                                echo $cnt;
                                                            }   ?>
                                                        </td>
                                                        <td>
                                                            <?php foreach ($records_last as $valud) {

                                                                if ($valud['empid'] == $staff['ID']) {
                                                                    echo date('m/d/Y', strtotime($valud['last_date']));
                                                                }
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo form_open("admin/Reports/AdminLockedReport");
                                                            ?>
                                                            <input type="hidden" name="empid" value="<?= encryptor('encrypt', $staff['ID']) ?>">
                                                            <input type="hidden" name="year" value="<?= $selected_year ?>">
                                                            <input type="hidden" name="month" value="<?= $selected_month ?>">

                                                            <button type="submit" class="btn btn-success waves-effect waves-light m-b-3 m-l-3"><i class="fa fa-unlock-alt fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                            <?php echo form_close(); ?>
                                                        </td>

                                                    </tr>
                                            <?php }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->
        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content-page -->
<!-- end coded by bajrang -->
<?php if (isset($emp_record)) { ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#panel-modal').modal('show');
        });
    </script>
<?php } ?>
<script>
    function Date_Valid() {

        var BeginN = $('#BeginDateforms').val().length;
        var EndN = $('#EndDateforms').val().length;
        //console.log(BeginN +'  END:'+EndN);
        if (BeginN == 0 && EndN == 0) {

            alert("From and To dates are required field");
            return false;
        } else {
            var BeginDate = new Date($('#BeginDateforms').val());
            var EndDate = new Date($('#EndDateforms').val());
            if (Date.parse(EndDate) < Date.parse(BeginDate)) {
                //start is less than End
                alert("To Date can not be smaller than From Date");
                return false;
            } else {
                //end is less than start
                return true;
            }
        }

    }
</script>
<script>
    function fnExcelReport(table_id) {
        // alert(table_id);
        var tab_text = '<table border="1px" style="font-size:16px" ">';
        var textRange;
        var j = 0;
        var tab = document.getElementById(table_id); // id of table
        var lines = tab.rows.length;
        //console.log(tab.rows);
        // the first headline of the table#0d4660 DFDFDF
        if (lines > 0) {
            tab_text = tab_text + '<tr>' + tab.rows[0].innerHTML + '</tr>' + '<tr>' + tab.rows[1].innerHTML + '</tr>';
        }

        // table data lines, loop starting from 1
        for (j = 2; j < lines; j++) {
            tab_text = tab_text + "<tr>" + tab.rows[j].innerHTML + "</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<a[^>]*>|<\/a>/g, ""); //remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
        // console.log(tab_text); // aktivate so see the result (press F12 in browser)

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        // if Internet Explorer
        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
            txtArea1.document.open("txt/html", "replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa = txtArea1.document.execCommand("SaveAs", true, "DataTableExport.xls");
        } else
            var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_html = encodeURIComponent(tab_text); //table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        /*today = mm + '/' + dd + '/' + yyyy;*/
        today = yyyy + '/' + mm + '/' + dd;
        /*var next_year = <?= $last_datee ?>*/

        //setting the file name
        a.download = 'admin_time_report_' + today + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
        /**********************************************/
        return (sa);
    }
</script>
<!-- script for checkall -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#select_all').on('click', function() {
            if (this.checked) {
                $('.checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $('.checkbox').on('click', function() {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#select_all').prop('checked', true);
            } else {
                $('#select_all').prop('checked', false);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#alldataTable1').DataTable({
            "order": [
                [2, "desc"]
            ],
            "pageLength": 30
        });
    });
</script>