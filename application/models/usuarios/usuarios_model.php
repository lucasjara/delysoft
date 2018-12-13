<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 30-11-2018
 * Time: 23:49
 */

class usuarios_model extends CI_Model
{
    public function obtener_usuario($user_id)
    {
        $this->db->select("
                            usuario.NOMBRE,
                            usuario.USUARIO,
                            usuario.CORREO,
                            usuario.PASSWORD
             ")
            ->from('tb_usuario usuario')
            ->where("usuario.ID", $user_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function registrar_usuario($nombre,$usuario,$password,$correo)
    {
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('USUARIO', $usuario);
        $this->db->set('PASSWORD', $password);
        $this->db->set('CORREO', $correo);
        $this->db->set('ACTIVO', 'S');
        $this->db->set('TB_PERFIL_ID', '3');
        $this->db->insert("tb_usuario");
        return $this->db->insert_id();
    }

    public function editar_usuario($id, $usuario, $nombre, $correo, $password)
    {
        $this->db->set('USUARIO', $usuario);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('CORREO', $correo);
        $this->db->set('PASSWORD', $password);
        $this->db->where('ID', $id);
        return $this->db->update('tb_usuario');
    }

    public function valida_password($id)
    {
        $this->db->select('usuario.PASSWORD')
            ->from('tb_usuario usuario')
            ->where("usuario.ID", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_listado()
    {
        $this->db->select('                                                    
                            locales.NOMBRE LOCAL,
                            pedido_enc.FECHA,
                            pedido_enc.TOTAL,
                            estado_pedido.NOMBRE ESTADO_PEDIDO,
                            pedido_enc.ACTIVO
                ')
            ->from('tb_pedido_enc pedido_enc')
            ->join('tb_local locales', 'locales.ID=pedido_enc.TB_LOCAL_ID', 'INNER')
            ->join('tb_estado_pedido estado_pedido', 'estado_pedido.ID=pedido_enc.TB_ESTADO_PEDIDO_ID', 'INNER')
            ->join('tb_usuario usuario1', 'usuario1.ID=pedido_enc.TB_USUARIO_ENCARGADO_ID', 'INNER')
            ->join('tb_usuario usuario2', 'usuario2.ID=pedido_enc.TB_USUARIO_SOLICITA_ID', 'INNER');
        $query = $this->db->get();
        return $query->result_array();
    }

}