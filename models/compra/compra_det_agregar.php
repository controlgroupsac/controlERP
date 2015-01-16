<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['compra_id']) || empty($_POST['producto_id']) || empty($_POST['cantidad']) || empty($_POST['monto'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}
	
	$sql = sprintf("INSERT INTO `controlg_controlerp`.`compra_det` (`compra_id`, `producto_id`, `cantidad`, `monto`) 
	                VALUES ('%s', '%s', '%s', '%s');",
					fn_filtro($_POST['compra_id']),
					fn_filtro($_POST['producto_id']),
					fn_filtro($_POST['cantidad']),
					fn_filtro($_POST['monto'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al insertar el nuevo detalle de compra:\n$sql";

	exit;
?>