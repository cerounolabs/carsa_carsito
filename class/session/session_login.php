<?php
    if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    require '../../class/function/curl_api.php';
    require '../../class/function/function.php';

    $val_01         = $_SESSION['log_01'];
    $val_02         = $_POST['val_02'];
    $val_03         = $_POST['val_03'];
    $val_04         = $_POST['val_04'];
    $val_05         = $_SESSION['log_05'];
    $val_06         = $_SERVER['REMOTE_ADDR'];

    if ($val_04 == $_SESSION['log_04'] && $val_06 == $_SESSION['log_06']) {
        $resultJSON     = get_curl('000/login/'.$val_05);

        if ($resultJSON['code'] === 200) {
            $_SESSION['cli_01']     = $resultJSON['data'][0]['cliente_cuenta'];
            $_SESSION['cli_02']     = $resultJSON['data'][0]['cliente_nombre'];
            $_SESSION['cli_03']     = $resultJSON['data'][0]['cliente_apellido'];
            $_SESSION['cli_04']     = $resultJSON['data'][0]['cliente_fecha_nacimiento'];
            $_SESSION['expire']     = time() + 3600;
            
            header('Location: ../../public/home.php');
        } else {
            $val_01                 = NULL;
            $val_02                 = NULL;
            $val_03                 = NULL;
            $val_04                 = NULL;
            $val_05                 = NULL;
            $val_06                 = NULL;

            header('Location: ../../class/session/session_logout.php');
        }
    } else {
        $val_01         = NULL;
        $val_02         = NULL;
        $val_03         = NULL;
        $val_04         = NULL;
        $val_05         = NULL;
        $val_06         = NULL;

        header('Location: ../../login.php?code=401&msg=El PIN no es correcto, favor de ingresar nuevamente');
    }
?>