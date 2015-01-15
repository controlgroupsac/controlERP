<?php
	if(empty($_POST['categoria_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

	$query = "SELECT * FROM `controlg_controlerp`.`categoria` WHERE categoria.categoria_id = $_POST[categoria_id]";

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);
    $totalRows_table = mysql_num_rows($table);
	if ($totalRows_table == 0){
		echo "No existen categoriaes con ese ID";
		exit;
	}
?>
<form action="javascript: fn_modificar_categoria();" method="post" id="frm_categoria" enctype="multipart/form-data" >
    <input type="hidden" class="input-xlarge" name="categoria_id" id="categoria_id" value="<?php echo $row_table['categoria_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_producto();">&times;</button>
        <h4 class="blue bigger">Modificar undiad</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="categoria"><b>categoria </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="categoria" id="categoria" placeholder="categoria" value="<?php echo $row_table['categoria']; ?>" required />
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
                <input type="hidden" name="MM_insert" value="frm_categoria">

            </div>
        </div>
    </div>
</form>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$("#frm_categoria").validate({
			submitHandler: function(form) {
				var respuesta = confirm('\xBFDesea realmente modificar esta categoria?')
				if (respuesta)
					form.submit();
			}
		});
	});
	
	function fn_modificar_categoria(){
		var str = $("#frm_categoria").serialize();
		$.ajax({
			url: '../models/categoria/categoria_modificar.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "")
					alert(data);
				fn_cerrar_producto();
				fn_buscar_categoria();
			}
		});
	};


    $('#frm_categoria').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            categoria: {
                required: true
            }
        },

        messages: {
            categoria: {
                required: "<a data-original-title='The last tip!' title='Ingresa un categoria válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });
</script>