<div class="content animated fadeIn pt-0">
    <div class="container-fluid">
    
    <div class="text-center my-2">
        <h4 class="font-lighter">¿Qué deseas hacer?</h4>
        <button class="btn btn-primary active" id="reportarPagoBtn">Reportar un pago</button>
        <button class="btn btn-primary" id="pedidosBtn">Ver tu historial de pedidos</button>
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
                                <span class="jumbo text-primary"><i class="ti-reload"></i></span>
                            </div>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">
                                        <small>¿De qué país es el Banco Receptor?</small>
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
                                        </select>
                                        <small class="text-danger" id="CuentasAdminErr"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-xs-8">
                                    <div class="form-group">
                                        <label for="">
                                            <small>¿Cuánto depositaste? <span class="text-danger">(usa "." para decimales)</span></small>
                                        </label>
                                        <input name="monto_pagado" class="custom-input" id="montoPagado" data-validation="required" data-validation-error-msg="Campo Requerido" data-validation-error-msg-container="#montoPagadoErr">
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-4">
                                    <label for="">
                                        <small>&nbsp;</small>
                                    </label>
                                    <input type="text" class="custom-input" disabled id="diminutivoReceptor">
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
                                <span class="jumbo text-primary"><i class="ti-upload"></i></span>
                            </div>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            <small>Número de Comprobante o Transacción</small>
                                        </label>
                                        <input type="text" class="custom-input" name="num_operacion" data-validation="required" data-validation-error-msg="Campo Requerido" data-validation-error-msg-container="#comprobante">
                                        <small class="text-danger" id="comprobante"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <small class="text-danger">*Obligatorio (Formatos permitidos, .JPG, .PNG, .GIF) Max. 500 Kb</small>
                                        <input type="file" class="file-input" name="comprobante" id="inFile">
                                        <div id="outFile" class="animated bounceIn pt-5"></div>                   
                                        <small class="text-danger"><?= $img_err; ?></small>
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
                        <span class="jumbo text-primary"><i class="ti-hand-point-up"></i></span>
                    </div>
                    <div class="content">
                        <input type="hidden" id="paisBeneficiario" value="Venezuela" name="pais_beneficiario">
                        <div class="row">
                            <div class="col-md-9 col-xs-8">
                                <div class="form-group">
                                    <label for="">
                                        <small>Recibirás</small>
                                    </label>
                                    <input disabled class="custom-input" id="montoBeneficiario">
                                    <input type="hidden" name="monto_operacion" id="montoBeneficiarioHidden">
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-4">
                                <label for="">
                                    <small>&nbsp;</small>
                                </label>
                                <?php foreach( $paises as $pais ): ?>
                                    <?php if( $pais['pais'] == "Venezuela" ): ?>
                                        <input type="text" class="custom-input" disabled value="<?= $pais['diminutivo']; ?>">
                                    <?php endif;?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <hr>
                        <label>
                            <small>
                                <i class="ti-info-alt text-info" style="font-size: 25px;"></i><br>
                                <strong>Puedes solicitar tu pago en una o varias cuentas</strong><br>
                                Cexpress te permite seleccionar hasta cinco de tus cuentas donde podrás recibir el pago de manera fraccionada. <br>
                                <span class="text-danger">(usa "." para decimales)</span>  
                            </small>
                        </label>
                        <hr>
                        <small class="text-danger" id="sumatoriaErr"></small>
                        <div class="row position-relative">
                            <span class="cuenta-num">1</span>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">
                                        <small>Selecciona una cuenta ó</small><br>
                                        <button type="button" id="addNuevaCuentaBtn" data-open-new="true" value="cuenta1" class="btn-custom"><small>Registrar nueva cuenta</small></button>
                                    </label>
                                    <select name="primera_cuenta" class="custom-input" id="cuentaBeneficiaria">
                                        <option value="false"></option>
                                        <?php foreach( $bancos_usuarios as $banco_usuario ): ?>
                                            <option value="<?= $banco_usuario['id']; ?>"><?= $banco_usuario['banco']; ?></option>
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
                                <label>
                                    <br>
                                    &nbsp;
                                </label>
                                <button type="button" value="cuenta1" id="resetearCuenta" data-reset-cuenta="true" class="text-danger display-none" style="border: 0; background: #FFF; ">x</button>
                            </div>
                        </div>
                        <div class="text-right" id="primeraCuentaBtnDiv">
                            <label>
                                <small>Agrega otra cuenta</small>
                            </label>
                            <button class="btn btn-primary plus-small" id="primeraCuentaBtn"><i class="ti-plus"></i></button>
                        </div>

                        
                        <div class="display-none" id="primeraCuenta">
                            <div class="row position-relative">
                                <span class="cuenta-num">2</span>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">
                                            <small>Selecciona una cuenta ó</small><br>
                                            <button type="button" id="addNuevaCuentaBtn1" data-open-new="true" value="cuenta2" class="btn-custom"><small>Registrar nueva cuenta</small></button>
                                        </label>
                                        <select name="segunda_cuenta" class="custom-input" id="segundaCuentaBen">
                                            <option value="false"></option>
                                            <?php foreach( $bancos_usuarios as $banco_usuario ): ?>
                                                <option value="<?= $banco_usuario['id']; ?>"><?= $banco_usuario['banco']; ?></option>
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
                                    <label>
                                        <br>
                                        &nbsp;
                                    </label>
                                    <button type="button" value="cuenta2" id="resetearCuenta1" data-reset-cuenta="true" class="text-danger display-none" style="border: 0; background: #FFF; ">x</button>
                                </div>
                            </div>
                            <div class="text-right" id="terceraCuentaBtnDiv">
                                <label>
                                    <small>Agrega otra cuenta</small>
                                </label>
                                <button class="btn btn-primary plus-small" id="terceraCuentaBtn"><i class="ti-plus"></i></button>
                            </div>
                        </div>

                        <div class="display-none" id="terceraCuenta">
                            <div class="row position-relative">
                                <span class="cuenta-num">3</span>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>
                                            <small>Selecciona una cuenta ó</small><br>
                                            <button type="button" id="addNuevaCuentaBtn1" data-open-new="true" value="cuenta3" class="btn-custom"><small>Registrar nueva cuenta</small></button>
                                        </label>
                                        <select name="tercera_cuenta" class="custom-input" id="terceraCuentaBen">
                                            <option value="false"></option>
                                            <?php foreach( $bancos_usuarios as $banco_usuario ): ?>
                                                <option value="<?= $banco_usuario['id']; ?>"><?= $banco_usuario['banco']; ?></option>
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
                                    <label>
                                        <br>
                                        &nbsp;
                                    </label>
                                    <button type="button" value="cuenta3" id="resetearCuenta2" data-reset-cuenta="true" class="text-danger display-none" style="border: 0; background: #FFF; ">x</button>
                                </div>
                            </div>
                            <div class="text-right" id="cuartaCuentaDiv">
                                <label>
                                    <small>Agrega otra cuenta</small>
                                </label>
                                <button class="btn btn-primary plus-small" id="cuartaCuentaBtn"><i class="ti-plus"></i></button>
                            </div>
                        </div>

                        <div class="display-none" id="cuartaCuenta">
                            <div class="row position-relative">
                                <span class="cuenta-num">4</span>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>
                                            <small>Selecciona una cuenta ó</small><br>
                                            <button type="button" id="addNuevaCuentaBtn1" data-open-new="true" value="cuenta4" class="btn-custom"><small>Registrar nueva cuenta</small></button>
                                        </label>
                                        <select name="cuarta_cuenta" class="custom-input" id="cuartaCuentaBen">
                                            <option value="false"></option>
                                            <?php foreach( $bancos_usuarios as $banco_usuario ): ?>
                                                <option value="<?= $banco_usuario['id']; ?>"><?= $banco_usuario['banco']; ?></option>
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
                                    <label>
                                        <br>
                                        &nbsp;
                                    </label>
                                    <button type="button" value="cuenta4" id="resetearCuenta3" data-reset-cuenta="true" class="text-danger display-none" style="border: 0; background: #FFF; ">x</button>
                                </div>
                            </div>
                            <div class="text-right" id="quintaCuentaBtnDiv">
                                <label>
                                    <small>Agrega otra cuenta</small>
                                </label>
                                <button class="btn btn-primary plus-small" id="quintaCuentaBtn"><i class="ti-plus"></i></button>
                            </div>
                        </div>

                        <div class="display-none" id="quintaCuenta">
                            <div class="row position-relative">
                                <span class="cuenta-num">5</span>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>
                                            <small>Selecciona una cuenta ó</small><br>
                                            <button type="button" id="addNuevaCuentaBtn1" data-open-new="true" value="cuenta5" class="btn-custom"><small>Registrar nueva cuenta</small></button>
                                        </label>
                                        <select name="quinta_cuenta" class="custom-input" id="quintaCuentaBen">
                                            <option value="false"></option>
                                            <?php foreach( $bancos_usuarios as $banco_usuario ): ?>
                                                <option value="<?= $banco_usuario['id']; ?>"><?= $banco_usuario['banco']; ?></option>
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
                                    <label>
                                        <br>
                                        &nbsp;
                                    </label>
                                    <button type="button" value="cuenta5" id="resetearCuenta4" data-reset-cuenta="true" class="text-danger display-none" style="border: 0; background: #FFF; ">x</button>
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
                            <span class="jumbo text-primary"><i class="ti-bell"></i></span>
                        </div>
                    </div>
                    <div class="content">
                        <div class="alert alert-warning alert-with-icon" data-notify="container">
                            <span data-notify="icon" class="ti-info-alt"></span>
                            <span data-notify="message">Verifica que la información suministrada sea correcta</span>
                        </div>
                        <small class="text-danger">Debes esperar a que tu usuario sea verificado</small>
                        <button type="submit" class="btn-block btn btn-primary" <?php if( $usuario->verificado == 0 ): echo "disabled"; endif; ?>>Registra tu pedido</button>             
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
                                    </td>
                                    <td>
                                        <?= number_format( $pedido['monto_pagado'], 2 ); ?>&nbsp;
                                        <?php foreach( $bancos_admin as $diminutivo ): ?>
                                            <?php if( $pedido['banco_receptor'] == $diminutivo['id'] ): ?>
                                            <?= $diminutivo['diminutivo']; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
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
                                        <?php if( $pedido['status'] == 1 ): ?>
                                            <span class="text-success">
                                                <i class="ti-check"></i>
                                                Aceptado
                                            </span>
                                        <?php elseif( $pedido['status'] == 0 ): ?>
                                            <span class="text-warning">
                                                <i class="ti-info-alt"></i>
                                                Pendiente
                                            </span>
                                        <?php elseif( $pedido['status'] == 2 ): ?>
                                            <span class="text-danger">
                                                <i class="ti-info-alt"></i>
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

    <div class="modal-custom" id="modalWindow">
        <div class="card shadow-custom" style="background-image: url('<?= base_url() . 'assets/img/back.png'; ?>'); background-repeat: no-repeat; background-position: 0px 100px;">
            <div class="row">
                <div class="col-sm-6 px-4">
                    <h3 class="text-purple">Instrucciones</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="purple-cexpress button-close-modal" id="closeModalBtn">
                        <i class="ti-close"></i>
                    </button>
                </div>
            </div>
            <div class="content py-5">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <i class="ti-search text-purple" style="font-size: 50px;"></i>
                        <h5>Consulta nuestras cuentas</h5>
                        <small>Desde el <strong><i class="ti-dashboard"></i> tablero principal</strong> consulta <strong>cuales son nuestras cuentas disponibles</strong>, de esta forma podrás realizar el pago del monto deseado a través de transferencia o depósito en efectivo.</small>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="ti-clipboard text-purple" style="font-size: 50px;"></i>
                        <h5>Registra tu(s) cuenta(s)</h5>
                        <small>Debes tener al menos <strong>una <i class="ti-marker-alt"></i> cuenta registrada en nuestro sistema</strong>, de esta forma nos llegará la información de la misma y así podremos realizar el pago.<br>
                            <a href="<?= base_url() . 'cuentas_bancarias'; ?>" class="text-dark"><strong><i class="ti-link"></i>¿No tienes cuenta registradas?</strong></a>
                        </small>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="ti-clipboard text-purple" style="font-size: 50px;"></i>
                        <h5>Completa el formulario</h5>
                        <small><strong>Una vez realizado el pago</strong> procede a completar el formulario de pedido en su totalidad.<br><br> <strong>Cexpress te permite fraccionar tu pago entre 5 cuentas distintas.</strong></small>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="ti-rocket text-purple" style="font-size: 50px;"></i>
                        <h5>¡Es el momento! Procesa tu pedido</h5>
                        <small>Una vez completado el formulario, procesa tu pedido y espera a que el dinero sea abonado a tu(s) cuenta(s) solicitadas.</small>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    </div><!-- Container-fluid -->
</div> <!-- Content -->

    <div class="pedidos-cuenta-modal display-none" id="nuevaCuentaPedidos">
        <div class="card shadow-custom" style="background-image: url('<?= base_url() . 'assets/img/back.png'; ?>'); background-repeat: no-repeat; background-position: 0 200px;">
            <div class="row">
                <div class="col-sm-9 px-4">
                    <h3 class="text-purple">Agregar Cuenta Bancaria</h3>
                </div>
                <div class="col-sm-3 text-right">
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
                                <input type="text" data-cuenta-input="true" class="custom-input" name="alias" data-validation="required" data-validation-error-msg="Campo Requerido" data-validation-error-msg-container="#alias">
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
                                <input type="text" data-cuenta-input="true" class="custom-input" name="cuenta" data-validation="required" data-validation-error-msg="Campo Requerido" data-validation-error-msg-container="#cuenta">
                                <small class="text-danger" id="cuenta"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">
                                    <small>Titular</small>
                                </label>
                                <input type="text" data-cuenta-input="true" class="custom-input" name="titular" data-validation="required" data-validation-error-msg="Campo Requerido" data-validation-error-msg-container="#titular">
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
                                <input type="text" data-cuenta-input="true" class="custom-input" name="tipo" data-validation="required" data-validation-error-msg="Campo Requerido" data-validation-error-msg-container="#tipo">
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
                                <input type="text" data-cuenta-input="true" class="custom-input" name="dni" data-validation="required" data-validation-error-msg="Campo Requerido" data-validation-error-msg-container="#dni" style="width: 70%; float: left">
                                <small class="text-danger" id="dni"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    <small>Teléfono</small>
                                </label>
                                <input type="text" data-cuenta-input="true" class="custom-input" name="telefono" data-validation="required" data-validation-error-msg="Campo Requerido" data-validation-error-msg-container="#telefono">
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
                                <input type="text" data-cuenta-input="true" class="custom-input" name="email" data-validation="email" data-validation-error-msg="Formato de Correo Inválido" data-validation-error-msg-container="#email">
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