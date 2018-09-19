<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 16-09-2018
 * Time: 16:55
 */

class Base extends CI_Controller
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
        $id_usuario = $this->session->id_usuario;
        if ($id_usuario != null){
            $this->load->model("/administracion/regiones_model");
            $this->load->model("/administracion/ciudades_model");
            $this->load->model("/administracion/perfiles_model");
            $this->load->model("/administracion/locales_model");
            $data["regiones"] = $this->regiones_model->obtener_regiones();
            $data["ciudades"] = $this->ciudades_model->obtener_ciudades();
            $data["perfiles"] = $this->perfiles_model->obtener_perfiles_carga_inicial();
            $id_local = $this->locales_model->obtener_local_configurar($id_usuario);
            $this->session->id_local=$id_local;
            $datos_cargos_local = $this->locales_model->obtener_cargos_locales($id_local);
            for ($i = 0; $i < count($datos_cargos_local); $i++) {
                $datos_cargos_local[$i]->ACCIONES = $this->formato_acciones($datos_cargos_local[$i]);
                $datos_cargos_local[$i]->ACTIVO = $this->formato_activo_cargos($datos_cargos_local[$i]->ACTIVO);
            }
            $data["local"] = $this->locales_model->obtener_datos_local($id_local);
            $data["perfiles_local"] = $datos_cargos_local;
            $this->layout->setLayout('plantilla');
            $this->layout->view('vista', $data);
        }else{
            redirect('/inicio/');
        }
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
    private function formato_activo_cargos($respuesta)
    {
        if ($respuesta === 'S') {
            $respuesta = "<button class='btn btn-success btn-xs' type='button'>ACTIVO</button>";
        }elseif($respuesta === 'P'){
            $respuesta = "<button class='btn btn-info btn-xs' type='button'>PENDIENTE</button>";
        }else {
            $respuesta = "<button class='btn btn-danger btn-xs' type='button'>INACTIVO</button>";
        }
        return $respuesta;
    }

    private function formato_acciones($data)
    {
        $respuesta = "<button class='btn btn-info btn-xs btn_detalle' type='button' >" .
            "<span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>" .
            "</button>";
        return $respuesta;
    }

    private function formato_acciones_producto($data)
    {
        $respuesta = "<button class='btn btn-primary btn-xs btn_editar' type='button' " .
            " data-id=" . $data['ID'] . " " .
            " data-descripcion='" . $data['DESCRIPCION'] . "' " .
            " data-nombre='" . $data['NOMBRE'] . "' " .
            " data-precio='" . $data['PRECIO'] . "' " .
            " data-activo='" . $data['ACTIVO'] . "' >" .
            "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>";
        if ($data['ACTIVO'] == 'S') {
            $respuesta .= " <button class='btn btn-success btn-xs btn_estado' type='button' " .
                " data-id=" . $data['ID'] . " " .
                " data-activo=" . $data['ACTIVO'] . ">" .
                "<span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";
        } else {
            $respuesta .= " <button class='btn btn-danger btn-xs btn_estado' type='button' " .
                " data-id=" . $data['ID'] . " " .
                " data-activo=" . $data['ACTIVO'] . ">" .
                "<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>";
        }
        return $respuesta;
    }

    public function obtener_listado_productos_local()
    {
        $mensaje = new stdClass();
        $this->load->model('/administracion/productos_model');
        if (validarUsuario(false)) {
            $id_local = $this->session->id_local;
            $datos = $this->productos_model->obtener_listado_productos_local($id_local);
            for ($i = 0; $i < count($datos); $i++) {
                $datos[$i]['ACCIONES'] = $this->formato_acciones_producto($datos[$i]);
                $datos[$i]['ACTIVO'] = $this->formato_activo($datos[$i]['ACTIVO']);
            }
            $mensaje->data = $datos;
            $mensaje->respuesta = 'S';
        } else {
            $mensaje->respuesta = 'No hay mano';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }
    public function agregar_productos_local()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_producto('agregar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/productos_model', 'productos_model');
                $descripcion = $this->input->post('descripcion');
                $nombre = $this->input->post('nombre');
                $precio = $this->input->post('precio');
                // Valor estatico
                $id_local = $this->session->id_local;
                $this->productos_model->ingresar_productos($descripcion,$nombre,$precio,$id_local);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'Productos Modificado Correctamente';
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
    public function editar_productos_local()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_producto('editar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/productos_model');
                $id = $this->input->post('id');
                $descripcion = $this->input->post('descripcion');
                $nombre = $this->input->post('nombre');
                $precio = $this->input->post('precio');
                // Valor estatico
                $id_local = $this->session->id_local;
                $this->productos_model->editar_productos($id, $descripcion,$nombre,$precio,$id_local);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'Productos Modificado Correctamente';
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
    public function cambiar_estado_productos_local()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_producto('estado');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/productos_model');
                $id = $this->input->post('id');
                $perfil = $this->input->post('estado');
                if ($perfil == 'S') {
                    $this->productos_model->cambia_estado_productos($id, 'N');
                    $mensaje->respuesta = 'S';
                } elseif ($perfil == 'N') {
                    $this->productos_model->cambia_estado_productos($id, 'S');
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

    public function agregar_cargo_local()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_local_usuario('agregar_cargo');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/locales_model');
                $id_local = $this->session->id_local;
                $usuario = $this->input->post('usuario');
                $cargo = $this->input->post('cargo');
                $this->locales_model->agregar_cargo_local($id_local, $usuario, $cargo);
                $datos_cargos_local = $this->locales_model->obtener_cargos_locales($id_local);
                for ($i = 0; $i < count($datos_cargos_local); $i++) {
                    $datos_cargos_local[$i]->ACCIONES = $this->formato_acciones($datos_cargos_local[$i]);
                    $datos_cargos_local[$i]->ACTIVO = $this->formato_activo_cargos($datos_cargos_local[$i]->ACTIVO);
                }
                $mensaje->respuesta = 'S';
                $mensaje->data = $datos_cargos_local;
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
    public function confirmar_informacion()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_locales('agregar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/locales_model');
                // Editamos es local si se modifico la informacion
                $id_local = $this->session->id_local;
                $nombre = $this->input->post('nombre');
                $descripcion = $this->input->post('descripcion');
                $region = $this->input->post('region');
                $ciudad = $this->input->post('ciudad');
                $this->locales_model->editar_locales($id_local, $descripcion, $nombre, $region, $ciudad);
                //
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
}