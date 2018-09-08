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
                                            <small>Esperando Activación</small>
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
                                                   <strong>Status</strong>
                                            </div>
                                            <div class="col-xs-5 text-center">
                                                <?php if( $usuarios->status == 1 ): echo "<i class='ti-check text-success'></i>"; elseif( $usuarios->status == 0 ):  echo "<i class='ti-close text-danger'></i>"; endif; ?>
                                            </div>
                                            <div class="col-xs-4">
                                                <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                                                    <?php if( $_SESSION['id_cexpress'] == $usuarios->id ): ?>
                                                        <a href="<?= base_url() . 'update_user_status_show?id=' . $usuarios->id . '&status=' . $usuarios->status; ?>" class="btn btn-sm btn-success btn-icon">Cambiar</a><br>
                                                    <?php else: ?>
                                                        <a href="<?= base_url() . 'update_user_status_show?id=' . $usuarios->id . '&status=' . $usuarios->status; ?>" class="btn btn-sm btn-success btn-icon">Cambiar</a><br>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <strong>Rol</strong>
                                            </div>
                                            <form action="<?php if( $_SESSION['id_cexpress'] == $usuarios->id ): echo base_url() . 'update_role_perfil'; else: echo base_url() . 'update_role_show'; endif; ?>" method="post">
                                            <div class="col-xs-5">
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
                                            <div class="col-xs-4 text-center">
                                                <button type="submit" class="btn btn-sm btn-success btn-icon">Cambiar</button>
                                            </div>
                                            </form>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <?php if( $_SESSION['id_cexpress'] == $usuarios->id ): ?>
                            <div class="header text-center">
                                <button class="btn btn-primary active" id="perfilBtn">Editar Perfil</button>
                                <button class="btn btn-primary" id="passwordBtn">Cambiar Contraseña</button>
                            <hr>
                            </div>
                            <?php endif; ?>

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
                                                <button type="submit" class="btn btn-primary btn-wd" style="margin: 25px 0" name="perfil" value="perfil">Actualizar Perfil</button>    
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
                                                <button type="submit" class="btn btn-primary btn-wd">Actualizar Contraseña</button>
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