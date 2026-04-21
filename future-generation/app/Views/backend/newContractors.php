<style>
    .back_button
    {
        font-size: 12px;
        background: #fff;
        color: #000!important;
        border: 1px solid #d5d5d5;
        padding: 4px 12px;
        margin: 0;
    }
    .tab_btn_gourp
    {
        left: 30px;
        
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
</style>
<div class="content-page">
<!-- Start content -->
    <div class="content">
        <div class="container" style="height:100vh">
            <?php if(session()->getFlashdata('msg') !=''){ ?>
            <div class="alert alert-danger">
                <?php echo session()->getFlashdata('msg'); 
                session()->remove('msg');
                ?>
            </div>
            <?php } ?>
            <!-- Page-Title -->
            
           
            
            <div class="col-md-12">
                 <div class="row panel">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="display:inline;">Attendance</h3>
                            
                            <div class="btn-group tab_btn_gourp" role="group" aria-label="Basic example">               
                                <button type="button" data-index="All" class="btn view_type_button active">All</button>
                                <button type="button" data-index="Active" class="btn view_type_button">Active</button>
                                <button type="button" data-index="Inactive" class="btn view_type_button">Expired</button>
                            </div>
                        
                            <a href="javascript:history.go(-1)" class="btn btn-success back_button waves-effect waves-light m-b-5 m-l-5  pull-right">
    						<i class="ion-arrow-left-a"></i>
    						<span><strong>Go Back</strong></span>            
    					    </a>
                    </div>
                   
                </div>
            </div>
            <span id="result">
                <?php echo view('templates/filter/filter_newContractors',$data); ?>
            </span>
        </div>		
    </div>

<script>
    $(document).on('click','.view_type_button',function(){
        $('.view_type_button').removeClass('active');
        $(this).addClass('active');  
        filter_progress_loader();
        $('main').addClass('panel');
    })
    function form_submit_data()
    {
        var tab_type = $('button.btn.view_type_button.active').attr('data-index');
        $.ajax({
            type:"POST",
            dataType:'html',
            url:'<?= base_url() ?>admin/Timesheet/filter_activeNewContractors',
            data: {tab_type:tab_type,submit:'submit'},
            success: function(response){   
                $('#result').html(response);
            }
        });
        
    }
</script>