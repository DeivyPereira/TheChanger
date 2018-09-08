<div class="content animated fadeIn">
    <div class="container-fluid">
        <?php if( $_SESSION['role_cexpress'] != 3 ): ?>
        <div class="row">
            <?php if( $_SESSION['role_cexpress'] == 4 ): ?>
                <div class="col-md-4">
                    <div class="card-custom">
                        <div class="row shadow-custom" style="border-radius: 25px 5px 25px 5px">
                            <div class="col-xs-4 text-center purple-cexpress" style="border-top-left-radius: 25px; border-bottom-left-radius: 5px;">
                                <p class="text-clear">
                                    <i class="ti-money"></i>
                                </p>
                            </div>
                            <div class="col-xs-8 text-center bg-lighter" style="position: relative; border-top-right-radius: 5px; border-bottom-right-radius: 25px;">
                                <small class="text-dark" style="position:absolute; top: 10%; left: 5%;">1 USD $ equivale a</small>
                                <p class="text-dark">
                                    <?php foreach( $tax as $tasa ): ?>
                                        <?php if( $tasa['pais'] == "Estados Unidos" ): ?>
                                            <?= number_format( $tasa['tasa'], 2 ) . " " . $tasa['moneda']; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <a href="<?= base_url() . 'cuentas_bancarias'; ?>"><div class="col-md-4 hoverable">
                <div class="card-custom">
                    <div class="row shadow-custom" style="border-radius: 25px 5px 25px 5px">
                        <div class="col-xs-4 text-center purple-cexpress" style="position: relative; border-top-left-radius: 25px; border-bottom-left-radius: 5px;">
                            <p class="text-clear">
                                <i class="ti-marker-alt"></i>
                            </p>
                        </div>
                        <div class="col-xs-8 text-center bg-lighter" style="border-top-right-radius: 5px; border-bottom-right-radius: 25px;">    
                            <p class="text-dark">
                                Registra tus cuentas
                            </p>
                        </div>
                    </div>
                </div>
            </div></a>
            <a href="<?= base_url() . 'control_pedidos'; ?>"><div class="col-md-4 hoverable">
                <div class="card-custom">
                    <div class="row shadow-custom" style="border-radius: 25px 5px 25px 5px">
                        <div class="col-xs-4 text-center purple-cexpress" style="border-top-left-radius: 25px; border-bottom-left-radius: 5px;">
                            <p class="text-clear">
                                <i class="ti-check-box"></i>
                            </p>
                        </div>
                        <div class="col-xs-8 text-dark bg-lighter text-center" style="border-top-right-radius: 5px; border-bottom-right-radius: 25px;">
                            <p class="text-dark">
                                Haz tu pedido ya
                            </p>
                        </div>
                    </div>
                </div>
            </div></a>
            <?php endif; ?>

            <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ): ?>
            <div class="col-md-3">
                <div class="card-custom">
                    <div class="row shadow-custom" style="border-radius: 25px 5px 25px 5px">
                        <div class="col-xs-4 text-center purple-cexpress" style="border-top-left-radius: 25px; border-bottom-left-radius: 5px;">
                            <p class="text-clear">
                                <i class="ti-money"></i>
                            </p>
                        </div>
                        <div class="col-xs-8 text-center bg-lighter" style="position: relative; border-top-right-radius: 5px; border-bottom-right-radius: 25px;">
                            <small class="text-dark" style="position:absolute; top: 10%; left: 5%;">1 USD $ equivale a</small>
                            <p class="text-dark">
                                <?php foreach( $tax as $tasa ): ?>
                                    <?php if( $tasa['pais'] == "Estados Unidos" ): ?>
                                        <?= number_format( $tasa['tasa'], 2 ) . " " . $tasa['moneda']; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url() . 'cuentas_bancarias_admin'; ?>"><div class="col-md-3 hoverable">
                <div class="card-custom">
                    <div class="row shadow-custom" style="border-radius: 25px 5px 25px 5px">
                        <div class="col-xs-4 text-center purple-cexpress" style="position: relative; border-top-left-radius: 25px; border-bottom-left-radius: 5px;">
                            <p class="text-clear">
                                <i class="ti-marker-alt"></i>
                            </p>
                        </div>
                        <div class="col-xs-8 text-center bg-lighter" style="border-top-right-radius: 5px; border-bottom-right-radius: 25px;">    
                            <p class="text-dark">
                                Registra tus cuentas
                            </p>
                        </div>
                    </div>
                </div>
            </div></a>
            <a href="<?= base_url() . 'control_pedidos_admin'; ?>"><div class="col-md-3 hoverable">
                <div class="card-custom">
                    <div class="row shadow-custom" style="border-radius: 25px 5px 25px 5px">
                        <div class="col-xs-4 text-center purple-cexpress" style="border-top-left-radius: 25px; border-bottom-left-radius: 5px;">
                            <p class="text-clear">
                                <i class="ti-check-box"></i>
                            </p>
                        </div>
                        <div class="col-xs-8 text-dark bg-lighter text-center" style="border-top-right-radius: 5px; border-bottom-right-radius: 25px;">
                            <p class="text-dark">
                                Gestiona los pedidos
                            </p>
                        </div>
                    </div>
                </div>
            </div></a>
            <a href="<?= base_url() . 'estados_cuentas'; ?>"><div class="col-md-3 hoverable">
                <div class="card-custom">
                    <div class="row shadow-custom" style="border-radius: 25px 5px 25px 5px">
                        <div class="col-xs-4 text-center purple-cexpress" style="border-top-left-radius: 25px; border-bottom-left-radius: 5px;">
                            <p class="text-clear">
                                <i class="ti-wallet"></i>
                            </p>
                        </div>
                        <div class="col-xs-8 bg-lighter text-center text-dark" style="border-top-right-radius: 5px; border-bottom-right-radius: 25px;">
                            <p class="text-dark">
                                Verifica tus cuentas
                            </p>
                        </div>
                    </div>
                </div>
            </div></a>
            <?php endif; ?>
        </div>
        
        <div class="row mt-2">
            
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-custom">
                            <div class="rounded-top">
                                <div class="header">
                                    <h4 class="title">Bienvenido a Cexpress</h4>
                                </div>
                                <hr class="my-2">
                                <div class="content">
                                    <p>Somos agente cambiario seguro.</p>
                                    <p>Le recordamos que para transferir dinero debe suministrarnos toda la información correcta, a fin de facilitar el procedimiento de verificación y ejecución de pagos</p>
                                    <p>Toda su información está protegida y es de carácter confidencial</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-custom">
                            <div class="header">
                                <h4 class="title">Consulte nuestras tasas hoy</h4>
                            </div>
                            <hr class="my-2">
                            <div class="header">
                                <select id="selectPaisTax" class="custom-input">
                                    <option value="false">Seleccione un país</option>
                                    <?php foreach( $paises as $pais ): ?>
                                        <?php if( $pais['pais'] != "Venezuela" ): ?>
                                            <option value="<?= $pais['pais']; ?>"><?= $pais['pais']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="content" id="tasaPaisConsulta">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-custom">
                            <div class="content">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="text-center bg-info"><i class="ti-info-alt"></i>&nbsp;Atención</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            Las transferencias serán procesadas de acuerdo al volumen de solicitudes, el cual no será mayor a 2 horas si todo lo que nos suministro esta correcto.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Las transferencias enviadas a Banesco serán acreditadas el mismo día dependiendo siempre de la operatividad del Banco.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Las transferencias enviadas a otros Bancos diferentes a Banesco, serán acreditadas al siguiente día hábil, después de las 2 pm o incluso en muchos casos a las 6 pm. Sea paciente.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Le recordamos que este es un servicio privado y confidencial si usted disfruta del mismo es porque ha sido un cliente confiable, sigamos así.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +1 317 5720559
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                            <strong>CEO Maybet Ordonez</strong>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-custom" >
                            <div class="header">
                                <h4 class="title">Calculadora rápida</h4>
                            </div>
                            <hr class="my-2">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <small>País de origen</small>
                                            <select id="dashCalcPaisOr" class="custom-input">
                                                <option value="false"></option>
                                                <?php foreach( $paises as $pais ): ?>
                                                <?php if( $pais['pais'] != "Venezuela" ): ?>
                                                    <option value="<?= $pais['pais']; ?>"><?= $pais['pais']; ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <small>¿Cuánto deseas envíar? <span class="text-danger">Decimales con "."</span></small>
                                            <input type="text" class="custom-input" id="montoReceptor">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <small>&nbsp;</small>
                                            <input type="text" disabled class="custom-input" id="diminutivoReceptor">
                                    </div>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <small>Recibirás en tu cuenta de Venezuela</small>
                                            <input type="text" class="custom-input" disabled id="montoBeneficiario">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <small>&nbsp;</small>
                                        <input type="text" disabled class="custom-input" disabled id="diminutivoBeneficiario">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-custom">
                            <div class="rounded-top">
                                <div class="header">
                                    <h4 class="title">Consulte nuestras cuentas bancarias</h4>
                                </div>
                                <hr class="my-2">
                                <div class="header">
                                    <select class="custom-input" id="paisCuentas">
                                        <option value="false">¿Désde qué país desea enviar su remesa?</option>
                                        <?php foreach( $paises as $pais ): ?>
                                            <?php if( $pais['pais'] != "Venezuela"): ?>
                                                <option value="<?= $pais['pais']; ?>"><?= $pais['pais']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="content mt-2" id="cuentasPaisList">
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php else: ?>
                <div class="row">
                    <a href="<?= base_url() . 'control_pedidos_admin'; ?>">
                        <div class="col-md-4 hoverable">
                            <div class="card-custom">
                                <div class="row shadow-custom" style="border-radius: 25px 5px 25px 5px">
                                    <div class="col-xs-4 text-center purple-cexpress" style="border-top-left-radius: 25px; border-bottom-left-radius: 5px;">
                                        <p class="text-clear">
                                            <i class="ti-check-box"></i>
                                        </p>
                                    </div>
                                    <div class="col-xs-8 text-dark bg-lighter text-center" style="border-top-right-radius: 5px; border-bottom-right-radius: 25px;">
                                        <p class="text-dark">
                                            Gestiona los pedidos
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="<?= base_url() . 'control_pedidos_admin'; ?>">
                        <div class="col-md-4 hoverable">
                            <div class="card-custom">
                                <div class="row shadow-custom" style="border-radius: 25px 5px 25px 5px">
                                    <div class="col-xs-4 text-center purple-cexpress" style="border-top-left-radius: 25px; border-bottom-left-radius: 5px;">
                                        <p class="text-clear">
                                            <i class="ti-user"></i>
                                        </p>
                                    </div>
                                    <div class="col-xs-8 text-dark bg-lighter text-center" style="border-top-right-radius: 5px; border-bottom-right-radius: 25px;">
                                        <p class="text-dark">
                                            Modifica tu perfil
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="<?= base_url() . 'control_pedidos_admin'; ?>">
                        <div class="col-md-4 hoverable">
                            <div class="card-custom">
                                <div class="row shadow-custom" style="border-radius: 25px 5px 25px 5px">
                                    <div class="col-xs-4 text-center purple-cexpress" style="border-top-left-radius: 25px; border-bottom-left-radius: 5px;">
                                        <p class="text-clear">
                                            <i class="ti-close"></i>
                                        </p>
                                    </div>
                                    <div class="col-xs-8 text-dark bg-lighter text-center" style="border-top-right-radius: 5px; border-bottom-right-radius: 25px;">
                                        <p class="text-dark">
                                            Cerrar Sesión
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Últimos pedidos recibidos</h4>
                            </div>    
                            <div class="content">
                            <?php if( $pedidos != FALSE): ?>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th class="text-center">ID</th>
                                    	<th class="text-center">Nombre</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Banco Receptor</th>
                                        <th class="text-center">Monto Pagado</th>
                                        <th class="text-center">Monto Beneficiario</th>
                                        <th></th>
                                    </thead>
                                        <tbody>
                                        <?php foreach( $pedidos as $pedido ): ?>
                                        <tr class="text-center">
                                        	<td><?= $pedido['id']; ?></td>
                                        	<td>
                                                <?php foreach( $usuarios as $usuario ): ?>
                                                <?php if( $pedido['id_cliente'] == $usuario['id'] ): ?>
                                                    <?= $usuario['nombre'] . " " . $usuario['apellido']?>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                        	<td><?= $pedido['fecha_pedido']; ?></td>
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
                                                <?php elseif( $pedido['status'] == 2 ): ?>
                                                    <span class="text-danger">
                                                        <i class="ti-info-check"></i>
                                                        Rechazado
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small><?= $pedido['pais_receptor']; ?></small><br>
                                                <?php foreach( $bancos_admin as $banco ): ?>
                                                <?php if( $pedido['banco_receptor'] == $banco['id'] ): ?>
                                                    <?= $banco['banco']; ?>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <?= number_format( $pedido['monto_pagado'], 2 ); ?>
                                                <?php foreach( $bancos_admin as $banco ): ?>
                                                <?php if( $pedido['banco_receptor'] == $banco['id'] ): ?>
                                                    <?= $banco['diminutivo']; ?>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <?= number_format( $pedido['monto_beneficiario'], 2 ); ?>
                                                <?php foreach( $bancos_usuarios as $banco ): ?>
                                                <?php if( $pedido['banco_beneficiario'] == $banco['id'] ): ?>
                                                    <?= $banco['diminutivo']; ?>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url() . 'ver_pedido?i=' . $pedido['id']; ?>" class="btn btn-sm btn-primary">
                                                    <i class="ti-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                </table>
                            </div>
                            <div class="text-right">
                                <a href="<?= base_url() . 'control_pedidos_admin'; ?>" class="btn btn-sm btn-primary">Ver todos los pedidos</a>
                            </div>
                            <?php else: ?>
                                <div class="text-center">
                                    <h3 class="text-warning"><i class="ti-info-alt"></i> No hay pedidos pendientes</h3>
                                </div>            
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>