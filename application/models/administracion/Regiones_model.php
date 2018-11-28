<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 0:16
 */
class Regiones_model extends CI_Model
{
    public function obtener()
    {
        $this->db->select('*')
            ->from('tb_region');
        $query = $this->db->get();
        return $query->result();
    }
    public function obtener_listado_regiones()
    {
        $this->db->select('
                            regiones.ID,
                            regiones.DESCRIPCION,
                            regiones.ACTIVO
                ')
            ->from('tb_region regiones');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function ingresar_regiones($descripcion)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert('tb_region');
        return $this->db->insert_id();
    }
    public function cambia_estado_regiones($id,$estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_region');
    }
    public function editar_regiones($id, $descripcion)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->where('ID', $id);
        return $this->db->update('tb_region');
    }
    public function obtener_regiones()
    {
        $this->db->select('
                            regiones.ID,
                            regiones.DESCRIPCION,
                            regiones.ACTIVO
                ')
            ->from('tb_region regiones')
            ->where('ACTIVO', 'S');
        $query = $this->db->get();
        return $query->result_array();
    }
}