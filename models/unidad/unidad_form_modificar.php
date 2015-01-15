<?php
	if(empty($_POST['unidad_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

	$query = "SELECT * FROM `controlg_controlerp`.`unidad` WHERE unidad.unidad_id = $_POST[unidad_id]";

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);
    $totalRows_table = mysql_num_rows($table);
	if ($totalRows_table == 0){
		echo "No existen detalles de compras con ese ID";
		exit;
	}
?>
<form action="javascript: fn_modificar_unidad();" method="post" id="frm_unidad" enctype="multipart/form-data" >
    <input type="hidden" class="input-xlarge" name="unidad_id" id="unidad_id" value="<?php echo $row_table['unidad_id']; ?>" />
    <input type="hidden" id="fecha_registro" name="fecha_registro" value="<?php echo date("Y/m/d H:i:s"); ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_producto();">&times;</button>
        <h4 class="blue bigger">Agregar undiad</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="unidad"><b>unidad </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="unidad" id="unidad" placeholder="unidad" value="<?php echo $row_table['unidad']; ?>" required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="abrev"><b>Abrev </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="abrev" id="abrev" placeholder="abrev" value="<?php echo $row_table['abrev']; ?>" required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_producto();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Agregar
                    </button>
                </div>
                <input type="hidden" name="MM_insert" value="frm_unidad">

            </div>
        </div>
    </div>
</form>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$("#frm_unidad").validate({
			submitHandler: function(form) {
				var respuesta = confirm('\xBFDesea realmente modificar este unidad?')
				if (respuesta)
					form.submit();
			}
		});
	});
	
	function fn_modificar_unidad(){
		var str = $("#frm_unidad").serialize();
		$.ajax({
			url: '../models/unidad/unidad_modificar.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "")
					alert(data);
				fn_cerrar();
				fn_buscar_unidad();
			}
		});
	};


    $('#frm_unidad').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            unidad: {
                required: true
            },
            precio: {
                required: true
            }
        },

        messages: {
            unidad: {
                required: "<a data-original-title='The last tip!' title='Ingresa un unidad válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            },
            precio: {
                required: "<a data-original-title='The last tip!' title='Ingresa un precio válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });
</script>