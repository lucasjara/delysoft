<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 0:37
 */
class estados_pedidos_model extends CI_Model
{
    public function obtener()
    {
        $this->db->select('*')
            ->from('tb_estado_pedido');
        $query = $this->db->get();
        return $query->result();
    }
    public function obtener_listado_estados_pedidos()
    {
        $this->db->select('
                            estados_pedidos.ID,
                            estados_pedidos.NOMBRE,
                            estados_pedidos.DESCRIPCION,
                            estados_pedidos.ACTIVO
                ')
            ->from('tb_estado_pedido estados_pedidos');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function ingresar_estados_pedidos($descripcion,$nombre)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert('tb_estado_pedido');
        return $this->db->insert_id();
    }
    public function cambia_estado_estados_pedidos($id,$estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_estado_pedido');
    }
    public function editar_estados_pedidos($id, $descripcion,$nombre)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->where('ID', $id);
        return $this->db->update('tb_estado_pedido');
    }
}