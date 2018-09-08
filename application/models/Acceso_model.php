<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceso_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function email_existe($email)
    {
        $consulta = $this->db->get_where('usuario', array('email' => $email));
        if( $consulta->num_rows() > 0 ):
            return FALSE;
        else:
            return TRUE;
        endif;
    }

    public function suscripcion($nombre, $apellido, $email, $password, $pais, $telefono, $tipo_doc, $doc_nmro, $usuario)
    {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $data = array(
                    'nombre'         => $nombre,
                    'apellido'       => $apellido,
                    'email'          => $email,
                    'password'       => $pass_hash,
                    'nacionalidad'   => $pais,
                    'telefono'       => $telefono,
                    'tipo_documento' => $tipo_doc,
                    'dni'            => $doc_nmro,
                    'usuario'        => $usuario,
                    'role'           => 4
        );
        $consulta = $this->db->insert('usuario', $data);
        return $consulta;
    }

    public function verifica_password($email, $password)
    {
        $consulta = $this->db->get_where('usuario', array('email' => $email ));
        if( $consulta->num_rows() > 0 ) :
            $row = $consulta->row();
            if ( password_verify($password, $row->password) ):
                return TRUE;
            else:
                return FALSE;
            endif;
        endif;
    }

    public function get_paises()
    {
        $consulta = $this->db->get('pais');
        return $consulta->result_array();
    }

    public function recupera_usuario($email)
    {
        $consulta = $this->db->get_where('usuario', array('email' => $email));
        return $consulta->row();
    }

    public function cambio_password($email, $password)
    {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

        $data = array(
                    'password' => $pass_hash
        );

        $this->db->where('email', $email);
        $this->db->update('usuario', $data);

        return TRUE;

    }

    public function user_unique($usuario)
    {
        $consulta = $this->db->get_where('usuario', array('usuario' => $usuario));

        if( $consulta->num_rows() > 0 ):
            return FALSE;
        else:
            return TRUE;
        endif;

    }

    public function conectar( $id )
    {
        $data = array(
                'conectado' => 1,
                'ultima_conexion' => date('d/m/Y')
        );

        $this->db->where('id', $id);
        $consulta = $this->db->update('usuario', $data);
        return $consulta;
    }

}