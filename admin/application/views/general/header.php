<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LMS</title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>assets/images/EAIMD-FAV.png">
	<!-- google font -->
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>-->




<!-- header_End -->
 <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<!--<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">-->
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/ionicons.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/simple-line-icons.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/line-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Bootstrap CSS -->
    
      <link href="<?php echo base_url();?>assets/css-custom/bootstrap.min.css" rel="stylesheet">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css-custom/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css-custom/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css-custom/responsive.css">
      <script>
          jQuery(document).on('click', '.iq-menu-item', function() {
            jQuery(this).toggleClass('active');
        });
      </script>
	<style>
	    @font-face {
  font-family: "remixicon";
  src: url('<?php echo base_url();?>assets/fonts-custom/remixicon4d30.eot?t=1568552893872'); /* IE9*/
  src: url('<?php echo base_url();?>assets/fonts-custom/remixicon4d30.eot?t=1568552893872#iefix') format('embedded-opentype'), /* IE6-IE8 */
  url("<?php echo base_url();?>assets/fonts-custom/remixicon4d30.html?t=1568552893872") format("woff2"),
  url("<?php echo base_url();?>assets/fonts-custom/remixicon4d30.woff?t=1568552893872") format("woff"),
  url('<?php echo base_url();?>assets/fonts-custom/remixicon4d30.ttf?t=1568552893872') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
  url('<?php echo base_url();?>assets/fonts-custom/remixicon4d30.svg?t=1568552893872#remixicon') format('svg'); /* iOS 4.1- */
  font-display: swap;
}

	</style>
</head>
<body>
	<div class="wrapper">
		      <!-- TOP Nav Bar -->
         <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
               <div class="iq-sidebar-logo">
                  <div class="top-logo">
                     <a href="index.html" class="logo">
                     <!--<img src="<?php echo base_url();?>assets/images/EAIMD-LOGO-1.png" class="img-fluid" alt="">-->
                     <!--<span>LMS</span>-->
                     </a>
                  </div>
               </div>
               <div class="navbar-breadcrumb">
                  <h5 class="mb-0">Dashboard</h5>
                  <nav aria-label="breadcrumb">
                     <ul class="breadcrumb">
                        <!--<li class="breadcrumb-item"><a href="index.html">Home</a></li>-->
                        <?php  if($this->session->userdata('useracc') != '2'){  ?>
                        <li class="breadcrumb-item active" aria-current="page">Admin</li>
                        <?php
                        }
                        else{
                        ?>
                        <li class="breadcrumb-item active" aria-current="page">Teacher</li>
                        <?php 
                        }
                        ?>
                     </ul>
                  </nav>
               </div>
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="iq-menu-bt align-self-center">
                     <div class="wrapper-menu">
                        <div class="line-menu half start"></div>
                        <div class="line-menu"></div>
                        <div class="line-menu half end"></div>
                     </div>
                  </div>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ml-auto navbar-list">
                        <li class="nav-item">
                           <a class="search-toggle iq-waves-effect" href="#"><i class="ri-search-line"></i></a>
                           <form action="#" class="search-box">
                              <input type="text" class="text search-input" placeholder="Type here to search..." />
                           </form>
                        </li>
                        <li class="nav-item dropdown">
                           <a href="#" class="search-toggle iq-waves-effect">
                              <i class="ri-mail-line"></i>
                              <span class="badge badge-pill badge-dark badge-up count-mail">5</span>
                           </a>
                           <div class="iq-sub-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                       <h5 class="mb-0 text-white">All Messages<small class="badge  badge-light float-right pt-1">5</small></h5>
                                    </div>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="<?php echo base_url();?>assets/images/user1.png" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Nik Emma Watson</h6>
                                             <small class="float-left font-size-12">13 Jun</small>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="<?php echo base_url();?>assets/images/user2.png" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Lorem Ipsum Watson</h6>
                                             <small class="float-left font-size-12">20 Apr</small>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="<?php echo base_url();?>assets/images/user3.png" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Why do we use it?</h6>
                                             <small class="float-left font-size-12">30 Jun</small>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="<?php echo base_url();?>assets/images/user4.png" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Variations Passages</h6>
                                             <small class="float-left font-size-12">12 Sep</small>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="<?php echo base_url();?>assets/images/user5.png" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Lorem Ipsum generators</h6>
                                             <small class="float-left font-size-12">5 Dec</small>
                                          </div>
                                       </div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </li>
                        
                        <li class="nav-item">
                           <a href="#" class="search-toggle iq-waves-effect">
                              <i class="fa fa-bell-o"></i>
                              <span class="bg-danger dots"></span>
                           </a>
                           <div class="iq-sub-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                       <h5 class="mb-0 text-white">All Notifications<small class="badge  badge-light float-right pt-1">4</small></h5>
                                    </div>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">New Order Recieved</h6>
                                             <small class="float-right font-size-12">23 hrs ago</small>
                                             <p class="mb-0">Lorem is simply</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="<?php echo base_url();?>assets/images/user3.png" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Emma Watson Nik</h6>
                                             <small class="float-right font-size-12">Just Now</small>
                                             <p class="mb-0">95 MB</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="<?php echo base_url();?>assets/images/user2.png" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">New customer is join</h6>
                                             <small class="float-right font-size-12">5 days ago</small>
                                             <p class="mb-0">Jond Nik</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40" src="<?php echo base_url();?>assets/images/jpg.svg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Updates Available</h6>
                                             <small class="float-right font-size-12">Just Now</small>
                                             <p class="mb-0">120 MB</p>
                                          </div>
                                       </div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </li>
                        <li class="nav-item iq-full-screen"><a href="#" class="iq-waves-effect" id="btnFullscreen"><i class="ri-fullscreen-line"></i></a></li>
                     </ul>
                  </div>
                  <ul class="navbar-list">
                     <li>
                        <a href="#" class="search-toggle iq-waves-effect text-white">
                            <?php
                            $userimg=$this->session->userdata('userimg');
                            if((isset($userimg)) && ($userimg !='') && (file_exists("./uploaded_files/".$userimg))) {  
											echo "<img src=\"".base_url()."uploaded_files/".$userimg."\" class=\"img-fluid rounded\">";
											}
											else{
											    echo "<img src=\"".base_url()."assets/images/user.png\" class=\"img-fluid rounded\">";
											}
                            ?>
                            <!-- <img src="<?php echo base_url();?>assets/images/user.png" class="img-fluid rounded" alt="user">-->
                            </a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                           <div class="iq-card shadow-none m-0">
                              <div class="iq-card-body p-0 ">
                                 <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height"><?php echo $this->session->userdata('userfullname'); ?></h5>
                                    <span class="text-white font-size-12">Available</span>
                                 </div>
                                 <a href="#" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-file-user-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">My Profile</h6>
                                          <p class="mb-0 font-size-12">View personal profile details.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="#" class="iq-sub-card iq-bg-primary-success-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-success">
                                          <i class="ri-profile-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Edit Profile</h6>
                                          <p class="mb-0 font-size-12">Modify your personal details.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="#" class="iq-sub-card iq-bg-primary-danger-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-danger">
                                          <i class="ri-account-box-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Account settings</h6>
                                          <p class="mb-0 font-size-12">Manage your account parameters.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="#" class="iq-sub-card iq-bg-primary-secondary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-secondary">
                                          <i class="ri-lock-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Privacy Settings</h6>
                                          <p class="mb-0 font-size-12">Control your privacy parameters.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <div class="d-inline-block w-100 text-center p-3">
                                    <?php  if($this->session->userdata('useracc') != '2'){  ?>
                                    <a class="iq-bg-danger iq-sign-btn" href="<?php echo base_url();?>index.php/general/logout" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                    <?php
                                      }
                                      else{
                                       ?>   
                                          <a class="iq-bg-danger iq-sign-btn" href="<?php echo base_url();?>index.php/teacher/logout" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                        <?php  
                                      }
                                        ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </nav>
            </div>
         </div>
         <!-- TOP Nav Bar END -->