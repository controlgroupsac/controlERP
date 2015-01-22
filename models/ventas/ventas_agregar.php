<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	// if(empty($_POST['almacen_id'])) {
	//   echo "Usted no a llenado todos los campos";
	//   exit;
	// }


	/**/
	/**/
	/**/
	$fecha = date("Y-m-d H:i:s");
	$query_ventas = sprintf("UPDATE `controlg_controlerp`.`ventas` 
					SET usuario_id='%s', fecha='%s', estado='%s', almacen_id='%s', condicion_pago='%s', fechapago='%s', impuesto1='%s', valor_neto='%s', descuento='%s', total='%s'
					WHERE ventas_id=%d;",
					fn_filtro(1),
					fn_filtro($fecha),
					fn_filtro(2),
					fn_filtro($_POST['almacen_id']),
					fn_filtro($_POST['condicion_pago']),
					fn_filtro($_POST['fechapago']),
					fn_filtro($_POST['impuesto1']),
					fn_filtro($_POST['valor_neto']),
					fn_filtro($_POST['descuento']),
					fn_filtro($_POST['total']),
					fn_filtro((int)$_POST['ventas_id'])
	);

    mysql_select_db($database_fastERP, $fastERP);
    $ventas = mysql_query($query_ventas, $fastERP) or die(mysql_error());

	$comprobante_det = sprintf("INSERT INTO `controlg_controlerp`.`comprobante_det` (`comprobante_id`, `ventas_id`, `numero`, `monto`) 
	                VALUES ('%s', '%s', '%s', '%s');",
	                fn_filtro($_POST['condicion_pago']),
	                fn_filtro($_POST['ventas_id']),
	                fn_filtro($_POST['numero']),
	                fn_filtro($_POST['total'])
	);

	if(!mysql_query($comprobante_det, $fastERP))
		echo "Error al insertar:\n$comprobante_det";




	$query = "SELECT * FROM `controlg_controlerp`.`almacen_det` 
			  WHERE almacen_det.ventas_id = $_POST[ventas_id]";
    mysql_select_db($database_fastERP, $fastERP);
    $almacen = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_almacen = mysql_num_rows($almacen);

	$query = "SELECT * FROM `controlg_controlerp`.`ventas_det`
			  WHERE ventas_det.ventas_id = $_POST[ventas_id]";
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);

    if ($totalRows_almacen >= 1) {
    	exit;
    }else {
    	do {
            $sql = sprintf("INSERT INTO `controlg_controlerp`.`almacen_det` (`almacen_id`, `ventas_id`, `producto_id`, `cantidad`, `activo`) 
                            VALUES ('%s', '%s', '%s', '%s', '%s');",
                            fn_filtro($_POST['almacen_id']),
                            fn_filtro($_POST['ventas_id']),
                            fn_filtro($row_table['producto_id']),
                            fn_filtro("-".$row_table['cantidad']),
                            fn_filtro(1)
            );
            if(!mysql_query($sql, $fastERP))
                echo "Error al insertar:\n$sql";

    	} while ( $row_table = mysql_fetch_assoc($table) );
    }

?>