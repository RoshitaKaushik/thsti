    <style>
        /*modal for add group*/
        .themeBtn,.themeBtn_no_res {
            background: #1f65c8;
            display: inline-block;
            font-size: 14px;
            font-weight: 500;
            height: auto;
            line-height: 0.8;
            padding: 8px 18px;
            color:#fff;
            border-radius: 1px;
            letter-spacing: 0.5px;
            border: 0px !important;
            cursor: pointer;
            border-radius: 100px;
            cursor: default ! important;
            margin-left:10px;
            
        }

        .themeBtn_new {
            background: #1f65c8;
            display: inline-block;
            font-size: 14px;
            font-weight: 500;
            height: auto;
            line-height: 0.8;
            padding: 8px 18px;
        color:#fff;
            border-radius: 1px;
            letter-spacing: 0.5px;
            border: 0px !important;
            cursor: pointer;
            border-radius: 100px;
            margin-left:10px;
        
        }


        .help {
            float: left;
        }

        .help a {
        padding: 4px 8px;
            color: #F0F0F0;
            background-color: #3377DD;
            margin: 0 0 0 5px;
            font-size: 12px;
        }

        .help a:hover {
            cursor: pointer;
        }

        .pop {
            display: none;
        }

        .popOut {
            float: left;
            /*width: 250px;*/
            
            /*margin-top: 50px ! important;*/
            padding: 5px;
            background-color: #f6faff !important;
            border: 1px solid #DDD;
            display: block;
            position: absolute;
            z-index:999;
            
            left: 0;
            right: 0;
            margin: 0 auto;
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
            margin-top: 10px;
            margin-right: 15px;
            /*position: absolute;*/
            right: 0;
        }
        .popOut {
            width: 60%;
            background-color: #f7ecf4;
            border: 6px solid #f9f9f9;
            border-right: 3px solid #f9f9f9;
            border-left: 3px solid #f9f9f9;
            box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%) ;
            -webkit-box-shadow: 0 5px 15px 0 rgb(41 128 185 / 10%);
            margin-top:15px;
        }
        
        .close.close_pop_out a {
            background-color: #fff!important;
            color: #f32323!important;
            border: 1px solid #fff;
            font-size: 14px!important;
        }
        
        .header_part {
            display: flex;
            align-items: flex-start;
        }                
        .header_part strong {
            min-width: 165px;
        }    
        span.header_button button.themeBtn {
            margin-bottom: 5px;
        }
        .header_part strong h3 {
        font-size: 18px;
        }


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
        ul.list_field li:hover, li.show-active {
            background: #fff7f7!important;
        }
        .top_maargin
        {
            margin-top:10px;
        }

        .tag_li
        {
            list-style: none;
            display: inline-block;
        }
        .filter-sub-menu-outer-box .tag_ul {
            width: 600px !important;
            left: 0  !important;
        }
        .filter-sub-menu-outer-box .tag_ul li.text-center.notifi-title {
            text-align: left!important;
            padding: 2px 0px 2px 20px;
            font-weight: 700;
        }
        .filter-sub-menu-outer-box .tag_ul li.list-group label.control-label {
            font-weight: 100;
            font-size: 12px;
            color: #888787;
        }
        .filter-sub-btn-box .btn-success {
            background-color: #ffffff;
            color: #565656!important;
            border: 1px solid #c7c7c7;
            margin-bottom: 5px;
        }
        .filter-sub-menu-outer-box {
            margin-bottom: 10px;
        }
        .waves-effect
        {
            min-width:0px !important;
        }
        .filter-sub-menu-outer-box .btn-primary
        {
            padding:0px 5px 0px 5px;
        }


        @media only screen and (max-width: 767px) {
        .mobile-view-outter-box .tabs li.tab {
                width: 50% !important;
            }
            
            .mobile-view-outter-box ul.nav.nav-tabs.tabs span.hidden-xs {
                display: block!important;
                border-bottom: 1px solid #ebebeb;
                font-size: 12px;
            }
            .mobile-view-outter-box ul.nav.nav-tabs.tabs span.visible-xs {
                display: none!important;
            }
            .mobile-view-outter-box ul.nav.nav-tabs.tabs span.hidden-xs p {
                display: none;
            }
        }
        /* Start Custum Tag Design  */
        .HBCU,.HBCU_button{
            background-color: rgb(210, 56, 158);
        }
        .TribalInstitution,.TribalInstitution_button{
            background-color: rgb(233, 137, 126);
        }
        .ServiceOrg,.ServiceOrg_button{
            background-color:rgb(0, 161, 112);
        }
        .AmeriCorp,.AmeriCorp_button{
            background-color: rgb(255, 183, 212);
        }
        .PeaceCorp,.PeaceCorp_button{
            background-color:rgb(245, 223, 77);
        }
        .ProspectInstitutions,.ProspectInstitutions_button{
            background-color: #2e7f8f;
        }
        .EnrollmentInstitutions,.EnrollmentInstitutions_button{
            background-color: rgb(180, 90, 48);
        }
        /* End Custum Tag Design  */

    </style>


    <span class='help' data-keyboard="false" data-backdrop="static" style="margin-top: 5px;float:none;">
        <p style="display:inline;"><a><i class="fa fa-plus" ></i></a></p>
        <div class='pop' style="box-shadow:4px 5px 10px 5px #dededf;">
            <div class='close close_pop_out'><a>X</a></div>
            <p>      
                <div class="col-sm-12">  		
                        <?php foreach($organizationLabel as $oLabel){ ?>
                            <div class="checkbox checkbox-success checknox-list <?= $oLabel['class_name']."_div" ?>" <?php if(!empty($organizationSelectedLabel) && in_array($oLabel['id'], array_column($organizationSelectedLabel, 'id'))){ echo "style='display:none;'";  } ?> >
                                <button class="themeBtn_new  <?= $oLabel['class_name'] ?>" rel_class_name= "<?= $oLabel['class_name'] ?>" rel_name="<?= $oLabel['name'] ?>" rel_id="<?= $oLabel['id'] ?>"><?= $oLabel['name'] ?></button>
                            </div> 
                        <?php } ?>
                    <div class="clearfix"></div>
                </div>     
            </p>
        </div>     
    </span>
