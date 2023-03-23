<?php
   
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $message = "<center><u><b><h4>New Contact</h4></b></u>Name :<b>".$name."</b><br>phone : <b>".$phone."</b><br>email : <b>".$email."</b><br>subject : <b>".$subject."</b><br>message : <b>".$message."</b>";
    $to = "anandak@outlook.com";
    // $headers = "From: test@amizhtham.com \r\n";
    // $headers .= "Reply-To: test@test.com \r\n";
    // $headers .= "MIME-Version: 1.0\r\n";
    // $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  
    mail($to, $subject, $message);
    
    ?>