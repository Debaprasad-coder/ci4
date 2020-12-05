<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $this->renderSection('title') ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url();?>/../template/assets/theme/common/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/../template/assets/theme/common/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>/../template/assets/theme/common/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url();?>/../template/assets/theme/common/images/favicon.ico" />
  </head>
  <body>
    <?= $this->renderSection('content') ?>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url();?>/../template/assets/theme/common/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url();?>/../template/assets/theme/common/js/off-canvas.js"></script>
    <script src="<?php echo base_url();?>/../template/assets/theme/common/js/hoverable-collapse.js"></script>
    <script src="<?php echo base_url();?>/../template/assets/theme/common/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>