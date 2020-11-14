<?php

namespace model\dao;
use PDO, PDOException;

class Bebida extends Bd
{
    public static function nueva(\model\Bebida $bebida){
        try{
            $sql = "INSERT INTO bebida (descripcion, precio, visible) VALUES(:descripcion, :precio, 1);";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $bebida->getDescripcion(),
                ':precio' => $bebida->getPrecio()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function editar(\model\Bebida $bebida){
        try{
            $sql = "UPDATE bebida SET descripcion = :descripcion, precio = :precio WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $bebida->getDescripcion(),
                ':precio' => $bebida->getPrecio(),
                ':id' => $bebida->getId()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function eliminar($id){
        try{
            $sql = "UPDATE bebida SET visible = 0 WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' =>  $id ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Bebida[] */
    public static function obtenerTodas(){
        try{
            $sql = "SELECT * FROM bebida WHERE visible = 1;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_CLASS, '\model\Bebida');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Bebida */
    public static function obtener($id){
        try{
            $sql = "SELECT * FROM bebida WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
            return $sth->fetchObject('\model\Bebida');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function obtenerLite(){
        try{
            $sql = "SELECT id, CONCAT('<strong>Bebida: </strong>', descripcion) as descripcion FROM bebida;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_KEY_PAIR);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }
}