$(document).ready(function () {
// Variables Globales
    // Inicio Mapa
    let latitud;
    let longitud;
    let mapa;
    let ubicacion_actual;
    var zona;
    // Fin Mapa
    // CRUD Zonas
    var btn_agregar = $('#btn_agregar_zonas')
    var modal_alerta_agregar_editar = $('#modal_alerta_agregar_editar')
    var mdl_agregar_editar = $('#modal_agregar_editar_zonas')
    var mdl_titulo_agregar_editar = $('#titulo_agregar_editar_zonas')
    var mdl_btn_agregar = $('#btn_agregar_modal')
    var mdl_btn_editar = $('#btn_editar_modal')
    var mdl_nombre = $('#nombre')
    var mdl_descripcion = $('#descripcion')
    var mdl_local = $('#local').select2()
    var mdl_id_edit = $('#id_modificar')
    var mdl_agregar_productos = $("#modal_agregar_productos")
    var modal_alerta_productos = $("#modal_alerta_productos_zona")
    var titulo_mdl_productos = $("#titulo_agregar_productos_zonas")
    var id_zona = $("#id_zona")
    var tabla_productos_zona = $("#tabla_productos_zona")
    var btn_agregar_prod = $("#btn_agregar_producto")
    // Modal Prod
    var mdl_nom = $('#mdl_nom')
    var mdl_desc = $('#mdl_desc')
    var mdl_precio = $('#mdl_precio')
// Fin Variables Globales
// Carga Inicial Web
    var tabla = $("#tabla_zonas_local")
    var table = tabla.DataTable({
        'language': {
            'url': '/public/Spanish.json',
        },
        'ajax': {
            'url': '/configuracion/mapas/obtener_listado_zonas_local',
            'datatype': 'json',
            'dataSrc': 'data',
            'type': 'post',
        },
        'columns': [
            {'data': 'CUADRO'},
            {'data': 'NOMBRE'},
            {'data': 'ACCIONES'},
        ],
        'columnDefs': [
            {
                "targets": 0, // your case first column
                "className": "text-center",
                "width": "10%"
            },
            {
                "targets": 2,
                "className": "text-right",
            }],
        "order": [[1, "asc"]],
        "initComplete": function (settings, json) {
            navigator.geolocation.getCurrentPosition(function (posicion) {
                iniciarMapa(posicion);
            });
            $("#demo").collapse();
        }
    })
// Fin Carga Inicial Web
// Eventos
    btn_agregar.on('click', function () {
        limpieza_modal()
        mdl_btn_agregar.show()
        mdl_titulo_agregar_editar.text('Agregar Zona Local')
        mdl_agregar_editar.modal('show')
    })
    tabla.on('click', '.btn_editar', function () {
        limpieza_modal()
        mdl_btn_editar.show()
        mdl_titulo_agregar_editar.text('Editar Zona Local')
        // Carga de datos modal Editar
        mdl_id_edit.val($(this).attr('data-id'))
        mdl_descripcion.val($(this).attr('data-descripcion'))
        mdl_nombre.val($(this).attr('data-nombre'))
        mdl_agregar_editar.modal('show')
    })
    tabla.on('click', '.btn_limpieza', function () {
        var array = {
            'id_zona': $(this).attr('data-id')
        }
        var request = envia_ajax('/configuracion/mapas/limpieza_detalle_zona', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                mdl_agregar_editar.modal('hide')
                //mapa.overlay.setMap(null);
                table.ajax.reload()
            }
            else {
                modal_alerta_agregar_editar.html(data.data)
                modal_alerta_agregar_editar.addClass('alert alert-danger')
            }
        })
    })
    tabla.on('click', '.btn_producto', function () {
        let zona = $(this).attr('data-id')
        var array = {
            'id_zona': zona
        }
        var request = envia_ajax('/configuracion/mapas/obtener_productos_zona', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                titulo_mdl_productos.text('Listado de Productos en Zona')
                mdl_agregar_productos.modal('show')
                id_zona.val(zona)
                cargar_productos_zona(data.data)
            }
            else {
                modal_alerta_productos.html(data.data)
                modal_alerta_productos.addClass('alert alert-danger')
            }
        })
    })
    mdl_btn_agregar.on('click', function () {
        var array = {
            'nombre': mdl_nombre.val(),
            'descripcion': mdl_descripcion.val()
        }
        var request = envia_ajax('/configuracion/mapas/agregar_zona_local', array)
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
    // Editar Zonas
    mdl_btn_editar.on('click', function () {
        var array = {
            'id': mdl_id_edit.val(),
            'descripcion': mdl_descripcion.val(),
            'nombre': mdl_nombre.val()
        }
        var request = envia_ajax('/configuracion/mapas/editar_zona_local', array)
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
    // Cambio Estado Zonas
    tabla.on('click', '.btn_estado', function () {
        var array = {
            'id': $.trim($(this).attr('data-id')),
            'estado': $(this).attr('data-activo'),
        }
        var request = envia_ajax('/administracion/zonas/cambiar_estado_zonas', array)
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
    tabla.on('click', '.check_zona', function () {
        var array = {
            'id': $(this).attr('data-id')
        }
        zona = $(this).attr('data-id')
        var request = envia_ajax('/configuracion/mapas/buscar_zona_mapa', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                let valor = data.data.length;
                if (valor < 0) {
                    AgregarDibujo()
                } else {
                    AgregarDibujo()
                }
            }
            else {
                $('#modal_generico_body').html(data.data)
                $('#modal_generico').modal('show')
            }
        })
    })
    btn_agregar_prod.on('click', function () {
        var array = {
            'id_zona': id_zona.val(),
            'nombre': mdl_nom.val(),
            'descripcion': mdl_desc.val(),
            'precio': mdl_precio.val()
        }
        var request = envia_ajax("/configuracion/mapas/agregar_producto_zona", array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                cargar_productos_zona(data.data)
                $('#formulario_productos_modal').trigger("reset");
            }
            else {
                $('#modal_generico_body').html(data.data)
                $('#modal_generico').modal('show')
            }
        })
    })
    tabla_productos_zona.on('click','.btn_editar',function () {

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
    function cargar_productos_zona(data) {
        if(data == null){
            tabla_productos_zona.dataTable().fnClearTable();
        }else{
            tabla_productos_zona.DataTable({
                'language': {
                    'url': '/public/Spanish.json',
                },
                'data': data,
                'columns': [
                    {'data': 'PRODUCTO'},
                    {'data': 'DESCRIPCION'},
                    {'data': 'PRECIO'},
                    {'data': 'ACTIVO'},
                    {'data': 'ACCIONES'},
                ],
                "order": [[0, "asc"]],
                destroy: true,
                responsive: true
            });
        }
    }
// Fin Funciones
// Funciones Mapa
    var all_overlays = [];
    const iniciarMapa = (posicion) => {
        // latitud = posicion.coords.latitude;
        // longitud = posicion.coords.longitude;
        latitud = -38.7362442;
        longitud = -72.5905979;
        ubicacion_actual = {lat: latitud, lng: longitud};
        mapa = new google.maps.Map(document.getElementById('map'), {
            center: ubicacion_actual,
            zoom: 13
        });
        CargarMapasActivos()
        /*
        let marker = new google.maps.Marker({
            position: ubicacion_actual,
            map: mapa,
            title: 'Ubicacion Actual'
        });
        */
    };
    const CargarMapasActivos = () => {
        var MapasActivos = []
        $("#tabla_zonas_local .check_zona").each(function () {
            if ($(this).prop('checked')) {
                MapasActivos.push($(this).attr('data-id'))
            }
        })
        // Si el numero es menor a cero no exiten poligonos creados
        if (MapasActivos.length > 0) {
            var array = {
                'id_zonas': MapasActivos
            }
            var request = envia_ajax('/configuracion/mapas/buscar_zonas_mapas', array)
            request.fail(function () {
                $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
                $('#modal_generico').modal('show')
            })
            request.done(function (data) {
                if (data.respuesta == 'S') {
                    AgregarPoligonoMapa(data.zonas, data.data);
                }
                else {
                    $('#modal_generico_body').html(data.data)
                    $('#modal_generico').modal('show')
                }
            })
        }

    }
    const AgregarDibujo = () => {
        let drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: ['polygon'],
            },
            markerOptions: {icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'},
            circleOptions: {
                fillColor: '#ffff00',
                fillOpacity: 1,
                strokeWeight: 5,
                clickable: false,
                editable: true,
                zIndex: 1,
            },
        })
        drawingManager.setMap(mapa)
        google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
            drawingManager.setDrawingMode(null)
            var coordinates = (polygon.getPath().getArray());
            var path = polygon.getPath();
            let longitud = [];
            let latitud = [];
            for (var i = 0; i < coordinates.length; i++) {
                longitud.push(path.getAt(i).lng())
                latitud.push(path.getAt(i).lat())
            }
            var array = {
                'id_zona': zona,
                'latitud': latitud,
                'longitud': longitud
            }
            var request = envia_ajax('/configuracion/mapas/guardar_detalle_zona', array)
            request.fail(function () {
                $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
                $('#modal_generico').modal('show')
            })
            request.done(function (data) {
                if (data.respuesta == 'S') {
                    $("#map").html("");
                    iniciarMapa();
                }
                else {
                    $('#modal_generico_body').html(data.data)
                    $('#modal_generico').modal('show')
                }
            })
        });
    }
    const AgregarPoligono = (data) => {
        var CoordenadasZona = []
        for (var i = 0; i < data.length; i++) {
            CoordenadasZona.push({lat: parseFloat(data[i].LATITUD), lng: parseFloat(data[i].LONGITUD)})
        }
        // Construct the polygon.
        var zona = new google.maps.Polygon({
            paths: CoordenadasZona,
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35
        });
        zona.setMap(mapa);
    }
    const AgregarPoligonoMapa = (zonas, data) => {
        var contador = 0;
        var CoordenadasZona = []
        var zona;
        for (var i = 0; i < zonas.length; i++) {
            CoordenadasZona = []
            for (var y = 0; y < data[contador].length; y++) {
                CoordenadasZona.push({
                    lat: parseFloat(data[contador][y].LATITUD),
                    lng: parseFloat(data[contador][y].LONGITUD)
                })
            }
            // Construir Poligono.
            zona = new google.maps.Polygon({
                paths: CoordenadasZona,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35
            });
            zona.setMap(mapa);
            contador++;
        }
    }
// Fin Funciones Mapa
});