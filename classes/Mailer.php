<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mailer
 *
 * @author Saad Arif 
 */
require_once 'php-mailer/PHPMailerAutoload.php';

class Mailer {

    public static function send_mail($name, $email, $confirmation_key) {
        $mail = new PHPMailer;
        $mail->isSMTP();                                   // Set mailer to use SMTP
        $mail->Host = 'smtp.bytenet.co.uk';                // Specify main and backup server
        $mail->SMTPAuth = true;                            // Enable SMTP authentication
        $mail->Username = 'saad';                         // SMTP username
        $mail->Password = '8=p5(X1{*802';                           // SMTP password
        //$mail->SMTPSecure = 'tls';                           // Enable encryption, 'ssl' also accepted

        $mail->From = 'no-reply@ascus.com';
        $mail->FromName = 'Ascus';
        $mail->addAddress($email);  // Add a recipient. Name is optional

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Ascus - Account Confirmation';
        $mail->Body = "Dear $name,<br>"
                . "<br>"
                . "Welcome to Ascus, Please confirm $email as your email address by clicking"
                . " this link: <br>"
                . "<br>"
                . "www.saad.bytenet.co.uk/confirmationpage.php?email=$email&confirmation_key=$confirmation_key"
                . "<br><br> -- ASCUS Team";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;
        }

        echo 'Message has been sent';
    }

}
