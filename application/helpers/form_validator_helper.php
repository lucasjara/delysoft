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
     * @param $tipo =  campo para saber el tipo de validacion es para agregar o editar
     * @return stdClass = campos con resultado de validacion
     */
    function form_usuario($tipo){
        $CI =& get_instance();
        $respuesta = new stdClass();
        $CI->form_validation->set_rules("usuario", "Usuario", "required|min_length[5]|max_length[255]");
        $CI->form_validation->set_rules("password", "contraseña", "required|min_length[5]|max_length[255]");
        $CI->form_validation->set_rules("nombres", "Nombres", "required|min_length[5]|max_length[255]");
        $CI->form_validation->set_rules("activo", "Activo", "required|exact_length[1]");
        $CI->form_validation->set_rules("perfil", "Perfil", "required|is_numeric|exact_length[1]");
        if ($CI->form_validation->run() != false) {
            $respuesta->respuesta = 'S';
        }else{
            $respuesta->respuesta = 'N';
            $respuesta->mensaje = validation_errors();;
        }
        return $respuesta;
    }
}