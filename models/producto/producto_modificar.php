<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['producto']) || empty($_POST['unidad_id']) || empty($_POST['moneda_id']) || empty($_POST['categoria_id']) || empty($_POST['imp_tipo_id']) || empty($_POST['precio'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	@$nombreimagen=$_FILES['imagen']['name'];
	@$ruta=$_FILES['imagen']['tmp_name'];
	@$imagen =  "../../views/img/productos/".$nombreimagen;
	@copy($ruta, $imagen);
	@move_uploaded_file($ruta, $imagen);

	$query = "SELECT * FROM producto WHERE producto_id = $_POST[producto_id]";
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);

    if($nombreimagen == ''){
    	$nombreimagen = $row_table['imagen'];
    }
	
	$sql = sprintf("UPDATE `controlg_controlerp`.`producto` SET producto='%s', unidad_id='%s', moneda_id='%s', categoria_id='%s', imp_tipo_id='%s', activo='%s', num_serie='%s', precio='%s', imagen='%s', notas='%s'
					WHERE producto_id=%d;",
					fn_filtro($_POST['producto']),
					fn_filtro($_POST['unidad_id']),
					fn_filtro($_POST['moneda_id']),
					fn_filtro($_POST['categoria_id']),
					fn_filtro($_POST['imp_tipo_id']),
					fn_filtro($_POST['activo']),
					fn_filtro($_POST['num_serie']),
					fn_filtro($_POST['precio']),
					fn_filtro($nombreimagen),
					fn_filtro($_POST['notas']),
					fn_filtro((int)$_POST['producto_id'])
	);

	if(!mysql_query($sql, $fastERP))
		echo "Error al modificar el detalle de compra:\n$sql";

	exit;
?>