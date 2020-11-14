<?php

namespace model\dao;
use PDO, PDOException;

class Otro extends Bd
{
    public static function nuevo(\model\Otro $otro){
        try{
            $sql = "INSERT INTO otro (descripcion, precio, visible) VALUES(:descripcion, :precio, 1);";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $otro->getDescripcion(),
                ':precio' => $otro->getPrecio()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function editar(\model\Otro $otro){
        try{
            $sql = "UPDATE otro SET descripcion = :descripcion, precio = :precio WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $otro->getDescripcion(),
                ':precio' => $otro->getPrecio(),
                ':id' => $otro->getId()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function eliminar($id){
        try{
            $sql = "UPDATE otro SET visible = 0 WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Otro[] */
    public static function obtenerTodos(){
        try{
            $sql = "SELECT * FROM otro WHERE visible = 1;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_CLASS, '\model\Otro');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Otro */
    public static function obtener($id){
        try{
            $sql = "SELECT * FROM otro WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
            return $sth->fetchObject('\model\Otro');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function obtenerLite(){
        try{
            $sql = "SELECT id, CONCAT('<strong>Otro: </strong>', descripcion) as descripcion FROM otro;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_KEY_PAIR);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }
}