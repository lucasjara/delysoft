<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 24-08-2018
 * Time: 20:30
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
if (!function_exists('form_usuario')) {
    /**
     * @param $tipo =  campo para saber el tipo de validacion es para agregar o editar o cambiar estado
     * @return stdClass = campos con resultado de validacion
     */
    function form_usuario($tipo)
    {
        $CI =& get_instance();
        $respuesta = new stdClass();
        if ($tipo === 'editar' || $tipo === 'estado') {
            $CI->form_validation->set_rules("id", "Id", "required");
            $CI->form_validation->set_message('id', 'Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado') {
            $CI->form_validation->set_rules("estado", "Estado", "required|exact_length[1]");
        }
        if ($tipo === 'agregar' || $tipo === 'editar') {
            $CI->form_validation->set_rules("usuario", "Usuario", "required|min_length[5]|max_length[255]");
            // $CI->form_validation->set_rules("password", "Contraseña", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("nombre", "Nombre", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("perfil", "Perfil", "required|is_numeric|exact_length[1]");
            $CI->form_validation->set_rules("correo", "Correo", "required|min_length[5]|max_length[255]");
        }
        if ($CI->form_validation->run() != false) {
            $respuesta->respuesta = 'S';
        } else {
            $respuesta->respuesta = 'N';
            $respuesta->mensaje = validation_errors();;
        }
        return $respuesta;
    }
}
if (!function_exists('form_permisos')) {
    /**
     * @param $tipo =  campo para saber el tipo de validacion es para agregar o editar o cambiar estado
     * @return stdClass = campos con resultado de validacion
     */
    function form_permisos($tipo)
    {
        $CI =& get_instance();
        $respuesta = new stdClass();
        if ($tipo === 'editar' || $tipo === 'estado') {
            $CI->form_validation->set_rules("id", "Id", "required");
            $CI->form_validation->set_message('id', 'Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado') {
            $CI->form_validation->set_rules("estado", "Estado", "required|exact_length[1]");
        }
        if ($tipo === 'agregar' || $tipo === 'editar') {
            $CI->form_validation->set_rules("descripcion", "Descripcion", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("nombre", "Nombre", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("url", "Url", "required|min_length[5]|max_length[255]");
        }
        if ($CI->form_validation->run() != false) {
            $respuesta->respuesta = 'S';
        } else {
            $respuesta->respuesta = 'N';
            $respuesta->mensaje = validation_errors();;
        }
        return $respuesta;
    }
}
if (!function_exists('form_perfiles')) {
    /**
     * @param $tipo =  campo para saber el tipo de validacion es para agregar o editar o cambiar estado
     * @return stdClass = campos con resultado de validacion
     */
    function form_perfiles($tipo)
    {
        $CI =& get_instance();
        $respuesta = new stdClass();
        if ($tipo === 'editar' || $tipo === 'estado') {
            $CI->form_validation->set_rules("id", "Id", "required");
            $CI->form_validation->set_message('id', 'Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado') {
            $CI->form_validation->set_rules("estado", "Estado", "required|exact_length[1]");
        }
        if ($tipo === 'agregar' || $tipo === 'editar') {
            $CI->form_validation->set_rules("descripcion", "Descripcion", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("nombre", "Nombre", "required|min_length[5]|max_length[255]");
        }
        if ($CI->form_validation->run() != false) {
            $respuesta->respuesta = 'S';
        } else {
            $respuesta->respuesta = 'N';
            $respuesta->mensaje = validation_errors();;
        }
        return $respuesta;
    }
}
if (!function_exists('form_regiones')) {
    /**
     * @param $tipo =  campo para saber el tipo de validacion es para agregar o editar o cambiar estado
     * @return stdClass = campos con resultado de validacion
     */
    function form_regiones($tipo)
    {
        $CI =& get_instance();
        $respuesta = new stdClass();
        if ($tipo === 'editar' || $tipo === 'estado') {
            $CI->form_validation->set_rules("id", "Id", "required");
            $CI->form_validation->set_message('id', 'Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado') {
            $CI->form_validation->set_rules("estado", "Estado", "required|exact_length[1]");
        }
        if ($tipo === 'agregar' || $tipo === 'editar') {
            $CI->form_validation->set_rules("descripcion", "Descripcion", "required|min_length[5]|max_length[255]");
        }
        if ($CI->form_validation->run() != false) {
            $respuesta->respuesta = 'S';
        } else {
            $respuesta->respuesta = 'N';
            $respuesta->mensaje = validation_errors();;
        }
        return $respuesta;
    }
}
if (!function_exists('form_ciudades')) {
    /**
     * @param $tipo =  campo para saber el tipo de validacion es para agregar o editar o cambiar estado
     * @return stdClass = campos con resultado de validacion
     */
    function form_ciudades($tipo)
    {
        $CI =& get_instance();
        $respuesta = new stdClass();
        if ($tipo === 'editar' || $tipo === 'estado') {
            $CI->form_validation->set_rules("id", "Id", "required");
            $CI->form_validation->set_message('id', 'Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado') {
            $CI->form_validation->set_rules("estado", "Estado", "required|exact_length[1]");
        }
        if ($tipo === 'agregar' || $tipo === 'editar') {
            $CI->form_validation->set_rules("descripcion", "Descripcion", "required|min_length[5]|max_length[255]");
        }
        if ($CI->form_validation->run() != false) {
            $respuesta->respuesta = 'S';
        } else {
            $respuesta->respuesta = 'N';
            $respuesta->mensaje = validation_errors();;
        }
        return $respuesta;
    }
}
if (!function_exists('form_estados_pedidos')) {
    /**
     * @param $tipo =  campo para saber el tipo de validacion es para agregar o editar o cambiar estado
     * @return stdClass = campos con resultado de validacion
     */
    function form_estados_pedidos($tipo)
    {
        $CI =& get_instance();
        $respuesta = new stdClass();
        if ($tipo === 'editar' || $tipo === 'estado') {
            $CI->form_validation->set_rules("id", "Id", "required");
            $CI->form_validation->set_message('id', 'Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado') {
            $CI->form_validation->set_rules("estado", "Estado", "required|exact_length[1]");
        }
        if ($tipo === 'agregar' || $tipo === 'editar') {
            $CI->form_validation->set_rules("descripcion", "Descripcion", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("nombre", "Nombre", "required|min_length[5]|max_length[255]");
        }
        if ($CI->form_validation->run() != false) {
            $respuesta->respuesta = 'S';
        } else {
            $respuesta->respuesta = 'N';
            $respuesta->mensaje = validation_errors();;
        }
        return $respuesta;
    }
}
if (!function_exists('form_locales')) {
    /**
     * @param $tipo =  campo para saber el tipo de validacion es para agregar o editar o cambiar estado
     * @return stdClass = campos con resultado de validacion
     */
    function form_locales($tipo)
    {
        $CI =& get_instance();
        $respuesta = new stdClass();
        if ($tipo === 'editar' || $tipo === 'estado' || $tipo === 'detalle') {
            $CI->form_validation->set_rules("id", "Id", "required");
            $CI->form_validation->set_message('id', 'Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado') {
            $CI->form_validation->set_rules("estado", "Estado", "required|exact_length[1]");
        }
        if ($tipo === 'agregar' || $tipo === 'editar') {
            $CI->form_validation->set_rules("descripcion", "Descripcion", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("nombre", "Nombre", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("region", "Nombre", "required|is_numeric");
            $CI->form_validation->set_rules("ciudad", "Nombre", "required|is_numeric");
        }
        if ($CI->form_validation->run() != false) {
            $respuesta->respuesta = 'S';
        } else {
            $respuesta->respuesta = 'N';
            $respuesta->mensaje = validation_errors();;
        }
        return $respuesta;
    }
}
if (!function_exists('form_zonas')) {
    /**
     * @param $tipo =  campo para saber el tipo de validacion es para agregar o editar o cambiar estado
     * @return stdClass = campos con resultado de validacion
     */
    function form_zonas($tipo)
    {
        $CI =& get_instance();
        $respuesta = new stdClass();
        if ($tipo === 'editar' || $tipo === 'estado') {
            $CI->form_validation->set_rules("id", "Id", "required");
            $CI->form_validation->set_message('id', 'Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado') {
            $CI->form_validation->set_rules("estado", "Estado", "required|exact_length[1]");
        }
        if ($tipo === 'agregar' || $tipo === 'editar') {
            $CI->form_validation->set_rules("descripcion", "Descripcion", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("nombre", "Nombre", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("local", "Local", "required|is_numeric");
        }
        if ($CI->form_validation->run() != false) {
            $respuesta->respuesta = 'S';
        } else {
            $respuesta->respuesta = 'N';
            $respuesta->mensaje = validation_errors();;
        }
        return $respuesta;
    }
}
if (!function_exists('form_pedido')) {
    /**
     * @param $tipo =  campo para saber el tipo de validacion es para agregar o editar o cambiar estado
     * @return stdClass = campos con resultado de validacion
     */
    function form_pedido($tipo)
    {
        $CI =& get_instance();
        $respuesta = new stdClass();
        if ($tipo === 'detalle_pedido' || $tipo === 'estado') {
            $CI->form_validation->set_rules("id", "Id", "required");
            $CI->form_validation->set_message('id', 'Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado') {
            $CI->form_validation->set_rules("estado", "Estado", "required|exact_length[1]");
        }
        if ($tipo === 'agregar' || $tipo === 'editar') {
            $CI->form_validation->set_rules("descripcion", "Descripcion", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("nombre", "Nombre", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("local", "Local", "required|is_numeric");
        }
        if ($CI->form_validation->run() != false) {
            $respuesta->respuesta = 'S';
        } else {
            $respuesta->respuesta = 'N';
            $respuesta->mensaje = validation_errors();;
        }
        return $respuesta;
    }
}
if (!function_exists('form_local_usuario')) {
    /**
     * @param $tipo =  campo para saber el tipo de validacion es para agregar o editar o cambiar estado
     * @return stdClass = campos con resultado de validacion
     */
    function form_local_usuario($tipo)
    {
        $CI =& get_instance();
        $respuesta = new stdClass();
        if ($tipo === 'agregar') {
            $CI->form_validation->set_rules("id", "Id", "required|is_numeric");
        }
        if ($tipo === 'agregar' || $tipo === 'agregar_cargo') {
            $CI->form_validation->set_rules("usuario", "Usuario", "required|is_numeric");
        }
        if ($tipo === 'agregar_cargo') {
            $CI->form_validation->set_rules("cargo", "Cargo", "required|is_numeric");
        }
        if ($CI->form_validation->run() != false) {
            $respuesta->respuesta = 'S';
        } else {
            $respuesta->respuesta = 'N';
            $respuesta->mensaje = validation_errors();;
        }
        return $respuesta;
    }
}
if (!function_exists('form_producto')) {
    /**
     * @param $tipo =  campo para saber el tipo de validacion es para agregar o editar o cambiar estado
     * @return stdClass = campos con resultado de validacion
     */
    function form_producto($tipo)
    {
        $CI =& get_instance();
        $respuesta = new stdClass();
        if ($tipo === 'editar' || $tipo === 'estado') {
            $CI->form_validation->set_rules("id", "Id", "required");
            $CI->form_validation->set_message('id', 'Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado') {
            $CI->form_validation->set_rules("estado", "Estado", "required|exact_length[1]");
        }
        if ($tipo === 'agregar' || $tipo === 'editar') {
            $CI->form_validation->set_rules("descripcion", "Descripcion", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("nombre", "Nombre", "required|min_length[5]|max_length[255]");
            $CI->form_validation->set_rules("precio", "Precio", "required|is_numeric");
        }
        if ($CI->form_validation->run() != false) {
            $respuesta->respuesta = 'S';
        } else {
            $respuesta->respuesta = 'N';
            $respuesta->mensaje = validation_errors();;
        }
        return $respuesta;
    }
}