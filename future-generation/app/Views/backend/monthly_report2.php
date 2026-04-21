<?php
$total_days_month=cal_days_in_month(CAL_GREGORIAN,$selected_month,$selected_year);
$newDateTime = '05'.'-'.$selected_month.'-'.$selected_year ;
$data['total_days_month'] = $total_days_month;
$data['newDateTime'] = $newDateTime;
?>
<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        width: auto;
    }
    .dataTables_info{
        display:none;
    }
    #classListing_filter{
        display:none;
    }
</style> 
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <h3 class="panel-title">Monthly Report  <span style="position: absolute;left: 46%;"> <?php echo $_SESSION['admin_fullname'];?></span> 
                                <a href="javascript:history.go(-1)" style="margin-top: -2px;" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>            
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 col-sm-12 col-xs-12"> 
                                 <div class="col-md-9 col-sm-9 col-xs-9">
                                    <?php 
                                        $attr = array("name" => "filter", "id" => "filter");
                                        echo form_open_multipart('admin/Reports/filter_monthlyReport2', $attr); 
                                        ?>
                                        <input type="hidden" class="form-control selected_month" name="month" value="<?= date('m') ?>">
                                        <input type="hidden" class="form-control selected_year" name="year" value="<?= date('Y') ?>">
                                        <div class="filter-sub-menu-outer-box">
                                            <li class="dropdown filter-li">
                                                <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light filter-btn-box datepicker_with_month" data-date="<?= date('m/Y',strtotime(isset($selected_start_date)??'')) ?>" data-date-format="mm/YYYY" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>Month <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                        </div>	
                                   </form>
                                </div>
                                
                                <div class="col-md-3">
                                    <span class="show_selected_date" style="position: absolute;margin-top: 8px; font-weight: bold;left: -125%;"> <?php  echo  date('M Y',strtotime($newDateTime)); ?></span>
                                    <button style="margin-top: -31px" onclick="fnExcelReport('attendance_report')" class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="classListing"><span><i class="fa fa-file-excel-o"></i> Excel</span></button>
                                    <form target="_blank" action="<?=base_url()?>admin/Reports/export_monthly_report_pdf" method="post">
                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                        <input type="hidden" class="selected_year" name="year" value="<?=$selected_year?>">
                                        <input type="hidden" class="selected_month" name="month" value="<?=$selected_month?>">
                                        <button type="submit" id="generatepdf" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right"><i class="fa fa-file-pdf-o"></i>
                                        <span><strong>PDF</strong></span></button>
                                    </form>
                                </div>
                                
                                <div class="col-md-12" >
                                    <div class="col-md-8">
                                        <?php 
                                        $attr = array("class" => "form-horizontal");
                                        echo form_open("admin/Reports/monthlyReport", $attr); 
                                        ?>
                                        <!--div class="col-md-2" >
                                            <select name="month" id="month" class="" required style="height: 34px;" >
                                                <option  value="">Select Month</option>
                                                <option  value='01'<?php if($selected_month == '01'){ echo "selected"; }?> >Janaury</option>
                                                <option value='02' <?php if($selected_month == '02'){ echo "selected"; }?>>February</option>
                                                <option value='03' <?php if($selected_month == '03'){ echo "selected"; }?> >March</option>
                                                <option value='04' <?php if($selected_month == '04'){ echo "selected"; }?> >April</option>
                                                <option value='05' <?php if($selected_month == '05'){  echo "selected"; }?> >May</option>
                                                <option value='06' <?php if($selected_month == '06'){ echo "selected"; }?> >June</option>
                                                <option value='07' <?php if($selected_month == '07'){ echo "selected"; }?>>July</option>
                                                <option value='08' <?php if($selected_month == '08'){ echo "selected"; }?> >August</option>
                                                <option value='09' <?php if($selected_month == '09'){ echo "selected"; }?> >September</option>
                                                <option value='10' <?php if($selected_month == '10'){ echo "selected"; }?> >October</option>
                                                <option value='11' <?php if($selected_month == '11'){ echo "selected"; }?> >November</option>
                                                <option value='12' <?php if($selected_month == '12'){ echo "selected"; }?> >December</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="year" class="" id="year" required data-placeholder="Choose a Country..." style="height: 34px;">
                                            <option  value="">Select Year...</option>
                                            <?php
                                            for($k=2018;$k<=date('Y');$k++){
                                                echo '<option value="'.$k.'"';if($selected_year == $k){echo "selected";}echo '>'.$k.'</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-success waves-effect waves-light m-b-5 m-l-5" onclick="return Date_Valid();">Filter</button>
                                        </div-->
                                        <?php echo form_close(); ?>
                                    </div>
                                    
                                </div>
                                <span id="result">
                                    <?php
                                        echo view('templates/filter/filter_monthly_report', $data);
                                    ?>
                                </span>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div> <!-- End Row -->  
        </div> <!-- container -->
     
    </div> <!-- content -->
</div> <!-- content-page -->
<script >
$(document).ready(function() {
    if ($('.attendance').is(':empty')){
        $('.attendance').innerHTML('0.00');
    };
});
</script>
<script>
function submitform(){
    $('#filter').submit();
}

$(document).on("click","#generatepdf",function(){

    //window.location.href = '<?php //echo  base_url("admin/PdfBuilder/classReportPdf/");?><?php //echo encryptor('encrypt',$selectedclass);?>';
    //window.open('<?php //  echo  base_url("admin/PdfBuilder/classReportPdf/");?><?php // echo encryptor('encrypt',$selectedclass);?>', '_blank');
    
});

</script>
<script>
function fnExcelReport(table_id)
{
   // alert(table_id);
    var tab_text = '<table border="1px" style="font-size:16px" ">';
    var textRange; 
    var j = 0;
    var tab = document.getElementById(table_id); // id of table
    var lines = tab.rows.length;
    //console.log(tab.rows);
    // the first headline of the table#0d4660 DFDFDF
    if (lines > 0) {
        tab_text = tab_text + '<tr>' + tab.rows[0].innerHTML + '</tr>'+'<tr>' + tab.rows[1].innerHTML + '</tr>';
    }

    // table data lines, loop starting from 1
    for (j = 2 ; j < lines; j++) {     
        tab_text = tab_text + "<tr>" + tab.rows[j].innerHTML + "</tr>";
    }

    tab_text = tab_text + "</table>";
    tab_text = tab_text.replace(/<a[^>]*>|<\/a>/g, "");             //remove if u want links in your table
    tab_text = tab_text.replace(/<img[^>]*>/gi,"");                 // remove if u want images in your table
    tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, "");    // reomves input params
    // console.log(tab_text); // aktivate so see the result (press F12 in browser)

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

     // if Internet Explorer
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa = txtArea1.document.execCommand("SaveAs", true, "DataTableExport.xls");
        return (sa);
    }  
    else 
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_html = encodeURIComponent(tab_text);//table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        var d = new Date();
         n = '<?php echo $selected_year.'_'.$selected_month ?>';
        //setting the file name
        a.download = 'Monthly Report_' + n + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        /*e.preventDefault();*/
        /**********************************************/
    
} 
</script>
<script >
    
    function Date_Valid(){
        var year= $('#year').val().length;
        var month= $('#month').val().length;
        //console.log(BeginN +'  END:'+EndN);
         if(year == 0 && month == 0  ){

            alert("Select month and year ");
             return false;
            } else { 
                    
                    return true;
            }
        }
        
        
    $(document).on('click','.month',function(){
        var month = $(this).html();
        var year = $('th.datepicker-switch').html();
        $('#result_month').html(month);
        var parts = year.split(" ");
        var d = Date.parse(parts[0] + "1,"+parts[1]);
        if(!isNaN(d))
        {
            $('#result_month').html("("+month+"-"+parts[1]+")");
            $('.show_selected_date').html(parts[0]+" "+parts[1]);
            var year  = new Date(d).getFullYear();
            var month = new Date(d).getMonth() + 1;
            $('.selected_month').val(month);
            $('.selected_year').val(year);
            filter_data_on_tab();
        }
        else
        {
            $('#result_month').html("");
        }
    })
    
    function filter_data_on_tab()
    {
        var content = '';
        content+='<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
        content+='</main>';
        $('#result').html(content);   
        var formname='';
        formname=$("#filter");
        var formData = new FormData($('#filter')[0]);
        formData.append("submit","filter");
        formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
        $.ajax({
            type:"POST",
            dataType:'html',
            url:'<?= base_url() ?>admin/Reports/filter_monthlyReport2',
            data: formData,
        	processData: false,
        	contentType: false,
            success: function(response){   
                $('#result').html(response);
            }
        });
    }
</script>