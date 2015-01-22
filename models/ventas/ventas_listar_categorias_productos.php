<?php  
	include "../../config/conexion.php"; 
    include("../../queries/query.php"); 

    $query = "SELECT * FROM categoria" ;
    mysql_select_db($database_fastERP, $fastERP);
    $categoria = mysql_query($query, $fastERP) or die(mysql_error());
    $row_categoria = mysql_fetch_assoc($categoria);
?>
<div class="tab-content">
	<?php do { ?>
	<div id="<?php echo $row_categoria['categoria']; ?>" class="tab-pane in <?php if($row_categoria['categoria_id'] == 5) { echo "active"; } ?>">
		<!-- PAGE CONTENT BEGINS -->
		<div>
			<ul class="ace-thumbnails clearfix">
				<?php  
					$query = "SELECT producto.producto_id, producto.producto, producto.precio
							  FROM producto, categoria
							  WHERE producto.categoria_id = categoria.categoria_id
							  AND producto.categoria_id = $row_categoria[categoria_id]
							  AND producto.kit = 1" ;
				    mysql_select_db($database_fastERP, $fastERP);
				    $producto = mysql_query($query, $fastERP) or die(mysql_error());
    				$totalRows_producto = mysql_num_rows($producto);
				    $row_producto = mysql_fetch_assoc($producto);
				if($totalRows_producto <= 0){

					}else {
						do { ?>
						<li class="tooltip-warning" data-rel="tooltip" data-placement="bottom"  data-original-title="<?php echo $row_producto['producto']; ?>">
							<a href="javascript: fn_mostrar_frm_agregar_venta_det(<?=$row_producto['producto_id']?>, <?=$row_producto['precio']?>);" data-rel="colorbox">
								<img width="100" class="opacity02" height="100" alt="100x100" src="img/productos/<?php echo $row_categoria['categoria']; ?>.jpg" />
								<div class="tags">
									<span class="label-holder">
										<span class="label label-info arrowed"><?php echo $row_producto['producto']; ?></span>
									</span>

									<span class="label-holder">
										<span class="label label-danger"><?php echo "S/. ".$row_producto['precio'].",00"; ?></span>
									</span>
								</div>
							</a>

							<div class="tools tools-top in">
								<span class="badge badge-warning">
									<?php  
										$query = "SELECT SUM(almacen_det.cantidad) AS cantidad
												  FROM producto, almacen_det
												  WHERE producto.producto_id = almacen_det.producto_id
												  AND producto.producto_id = $row_producto[producto_id]" ;
									    mysql_select_db($database_fastERP, $fastERP);
									    $cantidad_almacen = mysql_query($query, $fastERP) or die(mysql_error());
									    $row_cantidad_almacen = mysql_fetch_assoc($cantidad_almacen);

									    if($row_cantidad_almacen['cantidad'] == " " || empty($row_cantidad_almacen['cantidad']))
									    {
									    	echo 0;
									    }else {
									    	echo $row_cantidad_almacen['cantidad'];
									    }
									?>
								</span>
							</div>
						</li>
						<?php } while ($row_producto = mysql_fetch_assoc($producto)); 
					}
				?>
			</ul>
		</div><!-- PAGE CONTENT ENDS -->
		<!-- /.col -->
	</div>
	<?php } while ($row_categoria = mysql_fetch_assoc($categoria)); ?>
</div>
<script type="text/javascript">
	$('[data-rel=tooltip]').tooltip();
</script>