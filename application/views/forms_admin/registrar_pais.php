<div class="content animated fadeIn">
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class="text-center">
                            <button class="btn btn-primary active" id="paisesBtn">Paises</button>
                            <button class="btn btn-primary" id="bancosBtn">Bancos</button>
                        </div>
                    </div>
                    <div class="content" id="registrarPaisForm">
                        <h4 class="title">Registra un nuevo país</h4>
                        <p class="category">Rellena el siguiente formulario</p>
                        <form action="<?= base_url() . 'registrar_pais'; ?>" method="post">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Nombre del País</label>
                                        <input type="text" class="custom-input" name="nombre">
                                        <?= form_error('nombre'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Moneda local</label>
                                        <input type="text" class="custom-input" name="moneda">
                                        <?= form_error('moneda'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Diminutivo</label>
                                        <input type="text" class="custom-input" name="diminutivo">
                                        <?= form_error('diminutivo'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tantos bancos separados por una coma ","</label>
                                        <input type="text" class="custom-input" name="bancos">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary btn-wd" id="ActLoader">Generar Nuevo País</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="content display-none" id="registrarBancoForm">
                        <form action="<?= base_url() . 'registar_nuevos_bancos'; ?>" method="post" id="registrarBanco">
                            <h4 class="title">Registra Bancos por país</h4>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label>Selecciona el país</label>
                                    <select name="paisbanco" id="paisBanco" class="custom-input">
                                        <option value="false"></option>
                                        <?php foreach( $paises as $pais ): ?>
                                            <option value="<?= $pais['pais']; ?>"><?= $pais['pais']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger" id="paisBancoErr"></small>
                                </div>
                                <div class="col-md-8">
                                    <label>Tantos bancos separados por una coma ","</label>
                                    <input type="text" class="custom-input" data-validation="required" data-validation-error-msg="Campo requerido" data-validation-error-msg-container="#nuevosBancosErr" name="nuevosbancos">
                                    <small class="text-danger" id="nuevosBancosErr"></small>
                                </div>
                            </div>
                            <div class="row text-right">
                                <div class="col-md-12 mt-2">
                                    <button type="submit" class="btn btn-primary btn-wd">Registrar Bancos</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row" style="position: relative">
            <div class="col-md-12">
                <div class="card">
                    <div class="content table-responsive table-full-width" id="paises">
                        <div class="header text-center">
                            <h4 class="title">Países Registrados</h4>
                            <p class="category">Listado de países ya registrados</p>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <th class="text-center">País</th>
                                <th class="text-center">Moneda</th>
                                <th class="text-center">Diminutivo</th>
                                <th class="text-center">Creado en</th>
                                <th class="text-center">Modificado en</th>
                                <th class="text-center">Status</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php foreach( $paises as $pais ): ?>
                                <tr class="text-center">
                                    <form action="<?= base_url('update_pais'); ?>" method="post" class="padding:0; margin:0; display: inline">
                                    <input type="hidden" value="<?= $pais['id']; ?>" name="id">
                                    <input type="hidden" value="<?= $pais['pais']; ?>" name="nombre">
                                    <td><input type="text" value="<?= $pais['pais']; ?>" class="custom-input" disabled></td>
                                    <td><input type="text" value="<?= $pais['moneda']; ?>" name="moneda" class="custom-input"></td>
                                    <td><input type="text" value="<?= $pais['diminutivo']; ?>" name="diminutivo" class="custom-input"></td>
                                    <td><?= $pais['created']; ?></td>
                                    <td><?php if( empty($pais['modified']) ): echo "N/A"; else: echo $pais['modified']; endif; ?></td>
                                    <td>
                                        <?php if( $pais['status'] == 1 ): ?>
                                            <a href="<?= base_url() . 'pais_status?i=' . $pais['id'] . '&a=' . $pais['status']; ?>" class="btn btn-sm btn-success btn-fill">Activo</a>
                                        <?php else: ?>
                                            <a href="<?= base_url() . 'pais_status?i=' . $pais['id'] . '&a=' . $pais['status']; ?>" class="btn btn-sm btn-danger btn-fill">Inactivo</a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="submit" class="btn btn-sm btn-info btn-fill"><i class="ti-pencil-alt"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url() . 'delete_pais?id=' . $pais['id']; ?>" class="btn btn-sm btn-info btn-fill"><i class="ti-trash"></i></a>
                                    </td>    
                                    </form>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="content table-responsive table-full-width display-none" id="bancos">
                        <div class="header text-center">
                            <h4 class="title">Bancos Registrados</h4>
                            <p class="category">Listado de bancos por país</p>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <th class="text-center">País</th>
                                <th class="text-center">Banco</th>
                                <th class="text-center">Status</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php foreach( $bancos as $banco ): ?>
                                <tr class="text-center">
                                    <form action="<?= base_url('update_banco'); ?>" method="post" class="padding:0; margin:0; display: inline">
                                    <input type="hidden" value="<?= $banco['id']; ?>" name="id">
                                    <td><?= $banco['pais']; ?></td>
                                    <td><input type="text" value="<?= $banco['banco']; ?>" name="banco" class="custom-input"></td>
                                    <td class="text-center">
                                        <?php if( $banco['status'] == 1 ): ?>
                                        <a href="<?= base_url() . 'banco_status?id=' . $banco['id'] . '&a=' . $banco['status']; ?>" class="btn btn-sm btn-fill btn-success">Activo</a>
                                        <?php else: ?>
                                        <a href="<?= base_url() . 'banco_status?id=' . $banco['id'] . '&a=' . $banco['status']; ?>" class="btn btn-sm btn-fill btn-danger">Inactivo</a>
                                        <?php endif; ?>
                                    </td>    
                                    <td class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-sm"><i class="ti-pencil-alt"></i></button>
                                    </td>
                                    <td>
                                        <a href="<?= base_url() . 'delete_banco?i=' . $banco['id']; ?>" class="btn btn-sm btn-info btn-fill"><i class="ti-trash"></i></a>
                                    </td>
                                    </form>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
