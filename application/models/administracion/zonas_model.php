<?php

/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 12:50
 */
class Zonas_model extends CI_Model
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
            ->join('tb_local locales', 'locales.ID=zonas.TB_LOCAL_ID', 'INNER');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ingresar_zonas($descripcion, $nombre, $local)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('TB_LOCAL_ID', $local);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert('tb_zona');
        return $this->db->insert_id();
    }

    public function cambia_estado_zonas($id, $estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_zona');
    }

    public function editar_zonas($id, $descripcion, $nombre, $local)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('TB_LOCAL_ID', $local);
        $this->db->where('ID', $id);
        return $this->db->update('tb_zona');
    }

    public function obtener_listado_zona_local($id_local)
    {
        $this->db->select('
                            zonas.ID,
                            zonas.NOMBRE,
                            zonas.DESCRIPCION,
                            zonas.ACTIVO,
                            locales.NOMBRE LOCAL,
                            locales.ID ID_LOCAL,
                            (SELECT COUNT(*) FROM tb_puntos_zona puntos_zona where puntos_zona.TB_ZONA_ID=zonas.ID AND puntos_zona.ACTIVO=\'S\') CANTIDAD_PUNTOS
                ')
            ->from('tb_zona zonas')
            ->join('tb_local locales', 'locales.ID=zonas.TB_LOCAL_ID', 'INNER')
            ->where("locales.ID", $id_local);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function obtener_detalle_zona($id_zona)
    {
        $this->db->select('
                            puntos_zona.LONGITUD,
                            puntos_zona.LATITUD
                ')
            ->from('tb_puntos_zona puntos_zona')
            ->where("puntos_zona.TB_ZONA_ID", $id_zona)
            ->where("puntos_zona.ACTIVO", 'S');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function obtener_detalles_zonas($id_zonas)
    {
        $this->db->select('
                            puntos_zona.LONGITUD,
                            puntos_zona.LATITUD,
                            puntos_zona.TB_ZONA_ID
                ')
            ->from('tb_puntos_zona puntos_zona')
            ->where("puntos_zona.TB_ZONA_ID IN ($id_zonas)")
            ->where("puntos_zona.ACTIVO", 'S');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function guardar_detalle_zona($longitud, $latitud, $id_zona)
    {
        $this->db->set('LONGITUD', $longitud);
        $this->db->set('LATITUD', $latitud);
        $this->db->set('TB_ZONA_ID', $id_zona);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert('tb_puntos_zona');
        return $this->db->insert_id();
    }

    public function limpieza_detalle_zona($id_zona)
    {
        $this->db->set('ACTIVO', 'N');
        $this->db->where('TB_ZONA_ID', $id_zona);
        return $this->db->update('tb_puntos_zona');
    }
}