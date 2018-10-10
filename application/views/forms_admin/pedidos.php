<div class="content animated fadeIn pt-0">
    <div class="container-fluid">
    
    <div class="text-center my-2">
        <h4 class="font-lighter">¿Qué deseas hacer?</h4>
        <button class="btn btn-primary active" style="border:0" id="reportarPagoBtn">Reportar un pago</button>
        <button class="btn btn-primary" style="border:0" id="pedidosBtn">Ver tu historial de pedidos</button>
    </div>
    
    <?= form_open_multipart('control_pedidos', array( 'id' => 'pedidoForm' ));?>
    <div class="row my-5" id="pagoBancos">
        <input type="hidden" name="id_cliente" value="<?= $_SESSION['id_cexpress']; ?>">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header text-center">
                            <div class="big-circle">
                                <span class="jumbo text-primary"><i data-title-choice="principal" class="ti-reload"></i></span>
                            </div>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">
                                        <small>¿En qué país te encuentras?</small>
                                    </label>
                                    <div class="form-group">
                                        <select name="pais_receptor" class="custom-input" id="paisCuentaReceptor">
                                            <option value="false"></option>
                                            <?php foreach( $paises as $pais ): ?>
                                                <?php if( $pais['pais'] != "Venezuela" ): ?>
                                                    <option value="<?= $pais['pais']; ?>"><?= $pais['pais']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="text-danger" id="paisCuentaReceptorErr"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">
                                            <small>¿En cúal de nuestras cuentas depositaste?</small>
                                        </label>
                                        <select name="cuenta_receptor" class="custom-input" name="cuenta_receptor" id="CuentasAdmin">
                                            <option value="false"></option>
                                            <option value="moneyGram">MoneyGram</option>
                                            <option value="westernUnion">Western Union</option>
                                        </select>
                                        <small class="text-danger" id="CuentasAdminErr"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">
                                            <small>Seleccione Moneda</small>
                                        </label>
                                        <select name="" class="custom-input" id="laMoneda">
                                            <option value="false"></option>
                                            <?php foreach( $paises as $pais ): ?>
                                                <?php if( $pais['pais'] != "Venezuela" ): ?>
                                                    <option value="<?= $pais['pais']; ?>"><?= $pais['moneda'] . " - " .  $pais['diminutivo']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="text-danger" id="laMonedaErr"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="">
                                                    <small>¿Cuánto depositaste? <strong class="text-success">(usa "." para decimales)</strong></small>
                                                </label>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-9 col-xs-8">
                                                        <input name="monto_pagado" class="custom-input" id="montoPagado" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#montoPagadoErr">
                                                    </div>
                                                    <div class="col-md-3 col-xs-4">
                                                        <input type="text" class="custom-input" disabled id="diminutivoReceptor">
                                                        <input type="hidden" name="diminutivo_receptor" id="diminutivo_receptor">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <small class="text-danger" id="montoPagadoErr"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="card">
                        <div class="header text-center">
                            <div class="big-circle">
                                <span class="jumbo text-primary"><i data-title-choice="principal" class="ti-upload"></i></span>
                            </div>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            <small>Número de Comprobante o Transacción</small><br>
                                            <small>
                                                <strong class="text-success">
                                                    Para MoneyGram o Western Union colocar de la siguiente forma<br> 
                                                    Tracking ID - Nombre y Apellido - País Destino
                                                </strong>    
                                            </small>
                                        </label>
                                        <input type="text" class="custom-input" name="num_operacion" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#comprobante">
                                        <small class="text-danger" id="comprobante"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <small>
                                            <strong class="text-success">
                                                *Obligatorio (Formatos permitidos, .JPG, .PNG, .GIF) Max. 500 Kb
                                            </strong>
                                        </small>
                                        <input type="file" class="file-input my-3" name="comprobante" id="inFile" data-validation="mime size required" 
                                        data-validation-allowing="jpg, png, gif" 
                                        data-validation-max-size="500kb" 
                                        data-validation-error-msg-container="#inFileErr"
                                        data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Se requiere Comprobante de transacción"
                                        data-validation-error-msg-size="<i class='ti-info-alt'></i>&nbsp;Las imágenes debe tener un tamaño máximo de 500kb"
                                        data-validation-error-msg-mime="<i class='ti-info-alt'></i>&nbsp;Solo puedes subir imágenes jpg, png, gif"><br>
                                        <small class="text-danger" id="inFileErr"><?= $img_err; ?></small>
                                        <div id="outFile" class="mt-2"></div>                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
            <div class="card">
                <div class="header text-center">
                    <div class="big-circle">
                        <span class="jumbo text-primary"><i data-title-choice="principal" class="ti-hand-point-up"></i></span>
                    </div>
                    <div class="content">
                        <input type="hidden" id="paisBeneficiario" value="Venezuela" name="pais_beneficiario">
                        <div class="row">
                            <div class="col-md-9 col-xs-8">
                                <div class="form-group">
                                    <label for="">
                                        <small>Recibirás</small>
                                    </label>
                                    <input disabled class="custom-input" style="border-top: 0; border-left: 0; border-right: 0; border-radius: 0;" id="montoBeneficiario">
                                    <input type="hidden" name="monto_operacion" id="montoBeneficiarioHidden">
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-4">
                                <label for="">
                                    <small>&nbsp;</small>
                                </label>
                                <?php foreach( $paises as $pais ): ?>
                                    <?php if( $pais['pais'] == "Venezuela" ): ?>
                                        <input type="text" class="custom-input" style="border:0; background: transparent" disabled value="<?= $pais['diminutivo']; ?>">
                                    <?php endif;?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <hr>
                        <label>
                            <small>
                                <i class="ti-info-alt text-info" data-title-choice="principal" style="font-size: 25px;"></i><br>
                                <strong>Puedes solicitar tu pago en una o varias cuentas</strong><br>
                                <?php echo nombreweb;  ?> te permite seleccionar hasta cinco de tus cuentas donde podrás recibir el pago de manera fraccionada. <br>
                                <strong class="text-success">(usa "." para decimales)</strong>
                            </small>
                        </label>
                        <hr>
                        <small class="text-danger" id="sumatoriaErr"></small>
                        <div class="row position-relative mt-2">
                            <span class="cuenta-num">1</span>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">
                                        <small>Selecciona una cuenta ó</small><br>
                                        <button type="button" id="addNuevaCuentaBtn" data-open-new="true" value="cuenta1" class="btn-custom"><small>Registrar nueva cuenta&nbsp;+</small></button>
                                    </label>
                                    <select name="primera_cuenta" class="custom-input" id="cuentaBeneficiaria">
                                        <option value="false"></option>
                                        <?php foreach( $bancos_usuarios as $banco_usuario ): ?>
                                            <option value="<?= $banco_usuario['id']; ?>"><?= $banco_usuario['banco'] . " - " . $banco_usuario['alias']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger" id="cuentaBeneficiariaErr"></small>
                                    <div id="newElement"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">
                                    <br>
                                        <small>Monto</small>
                                    </label>
                                    <input name="primer_monto" class="custom-input" id="primerMonto" value="0">
                                    <small class="text-danger" id="primerMontoErr"></small>
                                </div>
                            </div>
                            <div class="col-md-1 text-center">
                                <label class="hide-small">
                                    <br>
                                    &nbsp;
                                </label>
                                <button type="button" value="cuenta1" id="resetearCuenta" data-reset-cuenta="true" class="text-danger display-none-imp" style="border: 0; background: #FFF;">x</button>
                            </div>
                        </div>
                        <div class="text-right" id="primeraCuentaBtnDiv">
                            <label>
                                <small>Agrega otra cuenta</small>
                            </label>
                            <button class="btn btn-primary plus-small" style="border: 0;" data-color-choice="principal" set-color-text="principal" id="primeraCuentaBtn"><i class="ti-plus"></i></button>
                        </div>

                        
                        <div class="display-none" id="primeraCuenta">
                            <div class="row position-relative">
                                <span class="cuenta-num">2</span>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">
                                            <small>Selecciona una cuenta ó</small><br>
                                            <button type="button" id="addNuevaCuentaBtn1" data-open-new="true" value="cuenta2" class="btn-custom"><small>Registrar nueva cuenta&nbsp;+</small></button>
                                        </label>
                                        <select name="segunda_cuenta" class="custom-input" id="segundaCuentaBen">
                                            <option value="false"></option>
                                            <?php foreach( $bancos_usuarios as $banco_usuario ): ?>
                                                <option value="<?= $banco_usuario['id']; ?>"><?= $banco_usuario['banco'] . " - " . $banco_usuario['alias']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div id="newElement1"></div>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            <br>
                                            <small>Monto</small>
                                        </label>
                                        <input name="segundo_monto" class="custom-input" id="segundoMonto" value="0">
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <label class="hide-small">
                                        <br>
                                        &nbsp;
                                    </label>
                                    <button type="button" value="cuenta2" id="resetearCuenta1" data-reset-cuenta="true" class="text-danger display-none-imp" style="border: 0; background: #FFF; ">x</button>
                                </div>
                            </div>
                            <div class="text-right" id="terceraCuentaBtnDiv">
                                <label>
                                    <small>Agrega otra cuenta</small>
                                </label>
                                <button class="btn btn-primary plus-small" style="border: 0;" data-color-choice="principal" set-color-text="principal" id="terceraCuentaBtn"><i class="ti-plus"></i></button>
                            </div>
                        </div>

                        <div class="display-none" id="terceraCuenta">
                            <div class="row position-relative">
                                <span class="cuenta-num">3</span>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>
                                            <small>Selecciona una cuenta ó</small><br>
                                            <button type="button" id="addNuevaCuentaBtn1" data-open-new="true" value="cuenta3" class="btn-custom"><small>Registrar nueva cuenta&nbsp;+</small></button>
                                        </label>
                                        <select name="tercera_cuenta" class="custom-input" id="terceraCuentaBen">
                                            <option value="false"></option>
                                            <?php foreach( $bancos_usuarios as $banco_usuario ): ?>
                                                <option value="<?= $banco_usuario['id']; ?>"><?= $banco_usuario['banco'] . " - " . $banco_usuario['alias']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div id="newElement2"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            <br>
                                            <small>Monto</small>
                                        </label>
                                        <input name="tercer_monto" class="custom-input" id="tercerMonto" value="0">
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <label class="hide-small">
                                        <br>
                                        &nbsp;
                                    </label>
                                    <button type="button" value="cuenta3" id="resetearCuenta2" data-reset-cuenta="true" class="text-danger display-none-imp" style="border: 0; background: #FFF; ">x</button>
                                </div>
                            </div>
                            <div class="text-right" id="cuartaCuentaDiv">
                                <label>
                                    <small>Agrega otra cuenta</small>
                                </label>
                                <button class="btn btn-primary plus-small" style="border: 0;" data-color-choice="principal" set-color-text="principal" id="cuartaCuentaBtn"><i class="ti-plus"></i></button>
                            </div>
                        </div>

                        <div class="display-none" id="cuartaCuenta">
                            <div class="row position-relative">
                                <span class="cuenta-num">4</span>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>
                                            <small>Selecciona una cuenta ó</small><br>
                                            <button type="button" id="addNuevaCuentaBtn1" data-open-new="true" value="cuenta4" class="btn-custom"><small>Registrar nueva cuenta&nbsp;+</small></button>
                                        </label>
                                        <select name="cuarta_cuenta" class="custom-input" id="cuartaCuentaBen">
                                            <option value="false"></option>
                                            <?php foreach( $bancos_usuarios as $banco_usuario ): ?>
                                                <option value="<?= $banco_usuario['id']; ?>"><?= $banco_usuario['banco'] . " - " . $banco_usuario['alias']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div id="newElement3"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            <br>
                                            <small>Monto</small>
                                        </label>
                                        <input name="cuarto_monto" class="custom-input" id="cuartoMonto" value="0">
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <label class="hide-small">
                                        <br>
                                        &nbsp;
                                    </label>
                                    <button type="button" value="cuenta4" id="resetearCuenta3" data-reset-cuenta="true" class="text-danger display-none-imp" style="border: 0; background: #FFF; ">x</button>
                                </div>
                            </div>
                            <div class="text-right" id="quintaCuentaBtnDiv">
                                <label>
                                    <small>Agrega otra cuenta</small>
                                </label>
                                <button class="btn btn-primary plus-small" style="border: 0;" data-color-choice="principal" set-color-text="principal" id="quintaCuentaBtn"><i class="ti-plus"></i></button>
                            </div>
                        </div>

                        <div class="display-none" id="quintaCuenta">
                            <div class="row position-relative">
                                <span class="cuenta-num">5</span>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>
                                            <small>Selecciona una cuenta ó</small><br>
                                            <button type="button" id="addNuevaCuentaBtn1" data-open-new="true" value="cuenta5" class="btn-custom"><small>Registrar nueva cuenta&nbsp;+</small></button>
                                        </label>
                                        <select name="quinta_cuenta" class="custom-input" id="quintaCuentaBen">
                                            <option value="false"></option>
                                            <?php foreach( $bancos_usuarios as $banco_usuario ): ?>
                                                <option value="<?= $banco_usuario['id']; ?>"><?= $banco_usuario['banco'] . " - " . $banco_usuario['alias']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div id="newElement4"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            <br>
                                            <small>Monto</small>
                                        </label>
                                        <input name="quinto_monto" class="custom-input" id="quintoMonto" value="0">
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <label class="hide-small">
                                        <br>
                                        &nbsp;
                                    </label>
                                    <button type="button" value="cuenta5" id="resetearCuenta4" data-reset-cuenta="true" class="text-danger display-none-imp" style="border: 0; background: #FFF; ">x</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-md-12 text-center">
                <div class="card">
                    <div class="header text-center">
                        <div class="big-circle">
                            <span class="jumbo text-primary"><i data-title-choice="principal" class="ti-bell"></i></span>
                        </div>
                    </div>
                    <div class="content">
                        <div class="alert alert-warning alert-with-icon" data-notify="container">
                            <span data-notify="icon" class="ti-info-alt"></span>
                            <span data-notify="message">Verifica que la información suministrada sea correcta</span>
                        </div>
                        <?php if( $usuario->verificado == 0 || $usuario->verificado == 1 ): ?>
                            <p class="text-danger">
                                Debes completar tu proceso de verificación primero<br>
                                Puedes realizarlo en la sección de <a href="<?= base_url() . 'perfil'; ?>">Perfil&nbsp;<i class="fa fa-link"></i></a>
                            </p>

                        <?php endif; ?>
                        <button type="submit" class="btn-block btn btn-primary" data-color-choice="principal"] set-color-text="principal" style="border: 0" <?php if( $usuario->verificado == 0 || $usuario->verificado == 1 ): echo "disabled"; endif; ?>>Registra tu pedido</button>             
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

    <div class="row display-none my-5" id="pedidosContent">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Pedidos</h4>
                    <small>Ve tu historial de pedidos y verifica sus status</small>
                </div>
                <div class="content">
                    <?php if( $pedidos != FALSE ): ?>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                                <th class="text-center">ID</th>
                                <th class="text-center">Banco Origen</th>
                            	<th class="text-center">Monto Pagado</th>
                                <th class="text-center">Monto a Recibir</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </thead>
                            <tbody>
                               <?php foreach( $pedidos as $pedido ): ?>
                                <tr class="text-center">
                                    <td>
                                        <small><?= $pedido['id']; ?></small>
                                    </td>
                                    <td>                    
                                        <?php foreach( $bancos_admin as $banco ): ?>
                                            <?php if( $pedido['banco_receptor'] == $banco['id'] ): ?>
                                                <small><?= $banco['pais']; ?></small><br>
                                                <?= $banco['banco']; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php if( $pedido['banco_receptor'] == "westernUnion"): ?>
                                            <span class="after-label">Western Union</span>
                                        <?php elseif( $pedido['banco_receptor'] == "moneyGram" ): ?>
                                            <span class="after-label">MoneyGram</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= number_format( $pedido['monto_pagado'], 2 ); ?>&nbsp;
                                        <?= $pedido['diminutivo_pagado']; ?>
                                    </td>
                                    <td>
                                        <?= number_format( $pedido['monto_operacion'], 2 ); ?>&nbsp;
                                        <?php foreach( $bancos_usuarios as $diminutivo ): ?>
                                            <?php if( $pedido['banco_beneficiario'] == $diminutivo['id'] ): ?>
                                            <?= $diminutivo['diminutivo']; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </td>
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
                                        <?php elseif( $pedido['status'] == 4 ): ?>
                                            <span class="text-sucess">
                                                <i class="ti-check"></i>
                                                Terminado
                                            </span>
                                        <?php elseif( $pedido['status'] == 2 ): ?>
                                            <span class="text-danger">
                                                <i class="ti-info-check"></i>
                                                Rechazado
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-sm btn-fill" href="<?= base_url() . 'pedido?i=' . $pedido['id']; ?>"><i class="ti-eye"></i></a>
                                    </td>
                                </tr>
                               <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <div class="text-center">
                            <h4 class="text-warning">
                                <i class="ti-info-alt"></i><br>
                                Aún no tienes pedidos registrados
                            </h4>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div> 

    </div><!-- Container-fluid -->
</div> <!-- Content -->

    <div class="pedidos-cuenta-modal display-none" id="nuevaCuentaPedidos">
        <div class="card shadow-custom" style="background-image: url('<?= base_url() . 'assets/img/back.png'; ?>'); background-repeat: no-repeat; background-position: 0 200px;">
            <div class="row">
                <div class="col-xs-9 px-4">
                    <h3 class="text-purple">Cuenta Bancaria</h3>
                </div>
                <div class="col-xs-3 text-right">
                    <button class="purple-cexpress button-close-modal" id="closeNuevaCuentaPedidos">
                        <i class="ti-close"></i>
                    </button>
                </div>
            </div>
            <div class="content">
            <form id="addCuentaSeccionPedidos">
                <input type="hidden" id="whichCuenta">
                <input type="hidden" name="id" value="<?= $_SESSION['id_cexpress']; ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">
                                    <small>Alias</small>
                                </label>
                                <input type="text" data-cuenta-input="true" class="custom-input" name="alias" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#alias">
                                <small class="text-danger" id="alias"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">
                                    <small>Cuenta</small>
                                </label>
                                <input type="text" data-cuenta-input="true" class="custom-input" name="cuenta" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#cuenta">
                                <small class="text-danger" id="cuenta"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">
                                    <small>Titular</small>
                                </label>
                                <input type="text" data-cuenta-input="true" class="custom-input" name="titular" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#titular">
                                <small class="text-danger" id="titular"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    <small>Tipo de cuenta</small>
                                </label>
                                <input type="text" data-cuenta-input="true" class="custom-input" name="tipo" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#tipo">
                                <small class="text-danger" id="tipo"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    <small>C.I.</small>
                                </label><br>
                                <select name="tipo_documento" class="custom-input" style="width:30%; float:left">
                                    <option value="E-">E</option>
                                    <option value="V-">V</option>
                                    <option value="P-">P</option>
                                    <option value="G-">G</option>
                                    <option value="J-">J</option>
                                <select>
                                <input type="text" data-cuenta-input="true" class="custom-input" name="dni" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#dni" style="width: 70%; float: left">
                                <small class="text-danger" id="dni"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    <small>Teléfono</small>
                                </label>
                                <input type="text" data-cuenta-input="true" class="custom-input" name="telefono" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#telefono">
                                <small class="text-danger" id="telefono"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">
                                    <small>Email</small>
                                </label>
                                <input type="text" data-cuenta-input="true" class="custom-input" name="email" data-validation="email" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Formato de Correo Inválido" data-validation-error-msg-container="#email">
                                <small class="text-danger" id="email"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">
                                    <small>País</small>
                                </label>
                                <select class="custom-input" id="paisBancoSeleccion" name="pais">
                                    <option value="false">Selecciona un país</option>
                                    <option value="Venezuela">Venezuela</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="">
                                    <small>Banco</small>
                                </label>
                                <select name="banco" id="bancoSeleccionCrear" class="custom-input">
                                    <option value="false">Selecciona un banco</option>
                                    <option value="Otros">Otro</option>
                                </select>
                                <small class="text-danger" id="bancoErr"></small>
                            </div>
                        </div>
                        <div class="col-md-6" id="bancoAlt" style="display: none">
                            <label for="">
                                <small>Nombre del Banco</small>
                            </label>
                            <input type="text" class="custom-input" name="banco_alt" id="banco_alt" data-cuenta-input="true">
                            <small class="text-danger" id="bancoalt"></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group text-right">
                                <br>
                                <button type="submit" class="btn btn-primary btn-icon-circle"><small><i class="ti-plus"></i>&nbsp;Agregar</small></button>
                            </div>
                        </div>
                    </div>
                </form>            
            </div>
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
                    document.getElementById("outFile").innerHTML = ['<img style="width:50%; border-radius: 10px; box-shadow: 3px 5px 10px lightgrey;" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
            };
            })(f);
            reader.readAsDataURL(f);
        }
        }
        document.getElementById('inFile').addEventListener('change', thumb_1, false);
</script>