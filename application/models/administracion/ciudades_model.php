<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 0:26
 */

class ciudades_model extends CI_Model
{
    public function obtener()
    {
        $this->db->select('*')
            ->from('tb_ciudad');
        $query = $this->db->get();
        return $query->result();
    }
    public function obtener_listado_ciudades()
    {
        $this->db->select('
                            ciudades.ID,
                            ciudades.DESCRIPCION,
                            ciudades.ACTIVO
                ')
            ->from('tb_ciudad ciudades');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function ingresar_ciudades($descripcion)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert('tb_ciudad');
        return $this->db->insert_id();
    }
    public function cambia_estado_ciudades($id,$estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_ciudad');
    }
    public function editar_ciudades($id, $descripcion)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->where('ID', $id);
        return $this->db->update('tb_ciudad');
    }
}