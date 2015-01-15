<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['producto']) || empty($_POST['unidad_id']) || empty($_POST['moneda_id']) || empty($_POST['categoria_id']) || empty($_POST['imp_tipo_id']) || empty($_POST['precio'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	if (isset($_POST['kit'])) { $kit = 1; }else{ $kit = 0; }

	@$nombreimagen=$_FILES['imagen']['name'];
	@$ruta=$_FILES['imagen']['tmp_name'];
	@$imagen =  "images/productos/".$nombreimagen;
	@copy($ruta, $imagen);
	
	$sql = sprintf("UPDATE `controlg_controlerp`.`producto` SET producto='%s', unidad_id='%s', moneda_id='%s', categoria_id='%s', imp_tipo_id='%s', activo='%s', kit=%d, num_serie='%s', precio='%s', imagen='%s', notas='%s'
					WHERE producto_id=%d;",
					fn_filtro($_POST['producto']),
					fn_filtro($_POST['unidad_id']),
					fn_filtro($_POST['moneda_id']),
					fn_filtro($_POST['categoria_id']),
					fn_filtro($_POST['imp_tipo_id']),
					fn_filtro($_POST['activo']),
					fn_filtro($kit),
					fn_filtro($_POST['num_serie']),
					fn_filtro($_POST['precio']),
					fn_filtro($imagen),
					fn_filtro($_POST['notas']),
					fn_filtro((int)$_POST['producto_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar el detalle de compra:\n$sql";

	exit;
?>