<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 
?>
<form action="javascript: fn_agregar_moneda();" class="form-horizontal" method="post" id="frm_moneda" enctype="multipart/form-data" >
    <input type="hidden" id="fecha_registro" name="fecha_registro" value="<?php echo date("Y/m/d H:i:s"); ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_producto();">&times;</button>
        <h4 class="blue bigger">Agregar Moneda</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="moneda"><b>Moneda </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="moneda" id="moneda" placeholder="moneda" required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="abrev"><b>Abrev </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="abrev" id="abrev" placeholder="abrev" required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="prefijo"><b>Prefijo </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="prefijo" id="prefijo" placeholder="prefijo" required />
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
                <input type="hidden" name="MM_insert" value="frm_moneda">

            </div>
        </div>
    </div>
</form>
<script language="javascript" type="text/javascript">
    function fn_agregar_moneda(){
        var str = $("#frm_moneda").serialize();
        $.ajax({
            url: '../models/moneda/moneda_agregar.php',
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