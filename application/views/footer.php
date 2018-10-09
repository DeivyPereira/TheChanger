</div>
<footer class="footer" style="border-top: none">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="javascript:void(0)">
                                Ir a la Página Principal
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, hecho por <a href="htpp://www.venetronic.com?utm_source=remesas&utm_medium=demo" target="_blank">Venetronic</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="<?= base_url() . 'assets/js/jquery-3.2.1.min.js'; ?>" type="text/javascript"></script>
	<script src="<?= base_url() . 'assets/js/bootstrap.min.js'; ?>" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="<?= base_url() . 'assets/js/bootstrap-checkbox-radio.js'; ?>"></script>

	<!--  Charts Plugin -->
	<script src="<?= base_url() . 'assets/js/chartist.min.js'; ?>"></script>

    <!--  Notifications Plugin    -->
    <script src="<?= base_url() . 'assets/js/bootstrap-notify.js'; ?>"></script>

    <!-- Solo para propósito de demostración -->
    <script src="<?= base_url() . 'assets/js/demo.js'; ?>"></script>

    <script src="<?= base_url() . 'assets/js/accounting.js'; ?>"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="<?= base_url() . 'assets/js/paper-dashboard.js'; ?>"></script>

    <script src="<?= base_url() . 'assets/js/jquery.form-validator.min.js'; ?>"></script>
    <script src="<?= base_url() . 'assets/js/file.js'; ?>"></script>

    <!-- Main js -->
    <script src="<?= base_url() . 'assets/js/main.js'; ?>"></script>
    
    <?php if( $msg == false ): echo $msg; endif; ?>

    <?php if( isset($_GET['msg']) ): ?>

        <?php if( $_GET['msg'] == 1 ): ?>

            <script type="text/javascript">$(document).ready(function(){$.notify({icon: "ti-check",message: "Proceso llevado a cabo exitosamente"},{type: "success",timer: 10000});});</script>

        <?php elseif( $_GET['msg'] == 2 ): ?> 

            <script type="text/javascript">$(document).ready(function(){$.notify({icon: "ti-info",message: "Ocurrió un error, por favor intente mas tarde"},{type: "warning",timer: 10000});});</script>

        <?php endif; ?>

    <?php endif; ?>

    <?php if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 || $_SESSION['role_cexpress'] == 3 ): ?>
        <script type="text/javascript">
            function actualizar(){location.reload(true);}
            //Función para actualizar cada 4 segundos(4000 milisegundos)
            setInterval("actualizar()",300000);
        </script>
    <?php endif; ?>

</html>

<?php if( isset($_GET['q']) && $_GET['q'] == "1" ): ?>

    <script type="text/javascript">
    	$(document).ready(function(){

        	$.notify({
            	icon: 'ti-comments-smiley',
            	message: "Bienvenido <?= $_SESSION['usuario_cexpress']; ?><br><i class='ti-bell'></i>&nbsp;Recuerda revisar si tienes notificaciones"

            },{
                type: 'success',
                timer: 4000
            });

    	});
	</script>

<?php endif; ?>
