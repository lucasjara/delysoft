$(document).ready(function () {
    let latitud;
    let longitud;
    let mapa;
    let ubicacion_actual;
    const iniciarMapa = (posicion) => {
        latitud = posicion.coords.latitude;
        longitud = posicion.coords.longitude;
        ubicacion_actual = {lat: latitud, lng: longitud};
        mapa = new google.maps.Map(document.getElementById('map'), {
            center: ubicacion_actual,
            zoom: 18
        });
        let marker = new google.maps.Marker({
            position: ubicacion_actual,
            map: mapa,
            title: 'Ubicacion Actual'
        });
        AgregarDibujo()
    };
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
    }
    navigator.geolocation.getCurrentPosition(function (posicion) {
        iniciarMapa(posicion);
    });
});
