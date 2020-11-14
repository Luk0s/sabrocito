<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.inc';
$cena = $_GET['id'] == '0' ? new \model\Cena() : \model\dao\Cena::obtener($_GET['id']);
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
                    <p class="title"><?= ($cena->getId() === 0) ? 'Nueva Cena' : $cena->getDescripcion() ?></p>
                </div>
            </div>
            <div class="level-right"></div>
        </nav>
        <form method="post" action="<?= URL ?>controller/router.php">
            <input type="hidden" name="tabla" value="cena" />
            <input type="hidden" name="id" value="<?= ($cena->getId() === 0) ? '0' : $cena->getId() ?>" />
            <div class="field">
                <label class="label">Nombre</label>
                <div class="control">
                    <input class="input" name="descripcion" maxlength="50" required autofocus
                           value="<?= ($cena->getId() === 0) ? '' : $cena->getDescripcion() ?>" />
                </div>
            </div>
            <div class="field">
                <label class="label">Precio 2 agregados</label>
                <div class="control">
                    <input class="input" type="number" name="precio_2" required
                           value="<?= ($cena->getId() === 0) ? '2000' : $cena->getPrecio2() ?>" />
                </div>
            </div>
            <div class="field">
                <label class="label">Precio 3 agregados</label>
                <div class="control">
                    <input class="input" type="number" name="precio_3" required
                           value="<?= ($cena->getId() === 0) ? '3000' : $cena->getPrecio3() ?>" />
                </div>
            </div>
            <?php if($cena->getId() === 0){
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