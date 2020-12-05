<?= $this->extend('layouts/logged-master-layout') ?>
<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection()?>
<?= $this->section('content') ?>
    
      <div class="content-wrapper">
          <div class="row d-none" id="proBanner">
            <div class="col-12">
              <span class="d-flex align-items-center purchase-popup">
                <p>Get tons of UI components, Plugins, multiple layouts, 20+ sample pages, and more!</p>
                <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template?utm_source=organic&amp;utm_medium=banner&amp;utm_campaign=free-preview" target="_blank" class="btn download-button purchase-button ml-auto">Upgrade To Pro</a>
                <i class="mdi mdi-close" id="bannerClose"></i>
              </span>
            </div>
          </div>
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
              </span> Profile </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
          <div class="row">
            <h2>We are working on Uesr profile section </h2>
            <?php
             //$uri = current_url(true);
              //echo (string)$uri."</br>"; 
              //echo current_url(true)->getSegment(3);
            ?>
          </div>
      </div>
      
      <!-- main-panel ends -->
    <!-- content-wrapper ends -->     
<?= $this->endSection()?>

      