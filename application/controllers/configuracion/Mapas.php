<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 19-09-2018
 * Time: 12:42
 */

class Mapas extends CI_Controller
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
            $this->load->model("/administracion/locales_model");
            $this->load->model('/administracion/productos_model');
            $id_local = $this->session->id_local;
            $data["elemento_modulo"] = "Configuración Mapa";
            $data["productos_general"] = $this->productos_model->obtener_listado_productos_local($id_local);
            $data["zonas_colores"] = $this->locales_model->obtener_zonas_colores($id_local);
            $this->layout->setLayout('plantilla_menu');
            $this->layout->view('vista', $data);
        } else {
            redirect('/inicio/');
        }
    }

    public function agregar_zona_local()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_zonas('agregar_zona_personalizado');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/zonas_model', 'zonas_model');
                $id_local = $this->session->id_local;
                $cantidad_zonas = count($this->zonas_model->obtener_listado_zona_local($id_local));
                if ($cantidad_zonas < 5) {
                    $nombre = $this->input->post('nombre');
                    $descripcion = $this->input->post('descripcion');
                    $this->zonas_model->ingresar_zonas($descripcion, $nombre, $id_local);
                    $mensaje->respuesta = 'S';
                    $mensaje->data = 'Zona Agregada Correctamente';
                } else {
                    $mensaje->respuesta = 'N';
                    $mensaje->data = "La cantidad de zonas por local no debe ser mayor a 5.";
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

    public function editar_zona_local()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_zonas('editar_zona_personalizado');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/zonas_model');
                $id = $this->input->post('id');
                $descripcion = $this->input->post('descripcion');
                $nombre = $this->input->post('nombre');
                $id_local = $this->session->id_local;
                $this->zonas_model->editar_zonas($id, $descripcion, $nombre, $id_local);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'Zona Modificado Correctamente';
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

    public function buscar_zona_mapa()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_zonas('comprueba');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/zonas_model');
                $id_zona = $this->input->post('id');
                $respuesta = $this->zonas_model->obtener_detalle_zona($id_zona);
                $mensaje->respuesta = 'S';
                $mensaje->data = $respuesta;
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

    public function buscar_zonas_mapas()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_zonas('comprueba_anidado');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/zonas_model');
                $id_zonas = $this->input->post('id_zonas');
                $data = array();
                for ($i = 0; $i < count($id_zonas); $i++) {
                    $respuesta = $this->zonas_model->obtener_detalle_zona($id_zonas[$i]);
                    array_push($data, $respuesta);
                }
                $mensaje->respuesta = 'S';
                $mensaje->data = $data;
                $mensaje->zonas = $id_zonas;
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

    public function guardar_detalle_zona()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_detalle_zonas('agregar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/zonas_model');
                $id_zona = $this->input->post('id_zona');
                $longitud = $this->input->post('longitud');
                $latitud = $this->input->post('latitud');
                if (count($longitud) == count($latitud)) {
                    for ($i = 0; $i < count($longitud); $i++) {
                        $this->zonas_model->guardar_detalle_zona($longitud[$i], $latitud[$i], $id_zona);
                    }
                    $mensaje->respuesta = 'S';
                } else {
                    $mensaje->respuesta = 'N';
                    $mensaje->data = "Inconsistencia de datos";
                }
                $mensaje->respuesta = 'S';
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

    public function agregar_producto_zona()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_producto('agregar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/productos_model');
                $this->load->model('/administracion/zonas_model');
                $id_local = $this->session->id_local;
                $id_zona = $this->input->post('id_zona');
                $nombre = $this->input->post('nombre');
                $descripcion = $this->input->post('descripcion');
                $precio = $this->input->post('precio');
                $id_producto = $this->productos_model->ingresar_productos_zona($descripcion, $nombre, $precio,
                    $id_local);
                if ($id_producto != null) {
                    $this->zonas_model->vincular_productos_zona($id_zona, $id_producto);
                    $mensaje->respuesta = 'S';
                    $datos = $this->zonas_model->obtener_productos_zona($id_zona);
                    for ($i = 0; $i < count($datos); $i++) {
                        $datos[$i]->ACCIONES = $this->formato_acciones_productos_zona($datos[$i]);
                        $datos[$i]->ACTIVO = $this->formato_activo($datos[$i]->ACTIVO);
                    }
                    $mensaje->data = $datos;
                } else {
                    $mensaje->respuesta = 'N';
                    $mensaje->data = 'Error al Vincular Producto';
                }
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

    public function limpieza_detalle_zona()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_detalle_zonas('detalle');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/zonas_model');
                $id_zona = $this->input->post('id_zona');
                $this->zonas_model->limpieza_detalle_zona($id_zona);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'Limpieza Realizada Correctamente';
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

    public
    function obtener_listado_zonas_local()
    {
        $mensaje = new stdClass();
        $this->load->model('/administracion/zonas_model', 'zonas_model');
        if (validarUsuario(false)) {
            $id_local = $this->session->id_local;
            $datos = $this->zonas_model->obtener_listado_zona_local($id_local);
            for ($i = 0; $i < count($datos); $i++) {
                $datos[$i]['CUADRO'] = $this->formato_cuadro($datos[$i]);
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

    public function obtener_productos_zona()
    {
        $mensaje = new stdClass();
        $this->load->model('/administracion/zonas_model', 'zonas_model');
        if (validarUsuario(true)) {
            $validator = form_detalle_zonas('detalle');
            if ($validator->respuesta == 'S') {
                $id_zona = $this->input->post('id_zona');
                $datos = $this->zonas_model->obtener_productos_zona($id_zona);
                for ($i = 0; $i < count($datos); $i++) {
                    $datos[$i]->ACCIONES = $this->formato_acciones_productos_zona($datos[$i]);
                    $datos[$i]->ACTIVO = $this->formato_activo($datos[$i]->ACTIVO);
                }
                $mensaje->respuesta = 'S';
                $mensaje->data = $datos;
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = validation_errors();
            }
        } else {
            $mensaje->data = 'Session no Valida';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    private
    function formato_cuadro(
        $data
    ) {
        $respuesta = "";
        if ($data['CANTIDAD_PUNTOS'] > 0) {
            $respuesta .= "<input 
                        type='checkbox' 
                        name='check'
                        class='check_zona'
                        style='width: 18px; height: 18px;'
                        data-id=" . $data['ID'] . "
                        data-nombre='" . $data['NOMBRE'] . "''
                         checked>";
        } else {
            $respuesta .= "<input 
                        type='checkbox' 
                        name='check'
                        class='check_zona'
                        style='width: 18px; height: 18px;'
                        data-id=" . $data['ID'] . " 
                        data-nombre='" . $data['NOMBRE'] . "''>";
        }
        return $respuesta;
    }

    private
    function formato_activo(
        $respuesta
    ) {
        if ($respuesta === 'S') {
            $respuesta = "<button class='btn btn-success bt2n-xs' type='button'>ACTIVO</button>";
        } else {
            $respuesta = "<button class='btn btn-danger btn-xs' type='button'>INACTIVO</button>";
        }
        return $respuesta;
    }

    private
    function formato_acciones(
        $data
    ) {
        $respuesta = "<button class='btn btn-default btn-xs btn_color' style='color:white;background-color: " . $data['HEXADECIMAL'] . ";' title='Cambiar Color' data-id=" . $data['ID'] . " data-color='" . $data['COLOR'] . "' type='button'><span
                                class='fa fa-book' aria-hidden='true'> CAMBIAR COLOR</span></button>";
        $respuesta .= " <button class='btn btn-primary btn-xs btn_editar' type='button' title='Editar Zona' data-id=" . $data['ID'] . " " .
            " data-descripcion='" . $data['DESCRIPCION'] . "' data-nombre='" . $data['NOMBRE'] . "' data-local='" . $data['ID_LOCAL'] . "' data-activo='" . $data['ACTIVO'] . "' ><span class='fa fa-pen' aria-hidden='true'></span> EDITAR</button>";
        if ($data['ACTIVO'] == 'S') {
            $respuesta .= " <button class='btn btn-success btn-xs btn_estado' title='Cambiar Estado Zona' type='button' data-id=" . $data['ID'] . " data-activo=" . $data['ACTIVO'] . "><span class='fa fa-check-circle' aria-hidden='true'></span> DESACTIVAR</button>";
        } else {
            $respuesta .= " <button class='btn btn-danger btn-xs btn_estado' title='Cambiar Estado Zona' type='button' data-id=" . $data['ID'] . " data-activo=" . $data['ACTIVO'] . "><span class='fa fa-times-circle' aria-hidden='true'></span> ACTIVAR</button>";
        }
        $respuesta .= " <button class='btn btn-info btn-xs btn_limpieza' title='Limpieza Mapa' type='button' data-id=" . $data['ID'] . " data-nombre='" . $data['NOMBRE'] . "'><span
                            class='fa fa-eraser' aria-hidden='true'></span> LIMPIAR MAPA</button>
                    <button class='btn btn-success btn-xs btn_producto' title='Asignar Productos' data-id=" . $data['ID'] . " type='button'><span
                                class='fa fa-plus-circle' aria-hidden='true'> AGREGAR PRODUCTOS</span>
                    </button>";
        return $respuesta;
    }

    private function formato_acciones_productos_zona(
        $data
    ) {
        $respuesta = "<button class='btn btn-primary btn-xs btn_editar' type='button' title='Editar Producto' " .
            " data-id=" . $data->ID . " " .
            " data-descripcion='" . $data->DESCRIPCION . "' " .
            " data-nombre='" . $data->PRODUCTO . "' " .
            " data-precio='" . $data->PRECIO . "' " .
            " data-activo='" . $data->ACTIVO . "' >" .
            "<span class='fa fa-pen' aria-hidden='true'></span></button>";
        if ($data->ACTIVO == 'S') {
            $respuesta .= " <button class='btn btn-success btn-xs btn_estado' " .
                " title='Cambiar Estado Producto' " .
                " type='button' " .
                " data-id=" . $data->ID . " " .
                " data-activo=" . $data->ACTIVO . ">" .
                "<span class='fa fa-plus-circle' aria-hidden='true'></span></button>";
        } else {
            $respuesta .= " <button class='btn btn-danger btn-xs btn_estado' " .
                " title='Cambiar Estado Producto' " .
                " type='button' " .
                " data-id=" . $data->ID . " " .
                " data-activo=" . $data->ACTIVO . ">" .
                "<span class='fa fa-times-circle' aria-hidden='true'></span></button>";
        }
        return $respuesta;
    }

    public function limpieza_mapa_colores()
    {
        $mensaje = new stdClass();
        $this->load->model('/administracion/zonas_model', 'zonas_model');
        $this->load->model('/administracion/locales_model', 'locales_model');
        if (validarUsuario(false)) {
            $id_local = $this->session->id_local;
            $datos = $this->locales_model->obtener_zonas_colores($id_local);
            $formato = "";
            for ($i = 0; $i < count($datos); $i++) {
                $formato .= "<tr data-id='" . $datos[$i]->ID . "'>";
                $formato .= "<td>" . $datos[$i]->ZONA . "</td>";
                $formato .= "<td>" . $datos[$i]->COLOR . "</td>";
                $formato .= "</tr>";
            }
            $mensaje->respuesta = 'S';
            $mensaje->data = $formato;
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'Session no Valida por favor recargue la pagina';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    public function cambiar_color_zona()
    {
        $mensaje = new stdClass();
        $this->load->model('/administracion/zonas_model', 'zonas_model');
        if (validarUsuario(false)) {
            $id_zona = $this->input->post('id_zona');
            $color = $this->input->post('color');
            $cod = "";
            switch ($color) {
                case "Rojo":
                    $cod = "#DF3A01";
                    break;
                case "Amarillo":
                    $cod = "#D7DF01";
                    break;
                case "Verde":
                    $cod = "#01DF3A";
                    break;
                case "Azul":
                    $cod = "#0174DF";
                    break;
                case "Celeste":
                    $cod = "#01DFD7";
                    break;
            }
            $this->zonas_model->actualizar_color_zona($id_zona, $color, $cod);
            $mensaje->respuesta = 'S';
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'Session no Valida por favor recargue la pagina';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    public function cambiar_estado_producto_zona()
    {
        $mensaje = new stdClass();
        $this->load->model('/administracion/zonas_model', 'zonas_model');
        if (validarUsuario(false)) {
            $validator = form_productos_zonas('cambio');
            if ($validator->respuesta == 'S') {
                $id_prod = $this->input->post('id_prod');
                $estado = $this->input->post('estado');
                $id_zona = $this->input->post('id_zona');
                if ($estado == "S") {
                    $this->zonas_model->actualizar_estado_producto_zona($id_prod, 'N');
                } else {
                    $this->zonas_model->actualizar_estado_producto_zona($id_prod, 'S');
                }
                $mensaje->respuesta = 'S';
                $datos = $this->zonas_model->obtener_productos_zona($id_zona);
                for ($i = 0; $i < count($datos); $i++) {
                    $datos[$i]->ACCIONES = $this->formato_acciones_productos_zona($datos[$i]);
                    $datos[$i]->ACTIVO = $this->formato_activo($datos[$i]->ACTIVO);
                }
                $mensaje->data = $datos;
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = $validator->mensaje;
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'Session no Valida por favor recargue la pagina';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    public function editar_producto_zona()
    {
        $mensaje = new stdClass();
        $this->load->model('/administracion/zonas_model', 'zonas_model');
        if (validarUsuario(false)) {
            $validator = form_productos_zonas('editar');
            if ($validator->respuesta == 'S') {
                $id_prod = $this->input->post('id_prod');
                $id_zona = $this->input->post('id_zona');
                $nombre = $this->input->post('nombre');
                $descripcion = $this->input->post('descripcion');
                $precio = $this->input->post('precio');
                $id_producto = $this->zonas_model->obtener_producto_zona($id_prod);
                $this->zonas_model->actualizar_informacion_producto_zona($id_producto, $nombre, $descripcion, $precio);
                $mensaje->respuesta = 'S';
                $datos = $this->zonas_model->obtener_productos_zona($id_zona);
                for ($i = 0; $i < count($datos); $i++) {
                    $datos[$i]->ACCIONES = $this->formato_acciones_productos_zona($datos[$i]);
                    $datos[$i]->ACTIVO = $this->formato_activo($datos[$i]->ACTIVO);
                }
                $mensaje->data = $datos;
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = $validator->mensaje;
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'Session no Valida por favor recargue la pagina';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    public function vincular_producto_general_zona()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $this->load->model('/administracion/productos_model');
            $this->load->model('/administracion/zonas_model');
            $id_local = $this->session->id_local;
            $id_zona = $this->input->post('id_zona');
            $id_producto = $this->input->post('id_prod');
            if ($id_producto != null && $id_zona != null) {

            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = 'Error al Vincular Producto';
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array_utf8_encode($mensaje)));
    }

}