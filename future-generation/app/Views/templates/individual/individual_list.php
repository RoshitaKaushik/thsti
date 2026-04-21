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
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
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
#overlay > p{ 
color:#FF9800; 
position: absolute; 
top: 60%; 
left: 49%; 
margin: -28px 0 0 -25px;} 

}
.buttons-excel{
    display:none;
}
#SemesterListing_info{
    display: inline;
    top: -30px;
    position: relative;
}
#SemesterListing{
    top: -20px;
    position: relative;
}



</style>     
<div class="">
<!-- Start content -->
	<div class="">
		<div class="">
			<?php if(session()->get('msg') !=''){ ?>
			<div class="alert alert-success">
				<?php echo session()->get('msg'); ?>
			</div>
				<?php } ?>
				<!-- Page-Title -->
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Individual List
                                <!--a href="https://staging.apps.future.edu/admin/Form/addIndividual" target="_blank" class="btn-sm btn-success waves-effect waves-light m-b-5 m-l-5  pull-right" style="font-size: 12px;background: #fff;color: #000!important;border: 1px solid #d5d5d5;padding: 4px 12px;margin: 0;z-index:0">
                                    <i class="icon ion-plus-circled"></i>          
                                </a-->
							</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<table id="alldataTable2" class="table table-striped table-bordered alldatatable">
										<thead>
                                            <tr>
                                                <th>Contact ID</th>
                                                <th>Name</th>
                                                <th>label</th>
                                                <th>Active</th>
                                                <th>Linked With</th>
                                            </tr>
										</thead>
										<tbody>
                                            <?php
                                            $sn =1;
                                            foreach($individualList as $org){
                                                ?>
                                                <tr>
                                                    <td><?php echo $org['linked_id']; ?></td>
                                                    <td style="text-align:left;"><?php echo $org['linked_name']; ?></td>
                                                    <td style="text-align:left;"><?php echo $org['labeled_identify']; ?></td>
                                                    <td style="text-align:left;"><?php echo ($org['valid'] == '1')?'Yes':'No'; ?></td>
                                                    <td style="text-align:left;"><?php echo $org['linker_id']." - ".$org['linker_name']; ?></td>
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
    





<script>
$(document).on('click','.open_dividual_list',function(event){
        event.stopPropagation();
        $('.pop_tab').removeClass('active');
        $('.pop_tab').eq(0).addClass('active');
        let content = '';
	    content+='<main><div style="text-align:center"><h1 class="loader">Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1></div>';
        content+='</main>';
        $('#pop_result').html(content);
        $('.side_pop').toggleClass("active");
        let organization_id = $(this).attr('rel_id');
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>admin/Form/get_individual_html_by_id',
            data: {submit:'submit',organization_id:organization_id},
            dataType: "html",
            success: function(data){
              $('#pop_result').html(data);
            },
        });
    })
    
    
    $(document).on('click','.saveAllIndividualButton',function(e){
        $('.validate').removeClass('invalid');
        if (!validateForm()) return false;
        var formname='';
        formname=$("#organization_general_form");
        var formData = new FormData($('#organization_general_form')[0]);
        formData.append("submit","name");
        formData.append("callType","ajax");
        $.ajax({
            type:"POST",
            dataType:'html',
            url:formname.attr("action"),
            data: formData,
        	processData: false,
        	contentType: false,
            success: function(response){
               alert(response);
               $('.side_pop').removeClass("active");
            }
        });
    })
    
    $(document).on('click','#general_edit',function(){
        $('.saveAllIndividualButton').removeClass('hide1');
        $('#usphone_save').removeClass('hide1');
    })
    $(document).on('click','#general_view',function(){
        $('.saveAllIndividualButton').addClass('hide1');
        $('#usphone_save').addClass('hide1');
    })
    
</script>
