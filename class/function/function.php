<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception; 
    
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
        require '../../vendor/autoload.php';

        $mail = new PHPMailer();

        try {
//            $mail->SMTPDebug    = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host         = 'smtp.it.com.py';
            $mail->SMTPAuth     = true;
            $mail->Username     = 'czelaya@it.com.py';
            $mail->Password     = 'fxiw~M3Lg%Qp';

            $mail->SMTPSecure   = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port         = 587;


            $mail->setFrom('czelaya@it.com.py', 'C.A.R.S.A. MI FACTURA');
            $mail->addAddress('christian@cerouno.com.py');

            $mail->isHTML(true);
            $mail->Subject      = 'Here is the subject';
            $mail->Body         = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody      = 'This is the body in plain text for non-HTML mail clients';
        
            if(!$mail->Send()) {
                echo 'Message has been sent';
            } else {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>