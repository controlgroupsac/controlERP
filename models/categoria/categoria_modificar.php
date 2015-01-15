<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['categoria'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	$sql = sprintf("UPDATE `controlg_controlerp`.`categoria` SET categoria='%s'
					WHERE categoria_id=%d;",
					fn_filtro($_POST['categoria']),
					fn_filtro((int)$_POST['categoria_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar el detalle de compra:\n$sql";

	exit;
?>