<style>
table.dataTable thead > tr > th
{
  padding: 7px 30px 7px 8px !important;
}
table.table-bordered tbody td
{
  padding: 7px 0px 7px 3px ! important;
}
.buttons-excel
{
  right: 62.2% !important;
}
button.dt-button.buttons-excel.buttons-html5
{
  top:0px!important;
}
#tableID_length
{
  display: inline;
  top: -30px;
  position: relative;
}
</style> 
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container">

      <!-- Page-Title -->
    <!--div class="row">
      <div class="col-sm-12">
      <<h4 class="pull-left page-title">Applications</h4>>
      </div>
    </div-->
    <?php if(session()->getFlashdata('msg') !=''){ ?>
      <?php echo session()->getFlashdata('msg'); ?>
    <?php } ?>

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-color panel-info">
          <div class="panel-heading">
            <h3 class="panel-title"><?=$page?></h3>
          </div>
          <div class="panel-body">

           <div class="col-md-12">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-6">
                <div class="filter-sub-menu-outer-box">
                 <?php 
                 $attr = array("name" => "filter", "id" => "filter");
                 echo form_open_multipart('', $attr); 
                 ?>
                 <div class="stop-noti-box">
                  <li class="dropdown hidden-xs filter-li">
                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-filter"></i>Filter <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </a>                    
                    <ul class="dropdown-menu dropdown-menu-lg filter_ul">
                      <li class="text-center notifi-title">Filter</li>
                      <li class="list-group">
                        <div class="col-sm-12 filter_category">             
                          <div class="form-group">
                            <div class="row top_maargin">
                              <div class="col-md-2">
                                <label>Forms :</label>
                              </div>
                              <div class="col-md-4">
                                <select class="form-control component" name="component_id">
                                  <option value="">Please Select Form</option>
                                  <?php
                                  foreach($form_list as $ft)
                                  {
                                    ?>
                                    <option value="<?php echo $ft['id'] ?>"><?php echo $ft['scheme_component_name'] ?></option>
                                    <?php
                                  }
                                  ?>
                                </select>
                              </div>

                            </div>

                          </div>  
                        </div>   
                      </li>
                    </ul>
                  </li>
                </div>
                <li class="cell_spacing_li">
                  <a href="#" data-target="#" title="Line Spacing" class="dropdown-toggle waves-effect waves-light spacing-btn-box filter-btn-box" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-arrows-v"></i><i class="fa fa-bars"></i> 
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



              <?php echo form_close();?>  
            </div>
          </div>


        </div>
      </div>


      <div class="row">    
                <!--div class='col-md-8'>
                    <button class='btn-success export_data'>Export Table Data To Excel File</button>
                  </div-->

                  <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: -53px;">
                    <div class='table-reponsive' style="overflow-x:auto;">
                      <span id='result'>
                      </span>
                    </div>
              <!--  <table class="table table-striped table-bordered datatable">
                  <thead>
                    <tr>
                      <th>S.NO</th>
                      <th>STUDENT NAME</th>
                      <th>Forms</th>
                      <th>Application Date</th>
                    </tr>
                  </thead>               
                  <tbody id='result'>                   
                    
                  
                  </tbody>
                </table>-->

              </div>
            </div>
          </div>
        </div>
      </div>      
    </div> <!-- End Row -->
  </div> <!-- container -->

</div> <!-- content -->
<style>
th, td {
 text-align: left;
}

</style>


<!-- Modal -->
<div class="modal fade" id="confirm_modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alert</h4>
      </div>
      <div class="modal-body">
        <p><b>Really ! you want to update Expected Completion Date with following details :</b></p>
        <p><b>Name :</b> <span id="student_name"></span></p>
        <p><b>Course :</b> <span id="course_detail"></span></p>
        <p><b>Semester :</b> <span id="sem_detail"></span></p>
        <p><b>Professor :</b> <span id="pro_detail"></span></p>
        <input type="hidden" class="form-control" id="transcript_id" name="transcript_id">
        <input type="hidden" class="form-control" id="app_id" name="app_id">
        <input type="hidden" class="form-control" id="app_code" name="app_code">
        <input type="hidden" class="form-control" id="student_id" name="student_id">
        <input type="hidden" class="form-control" id="exception_date" name="exception_date">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        <input type="button" class="btn btn-success save_date" value="Yes">
      </div>
    </div>

  </div>
</div>


<script>

  $(document).on('click','.verify_course',function(){
    var rel_id = $(this).attr('rel_id');
    var student_name = $(this).attr('rel_name');
    var professor = $(this).attr('rel_pro');
    var course = $(this).attr('rel_course');
    var rel_courseid = $(this).attr('rel_courseid');
    var sem = $(this).attr('rel_sem'); 
    var app_id = $(this).attr('rel_app_id');
    var app_code = $(this).attr('rel_app_code');
    var student_id = $(this).attr('rel_student');
    var exception_date = $(this).attr('rel_exception_date');
    
    $('#student_name').html(student_name);
    $('#course_detail').html(course+" ("+rel_courseid+") ");
    $('#pro_detail').html(professor);
    $('#sem_detail').html(sem);
    
    $('#transcript_id').val(rel_id);
    $('#app_id').val(app_id);
    $('#app_code').val(app_code);
    $('#student_id').val(student_id);
    $('#exception_date').val(exception_date);
    
    
    $('#confirm_modal').modal('show');
  })

  $(document).on('click','.save_date',function(){
    var transcript_id = $('#transcript_id').val();
    var student_id = $('#student_id').val();
    var app_code = $('#app_code').val();
    var app_id = $('#app_id').val();
    var exception_date = $('#exception_date').val();
    if(transcript_id == '' || student_id == '' || app_code =='' || app_id=='' || exception_date == '')
    {
      alert("Something Wrong ! please try again");
    }
    else
    {
     $.ajax({
      url: '<?= base_url('formbuilder/Application/update_exception_date') ?>',
      data: ({submit:'submit', transcript_id: transcript_id,student_id:student_id,app_code:app_code,app_id:app_id,exception_date:exception_date }),
           // dataType: 'json', 
           type: 'post',
           success: function(data) {
            if(data)
            {
              alert("Updated Successfully . . . ");
              $('.verify_td').html('');
              $('.verify_td').html('<button class="btn btn-success btn-xs">Already verify</button>');
              $('#confirm_modal').modal('hide');
            }
            else
            {
              alert("Something wrong . . . ");
            }


          }             
        });
   }

 })


  $(document).on('change','.component',function(){
   $('#result').html("<div class='col-md-12'>Loading.........................</div>");
   var id = $(this).val();
   var form_name = $('.component option:selected').text();
   $.ajax({
    url: '<?php echo base_url('formbuilder/Application/get_component_wise_data'); ?>',
    data: ({submit:'filter', id: id }),
        // dataType: 'json', 
        type: 'post',
        success: function(data) {

          $('#result').html(data);
          $('#tableID').DataTable( {
            aoColumnDefs : [{
                        //orderable : false, aTargets : [4]        
                      }],
                      "dom": '<"dt-buttons"Bf><"clear">lirtp',
                      "autoWidth": true,
                      "buttons": [{
                        text: '<i class="fa fa-file-excel-o"></i> Excel',
                        extend: 'excelHtml5',
                        messageTop: form_name,
                        filename: form_name+'_reports<?= date('Y_m_d') ?>',
                        title:'',
                        id:'classlistexl',
                        exportOptions: {
                          columns: ':visible'
                        }
                      }],
                      "order": [],
                      "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
                      "pageLength": -1
                    } );

          $('input[name="selected_field[]"]:not(:checked)').each(function () {
            var column_no = $(this).attr('rel_column_no');
            var table = $('.datatable_th').DataTable();
            var column = table.column(column_no);
                        // Toggle the visibility
                        column.visible(!column.visible());    
                      })  
            }             
          });
 })



  $(document).on('click','.export_data',function(){
    //alert('Hii');
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById('tableID');
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    var form_name = $('.component option:selected').text();

    var d = new Date();
    filename = form_name+d+'.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
      var blob = new Blob(['\ufeff', tableHTML], {
        type: dataType
      });
      navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
      }

    })

  </script>