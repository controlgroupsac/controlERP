<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['producto_id']) || empty($_POST['cantidad']) || empty($_POST['monto'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}
	
	$sql = sprintf("UPDATE `controlg_controlerp`.`compra_det` SET producto_id='%s', cantidad='%s', monto='%s'
					WHERE compra_det_id=%d;",
					fn_filtro($_POST['producto_id']),
					fn_filtro($_POST['cantidad']),
					fn_filtro($_POST['monto']),
					fn_filtro((int)$_POST['compra_det_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar el detalle de compra:\n$sql";

	exit;
?>