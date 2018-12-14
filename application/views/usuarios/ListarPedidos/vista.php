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



            <?php for($i=0;$i<10;$i++){?>

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
                                        <dt>Producto:</dt>
                                        <dd>Completo Ilatiano</dd>
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
                                        <dt>Observacion:</dt>
                                        <dd>Luis duran #1313</dd>
                                    </dl>
                                </div>
                                <div class="col-md-3">
                                    <dl>
                                        <dt>FECHA:</dt>
                                        <dd>13-12-2018</dd>
                                    </dl>
                                </div>
                            </div>

                            <div class="row">
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
