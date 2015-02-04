<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 

    $fecha = date("Y/m/d H:i:s");
    $sql = sprintf("INSERT INTO `controlg_controlerp`.`almacen_transferencia` (`almacen_origen_id`, `almacen_destino_id`, `fecha`) 
	                VALUES ('%s', '%s', '%s');",
					fn_filtro($_GET['origen']),
					fn_filtro($_GET['destino']),
					fn_filtro($fecha)
	);
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($sql, $fastERP) or die(mysql_error());

	$id = mysql_insert_id();

?>
<div class="widget-box widget-color-blue">
	<div class="widget-header">
		<i class="fa fa-table"></i>
		<h5 class="widget-title"> Lista de tranferencias 
			<span class="label label-lg label-yellow circle">
				<?php echo $id; ?>
			</span>
		</h5>

		<div class="widget-toolbar">
			<a href="#" data-action="collapse">
				<i class="1 ace-icon fa fa-chevron-up"></i>
			</a>
		</div>

		<div class="widget-toolbar no-border">
			<button class="btn btn-sm btn-success" id="nuevaTranferencia"> Agregar tranferencia </button>
		</div>
	</div>

	<div class="widget-body">
		<div class="widget-main scrollable" data-size="250">
			<div id="div_listar_tranferencias_registro"></div>
			<div id="div_oculto_tranferencias_registro" class="none"></div>
		</div>
	</div>
</div>