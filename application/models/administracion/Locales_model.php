<?php

/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 1:04
 */
class Locales_model extends CI_Model
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
        $this->db->select(" usr_local.ID,
                            locales.NOMBRE LOCAL,
                            usuario.NOMBRE NOMBRE,
                            perfil.NOMBRE PERFIL,
                            usuario.USUARIO USUARIO,
                            perfil.ID ID_PERFIL,
                            usr_local.ACTIVO,
                            usuario.USUARIO")
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
        $this->db->set('TB_PERFIL_ID', 4);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert('tb_usuario_local');
        return $this->db->insert_id();
    }

    public function agregar_cargo_local($id_local, $usuario, $cargo)
    {
        $this->db->set('TB_USUARIO_ID', $usuario);
        $this->db->set('TB_LOCAL_ID', $id_local);
        $this->db->set('TB_PERFIL_ID', $cargo);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert('tb_usuario_local');
        return $this->db->insert_id();
    }

    public function obtener_datos_local($id)
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
            ->join('tb_ciudad ciudad', 'ciudad.ID=locales.TB_CIUDAD_ID', 'INNER')
            ->where('locales.ID', $id);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Comprueba si existe un local por configurar , devolvera resultado si ya existe uno configurado
     * @param $id_usuario
     * @return null
     */
    public function comprobar_local_configurado($id_usuario)
    {
        $this->db->select("usr_local.ID")
            ->from('tb_usuario_local usr_local')
            ->join("tb_local locales", "locales.ID=usr_local.TB_LOCAL_ID", 'INNER')
            ->join("tb_producto productos", "productos.TB_LOCAL_ID=locales.ID", 'INNER')
            ->where('productos.ACTIVO', "S")
            ->where('locales.ACTIVO', "S")
            ->where('usr_local.ACTIVO', "S")
            ->where('usr_local.TB_USUARIO_ID', $id_usuario)
            ->where('usr_local.TB_PERFIL_ID', 4);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    /**
     * Obtiene local asociado al usuario
     * @param $id_usuario
     * @return null
     */
    public function obtener_local_configurar($id_usuario)
    {
        $this->db->select("locales.ID")
            ->from('tb_usuario_local usr_local')
            ->join("tb_local locales", "locales.ID=usr_local.TB_LOCAL_ID", 'INNER')
            ->where('locales.ACTIVO', "S")
            ->where('usr_local.ACTIVO', "S")
            ->where('usr_local.TB_USUARIO_ID', $id_usuario)
            ->where('usr_local.TB_PERFIL_ID', 4);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result()[0]->ID : null;
    }

    /**
     * Comprueba si tiene un local
     * @param $id_usuario
     * @return null
     */
    public function comprobar_primer_local($id_usuario)
    {
        $this->db->select("usr_local.ID")
            ->from('tb_usuario_local usr_local')
            ->join("tb_local locales", "locales.ID=usr_local.TB_LOCAL_ID", 'INNER')
            ->join("tb_producto productos", "productos.TB_LOCAL_ID=locales.ID", 'INNER')
            ->where('locales.ACTIVO', "S")
            ->where('usr_local.ACTIVO', "S")
            ->where('usr_local.TB_USUARIO_ID', $id_usuario)
            ->where('usr_local.TB_PERFIL_ID', 4);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    /**
     *  Comprobamos que el local tenga al menos un producto disponible
     * @param $id_local
     * @return null
     */
    public function validar_producto_activo($id_local)
    {
        $this->db->select("*")
            ->from('tb_local locales')
            ->join("tb_producto productos", "productos.TB_LOCAL_ID=locales.ID", 'INNER')
            ->where('locales.ACTIVO', "S")
            ->where('productos.ACTIVO', "S")
            ->where('locales.ID', $id_local);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function obtener_historico_pedidos_local($id_local)
    {
        $this->db->select('
                            enc.FECHA,
                            count(*) CANTIDAD
                        ')
            ->from('tb_pedido_enc enc')
            ->where('enc.TB_LOCAL_ID', $id_local)
            ->where('enc.TB_ESTADO_PEDIDO_ID', 5)
            ->group_by("enc.FECHA");
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function obtener_cantidad_pedidos_zona_local($id_local)
    {
        $this->db->select('
                             zona.NOMBRE ZONA,
                             COUNT(*) CANTIDAD_PEDIDOS,
                             SUM(det.PRECIO*det.CANTIDAD) VALORIZADO
                        ')
            ->from('tb_pedido_enc enc')
            ->join("tb_pedido_det det", "det.TB_PEDIDO_ENC_ID=enc.ID", 'INNER')
            ->join("tb_zona_producto zona_prod", "zona_prod.TB_PRODUCTO_ID=det.TB_PRODUCTO_ID", 'INNER')
            ->join("tb_zona zona", "zona.ID=zona_prod.TB_ZONA_ID", 'INNER')
            ->where('enc.TB_LOCAL_ID', $id_local)
            ->where('enc.TB_ESTADO_PEDIDO_ID', 5)
            ->where('enc.ACTIVO', 'S')
            ->where('zona.ACTIVO', 'S')
            ->group_by("zona.NOMBRE");
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function comprobar_cargo_local($id_local, $usuario, $cargo)
    {
        $this->db->select(" usr_local.ID")
            ->from('tb_usuario_local usr_local')
            ->join("tb_local locales", "locales.ID=usr_local.TB_LOCAL_ID", 'INNER')
            ->join("tb_usuario usuario", "usuario.ID=usr_local.TB_USUARIO_ID", 'INNER')
            ->join("tb_perfil perfil", "perfil.ID=usr_local.TB_PERFIL_ID", 'INNER')
            ->where('usr_local.TB_LOCAL_ID', $id_local)
            ->where('usr_local.TB_USUARIO_ID', $usuario)
            ->where('usr_local.TB_PERFIL_ID', $cargo);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }
    public function cambia_estado_cargo_local($id, $estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_usuario_local');
    }
    public function obtener_zonas_colores($id_local){
        $this->db->select('
                            zonas.ID,
                            zonas.COLOR,
                            zonas.NOMBRE ZONA
                ')
            ->from('tb_zona zonas')
            ->join('tb_local locales', 'locales.ID=zonas.TB_LOCAL_ID', 'INNER')
            ->where('zonas.ACTIVO','S')
            ->where("locales.ID", $id_local);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }
}