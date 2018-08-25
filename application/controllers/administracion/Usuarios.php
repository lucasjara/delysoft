<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 19-08-2018
 * Time: 21:40
 */

class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'array_utf8', 'validaciones', 'form_validator');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model("/administracion/perfiles_model");
        $data["perfiles"] = $this->perfiles_model->obtener_perfiles();
        $this->layout->setLayout("plantilla");
        $this->layout->view('vista', $data);
    }

    public function obtener_listado_usuarios()
    {
        $mensaje = new stdClass();
        $this->load->model("/administracion/usuarios_model");
        if (validarUsuario(false)) {
            $datos = $this->usuarios_model->obtener_listado_usuarios();
            for ($i = 0; $i < count($datos); $i++) {
                $datos[$i]["ACCIONES"] = $this->formato_acciones($datos[$i]);
                $datos[$i]["ACTIVO"] = $this->formato_activo($datos[$i]["ACTIVO"]);
            }
            $mensaje->data = $datos;
            $mensaje->respuesta = 'S';
        } else {
            redirect('/delysoft/inicio', 'refresh');
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    public function agregar_usuario()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_usuario('agregar');
            if ($validator->respuesta == 'S') {
                $this->load->model('mantenedores/usuarios_model', 'usuarios_model');
                $usuario = $this->input->post('usuario');
                $password = $this->input->post('password');
                $nombres = $this->input->post('nombres');
                $perfil = $this->input->post('perfil');
                $this->usuarios_model->ingresar_usuario($usuario, $password, $nombres, $perfil);
                $mensaje->respuesta = "S";
                $mensaje->data = "Usuario Modificado Correctamente";
            } else {
                $mensaje->respuesta = "N";
                $mensaje->data = $validator->mensaje;
            }
        } else {
            $mensaje->respuesta = "N";
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array_utf8_encode($mensaje)));
    }

    private function formato_activo($respuesta)
    {
        if ($respuesta === "S") {
            $respuesta = "<button class='btn btn-success btn-xs' type='button'>ACTIVO</button>";
        } else {
            $respuesta = "<button class='btn btn-danger btn-xs' type='button'>ACTIVO</button>";
        }
        return $respuesta;
    }

    private function formato_acciones($data)
    {
        $respuesta = "<button class='btn btn-primary btn-xs btn_editar' type='button' data-id=" . $data['ID'] . " " .
            " data-nombre=" . $data['NOMBRE'] . " data-usuario=" . $data['USUARIO'] . " data-password=" . $data['PASSWORD'] . " " .
            " data-correo=" . $data['ID'] . "><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>";
        if ($data["ACTIVO"] == "S") {
            $respuesta .= " <button class='btn btn-success btn-xs btn_estado' type='button' data-id=" . $data['ID'] . " data-activo=" . $data['ACTIVO'] . "><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";
        } else {
            $respuesta .= " <button class='btn btn-dangers btn-xs btn_estado' type='button' data-id=" . $data['ID'] . " data-activo=" . $data['ACTIVO'] . "><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>";
        }
        return $respuesta;
    }
}