<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

function send_mail($nombre, $correo, $mensaje)
{
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'mail';                                 // SMTP username
        $mail->Password   = 'password';                             // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom($correo, $nombre);                           // En google hay una restriccion, no funciona.
        $mail->addAddress('favioo.wow@gmail.com');                  // Add a recipient
        // $mail->addAddress('ellen@example.com');                  // Name is optional
        $mail->addReplyTo('info@example.com', 'Information');       // Por la restriccion de google usar esto para responder a:
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');            // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');       // Optional name
    
        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Asunto: Probando';
        $mail->Body    = $mensaje;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'El mensaje fue enviado';
    } catch (Exception $e) {
        echo "Hubo un error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
    }
}
