<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

	$sql = sprintf("UPDATE `controlg_controlerp`.`compra` SET estado='%s'
            WHERE compra_id=%d;",
            fn_filtro(4),
            fn_filtro((int)$_GET['compra_id'])
    );
	if(!mysql_query($sql, $fastERP))
		echo "Error al insertar:\n$sql";
?>
<span class=" label label-lg arrowed-right" id="anulado" >Anulado</span> <!-- Fase 3 de la compra -->
<a class="btn btn-xs btn-info" href="compras_registro.php">Cerrar</a>
