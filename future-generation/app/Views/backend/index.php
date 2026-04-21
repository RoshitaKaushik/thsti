<?= view('templates/admin_header') ?>

<?php
    if (isset($sidebar)) {
        if ($sidebar != 0) {
            // Uncomment and use this if needed
            // echo view('templates/dashboard_sidebar');
        }
    } else {
        echo view('templates/admin_sidebar');
    }

    // Optional: Load another shared header if needed
    // echo view('templates/header_sidebar');
?>

<!-- ============================================================== -->
<!-- Start Content here -->
<!-- ============================================================== --> 

<?= view($content, isset($data) ? $data : []) ?>

<!-- ============================================================== -->
<!-- End Content here -->
<!-- ============================================================== -->    

<?= view('templates/admin_footer') ?>
<!-- Optional footer -->
<?php
    // echo view('templates/new_footer');
?>
