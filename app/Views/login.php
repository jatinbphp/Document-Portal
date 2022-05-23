<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login | Document Portal</title>
        <!--[if lt IE 9]><script src="js/html5shiv.min.js"></script><![endif]-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/all.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/bootstrap.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/responsive.css') ?>" rel="stylesheet">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('assets/images/apple-touch-icon-144-precomposed.png') ?>">
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon-image.png'); ?>">
    </head>

    <body class="login-body">

        <div class="container">
            <div class="login-wrapper">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="login-box">

                            <div class="logo-big"><img src="<?php echo base_url('assets/images/admin-logo.png') ?>" alt=""></div>
                            <div class="form-wapper">
                                <form action="<?php echo base_url('auth/login') ?>" id="login_form" method="post">

                                    <?php if(session()->has('success')): ?>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <?php echo session()->getFlashdata('success'); ?>
                                        </div>
                                    <?php elseif(session()->has('error')): ?>
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <?php echo session()->getFlashdata('error'); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Password">
                                    </div>
                                    <div class="custom-control custom-switch mb-4">
                                        <input type="checkbox" class="custom-control-input order-2" id="customSwitch1">
                                        <label class="custom-control-label order-1" for="customSwitch1">Keep me logged in</label>
                                    </div>
                                    <div class="mb-2 text-center">
                                        <input type="submit" class="btn btn-dark" value="Login Now">
                                    </div>
                                    <!-- <div class="mt-5 text-center newregister">Not a user? <a href="#">Register now</a></div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="site-footer">
            <div class="container">
                <p>Copyright &copy; 2021 Document Portal. All rights reserved | Developed by Document Portal</p>
            </div>
        </footer>

        <!-- Bootstrap core JavaScript================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url('assets/js/jquery-min.js');?>" ></script>
        <script src="<?php echo base_url('assets/js/popper.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/ie10-viewport-bug-workaround.js');?>"></script>
        <script src="<?php echo base_url('assets/js/ie-emulation-modes-warning.js');?>"></script>
        <script src="<?php echo base_url('assets/js/custom.js');?>"></script>
        <script src="<?php echo base_url('assets/js/owl.carousel.js');?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.matchHeight-min.js');?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
        <script type="text/javascript">
            $('.coleql_height').matchHeight();
        </script>
        <script>
            $('#login_form').validate({
                // errorClass : 'text-danger',
                rules: {
                    email : {
                        required : true,       
                    },      
                    pwd : {
                        required : true,
                    },  
                },
                messages : {
                    email : {
                        required : "Please enter username",
                    },      
                    pwd : {
                        required : "Please enter password",
                    },  
                },
                submitHandler : function(form)
                {
                    form.submit();
                }
            });
        </script>
    </body>
</html>