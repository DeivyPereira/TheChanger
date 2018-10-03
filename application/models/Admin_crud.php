<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_crud extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Sección Registrar País

    public function get_paises( $pais = FALSE )
    {
        if( $pais == FALSE ):
            return $this->db->get('pais')->result_array();
        else:
            return $this->db->get_where('pais', array( 'pais' => $pais ))->row();
        endif;
    }

    public function add_pais( $nombre, $moneda, $diminutivo, $bancos )
    {
        $data = array(
                    'pais'       => $nombre,
                    'moneda'     => $moneda,
                    'diminutivo' => $diminutivo,
                    'status'     => 1,
                    'created'    => date('d/m/Y')
        );

        $consulta = $this->db->insert('pais', $data);
        
        if( $consulta ):
            $data = array(
                        'pais'   => $nombre,
                        'moneda' => $diminutivo,
                        'status' => 1
            );
            
            $tax = $this->db->insert( 'tax', $data );

            if( $tax ):

                if( FALSE != $bancos ):
                    $banco = explode( ",", $bancos );
                    foreach( $banco as $str ):
                        $data = array(
                                'banco'  => $str,
                                'pais'   => $nombre,
                                'status' => 1
                        );
                        $this->db->insert( 'banco_pais', $data);
                    endforeach;
                    return TRUE;
                endif;

                return TRUE;
            else:
                return FALSE;
            endif;

        else:
            return FALSE;
        endif;
    }

    public function update_pais($id, $nombre, $moneda, $diminutivo)
    {
        $data = array(
                    'pais'       => $nombre,
                    'moneda'     => $moneda,
                    'diminutivo' => $diminutivo,
                    'modified'   => date('d/m/Y')
        );

        $this->db->where('id', $id);
        $consulta = $this->db->update('pais', $data);
        if( $consulta ):
            $consulta_admin_banco = $this->db->get_where( 'admin_banco', array( 'pais' => $nombre ) )->num_rows();
            $consulta_usuario_banco = $this->db->get_where( 'usuario_banco', array( 'pais' => $nombre ) )->num_rows();
            if( $consulta_admin_banco > 0 ):
                $this->db->where( 'pais', $nombre );
                $this->db->update( 'admin_banco', array( 'diminutivo' => $diminutivo) );
            endif;
            if( $consulta_usuario_banco > 0 ):
                $this->db->where( 'pais', $nombre );
                $this->db->update( 'usuario_banco', array( 'diminutivo' => $diminutivo) );
            endif;
            return TRUE;
        else:
            return false;
        endif;

    }

    public function pais_status( $id, $status )
    {
        if( $status == 1 ):
            $this->db->where('id', $id);
            return $this->db->update('pais', array( 'status' => 0 ));
        elseif( $status == 0 ):
            $this->db->where('id', $id);
            return $this->db->update('pais', array( 'status' => 1 ));
        endif;
    }

    public function delete_pais( $id )
    {
        $pais = $this->db->get_where( 'pais', array( 'id' => $id ) )->row();

        if( $this->db->where( 'pais', $pais->pais )->delete('tax') ):
            return $this->db->where( 'id', $id )->delete('pais');
        else:
            return FALSE;
        endif;
    }

    public function eliminar_usuario( $id )
    {
        return $this->db->where( 'id', $id )->delete('usuario');
    }

    public function get_pais($id)
    {
        $consulta = $this->db->get_where('pais', array( 'id' => $id ));
        return $consulta->row();
    }

    // Sección control de usuarios

    public function get_usuarios( $per_page = FALSE, $segment= FALSE )
    {
        if( $per_page == FALSE && $segment == FALSE):
            $this->db->where( 'role', 2 );
            $this->db->or_where( 'role', 3 );
            $this->db->or_where( 'role', 4 );
            $consulta = $this->db->get('usuario');
            return $consulta->result_array();
        else:
            $this->db->where( 'role', 2 );
            $this->db->or_where( 'role', 3 );
            $this->db->or_where( 'role', 4 );
            $consulta = $this->db->get('usuario', $per_page, $segment);
            return $consulta->result_array();
        endif;
    }

    public function update_user_status($id, $status)
    {
        $status = $this->db->get_where('usuario', array( 'id' => $id ) )->row();
        $this->db->where( 'id', $id );
        if( $status->status == 0 ):   
            $consulta = $this->db->update('usuario', array( 'status' => 1 ));
            return $consulta;
        elseif( $status->status == 1 ):
            $consulta = $this->db->update('usuario', array( 'status' => 0 ));
            return $consulta;
        endif;
    }

    public function update_role($id, $role)
    {
        $this->db->where('id', $id);
        $consulta = $this->db->update('usuario', array('role' => $role ));
        return $consulta;
    }

    public function get_usuario( $id = FALSE, $buscar = FALSE ) // Obten un usuario o procesa unaa búsqueda
    {

        if( $id == FALSE ):

            $this->db->like( 'nombre', $buscar );
            $this->db->or_like( 'apellido', $buscar );
            $this->db->or_like( 'dni', $buscar );
            $this->db->or_like( 'usuario', $buscar );
            $this->db->or_like( 'nacionalidad', $buscar );
            
            $consulta = $this->db->get('usuario');
            return $consulta->result_array();

        elseif( $buscar == FALSE ):

            return $this->db->get_where('usuario', array( 'id' => $id ))->row();

        endif;

    }

    public function get_usuario_by_id( $id_cliente )
    {
        return $this->db->get_where('usuario', array( 'id' => $id_cliente ))->row();
    }

    public function usuario_verificado($id, $conf)
    {
        $this->db->where( 'id', $id );
        if( $conf == 0 ):
            $consulta = $this->db->update('usuario', array( 'confirmated' => 1 ) );
            return $consulta;
        elseif( $conf == 1 ):
            $consulta = $this->db->update('usuario', array( 'confirmated' => 0 ) );
            return $consulta;
        endif;
    }

    public function update_usuario($id, $email, $direccion, $ciudad, $nacionalidad, $codigo_postal, $telefono)
    {
        $data = array(
                'email'         => $email,
                'direccion'     => $direccion,
                'ciudad'        => $ciudad,
                'nacionalidad'  => $nacionalidad,
                'codigo_postal' => $codigo_postal,
                'telefono'      => $telefono
        );

        $this->db->where( 'id', $id );
        $consulta = $this->db->update('usuario', $data);
        return $consulta;
    }

    public function cambiar_password($id, $password)
    {
        $password_hash = password_hash( $password, PASSWORD_DEFAULT );
        $this->db->where('id', $id);
        $consulta = $this->db->update('usuario', array( 'password' => $password_hash ));
        return $consulta;
    }

    public function desconectar($id)
    {
        $this->db->where('id', $id);
        $consulta = $this->db->update('usuario', array( 'conectado' => 0 ));
        return $consulta;
    }

    public function usuario_row( $buscar = FALSE )
    {
        if ( $buscar == FALSE ):
            $this->db->where( 'role', 2 );
            $this->db->or_where( 'role', 3 );
            $this->db->or_where( 'role', 4 );
            $consulta = $this->db->get_where('usuario');
            return $consulta->num_rows();
        endif;
    }

    public function get_tasa( $pais )
    {
        return $this->db->get_where( 'tax', array( 'pais' => $pais ))->row_array();
    }

    public function actualizar_tasa( $pais, $tasa )
    {
        
        $consulta = $this->db->get_where( 'tax', array( 'pais' => $pais ) )->num_rows();
        
        $data = array(
                    'tasa'           => $tasa,
                    'status'         => 1,
                    'date'           => date('d/m/Y')
        );

        if( $consulta > 0):

            $this->db->where( 'pais', $pais );
            return $this->db->update( 'tax', $data );

        else:
            return $this->db->insert( 'tax', $data );
        endif;
    }

    public function get_cuentas( $id )
    {
        return $this->db->get_where( 'usuario_banco', array( 'id_usuario' => $id, 'status' => 1 ))->result_array();
    }

    public function get_banco_pais( $pais = FALSE )
    {
        if( $pais == FALSE ):
            return $this->db->get_where('banco_pais', array( 'status' => 1 ))->result_array();
        elseif( $pais == TRUE ):
            $this->db->select('banco');
            return $this->db->get_where('banco_pais', array( 'pais' => $pais, 'status' => 1))->result_array();
        endif;
    }

    public function get_bancos()
    {
        return $this->db->get( 'banco_pais' )->result_array();
    }

    public function update_banco( $id, $banco )
    {
        $this->db->where( 'id', $id );
        return $this->db->update( 'banco_pais', array( 'banco' => $banco ));
    }

    public function banco_status( $id, $status )
    {
        $this->db->where( 'id', $id );
        if( $status == 1 ):            
            return $this->db->update( 'banco_pais', array( 'status' => 0 ) );
        elseif( $status == 0 ):
            return $this->db->update( 'banco_pais', array( 'status' => 1 ) );
        endif;
    }

    public function delete_banco( $id ){
        $this->db->where( 'id', $id );
        return $this->db->delete( 'banco_pais' );
    }

    public function registrar_cuenta( $id, $alias, $cuenta, $titular, $tipo, $dni, $telefono, $email, $banco, $pais )
    {

        $consulta = $this->db->get_where( 'pais', array( 'pais' => $pais ))->row();

        $data = array(
                'id_usuario' => $id,
                'alias'      => $alias,
                'cuenta'     => $cuenta,
                'titular'    => $titular,
                'tipo'       => $tipo,
                'documento'  => $dni,
                'telefono'   => $telefono,
                'email'      => $email,
                'banco'      => $banco,
                'pais'       => $pais,
                'diminutivo' => $consulta->diminutivo,
                'status'     => 1
        );

        return $this->db->insert( 'usuario_banco', $data );
    }

    public function ultima_cuenta_usuario( $id )
    {
        return $this->db->order_by( 'id', 'DESC' )->get_where( 'usuario_banco', array( 'id_usuario' => $id ) )->row();
    }

    public function actualizar_cuenta( $id, $cuenta, $titular, $tipo, $dni, $telefono, $email )
    {
        $data = array(
                'cuenta'     => $cuenta,
                'titular'    => $titular,
                'tipo'       => $tipo,
                'documento'  => $dni,
                'telefono'   => $telefono,
                'email'      => $email,
        );

        $this->db->where( 'id', $id );
        return $this->db->update( 'usuario_banco', $data );
    }

    public function status_cuenta( $id, $status )
    {
        if( $status == 1 ):
            $this->db->where( 'id', $id );
            return $this->db->update('usuario_banco', array( 'status' => 0 ));
        elseif( $status == 0 ):
            $this->db->where( 'id', $id );
            return $this->db->update('usuario_banco', array( 'status' => 1 ));
        endif;
    }

    public function actualizar_cuenta_admin( $id, $cuenta, $titular, $tipo, $dni, $telefono, $email )
    {
            $data = array(
                'cuenta'     => $cuenta,
                'titular'    => $titular,
                'tipo'       => $tipo,
                'documento'  => $dni,
                'telefono'   => $telefono,
                'email'      => $email,
        );

        $this->db->where( 'id', $id );
        return $this->db->update( 'admin_banco', $data );
    }

    public function status_cuenta_admin( $id, $status )
    {
        if( $status == 1 ):
            $this->db->where( 'id', $id );
            return $this->db->update( 'admin_banco', array( 'status' => 0 ));
        elseif( $status == 0 ):
            $this->db->where( 'id', $id );
            return $this->db->update( 'admin_banco', array( 'status' => 1 ));
        endif;
    }
    

    public function registrar_cuenta_admin( $alias, $cuenta, $titular, $tipo, $dni, $telefono, $email, $banco, $pais, $monto )
    {

        $consulta = $this->db->get_where( 'pais', array( 'pais' => $pais ))->row();

        $data = array(
            'alias'      => $alias,
            'cuenta'     => $cuenta,
            'titular'    => $titular,
            'tipo'       => $tipo,
            'documento'  => $dni,
            'telefono'   => $telefono,
            'email'      => $email,
            'banco'      => $banco,
            'pais'       => $pais,
            'diminutivo' => $consulta->diminutivo,
            'monto'      => $monto,
            'status'     => 1
        );

        $insert = $this->db->insert( 'admin_banco', $data );

        if( $insert ):
            $this->db->order_by( 'id', 'DESC' );
            $consulta_ = $this->db->get_where( 'admin_banco', array( 'pais' => $pais ) )->row();
            $data = array(
                    'id_cuenta'   => $consulta_->id,
                    'monto'       => $monto,
                    'fecha'       => date('d/m/Y'),
                    'descripcion' => 'Fue registrada la cuenta en el sistema'
            );
            return $this->db->insert( 'estado_cuenta', $data );
        endif;

    }

    public function get_cuentas_admin( $pais = FALSE )
    {
        if( $pais == FALSE ):
            return $this->db->get('admin_banco')->result_array();
        else:
            return $this->db->get_where('admin_banco', array( 'pais' => $pais, 'status' => 1 ))->result_array();
        endif;
    }

    public function get_cuentas_admin_active()
    {
        return $this->db->get_where( 'admin_banco', array( 'status' => 1 ))->result_array();
    }

    public function cuentas_admin_activas()
    {
        return $this->db->get_where('admin_banco', array( 'status' => 1 ))->result_array();
    }

    public function buscar_banco_cliente( $id, $pais )
    {
        return $this->db->get_where( 'usuario_banco', array( 'id_usuario' => $id, 'pais' => $pais, 'status' => 1 ))->result_array();
    }

    public function get_paises_clientes()
    {
        return $this->db->get_where( 'usuario_banco', array( 'id_usuario' => $_SESSION['id_cexpress'] ))->result_array();
    }

    public function get_tax( $pais = FALSE )
    {
        if( $pais != FALSE ):
            return $this->db->get_where( 'tax', array( 'pais' => $pais ) )->result_array();
        elseif( $pais == FALSE ):
            return $this->db->get('tax')->result_array();
        endif;
    }

    public function montar_pedido( $id_cliente, $comprobante, $pais_receptor, $banco_receptor, $monto_pagado, $pais_beneficiario, $banco_beneficiario, $monto_beneficiario, $num_operacion, $monto_operacion, $diminutivo_receptor )
    {
        $data = array(
                'id_cliente'           => $id_cliente,
                'comprobante'          => $comprobante,
                'pais_receptor'        => $pais_receptor,
                'banco_receptor'       => $banco_receptor,
                'monto_pagado'         => $monto_pagado,
                'pais_beneficiario'    => $pais_beneficiario,
                'banco_beneficiario'   => $banco_beneficiario,
                'num_operacion'        => $num_operacion,
                'monto_beneficiario'   => $monto_beneficiario,
                'monto_operacion'      => $monto_operacion,
                'fecha_pedido'         => date('d/m/Y'),
                'diminutivo_pagado'    => $diminutivo_receptor,
                'status'               => 0,
                'notificacion'         => 1,
                'notificacion_usuario' => 0
        );

        return $this->db->insert('pedidos', $data);
    }

    public function pedido_last_id( $id )
    {
        $this->db->order_by( 'id', 'DESC' );
        return $this->db->get_where( 'pedidos', array( 'id_cliente' => $id ))->row();
    }

    public function complementos_row( $id )
    {
        return $this->db->get_where( 'pedidos_complemento', array( 'id_pedido' => $id ))->num_rows();
    }

    public function complementos( $id )
    {
        return $this->db->get_where( 'pedidos_complemento', array( 'id_pedido' => $id ))->result_array();
    }

    public function insert_cuenta_adicional( $id_pedido, $banco, $monto )
    {
        $data = array(
                'id_pedido' => $id_pedido,
                'banco'     => $banco,
                'monto'     => $monto
        );
        $this->db->insert( 'pedidos_complemento', $data );
    }

    public function get_pedidos( $id_pedido = FALSE )
    {
        if( $id_pedido == FALSE ):
            $this->db->order_by( 'id', 'DESC' );
            return $this->db->get_where('pedidos', array( 'archivo' => 0 ))->result_array();
        else:
            return $this->db->get_where('pedidos', array( 'id' => $id_pedido ))->row();
        endif;
    }

    public function get_pedidos_operador()
    {
        return $this->db->get_where('pedidos', array('status' => 1 ))->result_array();
    }

    public function get_last_pedidos()
    {
        $this->db->order_by( 'id', 'DESC' );
        return $this->db->get_where( 'pedidos', array( 'archivo' => 0, 'status' => 1 ), 5 )->result_array();
    }

    public function get_pedido_id( $id_usuario )
    {
        $this->db->where( 'id_cliente', $id_usuario );
        $this->db->order_by( 'id', 'DESC' );
        return $this->db->get( 'pedidos' )->row();
    }

    public function get_banco_receptor( $id_banco = FALSE )
    {
        if( $id_banco != FALSE ):
            return $this->db->get_where('admin_banco', array( 'id' => $id_banco ))->row();
        else:
            return $this->db->get( 'admin_banco' )->result_array();
        endif;
    }

    public function get_banco_beneficiario( $id_banco = FALSE, $id_cliente = FALSE )
    {
        if( $id_banco != FALSE && $id_cliente == FALSE ):
            return $this->db->get_where('usuario_banco', array( 'id' => $id_banco ))->row();
        elseif( $id_cliente != FALSE && $id_banco == FALSE ):
            return $this->db->get_where( 'usuario_banco', array( 'id_usuario' => $id_cliente ) )->result_array();
        elseif( $id_cliente == FALSE && $id_banco == FALSE ):
            return $this->db->get('usuario_banco')->result_array();
        endif;
    }

    public function get_cuentas_venezuela()
    {
        return $this->db->get_where('banco_pais', array( 'pais' => 'Venezuela') )->result_array();
    }

    public function get_pedido_cliente( $id )
    {   
        return $this->db->get_where( 'pedidos', array( 'id_cliente' => $id ) )->result_array();
    }

    public function archivar_pedido( $id )
    {
        $pedido = $this->db->get_where('pedidos', array( 'id' => $id ))->row();
        if( $pedido->archivo == 0 ):
            $this->db->where( 'id', $id );
            return $this->db->update( 'pedidos', array( 'archivo' => 1 ));
        else:
            $this->db->where( 'id', $id );
            return $this->db->update( 'pedidos', array( 'archivo' => 0 ));
        endif;
    }

    public function get_pedidos_search( $buscar )
    {
        $this->db->like( 'nombre', $buscar );
        $this->db->or_like( 'apellido', $buscar );
        $consulta = $this->db->get( 'usuario' )->result_array();
        
        $this->db->or_like( 'id', $buscar );
        foreach( $consulta as $usuario ):
            $this->db->or_like( 'id_cliente', $usuario['id'] );        
        endforeach;
        return $this->db->get( 'pedidos' )->result_array();

    }

    public function get_pedidos_archivos()
    {
        return $this->db->get_where('pedidos', array( 'archivo' => 1 ))->result_array();
    }

    public function actualizar_pedido( $id, $status, $mensaje, $monto_receptor, $monto_beneficiario, $id_cuenta, $usuario, $banco_venezuela )
    {
        $data = array(
                'status'  => $status,
                'mensaje' => $mensaje
        );
        $this->db->where( 'id', $id );
        $consulta = $this->db->update( 'pedidos', $data );

        if( $consulta ):
        
            if( $banco_venezuela != 'false' ):

                $this->db->order_by( 'id', 'DESC' );
                $monto_act = $this->db->get_where( 'estado_cuenta', array( 'id_cuenta' => $id_cuenta ) )->row();
                $monto = $monto_act->monto + $monto_receptor;
                $data = array(
                            'id_cuenta'      => $id_cuenta,
                            'monto_variable' => $monto_receptor,
                            'monto'          => $monto,
                            'fecha'          => date('d/m/Y'),
                            'descripcion'    => 'Pago Aceptado - ' . $usuario . ' - Id Pedido: ' . $id
                );
                
                $banco_ext = $this->db->insert( 'estado_cuenta', $data );

                if( $banco_ext ):
                    $this->db->order_by( 'id', 'DESC' );
                    $monto_vef = $this->db->get_where( 'estado_cuenta', array( 'id_cuenta' => $banco_venezuela ))->row();
                    $monto_ = $monto_vef->monto + ( $monto_beneficiario * -1);
                    $data = array(
                        'id_cuenta'      => $banco_venezuela,
                        'monto_variable' => $monto_beneficiario * -1,
                        'monto'          => $monto_,
                        'fecha'          => date('d/m/Y'),
                        'descripcion'    => 'Pago realizado - ' . $usuario . ' - Id Pedido: ' . $id
                    );
    
                    return $this->db->insert( 'estado_cuenta', $data );
                
                endif;
                
                
            else:

                return TRUE;

            endif;
                    
        endif;
            
    }

    public function get_estado_cuenta( $id, $mes, $ano )
    {
        $this->db->like( 'fecha', '/' . $mes . '/' . $ano );
        return $this->db->get_where( 'estado_cuenta', array( 'id_cuenta' => $id ))->result_array();

    }

    public function get_cuenta_admin_id( $id )
    {
        return $this->db->get_where( 'admin_banco', array( 'id' => $id ) )->row();
    }

    public function get_banco_venezuela()
    {
        return $this->db->get_where( 'admin_banco', array( 'pais' => 'Venezuela' ))->result_array();
    }

    public function get_noti_num_rows()
    {
        return $this->db->get( 'pedidos', 10 )->num_rows();
    }

    public function get_pedidos_nuevos()
    {
        return $this->db->get( 'pedidos', 10 )->result_array();
    }

    public function pedidos_noti_acep_num_rows()
    {
        return $this->db->get_where( 'pedidos', array( 'status' => 1 ), 10 )->num_rows();
    }

    public function get_pedidos_aceptados()
    {
        return $this->db->get_where( 'pedidos', array( 'status' => 1 ), 10 )->result_array();
    }

    public function remove_notification( $id )
    {
        $this->db->where( 'id', $id );
        return $this->db->update( 'pedidos', array( 'notificacion' => 0 ));
    }

    public function get_noti_num_rows_usuario( $id )
    {
        return $this->db->get_where( 'pedidos', array( 'notificacion_usuario' => 1, 'id_cliente' => $id ) )->num_rows();
    }

    public function get_pedidos_noti_usuario( $id )
    {
        return $this->db->get_where( 'pedidos', array( 'notificacion_usuario' => 1, 'id_cliente' => $id ) )->result_array();
    }

    public function borrar_notificacion_usuario( $id )
    {
        $this->db->where( 'id', $id );
        return $this->db->update( 'pedidos', array( 'notificacion_usuario' => 0 ));
    }

    public function mostrar_notificacion( $id )
    {
        $this->db->where( 'id', $id );
        return $this->db->update( 'pedidos', array( 'notificacion_usuario' => 1 ));
    }

    public function get_usuarios_nuevos_rows()
    {
        return $this->db->get_where( 'usuario', array( 'confirmated' => 0 ) )->num_rows();
    }

    public function get_usuarios_nuevos()
    {
        return $this->db->get_where( 'usuario', array( 'confirmated' => 0 ) )->result_array();
    }

    public function usuario_verified( $id )
    {
        $this->db->where('id', $id);
        return $this->db->update('usuario', array( 'confirmated' => 1 ));
    }

    public function registar_nuevos_bancos( $pais, $bancos )
    {
        $banco = explode( ",", $bancos );
        foreach( $banco as $str ):
            $data = array(
                    'banco'  => $str,
                    'pais'   => $pais,
                    'status' => 1
            );
            $this->db->insert( 'banco_pais', $data);
        endforeach;
        return TRUE;
    }

    public function eliminar_cuenta_admin( $id )
    {
        $this->db->where( 'id', $id );
        return $this->db->delete('admin_banco');
    }

    public function verificar( $id, $documento )
    {
        return $this->db->where('id', $id)->update('usuario', array( 'verificado' => 1, 'confirma_img' => $documento ) );
    }

    public function verificacion( $id, $verificacion )
    {
        if( $verificacion == 0 ):
            return $this->db->where('id', $id)->update('usuario', array( 'verificado' => 0 ));
        elseif( $verificacion == 1 ):        
            return $this->db->where('id', $id)->update('usuario', array( 'verificado' => 2, 'confirma_img' => "" ));
        endif;
    }

    public function informa_operador( $id, $status, $mensaje )
    {
        $data = array(
            'status'       => $status,
            'mensaje'      => $mensaje
        );
        return $this->db->where( 'id', $id )->update( 'pedidos', $data );
    }

    public function registrar_cuenta_otros( $alias, $cuenta, $titular, $tipo, $dni, $telefono, $email, $banco, $pais )
    {
        $data = array(
            'alias'      => $alias,
            'cuenta'     => $cuenta,
            'titular'    => $titular,
            'tipo'       => $tipo,
            'documento'  => $dni,
            'telefono'   => $telefono,
            'email'      => $email,
            'banco'      => $banco,
            'pais'       => $pais,
            'diminutivo' => 'N/A',
            'monto'      => 0,
            'status'     => 1
        );

        return $this->db->insert( 'admin_banco', $data );

    }
}
