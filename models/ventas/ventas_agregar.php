<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['ventas_id']) || empty($_POST['almacen_id'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	
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



	$query_ctacorriente_cliente = sprintf("INSERT INTO `controlg_controlerp`.`ctacorriente_cliente` (`fecha`, `cliente_id`, `ventas_id`, `monto`) 
	                VALUES ('%s', '%s', '%s', '%s');",
					fn_filtro($fecha),
	                fn_filtro($_POST['cliente_id']),
	                fn_filtro($_POST['ventas_id']),
	                fn_filtro($_POST['total'])
	);
    mysql_select_db($database_fastERP, $fastERP);
    $ctacorriente_cliente = mysql_query($query_ctacorriente_cliente, $fastERP) or die(mysql_error());
    $ultima_cta = mysql_insert_id();



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

	$query = "SELECT ventas.almacen_id, ventas.ventas_id, producto_ensamblado.producto_ensamblado_id, producto_ensamblado.producto, producto.producto_id, producto.producto, ventas_det.cantidad
			  FROM ventas , ventas_det , producto_ensamblado , producto_ensamblado_det , producto
			  WHERE ventas.ventas_id = $_POST[ventas_id]
			  AND ventas.ventas_id = ventas_det.ventas_id
			  AND ventas_det.producto_id = producto_ensamblado.producto_ensamblado_id
			  AND producto_ensamblado.producto_ensamblado_id = producto_ensamblado_det.producto_ensamblado_id
			  AND producto_ensamblado_det.producto_id = producto.producto_id";
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);

    if ($totalRows_almacen >= 1) {
    	exit;
    }else {
    	do {
            $almacen_det = sprintf("INSERT INTO `controlg_controlerp`.`almacen_det` (`almacen_id`, `ventas_id`, `producto_id`, `producto_ensamblado_id`, `cantidad`, `activo`) 
                            VALUES ('%s', '%s', '%s', '%s', '%s', '%s');",
                            fn_filtro($row_table['almacen_id']),
                            fn_filtro($row_table['ventas_id']),
                            fn_filtro($row_table['producto_id']),
                            fn_filtro($row_table['producto_ensamblado_id']),
                            fn_filtro("-".$row_table['cantidad']),
                            fn_filtro(1)
            );
            if(!mysql_query($almacen_det, $fastERP))
                echo "Error al insertar:\n$almacen_det";

            $ctacorriente_cliente_env = sprintf("INSERT INTO `controlg_controlerp`.`ctacorriente_cliente_env` (`ctacorriente_cliente_id`, `producto_id`, `cantidad`) 
                            VALUES ('%s', '%s', '%s');",
                            fn_filtro($ultima_cta),
                            fn_filtro($row_table['producto_id']),
                            fn_filtro($row_table['cantidad'])
            );
            if(!mysql_query($ctacorriente_cliente_env, $fastERP))
                echo "Error al insertar:\n$ctacorriente_cliente_env";

    	} while ( $row_table = mysql_fetch_assoc($table) );
    }
?>