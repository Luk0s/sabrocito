<?php

namespace controller;

class Entrada
{
    public static function run(array $datos){ return self::{$datos['accion']}($datos); }

    private static function nuevo($datos){
        $entrada = new \model\Entrada();
        $entrada->setDescripcion($datos['descripcion']);
        $entrada->setPrecio($datos['precio']);
        \model\dao\Entrada::nuevo($entrada);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    private static function editar($datos){
        $entrada = new \model\Entrada();
        $entrada->setId($datos['id']);
        $entrada->setDescripcion($datos['descripcion']);
        $entrada->setPrecio($datos['precio']);
        \model\dao\Entrada::editar($entrada);
        header("Location: " . URL . "view/entrada.php");
    }

    private static function eliminar($datos){
        \model\dao\Entrada::eliminar($datos['id']);
        header("Location: " . URL . "view/entrada.php");
    }
}