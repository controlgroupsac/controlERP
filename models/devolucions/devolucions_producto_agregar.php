<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$total = $_GET['totalRows_table'];
	for ($i=0; $i < $total; $i++) { 
		/*Almacen Detalle de transferencia */
		$query_transferencia_detalle = sprintf("INSERT INTO `controlg_controlerp`.`almacen_transferencias_detalle` (`almacen_transferencias_id`, `producto_ensamblado_id`, `producto_id`, `cantidad`, `faltante`) 
								                VALUES (%s, %s, %s, %s, %s);",
												fn_filtro($_GET['transferencia_id']),
												fn_filtro($_GET['producto_ensamblado_id'.$i]),
												fn_filtro($_GET['producto_id'.$i]),
												fn_filtro($_GET['devuelve'.$i]),
												fn_filtro($_GET['total'.$i])
		);

		/*DESTINO*/
		mysql_select_db($database_fastERP, $fastERP);
		$transferencia_detalle = mysql_query($query_transferencia_detalle, $fastERP) or die(mysql_error());

		$sql = sprintf("INSERT INTO `controlg_controlerp`.`almacen_det` (`almacen_id`, `transferencia_id`, `producto_id`, `producto_ensamblado_id`, `cantidad`, `activo`) 
		                VALUES (%s, %s, %s, %s, %s, %s);",
						fn_filtro($_GET['destino']),
						fn_filtro($_GET['transferencia_id']),
						fn_filtro($_GET['producto_id'.$i]),
						fn_filtro($_GET['producto_ensamblado_id'.$i]),
						fn_filtro($_GET['devuelve'.$i]),  
						fn_filtro(1)
		);	
		mysql_select_db($database_fastERP, $fastERP);
		$table = mysql_query($sql, $fastERP) or die(mysql_error());

		/*ORIGEN*/
		$sql = sprintf("INSERT INTO `controlg_controlerp`.`almacen_det` (`almacen_id`, `transferencia_id`, `producto_id`, `producto_ensamblado_id`, `cantidad`, `activo`) 
		                VALUES (%s, %s, %s, %s, %s, %s);",
						fn_filtro($_GET['origen']),
						fn_filtro($_GET['transferencia_id']),
						fn_filtro($_GET['producto_id'.$i]),
						fn_filtro($_GET['producto_ensamblado_id'.$i]),
						fn_filtro(-1 * $_GET['devuelve'.$i]),  
						fn_filtro(1)
		);	
		mysql_select_db($database_fastERP, $fastERP);
		$table = mysql_query($sql, $fastERP) or die(mysql_error());
	}
?> 