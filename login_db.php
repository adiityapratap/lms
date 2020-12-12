<?php
 include 'model.php';
 
$email= $_POST['email'];
$password=md5($_POST['password']);


$sql = "select * from students where student_email = '".$email. "' AND password = '".$password."'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
         $_SESSION['lms_email']=$email;
         $_SESSION['lms_name']=$row['first_name'];
         $_SESSION['lms_student_id']=$row['student_id'];
         echo"<script>window.location.href='index.php'</script>";
} else {

       header('Location: login.php?error=0');
}
?>