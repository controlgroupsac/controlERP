<?php
	if(empty($_POST['moneda_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

	$query = "SELECT * FROM `controlg_controlerp`.`moneda` WHERE moneda.moneda_id = $_POST[moneda_id]";

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);
    $totalRows_table = mysql_num_rows($table);
	if ($totalRows_table == 0){
		echo "No existen monedas con ese ID";
		exit;
	}
?>
<form action="javascript: fn_modificar_moneda();" method="post" id="frm_moneda" enctype="multipart/form-data" >
    <input type="hidden" class="input-xlarge" name="moneda_id" id="moneda_id" value="<?php echo $row_table['moneda_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_producto();">&times;</button>
        <h4 class="blue bigger">Modificar Moneda</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="moneda"><b>Moneda </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="moneda" id="moneda" placeholder="moneda" value="<?php echo $row_table['moneda']; ?>" required />
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

            <div class="form-group">
                <label class="col-sm-3 control-label" for="prefijo"><b>Prefijo </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="prefijo" id="prefijo" placeholder="prefijo" value="<?php echo $row_table['prefijo']; ?>" required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_producto();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Modificar
                    </button>
                </div>
                <input type="hidden" name="MM_insert" value="frm_moneda">

            </div>
        </div>
    </div>
</form>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$("#frm_moneda").validate({
			submitHandler: function(form) {
				var respuesta = confirm('\xBFDesea realmente modificar este moneda?')
				if (respuesta)
					form.submit();
			}
		});
	});
	
	function fn_modificar_moneda(){
		var str = $("#frm_moneda").serialize();
		$.ajax({
			url: '../models/moneda/moneda_modificar.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "")
					alert(data);
				fn_cerrar_producto();
				fn_buscar_moneda();
			}
		});
	};


    $('#frm_moneda').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            moneda: {
                required: true
            },
            abrev: {
                required: true
            },
            prefijo: {
                required: true
            }
        },

        messages: {
            moneda: {
                required: "<a data-original-title='The last tip!' title='Ingresa un moneda válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            },
            abrev: {
                required: "<a data-original-title='The last tip!' title='Ingresa un abrev válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            },
            prefijo: {
                required: "<a data-original-title='The last tip!' title='Ingresa un prefijo válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });
</script>