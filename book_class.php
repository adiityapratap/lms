<?php
        include 'model.php';
        
        if(empty($_SESSION['lms_email'])){
            header('location: login.php'); 
         } 
        if(isset($_GET['followclassid']))
        {
            $followclassid=$_GET['followclassid'];
        }
        else{
             $followclassid='';
        }
        if(isset($_GET['course_id']))
        {
            $course_id=$_GET['course_id'];
        }
        else{
             $course_id='';
        }
        
        $resultstatus = $model_obj->checkclassstatus($course_id);
        $rowstatus = $resultstatus->fetch_assoc();
        if($rowstatus['status'] == 0){
             header('location: course.php?course_id='.$course_id); 
        }
        
        $result = $model_obj->get_follow_classes($followclassid);
        $row = $result->fetch_assoc();
       
        ?>
<!doctype html>
<html lang="en">
<head>
    
       <title>LMS - Follow Class - <?php echo $row['class_name']; ?></title>
    
<?php
include 'header.php';

    function booking_calendar($month,$year,$model_obj,$course_id){
        
        $followdate= array(); 
         $slot= array(); 
        $resultdate = $model_obj->get_follow_date($course_id);

        if(!empty($resultdate)){
        while($rowdate = $resultdate->fetch_assoc()){
            $followdate[]=$rowdate['follow_date'];   
        }
           
        $daysOfWeek = array('SUN','MON','TUE','WED','THU','FRI','SAT');

        $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

        $numberDays = date('t',$firstDayOfMonth);

        $dateComponents = getdate($firstDayOfMonth);

        $monthName = $dateComponents['month'];

        $dayOfWeek = $dateComponents['wday'];

        $dateToday = date('Y-m-d');

        $calendar ="<table border='1' colspan='0' class='trail_calender'>";
        $calendar.="<h2 class='cal_title'><span>Select Date:</span><span style='float:right'>$monthName $year</span></h2>";
        $calendar.="<tr class='border-btm'>";
        
        foreach($daysOfWeek as $day){
            $calendar.="<th>$day</th>";
        }
        $calendar.="<tr><tr>";

        if($dayOfWeek > 0){
            for($k=0;$k<$dayOfWeek;$k++){
                    $calendar.="<td></td>";
            }
        }

        $currentDay = 1;
        $month = str_pad($month, 2,"0", STR_PAD_LEFT);

        while($currentDay <= $numberDays){

            if($dayOfWeek == 7){
                $dayOfWeek=0;
                $calendar.="<tr></tr>";
            }
                $currentDayRel = str_pad($currentDay, 2,"0", STR_PAD_LEFT);
                $date = "$year-$month-$currentDayRel";
                $today = $date==date('Y-m-d')?"today":"";
               if($date<date('Y-m-d')){
                    $calendar.="<td class='disable_day'><h4>$currentDay</h4>";
                     $calendar.="<span class='disable_btn'>N/A</span>";
               }
            //   elseif($dateToday == $date){
            //     $calendar.="<td class='enable_day today' onclick='selectdate(this,$year, $month, $currentDayRel)'><h4>$currentDay</h4>";
            //     $calendar.="<span class='book_now_btn'>Book</span>";
            //   } 
              elseif(in_array($date,$followdate)){
                  
                     
                            
                //         }
                //         }
                        
                  $calendar.="<td class='enable_day' onclick='selectdate(this,$year, $month, $currentDayRel)'><h4 >$currentDay</h4>";
                    $calendar.="<span class='book_now_btn'>Book</span>";
              }
               else{
                    $calendar.="<td class='disable_day'><h4 >$currentDay</h4>";
                     $calendar.="<span class='disable_btn'>N/A</span>";
                    // $calendar.="<td class='enable_day' onclick='selectdate(this,$year, $month, $currentDayRel)'><h4 >$currentDay</h4>";
                    // $calendar.="<span class='book_now_btn'>Book</span>";
               }
                $calendar.="</td>";
                
                $currentDay++;
                $dayOfWeek++;
        }

        if($dayOfWeek != 7){
            $remainingDays = 7-$dayOfWeek;
            for($i=0; $i<$remainingDays; $i++){
                $calendar.='<td></td>';
            }
        }

        $calendar.="</tr></table>";
        echo $calendar;
        }else{
            echo "No Slot availabel for this course";
        }
    }
?>
    <!--<div class="book_preload">-->
    <!--    <div class="book">-->
    <!--       <div class="book__page"></div>-->
    <!--       <div class="book__page"></div>-->
    <!--       <div class="book__page"></div>-->
    <!--    </div>-->
    <!--</div>-->
    <?php
    include 'navigation.php';
    ?>  
    
    <section id="eduservices-why-choose-us" class="why-choose-us book-section">
        
        <div class="why-choose-us-wrapper-bottom background-opacity">
            <div class="container">
                <div class="wow fadeInUp">
                    <div class="row">
                        
                        <div class="col-lg-6 col-md-6">
                            <div class="booking-form">
                                <?php

                                $dateComponents = getdate();
                                $month = $dateComponents['mon'];
                                $year = $dateComponents['year'];
                                echo booking_calendar($month,$year,$model_obj,$course_id);
                        
                            ?>
                            <input type="hidden" name="follow_date" value="" id="follow_date" >
							<br>
							<button type="submit" class="contact-btn btn ct-proceed" onclick="fetch_time_slots('<?php echo $course_id ?>')" style="display:none;">Proceed</button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="section-title reveal-right-fade">
                                <!-- section-title -->
                                <h2>Book Now</h2>
                                <p>Follow Class - <?php echo $row['course_name']; ?></p>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </section>
    

    
    <script>
    function selectdate(obj,follow_year, follow_month, follow_day){
        var follow_date = follow_year + '-'+ follow_month + '-'+ follow_day;
        $('#follow_date').val(follow_date);
        $('.enable_day').removeClass('select_day');
        $(obj).addClass('select_day');
        $('.ct-proceed').css('display','block');
        
        
    }
    function fetch_time_slots(course_id=''){
      
        var follow_date= $('#follow_date').val();
        $.ajax({
            type: "POST",
            url: "html_code.php",
            data:'course_id='+course_id+'&follow_date='+follow_date+'&method_name=get_follow_time_slots',
            success: function(data){
                 $(".booking-form").html(data);
              
            }
        });
    }
    
    function fetch_form(course_id,time_slot_id,time_slot=''){
        $.ajax({
            type: "POST",
            url: "html_code.php",
            data:'course_id='+course_id+'&time_slot_id='+time_slot_id+'&time_slot='+time_slot+'&method_name=create_follow_form',
            success: function(data){
                 $(".booking-form").html(data);
              
            }
        });
    }
</script>
<?php
include 'footer.php';
?>