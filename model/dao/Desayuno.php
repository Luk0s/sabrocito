<?php

namespace model\dao;
use PDO, PDOException;

class Desayuno extends Bd
{
    public static function nuevo(\model\Desayuno $desayuno){
        try{
            $sql = "INSERT INTO desayuno (descripcion, precio, visible) VALUES(:descripcion, :precio, 1);";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $desayuno->getDescripcion(),
                ':precio' => $desayuno->getPrecio()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function editar(\model\Desayuno $desayuno){
        try{
            $sql = "UPDATE desayuno SET descripcion = :descripcion, precio = :precio WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $desayuno->getDescripcion(),
                ':precio' => $desayuno->getPrecio(),
                ':id' => $desayuno->getId()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function eliminar($id){
        try{
            $sql = "UPDATE desayuno SET visible = 0 WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Desayuno[] */
    public static function obtenerTodos(){
        try{
            $sql = "SELECT * FROM desayuno WHERE visible = 1;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_CLASS, '\model\Desayuno');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Desayuno */
    public static function obtener($id){
        try{
            $sql = "SELECT * FROM desayuno WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
            return $sth->fetchObject('\model\Desayuno');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function obtenerLite(){
        try{
            $sql = "SELECT id, CONCAT('<strong>Desayuno: </strong>', descripcion) as descripcion FROM desayuno;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_KEY_PAIR);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }
}