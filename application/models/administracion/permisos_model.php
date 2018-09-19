<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 25-08-2018
 * Time: 22:11
 */
class Permisos_model extends CI_Model
{
    public function obtener()
    {
        $this->db->select('*')
            ->from('tb_permisos');
        $query = $this->db->get();
        return $query->result();
    }
    public function obtener_listado_permisos()
    {
        $this->db->select('
                            permisos.ID,
                            permisos.NOMBRE,
                            permisos.DESCRIPCION,
                            permisos.URL,
                            permisos.ACTIVO
                ')
            ->from('tb_permisos permisos');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function ingresar_permisos($descripcion,$nombre,$url)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('URL', $url);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert('tb_permisos');
        return $this->db->insert_id();
    }
    public function cambia_estado_permisos($id,$estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_permisos');
    }
    public function editar_permisos($id, $descripcion,$nombre,$url)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('URL', $url);
        $this->db->where('ID', $id);
        return $this->db->update('tb_permisos');
    }
}
