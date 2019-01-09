$(document).ready(function () {
// Funciones Mapa
    var mapa;
    var all_overlays = [];
    var all_markers_repartidor = [];
    var all_markers_objetivo = [];
    var prev_infowindow = false;
    const iniciarMapa = (posicion) => {
        latitud = -38.7362442;
        longitud = -72.5905979;
        ubicacion_actual = {lat: latitud, lng: longitud};
        mapa = new google.maps.Map(document.getElementById('mapa'), {
            center: ubicacion_actual,
            zoom: 13,
            disableDefaultUI: true,
        });
        CargarMapasActivos();
        var run = setInterval(CargarMapasActivos, 10000);
    };
    const CargarMapasActivos = () => {
        var request = envia_ajax('/administrativo/pedidos/obtener_ubicacion_repartidores')
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                for (var i = 0; i < data.data.length; i++) {
                    let latitud = parseFloat(data.data[i].LATITUD);
                    let longitud = parseFloat(data.data[i].LONGITUD);
                    let latitud_destino = parseFloat(data.data[i].LATITUD_DESTINO);
                    let longitud_destino = parseFloat(data.data[i].LONGITUD_DESTINO);
                    var ubicacion_random = {lat: latitud, lng: longitud}
                    let estado_pedido = data.data[i].ESTADO_PEDIDO;
                    let producto = data.data[i].PRODUCTO;
                    let cantidad = data.data[i].CANTIDAD;
                    let precio = data.data[i].PRECIO;
                    let color = data.data[i].COLOR;
                    let color_moto = data.data[i].COLOR_MOTO;
                    switch (estado_pedido) {
                        case "4":
                            estado_pedido = "En Camino";
                            break;
                        case "5":
                            estado_pedido = "Recibido";
                            break;
                        case "10":
                            estado_pedido = "En Destino";
                            break;
                    }
                    AgregarMarcadoresRepartidor(ubicacion_random, estado_pedido, producto, cantidad, precio, color_moto)
                    ubicacion_random = {lat: latitud_destino, lng: longitud_destino}
                    AgregarMarcadoresLugarDestino(ubicacion_random, producto, cantidad, precio, color)
                }
            }
            else {
                //$('#modal_generico_body').html(data.data)
                //$('#modal_generico').modal('show')
            }
        })
    }
    const AgregarMarcadoresRepartidor = (ubicacion_actual, tipo, producto, cantidad, precio, color_moto) => {
        switch (color_moto) {
            case "https://www.infest.cl/public/icon/scooter-red.png":
                color_moto = "Rojo";
                break;
            case "https://www.infest.cl/public/icon/scooter-green.png":
                color_moto = "Verde";
                break;
            case "https://www.infest.cl/public/icon/scooter-blue.png":
                color_moto = "Celeste";
                break;
            case "https://www.infest.cl/public/icon/scooter-yellow.png":
                color_moto = "Amarillo";
                break;
        }
        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';

        let infowindow = new google.maps.InfoWindow({
            content: FormatoTarjeta(tipo, producto, cantidad, precio, color_moto)
        });
        let marker = new google.maps.Marker({
            position: ubicacion_actual,
            map: mapa,
            title: "Repartidor",
            icon: {
                url: iconBase + "motorcycling.png"
            }
        });
        all_markers_repartidor.push(marker);
        marker.addListener('click', function () {
            if (prev_infowindow) {
                prev_infowindow.close();
            }
            prev_infowindow = infowindow;
            infowindow.open(mapa, marker);
        });
    };
    const AgregarMarcadoresLugarDestino = (ubicacion_actual, producto, cantidad, precio, color) => {
        var iconBase = 'https://maps.google.com/mapfiles/kml/paddle/';
        let infowindow = new google.maps.InfoWindow({
            content: FormatoTarjetaDestino(producto, cantidad, precio)
        });
        let marker = new google.maps.Marker({
            position: ubicacion_actual,
            map: mapa,
            title: "Lugar Destino",
            icon: {
                url: iconBase + color
            }
        });
        all_markers_repartidor.push(marker);
        marker.addListener('click', function () {
            if (prev_infowindow) {
                prev_infowindow.close();
            }
            prev_infowindow = infowindow;
            infowindow.open(mapa, marker);
        });
    };
    const FormatoTarjetaDestino = (producto, cantidad, precio) => {
        const contenidoTarjeta =
            '<div class="card info" id="myinfo">' +
            '<div class="card-body" style="padding: 10px;">' +
            '<p style="text-align: center;margin: 0px;padding: 0px;">Detalle Pedido</p>' +
            '<hr style="margin:5px;">' +
            '<p style="text-align: center;margin: 0px;padding: 0px;">' + producto.substr(0, 19) + '</p>' +
            '<p style="text-align: center;margin: 0px;padding: 0px;">Cantidad: ' + cantidad + '</p>' +
            '<p style="text-align: center;margin: 0px;padding: 0px;">Precio: ' + formato_numero(precio, '$', 0) + '</p>' +
            '<hr style="margin:5px;">' +
            '<p style="text-align: center;margin: 0px;padding: 0px;">Total: ' + formato_numero((cantidad * precio), '$', 0) + '</p>' +
            '</div>' +
            '</div>';
        return contenidoTarjeta;
    };
    const FormatoTarjeta = (tipo, producto, cantidad, precio, color_moto) => {
        const contenidoTarjeta =
            '<div class="card info" id="myinfo">' +
            '<div class="card-body" style="padding: 10px;">' +
            '<p style="text-align: center;margin: 0px;padding: 0px;">Destino: ' + color_moto + '</p>' +
            '<hr style="margin:5px;">' +
            '<p style="text-align: center;margin: 0px;padding: 0px;">' + producto.substr(0, 19) + '</p>' +
            '<p style="text-align: center;margin: 0px;padding: 0px;">Cantidad: ' + cantidad + '</p>' +
            '<p style="text-align: center;margin: 0px;padding: 0px;">Precio: ' + formato_numero(precio, '$', 0) + '</p>' +
            '<hr style="margin:5px;">' +
            '<p style="text-align: center;margin: 0px;padding: 0px;">Total: ' + formato_numero((cantidad * precio), '$', 0) + '</p>' +
            '</div>' +
            '<div class="card-footer" style="padding: 0px;">' +
            '<p style="text-align: center;margin: 0px;padding: 5px;">Estado: ' + tipo + '</p>' +
            '</div>' +
            '</div>';
        return contenidoTarjeta;
    };

    function OcultarInfoWindows(map) {
        all_markers.forEach(function (marker) {
            marker.infowindow.close(marker)
        });
    }

    navigator.geolocation.getCurrentPosition(function (posicion) {
        iniciarMapa(posicion);
    });
// Fin Funciones Mapa
    // Funciones Generales
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

    // Fin funciones Generales
});
