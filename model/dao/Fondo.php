<?php

namespace model\dao;
use PDO, PDOException;

class Fondo extends Bd
{
    public static function nuevo(\model\Fondo $fondo){
        try{
            $sql = "INSERT INTO fondo (descripcion, precio, visible) VALUES(:descripcion, :precio, 1);";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $fondo->getDescripcion(),
                ':precio' => $fondo->getPrecio()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function editar(\model\Fondo $fondo){
        try{
            $sql = "UPDATE fondo SET descripcion = :descripcion, precio = :precio WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $fondo->getDescripcion(),
                ':precio' => $fondo->getPrecio(),
                ':id' => $fondo->getId()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function eliminar($id){
        try{
            $sql = "UPDATE fondo SET visible = 0 WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Fondo[] */
    public static function obtenerTodos(){
        try{
            $sql = "SELECT * FROM fondo WHERE visible = 1;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_CLASS, '\model\Fondo');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Fondo */
    public static function obtener($id){
        try{
            $sql = "SELECT * FROM fondo WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
            return $sth->fetchObject('\model\Fondo');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function obtenerLite(){
        try{
            $sql = "SELECT id, CONCAT('<strong>Fondo: </strong>', descripcion) as descripcion FROM fondo;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_KEY_PAIR);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }
}