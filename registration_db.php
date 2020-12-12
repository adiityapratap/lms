<?php
 include 'model.php';

$course_id= $_POST['course_id'];
$first_name= $_POST['firstname'];
$last_name= $_POST['lastname']; 
$student_email= $_POST['email'];
$student_phone= $_POST['phone'];
$address= $_POST['address'];
$address2= $_POST['address2'];
$state= $_POST['state'];
$zip_code= $_POST['zip_code'];
$country= $_POST['country'];


$sql = "INSERT INTO students (first_name, last_name, course_id, student_email, student_phone, address, address2, state, zip_code, country)
VALUES ('$first_name', '$last_name', '$course_id', '$student_email', '$student_phone', '$address', '$address2', '$state','' '$zip_code', '$country')";

if ($conn->query($sql) > 0) {
         $last_id = $conn->insert_id;

         
         $_SESSION['lms_email']=$student_email;
         $_SESSION['lms_name']=$first_name;
         $_SESSION['lms_student_phone']=$student_phone;
         $_SESSION['lms_student_id']=$last_id;
         
        //     $to_admin = "sree03m@gmail.com";
        //     $subject_admin = "New Student Registration";
            
        //     $message_admin="";
        //     $message_admin.= "<html><head><title>New Student Registration</title></head><body><p>New Student Details</p><table>";
        //     $message_admin.= "<tr><td><strong>First Name: </strong></td><td>". $first_name ."</td></tr>";
        //     $message_admin.= "<tr><td><strong>Last Name: </strong></td><td>".$last_name."</td></tr>";
        //     $message_admin.= "<tr><td><strong>Email: </strong></td><td>".$student_email."</td></tr>";
        //     $message_admin.= "<tr><td><strong>Contact: </strong></td><td>".$student_phone."</td></tr>";
        //     $message_admin.= "</table></body></html>";
            
        //     // Always set content-type when sending HTML email
        //     $headers = "MIME-Version: 1.0" . "\r\n";
        //     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
        //     // More headers
        //     $headers .= 'From: <noreply@excellenceacademyofmusic.com>' . "\r\n";
            
        //     mail($to_admin,$subject_admin,$message_admin,$headers);
            
        //     //Mail For Student
            
        //     $to_student = $student_email;
        //     $subject_student = "Welcome To Excellence Academy of Indian Music.";
            
        //     $message_student = "Thanks For Registration.";
            
        //     mail($to_student,$subject_student,$message_student,$headers);
            
        // echo"<script>alert('check your email ".$student_email."')</script>";

        header('Location: free_trial.php?course_id='.$course_id);
      
       
} else {
        //  echo "Error: " . $sql . "<br>" . $conn->error;
        header('Location: registration.php?error=1');
       
}
?>