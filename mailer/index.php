<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mail1 = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    // $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'syedbilalhussain.sbh12@gmail.com';                 // SMTP username
    $mail->Password = 'kvnlhwjvefayaids';                           // SMTP password

    $mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = '587';                                    // TCP port to connect to
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
   $mail1->isSMTP();                                      // Set mailer to use SMTP
    $mail1->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail1->SMTPAuth = true;                               // Enable SMTP authentication
    $mail1->Username = 'syedbilalhussain.sbh12@gmail.com';                 // SMTP username
    $mail1->Password = 'kvnlhwjvefayaids';                           // SMTP password

    $mail1->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
    $mail1->Port = '587';                                    // TCP port to connect to
$mail1->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);

    //Recipients
    $comment=$_GET['comment'];
    $name=$_GET['name'];
    $email=$_GET['email'];
    $phone_no=$_GET['phone_no'];
    $mail->setFrom('syedbilalhussain.sbh12@gmail.com', 'Infi data');
    $mail->addAddress($email);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@examp   le.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    $body = '<p><strong>Hi '.$name.'</strong> </p><p>Thank you for contacting us</p>';

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Infi data';
    $mail->Body    = $body;
    $mail->AltBody =  strip_tags($body);
    $mail->send();

    $mail1->setFrom($email, 'Infi data');
    $mail1->addAddress('syedbilalhussain.sbh12@gmail.com');     // Add a recipient
    // $mail1->addAddress('ellen@example.com');               // Name is optional
    // $mail1->addReplyTo('info@example.com', 'Information');
    // $mail1->addCC('cc@example.com');
    // $mail1->addBCC('bcc@example.com');

    $body = '<p>A customer wants to contact us</p><p>Name : .'.$name.'</p><p>Email : '.$email.'</p><p><p>Message: '.$comment.'</p><p>Phone no'.$phone_no.' </p>';

    //Attachments
    // $mail1->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail1->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail1->isHTML(true);                                  // Set email format to HTML
    $mail1->Subject = 'Infi data Contact US';
    $mail1->Body    = $body;
    $mail1->AltBody =  strip_tags($body);
    $mail1->send();
        $message="Thank your contacting us we will get back to you soon";
    header("location: ../contact.html");

  
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}