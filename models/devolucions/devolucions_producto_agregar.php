<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*Variables Globales*/
	$transferencia_id = $_GET['transferencia_id'];
	$destino 		  = $_GET['destino'];
	$origen 		  = $_GET['origen'];

	/*ctacorriente_vendedor*/
	$sql_ctacte = sprintf("INSERT INTO `controlg_controlerp`.`ctacorriente_vendedor` (`fecha`, `usuario_id`, `transferencia_id`, `anulado`) 
		                   VALUES (now(), %s, %s, %s);",
						   fn_filtro(1),
						   fn_filtro($transferencia_id),
						   fn_filtro(0)
	);	
	mysql_select_db($database_fastERP, $fastERP);
	$table_ctacte = mysql_query($sql_ctacte, $fastERP) or die(mysql_error());
	
	$id = mysql_insert_id();
	$query_cta = "SELECT * FROM `ctacorriente_vendedor` ORDER BY `ctacorriente_vendedor`.`ctacorriente_vendedor_id` DESC LIMIT 1" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table_cta = mysql_query($query_cta, $fastERP) or die(mysql_error());
    $totalRows_table_cta = mysql_num_rows($table_cta); 
    $row_table_cta = mysql_fetch_assoc($table_cta); 


	$total = $_GET['totalRows_table'];
	for ($i=0; $i < $total; $i++) { 

		$factor = $_GET['factor'.$i];
		$devuelve = $_GET['devuelve'.$i];
		$diferencia = $_GET['total'.$i];

		if($factor > 1) {
			$posicion = strrpos($devuelve, "/");
			$cajas = substr($devuelve, 0, $posicion) * $factor;
			$botellas = substr($devuelve, $posicion + 1);
			$devuelve = $cajas + $botellas;

			$posicion1 = strrpos($diferencia, "/");
			$cajas1 = substr($diferencia, 0, $posicion1) * $factor;
			$botellas1 = substr($diferencia, $posicion1 + 1);
			$diferencia = $cajas1 + $botellas1;
		} 


		/*Variables de bucle*/
		$producto_id = $_GET['producto_id'.$i];
		$producto_ensamblado_id = $_GET['producto_ensamblado_id'.$i];

		/**/
		/**/
		/**/
		/*ALMACEN DETALLE DE TRANSFERENCIA */
		/*Verificamos si ya hay datos para el producto*/
		$query = "SELECT almacen_transferencias_detalle.almacen_transferencias_detalle_id, almacen_transferencias_detalle.cantidad
				   FROM almacen_transferencias_detalle
				   WHERE almacen_transferencias_detalle.almacen_transferencias_id = $transferencia_id 
				   AND almacen_transferencias_detalle.producto_id = $producto_id " ;
	    mysql_select_db($database_fastERP, $fastERP);
	    $table = mysql_query($query, $fastERP) or die(mysql_error());
	    $totalRows_table = mysql_num_rows($table); 
	    $row_table = mysql_fetch_assoc($table); 
	    /*QUERY almacen detalle de transferencia*/
	    if($totalRows_table == 0) {
			$query_transferencia_detalle = sprintf("INSERT INTO `controlg_controlerp`.`almacen_transferencias_detalle` (`almacen_transferencias_id`, `producto_ensamblado_id`, `producto_id`, `cantidad`, `faltante`) 
									                VALUES (%s, %s, %s, %s, %s);",
													fn_filtro($transferencia_id),
													fn_filtro($producto_ensamblado_id),
													fn_filtro($producto_id),
													fn_filtro($devuelve),
													fn_filtro($diferencia)
			);
			mysql_select_db($database_fastERP, $fastERP);
			$transferencia_detalle = mysql_query($query_transferencia_detalle, $fastERP) or die(mysql_error());
	    } else {
			$cantidad = $row_table['cantidad'] + $devuelve;
	    	$query_transferencia_detalle = sprintf("UPDATE `controlg_controlerp`.`almacen_transferencias_detalle` SET cantidad='%s', faltante='%s'
						    	                    WHERE almacen_transferencias_detalle_id = %d;",
						    	                    fn_filtro($cantidad),
						    	                    fn_filtro($diferencia),
						    	                    fn_filtro((int)$row_table['almacen_transferencias_detalle_id'])
	    	);
			mysql_select_db($database_fastERP, $fastERP);
			$transferencia_detalle = mysql_query($query_transferencia_detalle, $fastERP) or die(mysql_error());
	    }
	    /**/
	    /**/
	    /**/



	    /**/
	    /**/
	    /**/
		/*ORIGEN*/
		/*Verificamos si ya hay datos para el producto*/
		$query = "SELECT almacen_det.almacendet_id, almacen_det.cantidad
				   FROM almacen_det
				   WHERE almacen_det.almacen_id = $origen 
				   AND almacen_det.transferencia_id = $transferencia_id
				   AND almacen_det.producto_id = $producto_id" ;
	    mysql_select_db($database_fastERP, $fastERP);
	    $table = mysql_query($query, $fastERP) or die(mysql_error());
	    $totalRows_table = mysql_num_rows($table); 
	    $row_table = mysql_fetch_assoc($table);
	    /*QUERY origen*/
	    if($totalRows_table == 0) {
			$sql = sprintf("INSERT INTO `controlg_controlerp`.`almacen_det` (`almacen_id`, `transferencia_id`, `producto_id`, `producto_ensamblado_id`, `cantidad`, `activo`) 
			                VALUES (%s, %s, %s, %s, %s, %s);",
							fn_filtro($origen),
							fn_filtro($transferencia_id),
							fn_filtro($producto_id),
							fn_filtro($producto_ensamblado_id),
							fn_filtro(-1 * $devuelve),  
							fn_filtro(1)
			);	
			mysql_select_db($database_fastERP, $fastERP);
			$table = mysql_query($sql, $fastERP) or die(mysql_error());
	    } else {
			$cantidad = $row_table['cantidad'] - $devuelve;
	    	$sql = sprintf("UPDATE `controlg_controlerp`.`almacen_det` SET cantidad='%s'
    	                    WHERE almacendet_id = %d;", 
    	                    fn_filtro($cantidad),
    	                    fn_filtro((int)$row_table['almacendet_id'])
	    	);
			mysql_select_db($database_fastERP, $fastERP);
			$table = mysql_query($sql, $fastERP) or die(mysql_error());
	    }
	    /**/
	    /**/
	    /**/



	    /**/
	    /**/
	    /**/
		/*DESTINO*/
		/*Verificamos si ya hay datos para el producto*/
		$query = "SELECT almacen_det.almacendet_id, almacen_det.cantidad
				   FROM almacen_det
				   WHERE almacen_det.almacen_id = $destino 
				   AND almacen_det.transferencia_id = $transferencia_id
				   AND almacen_det.producto_id = $producto_id" ;
	    mysql_select_db($database_fastERP, $fastERP);
	    $table = mysql_query($query, $fastERP) or die(mysql_error());
	    $totalRows_table = mysql_num_rows($table); 
	    $row_table = mysql_fetch_assoc($table);
	    /*QUERY destino*/
	    if($totalRows_table == 0) {
			$sql = sprintf("INSERT INTO `controlg_controlerp`.`almacen_det` (`almacen_id`, `transferencia_id`, `producto_id`, `producto_ensamblado_id`, `cantidad`, `activo`) 
			                VALUES (%s, %s, %s, %s, %s, %s);",
							fn_filtro($destino),
							fn_filtro($transferencia_id),
							fn_filtro($producto_id),
							fn_filtro($producto_ensamblado_id),
							fn_filtro($devuelve),  
							fn_filtro(1)
			);	
			mysql_select_db($database_fastERP, $fastERP);
			$table = mysql_query($sql, $fastERP) or die(mysql_error());
	    } else {
			$cantidad = $row_table['cantidad'] + $devuelve;
	    	$sql = sprintf("UPDATE `controlg_controlerp`.`almacen_det` SET cantidad='%s'
    	                    WHERE almacendet_id = %d;", 
    	                    fn_filtro($cantidad),
    	                    fn_filtro((int)$row_table['almacendet_id'])
	    	);
			mysql_select_db($database_fastERP, $fastERP);
			$table = mysql_query($sql, $fastERP) or die(mysql_error());
	    }
	    /**/
	    /**/
	    /**/



	    /**/
	    /**/
	    /**/
		/*CTACORRIENTE_VENDEDOR ENVASES*/
		/*Verificamos si ya hay datos para el producto*/
		$query = "SELECT ctacorriente_vendedor_env.ctacorriente_vendedor_env_id, ctacorriente_vendedor_env.cantidad
				   FROM ctacorriente_vendedor_env
				   WHERE ctacorriente_vendedor_env.producto_id = $producto_id" ;
	    mysql_select_db($database_fastERP, $fastERP);
	    $table = mysql_query($query, $fastERP) or die(mysql_error());
	    $totalRows_table = mysql_num_rows($table); 
	    $row_table = mysql_fetch_assoc($table);
	    /*QUERY destino*/
	    if($totalRows_table == 0) {
			$sql = sprintf("INSERT INTO `controlg_controlerp`.`ctacorriente_vendedor_env` (`ctacorriente_vendedor_id`, `producto_id`, `cantidad`) 
			                VALUES (%s, %s, %s);",
							fn_filtro($id),
							fn_filtro($producto_id),
							fn_filtro($diferencia)
			);	
			mysql_select_db($database_fastERP, $fastERP);
			$table = mysql_query($sql, $fastERP) or die(mysql_error());
	    } else {
			$cantidad = $row_table['cantidad'] + $devuelve;
	    	$sql = sprintf("UPDATE `controlg_controlerp`.`ctacorriente_vendedor_env` SET cantidad='%s'
    	                    WHERE ctacorriente_vendedor_env_id = %d;", 
    	                    fn_filtro($cantidad),
    	                    fn_filtro((int)$row_table['ctacorriente_vendedor_env_id'])
	    	);
			mysql_select_db($database_fastERP, $fastERP);
			$table = mysql_query($sql, $fastERP) or die(mysql_error());
	    }
	    /**/
	    /**/
	    /**/
	}
?> 