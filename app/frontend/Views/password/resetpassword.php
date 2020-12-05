<?= $this->extend('layouts/master-layout') ?>
<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection()?>
<?= $this->section('content') ?>
  <div class="container-scroller">    
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth bg-info">
            <div class="row flex-grow">
              <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left p-5">
                  <?php 
                  $session = \Config\Services::session();
                  if($session->getFlashdata('success')){                 
                  ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success !</strong>  <?=  $session->getFlashdata('success')?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php                  
                  }
                  if($session->getFlashdata('error')){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error !</strong>  <?=  $session->getFlashdata('error')?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <?php
                  }
                ?>
                  <div class="brand-logo">
                    <img src="<?php echo base_url();?>/../template/assets/theme/common/images/logo.svg">
                  </div>
                   
                  <h4>Reset Password</h4>
                  <h6 class="font-weight-light"></h6>
                   <?php $validation = \Config\Services::validation(); 
                      //print_r($validation);
                   ?>
                  <form class="pt-3" method="post" action="<?php echo  base_url()?>/resetpassword">
                    <?= csrf_field()?>
                    <div class="form-group ">
                      <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                      <!-- Error -->
                      <?php if($validation->getError('password')) {?>
                          <span class="text-danger ">&#128540;
                            <?= $error = $validation->getError('password'); ?>
                          </span>
                      <?php }?>
                    </div> 
                    <div class="form-group ">
                      <input type="password" name="confirm_password" class="form-control form-control-lg" id="confirm_password" placeholder="Confirm Password">
                      <!-- Error -->
                      <?php if($validation->getError('confirm_password')) {?>
                          <span class="text-danger">&#128540;
                            <?= $error = $validation->getError('confirm_password'); ?>
                          </span>
                      <?php }?>
                    </div>                    
                    <div class="mt-3">
                      <input type="submit" class="btn btn-block btn-gradient-success btn-lg font-weight-medium auth-form-btn" value="Reset" name="submit">
                      
                    </div>           
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
  </div>
<?= $this->endSection()?>

 