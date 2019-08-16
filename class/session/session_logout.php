<?php
    session_start();
    unset($_SESSION['log_01']);
    unset($_SESSION['log_02']);
    unset($_SESSION['log_03']);
    unset($_SESSION['log_04']);
    unset($_SESSION['log_05']);
    unset($_SESSION['log_06']);

    unset($_SESSION['cli_01']);
    unset($_SESSION['cli_02']);
    unset($_SESSION['cli_03']);

    session_unset();
    session_destroy();
    header('Location: ../../index.php');
    exit();
?>