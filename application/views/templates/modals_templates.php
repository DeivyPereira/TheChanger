<?php if( $usuario->verificado == 0 && $_SESSION['role_cexpress'] == 4 && $titulo == "Tablero" ): ?>
    <div style="background: rgb(40,40,40,0.3); width: 100%; height: 100vh; position: fixed; top:0; left:0; z-index: 100" id="modalWindow"></div>
    <div class="modal-custom animated showMe modal-position" id="modalWindowContent" style="width: 30%">
        <div class="card shadow-custom">
            <div class="row">
                <div class="col-sm-6 px-4">
                    <h3 data-title-choice="principal">Atención</h3>
                </div>
                <div class="col-sm-6 text-right">
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

<?php if( $titulo == "Cuentas Bancarias" && $_SESSION['role_cexpress'] == 4 ): ?>
    <div style="background: rgb(40,40,40,0.3); width: 100%; height: 100vh; position: fixed; top:0; left:0; z-index: 100" id="modalWindow"></div>
    <div class="modal-custom animated showMe modal-position" id="modalWindowContent" style="width: 30%;">
        <div class="card shadow-custom">
            <div class="row">
                <div class="col-sm-6 px-4">
                    <h3 data-title-choice="principal">Atención</h3>
                </div>
                <div class="col-sm-6 text-right">
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
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if( $_SESSION['role_cexpress'] == 4 && $titulo == "Control de Pedidos" ): ?>
<div style="background: rgb(40,40,40,0.3); width: 100%; height: 100vh; position: fixed; top:0; left:0; z-index: 100" id="modalWindow"></div>
    <div class="modal-custom animated showMe modal-position" id="modalWindowContent" style="width: 60%">
        <div class="card shadow-custom">
            <div class="row">
                <div class="col-sm-6 px-4">
                    <h3 data-title-choice="principal">Instrucciones</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="clear-bussiness button-close-modal" set-color-text="principal" data-color-choice="principal" id="closeModalBtn">
                        <i class="ti-close"></i>
                    </button>
                </div>
            </div>
            <div class="content py-5">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <i class="ti-search" data-title-choice="principal" style="font-size: 50px;"></i>
                        <h5 data-title-choice="principal">Consulta nuestras cuentas</h5>
                        <small>Desde el <strong><i class="ti-dashboard"></i> tablero principal</strong> consulta <strong>nuestras cuentas bancarias</strong>.</small>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="ti-pencil" data-title-choice="principal" style="font-size: 50px;"></i>
                        <h5 data-title-choice="principal">Registra tu(s) cuenta(s)</h5>
                        <small>Debes tener al menos <strong>una <i class="ti-marker-alt"></i> cuenta registrada en nuestro sistema</strong> para poder realizar tu pedido.
                        </small>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="ti-clipboard" data-title-choice="principal" style="font-size: 50px;"></i>
                        <h5 data-title-choice="principal">Completa el formulario</h5>
                        <small><strong>Una vez realices el pago</strong> completa el formulario que se te presenta.<br><strong><?php echo nombreweb;  ?> te permite fraccionar tu pago entre 5 cuentas distintas.</strong></small>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="ti-rocket"  data-title-choice="principal" style="font-size: 50px;"></i>
                        <h5 data-title-choice="principal">¡Es el momento! Procesa tu pedido</h5>
                        <small>Una vez completado el formulario, procesa tu pedido y espera a que el dinero sea abonado a tu(s) cuenta(s).</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>