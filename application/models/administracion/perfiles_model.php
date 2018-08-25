<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 24-08-2018
 * Time: 21:17
 */

class perfiles_model extends CI_Model
{
    public function obtener()
    {
        $this->db->select("*")
            ->from('tb_perfil');
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_perfiles()
    {
        $this->db->select("
            perfil.ID,
            perfil.NOMBRE
            ")
            ->from('tb_perfil perfil')
            ->where('perfil.ACTIVO', 'S')
        ->order_by("perfil.NOMBRE");
        $query = $this->db->get();
        return $query->result_array();
    }
}