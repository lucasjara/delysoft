<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 24-08-2018
 * Time: 19:12
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
if (!function_exists('validarUsuario')) {
    function validarUsuario($post = true) {
        $CI =& get_instance();
        $validaPost = ($post) ? $CI->input->post() : true;
        return ($validaPost);
    }
}