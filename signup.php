<!doctype html>
<html lang="en">
    
<head>
       <title>LMS - Signup</title>
    
<?php
include 'header.php';
?>
  
    <?php
    include 'navigation.php';
    ?>  
    
    <div id="eduservices-home" class="main-banner main-banner-show inner-header login-page">
        <div class="d-table">
           
            <div class="d-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 reveal-left-fade">
                            <div class="hero-content2">
                               
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="courses-area ptb-100 bg-f9faff login-form">
        <div class="container">
            
            <div class="row">
                <div class="education-subscribe reveal-bottom-fade">
                                <div class="subscribe-content">
                                    <!-- Newsletter title -->
                                    <div class="subscribe-content-inner section-title">
                                        <h2>Signup</h2>
                                        
                                    </div>
                                </div>
                                <div class="subscribe-form">
                                    <div class="login-form-inner">
                                        <!-- Login form -->
                                        <form method="post" action="signup_db.php" class="contactForm form-white">
                                            
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" name="email" placeholder="Email address" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bottom-form">
                                                <div class="left-btn">
                                                    <button class="contact-btn btn">Signup</button>
                                                </div>
                                                <div class="right-txt">
                                                    <p> If already registered please <a href="login.php" class="btn btn-white">Login</a> here</p>
                                                </div>
                                            </div>
                                           
                                        </form>
                                    </div>
                                </div>
                               
                            </div>
            </div>
             
        </div>
    </section>
    
    
<?php
include 'footer.php';
?>