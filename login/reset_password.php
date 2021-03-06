<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Execption;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if (isset($_POST['reset-password'])) {

    $mail = $_POST['email'];
    
    if (empty($mail)) {
        header("Location: ../reset.php?error=empty");
        exit();
    }

    $email = filter_var($mail, FILTER_SANITIZE_STRING);
    
    $db = new SQLite3('../sqlite/webapp.db');
    
        $check = $db->prepare("SELECT * FROM token WHERE email = :m");
        $check->bindValue(":m",$email);
        $cresult = $check->execute();
        $crow = $cresult->fetchArray();

        if (empty($crow['token']) && empty($crow['email'])) {
            $token = md5(uniqid(rand(), true));

            $tsql = $db->prepare("INSERT INTO token (email,token,timestamp) VALUES (:email,:token,datetime('now','localtime'))");
            $tsql->bindValue(':email',$email);
            $tsql->bindValue(':token',$token);

            $tresult = $tsql->execute();
        } else {
            $token = md5(uniqid(rand(), true));

            $usql = $db->prepare("UPDATE token SET token = :newtoken, timestamp = datetime('now','localtime') WHERE email = :newemail");
            $usql->bindValue(':newtoken',$token);
            $usql->bindValue(':newemail',$email);
            
            $uresult = $usql->execute();
        }
        // Send mail
        $to = $email;
        $subject = "Reset your Password on SPIE Grades";
        $msg = "
        
        <style>
        .title {
            font-size: 1.4em;
            text-shadow: 2px 2px black;
        }
        .text {
            font-size: 1.0em;
        }
        .link {
            color: blue;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.8em;
        }
        </style>

        <div class='container'><div class='main'><h1 class='title'>Hello,</h1>\n\n <p class='text'>You can reset your password by clicking on the following link:</p>\n\n<a class='link' href='m1igrades.msp.ccsn.ch/new_password.php?token=$token'>Reset Password</a>\n<p style='font-size: 0.7em;color:darkblue;'>-This link is valid for 15 Minutes-</p></div></div>
        ";

        $mail = new PHPMailer(true);

        try {
            // Server
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->SMTPSecure = false;
            $mail->SMTPAutoTLS = false;
            $mail->isSMTP();
            $mail->Host      = '100.100.101.25';
            $mail->Port      = 25;
            // Recipients
            $mail->setFrom('info@grades.spie.ch','Grades-Mailer');
            $mail->addAddress($to,$username);
            // Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            $mail->Body    = $msg;
            $mail->AltBody = $msg;
            header("Location: ../pending.php?email=$email");
            $mail->send();

            // echo 'Message has been sent';
        } catch (Exception $e) {
            header("Location: ../pending.php?email=$email");
            exit();
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
}

if (isset($_POST['new-password'])) {
    $new1 = $_POST['new1'];
    $new2 = $_POST['new2'];
    $passed_token = $_POST['passed_token'];
    
    $db = new SQLite3('../sqlite/webapp.db');

    if (empty($new1) || empty($new2)) {
        header("Location: ../new_password.php?token=$passed_token&error=empty");
        exit();
    }
    if ($new1 != $new2) {
        header("Location: ../new_password.php?token=$passed_token&error=notmatching");
        exit();
    }

    $ksql = $db->prepare("SELECT * FROM token WHERE token = :token");
    $ksql->bindValue(':token',$passed_token);
    $kresult = $ksql->execute();
    $krow = $kresult->fetchArray();

    $passwordHashed = password_hash($new2, PASSWORD_DEFAULT);

    $sql1 = $db->prepare("UPDATE login SET passwd = :newpw WHERE email = :themail");
    $sql1->bindValue(':newpw',$passwordHashed);
    $sql1->bindValue(':themail',$krow['email']);
    $result1 = $sql1->execute();
    $row1 = $result1->fetchArray();

    header("Location: ../account.php?success=newpw");
    exit();
}