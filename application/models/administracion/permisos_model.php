<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 25-08-2018
 * Time: 22:11
 */
class permisos_model extends CI_Model
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
                            permisos.DESCRIPCION,
                            permisos.ACTIVO
                ')
            ->from('tb_permisos permisos');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function ingresar_permisos($descripcion)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->insert('tb_permisos');
        return $this->db->insert_id();
    }
    public function cambia_estado_permisos($id,$estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_permisos');
    }
    public function editar_permisos($id, $descripcion)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->where('ID', $id);
        return $this->db->update('tb_permisos');
    }
}
                        