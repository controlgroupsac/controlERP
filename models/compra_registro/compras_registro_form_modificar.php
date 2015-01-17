<?php
	if(empty($_POST['compra_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

	$query = "SELECT * FROM compra
              WHERE compra.compra_id = $_POST[compra_id]";

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
	if ($totalRows_table == 0){
		echo "No existen detalles de compra con ese ID";
		exit;
	}
?>
<form action="javascript: fn_modificar_compra_registro();" class="form-horizontal" method="post" id="frm_compra" enctype="multipart/form-data" >
    <input type="hidden" name="compra_id" id="compra_id" value="<?php echo $_POST['compra_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_compra();">&times;</button>
        <h4 class="blue bigger">Modificar Producto</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="proveedor_id"><b>proveedor </b></label>

                <div class="col-sm-9">
                    <select class="form-control" name="proveedor_id" id="proveedor_id">
                        <?php query_table_option_comparar("SELECT * FROM proveedor", "proveedor_id", "proveedor", $row_table['proveedor_id']) ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="almacen_id"><b>almacen </b></label>

                <div class="col-sm-9">
                    <select class="form-control" name="almacen_id" id="almacen_id">
                        <?php query_table_option_comparar("SELECT * FROM almacen", "almacen_id", "almacen", $row_table['almacen_id']) ?>
                    </select>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <br>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_compra();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Modificar
                    </button>
                </div>
                <input type="hidden" name="MM_insert" value="frm_compra">

            </div>
        </div>
    </div>
</form>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$("#frm_compra").validate({
			submitHandler: function(form) {
				var respuesta = confirm('\xBFDesea realmente modificar?')
				if (respuesta)
					form.submit();
			}
		});
	});
	
	function fn_modificar_compra_registro(){
		var str = $("#frm_compra").serialize();
		$.ajax({
			url: '../models/compra_registro/compras_registro_modificar.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "")
					alert(data);
				fn_cerrar_compra();
				fn_buscar_compras_registro();
			}
		});
	};
</script>