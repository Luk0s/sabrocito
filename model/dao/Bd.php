<?php
/**
 * @author luk0s
 * El: 6 sep. 2020
 * A: 11:53:48
 * En: NetBeans
 * Proyecto: restorant
 */

namespace model\dao;

class Bd {
    
    public static function conexion(){
        $_db = null;
        try {
            $command = [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''];
            $_db = new \PDO('mysql:host=localhost;dbname=restorant', 'root', '', $command);
            $_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $_db->beginTransaction();
            $sth = $_db->prepare("BEGIN");
            $sth->execute();
            $_db->commit();
            return $_db;
        }
        catch (\PDOException $ex) {
            echo "<pre>"; var_dump($ex); echo "</pre>";
            die();
        }
    }
}
