<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 13-12-2018
 * Time: 2:02
 */?>
<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 02-12-2018
 * Time: 3:27
 */?>
<div class="row" style="margin-top:50px;">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div id="accordion">



            <?php for($i=1;$i<11;$i++){?>

                <div class="card">
                    <div class="card-header" id="heading<?php echo $i?>">
                        <div class="row" style="margin-top:10px;">
                            <div class="col-md-10">
                                PEDIDO N°<?php echo $i?>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-submit" data-toggle="collapse" data-target="#collapse<?php echo $i?>" aria-expanded="false" aria-controls="collapseOne">
                                    +Detalle
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="collapse<?php echo $i?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">



                            <div class="row">
                                <div class="col-md-3">
                                    <dl>
                                        <dt>FECHA:</dt>
                                        <dd>13-12-2018</dd>
                                    </dl>
                                </div>
                                <div class="col-md-3">
                                    <dl>
                                        <dt>Producto:</dt>
                                        <dd>Completo Ilatiano</dd>
                                    </dl>
                                </div>
                                <div class="col-md-3">
                                    <dl>
                                        <dt>Estado:</dt>
                                        <dd>Recibido</dd>
                                    </dl>
                                </div>
                                <div class="col-md-3">
                                    <dl>
                                        <dt>Cliente:</dt>
                                        <dd>Leo_sayayin_777</dd>
                                    </dl>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-3">
                                    <dl>
                                        <dt>Observacion:</dt>
                                        <dd>Luis duran #1313</dd>
                                    </dl>
                                </div>
                                <div class="col-md-3">
                                    <dl>
                                        <dt>Cantidad:</dt>
                                        <dd>2</dd>
                                    </dl>
                                </div>
                                <div class="col-md-3">
                                    <dl>
                                        <dt>Precio Unitario:</dt>
                                        <dd>$1.000</dd>
                                    </dl>
                                </div>
                                <div class="col-md-3">
                                    <dl>
                                        <dt>Total:</dt>
                                        <dd>$2.000</dd>
                                    </dl>
                                </div>
                            </div>









                        </div>
                    </div>
                </div>
            <?php }?>


        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<!-- Fin Modal Agregar / Editar Usuario -->
<script src="<?php echo base_url('/public/js/repartidor/listarPedidos/script.js') ?>"></script>