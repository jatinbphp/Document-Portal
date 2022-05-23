<?php
namespace App\Libraries;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require(APPPATH."ThirdParty/PHPMailer/src/PHPMailer.php");
require(APPPATH."ThirdParty/PHPMailer/src/Exception.php");
require(APPPATH."ThirdParty/PHPMailer/src/SMTP.php");
class Mail {

  public function send($to, $subject, $message){
    $mail = new PHPMailer();
    
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = "mail.authsmtp.com";
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->SMTPAutoTLS = false;
    $mail->SMTPSecure = 'ssl'; // To enable TLS/SSL encryption change to 'tls'
    // $mail->AuthType = "CRAM-MD5";
    $mail->Username = "ac74887";
    $mail->Password = "YaImamMahdi12";
    $mail->setFrom('dev@ecnetsolutions.ca', 'Crowd Funding');
    $mail->addAddress($to); //(Send the test to yourself)
    $mail->Subject = $subject;
    $mail->isHTML(true);
    $mail->Body    = $message;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }
  }
}