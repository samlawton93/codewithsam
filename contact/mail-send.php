<?php
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php');
require_once('PHPMailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;

function sendConfirmation($to, $fields) {
  $mail = new PHPMailer;
  $mail->IsSMTP();
  $mail->Host     = 'tls://smtp.ionos.com:587';
  $mail->SMTPAuth = true;
  $mail->Username = 'hello@codewithsam.co.uk';
  $mail->Password = '*Cookies1';
  $mail->From     = 'hello@codewithsam.co.uk';
  $mail->FromName = 'Code With Sam';
  $mail->IsHTML(true);

  if ($to == 'sam') {
      $mail->AddAddress('hello@codewithsam.co.uk');
      $mail->Subject = 'New Enquiry';
      $mailBody = 'A new enquiry has been submitted.<br /><br />';

      foreach ($fields as $fieldName => $fieldValue) {
          $mailBody .= '<strong>' . $fieldName . '</strong>: ' . $fieldValue . '<br />';
      }

      $mail->Body = $mailBody;
  } else {
      $mail->AddAddress($fields['Email']);
      $mail->Subject = 'Thanks for your submission';
      $mailBody = 'Here is a copy of your submission.<br /><br />';

      foreach ($fields as $fieldName => $fieldValue) {
          $mailBody .= '<strong>' . $fieldName . '</strong>: ' . $fieldValue . '<br /><br />I will review your submission and call you back shortly.';
      }

      $mail->Body = $mailBody;
  }

  $mail->Send();
}
