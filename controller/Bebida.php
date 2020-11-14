<?php

namespace controller;

class Bebida
{
    public static function run(array $datos){ return self::{$datos['accion']}($datos); }

    private static function nueva($datos){
        $bebida = new \model\Bebida();
        $bebida->setDescripcion($datos['descripcion']);
        $bebida->setPrecio($datos['precio']);
        \model\dao\Bebida::nueva($bebida);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    private static function editar($datos){
        $bebida = new \model\Bebida();
        $bebida->setId($datos['id']);
        $bebida->setDescripcion($datos['descripcion']);
        $bebida->setPrecio($datos['precio']);
        \model\dao\Bebida::editar($bebida);
        header("Location: " . URL . "view/bebida.php");
    }

    private static function eliminar($datos){
        \model\dao\Bebida::eliminar($datos['id']);
        header("Location: " . URL . "view/bebida.php");
    }
}