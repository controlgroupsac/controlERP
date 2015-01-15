<?php
	if(empty($_POST['producto_id'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

	$query = "SELECT unidad.unidad, moneda.moneda, 
                     producto.producto_id, producto.producto, producto.activo, producto.kit, producto.precio, producto.num_serie, producto.notas, 
                     categoria.categoria, imp_tipo.descripcion
              FROM producto , unidad , moneda , categoria , imp_tipo 
              WHERE producto.producto_id = $_POST[producto_id]
              AND producto.unidad_id = unidad.unidad_id 
              AND producto.moneda_id = moneda.moneda_id 
              AND producto.categoria_id = categoria.categoria_id 
              AND producto.imp_tipo_id = imp_tipo.imp_tipo_id";

    mysql_select_db($database_fastERP, $fastERP);
    $table = mysql_query($query, $fastERP) or die(mysql_error());
    $row_table = mysql_fetch_assoc($table);
    $totalRows_table = mysql_num_rows($table);
	if ($totalRows_table == 0){
		echo "No existen detalles de compras con ese ID";
		exit;
	}
?>
<form action="javascript: fn_modificar_producto();" method="post" id="frm_producto" enctype="multipart/form-data" >
    <input type="hidden" class="input-xlarge" name="producto_id" id="producto_id" value="<?php echo $row_table['producto_id']; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="fn_cerrar_producto();">&times;</button>
        <h4 class="blue bigger">Modificar producto</h4>
    </div>
    <div class="modal-body overflow-visible">
        <div class="row-fluid">
            <div class="col-xs-12">
                <div class="col-xs-8">
                    <div class="form-group">
                        <label class="control-label" for="producto"><b>producto </b></label>

                        <div>
                            <span class=" input-icon">
                                <input type="text" class="input-xlarge" name="producto" id="producto" value="<?php echo $row_table['producto']; ?>" />
                                <i class="ace-icon fa fa-user"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label" for="unidad"><b>unidad </b></label>

                        <div>
                            <span>
                                <select id="unidad_id" name="unidad_id">
                                    <?php query_table_option("SELECT * FROM unidad", "unidad_id", "unidad"); ?>
                                </select>
                            </span>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-xs-12">
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label" for="moneda"><b>moneda </b></label>

                        <div>
                            <span>
                                <select id="moneda_id" name="moneda_id">
                                    <?php query_table_option("SELECT * FROM moneda", "moneda_id", "moneda"); ?>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-3">
                    <div class="form-group">
                        <label class="control-label" for="categoria"><b>categoria </b></label>

                        <div>
                            <span>
                                <select id="categoria_id" name="categoria_id">
                                    <?php query_table_option("SELECT * FROM categoria", "categoria_id", "categoria"); ?>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-5">
                    <div class="form-group">
                        <label class="control-label" for="imp_tipo"><b>Impuesto </b></label>

                        <div>
                            <span>
                                <select id="imp_tipo_id" name="imp_tipo_id">
                                    <?php query_table_option("SELECT * FROM imp_tipo", "imp_tipo_id", "descripcion"); ?>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12"> 
                <div class="form-group col-xs-8">

                    <div>
                        <span class="input-icon">
                            <input type="text" class="input-xlarge" name="num_serie" id="num_serie" placeholder="Numero de serie" value="<?php echo $row_table['num_serie']; ?>ctos" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group col-xs-4">
                    <div>
                        <span class="input-icon">
                            <input type="text" class="input-small" name="precio" id="precio" placeholder="S/. 0.00" value="<?php echo $row_table['precio']; ?>" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </div>
                </div>
            </div>
    
            <div class="col-xs-12"> 
                <div class="form-group col-xs-3">
                    <label for="estado"><b>Estado</b></label>

                    <div>
                        <label>
                            <input name="activo" type="radio" class="ace" value="1" <?php if($row_table['activo'] == 1){ echo "checked"; } ?> />
                            <span class="lbl"><strong> Activo</strong></span>
                        </label>
                        &nbsp;&nbsp; &nbsp;&nbsp;
                        <label>
                            <input name="activo" type="radio" class="ace" value="0" <?php if($row_table['activo'] == 0){ echo "checked"; } ?> />
                            <span class="lbl"><strong> Inactivo</strong></span>
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>

                <div class="form-group col-xs-3">
                    <label for="kit"><b>Kit</b></label>

                    <div>
                        <label>
                            <input name="kit" name="kit" class="ace ace-switch ace-switch-5" type="checkbox" <?php if($row_table['kit'] == 1){ echo "checked"; } ?> />
                            <span class="lbl"></span>
                        </label>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <div class="">
                        <input multiple="" type="file" name="imagen"id="imagen" />
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div>
                    <span class="input-icon">
                        <textarea name="notas" id="notas" cols="60" rows="2" placeholder="Agregue una nota aquí...">
                            <?php echo $row_table['notas']; ?>
                        </textarea>
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
                <input type="hidden" name="MM_insert" value="<?php echo $row_table['']; ?>to">

            </div>
        </div>
    </div>
</form>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$("#frm_producto").validate({
			submitHandler: function(form) {
				var respuesta = confirm('\xBFDesea realmente modificar este producto?')
				if (respuesta)
					form.submit();
			}
		});
	});
	
	function fn_modificar_producto(){
		var str = $("#frm_producto").serialize();
		$.ajax({
			url: '../models/producto/producto_modificar.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "")
					alert(data);
				fn_cerrar();
				fn_buscar_producto();
			}
		});
	};

    
    $('#imagen').ace_file_input({
        style:'well',
        btn_choose:'Drop files here or click to choose',
        btn_change:null,
        no_icon:'ace-icon fa fa-cloud-upload',
        droppable:true,
        thumbnail:'large'//large | fit
        //,icon_remove:null//set null, to hide remove/reset button
        /**,before_change:function(files, dropped) {
            //Check an example below
            //or examples/file-upload.html
            return true;
        }*/
        /**,before_remove : function() {
            return true;
        }*/
        ,
        preview_error : function(filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
        }
    
    }).on('change', function(){
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });
    
    
    //$('#imagen')
    //.ace_file_input('show_file_list', [
        //{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
        //{type: 'file', name: 'hello.txt'}
    //]);

    $('#frm_producto').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            producto: {
                required: true
            },
            precio: {
                required: true
            }
        },

        messages: {
            producto: {
                required: "<a data-original-title='The last tip!' title='Ingresa un producto válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            },
            precio: {
                required: "<a data-original-title='The last tip!' title='Ingresa un precio válido.' data-rel='tooltip' href='#'><i class='fa fa-warning-sign'></i></a>"
            }
        }
    });
</script>