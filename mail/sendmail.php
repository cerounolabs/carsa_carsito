<?php
    require_once("class.phpmailer.php");

    $mail 				= new PHPMailer();
    $mailHost			= 'cuenta de correo';
    $mail->IsSMTP();
    $mail->Host 		= 'direccion ip';
    $mail->SMTPAuth 	= true;
    $mail->Username 	= $mailHost;
    $mail->Password 	= 'contraseña';
    $mail->SMTPSecure	= 'tls'; 
    $mail->From 		= $mailHost; 
    $mail->FromName 	= 'C.A.R.S.A.';
    $mail->AddAddress($mailHost);
    $mail->AddReplyTo($_POST['email-address']);
    $mail->isHTML(true);
    $mail->Subject 		= $_POST['email-subject'];
    $mail->Body    		= "<b>DETALLE</b> <br/> CLIENTE: ".$_POST['email-name']."<br/>ASUNTO: ".$_POST['email-subject']."<br/>MENSAJE: ".$_POST['email-content'];
    $mail->AltBody 		= $_POST['email-content'];

    if(!$mail->Send()) {
        echo "Message could not be sent. <p>";
        echo "Mailer Error: " . $mail->ErrorInfo;
        exit;
    } else {
        header("Location: contact.php");
    }
?>