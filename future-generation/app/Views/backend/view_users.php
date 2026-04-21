<?php //echo "<pre>";print_r($data);die; 
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
  }

  #datatable td {
    font-weight: normal;
    text-align: left ! important;
  }

  #datatable th {
    font-weight: normal;
    text-align: left ! important;
  }

  /*.btn-primary
{
    border:1px solid #fff !important;
}*/
  #datatable {
    position: relative;
    top: -32px;
  }

  #datatable_length,
  #datatable_filter {
    position: relative;
    top: -32px;
  }

  .filter_button {
    height: 32px ! important;
  }

  .btn-group {
    z-index: 998;
  }

  .filter_button {
    background-color: #fafafa;
    color: rgba(0, 0, 0, 0.6) ! important;
    font-size: 14px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    -webkit-box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
    -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
    border: 1px solid rgb(171, 167, 167);
    box-shadow: none;
  }

  .inactive_button {
    background: #f13753 !important;
    color: #fff ! important;
    /*opacity: 0.5 !important;*/
  }

  .active_button {
    background: #2bba35 !important;
    color: #fff ! important;
    /*opacity: 0.5 !important;*/
  }

  .all_button {
    /*opacity: 0.5 !important;*/
    background: #880e4f !important;
    color: #fff ! important;
  }

  .profile_dp {
    height: 40px;
    width: 40px;
    cursor: pointer;
    border-radius: 50%;

  }

  #datatable td {
    font-size: 14px;
    vertical-align: middle;
  }
</style>

<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container">
      <?php if (session()->getFlashdata('msg') && is_array(session()->getFlashdata('msg'))) {
        $msg = session()->getFlashdata('msg'); ?>
        <div class="uploadvesslelog alert <?php if ($msg['status']) {
                                            echo 'alert-success';
                                          } else {
                                            echo 'alert-danger';
                                          } ?>">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
          <?php print $msg['message']; ?>
        </div>
      <?php } ?>
      <?php session()->remove('msg'); ?>
      <!-- Page-Title -->


      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-info panel-color">
            <div class="panel-heading">
              <h3 class="panel-title">User List <a href="javascript:history.go(-1)" class="btn btn-success waves-effect waves-light m-b-5 m-l-5  pull-right">
                  <i class="ion-arrow-left-a"></i>
                  <span><strong>Go Back</strong></span>
                </a>

                <a href="<?= base_url('admin/Users/addUsers') ?>" class="btn btn-success waves-effect waves-light m-b-5 pull-right">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                  <span><strong>Add New User</strong></span>
                </a>
              </h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-7">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" rel_status="" class="btn filter_button">All</button>
                    <button type="button" rel_status="1" class="btn filter_button">Active</button>
                    <button type="button" rel_status="0" class="btn filter_button">Inactive</button>
                  </div>
                </div>
                <div class="col-md-3"></div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <span id="result">
                    <?= view('templates/filter/view_users_filter', ['results' => $results]) ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div> <!-- End Row -->
    </div> <!-- container -->
  </div> <!-- content -->

  <script>
    $(document).on('click', '.filter_button', function() {
      var status = $(this).attr('rel_status');

      $('.filter_button').removeClass('inactive_button active_button all_button');

      if (status === '0') {
        $(this).addClass('inactive_button');
      } else if (status === '1') {
        $(this).addClass('active_button');
      } else {
        $(this).addClass('all_button');
      }

      var content = '';
      content += '<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
      content += '</main>';
      $('#result').html(content);
      $.ajax({
        type: "POST",
        dataType: 'html',
        url: '<?= base_url('admin/Users/get_ajax_viewUsers') ?>',
        data: {
          status: status,
          '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        },
        success: function(response) {
          $('#result').html(response);
          $('#datatable').DataTable({
            "order": [],
            "lengthMenu": [
              [5, 10, 25, 50, -1],
              [5, 10, 25, 50, "All"]
            ],
            "pageLength": 25
          });
        }
      });
    })

    $(document).on('click', '.profile_dp', function() {
      var user_id = $(this).attr('rel_id');
      var user_name = $(this).attr('rel_name');
      var rel_src = $(this).attr('src');
      $('#profilePic').attr('src', rel_src);
      $('#myModalLabel').html(user_name);
      $('#admin_user_id').val(user_id);
      $('#image_update_modal').modal('show');
    })
  </script>
  <style>
    #image_update_modal .modal-dialog .modal-content .modal-header {
      padding-left: 6px ! important;
      padding-right: 10px ! important;
    }

    .profile-pic-wrapper {
      /*height: 100vh;*/
      width: 100%;
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .pic-holder {
      text-align: center;
      position: relative;
      border-radius: 50%;
      width: 150px;
      height: 150px;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px;
      border: 1px solid;
    }

    .pic-holder .pic {
      height: 100%;
      width: 100%;
      -o-object-fit: cover;
      object-fit: cover;
      -o-object-position: center;
      object-position: center;
    }

    .pic-holder .upload-file-block,
    .pic-holder .upload-loader {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background-color: rgba(90, 92, 105, 0.7);
      color: #f8f9fc;
      font-size: 12px;
      font-weight: 600;
      opacity: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
    }

    .pic-holder .upload-file-block {
      cursor: pointer;
    }

    .pic-holder:hover .upload-file-block,
    .uploadProfileInput:focus~.upload-file-block {
      opacity: 1;
    }

    .pic-holder.uploadInProgress .upload-file-block {
      display: none;
    }

    .pic-holder.uploadInProgress .upload-loader {
      opacity: 1;
    }

    /* Snackbar css */
    .snackbar {
      visibility: hidden;
      min-width: 250px;
      background-color: #333;
      color: #fff;
      text-align: center;
      border-radius: 2px;
      padding: 16px;
      position: fixed;
      z-index: 1;
      left: 50%;
      bottom: 30px;
      font-size: 14px;
      transform: translateX(-50%);
    }

    .snackbar.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
      from {
        bottom: 0;
        opacity: 0;
      }

      to {
        bottom: 30px;
        opacity: 1;
      }
    }

    @keyframes fadein {
      from {
        bottom: 0;
        opacity: 0;
      }

      to {
        bottom: 30px;
        opacity: 1;
      }
    }

    @-webkit-keyframes fadeout {
      from {
        bottom: 30px;
        opacity: 1;
      }

      to {
        bottom: 0;
        opacity: 0;
      }
    }

    @keyframes fadeout {
      from {
        bottom: 30px;
        opacity: 1;
      }

      to {
        bottom: 0;
        opacity: 0;
      }
    }
  </style>
  <div id="image_update_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="padding:0px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="modal-title">Update Profile Image</h5>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">
              <form method="post" action="" enctype="multipart/form-data" id="upload_image">
                <div class="profile-pic-wrapper">
                  <div class="pic-holder">
                    <!-- uploaded pic shown here -->
                    <img id="profilePic" class="pic" src="<?= base_url('docs/profile/no_dp.jpg'); ?>">

                    <Input class="uploadProfileInput" type="file" name="doc[profile_image]" id="newProfilePhoto" accept="image/*" style="opacity: 0;" />
                    <input type="hidden" name="docreq[profile_image][1]" value="2">
                    <input type="hidden" name="docreq[profile_image][2]" value="img">
                    <label for="newProfilePhoto" class="upload-file-block">
                      <div class="text-center">
                        <div class="mb-2">
                          <i class="fa fa-camera fa-2x"></i>
                        </div>
                        <div class="text-uppercase">
                          Update <br /> Profile Photo
                        </div>
                      </div>
                    </label>
                    <input type="hidden" name="update" id="admin_user_id">
                  </div>

                  </hr>
                  <p class="text-info text-center small" id="myModalLabel"></p>
                </div>
              </form>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).on("change", ".uploadProfileInput", function() {
      var triggerInput = this;
      var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");

      var holder = $(this).closest(".pic-holder");
      var wrapper = $(this).closest(".profile-pic-wrapper");
      $(wrapper).find('[role="alert"]').remove();
      triggerInput.blur();
      var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) {
        return;
      }
      if (/^image/.test(files[0].type)) {
        // only image file
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file

        reader.onloadend = function() {
          $(holder).addClass("uploadInProgress");
          $(holder).find(".pic").attr("src", this.result);
          var upload_img = this.result;
          $(holder).append(
            '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
          );

          // Dummy timeout; call API or AJAX below
          setTimeout(() => {
            $(holder).removeClass("uploadInProgress");
            $(holder).find(".upload-loader").remove();
            // If upload successful
            if (Math.random() < 0.9) {
              var formname = '';
              formname = $("#filter");
              var formData = new FormData($('#upload_image')[0]);
              formData.append("submit", "upload_file");
              formData.append("<?= csrf_token() ?>': '<?= csrf_hash() ?>");
              $.ajax({
                type: "POST",
                dataType: 'html',
                url: '<?= base_url() ?>admin/Users/upload_user_profile',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                  var u_id = $('#admin_user_id').val();
                  $('#profile_pic_id' + u_id).attr('src', upload_img);
                  $(wrapper).append(
                    '<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> ' + response + '</div>'
                  );
                }
              });



              // Clear input after upload
              $(triggerInput).val("");

              setTimeout(() => {
                $(wrapper).find('[role="alert"]').remove();
              }, 3000);
            } else {
              $(holder).find(".pic").attr("src", currentImg);
              $(wrapper).append(
                '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
              );

              // Clear input after upload
              $(triggerInput).val("");
              setTimeout(() => {
                $(wrapper).find('[role="alert"]').remove();
              }, 3000);
            }
          }, 1500);
        };
      } else {
        $(wrapper).append(
          '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose the valid image.</div>'
        );
        setTimeout(() => {
          $(wrapper).find('role="alert"').remove();
        }, 3000);
      }
    });
  </script>