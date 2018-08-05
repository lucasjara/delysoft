<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 06-05-2018
 * Time: 1:11
 */

class inicio_model extends CI_Model
{
    function obtener()
    {
        $this->db->select("productos.NOMBRE_FANTASIA PRODUCTO, stock.SALDO CANTIDAD")
            ->from('stock')
            ->join("productos", 'productos.ID=stock.ID_PRODUCTO', 'INNER')
            ->order_by("stock.SALDO");
        $query = $this->db->get();
        return $query->result();
    }

    function ingresar($usuario)
    {
        $this->db->set('USUARIO', $usuario);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert("usuarios");
        return $this->db->insert_id();
    }

    function actualizar($id, $perfil)
    {
        $this->db->set('ID_PERFIL', $perfil);
        $this->db->where('ID', $id);
        return $this->db->update('usuarios');
    }

    function transaccion()
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