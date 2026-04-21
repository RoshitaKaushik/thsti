<style>
    .hide1 {
        display: none ! important;
    }
</style>


<div class="row">
    <div class="col-md-12" style="border-bottom: 1px solid #ccc;">
        <h3 class="panel-title" style="display:inline;float:left;">Organization &nbsp;&nbsp;&nbsp;</h3>
        <?php
        
        if ($form_id != '') {
            echo '<span class="header_button">';
            foreach ($organizationSelectedLabel as $olabel) {
                echo '<button class="themeBtn ' . $olabel['class_name'] . '_button"  data-name="' . $olabel['id'] . '">' . $olabel['name'] . ' <i class="fa fa-times remove_button" rel_name="' . $olabel['class_name'] . '_button" data-class-name="' . $olabel['class_name'] . '"></i></button>';
            }
            echo '</span>';
          
            if (isset($data)) {
                echo view('templates/show_organizationLabel_in_pop_up', ['data' => $data]);
            }
        }
        ?>

    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <div class=" mobile-view-outter-box" style="margin-left: -10px;margin-right: -10px;">
            <ul class="nav nav-tabs pop_tabs" style="width: 100%;">
                <li class="pop_tab active" style="width: 10%;">
                    <a href="#poptab1" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">General</span>
                    </a>
                </li>

                <li class="pop_tab" style="width: 15%;">
                    <a href="#poptab2" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">Donation/Payments</span>
                    </a>
                </li>
            </ul>
        </div>



        <div class="pop-pane active" id="poptab1">
            <?= view('templates/forms/organization_general_form') ?>
        </div>
        <?php if ($form_id != '') { ?>
            <div class="pop-pane" id="poptab2" style="display:none">
                <?= view('templates/forms/organization_donation') ?>
            </div>
        <?php } ?>



    </div>
</div>