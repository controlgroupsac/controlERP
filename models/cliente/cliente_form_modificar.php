<?php
	if(empty($_POST['cliente_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 
    $query = "SELECT * FROM `controlg_controlerp`.`cliente`, `controlg_controlerp`.`zona` 
              WHERE cliente.zona_id = zona.zona_id
              AND cliente.cliente_id = $_POST[cliente_id]
              ORDER BY `cliente`.cliente_id DESC" ;

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);
    $totalRows_table = mysql_num_rows($table);
	if ($totalRows_table == 0){
		echo "No existen con ese ID";
		exit;
	}
?>
<form action="javascript: fn_modificar_cliente();" method="post" id="frm_cliente">
    <input type="hidden" name="cliente_id" id="cliente_id" value="<?php echo $_POST['cliente_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_cliente();">&times;</button>
        <h4 class="blue bigger">Agregar cliente</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="nombres"><b>nombres </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="nombres" id="nombres" placeholder="nombres" value="<?php echo $row_table['nombres']; ?>" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="apellidos"><b>apellidos </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="apellidos" id="apellidos" placeholder="apellidos" value="<?php echo $row_table['apellidos']; ?>" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="dni"><b>dni </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="dni" id="dni" maxlength="8" placeholder="dni" value="<?php echo $row_table['dni']; ?>" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="empresa"><b>empresa </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="empresa" id="empresa" placeholder="empresa" value="<?php echo $row_table['empresa']; ?>" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="ruc"><b>ruc </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="ruc" id="ruc" maxlength="11" placeholder="ruc" value="<?php echo $row_table['ruc']; ?>" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="direccion"><b>direccion </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="direccion" id="direccion" maxlength="11" placeholder="direccion" value="<?php echo $row_table['direccion']; ?>" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="zona"><b>zona </b></label>

                <div class="col-sm-9">
                    <span>
                        <select id="zona_id" name="zona_id">
                            <?php query_table_option_comparar("SELECT * FROM zona", "zona_id", "zona", $row_table['zona_id']); ?>
                        </select>
                    </span>
                </div>
            </div> 

            <div class="form-group">
                <label class="col-sm-3 control-label" for="fecha_nac"><b>fecha_nac </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge date-picker" name="fecha_nac" id="fecha_nac" placeholder="fecha_nac" value="<?php echo $row_table['fecha_nac']; ?>" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_cliente();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Agregar
                    </button>
                </div>
                <input type="hidden" name="MM_insert" value="frm_cliente">

            </div>
        </div>
    </div>
</form>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$("#frm_cliente").validate({
			submitHandler: function(form) {
				var respuesta = confirm('\xBFDesea realmente modificar?')
				if (respuesta)
					form.submit();
			}
		});
	});
	
	function fn_modificar_cliente(){
		var str = $("#frm_cliente").serialize();
		$.ajax({
			url: '../models/cliente/cliente_modificar.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "")
					alert(data);
				fn_cerrar_cliente();
				fn_buscar_cliente();
			}
		});
	};
</script>