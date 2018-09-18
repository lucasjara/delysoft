<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 19-08-2018
 * Time: 22:08
 */

class usuarios_model extends CI_Model
{
    public function obtener()
    {
        $this->db->select("*")
            ->from('tb_usuario');
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_listado_usuarios()
    {
        $this->db->select("
                            usuario.ID,
                            usuario.NOMBRE,
                            usuario.USUARIO,
                            usuario.CORREO,
                            usuario.PASSWORD,
                            usuario.ACTIVO,
                            perfil.ID ID_PERFIL,
                            perfil.NOMBRE PERFIL
            ")
            ->from('tb_usuario usuario')
            ->join('tb_perfil perfil', 'perfil.ID=usuario.TB_PERFIL_ID', 'INNER');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ingresar_usuario($usuario, $password, $nombre, $correo, $perfil)
    {
        $this->db->set('USUARIO', $usuario);
        $this->db->set('PASSWORD', '12345');
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('CORREO', $correo);
        $this->db->set('ACTIVO', 'S');
        $this->db->set('TB_PERFIL_ID', $perfil);
        $this->db->insert("tb_usuario");
        return $this->db->insert_id();
    }

    public function cambia_estado_usuario($id, $estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_usuario');
    }

    public function editar_usuario($id, $usuario, $nombre, $correo, $perfil)
    {
        $this->db->set('USUARIO', $usuario);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('CORREO', $correo);
        $this->db->set('TB_PERFIL_ID', $perfil);
        $this->db->where('ID', $id);
        return $this->db->update('tb_usuario');
    }

    public function busquedaUsuario($usuario)
    {
        $this->db->select("usuario.USUARIO,usuario.ID")
            ->from('tb_usuario usuario')
            ->where("usuario.ACTIVO", "S")
            ->like("usuario.USUARIO", $usuario);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_id_usuario($usuario, $password)
    {
        $this->db->select("usuario.ID")
            ->from('tb_usuario usuario')
            ->where("usuario.ACTIVO", "S")
            ->where("usuario.USUARIO", $usuario)
            ->where("usuario.PASSWORD", $password);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result()[0]->ID : null;
    }

    public function obtener_info_usuario($id_usuario)
    {
        $this->db->select(" 
                            usuario.ID,
                            usuario.NOMBRE,
                            usuario.USUARIO,
                            usuario.CORREO,
                            usuario.PASSWORD,
                            usuario.ACTIVO,
                            perfil.ID ID_PERFIL,
                            perfil.NOMBRE PERFIL
                            ")
            ->from('tb_usuario usuario')
            ->join('tb_perfil perfil', 'perfil.ID=usuario.TB_PERFIL_ID', 'INNER')
            ->where("usuario.ACTIVO", "S")
            ->where("usuario.ID", $id_usuario);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }
}