$(document).ready(function () {
  // Variables Globales
  var tabla = $('#tabla_usuarios')
  var btn_agregar_usuarios = $('#btn_agregar_usuarios')
  var modal_alerta_agregar_editar = $('#modal_alerta_agregar_editar')
  var mdl_agregar_editar = $('#modal_agregar_editar_usuario')
  var mdl_titulo_agregar_editar = $('#titulo_agregar_editar_usuario')
  var mdl_btn_agregar = $('#btn_agregar_modal')
  var mdl_btn_editar = $('#btn_editar_modal')
  var mdl_nombre = $('#nombre')
  var mdl_correo = $('#correo')
  var mdl_usuario = $('#usuario')
  var mdl_password = $('#password')
  var mdl_perfil = $('#perfil')
  // Fin Variables Globales
  // Carga Inicial Web
  mdl_perfil.select2()
  tabla.DataTable({
    'language': {
      'url': '/delysoft/public/Spanish.json',
    },
    'ajax': {
      'url': '/delysoft/administracion/usuarios/obtener_listado_usuarios',
      'datatype': 'json',
      'dataSrc': 'data',
      'type': 'post',
    },
    'columns': [
      {'data': 'ID'},
      {'data': 'NOMBRE'},
      {'data': 'USUARIO'},
      {'data': 'CORREO'},
      {'data': 'ACTIVO'},
      {'data': 'PERFIL'},
      {'data': 'ACCIONES'},
    ],
  })
  // Fin Carga Inicial Web
  // Eventos
  btn_agregar_usuarios.on('click', function () {
    modal_alerta_agregar_editar.html('')
    mdl_agregar_editar.modal('show')
  })
  tabla.on('click', '.btn_editar', function () {
    //Limpieza alerta
    limpieza_modal()
    // Carga de datos modal Editar
    $('#id_modificar').val($(this).attr('data-id'))
    $('#edit_usuario').val($(this).attr('data-usuario'))
    $('#edit_nombre').val($(this).attr('data-nombres'))
    $('#edit_estado').val($(this).attr('data-estado'))
    $('#edit_perfil').val($(this).attr('data-perfil')).trigger('change.select2')
    mdl_agregar_editar.modal('show')
  })
  /*
  $('#tabla_usuarios').
    on('click', '> tbody > tr > td:nth-child(6) > .btn_estado', function () {
      var array = {
        'id': $.trim($(this).attr('data-id')),
        'estado': $(this).attr('data-estado'),
      }
      var request = envia_ajax(
        '/infraestructura/mantenedores/usuarios/cambiar_estado_usuario', array)
      request.fail(function () {
        $('#modal_generico_body').
          html('Error al enviar peticion porfavor recargue la pagina')
        $('#modal_generico').modal('show')
      })
      request.done(function (data) {
        if (data.respuesta == 'S') {
          tabla.ajax.reload()
        }
        else {
          $('#modal_generico_body').html(data.data)
          $('#modal_generico').modal('show')
        }
      })
    })
    */
  $('#btn_agregar_modal').on('click', function () {
    var array = {
      'usuario': $('#add_usuario').val(),
      'password': $('#add_password').val(),
      'nombres': $('#add_nombre').val(),
      'perfil': $('#add_perfil').val(),
    }
    var request = envia_ajax(
      '/infraestructura/mantenedores/usuarios/agregar_usuario', array)
    request.fail(function () {
      $('#modal_generico_body').
        html('Error al enviar peticion porfavor recargue la pagina')
      $('#modal_generico').modal('show')
    })
    request.done(function (data) {
      if (data.respuesta == 'S') {
        tabla.ajax.reload()
        $('#modal_agregar').modal('hide')
        $('#modal_generico_body').html(data.data)
        $('#modal_generico').modal('show')
      }
      else {
        $('#modal_alerta_agregar').html(data.data)
        $('#modal_alerta_agregar').addClass('alert alert-danger')
      }
    })
  })
  $('#btn_editar_modal').on('click', function () {
    var array = {
      'id': $('#id_modificar').val(),
      'usuario': $('#edit_usuario').val(),
      'nombres': $('#edit_nombre').val(),
      'perfil': $('#edit_perfil').val(),
    }
    var request = envia_ajax(
      '/infraestructura/mantenedores/usuarios/editar_usuario', array)
    request.fail(function () {
      $('#modal_generico_body').
        html('Error al enviar peticion porfavor recargue la pagina')
      $('#modal_generico').modal('show')
    })
    request.done(function (data) {
      if (data.respuesta == 'S') {
        tabla.ajax.reload()
        $('#modal_editar').modal('hide')
        $('#modal_generico_body').html(data.data)
        $('#modal_generico').modal('show')
      }
      else {
        $('#modal_alerta_editar').html(data.data)
        $('#modal_alerta_editar').addClass('alert alert-danger')
      }
    })
  })
  // Fin Eventos
  // Funciones
  function envia_ajax (url, data) {
    var variable = $.ajax({
      url: url,
      method: 'POST',
      data: data,
      'dataSrc': 'data',
      dataType: 'json',
    })
    return variable
  }
  function limpieza_modal () {
    mdl_nombre.val('')
    mdl_correo.val('')
    mdl_usuario.val('')
    mdl_password.val('')
  }
  // Fin Funciones
})