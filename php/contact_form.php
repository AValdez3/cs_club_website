<?php
  require 'vendor/autoload.php';
  require_once 'class.smtp.php';

  if(isset($_POST['email']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['message'])) {
    if($_POST['email'] !== "" && $_POST['firstname'] !== "" && $_POST['lastname'] !== "" && $_POST['message'] !== "") {
      $firstname=$_POST['firstname'];
      $lastname=$_POST['lastname'];
      $email=$_POST['email'];
    } else {
      http_response_code(400);
      exit("Invalid submission.");
    }

    // Start emailing
    $newEmail = new PHPMailer;

    $name = $_POST['firstname'] . " " . $_POST['lastname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $newMessage = <<<EOT
    Name: <strong>{$name}</strong><br />
    Message: <p>{$message}</p>
EOT;

    $newEmail->From = $email;
    $newEmail->FromName = $name;
    $newEmail->Subject = "Message from CSClub Website: " . $name;
    $newEmail->Body = $newMessage;
    $newEmail->IsHTML(true);
    
    $newEmail->AddAddress('contactcsclub@gmail.com');
    $newEmail->AddAddress('#'); //add a valid email address here
    //$newEmail->AddAddress('anotherRecipient@example.com');

    if(!$newEmail->send()) {
      //do error stuff
    } else {
      http_response_code(200);
      echo "Message sent";
    }
  } else {
    exit("Invalid Submission. Please Try Again.");
  }
?>
