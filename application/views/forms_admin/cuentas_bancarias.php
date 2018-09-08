<div class="content animated fadeIn" style="padding-top: 0;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px">
                <h4 style="margin-bottom:0">Registra tus cuentas bancarias</h4>
                <small>Agiliza tus pedidos y registra tus cuentas bancarias</small>
            </div>
            <?php if( $cuentas != FALSE ): foreach( $cuentas as $cuenta ): ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title"><?= $cuenta['alias']; ?></h4>
                    </div>
                    <div class="content">
                        <form action="<?= base_url() . 'actualizar_cuenta'; ?>" method="post">
                        <input type="hidden" name="id" value="<?= $cuenta['id']; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <small>Cuenta</small>
                                    </label>
                                    <input type="text" class="custom-input" value="<?= $cuenta['cuenta']; ?>" name="cuenta">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <small>Titular</small>
                                    </label>
                                    <input type="text" class="custom-input" value="<?= $cuenta['titular'] ?>" name="titular">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">
                                        <small>Tipo de cuenta</small>
                                    </label>
                                    <input type="text" class="custom-input" value="<?= $cuenta['tipo']; ?>" name="tipo">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">
                                        <small>C.I.</small>
                                    </label>
                                    <input type="text" class="custom-input" value="<?= $cuenta['documento']; ?>" name="dni">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">
                                        <small>Teléfono</small>
                                    </label>
                                    <input type="text" class="custom-input" value="<?= $cuenta['telefono']; ?>" name="telefono">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <small>Email</small>
                                    </label>
                                    <input type="text" class="custom-input" value="<?= $cuenta['email']; ?>" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <small>Banco</small>
                                    </label>
                                    <p><?= $cuenta['banco']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="form-group text-right">
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-icon-circle"><small>Actualizar</small></button>
                                    <a href="<?= base_url() . 'status_cuenta?i=' . $cuenta['id'] . '&a=' . $cuenta['status']; ?>" class="btn btn-primary btn-icon-circle"><i class="ti-close"></i></a>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>

        
            <div class="col-md-6">
                <div class="card">
                    <div class="content text-center" id="agregarCuenta">
                        <button class="btn btn-primary" style="border-radius: 50px;" id="agregarCuentaBtn"><i class="ti-plus" style="font-size: 45px"></i></button>
                        <p style="margin: 10px 0;">Agregar Cuenta</p>
                    </div>
                    <div class="content display-none" id="agregarCuentaForm">
                    <div class="loader display-none" id="loader">
                        <div class="loader-img">
                            <img src="<?= base_url() . 'assets/img/loader.gif'; ?>" alt="Procesando, por favor espere...">
                        </div>
                    </div>
                    <form action="<?= base_url() . 'registrar_cuenta'; ?>" id="agregarCuentaNueva" method="post">
                        <input type="hidden" name="id" value="<?= $_SESSION['id_cexpress']; ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        <small>Alias</small>
                                    </label>
                                    <input type="text" class="custom-input" name="alias" data-validation="required" data-validation-error-msg="Campo Requerido" data-validation-error-msg-container="#alias">
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
                                    <input type="text" class="custom-input" name="cuenta" data-validation="number" data-validation-error-msg="Solo números" data-validation-error-msg-container="#cuenta">
                                    <small class="text-danger" id="cuenta"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <small>Titular</small>
                                    </label>
                                    <input type="text" class="custom-input" name="titular" data-validation="required" data-validation-error-msg="Solo números" data-validation-error-msg-container="#titular">
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
                                    <input type="text" class="custom-input" name="tipo" data-validation="required" data-validation-error-msg="Solo números" data-validation-error-msg-container="#tipo">
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
                                    <input type="text" class="custom-input" name="dni" data-validation="required" data-validation-error-msg="Solo números" data-validation-error-msg-container="#dni" style="width: 70%; float: left">
                                    <small class="text-danger" id="dni"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">
                                        <small>Teléfono</small>
                                    </label>
                                    <input type="text" class="custom-input" name="telefono" data-validation="required" data-validation-error-msg="Solo números" data-validation-error-msg-container="#telefono">
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
                                    <input type="text" class="custom-input" name="email" data-validation="required" data-validation-error-msg="Formato de Correo Inválido" data-validation-error-msg-container="#email">
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        <small>Banco</small>
                                    </label>
                                    <select name="banco" id="bancoSeleccionCrear" class="custom-input">
                                        <option value="false">Selecciona un banco</option>
                                    </select>
                                    <small class="text-danger" id="bancoErr"></small>
                                </div>
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
        </div>
    </div>
</div>

<div class="modal-custom" id="modalWindow" style="width: 30%; left: 60%; top: 50%; transform: translate(-60%,-50%);">
        <div class="card shadow-custom" style="background-image: url('<?= base_url() . 'assets/img/back.png'; ?>'); background-repeat: no-repeat; background-position: 0px 70px;">
            <div class="row">
                <div class="col-sm-6 px-4">
                    <h3 class="text-purple">Atención</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="purple-cexpress button-close-modal" id="closeModalBtn">
                        <i class="ti-close"></i>
                    </button>
                </div>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <i class="ti-info-alt text-purple" style="font-size: 50px;"></i>
                        <h4 class="title">Importante</h4>
                        <small>Luego de haber ingresado los datos de la cuenta bancaria, verifica que los mismos sean correctos.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>