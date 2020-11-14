<?php

namespace model\dao;
use PDO, PDOException;

class Jugo extends Bd
{
    public static function nuevo(\model\Jugo $jugo){
        try{
            $sql = "INSERT INTO jugo (descripcion, precio, precio_leche, visible) VALUES(:descripcion, :precio, :precio_leche, 1);";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $jugo->getDescripcion(),
                ':precio' => $jugo->getPrecio(),
                ':precio_leche' => $jugo->getPrecioLeche(),
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function editar(\model\Jugo $jugo){
        try{
            $sql = "UPDATE jugo SET descripcion = :descripcion, precio = :precio, precio_leche = :precio_leche WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $jugo->getDescripcion(),
                ':precio' => $jugo->getPrecio(),
                ':precio_leche' => $jugo->getPrecioLeche(),
                ':id' => $jugo->getId()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function eliminar($id){
        try{
            $sql = "UPDATE jugo SET visible = 0 WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' =>  $id ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Jugo[] */
    public static function obtenerTodos(){
        try{
            $sql = "SELECT * FROM jugo WHERE visible = 1;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_CLASS, '\model\Jugo');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Jugo */
    public static function obtener($id){
        try{
            $sql = "SELECT * FROM jugo WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
            return $sth->fetchObject('\model\Jugo');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function obtenerLite(){
        try{
            $sql = "SELECT id, CONCAT('<strong>Jugo: </strong>', descripcion) as descripcion FROM jugo;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_KEY_PAIR);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }
}