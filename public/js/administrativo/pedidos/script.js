$(document).ready(function () {
// Funciones Mapa
var mapa;
var all_overlays = [];
const iniciarMapa = (posicion) => {
    latitud = -38.7362442;
    longitud = -72.5905979;
    ubicacion_actual = {lat: latitud, lng: longitud};
    mapa = new google.maps.Map(document.getElementById('map'), {
        center: ubicacion_actual,
        zoom: 13,
        disableDefaultUI: true,
    });
    CargarMapasActivos()
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
                $("#mapa").html("");
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
    var color;
    for (var i = 0; i < zonas.length; i++) {
        CoordenadasZona = []
        for (var y = 0; y < data[contador].length; y++) {
            CoordenadasZona.push({
                lat: parseFloat(data[contador][y].LATITUD),
                lng: parseFloat(data[contador][y].LONGITUD)
            })
            color = data[contador][y].HEXADECIMAL;
        }
        zona = new google.maps.Polygon({
            paths: CoordenadasZona,
            strokeColor: color,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: color,
            fillOpacity: 0.35
        });
        zona.setMap(mapa);
        contador++;
    }
}
// Fin Funciones Mapa
});