<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.inc';
$fondo = $_GET['id'] == '0' ? new \model\Fondo() : \model\dao\Fondo::obtener($_GET['id']);
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
                    <p class="title"><?= ($fondo->getId() === 0) ? 'Nuevo Fondo' : $fondo->getDescripcion() ?></p>
                </div>
            </div>
            <div class="level-right"></div>
        </nav>
        <form method="post" action="<?= URL ?>controller/router.php">
            <input type="hidden" name="tabla" value="fondo" />
            <input type="hidden" name="id" value="<?= ($fondo->getId() === 0) ? '0' : $fondo->getId() ?>" />
            <div class="field">
                <label class="label">Nombre</label>
                <div class="control">
                    <input class="input" name="descripcion" maxlength="50" required autofocus
                           value="<?= ($fondo->getId() === 0) ? '' : $fondo->getDescripcion() ?>" />
                </div>
            </div>
            <div class="field">
                <label class="label">Precio</label>
                <div class="control">
                    <input class="input" type="number" name="precio" required
                           value="<?= ($fondo->getId() === 0) ? '2000' : $fondo->getPrecio() ?>" />
                </div>
            </div>
            <?php if($fondo->getId() === 0){
                echo "<button class='button is-primary' type='submit' name='accion' value='nuevo'>Nuevo</button>";
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