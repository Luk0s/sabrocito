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
        <form method="post" action="<?= URL ?>controller/router.php" id="form-venta-cocina">
            <input type="hidden" name="tabla" value="venta" />
            <input type="hidden" name="accion" value="nuevaCocina" />
            <input type="hidden" name="detalle_simple" value="" />
            <input type="hidden" name="detalle_menu" value="" />
            <input type="hidden" name="detalle_cena" value="" />
            <div class="columns">
                <div class="column is-4">
                    <label class="label">Plato Simple</label>
                    <div class="field is-grouped">
                        <div class="control">
                            <div class="select">
                                <select id="cmb_plato_simple">
                                    <optgroup label="Desayunos">
                                    <?php foreach (\model\dao\Desayuno::obtenerTodos() as $desayuno) {
                                        echo "<option value='desayuno_{$desayuno->getId()}' data-precio='{$desayuno->getPrecio()}'>{$desayuno->getDescripcion()}</option>";
                                    } ?>
                                    </optgroup>
                                    <optgroup label="Extras">
                                        <?php foreach (\model\dao\Extra::obtenerTodos() as $extra) {
                                            echo "<option value='extra_{$extra->getId()}' data-precio='{$extra->getPrecio()}'>{$extra->getDescripcion()}</option>";
                                        } ?>
                                    </optgroup>
                                    <optgroup label="Bebida">
                                        <?php foreach (\model\dao\Bebida::obtenerTodas() as $bebida) {
                                            echo "<option value='bebida_{$bebida->getId()}' data-precio='{$bebida->getPrecio()}'>{$bebida->getDescripcion()}</option>";
                                        } ?>
                                    </optgroup>
                                    <optgroup label="Jugos">
                                        <?php foreach (\model\dao\Jugo::obtenerTodos() as $jugo) { ?>
                                            <option data-precio="<?= $jugo->getPrecio() ?>" data-precio-leche="<?= $jugo->getPrecioLeche() ?>"
                                                    value="jugo_<?= $jugo->getId() ?>">
                                                <?= $jugo->getDescripcion() ?>
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
                                </select>
                            </div>
                        </div>
                        <div class="control">
                            <button class="button is-info" id="btn_normal" type="button">Agregar</button>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <label class="label">Menú</label>
                    <div class="field is-grouped">
                        <div class="control">
                            <div class="select">
                                <select id="cmb_entrada">
                                    <option value="entrada_0">-Sin Entrada-</option>
                                    <?php foreach (\model\dao\Entrada::obtenerTodos() as $entrada) {
                                        echo "<option value='entrada_{$entrada->getId()}' data-precio='{$entrada->getPrecio()}'>{$entrada->getDescripcion()}</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control">
                            <div class="select">
                                <select id="cmb_fondo">
                                    <option value="fondo_0">-Sin Fondo-</option>
                                    <?php foreach (\model\dao\Fondo::obtenerTodos() as $fondo) {
                                        echo "<option value='fondo_{$fondo->getId()}' data-precio='{$fondo->getPrecio()}'>{$fondo->getDescripcion()}</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control">
                            <button class="button is-info" id="btn_menu" type="button">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <label class="label">Cena</label>
                    <div class="field is-grouped">
                        <div class="control">
                            <div class="select">
                                <select id="cmb_extra">
                                    <?php foreach (\model\dao\Cena::obtenerTodos() as $cena) {
                                        echo "<option value='cena_{$cena->getId()}' data-precio2='{$cena->getPrecio2()}' data-precio3='{$cena->getPrecio3()}'>{$cena->getDescripcion()}</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control">
                            <div class="select">
                                <select id="cmb_agregado1">
                                    <?php foreach (\model\dao\Agregado::obtenerTodos() as $agregado) {
                                        echo "<option value='agregado1_{$agregado->getId()}'>{$agregado->getDescripcion()}</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control">
                            <div class="select">
                                <select id="cmb_agregado2">
                                    <option value="agregado2_0">--Sin Agregado--</option>
                                    <?php foreach (\model\dao\Agregado::obtenerTodos() as $agregado) {
                                        echo "<option value='agregado2_{$agregado->getId()}'>{$agregado->getDescripcion()}</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control">
                            <button class="button is-info" id="btn_extra" type="button">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table is-bordered is-fullwidth">
                <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="tbl_venta_cocina_detalle_simple"></tbody>
                <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <th id="th_total"></th>
                </tr>
                </tfoot>
            </table>
        </form>

        <div class="field is-grouped">
            <div class="control">
                <div class="select">
                    <select name="pago_tipo" form="form-venta-cocina">
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
<script type="text/javascript" src="<?= URL ?>resource/js/venta_cocina.js"></script>
</body>
</html>