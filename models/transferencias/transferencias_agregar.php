<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['origen']) || empty($_POST['destino'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}
	
    $fecha = date("Y/m/d H:i:s");
	$sql = sprintf("INSERT INTO `controlg_controlerp`.`almacen_transferencia` (`almacen_origen_id`, `almacen_destino_id`, `fecha`) 
	                VALUES ('%s', '%s', '%s');",
					fn_filtro($_POST['origen']),
					fn_filtro($_POST['destino']),
					fn_filtro($fecha)
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al insertar\n$sql";

	exit;
?>