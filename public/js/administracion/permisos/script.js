$(document).ready(function () {
    // Variables Globales
    var tabla = $('#tabla_permisos')
    var btn_agregar = $('#btn_agregar_permisos')
    var modal_alerta_agregar_editar = $('#modal_alerta_agregar_editar')
    var mdl_agregar_editar = $('#modal_agregar_editar_permisos')
    var mdl_titulo_agregar_editar = $('#titulo_agregar_editar_permisos')
    var mdl_btn_agregar = $('#btn_agregar_modal')
    var mdl_btn_editar = $('#btn_editar_modal')
    var mdl_descripcion = $('#descripcion')
    var mdl_nombre = $("#nombre")
    var mdl_url = $("#url")
    var mdl_id_edit = $('#id_modificar')
    // Fin Variables Globales
    // Carga Inicial Web
    var table = tabla.DataTable({
        'language': {
            'url': '/public/Spanish.json',
        },
        'ajax': {
            'url': '/administracion/permisos/obtener_listado_permisos',
            'datatype': 'json',
            'dataSrc': 'data',
            'type': 'post',
        },
        'columns': [
            {'data': 'ID'},
            {'data': 'NOMBRE'},
            {'data': 'DESCRIPCION'},
            {'data': 'URL'},
            {'data': 'ACTIVO'},
            {'data': 'ACCIONES'},
        ],
    })
    // Fin Carga Inicial Web
    // Eventos
    btn_agregar.on('click', function () {
        limpieza_modal()
        mdl_btn_agregar.show()
        mdl_titulo_agregar_editar.text('Agregar permisos Sistema')
        mdl_agregar_editar.modal('show')
    })
    tabla.on('click', '.btn_editar', function () {
        limpieza_modal()
        mdl_btn_editar.show()
        mdl_titulo_agregar_editar.text('Editar permisos Sistema')
        // Carga de datos modal Editar
        mdl_id_edit.val($(this).attr('data-id'))
        mdl_descripcion.val($(this).attr('data-descripcion'))
        mdl_nombre.val($(this).attr('data-nombre'))
        mdl_url.val($(this).attr('data-url'))
        mdl_agregar_editar.modal('show')
    })
    // Agregar permisos
    mdl_btn_agregar.on('click', function () {
        var array = {
            'descripcion': mdl_descripcion.val(),
            'nombre': mdl_nombre.val(),
            'url': mdl_url.val()
        }
        var request = envia_ajax('/administracion/permisos/agregar_permisos', array)
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
    // Editar permisos
    mdl_btn_editar.on('click', function () {
        var array = {
            'id': mdl_id_edit.val(),
            'descripcion': mdl_descripcion.val(),
            'nombre': mdl_nombre.val(),
            'url': mdl_url.val()
        }
        var request = envia_ajax(
            '/administracion/permisos/editar_permisos', array)
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
    // Cambio Estado permisos
    tabla.on('click', '.btn_estado', function () {
        var array = {
            'id': $.trim($(this).attr('data-id')),
            'estado': $(this).attr('data-activo'),
        }
        var request = envia_ajax(
            '/administracion/permisos/cambiar_estado_permisos', array)
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
        mdl_url.val('')
        modal_alerta_agregar_editar.html('')
        modal_alerta_agregar_editar.removeClass('alert alert-danger')
        mdl_btn_agregar.hide()
        mdl_btn_editar.hide()
    }

    // Fin Funciones
});