<?php

namespace controller;

class Desayuno
{
    public static function run(array $datos){ return self::{$datos['accion']}($datos); }

    private static function nuevo($datos){
        $desayuno = new \model\Desayuno();
        $desayuno->setDescripcion($datos['descripcion']);
        $desayuno->setPrecio($datos['precio']);
        \model\dao\Desayuno::nuevo($desayuno);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    private static function editar($datos){
        $desayuno = new \model\Desayuno();
        $desayuno->setId($datos['id']);
        $desayuno->setDescripcion($datos['descripcion']);
        $desayuno->setPrecio($datos['precio']);
        \model\dao\Desayuno::editar($desayuno);
        header("Location: " . URL . "view/desayuno.php");
    }

    private static function eliminar($datos){
        \model\dao\Desayuno::eliminar($datos['id']);
        header("Location: " . URL . "view/desayuno.php");
    }
}