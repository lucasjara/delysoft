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
                            ciudad.DESCRIPCION CIUDAD,
                            region.ID ID_REGION,
                            ciudad.ID ID_CIUDAD
                ')
            ->from('tb_local locales')
            ->join('tb_region region', 'region.ID=locales.TB_REGION_ID', 'INNER')
            ->join('tb_ciudad ciudad', 'ciudad.ID=locales.TB_CIUDAD_ID', 'INNER');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ingresar_locales($descripcion, $nombre, $region, $ciudad)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('ACTIVO', 'S');
        $this->db->set('TB_REGION_ID', $region);
        $this->db->set('TB_CIUDAD_ID', $ciudad);
        $this->db->insert('tb_local');
        return $this->db->insert_id();
    }

    public function cambia_estado_locales($id, $estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_local');
    }

    public function editar_locales($id, $descripcion, $nombre, $region, $ciudad)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('TB_REGION_ID', $region);
        $this->db->set('TB_CIUDAD_ID', $ciudad);
        $this->db->where('ID', $id);
        return $this->db->update('tb_local');
    }

    public function obtener_locales()
    {
        $this->db->select('
                            locales.ID,
                            locales.NOMBRE,
                            locales.DESCRIPCION,
                            locales.ACTIVO
                ')
            ->from('tb_local locales')
            ->where('ACTIVO', 'S');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function obtener_cargos_locales($id)
    {
        $this->db->select("locales.NOMBRE LOCAL, usuario.NOMBRE NOMBRE, perfil.NOMBRE PERFIL,usuario.USUARIO USUARIO
        , perfil.ID ID_PERFIL,usuario.ACTIVO, usuario.USUARIO")
            ->from('tb_usuario_local usr_local')
            ->join("tb_local locales", "locales.ID=usr_local.TB_LOCAL_ID", 'INNER')
            ->join("tb_usuario usuario", "usuario.ID=usr_local.TB_USUARIO_ID", 'INNER')
            ->join("tb_perfil perfil", "perfil.ID=usr_local.TB_PERFIL_ID", 'INNER')
            ->where('usuario.ACTIVO', "S")
            ->where('usr_local.TB_LOCAL_ID', $id);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }
    public function agregar_encargado_local($id_local, $usuario)
    {
        $this->db->set('TB_USUARIO_ID', $usuario);
        $this->db->set('TB_LOCAL_ID', $id_local);
        $this->db->set('TB_PERFIL_ID', 1);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert('tb_usuario_local');
        return $this->db->insert_id();
    }
}