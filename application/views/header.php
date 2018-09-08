<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/fav.png">
	<link rel="icon" type="image/png" href="assets/img/fav.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?= $titulo; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="<?= base_url() . 'assets/css/bootstrap.min.css'; ?>" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?= base_url() . 'assets/css/animate.min.css'; ?>" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="<?= base_url() . 'assets/css/paper-dashboard.css'; ?>" rel="stylesheet"/>
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/login.css'; ?>" />


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?= base_url() . 'assets/css/demo.css'; ?>" rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url() . 'assets/css/main.css'; ?>">

    <link rel="stylesheet" href="<?= base_url() . 'assets/css/theme-default.css'; ?>">

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="<?= base_url() . 'assets/css/themify-icons.css'; ?>" rel="stylesheet">

</head>
<body>

    <div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="primary">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="<?= base_url(); ?>" class="simple-text">
                    <img src="assets/img/Logo_dark_2.png" width="65" alt="">
                </a>
            </div>

            <ul class="nav">
                <li class="<?php if( $titulo == "Tablero"): echo "active"; endif;?>">
                    <a href="<?= base_url('dashboard'); ?>">
                        <i class="ti-dashboard"></i>
                        <p>Tablero</p>
                    </a>
                </li>
                <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                <li class="<?php if( $titulo == 'Registrar País'): echo 'active'; endif;?>">
                    <a href="<?= base_url() . 'registrar_pais'; ?>">
                        <i class="ti-map-alt"></i>
                        <p>Paises</p>
                    </a>
                </li>
                <?php endif; ?>
                <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                <li class="<?php if( $titulo == "Control de Tasas"): echo "active"; endif;?>">
                    <a href="<?= base_url() . 'control_tasas'; ?>">
                        <i class="ti-stats-up"></i>
                        <p>Tasas</p>
                    </a>
                </li>
                <?php endif; ?>
                <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                <li class="<?php if( $titulo == "Control de Usuarios"): echo "active"; endif;?>">
                    <a href="<?= base_url() . 'control_usuarios'; ?>">
                        <i class="ti-pencil-alt2"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Solo para clientes -->
                <?php if( $_SESSION['role_cexpress'] == 4 ): ?>
                <li class="<?php if( $titulo == "Cuentas Bancarias"): echo "active"; endif;?>">
                    <a href="<?= base_url() . 'cuentas_bancarias'; ?>">
                        <i class="ti-marker-alt"></i>
                        <p>Cuentas Bancarias</p>
                    </a>
                </li>
                <?php endif; ?>
                
                <!-- Solo para Administradores o Managers-->
                <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                <li class="<?php if( $titulo == "Cuentas Bancarias"): echo "active"; endif;?>">
                    <a href="<?= base_url() . 'cuentas_bancarias_admin'; ?>">
                        <i class="ti-marker-alt"></i>
                        <p>Cuentas Bancarias</p>
                    </a>
                </li>
                <?php endif; ?>

                <?php if( $_SESSION['role_cexpress'] == 4 ): ?>
                <li class="<?php if( $titulo == "Control de Pedidos"): echo "active"; endif;?>">
                    <a href="<?= base_url() . 'control_pedidos'; ?>">
                        <i class="ti-check-box"></i>
                        <p>Tus pedidos</p>
                    </a>
                </li>
                <?php endif; ?>
                <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 || $_SESSION['role_cexpress'] == 3 ): ?>
                <li class="<?php if( $titulo == "Control de Pedidos"): echo "active"; endif;?>">
                    <a href="<?= base_url() . 'control_pedidos_admin'; ?>">
                        <i class="ti-check-box"></i>
                        <p>Gestionar Pedidos</p>
                    </a>
                </li>
                <?php endif; ?>

                <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                <li class="<?php if( $titulo == "Estados de Cuentas"): echo "active"; endif;?>">
                    <a href="<?= base_url() . 'estados_cuentas'; ?>">
                        <i class="ti-wallet"></i>
                        <p>estados de cuenta</p>
                    </a>
                </li>
                <?php endif; ?>
                <li class="<?php if( $titulo == "Perfil del Usuario"): echo "active"; endif;?>">
                    <a href="<?= base_url() . 'perfil'; ?>">
                        <i class="ti-user"></i>
                        <p>Perfil</p>
                    </a>
                </li>
				<li class="active-pro">
                    <a href="<?= base_url() . 'logout'; ?>">
                        <i class="ti-close"></i>
                        <p>Cerrar Sesión</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?= $titulo; ?></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                        <li class="dropdown" style="position: relative">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php if( $admin_noti > 0 || $usuarios_nuevo_rows > 0 ): ?>
                                        <span class="notificacion animated rubberBand"><?= $admin_noti + $usuarios_nuevo_rows; ?></span>
                                    <?php endif; ?>
                                    <i class="ti-bell"></i>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                              <?php foreach( $pedidos_noti as $pedido ): ?>
                                <?php if( $admin_noti > 0 ): ?>
                                    <li class="text-center">
                                        <a href="<?= base_url() . 'ver_pedido?i=' . $pedido['id'] . '&n=yes'; ?>">
                                            <small>
                                                <?php foreach( $usuario_noti as $usuario ): ?>
                                                    <?php if( $pedido['id_cliente'] == $usuario['id'] ): ?>
                                                    <i class="ti-info-alt"></i>&nbsp;<?= $usuario['nombre'] . " " . $usuario['apellido']; ?><br>
                                                    Ha realizado un nuevo pedido
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </small>
                                        </a>
                                    </li>
                              <?php endif; ?>
                              <?php endforeach; ?>
                              <?php foreach( $usuarios_nuevos as $usuarios ): ?>
                                    <?php if( $usuarios_nuevo_rows > 0 ): ?>
                                        <li class="text-center">
                                            <a href="<?= base_url() . 'usuario?id=' . $usuarios['id'] . '&n=yes'; ?>">
                                                <small>
                                                    <i class="ti-info-alt"></i>&nbsp;<?= $usuarios['nombre'] . " " . $usuarios['apellido']; ?><br>
                                                    Se ha registrado recientemente
                                                </small>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                            <?php endforeach; ?>
                                <li><a href="javascript:void(0)">No hay mas notificaciones por el momento.</a></li>
                              </ul>
                        </li>
                        <?php endif; ?>


                        <?php if( $_SESSION['role_cexpress'] == 3 ): ?>
                        <li class="dropdown" style="position: relative">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php if( $admin_noti > 0 ): ?>
                                        <span class="notificacion animated rubberBand"><?= $admin_noti; ?></span>
                                    <?php endif; ?>
                                    <i class="ti-bell"></i>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                              <?php foreach( $pedidos_noti as $pedido ): ?>
                                <?php if( $admin_noti > 0 ): ?>
                                    <li class="text-center">
                                        <a href="<?= base_url() . 'ver_pedido?i=' . $pedido['id'] . '&n=yes'; ?>">
                                            <small>
                                                <?php foreach( $usuario_noti as $usuario ): ?>
                                                    <?php if( $pedido['id_cliente'] == $usuario['id'] ): ?>
                                                    <i class="ti-info-alt"></i>&nbsp;<?= $usuario['nombre'] . " " . $usuario['apellido']; ?><br>
                                                    Ha realizado un nuevo pedido
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </small>
                                        </a>
                                    </li>
                                <?php endif; ?>
                              <?php endforeach; ?>
                                <li><a href="javascript:void(0)">No hay mas notificaciones por el momento.</a></li>
                              </ul>
                        </li>
                        <?php endif; ?>

                        

                        <?php if( $_SESSION['role_cexpress'] == 4 ): ?>
                        <li class="dropdown" style="position: relative">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php if( $usuario_noti_usuario > 0 ): ?>
                                        <span class="notificacion animated rubberBand"><?= $usuario_noti_usuario; ?></span>
                                    <?php endif; ?>
                                    <i class="ti-bell"></i>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                              <?php foreach( $pedidos_noti_usuario as $pedido ): ?>
                                <?php if( $usuario_noti_usuario > 0 ): ?>
                                    <li class="text-center">
                                        <a href="<?= base_url() . 'pedido?i=' . $pedido['id'] . '&n=yes'; ?>">
                                            <small>
                                                    <i class="ti-info-alt"></i>&nbsp;Su pedido: <?= $pedido['id']; ?><br>
                                                    Tiene un nuevo mensaje
                                                </small>
                                            </a>
                                        </li>
                              <?php endif; ?>
                            <?php endforeach; ?>
                                <li><a href="javascript:void(0)">No hay mas notificaciones por el momento.</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <li class="hide-small">
                            <a href="<?= base_url() . 'perfil'; ?>">
                                <i class="ti-user"></i>
                            </a>
                        </li>
                        <li class="hide-small">
                            <a href="<?= base_url() . 'logout'; ?>">
                                <i class="ti-close"></i>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <div class="display-none" style="position: fixed; top: 70%; right: 0; background-color: rgba(255,255,255,0.8); padding:15px 20px; z-index:1; border-top-left-radius: 50px; border-bottom-left-radius: 50px;" id="loader">
            <img src="<?= base_url() . 'assets/img/loader.gif'?>" width="80" alt="Cargando Por favor espere...">
        </div>