<?php

namespace controller;

class Cena
{
    public static function run(array $datos){ return self::{$datos['accion']}($datos); }

    private static function nuevo($datos){
        $cena = new \model\Cena();
        $cena->setDescripcion($datos['descripcion']);
        $cena->setPrecio2($datos['precio_2']);
        $cena->setPrecio3($datos['precio_3']);
        \model\dao\Cena::nuevo($cena);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    private static function editar($datos){
        $cena = new \model\Cena();
        $cena->setId($datos['id']);
        $cena->setDescripcion($datos['descripcion']);
        $cena->setPrecio2($datos['precio_2']);
        $cena->setPrecio3($datos['precio_3']);
        \model\dao\Cena::editar($cena);
        header("Location: " . URL . "view/cena.php");
    }

    private static function eliminar($datos){
        \model\dao\Cena::eliminar($datos['id']);
        header("Location: " . URL . "view/cena.php");
    }
}