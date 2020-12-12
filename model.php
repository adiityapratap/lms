<?php 
session_start();
include 'db_connection.php';  
class model{
    
public function __construct(){
     ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 include 'db_connection.php'; 
 
 //store conn data value in this variable so that we can use it any methd of this class
 $this->model_files_conn = $conn;
    
   
}
public function get_courses($course_id){
    
       if($course_id != ''){
           $condition="where course_id = ".$course_id;
       }
       else{
           $condition='';
       }
       
        $qry = "SELECT * from courses ". $condition;
       
       $res = $this->model_files_conn->query($qry);
       if ($res->num_rows > 0) {
           return $res;
       }else{ 
           return 0; 
       }
}
public function get_trial_time_slots($course_id,$trial_date){
        if($course_id != '' && $trial_date !=''){
           $condition="where course_id = ".$course_id." and trial_date = '".$trial_date."'";
        }
        else{
           $condition='';
        }
       
        $qry = "SELECT * from trial_class_time_slots ". $condition;
   
        $res = $this->model_files_conn->query($qry);
        if ($res->num_rows > 0) {
           return $res;
        }else{ 
           return "No  slot availabel for this day "; 
        }
}

 
 public function get_trial_date($course_id){
     
        if($course_id != ''){
           $condition="where fc.course_id = ".$course_id;
        }
        else{
           $condition='';
        }
       
        $qry = "SELECT * from trial_class_time_slots as fc LEFT JOIN courses as c ON fc.course_id=c.course_id ". $condition;
        
        $res = $this->model_files_conn->query($qry);
        
        if ($res->num_rows > 0) {
           return $res;
        }else{  
           return 0; 
        }
}
public function get_trial_details($time_slot_id){
     
   if($time_slot_id != ''){
      $condition="where fc.trial_time_slot_id = ".$time_slot_id;
   }
   else{
      $condition='';
   }
  
   $qry = "SELECT * from trial_class_time_slots as fc LEFT JOIN courses as c ON fc.course_id=c.course_id ". $condition;
   
   $res = $this->model_files_conn->query($qry);
  
   if ($res->num_rows > 0) {
      return $res;
   }else{  
      return 0; 
   }
}
function get_booking_trial_slot($course_id){
	if($course_id != ''){
        $condition="where course_id = ".$course_id." AND student_id = ".$_SESSION['lms_student_id'] ;
    }
    else{
        $condition='';
    }
	$qry = "SELECT * from booking_trial_class ". $condition;
        
    $res = $this->model_files_conn->query($qry);
       
    if ($res->num_rows > 0) {
        return $res;
    }else{  
        return 0; 
    }
}
 public function get_trial_date_slot($date){
        
        if($date != ''){
           $condition="where trial_date = '".$date."'";
        }
        else{
           $condition='';
        }
       
        $qry = "SELECT * from trial_class_time_slots ". $condition;
        
        $res = $this->model_files_conn->query($qry);
         
        if ($res->num_rows > 0) {
           return $res;
        }else{ 
           return 0; 
        }
}


 public function get_follow_classes($followclassid=''){
    if($followclassid != ''){
           $condition="where fc.follow_time_slot_id = '".$followclassid."'";
       }
       else{
           $condition='';
       }
       
       $qry = "SELECT * from follow_class_time_slots as fc LEFT JOIN courses as c ON fc.course_id=c.course_id ". $condition;
     
       $res = $this->model_files_conn->query($qry);
       if ($res->num_rows > 0) {
           return $res;
       }else{ 
           return 0; 
       }
}
public function get_follow_classes_by_course($course_id=''){
    if($course_id != ''){
           $condition="where course_id = ".$course_id;
       }
       else{
           $condition='';
       }
       
        $qry = "SELECT * from follow_class_time_slots ". $condition;
       
       $res = $this->model_files_conn->query($qry);
       if ($res->num_rows > 0) {
           return $res;
       }else{ 
           return 0; 
       }
}
function insert_trial_data($course_id,$time_slot_id,$time_slot){
        
        $student_id=$_SESSION['lms_student_id'];
    
        $sql = "INSERT INTO booking_trial_class (student_id, course_id, time_slot_id, time_slot)
        VALUES ('$student_id','$course_id','$time_slot_id','$time_slot')";
        if ($this->model_files_conn->query($sql) > 0) {
          return true;
        } else {
          return false;
        }
     }

 public function get_follow_date($course_id){
     
        if($course_id != ''){
           $condition="where fc.course_id = ".$course_id;
        }
        else{
           $condition='';
        }
       
        $qry = "SELECT * from follow_class_time_slots as fc LEFT JOIN courses as c ON fc.course_id=c.course_id ". $condition;
        
        $res = $this->model_files_conn->query($qry);
        
        if ($res->num_rows > 0) {
           return $res;
        }else{ 
           return 0; 
        }
}

public function get_follow_time_slots($course_id,$follow_date){
        if($course_id != '' && $follow_date !=''){
           $condition="where course_id = ".$course_id." and follow_date = '".$follow_date."'";
        }
        else{
           $condition='';
        }
       
        $qry = "SELECT * from follow_class_time_slots ". $condition;
   
        $res = $this->model_files_conn->query($qry);
        if ($res->num_rows > 0) {
           return $res;
        }else{ 
           return "No  slot availabel for this day "; 
        }
}
function insert_follow_data($course_id,$time_slot_id,$time_slot){
        
        $student_id=$_SESSION['lms_student_id'];
    
        $sql = "INSERT INTO  booking_follow_class (student_id, course_id, time_slot_id, time_slot)
        VALUES ('$student_id','$course_id','$time_slot_id','$time_slot')";
        if ($this->model_files_conn->query($sql) > 0) {
          return true;
        } else {
          return false;
        }
     }
function checkclassstatus($course_id){
    
    $student_id=$_SESSION['lms_student_id'];
    
    if($course_id != ''){
           $condition="where course_id = ".$course_id." and student_id = ".$student_id;
        }
        else{
           $condition='';
        }
       
        $qry = "SELECT status from booking_trial_class ". $condition;
   
        $res = $this->model_files_conn->query($qry);
        if ($res->num_rows > 0) {
           return $res;
        }else{ 
           return 0; 
        }
}
function get_videos_content($name){
    
    if($name != ''){
           $condition="where name = '".$name."'";
        }
        else{
           $condition='';
        }
       
        $qry = "SELECT * from video_content ". $condition;
   
        $res = $this->model_files_conn->query($qry);
        if ($res->num_rows > 0) {
           return $res;
        }else{ 
           return 0; 
        }
}
function get_testimonials(){
    
        $qry = "SELECT * from testimonials";
   
        $res = $this->model_files_conn->query($qry);
        if ($res->num_rows > 0) {
           return $res;
        }else{ 
           return 0; 
        }
}
public function get_student($student_id){
     
   if($student_id != ''){
      $condition="where st.student_id = ".$student_id;
   }
   else{
      $condition='';
   }
  
   $qry = "SELECT * from students as st LEFT JOIN courses as c ON st.course_id=c.course_id ". $condition;
   
   $res = $this->model_files_conn->query($qry);
   
   if ($res->num_rows > 0) {
      return $res;
   }else{ 
      return 0; 
   }
}

}


//to call methods of this class from any file

 $model_obj = new model(); 


?>
