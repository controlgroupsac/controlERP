<?php
	if(empty($_POST['ventas_det_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

	$query = "SELECT ventas_det.cantidad, ventas_det.producto_id, ventas_det.precio, ventas_det.ventas_det_id, producto.producto
              FROM ventas_det , producto
              WHERE ventas_det.producto_id = producto.producto_id 
              AND ventas_det.ventas_det_id = $_POST[ventas_det_id]";

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);
    $totalRows_table = mysql_num_rows($table);
?>
<form action="javascript: fn_modificar_ventas_det();" class="form-horizontal" method="post" id="frm_ventas_det" enctype="multipart/form-data" >
    <input type="hidden" name="ventas_det_id" id="ventas_det_id" value="<?php echo $row_table['ventas_det_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_ventas();">&times;</button>
        <h4 class="blue bigger">Modificar Detalle Ventas</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">

            <div class="form-group">
                <label class="col-xs-4 no-padding-right" for="producto"><b>producto </b></label>

                <div class="col-xs-7">
                    <select class="chosen-select form-control" id="producto_id" name="producto_id">
                        <?php query_table_option_comparar("SELECT * FROM producto", "producto_id", "producto", $row_table['producto_id']); ?>
                    </select>
                </div>
            </div> 

            <div class="form-group">
                <label class="col-xs-4 control-label no-padding-right" for="cantidad"><b>cantidad </b></label>

                <div>
                    <span class="input-icon">
                        <input type="text" name="cantidad" id="cantidad" placeholder="cantidad" value="<?php echo $row_table['cantidad']; ?>" autofocus required />
                        <i class="ace-icon fa fa-user"></i>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-4 control-label no-padding-right" for="precio"><b>precio </b></label>
                <div>
                    <span class="input-icon">
                        <input type="text" name="precio" id="precio" placeholder="precio`" value="<?php echo $row_table['precio']; ?>" required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_ventas();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Guardar!
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script language="javascript" type="text/javascript">
    $(".chosen-select").chosen({no_results_text: "Oops, no existe!"}); 
    
	function fn_modificar_ventas_det(){
		var str = $("#frm_ventas_det").serialize();
		$.ajax({
			url: '../models/ventas/ventas_det_modificar.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "")
					alert(data);
				fn_cerrar();
				fn_buscar_ventas_det();
			}
		});
	};

    $('#frm_ventas_det').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            cantidad: {
                required: true
            },
            precio: {
                required: true
            }
        },

        messages: {
            cantidad: {
                required: "<a data-original-title='The last tip!' title='Ingresa un cantidad válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            },
            precio: {
                required: "<a data-original-title='The last tip!' title='Ingresa un precio válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });
</script>