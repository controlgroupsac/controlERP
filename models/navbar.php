<div id="sidebar" class="sidebar      h-sidebar                navbar-collapse collapse">
	<script type="text/javascript">
			try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	</script>

	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<button class="btn btn-success">
				<i class="ace-icon fa fa-signal"></i>
			</button>

			<button class="btn btn-info">
				<i class="ace-icon fa fa-pencil"></i>
			</button>

			<button class="btn btn-warning">
				<i class="ace-icon fa fa-users"></i>
			</button>

			<button class="btn btn-danger">
				<i class="ace-icon fa fa-cogs"></i>
			</button>
		</div>

		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span>

			<span class="btn btn-info"></span>

			<span class="btn btn-warning"></span>

			<span class="btn btn-danger"></span>
		</div>
	</div><!-- /.sidebar-shortcuts -->

	<ul class="nav nav-list">
		<li class="hover">
			<a href="index.php">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Dashboard </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li id="ventas" class="open hover">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-building-o"></i>
				<span class="menu-text">
					Ventas
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li id="ventas_view" class="open hover">
					<a href="ventas_registro.php">
						<i class="menu-icon fa fa-caret-right"></i>
						PDV
					</a>
				</li>
				<li class="open hover">
					<a href="#">
						<i class="menu-icon fa fa-caret-right"></i>
						Cotizaciones
					</a>
				</li>

				<li class="open hover">
					<a href="#">
						<i class="menu-icon fa fa-caret-right"></i>
						Facturación
					</a>
				</li>
				
				<li id="ventas_tranfer" class="open hover">
					<a href="transferencias.php">
						<i class="menu-icon fa fa-caret-right"></i>
						Envíos y devoluciones
					</a>
				</li>
				
				<li class="open hover">
					<a href="#">
						<i class="menu-icon fa fa-caret-right"></i>
						Consignación al cliente
					</a>
				</li>

				<li class="open hover">
					<a href="#">
						<i class="menu-icon fa fa-caret-right"></i>
						Informes
					</a>
				</li>

			</ul>
		</li>

		<li id="compras" class="open hover">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-building"></i>
				<span class="menu-text">
					Compras
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li id="compras_view" class="open hover">
					<a href="compras_registro.php">
						<i class="menu-icon fa fa-caret-right"></i>
						Compras
					</a>
				</li>

				<li class="open hover">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>
						Notas de recibos
					</a>
				</li>
				
				<li class="open hover">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>
						Notas de recibos
					</a>
				</li>
				
				<li class="open hover">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>
						Consignación del proveedor
					</a>
				</li>

				<li class="open hover">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>
						Informes
					</a>
				</li>

			</ul>
		</li>

		<li class="open hover">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-database"></i>
				<span class="menu-text">
					Inventario
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="open hover">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>
						Inventario físico
					</a>
				</li>

				<li class="open hover">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>
						Cambios en valores de inventario
					</a>
				</li>

				<li class="open hover">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>
						Informes
					</a>
				</li>

			</ul>
		</li>

		<li class="hover">
			<a href="widgets.php">
				<i class="menu-icon fa fa-list-alt"></i>
				<span class="menu-text"> Contabilidad </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li id="configuration" class="hover">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-cog"></i>
				<span class="menu-text">
					Configuración
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li id="configuration_socios" class="open hover">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>
						Clientes
					</a>
				</li>

				<li id="configuration_proveedores" class="open hover">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>
						Proveedores
					</a>
				</li>

				<li id="configuration_productos" class="open hover">
					<a href="productos.php">
						<i class="menu-icon fa fa-caret-right"></i>
						Productos
					</a>
				</li>

				<li id="configuration_categorias_impuestos" class="open hover">
					<a href="categorias_impuestos.php">
						<i class="menu-icon fa fa-caret-right"></i>
						Categorias, Impuestos, Unidad y Moneda
					</a>
				</li>
				
				<li id="configuration_otro" class="hover">
					<a href="administracion.php">
						<i class="menu-icon fa fa-caret-right"></i>
						Administración
					</a>
				</li>
			</ul>
		</li>

		<li class="hover">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-question-circle"></i>

				<span class="menu-text">
					Ayuda
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="hover">
					<a href="#">
						<i class="menu-icon fa fa-caret-right"></i>
						Ayuda
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="#">
						<i class="menu-icon fa fa-caret-right"></i>
						Material de Entrenamiento
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="#">
						<i class="menu-icon fa fa-caret-right"></i>
						Manual (Descargar como PDF)
					</a>

					<b class="arrow"></b>
				</li>
			</ul>
		</li>
	</ul><!-- /.nav-list -->
</div>