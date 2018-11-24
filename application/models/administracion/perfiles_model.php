<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 24-08-2018
 * Time: 21:17
 */

class Perfiles_model extends CI_Model
{
    public function obtener()
    {
        $this->db->select('*')
            ->from('tb_perfil');
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_listado_perfiles()
    {
        $this->db->select('
                            perfiles.ID,
                            perfiles.NOMBRE,
                            perfiles.DESCRIPCION,
                            perfiles.ACTIVO
                ')
            ->from('tb_perfil perfiles');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ingresar_perfiles($descripcion, $nombre)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->insert('tb_perfil');
        return $this->db->insert_id();
    }

    public function cambia_estado_perfiles($id, $estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_perfil');
    }

    public function editar_perfiles($id, $descripcion, $nombre)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('NOMBRE', $nombre);
        $this->db->where('ID', $id);
        return $this->db->update('tb_perfil');
    }

    public function obtener_perfiles()
    {
        $this->db->select("
                    perfil.ID,
                    perfil.NOMBRE
            ")
            ->from('tb_perfil perfil')
            ->where('perfil.ACTIVO', 'S')
            ->order_by("perfil.NOMBRE");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function obtener_perfiles_carga_inicial()
    {
        $this->db->select('
                            perfiles.ID,
                            perfiles.NOMBRE,
                            perfiles.DESCRIPCION,
                            perfiles.ACTIVO
                ')
            ->from('tb_perfil perfiles')
            ->where("perfiles.ID IN (4,5)")
            ->order_by("perfiles.ID", "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_permisos_perfil($id_perfil)
    {
        $this->db->select('
                            perm_perfiles.ID,
                            permisos.NOMBRE,
                            permisos.DESCRIPCION,
                            perm_perfiles.ACTIVO
                ')
            ->from('tb_permisos_perfil perm_perfiles')
            ->join("tb_permisos permisos","permisos.ID=perm_perfiles.TB_PERMISOS_ID","INNER")
            ->where("perm_perfiles.TB_PERFIL_ID",$id_perfil)
            ->order_by("permisos.NOMBRE");
        $query = $this->db->get();
        return $query->result();
    }

    public function asignar_permisos_perfil($id_perfil,$id_permiso)
    {
        $this->db->set('TB_PERFIL_ID', $id_perfil);
        $this->db->set('TB_PERMISOS_ID', $id_permiso);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert('tb_permisos_perfil');
        return $this->db->insert_id();
    }
    public function comprobar_permiso_perfil($id_perfil,$id_permiso)
    {
        $this->db->select('
                            perm_perfiles.ID
                ')
            ->from('tb_permisos_perfil perm_perfiles')
            ->join("tb_permisos permisos","permisos.ID=perm_perfiles.TB_PERMISOS_ID","INNER")
            ->where("perm_perfiles.TB_PERFIL_ID",$id_perfil)
            ->where("perm_perfiles.TB_PERMISOS_ID",$id_permiso);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }
}