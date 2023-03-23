
<?php
 
if(isset($_POST['button']) && isset($_FILES['attachment']))
{

    //Load POST data from HTML form
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $Subject = "Need for a job";

    $from_email = $_POST['email'];
    $reply_to_email = $_POST['email'];

    $from_email         = $email; //from mail, sender email address
    $recipient_email = 'anandak@outlook.com'; //recipient email address
 
    $message = "Please find my attachment below";
    $message = "<center><u><b><h4>New Contact</h4></b></u>Name :<b>".$name."</b><br>phone : <b>".$phone."</b><br>email : <b>".$email."</b><br>subject : <b>".$subject."</b><br>message : <b>".$message."</b>";
   
    //Get uploaded file data using $_FILES array
    $tmp_name = $_FILES['attachment']['tmp_name']; // get the temporary file name of the file on the server
    $name     = $_FILES['attachment']['name']; // get the name of the file
    $size     = $_FILES['attachment']['size']; // get size of the file for size validation
    $type     = $_FILES['attachment']['type']; // get type of the file
    $error     = $_FILES['attachment']['error']; // get the error (if any)
 
    //validate form field for attaching the file
    if($error > 0)
    {
        die('Upload error or No files uploaded');
    }
 
    //read from the uploaded file & base64_encode content
    $handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
    $content = fread($handle, $size); // reading the file
    fclose($handle);                 // close upon completion
 
    $encoded_content = chunk_split(base64_encode($content));
    $boundary = md5("random"); // define boundary with a md5 hashed value
 
    //header
    $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
    $headers .= "From:".$from_email."\r\n"; // Sender Email
    $headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email address to reach back
    $headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type
    $headers .= "boundary = $boundary\r\n"; //Defining the Boundary
         
    //plain text
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= chunk_split(base64_encode($message));
         
    //attachment
    $body .= "--$boundary\r\n";
    $body .="Content-Type: $type; name=".$name."\r\n";
    $body .="Content-Disposition: attachment; filename=".$name."\r\n";
    $body .="Content-Transfer-Encoding: base64\r\n";
    $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
    $body .= $encoded_content; // Attaching the encoded file with email
     
    $sentMailResult = mail($recipient_email, $subject, $body, $headers);
 
    if($sentMailResult )
    {
    echo "<h3>File Sent Successfully.<h3>";
    // unlink($name); // delete the file after attachment sent.
    }
    else
    {
    die("Sorry but the email could not be sent.
                    Please go back and try again!");
    }
}
?>