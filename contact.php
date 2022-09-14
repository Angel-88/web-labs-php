<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';


$mail = new PHPMailer(true);

$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;

$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->CharSet = "UTF-8";

if (isset($_POST['submit'])) {

    try {

        $senderEmail = 'dasha.zagrebelna88@gmail.com';
        $name = $_POST['name'];
        $address = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $mail->setFrom($senderEmail, 'Daria Zahrebelna');
        $mail->Username = $senderEmail;
        $mail->Password = "oyhkpiqwedvdtatc";
        $mail->addReplyTo($senderEmail, 'Daria Zahrebelna');
        $mail->addAddress($address, $name);
        $mail->Subject = $subject;

        $mail->isHTML(true);
        $mail->msgHTML($message);
        $mail->Body = $message;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>