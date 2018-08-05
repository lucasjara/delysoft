<?php

//TODO revisar por qué no funcionó crear la funcion form_hidden_id (no retornaba nada)
function form_hidden($name, $value = '', $recursing = FALSE)
{
	static $form;

	if ($recursing === FALSE)
	{
		$form = "\n";
	}

	if (is_array($name))
	{
		foreach ($name as $key => $val)
		{
			form_hidden($key, $val, TRUE);
		}
		return $form;
	}

	if ( ! is_array($value))
	{
		$form .= '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.form_prep($value, $name).'" />'."\n";
	}
	else
	{
		foreach ($value as $k => $v)
		{
			$k = (is_int($k)) ? '' : $k;
			form_hidden($name.'['.$k.']', $v, TRUE);
		}
	}

	return $form;
}

function form_prep($str = '', $field_name = '')
{ // se puede ver la documentación de este método en system/helpers/form_helper
    static $prepped_fields = array();
    if (is_array($str)) {
        foreach ($str as $key => $val) {
            $str[$key] = form_prep($val);
        }
        return $str;
    }
    if ($str === '') {
        return '';
    }
    if (isset($prepped_fields[$field_name])) {
        return $str;
    }
    $str = htmlspecialchars($str, ENT_QUOTES, config_item('charset'), true); # |ENT_HTML401 (se sacó por error en producción con la versión de PHP 5.3)
    $str = str_replace(array("'", '"'), array("&#39;", "&quot;"), $str);
    if ($field_name != '') {
        $prepped_fields[$field_name] = $field_name;
    }
    return $str;
}


/**
 * Muestra los errores de form_validation en una fila columna xs-12 y dentro de un alert-danger uno debajo del otro
 * @param string $prefix por defecto <p>
 * @param string $suffix por defecto <p>
 * @return string con todos los errores
 */
function validation_errors_agrupados($prefix = '', $suffix = '')
{
    $result = '';
    if (FALSE === ($OBJ =& _get_validation_object())) {
        return $result;
    } else if (trim($OBJ->error_string($prefix, $suffix)) != "") {
        $error_open = '<div class="row"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable">';
        $error_open .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        $error_close = '</div></div></div>';
        $result = $error_open . $OBJ->error_string($prefix, $suffix) . $error_close;
        return $result;
    }
}

/**
 * Muestra los errores de form_validation en una fila columna xs-12 y dentro de un alert-danger uno debajo del otro
 * @param string $prefix por defecto <p>
 * @param string $suffix por defecto <p>
 * @return string con todos los errores
 */
function validation_errors_agrupados_2_columnas($prefix = '', $suffix = '')
{
    $result = '';
    if (FALSE === ($OBJ =& _get_validation_object())) {
        return $result;
    } else if (trim($OBJ->error_string($prefix, $suffix)) != "") {
        $error_open = '<div class="row"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable">';
        $error_open .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        $error_close = '</div></div></div>';

        $errores = $OBJ->error_string($prefix, $suffix);

        $aError = explode('</p>', $errores);
        $totalErrores = count($aError);
        $i = 0;
        $htmlError = '';
        if ($totalErrores > 0) {
            $htmlError = '<div class="row"><div class="col-sm-6 col-xs-12">';

            foreach ($aError as $e) {
                if ($i == (int)$totalErrores / 2)
                    $htmlError .= '</div><div class="col-sm-6 col-xs-12">';
                if (trim($e) != '')
                    $htmlError .= $e . '</p>';

                $i++;
            }
            $htmlError .= '</div></div>';
        }

        $result = $error_open . $htmlError . $error_close;

        return $result;
    }
}

/**
 * Muestra los errores agrupados en un alert-danger uno debajo del otro (sin fila sin columnas el programador decide donde utilizarlo)
 * @param string $prefix por defecto <p>
 * @param string $suffix por defecto <p>
 * @return string con todos los errores
 */
function validation_errors_alert($prefix = '', $suffix = '')
{
    $result = '';
    $error_open = "";
    $error_close = "";

    if (FALSE === ($OBJ =& _get_validation_object())) {
        return $result;
    } else if (trim($OBJ->error_string($prefix, $suffix)) != "") {
        $error_open = '<div class="alert alert-danger alert-dismissable">';
        $error_open .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        $error_close = '</div>';
        $result = $error_open . $OBJ->error_string($prefix, $suffix) . $error_close;
        return $result;
    }
}


/**
 * Muestra el error del input según su name en el siguiente formato:
 *        '<span class="help-block">{Mensaje de erorr}</span>'
 *
 * @param string name del input a mostrar el error
 * @return string
 */
function error_span($field = '')
{
    $prefix = ' <span class="help-block">';
    $suffix = ' </span>';
    if (FALSE === ($OBJ =& _get_validation_object())) {
        return '';
    }

    return $OBJ->error($field, $prefix, $suffix);
}

/**
 * @return array
 */
function obtener_campos_erroneos()
{
    $campos = array();
    $OBJ =& _get_validation_object();

    foreach ($OBJ->obtener_campos_erroneos() as $campo => $msg) {
        $campos[] = $campo;
    }

    return $campos;
}


/********** desde formulario_helper ********/
if (!function_exists('in_array_r')) {
    function in_array_r($needle, $haystack, $strict = false)
    {
        if (is_array($haystack)) {
            foreach ($haystack as $item) {
                if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                    return true;
                }
            }
        }

        return false;
    }
}


if (!function_exists('generarSelect')) {
    function generarSelect($array, $name, $seleccionado = FALSE, $select2 = FALSE)
    {
        $select2 = ($select2 != FALSE) ? ' select2' : '';
        $str = "<select name='$name' id='$name' class='form-control" . $select2 . "'>";
        $str .= "<option value=''>Seleccione...</option>";
        if ($array['respuesta'] == "S") {
            foreach ($array['data'] as $row) {
                $selected = "";
                if ($seleccionado !== FALSE && $seleccionado == $row["ID"]) {
                    $selected = ' selected="selected"';
                }
                $str .= "<option value='" . $row['ID'] . "'" . $selected . ">{$row['DESCRIPCION']}</option>";
            }
        }
        $str .= "</select>";
        return $str;
    }
}


if (!function_exists('generarSelectMultiple')) {
    function generarSelectMultiple($array, $name, $seleccionado = FALSE)
    {
        $str = "<select name='" . htmlentities($name) . "[]' id='$name' multiple='multiple' class='form-control'>";
        if ($array['respuesta'] == "S") {
            foreach ($array['data'] as $row) {
                $selected = "";
                if ($seleccionado !== FALSE && in_array_r($row['ID'], $seleccionado)) {
                    $selected = ' selected="selected"';
                }
                $str .= "<option value='" . $row['ID'] . "'" . $selected . ">{$row['DESCRIPCION']}</option>";
            }
        }
        $str .= "</select>";
        return $str;
    }
}


if (!function_exists('selectSexo')) {

    function selectSexo($selected = NULL)
    {
        $CI = get_instance();
        $CI->load->driver('cache', array('adapter' => 'memcached', 'backup' => 'file'));
        $CI->load->model('tb_model');
        $pre_key = "select_sexo";
        $key = md5($pre_key);
        //$CI->cache->memcached->delete($key);
        if ($CI->cache->memcached->is_supported()) { //Si es soportado el cache.
            if ($select = $CI->cache->memcached->get($key)) { //verifica si existe la llave
                $str = generarSelect($select, 'sexo_id', $selected);
                return $select;
            } else {
                $respuesta = $CI->tb_model->tb_listar_cache("REFCENTRAL.SEXO");
                $str = generarSelect($respuesta, 'sexo_id', $selected);
                $CI->cache->memcached->save($key, $respuesta, 7200);
                return $str;
            }
        } else {
            $respuesta = $CI->tb_model->tb_listar_cache("REFCENTRAL.SEXO");
            $str = generarSelect($respuesta, 'sexo_id', $selected);
            return $str;
        }

    }
}

if (!function_exists('selectComuna')) {
    function selectComuna($selected = NULL)
    {
        $CI = get_instance();
        $CI->load->driver('cache', array('adapter' => 'memcached', 'backup' => 'file'));
        $pre_key = "select_comuna";
        $key = md5($pre_key);
        $CI->load->model('tb_model');
        if ($CI->cache->memcached->is_supported()) { //Si es soportado el cache.
            if ($select = $CI->cache->memcached->get($key)) { //verifica si existe la llave
                $str = generarSelect($select, 'comuna_id', $selected);
                return $str;
            } else {
                $respuesta = $CI->tb_model->tb_listar_cache("REFCENTRAL.COMUNAS");
                $str = generarSelect($respuesta, 'comuna_id', $selected);
                $CI->cache->memcached->save($key, $respuesta, 7200);
                return $str;
            }
        } else {
            $respuesta = $CI->tb_model->tb_listar_cache("REFCENTRAL.COMUNAS");
            $str = generarSelect($respuesta, 'comuna_id', $selected);
            return $str;
        }

    }
}

if (!function_exists('tb_select')) {
    function tb_select($tb_tabla, $name, $seleccionado = FALSE, $select2 = FALSE)
    {
        $CI = get_instance();
        $CI->load->model('tb_model');
        $respuesta_db = $CI->tb_model->tb_listar_cache($tb_tabla);
        return generarSelect($respuesta_db, $name, $seleccionado, $select2);
    }
}


if (!function_exists('bootstrap_form_tb_select')) {
	function bootstrap_form_tb_select($tb_tabla, $name = '', $message = 'Label', $seleccionado = FALSE, $required = FALSE, $select2 = FALSE)
	{
		$has_error = '';
		if (function_exists('form_error'))
			$has_error = (form_error("{$name}") != "") ? " has-error" : "";
		$required = ($required != FALSE) ? '<span class="text-danger">*</span> ' : '';
		$div = "<div class='form-group" . $has_error . "'>";
		$div .= "<label for='" . $name . "' class='control-label col-sm-4'>" . $required . $message . "</label>";
		$div .= "<div class='col-sm-8'>";
		$div .= tb_select($tb_tabla, $name, $seleccionado, $select2);
		return $div .= "</div></div>";
	}
}



/**
 * Crea dps inputs correspondientes para el dato "RUT" del paciente
 * @param string $type tipo del input, por defecto siempre sera text <p>
 * @param string $namedv tipo del input, por defecto siempre sera text <p>
 * @param string $label eiqueta que informa el nombre del campo, por defecto siempre sera RUT <p>
 * @param string $atributosdv atributos del campo correspondiente al digito verificador <p>
 * @param string $atributos atributos del campo rut <p>
 * @param string $required si el campo es requerido o no <p>
 * @return string con todos los inputs para la informacion rut
 */
if (!function_exists('bootstrap_rut_input')) {
    function bootstrap_rut_input($type = 'text', $namedv = '', $name = '', $label = 'RUT', $atributosdv = null, $atributos = null, $required = '')
    {
        $rut = '';
        $has_error = '';
        if (function_exists('form_error'))
            $has_error = (form_error("{$name}") != "") ? " has-error" : "";
        $required = ($required != '') ? '<span class="text-danger">*</span> ' : '';
        $div = "<div class='form-group" . $has_error . "'>";
        if ($atributos != null) {
            if (array_key_exists('id', $atributos)) {
                $div .= "<label for='" . $atributos['id'] .
                    "' class='control-label col-sm-4'>" . $required . $label . "</label>";
                $div .= "<div class='col-xs-6'>";
                $div .= "<input type='" . $type . "' name='" . $name . "'";
            } else {
                $div .= "<label for='" . $name . "' class='control-label col-sm-4'>" . $required . $label . "</label>";
                $div .= "<div class='col-xs-6'>";
                $div .= "<input type='" . $type . "' id='" . $name . "' name='" . $name . "'";
            }
            $atributos['class'] = (isset($atributos['class'])) ? $atributos['class'] . ' form-control' : 'form-control';
            $div .= setAtributos($atributos, "input") . " >";


            $rut .= "<div class=''>";
            $rut .= "<input maxlength='1' style='width:47px; !important' type='" . $type . "' id='" . $namedv . "' name='" . $namedv . "'";
            $atributosdv['class'] = (isset($atributosdv['class'])) ? $atributosdv['class'] . ' form-control' : 'form-control';
            $rut .= setAtributos($atributosdv, "input") . " >";
        } else {
            $div .= "<label for='" . $name . "' class='control-label col-sm-4'>" . $required . $label . "</label>";
            $div .= "<div class='col-xs-6'>";
            $div .= "<input type='" . $type . "' class='form-control' id='" . $name . "' name='" . $name . "'>";


            $rut .= "<div class=''>";
            $rut .= "<input maxlength='1' style='width:47px; !important' type='" . $type . "' id='" . $namedv . "' name='" . $namedv . "'";
            $atributosdv['class'] = (isset($atributosdv['class'])) ? $atributosdv['class'] . ' form-control' : 'form-control';
            $rut .= setAtributos($atributosdv, "input") . " >";
        }

        return $div . "</div>" . $rut .= "</div></div>";
    }
}

/**
 * Crea dps inputs correspondientes para el dato "RUT" del paciente
 * @param string $tb_tabla Base de datos de la cual se tomara la info para llenar el select <p>
 * @param string $nameCalle nombre del input calle - para id y name <p>
 * @param string $nameNumero nombre del input numero de calle - para id y name <p>
 * @param string $name nombre del select referencial - para id y name<p>
 * @param string $message Etiqueta lavel <p>
 * @param string $seleccionado Si esta seleccionado el select<p>
 * @param string $required si el label es obligatorio <p>
 * @param string $select2 si se aplica select2 en el select <p>
 * @param string $atributosCalle atributos del input calle <p>
 * @param string $atributosnum atributo del input numero de calle <p>
 * @return string con todos los inputs para la informacion rut
 */
if (!function_exists('bootstrap_form_tb_direccion_select')) {
    function bootstrap_form_tb_direccion_select($tb_tabla, $nameCalle, $nameNumero, $name = '', $message = 'Label', $seleccionado = FALSE, $required = FALSE, $select2 = FALSE, $atributosCalle, $atributosnum)
    {
        //examples

        $type = 'text';

        $input1 = '';
        $input2 = '';
        $has_error = '';
        if (function_exists('form_error'))
            $has_error = (form_error("{$name}") != "") ? " has-error" : "";
        $required = ($required != FALSE) ? '<span class="text-danger">*</span> ' : '';
        $div = "<div  class='form-group" . $has_error . "'>";
        $div .= "<label for='" . $name . "' class='control-label col-sm-4'>" . $required . $message . "</label>";
        $div .= "<div  ' class='form-group col-sm-4'>";
        $div .= tb_select($tb_tabla, $name, $seleccionado, $select2);
        $input1 .= bootstrap_form_input_lttl($type, $nameCalle, $atributosCalle, TRUE, 3);
        $input2 .= bootstrap_form_input_lttl($type, $nameNumero, $atributosnum, TRUE, 2);
        return $div .= "</div>" . $input1 . $input2 . "</div>";
    }
}

/**
 * Crea dps inputs correspondientes para el dato "RUT" del paciente
 * @param string $type tipo del input, por defecto siempre sera text <p>
 * @param string $name nombre del input - aplica para id y name del mismo <p>
 * @param string $atributos Atributos del input <p>
 * @param string $required Si es input es requerido u obligatorio <p>
 * @param string $espacios Tamaño css del input - efecto visual <p>
 * @return string con todos los inputs para la informacion rut
 */
if (!function_exists('bootstrap_form_input_lttl')) {
    function bootstrap_form_input_lttl($type = 'text', $name = '', $atributos = null, $required = TRUE, $espacios = '0', $largocss = '')
    {
        $var = 'col-sm-' . $espacios;
        $has_error = '';
        if (function_exists('form_error'))
            $has_error = (form_error("{$name}") != "") ? " has-error" : "";
        $required = ($required != '') ? '<span class="text-danger">*</span> ' : '';
        $div = '<div  class="form-group ' . $var . ' ">';
        if ($atributos != null) {
            if (array_key_exists('id', $atributos)) {
                $div .= "<input type='" . $type . "' name='" . $name . "'";
            } else {
                $div .= "<input type='" . $type . "' id='" . $name . "' name='" . $name . "'";
            }
            $atributos['class'] = (isset($atributos['class'])) ? $atributos['class'] . ' form-control' : 'form-control';
            $div .= setAtributos($atributos, "input") . " >";
        } else {
            $div .= "<input type='" . $type . "' class='form-control' id='" . $name . "' name='" . $name . "'>";
        }
        return $div .= "</div>";
    }
}
/********** FIN desde formulario_helper ********/



?>
