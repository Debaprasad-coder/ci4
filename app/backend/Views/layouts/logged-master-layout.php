  <?= $this->include('common/header') ?>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?= $this->include('common/nav-bar') ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    <!-- partial:../../partials/_sidebar.html -->
      <?= $this->include('common/sidebar') ?>
        <div class="main-panel">
          <?= $this->renderSection('content') ?>
          <!-- partial:../../partials/_footer.html -->
          <?= $this->include('partial/partial-footer') ?>
          <!-- partial -->
        </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div> 
  <!-- container-scroller -->
  <!-- plugins:js -->
  <?= $this->include('common/footer') ?>