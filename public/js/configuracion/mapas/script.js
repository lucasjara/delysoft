$(document).ready(function () {
// Variables Globales
    // CRUD Zonas
    var btn_agregar = $('#btn_agregar_zonas')
    var modal_alerta_agregar_editar = $('#modal_alerta_agregar_editar')
    var mdl_agregar_editar = $('#modal_agregar_editar_zonas')
    var mdl_titulo_agregar_editar = $('#titulo_agregar_editar_zonas')
    var mdl_btn_agregar = $('#btn_agregar_modal')
    var mdl_btn_editar = $('#btn_editar_modal')
    var mdl_nombre = $('#nombre')
    var mdl_descripcion = $('#descripcion')
    var mdl_local = $('#local').select2()
    var mdl_id_edit = $('#id_modificar')
// Fin Variables Globales
// Carga Inicial Web
    var tabla = $("#tabla_zonas_local")
    var table = tabla.DataTable({
        'language': {
            'url': '/public/Spanish.json',
        },
        'ajax': {
            'url': '/configuracion/mapas/obtener_listado_zonas_local',
            'datatype': 'json',
            'dataSrc': 'data',
            'type': 'post',
        },
        'columns': [
            {'data': 'CUADRO'},
            {'data': 'NOMBRE'},
            {'data': 'ACCIONES'},
        ],
        'columnDefs': [
            {
                "targets": 0, // your case first column
                "className": "text-center",
                "width": "10%"
            },
            {
                "targets": 2,
                "className": "text-right",
            }],
        "order": [[ 1, "asc" ]]
    })
// Fin Carga Inicial Web
// Eventos
    btn_agregar.on('click', function () {
        limpieza_modal()
        mdl_btn_agregar.show()
        mdl_titulo_agregar_editar.text('Agregar Zona Local')
        mdl_agregar_editar.modal('show')
    })
    tabla.on('click', '.btn_editar', function () {
        limpieza_modal()
        mdl_btn_editar.show()
        mdl_titulo_agregar_editar.text('Editar Zona Local')
        // Carga de datos modal Editar
        mdl_id_edit.val($(this).attr('data-id'))
        mdl_descripcion.val($(this).attr('data-descripcion'))
        mdl_nombre.val($(this).attr('data-nombre'))
        mdl_agregar_editar.modal('show')
    })
    mdl_btn_agregar.on('click', function () {
        var array = {
            'nombre': mdl_nombre.val(),
            'descripcion': mdl_descripcion.val()
        }
        var request = envia_ajax('/configuracion/mapas/agregar_zona_local', array)
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
    // Editar Zonas
    mdl_btn_editar.on('click', function () {
        var array = {
            'id': mdl_id_edit.val(),
            'descripcion': mdl_descripcion.val(),
            'nombre': mdl_nombre.val()
        }
        var request = envia_ajax('/configuracion/mapas/editar_zona_local', array)
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
    // Cambio Estado Zonas
    tabla.on('click', '.btn_estado', function () {
        var array = {
            'id': $.trim($(this).attr('data-id')),
            'estado': $(this).attr('data-activo'),
        }
        var request = envia_ajax('/administracion/zonas/cambiar_estado_zonas', array)
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
        modal_alerta_agregar_editar.html('')
        modal_alerta_agregar_editar.removeClass('alert alert-danger')
        mdl_btn_agregar.hide()
        mdl_btn_editar.hide()
    }

// Fin Funciones
});