$(document).ready(function () {
    // Variables Globales
    var tabla = $('#tabla_pedidos')
    var btn_agregar = $('#btn_agregar_pedidos')
    var modal_alerta_agregar_editar = $('#modal_alerta_agregar_editar')
    var mdl_agregar_editar = $('#modal_agregar_editar_pedidos')
    var mdl_titulo_agregar_editar = $('#titulo_agregar_editar_pedidos')
    var mdl_btn_agregar = $('#btn_agregar_modal')
    var mdl_btn_editar = $('#btn_editar_modal')
    var mdl_id_edit = $('#id_modificar')
    var mdl_id = $("#id");
    var mdl_local = $("#local");
    var mdl_fecha = $("#fecha");
    var mdl_estado_pedido = $("#estado_pedido");
    var mdl_total = $("#total");
    var mdl_numero_ip = $("#numero_ip");
    var mdl_usuario_encargado = $("#usuario_encargado");
    var mdl_usuario_solicita = $("#usuario_solicita");
    var tabla_detalle_pedido = $("#tabla_detalle_pedido")
    // Fin Variables Globales
    // Carga Inicial Web
    var table = tabla.DataTable({
        'language': {
            'url': '/delysoft/public/Spanish.json',
        },
        'ajax': {
            'url': '/delysoft/administracion/pedidos/obtener_listado_pedidos',
            'datatype': 'json',
            'dataSrc': 'data',
            'type': 'post',
        },
        'columns': [
            {'data': 'ID'},
            {'data': 'LOCAL'},
            {'data': 'FECHA'},
            {'data': 'ESTADO_PEDIDO'},
            {
                'data': 'TOTAL',
                render: function (data) {
                    return formato_numero(data, '$', 0)
                }
            },
            {'data': 'USUARIO_ENCARGADO'},
            {'data': 'USUARIO_SOLICITA'},
            {'data': 'ACTIVO'},
            {'data': 'ACCIONES'},
        ],
    })
    // Fin Carga Inicial Web
    // Eventos
    // Agregar Pedido
    btn_agregar.on('click', function () {
        limpieza_modal()
        mdl_btn_agregar.show()
        mdl_titulo_agregar_editar.text('Agregar Pedidos Sistema')
        mdl_agregar_editar.modal('show')
    })
    // Ver Detalle Pedido
    tabla.on('click', '.btn_detalle', function () {
        mdl_titulo_agregar_editar.text('Ver Detalle Pedido');
        var id = $(this).attr('data-id');
        var request = envia_ajax('/delysoft/administracion/pedidos/ver_detalle_pedido', {id: id})
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                mdl_id.val(3500)
                mdl_local.val(data.encabezado[0].LOCAL)
                mdl_fecha.val(data.encabezado[0].FECHA)
                mdl_estado_pedido.val(data.encabezado[0].ESTADO_PEDIDO)
                mdl_total.val(formato_numero(data.encabezado[0].TOTAL,'$ ',0))
                mdl_numero_ip.val(data.encabezado[0].IP)
                mdl_usuario_encargado.val(data.encabezado[0].USUARIO_ENCARGADO)
                mdl_usuario_solicita.val(data.encabezado[0].USUARIO_SOLICITA)
                //rellenamos tabla
                tabla_detalle_pedido.DataTable({
                    'language': {
                        'url': '/delysoft/public/Spanish.json',
                    },
                    'paging': false,
                    'destroy': true,
                    'searching': false,
                    'data': data.detalle,
                    'columns': [
                        {'data': 'ID'},
                        {'data': 'PRODUCTO'},
                        {'data': 'CANTIDAD'},
                        {
                            'data': 'PRECIO',
                            render: function (data) {
                                return formato_numero(data, '$', 0)
                            }
                        },
                        {
                            'data': 'TOTAL',
                            render: function (data) {
                                return formato_numero(data, '$', 0)
                            }
                        },
                        {'data': 'ACTIVO'},
                    ],
                })
                mdl_agregar_editar.modal('show')
            }
            else {
                $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
                $('#modal_generico').modal('show')
            }
        })
    })
    // Agregar Pedidos
    mdl_btn_agregar.on('click', function () {
        var array = {
            'descripcion': mdl_descripcion.val()
        }
        var request = envia_ajax('/delysoft/administracion/pedidos/agregar_pedidos', array)
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
    // Editar Pedidos
    mdl_btn_editar.on('click', function () {
        var array = {
            'id': mdl_id_edit.val(),
            'descripcion': mdl_descripcion.val(),
        }
        var request = envia_ajax(
            '/delysoft/administracion/pedidos/editar_pedidos', array)
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
    // Cambio Estado Pedidos
    tabla.on('click', '.btn_estado', function () {
        var array = {
            'id': $.trim($(this).attr('data-id')),
            'estado': $(this).attr('data-activo'),
        }
        var request = envia_ajax(
            '/delysoft/administracion/pedidos/cambiar_estado_pedidos', array)
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
        //mdl_descripcion.val('')
        modal_alerta_agregar_editar.html('')
        modal_alerta_agregar_editar.removeClass('alert alert-danger')
        mdl_btn_agregar.hide()
        mdl_btn_editar.hide()
    }

    function formato_numero(n, adicional, decimales) {
        n += '' // por si pasan un numero en vez de un string
        n = parseFloat(n.replace(/[^0-9\.]/g, '')) // elimino cualquier cosa que no sea numero o punto
        // si no es un numero o es igual a cero retorno el mismo cero
        if (isNaN(n) || n === 0)
            return parseFloat(0).toFixed(decimales)
        // si es mayor o menor que cero retorno el valor formateado como numero
        n = '' + n.toFixed(decimales)
        var n_separado = n.split('.'),
            regexp = /(\d+)(\d{3})/
        while (regexp.test(n_separado[0]))
            n_separado[0] = n_separado[0].replace(regexp, '$1' + '.' + '$2')
        n = n_separado.join(',')
        n = [n.slice(0, 0), adicional, n.slice(0)].join('')
        return n
    }

    // Fin Funciones
});