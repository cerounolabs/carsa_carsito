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

        $mensaje = '<!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                
                <style>
                    .card {
                        top: 100px;
                        margin: auto; /* Added */
                        float: none; /* Added */
                        background-color: #fff;
                        border: 1px solid cadetblue;
                    }
                </style>
        
                <title>C.A.R.S.A COMPROBANTE</title>
            </head>
            <body>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header" style="background:#27464e; color:#fff; font-weight:bold; height:50px; font-size:20px;">
                                    C.A.R.S.A. PIN DE ACCESO
                                </div>
                                
                                <div class="card-body">
                                    <h1 class="card-title"><p class="text-center" style="font-size:60px;">'.$var02.'</p></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            </body>
        </html>';

        try {
            $mail->SMTPDebug    = 0;
            $mail->isSMTP();
            $mail->Host         = '192.168.16.85';
            $mail->SMTPAuth     = true;
            $mail->Username     = 'test@carsa.com.py';
            $mail->Password     = 'Argentina_19792';
            $mail->SMTPSecure   = 'tls';
            $mail->Port         = 25;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('test@carsa.com.py', 'C.A.R.S.A.');
            $mail->addAddress($var01);

            $mail->isHTML(true);
            $mail->Subject      = 'C.A.R.S.A. ComprobanteWeb PIN';
            $mail->Body         = $mensaje;
        
            $mail->Send();
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>