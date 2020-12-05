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
                  //$session = \Config\Services::session();
                  if(session()->getFlashdata('success')){                 
                  ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success !</strong>  <?=  session()->getFlashdata('success')?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php                  
                  }
                  if(session()->getFlashdata('error')){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error !</strong>  <?=  session()->getFlashdata('error')?>
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
                   
                  <h4>User Login</h4>
                  <h6 class="font-weight-light">Sign in to continue.</h6>
                   <?php $validation = \Config\Services::validation(); 
                      //print_r($validation);
                   ?>
                  <form class="pt-3" method="post" action="<?php echo  base_url()?>/login">
                    <div class="form-group ">
                      <?= csrf_field()?>
                      <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" value="<?= old('email')?>">
                      <!-- Error -->
                      <?php if($validation->getError('email')) {?>
                          <span class="text-danger">
                            <?= $error = $validation->getError('email'); ?>
                          </span>
                      <?php }?>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                      <?php if($validation->getError('password')) {?>
                          <span class="text-danger">
                            <?= $error = $validation->getError('password'); ?>
                          </span>
                      <?php }?>
                    </div>
                    <div class="mt-3">
                      <input type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="SIGN IN" name="submit">
                      
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                      <div class="form-check">
                        <label class="form-check-label text-muted">
                          <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                      </div>
                      <a href="<?= base_url() ?>/forgotpassword" class="auth-link text-black">Forgot password?</a>
                    </div>
                    <!-- <div class="mb-2">
                      <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                        <i class="mdi mdi-facebook mr-2"></i>Connect using facebook </button>
                    </div> -->
                    <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="<?php echo base_url();?>/register" class="text-primary">Create</a>
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

 