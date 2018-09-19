$(document).ready(function () {
// Variables Globales
    var btn_login = $("#btn_login")
    var usuario = $("#usuario")
    var password = $("#password")
// Fin Variables Globales
// Carga Inicial Web
// Fin Carga Inicial Web
// Eventos

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