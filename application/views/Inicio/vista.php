<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 06-05-2018
 * Time: 0:25
 */
?>
<link rel="stylesheet" href="<?php echo base_url('/public/css/Morris/morris.css') ?>">
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color:#00CCFF;">
            <div class="panel-title pull-left">Bienvenido al Sistema</div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title pull-left"><p>Sistema Base Bienvenido!!!</p></div>
                            <div class="panel-title pull-right"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-success">
                                <p><strong>Bienvenido</strong> Felicitaciones por acceder al Sistema Base</p>
                            </div>
                            <figure>
                                <pre>
                                    <code>
                                        $this->enable_profiler();
                                    </code>
                                </pre>
                                <figcaption>
                                    Funcion para visualizacion de Debug Codeigniter
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-primary">
                            <div class="panel-heading">CANTIDAD PRODUCTOS MAS UTILIZADOS LOCALES</div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div id="grafico_stock_productos_existentes"></div>
                                </div>
                                <div class="col-md-4">
                                    <div id="grafico_stock_productos_existentes_dos"></div>
                                </div>
                                <div class="col-md-4">
                                    <div id="grafico_stock_productos_existentes_tres"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title pull-left">
                                <p>CANTIDAD INGRESO DE STOCK SISTEMA</p>
                            </div>
                            <div class="panel-title pull-right">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div id="grafico_stock_lineal" style="height: 250px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title pull-left"><p>ULTIMOS MOVIMIENTOS LOCAL ACTUAL</p></div>
                            <div class="panel-title pull-right"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <table id="tabla_movimientos"
                                   class="table table-hover table-striped table-responsive table-bordered">
                                <thead>
                                <tr>
                                    <th>MOVIMIENTO</th>
                                    <th>PRODUCTO</th>
                                    <th>CANTIDAD</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><span class="glyphicon glyphicon-minus" style="color:red;"> SALIDA</span></td>
                                    <td><p>PARACETAMOL 500 MG</p></td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td><span class="glyphicon glyphicon-minus" style="color:red;"> SALIDA</span></td>
                                    <td><p>FUROSEMIDA 400 MG</p></td>
                                    <td>350</td>
                                </tr>
                                <tr>
                                    <td><span class="glyphicon glyphicon-minus" style="color:red;"> SALIDA</span></td>
                                    <td><p>NARTAN 2,5 MG</p></td>
                                    <td>148</td>
                                </tr>
                                <tr>
                                    <td><span class="glyphicon glyphicon-plus" style="color:#00CC00;"> INGRESO</span>
                                    </td>
                                    <td><p>FUROSEMIDA 400 MG</p></td>
                                    <td>300</td>
                                </tr>
                                <tr>
                                    <td><span class="glyphicon glyphicon-plus" style="color:#00CC00;"> INGRESO</span>
                                    </td>
                                    <td><p>NARTAN 2,5 MG</p></td>
                                    <td>800</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('/public/graficos/morris.min.js') ?>"></script>
<script src="<?php echo base_url('/public/graficos/raphael-min.js') ?>"></script>
<script>
    $(document).ready(function() {
        graficos();
        $(window).resize(function() {
            window.morris_uno.redraw();
            window.morris_dos.redraw();
            window.morris_tres.redraw();
        });
    });
    function graficos(){
        window.morris_uno = Morris.Donut({
            element: 'grafico_stock_productos_existentes',
            data: [
                {label: "FUROSEMIDA 400 MG", value: 188},
                {label: "NARTAN 2,5 MG", value: 732},
                {label: "PARACETAMOL 500 MG", value: 179}
            ]
        });
        window.morris_dos =Morris.Donut({
            element: 'grafico_stock_productos_existentes_dos',
            data: [
                {label: "FUROSEMIDA 400 MG", value: 304},
                {label: "NARTAN 2,5 MG", value: 805},
                {label: "PARACETAMOL 500 MG", value: 291}
            ]
        });
        window.morris_tres =Morris.Donut({
            element: 'grafico_stock_productos_existentes_tres',
            data: [
                {label: "FUROSEMIDA 400 MG", value: 900},
                {label: "NARTAN 2,5 MG", value: 486},
                {label: "PARACETAMOL 500 MG", value: 674}
            ]
        });
        Morris.Area({
            element: 'grafico_stock_lineal',
            data: [
                {y: '2017-12', a: 741, b: 564, c: 814},
                {y: '2018-01', a: 456, b: 977, c: 825},
                {y: '2018-02', a: 823, b: 664, c: 885},
                {y: '2018-03', a: 850, b: 426, c: 549},
                {y: '2018-04', a: 324, b: 704, c: 557},
                {y: '2018-05', a: 660, b: 115, c: 875},
                {y: '2018-06', a: 308, b: 794, c: 959}
            ],
            xkey: 'y',
            ykeys: ['a', 'b', 'c'],
            labels: ['Local A', 'Local B', 'Local C'],
            fillOpacity: 0.6,
            hideHover: 'auto',
            pointStrokeColors: ['black'],
            pointFillColors: ['#ffffff'],
            behaveLikeLine: true,
            resize: true,
            lineColors: ['gray', 'red', 'blue']
        });
    }
</script>
