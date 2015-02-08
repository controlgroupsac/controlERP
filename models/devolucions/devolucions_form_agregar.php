<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 
?>
<style type="text/css">
    .chosen-container {
        width: 250px !important;
    }
</style>
<form action="javascript: fn_agregar_devolucions();" class="form-horizontal" method="post" id="frm_devolucions">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_devolucions();">&times;</button>
        <h4 class="blue bigger">Agregar Devoluciones</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="control-label no-padding-right" for="origen"> <strong>Origen</strong> </label>

                <select class="chosen-select col-xs-2" name="origen" id="origen">
                    <?php query_table_option("SELECT * FROM almacen WHERE almacen_id <> 1", "almacen_id", "almacen") ?>
                </select>
            </div>

            <div class="form-group">
                <label class=" control-label no-padding-right" for="destino"> <strong>destino</strong> </label>
                <select class="chosen-select col-xs-2" name="destino" id="destino">
                    <?php query_table_option("SELECT * FROM almacen WHERE almacen_id = 1", "almacen_id", "almacen") ?>
                </select>
            </div>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_devolucions();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Agregar
                    </button>
                </div>
                <input type="hidden" name="MM_insert" value="frm_devolucions">

            </div>
        </div>
    </div>
</form>
<script language="javascript" type="text/javascript">

    function fn_agregar_devolucions(){
        var str = $("#frm_devolucions").serialize();
        var origen = $("#origen").val();
        var destino = $("#destino").val();
        console.log(str)
        if (origen == destino) {
            alert("El ORIGEN no puede ser el mismo que el DESTINO");
        }else {
            $.ajax({
                url: '../models/devolucions/devolucions_agregar.php',
                data: str,
                type: 'post',
                success: function(data){
                    if(data != "")
                        alert(data);
                    fn_cerrar_devolucions();
                    fn_buscar_devolucions();
                }
            });
        }
    };

    /*Choosen select*/
    $('.chosen-select').chosen();
    
    $('#frm_devolucions').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            origen: {
                required: true
            },
            destino: {
                required: true
            }
        },

        messages: {
            origen: {
                required: "<a data-original-title='The last tip!' title='Ingresa un origen válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            },
            destino: {
                required: "<a data-original-title='The last tip!' title='Ingresa un destino válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });
</script>