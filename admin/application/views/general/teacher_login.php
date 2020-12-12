<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
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
            .login-form {
                    padding: 60px;
                    margin: 70px auto 0;
                    position: relative;
                    z-index: 9;
                    border-radius: 25px;
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
            .login-form h2{
                font-size:41px;
                font-weight:400;
                margin-bottom: 15px;
                color:#374948;
            }
            .login-form .btn-success, .login-form .btn-success:hover {
                    color: #fff;
                    background-color: #000;
                    border-color: #000;
                }
                label {
                        font-style: normal;
                        font-size: 14px;
                        line-height: 1.8;
                        text-transform: capitalize !important;
                        color:#374948;
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
                .social-media{
                    list-style: none;
                }
                .social-media li{
                    display:inline;
                    margin:0 4px;
                }
                ul.social-media li span {
                        width: 30px !important;
                        height: 30px !important;
                        background: #e3e9ef;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        border-radius:4px;
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
                        .login-form {
                                padding: 15px;
                            }
                        .login-footer {
                            display: grid;
                            justify-content: center !important;
                            
                        }
                        .social-media {
                                    padding: 0;
                                    text-align: center;
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
                            <!--LMS-->
                            <img alt="" src="<?php echo base_url();?>assets/images/EAIMD-LOGO-1.png">
                        </span>
                    </a>
                </div>
				
                <div class="login-form">
                    <h2>Signin</h2>
                    <p>Enter your email address and password to access teacher admin panel.</p>
					<?php if(isset($login_error)) echo "<p class=\"text-danger\">Oops! Those do not seem to be valid login credentials. Please try again.</p>";?>
                    <form action="<?php echo base_url();?>index.php/teacher/login" method="POST">
                        <input type="hidden" class="form-control" name="acc_type" value="2">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label><!--<label style="float:right;">Forget Passwsord?</label>-->
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="flex-disp flex-space">
                        <!--<div class="flex-disp">-->
                        <!-- <input type="checkbox" class="form-control" name="rememberme" value="" style="width: auto;">-->
                        <!-- <label>Remember Me</label></div>-->
                           
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" style="width:auto;">Sign in</button>
                        </div>
                    </form>
                    <!--<hr>-->
                    <!--<div class="flex-disp flex-space login-footer">-->
                    <!--<p>Don't have an account? Sign up</p>-->
                    <!--<ul class="social-media">-->
                    <!--    <li><span class="fa fa-facebook"></span></li>-->
                    <!--    <li><span class="fa fa-twitter"></span></li>-->
                    <!--    <li><span class="fa fa-instagram"></span></li>-->
                    <!--</ul>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url();?>assets/js/custom.js" type="text/javascript"></script>
</body>

</html>