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
                mdl_titulo_agregar_editar.text('Modificar Información Usuario')
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
    // Grafico funcion del tiempo
    var request = envia_ajax('/administrativo/inicio/obtener_datos_grafico_tiempo')
    request.fail(function () {
        $('#contenedor_graficos').html("<div class='alert alert-info'>No se pudo cargar el Grafico Correctamente porfavor recargue la pagina</div>");
        $('#contenedor_graficos').show()
    })
    request.done(function (data) {
        if (data.respuesta == 'S') {
            $('#contenedor_graficos').show()
            var datos = [];
            for (var x = 0; x < data.data.length; x++) {
                datos.push({
                    fecha: data.data[x]['FECHA'],
                    cantidad: data.data[x]['CANTIDAD']
                });
            }
            new Morris.Line({
                element: 'grafico_tiempo',
                data: datos,
                xkey: 'fecha',
                ykeys: ['cantidad'],
                labels: ['Cantidad Pedidos'],
                xLabelFormat: function (d) {
                    return d.getDate() + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
                },
                dateFormat: function (date) {
                    d = new Date(date);
                    return d.getDate() + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
                },
                xLabelAngle: -80,
            });
            var datos_bar = [];
            for (var x = 0; x < data.data_bar.length; x++) {
                datos_bar.push({
                    label: data.data_bar[x]['ZONA'],
                    value: data.data_bar[x]['CANTIDAD_PEDIDOS'],
                    value: data.data_bar[x]['VALORIZADO']
                });
            }
            Morris.Donut({
                element: 'grafico_char_zonas',
                data: datos_bar,
                formatter: function (y) {
                    return '$' + formatoNumero(y)
                },
                colors: ['#FE2E2E', '#FFFF00', '#01DF01', '#013ADF', '#FE2EF7']
            });
        }
        else {
            $('#contenedor_graficos').html("<div class='alert alert-info' style='margin-left: 1%;margin-right: 1%;width: 100%;'><strong>Alerta </strong>" + data.data + "</div>")
            $('#contenedor_graficos').show()
        }
    })
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

    function formatoNumero(num) {
        if (!num || num == 'NaN') return '-';
        if (num == 'Infinity') return '&#x221e;';
        num = num.toString().replace(/\$|\,/g, '');
        if (isNaN(num))
            num = "0";
        sign = (num == (num = Math.abs(num)));
        num = Math.floor(num * 100 + 0.50000000001);
        cents = num % 100;
        num = Math.floor(num / 100).toString();
        if (cents < 10)
            cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
            num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
        return (((sign) ? '' : '-') + num);
    }

// Fin Funciones
});