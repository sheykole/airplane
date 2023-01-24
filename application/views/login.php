<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?=appName;?> - Login</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="<?=base_url();?>public/admin/images/favicon.ico">

        <link href="<?=base_url();?>public/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url();?>public/admin/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url();?>public/admin/css/style.css" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div class="accountbg">
            
            <div class="content-center">
                <div class="content-desc-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-md-8">
                                <div class="card">
                                    <div class="card-body">
                
                                        <h5 class="text-center mt-0 m-b-15">
                                            <a href="<?=base_url();?>" class="logo logo-admin"><?=appName;?></a>
                                        </h5>
                
                                        <h4 class="text-muted text-center font-18"><b>Sign In</b></h4>
                                        <h4  class="text-muted text-center font-18"><?=anchor(base_url(),'Go back')?></h4>
                                        <?php if($this->session->flashdata('warn')){ ?>
        
                                          <p style="color:red; font-size: 12px; text-align: center;"> <?=$this->session->flashdata('warn');?></p>
                                        
                                        <?php } ?>
                
                                        <div class="p-2">
                                            <?php echo form_open('',array('class'=>'form-horizontal m-t-20','method'=>'post'));?>               
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" type="text" required="" placeholder="Username" name="username">
                                                    </div>
                                                </div>
                
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" type="password" required="" placeholder="Password" name="password">
                                                    </div>
                                                </div>
                
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                                                        </div>
                                                    </div>
                                                </div>
                
                                                <div class="form-group text-center row m-t-20">
                                                    <div class="col-12">
                                                        <input type="submit" class="btn btn-primary btn-block" value="Log In">
                                                    </div>
                                                </div>
                                            <?php echo form_close();?>
                                        </div>
                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery  -->
        <script src="<?=base_url();?>public/admin/js/jquery.min.js"></script>
        <script src="<?=base_url();?>public/admin/js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url();?>public/admin/js/modernizr.min.js"></script>
        <script src="<?=base_url();?>public/admin/js/detect.js"></script>
        <script src="<?=base_url();?>public/admin/js/fastclick.js"></script>
        <script src="<?=base_url();?>public/admin/js/jquery.slimscroll.js"></script>
        <script src="<?=base_url();?>public/admin/js/jquery.blockUI.js"></script>
        <script src="<?=base_url();?>public/admin/js/waves.js"></script>
        <script src="<?=base_url();?>public/admin/js/jquery.nicescroll.js"></script>
        <script src="<?=base_url();?>public/admin/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="<?=base_url();?>public/admin/js/app.js"></script>

    </body>
</html>