<!doctype html>
<html lang="en">
<head>
        <title>Excellence Academy of Indian Music</title>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Tangerine:wght@400;700&display=swap" rel="stylesheet">
       
<?php
session_start();
include 'header.php';
include 'model.php';
?>
    <div class="book_preload">
        <div class="book">
           <div class="book__page"></div>
           <div class="book__page"></div>
           <div class="book__page"></div>
        </div>
    </div>
    <?php
    include 'navigation.php';
    ?>  
    
    <div id="eduservices-home" class="main-banner main-banner-show">
        <div class="d-table">
            <!--<video autoplay muted loop id="bgvid">-->
            <!--  <source src="assets/video/background_video-LMS_project-bg-1.mp4" type="video/mp4">-->
            <!--</video>-->
            <div class="d-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 reveal-left-fade">
                            <div class="">
                                <div class="hero-content">
                                    <h1>Excellence Academy of Indian Music</h1>
                                    <p>The best Indian classical and contemporary music school in the US. The place where you connect with the soul of rich Musical Heritage of India.</p>
                                    <a href="#eduservices-course" class="btn">Explore our courses</a>

                                </div>

                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
   <section class="boxes-area ct-quote">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h2>High achievements in art, music, etc., are the results of concentration</h2>
                    <span>- Swami Vivekananda</span>
                    <br>
                     <a href="courses.php" class="btn btn-white" style="margin-top: 30px;">Attend a Free Trial Class</a>
                </div>
                   
            </div>
        </div>
    </section>
    <section id="eduservices-about-us" class="boxes-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="single-box">
                        <i class="icofont-users-alt-3"></i>
                        <h3>WHO WE ARE</h3>
                        <p>We are the best Indian Classical and Contemporary music school located in the USA. Teaching students about rich Indian classical music and heritage.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="single-box">
                        <i class="icofont-automation"></i>
                        <h3>OUR MISSION</h3>
                        <p>We are on a mission to promote the rich Indian classical Music and Artistic Tradition across the nation.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3 wow fadeInUp" data-wow-delay=".6s">
                    <div class="single-box">
                        <i class="icofont-children-care"></i>
                        <h3>OUR VISSION</h3>
                        <p>We aim to reach global audience in next few years to promote the Cultural Music and Dance heritage of India and touch lives of many positively through the same.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="eduservices-course" class="courses-area ptb-100 bg-f9faff">
        <div class="container">
            <div class="section-title">
                <h2>Popular Categories</h2>
                
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="tab">
                        <ul class="tabs">
                            <?php
            			        $course_id='';
            			        $i=0;
                                $result = $model_obj->get_courses($course_id);
                                if (!empty($result)){
                                while($row = $result->fetch_assoc()) {  
                                   if($i > 4){
                                break;
                                    }
                                    else{
                                        $i++;
                                    }
                            ?>
                            <li>
                                <a href="#">
                                    <i class="icofont-network"></i>
                                    <br><?php echo $row['course_name']; ?>
                                </a>
                            </li>
                            <?php 
                              
                            }} ?>


                        </ul>

                        <div class="tab_content" id="explore_our_courses">
                            
                            <?php
            			        $i=0;
                                $resulttab = $model_obj->get_courses($course_id);
                                if (!empty($resulttab)){
                                while($rowtab = $resulttab->fetch_assoc()) {  
                                    $courseid=$rowtab['course_id'];
                                    $position=300; // Define how many character you want to display.

                                    $description = substr($rowtab['course_description'], 0, $position);
                                    if($i > 4){
                                    break;
                                    }
                                    else{
                                        $i++;
                                    }
                                ?>
                            <div class="tabs_item">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 reveal-left-fade">
                                        <div class="tabs_item_img">
                                            <img src="admin/uploaded_files/<?php echo $rowtab['course_image']; ?>" alt="Course">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 reveal-right-fade">
                                        <div class="tabs_item_content">
                                            <h3><?php echo $rowtab['course_name']; ?></h3>
                                            
                                            <p><?php echo $description; ?></p>
                                            
                                            <a href="course.php?course_id=<?php echo $courseid; ?>" class="btn">Enroll Today </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                               
                                }} ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
	
	<section id="education-why-choose" class="why-choose pt100 pb80 ">
        <div class="container">
            <div class="row">
                <div class="why-choose-items">
                    <div class="tabs text-center">
                       
                        <div class="tab-content relative background-white plr80 bdrs-10">
                            
                            <!-- Start tab content -->
                            <div class="tab-pane fade text-left clearfix active in" id="video-why-choose">
                                <div class="tab-text col-lg-6 col-md-6 col-sm-12 col-xs-12 lheight-30">
                                    <div class="valign-middle partition_left pl30 mb40 relative wow fadeIn" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: fadeIn;">
                                        <div class="ptb5">
                                            <div class="subtitle">Make your courses standout</div>
                                            <div class="title color-2">
                                                <span>Why choose us<span class="color-15">.</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <p>We are the best academy based in California, USA known for imparting quality training in Indian classical and contemporary music. Our students range from tiny tots to seniors and we derive equal pleasure in working with all of them and motivating them towards the art. We have a team of highly skilled experts who have been in the industry for a very long time. Our team of experts have achieved great heights in their professional careers and are now ready to support young minds in learning Indian Cultural music.</p>
                                    <ul class="list1">
                                        <li>
                                            <span class="table-cell valign-middle">Highly skilled specialist training</span>
                                        </li>
                                        <li>
                                            <span class="table-cell valign-middle">One on one and Group sessions</span>
                                        </li>
                                        <li>
                                            <span class="table-cell valign-middle">Strong emphasis on the personalized learning of students</span>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="video-exp">
                                        <?php
                        			        
                                            $resultvideo = $model_obj->get_videos_content('why_us');
                                            if (!empty($resultvideo)){
                                            $rowvideo = $resultvideo->fetch_assoc();  
                                               
                                            ?>
                                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $rowvideo['video_url1'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- End tab content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="eduservices-why-choose-us" class="why-choose-us">
        <div class="why-choose-us-wrapper-top">
            <div class="container">
                <div class="section-title reveal-left-fade">
                    <!-- section-title -->
                    <h2>Why Choose Us</h2>
                    <p>Connect with the rich heritage of Indian Music and arts.</p>
                </div>
            </div>
        </div>
        <div class="why-choose-us-wrapper-bottom background-opacity">
            <div class="container">
                <div class="why-choose-options wow fadeInUp">
                    <div class="row">
                        <!-- single item -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-choose">
                                <div class="single-choose-left ">
                                    <img src="assets/img/icons/logo-top-1.png" alt="">
                                </div>
                                <div class="single-choose-right">
                                    <h3>Well experienced <br> Faculty members</h3>
                                </div>
                            </div>
                        </div>
                        <!-- End single item -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-choose">
                                <div class="single-choose-left ">
                                    <img src="assets/img/icons/logo-top-2.png" alt="">
                                </div>
                                <div class="single-choose-right">
                                    <h3>Expert education &<br>training provided</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-choose">
                                <div class="single-choose-left ">
                                    <img src="assets/img/icons/logo-top-3.png" alt="">
                                </div>
                                <div class="single-choose-right">
                                    <h3>Eligible for all <br>age groups</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="single-choose">
                                <div class="single-choose-left ">
                                    <img src="assets/img/icons/logo-top-1.png" alt="">
                                </div>
                                <div class="single-choose-right">
                                    <h3>Emphasis on structural <br>learning methods</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-choose">
                                <div class="single-choose-left ">
                                    <img src="assets/img/icons/logo-top-2.png" alt="">
                                </div>
                                <div class="single-choose-right">
                                    <h3>Personal one on one <br>training provided</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-choose">
                                <div class="single-choose-left ">
                                    <img src="assets/img/icons/logo-top-3.png" alt="">
                                </div>
                                <div class="single-choose-right">
                                    <h3>Virtual classes & <br>detailed online learning</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-choose">
                                <div class="single-choose-left ">
                                    <img src="assets/img/icons/logo-top-1.png" alt="">
                                </div>
                                <div class="single-choose-right">
                                    <h3>Sangeet Prabhakar from Prayag Sangeet Samiti, Allahabad</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-choose">
                                <div class="single-choose-left ">
                                    <img src="assets/img/icons/logo-top-2.png" alt="">
                                </div>
                                <div class="single-choose-right">
                                    <h3>Registered Teacher & Examiner under Akhil Bharatya Gandharva Mahavidyalaya Mandal</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3">
                            <div class="single-choose">
                                <div class="single-choose-left ">
                                    <img src="assets/img/icons/logo-top-3.png" alt="">
                                </div>
                                <div class="single-choose-right">
                                    <h3>Imparts quality training with emphasis on practical as well as the theory concepts.</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- <section id="eduservices-course" class="courses-area ptb-100 bg-f9faff">-->
    <!--    <div class="container">-->
            
    <!--        <div class="row">-->
    <!--            <div class="col-lg-12 col-md-12">-->
    <!--                <div class="tab">-->
                       
    <!--                    <div class="tab_content ct-tabs">-->
                            
                            
    <!--                        <div class="tabs_item">-->
    <!--                            <div class="row">-->
    <!--                                <div class="col-lg-6 col-md-12 reveal-left-fade">-->
    <!--                                    <div class="tabs_item_img">-->
    <!--                                        <img src="assets/img/bg.jpg" alt="Course">-->
    <!--                                    </div>-->
    <!--                                </div>-->

    <!--                                <div class="col-lg-6 col-md-12 reveal-right-fade">-->
    <!--                                    <div class="tabs_item_content">-->
    <!--                                        <div>-->
    <!--                                        <h3>Best Indian Classical academy in US</h3>-->
                                            
    <!--                                        <p>We are teaching our students for the past decade </p>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                     <div class="tab_content ct-tabs">-->
                            
                            
    <!--                        <div class="tabs_item">-->
    <!--                            <div class="row">-->
    <!--                                <div class="col-lg-6 col-md-12 reveal-left-fade">-->
    <!--                                    <div class="tabs_item_content">-->
    <!--                                        <div>-->
    <!--                                        <h3>Best Indian Classical academy in US</h3>-->
                                            
    <!--                                        <p>We are teaching our students for the past decade </p>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </div>-->

    <!--                                <div class="col-lg-6 col-md-12 reveal-right-fade">-->
    <!--                                    <div class="tabs_item_img">-->
    <!--                                        <img src="assets/img/bg.jpg" alt="Course">-->
    <!--                                    </div>-->
                                        
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    
    <section id="eduservices-teacher" class="teacher-inner teacher-color section ptb-100">
        <div class="container">
            
            <div class="row align-items-center teacher-img-text">
                <div class="col-lg-6 col-md-6 text-center wow rotateIn" data-wow-offset="10" data-wow-duration="1.5s">
                      <img src="assets/img/bg.jpg" alt="Course">
                </div>
                <div class="col-lg-6 col-md-6 wow rotateIn" data-wow-offset="10" data-wow-duration="1.5s">
                    <div class="valign-middle partition_left pl30 mb40 relative wow fadeIn" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: fadeIn;">
                                        <div class="ptb5">
                                            <div class="subtitle">Teach the world online</div>
                                            <div class="title color-2">
                                                <span>Become an Instructor<span class="color-15">.</span></span>
                                            </div>
                                        </div>
                                    </div>
                        <p>Discover the work opportunities at Excellence academy of Indian music and dance. </p>
                        <button type="button" class="btn btn-white" style="margin-top: 30px;" data-toggle="modal" data-target="#exampleModalLong">
                          Start Teaching Today
                        </button>
                    
                </div>
                
            </div>
        </div>
    </section>
    
<!--     <section id="education-testimonial" class="testimonials">-->
<!--        <div class="container-fluid">-->
<!--            <div class="row">-->
<!--                <div class="testimonials-slider background-2">-->
                    <!-- Start single item -->
<!--                    <div class="tes-singel-content">-->
<!--                          <div class="testimonial-img col-lg-6 col-md-6 col-sm-12 col-xs-12" style="background-image: url(custom-assets/images/testimonials_1.jpg);"></div>-->
                        <!--<div class="testimonial-img col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
                        <!--    <div class="testimonial-video">-->
                        <!--        <iframe width="100%" height="400" src="https://www.youtube.com/embed/pswdTJ59fdQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                        <!--    </div>-->
                        <!--</div>-->
<!--                        <div class="testimonial-content-bl col-lg-6 col-md-6 col-sm-12 col-xs-12 pt100 pb150">-->
<!--                            <div class="testimonial-wrapper">-->
                                <!--  Title -->
<!--                                <div class="partition_left inline-block pl30 relative mb40">-->
<!--                                    <div class="ptb5">-->
<!--                                        <div class="subtitle">-->
<!--                                            Our Students help us to strive for more-->
<!--                                        </div>-->
<!--                                        <div class="title">-->
<!--                                            <span>What Our Students Say<span class="color-15">.</span></span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="testimonial-bg inline-block ptb30 italic fsize-20">-->
<!--                                    <p class="mb10">-->
<!--                                        "Turkey hamburger tongue, meatball chuck spare ribs-->
<!--                                        <br/> burgdoggen picanha short ribs. Flank prosciutto boudin-->
<!--                                        <br/> alcatra pork loin tongue kielbasa."-->
<!--                                    </p>-->
<!--                                    <div class="testimonial-author table">-->
<!--                                        <div class="table-row">-->
<!--                                            <div class="author-col table-cell valign-middle">-->
<!--                                                <div class="fsize-32 fweight-500 color-2">-->
<!--                                                    Emilie Jewell-->
<!--                                                </div>-->
<!--                                                <div class="fsize-12 fweight-600 color-17 uppercase">-->
<!--                                                    Product Manager et Inc.-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="author-col table-cell valign-middle text-right">-->
<!--                                                <img src="custom-assets/images/author-signature_1.png" alt="" class="author-signature">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- End single item -->
                    <!-- Start single item -->
<!--                    <div class="tes-singel-content">-->
<!--                        <div class="testimonial-img col-lg-6 col-md-6 col-sm-12 col-xs-12" style="background-image: url(custom-assets/images/testimonials_2.jpg);"></div>-->
                        <!--<div class="testimonial-img col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
                        <!--    <div class="testimonial-video">-->
                        <!--        <iframe width="100%" height="400" src="https://www.youtube.com/embed/pswdTJ59fdQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                        <!--    </div>-->
                        <!--</div>-->
<!--                        <div class="testimonial-content-bl col-lg-6 col-md-6 col-sm-12 col-xs-12 pt100 pb150">-->
                            <!-- title -->
<!--                            <div class="partition_left inline-block pl30 relative mb40">-->
<!--                                <div class="ptb5">-->
<!--                                    <div class="subtitle">-->
<!--                                        Our Students help us to strive for more-->
<!--                                    </div>-->
<!--                                    <div class="title">-->
<!--                                        <span>What Our Students Say<span class="color-15">.</span></span>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="testimonial-bg inline-block ptb30 italic fsize-20">-->
<!--                                <p class="mb10">-->
<!--                                    «Alcatra burgdoggen jerky landjaeger brisket ham hock-->
<!--                                    <br/> ground round. Tongue ham hock boudin meatloaf.-->
<!--                                    <br/> Tri-tip shoulder meatball pig.»-->
<!--                                </p>-->
<!--                                <div class="testimonial-author table">-->
<!--                                    <div class="table-row">-->
<!--                                        <div class="author-col table-cell valign-middle">-->
<!--                                            <div class="fsize-32 fweight-500 color-2">-->
<!--                                                Michael Romero-->
<!--                                            </div>-->
<!--                                            <div class="fsize-12 fweight-600 color-17 uppercase">-->
<!--                                                BusinessMan «Owners»-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="author-col table-cell valign-middle text-right">-->
<!--                                            <img src="custom-assets/images/author-signature_2.png" alt="" class="author-signature">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- End single item -->
                    <!-- Start single item -->
<!--                    <div class="tes-singel-content">-->
<!--                          <div class="testimonial-img col-lg-6 col-md-6 col-sm-12 col-xs-12" style="background-image: url(custom-assets/images/testimonials_3.jpg);"></div>-->
                        <!--<div class="testimonial-img col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
                        <!--   <div class="testimonial-video">-->
                        <!--        <iframe width="100%" height="400" src="https://www.youtube.com/embed/pswdTJ59fdQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                        <!--    </div>-->
                        <!--</div>-->
<!--                        <div class="testimonial-content-bl col-lg-6 col-md-6 col-sm-12 col-xs-12 pt100 pb150">-->
                            <!-- title -->
<!--                            <div class="partition_left inline-block pl30 relative mb40">-->
<!--                                <div class="ptb5">-->
<!--                                    <div class="subtitle">-->
<!--                                        Our Students help us to strive for more-->
<!--                                    </div>-->
<!--                                    <div class="title">-->
<!--                                        <span>What Our Students Say<span class="color-15">.</span></span>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="testimonial-bg inline-block ptb30 italic fsize-20">-->
<!--                                <p class="mb10">-->
<!--                                    «Alcatra burgdoggen jerky landjaeger brisket ham hock-->
<!--                                    <br/> ground round. Tongue ham hock boudin meatloaf.-->
<!--                                    <br/> Tri-tip shoulder meatball pig.»-->
<!--                                </p>-->
<!--                                <div class="testimonial-author table">-->
<!--                                    <div class="table-row">-->
<!--                                        <div class="author-col table-cell valign-middle">-->
<!--                                            <div class="fsize-32 fweight-500 color-2">-->
<!--                                                Christian Conner-->
<!--                                            </div>-->
<!--                                            <div class="fsize-12 fweight-600 color-17 uppercase">-->
<!--                                                BusinessMan «Indesit»-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="author-col table-cell valign-middle text-right">-->
<!--                                            <img src="custom-assets/images/author-signature_3.png" alt="" class="author-signature">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- End single item -->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>-->
<!--	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>-->
<!--<script>-->
<!--	$('.testimonials-slider').slick({-->
<!--  dots: true,-->
<!--  infinite: true,-->
<!--  speed: 300,-->
<!--  slidesToShow: 1,-->
<!--  slidesToScroll: 1,-->
<!--  responsive: [-->
<!--    {-->
<!--      breakpoint: 1024,-->
<!--      settings: {-->
<!--        slidesToShow: 1,-->
<!--        slidesToScroll: 1,-->
<!--        infinite: true,-->
<!--        dots: true-->
<!--      }-->
<!--    },-->
<!--    {-->
<!--      breakpoint: 600,-->
<!--      settings: {-->
<!--        slidesToShow: 1,-->
<!--        slidesToScroll: 1-->
<!--      }-->
<!--    },-->
<!--    {-->
<!--      breakpoint: 480,-->
<!--      settings: {-->
<!--        slidesToShow: 1,-->
<!--        slidesToScroll: 1-->
<!--      }-->
<!--    }-->
    
<!--  ]-->
<!--});-->
<!--	</script>-->
<div id="eduservices-testimonial" class="testimonial">
        <div class="container">
            <div class="row justify-content-xl-end justify-content-lg-end justify-content-md-center">
                <div class="col-lg-6 col-md-8">
                    <div class="testimonial-content reveal-right-fade">
                        <div class="testimonial-carousel owl-carousel">
                                <?php
                        			        
                                    $restestimonials = $model_obj->get_testimonials();
                                    if (!empty($restestimonials)){
                                    while($rowtestimonials = $restestimonials->fetch_assoc()){ 
                                        //  Define how many character you want to display.
                                    //   $position=125; 
                                   

                                    // $comment = substr($rowtestimonials['comment'], 0, $position);
                                ?>
                            <div class="testimonial-single">
                                
                                <h5><?php echo $rowtestimonials['username']; ?></h5>
                                <p><?php echo $rowtestimonials['comment']; ?></p>
                            </div>
                            
                            <?php }} ?>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <section id="eduservices-fun-facts" class="fun-facts-area ptb-100">
        <div class="container">
            <div class="row">
                <!--<div class="col-lg-3 col-md-6 col-6 wow fadeInUp" data-wow-delay=".2s">-->
                <!--    <div class="funFact">-->
                <!--        <i class="icofont-teacher"></i>-->
                <!--        <h3 class="count">55</h3>-->
                <!--        <span>Teachers</span>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div class="col-lg-3 col-md-6 col-6 wow fadeInUp" data-wow-delay=".4s">-->
                <!--    <div class="funFact">-->
                <!--        <i class="icofont-document-folder"></i>-->
                <!--        <h3 class="count">65</h3>-->
                <!--        <span>Courses</span>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div class="col-lg-6 col-md-6 col-6 wow fadeInUp" data-wow-delay=".6s">-->
                <!--    <div class="funFact">-->
                <!--        <i class="icofont-users-alt-2"></i>-->
                <!--        <h3 class="count">1100</h3>-->
                <!--        <span>Members</span>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-lg-6 col-md-6 col-6 wow fadeInUp" data-wow-delay=".8s">
                    <div class="funFact">
                       <div class="ct-flex"> <i class="icofont-flag-alt-2"></i>
                        <h3><span class="count">15</span></h3></div>
                        <span>Countries</span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6 wow fadeInUp" data-wow-delay=".8s">
                    <div class="funFact">
                       <div class="ct-flex"> <i class="icofont-flag-alt-2"></i>
                        <h3><span class="count">100</span>%</h3></div>
                        <span>Customer approval rate </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section id="education-resourses" class="course pt30 pb100">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    
                    <div class="course-items">
                        <div class="ct-tabs text-center">
                            
                            <div class="tab-content relative background-white mt100 bdrs-10">
                                <!-- Start Single tab content -->
                                <div class="tab-pane fade active in text-left clearfix" id="course-item-1">
                                    <div class="course-info-header col-lg-6 col-md-12 col-sm-12 col-xs-12 ptb60 pl60">
                                        <div class="table mb40">
                                            <div class="title-bl table-cell valign-middle">
                                                <div class="title color-2">
                                                    <span>What our customers say</span>
                                                </div>
                                                <!--<div class="subtitle fweight-600 color-4">-->
                                                <!--    Make your courses standout-->
                                                <!--</div>-->
                                            </div>
                                        </div>
                                        <p class="lheight-30">
                                           We have a very long standing reputation of being the best school for teaching Indian classical and contemporary music. Our team of experts provide some of the best teaching to the students through a personalized training schedule
                                        </p>
                                      <ul class="list1">
                                            <li>
                                                <span class="table-cell valign-middle">Customized Training</span>
                                            </li>
                                            <li>
                                                <span class="table-cell valign-middle">One on One classes as well as Group sessions</span>
                                            </li>
                                            <li>
                                                <span class="table-cell valign-middle">Skilled Faculty members </span>
                                            </li>
                                        </ul>
                                        <!-- button -->
                                        <!--<div class="flex-1">-->
                                        <!--    <button class="button button-mat border-gradient bdrs-10 lheight-50 color-white fsize-14 fweight-600 btn-1">-->
                                        <!--        <span class="color-2 button-text">START LEARN NOW</span>-->
                                        <!--    </button>-->
                                        <!--</div>-->
                                    </div>
                                    <div class="course-slider-bl col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="course-slider arrow-btn">
                                            <?php
                        			        
                                            $resultvideo = $model_obj->get_videos_content('slider');
                                            if (!empty($resultvideo)){
                                            $rowvideo = $resultvideo->fetch_assoc() ;
											
                                              if($rowvideo['video_url1'] != '')
                                              {
                                            ?>
                                            
                                            <div class="course-slider-img">
                                                <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $rowvideo['video_url1'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                
                                            </div>
                                            <?php
                                              }
                                             if($rowvideo['video_url2'] != '')
                                              {
                                            ?>
                                            <div class="course-slider-img">
                                                <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $rowvideo['video_url2'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                
                                            </div>
                                            <?php
                                              }
                                             if($rowvideo['video_url3'] != '')
                                              {
                                            ?>
                                            <div class="course-slider-img">
                                                <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $rowvideo['video_url3'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                
                                            </div>
                                            <?php
                                              }
                                             if($rowvideo['video_url4'] != '')
                                              {
                                            ?>
                                            <div class="course-slider-img">
                                                <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $rowvideo['video_url4'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                
                                            </div>
                                            <?php
                                              }
                                             if($rowvideo['video_url5'] != '')
                                              {
                                            ?>
                                            <div class="course-slider-img">
                                                <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $rowvideo['video_url5'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                
                                            </div>
                                            
                                            
                                            <?php }} ?>
                                            
                                            
                                            <!--<div class="course-slider-img" style="background-image: url(custom-assets/images/course/course-img-1.jpg);"></div>-->
                                            <!--<div class="course-slider-img" style="background-image: url(custom-assets/images/course/course-img-1.jpg);"></div>-->
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single tab content -->
                                
                            </div>
                        </div>
                    </div>
                    <!-- End course items -->
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
	$('.course-slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    
  ]
});
	</script>
    <section id="eduservices-contact" class="contact-area ptb-100">
        <div class="container">
            <div class="section-title">
                <h2>Contact Us</h2>
                <span>Do you have any Questions?</span>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-box">
                        <h3><i class="icofont-google-map"></i> Address</h3>
                        <p><a href="" target="_blank">California, USA.</a></p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="contact-box">
                        <h3><i class="icofont-envelope"></i> Email</h3>
                        <p><a href="mailto:info@excellenceacademyofmusic.com">info@excellenceacademyofmusic.com</a></p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3">
                    <div class="contact-box">
                        <h3><i class="icofont-phone"></i> Phone</h3>
                        <p><a href="tel:14084824598">+1 (408) 482- 4598</a></p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="get-in-touch">
                        <h3>Contact us today with your queries</h3>
                        <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>-->
                    </div>
                </div>

                <div class="col-lg-8 col-md-12 wow rotateIn" data-wow-offset="10" data-wow-duration="1.5s">
                    
                    <form method="post" action="" class="contactForm" id="">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Your name" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email address" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" cols="30" rows="4" name="message" id="message" placeholder="Enter your message" autocomplete="off" required></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="contact-btn btn">Send Message</button>
                                <!--Result notification -->
                                <div id="" class="text-center"></div>
                                <div id=""></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
     <!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Apply for the Teacher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="post" action="teacher_register.php" class="contactForm form-white" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row align-items-center teacher-img-text">
                <div class="col-lg-12 col-md-12" data-wow-offset="10" data-wow-duration="1.5s">
                    
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="firstname" id="name" placeholder="First Name" required>
                                </div>
                            </div>
                             <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lastname" id="name" placeholder="Last Name" required>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email address" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="contact" placeholder="Contact" required>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="teacher_course" placeholder="Course" required>
                                    <!--<select name="course" class="form-control">-->
                                    <!--    <option value="">Select Course</option>-->
                                        <?php
                                            // $resultcourse = $model_obj->get_courses($course_id);
                                            // if (!empty($resultcourse)){
                                            // while($rowcourse = $resultcourse->fetch_assoc()) { 
                                        ?>
                                    <!--    <option value="<?php echo $rowcourse['id']; ?>"><?php echo $rowcourse['course_name']; ?></option>-->
                                        <?php // }} ?>
                                    <!--</select>-->
                                    
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Please upload your updated resume</label>
                                   <input type="file" class="form-control" name="teacher_resume" required>
                                   </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                               
                                <!--Result notification -->
                                <div id="error-message" class="text-center"></div>
                                <div id="form-messages"></div>
                            </div>
                        </div>
                   
                </div>
                
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="contact-btn btn">Submit</button>
      </div>
       </form>
    </div>
  </div>
</div>
<?php
include 'footer.php';
?>