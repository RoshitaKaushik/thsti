<?php //echo "<pre>";print_r($data);die; 

//echo "<pre>"; print_r($this->session->userdata());
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

    #generatepdf {
        margin-top: 1px;
    }

    .filter-sub-menu-outer-box .filter_ul {
        width: 343px ! important;
    }

    .buttons-excel {
        right: 20px !important;
        top: -53px !important;
    }
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title"></h4>
    			</div>
    		</div-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <h3 class="panel-title">Class Listing Reports
                                <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">



                            <?php
                            $attr = array("name" => "filter", "id" => "filter");
                            echo form_open_multipart('admin/Reports/classListing', $attr);
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Button Filter -->

                                    <div class="col-md-10">
                                        <div class="filter-sub-menu-outer-box">
                                            <li class="dropdown hidden-xs filter-li">
                                                <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-filter"></i>Filter <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-lg filter_ul">
                                                    <li class="text-center notifi-title">Filter</li>
                                                    <li class="list-group">
                                                        <!-- list item-->
                                                        <div class="col-sm-12 filter_category">

                                                            <div class="form-group">
                                                                <div class="col-sm-4 top_maargin">
                                                                    <label for="First Name" class="control-label">Class <span class="requires">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8 top_maargin">
                                                                    <select class="form-control filter_ajax" id="class" name="class">
                                                                        <option value="">Select</option>
                                                                        <option value="All">All Classes</option>
                                                                        <?php if (!empty($class)) {
                                                                            foreach ($class as $cl) {
                                                                        ?>
                                                                                <option value="<?= $cl['Class'] ?>" <?php if ($selectedclass == $cl['Class']) {
                                                                                                                        echo "selected='selected'";
                                                                                                                    } ?>><?= $cl['Class'] ?></option>
                                                                        <?php }
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="cell_spacing_li">
                                                <a href="#" data-target="#" title="Line Spacing" class="dropdown-toggle waves-effect waves-light spacing-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                    <!--i class="fa fa-ellipsis-h" aria-hidden="true"></i-->
                                                    <i class="fa fa-arrows-v"></i><i class="fa fa-bars"></i> <!--<i class="fa fa-angle-down" aria-hidden="true">--></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-md spacing_ul">
                                                    <li class="list-group" style="margin-bottom:0px !important;">
                                                        <!-- list item-->
                                                        <span>
                                                            <div class="single_spacing">

                                                                <i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-bars" aria-hidden="true"></i>
                                                                Single
                                                            </div>

                                                            <div class="double_spacing">
                                                                <i class="fa fa-arrows-v" aria-hidden="true"></i><i class="fa fa-bars" aria-hidden="true"></i>
                                                                Double
                                                            </div>

                                                        </span>
                                                    </li>
                                                </ul>

                                            </li>
                                            <div class="stop-noti-box">

                                                <li class="sort_li">
                                                    <a href="#" data-target="#" title="Sort" class="dropdown-toggle waves-effect waves-light sort-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-long-arrow-down"></i><i class="fa fa-long-arrow-up"></i> Sort <i class="fa fa-angle-down" aria-hidden="true"></i>

                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-lg sort_ul">
                                                        <li class="text-center notifi-title">Sort by
                                                            <input type="hidden" class="form-control" id="sort_count" value="0">
                                                        </li>
                                                        <li class="list-group">
                                                            <div class="row  sort_list_group">

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-11">
                                                                    <span class="add_new_sort pull-right"><i class="fa fa-plus"></i>&nbsp;Add new sort</span>
                                                                </div>
                                                                <div class="col-md-1"></div>
                                                            </div>

                                                        </li>
                                                    </ul>
                                                </li>

                                            </div>

                                            <div class="stop-noti-box">
                                                <li class="hide_li">
                                                    <a href="#" data-target="#" title="Sort" class="dropdown-toggle waves-effect waves-light sort-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-eye-slash"></i> Hide <i class="fa fa-angle-down" aria-hidden="true"></i>

                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-lg hide_ul">
                                                        <li class="text-center notifi-title">Hide
                                                        </li>
                                                        <li class="list-group">
                                                            <div class="col-md-12">
                                                                <div class="row list_field_div hide_list_group"></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="hidden" class="form-control" id="selected_class">
                                        <button type="button" id="generatepdf" class="btn btn-purple waves-effect custum_buttom waves-light m-b-5 m-l-5"><i class="fa fa-file-pdf-o"></i>
                                            <span><strong>PDF</strong></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>


                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="result">
                                    <?php
                                    echo view('templates/filter/filter_viewClassListing', isset($data) ? $data : []);
                                    ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->
        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content-page -->
<script>
    /*function submitform(){
	$('#filter').submit();
}*/

    $(document).on('change', '.filter_ajax', function() {
        filter_progress_loader();
        var selected_class = $('#class').val();



        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?= base_url() ?>admin/Reports/data_encrypte',
            data: {
                selected_class: selected_class
            },
            success: function(response) {
                $('#selected_class').val(response);
            }
        });



    })

    function form_submit_data() {
        var formname = '';
        formname = $("#filter");
        var formData = new FormData($('#filter')[0]);
        formData.append("submit", "filter");
        formData.append("<?= csrf_token() ?>": "<?= csrf_hash() ?>");
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: '<?= base_url() ?>admin/Reports/filter_classListing',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#result').html(response);
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
                        id: 'classlistexl',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }],
                    "order": [],
                });

                $('input[name="selected_field[]"]:not(:checked)').each(function() {
                    var column_no = $(this).attr('rel_column_no');
                    var table = $('.datatable_th').DataTable();
                    var column = table.column(column_no);
                    // Toggle the visibility
                    column.visible(!column.visible());
                });

            }
        });
    }



    $(document).on("click", "#generatepdf", function() {

        //window.location.href = '<?php //echo  base_url("admin/PdfBuilder/classReportPdf/");
                                    ?><?php //echo encryptor('encrypt',$selectedclass);
                                                                                                ?>';
        var selectedclass = $('#selected_class').val();
        window.open('<?php echo  base_url("admin/PdfBuilder/classReportPdf/"); ?>' + selectedclass, '_blank');

    });
</script>