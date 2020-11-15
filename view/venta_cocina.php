<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.inc';
$total_efectivo = 0;
$total_credito = 0;
$total_debito = 0;

$productos = [
    'desayuno' => \model\dao\Desayuno::obtenerLite(),
    'agregado' => \model\dao\Agregado::obtenerLite(),
    'bebida' => \model\dao\Bebida::obtenerLite(),
    'cena' => \model\dao\Cena::obtenerLite(),
    'entrada' => \model\dao\Entrada::obtenerLite(),
    'extra' => \model\dao\Extra::obtenerLite(),
    'fondo' => \model\dao\Fondo::obtenerLite(),
    'jugo' => \model\dao\Jugo::obtenerLite(),
    'otro' => \model\dao\Otro::obtenerLite(),
];
?>

<!DOCTYPE html>
<html class="has-navbar-fixed-top">
<?php include RUTA . 'view/header.inc'; ?>
<body>
<?php include RUTA . 'view/navbar.inc'; ?>
<section class="section">
    <div class="container content">
        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <p class="title">Venta Cocina</p>
                </div>
            </div>
            <div class="level-right">
                <p class="level-item">
                    <a class="button is-success" href="<?= URL ?>view/venta_cocina_nueva.php?id=0">
                        <span class="icon"><i class="far fa-plus-square"></i></span>
                        <span>Agregar</span>
                    </a>
                </p>
            </div>
        </nav>
        <table class="table is-bordered is-fullwidth">
            <thead>
            <tr>
                <th>Fecha (T. Espera)</th>
                <th>Tipo Pago</th>
                <th>Total</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach (\model\dao\Venta::obtenerVentas(date('Y-m-d')) as $venta){
                $total_credito += ($venta->getPagoTipoId() == 3) ? $venta->getTotal() : 0;
                $total_debito += ($venta->getPagoTipoId() == 2) ? $venta->getTotal() : 0;
                $total_efectivo += ($venta->getPagoTipoId() == 1) ? $venta->getTotal() : 0;
                ?>
                <tr>
                    <td><?= $venta->getVentaAt() ?> (<?= $venta->espera ?> min.)</td>
                    <td><?= $venta->pago_tipo ?></td>
                    <td><?= number_format($venta->getTotal(), 0, ',', '.') ?></td>
                    <td>
                        <button class="button is-warning btn_detalle" data-target="#tr_<?= $venta->getId() ?>">
                            <span class="icon">
                                <i class="far fa-eye"></i>
                            </span>
                        </button>
                    </td>
                </tr>
                <tr id="tr_<?= $venta->getId() ?>" class="is-hidden">
                    <td colspan="3">
                        <h1 class="title is-5">Estado: <?= $venta->estado ?></h1>
                        <ul>
                            <?php foreach ($venta->getDetalle() as $item) {
                                echo "<li>{$productos[$item['tipo']][$item['producto_id']]} - {$item['comentario']}</li>";
                            } ?>
                        </ul>
                    </td>
                    <td>
                        <?php if($venta->getEstadoId() === 1){ ?>
                            <form method="post" action="<?= URL ?>controller/router.php">
                                <input type="hidden" name="tabla" value="venta" />
                                <input type="hidden" name="venta_id" value="<?= $venta->getId() ?>" />
                                <button class="button is-danger" type="submit" name="accion" value="anular">
                                    <span class="icon"><i class="far fa-trash-alt"></i></span>
                                    <span>Anular Pedido</span>
                                </button>
                            </form>
                        <?php }?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="2">Total Efectivo</th>
                <th><?= number_format($total_efectivo, 0, ',', '.') ?></th>
            </tr>
            <tr>
                <th colspan="2">Total Débito</th>
                <th><?= number_format($total_debito, 0, ',', '.') ?></th>
            </tr>
            <tr>
                <th colspan="2">Total Crédito</th>
                <th><?= number_format($total_credito, 0, ',', '.') ?></th>
            </tr>
            <tr>
                <th colspan="2">Total Día</th>
                <th><?= number_format($total_credito + $total_debito + $total_efectivo, 0, ',', '.') ?></th>
            </tr>
            </tfoot>
        </table>
    </div>
</section>
<script type="text/javascript" src="<?= URL ?>resource/js/venta.js"></script>
</body>
</html>