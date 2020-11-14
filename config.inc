<?php
/**
 * Por: Mario Cares (luk0s)
 * El: 03-09-2020
 * A: 13:13:56
 * En: NetBeans
 **/

define('URL', '/');
define('RUTA', '/var/www/r2/');

spl_autoload_register(function ($clase) {
    if(file_exists(RUTA . str_replace('\\', '/', $clase) . '.php')){
        include_once RUTA . str_replace('\\', '/', $clase) . '.php';

    }else{
        echo "<pre>"; var_dump($clase); echo "</pre>";
    }
});