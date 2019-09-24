<?php
    if(!isset($_SESSION)){ 
        session_start(); 
    }

    require '../../class/function/curl_api.php';
    require '../../class/function/function.php';

    $val_01         = $_POST['val_01'];
    $val_02         = $_POST['val_02'];
    $val_03         = $_POST['val_03'];
    $val_04         = getCodeLogin();
    $val_05         = getUUID();
    $val_06         = $_SERVER['REMOTE_ADDR'];

    $dataJSON       = json_encode(
        array(
            'usuario_var01' => $val_01,
            'usuario_var02' => $val_02,
            'usuario_var03' => $val_03,
            'usuario_var04'	=> $val_04,
            'usuario_var05'	=> $val_05,
            'usuario_var06'	=> $val_06,
            'usuario_var07'	=> $_SERVER['HTTP_HOST'],
            'usuario_var08'	=> $_SERVER['HTTP_USER_AGENT'],
            'usuario_var09'	=> $_SERVER['HTTP_REFERER']
        ));

    $resultJSON     = post_curl('000/index', $dataJSON);
    $resultJSON     = json_decode($resultJSON, true);

    if ($resultJSON['code'] === 200) {
        $_SESSION['log_01']     = $val_01;
        $_SESSION['log_02']     = $val_02;
        $_SESSION['log_03'] 	= $val_03;
        $_SESSION['log_04'] 	= $val_04;
        $_SESSION['log_05'] 	= $val_05;
        $_SESSION['log_06'] 	= $val_06;
        $_SESSION['expire']     = time() + 600;
        
        header('Location: ../../login.php');
    } else {
        $val_01                 = NULL;
        $val_02                 = NULL;
        $val_03                 = NULL;
        $val_04                 = NULL;
        $val_05                 = NULL;
        $val_06                 = NULL;

        header('Location: ../../class/session/session_logout.php');
    }
?>