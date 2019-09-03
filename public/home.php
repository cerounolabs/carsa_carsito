<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    if(isset($_GET['code'])){
        $codeRest       = $_GET['code'];
        $msgRest        = $_GET['msg'];
    } else {
        $codeRest       = 0;
    }

    $top03JSON = get_curl('100/top03/'.$cli_01);
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
<?php
    include '../include/header.php';
?>
</head>

<body>
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
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
<?php
    	include '../include/menu.php';
?>
       
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Bienvenido <?php echo $cli_02.' '.$cli_03; ?></h4>
                        <div class="d-flex align-items-center"></div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="../public/home.php">Home</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                	<h4 class="col-12 card-title">Proximos 3 Vencimientos</h4>
                                </div>
<?php
    if ($top03JSON['code'] === 200) {
        foreach ($top03JSON['data'] as $top03Key=>$top03Value) {
            $fecha01    = str_replace('/', '-', $top03Value['operacion_proximo_vencimiento']);
            $fecha01    = new DateTime($fecha01);
            $fecha02    = new DateTime('now');
            $fecha03    = $fecha01->diff($fecha02);
            $fecha03    = $fecha03->days;

            if($fecha03 > 0 && $fecha01 > $fecha02 ){
?>
                                <div class="card bg-light-success no-card-border">
                                    <div class="card-body">
                                        <h5 class="card-title"><span style="font-weight:bold;">Operaci&oacute;n:</span> <?php echo number_format($top03Value['operacion_numero'], 0, ',', '.'); ?> | <span style="font-weight:bold;">Vence el:</span> <?php echo $top03Value['operacion_proximo_vencimiento']; ?></h5>
                                        <div class="d-flex no-block">
                                            <div class="align-self-end no-shrink">
                                                <h2 class="m-b-0">₲ <?php echo number_format($top03Value['operacion_proximo_monto'], 0, ',', '.'); ?></h2>
                                                <h6 class="text-muted">(Cuota Nro <?php echo $top03Value['operacion_proximo_cuota'].' de '.$top03Value['operacion_cuota_cantidad']; ?>)</h6>
                                            </div>
                                            <div class="ml-auto">
                                                <h2 class="m-b-0"><?php echo 'Vence dentro '.$fecha03.' días'; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<?php
            } else {
?>
                                  <div class="card bg-light-danger no-card-border">
                                    <div class="card-body">
                                        <h5 class="card-title"><span style="font-weight:bold;">Operaci&oacute;n:</span> <?php echo number_format($top03Value['operacion_numero'], 0, ',', '.'); ?> | <span style="font-weight:bold;">Venció el:</span> <?php echo $top03Value['operacion_proximo_vencimiento']; ?></h5>
                                        <div class="d-flex no-block">
                                            <div class="align-self-end no-shrink">
                                                <h2 class="m-b-0">₲ <?php echo number_format($top03Value['operacion_proximo_monto'], 0, ',', '.'); ?></h2>
                                                <h6 class="text-muted">(Cuota Nro <?php echo $top03Value['operacion_proximo_cuota'].' de '.$top03Value['operacion_cuota_cantidad']; ?>)</h6>
                                            </div>
                                            <div class="ml-auto">
                                                <h2 class="m-b-0"><?php echo 'Venció hace '.$fecha03.' días'; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<?php 
            }
        }
    }
?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <h4 class="col-10 card-title">&Uacute;ltimos 6 Pagos</h4>
                                    <h4 class="col-2 card-title" style="text-align: right;">
                                		<a class="btn btn-info" href="../public/comprobante.php" style="background-color:#ce9d53; border-color:#ce9d53;" role="button" title="Ver mas"><i class="ti-plus"></i> Ver mas</a>
                                	</h4>
								</div>
                                <div class="table-responsive">
                                    <table id="tableLoadTop06" class="table v-middle" style="width: 100%;">
                                        <thead id="tableCodigoTop06" class="<?php echo $cli_01; ?>">
                                            <tr class="bg-light">
                                                <th class="border-top-0">C&Oacute;DIGO</th>
                                                <th class="border-top-0">OPERACI&Oacute;N</th>
                                                <th class="border-top-0">BANCA</th>
                                                <th class="border-top-0">MOVIMIENTO</th>
                                                <th class="border-top-0">CUOTA</th>
                                                <th class="border-top-0">NRO. COMPROBANTE</th>
                                                <th class="border-top-0">FECHA</th>
                                                <th class="border-top-0">HORA</th>
                                                <th class="border-top-0">IMPORTE</th>
                                                <th class="border-top-0">DESCARGAR</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?php
    include '../include/development.php';
?>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <div class="chat-windows"></div>
<?php
    include '../include/footer.php';
   
    if ($codeRest == 401) {
?>
    <script>
        $(function() {
            toastr.error('<?php echo $msgRest; ?>', 'Error!');
        });
    </script>
<?php
    }
?>

    <script src="../js/home_top03.js"></script>
    <script src="../js/home_top06.js"></script>
</body>
</html>