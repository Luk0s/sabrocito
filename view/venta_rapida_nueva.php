<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.inc';
?>

<!DOCTYPE html>
<html class="has-navbar-fixed-top">
<?php include RUTA . 'view/header.inc'; ?>
<body>
<?php include RUTA . 'view/navbar.inc'; ?>
<section class="section">
    <div class="container">
        <form method="post" action="<?= URL ?>controller/router.php" id="form-venta-rapida">
            <input type="hidden" name="tabla" value="venta" />
            <input type="hidden" name="accion" value="nuevaRapida" />
            <input type="hidden" name="detalle" value="" />
            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            <div class="select">
                                <select id="cmb_producto">
                                    <optgroup label="Bebidas">
                                    <?php foreach (\model\dao\Bebida::obtenerTodas() as $bebida) { ?>
                                        <option data-precio="<?= $bebida->getPrecio() ?>"
                                            value="bebida_<?= $bebida->getId() ?>">
                                            <?= $bebida->getDescripcion() ?>
                                        </option>
                                    <?php } ?>
                                    </optgroup>
                                    <optgroup label="Otros">
                                        <?php foreach (\model\dao\Otro::obtenerTodos() as $otro) { ?>
                                            <option data-precio="<?= $otro->getPrecio() ?>"
                                                value="otro_<?= $otro->getId() ?>">
                                                <?= $otro->getDescripcion() ?>
                                            </option>
                                        <?php } ?>
                                    </optgroup>
                                    <optgroup label="Jugos">
                                        <?php foreach (\model\dao\Jugo::obtenerTodos() as $jugo) { ?>
                                            <option data-precio="<?= $jugo->getPrecio() ?>" data-precio-leche="<?= $jugo->getPrecioLeche() ?>"
                                                value="jugo_<?= $jugo->getId() ?>">
                                                <?= $jugo->getDescripcion() ?>
                                            </option>
                                        <?php } ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="control">
                            <button class='button is-primary' type='button' id="btn_agregar">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <table class="table is-bordered is-fullwidth">
            <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="tbl_venta_rapida_detalle"></tbody>
            <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th id="th_total"></th>
            </tr>
            </tfoot>
        </table>
        <div class="field is-grouped">
            <div class="control">
                <div class="select">
                    <select name="pago_tipo" form="form-venta-rapida">
                        <option value="1">Efectivo</option>
                        <option value="2">Débito</option>
                        <option value="3">Crédito</option>
                    </select>
                </div>
            </div>
            <div class="control">
                <button class="button is-success" id="btn_guardar">Guardar</button>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="<?= URL ?>resource/js/venta_rapida.js"></script>
</body>
</html>