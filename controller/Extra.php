<?php

namespace controller;

class Extra
{
    public static function run(array $datos){ return self::{$datos['accion']}($datos); }

    private static function nuevo($datos){
        $extra = new \model\Extra();
        $extra->setDescripcion($datos['descripcion']);
        $extra->setPrecio($datos['precio']);
        \model\dao\Extra::nuevo($extra);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    private static function editar($datos){
        $extra = new \model\Extra();
        $extra->setId($datos['id']);
        $extra->setDescripcion($datos['descripcion']);
        $extra->setPrecio($datos['precio']);
        \model\dao\Extra::editar($extra);
        header("Location: " . URL . "view/extra.php");
    }

    private static function eliminar($datos){
        \model\dao\Extra::eliminar($datos['id']);
        header("Location: " . URL . "view/extra.php");
    }
}