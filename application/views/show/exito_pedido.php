<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header text-center animated shake">
                        <div class="alert alert-success">
                            <h4 class="title text-success">
                                <i class="ti-check text-success"></i>
                            </h4>
                            <p>Su orden ha sido recibida exitosamente!</p>
                        </div>
                    </div>
                    <div class="content">
                        <p class="text-warning"><i class="ti-info-alt"></i>&nbsp;<strong class="text-warning">Atención</strong></p>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>
                                        Las transferencias <strong>serán procesadas de acuerdo al volumen de solicitudes</strong>, el cual <strong>no será mayor a 2 horas</strong> siempre y cuando la información que nos suministró sea correcto.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Las transferencias enviadas a <strong>Banesco serán acreditadas el mismo día dependiendo siempre de la operatividad del Banco</strong>.
                                    </td>     
                                </tr>
                                <tr>
                                    <td>
                                        Las transferencias enviadas a <strong>otros Bancos diferentes a Banesco, serán acreditadas al siguiente día hábil</strong>, después de las 2 pm o incluso en muchos casos a las 6 pm. <strong>Sea paciente</strong>.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Le recordamos que este es un <strong>servicio privado y confidencial</strong> si usted disfruta del mismo es porque ha sido un cliente confiable, sigamos así.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Para <strong>cualquier duda</strong> siempre cuenta con nuestro WhatsApp de atención al cliente <strong>+51 917 835 815</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right">
                            <p>Gracias por confiar en nuestros servicios.</p>
                            <hr>
                            <p>CEO Remesas</p>
                        </div>
                    </div>
                </div>
            </div>

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
                                <span class="after-label">
                                    <?php if( $banco_receptor ): ?>
                                        <?= $banco_receptor->banco; ?>
                                    <?php elseif( $pedido->banco_receptor == "westernUnion"): ?>
                                        Western Union
                                    <?php elseif( $pedido->banco_receptor == "moneyGram" ): ?>
                                        MoneyGram
                                    <?php endif; ?>
                                </span>
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
                        <div class="row">
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
                        <?php foreach( $complementos as $cuenta ): ?>
                        <div class="row border-top">
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

                        <div class="row border-top border-bottom py-1">
                            <div class="col-xs-12 text-center">
                                <strong>Recibido - en proceso</strong>
                            </div>
                        </div>
                        <div class="row py-1">
                            <div class="col-xs-12">
                                <div class="alert alert-info text-center">
                                    Una copia de este recibo fue enviada a su correo electrónico
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>