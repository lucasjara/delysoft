<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 17-09-2018
 * Time: 1:52
 */

class Productos_model extends CI_Model
{
    public function obtener()
    {
        $this->db->select('*')
            ->from('tb_producto');
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_listado_productos()
    {
        $this->db->select('
                            productos.ID,
                            productos.NOMBRE,
                            productos.DESCRIPCION,
                            productos.PRECIO,
                            productos.ACTIVO,
                            locales.NOMBRE LOCAL,
                            locales.ID ID_LOCAL
                ')
            ->from('tb_producto productos')
            ->join('tb_local locales','locales.ID=productos.TB_LOCAL_ID','INNER');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ingresar_productos($descripcion, $nombre, $precio,$id_local)
    {
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('PRECIO', $precio);
        $this->db->set('ACTIVO', 'S');
        $this->db->set('TB_LOCAL_ID', $id_local);
        $this->db->insert('tb_producto');
        return $this->db->insert_id();
    }

    public function cambia_estado_productos($id, $estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_producto');
    }

    public function editar_productos($id, $descripcion, $nombre, $precio,$id_local)
    {
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('PRECIO', $precio);
        $this->db->set('TB_LOCAL_ID', $id_local);
        $this->db->where('ID', $id);
        return $this->db->update('tb_producto');
    }

    public function obtener_listado_productos_local($id_local)
    {
        $this->db->select('
                            productos.ID,
                            productos.NOMBRE,
                            productos.DESCRIPCION,
                            productos.PRECIO,
                            productos.ACTIVO
                ')
            ->from('tb_producto productos')
            ->where('productos.TB_LOCAL_ID', $id_local);
        $query = $this->db->get();
        return $query->result_array();
    }
}