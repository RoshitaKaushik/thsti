<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    width: auto;
}
.dataTables_info{
    display:none;
}
.top_maargin
{
    margin-top:10px;
}
#classListing_filter{
    display:none;
}
.buttons-excel
{
    top: -51px ! important;
    right:100px! important;
}

.help {
    float: left;
   /* margin:10px;*/
   margin:2px;
}
.help a {
    /*padding: 10px 20px;*/
    padding: 4px 8px;
    color: #F0F0F0;
    background-color: #3377DD;
}
.help a:hover {
    cursor: pointer;
}
.pop {
    display: none;
}

/* Filter Pop */
.help1 {
    float: left;
    margin: 2px 10px 2px 2px;
}
a.filter-btn-box {
    padding: 8px 10px;
    color: #5c5c5c;
    background-color: #ffffff;
    font-size: 14px;
    cursor: pointer;
    display: block;
    border-radius: 5px;
    border: 1px solid #e9e6e6;

}

a.filter-btn-box i.fa.fa-angle-down {
    border-left: 1px solid #aeadad;
    margin: 0 0 0 2px;
    padding: 0 0 0 5px;
    font-size: 14px;
    color: #a6a4a4;
}
a.filter-btn-box:hover {
    background-color: #d1f1fa;
}
.pop1 {
    display: none;
}


/* Show/Hide Pop */
.help2 {
    float: left;
   /* margin:10px;*/
   margin:2px;
}

.pop2 {
    display: none;
    width:16.5% !important;
}

.popOut {
    float: left;
    /*width: 250px;*/   
    margin-top: 5px;
    padding: 5px;
    background-color: #F9F9F9;
    border: 1px solid #DDD;
    display: block;
    position: absolute;
    z-index:999;
     /*left: 0;
    right: 0;
    margin: 0 auto;*/
}
.popOut p {
    color: #242424;
}
.close a {
    float: right;
    padding: 3px 5px 2px 5px;
    font-size: 10px;
    color: #F0F0F0;
    background-color: #A10000;
    border-radius: 50%;
    border: 1px solid #BBB;
}


.popOut .close {

position: absolute;
 right: 0;
 margin-top: -17px;
    margin-right: -15px;
 }
.popOut {
 width: 60%;
 border: 6px solid #f9f9f9;
 border-right: 3px solid #f9f9f9;
 border-left: 3px solid #f9f9f9;
 box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%) ;
 -webkit-box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%);
 margin-top:15px;
 }
 
 .close.close_pop_out a {
    background-color: #5a5a5a!important;
    color: #ffffff!important;
    border: 1px solid #fff;
    font-size: 14px!important;
    padding: 5px;
    height: 30px;
    width: 30px;
    line-height: 18px;
    text-align: center;
}

/*.buttons-excel
{
    margin-top: 85px;
}*/


ul.list_field::-webkit-scrollbar {
  width: 6px;
}


ul.list_field::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 

ul.list_field::-webkit-scrollbar-thumb {
  background: #888; 
}


ul.list_field::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
ul.list_field {
    margin: 0;
    padding: 0;
    list-style: none;
    max-height: 289px;
    overflow-x: auto;
    min-width: 150px;
}
ul.list_field li {
    background: #fff;
    padding: 3px 7px;
    border-bottom: 1px solid #f1eeee;
    font-size: 12px;
    cursor: pointer;
}





.panel-info>.panel-heading {
    background-color: #ffffff;
    border-bottom: 1px solid #d6d6d6!important;
}
.panel-color .panel-title {
    color: #000000;
}
h3.panel-title .btn-success {
    font-size: 12px;
    background: #fff;
    color: #000!important;
    border: 1px solid #d5d5d5;
    padding: 4px 12px;
    margin: 0;
}



.custom_hr
{
    margin-top: 0px !important;
    margin-bottom: 10px !important;
}

.hide_li
{
    margin-left: 9px;
}
.custum_buttom
{
    margin-top:0px!important;
}
.datatable_th
{
    width:100% !important;
}

@media (max-width: 767px) {
    
   .panel-title { font-size: 12px;} 
    h3.panel-title .btn-success {font-size: 10px;}
    .filter-sub-menu-outer-box {
    
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
}
.filter-sub-menu-outer-box li {
    margin: 2px;
}
.cell_spacing_li, .sort_li, .hide_li {
    font-size: 14px;
    cursor: pointer;
    display: block;
    border-radius: 5px;
    border: none;
    display: inherit;
    top: -14px;
    position: inherit;
}

    
}

span.tab {
    border: 1px solid #ccc;
    padding: 9px;
    color: #5c5c5c;
    border-radius: 2px;
    top: -13px;
    position: relative;
    cursor: pointer;
    z-index:99;
}
span.active
{
    background:#d1f1fa;
}
.custum_buttom {
    z-index: 99;
    position: absolute;
    right: 0;
    top: 2px;
}

#employee_time_report_percentage_filter,#employee_time_report_filter
{
    display: inline;
    position: relative;
    float: right;
    right: 85px;
   top: -12px;
}
.part_percentage,.part_one
{
    position: relative;
        top: 10px;
}
#filter
{
    margin-left: 17px;
}
.panel-heading.tab_panel-heading {
    z-index: 99;
    position: absolute;
    margin: 0 auto;
    left: 47%;
}

.tab_panel-heading
{
    width: 20%;
    margin: 0px auto;
    background:#e6e6e6 ! important;
}
.outter_div
{
        top: -53px ! important;
}
.outter_div .with-nav-tabs
{
    min-height: 250px;
}
h1.loader
{
    position: relative;
    top: 122px;  
}
.tab_btn_gourp
{
    left: 10px;
    top: -15px;
    z-index: 99;
}
.view_type_button
{
    background-color: #fafafa;
    color: rgba(0,0,0,0.6) ! important;
    font-size: 14px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    -webkit-box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
    -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
    box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
    border: 1px solid rgb(171, 167, 167);
    box-shadow: none;
}
button.btn.view_type_button.active
{
    background:#d1f1fa !important;
}
.panel-body
{
    min-height: 300px;
    margin-bottom: 0px !important;
}

.content-page > .content
{
    padding: 20px 5px 0px 5px ! important;
}

.text-rotate_delete
{
    filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
         -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
     -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
      -ms-transform: rotate(-90.0deg);  /* IE9+ */
       -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
  -webkit-transform: rotate(-90.0deg);  /* Safari 3.1+, Chrome */
          transform: rotate(-90.0deg);  /* Standard */
          height: 101px;
    line-height: 14px;
    vertical-align: middle;
    display: flex;
    justify-content: center;
    align-items: center;
        width: 25px;
}

</style> 
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
    		<!-- Page-Title -->
    		<!--div class="row">
    			<div class="col-sm-12">
    				<h4 class="pull-left page-title">Class Listing Reports By Certificates</h4>
    			</div>
    		</div-->
    		<div class="row">
    			<div class="col-md-12">
    				<div class="panel panel-info panel-color">
    					<div class="panel-heading">
    						<h3 class="panel-title">Time Report - Part One  <span id="result_month">(<?= date('M-Y',strtotime($selected_start_date)) ?>)</span>
        						 <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
            						<i class="ion-arrow-left-a"></i>
            						<span><strong>Go Back</strong></span>            
            					</a>
    						</h3>
    					</div>
    					<div class="panel-body">
							<div class="row">
							    <div class="col-md-9 col-sm-9 col-xs-9">
							       <?php 
                                    $attr = array("name" => "filter", "id" => "filter");
                                    echo form_open_multipart('admin/Reports/timeReports', $attr); 
                                    ?>
                                        <input type="hidden" class="form-control selected_start_date" name="start_date" value="<?= date('m/d/y',strtotime($selected_start_date)) ?>">
		                                <input type="hidden" class="form-control selected_end_date" name="end_date" value="<?= date('m/d/y',strtotime($selected_end_date)) ?>">
    							        <div class="filter-sub-menu-outer-box">
    									   <li class="dropdown filter-li">
                                                <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light filter-btn-box datepicker_with_month" data-date="<?= date('m/Y',strtotime($selected_start_date)) ?>" data-date-format="mm/YYYY" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>Month <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                </a>
                                            </li> 
                                            
                                            
                                             <!--li class="cell_spacing_li">
                                                 
                                                <a href="#" data-target="#" title="Line Spacing" class="dropdown-toggle waves-effect waves-light spacing-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                                                  
                                                <i class="fa fa-arrows-v"></i><i class="fa fa-bars"></i> </i>
                                                </a>
                                                
                                                <ul class="dropdown-menu dropdown-menu-md spacing_ul">
                                                    <li class="list-group" style="margin-bottom:0px !important;">
                                                     
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
                                                
                                            </li-->
                                            
                                            
                                            <div class="btn-group tab_btn_gourp" role="group" aria-label="Basic example">
                                               
                                                <button type="button" rel_status="1"  data-index="1" class="btn view_type_button active">Hour View</button>
                                                <button type="button" rel_status="0" data-index="2" class="btn view_type_button">Percentage View</button>
                                            </div>
                                            
    								    </div>	
								    <?php echo form_close();?>
								    
							    </div>
							    <div class="col-md-3 col-sm-3 col-xs-3">
							        <div class="col-md-12">	
										<form method="post" action="<?= base_url() ?>admin/Reports/export_excel_time_reports" target="_blank">
										    <input type="hidden" name="start_date" class="selected_start_date" value="<?= $selected_start_date ?>">
										    <input type="hidden" name="end_date" class="selected_end_date" value="<?= $selected_end_date ?>">
										    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
										    <button type="submit" class="btn btn-primart pull-right custum_buttom">
										        <i class="fa fa-file-excel-o"></i>
											     <span><strong>Excel</strong></span>
										    </button>
										</form>
										<!--<button type="button" id="generatepdf" class="btn btn-purple waves-effect waves-light m-b-5 m-l-5  pull-right"><i class="fa fa-file-pdf-o"></i>
											<span><strong>PDF</strong></span></button>-->
									</div>
							    </div>	
                      	    </div>
                      	    
                      	    <div class="row outter_div">
                      	        <div class="col-md-12">
                                	<span id="result">
                                		<?php echo view('templates/filter/filter_timeReports',$data) ?>
                                	</span>
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

$(document).ready(function(){
   var screen_height = window.innerHeight-280
    $('#employee_time_report').DataTable({
        // "order": [[ 0, "ASC" ]],\        
        /*responsive: true,
        paging:false,
        "ordering": false, 	  
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: true,
        
        fixedColumns:   {
            leftColumns: 1
        },*/
        
            responsive: true,
            paging:false,
            "ordering": false, 	  
            scrollY:        screen_height,
            scrollX:        true,
            scrollCollapse: true,
            fixedColumns:   {
                leftColumns: 1
            },
        
        });
        
        
        
        
        
    $('#employee_time_report_percentage').DataTable({
            responsive: true,
            paging:false,
            "ordering": false, 	  
            scrollY:        screen_height,
            scrollX:        true,
            scrollCollapse: true,
            fixedColumns:   {
                leftColumns: 1
            },
    });    
        
})


$(document).on('change','.filter_ajax',function(){
    var tab_no = $('.nav-tabs li.active').attr('active_tab_no');
   
    var filter_val = $(this).val();
    if(filter_val != '')
    {
        filter_val = filter_val.split ('/');
        var month = filter_val[0]+'/';
        
        var year  = filter_val[1];
        var start = "01/";
        var end  = "31/";
        var start_date = month+""+start+""+year;
        var end_date = month+""+end+""+year;
        $('.selected_start_date').val(start_date);
        $('.selected_end_date').val(end_date);
        filter_data_on_tab(tab_no);
    }
    
    
    /*$('.selected_'+filter_key).val(filter_val);*/
    
    
})





$(document).on('click','li.tab',function(){
    $('.tab').removeClass('active');
    $(this).addClass('active');
    var part = $(this).attr('data-part');
    if(part == 'part_one')
    {
        filter_data_on_tab(1);    
    }
    else
    {
        filter_data_on_tab(2);
    }
})


$(document).on('click','#btn-fullscreen',function(){
     var content = '';
    content+='<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
    content+='</main>';
    $('#result').html(content);  
     var tab_no = $('button.btn.view_type_button.active').attr('data-index');
    setTimeout(() => {
        filter_data_on_tab(tab_no);   
      }, 2000);
      
})

function filter_data_on_tab(tab_no)
{
    
    var screen_size = window.screen.height-400;
    //alert(window.innerHeight);
    //alert(window.innerHeight-200);
    var screen_height = window.innerHeight-280
    var content = '';
    content+='<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
    content+='</main>';
    $('#result').html(content);   
    var formname='';
    formname=$("#filter");
    var formData = new FormData($('#filter')[0]);
    formData.append("submit","filter");
    formData.append("tab_no",tab_no);
    formData.append("<?= csrf_token(); ?>","<?= csrf_hash(); ?>");
    $.ajax({
        type:"POST",
        dataType:'html',
        url:'<?= base_url() ?>admin/Reports/filter_timeReports',
        data: formData,
    	processData: false,
    	contentType: false,
        success: function(response){   
            $('#result').html(response);
            $('#employee_time_report').DataTable({
                // "order": [[ 0, "ASC" ]],\        
                responsive: true,
                paging:false,
                "ordering": false, 	  
                scrollY:        screen_height,
                scrollX:        true,
                scrollCollapse: true,
                fixedColumns:   {
                    leftColumns: 1
                },
            });
                
            $('#employee_time_report_percentage').DataTable({
                // "order": [[ 0, "ASC" ]],\        
                responsive: true,
                paging:false,
                "ordering": false, 	  
                scrollY:        screen_height,
                scrollX:        true,
                scrollCollapse: true,
                fixedColumns:   {
                    leftColumns: 1
                },
            });   
            
        }
    });
}

var lastday = function(y,m){
    return  new Date(y, m +1, 0).getDate();
}

$(document).on('click','.month',function(){
    var month = $(this).html();
    var year = $('th.datepicker-switch').html();
    $('#result_month').html(month);
    var parts = year.split(" ")
    var d = Date.parse(parts[0] + "1,"+parts[1]);
    if(!isNaN(d))
    {
        $('#result_month').html("("+month+"-"+parts[1]+")");
        var tab_no = $('button.btn.view_type_button.active').attr('data-index');
        var year  = new Date(d).getFullYear();
        var month = new Date(d).getMonth() + 1
        var start = "01/";
        var end  = lastday(year,month-1);
        var start_date = month+"/"+start+""+year;
        var end_date = month+"/"+end+"/"+year; 
        //console.log(start_date+"  "+end_date);
        $('.selected_start_date').val(start_date);
        $('.selected_end_date').val(end_date);
        filter_data_on_tab(tab_no);
    }
    // console.log();
    else
    {
         $('#result_month').html("");
    }
    $('.datepicker').hide();
})

$(document).on('click','.view_type_button',function(){
    $('.view_type_button').removeClass('active');
    $(this).addClass('active');  
    var part = $(this).attr('data-index');
    filter_data_on_tab(part);    
})

$(document).on('click','#btn-fullscreen',function(){
    console.log(screen.height);
})

</script>