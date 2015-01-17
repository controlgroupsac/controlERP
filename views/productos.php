<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>ControlERP</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="fonts/css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="css/main.css" type="text/css" />

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

								    <div class="col-lg-12">
									<!-- Datos de los Productos -->
									    <div class="col-lg-6">
											<h2 class="col-sm-3" data-rel="tooltip" data-placement="right" title="Crea, modifica y elimina Categorias.">Categorias</h2>
										</div><!--/span-->

										<!-- Datos de los Productos -->
									    <div class="col-lg-6">
											<h2 class="col-sm-3" data-rel="tooltip" data-placement="right" title="Crea, modifica y elimina Impuestos.">Impuestos</h2>
										</div><!--/span-->


										<div class="col-xs-6 widget-container-col">
											<div class="widget-box widget-color-blue">
												<div class="widget-header">
													<i class="fa fa-table"></i>
													<h5 class="widget-title"> Lista de Categoria</h5>

													<div class="widget-toolbar">
														<a href="#" data-action="collapse">
															<i class="1 ace-icon fa fa-chevron-up"></i>
														</a>
													</div>

													<div class="widget-toolbar no-border">
														<button class="btn btn-sm btn-success" id="nuevaCategoria"> Agregar Categoria </button>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main scrollable" data-size="100">
														<div id="div_listar_categoria"></div>
		            									<div id="div_oculto_categoria" class="none"></div>
													</div>
												</div>
											</div>
										</div>
		
										<div class="col-xs-6 widget-container-col">
											<div class="widget-box widget-color-blue">
												<div class="widget-header">
													<i class="fa fa-table"></i>
													<h5 class="widget-title"> Lista de Impuestos</h5>

													<div class="widget-toolbar">
														<a href="#" data-action="collapse">
															<i class="1 ace-icon fa fa-chevron-up"></i>
														</a>
													</div>

													<div class="widget-toolbar no-border">
														<button class="btn btn-sm btn-success" id="nuevaImpuesto"> Agregar Impuesto </button>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main scrollable" data-size="100">
														<div id="div_listar_impuesto"></div>
		            									<div id="div_oculto_impuesto" class="none"></div>
													</div>
												</div>
											</div>
										</div>
									</div><!--/span-->



								    <div class="col-lg-12">
										<!-- Datos de los Productos -->
									    <div class="col-lg-6">
											<h2 class="col-sm-3" data-rel="tooltip" data-placement="right" title="Crea, modifica y elimina Unidades.">Unidad</h2>
										</div><!--/span-->

										<!-- Datos de los Productos -->
									    <div class="col-lg-6">
											<h2 class="col-sm-3" data-rel="tooltip" data-placement="right" title="Crea, modifica y elimina Monedas.">Monedas</h2>
										</div><!--/span-->


										<div class="col-xs-6 widget-container-col">
											<div class="widget-box widget-color-blue">
												<div class="widget-header">
													<i class="fa fa-table"></i>
													<h5 class="widget-title"> Lista de Unidad</h5>

													<div class="widget-toolbar">
														<a href="#" data-action="collapse">
															<i class="1 ace-icon fa fa-chevron-up"></i>
														</a>
													</div>

													<div class="widget-toolbar no-border">
														<button class="btn btn-sm btn-success" id="nuevaUnidad"> Agregar Unidad </button>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main scrollable" data-size="100">
														<div id="div_listar_unidad"></div>
		            									<div id="div_oculto_unidad" class="none"></div>
													</div>
												</div>
											</div>
										</div>
		
										<div class="col-xs-6 widget-container-col">
											<div class="widget-box widget-color-orange">
												<div class="widget-header">
													<i class="fa fa-table"></i>
													<h5 class="widget-title"> Lista de Monedas</h5>

													<div class="widget-toolbar">
														<a href="#" data-action="collapse">
															<i class="1 ace-icon fa fa-chevron-up"></i>
														</a>
													</div>

													<div class="widget-toolbar no-border">
														<button class="btn btn-sm btn-success" id="nuevaMoneda"> Agregar Moneda </button>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main scrollable" data-size="100">
														<div id="div_listar_moneda"></div>
		            									<div id="div_oculto_moneda" class="none"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div><!-- /.row -->



									<!-- Datos de los Productos -->
								    <div class="col-lg-12">
										<h2 class="col-sm-3" data-rel="tooltip" data-placement="right" title="Crea, modifica y elimina productos para tu empresa.">Gestión de Productos</h2>
									</div><!--/span-->

									<div class="col-xs-12 widget-container-col">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<i class="fa fa-table"></i>
												<h5 class="widget-title"> Lista de Productos</h5>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="1 ace-icon fa fa-chevron-up"></i>
													</a>
												</div>

												<div class="widget-toolbar no-border">
													<button class="btn btn-sm btn-success" id="nuevoProducto"> Agregar Producto </button>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main scrollable" data-size="200">
													<div id="div_listar_producto"></div>
	            									<div id="div_oculto_producto" class="none"></div>
												</div>
											</div>
										</div>
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
			fn_buscar_producto();
			fn_buscar_unidad();
			fn_buscar_moneda();
			fn_buscar_categoria();
			
			jQuery(function($) {
				$("#configuration").addClass("active");
				$("#configuration_productos").addClass("active");

				$('[data-rel=tooltip]').tooltip();
				
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

