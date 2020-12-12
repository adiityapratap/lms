
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger site-logo" href="#page-top">
                <img src="admin/assets/images/EAIMD-LOGO-1.png" alt="logo">
                <!--<h2>LMS</h2>-->
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                       <a class="nav-link js-scroll-trigger" href="http://excellenceacademyofmusic.com/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="courses.php">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="http://excellenceacademyofmusic.com/#eduservices-why-choose-us">Services</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="http://excellenceacademyofmusic.com/#education-resourses">Resource</a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="http://excellenceacademyofmusic.com/#eduservices-testimonial">Testimonials</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link js-scroll-trigger" href="http://excellenceacademyofmusic.com/#eduservices-contact">Contact</a>
                    </li>
                    <?php
                    
                    
                    //if(empty($_SESSION['lms_name'])){
                    ?>
                    <!-- <li class="nav-item">
                         <a class="nav-link js-scroll-trigger" href="login.php">Login/Signup</a>
                    </li> -->
                    <?php
                        
                    // }
                    // else{
                    ?>
                    <!-- <li class="nav-item">
                         <span class="nav-link js-scroll-trigger">Hi <?php // echo $_SESSION['lms_name']; ?></span>
                    </li>
                    <li class="nav-item">
                         <span class="nav-link js-scroll-trigger" onclick="account_logout()">Logout</span>
                    </li> -->
                    <?php 
                   // }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- <script>
        function account_logout(){
        $.ajax({
            type: "POST",
            url: "html_code.php",
            data:'method_name=account_logout',
            success: function(data){
                 location.reload();
            }
        });
    }
    </script> -->
    