<?php  
	include "../config/conexion.php"; 
    include("../queries/query.php");
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>ControlERP</title>

		<meta name="description" content="Compras" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="fonts/css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="css/main.css" type="text/css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="css/datepicker.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="css/ace.min.css" />
		<link rel="stylesheet" href="css/ace-rtl.min.css" />
		
		<!-- ace settings handler -->
		<script src="js/vendor/ace-extra.min.js"></script>
	</head>

	<body class="no-skin">
		<?php include("../models/header.php"); ?>

		<div class="main-container" id="main-container">
			

			<?php include("../models/navbar.php"); ?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">


						<!-- /.ace-settings-container -->



						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php include("../models/sidebar.php"); ?>


								<!-- Small boxes (Stat box) -->
								<div class="row">
									<form action="#">
								    	<div class="col-lg-4">								    		
								    		<div class="form-group">
								    			<label class="col-sm-3 control-label text-right" for="fecha"> <strong>fecha</strong> </label>

								    			<div class="col-sm-9">
								    				<input class="form-control col-xs-10 col-sm-5 input-xlarge date-picker" id="fecha" type="text" value="<?php echo date("Y/m/d"); ?>" data-date-format="yyyy-mm-dd" />
								    			</div>
								    		</div>										
										</div>
								    	<div class="col-lg-4">								    		
								    		<div class="form-group">
								    			<label class="col-sm-3 control-label text-right" for="almacen_id"> <strong>almacen</strong> </label>

								    			<div class="col-sm-9">
								    				<select class="form-control" name="almacen_id" id="almacen_id">
								    					<?php query_table_option("SELECT * FROM almacen", "almacen_id", "almacen") ?>
								    				</select>
								    			</div>
								    		</div>										
										</div>
								    	<div class="col-lg-4">	
							    			<label class="col-sm-3 control-label text-right" for="estado"> <strong>estado</strong> </label>

							    			<div class="col-sm-9">
												<button class="btn btn-sm btn-danger" id="registrar"> Registrar </button>
												<button class="btn btn-sm btn-success" id="recibir"> Recibir </button>
							    			</div>										
										</div>
									    <div class="col-lg-12">
											<h2 class="col-lg-2" data-rel="tooltip" data-placement="right" title="Datos de proveedor">Proveedor</h2>
										</div><!--/span-->
								    	<div class="col-lg-3">								    		
								    		<div class="form-group">
								    			<label class="control-label no-padding-right" for="proveedor_id"> <strong>proveedor</strong> </label>

								    			<div>
								    				<select class="form-control" id="proveedor_id" id="proveedor_id">
								    					<?php query_table_option("SELECT * FROM proveedor", "proveedor_id", "proveedor") ?>
								    				</select>
								    			</div>
								    		</div>										
										</div>
								    	<div class="col-lg-5">								    		
								    		<div class="form-group">
								    			<label class="control-label col-lg-12 no-padding-right" for="documento"> <strong>documento</strong> </label>

								    			<div class="col-sm-4">
								    				<select class="form-control" id="documento" id="documento">
								    					<option value="1">Boleta</option>
								    					<option value="2">Factura</option>
								    					<option value="3">Ticket</option>
								    				</select>
								    			</div>
								    			<div class="col-sm-4">
								    				<input class="form-control" name="serie" id="serie" type="text" placeholder="serie" value="001-123456" />
								    			</div>
								    			<div class="col-sm-4">
								    				<input class="form-control" name="numero" id="numero" type="text" placeholder="numero" value="001-123456" />
								    			</div>
								    		</div>										
										</div>
								    	<div class="col-lg-2">								    		
								    		<div class="form-group">
								    			<label class="control-label no-padding-right" for="fecha_doc"> <strong>Fecha Emisión</strong> </label>

								    			<div>
								    				<input class="form-control input-xlarge date-picker" name="fecha_doc" id="fecha_doc" type="text" value="<?php echo date("Y/m/d"); ?>" data-date-format="yyyy-mm-dd" />
								    			</div>
								    		</div>										
										</div>
								    	<div class="col-lg-2">
								    		<div class="form-group">
								    			<label class="control-label no-padding-right" for="comprobtipo_id"> <strong>comprobtipo</strong> </label>

								    			<div>
								    				<select class="form-control" id="comprobtipo_id" id="comprobtipo_id">
								    					<option value="1">Boleta</option>
								    					<option value="2">Factura</option>
								    					<option value="3">Ticket</option>
								    				</select>
								    			</div>
								    		</div>										
										</div>
									</form>
								</div>

								<div class="row">
									<!-- `Detalle de compras -->
									<div class="col-xs-12 widget-container-col">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<i class="fa fa-table"></i>
												<h5 class="widget-title"> Detalle de compras </h5>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="1 ace-icon fa fa-chevron-up"></i>
													</a>
												</div>

												<div class="widget-toolbar no-border">
													<button class="btn btn-sm btn-success" id="nuevaCompra_det"> Agregar Producto </button>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main scrollable" data-size="200">
													<div id="div_listar_compra_det"></div>
	            									<div id="div_oculto_compra_det" class="none"></div>
												</div>
											</div>
										</div>
									</div>
								</div><!-- /.row -->

								<div class="row">
									<form action="#">
								    	<div class="col-lg-6">								    		
								    		<div class="form-group col-lg-12">
								    			<label class="col-sm-2 control-label no-padding-right" for="descuento"> <strong>descuento</strong> </label>

								    			<div class="col-sm-10">
								    				<input class="form-control col-xs-10 col-sm-5 input-xlarge" name="descuento" id="descuento" type="text" value="18" />
								    			</div>							    		
							    			</div>							    		
								    		<div class="form-group col-lg-4">
								    			<label class="col-sm-3 control-label right" for="igv"> <strong>IGV</strong> </label>

								    			<div class="col-sm-9">
								    				<input class="form-control col-xs-10 col-sm-5 input-xlarge" id="igv" id="igv" type="text" value="18" />
								    			</div>							    		
							    			</div>							    		
								    		<div class="form-group col-lg-4">
								    			<label class="col-sm-3 control-label right" for="isc"> <strong>ISC</strong> </label>

								    			<div class="col-sm-9">
								    				<input class="form-control col-xs-10 col-sm-5 input-xlarge" id="isc" id="isc" type="text" value="18" />
								    			</div>
								    		</div>										
										</div>

								    	<div class="col-lg-6">							    		
								    		<div class="form-group">
								    			<label class="col-sm-3 control-label no-padding-right" for="valor_neto"> <strong>valor_neto</strong> </label>

								    			<div class="col-sm-9">
								    				<input class="form-control col-xs-10 col-sm-5 input-xlarge" name="valor_neto" id="valor_neto" type="text" placeholder="valor neto" />
								    			</div>
								    		</div>								    		
								    		<div class="form-group">
								    			<label class="col-sm-3 control-label no-padding-right" for="impuesto1"> <strong>impuesto1</strong> </label>

								    			<div class="col-sm-9">
								    				<input class="form-control col-xs-10 col-sm-5 input-xlarge" name="impuesto1" id="impuesto1" type="text" placeholder="impuesto1" />
								    			</div>
								    		</div>								    		
								    		<div class="form-group">
								    			<label class="col-sm-3 control-label no-padding-right" for="total"> <strong>total</strong> </label>

								    			<div class="col-sm-9">
								    				<input class="form-control col-xs-10 col-sm-5 input-xlarge" name="total" id="total" type="text" placeholder="total" />
								    			</div>
								    		</div>				

										</div>
									</form>
								</div>

								

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php include("../models/footer.php"); ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='js/vendor/jquery.min.js'>"+"<"+"/script>");
		</script>

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='js/vendor/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="js/vendor/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->
		<script src="js/vendor/ace-elements.min.js"></script>
		<script src="js/vendor/ace.min.js"></script>


		<!-- daterangepicker -->
		<script src="js/vendor/daterangepicker.min.js" type="text/javascript"></script>
		<!-- datepicker -->
		<script src="js/vendor/bootstrap-datepicker.min.js" type="text/javascript"></script>


		<!-- blockUI -->
        <script language="javascript" type="text/javascript" src="js/vendor/jquery.blockUI.js"></script>
        <script language="javascript" type="text/javascript" src="js/vendor/jquery.validate-1.11.1.min.js"></script>
        <script src="js/main.js"></script>


		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$("#compras").addClass("active");
				$("#compras_view").addClass("active");

				$('[data-rel=tooltip]').tooltip();
				
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
			   $('#sidebar2').insertBefore('.page-content').ace_sidebar('collapse', true);
			   $('#navbar').addClass('h-navbar');
			   $('.footer').insertAfter('.page-content');
			   
			   $('.page-content').addClass('main-content');
			   
			   $('.menu-toggler[data-target="#sidebar2"]').insertBefore('.navbar-brand');  
			
				// scrollables
				$('.scrollable').each(function () {
					var $this = $(this);
					$(this).ace_scroll({
						size: $this.attr('data-size') || 100,
						//styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
					});
				});

			   $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
				 if(event_name == 'sidebar_fixed') {
					 if( $('#sidebar').hasClass('sidebar-fixed') ) $('#sidebar2').addClass('sidebar-fixed')
					 else $('#sidebar2').removeClass('sidebar-fixed')
				 }
			   }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);
			   
			   $('#sidebar2[data-sidebar-hover=true]').ace_sidebar_hover('reset');
			   $('#sidebar2[data-sidebar-scroll=true]').ace_sidebar_scroll('reset', true);
			})
		</script>
	</body>
</html>

