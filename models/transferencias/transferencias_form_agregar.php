<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 
?>
<style type="text/css">
	.chosen-container {
	  width: 250px !important;
	}
</style>
<form action="javascript: fn_agregar_transferencias();" class="form-horizontal" method="post" id="frm_transferencias" enctype="multipart/form-data" >
    <input type="hidden" id="fecha_registro" name="fecha_registro" value="<?php echo date("Y/m/d H:i:s"); ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_producto();">&times;</button>
        <h4 class="blue bigger">Agregar transferencias</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="producto"><b>producto </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <select class="chosen-select col-xs-2" name="producto_id" id="producto_id">
							<?php query_table_option("SELECT * FROM producto_ensamblado WHERE producto_ensamblado.categoria_id = 5", "producto_ensamblado_id", "producto"); ?>
						</select>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="disponibles"><b>disponibles </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon" id="div_listar_productos">
                        <input type="text" class="input-xlarge" name="disponibles" id="disponibles" placeholder="disponibles" required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="transferencia"><b>transferencia </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="transferencia" id="transferencia" placeholder="transferencia" required />
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
                <input type="hidden" name="MM_insert" value="frm_transferencias">

            </div>
        </div>
    </div>
</form>
<script language="javascript" type="text/javascript">
    function fn_agregar_transferencias(){
        var str = $("#frm_transferencias").serialize();
        $.ajax({
            url: '../models/transferencias/transferencias_agregar.php',
            data: str,
            type: 'post',
            success: function(data){
                if(data != "")
                    alert(data);
                fn_cerrar_producto();
                fn_buscar_transferencias();
            }
        });
    };

    $("#producto_id").change(function(){/*Funcion para listar todos los tipos de comprobantes...*/
        var producto_id = document.getElementById('producto_id');
        console.log(producto_id.value);
        $.ajax({
            url: '../models/transferencias/transferencias_listar_productos.php?producto_id=' +producto_id.value,
            data: "producto_id=" +producto_id.value,
            type: 'get',
            success: function(data){
              $("#div_listar_productos").html(data);
            }
        });
    });

    /*Choosen select*/
    $('.chosen-select').chosen();

    
    $('#frm_transferencias').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            transferencias: {
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
            transferencias: {
                required: "<a data-original-title='The last tip!' title='Ingresa un transferencias válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
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