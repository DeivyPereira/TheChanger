<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/fav.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/fav.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?= $titulo; ?></title>

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


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="main-login">
    <div class="intro hide-small"></div>

    <div class="form">
        <div class="medio">
            <div class="header-login">
                <img src="assets/img/Logotipo.png" width="30%" alt="">
            </div>
            <div class="olvido-pass animated fadeIn" id="forgot">
                <form action="<?= base_url('set_new_pass'); ?>" method="post">
                    <div class="text-center">    
                        <h3>Cambia tu contraseña</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nueva Contraseña</label>
                                <input type="password" name="password" class="form-control border-input" placeholder="Nueva Contraseña">
                                <?= form_error('password'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Confirma tu nueva contraseña</label>
                                <input type="password" name="pass_conf" class="form-control border-input" placeholder="Confirmar Contraseña">
                                <?= form_error('pass_conf'); ?>
                            </div>
                        </div>
                        <input type="hidden" value="<?= $_GET['e']; ?>" name="email">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-info btn-fill btn-wd">Resetear Contraseña</button>
                    </div>
                    <div class="clearfix"></div>
                </form>   
            </div>



    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>
    <?= $msg; ?>

</body>
</html>