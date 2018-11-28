<?php

/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 15:27
 */
class Pedidos_model extends CI_Model
{
    public function obtener()
    {
        $this->db->select('*')
            ->from('tb_pedido_enc');
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_listado_pedidos()
    {
        $this->db->select('
                            pedido_enc.ID,
                            locales.ID ID_LOCAL, 
                            locales.NOMBRE LOCAL,
                            pedido_enc.FECHA,
                            pedido_enc.TOTAL,
                            estado_pedido.ID ID_ESTADO_PEDIDO, 
                            estado_pedido.NOMBRE ESTADO_PEDIDO,
                            usuario1.ID ID_USUARIO_ENCARGADO, 
                            usuario1.NOMBRE USUARIO_ENCARGADO,
                            usuario2.ID ID_USUARIO_SOLICITA, 
                            usuario2.NOMBRE USUARIO_SOLICITA,
                            pedido_enc.ACTIVO
                ')
            ->from('tb_pedido_enc pedido_enc')
            ->join('tb_local locales', 'locales.ID=pedido_enc.TB_LOCAL_ID', 'INNER')
            ->join('tb_estado_pedido estado_pedido', 'estado_pedido.ID=pedido_enc.TB_ESTADO_PEDIDO_ID', 'INNER')
            ->join('tb_usuario usuario1', 'usuario1.ID=pedido_enc.TB_USUARIO_ENCARGADO_ID', 'INNER')
            ->join('tb_usuario usuario2', 'usuario2.ID=pedido_enc.TB_USUARIO_SOLICITA_ID', 'INNER');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ingresar_pedidos($descripcion)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->set('ACTIVO', 'S');
        $this->db->insert('tb_pedido_enc');
        return $this->db->insert_id();
    }

    public function cambia_estado_pedidos($id, $estado)
    {
        $this->db->set('ACTIVO', $estado);
        $this->db->where('ID', $id);
        return $this->db->update('tb_pedido_enc');
    }

    public function editar_pedidos($id, $descripcion)
    {
        $this->db->set('DESCRIPCION', $descripcion);
        $this->db->where('ID', $id);
        return $this->db->update('tb_pedido_enc');
    }

    public function obtener_encabezado_pedido($id)
    {
        $this->db->select('
                            pedido_enc.ID,
                            locales.NOMBRE LOCAL,
                            pedido_enc.FECHA,
                            pedido_enc.TOTAL,
                            pedido_enc.NUMERO_IP IP, 
                            estado_pedido.NOMBRE ESTADO_PEDIDO, 
                            usuario1.NOMBRE USUARIO_ENCARGADO,
                            usuario2.NOMBRE USUARIO_SOLICITA,
                            pedido_enc.ACTIVO
                ')
            ->from('tb_pedido_enc pedido_enc')
            ->join('tb_local locales', 'locales.ID=pedido_enc.TB_LOCAL_ID', 'INNER')
            ->join('tb_estado_pedido estado_pedido', 'estado_pedido.ID=pedido_enc.TB_ESTADO_PEDIDO_ID', 'INNER')
            ->join('tb_usuario usuario1', 'usuario1.ID=pedido_enc.TB_USUARIO_ENCARGADO_ID', 'INNER')
            ->join('tb_usuario usuario2', 'usuario2.ID=pedido_enc.TB_USUARIO_SOLICITA_ID', 'INNER')
            ->where('pedido_enc.ID', $id);;
        $query = $this->db->get();
        return $query->result_array();
    }

    public function obtener_detalle_pedido($id)
    {
        $this->db->select('
                            pedido_detalle.ID,
                            productos.NOMBRE PRODUCTO,
                            pedido_detalle.CANTIDAD,
                            pedido_detalle.PRECIO,
                            (pedido_detalle.CANTIDAD*pedido_detalle.PRECIO) TOTAL,
                            pedido_detalle.ACTIVO
                        ')
            ->from('tb_pedido_det pedido_detalle')
            ->join('tb_producto productos', 'productos.ID=pedido_detalle.TB_PRODUCTO_ID', 'INNER')
            ->where('pedido_detalle.TB_PEDIDO_ENC_ID', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

}