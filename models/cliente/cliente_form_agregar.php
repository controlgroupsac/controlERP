<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 
?>
<form action="javascript: fn_agregar_cliente();" class="form-horizontal" method="post" id="frm_cliente">
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
                        <input type="text" class="input-xlarge" name="nombres" id="nombres" placeholder="nombres" value="nombres" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="apellidos"><b>apellidos </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="apellidos" id="apellidos" placeholder="apellidos" value="apellidos" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="dni"><b>dni </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="dni" id="dni" maxlength="8" placeholder="dni" value="12345678" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="empresa"><b>empresa </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="empresa" id="empresa" placeholder="empresa" value="empresa" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="ruc"><b>ruc </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="ruc" id="ruc" maxlength="11" placeholder="ruc" value="12345678912" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="direccion"><b>direccion </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="direccion" id="direccion" maxlength="11" placeholder="direccion" value="12345678912" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="zona"><b>zona </b></label>

                <div class="col-sm-9">
                    <span>
                        <select id="zona_id" name="zona_id">
                            <?php query_table_option("SELECT * FROM zona", "zona_id", "zona"); ?>
                        </select>
                    </span>
                </div>
            </div> 

            <div class="form-group">
                <label class="col-sm-3 control-label" for="fecha_nac"><b>fecha_nac </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="fecha_nac" id="fecha_nac" placeholder="fecha_nac" value="1990-05-05" />
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
    function fn_agregar_cliente(){
        var str = $("#frm_cliente").serialize();
        $.ajax({
            url: '../models/cliente/cliente_agregar.php',
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