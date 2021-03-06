<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 01-12-2018
 * Time: 19:02
 */

class Modificar extends CI_Controller
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
        $this->load->model("/usuarios/Usuarios_Model");
        $user_id = $this->session->id_usuario;
        $data["elemento_modulo"] = "Mis datos";
        $data["usuarios"] = $this->Usuarios_Model->obtener_usuario($user_id)[0];
        //var_dump($data["usuarios"]);
        $this->layout->setLayout('plantilla_menu_usuario');
        $this->layout->view('vista', $data);
        //$this->output->enable_profiler();

    }
/*
    public function editarUsuario()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        //fata validacion

        if (true) {
            $validator = form_usuario('editar');
            if ($validator->respuesta == 'S') {
                if($this->validarUsuario()=='S')
                {
                    $this->load->model('/usuarios/usuarios_model');
                    $id = $this->input->post('id');
                    $usuario = $this->input->post('usuario');
                    $nombre = $this->input->post('nombre');
                    $correo = $this->input->post('correo');
                    $password = $this->input->post('password');
                    $this->usuarios_model->editar_usuario($id, $usuario, $nombre, $correo, $password);
                    $mensaje->respuesta = "S";
                    $mensaje->data = "Usuario Modificado Correctamente";
                }else
                    {
                        $mensaje->respuesta="N";
                        $mensaje->data = "Contraseña no Valido";
                    }
            } else {
                $mensaje->respuesta = "N";
                $mensaje->data = validation_errors();
            }
        } else {
            $mensaje->respuesta = "N";
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array_utf8_encode($mensaje)));
    }

    private function validarUsuario()
    {
        $mensaje;
        $this->load->helper('array_utf8');
        $this->load->model('/usuarios/usuarios_model');
        $id = $this->input->post('id');
        $password = $this->input->post('password');
        $bd_pass = $this->usuarios_model->valida_password($id)[0];
        //var_dump($bd_pass);
        if($bd_pass->PASSWORD == $password)
        {
            $mensaje ="S";
        }else{
            $mensaje = "N";
        }
        return $mensaje;
    }
*/
}