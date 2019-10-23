<?php
    if(!isset($_SESSION)){ 
        session_start(); 
    }

    $expire = $_SESSION['expire'];

    if ($expire < time()) {
        header('Location: class/session/session_logout.php');
    } else {
        $_SESSION['expire'] = time() + 3600;

        $log_01             = $_SESSION['log_01'];
        $log_02             = $_SESSION['log_02'];
        $log_03             = $_SESSION['log_03'];
        $log_04             = $_SESSION['log_04'];
        $log_05             = $_SESSION['log_05'];
        $log_06             = $_SESSION['log_06'];

        if ($log_01 == 1) {
            $selCIP = 'selected';
            $selRUC = '';
        } else {
            $selCIP = '';
            $selRUC = 'selected';
        }

        $_SESSION['log_01'] = $log_01;
        $_SESSION['log_02'] = $log_02;
        $_SESSION['log_03'] = $log_03;
        $_SESSION['log_04'] = $log_04;
        $_SESSION['log_05'] = $log_05;
        $_SESSION['log_06'] = $log_06;
    }

    if(isset($_GET['code'])){
        $codeRest       = $_GET['code'];
        $msgRest        = $_GET['msg'];
    } else {
        $codeRest       = 200;
        $msgRest        = 'Favor verificar su correo '.$log_03.' para ver el PIN';

    }
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="C.A.R.S.A. Sistema Comprobante Web">
	<meta name="author" content="CEROUN Labs https://cerouno.com.py/ - +595 984 779436">
	<link href="assets/images/favicon.png" rel="icon" type="image/png" sizes="16x16">
	<link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
	<link href="assets/libs/morris.js/morris.css" rel="stylesheet">
	<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="assets/libs/select2/dist/css/select2.min.css" type="text/css" rel="stylesheet">
    <link href="assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
	<link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
	<link href="dist/css/style.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></scri
	<![endif]-->
	
	<title>C.A.R.S.A. | MI FACTURA</title>
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(assets/images/background/fondo.png) no-repeat center center; background-size:cover;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="assets/images/logoCarsa.png" alt="logo" /></span>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" id="loginform" method="post" action="class/session/session_login.php">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-id-badge"></i></span>
                                    </div>
                                    <select id="val_01" name="val_01" class="select2 form-control form-control-lg custom-select" aria-describedby="basic-addon1" disabled>
                                        <optgroup label="Tipo Documento">
                                       		<option value="1" <?php echo $selCIP; ?>>C.I.P.</option>
                                       		<option value="2" <?php echo $selRUC; ?>>R.U.C.</option>
                                    	</optgroup>
                                	</select>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" id="val_02" name="val_02" aria-label="val_02" aria-describedby="basic-addon1" value="<?php echo $log_02; ?>" placeholder="Nro. Documento" required readonly>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" id="val_03" name="val_03" aria-label="val_03" aria-describedby="basic-addon1" value="<?php echo $log_03; ?>" placeholder="Email" required readonly>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" id="val_04" name="val_04" aria-label="val_04" aria-describedby="basic-addon1" placeholder="Pin" maxlength="4" required>
                                </div>

                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" style="background-color:#ce9d53; border-color:#ce9d53;" type="submit">INICIAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--toast -->
    <script src="assets/libs/toastr/build/toastr.min.js"></script>
    <script src="assets/extra-libs/toastr/toastr-init.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    </script>

<?php  
    if ($codeRest == 200) {
?>
        <script>
            $(function() {
                toastr.success('<?php echo $msgRest; ?>', 'Correcto!');
            });
        </script>
<?php
    }
    
    if ($codeRest == 204 || $codeRest == 401) {
?>
        <script>
            $(function() {
                toastr.error('<?php echo $msgRest; ?>', 'Error!');
            });
        </script>
<?php
    }
?>
</body>

</html>