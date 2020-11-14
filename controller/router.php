<?php
/**
 * @author luk0s
 * El: 8 sep. 2020
 * A: 21:53:57
 * En: NetBeans
 * Proyecto: restorant
 */

namespace controller;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../config.inc';

session_start();

//var_dump($_POST);

if(isset($_POST['tabla']) && isset($_POST['accion'])){
    switch ($_POST['tabla']) {
        case 'desayuno':
            Desayuno::run($_POST);
            break;
        case 'jugo':
            Jugo::run($_POST);
            break;
        case 'agregado':
            Agregado::run($_POST);
            break;
        case 'extra':
            Extra::run($_POST);
            break;
        case 'otro':
            Otro::run($_POST);
            break;
        case 'cena':
            Cena::run($_POST);
            break;
        case 'entrada':
            Entrada::run($_POST);
            break;
        case 'fondo':
            Fondo::run($_POST);
            break;
        case 'bebida':
            Bebida::run($_POST);
            break;
        case 'venta':
            Venta::run($_POST);
            break;
    }
}