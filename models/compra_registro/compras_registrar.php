<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	/*verificamos si las variables se envian*/
	if(empty($_POST['proveedor_id']) || empty($_POST['almacen_id'])) {
	  echo "Usted no a llenado todos los campos";
	  exit;
	}

	$query = "SELECT * FROM `controlg_controlerp`.`compra`, `controlg_controlerp`.`compra_det` 
			  WHERE compra_det.compra_id = $_POST[compra_id]
			  AND compra.compra_id = compra_det.compra_id";
    mysql_select_db($database_fastERP, $fastERP);
    $tabla = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_tabla = mysql_num_rows($tabla);

    if ($totalRows_tabla <= 0) {
?>
    	<script type='text/javascript'>
    		alert('Aún agregó, ningun producto.');
    		location.reload();
		</script>
<?php  
    }else {
    	$sql = sprintf("UPDATE `controlg_controlerp`.`compra` 
					SET almacen_id='%s', proveedor_id='%s', estado='%s', condic_pago='%s', serie='%s', numero='%s', fecha_doc='%s', impuesto1='%s', valor_neto='%s', descuento='%s', total='%s'
					WHERE compra_id=%d;",
					fn_filtro($_POST['almacen_id']),
					fn_filtro($_POST['proveedor_id']),
					fn_filtro(2),
					fn_filtro($_POST['condic_pago']),
					fn_filtro($_POST['serie']),
					fn_filtro($_POST['numero']),
					fn_filtro($_POST['fecha_doc']),
					fn_filtro($_POST['impuesto1']),
					fn_filtro($_POST['valor_neto']),
					fn_filtro($_POST['descuento']),
					fn_filtro($_POST['total']),
					fn_filtro((int)$_POST['compra_id'])
		);

		if(!mysql_query($sql, $fastERP))
			echo "Error al insertar:\n$sql";
    }
?>
<span class=" label label-lg label-pink arrowed-right" id="registrado" >Registrado</span> <!-- Fase 2 de la compra -->
<button type="button" class=" btn btn-sm btn-success" id="recibir"> Recibir </button> <!-- Fase 2 de la compra -->
<button type="button" class=" btn btn-sm btn-danger" id="rechazar"> Rechazar </button> <!-- Fase 2 de la compra -->
<script type='text/javascript'> location.reload(); </script>