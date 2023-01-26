<?php
error_reporting(0);
mb_internal_encoding("UTF-8");

// Check if the form has been submitted and the email field is not empty
if (isset($_POST['email']) && !empty($_POST['email'])) {
  // The 'email' field has content and is not empty, we can proceed with sending the email
  if (isset($_COOKIE['form_submitted'])) {
    // The form has already been submitted from this IP address, reject the submission

    header('Location: http://nabor.tomorion.cz/?success=2'); exit;
  } else {
    // Set the headers for sending the email and send it
    $sender = mb_encode_mimeheader('Náborová stránka').' <naborova@tomorion.cz>';
    $to = mb_encode_mimeheader('Náborový email').' <nabor@tomorion.cz>';
    $subject = mb_encode_mimeheader('nabormail', 'UTF-8', 'Q');
    $message = 'Email: ' . $_POST['email'] . "\n\n" .
      'Čas odeslání: ' . date('d.m.Y H:i:s');
    $headers = 'From: ' . $_POST['email'] . "\n" .
      'Reply-To: ' . $_POST['email'] . "\n" .
      'X-Mailer: PHP/' . phpversion();
    if (mb_send_mail($to, $subject, $message, $headers)) {
      // Email was sent successfully, set cookie for 1 day
      setcookie('form_submitted', 'true', time() + 86400);
      header('Location: http://nabor.tomorion.cz/?success=1'); exit;
    } else {
      // There was an error sending the email
      header('Location: http://nabor.tomorion.cz/?success=0'); exit;
    }
  }
} else {
  // The email field is empty, display an error message
  header('Location: http://nabor.tomorion.cz/?success=3'); exit;
}

?>
