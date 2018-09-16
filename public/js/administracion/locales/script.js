$(document).ready(function () {
    // Variables Globales
    var tabla = $('#tabla_locales')
    var btn_agregar = $('#btn_agregar_locales')
    var modal_alerta_agregar_editar = $('#modal_alerta_agregar_editar')
    var mdl_agregar_editar = $('#modal_agregar_editar_locales')
    var mdl_titulo_agregar_editar = $('#titulo_agregar_editar_locales')
    var mdl_btn_agregar = $('#btn_agregar_modal')
    var mdl_btn_editar = $('#btn_editar_modal')
    var mdl_nombre = $('#nombre')
    var mdl_descripcion = $('#descripcion')
    var mdl_id_edit = $('#id_modificar')
    var mdl_region = $("#region").select2()
    var mdl_ciudad = $("#ciudad").select2()
    var mdl_detalle = $("#modal_ver_detalle_locales")
    var mdl_titulo_detalle = $("#titulo_modal_ver_detalle_locales")
    var contenido_tabla_local = $("#contenedor_tabla_cargos_local")
    var contenedor_encargado_local = $("#contenedor_encargado_local")
    var btn_guardar_encargado = $("#btn_guardar_encargado")
    var mdl_mod_local = $("#id_mod_local");
    // Fin Variables Globales
    // Carga Inicial Web
    var table = tabla.DataTable({
        'language': {
            'url': '/delysoft/public/Spanish.json',
        },
        'ajax': {
            'url': '/delysoft/administracion/locales/obtener_listado_locales',
            'datatype': 'json',
            'dataSrc': 'data',
            'type': 'post',
        },
        'columns': [
            {'data': 'ID'},
            {'data': 'NOMBRE'},
            {'data': 'DESCRIPCION'},
            {'data': 'REGION'},
            {'data': 'CIUDAD'},
            {'data': 'ACTIVO'},
            {'data': 'ACCIONES'},
        ],
    })
    // Fin Carga Inicial Web
    // Eventos
    btn_agregar.on('click', function () {
        limpieza_modal()
        mdl_btn_agregar.show()
        mdl_titulo_agregar_editar.text('Agregar Locales Sistema')
        mdl_agregar_editar.modal('show')
    })
    tabla.on('click', '.btn_editar', function () {
        limpieza_modal()
        mdl_btn_editar.show()
        mdl_titulo_agregar_editar.text('Editar Locales Sistema')
        // Carga de datos modal Editar
        mdl_id_edit.val($(this).attr('data-id'))
        mdl_nombre.val($(this).attr('data-nombre'))
        mdl_descripcion.val($(this).attr('data-descripcion'))
        mdl_region.val($(this).attr('data-region')).trigger('change.select2')
        mdl_ciudad.val($(this).attr('data-ciudad')).trigger('change.select2')
        mdl_agregar_editar.modal('show')
    })
    tabla.on('click', '.btn_detalle', function () {
        var nombre = $(this).attr('data-nombre');
        var id = $(this).attr('data-id')
        mdl_mod_local.val(id)
        mdl_titulo_detalle.text("Listado Encargados " + nombre)
        buscar_detalle(id)
    })
    btn_guardar_encargado.on('click', function () {
        var id = mdl_mod_local.val()
        buscar_detalle_mod(id)
    });
    // Agregar Locales
    mdl_btn_agregar.on('click', function () {
        var array = {
            'descripcion': mdl_descripcion.val(),
            'nombre': mdl_nombre.val(),
            'region': mdl_region.val(),
            'ciudad': mdl_ciudad.val()
        }
        var request = envia_ajax('/delysoft/administracion/locales/agregar_locales', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                mdl_agregar_editar.modal('hide')
                table.ajax.reload();
            }
            else {
                modal_alerta_agregar_editar.html(data.data)
                modal_alerta_agregar_editar.addClass('alert alert-danger')
            }
        })
    })
    // Editar Locales
    mdl_btn_editar.on('click', function () {
        var array = {
            'id': mdl_id_edit.val(),
            'descripcion': mdl_descripcion.val(),
            'nombre': mdl_nombre.val(),
            'region': mdl_region.val(),
            'ciudad': mdl_ciudad.val()
        }
        var request = envia_ajax(
            '/delysoft/administracion/locales/editar_locales', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                mdl_agregar_editar.modal('hide')
                table.ajax.reload()
            }
            else {
                modal_alerta_agregar_editar.html(data.data)
                modal_alerta_agregar_editar.addClass('alert alert-danger')
            }
        })
    })
    // Cambio Estado Locales
    tabla.on('click', '.btn_estado', function () {
        var array = {
            'id': $.trim($(this).attr('data-id')),
            'estado': $(this).attr('data-activo'),
        }
        var request = envia_ajax(
            '/delysoft/administracion/locales/cambiar_estado_locales', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                table.ajax.reload()
            }
            else {
                $('#modal_generico_body').html(data.data)
                $('#modal_generico').modal('show')
            }
        })
    })
    // Fin Eventos
    // Funciones
    function formato_tabla(data) {
        let formato = "";
        data.forEach(function (element) {
            formato = formato + "<tr>";
            formato = formato + "<td>"+element.NOMBRE+"</td>";
            formato = formato + "<td>"+element.USUARIO+"</td>";
            formato = formato + "<td>"+element.PERFIL+"</td>";
            formato = formato + "</tr>";
        });
        return formato;
    }

    function buscar_detalle(id) {
        var array = {
            'id': id
        }
        var request = envia_ajax('/delysoft/administracion/locales/ver_detalle_locales', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                contenido_tabla_local.html("");
                if (data.data != null) {
                    contenedor_encargado_local.hide()
                    contenido_tabla_local.html(formato_tabla(data.data))
                } else {
                    contenedor_encargado_local.show()
                    $("#usuario").select2();
                }
                mdl_detalle.modal('show')
            }
            else {

            }
        })
    }

    function buscar_detalle_mod(id) {
        var array = {
            'id': id,
            'usuario': $("#usuario").val()
        }
        var request = envia_ajax('/delysoft/administracion/locales/agregar_encargado_local', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                contenedor_encargado_local.hide()
                contenido_tabla_local.html(formato_tabla(data.data))
            }
            else {

            }
        })
    }

    function envia_ajax(url, data) {
        var variable = $.ajax({
            url: url,
            method: 'POST',
            data: data,
            'dataSrc': 'data',
            dataType: 'json',
        })
        return variable
    }

    function limpieza_modal() {
        mdl_descripcion.val('')
        mdl_nombre.val('')
        modal_alerta_agregar_editar.html('')
        modal_alerta_agregar_editar.removeClass('alert alert-danger')
        mdl_btn_agregar.hide()
        mdl_btn_editar.hide()
    }

    // Fin Funciones
});