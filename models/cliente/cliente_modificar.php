<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['nombres'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

    $fecha = date("Y/m/d H:i:s");

	$sql = sprintf("UPDATE `controlg_controlerp`.`cliente` SET nombres='%s', apellidos='%s', dni='%s', empresa='%s', ruc='%s', direccion='%s', zona_id='%s', fecha_nac='%s', fecha='%s'
					WHERE cliente_id=%d;",
					fn_filtro($_POST['nombres']),
					fn_filtro($_POST['apellidos']),
					fn_filtro($_POST['dni']),
					fn_filtro($_POST['empresa']),
					fn_filtro($_POST['ruc']),
					fn_filtro($_POST['direccion']),
					fn_filtro($_POST['zona_id']),
					fn_filtro($_POST['fecha_nac']),
					fn_filtro($fecha),
					fn_filtro((int)$_POST['cliente_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar:\n$sql";

	exit;
?>