<?php  
	if (!isset($_SESSION)) { session_start(); } 
	// ** Logout the current user. **
	$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
	if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
	  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
	}

	if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
	  //to fully log out a visitor we need to clear the session varialbles
	  $_SESSION['MM_Username'] = NULL;
	  $_SESSION['MM_UserGroup'] = NULL;
	  $_SESSION['PrevUrl'] = NULL;
	  unset($_SESSION['MM_Username']);
	  unset($_SESSION['MM_UserGroup']);
	  unset($_SESSION['PrevUrl']);
		
	  $logoutGoTo = "../index.php";
	  if ($logoutGoTo) {
	    header("Location: $logoutGoTo");
	    session_destroy();
	    exit;
	  }
	}
	$usuario=$_SESSION['usuario'];

	include "../queries/query.php";

?>
<div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar">
	<script type="text/javascript">
		try{ace.settings.check('navbar' , 'fixed')}catch(e){}
	</script>

	<div class="navbar-container" id="navbar-container">
		<div class="navbar-header pull-left">
			<a href="index.php" class="navbar-brand">
				<small>
					<i class="fa fa-leaf"></i>
					<?php query_table_campo("SELECT * FROM empresa", "empresa") ?>
				</small>
			</a>

			<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
				<span class="sr-only"><?php echo $usuario; ?> menu</span>

				<img src="img/avatars/user.jpg" alt="Jason's Photo" />
			</button>

			<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
				<span class="sr-only">Sidebar</span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>
			</button>
		</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<!-- <li class"grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-vertical"></i>
								<span class="badge badge-success">5</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									5 Messages
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#" class="clearfix">
												<img src="img/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Alex:</span>
														Ciao sociis natoque penatibus et auctor ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>a moment ago</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="img/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Susan:</span>
														Vestibulum id ligula porta felis euismod ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>20 minutes ago</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="img/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Bob:</span>
														Nullam quis risus eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>3:15 pm</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="img/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Kate:</span>
														Ciao sociis natoque eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>1:33 pm</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="img/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Fred:</span>
														Vestibulum id penatibus et auctor  ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>10:09 am</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="inbox.html">
										See all messages
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li> -->

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="img/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Bienvenido,</small>
									<?php echo $usuario; ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Configuración
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Perfil
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?php echo $logoutAction ?>">
										<i class="ace-icon fa fa-power-off"></i>
										Salir
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>

		<nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Ayuda
						<i class="fa fa-question-circle"></i>
		&nbsp;								
						<i class="ace-icon fa fa-angle-down bigger-110"></i>
					</a>

					<ul class="dropdown-menu dropdown-light-blue dropdown-caret">
						<li>
							<a href="#">
								<i class="ace-icon fa fa-eye bigger-110 blue"></i>
								Ayuda
							</a>
						</li>

						<li>
							<a href="#">
								<i class="ace-icon fa fa-user bigger-110 blue"></i>
								Material de entrenamiento
							</a>
						</li>

						<li>
							<a href="#">
								<i class="ace-icon fa fa-building bigger-110 blue"></i>
								Manual (Descargar como PDF)
							</a>
						</li>
					</ul>
				</li>

				<!-- <li>
					<a href="#">
						<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
						 Mensajes
						<span class="badge badge-warning">5</span>
					</a>
				</li> -->
			</ul>
		</nav>
	</div><!-- /.navbar-container -->
</div>