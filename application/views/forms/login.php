<!doctype html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/fav.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/fav.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Iniciar sesión - <?= $titulo; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/login.css" />


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <link href="assets/css/loginparallax.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>
    
<div class="main-login">
    <div class="intro hide-small">
        <ul class="cb-slideshow">
            <li><span>Image 01</span><div><h3>Bogota</h3></div></li>
            <li><span>Image 02</span><div><h3>Buenos Aires</h3></div></li>
            <li><span>Image 03</span><div><h3>Caracas</h3></div></li>
            <li><span>Image 04</span><div><h3>Estados Unidos</h3></div></li>
            <li><span>Image 05</span><div><h3>Santiago de Chile</h3></div></li>
            <li><span>Image 06</span><div><h3>Panama</h3></div></li>
        </ul>
    </div>

    <div class="form">
        <div class="medio">
            <div class="header-login">

                 <img src="assets/img/Logo_dark_2.png" width="40%" alt="">
            </div>
            <div id="login" class="animated fadeIn">
                <form action="<?= base_url() . 'login'; ?>" method="post">
                    <div class="text-center">
                        <h3>Inicia Sesión</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                    <small>
                                        Email
                                    </small>
                                </label>
                                <input type="email" name="email" class="form-control border-input" value="<?= set_value('email'); ?>">
                                <?= form_error('email'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                    <small>
                                        Contraseña
                                    </small>
                                </label>
                                <input type="password" name="password" class="form-control border-input">
                                <?= form_error('password'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-info btn-fill btn-wd">Login</button>
                    </div>
                    <small>Email: admin@mail.com - Password: admin@mail.com</small><br/>
                    <small>Email: operador@mail.com - Password: operador@mail.com</small><br/>
                    <small>Email: cliente@mail.com - Password: cliente@mail.com</small>
                    <div class="clearfix"></div>
                <?= form_close(); ?>
                <div class="footer-login">
                    <small><a href="<?= base_url('asistente_password'); ?>">¿Olvidaste tu contraseña?</a></small>&nbsp;|&nbsp;
                    <small><a href="<?= base_url('suscripcion'); ?>">¿Eres nuevo en <?php echo nombreweb;  ?>?</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>
<?= $msg; ?>
</body>
</html>