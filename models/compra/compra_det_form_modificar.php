<?php
	if(empty($_POST['compra_det_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

	$query = "SELECT compra_det.compra_det_id, compra_det.producto_id, compra_det.cantidad, compra_det.monto, compra_det.compra_det_id, producto.producto
              FROM compra_det , compra , producto
              WHERE compra_det.compra_det_id = $_POST[compra_det_id]
              AND compra_det.compra_id = compra.compra_id 
              AND compra_det.producto_id = producto.producto_id
              ORDER BY `compra_det`.compra_det_id DESC";

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
	if ($totalRows_table == 0){
		echo "No existen detalles de compra con ese ID";
		exit;
	}
?>
<form action="javascript: fn_modificar_compra_det();" class="form-horizontal" method="post" id="frm_compra_det" enctype="multipart/form-data" >
    <input type="hidden" name="compra_det_id" id="compra_det_id" value="<?php echo $_POST['compra_det_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_compra();">&times;</button>
        <h4 class="blue bigger">Modificar Producto</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="producto_id"><b>Producto </b></label>

                <div class="col-sm-9">
                    <select class="form-control" name="producto_id" id="producto_id">
                        <?php query_table_option_comparar("SELECT * FROM producto", "producto_id", "producto", $row_table['producto_id']) ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="cantidad"><b>cantidad </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="cantidad" id="cantidad" placeholder="cantidad" value="<?php echo $row_table['cantidad'] ?>" required />
                        <i class="ace-icon fa fa-number"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="monto"><b>monto </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="monto" id="monto" placeholder="monto" value="<?php echo $row_table['monto'] ?>" required />
                        <i class="ace-icon fa fa-dollar"></i>
                    </span>
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
                <input type="hidden" name="MM_insert" value="frm_compra_det">

            </div>
        </div>
    </div>
</form>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$("#frm_compra_det").validate({
			submitHandler: function(form) {
				var respuesta = confirm('\xBFDesea realmente modificar este detalle de compra?')
				if (respuesta)
					form.submit();
			}
		});
	});
	
	function fn_modificar_compra_det(){
		var str = $("#frm_compra_det").serialize();
		$.ajax({
			url: '../models/compra/compra_det_modificar.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "")
					alert(data);
				fn_cerrar_compra();
				fn_buscar_compra_det();
			}
		});
	};


    $('#frm_compra_det').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            compra_det: {
                required: true
            },
            cantidad: {
                required: true
            }
        },

        messages: {
            compra_det: {
                required: "<a data-original-title='The last tip!' title='Ingresa un compra_det válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            },
            cantidad: {
                required: "<a data-original-title='The last tip!' title='Ingresa un cantidad válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });
</script>