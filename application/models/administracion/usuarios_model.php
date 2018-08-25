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
            ->join('tb_perfil perfil', 'perfil.ID=usuario.TB_PERFIL_ID','INNER');
        $query = $this->db->get();
        return $query->result_array();
    }

}