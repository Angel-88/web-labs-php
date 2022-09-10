<?php

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $emailFrom = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $emailTo = "dasha.zagrebelna88@gmail.com";
        $headers = "From: ".$emailFrom;
        $txt = "You have received an e-mail from ".$name.".\n\n".$message;

//        mail($emailTo, $subject, $txt, $headers);

        if(mail($emailTo, $subject, $txt, $headers)) {
            header("Location: /");
        } else {
            echo "Sorry, fail to send email.";
        }
    }
?>