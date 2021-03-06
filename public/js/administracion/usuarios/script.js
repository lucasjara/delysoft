$(document).ready(function () {
    // Variables Globales
    var tabla = $('#tabla_usuarios')
    var btn_agregar_usuarios = $('#btn_agregar_usuarios')
    var modal_alerta_agregar_editar = $('#modal_alerta_agregar_editar')
    var mdl_agregar_editar = $('#modal_agregar_editar_usuario')
    var mdl_titulo_agregar_editar = $('#titulo_agregar_editar_usuario')
    var mdl_btn_agregar = $('#btn_agregar_modal')
    var mdl_btn_editar = $('#btn_editar_modal')
    var mdl_nombre = $('#nombre')
    var mdl_correo = $('#correo')
    var mdl_usuario = $('#usuario')
    var mdl_password = $('#password')
    var mdl_perfil = $('#perfil')
    var mdl_activo = $("#activo")
    var mdl_id_edit = $("#id_modificar")
    var contenedor_password = $("#contenedor_password")
    // Fin Variables Globales
    // Carga Inicial Web
    mdl_perfil.select2()
    var table = tabla.DataTable({
        'language': {
            'url': '/public/Spanish.json',
        },
        'ajax': {
            'url': '/administracion/usuarios/obtener_listado_usuarios',
            'datatype': 'json',
            'dataSrc': 'data',
            'type': 'post',
        },
        'columns': [
            {'data': 'ID'},
            {'data': 'NOMBRE'},
            {'data': 'USUARIO'},
            {'data': 'CORREO'},
            {'data': 'ACTIVO'},
            {'data': 'PERFIL'},
            {'data': 'ACCIONES'},
        ],
    })
    // Fin Carga Inicial Web
    // Eventos
    btn_agregar_usuarios.on('click', function () {
        limpieza_modal()
        mdl_btn_agregar.show()
        mdl_titulo_agregar_editar.text('Agregar Usuario Sistema')
        contenedor_password.show()
        mdl_agregar_editar.modal('show')
    })
    tabla.on('click', '.btn_editar', function () {
        limpieza_modal()
        mdl_btn_editar.show()
        mdl_titulo_agregar_editar.text('Editar Usuario Sistema')
        // Carga de datos modal Editar
        mdl_id_edit.val($(this).attr('data-id'))
        mdl_usuario.val($(this).attr('data-usuario'))
        mdl_correo.val($(this).attr('data-correo'))
        mdl_nombre.val($(this).attr('data-nombre'))
        mdl_activo.val($(this).attr('data-activo'))
        contenedor_password.hide()
        mdl_perfil.val($(this).attr('data-perfil')).trigger('change.select2')
        mdl_agregar_editar.modal('show')
    })
    // Agregar Usuario
    mdl_btn_agregar.on('click', function () {
        var array = {
            'usuario': mdl_usuario.val(),
            'password': mdl_password.val(),
            'nombre': mdl_nombre.val(),
            'correo': mdl_correo.val(),
            'perfil': mdl_perfil.val()
        }
        var request = envia_ajax('/administracion/usuarios/agregar_usuario', array)
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
    // Editar Usuario
    mdl_btn_editar.on('click', function () {
        var array = {
            'id': mdl_id_edit.val(),
            'usuario': mdl_usuario.val(),
            'nombre': mdl_nombre.val(),
            'correo': mdl_correo.val(),
            'perfil': mdl_perfil.val(),
        }
        var request = envia_ajax(
            '/administracion/usuarios/editar_usuario', array)
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
    // Cambio Estado
    tabla.on('click', '.btn_estado', function () {
        var array = {
            'id': $.trim($(this).attr('data-id')),
            'estado': $(this).attr('data-activo'),
        }
        var request = envia_ajax(
            '/administracion/usuarios/cambiar_estado_usuario', array)
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
        mdl_nombre.val('')
        mdl_correo.val('')
        mdl_usuario.val('')
        mdl_password.val('')
        modal_alerta_agregar_editar.html('')
        modal_alerta_agregar_editar.removeClass('alert alert-danger')
        mdl_btn_agregar.hide()
        mdl_btn_editar.hide()
    }

    // Fin Funciones
})