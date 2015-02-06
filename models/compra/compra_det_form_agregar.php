<?php 
    include "../../config/conexion.php"; 
    include "../../queries/query.php"; 
?>
<style type="text/css">
    .chosen-container {
        width: 250px;
    }
</style>
<form action="javascript: fn_agregar_compra_det();" class="form-horizontal" method="post" id="frm_compra_det" enctype="multipart/form-data" >
    <input type="hidden" id="compra_id" name="compra_id" value="<?php echo $_GET['compra_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_compra();">&times;</button>
        <h4 class="blue bigger">Agregar Producto</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="producto_id"><b>producto </b></label>

                <div class="col-sm-9">
                    <span class="input-icon">
                        <select class="chosen-select form-conol" name="producto_id" id="producto_id" data-placeholder="Seleccione el producto...">
                            <option value="0">Seleccione el producto...</option>
                            <?php query_table_option("SELECT * FROM producto_ensamblado ORDER BY producto_ensamblado.unidad_id DESC", "producto_ensamblado_id", "producto") ?>
                        </select>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="cantidad"><b>Cantidad </b></label>

                <div class="col-sm-9">
                    <span class="input-icon">
                        <input type="text" class="input-xlarge" name="cantidad" id="cantidad" placeholder="cantidad" required />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="monto"><b>Monto </b></label>

                <div class="col-sm-9">
                    <div id="div_listar_producto_monto">
                        <input type="text" class="input-xlarge" name="monto" id="monto" placeholder="monto" required />
                    </div>
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
    $(".chosen-select").chosen(); 
    
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

    $("#producto_id").change(function(){/*Funcion para listar todos los tipos de comprobantes...*/
        var producto_id = document.getElementById('producto_id');
        $.ajax({
            url: '../models/compra/compra_det_listar_producto_monto.php?producto_id=' +producto_id.value,
            data: "producto_id=" +producto_id.value,
            type: 'get',
            success: function(data){
              $("#div_listar_producto_monto").html(data);
            }
        });
    });
    
    $('#frm_compra_det').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            monto: {
                required: true
            },
            cantidad: {
                required: true
            }
        },

        messages: {
            monto: {
                required: "Campo requerido!"
            },
            cantidad: {
                required: "Campo requerido!"
            }
        }
    });
</script>