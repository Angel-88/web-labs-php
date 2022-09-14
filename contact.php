<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $emailTo = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $emailFrom = "dasha.zagrebelna88@gmail.com";
    $headers = "From: ".$emailFrom;
    $txt = "You have received an e-mail from ".$name.".\n\n".$message;

        if(mail($emailTo, $subject, $txt, $headers)) {
            header("Location: /");
        } else {
            echo "Sorry, fail to send email.";
        }
}
?>