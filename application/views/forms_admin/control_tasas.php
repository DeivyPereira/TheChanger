<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="title" style="display: inline">Ajusta las tasas del día</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <img src="<?= base_url() . 'assets/img/loader.gif'; ?>" width="20" alt="Cargado..." class="display-none" id="loader">
                            </div>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><small>País</small></th>
                                <th><small>Moneda</small></th>
                                <th><small>Tasa del día <small class="text-danger">Decimales separados con "."</small></small></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach( $paises as $pais ): ?>
                                <?php if( $pais['pais'] != "Venezuela" ): ?>
                                    <tr>
                                        <td><?= $pais['pais']; ?></td>
                                        <td>1 <?= $pais['diminutivo']; ?> = </td>
                                        <td>
                                            <form id="actualizarTasasForm">
                                            <input type="hidden" value="<?= $pais['pais']; ?>" name="pais">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <?php foreach( $tasas as $tasa ): ?>
                                                        <?php if( $pais['pais'] == $tasa['pais'] ): ?>
                                                            <input type="text" value="<?= $tasa['tasa']; ?>" class="form-control border-input" name="tasa">
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php foreach( $tasas as $tasa ): ?>
                                                        <?php if( $tasa['pais'] == "Venezuela" ): ?>
                                                            <input type="text" class="form-control border-input" disabled value="<?= $tasa['moneda']; ?>">
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="content text-right">
                        <button type="button" class="btn btn-primary btn-icon" data-color-choice="principal" set-color-text="principal" id="actualizarTasas">Actualizar Tasas</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>