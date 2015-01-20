<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['cantidad']) || empty($_POST['precio'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}
	
	$sql = sprintf("UPDATE `controlg_controlerp`.`ventas_det` SET producto_id='%s', cantidad='%s', precio='%s'
					WHERE ventas_det_id=%d;",
					fn_filtro($_POST['producto_id']),
					fn_filtro($_POST['cantidad']),
					fn_filtro($_POST['precio']),
					fn_filtro((int)$_POST['ventas_det_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar el detalle de venta:\n$sql";

	exit;
?>