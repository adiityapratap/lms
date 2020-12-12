<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Reset Password</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/images/EAIMD-FAV.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/ionicons.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet">
    <style>
        .sufee-login:before {
                position: absolute;
                content: "";
                top: 0;
                bottom: 0;
                left: auto;
                right: 0;
                min-height: 0;
                max-height: 275px;
                border-radius: 0 0 30px 30px;
                width: 100%;
                background:#f34444;
                z-index: -1;
            }
            .login-content {
                        max-width: 680px;
                        margin: 4vh auto;
                    }
            .reset-form {
                    padding: 60px;
                    margin: 70px auto 0;
                    position: relative;
                    z-index: 9;
                    border-radius: 25px;
                    background: #fff;
                    box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 9px 0px;
                }
            .form-control {
                    height: 45px;
                    line-height: 45px;
                    background: #e9edf4;
                    border: 0px solid #d7dbda;
                    font-size: 14px;
                    color: #777D74;
                }
                .form-control:focus{
                    background: #e9edf4;
                    border: 0px solid #d7dbda;
                }
                .reset-form h2 {
                    font-size: 35px;
                    font-weight: 400;
                    margin-bottom: 32px;
                    color: #374948;
                    text-align: center;
                }
			.reset-form .btn-success, .reset-form .btn-success:hover,
			.reset-form .btn-success:focus {
                    color: #fff;
                    background-color: #000;
					border-color: #000;
					width: 100%;
				}
				
                span.logo-default img {
                    width: 120px;
                    height: auto;
                }
                .flex-disp{
                    display:flex;
                    align-items: center;
                }
                .flex-space{
                    justify-content: space-between;
                }
                .flex-disp label{
                    margin-bottom:0;
                    margin-left:5px;
                }
                
               
                    .login-content .logo {
                            position: relative !important;
                    }
                    @media (max-width: 991px){
                            .logo a {
                                display: block;
                                width: 200px;
                                margin: 0 auto;
                            }
                    }
                    @media( max-width: 576px){
                        .reset-form {
                                padding: 15px;
                            }
                        
                    }
                    .logo-default{
                            font-size: 41px;
                            font-weight: 400;
                            margin-bottom: 15px;
                            color: #ffffff;
                            letter-spacing: 6px;
                    }
        
	</style>
</head>

<body class="bg-light">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="logo">
                    <a href="#">
                        <span class="logo-default">
                           
                            <img alt="" src="<?php echo base_url();?>assets/images/EAIMD-LOGO-1.png">
                        </span>
                    </a>
                </div>
				
                <div class="reset-form">
                    <h2>Password Updated Succesfully</h2>
					     <a href="<?php echo base_url(); ?>index.php/general/login" class="btn btn-success" tabindex="-1">Go to Admin Dashboard</a>
                </div>
            </div>
        </div>
    </div>
 
</body>

</html>