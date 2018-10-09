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
                                    <label>
                                        <small>Tipo de cuenta</small>
                                    </label>
                                    <input type="text" class="custom-input" value="<?= $cuenta['tipo']; ?>" name="tipo">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        <small>C.I.</small>
                                    </label>
                                    <input type="text" class="custom-input" value="<?= $cuenta['documento']; ?>" name="dni">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
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
                                    <button type="submit" class="btn btn-primary btn-icon-circle" style="border:0;" data-color-choice="principal" set-color-text="principal"><small>Actualizar</small></button>
                                    <a href="<?= base_url() . 'status_cuenta?i=' . $cuenta['id'] . '&a=' . $cuenta['status']; ?>" class="btn btn-primary btn-icon-circle" data-color-choice="principal" set-color-text="principal" style="border: 0;"><i class="ti-close"></i></a>
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
                        <button class="btn btn-primary" set-color-text="principal" data-color-choice="principal" style="border: 0; border-radius: 50px" id="agregarCuentaBtn"><i class="ti-plus" style="font-size: 45px"></i></button>
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
                        <input type="hidden" name="pais" value="Venezuela">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        <small>Alias</small>
                                    </label>
                                    <input type="text" class="custom-input" name="alias" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#alias">
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
                                    <input type="text" class="custom-input" name="cuenta" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#cuenta">
                                    <small class="text-danger" id="cuenta"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <small>Titular</small>
                                    </label>
                                    <input type="text" class="custom-input" name="titular" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#titular">
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
                                    <input type="text" class="custom-input" name="tipo" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#tipo">
                                    <small class="text-danger" id="tipo"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">
                                        <small>C.I.</small>
                                    </label><br>
                                    <select name="tipo_documento" class="custom-input" id="tipoCi" style="width:30%; float:left">
                                        <option value="false"></option>
                                        <option value="E-">E</option>
                                        <option value="V-">V</option>
                                        <option value="P-">P</option>
                                        <option value="G-">G</option>
                                        <option value="J-">J</option>
                                    <select>
                                    <input type="text" class="custom-input" name="dni" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#dni" style="width: 70%; float: left">
                                    <small class="text-danger" id="dni"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">
                                        <small>Teléfono</small>
                                    </label>
                                    <input type="text" class="custom-input" name="telefono" data-validation="required" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Campo Requerido" data-validation-error-msg-container="#telefono">
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
                                    <input type="text" class="custom-input" name="email" data-validation="email" data-validation-error-msg="<i class='ti-info-alt'></i>&nbsp;Formato de Correo Inválido" data-validation-error-msg-container="#email">
                                    <small class="text-danger" id="email"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <small>Selecciona un Banco</small>
                                    </label>
                                    <select name="banco" id="bancoSeleccion" class="custom-input">
                                        <option value="false"></option>
                                        <?php foreach( $cuentas_lista as $cuentas ): ?>
                                            <option value="<?= $cuentas['id']; ?>"><?= $cuentas['banco']; ?></option>
                                        <?php endforeach; ?>
                                        <option value="Otros">Otro Banco</option>
                                    </select>
                                    <small class="text-danger" id="bancoErr"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 display-none" id="bancoAlt">
                                <div class="form-group">
                                    <label>
                                        <small>Otro Banco</small>
                                    </label>
                                    <input type="text" class="custom-input" name="banco_alt" id="banco_alt">
                                    <small class="text-danger" id="banco_altErr"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="form-group text-right">
                                    <br>
                                    <button type="submit" data-color-choice="principal" set-color-text="principal" class="btn btn-primary btn-icon-circle" style="border: 0;"><small><i class="ti-plus"></i>&nbsp;Agregar</small></button>
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

