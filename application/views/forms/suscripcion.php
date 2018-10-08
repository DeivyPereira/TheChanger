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
                        <img src="assets/img/Logo_dark_2.png" width="40%" alt="">
                    </div>
                    <form action="<?= base_url() . 'suscripcion'; ?>" class="animated fadeIn" method="POST">
                        <div class="text-center">
                            <h3>Suscríbete</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <small>
                                            Nombre
                                        </small>    
                                    </label>
                                    <input type="text" name="nombre" class="form-control border-input" value="<?= set_value('nombre'); ?>">
                                    <?= form_error('nombre'); ?>                                  
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <small>
                                            Apellido
                                        </small>
                                    </label>
                                    <input type="text" name="apellido" class="form-control border-input" value="<?= set_value('apellido'); ?>">
                                    <?= form_error('apellido'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <small>
                                            Teléfono
                                        </small>    
                                    </label>
                                    <input type="text" name="telefono" class="form-control border-input" value="<?= set_value('telefono'); ?>">
                                    <?= form_error('telefono'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <small>
                                            ¿Desde dónde enviaras tus remesas?
                                        </small>
                                    </label>
                                    <select name="pais" class="form-control border-input">
                                        <option value="false"></option>
                                        <?php foreach($paises as $pais): ?>
                                            <?php if( $pais['pais'] != "Venezuela" ): ?>
                                                <option value="<?= $pais['pais']; ?>"><?= $pais['pais']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('pais'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>
                                        <small>
                                            Tipo de doc.
                                        </small>
                                    </label>
                                    <input type="text" class="form-control border-input" placeholder="DNI, CI, etc..." name="tipo_de_documento" value="<?= set_value('tipo_de_documento'); ?>">
                                    <?= form_error('tipo_de_documento'); ?>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>
                                        <small>
                                            N° de documento
                                        </small>    
                                    </label>
                                    <input type="text" class="form-control border-input" name="documento_nmro" value="<?= set_value('documento_nmro'); ?>">
                                    <?= form_error('documento_nmro'); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        <small>
                                            Nombre de Usuario
                                        </small>
                                    </label>
                                    <input type="text" class="form-control border-input" name="usuario_nombre" value="<?= set_value('usuario_nombre'); ?>">
                                    <?= form_error('usuario_nombre'); ?>
                                </div>
                            </div>
                        </div>      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <small>
                                            Email
                                        </small>
                                    </label>
                                    <input type="text" name="email" class="form-control border-input" value="<?= set_value('email'); ?>">
                                    <?= form_error('email'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <small>
                                            Confirmar Email
                                        </small>
                                    </label>
                                    <input type="text" class="form-control border-input" name="email_conf">
                                    <?= form_error('email_conf'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <small>
                                            Contraseña
                                        </small>
                                    </label>
                                    <input type="password" class="form-control border-input" name="password">
                                    <?= form_error('password'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <small>
                                            Confirmar Contraseña
                                        </small>
                                    </label>
                                    <input type="password" class="form-control border-input" name="password_conf">
                                    <?= form_error('password_conf'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn-fill btn-wd">Suscríbete</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>   
                    <div class="footer-login">
                        <small><a href="<?= base_url('login'); ?>">¿Ya tienes cuenta?</a></small>
                    </div>
                </div>
            </div>
        </div>

        <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

<?= $msg; ?>

        </body>
        </html>