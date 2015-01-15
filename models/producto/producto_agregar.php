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
	
	$sql = sprintf("INSERT INTO `controlg_controlerp`.`producto` (`producto`, `unidad_id`, `moneda_id`, `categoria_id`, `imp_tipo_id`, `activo`, `kit`, `num_serie`, `precio`, `imagen`, `notas`) 
	                VALUES ('%s', '%s', '%s', '%s', '%s', '%s', %d, '%s', '%s', '%s', '%s');",
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
					fn_filtro($_POST['notas'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al insertar el nuevo producto:\n$sql";

	exit;
?>