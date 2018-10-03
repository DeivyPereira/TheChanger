<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header py-1 border-bottom">
                        <h4 class="title">Recibo</h4>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-6">
                                <label>
                                    <small>Nombre del solicitante</small>
                                </label>
                                <span class="after-label"><?= $usuario->nombre . " " . $usuario->apellido; ?></span>
                            </div>
                            <div class="col-xs-6">
                                <label>
                                    <small>Fecha de la solicitud</small>
                                </label>
                                <span class="after-label"><?= $pedido->fecha_pedido; ?></span>
                            </div>
                        </div>
                        <div class="row border-top border-bottom py-1 mt-2">
                            <div class="col-xs-12">
                                <h5 class="title">Información de su pago</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>País</small>
                                </label>
                                <span class="after-label"><?= $pedido->pais_receptor; ?></span>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Banco</small>
                                </label>
                                    <?php if( $banco_receptor ): ?>
                                        <span class="after-label"><?= $banco_receptor->banco; ?></span>
                                    <?php elseif( $pedido->banco_receptor == "westernUnion"): ?>
                                        <span class="after-label">Western Union</span>
                                    <?php elseif( $pedido->banco_receptor == "moneyGram" ): ?>
                                        <span class="after-label">MoneyGram</span>
                                    <?php endif; ?>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Comprobante N°</small>
                                </label>
                                <span class="after-label"><?= $pedido->num_operacion; ?></span>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Monto pagado</small>
                                </label>
                                <strong class="after-label">
                                    <?= number_format( $pedido->monto_pagado, 2 ); ?>
                                    <?= $pedido->diminutivo_pagado; ?>
                                </strong>
                            </div>
                            <div class="col-xs-12 my-1">
                                
                            </div>
                        </div>
                        <div class="row border-top border-bottom">
                            <div class="col-md-6 py-1">
                                <h5 class="title">Cuenta(s) ha beneficiar</h5>
                                <?php if( $complemento_row == 1 ): ?>
                                    <small class="text-info">Usted ha decidido utilizar dos cuentas</small>
                                <?php elseif( $complemento_row == 2 ): ?>
                                    <small class="text-info">Usted ha decidido utilizar tres cuentas</small>
                                <?php elseif( $complemento_row == 3 ): ?>
                                    <small class="text-info">Usted ha decidido utilizar cuatro cuentas</small>
                                <?php elseif( $complemento_row == 4 ): ?>
                                    <small class="text-info">Usted ha decidido utilizar cinco cuentas</small>
                                <?php elseif( $complemento_row == 0 ): ?>
                                    <small class="text-info">Usted ha decidio utilizar una cuenta</small>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 bg-success py-1">
                                <label>
                                    <small>Total a Recibir</small>
                                </label><br>
                                <strong>
                                    <?= number_format( $pedido->monto_operacion, 2 ); ?>
                                    <?= $banco_beneficiario->diminutivo; ?>
                                </strong>
                            </div>
                        </div>
                        <div class="row position-relative">
                        <div class="cuenta-numero">1</div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Banco seleccionado</small>
                                </label>
                                <span class="after-label"><?= $banco_beneficiario->banco . " - <small>" . $banco_beneficiario->alias . "</small>"; ?></span>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>País</small>
                                </label>
                                <span class="after-label"><?= $pedido->pais_beneficiario; ?></span>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Titular</small>
                                </label>
                                <span class="after-label"><?= $banco_beneficiario->titular; ?></span>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Monto a recibir</small>
                                </label>
                                <strong class="after-label">
                                    <?= number_format( $pedido->monto_beneficiario, 2 ); ?>
                                    <?= $banco_beneficiario->diminutivo; ?>
                                </strong>
                            </div>
                        </div>
                        <?php $cuentaNum = 2; ?>
                        <?php foreach( $complementos as $cuenta ): ?>
                        <div class="row border-top position-relative">
                            <div class="cuenta-numero">
                                <?php 
                                    echo $cuentaNum;
                                    $cuentaNum ++;
                                ?>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Banco seleccionado</small>
                                </label>
                                <?php foreach( $bancos_cliente as $banco ): ?>
                                <?php if( $cuenta['banco'] == $banco['id']): ?>
                                <span class="after-label"><?= $banco['banco'] . " - <small>" . $banco['alias'] . "</small>"; ?></span>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>País</small>
                                </label>
                                <?php foreach( $bancos_cliente as $banco ): ?>
                                <?php if( $cuenta['banco'] == $banco['id'] ): ?>
                                    <span class="after-label"><?= $banco['pais']; ?></span>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Titular</small>
                                </label>
                                <?php foreach( $bancos_cliente as $banco ): ?>
                                <?php if( $cuenta['banco'] == $banco['id'] ): ?>
                                <span class="after-label"><?= $banco['titular']; ?></span>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Monto a recibir</small>
                                </label>
                                <strong class="after-label">
                                    <?= number_format( $cuenta['monto'], 2 ); ?>
                                    <?= $banco_beneficiario->diminutivo; ?>
                                </strong>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="header border-bottom py-1">
                        <h4 class="title">Notificaciones</h4>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-3">
                                <label>
                                    <small>Status actual</small>
                                </label>
                                <?php if( $pedido->status == 0 ): ?>
                                    <span class="text-info after-label">
                                        <i class="ti-info-alt"></i>
                                        Recibido
                                    </span>
                                <?php elseif( $pedido->status == 1 ): ?>
                                    <span class="text-success after-label">
                                        <i class="ti-check"></i>
                                        Aceptado
                                    </span>
                                <?php elseif( $pedido->status == 2 ): ?>
                                    <span class="text-danger after-label">
                                        <i class="ti-info-alt"></i>
                                        Rechazado
                                    </span>
                                <?php elseif( $pedido->status == 4 ): ?>
                                    <span class="text-success after-label">
                                        <i class="ti-check"></i>
                                        Terminado
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-xs-9">
                                <label>
                                    <small>Mensaje</small>
                                </label>
                                <?php if( $pedido->mensaje == FALSE ): ?>
                                    <span class="after-label">Operación aún en revisión.</span>
                                <?php else: ?>
                                    <span class="after-label"><?= $pedido->mensaje; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>