$(document).ready(function () {
    // Variables Globales
    var btn_generar = $('#btn_generar_mantenedor')
    var titulos = $("#titulos")
    var controlador = $("#controlador")
    var modelo = $("#modelo")
    var alias = $("#alias")
    var tabla = $("#tabla")
    var helper = $("#helper")
    // Fin Variables Globales
    // Carga Inicial Web

    // Fin Carga Inicial Web
    // Eventos
    btn_generar.on('click',function () {
        var array = {
            'titulos': titulos.val(),
            'controlador': controlador.val(),
            'modelo': modelo.val(),
            'alias': alias.val(),
            'tabla': tabla.val(),
            'helper': helper.val()
        }
        var request = envia_ajax('/administracion/generico/generar_mantenedor', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                $('#contenedor_html').text(data.html)
                $('#contenedor_controlador').text(data.controlador)
                $('#contenedor_modelo').text(data.modelo)
                $('#contenedor_js').text(data.js)
            } else {
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

    // Fin Funciones
})