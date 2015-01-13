<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['repetir_clave']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['email'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	if (isset($_POST['activo'])) { $activo = 1; }else{ $activo = 0; }

	$sql = sprintf("UPDATE `controlg_controlerp`.`usuario` SET usuario='%s', clave='%s', nivel='%s', activo=%d, direccion='%s', telefono1='%s', telefono2='%s', email='%s', nombres='%s', apellidos='%s', fecha_nac='%s', sexo='%s' 
					WHERE usuario_id=%d;",
		fn_filtro($_POST['usuario']),
		fn_filtro($_POST['clave']),
		fn_filtro($_POST['nivel']),
		fn_filtro($activo),
		fn_filtro($_POST['direccion']),
		fn_filtro($_POST['telefono1']),
		fn_filtro($_POST['telefono2']),
		fn_filtro($_POST['email']),
		fn_filtro($_POST['nombres']),
		fn_filtro($_POST['apellidos']),
		fn_filtro($_POST['fecha_nac']),
		fn_filtro($_POST['sexo']),
		fn_filtro((int)$_POST['usuario_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar el detalle de compra:\n$sql";

	exit;
?>