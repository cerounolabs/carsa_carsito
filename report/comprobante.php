<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';
    require '../vendor/autoload.php';

    $fechaHora      = getFechaHora();

    if(isset($_GET['id1'])){ 
        $idComprobante = $_GET['id1'];
    }

    if ($idComprobante <> 0){
        $resultJSON = get_curl('report/100/cabecera/'.$idComprobante);

        if ($resultJSON['code'] == 200){
            $row_00_cabecera    = $resultJSON['data'][0]['comprobante_codigo'];
			$row_01_cabecera    = $resultJSON['data'][0]['comprobante_tipo'];
			$row_02_cabecera    = $resultJSON['data'][0]['comprobante_timbrado_numero'];
			$row_03_cabecera    = $resultJSON['data'][0]['comprobante_timbrado_vencimiento'];
			$row_04_cabecera    = $resultJSON['data'][0]['comprobante_numero'];
			$row_05_cabecera    = $resultJSON['data'][0]['comprobante_cantidad_impreso'];
			$row_06_cabecera    = $resultJSON['data'][0]['comprobante_importe'];
			$row_07_cabecera    = $resultJSON['data'][0]['movimiento_numero_original'];
			$row_08_cabecera    = $resultJSON['data'][0]['movimiento_numero_reversion'];
			$row_09_cabecera    = $resultJSON['data'][0]['movimiento_usuario_original'];
			$row_10_cabecera    = $resultJSON['data'][0]['movimiento_usuario_reversion'];
			$row_11_cabecera    = $resultJSON['data'][0]['movimiento_fecha_original'];
            $row_12_cabecera    = $resultJSON['data'][0]['movimiento_fecha_reversion'];
            $row_13_cabecera    = $resultJSON['data'][0]['movimiento_hora_original'];
            $row_14_cabecera    = $resultJSON['data'][0]['movimiento_hora_reversion'];
            $row_15_cabecera    = $resultJSON['data'][0]['operacion_numero'];
            $row_16_cabecera    = $resultJSON['data'][0]['operacion_cuota'];
            $row_17_cabecera    = $resultJSON['data'][0]['persona_nombre'];
            $row_18_cabecera    = $resultJSON['data'][0]['persona_documento'];
            $row_19_cabecera    = $resultJSON['data'][0]['persona_cuenta'];
            $row_20_cabecera    = $resultJSON['data'][0]['persona_direccion'];
            $row_21_cabecera    = $resultJSON['data'][0]['persona_telefono'];
            $row_22_cabecera    = $resultJSON['data'][0]['estado_codigo'];
            $row_23_cabecera    = $resultJSON['data'][0]['estado_nombre'];
            $row_24_cabecera    = $resultJSON['data'][0]['tipo_codigo'];
            $row_25_cabecera    = $resultJSON['data'][0]['tigo_nombre'];
            $row_26_cabecera    = $resultJSON['data'][0]['condicion_codigo'];
            $row_27_cabecera    = $resultJSON['data'][0]['condicion_nombre'];
            $row_28_cabecera    = $resultJSON['data'][0]['pago_codigo'];
            $row_29_cabecera    = $resultJSON['data'][0]['pago_nombre'];
            $row_30_cabecera    = $resultJSON['data'][0]['banca_codigo'];
            $row_31_cabecera    = $resultJSON['data'][0]['banca_nombre'];
        }

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 
            'format' => [75, 175], 
            'orientation' => 'P',
            'margin_top' => 5,
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_bottom' => 0,
            'default_font_size' => 6,
            'default_font' => 'Courier',
            'mirrorMargins' => true
        ]);

        $mpdf -> SetTitle('C.A.R.S.A. | CARSITO');

        $mpdf -> WriteHTML('<body>');

        $mpdf -> WriteHTML('<br>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:center; font-size:10px"> COMPAÑIA ADMINISTRADORA DE RIESGOS S.A. </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:center; font-size:10px"> C.A.R.S.A. </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> -Actividades de los Prestamistas. </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> -Otras actividades de servicios de apoyo a empresas ncp. </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> -Actividades de agencias de cobro y oficinas de créditos. </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> -Comercio al por menor de otros productos en comercios no especializados. </p>');

        $mpdf -> WriteHTML('<br>');

        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Ruc: 80026235-2 TEL: 021 238-8800 </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Matriz - Oliva Nº 408 Esq. Alberdi </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Suc. Gral. Diaz esq. 14 de Mayo Nº 563 </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:center;"> Asunción - Paraguay </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:center;"> --------------------------------------------------- </p>');
        
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Timbrado Nº: '.$row_02_cabecera.' </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Válido Hasta: '.$row_03_cabecera.' </p>');

        $mpdf -> WriteHTML('<br>');

        $mpdf -> WriteHTML('<p style="margin:0px; text-align:center;"> FACTURA </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Condición de Venta: '.$row_27_cabecera.' </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Factura Nº: '.$row_04_cabecera.' </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Mov. Nº: '.$row_07_cabecera.' Cajero: '.$row_09_cabecera.' </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Fecha y Hora: '.$row_11_cabecera.' '.$row_13_cabecera.' </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Nombre o Razón Social: </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> '.$row_17_cabecera.' </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> C.I. Nº / R.U.C. Nº: '.$row_18_cabecera.'</p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Nº de Cuenta: '.$row_19_cabecera.' </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Nº de Operación: '.$row_15_cabecera.' </p>');

        $mpdf -> WriteHTML('<br>');
        
        $mpdf -> WriteHTML('<table  width="100%">');
        $mpdf -> WriteHTML('<thead>');
        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<th width="40%" style="text-align:left;"> Concepto </th>');
        $mpdf -> WriteHTML('<th width="40%" style="text-align:right;"> Monto </th>');
        $mpdf -> WriteHTML('<th width="20%" style="text-align:right;"> Imp </th>');
        $mpdf -> WriteHTML('</tr>');
        $mpdf -> WriteHTML('</thead>');
        $mpdf -> WriteHTML('<tbody>');

        //DESEMBOLSO
        $resultJSON = get_curl('report/100/detalle/'.$idComprobante);
        if ($resultJSON['code'] == 200){
            foreach ($resultJSON['data'] as $resultKey=>$resultArray) {
                $row_00_detalle     = $resultArray['comprobante_codigo'];
                $row_01_detalle     = $resultArray['detalle_comprobante_item'];
                $row_02_detalle     = $resultArray['detalle_concepto_codigo'];
                $row_03_detalle     = $resultArray['detalle_concepto_nombre'];
                $row_04_detalle     = $resultArray['detalle_impuesto_codigo'];
                $row_05_detalle     = $resultArray['detalle_impuesto_nombre'];
                $row_06_detalle     = $resultArray['detalle_comprobante_gravado'];
                $row_07_detalle     = $resultArray['detalle_comprobane_iva'];
                $row_08_detalle     = $resultArray['detalle_comprobante_total'];

                switch ($row_04_detalle) {
                    case 1:
                        $row_09_detalle     = $row_09_detalle + $row_07_detalle;
                        break;
                    
                    case 2:
                        $row_10_detalle     = $row_10_detalle + $row_07_detalle;
                        break;

                    case 3:
                        $row_11_detalle     = $row_11_detalle + $row_07_detalle;
                        break;
                }

                $mpdf -> WriteHTML('<tr>');
                $mpdf -> WriteHTML('<td width="40%" style="text-align:left;"> '.$row_03_detalle.' </td>');
                $mpdf -> WriteHTML('<td width="40%" style="text-align:right;"> GS. '.number_format($row_08_detalle, 0, ','. '.').' </td>');
                $mpdf -> WriteHTML('<td width="20%" style="text-align:right;"> '.$row_05_detalle.' </td>');
                $mpdf -> WriteHTML('</tr>');
            }
        }

        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<td style="text-align:left;" colspan="3"> <p style="margin:0px; text-align:center;"> ------------------------------------------------- </p> </td>');
        $mpdf -> WriteHTML('</tr>');
        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<td style="text-align:left;"> Total: </td>');
        $mpdf -> WriteHTML('<td style="text-align:right;" colspan="2"> GS. '.number_format($row_06_cabecera, 0, ','. '.').' </td>');
        $mpdf -> WriteHTML('</tr>');
        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<td style="text-align:left;" colspan="3"> <p style="margin:0px; text-align:center;"> ------------------------------------------------- </p> </td>');
        $mpdf -> WriteHTML('</tr>');
        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<td style="text-align:left;" colspan="3"> Son Guaraníes: ('.$row_00.')- </td>');
        $mpdf -> WriteHTML('</tr>');
        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<td style="text-align:left;" colspan="3"> <p style="margin:0px; text-align:center;"> ------------------------------------------------- </p> </td>');
        $mpdf -> WriteHTML('</tr>');

        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<td style="text-align:left;" colspan="3"> Liquidación de I.V.A.: </td>');
        $mpdf -> WriteHTML('</tr>');
        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<td width="40%" style="text-align:left;"> I.V.A. 5% </td>');
        $mpdf -> WriteHTML('<td style="text-align:right;" colspan="2"> GS. '.number_format($row_10_detalle, 0, ','. '.').' </td>');
        $mpdf -> WriteHTML('</tr>');
        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<td width="40%" style="text-align:left;"> I.V.A. 10% </td>');
        $mpdf -> WriteHTML('<td style="text-align:right;" colspan="2"> GS. '.number_format($row_11_detalle, 0, ','. '.').' </td>');
        $mpdf -> WriteHTML('</tr>');

        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<td style="text-align:left;" colspan="3"> <br> </td>');
        $mpdf -> WriteHTML('</tr>');

        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<td style="text-align:left;" colspan="3"> Forma de Cobro </td>');
        $mpdf -> WriteHTML('</tr>');
        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<td width="40%" style="text-align:left;"> '.$row_29_cabecera.' </td>');
        $mpdf -> WriteHTML('<td style="text-align:right;" colspan="2"> GS. '.number_format($row_06_cabecera, 0, ','. '.').' </td>');
        $mpdf -> WriteHTML('</tbody>');
        $mpdf -> WriteHTML('</table>');

        $mpdf -> WriteHTML('</body>');

        $mpdf -> Output('CARSITOComprobante_'.$fechaHora.'.pdf', 'I');
        exit;
    }
?>