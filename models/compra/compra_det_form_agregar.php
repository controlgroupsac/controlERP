<?php 
    include "../../config/conexion.php"; 
    include "../../queries/functions.php"; 
?>
<form action="javascript: fn_agregar_compra_det();" class="form-horizontal" method="post" id="frm_compra_det" enctype="multipart/form-data" >
    <input type="hidden" id="compra_id" name="compra_id" value="<?php echo $_GET['compra_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_compra();">&times;</button>
        <h4 class="blue bigger">Agregar compra_det</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="producto_id"><b>producto </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <select class="form-control" name="producto_id" id="producto_id">
                            <?php query_table_option("SELECT * FROM producto", "producto_id", "producto") ?>
                        </select>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="cantidad"><b>cantidad </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="cantidad" id="cantidad" placeholder="cantidad" value="1" required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="monto"><b>monto </b></label>

                <div class="col-sm-9">
                    <span class=" input-icon">
                        <input type="text" class="input-xlarge" name="monto" id="monto" placeholder="monto" value="2.2" required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <a href="#" class="btn btn-small" data-dismiss="modal" onclick="fn_cerrar_compra();">Cancelar</a>

                    <button type="submit" class="btn btn-small btn-primary">
                        <i class="fa fa-ok"></i>
                        Agregar
                    </button>
                </div>
                <input type="hidden" name="MM_insert" value="frm_compra_det">

            </div>
        </div>
    </div>
</form>
<script language="javascript" type="text/javascript">
    function fn_agregar_compra_det(){
        var str = $("#frm_compra_det").serialize();
        console.log(str);
        $.ajax({
            url: '../models/compra/compra_det_agregar.php',
            data: str,
            type: 'post',
            success: function(data){
                if(data != "")
                    alert(data);
                fn_cerrar_compra();
                fn_buscar_compra_det();
            }
        });
    };
    
    $('#frm_compra_det').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            compra_det: {
                required: true
            },
            cantidad: {
                required: true
            }
        },

        messages: {
            compra_det: {
                required: "<a data-original-title='The last tip!' title='Ingresa un compra_det válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            },
            cantidad: {
                required: "<a data-original-title='The last tip!' title='Ingresa un cantidad válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });
</script>