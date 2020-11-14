<?php
?>

<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="<?= URL ?>">
            El Sabrocito
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
             <a class="navbar-item" href="<?= URL ?>view/venta_rapida.php" target="_self">
                Venta Rápida
            </a>
            <a class="navbar-item" href="<?= URL ?>view/venta_cocina.php" target="_self">
                Venta Cocina
            </a>
            <a class="navbar-item" href="<?= URL ?>view/cocina.php" target="_self">
                Cocina
            </a>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    Administración
                </a>
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="<?= URL ?>view/desayuno.php" target="_self">
                        Desayunos
                    </a>
                    <a class="navbar-item" href="<?= URL ?>view/entrada.php" target="_self">
                        Entrada Menú
                    </a>
                    <a class="navbar-item" href="<?= URL ?>view/fondo.php" target="_self">
                        Entrada Fondo
                    </a>
                    <a class="navbar-item" href="<?= URL ?>view/extra.php" target="_self">
                        Extras
                    </a>
                    <a class="navbar-item" href="<?= URL ?>view/cena.php" target="_self">
                        Cenas
                    </a>
                    <a class="navbar-item" href="<?= URL ?>view/agregado.php" target="_self">
                        Agregados
                    </a>
                    <a class="navbar-item" href="<?= URL ?>view/bebida.php" target="_self">
                        Bebidas
                    </a>
                    <a class="navbar-item" href="<?= URL ?>view/jugo.php" target="_self">
                        Jugos
                    </a>
                    <a class="navbar-item" href="<?= URL ?>view/otro.php" target="_self">
                        Otros
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item">
                        Report an issue
                    </a>
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-primary">
                        <strong>Sign up</strong>
                    </a>
                    <a class="button is-light">
                        Log in
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>