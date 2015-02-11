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
					SET usuario_id='%s', fecha='%s', estado='%s', almacen_id='%s', condicion_pago='%s', pago='%s', fechapago='%s', impuesto1='%s', valor_neto='%s', descuento='%s', total='%s'
					WHERE ventas_id=%d;",
					fn_filtro(1),
					fn_filtro($fecha),
					fn_filtro(2),
					fn_filtro($_POST['almacen_id']),
					fn_filtro($_POST['condicion_pago']),
					fn_filtro($_POST['pago']),
					fn_filtro($_POST['fechapago']),
					fn_filtro($_POST['impuesto1']),
					fn_filtro($_POST['valor_neto']),
					fn_filtro($_POST['descuento']),
					fn_filtro($_POST['total']),
					fn_filtro((int)$_POST['ventas_id'])
	);
    mysql_select_db($database_fastERP, $fastERP);
    $ventas = mysql_query($query_ventas, $fastERP) or die(mysql_error());

    if($_POST['pago'] == "C") {
    	$pago = -1 * ($_POST['total']);
    } else {
    	$pago = 0;
    }
	    /*CTA Corriente*/
		$query_ctacorriente_cliente = sprintf("INSERT INTO `controlg_controlerp`.`ctacorriente_cliente` (`fecha`, `cliente_id`, `almacen_id`, `ventas_id`, `monto`) 
		                VALUES ('%s', '%s', '%s', '%s', '%s');",
						fn_filtro($fecha),
		                fn_filtro($_POST['cliente_id']),
		                fn_filtro($_POST['almacen_id']),
		                fn_filtro($_POST['ventas_id']),
		                fn_filtro($pago)
		);
	    mysql_select_db($database_fastERP, $fastERP);
	    $ctacorriente_cliente = mysql_query($query_ctacorriente_cliente, $fastERP) or die(mysql_error());
	    $ultima_cta = mysql_insert_id();


	    /*CTA corriente detalle*/
		$ultimacta = "SELECT * FROM `ctacorriente_cliente` ORDER BY `ctacorriente_cliente_id` DESC LIMIT 1";
	    mysql_select_db($database_fastERP, $fastERP);
	    $ultimacta = mysql_query($ultimacta, $fastERP) or die(mysql_error());
	    $row_ultimacta = mysql_fetch_assoc($ultimacta);

		$productocta = "SELECT ventas_env.producto_id, ventas_env.lleva, ventas_env.devuelve
						FROM ventas_env , ventas , producto
						WHERE ventas_env.ventas_id = $_POST[ventas_id] 
						AND ventas_env.ventas_id = ventas.ventas_id
						AND ventas_env.producto_id = producto.producto_id ";
	    mysql_select_db($database_fastERP, $fastERP);
	    $productocta = mysql_query($productocta, $fastERP) or die(mysql_error());
	    $row_productocta = mysql_fetch_assoc($productocta);
    	

	    do {
	    	$ctacorriente_cliente_env = sprintf("INSERT INTO `controlg_controlerp`.`ctacorriente_cliente_env` (`ctacorriente_cliente_id`, `producto_id`, `cantidad`) 
			    	                            VALUES ('%s', '%s', '%s');",
			    	                            fn_filtro($row_ultimacta['ctacorriente_cliente_id']),
			    	                            fn_filtro($row_productocta['producto_id']),
			    	                            fn_filtro(($row_productocta['devuelve'] - $row_productocta['lleva']))
	        );
	        if(!mysql_query($ctacorriente_cliente_env, $fastERP))
	            echo "Error al insertar:\n";
	    } while ( $row_productocta = mysql_fetch_assoc($productocta) );





    /*Comprobante*/
	$comprobante_det = sprintf("INSERT INTO `controlg_controlerp`.`comprobante_det` (`comprobante_id`, `ventas_id`, `numero`, `monto`) 
	                VALUES ('%s', '%s', '%s', '%s');",
	                fn_filtro($_POST['condicion_pago']),
	                fn_filtro($_POST['ventas_id']),
	                fn_filtro($_POST['numero']),
	                fn_filtro($_POST['total'])
	);
	if(!mysql_query($comprobante_det, $fastERP))
		echo "Error al insertar:\n$comprobante_det";




    $query_condicion_pago = "SELECT comprobante.ultimo_numero, comprobante.comprobante_id
							FROM comprobante , comprobante_tipo
							WHERE comprobante.comprobante_tipo_id = comprobante_tipo.comprobante_tipo_id 
							AND comprobante_tipo.comprobante_tipo_id = $_POST[comprobante_tipo_id]
							AND comprobante.comprobante_id = $_POST[condicion_pago]";
    mysql_select_db($database_fastERP, $fastERP);
    $condicion_pago = mysql_query($query_condicion_pago, $fastERP) or die(mysql_error());
    $row_condicion_pago = mysql_fetch_assoc($condicion_pago);
    $ultimo_numero = @$row_condicion_pago['ultimo_numero'] + 1;

	$comprobante = sprintf("UPDATE `controlg_controlerp`.`comprobante` 
							SET `ultimo_numero` = '%s'
			                WHERE comprobante_id = '%s'",
			                fn_filtro($ultimo_numero), 
			                fn_filtro($row_condicion_pago['comprobante_id'])
	);
	if(!mysql_query($comprobante, $fastERP))
		echo "Error al insertar:\n$comprobante";




	$query = "SELECT * FROM `controlg_controlerp`.`almacen_det` 
			  WHERE almacen_det.ventas_id = $_POST[ventas_id]";
    mysql_select_db($database_fastERP, $fastERP);
    $almacen = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_almacen = mysql_num_rows($almacen);

	$query = "SELECT ventas.almacen_id, ventas.ventas_id, producto_ensamblado.producto_ensamblado_id,producto_ensamblado.unidad_id,
					 producto_ensamblado.producto, producto.producto_id, producto.producto, producto.factor, ventas_det.cantidad
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
		    $envase_lleva_devuelve = "SELECT ventas_env.producto_id, ventas_env.lleva, ventas_env.devuelve,
		    								  producto.categoria_id, producto.unidad_id
									  FROM ventas_env , ventas , producto
									  WHERE ventas_env.ventas_id = $_POST[ventas_id] 
									  AND ventas_env.ventas_id = ventas.ventas_id 
									  AND ventas_env.producto_id = producto.producto_id
									  AND producto.producto_id = $row_table[producto_id]";
		    mysql_select_db($database_fastERP, $fastERP);
		    $envase_lleva_devuelve = mysql_query($envase_lleva_devuelve, $fastERP) or die(mysql_error());
		    $totalRows_lleva_devuelve = mysql_num_rows($envase_lleva_devuelve);
		    $row_envase_lleva_devuelve = mysql_fetch_assoc($envase_lleva_devuelve);

		    if($totalRows_lleva_devuelve = 0) {
		    	$lleva_devuelveX = 0;
		    } else {
		    	$lleva_devuelveX = $row_envase_lleva_devuelve['devuelve'];
		    }

		    	if ($row_table['unidad_id']==2)
		    		 $elvis_cantidad = $row_table['cantidad'] * $row_table['factor'];
		    	else
		    		 $elvis_cantidad = $row_table['cantidad'] * 1;
		    		
            $almacen_det = sprintf("INSERT INTO `controlg_controlerp`.`almacen_det` (`almacen_id`, `ventas_id`, `producto_id`, `producto_ensamblado_id`, `cantidad`, `activo`) 
                            VALUES ('%s', '%s', '%s', '%s', '%s', '%s');",
                            fn_filtro($row_table['almacen_id']),
                            fn_filtro($row_table['ventas_id']),
                            fn_filtro($row_table['producto_id']),
                            fn_filtro($row_table['producto_ensamblado_id']),
                            fn_filtro((-1 * ($elvis_cantidad) + $lleva_devuelveX)),
                            fn_filtro(1)
            );

            if(!mysql_query($almacen_det, $fastERP))
                echo "Error al insertar:\n$almacen_det";

    	} while ( $row_table = mysql_fetch_assoc($table) );
    }
?>


