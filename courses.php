<?php
session_start();
?>
<!doctype html>
<html lang="en">
    
<head>
       <title>Categories</title>
    
<?php
include 'header.php';
include 'model.php'; 
?>
  
    <?php
    include 'navigation.php';
    ?>  
    
    <div id="eduservices-home" class="main-banner main-banner-show inner-header" style="background:url(assets/img/whybg.jpg);">
        <div class="d-table">
           
            <div class="d-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 reveal-left-fade">
                            <div class="hero-content2">
                                 <h2>Our Categories</h2>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="boxes-area">
        <div class="container">
            <div class="row">
                <?php
                                $course_id='';
                                $resulttab = $model_obj->get_courses($course_id);
                                if (!empty($resulttab)){
                                while($rowtab = $resulttab->fetch_assoc()) {  
                                    $courseid=$rowtab['course_id'];
                                    $position=40; // Define how many character you want to display.

                                    $description = substr($rowtab['course_description'], 0, $position); 
                                ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <a href="course.php?course_id=<?php echo $courseid; ?>">
                    <div class="course-box">
                        
                            <img src="admin/uploaded_files/<?php echo $rowtab['course_image']; ?>" alt="Course">
                            <div class="content">
                            <h3><?php echo $rowtab['course_name']; ?></h3>
                            <p><?php echo $description; ?></p>
                        </div>
                    </div>
                    </a>
                </div>
                 <?php }} ?>
                </div>
            </div>
        </div>
    </section>
  
    
<?php
include 'footer.php';
?>