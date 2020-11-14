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
        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <p class="title">Jugos</p>
                </div>
            </div>
            <div class="level-right">
                <p class="level-item">
                    <a class="button is-success" href="<?= URL ?>view/jugo_nuevo.php?id=0">
                        <span class="icon"><i class="far fa-plus-square"></i></span>
                        <span>Agregar</span>
                    </a>
                </p>
            </div>
        </nav>
        <table class="table is-bordered is-fullwidth">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Con Leche</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach (\model\dao\Jugo::obtenerTodos() as $jugo){ ?>
                <tr>
                    <td><?= $jugo->getDescripcion() ?></td>
                    <td>$ <?= number_format($jugo->getPrecio(), 0, ',', '.') ?></td>
                    <td>$ <?= number_format($jugo->getPrecioLeche(), 0, ',', '.') ?></td>
                    <td>
                        <a class="button is-warning" href="<?= URL ?>view/jugo_nuevo.php?id=<?= $jugo->getId() ?>" target="_self">
                            <span class="icon">
                                <i class="far fa-edit"></i>
                            </span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>