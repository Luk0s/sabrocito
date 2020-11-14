<?php

namespace controller;

class Jugo
{
    public static function run(array $datos){ return self::{$datos['accion']}($datos); }

    private static function nuevo($datos){
        $jugo = new \model\Jugo();
        $jugo->setDescripcion($datos['descripcion']);
        $jugo->setPrecio($datos['precio']);
        $jugo->setPrecioLeche($datos['precio_leche']);
        \model\dao\Jugo::nuevo($jugo);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    private static function editar($datos){
        $jugo = new \model\Jugo();
        $jugo->setId($datos['id']);
        $jugo->setDescripcion($datos['descripcion']);
        $jugo->setPrecio($datos['precio']);
        $jugo->setPrecioLeche($datos['precio_leche']);
        \model\dao\Jugo::editar($jugo);
        header("Location: " . URL . "view/jugo.php");
    }

    private static function eliminar($datos){
        \model\dao\Jugo::eliminar($datos['id']);
        header("Location: " . URL . "view/jugo.php");
    }
}