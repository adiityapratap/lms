<?php
 include 'model.php';

$first_name= $_POST['firstname'];
$last_name= $_POST['lastname']; 
$student_email= $_POST['email'];
$student_phone= $_POST['phone'];
$password=md5($_POST['password']);


$sql = "INSERT INTO students (first_name, last_name, student_email, password, student_phone)
VALUES ('$first_name', '$last_name', '$student_email','$password', '$student_phone')";

if ($conn->query($sql) > 0) {
         $last_id = $conn->insert_id;

         
         $_SESSION['lms_email']=$student_email;
         $_SESSION['lms_name']=$first_name;
         $_SESSION['lms_student_id']=$last_id;
         
            $to_admin = "info@excellenceacademyofmusic.com";
            $subject_admin = "New Student Registration";
            
            $message_admin="";
            $message_admin.= "<html><head><title>New Student Registration</title></head><body><p>New Student Details</p><table>";
            $message_admin.= "<tr><td><strong>First Name: </strong></td><td>". $first_name ."</td></tr>";
            $message_admin.= "<tr><td><strong>Last Name: </strong></td><td>".$last_name."</td></tr>";
            $message_admin.= "<tr><td><strong>Email: </strong></td><td>".$student_email."</td></tr>";
            $message_admin.= "<tr><td><strong>Contact: </strong></td><td>".$student_phone."</td></tr>";
            $message_admin.= "</table></body></html>";
            
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: <noreply@excellenceacademyofmusic.com>' . "\r\n";
            
            mail($to_admin,$subject_admin,$message_admin,$headers);
            
            //Mail For Student
            
            $to_student = $student_email;
            $subject_student = "Welcome To Excellence Academy of Indian Music.";
            
            $message_student = "Thanks For Registration.";
            
            mail($to_student,$subject_student,$message_student,$headers);
            
        echo"<script>alert('check your email ".$student_email."')</script>";    
        echo"<script>window.location.href='index.php'</script>";
       
} else {
        //  echo "Error: " . $sql . "<br>" . $conn->error;
        echo"<script>window.location.href='signup.php'</script>";
}
?>