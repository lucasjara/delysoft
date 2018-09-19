<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 06-05-2018
 * Time: 1:11
 */

class Inicio_model extends CI_Model
{
    public function obtener()
    {
        $this->db->select("*")
            ->from('tb_usuario');
        $query = $this->db->get();
        return $query->result();
    }

    public function ingresar($usuario)
    {
        $this->db->set('USUARIO', $usuario);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert("usuarios");
        return $this->db->insert_id();
    }

    public function actualizar($id, $perfil)
    {
        $this->db->set('ID_PERFIL', $perfil);
        $this->db->where('ID', $id);
        return $this->db->update('usuarios');
    }

    public function transaccion()
    {
        $this->db->trans_begin();
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}