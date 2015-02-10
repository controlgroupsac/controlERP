<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*ctacorriente_vendedor*/
	$fecha = date("Y-m-d H:i:s");
	$sql_ctacte = sprintf("INSERT INTO `controlg_controlerp`.`ctacorriente_vendedor` (`fecha`, `usuario_id`, `transferencia_id`, `anulado`) 
		                   VALUES (now(), %s, %s, %s);",
						   fn_filtro(1),
						   fn_filtro($_GET['transferencia_id']),
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

		/*ctacorriente_vendedor ENVASES*/
		$sql = sprintf("INSERT INTO `controlg_controlerp`.`ctacorriente_vendedor_env` (`ctacorriente_vendedor_id`, `producto_id`, `cantidad`) 
		                VALUES (%s, %s, %s);",
						fn_filtro($id),
						fn_filtro($_GET['producto_id'.$i]),
						fn_filtro($_GET['total'.$i])
		);	
		mysql_select_db($database_fastERP, $fastERP);
		$table = mysql_query($sql, $fastERP) or die(mysql_error());
	}
?> 