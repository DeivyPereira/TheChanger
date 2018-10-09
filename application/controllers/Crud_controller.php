<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_crud');
    }

    // Sección Registrar País

    public function delete_pais()
    {

        $id = $this->input->get('id');
        $consulta = $this->admin_crud->delete_pais( $id );

        if ( $consulta ):
            redirect('registrar_pais?msg=1' );
        else:
            redirect('registrar_pais?msg=2' );
        endif;

    }

    public function update_pais()
    {
        $nombre     = $this->input->post('nombre');
        $moneda     = $this->input->post('moneda');
        $diminutivo = $this->input->post('diminutivo');
        $id         = $this->input->post('id');

        $consulta = $this->admin_crud->update_pais($id, $nombre, $moneda, $diminutivo);

        if ( $consulta ):
            redirect('registrar_pais?msg=1' );
        else:
            redirect('registrar_pais?msg=2' );
        endif;
    }

    public function pais_status()
    {
        $id = $this->input->get('i');
        $status = $this->input->get('a');

        $consulta = $this->admin_crud->pais_status($id, $status);

        if ( $consulta ):
            redirect('registrar_pais?msg=1' );
        else:
            redirect('registrar_pais?msg=2' );
        endif;
    }

    // Sección Control de Usuarios

    public function update_role()
    {
        $id   = $this->input->post('id');
        $role = $this->input->post('role');
        $page = $this->input->post('page');
        
        if( $role != "false" ):
        
            $consulta = $this->admin_crud->update_role($id, $role);

            if ( $consulta ):
                if( $page != null ):
                    redirect('control_usuarios/' . $page . '?msg=1');
                else:
                    redirect('control_usuarios?msg=1');
                endif;
            else:
                if( $page != null ):
                    redirect('control_usuarios/' . $page . '?msg=2');
                else:
                    redirect('control_usuarios?msg=2');
                endif;
            endif;

        else:
    
            redirect('control_usuarios');

        endif;
    }

    public function eliminar_usuario_s()
    {
        $id = $this->input->get('i');
        $key = $this->input->get('key');

        $consulta = $this->admin_crud->eliminar_usuario( $id );

        if( $consulta ):
            redirect('buscar_usuario?buscar=' . $key . '&msg=1');
        else:
            redirect('buscar_usuario?buscar=' . $key . '&msg=2');
        endif;
    }

    public function update_role_search()
    {
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        $buscar = $this->input->post('buscar');

        if( $role != "false" ):
        
            $consulta = $this->admin_crud->update_role($id, $role);

            if ( $consulta ):
                redirect('buscar_usuario?msg=1&buscar=' . $buscar );
            else:
                redirect('buscar_usuario?msg=2&buscar=' . $buscar );
            endif;

        else:
    
            redirect('buscar_usuario?buscar=' . $buscar );

        endif;
        
    }

    public function update_role_show()
    {
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        $buscar = $this->input->post('buscar');

        if( $role != "false" ):
        
            $consulta = $this->admin_crud->update_role($id, $role);

            if ( $consulta ):
                redirect('usuario?msg=1&id=' . $id );
            else:
                redirect('usuario?msg=2&id=' . $id );
            endif;

        else:
    
            redirect('usuario?id=' . $id );

        endif;
    }

    public function update_role_perfil()
    {
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        $buscar = $this->input->post('buscar');

        if( $role != "false" ):
        
            $consulta = $this->admin_crud->update_role($id, $role);

            if ( $consulta ):
                redirect('perfil?msg=1' );
            else:
                redirect('perfil?msg=2' );
            endif;

        else:
    
            redirect( 'perfil' );

        endif;
    }

    public function update_user_status()
    {

        $id = $this->input->get('id');
        $page = $this->input->get('p');

        $consulta = $this->admin_crud->update_user_status( $id );

        if ( $consulta ):

            // Recupera datos del usuario

            $data['usuario'] = $this->admin_crud->get_usuario( $id, FALSE ); 

            // Enviar Correo de Bienvenida
            $to = $data['usuario']->email;

            if( $data['usuario']->status == 1 ):
                $subject = nombredeweb .' - Su cuenta ha sido activada';
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
                        <p>Hola, ' . $data['usuario']->nombre . ' ' . $data['usuario']->apellido . '</p>
                        <p>
                            <strong>Tu usuario ha sido activado,</strong><br><br>
                            Ahora puedes seguir disfrutando de nuestros servicios.

                            <div class="text-right">
                                <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                <strong>CEO Sistema Remesas</strong>
                            </div>
                        </p>
                        <hr>
                        <div class="text-center">
                            <small>
                                <small class="text-muted d-block">2018&copy; '. nombredeweb .' </small>
                                <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
                                <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                            </small>
                        </div>
                    </div>
                
                </body>
                </html>
                ';

            elseif( $data['usuario']->status == 0 ):
                $subject =  nombredeweb .' - Su cuenta ha sido bloqueada';
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
                        <p>Hola, ' . $data['usuario']->nombre . ' ' . $data['usuario']->apellido . '</p>
                        <p>
                            <strong>Tu usuario ha sido bloqueado,</strong><br><br>
                            Tu usuario ha sido bloqueado por un administrador, por favor comunícate con nosotros por Whatsapp al +1 (317) 572 0559 para recibir soporte.

                            <div class="text-right">
                                <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                <strong>CEO Sistema Remesas</strong>
                            </div>
                        </p>
                        <hr>
                        <div class="text-center">
                            <small>
                                <small class="text-muted d-block">2018&copy; '. nombredeweb .'</small>
                                <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
                                <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                            </small>
                        </div>
                    </div>
                
                </body>
                </html>
                ';

            endif;


            $headers =  'From: '. nombredeweb  . "\r\n" .
			            'MIME-Version: 1.0' . "\r\n" .
			            'Content-type: text/html; charset=UTF-8' . "\r\n" .
			            'Reply-To: notReply' . "\r\n" .
			            'X-Mailer: PHP/'. "\r\n";
                        
            @mail( $to, $subject, $message, $headers );

            redirect('control_usuarios/' . $page . '?msg=1');
        else:
            redirect('control_usuarios/' . $page . '?msg=2');
        endif;

    }

    public function update_user_status_search()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        $buscar = $this->input->get('buscar');

        $consulta = $this->admin_crud->update_user_status($id, $status);

        if ( $consulta ):

            // Recupera datos del usuario

            $data['usuario'] = $this->admin_crud->get_usuario( $id, FALSE ); 

            // Enviar Correo de Bienvenida
            $to = $data['usuario']->email;

            if( $data['usuario']->status == 1 ):
                $subject = ''. nombredeweb .' - Su cuenta ha sido activada';
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
                        <p>Hola, ' . $data['usuario']->nombre . ' ' . $data['usuario']->apellido . '</p>
                        <p>
                            <strong>Felicidades! Tu usuario ha sido activado,</strong><br><br>
                            Tu suscripción ha sido aprobada, ahora puedes comenzar a registrar tus cuentas y a montar tus pedidos.

                            <div class="text-right">
                                <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                <strong>CEO Sistema Remesas</strong>
                            </div>
                        </p>
                        <hr>
                        <div class="text-center">
                            <small>
                                <small class="text-muted d-block">2018&copy; '. nombredeweb .' Venezuela</small>
                                <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
                                <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                            </small>
                        </div>
                    </div>
                
                </body>
                </html>
                ';

            elseif( $data['usuario']->status == 0 ):
                $subject = nombredeweb .' - Su cuenta ha sido bloqueada';
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
                        <p>Hola, ' . $data['usuario']->nombre . ' ' . $data['usuario']->apellido . '</p>
                        <p>
                            <strong>Tu usuario ha sido bloqueado,</strong><br><br>
                            Tu usuario ha sido bloqueado por un administrador, por favor comunícate con nosotros por Whatsapp al +1 (317) 572 0559 para recibir soporte.

                            <div class="text-right">
                                <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                <strong>CEO Sistema Remesas</strong>
                            </div>
                        </p>
                        <hr>
                        <div class="text-center">
                            <small>
                                <small class="text-muted d-block">2018&copy; '. nombredeweb .' Venezuela</small>
                                <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
                                <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                            </small>
                        </div>
                    </div>
                
                </body>
                </html>
                ';

            endif;


            $headers =  'From: '. nombredeweb .'' . "\r\n" .
			            'MIME-Version: 1.0' . "\r\n" .
			            'Content-type: text/html; charset=UTF-8' . "\r\n" .
			            'Reply-To: notReply' . "\r\n" .
			            'X-Mailer: PHP/'. "\r\n";
                        
            @mail( $to, $subject, $message, $headers );

            redirect('buscar_usuario?msg=1&buscar=' . $buscar );
        else:
            redirect('buscar_usuario?msg=2&buscar=' . $buscar );
        endif;
    }

    public function update_user_status_show()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('status');

        $consulta = $this->admin_crud->update_user_status($id, $status);

        if ( $consulta ):

            // Recupera datos del usuario

            $data['usuario'] = $this->admin_crud->get_usuario( $id, FALSE ); 

            // Enviar Correo de Bienvenida
            $to = $data['usuario']->email;

            if( $data['usuario']->status == 1 ):
                $subject = ''. nombredeweb .' - Su cuenta ha sido activada';
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
                        <p>Hola, ' . $data['usuario']->nombre . ' ' . $data['usuario']->apellido . '</p>
                        <p>
                            <strong>Felicidades! Tu usuario ha sido activado,</strong><br><br>
                            Tu suscripción ha sido aprobada, ahora puedes comenzar a registrar tus cuentas y a montar tus pedidos.

                            <div class="text-right">
                                <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                <strong>CEO Sistema Remesas</strong>
                            </div>
                        </p>
                        <hr>
                        <div class="text-center">
                            <small>
                                <small class="text-muted d-block">2018&copy; '. nombredeweb .' Venezuela</small>
                                <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
                                <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                            </small>
                        </div>
                    </div>
                
                </body>
                </html>
                ';

            elseif( $data['usuario']->status == 0 ):
                $subject = ''. nombredeweb .' - Su cuenta ha sido bloqueada';
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
                        <p>Hola, ' . $data['usuario']->nombre . ' ' . $data['usuario']->apellido . '</p>
                        <p>
                            <strong>Tu usuario ha sido bloqueado,</strong><br><br>
                            Tu usuario ha sido bloqueado por un administrador, por favor comunícate con nosotros por Whatsapp al +1 (317) 572 0559 para recibir soporte.

                            <div class="text-right">
                                <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                <strong>CEO Sistema Remesas</strong>
                            </div>
                        </p>
                        <hr>
                        <div class="text-center">
                            <small>
                                <small class="text-muted d-block">2018&copy; '. nombredeweb .' Venezuela</small>
                                <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
                                <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                            </small>
                        </div>
                    </div>
                
                </body>
                </html>
                ';

            endif;


            $headers =  'From: '. nombredeweb .'' . "\r\n" .
			            'MIME-Version: 1.0' . "\r\n" .
			            'Content-type: text/html; charset=UTF-8' . "\r\n" .
			            'Reply-To: notReply' . "\r\n" .
			            'X-Mailer: PHP/'. "\r\n";
                        
            @mail( $to, $subject, $message, $headers );

            redirect( 'usuario?msg=1&id=' . $id );
        else:
            redirect( 'usuario?msg=1&id=' . $id );
        endif;
    }

    public function update_user_status_perfil()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('status');

        $consulta = $this->admin_crud->update_user_status($id, $status);

        if ( $consulta ):

             // Recupera datos del usuario

             $data['usuario'] = $this->admin_crud->get_usuario( $id, FALSE ); 

             // Enviar Correo de Bienvenida
             $to = $data['usuario']->email;
 
             if( $data['usuario']->status == 1 ):
                 $subject = nombredeweb .' - Su cuenta ha sido activada';
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
                         <p>Hola, ' . $data['usuario']->nombre . ' ' . $data['usuario']->apellido . '</p>
                         <p>
                             <strong>Felicidades! Tu usuario ha sido activado,</strong><br><br>
                             Tu suscripción ha sido aprobada, ahora puedes comenzar a registrar tus cuentas y a montar tus pedidos.
 
                             <div class="text-right">
                                 <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                 <strong>CEO Sistema Remesas</strong>
                             </div>
                         </p>
                         <hr>
                         <div class="text-center">
                             <small>
                                 <small class="text-muted d-block">2018&copy; '. nombredeweb .' Venezuela</small>
                                 <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
                                 <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                             </small>
                         </div>
                     </div>
                 
                 </body>
                 </html>
                 ';
 
             elseif( $data['usuario']->status == 0 ):
                 $subject = ''. nombredeweb .' - Su cuenta ha sido bloqueada';
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
                         <p>Hola, ' . $data['usuario']->nombre . ' ' . $data['usuario']->apellido . '</p>
                         <p>
                             <strong>Tu usuario ha sido bloqueado,</strong><br><br>
                             Tu usuario ha sido bloqueado por un administrador, por favor comunícate con nosotros por Whatsapp al +1 (317) 572 0559 para recibir soporte.
 
                             <div class="text-right">
                                 <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                 <strong>CEO Sistema Remesas</strong>
                             </div>
                         </p>
                         <hr>
                         <div class="text-center">
                             <small>
                                 <small class="text-muted d-block">2018&copy; '. nombredeweb .' Venezuela</small>
                                 <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
                                 <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                             </small>
                         </div>
                     </div>
                 
                 </body>
                 </html>
                 ';
 
             endif;
 
 
             $headers =  'From: '. nombredeweb .'' . "\r\n" .
                         'MIME-Version: 1.0' . "\r\n" .
                         'Content-type: text/html; charset=UTF-8' . "\r\n" .
                         'Reply-To: notReply' . "\r\n" .
                         'X-Mailer: PHP/'. "\r\n";
                         
             @mail( $to, $subject, $message, $headers );

            redirect( 'perfil?msg=1' );
        else:
            redirect( 'perfil?msg=1' );
        endif;
    }

    public function usuario_verificado()
    {
        $id = $this->input->get('id');
        $conf = $this->input->get('conf');

        $consulta = $this->admin_crud->usuario_verificado($id, $conf);

        if ( $consulta ):
            redirect('control_usuarios?msg=1');
        else:
            redirect('control_usuarios?msg=2');
        endif;
    }

    public function usuario_verificado_s()
    {

        $id = $this->input->get('id');
        $conf = $this->input->get('conf');
        $buscar = $this->input->get('buscar');

        $consulta = $this->admin_crud->usuario_verificado($id, $conf);

        if ( $consulta ):
            redirect('buscar_usuario?msg=1&buscar=' . $buscar );
        else:
            redirect('buscar_usuario?msg=2&buscar=' . $buscar );
        endif;
    }

    public function usuario_verificado_show()
    {
        $id = $this->input->get('id');
        $conf = $this->input->get('conf');
        $buscar = $this->input->get('buscar');

        $consulta = $this->admin_crud->usuario_verificado($id, $conf);

        if ( $consulta ):
            redirect('usuario?msg=1&id=' . $id );
        else:
            redirect('usuario?msg=2&id=' . $id );
        endif;
    }

    public function usuario_verificado_perfil()
    {
        $id = $this->input->get('id');
        $conf = $this->input->get('conf');
        $buscar = $this->input->get('buscar');

        $consulta = $this->admin_crud->usuario_verificado($id, $conf);

        if ( $consulta ):
            redirect('perfil?msg=1' );
        else:
            redirect('perfil?msg=2' );
        endif;
    }

    public function consulta_tasa(){

        $pais = $this->input->post('pais');

        $consulta = $this->admin_crud->get_tasa( $pais );

        if( $consulta ):
            echo json_encode( $consulta );
        else:
            echo "false";
        endif;

    }

    public function eliminar_usuario()
    {
        $id = $this->input->get('i');
        $page = $this->input->get('p');

        $consulta = $this->admin_crud->eliminar_usuario( $id );

        if( $consulta ):
            redirect('control_usuarios/' . $page . '?msg=1');
        else:
            redirect('control_usuarios/' . $page . '?msg=2');
        endif;
    }

    public function actualizar_tasa()
    {
        $tasa = $this->input->post('tasa');
        $pais = $this->input->post('pais');

        $consulta = $this->admin_crud->actualizar_tasa( $pais, $tasa );

        if( $consulta ):
            redirect('control_tasas?msg=1');
        else:
            redirect('control_tasas?msg=2');
        endif;
    }

    public function update_banco()
    {
        $banco = $this->input->post('banco');
        $id = $this->input->post('id');

        $consulta = $this->admin_crud->update_banco( $id, $banco );

        if ( $consulta ):
            redirect('registrar_pais?msg=1' );
        else:
            redirect('registrar_pais?msg=2' );
        endif;

    }

    public function banco_status()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('a');

        $consulta = $this->admin_crud->banco_status( $id, $status );

        if ( $consulta ):
            redirect('registrar_pais?msg=1' );
        else:
            redirect('registrar_pais?msg=2' );
        endif;
    }

    public function delete_banco()
    {
        $id = $this->input->get('i');

        $consulta = $this->admin_crud->delete_banco( $id );

        if ( $consulta ):
            redirect('registrar_pais?msg=1' );
        else:
            redirect('registrar_pais?msg=2' );
        endif;
    }

    public function buscar_banco_pais()
    {
        $pais = $this->input->get('a');

        $consulta = $this->admin_crud->get_banco_pais( $pais );

        print_r(json_encode($consulta));
    }

    public function registrar_cuenta()
    {
        $id       = $this->input->post('id');
        $alias    = $this->input->post('alias');
        $cuenta   = $this->input->post('cuenta');
        $titular  = $this->input->post('titular');
        $tipo     = $this->input->post('tipo');
        $dni      = $this->input->post('tipo_documento') . $this->input->post('dni');
        $telefono = $this->input->post('telefono');
        $email    = $this->input->post('email');
        if( $this->input->post('banco') == "Otros" ):
            $banco = $this->input->post('banco_alt');
        elseif( $this->input->post('banco') != "Otros" ):
            $banco = $this->input->post('banco');
        endif;
        $pais     = $this->input->post('pais');

        $consulta = $this->admin_crud->registrar_cuenta( $id, $alias, $cuenta, $titular, $tipo, $dni, $telefono, $email, $banco, $pais );

        if ( $consulta ):
            redirect('cuentas_bancarias?msg=1' );
        else:
            redirect('cuentas_bancarias?msg=2' );
        endif;
    }

    public function actualizar_cuenta()
    {
        $id       = $this->input->post('id');
        $cuenta   = $this->input->post('cuenta');
        $titular  = $this->input->post('titular');
        $tipo     = $this->input->post('tipo');
        $dni      = $this->input->post('dni');
        $telefono = $this->input->post('telefono');
        $email    = $this->input->post('email');

        $consulta = $this->admin_crud->actualizar_cuenta( $id, $cuenta, $titular, $tipo, $dni, $telefono, $email );

        if ( $consulta ):
            redirect('cuentas_bancarias?msg=1' );
        else:
            redirect('cuentas_bancarias?msg=2' );
        endif;
    }

    public function status_cuenta()
    {
        $id = $this->input->get('i');
        $status = $this->input->get('a');

        $consulta = $this->admin_crud->status_cuenta( $id, $status );

        if ( $consulta ):
            redirect('cuentas_bancarias?msg=1' );
        else:
            redirect('cuentas_bancarias?msg=2' );
        endif;
    }

    public function actualizar_cuenta_admin()
    {
        $id       = $this->input->post('id');
        $cuenta   = $this->input->post('cuenta');
        $titular  = $this->input->post('titular');
        $tipo     = $this->input->post('tipo');
        $dni      = $this->input->post('dni');
        $telefono = $this->input->post('telefono');
        $email    = $this->input->post('email');

        $consulta = $this->admin_crud->actualizar_cuenta_admin( $id, $cuenta, $titular, $tipo, $dni, $telefono, $email );

        if ( $consulta ):
            redirect('cuentas_bancarias_admin?msg=1' );
        else:
            redirect('cuentas_bancarias_admin?msg=2' );
        endif;
    }

    public function status_cuenta_admin()
    {
        $id = $this->input->get('i');
        $status = $this->input->get('a');

        $consulta = $this->admin_crud->status_cuenta_admin( $id, $status );

        if ( $consulta ):
            redirect('cuentas_bancarias_admin?msg=1' );
        else:
            redirect('cuentas_bancarias_admin?msg=2' );
        endif;
    }


    public function registrar_cuenta_admin()
    {
        $alias    = $this->input->post('alias');
        $cuenta   = $this->input->post('cuenta');
        $titular  = $this->input->post('titular');
        $tipo     = $this->input->post('tipo');
        $dni      = $this->input->post('dni');
        $telefono = $this->input->post('telefono');
        $email    = $this->input->post('email');
        $banco    = $this->input->post('banco');
        $pais     = $this->input->post('pais');
        $monto    = $this->input->post('monto');

        $consulta = $this->admin_crud->registrar_cuenta_admin( $alias, $cuenta, $titular, $tipo, $dni, $telefono, $email, $banco, $pais, $monto );

        if ( $consulta ):
            redirect('cuentas_bancarias_admin?msg=1' );
        else:
            redirect('cuentas_bancarias_admin?msg=2' );
        endif;
    }

    public function buscar_banco_admin_pais()
    {
        $pais = $this->input->get('a');

        $consulta = $this->admin_crud->get_cuentas_admin( $pais );

        if( $consulta ):
            print_r(json_encode($consulta));
        else:
            $result = array(
                        'error' => "true"
            );
            print_r(json_encode($result)); 
        endif;
    }

    public function buscar_banco_cliente()
    {
        $pais = $this->input->get('a');

        $consulta = $this->admin_crud->buscar_banco_cliente( $_SESSION['id_'. nombredeweb .''], $pais );

        if( $consulta ):
            print_r(json_encode($consulta));
        else:
            echo "false";
        endif;
    }

    public function calcula_monto_pedido()
    {
        $pais = $this->input->post('pais');

        $consulta = $this->admin_crud->get_tax( $pais );

        if( $consulta ):
            print_r(json_encode($consulta));
        else:
            echo "false";
        endif;
    }

    public function archivar_pedido()
    {
        $id = $this->input->get('i');

        $consulta = $this->admin_crud->archivar_pedido( $id );

        if( $consulta ):
            redirect('control_pedidos_admin?msg=1');
        else:
            redirect('control_pedidos_admin?msg=2');
        endif;
    }

    public function actualizar_pedido()
    {
        $id      = $this->input->post('id');

        $this->admin_crud->mostrar_notificacion( $id );
        
        $status  = $this->input->post('status');
        $mensaje = $this->input->post('mensaje');
        $monto_receptor = $this->input->post('monto_receptor');
        $monto_beneficiario = $this->input->post('monto_beneficiario');
        $id_cuenta = $this->input->post('id_cuenta'); 
        $usuario = $this->input->post('usuario');
        $banco_venezuela = $this->input->post('banco_venezuela');
        $id_cliente = $this->input->post('id_cliente');

        $consulta = $this->admin_crud->actualizar_pedido( $id, $status, $mensaje, $monto_receptor, $monto_beneficiario, $id_cuenta, $usuario, $banco_venezuela );

        if( $consulta ):

            $data['usuario'] = $this->admin_crud->get_usuario_by_id( $id_cliente );

            if( $status == 4 ):
                $sta = "Concluido";
            elseif( $status == 2 ):
                $sta = 'Rechazado';
            endif;

                // Notificamos al usuario
                $headers =  'From: '. nombredeweb .'' . "\r\n" .
                            'MIME-Version: 1.0' . "\r\n" .
                            'Content-type: text/html; charset=UTF-8' . "\r\n" .
                            'Reply-To: notReply' . "\r\n" .
                            'X-Mailer: PHP/'. "\r\n";

                $to = $data['usuario']->email;
                $subject =  nombredeweb .' - Actualización sobre tu pedido ' . $id;
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
                        <p>Hola, ' . $data['usuario']->nombre . ' ' . $data['usuario']->apellido . '</p>
                        <p>
                            <strong>Tienes una notificación sobre tu pedido número ' . $id . ',</strong><br>
                            El status de tu pedido ha sido cambiado a <strong>' . $sta . '</strong><br><br>
                            
                            Se detalla lo siguiente:<br>' . $mensaje . '

                            <div class="text-right">
                                <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                <strong>CEO Sistema Remesas</strong>
                            </div>
                        </p>
                        <hr>
                        <div class="text-center">
                            <small>
                                <small class="text-muted d-block">2018&copy; '. nombredeweb .' Venezuela</small>
                                <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
                                <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                            </small>
                        </div>
                    </div>
                
                </body>
                </html>
                ';
                            
                @mail( $to, $subject, $message, $headers );

                // Enviar Correo a la cuenta principal

                $pedidos = $this->admin_crud->get_pedidos( $id );
                $usuarios = $this->admin_crud->get_cuentas( $id_cliente );
                
                foreach( $usuarios as $usuario ):
                    if( $usuario['id'] == $pedidos->banco_beneficiario ):
                        $cuenta_princ_num = $usuario['cuenta'];
                        $cuenta_princ_titular = $usuario['titular'];
                        $cuenta_princ_email = $usuario['email'];
                        $cuenta_princ_dim = $usuario['diminutivo'];
                    endif;
                endforeach;
                
                $to = $cuenta_princ_email;
                    $subject = ''. nombredeweb .' - Se ha enviado un pago a tu cuenta';
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
                            <p>Hola, ' . $cuenta_princ_titular . '</p>
                            <p>
                                Se ha enviado a su cuenta número ****************' . substr( $cuenta_princ_num, -4 ) . ' la cantidad de ' . number_format( $pedidos->monto_beneficiario, 2 ) . ' ' . $cuenta_princ_dim . '<br>

                                <div class="text-right">
                                    <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                    <strong>CEO Sistema Remesas</strong>
                                </div>
                            </p>
                            <hr>
                            <div class="text-center">
                                <small>
                                    <small class="text-muted d-block">2018&copy; '. nombredeweb .' Venezuela</small>
                                    <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
                                    <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                                </small>
                            </div>
                        </div>
                    
                    </body>
                    </html>
                    ';
                                
                    @mail( $to, $subject, $message, $headers );

                // Enviar correo a las cuentas adicionales si las hubiere

                $complementos = $this->admin_crud->complementos( $id );

                foreach( $complementos as $complemento ):
                    foreach( $usuarios as $usuario ):
                        if( $complemento['banco'] == $usuario['id'] ):
                            $cuenta_num = $usuario['cuenta'];
                            $cuenta_titular = $usuario['titular'];
                            $cuenta_email = $usuario['email'];
                            $cuenta_dim = $usuario['diminutivo'];
                        endif;
                    endforeach;

                    $to = $cuenta_email;
                    $subject = ''. nombredeweb .' - Se ha enviado un pago a tu cuenta';
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
                            <p>Hola, ' . $cuenta_titular . '</p>
                            <p>
                                Se ha enviado a su cuenta número ****************' . substr( $cuenta_num, -4 ) . ' la cantidad de ' . number_format( $complemento['monto'], 2 ) . ' ' . $cuenta_dim . '<br>

                                <div class="text-right">
                                    <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                    <strong>CEO Sistema Remesas</strong>
                                </div>
                            </p>
                            <hr>
                            <div class="text-center">
                                <small>
                                    <small class="text-muted d-block">2018&copy; '. nombredeweb .' Venezuela</small>
                                    <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
                                    <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                                </small>
                            </div>
                        </div>
                    
                    </body>
                    </html>
                    ';
                                
                    @mail( $to, $subject, $message, $headers );

                endforeach;
                
            redirect('control_pedidos_op?msg=1&i=' . $id );
        else:
            redirect('control_pedidos_op?msg=2&i=' . $id );
        endif;
    }

    public function get_tax_dash()
    {
        $pais = $this->input->post('pais');
        $consulta = $this->admin_crud->get_tax( $pais );

        if( $consulta ):
            print_r(json_encode($consulta));
        else:
            echo "false";
        endif;
    }

    public function registar_nuevos_bancos()
    {
        $pais = $this->input->post('paisbanco');
        $bancos = $this->input->post('nuevosbancos');

        $consulta = $this->admin_crud->registar_nuevos_bancos( $pais, $bancos );

        if( $consulta ):
            redirect('registrar_pais?msg=1' );
        else:
            redirect('registrar_pais?msg=2' );
        endif;

    }

    public function eliminar_cuenta_admin()
    {
        $id = $this->input->get('i');

        $consulta = $this->admin_crud->eliminar_cuenta_admin( $id );

        if( $consulta ):
            redirect('cuentas_bancarias_admin?msg=1' );
        else:
            redirect('cuentas_bancarias_admin?msg=2' );
        endif;
    }

    public function get_cuentas_admin()
    {
        $pais = $this->input->post('pais');

        $data['admin_banco'] = $this->admin_crud->get_cuentas_admin( $pais );

        if( $data['admin_banco'] ):
            $this->load->view( 'templates/cuentas_dahsboard', $data );
        else:
            echo "false";
        endif;
    }

    public function get_tax_pais()
    {
        $pais = $this->input->post('pais');

        $data['tax'] = $this->admin_crud->get_tax( $pais );

        if( $data['tax'] ):
            $data['venezuela'] = $this->admin_crud->get_paises( 'Venezuela' );
            $this->load->view( 'templates/tax_dashboard', $data );
        else:
            echo "false";
        endif;
    }

    public function verificar()
    {
        $config['upload_path']          = './uploads/verificacion/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 500;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('verificar'))
        {

                // Notificaciones Admin
                $data['admin_noti'] = $this->admin_crud->get_noti_num_rows();
                $data['pedidos_noti'] = $this->admin_crud->get_pedidos_nuevos();
                $data['usuario_noti'] = $this->admin_crud->get_usuarios();

                $data['usuarios_nuevo_rows'] = $this->admin_crud->get_usuarios_nuevos_rows();
                $data['usuarios_nuevos'] = $this->admin_crud->get_usuarios_nuevos();

                // Notificaciones Usuario
                $data['usuario_noti_usuario'] = $this->admin_crud->get_noti_num_rows_usuario( $_SESSION['id_'. nombredeweb .''] );
                $data['pedidos_noti_usuario'] = $this->admin_crud->get_pedidos_noti_usuario( $_SESSION['id_'. nombredeweb .''] );

                $data['error'] = $this->upload->display_errors('<small class="text-danger">', '</small>');
                $id = $_SESSION['id_'. nombredeweb .''];
                $data['msg'] = '';
                $data['usuarios'] = $this->admin_crud->get_usuario($id, FALSE);
                $data['titulo'] = "Perfil del Usuario";
                $data['paises'] = $this->admin_crud->get_paises();
                $this->load->view('header', $data);
                $this->load->view('show/show_usuario', $data);
                $this->load->view('footer');
        }
        else
        {
            $documento = $this->upload->data('file_name');
            $this->admin_crud->verificar( $_SESSION['id_' . nombredeweb . ''], $documento );
            redirect('perfil?msg=1');
        }
    }

    public function verificacion()
    {
        $id = $this->input->get('i');
        $verificacion = $this->input->get('v');

        $consulta = $this->admin_crud->verificacion( $id, $verificacion );
        
        if( $consulta ):
            $this->session->set_userdata( array( 'verificacion_'. nombredeweb .'' => 2 ) );
            $usuario = $this->admin_crud->get_usuario( $id, FALSE );
            $to = $usuario->email;
            $subject = nombredeweb .' - Tu usuario ha sido verificado';
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
                 
                     <title></title>
                 </head>
                 <body class="bg-dark">
                     <div class="container">
                         <div class="text-center py-4">
                             <img src="' . base_url() . 'assets/img/Logo_dark_2.png" alt="">
                         </div>
                         <hr>
                         <p>Hola, ' . $usuario->nombre . ' ' . $usuario->apellido . '</p>
                         <p>
                             <strong>Tu usuario ha sido verificado exitosamente,</strong><br><br>
                             <p>Ahora podrás realizar tus pedidos en nuestro sistema, bienvenido a '. nombredeweb .'!</p>
 
                             <div class="text-right">
                                 <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                 <strong>CEO Sistema Remesas</strong>
                             </div>
                         </p>
                         <hr>
                         <div class="text-center">
                             <small>
                                 <small class="text-muted d-block">2018&copy; '. nombredeweb .' Venezuela</small>
                                 <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
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

            redirect('usuario?id=' . $usuario->id . '&msg=1');

        endif;
    }

    public function rechazar_verificacion()
    {
        $id = $this->input->post('id');
        $motivo = $this->input->post('motivo');

        $consulta = $this->admin_crud->verificacion( $id, 0 );
        
        if( $consulta ):
            $this->session->set_userdata( array( 'verificacion_'. nombredeweb .'' => 0 ) );
            $usuario = $this->admin_crud->get_usuario( $id, FALSE );
            $to = $usuario->email;
            $subject = ''. nombredeweb .' - Verificación rechazada';
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
                 
                     <title></title>
                 </head>
                 <body class="bg-dark">
                     <div class="container">
                         <div class="text-center py-4">
                             <img src="' . base_url() . 'assets/img/Logo_dark_2.png" alt="">
                         </div>
                         <hr>
                         <p>Hola, ' . $usuario->nombre . ' ' . $usuario->apellido . '</p>
                         <p>
                             <strong>Se ha rechazado tu verificación,</strong><br><br>
                             <p>' . $motivo . '</p>
 
                             <div class="text-right">
                                 <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                 <strong>CEO Sistema Remesas</strong>
                             </div>
                         </p>
                         <hr>
                         <div class="text-center">
                             <small>
                                 <small class="text-muted d-block">2018&copy; '. nombredeweb .' Venezuela</small>
                                 <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
                                 <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                             </small>
                         </div>
                     </div>
                 
                 </body>
                 </html>
                 '; 
 
            $headers =  'From: '. nombredeweb. "\r\n" .
                         'MIME-Version: 1.0' . "\r\n" .
                         'Content-type: text/html; charset=UTF-8' . "\r\n" .
                         'Reply-To: notReply' . "\r\n" .
                         'X-Mailer: PHP/'. "\r\n";
                         
            @mail( $to, $subject, $message, $headers );

            redirect('usuario?id=' . $usuario->id . '&msg=1');
        endif;

    }

    public function addBanco()
    {
        $id = $this->input->post('id');
        $alias = $this->input->post('alias');
        $cuenta = $this->input->post('cuenta');
        $titular = $this->input->post('titular');
        $tipo = $this->input->post('tipo');
            $tipo_documento = $this->input->post('tipo_documento');
            $documento = $this->input->post('dni');
        $dni = $tipo_documento . " " . $documento;
        $telefono = $this->input->post('telefono');
        $email = $this->input->post('email');
        $pais = $this->input->post('pais');
        if( $this->input->post('banco') == "Otros" ):
            $banco = $this->input->post('banco_alt');
        elseif( $this->input->post('banco') != "Otros" ):
            $banco = $this->input->post('banco');
        endif;

        $consulta = $this->admin_crud->registrar_cuenta( $id, $alias, $cuenta, $titular, $tipo, $dni, $telefono, $email, $banco, $pais );

        if( $consulta ):
            $recupera = $this->admin_crud->ultima_cuenta_usuario( $_SESSION['id_'. nombredeweb .'']);
            $result = array( 
                        'status'    => "OK", 
                        'id_cuenta' => $recupera->id,
                        'alias'     => $recupera->alias
                    );
            print_r(json_encode($result));
        else:

            echo "false";
        endif;

    }

    public function get_usuarios_cuenta()
    {
        $consulta = $this->admin_crud->get_cuentas( $_SESSION['id_'. nombredeweb .''] );

        if( $consulta ):
            print_r(json_encode($consulta));
        endif;
    }

    public function informa_operador()
    {
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $id_cliente = $this->input->post('id_cliente');
        if( $status == 2 ):
            // Recupera datos del cliente
            $data['usuario'] = $this->admin_crud->get_usuario( $id_cliente, FALSE );
            // Informa al Cliente sobre el rechazo
            $mensaje = $this->input->post('mensaje');
            $to = $data['usuario']->email;
            $subject = ''. nombredeweb .' - Su pedido ha sido rechazado';
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
                 
                     <title></title>
                 </head>
                 <body class="bg-dark">
                     <div class="container">
                         <div class="text-center py-4">
                             <img src="' . base_url() . 'assets/img/Logo_dark_2.png" alt="">
                         </div>
                         <hr>
                         <p>Hola, ' . $usuario->nombre . ' ' . $usuario->apellido . '</p>
                         <p>
                             <strong>Tu pedido ha sido rechazado,</strong><br><br>
                             <p>' . $mensaje . '</p>
 
                             <div class="text-right">
                                 <strong>Gracias por confiar en nuestros servicios.</strong><br>
                                 <strong>CEO Sistema Remesas</strong>
                             </div>
                         </p>
                         <hr>
                         <div class="text-center">
                             <small>
                                 <small class="text-muted d-block">2018&copy; '. nombredeweb .' Venezuela</small>
                                 <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +51 917 835 815</small>
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

        else:
            $mensaje = "";
        endif;

        $consulta = $this->admin_crud->informa_operador( $id, $status, $mensaje );

        if( $consulta ):
            redirect('control_pedidos_admin?msg=1');
        else:
            redirect('control_pedidos_admin?msg=2');
        endif;
    }

    public function registrar_cuenta_otros()
    {
        $alias    = $this->input->post('alias');
        $cuenta   = 'N/A';
        $banco    = $this->input->post('banco');
        $titular  = $this->input->post('titular');
        $dni      = $this->input->post('dni');
        $pais     = $this->input->post('pais');
        $tipo     = $this->input->post('tipo');
        $email    = $this->input->post('email');
        $telefono = 'N/A';

        $consulta = $this->admin_crud->registrar_cuenta_otros( $alias, $cuenta, $titular, $tipo, $dni, $telefono, $email, $banco, $pais );

        if( $consulta ):
            echo "true";
        else:
            echo "false";
        endif;  
    }

}
