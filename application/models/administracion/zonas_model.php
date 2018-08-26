<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 12:50
 */
class zonas_model extends CI_Model
{
    public function obtener()
    {
        $this->db->select('*')
            ->from('tb_zona');
        $query = $this->db->get();
        return $query->result();
    }
    public function obtener_listado_zonas()
    {
        $this->db->select('
                            zonas.ID,
                            zonas.NOMBRE,
                            zonas.DESCRIPCION,
                            zonas.ACTIVO,
                            locales.NOMBRE LOCAL,
                            locales.ID ID_LOCAL
                ')
            ->from('tb_zona zonas')
            ->join('tb_local locales','locales.ID=zonas.TB_LOCAL_ID','INNER');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function ingresar_zonas($descripcion,$nombre,$local)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('TB_LOCAL_ID', $local);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert('tb_zona');
        return $this->db->insert_id();
    }
    public function cambia_estado_zonas($id,$estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_zona');
    }
    public function editar_zonas($id, $descripcion,$nombre,$local)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('TB_LOCAL_ID', $local);
        $this->db->where('ID', $id);
        return $this->db->update('tb_zona');
    }
}