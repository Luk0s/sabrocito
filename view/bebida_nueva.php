<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.inc';
$bebida = $_GET['id'] == '0' ? new \model\Bebida() : \model\dao\Bebida::obtener($_GET['id']);
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
                    <p class="title"><?= ($bebida->getId() === 0) ? 'Nueva Bebida' : $bebida->getDescripcion() ?></p>
                </div>
            </div>
            <div class="level-right"></div>
        </nav>
        <form method="post" action="<?= URL ?>controller/router.php">
            <input type="hidden" name="tabla" value="bebida" />
            <input type="hidden" name="id" value="<?= ($bebida->getId() === 0) ? '0' : $bebida->getId() ?>" />
            <div class="field">
                <label class="label">Nombre</label>
                <div class="control">
                    <input class="input" name="descripcion" maxlength="50" required autofocus
                           value="<?= ($bebida->getId() === 0) ? '' : $bebida->getDescripcion() ?>" />
                </div>
            </div>
            <div class="field">
                <label class="label">Precio</label>
                <div class="control">
                    <input class="input" type="number" name="precio" required
                           value="<?= ($bebida->getId() === 0) ? '0' : $bebida->getPrecio() ?>" />
                </div>
            </div>
            <?php if($bebida->getId() === 0){
                echo "<button class='button is-primary' type='submit' name='accion' value='nueva'>Nueva</button>";
            } else {
                echo "<div class='buttons'>";
                echo "<button class='button is-info' type='submit' name='accion' value='editar'>Editar</button>";
                echo "<button class='button is-danger' type='submit' name='accion' value='eliminar'>Eliminar</button>";
                echo "</div>";
            } ?>
        </form>
    </div>
</section>
</body>
</html>