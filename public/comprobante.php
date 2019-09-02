<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    $selecTodos     = '';
    $selecActivos   = '';
    $selecCancelados= '';

    if(isset($_POST['estadoOpe'])){ 
        $estadoOpe  = $_POST['estadoOpe'];

        switch ($estadoOpe) {
            case '1':
                $selecTodos = 'selected';
                break;

            case '7':
                $selecActivos   = 'selected';
                break;

            case '10':
                $selecCancelados= 'selected';
                break;
            
            default:
                $selecTodos = 'selected';
                break;
        }
    } else {
        $estadoOpe  = 1;
        $selecTodos = 'selected';
    }

    if(isset($_POST['fechaDesde'])){ 
        $fechaDesde = $_POST['fechaDesde'];
    } else {
        $fechaActual= date('Y-m-d');
        $fechaDesde = date('Y-m-d', strtotime($fechaActual.'- 6 month'));
    }

    if(isset($_POST['fechaHasta'])){
        $fechaHasta = $_POST['fechaHasta'];
    } else {
        $fechaHasta = date('Y-m-d');
    }

    if(isset($_GET['code'])){
        $codeRest       = $_GET['code'];
        $msgRest        = $_GET['msg'];
    } else {
        $codeRest       = 0;
    }
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
                                    <li class="breadcrumb-item active" aria-current="page">Comprobantes</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <h4 class="col-10 card-title">Comprobantes</h4>
                                    <h4 class="col-2 card-title" style="text-align: right;">
                                        <button type="button" style="background-color:#ce9d53; border-color:#ce9d53;" class="btn btn-info" data-toggle="modal" data-target="#modal" data-whatever="@fat"><i class="ti-filter"></i> Filtrar</button>
                                	</h4>
								</div>
                                <div class="table-responsive">
                                    <table id="tableLoad" class="table v-middle" style="width: 100%;">
                                        <thead id="tableCodigo" class="<?php echo $cli_01; ?>">
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
                
                <!-- /.modal -->
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#27464e;">
                                <h4 class="modal-title" id="modalTitle" style="color:#fff;">Rango de Fechas de Comprobantes</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form id="FormComprobante" action="../public/comprobante.php" method="post">
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Operaciones con Estado:</label>
                                        <select class="custom-select mr-sm-2" id="estadoOpe" name="estadoOpe">
                                            <option value="1" <?php echo $selecTodos; ?>>Todos</option>
                                            <option value="7" <?php echo $selecActivos; ?>>Activas</option>
                                            <option value="10" <?php echo $selecCancelados; ?>>Canceladas</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Fecha de Pago Desde:</label>
                                        <input type="date" id="fechaDesde" name="fechaDesde" class="form-control" value="<?php echo $fechaDesde; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Fecha de Pago Hasta:</label>
                                        <input type="date" id="fechaHasta" name="fechaHasta" class="form-control" value="<?php echo $fechaHasta; ?>" required>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" style="background-color:#ce9d53; border-color:#ce9d53;" formmethod="post" class="btn btn-primary" value="Ver">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- /.modal -->
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
    
    <script src="../js/comprobante.js"></script>
</body>
</html>