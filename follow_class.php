 <?php 
         session_start();
        
        include 'model.php';  
 
        $followclassid=$_GET['followclassid'];
        $result = $model_obj->get_follow_classes($followclassid);
        
        $row = $result->fetch_assoc();
        
        if($row['image'] == '' || $row['image'] == NULL){
            $header_image='assets/img/banner_bg.jpg';
        }
        else{ 
            $header_image='admin/uploaded_files/'.$row['image'];
        }
        
        
    ?>
<!doctype html>
<html lang="en">
    
<head>
       <title>Follow Class - <?php echo $row['class_name']; ?></title>
    
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
                   <img src="admin/uploaded_files/<?php echo $row['image']; ?>" class="category-img" alt="Course">
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                   <div class="content-header">
                       <div class="content">
                       <h3><?php echo $row['class_name']; ?></h3>
                       <ul class="list1"><li><?php echo $row['course_name']; ?></li></ul>
                      
                       <p><p><?php echo $row['class_short_description']; ?></p></p>
                      <a href="book_class.php?followclassid=<?php echo $row['follow_time_slot_id']; ?>&course_id=<?php echo $row['course_id']; ?>" class="btn btn-white">Book Now</a>
                      </div>
                   </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
    
    <section id="eduservices-course" class="courses-area ptb-100 bg-f9faff">
        <div class="container">
             <div class="row" style="margin-top:30px;">
                
                <div class="col-lg-9 col-md-9">
                   <div class="content">
                        <h3>Class Overview</h3>
                        
                        <p><?php echo $row['class_description']; ?></p>
                   </div>
                </div>
                <div class="col-lg-3 col-md-3">
                <div class="sidebar">
                   <?php
                        $cf1=$row['class_feature_1'];
                        $cf2=$row['class_feature_2'];
                        $cf3=$row['class_feature_3'];
                        $cf4=$row['class_feature_4'];
                        $cf5=$row['class_feature_5'];
                        if($cf1 != '' || $cf2 != '' || $cf3 != '' || $cf4 != '' || $cf5 != '' ){
                    ?>
                    
                    <h4>Class Features</h4>
                    
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
                    <?php } ?>
                    <br>
                    <a href="book_class.php?followclassid=<?php echo $row['follow_time_slot_id']; ?>&course_id=<?php echo $row['course_id']; ?>" class="btn btn-white">Book Now</a>
                </div>
                </div>
            </div>
             
        </div>
    </section>
    
    
<?php
include 'footer.php';
?>