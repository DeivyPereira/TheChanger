<?php if( $usuario->verificado == 0 && $_SESSION['role_cexpress'] == 4 && $titulo == "Tablero" ): ?>
    <div class="modal-bg" id="modalWindow"></div>
    <div class="modal-custom animated showMe modal-position" id="modalWindowContent" style="width: 30%">
        <div class="card shadow-custom">
            <div class="row">
                <div class="col-xs-6 px-4">
                    <h3 data-title-choice="principal">Atención</h3>
                </div>
                <div class="col-xs-6 text-right">
                    <button class="clear-bussiness button-close-modal" set-color-text="principal" data-color-choice="principal" id="closeModalBtn">
                        <i class="ti-close"></i>
                    </button>
                </div>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <i class="ti-info-alt" data-title-choice="principal" style="font-size: 50px;"></i>
                        <h4  style="margin-top:0;" data-title-choice="principal">Importante</h4>
                        <p>Para poder realizar tus pedidos debes verificar tu usuario primero, te invitamos a completar el proceso desde tu perfil.</p>
                        <a href="<?= base_url() . 'perfil'; ?>" data-color-choice="principal" set-color-text="principal" class="btn btn-sm btn-fill btn-primary" style="border: none"><i class="ti-user"></i>&nbsp;Perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if( $titulo == "Cuentas Bancarias" && $_SESSION['role_cexpress'] == 4 && !isset( $_COOKIE['modalCuentas'] ) ): ?>
    <div class="modal-bg" id="modalWindow"></div>
    <div class="modal-custom animated showMe modal-position" id="modalWindowContent" style="width: 30%;">
        <div class="card shadow-custom">
            <div class="row">
                <div class="col-xs-6 px-4">
                    <h3 data-title-choice="principal">Atención</h3>
                </div>
                <div class="col-xs-6 text-right">
                    <button class="clear-bussiness button-close-modal" set-color-text="principal" data-color-choice="principal" id="closeModalBtn">
                        <i class="ti-close"></i>
                    </button>
                </div>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <i class="ti-info-alt" data-title-choice="principal" style="font-size: 50px;"></i>
                        <h4 style="margin-top:0" data-title-choice="principal">Importante</h4>
                        <p>Luego de haber ingresado los datos de la cuenta bancaria, verifica que los mismos sean correctos.</p>
                    </div>
                </div>
                <div class="form-group text-right" style="padding: 10px 10px 0 10px;">
                    <input type="checkbox" id="noMostrarModalCuentas" name="noMostrar">&nbsp;
                    <label for="noMostrarModalCuentas">
                        <small>No mostrar mas</small>
                    </label>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if( $_SESSION['role_cexpress'] == 4 && $titulo == "Control de Pedidos" && !isset( $_COOKIE['modalPedidos'] ) ): ?>
<div class="modal-bg" id="modalWindow"></div>
    <div class="modal-custom animated showMe modal-position" id="modalWindowContent" style="width: 60%">
        <div class="card shadow-custom">
            <div class="row">
                <div class="col-xs-6 px-4">
                    <h3 data-title-choice="principal">Instrucciones</h3>
                </div>
                <div class="col-xs-6 text-right">
                    <button class="clear-bussiness button-close-modal" set-color-text="principal" data-color-choice="principal" id="closeModalBtn">
                        <i class="ti-close"></i>
                    </button>
                </div>
            </div>
            <div class="content py-2">
                <div class="row">
                    <div class="col-md-3 col-xs-6 text-center mt-2">
                        <i class="ti-search" data-title-choice="principal" style="font-size: 50px;"></i>
                        <h5 data-title-choice="principal" class="responsive-h5 my-0">Consulta nuestras cuentas</h5>
                        <small class="hide-large">Y procesa tu pago.</small>
                        <small class="hide-small">Desde el <strong><i class="ti-dashboard"></i> tablero principal</strong> consulta <strong>nuestras cuentas bancarias</strong>.</small>
                    </div>
                    <div class="col-md-3 col-xs-6 text-center mt-2">
                        <i class="ti-pencil" data-title-choice="principal" style="font-size: 50px;"></i>
                        <h5 data-title-choice="principal" class="responsive-h5 my-0">Registra tu(s) cuenta(s)</h5>
                        <small class="hide-large">Y agiliza tu pedido</small>
                        <small class="hide-small">Debes tener al menos <strong>una <i class="ti-marker-alt"></i> cuenta registrada en nuestro sistema</strong> para poder realizar tu pedido.
                        </small>
                    </div>
                    <div class="col-md-3 col-xs-6 text-center mt-2">
                        <i class="ti-clipboard" data-title-choice="principal" style="font-size: 50px;"></i>
                        <h5 data-title-choice="principal" class="responsive-h5 my-0">Completa el formulario</h5>
                        <small class="hide-large">Y notifícanos</small>
                        <small class="hide-small"><strong>Una vez realices el pago</strong> completa el formulario que se te presenta.<br><strong><?php echo nombreweb;  ?> te permite fraccionar tu pago entre 5 cuentas distintas.</strong></small>
                    </div>
                    <div class="col-md-3 col-xs-6 text-center mt-2">
                        <i class="ti-rocket"  data-title-choice="principal" style="font-size: 50px;"></i>
                        <h5 data-title-choice="principal" class="responsive-h5 my-0">¡Es el momento! Procesa tu pedido</h5>
                        <small class="hide-large">Y procesaremos tu pago</small>
                        <small class="hide-small">Una vez completado el formulario, procesa tu pedido y espera a que el dinero sea abonado a tu(s) cuenta(s).</small>
                    </div>
                </div>
            </div>
                    <div class="form-group text-right" style="padding: 10px 25px 20px 25px;">
                        <input type="checkbox" id="noMostrarModalPedidos" name="noMostrar">&nbsp;
                        <label for="noMostrarModalPedidos">
                            <small>No mostrar mas</small>
                        </label>
                    </div>
        </div>
    </div>
<?php endif; ?>

 <div class="modal-bg display-none" id="modalWindow"></div>
    <div class="pedidos-cuenta-modal display-none animated showMeLeft" style="z-index: 1000000000000" id="nuevaCuentaPedidos">
        <div class="card shadow-custom">
            <div class="row">
                <div class="col-xs-9 px-4">
                    <h3 data-title-choice="principal">Cuenta Bancaria</h3>
                </div>
                <div class="col-xs-3 text-right">
                    <button class="clear-bussiness button-close-modal" set-color-text="principal" data-color-choice="principal" id="closeNuevaCuentaPedidos">
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
                                <button type="submit" data-color-choice="principal" set-color-text="principal" class="btn btn-primary btn-icon-circle clear-bussiness"><small><i class="ti-plus"></i>&nbsp;Agregar</small></button>
                            </div>
                        </div>
                    </div>
                </form>            
            </div>
        </div>
    </div> 