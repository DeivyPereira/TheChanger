<div class="content animated fadeIn">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="card">
                            <div class="content">
                                <div class="text-center">
                                  <h4 class="title"><?= $usuarios->nombre . " " . $usuarios->apellido; ?><br />
                                     <small><?= $usuarios->email; ?></small>
                                  </h4>
                                </div>
                            </div>
                            <hr  style="margin: 10px 0">
                            <div class="text-center">
                                <div class="row" style="padding: 0 20px 10px 20px">
                                    <div class="col-xs-6 text-center">
                                        <small><strong>Usuario</strong></small><br>
                                        <?php if( $usuarios->conectado == 1 ): ?>
                                            <small class="text-success">Conectado</small>
                                        <?php else: ?>
                                            <small class="text-danger">Desconectado</small>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-xs-6 text-center">
                                        <small class="text-dark"><strong>Última conexión</strong></small><br>
                                        <?php if( empty($usuarios->ultima_conexion) ): ?>
                                            <small>N/A</small>
                                        <?php else: ?>
                                            <small><?= $usuarios->ultima_conexion; ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Resumen</h4>
                            </div>
                            <div class="content">
                                <ul class="list-unstyled team-members">
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div style="padding: 5px 0;">
                                                   <strong>Estatus</strong>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                                                    <?php if( $_SESSION['id_cexpress'] == $usuarios->id ): ?>
                                                        <a href="<?= base_url() . 'update_user_status_show?id=' . $usuarios->id . '&status=' . $usuarios->status; ?>" class="btn btn-success btn-icon btn-block" data-color-choice="principal" set-color-text="principal">Cambiar</a><br>
                                                    <?php else: ?>
                                                        <a href="<?= base_url() . 'update_user_status_show?id=' . $usuarios->id . '&status=' . $usuarios->status; ?>" class="btn btn-sm btn-success btn-icon btn-block" data-color-choice="principal" set-color-text="principal">Cambiar</a><br>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-xs-2 text-center">
                                                <div style="padding: 5px 0;">
                                                    <?php if( $usuarios->status == 1 ): echo "<i class='ti-check text-success'></i>"; elseif( $usuarios->status == 0 ):  echo "<i class='ti-close text-danger'></i>"; endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php if( $_SESSION['role_cexpress'] == 4 ): ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-10">
                                                <strong>Verificación</strong>
                                            </div>
                                            <div class="col-sx-2 text-center">
                                                <?php if( $usuario->verificacion == 0 ): ?>
                                                    <i class="ti-close text-danger"></i>
                                                <?php elseif( $usuario->verificacion == 1 ): ?>
                                                    <i class="ti-export text-warning"></i>
                                                <?php elseif( $usuario->verificacion == 2 ): ?>
                                                    <i class="ti-check text-success"></i>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                    <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div style="padding: 10px 0">
                                                    <strong>Rol</strong>
                                                </div>
                                            </div>
                                            <form action="<?php if( $_SESSION['id_cexpress'] == $usuarios->id ): echo base_url() . 'update_role_perfil'; else: echo base_url() . 'update_role_show'; endif; ?>" method="post">
                                            <div class="col-xs-5">
                                                <div style="padding: 5px 0;">
                                                <input type="hidden" name="id" value="<?= $usuarios->id; ?>">
                                                <select name="role" id="roleChange" style="border:0; padding:0; margin:0">
                                                    <option value="false">
                                                        <?php
                                                            if( $usuarios->role == 1 ): echo "Administrador"; elseif( $usuarios->role == 2 ): echo "Manager"; elseif( $usuarios->role == 3 ): echo "Operador"; elseif( $usuarios->role == 4 ): echo "Cliente"; endif; 
                                                        ?>
                                                    </option>
                                                    <?php if( $usuarios->role != 1 ): ?>
                                                        <option value="1">Administrador</option>
                                                    <?php endif; ?>
                                                    <?php if( $usuarios->role != 2 ): ?>
                                                        <option value="2">Manager</option>
                                                    <?php endif; ?>
                                                    <?php if( $usuarios->role != 3 ): ?>
                                                        <option value="3">Operador</option>
                                                    <?php endif; ?>
                                                    <?php if( $usuarios->role != 4 ): ?>
                                                        <option value="4">Cliente</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <button type="submit" data-color-choice="principal" set-color-text="principal" class="btn btn-sm btn-success btn-icon btn-block">Cambiar</button>
                                            </div>
                                            </form>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <?php if( $titulo != "Perfil del Usuario"): ?>
                        <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                            <div class="card">
                                <div class="content">
                                    <?php if( $usuarios->verificado == 0 ): ?>
                                        <div class="alert alert-warning text-center">
                                            <p>
                                                <i class="ti-info-alt"></i><br>
                                                Documento de Verificación pendiente
                                            </p>
                                        </div>
                                    <?php elseif( $usuarios->verificado == 1 ): ?>
                                        <h4 class="title" style="margin-bottom: 20px;">Verificación</h4>
                                        <a href="<?= base_url() . 'uploads/verificacion/' . $usuarios->confirma_img; ?>" target="_blank"><img src="<?= base_url() . 'uploads/verificacion/' . $usuarios->confirma_img; ?>"  width="100%" alt=""></a>
                                        <div class="text-center" style="margin-top: 10px">
                                            <a href="<?= base_url() . 'verificacion?i=' . $usuarios->id . '&v=1'; ?>" class="btn btn-success btn-fill">Verificar</a>
                                            <button id="rechazarBtn" class="btn btn-danger btn-fill">Rechazar</button>
                                        </div>
                                    <?php elseif( $usuarios->verificado == 2 ): ?>
                                        <div class="text-center alert alert-success">
                                            <i class="ti-check"></i><br>
                                            <p>Usuario verificado</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <?php if( $_SESSION['id_cexpress'] == $usuarios->id ): ?>
                            <div class="header text-center">
                                <button class="btn btn-primary active" style="border:0" id="perfilBtn">Editar Perfil</button>
                                <button class="btn btn-primary" style="border:0" id="passwordBtn">Cambiar Contraseña</button>
                            <hr>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php if( $usuarios->verificado == 0 && $_SESSION['role_cexpress'] == 4 ): ?>
                        <?= form_open_multipart( 'verificar', array( 'id' => 'comprobanteVerificacion') ); ?>
                        <div class="card">
                            <div class="header bg-warning text-center">
                                <h4 class="title" data-title-choice="principal"><i class="ti-info-alt"></i><br>Proceso de Verificación</h4>
                                <p>Para poder realizar operaciones con nosotros <strong>deberás verificar tu usuario</strong><br>Solo debes enviarnos una <strong>muestra digital</strong> de tu <strong>Cédula, DNI o Pasaporte</strong>.</p>
                                <input type="file" id="inFile" name="verificar" class="comprobacion-input" style="margin-top: 10px; display: block"
                                data-validation="mime size required" 
                                        data-validation-allowing="jpg, png, gif" 
                                        data-validation-max-size="500kb" 
                                        data-validation-error-msg-container="#inFileErr"
                                        data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Se requiere Comprobante de transacción"
                                        data-validation-error-msg-size="<i class='ti-info-alt'></i>&nbsp;Las imágenes debe tener un tamaño máximo de 500kb"
                                        data-validation-error-msg-mime="<i class='ti-info-alt'></i>&nbsp;Solo puedes subir imágenes jpg, png, gif"><br>
                                        <small id="inFileErr"></small>
                                <small id="outFile" class="text-success" style="font-weight: bolder"></small>
                                <?= $error; ?>
                                <div class="text-right mt-2" style="padding: 0 0 15px 0">
                                    <button class="btn btn-primary" style="border: 0; padding-left: 10px;" data-color-choice="principal" set-color-text="principal"><i class="fa fa-paper-plane-o"></i>&nbsp;Verificar</button>
                                </div>
                            </div>
                <script>
                    // Función para mostrar la imagen del comprobante de pago en pedidos

                        function thumb_1(evt) {
                        var files = evt.target.files;
                        for (var i = 0, f; f = files[i]; i++) {		
                            if (!f.type.match('image.*')) {
                                continue;
                            }
                            var reader = new FileReader();
                            reader.onload = (function(theFile) {
                            return function(e) {
                                    document.getElementById("outFile").innerHTML = ['Imagen Cargada'].join('');
                            };
                            })(f);
                            reader.readAsDataURL(f);
                        }
                        }
                        document.getElementById('inFile').addEventListener('change', thumb_1, false);
                </script>
                        </div>
                        <?= form_close(); ?>
                        <?php endif; ?>
                        <?php if( $usuarios->verificado == 1 && $_SESSION['role_cexpress'] == 4 ): ?>
                        <div class="card">
                            <div class="content">
                                <div class="alert alert-warning" style="margin-bottom: 10px">
                                    <p>Su solicitud de verificación ha sido enviada exitosamente, se le informará cuando sea aprobada a través de su correo electrónico.</p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="card">
                            <div class="content">
                                <div id="Perfil">
                                <h4 class="title">Editar Perfil</h4>
                                <form action="<?= base_url() . 'perfil?a=perfil'; ?>" method="post">
                                <input type="hidden" name="id" value="<?= $usuarios->id; ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombre de Usuario</label> <br>
                                                <input type="text" class="form-control border-input" name="usuario" placeholder="Nombre de Usuario" value="<?= $usuarios->usuario; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control border-input" placeholder="Email" value="<?= $usuarios->email; ?>" <?php if( isset($c) ): echo "disabled"; else: echo ""; endif; ?>>
                                                <?= form_error('email'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" name="nombre" class="form-control border-input" placeholder="Email" value="<?= $usuarios->nombre; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Apellido</label>
                                                <input type="text" name="apellido" class="form-control border-input" placeholder="Email" value="<?= $usuarios->apellido; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <textarea type="text" name="direccion" class="form-control border-input" placeholder="Dirección" value="<?= $usuarios->direccion; ?>" rows="4" <?php if( isset($c) ): echo "disabled"; endif; ?>><?= $usuarios->direccion; ?></textarea>
                                                <?= form_error('direccion'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Ciudad</label>
                                                <input type="text" class="form-control border-input" name="ciudad" placeholder="Ciudad" value="<?= $usuarios->ciudad; ?>" <?php if( isset($c) ): echo "disabled"; endif; ?>>
                                                <?= form_error('ciudad'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>País</label>
                                                <select name="nacionalidad" id="" class="form-control border-input" <?php if( isset($c) ): echo "disabled"; endif; ?>>
                                                    <option value="<?= $usuarios->nacionalidad; ?>"><?= $usuarios->nacionalidad; ?></option>
                                                    <?php foreach( $paises as $pais ): ?>
                                                        <?php if( $pais['pais'] != $usuarios->nacionalidad ): ?>
                                                            <option value="<?= $pais['pais']; ?>"><?= $pais['pais']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Código Postal</label>
                                                <input type="text" name="codigo_postal" class="form-control border-input" placeholder="Código Postal" value="<?= $usuarios->codigo_postal; ?>" <?php if( isset($c) ): echo "disabled"; endif; ?>>
                                                <?= form_error('codigo_postal'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Número Telefónico</label>
                                                <input type="text" name="telefono" class="form-control border-input" placeholder="Número telefónico" value="<?= $usuarios->telefono; ?>" <?php if( isset($c) ): echo "disabled"; endif; ?>>
                                                <?= form_error('telefono'); ?>
                                            </div>
                                        </div>

                                    <?php if( !isset($c) ): ?>

                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-wd" style="margin: 25px 0; border: 0" set-color-text="principal" data-color-choice="principal" name="perfil" value="perfil">Actualizar Perfil</button>    
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    </form>
                                    </div>

                                    <?php if( $_SESSION['id_cexpress'] == $usuarios->id ): ?>
                                    <div style="display: none" id="Password">
                                        <?php if( !isset($c) ): ?>
                                        <form action="<?= base_url() . 'perfil?a=password'; ?>" method="post">
                                        <input type="hidden" value="<?= $usuarios->id; ?>" name="id">
                                        <div style="margin: 10px 0;">
                                            <h4 class="title">Cambiar Contraseña</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">Ingrese nueva contraseña</label>
                                                <input type="password" class="form-control border-input" name="password" placeholder="Contraseña Actual">
                                                <?= form_error('password'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Verifique la contraseña</label>
                                                <input type="password" class="form-control border-input" name="password_conf" placeholder="Contraseña Nueva">
                                                <?= form_error('password_conf'); ?>
                                            </div>
                                            <div class="col-md-12 text-center" style="margin: 10px 0;">
                                                <button type="submit" set-color-text="principal" data-color-choice="principal" style="border:0" class="btn btn-primary btn-wd">Actualizar Contraseña</button>
                                            </div>
                                        </div>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
    <div class="verificacion-modal display-none" id="rechazarContent">
        <div class="card shadow-custom" style="background-image: url('<?= base_url() . 'assets/img/back.png'; ?>'); background-repeat: no-repeat; background-position: 0px 70px;">
        <div style="padding: 5px 0;">
            <h4 class="text-purple" style="float-right; display:inline; padding-left: 5px">Rechazar</h4>
            <button class="purple-cexpress button-close-modal" style="float:right;" id="closeVerificacionBtn">
                <i class="ti-close"></i>
            </button>
        </div>
                    <div class="content">
                        <div class="row">
                            <form action="<?= base_url() . 'rechazar_verificacion'; ?>" method="post">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">
                                            Motivo del rechazo
                                        </label>
                                        <input type="hidden" name="id" value="<?= $usuarios->id; ?>">
                                        <textarea name="motivo" class="form-control border-input" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary btn-fill">Notificar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

    </div>
<?php endif; ?>