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
        if ($id_usuario != null) {
            $this->load->model("/administracion/regiones_model");
            $this->load->model("/administracion/ciudades_model");
            $this->load->model("/administracion/perfiles_model");
            $this->load->model("/administracion/locales_model");
            $this->load->model("/inicio_model");
            $data["elemento_modulo"] = "Configuración Local";
            $data["rutas"] = $this->inicio_model->obtener_rutas();
            $data["regiones"] = $this->regiones_model->obtener_regiones();
            $data["ciudades"] = $this->ciudades_model->obtener_ciudades();
            $data["perfiles"] = $this->perfiles_model->obtener_perfiles_carga_inicial();
            $id_local = $this->session->id_local;
            $datos_cargos_local = $this->locales_model->obtener_cargos_locales($id_local);
            for ($i = 0; $i < count($datos_cargos_local); $i++) {
                $datos_cargos_local[$i]->ACCIONES = $this->formato_acciones($datos_cargos_local[$i]);
                $datos_cargos_local[$i]->ACTIVO = $this->formato_activo_cargos($datos_cargos_local[$i]->ACTIVO);
            }
            $data["local"] = $this->locales_model->obtener_datos_local($id_local);
            $data["perfiles_local"] = $datos_cargos_local;
            $this->layout->setLayout('plantilla_menu');
            $this->layout->view('vista', $data);
        } else {
            redirect('/login');
        }
    }

    public function login_sistema()
    {
        $this->load->helper('url');
        $mensaje = new stdClass();
        $usuario = $this->input->post('usuario');
        $password = $this->input->post('password');
        $this->load->model("/administracion/Usuarios_model");
        $this->load->model("/administracion/locales_model");
        $obj_user = new usuariosModel();
        $user = $obj_user->obtener_datos_usuario($usuario, $password);
        if ($user != null) {
            $id_local = $this->locales_model->obtener_local_configurar($user[0]['ID']);
            //Asignar Variables de Session
            $this->session->id_usuario = $user[0]['ID'];
            $this->session->id_perfil = $user[0]["ID_PERFIL"];
            $this->session->id_local = $id_local;
            $id_perfil = $this->session->id_perfil;
            switch ($id_perfil) {
                case "1":
                    redirect("/administracion/permisos", 'refresh');
                    break;
                case "4":
                    redirect("/administrativo/inicio", 'refresh');
                    break;
                default:
                    redirect('/login/', 'refresh');
                    break;
            }
        } else {
            redirect("/login/", 'refresh');
        }
    }

    public function cerrar_session_sistema()
    {
        $this->session->sess_destroy();
        redirect("/login/", 'refresh');
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
        } elseif ($respuesta === 'P') {
            $respuesta = "<button class='btn btn-info btn-xs' type='button'>PENDIENTE</button>";
        } else {
            $respuesta = "<button class='btn btn-danger btn-xs' type='button'>INACTIVO</button>";
        }
        return $respuesta;
    }

    private function formato_acciones($data)
    {
        if ($data->ACTIVO == 'S') {
            $respuesta = " <button class='btn btn-success btn-xs btn_estado' type='button' " .
                " data-id=" . $data->ID . " " .
                " data-activo=" . $data->ACTIVO . ">" .
                "<span class='fa fa-check-circle' aria-hidden='true'></span> DESACTIVAR</button>";
        } else {
            $respuesta = " <button class='btn btn-danger btn-xs btn_estado' type='button' " .
                " data-id=" . $data->ID . " " .
                " data-activo=" . $data->ACTIVO . ">" .
                "<span class='fa fa-times-circle' aria-hidden='true'></span> ACTIVAR</button>";
        }
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
            "<span class='fa fa-pen' aria-hidden='true'></span> EDITAR</button>";
        if ($data['ACTIVO'] == 'S') {
            $respuesta .= " <button class='btn btn-success btn-xs btn_estado' type='button' " .
                " data-id=" . $data['ID'] . " " .
                " data-activo=" . $data['ACTIVO'] . ">" .
                "<span class='fa fa-check-circle' aria-hidden='true'></span> DESACTIVAR</button>";
        } else {
            $respuesta .= " <button class='btn btn-danger btn-xs btn_estado' type='button' " .
                " data-id=" . $data['ID'] . " " .
                " data-activo=" . $data['ACTIVO'] . ">" .
                "<span class='fa fa-times-circle' aria-hidden='true'></span> ACTIVAR</button>";
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
                $this->productos_model->ingresar_productos($descripcion, $nombre, $precio, $id_local);
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
                $this->productos_model->editar_productos($id, $descripcion, $nombre, $precio, $id_local);
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
                $comprobar = $this->locales_model->comprobar_cargo_local($id_local, $usuario, $cargo);
                if ($comprobar == null) {
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
                    $mensaje->data = "El cargo ya se encuentra ocupado por esta persona.";
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

    public function confirmar_informacion()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_locales('agregar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/locales_model');
                $id_local = $this->session->id_local;
                $respuesta = $this->locales_model->validar_producto_activo($id_local);
                if ($respuesta != null) {
                    // Editamos es local si se modifico la informacion
                    $nombre = $this->input->post('nombre');
                    $descripcion = $this->input->post('descripcion');
                    $region = $this->input->post('region');
                    $ciudad = $this->input->post('ciudad');
                    $this->locales_model->editar_locales($id_local, $descripcion, $nombre, $region, $ciudad);
                    $mensaje->respuesta = 'S';
                    $mensaje->data = 'Informacion Modificada Correctamente';
                } else {
                    $mensaje->respuesta = 'N';
                    $mensaje->data = "Debe contar con un producto disponible.";
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

    public function cambiar_estado_cargo_local()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_producto('estado');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/locales_model');
                $id = $this->input->post('id');
                $perfil = $this->input->post('estado');
                $id_local = $this->session->id_local;
                if ($perfil == 'S') {
                    $this->locales_model->cambia_estado_cargo_local($id, 'N');
                    $mensaje->respuesta = 'S';
                    $datos_cargos_local = $this->locales_model->obtener_cargos_locales($id_local);
                    for ($i = 0; $i < count($datos_cargos_local); $i++) {
                        $datos_cargos_local[$i]->ACCIONES = $this->formato_acciones($datos_cargos_local[$i]);
                        $datos_cargos_local[$i]->ACTIVO = $this->formato_activo_cargos($datos_cargos_local[$i]->ACTIVO);
                    }
                    $mensaje->data = $datos_cargos_local;
                } elseif ($perfil == 'N') {
                    $this->locales_model->cambia_estado_cargo_local($id, 'S');
                    $mensaje->respuesta = 'S';
                    $datos_cargos_local = $this->locales_model->obtener_cargos_locales($id_local);
                    for ($i = 0; $i < count($datos_cargos_local); $i++) {
                        $datos_cargos_local[$i]->ACCIONES = $this->formato_acciones($datos_cargos_local[$i]);
                        $datos_cargos_local[$i]->ACTIVO = $this->formato_activo_cargos($datos_cargos_local[$i]->ACTIVO);
                    }
                    $mensaje->data = $datos_cargos_local;
                } else {
                    $mensaje->respuesta = 'N';
                    $mensaje->data = 'Error al cambiar estado';
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
}