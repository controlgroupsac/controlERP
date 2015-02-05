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
    <input type="hidden" id="origen" name="origen" value="<?php echo $_GET['origen']; ?>" />
    <input type="hidden" id="destino" name="destino" value="<?php echo $_GET['destino']; ?>" />
    <input type="hidden" id="transferencia_id" name="transferencia_id" value="<?php echo $_GET['transferencia_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_transferencias();">&times;</button>
        <h4 class="blue bigger">Agregar transferencias</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="producto"><b>producto </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <select class="chosen-select col-xs-2" name="producto_id" id="producto_id" data-placeholder="Seleccione un producto..." required>
                            <option value=""></option>
							<?php query_table_option("SELECT * FROM producto_ensamblado WHERE producto_ensamblado.categoria_id = 5", "producto_ensamblado_id", "producto"); ?>
						</select>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="disponible"><b>Disponible </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon" id="div_listar_productos">
                        <input type="text" class="input-xlarge" name="disponible" id="disponible" placeholder="disponible" value="0" required readonly />
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
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_transferencias();">Cancelar</a>

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
            url: '../models/transferencias/transferencias_producto_agregar.php',
            data: str,
            type: 'get',
            success: function(data){
                if(data != "")
                    alert(data);
                fn_cerrar_transferencias_producto();
                fn_buscar_transferencias_producto();
            }
        });
    };

    $("#producto_id").change(function(){ 
        var data = $("#frm_transferencias").serialize();
        $.ajax({
            url: '../models/transferencias/transferencias_productos_lista_productos.php?producto_id=' +producto_id.value,
            data: data, 
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
            producto_id: {
                required: true
            },
            disponible: {
                required: true
            }
        },

        messages: {
            transferencias: {
                required: "<a data-original-title='The last tip!' title='Ingresa un transferencias válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            },
            producto_id: {
                required: "<a data-original-title='The last tip!' title='Ingresa un producto_id válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            },
            disponible: {
                required: "<a data-original-title='The last tip!' title='Ingresa un disponible válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });
</script>