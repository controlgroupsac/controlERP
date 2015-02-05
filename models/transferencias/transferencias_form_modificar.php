<?php
	if(empty($_POST['transferencias_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

    include "../../config/conexion.php"; 
    include("../../queries/query.php");

    $transferencia = @$_POST['transferencias_id'];
    if($transferencia == "" || empty($transferencia)) {
      $transferencia = "";
    }
    $query = "SELECT origen.almacen AS origen, destino.almacen AS destino, 
                     almacen_transferencia.transferencia_id, almacen_transferencia.almacen_origen_id, almacen_transferencia.almacen_destino_id
              FROM almacen_transferencia , almacen AS origen , almacen AS destino
              WHERE origen.almacen_id = almacen_transferencia.almacen_origen_id
              AND destino.almacen_id = almacen_transferencia.almacen_destino_id
              AND almacen_transferencia.transferencia_id = $transferencia" ;
    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $totalRows_table = mysql_num_rows($table);
    $row_table = mysql_fetch_assoc($table);
?>

<style type="text/css">
    .chosen-container {
        width: 250px !important;
    }
</style>
<form action="javascript: fn_agregar_transferencias();" class="form-horizontal" method="post" id="frm_transferencias">
    <input type="hidden" name="transferencia_id" id="transferencia_id" value="<?php echo $row_table['transferencia_id']; ?>">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_transferencias();">&times;</button>
        <h4 class="blue bigger">Modificar transferencias</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="control-label no-padding-right" for="origen"> <strong>Origen</strong> </label>

                <select class="chosen-select col-xs-2" name="origen" id="origen">
                    <?php query_table_option_comparar("SELECT * FROM almacen", "almacen_id", "almacen", $row_table['almacen_origen_id']); ?>
                </select>
            </div>

            <div class="form-group">
                <label class=" control-label no-padding-right" for="destino"> <strong>destino</strong> </label>
                <select class="chosen-select col-xs-2" name="destino" id="destino">
                    <?php query_table_option_comparar("SELECT * FROM almacen", "almacen_id", "almacen", $row_table['almacen_destino_id']); ?>
                </select>
            </div>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_transferencias();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Modificar
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
        var origen = $("#origen").val();
        var destino = $("#destino").val();
        console.log(str)
        if (origen == destino) {
            alert("El ORIGEN no puede ser el mismo que el DESTINO");
        }else {
            $.ajax({
                url: '../models/transferencias/transferencias_modificar.php',
                data: str,
                type: 'post',
                success: function(data){
                    if(data != "")
                        alert(data);
                    fn_cerrar_transferencias();
                    fn_buscar_transferencias();
                }
            });
        }
    };

    /*Choosen select*/
    $('.chosen-select').chosen();
    
    $('#frm_transferencias').validate({
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