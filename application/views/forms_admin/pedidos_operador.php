<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Listado de pedidos<?= $subtitulo; ?></h4>
                        <small>Verifica los pedidos pendientes e informales a tus clientes si ya fueron procesados.</small>
                    </div>
                    <div class="content">
                        <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th class="text-center">ID</th>
                                    	<th class="text-center">Nombre</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Banco Receptor</th>
                                        <th class="text-center">Monto Pagado</th>
                                        <th class="text-center">Monto Beneficiario</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <?php foreach( $pedidos as $pedido ): ?>
                                        <tr class="text-center">
                                        	<td><?= $pedido['id']; ?></td>
                                        	<td>
                                                <?php foreach( $usuarios as $usuario ): ?>
                                                <?php if( $pedido['id_cliente'] == $usuario['id'] ): ?>
                                                    <?= $usuario['nombre'] . " " . $usuario['apellido']?>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                        	<td><?= $pedido['fecha_pedido']; ?></td>
                                        	<td>
                                                <?php if( $pedido['status'] == 0 ): ?>
                                                    <span class="text-warning">
                                                        <i class="ti-info-alt"></i>
                                                        Pendiente
                                                    </span>
                                                <?php elseif( $pedido['status'] == 1 ): ?>
                                                    <span class="text-sucess">
                                                        <i class="ti-check"></i>
                                                        Aceptado
                                                    </span>
                                                <?php elseif( $pedido['status'] == 2 ): ?>
                                                    <span class="text-danger">
                                                        <i class="ti-info-check"></i>
                                                        Rechazado
                                                    </span>
                                                <?php elseif( $pedido['status'] == 4 ): ?>
                                                    <span class="text-danger">
                                                        <i class="ti-info-check"></i>
                                                        Terminado
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small><?= $pedido['pais_receptor']; ?></small><br>
                                                <?php foreach( $bancos_admin as $banco ): ?>
                                                <?php if( $pedido['banco_receptor'] == $banco['id'] ): ?>
                                                    <?= $banco['banco']; ?>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <?= number_format( $pedido['monto_pagado'], 2 ); ?>
                                                <?php foreach( $bancos_admin as $banco ): ?>
                                                <?php if( $pedido['banco_receptor'] == $banco['id'] ): ?>
                                                    <?= $banco['diminutivo']; ?>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <?= number_format( $pedido['monto_beneficiario'], 2 ); ?>
                                                <?php foreach( $bancos_usuarios as $banco ): ?>
                                                <?php if( $pedido['banco_beneficiario'] == $banco['id'] ): ?>
                                                    <?= $banco['diminutivo']; ?>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url() . 'ver_pedido?i=' . $pedido['id']; ?>" class="btn btn-sm btn-primary">
                                                    <i class="ti-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>