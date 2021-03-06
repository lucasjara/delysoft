<?php

/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 25-08-2018
 * Time: 23:02
 */
class Perfiles extends CI_Controller
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
        if (validarUsuario(false)) {
            $this->load->model("/inicio_model");
            $this->load->model("/administracion/permisos_model");
            $data["rutas"] = $this->inicio_model->obtener_rutas();
            $data["permisos"] = $this->permisos_model->obtener_permisos_activos();
            $this->layout->setLayout('plantilla');
            $this->layout->view('vista', $data);
        } else {
            redirect('/inicio/');
        }
    }

    public function obtener_listado_perfiles()
    {
        $mensaje = new stdClass();
        $this->load->model('/administracion/perfiles_model');
        if (validarUsuario(false)) {
            $datos = $this->perfiles_model->obtener_listado_perfiles();
            for ($i = 0; $i < count($datos); $i++) {
                $datos[$i]['ACCIONES'] = $this->formato_acciones($datos[$i]);
                $datos[$i]['ACTIVO'] = $this->formato_activo($datos[$i]['ACTIVO']);
            }
            $mensaje->data = $datos;
            $mensaje->respuesta = 'S';
        } else {
            $mensaje->respuesta = 'No hay mano';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    public function agregar_perfiles()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_perfiles('agregar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/perfiles_model', 'perfiles_model');
                $descripcion = $this->input->post('descripcion');
                $nombre = $this->input->post('nombre');
                $this->perfiles_model->ingresar_perfiles($descripcion, $nombre);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'perfiles Modificado Correctamente';
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = $validator->mensaje;
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    public function editar_perfiles()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_perfiles('editar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/perfiles_model');
                $id = $this->input->post('id');
                $nombre = $this->input->post('nombre');
                $descripcion = $this->input->post('descripcion');
                $this->perfiles_model->editar_perfiles($id, $descripcion, $nombre);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'perfiles Modificado Correctamente';
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = validation_errors();
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array_utf8_encode($mensaje)));
    }

    public function cambiar_estado_perfiles()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_perfiles('estado');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/perfiles_model');
                $id = $this->input->post('id');
                $perfil = $this->input->post('estado');
                if ($perfil == 'S') {
                    $this->perfiles_model->cambia_estado_perfiles($id, 'N');
                    $mensaje->respuesta = 'S';
                } elseif ($perfil == 'N') {
                    $this->perfiles_model->cambia_estado_perfiles($id, 'S');
                    $mensaje->respuesta = 'S';
                } else {
                    $mensaje->respuesta = 'N';
                    $mensaje->data = 'Error formato estado';
                }
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = $validator->mensaje;
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    private function formato_activo($respuesta)
    {
        if ($respuesta === 'S') {
            $respuesta = "<button class='btn btn-success btn-xs' type='button'>ACTIVO</button>";
        } else {
            $respuesta = "<button class='btn btn-danger btn-xs' type='button'>INACTIVO</button>";
        }
        return $respuesta;
    }

    private function formato_acciones($data)
    {
        $respuesta = "<button class='btn btn-primary btn-xs btn_editar' type='button' data-id=" . $data['ID'] . " " .
            " data-descripcion='" . $data['DESCRIPCION'] . "' data-nombre='" . $data['NOMBRE'] . "' data-activo='" . $data['ACTIVO'] . "' ><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> EDITAR</button>";
        if ($data['ACTIVO'] == 'S') {
            $respuesta .= " <button class='btn btn-success btn-xs btn_estado' type='button' data-id=" . $data['ID'] . " data-activo=" . $data['ACTIVO'] . "><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> DESACTIVAR</button>";
        } else {
            $respuesta .= " <button class='btn btn-danger btn-xs btn_estado' type='button' data-id=" . $data['ID'] . " data-activo=" . $data['ACTIVO'] . "><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> ACTIVAR</button>";
        }
        $respuesta .= " <button class='btn btn-default btn-xs btn_permisos_perfil' type='button' data-id=" . $data['ID'] . "><span class='glyphicon glyphicon glyphicon-user' aria-hidden='true'></span> PERMISOS</button>";
        return $respuesta;
    }

    public function obtener_permisos_local()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_perfiles('id');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/perfiles_model');
                $id = $this->input->post('id');
                $mensaje->respuesta = 'S';
                $datos = $this->perfiles_model->obtener_permisos_perfil($id);
                for ($i = 0; $i < count($datos); $i++) {
                    $datos[$i]->ACCIONES = $this->formato_acciones_permisos($datos[$i]);
                    $datos[$i]->ACTIVO = $this->formato_activo_permisos($datos[$i]->ACTIVO);
                }
                $mensaje->data = $datos;
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = $validator->mensaje;
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    private function formato_activo_permisos($respuesta)
    {
        if ($respuesta === 'S') {
            $respuesta = "<button class='btn btn-success btn-xs' type='button'>ACTIVO</button>";
        } else {
            $respuesta = "<button class='btn btn-danger btn-xs' type='button'>INACTIVO</button>";
        }
        return $respuesta;
    }

    private function formato_acciones_permisos($data)
    {
        if ($data->ACTIVO == 'S') {
            $respuesta = " <button class='btn btn-success btn-xs btn_estado' type='button' data-id=" . $data->ID . " data-activo=" . $data->ACTIVO . "><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> DESACTIVAR</button>";
        } else {
            $respuesta = " <button class='btn btn-danger btn-xs btn_estado' type='button' data-id=" . $data->ID . " data-activo=" . $data->ACTIVO . "><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> ACTIVAR</button>";
        }
        return $respuesta;
    }

    public function vincular_permisos_perfil()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $id_perfil = $this->input->post('id_perfil');
            $id_permiso = $this->input->post('id_permiso');
            if ($id_perfil != null && $id_permiso != null) {
                $this->load->model('/administracion/perfiles_model');
                $comprobacion = $this->perfiles_model->comprobar_permiso_perfil($id_perfil, $id_permiso);
                if ($comprobacion == null){
                    $this->perfiles_model->asignar_permisos_perfil($id_perfil, $id_permiso);
                    $mensaje->respuesta = 'S';
                    $datos = $this->perfiles_model->obtener_permisos_perfil($id_perfil);
                    for ($i = 0; $i < count($datos); $i++) {
                        $datos[$i]->ACCIONES = $this->formato_acciones_permisos($datos[$i]);
                        $datos[$i]->ACTIVO = $this->formato_activo_permisos($datos[$i]->ACTIVO);
                    }
                    $mensaje->data = $datos;
                }else{
                    $mensaje->respuesta = 'N';
                    $mensaje->data = 'Permiso ya asignado a perfil';
                }
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = 'Erro al enviar datos';
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }
}

 