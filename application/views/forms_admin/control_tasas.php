<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="title" style="display: inline">Selecciona un país y ajusta su tasa actual</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <img src="<?= base_url() . 'assets/img/loader.gif'; ?>" width="20" alt="Cargado..." class="display-none" id="loader">
                            </div>
                        </div>
                    </div>
                    <form action="" method="post" id="actualizarTasas">
                        <div class="content">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                <div class="form-group">
                                    <label>País</label>
                                        <select name="pais" class="form-control border-input" id="selectPais">
                                            <option value="false">Seleccione un pais</option>
                                            <?php foreach($paises as $pais): ?>
                                                <option value="<?= $pais['pais']; ?>"><?= $pais['pais']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-6">
                                    <div class="form-group">
                                        <label for="">Tasa del día</label>
                                        <input type="text" class="form-control border-input" name="tasa" id="Tasa">
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-6">
                                    <label>&nbsp;</label>
                                    <?php foreach( $paises as $pais ):  ?>
                                    <?php if( $pais['pais'] == "Venezuela" ): ?>
                                        <input type="text" disabled value="<?= $pais['diminutivo']; ?>" class="form-control border-input">
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group">
                                    <label for="">&nbsp;</label>
                                        <button class="btn btn-primary btn-icon  btn-block">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>