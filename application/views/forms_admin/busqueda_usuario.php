<div class="content animated fadeIn">
    <div class="container-fluid">
    <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <form action="<?= base_url() . 'buscar_usuario'; ?>" method="get">
                            <div class="col-sm-10">
                                <input type="text" name="buscar" class="form-control border-input" placeholder="¿Qué estas buscando?">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-primary btn-block"><i class="ti-search"></i></button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                                <th class="text-center"><small>Nombre</small></th>
                                <th class="text-center"><small>Usuario</small></th>
                                <th class="text-center"><small>Nacionalidad</small></th>
                                <th class="text-center"><small>Identificación</small></th>
                                <th class="text-center"><small>Status</small></th>
                                <th class="text-center"><small>Cambiar Rol</small></th>
                                <th class="text-center"><small>Cambiar Status</small></th>
                            </thead>
                            <tbody>
                                <?php if( $buscar != false ): ?>
                                <?php foreach( $buscar as $usuario ): ?>
                                <tr class="text-center">

                                    <td class="text-center">
                                        <?php if( $usuario['id'] == $_SESSION['id_cexpress']): ?>
                                            <a href="<?= base_url() . 'perfil'; ?>"><?= $usuario['nombre'] . " " . $usuario['apellido']; ?></a>
                                        <?php else: ?>
                                            <a href="<?= base_url() . 'usuario?id=' . $usuario['id']; ?>"><?= $usuario['nombre'] . " " . $usuario['apellido']; ?></a>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center">
                                        <?= $usuario['usuario']; ?>
                                    </td>

                                    <td class="text-center">
                                        <?= $usuario['nacionalidad']; ?>
                                    </td class="text-center">
                                    
                                    <td class="text-center">
                                        <?= $usuario['tipo_documento'] . " " . $usuario['dni']; ?>
                                    </td>

                                    <td>
                                        <?php if( $usuario['status'] == 1 ): ?>
                                        <i class="ti-check text-success"></i>
                                        <?php elseif( $usuario['status'] == 0 ): ?>
                                        <i class="ti-close text-danger"></i>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center">
                                        <form action="<?= base_url() . 'update_role_search'; ?>" method="post">
                                            <input type="hidden" name="buscar" value="<?= $_GET['buscar']; ?>">
                                            <input type="hidden" name="id" value="<?= $usuario['id']; ?>">
                                            <select name="role" id="roleChange" class="custom-input">
                                                <option value="false">
                                                    <?php
                                                        if( $usuario['role'] == 1 ): echo "Administrador"; elseif( $usuario['role'] == 2 ): echo "Manager"; elseif( $usuario['role'] == 3 ): echo "Operador"; elseif( $usuario['role'] == 4 ): echo "Cliente"; endif; 
                                                    ?>
                                                </option>
                                                <?php if( $usuario['role'] != 1 ): ?>
                                                    <option value="1">Administrador</option>
                                                <?php endif; ?>
                                                <?php if( $usuario['role'] != 2 ): ?>
                                                    <option value="2">Manager</option>
                                                <?php endif; ?>
                                                <?php if( $usuario['role'] != 3 ): ?>
                                                    <option value="3">Operador</option>
                                                <?php endif; ?>
                                                <?php if( $usuario['role'] != 4 ): ?>
                                                    <option value="4">Cliente</option>
                                                <?php endif; ?>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary btn-icon btn-block" style="margin-top: 5px; padding: 5px;">Cambiar Rol</button>
                                        </form>
                                    </td>

                                    <td class="text-center">
                                        <?php if( $usuario['status'] == 0 ): ?>
                                            <a href="<?= base_url() . 'update_user_status_s?id=' . $usuario['id'] . '&status=' . $usuario['status'] . '&buscar=' . $_GET['buscar']; ?>"class="btn btn-sm btn-danger btn-icon btn-fill" style="padding: 5px;">Inactivo</a><br>
                                        <?php elseif( $usuario['status'] == 1 ): ?>
                                            <a href="<?= base_url() . 'update_user_status_s?id=' . $usuario['id'] . '&status=' . $usuario['status'] . '&buscar=' . $_GET['buscar']; ?>" class="btn btn-sm btn-success btn-icon btn-fill" style="padding: 5px;">Activo</a><br>
                                        <?php endif; ?>
                                        
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-center"><i class="ti-search text-danger"></i><br> 
                                    No se encontraron registros</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                        <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>