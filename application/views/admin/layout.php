        <?php $this->load->view('admin/inc/header');?>
        <!-- Start right Content here -->
        <?php $this->load->view('admin/inc/nav');?>

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">

                        <div class="topbar-left d-none d-lg-block">
                            <div class="text-center">
                                
                                <a href="<?=site_url('admin');?>" class="logo" style="font-size: 18px; color: #fff;"><?=appName;?></a>
                            </div>
                        </div>

                        <nav class="navbar-custom">

                            <ul class="list-inline float-right mb-0">
                                

                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <img src="<?=base_url();?>public/admin/images/users/user-1.jpg" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                                        <a class="dropdown-item" href="<?=site_url('admin/profile');?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                        <a class="dropdown-item" href="<?=site_url('admin/changePassword');?>"><i class="mdi mdi-settings m-r-5 text-muted"></i> Change Password</a>
                                        <a class="dropdown-item" href="<?=site_url('admin/logout');?>"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                    </div>
                                </li>

                            </ul>

                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                            </ul>

                            <div class="clearfix"></div>

                        </nav>

                    </div>
                    <!-- Top Bar End -->

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="page-title"><?=$title;?></h5>
                                </div>
                            </div>
                            <!-- end row -->
            <?php if($this->session->flashdata('item')){ ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <p> <?=$this->session->flashdata('item');?></p>
            </div>
            <?php } 
            if($this->session->flashdata('warn')){ ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <p> <?=$this->session->flashdata('warn');?></p>
            </div>
            <?php } ?>

            <!-- ============================================================== -->
            <div class="container-fluid">
               <?php $this->load->view($subview);?>
            </div>
            
           <?php $this->load->view('admin/inc/footer');?>