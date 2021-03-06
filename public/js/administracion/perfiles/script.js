$(document).ready(function () {
    // Variables Globales
    var tabla = $('#tabla_perfiles')
    var btn_agregar = $('#btn_agregar_perfiles')
    var modal_alerta_agregar_editar = $('#modal_alerta_agregar_editar')
    var mdl_agregar_editar = $('#modal_agregar_editar_perfiles')
    var mdl_titulo_agregar_editar = $('#titulo_agregar_editar_perfiles')
    var mdl_btn_agregar = $('#btn_agregar_modal')
    var mdl_btn_editar = $('#btn_editar_modal')
    var mdl_descripcion = $('#descripcion')
    var mdl_nombre = $('#nombre')
    var mdl_id_edit = $('#id_modificar')
    // Fin Variables Globales
    // Carga Inicial Web
    var table = tabla.DataTable({
        'language': {
            'url': '/public/Spanish.json',
        },
        'ajax': {
            'url': '/administracion/perfiles/obtener_listado_perfiles',
            'datatype': 'json',
            'dataSrc': 'data',
            'type': 'post',
        },
        'columns': [
            {'data': 'ID'},
            {'data': 'NOMBRE'},
            {'data': 'DESCRIPCION'},
            {'data': 'ACTIVO'},
            {'data': 'ACCIONES'},
        ],
        destroy: true,
        responsive: true,
        columnDefs: [
            {className: "text-right", "targets": [4]}
        ]

    })
    $("#select_permisos").select2();
    // Fin Carga Inicial Web
    // Eventos
    btn_agregar.on('click', function () {
        limpieza_modal()
        mdl_btn_agregar.show()
        mdl_titulo_agregar_editar.text('Agregar perfiles Sistema')
        mdl_agregar_editar.modal('show')
    })
    tabla.on('click', '.btn_editar', function () {
        limpieza_modal()
        mdl_btn_editar.show()
        mdl_titulo_agregar_editar.text('Editar perfiles Sistema')
        // Carga de datos modal Editar
        mdl_id_edit.val($(this).attr('data-id'))
        mdl_nombre.val($(this).attr('data-nombre'))
        mdl_descripcion.val($(this).attr('data-descripcion'))
        mdl_agregar_editar.modal('show')
    })
    // Agregar perfiles
    mdl_btn_agregar.on('click', function () {
        var array = {
            'descripcion': mdl_descripcion.val(),
            'nombre': mdl_nombre.val()
        }
        var request = envia_ajax('/administracion/perfiles/agregar_perfiles', array)
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
    // Editar perfiles
    mdl_btn_editar.on('click', function () {
        var array = {
            'id': mdl_id_edit.val(),
            'descripcion': mdl_descripcion.val(),
            'nombre': mdl_nombre.val()
        }
        var request = envia_ajax(
            '/administracion/perfiles/editar_perfiles', array)
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
    // Cambio Estado perfiles
    tabla.on('click', '.btn_estado', function () {
        var array = {
            'id': $.trim($(this).attr('data-id')),
            'estado': $(this).attr('data-activo'),
        }
        var request = envia_ajax(
            '/administracion/perfiles/cambiar_estado_perfiles', array)
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
    // Asignar Permisos Perfil
    tabla.on('click', '.btn_permisos_perfil', function () {
        var dato_id = $.trim($(this).attr('data-id'));
        var array = {
            'id': $.trim($(this).attr('data-id'))
        }
        var request = envia_ajax('/administracion/perfiles/obtener_permisos_local', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                $("#tabla_permisos_perfil").DataTable({
                    'language': {
                        'url': '/public/Spanish.json',
                    },
                    data: data.data,
                    'columns': [
                        {'data': 'ID'},
                        {'data': 'NOMBRE'},
                        {'data': 'DESCRIPCION'},
                        {'data': 'ACTIVO'},
                        {'data': 'ACCIONES'},
                    ],
                    destroy: true,
                    responsive: true,
                    searching: false,
                    columnDefs: [
                        {className: "text-right", "targets": [4]}
                    ]
                });
                $("#modal_agregar_editar_permisos_perfil").modal('show')
                $("#id_perfil_edit").val(dato_id)
            }
            else {
                $('#modal_generico_body').html(data.data)
                $('#modal_generico').modal('show')
            }
        })
    });
    $("#btn_agregar_permiso").on('click',function () {
        var array = {
            'id_permiso': $("#select_permisos").val(),
            'id_perfil': $("#id_perfil_edit").val()
        }
        var request = envia_ajax('/administracion/perfiles/vincular_permisos_perfil', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if(data.respuesta == "S"){
                $("#tabla_permisos_perfil").DataTable({
                    'language': {
                        'url': '/public/Spanish.json',
                    },
                    data: data.data,
                    'columns': [
                        {'data': 'ID'},
                        {'data': 'NOMBRE'},
                        {'data': 'DESCRIPCION'},
                        {'data': 'ACTIVO'},
                        {'data': 'ACCIONES'},
                    ],
                    destroy: true,
                    responsive: true,
                    searching: false,
                    columnDefs: [
                        {className: "text-right", "targets": [4]}
                    ]
                });
            }else{
                $('#modal_generico_body').html(data.data)
                $('#modal_generico').modal('show')
            }
        });
    });
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