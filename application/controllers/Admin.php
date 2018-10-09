<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    //const base_url = 'http://localhost/thechanger';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_crud');
    }

    public function dashboard()
    {
        if( isset($_SESSION['logged_in_cexpress'])):

            $data['titulo'] = 'Tablero';
            $data['msg'] = '';
            $data['tax'] = $this->admin_crud->get_tax();

            // Notificaciones Admin
            $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
            $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
            $data['pedidos_noti_acep'] = $this->admin_crud->get_pedidos_aceptados();
            $data['pedidos_noti_acep_num_rows'] = $this->admin_crud->pedidos_noti_acep_num_rows();
            $data['usuario_noti'] = $this->admin_crud->get_usuarios();

            $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
            $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

            // Notificaciones Usuario
            $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
            $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

            $data['usuario'] = $this->admin_crud->get_usuario( $_SESSION['id_cexpress'], FALSE );

            $data['admin_banco'] = $this->admin_crud->get_cuentas_admin_active();

            $this->load->view('header', $data);
            $data['bancos_admin'] = $this->admin_crud->get_banco_receptor();
            $data['bancos_usuarios'] = $this->admin_crud->get_banco_beneficiario();
            $data['pedidos'] = $this->admin_crud->get_last_pedidos();
            $data['usuarios'] = $this->admin_crud->get_usuarios();
            $data['paises'] = $this->admin_crud->get_paises();
            $this->load->view('dashboard', $data);
            $this->load->view('footer');

        else:

            redirect('login');
        
        endif;
    }

    public function registrar_pais()
    {
        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ):
            
            $rules = array(
                        array(
                            'field'  => 'nombre',
                            'label'  => 'Nombre del País',
                            'rules'  => 'trim|required|is_unique[pais.pais]',
                            'errors' => array(
                                        'required'  => 'Campo %s requerido',
                                        'is_unique' => 'Este país ya se encuentra registrado' 
                            )
                        ),
                        array(
                            'field'  => 'moneda',
                            'label'  => 'Moneda Local',
                            'rules'  => 'trim|required',
                            'errors' => array(
                                        'required' => 'Campo %s requerido'
                            )
                        ),
                        array(
                            'field'  => 'diminutivo',
                            'label'  => 'Diminutivo',
                            'rules'  => 'required',
                            'errors' => array(
                                        'required' => 'Campo %s requerido'
                            )
                        ),
                    );

            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

            if( $this->form_validation->run() == FALSE ) :

                // Notificaciones Admin
            $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
            $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
            $data['usuario_noti'] = $this->admin_crud->get_usuarios();

            $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
            $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

            // Notificaciones Usuario
            $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
            $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                $data['titulo'] = "Registrar País";
                $this->load->view('header', $data);
                $data['msg'] = '';
                $data['bancos'] = $this->admin_crud->get_bancos();
                $data['paises'] = $this->admin_crud->get_paises();
                $this->load->view('forms_admin/registrar_pais', $data);
                $this->load->view('footer');

            else:

                $nombre     = $this->input->post('nombre');
                $moneda     = $this->input->post('moneda');
                $diminutivo = $this->input->post('diminutivo');
                $bancos     = $this->input->post('bancos');

                $consulta = $this->admin_crud->add_pais( $nombre, $moneda, $diminutivo, $bancos );

                if ( $consulta ) :
                    redirect('registrar_pais?msg=1');
                else:
                    redirect('registrar_pais?msg=2');
                endif;

            endif;

            else:

                redirect('login');

            endif;

        else:

            redirect('login');

        endif;
    }

    public function control_tasas()
    {
        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            // Notificaciones Admin
            $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
            $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
            $data['usuario_noti'] = $this->admin_crud->get_usuarios();

            $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
            $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

            // Notificaciones Usuario
            $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
            $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

            $data['titulo'] = "Control de Tasas";
            $data['msg'] = '';
            $data['paises'] = $this->admin_crud->get_paises();
            $data['tasas'] = $this->admin_crud->get_tax();
            $this->load->view('header', $data);
            $this->load->view('forms_admin/control_tasas', $data);
            $this->load->view('footer');

        else:

            redirect('login');

        endif;
    }

    public function control_pedidos()
    {
        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            if( $_SESSION['role_cexpress'] == 4 ):

                $data['usuario'] = $this->admin_crud->get_usuario( $_SESSION['id_cexpress'], FALSE );

            $rules = array(
                        array(
                            'field'  => 'monto_operacion',
                            'label'  => 'Monto Operación',
                            'rules'  => 'required',
                            'errors' => array(
                                        'required' => 'Campo Requerido'
                            )
                        ),
                        array(
                            'field'  => 'monto_pagado',
                            'lable'  => 'Monto Pagado',
                            'rules'  => 'required',
                            'errors' => array(
                                        'required'  => 'Campo Requerido'
                            )
                        ),
                        array(
                            'field'  => 'num_operacion',
                            'lable'  => 'Num Operacion',
                            'rules'  => 'required',
                            'errors' => array(
                                        'required'  => 'Campo Requerido'
                            )
                        )
                    );

            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

            if( $this->form_validation->run() == FALSE ):

                // Notificaciones Admin
            $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
            $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
            $data['usuario_noti'] = $this->admin_crud->get_usuarios();

            $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
            $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

            // Notificaciones Usuario
            $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
            $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                $data['titulo'] = "Control de Pedidos";
                $data['msg'] = '';
                $data['paises'] = $this->admin_crud->get_paises();
                $data['img_err'] = '';
                $data['bancos_admin'] = $this->admin_crud->get_banco_receptor();
                $data['bancos_usuarios'] = $this->admin_crud->get_banco_beneficiario( FALSE, $_SESSION['id_cexpress'] );
                $data['pedidos'] = $this->admin_crud->get_pedido_cliente( $_SESSION['id_cexpress'] );
                $this->load->view('header', $data);
                $this->load->view('forms_admin/pedidos', $data);
                $this->load->view('footer');

            else:

                $config['upload_path']          = './uploads/comprobantes/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 500;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload( 'comprobante' )):

                    // Notificaciones Admin
                    $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
                    $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
                    $data['usuario_noti'] = $this->admin_crud->get_usuarios();

                    $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
                    $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

                    // Notificaciones Usuario
                    $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
                    $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                    $data['titulo'] = "Control de Pedidos";
                    $data['msg'] = '';
                    $data['paises'] = $this->admin_crud->get_paises();
                    $data['pais_cliente'] = $this->admin_crud->get_paises_clientes();
                    $data['img_err'] = $this->upload->display_errors();    
                    $data['bancos_admin'] = $this->admin_crud->get_banco_receptor();
                    $data['bancos_usuarios'] = $this->admin_crud->get_banco_beneficiario( FALSE, $_SESSION['id_cexpress'] );
                    $data['pedidos'] = $this->admin_crud->get_pedido_cliente( $_SESSION['id_cexpress'] );
                    $this->load->view('header', $data);
                    $this->load->view('forms_admin/pedidos', $data);
                    $this->load->view('footer');
                else:

                    $num_operacion = $this->input->post('num_operacion'); 
                    $comprobante = $this->upload->data('file_name');
                    $id_cliente = $this->input->post('id_cliente');

                    $pais_receptor = $this->input->post('pais_receptor');
                    $banco_receptor = $this->input->post('cuenta_receptor');
                    $monto_pagado = $this->input->post('monto_pagado');
                    $diminutivo_receptor = $this->input->post('diminutivo_receptor');

                    $pais_beneficiario = $this->input->post('pais_beneficiario');

                    $monto_operacion = $this->input->post('monto_operacion');
                    
                    // Primera Cuenta
                    $banco_1 = $this->input->post('primera_cuenta');
                    $monto_1 = $this->input->post('primer_monto');

                    $consulta = $this->admin_crud->montar_pedido( $id_cliente, $comprobante, $pais_receptor, $banco_receptor, $monto_pagado, $pais_beneficiario, $banco_1, $monto_1, $num_operacion, $monto_operacion, $diminutivo_receptor );
                    
                    $id_pedido = $this->admin_crud->pedido_last_id( $id_cliente );

                    // Segunda Cuenta
                    if( !empty( $this->input->post('segunda_cuenta') ) && !empty( $this->input->post('segundo_monto') ) ):
                        $banco_2 = $this->input->post('segunda_cuenta');
                        $monto_2 = $this->input->post('segundo_monto');
                        $this->admin_crud->insert_cuenta_adicional( $id_pedido->id, $banco_2, $monto_2 );
                    endif;

                    // Segunda Cuenta
                    if( $this->input->post('tercera_cuenta') != FALSE && $this->input->post('tercer_monto') != FALSE ):
                        $banco_3 = $this->input->post('tercera_cuenta');
                        $monto_3 = $this->input->post('tercer_monto');
                        $this->admin_crud->insert_cuenta_adicional( $id_pedido->id, $banco_3, $monto_3 );
                    endif;

                    // Segunda Cuenta
                    if( $this->input->post('cuarta_cuenta') != FALSE && $this->input->post('cuarto_monto') != FALSE ):
                        $banco_4 = $this->input->post('cuarta_cuenta');
                        $monto_4 = $this->input->post('cuarto_monto');
                        $this->admin_crud->insert_cuenta_adicional( $id_pedido->id, $banco_4, $monto_4 );
                    endif;

                    // Segunda Cuenta
                    if( $this->input->post('quinta_cuenta') != FALSE && $this->input->post('quinto_monto') != FALSE ):
                        $banco_5 = $this->input->post('quinta_cuenta');
                        $monto_5 = $this->input->post('quinto_monto');
                        $this->admin_crud->insert_cuenta_adicional( $id_pedido->id, $banco_5, $monto_5 );
                    endif;


                    if( $consulta ):

                        $data['id_pedido'] = $this->admin_crud->get_pedido_id( $_SESSION['id_cexpress'] );
                        $data['cliente'] = $this->admin_crud->get_usuario( $_SESSION['id_cexpress'], FALSE );
                        $data['banco_receptor'] = $this->admin_crud->get_banco_receptor( $data['id_pedido']->banco_receptor );
                        $data['banco_beneficiario'] = $this->admin_crud->get_banco_beneficiario( $data['id_pedido']->banco_beneficiario, FALSE );

                            
                        $pais_receptor_mail = $data['banco_receptor']->pais;

                        if( $banco_receptor == "moneyGram" ):
                            $banco_receptor_mail = "MoneyGram";
                        elseif( $banco_receptor == "westernUnion" ):
                            $banco_receptor_mail = "Western Union";
                        else:
                            $banco_receptor_mail = $data['banco_receptor']->banco;
                        endif;

                        $pais_beneficiario_mail = $data['banco_beneficiario']->pais;
                        $banco_beneficiario_mail = $data['banco_beneficiario']->banco;
                        $diminutivo_beneficiario_mail = $data['banco_beneficiario']->diminutivo;
                        $cuenta_beneficiaria_mail = $data['banco_beneficiario']->cuenta;
                        $titular_beneficiario_mail = $data['banco_beneficiario']->titular;
                        $alias_beneficiario_mail = $data['banco_beneficiario']->alias;

                        if( !empty( $this->input->post('segunda_cuenta') ) && !empty( $this->input->post('segundo_monto') ) ):
                            $data['banco_2'] = $this->admin_crud->get_banco_beneficiario( $this->input->post('segunda_cuenta'), FALSE );
                            $pais_2_mail = $data['banco_2']->pais;
                            $banco_2_mail = $data['banco_2']->banco;
                            $cuenta_2 = $data['banco_2']->cuenta;
                            $titular_2 = $data['banco_2']->titular;
                            $alias_2 = $data['banco_2']->alias;
                        else:
                            $pais_2_mail = "";
                            $banco_2_mail = "";
                            $cuenta_2 = "";
                            $titular_2 = "";
                            $alias_2 = "";
                            $monto_2 = 0;
                        endif;

                        if( !empty( $this->input->post('tercera_cuenta') ) && !empty( $this->input->post('tercer_monto') ) ):
                            $data['banco_3'] = $this->admin_crud->get_banco_beneficiario( $this->input->post('tercera_cuenta'), FALSE );
                            $pais_3_mail = $data['banco_3']->pais;
                            $banco_3_mail = $data['banco_3']->banco;
                            $cuenta_3 = $data['banco_3']->cuenta;
                            $titular_3 = $data['banco_3']->titular;
                            $alias_3 = $data['banco_3']->alias;
                        else:
                            $pais_3_mail = "";
                            $banco_3_mail = "";
                            $cuenta_3 = "";
                            $titular_3 = "";
                            $alias_3 = "";
                            $monto_3 = 0;
                        endif;

                        if( !empty( $this->input->post('cuarta_cuenta') ) && !empty( $this->input->post('cuarto_monto') ) ):
                            $data['banco_4'] = $this->admin_crud->get_banco_beneficiario( $this->input->post('cuarta_cuenta'), FALSE );
                            $pais_4_mail = $data['banco_4']->pais;
                            $banco_4_mail = $data['banco_4']->banco;
                            $cuenta_4 = $data['banco_4']->cuenta;
                            $titular_4 = $data['banco_4']->titular;
                            $alias_4 = $data['banco_4']->alias;
                        else:
                            $pais_4_mail = "";
                            $banco_4_mail = "";
                            $cuenta_4 = "";
                            $titular_4 = "";
                            $alias_4 = "";
                            $monto_4 = 0;
                        endif;

                        if( !empty( $this->input->post('quinta_cuenta') ) && !empty( $this->input->post('quinto_monto') ) ):
                            $data['banco_5'] = $this->admin_crud->get_banco_beneficiario( $this->input->post('quinta_cuenta'), FALSE );
                            $pais_5_mail = $data['banco_5']->pais;
                            $banco_5_mail = $data['banco_5']->banco;
                            $cuenta_5 = $data['banco_5']->cuenta;
                            $titular_5 = $data['banco_5']->titular;
                            $alias_5 = $data['banco_5']->alias;
                        else:
                            $pais_5_mail = "";
                            $banco_5_mail = "";
                            $cuenta_5 = "";
                            $titular_5 = "";
                            $alias_5 = "";
                            $monto_5 = 0;
                        endif;

                        // Enviar Correo Informativo
                        $to = $data['cliente']->email;
                        $subject =  nombredeweb .' - Tu pedido ha sido recibido exitosamente';
                        $message = '
                        <!doctype html>
                        <html lang="en">
                        <head>
                            <!-- Required meta tags -->
                            <meta charset="utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                            <style>
                                .container{
                                max-width: 600px;
                                background-color: #FFF;
                                margin: 50px auto;
                                border-radius: 5px;
                                padding: 15px;
                                box-shadow: 3px 5px 10px #1c1738;
                                }
                        
                                html, body{
                                font-family: sans-serif;
                                }
                        
                                .bg-dark{
                                background: #39306b;
                                }
                        
                                .text-center{
                                text-align: center;
                                }
                        
                                .text-muted{
                                color: #666;
                                }
                        
                                .d-block{
                                display: block;
                                }

                                .text-right{
                                text-align: right;
                                }
                            </style>
                        
                            <title>Hello, world!</title>
                        </head>
                        <body class="bg-dark">
                            <div class="container">
                                <div class="text-center py-4">
                                    <img src="' . base_url() . 'assets/img/Logo_dark_2.png" alt="">
                                </div>
                                <hr>
                                <p>Hola, ' . $data['cliente']->nombre . ' ' . $data['cliente']->apellido . '</p>
                                <p>
                                    <strong>Tu pedido ha sido recibido exitosamente,</strong><br>
                                    Ya hemos recibimos tu pedido y en estos momentos nuestros encargados se encuentran verificandolo.<br>

                                    <h3>Resumen</h3>
                                    
                                    <div style="max-width: 300px; border: solid 1px black; border-radius: 5px; padding: 10px; margin: 15px auto; box-shadow: 2px 5px 5px lightgrey;">
                                        <small><small>
                                        <strong>Recibo</strong>
                                        <hr>
                                        <strong>Su pedido es el Número: </strong>' . $data['id_pedido']->id . ' <br>
                                        <strong>Fecha: </strong>' . date('d/m/Y') . '<br>
                                        <strong>Nombre del solicitante: </strong>' . $data['cliente']->nombre . ' ' . $data['cliente']->apellido . '<br>
                                        <hr>
                                        <strong>Su pago fue de: </strong>' . number_format( $monto_pagado, 2 ) . ' ' . $diminutivo_receptor . '<br>
                                        <strong>Realizado en el banco: </strong>' . $banco_receptor_mail . ' - ' . $pais_receptor_mail . '<br>
                                        <strong>Operación Número: </strong>' . $num_operacion . '<br>
                                        <hr>
                                        <strong>Total a recibir: </strong>' . number_format( $monto_operacion, 2 ) . ' ' . $diminutivo_beneficiario_mail . '<br>
                                        <hr>
                                        <strong>Cuenta beneficiaria 1</strong><br>
                                        <strong>Banco: </strong>' . $banco_beneficiario_mail . ' - ' . $pais_beneficiario_mail . '<br>
                                        <strong>Cuenta: </strong>' . $cuenta_beneficiaria_mail . ' - ' . $alias_beneficiario_mail . '<br>
                                        <strong>Titular: </strong>' . $titular_beneficiario_mail . '<br>
                                        <strong>Monto: </strong>' . number_format( $monto_1, 2 ) . ' ' . $diminutivo_beneficiario_mail . '<br>
                                        <strong>Cuenta beneficiaria 2</strong><br>
                                        <strong>Banco: </strong>' . $banco_2_mail . ' - ' . $pais_2_mail . '<br>
                                        <strong>Cuenta: </strong>' . $cuenta_2 . ' - ' . $alias_2 . '<br>
                                        <strong>Titular: </strong>' . $titular_2 . '<br>
                                        <strong>Monto: </strong>' . number_format( $monto_2, 2 ) . ' ' . $diminutivo_beneficiario_mail . '<br>
                                        <strong>Cuenta beneficiaria 3</strong><br>
                                        <strong>Banco: </strong>' . $banco_3_mail . ' - ' . $pais_3_mail . '<br>
                                        <strong>Cuenta: </strong>' . $cuenta_3 . ' - ' . $alias_3 . '<br>
                                        <strong>Titular: </strong>' . $titular_3 . '<br>
                                        <strong>Monto: </strong>' . number_format( $monto_3, 2 ) . ' ' . $diminutivo_beneficiario_mail . '<br>
                                        <strong>Cuenta beneficiaria 4</strong><br>
                                        <strong>Banco: </strong>' . $banco_4_mail . ' - ' . $pais_4_mail . '<br>
                                        <strong>Cuenta: </strong>' . $cuenta_4 . ' - ' . $alias_4 . '<br>
                                        <strong>Titular: </strong>' . $titular_4 . '<br>
                                        <strong>Monto: </strong>' . number_format( $monto_4, 2 ) . ' ' . $diminutivo_beneficiario_mail . '<br>
                                        <strong>Cuenta beneficiaria 5</strong><br>
                                        <strong>Banco: </strong>' . $banco_5_mail . ' - ' . $pais_5_mail . '<br>
                                        <strong>Cuenta: </strong>' . $cuenta_5 . ' - ' . $alias_5 . '<br>
                                        <strong>Titular: </strong>' . $titular_5 . '<br>
                                        <strong>Monto: </strong>' . number_format( $monto_5, 2 ) . ' ' . $diminutivo_beneficiario_mail . '<br>
                                        </small></small>
                                    </div>

                                    <div class="text-right">
                                        <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                        <strong>CEO Maybet Ordonez</strong>
                                    </div>
                                </p>
                                <hr>
                                <div class="text-center">
                                    <small>
                                        <small class="text-muted d-block">2018&copy; '. nombredeweb .'</small>
                                        <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +1 317 5720559</small>
                                        <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                                    </small>
                                </div>
                            </div>
                        
                        </body>
                        </html>
                        ';
                        $headers =  'From: '. nombredeweb .'' . "\r\n" .
                                    'MIME-Version: 1.0' . "\r\n" .
                                    'Content-type: text/html; charset=UTF-8' . "\r\n" .
                                    'Reply-To: notReply' . "\r\n" .
                                    'X-Mailer: PHP/'. "\r\n";
                                    
                        @mail( $to, $subject, $message, $headers );

                        redirect( 'exito_pedido?i=' . $data['id_pedido']->id );
                    else:
                        redirect( 'exito_pedido' );
                    endif;
                endif;

            endif;

            else:

                redirect('login');

            endif;

        else:

            redirect('login');

        endif;
    }

    public function control_pedidos_admin()
    {
        if( isset( $_SESSION['id_cexpress'] ) ):

            if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ):
            
                // Notificaciones Admin
                $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
                $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
                $data['usuario_noti'] = $this->admin_crud->get_usuarios();

                $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
                $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

                // Notificaciones Usuario
                $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
                $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                $data['titulo'] = 'Control de Pedidos';
                $data['msg'] = '';
                $data['subtitulo'] = '';
                $data['bancos_admin'] = $this->admin_crud->get_banco_receptor();
                $data['bancos_usuarios'] = $this->admin_crud->get_banco_beneficiario();
                $data['pedidos'] = $this->admin_crud->get_pedidos();
                $data['usuarios'] = $this->admin_crud->get_usuarios();
                $this->load->view('header', $data);
                $this->load->view('forms_admin/pedidos_admin', $data);
                $this->load->view('footer');

            else:

                redirect('login');

            endif;
        else:
            redirect('login');
        endif;
    }

    public function control_pedidos_operador()
    {
        if( isset( $_SESSION['id_cexpress'] ) ):

            if( $_SESSION['role_cexpress'] == 3 ):
            
                // Notificaciones Admin
                $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
                $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
                $data['usuario_noti'] = $this->admin_crud->get_usuarios();

                $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
                $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

                // Notificaciones Usuario
                $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
                $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                $data['titulo'] = 'Control de Pedidos';
                $data['msg'] = '';
                $data['subtitulo'] = '';
                $data['bancos_admin'] = $this->admin_crud->get_banco_receptor();
                $data['bancos_usuarios'] = $this->admin_crud->get_banco_beneficiario();
                $data['pedidos'] = $this->admin_crud->get_pedidos_operador();
                $data['usuarios'] = $this->admin_crud->get_usuarios();
                $this->load->view('header', $data);
                $this->load->view('forms_admin/pedidos_operador', $data);
                $this->load->view('footer');

            else:

                redirect('login');

            endif;
        else:
            redirect('login');
        endif;
    }

    public function buscar_pedido()
    {
        if( isset( $_SESSION['id_cexpress'] ) ):

            if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 || $_SESSION['role_cexpress'] == 3 ):

                // Notificaciones Admin
                $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
                $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
                $data['usuario_noti'] = $this->admin_crud->get_usuarios();

                $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
                $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

                // Notificaciones Usuario
                $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
                $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                $buscar = $this->input->get('buscar');
                if( empty( $buscar ) ):
                    redirect('control_pedidos_admin');
                endif;

                $data['titulo'] = 'Control de Pedidos';
                $data['msg'] = '';
                $data['subtitulo'] = '';
                $data['pedidos'] = $this->admin_crud->get_pedidos_search( $buscar );
                $data['usuarios'] = $this->admin_crud->get_usuarios();
                $this->load->view('header', $data);
                $this->load->view('forms_admin/pedidos_admin', $data);
                $this->load->view('footer');

            else:

                redirect('login');
            
            endif;
        else:
            redirect('login');
        endif;
    }

    public function archivo_pedidos()
    {
        if( isset( $_SESSION['id_cexpress'] ) ):

            if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 || $_SESSION['role_cexpress'] == 3 ):

                // Notificaciones Admin
                $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
                $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
                $data['usuario_noti'] = $this->admin_crud->get_usuarios();

                $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
                $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

                // Notificaciones Usuario
                $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
                $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                $data['titulo'] = 'Control de Pedidos';
                $data['subtitulo'] = ' - Archivo de pedidos';
                $data['msg'] = '';
                $data['bancos_admin'] = $this->admin_crud->get_banco_receptor();
                $data['bancos_usuarios'] = $this->admin_crud->get_banco_beneficiario();
                $data['pedidos'] = $this->admin_crud->get_pedidos_archivos();
                $data['usuarios'] = $this->admin_crud->get_usuarios();
                $this->load->view('header', $data);
                $this->load->view('forms_admin/pedidos_admin', $data);
                $this->load->view('footer');

            else:

                redirect('login');

            endif;

        else:
            redirect('login');
        endif;
    }

    public function ver_pedido()
    {
        if( isset( $_SESSION['id_cexpress'] ) ):

            if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 || $_SESSION['role_cexpress'] == 3 ):

                // Notificaciones Admin
                $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
                $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
                $data['usuario_noti'] = $this->admin_crud->get_usuarios();

                $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
                $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

                // Notificaciones Usuario
                $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
                $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                $id = $this->input->get('i');

                if( $this->input->get('n') !== null && $this->input->get('n') == "yes" ):
                    $consulta = $this->admin_crud->remove_notification( $id );
                endif;

                $data['titulo'] = 'Control de Pedidos';
                $data['msg'] = '';
                $data['pedido'] = $this->admin_crud->get_pedidos( $id );
                $data['usuario'] = $this->admin_crud->get_usuario( $data['pedido']->id_cliente, FALSE );
                $data['usuario_banco'] = $this->admin_crud->get_banco_beneficiario( $data['pedido']->banco_beneficiario );
                $data['admin_banco'] = $this->admin_crud->get_banco_receptor( $data['pedido']->banco_receptor );
                $data['bancos_venezuela'] = $this->admin_crud->get_banco_venezuela();
                $data['banco_receptor'] = $this->admin_crud->get_banco_receptor( $data['pedido']->banco_receptor );
                $data['banco_beneficiario'] = $this->admin_crud->get_banco_beneficiario( $data['pedido']->banco_beneficiario, FALSE );
                $data['bancos_cliente'] = $this->admin_crud->get_banco_beneficiario( FALSE, $data['pedido']->id_cliente );
                $data['complemento_row'] = $this->admin_crud->complementos_row( $data['pedido']->id );
                $data['complementos'] = $this->admin_crud->complementos( $data['pedido']->id );
                $this->load->view('header', $data);
                $this->load->view('show/pedidos', $data);
                $this->load->view('footer');

            else:

                redirect('login');

            endif;
        else:
            redirect('login');
        endif;
    }

    public function exito_pedido()
    {
        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            // Notificaciones Admin
            $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
            $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
            $data['usuario_noti'] = $this->admin_crud->get_usuarios();

            $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
            $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();
            

            // Notificaciones Usuario
            $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
            $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

            $id_pedido = $this->input->get('i');
            $data['titulo'] = "Control de Pedidos";
            $data['msg'] = '';
            $data['pedido'] = $this->admin_crud->get_pedidos( $id_pedido );
            $data['usuario'] = $this->admin_crud->get_usuario( $data['pedido']->id_cliente, FALSE );
            $data['banco_receptor'] = $this->admin_crud->get_banco_receptor( $data['pedido']->banco_receptor );
            $data['banco_beneficiario'] = $this->admin_crud->get_banco_beneficiario( $data['pedido']->banco_beneficiario, FALSE );
            $data['bancos_cliente'] = $this->admin_crud->get_banco_beneficiario( FALSE, $data['pedido']->id_cliente );
            $data['complemento_row'] = $this->admin_crud->complementos_row( $id_pedido );
            $data['complementos'] = $this->admin_crud->complementos( $id_pedido );
            $this->load->view('header', $data);
            $this->load->view('show/exito_pedido', $data);
            $this->load->view('footer');
        else:
            redirect('login');
        endif;
    }

    public function error_pedido()
    {
        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            // Notificaciones Admin
            $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
            $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
            $data['usuario_noti'] = $this->admin_crud->get_usuarios();

            $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
            $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

            // Notificaciones Usuario
            $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
            $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

            $data['titulo'] = "Control de Pedidos";
            $data['msg'] = '';
            $data['pedido'] = $this->db->get_pedidos( $id_pedido );    
            $this->load->view('header', $data);
            $this->load->view('show/pedido_error', $data);
            $this->load->view('footer');
        else:
            redirect('login');
        endif;
    }

    public function pedido()
    {
        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            // Notificaciones Admin
            $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
            $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
            $data['usuario_noti'] = $this->admin_crud->get_usuarios();

            $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
            $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

            // Notificaciones Usuario
            $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
            $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

            $id_pedido = $this->input->get('i');

            if( $this->input->get('n') !== null && $this->input->get('n') == "yes" ):
                $this->admin_crud->borrar_notificacion_usuario( $id_pedido );
            endif;
            $data['titulo'] = "Control de Pedidos";
            $data['msg'] = '';
            $data['pedido'] = $this->admin_crud->get_pedidos( $id_pedido );
            $data['usuario'] = $this->admin_crud->get_usuario( $data['pedido']->id_cliente, FALSE );
            $data['banco_receptor'] = $this->admin_crud->get_banco_receptor( $data['pedido']->banco_receptor );
            $data['banco_beneficiario'] = $this->admin_crud->get_banco_beneficiario( $data['pedido']->banco_beneficiario );
            $data['complemento_row'] = $this->admin_crud->complementos_row( $id_pedido );
            $data['complementos'] = $this->admin_crud->complementos( $id_pedido );
            $data['bancos_cliente'] = $this->admin_crud->get_banco_beneficiario( FALSE, $data['pedido']->id_cliente );
            $this->load->view('header', $data);
            $this->load->view('show/pedido_cliente', $data);
            $this->load->view('footer');
        else:
            redirect('login');
        endif;
    }

    public function control_usuarios()
    {
        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            // Notificaciones Admin
            $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
            $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
            $data['usuario_noti'] = $this->admin_crud->get_usuarios();

            $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
            $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

            // Notificaciones Usuario
            $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
            $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

            $data['titulo'] = "Control de Usuarios";
            $this->load->view('header', $data);

            $this->load->library('pagination');

            $config['base_url'] = base_url() . 'control_usuarios';
            $config['total_rows'] = $this->admin_crud->usuario_row();
            $config['per_page'] = 20;
            $config['uri_segment'] = 2;

            $this->pagination->initialize($config);

            $data['usuarios'] = $this->admin_crud->get_usuarios($config['per_page'], $this->uri->segment(2));
            $data['msg'] = '';
            $this->load->view('forms_admin/control_usuarios', $data);
            $this->load->view('footer');

        else:

            redirect('login');

        endif;
    }

    public function buscar_usuario()
    {

        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            // Notificaciones Admin
            $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
            $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
            $data['usuario_noti'] = $this->admin_crud->get_usuarios();

            $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
            $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

            // Notificaciones Usuario
            $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
            $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

            $buscar = $this->input->get('buscar');

            if( empty($buscar) ):
                redirect('control_usuarios');
            endif;

            $data['buscar'] = $this->admin_crud->get_usuario(FALSE, $buscar);

            $data['titulo'] = "Control de Usuarios";
            $this->load->view('header', $data);

            $data['msg'] = '';
            $this->load->view('forms_admin/busqueda_usuario', $data);
            $this->load->view('footer');

        else:

            redirect('login');

        endif;

    }

    public function show_usuario()
    {

        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ):

                $id = $this->input->get('id');

                if( $this->input->get('n') !== null && $this->input->get('n') == "yes" ):
                    $this->admin_crud->usuario_verified( $id );
                endif;

                // Notificaciones Admin
                $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
                $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
                $data['usuario_noti'] = $this->admin_crud->get_usuarios();

                $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
                $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

                // Notificaciones Usuario
                $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
                $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

            
                $data['usuarios'] = $this->admin_crud->get_usuario($id, FALSE);
                $data['titulo'] = 'Usuario: ' . $data['usuarios']->nombre . ' ' . $data['usuarios']->apellido;
                $data['msg'] = '';
                $data['c'] = '';
                $data['error'] = '';
                $data['paises'] = $this->admin_crud->get_paises();
                $this->load->view('header', $data);
                $this->load->view('show/show_usuario', $data);
                $this->load->view('footer');
            
            else:

                redirect('login');

            endif;

        else:

            redirect('login');

        endif;


    }

    public function cuentas_bancarias()
    {
        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            if(  $_SESSION['role_cexpress'] == 4 ):

                // Notificaciones Admin
                $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
                $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
                $data['usuario_noti'] = $this->admin_crud->get_usuarios();

                $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
                $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

                // Notificaciones Usuario
                $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
                $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                $data['titulo'] = "Cuentas Bancarias";
                $data['msg'] = '';
                $data['cuentas'] = $this->admin_crud->get_cuentas( $_SESSION['id_cexpress'] );
                $data['cuentas_lista'] = $this->admin_crud->get_cuentas_venezuela();
                $data['bancos'] = $this->admin_crud->get_banco_pais();
                $data['paises'] = $this->admin_crud->get_paises();
                $this->load->view('header', $data);
                $this->load->view('forms_admin/cuentas_bancarias', $data);
                $this->load->view('footer');

            else:

                redirect('login');

            endif;

        else:

            redirect('login');

        endif;
    }

    public function cuentas_bancarias_admin()
    {
        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ):

                // Notificaciones Admin
                $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
                $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
                $data['usuario_noti'] = $this->admin_crud->get_usuarios();

                $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
                $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

                // Notificaciones Usuario
                $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
                $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                $data['titulo'] = "Cuentas Bancarias";
                $data['msg'] = '';
                $data['cuentas'] = $this->admin_crud->get_cuentas_admin();
                $data['bancos'] = $this->admin_crud->get_banco_pais();
                $data['paises'] = $this->admin_crud->get_paises();
                $this->load->view('header', $data);
                $this->load->view('forms_admin/cuentas_bancarias_admin', $data);
                $this->load->view('footer');

            else:

                redirect('login');

            endif;

        else:

            redirect('login');

        endif;
    }

    public function estados_cuentas()
    {
        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            if( $_SESSION['role_cexpress'] == 1 || $_SESSION['role_cexpress'] == 2 ):

                // Notificaciones Admin
                $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
                $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
                $data['usuario_noti'] = $this->admin_crud->get_usuarios();

                $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
                $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

                // Notificaciones Usuario
                $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
                $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                $data['titulo'] = "Estados de Cuentas";
                $data['msg'] = '';
                $data['cuentas'] = $this->admin_crud->get_cuentas_admin();
                $this->load->view('header', $data);
                $this->load->view('show/estado_cuenta', $data);
                $this->load->view('footer');

            else:

                redirect('login');

            endif;

        else:

            redirect('login');

        endif;
    }

    public function estados_template()
    {
        if( isset( $_SESSION['logged_in_cexpress']) ):

            $id = $this->input->post('id');
            $mes = $this->input->post('mes');
            $ano = $this->input->post('ano');
            $data['admin_banco'] = $this->admin_crud->get_cuenta_admin_id( $id );
            $data['estado_cuenta'] = $this->admin_crud->get_estado_cuenta( $id, $mes, $ano );

            $this->load->view('show/estado_template', $data);

        else:
            redirect('login');
        endif;
        
    }

    public function perfil()
    {
        if( isset( $_SESSION['logged_in_cexpress'] ) ):

            // Notificaciones Admin
            $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
            $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
            $data['usuario_noti'] = $this->admin_crud->get_usuarios();

            $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
            $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

            // Notificaciones Usuario
            $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
            $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

            $data['error'] = '';

            if( is_null( $this->input->get('a') ) ):
                $id = $_SESSION['id_cexpress'];
                $data['msg'] = '';
                $data['usuarios'] = $this->admin_crud->get_usuario($id, FALSE);
                $data['titulo'] = "Perfil del Usuario";
                $data['paises'] = $this->admin_crud->get_paises();
                $this->load->view('header', $data);
                $this->load->view('show/show_usuario', $data);
                $this->load->view('footer');
            endif;


            if( $this->input->get('a') == 'perfil' ):

            $rules = array(
                array(
                    'field'  => 'email',
                    'label'  => 'Email',
                    'rules'  => 'required',
                    'errors' => array(
                                'required' => 'Campo %s requerido'
                    )
                ),
                array(
                    'field'  => 'direccion',
                    'label'  => 'Direccion',
                    'rules'  => 'required',
                    'errors' => array(
                                'required' => 'Campo %s requerido'
                    )
                ),
                array(
                    'field'  => 'ciudad',
                    'label'  => 'Ciudad',
                    'rules'  => 'required',
                    'errors' => array(
                                'required' => 'Campo %s requerido'
                    )
                ),
                array(
                    'field'  => 'codigo_postal',
                    'label'  => 'Código Postal',
                    'rules'  => 'required',
                    'errors' => array(
                                'required' => 'Campo %s requerido'
                    )
                ),
                array(
                    'field'  => 'telefono',
                    'label'  => 'Número Teléfonico',
                    'rules'  => 'required|numeric',
                    'errors' => array(
                                'required' => 'Campo %s requerido',
                                'numeric'  => 'Solo caracteres numéricos'
                    )
                )
            );

            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

            if( $this->form_validation->run() == FALSE ) :

                // Notificaciones Admin
            $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
            $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
            $data['usuario_noti'] = $this->admin_crud->get_usuarios();

            $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
            $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

            // Notificaciones Usuario
            $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
            $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                $id = $_SESSION['id_cexpress'];
                $data['msg'] = '';
                $data['usuarios'] = $this->admin_crud->get_usuario($id, FALSE);
                $data['titulo'] = "Perfil del Usuario";
                $data['paises'] = $this->admin_crud->get_paises();
                $this->load->view('header', $data);
                $this->load->view('show/show_usuario', $data);
                $this->load->view('footer');

            else:

                $id = $this->input->post('id');
                $email = $this->input->post('email');
                $direccion = $this->input->post('direccion');
                $ciudad = $this->input->post('ciudad');
                $nacionalidad = $this->input->post('nacionalidad');
                $codigo_postal = $this->input->post('codigo_postal');
                $telefono = $this->input->post('telefono');

                $consulta = $this->admin_crud->update_usuario( $id, $email, $direccion, $ciudad, $nacionalidad, $codigo_postal, $telefono );

                if ( $consulta ):
                    redirect('perfil?msg=1' );
                else:
                    redirect('perfil?msg=2' );
                endif;
        
            endif;

        elseif( $this->input->get('a') == 'password' ):

            $rules = array(
                array(
                    'field'  => 'password',
                    'label'  => 'Contraseña Actual',
                    'rules'  => 'required|min_length[8]',
                    'errors' => array(
                                'required' => 'Campo %s requerido',
                                'min_length'  => 'Mínimo 8 Caracteres'
                    )
                ),
                array(
                    'field'  => 'password_conf',
                    'label'  => 'Contraseña',
                    'rules'  => 'required|matches[password]',
                    'errors' => array(
                                'required' => 'Campo %s requerido',
                                'matches'  => 'Las contraseñas deben coincidir'
                    )
                ),
            );

            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

            if( $this->form_validation->run() == FALSE ) :

                // Notificaciones Admin
            $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
            $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
            $data['usuario_noti'] = $this->admin_crud->get_usuarios();

            $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
            $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

            // Notificaciones Usuario
            $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_cexpress'] );
            $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_cexpress'] );

                $id = $_SESSION['id_cexpress'];
                $data['msg'] = '';
                $data['usuarios'] = $this->admin_crud->get_usuario($id, FALSE);
                $data['titulo'] = "Perfil del Usuario";
                $data['paises'] = $this->admin_crud->get_paises();
                $this->load->view('header', $data);
                $this->load->view('show/show_usuario', $data);
                $this->load->view('footer');

            else:

                $id = $this->input->post('id');
                $password = $this->input->post('password');

                $consulta = $this->admin_crud->cambiar_password($id, $password);

                if ( $consulta ):
                    redirect('perfil?msg=1' );
                else:
                    redirect('perfil?msg=2' );
                endif;

            endif;

        endif;

        else:

            redirect('login');

        endif;
    }

    public function logout(){
        
        $consulta = $this->admin_crud->desconectar( $_SESSION['id_cexpress'] );
        
        unset(
            $_SESSION['usuario_cexpress'],
            $_SESSION['id_cexpress'],
            $_SESSION['role_cexpress'],
            $_SESSION['logged_in_cexpress']
        );

        redirect('login');
    }
}
