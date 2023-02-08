<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REgister Page</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
     <div class="container ">
            <div class="row">            
                <div class="login-container col-lg-4 col-md-6 col-sm-8 col-xs-12">
                     <div class="login-title text-center">
                            <h2><span>Takalo<strong>Takalo</strong></span></h2>
                     </div>
                    <div class="login-content">
                        <div class="login-header ">
                            <h3><strong>Welcome,</strong></h3>
                            <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis quam numquam</h5>

                            <?php if (isset($_SESSION['success'])) { ?>
                                <div class="alert alert-success"><?php echo $_SESSION['success'] ?></div>
                            <?php } ?>
                            <?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
                        </div>
                        <div class="login-body">
                            <form role="form" action="" method="post" class="login-form">
                                <div class="form-group ">
                                    <div class="pos-r">                                        
                                        <input type="text" value="Safidy@gmail.com"  name="email" id="email" placeholder="Email..." class="form-username form-control">
                                        <i class="fa fa-user"></i>
                                        <span></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="pos-r">                                    
                                        <input type="password" value="safidy" name="password" id="password" placeholder="Password..." class="form-password form-control" >
                                        <i class="fa fa-lock"></i>
                                        <span></span>                                        
                                    </div>
                                </div>
                                <div class="form-group text-right">     
                                    <a href="#" class="bold"> Forgot password?</a>
                                </div>   

                                <div class="form-group">     
                                    <button type="submit" class="btn btn-warning form-control"><strong>Sign in</strong></button>  
                                </div>   
                                                                              
                            </form>
                        </div> <!-- end  login-body -->                     
                    </div><!-- end  login-content -->  
                    <div class="login-footer text-center template">
                        <h5>Don't have an account?<a href="<?php echo base_url('auth/register'); ?>" class="bold"> Sign up </a>     </h5>
                         <h5>Bootstrap login template made by <a href="https://github.com/azouaoui-med" class="bold"> Safidy Maminirina</a></h5>                   
                    </div>
                </div>  <!-- end  login-container -->      

            </div>
        </div><!-- end container -->

    
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php  echo base_url() ?>assets/js/jquery.min.js"></script>

</body>
</html>