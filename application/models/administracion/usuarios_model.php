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

}