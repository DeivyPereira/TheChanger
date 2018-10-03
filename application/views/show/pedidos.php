<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                    <div class="header text-center">
                        <h4 class="title">Detalles del Solicitante</h4>
                    </div>
                    <hr class="mb-0">
                    <div class="content">
                        <div class="row">
                            <div class="col-sm-6 my-1">
                                <label>
                                    <small>Nombre del solicitante</small>
                                </label>    
                                <a href="<?= base_url() . 'usuario?id=' . $usuario->id; ?>" target="_blank" class="after-label"><?= $usuario->nombre . " " . $usuario->apellido; ?></a>
                            </div>
                            <div class="col-sm-6 my-1">
                                <label>
                                    <small>Nombre de usuario</small>
                                </label>
                                <span class="after-label"><?= $usuario->usuario; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 my-1">
                                <label>
                                    <small>Documento de identidad</small>
                                </label><br>
                                <span class="after-label"><?= $usuario->tipo_documento . " " . $usuario->dni; ?></span>
                            </div>
                            <div class="col-md-6 my-1">
                                <label>
                                    <small>Teléfono</small>
                                </label><br>
                                <span class="after-label"><?= $usuario->telefono; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 my-1">
                                <label>
                                    <small>Correo Electrónico</small>
                                </label>
                                <span class="after-label"><?= $usuario->email; ?></span>
                            </div>
                            <div class="col-md-6 my-1">
                                <label>
                                    <small>Fecha del pedido</small>
                                </label>
                                <span class="after-label"><?= $pedido->fecha_pedido; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 my-1">
                                <label>
                                    <small>Status del pedido</small>
                                </label>
                                <?php if( $pedido->status == 0 ): ?>
                                    <span class="text-warning after-label">
                                        <i class="ti-info-alt"></i>
                                        Pendiente
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
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <hr class="<?php if( $_SESSION['role_cexpress'] == 3 ): echo "mb-0"; else: echo "my-0"; endif; ?>">
                    <?php if( $_SESSION['role_cexpress'] == 3 || $_SESSION['role_cexpress'] == 1 ): ?>
                    <div class="header text-center">
                        <h4 class="title">
                            Procesar Pago e informar al cliente
                        </h4>
                    </div>
                    <hr class="mb-0">
                    <div class="content">
                        <form action="<?= base_url() . 'actualizar_pedido'; ?>" method="post">
                        <input type="hidden" name="id_cuenta" value="<?= $pedido->banco_receptor; ?>">
                        <input type="hidden" name="monto_beneficiario" value="<?= $pedido->monto_operacion; ?>">
                        <input type="hidden" name="monto_receptor" value="<?= $pedido->monto_pagado; ?>">
                        <input type="hidden" name="usuario" value="<?= $usuario->nombre . " " . $usuario->apellido; ?>">
                        <input type="hidden" name="id" value="<?= $pedido->id; ?>">
                        <input type="hidden" name="id_cliente" value="<?= $pedido->id_cliente; ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <small>Cambiar Estado</small>
                                    </label>
                                    <select name="status" class="custom-input">
                                        <?php if( $pedido->status == 0 ): ?>
                                            <option value="0">Pendiente</option>
                                            <option value="4">Terminado</option>
                                            <option value="2">Rechazado</option>
                                        <?php elseif( $pedido->status == 4 ): ?>
                                            <option value="4">Terminado</option>
                                            <option value="0">Pendiente</option>
                                            <option value="2">Rechazado</option>
                                        <?php elseif( $pedido->status == 1 ): ?>
                                            <option value="false"></option>
                                            <option value="4">Terminado</option>
                                            <option value="0">Pendiente</option>
                                            <option value="2">Rechazado</option>
                                        <?php elseif( $pedido->status == 2 ): ?>
                                            <option value="2">Rechazado</option>
                                            <option value="0">Pendiente</option>
                                            <option value="4">Terminado</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <small>¿Désde qué Cuenta de Cexpress en Venezuela realizaste los pagos?</small>
                                    </label>
                                    <select name="banco_venezuela" class="custom-input">
                                        <option value="false"></option>
                                        <option value="false">No se realizó el pago</option>
                                        <?php foreach( $bancos_venezuela as $bancos ): ?>
                                            <option value="<?= $bancos['id']; ?>"><?= $bancos['banco'] . " - " . $bancos['alias']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <small>Informa al cliente</small>
                                    </label>
                                    <textarea name="mensaje" class="custom-input" rows="7"><?= $pedido->mensaje; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-info">Informar al cliente</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <?php endif; ?>

                    <?php if( $_SESSION['role_cexpress'] == 2 || $_SESSION['role_cexpress'] == 1 ): ?>
                    <div class="header text-center">
                        <h4 class="title">
                            Aprobar o rechazar pago del cliente
                        </h4>
                    </div>
                    <hr class="mb-0">
                    <div class="content">
                        <form action="<?= base_url() . 'informa_operador'; ?>" method="post">
                        <input type="hidden" name="id" value="<?= $pedido->id; ?>">
                        <input type="hidden" name="id_cliente" value="<?= $pedido->id_cliente; ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <small>Cambiar Estado</small>
                                    </label>
                                    <select name="status" id="status" class="custom-input">
                                        <?php if( $pedido->status == 0 ): ?>
                                            <option value="0">Pendiente</option>
                                            <option value="1">Aceptado</option>
                                            <option value="2">Rechazado</option>
                                        <?php elseif( $pedido->status == 1 ): ?>
                                            <option value="1">Aceptado</option>
                                            <option value="0">Pendiente</option>
                                            <option value="2">Rechazado</option>
                                        <?php elseif( $pedido->status == 4 ): ?>
                                            <option value="false"></option>
                                            <option value="2">Rechazado</option>
                                            <option value="0">Pendiente</option>
                                            <option value="1">Aceptado</option>
                                        <?php elseif( $pedido->status == 2 ): ?>
                                            <option value="2">Rechazado</option>
                                            <option value="0">Pendiente</option>
                                            <option value="1">Aceptado</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row display-none" id="motivo">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <small>Motivo del rechazo</small>
                                    </label>
                                    <textarea name="mensaje" class="custom-input" rows="7"><?= $pedido->mensaje; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-info">Informar</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                <div class="header border-bottom">
                    <p>
                        <strong>Solicitud N°:&nbsp;</strong><?= $pedido->id; ?>
                    </p>
                </div>
                    <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
                    <div class="header border-bottom py-1">
                        <h4 class="title">Información del pago</h4>
                    </div>
                    <div class="content">
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
                                <?php if( $banco_receptor): ?>
                                    <span class="after-label"><?= $banco_receptor->banco; ?></span>
                                <?php endif; ?>
                                <?php if( $pedido->banco_receptor == "westernUnion"): ?>
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
                                <strong>
                                    <span class="after-label"><?= number_format( $pedido->monto_pagado, 2 ); ?>
                                    <?= $pedido->diminutivo_pagado; ?></span>
                                </strong>
                            </div>
                            <div class="col-xs-12 my-2 text-center">
                                <a href="<?= base_url() . 'uploads/comprobantes/' . $pedido->comprobante; ?>" target="_blank">Ver Comprobante anexado por el cliente</a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="content">
                        <div class="row border-top border-bottom">
                            <div class="col-md-6 py-1">
                                <h5 class="title">Cuenta(s) ha beneficiar</h5>
                                <?php if( $complemento_row == 1 ): ?>
                                    <small class="text-info">El cliente ha seleccionado dos cuentas</small>
                                <?php elseif( $complemento_row == 2 ): ?>
                                    <small class="text-info">El cliente ha seleccionado tres cuentas</small>
                                <?php elseif( $complemento_row == 3 ): ?>
                                    <small class="text-info">El cliente ha seleccionado cuatro cuentas</small>
                                <?php elseif( $complemento_row == 4 ): ?>
                                    <small class="text-info">El cliente ha seleccionado cinco cuentas</small>
                                <?php elseif( $complemento_row == 0 ): ?>
                                    <small class="text-info">El cliente ha seleccionado una cuenta</small>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 bg-success py-1">
                                <label>
                                    <small>Total a Pagar</small>
                                </label><br>
                                <strong>
                                    <?= number_format( $pedido->monto_operacion, 2 ); ?>
                                    <?= $banco_beneficiario->diminutivo; ?>
                                </strong>
                            </div>
                        </div>
                        <div class="row py-1">
                            <div class="col-xs-6 my-1 text-center">
                                <div class="cuenta-numero-var">
                                    1
                                </div> 
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Banco seleccionado</small>
                                </label>
                                <span class="after-label"><?= $banco_beneficiario->banco; ?></span>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Número de Cuenta</small>
                                </label>
                                <span class="after-label"><?= $banco_beneficiario->cuenta; ?></span>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Titular</small>
                                </label>
                                <span class="after-label"><?= $banco_beneficiario->titular; ?></span>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Documento de Identidad</small>
                                </label>
                                <span class="after-label"><?= $banco_beneficiario->documento; ?></span>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Teléfono</small>
                                </label>
                                <span class="after-label"><?= $banco_beneficiario->telefono; ?></span>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Correo Electrónico</small>
                                </label>
                                <span class="after-label"><?= $banco_beneficiario->email; ?></span>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Monto a pagar</small>
                                </label>
                                <strong class="after-label">
                                    <?= number_format( $pedido->monto_beneficiario, 2 ); ?>
                                    <?= $banco_beneficiario->diminutivo; ?>
                                </strong>
                            </div>
                        </div>
                        <?php $cuentaNum = 2; ?>
                        <?php foreach( $complementos as $cuenta ): ?>
                        <div class="row border-top py-1">
                            <div class="col-xs-6 my-1 text-center">
                                <div class="cuenta-numero-var">
                                    <?php
                                        echo $cuentaNum;
                                        $cuentaNum++;
                                    ?>
                                </div> 
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Banco seleccionado</small>
                                </label>
                                <?php foreach( $bancos_cliente as $banco ): ?>
                                <?php if( $cuenta['banco'] == $banco['id']): ?>
                                <span class="after-label"><?= $banco['banco']; ?></span>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Número de Cuenta</small>
                                </label>
                                <?php foreach( $bancos_cliente as $banco ): ?>
                                <?php if( $cuenta['banco'] == $banco['id'] ): ?>
                                    <span class="after-label"><?= $banco['cuenta']; ?></span>
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
                                    <small>Documento de Identidad</small>
                                </label>
                                <?php foreach( $bancos_cliente as $banco ): ?>
                                <?php if( $cuenta['banco'] == $banco['id'] ): ?>
                                <span class="after-label"><?= $banco['documento']; ?></span>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Teléfono</small>
                                </label>
                                <?php foreach( $bancos_cliente as $banco ): ?>
                                <?php if( $cuenta['banco'] == $banco['id'] ): ?>
                                <span class="after-label"><?= $banco['telefono']; ?></span>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Correo Electrónico</small>
                                </label>
                                <?php foreach( $bancos_cliente as $banco ): ?>
                                <?php if( $cuenta['banco'] == $banco['id'] ): ?>
                                <span class="after-label"><?= $banco['email']; ?></span>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-xs-6 my-1"></div>
                            <div class="col-xs-6 my-1">
                                <label>
                                    <small>Monto a pagar</small>
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
        </div>
    </div>
</div>