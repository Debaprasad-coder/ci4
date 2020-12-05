<?= $this->extend('layouts/logged-master-layout') ?>
<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection()?>
<?= $this->section('content') ?>    
      <div class="content-wrapper ">
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
                <i class="mdi mdi-contacts menu-icon"></i>
              </span> Profile </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
            <?php
             // echo '<pre>';
             // print_r($profile);
             // echo '</pre>';
            ?>
            <?php $validation = \Config\Services::validation();          
            ?>

            <?php                
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
          <div class="row"> 
            <!-- Profile Update From -->           
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Change Profile </h4>
                    <p class="card-description">  </p>
                    <form class="forms-sample" method="post" action="<?=  base_url()?>/change/profile" enctype="multipart/form-data" onsubmit="return confirm('Are you sure to update ??')">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Profile Created At</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" value="<?= date('l jS \of M Y h:i A',strtotime($profile['created_at']))?>" disabled="true">                       
                      </div>
                      <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" id="contact_number" value="<?= $profile['profile_contact']?>" placeholder="Contact Number">
                        <?php if($validation->getError('contact_number')) {?>
                          <span class="text-danger">
                            <?= $error = $validation->getError('contact_number'); ?>
                          </span>
                      <?php }?>
                      </div>    
                      <?php
                        if($profile['profile_img'] == NULL) :
                        $image_url = base_url().'/../template/assets/frontend/profile/no-image.png';
                        else :
                        $image_url = base_url().'/../template/assets/frontend/profile/'.$profile['profile_img'];
                        endif
                      ?>                  
                      <div class="form-group">
                        <label for="profile_image">Choose Image </label>
                        <div class="row">                          
                          <div class="col-sm-8">
                            <input type="file" name="profile_image" class="form-control" id="profile_image" onchange="readURL(this)">
                          </div>
                          <div class="col-sm-4">
                            <img  id="demo_profile_img" class="profile_pic" src="<?= $image_url ?>" alt="profile">
                          </div>
                        </div>
                        <?php if($validation->getError('profile_image')) {?>
                          <span class="text-danger">
                            <?= $error = $validation->getError('profile_image'); ?>
                          </span>
                      <?php }?>
                      </div>                      
                      <button type="submit" class="btn btn-outline-primary btn-icon-text">Change <i class="mdi mdi-file-check btn-icon-append"></i></button>                      
                    </form>
                  </div>
                </div>
              </div>
              <!-- Password Update From --> 
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Change Password</h4>
                    <p class="card-description">  </p>
                    <form class="forms-sample" method="post" action="<?=  base_url()?>/change/password" onsubmit="return confirm('Are you sure to update ??')">                      
                      <div class="form-group">
                        <label for="Password">Old Password</label>
                        <input type="password" name="password" class="form-control" id="Password" placeholder="Old Password">
                        <?php if($validation->getError('password')) {?>
                          <span class="text-danger">
                            <?= $error = $validation->getError('password'); ?>
                          </span>
                      <?php }?>
                      </div>
                      <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password">
                        <?php if($validation->getError('new_password')) {?>
                          <span class="text-danger">
                            <?= $error = $validation->getError('new_password'); ?>
                          </span>
                      <?php }?>
                      </div>
                      <div class="form-group">
                        <label for="Confirm_new_password">Confirm New Password</label>
                        <input type="password" name="Confirm_new_password" class="form-control" id="Confirm_new_password" placeholder="Confirm New Password">
                        <?php if($validation->getError('Confirm_new_password')) {?>
                          <span class="text-danger">
                            <?= $error = $validation->getError('Confirm_new_password'); ?>
                          </span>
                      <?php }?>
                      </div>                      
                      <button type="submit" class="btn btn-outline-danger btn-icon-text">Update <i class="mdi mdi-reload btn-icon-prepend"></i></button>                      
                    </form>
                  </div>
                </div>
              </div>
          </div>
      </div>
      
      <!-- main-panel ends -->
    <!-- content-wrapper ends -->     
<style type="text/css">
  .profile_pic{
    height: 50px;
    width: 100px;
    border: 1px  solid #777;
  }
</style>
<?= $this->endSection()?>
