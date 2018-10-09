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
                                <button class="btn btn-primary btn-block" data-color-choice="principal" set-color-text="principal"><i class="ti-search"></i></button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <?php if( $usuarios == TRUE ): ?>
                        <table class="table table-striped">
                            <thead>
                                <th class="text-center"><small>Nombre</small></th>
                                <th class="text-center"><small>Usuario</small></th>
                                <th class="text-center"><small>Nacionalidad</small></th>
                                <th class="text-center"><small>Identificación</small></th>
                                <th class="text-center"><small>Verificación</small></th>
                                <th class="text-center"><small>Status</small></th>
                                <th class="text-center"></th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php foreach( $usuarios as $usuario ): ?>
                                <tr class="text-center">
                                    <td class="text-center">
                                        <?php if( $usuario['id'] == $_SESSION['id_cexpress']): ?>
                                            <a href="<?= base_url() . 'perfil'; ?>"><?= $usuario['nombre'] . " " . $usuario['apellido']; ?></a>
                                        <?php else: ?>
                                            <a href="<?= base_url() . 'usuario?id=' . $usuario['id']; ?>"><?= $usuario['nombre'] . " " . $usuario['apellido']; ?></a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= $usuario['usuario']; ?>
                                    </td>

                                    <td>
                                        <?= $usuario['nacionalidad']; ?>
                                    </td>
                                    
                                    
                                    <td>
                                        <?= $usuario['tipo_documento'] . " " . $usuario['dni']; ?>
                                    </td>

                                    <?php if( $usuario['role'] == 4 ): ?>
                                    <td>
                                        <?php if( $usuario['verificado'] == 0 ): ?>
                                            Pendiente Documento
                                        <?php elseif( $usuario['verificado'] == 1 ): ?>
                                            Documentos enviados <br>
                                            <small class="text-warning">Esperando Verificación</small> <br>
                                            <a href="<?= base_url() . 'usuario?id=' . $usuario['id']; ?>" class="btn btn-sm btn-info btn-fill"><i class="ti-eye"></i></a>
                                        <?php elseif( $usuario['verificado'] == 2 ): ?>
                                            <i class="ti-check text-success"></i>
                                        <?php endif; ?>
                                    </td>
                                    <?php else: ?>
                                    <td>
                                        N/A
                                    </td>
                                    <?php endif; ?>

                                    <td>
                                        <?php if( $usuario['status'] == 1 ): ?>
                                        <i class="ti-check text-success"></i>
                                        <?php elseif( $usuario['status'] == 0 ): ?>
                                        <i class="ti-close text-danger"></i>
                                        <?php endif; ?>
                                    </td>

                                    </form>

                                    <td>
                                        <a href="<?= base_url() . 'eliminar_usuario?i=' . $usuario['id'] . '&p=' . $this->uri->segment(2); ?>" class="btn btn-sm btn-danger btn-icon btn-fill"><i class="ti-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                            <div class="text-center py-1">
                                <h2 class="my-0" data-title-choice="principal"><i class="ti-info-alt"></i></h2>
                                <h3>No se encontraron Registros</h3>
                            </div>
                        <?php endif; ?>
                        <div class="text-right" style="padding: 0 25px;">
                            <?= $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
