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
        $resultJSON = get_curl('report/100/'.$idComprobante);

        if ($resultJSON['code'] == 200){
			$row_01     = $resultJSON['data'][0]['caja_cuenta'];
			$row_02     = $resultJSON['data'][0]['caja_operacion'];
			$row_03     = $resultJSON['data'][0]['caja_movimiento'];
			$row_04     = $resultJSON['data'][0]['caja_cuota'];
			$row_05     = $resultJSON['data'][0]['caja_fecha'];
			$row_06     = $resultJSON['data'][0]['caja_hora'];
			$row_07     = $resultJSON['data'][0]['caja_monto'];
			$row_08     = $resultJSON['data'][0]['caja_numero_movimiento'];
			$row_09     = $resultJSON['data'][0]['caja_numero_factura'];
			$row_10     = $resultJSON['data'][0]['caja_numero_recibo'];
			$row_11     = $resultJSON['data'][0]['caja_usuario'];
            $row_12     = $resultJSON['data'][0]['operacion_cantidad_cuota'];
            $row_13     = $resultJSON['data'][0]['cliente_nombre_completo'];
            $row_14     = $resultJSON['data'][0]['cliente_documento_tipo'];
            $row_15     = $resultJSON['data'][0]['cliente_documento_numero'];
            $row_16     = $resultJSON['data'][0]['cliente_direccion'];
            $row_17     = $resultJSON['data'][0]['cliente_telefono'];
            $row_18     = $resultJSON['data'][0]['cliente_celular'];
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

        $mpdf -> WriteHTML('<p style="margin:0px; text-align:center;"> Ruc: 80026235-2 TEL: 021 238-8800 </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:center;"> Matriz - Oliva Nº 408 Esq. Alberdi </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:center;"> Suc. Gral. Diaz esq. 14 de Mayo Nº 563 </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:center;"> Asunción - Paraguay </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:center;"> --------------------------------------------------- </p>');
        
        if ($row_03 == 'DESEMBOLSO') {
            $mpdf -> WriteHTML('<p style="margin:0px; text-align:center;"> Comprobante de Desembolso </p>');
        } else {
            $mpdf -> WriteHTML('<p style="margin:0px; text-align:center;"> Recido de Dinero </p>');
        }
        
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Mov. Nº.: '.$row_08.'</p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Recibo Nº.: '.$row_10.'</p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Fecha: '.$row_05.'  Hora: '.$row_06.' </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Cajero: '.$row_11.'</p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Cuenta Nº.: '.$row_01.' </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Nombre o Razón Social: </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> '.$row_13.' </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Nº Doc.: '.$row_15.'</p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Dirección: '.$row_16.' </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Tel.: '.$row_17.' | '.$row_18.' </p>');
        $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Operación: '.$row_02.' </p>');

        if ($row_03 == 'DESEMBOLSO') {
            
        } else {
            $mpdf -> WriteHTML('<p style="margin:0px; text-align:left;"> Cuota: '.$row_04.' de '.$row_12.' </p>');
        }

        

        $mpdf -> WriteHTML('<br>');
/*
        $mpdf -> WriteHTML('<table  width="100%">');
        $mpdf -> WriteHTML('<thead>');
        $mpdf -> WriteHTML('<tr>');
        $mpdf -> WriteHTML('<th width="50%" style="text-align:left;"> Concepto </th>');
        $mpdf -> WriteHTML('<th width="50%" style="text-align:right;"> Monto </th>');
        $mpdf -> WriteHTML('</tr>');
        $mpdf -> WriteHTML('</thead>');
        $mpdf -> WriteHTML('<tfoot>');
        $mpdf -> WriteHTML('</tr>');
        $mpdf -> WriteHTML('<td width="50%" style="text-align:left;"> Total GS. </td>');
        $mpdf -> WriteHTML('<td width="50%" style="text-align:right;"> 900.910,00 </td>');
        $mpdf -> WriteHTML('</tr>');
        $mpdf -> WriteHTML('</tfoot>');
        $mpdf -> WriteHTML('</table>');
*/
        $mpdf -> WriteHTML('</body>');

        $mpdf -> Output('CARSITOComprobante_'.$fechaHora.'.pdf', 'I');
        exit;
    }
?>