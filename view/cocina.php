<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.inc';

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
                    <p class="title">Cocina</p>
                </div>
            </div>
        </nav>
        <table class="table is-bordered is-fullwidth">
            <thead>
            <tr>
                <th>Plato</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach (\model\dao\Venta::obtenerVentas(date('Y-m-d'), 0, [1]) as $venta){ ?>
                <tr>
                    <td>
                        <ul>
                            <?php foreach ($venta->getDetalle() as $item) {
                                echo "<li>{$productos[$item['tipo']][$item['producto_id']]}</li>";
                            } ?>
                        </ul>
                    </td>
                    <td>
                        <form method="post" action="<?= URL ?>controller/router.php">
                            <input type="hidden" name="tabla" value="venta" />
                            <input type="hidden" name="id" value="<?= $venta->getId() ?>" />
                            <button type="submit" class="button is-success btn_detalle" name="accion" value="terminar">
                                <span class="icon">
                                    <i class="fas fa-check-double"></i>
                                </span>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>