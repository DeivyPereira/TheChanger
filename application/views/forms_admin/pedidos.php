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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        <small>País Destino</small>
                                    </label>
                                    <select name="pais_beneficiario" class="custom-input" id="paisBeneficiario">
                                        <option value="false"></option>
                                        <option value="Venezuela">Venezuela</option>
                                    </select>
                                    <small class="text-danger" id="paisBeneficiarioErr"></small>
                                </div>
                            </div>
                        </div>
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
                                <input type="text" class="custom-input" disabled id="diminutivoBeneficiario">
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
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">
                                        <small>Primera Cuenta</small>
                                    </label>
                                    <select name="primera_cuenta" class="custom-input" id="cuentaBeneficiaria">
                                        <option value="false"></option>
                                    </select>
                                    <small class="text-danger" id="cuentaBeneficiariaErr"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">
                                        <small>Monto</small>
                                    </label>
                                    <input name="primer_monto" class="custom-input" id="primerMonto" value="0">
                                    <small class="text-danger" id="primerMontoErr"></small>
                                </div>
                            </div>
                        </div>
                        <div class="text-right" id="primeraCuentaBtnDiv">
                            <label>
                                <small>Agrega otra cuenta</small>
                            </label>
                            <button class="btn btn-primary plus-small" id="primeraCuentaBtn"><i class="ti-plus"></i></button>
                        </div>

                        
                        <div class="display-none" id="primeraCuenta">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">
                                            <small>Segunda Cuenta</small>
                                        </label>
                                        <select name="segunda_cuenta" class="custom-input" id="segundaCuentaBen">
                                            <option value="false"></option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <small>Monto</small>
                                        </label>
                                        <input name="segundo_monto" class="custom-input" id="segundoMonto" value="0">
                                    </div>
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
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>
                                            <small>Tercera Cuenta</small>
                                        </label>
                                        <select name="tercera_cuenta" class="custom-input" id="terceraCuentaBen">
                                            <option value="false"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <small>Monto</small>
                                        </label>
                                        <input name="tercer_monto" class="custom-input" id="tercerMonto" value="0">
                                    </div>
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
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>
                                            <small>Cuarta Cuenta</small>
                                        </label>
                                        <select name="cuarta_cuenta" class="custom-input" id="cuartaCuentaBen">
                                            <option value="false"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <small>Monto</small>
                                        </label>
                                        <input name="cuarto_monto" class="custom-input" id="cuartoMonto" value="0">
                                    </div>
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
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>
                                            <small>Quinta Cuenta</small>
                                        </label>
                                        <select name="quinta_cuenta" class="custom-input" id="quintaCuentaBen">
                                            <option value="false"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <small>Monto</small>
                                        </label>
                                        <input name="quinto_monto" class="custom-input" id="quintoMonto" value="0">
                                    </div>
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
                        <button type="submit" class="btn-block btn btn-primary">Registra tu pedido</button>             
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