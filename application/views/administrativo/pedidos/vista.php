<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-11-2018
 * Time: 0:27
 */
?>
<style type="text/css">
    #mapa {
        width: 100%;
        height: 800px;
    }
</style>
<div class="row" style="margin-left: 1%;margin-right: 1%;margin-top: 1%;">
    <div class="card" style="width: 100%;">
        <div class="card-header">
            <div class="float-left"><p>SEGUIMIENTO DE PEDIDOS ACTIVOS</p></div>
        </div>
        <div class="card-body">
            <div id="mapa"></div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('/public/js/administrativo/pedidos/script.js') ?>"></script>
<style>
    #myinfo  .card-title {
        font-family: 'Open Sans Condensed', sans-serif;
        font-size: 22px;
        font-weight: 400;
        padding: 10px;
        background-color: #48b5e9;
        color: white;
        margin: 1px;
        border-radius: 2px 2px 0 0; /* In accordance with the rounding of the default infowindow corners. */
    }
</style>