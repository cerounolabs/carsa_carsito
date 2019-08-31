<?php
    function mssqlConectar($var01) {
        switch ($var01) {
            case 'P'://PRODUCCION
                $serverName     = "SRVDESA01, 1433";
                $serverInfo     = array("Database"=>"PRODUCCION_AYER", "UID"=>"czelaya", "PWD"=>"carsa_2019", "CharacterSet"=>"UTF-8", "MultipleActiveResultSets"=>"false");
                break;
            case 'T'://TESTING
                $serverName     = "SRVDESA01, 1433";
                $serverInfo     = array("Database"=>"PRODUCCION_AYER", "UID"=>"czelaya", "PWD"=>"carsa_2019", "CharacterSet"=>"UTF-8", "MultipleActiveResultSets"=>"false");
                break;
        }

        $serverConn     = sqlsrv_connect($serverName, $serverInfo);

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
?>