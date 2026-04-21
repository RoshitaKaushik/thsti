<?php
$finane=getfinancialyear_june(date("d-m-Y"));
$finanyre=explode("-",$finane);
$first_datee = $finanyre[0];
$last_datee =$finanyre[1];
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
.col1{
    width:12% ! important;
}
.col2{
    width:64% ! important;
}

.waiting_response{ 
    pointer-events: none ! important;
}
.waiting_curser{
    cursor: not-allowed ! important;
}
.custum_buttom{
    display:inline;
    margin-top: -26px !important;
    margin-left:5px ! important;
}
</style> 
<!-- coded by bajrang -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-color">
                        <div class="panel-heading">
                            <?php
                            //GetDate = strtotime($_SESSION['admin_login_date_time']);
                            //$getDate = date(M Y,$GetDate );
                            ?>
                            <h3 class="panel-title">Monthly Journal Report  <span style="position: absolute;left: 22%;"> <?php echo $_SESSION['admin_fullname'];?> &nbsp; Start Date :<span id="selected_BeginDate"><?php if($begin_date != ''){ echo date('m/d/y',strtotime($begin_date)); }else{ echo "-"; }?></span> &nbsp; End Date : <span id="selected_EndDate"><?php if($end_date != ''){ echo date('m/d/y',strtotime($end_date)); }else{ echo "-"; }?></span>&nbsp; category : <span class="cat_name">-</span> </span> 
                                <!--<button style="margin-top: -29px; right: 144px;padding: 3.7px 16px !important;" onclick="fnExcelReport('attendance_report')" class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="classListing"><span><i class="fa fa-file-excel-o"></i> Excel</span>
                                </button>-->
                                 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                                    <i class="ion-arrow-left-a"></i>
                                    <span><strong>Go Back</strong></span>            
                                </a>
                            </h3>
                        </div>
                        
                        
                        <div class="panel-body">
                            <div class="col-md-12">
                                    <!-- Button Filter -->
                                <div class="col-md-2"></div>
                                <div class="col-md-7">
                                    <div class="filter-sub-menu-outer-box">
                                        <?php 
                                        $attr = array("name" => "filter", "id" => "filter", "style"=>"display:inline;");
                                        echo form_open_multipart('admin/Reports/', $attr); 
                                        ?>	
                                        <li class="dropdown hidden-xs filter-li">
                                            <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-filter"></i>Filter <i class="fa fa-angle-down" aria-hidden="true"></i>
                                            </a>
                                            
                                            <ul class="dropdown-menu dropdown-menu-lg filter_ul">
                                                <li class="text-center notifi-title">Filter</li>
                                                <li class="list-group">
                                                   <!-- list item-->
                                                    <div class="col-sm-12 filter_category"> 
                                                       <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">From :</label>
                                                                    <input class="form-control datepickerbackward filter_ajax required  requiredfile2 requiredfield" id="BeginDateforms" placeholder="Begin Date" name="BeginDate" type="text" value="<?php if(isset($begin_date)){ echo $begin_date; }?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">								
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">To : <!--<span class="requiresval">*</span>--></label>
                                                                    <input  class="form-control datepickerbackward filter_ajax required requiredfile2 requiredfield" id="EndDateforms" placeholder="End Date" name="EndDate" type="text" value="<?php if(isset($end_date)){ echo $end_date; }?>">
                                                                </div>
                                                            </div>
                                                       </div>
                                                       
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="" class="control-label">Category : </label>
                                                                <select class="form-control myselect filter_ajax" name="category_id" id="CategoryIDforms">
                                                                    <option value="">--Please Select --</option>
                                                                    <?php
                                                                    foreach($categorys as $cat){
                                                                        $sec = "";
                                                                        if($cat['id'] == $selected_cat){
                                                                            $sec = "selected";
                                                                        }
                                                                        ?>
                                                                        <option <?= $sec ?> value="<?= $cat['id'] ?>"><?= $cat['catagory_name'] ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                    </div> 
                                                    
                                                        <div class="col-md-12 text-right">
                                                            <hr>
                                                            <span class="btn btn-success btn-xs filter_data" style="margin-bottom: 10px;">Filter</span>
                                                            
                                                        </div>
                                                    
                                                </li>
                                            </ul>
                                        </li>
                                        <?php echo form_close();?>
                                        
                                        <li class="cell_spacing_li">
                                            <a href="#" data-target="#" title="Line Spacing" class="dropdown-toggle waves-effect waves-light spacing-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                <!--i class="fa fa-ellipsis-h" aria-hidden="true"></i-->
                                            <i class="fa fa-arrows-v"></i><i class="fa fa-bars"></i> <!--<i class="fa fa-angle-down" aria-hidden="true">--></i>
                                            </a>
                                            
                                            <ul class="dropdown-menu dropdown-menu-md spacing_ul">
                                                <li class="list-group" style="margin-bottom:0px !important;">
                                                   <!-- list item-->
                                                    <span > 
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
                                              <i class="fa fa-eye-slash"></i> Hide  <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                
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
                                        
                                         <form action="<?= base_url() ?>admin/Reports/export_excel_monthlyJournalReport" method="post" style="display:inline">
                                            <input type="hidden" class="selected_BeginDate" name="BeginDate" value="<?= $begin_date ?>">
                                            <input type="hidden" class="selected_EndDate" name="EndDate" value="<?= $end_date ?>">
                                            <input type="hidden" class="selected_category_id" name="category_id" value="<?= $selected_cat ?>">
                                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                            <input type="submit" value="Export Excel" class="btn btn-primary btn-xs custum_buttom">
                                        </form>
                                        
                                        <form target="_blank" action="<?= base_url() ?>admin/Reports/export_pdf_mothlyjournalreport" method="post" style="display:inline">
                                            <input type="hidden" class="selected_BeginDate" name="BeginDate" value="<?= $begin_date ?>">
                                            <input type="hidden" class="selected_EndDate" name="EndDate" value="<?= $end_date ?>">
                                            <input type="hidden" class="selected_category_id" name="category_id" value="<?= $selected_cat ?>">
                                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                            
                                            <input type="submit" value="Export PDF" class="btn btn-primary btn-xs custum_buttom">
                                        </form>
                                        
                    			    </div>
                    	          </div>
                    		    <div class="col-md-3"></div>
                    	    </div>
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-1" style="float:right;">
                                    </div>
                                </div>
                            </div>
                    	
                            <div class="col-md-12 table-responsive" id="result">
                                <?php echo view('templates/filter/filter_monthlyJournalReport',$data) ?>
                        	</div>
                                
                        </div>
                    </div>
                </div>
                
            </div> <!-- End Row -->           
        </div> <!-- container -->
     
    </div> <!-- content -->
</div> <!-- content-page -->
<!-- end coded by bajrang -->


<!-- Modal -->
<div id="xsmyModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Journal Entry</h4>
      </div>
      <div class="modal-body" style="height:300px;overflow-x:scroll;">
        <span id="result">
            
        </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>


</div>
</div>
<?php
 if($selected_cat != '')
 {
     ?>
      <script>
          $(document).ready(function(){
              var data =   $( ".myselect option:selected" ).text();
              $('.cat_name').html(data);
            })

      </script>
     <?php
 }
?>
<script>


 $(document).on('click','.view_journal',function(){
     var rel_id = $(this).attr('rel_id');
     var rel_name = $(this).attr('rel_name');
     var rel_hour = $(this).attr('rel_hour');
     $.ajax({
        type:"post",
        dataType:"html",
        url: "<?php echo base_url(); ?>admin/Reports/get_journal_in_montly_report",
        data:{ cat_id:rel_id,rel_name:rel_name,rel_hour:rel_hour,emp_id:"<?= $emp_id ?>",begin_date:"<?= $begin_date ?>",end_date:"<?= $end_date ?>","<?= csrf_token() ?>" : "<?= csrf_hash() ?>"},
        success:function(response){
            $('#result').html(response);
        }
    }); 
    $('#xsmyModal').modal('show');
 })
</script>
<script >
	
    function Date_Valid(){	
        var BeginN= $('#BeginDateforms').val().length;
        var EndN= $('#EndDateforms').val().length;
        //console.log(BeginN +'  END:'+EndN);
        if(BeginN == 0 && EndN == 0  ){
            alert("From and To dates are required field");
            return false;
        } else { 
            var BeginDate = new Date($('#BeginDateforms').val());
            var EndDate = new Date($('#EndDateforms').val()); 
            if(Date.parse(EndDate) < Date.parse(BeginDate)){
                //start is less than End
                alert("To Date can not be smaller than From Date");
                return false;
            }else{
                //end is less than start
                return true;
            }
        }
    }
</script>
<script>
function fnExcelReport(table_id)
{
   // alert(table_id);
    var tab_text = '<table border="1px" style="font-size:13px; font-family:Arial" ">';
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
    }  
    else 
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_html = encodeURIComponent(tab_text);//table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        var today = new Date();
		var dd = String(today.getDate()).padStart(2, '0');
		var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
		var yyyy = today.getFullYear();
		/*today = mm + '/' + dd + '/' + yyyy;*/
		today = yyyy + '/' + mm + '/' + dd;
		/*var next_year = <?=$last_datee?>*/
        //setting the file name
        a.download = 'Administrative_Time_Report_' + today  + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
        /**********************************************/
    return (sa);
} 


$(document).on('change','.filter_ajax',function(){
    var name = $(this).attr('name');
    var val = $(this).val();
    $('.selected_'+name).val(val);
})


$(document).on('click','.filter_data',function(){
    var begin_date = $("#BeginDateforms").val();
    var end_date = $("#EndDateforms").val();
    var category_name = $("#CategoryIDforms option:selected").text();
    if(category_name == '--Please Select --'){
        $('.cat_name').text('-');
    }else{
        $('.cat_name').text(category_name);
    }
    $('#selected_BeginDate').text(begin_date);
    $('#selected_EndDate').text(end_date);
    filter_progress_loader();
})

function form_submit_data(){
    var formname='';
    formname=$("#filter");
    var formData = new FormData($('#filter')[0]);
    formData.append("submit","filter");
    formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
    $.ajax({
        type:"POST",
        dataType:'html',
        url:'<?= base_url() ?>admin/Reports/filter_monthlyJournalReport',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
            
            $('#result').html(response);
            $('#alldataTable2').DataTable( {
                "order": [],
                "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
                "pageLength": -1
            });
            listing_table_field();
        }
    });
    
}


$(document).on('click','.day',function(e){
    e.stopPropagation();  
})

</script>
