$(document).ready(function () {
// Variables Globales
    var btn_local = $("#btn_confirmar_local")
    var contenido_cargo = $("#contenido_cargo")
    var tabla_cargos = $("#tabla_cargos")
    var usuario_select = $("#usuario_select2");
    var btn_agregar_cargo = $("#btn_agregar_cargo")
    var btn_informacion = $("#btn_confirmar_informacion")
    // Crud Productos
    var tabla = $('#tabla_productos')
    var btn_agregar = $('#btn_agregar_productos')
    var modal_alerta_agregar_editar = $('#modal_alerta_agregar_editar')
    var mdl_agregar_editar = $('#modal_agregar_editar_productos')
    var mdl_titulo_agregar_editar = $('#titulo_agregar_editar_productos')
    var mdl_btn_agregar = $('#btn_agregar_modal')
    var mdl_btn_editar = $('#btn_editar_modal')
    var mdl_descripcion = $('#descripcion')
    var mdl_nombre = $('#nombre')
    var mdl_precio = $('#precio')
    var mdl_id_edit = $('#id_modificar')
    var table = tabla.DataTable({
        'language': {
            'url': '/delysoft/public/Spanish.json',
        },
        'ajax': {
            'url': '/delysoft/configuracion/base/obtener_listado_productos_local',
            'datatype': 'json',
            'dataSrc': 'data',
            'type': 'post',
        },
        'columns': [
            {'data': 'NOMBRE'},
            {'data': 'DESCRIPCION'},
            {'data': 'PRECIO'},
            {'data': 'ACTIVO'},
            {'data': 'ACCIONES'},
        ],
    })
    // Fin Crud Productos
// Fin Variables Globales
// Carga Inicial Web
    $("#panel_cargo").select2().width("100%");
    $("#panel_region").select2();
    $("#panel_ciudad").select2();
    tabla_cargos.DataTable({
        'language': {
            'url': '/delysoft/public/Spanish.json',
        },
        destroy: true
    });

    $("#example1").select2({
        placeholder: "Seleccionar Usuario Sistema",
        minimumInputLength: 3,
        language: {
            noResults: function () {

                return "No hay resultado";
            },
            searching: function () {

                return "Buscando..";
            },
            inputTooShort: function () {
                return 'Porfavor Agregar 2 Caracteres.';
            }
        },
        multiple: false,
        width: 400,
        ajax: {
            url: '/delysoft/administracion/Usuarios/busca_usuario_json',
            dataType: 'json',
            data: function (term) {
                return {
                    usuario: term.term
                }
            },
            processResults: function (data, params) {
                var results = [];
                data.items.forEach(function (element) {
                    results.push({
                        id: element.ID,
                        usuario: element.USUARIO.toUpperCase()
                    });
                });
                return {
                    results: results
                };
                return {
                    usuario: term.term
                }
            }

        },
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 2,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    });

    function formatRepo(item) {
        if (item.loading) {
            return item.text;
        }
        var markup = $("<div>" +
            "<strong>" + item.usuario + "</strong>" +
            "<div>" +
            "<small></small>" +
            "</div>" +
            "<div>");
        return markup;
    }

    function formatRepoSelection(item) {
        return item.usuario || item.text;
    }

// Fin Carga Inicial Web
// Eventos
    btn_agregar_cargo.on('click', function () {
        var select_automatico = $("#example1").val();
        var select_cargo = $("#panel_cargo").val();
        if (select_automatico) {
            var array = {
                'usuario': select_automatico,
                'cargo': select_cargo
            }
            var request = envia_ajax('/delysoft/configuracion/base/agregar_cargo_local', array)
            request.fail(function () {
                $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
                $('#modal_generico').modal('show')
            })
            request.done(function (data) {
                if (data.respuesta == 'S') {
                    tabla_cargos.DataTable({
                        language: {
                            'url': '/delysoft/public/Spanish.json',
                        },
                        destroy: true,
                        data: data.data,
                        columns: [
                            {'data': 'NOMBRE'},
                            {'data': 'USUARIO'},
                            {'data': 'PERFIL'},
                            {'data': 'ACTIVO'},
                            {'data': 'ACCIONES'},
                        ]
                    });
                }
                else {
                    modal_alerta_agregar_editar.html(data.data)
                    modal_alerta_agregar_editar.addClass('alert alert-danger')
                }
            })
        }
    });
    btn_agregar.on('click', function () {
        limpieza_modal()
        mdl_btn_agregar.show()
        mdl_titulo_agregar_editar.text('Agregar Producto')
        mdl_agregar_editar.modal('show')
    })
    tabla.on('click', '.btn_editar', function () {
        limpieza_modal()
        mdl_btn_editar.show()
        mdl_titulo_agregar_editar.text('Editar Producto')
        // Carga de datos modal Editar
        mdl_id_edit.val($(this).attr('data-id'))
        mdl_nombre.val($(this).attr('data-nombre'))
        mdl_precio.val($(this).attr('data-precio'))
        mdl_descripcion.val($(this).attr('data-descripcion'))
        mdl_agregar_editar.modal('show')
    })
    // Agregar Productos
    mdl_btn_agregar.on('click', function () {
        var array = {
            'descripcion': mdl_descripcion.val(),
            'nombre': mdl_nombre.val(),
            'precio': mdl_precio.val()
        }
        var request = envia_ajax('/delysoft/configuracion/base/agregar_productos_local', array)
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
    // Editar Productos
    mdl_btn_editar.on('click', function () {
        var array = {
            'id': mdl_id_edit.val(),
            'descripcion': mdl_descripcion.val(),
            'nombre': mdl_nombre.val(),
            'precio': mdl_precio.val()
        }
        var request = envia_ajax(
            '/delysoft/configuracion/base/editar_productos_local', array)
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
    // Cambio Estado Productos
    tabla.on('click', '.btn_estado', function () {
        var array = {
            'id': $.trim($(this).attr('data-id')),
            'estado': $(this).attr('data-activo'),
        }
        var request = envia_ajax(
            '/delysoft/configuracion/base/cambiar_estado_productos_local', array)
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
    // Confirmar Informacion Evento
    btn_informacion.on('click', function () {
        var array =  {
            'nombre': panel_nombre.val(),
            'descripcion': panel_descripcion.val(),
            'region': panel_region.val(),
            'ciudad': panel_ciudad.val()
        }
        var request = envia_ajax('/delysoft/configuracion/base/confirmar_informacion',array)
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
        mdl_precio.val('')
        modal_alerta_agregar_editar.html('')
        modal_alerta_agregar_editar.removeClass('alert alert-danger')
        mdl_btn_agregar.hide()
        mdl_btn_editar.hide()
    }

// Fin Funciones
});