<?php
	if(empty($_POST['empresa_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

	$query = "SELECT * FROM empresa WHERE empresa_id = $_POST[empresa_id]";

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);
    $totalRows_table = mysql_num_rows($table);
	if ($totalRows_table == 0){
		echo "No existen detalles de compras con ese ID";
		exit;
	}
?>
<form action="javascript: fn_modificar_empresa();" method="post" id="frm_empresa">
    <input type="hidden" id="empresa_id" name="empresa_id" value="<?php echo $row_table['empresa_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar();">&times;</button>
        <h4 class="blue bigger">Modificar empresa</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label" for="empresa"><b>empresa </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="empresa" id="empresa" value="<?php echo $row_table['empresa']; ?>" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="propiedtario"><b>propiedtario </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="propiedtario" id="propiedtario" value="<?php echo $row_table['propiedtario']; ?>" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label" for="ruc"><b>ruc </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="ruc" id="ruc" value="<?php echo $row_table['ruc']; ?>" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">

                <div class="form-group">
                    <label class="control-label" for="ciudad"><b>ciudad </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="ciudad" id="ciudad" value="<?php echo $row_table['ciudad']; ?>" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>  

                <div class="form-group">
                    <label class="control-label" for="pais"><b>pais </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="pais" id="pais" value="<?php echo $row_table['pais']; ?>">
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>   

                <div class="form-group">
                    <label class="control-label" for="direccion"><b>direccion </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="direccion" id="direccion" value="<?php echo $row_table['direccion']; ?>" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>  

                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Agregar
                    </button>
                </div>
                <input type="hidden" name="MM_insert" value="frm_empresa">

            </div>
        </div>
    </div>
</form>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$("#frm_empresa").validate({
			submitHandler: function(form) {
				var respuesta = confirm('\xBFDesea realmente modificar este empresa?')
				if (respuesta)
					form.submit();
			}
		});
	});
	
	function fn_modificar_empresa(){
		var str = $("#frm_empresa").serialize();
		$.ajax({
			url: '../models/usuario/empresa_modificar.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "")
					alert(data);
				fn_cerrar();
				fn_buscar_empresa();
			}
		});
	};
</script>