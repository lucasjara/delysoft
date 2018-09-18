$(document).ready(function () {
// Variables Globales
    var btn_login = $("#btn_login")
    var usuario = $("#usuario")
    var password = $("#password")
// Fin Variables Globales
// Carga Inicial Web
// Fin Carga Inicial Web
// Eventos
    btn_login.on('click',function () {
        var array = {
            'usuario': usuario.val(),
            'password':password.val()
        }
        var request = envia_ajax('/delysoft/inicio/login_sistema', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            $('#modal_generico_body').html(data.data)
            $('#modal_generico').modal('show')
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
});