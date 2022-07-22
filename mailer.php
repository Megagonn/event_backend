<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Include the Composer generated autoload.php file. */
// include('C:/xampp/composer/vendor/autoload.php';

/* If you installed PHPMailer without Composer do this instead: */

include('PHPMailer/src/Exception.php');
include('PHPMailer/src/PHPMailer.php');
include('PHPMailer/src/SMTP.php');

function mailme($address,$username,$title,$text,$type){
/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);

/* Open the try/catch block. */
try {
   /* Set the mail sender. */
   $mail->isSMTP();
   $mail->Host = 'smtp.mailgun.org';
   $mail->Port = 587;
   $mail->SMTPAuth = true;
   $mail->SMTPSecure = 'tls';


/* Username (email address). */  
   if($type=='welcome'){
      $username = 'welcome@ordaley.com';
      $password = '6da114f28467f61af7166ba9d13b98fc-602cc1bf-7e47fcaa';
   }
   else if($type=='event'){
      $password = '5c8caa5f8292a74a41681b59e4d9dc4d-602cc1bf-fd9f1f0d';
      $username = 'event@ordaley.com';
   }
   else if($type=='validate'){
      $username = 'validate_email@ordaley.com';
      $password = 'eb5d706acd04ac18eb0b6e13bf63a8e4-602cc1bf-01d3a4c8';
   }
   else {
      $username = 'waitlist@ordaley.com';
      $password = '0e28de02c5c8f0bbcec218626b8d332d-4b1aa784-0671c951';
   }

   $mail->Username = $username;
   $mail->Password = $password;
   // $mail->Username = 'welcome@ordaley.com';

/* Google account password. */
  
//   $mail->Password = 'eb5d706acd04ac18eb0b6e13bf63a8e4-602cc1bf-01d3a4c8';
//   $mail->Password = '6da114f28467f61af7166ba9d13b98fc-602cc1bf-7e47fcaa';
   
  
   $mail->setFrom($username, 'Ordaley');

   /* Add a recipient. */
   $mail->addAddress($address, $username);

   /* Set the subject. */
   $mail->Subject = $title;
    $mail->isHTML(true);
   /* Set the mail message body. */
   $mail->Body = $text;
   
      /* <html>
         <body>
            <img src="https://budgetty.netlify.app/logo.png" width=50px height=50px/>
            <h2>Hi '.$username.'</h2>
               Thanks for creating account on BudgetApp.<br>
               For Security purposes,Please click the link below to verify your email address.

              <a href="https://budgetty.netlify.app/#/verify/'.$token.'"> https://budgetty.netlify.app/#/verify/'.$token.'</a>
              <br/>
              Happy Budgetting,
              The BudgetApp Team.

              <footer>
               Email : budgetty.app@gmail.com 
               &copy; 2020 Swipe Inc
              </footer>
            </body>
      </html>
   ';

   /* Finally send the mail. */
   $mail->send();
   return true;
}
catch (Exception $e)
{
  
   
   
   return $e->errorMessage();
   
}

}
?>