<?php
	include "../../config/conexion.php"; 
	include "../../config/basico.php";

    $sql2 = sprintf("UPDATE `controlg_controlerp`.`compra` SET estado='%s'
                     WHERE compra_id=%d;",
                     fn_filtro(3),
                     fn_filtro((int)$_GET['compra_id'])
    );
    $compra = mysql_query($sql2, $fastERP) or die(mysql_error());
?>
<span class=" label label-lg label-success arrowed-right" id="recibido" >Recibido</span> <!-- Fase 3 de la compra -->
<a class="btn btn-xs btn-info" href="compras_registro.php">Cerrar</a>