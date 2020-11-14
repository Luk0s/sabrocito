<?php

namespace controller;

class Otro
{
    public static function run(array $datos){ return self::{$datos['accion']}($datos); }

    private static function nuevo($datos){
        $otro = new \model\Otro();
        $otro->setDescripcion($datos['descripcion']);
        $otro->setPrecio($datos['precio']);
        \model\dao\Otro::nuevo($otro);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    private static function editar($datos){
        $otro = new \model\Otro();
        $otro->setId($datos['id']);
        $otro->setDescripcion($datos['descripcion']);
        $otro->setPrecio($datos['precio']);
        \model\dao\Otro::editar($otro);
        header("Location: " . URL . "view/otro.php");
    }

    private static function eliminar($datos){
        \model\dao\Otro::eliminar($datos['id']);
        header("Location: " . URL . "view/otro.php");
    }
}