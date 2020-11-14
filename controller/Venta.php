<?php

namespace controller;

class Venta
{
    public static function run(array $datos){ return self::{$datos['accion']}($datos); }

    private static function terminar($datos){
        \model\dao\Venta::terminar($datos['id']);
        header('Location: ' . URL . 'view/cocina.php');
    }

    private static function nuevaRapida($datos){
        $venta = new \model\Venta();
        $venta->setPagoTipoId($datos['pago_tipo']);
        $venta->setRapida(1);
        $tmp = []; $total = 0;
        foreach (json_decode($datos['detalle'], true) as $item) {
            $t = explode('_', $item['item']);
            $tmp []= [
                'tipo' => $t[0],
                'id' => $t[1],
                'precio' => $item['precio']
            ];
            $total += $item['precio'];
        }
        $venta->setTotal($total);
        $venta->setDetalle($tmp);
        \model\dao\Venta::nueva($venta);
        header('Location: ' . URL . 'view/venta_rapida.php');
    }

    private static function nuevaCocina($datos){
        $venta = new \model\Venta();
        $venta->setPagoTipoId($datos['pago_tipo']);
        $venta->setRapida(0);
        $tmp = []; $total = 0;
        foreach (json_decode($datos['detalle_simple'], true) as $item) {
            $t = explode('_', $item['item']);
            if($t[0] !== ''){
                if(in_array($t[0], ['desayuno', 'extra', 'bebida', 'jugo', 'otro'])){
                    $tmp []= [
                        'tipo' => $t[0],
                        'id' => $t[1],
                        'precio' => $item['precio']
                    ];
                } else {
                    switch ($t[0]){
                        case 'entrada':
                            $tmp []= [
                                'tipo' => $t[0],
                                'id' => $t[1],
                                'precio' => $item['precio']
                            ];
                            if(count($t) == 4){
                                $tmp []= [
                                    'tipo' => $t[2],
                                    'id' => $t[3],
                                    'precio' => $item['precio']
                                ];
                            }
                            break;
                        case 'cena':
                            $tmp []= [
                                'tipo' => $t[0],
                                'id' => $t[1],
                                'precio' => $item['precio']
                            ];
                            $tmp []= [
                                'tipo' => 'agregado',
                                'id' => $t[3],
                                'precio' => $item['precio']
                            ];
                            if(count($t) == 6){
                                $tmp []= [
                                    'tipo' => 'agregado',
                                    'id' => $t[5],
                                    'precio' => $item['precio']
                                ];
                            }
                            break;
                    }
                }
            } else {
                // SOLAMENTE ENTRO SI ES UN FONDO SOLITO
                $tmp []= [
                    'tipo' => $t[1],
                    'id' => $t[2],
                    'precio' => $item['precio']
                ];
            }
            $total += $item['precio'];
        }
        $venta->setTotal($total);
        $venta->setDetalle($tmp);
        \model\dao\Venta::nueva($venta);
        header('Location: ' . URL . 'view/venta_cocina.php');
    }

    private static function anular($datos){
        \model\dao\Venta::anular($datos['venta_id']);
        header('Location: ' . URL . 'view/cocina.php');
    }
}