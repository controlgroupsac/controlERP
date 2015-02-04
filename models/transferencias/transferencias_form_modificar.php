<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php";

    $query = "SELECT almacen_det.cantidad, almacen_det.producto_id
              FROM almacen_det , producto
              WHERE almacen_det.almacendet_id = $_POST[almacendet_id]
              AND almacen_det.producto_id = producto.producto_id " ;
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
<form action="javascript: fn_modificar_transferencias();" class="form-horizontal" method="post" id="frm_transferencias" enctype="multipart/form-data" >
    <input type="hidden" id="almacendet_id" name="almacendet_id" value="<?php echo $_POST['almacendet_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_transferencias();">&times;</button>
        <h4 class="blue bigger">Modificar transferencia</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="transferencia"><b>transferencia </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="transferencia" id="transferencia" placeholder="Cantidad a transferir" required value="<?php echo $row_table["cantidad"]; ?>" />
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
    function fn_modificar_transferencias(){
        var str = $("#frm_transferencias").serialize();
        console.log(str);
        $.ajax({
            url: '../models/transferencias/transferencias_modificar.php',
            data: str,
            type: 'get',
            success: function(data){
                if(data != "")
                    alert(data);
                fn_cerrar_transferencias();
                fn_buscar_transferencias_registro();
            }
        });
    };

    
    $('#frm_transferencias').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            transferencias: {
                required: true
            }
        },

        messages: {
            transferencias: {
                required: "<a data-original-title='The last tip!' title='Ingresa un transferencias válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });
</script>