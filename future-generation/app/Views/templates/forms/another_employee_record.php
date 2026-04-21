<?php
$access = getAccess(11); // 11 for employment record.
$NameID = isset($studentid) ? $studentid : '';
$studentrec_js = json_encode(isset($employmentrecord));

//echo "<pre>";print_r($studentrec_js);
?>
<style>
	.tbl-body-employmentrecord tr td:first-child {
		width: 30%;
	}

	.tbl-body-employmentrecord tr td:nth-child(2) {
		width: 30%
	}

	.tbl-body-employmentrecord tr td:nth-child(3) {
		width: 15%
	}

	.tbl-body-employmentrecord tr td:nth-child(4) {
		width: 15%;
	}

	.tbl-body-employmentrecord tr td:last-child {
		width: 5%;
	}

	#error-message {
		color: red;
		text-align: right;
		font-size: 12px;
	}

	.btn {
		padding: 1px 3px;
	}
</style>
<div id="error-message"></div>
<div class="row">
	<table class="table table-striped table-bordered" width="100%" id="table_em">
		<thead>
			<tr>
				<th>Attachment Name<span style="color:red">*</span></th>
				<th>Attachment Type</th>
				<th>Upload Attachment<span style="color:red">*</span></th>
				<th>Added By<span style="color:red">*</span></th>
				<th>Added Date<span style="color:red">*</span></th>
				<th>Action </th>
			</tr>
		</thead>
		<tbody class="tbl-body-employmentrecord">
			<?php
			$ref_count = 0;

			$ref = getEmploymentInfos(isset($facultystaffid));
			?>
			<?php if ($access['add_access']) {
				$ref_countssss = $ref_count + 1;
				$attr = array('class' => 'cmxform form-horizontal tasi-form research', 'id' => 'empattachmentupload');
			?>
				<tr id="TextBoxDivEM<?php echo $ref_count + 1; ?>">
					<?php echo form_open_multipart('admin/form/submitsuteApplication', $attr); ?>
					<td>
						<!-- <input type="hidden" name="NameID_em" id="NameID_em" value="<?php if (isset($NameID)) {
																								echo $NameID;
																							} ?>"> -->
						<input type="hidden" name="NameID_em" id="NameID_em">
						<input type="hidden" name="id_em" id="id_em" value="">
						<input class="form-control " id="attachment_name_em" name="attachment_name_em" type="text" required>
					</td>
					<td>
						<select class="form-control form_document_id" name="document_type">
							<option value="">Select Document Type</option>
							<?php
							if (isset($documenttypes)) {
								foreach ($documenttypes as $doc_type) {
									echo '<option value="' . $doc_type['id'] . '">' . $doc_type['type'] . '</option>';
								}
							}

							?>
						</select>
					</td>
					<td>
						<span class="hide"></span>
						<input class="uploadfiles pdf" id="upload_attachment_em" name="upload_attachment_em" type="file" <?php //echo($required==1 ? 'required':'');
																															?>>
						<input type="hidden" name="docreq" value="1">
					</td>
					<td>
						<input class="form-control " id="added_by_em" value="<?php echo session()->get('admin_fullname'); ?>" name="added_by_em" type="text" readonly required>
					</td>
					<td>
						<input class="form-control datepicker" id="added_date_em" value="<?php $estTime = (new DateTime('America/New_York'))->format('d/m/Y h:i:s');
																							echo $estTime; ?>" name="added_date_em" type="text" readonly required>
					</td>
					<td style="vertical-align:middle">
						<?php if ($access['add_access']) { ?>
							<a href="javascript:void(0)" id="add-employmentrecord<?= $ref_count + 1 ?>" class="btn btn-success waves-effect waves-light btn-xs m-b-5 add-employment">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>

							</a>

							<a href="javascript:void(0)" id="save-employmentrecord<?= $ref_count + 1 ?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-employmentrecord hide pull-left save<?= $ref_count + 1; ?>" data-id="<?= isset($studentid) ?>" data-row="<?= $ref_count + 1 ?>">
								<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>

							</a>
						<?php } ?>

						<a href="javascript:void(0)" id="cancel-employmentrecord<?php echo $ref_count + 1 ?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-employmentrecord hide pull-left" data-row="<?php echo $ref_count + 1 ?>">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>

						</a>
					</td>
					</form>
				</tr>
			<?php 	}
			$count7 = $ref_count == 0 ? 1 : $ref_count;
			?>
			<?php
			if (!empty($ref)) {
				$ref_count = 0;
				echo '<input type= "hidden" id="count7" value="' . (count($ref) + 1) . '" >';
				foreach ($ref as $user) {

					//echo '<pre>'; print_r($user);
					$ref_count++;
			?>
					<tr id="TextBoxDivEM<?php echo $ref_count + 1; ?>">
						<td style="text-align:left;">
							<span class="show">
								<?php if (isset($user['attachment_name'])) {
									echo $user['attachment_name'];
								} ?>
							</span>

						</td>

						<td style="text-align:left;">
							<span class="show">
								<?php if (isset($user['type'])) {
									echo $user['type'];
								} ?>
							</span>

						</td>

						<td>
							<span class="show"><?php if (isset($user['attachment_path']) && !empty($user['attachment_path'])) { ?>
									<a href="<?= base_url($user['attachment_path']) ?>" target="_blank" class="btn btn-info btn-xs">View Document</a>
								<?php  } ?>
							</span>
						</td>

						<td>
							<span class="show"><?php if (isset($user['created_by'])) {
													$users = getLoggedInUserName($user['created_by']);
													echo $user_name = $users['admin_fullname'];
												} ?>
							</span>
						</td>
						<td>
							<span class="show">
								<?php if (isset($user['created_date'])) {
									echo date('m/d/Y H:i', strtotime($user['created_date']));
								} ?>
							</span>
						</td>
						<td style="width:12%;text-align:center; vertical-align:middle;">
							<?php //if($access['edit_access']) { 
							?>
							<!--<a href="javascript:void(0)" id="edit-studentrecord<?php //echo $ref_count+1;
																					?>" class="btn btn-purple waves-effect waves-light btn-xs m-b-5 edit-studentrecord " data-id="<?php //echo $user['student_id']
																																													?>" data-row="<?php //echo $ref_count+1
																																																							?>" style="text-align:center;">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				        
				</a>-->
							<?php /*}*/ if (session()->get('role') == 1) { ?>
								<a href="javascript:void(0);" title="Click To Delete" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 rmvetd" data-row="<?php echo $ref_count + 1 ?>" data-urlm="<?= encryptor('encrypt', $user['id']) ?>" data-urln="<?= encryptor('encrypt', $user['student_id']) ?>">
									<span class="fa fa-trash-o" aria-hidden="true"></span>
									<span><strong></strong></span>
								</a>

							<?php } ?>

							<!--<a href="javascript:void(0)"  id="save-studentrecord<?php //echo $ref_count+1;
																					?>" class="btn btn-info waves-effect waves-light btn-xs m-b-5 save-studentrecord hide pull-left save<? //=$ref_count;
																																														?>" data-id="<? //=$user['NameID']
																																																									?>"  data-row="<? //=$ref_count
																																																																?>">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				            
				</a>
				<a href="javascript:void(0)" id="cancel-studentrecord<?php //echo $ref_count+1;
																		?>" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 cancel-studentrecord hide pull-left" data-id="<?php //echo $user['student_id']
																																														?>" data-row="<?php //echo $ref_count+1
																																																								?>">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				          
				</a>-->
						</td>
					</tr>

			<?php }
			} ?>

		</tbody>
	</table>
	</table>
</div>
<!-- <button type="submit" class="btn btn-success center-block">Save</button> -->

<?php echo form_close(); ?>

<script>
	$(document).on('change', '.date-checks', function() {
		var current = $(this).val();
		if (current != '') {
			$(this).closest('tr').find('.date-checks').not(this).attr('disabled', true);
		} else {
			$(this).closest('tr').find('.date-checks').attr('disabled', false);
		}

	});

	$(document).on('click', '.edit-employmentrecord', function() {
		var row = $(this).attr('data-row');
		var selector = '#TextBoxDivEM' + row;

		$(selector + ' textarea, ' + selector + ' span.show, ' + selector + ' span.show, ' + selector + ' a.edit-employmentrecord').removeClass('show').addClass('hide');
		$('#contact_note' + row + ', ' + selector + ' input, ' + selector + ' select, ' + selector + ' a.save-employmentrecord, ' + selector + ' a.cancel-employmentrecord').removeClass('hide').addClass('show');
		$('#contact_note' + row).removeAttr('readonly', true);

	});

	$(document).on('click', '.cancel-employmentrecord', function() {
		var row = $(this).attr('data-row');
		var selector = '#TextBoxDivEM' + row;

		$(selector + ' input, ' + selector + ' select, ' + selector + ' a.save-employmentrecord, ' + selector + ' a.cancel-employmentrecord').removeClass('show').addClass('hide');
		$(selector + ' span.hide, ' + selector + ' span.hide, ' + selector + ' a.edit-employmentrecord').removeClass('hide').addClass('show');
		$('#contact_note' + row).attr('readonly', true);

	});
</script>

<script>
	function loading() {
		// add the overlay with loading image to the page 
		var over = '<div id="overlay">' +
			'<p>Please Wait...</p></div>';
		$(over).appendTo('body');
	}
</script>



<script type="text/javascript">
	$(document).on("click", ".add-employment", function() {
		var edit_user = '<?= session()->get('admin_fullname') ?>';
		//var NameID_em=$('#NameID_em').val();
		//var NameID_em = $('#facultyEmployeeID').val()
		var NameID_em = $('#facultyEmployeeID').val();

		//var id_em=$('#id_em'+id).val();

		//var id_em = $('#facultyEmployeeID').val();
		var attachment_name = $('#attachment_name_em').val();
		var upload_attachment = $('#upload_attachment_em').val();
		var documentType = $('.form_document_id :selected').text();
		if (documentType == 'Select Document Type') {
			documentType == '';
		}

		if (attachment_name != '' && upload_attachment != '' && documentType != '') {
			loading();
			var added_by = $('#added_by_em').val();
			var added_date = $('#added_date_em').val();
			var formData = new FormData($('#empattachmentupload')[0]);
			$.ajax({
				type: "POST",
				url: '<?php echo base_url('admin/Form/submitemploymentrecord'); ?>',
				data: formData,
				dataType: "html",
				processData: false,
				contentType: false,
				success: function(data) {
					$('#overlay').remove();
					data = JSON.parse(data);
					//alert(data);
					//console.log('msg'+data.msg);
					if (data.msg == 'INSERTED') {
						var tr = '';
						if (data.path != '') {
							alert('Record saved.');
							//$('#empattachmentupload')[0].reset();
							//$(':text:not("[readonly],[disabled]")').val('');
							$(':text:not("[readonly]")').val('');
							$('.form_document_id').val('');
							console.log(formData);
							tr += '<tr><td style="text-align:left;">' + attachment_name + '</td>';
							tr += '<td style="text-align:left;">' + documentType + '</td>';
							tr += '<td><a href="<?= base_url() ?>' + data.path + '" target="_blank" class="btn btn-info btn-xs">View Document</a></td>';
							tr += '<td>' + added_by + '</td>';
							tr += '<td>' + added_date + '</td>';
							var a = '<a href="javascript:void(0);" title="Click To Delete" class="btn btn-danger waves-effect waves-light btn-xs m-b-5 rmvetd" data-row="<?php echo $ref_count + 1 ?>" data-urlm="' + data.last_id + '" data-urln="' + data.NameID + '"><span class="fa fa-trash-o" aria-hidden="true"></span>  </a>';
							tr += '<td>' + a + '</td></tr>';
							$('#table_em tbody tr:first').after(tr);
						}
					} else {
						$('#error-message').html(data.msg);
					}
				},
			});
		} else {
			alert('Please fill all the mandatory fields.');
		}
	});
</script>
<script type="text/javascript">
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
</script>
<script type="text/javascript">
	$(document).on("click", ".rmvetd", function() {
		var anim = this.getAttribute("data-urlm");
		var anin = this.getAttribute("data-urln");
		var row = this.getAttribute("data-row");
		var current = $(this);

		//console.log(current);
		var csrfName = "<?= csrf_token() ?>";
		var csrfHash = "<?= csrf_hash() ?>";

		if (confirm('Are you sure, Want to Delet this record?')) {
			loading();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() ?>" + "admin/Form/delemploymentrecord",
				data: {
					clogid: anim,
					NameID: anin
				},
				success: function(res) {
					//alert(res); 
					//console.log(res); 
					$('#overlay').remove();
					if (res != 'OK' || res.length <= 0 || res == null) {
						alert('Something went wrong');
					} else {
						alert('Deleted Successfully');
						//$('#TextBoxDivCL'+row).remove();
						current.closest("tr").remove();
					}
				}
			});

		}
	});
</script>