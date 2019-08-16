<?php 
    session_start();

    $expire = $_SESSION['expire'];
    $val_06 = $_SERVER['REMOTE_ADDR'];
    
    if ($expire < time()) {
        header('Location: ../../class/session/session_logout.php');
    } else {
        $log_01 = $_SESSION['log_01'];
        $log_02 = $_SESSION['log_02'];
        $log_03 = $_SESSION['log_03'];
        $log_04 = $_SESSION['log_04'];
        $log_05 = $_SESSION['log_05'];
        $log_06 = $_SESSION['log_06'];

        $cli_01 = $_SESSION['cli_01'];
        $cli_02 = $_SESSION['cli_02'];
        $cli_03 = $_SESSION['cli_03'];

        if (isset($log_05) && isset($cli_01) && isset($log_06)) {
            if ($val_06 === $log_06) {
                setlocale(LC_MONETARY, 'es_PY');

                $_SESSION['expire'] = time() + 3600;
                $urlAct             = $_SERVER['REQUEST_URI'];
                $urlAnt             = substr($_SERVER['HTTP_REFERER'], 39);
                $urlPat             = strtoupper(substr(substr($_SERVER['SCRIPT_FILENAME'], 48), 0, -4));
            } else {
                header('Location: ../../class/session/session_logout.php');
            }
        } else {
            header('Location: ../../class/session/session_logout.php');
        }
    }
?>