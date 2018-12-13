$(document).ready(function () {
// Variables Globales
    var nombre = $("#txt_nombre")
    var usuario = $("#txt_usuario")
    var correo = $("#txt_email")
    var password = $("#txt_password")
    var btn_guardar = $("#btn_guardar")

    var mdl_agregar_editar = $('#modal_agregar_editar_usuario')
    var modal_alerta_agregar_editar = $('#modal_alerta_agregar_editar')
// Fin Variables Globales
// Carga Inicial Web
// Fin Carga Inicial Web
// Eventos
    //Agregar Usuario
    btn_guardar.on('click', function(){
        var array ={
            'nombre' : nombre.val(),
            'usuario' : usuario.val(),
            'correo' : correo.val(),
            'password': password.val(),
            'perfil' : 0
        }

        var request = envia_ajax('/delysoft/repartidor/registro/registrarRepartidor', array)
        request.fail(function(){
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })

        request.done(function (data) {
            if (data.respuesta == 'S') {
                alert("funka")
            }
            else {
                alert(data.data)
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
// Fin Funciones
})
