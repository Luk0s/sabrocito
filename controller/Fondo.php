<?php

namespace controller;

class Fondo
{
    public static function run(array $datos){ return self::{$datos['accion']}($datos); }

    private static function nuevo($datos){
        $fondo = new \model\Fondo();
        $fondo->setDescripcion($datos['descripcion']);
        $fondo->setPrecio($datos['precio']);
        \model\dao\Fondo::nuevo($fondo);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    private static function editar($datos){
        $fondo = new \model\Fondo();
        $fondo->setId($datos['id']);
        $fondo->setDescripcion($datos['descripcion']);
        $fondo->setPrecio($datos['precio']);
        \model\dao\Fondo::editar($fondo);
        header("Location: " . URL . "view/fondo.php");
    }

    private static function eliminar($datos){
        \model\dao\Fondo::eliminar($datos['id']);
        header("Location: " . URL . "view/fondo.php");
    }
}