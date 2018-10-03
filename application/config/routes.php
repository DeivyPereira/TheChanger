<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'acceso';

// Acceso Controller Routes

$route['login'] = 'acceso/login'; // Vista y Formulario de login
$route['suscripcion'] = 'acceso/suscripcion'; // Vista y formulario de suscripción
$route['asistente_password'] = 'acceso/asistente_pass'; // Vista y formulario de recuperación de contraseña "Email"
$route['reset_pass'] = 'acceso/reset_pass'; // Vista y formulario para resetear la contraseña "Llama al método set_new_pass"
$route['set_new_pass'] = 'acceso/set_new_pass'; // Controlador para cambiar la contraseña y redirigir es llamado por el método "reset_pass"

// Admin Controller Routes

$route['dashboard'] = 'admin/dashboard'; // Vista del Dashboard
$route['registrar_pais'] = 'admin/registrar_pais'; // Vista y Formulario para registrar un nuevo país
$route['registar_nuevos_bancos'] = 'crud_controller/registar_nuevos_bancos'; // Para registrar nuevos bancos en un país
$route['eliminar_cuenta_admin'] = 'crud_controller/eliminar_cuenta_admin'; // Para eliminar una cuenta bancaria

$route['control_tasas'] = 'admin/control_tasas'; // Vista y formulario para control de tasas y comisiones
$route['control_pedidos'] = 'admin/control_pedidos'; // Vista para administrar el control de pedidos
$route['control_pedidos_admin'] = 'admin/control_pedidos_admin';
$route['estados_cuentas'] = 'admin/estados_cuentas';
$route['ver_pedido'] = 'admin/ver_pedido'; // Ver pedido Admin
$route['pedido'] = 'admin/pedido'; // Ver pedido cliente

$route['control_usuarios'] = 'admin/control_usuarios'; // Vista para administrar a los usuarios registrados
$route['control_usuarios/(:num)'] = 'admin/control_usuarios'; // Vista para administrar a los usuarios paginación

$route['cuentas_bancarias'] = 'admin/cuentas_bancarias'; // Vista y lógica para controlar las cuentas bancarias
$route['cuentas_bancarias_admin'] = 'admin/cuentas_bancarias_admin';
$route['perfil'] = 'admin/perfil'; // Vista para administrar el perfil de cada usuario

$route['buscar_usuario'] = 'admin/buscar_usuario'; // Plantilla de búsqueda de usuario

$route['exito_pedido'] = 'admin/exito_pedido';
$route['error_pedido'] = 'admin/error_pedido';

$route['buscar_pedido'] = 'admin/buscar_pedido';
$route['archivo_pedidos'] = 'admin/archivo_pedidos';

$route['estados_template'] = 'admin/estados_template';

$route['usuario'] = 'admin/show_usuario'; // Vista del Usuario
$route['logout'] = 'admin/logout'; // Cerrar Sesión

// Admin Crud Acciones

$route['delete_pais'] = 'crud_controller/delete_pais'; // Método que borra un país
$route['update_pais'] = 'crud_controller/update_pais'; // Método que actualiza un país
$route['pais_status'] = 'crud_controller/pais_status';
$route['update_banco'] = 'crud_controller/update_banco';
$route['banco_status'] = 'crud_controller/banco_status';
$route['buscar_banco_admin_pais'] = 'crud_controller/buscar_banco_admin_pais';
$route['buscar_banco_cliente'] = 'crud_controller/buscar_banco_cliente';
$route['delete_banco'] = 'crud_controller/delete_banco';
$route['archivar_pedido'] = 'crud_controller/archivar_pedido';
$route['verificar'] = 'crud_controller/verificar';
$route['verificacion'] = 'crud_controller/verificacion';
$route['rechazar_verificacion'] = 'crud_controller/rechazar_verificacion';

$route['addBanco'] = 'crud_controller/addBanco';
$route['get_usuarios_cuenta'] = 'crud_controller/get_usuarios_cuenta';

$route['actualizar_pedido'] = 'crud_controller/actualizar_pedido';

$route['buscar_banco_pais'] = 'crud_controller/buscar_banco_pais';

$route['update_role'] = 'crud_controller/update_role'; // Actualizar Rol
$route['update_role_search'] = 'crud_controller/update_role_search'; // Actualizar rol de usuario redirect search
$route['update_role_show'] = 'crud_controller/update_role_show'; // Actualizar rol de usuario redirect show_usuario
$route['update_role_perfil'] = 'crud_controller/update_role_perfil'; // Actualizar rol de usuario redirect show_perfil
$route['consulta_tasa'] = 'crud_controller/consulta_tasa';
$route['actualizar_tasa'] = 'crud_controller/actualizar_tasa';
$route['registrar_cuenta_admin'] = 'crud_controller/registrar_cuenta_admin';
$route['actualizar_cuenta_admin'] = 'crud_controller/actualizar_cuenta_admin';
$route['status_cuenta_admin'] = 'crud_controller/status_cuenta_admin';
$route['calcula_monto_pedido'] = 'crud_controller/calcula_monto_pedido';

$route['registrar_cuenta'] = 'crud_controller/registrar_cuenta';
$route['actualizar_cuenta'] = 'crud_controller/actualizar_cuenta';
$route['status_cuenta'] = 'crud_controller/status_cuenta';

$route['eliminar_usuario'] = 'crud_controller/eliminar_usuario';
$route['eliminar_usuario_s'] = 'crud_controller/eliminar_usuario_s';

$route['update_user_status'] = 'crud_controller/update_user_status'; // Actualizar Estatus
$route['update_user_status_s'] = 'crud_controller/update_user_status_search'; // Actualizar estatus de usuario redirect search
$route['update_user_status_show'] = 'crud_controller/update_user_status_show'; // Actualizar estatus de usuario redirect show_usuario
$route['update_user_status_perfil'] = 'crud_controller/update_user_status_perfil'; // Actualizar estatus de usuario redirect show_perfil

$route['usuario_verificado'] = 'crud_controller/usuario_verificado'; // Cambiar usuario verificado/no verificado
$route['usuario_verificado_s'] = 'crud_controller/usuario_verificado_s'; // Cambiar usuario verificado/no verificado redirect search
$route['usuario_verificado_show'] = 'crud_controller/usuario_verificado_show'; // Cambiar usuario verificado/no verificado redirect show_suario
$route['usuario_verificado_perfil'] = 'crud_controller/usuario_verificado_perfil'; // Cambiar usuario verificado/no verificado redirect show_perfil

$route['get_cuentas_admin'] = 'crud_controller/get_cuentas_admin'; // Obtener cuentas por paises

$route['cambiar_password'] = 'crud_controller/cambiar_password'; // Cambiar Password
$route['get_tax_pais'] = 'crud_controller/get_tax_pais'; // Recupera las tasas para el select del dashboard

$route['get_tax_dash'] = 'crud_controller/get_tax_dash';

$route['registrar_cuenta_otros'] = 'crud_controller/registrar_cuenta_otros';

$route['control_pedidos_op'] = 'admin/control_pedidos_operador';

$route['informa_operador'] = 'crud_controller/informa_operador';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
