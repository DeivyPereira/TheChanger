<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceso extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('acceso_model');
    }

    public function index()
    {
        if(!isset($_SESSION['logged_in_cexpress'])) :

            redirect('login');

        else:

            redirect('dashboard');

        endif;
    }

    public function login()
    {
        if( isset( $_SESSION['logged_in_cexpress'] )):
            redirect('dashboard');
        endif;
        
        $rules = array(
            array(
                'field'  => 'email',
                'label'  => 'Correo electrónico',
                'rules'  => 'required|valid_email|callback_email_existe_login',
                'errors' => array(
                                'required'    => 'Campo %s requerido.',
                                'valid_email' => 'Formato de %s inválido',
                            )
            ),
            array(
                'field'  => 'password',
                'label'  => 'Contraseña',
                'rules'  => 'required',
                'errors' => array(
                                'required' => '%s requerida'
                            )
            )
        );

        $this->form_validation->set_rules($rules);

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if( $this->form_validation->run() == FALSE ) :
        
            $data['titulo'] = 'Login';
            $data['msg'] = '';
            $this->load->view('forms/login', $data);

        else:

            // Verificar si la password es correcta

			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$consulta = $this->acceso_model->verifica_password($email, $password);

            if( $consulta ):
                
                $query['usuario'] = $this->acceso_model->recupera_usuario($email);
                
                // Verificamos si el usuario está activo

                if( $query['usuario']->status == 0 ):
                
                    $data['titulo'] = 'Login';
                    $data['msg'] = '<script type="text/javascript">$(document).ready(function(){$.notify({icon: "ti-info",message: "Debe esperar a que su cuenta sea activada."},{type: "warning",timer: 10000});});</script>';
                    $this->load->view('forms/login', $data);
                
                elseif( $query['usuario']->status == 1 ):

                    // Establece la sesión
                    $data = array(
                        'usuario_cexpress'      => $query['usuario']->usuario,
                        'id_cexpress'           => $query['usuario']->id,
                        'role_cexpress'         => $query['usuario']->role,
                        'pais_cexpress'         => $query['usuario']->pais,
                        'verificacion_cexpress' => $query['usuario']->verificado,
                        'logged_in_cexpress'    => TRUE
                    );
                    $this->session->set_userdata($data);
                    
                    $consulta = $this->acceso_model->conectar( $query['usuario']->id );

                    redirect('dashboard?q=1');
                
                endif;

            else:
                $data['titulo'] = 'Login';
                $data['msg'] = '<script type="text/javascript">$(document).ready(function(){$.notify({icon: "ti-info",message: "La contraseña es incorrecta."},{type: "warning",timer: 10000});});</script>';
				$this->load->view('forms/login', $data);
			endif;

        endif;
    }

    public function email_existe_login($data)
	{
		$consulta = $this->acceso_model->email_existe($data);
		if( $consulta ):
			$this->form_validation->set_message('email_existe_login', 'Este {field} no existe en nuestros registros');
			return FALSE;
		else:
			return TRUE;
		endif;
	}

    public function suscripcion()
    {
        $rules = array(
            array(
                'field'  => 'nombre',
                'label'  => 'Nombre',
                'rules'  => 'required',
                'errors' => array(
                                'required' => 'Campo requerido'
                )
            ),
            array(
                'field'  => 'apellido',
                'label'  => 'Apellido',
                'rules'  => 'required',
                'errors' => array(
                                'required' => 'Campo requerido'
                )
            ),
            array(
                'field'  => 'email',
                'label'	 => 'Correo Electrónico',
                'rules'  => 'required|valid_email|callback_email_existe',
                'errors' => array(
                                'required'    => 'Campo requerido',
                                'valid_email' => 'Formato de %s inválido',
                )
            ),
            array(
                'field'  => 'email_conf',
                'label'  => 'Correo electrónico',
                'rules'  => 'required|matches[email]',
                'errors' => array(
                                'required' => 'Campo de confirmación requerido',
                                'matches'  => 'El %s no coincide'
                )
            ),
            array(
                'field'  => 'password',
                'label'  => 'Contraseña',
                'rules'  => 'required|min_length[8]',
                'errors' => array(
                                'required'      => 'Campo requerido',
                                'min_length'    => 'La %s debe contener al menos 8 caracteres',
                )
            ),
            array(
                'field'  => 'password_conf',
                'label'  => 'Password',
                'rules'  => 'required|matches[password]',
                'errors' => array(
                                'required' => 'Campo de confirmación requerido',
                                'matches'  => 'La %s no coincide'
                )
            ),
            array(
                'field'  => 'telefono',
                'label'  => 'Teléfono',
                'rules'  => 'required',
                'errors' => array(
                                'required' => 'Campo requerido'
                )
            ),
            array(
                'field'  => 'tipo_de_documento',
                'label'  => 'Tipo de documento',
                'rules'  => 'required',
                'errors' => array(
                                'required' => 'Campo requerido'
                )
            ),
            array(
                'field'  => 'documento_nmro',
                'label'  => 'Número de documento',
                'rules'  => 'required',
                'errors' => array(
                                'required' => 'Campo requerido'
                )
            ),
            array(
                'field'  => 'usuario_nombre',
                'label'  => 'Usuario',
                'rules'  => 'required|callback_user_unique',
                'errors' => array(
                                'required' => 'Campo requerido'
                )
            ),
            array(
                'field'  => 'pais',
                'label'  => 'País',
                'rules'  => 'callback_comprueba_select'
                )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

        if( $this->form_validation->run() == FALSE ) :
            
            $data['titulo'] = 'Suscripcion';
            $data['paises'] = $this->acceso_model->get_paises();
            $data['msg'] = '';
            $this->load->view('forms/suscripcion', $data);
            
        else:

			// Completa el registro del usuario nuevo
			
			$nombre   = $this->input->post('nombre');
			$apellido = $this->input->post('apellido');
			$email    = $this->input->post('email');
            $password = $this->input->post('password');
            $pais     = $this->input->post('pais');
            $telefono = $this->input->post('telefono');
            $tipo_doc = $this->input->post('tipo_de_documento');
            $doc_nmro = $this->input->post('documento_nmro');
            $usuario  = $this->input->post('usuario_nombre');

            $query = $this->acceso_model->suscripcion($nombre, $apellido, $email, $password, $pais, $telefono, $tipo_doc, $doc_nmro, $usuario);
            
            $nombre_cliente = $nombre . " " . $apellido;
            // Enviar Correo de Bienvenida
            $to = $email;
            $subject = 'Cexpress - Bienvenido a Cexpress';
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
                    <p>Hola, ' . $nombre_cliente . '</p>
                    <p>
                        <strong>Bienvenido a Cexpress,</strong><br>
                        Tu registro en el sistema se ha realizado <strong>exitosamente</strong>, te invitamos a completar el <strong>proceso de verificación de usuario</strong> para que puedas disfrutar de nuestros servicios, además, desde este momento ya puedes comenzar a planificar tus cambios usando nuestra calculadora interna.<br>
                        
                        Aprovechamos para notificarte sobre nuestras reglas:

                        <ul>
                            <li>
                                Las transferencias serán procesadas de acuerdo al volumen de solicitudes, el cual no será mayor a 2 horas si todo lo que nos suministro esta correcto.
                            </li>
                            <li>
                                Las transferencias enviadas a Banesco serán acreditadas el mismo día dependiendo siempre de la operatividad del Banco.
                            </li>
                            <li>
                                Las transferencias enviadas a otros Bancos diferentes a Banesco, serán acreditadas al siguiente día hábil, después de las 2 pm o incluso en muchos casos a las 6 pm. Sea paciente.
                            </li>
                            <li>
                                Este es un servicio privado y confidencial si usted disfruta del mismo es porque ha sido un cliente confiable, sigamos así.
                            </li>
                            <li>
                                Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +1 317 5720559
                            </li>
                        </ul>
                        <div class="text-right">
                            <strong>Gracias por confiar en nuestros servicios.</strong><br>
                            <strong>CEO Maybet Ordonez</strong>
                        </div>
                    </p>
                    <hr>
                    <div class="text-center">
                        <small>
                            <small class="text-muted d-block">2018&copy; Cexpress Venezuela</small>
                            <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +1 317 5720559</small>
                            <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                        </small>
                    </div>
                </div>
            
              </body>
            </html>
            ';
            $headers =  'From: Cexpress' . "\r\n" .
			            'MIME-Version: 1.0' . "\r\n" .
			            'Content-type: text/html; charset=UTF-8' . "\r\n" .
			            'Reply-To: notReply' . "\r\n" .
			            'X-Mailer: PHP/'. "\r\n";
                        
            @mail( $to, $subject, $message, $headers );
            
            
            if( $query ):


                $data['titulo'] = 'Login';
                $data['paises'] = $this->acceso_model->get_paises();
                $data['msg'] = '<script type="text/javascript">$(document).ready(function(){$.notify({icon: "ti-info",message: "Usted se ha registrado exitosamente, debe esperar a que su usuario sea validado por un administrador, recibirá la notificación a su correo una vez sea aprobado.",timer: 10000});});</script>';
				$this->load->view('forms/login', $data);
            else:
                $data['titulo'] = 'Suscripcion';
                $data['paises'] = $this->acceso_model->get_paises();
				$data['msg'] = '<script type="text/javascript">$(document).ready(function(){$.notify({icon: "ti-info",message: "Ocurrió un error durante el proceso de registro, intente mas tarde."},{type: "warning",timer: 10000});});</script>';
				$this->load->view('forms/suscripcion', $data);
			endif;

		endif;

    }

    public function user_unique($usuario)
    {
        $consulta = $this->acceso_model->user_unique($usuario);

        if( $consulta ):
            return TRUE;
        else:
            $this->form_validation->set_message('user_unique', 'Este {field} ya está tomado');
			return FALSE;
        endif;
    }

    public function email_existe($data)
	{
		$consulta = $this->acceso_model->email_existe($data);
		if ( $consulta ):
			return TRUE;
		else:
			$this->form_validation->set_message('email_existe', 'Este {field} ya se encuentra registrado');
			return FALSE;
		endif;
    }
    
    public function asistente_pass()
    {
        $rules = array(
                    array(
                        'field' => 'email',
                        'label' => 'Correo Electrónico',
                        'rules' => 'required|valid_email|callback_email_existe_login',
                        'errors' => array(
                                    'required' => 'Campo %s requerido',
                                    'valid_email' => 'Formato de %s no válido'
                        )
                    )
                );

        $this->form_validation->set_rules($rules);

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        
        if( $this->form_validation->run() == FALSE ) :

            $data['titulo'] = 'Asistente para contraseña';
            $data['msg'] = ''; 
            $this->load->view('forms/asistente_password', $data);

        else:

            $email = $this->input->post('email');

            $to = $email;
            $subject = 'Cexpress - Has solicitado un cambio de clave';
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
                    <p>
                        <strong>Has solicitado un cambio de password,</strong><br><br>
                        
                            <a href="http://davidsototemplates.000webhostapp.com/reset_pass?e=' . $email . '" target="_blank">Click aqui para cambio de clave</a>

                        <br>

                        <div class="text-right">
                            <strong>Gracias por confiar en nuestros servicios.</strong><br>
                            <strong>CEO Maybet Ordonez</strong>
                        </div>
                    </p>
                    <hr>
                    <div class="text-center">
                        <small>
                            <small class="text-muted d-block">2018&copy; Cexpress Venezuela</small>
                            <small class="text-muted d-block">Para cualquier duda siempre cuenta con nuestro WhatsApp de atención al cliente +1 317 5720559</small>
                            <small class="text-muted d-block">Por favor, NO responda a este mensaje, es un envío automático.</small>
                        </small>
                    </div>
                </div>
            
              </body>
            </html>
            ';
            $headers =  'From: Cexpress' . "\r\n" .
			            'MIME-Version: 1.0' . "\r\n" .
			            'Content-type: text/html; charset=UTF-8' . "\r\n" .
			            'Reply-To: notReply' . "\r\n" .
			            'X-Mailer: PHP/'. "\r\n";
           

            @mail($to, $subject, $message, $headers);

            $data['titulo'] = 'Asistente para contraseña';
            $data['msg'] = '<script type="text/javascript">$(document).ready(function(){$.notify({icon: "ti-info",message: "Link enviado a tu correo exitosamente"},{type: "success",timer: 10000});});</script>';
            $this->load->view('forms/asistente_password', $data);

        endif;

    }

    public function reset_pass()
    {
        $rules = array(
                    array(
                        'field'  => 'password',
                        'label'  => 'Contraseña',
                        'rules'  => 'required|min_length[8]',
                        'errors' => array(
                                        'required'   => 'Campo %s requerido'
                        )
                    ),
                    array(
                        'field'  => 'password_conf',
                        'label'  => 'Contraseña',
                        'rules'  => 'required|matches[password]',
                        'errors' => array(
                                        'required' => 'Campo de confirmación requerido',
                                        'matches'  => 'La %s no coincide'
                        )
                    )
                );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        
        if( $this->form_validation->run() == FALSE ) :

            $data['msg'] = '';
            $data['titulo'] = 'Cambia tu contraseña';
            $this->load->view('forms/reset_password', $data);
            
        endif;

    }

    public function set_new_pass()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $consulta = $this->acceso_model->cambio_password($email, $password);

        if( $consulta ) :

            $data['titulo'] = 'Login';
            $data['msg'] = '<script type="text/javascript">$(document).ready(function(){$.notify({icon: "ti-info",message: "La contraseña ha sido cambiada exitosamente"},{type: "success",timer: 10000});});</script>';
            $this->load->view('forms/login', $data);

        else:

            $data['msg'] = '<script type="text/javascript">$(document).ready(function(){$.notify({icon: "ti-info",message: "Ocurrió un error, intente mas tarde"},{type: "warning",timer: 10000});});</script>';
            $data['titulo'] = 'Cambia tu contraseña';
            $this->load->view('forms/reset_password', $data);

        endif;

    }

    public function comprueba_select( $str )
	{
		if( $str == "false" ):
			$this->form_validation->set_message('comprueba_select', 'Campo Requerido');
            return FALSE;
		else:
			return TRUE;
		endif;
	}


}
