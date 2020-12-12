<?php

   $server = 'localhost';
    $uname = 'u781210117_lms_db';
    $pass = '6v$[O@Qj@2P';
    $db = 'u781210117_lms_db';
    
       $conn = new mysqli($server, $uname, $pass, $db);
       if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
        }

?>