$(document).ready(function () {
// Variables Globales
    var nombre = $("#txt_nombre")
    var usuario = $("#txt_usuario")
    var correo = $("#txt_email")
    var password = $("#txt_password")
    var new_password = $("#txt_new_password")
    var btn_guardar = $("#btn_guardar")
    var btn_editar = $("#btn_editar")
    var btn_cancelar = $("#btn_cancelar")
    var btn_new_password =$("#btn_new_password")
    var l_nombre = nombre.val()
    var l_usuario = usuario.val()
    var l_correo = correo.val()

    $("#div_hide").hide();
// Fin Variables Globales
// Carga Inicial Web
// Fin Carga Inicial Web
// Eventos

    btn_new_password.click(function(){
        var nodo = $(this).attr("href");

        if ($(nodo).is(":visible")){
            $(nodo).hide();
            new_password.val('');
            return false;
        }else{
            $(".oculto").hide("slow");
            $(nodo).fadeToggle("fast");
            return false;
        }
    })


    //habilitar campos
    btn_editar.on('click', function () {
        nombre.prop('disabled', false);
        usuario.prop('disabled', false);
        correo.prop('disabled', false);
        password.prop('disabled', false);
        btn_guardar.prop('disabled', false);
        btn_cancelar.prop('disabled', false);
        btn_new_password.prop('disabled', false);
    })
    //Desahabilitar campos
    btn_cancelar.on('click', function () {
        nombre.val(l_nombre)
        nombre.prop('disabled', true);
        usuario.val(l_usuario)
        usuario.prop('disabled', true);
        correo.val(l_correo)
        correo.prop('disabled', true);
        password.val('')
        new_password.val('')
        password.prop('disabled', true);
        new_password.val('');
        btn_new_password.prop('disabled', true);
        btn_guardar.prop('disabled', true);
        btn_cancelar.prop('disabled', true);
        btn_new_password.prop('disabled', true);
        $("#div_hide").hide();

    })

    //modificar usuario
    btn_guardar.on('click', function () {
        if (password.val() != '') {
            //falta agregar un id de un repartidor
            var array = {
                'nombre': nombre.val(),
                'usuario': usuario.val(),
                'correo': correo.val(),
                'password': password.val(),
                'id': 13,
                'perfil': 0
            }
            //SI LA CLAVE ES VALIDA
            if (true) {
                var request = envia_ajax('/delysoft/repartidor/modificar/editarRepartidor', array)
                request.fail(function () {
                    $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
                    $('#modal_generico').modal('show')
                })
                request.done(function (data) {
                    if (data.respuesta == 'S') {
                        alert("funka")
                        l_nombre = nombre.val()
                        l_usuario = usuario.val()
                        l_correo = correo.val()
                        nombre.val(l_nombre)
                        nombre.prop('disabled', true);
                        usuario.val(l_usuario)
                        usuario.prop('disabled', true);
                        correo.val(l_correo)
                        correo.prop('disabled', true);
                        password.val('')
                        password.prop('disabled', true);
                        btn_guardar.prop('disabled', true);
                        btn_cancelar.prop('disabled', true);
                    }
                    else {
                        alert(data.data)
                    }
                })
            }
        }
        else {
            alert("pass vacia")
        }
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
