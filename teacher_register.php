<?php
include 'model.php'; 
$firstname =$_POST['firstname'];
$lastname =$_POST['lastname'];
$email =$_POST['email'];
$contact =$_POST['contact'];
$teacher_course =$_POST['teacher_course'];

$teacher_resume =$_FILES['teacher_resume']['name'];
$new_name = uniqid().'_'.$teacher_resume;
$new_name = preg_replace('/\s+/', '_', $new_name);
$new_name=strtolower($new_name);
$target_dir = "admin/uploaded_files/";
$target_file = $target_dir . basename($new_name);

  if (move_uploaded_file($_FILES['teacher_resume']['tmp_name'], $target_file)) {
      $sql = "INSERT INTO tbl_user (acc_type, firstname, lastname, email, contact, teacher_course, teacher_resume)
        VALUES ('2','$firstname','$lastname','$email','$contact','$teacher_course','$new_name')";
        
        if ($conn->query($sql) > 0) {
            
            $to_admin = "sree03m@gmail.com";
            $subject_admin = "New Teacher Registration";
            
            $message_admin="";
            $message_admin.= "<html><head><title>New Teacher Registration</title></head><body><p>New Teacher Details</p><table>";
            $message_admin.= "<tr><td><strong>First Name: </strong></td><td>". $firstname ."</td></tr>";
            $message_admin.= "<tr><td><strong>Last Name: </strong></td><td>".$lastname."</td></tr>";
            $message_admin.= "<tr><td><strong>Email: </strong></td><td>".$email."</td></tr>";
            $message_admin.= "<tr><td><strong>Contact: </strong></td><td>".$contact."</td></tr>";
            $message_admin.= "<tr><td><strong>Course: </strong></td><td>".$teacher_course."</td></tr>";
            $message_admin.= "</table></body></html>";
            
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: <info@excellenceacademyofmusic.com>' . "\r\n";
            
            mail($to_admin,$subject_admin,$message_admin,$headers);
            
            //Mail For Teacher
            
            $to_teacher = $email;
            $subject_teacher = "Welcome To LMS.";
            
            $message_teacher = " Thanks For Registration.";
            
            mail($to_teacher,$subject_teacher,$message_teacher,$headers);
            echo"<script>alert('check your email ".$email."')</script>";
            echo"<script>window.location.href='index.php'</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
  } else {
    echo " Sorry, there was an error uploading your resume.";
    
  }  
  

?>