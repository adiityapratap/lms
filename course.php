 <?php 
        session_start();
        include 'model.php';  
         if(isset($_GET['course_id']) && $_GET['course_id']!='')
        {
            $course_id=$_GET['course_id'];
        }
        else{
             header('Location: courses.php');
        }
        
        $result = $model_obj->get_courses($course_id);
        
        $row = $result->fetch_assoc();
       
        
        if($row['course_header_image'] == '' || $row['course_header_image'] == NULL){
            $header_image="admin/uploaded_files/".$row['course_image'];
        }
        else{ 
            $header_image='admin/uploaded_files/'.$row['course_header_image'];
        }
        if($row['course_custom_heading'] == ''){
            $heading= $row['course_name'];
        }
        else{
            $heading= $row['course_custom_heading'];
        }
        
    ?>
<!doctype html>
<html lang="en">
    
<head>
       <title>Course - <?php echo $row['course_name']; ?></title>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<?php
include 'header.php';
?>
  
    <?php
    include 'navigation_white.php';
    ?>  
    
    <div class="category-banner">
        <div class="d-table">
           
            <div class="d-table-cell">
                <div class="container">
                    <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="category-overlay">
                   <img src="<?php echo $header_image; ?>" class="category-img" alt="Course">
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                   <div class="content-header">
                       <div class="content">
                       <h3><?php echo $heading; ?></h3>
                      
                       <p><?php echo $row['course_short_description']; ?></p>
                      <a href="registration.php?course_id=<?php echo $row['course_id']; ?>" class="btn btn-white">Enroll Today</a>
                      </div>
                   </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="courses-area ptb-25 bg-f9faff">
        <div class="container">
            
            
             <div class="row" style="margin-top:30px;">
                
                <div class="col-lg-9 col-md-9">
                   <div class="content">
                        <h3>Course Overview</h3>
                        
                        <p><?php echo $row['course_description']; ?></p><br>
                        <?php 
                            $vid1=$row['video_url1'];
                            $vid2=$row['video_url2'];
                            $vid3=$row['video_url3'];
                            $vid4=$row['video_url4'];
                            $vid5=$row['video_url5'];
                            if($vid1 != '' || $vid2 != '' || $vid3 != '' || $vid4 != '' || $vid5 != ''){
                            ?>
                        <div class="course-slider-bl">
                            
                                        <div class="course-slider arrow-btn">
                                            <?php
                        			          if($vid1 != '')
                                              {
                                            ?>
                                            
                                            <div class="course-slider-img">
                                                <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $vid1 ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                
                                            </div>
                                            <?php
                                              }
                                             if($vid2 != '')
                                              {
                                            ?>
                                            <div class="course-slider-img">
                                                <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $vid2 ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                
                                            </div>
                                            <?php
                                              }
                                             if($vid3 != '')
                                              {
                                            ?>
                                            <div class="course-slider-img">
                                                <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $vid3 ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                
                                            </div>
                                            <?php
                                              }
                                             if($vid4 != '')
                                              {
                                            ?>
                                            <div class="course-slider-img">
                                                <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $vid4 ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                
                                            </div>
                                            <?php
                                              }
                                             if($vid5 != '')
                                              {
                                            ?>
                                            <div class="course-slider-img">
                                                <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $vid5 ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                
                                            </div>
                                            
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                   </div>
                </div>
                <div class="col-lg-3 col-md-3">
                <div class="sidebar">
                    <?php
                        $cf1=$row['feature_1'];
                        $cf2=$row['feature_2'];
                        $cf3=$row['feature_3'];
                        $cf4=$row['feature_4'];
                        $cf5=$row['feature_5'];
                        if($cf1 != '' || $cf2 != '' || $cf3 != '' || $cf4 != '' || $cf5 != '' ){
                    ?>
                    
                    <h4>Course Features</h4>
                    <?php } ?>
                    <ul class="list1">
                        <?php if($cf1 != ''){ ?>
                        <li><?php echo $cf1; ?></li>
                        <?php
                        }
                        if($cf2 != ''){
                        ?>
                        <li><?php echo $cf2; ?></li>
                        <?php
                        }
                        if($cf3 != ''){
                        ?>
                        <li><?php echo $cf3; ?></li>
                        <?php
                        }
                        if($cf4 != ''){
                        ?>
                        <li><?php echo $cf4; ?></li>
                        <?php
                        }
                        if($cf5 != ''){
                        ?>
                        <li><?php echo $cf5; ?></li>
                        <?php
                        }
                        ?>
                    </ul>
                    <br>
                    <h4>Information</h4>
                    <p><?php echo $row['other_details']; ?></p>
                    <br>
                    <a href="registration.php?course_id=<?php echo $row['course_id']; ?>" class="btn btn-white" style="font-size: 12px;padding: 10px 0;">Enroll Today</a>
                </div>
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
    
    <!--<section id="eduservices-blog" class="recent-blog-section ptb-100">-->
    <!--    <div class="container">-->
    <!--        <div class="section-title">-->
    <!--            <h2>Follow Classes for <?php echo $row['course_name']; ?></h2>-->
    <!--            <span>Checckout our Follow Classes</span>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="news-grids blog-slider reveal-bottom-fade">-->
            <?php
                                
                                // $resulttab = $model_obj->get_follow_classes_by_course($course_id);
                                // if (!empty($resulttab)){
                                    
                                // while($rowtab = $resulttab->fetch_assoc()) {  
                                //     $followclassid=$rowtab['follow_time_slot_id'];
                                    

                                ?>
    <!--        <div class="grid">-->
    <!--            <div class="entry-media">-->
    <!--                <img src="admin/uploaded_files/<?php echo $rowtab['image']; ?>" alt>-->
    <!--            </div>-->
    <!--            <div class="entry-details">-->
    <!--                <ul>-->
    <!--                    <li><a href="follow_class.php?followclassid=<?php echo $followclassid; ?>" class="btn btn-white">Book Now</a></li>-->
    <!--                    <li><a href="follow_class.php?followclassid=<?php echo $followclassid; ?>"><i class="icofont-ui-clock"></i> <?php echo $rowtab['follow_date']; ?></a></li>-->
    <!--                </ul>-->
    <!--                <h3><a href="follow_class.php?followclassid=<?php echo $followclassid; ?>"><?php echo $rowtab['class_name']; ?></a></h3>-->
                    
    <!--            </div>-->
    <!--        </div>-->
             <?php // }} ?>
    <!--    </div>-->
        
    <!--</section>-->
  
    
<?php
include 'footer.php';
?>