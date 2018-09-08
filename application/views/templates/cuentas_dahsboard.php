    <?php $cuentaNum = 1; ?>
    <?php foreach( $admin_banco as $cuenta ): ?>
        <?php if( $cuenta['pais'] != "Venezuela" ): ?>
            <div class="row py-1 border-top">
                <div class="col-md-12">
                    <div class="row position-relative">
                        <div style="position: absolute; top: -20%; right: 10%; background: #FFF; padding: 5px 10px;; box-shadow: 0 -3px 5px lightgrey; border-radius: 50px;">
                            <?php 
                                echo $cuentaNum;
                                $cuentaNum++;
                            ?>
                        </div>
                        <div class="col-xs-6 my-1">
                            <label>
                                <small>País</small>
                            </label>
                            <span class="after-label"><?= $cuenta['pais']; ?></span>
                        </div>
                        <div class="col-xs-6 my-1">
                            <label>
                                <small>Banco</small>
                            </label>
                            <span class="after-label"><?= $cuenta['banco']; ?></span>
                        </div>
                        <div class="col-xs-12 col-sm-6 my-1">
                            <label>
                                <small>Cuenta</small>
                            </label>
                            <span class="after-label"><?= $cuenta['cuenta']; ?></span>
                        </div>
                        <div class="col-xs-6 my-1">
                            <label>
                                <small>Tipo de cuenta</small>
                            </label>
                            <span class="after-label"><?= $cuenta['tipo']; ?></span>
                        </div>
                        <div class="col-xs-6 my-1">
                            <label>
                                <small>Titular</small>
                            </label>
                            <span class="after-label"><?= $cuenta['titular']; ?></span>
                        </div>
                        <div class="col-xs-12 col-sm-6 my-1">
                            <label>
                                <small>Email</small>
                            </label>
                            <span class="after-label"><?= $cuenta['email']; ?></span>
                        </div>
                    </div>
                </div>
            </div>    
        <?php endif; ?>
    <?php endforeach; ?>