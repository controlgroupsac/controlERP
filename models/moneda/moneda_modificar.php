<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['moneda']) || empty($_POST['abrev']) || empty($_POST['prefijo'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	$sql = sprintf("UPDATE `controlg_controlerp`.`moneda` SET moneda='%s', abrev='%s', prefijo='%s'
					WHERE moneda_id=%d;",
					fn_filtro($_POST['moneda']),
					fn_filtro($_POST['abrev']),
					fn_filtro($_POST['prefijo']),
					fn_filtro((int)$_POST['moneda_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar el detalle de compra:\n$sql";

	exit;
?>