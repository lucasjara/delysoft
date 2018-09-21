<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 19-09-2018
 * Time: 12:55
 */
?>
<style type="text/css">
    #map {
        width: 100%;
        height: 600px;
    }
</style>
<div class="row" style="margin-left: 1%;margin-right: 1%;margin-top: 1%;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title pull-left"><p>CONFIGURAR ZONAS DE TRABAJO</p></div>
            <div class="panel-title pull-right"></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title pull-left"><p>ZONAS DE TRABAJO</p></div>
                            <div class="panel-title pull-right"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="panel-title pull-left"><p>ZONAS DISPONIBLES</p></div>
                            <div class="panel-title pull-right">
                                <button class="btn btn-primary">AGREGAR PRODUCTO</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>SELECCIONAR</th>
                                    <th>NOMBRE ZONA</th>
                                    <th>ACCIONES</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="checkbox" name="check"></td>
                                    <td>ZONA A</td>
                                    <td>
                                        <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                    class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="check"></td>
                                    <td>ZONA B</td>
                                    <td>
                                        <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                    class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="check"></td>
                                    <td>ZONA C</td>
                                    <td>
                                        <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                    class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <hr>
                            <h3>Detalle Zona A</h3>
                            <table class="table table-responsive table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>PRODUCTO</th>
                                    <th>PRECIO</th>
                                    <th>ACCIONES</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>SUSHI 27 PIEZAS</td>
                                    <td>$8.500</td>
                                    <td>
                                        <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                    class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SUSHI 36 PIEZAS</td>
                                    <td>$10.000</td>
                                    <td>
                                        <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                    class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SUSHI 54 PIEZAS</td>
                                    <td>$13.000</td>
                                    <td>
                                        <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                    class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SUSHI 63 PIEZAS</td>
                                    <td>$15.500</td>
                                    <td>
                                        <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                    class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
</script>
