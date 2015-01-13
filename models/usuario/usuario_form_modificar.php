<?php
	if(empty($_POST['usuario_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

	$query = "SELECT * FROM usuario WHERE usuario_id = $_POST[usuario_id]";

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);
    $totalRows_table = mysql_num_rows($table);
	if ($totalRows_table == 0){
		echo "No existen detalles de compras con ese ID";
		exit;
	}
?>
<form action="javascript: fn_modificar_usuario();" method="post" id="frm_usuario">
    <input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $row_table['usuario_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar();">&times;</button>
        <h4 class="blue bigger">Modificar usuario</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label" for="usuario"><b>usuario </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="usuario" id="usuario" value="<?php echo $row_table['usuario']; ?>" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="clave"><b>clave </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="password" name="clave" id="clave" value="<?php echo $row_table['clave']; ?>">
                            <i class="ace-icon fa fa-lock"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="nombres"><b>nombres </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="nombres" id="nombres" value="<?php echo $row_table['nombres']; ?>" />
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

                <div class="form-group">
                    <label class="control-label" for="telefono1"><b>Telefono 1 </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="telefono1" id="telefono1" value="<?php echo $row_table['telefono1']; ?>" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>  

                <div class="form-group">
                    <label class="control-label" for="nivel"><b>nivel </b></label>

                    <div>
                        <span>
                            <i class="ace-icon fa fa-user"></i>

                            <select id="nivel" name="nivel">
                                <option value="1" <?php if ($row_table['nivel'] == '1') { echo "selected"; } ?>>admin</option>
                                <option value="2" <?php if ($row_table['nivel'] == '2') { echo "selected"; } ?>>user</option>
                            </select>
                        </span>
                    </div>
                </div> 
            </div>
            <div class="col-xs-6">

                <div class="form-group">
                    <label class="control-label" for="email"><b>email </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="email" id="email" value="<?php echo $row_table['email']; ?>" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>  

                <div class="form-group">
                    <label class="control-label" for="repetir_clave"><b>repetir_clave </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="password" name="repetir_clave" id="repetir_clave" value="<?php echo $row_table['clave']; ?>">
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="apellidos"><b>apellidos </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="apellidos" id="apellidos" value="apellidos" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="fecha_nac"><b>F. Nacimiento </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="datetime" name="fecha_nac" id="fecha_nac" value="<?php echo $row_table['fecha_nac']; ?>" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="telefono2"><b>Telefono 2 </b></label>

                    <div>
                        <span class="input-icon">
                            <input type="text" name="telefono2" id="telefono2" value="<?php echo $row_table['telefono2']; ?>" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label for="activo"><b> activo</b></label>

                    <div>
                        <label>
                            <input type="checkbox" name="activo" name="activo" class="ace ace-switch ace-switch-5" <?php if ($row_table['activo'] == 1) { echo "checked"; } else { echo ""; } ?> />
                            <span class="lbl"></span>
                        </label>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label for="sexo"><b>sexo</b></label>

                    <div>
                        <label>
                            <input name="sexo" type="radio" class="ace" value="M" <?php if ($row_table['sexo'] == "M") { echo "checked"; } ?> />
                            <span class="lbl"><strong> M</strong></span>
                        </label>
                        &nbsp;&nbsp;
                        <label>
                            <input name="sexo" type="radio" class="ace" value="F" <?php if ($row_table['sexo'] == "F") { echo "checked"; } ?> />
                            <span class="lbl"><strong> F</strong></span>
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>

                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Agregar
                    </button>
                </div>
                <input type="hidden" name="MM_insert" value="frm_usuario">

            </div>
        </div>
    </div>
</form>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$("#frm_usuario").validate({
			submitHandler: function(form) {
				var respuesta = confirm('\xBFDesea realmente modificar este usuario?')
				if (respuesta)
					form.submit();
			}
		});
	});
	
	function fn_modificar_usuario(){
		var str = $("#frm_usuario").serialize();
		$.ajax({
			url: '../models/usuario/usuario_modificar.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "")
					alert(data);
				fn_cerrar();
				fn_buscar_usuario();
			}
		});
	};
</script>