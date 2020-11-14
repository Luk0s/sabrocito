<?php

namespace model\dao;
use PDO, PDOException;

class Entrada extends Bd
{
    public static function nuevo(\model\Entrada $entrada){
        try{
            $sql = "INSERT INTO entrada (descripcion, precio, visible) VALUES(:descripcion, :precio, 1);";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $entrada->getDescripcion(),
                ':precio' => $entrada->getPrecio()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function editar(\model\Entrada $entrada){
        try{
            $sql = "UPDATE entrada SET descripcion = :descripcion, precio = :precio WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $entrada->getDescripcion(),
                ':precio' => $entrada->getPrecio(),
                ':id' => $entrada->getId()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function eliminar($id){
        try{
            $sql = "UPDATE entrada SET visible = 0 WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Entrada[] */
    public static function obtenerTodos(){
        try{
            $sql = "SELECT * FROM entrada WHERE visible = 1;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_CLASS, '\model\Entrada');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Entrada */
    public static function obtener($id){
        try{
            $sql = "SELECT * FROM entrada WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
            return $sth->fetchObject('\model\Entrada');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function obtenerLite(){
        try{
            $sql = "SELECT id, CONCAT('<strong>Entrada: </strong>', descripcion) as descripcion FROM entrada;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_KEY_PAIR);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }
}