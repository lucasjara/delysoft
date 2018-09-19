$(document).ready(function () {
// Variables Globales
    var btn_mod_info = $("#btn_modificar_datos_usuario");
// CRUD Informacion Personal
    var btn_agregar_usuarios = $('#btn_agregar_usuarios')
    var modal_alerta_agregar_editar = $('#modal_alerta_agregar_editar')
    var mdl_agregar_editar = $('#modal_agregar_editar_usuario')
    var mdl_titulo_agregar_editar = $('#titulo_agregar_editar_usuario')
    var mdl_btn_agregar = $('#btn_agregar_modal')
    var mdl_btn_editar = $('#btn_editar_modal')
    var mdl_nombre = $('#nombre')
    var mdl_correo = $('#correo')
    var mdl_id_edit = $("#id_modificar")
    var contenedor_password = $("#contenedor_password")
//--------------------------
// Fin Variables Globales
// Carga Inicial Web
// Fin Carga Inicial Web
// Eventos
    btn_mod_info.on('click', function () {
        var request = envia_ajax('/administrativo/inicio/obtener_datos_usuario')
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                limpieza_modal()
                mdl_btn_editar.show()
                mdl_titulo_agregar_editar.text('Editar Usuario')
                mdl_id_edit.val(data.data.ID)
                mdl_correo.val(data.data.CORREO)
                mdl_nombre.val(data.data.NOMBRE)
                mdl_agregar_editar.modal('show')
            }
            else {
                $('#modal_generico_body').html(data.data)
                $('#modal_generico').modal('show')
            }
        })
    })
    // Editar Usuario
    mdl_btn_editar.on('click', function () {
        var array = {
            'id': mdl_id_edit.val(),
            'nombre': mdl_nombre.val(),
            'correo': mdl_correo.val()
        }
        var request = envia_ajax('/administrativo/inicio/editar_datos_usuario', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                mdl_agregar_editar.modal('hide')
            }
            else {
                modal_alerta_agregar_editar.html(data.data)
                modal_alerta_agregar_editar.addClass('alert alert-danger')
            }
        })
    })
    // Cambio Estado
    //
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
        modal_alerta_agregar_editar.html('')
        modal_alerta_agregar_editar.removeClass('alert alert-danger')
        mdl_btn_agregar.hide()
        mdl_btn_editar.hide()
    }

// Fin Funciones
});