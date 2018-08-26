<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 1:04
 */
class locales_model extends CI_Model
{
    public function obtener()
    {
        $this->db->select('*')
            ->from('tb_local');
        $query = $this->db->get();
        return $query->result();
    }
    public function obtener_listado_locales()
    {
        $this->db->select('
                            locales.ID,
                            locales.NOMBRE,
                            locales.DESCRIPCION,
                            locales.ACTIVO,
                            region.DESCRIPCION REGION,
                            ciudad.DESCRIPCION CIUDAD
                ')
            ->from('tb_local locales')
            ->join('tb_region region','region.ID=locales.TB_REGION_ID','INNER')
            ->join('tb_ciudad ciudad','ciudad.ID=locales.TB_CIUDAD_ID','INNER');;
        $query = $this->db->get();
        return $query->result_array();
    }
    public function ingresar_locales($descripcion,$nombre,$region,$ciudad)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('ACTIVO', 'S');
        $this->db->set('TB_REGION_ID', $region);
        $this->db->set('TB_CIUDAD_ID', $ciudad);
        $this->db->insert('tb_local');
        return $this->db->insert_id();
    }
    public function cambia_estado_locales($id,$estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_local');
    }
    public function editar_locales($id, $descripcion,$nombre,$region,$ciudad)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('TB_REGION_ID', $region);
        $this->db->set('TB_CIUDAD_ID', $ciudad);
        $this->db->where('ID', $id);
        return $this->db->update('tb_local');
    }
}