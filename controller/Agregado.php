<?php

namespace controller;

class Agregado
{
    public static function run(array $datos){ return self::{$datos['accion']}($datos); }

    private static function nuevo($datos){
        $agregado = new \model\Agregado();
        $agregado->setDescripcion($datos['descripcion']);
        \model\dao\Agregado::nuevo($agregado);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    private static function editar($datos){
        $agregado = new \model\Agregado();
        $agregado->setId($datos['id']);
        $agregado->setDescripcion($datos['descripcion']);
        \model\dao\Agregado::editar($agregado);
        header("Location: " . URL . "view/agregado.php");
    }

    private static function eliminar($datos){
        \model\dao\Agregado::eliminar($datos['id']);
        header("Location: " . URL . "view/agregado.php");
    }
}