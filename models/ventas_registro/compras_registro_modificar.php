<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['proveedor_id']) || empty($_POST['almacen_id'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}
	
	$sql = sprintf("UPDATE `controlg_controlerp`.`compra` SET proveedor_id='%s', almacen_id='%s'
					WHERE compra_id=%d;",
					fn_filtro($_POST['proveedor_id']),
					fn_filtro($_POST['almacen_id']),
					fn_filtro((int)$_POST['compra_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar:\n$sql";

	exit;
?>