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
            $CI->form_validation->set_message('id','Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado'){
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
            $CI->form_validation->set_message('id','Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado'){
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
            $CI->form_validation->set_message('id','Id', 'Error al enviar la peticion');
        }
        if ($tipo === 'estado'){
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