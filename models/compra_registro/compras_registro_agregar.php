<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['proveedor_id']) || empty($_POST['almacen_id'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}
	
	$sql = sprintf("INSERT INTO `controlg_controlerp`.`compra` (`proveedor_id`, `almacen_id`) 
	                VALUES (%s, %s);",
					fn_filtro($_POST['proveedor_id']),
					fn_filtro($_POST['almacen_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al insertar:\n$sql";

	exit;
?>