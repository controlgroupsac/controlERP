<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_GET['producto_id']) || empty($_GET['transferencia'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	$query_productos = "SELECT producto.producto_id, producto.producto, producto_ensamblado.producto_ensamblado_id, producto.factor
						FROM producto , producto_ensamblado_det , producto_ensamblado
						WHERE producto_ensamblado_det.producto_ensamblado_id = $_GET[producto_id] 
						AND producto_ensamblado_det.producto_ensamblado_id = producto_ensamblado.producto_ensamblado_id
						AND producto_ensamblado_det.producto_id = producto.producto_id " ;
	mysql_select_db($database_fastERP, $fastERP);
	$table_productos = mysql_query($query_productos, $fastERP) or die(mysql_error());
	$totalRows_table_productos = mysql_num_rows($table_productos);
	$row_table_productos = mysql_fetch_assoc($table_productos);
	
	$i = 0;
	do {
		$sql = sprintf("INSERT INTO `controlg_controlerp`.`almacen_det` (`almacen_id`, `transferencia_id`, `producto_id`, `producto_ensamblado_id`, `cantidad`, `activo`) 
		                VALUES (%s, %s, %s, %s, %s, %s);",
						fn_filtro($_GET['origen']),
						fn_filtro($_GET['transferencia_id']),
						fn_filtro($row_table_productos['producto_id']),
						fn_filtro($row_table_productos['producto_ensamblado_id']),
						fn_filtro($_GET['transferencia'] * $row_table_productos['factor']), 
						fn_filtro($i)
		);	
		$i++;
		mysql_select_db($database_fastERP, $fastERP);
		$table = mysql_query($sql, $fastERP) or die(mysql_error());
	} while ( $row_table_productos = mysql_fetch_assoc($table_productos) );
?>