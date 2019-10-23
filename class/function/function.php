<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception; 

    require '../../vendor/autoload.php';
    
    function mssqlConectar($var00) {
        switch ($var00) {
            case 'P'://PRODUCCION
                $serverName = "SRVDESA01, 1433";
                $serverInfo = array("Database"=>"PRODUCCION_AYER", "UID"=>"czelaya", "PWD"=>"carsa_2019", "CharacterSet"=>"UTF-8", "MultipleActiveResultSets"=>"false");
                break;
            
            case 'T'://TESTING
                $serverName = "SRVDESA01, 1433";
                $serverInfo = array("Database"=>"PRODUCCION_AYER", "UID"=>"czelaya", "PWD"=>"carsa_2019", "CharacterSet"=>"UTF-8", "MultipleActiveResultSets"=>"false");
                break;

            case 'D'://DESARROLLO
                $serverName = "SRVDESA01, 1433";
                $serverInfo = array("Database"=>"PRODUCCION_AYER", "UID"=>"czelaya", "PWD"=>"carsa_2019", "CharacterSet"=>"UTF-8", "MultipleActiveResultSets"=>"false");
                break;
        }

        $serverConn = sqlsrv_connect($serverName, $serverInfo);

        if($serverConn) {
            return $serverConn;
        } else {
            die(mssqlFormatErrors(sqlsrv_errors()));
        }
    }

    function mssqlFormatErrors($errors) {
        echo "MSSQL Erros<br/>";
        foreach ($errors as $error) {
            echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";
            echo "Code:     ".$error['code']."<br/>";
            echo "Message:  ".$error['message']."<br/>";
        }
    }

    function getUUID(){
        $data    = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    function getFechaHora(){
        $result = date("YmdHis");
        return $result;
    }

    function getCodeLogin(){
        $result = random_int(1000, 9999);
        return $result;
    }

    function setEmail($var01, $var02){
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug    = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host         = '192.168.16.85';
            $mail->SMTPAuth     = false;
            $mail->Username     = 'test@carsa.com.py';
            $mail->Password     = 'Argentina_1979';
            $mail->SMTPSecure   = false;
            $mail->Port         = 25;

            $mail->setFrom('test@carsa.com.py', 'C.A.R.S.A. MI FACTURA');
            $mail->addAddress('christian@cerouno.com.py');

            $mail->isHTML(true);
            $mail->Subject      = 'Prueba ASUNTO';
            $mail->Body         = 'Prueba CUERPO';
            $mail->AltBody      = 'Prueba PIE';
        
            if(!$mail->Send()) {
                echo 'OK';
            } else {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>


2019-10-23 14:27:31 SERVER -> CLIENT: 220 mail.carsa.com.py ESMTP Postfix
2019-10-23 14:27:31 CLIENT -> SERVER: EHLO mifactura.carsa.com.py
2019-10-23 14:27:31 SERVER -> CLIENT: 250-mail.carsa.com.py250-PIPELINING250-SIZE 20480000250-VRFY250-ETRN250-STARTTLS250-ENHANCEDSTATUSCODES250-8BITMIME250 DSN
2019-10-23 14:27:31 CLIENT -> SERVER: STARTTLS
2019-10-23 14:27:31 SERVER -> CLIENT: 220 2.0.0 Ready to start TLS
SMTP Error: Could not connect to SMTP host.
2019-10-23 14:27:31 CLIENT -> SERVER: QUIT
2019-10-23 14:27:31 SERVER -> CLIENT:
2019-10-23 14:27:31 SMTP ERROR: QUIT command failed:
SMTP Error: Could not connect to SMTP host.
Message could not be sent. Mailer Error: SMTP Error: Could not connect to SMTP host.