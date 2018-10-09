<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="title">Selecciona una cuenta</h5>
                        </div>
                    </div>
                        <form id="seleccionaCuenta">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="" id="cuentaId" class="form-control border-input">
                                        <?php foreach( $cuentas as $cuenta ): ?>
                                            <option value="<?= $cuenta['id']; ?>"><?= $cuenta['banco'] . " - " . $cuenta['alias']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select id="cuentaMes" class="form-control border-input">
                                            <option value="false">Selecciona un mes</option>
                                            <option value="01">Enero</option>
                                            <option value="02">Febrero</option>
                                            <option value="03">Marzo</option>
                                            <option value="04">Abril</option>
                                            <option value="05">Mayo</option>
                                            <option value="06">Junio</option>
                                            <option value="07">Julio</option>
                                            <option value="08">Agosto</option>
                                            <option value="09">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select id="cuentaAno" class="form-control border-input">
                                            <option value="false">Selecciona el año</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-block btn-primary" data-color-choice="principal" set-color-text="principal"><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="content">
                        <div class="table-responsive table-full-width">
                            <table class="table table-striped">
                                <thead>
                                    <th>Fecha</th>
                                	<th>Descripcion</th>
                                	<th>Monto variable</th>
                                	<th>Total</th>
                                </thead>
                                <?php if( $this->input->get('i') == FALSE ): ?>
                                <tbody id="avisoCuenta">    
                                    <td>
                                        <i class="ti-info-alt"></i>
                                        Selecciona una cuenta, el mes y el año para tu consulta
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tbody>
                                <?php endif; ?>
                                <tbody id="estadoBody">
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>